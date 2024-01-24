<?php
//
class form_customer_ticket_send_message_apl
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
   var $ticketmessageid;
   var $ticketid;
   var $ticketdate;
   var $ticketdate_hora;
   var $ticketcontent;
   var $ticketfile1;
   var $ticketfile1_scfile_name;
   var $ticketfile1_ul_name;
   var $ticketfile1_ul_type;
   var $ticketfile1_limpa;
   var $ticketfile1_salva;
   var $ticketfile2;
   var $ticketfile2_scfile_name;
   var $ticketfile2_ul_name;
   var $ticketfile2_ul_type;
   var $ticketfile2_limpa;
   var $ticketfile2_salva;
   var $ticketfile3;
   var $ticketfile3_scfile_name;
   var $ticketfile3_ul_name;
   var $ticketfile3_ul_type;
   var $ticketfile3_limpa;
   var $ticketfile3_salva;
   var $operatorid;
   var $messagetype;
   var $ticketfilename1;
   var $ticketfilename2;
   var $ticketfilename3;
   var $statusid;
   var $messagenote;
   var $fld_priority;
   var $fld_priority_1;
   var $fld_category;
   var $fld_category_1;
   var $fld_subject;
   var $fld_close_ticket;
   var $fld_close_ticket_1;
   var $nm_data;
   var $nmgp_opcao;
   var $nmgp_opc_ant;
   var $sc_evento;
   var $nmgp_clone;
   var $nmgp_return_img = array();
   var $nmgp_dados_form = array();
   var $nmgp_dados_select = array();
   var $NM_size_docs = array();
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
          if (isset($this->NM_ajax_info['param']['fld_close_ticket']))
          {
              $this->fld_close_ticket = $this->NM_ajax_info['param']['fld_close_ticket'];
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
          if (isset($this->NM_ajax_info['param']['ticketcontent']))
          {
              $this->ticketcontent = $this->NM_ajax_info['param']['ticketcontent'];
          }
          if (isset($this->NM_ajax_info['param']['ticketfile1']))
          {
              $this->ticketfile1 = $this->NM_ajax_info['param']['ticketfile1'];
          }
          if (isset($this->NM_ajax_info['param']['ticketfile1_limpa']))
          {
              $this->ticketfile1_limpa = $this->NM_ajax_info['param']['ticketfile1_limpa'];
          }
          if (isset($this->NM_ajax_info['param']['ticketfile1_ul_name']))
          {
              $this->ticketfile1_ul_name = $this->NM_ajax_info['param']['ticketfile1_ul_name'];
          }
          if (isset($this->NM_ajax_info['param']['ticketfile1_ul_type']))
          {
              $this->ticketfile1_ul_type = $this->NM_ajax_info['param']['ticketfile1_ul_type'];
          }
          if (isset($this->NM_ajax_info['param']['ticketfile2']))
          {
              $this->ticketfile2 = $this->NM_ajax_info['param']['ticketfile2'];
          }
          if (isset($this->NM_ajax_info['param']['ticketfile2_limpa']))
          {
              $this->ticketfile2_limpa = $this->NM_ajax_info['param']['ticketfile2_limpa'];
          }
          if (isset($this->NM_ajax_info['param']['ticketfile2_ul_name']))
          {
              $this->ticketfile2_ul_name = $this->NM_ajax_info['param']['ticketfile2_ul_name'];
          }
          if (isset($this->NM_ajax_info['param']['ticketfile2_ul_type']))
          {
              $this->ticketfile2_ul_type = $this->NM_ajax_info['param']['ticketfile2_ul_type'];
          }
          if (isset($this->NM_ajax_info['param']['ticketfile3']))
          {
              $this->ticketfile3 = $this->NM_ajax_info['param']['ticketfile3'];
          }
          if (isset($this->NM_ajax_info['param']['ticketfile3_limpa']))
          {
              $this->ticketfile3_limpa = $this->NM_ajax_info['param']['ticketfile3_limpa'];
          }
          if (isset($this->NM_ajax_info['param']['ticketfile3_ul_name']))
          {
              $this->ticketfile3_ul_name = $this->NM_ajax_info['param']['ticketfile3_ul_name'];
          }
          if (isset($this->NM_ajax_info['param']['ticketfile3_ul_type']))
          {
              $this->ticketfile3_ul_type = $this->NM_ajax_info['param']['ticketfile3_ul_type'];
          }
          if (isset($this->NM_ajax_info['param']['ticketid']))
          {
              $this->ticketid = $this->NM_ajax_info['param']['ticketid'];
          }
          if (isset($this->NM_ajax_info['param']['ticketmessageid']))
          {
              $this->ticketmessageid = $this->NM_ajax_info['param']['ticketmessageid'];
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
      if (isset($this->v_ticketid) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['v_ticketid'] = $this->v_ticketid;
      }
      if (isset($_POST["v_ticketid"]) && isset($this->v_ticketid)) 
      {
          $_SESSION['v_ticketid'] = $this->v_ticketid;
      }
      if (isset($_GET["v_ticketid"]) && isset($this->v_ticketid)) 
      {
          $_SESSION['v_ticketid'] = $this->v_ticketid;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['embutida_parms']);
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
                 nm_limpa_str_form_customer_ticket_send_message($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->v_ticketid)) 
          {
              $_SESSION['v_ticketid'] = $this->v_ticketid;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['sc_redir_insert'] = $this->sc_redir_insert;
          }
          if (isset($this->v_ticketid)) 
          {
              $_SESSION['v_ticketid'] = $this->v_ticketid;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_customer_ticket_send_message_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("en_us");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['initialize'];
      } 
      else 
      { 
         $this->nm_data = new nm_data("en_us");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['upload_field_info'] = array();

      $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['upload_field_info']['ticketfile1'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'form_customer_ticket_send_message',
          'upload_dir'         => $this->Ini->root . $this->Ini->path_imag_temp . '/',
          'upload_url'         => $this->Ini->path_imag_temp . '/',
          'upload_type'        => 'single',
          'upload_allowed_type'  => '/\.(pdf|jpg|png|jpeg)$/i',
          'upload_max_size'  => null,
          'upload_file_height' => '',
          'upload_file_width'  => '',
          'upload_file_aspect' => '',
          'upload_file_type'   => 'A',
      );

      $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['upload_field_info']['ticketfile2'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'form_customer_ticket_send_message',
          'upload_dir'         => $this->Ini->root . $this->Ini->path_imag_temp . '/',
          'upload_url'         => $this->Ini->path_imag_temp . '/',
          'upload_type'        => 'single',
          'upload_allowed_type'  => '/\.(pdf|jpg|png|jpeg)$/i',
          'upload_max_size'  => null,
          'upload_file_height' => '',
          'upload_file_width'  => '',
          'upload_file_aspect' => '',
          'upload_file_type'   => 'A',
      );

      $_SESSION['sc_session'][$script_case_init]['form_customer_ticket_send_message']['upload_field_info']['ticketfile3'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'form_customer_ticket_send_message',
          'upload_dir'         => $this->Ini->root . $this->Ini->path_imag_temp . '/',
          'upload_url'         => $this->Ini->path_imag_temp . '/',
          'upload_type'        => 'single',
          'upload_allowed_type'  => '/\.(pdf|jpg|png|jpeg)$/i',
          'upload_max_size'  => null,
          'upload_file_height' => '',
          'upload_file_width'  => '',
          'upload_file_aspect' => '',
          'upload_file_type'   => 'A',
      );

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_customer_ticket_send_message']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_customer_ticket_send_message'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_customer_ticket_send_message']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_customer_ticket_send_message']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_customer_ticket_send_message') . "/form_customer_ticket_send_message.php";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_customer_ticket_send_message']['label'] = "" . $this->Ini->Nm_lang['lang_header_open_ticket'] . "";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_customer_ticket_send_message")
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
      $this->nm_new_label['ticketcontent'] = '' . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketcontent'] . '';
      $this->nm_new_label['ticketfile1'] = '' . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketfile1'] . '';
      $this->nm_new_label['ticketfile2'] = '' . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketfile2'] . '';
      $this->nm_new_label['ticketfile3'] = '' . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketfile3'] . '';
      $this->nm_new_label['fld_close_ticket'] = '' . $this->Ini->Nm_lang['lang_button_close'] . '';

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



      $_SESSION['scriptcase']['error_icon']['form_customer_ticket_send_message']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_customer_ticket_send_message'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "form_customer_ticket_send_message.php"; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      if (isset($this->NM_ajax_info['param']['ticketfile1_ul_name']) && '' != $this->NM_ajax_info['param']['ticketfile1_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_field_ul_name'][$this->ticketfile1_ul_name]))
          {
              $this->NM_ajax_info['param']['ticketfile1_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_field_ul_name'][$this->ticketfile1_ul_name];
          }
          $this->ticketfile1 = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['ticketfile1_ul_name'];
          $this->ticketfile1_scfile_name = substr($this->NM_ajax_info['param']['ticketfile1_ul_name'], 12);
          $this->ticketfile1_scfile_type = $this->NM_ajax_info['param']['ticketfile1_ul_type'];
          $this->ticketfile1_ul_name = $this->NM_ajax_info['param']['ticketfile1_ul_name'];
          $this->ticketfile1_ul_type = $this->NM_ajax_info['param']['ticketfile1_ul_type'];
      }
      elseif (isset($this->ticketfile1_ul_name) && '' != $this->ticketfile1_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_field_ul_name'][$this->ticketfile1_ul_name]))
          {
              $this->ticketfile1_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_field_ul_name'][$this->ticketfile1_ul_name];
          }
          $this->ticketfile1 = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->ticketfile1_ul_name;
          $this->ticketfile1_scfile_name = substr($this->ticketfile1_ul_name, 12);
          $this->ticketfile1_scfile_type = $this->ticketfile1_ul_type;
      }
      if (isset($this->NM_ajax_info['param']['ticketfile2_ul_name']) && '' != $this->NM_ajax_info['param']['ticketfile2_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_field_ul_name'][$this->ticketfile2_ul_name]))
          {
              $this->NM_ajax_info['param']['ticketfile2_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_field_ul_name'][$this->ticketfile2_ul_name];
          }
          $this->ticketfile2 = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['ticketfile2_ul_name'];
          $this->ticketfile2_scfile_name = substr($this->NM_ajax_info['param']['ticketfile2_ul_name'], 12);
          $this->ticketfile2_scfile_type = $this->NM_ajax_info['param']['ticketfile2_ul_type'];
          $this->ticketfile2_ul_name = $this->NM_ajax_info['param']['ticketfile2_ul_name'];
          $this->ticketfile2_ul_type = $this->NM_ajax_info['param']['ticketfile2_ul_type'];
      }
      elseif (isset($this->ticketfile2_ul_name) && '' != $this->ticketfile2_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_field_ul_name'][$this->ticketfile2_ul_name]))
          {
              $this->ticketfile2_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_field_ul_name'][$this->ticketfile2_ul_name];
          }
          $this->ticketfile2 = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->ticketfile2_ul_name;
          $this->ticketfile2_scfile_name = substr($this->ticketfile2_ul_name, 12);
          $this->ticketfile2_scfile_type = $this->ticketfile2_ul_type;
      }
      if (isset($this->NM_ajax_info['param']['ticketfile3_ul_name']) && '' != $this->NM_ajax_info['param']['ticketfile3_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_field_ul_name'][$this->ticketfile3_ul_name]))
          {
              $this->NM_ajax_info['param']['ticketfile3_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_field_ul_name'][$this->ticketfile3_ul_name];
          }
          $this->ticketfile3 = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['ticketfile3_ul_name'];
          $this->ticketfile3_scfile_name = substr($this->NM_ajax_info['param']['ticketfile3_ul_name'], 12);
          $this->ticketfile3_scfile_type = $this->NM_ajax_info['param']['ticketfile3_ul_type'];
          $this->ticketfile3_ul_name = $this->NM_ajax_info['param']['ticketfile3_ul_name'];
          $this->ticketfile3_ul_type = $this->NM_ajax_info['param']['ticketfile3_ul_type'];
      }
      elseif (isset($this->ticketfile3_ul_name) && '' != $this->ticketfile3_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_field_ul_name'][$this->ticketfile3_ul_name]))
          {
              $this->ticketfile3_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_field_ul_name'][$this->ticketfile3_ul_name];
          }
          $this->ticketfile3 = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->ticketfile3_ul_name;
          $this->ticketfile3_scfile_name = substr($this->ticketfile3_ul_name, 12);
          $this->ticketfile3_scfile_type = $this->ticketfile3_ul_type;
      }

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['new'] = "on";
      $this->nmgp_botoes['insert'] = "on";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['update'] = "off";
      $this->nmgp_botoes['delete'] = "off";
      $this->nmgp_botoes['first'] = "off";
      $this->nmgp_botoes['back'] = "off";
      $this->nmgp_botoes['forward'] = "off";
      $this->nmgp_botoes['last'] = "off";
      $this->nmgp_botoes['summary'] = "off";
      $this->nmgp_botoes['navpage'] = "off";
      $this->nmgp_botoes['goto'] = "off";
      $this->nmgp_botoes['qtline'] = "off";
      $this->nmgp_botoes['reload'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_orig'] = " where (ticketID = " . $_SESSION['v_ticketid'] . ")";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_pesq'] = " where (ticketID = " . $_SESSION['v_ticketid'] . ")";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_customer_ticket_send_message']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_customer_ticket_send_message'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_customer_ticket_send_message'];

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

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dados_form'];
          if (!isset($this->ticketmessageid)){$this->ticketmessageid = $this->nmgp_dados_form['ticketmessageid'];} 
          if (!isset($this->ticketid)){$this->ticketid = $this->nmgp_dados_form['ticketid'];} 
          if (!isset($this->ticketdate)){$this->ticketdate = $this->nmgp_dados_form['ticketdate'];} 
          if (!isset($this->operatorid)){$this->operatorid = $this->nmgp_dados_form['operatorid'];} 
          if (!isset($this->messagetype)){$this->messagetype = $this->nmgp_dados_form['messagetype'];} 
          if (!isset($this->ticketfilename1)){$this->ticketfilename1 = $this->nmgp_dados_form['ticketfilename1'];} 
          if (!isset($this->ticketfilename2)){$this->ticketfilename2 = $this->nmgp_dados_form['ticketfilename2'];} 
          if (!isset($this->ticketfilename3)){$this->ticketfilename3 = $this->nmgp_dados_form['ticketfilename3'];} 
          if (!isset($this->statusid)){$this->statusid = $this->nmgp_dados_form['statusid'];} 
          if (!isset($this->messagenote)){$this->messagenote = $this->nmgp_dados_form['messagenote'];} 
          if (!isset($this->fld_priority)){$this->fld_priority = $this->nmgp_dados_form['fld_priority'];} 
          if (!isset($this->fld_category)){$this->fld_category = $this->nmgp_dados_form['fld_category'];} 
          if (!isset($this->fld_subject)){$this->fld_subject = $this->nmgp_dados_form['fld_subject'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("form_customer_ticket_send_message", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'form_customer_ticket_send_message_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_customer_ticket_send_message_help.txt');
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
          require_once($this->Ini->path_embutida . 'form_customer_ticket_send_message/form_customer_ticket_send_message_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_customer_ticket_send_message_erro.class.php"); 
      }
      $this->Erro      = new form_customer_ticket_send_message_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opcao']))
         { 
             if ($this->ticketmessageid != "" || $this->ticketid != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_customer_ticket_send_message']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = false;
      $this->sc_evento = $this->nmgp_opcao;
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['form_customer_ticket_send_message']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_customer_ticket_send_message']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$orig_img);
            echo $orig_img . '_@@NM@@_';            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            $sc_obj_img = new nm_trata_img($_SERVER['DOCUMENT_ROOT'].$out1_img_cache, true);

            if(!empty($img_width) && !empty($img_height)){
                $sc_obj_img->setWidth($img_width);
                $sc_obj_img->setHeight($img_height);
            }            $sc_obj_img->createImg($_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            echo $out1_img_cache;
               exit;
            }
      if (isset($this->ticketcontent)) { $this->nm_limpa_alfa($this->ticketcontent); }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "form_customer_ticket_send_message.php"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- ticketmessageid
      $this->field_config['ticketmessageid']               = array();
      $this->field_config['ticketmessageid']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['ticketmessageid']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['ticketmessageid']['symbol_dec'] = '';
      $this->field_config['ticketmessageid']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['ticketmessageid']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- ticketid
      $this->field_config['ticketid']               = array();
      $this->field_config['ticketid']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['ticketid']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['ticketid']['symbol_dec'] = '';
      $this->field_config['ticketid']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['ticketid']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- ticketdate
      $this->field_config['ticketdate']                 = array();
      $this->field_config['ticketdate']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['ticketdate']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['ticketdate']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['ticketdate']['date_display'] = "ddmmyyyy;hhiiss";
      $this->new_date_format('DH', 'ticketdate');
      //-- operatorid
      $this->field_config['operatorid']               = array();
      $this->field_config['operatorid']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['operatorid']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['operatorid']['symbol_dec'] = '';
      $this->field_config['operatorid']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['operatorid']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
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
          if ('validate_ticketcontent' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ticketcontent');
          }
          if ('validate_fld_close_ticket' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'fld_close_ticket');
          }
          if ('validate_ticketfile1' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ticketfile1');
          }
          if ('validate_ticketfile2' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ticketfile2');
          }
          if ('validate_ticketfile3' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ticketfile3');
          }
          form_customer_ticket_send_message_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          if (is_array($this->fld_close_ticket))
          {
              $x = 0; 
              $this->fld_close_ticket_1 = $this->fld_close_ticket;
              $this->fld_close_ticket = ""; 
              if ($this->fld_close_ticket_1 != "") 
              { 
                  foreach ($this->fld_close_ticket_1 as $dados_fld_close_ticket_1 ) 
                  { 
                      if ($x != 0)
                      { 
                          $this->fld_close_ticket .= ";";
                      } 
                      $this->fld_close_ticket .= $dados_fld_close_ticket_1;
                      $x++ ; 
                  } 
              } 
          } 
          $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $this->nm_tira_formatacao();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_customer_ticket_send_message_pack_ajax_response();
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
          $_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  form_customer_ticket_send_message_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['sc_redir_atualiz'] == "ok")
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
          form_customer_ticket_send_message_pack_ajax_response();
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
          form_customer_ticket_send_message_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_customer_ticket_send_message.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message'][$path_doc_md5][1] = $Zip_name;
?>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_header_open_ticket'] . "") ?></TITLE>
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
  <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
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
<form name="Fdown" method="get" action="form_customer_ticket_send_message_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_customer_ticket_send_message"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="form_customer_ticket_send_message.php" target="_self" style="display: none"> 
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
           case 'ticketcontent':
               return "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketcontent'] . "";
               break;
           case 'fld_close_ticket':
               return "" . $this->Ini->Nm_lang['lang_button_close'] . "";
               break;
           case 'ticketfile1':
               return "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketfile1'] . "";
               break;
           case 'ticketfile2':
               return "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketfile2'] . "";
               break;
           case 'ticketfile3':
               return "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketfile3'] . "";
               break;
           case 'ticketmessageid':
               return "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketmessageid'] . "";
               break;
           case 'ticketid':
               return "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketid'] . "";
               break;
           case 'ticketdate':
               return "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketdate'] . "";
               break;
           case 'operatorid':
               return "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_operatorid'] . "";
               break;
           case 'messagetype':
               return "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_messagetype'] . "";
               break;
           case 'ticketfilename1':
               return "TicketFileName1";
               break;
           case 'ticketfilename2':
               return "TicketFileName2";
               break;
           case 'ticketfilename3':
               return "TicketFileName3";
               break;
           case 'statusid':
               return "StatusID";
               break;
           case 'messagenote':
               return "MessageNote";
               break;
           case 'fld_priority':
               return "" . $this->Ini->Nm_lang['lang_ticket_fild_ticketpriorityid'] . "";
               break;
           case 'fld_category':
               return "" . $this->Ini->Nm_lang['lang_ticket_fild_categoryid'] . "";
               break;
           case 'fld_subject':
               return "" . $this->Ini->Nm_lang['lang_ticket_fild_subject'] . "";
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
              if (!isset($this->NM_ajax_info['errList']['geral_form_customer_ticket_send_message']) || !is_array($this->NM_ajax_info['errList']['geral_form_customer_ticket_send_message']))
              {
                  $this->NM_ajax_info['errList']['geral_form_customer_ticket_send_message'] = array();
              }
              $this->NM_ajax_info['errList']['geral_form_customer_ticket_send_message'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'ticketcontent' == $filtro)) || (is_array($filtro) && in_array('ticketcontent', $filtro)))
        $this->ValidateField_ticketcontent($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'fld_close_ticket' == $filtro)) || (is_array($filtro) && in_array('fld_close_ticket', $filtro)))
        $this->ValidateField_fld_close_ticket($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'ticketfile1' == $filtro)) || (is_array($filtro) && in_array('ticketfile1', $filtro)))
        $this->ValidateField_ticketfile1($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'ticketfile2' == $filtro)) || (is_array($filtro) && in_array('ticketfile2', $filtro)))
        $this->ValidateField_ticketfile2($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'ticketfile3' == $filtro)) || (is_array($filtro) && in_array('ticketfile3', $filtro)))
        $this->ValidateField_ticketfile3($Campos_Crit, $Campos_Falta, $Campos_Erros);
      $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros);
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

    function ValidateField_ticketcontent(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['ticketcontent'])) {
          return;
      }
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($this->ticketcontent))
      {
          $this->ticketcontent = NM_conv_charset($this->ticketcontent, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
      $this->ticketcontent = str_replace("<p>" . chr(160) . "</p>", "<p></p>", $this->ticketcontent);
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->ticketcontent) != "")  
          { 
          } 
          elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['php_cmp_required']['ticketcontent']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['php_cmp_required']['ticketcontent'] == "on") 
          { 
              $hasError = true;
              $Campos_Falta[] = "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketcontent'] . "" ; 
              if (!isset($Campos_Erros['ticketcontent']))
              {
                  $Campos_Erros['ticketcontent'] = array();
              }
              $Campos_Erros['ticketcontent'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['ticketcontent']) || !is_array($this->NM_ajax_info['errList']['ticketcontent']))
                  {
                      $this->NM_ajax_info['errList']['ticketcontent'] = array();
                  }
                  $this->NM_ajax_info['errList']['ticketcontent'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'ticketcontent';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_ticketcontent

    function ValidateField_fld_close_ticket(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['fld_close_ticket'])) {
       return;
   }
      if ($this->fld_close_ticket == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      else 
      { 
          if (is_array($this->fld_close_ticket))
          {
              $x = 0; 
              $this->fld_close_ticket_1 = array(); 
              foreach ($this->fld_close_ticket as $ind => $dados_fld_close_ticket_1 ) 
              {
                  if ($dados_fld_close_ticket_1 != "") 
                  {
                      $this->fld_close_ticket_1[] = $dados_fld_close_ticket_1;
                  } 
              } 
              $this->fld_close_ticket = ""; 
              foreach ($this->fld_close_ticket_1 as $dados_fld_close_ticket_1 ) 
              { 
                   if ($x != 0)
                   { 
                       $this->fld_close_ticket .= ";";
                   } 
                   $this->fld_close_ticket .= $dados_fld_close_ticket_1;
                   $x++ ; 
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'fld_close_ticket';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_fld_close_ticket

    function ValidateField_ticketfile1(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['ticketfile1'])) {
          return;
      }
        if ($this->nmgp_opcao != "excluir")
        {
            $sTestFile = $this->ticketfile1;
            if ("" != $this->ticketfile1 && "S" != $this->ticketfile1_limpa && !$teste_validade->ArqExtensao($this->ticketfile1, array('pdf', 'jpg', 'png', 'jpeg')))
            {
                $hasError = true;
                $Campos_Crit .= "{lang_ticketmessage_fild_ticketfile1}: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
                if (!isset($Campos_Erros['ticketfile1']))
                {
                    $Campos_Erros['ticketfile1'] = array();
                }
                $Campos_Erros['ticketfile1'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
                if (!isset($this->NM_ajax_info['errList']['ticketfile1']) || !is_array($this->NM_ajax_info['errList']['ticketfile1']))
                {
                    $this->NM_ajax_info['errList']['ticketfile1'] = array();
                }
                $this->NM_ajax_info['errList']['ticketfile1'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
            }
            if (!$hasError && "" != $this->ticketfile1 && "S" != $this->ticketfile1_limpa) {
                if (!function_exists('sc_upload_unprotect_chars')) {
                    include_once 'form_customer_ticket_send_message_doc_name.php';
                }
                $pathParts = pathinfo(sc_upload_unprotect_chars($sTestFile));
                $fileSize = filesize(sc_upload_unprotect_chars($sTestFile));
                $sizeErrorSuffix = '';
                if ('pdf' == strtolower($pathParts['extension']) && 1048576 < $fileSize) {
                    $sizeErrorSuffix = ' (PDF < 1 MB)';
                    $hasError = true;
                }
                if ('jpg' == strtolower($pathParts['extension']) && 1048576 < $fileSize) {
                    $sizeErrorSuffix = ' (JPG < 1 MB)';
                    $hasError = true;
                }
                if ('png' == strtolower($pathParts['extension']) && 1048576 < $fileSize) {
                    $sizeErrorSuffix = ' (PNG < 1 MB)';
                    $hasError = true;
                }
                if ('jpeg' == strtolower($pathParts['extension']) && 1048576 < $fileSize) {
                    $sizeErrorSuffix = ' (JPEG < 1 MB)';
                    $hasError = true;
                }
                if ($hasError) {
                    $Campos_Crit .= "{lang_ticketmessage_fild_ticketfile1}: " . $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                    if (!isset($Campos_Erros['ticketfile1']))
                    {
                        $Campos_Erros['ticketfile1'] = array();
                    }
                    $Campos_Erros['ticketfile1'][] = $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                    if (!isset($this->NM_ajax_info['errList']['ticketfile1']) || !is_array($this->NM_ajax_info['errList']['ticketfile1']))
                    {
                        $this->NM_ajax_info['errList']['ticketfile1'] = array();
                    }
                    $this->NM_ajax_info['errList']['ticketfile1'][] = $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                }
            }
        }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'ticketfile1';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_ticketfile1

    function ValidateField_ticketfile2(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['ticketfile2'])) {
          return;
      }
        if ($this->nmgp_opcao != "excluir")
        {
            $sTestFile = $this->ticketfile2;
            if ("" != $this->ticketfile2 && "S" != $this->ticketfile2_limpa && !$teste_validade->ArqExtensao($this->ticketfile2, array('pdf', 'jpg', 'png', 'jpeg')))
            {
                $hasError = true;
                $Campos_Crit .= "{lang_ticketmessage_fild_ticketfile2}: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
                if (!isset($Campos_Erros['ticketfile2']))
                {
                    $Campos_Erros['ticketfile2'] = array();
                }
                $Campos_Erros['ticketfile2'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
                if (!isset($this->NM_ajax_info['errList']['ticketfile2']) || !is_array($this->NM_ajax_info['errList']['ticketfile2']))
                {
                    $this->NM_ajax_info['errList']['ticketfile2'] = array();
                }
                $this->NM_ajax_info['errList']['ticketfile2'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
            }
            if (!$hasError && "" != $this->ticketfile2 && "S" != $this->ticketfile2_limpa) {
                if (!function_exists('sc_upload_unprotect_chars')) {
                    include_once 'form_customer_ticket_send_message_doc_name.php';
                }
                $pathParts = pathinfo(sc_upload_unprotect_chars($sTestFile));
                $fileSize = filesize(sc_upload_unprotect_chars($sTestFile));
                $sizeErrorSuffix = '';
                if ('pdf' == strtolower($pathParts['extension']) && 1048576 < $fileSize) {
                    $sizeErrorSuffix = ' (PDF < 1 MB)';
                    $hasError = true;
                }
                if ('jpg' == strtolower($pathParts['extension']) && 1048576 < $fileSize) {
                    $sizeErrorSuffix = ' (JPG < 1 MB)';
                    $hasError = true;
                }
                if ('png' == strtolower($pathParts['extension']) && 1048576 < $fileSize) {
                    $sizeErrorSuffix = ' (PNG < 1 MB)';
                    $hasError = true;
                }
                if ('jpeg' == strtolower($pathParts['extension']) && 1048576 < $fileSize) {
                    $sizeErrorSuffix = ' (JPEG < 1 MB)';
                    $hasError = true;
                }
                if ($hasError) {
                    $Campos_Crit .= "{lang_ticketmessage_fild_ticketfile2}: " . $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                    if (!isset($Campos_Erros['ticketfile2']))
                    {
                        $Campos_Erros['ticketfile2'] = array();
                    }
                    $Campos_Erros['ticketfile2'][] = $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                    if (!isset($this->NM_ajax_info['errList']['ticketfile2']) || !is_array($this->NM_ajax_info['errList']['ticketfile2']))
                    {
                        $this->NM_ajax_info['errList']['ticketfile2'] = array();
                    }
                    $this->NM_ajax_info['errList']['ticketfile2'][] = $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                }
            }
        }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'ticketfile2';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_ticketfile2

    function ValidateField_ticketfile3(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['ticketfile3'])) {
          return;
      }
        if ($this->nmgp_opcao != "excluir")
        {
            $sTestFile = $this->ticketfile3;
            if ("" != $this->ticketfile3 && "S" != $this->ticketfile3_limpa && !$teste_validade->ArqExtensao($this->ticketfile3, array('pdf', 'jpg', 'png', 'jpeg')))
            {
                $hasError = true;
                $Campos_Crit .= "{lang_ticketmessage_fild_ticketfile3}: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
                if (!isset($Campos_Erros['ticketfile3']))
                {
                    $Campos_Erros['ticketfile3'] = array();
                }
                $Campos_Erros['ticketfile3'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
                if (!isset($this->NM_ajax_info['errList']['ticketfile3']) || !is_array($this->NM_ajax_info['errList']['ticketfile3']))
                {
                    $this->NM_ajax_info['errList']['ticketfile3'] = array();
                }
                $this->NM_ajax_info['errList']['ticketfile3'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
            }
            if (!$hasError && "" != $this->ticketfile3 && "S" != $this->ticketfile3_limpa) {
                if (!function_exists('sc_upload_unprotect_chars')) {
                    include_once 'form_customer_ticket_send_message_doc_name.php';
                }
                $pathParts = pathinfo(sc_upload_unprotect_chars($sTestFile));
                $fileSize = filesize(sc_upload_unprotect_chars($sTestFile));
                $sizeErrorSuffix = '';
                if ('pdf' == strtolower($pathParts['extension']) && 1048576 < $fileSize) {
                    $sizeErrorSuffix = ' (PDF < 1 MB)';
                    $hasError = true;
                }
                if ('jpg' == strtolower($pathParts['extension']) && 1048576 < $fileSize) {
                    $sizeErrorSuffix = ' (JPG < 1 MB)';
                    $hasError = true;
                }
                if ('png' == strtolower($pathParts['extension']) && 1048576 < $fileSize) {
                    $sizeErrorSuffix = ' (PNG < 1 MB)';
                    $hasError = true;
                }
                if ('jpeg' == strtolower($pathParts['extension']) && 1048576 < $fileSize) {
                    $sizeErrorSuffix = ' (JPEG < 1 MB)';
                    $hasError = true;
                }
                if ($hasError) {
                    $Campos_Crit .= "{lang_ticketmessage_fild_ticketfile3}: " . $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                    if (!isset($Campos_Erros['ticketfile3']))
                    {
                        $Campos_Erros['ticketfile3'] = array();
                    }
                    $Campos_Erros['ticketfile3'][] = $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                    if (!isset($this->NM_ajax_info['errList']['ticketfile3']) || !is_array($this->NM_ajax_info['errList']['ticketfile3']))
                    {
                        $this->NM_ajax_info['errList']['ticketfile3'] = array();
                    }
                    $this->NM_ajax_info['errList']['ticketfile3'][] = $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                }
            }
        }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'ticketfile3';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_ticketfile3
//
//--------------------------------------------------------------------------------------
   function upload_img_doc(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros, $filtro = '') 
   {
     global $nm_browser;
     if (!empty($Campos_Crit) || !empty($Campos_Falta))
     {
          return;
     }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->ticketfile1 == "none") 
          { 
              $this->ticketfile1 = ""; 
          } 
          if ($this->ticketfile1 != "") 
          { 
              if (!function_exists('sc_upload_unprotect_chars'))
              {
                  include_once 'form_customer_ticket_send_message_doc_name.php';
              }
              $this->ticketfile1 = sc_upload_unprotect_chars($this->ticketfile1, true);
              $this->ticketfile1_scfile_name = sc_upload_unprotect_chars($this->ticketfile1_scfile_name, true);
              if (!is_file($this->ticketfile1) && isset($_SESSION['scriptcase']['charset']) && $_SESSION['scriptcase']['charset'] != 'UTF-8') {
                  $mbConvertFileName = mb_convert_encoding($this->ticketfile1, $_SESSION['scriptcase']['charset'], 'UTF-8');
                  $mbConvertScFileName = mb_convert_encoding($this->ticketfile1_scfile_name, $_SESSION['scriptcase']['charset'], 'UTF-8');
                  if (is_file($mbConvertFileName)) {
                      $this->ticketfile1 = $mbConvertFileName;
                      $this->ticketfile1_scfile_name = $mbConvertScFileName;
                  }
              }
              if (is_file($this->ticketfile1))  
              { 
                  $this->NM_size_docs[$this->ticketfile1_scfile_name] = $this->sc_file_size($this->ticketfile1);
                  $this->ticketfilename1 = $this->ticketfile1_scfile_name;
                  $reg_ticketfile1 = file_get_contents($this->ticketfile1); 
                  $this->ticketfile1 = $reg_ticketfile1; 
              } 
              else 
              { 
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketfile1'] . " " . $this->Ini->Nm_lang['lang_errm_upld']; 
                  $this->ticketfile1 = "";
                  if (!isset($Campos_Erros['ticketfile1']))
                  {
                      $Campos_Erros['ticketfile1'] = array();
                  }
                  $Campos_Erros['ticketfile1'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                  if (!isset($this->NM_ajax_info['errList']['ticketfile1']) || !is_array($this->NM_ajax_info['errList']['ticketfile1']))
                  {
                      $this->NM_ajax_info['errList']['ticketfile1'] = array();
                  }
                  $this->NM_ajax_info['errList']['ticketfile1'][] = $this->Ini->Nm_lang['lang_errm_upld'];
              } 
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->ticketfile2 == "none") 
          { 
              $this->ticketfile2 = ""; 
          } 
          if ($this->ticketfile2 != "") 
          { 
              if (!function_exists('sc_upload_unprotect_chars'))
              {
                  include_once 'form_customer_ticket_send_message_doc_name.php';
              }
              $this->ticketfile2 = sc_upload_unprotect_chars($this->ticketfile2, true);
              $this->ticketfile2_scfile_name = sc_upload_unprotect_chars($this->ticketfile2_scfile_name, true);
              if (!is_file($this->ticketfile2) && isset($_SESSION['scriptcase']['charset']) && $_SESSION['scriptcase']['charset'] != 'UTF-8') {
                  $mbConvertFileName = mb_convert_encoding($this->ticketfile2, $_SESSION['scriptcase']['charset'], 'UTF-8');
                  $mbConvertScFileName = mb_convert_encoding($this->ticketfile2_scfile_name, $_SESSION['scriptcase']['charset'], 'UTF-8');
                  if (is_file($mbConvertFileName)) {
                      $this->ticketfile2 = $mbConvertFileName;
                      $this->ticketfile2_scfile_name = $mbConvertScFileName;
                  }
              }
              if (is_file($this->ticketfile2))  
              { 
                  $this->NM_size_docs[$this->ticketfile2_scfile_name] = $this->sc_file_size($this->ticketfile2);
                  $this->ticketfilename2 = $this->ticketfile2_scfile_name;
                  $reg_ticketfile2 = file_get_contents($this->ticketfile2); 
                  $this->ticketfile2 = $reg_ticketfile2; 
              } 
              else 
              { 
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketfile2'] . " " . $this->Ini->Nm_lang['lang_errm_upld']; 
                  $this->ticketfile2 = "";
                  if (!isset($Campos_Erros['ticketfile2']))
                  {
                      $Campos_Erros['ticketfile2'] = array();
                  }
                  $Campos_Erros['ticketfile2'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                  if (!isset($this->NM_ajax_info['errList']['ticketfile2']) || !is_array($this->NM_ajax_info['errList']['ticketfile2']))
                  {
                      $this->NM_ajax_info['errList']['ticketfile2'] = array();
                  }
                  $this->NM_ajax_info['errList']['ticketfile2'][] = $this->Ini->Nm_lang['lang_errm_upld'];
              } 
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->ticketfile3 == "none") 
          { 
              $this->ticketfile3 = ""; 
          } 
          if ($this->ticketfile3 != "") 
          { 
              if (!function_exists('sc_upload_unprotect_chars'))
              {
                  include_once 'form_customer_ticket_send_message_doc_name.php';
              }
              $this->ticketfile3 = sc_upload_unprotect_chars($this->ticketfile3, true);
              $this->ticketfile3_scfile_name = sc_upload_unprotect_chars($this->ticketfile3_scfile_name, true);
              if (!is_file($this->ticketfile3) && isset($_SESSION['scriptcase']['charset']) && $_SESSION['scriptcase']['charset'] != 'UTF-8') {
                  $mbConvertFileName = mb_convert_encoding($this->ticketfile3, $_SESSION['scriptcase']['charset'], 'UTF-8');
                  $mbConvertScFileName = mb_convert_encoding($this->ticketfile3_scfile_name, $_SESSION['scriptcase']['charset'], 'UTF-8');
                  if (is_file($mbConvertFileName)) {
                      $this->ticketfile3 = $mbConvertFileName;
                      $this->ticketfile3_scfile_name = $mbConvertScFileName;
                  }
              }
              if (is_file($this->ticketfile3))  
              { 
                  $this->NM_size_docs[$this->ticketfile3_scfile_name] = $this->sc_file_size($this->ticketfile3);
                  $this->ticketfilename3 = $this->ticketfile3_scfile_name;
                  $reg_ticketfile3 = file_get_contents($this->ticketfile3); 
                  $this->ticketfile3 = $reg_ticketfile3; 
              } 
              else 
              { 
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketfile3'] . " " . $this->Ini->Nm_lang['lang_errm_upld']; 
                  $this->ticketfile3 = "";
                  if (!isset($Campos_Erros['ticketfile3']))
                  {
                      $Campos_Erros['ticketfile3'] = array();
                  }
                  $Campos_Erros['ticketfile3'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                  if (!isset($this->NM_ajax_info['errList']['ticketfile3']) || !is_array($this->NM_ajax_info['errList']['ticketfile3']))
                  {
                      $this->NM_ajax_info['errList']['ticketfile3'] = array();
                  }
                  $this->NM_ajax_info['errList']['ticketfile3'][] = $this->Ini->Nm_lang['lang_errm_upld'];
              } 
          } 
      } 
   }

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
    $this->nmgp_dados_form['ticketcontent'] = $this->ticketcontent;
    $this->nmgp_dados_form['fld_close_ticket'] = $this->fld_close_ticket;
    if (empty($this->ticketfile1))
    {
        $this->ticketfile1 = $this->nmgp_dados_form['ticketfile1'];
    }
    $this->nmgp_dados_form['ticketfile1'] = $this->ticketfile1;
    $this->nmgp_dados_form['ticketfile1_limpa'] = $this->ticketfile1_limpa;
    if (empty($this->ticketfile2))
    {
        $this->ticketfile2 = $this->nmgp_dados_form['ticketfile2'];
    }
    $this->nmgp_dados_form['ticketfile2'] = $this->ticketfile2;
    $this->nmgp_dados_form['ticketfile2_limpa'] = $this->ticketfile2_limpa;
    if (empty($this->ticketfile3))
    {
        $this->ticketfile3 = $this->nmgp_dados_form['ticketfile3'];
    }
    $this->nmgp_dados_form['ticketfile3'] = $this->ticketfile3;
    $this->nmgp_dados_form['ticketfile3_limpa'] = $this->ticketfile3_limpa;
    $this->nmgp_dados_form['ticketmessageid'] = $this->ticketmessageid;
    $this->nmgp_dados_form['ticketid'] = $this->ticketid;
    $this->nmgp_dados_form['ticketdate'] = $this->ticketdate;
    $this->nmgp_dados_form['operatorid'] = $this->operatorid;
    $this->nmgp_dados_form['messagetype'] = $this->messagetype;
    $this->nmgp_dados_form['ticketfilename1'] = $this->ticketfilename1;
    $this->nmgp_dados_form['ticketfilename2'] = $this->ticketfilename2;
    $this->nmgp_dados_form['ticketfilename3'] = $this->ticketfilename3;
    $this->nmgp_dados_form['statusid'] = $this->statusid;
    $this->nmgp_dados_form['messagenote'] = $this->messagenote;
    $this->nmgp_dados_form['fld_priority'] = $this->fld_priority;
    $this->nmgp_dados_form['fld_category'] = $this->fld_category;
    $this->nmgp_dados_form['fld_subject'] = $this->fld_subject;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['ticketmessageid'] = $this->ticketmessageid;
      nm_limpa_numero($this->ticketmessageid, $this->field_config['ticketmessageid']['symbol_grp']) ; 
      $this->Before_unformat['ticketid'] = $this->ticketid;
      nm_limpa_numero($this->ticketid, $this->field_config['ticketid']['symbol_grp']) ; 
      $this->Before_unformat['ticketdate'] = $this->ticketdate;
      $this->Before_unformat['ticketdate_hora'] = $this->ticketdate_hora;
      nm_limpa_data($this->ticketdate, $this->field_config['ticketdate']['date_sep']) ; 
      nm_limpa_hora($this->ticketdate_hora, $this->field_config['ticketdate']['time_sep']) ; 
      $this->Before_unformat['operatorid'] = $this->operatorid;
      nm_limpa_numero($this->operatorid, $this->field_config['operatorid']['symbol_grp']) ; 
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
      if ($Nome_Campo == "ticketmessageid")
      {
          nm_limpa_numero($this->ticketmessageid, $this->field_config['ticketmessageid']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "ticketid")
      {
          nm_limpa_numero($this->ticketid, $this->field_config['ticketid']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "operatorid")
      {
          nm_limpa_numero($this->operatorid, $this->field_config['operatorid']['symbol_grp']) ; 
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
          $this->ajax_return_values_ticketcontent();
          $this->ajax_return_values_fld_close_ticket();
          $this->ajax_return_values_ticketfile1();
          $this->ajax_return_values_ticketfile2();
          $this->ajax_return_values_ticketfile3();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['ticketmessageid']['keyVal'] = form_customer_ticket_send_message_pack_protect_string($this->nmgp_dados_form['ticketmessageid']);
              $this->NM_ajax_info['fldList']['ticketid']['keyVal'] = form_customer_ticket_send_message_pack_protect_string($this->nmgp_dados_form['ticketid']);
          }
   } // ajax_return_values

          //----- ticketcontent
   function ajax_return_values_ticketcontent($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ticketcontent", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ticketcontent);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ticketcontent'] = array(
                       'row'    => '',
               'type'    => 'editor_html',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- fld_close_ticket
   function ajax_return_values_fld_close_ticket($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("fld_close_ticket", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->fld_close_ticket);
              $aLookup = array();
              $this->_tmp_lookup_fld_close_ticket = $this->fld_close_ticket;

$aLookup[] = array(form_customer_ticket_send_message_pack_protect_string('Y') => str_replace('<', '&lt;',form_customer_ticket_send_message_pack_protect_string(" ")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['Lookup_fld_close_ticket'][] = 'Y';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['fld_close_ticket']) && !empty($this->NM_ajax_info['select_html']['fld_close_ticket']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['fld_close_ticket']);
          }
          $this->NM_ajax_info['fldList']['fld_close_ticket'] = array(
                       'row'    => '',
               'type'    => 'checkbox',
               'switch'  => false,
               'valList' => explode(';', $sTmpValue),
               'colNum'  => 1,
               'optComp'  => $sOptComp,
               'optClass' => 'sc-ui-checkbox-fld_close_ticket',
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['fld_close_ticket']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['fld_close_ticket']['valList'][$i] = form_customer_ticket_send_message_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['fld_close_ticket']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['fld_close_ticket']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['fld_close_ticket']['labList'] = $aLabel;
          }
   }

          //----- ticketfile1
   function ajax_return_values_ticketfile1($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ticketfile1", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ticketfile1);
              $aLookup = array();
              $sTmpExtension = pathinfo($this->ticketfilename1, PATHINFO_EXTENSION);
              $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
              $sTmpFile      = 'sc_ticketfile1_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
   if ($this->ticketfile1 != "" && $this->ticketfile1 != "none")   
   { 
       $out_ticketfile1 = $this->Ini->path_imag_temp . "/" . $sTmpFile;
       $arq_ticketfile1 = fopen($this->Ini->root . $out_ticketfile1, "w") ;  
       if (is_string($this->ticketfile1) && substr($this->ticketfile1, 0, 4) == "*nm*" && (strstr(strtoupper($this->Ini->nm_tpbanco),"MSSQL") || strstr(strtoupper($this->Ini->nm_tpbanco),"PDOSQLITE"))) 
       { 
           $this->ticketfile1 = base64_decode($this->ticketfile1) ; 
       } 
       elseif (is_string($this->ticketfile1) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase)) 
       {
           $this->ticketfile1 = str_replace("''", "'", $this->ticketfile1);
       }
       fwrite($arq_ticketfile1, (string)$this->ticketfile1) ;  
       fclose($arq_ticketfile1) ;  
       if (isset($this->NM_size_docs[$ticketfilename1]))
       {
           if ($this->NM_size_docs[$ticketfilename1] != filesize($this->Ini->root . $out_ticketfile1))
           {
           }
       }
       if (isset($this->NM_size_docs[$ticketfilename2]))
       {
           if ($this->NM_size_docs[$ticketfilename2] != filesize($this->Ini->root . $out_ticketfile1))
           {
           }
       }
       if (isset($this->NM_size_docs[$ticketfilename3]))
       {
           if ($this->NM_size_docs[$ticketfilename3] != filesize($this->Ini->root . $out_ticketfile1))
           {
           }
       }
   } 
              if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames'] = array();
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames'][$sTmpFile] = $this->ticketfilename1;
              $tmp_file_ticketfile1 = trim(NM_charset_to_utf8($this->ticketfilename1));
              $tmp_icon_ticketfile1 = '';
              if ('' != $tmp_file_ticketfile1)
              {
                  $tmp_icon_ticketfile1 = $this->gera_icone($tmp_file_ticketfile1);
              }
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ticketfile1'] = array(
                       'row'    => '',
               'type'    => 'documento',
               'valList' => array($tmp_file_ticketfile1),
               'docLink' => "<a href=\"javascript:nm_mostra_doc('documento_db', '" . substr($sTmpFile, 3) . "', 'form_customer_ticket_send_message')\">" . $tmp_file_ticketfile1 . "</a>",
               'docIcon' => $tmp_icon_ticketfile1,
               'docReadonly' => "N",
              );
          }
   }

          //----- ticketfile2
   function ajax_return_values_ticketfile2($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ticketfile2", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ticketfile2);
              $aLookup = array();
              $sTmpExtension = pathinfo($this->ticketfilename2, PATHINFO_EXTENSION);
              $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
              $sTmpFile      = 'sc_ticketfile2_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
   if ($this->ticketfile2 != "" && $this->ticketfile2 != "none")   
   { 
       $out_ticketfile2 = $this->Ini->path_imag_temp . "/" . $sTmpFile;
       $arq_ticketfile2 = fopen($this->Ini->root . $out_ticketfile2, "w") ;  
       if (is_string($this->ticketfile2) && substr($this->ticketfile2, 0, 4) == "*nm*" && (strstr(strtoupper($this->Ini->nm_tpbanco),"MSSQL") || strstr(strtoupper($this->Ini->nm_tpbanco),"PDOSQLITE"))) 
       { 
           $this->ticketfile2 = base64_decode($this->ticketfile2) ; 
       } 
       elseif (is_string($this->ticketfile2) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase)) 
       {
           $this->ticketfile2 = str_replace("''", "'", $this->ticketfile2);
       }
       fwrite($arq_ticketfile2, (string)$this->ticketfile2) ;  
       fclose($arq_ticketfile2) ;  
       if (isset($this->NM_size_docs[$ticketfilename1]))
       {
           if ($this->NM_size_docs[$ticketfilename1] != filesize($this->Ini->root . $out_ticketfile2))
           {
           }
       }
       if (isset($this->NM_size_docs[$ticketfilename2]))
       {
           if ($this->NM_size_docs[$ticketfilename2] != filesize($this->Ini->root . $out_ticketfile2))
           {
           }
       }
       if (isset($this->NM_size_docs[$ticketfilename3]))
       {
           if ($this->NM_size_docs[$ticketfilename3] != filesize($this->Ini->root . $out_ticketfile2))
           {
           }
       }
   } 
              if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames'] = array();
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames'][$sTmpFile] = $this->ticketfilename2;
              $tmp_file_ticketfile2 = trim(NM_charset_to_utf8($this->ticketfilename2));
              $tmp_icon_ticketfile2 = '';
              if ('' != $tmp_file_ticketfile2)
              {
                  $tmp_icon_ticketfile2 = $this->gera_icone($tmp_file_ticketfile2);
              }
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ticketfile2'] = array(
                       'row'    => '',
               'type'    => 'documento',
               'valList' => array($tmp_file_ticketfile2),
               'docLink' => "<a href=\"javascript:nm_mostra_doc('documento_db', '" . substr($sTmpFile, 3) . "', 'form_customer_ticket_send_message')\">" . $tmp_file_ticketfile2 . "</a>",
               'docIcon' => $tmp_icon_ticketfile2,
               'docReadonly' => "N",
              );
          }
   }

          //----- ticketfile3
   function ajax_return_values_ticketfile3($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ticketfile3", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ticketfile3);
              $aLookup = array();
              $sTmpExtension = pathinfo($this->ticketfilename3, PATHINFO_EXTENSION);
              $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
              $sTmpFile      = 'sc_ticketfile3_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
   if ($this->ticketfile3 != "" && $this->ticketfile3 != "none")   
   { 
       $out_ticketfile3 = $this->Ini->path_imag_temp . "/" . $sTmpFile;
       $arq_ticketfile3 = fopen($this->Ini->root . $out_ticketfile3, "w") ;  
       if (is_string($this->ticketfile3) && substr($this->ticketfile3, 0, 4) == "*nm*" && (strstr(strtoupper($this->Ini->nm_tpbanco),"MSSQL") || strstr(strtoupper($this->Ini->nm_tpbanco),"PDOSQLITE"))) 
       { 
           $this->ticketfile3 = base64_decode($this->ticketfile3) ; 
       } 
       elseif (is_string($this->ticketfile3) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase)) 
       {
           $this->ticketfile3 = str_replace("''", "'", $this->ticketfile3);
       }
       fwrite($arq_ticketfile3, (string)$this->ticketfile3) ;  
       fclose($arq_ticketfile3) ;  
       if (isset($this->NM_size_docs[$ticketfilename1]))
       {
           if ($this->NM_size_docs[$ticketfilename1] != filesize($this->Ini->root . $out_ticketfile3))
           {
           }
       }
       if (isset($this->NM_size_docs[$ticketfilename2]))
       {
           if ($this->NM_size_docs[$ticketfilename2] != filesize($this->Ini->root . $out_ticketfile3))
           {
           }
       }
       if (isset($this->NM_size_docs[$ticketfilename3]))
       {
           if ($this->NM_size_docs[$ticketfilename3] != filesize($this->Ini->root . $out_ticketfile3))
           {
           }
       }
   } 
              if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames'] = array();
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames'][$sTmpFile] = $this->ticketfilename3;
              $tmp_file_ticketfile3 = trim(NM_charset_to_utf8($this->ticketfilename3));
              $tmp_icon_ticketfile3 = '';
              if ('' != $tmp_file_ticketfile3)
              {
                  $tmp_icon_ticketfile3 = $this->gera_icone($tmp_file_ticketfile3);
              }
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ticketfile3'] = array(
                       'row'    => '',
               'type'    => 'documento',
               'valList' => array($tmp_file_ticketfile3),
               'docLink' => "<a href=\"javascript:nm_mostra_doc('documento_db', '" . substr($sTmpFile, 3) . "', 'form_customer_ticket_send_message')\">" . $tmp_file_ticketfile3 . "</a>",
               'docIcon' => $tmp_icon_ticketfile3,
               'docReadonly' => "N",
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['upload_dir'][$fieldName][] = $newName;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      $_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  $this->LoadSettings();
$this->LoadTicket();
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off'; 
      }
      if (empty($this->ticketdate))
      {
          $this->ticketdate_hora = $this->ticketdate;
      }
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
    if ("incluir" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      $_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_fld_close_ticket = $this->fld_close_ticket;
}
  if($this->fld_close_ticket  == 'Y')
{
    $this->statusid   = 'CLOSED';
  
}
else
{
    $this->statusid   = 'RETURNED';
}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_fld_close_ticket != $this->fld_close_ticket || (isset($bFlagRead_fld_close_ticket) && $bFlagRead_fld_close_ticket)))
    {
        $this->ajax_return_values_fld_close_ticket(true);
    }
}
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off'; 
    }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
          $this->Campos_Mens_erro = ""; 
          $this->nmgp_opc_ant = $this->nmgp_opcao ; 
          if ($this->nmgp_opcao == "incluir") 
          { 
              $GLOBALS["erro_incl"] = 1; 
          }
          else
          { 
              $this->sc_evento = ""; 
          }
          if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "excluir") 
          {
              $this->nmgp_opcao = "nada"; 
          } 
          $this->NM_rollback_db(); 
          $this->Campos_Mens_erro = ""; 
      }
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
      if ('incluir' == $this->nmgp_opcao && empty($this->ticketid)) {$this->ticketid = "" . $_SESSION['v_ticketid'] . ""; $this->sc_force_zero[] = "ticketid";}  
      if ('incluir' == $this->nmgp_opcao && $this->operatorid == ""){$this->operatorid = "null"; $NM_val_null[] = "operatorid";}  
      if ('incluir' == $this->nmgp_opcao && empty($this->messagetype)) {$this->messagetype = "REQUEST"; $NM_val_null[] = "messagetype";}  
      $NM_val_form['ticketcontent'] = $this->ticketcontent;
      $NM_val_form['fld_close_ticket'] = $this->fld_close_ticket;
      $NM_val_form['ticketfile1'] = $this->ticketfile1;
      $NM_val_form['ticketfile2'] = $this->ticketfile2;
      $NM_val_form['ticketfile3'] = $this->ticketfile3;
      $NM_val_form['ticketmessageid'] = $this->ticketmessageid;
      $NM_val_form['ticketid'] = $this->ticketid;
      $NM_val_form['ticketdate'] = $this->ticketdate;
      $NM_val_form['operatorid'] = $this->operatorid;
      $NM_val_form['messagetype'] = $this->messagetype;
      $NM_val_form['ticketfilename1'] = $this->ticketfilename1;
      $NM_val_form['ticketfilename2'] = $this->ticketfilename2;
      $NM_val_form['ticketfilename3'] = $this->ticketfilename3;
      $NM_val_form['statusid'] = $this->statusid;
      $NM_val_form['messagenote'] = $this->messagenote;
      $NM_val_form['fld_priority'] = $this->fld_priority;
      $NM_val_form['fld_category'] = $this->fld_category;
      $NM_val_form['fld_subject'] = $this->fld_subject;
      if ($this->ticketmessageid === "" || is_null($this->ticketmessageid))  
      { 
          $this->ticketmessageid = 0;
      } 
      if ($this->ticketid === "" || is_null($this->ticketid))  
      { 
          $this->ticketid = 0;
      } 
      if ($this->operatorid === "" || is_null($this->operatorid))  
      { 
          $this->operatorid = 0;
          $this->sc_force_zero[] = 'operatorid';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite, array('pdo_ibm'), array('pdo_sqlsrv'));
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          if ($this->ticketdate == "")  
          { 
              $this->ticketdate = "null"; 
              $NM_val_null[] = "ticketdate";
          } 
          $this->ticketcontent_before_qstr = $this->ticketcontent;
          $this->ticketcontent = substr($this->Db->qstr($this->ticketcontent), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->ticketcontent = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->ticketcontent);
          }
          if ($this->ticketcontent == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ticketcontent = "null"; 
              $NM_val_null[] = "ticketcontent";
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
          { 
              if (substr($this->ticketfile1, 0, 4) != "*nm*" && $this->ticketfile1 != 'null') 
              { 
                  $this->ticketfile1 = "*nm*" . base64_encode($this->ticketfile1) ; 
              } 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase)) 
          {
              $this->ticketfile1 = str_replace("'", "''", $this->ticketfile1);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql)) 
          { 
              if ($this->Ini->nm_tpbanco != "pdo_sqlsrv" && substr($this->ticketfile1, 0, 4) != "*nm*" && $this->ticketfile1 != 'null') 
              { 
                  $this->ticketfile1 = "*nm*" . base64_encode($this->ticketfile1) ; 
              } 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle)) 
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) 
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix)) 
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2)) 
          { 
              if ($this->Ini->nm_tpbanco != 'pdo_ibm' && substr($this->ticketfile1, 0, 4) != "*nm*" && $this->ticketfile1 != 'null') 
              { 
                  $this->ticketfile1 = "*nm*" . base64_encode($this->ticketfile1) ; 
              } 
          } 
          else
          { 
              $this->ticketfile1 =  substr($this->Db->qstr($this->ticketfile1), 1, -1);
          } 
          if ($this->ticketfile1 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ticketfile1 = "null"; 
              $NM_val_null[] = "ticketfile1";
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
          { 
              if (substr($this->ticketfile2, 0, 4) != "*nm*" && $this->ticketfile2 != 'null') 
              { 
                  $this->ticketfile2 = "*nm*" . base64_encode($this->ticketfile2) ; 
              } 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase)) 
          {
              $this->ticketfile2 = str_replace("'", "''", $this->ticketfile2);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql)) 
          { 
              if ($this->Ini->nm_tpbanco != "pdo_sqlsrv" && substr($this->ticketfile2, 0, 4) != "*nm*" && $this->ticketfile2 != 'null') 
              { 
                  $this->ticketfile2 = "*nm*" . base64_encode($this->ticketfile2) ; 
              } 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle)) 
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) 
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix)) 
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2)) 
          { 
              if ($this->Ini->nm_tpbanco != 'pdo_ibm' && substr($this->ticketfile2, 0, 4) != "*nm*" && $this->ticketfile2 != 'null') 
              { 
                  $this->ticketfile2 = "*nm*" . base64_encode($this->ticketfile2) ; 
              } 
          } 
          else
          { 
              $this->ticketfile2 =  substr($this->Db->qstr($this->ticketfile2), 1, -1);
          } 
          if ($this->ticketfile2 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ticketfile2 = "null"; 
              $NM_val_null[] = "ticketfile2";
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
          { 
              if (substr($this->ticketfile3, 0, 4) != "*nm*" && $this->ticketfile3 != 'null') 
              { 
                  $this->ticketfile3 = "*nm*" . base64_encode($this->ticketfile3) ; 
              } 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase)) 
          {
              $this->ticketfile3 = str_replace("'", "''", $this->ticketfile3);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql)) 
          { 
              if ($this->Ini->nm_tpbanco != "pdo_sqlsrv" && substr($this->ticketfile3, 0, 4) != "*nm*" && $this->ticketfile3 != 'null') 
              { 
                  $this->ticketfile3 = "*nm*" . base64_encode($this->ticketfile3) ; 
              } 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle)) 
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) 
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix)) 
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2)) 
          { 
              if ($this->Ini->nm_tpbanco != 'pdo_ibm' && substr($this->ticketfile3, 0, 4) != "*nm*" && $this->ticketfile3 != 'null') 
              { 
                  $this->ticketfile3 = "*nm*" . base64_encode($this->ticketfile3) ; 
              } 
          } 
          else
          { 
              $this->ticketfile3 =  substr($this->Db->qstr($this->ticketfile3), 1, -1);
          } 
          if ($this->ticketfile3 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ticketfile3 = "null"; 
              $NM_val_null[] = "ticketfile3";
          } 
          $this->messagetype_before_qstr = $this->messagetype;
          $this->messagetype = substr($this->Db->qstr($this->messagetype), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->messagetype = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->messagetype);
          }
          if ($this->messagetype == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->messagetype = "null"; 
              $NM_val_null[] = "messagetype";
          } 
          $this->ticketfilename1_before_qstr = $this->ticketfilename1;
          $this->ticketfilename1 = substr($this->Db->qstr($this->ticketfilename1), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->ticketfilename1 = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->ticketfilename1);
          }
          if ($this->ticketfilename1 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ticketfilename1 = "null"; 
              $NM_val_null[] = "ticketfilename1";
          } 
          $this->ticketfilename2_before_qstr = $this->ticketfilename2;
          $this->ticketfilename2 = substr($this->Db->qstr($this->ticketfilename2), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->ticketfilename2 = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->ticketfilename2);
          }
          if ($this->ticketfilename2 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ticketfilename2 = "null"; 
              $NM_val_null[] = "ticketfilename2";
          } 
          $this->ticketfilename3_before_qstr = $this->ticketfilename3;
          $this->ticketfilename3 = substr($this->Db->qstr($this->ticketfilename3), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->ticketfilename3 = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->ticketfilename3);
          }
          if ($this->ticketfilename3 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ticketfilename3 = "null"; 
              $NM_val_null[] = "ticketfilename3";
          } 
          $this->statusid_before_qstr = $this->statusid;
          $this->statusid = substr($this->Db->qstr($this->statusid), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->statusid = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->statusid);
          }
          if ($this->statusid == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->statusid = "null"; 
              $NM_val_null[] = "statusid";
          } 
          $this->messagenote_before_qstr = $this->messagenote;
          $this->messagenote = substr($this->Db->qstr($this->messagenote), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->messagenote = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->messagenote);
          }
          if ($this->messagenote == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->messagenote = "null"; 
              $NM_val_null[] = "messagenote";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['foreign_key'] as $sFKName => $sFKValue)
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
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_customer_ticket_send_message_pack_ajax_response();
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
              if ($this->ticketfile1_limpa == "S") 
              { 
                  if ($this->ticketfilename1 != "null") 
                  { 
                      $this->ticketfilename1 = ''; 
                  } 
                  $NM_val_form['ticketfilename1'] = ''; 
              } 
              if ($this->ticketfile2_limpa == "S") 
              { 
                  if ($this->ticketfilename2 != "null") 
                  { 
                      $this->ticketfilename2 = ''; 
                  } 
                  $NM_val_form['ticketfilename2'] = ''; 
              } 
              if ($this->ticketfile3_limpa == "S") 
              { 
                  if ($this->ticketfilename3 != "null") 
                  { 
                      $this->ticketfilename3 = ''; 
                  } 
                  $NM_val_form['ticketfilename3'] = ''; 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "ticketcontent = '$this->ticketcontent'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "ticketcontent = '$this->ticketcontent'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "ticketcontent = '$this->ticketcontent'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "ticketcontent = '$this->ticketcontent'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "ticketcontent = '$this->ticketcontent'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "ticketcontent = '$this->ticketcontent'"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "ticketcontent = '$this->ticketcontent'"; 
              } 
              if (isset($NM_val_form['ticketdate']) && $NM_val_form['ticketdate'] != $this->nmgp_dados_select['ticketdate']) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "ticketdate = #$this->ticketdate#"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "ticketdate = EXTEND('" . $this->ticketdate . "', YEAR TO FRACTION)"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "ticketdate = " . $this->Ini->date_delim . $this->ticketdate . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              if (isset($NM_val_form['operatorid']) && $NM_val_form['operatorid'] != $this->nmgp_dados_select['operatorid']) 
              { 
                  $SC_fields_update[] = "operatorid = $this->operatorid"; 
              } 
              if (isset($NM_val_form['messagetype']) && $NM_val_form['messagetype'] != $this->nmgp_dados_select['messagetype']) 
              { 
                  $SC_fields_update[] = "messagetype = '$this->messagetype'"; 
              } 
              if (isset($NM_val_form['ticketfilename1']) && $NM_val_form['ticketfilename1'] != $this->nmgp_dados_select['ticketfilename1']) 
              { 
                  $SC_fields_update[] = "ticketfilename1 = '$this->ticketfilename1'"; 
              } 
              if (isset($NM_val_form['ticketfilename2']) && $NM_val_form['ticketfilename2'] != $this->nmgp_dados_select['ticketfilename2']) 
              { 
                  $SC_fields_update[] = "ticketfilename2 = '$this->ticketfilename2'"; 
              } 
              if (isset($NM_val_form['ticketfilename3']) && $NM_val_form['ticketfilename3'] != $this->nmgp_dados_select['ticketfilename3']) 
              { 
                  $SC_fields_update[] = "ticketfilename3 = '$this->ticketfilename3'"; 
              } 
              if (isset($NM_val_form['statusid']) && $NM_val_form['statusid'] != $this->nmgp_dados_select['statusid']) 
              { 
                  $SC_fields_update[] = "statusid = '$this->statusid'"; 
              } 
              if (isset($NM_val_form['messagenote']) && $NM_val_form['messagenote'] != $this->nmgp_dados_select['messagenote']) 
              { 
                  $SC_fields_update[] = "messagenote = '$this->messagenote'"; 
              } 
              $temp_cmd_sql = "";
              if ($this->ticketfile1_limpa == "S")
              {
                  if ($this->ticketfile1 != "null")
                  {
                      $this->ticketfile1 = '';
                  }
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                  {
                  }
                  else
                  {
                      $temp_cmd_sql = "ticketfile1 = '" . $this->ticketfile1 . "'";
                  }
                  $this->ticketfile1 = "";
              }
              else
              {
                  if ($this->ticketfile1 != "none" && $this->ticketfile1 != "")
                  {
                      $NM_conteudo =  $this->ticketfile1;
                      if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                      {
                      }
                      else
                      {
                          $temp_cmd_sql .= " ticketfile1 = '$NM_conteudo'";
                      }
                  }
                  else
                  {
                      $aDoNotUpdate[] = "ticketfile1";
                  }
              }
              if (!empty($temp_cmd_sql))
              {
                  $SC_fields_update[] = $temp_cmd_sql;
              }
              $temp_cmd_sql = "";
              if ($this->ticketfile2_limpa == "S")
              {
                  if ($this->ticketfile2 != "null")
                  {
                      $this->ticketfile2 = '';
                  }
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                  {
                  }
                  else
                  {
                      $temp_cmd_sql = "ticketfile2 = '" . $this->ticketfile2 . "'";
                  }
                  $this->ticketfile2 = "";
              }
              else
              {
                  if ($this->ticketfile2 != "none" && $this->ticketfile2 != "")
                  {
                      $NM_conteudo =  $this->ticketfile2;
                      if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                      {
                      }
                      else
                      {
                          $temp_cmd_sql .= " ticketfile2 = '$NM_conteudo'";
                      }
                  }
                  else
                  {
                      $aDoNotUpdate[] = "ticketfile2";
                  }
              }
              if (!empty($temp_cmd_sql))
              {
                  $SC_fields_update[] = $temp_cmd_sql;
              }
              $temp_cmd_sql = "";
              if ($this->ticketfile3_limpa == "S")
              {
                  if ($this->ticketfile3 != "null")
                  {
                      $this->ticketfile3 = '';
                  }
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                  {
                  }
                  else
                  {
                      $temp_cmd_sql = "ticketfile3 = '" . $this->ticketfile3 . "'";
                  }
                  $this->ticketfile3 = "";
              }
              else
              {
                  if ($this->ticketfile3 != "none" && $this->ticketfile3 != "")
                  {
                      $NM_conteudo =  $this->ticketfile3;
                      if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                      {
                      }
                      else
                      {
                          $temp_cmd_sql .= " ticketfile3 = '$NM_conteudo'";
                      }
                  }
                  else
                  {
                      $aDoNotUpdate[] = "ticketfile3";
                  }
              }
              if (!empty($temp_cmd_sql))
              {
                  $SC_fields_update[] = $temp_cmd_sql;
              }
              if ($this->ticketfile1_limpa == "S" || ($this->ticketfile1 != "none" && $this->ticketfile1 != "" && in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) 
                  { 
                      $SC_fields_update[] = "ticketfile1 = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql)) 
                  { 
                      $SC_fields_update[] = "ticketfile1 = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
                  { 
                      $SC_fields_update[] = "ticketfile1 = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix)) 
                  { 
                      $SC_fields_update[] = "ticketfile1 = null"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite)) 
                  { 
                      $SC_fields_update[] = "ticketfile1 = ''"; 
                  } 
                  else 
                  { 
                      $SC_fields_update[] = "ticketfile1 = empty_blob()"; 
                  } 
              } 
              if ($this->ticketfile2_limpa == "S" || ($this->ticketfile2 != "none" && $this->ticketfile2 != "" && in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) 
                  { 
                      $SC_fields_update[] = "ticketfile2 = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql)) 
                  { 
                      $SC_fields_update[] = "ticketfile2 = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
                  { 
                      $SC_fields_update[] = "ticketfile2 = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix)) 
                  { 
                      $SC_fields_update[] = "ticketfile2 = null"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite)) 
                  { 
                      $SC_fields_update[] = "ticketfile2 = ''"; 
                  } 
                  else 
                  { 
                      $SC_fields_update[] = "ticketfile2 = empty_blob()"; 
                  } 
              } 
              if ($this->ticketfile3_limpa == "S" || ($this->ticketfile3 != "none" && $this->ticketfile3 != "" && in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) 
                  { 
                      $SC_fields_update[] = "ticketfile3 = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql)) 
                  { 
                      $SC_fields_update[] = "ticketfile3 = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
                  { 
                      $SC_fields_update[] = "ticketfile3 = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix)) 
                  { 
                      $SC_fields_update[] = "ticketfile3 = null"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite)) 
                  { 
                      $SC_fields_update[] = "ticketfile3 = ''"; 
                  } 
                  else 
                  { 
                      $SC_fields_update[] = "ticketfile3 = empty_blob()"; 
                  } 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid ";  
              }  
              else  
              {
                  $comando .= " WHERE ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid ";  
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
                                  form_customer_ticket_send_message_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql)) 
              { 
              }   
              $this->ticketcontent = $this->ticketcontent_before_qstr;
              $this->messagetype = $this->messagetype_before_qstr;
              $this->ticketfilename1 = $this->ticketfilename1_before_qstr;
              $this->ticketfilename2 = $this->ticketfilename2_before_qstr;
              $this->ticketfilename3 = $this->ticketfilename3_before_qstr;
              $this->statusid = $this->statusid_before_qstr;
              $this->messagenote = $this->messagenote_before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
                  if ($this->ticketfile1_limpa == "S" && (!isset($this->Ini->nm_bases_oracle) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle)) && (!isset($this->Ini->nm_bases_informix) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))) 
                  { 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ", \"ticketfile1\", \"\",  \"ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid\")"; 
                      $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "ticketfile1", "",  "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"); 
                  } 
                  else 
                  { 
                      if ($this->ticketfile1 != "none" && $this->ticketfile1 != "") 
                      { 
                          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ", \"ticketfile1\", $this->ticketfile1,  \"ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid\")"; 
                          $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "ticketfile1", $this->ticketfile1,  "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"); 
                      } 
                  } 
                  if ($rs === false) 
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $this->Db->ErrorMsg()); 
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          form_customer_ticket_send_message_pack_ajax_response();
                      }
                      exit;  
                  }   
                  if ($this->ticketfile2_limpa == "S" && (!isset($this->Ini->nm_bases_oracle) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle)) && (!isset($this->Ini->nm_bases_informix) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))) 
                  { 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ", \"ticketfile2\", \"\",  \"ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid\")"; 
                      $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "ticketfile2", "",  "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"); 
                  } 
                  else 
                  { 
                      if ($this->ticketfile2 != "none" && $this->ticketfile2 != "") 
                      { 
                          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ", \"ticketfile2\", $this->ticketfile2,  \"ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid\")"; 
                          $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "ticketfile2", $this->ticketfile2,  "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"); 
                      } 
                  } 
                  if ($rs === false) 
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $this->Db->ErrorMsg()); 
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          form_customer_ticket_send_message_pack_ajax_response();
                      }
                      exit;  
                  }   
                  if ($this->ticketfile3_limpa == "S" && (!isset($this->Ini->nm_bases_oracle) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle)) && (!isset($this->Ini->nm_bases_informix) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))) 
                  { 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ", \"ticketfile3\", \"\",  \"ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid\")"; 
                      $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "ticketfile3", "",  "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"); 
                  } 
                  else 
                  { 
                      if ($this->ticketfile3 != "none" && $this->ticketfile3 != "") 
                      { 
                          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ", \"ticketfile3\", $this->ticketfile3,  \"ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid\")"; 
                          $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "ticketfile3", $this->ticketfile3,  "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"); 
                      } 
                  } 
                  if ($rs === false) 
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $this->Db->ErrorMsg()); 
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          form_customer_ticket_send_message_pack_ajax_response();
                      }
                      exit;  
                  }   
              }   
              if ($this->ticketfile1_limpa == "S")
              {
                  $this->NM_ajax_info['fldList']['ticketfile1_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
              if ($this->ticketfile2_limpa == "S")
              {
                  $this->NM_ajax_info['fldList']['ticketfile2_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
              if ($this->ticketfile3_limpa == "S")
              {
                  $this->NM_ajax_info['fldList']['ticketfile3_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
              $this->sc_evento = "update"; 
              $this->nmgp_opcao = "igual"; 
              $this->nm_flag_iframe = true;
              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
                  $this->NM_ajax_info['fldList']['ticketfile1_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
                  $this->NM_ajax_info['fldList']['ticketfile2_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
                  $this->NM_ajax_info['fldList']['ticketfile3_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }


              if     (isset($NM_val_form) && isset($NM_val_form['ticketcontent'])) { $this->ticketcontent = $NM_val_form['ticketcontent']; }
              elseif (isset($this->ticketcontent)) { $this->nm_limpa_alfa($this->ticketcontent); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('ticketcontent', 'fld_close_ticket', 'ticketfile1', 'ticketfile2', 'ticketfile3'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              $this->nm_tira_formatacao();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(ticketmessageid) from " . $this->Ini->nm_tabela; 
          $comando = "select max(ticketmessageid) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  form_customer_ticket_send_message_pack_ajax_response();
              }
              exit; 
          }  
          $this->ticketmessageid_before_qstr = $this->ticketmessageid = $rs->fields[0] + 1;
          $rs->Close(); 
              $this->ticketdate =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->ticketdate_hora =  date('H') . ":" . date('i') . ":" . date('s');
          $bInsertOk = true;
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 0) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_pkey']); 
              $this->nmgp_opcao = "nada"; 
              $GLOBALS["erro_incl"] = 1; 
              $bInsertOk = false;
              $this->sc_evento = 'insert';
          } 
          $rs1->Close(); 
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      form_customer_ticket_send_message_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              $_test_file = $this->fetchUniqueUploadName($this->ticketfile1_scfile_name, $dir_file, "ticketfile1");
              if (trim($this->ticketfile1_scfile_name) != $_test_file)
              {
                  $this->ticketfile1_scfile_name = $_test_file;
                  $this->ticketfile1 = $_test_file;
              }
              $_test_file = $this->fetchUniqueUploadName($this->ticketfile2_scfile_name, $dir_file, "ticketfile2");
              if (trim($this->ticketfile2_scfile_name) != $_test_file)
              {
                  $this->ticketfile2_scfile_name = $_test_file;
                  $this->ticketfile2 = $_test_file;
              }
              $_test_file = $this->fetchUniqueUploadName($this->ticketfile3_scfile_name, $dir_file, "ticketfile3");
              if (trim($this->ticketfile3_scfile_name) != $_test_file)
              {
                  $this->ticketfile3_scfile_name = $_test_file;
                  $this->ticketfile3 = $_test_file;
              }
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (ticketmessageid, ticketid, ticketdate, ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote) VALUES ($this->ticketmessageid, $this->ticketid, #$this->ticketdate#, '$this->ticketcontent', '$this->ticketfile1', '$this->ticketfile2', '$this->ticketfile3', $this->operatorid, '$this->messagetype', '$this->ticketfilename1', '$this->ticketfilename2', '$this->ticketfilename3', '$this->statusid', '$this->messagenote')"; 
              }
              elseif ($this->Ini->nm_tpbanco == "pdo_sqlsrv")
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (ticketmessageid, ticketid, ticketdate, ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote) VALUES ($this->ticketmessageid, $this->ticketid, " . $this->Ini->date_delim . $this->ticketdate . $this->Ini->date_delim1 . ", '$this->ticketcontent', '', '', '', $this->operatorid, '$this->messagetype', '$this->ticketfilename1', '$this->ticketfilename2', '$this->ticketfilename3', '$this->statusid', '$this->messagenote')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (ticketmessageid, ticketid, ticketdate, ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote) VALUES ($this->ticketmessageid, $this->ticketid, " . $this->Ini->date_delim . $this->ticketdate . $this->Ini->date_delim1 . ", '$this->ticketcontent', '$this->ticketfile1', '$this->ticketfile2', '$this->ticketfile3', $this->operatorid, '$this->messagetype', '$this->ticketfilename1', '$this->ticketfilename2', '$this->ticketfilename3', '$this->statusid', '$this->messagenote')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (ticketmessageid, ticketid, ticketdate, ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote) VALUES ($this->ticketmessageid, $this->ticketid, " . $this->Ini->date_delim . $this->ticketdate . $this->Ini->date_delim1 . ", '$this->ticketcontent', '$this->ticketfile1', '$this->ticketfile2', '$this->ticketfile3', $this->operatorid, '$this->messagetype', '$this->ticketfilename1', '$this->ticketfilename2', '$this->ticketfilename3', '$this->statusid', '$this->messagenote')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "ticketmessageid, ticketid, ticketdate, ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote) VALUES (" . $NM_seq_auto . "$this->ticketmessageid, $this->ticketid, " . $this->Ini->date_delim . $this->ticketdate . $this->Ini->date_delim1 . ", '$this->ticketcontent', EMPTY_BLOB(), EMPTY_BLOB(), EMPTY_BLOB(), $this->operatorid, '$this->messagetype', '$this->ticketfilename1', '$this->ticketfilename2', '$this->ticketfilename3', '$this->statusid', '$this->messagenote')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "ticketmessageid, ticketid, ticketdate, ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote) VALUES (" . $NM_seq_auto . "$this->ticketmessageid, $this->ticketid, EXTEND('$this->ticketdate', YEAR TO FRACTION), '$this->ticketcontent', null, null, null, $this->operatorid, '$this->messagetype', '$this->ticketfilename1', '$this->ticketfilename2', '$this->ticketfilename3', '$this->statusid', '$this->messagenote')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "ticketmessageid, ticketid, ticketdate, ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote) VALUES (" . $NM_seq_auto . "$this->ticketmessageid, $this->ticketid, " . $this->Ini->date_delim . $this->ticketdate . $this->Ini->date_delim1 . ", '$this->ticketcontent', '', '', '', $this->operatorid, '$this->messagetype', '$this->ticketfilename1', '$this->ticketfilename2', '$this->ticketfilename3', '$this->statusid', '$this->messagenote')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "ticketmessageid, ticketid, ticketdate, ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote) VALUES (" . $NM_seq_auto . "$this->ticketmessageid, $this->ticketid, " . $this->Ini->date_delim . $this->ticketdate . $this->Ini->date_delim1 . ", '$this->ticketcontent', '', '', '', $this->operatorid, '$this->messagetype', '$this->ticketfilename1', '$this->ticketfilename2', '$this->ticketfilename3', '$this->statusid', '$this->messagenote')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "ticketmessageid, ticketid, ticketdate, ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote) VALUES (" . $NM_seq_auto . "$this->ticketmessageid, $this->ticketid, " . $this->Ini->date_delim . $this->ticketdate . $this->Ini->date_delim1 . ", '$this->ticketcontent', '', '', '', $this->operatorid, '$this->messagetype', '$this->ticketfilename1', '$this->ticketfilename2', '$this->ticketfilename3', '$this->statusid', '$this->messagenote')"; 
              }
              elseif ($this->Ini->nm_tpbanco =='pdo_ibm')
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "ticketmessageid, ticketid, ticketdate, ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote) VALUES (" . $NM_seq_auto . "$this->ticketmessageid, $this->ticketid, " . $this->Ini->date_delim . $this->ticketdate . $this->Ini->date_delim1 . ", '$this->ticketcontent', EMPTY_BLOB(), EMPTY_BLOB(), EMPTY_BLOB(), $this->operatorid, '$this->messagetype', '$this->ticketfilename1', '$this->ticketfilename2', '$this->ticketfilename3', '$this->statusid', '$this->messagenote')"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "ticketmessageid, ticketid, ticketdate, ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote) VALUES (" . $NM_seq_auto . "$this->ticketmessageid, $this->ticketid, " . $this->Ini->date_delim . $this->ticketdate . $this->Ini->date_delim1 . ", '$this->ticketcontent', '$this->ticketfile1', '$this->ticketfile2', '$this->ticketfile3', $this->operatorid, '$this->messagetype', '$this->ticketfilename1', '$this->ticketfilename2', '$this->ticketfilename3', '$this->statusid', '$this->messagenote')"; 
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
                              form_customer_ticket_send_message_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              $this->ticketcontent = $this->ticketcontent_before_qstr;
              $this->messagetype = $this->messagetype_before_qstr;
              $this->ticketfilename1 = $this->ticketfilename1_before_qstr;
              $this->ticketfilename2 = $this->ticketfilename2_before_qstr;
              $this->ticketfilename3 = $this->ticketfilename3_before_qstr;
              $this->statusid = $this->statusid_before_qstr;
              $this->messagenote = $this->messagenote_before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql)) 
              { 
              }   
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
                  if (trim($this->ticketfile1 ) != "") 
                  { 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ",  ticketfile1 , $this->ticketfile1,  \"ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid\")"; 
                      $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "ticketfile1", $this->ticketfile1,  "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"); 
                      if ($rs === false)  
                      { 
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
                          $this->NM_rollback_db(); 
                          if ($this->NM_ajax_flag)
                          {
                              form_customer_ticket_send_message_pack_ajax_response();
                          }
                          exit; 
                      }  
                  }  
                  if (trim($this->ticketfile2 ) != "") 
                  { 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ",  ticketfile2 , $this->ticketfile2,  \"ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid\")"; 
                      $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "ticketfile2", $this->ticketfile2,  "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"); 
                      if ($rs === false)  
                      { 
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
                          $this->NM_rollback_db(); 
                          if ($this->NM_ajax_flag)
                          {
                              form_customer_ticket_send_message_pack_ajax_response();
                          }
                          exit; 
                      }  
                  }  
                  if (trim($this->ticketfile3 ) != "") 
                  { 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ",  ticketfile3 , $this->ticketfile3,  \"ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid\")"; 
                      $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "ticketfile3", $this->ticketfile3,  "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"); 
                      if ($rs === false)  
                      { 
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
                          $this->NM_rollback_db(); 
                          if ($this->NM_ajax_flag)
                          {
                              form_customer_ticket_send_message_pack_ajax_response();
                          }
                          exit; 
                      }  
                  }  
              }  
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->ticketcontent = $this->ticketcontent_before_qstr;
              $this->messagetype = $this->messagetype_before_qstr;
              $this->ticketfilename1 = $this->ticketfilename1_before_qstr;
              $this->ticketfilename2 = $this->ticketfilename2_before_qstr;
              $this->ticketfilename3 = $this->ticketfilename3_before_qstr;
              $this->statusid = $this->statusid_before_qstr;
              $this->messagenote = $this->messagenote_before_qstr;
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['return_edit'] = "new";
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
          $this->ticketmessageid = substr($this->Db->qstr($this->ticketmessageid), 1, -1); 
          $this->ticketid = substr($this->Db->qstr($this->ticketid), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid "); 
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
                          form_customer_ticket_send_message_pack_ajax_response();
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['total']);
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
    if ("insert" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        $_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_fld_close_ticket = $this->fld_close_ticket;
    $original_ticketcontent = $this->ticketcontent;
}
  $this->update_ticket_status();

$this->send_messages();

if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_fld_close_ticket != $this->fld_close_ticket || (isset($bFlagRead_fld_close_ticket) && $bFlagRead_fld_close_ticket)))
    {
        $this->ajax_return_values_fld_close_ticket(true);
    }
    if (($original_ticketcontent != $this->ticketcontent || (isset($bFlagRead_ticketcontent) && $bFlagRead_ticketcontent)))
    {
        $this->ajax_return_values_ticketcontent(true);
    }
}
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off'; 
    }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
          $this->Campos_Mens_erro = ""; 
          $this->nmgp_opc_ant = $salva_opcao ; 
          if ($salva_opcao == "incluir") 
          { 
              $GLOBALS["erro_incl"] = 1; 
          }
          if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "excluir") 
          {
              $this->nmgp_opcao = "nada"; 
          } 
          $this->sc_evento = ""; 
          $this->NM_rollback_db(); 
          return; 
      }
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['parms'] = "ticketmessageid?#?$this->ticketmessageid?@?ticketid?#?$this->ticketid?@?"; 
      }
      $this->nmgp_dados_form['ticketfile1'] = ""; 
      $this->ticketfile1_limpa = ""; 
      $this->ticketfile1_salva = ""; 
      $this->nmgp_dados_form['ticketfile2'] = ""; 
      $this->ticketfile2_limpa = ""; 
      $this->ticketfile2_salva = ""; 
      $this->nmgp_dados_form['ticketfile3'] = ""; 
      $this->ticketfile3_limpa = ""; 
      $this->ticketfile3_salva = ""; 
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->ticketmessageid = null === $this->ticketmessageid ? null : substr($this->Db->qstr($this->ticketmessageid), 1, -1); 
          $this->ticketid = null === $this->ticketid ? null : substr($this->Db->qstr($this->ticketid), 1, -1); 
      } 
      if ($this->nmgp_opcao != "nada") 
      {
          $this->nmgp_opcao = "novo"; 
      }
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_filter'] . ")";
          }
      }
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "inicio")
      { 
          $this->nmgp_opcao = "igual"; 
      } 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
              $nmgp_select = "SELECT ticketmessageid, ticketid, str_replace (convert(char(10),ticketdate,102), '.', '-') + ' ' + convert(char(8),ticketdate,20), ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $nmgp_select = "SELECT ticketmessageid, ticketid, convert(char(23),ticketdate,121), ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $nmgp_select = "SELECT ticketmessageid, ticketid, ticketdate, ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $nmgp_select = "SELECT ticketmessageid, ticketid, EXTEND(ticketdate, YEAR TO FRACTION), ticketcontent, LOTOFILE(ticketfile1, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_ticketfile1', 'client'), LOTOFILE(ticketfile2, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_ticketfile2', 'client'), LOTOFILE(ticketfile3, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_ticketfile3', 'client'), operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote from " . $this->Ini->nm_tabela ; 
          } 
          else 
          { 
              $nmgp_select = "SELECT ticketmessageid, ticketid, ticketdate, ticketcontent, ticketfile1, ticketfile2, ticketfile3, operatorid, messagetype, ticketfilename1, ticketfilename2, ticketfilename3, statusid, messagenote from " . $this->Ini->nm_tabela ; 
          } 
          $aWhere = array();
          $aWhere[] = "(ticketID = " . $_SESSION['v_ticketid'] . ")";
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (!empty($sc_where))
              {
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  {
                     $aWhere[] = "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                  {
                     $aWhere[] = "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  {
                     $aWhere[] = "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  {
                     $aWhere[] = "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
                  }  
                  else  
                  {
                     $aWhere[] = "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
                  }
              } 
              else
              {
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  {
                      $aWhere[] = "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                  {
                      $aWhere[] = "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  {
                      $aWhere[] = "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  {
                      $aWhere[] = "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
                  }  
                  else  
                  {
                      $aWhere[] = "ticketmessageid = $this->ticketmessageid and ticketid = $this->ticketid"; 
                  }
              } 
          } 
          $nmgp_select .= $this->returnWhere($aWhere) . ' ';
          $sc_order_by = "";
          $sc_order_by = "ticketmessageid, ticketid";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['reg_start']) ;  
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['empty_filter'] = true;
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
              $this->ticketmessageid = $rs->fields[0] ; 
              $this->nmgp_dados_select['ticketmessageid'] = $this->ticketmessageid;
              $this->ticketid = $rs->fields[1] ; 
              $this->nmgp_dados_select['ticketid'] = $this->ticketid;
              $this->ticketdate = $rs->fields[2] ; 
              if (substr($this->ticketdate, 10, 1) == "-") 
              { 
                 $this->ticketdate = substr($this->ticketdate, 0, 10) . " " . substr($this->ticketdate, 11);
              } 
              if (substr($this->ticketdate, 13, 1) == ".") 
              { 
                 $this->ticketdate = substr($this->ticketdate, 0, 13) . ":" . substr($this->ticketdate, 14, 2) . ":" . substr($this->ticketdate, 17);
              } 
              $this->nmgp_dados_select['ticketdate'] = $this->ticketdate;
              $this->ticketcontent = $rs->fields[3] ; 
              $this->nmgp_dados_select['ticketcontent'] = $this->ticketcontent;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $this->ticketfile1 = $this->Db->BlobDecode($rs->fields[4]) ; 
              } 
              elseif ($this->Ini->nm_tpbanco == 'pdo_oracle')
              { 
                  $this->ticketfile1 = $this->Db->BlobDecode($rs->fields[4]) ; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  if(isset($rs->fields[4]) && !empty($rs->fields[4]) && is_file($rs->fields[4])) 
                  { 
                     $this->ticketfile1 = file_get_contents($rs->fields[4]);
                  }else 
                  { 
                     $this->ticketfile1 = ''; 
                  } 
              } 
              else
              { 
                  $this->ticketfile1 = $rs->fields[4] ; 
              } 
              $this->nmgp_dados_select['ticketfile1'] = $this->ticketfile1;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $this->ticketfile2 = $this->Db->BlobDecode($rs->fields[5]) ; 
              } 
              elseif ($this->Ini->nm_tpbanco == 'pdo_oracle')
              { 
                  $this->ticketfile2 = $this->Db->BlobDecode($rs->fields[5]) ; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  if(isset($rs->fields[5]) && !empty($rs->fields[5]) && is_file($rs->fields[5])) 
                  { 
                     $this->ticketfile2 = file_get_contents($rs->fields[5]);
                  }else 
                  { 
                     $this->ticketfile2 = ''; 
                  } 
              } 
              else
              { 
                  $this->ticketfile2 = $rs->fields[5] ; 
              } 
              $this->nmgp_dados_select['ticketfile2'] = $this->ticketfile2;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $this->ticketfile3 = $this->Db->BlobDecode($rs->fields[6]) ; 
              } 
              elseif ($this->Ini->nm_tpbanco == 'pdo_oracle')
              { 
                  $this->ticketfile3 = $this->Db->BlobDecode($rs->fields[6]) ; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  if(isset($rs->fields[6]) && !empty($rs->fields[6]) && is_file($rs->fields[6])) 
                  { 
                     $this->ticketfile3 = file_get_contents($rs->fields[6]);
                  }else 
                  { 
                     $this->ticketfile3 = ''; 
                  } 
              } 
              else
              { 
                  $this->ticketfile3 = $rs->fields[6] ; 
              } 
              $this->nmgp_dados_select['ticketfile3'] = $this->ticketfile3;
              $this->operatorid = $rs->fields[7] ; 
              $this->nmgp_dados_select['operatorid'] = $this->operatorid;
              $this->messagetype = $rs->fields[8] ; 
              $this->nmgp_dados_select['messagetype'] = $this->messagetype;
              $this->ticketfilename1 = $rs->fields[9] ; 
              $this->nmgp_dados_select['ticketfilename1'] = $this->ticketfilename1;
              $this->ticketfilename2 = $rs->fields[10] ; 
              $this->nmgp_dados_select['ticketfilename2'] = $this->ticketfilename2;
              $this->ticketfilename3 = $rs->fields[11] ; 
              $this->nmgp_dados_select['ticketfilename3'] = $this->ticketfilename3;
              $this->statusid = $rs->fields[12] ; 
              $this->nmgp_dados_select['statusid'] = $this->statusid;
              $this->messagenote = $rs->fields[13] ; 
              $this->nmgp_dados_select['messagenote'] = $this->messagenote;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->ticketmessageid = (string)$this->ticketmessageid; 
              $this->ticketid = (string)$this->ticketid; 
              $this->operatorid = (string)$this->operatorid; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['parms'] = "ticketmessageid?#?$this->ticketmessageid?@?ticketid?#?$this->ticketid?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['reg_start'] < $qt_geral_reg_form_customer_ticket_send_message;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opcao']   = '';
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
              $this->ticketmessageid = "";  
              $this->nmgp_dados_form["ticketmessageid"] = $this->ticketmessageid;
              $this->ticketid = "";  
              $this->nmgp_dados_form["ticketid"] = $this->ticketid;
              $this->ticketdate = "";  
              $this->ticketdate_hora = "" ;  
              $this->nmgp_dados_form["ticketdate"] = $this->ticketdate;
              $this->ticketcontent = "";  
              $this->nmgp_dados_form["ticketcontent"] = $this->ticketcontent;
              $this->ticketfile1 = "";  
              $this->ticketfile1_ul_name = "" ;  
              $this->ticketfile1_ul_type = "" ;  
              $this->nmgp_dados_form["ticketfile1"] = $this->ticketfile1;
              $this->ticketfile2 = "";  
              $this->ticketfile2_ul_name = "" ;  
              $this->ticketfile2_ul_type = "" ;  
              $this->nmgp_dados_form["ticketfile2"] = $this->ticketfile2;
              $this->ticketfile3 = "";  
              $this->ticketfile3_ul_name = "" ;  
              $this->ticketfile3_ul_type = "" ;  
              $this->nmgp_dados_form["ticketfile3"] = $this->ticketfile3;
              $this->operatorid = "";  
              $this->nmgp_dados_form["operatorid"] = $this->operatorid;
              $this->messagetype = "";  
              $this->nmgp_dados_form["messagetype"] = $this->messagetype;
              $this->ticketfilename1 = "";  
              $this->nmgp_dados_form["ticketfilename1"] = $this->ticketfilename1;
              $this->ticketfilename2 = "";  
              $this->nmgp_dados_form["ticketfilename2"] = $this->ticketfilename2;
              $this->ticketfilename3 = "";  
              $this->nmgp_dados_form["ticketfilename3"] = $this->ticketfilename3;
              $this->statusid = "";  
              $this->nmgp_dados_form["statusid"] = $this->statusid;
              $this->messagenote = "";  
              $this->nmgp_dados_form["messagenote"] = $this->messagenote;
              $this->fld_priority = "";  
              $this->nmgp_dados_form["fld_priority"] = $this->fld_priority;
              $this->fld_category = "";  
              $this->nmgp_dados_form["fld_category"] = $this->fld_category;
              $this->fld_subject = "";  
              $this->nmgp_dados_form["fld_subject"] = $this->fld_subject;
              $this->fld_close_ticket = "";  
              $this->nmgp_dados_form["fld_close_ticket"] = $this->fld_close_ticket;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['foreign_key'] as $sFKName => $sFKValue)
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
        function initializeRecordState() {
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

// 
 function gera_icone($doc) 
 {
    $cam_icone = "";
    $path =  $this->Ini->root . $this->Ini->path_icones . "/";
    if (is_dir($path))
    {
        $nm_icones = nm_list_icon($path); 
        $nm_tipo = strtolower(substr($doc, strrpos($doc, ".") + 1));
        $nm_tipo = str_replace(array('docx', 'xlsx'), array('doc', 'xls'), $nm_tipo);
        if (isset($nm_icones[$nm_tipo]) && !empty($nm_icones[$nm_tipo]))
        {
            $cam_icone = $this->Ini->path_icones . "/" . $nm_icones[$nm_tipo];
        }
        else
        {
            $cam_icone = $this->Ini->path_icones . "/" . $nm_icones["default"];
        }
    }
    return $cam_icone;
 } 
//
function LoadTicket()
{
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
if (!isset($this->sc_temp_v_ticketid)) {$this->sc_temp_v_ticketid = (isset($_SESSION['v_ticketid'])) ? $_SESSION['v_ticketid'] : "";}
  
$str_sql = "select statusid,customerrating from ticket where ticketid = $this->sc_temp_v_ticketid";
 
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


$str_status = (!empty($this->dataset [0][0]))?$this->dataset [0][0]:'';
$str_rating = (!empty($this->dataset [0][1]))?$this->dataset [0][1]:'';

if($str_status == 'CLOSED' || $str_status == 'SOLVED'){
	$str_title = "Sc Tickets";
	$str_content =  $this->Ini->Nm_lang['lang_alert_ticket_closed'] ;
	 if (isset($this->sc_temp_v_ticketid)) { $_SESSION['v_ticketid'] = $this->sc_temp_v_ticketid;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('control_show_messages') . "/control_show_messages.php", $this->nm_location, "v_message_title?#?" . NM_encode_input($str_title) . "?@?" . "v_message_content?#?" . NM_encode_input($str_content) . "?@?", "_self", "ret_self", 440, 630);
 };
}
if (isset($this->sc_temp_v_ticketid)) { $_SESSION['v_ticketid'] = $this->sc_temp_v_ticketid;}
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function send_messages()
{
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
if (!isset($this->sc_temp_v_ticketid)) {$this->sc_temp_v_ticketid = (isset($_SESSION['v_ticketid'])) ? $_SESSION['v_ticketid'] : "";}
  


if( $_SESSION['ticketsettings']['broadcastmessages'] == 'Y'){

	 
      $nm_select = "select categoryid from ticket where ticketid = $this->sc_temp_v_ticketid"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->ds = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 $SCrx->fields[0] = str_replace(',', '.', $SCrx->fields[0]);
                 $SCrx->fields[0] = (strpos(strtolower($SCrx->fields[0]), "e")) ? (float)$SCrx->fields[0] : $SCrx->fields[0];
                 $SCrx->fields[0] = (string)$SCrx->fields[0];
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->ds[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->ds = false;
          $this->ds_erro = $this->Db->ErrorMsg();
      } 

	
	$this->fld_category  = $this->ds[0][0];
	
	if($this->fld_close_ticket  == 'Y'){
	    $this->fld_subject   = 'Ticket closed by user';
	}
	else{
	    $this->fld_subject   = 'Message sent by user';
	}
	
	 
      $nm_select = "select customer.customerid, customer.customername, customer.customeremail 
		             from customer, ticket
		             where ticket.customerid = customer.customerid and 
		             ticket.ticketid = $this->sc_temp_v_ticketid"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->cust_info = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 $SCrx->fields[0] = str_replace(',', '.', $SCrx->fields[0]);
                 $SCrx->fields[0] = (strpos(strtolower($SCrx->fields[0]), "e")) ? (float)$SCrx->fields[0] : $SCrx->fields[0];
                 $SCrx->fields[0] = (string)$SCrx->fields[0];
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->cust_info[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->cust_info = false;
          $this->cust_info_erro = $this->Db->ErrorMsg();
      } 

				     
	$customerid 	= $this->cust_info[0][0];
	$customername 	= $this->cust_info[0][1];
	$customeremail 	= $this->cust_info[0][2];
	
	$status = $this->GetTicketStatus($this->sc_temp_v_ticketid);

	$str_sql = "";
	if($status == 'UNASSIGNED'){
		$str_sql = "select staff.staffemail, staff.staffid
			from   staff, staff_categories
			where  staff.staffid = staff_categories.Staff_staffid
			and    staff_categories.categoryid = $this->fld_category 
			UNION
			select staff.staffemail, staff.staffid
			from   staff
			where  staff.adminflag = 'Y' ";
	}
	else{
		$str_sql = "select staff.staffemail, staff.staffid 	from staff,ticket
                            where ownerid = staffid and ticketid = $this->sc_temp_v_ticketid";
	}
   


	 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->stf = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->stf[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->stf = false;
          $this->stf_erro = $this->Db->ErrorMsg();
      } 
 

	$this->P_MailConnect('hndle_mail_server');
			 
	foreach($this->stf  as $operator)
	{

		$op_email     = $operator[0];
		$op_code      = $operator[1];
		$arr_email    = $this->GetTemplateEmailStaff($status,$op_code);
		
		$message_body  = $arr_email['MESSAGE'];
		$message_title = $arr_email['TITLE'];
		
						

		$trackingid   = $this->GetTrackingId($this->ticketid );

		$message_body = str_replace('@@##trackingid##@@',$trackingid,$message_body);
		$message_body = str_replace('@@##ticketid##@@',$this->ticketid ,$message_body);
		$message_body = str_replace('@@##ticketsubject##@@',$this->fld_subject ,$message_body);				
		$message_body = str_replace('@@##customername##@@',$customername,$message_body);
		$message_body = str_replace('@@##customeremail##@@',$customeremail,$message_body);		
		$message_body = str_replace('@@##ticketmessage##@@',$this->ticketcontent ,$message_body);

	}			
											
	$this->P_MailDisconnect('hndle_mail_server');

	
	$arr_email = $this->GetTemplateEmailCustomer($status,$customerid);
		
	$message_body  = $arr_email['MESSAGE'];
	$message_title = $arr_email['TITLE'];
		
	$trackinglink = $this->SetTrackingId($this->ticketid );
	$trackingid   = $this->GetTrackingId($this->ticketid );
	
	$message_body = str_replace('@@##trackingid##@@',$trackingid,$message_body);
	$message_body = str_replace('@@##trackinglink##@@',$trackinglink,$message_body);
	$message_body = str_replace('@@##ticketid##@@',$this->ticketid ,$message_body);
	$message_body = str_replace('@@##ticketsubject##@@','',$message_body);				
	$message_body = str_replace('@@##customername##@@',$customername,$message_body);				
	$message_body = str_replace('@@##ticketmessage##@@',$this->ticketcontent ,$message_body);					
		
	
}
if (isset($this->sc_temp_v_ticketid)) { $_SESSION['v_ticketid'] = $this->sc_temp_v_ticketid;}
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function update_ticket_status()
{
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
if (!isset($this->sc_temp_v_ticketid)) {$this->sc_temp_v_ticketid = (isset($_SESSION['v_ticketid'])) ? $_SESSION['v_ticketid'] : "";}
  
$now = date('Y-m-d H:i:s');

if($this->fld_close_ticket  == 'Y')
{
    	
     $sql_upd = "UPDATE ticket SET statusid = 'CLOSED' , ticketlastupdate = '$now', ticketlastreplier = 'CUSTOMER' WHERE  ticketid = $this->sc_temp_v_ticketid ";
     
     $nm_select = $sql_upd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_customer_ticket_send_message_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

}
else
{
     $st = $this->GetTicketStatus($this->sc_temp_v_ticketid);           

     if($st != 'UNASSIGNED')
     {     
     	$sql_upd = "UPDATE ticket SET statusid = 'RETURNED' , ticketlastupdate = '$now', ticketlastreplier = 'CUSTOMER' WHERE  ticketid = $this->sc_temp_v_ticketid ";
	
     $nm_select = $sql_upd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_customer_ticket_send_message_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
     }
     else
     {
     	$sql_upd = "UPDATE ticket SET ticketlastupdate = '$now', ticketlastreplier = 'CUSTOMER' WHERE  ticketid = $this->sc_temp_v_ticketid ";
     	
     $nm_select = $sql_upd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_customer_ticket_send_message_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
     }
     	
}
if (isset($this->sc_temp_v_ticketid)) { $_SESSION['v_ticketid'] = $this->sc_temp_v_ticketid;}
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function GetNextTicketMessageID($ticket_id){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function CloseTicket($ticket_id){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_customer_ticket_send_message_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	
	return true;
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function TransferTicket($ticket_id,$new_ownerid){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_customer_ticket_send_message_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      	
	
	return true;
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function UpdateTicketStatus($ticket_id,$status_id = 'REPLIED'){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  
	
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_customer_ticket_send_message_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	
	return true;
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function GetTicketSubject($ticket_id){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function GetTicketStatus($ticket_id){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function GetTicketRating($ticket_id)
{
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function GetOperatorName($staffid){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function GetCustomerTicket($ticket_id){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function GetCustomerEmail($customerid){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function GetCustomerName($customerid){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function SetTicketOwner($ticket_id,$staffid){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_customer_ticket_send_message_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      	
		return true;
	}
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function LoadStaff($staffid){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function LoadSettings(){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function getCustomerByEmail($customer_email){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function getStaffById($staff_id){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function getStaffByEmail($staff_email){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function SetTrackingId($ticket, $mode='')
{
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  
	
	$trk_id = strtoupper(substr(md5($ticket),0,10));
	
     $nm_select ="UPDATE ticket SET tickettrack = '$trk_id' WHERE ticketid = $ticket"; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_customer_ticket_send_message_pack_ajax_response();
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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function GetTrackingId($ticket)
{
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  
		
	$trk_id = strtoupper(substr(md5($ticket),0,10));
	return($trk_id);

$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function VersionDemo(){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

	$arr_load = (!empty($_SESSION['TicketSettings']))?$_SESSION['TicketSettings']:false;
	if($arr_load == false){
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .=  $this->Ini->Nm_lang['lang_error_blocked_demo'] ;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_customer_ticket_send_message';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_customer_ticket_send_message';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] =  $this->Ini->Nm_lang['lang_error_blocked_demo'] ;
 }
;
	}
	$bl_version = $arr_load['Version'];
	
	if($bl_version == 'demo'){
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .=  $this->Ini->Nm_lang['lang_error_blocked_demo'] ;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_customer_ticket_send_message';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_customer_ticket_send_message';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] =  $this->Ini->Nm_lang['lang_error_blocked_demo'] ;
 }
;
	}
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function DefinedParameters(){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

	$definedParameters  = (!empty($_SESSION['TicketSettings']['DefinedParameters']))?
				$_SESSION['TicketSettings']['DefinedParameters']:false;

	if($definedParameters != 'Y'){
		 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('form_systemsettings') . "/form_systemsettings.php", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };
	}
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function scTicketStart(){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_customer_ticket_send_message_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_customer_ticket_send_message_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_customer_ticket_send_message_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_customer_ticket_send_message_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
		
		}
		unlink($str_file);
	
	}
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function M_Warning($str_title, $str_message, $int_left=100, $int_top=100, $int_width=400,$action='RETURN'){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
 
 
 
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function MailSend($destination,$subject='SC Tickets',$message='<b>message template not found!</b>'){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
        $sc_mail_port = (!empty($sc_mail_port)) ? $sc_mail_port : 465;
        $Con_Mail = Swift_SmtpTransport::newInstance($smtp_server, $sc_mail_port, 'ssl');
    }
    elseif ($sc_mail_tp_port == "T")
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 587;
        $Con_Mail = Swift_SmtpTransport::newInstance($smtp_server, $sc_mail_port, 'tls');
    }
    else
    {
        $sc_mail_port = (!empty($sc_mail_port)) ? $sc_mail_port : 25;
        $Con_Mail = Swift_SmtpTransport::newInstance($smtp_server, $sc_mail_port);
    }
    $Con_Mail->setUsername($smtp_user);
    $Con_Mail->setpassword($smtp_pass);
    $Send_Mail = Swift_Mailer::newInstance($Con_Mail);
    if ($sc_mail_tp_mens == "H")
    {
        $Mens_Mail = Swift_Message::newInstance($subject);
        $Mens_Mail->setBody(SC_Mail_Image($message, $Mens_Mail))->setContentType("text/html");
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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function P_MailSend($destination,$subject='SC Tickets',$message='<b>message template not found!</b>',$conn_id){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
        $sc_mail_port = (!empty($sc_mail_port)) ? $sc_mail_port : 465;
        $Con_Mail = Swift_SmtpTransport::newInstance($conn_id, $sc_mail_port, 'ssl');
    }
    elseif ($sc_mail_tp_port == "T")
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 587;
        $Con_Mail = Swift_SmtpTransport::newInstance($conn_id, $sc_mail_port, 'tls');
    }
    else
    {
        $sc_mail_port = (!empty($sc_mail_port)) ? $sc_mail_port : 25;
        $Con_Mail = Swift_SmtpTransport::newInstance($conn_id, $sc_mail_port);
    }
    $Con_Mail->setUsername($smtp_email);
    $Con_Mail->setpassword($destination);
    $Send_Mail = Swift_Mailer::newInstance($Con_Mail);
    if ($sc_mail_tp_mens == "H")
    {
        $Mens_Mail = Swift_Message::newInstance("H");
        $Mens_Mail->setBody(SC_Mail_Image("", $Mens_Mail))->setContentType("text/html");
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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function P_MailConnect($conn_id)
{
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  
	
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
    if ($sc_mail_tp_port == "S")
    {
        $sc_mail_port = (!empty($sc_mail_port)) ? $sc_mail_port : 465;
        $Con_Mail = Swift_SmtpTransport::newInstance($smtp_server, $sc_mail_port, 'ssl');
    }
    else
    {
        $sc_mail_port = (!empty($sc_mail_port)) ? $sc_mail_port : 25;
        $Con_Mail = Swift_SmtpTransport::newInstance($smtp_server, $sc_mail_port);
    }
    $Con_Mail->setUsername($smtp_user);
    $Con_Mail->setpassword($smtp_pass);
    $this->$conn_id = Swift_Mailer::newInstance($Con_Mail);
;
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function P_MailDisconnect($conn_id)
{
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  
	;
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function GetTemplateEmailStaff($status_id,$staff_id){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
}
function GetTemplateEmailCustomer($status_id,$customerid){
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_customer_ticket_send_message']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_customer_ticket_send_message_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
//-- 
   if ($this->nmgp_opcao == "novo")
   { 
       $out_ticketfile1 = "";  
   } 
   else 
   { 
       $out_ticketfile1 = $this->ticketfile1;  
   } 
   if ($this->ticketfile1 != "" && $this->ticketfile1 != "none")   
   { 
       $sTmpExtension = pathinfo($this->ticketfilename1, PATHINFO_EXTENSION);
       $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
       $sTmpFile_ticketfilename1 = 'sc_ticketfile1_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames'][$sTmpFile_ticketfilename1] = $this->ticketfilename1;
       $out_ticketfile1 = $this->Ini->path_imag_temp . "/" . $sTmpFile_ticketfilename1;
       $arq_ticketfile1 = fopen($this->Ini->root . $out_ticketfile1, "w") ;  
       if (is_string($this->ticketfile1) && substr($this->ticketfile1, 0, 4) == "*nm*" && (strstr(strtoupper($this->Ini->nm_tpbanco),"MSSQL") || strstr(strtoupper($this->Ini->nm_tpbanco),"PDOSQLITE"))) 
       { 
           $this->ticketfile1 = base64_decode($this->ticketfile1) ; 
       } 
       fwrite($arq_ticketfile1, (string)$this->ticketfile1) ;  
       fclose($arq_ticketfile1) ;  
       if (isset($this->NM_size_docs[$ticketfilename1]))
       {
           if ($this->NM_size_docs[$ticketfilename1] != filesize($this->Ini->root . $out_ticketfile1))
           {
               echo "<font=3><b>" . $this->Ini->Nm_lang['lang_errm_dcmt'] . $ticketfilename1 . "</font></b>";
           }
       }
       if (isset($this->NM_size_docs[$ticketfilename2]))
       {
           if ($this->NM_size_docs[$ticketfilename2] != filesize($this->Ini->root . $out_ticketfile1))
           {
               echo "<font=3><b>" . $this->Ini->Nm_lang['lang_errm_dcmt'] . $ticketfilename2 . "</font></b>";
           }
       }
       if (isset($this->NM_size_docs[$ticketfilename3]))
       {
           if ($this->NM_size_docs[$ticketfilename3] != filesize($this->Ini->root . $out_ticketfile1))
           {
               echo "<font=3><b>" . $this->Ini->Nm_lang['lang_errm_dcmt'] . $ticketfilename3 . "</font></b>";
           }
       }
   } 
   if ($this->nmgp_opcao == "novo")
   { 
       $out_ticketfile2 = "";  
   } 
   else 
   { 
       $out_ticketfile2 = $this->ticketfile2;  
   } 
   if ($this->ticketfile2 != "" && $this->ticketfile2 != "none")   
   { 
       $sTmpExtension = pathinfo($this->ticketfilename2, PATHINFO_EXTENSION);
       $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
       $sTmpFile_ticketfilename2 = 'sc_ticketfile2_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames'][$sTmpFile_ticketfilename2] = $this->ticketfilename2;
       $out_ticketfile2 = $this->Ini->path_imag_temp . "/" . $sTmpFile_ticketfilename2;
       $arq_ticketfile2 = fopen($this->Ini->root . $out_ticketfile2, "w") ;  
       if (is_string($this->ticketfile2) && substr($this->ticketfile2, 0, 4) == "*nm*" && (strstr(strtoupper($this->Ini->nm_tpbanco),"MSSQL") || strstr(strtoupper($this->Ini->nm_tpbanco),"PDOSQLITE"))) 
       { 
           $this->ticketfile2 = base64_decode($this->ticketfile2) ; 
       } 
       fwrite($arq_ticketfile2, (string)$this->ticketfile2) ;  
       fclose($arq_ticketfile2) ;  
       if (isset($this->NM_size_docs[$ticketfilename1]))
       {
           if ($this->NM_size_docs[$ticketfilename1] != filesize($this->Ini->root . $out_ticketfile2))
           {
               echo "<font=3><b>" . $this->Ini->Nm_lang['lang_errm_dcmt'] . $ticketfilename1 . "</font></b>";
           }
       }
       if (isset($this->NM_size_docs[$ticketfilename2]))
       {
           if ($this->NM_size_docs[$ticketfilename2] != filesize($this->Ini->root . $out_ticketfile2))
           {
               echo "<font=3><b>" . $this->Ini->Nm_lang['lang_errm_dcmt'] . $ticketfilename2 . "</font></b>";
           }
       }
       if (isset($this->NM_size_docs[$ticketfilename3]))
       {
           if ($this->NM_size_docs[$ticketfilename3] != filesize($this->Ini->root . $out_ticketfile2))
           {
               echo "<font=3><b>" . $this->Ini->Nm_lang['lang_errm_dcmt'] . $ticketfilename3 . "</font></b>";
           }
       }
   } 
   if ($this->nmgp_opcao == "novo")
   { 
       $out_ticketfile3 = "";  
   } 
   else 
   { 
       $out_ticketfile3 = $this->ticketfile3;  
   } 
   if ($this->ticketfile3 != "" && $this->ticketfile3 != "none")   
   { 
       $sTmpExtension = pathinfo($this->ticketfilename3, PATHINFO_EXTENSION);
       $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
       $sTmpFile_ticketfilename3 = 'sc_ticketfile3_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['download_filenames'][$sTmpFile_ticketfilename3] = $this->ticketfilename3;
       $out_ticketfile3 = $this->Ini->path_imag_temp . "/" . $sTmpFile_ticketfilename3;
       $arq_ticketfile3 = fopen($this->Ini->root . $out_ticketfile3, "w") ;  
       if (is_string($this->ticketfile3) && substr($this->ticketfile3, 0, 4) == "*nm*" && (strstr(strtoupper($this->Ini->nm_tpbanco),"MSSQL") || strstr(strtoupper($this->Ini->nm_tpbanco),"PDOSQLITE"))) 
       { 
           $this->ticketfile3 = base64_decode($this->ticketfile3) ; 
       } 
       fwrite($arq_ticketfile3, (string)$this->ticketfile3) ;  
       fclose($arq_ticketfile3) ;  
       if (isset($this->NM_size_docs[$ticketfilename1]))
       {
           if ($this->NM_size_docs[$ticketfilename1] != filesize($this->Ini->root . $out_ticketfile3))
           {
               echo "<font=3><b>" . $this->Ini->Nm_lang['lang_errm_dcmt'] . $ticketfilename1 . "</font></b>";
           }
       }
       if (isset($this->NM_size_docs[$ticketfilename2]))
       {
           if ($this->NM_size_docs[$ticketfilename2] != filesize($this->Ini->root . $out_ticketfile3))
           {
               echo "<font=3><b>" . $this->Ini->Nm_lang['lang_errm_dcmt'] . $ticketfilename2 . "</font></b>";
           }
       }
       if (isset($this->NM_size_docs[$ticketfilename3]))
       {
           if ($this->NM_size_docs[$ticketfilename3] != filesize($this->Ini->root . $out_ticketfile3))
           {
               echo "<font=3><b>" . $this->Ini->Nm_lang['lang_errm_dcmt'] . $ticketfilename3 . "</font></b>";
           }
       }
   } 
        $this->initFormPages();
    include_once("form_customer_ticket_send_message_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array(""))) {
            $searchOk = true;
        }
        elseif ($field == $this->nmgp_fast_search && in_array($field, array(""))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input


    function scCsrfGetToken()
    {
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['csrf_token'];
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

   function Form_lookup_fld_close_ticket()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= " ?#?Y?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

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
       $nmgp_saida_form = "form_customer_ticket_send_message_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_customer_ticket_send_message_fim.php";
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
       form_customer_ticket_send_message_pack_ajax_response();
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
    <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['masterValue']);
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
function nmgp_redireciona_form($nm_apl_dest, $nm_apl_retorno, $nm_apl_parms, $nm_target="", $opc="", $alt_modal=430, $larg_modal=630)
{
   if (isset($this->NM_is_redirected) && $this->NM_is_redirected)
   {
       return;
   }
   if (is_array($nm_apl_parms))
   {
       $tmp_parms = "";
       foreach ($nm_apl_parms as $par => $val)
       {
           $par = trim($par);
           $val = trim($val);
           $tmp_parms .= str_replace(".", "_", $par) . "?#?";
           if (substr($val, 0, 1) == "$")
           {
               $tmp_parms .= $$val;
           }
           elseif (substr($val, 0, 1) == "{")
           {
               $val        = substr($val, 1, -1);
               $tmp_parms .= $this->$val;
           }
           elseif (substr($val, 0, 1) == "[")
           {
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message'][substr($val, 1, -1)];
           }
           else
           {
               $tmp_parms .= $val;
           }
           $tmp_parms .= "?@?";
       }
       $nm_apl_parms = $tmp_parms;
   }
   if (empty($opc))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           form_customer_ticket_send_message_pack_ajax_response();
           exit;
       }
       echo "<SCRIPT language=\"javascript\">";
       if (strtolower($nm_target) == "_blank")
       {
           echo "window.open ('" . $nm_apl_dest . "');";
           echo "</SCRIPT>";
           return;
       }
       else
       {
           echo "window.location='" . $nm_apl_dest . "';";
           echo "</SCRIPT>";
           $this->NM_close_db();
           exit;
       }
   }
   $dir = explode("/", $nm_apl_dest);
   if (count($dir) == 1)
   {
       $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
       $nm_apl_dest = $this->Ini->path_link . SC_dir_app_name($nm_apl_dest) . "/" . $nm_apl_dest . ".php";
   }
   if ($this->NM_ajax_flag)
   {
       $nm_apl_parms = str_replace("?#?", "*scin", NM_charset_to_utf8($nm_apl_parms));
       $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
       $this->NM_ajax_info['redir']['metodo']     = 'post';
       $this->NM_ajax_info['redir']['action']     = $nm_apl_dest;
       $this->NM_ajax_info['redir']['nmgp_parms'] = $nm_apl_parms;
       $this->NM_ajax_info['redir']['target']     = $nm_target_form;
       $this->NM_ajax_info['redir']['h_modal']    = $alt_modal;
       $this->NM_ajax_info['redir']['w_modal']    = $larg_modal;
       if ($nm_target_form == "_blank")
       {
           $this->NM_ajax_info['redir']['nmgp_outra_jan'] = 'true';
       }
       else
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida']      = $nm_apl_retorno;
           $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       }
       form_customer_ticket_send_message_pack_ajax_response();
       exit;
   }
   if ($nm_target == "modal")
   {
       if (!empty($nm_apl_parms))
       {
           $nm_apl_parms = str_replace("?#?", "*scin", $nm_apl_parms);
           $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
           $nm_apl_parms = "nmgp_parms=" . $nm_apl_parms . "&";
       }
       $par_modal = "?script_case_init=" . $this->Ini->sc_page . "&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&";
       $this->redir_modal = "$(function() { tb_show('', '" . $nm_apl_dest . $par_modal . $nm_apl_parms . "TB_iframe=true&modal=true&height=" . $alt_modal . "&width=" . $larg_modal . "', '') })";
       $this->NM_is_redirected = true;
       return;
   }
   if ($nm_target == "_blank")
   {
?>
<form name="Fredir" method="post" target="_blank" action="<?php echo $nm_apl_dest; ?>">
  <input type="hidden" name="nmgp_parms" value="<?php echo $this->form_encode_input($nm_apl_parms); ?>"/>
</form>
<script type="text/javascript">
setTimeout(function() { document.Fredir.submit(); }, 250);
</script>
<?php
    return;
   }
?>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
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
    <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
   </HEAD>
   <BODY>
<?php
   }
?>
<form name="Fredir" method="post" 
                  target="_self"> 
  <input type="hidden" name="nmgp_parms" value="<?php echo $this->form_encode_input($nm_apl_parms); ?>"/>
<?php
   if ($nm_target_form == "_blank")
   {
?>
  <input type="hidden" name="nmgp_outra_jan" value="true"/> 
<?php
   }
   else
   {
?>
  <input type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($nm_apl_retorno) ?>">
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
<?php
   }
?>
</form> 
   <SCRIPT type="text/javascript">
<?php
   if ($nm_target_form == "modal")
   {
?>
       $(document).ready(function(){
           tb_show('', '<?php echo $nm_apl_dest ?>?script_case_init=<?php echo $this->Ini->sc_page; ?>&nmgp_url_saida=modal&nmgp_parms=<?php echo $this->form_encode_input($nm_apl_parms); ?>&nmgp_outra_jan=true&TB_iframe=true&height=<?php echo $alt_modal; ?>&width=<?php echo $larg_modal; ?>&modal=true', '');
       });
<?php
   }
   else
   {
?>
    $(function() {
       document.Fredir.target = "<?php echo $nm_target_form ?>"; 
       document.Fredir.action = "<?php echo $nm_apl_dest ?>";
       document.Fredir.submit();
    });
<?php
   }
?>
   </SCRIPT>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
?>
   </BODY>
   </HTML>
<?php
   }
?>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
       $this->NM_close_db();
       exit;
   }
}
    function getButtonIds($buttonName) {
        switch ($buttonName) {
            case "new":
                return array("sc_b_new_b.sc-unique-btn-1");
                break;
            case "insert":
                return array("sc_b_ins_b.sc-unique-btn-2");
                break;
            case "help":
                return array("sc_b_hlp_b");
                break;
            case "exit":
                return array("sc_b_sai_b.sc-unique-btn-3", "sc_b_sai_b.sc-unique-btn-5", "sc_b_sai_b.sc-unique-btn-4");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr><td class="sc-app-header">
   <TABLE width="100%" class="scFormHeader">
    <TR align="center">
     <TD style="padding: 0px">
      <TABLE style="padding: 0px; border-spacing: 0px; border-width: 0px;" width="100%">
       <TR align="center" valign="middle">
        <TD align="left" rowspan="2" class="scFormHeaderFont">
          
        </TD>
        <TD class="scFormHeaderFont">
          <?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_header_open_ticket'] . ""; } else { echo "" . $this->Ini->Nm_lang['lang_header_open_ticket'] . ""; } ?>
        </TD>
       </TR>
       <TR align="right" valign="middle">
        <TD class="scFormHeaderFont">
          
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
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_customer_ticket_send_message']['ordem_ord'] == " desc") {
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
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            default:
                return 'asc';
        }
        return 'asc';
    }
}
?>
