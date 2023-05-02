<?php

class Controller {
    public function view($page, $data = []) {
        if (!empty($data)) extract($data);
        $filename = "../app/views/".$page.".php";
        if (!file_exists($filename))
            $filename = "../app/views/notfound.php";
        require_once $filename;
    }
}