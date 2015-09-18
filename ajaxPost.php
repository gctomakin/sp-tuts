<?php
// autoload class
include 'autoload.php';

function clean_fields($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$users_vo->setUsername(clean_fields($_POST["username"]));
$users_vo->setPassword(clean_fields($_POST["password"]));

echo $users_dao->insert($users_vo);





?>