<?php
$password_plain = 'admin123'; // parola dorită
$hash = password_hash($password_plain, PASSWORD_DEFAULT);
echo $hash;
