# YouTube Video Randomizer

## Sobre o Projeto

**Declaração de Transparência:** Esta atividade foi 100% gerada por Inteligência Artificial (IA). Como parte da entrega, irei disponibilizar o prompt exato utilizado para a geração da IA junto ao código inteiro e às documentações técnicas. A ideia é ser transparente sobre o desenvolvimento auxiliado por IA e demonstrar o pleno funcionamento dos requisitos solicitados.

O sistema é uma aplicação web simples construída em **PHP** e **Bootstrap**. Sua finalidade é receber uma palavra-chave aleatória fornecida pelo usuário, realizar uma busca interagindo com o YouTube, e retornar um link de um vídeo também aleatório que tenha a palavra informada no título.

## Tecnologias Utilizadas
- **Backend:** PHP puro utilizando `cURL` para requisições HTTP.
- **Frontend:** HTML5 e Bootstrap 5 (via CDN).
- **API Externa:** [YouTube Data API v3](https://developers.google.com/youtube/v3).

## Estrutura dos Arquivos da Entrega
Conforme solicitado na atividade, os requisitos foram divididos da seguinte forma:
* `index.php`: Contém a junção do código front-end (Bootstrap) e lógica back-end (PHP/cURL).
* `prompt_utilizado.txt`: O enunciado exato que passei para a Inteligência Artificial.
* `documento_planejamento.md`: Visão arquitetural, fluxo da requisição e das telas do software.
* `documento_api.md`: Detalhes sobre a YouTube Data API v3, autenticação, requisições e respostas.

## Como Executar Localmente
Caso você queira rodar o projeto em sua máquina:
1. Faça o download ou clone destes arquivos.
2. Mova a pasta para o diretório raiz do seu servidor local web (como a pasta `www` do WAMP ou `htdocs` do XAMPP).
3. Abra o arquivo `index.php` num editor de código e preencha a variável `$apiKey` (logo no topo do arquivo PHP) com a sua própria **Chave de API do YouTube**. (Você pode gerar uma no [Google Cloud Console](https://console.cloud.google.com/)).
4. Abra o seu navegador e bata na URL do localhost correspondente: `http://localhost/A_PASTA_ONDE_VOCE_CLONOU/index.php`.
