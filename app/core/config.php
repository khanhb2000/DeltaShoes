<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define('DB_NAME', 'assignment_web');
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    
    define('ROOT', 'http://localhost/assignment-ltw/public');
    define('APPROOT', dirname(dirname(__FILE__)));
    //define('VIEWSURL', 'http://localhost/assignment-ltw/app/views');
    //definr('')
}
