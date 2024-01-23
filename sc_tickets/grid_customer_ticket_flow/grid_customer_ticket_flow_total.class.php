<?php

class grid_customer_ticket_flow_total
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;

   var $nm_data;

   //----- 
   function __construct($sc_page)
   {
      $this->sc_page = $sc_page;
      $this->nm_data = new nm_data("en_us");
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_customer_ticket_flow']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_customer_ticket_flow']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customer_ticket_flow']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->ticketdate = (isset($Busca_temp['ticketdate'])) ? $Busca_temp['ticketdate'] : ""; 
          $tmp_pos = (is_string($this->ticketdate)) ? strpos($this->ticketdate, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->ticketdate))
          {
              $this->ticketdate = substr($this->ticketdate, 0, $tmp_pos);
          }
          $this->ticketcontent = (isset($Busca_temp['ticketcontent'])) ? $Busca_temp['ticketcontent'] : ""; 
          $tmp_pos = (is_string($this->ticketcontent)) ? strpos($this->ticketcontent, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->ticketcontent))
          {
              $this->ticketcontent = substr($this->ticketcontent, 0, $tmp_pos);
          }
          $this->ticketfile1 = (isset($Busca_temp['ticketfile1'])) ? $Busca_temp['ticketfile1'] : ""; 
          $tmp_pos = (is_string($this->ticketfile1)) ? strpos($this->ticketfile1, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->ticketfile1))
          {
              $this->ticketfile1 = substr($this->ticketfile1, 0, $tmp_pos);
          }
          $this->ticketfile2 = (isset($Busca_temp['ticketfile2'])) ? $Busca_temp['ticketfile2'] : ""; 
          $tmp_pos = (is_string($this->ticketfile2)) ? strpos($this->ticketfile2, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->ticketfile2))
          {
              $this->ticketfile2 = substr($this->ticketfile2, 0, $tmp_pos);
          }
          $this->ticketfile3 = (isset($Busca_temp['ticketfile3'])) ? $Busca_temp['ticketfile3'] : ""; 
          $tmp_pos = (is_string($this->ticketfile3)) ? strpos($this->ticketfile3, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->ticketfile3))
          {
              $this->ticketfile3 = substr($this->ticketfile3, 0, $tmp_pos);
          }
          $this->operatorid = (isset($Busca_temp['operatorid'])) ? $Busca_temp['operatorid'] : ""; 
          $tmp_pos = (is_string($this->operatorid)) ? strpos($this->operatorid, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->operatorid))
          {
              $this->operatorid = substr($this->operatorid, 0, $tmp_pos);
          }
          $this->messagetype = (isset($Busca_temp['messagetype'])) ? $Busca_temp['messagetype'] : ""; 
          $tmp_pos = (is_string($this->messagetype)) ? strpos($this->messagetype, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->messagetype))
          {
              $this->messagetype = substr($this->messagetype, 0, $tmp_pos);
          }
      } 
   }

   //---- 
   function quebra_geral()
   {
      global $nada, $nm_lang , $messagestatus, $operatorid;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customer_ticket_flow']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customer_ticket_flow']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customer_ticket_flow']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customer_ticket_flow']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customer_ticket_flow']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customer_ticket_flow']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customer_ticket_flow']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customer_ticket_flow']['contr_total_geral'] = "OK";
   } 

   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT") {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT") {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "SC_FORMAT_REGION") {
           $this->nm_data->SetaData($dt_in, strtoupper($form_in));
           $prep_out  = (strpos(strtolower($form_in), "dd") !== false) ? "dd" : "";
           $prep_out .= (strpos(strtolower($form_in), "mm") !== false) ? "mm" : "";
           $prep_out .= (strpos(strtolower($form_in), "aa") !== false) ? "aaaa" : "";
           $prep_out .= (strpos(strtolower($form_in), "yy") !== false) ? "aaaa" : "";
           return $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", $prep_out));
       }
       else {
           nm_conv_form_data($dt_out, $form_in, $form_out);
           return $dt_out;
       }
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $str_highlight_ini = "";
      $str_highlight_fim = "";
      if(substr($nm_campo, 0, 23) == '<div class="highlight">' && substr($nm_campo, -6) == '</div>')
      {
           $str_highlight_ini = substr($nm_campo, 0, 23);
           $str_highlight_fim = substr($nm_campo, -6);

           $trab_campo = substr($nm_campo, 23, -6);
           $tam_campo  = strlen($trab_campo);
      }      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($tam_campo >= $cont2)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
   } 
function GetNextTicketMessageID($ticket_id){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	$str_sql = "select count(ticketMessageid) from ticketmessage
		    where ticketid = $ticket_id";
	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

	$int_result  = $this->dataset [0][0]+1;
	return $int_result;
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function CloseTicket($ticket_id){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	if($ticket_id == ''){ return false; }
	
	$str_update = "update ticket set statusid = 'CLOSED'
	               where ticketid = $ticket_id";
	
     $nm_select = $str_update; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
	
	return true;
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function TransferTicket($ticket_id,$new_ownerid){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	if($ticket_id == ''){ return false; }
	
	if($new_ownerid == ''){
		return false;	
	}
	
	$str_update = "update ticket 
	                  set ownerid = $new_ownerid,
	                      statusid = 'ASSIGNED'
	               where ticketid = $ticket_id";
	
     $nm_select = $str_update; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      	
	
	return true;
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function UpdateTicketStatus($ticket_id,$status_id = 'REPLIED'){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  
	
	if($ticket_id == ''){ return false; }

	$str_update = "update ticket set Statusid = '$status_id'
	               where ticketid = $ticket_id";
	
     $nm_select = $str_update; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
	
	return true;
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function GetTicketSubject($ticket_id){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	if($ticket_id == ''){ return false; }
	
	$str_sql = "SELECT subject FROM ticket where ticketid = $ticket_id";
	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

	
	return $this->dataset [0][0];
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function GetTicketStatus($ticket_id){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	if($ticket_id == ''){ return false; }
	
	$str_sql = "SELECT statusid FROM ticket where ticketid = $ticket_id";
	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

	
	return $this->dataset [0][0];
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function GetTicketRating($ticket_id)
{
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  
	if($ticket_id == ''){ return false; }
	
	$str_sql = "SELECT customerrating FROM ticket where ticketid = $ticket_id";
	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

	
	return $this->dataset [0][0];
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function GetOperatorName($staffid){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	if($staffid == ''){ return false; }
	
	$str_sql = "SELECT staffname FROM staff 
	            WHERE staffid = $staffid";
	            
	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

	
	return $this->dataset [0][0];
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function GetCustomerTicket($ticket_id){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	if($ticket_id == ''){ return false; }
	
	$str_sql = "SELECT customerid FROM ticket where ticketid = $ticket_id";
	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

	
	return $this->dataset [0][0];
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function GetCustomerEmail($customerid){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	if($customerid== ''){ return false; }
	
	$str_sql = "SELECT customeremail FROM customer where customerid = $customerid";
	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

	
	return $this->dataset [0][0];
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function GetCustomerName($customerid){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	if($customerid== ''){ return false; }
	
	$str_sql = "SELECT customername FROM customer where customerid = $customerid";
	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

	
	return $this->dataset [0][0];
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function SetTicketOwner($ticket_id,$staffid){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	if($ticket_id == '' || $staffid == ''){ return false; }
	
	$str_sql = "SELECT ownerid FROM ticket 
	            WHERE ticketid = $ticket_id";
	            
	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

	
	if($this->dataset [0][0] == false){
	
		$str_update = "update ticket set ownerid = $staffid
		               where ticketid = $ticket_id";
		
     $nm_select = $str_update; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      	
		return true;
	}
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function LoadStaff($staffid){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	if($staffid == ''){ return false; }

	$str_sql = "SELECT
			staffid,
			staffname,
			staffemail,
			staffpassword,
			adminflag,
			stafflanguage,
			signature
		    FROM
			staff
		    WHERE
			staffemail = '$staffid'";

	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

	
	if(empty($this->dataset [0][0])){ return false; }
	
	$arr_staff = array();
	$arr_staff['staffid']      = (!empty($this->dataset [0][0]))?$this->dataset [0][0]:'';
	$arr_staff['staffname']    = (!empty($this->dataset [0][1]))?$this->dataset [0][1]:'';
	$arr_staff['staffemail']   = (!empty($this->dataset [0][2]))?$this->dataset [0][2]:'';
	$arr_staff['staffpassword']= (!empty($this->dataset [0][3]))?$this->dataset [0][3]:'';
	$arr_staff['adminflag']    = (!empty($this->dataset [0][4]))?$this->dataset [0][4]:'';
	$arr_staff['stafflanguage']     = (!empty($this->dataset [0][5]))?$this->dataset [0][5]:'';
	$arr_staff['signature']    = (!empty($this->dataset [0][6]))?$this->dataset [0][6]:'-------------------<br />'.$arr_staff['staffname'];

	$str_sql = "SELECT categoryid FROM staff_categories
                    WHERE staff_staffid = ".$arr_staff['staffid'];
	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dscategories = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dscategories[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dscategories = false;
          $this->dscategories_erro = $this->Db->ErrorMsg();
      } 


	$str_categories = '';
	foreach($this->dscategories  as $arr_categories){
		$str_categories.= $arr_categories[0].","; 
	}
	$str_categories = substr($str_categories,0,strlen($str_categories)-1);
	
	$arr_staff['categories']     = ($str_categories!='')?$str_categories:'null';
		
	return $arr_staff;
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function LoadSettings(){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	$str_sql = "SELECT
			smtpserver,
			smtpuser,
			smtppassword,
			assigmentmode,
			publicticketsopening,
			definedparameters,
			broadcastmessages,
			defaultpriority,
			smtpsecurityflag,
			smtpport,
			urltrackingscreen,
			defaultlanguage,
			urlconfirmationscreen,
			emailaccount,
			sys_version
		   FROM
			systemsettings
		   WHERE
			id = 1";
			
	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

	
	$arr_load = array();
	$arr_load['smtpserver']            = (!empty($this->dataset [0][0]))?$this->dataset [0][0]:'';
	$arr_load['smtpuser']              = (!empty($this->dataset [0][1]))?$this->dataset [0][1]:'';
	$arr_load['smtppassword']          = (!empty($this->dataset [0][2]))?$this->dataset [0][2]:'';
	$arr_load['assigmentmode']         = (!empty($this->dataset [0][3]))?$this->dataset [0][3]:'';
	$arr_load['publicticketsopening']  = (!empty($this->dataset [0][4]))?$this->dataset [0][4]:'';
	$arr_load['definedparameters']     = (!empty($this->dataset [0][5]))?$this->dataset [0][5]:'';
	$arr_load['broadcastmessages']     = (!empty($this->dataset [0][6]))?$this->dataset [0][6]:'';
	$arr_load['defaultpriority']       = (!empty($this->dataset [0][7]))?$this->dataset [0][7]:'';
	$arr_load['smtpsecurityflag']      = (!empty($this->dataset [0][8]))?$this->dataset [0][8]:'';
	$arr_load['smtpport']              = (!empty($this->dataset [0][9]))?$this->dataset [0][9]:'';
	$arr_load['urltrackingscreen']     = (!empty($this->dataset [0][10]))?$this->dataset [0][10]:'';
	$arr_load['defaultlanguage']       = (!empty($this->dataset [0][11]))?$this->dataset [0][11]:'en_us;en_us';
	$arr_load['urlconfirmationscreen'] = (!empty($this->dataset [0][12]))?$this->dataset [0][12]:'';	
	$arr_load['emailaccount'] 	   = (!empty($this->dataset [0][13]))?$this->dataset [0][13]:'';	
	$arr_load['version'] 	  	   = (!empty($this->dataset [0][14]))?$this->dataset [0][14]:'';	

	$_SESSION['ticketsettings'] = $arr_load;
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function getCustomerByEmail($customer_email){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	if(empty($customer_email)){ return false; }

	$str_sql = "SELECT customerid, customername, customerpassword
                    FROM customer where customeremail = '$customer_email'";

	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

	
	$arr_customer = array();
	$arr_customer['customerid']      = (!empty($this->dataset [0][0]))?$this->dataset [0][0]:'';
	$arr_customer['customername']    = (!empty($this->dataset [0][1]))?$this->dataset [0][1]:'';
	$arr_customer['customerpassword']= (!empty($this->dataset [0][2]))?$this->dataset [0][2]:'';

	return $arr_customer;
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function getStaffById($staff_id){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	if(empty($staff_id)){ return false; }

	$str_sql = "SELECT staffid, staffname, staffemail
                    FROM staff where staffid = '$staff_id'";

	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

	
	$arr_staff = array();
	$arr_staff['staffid']      = (!empty($this->dataset [0][0]))?$this->dataset [0][0]:'';
	$arr_staff['staffname']    = (!empty($this->dataset [0][1]))?$this->dataset [0][1]:'';
	$arr_staff['staffemail']   = (!empty($this->dataset [0][2]))?$this->dataset [0][2]:'';

	return $arr_staff;
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function getStaffByEmail($staff_email){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	if(empty($staff_email)){ return false; }

	$str_sql = "SELECT staffid, staffname, staffpassword
                    FROM staff where staffemail = '$staff_email'";

	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

	
	$arr_staff = array();
	$arr_staff['staffid']      = (!empty($this->dataset [0][0]))?$this->dataset [0][0]:'';
	$arr_staff['staffname']    = (!empty($this->dataset [0][1]))?$this->dataset [0][1]:'';
	$arr_staff['staffpassword']= (!empty($this->dataset [0][2]))?$this->dataset [0][2]:'';

	return $arr_staff;
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function SetTrackingId($ticket, $mode='')
{
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  
	
	$trk_id = strtoupper(substr(md5($ticket),0,10));
	
     $nm_select = "UPDATE ticket SET tickettrack = '$trk_id' WHERE ticketid = $ticket"; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      

	if($mode == 'RELATIVE') {
	
	$url_tracking = '../ctrl_tracking_tickets/ctrl_tracking_tickets.php'. '?v_trackingid=' . $trk_id;

	} else {
	
	$url_tracking = $_SESSION['TicketSettings']['UrlTrackingScreen'] . '?v_trackingid=' . $trk_id;
	
	}
	return($url_tracking);
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function GetTrackingId($ticket)
{
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  
		
	$trk_id = strtoupper(substr(md5($ticket),0,10));
	return($trk_id);

$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function VersionDemo(){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	$arr_load = (!empty($_SESSION['TicketSettings']))?$_SESSION['TicketSettings']:false;
	if($arr_load == false){
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_error_blocked_demo'];
;
	}
	$bl_version = $arr_load['Version'];
	
	if($bl_version == 'demo'){
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_error_blocked_demo'];
;
	}
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function DefinedParameters(){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	$definedParameters  = (!empty($_SESSION['TicketSettings']['DefinedParameters']))?
				$_SESSION['TicketSettings']['DefinedParameters']:false;

	if($definedParameters != 'Y'){
		 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('form_systemsettings') . "/form_systemsettings.php", $this->nm_location, "","_self", 440, 630, "ret_self");
 };
	}
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function scTicketStart(){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  
	$str_file = '../../../devel/conf/scriptcase/sc_tickets_start';
	
	if(is_file($str_file)){
	
		$str_sql = "SELECT
				strftime('%Y', ticketdate) as Year,
				strftime('%m', ticketdate) as Month
			    FROM
			        ticket
			    order by    
			        ticketdate desc";
		 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 

		
		$last_month  = $this->dataset [0][1];
		$last_year   = $this->dataset [0][0];
		
		if($last_year == date('Y') && $last_month < date('m')){
		
			$diff = date('m') - $last_month;
			
			$str_sql = "update ticket set
			ticketdate = datetime(ticketdate ,'+$diff month'),
			ticketlastupdate = datetime(ticketlastupdate,'+$diff month')";
			
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
			
			$str_sql = "update ticketmessage set
			ticketdate = datetime(ticketdate ,'+$diff month')";
			
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
			
		}
		elseif($last_year < date('Y')){
			$diff = date('Y') - $last_year;
			
			$str_sql = "update ticket set
			ticketdate = datetime(ticketdate ,'+$diff year'),
			ticketlastupdate = datetime(ticketlastupdate,'+$diff year')";
			
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
			
			$str_sql = "update ticketmessage set
			ticketdate = datetime(ticketdate ,'+$diff year')";
			
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
		
		}
		unlink($str_file);
	
	}
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
function M_Warning($str_title, $str_message, $int_left=100, $int_top=100, $int_width=400,$action='RETURN'){
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'on';
  

	$str_possition = "position:absolute; left:".$int_left."px; top:".$int_top."px; ";
 	if($action == 'RETURN') $str_possition = '';
 
 $str_html = "
	<table id='scwarningid' cellspacing='0' cellpading='0' 
	 style='".$str_possition." border:1px solid #d1dceb; width:".$int_width."px; z-index:300; background-color:#FFFFFF' >
	<tr>
	  <td background='../_lib/img/bgGrid.png' style='font-size:12px; font-weight:bolder;' >
	  <a href='#' onclick=\"document.getElementById('scwarningid').style.display='none';\">
	    <img src='../_lib/img/grp__NM__ok.gif' border='0' /></a>
	  ".$str_title."
	  </td>
	</tr>
	<tr>
	  <td style='font-size:12px; padding:10px'>".$str_message."  
	  </td>
	</tr>
	</table>
"; 
 
 	if($action == 'RETURN') return $str_html;
 	else echo $str_html;
 
 
 
$_SESSION['scriptcase']['grid_customer_ticket_flow']['contr_erro'] = 'off';
}
}

?>
