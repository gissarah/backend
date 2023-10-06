<?php
// logged check 
include_once("includes/logged.php");

if( isset($_GET["id"])){
  include_once("includes/conn.php");
  $id= $_GET["id"];

  try{
  
    $sql ="DELETE FROM `cars` WHERE id = ? ";
    $stmt= $conn -> prepare($sql);
    $stmt -> execute([$id]);
   
   echo "Delete successfully";
   
   }catch(PDOException $e){
    
    echo "Connection failed: " . $e->getMessage();
  
  }
  
}else{
  echo "invalid request";
}


 

?>