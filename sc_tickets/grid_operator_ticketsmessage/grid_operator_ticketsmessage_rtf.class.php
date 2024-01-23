<?php

class grid_operator_ticketsmessage_rtf
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Texto_tag;
   var $Arquivo;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("en_us");
      $this->Texto_tag = "";
   }


function actionBar_isValidState($buttonName, $buttonState)
{
    return false;
}

   //---- 
   function monta_rtf()
   {
      $this->inicializa_vars();
      $this->gera_texto_tag();
      $this->grava_arquivo_rtf();
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Rtf_f);
          $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
          $Temp = ob_get_clean();
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
      else
      {
          $this->progress_bar_end();
      }
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      if (isset($GLOBALS['nmgp_parms']) && !empty($GLOBALS['nmgp_parms'])) 
      { 
          $GLOBALS['nmgp_parms'] = str_replace("@aspass@", "'", $GLOBALS['nmgp_parms']);
          $todox = str_replace("?#?@?@?", "?#?@ ?@?", $GLOBALS["nmgp_parms"]);
          $todo  = explode("?@?", $todox);
          foreach ($todo as $param)
          {
               $cadapar = explode("?#?", $param);
               if (1 < sizeof($cadapar))
               {
                   if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                   {
                       $cadapar[0] = substr($cadapar[0], 11);
                       $cadapar[1] = $_SESSION[$cadapar[1]];
                   }
                   if (isset($GLOBALS['sc_conv_var'][$cadapar[0]]))
                   {
                       $cadapar[0] = $GLOBALS['sc_conv_var'][$cadapar[0]];
                   }
                   elseif (isset($GLOBALS['sc_conv_var'][strtolower($cadapar[0])]))
                   {
                       $cadapar[0] = $GLOBALS['sc_conv_var'][strtolower($cadapar[0])];
                   }
                   nm_limpa_str_grid_operator_ticketsmessage($cadapar[1]);
                   nm_protect_num_grid_operator_ticketsmessage($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_operator_ticketsmessage']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($v_ticketid)) 
      {
          $_SESSION['v_ticketid'] = $v_ticketid;
          nm_limpa_str_grid_operator_ticketsmessage($_SESSION["v_ticketid"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "grid_operator_ticketsmessage.php"; 
      require_once($this->Ini->path_aplicacao . "grid_operator_ticketsmessage_total.class.php"); 
      $this->Tot      = new grid_operator_ticketsmessage_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_operator_ticketsmessage']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("grid_operator_ticketsmessage.php");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_operator_ticketsmessage";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_operator_ticketsmessage.rtf";
   }
   //---- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }


   //----- 
   function gera_texto_tag()
   {
     global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      $this->New_label['ticketdate'] = "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketdate'] . "";
      $this->New_label['messagetype'] = "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_messagetype'] . "";
      $this->New_label['messagestatus'] = "" . $this->Ini->Nm_lang['lang_ticket_fild_statusid'] . "";
      $this->New_label['operatorid'] = "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_operatorid'] . "";
      $this->New_label['ticketcontent'] = "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketcontent'] . "";
      $this->New_label['ticketmessageid'] = "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketmessageid'] . "";
      $this->New_label['ticketid'] = "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketid'] . "";
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
if (!isset($_SESSION['v_ticketid'])) {$_SESSION['v_ticketid'] = "";}
if (!isset($this->sc_temp_v_ticketid)) {$this->sc_temp_v_ticketid = (isset($_SESSION['v_ticketid'])) ? $_SESSION['v_ticketid'] : "";}
  $this->ticketid = $this->sc_temp_v_ticketid;
$statusid = $this->GetTicketStatus($this->ticketid);

if(empty($statusid) || $statusid == 'SOLVED' || $statusid == 'CLOSED'){
	$this->nmgp_botoes["new"] = 'off';;
}
else{
	$this->nmgp_botoes["new"] = 'on';;
}

if($statusid == 'CLOSED' || $statusid == 'SOLVED' ){
	$this->nmgp_botoes["close"] = 'off';;
}
else{
	$this->nmgp_botoes["close"] = 'on';;
}
if (isset($this->sc_temp_v_ticketid)) {$_SESSION['v_ticketid'] = $this->sc_temp_v_ticketid;}
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['ticketdate'])) ? $this->New_label['ticketdate'] : ""; 
          if ($Cada_col == "ticketdate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['messagetype'])) ? $this->New_label['messagetype'] : ""; 
          if ($Cada_col == "messagetype" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['messagestatus'])) ? $this->New_label['messagestatus'] : ""; 
          if ($Cada_col == "messagestatus" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['operatorid'])) ? $this->New_label['operatorid'] : ""; 
          if ($Cada_col == "operatorid" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ticketcontent'])) ? $this->New_label['ticketcontent'] : ""; 
          if ($Cada_col == "ticketcontent" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['messagenote'])) ? $this->New_label['messagenote'] : "MessageNote"; 
          if ($Cada_col == "messagenote" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ticketfile1'])) ? $this->New_label['ticketfile1'] : ""; 
          if ($Cada_col == "ticketfile1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ticketfile2'])) ? $this->New_label['ticketfile2'] : ""; 
          if ($Cada_col == "ticketfile2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ticketfile3'])) ? $this->New_label['ticketfile3'] : ""; 
          if ($Cada_col == "ticketfile3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
      } 
      $this->Texto_tag .= "</tr>\r\n";
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT str_replace (convert(char(10),ticketdate,102), '.', '-') + ' ' + convert(char(8),ticketdate,20), messagetype, statusid as messagestatus, operatorid, ticketcontent, messagenote, ticketfile1, ticketfile2, ticketfile3, ticketfilename1, ticketfilename2, ticketfilename3, ticketmessageid, ticketid from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT ticketdate, messagetype, statusid as messagestatus, operatorid, ticketcontent, messagenote, ticketfile1, ticketfile2, ticketfile3, ticketfilename1, ticketfilename2, ticketfilename3, ticketmessageid, ticketid from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT convert(char(23),ticketdate,121), messagetype, statusid as messagestatus, operatorid, ticketcontent, messagenote, ticketfile1, ticketfile2, ticketfile3, ticketfilename1, ticketfilename2, ticketfilename3, ticketmessageid, ticketid from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT ticketdate, messagetype, statusid as messagestatus, operatorid, ticketcontent, messagenote, ticketfile1, ticketfile2, ticketfile3, ticketfilename1, ticketfilename2, ticketfilename3, ticketmessageid, ticketid from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT EXTEND(ticketdate, YEAR TO FRACTION), messagetype, statusid as messagestatus, operatorid, ticketcontent, messagenote, LOTOFILE(ticketfile1, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as ticketfile1, LOTOFILE(ticketfile2, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as ticketfile2, LOTOFILE(ticketfile3, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as ticketfile3, ticketfilename1, ticketfilename2, ticketfilename3, ticketmessageid, ticketid from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT ticketdate, messagetype, statusid as messagestatus, operatorid, ticketcontent, messagenote, ticketfile1, ticketfile2, ticketfile3, ticketfilename1, ticketfilename2, ticketfilename3, ticketmessageid, ticketid from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select_count;
      $rt = $this->Db->Execute($nmgp_select_count);
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->count_ger = $rt->fields[0];
      $rt->Close();
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      if (!$rs->EOF)
      {
         $this->ticketdate = $rs->fields[0] ;  
         $this->messagetype = $rs->fields[1] ;  
         $this->messagestatus = $rs->fields[2] ;  
         $this->operatorid = $rs->fields[3] ;  
         $this->operatorid = (string)$this->operatorid;
         $this->ticketcontent = $rs->fields[4] ;  
         $this->messagenote = $rs->fields[5] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->ticketfile1 = "";  
              if (is_file($rs_grid->fields[6])) 
              { 
                  $this->ticketfile1 = file_get_contents($rs_grid->fields[6]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->ticketfile1 = $this->Db->BlobDecode($rs->fields[6]) ;  
         } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
         { 
             $this->ticketfile1 = $this->Db->BlobDecode($rs->fields[6]) ;  
         } 
         else
         { 
             $this->ticketfile1 = $rs->fields[6] ;  
         } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->ticketfile2 = "";  
              if (is_file($rs_grid->fields[7])) 
              { 
                  $this->ticketfile2 = file_get_contents($rs_grid->fields[7]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->ticketfile2 = $this->Db->BlobDecode($rs->fields[7]) ;  
         } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
         { 
             $this->ticketfile2 = $this->Db->BlobDecode($rs->fields[7]) ;  
         } 
         else
         { 
             $this->ticketfile2 = $rs->fields[7] ;  
         } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->ticketfile3 = "";  
              if (is_file($rs_grid->fields[8])) 
              { 
                  $this->ticketfile3 = file_get_contents($rs_grid->fields[8]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->ticketfile3 = $this->Db->BlobDecode($rs->fields[8]) ;  
         } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
         { 
             $this->ticketfile3 = $this->Db->BlobDecode($rs->fields[8]) ;  
         } 
         else
         { 
             $this->ticketfile3 = $rs->fields[8] ;  
         } 
         $this->ticketfilename1 = $rs->fields[9] ;  
         $this->ticketfilename2 = $rs->fields[10] ;  
         $this->ticketfilename3 = $rs->fields[11] ;  
         $this->ticketmessageid = $rs->fields[12] ;  
         $this->ticketmessageid = (string)$this->ticketmessageid;
         $this->ticketid = $rs->fields[13] ;  
         $this->ticketid = (string)$this->ticketid;
   $_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
if (!isset($_SESSION['v_ticketid'])) {$_SESSION['v_ticketid'] = "";}
if (!isset($this->sc_temp_v_ticketid)) {$this->sc_temp_v_ticketid = (isset($_SESSION['v_ticketid'])) ? $_SESSION['v_ticketid'] : "";}
  $st = $this->sc_temp_v_ticketid;
$st = $this->GetTicketStatus($st);

$_SESSION['grid_operator_ticketsmessage']['attr_ticket_status'] = "Status: ".$st;
$_SESSION['grid_operator_ticketsmessage']['attr_ticket_track'] = "Tracking ID: ".$this->GetTrackingId($this->sc_temp_v_ticketid);
$_SESSION['grid_operator_ticketsmessage']['attr_ticket_customer'] = $this->Ini->Nm_lang['lang_customer_fild_customername'].": ".$this->GetCustomerName($customerid);
if (isset($this->sc_temp_v_ticketid)) {$_SESSION['v_ticketid'] = $this->sc_temp_v_ticketid;}
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
      }
      $this->SC_seq_register = 0;
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         $this->Texto_tag .= "<tr>\r\n";
         $this->ticketdate = $rs->fields[0] ;  
         $this->messagetype = $rs->fields[1] ;  
         $this->messagestatus = $rs->fields[2] ;  
         $this->operatorid = $rs->fields[3] ;  
         $this->operatorid = (string)$this->operatorid;
         $this->ticketcontent = $rs->fields[4] ;  
         $this->messagenote = $rs->fields[5] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->ticketfile1 = "";  
              if (is_file($rs_grid->fields[6])) 
              { 
                  $this->ticketfile1 = file_get_contents($rs_grid->fields[6]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->ticketfile1 = $this->Db->BlobDecode($rs->fields[6]) ;  
         } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
         { 
             $this->ticketfile1 = $this->Db->BlobDecode($rs->fields[6]) ;  
         } 
         else
         { 
             $this->ticketfile1 = $rs->fields[6] ;  
         } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->ticketfile2 = "";  
              if (is_file($rs_grid->fields[7])) 
              { 
                  $this->ticketfile2 = file_get_contents($rs_grid->fields[7]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->ticketfile2 = $this->Db->BlobDecode($rs->fields[7]) ;  
         } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
         { 
             $this->ticketfile2 = $this->Db->BlobDecode($rs->fields[7]) ;  
         } 
         else
         { 
             $this->ticketfile2 = $rs->fields[7] ;  
         } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->ticketfile3 = "";  
              if (is_file($rs_grid->fields[8])) 
              { 
                  $this->ticketfile3 = file_get_contents($rs_grid->fields[8]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->ticketfile3 = $this->Db->BlobDecode($rs->fields[8]) ;  
         } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
         { 
             $this->ticketfile3 = $this->Db->BlobDecode($rs->fields[8]) ;  
         } 
         else
         { 
             $this->ticketfile3 = $rs->fields[8] ;  
         } 
         $this->ticketfilename1 = $rs->fields[9] ;  
         $this->ticketfilename2 = $rs->fields[10] ;  
         $this->ticketfilename3 = $rs->fields[11] ;  
         $this->ticketmessageid = $rs->fields[12] ;  
         $this->ticketmessageid = (string)$this->ticketmessageid;
         $this->ticketid = $rs->fields[13] ;  
         $this->ticketid = (string)$this->ticketid;
         //----- lookup - messagestatus
         $this->look_messagestatus = $this->messagestatus; 
         $this->Lookup->lookup_messagestatus($this->look_messagestatus, $this->messagestatus) ; 
         $this->look_messagestatus = ($this->look_messagestatus == "&nbsp;") ? "" : $this->look_messagestatus; 
         //----- lookup - operatorid
         $this->look_operatorid = $this->operatorid; 
         $this->Lookup->lookup_operatorid($this->look_operatorid, $this->operatorid) ; 
         $this->look_operatorid = ($this->look_operatorid == "&nbsp;") ? "" : $this->look_operatorid; 
         $this->ticketfile1 = $this->ticketfilename1;
         $this->ticketfile2 = $this->ticketfilename2;
         $this->ticketfile3 = $this->ticketfilename3;
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->Texto_tag .= "</tr>\r\n";
         $rs->MoveNext();
      }
      $this->Texto_tag .= "</table>\r\n";
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- ticketdate
   function NM_export_ticketdate()
   {
             if (substr($this->ticketdate, 10, 1) == "-") 
             { 
                 $this->ticketdate = substr($this->ticketdate, 0, 10) . " " . substr($this->ticketdate, 11);
             } 
             if (substr($this->ticketdate, 13, 1) == ".") 
             { 
                $this->ticketdate = substr($this->ticketdate, 0, 13) . ":" . substr($this->ticketdate, 14, 2) . ":" . substr($this->ticketdate, 17);
             } 
             $conteudo_x =  $this->ticketdate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->ticketdate, "YYYY-MM-DD HH:II:SS  ");
                 $this->ticketdate = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         $this->ticketdate = NM_charset_to_utf8($this->ticketdate);
         $this->ticketdate = str_replace('<', '&lt;', $this->ticketdate);
         $this->ticketdate = str_replace('>', '&gt;', $this->ticketdate);
         $this->Texto_tag .= "<td>" . $this->ticketdate . "</td>\r\n";
   }
   //----- messagetype
   function NM_export_messagetype()
   {
         $this->messagetype = html_entity_decode($this->messagetype, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->messagetype = strip_tags($this->messagetype);
         $this->messagetype = NM_charset_to_utf8($this->messagetype);
         $this->messagetype = str_replace('<', '&lt;', $this->messagetype);
         $this->messagetype = str_replace('>', '&gt;', $this->messagetype);
         $this->Texto_tag .= "<td>" . $this->messagetype . "</td>\r\n";
   }
   //----- messagestatus
   function NM_export_messagestatus()
   {
         $this->look_messagestatus = html_entity_decode($this->look_messagestatus, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->look_messagestatus = strip_tags($this->look_messagestatus);
         $this->look_messagestatus = NM_charset_to_utf8($this->look_messagestatus);
         $this->look_messagestatus = str_replace('<', '&lt;', $this->look_messagestatus);
         $this->look_messagestatus = str_replace('>', '&gt;', $this->look_messagestatus);
         $this->Texto_tag .= "<td>" . $this->look_messagestatus . "</td>\r\n";
   }
   //----- operatorid
   function NM_export_operatorid()
   {
         nmgp_Form_Num_Val($this->look_operatorid, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_operatorid = NM_charset_to_utf8($this->look_operatorid);
         $this->look_operatorid = str_replace('<', '&lt;', $this->look_operatorid);
         $this->look_operatorid = str_replace('>', '&gt;', $this->look_operatorid);
         $this->Texto_tag .= "<td>" . $this->look_operatorid . "</td>\r\n";
   }
   //----- ticketcontent
   function NM_export_ticketcontent()
   {
         $this->ticketcontent = html_entity_decode($this->ticketcontent, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ticketcontent = strip_tags($this->ticketcontent);
         $this->ticketcontent = NM_charset_to_utf8($this->ticketcontent);
         $this->ticketcontent = str_replace('<', '&lt;', $this->ticketcontent);
         $this->ticketcontent = str_replace('>', '&gt;', $this->ticketcontent);
         $this->Texto_tag .= "<td>" . $this->ticketcontent . "</td>\r\n";
   }
   //----- messagenote
   function NM_export_messagenote()
   {
         $this->messagenote = html_entity_decode($this->messagenote, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->messagenote = strip_tags($this->messagenote);
         $this->messagenote = NM_charset_to_utf8($this->messagenote);
         $this->messagenote = str_replace('<', '&lt;', $this->messagenote);
         $this->messagenote = str_replace('>', '&gt;', $this->messagenote);
         $this->Texto_tag .= "<td>" . $this->messagenote . "</td>\r\n";
   }
   //----- ticketfile1
   function NM_export_ticketfile1()
   {
         $this->ticketfile1 = NM_charset_to_utf8($this->ticketfile1);
         $this->ticketfile1 = str_replace('<', '&lt;', $this->ticketfile1);
         $this->ticketfile1 = str_replace('>', '&gt;', $this->ticketfile1);
         $this->Texto_tag .= "<td>" . $this->ticketfile1 . "</td>\r\n";
   }
   //----- ticketfile2
   function NM_export_ticketfile2()
   {
         $this->ticketfile2 = NM_charset_to_utf8($this->ticketfile2);
         $this->ticketfile2 = str_replace('<', '&lt;', $this->ticketfile2);
         $this->ticketfile2 = str_replace('>', '&gt;', $this->ticketfile2);
         $this->Texto_tag .= "<td>" . $this->ticketfile2 . "</td>\r\n";
   }
   //----- ticketfile3
   function NM_export_ticketfile3()
   {
         $this->ticketfile3 = NM_charset_to_utf8($this->ticketfile3);
         $this->ticketfile3 = str_replace('<', '&lt;', $this->ticketfile3);
         $this->ticketfile3 = str_replace('>', '&gt;', $this->ticketfile3);
         $this->Texto_tag .= "<td>" . $this->ticketfile3 . "</td>\r\n";
   }

   //----- 
   function grava_arquivo_rtf()
   {
      global $nm_lang, $doc_wrap;
      $this->Rtf_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $rtf_f       = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      require_once($this->Ini->path_third      . "/rtf_new/document_generator/cl_xml2driver.php"); 
      $text_ok  =  "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n"; 
      $text_ok .=  "<DOC config_file=\"" . $this->Ini->path_third . "/rtf_new/doc_config.inc\" >\r\n"; 
      $text_ok .=  $this->Texto_tag; 
      $text_ok .=  "</DOC>\r\n"; 
      $xml = new nDOCGEN($text_ok,"RTF"); 
      fwrite($rtf_f, $xml->get_result_file());
      fclose($rtf_f);
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
   function progress_bar_end()
   {
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage'][$path_doc_md5][1] = $this->Tit_doc;
      $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
      if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
          $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
      }
      $this->pb->setProgressbarMessage($Mens_bar);
      $this->pb->setDownloadLink($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $this->pb->setDownloadMd5($path_doc_md5);
      $this->pb->completed();
   }
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_operator_ticketsmessage'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> - <?php echo $this->Ini->Nm_lang['lang_tble_ticketmessage'] ?> :: RTF</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
  <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
  <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
  <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
  <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
  <META http-equiv="Pragma" content="no-cache"/>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <?php
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts))
 {
 ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->str_google_fonts ?>" />
 <?php
 }
 ?>
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">RTF</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_operator_ticketsmessage_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_operator_ticketsmessage"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="grid_operator_ticketsmessage.php"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="volta_grid"> 
</FORM> 
</BODY>
</HTML>
<?php
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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function CloseTicket($ticket_id){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function TransferTicket($ticket_id,$new_ownerid){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function UpdateTicketStatus($ticket_id,$status_id = 'REPLIED'){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  
	
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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function GetTicketSubject($ticket_id){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function GetTicketStatus($ticket_id){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function GetTicketRating($ticket_id)
{
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function GetOperatorName($staffid){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function GetCustomerTicket($ticket_id){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function GetCustomerEmail($customerid){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function GetCustomerName($customerid){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function SetTicketOwner($ticket_id,$staffid){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function LoadStaff($staffid){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function LoadSettings(){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function getCustomerByEmail($customer_email){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function getStaffById($staff_id){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function getStaffByEmail($staff_email){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function SetTrackingId($ticket, $mode='')
{
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  
	
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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function GetTrackingId($ticket)
{
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  
		
	$trk_id = strtoupper(substr(md5($ticket),0,10));
	return($trk_id);

$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function VersionDemo(){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function DefinedParameters(){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

	$definedParameters  = (!empty($_SESSION['TicketSettings']['DefinedParameters']))?
				$_SESSION['TicketSettings']['DefinedParameters']:false;

	if($definedParameters != 'Y'){
		 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('form_systemsettings') . "/form_systemsettings.php", $this->nm_location, "","_self", 440, 630, "ret_self");
 };
	}
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function scTicketStart(){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function M_Warning($str_title, $str_message, $int_left=100, $int_top=100, $int_width=400,$action='RETURN'){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

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
 
 
 
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function MailSend($destination,$subject='SC Tickets',$message='<b>message template not found!</b>'){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

	if($destination == '' || empty($destination)){ return false; }

	$arr_settings = $_SESSION['ticketsettings'];
	
	$smtp_server = (!empty($arr_settings['smtpserver']))?$arr_settings['smtpserver']:'localhost';
	$smtp_user = (!empty($arr_settings['smtpuser']))?$arr_settings['smtpuser']:'';
	$smtp_pass = (!empty($arr_settings['smtppassword']))?$arr_settings['smtppassword']:'';
	$smtp_security_flag = (!empty($arr_settings['smtpsecurityflag']))?$arr_settings['smtpsecurityflag']:'';
	$smtp_port = (!empty($arr_settings['smtpport']))?$arr_settings['smtpport']:false;
	$smtp_email = (!empty($arr_settings['emailaccount']))?$arr_settings['emailaccount']:'helpdesk@scriptcase.net';
	
	 
	if($smtp_security_flag == 'Y' && $smtp_port == false){
		$smtp_port = '465';		
		
	}
	elseif($smtp_security_flag == '' && $smtp_port == false){
		$smtp_port = '25';

	}
	
	
	
	
	    include_once($this->Ini->path_third . "/swift/swift_required.php");
    $sc_mail_port     = "$smtp_port";
    $sc_mail_tp_port  = "$smtp_security_flag";
    $sc_mail_tp_mens  = "H";
    $sc_mail_tp_copy  = "";
    $this->sc_mail_count = 0;
    $this->sc_mail_erro  = "";
    $this->sc_mail_ok    = true;
    if ($sc_mail_tp_port == "S" || $sc_mail_tp_port == "Y")
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 465;
        $Con_Mail = Swift_SmtpTransport::newInstance($smtp_server, $sc_mail_port, 'ssl');
    }
    elseif ($sc_mail_tp_port == "T")
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 587;
        $Con_Mail = Swift_SmtpTransport::newInstance($smtp_server, $sc_mail_port, 'tls');
    }
    else
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 25;
        $Con_Mail = Swift_SmtpTransport::newInstance($smtp_server, $sc_mail_port);
    }
    $Con_Mail->setUsername($smtp_user);
    $Con_Mail->setpassword($smtp_pass);
    $Send_Mail = Swift_Mailer::newInstance($Con_Mail);
    if ($sc_mail_tp_mens == "H")
    {
        $Mens_Mail = Swift_Message::newInstance($subject)->setBody($message)->setContentType("text/html");
    }
    else
    {
        $Mens_Mail = Swift_Message::newInstance($subject)->setBody($message);
    }
    if (!empty($_SESSION['scriptcase']['charset']))
    {
        $Mens_Mail->setCharset($_SESSION['scriptcase']['charset']);
    }
    $Temp_mail = $destination;
    if (!is_array($Temp_mail))
    {
        $Temp_mail = explode(";", $destination);
    }
    foreach ($Temp_mail as $NM_dest)
    {
        if (!empty($NM_dest))
        {
            $Arr_addr = SC_Mail_Address($NM_dest);
            $Mens_Mail->addTo($Arr_addr[0], $Arr_addr[1]);
        }
    }
    $Arr_addr = SC_Mail_Address($smtp_email);
    $Err_mail = array();
    $this->sc_mail_count = $Send_Mail->send($Mens_Mail->setFrom($Arr_addr[0], $Arr_addr[1]), $Err_mail);
    if (!empty($Err_mail))
    {
        $this->sc_mail_erro = $Err_mail;
        $this->sc_mail_ok   = false;
    }
;
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function P_MailSend($destination,$subject='SC Tickets',$message='<b>message template not found!</b>',$conn_id){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

	if($destination == '' || empty($destination)){ return false; }

	$arr_settings = $_SESSION['ticketsettings'];		
	
	$smtp_email = (!empty($arr_settings['emailaccount']))?$arr_settings['emailaccount']:'helpdesk@scriptcase.net';

	    include_once($this->Ini->path_third . "/swift/swift_required.php");
    $sc_mail_port     = "";
    $sc_mail_tp_port  = "N";
    $sc_mail_tp_mens  = "";
    $sc_mail_tp_copy  = "Bcc";
    $this->sc_mail_count = 0;
    $this->sc_mail_erro  = "";
    $this->sc_mail_ok    = true;
    if ($sc_mail_tp_port == "S" || $sc_mail_tp_port == "Y")
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 465;
        $Con_Mail = Swift_SmtpTransport::newInstance($conn_id, $sc_mail_port, 'ssl');
    }
    elseif ($sc_mail_tp_port == "T")
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 587;
        $Con_Mail = Swift_SmtpTransport::newInstance($conn_id, $sc_mail_port, 'tls');
    }
    else
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 25;
        $Con_Mail = Swift_SmtpTransport::newInstance($conn_id, $sc_mail_port);
    }
    $Con_Mail->setUsername($smtp_email);
    $Con_Mail->setpassword($destination);
    $Send_Mail = Swift_Mailer::newInstance($Con_Mail);
    if ($sc_mail_tp_mens == "H")
    {
        $Mens_Mail = Swift_Message::newInstance("H")->setBody("")->setContentType("text/html");
    }
    else
    {
        $Mens_Mail = Swift_Message::newInstance("H")->setBody("");
    }
    if (!empty($_SESSION['scriptcase']['charset']))
    {
        $Mens_Mail->setCharset($_SESSION['scriptcase']['charset']);
    }
    $Temp_mail = $message;
    if (!is_array($Temp_mail))
    {
        $Temp_mail = explode(";", $message);
    }
    foreach ($Temp_mail as $NM_dest)
    {
        if (!empty($NM_dest))
        {
            $Arr_addr = SC_Mail_Address($NM_dest);
            $Mens_Mail->addTo($Arr_addr[0], $Arr_addr[1]);
        }
    }
    $Arr_addr = SC_Mail_Address($subject);
    $Err_mail = array();
    $this->sc_mail_count = $Send_Mail->send($Mens_Mail->setFrom($Arr_addr[0], $Arr_addr[1]), $Err_mail);
    if (!empty($Err_mail))
    {
        $this->sc_mail_erro = $Err_mail;
        $this->sc_mail_ok   = false;
    }
;
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function P_MailConnect($conn_id)
{
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  
	
	$arr_settings = $_SESSION['ticketsettings'];
	
	$smtp_server = (!empty($arr_settings['smtpserver']))?$arr_settings['smtpserver']:'localhost';
	$smtp_user = (!empty($arr_settings['smtpUser']))?$arr_settings['smtpuser']:'';
	$smtp_pass = (!empty($arr_settings['smtppassword']))?$arr_settings['smtppassword']:'';
	$smtp_security_flag = (!empty($arr_settings['smtpsecurityflag']))?$arr_settings['smtpsecurityflag']:'';
	$smtp_port = (!empty($arr_settings['smtpport']))?$arr_settings['smtpport']:false;
	
	if($smtp_security_flag == 'Y' && $smtp_port == false){
		$smtp_port = '465';		
		
	}
	elseif($smtp_security_flag == '' && $smtp_port == false){
		$smtp_port = '25';

	}

	    include_once($this->Ini->path_third . "/swift/swift_required.php");
    $sc_mail_port     = "$smtp_port";
    $sc_mail_tp_port  = "$smtp_security_flag";
    if ($sc_mail_tp_port == "S" || $sc_mail_tp_port == "Y")
    {
        $sc_mail_port = (!empty($sc_mail_port)) ? $sc_mail_port : 465;
        $Con_Mail = Swift_SmtpTransport::newInstance($smtp_server, $sc_mail_port, 'ssl')->setUsername($smtp_user)->setpassword($smtp_pass);
    }
    else
    {
        $sc_mail_port =  (!empty($sc_mail_port)) ? $sc_mail_port : 25;
        $Con_Mail =  Swift_SmtpTransport::newInstance($smtp_server, $sc_mail_port)->setUsername($smtp_user)->setpassword($smtp_pass);
    }
    $this->$conn_id = Swift_Mailer::newInstance($Con_Mail);
;
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function P_MailDisconnect($conn_id)
{
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  
	;
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function GetTemplateEmailStaff($status_id,$staff_id){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

	if($staff_id == ''){ return false; }
	
	$str_sql = "SELECT stafflanguage FROM staff where staffid = $staff_id";
	 
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

	
	$languageid = $this->dataset [0][0];
	
	if ($languageid == '') { return false; }
	
	$str_sql = "SELECT content,title FROM ticket_email_tpl M 
                    WHERE (M.ticketlanguage = '$languageid') and
	                  (M.statusid = '$status_id') and
	                  (M.usertype = 2) and 
	                  (M.enabled = 'Y') ";	

	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset1 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset1[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset1 = false;
          $this->dataset1_erro = $this->Db->ErrorMsg();
      } 


	if($this->dataset1  == false){
		return false;
	}	
	else{
		$arr_result['MESSAGE'] = $this->dataset1 [0][0];
		$arr_result['TITLE'] = $this->dataset1 [0][1];
		return $arr_result;
	}
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
function GetTemplateEmailCustomer($status_id,$customerid){
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'on';
  

	if($customerid == ''){ return false; }

	$str_sql = "SELECT customerlanguage FROM customer WHERE customerid = $customerid";
	 
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

	
	$languageid = $this->dataset [0][0];

	if($status_id == ''){ return false; }
	if($languageid == ''){ return false; }

	$str_sql = "SELECT content,title FROM ticket_email_tpl M 
                    WHERE (M.ticketlanguage = '$languageid') and
	                  (M.statusid = '$status_id') and
	                  (M.usertype = 1) and 
	                  (M.enabled = 'Y')";
			
	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset1 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->dataset1[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset1 = false;
          $this->dataset1_erro = $this->Db->ErrorMsg();
      } 


	if($this->dataset1  == false){ 
		return false; 
	}	
	else{
		$arr_result['MESSAGE'] = $this->dataset1 [0][0];
		$arr_result['TITLE'] = $this->dataset1 [0][1];
		return $arr_result; 
	}
$_SESSION['scriptcase']['grid_operator_ticketsmessage']['contr_erro'] = 'off';
}
}

?>
