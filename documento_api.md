# Documento da API

## API Utilizada
A aplicação consome a **YouTube Data API v3**. Esta é a API oficial fornecida pelo Google para que desenvolvedores possam interagir com recursos do YouTube, integrando vídeos, pesquisas e playlists às suas próprias aplicações.

`Documentação Oficial: https://developers.google.com/youtube/v3/docs/search/list`

## Pré-requisitos
Para o funcionamento correto, o serviço depende da criação e validação de uma conta no `Google Cloud Console`.
1. Acesse o [Google Cloud Console](https://console.cloud.google.com/).
2. Crie ou selecione um projeto.
3. Clique em **Ativar APIs e Serviços** e busque por **YouTube Data API v3**. Habilite a API em seu projeto.
4. Vá em **Credenciais**, clique em **Criar Credenciais** e selecione **Chave de API**.
5. Substitua a string `SUA_CHAVE_DE_API_AQUI` do arquivo `index.php` por sua Chave recém-criada.

## Parâmetros da Requisição

O sistema fará a requisição de busca usando a url base: 
`https://www.googleapis.com/youtube/v3/search`

Os seguintes parâmetros (*query parameters*) são enviados na chamada GET, através do cURL no PHP:
- `part=snippet`: Indica as propriedades do recurso que devem ser retornadas (ex: id, título, descrição).
- `type=video`: Restringe a busca apenas para resultados que sejam "vídeos" (ignorando canais ou playlists).
- `maxResults=50`: Definição da coleta. A API permite até 50 vídeos por página. Isso amplia o escopo aleatório.
- `q={palavra}`: Este parâmetro recebe a palavra que o usuário digitou no frontend, já tratada (`urlencode`) para não quebrar o link.
- `key={API_KEY}`: A credencial com a sua chave da API.

## Resposta da API
A API do YouTube devolverá os registros em uma string codificada em `JSON`.
Do lado do Backend (PHP), os dados são transformados em um Array Associativo através de `json_decode`, de onde o sistema isola a chave `['items']`.

Os dados essenciais são assim mapeados:
- O índice gerado aleatoriamente escolhe um item entre os resultados em `$item = data['items'][index]`.
- Código do Vídeo: `$item['id']['videoId']`.
- Título do Vídeo: `$item['snippet']['title']`.

Por fim, o vídeo e a URL completa do YouTube `https://www.youtube.com/watch?v={videoId}` serão mesclados ao Bootstrap e exibidos na tela para o usuário.
