<?php

class Admin extends Controller {
    public function __construct() {
        $this->product = new Product;
        $this->users = new Users;
        $this->order = new Order;
    }

    public function index() {  
        if(isset($_SESSION['admin']) == false){
            redirect('home/login');
            exit();
        } 
        if(isset($_POST['btnUpdateUser'])) {
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $this->users->update($email, $phone, $address, $fullname);
            $_SESSION['admin']->fullname = $fullname;
            $_SESSION['admin']->address = $address;
            $_SESSION['admin']->phone = $phone;
        }
        $data = array();
        $data['email'] = $_SESSION['admin']->email;
        $data['fullname'] = $_SESSION['admin']->fullname;
        $data['address'] =  $_SESSION['admin']->address;
        $data['phone'] =  $_SESSION['admin']->phone;
        $this->view('admin/index', $data);
    }

    /*product*/

    public function add_category() {
        if (isset($_SESSION["admin"])) { 
            if (isset($_POST["name"])) {
                $query = "INSERT INTO categories (name) values ('".$_POST['name']."')";
                $this->product->query($query);
                $new_category = $this->product->get_row("SELECT MAX(id) AS 'maxid' FROM categories");
                echo $new_category->maxid;
            }
        }
    }

    public function remove_category() {
        if (isset($_SESSION["admin"])) { 
            if (isset($_POST["id"])) {
                $query = "DELETE FROM categories WHERE id = ".$_POST['id'];
                $this->product->query($query);
            }
        }
    }

    public function add_sub_category() {
        if (isset($_SESSION["admin"])) { 
            if (isset($_GET["id"])) {
                $query = "INSERT INTO sub_categories (categories_id, name) values (".$_GET['id'].",'".$_POST['name']."')";
                $this->product->query($query);
                $new_sub_category = $this->product->get_row("SELECT MAX(id) AS 'maxid' FROM sub_categories");
                echo $new_sub_category->maxid;
            }
        }
    }

    public function remove_sub_category() {
        if (isset($_SESSION["admin"])) { 
            if (isset($_POST["id"])) {
                $query = "DELETE FROM sub_categories WHERE id = ".$_POST['id'];
                $this->product->query($query);
            }
        }
    }

    public function products() {
        if (isset($_SESSION["admin"])) { 
            $categories = $this->product->query("SELECT * FROM categories");
            $sub_categories = $this->product->query("SELECT * FROM sub_categories");
            $products = $this->product->query("SELECT products.id, products.name AS 'name', sub_categories.name AS 'category', categories.name AS 'type', products.brand, sum(IF(products_sku.product_id = products.id, products_sku.in_stock, 0)) AS 'stock' FROM `products` left join `categories` ON products.categories_id = categories.id left join `sub_categories` ON products.sub_categories_id = sub_categories.id LEFT JOIN `products_sku`ON products_sku.product_id = products.id GROUP BY products.id");
            $this->view('admin/products', ["categories" => $categories, "sub_categories" => $sub_categories, "products" => $products]);   
        }
    }

    public function add() {
        if (isset($_SESSION["admin"])) { 
            $data = $this->product->add();
            $this->view('admin/add', $data);
        }
    }

    public function upload_images($images, $product_id) {
        if (isset($_SESSION["admin"])) { 
            $countfiles = count($images);
            for($i = 0; $i < $countfiles; $i++) {
                // File name
                $filename = $_FILES['files']['name'][$i];
                // Location
                $target_file = $_SERVER["DOCUMENT_ROOT"]."/assignment-ltw/public/assets/img/".basename($filename);
                $name = basename($filename);
                // file extension
                $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                $file_extension = strtolower($file_extension);
                // Valid image extension
                $valid_extension = array("png","jpeg","jpg");
                if(in_array($file_extension, $valid_extension)) {
                    // Upload file
                    if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file)) {
                        // Execute query
                        $query = "INSERT INTO images (products_id, name) VALUES ($product_id, '$name')";
                        $this->product->query($query);
                    }
                }
            }
        }
    }

    public function add_product() {
        if (isset($_SESSION["admin"])) { 
            if (isset($_POST)) {
                $this->product->insert($_POST);
                $new_product = $this->product->get_row("SELECT MAX(id) AS 'maxid' FROM products");
                $id = $new_product->maxid;
                $this->upload_images($_FILES['files']['name'], $id);
                redirect('admin/products');
            }
        }
    }

    public function edit_product() {
        if (isset($_SESSION["admin"])) { 
            $data = $this->product->edit();
            $this->view('admin/edit_product', $data);
        }
    }

    public function update_product() {
        if (isset($_SESSION["admin"])) { 
            if (isset($_GET["id"])) {
                $query = "UPDATE products SET ";
                foreach ($_POST as $key => $value) {
                    if ($key != "files")
                        $query .= "$key = '$value' , ";
                }
                $query = trim($query, " , ");
                $query .= ' WHERE id = '.$_GET["id"];
                $this->product->query($query);
                if ($_FILES['files']['name'] != null) $this->upload_images($_FILES['files']['name'], $_GET["id"]);
                redirect('admin/edit_product?id='.$_GET["id"]);
            }
        }
    }

    public function delete_product() {
        if (isset($_SESSION["admin"])) { 
            if (isset($_GET["id"])) {
                $query = "DELETE FROM products WHERE id = ".$_GET["id"];
                $this->product->query($query);
                redirect('admin/products');
            }
        }
    }
    
    public function edit_product_sku() {
        if (isset($_SESSION["admin"])) { 
            if (isset($_GET["id"])) {
                show($_POST);
                if ($_POST["edit"] == "update") {
                    $query = "UPDATE products_sku SET ";
                    foreach ($_POST as $key => $value) {
                        if ($key != "edit") $query .= "$key = '$value' , ";
                    }
                    $query = trim($query, " , ");
                    $query .= ' WHERE id = '.$_GET["id"];
                    $this->product->query($query);
                } else {
                    $query = "DELETE FROM products_sku WHERE id = ".$_GET["id"];
                    $this->product->query($query);
                }
                redirect('admin/edit_product?id='.$_GET['p_id']);
            }
        }
    }

    public function insert_product_sku() {
        if (isset($_SESSION["admin"])) { 
            if (isset($_GET["id"])) {
                $data = array_merge($_POST, array("product_id" => $_GET["id"]));
                $keys = array_keys($data);
                $query = "INSERT INTO products_sku (".implode(",", $keys).") values (:".implode(",:", $keys).")";
                $this->product->query($query, $data);
                redirect('admin/edit_product?id='.$_GET['id']);
            }
        }
    }

    /*user*/
    public function users() {
        if (isset($_SESSION["admin"])) {
            $users = $this->users->query("SELECT *, (SELECT COUNT(*) FROM orderdetail WHERE orderdetail.user_id = users.id) AS 'orders' FROM users");
            $this->view('admin/users', ["users" => $users]);
        }
    }

    public function user_info() {
        if (isset($_SESSION["admin"]) && isset($_GET["id"])) {
            echo json_encode($this->users->select(["id"=> $_GET["id"]])[0]);
        }
    }

    public function delete_user() {
        if (isset($_SESSION["admin"]) && isset($_GET["id"])) {
            $query = "DELETE FROM users WHERE id = ".$_GET["id"];
            $this->users->query($query);
            redirect('admin/users');
        }
    }

    /*order*/
    public function orders() {
        if (isset($_SESSION["admin"])) {
            $orders = $this->order->get();
            $this->view('admin/orders', ["orders"=>$orders]);
        }
    }

    public function edit_order() {
        if (isset($_SESSION["admin"])) {
            $data = $this->order->edit();
            $this->view('admin/edit_order', $data);
        }
    }

    public function update_order_status() {
        if (isset($_SESSION["admin"]) && isset($_GET["id"])) {
            $query = "UPDATE orderdetail SET ";
            foreach ($_POST as $key => $value) {
                $query .= "$key = '$value' , ";
            }
            $query = trim($query, " , ");
            $query .= ' WHERE id = '.$_GET["id"];
            $res = $this->order->query($query);
            redirect('admin/orders');
        }
    }


    public function changepassword() {
        if(isset($_SESSION['admin']) == false){
            redirect('login');
            exit();
        }
        $data = array();
        $data['email'] = $_SESSION['admin']->email;
        if(isset($_POST['btnChangePassword']) == true){
            $oldPassword = $_POST['oldPassword'];
            $email = $_SESSION['admin']->email;
            $newPassword1 = $_POST['newPassword1'];
            $newPassword2 = $_POST['newPassword2'];
            
            $password = md5($oldPassword);
            $result = $this->users->login($email,$password);
            $data['error'] = "";
            if(!$result){
                $data['error'] .= "Mật khẩu sai!";
            }
            if(strlen($newPassword1) < 6){
                $data['error'] .= "Mật khẩu ngắn quá!";
            }  
            if($newPassword1 != $newPassword2){
                $data['error'] .= "Mật khẩu không giống nhau!";
            }
            $data['oldPassword'] = $_POST['oldPassword'];
            $data['newPassword1'] = $_POST['newPassword1'];
            $data['newPassword2'] = $_POST['newPassword2'];
            if($data['error'] ==""){
                $newPassword = md5($newPassword1);
                $this->users->changepassword($email, $newPassword);
                redirect('admin/index');
            }
        }
        $this->view('admin/changepassword', $data);     
    }

    public function logout() {
        if (isset($_SESSION["admin"])) {
            unset($_SESSION['admin']);
            redirect('home/index');
        }
    }
}

#$admin = new Admin();
#$admin->index();

#call_user_func_array([$admin, 'index'], ['a' => 'something',])