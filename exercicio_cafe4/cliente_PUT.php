<?php
 
    $url = "http://localhost/reforco_api/api_para_pi/exercicio_cafe4/api_avaliacoes.php?id=1";
 
    $avaliacoes = [ 
        'avaliacoes' => 'Marmita chegou quentinha e bem temperada!'
    ];
 
    $estrutura_http = [
        'http' => [
            'method' => 'PUT',
            'header' => 'Content-Type: application/json\r\n',
            'content' => json_encode($avaliacoes)
        ]
    ];
 
    $contexto = stream_context_create($estrutura_http);
 
    $resposta = file_get_contents($url, false, $contexto);
 
    echo $resposta;

?>