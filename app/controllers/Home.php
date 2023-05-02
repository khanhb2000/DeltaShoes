<?php

class Home extends Controller {
    public function __construct() {
		$this->user = new Users;
		$this->product = new Product;
		$this->shoes = new Shoes;
    }

    public function index() {
        $this->view('home/index');
        if(isset($_SESSION['user'])) {
            show($_SESSION['user']);
        }
    }
    public function login() {
        $data = array();
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$email = $password = NULL;
		
			$data['error'] =  NULL;

			if (isset($_POST['email'])) {
                $email = $_POST['email'];
                $password = md5($_POST['password']);
				
			    if ($email && $password) {
					$result = $this->user->login($email,$password);  
					if ($result) {
                        $data = $result[0];
                        if ($data->role == "user") $_SESSION['user'] = $data;
                        else  $_SESSION['admin'] = $data;
                        redirect('home/index');

					} else {
                        $data['error'] = '* Sai thông tin đăng nhập';
					}
				}
					
			}
           
		}
        $this->view('home/login', $data);
    }

    public function signup() {
        
        $data = array();
		
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$email = $password = $fullname = $phone = $address = NULL;
		
			$data['email'] = $data['password'] = $data['full_name'] = $data['email_exist'] = NULL;

			if (isset($_POST['email'])) {
				if (empty($_POST['email'])) {
					$data['email'] = '* Cần điền email';
				} else {
					$email = $_POST['email'];
				}
				if (empty($_POST['password'])) {
					$data['password'] = '* Cần điền mật khẩu';
				} else {
					$password = md5($_POST['password']);
				}

				$phone = $_POST['phone'];
				$address = $_POST['address'];
				$fullname = $_POST['fullname'];
				if ($email && $password) {
					$check = $this->user->check_user($email); 
					if ($check) {
						$data['email_exist'] = '* Email đã được sử dụng';
					} else {
						$this->user->signup($email, $password, $phone, $address, $fullname);
						redirect('home/login');
					}
				}
					
			}
		}
        $this->view('home/signup', $data);
    }

	public function search() {
		if (isset($_GET["query"])) {
			$data = $this->product->search($_GET["query"]);
			$this->view('home/search', $data);
		}
	}

	public function products() {  
		$categories = $this->product->query("SELECT * FROM categories");
        $sub_categories = $this->product->query("SELECT * FROM sub_categories"); 
        $products = $this->product->query('SELECT products.id, products.name, products.categories_id, products.brand, categories.name AS "category", products.sub_categories_id, sub_categories.name AS "sub_category", color, discount_price, price, in_stock, size, images.name AS "image" FROM products LEFT JOIN products_sku ON products_sku.product_id=products.id LEFT JOIN images ON images.products_id = products.id LEFT JOIN categories ON categories.id = products.categories_id LEFT JOIN sub_categories ON sub_categories.id = products.sub_categories_id GROUP BY products.id'); 
		$colors = $this->product->query('SELECT DISTINCT color from products_sku');
		$brands = $this->product->query('SELECT DISTINCT brand from products');
		$this->view('home/products', ["categories" => $categories, "sub_categories" => $sub_categories, "products" => $products, "colors" => $colors, "brands" => $brands]);

    }

	public function product() {
		if (isset($_GET["id"])) {
			$product = $this->product->query('SELECT * FROM products WHERE products.id = '.$_GET['id'])[0];
        	$products_sku = $this->product->query('SELECT * FROM products_sku where products_sku.product_id = ' .$_GET["id"]);
			$images = $this->product->query("SELECT * from images WHERE images.products_id = ".$_GET["id"]);
			$this->view('home/product', ["product" => $product, "products_sku" => $products_sku, "images" => $images]);
		}
	}

	public function cart() {
		if (empty($_SESSION["admin"])) {
			$data = array();
			if (!empty($_SESSION["cart"])) $data = $_SESSION["cart"];
			$this->view('home/cart', $data);
		}
	}

	public function add_to_cart() {
		show($_POST);
		show($_GET);
		//$product_sku = $this->product->query("SELECT * FROM products_sku where id =".$_GET["id"])[0];
		$item = [$_GET["id"] => $_POST];
		show($item);
		if (!empty($_SESSION["cart"])) {
			if (in_array($_GET["id"], array_keys($_SESSION["cart"]))) {
				$_SESSION["cart"][$_GET["id"]]["quantity"] += $_POST["quantity"];
			}
			else {
				//$_SESSION["cart"] = array_push($_SESSION["cart"],$item);
				$_SESSION["cart"][$_GET["id"]] = $_POST;
			}
		} else {
			$_SESSION["cart"][$_GET["id"]] = $_POST;
		}
		show($_SESSION["cart"][$_GET["id"]]);
	}

	public function remove_from_cart() {
		if (!empty($_SESSION["cart"]) && isset($_GET["id"])) {
			unset($_SESSION["cart"][$_GET["id"]]);
			redirect("home/cart");
		}
	}

	public function payment() {
		if (!empty($_SESSION["cart"])) {
			$data = $_SESSION["cart"];
			$this->view("home/payment", $data);
		}
	}
	public function order() {
		if (!empty($_SESSION["cart"])) {
			$data = $_SESSION["cart"];
			//$this->view("home/payment", $data);
			$keys = array_keys($_POST);
			$query = "INSERT INTO orderdetail (".implode(",", $keys).") values (:".implode(",:", $keys).")";
			show($query);
			$total_price = 0;
			$this->product->query($query, $_POST);
			$new_order = $this->product->get_row("SELECT MAX(id) AS 'maxid' FROM orderdetail");
			$order_id = $new_order->maxid;
			$query = "INSERT INTO orderitem (order_id, item_id, quantity, price_per_unit) VALUES(".$order_id;
			foreach ($data as $key => $value) {
				$q = $query . "," .$key.",".$value["quantity"].",".$value["discount_price"].")";
				show($q);
				$this->product->query($q);
				$stock = $this->product->get_row("SELECT in_stock FROM products_sku WHERE id = ".$key);
				$stock = $stock->in_stock;
				show("UPDATE products_sku SET in_stock = ".$stock - $value["quantity"]. " WHERE id =".$key);
				$this->product->query("UPDATE products_sku SET in_stock = ".$stock - $value["quantity"]. " WHERE id =".$key);
				
				$total_price += $value["discount_price"] * $value["quantity"];
			}
			$this->product->query("UPDATE orderdetail SET total_price = ".$total_price." WHERE id = ".$order_id);
			if (!empty($_SESSION["user"])) {
				$this->product->query("UPDATE orderdetail SET user_id = ".$_SESSION["user"]->id." WHERE id = ".$order_id);
			}
			unset($_SESSION["cart"]);
			redirect("home/success");
		}
	}

	public function update_quantity() {
		if (!empty($_SESSION["cart"])) {
			show($_SESSION["cart"]);
			show("hi");
			show($_SESSION[(int)$_POST["key"]]);
			$_SESSION["cart"][$_POST["key"]]["quantity"] = $_POST["quantity"];
			show($_SESSION["cart"]);
			redirect("home/cart");
		}
	}

	public function about() {
		$this->view("home/about");
	}

	public function contact() {
		$this->view("home/contact");
	}

	public function news() {
		$this->view("home/news");
	}
}