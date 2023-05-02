<?php 
class User extends Controller {
    public function __construct() {
        $this->users = new Users;
        $this->order = new Order;
        $this->orderitem = new OrderItem;
    }

    public function index() {      
        if(isset($_SESSION['user']) == false){
            redirect('home/login');
            exit();
        } 
        if(isset($_POST['btnUpdateUser'])) {
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $this->users->update($email, $phone, $address, $fullname);
            $_SESSION['user']->fullname = $fullname;
            $_SESSION['user']->address = $address;
            $_SESSION['user']->phone = $phone;
        }
		$data = array();
        $data['email'] = $_SESSION['user']->email;
        $data['fullname'] = $_SESSION['user']->fullname;
        $data['address'] =  $_SESSION['user']->address;
        $data['phone'] =  $_SESSION['user']->phone;
        $this->view('user/index', $data); 
    }

    public function changepassword() {
        if(isset($_SESSION['user']) == false){
            redirect('login');
            exit();
        }
        $data = array();
        $data['email'] = $_SESSION['user']->email;
        if(isset($_POST['btnChangePassword']) == true){
            $oldPassword = $_POST['oldPassword'];
            $email = $_SESSION['user']->email;
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
                redirect('home');
            }
        }
        $this->view('user/changepassword', $data);     
    }

    public function logout() {
        if (isset($_SESSION["user"])) {
            unset($_SESSION['user']);
            redirect('home/index');
        }
    }

    public function order() {
        $data = array();
        $data['email'] = $_SESSION['user']->email;
        $data['fullname'] = $_SESSION['user']->fullname;
        $data['address'] =  $_SESSION['user']->address;
        $data['phone'] =  $_SESSION['user']->phone;
        $data['userId'] = $_SESSION['user']->id;
        $data['orders'] = $this->order->getOrderDetailsOfUser($data['userId']);
        $this->view('user/order', $data); 
    }

    public function orderdetail() {
        $data = array();
        $data['email'] = $_SESSION['user']->email;
        $data['fullname'] = $_SESSION['user']->fullname;
        $data['address'] =  $_SESSION['user']->address;
        $data['phone'] =  $_SESSION['user']->phone;
        $data['userId'] = $_SESSION['user']->id;
        
        if(isset($_GET['id'])) {
            $orderId = $_GET['id'];
            $data['order'] = $this->order->getOrderById($orderId);
            $data['orderitems'] = $this->orderitem->getOrderItemsByOrderId($orderId);
        }
        $this->view('user/order_detail', $data); 
    }
}