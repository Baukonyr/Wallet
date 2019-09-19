<?php
 //подключаем функции
include_once('function/hashing.php');
include_once('function/curlFunction.php');
include_once('function/validateFunction.php');
include_once('function/cryptFunction.php');

// Получаем данные
$json = (file_get_contents('php://input'));

//Проверяем данные.

$errorArray =  validateFunction($json);

  if($errorArray['countItem']< 8){
    unset($errorArray['countItem']);
    
    $data['errors'] = $errorArray;
    echo json_encode($data);
    
  }else{
    $hash = hashing($json);
    
    $data = encryptionFunction($json);

    $array['data'] = $data;
    $array['hash'] = $hash;
    
    
    $json = json_encode($array);
    $url = 'http://localhost/Wallet/endpoint3.php';
    
    $response = curlFunction($url, $json);
    
    echo $response; 
  }

?>