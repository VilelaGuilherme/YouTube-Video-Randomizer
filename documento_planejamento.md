# Documento de Planejamento

## Objetivo
Desenvolver uma aplicação web simples que recebe uma palavra informada pelo usuário e retorna um link para um vídeo aleatório do YouTube cujo título contenha a mesma palavra.

## Tecnologias Utilizadas
- **Backend:** PHP para o processamento da requisição HTTP (via cURL) e manipulação dos dados da API.
- **Frontend:** HTML5 e Bootstrap 5 para a construção da interface do usuário de forma responsiva e agradável.
- **Integração:** YouTube Data API v3 para buscar os vídeos no servidor do YouTube.

## Fluxo da Aplicação
1. O usuário acessa a página principal (index.php).
2. O usuário preenche o formulário informando uma palavra chave e clica em "Buscar Vídeo".
3. A mesma página processa a requisição (POST). O código PHP captura essa palavra.
4. O backend PHP faz uma requisição para a `YouTube Data API` passando a palavra como parâmetro de busca.
5. A API retorna os resultados em formato JSON. O sistema seleciona de forma aleatória um vídeo entre os itens retornados (que é no máximo 50 por vez, limitados ao design da pesquisa).
6. O PHP envia o ID e o título do vídeo aleatório sorteado para o frontend, construindo o link final.
7. A interface atualiza automaticamente mostrando o título e o link para o usuário clicar e acessar.

## Arquitetura de Pastas
A aplicação é entregue dentro de um único pacote, compreendendo os seguintes arquivos:
- `index.php`: Código fonte contendo tanto a apresentação quanto a lógica de sistema.
- `prompt_utilizado.txt`: Enunciado/prompt do usuário fornecido.
- `documento_planejamento.md`: Este documento.
- `documento_api.md`: Documentação descrevendo os detalhes de consumo e uso da API.

## Requisitos de Execução
- Servidor Local com PHP configurado (WAMP / XAMPP).
- Extensão `curl` habilitada no PHP para realizar as requisições à API.
- Inserir uma chave de API válida do YouTube no local parametrizado do código (`SUA_CHAVE_DE_API_AQUI`).
