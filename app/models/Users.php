<?php

class Users {
    use Model;
    protected $table = 'users';
    public function get() {
        return $this->select();
    }

    public function check_user($email) {
        $sql = "SELECT * FROM users WHERE email = '$email'";
		$result = $this->query($sql);
		return $result;    
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
		$result = $this->query($sql);
		return $result;    
    }

    public function signup($email, $password, $phone, $address, $fullname) {
        $sql = "INSERT INTO users (email, password, phone, address, fullname)
							VALUES ('$email', '$password', '$phone', '$address','$fullname')";
        $result = $this->query($sql);
    }
    public function changepassword($email, $newPassword){
        $sql ="UPDATE users SET password = '$newPassword' WHERE email = '$email'";
        $result = $this->query($sql);
    }

    public function update($email, $phone, $address, $fullname) {
        $sql = "UPDATE users SET phone = '$phone', address = '$address', fullname  = '$fullname' WHERE email = '$email'";
        $this->query($sql);
    }
}