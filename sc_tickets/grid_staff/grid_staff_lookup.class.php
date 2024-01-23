<?php
class grid_staff_lookup
{
//  
   function lookup_adminflag(&$adminflag) 
   {
      $conteudo = "" ; 
      if ($adminflag == "Y")
      { 
          $conteudo = "Administrator";
      } 
      if ($adminflag == "N")
      { 
          $conteudo = "Operator";
      } 
      if (!empty($conteudo)) 
      { 
          $adminflag = $conteudo; 
      } 
   }  
}
?>
