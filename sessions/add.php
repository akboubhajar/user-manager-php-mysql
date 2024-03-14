<?php

$ref = $_GET['ref'];
$qty = $_GET['qty'];

session_start();

$_SESSION['panier'][$ref] = isset($_SESSION['panier'][$ref]) ? $_SESSION['panier'][$ref] + $qty : $qty;

echo json_encode($_SESSION['panier']);

// header('location:/');