<?php
$password = "abc";

$encrypted_password = password_hash($password, PASSWORD_DEFAULT);

echo $password . "<br>";

echo $encrypted_password . "<br>";
?>