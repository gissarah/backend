<?php
session_start();//---> this if data storege login if you done longin so it is you go cars page and any way donot go you login page
//  الكود لو لو الشيشن موجود و قيمتة ترو نفذ اللي تحت 
if(isset($_SESSION["logged"]) && $_SESSION["logged"]){
  header("Location:cars.php");
  die();
} ////// code coplete session /////////////////////

if($_SERVER["REQUEST_METHOD"]==="POST"){
  // this connection with conn page to conect with database
  include_once("includes/conn.php");
  //this take value from user two ways request (method in form) 1-post , 2- get
  $pass= $_POST["password"] ;
  $email=$_POST["email"];

  // this conection SQL_database inser or delect or select or delete by var $sql.
  // ? this mean the value i enter as a var to security database.
  //
  try{

    $sql="SELECT `password` FROM `login` WHERE `email` = ? AND `active` = 1";
    $stmt = $conn->prepare($sql);
    //in this code inter value as a var to security database.
    $stmt->execute([$email]);
    // to go cars page
    if($stmt-> rowCount() > 0){
      $result= $stmt -> fetch();
      $hash = $result["password"];
      $varify = password_verify($pass, $hash);
      if($varify){
        $_SESSION["logged"] = true;
        header("Location: cars.php");
        die();
      }else{
        echo"password is incorrect";
      }
    }else{
      echo"not found";
    }
  

  }catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <style>
      html, body {
      display: flex;
      justify-content: center;
      height: 100%;
      }
      body, div, h1, form, input, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 16px;
      color: #666;
      }
      h1 {
      padding: 10px 0;
      font-size: 32px;
      font-weight: 300;
      text-align: center;
      }
      p {
      font-size: 12px;
      }
      hr {
      color: #a9a9a9;
      opacity: 0.3;
      }
      .main-block {
      max-width: 340px; 
      min-height: 460px; 
      padding: 10px 0;
      margin: auto;
      border-radius: 5px; 
      border: solid 1px #ccc;
      box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
      background: #ebebeb; 
      }
      form {
      margin: 0 30px;
      }
      .account-type, .gender {
      margin: 15px 0;
      }
      input[type=radio] {
      display: none;
      }
      label#icon {
      margin: 0;
      border-radius: 5px 0 0 5px;
      }
      label.radio {
      position: relative;
      display: inline-block;
      padding-top: 4px;
      margin-right: 20px;
      text-indent: 30px;
      overflow: visible;
      cursor: pointer;
      }
      label.radio:before {
      content: "";
      position: absolute;
      top: 2px;
      left: 0;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #1c87c9;
      }
      label.radio:after {
      content: "";
      position: absolute;
      width: 9px;
      height: 4px;
      top: 8px;
      left: 4px;
      border: 3px solid #fff;
      border-top: none;
      border-right: none;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      input[type=text], input[type=password] {
      width: calc(100% - 57px);
      height: 36px;
      margin: 13px 0 0 -5px;
      padding-left: 10px; 
      border-radius: 0 5px 5px 0;
      border: solid 1px #cbc9c9; 
      box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
      background: #fff; 
      }
      input[type=password] {
      margin-bottom: 15px;
      }
      #icon {
      display: inline-block;
      padding: 9.3px 15px;
      box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
      background: #1c87c9;
      color: #fff;
      text-align: center;
      }
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 100%;
      padding: 10px 0;
      margin: 10px auto;
      border-radius: 5px; 
      border: none;
      background: #1c87c9; 
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      }
      button:hover {
      background: #26a9e0;
      }
    </style>
  </head>
  <body>
    <div class="main-block">
      <h1>Login</h1>
      <form action="" method ="POST">
        <hr>
        <label id="icon" for="name"><i class="fas fa-user"></i></label>
        <input type="text" name="email" id="email" placeholder="email" required/>
        <label id="icon" for="password"><i class="fas fa-unlock-alt"></i></label>
        <input type="password" name="password" id="password" placeholder="Password" required/>
        <hr>
        <div class="btn-block">
          <button type="submit">Submit</button>
        </div>
      </form>
    </div>
  </body>
</html>