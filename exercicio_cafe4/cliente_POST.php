<?php
$url = "http://localhost/reforco_api/exercicio_cafe4/api_avaliacoes.php"; 

$dados = [
    ["autor" => "João", "comentario" => "Entrega rápida e comida deliciosa! Simplesmente incrível o talento dessa moça para cozinhar"],
    ["autor" => "Luiza", "comentario" => "Gostei muito! Além de um preço bem acessível a comida dela é deliciosa, ansiosa para comprar novamente!"]
];

$opcoes = [
    "http" => [
        "header"  => "Content-type: application/json",
        "method"  => "POST",
        "content" => json_encode($dados)
    ]
];

$contexto = stream_context_create($opcoes);
$resultado = file_get_contents($url, false, $contexto);

echo $resultado;
?>