<?php
    
    $url = "http://localhost/reforco_api/api_para_pi/exercicio_cafe4/api_avaliacoes.php?id=3";
 
 
    $estrutura_http = [
        'http' => [
            'method' => 'DELETE',
            'header' => 'Content-Type: application/json\r\n',
        ]
    ];
 
    $contexto = stream_context_create($estrutura_http);
 
    $resposta = file_get_contents($url, false, $contexto);
 
    echo $resposta;

?>