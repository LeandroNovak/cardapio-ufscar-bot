<?php
include 'cardapio.php';
include 'refeicao.php';

function find_between($content, $start, $end) {
    $aux = explode($start, $content);

    if (!isset($aux[1])) {
        return 'Não definido';
    }
    
    $aux = explode($end, $aux[1]);
    return $aux[0];
}

function find_between_span($content,  $start, $end) {
    $temp = find_between($content, $start, $start);
    return find_between($temp, "<span>", "</span>");
}

function getMenu() {
    $html = file_get_contents('https://www2.ufscar.br/restaurantes-universitario/');
    $cardapio = new Cardapio();

    if (empty($html)) {
        return false;
    }

    $cardapio->almoco = new Refeicao();
    $cardapio->jantar = new Refeicao();

    $htmlAlmoco = find_between($html, "Princ", "Prato");
    $htmlJantar = find_between($html, "<b>JANTAR</b>", "class=\"row\">");

    $cardapio->almoco->principal = find_between_span($htmlAlmoco, "ipal: </b>", "</div>");
    $cardapio->almoco->guarnicao = find_between_span($htmlAlmoco, "<b>Guarni", "</div>");
    $cardapio->almoco->arroz = find_between_span($htmlAlmoco, "<b>Arroz: </b>", "</div>");
    $cardapio->almoco->feijao = find_between_span($htmlAlmoco, "<b>Fei", "</div>");
    $cardapio->almoco->saladas = find_between_span($htmlAlmoco, "<b>Saladas: </b>", "</div>");
    $cardapio->almoco->sobremesa = find_between_span($htmlAlmoco, "<b>Sobremesa: </b>", "</div>");

    $cardapio->jantar->principal = find_between_span($htmlJantar, "<b>Prato Principal: </b>", "</div>");
    $cardapio->jantar->guarnicao = find_between_span($htmlJantar, "<b>Guarni", "</div>");
    $cardapio->jantar->arroz = find_between_span($htmlJantar, "<b>Arroz: </b>", "</div>");
    $cardapio->jantar->feijao = find_between_span($htmlJantar, "<b>Fei", "</div>");
    $cardapio->jantar->saladas = find_between_span($htmlJantar, "<b>Saladas: </b>", "</div>");
    $cardapio->jantar->sobremesa = find_between_span($htmlJantar, "<b>Sobremesa: </b>", "</div>");

    return $cardapio;
}

function getResult() {
    $cardapio = getMenu();

    if ($cardapio == false) {
        return "\nNão definido";
    }

    return "\n*ALMOÇO*\n".
        "_Prato Principal:_ ".$cardapio->almoco->principal."\n".
        "_Guarnição:_ ".$cardapio->almoco->guarnicao."\n".
        "_Arroz:_ ".$cardapio->almoco->arroz."\n".
        "_Feijão:_ ".$cardapio->almoco->feijao ."\n".
        "_Saladas:_ ".$cardapio->almoco->saladas."\n".
        "_Sobremesa:_ ".$cardapio->almoco->sobremesa."\n\n".
        "*JANTAR*\n".
        "_Prato Principal:_ ".$cardapio->jantar->principal."\n".
        "_Guarnição:_ ".$cardapio->jantar->guarnicao."\n".
        "_Arroz:_ ".$cardapio->jantar->arroz."\n".
        "_Feijão:_ ".$cardapio->jantar->feijao ."\n".
        "_Saladas:_ ".$cardapio->jantar->saladas."\n".
        "_Sobremesa:_ ".$cardapio->jantar->sobremesa."\n";
}
?>
