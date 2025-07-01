<?php

if(!isset($_SESSION))
session_start();

if($_SESSION)
session_destroy();
header("Location:login.php");



?>