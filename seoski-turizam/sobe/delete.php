<?php 
require_once '../config.php';

if(!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

require_once '../classes/Soba.php';
$soba = new Soba();

if($soba->delete($_GET['id'], $_SESSION['user_id'])) {
    header("Location: index.php?success=deleted");
} else {
    header("Location: index.php?error=delete");
}
exit();