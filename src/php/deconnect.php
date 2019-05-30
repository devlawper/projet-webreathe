<?php 
// Destruction des sessions en cours
session_start();
session_destroy();
header('location:../index.php');