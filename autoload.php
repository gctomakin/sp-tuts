<?php

function __autoload($class){
	require $class.'.php';
}

//Database instance
$db = Database::getInstance();
//UsersDAO instance using dependency injection of Database instance as parameter
$users_dao = new UsersDAO($db);
//UsersVO instance
$users_vo = new UsersVO();

?>