<?php

function encryptionFunction($data){
  
  $publicKey = file_get_contents('key/rsa.public');
  
  $pk = openssl_get_publickey($publicKey);
  
  openssl_public_encrypt($data, $encrypted, $pk);
  
  return base64_encode($encrypted);
}

function decryptionFunction($data){
  $privateKey = file_get_contents('key/rsa.private');
  
  $prk = openssl_get_privatekey($privateKey);
  
  openssl_private_decrypt(base64_decode($data), $out, $prk);
  
  return $out;

  
}

?>