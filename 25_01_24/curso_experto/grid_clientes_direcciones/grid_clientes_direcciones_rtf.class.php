<?php

class grid_clientes_direcciones_rtf
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
                   nm_limpa_str_grid_clientes_direcciones($cadapar[1]);
                   nm_protect_num_grid_clientes_direcciones($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_clientes_direcciones']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($par_cliente_id)) 
      {
          $_SESSION['par_cliente_id'] = $par_cliente_id;
          nm_limpa_str_grid_clientes_direcciones($_SESSION["par_cliente_id"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_clientes_direcciones_total.class.php"); 
      $this->Tot      = new grid_clientes_direcciones_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_clientes_direcciones']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_clientes_direcciones";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_clientes_direcciones.rtf";
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
      $this->New_label['id_cliente'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_id_cliente'] . "";
      $this->New_label['nombre_cliente'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_nombre_cliente'] . "";
      $this->New_label['email_cliente'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_email_cliente'] . "";
      $this->New_label['telefono_cliente'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_telefono_cliente'] . "";
      $this->New_label['direccion_cliente'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_direccion_cliente'] . "";
      $this->New_label['postal_cliente'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_postal_cliente'] . "";
      $this->New_label['ciudad_cliente'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_ciudad_cliente'] . "";
      $this->New_label['pais_cliente'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_pais_cliente'] . "";
      $this->New_label['distrito_cliente'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_distrito_cliente'] . "";
      $this->New_label['usuario_login'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_usuario_login'] . "";
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->telefono_cliente = (isset($Busca_temp['telefono_cliente'])) ? $Busca_temp['telefono_cliente'] : ""; 
          $tmp_pos = (is_string($this->telefono_cliente)) ? strpos($this->telefono_cliente, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->telefono_cliente))
          {
              $this->telefono_cliente = substr($this->telefono_cliente, 0, $tmp_pos);
          }
          $this->id_cliente = (isset($Busca_temp['id_cliente'])) ? $Busca_temp['id_cliente'] : ""; 
          $tmp_pos = (is_string($this->id_cliente)) ? strpos($this->id_cliente, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->id_cliente))
          {
              $this->id_cliente = substr($this->id_cliente, 0, $tmp_pos);
          }
          $this->nombre_cliente = (isset($Busca_temp['nombre_cliente'])) ? $Busca_temp['nombre_cliente'] : ""; 
          $tmp_pos = (is_string($this->nombre_cliente)) ? strpos($this->nombre_cliente, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->nombre_cliente))
          {
              $this->nombre_cliente = substr($this->nombre_cliente, 0, $tmp_pos);
          }
          $this->email_cliente = (isset($Busca_temp['email_cliente'])) ? $Busca_temp['email_cliente'] : ""; 
          $tmp_pos = (is_string($this->email_cliente)) ? strpos($this->email_cliente, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->email_cliente))
          {
              $this->email_cliente = substr($this->email_cliente, 0, $tmp_pos);
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['id_cliente'])) ? $this->New_label['id_cliente'] : ""; 
          if ($Cada_col == "id_cliente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nombre_cliente'])) ? $this->New_label['nombre_cliente'] : ""; 
          if ($Cada_col == "nombre_cliente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['email_cliente'])) ? $this->New_label['email_cliente'] : ""; 
          if ($Cada_col == "email_cliente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['telefono_cliente'])) ? $this->New_label['telefono_cliente'] : ""; 
          if ($Cada_col == "telefono_cliente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['direccion_cliente'])) ? $this->New_label['direccion_cliente'] : ""; 
          if ($Cada_col == "direccion_cliente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['postal_cliente'])) ? $this->New_label['postal_cliente'] : ""; 
          if ($Cada_col == "postal_cliente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ciudad_cliente'])) ? $this->New_label['ciudad_cliente'] : ""; 
          if ($Cada_col == "ciudad_cliente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pais_cliente'])) ? $this->New_label['pais_cliente'] : ""; 
          if ($Cada_col == "pais_cliente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['mapa'])) ? $this->New_label['mapa'] : "mapa"; 
          if ($Cada_col == "mapa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT id_cliente, nombre_cliente, email_cliente, telefono_cliente, direccion_cliente, postal_cliente, ciudad_cliente, pais_cliente, usuario_login from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT id_cliente, nombre_cliente, email_cliente, telefono_cliente, direccion_cliente, postal_cliente, ciudad_cliente, pais_cliente, usuario_login from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT id_cliente, nombre_cliente, email_cliente, telefono_cliente, direccion_cliente, postal_cliente, ciudad_cliente, pais_cliente, usuario_login from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT id_cliente, nombre_cliente, email_cliente, telefono_cliente, direccion_cliente, postal_cliente, ciudad_cliente, pais_cliente, usuario_login from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT id_cliente, nombre_cliente, email_cliente, telefono_cliente, direccion_cliente, postal_cliente, ciudad_cliente, pais_cliente, usuario_login from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT id_cliente, nombre_cliente, email_cliente, telefono_cliente, direccion_cliente, postal_cliente, ciudad_cliente, pais_cliente, usuario_login from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['order_grid'];
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
         $this->id_cliente = $rs->fields[0] ;  
         $this->id_cliente = (string)$this->id_cliente;
         $this->nombre_cliente = $rs->fields[1] ;  
         $this->email_cliente = $rs->fields[2] ;  
         $this->telefono_cliente = $rs->fields[3] ;  
         $this->direccion_cliente = $rs->fields[4] ;  
         $this->postal_cliente = $rs->fields[5] ;  
         $this->ciudad_cliente = $rs->fields[6] ;  
         $this->pais_cliente = $rs->fields[7] ;  
         $this->usuario_login = $rs->fields[8] ;  
         //----- lookup - pais_cliente
         $this->look_pais_cliente = $this->pais_cliente; 
         $this->Lookup->lookup_pais_cliente($this->look_pais_cliente, $this->pais_cliente) ; 
         $this->look_pais_cliente = ($this->look_pais_cliente == "&nbsp;") ? "" : $this->look_pais_cliente; 
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- id_cliente
   function NM_export_id_cliente()
   {
             nmgp_Form_Num_Val($this->id_cliente, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->id_cliente = NM_charset_to_utf8($this->id_cliente);
         $this->id_cliente = str_replace('<', '&lt;', $this->id_cliente);
         $this->id_cliente = str_replace('>', '&gt;', $this->id_cliente);
         $this->Texto_tag .= "<td>" . $this->id_cliente . "</td>\r\n";
   }
   //----- nombre_cliente
   function NM_export_nombre_cliente()
   {
         $this->nombre_cliente = html_entity_decode($this->nombre_cliente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->nombre_cliente = strip_tags($this->nombre_cliente);
         $this->nombre_cliente = NM_charset_to_utf8($this->nombre_cliente);
         $this->nombre_cliente = str_replace('<', '&lt;', $this->nombre_cliente);
         $this->nombre_cliente = str_replace('>', '&gt;', $this->nombre_cliente);
         $this->Texto_tag .= "<td>" . $this->nombre_cliente . "</td>\r\n";
   }
   //----- email_cliente
   function NM_export_email_cliente()
   {
         $this->email_cliente = html_entity_decode($this->email_cliente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->email_cliente = strip_tags($this->email_cliente);
         $this->email_cliente = NM_charset_to_utf8($this->email_cliente);
         $this->email_cliente = str_replace('<', '&lt;', $this->email_cliente);
         $this->email_cliente = str_replace('>', '&gt;', $this->email_cliente);
         $this->Texto_tag .= "<td>" . $this->email_cliente . "</td>\r\n";
   }
   //----- telefono_cliente
   function NM_export_telefono_cliente()
   {
         $this->telefono_cliente = html_entity_decode($this->telefono_cliente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->telefono_cliente = strip_tags($this->telefono_cliente);
         $this->telefono_cliente = NM_charset_to_utf8($this->telefono_cliente);
         $this->telefono_cliente = str_replace('<', '&lt;', $this->telefono_cliente);
         $this->telefono_cliente = str_replace('>', '&gt;', $this->telefono_cliente);
         $this->Texto_tag .= "<td>" . $this->telefono_cliente . "</td>\r\n";
   }
   //----- direccion_cliente
   function NM_export_direccion_cliente()
   {
         $this->direccion_cliente = html_entity_decode($this->direccion_cliente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->direccion_cliente = strip_tags($this->direccion_cliente);
         $this->direccion_cliente = NM_charset_to_utf8($this->direccion_cliente);
         $this->direccion_cliente = str_replace('<', '&lt;', $this->direccion_cliente);
         $this->direccion_cliente = str_replace('>', '&gt;', $this->direccion_cliente);
         $this->Texto_tag .= "<td>" . $this->direccion_cliente . "</td>\r\n";
   }
   //----- postal_cliente
   function NM_export_postal_cliente()
   {
         $this->postal_cliente = html_entity_decode($this->postal_cliente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->postal_cliente = strip_tags($this->postal_cliente);
         $this->postal_cliente = NM_charset_to_utf8($this->postal_cliente);
         $this->postal_cliente = str_replace('<', '&lt;', $this->postal_cliente);
         $this->postal_cliente = str_replace('>', '&gt;', $this->postal_cliente);
         $this->Texto_tag .= "<td>" . $this->postal_cliente . "</td>\r\n";
   }
   //----- ciudad_cliente
   function NM_export_ciudad_cliente()
   {
         $this->ciudad_cliente = html_entity_decode($this->ciudad_cliente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ciudad_cliente = strip_tags($this->ciudad_cliente);
         $this->ciudad_cliente = NM_charset_to_utf8($this->ciudad_cliente);
         $this->ciudad_cliente = str_replace('<', '&lt;', $this->ciudad_cliente);
         $this->ciudad_cliente = str_replace('>', '&gt;', $this->ciudad_cliente);
         $this->Texto_tag .= "<td>" . $this->ciudad_cliente . "</td>\r\n";
   }
   //----- pais_cliente
   function NM_export_pais_cliente()
   {
         $this->look_pais_cliente = html_entity_decode($this->look_pais_cliente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->look_pais_cliente = strip_tags($this->look_pais_cliente);
         $this->look_pais_cliente = NM_charset_to_utf8($this->look_pais_cliente);
         $this->look_pais_cliente = str_replace('<', '&lt;', $this->look_pais_cliente);
         $this->look_pais_cliente = str_replace('>', '&gt;', $this->look_pais_cliente);
         $this->Texto_tag .= "<td>" . $this->look_pais_cliente . "</td>\r\n";
   }
   //----- mapa
   function NM_export_mapa()
   {
         $this->mapa = NM_charset_to_utf8($this->mapa);
         $this->mapa = str_replace('<', '&lt;', $this->mapa);
         $this->mapa = str_replace('>', '&gt;', $this->mapa);
         $this->Texto_tag .= "<td>" . $this->mapa . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_clientes_direcciones'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?> <?php echo $this->Ini->Nm_lang['lang_tbl_clientes'] ?> :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_clientes_direcciones_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_clientes_direcciones"> 
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
$_SESSION['scriptcase']['grid_clientes_direcciones']['contr_erro'] = 'on';
  
    echo "Hola, $par_quien";

$_SESSION['scriptcase']['grid_clientes_direcciones']['contr_erro'] = 'off';
}
function sis_mensaje($par_mensaje = 'mensaje') {
$_SESSION['scriptcase']['grid_clientes_direcciones']['contr_erro'] = 'on';
  
    $cad = "<div id='caja_mensaje' ";
    $cad .= "style='background-color: darkgrey;color: white;width: 600px;margin: 0 auto;";
    $cad .= "padding: 2px;margin: 10px auto;border: 1px solid black;border-radius: 20px;text-align: center;'>";
    $cad .= "<h2>";
    $cad .= $par_mensaje;
    $cad .= "</h2>";
    $cad .= "</div>";
    echo $cad;

$_SESSION['scriptcase']['grid_clientes_direcciones']['contr_erro'] = 'off';
}
function sis_cita_guardar_historico($par_id_cita, $par_estado_actual, $par_movimiento){
$_SESSION['scriptcase']['grid_clientes_direcciones']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['grid_clientes_direcciones']['contr_erro'] = 'off';
}
}

?>
