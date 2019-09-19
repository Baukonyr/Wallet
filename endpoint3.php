<?php

include_once('function/hashing.php');
include_once('function/cryptFunction.php');

$json = file_get_contents('php://input');

$json = json_decode($json, true);


$json['data'] = decryptionFunction($json['data']); // данные декодированные

$hash1 = $json['hash'];
$hash2 = hashing($json['data']);



if($hash2 === $hash1){
  echo $json['data'];
}else{
  echo 0;
}

?>