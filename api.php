<?php
header('Content-Type: application/json');
require('include/parser.php');
$cardapio = getMenu();
    
if ($cardapio == false) {
    echo "{}";
} else {
    echo json_encode($cardapio, JSON_PRETTY_PRINT);
}
?>