<?php

class grid_consulta_faltas_rtf
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
                   nm_limpa_str_grid_consulta_faltas($cadapar[1]);
                   nm_protect_num_grid_consulta_faltas($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_consulta_faltas']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_consulta_faltas_total.class.php"); 
      $this->Tot      = new grid_consulta_faltas_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_consulta_faltas']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_consulta_faltas";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_consulta_faltas.rtf";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_consulta_faltas']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_consulta_faltas']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_consulta_faltas']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->colaborador = (isset($Busca_temp['colaborador'])) ? $Busca_temp['colaborador'] : ""; 
          $tmp_pos = (is_string($this->colaborador)) ? strpos($this->colaborador, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->colaborador))
          {
              $this->colaborador = substr($this->colaborador, 0, $tmp_pos);
          }
          $this->desc_falta = (isset($Busca_temp['desc_falta'])) ? $Busca_temp['desc_falta'] : ""; 
          $tmp_pos = (is_string($this->desc_falta)) ? strpos($this->desc_falta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->desc_falta))
          {
              $this->desc_falta = substr($this->desc_falta, 0, $tmp_pos);
          }
          $this->fecha_falta = (isset($Busca_temp['fecha_falta'])) ? $Busca_temp['fecha_falta'] : ""; 
          $tmp_pos = (is_string($this->fecha_falta)) ? strpos($this->fecha_falta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->fecha_falta))
          {
              $this->fecha_falta = substr($this->fecha_falta, 0, $tmp_pos);
          }
          $this->fecha_falta_2 = (isset($Busca_temp['fecha_falta_input_2'])) ? $Busca_temp['fecha_falta_input_2'] : ""; 
          $this->usuario_registro = (isset($Busca_temp['usuario_registro'])) ? $Busca_temp['usuario_registro'] : ""; 
          $tmp_pos = (is_string($this->usuario_registro)) ? strpos($this->usuario_registro, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->usuario_registro))
          {
              $this->usuario_registro = substr($this->usuario_registro, 0, $tmp_pos);
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['colaborador'])) ? $this->New_label['colaborador'] : "COLABORADOR"; 
          if ($Cada_col == "colaborador" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['desc_falta'])) ? $this->New_label['desc_falta'] : "DESC FALTA"; 
          if ($Cada_col == "desc_falta" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tipo_falta_descripcion'])) ? $this->New_label['tipo_falta_descripcion'] : "TIPO FALTA DESCRIPCION"; 
          if ($Cada_col == "tipo_falta_descripcion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['fecha_falta'])) ? $this->New_label['fecha_falta'] : "FECHA FALTA"; 
          if ($Cada_col == "fecha_falta" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tipo_sancion'])) ? $this->New_label['tipo_sancion'] : "TIPO SANCION"; 
          if ($Cada_col == "tipo_sancion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['estado_sancion'])) ? $this->New_label['estado_sancion'] : "ESTADO SANCION"; 
          if ($Cada_col == "estado_sancion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['fecha_sancion'])) ? $this->New_label['fecha_sancion'] : "FECHA SANCION"; 
          if ($Cada_col == "fecha_sancion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evidencia'])) ? $this->New_label['evidencia'] : "EVIDENCIA"; 
          if ($Cada_col == "evidencia" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['usuario_registro'])) ? $this->New_label['usuario_registro'] : "USUARIO REGISTRO"; 
          if ($Cada_col == "usuario_registro" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['perfil_r'])) ? $this->New_label['perfil_r'] : "PERFIL R"; 
          if ($Cada_col == "perfil_r" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['fecha_registro'])) ? $this->New_label['fecha_registro'] : "FECHA REGISTRO"; 
          if ($Cada_col == "fecha_registro" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT g1.general_name as colaborador, fl.fault_name as desc_falta, ft.fault_type_description as tipo_falta_descripcion, str_replace (convert(char(10),f.fault_practitioner_date,102), '.', '-') + ' ' + convert(char(8),f.fault_practitioner_date,20) as fecha_falta, fr.sanction_type_name as tipo_sancion, fp.sanction_description as estado_sancion, str_replace (convert(char(10),f.sanction_date,102), '.', '-') + ' ' + convert(char(8),f.sanction_date,20) as fecha_sancion, f.evidence as evidencia, g2.general_name as usuario_registro, d2.division_name as perfil_r, str_replace (convert(char(10),f.fault_register_date,102), '.', '-') + ' ' + convert(char(8),f.fault_register_date,20) as fecha_registro, f.area_id as area from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT g1.general_name as colaborador, fl.fault_name as desc_falta, ft.fault_type_description as tipo_falta_descripcion, f.fault_practitioner_date as fecha_falta, fr.sanction_type_name as tipo_sancion, fp.sanction_description as estado_sancion, f.sanction_date as fecha_sancion, f.evidence as evidencia, g2.general_name as usuario_registro, d2.division_name as perfil_r, f.fault_register_date as fecha_registro, f.area_id as area from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT g1.general_name as colaborador, fl.fault_name as desc_falta, ft.fault_type_description as tipo_falta_descripcion, convert(char(23),f.fault_practitioner_date,121) as fecha_falta, fr.sanction_type_name as tipo_sancion, fp.sanction_description as estado_sancion, convert(char(23),f.sanction_date,121) as fecha_sancion, f.evidence as evidencia, g2.general_name as usuario_registro, d2.division_name as perfil_r, convert(char(23),f.fault_register_date,121) as fecha_registro, f.area_id as area from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT g1.general_name as colaborador, fl.fault_name as desc_falta, ft.fault_type_description as tipo_falta_descripcion, f.fault_practitioner_date as fecha_falta, fr.sanction_type_name as tipo_sancion, fp.sanction_description as estado_sancion, f.sanction_date as fecha_sancion, f.evidence as evidencia, g2.general_name as usuario_registro, d2.division_name as perfil_r, f.fault_register_date as fecha_registro, f.area_id as area from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT g1.general_name as colaborador, fl.fault_name as desc_falta, ft.fault_type_description as tipo_falta_descripcion, EXTEND(f.fault_practitioner_date, YEAR TO FRACTION) as fecha_falta, fr.sanction_type_name as tipo_sancion, fp.sanction_description as estado_sancion, EXTEND(f.sanction_date, YEAR TO FRACTION) as fecha_sancion, f.evidence as evidencia, g2.general_name as usuario_registro, d2.division_name as perfil_r, EXTEND(f.fault_register_date, YEAR TO FRACTION) as fecha_registro, f.area_id as area from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT g1.general_name as colaborador, fl.fault_name as desc_falta, ft.fault_type_description as tipo_falta_descripcion, f.fault_practitioner_date as fecha_falta, fr.sanction_type_name as tipo_sancion, fp.sanction_description as estado_sancion, f.sanction_date as fecha_sancion, f.evidence as evidencia, g2.general_name as usuario_registro, d2.division_name as perfil_r, f.fault_register_date as fecha_registro, f.area_id as area from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_resumo']; 
              $nmgp_select_count .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_resumo'] . ")"; 
              $nmgp_select_count .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['order_grid'];
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
         $this->colaborador = $rs->fields[0] ;  
         $this->desc_falta = $rs->fields[1] ;  
         $this->tipo_falta_descripcion = $rs->fields[2] ;  
         $this->fecha_falta = $rs->fields[3] ;  
         $this->tipo_sancion = $rs->fields[4] ;  
         $this->estado_sancion = $rs->fields[5] ;  
         $this->fecha_sancion = $rs->fields[6] ;  
         $this->evidencia = $rs->fields[7] ;  
         $this->usuario_registro = $rs->fields[8] ;  
         $this->perfil_r = $rs->fields[9] ;  
         $this->fecha_registro = $rs->fields[10] ;  
         $this->area = $rs->fields[11] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- colaborador
   function NM_export_colaborador()
   {
         $this->colaborador = html_entity_decode($this->colaborador, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->colaborador = strip_tags($this->colaborador);
         $this->colaborador = NM_charset_to_utf8($this->colaborador);
         $this->colaborador = str_replace('<', '&lt;', $this->colaborador);
         $this->colaborador = str_replace('>', '&gt;', $this->colaborador);
         $this->Texto_tag .= "<td>" . $this->colaborador . "</td>\r\n";
   }
   //----- desc_falta
   function NM_export_desc_falta()
   {
         $this->desc_falta = html_entity_decode($this->desc_falta, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->desc_falta = strip_tags($this->desc_falta);
         $this->desc_falta = NM_charset_to_utf8($this->desc_falta);
         $this->desc_falta = str_replace('<', '&lt;', $this->desc_falta);
         $this->desc_falta = str_replace('>', '&gt;', $this->desc_falta);
         $this->Texto_tag .= "<td>" . $this->desc_falta . "</td>\r\n";
   }
   //----- tipo_falta_descripcion
   function NM_export_tipo_falta_descripcion()
   {
         $this->tipo_falta_descripcion = html_entity_decode($this->tipo_falta_descripcion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tipo_falta_descripcion = strip_tags($this->tipo_falta_descripcion);
         $this->tipo_falta_descripcion = NM_charset_to_utf8($this->tipo_falta_descripcion);
         $this->tipo_falta_descripcion = str_replace('<', '&lt;', $this->tipo_falta_descripcion);
         $this->tipo_falta_descripcion = str_replace('>', '&gt;', $this->tipo_falta_descripcion);
         $this->Texto_tag .= "<td>" . $this->tipo_falta_descripcion . "</td>\r\n";
   }
   //----- fecha_falta
   function NM_export_fecha_falta()
   {
             if (substr($this->fecha_falta, 10, 1) == "-") 
             { 
                 $this->fecha_falta = substr($this->fecha_falta, 0, 10) . " " . substr($this->fecha_falta, 11);
             } 
             if (substr($this->fecha_falta, 13, 1) == ".") 
             { 
                $this->fecha_falta = substr($this->fecha_falta, 0, 13) . ":" . substr($this->fecha_falta, 14, 2) . ":" . substr($this->fecha_falta, 17);
             } 
             $conteudo_x =  $this->fecha_falta;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->fecha_falta, "YYYY-MM-DD HH:II:SS  ");
                 $this->fecha_falta = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         $this->fecha_falta = NM_charset_to_utf8($this->fecha_falta);
         $this->fecha_falta = str_replace('<', '&lt;', $this->fecha_falta);
         $this->fecha_falta = str_replace('>', '&gt;', $this->fecha_falta);
         $this->Texto_tag .= "<td>" . $this->fecha_falta . "</td>\r\n";
   }
   //----- tipo_sancion
   function NM_export_tipo_sancion()
   {
         $this->tipo_sancion = html_entity_decode($this->tipo_sancion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tipo_sancion = strip_tags($this->tipo_sancion);
         $this->tipo_sancion = NM_charset_to_utf8($this->tipo_sancion);
         $this->tipo_sancion = str_replace('<', '&lt;', $this->tipo_sancion);
         $this->tipo_sancion = str_replace('>', '&gt;', $this->tipo_sancion);
         $this->Texto_tag .= "<td>" . $this->tipo_sancion . "</td>\r\n";
   }
   //----- estado_sancion
   function NM_export_estado_sancion()
   {
         $this->estado_sancion = html_entity_decode($this->estado_sancion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->estado_sancion = strip_tags($this->estado_sancion);
         $this->estado_sancion = NM_charset_to_utf8($this->estado_sancion);
         $this->estado_sancion = str_replace('<', '&lt;', $this->estado_sancion);
         $this->estado_sancion = str_replace('>', '&gt;', $this->estado_sancion);
         $this->Texto_tag .= "<td>" . $this->estado_sancion . "</td>\r\n";
   }
   //----- fecha_sancion
   function NM_export_fecha_sancion()
   {
             if (substr($this->fecha_sancion, 10, 1) == "-") 
             { 
                 $this->fecha_sancion = substr($this->fecha_sancion, 0, 10) . " " . substr($this->fecha_sancion, 11);
             } 
             if (substr($this->fecha_sancion, 13, 1) == ".") 
             { 
                $this->fecha_sancion = substr($this->fecha_sancion, 0, 13) . ":" . substr($this->fecha_sancion, 14, 2) . ":" . substr($this->fecha_sancion, 17);
             } 
             $conteudo_x =  $this->fecha_sancion;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->fecha_sancion, "YYYY-MM-DD HH:II:SS  ");
                 $this->fecha_sancion = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         $this->fecha_sancion = NM_charset_to_utf8($this->fecha_sancion);
         $this->fecha_sancion = str_replace('<', '&lt;', $this->fecha_sancion);
         $this->fecha_sancion = str_replace('>', '&gt;', $this->fecha_sancion);
         $this->Texto_tag .= "<td>" . $this->fecha_sancion . "</td>\r\n";
   }
   //----- evidencia
   function NM_export_evidencia()
   {
         $this->evidencia = html_entity_decode($this->evidencia, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evidencia = strip_tags($this->evidencia);
         $this->evidencia = NM_charset_to_utf8($this->evidencia);
         $this->evidencia = str_replace('<', '&lt;', $this->evidencia);
         $this->evidencia = str_replace('>', '&gt;', $this->evidencia);
         $this->Texto_tag .= "<td>" . $this->evidencia . "</td>\r\n";
   }
   //----- usuario_registro
   function NM_export_usuario_registro()
   {
         $this->usuario_registro = html_entity_decode($this->usuario_registro, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->usuario_registro = strip_tags($this->usuario_registro);
         $this->usuario_registro = NM_charset_to_utf8($this->usuario_registro);
         $this->usuario_registro = str_replace('<', '&lt;', $this->usuario_registro);
         $this->usuario_registro = str_replace('>', '&gt;', $this->usuario_registro);
         $this->Texto_tag .= "<td>" . $this->usuario_registro . "</td>\r\n";
   }
   //----- perfil_r
   function NM_export_perfil_r()
   {
         $this->perfil_r = html_entity_decode($this->perfil_r, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->perfil_r = strip_tags($this->perfil_r);
         $this->perfil_r = NM_charset_to_utf8($this->perfil_r);
         $this->perfil_r = str_replace('<', '&lt;', $this->perfil_r);
         $this->perfil_r = str_replace('>', '&gt;', $this->perfil_r);
         $this->Texto_tag .= "<td>" . $this->perfil_r . "</td>\r\n";
   }
   //----- fecha_registro
   function NM_export_fecha_registro()
   {
             if (substr($this->fecha_registro, 10, 1) == "-") 
             { 
                 $this->fecha_registro = substr($this->fecha_registro, 0, 10) . " " . substr($this->fecha_registro, 11);
             } 
             if (substr($this->fecha_registro, 13, 1) == ".") 
             { 
                $this->fecha_registro = substr($this->fecha_registro, 0, 13) . ":" . substr($this->fecha_registro, 14, 2) . ":" . substr($this->fecha_registro, 17);
             } 
             $conteudo_x =  $this->fecha_registro;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->fecha_registro, "YYYY-MM-DD HH:II:SS  ");
                 $this->fecha_registro = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         $this->fecha_registro = NM_charset_to_utf8($this->fecha_registro);
         $this->fecha_registro = str_replace('<', '&lt;', $this->fecha_registro);
         $this->fecha_registro = str_replace('>', '&gt;', $this->fecha_registro);
         $this->Texto_tag .= "<td>" . $this->fecha_registro . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?>  :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_consulta_faltas_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_consulta_faltas"> 
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
}

?>
