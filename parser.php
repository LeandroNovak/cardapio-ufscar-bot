<?php

include('simple_html_dom.php');

function find_between($content,$start,$end){
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return 'Não definido';
}

function getResult() {
    $html = file_get_contents('https://www2.ufscar.br/restaurantes-universitario/');

    if (!empty($html)) {
        $htmlAlmoco = find_between($html, "Princ", "Prato");
        $htmlJantar = find_between($html, "<b>JANTAR</b>", "class=\"row\">");

        $temp = find_between($htmlAlmoco, "ipal: </b>", "</div>");
        $aPratoPrincipal = find_between($temp, "<span>", "</span>");
        $temp = find_between($htmlAlmoco, "<b>Guarni", "</div>");
        $aGuarnicao = find_between($temp, "<span>", "</span>");
        $temp = find_between($htmlAlmoco, "<b>Arroz: </b>", "</div>");
        $aArroz = find_between($temp, "<span>", "</span>");
        $temp = find_between($htmlAlmoco, "<b>Fei", "</div>");
        $aFeijao = find_between($temp, "<span>", "</span>");
        $temp = find_between($htmlAlmoco, "<b>Saladas: </b>", "</div>");
        $aSaladas = find_between($temp, "<span>", "</span>");
        $temp = find_between($htmlAlmoco, "<b>Sobremesa: </b>", "</div>");
        $aSobremesa = find_between($temp, "<span>", "</span>");
        $temp = find_between($htmlAlmoco, "<b>Bebida: </b>", "</div>");
        $aBebida = find_between($temp, "<span>", "</span>");

        $temp = find_between($htmlJantar, "<b>Prato Principal: </b>", "</div>");
        $jPratoPrincipal = find_between($temp, "<span>", "</span>");
        $temp = find_between($htmlJantar, "<b>Guarni", "</div>");
        $jGuarnicao = find_between($temp, "<span>", "</span>");
        $temp = find_between($htmlJantar, "<b>Arroz: </b>", "</div>");
        $jArroz = find_between($temp, "<span>", "</span>");
        $temp = find_between($htmlJantar, "<b>Fei", "</div>");
        $jFeijao = find_between($temp, "<span>", "</span>");
        $temp = find_between($htmlJantar, "<b>Saladas: </b>", "</div>");
        $jSaladas = find_between($temp, "<span>", "</span>");
        $temp = find_between($htmlJantar, "<b>Sobremesa: </b>", "</div>");
        $jSobremesa = find_between($temp, "<span>", "</span>");
        $temp = find_between($htmlJantar, "<b>Bebida: </b>", "</div>");
        $jBebida = find_between($temp, "<span>", "</span>");

        return  "---------------\n".
                "ALMOÇO\n".
                "---------------\n".
                "Prato Principal: ".$aPratoPrincipal ."\n".
                "Guarnição: ".$aGuarnicao ."\n".
                "Arroz: ".$aArroz ."\n".
                "Feijão: ".$aFeijao ."\n".
                "Saladas: ".$aSaladas ."\n".
                "Sobremesa: ".$aSobremesa ."\n".
                "Bebida: ".$aBebida ."\n".
                "---------------\n".
                "JANTAR\n".
                "---------------\n".
                "Prato Principal: ".$jPratoPrincipal ."\n".
                "Guarnição: ".$jGuarnicao ."\n".
                "Arroz: ".$jArroz ."\n".
                "Feijão: ".$jFeijao ."\n".
                "Saladas: ".$jSaladas ."\n".
                "Sobremesa: ".$jSobremesa ."\n".
                "Bebida: ".$jBebida ."\n";
    } else {
        return "\nNão definido";
    }
}

?>
