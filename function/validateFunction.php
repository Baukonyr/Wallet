<?php


function validateFunction($data){
  
  
  $array = json_decode($data, true);
 
  /* $array = [
  "name" => '1',
  "email" => 'asd',
  "bday" => '123',
  "text" => 'sds'
  ]; */
  
  $error['countItem'] = 0;
  
  foreach($array as $key => $value){
    
    Switch($key){
      case "name":
        $error[$key]['empty'] = validateEmpty($value);
        $error[$key]['length'] = validateLength($value, 4, 20);
        break;
      case "email":
        $error[$key]['empty'] = validateEmpty($value);
        $error[$key]['email'] = validateEmail($value);
        break;
      case "bday":
        $error[$key]['empty'] = validateEmpty($value);
        $error[$key]['date'] = validateDate($value);
        break;
      case "text":
        $error[$key]['empty'] = validateEmpty($value);
        $error[$key]['length'] = validateLength($value, 15, 50);
        break;
    }
    $error['countItem'] += array_sum($error[$key]);
    
  }
  return $error;
  
}





function validateLength(string $string, int $min, int $max){
  $result = !(mb_strlen($string) < $min || mb_strlen($string > $max));
  
  if($result){
    return 1;
  }else{
    return "Please enter a value between $min and $max characters long.";
  }
}

function validateEmail($email){
  $result = filter_var($email, FILTER_VALIDATE_EMAIL); 
  
  if($result){
    return 1;
  }else{
    return "Please enter a valid email address.";
  }
}

function validateEmpty($string){
  $result = !empty($string);
  
  if($result){
    return 1;
  }else{
    return "This field is required.";
  }
}

function validateDate($date){
  $result = preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date);
  
  if($result){
    return 1;
  }else{
    return "this field must be a date";
  }
}


?>