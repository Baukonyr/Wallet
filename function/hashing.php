<?php

function hashing($data){
  
  $salt = include_once('key/salt.php');
  
  $hash = hash("SHA512", $data . $salt);
  
  return $hash;
}

?>