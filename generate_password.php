<?php
$password = 'qwerty!@#$%'; 
$hash = password_hash($password, PASSWORD_DEFAULT); 
echo $hash;
?>
