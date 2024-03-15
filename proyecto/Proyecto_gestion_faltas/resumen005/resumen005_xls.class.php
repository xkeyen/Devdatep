<?php

class resumen005_xls
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Xls_dados;
   var $Xls_workbook;
   var $Xls_col;
   var $Xls_row;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();
   var $NM_ctrl_style = array();
   var $Arquivo;
   var $Tit_doc;
   var $count_ger;
   var $sum_cantidad;
   var $sum_porcentaje;
   var $falta_Old;
   var $arg_sum_falta;
   var $Label_falta;
   var $sc_proc_quebra_falta;
   var $count_falta;
   var $sum_falta_cantidad;
   var $sum_falta_porcentaje;
   //---- 
   function __construct()
   {
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
   function monta_xls()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida']) {
          if ($this->Ini->sc_export_ajax)
          {
              $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Xls_f);
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
      else { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['opcao'] = "";
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
                   nm_limpa_str_resumen005($cadapar[1]);
                   nm_protect_num_resumen005($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['resumen005']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      $this->Use_phpspreadsheet = (phpversion() >=  "7.3.9" && is_dir($this->Ini->path_third . '/phpspreadsheet')) ? true : false;
      $this->Xls_tot_col = 0;
      $this->Xls_row     = 0;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'])
      { 
          if ($this->Use_phpspreadsheet) {
              require_once $this->Ini->path_third . '/phpspreadsheet/vendor/autoload.php';
          } 
          else { 
              set_include_path(get_include_path() . PATH_SEPARATOR . $this->Ini->path_third . '/phpexcel/');
              require_once $this->Ini->path_third . '/phpexcel/PHPExcel.php';
              require_once $this->Ini->path_third . '/phpexcel/PHPExcel/IOFactory.php';
              require_once $this->Ini->path_third . '/phpexcel/PHPExcel/Cell/AdvancedValueBinder.php';
          } 
      } 
      $orig_form_dt = strtoupper($_SESSION['scriptcase']['reg_conf']['date_format']);
      $this->SC_date_conf_region = "";
      for ($i = 0; $i < 8; $i++)
      {
          if ($i > 0 && substr($orig_form_dt, $i, 1) != substr($this->SC_date_conf_region, -1, 1)) {
              $this->SC_date_conf_region .= $_SESSION['scriptcase']['reg_conf']['date_sep'];
          }
          $this->SC_date_conf_region .= substr($orig_form_dt, $i, 1);
      }
      $this->Xls_tp = ".xlsx";
      if (isset($_REQUEST['nmgp_tp_xls']) && !empty($_REQUEST['nmgp_tp_xls']))
      {
          $this->Xls_tp = "." . $_REQUEST['nmgp_tp_xls'];
      }
      $this->groupby_show = "S";
      if (isset($_REQUEST['nmgp_tot_xls']) && !empty($_REQUEST['nmgp_tot_xls']))
      {
          $this->groupby_show = $_REQUEST['nmgp_tot_xls'];
      }
      $this->Xls_col      = 0;
      $this->Tem_xls_res  = false;
      $this->Xls_password = "";
      $this->nm_data      = new nm_data("es");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'])
      { 
          $this->Tem_xls_res  = true;
          if (isset($_REQUEST['SC_module_export']) && $_REQUEST['SC_module_export'] != "")
          { 
              $this->Tem_xls_res = (strpos(" " . $_REQUEST['SC_module_export'], "resume") !== false || strpos(" " . $_REQUEST['SC_module_export'], "chart") !== false) ? true : false;
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Gb_Free_cmp']))
          {
              $this->Tem_xls_res  = false;
          }
          if (!is_file($this->Ini->root . $this->Ini->path_link . "resumen005/resumen005_res_xls.class.php"))
          {
              $this->Tem_xls_res  = false;
          }
          if ($this->Tem_xls_res)
          { 
              require_once($this->Ini->path_aplicacao . "resumen005_res_xls.class.php");
              $this->Res_xls = new resumen005_res_xls();
              $this->prep_modulos("Res_xls");
          } 
          $this->Arquivo    = "sc_xls";
          $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
          $this->Arq_zip    = $this->Arquivo . "_resumen005.zip";
          $this->Arquivo   .= "_resumen005" . $this->Xls_tp;
          $this->Tit_doc    = "resumen005" . $this->Xls_tp;
          $this->Tit_zip    = "resumen005.zip";
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
          if ($this->Use_phpspreadsheet) {
              $this->Xls_dados = new PhpOffice\PhpSpreadsheet\Spreadsheet();
              \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder() );
          }
          else {
              PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
              $this->Xls_dados = new PHPExcel();
          }
          $this->Xls_dados->setActiveSheetIndex(0);
          $this->Nm_ActiveSheet = $this->Xls_dados->getActiveSheet();
          $this->Nm_ActiveSheet->setTitle($this->Ini->Nm_lang['lang_othr_grid_titl']);
          if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
          {
              $this->Nm_ActiveSheet->setRightToLeft(true);
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Ind_Groupby'] == "FALTA")
      {
          require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
          $this->Res = new resumen005_resumo("out");
          $this->prep_modulos("Res");
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Ind_Groupby'] == "sc_free_total")
      {
          require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
          $this->Res = new resumen005_resumo("out");
          $this->prep_modulos("Res");
      }
      $this->GB_tot_php = array('FALTA','sc_free_total');
      if (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Ind_Groupby'], $this->GB_tot_php))
      {
          $Tot_Gb = "totaliza_php_" . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Ind_Groupby'];
          $this->$Tot_Gb();
      }
      else
      {
          require_once($this->Ini->path_aplicacao . "resumen005_total.class.php"); 
          $this->Tot = new resumen005_total($this->Ini->sc_page);
          $this->prep_modulos("Tot");
          $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Ind_Groupby'];
          $this->Tot->$Gb_geral();
      }
      $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['tot_geral'][1];
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Ind_Groupby'] == "FALTA")
      {
          $this->sum_cantidad = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['tot_geral'][2];
          $this->sum_porcentaje = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['tot_geral'][3];
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['resumen005']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_return']);
          if ($this->Tem_xls_res) {
              $PB_plus = intval ($this->count_ger * 0.04);
              $PB_plus = ($PB_plus < 2) ? 2 : $PB_plus;
          }
          else {
              $PB_plus = intval ($this->count_ger * 0.02);
              $PB_plus = ($PB_plus < 1) ? 1 : $PB_plus;
          }
          $PB_tot = $this->count_ger + $PB_plus;
          $this->PB_dif = $PB_tot - $this->count_ger;
          $this->pb->setTotalSteps($PB_tot );
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Ind_Groupby'] == "FALTA")
      {
          $this->sum_cantidad = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['tot_geral'][2];
          $this->sum_porcentaje = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['tot_geral'][3];
      }
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
   function grava_arquivo()
   {
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['resumen005']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['resumen005']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['resumen005']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['field_order'] as $Cada_cmp)
      {
          if (!isset($this->NM_cmp_hidden[$Cada_cmp]) || $this->NM_cmp_hidden[$Cada_cmp] != "off")
          {
              $this->Xls_tot_col++;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->falta = (isset($Busca_temp['falta'])) ? $Busca_temp['falta'] : ""; 
          $tmp_pos = (is_string($this->falta)) ? strpos($this->falta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->falta))
          {
              $this->falta = substr($this->falta, 0, $tmp_pos);
          }
          $this->cantidad = (isset($Busca_temp['cantidad'])) ? $Busca_temp['cantidad'] : ""; 
          $tmp_pos = (is_string($this->cantidad)) ? strpos($this->cantidad, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cantidad))
          {
              $this->cantidad = substr($this->cantidad, 0, $tmp_pos);
          }
          $this->tipo_sancion = (isset($Busca_temp['tipo_sancion'])) ? $Busca_temp['tipo_sancion'] : ""; 
          $tmp_pos = (is_string($this->tipo_sancion)) ? strpos($this->tipo_sancion, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_sancion))
          {
              $this->tipo_sancion = substr($this->tipo_sancion, 0, $tmp_pos);
          }
          $this->total_sanciones = (isset($Busca_temp['total_sanciones'])) ? $Busca_temp['total_sanciones'] : ""; 
          $tmp_pos = (is_string($this->total_sanciones)) ? strpos($this->total_sanciones, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->total_sanciones))
          {
              $this->total_sanciones = substr($this->total_sanciones, 0, $tmp_pos);
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_name'] .= $this->Xls_tp;
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_name']);
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida_label']) && $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida_label'])
      { 
          $this->count_span = 0;
          $this->Xls_row++;
          $this->proc_label();
          $_SESSION['scriptcase']['export_return'] = $this->arr_export;
          return;
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT fl.fault_name as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT fl.fault_name as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT fl.fault_name as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT fl.fault_name as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT LOTOFILE(fl.fault_name, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT fl.fault_name as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_resumo']; 
              $nmgp_select_count .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_resumo'] . ")"; 
              $nmgp_select_count .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_select .= " group by fl.fault_name, fr.sanction_type_name"; 
      $nmgp_select_count .= " group by fl.fault_name, fr.sanction_type_name"; 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->SC_seq_register = 0;
      $prim_reg = true;
      $prim_gb  = true;
      $nm_houve_quebra = "N";
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         $prim_reg = false;
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         $this->Xls_col = 0;
         $this->Xls_row++;
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->falta = "";  
              if (is_file($rs_grid->fields[0])) 
              { 
                  $this->falta = file_get_contents($rs_grid->fields[0]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->falta = $this->Db->BlobDecode($rs->fields[0]) ;  
         } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
         { 
             $this->falta = $this->Db->BlobDecode($rs->fields[0]) ;  
         } 
         else
         { 
             $this->falta = $rs->fields[0] ;  
         } 
         $this->cantidad = $rs->fields[1] ;  
         $this->cantidad = (string)$this->cantidad;
         $this->porcentaje = $rs->fields[2] ;  
         $this->porcentaje =  str_replace(",", ".", $this->porcentaje);
         $this->porcentaje = (string)$this->porcentaje;
         $this->tipo_sancion = $rs->fields[3] ;  
         $this->total_sanciones = $rs->fields[4] ;  
         $this->total_sanciones = (string)$this->total_sanciones;
         $this->arg_sum_falta = " = " . $this->Db->qstr($this->falta);
          if (($this->falta !== $this->falta_Old || $NM_prim_qb) && $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Ind_Groupby'] == "FALTA") 
          {  
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'] && !$prim_gb && $this->groupby_show == "S") {
                  $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = "";
                  $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
                  $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
                  $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
              }
              $this->falta_Old = $this->falta ; 
              $this->quebra_falta_FALTA($this->falta) ; 
              if ($this->groupby_show == "S") {
                  $this->Xls_col = 0;
                  $this->Xls_row++;
              }
              if (isset($this->falta_Old))
              {
                 $this->quebra_falta_FALTA_top() ; 
                 if ($this->groupby_show == "S") {
                     $this->Xls_col = 0;
                     $this->Xls_row++;
                 }
              }
              $nm_houve_quebra = "S";
          } 
     if ($this->groupby_show == "S") {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'])
         { 
             if ($prim_gb) {
                 $this->count_span = 0;
                 $this->proc_label();
             }
             if ($prim_gb || $nm_houve_quebra == "S") {
                 $this->xls_sub_cons_copy_label($this->Xls_row);
                 $this->Xls_row++;
             }
         }
         elseif ($prim_gb || $nm_houve_quebra == "S")
         {
             $this->count_span = 0;
             $this->proc_label();
         }
     }
     else {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'])
         { 
             if ($prim_gb)
             {
                 $this->count_span = 0;
                 $this->proc_label();
                 $this->xls_sub_cons_copy_label($this->Xls_row);
                 $this->Xls_row++;
             }
         }
         elseif ($prim_gb)
         {
             $this->count_span = 0;
             $this->proc_label();
         }
     }
     $prim_gb = false;
     $nm_houve_quebra = "N";
         $this->sc_proc_grid = true; 
         if ($this->groupby_show != "S")
         {
             if ($this->sum_porcentaje != 0)
             {
                 $this->porcentaje = $this->porcentaje / $this->sum_porcentaje * 100;
             }
             else
             {
                 $this->porcentaje = 0;
             }
         }
         elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Ind_Groupby'] == "FALTA")
         {
             if ($this->sum_falta_porcentaje != 0)
             {
                 $this->porcentaje = $this->porcentaje / $this->sum_falta_porcentaje * 100;
             }
             else
             {
                 $this->porcentaje = 0;
             }
         }
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'])
                { 
                    $NM_func_exp = "NM_sub_cons_" . $Cada_col;
                    $this->$NM_func_exp();
                } 
                else 
                { 
                    $NM_func_exp = "NM_export_" . $Cada_col;
                    $this->$NM_func_exp();
                } 
            } 
         } 
         if (isset($this->NM_Row_din) && !$_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'])
         { 
             foreach ($this->NM_Row_din as $row => $height) 
             { 
                 $this->Nm_ActiveSheet->getRowDimension($row)->setRowHeight($height);
             } 
         } 
         $rs->MoveNext();
      }
      $this->xls_set_style();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'] && $prim_reg)
      { 
          $this->proc_label();
          $this->xls_sub_cons_copy_label($this->Xls_row);
          $nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
          $nm_grid_sem_reg  = NM_charset_to_utf8($nm_grid_sem_reg);
          $this->Xls_row++;
          $this->arr_export['lines'][$this->Xls_row][1]['data']   = $nm_grid_sem_reg;
          $this->arr_export['lines'][$this->Xls_row][1]['align']  = "right";
          $this->arr_export['lines'][$this->Xls_row][1]['type']   = "char";
          $this->arr_export['lines'][$this->Xls_row][1]['format'] = "";
      }
      if (isset($this->NM_Col_din) && !$_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'])
      { 
          foreach ($this->NM_Col_din as $col => $width)
          { 
              $this->Nm_ActiveSheet->getColumnDimension($col)->setWidth($width / 5);
          } 
      } 
      if ($this->groupby_show == "S") {
          $this->Xls_col = 0;
          $this->Xls_row++;
          $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Ind_Groupby'] . "_bot";
          $this->$Gb_geral();
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'])
      { 
          if ($this->Tem_xls_res)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_res_grid'] = true;
              if (!$this->Ini->sc_export_ajax) {
                  $this->PB_dif = intval ($this->PB_dif / 2);
                  $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
                  $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
                  $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
                  $this->pb->addSteps($this->PB_dif);
              }
              $this->Res_xls->monta_xls();
              if ($this->Use_phpspreadsheet) {
                  $Xls_res = \PhpOffice\PhpSpreadsheet\IOFactory::load($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_res_sheet']);
              }
              else {
                  $Xls_res = PHPExcel_IOFactory::load($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_res_sheet']);
              }
              foreach($Xls_res->getAllSheets() as $sheet)
              {
                  $this->Xls_dados->addExternalSheet($sheet);
              }
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_res_grid']);
              unlink($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_res_sheet']);
          } 
          if (!$this->Ini->sc_export_ajax) {
              $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_btns_export_finished']);
              $this->pb->setProgressbarMessage($Mens_bar);
              $this->pb->addSteps($this->PB_dif);
          }
          if ($this->Use_phpspreadsheet) {
              if ($this->Xls_tp == ".xlsx") {
                  $objWriter = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($this->Xls_dados);
              } 
              else {
                  $objWriter = new PhpOffice\PhpSpreadsheet\Writer\Xls($this->Xls_dados);
              } 
          } 
          else {
              if ($this->Xls_tp == ".xlsx") {
                  $objWriter = new PHPExcel_Writer_Excel2007($this->Xls_dados);
              } 
              else {
                  $objWriter = new PHPExcel_Writer_Excel5($this->Xls_dados);
              } 
          } 
          $objWriter->save($this->Xls_f);
          if ($this->Xls_password != "")
          { 
              $str_zip   = "";
              $Zip_f     = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
              $Arq_input = (FALSE !== strpos($this->Xls_f, ' ')) ? " \"" . $this->Xls_f . "\"" :  $this->Xls_f;
              if (is_file($Zip_f)) {
                  unlink($Zip_f);
              }
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  chdir($this->Ini->path_third . "/zip/windows");
                  $str_zip = "zip.exe -P -j " . $this->Xls_password . " " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
              {
                  if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                  {
                      chdir($this->Ini->path_third . "/zip/linux-i386/bin");
                  }
                  else
                  {
                     chdir($this->Ini->path_third . "/zip/linux-amd64/bin");
                  }
                  $str_zip = "./7za -p" . $this->Xls_password . " a " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  chdir($this->Ini->path_third . "/zip/mac/bin");
                  $str_zip = "./7za -p" . $this->Xls_password . " a " . $Zip_f . " " . $Arq_input;
              }
              if (!empty($str_zip)) {
                  exec($str_zip);
              }
              // ----- ZIP log
              $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'w');
              if ($fp)
              {
                  @fwrite($fp, $str_zip . "\r\n\r\n");
                  @fclose($fp);
              }
              unlink($Arq_input);
              $this->Arquivo = $this->Arq_zip;
              $this->Xls_f   = $this->Zip_f;
              $this->Tit_doc = $this->Tit_zip;
          } 
      } 
      else 
      { 
          $_SESSION['scriptcase']['export_return'] = $this->arr_export;
      } 
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   function proc_label()
   { 
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['falta'])) ? $this->New_label['falta'] : "FALTA"; 
          if ($Cada_col == "falta" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "n";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['cantidad'])) ? $this->New_label['cantidad'] : "CANTIDAD"; 
          if ($Cada_col == "cantidad" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['porcentaje'])) ? $this->New_label['porcentaje'] : "PORCENTAJE"; 
          if ($Cada_col == "porcentaje" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tipo_sancion'])) ? $this->New_label['tipo_sancion'] : "TIPO SANCION"; 
          if ($Cada_col == "tipo_sancion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['total_sanciones'])) ? $this->New_label['total_sanciones'] : "TOTAL SANCIONES"; 
          if ($Cada_col == "total_sanciones" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
      } 
      $this->Xls_col = 0;
      $this->Xls_row++;
   } 
   //----- falta
   function NM_export_falta()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if (empty($this->falta))
         { 
             $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, ' ');
             $this->Xls_col++;
             return;
         } 
         $in_falta = $this->Ini->root . $this->Ini->path_imag_temp . "/sc_falta_" . $_SESSION['scriptcase']['sc_num_img'] . session_id() . ".jpg";
         $_SESSION['scriptcase']['sc_num_img']++;
         $arq_falta = fopen($in_falta, "w");
         if (is_string($this->falta) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
         { 
             $nm_tmp = nm_conv_img_access(substr($this->falta, 0, 12));
             if (substr($nm_tmp, 0, 4) == "*nm*")
             { 
                 $this->falta = nm_conv_img_access($this->falta);
             } 
         } 
         if (is_string($this->falta) && substr($this->falta, 0, 4) == "*nm*")
         { 
             $this->falta = substr($this->falta, 4);
             $this->falta = base64_decode($this->falta);
         } 
         $img_pos_bm = (is_string($this->falta)) ? strpos($this->falta, "BM") : false;
         if (!$img_pos_bm === FALSE && $img_pos_bm == 78)
         { 
             $this->falta = substr($this->falta, $img_pos_bm);
         } 
         fwrite($arq_falta, (string)$this->falta);
         fclose($arq_falta);
         if (is_file($in_falta))
         { 
             $sc_obj_img = new nm_trata_img($in_falta);
             $nm_image_altura  = $sc_obj_img->getHeight();
             $nm_image_largura = $sc_obj_img->getWidth();
             if ($this->Use_phpspreadsheet) {
                 $objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
             }
             else {
                 $objDrawing = new PHPExcel_Worksheet_Drawing();
             }
             $objDrawing->setPath($in_falta);
             $objDrawing->setHeight($nm_image_altura);
             $col = $current_cell_ref;
             $objDrawing->setCoordinates($col . $this->Xls_row);
             $objDrawing->setWorksheet($this->Nm_ActiveSheet);
             if (!isset($this->NM_Col_din[$col]) || $this->NM_Col_din[$col] < $nm_image_largura)
             { 
                 $this->NM_Col_din[$col] = $nm_image_largura;
             } 
             if (!isset($this->NM_Row_din[$this->Xls_row]) || $this->NM_Row_din[$this->Xls_row] < $nm_image_altura)
             { 
                 $this->NM_Row_din[$this->Xls_row] = $nm_image_altura;
             } 
         } 
         else 
         { 
             $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, ' ');
         } 
         $this->Xls_col++;
   }
   //----- cantidad
   function NM_export_cantidad()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "RIGHT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->cantidad = NM_charset_to_utf8($this->cantidad);
         if (is_numeric($this->cantidad))
         {
             $this->NM_ctrl_style[$current_cell_ref]['format'] = '#,##0';
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->cantidad);
         $this->Xls_col++;
   }
   //----- porcentaje
   function NM_export_porcentaje()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "RIGHT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->porcentaje = $this->porcentaje / 100;
         $this->porcentaje = NM_charset_to_utf8($this->porcentaje);
         if (is_numeric($this->porcentaje))
         {
             $this->NM_ctrl_style[$current_cell_ref]['format'] = '0.00%';
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->porcentaje);
         $this->Xls_col++;
   }
   //----- tipo_sancion
   function NM_export_tipo_sancion()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->tipo_sancion = html_entity_decode($this->tipo_sancion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tipo_sancion = strip_tags($this->tipo_sancion);
         $this->tipo_sancion = NM_charset_to_utf8($this->tipo_sancion);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->tipo_sancion, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->tipo_sancion, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- total_sanciones
   function NM_export_total_sanciones()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "RIGHT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->total_sanciones = NM_charset_to_utf8($this->total_sanciones);
         if (is_numeric($this->total_sanciones))
         {
             $this->NM_ctrl_style[$current_cell_ref]['format'] = '#,##0';
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->total_sanciones);
         $this->Xls_col++;
   }
   //----- falta
   function NM_sub_cons_falta()
   {
         if (empty($this->falta))
         { 
             $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = "";
             $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
             $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
             $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
             $this->Xls_col++;
             return;
         } 
         $in_falta = $this->Ini->root . $this->Ini->path_imag_temp . "/sc_falta_" . $_SESSION['scriptcase']['sc_num_img'] . session_id() . ".jpg";
         $_SESSION['scriptcase']['sc_num_img']++;
         $arq_falta = fopen($in_falta, "w");
         if (is_string($this->falta) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
         { 
             $nm_tmp = nm_conv_img_access(substr($this->falta, 0, 12));
             if (substr($nm_tmp, 0, 4) == "*nm*")
             { 
                 $this->falta = nm_conv_img_access($this->falta);
             } 
         } 
         if (is_string($this->falta) && substr($this->falta, 0, 4) == "*nm*")
         { 
             $this->falta = substr($this->falta, 4);
             $this->falta = base64_decode($this->falta);
         } 
         $img_pos_bm = (is_string($this->falta)) ? strpos($this->falta, "BM") : false;
         if (!$img_pos_bm === FALSE && $img_pos_bm == 78)
         { 
             $this->falta = substr($this->falta, $img_pos_bm);
         } 
         fwrite($arq_falta, (string)$this->falta);
         fclose($arq_falta);
         if (is_file($in_falta))
         { 
             $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $in_falta;
             $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
             $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "img";
             $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
             $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['name'] = "";
         } 
         else 
         { 
             $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = "";
             $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
             $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
             $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         } 
         $this->Xls_col++;
   }
   //----- cantidad
   function NM_sub_cons_cantidad()
   {
         $this->cantidad = NM_charset_to_utf8($this->cantidad);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->cantidad;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "right";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "num";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "#,##0";
         $this->Xls_col++;
   }
   //----- porcentaje
   function NM_sub_cons_porcentaje()
   {
         $this->porcentaje = $this->porcentaje / 100;
         $this->porcentaje = NM_charset_to_utf8($this->porcentaje);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->porcentaje;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "right";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "num";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "0.00%";
         $this->Xls_col++;
   }
   //----- tipo_sancion
   function NM_sub_cons_tipo_sancion()
   {
         $this->tipo_sancion = html_entity_decode($this->tipo_sancion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tipo_sancion = strip_tags($this->tipo_sancion);
         $this->tipo_sancion = NM_charset_to_utf8($this->tipo_sancion);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->tipo_sancion;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- total_sanciones
   function NM_sub_cons_total_sanciones()
   {
         $this->total_sanciones = NM_charset_to_utf8($this->total_sanciones);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->total_sanciones;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "right";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "num";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "#,##0";
         $this->Xls_col++;
   }
   function xls_sub_cons_copy_label($row)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['nolabel']) || $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['nolabel'])
       {
           foreach ($this->arr_export['label'] as $col => $dados)
           {
               $this->arr_export['lines'][$row][$col] = $dados;
           }
       }
   }
   function xls_set_style()
   {
       if (!empty($this->NM_ctrl_style))
       {
           foreach ($this->NM_ctrl_style as $col => $dados)
           {
               $cell_ref = $col . $dados['ini'] . ":" . $col . $dados['end'];
               if ($this->Use_phpspreadsheet) {
                   if ($dados['align'] == "LEFT") {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                   }
                   elseif ($dados['align'] == "RIGHT") {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                   }
                   else {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                   }
               }
               else {
                   if ($dados['align'] == "LEFT") {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   }
                   elseif ($dados['align'] == "RIGHT") {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                   }
                   else {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                   }
               }
               if (isset($dados['format'])) {
                   $this->Nm_ActiveSheet->getStyle($cell_ref)->getNumberFormat()->setFormatCode($dados['format']);
               }
           }
           $this->NM_ctrl_style = array();
       }
   }
 function quebra_falta_FALTA($falta) 
 {
   global $tot_falta;
   $this->sc_proc_quebra_falta = true; 
   $tot_falta[0] = $falta;
   $tot_falta[1] = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['arr_total']['falta'][$falta][0];
   $tot_falta[2] = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['arr_total']['falta'][$falta][1];
   $tot_falta[3] = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['arr_total']['falta'][$falta][2];
   $conteudo = $tot_falta[0] ;  
   $this->count_falta = $tot_falta[1];
   $this->sum_falta_cantidad = $tot_falta[2];
   $this->sum_falta_porcentaje = $tot_falta[3];
   $this->campos_quebra_falta = array(); 
   $conteudo = NM_encode_input(sc_strip_script($this->falta)); 
   $this->campos_quebra_falta[0]['cmp'] = $conteudo; 
   if (isset($this->nmgp_label_quebras['falta']))
   {
       $this->campos_quebra_falta[0]['lab'] = $this->nmgp_label_quebras['falta']; 
   }
   else
   {
   $this->campos_quebra_falta[0]['lab'] = "FALTA"; 
   }
   $this->sc_proc_quebra_falta = false; 
 } 
   function quebra_falta_FALTA_top()
   {
       if ($this->groupby_show != "S") {
           return;
       }
       $this->xls_set_style();
       $lim_col  = 1;
       $temp_cmp = "";
       $cont_col = 0;
       foreach ($this->campos_quebra_falta as $cada_campo) {
           if ($cont_col == $lim_col) {
               $temp_cmp = html_entity_decode($temp_cmp, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               $temp_cmp = strip_tags($temp_cmp);
               $temp_cmp = NM_charset_to_utf8($temp_cmp);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida']) {
                   $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']       = $temp_cmp;
                   $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']      = "left";
                   $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']       = "char";
                   $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format']     = "";
                   $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['bold']       = "";
                   $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['col_span_f'] = $this->Xls_tot_col;
               }
               else {
                   $current_cell_ref = $this->calc_cell($this->Xls_col);
                   if ($this->Use_phpspreadsheet) {
                       $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                   }
                   else {
                       $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   }
                   $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $temp_cmp);
                   $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
               }
               $temp_cmp = "";
               $cont_col = 0;
               $this->Xls_row++;
           }
           $temp_cmp .= $cada_campo['lab'] . " => " . $cada_campo['cmp'] . "  ";
           $cont_col++;
       }
       if (!empty($temp_cmp)) {
           $temp_cmp = html_entity_decode($temp_cmp, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
           $temp_cmp = strip_tags($temp_cmp);
           $temp_cmp = NM_charset_to_utf8($temp_cmp);
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida']) {
               $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']       = $temp_cmp;
               $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']      = "left";
               $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']       = "char";
               $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format']     = "";
               $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['bold']       = "";
               $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['col_span_f'] = $this->Xls_tot_col;
           }
           else {
               $current_cell_ref = $this->calc_cell($this->Xls_col);
               if ($this->Use_phpspreadsheet) {
                   $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
               }
               else {
                   $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
               }
               $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $temp_cmp);
               $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
           }
       }
   }
   function quebra_falta_FALTA_bot()
   {
       if ($this->groupby_show != "S") {
           return;
       }
       $this->xls_set_style();
       $prim_cmp = true;
       $mens_tot_base = "";
       $mens_tot = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['field_order'] as $Cada_cmp)
       {
           if (!isset($this->NM_cmp_hidden[$Cada_cmp]) || $this->NM_cmp_hidden[$Cada_cmp] != "off")
           {
               if ($prim_cmp)
               {
                   $mens_tot = html_entity_decode($mens_tot, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
                   $mens_tot = strip_tags($mens_tot);
                   $mens_tot = NM_charset_to_utf8($mens_tot);
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida']) {
                       $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $mens_tot;
                       $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
                       $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
                       $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
                       $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['bold']   = "";
                   }
                   else {
                       $current_cell_ref = $this->calc_cell($this->Xls_col);
                       if ($this->Use_phpspreadsheet) {
                           $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                       }
                       else {
                           $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                       }
                       $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $mens_tot);
                       $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                   }
               }
               elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['embutida']) {
                       $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = "";
                       $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
                       $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
                       $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
               }
               $this->Xls_col++;
               $prim_cmp = false;
           }
       }
   }
   function quebra_geral_FALTA_bot() 
   {
   }

   function calc_cell($col)
   {
       $arr_alfa = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
       $val_ret = "";
       $result = $col + 1;
       while ($result > 26)
       {
           $cel      = $result % 26;
           $result   = $result / 26;
           if ($cel == 0)
           {
               $cel    = 26;
               $result--;
           }
           $val_ret = $arr_alfa[$cel] . $val_ret;
       }
       $val_ret = $arr_alfa[$result] . $val_ret;
       return $val_ret;
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

   function totaliza_php_FALTA()
   {
      $this->sc_proc_grid = true;
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_pesq_filtro'];
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['contr_total_geral'] == "OK" && $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['contr_array_resumo'] == "OK")
      {
          return;
      }
      //----- 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
         $nmgp_select = "SELECT fl.fault_name as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
         $nmgp_select = "SELECT fl.fault_name as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
         $nmgp_select = "SELECT fl.fault_name as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
         $nmgp_select = "SELECT LOTOFILE(fl.fault_name, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
         $nmgp_select = "SELECT fl.fault_name as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_pesq'] ; 
      $nmgp_select .= " group by fl.fault_name, fr.sanction_type_name"; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['ordem_desc']; 
   } 
   elseif (!empty($campos_order_select)) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $campos_order_select; 
   } 
   elseif (!empty($campos_order)) 
   { 
       $nmgp_order_by = " order by " . $campos_order; 
   } 
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['order_grid'] = $nmgp_order_by;
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
      if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
      { 
         $this->nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
         $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['tot_geral'][1] = 0;
         return;
      }  
      $this->Res->inicializa_arrays();
      $this->nm_grid_colunas = 0;
      while (!$this->rs_grid->EOF) 
      {
         if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
         { 
             $this->falta = "";  
             if (is_file($this->rs_grid->fields[0])) 
             { 
                 $this->falta = file_get_contents($this->rs_grid->fields[0]);  
             } 
         } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
            $this->falta = $this->Db->BlobDecode($this->rs_grid->fields[0]) ;  
         } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
         { 
            $this->falta = $this->Db->BlobDecode($this->rs_grid->fields[0]) ;  
         } 
         else 
         { 
            $this->falta = $this->rs_grid->fields[0] ;  
         } 
         $this->cantidad = $this->rs_grid->fields[1] ;  
         $this->cantidad = (string)$this->cantidad;  
         $this->rs_grid->fields[2] =  str_replace(",", ".", $this->rs_grid->fields[2]);  
         $this->porcentaje = $this->rs_grid->fields[2] ;  
         $this->porcentaje = (string)$this->porcentaje;  
         $this->tipo_sancion = $this->rs_grid->fields[3] ;  
         $this->total_sanciones = $this->rs_grid->fields[4] ;  
         $this->total_sanciones = (string)$this->total_sanciones;  
         $falta_orig = $this->falta;
         $this->arg_sum_falta = " = " . $this->Db->qstr($this->falta);
         $this->Res->adiciona_registro(NM_encode_input(sc_strip_script($this->cantidad)), NM_encode_input(sc_strip_script($this->porcentaje)), NM_encode_input(sc_strip_script($this->falta)), NM_encode_input(sc_strip_script($falta_orig)));
         $this->rs_grid->MoveNext();
      }
      $this->Res->finaliza_arrays();
      $this->rs_grid->Close();
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['tot_geral'][2] = $this->Res->array_total_geral[1];
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['tot_geral'][3] = $this->Res->array_total_geral[2];
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['contr_array_resumo'] = "OK";
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['tot_geral'][1] = $this->Res->array_total_geral[0];
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['contr_total_geral'] = "OK";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Ind_Groupby'] == "FALTA")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['arr_total']['falta'] = $this->Res->array_total_falta;
      }
   }


   function totaliza_php_sc_free_total()
   {
      $this->sc_proc_grid = true;
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_pesq_filtro'];
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['contr_total_geral'] == "OK" && $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['contr_array_resumo'] == "OK")
      {
          return;
      }
      //----- 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
         $nmgp_select = "SELECT fl.fault_name as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
         $nmgp_select = "SELECT fl.fault_name as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
         $nmgp_select = "SELECT fl.fault_name as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
         $nmgp_select = "SELECT LOTOFILE(fl.fault_name, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
         $nmgp_select = "SELECT fl.fault_name as falta, COUNT(*) as cantidad, (COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) as porcentaje, fr.sanction_type_name as tipo_sancion, COUNT(*) as total_sanciones from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['where_pesq'] ; 
      $nmgp_select .= " group by fl.fault_name, fr.sanction_type_name"; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['ordem_desc']; 
   } 
   elseif (!empty($campos_order_select)) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $campos_order_select; 
   } 
   elseif (!empty($campos_order)) 
   { 
       $nmgp_order_by = " order by " . $campos_order; 
   } 
   if (substr(trim($nmgp_order_by), -1) == ",")
   {
       $nmgp_order_by = " " . substr(trim($nmgp_order_by), 0, -1);
   }
   if (trim($nmgp_order_by) == "order by")
   {
       $nmgp_order_by = "";
   }
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['order_grid'] = $nmgp_order_by;
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
      if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
      { 
         $this->nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
         $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['tot_geral'][1] = 0;
         return;
      }  
      $this->Res->inicializa_arrays();
      $this->nm_grid_colunas = 0;
      while (!$this->rs_grid->EOF) 
      {
         if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
         { 
             $this->falta = "";  
             if (is_file($this->rs_grid->fields[0])) 
             { 
                 $this->falta = file_get_contents($this->rs_grid->fields[0]);  
             } 
         } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
            $this->falta = $this->Db->BlobDecode($this->rs_grid->fields[0]) ;  
         } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
         { 
            $this->falta = $this->Db->BlobDecode($this->rs_grid->fields[0]) ;  
         } 
         else 
         { 
            $this->falta = $this->rs_grid->fields[0] ;  
         } 
         $this->cantidad = $this->rs_grid->fields[1] ;  
         $this->cantidad = (string)$this->cantidad;  
         $this->rs_grid->fields[2] =  str_replace(",", ".", $this->rs_grid->fields[2]);  
         $this->porcentaje = $this->rs_grid->fields[2] ;  
         $this->porcentaje = (string)$this->porcentaje;  
         $this->tipo_sancion = $this->rs_grid->fields[3] ;  
         $this->total_sanciones = $this->rs_grid->fields[4] ;  
         $this->total_sanciones = (string)$this->total_sanciones;  
         $falta_orig = $this->falta;
         $this->arg_sum_falta = " = " . $this->Db->qstr($this->falta);
         $this->Res->adiciona_registro(NM_encode_input(sc_strip_script($this->porcentaje)));
         $this->rs_grid->MoveNext();
      }
      $this->Res->finaliza_arrays();
      $this->rs_grid->Close();
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['tot_geral'][2] = $this->Res->array_total_geral[1];
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['contr_array_resumo'] = "OK";
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['tot_geral'][1] = $this->Res->array_total_geral[0];
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['contr_total_geral'] = "OK";
   }

   function progress_bar_end()
   {
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['resumen005'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?>  :: Excel</TITLE>
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
   <td class="scExportTitle" style="height: 25px">XLS</td>
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
<form name="Fdown" method="get" action="resumen005_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="resumen005"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['resumen005']['xls_return']); ?>"> 
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
