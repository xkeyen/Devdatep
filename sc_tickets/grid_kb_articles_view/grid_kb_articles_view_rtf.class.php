<?php

class grid_kb_articles_view_rtf
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
                   nm_limpa_str_grid_kb_articles_view($cadapar[1]);
                   nm_protect_num_grid_kb_articles_view($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_kb_articles_view']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($v_articlesid)) 
      {
          $_SESSION['v_articlesid'] = $v_articlesid;
          nm_limpa_str_grid_kb_articles_view($_SESSION["v_articlesid"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "grid_kb_articles_view.php"; 
      require_once($this->Ini->path_aplicacao . "grid_kb_articles_view_total.class.php"); 
      $this->Tot      = new grid_kb_articles_view_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_kb_articles_view']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("grid_kb_articles_view.php");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_kb_articles_view";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_kb_articles_view.rtf";
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
      $this->New_label['articledate'] = "" . $this->Ini->Nm_lang['lang_kb_articles_fild_articledate'] . "";
      $this->New_label['articlesubject'] = "" . $this->Ini->Nm_lang['lang_kb_articles_fild_articlesubject'] . "";
      $this->New_label['articlecontent'] = "" . $this->Ini->Nm_lang['lang_kb_articles_fild_articlecontent'] . "";
      $this->New_label['articleview'] = "" . $this->Ini->Nm_lang['lang_kb_articles_fild_articleview'] . "";
      $this->New_label['articlesid'] = "" . $this->Ini->Nm_lang['lang_kb_articles_fild_articlesid'] . "";
      $this->New_label['categoryid'] = "" . $this->Ini->Nm_lang['lang_kb_articles_fild_categoryid'] . "";
      $this->New_label['articletypeid'] = "" . $this->Ini->Nm_lang['lang_kb_articles_fild_articletypeid'] . "";
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['articledate'])) ? $this->New_label['articledate'] : ""; 
          if ($Cada_col == "articledate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['articlesubject'])) ? $this->New_label['articlesubject'] : ""; 
          if ($Cada_col == "articlesubject" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['articlecontent'])) ? $this->New_label['articlecontent'] : ""; 
          if ($Cada_col == "articlecontent" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['rating'])) ? $this->New_label['rating'] : " "; 
          if ($Cada_col == "rating" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['votes'])) ? $this->New_label['votes'] : " "; 
          if ($Cada_col == "votes" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['articleview'])) ? $this->New_label['articleview'] : ""; 
          if ($Cada_col == "articleview" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT str_replace (convert(char(10),articledate,102), '.', '-') + ' ' + convert(char(8),articledate,20), articlesubject, articlecontent, articleview, articlesid, votesqty, votestotal, categoryid from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT articledate, articlesubject, articlecontent, articleview, articlesid, votesqty, votestotal, categoryid from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT convert(char(23),articledate,121), articlesubject, articlecontent, articleview, articlesid, votesqty, votestotal, categoryid from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT articledate, articlesubject, articlecontent, articleview, articlesid, votesqty, votestotal, categoryid from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT EXTEND(articledate, YEAR TO FRACTION), articlesubject, articlecontent, articleview, articlesid, votesqty, votestotal, categoryid from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT articledate, articlesubject, articlecontent, articleview, articlesid, votesqty, votestotal, categoryid from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['order_grid'];
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
         $this->articledate = $rs->fields[0] ;  
         $this->articlesubject = $rs->fields[1] ;  
         $this->articlecontent = $rs->fields[2] ;  
         $this->articleview = $rs->fields[3] ;  
         $this->articleview = (string)$this->articleview;
         $this->articlesid = $rs->fields[4] ;  
         $this->articlesid = (string)$this->articlesid;
         $this->votesqty = $rs->fields[5] ;  
         $this->votesqty = (string)$this->votesqty;
         $this->votestotal = $rs->fields[6] ;  
         $this->votestotal = (string)$this->votestotal;
         $this->categoryid = $rs->fields[7] ;  
         $this->categoryid = (string)$this->categoryid;
   $_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'on';
  $this->M_View();
$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'off';
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
         $this->articledate = $rs->fields[0] ;  
         $this->articlesubject = $rs->fields[1] ;  
         $this->articlecontent = $rs->fields[2] ;  
         $this->articleview = $rs->fields[3] ;  
         $this->articleview = (string)$this->articleview;
         $this->articlesid = $rs->fields[4] ;  
         $this->articlesid = (string)$this->articlesid;
         $this->votesqty = $rs->fields[5] ;  
         $this->votesqty = (string)$this->votesqty;
         $this->votestotal = $rs->fields[6] ;  
         $this->votestotal = (string)$this->votestotal;
         $this->categoryid = $rs->fields[7] ;  
         $this->categoryid = (string)$this->categoryid;
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'on';
  $this->rating  = $this->Ini->Nm_lang['lang_rate'];

$this->votes  = 0;

if(!empty($this->votestotal ) && !empty($this->votesqty ))  
$this->votes   = (int)$this->votestotal  / $this->votesqty ; 
$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- articledate
   function NM_export_articledate()
   {
             $conteudo_x =  $this->articledate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->articledate, "YYYY-MM-DD  ");
                 $this->articledate = $this->nm_data->FormataSaida("d/m/Y");
             } 
         $this->articledate = NM_charset_to_utf8($this->articledate);
         $this->articledate = str_replace('<', '&lt;', $this->articledate);
         $this->articledate = str_replace('>', '&gt;', $this->articledate);
         $this->Texto_tag .= "<td>" . $this->articledate . "</td>\r\n";
   }
   //----- articlesubject
   function NM_export_articlesubject()
   {
         $this->articlesubject = html_entity_decode($this->articlesubject, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->articlesubject = strip_tags($this->articlesubject);
         $this->articlesubject = NM_charset_to_utf8($this->articlesubject);
         $this->articlesubject = str_replace('<', '&lt;', $this->articlesubject);
         $this->articlesubject = str_replace('>', '&gt;', $this->articlesubject);
         $this->Texto_tag .= "<td>" . $this->articlesubject . "</td>\r\n";
   }
   //----- articlecontent
   function NM_export_articlecontent()
   {
         $this->articlecontent = html_entity_decode($this->articlecontent, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->articlecontent = strip_tags($this->articlecontent);
         $this->articlecontent = NM_charset_to_utf8($this->articlecontent);
         $this->articlecontent = str_replace('<', '&lt;', $this->articlecontent);
         $this->articlecontent = str_replace('>', '&gt;', $this->articlecontent);
         $this->Texto_tag .= "<td>" . $this->articlecontent . "</td>\r\n";
   }
   //----- rating
   function NM_export_rating()
   {
         $this->rating = html_entity_decode($this->rating, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->rating = strip_tags($this->rating);
         $this->rating = NM_charset_to_utf8($this->rating);
         $this->rating = str_replace('<', '&lt;', $this->rating);
         $this->rating = str_replace('>', '&gt;', $this->rating);
         $this->Texto_tag .= "<td>" . $this->rating . "</td>\r\n";
   }
   //----- votes
   function NM_export_votes()
   {
         $this->votes = NM_charset_to_utf8($this->votes);
         $this->votes = str_replace('<', '&lt;', $this->votes);
         $this->votes = str_replace('>', '&gt;', $this->votes);
         $this->Texto_tag .= "<td>" . $this->votes . "</td>\r\n";
   }
   //----- articleview
   function NM_export_articleview()
   {
             nmgp_Form_Num_Val($this->articleview, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->articleview = NM_charset_to_utf8($this->articleview);
         $this->articleview = str_replace('<', '&lt;', $this->articleview);
         $this->articleview = str_replace('>', '&gt;', $this->articleview);
         $this->Texto_tag .= "<td>" . $this->articleview . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_view'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> - <?php echo $this->Ini->Nm_lang['lang_tble_kb_articles'] ?> :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_kb_articles_view_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_kb_articles_view"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="grid_kb_articles_view.php"> 
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
function M_View()
{
$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'on';
  
$str_update = "update kb_articles 
               set articleview = articleview + 1
               where articlesid = $this->articlesid ";
               

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
      
$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'off';
}
function M_Votes()
{
$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'on';
  
$this->votes = (int)$this->votestotal  / $this->votesqty ;
$str_img = '';
for($i=0;$i<$this->votes;$i++){
	$str_img .= "<img src='../_lib/img/star_icons20.gif' />";
}
$this->votes  = $str_img;

$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'off';
}
function createMenuStructure($aOrder, &$aList, $sParent, $aLabels){
$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'on';
  
	foreach ($aOrder as $iCat => $aCats) {
	    $sMenuId = 'mid_' . $iCat;
	    $aList[] = array(
	                     'id'     => $iCat,
	                     'mid'    => $sMenuId,
	                     'label'  => $aLabels[$iCat],
	                     'parent' => $sParent,
	                    );
	
	    $this->createMenuStructure($aCats, $aList, $sMenuId, $aLabels);
	}

$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'off';
}
function getCategoriesTree(){
$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'on';
  
	$sSql = "SELECT categoryid,
	                categoryname,
	                categoryparent
	         FROM kb_categories";
	
	 
      $nm_select = $sSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->ds_cat = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->ds_cat[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->ds_cat = false;
          $this->ds_cat_erro = $this->Db->ErrorMsg();
      } 

	
	if (false === $this->ds_cat )  { return false;   }
	elseif (empty($this->ds_cat )) { return array(); }
	else {
	    $aNewOrder = array();
	
	    foreach ($this->ds_cat  as $iCat => $aData) {
	        $this->insertCategory($aData, $aNewOrder, 0);
	    }
	
	    return $aNewOrder;
	}
$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'off';
}
function getCategoryLabels(){
$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'on';
  

	$sSql = "SELECT categoryid,
	                categoryname
	         FROM kb_categories";
	
	 
      $nm_select = $sSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->ds_cat = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->ds_cat[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->ds_cat = false;
          $this->ds_cat_erro = $this->Db->ErrorMsg();
      } 

	
	if (false === $this->ds_cat )  { return false;   }
	elseif (empty($this->ds_cat )) { return array(); }
	else {
	    $aLabels = array();
	
	    foreach ($this->ds_cat  as $iCat => $aData) {
	        $aLabels[ $aData[0] ] = $aData[1];
	    }
	
	    return $aLabels;
	}
$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'off';
}
function insertCategory($aCat, &$aOrder, $iLevel){
$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'on';
  

	$iCatId     = $aCat[0];
	$sCatLabel  = $aCat[1];
	$iCatParent = $aCat[2];
	
	if (0 == $iLevel && 0 == $iCatParent) {
	    $aOrder[$iCatId] = array();
	}
	else {
	    foreach ($aOrder as $iIndex => $aList) {
	        if ($iIndex == $iCatParent) {
	            $aOrder[$iCatParent] [$iCatId] = array();
	        }
	        elseif (!empty($aOrder[$iIndex])) {
	            $this->insertCategory($aCat, $aOrder[$iIndex], $iLevel + 1);
	        }
	    }
	}

$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'off';
}
function getRatingStars($total,$qty){
$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'on';
  

	if(empty($total) || empty($qty)) return ' ';	
	$this->votes = (int)$total / $qty;
	$str_img = '';
	for($i=0;$i<$this->votes;$i++){
		$str_img .= "<img src='../_lib/img/star_icons20.gif' />";
	}
	return $str_img;
	

$_SESSION['scriptcase']['grid_kb_articles_view']['contr_erro'] = 'off';
}
}

?>
