<?php

class grid_customers_tickets_rtf
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
    switch ($buttonName) {
        case 'link_app':
            return in_array($buttonState, array("state1"));
    }

    return false;
}


function actionBar_displayState($buttonName)
{
    switch ($buttonName) {
        case 'link_app':
            return $this->actionBar_displayState_link_app();
    }
}

function actionBar_displayState_link_app()
{
    switch ($this->sc_actionbar_states['link_app']) {
        case 'state1':
            return "<i class=\"icon_fa sc-actb-link_app sc-acts-state1 far fa-plus-square\"></i>";
    }
}

function actionBar_getStateHint($buttonName)
{
    switch ($buttonName) {
        case 'link_app':
            return $this->actionBar_getStateHint_link_app();
    }
}

function actionBar_getStateHint_link_app()
{
    switch ($this->sc_actionbar_states['link_app']) {
        case 'state1':
            return "" . $this->Ini->Nm_lang['lang_alert_detail'] . "";
    }
}

function actionBar_getStateConfirm($buttonName)
{
    switch ($buttonName) {
        case 'link_app':
            return $this->actionBar_getStateConfirm_link_app();
    }
}

function actionBar_getStateConfirm_link_app()
{
    switch ($this->sc_actionbar_states['link_app']) {
        case 'state1':
            return "";
    }
}

function actionBar_getStateDisable($buttonName)
{
    if (isset($this->sc_actionbar_disabled[$buttonName]) && $this->sc_actionbar_disabled[$buttonName]) {
        return ' disabled';
    }

    return '';
}

function actionBar_getStateHide($buttonName)
{
    if (isset($this->sc_actionbar_hidden[$buttonName]) && $this->sc_actionbar_hidden[$buttonName]) {
        return ' sc-actionbar-button-hidden';
    }

    return '';
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
                   nm_limpa_str_grid_customers_tickets($cadapar[1]);
                   nm_protect_num_grid_customers_tickets($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_customers_tickets']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($v_customerid)) 
      {
          $_SESSION['v_customerid'] = $v_customerid;
          nm_limpa_str_grid_customers_tickets($_SESSION["v_customerid"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "grid_customers_tickets.php"; 
      require_once($this->Ini->path_aplicacao . "grid_customers_tickets_total.class.php"); 
      $this->Tot      = new grid_customers_tickets_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_customers_tickets']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("grid_customers_tickets.php");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_customers_tickets";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_customers_tickets.rtf";
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
      $this->New_label['ticket_ticketid'] = "" . $this->Ini->Nm_lang['lang_ticket_fild_ticketid'] . "";
      $this->New_label['ticket_tickettrack'] = "" . $this->Ini->Nm_lang['lang_ticket_fild_tickettrack'] . "";
      $this->New_label['ticket_ticketdate'] = "" . $this->Ini->Nm_lang['lang_ticket_fild_ticketdate'] . "";
      $this->New_label['ticket_subject'] = "" . $this->Ini->Nm_lang['lang_ticket_fild_subject'] . "";
      $this->New_label['staff_staffname'] = "" . $this->Ini->Nm_lang['lang_staff_fild_staffname'] . "";
      $this->New_label['ticket_ticketlastupdate'] = "" . $this->Ini->Nm_lang['lang_ticket_fild_ticketlastupdate'] . "";
      $this->New_label['ticket_ticketpriorityid'] = "" . $this->Ini->Nm_lang['lang_ticketpriority_fild_priorityname'] . "";
      $this->New_label['ticketstatus_statusname'] = "" . $this->Ini->Nm_lang['lang_ticketstatus_fild_statusname'] . "";
      $this->New_label['staff_staffemail'] = "" . $this->Ini->Nm_lang['lang_staff_fild_staffemail'] . "";
      $this->New_label['ticketpriority_priorityname'] = "" . $this->Ini->Nm_lang['lang_ticketpriority_fild_priorityname'] . "";
      $this->New_label['ticketstatus_statusid'] = "" . $this->Ini->Nm_lang['lang_staff_fild_staffid'] . "";
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_customers_tickets']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_customers_tickets']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_customers_tickets']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->ticket_tickettrack = (isset($Busca_temp['ticket_tickettrack'])) ? $Busca_temp['ticket_tickettrack'] : ""; 
          $tmp_pos = (is_string($this->ticket_tickettrack)) ? strpos($this->ticket_tickettrack, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->ticket_tickettrack))
          {
              $this->ticket_tickettrack = substr($this->ticket_tickettrack, 0, $tmp_pos);
          }
          $this->ticket_ticketpriorityid = (isset($Busca_temp['ticket_ticketpriorityid'])) ? $Busca_temp['ticket_ticketpriorityid'] : ""; 
          $tmp_pos = (is_string($this->ticket_ticketpriorityid)) ? strpos($this->ticket_ticketpriorityid, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->ticket_ticketpriorityid))
          {
              $this->ticket_ticketpriorityid = substr($this->ticket_ticketpriorityid, 0, $tmp_pos);
          }
          $this->ticketstatus_statusid = (isset($Busca_temp['ticketstatus_statusid'])) ? $Busca_temp['ticketstatus_statusid'] : ""; 
          $tmp_pos = (is_string($this->ticketstatus_statusid)) ? strpos($this->ticketstatus_statusid, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->ticketstatus_statusid))
          {
              $this->ticketstatus_statusid = substr($this->ticketstatus_statusid, 0, $tmp_pos);
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['ticket_ticketid'])) ? $this->New_label['ticket_ticketid'] : ""; 
          if ($Cada_col == "ticket_ticketid" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ticket_tickettrack'])) ? $this->New_label['ticket_tickettrack'] : ""; 
          if ($Cada_col == "ticket_tickettrack" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ticket_ticketdate'])) ? $this->New_label['ticket_ticketdate'] : ""; 
          if ($Cada_col == "ticket_ticketdate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ticket_subject'])) ? $this->New_label['ticket_subject'] : ""; 
          if ($Cada_col == "ticket_subject" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['staff_staffname'])) ? $this->New_label['staff_staffname'] : ""; 
          if ($Cada_col == "staff_staffname" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ticket_ticketlastupdate'])) ? $this->New_label['ticket_ticketlastupdate'] : ""; 
          if ($Cada_col == "ticket_ticketlastupdate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ticketpriority_priorityicon'])) ? $this->New_label['ticketpriority_priorityicon'] : ""; 
          if ($Cada_col == "ticketpriority_priorityicon" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ticket_ticketpriorityid'])) ? $this->New_label['ticket_ticketpriorityid'] : ""; 
          if ($Cada_col == "ticket_ticketpriorityid" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ticketstatus_statusicon'])) ? $this->New_label['ticketstatus_statusicon'] : ""; 
          if ($Cada_col == "ticketstatus_statusicon" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ticketstatus_statusname'])) ? $this->New_label['ticketstatus_statusname'] : ""; 
          if ($Cada_col == "ticketstatus_statusname" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT ticket.ticketid as ticket_ticketid, ticket.tickettrack as ticket_tickettrack, ticket.ticketdate as ticket_ticketdate, ticket.subject as ticket_subject, staff.staffname as staff_staffname, ticket.ticketlastupdate as ticket_ticketlastupdate, ticketpriority.priorityicon as ticketpriority_priorityicon, ticket.ticketpriorityid as ticket_ticketpriorityid, ticketstatus.statusicon as ticketstatus_statusicon, ticketstatus.statusname as ticketstatus_statusname, ticketpriority.priorityname as ticketpriority_priorityname from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT ticket.ticketid as ticket_ticketid, ticket.tickettrack as ticket_tickettrack, ticket.ticketdate as ticket_ticketdate, ticket.subject as ticket_subject, staff.staffname as staff_staffname, ticket.ticketlastupdate as ticket_ticketlastupdate, ticketpriority.priorityicon as ticketpriority_priorityicon, ticket.ticketpriorityid as ticket_ticketpriorityid, ticketstatus.statusicon as ticketstatus_statusicon, ticketstatus.statusname as ticketstatus_statusname, ticketpriority.priorityname as ticketpriority_priorityname from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT ticket.ticketid as ticket_ticketid, ticket.tickettrack as ticket_tickettrack, ticket.ticketdate as ticket_ticketdate, ticket.subject as ticket_subject, staff.staffname as staff_staffname, ticket.ticketlastupdate as ticket_ticketlastupdate, ticketpriority.priorityicon as ticketpriority_priorityicon, ticket.ticketpriorityid as ticket_ticketpriorityid, ticketstatus.statusicon as ticketstatus_statusicon, ticketstatus.statusname as ticketstatus_statusname, ticketpriority.priorityname as ticketpriority_priorityname from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT ticket.ticketid as ticket_ticketid, ticket.tickettrack as ticket_tickettrack, ticket.ticketdate as ticket_ticketdate, ticket.subject as ticket_subject, staff.staffname as staff_staffname, ticket.ticketlastupdate as ticket_ticketlastupdate, ticketpriority.priorityicon as ticketpriority_priorityicon, ticket.ticketpriorityid as ticket_ticketpriorityid, ticketstatus.statusicon as ticketstatus_statusicon, ticketstatus.statusname as ticketstatus_statusname, ticketpriority.priorityname as ticketpriority_priorityname from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT ticket.ticketid as ticket_ticketid, ticket.tickettrack as ticket_tickettrack, ticket.ticketdate as ticket_ticketdate, ticket.subject as ticket_subject, staff.staffname as staff_staffname, ticket.ticketlastupdate as ticket_ticketlastupdate, LOTOFILE(ticketpriority.priorityicon, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as ticketpriority_priorityicon, ticket.ticketpriorityid as ticket_ticketpriorityid, LOTOFILE(ticketstatus.statusicon, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as ticketstatus_statusicon, ticketstatus.statusname as ticketstatus_statusname, ticketpriority.priorityname as ticketpriority_priorityname from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT ticket.ticketid as ticket_ticketid, ticket.tickettrack as ticket_tickettrack, ticket.ticketdate as ticket_ticketdate, ticket.subject as ticket_subject, staff.staffname as staff_staffname, ticket.ticketlastupdate as ticket_ticketlastupdate, ticketpriority.priorityicon as ticketpriority_priorityicon, ticket.ticketpriorityid as ticket_ticketpriorityid, ticketstatus.statusicon as ticketstatus_statusicon, ticketstatus.statusname as ticketstatus_statusname, ticketpriority.priorityname as ticketpriority_priorityname from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['order_grid'];
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
         $this->ticket_ticketid = $rs->fields[0] ;  
         $this->ticket_tickettrack = $rs->fields[1] ;  
         $this->ticket_ticketdate = $rs->fields[2] ;  
         $this->ticket_subject = $rs->fields[3] ;  
         $this->staff_staffname = $rs->fields[4] ;  
         $this->ticket_ticketlastupdate = $rs->fields[5] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->ticketpriority_priorityicon = "";  
              if (is_file($rs_grid->fields[6])) 
              { 
                  $this->ticketpriority_priorityicon = file_get_contents($rs_grid->fields[6]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->ticketpriority_priorityicon = $this->Db->BlobDecode($rs->fields[6]) ;  
         } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
         { 
             $this->ticketpriority_priorityicon = $this->Db->BlobDecode($rs->fields[6]) ;  
         } 
         else
         { 
             $this->ticketpriority_priorityicon = $rs->fields[6] ;  
         } 
         $this->ticket_ticketpriorityid = $rs->fields[7] ;  
         $this->ticket_ticketpriorityid = (string)$this->ticket_ticketpriorityid;
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->ticketstatus_statusicon = "";  
              if (is_file($rs_grid->fields[8])) 
              { 
                  $this->ticketstatus_statusicon = file_get_contents($rs_grid->fields[8]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->ticketstatus_statusicon = $this->Db->BlobDecode($rs->fields[8]) ;  
         } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
         { 
             $this->ticketstatus_statusicon = $this->Db->BlobDecode($rs->fields[8]) ;  
         } 
         else
         { 
             $this->ticketstatus_statusicon = $rs->fields[8] ;  
         } 
         $this->ticketstatus_statusname = $rs->fields[9] ;  
         $this->ticketpriority_priorityname = $rs->fields[10] ;  
         $this->ticketpriority_priorityicon = "";
         $this->ticketstatus_statusicon = "";
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['grid_customers_tickets']['contr_erro'] = 'on';
 $this->ticket_ticketpriorityid  = $this->ticketpriority_priorityname ;
$_SESSION['scriptcase']['grid_customers_tickets']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- ticket_ticketid
   function NM_export_ticket_ticketid()
   {
             nmgp_Form_Num_Val($this->ticket_ticketid, "", "", "0", "S", "2", "", "N:4", "-") ; 
         $this->ticket_ticketid = NM_charset_to_utf8($this->ticket_ticketid);
         $this->ticket_ticketid = str_replace('<', '&lt;', $this->ticket_ticketid);
         $this->ticket_ticketid = str_replace('>', '&gt;', $this->ticket_ticketid);
         $this->Texto_tag .= "<td>" . $this->ticket_ticketid . "</td>\r\n";
   }
   //----- ticket_tickettrack
   function NM_export_ticket_tickettrack()
   {
         $this->ticket_tickettrack = html_entity_decode($this->ticket_tickettrack, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ticket_tickettrack = strip_tags($this->ticket_tickettrack);
         $this->ticket_tickettrack = NM_charset_to_utf8($this->ticket_tickettrack);
         $this->ticket_tickettrack = str_replace('<', '&lt;', $this->ticket_tickettrack);
         $this->ticket_tickettrack = str_replace('>', '&gt;', $this->ticket_tickettrack);
         $this->Texto_tag .= "<td>" . $this->ticket_tickettrack . "</td>\r\n";
   }
   //----- ticket_ticketdate
   function NM_export_ticket_ticketdate()
   {
             $conteudo_x =  $this->ticket_ticketdate;
             nm_conv_limpa_dado($conteudo_x, "");
             if (is_numeric($conteudo_x) && $conteudo_x > 0) 
             { 
                 $this->nm_data->SetaData($this->ticket_ticketdate, "");
                 $this->ticket_ticketdate = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         $this->ticket_ticketdate = NM_charset_to_utf8($this->ticket_ticketdate);
         $this->ticket_ticketdate = str_replace('<', '&lt;', $this->ticket_ticketdate);
         $this->ticket_ticketdate = str_replace('>', '&gt;', $this->ticket_ticketdate);
         $this->Texto_tag .= "<td>" . $this->ticket_ticketdate . "</td>\r\n";
   }
   //----- ticket_subject
   function NM_export_ticket_subject()
   {
         $this->ticket_subject = html_entity_decode($this->ticket_subject, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ticket_subject = strip_tags($this->ticket_subject);
         $this->ticket_subject = NM_charset_to_utf8($this->ticket_subject);
         $this->ticket_subject = str_replace('<', '&lt;', $this->ticket_subject);
         $this->ticket_subject = str_replace('>', '&gt;', $this->ticket_subject);
         $this->Texto_tag .= "<td>" . $this->ticket_subject . "</td>\r\n";
   }
   //----- staff_staffname
   function NM_export_staff_staffname()
   {
         $this->staff_staffname = html_entity_decode($this->staff_staffname, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->staff_staffname = strip_tags($this->staff_staffname);
         $this->staff_staffname = NM_charset_to_utf8($this->staff_staffname);
         $this->staff_staffname = str_replace('<', '&lt;', $this->staff_staffname);
         $this->staff_staffname = str_replace('>', '&gt;', $this->staff_staffname);
         $this->Texto_tag .= "<td>" . $this->staff_staffname . "</td>\r\n";
   }
   //----- ticket_ticketlastupdate
   function NM_export_ticket_ticketlastupdate()
   {
             $conteudo_x =  $this->ticket_ticketlastupdate;
             nm_conv_limpa_dado($conteudo_x, "");
             if (is_numeric($conteudo_x) && $conteudo_x > 0) 
             { 
                 $this->nm_data->SetaData($this->ticket_ticketlastupdate, "");
                 $this->ticket_ticketlastupdate = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         $this->ticket_ticketlastupdate = NM_charset_to_utf8($this->ticket_ticketlastupdate);
         $this->ticket_ticketlastupdate = str_replace('<', '&lt;', $this->ticket_ticketlastupdate);
         $this->ticket_ticketlastupdate = str_replace('>', '&gt;', $this->ticket_ticketlastupdate);
         $this->Texto_tag .= "<td>" . $this->ticket_ticketlastupdate . "</td>\r\n";
   }
   //----- ticketpriority_priorityicon
   function NM_export_ticketpriority_priorityicon()
   {
         $this->ticketpriority_priorityicon = NM_charset_to_utf8($this->ticketpriority_priorityicon);
         $this->ticketpriority_priorityicon = str_replace('<', '&lt;', $this->ticketpriority_priorityicon);
         $this->ticketpriority_priorityicon = str_replace('>', '&gt;', $this->ticketpriority_priorityicon);
         $this->Texto_tag .= "<td>" . $this->ticketpriority_priorityicon . "</td>\r\n";
   }
   //----- ticket_ticketpriorityid
   function NM_export_ticket_ticketpriorityid()
   {
             nmgp_Form_Num_Val($this->ticket_ticketpriorityid, ",", "", "0", "S", "2", "", "N:2", "-") ; 
         $this->ticket_ticketpriorityid = NM_charset_to_utf8($this->ticket_ticketpriorityid);
         $this->ticket_ticketpriorityid = str_replace('<', '&lt;', $this->ticket_ticketpriorityid);
         $this->ticket_ticketpriorityid = str_replace('>', '&gt;', $this->ticket_ticketpriorityid);
         $this->Texto_tag .= "<td>" . $this->ticket_ticketpriorityid . "</td>\r\n";
   }
   //----- ticketstatus_statusicon
   function NM_export_ticketstatus_statusicon()
   {
         $this->ticketstatus_statusicon = NM_charset_to_utf8($this->ticketstatus_statusicon);
         $this->ticketstatus_statusicon = str_replace('<', '&lt;', $this->ticketstatus_statusicon);
         $this->ticketstatus_statusicon = str_replace('>', '&gt;', $this->ticketstatus_statusicon);
         $this->Texto_tag .= "<td>" . $this->ticketstatus_statusicon . "</td>\r\n";
   }
   //----- ticketstatus_statusname
   function NM_export_ticketstatus_statusname()
   {
         $this->ticketstatus_statusname = html_entity_decode($this->ticketstatus_statusname, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ticketstatus_statusname = strip_tags($this->ticketstatus_statusname);
         $this->ticketstatus_statusname = NM_charset_to_utf8($this->ticketstatus_statusname);
         $this->ticketstatus_statusname = str_replace('<', '&lt;', $this->ticketstatus_statusname);
         $this->ticketstatus_statusname = str_replace('>', '&gt;', $this->ticketstatus_statusname);
         $this->Texto_tag .= "<td>" . $this->ticketstatus_statusname . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_customers_tickets'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_customer_mytickets'] ?> :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_customers_tickets_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_customers_tickets"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="grid_customers_tickets.php"> 
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
}

?>