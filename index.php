<?php
$videoLink = null;
$error = null;
$videoTitle = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['palavra'])) {
    $palavra = urlencode($_POST['palavra']);
    
    // IMPORTANTE: Insira sua chave de API nesta variável
    $apiKey = 'AIzaSyCT6c9F2OfYV5L4IZ_8UeYYfy4zjkqQRxo'; 
    
    if ($apiKey === 'SUA_CHAVE_DE_API_AQUI') {
        $error = "É necessário configurar uma Chave de API do YouTube válida no código (linha 9) para que a busca funcione.";
    } else {
        // Obter os resultados da busca (tipo=video, maxResults=50)
        $apiUrl = "https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&maxResults=50&q={$palavra}&key={$apiKey}";
        
        // Iniciar chamada cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        // Desativa a validação do certificado SSL em ambiente local (WAMP/XAMPP)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode === 200) {
            $data = json_decode($response, true);
            if (!empty($data['items'])) {
                // Sorteia um dos vídeos retornados
                $randomIndex = array_rand($data['items']);
                $video = $data['items'][$randomIndex];
                
                $videoId = $video['id']['videoId'];
                $videoTitle = $video['snippet']['title'];
                // Constrói a URL final
                $videoLink = "https://www.youtube.com/watch?v={$videoId}";
            } else {
                $error = "Nenhum vídeo encontrado no YouTube para a palavra informada.";
            }
        } else {
            // Em caso de chave inválida ou cota excedida, a API retorna erro (ex: 403, 400).
            $error = "Erro ao conectar com a API do YouTube. Código de retorno HTTP: {$httpCode}. Verifique sua Chave de API e acesso à Internet.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorteador de Vídeos do YouTube</title>
    <!-- Adicionando Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .app-container {
            margin-top: 10vh;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .card-header {
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
            background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%);
            color: #ffffff;
        }
        .btn-custom {
            background-color: #ff0000;
            color: #ffffff;
            border: none;
        }
        .btn-custom:hover {
            background-color: #cc0000;
            color: #ffffff;
        }
    </style>
</head>
<body>

<div class="container app-container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header text-center py-3">
                    <h3 class="mb-0">YouTube Video Randomizer</h3>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted text-center mb-4">Informe uma palavra aleatória no campo abaixo. O sistema buscará no YouTube e retornará o link de um vídeo resultante da pesquisa.</p>
                    
                    <form method="POST" action="index.php">
                        <div class="mb-3">
                            <label for="palavra" class="form-label fw-bold">Palavra Aleatória:</label>
                            <input type="text" class="form-control form-control-lg" id="palavra" name="palavra" required placeholder="Ex: música, gatos, php, minecraft">
                        </div>
                        <button type="submit" class="btn btn-custom btn-lg w-100">Encontrar Vídeo</button>
                    </form>

                    <?php if ($videoLink): ?>
                        <div class="alert alert-success mt-4 p-3" role="alert">
                            <h5 class="alert-heading fw-bold mb-2">Vídeo Encontrado e Sorteado!</h5>
                            <p class="mb-1"><strong>Título:</strong> <?php echo htmlspecialchars($videoTitle); ?></p>
                            <hr>
                            <p class="mb-0">
                                <strong>Link:</strong> <br>
                                <a href="<?php echo htmlspecialchars($videoLink); ?>" target="_blank" class="text-break fw-bold text-success text-decoration-none">
                                    <?php echo htmlspecialchars($videoLink); ?>
                                </a>
                            </p>
                        </div>
                    <?php elseif ($error): ?>
                        <div class="alert alert-danger mt-4 p-3" role="alert">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="card-footer bg-white text-center text-muted border-0 pb-3">
                    <small>Atividade Prática - Usando PHP e Bootstrap</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
