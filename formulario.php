<?php
include_once "funcoes.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Token</title>
</head>
<body>
<div class="container">
    <form  method="POST" action="formulario.php">
        <h1>Gerar Token</h1>
          <h2 for="">Insira  os dados para gerar token</h2>
        <br/>
        <label for="">Empresa</label>
        <br/>
        <input  name="empresa" type="text" placeholder="Nome da empresa">
        <br/>
            <button type="submite">Gerar</button>
        <div id="numToken">
          <?php
           $token = separarToken();
           ?>
        </div>
    </form>
    <p>Para verificar validação do token <a href="validacao.php">Clique Aqui</a></p>
</div>
    <link rel="stylesheet" href="css/style.css">
</body>
</html>