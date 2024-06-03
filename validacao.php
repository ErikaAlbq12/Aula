<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <form method="POST" action="">
     <h1>Verificar se token é valido </h1>
        <input id="validar" type="text" name="validar" placeholder="Cole o codigo token aqui">
        <br/>
        <button type="submit"> Verificar</button>
    </form>  
</div>

<?php
// ------- PARTE VALIDAÇÃO -----
// obter o valor do input por requisição  POST se estiver com texto

$data= filter_input_array(INPUT_POST,FILTER_DEFAULT);


// se o input nao estiver com dados
if (!empty($data['validar'])) {
   //colocar em array separados por '.' os dos inseridos no input
   $validar_array= explode('.', $data['validar']);
   //verificar a separação em array
   //var_dump($validar_array);
   $header=$validar_array[0];
   $payload=$validar_array[1];
   $signature=$validar_array[2];

   // Chave usada para gerar o token a mesma deve ser usada para validar o token
   $secretkey= "202423DGTEPP8";

   //usar o secret key para validar os header e o payload
   $validar_data_token= hash_hmac('sha256',"$header.$payload",$secretkey,true);

   //codificar dados em base64
   $validar_data_token= base64_encode($validar_data_token);
 
   //comparar os hash para verificar a validação
   if($signature == $validar_data_token){
     //decodificar em base64 
     $token_data= base64_decode($payload);
     
     //converter o array em um objeto com o nome da mesma varivel
     $token_data= json_decode($token_data);
     //var_dump($token_data);    
     
      //comparar pela data de validação
      if($token_data->exp > time()){
        echo"<div style='center;margin-left:38%;margin-top:20px;>TOKEN VALIDO </div>";
        
       } else{
        echo"<divstyle='center;margin-left:38%;margin-top:20px;> INVALIDO </div>";
     }
} else{
    echo "<div style='center;margin-left:38%;margin-top:20px; font:wight:600px'> 
    <b>Token invalido ou vencido.<br/> Gere outro Token ou entre em contato com o suporte</b>
    </div>";
    }
}
?>
   <link rel="stylesheet" href="css/style.css"></body>
 </body>
</html>