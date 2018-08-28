<?php
session_start();
$username=$_GET['username'];
if(!isset($_SESSION['admin']))
    $_SESSION['admin']=$username;
