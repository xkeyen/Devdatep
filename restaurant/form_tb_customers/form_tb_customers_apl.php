<?php
//
class form_tb_customers_apl
{
   var $has_where_params = false;
   var $NM_is_redirected = false;
   var $NM_non_ajax_info = false;
   var $formatado = false;
   var $use_100perc_fields = false;
   var $classes_100perc_fields = array();
   var $close_modal_after_insert = false;
   var $NM_ajax_flag    = false;
   var $NM_ajax_opcao   = '';
   var $NM_ajax_retorno = '';
   var $NM_ajax_info    = array('result'            => '',
                                'param'             => array(),
                                'autoComp'          => '',
                                'rsSize'            => '',
                                'msgDisplay'        => '',
                                'errList'           => array(),
                                'fldList'           => array(),
                                'varList'           => array(),
                                'focus'             => '',
                                'navStatus'         => array(),
                                'navSummary'        => array(),
                                'navPage'           => array(),
                                'redir'             => array(),
                                'blockDisplay'      => array(),
                                'fieldDisplay'      => array(),
                                'fieldLabel'        => array(),
                                'readOnly'          => array(),
                                'btnVars'           => array(),
                                'ajaxAlert'         => array(),
                                'ajaxMessage'       => array(),
                                'ajaxJavascript'    => array(),
                                'buttonDisplay'     => array(),
                                'buttonDisplayVert' => array(),
                                'calendarReload'    => false,
                                'quickSearchRes'    => false,
                                'displayMsg'        => false,
                                'displayMsgTxt'     => '',
                                'dyn_search'        => array(),
                                'empty_filter'      => '',
                                'event_field'       => '',
                                'fieldsWithErrors'  => array(),
                               );
   var $NM_ajax_force_values = false;
   var $Nav_permite_ava     = true;
   var $Nav_permite_ret     = true;
   var $Apl_com_erro        = false;
   var $app_is_initializing = false;
   var $Ini;
   var $Erro;
   var $Db;
   var $id_customer;
   var $customer_num_doc;
   var $customer_name;
   var $customer_birthday;
   var $customer_gender;
   var $customer_phone1;
   var $customer_phone2;
   var $customer_address;
   var $id_country;
   var $id_country_1;
   var $doctype;
   var $nm_data;
   var $nmgp_opcao;
   var $nmgp_opc_ant;
   var $sc_evento;
   var $sc_insert_on;
   var $nmgp_clone;
   var $nmgp_return_img = array();
   var $nmgp_dados_form = array();
   var $nmgp_dados_select = array();
   var $nm_location;
   var $nm_flag_iframe;
   var $nm_flag_saida_novo;
   var $nmgp_botoes = array();
   var $nmgp_url_saida;
   var $nmgp_form_show;
   var $nmgp_form_empty;
   var $nmgp_cmp_readonly = array();
   var $nmgp_cmp_hidden   = array();
   var $Field_no_validate  = array();
   var $form_paginacao = 'parcial';
   var $lig_edit_lookup      = false;
   var $lig_edit_lookup_call = false;
   var $lig_edit_lookup_cb   = '';
   var $lig_edit_lookup_row  = '';
   var $is_calendar_app = false;
   var $Embutida_call  = false;
   var $Embutida_ronly = false;
   var $Embutida_proc  = false;
   var $Embutida_form  = false;
   var $Grid_editavel  = false;
   var $url_webhelp = '';
   var $nm_todas_criticas;
   var $Campos_Mens_erro;
   var $nm_new_label = array();
   var $record_insert_ok = false;
   var $record_delete_ok = false;
//
//----- 
   function ini_controle()
   {
        global $nm_url_saida, $teste_validade, $script_case_init, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['customer_address']))
          {
              $this->customer_address = $this->NM_ajax_info['param']['customer_address'];
          }
          if (isset($this->NM_ajax_info['param']['customer_birthday']))
          {
              $this->customer_birthday = $this->NM_ajax_info['param']['customer_birthday'];
          }
          if (isset($this->NM_ajax_info['param']['customer_gender']))
          {
              $this->customer_gender = $this->NM_ajax_info['param']['customer_gender'];
          }
          if (isset($this->NM_ajax_info['param']['customer_name']))
          {
              $this->customer_name = $this->NM_ajax_info['param']['customer_name'];
          }
          if (isset($this->NM_ajax_info['param']['customer_num_doc']))
          {
              $this->customer_num_doc = $this->NM_ajax_info['param']['customer_num_doc'];
          }
          if (isset($this->NM_ajax_info['param']['customer_phone1']))
          {
              $this->customer_phone1 = $this->NM_ajax_info['param']['customer_phone1'];
          }
          if (isset($this->NM_ajax_info['param']['customer_phone2']))
          {
              $this->customer_phone2 = $this->NM_ajax_info['param']['customer_phone2'];
          }
          if (isset($this->NM_ajax_info['param']['doctype']))
          {
              $this->doctype = $this->NM_ajax_info['param']['doctype'];
          }
          if (isset($this->NM_ajax_info['param']['id_country']))
          {
              $this->id_country = $this->NM_ajax_info['param']['id_country'];
          }
          if (isset($this->NM_ajax_info['param']['id_customer']))
          {
              $this->id_customer = $this->NM_ajax_info['param']['id_customer'];
          }
          if (isset($this->NM_ajax_info['param']['nm_form_submit']))
          {
              $this->nm_form_submit = $this->NM_ajax_info['param']['nm_form_submit'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_ancora']))
          {
              $this->nmgp_ancora = $this->NM_ajax_info['param']['nmgp_ancora'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_arg_dyn_search']))
          {
              $this->nmgp_arg_dyn_search = $this->NM_ajax_info['param']['nmgp_arg_dyn_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_arg_fast_search']))
          {
              $this->nmgp_arg_fast_search = $this->NM_ajax_info['param']['nmgp_arg_fast_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_cond_fast_search']))
          {
              $this->nmgp_cond_fast_search = $this->NM_ajax_info['param']['nmgp_cond_fast_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_fast_search']))
          {
              $this->nmgp_fast_search = $this->NM_ajax_info['param']['nmgp_fast_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_num_form']))
          {
              $this->nmgp_num_form = $this->NM_ajax_info['param']['nmgp_num_form'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_opcao']))
          {
              $this->nmgp_opcao = $this->NM_ajax_info['param']['nmgp_opcao'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_ordem']))
          {
              $this->nmgp_ordem = $this->NM_ajax_info['param']['nmgp_ordem'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_parms']))
          {
              $this->nmgp_parms = $this->NM_ajax_info['param']['nmgp_parms'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->nmgp_refresh_fields))
          {
              $this->nmgp_refresh_fields = explode('_#fld#_', $this->nmgp_refresh_fields);
              $this->nmgp_opcao          = 'recarga';
          }
          if (!isset($this->nmgp_refresh_row))
          {
              $this->nmgp_refresh_row = '';
          }
      }

      $this->scSajaxReservedWords = array('rs', 'rst', 'rsrnd', 'rsargs');
      $this->sc_conv_var = array();
      if (!empty($_FILES))
      {
          foreach ($_FILES as $nmgp_campo => $nmgp_valores)
          {
               if (!in_array(strtolower($nmgp_campo), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_campo]))
                   {
                       $nmgp_campo = $this->sc_conv_var[$nmgp_campo];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_campo)]))
                   {
                       $nmgp_campo = $this->sc_conv_var[strtolower($nmgp_campo)];
                   }
               }
               $tmp_scfile_name     = $nmgp_campo . "_scfile_name";
               $tmp_scfile_type     = $nmgp_campo . "_scfile_type";
               $this->$nmgp_campo = is_array($nmgp_valores['tmp_name']) ? $nmgp_valores['tmp_name'][0] : $nmgp_valores['tmp_name'];
               $this->$tmp_scfile_type   = is_array($nmgp_valores['type'])     ? $nmgp_valores['type'][0]     : $nmgp_valores['type'];
               $this->$tmp_scfile_name   = is_array($nmgp_valores['name'])     ? $nmgp_valores['name'][0]     : $nmgp_valores['name'];
          }
      }
      $Sc_lig_md5 = false;
      if (!empty($_POST))
      {
          foreach ($_POST as $nmgp_var => $nmgp_val)
          {
               if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
               {
                   $nmgp_var = substr($nmgp_var, 11);
                   $nmgp_val = $_SESSION[$nmgp_val];
               }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
              {
                  $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                  if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                  {
                      $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                      $Sc_lig_md5 = true;
                  }
                  else
                  {
                      $_SESSION['sc_session']['SC_parm_violation'] = true;
                  }
              }
               if (!in_array(strtolower($nmgp_var), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_var]))
                   {
                       $nmgp_var = $this->sc_conv_var[$nmgp_var];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_var)]))
                   {
                       $nmgp_var = $this->sc_conv_var[strtolower($nmgp_var)];
                   }
               }
               $nmgp_val = NM_decode_input($nmgp_val);
               $this->$nmgp_var = $nmgp_val;
          }
      }
      if (!empty($_GET))
      {
          foreach ($_GET as $nmgp_var => $nmgp_val)
          {
               if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
               {
                   $nmgp_var = substr($nmgp_var, 11);
                   $nmgp_val = $_SESSION[$nmgp_val];
               }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
              {
                  $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                  if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                  {
                      $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                      $Sc_lig_md5 = true;
                  }
                  else
                  {
                       $_SESSION['sc_session']['SC_parm_violation'] = true;
                  }
              }
               if (!in_array(strtolower($nmgp_var), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_var]))
                   {
                       $nmgp_var = $this->sc_conv_var[$nmgp_var];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_var)]))
                   {
                       $nmgp_var = $this->sc_conv_var[strtolower($nmgp_var)];
                   }
               }
               $nmgp_val = NM_decode_input($nmgp_val);
               $this->$nmgp_var = $nmgp_val;
          }
      }
      if (isset($SC_lig_apl_orig) && !$Sc_lig_md5 && (!isset($nmgp_parms) || ($nmgp_parms != "SC_null" && substr($nmgp_parms, 0, 8) != "OrScLink")))
      {
          $_SESSION['sc_session']['SC_parm_violation'] = true;
      }
      if (isset($nmgp_parms) && $nmgp_parms == "SC_null")
      {
          $nmgp_parms = "";
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_tb_customers']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_tb_customers']['embutida_parms']);
      } 
      if (isset($this->nmgp_parms) && !empty($this->nmgp_parms)) 
      { 
          if (isset($_SESSION['nm_aba_bg_color'])) 
          { 
              unset($_SESSION['nm_aba_bg_color']);
          }   
          $nmgp_parms = str_replace("@aspass@", "'", $this->nmgp_parms);
          $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
          $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
          $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
          $todo  = explode("?@?", $todox);
          $ix = 0;
          while (!empty($todo[$ix]))
          {
             $cadapar = explode("?#?", $todo[$ix]);
             if (1 < sizeof($cadapar))
             {
                if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                {
                    $cadapar[0] = substr($cadapar[0], 11);
                    $cadapar[1] = $_SESSION[$cadapar[1]];
                }
                 if (isset($this->sc_conv_var[$cadapar[0]]))
                 {
                     $cadapar[0] = $this->sc_conv_var[$cadapar[0]];
                 }
                 elseif (isset($this->sc_conv_var[strtolower($cadapar[0])]))
                 {
                     $cadapar[0] = $this->sc_conv_var[strtolower($cadapar[0])];
                 }
                 nm_limpa_str_form_tb_customers($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_tb_customers']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['sc_redir_insert'] = $this->sc_redir_insert;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_tb_customers']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['parms']);
              $todo  = explode("?@?", $todox);
              $ix = 0;
              while (!empty($todo[$ix]))
              {
                 $cadapar = explode("?#?", $todo[$ix]);
                 if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                 {
                     $cadapar[0] = substr($cadapar[0], 11);
                     $cadapar[1] = $_SESSION[$cadapar[1]];
                 }
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
                 $ix++;
              }
          }
      } 

      if (isset($this->nm_run_menu) && $this->nm_run_menu == 1)
      { 
          $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_tb_customers']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_tb_customers_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("en_us");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['initialize'];
      } 
      else 
      { 
         $this->nm_data = new nm_data("en_us");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_tb_customers']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_tb_customers']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_tb_customers'];
          }
          elseif (isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']]))
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']] as $init => $resto)
              {
                  if ($this->Ini->sc_page == $init)
                  {
                      $this->sc_init_menu = $init;
                      break;
                  }
              }
          }
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_tb_customers']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_tb_customers']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_tb_customers') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_tb_customers']['label'] = "" . $this->Ini->Nm_lang['lang_tbl_tb_customers'] . "";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_tb_customers")
                  {
                      $achou = true;
                  }
                  elseif ($achou)
                  {
                      unset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu][$apl]);
                      $this->Change_Menu = true;
                  }
              }
          }
      }
      if (!function_exists("nmButtonOutput"))
      {
          include_once($this->Ini->path_lib_php . "nm_gp_config_btn.php");
      }
      include("../_lib/css/" . $this->Ini->str_schema_all . "_form.php");
      $this->Ini->Str_btn_form    = trim($str_button);
      include($this->Ini->path_btn . $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form . $_SESSION['scriptcase']['reg_conf']['css_dir'] . '.php');
      $_SESSION['scriptcase']['css_form_help'] = '../_lib/css/' . $this->Ini->str_schema_all . "_form.css";
      $_SESSION['scriptcase']['css_form_help_dir'] = '../_lib/css/' . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $this->Db = $this->Ini->Db; 
      $this->nm_new_label['id_customer'] = '' . $this->Ini->Nm_lang['lang_tb_customers_fld_id_customer'] . '';
      $this->nm_new_label['customer_num_doc'] = '' . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_num_doc'] . '';
      $this->nm_new_label['customer_name'] = '' . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_name'] . '';
      $this->nm_new_label['customer_birthday'] = '' . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_birthday'] . '';
      $this->nm_new_label['customer_gender'] = '' . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_gender'] . '';
      $this->nm_new_label['customer_phone1'] = '' . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_phone1'] . '';
      $this->nm_new_label['customer_phone2'] = '' . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_phone2'] . '';
      $this->nm_new_label['customer_address'] = '' . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_address'] . '';
      $this->nm_new_label['id_country'] = '' . $this->Ini->Nm_lang['lang_tb_customers_fld_id_country'] . '';
      $this->nm_new_label['doctype'] = '' . $this->Ini->Nm_lang['lang_tb_customers_fld_doctype'] . '';

      $this->Ini->str_google_fonts = isset($str_google_fonts)?$str_google_fonts:'';
      $this->Ini->Img_sep_form    = "/" . trim($str_toolbar_separator);
      $this->Ini->Color_bg_ajax   = !isset($str_ajax_bg)         || "" == trim($str_ajax_bg)         ? "#000" : $str_ajax_bg;
      $this->Ini->Border_c_ajax   = !isset($str_ajax_border_c)   || "" == trim($str_ajax_border_c)   ? ""     : $str_ajax_border_c;
      $this->Ini->Border_s_ajax   = !isset($str_ajax_border_s)   || "" == trim($str_ajax_border_s)   ? ""     : $str_ajax_border_s;
      $this->Ini->Border_w_ajax   = !isset($str_ajax_border_w)   || "" == trim($str_ajax_border_w)   ? ""     : $str_ajax_border_w;
      $this->Ini->Block_img_exp   = !isset($str_block_exp)       || "" == trim($str_block_exp)       ? ""     : $str_block_exp;
      $this->Ini->Block_img_col   = !isset($str_block_col)       || "" == trim($str_block_col)       ? ""     : $str_block_col;
      $this->Ini->Msg_ico_title   = !isset($str_msg_ico_title)   || "" == trim($str_msg_ico_title)   ? ""     : $str_msg_ico_title;
      $this->Ini->Msg_ico_body    = !isset($str_msg_ico_body)    || "" == trim($str_msg_ico_body)    ? ""     : $str_msg_ico_body;
      $this->Ini->Err_ico_title   = !isset($str_err_ico_title)   || "" == trim($str_err_ico_title)   ? ""     : $str_err_ico_title;
      $this->Ini->Err_ico_body    = !isset($str_err_ico_body)    || "" == trim($str_err_ico_body)    ? ""     : $str_err_ico_body;
      $this->Ini->Cal_ico_back    = !isset($str_cal_ico_back)    || "" == trim($str_cal_ico_back)    ? ""     : $str_cal_ico_back;
      $this->Ini->Cal_ico_for     = !isset($str_cal_ico_for)     || "" == trim($str_cal_ico_for)     ? ""     : $str_cal_ico_for;
      $this->Ini->Cal_ico_close   = !isset($str_cal_ico_close)   || "" == trim($str_cal_ico_close)   ? ""     : $str_cal_ico_close;
      $this->Ini->Tab_space       = !isset($str_tab_space)       || "" == trim($str_tab_space)       ? ""     : $str_tab_space;
      $this->Ini->Bubble_tail     = !isset($str_bubble_tail)     || "" == trim($str_bubble_tail)     ? ""     : $str_bubble_tail;
      $this->Ini->Label_sort_pos  = !isset($str_label_sort_pos)  || "" == trim($str_label_sort_pos)  ? ""     : $str_label_sort_pos;
      $this->Ini->Label_sort      = !isset($str_label_sort)      || "" == trim($str_label_sort)      ? ""     : $str_label_sort;
      $this->Ini->Label_sort_asc  = !isset($str_label_sort_asc)  || "" == trim($str_label_sort_asc)  ? ""     : $str_label_sort_asc;
      $this->Ini->Label_sort_desc = !isset($str_label_sort_desc) || "" == trim($str_label_sort_desc) ? ""     : $str_label_sort_desc;
      $this->Ini->Img_status_ok       = !isset($str_img_status_ok)  || "" == trim($str_img_status_ok)   ? ""     : $str_img_status_ok;
      $this->Ini->Img_status_err      = !isset($str_img_status_err) || "" == trim($str_img_status_err)  ? ""     : $str_img_status_err;
      $this->Ini->Css_status          = "scFormInputError";
      $this->Ini->Css_status_pwd_box  = "scFormInputErrorPwdBox";
      $this->Ini->Css_status_pwd_text = "scFormInputErrorPwdText";
      $this->Ini->Error_icon_span      = !isset($str_error_icon_span)  || "" == trim($str_error_icon_span)  ? false  : "message" == $str_error_icon_span;
      $this->Ini->Img_qs_search        = !isset($img_qs_search)        || "" == trim($img_qs_search)        ? "scriptcase__NM__qs_lupa.png"  : $img_qs_search;
      $this->Ini->Img_qs_clean         = !isset($img_qs_clean)         || "" == trim($img_qs_clean)         ? "scriptcase__NM__qs_close.png" : $img_qs_clean;
      $this->Ini->Str_qs_image_padding = !isset($str_qs_image_padding) || "" == trim($str_qs_image_padding) ? "0"                            : $str_qs_image_padding;
      $this->Ini->App_div_tree_img_col = trim($app_div_str_tree_col);
      $this->Ini->App_div_tree_img_exp = trim($app_div_str_tree_exp);
      $this->Ini->form_table_width     = isset($str_form_table_width) && '' != trim($str_form_table_width) ? $str_form_table_width : '';

        $this->classes_100perc_fields['table'] = '';
        $this->classes_100perc_fields['input'] = '';
        $this->classes_100perc_fields['span_input'] = '';
        $this->classes_100perc_fields['span_select'] = '';
        $this->classes_100perc_fields['style_category'] = '';
        $this->classes_100perc_fields['keep_field_size'] = true;



      $_SESSION['scriptcase']['error_icon']['form_tb_customers']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Lemon__NM__nm_scriptcase9_Lemon_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_tb_customers'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['qsearch'] = "on";
      $this->nmgp_botoes['new'] = "on";
      $this->nmgp_botoes['insert'] = "on";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['update'] = "on";
      $this->nmgp_botoes['delete'] = "on";
      $this->nmgp_botoes['first'] = "on";
      $this->nmgp_botoes['back'] = "on";
      $this->nmgp_botoes['forward'] = "on";
      $this->nmgp_botoes['last'] = "on";
      $this->nmgp_botoes['summary'] = "on";
      $this->nmgp_botoes['navpage'] = "on";
      $this->nmgp_botoes['goto'] = "on";
      $this->nmgp_botoes['qtline'] = "off";
      $this->nmgp_botoes['reload'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tb_customers']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_tb_customers'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_tb_customers'];

              $this->nmgp_botoes['update']     = $tmpDashboardButtons['form_update']    ? 'on' : 'off';
              $this->nmgp_botoes['new']        = $tmpDashboardButtons['form_insert']    ? 'on' : 'off';
              $this->nmgp_botoes['insert']     = $tmpDashboardButtons['form_insert']    ? 'on' : 'off';
              $this->nmgp_botoes['delete']     = $tmpDashboardButtons['form_delete']    ? 'on' : 'off';
              $this->nmgp_botoes['copy']       = $tmpDashboardButtons['form_copy']      ? 'on' : 'off';
              $this->nmgp_botoes['first']      = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['back']       = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['last']       = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['forward']    = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['navpage']    = $tmpDashboardButtons['form_navpage']   ? 'on' : 'off';
              $this->nmgp_botoes['goto']       = $tmpDashboardButtons['form_goto']      ? 'on' : 'off';
              $this->nmgp_botoes['qtline']     = $tmpDashboardButtons['form_lineqty']   ? 'on' : 'off';
              $this->nmgp_botoes['summary']    = $tmpDashboardButtons['form_summary']   ? 'on' : 'off';
              $this->nmgp_botoes['qsearch']    = $tmpDashboardButtons['form_qsearch']   ? 'on' : 'off';
              $this->nmgp_botoes['dynsearch']  = $tmpDashboardButtons['form_dynsearch'] ? 'on' : 'off';
              $this->nmgp_botoes['reload']     = $tmpDashboardButtons['form_reload']    ? 'on' : 'off';
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dados_form'];
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("form_tb_customers", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_libs . "/nm_gc.php", "F", "nm_gc") ; 
      $_SESSION['scriptcase']['sc_tab_meses']['int'] = array(
                                      $this->Ini->Nm_lang['lang_mnth_janu'],
                                      $this->Ini->Nm_lang['lang_mnth_febr'],
                                      $this->Ini->Nm_lang['lang_mnth_marc'],
                                      $this->Ini->Nm_lang['lang_mnth_apri'],
                                      $this->Ini->Nm_lang['lang_mnth_mayy'],
                                      $this->Ini->Nm_lang['lang_mnth_june'],
                                      $this->Ini->Nm_lang['lang_mnth_july'],
                                      $this->Ini->Nm_lang['lang_mnth_augu'],
                                      $this->Ini->Nm_lang['lang_mnth_sept'],
                                      $this->Ini->Nm_lang['lang_mnth_octo'],
                                      $this->Ini->Nm_lang['lang_mnth_nove'],
                                      $this->Ini->Nm_lang['lang_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_meses']['abr'] = array(
                                      $this->Ini->Nm_lang['lang_shrt_mnth_janu'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_febr'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_marc'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_apri'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_mayy'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_june'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_july'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_augu'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_sept'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_octo'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_nove'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_dias']['int'] = array(
                                      $this->Ini->Nm_lang['lang_days_sund'],
                                      $this->Ini->Nm_lang['lang_days_mond'],
                                      $this->Ini->Nm_lang['lang_days_tued'],
                                      $this->Ini->Nm_lang['lang_days_wend'],
                                      $this->Ini->Nm_lang['lang_days_thud'],
                                      $this->Ini->Nm_lang['lang_days_frid'],
                                      $this->Ini->Nm_lang['lang_days_satd']);
      $_SESSION['scriptcase']['sc_tab_dias']['abr'] = array(
                                      $this->Ini->Nm_lang['lang_shrt_days_sund'],
                                      $this->Ini->Nm_lang['lang_shrt_days_mond'],
                                      $this->Ini->Nm_lang['lang_shrt_days_tued'],
                                      $this->Ini->Nm_lang['lang_shrt_days_wend'],
                                      $this->Ini->Nm_lang['lang_shrt_days_thud'],
                                      $this->Ini->Nm_lang['lang_shrt_days_frid'],
                                      $this->Ini->Nm_lang['lang_shrt_days_satd']);
      nm_gc($this->Ini->path_libs);
      $this->Ini->Gd_missing  = true;
      if(function_exists("getProdVersion"))
      {
         $_SESSION['scriptcase']['sc_prod_Version'] = str_replace(".", "", getProdVersion($this->Ini->path_libs));
         if(function_exists("gd_info"))
         {
            $this->Ini->Gd_missing = false;
         }
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_trata_img.php", "C", "nm_trata_img") ; 
      if (isset($_GET['nm_cal_display']))
      {
          if ($this->Embutida_proc)
          { 
              include_once($this->Ini->path_embutida . 'form_tb_customers/form_tb_customers_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'form_tb_customers_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'form_tb_customers_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_tb_customers_help.txt');
          if ($arr_link_webhelp)
          {
              foreach ($arr_link_webhelp as $str_link_webhelp)
              {
                  $str_link_webhelp = trim($str_link_webhelp);
                  if ('form:' == substr($str_link_webhelp, 0, 5))
                  {
                      $arr_link_parts = explode(':', $str_link_webhelp);
                      if ('' != $arr_link_parts[1] && is_file($this->Ini->root . $this->Ini->path_help . $arr_link_parts[1]))
                      {
                          $this->url_webhelp = $this->Ini->path_help . $arr_link_parts[1];
                      }
                  }
              }
          }
      }

      if (is_dir($this->Ini->path_aplicacao . 'img'))
      {
          $Res_dir_img = @opendir($this->Ini->path_aplicacao . 'img');
          if ($Res_dir_img)
          {
              while (FALSE !== ($Str_arquivo = @readdir($Res_dir_img))) 
              {
                 if (@is_file($this->Ini->path_aplicacao . 'img/' . $Str_arquivo) && '.' != $Str_arquivo && '..' != $this->Ini->path_aplicacao . 'img/' . $Str_arquivo)
                 {
                     @unlink($this->Ini->path_aplicacao . 'img/' . $Str_arquivo);
                 }
              }
          }
          @closedir($Res_dir_img);
          rmdir($this->Ini->path_aplicacao . 'img');
      }

      if ($this->Embutida_proc)
      { 
          require_once($this->Ini->path_embutida . 'form_tb_customers/form_tb_customers_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_tb_customers_erro.class.php"); 
      }
      $this->Erro      = new form_tb_customers_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ($this->nmgp_opcao == "fast_search")  
      {
          $this->SC_fast_search($this->nmgp_fast_search, $this->nmgp_cond_fast_search, $this->nmgp_arg_fast_search);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opcao'] = "inicio";
          $this->nmgp_opcao = "inicio";
          $this->proc_fast_search = true;
      } 
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opcao']))
         { 
             if ($this->id_customer != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_tb_customers']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = false;
      $this->sc_evento = $this->nmgp_opcao;
      $this->sc_insert_on = false;
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['form_tb_customers']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_tb_customers']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$orig_img);
            echo $orig_img . '_@@NM@@_';            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            $sc_obj_img = new nm_trata_img($_SERVER['DOCUMENT_ROOT'].$out1_img_cache, true);

            if(!empty($img_width) && !empty($img_height)){
                $sc_obj_img->setWidth($img_width);
                $sc_obj_img->setHeight($img_height);
            }
                $sc_obj_img->setManterAspecto(true);
            $sc_obj_img->createImg($_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            echo $out1_img_cache;
               exit;
            }
      if (isset($this->id_customer)) { $this->nm_limpa_alfa($this->id_customer); }
      if (isset($this->customer_num_doc)) { $this->nm_limpa_alfa($this->customer_num_doc); }
      if (isset($this->customer_name)) { $this->nm_limpa_alfa($this->customer_name); }
      if (isset($this->customer_gender)) { $this->nm_limpa_alfa($this->customer_gender); }
      if (isset($this->customer_phone1)) { $this->nm_limpa_alfa($this->customer_phone1); }
      if (isset($this->customer_phone2)) { $this->nm_limpa_alfa($this->customer_phone2); }
      if (isset($this->customer_address)) { $this->nm_limpa_alfa($this->customer_address); }
      if (isset($this->id_country)) { $this->nm_limpa_alfa($this->id_country); }
      if (isset($this->doctype)) { $this->nm_limpa_alfa($this->doctype); }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- id_customer
      $this->field_config['id_customer']               = array();
      $this->field_config['id_customer']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['id_customer']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['id_customer']['symbol_dec'] = '';
      $this->field_config['id_customer']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['id_customer']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- customer_birthday
      $this->field_config['customer_birthday']                 = array();
      $this->field_config['customer_birthday']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['customer_birthday']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['customer_birthday']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'customer_birthday');
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      $this->ini_controle();

      if ('' != $_SESSION['scriptcase']['change_regional_old'])
      {
          $_SESSION['scriptcase']['str_conf_reg'] = $_SESSION['scriptcase']['change_regional_old'];
          $this->Ini->regionalDefault($_SESSION['scriptcase']['str_conf_reg']);
          $this->loadFieldConfig();
          $this->nm_tira_formatacao();

          $_SESSION['scriptcase']['str_conf_reg'] = $_SESSION['scriptcase']['change_regional_new'];
          $this->Ini->regionalDefault($_SESSION['scriptcase']['str_conf_reg']);
          $this->loadFieldConfig();
          $guarda_formatado = $this->formatado;
          $this->nm_formatar_campos();
          $this->formatado = $guarda_formatado;

          $_SESSION['scriptcase']['change_regional_old'] = '';
          $_SESSION['scriptcase']['change_regional_new'] = '';
      }

      if ($nm_form_submit == 1 && ($this->nmgp_opcao == 'inicio' || $this->nmgp_opcao == 'igual'))
      {
          $this->nm_tira_formatacao();
      }
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_id_customer' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'id_customer');
          }
          if ('validate_customer_name' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'customer_name');
          }
          if ('validate_customer_gender' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'customer_gender');
          }
          if ('validate_customer_birthday' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'customer_birthday');
          }
          if ('validate_customer_num_doc' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'customer_num_doc');
          }
          if ('validate_doctype' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'doctype');
          }
          if ('validate_id_country' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'id_country');
          }
          if ('validate_customer_address' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'customer_address');
          }
          if ('validate_customer_phone1' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'customer_phone1');
          }
          if ('validate_customer_phone2' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'customer_phone2');
          }
          form_tb_customers_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_tb_customers_pack_ajax_response();
              exit;
          }
          $this->nm_formatar_campos();
          $this->nmgp_opcao = $nm_sc_sv_opcao; 
          $this->nm_gera_html();
          $this->NM_close_db(); 
          $this->nmgp_opcao = ""; 
          exit; 
      }
      if ($this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") 
      {
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $_SESSION['scriptcase']['form_tb_customers']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  form_tb_customers_pack_ajax_response();
                  exit;
              }
              $campos_erro = $this->Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros, 4);
              $this->Campos_Mens_erro = ""; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $campos_erro, '', true, true); 
              $this->nmgp_opc_ant = $this->nmgp_opcao ; 
              if ($this->nmgp_opcao == "incluir" && $nm_apl_dependente == 1) 
              { 
                  $this->nm_flag_saida_novo = "S";; 
              }
              if ($this->nmgp_opcao == "incluir") 
              { 
                  $GLOBALS["erro_incl"] = 1; 
              }
              $this->nmgp_opcao = "nada" ; 
          }
      }
      elseif (isset($nm_form_submit) && 1 == $nm_form_submit && $this->nmgp_opcao != "menu_link" && $this->nmgp_opcao != "recarga_mobile")
      {
      }
//
      if ($this->nmgp_opcao != "nada")
      {
          $this->nm_acessa_banco();
      }
      else
      {
           if ($this->nmgp_opc_ant == "incluir") 
           { 
               $this->nm_proc_onload(false);
           }
           else
           { 
              $this->nm_guardar_campos();
           }
      }
      if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form" && !$this->Apl_com_erro)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['sc_redir_atualiz'] == "ok")
          {
              if ($this->sc_evento == "update")
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
              if ($this->sc_evento == "delete")
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
      }
      if ($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao)
      {
          $this->ajax_return_values();
          $this->ajax_add_parameters();
          form_tb_customers_pack_ajax_response();
          exit;
      }
      $this->nm_formatar_campos();
      if ($this->NM_ajax_flag)
      {
          $this->NM_ajax_info['result'] = 'OK';
          if ('alterar' == $this->NM_ajax_info['param']['nmgp_opcao'])
          {
              $this->NM_ajax_info['msgDisplay'] = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_ajax_frmu']);
          }
          form_tb_customers_pack_ajax_response();
          exit;
      }
      $this->nm_gera_html();
      $this->NM_close_db(); 
      $this->nmgp_opcao = ""; 
      if ($this->Change_Menu)
      {
          $apl_menu  = $_SESSION['scriptcase']['menu_atual'];
          $Arr_rastro = array();
          if (isset($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) && count($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) > 1)
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu] as $menu => $apls)
              {
                 $Arr_rastro[] = "'<a href=\"" . $apls['link'] . "?script_case_init=" . $this->sc_init_menu . "\" target=\"#NMIframe#\">" . $apls['label'] . "</a>'";
              }
              $ult_apl = count($Arr_rastro) - 1;
              unset($Arr_rastro[$ult_apl]);
              $rastro = implode(",", $Arr_rastro);
?>
  <script type="text/javascript">
     link_atual = new Array (<?php echo $rastro ?>);
     if (parent.writeFastMenu)
     {
         parent.writeFastMenu(link_atual);
     }
  </script>
<?php
          }
          else
          {
?>
  <script type="text/javascript">
     if (parent.clearFastMenu)
     {
        parent.clearFastMenu();
     }
  </script>
<?php
          }
      }
   }
  function html_export_print($nm_arquivo_html, $nmgp_password)
  {
      $Html_password = "";
          $Arq_base  = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html;
          $Parm_pass = ($Html_password != "") ? " -p" : "";
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_tb_customers.zip";
          $Arq_htm = $this->Ini->path_imag_temp . "/" . $Zip_name;
          $Arq_zip = $this->Ini->root . $Arq_htm;
          $Zip_f     = (FALSE !== strpos($Arq_zip, ' ')) ? " \"" . $Arq_zip . "\"" :  $Arq_zip;
          $Arq_input = (FALSE !== strpos($Arq_base, ' ')) ? " \"" . $Arq_base . "\"" :  $Arq_base;
           if (is_file($Arq_zip)) {
               unlink($Arq_zip);
           }
           $str_zip = "";
           if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
           {
               chdir($this->Ini->path_third . "/zip/windows");
               $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $Html_password . " " . $Zip_f . " " . $Arq_input;
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
               $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $Arq_input;
           }
           elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
           {
               chdir($this->Ini->path_third . "/zip/mac/bin");
               $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $Arq_input;
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
           foreach ($this->Ini->Img_export_zip as $cada_img_zip)
           {
               $str_zip      = "";
              $cada_img_zip = '"' . $cada_img_zip . '"';
               if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
               {
                   $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $Html_password . " " . $Zip_f . " " . $cada_img_zip;
               }
               elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
               {
                   $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $cada_img_zip;
               }
               elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
               {
                   $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $cada_img_zip;
               }
               if (!empty($str_zip)) {
                   exec($str_zip);
               }
               // ----- ZIP log
               $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'a');
               if ($fp)
               {
                   @fwrite($fp, $str_zip . "\r\n\r\n");
                   @fclose($fp);
               }
           }
           if (is_file($Arq_zip)) {
               unlink($Arq_base);
           } 
          $path_doc_md5 = md5($Arq_htm);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers'][$path_doc_md5][1] = $Zip_name;
?>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_tbl_tb_customers'] . "") ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
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
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod; ?>/third/font-awesome/6/css/all.min.css" /> 
  <link rel="shortcut icon" href="../_lib/img/grp__NM__img__NM__sc_restaurant.png">
</HEAD>
<BODY class="scExportPage">
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: top">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">PRINT</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
   <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "");?>

   <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "");?>

   <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "");?>

    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo  $this->form_encode_input($Arq_htm) ?>" target="_self" style="display: none"> 
</form>
<form name="Fdown" method="get" action="form_tb_customers_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_tb_customers"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="./" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nmgp_opcao" value="<?php echo $this->nmgp_opcao ?>"> 
</form> 
         </BODY>
         </HTML>
<?php
          exit;
  }
//
//--------------------------------------------------------------------------------------
   function NM_has_trans()
   {
       return !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access);
   }
//
//--------------------------------------------------------------------------------------
   function NM_commit_db()
   {
       if ($this->Ini->sc_tem_trans_banco && !$this->Embutida_proc)
       { 
           $this->Db->CommitTrans(); 
           $this->Ini->sc_tem_trans_banco = false;
       } 
   }
//
//--------------------------------------------------------------------------------------
   function NM_rollback_db()
   {
       if ($this->Ini->sc_tem_trans_banco && !$this->Embutida_proc)
       { 
           $this->Db->RollbackTrans(); 
           $this->Ini->sc_tem_trans_banco = false;
       } 
   }
//
//--------------------------------------------------------------------------------------
   function NM_close_db()
   {
       if ($this->Db && !$this->Embutida_proc)
       { 
           $this->Db->Close(); 
       } 
   }
//
//--------------------------------------------------------------------------------------
   function Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros, $mode = 3) 
   {
       switch ($mode)
       {
           case 1:
               $campos_erro = array();
               if (!empty($Campos_Crit))
               {
                   $campos_erro[] = $Campos_Crit;
               }
               if (!empty($Campos_Falta))
               {
                   $campos_erro[] = $this->Formata_Campos_Falta($Campos_Falta);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_erro[] = $this->Campos_Mens_erro;
               }
               return implode('<br />', $campos_erro);
               break;

           case 2:
               $campos_erro = array();
               if (!empty($Campos_Crit))
               {
                   $campos_erro[] = $Campos_Crit;
               }
               if (!empty($Campos_Falta))
               {
                   $campos_erro[] = $this->Formata_Campos_Falta($Campos_Falta, true);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_erro[] = $this->Campos_Mens_erro;
               }
               return implode('<br />', $campos_erro);
               break;

           case 3:
               $campos_erro = array();
               if (!empty($Campos_Erros))
               {
                   $campos_erro[] = $this->Formata_Campos_Erros($Campos_Erros);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_mens_erro = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), $this->Campos_Mens_erro);
                   $campos_mens_erro = explode('<BR>', $campos_mens_erro);
                   foreach ($campos_mens_erro as $msg_erro)
                   {
                       if ('' != $msg_erro && !in_array($msg_erro, $campos_erro))
                       {
                           $campos_erro[] = $msg_erro;
                       }
                   }
               }
               return implode('<br />', $campos_erro);
               break;

           case 4:
               $campos_erro = array();
               if (!empty($Campos_Erros))
               {
                   $campos_erro[] = $this->Formata_Campos_Erros_SweetAlert($Campos_Erros);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_mens_erro = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), $this->Campos_Mens_erro);
                   $campos_mens_erro = explode('<BR>', $campos_mens_erro);
                   foreach ($campos_mens_erro as $msg_erro)
                   {
                       if ('' != $msg_erro && !in_array($msg_erro, $campos_erro))
                       {
                           $campos_erro[] = $msg_erro;
                       }
                   }
               }
               return implode('<br />', $campos_erro);
               break;
       }
   }

   function Formata_Campos_Falta($Campos_Falta, $table = false) 
   {
       $Campos_Falta = array_unique($Campos_Falta);

       if (!$table)
       {
           return $this->Ini->Nm_lang['lang_errm_reqd'] . ' ' . implode('; ', $Campos_Falta);
       }

       $aCols  = array();
       $iTotal = sizeof($Campos_Falta);
       $iCols  = 6 > $iTotal ? 1 : (11 > $iTotal ? 2 : (16 > $iTotal ? 3 : 4));
       $iItems = ceil($iTotal / $iCols);
       $iNowC  = 0;
       $iNowI  = 0;

       foreach ($Campos_Falta as $campo)
       {
           $aCols[$iNowC][] = $campo;
           if ($iItems == ++$iNowI)
           {
               $iNowC++;
               $iNowI = 0;
           }
       }

       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';
       $sError .= '<tr>';
       $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Ini->Nm_lang['lang_errm_reqd'] . '</td>';
       foreach ($aCols as $aCol)
       {
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', $aCol) . '</td>';
       }
       $sError .= '</tr>';
       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Crit($Campos_Crit, $table = false) 
   {
       $Campos_Crit = array_unique($Campos_Crit);

       if (!$table)
       {
           return $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . implode('; ', $Campos_Crit);
       }

       $aCols  = array();
       $iTotal = sizeof($Campos_Crit);
       $iCols  = 6 > $iTotal ? 1 : (11 > $iTotal ? 2 : (16 > $iTotal ? 3 : 4));
       $iItems = ceil($iTotal / $iCols);
       $iNowC  = 0;
       $iNowI  = 0;

       foreach ($Campos_Crit as $campo)
       {
           $aCols[$iNowC][] = $campo;
           if ($iItems == ++$iNowI)
           {
               $iNowC++;
               $iNowI = 0;
           }
       }

       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';
       $sError .= '<tr>';
       $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Ini->Nm_lang['lang_errm_flds'] . '</td>';
       foreach ($aCols as $aCol)
       {
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', $aCol) . '</td>';
       }
       $sError .= '</tr>';
       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Erros($Campos_Erros) 
   {
       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';

       foreach ($Campos_Erros as $campo => $erros)
       {
           $sError .= '<tr>';
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Recupera_Nome_Campo($campo) . ':</td>';
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', array_unique($erros)) . '</td>';
           $sError .= '</tr>';
       }

       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Erros_SweetAlert($Campos_Erros) 
   {
       $sError  = '';

       foreach ($Campos_Erros as $campo => $erros)
       {
           $sError .= $this->Recupera_Nome_Campo($campo) . ': ' . implode('<br />', array_unique($erros)) . '<br />';
       }

       return $sError;
   }

   function Recupera_Nome_Campo($campo) 
   {
       switch($campo)
       {
           case 'id_customer':
               return "" . $this->Ini->Nm_lang['lang_tb_customers_fld_id_customer'] . "";
               break;
           case 'customer_name':
               return "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_name'] . "";
               break;
           case 'customer_gender':
               return "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_gender'] . "";
               break;
           case 'customer_birthday':
               return "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_birthday'] . "";
               break;
           case 'customer_num_doc':
               return "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_num_doc'] . "";
               break;
           case 'doctype':
               return "" . $this->Ini->Nm_lang['lang_tb_customers_fld_doctype'] . "";
               break;
           case 'id_country':
               return "" . $this->Ini->Nm_lang['lang_tb_customers_fld_id_country'] . "";
               break;
           case 'customer_address':
               return "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_address'] . "";
               break;
           case 'customer_phone1':
               return "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_phone1'] . "";
               break;
           case 'customer_phone2':
               return "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_phone2'] . "";
               break;
       }

       return $campo;
   }

   function dateDefaultFormat()
   {
       if (isset($this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_format']))
       {
           $sDate = str_replace('yyyy', 'Y', $this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_format']);
           $sDate = str_replace('mm',   'm', $sDate);
           $sDate = str_replace('dd',   'd', $sDate);
           return substr(chunk_split($sDate, 1, $this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_sep']), 0, -1);
       }
       elseif ('en_us' == $this->Ini->str_lang)
       {
           return 'm/d/Y';
       }
       else
       {
           return 'd/m/Y';
       }
   } // dateDefaultFormat

//
//--------------------------------------------------------------------------------------
   function Valida_campos(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros, $filtro = '') 
   {
     global $nm_browser, $teste_validade;
     if (is_array($filtro) && empty($filtro)) {
         $filtro = '';
     }
//---------------------------------------------------------
     $this->sc_force_zero = array();

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_form_tb_customers']) || !is_array($this->NM_ajax_info['errList']['geral_form_tb_customers']))
              {
                  $this->NM_ajax_info['errList']['geral_form_tb_customers'] = array();
              }
              $this->NM_ajax_info['errList']['geral_form_tb_customers'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'id_customer' == $filtro)) || (is_array($filtro) && in_array('id_customer', $filtro)))
        $this->ValidateField_id_customer($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'customer_name' == $filtro)) || (is_array($filtro) && in_array('customer_name', $filtro)))
        $this->ValidateField_customer_name($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'customer_gender' == $filtro)) || (is_array($filtro) && in_array('customer_gender', $filtro)))
        $this->ValidateField_customer_gender($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'customer_birthday' == $filtro)) || (is_array($filtro) && in_array('customer_birthday', $filtro)))
        $this->ValidateField_customer_birthday($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'customer_num_doc' == $filtro)) || (is_array($filtro) && in_array('customer_num_doc', $filtro)))
        $this->ValidateField_customer_num_doc($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'doctype' == $filtro)) || (is_array($filtro) && in_array('doctype', $filtro)))
        $this->ValidateField_doctype($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'id_country' == $filtro)) || (is_array($filtro) && in_array('id_country', $filtro)))
        $this->ValidateField_id_country($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'customer_address' == $filtro)) || (is_array($filtro) && in_array('customer_address', $filtro)))
        $this->ValidateField_customer_address($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'customer_phone1' == $filtro)) || (is_array($filtro) && in_array('customer_phone1', $filtro)))
        $this->ValidateField_customer_phone1($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'customer_phone2' == $filtro)) || (is_array($filtro) && in_array('customer_phone2', $filtro)))
        $this->ValidateField_customer_phone2($Campos_Crit, $Campos_Falta, $Campos_Erros);
//-- converter datas   
          $this->nm_converte_datas();
//---
      if (!empty($Campos_Crit) || !empty($Campos_Falta) || !empty($this->Campos_Mens_erro))
      {
          if (!empty($this->sc_force_zero))
          {
              foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
              {
                  eval('$this->' . $sc_force_zero_field . ' = "";');
                  unset($this->sc_force_zero[$i_force_zero]);
              }
          }
      }
   }

    function ValidateField_id_customer(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['id_customer'])) {
          nm_limpa_numero($this->id_customer, $this->field_config['id_customer']['symbol_grp']) ; 
          return;
      }
      if ($this->id_customer === "" || is_null($this->id_customer))  
      { 
          $this->id_customer = 0;
      } 
      nm_limpa_numero($this->id_customer, $this->field_config['id_customer']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->id_customer != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->id_customer) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_tb_customers_fld_id_customer'] . ": " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['id_customer']))
                  {
                      $Campos_Erros['id_customer'] = array();
                  }
                  $Campos_Erros['id_customer'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['id_customer']) || !is_array($this->NM_ajax_info['errList']['id_customer']))
                  {
                      $this->NM_ajax_info['errList']['id_customer'] = array();
                  }
                  $this->NM_ajax_info['errList']['id_customer'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->id_customer, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_tb_customers_fld_id_customer'] . "; " ; 
                  if (!isset($Campos_Erros['id_customer']))
                  {
                      $Campos_Erros['id_customer'] = array();
                  }
                  $Campos_Erros['id_customer'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['id_customer']) || !is_array($this->NM_ajax_info['errList']['id_customer']))
                  {
                      $this->NM_ajax_info['errList']['id_customer'] = array();
                  }
                  $this->NM_ajax_info['errList']['id_customer'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'id_customer';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_id_customer

    function ValidateField_customer_name(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['customer_name'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->customer_name) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_name'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['customer_name']))
              {
                  $Campos_Erros['customer_name'] = array();
              }
              $Campos_Erros['customer_name'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['customer_name']) || !is_array($this->NM_ajax_info['errList']['customer_name']))
              {
                  $this->NM_ajax_info['errList']['customer_name'] = array();
              }
              $this->NM_ajax_info['errList']['customer_name'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'customer_name';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_customer_name

    function ValidateField_customer_gender(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['customer_gender'])) {
       return;
   }
      if ($this->customer_gender == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->customer_gender != "" && !in_array("customer_gender", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_customer_gender']) && !in_array($this->customer_gender, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_customer_gender']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['customer_gender']))
              {
                  $Campos_Erros['customer_gender'] = array();
              }
              $Campos_Erros['customer_gender'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['customer_gender']) || !is_array($this->NM_ajax_info['errList']['customer_gender']))
              {
                  $this->NM_ajax_info['errList']['customer_gender'] = array();
              }
              $this->NM_ajax_info['errList']['customer_gender'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'customer_gender';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_customer_gender

    function ValidateField_customer_birthday(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->customer_birthday, $this->field_config['customer_birthday']['date_sep']) ; 
      if (isset($this->Field_no_validate['customer_birthday'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['customer_birthday']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['customer_birthday']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['customer_birthday']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['customer_birthday']['date_sep']) ; 
          if (trim($this->customer_birthday) != "")  
          { 
              if ($teste_validade->Data($this->customer_birthday, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_birthday'] . "; " ; 
                  if (!isset($Campos_Erros['customer_birthday']))
                  {
                      $Campos_Erros['customer_birthday'] = array();
                  }
                  $Campos_Erros['customer_birthday'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['customer_birthday']) || !is_array($this->NM_ajax_info['errList']['customer_birthday']))
                  {
                      $this->NM_ajax_info['errList']['customer_birthday'] = array();
                  }
                  $this->NM_ajax_info['errList']['customer_birthday'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['customer_birthday']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'customer_birthday';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_customer_birthday

    function ValidateField_customer_num_doc(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['customer_num_doc'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->customer_num_doc) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_num_doc'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['customer_num_doc']))
              {
                  $Campos_Erros['customer_num_doc'] = array();
              }
              $Campos_Erros['customer_num_doc'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['customer_num_doc']) || !is_array($this->NM_ajax_info['errList']['customer_num_doc']))
              {
                  $this->NM_ajax_info['errList']['customer_num_doc'] = array();
              }
              $this->NM_ajax_info['errList']['customer_num_doc'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'customer_num_doc';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_customer_num_doc

    function ValidateField_doctype(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['doctype'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->doctype) > 50) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_tb_customers_fld_doctype'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['doctype']))
              {
                  $Campos_Erros['doctype'] = array();
              }
              $Campos_Erros['doctype'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['doctype']) || !is_array($this->NM_ajax_info['errList']['doctype']))
              {
                  $this->NM_ajax_info['errList']['doctype'] = array();
              }
              $this->NM_ajax_info['errList']['doctype'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'doctype';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_doctype

    function ValidateField_id_country(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['id_country'])) {
       return;
   }
      if ($this->id_country == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'id_country';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_id_country

    function ValidateField_customer_address(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['customer_address'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->customer_address) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_address'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['customer_address']))
              {
                  $Campos_Erros['customer_address'] = array();
              }
              $Campos_Erros['customer_address'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['customer_address']) || !is_array($this->NM_ajax_info['errList']['customer_address']))
              {
                  $this->NM_ajax_info['errList']['customer_address'] = array();
              }
              $this->NM_ajax_info['errList']['customer_address'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'customer_address';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_customer_address

    function ValidateField_customer_phone1(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['customer_phone1'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->customer_phone1) > 150) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_phone1'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 150 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['customer_phone1']))
              {
                  $Campos_Erros['customer_phone1'] = array();
              }
              $Campos_Erros['customer_phone1'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 150 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['customer_phone1']) || !is_array($this->NM_ajax_info['errList']['customer_phone1']))
              {
                  $this->NM_ajax_info['errList']['customer_phone1'] = array();
              }
              $this->NM_ajax_info['errList']['customer_phone1'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 150 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'customer_phone1';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_customer_phone1

    function ValidateField_customer_phone2(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['customer_phone2'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->customer_phone2) > 150) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_phone2'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 150 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['customer_phone2']))
              {
                  $Campos_Erros['customer_phone2'] = array();
              }
              $Campos_Erros['customer_phone2'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 150 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['customer_phone2']) || !is_array($this->NM_ajax_info['errList']['customer_phone2']))
              {
                  $this->NM_ajax_info['errList']['customer_phone2'] = array();
              }
              $this->NM_ajax_info['errList']['customer_phone2'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 150 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'customer_phone2';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_customer_phone2

    function removeDuplicateDttmError($aErrDate, &$aErrTime)
    {
        if (empty($aErrDate) || empty($aErrTime))
        {
            return;
        }

        foreach ($aErrDate as $sErrDate)
        {
            foreach ($aErrTime as $iErrTime => $sErrTime)
            {
                if ($sErrDate == $sErrTime)
                {
                    unset($aErrTime[$iErrTime]);
                }
            }
        }
    } // removeDuplicateDttmError

   function nm_guardar_campos()
   {
    global
           $sc_seq_vert;
    $this->nmgp_dados_form['id_customer'] = $this->id_customer;
    $this->nmgp_dados_form['customer_name'] = $this->customer_name;
    $this->nmgp_dados_form['customer_gender'] = $this->customer_gender;
    $this->nmgp_dados_form['customer_birthday'] = (strlen(trim($this->customer_birthday)) > 19) ? str_replace(".", ":", $this->customer_birthday) : trim($this->customer_birthday);
    $this->nmgp_dados_form['customer_num_doc'] = $this->customer_num_doc;
    $this->nmgp_dados_form['doctype'] = $this->doctype;
    $this->nmgp_dados_form['id_country'] = $this->id_country;
    $this->nmgp_dados_form['customer_address'] = $this->customer_address;
    $this->nmgp_dados_form['customer_phone1'] = $this->customer_phone1;
    $this->nmgp_dados_form['customer_phone2'] = $this->customer_phone2;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['id_customer'] = $this->id_customer;
      nm_limpa_numero($this->id_customer, $this->field_config['id_customer']['symbol_grp']) ; 
      $this->Before_unformat['customer_birthday'] = $this->customer_birthday;
      nm_limpa_data($this->customer_birthday, $this->field_config['customer_birthday']['date_sep']) ; 
   }
   function sc_add_currency(&$value, $symbol, $pos)
   {
       if ('' == $value)
       {
           return;
       }
       $value = (1 == $pos || 3 == $pos) ? $symbol . ' ' . $value : $value . ' ' . $symbol;
   }
   function sc_remove_currency(&$value, $symbol_dec, $symbol_tho, $symbol_mon)
   {
       $value = preg_replace('~&#x0*([0-9a-f]+);~i', '', $value);
       $sNew  = str_replace($symbol_mon, '', $value);
       if ($sNew != $value)
       {
           $value = str_replace(' ', '', $sNew);
           return;
       }
       $aTest = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-', $symbol_dec, $symbol_tho);
       $sNew  = '';
       for ($i = 0; $i < strlen($value); $i++)
       {
           if ($this->sc_test_currency_char($value[$i], $aTest))
           {
               $sNew .= $value[$i];
           }
       }
       $value = $sNew;
   }
   function sc_test_currency_char($char, $test)
   {
       $found = false;
       foreach ($test as $test_char)
       {
           if ($char === $test_char)
           {
               $found = true;
           }
       }
       return $found;
   }
   function nm_clear_val($Nome_Campo)
   {
      if ($Nome_Campo == "id_customer")
      {
          nm_limpa_numero($this->id_customer, $this->field_config['id_customer']['symbol_grp']) ; 
      }
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
     if (isset($this->formatado) && $this->formatado)
     {
         return;
     }
     $this->formatado = true;
      if ('' !== $this->id_customer || (!empty($format_fields) && isset($format_fields['id_customer'])))
      {
          nmgp_Form_Num_Val($this->id_customer, $this->field_config['id_customer']['symbol_grp'], $this->field_config['id_customer']['symbol_dec'], "0", "S", $this->field_config['id_customer']['format_neg'], "", "", "-", $this->field_config['id_customer']['symbol_fmt']) ; 
      }
      if ((!empty($this->customer_birthday) && 'null' != $this->customer_birthday) || (!empty($format_fields) && isset($format_fields['customer_birthday'])))
      {
          nm_volta_data($this->customer_birthday, $this->field_config['customer_birthday']['date_format']) ; 
          nmgp_Form_Datas($this->customer_birthday, $this->field_config['customer_birthday']['date_format'], $this->field_config['customer_birthday']['date_sep']) ;  
      }
      elseif ('null' == $this->customer_birthday || '' == $this->customer_birthday)
      {
          $this->customer_birthday = '';
      }
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";

      if (false !== strpos($nm_mask, '9') || false !== strpos($nm_mask, 'a') || false !== strpos($nm_mask, '*'))
      {
          $new_campo = '';
          $a_mask_ord  = array();
          $i_mask_size = -1;

          foreach (explode(';', $nm_mask) as $str_mask)
          {
              $a_mask_ord[ $this->nm_conta_mask_chars($str_mask) ] = $str_mask;
          }
          ksort($a_mask_ord);

          foreach ($a_mask_ord as $i_size => $s_mask)
          {
              if (-1 == $i_mask_size)
              {
                  $i_mask_size = $i_size;
              }
              elseif (strlen($nm_campo) >= $i_size && strlen($nm_campo) > $i_mask_size)
              {
                  $i_mask_size = $i_size;
              }
          }
          $nm_mask = $a_mask_ord[$i_mask_size];

          for ($i = 0; $i < strlen($nm_mask); $i++)
          {
              $test_mask = substr($nm_mask, $i, 1);
              
              if ('9' == $test_mask || 'a' == $test_mask || '*' == $test_mask)
              {
                  $new_campo .= substr($nm_campo, 0, 1);
                  $nm_campo   = substr($nm_campo, 1);
              }
              else
              {
                  $new_campo .= $test_mask;
              }
          }

                  $nm_campo = $new_campo;

          return;
      }

      $mask_num = false;
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
              if ($cont1 < $cont2 && $tam_campo <= $cont2 && $tam_campo > $cont1)
              {
                  $trab_mask = $ver_duas[1];
              }
              elseif ($cont1 > $cont2 && $tam_campo <= $cont2)
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
          $nm_campo = $trab_saida;
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
      $nm_campo = $trab_saida;
   } 
   function nm_conta_mask_chars($sMask)
   {
       $iLength = 0;

       for ($i = 0; $i < strlen($sMask); $i++)
       {
           if (in_array($sMask[$i], array('9', 'a', '*')))
           {
               $iLength++;
           }
       }

       return $iLength;
   }
   function nm_tira_mask(&$nm_campo, $nm_mask, $nm_chars = '')
   { 
      $mask_dados = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $tam_mask   = strlen($nm_mask);
      $trab_saida = "";

      if (false !== strpos($nm_mask, '9') || false !== strpos($nm_mask, 'a') || false !== strpos($nm_mask, '*'))
      {
          $raw_campo = $this->sc_clear_mask($nm_campo, $nm_chars);
          $raw_mask  = $this->sc_clear_mask($nm_mask, $nm_chars);
          $new_campo = '';

          $test_mask = substr($raw_mask, 0, 1);
          $raw_mask  = substr($raw_mask, 1);

          while ('' != $raw_campo)
          {
              $test_val  = substr($raw_campo, 0, 1);
              $raw_campo = substr($raw_campo, 1);
              $ord       = ord($test_val);
              $found     = false;

              switch ($test_mask)
              {
                  case '9':
                      if (48 <= $ord && 57 >= $ord)
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;

                  case 'a':
                      if ((65 <= $ord && 90 >= $ord) || (97 <= $ord && 122 >= $ord))
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;

                  case '*':
                      if ((48 <= $ord && 57 >= $ord) || (65 <= $ord && 90 >= $ord) || (97 <= $ord && 122 >= $ord))
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;
              }

              if ($found)
              {
                  $test_mask = substr($raw_mask, 0, 1);
                  $raw_mask  = substr($raw_mask, 1);
              }
          }

          $nm_campo = $new_campo;

          return;
      }

      $mask_num = false;
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
          for ($x=0; $x < strlen($mask_dados); $x++)
          {
              if (is_numeric(substr($mask_dados, $x, 1)))
              {
                  $trab_saida .= substr($mask_dados, $x, 1);
              }
          }
          $nm_campo = $trab_saida;
          return;
      }
      if ($tam_mask > $tam_campo)
      {
         $mask_desfaz = "";
         for ($mask_ind = 0; $tam_mask > $tam_campo; $mask_ind++)
         {
              $mask_char = substr($trab_mask, $mask_ind, 1);
              if ($mask_char == "z")
              {
                  $tam_mask--;
              }
              else
              {
                  $mask_desfaz .= $mask_char;
              }
              if ($mask_ind == $tam_campo)
              {
                  $tam_mask = $tam_campo;
              }
         }
         $trab_mask = $mask_desfaz . substr($trab_mask, $mask_ind);
      }
      $mask_saida = "";
      for ($mask_ind = strlen($trab_mask); $mask_ind > 0; $mask_ind--)
      {
          $mask_char = substr($trab_mask, $mask_ind - 1, 1);
          if ($mask_char == "x" || $mask_char == "z")
          {
              if ($tam_campo > 0)
              {
                  $mask_saida = substr($mask_dados, $tam_campo - 1, 1) . $mask_saida;
              }
          }
          else
          {
              if ($mask_char != substr($mask_dados, $tam_campo - 1, 1) && $tam_campo > 0)
              {
                  $mask_saida = substr($mask_dados, $tam_campo - 1, 1) . $mask_saida;
                  $mask_ind--;
              }
          }
          $tam_campo--;
      }
      if ($tam_campo > 0)
      {
         $mask_saida = substr($mask_dados, 0, $tam_campo) . $mask_saida;
      }
      $nm_campo = $mask_saida;
   }

   function sc_clear_mask($value, $chars)
   {
       $new = '';

       for ($i = 0; $i < strlen($value); $i++)
       {
           if (false === strpos($chars, $value[$i]))
           {
               $new .= $value[$i];
           }
       }

       return $new;
   }
//
   function nm_limpa_alfa(&$str)
   {
   }
//
//-- 
   function nm_converte_datas($use_null = true, $bForce = false)
   {
      $guarda_format_hora = $this->field_config['customer_birthday']['date_format'];
      if ($this->customer_birthday != "")  
      { 
          nm_conv_data($this->customer_birthday, $this->field_config['customer_birthday']['date_format']) ; 
          $this->customer_birthday_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->customer_birthday_hora = substr($this->customer_birthday_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->customer_birthday_hora = substr($this->customer_birthday_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->customer_birthday_hora = substr($this->customer_birthday_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->customer_birthday_hora = substr($this->customer_birthday_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->customer_birthday_hora = substr($this->customer_birthday_hora, 0, -4);
          }
      } 
      if ($this->customer_birthday == "" && $use_null)  
      { 
          $this->customer_birthday = "null" ; 
      } 
      $this->field_config['customer_birthday']['date_format'] = $guarda_format_hora;
   }
//
   function nm_prep_date_change($cmp_date, $format_dt)
   {
       $vl_return  = "";
       if ($cmp_date != 'null') {
           $vl_return .= (strpos($format_dt, "yy") !== false) ? substr($cmp_date,  0, 4) : "";
           $vl_return .= (strpos($format_dt, "mm") !== false) ? substr($cmp_date,  5, 2) : "";
           $vl_return .= (strpos($format_dt, "dd") !== false) ? substr($cmp_date,  8, 2) : "";
           $vl_return .= (strpos($format_dt, "hh") !== false) ? substr($cmp_date, 11, 2) : "";
           $vl_return .= (strpos($format_dt, "ii") !== false) ? substr($cmp_date, 14, 2) : "";
           $vl_return .= (strpos($format_dt, "ss") !== false) ? substr($cmp_date, 17, 2) : "";
       }
       return $vl_return;
   }
   function nm_conv_data_db($dt_in, $form_in, $form_out, $replaces = array())
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
           nm_conv_form_data($dt_out, $form_in, $form_out, $replaces);
           return $dt_out;
       }
   }

   function returnWhere($aCond, $sOp = 'AND')
   {
       $aWhere = array();
       foreach ($aCond as $sCond)
       {
           $this->handleWhereCond($sCond);
           if ('' != $sCond)
           {
               $aWhere[] = $sCond;
           }
       }
       if (empty($aWhere))
       {
           return '';
       }
       else
       {
           return ' WHERE (' . implode(') ' . $sOp . ' (', $aWhere) . ')';
       }
   } // returnWhere

   function handleWhereCond(&$sCond)
   {
       $sCond = trim($sCond);
       if ('where' == strtolower(substr($sCond, 0, 5)))
       {
           $sCond = trim(substr($sCond, 5));
       }
   } // handleWhereCond

   function ajax_return_values()
   {
          $this->ajax_return_values_id_customer();
          $this->ajax_return_values_customer_name();
          $this->ajax_return_values_customer_gender();
          $this->ajax_return_values_customer_birthday();
          $this->ajax_return_values_customer_num_doc();
          $this->ajax_return_values_doctype();
          $this->ajax_return_values_id_country();
          $this->ajax_return_values_customer_address();
          $this->ajax_return_values_customer_phone1();
          $this->ajax_return_values_customer_phone2();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['id_customer']['keyVal'] = form_tb_customers_pack_protect_string($this->nmgp_dados_form['id_customer']);
          }
   } // ajax_return_values

          //----- id_customer
   function ajax_return_values_id_customer($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("id_customer", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->id_customer);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['id_customer'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("id_customer", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- customer_name
   function ajax_return_values_customer_name($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("customer_name", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->customer_name);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['customer_name'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- customer_gender
   function ajax_return_values_customer_gender($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("customer_gender", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->customer_gender);
              $aLookup = array();
              $this->_tmp_lookup_customer_gender = $this->customer_gender;

$aLookup[] = array(form_tb_customers_pack_protect_string('M') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Male")));
$aLookup[] = array(form_tb_customers_pack_protect_string('F') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Female")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_customer_gender'][] = 'M';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_customer_gender'][] = 'F';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['customer_gender']) && !empty($this->NM_ajax_info['select_html']['customer_gender']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['customer_gender']);
          }
          $this->NM_ajax_info['fldList']['customer_gender'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['customer_gender']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['customer_gender']['valList'][$i] = form_tb_customers_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['customer_gender']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['customer_gender']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['customer_gender']['labList'] = $aLabel;
          }
   }

          //----- customer_birthday
   function ajax_return_values_customer_birthday($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("customer_birthday", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->customer_birthday);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['customer_birthday'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- customer_num_doc
   function ajax_return_values_customer_num_doc($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("customer_num_doc", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->customer_num_doc);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['customer_num_doc'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- doctype
   function ajax_return_values_doctype($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("doctype", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->doctype);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['doctype'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- id_country
   function ajax_return_values_id_country($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("id_country", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->id_country);
              $aLookup = array();
              $this->_tmp_lookup_id_country = $this->id_country;

$aLookup[] = array(form_tb_customers_pack_protect_string('AF') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Afghanistan")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AL') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Albania")));
$aLookup[] = array(form_tb_customers_pack_protect_string('DZ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Algeria")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AS') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("American Samoa")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AD') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Andorra")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AO') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Angola")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AI') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Anguilla")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AQ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Antarctica")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AG') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Antigua and Barbuda")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Argentina")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Armenia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AW') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Aruba")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AU') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Australia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AT') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Austria")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AZ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Azerbaijan")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BS') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Bahamas")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BH') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Bahrain")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BD') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Bangladesh")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BB') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Barbados")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BY') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Belarus")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BE') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Belgium")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BZ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Belize")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BJ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Benin")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Bermuda")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BT') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Bhutan")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BO') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Bolivia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BA') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Bosnia and Herzegovina")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BW') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Botswana")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BV') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Bouvet Island")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Brasil")));
$aLookup[] = array(form_tb_customers_pack_protect_string('IO') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("British Indian Ocean Territory")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BN') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Brunei Darussalam")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BG') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Bulgaria")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BF') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Burkina Faso")));
$aLookup[] = array(form_tb_customers_pack_protect_string('BI') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Burundi")));
$aLookup[] = array(form_tb_customers_pack_protect_string('KH') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Cambodia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Cameroon")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CA') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Canada")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CV') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Cape Verde")));
$aLookup[] = array(form_tb_customers_pack_protect_string('KY') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Cayman Islands")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CF') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Central African Republic")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TD') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Chad")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CL') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Chile")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CN') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("China")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CX') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Christmas Island")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CC') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Cocos (Keeling) Islands")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CO') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Colombia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('KM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Comoros")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CG') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Congo")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CK') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Cook Islands")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Costa Rica")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CI') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Cote d Ivoire")));
$aLookup[] = array(form_tb_customers_pack_protect_string('HR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Croatia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CU') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Cuba")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CY') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Cyprus")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CZ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Czech Republic")));
$aLookup[] = array(form_tb_customers_pack_protect_string('DK') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Denmark")));
$aLookup[] = array(form_tb_customers_pack_protect_string('DJ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Djibouti")));
$aLookup[] = array(form_tb_customers_pack_protect_string('DM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Dominica")));
$aLookup[] = array(form_tb_customers_pack_protect_string('DO') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Dominican Republic")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TP') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("East Timor")));
$aLookup[] = array(form_tb_customers_pack_protect_string('EC') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Ecuador")));
$aLookup[] = array(form_tb_customers_pack_protect_string('EG') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Egypt")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SV') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("El Salvador")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GQ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Equatorial Guinea")));
$aLookup[] = array(form_tb_customers_pack_protect_string('ER') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Eritrea")));
$aLookup[] = array(form_tb_customers_pack_protect_string('EE') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Estonia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('ET') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Ethiopia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('FK') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Falkland Islands (Malvinas)")));
$aLookup[] = array(form_tb_customers_pack_protect_string('FO') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Faroe Islands")));
$aLookup[] = array(form_tb_customers_pack_protect_string('FJ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Fiji")));
$aLookup[] = array(form_tb_customers_pack_protect_string('FI') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Finland")));
$aLookup[] = array(form_tb_customers_pack_protect_string('FR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("France")));
$aLookup[] = array(form_tb_customers_pack_protect_string('FX') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("France Metropolitan")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GF') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("French Guiana")));
$aLookup[] = array(form_tb_customers_pack_protect_string('PF') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("French Polynesia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TF') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("French Southern Territories")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GA') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Gabon")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Gambia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GE') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Georgia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('DE') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Germany")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GH') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Ghana")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GI') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Gibraltar")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Greece")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GL') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Greenland")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GD') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Grenada")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GP') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Guadeloupe")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GU') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Guam")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GT') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Guatemala")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GN') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Guinea")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GW') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Guinea-Bissau")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GY') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Guyana")));
$aLookup[] = array(form_tb_customers_pack_protect_string('HT') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Haiti")));
$aLookup[] = array(form_tb_customers_pack_protect_string('HM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Heard Island and McDonald Islands")));
$aLookup[] = array(form_tb_customers_pack_protect_string('HN') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Honduras")));
$aLookup[] = array(form_tb_customers_pack_protect_string('HK') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Hong Kong")));
$aLookup[] = array(form_tb_customers_pack_protect_string('HU') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Hungary")));
$aLookup[] = array(form_tb_customers_pack_protect_string('IS') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Iceland")));
$aLookup[] = array(form_tb_customers_pack_protect_string('IN') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("India")));
$aLookup[] = array(form_tb_customers_pack_protect_string('ID') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Indonesia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('IR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Iran (Islamic Republic of)")));
$aLookup[] = array(form_tb_customers_pack_protect_string('IQ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Iraq")));
$aLookup[] = array(form_tb_customers_pack_protect_string('IE') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Ireland")));
$aLookup[] = array(form_tb_customers_pack_protect_string('IL') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Israel")));
$aLookup[] = array(form_tb_customers_pack_protect_string('IT') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Italy")));
$aLookup[] = array(form_tb_customers_pack_protect_string('JM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Jamaica")));
$aLookup[] = array(form_tb_customers_pack_protect_string('JP') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Japan")));
$aLookup[] = array(form_tb_customers_pack_protect_string('JO') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Jordan")));
$aLookup[] = array(form_tb_customers_pack_protect_string('KZ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Kazakhstan")));
$aLookup[] = array(form_tb_customers_pack_protect_string('KE') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Kenya")));
$aLookup[] = array(form_tb_customers_pack_protect_string('KI') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Kiribati")));
$aLookup[] = array(form_tb_customers_pack_protect_string('KP') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Korea Democratic People Republic of")));
$aLookup[] = array(form_tb_customers_pack_protect_string('KR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Korea Republic of")));
$aLookup[] = array(form_tb_customers_pack_protect_string('KW') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Kuwait")));
$aLookup[] = array(form_tb_customers_pack_protect_string('KG') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Kyrgyzstan")));
$aLookup[] = array(form_tb_customers_pack_protect_string('LA') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Lao People Democratic Republic")));
$aLookup[] = array(form_tb_customers_pack_protect_string('LT') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Latin America")));
$aLookup[] = array(form_tb_customers_pack_protect_string('LV') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Latvia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('LB') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Lebanon")));
$aLookup[] = array(form_tb_customers_pack_protect_string('LS') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Lesotho")));
$aLookup[] = array(form_tb_customers_pack_protect_string('LR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Liberia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('LY') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Libyan Arab Jamahiriya")));
$aLookup[] = array(form_tb_customers_pack_protect_string('LI') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Liechtenstein")));
$aLookup[] = array(form_tb_customers_pack_protect_string('LX') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Lithuania")));
$aLookup[] = array(form_tb_customers_pack_protect_string('LU') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Luxembourg")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MO') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Macau")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MK') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Macedonia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MG') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Madagascar")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MW') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Malawi")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MY') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Malaysia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MV') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Maldives")));
$aLookup[] = array(form_tb_customers_pack_protect_string('ML') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Mali")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MT') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Malta")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MH') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Marshall Islands")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MQ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Martinique")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Mauritania")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MU') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Mauritius")));
$aLookup[] = array(form_tb_customers_pack_protect_string('YT') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Mayotte")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MX') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Mexico")));
$aLookup[] = array(form_tb_customers_pack_protect_string('FM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Micronesia (Federated States of)")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MD') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Moldova Republic of")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MC') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Monaco")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MN') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Mongolia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MS') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Montserrat")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MA') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Morocco")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MZ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Mozambique")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Myanmar")));
$aLookup[] = array(form_tb_customers_pack_protect_string('NA') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Namibia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('NR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Nauru")));
$aLookup[] = array(form_tb_customers_pack_protect_string('NP') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Nepal")));
$aLookup[] = array(form_tb_customers_pack_protect_string('NL') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Netherlands")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AN') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Netherlands Antilles")));
$aLookup[] = array(form_tb_customers_pack_protect_string('NC') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("New Caledonia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('NZ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("New Zealand")));
$aLookup[] = array(form_tb_customers_pack_protect_string('NI') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Nicaragua")));
$aLookup[] = array(form_tb_customers_pack_protect_string('NE') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Niger")));
$aLookup[] = array(form_tb_customers_pack_protect_string('NG') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Nigeria")));
$aLookup[] = array(form_tb_customers_pack_protect_string('NU') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Niue")));
$aLookup[] = array(form_tb_customers_pack_protect_string('NF') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Norfolk Island")));
$aLookup[] = array(form_tb_customers_pack_protect_string('MP') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Northern Mariana Islands")));
$aLookup[] = array(form_tb_customers_pack_protect_string('NO') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Norway")));
$aLookup[] = array(form_tb_customers_pack_protect_string('OM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Oman")));
$aLookup[] = array(form_tb_customers_pack_protect_string('PK') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Pakistan")));
$aLookup[] = array(form_tb_customers_pack_protect_string('PW') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Palau")));
$aLookup[] = array(form_tb_customers_pack_protect_string('PA') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Panama")));
$aLookup[] = array(form_tb_customers_pack_protect_string('PG') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Papua New Guinea")));
$aLookup[] = array(form_tb_customers_pack_protect_string('PY') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Paraguay")));
$aLookup[] = array(form_tb_customers_pack_protect_string('PE') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Peru")));
$aLookup[] = array(form_tb_customers_pack_protect_string('PH') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Philippines")));
$aLookup[] = array(form_tb_customers_pack_protect_string('PN') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Pitcairn")));
$aLookup[] = array(form_tb_customers_pack_protect_string('PL') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Poland")));
$aLookup[] = array(form_tb_customers_pack_protect_string('PT') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Portugal")));
$aLookup[] = array(form_tb_customers_pack_protect_string('PR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Puerto Rico")));
$aLookup[] = array(form_tb_customers_pack_protect_string('QA') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Qatar")));
$aLookup[] = array(form_tb_customers_pack_protect_string('RE') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Reunion")));
$aLookup[] = array(form_tb_customers_pack_protect_string('RO') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Romania")));
$aLookup[] = array(form_tb_customers_pack_protect_string('RU') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Russian Federation")));
$aLookup[] = array(form_tb_customers_pack_protect_string('RW') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Rwanda")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SH') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Saint Helena")));
$aLookup[] = array(form_tb_customers_pack_protect_string('KN') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Saint Kitts and Nevis")));
$aLookup[] = array(form_tb_customers_pack_protect_string('LC') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Saint Lucia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('PM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Saint Pierre and Miquelon")));
$aLookup[] = array(form_tb_customers_pack_protect_string('VC') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Saint Vincent and the Grenadines")));
$aLookup[] = array(form_tb_customers_pack_protect_string('WS') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Samoa")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("San Marino")));
$aLookup[] = array(form_tb_customers_pack_protect_string('ST') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Sao Tome and Principe")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SA') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Saudi Arabia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SN') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Senegal")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SC') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Seychelles")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SL') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Sierra Leone")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SG') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Singapore")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SK') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Slovakia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SI') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Slovenia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SB') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Solomon Islands")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SO') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Somalia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('ZA') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("South Africa")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GS') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("South Georgia and the South Sandwich")));
$aLookup[] = array(form_tb_customers_pack_protect_string('ES') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Spain")));
$aLookup[] = array(form_tb_customers_pack_protect_string('LK') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Sri Lanka")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SD') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Sudan")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Suriname")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SJ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Svalbard and Jan Mayen Islands")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SZ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Swaziland")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SE') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Sweden")));
$aLookup[] = array(form_tb_customers_pack_protect_string('CH') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Switzerland")));
$aLookup[] = array(form_tb_customers_pack_protect_string('SY') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Syrian Arab Republic")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TW') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Taiwan Republic of China")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TJ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Tajikistan")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TZ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Tanzania United Republic of")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TH') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Thailand")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TG') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Togo")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TK') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Tokelau")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TO') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Tonga")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TT') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Trinidad and Tobago")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TN') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Tunisia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Turkey")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Turkmenistan")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TC') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Turks and Caicos Islands")));
$aLookup[] = array(form_tb_customers_pack_protect_string('TV') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Tuvalu")));
$aLookup[] = array(form_tb_customers_pack_protect_string('UG') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Uganda")));
$aLookup[] = array(form_tb_customers_pack_protect_string('UA') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Ukraine")));
$aLookup[] = array(form_tb_customers_pack_protect_string('AE') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("United Arab Emirates")));
$aLookup[] = array(form_tb_customers_pack_protect_string('GB') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("United Kingdom")));
$aLookup[] = array(form_tb_customers_pack_protect_string('US') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("United States")));
$aLookup[] = array(form_tb_customers_pack_protect_string('UM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("United States Minor Outlying Islands")));
$aLookup[] = array(form_tb_customers_pack_protect_string('UY') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Uruguay")));
$aLookup[] = array(form_tb_customers_pack_protect_string('UZ') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Uzbekistan")));
$aLookup[] = array(form_tb_customers_pack_protect_string('VU') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Vanuatu")));
$aLookup[] = array(form_tb_customers_pack_protect_string('VA') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Vatican City State (Holy See)")));
$aLookup[] = array(form_tb_customers_pack_protect_string('VE') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Venezuela")));
$aLookup[] = array(form_tb_customers_pack_protect_string('VN') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Viet Nam")));
$aLookup[] = array(form_tb_customers_pack_protect_string('VG') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Virgin Islands (British)")));
$aLookup[] = array(form_tb_customers_pack_protect_string('VI') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Virgin Islands (U.S.)")));
$aLookup[] = array(form_tb_customers_pack_protect_string('WF') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Wallis and Futuna Islands")));
$aLookup[] = array(form_tb_customers_pack_protect_string('EH') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Western Sahara")));
$aLookup[] = array(form_tb_customers_pack_protect_string('YE') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Yemen")));
$aLookup[] = array(form_tb_customers_pack_protect_string('YU') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Yugoslavia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('ZR') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Zaire")));
$aLookup[] = array(form_tb_customers_pack_protect_string('ZM') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Zambia")));
$aLookup[] = array(form_tb_customers_pack_protect_string('ZW') => str_replace('<', '&lt;',form_tb_customers_pack_protect_string("Zimbabwe")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AF';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AL';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'DZ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AS';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AD';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AI';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AQ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AG';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AW';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AU';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AT';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AZ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BS';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BH';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BD';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BB';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BY';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BZ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BJ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BT';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BA';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BW';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BV';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BN';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BG';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BF';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BI';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KH';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CA';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CV';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KY';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CF';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TD';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CL';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CN';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CX';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CC';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CG';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CK';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CI';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'HR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CU';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CY';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CZ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'DK';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'DJ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'DM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'DO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TP';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'EC';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'EG';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SV';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GQ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ER';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'EE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ET';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'FK';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'FO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'FJ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'FI';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'FR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'FX';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GF';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PF';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TF';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GA';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'DE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GH';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GI';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GL';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GD';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GP';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GU';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GT';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GN';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GW';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GY';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'HT';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'HM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'HN';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'HK';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'HU';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IS';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IN';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ID';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IQ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IL';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IT';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'JM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'JP';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'JO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KZ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KI';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KP';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KW';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KG';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LA';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LT';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LV';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LB';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LS';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LY';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LI';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LX';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LU';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MK';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MG';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MW';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MY';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MV';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ML';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MT';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MH';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MQ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MU';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'YT';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MX';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'FM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MD';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MC';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MN';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MS';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MA';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MZ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NA';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NP';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NL';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AN';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NC';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NZ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NI';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NG';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NU';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NF';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MP';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'OM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PK';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PW';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PA';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PG';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PY';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PH';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PN';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PL';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PT';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'QA';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'RE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'RO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'RU';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'RW';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SH';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KN';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LC';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'VC';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'WS';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ST';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SA';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SN';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SC';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SL';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SG';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SK';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SI';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SB';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ZA';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GS';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ES';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LK';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SD';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SJ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SZ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CH';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SY';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TW';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TJ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TZ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TH';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TG';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TK';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TT';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TN';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TC';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TV';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'UG';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'UA';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GB';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'US';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'UM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'UY';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'UZ';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'VU';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'VA';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'VE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'VN';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'VG';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'VI';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'WF';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'EH';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'YE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'YU';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ZR';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ZM';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ZW';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"id_country\"";
          if (isset($this->NM_ajax_info['select_html']['id_country']) && !empty($this->NM_ajax_info['select_html']['id_country']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['id_country']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->id_country == $sValue)
                  {
                      $this->_tmp_lookup_id_country = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['id_country'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['id_country']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['id_country']['valList'][$i] = form_tb_customers_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['id_country']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['id_country']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['id_country']['labList'] = $aLabel;
          }
   }

          //----- customer_address
   function ajax_return_values_customer_address($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("customer_address", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->customer_address);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['customer_address'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- customer_phone1
   function ajax_return_values_customer_phone1($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("customer_phone1", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->customer_phone1);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['customer_phone1'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- customer_phone2
   function ajax_return_values_customer_phone2($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("customer_phone2", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->customer_phone2);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['customer_phone2'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

    function fetchUniqueUploadName($originalName, $uploadDir, $fieldName)
    {
        $originalName = trim($originalName);
        if ('' == $originalName)
        {
            return $originalName;
        }
        if (!@is_dir($uploadDir))
        {
            return $originalName;
        }
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['upload_dir'][$fieldName][] = $newName;
            return $newName;
        }
    } // fetchUniqueUploadName

    function fetchFileNextName($uniqueName, $uniqueList)
    {
        $aPathinfo     = pathinfo($uniqueName);
        $fileExtension = $aPathinfo['extension'];
        $fileName      = $aPathinfo['filename'];
        $foundName     = false;
        $nameIt        = 1;
        if ('' != $fileExtension)
        {
            $fileExtension = '.' . $fileExtension;
        }
        while (!$foundName)
        {
            $testName = $fileName . '(' . $nameIt . ')' . $fileExtension;
            if (in_array($testName, $uniqueList))
            {
                $nameIt++;
            }
            else
            {
                $foundName = true;
                return $testName;
            }
        }
    } // fetchFileNextName

   function ajax_add_parameters()
   {
       $this->NM_ajax_info['summary_line'] = $this->getSummaryLine();
   } // ajax_add_parameters
  function nm_proc_onload($bFormat = true)
  {
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Field_no_validate'] = array();
      $this->nm_guardar_campos();
      if ($bFormat) $this->nm_formatar_campos();
  }
//
//----------------------------------------------------
//-----> 
//----------------------------------------------------
//----------- 


   function temRegistros($sWhere)
   {
       if ('' == $sWhere)
       {
           return false;
       }
       $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . ' WHERE ' . $sWhere;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
       $rsc = $this->Db->Execute($nmgp_sel_count); 
       if ($rsc === false && !$rsc->EOF)
       {
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg());
           exit; 
       }
       $iTotal = $rsc->fields[0];
       $rsc->Close();
       return 0 < $iTotal;
   } // temRegistros

   function deletaRegistros($sWhere)
   {
       if ('' == $sWhere)
       {
           return false;
       }
       $nmgp_sel_count = 'DELETE FROM ' . $this->Ini->nm_tabela . ' WHERE ' . $sWhere;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
       $rsc = $this->Db->Execute($nmgp_sel_count); 
       $bResult = $rsc;
       $rsc->Close();
       return $bResult == true;
   } // deletaRegistros
    function handleDbErrorMessage(&$dbErrorMessage, $dbErrorCode)
    {
        if (1267 == $dbErrorCode) {
            $dbErrorMessage = $this->Ini->Nm_lang['lang_errm_db_invalid_collation'];
        }
    }


   function nm_acessa_banco() 
   { 
      global  $nm_form_submit, $teste_validade, $sc_where;
 
      $NM_val_null = array();
      $NM_val_form = array();
      $this->sc_erro_insert = "";
      $this->sc_erro_update = "";
      $this->sc_erro_delete = "";
      if (!empty($this->sc_force_zero))
      {
          foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
          {
              eval('if ($this->' . $sc_force_zero_field . ' == 0) {$this->' . $sc_force_zero_field . ' = "";}');
          }
      }
      $this->sc_force_zero = array();
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $salva_opcao = $this->nmgp_opcao; 
      if ($this->sc_evento != "novo" && $this->sc_evento != "incluir") 
      { 
          $this->sc_evento = ""; 
      } 
      if ((!isset($this->Ini->nm_bases_access) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) && !$this->Ini->sc_tem_trans_banco && in_array($this->nmgp_opcao, array('excluir', 'incluir', 'alterar')))
      { 
          $this->Ini->sc_tem_trans_banco = $this->Db->BeginTrans(); 
      } 
      $NM_val_form['id_customer'] = $this->id_customer;
      $NM_val_form['customer_name'] = $this->customer_name;
      $NM_val_form['customer_gender'] = $this->customer_gender;
      $NM_val_form['customer_birthday'] = $this->customer_birthday;
      $NM_val_form['customer_num_doc'] = $this->customer_num_doc;
      $NM_val_form['doctype'] = $this->doctype;
      $NM_val_form['id_country'] = $this->id_country;
      $NM_val_form['customer_address'] = $this->customer_address;
      $NM_val_form['customer_phone1'] = $this->customer_phone1;
      $NM_val_form['customer_phone2'] = $this->customer_phone2;
      if ($this->id_customer === "" || is_null($this->id_customer))  
      { 
          $this->id_customer = 0;
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite, array('pdo_ibm'), array('pdo_sqlsrv'));
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->customer_num_doc_before_qstr = $this->customer_num_doc;
          $this->customer_num_doc = substr($this->Db->qstr($this->customer_num_doc), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->customer_num_doc = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->customer_num_doc);
          }
          if ($this->customer_num_doc == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->customer_num_doc = "null"; 
              $NM_val_null[] = "customer_num_doc";
          } 
          $this->customer_name_before_qstr = $this->customer_name;
          $this->customer_name = substr($this->Db->qstr($this->customer_name), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->customer_name = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->customer_name);
          }
          if ($this->customer_name == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->customer_name = "null"; 
              $NM_val_null[] = "customer_name";
          } 
          if ($this->customer_birthday == "")  
          { 
              $this->customer_birthday = "null"; 
              $NM_val_null[] = "customer_birthday";
          } 
          $this->customer_gender_before_qstr = $this->customer_gender;
          $this->customer_gender = substr($this->Db->qstr($this->customer_gender), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->customer_gender = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->customer_gender);
          }
          if ($this->customer_gender == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->customer_gender = "null"; 
              $NM_val_null[] = "customer_gender";
          } 
          $this->customer_phone1_before_qstr = $this->customer_phone1;
          $this->customer_phone1 = substr($this->Db->qstr($this->customer_phone1), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->customer_phone1 = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->customer_phone1);
          }
          if ($this->customer_phone1 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->customer_phone1 = "null"; 
              $NM_val_null[] = "customer_phone1";
          } 
          $this->customer_phone2_before_qstr = $this->customer_phone2;
          $this->customer_phone2 = substr($this->Db->qstr($this->customer_phone2), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->customer_phone2 = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->customer_phone2);
          }
          if ($this->customer_phone2 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->customer_phone2 = "null"; 
              $NM_val_null[] = "customer_phone2";
          } 
          $this->customer_address_before_qstr = $this->customer_address;
          $this->customer_address = substr($this->Db->qstr($this->customer_address), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->customer_address = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->customer_address);
          }
          if ($this->customer_address == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->customer_address = "null"; 
              $NM_val_null[] = "customer_address";
          } 
          $this->id_country_before_qstr = $this->id_country;
          $this->id_country = substr($this->Db->qstr($this->id_country), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->id_country = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->id_country);
          }
          if ($this->id_country == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->id_country = "null"; 
              $NM_val_null[] = "id_country";
          } 
          $this->doctype_before_qstr = $this->doctype;
          $this->doctype = substr($this->Db->qstr($this->doctype), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->doctype = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->doctype);
          }
          if ($this->doctype == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->doctype = "null"; 
              $NM_val_null[] = "doctype";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_tb_customers_pack_ajax_response();
              }
              exit; 
          }  
          $bUpdateOk = true;
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_nfnd']); 
              $this->nmgp_opcao = "nada"; 
              $bUpdateOk = false;
              $this->sc_evento = 'update';
          } 
          $aUpdateOk = array();
          $bUpdateOk = $bUpdateOk && empty($aUpdateOk);
          if ($bUpdateOk)
          { 
              $rs1->Close(); 
              $aDoNotUpdate = array();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "customer_num_doc = '$this->customer_num_doc', customer_name = '$this->customer_name', customer_birthday = #$this->customer_birthday#, customer_gender = '$this->customer_gender', customer_phone1 = '$this->customer_phone1', customer_phone2 = '$this->customer_phone2', customer_address = '$this->customer_address', id_country = '$this->id_country', doctype = '$this->doctype'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "customer_num_doc = '$this->customer_num_doc', customer_name = '$this->customer_name', customer_birthday = " . $this->Ini->date_delim . $this->customer_birthday . $this->Ini->date_delim1 . ", customer_gender = '$this->customer_gender', customer_phone1 = '$this->customer_phone1', customer_phone2 = '$this->customer_phone2', customer_address = '$this->customer_address', id_country = '$this->id_country', doctype = '$this->doctype'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "customer_num_doc = '$this->customer_num_doc', customer_name = '$this->customer_name', customer_birthday = " . $this->Ini->date_delim . $this->customer_birthday . $this->Ini->date_delim1 . ", customer_gender = '$this->customer_gender', customer_phone1 = '$this->customer_phone1', customer_phone2 = '$this->customer_phone2', customer_address = '$this->customer_address', id_country = '$this->id_country', doctype = '$this->doctype'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "customer_num_doc = '$this->customer_num_doc', customer_name = '$this->customer_name', customer_birthday = EXTEND('$this->customer_birthday', YEAR TO DAY), customer_gender = '$this->customer_gender', customer_phone1 = '$this->customer_phone1', customer_phone2 = '$this->customer_phone2', customer_address = '$this->customer_address', id_country = '$this->id_country', doctype = '$this->doctype'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "customer_num_doc = '$this->customer_num_doc', customer_name = '$this->customer_name', customer_birthday = " . $this->Ini->date_delim . $this->customer_birthday . $this->Ini->date_delim1 . ", customer_gender = '$this->customer_gender', customer_phone1 = '$this->customer_phone1', customer_phone2 = '$this->customer_phone2', customer_address = '$this->customer_address', id_country = '$this->id_country', doctype = '$this->doctype'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "customer_num_doc = '$this->customer_num_doc', customer_name = '$this->customer_name', customer_birthday = " . $this->Ini->date_delim . $this->customer_birthday . $this->Ini->date_delim1 . ", customer_gender = '$this->customer_gender', customer_phone1 = '$this->customer_phone1', customer_phone2 = '$this->customer_phone2', customer_address = '$this->customer_address', id_country = '$this->id_country', doctype = '$this->doctype'"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "customer_num_doc = '$this->customer_num_doc', customer_name = '$this->customer_name', customer_birthday = " . $this->Ini->date_delim . $this->customer_birthday . $this->Ini->date_delim1 . ", customer_gender = '$this->customer_gender', customer_phone1 = '$this->customer_phone1', customer_phone2 = '$this->customer_phone2', customer_address = '$this->customer_address', id_country = '$this->id_country', doctype = '$this->doctype'"; 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE id_customer = $this->id_customer ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE id_customer = $this->id_customer ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE id_customer = $this->id_customer ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE id_customer = $this->id_customer ";  
              }  
              else  
              {
                  $comando .= " WHERE id_customer = $this->id_customer ";  
              }  
              $comando = str_replace("N'null'", "null", $comando) ; 
              $comando = str_replace("'null'", "null", $comando) ; 
              $comando = str_replace("#null#", "null", $comando) ; 
              $comando = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $comando) ; 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                $comando = str_replace("EXTEND('', YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND('', YEAR TO DAY)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO DAY)", "null", $comando) ; 
              }  
              $useUpdateProcedure = false;
              if (!empty($SC_fields_update) || $useUpdateProcedure)
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
                  $rs = $this->Db->Execute($comando);  
                  if ($rs === false) 
                  { 
                      if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                      {
                          $dbErrorMessage = $this->Db->ErrorMsg();
                          $dbErrorCode = $this->Db->ErrorNo();
                          $this->handleDbErrorMessage($dbErrorMessage, $dbErrorCode);
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $dbErrorMessage, true);
                          if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                          { 
                              $this->sc_erro_update = $dbErrorMessage;
                              $this->NM_rollback_db(); 
                              if ($this->NM_ajax_flag)
                              {
                                  form_tb_customers_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->customer_num_doc = $this->customer_num_doc_before_qstr;
              $this->customer_name = $this->customer_name_before_qstr;
              $this->customer_gender = $this->customer_gender_before_qstr;
              $this->customer_phone1 = $this->customer_phone1_before_qstr;
              $this->customer_phone2 = $this->customer_phone2_before_qstr;
              $this->customer_address = $this->customer_address_before_qstr;
              $this->id_country = $this->id_country_before_qstr;
              $this->doctype = $this->doctype_before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
              }   
              $this->sc_evento = "update"; 
              $this->nmgp_opcao = "igual"; 
              $this->nm_flag_iframe = true;
              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }


              if     (isset($NM_val_form) && isset($NM_val_form['id_customer'])) { $this->id_customer = $NM_val_form['id_customer']; }
              elseif (isset($this->id_customer)) { $this->nm_limpa_alfa($this->id_customer); }
              if     (isset($NM_val_form) && isset($NM_val_form['customer_num_doc'])) { $this->customer_num_doc = $NM_val_form['customer_num_doc']; }
              elseif (isset($this->customer_num_doc)) { $this->nm_limpa_alfa($this->customer_num_doc); }
              if     (isset($NM_val_form) && isset($NM_val_form['customer_name'])) { $this->customer_name = $NM_val_form['customer_name']; }
              elseif (isset($this->customer_name)) { $this->nm_limpa_alfa($this->customer_name); }
              if     (isset($NM_val_form) && isset($NM_val_form['customer_gender'])) { $this->customer_gender = $NM_val_form['customer_gender']; }
              elseif (isset($this->customer_gender)) { $this->nm_limpa_alfa($this->customer_gender); }
              if     (isset($NM_val_form) && isset($NM_val_form['customer_phone1'])) { $this->customer_phone1 = $NM_val_form['customer_phone1']; }
              elseif (isset($this->customer_phone1)) { $this->nm_limpa_alfa($this->customer_phone1); }
              if     (isset($NM_val_form) && isset($NM_val_form['customer_phone2'])) { $this->customer_phone2 = $NM_val_form['customer_phone2']; }
              elseif (isset($this->customer_phone2)) { $this->nm_limpa_alfa($this->customer_phone2); }
              if     (isset($NM_val_form) && isset($NM_val_form['customer_address'])) { $this->customer_address = $NM_val_form['customer_address']; }
              elseif (isset($this->customer_address)) { $this->nm_limpa_alfa($this->customer_address); }
              if     (isset($NM_val_form) && isset($NM_val_form['id_country'])) { $this->id_country = $NM_val_form['id_country']; }
              elseif (isset($this->id_country)) { $this->nm_limpa_alfa($this->id_country); }
              if     (isset($NM_val_form) && isset($NM_val_form['doctype'])) { $this->doctype = $NM_val_form['doctype']; }
              elseif (isset($this->doctype)) { $this->nm_limpa_alfa($this->doctype); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('id_customer', 'customer_name', 'customer_gender', 'customer_birthday', 'customer_num_doc', 'doctype', 'id_country', 'customer_address', 'customer_phone1', 'customer_phone2'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              $this->nm_tira_formatacao();
              $this->nm_converte_datas();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          { 
              $NM_seq_auto = "NEXT VALUE FOR id_customer_seq, ";
              $NM_cmp_auto = "id_customer, ";
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $NM_seq_auto = "id_customer_seq.NEXTVAL, ";
              $NM_cmp_auto = "id_customer, ";
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          { 
              $NM_seq_auto = "nextval('id_customer_seq'), ";
              $NM_cmp_auto = "id_customer, ";
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $NM_seq_auto = "gen_id(id_customer_seq, 1), ";
              $NM_cmp_auto = "id_customer, ";
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "id_customer, ";
          } 
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      form_tb_customers_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (customer_num_doc, customer_name, customer_birthday, customer_gender, customer_phone1, customer_phone2, customer_address, id_country, doctype) VALUES ('$this->customer_num_doc', '$this->customer_name', #$this->customer_birthday#, '$this->customer_gender', '$this->customer_phone1', '$this->customer_phone2', '$this->customer_address', '$this->id_country', '$this->doctype')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "customer_num_doc, customer_name, customer_birthday, customer_gender, customer_phone1, customer_phone2, customer_address, id_country, doctype) VALUES (" . $NM_seq_auto . "'$this->customer_num_doc', '$this->customer_name', " . $this->Ini->date_delim . $this->customer_birthday . $this->Ini->date_delim1 . ", '$this->customer_gender', '$this->customer_phone1', '$this->customer_phone2', '$this->customer_address', '$this->id_country', '$this->doctype')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "customer_num_doc, customer_name, customer_birthday, customer_gender, customer_phone1, customer_phone2, customer_address, id_country, doctype) VALUES (" . $NM_seq_auto . "'$this->customer_num_doc', '$this->customer_name', " . $this->Ini->date_delim . $this->customer_birthday . $this->Ini->date_delim1 . ", '$this->customer_gender', '$this->customer_phone1', '$this->customer_phone2', '$this->customer_address', '$this->id_country', '$this->doctype')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "customer_num_doc, customer_name, customer_birthday, customer_gender, customer_phone1, customer_phone2, customer_address, id_country, doctype) VALUES (" . $NM_seq_auto . "'$this->customer_num_doc', '$this->customer_name', " . $this->Ini->date_delim . $this->customer_birthday . $this->Ini->date_delim1 . ", '$this->customer_gender', '$this->customer_phone1', '$this->customer_phone2', '$this->customer_address', '$this->id_country', '$this->doctype')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "customer_num_doc, customer_name, customer_birthday, customer_gender, customer_phone1, customer_phone2, customer_address, id_country, doctype) VALUES (" . $NM_seq_auto . "'$this->customer_num_doc', '$this->customer_name', EXTEND('$this->customer_birthday', YEAR TO DAY), '$this->customer_gender', '$this->customer_phone1', '$this->customer_phone2', '$this->customer_address', '$this->id_country', '$this->doctype')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "customer_num_doc, customer_name, customer_birthday, customer_gender, customer_phone1, customer_phone2, customer_address, id_country, doctype) VALUES (" . $NM_seq_auto . "'$this->customer_num_doc', '$this->customer_name', " . $this->Ini->date_delim . $this->customer_birthday . $this->Ini->date_delim1 . ", '$this->customer_gender', '$this->customer_phone1', '$this->customer_phone2', '$this->customer_address', '$this->id_country', '$this->doctype')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "customer_num_doc, customer_name, customer_birthday, customer_gender, customer_phone1, customer_phone2, customer_address, id_country, doctype) VALUES (" . $NM_seq_auto . "'$this->customer_num_doc', '$this->customer_name', " . $this->Ini->date_delim . $this->customer_birthday . $this->Ini->date_delim1 . ", '$this->customer_gender', '$this->customer_phone1', '$this->customer_phone2', '$this->customer_address', '$this->id_country', '$this->doctype')"; 
              }
              elseif ($this->Ini->nm_tpbanco == 'pdo_ibm')
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "customer_num_doc, customer_name, customer_birthday, customer_gender, customer_phone1, customer_phone2, customer_address, id_country, doctype) VALUES (" . $NM_seq_auto . "'$this->customer_num_doc', '$this->customer_name', " . $this->Ini->date_delim . $this->customer_birthday . $this->Ini->date_delim1 . ", '$this->customer_gender', '$this->customer_phone1', '$this->customer_phone2', '$this->customer_address', '$this->id_country', '$this->doctype')"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "customer_num_doc, customer_name, customer_birthday, customer_gender, customer_phone1, customer_phone2, customer_address, id_country, doctype) VALUES (" . $NM_seq_auto . "'$this->customer_num_doc', '$this->customer_name', " . $this->Ini->date_delim . $this->customer_birthday . $this->Ini->date_delim1 . ", '$this->customer_gender', '$this->customer_phone1', '$this->customer_phone2', '$this->customer_address', '$this->id_country', '$this->doctype')"; 
              }
              $comando = str_replace("N'null'", "null", $comando) ; 
              $comando = str_replace("'null'", "null", $comando) ; 
              $comando = str_replace("#null#", "null", $comando) ; 
              $comando = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $comando) ; 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                $comando = str_replace("EXTEND('', YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND('', YEAR TO DAY)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO DAY)", "null", $comando) ; 
              }  
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
              $rs = $this->Db->Execute($comando); 
              if ($rs === false)  
              { 
                  if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                  {
                      $dbErrorMessage = $this->Db->ErrorMsg();
                      $dbErrorCode = $this->Db->ErrorNo();
                      $this->handleDbErrorMessage($dbErrorMessage, $dbErrorCode);
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $dbErrorMessage, true);
                      if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
                      { 
                          $this->sc_erro_insert = $dbErrorMessage;
                          $this->nmgp_opcao     = 'refresh_insert';
                          $this->NM_rollback_db(); 
                          if ($this->NM_ajax_flag)
                          {
                              form_tb_customers_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase)) 
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select @@identity"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          form_tb_customers_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->id_customer =  $rsy->fields[0];
                 $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select last_insert_id()"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id_customer = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SELECT dbinfo('sqlca.sqlerrd1') FROM " . $this->Ini->nm_tabela; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id_customer = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select id_customer_seq.currval from dual"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id_customer = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "values PREVVAL FOR id_customer_seq"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id_customer = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select CURRVAL('id_customer_seq')"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id_customer = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select gen_id(id_customer_seq, 0) from " . $this->Ini->nm_tabela; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id_customer = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select last_insert_rowid()"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id_customer = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->customer_num_doc = $this->customer_num_doc_before_qstr;
              $this->customer_name = $this->customer_name_before_qstr;
              $this->customer_gender = $this->customer_gender_before_qstr;
              $this->customer_phone1 = $this->customer_phone1_before_qstr;
              $this->customer_phone2 = $this->customer_phone2_before_qstr;
              $this->customer_address = $this->customer_address_before_qstr;
              $this->id_country = $this->id_country_before_qstr;
              $this->doctype = $this->doctype_before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->customer_num_doc = $this->customer_num_doc_before_qstr;
              $this->customer_name = $this->customer_name_before_qstr;
              $this->customer_gender = $this->customer_gender_before_qstr;
              $this->customer_phone1 = $this->customer_phone1_before_qstr;
              $this->customer_phone2 = $this->customer_phone2_before_qstr;
              $this->customer_address = $this->customer_address_before_qstr;
              $this->id_country = $this->id_country_before_qstr;
              $this->doctype = $this->doctype_before_qstr;
              $this->sc_insert_on = true; 
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['return_edit'] = "new";
              } 
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->id_customer = substr($this->Db->qstr($this->id_customer), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_dele_nfnd']); 
              $this->nmgp_opcao = "nada"; 
              $this->sc_evento = 'delete';
          } 
          else 
          { 
              $rs1->Close(); 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_customer = $this->id_customer "); 
              }  
              if ($rs === false) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dele'], $this->Db->ErrorMsg(), true); 
                  if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                  { 
                      $this->sc_erro_delete = $this->Db->ErrorMsg();  
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          form_tb_customers_pack_ajax_response();
                          exit; 
                      }
                  } 
              } 
              $this->sc_evento = "delete"; 
              if (empty($this->sc_erro_delete)) {
                  $this->record_delete_ok = true;
              }
              $this->nmgp_opcao = "avanca"; 
              $this->nm_flag_iframe = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total']);
              }

              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }
          }

          }
          else
          {
              $this->sc_evento = "delete"; 
              $this->nmgp_opcao = "igual"; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $sMsgErro); 
          }

      }  
      if (!empty($this->sc_force_zero))
      {
          foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
          {
              eval('if ($this->' . $sc_force_zero_field . ' == 0) {$this->' . $sc_force_zero_field . ' = "";}');
          }
      }
      $this->sc_force_zero = array();
      if (!empty($NM_val_null))
      {
          foreach ($NM_val_null as $i_val_null => $sc_val_null_field)
          {
              eval('$this->' . $sc_val_null_field . ' = "";');
          }
      }
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['parms'] = "id_customer?#?$this->id_customer?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->id_customer = null === $this->id_customer ? null : substr($this->Db->qstr($this->id_customer), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter'] . ")";
          }
      }
//------------ 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "R")
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['iframe_evento']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['iframe_evento'] == "insert") 
          { 
               $this->nmgp_opcao = "novo"; 
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['select'] = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['iframe_evento'] = $this->sc_evento; 
      } 
      if (!isset($this->nmgp_opcao) || empty($this->nmgp_opcao)) 
      { 
          if (empty($this->id_customer)) 
          { 
              $this->nmgp_opcao = "inicio"; 
          } 
          else 
          { 
              $this->nmgp_opcao = "igual"; 
          } 
      } 
      if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav']) 
      { 
          $this->nmgp_opcao = "inicio";
      } 
      if ($this->nmgp_opcao != "nada" && (trim($this->id_customer) == "")) 
      { 
          if ($this->nmgp_opcao == "avanca")  
          { 
              $this->nmgp_opcao = "final"; 
          } 
          elseif ($this->nmgp_opcao != "novo")
          { 
              $this->nmgp_opcao = "inicio"; 
          } 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "F" && $this->sc_evento == "insert")
      {
          $this->nmgp_opcao = "final";
      }
      $sc_where = trim("");
      if (substr(strtolower($sc_where), 0, 5) == "where")
      {
          $sc_where  = substr($sc_where , 5);
      }
      if (!empty($sc_where))
      {
          $sc_where = " where " . $sc_where . " ";
      }
      if ('' != $sc_where_filter)
      {
          $sc_where = ('' != $sc_where) ? $sc_where . ' and (' . $sc_where_filter . ')' : ' where ' . $sc_where_filter;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total']))
      { 
          $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rt = $this->Db->Execute($nmgp_select) ; 
          if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          $qt_geral_reg_form_tb_customers = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total'] = $qt_geral_reg_form_tb_customers;
          $rt->Close(); 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->id_customer))
          {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $Key_Where = "id_customer < $this->id_customer "; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $Key_Where = "id_customer < $this->id_customer "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $Key_Where = "id_customer < $this->id_customer "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $Key_Where = "id_customer < $this->id_customer "; 
              }
              else  
              {
                  $Key_Where = "id_customer < $this->id_customer "; 
              }
              $Where_Start = (empty($sc_where)) ? " where " . $Key_Where :  $sc_where . " and (" . $Key_Where . ")";
              $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $Where_Start; 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rt = $this->Db->Execute($nmgp_select) ; 
              if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
                  exit ; 
              }  
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] = $rt->fields[0];
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_form_tb_customers = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total'];
      } 
      if ($this->nmgp_opcao == "inicio") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start']++; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] > $qt_geral_reg_form_tb_customers)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] = $qt_geral_reg_form_tb_customers; 
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start']--; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] = $qt_geral_reg_form_tb_customers; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_form_tb_customers) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] = 0;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] + 1;
      $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] + 1; 
      $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_qtd']; 
      $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total'] + 1; 
      $this->NM_gera_nav_page(); 
      $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
              $nmgp_select = "SELECT id_customer, customer_num_doc, customer_name, str_replace (convert(char(10),customer_birthday,102), '.', '-') + ' ' + convert(char(8),customer_birthday,20), customer_gender, customer_phone1, customer_phone2, customer_address, id_country, doctype from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $nmgp_select = "SELECT id_customer, customer_num_doc, customer_name, convert(char(23),customer_birthday,121), customer_gender, customer_phone1, customer_phone2, customer_address, id_country, doctype from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $nmgp_select = "SELECT id_customer, customer_num_doc, customer_name, customer_birthday, customer_gender, customer_phone1, customer_phone2, customer_address, id_country, doctype from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $nmgp_select = "SELECT id_customer, customer_num_doc, customer_name, EXTEND(customer_birthday, YEAR TO DAY), customer_gender, customer_phone1, customer_phone2, customer_address, id_country, doctype from " . $this->Ini->nm_tabela ; 
          } 
          else 
          { 
              $nmgp_select = "SELECT id_customer, customer_num_doc, customer_name, customer_birthday, customer_gender, customer_phone1, customer_phone2, customer_address, id_country, doctype from " . $this->Ini->nm_tabela ; 
          } 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $aWhere[] = "id_customer = $this->id_customer"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $aWhere[] = "id_customer = $this->id_customer"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $aWhere[] = "id_customer = $this->id_customer"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $aWhere[] = "id_customer = $this->id_customer"; 
              }  
              else  
              {
                  $aWhere[] = "id_customer = $this->id_customer"; 
              }  
              if (!empty($sc_where_filter))  
              {
                  $teste_select = $nmgp_select . $this->returnWhere($aWhere);
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $teste_select; 
                  $rs = $this->Db->Execute($teste_select); 
                  if ($rs->EOF)
                  {
                     $aWhere = array($sc_where_filter);
                  }  
                  $rs->Close(); 
              }  
          } 
          $nmgp_select .= $this->returnWhere($aWhere) . ' ';
          $sc_order_by = "";
          $sc_order_by = "id_customer";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start']) ;  
              } 
          } 
          if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_nfnd_extr'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($rs->EOF) 
          { 
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['empty_filter'] = true;
                  return; 
              }
              if ($this->nmgp_botoes['insert'] != "on")
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
              }
              $this->nmgp_opcao = "novo"; 
              $this->nm_flag_saida_novo = "S"; 
              $rs->Close(); 
              if ($this->aba_iframe)
              {
                  $this->NM_ajax_info['buttonDisplay']['exit'] = $this->nmgp_botoes['exit'] = 'off';
              }
          } 
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_nfnd_extr']); 
              $this->nmgp_opcao = "novo"; 
          }  
          if ($this->nmgp_opcao != "novo") 
          { 
              $this->id_customer = $rs->fields[0] ; 
              $this->nmgp_dados_select['id_customer'] = $this->id_customer;
              $this->customer_num_doc = $rs->fields[1] ; 
              $this->nmgp_dados_select['customer_num_doc'] = $this->customer_num_doc;
              $this->customer_name = $rs->fields[2] ; 
              $this->nmgp_dados_select['customer_name'] = $this->customer_name;
              $this->customer_birthday = $rs->fields[3] ; 
              $this->nmgp_dados_select['customer_birthday'] = $this->customer_birthday;
              $this->customer_gender = $rs->fields[4] ; 
              $this->nmgp_dados_select['customer_gender'] = $this->customer_gender;
              $this->customer_phone1 = $rs->fields[5] ; 
              $this->nmgp_dados_select['customer_phone1'] = $this->customer_phone1;
              $this->customer_phone2 = $rs->fields[6] ; 
              $this->nmgp_dados_select['customer_phone2'] = $this->customer_phone2;
              $this->customer_address = $rs->fields[7] ; 
              $this->nmgp_dados_select['customer_address'] = $this->customer_address;
              $this->id_country = $rs->fields[8] ; 
              $this->nmgp_dados_select['id_country'] = $this->id_country;
              $this->doctype = $rs->fields[9] ; 
              $this->nmgp_dados_select['doctype'] = $this->doctype;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->id_customer = (string)$this->id_customer; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['parms'] = "id_customer?#?$this->id_customer?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] < $qt_geral_reg_form_tb_customers;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opcao']   = '';
          }
      } 
      if ($this->nmgp_opcao == "novo" || $this->nmgp_opcao == "refresh_insert") 
      { 
          $this->sc_evento_old = $this->sc_evento;
          $this->sc_evento = "novo";
          if ('refresh_insert' == $this->nmgp_opcao)
          {
              $this->nmgp_opcao = 'novo';
          }
          else
          {
              $this->nm_formatar_campos();
              $this->id_customer = "";  
              $this->nmgp_dados_form["id_customer"] = $this->id_customer;
              $this->customer_num_doc = "";  
              $this->nmgp_dados_form["customer_num_doc"] = $this->customer_num_doc;
              $this->customer_name = "";  
              $this->nmgp_dados_form["customer_name"] = $this->customer_name;
              $this->customer_birthday = "";  
              $this->customer_birthday_hora = "" ;  
              $this->nmgp_dados_form["customer_birthday"] = $this->customer_birthday;
              $this->customer_gender = "";  
              $this->nmgp_dados_form["customer_gender"] = $this->customer_gender;
              $this->customer_phone1 = "";  
              $this->nmgp_dados_form["customer_phone1"] = $this->customer_phone1;
              $this->customer_phone2 = "";  
              $this->nmgp_dados_form["customer_phone2"] = $this->customer_phone2;
              $this->customer_address = "";  
              $this->nmgp_dados_form["customer_address"] = $this->customer_address;
              $this->id_country = "";  
              $this->nmgp_dados_form["id_country"] = $this->id_country;
              $this->doctype = "";  
              $this->nmgp_dados_form["doctype"] = $this->doctype;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
      }  
//
//
//-- 
      if ($this->nmgp_opcao != "novo") 
      {
      }
      if (!isset($this->nmgp_refresh_fields)) 
      { 
          $this->nm_proc_onload();
      }
  }
// 
//-- 
   function nm_db_retorna($str_where_param = '') 
   {  
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_customer) from " . $this->Ini->nm_tabela . " where id_customer < $this->id_customer" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(id_customer) from " . $this->Ini->nm_tabela . " where id_customer < $this->id_customer" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_customer) from " . $this->Ini->nm_tabela . " where id_customer < $this->id_customer" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(id_customer) from " . $this->Ini->nm_tabela . " where id_customer < $this->id_customer" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_customer) from " . $this->Ini->nm_tabela . " where id_customer < $this->id_customer" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(id_customer) from " . $this->Ini->nm_tabela . " where id_customer < $this->id_customer" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_customer) from " . $this->Ini->nm_tabela . " where id_customer < $this->id_customer" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(id_customer) from " . $this->Ini->nm_tabela . " where id_customer < $this->id_customer" . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_customer) from " . $this->Ini->nm_tabela . " where id_customer < $this->id_customer" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(id_customer) from " . $this->Ini->nm_tabela . " where id_customer < $this->id_customer" . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->id_customer = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
         $rs->Close();  
         $this->nmgp_opcao = "igual";  
         return ;  
     } 
     else 
     { 
        $this->nmgp_opcao = "inicio";  
        $rs->Close();  
        return ; 
     } 
   } 
// 
//-- 
   function nm_db_avanca($str_where_param = '') 
   {  
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id_customer) from " . $this->Ini->nm_tabela . " where id_customer > $this->id_customer" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(id_customer) from " . $this->Ini->nm_tabela . " where id_customer > $this->id_customer" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id_customer) from " . $this->Ini->nm_tabela . " where id_customer > $this->id_customer" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(id_customer) from " . $this->Ini->nm_tabela . " where id_customer > $this->id_customer" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id_customer) from " . $this->Ini->nm_tabela . " where id_customer > $this->id_customer" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(id_customer) from " . $this->Ini->nm_tabela . " where id_customer > $this->id_customer" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id_customer) from " . $this->Ini->nm_tabela . " where id_customer > $this->id_customer" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(id_customer) from " . $this->Ini->nm_tabela . " where id_customer > $this->id_customer" . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id_customer) from " . $this->Ini->nm_tabela . " where id_customer > $this->id_customer" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(id_customer) from " . $this->Ini->nm_tabela . " where id_customer > $this->id_customer" . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->id_customer = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
         $rs->Close();  
         $this->nmgp_opcao = "igual";  
         return ;  
     } 
     else 
     { 
        $this->nmgp_opcao = "final";  
        $rs->Close();  
        return ; 
     } 
   } 
// 
//-- 
   function nm_db_inicio($str_where_param = '') 
   {   
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela; 
     $rs = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela);
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if ($rs->fields[0] == 0) 
     { 
         $this->nmgp_opcao = "novo"; 
         $this->nm_flag_saida_novo = "S"; 
         $rs->Close(); 
         if ($this->aba_iframe)
         {
             $this->nmgp_botoes['exit'] = 'off';
         }
         return;
     }
     $str_where_filter = ('' != $str_where_param) ? ' where ' . $str_where_param : '';
     if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (!isset($rs->fields[0]) || $rs->EOF) 
     { 
         if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter']))
         { 
             $rs->Close();  
             return ; 
         } 
         $this->nm_flag_saida_novo = "S"; 
         $this->nmgp_opcao = "novo";  
         $rs->Close();  
         if ($this->aba_iframe)
         {
             $this->nmgp_botoes['exit'] = 'off';
         }
         return ; 
     } 
     $this->id_customer = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
     $rs->Close();  
     $this->nmgp_opcao = "igual";  
     return ;  
   } 
// 
//-- 
   function nm_db_final($str_where_param = '') 
   { 
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' where ' . $str_where_param : '';
     if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(id_customer) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (!isset($rs->fields[0]) || $rs->EOF) 
     { 
         $this->nm_flag_saida_novo = "S"; 
         $this->nmgp_opcao = "novo";  
         $rs->Close();  
         if ($this->aba_iframe)
         {
             $this->nmgp_botoes['exit'] = 'off';
         }
         return ; 
     } 
     $this->id_customer = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
     $rs->Close();  
     $this->nmgp_opcao = "igual";  
     return ;  
   } 
   function NM_gera_nav_page() 
   {
       $this->SC_nav_page = "";
       $Arr_result        = array();
       $Ind_result        = 0;
       $Reg_Page   = 1;
       $Max_link   = 5;
       $Mid_link   = ceil($Max_link / 2);
       $Corr_link  = (($Max_link % 2) == 0) ? 0 : 1;
       $rec_tot    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total'] + 1;
       $rec_fim    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] + 1;
       $rec_fim    = ($rec_fim > $rec_tot) ? $rec_tot : $rec_fim;
       if ($rec_tot == 0)
       {
           return;
       }
       $Qtd_Pages  = ceil($rec_tot / $Reg_Page);
       $Page_Atu   = ceil($rec_fim / $Reg_Page);
       $Link_ini   = 1;
       if ($Page_Atu > $Max_link)
       {
           $Link_ini = $Page_Atu - $Mid_link + $Corr_link;
       }
       elseif ($Page_Atu > $Mid_link)
       {
           $Link_ini = $Page_Atu - $Mid_link + $Corr_link;
       }
       if (($Qtd_Pages - $Link_ini) < $Max_link)
       {
           $Link_ini = ($Qtd_Pages - $Max_link) + 1;
       }
       if ($Link_ini < 1)
       {
           $Link_ini = 1;
       }
       for ($x = 0; $x < $Max_link && $Link_ini <= $Qtd_Pages; $x++)
       {
           $rec = (($Link_ini - 1) * $Reg_Page) + 1;
           if ($Link_ini == $Page_Atu)
           {
               $Arr_result[$Ind_result] = '<span class="scFormToolbarNavOpen" style="vertical-align: middle;">' . $Link_ini . '</span>';
           }
           else
           {
               $Arr_result[$Ind_result] = '<a class="scFormToolbarNav" style="vertical-align: middle;" href="javascript: nm_navpage(' . $rec . ')">' . $Link_ini . '</a>';
           }
           $Link_ini++;
           $Ind_result++;
           if (!isset($this->Ini->Str_toolbarnav_separator))
           {
               $this->Ini->Str_toolbarnav_separator = "";
           }
           if (($x + 1) < $Max_link && $Link_ini <= $Qtd_Pages && '' != $this->Ini->Str_toolbarnav_separator && @is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator))
           {
               $Arr_result[$Ind_result] = '<img src="' . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator . '" align="absmiddle" style="vertical-align: middle;">';
               $Ind_result++;
           }
       }
       if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
       {
           krsort($Arr_result);
       }
       foreach ($Arr_result as $Ind_result => $Lin_result)
       {
           $this->SC_nav_page .= $Lin_result;
       }
   }
        function initializeRecordState() {
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//
 function nm_gera_html()
 {
    global
           $nm_url_saida, $nmgp_url_saida, $nm_saida_global, $nm_apl_dependente, $glo_subst, $sc_check_excl, $sc_check_incl, $nmgp_num_form, $NM_run_iframe;
     if ($this->Embutida_proc)
     {
         return;
     }
     if ($this->nmgp_form_show == 'off')
     {
         exit;
     }
      if (isset($NM_run_iframe) && $NM_run_iframe == 1)
      {
          $this->nmgp_botoes['exit'] = "off";
      }
     $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opc_ant'] = $this->nmgp_opcao;
     }
     else
     {
         $this->nmgp_opcao = $this->nmgp_opc_ant;
     }
     if (!empty($this->Campos_Mens_erro)) 
     {
         $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
         $this->Campos_Mens_erro = "";
     }
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_tb_customers_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("form_tb_customers_form0.php");
        $this->hideFormPages();
 }

        function initFormPages() {
        } // initFormPages

        function hideFormPages() {
        } // hideFormPages

    function form_format_readonly($field, $value)
    {
        $result = $value;

        $this->form_highlight_search($result, $field, $value);

        return $result;
    }

    function form_highlight_search(&$result, $field, $value)
    {
        if ($this->proc_fast_search) {
            $this->form_highlight_search_quicksearch($result, $field, $value);
        }
    }

    function form_highlight_search_quicksearch(&$result, $field, $value)
    {
        $searchOk = false;
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("id_customer", "customer_name", "customer_gender", "customer_birthday", "customer_num_doc", "doctype", "id_country", "customer_address", "customer_phone1", "customer_phone2"))) {
            $searchOk = true;
        }
        elseif ($field == $this->nmgp_fast_search && in_array($field, array("id_customer", "customer_name", "customer_gender", "customer_birthday", "customer_num_doc", "doctype", "id_country", "customer_address", "customer_phone1", "customer_phone2"))) {
            $searchOk = true;
        }

        if (!$searchOk || '' == $this->nmgp_arg_fast_search) {
            return;
        }

        $htmlIni = '<div class="highlight" style="background-color: #fafaca; display: inline-block">';
        $htmlFim = '</div>';

        if ('qp' == $this->nmgp_cond_fast_search) {
            $keywords = preg_quote($this->nmgp_arg_fast_search, '/');
            $result = preg_replace('/'. $keywords .'/i', $htmlIni . '$0' . $htmlFim, $result);
        } elseif ('eq' == $this->nmgp_cond_fast_search) {
            if (strcasecmp($this->nmgp_arg_fast_search, $value) == 0) {
                $result = $htmlIni. $result .$htmlFim;
            }
        }
    }


    function form_encode_input($string)
    {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input

   function jqueryCalendarDtFormat($sFormat, $sSep)
   {
       $sFormat = chunk_split(str_replace('yyyy', 'yy', $sFormat), 2, $sSep);

       if ($sSep == substr($sFormat, -1))
       {
           $sFormat = substr($sFormat, 0, -1);
       }

       return $sFormat;
   } // jqueryCalendarDtFormat

   function jqueryCalendarTimeStart($sFormat)
   {
       $aDateParts = explode(';', $sFormat);

       if (2 == sizeof($aDateParts))
       {
           $sTime = $aDateParts[1];
       }
       else
       {
           $sTime = 'hh:mm:ss';
       }

       return str_replace(array('h', 'm', 'i', 's'), array('0', '0', '0', '0'), $sTime);
   } // jqueryCalendarTimeStart

   function jqueryCalendarWeekInit($sDay)
   {
       switch ($sDay) {
           case 'MO': return 1; break;
           case 'TU': return 2; break;
           case 'WE': return 3; break;
           case 'TH': return 4; break;
           case 'FR': return 5; break;
           case 'SA': return 6; break;
           default  : return 7; break;
       }
   } // jqueryCalendarWeekInit

   function jqueryIconFile($sModule)
   {
       $sImage = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && 'image' == $this->arr_buttons['bcalendario']['type'] && 'only_fontawesomeicon' != $this->arr_buttons['bcalendario']['display'])
           {
               $sImage = $this->arr_buttons['bcalendario']['image'];
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && 'image' == $this->arr_buttons['bcalculadora']['type'] && 'only_fontawesomeicon' != $this->arr_buttons['bcalculadora']['display'])
           {
               $sImage = $this->arr_buttons['bcalculadora']['image'];
           }
       }

       return '' == $sImage ? '' : $this->Ini->path_icones . '/' . $sImage;
   } // jqueryIconFile

   function jqueryFAFile($sModule)
   {
       $sFA = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && ('image' == $this->arr_buttons['bcalendario']['type'] || 'button' == $this->arr_buttons['bcalendario']['type']) && 'only_fontawesomeicon' == $this->arr_buttons['bcalendario']['display'])
           {
               $sFA = $this->arr_buttons['bcalendario']['fontawesomeicon'];
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && ('image' == $this->arr_buttons['bcalculadora']['type'] || 'button' == $this->arr_buttons['bcalculadora']['type']) && 'only_fontawesomeicon' == $this->arr_buttons['bcalculadora']['display'])
           {
               $sFA = $this->arr_buttons['bcalculadora']['fontawesomeicon'];
           }
       }

       return '' == $sFA ? '' : "<span class='scButton_fontawesome " . $sFA . "'></span>";
   } // jqueryFAFile

   function jqueryButtonText($sModule)
   {
       $sClass = '';
       $sText  = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && ('image' == $this->arr_buttons['bcalendario']['type'] || 'button' == $this->arr_buttons['bcalendario']['type']))
           {
               if ('only_text' == $this->arr_buttons['bcalendario']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   $sText  = $this->arr_buttons['bcalendario']['value'];
               }
               elseif ('text_fontawesomeicon' == $this->arr_buttons['bcalendario']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   if ('text_right' == $this->arr_buttons['bcalendario']['display_position'])
                   {
                       $sText = "<i class='icon_fa " . $this->arr_buttons['bcalendario']['fontawesomeicon'] . "'></i> " . $this->arr_buttons['bcalendario']['value'];
                   }
                   else
                   {
                       $sText = $this->arr_buttons['bcalendario']['value'] . " <i class='icon_fa " . $this->arr_buttons['bcalendario']['fontawesomeicon'] . "'></i>";
                   }
               }
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && ('image' == $this->arr_buttons['bcalculadora']['type'] || 'button' == $this->arr_buttons['bcalculadora']['type']))
           {
               if ('only_text' == $this->arr_buttons['bcalculadora']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   $sText  = $this->arr_buttons['bcalculadora']['value'];
               }
               elseif ('text_fontawesomeicon' == $this->arr_buttons['bcalculadora']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   if ('text_right' == $this->arr_buttons['bcalendario']['display_position'])
                   {
                       $sText = "<i class='icon_fa " . $this->arr_buttons['bcalculadora']['fontawesomeicon'] . "'></i> " . $this->arr_buttons['bcalculadora']['value'];
                   }
                   else
                   {
                       $sText = $this->arr_buttons['bcalculadora']['value'] . " <i class='icon_fa " . $this->arr_buttons['bcalculadora']['fontawesomeicon'] . "'></i> ";
                   }
               }
           }
       }

       return '' == $sText ? array('', '') : array($sText, $sClass);
   } // jqueryButtonText


    function scCsrfGetToken()
    {
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['csrf_token'];
    }

    function scCsrfGenerateToken()
    {
        $aSources = array(
            'abcdefghijklmnopqrstuvwxyz',
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            '1234567890',
            '!@$*()-_[]{},.;:'
        );

        $sRandom = '';

        $aSourcesSizes = array();
        $iSourceSize   = sizeof($aSources) - 1;
        for ($i = 0; $i <= $iSourceSize; $i++)
        {
            $aSourcesSizes[$i] = strlen($aSources[$i]) - 1;
        }

        for ($i = 0; $i < 64; $i++)
        {
            $iSource = $this->scCsrfRandom(0, $iSourceSize);
            $sRandom .= substr($aSources[$iSource], $this->scCsrfRandom(0, $aSourcesSizes[$iSource]), 1);
        }

        return $sRandom;
    }

    function scCsrfRandom($iMin, $iMax)
    {
        return mt_rand($iMin, $iMax);
    }

        function addUrlParam($url, $param, $value) {
                $urlParts  = explode('?', $url);
                $urlParams = isset($urlParts[1]) ? explode('&', $urlParts[1]) : array();
                $objParams = array();
                foreach ($urlParams as $paramInfo) {
                        $paramParts = explode('=', $paramInfo);
                        $objParams[ $paramParts[0] ] = isset($paramParts[1]) ? $paramParts[1] : '';
                }
                $objParams[$param] = $value;
                $urlParams = array();
                foreach ($objParams as $paramName => $paramValue) {
                        $urlParams[] = $paramName . '=' . $paramValue;
                }
                return $urlParts[0] . '?' . implode('&', $urlParams);
        }
 function allowedCharsCharset($charlist)
 {
     if ($_SESSION['scriptcase']['charset'] != 'UTF-8')
     {
         $charlist = NM_conv_charset($charlist, $_SESSION['scriptcase']['charset'], 'UTF-8');
     }
     return str_replace("'", "\'", $charlist);
 }

function sc_file_size($file, $format = false)
{
    if ('' == $file) {
        return '';
    }
    if (!@is_file($file)) {
        return '';
    }
    $fileSize = @filesize($file);
    if ($format) {
        $suffix = '';
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' KB';
        }
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' MB';
        }
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' GB';
        }
        $fileSize = $fileSize . $suffix;
    }
    return $fileSize;
}


 function new_date_format($type, $field)
 {
     $new_date_format_out = '';

     if ('DT' == $type)
     {
         $date_format  = $this->field_config[$field]['date_format'];
         $date_sep     = $this->field_config[$field]['date_sep'];
         $date_display = $this->field_config[$field]['date_display'];
         $time_format  = '';
         $time_sep     = '';
         $time_display = '';
     }
     elseif ('DH' == $type)
     {
         $date_format  = false !== strpos($this->field_config[$field]['date_format'] , ';') ? substr($this->field_config[$field]['date_format'] , 0, strpos($this->field_config[$field]['date_format'] , ';')) : $this->field_config[$field]['date_format'];
         $date_sep     = $this->field_config[$field]['date_sep'];
         $date_display = false !== strpos($this->field_config[$field]['date_display'], ';') ? substr($this->field_config[$field]['date_display'], 0, strpos($this->field_config[$field]['date_display'], ';')) : $this->field_config[$field]['date_display'];
         $time_format  = false !== strpos($this->field_config[$field]['date_format'] , ';') ? substr($this->field_config[$field]['date_format'] , strpos($this->field_config[$field]['date_format'] , ';') + 1) : '';
         $time_sep     = $this->field_config[$field]['time_sep'];
         $time_display = false !== strpos($this->field_config[$field]['date_display'], ';') ? substr($this->field_config[$field]['date_display'], strpos($this->field_config[$field]['date_display'], ';') + 1) : '';
     }
     elseif ('HH' == $type)
     {
         $date_format  = '';
         $date_sep     = '';
         $date_display = '';
         $time_format  = $this->field_config[$field]['date_format'];
         $time_sep     = $this->field_config[$field]['time_sep'];
         $time_display = $this->field_config[$field]['date_display'];
     }

     if ('DT' == $type || 'DH' == $type)
     {
         $date_array = array();
         $date_index = 0;
         $date_ult   = '';
         for ($i = 0; $i < strlen($date_format); $i++)
         {
             $char = strtolower(substr($date_format, $i, 1));
             if (in_array($char, array('d', 'm', 'y', 'a')))
             {
                 if ('a' == $char)
                 {
                     $char = 'y';
                 }
                 if ($char == $date_ult)
                 {
                     $date_array[$date_index] .= $char;
                 }
                 else
                 {
                     if ('' != $date_ult)
                     {
                         $date_index++;
                     }
                     $date_array[$date_index] = $char;
                 }
             }
             $date_ult = $char;
         }

         $disp_array = array();
         $date_index = 0;
         $date_ult   = '';
         for ($i = 0; $i < strlen($date_display); $i++)
         {
             $char = strtolower(substr($date_display, $i, 1));
             if (in_array($char, array('d', 'm', 'y', 'a')))
             {
                 if ('a' == $char)
                 {
                     $char = 'y';
                 }
                 if ($char == $date_ult)
                 {
                     $disp_array[$date_index] .= $char;
                 }
                 else
                 {
                     if ('' != $date_ult)
                     {
                         $date_index++;
                     }
                     $disp_array[$date_index] = $char;
                 }
             }
             $date_ult = $char;
         }

         $date_final = array();
         foreach ($date_array as $date_part)
         {
             if (in_array($date_part, $disp_array))
             {
                 $date_final[] = $date_part;
             }
         }

         $date_format = implode($date_sep, $date_final);
     }
     if ('HH' == $type || 'DH' == $type)
     {
         $time_array = array();
         $time_index = 0;
         $time_ult   = '';
         for ($i = 0; $i < strlen($time_format); $i++)
         {
             $char = strtolower(substr($time_format, $i, 1));
             if (in_array($char, array('h', 'i', 's')))
             {
                 if ($char == $time_ult)
                 {
                     $time_array[$time_index] .= $char;
                 }
                 else
                 {
                     if ('' != $time_ult)
                     {
                         $time_index++;
                     }
                     $time_array[$time_index] = $char;
                 }
             }
             $time_ult = $char;
         }

         $disp_array = array();
         $time_index = 0;
         $time_ult   = '';
         for ($i = 0; $i < strlen($time_display); $i++)
         {
             $char = strtolower(substr($time_display, $i, 1));
             if (in_array($char, array('h', 'i', 's')))
             {
                 if ($char == $time_ult)
                 {
                     $disp_array[$time_index] .= $char;
                 }
                 else
                 {
                     if ('' != $time_ult)
                     {
                         $time_index++;
                     }
                     $disp_array[$time_index] = $char;
                 }
             }
             $time_ult = $char;
         }

         $time_final = array();
         foreach ($time_array as $time_part)
         {
             if (in_array($time_part, $disp_array))
             {
                 $time_final[] = $time_part;
             }
         }

         $time_format = implode($time_sep, $time_final);
     }

     if ('DT' == $type)
     {
         $old_date_format = $date_format;
     }
     elseif ('DH' == $type)
     {
         $old_date_format = $date_format . ';' . $time_format;
     }
     elseif ('HH' == $type)
     {
         $old_date_format = $time_format;
     }

     for ($i = 0; $i < strlen($old_date_format); $i++)
     {
         $char = substr($old_date_format, $i, 1);
         if ('/' == $char)
         {
             $new_date_format_out .= $date_sep;
         }
         elseif (':' == $char)
         {
             $new_date_format_out .= $time_sep;
         }
         else
         {
             $new_date_format_out .= $char;
         }
     }

     $this->field_config[$field]['date_format'] = $new_date_format_out;
     if ('DH' == $type)
     {
         $new_date_format_out                                  = explode(';', $new_date_format_out);
         $this->field_config[$field]['date_format_js']        = $new_date_format_out[0];
         $this->field_config[$field . '_hora']['date_format'] = $new_date_format_out[1];
         $this->field_config[$field . '_hora']['time_sep']    = $this->field_config[$field]['time_sep'];
     }
 } // new_date_format

   function Form_lookup_customer_gender()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Male?#?M?#?S?@?";
       $nmgp_def_dados .= "Female?#?F?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_id_country()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Afghanistan?#?AF?#??@?";
       $nmgp_def_dados .= "Albania?#?AL?#??@?";
       $nmgp_def_dados .= "Algeria?#?DZ?#??@?";
       $nmgp_def_dados .= "American Samoa?#?AS?#??@?";
       $nmgp_def_dados .= "Andorra?#?AD?#??@?";
       $nmgp_def_dados .= "Angola?#?AO?#??@?";
       $nmgp_def_dados .= "Anguilla?#?AI?#??@?";
       $nmgp_def_dados .= "Antarctica?#?AQ?#??@?";
       $nmgp_def_dados .= "Antigua and Barbuda?#?AG?#??@?";
       $nmgp_def_dados .= "Argentina?#?AR?#??@?";
       $nmgp_def_dados .= "Armenia?#?AM?#??@?";
       $nmgp_def_dados .= "Aruba?#?AW?#??@?";
       $nmgp_def_dados .= "Australia?#?AU?#??@?";
       $nmgp_def_dados .= "Austria?#?AT?#??@?";
       $nmgp_def_dados .= "Azerbaijan?#?AZ?#??@?";
       $nmgp_def_dados .= "Bahamas?#?BS?#??@?";
       $nmgp_def_dados .= "Bahrain?#?BH?#??@?";
       $nmgp_def_dados .= "Bangladesh?#?BD?#??@?";
       $nmgp_def_dados .= "Barbados?#?BB?#??@?";
       $nmgp_def_dados .= "Belarus?#?BY?#??@?";
       $nmgp_def_dados .= "Belgium?#?BE?#??@?";
       $nmgp_def_dados .= "Belize?#?BZ?#??@?";
       $nmgp_def_dados .= "Benin?#?BJ?#??@?";
       $nmgp_def_dados .= "Bermuda?#?BM?#??@?";
       $nmgp_def_dados .= "Bhutan?#?BT?#??@?";
       $nmgp_def_dados .= "Bolivia?#?BO?#??@?";
       $nmgp_def_dados .= "Bosnia and Herzegovina?#?BA?#??@?";
       $nmgp_def_dados .= "Botswana?#?BW?#??@?";
       $nmgp_def_dados .= "Bouvet Island?#?BV?#??@?";
       $nmgp_def_dados .= "Brasil?#?BR?#?S?@?";
       $nmgp_def_dados .= "British Indian Ocean Territory?#?IO?#??@?";
       $nmgp_def_dados .= "Brunei Darussalam?#?BN?#??@?";
       $nmgp_def_dados .= "Bulgaria?#?BG?#??@?";
       $nmgp_def_dados .= "Burkina Faso?#?BF?#??@?";
       $nmgp_def_dados .= "Burundi?#?BI?#??@?";
       $nmgp_def_dados .= "Cambodia?#?KH?#??@?";
       $nmgp_def_dados .= "Cameroon?#?CM?#??@?";
       $nmgp_def_dados .= "Canada?#?CA?#??@?";
       $nmgp_def_dados .= "Cape Verde?#?CV?#??@?";
       $nmgp_def_dados .= "Cayman Islands?#?KY?#??@?";
       $nmgp_def_dados .= "Central African Republic?#?CF?#??@?";
       $nmgp_def_dados .= "Chad?#?TD?#??@?";
       $nmgp_def_dados .= "Chile?#?CL?#??@?";
       $nmgp_def_dados .= "China?#?CN?#??@?";
       $nmgp_def_dados .= "Christmas Island?#?CX?#??@?";
       $nmgp_def_dados .= "Cocos (Keeling) Islands?#?CC?#??@?";
       $nmgp_def_dados .= "Colombia?#?CO?#??@?";
       $nmgp_def_dados .= "Comoros?#?KM?#??@?";
       $nmgp_def_dados .= "Congo?#?CG?#??@?";
       $nmgp_def_dados .= "Cook Islands?#?CK?#??@?";
       $nmgp_def_dados .= "Costa Rica?#?CR?#??@?";
       $nmgp_def_dados .= "Cote d Ivoire?#?CI?#??@?";
       $nmgp_def_dados .= "Croatia?#?HR?#??@?";
       $nmgp_def_dados .= "Cuba?#?CU?#??@?";
       $nmgp_def_dados .= "Cyprus?#?CY?#??@?";
       $nmgp_def_dados .= "Czech Republic?#?CZ?#??@?";
       $nmgp_def_dados .= "Denmark?#?DK?#??@?";
       $nmgp_def_dados .= "Djibouti?#?DJ?#??@?";
       $nmgp_def_dados .= "Dominica?#?DM?#??@?";
       $nmgp_def_dados .= "Dominican Republic?#?DO?#??@?";
       $nmgp_def_dados .= "East Timor?#?TP?#??@?";
       $nmgp_def_dados .= "Ecuador?#?EC?#??@?";
       $nmgp_def_dados .= "Egypt?#?EG?#??@?";
       $nmgp_def_dados .= "El Salvador?#?SV?#??@?";
       $nmgp_def_dados .= "Equatorial Guinea?#?GQ?#??@?";
       $nmgp_def_dados .= "Eritrea?#?ER?#??@?";
       $nmgp_def_dados .= "Estonia?#?EE?#??@?";
       $nmgp_def_dados .= "Ethiopia?#?ET?#??@?";
       $nmgp_def_dados .= "Falkland Islands (Malvinas)?#?FK?#??@?";
       $nmgp_def_dados .= "Faroe Islands?#?FO?#??@?";
       $nmgp_def_dados .= "Fiji?#?FJ?#??@?";
       $nmgp_def_dados .= "Finland?#?FI?#??@?";
       $nmgp_def_dados .= "France?#?FR?#??@?";
       $nmgp_def_dados .= "France Metropolitan?#?FX?#??@?";
       $nmgp_def_dados .= "French Guiana?#?GF?#??@?";
       $nmgp_def_dados .= "French Polynesia?#?PF?#??@?";
       $nmgp_def_dados .= "French Southern Territories?#?TF?#??@?";
       $nmgp_def_dados .= "Gabon?#?GA?#??@?";
       $nmgp_def_dados .= "Gambia?#?GM?#??@?";
       $nmgp_def_dados .= "Georgia?#?GE?#??@?";
       $nmgp_def_dados .= "Germany?#?DE?#??@?";
       $nmgp_def_dados .= "Ghana?#?GH?#??@?";
       $nmgp_def_dados .= "Gibraltar?#?GI?#??@?";
       $nmgp_def_dados .= "Greece?#?GR?#??@?";
       $nmgp_def_dados .= "Greenland?#?GL?#??@?";
       $nmgp_def_dados .= "Grenada?#?GD?#??@?";
       $nmgp_def_dados .= "Guadeloupe?#?GP?#??@?";
       $nmgp_def_dados .= "Guam?#?GU?#??@?";
       $nmgp_def_dados .= "Guatemala?#?GT?#??@?";
       $nmgp_def_dados .= "Guinea?#?GN?#??@?";
       $nmgp_def_dados .= "Guinea-Bissau?#?GW?#??@?";
       $nmgp_def_dados .= "Guyana?#?GY?#??@?";
       $nmgp_def_dados .= "Haiti?#?HT?#??@?";
       $nmgp_def_dados .= "Heard Island and McDonald Islands?#?HM?#??@?";
       $nmgp_def_dados .= "Honduras?#?HN?#??@?";
       $nmgp_def_dados .= "Hong Kong?#?HK?#??@?";
       $nmgp_def_dados .= "Hungary?#?HU?#??@?";
       $nmgp_def_dados .= "Iceland?#?IS?#??@?";
       $nmgp_def_dados .= "India?#?IN?#??@?";
       $nmgp_def_dados .= "Indonesia?#?ID?#??@?";
       $nmgp_def_dados .= "Iran (Islamic Republic of)?#?IR?#??@?";
       $nmgp_def_dados .= "Iraq?#?IQ?#??@?";
       $nmgp_def_dados .= "Ireland?#?IE?#??@?";
       $nmgp_def_dados .= "Israel?#?IL?#??@?";
       $nmgp_def_dados .= "Italy?#?IT?#??@?";
       $nmgp_def_dados .= "Jamaica?#?JM?#??@?";
       $nmgp_def_dados .= "Japan?#?JP?#??@?";
       $nmgp_def_dados .= "Jordan?#?JO?#??@?";
       $nmgp_def_dados .= "Kazakhstan?#?KZ?#??@?";
       $nmgp_def_dados .= "Kenya?#?KE?#??@?";
       $nmgp_def_dados .= "Kiribati?#?KI?#??@?";
       $nmgp_def_dados .= "Korea Democratic People Republic of?#?KP?#??@?";
       $nmgp_def_dados .= "Korea Republic of?#?KR?#??@?";
       $nmgp_def_dados .= "Kuwait?#?KW?#??@?";
       $nmgp_def_dados .= "Kyrgyzstan?#?KG?#??@?";
       $nmgp_def_dados .= "Lao People Democratic Republic?#?LA?#??@?";
       $nmgp_def_dados .= "Latin America?#?LT?#??@?";
       $nmgp_def_dados .= "Latvia?#?LV?#??@?";
       $nmgp_def_dados .= "Lebanon?#?LB?#??@?";
       $nmgp_def_dados .= "Lesotho?#?LS?#??@?";
       $nmgp_def_dados .= "Liberia?#?LR?#??@?";
       $nmgp_def_dados .= "Libyan Arab Jamahiriya?#?LY?#??@?";
       $nmgp_def_dados .= "Liechtenstein?#?LI?#??@?";
       $nmgp_def_dados .= "Lithuania?#?LX?#??@?";
       $nmgp_def_dados .= "Luxembourg?#?LU?#??@?";
       $nmgp_def_dados .= "Macau?#?MO?#??@?";
       $nmgp_def_dados .= "Macedonia?#?MK?#??@?";
       $nmgp_def_dados .= "Madagascar?#?MG?#??@?";
       $nmgp_def_dados .= "Malawi?#?MW?#??@?";
       $nmgp_def_dados .= "Malaysia?#?MY?#??@?";
       $nmgp_def_dados .= "Maldives?#?MV?#??@?";
       $nmgp_def_dados .= "Mali?#?ML?#??@?";
       $nmgp_def_dados .= "Malta?#?MT?#??@?";
       $nmgp_def_dados .= "Marshall Islands?#?MH?#??@?";
       $nmgp_def_dados .= "Martinique?#?MQ?#??@?";
       $nmgp_def_dados .= "Mauritania?#?MR?#??@?";
       $nmgp_def_dados .= "Mauritius?#?MU?#??@?";
       $nmgp_def_dados .= "Mayotte?#?YT?#??@?";
       $nmgp_def_dados .= "Mexico?#?MX?#??@?";
       $nmgp_def_dados .= "Micronesia (Federated States of)?#?FM?#??@?";
       $nmgp_def_dados .= "Moldova Republic of?#?MD?#??@?";
       $nmgp_def_dados .= "Monaco?#?MC?#??@?";
       $nmgp_def_dados .= "Mongolia?#?MN?#??@?";
       $nmgp_def_dados .= "Montserrat?#?MS?#??@?";
       $nmgp_def_dados .= "Morocco?#?MA?#??@?";
       $nmgp_def_dados .= "Mozambique?#?MZ?#??@?";
       $nmgp_def_dados .= "Myanmar?#?MM?#??@?";
       $nmgp_def_dados .= "Namibia?#?NA?#??@?";
       $nmgp_def_dados .= "Nauru?#?NR?#??@?";
       $nmgp_def_dados .= "Nepal?#?NP?#??@?";
       $nmgp_def_dados .= "Netherlands?#?NL?#??@?";
       $nmgp_def_dados .= "Netherlands Antilles?#?AN?#??@?";
       $nmgp_def_dados .= "New Caledonia?#?NC?#??@?";
       $nmgp_def_dados .= "New Zealand?#?NZ?#??@?";
       $nmgp_def_dados .= "Nicaragua?#?NI?#??@?";
       $nmgp_def_dados .= "Niger?#?NE?#??@?";
       $nmgp_def_dados .= "Nigeria?#?NG?#??@?";
       $nmgp_def_dados .= "Niue?#?NU?#??@?";
       $nmgp_def_dados .= "Norfolk Island?#?NF?#??@?";
       $nmgp_def_dados .= "Northern Mariana Islands?#?MP?#??@?";
       $nmgp_def_dados .= "Norway?#?NO?#??@?";
       $nmgp_def_dados .= "Oman?#?OM?#??@?";
       $nmgp_def_dados .= "Pakistan?#?PK?#??@?";
       $nmgp_def_dados .= "Palau?#?PW?#??@?";
       $nmgp_def_dados .= "Panama?#?PA?#??@?";
       $nmgp_def_dados .= "Papua New Guinea?#?PG?#??@?";
       $nmgp_def_dados .= "Paraguay?#?PY?#??@?";
       $nmgp_def_dados .= "Peru?#?PE?#??@?";
       $nmgp_def_dados .= "Philippines?#?PH?#??@?";
       $nmgp_def_dados .= "Pitcairn?#?PN?#??@?";
       $nmgp_def_dados .= "Poland?#?PL?#??@?";
       $nmgp_def_dados .= "Portugal?#?PT?#??@?";
       $nmgp_def_dados .= "Puerto Rico?#?PR?#??@?";
       $nmgp_def_dados .= "Qatar?#?QA?#??@?";
       $nmgp_def_dados .= "Reunion?#?RE?#??@?";
       $nmgp_def_dados .= "Romania?#?RO?#??@?";
       $nmgp_def_dados .= "Russian Federation?#?RU?#??@?";
       $nmgp_def_dados .= "Rwanda?#?RW?#??@?";
       $nmgp_def_dados .= "Saint Helena?#?SH?#??@?";
       $nmgp_def_dados .= "Saint Kitts and Nevis?#?KN?#??@?";
       $nmgp_def_dados .= "Saint Lucia?#?LC?#??@?";
       $nmgp_def_dados .= "Saint Pierre and Miquelon?#?PM?#??@?";
       $nmgp_def_dados .= "Saint Vincent and the Grenadines?#?VC?#??@?";
       $nmgp_def_dados .= "Samoa?#?WS?#??@?";
       $nmgp_def_dados .= "San Marino?#?SM?#??@?";
       $nmgp_def_dados .= "Sao Tome and Principe?#?ST?#??@?";
       $nmgp_def_dados .= "Saudi Arabia?#?SA?#??@?";
       $nmgp_def_dados .= "Senegal?#?SN?#??@?";
       $nmgp_def_dados .= "Seychelles?#?SC?#??@?";
       $nmgp_def_dados .= "Sierra Leone?#?SL?#??@?";
       $nmgp_def_dados .= "Singapore?#?SG?#??@?";
       $nmgp_def_dados .= "Slovakia?#?SK?#??@?";
       $nmgp_def_dados .= "Slovenia?#?SI?#??@?";
       $nmgp_def_dados .= "Solomon Islands?#?SB?#??@?";
       $nmgp_def_dados .= "Somalia?#?SO?#??@?";
       $nmgp_def_dados .= "South Africa?#?ZA?#??@?";
       $nmgp_def_dados .= "South Georgia and the South Sandwich?#?GS?#??@?";
       $nmgp_def_dados .= "Spain?#?ES?#??@?";
       $nmgp_def_dados .= "Sri Lanka?#?LK?#??@?";
       $nmgp_def_dados .= "Sudan?#?SD?#??@?";
       $nmgp_def_dados .= "Suriname?#?SR?#??@?";
       $nmgp_def_dados .= "Svalbard and Jan Mayen Islands?#?SJ?#??@?";
       $nmgp_def_dados .= "Swaziland?#?SZ?#??@?";
       $nmgp_def_dados .= "Sweden?#?SE?#??@?";
       $nmgp_def_dados .= "Switzerland?#?CH?#??@?";
       $nmgp_def_dados .= "Syrian Arab Republic?#?SY?#??@?";
       $nmgp_def_dados .= "Taiwan Republic of China?#?TW?#??@?";
       $nmgp_def_dados .= "Tajikistan?#?TJ?#??@?";
       $nmgp_def_dados .= "Tanzania United Republic of?#?TZ?#??@?";
       $nmgp_def_dados .= "Thailand?#?TH?#??@?";
       $nmgp_def_dados .= "Togo?#?TG?#??@?";
       $nmgp_def_dados .= "Tokelau?#?TK?#??@?";
       $nmgp_def_dados .= "Tonga?#?TO?#??@?";
       $nmgp_def_dados .= "Trinidad and Tobago?#?TT?#??@?";
       $nmgp_def_dados .= "Tunisia?#?TN?#??@?";
       $nmgp_def_dados .= "Turkey?#?TR?#??@?";
       $nmgp_def_dados .= "Turkmenistan?#?TM?#??@?";
       $nmgp_def_dados .= "Turks and Caicos Islands?#?TC?#??@?";
       $nmgp_def_dados .= "Tuvalu?#?TV?#??@?";
       $nmgp_def_dados .= "Uganda?#?UG?#??@?";
       $nmgp_def_dados .= "Ukraine?#?UA?#??@?";
       $nmgp_def_dados .= "United Arab Emirates?#?AE?#??@?";
       $nmgp_def_dados .= "United Kingdom?#?GB?#??@?";
       $nmgp_def_dados .= "United States?#?US?#??@?";
       $nmgp_def_dados .= "United States Minor Outlying Islands?#?UM?#??@?";
       $nmgp_def_dados .= "Uruguay?#?UY?#??@?";
       $nmgp_def_dados .= "Uzbekistan?#?UZ?#??@?";
       $nmgp_def_dados .= "Vanuatu?#?VU?#??@?";
       $nmgp_def_dados .= "Vatican City State (Holy See)?#?VA?#??@?";
       $nmgp_def_dados .= "Venezuela?#?VE?#??@?";
       $nmgp_def_dados .= "Viet Nam?#?VN?#??@?";
       $nmgp_def_dados .= "Virgin Islands (British)?#?VG?#??@?";
       $nmgp_def_dados .= "Virgin Islands (U.S.)?#?VI?#??@?";
       $nmgp_def_dados .= "Wallis and Futuna Islands?#?WF?#??@?";
       $nmgp_def_dados .= "Western Sahara?#?EH?#??@?";
       $nmgp_def_dados .= "Yemen?#?YE?#??@?";
       $nmgp_def_dados .= "Yugoslavia?#?YU?#??@?";
       $nmgp_def_dados .= "Zaire?#?ZR?#??@?";
       $nmgp_def_dados .= "Zambia?#?ZM?#??@?";
       $nmgp_def_dados .= "Zimbabwe?#?ZW?#??@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = false;
      if (empty($data_search)) 
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_tb_customers_pack_ajax_response();
              exit;
          }
          return;
      }
      $comando = "";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($data_search))
      {
          $data_search = NM_conv_charset($data_search, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
      $sv_data = $data_search;
      foreach ($fields as $field) {
          if ($field == "SC_all_Cmp" || $field == "id_customer") 
          {
              $this->SC_monta_condicao($comando, "id_customer", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "customer_name") 
          {
              $this->SC_monta_condicao($comando, "customer_name", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "customer_gender") 
          {
              $data_lookup = $this->SC_lookup_customer_gender($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "customer_gender", $arg_search, $data_lookup, "VARCHAR", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "customer_birthday") 
          {
              $this->SC_monta_condicao($comando, "customer_birthday", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "customer_num_doc") 
          {
              $this->SC_monta_condicao($comando, "customer_num_doc", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "doctype") 
          {
              $this->SC_monta_condicao($comando, "doctype", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "id_country") 
          {
              $data_lookup = $this->SC_lookup_id_country($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "id_country", $arg_search, $data_lookup, "VARCHAR", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "customer_address") 
          {
              $this->SC_monta_condicao($comando, "customer_address", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "customer_phone1") 
          {
              $this->SC_monta_condicao($comando, "customer_phone1", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "customer_phone2") 
          {
              $this->SC_monta_condicao($comando, "customer_phone2", $arg_search, $data_search, "VARCHAR", false);
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter_form'] . " and (" . $comando . ")";
      }
      else
      {
         $sc_where = " where " . $comando;
      }
      $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_form_tb_customers = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total'] = $qt_geral_reg_form_tb_customers;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_tb_customers_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_tb_customers_pack_ajax_response();
          exit;
      }
   }
   function SC_monta_condicao(&$comando, $nome, $condicao, $campo, $tp_campo="", $tp_unaccent=false)
   {
      $nm_aspas   = "'";
      $nm_aspas1  = "'";
      $nm_numeric = array();
      $Nm_datas   = array();
      $nm_esp_postgres = array();
      $campo_join = strtolower(str_replace(".", "_", $nome));
      $nm_ini_lower = "";
      $nm_fim_lower = "";
      $Nm_accent = $this->Ini->Nm_accent_no;
      if ($tp_unaccent) {
          $Nm_accent = $this->Ini->Nm_accent_yes;
      }
      $nm_numeric[] = "id_customer";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['decimal_db'] == ".")
         {
             $nm_aspas  = "";
             $nm_aspas1 = "";
         }
         if (is_array($campo))
         {
             foreach ($campo as $Ind => $Cmp)
             {
                if (!is_numeric($Cmp))
                {
                    return;
                }
                if ($Cmp == "")
                {
                    $campo[$Ind] = 0;
                }
             }
         }
         else
         {
             if (!is_numeric($campo))
             {
                 return;
             }
             if ($campo == "")
             {
                $campo = 0;
             }
         }
      }
         if (in_array($campo_join, $nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP"))
         {
             $nome      = "CAST ($nome AS TEXT)";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
         if (in_array($campo_join, $nm_esp_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
         {
             $nome      = "CAST ($nome AS TEXT)";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
         if (in_array($campo_join, $nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP"))
         {
             $nome      = "CAST ($nome AS VARCHAR)";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
         if (in_array($campo_join, $nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP"))
         {
             $nome      = "CAST ($nome AS VARCHAR(255))";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
      $Nm_datas["customer_birthday"] = "date";
         if (isset($Nm_datas[$campo_join]))
         {
             for ($x = 0; $x < strlen($campo); $x++)
             {
                 $tst = substr($campo, $x, 1);
                 if (!is_numeric($tst) && ($tst != "-" && $tst != ":" && $tst != " "))
                 {
                     return;
                 }
             }
         }
          if (isset($Nm_datas[$campo_join]))
          {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
             $nm_aspas  = "#";
             $nm_aspas1 = "#";
          }
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['SC_sep_date1'];
              }
          }
      if (isset($Nm_datas[$campo_join]) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP" || strtoupper($condicao) == "DF"))
      {
          if (strtoupper($condicao) == "DF")
          {
              $condicao = "NP";
          }
          if (($Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD')";
          }
          elseif ($Nm_datas[$campo_join] == "time" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $nome = "convert(char(10)," . $nome . ",121)";
          }
          elseif (($Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $nome = "convert(char(19)," . $nome . ",121)";
          }
          elseif (($Nm_datas[$campo_join] == "times" || $Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $nome  = "TO_DATE(TO_CHAR(" . $nome . ", 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "datetime" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $nome = "EXTEND(" . $nome . ", YEAR TO FRACTION)";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $nome = "EXTEND(" . $nome . ", YEAR TO DAY)";
          }
          elseif ($Nm_datas[$campo_join] == "datetime" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD')";
          }
      }
         $comando .= (!empty($comando) ? " or " : "");
         if (is_array($campo))
         {
             $prep = "";
             foreach ($campo as $Ind => $Cmp)
             {
                 $prep .= (!empty($prep)) ? "," : "";
                 $Cmp   = substr($this->Db->qstr($Cmp), 1, -1);
                 $prep .= $nm_ini_lower . $nm_aspas . $Cmp . $nm_aspas1 . $nm_fim_lower;
             }
             $prep .= (empty($prep)) ? $nm_aspas . $nm_aspas1 : "";
             $comando .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $prep . ")";
             return;
         }
         $campo  = substr($this->Db->qstr($campo), 1, -1);
         $cond_tst = strtoupper($condicao);
         if ($cond_tst == "II" || $cond_tst == "QP" || $cond_tst == "NP")
         {
             if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && $this->NM_case_insensitive)
             {
                 $op_like      = " ilike ";
                 $nm_ini_lower = "";
                 $nm_fim_lower = "";
             }
             else
             {
                 $op_like = " like ";
             }
         }
         switch ($cond_tst)
         {
            case "EQ":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "II":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_like . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
            break;
            case "QP":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_like . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
            break;
            case "NP":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . " not" . $op_like . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
            break;
            case "DF":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "GT":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " > " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "GE":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " >= " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "LT":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " < " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "LE":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <= " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
         }
   }
   function SC_lookup_customer_gender($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['M'] = "Male";
       $data_look['F'] = "Female";
       $result = array();
       foreach ($data_look as $chave => $label) 
       {
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_id_country($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['AF'] = "Afghanistan";
       $data_look['AL'] = "Albania";
       $data_look['DZ'] = "Algeria";
       $data_look['AS'] = "American Samoa";
       $data_look['AD'] = "Andorra";
       $data_look['AO'] = "Angola";
       $data_look['AI'] = "Anguilla";
       $data_look['AQ'] = "Antarctica";
       $data_look['AG'] = "Antigua and Barbuda";
       $data_look['AR'] = "Argentina";
       $data_look['AM'] = "Armenia";
       $data_look['AW'] = "Aruba";
       $data_look['AU'] = "Australia";
       $data_look['AT'] = "Austria";
       $data_look['AZ'] = "Azerbaijan";
       $data_look['BS'] = "Bahamas";
       $data_look['BH'] = "Bahrain";
       $data_look['BD'] = "Bangladesh";
       $data_look['BB'] = "Barbados";
       $data_look['BY'] = "Belarus";
       $data_look['BE'] = "Belgium";
       $data_look['BZ'] = "Belize";
       $data_look['BJ'] = "Benin";
       $data_look['BM'] = "Bermuda";
       $data_look['BT'] = "Bhutan";
       $data_look['BO'] = "Bolivia";
       $data_look['BA'] = "Bosnia and Herzegovina";
       $data_look['BW'] = "Botswana";
       $data_look['BV'] = "Bouvet Island";
       $data_look['BR'] = "Brasil";
       $data_look['IO'] = "British Indian Ocean Territory";
       $data_look['BN'] = "Brunei Darussalam";
       $data_look['BG'] = "Bulgaria";
       $data_look['BF'] = "Burkina Faso";
       $data_look['BI'] = "Burundi";
       $data_look['KH'] = "Cambodia";
       $data_look['CM'] = "Cameroon";
       $data_look['CA'] = "Canada";
       $data_look['CV'] = "Cape Verde";
       $data_look['KY'] = "Cayman Islands";
       $data_look['CF'] = "Central African Republic";
       $data_look['TD'] = "Chad";
       $data_look['CL'] = "Chile";
       $data_look['CN'] = "China";
       $data_look['CX'] = "Christmas Island";
       $data_look['CC'] = "Cocos (Keeling) Islands";
       $data_look['CO'] = "Colombia";
       $data_look['KM'] = "Comoros";
       $data_look['CG'] = "Congo";
       $data_look['CK'] = "Cook Islands";
       $data_look['CR'] = "Costa Rica";
       $data_look['CI'] = "Cote d Ivoire";
       $data_look['HR'] = "Croatia";
       $data_look['CU'] = "Cuba";
       $data_look['CY'] = "Cyprus";
       $data_look['CZ'] = "Czech Republic";
       $data_look['DK'] = "Denmark";
       $data_look['DJ'] = "Djibouti";
       $data_look['DM'] = "Dominica";
       $data_look['DO'] = "Dominican Republic";
       $data_look['TP'] = "East Timor";
       $data_look['EC'] = "Ecuador";
       $data_look['EG'] = "Egypt";
       $data_look['SV'] = "El Salvador";
       $data_look['GQ'] = "Equatorial Guinea";
       $data_look['ER'] = "Eritrea";
       $data_look['EE'] = "Estonia";
       $data_look['ET'] = "Ethiopia";
       $data_look['FK'] = "Falkland Islands (Malvinas)";
       $data_look['FO'] = "Faroe Islands";
       $data_look['FJ'] = "Fiji";
       $data_look['FI'] = "Finland";
       $data_look['FR'] = "France";
       $data_look['FX'] = "France Metropolitan";
       $data_look['GF'] = "French Guiana";
       $data_look['PF'] = "French Polynesia";
       $data_look['TF'] = "French Southern Territories";
       $data_look['GA'] = "Gabon";
       $data_look['GM'] = "Gambia";
       $data_look['GE'] = "Georgia";
       $data_look['DE'] = "Germany";
       $data_look['GH'] = "Ghana";
       $data_look['GI'] = "Gibraltar";
       $data_look['GR'] = "Greece";
       $data_look['GL'] = "Greenland";
       $data_look['GD'] = "Grenada";
       $data_look['GP'] = "Guadeloupe";
       $data_look['GU'] = "Guam";
       $data_look['GT'] = "Guatemala";
       $data_look['GN'] = "Guinea";
       $data_look['GW'] = "Guinea-Bissau";
       $data_look['GY'] = "Guyana";
       $data_look['HT'] = "Haiti";
       $data_look['HM'] = "Heard Island and McDonald Islands";
       $data_look['HN'] = "Honduras";
       $data_look['HK'] = "Hong Kong";
       $data_look['HU'] = "Hungary";
       $data_look['IS'] = "Iceland";
       $data_look['IN'] = "India";
       $data_look['ID'] = "Indonesia";
       $data_look['IR'] = "Iran (Islamic Republic of)";
       $data_look['IQ'] = "Iraq";
       $data_look['IE'] = "Ireland";
       $data_look['IL'] = "Israel";
       $data_look['IT'] = "Italy";
       $data_look['JM'] = "Jamaica";
       $data_look['JP'] = "Japan";
       $data_look['JO'] = "Jordan";
       $data_look['KZ'] = "Kazakhstan";
       $data_look['KE'] = "Kenya";
       $data_look['KI'] = "Kiribati";
       $data_look['KP'] = "Korea Democratic People Republic of";
       $data_look['KR'] = "Korea Republic of";
       $data_look['KW'] = "Kuwait";
       $data_look['KG'] = "Kyrgyzstan";
       $data_look['LA'] = "Lao People Democratic Republic";
       $data_look['LT'] = "Latin America";
       $data_look['LV'] = "Latvia";
       $data_look['LB'] = "Lebanon";
       $data_look['LS'] = "Lesotho";
       $data_look['LR'] = "Liberia";
       $data_look['LY'] = "Libyan Arab Jamahiriya";
       $data_look['LI'] = "Liechtenstein";
       $data_look['LX'] = "Lithuania";
       $data_look['LU'] = "Luxembourg";
       $data_look['MO'] = "Macau";
       $data_look['MK'] = "Macedonia";
       $data_look['MG'] = "Madagascar";
       $data_look['MW'] = "Malawi";
       $data_look['MY'] = "Malaysia";
       $data_look['MV'] = "Maldives";
       $data_look['ML'] = "Mali";
       $data_look['MT'] = "Malta";
       $data_look['MH'] = "Marshall Islands";
       $data_look['MQ'] = "Martinique";
       $data_look['MR'] = "Mauritania";
       $data_look['MU'] = "Mauritius";
       $data_look['YT'] = "Mayotte";
       $data_look['MX'] = "Mexico";
       $data_look['FM'] = "Micronesia (Federated States of)";
       $data_look['MD'] = "Moldova Republic of";
       $data_look['MC'] = "Monaco";
       $data_look['MN'] = "Mongolia";
       $data_look['MS'] = "Montserrat";
       $data_look['MA'] = "Morocco";
       $data_look['MZ'] = "Mozambique";
       $data_look['MM'] = "Myanmar";
       $data_look['NA'] = "Namibia";
       $data_look['NR'] = "Nauru";
       $data_look['NP'] = "Nepal";
       $data_look['NL'] = "Netherlands";
       $data_look['AN'] = "Netherlands Antilles";
       $data_look['NC'] = "New Caledonia";
       $data_look['NZ'] = "New Zealand";
       $data_look['NI'] = "Nicaragua";
       $data_look['NE'] = "Niger";
       $data_look['NG'] = "Nigeria";
       $data_look['NU'] = "Niue";
       $data_look['NF'] = "Norfolk Island";
       $data_look['MP'] = "Northern Mariana Islands";
       $data_look['NO'] = "Norway";
       $data_look['OM'] = "Oman";
       $data_look['PK'] = "Pakistan";
       $data_look['PW'] = "Palau";
       $data_look['PA'] = "Panama";
       $data_look['PG'] = "Papua New Guinea";
       $data_look['PY'] = "Paraguay";
       $data_look['PE'] = "Peru";
       $data_look['PH'] = "Philippines";
       $data_look['PN'] = "Pitcairn";
       $data_look['PL'] = "Poland";
       $data_look['PT'] = "Portugal";
       $data_look['PR'] = "Puerto Rico";
       $data_look['QA'] = "Qatar";
       $data_look['RE'] = "Reunion";
       $data_look['RO'] = "Romania";
       $data_look['RU'] = "Russian Federation";
       $data_look['RW'] = "Rwanda";
       $data_look['SH'] = "Saint Helena";
       $data_look['KN'] = "Saint Kitts and Nevis";
       $data_look['LC'] = "Saint Lucia";
       $data_look['PM'] = "Saint Pierre and Miquelon";
       $data_look['VC'] = "Saint Vincent and the Grenadines";
       $data_look['WS'] = "Samoa";
       $data_look['SM'] = "San Marino";
       $data_look['ST'] = "Sao Tome and Principe";
       $data_look['SA'] = "Saudi Arabia";
       $data_look['SN'] = "Senegal";
       $data_look['SC'] = "Seychelles";
       $data_look['SL'] = "Sierra Leone";
       $data_look['SG'] = "Singapore";
       $data_look['SK'] = "Slovakia";
       $data_look['SI'] = "Slovenia";
       $data_look['SB'] = "Solomon Islands";
       $data_look['SO'] = "Somalia";
       $data_look['ZA'] = "South Africa";
       $data_look['GS'] = "South Georgia and the South Sandwich";
       $data_look['ES'] = "Spain";
       $data_look['LK'] = "Sri Lanka";
       $data_look['SD'] = "Sudan";
       $data_look['SR'] = "Suriname";
       $data_look['SJ'] = "Svalbard and Jan Mayen Islands";
       $data_look['SZ'] = "Swaziland";
       $data_look['SE'] = "Sweden";
       $data_look['CH'] = "Switzerland";
       $data_look['SY'] = "Syrian Arab Republic";
       $data_look['TW'] = "Taiwan Republic of China";
       $data_look['TJ'] = "Tajikistan";
       $data_look['TZ'] = "Tanzania United Republic of";
       $data_look['TH'] = "Thailand";
       $data_look['TG'] = "Togo";
       $data_look['TK'] = "Tokelau";
       $data_look['TO'] = "Tonga";
       $data_look['TT'] = "Trinidad and Tobago";
       $data_look['TN'] = "Tunisia";
       $data_look['TR'] = "Turkey";
       $data_look['TM'] = "Turkmenistan";
       $data_look['TC'] = "Turks and Caicos Islands";
       $data_look['TV'] = "Tuvalu";
       $data_look['UG'] = "Uganda";
       $data_look['UA'] = "Ukraine";
       $data_look['AE'] = "United Arab Emirates";
       $data_look['GB'] = "United Kingdom";
       $data_look['US'] = "United States";
       $data_look['UM'] = "United States Minor Outlying Islands";
       $data_look['UY'] = "Uruguay";
       $data_look['UZ'] = "Uzbekistan";
       $data_look['VU'] = "Vanuatu";
       $data_look['VA'] = "Vatican City State (Holy See)";
       $data_look['VE'] = "Venezuela";
       $data_look['VN'] = "Viet Nam";
       $data_look['VG'] = "Virgin Islands (British)";
       $data_look['VI'] = "Virgin Islands (U.S.)";
       $data_look['WF'] = "Wallis and Futuna Islands";
       $data_look['EH'] = "Western Sahara";
       $data_look['YE'] = "Yemen";
       $data_look['YU'] = "Yugoslavia";
       $data_look['ZR'] = "Zaire";
       $data_look['ZM'] = "Zambia";
       $data_look['ZW'] = "Zimbabwe";
       $result = array();
       foreach ($data_look as $chave => $label) 
       {
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
function nmgp_redireciona($tipo=0)
{
   global $nm_apl_dependente;
   if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $_SESSION['scriptcase']['sc_tp_saida'] != "D" && $nm_apl_dependente != 1) 
   {
       $nmgp_saida_form = $_SESSION['scriptcase']['nm_sc_retorno'];
   }
   else
   {
       $nmgp_saida_form = $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page];
   }
   if ($tipo == 2)
   {
       $nmgp_saida_form = "form_tb_customers_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_tb_customers_fim.php";
   }
   $diretorio = explode("/", $nmgp_saida_form);
   $cont = count($diretorio);
   $apl = $diretorio[$cont - 1];
   $apl = str_replace(".php", "", $apl);
   $pos = strpos($apl, "?");
   if ($pos !== false)
   {
       $apl = substr($apl, 0, $pos);
   }
   if ($tipo != 1 && $tipo != 2)
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page][$apl]['where_orig']);
   }
   if ($this->NM_ajax_flag)
   {
       $sTarget = '_self';
       $this->NM_ajax_info['redir']['metodo']              = 'post';
       $this->NM_ajax_info['redir']['action']              = $nmgp_saida_form;
       $this->NM_ajax_info['redir']['target']              = $sTarget;
       $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       if (0 == $tipo)
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida'] = $this->nm_location;
       }
       form_tb_customers_pack_ajax_response();
       exit;
   }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

   <HTML>
   <HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

   if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
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
    <link rel="shortcut icon" href="../_lib/img/grp__NM__img__NM__sc_restaurant.png">
   </HEAD>
   <BODY>
   <FORM name="form_ok" method="POST" action="<?php echo $this->form_encode_input($nmgp_saida_form); ?>" target="_self">
<?php
   if ($tipo == 0)
   {
?>
     <INPUT type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($this->nm_location); ?>"> 
<?php
   }
?>
     <INPUT type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
   </FORM>
   <SCRIPT type="text/javascript">
      bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
      function scLigEditLookupCall()
      {
<?php
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['sc_modal'])
   {
?>
        parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
   }
   elseif ($this->lig_edit_lookup)
   {
?>
        opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
   }
?>
      }
      if (bLigEditLookupCall)
      {
        scLigEditLookupCall();
      }
<?php
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['masterValue']);
?>
}
<?php
    }
}
?>
      document.form_ok.submit();
   </SCRIPT>
   </BODY>
   </HTML>
<?php
  exit;
}
    function getButtonIds($buttonName) {
        switch ($buttonName) {
            case "new":
                return array("sc_b_new_t.sc-unique-btn-1");
                break;
            case "insert":
                return array("sc_b_ins_t.sc-unique-btn-2");
                break;
            case "bcancelar":
                return array("sc_b_sai_t.sc-unique-btn-3");
                break;
            case "update":
                return array("sc_b_upd_t.sc-unique-btn-4");
                break;
            case "delete":
                return array("sc_b_del_t.sc-unique-btn-5");
                break;
            case "help":
                return array("sc_b_hlp_t");
                break;
            case "exit":
                return array("sc_b_sai_t.sc-unique-btn-6", "sc_b_sai_t.sc-unique-btn-7", "sc_b_sai_t.sc-unique-btn-9", "sc_b_sai_t.sc-unique-btn-8", "sc_b_sai_t.sc-unique-btn-10");
                break;
            case "birpara":
                return array("brec_b");
                break;
            case "first":
                return array("sc_b_ini_b.sc-unique-btn-11");
                break;
            case "back":
                return array("sc_b_ret_b.sc-unique-btn-12");
                break;
            case "forward":
                return array("sc_b_avc_b.sc-unique-btn-13");
                break;
            case "last":
                return array("sc_b_fim_b.sc-unique-btn-14");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr><td class="sc-app-header">
 <TABLE width="100%" class="scFormHeader">
    <TR align="center">
     <TD style="padding: 0px">
      <TABLE style="padding: 0px; border-spacing: 0px; border-width: 0px;" width="100%">
       <TR align="center" valign="middle">
        <TD style="text-align: right;" rowspan="1" class="scFormHeaderFont">
          <span style="padding:5px;font-size:22px; font-weight:bold;"><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_tbl_tb_customers'] . ""; } else { echo "" . $this->Ini->Nm_lang['lang_tbl_tb_customers'] . ""; } ?></span>
          
        </TD>
       </TR>
      </TABLE>
     </TD>
    </TR>
   </TABLE>
    </td></tr>
<?php
    }

    function displayAppFooter()
    {
    }

    function displayAppToolbars()
    {
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "R") {
        } else {
            return false;
        }
        return true;
    } // displayAppToolbars

    function displayTopToolbar()
    {
        if (!$this->displayAppToolbars()) {
            return;
        }
    } // displayTopToolbar

    function displayBottomToolbar()
    {
        if (!$this->displayAppToolbars()) {
            return;
        }
    } // displayBottomToolbar

    function getSummaryLine()
    {
        $summaryLine = "[" . $this->Ini->Nm_lang['lang_othr_smry_info_simp'] . "]";
        $summaryLine = str_replace(
            [
                '?final?',
                '?total?',
            ],
            [
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['ordem_ord'] == " desc") {
                $orderColOrient = $nome_img = $this->Ini->Label_sort_desc;
                $orderColRule = $sortRule = 'desc';
            } else {
                $orderColOrient = $nome_img = $this->Ini->Label_sort_asc;
                $orderColRule = $sortRule = 'asc';
            }
        }
        return $sortRule;
    }

    function scGetColumnOrderIcon($fieldName, $sortRule)
    {        if ($this->scIsFieldNumeric($fieldName)) {
            $defaultOffIcon = 'asc' == $this->scGetDefaultFieldOrder($fieldName) ? "fas fa-sort-numeric-down" : "fas fa-sort-numeric-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down-alt sc-form-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down sc-form-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-form-order-icon sc-form-order-icon-unused\"></span>";
            }
        } else {
            $defaultOffIcon = 'asc' == $this->scGetDefaultFieldOrder($fieldName) ? "fas fa-sort-alpha-down" : "fas fa-sort-alpha-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down-alt sc-form-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down sc-form-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-form-order-icon sc-form-order-icon-unused\"></span>";
            }
        }
    }

    function scIsFieldNumeric($fieldName)
    {
        switch ($fieldName) {
            case "id_customer":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "id_customer":
                return 'desc';
            case "customer_birthday":
                return 'desc';
            case "id_country":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }
}
?>
