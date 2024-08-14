<?php
session_start();

if (isset($_GET['index']) && isset($_SESSION['mahasiswa'][$_GET['index']])) {
    $index = $_GET['index'];
    array_splice($_SESSION['mahasiswa'], $index, 1);
}

header('Location: index.php');
exit;
