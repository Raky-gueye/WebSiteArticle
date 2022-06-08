<?php
 
try {
   $DB=new pdo("mysql:host=localhost;dbname=mglsi_news;charset=utf8", "root", "");
     
     $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

} catch (Exception $e) 
{
  $e->getMessage();
}
  
   
  
  
?>
