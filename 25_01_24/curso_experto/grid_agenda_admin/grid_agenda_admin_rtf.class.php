<?php

class grid_agenda_admin_rtf
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
      $this->nm_data   = new nm_data("es");
      $this->Texto_tag = "";
   }


function actionBar_isValidState($buttonName, $buttonState)
{
    switch ($buttonName) {
    }

    return false;
}


function actionBar_displayState($buttonName)
{
    switch ($buttonName) {
    }
}

function actionBar_getStateHint($buttonName)
{
    switch ($buttonName) {
    }
}

function actionBar_getStateConfirm($buttonName)
{
    switch ($buttonName) {
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
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
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
                   nm_limpa_str_grid_agenda_admin($cadapar[1]);
                   nm_protect_num_grid_agenda_admin($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_agenda_admin']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($glo_tecnico_id)) 
      {
          $_SESSION['glo_tecnico_id'] = $glo_tecnico_id;
          nm_limpa_str_grid_agenda_admin($_SESSION["glo_tecnico_id"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_agenda_admin_total.class.php"); 
      $this->Tot      = new grid_agenda_admin_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['tot_geral'][1];
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['SC_Ind_Groupby'] == "sc_free_group_by")
          {
              $this->sum_valor_total = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['tot_geral'][2];
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['SC_Ind_Groupby'] == "ag_estado")
          {
              $this->sum_valor_total = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['tot_geral'][2];
              $this->cnt_estado_actual = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['tot_geral'][3];
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['SC_Ind_Groupby'] == "ag_mes")
          {
              $this->sum_valor_total = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['tot_geral'][2];
              $this->max_valor_total = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['tot_geral'][3];
              $this->avg_valor_total = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['tot_geral'][4];
          }
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_agenda_admin']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_agenda_admin";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_agenda_admin.rtf";
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
      $this->New_label['id_agenda'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_id_agenda'] . "";
      $this->New_label['id_cliente'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_id_cliente'] . "";
      $this->New_label['valor_total'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_valor_total'] . "";
      $this->New_label['fecha_inicial'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_inicial'] . "";
      $this->New_label['hora_inicial'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_hora_inicial'] . "";
      $this->New_label['estado_actual'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_estado_actual'] . "";
      $this->New_label['evaluacion'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_evaluacion'] . "";
      $this->New_label['id_tecnico'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_id_tecnico'] . "";
      $this->New_label['valor'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_valor'] . "";
      $this->New_label['costes_adicionales'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_costes_adicionales'] . "";
      $this->New_label['descuento'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_descuento'] . "";
      $this->New_label['fecha_inicial_scgb_19'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_inicial'] . "";
      $this->New_label['fecha_inicial_scgb_41'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_inicial'] . "";
      $this->New_label['fecha_final'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_final'] . "";
      $this->New_label['hora_final'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_hora_final'] . "";
      $this->New_label['recurrencia'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_recurrencia'] . "";
      $this->New_label['periodo'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_periodo'] . "";
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_agenda_admin']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_agenda_admin']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_agenda_admin']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->id_tecnico = (isset($Busca_temp['id_tecnico'])) ? $Busca_temp['id_tecnico'] : ""; 
          $tmp_pos = (is_string($this->id_tecnico)) ? strpos($this->id_tecnico, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->id_tecnico))
          {
              $this->id_tecnico = substr($this->id_tecnico, 0, $tmp_pos);
          }
          $this->valor_total = (isset($Busca_temp['valor_total'])) ? $Busca_temp['valor_total'] : ""; 
          $tmp_pos = (is_string($this->valor_total)) ? strpos($this->valor_total, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->valor_total))
          {
              $this->valor_total = substr($this->valor_total, 0, $tmp_pos);
          }
          $this->fecha_final = (isset($Busca_temp['fecha_final'])) ? $Busca_temp['fecha_final'] : ""; 
          $tmp_pos = (is_string($this->fecha_final)) ? strpos($this->fecha_final, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->fecha_final))
          {
              $this->fecha_final = substr($this->fecha_final, 0, $tmp_pos);
          }
          $this->fecha_final_2 = (isset($Busca_temp['fecha_final_input_2'])) ? $Busca_temp['fecha_final_input_2'] : ""; 
          $this->estado_actual = (isset($Busca_temp['estado_actual'])) ? $Busca_temp['estado_actual'] : ""; 
          $tmp_pos = (is_string($this->estado_actual)) ? strpos($this->estado_actual, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->estado_actual))
          {
              $this->estado_actual = substr($this->estado_actual, 0, $tmp_pos);
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['id_agenda'])) ? $this->New_label['id_agenda'] : ""; 
          if ($Cada_col == "id_agenda" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['id_cliente'])) ? $this->New_label['id_cliente'] : ""; 
          if ($Cada_col == "id_cliente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['valor_total'])) ? $this->New_label['valor_total'] : ""; 
          if ($Cada_col == "valor_total" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['fecha_inicial'])) ? $this->New_label['fecha_inicial'] : ""; 
          if ($Cada_col == "fecha_inicial" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['hora_inicial'])) ? $this->New_label['hora_inicial'] : ""; 
          if ($Cada_col == "hora_inicial" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['estado_actual'])) ? $this->New_label['estado_actual'] : ""; 
          if ($Cada_col == "estado_actual" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evaluacion'])) ? $this->New_label['evaluacion'] : ""; 
          if ($Cada_col == "evaluacion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['id_tecnico'])) ? $this->New_label['id_tecnico'] : ""; 
          if ($Cada_col == "id_tecnico" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['valor'])) ? $this->New_label['valor'] : ""; 
          if ($Cada_col == "valor" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['costes_adicionales'])) ? $this->New_label['costes_adicionales'] : ""; 
          if ($Cada_col == "costes_adicionales" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['descuento'])) ? $this->New_label['descuento'] : ""; 
          if ($Cada_col == "descuento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT id_agenda, id_cliente, valor_total, str_replace (convert(char(10),fecha_inicial,102), '.', '-') + ' ' + convert(char(8),fecha_inicial,20), str_replace (convert(char(10),hora_inicial,102), '.', '-') + ' ' + convert(char(8),hora_inicial,20), estado_actual, evaluacion, id_tecnico, valor, costes_adicionales, descuento from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT id_agenda, id_cliente, valor_total, fecha_inicial, hora_inicial, estado_actual, evaluacion, id_tecnico, valor, costes_adicionales, descuento from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT id_agenda, id_cliente, valor_total, convert(char(23),fecha_inicial,121), convert(char(23),hora_inicial,121), estado_actual, evaluacion, id_tecnico, valor, costes_adicionales, descuento from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT id_agenda, id_cliente, valor_total, fecha_inicial, hora_inicial, estado_actual, evaluacion, id_tecnico, valor, costes_adicionales, descuento from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT id_agenda, id_cliente, valor_total, EXTEND(fecha_inicial, YEAR TO DAY), hora_inicial, estado_actual, evaluacion, id_tecnico, valor, costes_adicionales, descuento from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT id_agenda, id_cliente, valor_total, fecha_inicial, hora_inicial, estado_actual, evaluacion, id_tecnico, valor, costes_adicionales, descuento from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['where_resumo']; 
              $nmgp_select_count .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['where_resumo'] . ")"; 
              $nmgp_select_count .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['order_grid'];
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
         $this->id_agenda = $rs->fields[0] ;  
         $this->id_agenda = (string)$this->id_agenda;
         $this->id_cliente = $rs->fields[1] ;  
         $this->id_cliente = (string)$this->id_cliente;
         $this->valor_total = $rs->fields[2] ;  
         $this->valor_total =  str_replace(",", ".", $this->valor_total);
         $this->valor_total = (string)$this->valor_total;
         $this->fecha_inicial = $rs->fields[3] ;  
         $this->hora_inicial = $rs->fields[4] ;  
         $this->estado_actual = $rs->fields[5] ;  
         $this->estado_actual = (string)$this->estado_actual;
         $this->evaluacion = $rs->fields[6] ;  
         $this->evaluacion = (string)$this->evaluacion;
         $this->id_tecnico = $rs->fields[7] ;  
         $this->id_tecnico = (string)$this->id_tecnico;
         $this->valor = $rs->fields[8] ;  
         $this->valor =  str_replace(",", ".", $this->valor);
         $this->valor = (string)$this->valor;
         $this->costes_adicionales = $rs->fields[9] ;  
         $this->costes_adicionales =  str_replace(",", ".", $this->costes_adicionales);
         $this->costes_adicionales = (string)$this->costes_adicionales;
         $this->descuento = $rs->fields[10] ;  
         $this->descuento =  str_replace(",", ".", $this->descuento);
         $this->descuento = (string)$this->descuento;
         $this->Orig_id_agenda = $this->id_agenda;
         $this->Orig_id_cliente = $this->id_cliente;
         $this->Orig_valor_total = $this->valor_total;
         $this->Orig_fecha_inicial = $this->fecha_inicial;
         $this->Orig_hora_inicial = $this->hora_inicial;
         $this->Orig_estado_actual = $this->estado_actual;
         $this->Orig_evaluacion = $this->evaluacion;
         $this->Orig_id_tecnico = $this->id_tecnico;
         $this->Orig_valor = $this->valor;
         $this->Orig_costes_adicionales = $this->costes_adicionales;
         $this->Orig_descuento = $this->descuento;
         //----- lookup - id_cliente
         $this->look_id_cliente = $this->id_cliente; 
         $this->Lookup->lookup_id_cliente($this->look_id_cliente, $this->id_cliente) ; 
         $this->look_id_cliente = ($this->look_id_cliente == "&nbsp;") ? "" : $this->look_id_cliente; 
         //----- lookup - estado_actual
         $this->look_estado_actual = $this->estado_actual; 
         $this->Lookup->lookup_estado_actual($this->look_estado_actual, $this->estado_actual) ; 
         $this->look_estado_actual = ($this->look_estado_actual == "&nbsp;") ? "" : $this->look_estado_actual; 
         //----- lookup - id_tecnico
         $this->look_id_tecnico = $this->id_tecnico; 
         $this->Lookup->lookup_id_tecnico($this->look_id_tecnico, $this->id_tecnico) ; 
         $this->look_id_tecnico = ($this->look_id_tecnico == "&nbsp;") ? "" : $this->look_id_tecnico; 
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- id_agenda
   function NM_export_id_agenda()
   {
             nmgp_Form_Num_Val($this->id_agenda, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->id_agenda = NM_charset_to_utf8($this->id_agenda);
         $this->id_agenda = str_replace('<', '&lt;', $this->id_agenda);
         $this->id_agenda = str_replace('>', '&gt;', $this->id_agenda);
         $this->Texto_tag .= "<td>" . $this->id_agenda . "</td>\r\n";
   }
   //----- id_cliente
   function NM_export_id_cliente()
   {
         nmgp_Form_Num_Val($this->look_id_cliente, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_id_cliente = NM_charset_to_utf8($this->look_id_cliente);
         $this->look_id_cliente = str_replace('<', '&lt;', $this->look_id_cliente);
         $this->look_id_cliente = str_replace('>', '&gt;', $this->look_id_cliente);
         $this->Texto_tag .= "<td>" . $this->look_id_cliente . "</td>\r\n";
   }
   //----- valor_total
   function NM_export_valor_total()
   {
             nmgp_Form_Num_Val($this->valor_total, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->valor_total = NM_charset_to_utf8($this->valor_total);
         $this->valor_total = str_replace('<', '&lt;', $this->valor_total);
         $this->valor_total = str_replace('>', '&gt;', $this->valor_total);
         $this->Texto_tag .= "<td>" . $this->valor_total . "</td>\r\n";
   }
   //----- fecha_inicial
   function NM_export_fecha_inicial()
   {
             $conteudo_x =  $this->fecha_inicial;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->fecha_inicial, "YYYY-MM-DD  ");
                 $this->fecha_inicial = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         $this->fecha_inicial = NM_charset_to_utf8($this->fecha_inicial);
         $this->fecha_inicial = str_replace('<', '&lt;', $this->fecha_inicial);
         $this->fecha_inicial = str_replace('>', '&gt;', $this->fecha_inicial);
         $this->Texto_tag .= "<td>" . $this->fecha_inicial . "</td>\r\n";
   }
   //----- hora_inicial
   function NM_export_hora_inicial()
   {
             $conteudo_x =  $this->hora_inicial;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hora_inicial, "HH:II:SS  ");
                 $this->hora_inicial = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhii"));
             } 
         $this->hora_inicial = NM_charset_to_utf8($this->hora_inicial);
         $this->hora_inicial = str_replace('<', '&lt;', $this->hora_inicial);
         $this->hora_inicial = str_replace('>', '&gt;', $this->hora_inicial);
         $this->Texto_tag .= "<td>" . $this->hora_inicial . "</td>\r\n";
   }
   //----- estado_actual
   function NM_export_estado_actual()
   {
         nmgp_Form_Num_Val($this->look_estado_actual, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_estado_actual = NM_charset_to_utf8($this->look_estado_actual);
         $this->look_estado_actual = str_replace('<', '&lt;', $this->look_estado_actual);
         $this->look_estado_actual = str_replace('>', '&gt;', $this->look_estado_actual);
         $this->Texto_tag .= "<td>" . $this->look_estado_actual . "</td>\r\n";
   }
   //----- evaluacion
   function NM_export_evaluacion()
   {
             nmgp_Form_Num_Val($this->evaluacion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->evaluacion = NM_charset_to_utf8($this->evaluacion);
         $this->evaluacion = str_replace('<', '&lt;', $this->evaluacion);
         $this->evaluacion = str_replace('>', '&gt;', $this->evaluacion);
         $this->Texto_tag .= "<td>" . $this->evaluacion . "</td>\r\n";
   }
   //----- id_tecnico
   function NM_export_id_tecnico()
   {
         nmgp_Form_Num_Val($this->look_id_tecnico, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_id_tecnico = NM_charset_to_utf8($this->look_id_tecnico);
         $this->look_id_tecnico = str_replace('<', '&lt;', $this->look_id_tecnico);
         $this->look_id_tecnico = str_replace('>', '&gt;', $this->look_id_tecnico);
         $this->Texto_tag .= "<td>" . $this->look_id_tecnico . "</td>\r\n";
   }
   //----- valor
   function NM_export_valor()
   {
             nmgp_Form_Num_Val($this->valor, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->valor = NM_charset_to_utf8($this->valor);
         $this->valor = str_replace('<', '&lt;', $this->valor);
         $this->valor = str_replace('>', '&gt;', $this->valor);
         $this->Texto_tag .= "<td>" . $this->valor . "</td>\r\n";
   }
   //----- costes_adicionales
   function NM_export_costes_adicionales()
   {
             nmgp_Form_Num_Val($this->costes_adicionales, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->costes_adicionales = NM_charset_to_utf8($this->costes_adicionales);
         $this->costes_adicionales = str_replace('<', '&lt;', $this->costes_adicionales);
         $this->costes_adicionales = str_replace('>', '&gt;', $this->costes_adicionales);
         $this->Texto_tag .= "<td>" . $this->costes_adicionales . "</td>\r\n";
   }
   //----- descuento
   function NM_export_descuento()
   {
             nmgp_Form_Num_Val($this->descuento, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->descuento = NM_charset_to_utf8($this->descuento);
         $this->descuento = str_replace('<', '&lt;', $this->descuento);
         $this->descuento = str_replace('>', '&gt;', $this->descuento);
         $this->Texto_tag .= "<td>" . $this->descuento . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_admin'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?> <?php echo $this->Ini->Nm_lang['lang_tbl_agenda'] ?> :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_agenda_admin_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_agenda_admin"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
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
function saludo($par_quien) {
$_SESSION['scriptcase']['grid_agenda_admin']['contr_erro'] = 'on';
  
    echo "Hola, $par_quien";

$_SESSION['scriptcase']['grid_agenda_admin']['contr_erro'] = 'off';
}
function sis_mensaje($par_mensaje = 'mensaje') {
$_SESSION['scriptcase']['grid_agenda_admin']['contr_erro'] = 'on';
  
    $cad = "<div id='caja_mensaje' ";
    $cad .= "style='background-color: darkgrey;color: white;width: 600px;margin: 0 auto;";
    $cad .= "padding: 2px;margin: 10px auto;border: 1px solid black;border-radius: 20px;text-align: center;'>";
    $cad .= "<h2>";
    $cad .= $par_mensaje;
    $cad .= "</h2>";
    $cad .= "</div>";
    echo $cad;

$_SESSION['scriptcase']['grid_agenda_admin']['contr_erro'] = 'off';
}
function sis_cita_guardar_historico($par_id_cita, $par_estado_actual, $par_movimiento){
$_SESSION['scriptcase']['grid_agenda_admin']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
	if(isset($this->sc_temp_usr_login)){
		$usr=$this->sc_temp_usr_login;
	}else{
		$usr="";
	}
	$sql = "insert into historial_agenda (id_agenda, fecha_historial_agenda, estado_agenda, descr_historial_agenda, usuario_login) }
	values (
	$par_id_cita,
	now(),
	$par_estado_actual,
	'$par_movimiento',
	'$usr'
	)";
	
     $nm_select = $sql; 
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
      
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['grid_agenda_admin']['contr_erro'] = 'off';
}
}

?>
