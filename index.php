<!doctype html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
   <style>
   .error{
     color :red;
   }
   </style>
    <title></title>
  </head>
  <body>
    <div class="container">
      <form id="formUser" method="POST" action="#">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
          <label  for="name" id="nameError"></label>
        </div>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
          <label  for="name" id="emailError"></label>
        </div>
        <div class="form-group">
          <label for="bday">yours birthday</label>
          <input type="date" id="bday" name="bday" max="3000-12-31" 
            min="1000-01-01" class="form-control">
            <label  for="name" id="bdayError"></label>
        </div> 
        <div class="form-group">
          <label for="text">Some text</label>
          <textarea class="form-control" id="text" name="text" rows="3"></textarea>
          <label for="name" id="textError"></label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <div class="container" id="resultName">
      
    </div>
    <div class="container" id="resultEmail">
      
    </div>
    <div class="container" id="resultBday">
      
    </div>
    <div class="container" id="resultText">
      
    </div>
    
    <script>
    $(document).ready(function(){
     $('#formUser').validate({
        rules: {
          name: {
            required: true,
            rangelength: [4, 20]
          },
          email: {
            required: true,
            email: true
          },
          bDay: {
            required: true,
            date: true
          },
          text: {
            required: true,
            rangelength: [15, 50]
          }
        },
        submitHandler:function(e){
          
          var array = {
            "name": $('#name').val(),
            "email": $('#email').val(),
            "bday": $('#bday').val(),
            "text": $('#text').val(),
          };
          var data = JSON.stringify(array);
          
          $.ajax({
            url:"/Wallet/endpoint2.php",
            data: data,
            type: "POST",
            contentType:"application/json",
            dataType: "JSON",
            success: function(responce){

              if(responce.errors){
              
              for(key in responce.errors){
                for(item in responce.errors[key]){
                  if(responce.errors[key][item] != 1){
                    $("#" + key + "Error").append(responce.errors[key][item]);
                  }
                }
              }
              
              }else{
                $('#resultName').append(responce.name);
                $('#resultEmail').append(responce.email); 
                $('#resultBday').append(responce.bday);
                $('#resultText').append(responce.text);
              }
            },
          });
        
        }
      });
  });
    </script>
  </body>
</html>
