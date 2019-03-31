<?php 
$upass = 'anne123';
$new_password = password_hash($upass, PASSWORD_DEFAULT);
echo $new_password;

?>