<?php
class grid_ticket_email_tpl_lookup
{
//  
   function lookup_usertype(&$usertype) 
   {
      $conteudo = "" ; 
      if ($usertype == "1")
      { 
          $conteudo = "Customer";
      } 
      if ($usertype == "2")
      { 
          $conteudo = "Staff";
      } 
      if (!empty($conteudo)) 
      { 
          $usertype = $conteudo; 
      } 
   }  
//  
   function lookup_statusid(&$conteudo , $statusid) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $statusid; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      $nm_comando = "select statusname from view_status_template where statusid = '" . substr($this->Db->qstr($statusid), 1 , -1) . "' order by statusname" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $rx->fields[0] = str_replace(',', '.', $rx->fields[0]); 
              $conteudo = $rx->fields[0]; 
          } 
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_enabled(&$enabled) 
   {
      $conteudo = "" ; 
      if ($enabled == "Y")
      { 
          $conteudo = "Yes";
      } 
      if ($enabled == "N")
      { 
          $conteudo = "No";
      } 
      if (!empty($conteudo)) 
      { 
          $enabled = $conteudo; 
      } 
   }  
}
?>