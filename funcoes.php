<?php
require_once "formulario.php";

//---GERAR TOKEN 
//O JWT é separado em 3 partes separdos por "."-> header,payload,signature
         //utiliza-se o alg "HS256" --pesquisar

//------PARTE I -> HEADER
function separarToken(){     
    $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';
// Verificar se o campo empresa está vazio
if (empty($empresa)) {
    echo "Por favor, insira o nome da empresa.";
     return;
 }    
$header=[
    'alg'=>'HS256',
    'typ'=>'JWT'
];

//converter o array em um objeto com o nome da mesma varivel
$header= json_encode($header);

$header= base64_encode($header);//codificar em base64 ---pesquisar
//var_dump($header);
//echo("cabeçalho:".$header."<br>");

//------PARTE II -> PAYLOAD
        //iss,aud,exp
        //dias,horas,min.seg
date_default_timezone_set('America/Sao_Paulo');
$time_validate= time() + (7 * 24 * 60 * 60);
//$time_validate= time() + (60);
//echo "Data atual:". date("d-m-Y H:i:s") . "<br> Data de vencimento:" . date("Y-m-d H:i:s",$time_validate) ."<br>";    

$payload=[
    //"iss"=>"localhost",
    //"aud"=> 'localhost',
    "exp"=> $time_validate,
    "nome"=> $empresa,
   // "data" => "data"

];
//atribuir a uma variavel a empresa que está no objeto
 
$nome = $payload['nome'];

//converter o array em um objeto com o nome da mesma varivel
$payload= json_encode($payload);
$payload= base64_encode($payload);//codificar em base64 ---pesquisar
//echo ('Payload: '.$payload. "<br>");


//------PARTE III -> SIGNATURE
    //ultilizar o header + payload e o algoritmo = HS256 com sha256 e a secretkey
    //chave que valida e gera o tokem completo
    $secretkey= "202423DGTEPP8";
    
    $signature= hash_Hmac('sha256',"$header.$payload",$secretkey,true);


$signature= base64_encode($signature);//codificar em base64 ---pesquisar
//echo"Signature:".$signature. " <br/>";
echo "<b>Token completo:<b/>"."$header.$payload.$signature";

}

