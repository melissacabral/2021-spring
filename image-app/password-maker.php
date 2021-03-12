<?php 
$desired_password = 'password';

echo password_hash($desired_password, PASSWORD_DEFAULT);