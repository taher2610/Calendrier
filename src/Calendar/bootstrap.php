<?php

function e404 (){
    require '../public/404.php';
    exit();
}

function dd (...$vars){
    foreach($vars as $var){
        echo '<pre>';
        print_r($val);
        echo '</pre>';
    }
}
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'calendrier';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
 function get_pdo ():\PDO {
    return new \PDO('mysql:host=localhost;dbname=calendrier','root','',[
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
    ]);
} 
 function h (string $value):string {
    if ($value === null){
        return '';
    }
    return htmlentities($value);
} 

function render(string $view, $parameters = []){
    extract($parameters);
    include "../views/{$view}.php";
}

?>