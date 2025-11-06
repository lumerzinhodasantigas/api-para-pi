<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");


$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {

    case 'GET':
        metodoGET();
        break;

    case 'POST':
        metodoPOST();
        break;

    case 'PUT':
        $id = $_GET['id'];
        atualizar_avaliacao($id);
        break;

    case 'DELETE':
        $id = $_GET['id'];
        deletar_avaliacao($id);
        break;

    default:
        echo json_encode(["erro" => "Método não suportado"]);
        break;
}

function metodoGET() {
    $arquivo = "avaliacoes.json";

    if (!file_exists($arquivo)) {
        echo json_encode(["erro" => "Arquivo de avaliações não encontrado."]);
        return;
    }

    $avaliacoes = json_decode(file_get_contents($arquivo), true);

    // Retorna todas as avaliações
    echo json_encode($avaliacoes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

function metodoPOST() {
    $novasAvaliacoes = json_decode(file_get_contents("php://input"), true);
    $arquivo = "avaliacoes.json";

    $avaliacoes = json_decode(file_get_contents($arquivo), true);

    /*  Verifica se foi enviada apenas uma avaliação e, se sim, 
        coloca ela dentro de um array para que o foreach funcione 
        igual para uma ou várias avaliações. */
        
    if (isset($novasAvaliacoes["autor"])) {
        $novasAvaliacoes = [$novasAvaliacoes];
    }

    // Agora percorremos cada avaliação recebida (uma ou várias)
    foreach ($novasAvaliacoes as $nova) {
        $novoId = count($avaliacoes["Avaliacoes"]) + 1;

        // Cria uma nova entrada dentro do array "Avaliacoes" com o novo ID como chave
        $avaliacoes["Avaliacoes"][$novoId] = [
            "autor" => $nova["autor"],           
            "comentario" => $nova["comentario"]
        ];
    }


    file_put_contents($arquivo, json_encode($avaliacoes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo json_encode([
        "mensagem" => "Avaliação(ões) adicionada(s) com sucesso!",
        "novas" => $novasAvaliacoes
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}

function atualizar_avaliacao(string $id){
 
    $arquivo_json = "avaliacoes.json"; // Para salvar depois
    $avaliacoes = json_decode(file_get_contents($arquivo_json), true);
 
 
    foreach($avaliacoes as $avaliacao){
       
        foreach($avaliacao as $posicao => $dados){
           
            if ($id == $posicao){
 
                $avaliacao_atualizado = json_decode(file_get_contents("php://input"), true);
 
       
                $avaliacoes['Avaliacoes'][$posicao]['comentario'] = $avaliacao_atualizado['avaliacoes'];
             
                file_put_contents($arquivo_json, json_encode($avaliacoes, JSON_PRETTY_PRINT));
 
                echo "Avaliação $id atualizada!";
               
                break 2;
            }
        }
    }
 
}
 
function deletar_avaliacao($id){
 
        $arquivo_json = "avaliacoes.json";
        $avaliacoes = json_decode(file_get_contents($arquivo_json), true);
 
        foreach($avaliacoes['Avaliacoes'] as $posicao => $dados){
            
            if ($id == $posicao){
                unset($avaliacoes['Avaliacoes'][$posicao]);
 
                 file_put_contents($arquivo_json, json_encode($avaliacoes, JSON_PRETTY_PRINT));
                break;
            }
 
         
           
        }    
}

?>