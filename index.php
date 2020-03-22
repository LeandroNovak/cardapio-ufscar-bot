<!DOCTYPE html>
<html lang="pt-br">
<meta charset="utf-8"> 
<title>Cardápio UFSCar Bot</title>
<body>
<h1>Cardápio UFSCar Bot</h1>
<?php
require('include/parser.php');
$cardapio = getMenu();

if ($cardapio == false) {
    echo "<h4>Não definido</h4>";
}
else {
    echo "<h4>ALMOÇO</h4>".
    "<i>Prato Principal:</i> ".$cardapio->almoco->principal."<br>".
    "<i>Guarnição:</i> ".$cardapio->almoco->guarnicao."<br>".
    "<i>Arroz:</i> ".$cardapio->almoco->arroz."<br>".
    "<i>Feijão:</i> ".$cardapio->almoco->feijao ."<br>".
    "<i>Saladas:</i> ".$cardapio->almoco->saladas."<br>".
    "<i>Sobremesa:</i> ".$cardapio->almoco->sobremesa."<br><br>".
    "<h4>JANTAR</h4>".
    "<i>Prato Principal:</i> ".$cardapio->jantar->principal."<br>".
    "<i>Guarnição:</i> ".$cardapio->jantar->guarnicao."<br>".
    "<i>Arroz:</i> ".$cardapio->jantar->arroz."<br>".
    "<i>Feijão:</i> ".$cardapio->jantar->feijao ."<br>".
    "<i>Saladas:</i> ".$cardapio->jantar->saladas."<br>".
    "<i>Sobremesa:</i> ".$cardapio->jantar->sobremesa."<br>";
}
?>
</body>
</html>
