<?php



$pwd = "Abc123!@#";
$hsh = password_hash($pwd, PASSWORD_BCRYPT);
echo strlen($hsh);
echo $hsh;