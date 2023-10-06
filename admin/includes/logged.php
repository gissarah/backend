<?php

session_start(); 
if(!isset($_SESSION["logged"]) or !$_SESSION["logged"]){
  header("Location: login.php");
  die();
}// code session

//   الكود ده لتحقق من انه تم الدخول للصفحات عن طريق صفحة الدخول 
//  الشرط يقول انه لو لم يوجد تسجيل دخول او قيمتة لا تساوي ترو حولني لصفحة الدخول 

?>