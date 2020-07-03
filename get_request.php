<?php 

session_start();
$_SESSION['amount'] += 3;
echo $_SESSION['amount'];