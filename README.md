# 📘 API de Avaliações

API simples em PHP para **listar** e **adicionar** avaliações armazenadas em um arquivo `avaliacoes.json`.

---

## ⚙️ Funcionalidades

| Método           | Descrição                                 |
| **GET**          | Retorna todas as avaliações salvas.       |
| **POST**         | Adiciona uma ou mais novas avaliações.    |
| **PUT**          | Atualiza uma avaliação existente pelo ID. |
| **DELETE**       | Remove uma avaliação existente pelo ID.   |
 
---

## 📂 Estrutura do JSON

```json
{
  "Avaliacoes": {
    "1": { 
        "autor": "Emerson", 
        "comentario": "Comida caseira e deliciosa!" 
    },
    "2": { 
        "autor": "Guilherme",
        "comentario": "Praticidade e qualidade!" 
    }
  }
}
```

---

## 📥 Exemplo de Requisição

### 🔹 GET

    http://localhost/reforco_api/api_para_pi/exercicio_cafe4/api_avaliacoes.php



### 🔹 POST

    http://localhost/reforco_api/api_para_pi/exercicio_cafe4/cliente_post.php

### 🔹 PUT
Atualiza uma avaliação existente pelo ID (passado na URL).

```
"http://localhost/reforco_api/api_para_pi/exercicio_cafe4/api_avaliacoes.php?id=1"

{"avaliacoes": "Marmita chegou quentinha e bem temperada!"}'
```

**Resposta:**
```json
{
  "mensagem": "Avaliação 1 atualizada com sucesso!"
}
```

---

### 🔹 DELETE

Remove uma avaliação específica pelo ID.

```

"http://localhost/reforco_api/api_para_pi/exercicio_cafe4/api_avaliacoes.php?id=3"

```

**Resposta:**
```json
{
  "mensagem": "Avaliação 3 removida com sucesso!"
}
```


**Resposta:**
```json
{
  "mensagem": "Avaliação(ões) adicionada(s) com sucesso!",
  "novas": [{ "autor": "João", "comentario": "Muito bom!" }]
}
```

## 💻 Exemplo de Cliente PHP

O código abaixo mostra como **enviar avaliações** diretamente via PHP, usando `file_get_contents()` com contexto HTTP:

```php

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

```

---

### 🧠 Explicação:

- **`$url`** → endereço da API.  
- **`$dados`** → array com uma ou mais avaliações.  
- **`json_encode()`** → converte o array PHP para JSON.  
- **`stream_context_create()`** → cria o contexto HTTP com método, cabeçalho e corpo da requisição.  
- **`file_get_contents()`** → envia o POST e recebe a resposta JSON da API.  
- **`echo $resultado;`** → exibe a resposta da API no navegador ou console.

---

## ⚠️ Erros Comuns

| Código | Mensagem                            |Causa                                   |
| 404    | Arquivo de avaliações não encontrado| O arquivo `avaliacoes.json` não existe |
| 405    | Método não suportado                | Método diferente de GET/POST           |
| 500    | Erro ao processar JSON              | JSON corrompido ou malformado          |

---

## 📁 Estrutura Recomendada

```
/apiexercicio_cafe4
 ├── api_avaliacoes.php
 ├── avaliacoes.json
 ├── cliente_POST.php
 ├── cliente_PUT.php
 └── cliente_DELETE.php

```
