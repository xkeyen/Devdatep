<?php
   include_once('Grafico_pais_session.php');
   @ini_set('session.cookie_httponly', 1);
   @ini_set('session.use_only_cookies', 1);
   @ini_set('session.cookie_secure', 0);
   @session_start() ;
   $_SESSION['scriptcase']['Grafico_pais']['glo_nm_perfil']          = "";
   $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_prod']       = "/scriptcase/prod";
   $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_conf']       = "D:/SCRIPTCASE/wwwroot/scriptcase/conf";
   $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imagens']    = "/scriptcase/file/img";
   $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp']  = "/scriptcase/tmp";
   $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_cache']      = "D:/SCRIPTCASE/wwwroot/scriptcase/file/cache";
   $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_doc']        = "C:/Program Files/NetMake/v9-php81/wwwroot/scriptcase/file/doc";
   $_SESSION['scriptcase']['Grafico_pais']['glo_nm_conexao']         = "conn_mysql";
    //check publication with the prod
    $NM_dir_atual = getcwd();
    if (empty($NM_dir_atual))
    {
        $str_path_sys          = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
        $str_path_sys          = str_replace("\\", '/', $str_path_sys);
    }
    else
    {
        $sc_nm_arquivo         = explode("/", $_SERVER['PHP_SELF']);
        $str_path_sys          = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
    }
    $str_path_apl_url = $_SERVER['PHP_SELF'];
    $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
    $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
    $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
    $str_path_apl_dir = substr($str_path_sys, 0, strrpos($str_path_sys, "/"));
    $str_path_apl_dir = substr($str_path_apl_dir, 0, strrpos($str_path_apl_dir, "/")+1);
    //check prod
    if(empty($_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_prod']))
    {
            /*check prod*/$_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
    }
    //check img
    if(empty($_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imagens']))
    {
            /*check img*/$_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imagens'] = $str_path_apl_url . "_lib/file/img";
    }
    //check tmp
    if(empty($_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp']))
    {
            /*check tmp*/$_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
    }
    //check cache
    if(empty($_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_cache']))
    {
            /*check tmp*/$_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_cache'] = $str_path_apl_dir . "_lib/file/cache";
    }
    //check doc
    if(empty($_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_doc']))
    {
            /*check doc*/$_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_doc'] = $str_path_apl_dir . "_lib/file/doc";
    }
    //end check publication with the prod
//
class Grafico_pais_ini
{
   var $nm_cod_apl;
   var $nm_nome_apl;
   var $nm_seguranca;
   var $nm_grupo;
   var $nm_autor;
   var $nm_versao_sc;
   var $nm_tp_lic_sc;
   var $nm_dt_criacao;
   var $nm_hr_criacao;
   var $nm_autor_alt;
   var $nm_dt_ult_alt;
   var $nm_hr_ult_alt;
   var $nm_timestamp;
   var $nm_app_version;
   var $cor_link_dados;
   var $root;
   var $server;
   var $java_protocol;
   var $server_pdf;
   var $Arr_result;
   var $sc_protocolo;
   var $path_prod;
   var $path_link;
   var $path_aplicacao;
   var $path_embutida;
   var $path_botoes;
   var $path_img_global;
   var $path_img_modelo;
   var $path_icones;
   var $path_imagens;
   var $path_imag_cab;
   var $path_imag_temp;
   var $path_libs;
   var $path_doc;
   var $str_lang;
   var $str_conf_reg;
   var $str_schema_all;
   var $Str_btn_grid;
   var $str_google_fonts;
   var $path_cep;
   var $path_secure;
   var $path_js;
   var $path_help;
   var $path_adodb;
   var $path_grafico;
   var $path_atual;
   var $Gd_missing;
   var $sc_site_ssl;
   var $nm_cont_lin;
   var $nm_limite_lin;
   var $nm_limite_lin_prt;
   var $nm_limite_lin_res;
   var $nm_limite_lin_res_prt;
   var $Qtd_reg_ajax_grid;
   var $nm_falta_var;
   var $nm_falta_var_db;
   var $nm_tpbanco;
   var $nm_servidor;
   var $nm_usuario;
   var $nm_senha;
   var $nm_database_encoding;
   var $nm_arr_db_extra_args = array();
   var $nm_con_db2 = array();
   var $nm_con_persistente;
   var $nm_con_use_schema;
   var $nm_tabela;
   var $nm_ger_css_emb;
   var $nm_col_dinamica   = array();
   var $nm_order_dinamico = array();
   var $nm_hidden_blocos  = array();
   var $sc_tem_trans_banco;
   var $nm_bases_all;
   var $nm_bases_access;
   var $nm_bases_db2;
   var $nm_bases_ibase;
   var $nm_bases_informix;
   var $nm_bases_mssql;
   var $nm_bases_mysql;
   var $nm_bases_postgres;
   var $nm_bases_oracle;
   var $nm_bases_sqlite;
   var $nm_bases_sybase;
   var $nm_bases_vfp;
   var $nm_bases_odbc;
   var $nm_bases_progress;
   var $sc_page;
   var $sc_lig_md5 = array();
   var $sc_lig_target = array();
   var $sc_export_ajax = false;
   var $sc_export_ajax_img = false;
   var $force_db_utf8 = true;
//
   function init($Tp_init = "")
   {
       global
             $nm_url_saida, $nm_apl_dependente, $script_case_init, $nmgp_opcao;

      if (!function_exists("sc_check_mobile"))
      {
          include_once("../_lib/lib/php/nm_check_mobile.php");
      }
          include_once("../_lib/lib/php/fix.php");
      $_SESSION['scriptcase']['proc_mobile'] = sc_check_mobile();
        if (isset($_GET['_sc_force_mobile'])) {
            $_SESSION['scriptcase']['force_mobile'] = 'Y' == $_GET['_sc_force_mobile'];
        }
        if (isset($_SESSION['scriptcase']['force_mobile'])) {
            $_SESSION['scriptcase']['proc_mobile'] = $_SESSION['scriptcase']['force_mobile'];
        }
      @ini_set('magic_quotes_runtime', 0);
      $this->sc_page = $script_case_init;
      $_SESSION['scriptcase']['sc_num_page'] = $script_case_init;
      $_SESSION['scriptcase']['sc_cnt_sql']  = 0;
      $this->sc_charset['UTF-8'] = 'utf-8';
      $this->sc_charset['ISO-2022-JP'] = 'iso-2022-jp';
      $this->sc_charset['ISO-2022-KR'] = 'iso-2022-kr';
      $this->sc_charset['ISO-8859-1'] = 'iso-8859-1';
      $this->sc_charset['ISO-8859-2'] = 'iso-8859-2';
      $this->sc_charset['ISO-8859-3'] = 'iso-8859-3';
      $this->sc_charset['ISO-8859-4'] = 'iso-8859-4';
      $this->sc_charset['ISO-8859-5'] = 'iso-8859-5';
      $this->sc_charset['ISO-8859-6'] = 'iso-8859-6';
      $this->sc_charset['ISO-8859-7'] = 'iso-8859-7';
      $this->sc_charset['ISO-8859-8'] = 'iso-8859-8';
      $this->sc_charset['ISO-8859-8-I'] = 'iso-8859-8-i';
      $this->sc_charset['ISO-8859-9'] = 'iso-8859-9';
      $this->sc_charset['ISO-8859-10'] = 'iso-8859-10';
      $this->sc_charset['ISO-8859-13'] = 'iso-8859-13';
      $this->sc_charset['ISO-8859-14'] = 'iso-8859-14';
      $this->sc_charset['ISO-8859-15'] = 'iso-8859-15';
      $this->sc_charset['WINDOWS-1250'] = 'windows-1250';
      $this->sc_charset['WINDOWS-1251'] = 'windows-1251';
      $this->sc_charset['WINDOWS-1252'] = 'windows-1252';
      $this->sc_charset['TIS-620'] = 'tis-620';
      $this->sc_charset['WINDOWS-1253'] = 'windows-1253';
      $this->sc_charset['WINDOWS-1254'] = 'windows-1254';
      $this->sc_charset['WINDOWS-1255'] = 'windows-1255';
      $this->sc_charset['WINDOWS-1256'] = 'windows-1256';
      $this->sc_charset['WINDOWS-1257'] = 'windows-1257';
      $this->sc_charset['KOI8-R'] = 'koi8-r';
      $this->sc_charset['BIG-5'] = 'big5';
      $this->sc_charset['EUC-CN'] = 'EUC-CN';
      $this->sc_charset['GB18030'] = 'GB18030';
      $this->sc_charset['GB2312'] = 'gb2312';
      $this->sc_charset['EUC-JP'] = 'euc-jp';
      $this->sc_charset['SJIS'] = 'shift-jis';
      $this->sc_charset['EUC-KR'] = 'euc-kr';
      $_SESSION['scriptcase']['charset_entities']['UTF-8'] = 'UTF-8';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-1'] = 'ISO-8859-1';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-5'] = 'ISO-8859-5';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-15'] = 'ISO-8859-15';
      $_SESSION['scriptcase']['charset_entities']['WINDOWS-1251'] = 'cp1251';
      $_SESSION['scriptcase']['charset_entities']['WINDOWS-1252'] = 'cp1252';
      $_SESSION['scriptcase']['charset_entities']['BIG-5'] = 'BIG5';
      $_SESSION['scriptcase']['charset_entities']['EUC-CN'] = 'GB2312';
      $_SESSION['scriptcase']['charset_entities']['GB2312'] = 'GB2312';
      $_SESSION['scriptcase']['charset_entities']['SJIS'] = 'Shift_JIS';
      $_SESSION['scriptcase']['charset_entities']['EUC-JP'] = 'EUC-JP';
      $_SESSION['scriptcase']['charset_entities']['KOI8-R'] = 'KOI8-R';
      $_SESSION['scriptcase']['trial_version'] = 'N';
      $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['decimal_db'] = "."; 
      $this->nm_cod_apl      = "Grafico_pais"; 
      $this->nm_nome_apl     = ""; 
      $this->nm_seguranca    = ""; 
      $this->nm_grupo        = "project_HOYY"; 
      $this->nm_grupo_versao = "1"; 
      $this->nm_autor        = "admin"; 
      $this->nm_script_by    = "netmake";
      $this->nm_script_type  = "PHP";
      $this->nm_versao_sc    = "v9"; 
      $this->nm_tp_lic_sc    = "demo"; 
      $this->nm_dt_criacao   = "20240205"; 
      $this->nm_hr_criacao   = "112233"; 
      $this->nm_autor_alt    = "admin"; 
      $this->nm_dt_ult_alt   = "20240205"; 
      $this->nm_hr_ult_alt   = "112306"; 
      $this->Apl_paginacao   = "PARCIAL"; 
      $temp_bug_list         = explode(" ", microtime()); 
      list($NM_usec, $NM_sec) = $temp_bug_list; 
      $this->nm_timestamp    = (float) $NM_sec; 
      $this->nm_app_version  = "1.0.0";
      $this->nm_tp_variance  = "P";
// 
// 
      $NM_dir_atual = getcwd();
      if (empty($NM_dir_atual))
      {
          $str_path_sys          = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
          $str_path_sys          = str_replace("\\", '/', $str_path_sys);
      }
      else
      {
          $sc_nm_arquivo         = explode("/", $_SERVER['PHP_SELF']);
          $str_path_sys          = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
      }
      $this->sc_site_ssl     = $this->appIsSsl();
      $this->sc_protocolo    = $this->sc_site_ssl ? 'https://' : 'http://';
      $this->sc_protocolo    = "";
      $this->path_prod       = $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_prod'];
      $this->path_conf       = $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_conf'];
      $this->path_imagens    = $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imagens'];
      $this->path_imag_temp  = $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp'];
      $this->path_cache  = $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_cache'];
      $this->path_doc        = $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_doc'];
      if (!isset($_SESSION['scriptcase']['str_lang']) || empty($_SESSION['scriptcase']['str_lang']))
      {
          $_SESSION['scriptcase']['str_lang'] = "es";
      }
      if (!isset($_SESSION['scriptcase']['str_conf_reg']) || empty($_SESSION['scriptcase']['str_conf_reg']))
      {
          $_SESSION['scriptcase']['str_conf_reg'] = "es_es";
      }
      $this->str_lang        = $_SESSION['scriptcase']['str_lang'];
      $this->str_conf_reg    = $_SESSION['scriptcase']['str_conf_reg'];
      if (!isset($_SESSION['scriptcase']['Grafico_pais']['save_session']['save_grid_state_session']))
      { 
          $_SESSION['scriptcase']['Grafico_pais']['save_session']['save_grid_state_session'] = false;
          $_SESSION['scriptcase']['Grafico_pais']['save_session']['data'] = '';
      } 
      $this->str_schema_all    = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_BlueBerry/Sc9_BlueBerry";
      if (isset($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['sub_cons_schema_all']))
      { 
         $this->str_schema_all    = $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['sub_cons_schema_all'];
         $this->str_schema_filter = $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['sub_cons_schema_filter'];
      } 
      $_SESSION['scriptcase']['erro']['str_schema'] = $this->str_schema_all . "_error.css";
      $_SESSION['scriptcase']['erro']['str_lang']   = $this->str_lang;
      $this->server          = (!isset($_SERVER['HTTP_HOST'])) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
      if (!isset($_SERVER['HTTP_HOST']) && isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80 && !$this->sc_site_ssl )
      {
          $this->server         .= ":" . $_SERVER['SERVER_PORT'];
      }
      $this->java_protocol   = ($this->sc_site_ssl) ? 'https://' : 'http://';
      $this->server_pdf      = $this->java_protocol . $this->server;
      $this->server          = "";
      $str_path_web          = $_SERVER['PHP_SELF'];
      $str_path_web          = str_replace("\\", '/', $str_path_web);
      $str_path_web          = str_replace('//', '/', $str_path_web);
      $this->root            = substr($str_path_sys, 0, -1 * strlen($str_path_web));
      $this->path_aplicacao  = substr($str_path_sys, 0, strrpos($str_path_sys, '/'));
      $this->path_aplicacao  = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/')) . '/Grafico_pais';
      $this->path_embutida   = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/') + 1);
      $this->path_aplicacao .= '/';
      $this->path_link       = substr($str_path_web, 0, strrpos($str_path_web, '/'));
      $this->path_link       = substr($this->path_link, 0, strrpos($this->path_link, '/')) . '/';
      $this->path_botoes     = $this->path_link . "_lib/img";
      $this->path_img_global = $this->path_link . "_lib/img";
      $this->path_img_modelo = $this->path_link . "_lib/img";
      $this->path_icones     = $this->path_link . "_lib/img";
      $this->path_imag_cab   = $this->path_link . "_lib/img";
      $this->path_help       = $this->path_link . "_lib/webhelp/";
      $this->path_font       = $this->root . $this->path_link . "_lib/font/";
      $this->path_btn        = $this->root . $this->path_link . "_lib/buttons/";
      $this->path_css        = $this->root . $this->path_link . "_lib/css/";
      $this->path_lib_php    = $this->root . $this->path_link . "_lib/lib/php";
      $this->path_lib_js     = $this->root . $this->path_link . "_lib/lib/js";
      $pos_path = strrpos($this->path_prod, "/");
      $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['path_grid_sv'] = $this->root . substr($this->path_prod, 0, $pos_path) . "/conf/grid_sv/";
      $this->path_lang       = "../_lib/lang/";
      $this->path_lang_js    = "../_lib/js/";
      $this->path_chart_theme = $this->root . $this->path_link . "_lib/chart/";
      $this->path_cep        = $this->path_prod . "/cep";
      $this->path_cor        = $this->path_prod . "/cor";
      $this->path_js         = $this->path_prod . "/lib/js";
      $this->path_libs       = $this->root . $this->path_prod . "/lib/php";
      $this->path_third      = $this->root . $this->path_prod . "/third";
      $this->path_secure     = $this->root . $this->path_prod . "/secure";
      $this->path_adodb      = $this->root . $this->path_prod . "/third/adodb";
      $_SESSION['scriptcase']['dir_temp'] = $this->root . $this->path_imag_temp;
      $this->Cmp_Sql_Time     = array();
      if (isset($_SESSION['scriptcase']['Grafico_pais']['session_timeout']['lang'])) {
          $this->str_lang = $_SESSION['scriptcase']['Grafico_pais']['session_timeout']['lang'];
      }
      elseif (!isset($_SESSION['scriptcase']['Grafico_pais']['actual_lang']) || $_SESSION['scriptcase']['Grafico_pais']['actual_lang'] != $this->str_lang) {
          $_SESSION['scriptcase']['Grafico_pais']['actual_lang'] = $this->str_lang;
          setcookie('sc_actual_lang_project_HOYY',$this->str_lang,'0','/');
      }
      $_SESSION['scriptcase']['fusioncharts_new'] = true;
      if (!isset($_SESSION['scriptcase']['phantomjs_charts']))
      {
          $_SESSION['scriptcase']['phantomjs_charts'] = @is_dir($this->path_third . '/phantomjs');
      }
      if (isset($_SESSION['scriptcase']['phantomjs_charts']))
      {
          $aTmpOS = $this->getRunningOS();
          $_SESSION['scriptcase']['phantomjs_charts'] = @is_dir($this->path_third . '/phantomjs/' . $aTmpOS['os']);
      }
      if (!class_exists('Services_JSON'))
      {
          include_once("Grafico_pais_json.php");
      }
      $this->SC_Link_View = (isset($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_Link_View'])) ? $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_Link_View'] : false;
      if (isset($_GET['SC_Link_View']) && !empty($_GET['SC_Link_View']) && is_numeric($_GET['SC_Link_View']))
      {
          if ($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['embutida'])
          {
              $this->SC_Link_View = true;
              $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_Link_View'] = true;
          }
      }
            if (isset($_POST['nmgp_opcao']) && 'ajax_check_file' == $_POST['nmgp_opcao'] ){
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_REQUEST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

    $out1_img_cache = $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp'] . $file_name;
    $orig_img = $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp']. '/'.basename($_POST['AjaxCheckImg']);
    copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$orig_img);
    echo $orig_img . '_@@NM@@_';
    if(file_exists($out1_img_cache)){
        echo $out1_img_cache;
        exit;
    }

         include_once("../_lib/lib/php/nm_trata_img.php");
            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            $sc_obj_img = new nm_trata_img($_SERVER['DOCUMENT_ROOT'].$out1_img_cache, true);

            if(!empty($img_width) && !empty($img_height)){
                $sc_obj_img->setWidth($img_width);
                $sc_obj_img->setHeight($img_height);
            }            $sc_obj_img->createImg($_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            echo $out1_img_cache;
               exit;
            }
    if (!$_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['embutida'])
    {
      if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "ajax_add_grid_search")
      {
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['grid_search_add']['cmp'] = $_POST['parm'];
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['grid_search_add']['seq'] = $_POST['seq'];
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['opcao'] = $_POST['origem'];
          $nmgp_opcao = $_POST['origem'];
      }
    }
      if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "ajax_save_ancor")
      {
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['ancor_save'] = $_POST['ancor_save'];
          $oJson = new Services_JSON();
          if ($_SESSION['scriptcase']['sem_session']) {
              unset($_SESSION['sc_session']);
          }
          exit;
      }
      if (isset($_SESSION['scriptcase']['user_logout']))
      {
          foreach ($_SESSION['scriptcase']['user_logout'] as $ind => $parms)
          {
              if (isset($_SESSION[$parms['V']]) && $_SESSION[$parms['V']] == $parms['U'])
              {
                  unset($_SESSION['scriptcase']['user_logout'][$ind]);
                  $nm_apl_dest = $parms['R'];
                  $dir = explode("/", $nm_apl_dest);
                  if (count($dir) == 1)
                  {
                      $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
                      $nm_apl_dest = $this->path_link . SC_dir_app_name($nm_apl_dest) . "/";
                  }
                  if (isset($_POST['nmgp_opcao']) && ($_POST['nmgp_opcao'] == "ajax_event" || $_POST['nmgp_opcao'] == "ajax_navigate"))
                  {
                      $this->Arr_result = array();
                      $this->Arr_result['redirInfo']['action']              = $nm_apl_dest;
                      $this->Arr_result['redirInfo']['target']              = $parms['T'];
                      $this->Arr_result['redirInfo']['metodo']              = "post";
                      $this->Arr_result['redirInfo']['script_case_init']    = $this->sc_page;
                      $oJson = new Services_JSON();
                      echo $oJson->encode($this->Arr_result);
                      exit;
                  }
?>
                  <html>
                  <body>
                  <form name="FRedirect" method="POST" action="<?php echo $nm_apl_dest; ?>" target="<?php echo $parms['T']; ?>">
                  </form>
                  <script>
                   document.FRedirect.submit();
                  </script>
                  </body>
                  </html>
<?php
                  exit;
              }
          }
      }
      global $under_dashboard, $dashboard_app, $own_widget, $parent_widget, $compact_mode, $remove_margin, $remove_border;
      if (!isset($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['under_dashboard']))
      {
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['under_dashboard'] = false;
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['dashboard_app']   = '';
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['own_widget']      = '';
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['parent_widget']   = '';
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['compact_mode']    = false;
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['remove_margin']   = false;
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['remove_border']   = false;
      }
      if (isset($_GET['under_dashboard']) && 1 == $_GET['under_dashboard'])
      {
          if (isset($_GET['own_widget']) && 'dbifrm_widget' == substr($_GET['own_widget'], 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['own_widget'] = $_GET['own_widget'];
              $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['under_dashboard'] = true;
              if (isset($_GET['dashboard_app'])) {
                  $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['dashboard_app'] = $_GET['dashboard_app'];
              }
              if (isset($_GET['parent_widget'])) {
                  $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['parent_widget'] = $_GET['parent_widget'];
              }
              if (isset($_GET['compact_mode'])) {
                  $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['compact_mode'] = 1 == $_GET['compact_mode'];
              }
              if (isset($_GET['remove_margin'])) {
                  $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['remove_margin'] = 1 == $_GET['remove_margin'];
              }
              if (isset($_GET['remove_border'])) {
                  $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['remove_border'] = 1 == $_GET['remove_border'];
              }
          }
      }
      elseif (isset($under_dashboard) && 1 == $under_dashboard)
      {
          if (isset($own_widget) && 'dbifrm_widget' == substr($own_widget, 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['own_widget'] = $own_widget;
              $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['under_dashboard'] = true;
              if (isset($dashboard_app)) {
                  $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['dashboard_app'] = $dashboard_app;
              }
              if (isset($parent_widget)) {
                  $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['parent_widget'] = $parent_widget;
              }
              if (isset($compact_mode)) {
                  $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['compact_mode'] = 1 == $compact_mode;
              }
              if (isset($remove_margin)) {
                  $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['remove_margin'] = 1 == $remove_margin;
              }
              if (isset($remove_border)) {
                  $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['remove_border'] = 1 == $remove_border;
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['maximized'] = false;
      }
      if (isset($_GET['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['maximized'] = 1 == $_GET['maximized'];
      }
      if ($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['under_dashboard'])
      {
          $sTmpDashboardApp = $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['dashboard_app'];
          if ('' != $sTmpDashboardApp && isset($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["Grafico_pais"]))
          {
              foreach ($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["Grafico_pais"] as $sTmpTargetLink => $sTmpTargetWidget)
              {
                  if (isset($this->sc_lig_target[$sTmpTargetLink]))
                  {
                      $this->sc_lig_target[$sTmpTargetLink] = $sTmpTargetWidget;
                  }
              }
          }
      }
        global $link_compact_mode, $link_remove_margin, $link_remove_border;
        if (isset($link_compact_mode) && 'ok' == $link_compact_mode) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['link_info']['compact_mode'] = true;
        }
        if (isset($link_remove_margin) && 'ok' == $link_remove_margin) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['link_info']['remove_margin'] = true;
        }
        if (isset($link_remove_border) && 'ok' == $link_remove_border) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['link_info']['remove_border'] = true;
        }

      if (!isset($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['responsive_chart']))
      {
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['responsive_chart'] = array(
              'enabled' => true,
              'active'  => true,
          );
      }
      if ($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['responsive_chart']['enabled'])
      {
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['responsive_chart']['active'] = true;
      }
      elseif ($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['dashboard_info']['maximized'])
      {
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['responsive_chart']['active'] = true;
      }
      else
      {
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['responsive_chart']['active'] = false;
      }
      if ($Tp_init == "Path_sub")
      {
          return;
      }
      $str_path = substr($this->path_prod, 0, strrpos($this->path_prod, '/') + 1);
      if (!is_file($this->root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
      {
          unset($_SESSION['scriptcase']['nm_sc_retorno']);
          unset($_SESSION['scriptcase']['Grafico_pais']['glo_nm_conexao']);
      }
      include($this->path_lang . $this->str_lang . ".lang.php");
      include($this->path_lang . "config_region.php");
      include($this->path_lang . "lang_config_region.php");
      asort($this->Nm_lang_conf_region);
      $_SESSION['scriptcase']['charset']  = "UTF-8";
      ini_set('default_charset', $_SESSION['scriptcase']['charset']);
      $_SESSION['scriptcase']['charset_html']  = (isset($this->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
      if (!function_exists("mb_convert_encoding"))
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_xtmb'] . "</font></div>";exit;
      } 
      elseif (!function_exists("sc_convert_encoding"))
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_xtsc'] . "</font></div>";exit;
      } 
      foreach ($this->Nm_lang_conf_region as $ind => $dados)
      {
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
         {
             $this->Nm_lang_conf_region[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
      }
      foreach ($this->Nm_conf_reg[$this->str_conf_reg] as $ind => $dados)
      {
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
         {
             $this->Nm_conf_reg[$this->str_conf_reg][$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
      }
      foreach ($this->Nm_lang as $ind => $dados)
      {
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($ind))
         {
             $ind = sc_convert_encoding($ind, $_SESSION['scriptcase']['charset'], "UTF-8");
             $this->Nm_lang[$ind] = $dados;
         }
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
         {
             $this->Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
      }
      $_SESSION['sc_session']['SC_download_violation'] = $this->Nm_lang['lang_errm_fnfd'];
      if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['Grafico_pais']['session_timeout']['redir']))
      {
          unset($_SESSION['sc_session']['SC_parm_violation']);
          echo "<html>";
          echo "<body>";
          echo "<table align=\"center\" width=\"50%\" border=1 height=\"50px\">";
          echo "<tr>";
          echo "   <td align=\"center\">";
          echo "       <b><font size=4>" . $this->Nm_lang['lang_errm_ajax_data'] . "</font>";
          echo "   </b></td>";
          echo " </tr>";
          echo "</table>";
          echo "</body>";
          echo "</html>";
          exit;
      }
      if (isset($this->Nm_lang['lang_errm_dbcn_conn']))
      {
          $_SESSION['scriptcase']['db_conn_error'] = $this->Nm_lang['lang_errm_dbcn_conn'];
      }
      $PHP_ver = str_replace(".", "", phpversion()); 
      if (substr($PHP_ver, 0, 3) < 434)
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_phpv'] . "</font></div>";exit;
      } 
      if (file_exists($this->path_libs . "/ver.dat"))
      {
          $SC_ver = file($this->path_libs . "/ver.dat"); 
          $SC_ver = str_replace(".", "", $SC_ver[0]); 
          if (substr($SC_ver, 0, 5) < 40015)
          {
              echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_incp'] . "</font></div>";exit;
          } 
      } 
      $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['path_doc'] = $this->path_doc; 
      $_SESSION['scriptcase']['nm_path_prod'] = $this->root . $this->path_prod . "/"; 
      if (empty($this->path_imag_cab))
      {
          $this->path_imag_cab = $this->path_img_global;
      }
      if (!is_dir($this->root . $this->path_prod))
      {
         $str_message = "<html>

<head>
    <title>{var_str_title}</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
            min-width: 320px;
            background: #FFFFFF;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            font-smoothing: antialiased;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        user agent stylesheet body {
            display: block;
            margin: 8px;
        }

        html {
            font-size: 14px;
        }

        html {
            line-height: 1.15;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        ::selection {
            background-color: #CCE2FF;
            color: rgba(0, 0, 0, 0.87);
        }

        .ui.container {
            width: 933px;
            min-width: 992px;
            max-width: 1199px;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .ui.container {
            display: block;
            max-width: 100% !important;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message:last-child {
            margin-bottom: 0em;
        }

        .ui.message:first-child {
            margin-top: 0em;
        }

        .ui.message {
            font-size: 1em;
        }

        .ui.message {
            position: relative;
            min-height: 1em;
            margin: 1em 0em;
            background: #F8F8F9;
            padding: 1em 1.5em;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            transition: opacity 0.1s ease, color 0.1s ease, background 0.1s ease, box-shadow 0.1s ease;
            border-radius: 0.28571429rem;
            box-shadow: 0px 0px 0px 1px rgba(34, 36, 38, 0.22) inset, 0px 0px 0px 0px rgba(0, 0, 0, 0);
        }

        article,
        aside,
        footer,
        header,
        nav,
        section {
            display: block;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message> :last-child {
            margin-bottom: 0em;
        }

        .ui.message> :first-child {
            margin-top: 0em;
        }

        .ui.message .header+p {
            margin-top: 0.25em;
        }

        .ui.message p {
            opacity: 0.85;
            margin: 0.75em 0em;
        }

        p {
            margin: 0em 0em 1em;
            line-height: 1.4285em;
        }

        .ui.message .header:not(.ui) {
            font-size: 1.14285714em;
        }

        .ui.message .header {
            display: block;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-weight: bold;
            margin: -0.14285714em 0em 1.2rem 0em;
        }

        .ui.button {
            cursor: pointer;
            display: inline-block;
            min-height: 1em;
            outline: 0;
            border: none;
            vertical-align: baseline;
            background: #e0e1e2 none;
            color: rgba(0, 0, 0, .6);
            font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
            margin: 0 .25em 0 0;
            padding: .78571429em 1.5em .78571429em;
            text-transform: none;
            text-shadow: none;
            font-weight: 700;
            line-height: 1em;
            font-style: normal;
            text-align: center;
            text-decoration: none;
            border-radius: .28571429rem;
            box-shadow: 0 0 0 1px transparent inset, 0 0 0 0 rgba(34, 36, 38, .15) inset;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            transition: opacity .1s ease, background-color .1s ease, color .1s ease, box-shadow .1s ease, background .1s ease;
            will-change: '';
            -webkit-tap-highlight-color: transparent;
        }
        
        .ui.button,
        .ui.buttons .button,
        .ui.buttons .or {
            font-size: 1rem;
            flex-flow: row nowrap;
            justify-content: center;
            align-items: center;
            column-gap: .5rem;
            display: flex;
        }
        
        .ui.primary.button,
        .ui.primary.buttons .button {
            background-color: #2185d0;
            color: #fff;
            text-shadow: none;
            background-image: none;
        }
        
        .ui.primary.button {
            box-shadow: 0 0 0 0 rgba(34, 36, 38, .15) inset;
        }

        [type=reset], [type=submit], button, html [type=button] {
            -webkit-appearance: button;
        }

        .icon{
            position: relative;
            width: 1.2rem;
            height: 1.2rem;
            display: block;
            color: inherit;
            background-repeat: no-repeat;
        }

        .icon.database{
            background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\" fill=\"%23FFFFFF\"><path d=\"M448 80v48c0 44.2-100.3 80-224 80S0 172.2 0 128V80C0 35.8 100.3 0 224 0S448 35.8 448 80zM393.2 214.7c20.8-7.4 39.9-16.9 54.8-28.6V288c0 44.2-100.3 80-224 80S0 332.2 0 288V186.1c14.9 11.8 34 21.2 54.8 28.6C99.7 230.7 159.5 240 224 240s124.3-9.3 169.2-25.3zM0 346.1c14.9 11.8 34 21.2 54.8 28.6C99.7 390.7 159.5 400 224 400s124.3-9.3 169.2-25.3c20.8-7.4 39.9-16.9 54.8-28.6V432c0 44.2-100.3 80-224 80S0 476.2 0 432V346.1z\"/></svg>');
        }
    </style>
</head>

<body>
    <div class='ui container' style='padding-top:2rem'>
        <section class='ui message'>
            <div class='content'>
                <div class='header'>
                    <h1 class='ui header'>{var_str_title}</h1>
                </div>
                <p>{var_str_message}</p>
                <p>{var_str_message_conn}</p>
                {v_str_btn_inside}
            </div>
        </section>
    </div>";
         $str_message_end = "</body>
</html>";
         $str_message = str_replace('{var_str_title}', $this->Nm_lang['lang_errm_cmlb_nfndtitle'], $str_message);
         $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_cmlb_nfnd'], $str_message);
          $str_message = str_replace('{var_str_message_conn}','', $str_message);
         $str_message = str_replace('{v_str_btn_inside}', '', $str_message);
         echo $str_message;
          if (!$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_outra_jan'])) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_back'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_back_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $_SESSION['scriptcase']['nm_sc_retorno'] ?>'; return false" class="scButton_default" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
              else 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_exit'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_exit_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $nm_url_saida ?>'; return false" class="scButton_danger" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
          } 
          echo $str_message_end;
          exit ;
      }

      $this->nm_ger_css_emb = true;
      $this->Control_Css    = "coo";
      $this->path_atual     = getcwd();
      $opsys = strtolower(php_uname());

      $this->nm_cont_lin           = 0;
      $this->nm_limite_lin         = 0;
      $this->nm_limite_lin_prt     = 0;
      $this->nm_limite_lin_res     = 0;
      $this->nm_limite_lin_res_prt = 0;
// 
      include_once($this->path_aplicacao . "Grafico_pais_erro.class.php"); 
      $this->Erro = new Grafico_pais_erro();
      include_once($this->path_adodb . "/adodb.inc.php"); 
      $this->sc_Include($this->path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod") ; 
      $this->sc_Include($this->path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
// 
 if(function_exists('set_php_timezone')) set_php_timezone('Grafico_pais'); 
// 
      $this->sc_Include($this->path_lib_php . "/nm_functions.php", "", "") ; 
      $this->sc_Include($this->path_lib_php . "/nm_api.php", "", "") ; 
      $this->sc_Include($this->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      $this->sc_Include($this->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->sc_Include($this->path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
      $this->nm_data = new nm_data("es");
      if (is_file("../_lib/css/" . $this->str_schema_all . "_grid.php")) {
          include("../_lib/css/" . $this->str_schema_all . "_grid.php");
      } else {
          $str_tree_col = "";
          $str_tree_exp = "";
          $str_button   = "";
      }
      $this->Color_bg_ajax = (!isset($str_ajax_bg)       || "" == trim($str_ajax_bg))       ? "#000" : $str_ajax_bg;
      $this->Border_c_ajax = (!isset($str_ajax_border_c) || "" == trim($str_ajax_border_c)) ? ""     : $str_ajax_border_c;
      $this->Border_s_ajax = (!isset($str_ajax_border_s) || "" == trim($str_ajax_border_s)) ? ""     : $str_ajax_border_s;
      $this->Border_w_ajax = (!isset($str_ajax_border_w) || "" == trim($str_ajax_border_w)) ? ""     : $str_ajax_border_w;
      $this->Tree_img_col    = trim($str_tree_col);
      $this->Tree_img_exp    = trim($str_tree_exp);
      $this->scGridRefinedSearchExpandFAIcon    = trim($scGridRefinedSearchExpandFAIcon);
      $this->scGridRefinedSearchCollapseFAIcon    = trim($scGridRefinedSearchCollapseFAIcon);
      $this->Tree_img_type   = "kie";
      $_SESSION['scriptcase']['nmamd'] = array();
      perfil_lib($this->path_libs);
      if (!isset($_SESSION['sc_session'][$this->sc_page]['SC_Check_Perfil']))
      {
          if(function_exists("nm_check_perfil_exists")) nm_check_perfil_exists($this->path_libs, $this->path_prod);
          $_SESSION['sc_session'][$this->sc_page]['SC_Check_Perfil'] = true;
      }
      if (function_exists("nm_check_pdf_server")) $this->server_pdf = nm_check_pdf_server($this->path_libs, $this->server_pdf);
      if (!isset($_SESSION['scriptcase']['sc_num_img']))
      { 
          $_SESSION['scriptcase']['sc_num_img'] = 1;
      } 
      $this->str_google_fonts= isset($str_google_fonts)?$str_google_fonts:'';
      $this->regionalDefault();
      $this->Str_btn_grid    = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Str_btn_css     = trim($str_button) . "/" . trim($str_button) . ".css";
      if (is_file($this->path_btn . $this->Str_btn_grid)) {
          include($this->path_btn . $this->Str_btn_grid);
      }
      $_SESSION['scriptcase']['erro']['str_schema_dir'] = $this->str_schema_all . "_error" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $this->sc_tem_trans_banco = false;
      if (isset($_SESSION['scriptcase']['Grafico_pais']['session_timeout']['redir'])) {
          $SS_cod_html  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">';
          $SS_cod_html .= "<HTML>\r\n";
          $SS_cod_html .= " <HEAD>\r\n";
          $SS_cod_html .= "  <TITLE></TITLE>\r\n";
          $SS_cod_html .= "   <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\"/>\r\n";
          if ($_SESSION['scriptcase']['proc_mobile']) {
              $SS_cod_html .= "   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\"/>\r\n";
          }
          $SS_cod_html .= "   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n";
          $SS_cod_html .= "    <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n";
          if ($_SESSION['scriptcase']['Grafico_pais']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "  </HEAD>\r\n";
              $SS_cod_html .= "   <body>\r\n";
          }
          else {
              $SS_cod_html .= "    <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n";
              $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_grid.css\"/>\r\n";
              $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\"/>\r\n";
              $SS_cod_html .= "  </HEAD>\r\n";
              $SS_cod_html .= "   <body class=\"scGridPage\">\r\n";
              $SS_cod_html .= "    <table align=\"center\"><tr><td style=\"padding: 0\"><div class=\"scGridBorder\">\r\n";
              $SS_cod_html .= "    <table class=\"scGridTabela\" width='100%' cellspacing=0 cellpadding=0><tr class=\"scGridFieldOdd\"><td class=\"scGridFieldOddFont\" style=\"padding: 15px 30px; text-align: center\">\r\n";
              $SS_cod_html .= $this->Nm_lang['lang_errm_expired_session'] . "\r\n";
              $SS_cod_html .= "     <form name=\"Fsession_redir\" method=\"post\"\r\n";
              $SS_cod_html .= "           target=\"_self\">\r\n";
              $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['Grafico_pais']['session_timeout']['redir'] . "');\">\r\n";
              $SS_cod_html .= "     </form>\r\n";
              $SS_cod_html .= "    </td></tr></table>\r\n";
              $SS_cod_html .= "    </div></td></tr></table>\r\n";
          }
          $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
          if ($_SESSION['scriptcase']['Grafico_pais']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['Grafico_pais']['session_timeout']['redir'] . "');\r\n";
          }
          $SS_cod_html .= "      function sc_session_redir(url_redir)\r\n";
          $SS_cod_html .= "      {\r\n";
          $SS_cod_html .= "         if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')\r\n";
          $SS_cod_html .= "         {\r\n";
          $SS_cod_html .= "            window.parent.sc_session_redir(url_redir);\r\n";
          $SS_cod_html .= "         }\r\n";
          $SS_cod_html .= "         else\r\n";
          $SS_cod_html .= "         {\r\n";
          $SS_cod_html .= "             if (window.opener && typeof window.opener.sc_session_redir === 'function')\r\n";
          $SS_cod_html .= "             {\r\n";
          $SS_cod_html .= "                 window.close();\r\n";
          $SS_cod_html .= "                 window.opener.sc_session_redir(url_redir);\r\n";
          $SS_cod_html .= "             }\r\n";
          $SS_cod_html .= "             else\r\n";
          $SS_cod_html .= "             {\r\n";
          $SS_cod_html .= "                 window.location = url_redir;\r\n";
          $SS_cod_html .= "             }\r\n";
          $SS_cod_html .= "         }\r\n";
          $SS_cod_html .= "      }\r\n";
          $SS_cod_html .= "    </script>\r\n";
          $SS_cod_html .= " </body>\r\n";
          $SS_cod_html .= "</HTML>\r\n";
          unset($_SESSION['scriptcase']['Grafico_pais']['session_timeout']);
          unset($_SESSION['sc_session']);
      }
      if (isset($SS_cod_html) && isset($_GET['nmgp_opcao']) && (substr($_GET['nmgp_opcao'], 0, 14) == "ajax_aut_comp_" || substr($_GET['nmgp_opcao'], 0, 13) == "ajax_autocomp"))
      {
          unset($_SESSION['sc_session']);
          $oJson = new Services_JSON();
          echo $oJson->encode("ss_time_out");
          exit;
      }
      elseif (isset($SS_cod_html) && ((isset($_POST['nmgp_opcao']) && substr($_POST['nmgp_opcao'], 0, 5) == "ajax_") || (isset($_GET['nmgp_opcao']) && substr($_GET['nmgp_opcao'], 0, 5) == "ajax_")))
      {
          unset($_SESSION['sc_session']);
          $this->Arr_result = array();
          $this->Arr_result['ss_time_out'] = true;
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
      elseif (isset($SS_cod_html))
      {
          echo $SS_cod_html;
          exit;
      }
      $this->nm_bases_access     = array("access", "ado_access", "ace_access");
      $this->nm_bases_db2        = array("db2", "db2_odbc", "odbc_db2", "odbc_db2v6", "pdo_db2_odbc", "pdo_ibm");
      $this->nm_bases_ibase      = array("ibase", "firebird", "pdo_firebird", "borland_ibase");
      $this->nm_bases_informix   = array("informix", "informix72", "pdo_informix");
      $this->nm_bases_mssql      = array("mssql", "ado_mssql", "adooledb_mssql", "odbc_mssql", "mssqlnative", "pdo_sqlsrv", "pdo_dblib", "azure_mssql", "azure_ado_mssql", "azure_adooledb_mssql", "azure_odbc_mssql", "azure_mssqlnative", "azure_pdo_sqlsrv", "azure_pdo_dblib", "googlecloud_mssql", "googlecloud_ado_mssql", "googlecloud_adooledb_mssql", "googlecloud_odbc_mssql", "googlecloud_mssqlnative", "googlecloud_pdo_sqlsrv", "googlecloud_pdo_dblib", "amazonrds_mssql", "amazonrds_ado_mssql", "amazonrds_adooledb_mssql", "amazonrds_odbc_mssql", "amazonrds_mssqlnative", "amazonrds_pdo_sqlsrv", "amazonrds_pdo_dblib");
      $this->nm_bases_mysql      = array("mysql", "mysqlt", "mysqli", "maxsql", "pdo_mysql", "azure_mysql", "azure_mysqlt", "azure_mysqli", "azure_maxsql", "azure_pdo_mysql", "googlecloud_mysql", "googlecloud_mysqlt", "googlecloud_mysqli", "googlecloud_maxsql", "googlecloud_pdo_mysql", "amazonrds_mysql", "amazonrds_mysqlt", "amazonrds_mysqli", "amazonrds_maxsql", "amazonrds_pdo_mysql");
      $this->nm_bases_postgres   = array("postgres", "postgres64", "postgres7", "pdo_pgsql", "azure_postgres", "azure_postgres64", "azure_postgres7", "azure_pdo_pgsql", "googlecloud_postgres", "googlecloud_postgres64", "googlecloud_postgres7", "googlecloud_pdo_pgsql", "amazonrds_postgres", "amazonrds_postgres64", "amazonrds_postgres7", "amazonrds_pdo_pgsql");
      $this->nm_bases_oracle     = array("oci8", "oci805", "oci8po", "odbc_oracle", "oracle", "pdo_oracle", "oraclecloud_oci8", "oraclecloud_oci805", "oraclecloud_oci8po", "oraclecloud_odbc_oracle", "oraclecloud_oracle", "oraclecloud_pdo_oracle", "amazonrds_oci8", "amazonrds_oci805", "amazonrds_oci8po", "amazonrds_odbc_oracle", "amazonrds_oracle", "amazonrds_pdo_oracle");
      $this->sqlite_version      = "old";
      $this->nm_bases_sqlite     = array("sqlite", "sqlite3", "pdosqlite");
      $this->nm_bases_sybase     = array("sybase", "pdo_sybase_odbc", "pdo_sybase_dblib");
      $this->nm_bases_vfp        = array("vfp");
      $this->nm_bases_odbc       = array("odbc");
      $this->nm_bases_progress     = array("pdo_progress_odbc", "progress");
      $this->nm_bases_all        = array_merge($this->nm_bases_access, $this->nm_bases_db2, $this->nm_bases_ibase, $this->nm_bases_informix, $this->nm_bases_mssql, $this->nm_bases_mysql, $this->nm_bases_postgres, $this->nm_bases_oracle, $this->nm_bases_sqlite, $this->nm_bases_sybase, $this->nm_bases_vfp, $this->nm_bases_odbc, $this->nm_bases_progress);
      $this->nm_font_ttf = array("ar", "ja", "pl", "ru", "sk", "thai", "zh_cn", "zh_hk", "cz", "el", "ko", "mk");
      $this->nm_ttf_arab = array("ar");
      $this->nm_ttf_jap  = array("ja");
      $this->nm_ttf_rus  = array("pl", "ru", "sk", "cz", "el", "mk");
      $this->nm_ttf_thai = array("thai");
      $this->nm_ttf_chi  = array("zh_cn", "zh_hk", "ko");
      $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['seq_dir'] = 0; 
      $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['sub_dir'] = array(); 
      $_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1HQXODQX7Z1N7VWJeHuvmDkBsDWXKDoXGDcNwH9B/HANOV5FaHgrKZSJqDWXCDoBqD9NwDQJwHAN7D5F7DMvmVcFKV5BmVoBqD9BsZkFGHAvsD5XGHgBeHEFiV5B3DoF7D9XsDuFaHANKVWBqDMBYVcFeDur/VoBiHQNmZ1FGD1vsZMXGHgNOHEJqDuFaZuB/D9FYDQX7DSN7HQJeHgvsVIBODWFaHMBiD9BsVIraD1rwV5X7HgBeHEFiH5F/VoB/D9XsDQX7Z1rwHuFaHuNOZSrCH5FqDoXGHQJmZ1FUZ1BeHQNUDErKVkXeDWX7VoBOD9JKDQX7D1BeV5JwHgrYDkFCDWXCVoB/D9JmZ1FaD1NaV5FUDErKHEFiDuJeDoBOHQJKDQJsZ1vCV5FGHuNOV9FeDWXCHMB/D9JmZSBOD1rwHQBiHgvsZSXeH5FGZuBOD9NwZSX7DSrwHQrqHgrwDkFCDWF/HIXGD9XOZkFGHArKV5FUDMrYZSXeV5FqHIJsHQNmDuBqDSN7HuXGDMzGDkB/DWFYHINUHQBsVIraZ1rYHQX7DMvCZSJ3DWFGZuJeHQNmDQBOZ1zGVWBqDMBOVcBUH5XCVoBiHQNwVIJwZ1rYHQX7HgrKVkJqDWF/HIXGDcXGZ9JeD1BeD5rqHuvmVcBOH5B7VoBqHQXOZ1BiDSNOHQFaHgNKHErsDuXKDoJeHQNwZ9rqZ1BYHQrqDMBYVcFeDuFqHIX7HQXOZ1FUZ1rYHQFaHgNKHErCDWr/HMFaHQXsZ9JeZ1BYHuBODMvsVcFeHEX7HMXGHQBsZkFUD1rwV5FGDEBeHEXeH5X/DoF7HQNwDuBqDSN7HQB/DMzGVIBsDWJeHIrqHQBiVIraZ1rYD5JwDMveHErsDWB3ZuJeHQJKZ9JeZ1BYHuraHgrwVcXKDurGVEX7HQBqZkFUZ1rYHuFGHgNKHArCDuFaHIBqHQNwDQBOD1BeD5rqHuvmVcBOH5B7VoBqD9XOH9B/D1rwD5BiDErKHEFiDWX7ZuFaD9JKDQB/Z1rwHuNUDMvsZSrCV5X7HIXGHQJmH9BOHAN7HQrqHgNOHENiH5F/HIFGHQJKDQFUD1BeHuraDMrwDkFCDuX7VEF7D9BiH9FaHAN7D5FaDEBOZSJGH5BmDoB/D9NwZSX7D1BeV5BOHuvmVcFCDWXCVENUDcBqH9B/HABYD5JeDMzGHAFKV5XKDoF7D9XsDQJsDSBYV5FGHgNKDkFCH5FqVoBqDcNwH9B/HIveD5FaDErKZSJGH5F/DoFUHQXsDQFaHABYHQF7DMzGDkB/H5XCHIFGHQXGZ1FUZ1rYHQrqHgNOHErCH5X/ZuB/HQNwZSBiZ1rwHQFaDMvmVcFKV5BmVoBqD9BsZkFGHAvsD5XGHgveHErsDWrGZuFaHQBiDQBqHAvmV5JeDMrYV9FeDWXCDoJsDcBwH9B/Z1rYHQJwDMBYZSXeDuX/DoBODcJeZSFUZ1rwVWBqHgvOVIFCH5XCHIJsDcNwH9BqHArKV5FUDMrYZSXeV5FqHIJsDcBwDQJsHABYD5F7HuNODkBsDWXCDoJsDcBwH9B/Z1rYHQJwHgBYHAFKV5B3DoBO";
      $this->prep_conect();
      $this->conectDB();
      if (!in_array(strtolower($this->nm_tpbanco), $this->nm_bases_all))
      {
          echo "<tr>";
          echo "   <td bgcolor=\"\">";
          echo "       <b><font size=\"4\">" . $this->Nm_lang['lang_errm_dbcn_nspt'] . "</font>";
          echo "  " . $perfil_trab;
          echo "   </b></td>";
          echo " </tr>";
          echo "</table>";
          if (!$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_outra_jan'])) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
                  echo "<a href='" . $_SESSION['scriptcase']['nm_sc_retorno'] . "' target='_self'><img border='0' src='" . $this->path_botoes . "/nm_scriptcase9_BlueBerry_bvoltar.gif' title='" . $this->Nm_lang['lang_btns_rtrn_scrp_hint'] . "' align=absmiddle></a> \n" ; 
              } 
              else 
              { 
                  echo "<a href='$nm_url_saida' target='_self'><img border='0' src='" . $this->path_botoes . "/nm_scriptcase9_BlueBerry_bsair.gif' title='" . $this->Nm_lang['lang_btns_exit_appl_hint'] . "' align=absmiddle></a> \n" ; 
              } 
          } 
          exit ;
      } 
      if (empty($this->nm_tabela))
      {
          $this->nm_tabela = "pais"; 
      }
      $this->Nm_accent_access    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_db2       = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_ibase     = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_informix  = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_mssql     = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_mysql     = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_postgres  = array('cmp_i'=>"unaccent(",'cmp_f'=>")",'cmp_apos'=>"",'arg_i'=>"' || unaccent('",'arg_f'=>"') || '",'arg_apos'=>"");
      $this->Nm_accent_oracle    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_sqlite    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_sybase    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_vfp       = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_odbc      = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_progress  = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");

      $this->Nm_accent_no = array('cmp_i'=>'','cmp_f'=>'','cmp_apos'=>'','arg_i'=>'','arg_f'=>'','arg_apos'=>'');
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_access)) {
          $this->Nm_accent_yes = $this->Nm_accent_access;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_db2)) {
          $this->Nm_accent_yes = $this->Nm_accent_db2;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_ibase)) {
          $this->Nm_accent_yes = $this->Nm_accent_ibase;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_informix)) {
          $this->Nm_accent_yes = $this->Nm_accent_informix;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mssql)) {
          $this->Nm_accent_yes = $this->Nm_accent_mssql;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
          $this->Nm_accent_yes = $this->Nm_accent_mysql;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_postgres)) {
          $this->Nm_accent_yes = $this->Nm_accent_postgres;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_oracle)) {
          $this->Nm_accent_yes = $this->Nm_accent_oracle;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
          $this->Nm_accent_yes = $this->Nm_accent_sqlite;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sybase)) {
          $this->Nm_accent_yes = $this->Nm_accent_sybase;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_vfp)) {
          $this->Nm_accent_yes = $this->Nm_accent_vfp;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_odbc)) {
          $this->Nm_accent_yes = $this->Nm_accent_odbc;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_progress)) {
          $this->Nm_accent_yes = $this->Nm_accent_progress;
      }
      else {
          $this->Nm_accent_yes = $this->Nm_accent_no;
      }
   }

   function getRunningOS()
   {
       $aOSInfo = array();

       if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
       {
           $aOSInfo['os'] = 'win';
       }
       elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
       {
           $aOSInfo['os'] = 'linux-i386';
           if(strpos(strtolower(php_uname()), 'x86_64') !== FALSE) 
            {
               $aOSInfo['os'] = 'linux-amd64';
            }
       }
       elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
       {
           $aOSInfo['os'] = 'macos';
       }

       return $aOSInfo;
   }

   function prep_conect()
   {
      if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
      {
          foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
          {
              if (isset($_SESSION['scriptcase']['Grafico_pais']['glo_nm_conexao']) && $_SESSION['scriptcase']['Grafico_pais']['glo_nm_conexao'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['Grafico_pais']['glo_nm_conexao'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['Grafico_pais']['glo_nm_perfil']) && $_SESSION['scriptcase']['Grafico_pais']['glo_nm_perfil'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['Grafico_pais']['glo_nm_perfil'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['Grafico_pais']['glo_con_' . $NM_con_orig]))
              {
                  $_SESSION['scriptcase']['Grafico_pais']['glo_con_' . $NM_con_orig] = $NM_con_dest;
              }
          }
      }
      $con_devel             = (isset($_SESSION['scriptcase']['Grafico_pais']['glo_nm_conexao'])) ? $_SESSION['scriptcase']['Grafico_pais']['glo_nm_conexao'] : ""; 
      $perfil_trab           = ""; 
      $this->nm_falta_var    = ""; 
      $this->nm_falta_var_db = ""; 
      $nm_crit_perfil        = false;
      if (isset($_SESSION['scriptcase']['Grafico_pais']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['Grafico_pais']['glo_nm_conexao']))
      {
          if (!isset($_GET['nmgp_opcao']) || ('pdf' != $_GET['nmgp_opcao'] && 'pdf_res' != $_GET['nmgp_opcao'])) {
              ob_start();
          } else {
              @ini_set('zlib.output_compression',0);
              $bufferSize = @ini_get('output_buffering');
              if ('' != $bufferSize) {
                  $bufferSize = min($bufferSize * 10, 65536);
                  echo str_repeat('&nbsp;', $bufferSize);
              }
              
          }
          db_conect_devel($con_devel, $this->root . $this->path_prod, 'project_HOYY', 2, $this->force_db_utf8); 
          if (!isset($this->Ajax_result_set)) {$this->Ajax_result_set = ob_get_contents();}
          ob_end_clean();
          if (empty($_SESSION['scriptcase']['glo_tpbanco']) && empty($_SESSION['scriptcase']['glo_banco']))
          {
              $nm_crit_perfil = true;
          }
      }
      if (isset($_SESSION['scriptcase']['Grafico_pais']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['Grafico_pais']['glo_nm_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['Grafico_pais']['glo_nm_perfil'];
      }
      elseif (isset($_SESSION['scriptcase']['glo_perfil']) && !empty($_SESSION['scriptcase']['glo_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['glo_perfil'];
      }
      if (!empty($perfil_trab))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($perfil_trab, $this->path_libs, "S", $this->path_conf);
          if (empty($_SESSION['scriptcase']['glo_senha_protect']))
          {
              $nm_crit_perfil = true;
          }
      }
      else
      {
          $perfil_trab = $con_devel;
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['embutida_init']) || !$_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['embutida_init']) 
      {
      }
// 
      if (!isset($_SESSION['scriptcase']['glo_tpbanco']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_tpbanco; ";
          }
      }
      else
      {
          $this->nm_tpbanco = $_SESSION['scriptcase']['glo_tpbanco']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_servidor']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_servidor; ";
          }
      }
      else
      {
          $this->nm_servidor = $_SESSION['scriptcase']['glo_servidor']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_banco']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_banco; ";
          }
      }
      else
      {
          $this->nm_banco = $_SESSION['scriptcase']['glo_banco']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_usuario']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_usuario; ";
          }
      }
      else
      {
          $this->nm_usuario = $_SESSION['scriptcase']['glo_usuario']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_senha']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_senha; ";
          }
      }
      else
      {
          $this->nm_senha = $_SESSION['scriptcase']['glo_senha']; 
      }
      if (isset($_SESSION['scriptcase']['glo_database_encoding']))
      {
          $this->nm_database_encoding = $_SESSION['scriptcase']['glo_database_encoding']; 
      }
      $this->nm_arr_db_extra_args = array(); 
      if (isset($_SESSION['scriptcase']['glo_use_ssl']))
      {
          $this->nm_arr_db_extra_args['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_encrypt']))
      {
          $this->nm_arr_db_extra_args['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
      {
          $this->nm_arr_db_extra_args['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_truststore']))
      {
          $this->nm_arr_db_extra_args['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
      {
          $this->nm_arr_db_extra_args['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
      {
          $this->nm_arr_db_extra_args['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_autocommit']))
      {
          $this->nm_con_db2['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']))
      {
          $this->nm_con_db2['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']))
      {
          $this->nm_con_db2['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']))
      {
          $this->nm_con_db2['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_i5_query_optimize']))
      {
          $this->nm_con_db2['db2_i5_query_optimize'] = $_SESSION['scriptcase']['glo_db2_i5_query_optimize']; 
      }
      if (isset($_SESSION['scriptcase']['oracle_type']))
      {
          $this->nm_arr_db_extra_args['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
      }
      if (isset($_SESSION['scriptcase']['glo_use_persistent']))
      {
          $this->nm_con_persistente = $_SESSION['scriptcase']['glo_use_persistent']; 
      }
      if (isset($_SESSION['scriptcase']['glo_use_schema']))
      {
          $this->nm_con_use_schema = $_SESSION['scriptcase']['glo_use_schema']; 
      }
      $this->date_delim  = "'";
      $this->date_delim1 = "'";
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sybase))
      {
          $this->date_delim  = "";
          $this->date_delim1 = "";
      }
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_access))
      {
          $this->date_delim  = "#";
          $this->date_delim1 = "#";
      }
      if (isset($_SESSION['scriptcase']['glo_decimal_db']) && !empty($_SESSION['scriptcase']['glo_decimal_db']))
      {
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['decimal_db'] = $_SESSION['scriptcase']['glo_decimal_db']; 
      }
      if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
      {
          $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
          if (strlen($SC_temp) == 2)
          {
              $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_sep_date']  = substr($SC_temp, 0, 1); 
              $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
          }
          else
           {
              $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_sep_date']  = $SC_temp; 
              $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_sep_date1'] = $SC_temp; 
          }
          $this->date_delim  = $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_sep_date'];
          $this->date_delim1 = $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_sep_date1'];
      }
// 
      if (!empty($this->nm_falta_var) || !empty($this->nm_falta_var_db) || $nm_crit_perfil)
      {
         $str_message = "<html>

<head>
    <title>{var_str_title}</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
            min-width: 320px;
            background: #FFFFFF;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            font-smoothing: antialiased;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        user agent stylesheet body {
            display: block;
            margin: 8px;
        }

        html {
            font-size: 14px;
        }

        html {
            line-height: 1.15;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        ::selection {
            background-color: #CCE2FF;
            color: rgba(0, 0, 0, 0.87);
        }

        .ui.container {
            width: 933px;
            min-width: 992px;
            max-width: 1199px;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .ui.container {
            display: block;
            max-width: 100% !important;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message:last-child {
            margin-bottom: 0em;
        }

        .ui.message:first-child {
            margin-top: 0em;
        }

        .ui.message {
            font-size: 1em;
        }

        .ui.message {
            position: relative;
            min-height: 1em;
            margin: 1em 0em;
            background: #F8F8F9;
            padding: 1em 1.5em;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            transition: opacity 0.1s ease, color 0.1s ease, background 0.1s ease, box-shadow 0.1s ease;
            border-radius: 0.28571429rem;
            box-shadow: 0px 0px 0px 1px rgba(34, 36, 38, 0.22) inset, 0px 0px 0px 0px rgba(0, 0, 0, 0);
        }

        article,
        aside,
        footer,
        header,
        nav,
        section {
            display: block;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message> :last-child {
            margin-bottom: 0em;
        }

        .ui.message> :first-child {
            margin-top: 0em;
        }

        .ui.message .header+p {
            margin-top: 0.25em;
        }

        .ui.message p {
            opacity: 0.85;
            margin: 0.75em 0em;
        }

        p {
            margin: 0em 0em 1em;
            line-height: 1.4285em;
        }

        .ui.message .header:not(.ui) {
            font-size: 1.14285714em;
        }

        .ui.message .header {
            display: block;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-weight: bold;
            margin: -0.14285714em 0em 1.2rem 0em;
        }

        .ui.button {
            cursor: pointer;
            display: inline-block;
            min-height: 1em;
            outline: 0;
            border: none;
            vertical-align: baseline;
            background: #e0e1e2 none;
            color: rgba(0, 0, 0, .6);
            font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
            margin: 0 .25em 0 0;
            padding: .78571429em 1.5em .78571429em;
            text-transform: none;
            text-shadow: none;
            font-weight: 700;
            line-height: 1em;
            font-style: normal;
            text-align: center;
            text-decoration: none;
            border-radius: .28571429rem;
            box-shadow: 0 0 0 1px transparent inset, 0 0 0 0 rgba(34, 36, 38, .15) inset;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            transition: opacity .1s ease, background-color .1s ease, color .1s ease, box-shadow .1s ease, background .1s ease;
            will-change: '';
            -webkit-tap-highlight-color: transparent;
        }
        
        .ui.button,
        .ui.buttons .button,
        .ui.buttons .or {
            font-size: 1rem;
            flex-flow: row nowrap;
            justify-content: center;
            align-items: center;
            column-gap: .5rem;
            display: flex;
        }
        
        .ui.primary.button,
        .ui.primary.buttons .button {
            background-color: #2185d0;
            color: #fff;
            text-shadow: none;
            background-image: none;
        }
        
        .ui.primary.button {
            box-shadow: 0 0 0 0 rgba(34, 36, 38, .15) inset;
        }

        [type=reset], [type=submit], button, html [type=button] {
            -webkit-appearance: button;
        }

        .icon{
            position: relative;
            width: 1.2rem;
            height: 1.2rem;
            display: block;
            color: inherit;
            background-repeat: no-repeat;
        }

        .icon.database{
            background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\" fill=\"%23FFFFFF\"><path d=\"M448 80v48c0 44.2-100.3 80-224 80S0 172.2 0 128V80C0 35.8 100.3 0 224 0S448 35.8 448 80zM393.2 214.7c20.8-7.4 39.9-16.9 54.8-28.6V288c0 44.2-100.3 80-224 80S0 332.2 0 288V186.1c14.9 11.8 34 21.2 54.8 28.6C99.7 230.7 159.5 240 224 240s124.3-9.3 169.2-25.3zM0 346.1c14.9 11.8 34 21.2 54.8 28.6C99.7 390.7 159.5 400 224 400s124.3-9.3 169.2-25.3c20.8-7.4 39.9-16.9 54.8-28.6V432c0 44.2-100.3 80-224 80S0 476.2 0 432V346.1z\"/></svg>');
        }
    </style>
</head>

<body>
    <div class='ui container' style='padding-top:2rem'>
        <section class='ui message'>
            <div class='content'>
                <div class='header'>
                    <h1 class='ui header'>{var_str_title}</h1>
                </div>
                <p>{var_str_message}</p>
                <p>{var_str_message_conn}</p>
                {v_str_btn_inside}
            </div>
        </section>
    </div>";
         $str_message_end = "</body>
</html>";
         $str_message = str_replace('{var_str_title}', $this->Nm_lang['lang_errm_dbcn_create'], $str_message);
          if (empty($this->nm_falta_var_db))
          {
              if (!empty($this->nm_falta_var))
              {
                  $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_glob'] . $this->nm_falta_var, $str_message);
                  $str_message = str_replace('{var_str_message_conn}','', $str_message);
              }
              elseif ($nm_crit_perfil)
              {
                  $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_dbcn_nfnd'], $str_message);
                  $str_message = str_replace('{var_str_message_conn}', $this->Nm_lang['lang_errm_dbcn_conn_nfnd'] . ' ' . $perfil_trab, $str_message);
                  $str_message = str_replace('{v_str_btn_inside}', "<button class='ui button primary' style='font-size: 16px !important;'><a href='" . $this->path_prod . "' style='color: white;text-decoration:none'><i class='icon database' style='float: left;padding-right: .5rem;'></i>". $this->Nm_lang['lang_errm_dbcn_create'] ."</a></button>", $str_message);
              }
          }
          else
          {
                  $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_dbcn_data'], $str_message);
          }
         $str_message = str_replace('{var_str_message_conn}','', $str_message);
         $str_message = str_replace('{v_str_btn_inside}', '', $str_message);
          echo $str_message;
          if (!$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_outra_jan'])) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_back'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_back_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $_SESSION['scriptcase']['nm_sc_retorno'] ?>'; return false" class="scButton_default" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
              elseif(!empty($nm_url_saida)) 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_exit'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_exit_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $nm_url_saida ?>'; return false" class="scButton_danger" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
          } 
          echo $str_message_end;
          exit ;
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_usr']) && !empty($_SESSION['scriptcase']['glo_db_master_usr']))
      {
          $this->nm_usuario = $_SESSION['scriptcase']['glo_db_master_usr']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_pass']) && !empty($_SESSION['scriptcase']['glo_db_master_pass']))
      {
          $this->nm_senha = $_SESSION['scriptcase']['glo_db_master_pass']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_cript']) && !empty($_SESSION['scriptcase']['glo_db_master_cript']))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = $_SESSION['scriptcase']['glo_db_master_cript']; 
      }
   }
   function conectDB()
   {
      global $glo_senha_protect;
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['Grafico_pais']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['Grafico_pais']['glo_nm_conexao']))
      { 
          $this->Db = db_conect_devel($_SESSION['scriptcase']['Grafico_pais']['glo_nm_conexao'], $this->root . $this->path_prod, 'project_HOYY', 1, $this->force_db_utf8); 
      } 
      else 
      { 
          ob_start();
          $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_database_encoding;
          $this->Db = db_conect($this->nm_tpbanco, $this->nm_servidor, $this->nm_usuario, $this->nm_senha, $this->nm_banco, $glo_senha_protect, "S", $this->nm_con_persistente, $this->nm_con_db2, $databaseEncoding, $this->nm_arr_db_extra_args); 
          if (!isset($this->Ajax_result_set)) {$this->Ajax_result_set = ob_get_contents();}
          ob_end_clean();
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_start();
          } 
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
          $this->Ibase_version = "old";
          if ($ibase_version = $this->Db->Execute("SELECT RDB\$GET_CONTEXT('SYSTEM','ENGINE_VERSION') AS \"Version\" FROM RDB\$DATABASE"))
          {
              if (isset($ibase_version->fields[0]) && substr($ibase_version->fields[0], 0, 1) > 2) {$this->Ibase_version = "new";}
          }
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sybase))
      {
          $this->Db->fetchMode = ADODB_FETCH_BOTH;
          $this->Db->Execute("set dateformat ymd");
          $this->Db->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_db2))
      {
          $this->Db->fetchMode = ADODB_FETCH_NUM;
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mssql))
      {
          $this->Db->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_oracle))
      {
          $this->Db->Execute("alter session set nls_date_format         = 'yyyy-mm-dd hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_timestamp_format    = 'yyyy-mm-dd hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_timestamp_tz_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_time_format         = 'hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_time_tz_format      = 'hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_numeric_characters  = '.,'");
          $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['decimal_db'] = "."; 
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_postgres))
      {
          $this->Db->Execute("SET DATESTYLE TO ISO");
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_end_clean();
          } 
      } 
   }
   function regionalDefault()
   {
       $_SESSION['scriptcase']['reg_conf']['date_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_format'] : "ddmmyyyy";
       $_SESSION['scriptcase']['reg_conf']['date_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_sep'] : "/";
       $_SESSION['scriptcase']['reg_conf']['date_week_ini'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema'] : "SU";
       $_SESSION['scriptcase']['reg_conf']['time_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_format'] : "hhiiss";
       $_SESSION['scriptcase']['reg_conf']['time_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_sep'] : ":";
       $_SESSION['scriptcase']['reg_conf']['time_pos_ampm'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm'] : "right_without_space";
       $_SESSION['scriptcase']['reg_conf']['time_simb_am']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am'] : "am";
       $_SESSION['scriptcase']['reg_conf']['time_simb_pm']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm'] : "pm";
       $_SESSION['scriptcase']['reg_conf']['simb_neg']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg'] : "-";
       $_SESSION['scriptcase']['reg_conf']['grup_num']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr'] : ".";
       $_SESSION['scriptcase']['reg_conf']['dec_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec'] : ",";
       $_SESSION['scriptcase']['reg_conf']['neg_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg'] : 2;
       $_SESSION['scriptcase']['reg_conf']['monet_simb']    = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo'] : "$";
       $_SESSION['scriptcase']['reg_conf']['monet_f_pos']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'] : 3;
       $_SESSION['scriptcase']['reg_conf']['monet_f_neg']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'] : 13;
       $_SESSION['scriptcase']['reg_conf']['grup_val']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr'] : ".";
       $_SESSION['scriptcase']['reg_conf']['dec_val']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec'] : ",";
       $_SESSION['scriptcase']['reg_conf']['html_dir']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  " DIR='" . $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] . "'" : "";
       $_SESSION['scriptcase']['reg_conf']['css_dir']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] : "LTR";
       $_SESSION['scriptcase']['reg_conf']['num_group_digit']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit'] : "1";
       $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'] : "1";
       eval ('set'.$this->Control_Css.$this->Tree_img_type.'("'.$this->nm_script_type.'SESSID_",base64_encode("'.$this->nm_script_by.'?".substr(md5(mt_rand()),8,16)),time()+86400);');
   }
// 
   function sc_Include($path, $tp, $name)
   {
       if ((empty($tp) && empty($name)) || ($tp == "F" && !function_exists($name)) || ($tp == "C" && !class_exists($name)))
       {
           include_once($path);
       }
   } // sc_Include
   function sc_Sql_Protect($var, $tp, $conex="")
   {
       if (empty($conex) || $conex == "conn_mysql")
       {
           $TP_banco = $_SESSION['scriptcase']['glo_tpbanco'];
       }
       else
       {
           eval ("\$TP_banco = \$this->nm_con_" . $conex . "['tpbanco'];");
       }
       if ($tp == "date")
       {
           $delim  = "'";
           $delim1 = "'";
           if (in_array(strtolower($TP_banco), $this->nm_bases_access))
           {
               $delim  = "#";
               $delim1 = "#";
           }
           if (isset($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_sep_date']))
           {
               $delim  = $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_sep_date'];
               $delim1 = $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_sep_date1'];
           }
           return $delim . $var . $delim1;
       }
       else
       {
           return $var;
       }
   } // sc_Sql_Protect
   function sc_Date_Protect($val_dt)
   {
       $dd = substr($val_dt, 8, 2);
       $mm = substr($val_dt, 5, 2);
       $yy = substr($val_dt, 0, 4);
       $hh = (strlen($val_dt) > 10) ? substr($val_dt, 10) : "";
       if ($mm > 12) {
           $mm = 12;
       }
       $dd_max = 31;
       if ($mm == '04' || $mm == '06' || $mm == '09' || $mm == 11) {
           $dd_max = 30;
       }
       if ($mm == '02') {
           $dd_max = ($yy % 4 == 0) ? 29 : 28;
       }
       if ($dd > $dd_max) {
           $dd = $dd_max;
       }
       return $yy . "-" . $mm . "-" . $dd . $hh;
   }
   function dyn_convert_date($val)
   {
       $val_ok = array();
       foreach ($val as $Part_date)
       {
           if (substr($Part_date, 0, 1) == "Y")
           {
               $val_ok['ano'] = substr($Part_date, 2);
           }
           if (substr($Part_date, 0, 1) == "M")
           {
               $val_ok['mes'] = substr($Part_date, 2);
           }
           if (substr($Part_date, 0, 1) == "D")
           {
               $val_ok['dia'] = substr($Part_date, 2);
           }
           if (substr($Part_date, 0, 1) == "H")
           {
               $val_ok['hor'] = substr($Part_date, 2);
           }
           if (substr($Part_date, 0, 1) == "I")
           {
               $val_ok['min'] = substr($Part_date, 2);
           }
           if (substr($Part_date, 0, 1) == "S")
           {
               $val_ok['seg'] = substr($Part_date, 2);
           }
       }
       return $val_ok;
   }
	function appIsSsl() {
		if (isset($_SERVER['HTTPS'])) {
			if ('on' == strtolower($_SERVER['HTTPS'])) {
				return true;
			}
			if ('1' == $_SERVER['HTTPS']) {
				return true;
			}
		}

		if (isset($_SERVER['REQUEST_SCHEME'])) {
			if ('https' == $_SERVER['REQUEST_SCHEME']) {
				return true;
			}
		}

		if (isset($_SERVER['SERVER_PORT'])) {
			if ('443' == $_SERVER['SERVER_PORT']) {
				return true;
			}
		}

		return false;
	}
   function Get_Gb_date_format($GB, $cmp)
   {
       return (isset($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_Gb_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_Gb_date_format'][$GB][$cmp] : "";
   }

   function Get_Gb_prefix_date_format($GB, $cmp)
   {
       return (isset($_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_Gb_prefix_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['Grafico_pais']['SC_Gb_prefix_date_format'][$GB][$cmp] : "";
   }

   function GB_date_format($val, $format, $prefix, $conf_region="S", $mask="")
   {
           return $val;
   }
   function Get_arg_groupby($val, $format)
   {
       return $val; 
   }
   function Get_format_dimension($ind_ini, $ind_qb, $campo, $rs, $conf_region="S", $mask="")
   {
       $retorno    = array();
       $format     = $this->Get_Gb_date_format($ind_qb, $campo);
       $Prefix_dat = $this->Get_Gb_prefix_date_format($ind_qb, $campo);
       if (empty($format) || $rs->fields[$ind_ini] == "")
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $rs->fields[$ind_ini];
           return $retorno;
       }
       if ($format == 'YYYYMMDDHHIISS')
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($rs->fields[$ind_ini], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMMDDHHII')
       {
           $this->Ajust_fields($ind_ini, $rs, "1,2,3,4");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1] . "-" . $rs->fields[$ind_ini + 2] . " " . $rs->fields[$ind_ini + 3] . ":" . $rs->fields[$ind_ini + 4];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMMDDHH')
       {
           $this->Ajust_fields($ind_ini, $rs, "1,2,3");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1] . "-" . $rs->fields[$ind_ini + 2] . " " . $rs->fields[$ind_ini + 3];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMMDD2')
       {
           $this->Ajust_fields($ind_ini, $rs, "1,2");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1] . "-" . $rs->fields[$ind_ini + 2];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMM')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYY')
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($rs->fields[$ind_ini], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'BIMONTHLY' || $format == 'QUARTER' || $format == 'FOURMONTHS' || $format == 'SEMIANNUAL' || $format == 'WEEK')
       {
           $temp            = (substr($rs->fields[$ind_ini], 0, 1) == 0) ? substr($rs->fields[$ind_ini], 1) : $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $Prefix_dat . $temp;
           return $retorno;
       }
       if ($format == 'DAYNAME'|| $format == 'YYYYDAYNAME')
       {
           if ($format == 'DAYNAME')
           {
               $retorno['orig'] = $rs->fields[$ind_ini];
               $ano             = "";
               $daynum          = $rs->fields[$ind_ini];
           }
           else
           {
               $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
               $ano             = " " . $rs->fields[$ind_ini];
               $daynum          = $rs->fields[$ind_ini + 1];
           }
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_access) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_oracle) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mssql) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_db2) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_progress))
           {
               $daynum--;
           }
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql))
           {
               $daynum = ($daynum == 6) ? 0 : $daynum + 1;
           }
           if ($daynum == 0) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_sund'] . $ano;
           }
           if ($daynum == 1) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_mond'] . $ano;
           }
           if ($daynum == 2) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_tued'] . $ano;
           }
           if ($daynum == 3) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_wend'] . $ano;
           }
           if ($daynum == 4) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_thud'] . $ano;
           }
           if ($daynum == 5) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_frid'] . $ano;
           }
           if ($daynum == 6) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_satd'] . $ano;
           }
           return $retorno;
       }
       if ($format == 'HH')
       {
           $this->Ajust_fields($ind_ini, $rs, "0");
           $temp            = "0000-00-00 " . $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'DD')
       {
           $this->Ajust_fields($ind_ini, $rs, "0");
           $temp            = "0000-00-" . $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'MM')
       {
           $this->Ajust_fields($ind_ini, $rs, "0");
           $temp            = "0000-" . $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYY')
       {
           $temp            = $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYHH')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $temp            = $rs->fields[$ind_ini] . "-00-00 " . $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYDD')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $temp            = $rs->fields[$ind_ini] . "-00-" . $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       elseif ($format == 'YYYYWEEK' || $format == 'YYYYBIMONTHLY' || $format == 'YYYYQUARTER' || $format == 'YYYYFOURMONTHS' || $format == 'YYYYSEMIANNUAL')
       {
           $temp            = (substr($rs->fields[$ind_ini + 1], 0, 1) == 0) ? substr($rs->fields[$ind_ini + 1], 1) : $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $Prefix_dat . $temp . " " . $rs->fields[$ind_ini];
           return $retorno;
       }
       if ($format == 'YYYYHH' || $format == 'YYYYDD')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $rs->fields[$ind_ini] . $_SESSION['scriptcase']['reg_conf']['date_sep'] . $rs->fields[$ind_ini + 1];
           return $retorno;
       }
       elseif ($format == 'HHIISS')
       {
           $this->Ajust_fields($ind_ini, $rs, "0,1,2");
           $retorno['orig'] = $rs->fields[$ind_ini] . ":" . $rs->fields[$ind_ini + 1] . ":" . $rs->fields[$ind_ini + 2];
           $retorno['fmt']  = $this->GB_date_format("0000-00-00 " . $retorno['orig'], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       elseif ($format == 'HHII')
       {
           $this->Ajust_fields($ind_ini, $rs, "0,1");
           $retorno['orig'] = $rs->fields[$ind_ini] . ":" . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $this->GB_date_format("0000-00-00 " . $retorno['orig'], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       else
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $rs->fields[$ind_ini];
           return $retorno;
       }
   }
   function Ajust_fields($ind_ini, &$rs, $parts)
   {
       $prep = explode(",", $parts);
       foreach ($prep as $ind)
       {
           $ind_ok = $ind_ini + $ind;
           $rs->fields[$ind_ok] = (int) $rs->fields[$ind_ok];
           if (strlen($rs->fields[$ind_ok]) == 1)
           {
               $rs->fields[$ind_ok] = "0" . $rs->fields[$ind_ok];
           }
       }
   }
   function Get_date_order_groupby($sql_def, $order, $format="", $order_old="")
   {
       $order      = " " . trim($order);
       $order_old .= (!empty($order_old)) ? ", " : "";
       return $order_old . $sql_def . $order;
   }
}
//===============================================================================
//
class Grafico_pais_sub_css
{
   function __construct()
   {
      global $script_case_init;
      $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_BlueBerry/Sc9_BlueBerry";
      if ($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['SC_herda_css'] == "N")
      {
          $_SESSION['sc_session'][$script_case_init]['SC_sub_css']['Grafico_pais']    = $str_schema_all . "_grid.css";
          $_SESSION['sc_session'][$script_case_init]['SC_sub_css_bw']['Grafico_pais'] = $str_schema_all . "_grid_bw.css";
      }
   }
}
//
class Grafico_pais_apl
{
   var $Ini;
   var $Erro;
   var $Db;
   var $Lookup;
   var $nm_location;
   var $NM_ajax_flag  = false;
   var $NM_ajax_opcao = '';
   var $grid;
   var $Res;
   var $Graf;
   var $pdf;
//
//----- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini = $this->Ini;
      $this->$modulo->Db = $this->Db;
      $this->$modulo->Erro = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
      $this->$modulo->arr_buttons = $this->arr_buttons;
   }
//
//----- 
   function controle($linhas = 0)
   {
      global $nm_saida, $nm_url_saida, $script_case_init, $nmgp_parms_pdf, $nmgp_graf_pdf, $nm_apl_dependente, $nmgp_navegator_print, $nmgp_tipo_print, $nmgp_cor_print, $nmgp_cor_word, $Det_use_pass_pdf, $Det_pdf_zip, $NMSC_conf_apl, $NM_contr_var_session, $NM_run_iframe, $SC_module_export, $nmgp_password,
             $glo_senha_protect, $nmgp_opcao, $nm_call_php, $rec, $nmgp_ordem, $nmgp_parms_where;

      $Parms_form_pdf = false;
      if (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['Grafico_pais']))
      { 
          $GLOBALS['nmgp_parms'] = $_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['Grafico_pais'];
          $Parms_form_pdf = true;
      } 
      if ($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'] || $Parms_form_pdf)
      { 
          if (!empty($GLOBALS['nmgp_parms'])) 
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
                       nm_limpa_str_Grafico_pais($cadapar[1]);
                       nm_protect_num_Grafico_pais($cadapar[0], $cadapar[1]);
                       if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                       $Tmp_par   = $cadapar[0];
                       $$Tmp_par = $cadapar[1];
                       if ($Tmp_par == "nmgp_opcao")
                       {
                           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opcao'] = $cadapar[1];
                       }
                   }
              }
          } 
      } 
      if ($Parms_form_pdf)
      { 
          $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_pdf'] = true;
          $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form'] = true;
          $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form_full'] = false;
          $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_pai'] = "";
      } 
      $_SESSION['scriptcase']['sc_ctl_ajax'] = 'full';
      if ($this->NM_ajax_flag || $NM_run_iframe == 1)
      {
          $_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
      }
      if (!$this->Ini || isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_ibase'])) 
      { 
          $this->Ini = new Grafico_pais_ini(); 
          $this->Ini->init();
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) && $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida_ibase'] = true;
      }
      $this->Ini->Proc_print      = false;
      $this->Ini->Export_det_zip  = false;
      $this->Ini->Export_html_zip = false;
      $this->Ini->Export_img_zip  = false;
      $this->Ini->Img_export_zip  = array();
      $this->Ini->Embutida_iframe = (strpos($this->Ini->sc_page, "-") !== false) ? true : false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['emb_lig_aba'] = array();
      $this->Change_Menu = false;
      if (!isset($nmgp_opcao)) {
         $nmgp_opcao = "";
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'])) {
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "";
      }
       if ($nmgp_opcao == "link_res")  
       { 
           $nmgp_opcao = "inicio";  
           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "inicio";  
           $Temp_parms = "";  
           $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms_where);
           $todox = stripslashes($todox);
           $todo  = explode("?@?", $todox);
           foreach ($todo as $param)
           {
                $cadapar  = explode("?#?", $param);
                if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Ind_Groupby'] == "sc_free_group_by")
                { 
                    $Temp_parms .= (empty($Temp_parms)) ? "" : " and ";
                    $Tmp_pos = strpos($cadapar[1], "@aspass@");
                    $cadapar[1] = str_replace("@aspass@", "", $cadapar[1]);
                    if ($Tmp_pos !== false)
                    {
                        $cadapar[1] = $this->Ini->Db->qstr($cadapar[1]);
                    }
                    if ($cadapar[1] == "__SCNULL__" || $cadapar[1] == "'__SCNULL__'")
                    {
                        $Temp_parms .= $cadapar[0] . " is null" ;
                    }
                    else
                    {
                        $Temp_parms .= $cadapar[0] . " = " . $cadapar[1];
                    }
                } 
           }
           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_resumo'] = $Temp_parms;
       } 
      if ($nmgp_opcao != "ajax_navigate" && $nmgp_opcao != "ajax_detalhe" && isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['sc_outra_jan'] || $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['sc_modal']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['Grafico_pais']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['Grafico_pais'];
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'] && $this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['Grafico_pais']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['Grafico_pais']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('Grafico_pais') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['Grafico_pais']['label'] = "" . $this->Ini->Nm_lang['lang_othr_chart_title'] . " pais";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "Grafico_pais")
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
      {
          $this->Change_Menu = false;
      }
      $this->Db = $this->Ini->Db; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['nm_tpbanco'] = $this->Ini->nm_tpbanco;
      $this->nm_data = new nm_data("es");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
      { 
          include_once($this->Ini->path_embutida . "Grafico_pais/Grafico_pais_erro.class.php"); 
      } 
      else 
      { 
          include_once($this->Ini->path_aplicacao . "Grafico_pais_erro.class.php"); 
      } 
      $this->Erro      = new Grafico_pais_erro();
      $this->Erro->Ini = $this->Ini;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
      { 
          require_once($this->Ini->path_embutida . "Grafico_pais/Grafico_pais_lookup.class.php"); 
      } 
      else 
      { 
          require_once($this->Ini->path_aplicacao . "Grafico_pais_lookup.class.php"); 
      } 
      $this->Lookup       = new Grafico_pais_lookup();
      $this->Lookup->Db   = $this->Db;
      $this->Lookup->Ini  = $this->Ini;
      $this->Lookup->Erro = $this->Erro;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
      {
          $this->Ini->sc_Include($this->Ini->path_libs . "/nm_trata_saida.php", "C", "nm_trata_saida") ; 
          $nm_saida = new nm_trata_saida();
          $ajax_opc_print = false;
          if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "ajax_export")
          {
              $this->Ini->sc_export_ajax = true;
              $this->Ini->Arr_result     = array();
              $nmgp_opcao                = $_POST['export_opc'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = $nmgp_opcao;
              if ($nmgp_opcao == "print" || $nmgp_opcao == "res_print" || $nmgp_opcao == "det_print")
              {
                  $ajax_opc_print   = true;
                  $nm_arquivo_print = "/sc_Grafico_pais_" . session_id();
                  $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_print . ".html");
                  $this->Ini->sc_export_ajax_img = true;
              }
              ob_start();
          }
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
      {
          $_SESSION['scriptcase']['saida_var'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['ajax_nav'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['scroll_navigate'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['scroll_navigate_reload'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['scroll_navigate_app'] = false;
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['scroll_navigate_header_row']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['scroll_navigate_header_row'] = 1;
          }
          if (isset($_POST['nmgp_opcao']) && ($_POST['nmgp_opcao'] == "ajax_navigate" || $_POST['nmgp_opcao'] == "ajax_detalhe"))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['ajax_nav'] = true;
              $_SESSION['scriptcase']['saida_var']  = true;
              $_SESSION['scriptcase']['saida_html'] = "";
              $this->Ini->Arr_result = array();
              $nmgp_opcao = $_POST['opc'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = $nmgp_opcao;
              if (isset($_POST['parm']) && $_POST['parm'] == "save_grid")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['save_grid'] = true;
              }
              if ($nmgp_opcao == "edit" && isset($_POST['parm']) && $_POST['parm'] == "fim")
              {
                  $rec = $_POST['parm'];
              }
              if ($nmgp_opcao == "rec" || $nmgp_opcao == "muda_rec_linhas")
              {
                  $rec = $_POST['parm'];
              }
              if ($nmgp_opcao == "muda_qt_linhas")
              {
                  $nmgp_quant_linhas  = strtolower($_POST['parm']);
              }
              if (($_POST['opc'] == "igual" || $_POST['opc'] == "resumo") && isset($_POST['parm']) && ($_POST['parm'] == "reload" || $_POST['parm'] == "breload"))
              {
                  $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['contr_total_geral'] = "NAO";
                  $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['contr_array_resumo'] = "NAO";
                  unset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['tot_geral']);
                  unset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['arr_total']);
              }
              if ($nmgp_opcao == "ordem")
              {
                  $nmgp_ordem = $_POST['parm'];
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_date_format'])) 
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_date_format'] = array();
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_All_Groupby'] = array('sc_free_group_by' => 'all');
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Groupby_hide'])) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Groupby_hide'] = array();
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Ind_Groupby'])) 
      { 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_All_Groupby'] as $Ind => $Tp)
          {
              if ($Tp == "grid")
              {
                  continue;
              }
              if (!in_array($Ind, $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Groupby_hide'])) 
              { 
                  break;
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Ind_Groupby'] = $Ind;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_Free_cmp'])) 
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_Free_cmp']  = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_Free_sql']  = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_Free_orig'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_Free_cmp']['continente'] = "continente";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_Free_sql']['continente']["continente"] = 'asc';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_Free_cmp']['nombre'] = "nombre";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_Free_sql']['nombre']["nombre"] = 'asc';
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['Labels_GB'] = array();
      if  ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Ind_Groupby'] == "sc_free_group_by")
      {
          $Arr_free_labels = array();
          $Arr_free_labels['continente'] = "Continente";
          $Arr_free_labels['nombre'] = "Nombre";
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_Free_cmp'] as $Field => $Label)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['Labels_GB'][] = $Arr_free_labels[$Field];
          }
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_display']['sc_free_group_by'][2]['display'] = true;
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_control']['sc_free_group_by']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_control']['sc_free_group_by'] = array(
               array(
                   'cmp_res' => "continente",
                   'label' => "Continente (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_cnt'] . ")",
                   'label_field' => "Continente",
                   'options' => array(
                       array('op' => 'C', 'index' => '2', 'label' => "" . $this->Ini->Nm_lang['lang_btns_smry_msge_count'] . "", 'abbrev' => "Count"),
                   ),
                   'select' => "<select class=\"sc-ui-select-continente\" onChange=\"scSummChange($(this))\"><option value=\"2\" class=\"sc-ui-select-option-C\">" . $this->Ini->Nm_lang['lang_btns_smry_msge_count'] . "</option></select>",
               ),
           );
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dados_orig_gb']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dados_orig_gb'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dados_orig_gb']['all']['SC_Ind_Groupby'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dados_orig_gb']['all']['SC_Gb_Free_cmp'] = array();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Ind_Groupby']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dados_orig_gb']['all']['SC_Ind_Groupby'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Ind_Groupby'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_Free_cmp']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dados_orig_gb']['all']['SC_Gb_Free_cmp'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_Free_cmp'];
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dados_orig_gb']['res']['summarizing_fields_display'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dados_orig_gb']['res']['summarizing_fields_order']   = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dados_orig_gb']['res']['summarizing_fields_control'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dados_orig_gb']['res']['pivot_x_axys']               = array();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_display']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dados_orig_gb']['res']['summarizing_fields_display'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_display'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_order']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dados_orig_gb']['res']['summarizing_fields_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_order'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_control']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dados_orig_gb']['res']['summarizing_fields_control'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_control'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_x_axys']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dados_orig_gb']['res']['pivot_x_axys'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_x_axys'];
          }
      }
      $this->Ini->Apl_resumo  = "Grafico_pais_resumo_" . $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Ind_Groupby'] . ".class.php"; 
      $this->Ini->Apl_grafico = "Grafico_pais_grafico_" . $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Ind_Groupby'] . ".class.php"; 
      $_SESSION['sc_session']['path_third'] = $this->Ini->path_prod . "/third";
      $_SESSION['sc_session']['real_path_third'] = $this->Ini->path_third;
      $_SESSION['sc_session']['path_prod']  = $this->Ini->path_prod . "/third";
      $_SESSION['sc_session']['path_img']   = $this->Ini->path_img_global;
      $_SESSION['sc_session']['path_libs']  = $this->Ini->path_libs;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['xls_return']  = ($nmgp_opcao == "xls")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['csv_return']  = ($nmgp_opcao == "csv")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['xml_return']  = ($nmgp_opcao == "xml")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['json_return'] = ($nmgp_opcao == "json") ? "volta_grid" : "resumo"; 
      $this->Ini->SC_module_export = (isset($SC_module_export) && !empty($SC_module_export)) ? $SC_module_export : "chart"; 
      if (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'pdf')
      { 
          $this->Ini->SC_module_export = "";
      }
      elseif (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'print')
      { 
          $this->Ini->SC_module_export = "";
      }
      elseif (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'pdf_res')
      { 
          $this->Ini->SC_module_export = "chart";
      }
      elseif (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'res_print')
      { 
          $this->Ini->SC_module_export = "chart";
      }
      if (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'xls')
      { 
          $this->Ini->SC_module_export = "";
      }
      elseif (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'xls_res')
      { 
          $this->Ini->SC_module_export = "";
      }
      if ($nmgp_opcao == 'print' || $nmgp_opcao == 'res_print') {
          $this->Ini->Proc_print = true;
          if (!empty($nmgp_password)) {
              $this->Ini->Export_html_zip = true;
          }
          $_SESSION['scriptcase']['proc_mobile'] = false;
          if ($nmgp_opcao == 'print') {
              $this->ret_print = "volta_grid";
          }
          else {
              $this->ret_print = "resumo";
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['print_return'] = $this->ret_print;
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
      {
          if ($this->Ini->Export_html_zip)
          {
              $this->Ini->Export_img_zip = true;
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['html_name']))
              {
                  $nm_arquivo_html = "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['html_name'];
              }
              elseif ($nmgp_opcao == 'print' && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
              {
                  $nm_arquivo_html = "/sc_Grafico_pais_" . session_id() . ".html";
              }
              else
              {
                  $nm_arquivo_html = "/sc_Grafico_pais_res_" . session_id() . ".html";
              }
              $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html);
          }
      }
      if ($nmgp_opcao == "doc_word") {  
          $this->ret_word = "volta_grid";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['word_return'] = $this->ret_word;
          $_SESSION['scriptcase']['proc_mobile'] = false;
      }
      if ($nmgp_opcao == "doc_word_res") {  
          $this->ret_word = "resumo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['word_return'] = $this->ret_word;
          $_SESSION['scriptcase']['proc_mobile'] = false;
      }
      if ($nmgp_opcao == "doc_word_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "doc_word"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "doc_word"; 
      }
      elseif ($nmgp_opcao == "doc_word" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "doc_word_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "doc_word_res"; 
      }
      if ($nmgp_opcao == "xls_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "xls"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "xls"; 
      }
      elseif ($nmgp_opcao == "xls" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "xls_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "xls_res"; 
      }
      if ($nmgp_opcao == "csv_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "csv"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "csv"; 
      }
      elseif ($nmgp_opcao == "csv" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "csv_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "csv_res"; 
      }
      if ($nmgp_opcao == "xml_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "xml"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "xml"; 
      }
      elseif ($nmgp_opcao == "xml" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "xml_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "xml_res"; 
      }
      if ($nmgp_opcao == "json_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "json"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "json"; 
      }
      elseif ($nmgp_opcao == "json" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "json_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "json_res"; 
      }
      $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['skip_charts'] = (strpos(" " . $this->Ini->SC_module_export, "chart") !== false) ? false : true;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_det'] = false;
      if ($nmgp_opcao == 'pdf')
      { 
          if (strpos(" " . $this->Ini->SC_module_export, "grid") === false && (strpos(" " . $this->Ini->SC_module_export, "resume") !== false || strpos(" " . $this->Ini->SC_module_export, "chart") !== false))
          { 
              $nmgp_opcao = 'pdf_res';
          } 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_res'] = false;
      if ($nmgp_opcao == 'pdf_res')
      {
          if (strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = 'pdf';
              $nmgp_opcao = 'pdf';
          }
          else
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_res'] = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = 'pdf';
              $nmgp_opcao = 'pdf';
              $rRFP = fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp', "w");
              fwrite($rRFP, "PDF\n");
              fwrite($rRFP, "\n");
              fwrite($rRFP, "\n");
              fwrite($rRFP, "100\n");
              $lang_protect = $this->Ini->Nm_lang['lang_pdff_gnrt'];
              if (!NM_is_utf8($lang_protect))
              {
                  $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              fwrite($rRFP, 90 . "_#NM#_" . $lang_protect . "...\n");
              fclose($rRFP);
          }
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['conf_chart_level'] = "S";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_disp']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_disp']        = array('Bar');
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_tipo']        = 'Bar';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_larg']        = '1200';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_alt']         = '600';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_opc_atual']   = '1';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_mod_allowed'] = array(1, 2);
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_order']       = '';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_font'] = '';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_subtitle_val'] = '';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chartpallet']       = '1';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_exibe_val']    = '1';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['paletteColors']     = '';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_orien'] = 'Vertical';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_forma'] = 'Bar';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_dimen'] = '2d';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_sobre'] = 'No';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_empil'] = 'Off';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_inver'] = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_agrup'] = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_funil'] = 'N';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_forma'] = 'Pie';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_dimen'] = '3d';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_orden'] = 'Off';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_explo'] = 'Off';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_valor'] = 'Valor';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_linha_forma'] = 'Line';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_linha_inver'] = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_linha_agrup'] = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_area_forma']  = 'Area';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_area_empil']  = 'Off';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_area_inver']  = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_area_agrup']  = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_marca_inver'] = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_marca_agrup'] = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_gauge_forma'] = 'Circular';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_radar_forma'] = 'Line';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_radar_empil'] = 'Off';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_polar_forma'] = 'Line';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_funil_dimen'] = '3d';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_funil_inver'] = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pyram_dimen'] = '3d';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pyram_valor'] = 'Valor';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pyram_forma'] = 'S';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida']      = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida_grid']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida_grid'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida_init']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida_init'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida_label']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida_label'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cab_embutida']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cab_embutida'] = "";
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida_pdf']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida_pdf'] = "";
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida_treeview']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida_treeview'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida_opcao']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida_opcao'] = "";
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['proc_pdf'] = (!$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'] && ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "pdf_res")) ? true : false;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['proc_pdf']) {
          $_SESSION['scriptcase']['proc_mobile'] = false;
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['proc_pdf_vert'] = false;
      include("../_lib/css/" . $this->Ini->str_schema_all . "_grid.php");
      $this->Ini->Tree_img_col    = trim($str_tree_col);
      $this->Ini->Tree_img_exp    = trim($str_tree_exp);
      $this->Ini->scGridRefinedSearchExpandFAIcon    = trim($scGridRefinedSearchExpandFAIcon);
      $this->Ini->scGridRefinedSearchCollapseFAIcon    = trim($scGridRefinedSearchCollapseFAIcon);
      $this->Ini->str_chart_theme = (isset($str_chart_theme)?$str_chart_theme:'');
      $this->Ini->Str_btn_grid    = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Ini->Str_btn_css     = trim($str_button) . "/" . trim($str_button) . ".css";
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
      { 
      $this->Ini->Img_sep_grid             = "/" . trim($str_toolbar_separator);
      $this->Ini->grid_table_width         = (!isset($str_grid_table_width) || "" == trim($str_grid_table_width)) ? "" : $str_grid_table_width;
      $this->Ini->Label_sort_pos           = trim($str_label_sort_pos);
      $this->Ini->Label_sort               = trim($str_label_sort);
      $this->Ini->Label_sort_asc           = trim($str_label_sort_asc);
      $this->Ini->Label_sort_desc          = trim($str_label_sort_desc);
      $this->Ini->Label_summary_sort_pos   = trim($str_resume_label_sort_pos);
      $this->Ini->Label_summary_sort       = trim($str_resume_label_sort);
      $this->Ini->Label_summary_sort_asc   = trim($str_resume_label_sort_asc);
      $this->Ini->Label_summary_sort_desc  = trim($str_resume_label_sort_desc);
      $this->Ini->Sum_ico_line             = trim($sum_ico_line);
      $this->Ini->Sum_ico_column           = trim($sum_ico_column);
      $this->Ini->ajax_div_icon            = trim($ajax_div_icon);
      $this->Ini->Str_toolbarnav_separator = '/' . trim($str_toolbarnav_separator);
      $this->Ini->Img_qs_search            = '' != trim($img_qs_search)        ? trim($img_qs_search)        : 'scriptcase__NM__qs_lupa.png';
      $this->Ini->Img_qs_clean             = '' != trim($img_qs_clean)         ? trim($img_qs_clean)         : 'scriptcase__NM__qs_close.png';
      $this->Ini->Str_qs_image_padding     = '' != trim($str_qs_image_padding) ? trim($str_qs_image_padding) : '0';
      $this->Ini->App_div_tree_img_col     = trim($app_div_str_tree_col);
      $this->Ini->App_div_tree_img_exp     = trim($app_div_str_tree_exp);
      $this->Ini->refinedsearch_hide           = trim($refinedsearch_hide);
      $this->Ini->refinedsearch_show          = trim($refinedsearch_show);
      $this->Ini->refinedsearch_close          = trim($refinedsearch_close);
      $this->Ini->refinedsearch_values_separator          = trim($refinedsearch_values_separator);
      $this->Ini->refinedsearch_campo_close_icon          = trim($refinedsearch_campo_close_icon);
          $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_config_btn.php", "F", "nmButtonOutput") ; 
          $_SESSION['scriptcase']['css_popup']                 = $this->Ini->str_schema_all . "_grid.css";
          $_SESSION['scriptcase']['css_popup_dir']             = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
          $_SESSION['scriptcase']['css_btn_popup']             = $this->Ini->Str_btn_css;
          $_SESSION['scriptcase']['str_google_fonts']          = $this->Ini->str_google_fonts;
          $_SESSION['scriptcase']['css_popup_tab']             = $this->Ini->str_schema_all . "_tab.css";
          $_SESSION['scriptcase']['css_popup_tab_dir']         = $this->Ini->str_schema_all . "_tab" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
          $_SESSION['scriptcase']['css_popup_div']             = $this->Ini->str_schema_all . "_appdiv.css";
          $_SESSION['scriptcase']['css_popup_div_dir']         = $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
          $_SESSION['scriptcase']['bg_btn_popup']['bok']       = nmButtonOutput($this->arr_buttons, "bok_appdiv", "processa();", "processa();", "bok", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $_SESSION['scriptcase']['bg_btn_popup']['bsair']     = nmButtonOutput($this->arr_buttons, "bsair_appdiv", "window.close()", "window.close()", "bsair", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $_SESSION['scriptcase']['bg_btn_popup']['btbremove'] = nmButtonOutput($this->arr_buttons, "bsair_appdiv", "self.parent.tb_remove()", "self.parent.tb_remove()", "bsair", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['field_order']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['field_order'][] = "codigo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['field_order'][] = "nombre";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['field_order'][] = "continente";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['field_order'][] = "region";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['field_order'][] = "codigo2";
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['usr_cmp_sel']))
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['usr_cmp_sel'] = array();
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['usr_cmp_sel']['codigo'] = "off";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['usr_cmp_sel']['nombre'] = "off";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['usr_cmp_sel']['continente'] = "off";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['usr_cmp_sel']['region'] = "off";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['usr_cmp_sel']['codigo2'] = "off";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['usr_cmp_sel_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['usr_cmp_sel'];
      } 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Grafico_pais']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['Grafico_pais']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['Grafico_pais']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }

      $this->Ini->sc_Include($this->Ini->path_libs . "/nm_gc.php", "F", "nm_gc") ; 
      nm_gc($this->Ini->path_libs);
      if (!$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_page_process'] = $this->Ini->sc_page;
      } 
      $_SESSION['scriptcase']['sc_idioma_pivot']['es'] = array(
          'smry_ppup_titl'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_titl'],
          'smry_ppup_fild'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_fild'],
          'smry_ppup_posi'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_posi'],
          'smry_ppup_sort'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_sort'],
          'smry_ppup_posi_labl' => $this->Ini->Nm_lang['lang_othr_smry_ppup_posi_labl'],
          'smry_ppup_posi_data' => $this->Ini->Nm_lang['lang_othr_smry_ppup_posi_data'],
          'smry_ppup_sort_labl' => $this->Ini->Nm_lang['lang_othr_smry_ppup_sort_labl'],
          'smry_ppup_sort_vlue' => $this->Ini->Nm_lang['lang_othr_smry_ppup_sort_vlue'],
          'smry_ppup_chek_tabu' => $this->Ini->Nm_lang['lang_othr_smry_ppup_chek_tabu'],
      );
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
      if (!$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'])
      { 
          $this->pdf_zip = (isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opc_pdf']['pdf_zip'])) ? $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opc_pdf']['pdf_zip'] : "N";
          $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['use_pass_pdf'] = "";
          $_SESSION['scriptcase']['sc_tp_pdf'] = "wkhtmltopdf";
          $_SESSION['scriptcase']['sc_idioma_pdf'] = array();
          $_SESSION['scriptcase']['sc_idioma_pdf']['es'] = array('titulo' => $this->Ini->Nm_lang['lang_pdff_titl'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'tp_imp' => $this->Ini->Nm_lang['lang_pdff_type'], 'color' => $this->Ini->Nm_lang['lang_pdff_colr'], 'econm' => $this->Ini->Nm_lang['lang_pdff_bndw'], 'tp_pap' => $this->Ini->Nm_lang['lang_pdff_pper'], 'carta' => $this->Ini->Nm_lang['lang_pdff_letr'], 'oficio' => $this->Ini->Nm_lang['lang_pdff_legl'], 'customiz' => $this->Ini->Nm_lang['lang_pdff_cstm'], 'alt_papel' => $this->Ini->Nm_lang['lang_pdff_pper_hgth'], 'larg_papel' => $this->Ini->Nm_lang['lang_pdff_pper_wdth'], 'orient' => $this->Ini->Nm_lang['lang_pdff_pper_orie'], 'retrato' => $this->Ini->Nm_lang['lang_pdff_prtr'], 'paisag' => $this->Ini->Nm_lang['lang_pdff_lnds'], 'book' => $this->Ini->Nm_lang['lang_pdff_bkmk'], 'grafico' => $this->Ini->Nm_lang['lang_pdff_chrt'], 'largura' => $this->Ini->Nm_lang['lang_pdff_wdth'], 'fonte' => $this->Ini->Nm_lang['lang_pdff_font'], 'create' => $this->Ini->Nm_lang['lang_pdff_create'], 'sim' => $this->Ini->Nm_lang['lang_pdff_chrt_yess'], 'nao' => $this->Ini->Nm_lang['lang_pdff_chrt_nooo'], 'chart_level' => $this->Ini->Nm_lang['lang_chart_level_groupby'], 'chart_level' => $this->Ini->Nm_lang['lang_chart_level_groupby'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'group_chart' => $this->Ini->Nm_lang['lang_pdff_group_chart'], 'pdf_res' => $this->Ini->Nm_lang['lang_app_xls_summry'], 'pdf_cons' => $this->Ini->Nm_lang['lang_app_xls_grid'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd'], 'page_break' => $this->Ini->Nm_lang['lang_groupby_break_page_pdf'], 'other_options' => $this->Ini->Nm_lang['lang_app_other_options'], 'label_group' => $this->Ini->Nm_lang['lang_pdf_below_groupby'], 'page_label' => $this->Ini->Nm_lang['lang_pdf_all_pages_title'], 'page_header' => $this->Ini->Nm_lang['lang_pdf_all_pages_header'], 'format_zip' => $this->Ini->Nm_lang['lang_export_pdf_zip'], 'cancela' => $this->Ini->Nm_lang['lang_pdff_cncl']);
      } 
      $_SESSION['scriptcase']['sc_idioma_graf_flash'] = array();
      $_SESSION['scriptcase']['sc_idioma_graf_flash']['es'] = array(
          'titulo' => $this->Ini->Nm_lang['lang_chrt_titl'],
          'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'],
          'tipo_g' => $this->Ini->Nm_lang['lang_chrt_type'],
          'tp_barra' => $this->Ini->Nm_lang['lang_flsh_chrt_bars'],
          'tp_pizza' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie'],
          'tp_linha' => $this->Ini->Nm_lang['lang_flsh_chrt_line'],
          'tp_area' => $this->Ini->Nm_lang['lang_flsh_chrt_area'],
          'tp_marcador' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks'],
          'tp_gauge' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug'],
          'tp_radar' => $this->Ini->Nm_lang['lang_flsh_chrt_radr'],
          'tp_polar' => $this->Ini->Nm_lang['lang_flsh_chrt_polr'],
          'tp_funil' => $this->Ini->Nm_lang['lang_flsh_chrt_funl'],
          'tp_pyramid' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm'],
          'largura' => $this->Ini->Nm_lang['lang_chrt_wdth'],
          'altura' => $this->Ini->Nm_lang['lang_chrt_hgth'],
          'modo_gera' => $this->Ini->Nm_lang['lang_chrt_gtmd'],
          'sintetico' => $this->Ini->Nm_lang['lang_chrt_smzd'],
          'analitico' => $this->Ini->Nm_lang['lang_chrt_anlt'],
          'order' => $this->Ini->Nm_lang['lang_chrt_ordr'],
          'order_none' => $this->Ini->Nm_lang['lang_chrt_ordr_none'],
          'order_asc' => $this->Ini->Nm_lang['lang_chrt_ordr_asc'],
          'order_desc' => $this->Ini->Nm_lang['lang_chrt_ordr_desc'],
          'limit_chart_items' => $this->Ini->Nm_lang['lang_limit_chart_items'],
          'barra_orien' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_layo'],
          'barra_orien_horiz' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_horz'],
          'barra_orien_verti' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_vrtc'],
          'barra_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_shpe'],
          'barra_forma_barra' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_bars'],
          'barra_forma_cilin' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_cyld'],
          'barra_forma_cone' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_cone'],
          'barra_forma_piram' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_pyrm'],
          'barra_dimen' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_dmns'],
          'barra_dimen_2d' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_2ddm'],
          'barra_dimen_3d' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ddm'],
          'barra_sobre' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ovr'],
          'barra_sobre_nao' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ont'],
          'barra_sobre_sim' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3oys'],
          'barra_empil' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stck'],
          'barra_empil_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stan'],
          'barra_empil_ativa' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stay'],
          'barra_empil_perce' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stap'],
          'barra_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_invr'],
          'barra_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_invn'],
          'barra_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_invi'],
          'barra_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_srgr'],
          'barra_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_srst'],
          'barra_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_srbs'],
          'barra_funil' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_funl'],
          'barra_funil_nao' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ont'],
          'barra_funil_sim' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3oys'],
          'pizza_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_shpe'],
          'pizza_forma_pizza' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fpie'],
          'pizza_forma_donut' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dnts'],
          'pizza_dimen' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dmns'],
          'pizza_dimen_2d' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_2ddm'],
          'pizza_dimen_3d' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_3ddm'],
          'pizza_orden' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_srtn'],
          'pizza_orden_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_nsrt'],
          'pizza_orden_ascen' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_asrt'],
          'pizza_orden_desce' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dsrt'],
          'pizza_explo' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_expl'],
          'pizza_explo_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dxpl'],
          'pizza_explo_ativa' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_axpl'],
          'pizza_explo_click' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_cxpl'],
          'pizza_valor' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fval'],
          'pizza_valor_valor' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fvlv'],
          'pizza_valor_perce' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fvlp'],
          'linha_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_line_shpe'],
          'linha_forma_linha' => $this->Ini->Nm_lang['lang_flsh_chrt_line_line'],
          'linha_forma_splin' => $this->Ini->Nm_lang['lang_flsh_chrt_line_spln'],
          'linha_forma_degra' => $this->Ini->Nm_lang['lang_flsh_chrt_line_step'],
          'linha_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_line_invr'],
          'linha_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_line_invn'],
          'linha_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_line_invi'],
          'linha_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_line_srgr'],
          'linha_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_line_srst'],
          'linha_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_line_srbs'],
          'area_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_area_shpe'],
          'area_forma_area' => $this->Ini->Nm_lang['lang_flsh_chrt_area_area'],
          'area_forma_splin' => $this->Ini->Nm_lang['lang_flsh_chrt_area_spln'],
          'area_empil' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stak'],
          'area_empil_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stan'],
          'area_empil_ativa' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stay'],
          'area_empil_perce' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stap'],
          'area_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_area_invr'],
          'area_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_area_invn'],
          'area_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_area_invi'],
          'area_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_area_srgr'],
          'area_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_area_srst'],
          'area_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_area_srbs'],
          'marca_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_invr'],
          'marca_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_invn'],
          'marca_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_invi'],
          'marca_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_srgr'],
          'marca_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_srst'],
          'marca_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_srbs'],
          'gauge_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug_shpe'],
          'gauge_forma_circular' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug_circ'],
          'gauge_forma_semi' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug_semi'],
          'pyram_slice' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm_slic'],
          'pyram_slice_s' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm_opcs'],
          'pyram_slice_n' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm_opcn'],
      );
      if (!$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_prt'] = array();
          $_SESSION['scriptcase']['sc_idioma_prt']['es'] = array('titulo' => $this->Ini->Nm_lang['lang_btns_prtn_titl_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modoimp' => $this->Ini->Nm_lang['lang_btns_mode_prnt_hint'], 'curr' => $this->Ini->Nm_lang['lang_othr_curr_page'], 'total' => $this->Ini->Nm_lang['lang_othr_full'], 'cor' => $this->Ini->Nm_lang['lang_othr_prtc'], 'pb' => $this->Ini->Nm_lang['lang_othr_bndw'], 'color' => $this->Ini->Nm_lang['lang_othr_colr'], 'pdf_res' => $this->Ini->Nm_lang['lang_app_xls_summry'], 'pdf_cons' => $this->Ini->Nm_lang['lang_app_xls_grid'], 'cancela' => $this->Ini->Nm_lang['lang_btns_cncl_prnt_hint'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_word'] = array();
          $_SESSION['scriptcase']['sc_idioma_word']['es'] = array('titulo' => $this->Ini->Nm_lang['lang_export_title'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'cor' => $this->Ini->Nm_lang['lang_othr_prtc'], 'pb' => $this->Ini->Nm_lang['lang_othr_bndw'], 'color' => $this->Ini->Nm_lang['lang_othr_colr'], 'cancela' => $this->Ini->Nm_lang['lang_btns_cncl_prnt_hint'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_csv'] = array();
          $_SESSION['scriptcase']['sc_idioma_csv']['es'] = array('titulo' => $this->Ini->Nm_lang['lang_app_csv_title'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'delim_line' => $this->Ini->Nm_lang['lang_app_csv_lin_separator'], 'delim_col' => $this->Ini->Nm_lang['lang_app_csv_col_separator'], 'delim_dados' => $this->Ini->Nm_lang['lang_app_csv_txt_separator'], 'label_csv' => $this->Ini->Nm_lang['lang_app_csv_grid_label'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_xml'] = array();
          $_SESSION['scriptcase']['sc_idioma_xml']['es'] = array('titulo' => $this->Ini->Nm_lang['lang_export_title'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'xml_label' => $this->Ini->Nm_lang['lang_inherit_label'], 'xml_yes' => $this->Ini->Nm_lang['lang_pdff_chrt_yess'], 'xml_no' => $this->Ini->Nm_lang['lang_pdff_chrt_nooo'], 'xml_format' => $this->Ini->Nm_lang['lang_xml_tag_attr'], 'xml_attr' => $this->Ini->Nm_lang['lang_xml_formt_attr'], 'xml_tag' => $this->Ini->Nm_lang['lang_xml_formt_tag'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_json'] = array();
          $_SESSION['scriptcase']['sc_idioma_json']['es'] = array('titulo' => $this->Ini->Nm_lang['lang_export_title'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'json_label' => $this->Ini->Nm_lang['lang_inherit_label'], 'json_yes' => $this->Ini->Nm_lang['lang_pdff_chrt_yess'], 'json_no' => $this->Ini->Nm_lang['lang_pdff_chrt_nooo'], 'json_format' => $this->Ini->Nm_lang['lang_format_value'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_xls'] = array();
          $_SESSION['scriptcase']['sc_idioma_xls']['es'] = array('titulo' => $this->Ini->Nm_lang['lang_app_xls_title'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'tp_xls' => $this->Ini->Nm_lang['lang_app_xls_ext'], 'tot_xls' => $this->Ini->Nm_lang['lang_othr_export_excel_total'], 'xls_res' => $this->Ini->Nm_lang['lang_app_xls_summry'], 'xls_cons' => $this->Ini->Nm_lang['lang_app_xls_grid'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      $this->Ini->Gd_missing  = true;
      if (function_exists("getProdVersion"))
      {
          $_SESSION['scriptcase']['sc_prod_Version'] = str_replace(".", "", getProdVersion($this->Ini->path_libs));
      }
      if (function_exists("gd_info"))
      {
          $this->Ini->Gd_missing = false;
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_trata_img.php", "C", "nm_trata_img") ; 
      if ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_orig'])))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "inicio";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Grafico_pais']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['Grafico_pais']['start'] == 'filter')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "grid")  
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "busca";
          }   
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] != "detalhe" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_orig']) || !empty($nmgp_parms) || !empty($GLOBALS["nmgp_parms"])))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opc_liga'] = array();  
          if (isset($NMSC_conf_apl) && !empty($NMSC_conf_apl))
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opc_liga'] = $NMSC_conf_apl;  
          }   
      }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opc_liga']['paginacao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opc_liga']['paginacao']))
          { 
              $this->Ini->Apl_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opc_liga']['paginacao'];
          } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "busca")
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "grid" ;  
      }   
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao_print']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao_print']))  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao_print'] = "inicio" ;  
      }   
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['print_all'] = false;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "print")  
      { 
          if (strpos(" " . $this->Ini->SC_module_export, "grid") === false)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "res_print";
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "res_print")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao']     = "resumo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['print_all'] = true;
          if (strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "print";
              $nmgp_tipo_print = "RC";
          }
      } 
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'], 0, 7) == "grafico")  
      { 
          $_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "pdf")
      { 
          $this->Ini->path_img_modelo = $this->Ini->path_img_modelo;
      } 

      if (isset($_POST['nmgp_opcao']) && 'resumo' == $_POST['nmgp_opcao']
          &&
          isset($_POST['reload_summary_data']) && 'Y' == $_POST['reload_summary_data']
      ) {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['contr_array_resumo'] = 'NAO';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['contr_total_geral'] = 'NAO';
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['tot_geral']);
      }

      $this->Ini->grid_search_change_fil = false;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "grid_search" || $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "grid_search_res")
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "grid_search")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['orig_pesq'] = 'grid';
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "grid_search_res")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['orig_pesq'] = 'res';
          } 
          $this->SC_proc_grid_search($_POST['parm']);
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_pesq'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['contr_array_resumo'] = "NAO";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['contr_total_geral']  = "NAO";
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['tot_geral']);
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = 'pesq';
          ob_end_clean();
          $this->Ini->Arr_result = array();
          $this->Ini->Arr_result['exec_JS'][] = array('function' => 'Refresh_Chart', 'parm' => '');
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Ini->Arr_result);
          exit;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "grid_search_change_fil" || $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "grid_search_change_fil_res")
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "grid_search_change_fil")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['orig_pesq'] = 'grid';
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "grid_search_change_fil_res")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['orig_pesq'] = 'res';
          } 
          if (!$_SESSION['scriptcase']['proc_mobile']) 
          { 
              require_once($this->Ini->path_aplicacao . "Grafico_pais_pesq.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "Grafico_pais_mobile_pesq.class.php"); 
          } 
          $this->pesq  = new Grafico_pais_pesq();
          $this->prep_modulos("pesq");
          $this->pesq->NM_ajax_grid_fil = $_POST['parm'];
          $this->pesq->NM_ajax_flag     = true;
          $this->pesq->NM_ajax_opcao    = "ajax_grid_search_change_fil";
          $staus_fil = $this->pesq->monta_busca();
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_pesq'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['contr_array_resumo'] = "NAO";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['contr_total_geral']  = "NAO";
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['tot_geral']);
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = 'pesq';
          $this->Ini->grid_search_change_fil = true;
          ob_end_clean();
          $this->Ini->Arr_result = array();
          $this->Ini->Arr_result['exec_JS'][] = array('function' => 'Refresh_Chart', 'parm' => '');
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Ini->Arr_result);
          exit;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == 'pesq' && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['orig_pesq']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['orig_pesq']))  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['orig_pesq'] == "res")  
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = 'resumo';
          } 
          elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['orig_pesq'] == "grid") 
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = 'inicio';
          } 
      } 
//
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['prim_cons'] = false;  
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] != "detalhe" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_orig']) || !empty($nmgp_parms) || !empty($GLOBALS["nmgp_parms"])))  
      { 
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['use_pass_pdf']);
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['prim_cons'] = true;  
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_orig'] = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_orig'];  
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_orig'];  
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cond_pesq']         = ""; 
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_pesq_filtro'] = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_pesq_grid']   = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_pesq_lookup'] = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['campos_busca']      = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['grid_pesq']         = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['Grid_search']       = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['contr_total_geral'] = "NAO";
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['sc_total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['tot_geral']);
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['contr_array_resumo'] = "NAO";
      } 
      if (!in_array($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'], array('config_print', 'word_res', 'xls_res', 'xml_res', 'json_res', 'csv_res', 'rtf_res', 'image_res', 'ajax_comb_table', 'ajax_comb_save', 'ajax_comb_file_view', 'ajax_comb_file_download'))) {
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_pesq_ant'];  
      }
      $nm_flag_pdf   = true;
      $nm_vendo_pdf  = ("pdf" == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_pdf'] = "S";
      if (isset($nmgp_graf_pdf) && !empty($nmgp_graf_pdf))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_pdf'] = $nmgp_graf_pdf;
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
      {
         if ($nm_flag_pdf && $nm_vendo_pdf)
         {
            $nm_arquivo_htm_temp = $this->Ini->root . $this->Ini->path_imag_temp . "/sc_Grafico_pais_html_" . session_id() . "_2.html";
            $nm_arquivo_pdf_base = "/sc_pdf_" . md5(date("Ymd") . "_" . session_id()) . "_Grafico_pais.pdf";
            $nm_arquivo_pdf_url  = $this->Ini->path_imag_temp . $nm_arquivo_pdf_base;
            $nm_arquivo_pdf_serv = $this->Ini->root . $nm_arquivo_pdf_url;
            $nm_arquivo_de_saida = $this->Ini->root . $this->Ini->path_imag_temp . "/sc_Grafico_pais_html_" . session_id() . ".html";
            $nm_url_de_saida = $this->Ini->server_pdf . $this->Ini->path_imag_temp . "/sc_Grafico_pais_html_" . session_id() . ".html";
            if (in_array(trim($this->Ini->str_lang), $this->Ini->nm_font_ttf) && strtolower($_SESSION['scriptcase']['charset']) != "utf-8")
            { 
                $nm_saida->seta_arquivo($nm_arquivo_de_saida, $_SESSION['scriptcase']['charset']);
            }
            else
            { 
                $nm_saida->seta_arquivo($nm_arquivo_de_saida);
            }
         }
      }
//----------------------------------->
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "word_res" || $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "doc_word_res")
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
          {
              require_once($this->Ini->path_embutida . "Grafico_pais/" . $this->Ini->Apl_resumo);
          }
          else 
          {
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo);
          }
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao']);
          $this->outputCombinationWord();
      }
      else
      if ($this->NM_ajax_opcao == "ajax_comb_table")
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
          {
              require_once($this->Ini->path_embutida . "Grafico_pais/" . $this->Ini->Apl_resumo);
          }
          else 
          {
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo);
          }
          $this->outputCombinationTable();
      }
      else
      if ($this->NM_ajax_opcao == "ajax_comb_save")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_field_display_type'][ $_POST['sumcfg_field'] ] = $_POST['sumcfg_value'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_display_values'][ $_POST['sumcfg_field'] ]    = 1 == $_POST['sumcfg_display'];
          echo 'ok';
          exit;
      }
      else
      if ($this->NM_ajax_opcao == "ajax_comb_sort")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_rule']   = 'asc' == $_POST['sort_option'] || 'desc' == $_POST['sort_option'] ? $_POST['sort_option'] : '';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_field']  = $_POST['sort_field'];
          if ('orig' == $_POST['sort_option'])
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_forced'] = false;
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_forced'] = true;
          }
          echo 'ok';
          exit;
      }
      else
      if ($nmgp_opcao == "ajax_comb_file_view")
      {
          if (!isset($_SESSION['scriptcase']['chart_export_file']['Grafico_pais']) || !isset($_SESSION['scriptcase']['chart_export_file']['Grafico_pais'][ $_REQUEST['chart_file_md5'] ]))
          {
              echo 'error_file_not_found';
          }
          else
          {
              echo $this->Ini->path_imag_temp . '/' . $_SESSION['scriptcase']['chart_export_file']['Grafico_pais'][ $_REQUEST['chart_file_md5'] ]['name'];
          }
          exit;
      }
      else
      if ($nmgp_opcao == "ajax_comb_file_download")
      {
          if (!isset($_SESSION['scriptcase']['chart_export_file']['Grafico_pais']) || !isset($_SESSION['scriptcase']['chart_export_file']['Grafico_pais'][ $_REQUEST['chart_file_md5'] ]))
          {
              echo $this->Ini->Nm_lang['lang_errm_fnfd'];
          }
          else
          {
              $filename = $_SESSION['scriptcase']['chart_export_file']['Grafico_pais'][ $_REQUEST['chart_file_md5'] ]['name'];
              $path     = $_SESSION['scriptcase']['chart_export_file']['Grafico_pais'][ $_REQUEST['chart_file_md5'] ]['dir'] . $filename;
              header('Content-Type: text/html; charset=utf-8');
              header('Pragma: public', true);
              header('Content-type: application/force-download');
              header('Content-Disposition: attachment; filename=' . $filename);
              readfile($path);
          }
          exit;
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "print_res" || $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "res_print")
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
          {
              require_once($this->Ini->path_embutida . "Grafico_pais/" . $this->Ini->Apl_resumo);
          }
          else 
          {
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo);
          }
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao']);
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_progress_file']  = $_POST['export_progress_file'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_progress_step']  = 'init';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_progress_count'] = 0;
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_progress_total'] = 0;
          $this->outputCombinationPrint();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "config_print")
      { 
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao']);
          $this->outputCombinationPrintConfig();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "xls_res")
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
          {
              require_once($this->Ini->path_embutida . "Grafico_pais/" . $this->Ini->Apl_resumo);
          }
          else 
          {
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo);
          }
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao']);
          $this->outputCombinationXls();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "xml_res")
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
          {
              require_once($this->Ini->path_embutida . "Grafico_pais/" . $this->Ini->Apl_resumo);
          }
          else 
          {
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo);
          }
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao']);
          $this->outputCombinationXml();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "json_res")
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
          {
              require_once($this->Ini->path_embutida . "Grafico_pais/" . $this->Ini->Apl_resumo);
          }
          else 
          {
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo);
          }
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao']);
          $this->outputCombinationJson();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "csv_res")
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
          {
              require_once($this->Ini->path_embutida . "Grafico_pais/" . $this->Ini->Apl_resumo);
          }
          else 
          {
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo);
          }
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao']);
          $this->outputCombinationCsv();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "rtf_res")
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
          {
              require_once($this->Ini->path_embutida . "Grafico_pais/" . $this->Ini->Apl_resumo);
          }
          else 
          {
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo);
          }
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao']);
          $this->outputCombinationRtf();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "image_res" || $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "img_res")
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
          {
              require_once($this->Ini->path_embutida . "Grafico_pais/" . $this->Ini->Apl_resumo);
          }
          else 
          {
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo);
          }
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao']);
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_progress_file']  = $_POST['export_progress_file'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_progress_step']  = 'init';
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_progress_count'] = 0;
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_progress_total'] = 0;
          $this->outputCombinationImage();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "config_image")
      { 
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao']);
          $this->outputCombinationImageOptions();
      }
      else
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'], 0, 7) == "grafico")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
          { 
              require_once($this->Ini->path_embutida . " . Grafico_pais . /" . $this->Ini->Apl_grafico); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
          } 
          $this->Graf  = new Grafico_pais_grafico();
          $this->prep_modulos("Graf");
          if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'], 7, 1) == "_")  
          { 
              $this->Graf->grafico_col(substr($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'], 8));
              $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "grid";
          }
          else
          { 
              if (isset($_POST['summary_chart']) && 'Y' == $_POST['summary_chart'] && isset($_POST['chart_md5']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_info'][$_POST['chart_md5']])) {
                  $this->Graf->display_summaryChart_newPage($_POST['chart_md5']);
              }
              elseif (isset($_POST['chart_inline_create']) && 'Y' == $_POST['chart_inline_create'] && isset($_POST['chart_md5'])) {
                  $this->Graf->display_summaryChart_inline_initialAjaxResponse($_POST['chart_md5']);
              }
              elseif (isset($_POST['chart_inline_update']) && 'Y' == $_POST['chart_inline_update'] && isset($_POST['chart_md5']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_info'][$_POST['chart_md5']])) {
                  $this->Graf->display_summaryChart_inline_updateAjaxResponse($_POST['chart_md5']);
              }
              elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dashboard_refresh_after_chart'])) {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dashboard_refresh_after_chart'];
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['dashboard_refresh_after_chart']);
              }
              else {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] = "grid";
              }
              $this->Graf->monta_grafico();
          }
      }
      else 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "busca")  
      { 
          if (!$_SESSION['scriptcase']['proc_mobile']) 
          { 
              require_once($this->Ini->path_aplicacao . "Grafico_pais_pesq.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "Grafico_pais_mobile_pesq.class.php"); 
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['where_pesq'];  
          $this->pesq  = new Grafico_pais_pesq();
          $this->prep_modulos("pesq");
          $this->pesq->NM_ajax_flag    = $this->NM_ajax_flag;
          $this->pesq->NM_ajax_opcao   = $this->NM_ajax_opcao;
          $this->pesq->monta_busca();
      }
      else 
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "Grafico_pais/" . $this->Ini->Apl_resumo); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
          } 
          $this->Res = new Grafico_pais_resumo();
          $this->prep_modulos("Res");
          $this->Res->monta_resumo();
      }   
//--- 
      if (!$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'])
      {
           $this->Db->Close(); 
      }
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['embutida'])
      {
         $nm_saida->finaliza();
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['ajax_nav'])
         {
             $Temp = ob_get_clean();
             if ($Temp !== false && trim($Temp) != "")
             {
                 $this->Ini->Arr_result['htmOutput'] = $Temp;
             }
             if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] != "ajax_detalhe")  
             {
                 $this->Ini->Arr_result['setVar'][] = array('var' => 'scQtReg', 'value' => $this->Ini->Qtd_reg_ajax_grid);
             }
             $_SESSION['scriptcase']['saida_var'] = false;
             echo json_encode($this->Ini->Arr_result);
             exit;
         }
            if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_sel_columns']['field_order']))
            {
                $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_sel_columns']['field_order'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_sel_columns']['field_order']);
            }
            if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_sel_columns']['usr_cmp_sel']))
            {
                $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_sel_columns']['usr_cmp_sel'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_sel_columns']['usr_cmp_sel']);
            }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['doc_word'])
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['word_file'] = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_doc_word;
             $this->html_doc_word($nm_arquivo_doc_word, $nmgp_password);
         }
         if ($this->Ini->Export_html_zip)
         {
             $this->html_export_print($nm_arquivo_html, $nmgp_password);
         }
         if ($ajax_opc_print)
         {
             $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_print . ".html");
             $this->Arr_result['title_export'] = NM_charset_to_utf8($nm_arquivo_print);
             $Temp = ob_get_clean();
             if ($Temp !== false && trim($Temp) != "")
             {
                 $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
             }
             $oJson = new Services_JSON();
             echo $oJson->encode($this->Arr_result);
             exit;
        }
         if ($nm_flag_pdf && $nm_vendo_pdf)
         {
            if (isset($nmgp_parms_pdf) && !empty($nmgp_parms_pdf))
            {
                $str_pd4ml = " ";
                $Tps_pap   = array('Letter','Legal','Ledger','A0','A1','A2','A3','A4','A5','A6','B5','Tabloid','A7','A8','A9','B0','B1','B2','B3','B4','Executive','B6','B7','B8','B9','B10','C5E','Comm10E','DLE','Folio');
                $Tmp = explode ("__SC__", $nmgp_parms_pdf);
                foreach ($Tmp as $cada_p) {
                    if (substr($cada_p, 0, 1) == "p" && in_array(substr($cada_p, 1), $Tps_pap)) {
                        $str_pd4ml .= " --page-size " . substr($cada_p, 1);
                    }
                    if ($cada_p == "op") {
                        $str_pd4ml .= " --orientation Portrait";
                    }
                    if ($cada_p == "ol") {
                        $str_pd4ml .= " --orientation Landscape";
                    }
                    if ($cada_p == "bn") {
                        $str_pd4ml .= " --outline-depth 0";
                    }
                }
            }
            else
            {
                $str_pd4ml    = " --page-size A4 --orientation Portrait";
            }
            if (!$this->Ini->sc_export_ajax && !$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_det'])
            {
                if (-1 < $this->grid->progress_grid && $this->grid->progress_fp)
                {
                    $lang_protect = $this->Ini->Nm_lang['lang_pdff_gnrt'];
                    if (!NM_is_utf8($lang_protect))
                    {
                        $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
                    }
                    Grafico_pais_pdf_progress_call($this->grid->progress_tot . "_#NM#_" . $this->grid->progress_tot . "_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
                    fwrite($this->grid->progress_fp, ($this->grid->progress_tot) . "_#NM#_" . $lang_protect . "...\n");
                    fclose($this->grid->progress_fp);
                }
            }
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_name']))
            {
                $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_name'], ".");
                if ($Pos === false) {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_name'] .= ".pdf";
                }
                if ('/' == substr($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_name'], 0, 1)) {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_name'] = substr($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_name'], 1);
                }
                $nm_arquivo_pdf_serv = $this->Ini->root .  $this->Ini->path_imag_temp . "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_name'];
                $nm_arquivo_pdf_url  = $this->Ini->path_imag_temp . "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_name'];
                $nm_arquivo_pdf_base = "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_name'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_name']);
            }
            $arq_pdf_out  = (FALSE !== strpos($nm_arquivo_pdf_serv, ' ')) ? " \"" . $nm_arquivo_pdf_serv . "\"" :  $nm_arquivo_pdf_serv;
            $arq_pdf_in   = (FALSE !== strpos($nm_url_de_saida, ' '))     ? " \"" . $nm_url_de_saida . "\""     :  $nm_url_de_saida;
            if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
            {
                $dir_qpdf = "/qpdf/win/bin";
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
            {
                if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                {
                    $dir_qpdf = "/qpdf/linux-i386";
                }
                else
                {
                    $dir_qpdf = "/qpdf/linux-amd64";
                }
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
            {
                $dir_qpdf = "/qpdf/osx";
            }
            if ($this->pdf_zip == "S")
            {
                $arq_pdf_final = str_replace(".pdf", ".zip", $arq_pdf_out);
            }
            elseif (is_dir($this->Ini->path_third . $dir_qpdf) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['use_pass_pdf']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['use_pass_pdf']))
            {
                $arq_pdf_final = $arq_pdf_out;
                $arq_pdf_out   = str_replace(".pdf", "_wk.pdf", $arq_pdf_out);
            }
            $Win_autentication = "";
            if (isset($_SESSION['sc_pdf_usr']) && !empty($_SESSION['sc_pdf_usr']))
            {
                $_SESSION['sc_iis_usr'] = $_SESSION['sc_pdf_usr'];
            }
            if (isset($_SESSION['sc_iis_usr']) && !empty($_SESSION['sc_iis_usr']))
            {
                $Win_autentication .= " --username " . $_SESSION['sc_iis_usr'];
            }
            if (isset($_SESSION['sc_pdf_pw']) && !empty($_SESSION['sc_pdf_pw']))
            {
                $_SESSION['sc_iis_pw'] = $_SESSION['sc_pdf_pw'];
            }
            if (isset($_SESSION['sc_iis_pw']) && !empty($_SESSION['sc_iis_pw']))
            {
                $Win_autentication .= " --password " . $_SESSION['sc_iis_pw'];
            }
            if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
            {
                chdir($this->Ini->path_third . "/wkhtmltopdf/win");
                $str_execcmd2 = 'wkhtmltopdf ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
            {
                if (isset($_SERVER['NM_SC_SYS_CONFIG']) && $_SERVER['NM_SC_SYS_CONFIG'] == 1) 
                {
                    chdir($this->Ini->path_third . "/wkhtmltopdf/linux-amd64");
                    $str_execcmd2 = './wkhtmltopdf-amd64 ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
                }
                elseif (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                {
                    if (FALSE !== strpos(php_uname(), 'Debian 4.19')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/buster");
                    }
                    elseif (FALSE !== strpos(php_uname(), 'Debian 4.9')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/stretch");
                    }
                    else
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/linux-i386");
                    }
                    $str_execcmd2 = './wkhtmltopdf-i386 ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
                }
                else
                {
                    if (FALSE !== strpos(php_uname(), 'Debian 4.19')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/buster");
                    }
                    elseif (FALSE !== strpos(php_uname(), 'Debian 4.9')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/stretch");
                    }
                    elseif (FALSE !== strpos(strtolower(php_uname()), '.el8.') || preg_match('/.el8_[0-9]./', strtolower(php_uname())) ) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/centos8");
                    }
                    elseif (FALSE !== strpos(strtolower(php_uname()), '.el9.') || preg_match('/.el9_[0-9]./', strtolower(php_uname())) ) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/centos9");
                    }
                    else
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/linux-amd64");
                    }
                    $str_execcmd2 = './wkhtmltopdf-amd64 ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
                }
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
            {
                chdir($this->Ini->path_third . "/wkhtmltopdf/osx/Contents/MacOS");
                $str_execcmd2 = './wkhtmltopdf ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
            }

            if (!isset($_SESSION['scriptcase']['phantomjs_charts']) || !$_SESSION['scriptcase']['phantomjs_charts'])
            {
                $str_execcmd2 .= ' --javascript-delay ' . 2000;
            }

            $str_execcmd2 .= ' --disable-local-file-access ' . $arq_pdf_in . ' ' . $arq_pdf_out;

            $arr_execcmd = array();
            $str_execcmd = $str_execcmd2;
            exec($str_execcmd2);
            $str_cmd_qpdf = "";
            $str_zip      = "";
            if ($this->pdf_zip == "S")
            {
                $pdf_pass = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['use_pass_pdf'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['use_pass_pdf'] : "";
                $opt_pass = (!empty($pdf_pass)) ? " -p" : "";
                if (is_file($arq_pdf_final)) {
                    unlink($arq_pdf_final);
                }
                if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                {
                    chdir($this->Ini->path_third . "/zip/windows");
                    $str_zip = "zip.exe" . strtoupper($opt_pass) . " -j " . $pdf_pass . " " . $arq_pdf_final . " " . $arq_pdf_out;
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
                      $str_zip = "./7za" . $opt_pass . $pdf_pass . " a " . $arq_pdf_final . " " . $arq_pdf_out;
                }
                elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                {
                    chdir($this->Ini->path_third . "/zip/mac/bin");
                    $str_zip = "./7za" . $opt_pass . $pdf_pass . " a " . $arq_pdf_final . " " . $arq_pdf_out;
                }
                if (!empty($str_zip)) {
                    exec($str_zip);
                }
                if (is_file($arq_pdf_final)) 
                {
                    unlink($arq_pdf_out);
                }
            }
            elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['use_pass_pdf']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['use_pass_pdf']))
            {
                if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                {
                    $dir_qpdf = "/qpdf/win/bin";
                    $str_cmd_qpdf = "qpdf.exe ";
                }
                elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                {
                    if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                    {
                        $dir_qpdf = "/qpdf/linux-i386";
                        $str_cmd_qpdf = "./qpdf-linux-x86 ";
                    }
                    else
                    {
                        $dir_qpdf = "/qpdf/linux-amd64";
                        $str_cmd_qpdf = "./qpdf-linux-amd64 ";
                    }
                }
                elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                {
                    $dir_qpdf = "/qpdf/osx";
                    $str_cmd_qpdf = "./qpdf-darwin-x86 ";
                }
                if (is_dir($this->Ini->path_third . $dir_qpdf)) 
                {
                    chdir($this->Ini->path_third . $dir_qpdf);
                    $pdf_pass  = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['use_pass_pdf'];
                    $str_cmd_qpdf .= "--encrypt " . $pdf_pass . " " . $pdf_pass . " 256 -- " . $arq_pdf_out . " " . $arq_pdf_final;
                    exec($str_cmd_qpdf);
                    if (is_file($arq_pdf_final)) 
                    {
                        unlink($arq_pdf_out);
                    }
                }
            }
            $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['contr_array_resumo'] = '';
            $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['contr_total_geral']  = '';
            // ----- PDF log
            $fp = @fopen($this->Ini->root . $this->Ini->path_imag_temp . str_replace(array(".pdf",".zip"), array("",""), $nm_arquivo_pdf_base) . '.log', 'w');
            if ($fp)
            {
                @fwrite($fp, $str_execcmd . "\r\n\r\n");
                @fwrite($fp, implode("\r\n", $arr_execcmd));
                @fwrite($fp, $str_cmd_qpdf . "\r\n\r\n");
                @fwrite($fp, $str_zip . "\r\n\r\n");
                @fclose($fp);
            }
            if ($this->Ini->sc_export_ajax)
            {
                $this->Arr_result['file_export']  = NM_charset_to_utf8($nm_arquivo_pdf_serv);
                $this->Arr_result['title_export'] = NM_charset_to_utf8(substr($nm_arquivo_pdf_base, 1));
                $Temp = ob_get_clean();
                if ($Temp !== false && trim($Temp) != "")
                {
                    $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
                }
                $oJson = new Services_JSON();
                echo $oJson->encode($this->Arr_result);
                exit;
            }
            if (in_array(trim($this->Ini->str_lang), $this->Ini->nm_font_ttf) && strtolower($_SESSION['scriptcase']['charset']) != "utf-8")
            { 
               $_SESSION['scriptcase']['charset_html'] = (isset($this->Ini->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->Ini->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
            }
            if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_det'])
            {
                if (-1 < $this->grid->progress_grid && $this->grid->progress_fp)
                {
                    $this->grid->progress_fp = fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp', 'a');
                    if ($this->grid->progress_fp)
                    {
                         $lang_protect = $this->Ini->Nm_lang['lang_pdff_fnsh'];
                         if (!NM_is_utf8($lang_protect))
                         {
                             $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
                          }
                        Grafico_pais_pdf_progress_call($this->grid->progress_tot . "_#NM#_" . ($this->grid->progress_now + 1 + $this->grid->progress_pdf) . "_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
                        Grafico_pais_pdf_progress_call("off\n", $this->Ini->Nm_lang);
                        fwrite($this->grid->progress_fp, ($this->grid->progress_now + 1 + $this->grid->progress_pdf) . "_#NM#_" . $lang_protect . "...\n");
                        fwrite($this->grid->progress_fp, "off\n");
                        fclose($this->grid->progress_fp);
                    }
                }
            }
unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_file']);
if (is_file($nm_arquivo_pdf_serv))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_file'] = $nm_arquivo_pdf_serv;
}
if ($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opcao'] == "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pdf_det'])
{
  $NM_volta  = "resumo";
  $NM_target = "_self";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_chart_title'] ?> pais :: PDF</TITLE>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?>" GMT">
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0">
 <META http-equiv="Pragma" content="no-cache">
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <?php 
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
 { 
 ?> 
 <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
 <?php 
 } 
 ?> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY>
<?php echo $this->Ini->Ajax_result_set ?>
<table class="scGridTabela" valign="top"><tr class="scGridFieldOddVert"><td>
<?php
}
                    $rRFP = fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp', "w");
                    fwrite($rRFP, "PDF\n");
                    fwrite($rRFP, "\n");
                    fwrite($rRFP, "\n");
                    fwrite($rRFP, "100\n");
                    fwrite($rRFP, 1 . "_#NM#_" . $this->Ini->Nm_lang['lang_pdff_gnrt'] . "...\n");
                    fwrite($rRFP, 100 . "_#NM#_" . $this->Ini->Nm_lang['lang_pdff_fnsh'] . "...\n");
                    fwrite($rRFP, "off\n");
                    fclose($rRFP);
$downloadFileName = "Grafico_pais.pdf";
if ($this->pdf_zip == 'S') {
    $nm_arquivo_pdf_serv = str_replace('.pdf', '.zip', $nm_arquivo_pdf_serv);
    $nm_arquivo_pdf_url = str_replace('.pdf', '.zip', $nm_arquivo_pdf_url);
    $downloadFileName = str_replace('.pdf', '.zip', $downloadFileName);
}
if (!is_file($nm_arquivo_pdf_serv))
{
?>
  <br><b><?php echo $this->Ini->Nm_lang['lang_pdff_errg']; ?></b></td></tr></table>
<script type="text/javascript">
if (window.parent && typeof window.parent.displayErrorPdf === "function") {
    window.parent.displayErrorPdf("<?php echo $this->Ini->Nm_lang['lang_pdff_errg']; ?>");
}
</script>
<?php
}
else
{
?>
<?php echo $this->Ini->Nm_lang['lang_pdff_file_loct']; ?>
<BR>
<A href="<?php echo $nm_arquivo_pdf_url; ?>" target="_blank" class="scGridPageLink"><B><?php echo $nm_arquivo_pdf_url; ?></B></A>.
<BR>
<?php echo $this->Ini->Nm_lang['lang_pdff_clck_mesg']; ?>
</td></tr></table>
<script type="text/javascript">
if (window.parent && typeof window.parent.updateGeneratedPdfFile === "function") {
    window.parent.updateGeneratedPdfFile("<?php echo $nm_arquivo_pdf_url; ?>");
}
</script>
<?php
    $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][md5("newpdf_" . $downloadFileName)][0] = $nm_arquivo_pdf_url;
    $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][md5("newpdf_" . $downloadFileName)][1] = $downloadFileName;
}
   echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "sc_b_sai", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<FORM name="F0" method=post action="./" target="<?php echo $NM_target; ?>"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($NM_volta); ?>"> 
</FORM>
</td></tr></table>
</BODY>
</HTML>
<?php
         }
      }
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

    function outputCombinationTable()
    {
        list($tableDef, $tableData) = $this->outputCombinationData();
?>
<table class="scGridTabela">
 <tr class="scGridLabel">
  <td class="scGridLabelFont">&nbsp;</td>
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['label'] as $series_name)
        {
            $series_name = $_SESSION['scriptcase']['charset'] != 'UTF-8' ? sc_convert_encoding($series_name, $_SESSION['scriptcase']['charset'], 'UTF-8') : $series_name;
?>
  <td class="scGridLabelFont"><?php echo $series_name; ?></td>
<?php
        }
?>
 </tr>
<?php
        $this->outputCombinationTableRow($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableData], 0, $tableDef);
?>
</table>
<?php
        exit;
    } // outputCombinationTable

    function outputCombinationTableRow($rows, $level, $tableDef)
    {
        foreach ($rows as $data)
        {
            $str_label = $_SESSION['scriptcase']['charset'] != 'UTF-8' ? sc_convert_encoding($data['label'], $_SESSION['scriptcase']['charset'], 'UTF-8') : $data['label'];
?>
 <tr>
  <td class="scGridBlock scGridBlockFont"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $level) . $str_label; ?></td>
<?php
            foreach ($data['values'] as $index => $value)
            {
?>
  <td class="scGridFieldOdd scGridFieldOddFont" style="text-align: right"><?php echo Grafico_pais_resumo::formatValue($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['summ'][$index], $value); ?></td>
<?php
            }
?>
 </tr>
<?php
            if (!empty($data['children']))
            {
                $this->outputCombinationTableRow($data['children'], $level + 1, $tableDef);
            }
        }
    } // outputCombinationTableRow

    function outputCombinationPassword($fixedPassword = '') {
        if ('' != $fixedPassword) {
            return $fixedPassword;
        } elseif (isset($_POST['export_pwd'])) {
            return $_POST['export_pwd'];
        } elseif (isset($_POST['nmgp_password'])) {
            return $_POST['nmgp_password'];
        } else {
            return '';
        }
    } // outputCombinationPassword

	function outputCombinationZipPassword($type, $fileName, $password) {
		$zipCommand  = "";
		$tempDir     = $this->Ini->root . $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp'] . '/';
		$zipFile     = 'sc_zip_' . md5(microtime() . rand(1, 1000) . session_id()) . '.zip';
		$zipFileFull = (FALSE !== strpos($tempDir . $zipFile,  ' ')) ? "\"{$tempDir}{$zipFile}\""  : $tempDir . $zipFile;
		$fileName    = (FALSE !== strpos($tempDir . $fileName, ' ')) ? "\"{$tempDir}{$fileName}\"" : $tempDir . $fileName;

		if (FALSE !== strpos(strtolower(php_uname()), 'windows')) {
			chdir("{$this->Ini->path_third}/zip/windows");
			$zipCommand = "zip.exe -P -j {$password} {$zipFileFull} {$fileName}";
		}
		elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) {
			if (FALSE !== strpos(strtolower(php_uname()), 'i686')) {
				chdir("{$this->Ini->path_third}/zip/linux-i386/bin");
			}
			else {
				chdir("{$this->Ini->path_third}/zip/linux-amd64/bin");
			}
			$zipCommand = "./7za -p{$password} a {$zipFileFull} {$fileName}";
		}
		elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin')) {
			chdir("{$this->Ini->path_third}/zip/mac/bin");
			$zipCommand = "./7za -p{$password} a {$zipFileFull} {$fileName}";
		}

		if (!empty($zipCommand)) {
			exec($zipCommand);
		}

		return $zipFile;
	} // outputCombinationZipPassword

	function outputCombinationData() {
		if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['anlt_table_def']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['anlt_table_def'])) {
			return array('anlt_table_def', 'anlt_table_data');
		}
		else {
			return array('comb_table_def', 'comb_table_data');
		}
	} // outputCombinationData

	function outputCombinationExport($type, $content, $password) {
		$dateTime = date('YmdHis');
		$fileSeq  = substr(md5(microtime() . session_id()), 10, 3);
		$fileDir  = "{$_SESSION['scriptcase']['dir_temp']}/";
		$fileName = "sc_{$type}_{$dateTime}_{$fileSeq}_Grafico_pais.{$type}";

		$testFilename = $type;
		if($type=='doc'|| $type=='docx') {
			$testFilename = 'word';
		}
		elseif($type=='xlsx') {
			$testFilename = 'xls';
		}
		if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$testFilename . '_name'])) {
			$fileName = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$testFilename . '_name'];
		}
		$filePath = $fileDir . $fileName;
		$fileMd5  = md5(microtime() . session_id() . $filePath);

		$this->outputCombinationSaveFile($type, $content, $filePath);

		if ('' != $password && 'image' != $type) {
			$fileName = $this->outputCombinationZipPassword($type, $fileName, $password);
			$filePath = $fileDir . $fileName;
			$fileMd5  = md5(microtime() . session_id() . $filePath);
		}

		if (!isset($_SESSION['scriptcase']['chart_export_file']['Grafico_pais'])) {
			$_SESSION['scriptcase']['chart_export_file']['Grafico_pais'] = array();
		}
		$_SESSION['scriptcase']['chart_export_file']['Grafico_pais'][$fileMd5] = array(
			'dir'  => $fileDir,
			'name' => $fileName
		);

		switch ($type) {
			case 'csv':
				if ($this->Ini->sc_export_ajax) {
					$this->outputCombinationEmail($fileName);
				}
				else {
					$this->outputCombinationHtml($type, $fileMd5, $fileName);
				}
				break;

			case 'doc':
				if ($this->Ini->sc_export_ajax) {
					$this->outputCombinationEmail($fileName);
				}
				else {
					$this->outputCombinationHtml($type, $fileMd5, $fileName);
				}
				break;

			case 'html':
				if ($this->Ini->sc_export_ajax) {
					$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_print_files'][] = $fileName;

					$this->outputCombinationEmail($this->Res->zipFileList($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_print_files']));
				}
				else {
					$this->outputCombinationFile($type, $fileMd5, $fileName);
				}
				break;

			case 'image':
				$this->Res = new Grafico_pais_resumo();
				$this->prep_modulos('Res');
				$this->Res->filterChartsByGroupbyLevel();
				$this->Res->filterChartsByMultiseries();

				if ($this->Ini->sc_export_ajax) {
					$this->outputCombinationEmail($this->Res->zipChartImages($password));
				}
				else {
					$this->outputCombinationFile($type, $fileMd5, $this->Res->zipChartImages($password));
				}
				break;

			case 'rtf':
				if ($this->Ini->sc_export_ajax) {
					$this->outputCombinationEmail($fileName);
				}
				else {
					$this->outputCombinationHtml($type, $fileMd5, $fileName);
				}
				break;

            case 'xls':
            case 'xlsx':
                if ($this->Ini->sc_export_ajax) {
                    $this->outputCombinationEmail($fileName);
                }
                else {
                    $this->outputCombinationHtml($type, $fileMd5, $fileName);
                }
                break;

			case 'xml':
				if ($this->Ini->sc_export_ajax) {
					$this->outputCombinationEmail($fileName);
				}
				else {
					$this->outputCombinationHtml($type, $fileMd5, $fileName);
				}
				break;

			case 'json':
				if ($this->Ini->sc_export_ajax) {
					$this->outputCombinationEmail($fileName);
				}
				else {
					$this->outputCombinationHtml($type, $fileMd5, $fileName);
				}
				break;
		}
	} // outputCombinationExport

	function outputCombinationSaveFile($type, $content, $filePath) {
		switch ($type) {
			case 'rtf':
				global $doc_wrap;
				require_once "{$this->Ini->path_third}/rtf_new/document_generator/cl_xml2driver.php";
				$docGen = new nDOCGEN($content, 'RTF');
				@file_put_contents($filePath, $docGen->get_result_file());
				break;
            case 'xls':
                 if ($this->Use_phpspreadsheet) {
                    $xlsWriter = new PhpOffice\PhpSpreadsheet\Writer\Xls($this->xlsFile);
                 }
                 else {
                    $xlsWriter = new PHPExcel_Writer_Excel5($this->xlsFile);
                 }
                 $xlsWriter->save($filePath);
                break;
            case 'xlsx':
                 if ($this->Use_phpspreadsheet) {
                    $xlsWriter = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($this->xlsFile);
                 }
                 else {
                    $xlsWriter = new PHPExcel_Writer_Excel2007($this->xlsFile);
                 }
                 $xlsWriter->save($filePath);
                break;
		    case 'csv':
			case 'doc':
			case 'html':
			case 'xml':
			default:
				@file_put_contents($filePath, $content);
				break;

			}
	} // outputCombinationSaveFile

	function outputCombinationEmail($fileName) {
		$jsonResult = array(
			'file_export'  => "{$this->Ini->root}{$this->Ini->path_imag_temp}/{$fileName}",
			'title_export' => $fileName
		);

		$oJson = new Services_JSON();
		echo $oJson->encode($jsonResult);

		exit;
	} // outputCombinationEmail

	function outputCombinationFile($type, $fileMd5, $fileName) {
		echo "{$this->Ini->path_imag_temp}/{$fileName}";
	} // outputCombinationFile

	function outputCombinationFileDownload($type, $fileMd5, $fileName) {
		header("Content-Description: File Transfer");
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename={$fileName}");
		readfile("{$this->Ini->path_imag_temp}/{$fileName}");
		exit;
	} // outputCombinationFileDownload

	function outputCombinationHtml($type, $fileMd5, $fileName) {
		$viewButton     = nmButtonOutput($this->arr_buttons, "bexportview", "chartExportView()", "chartExportView()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
;
		$downloadButton = nmButtonOutput($this->arr_buttons, "bdownload", "chartExportDownload()", "chartExportDownload()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
;
		$backButton     = nmButtonOutput($this->arr_buttons, "bcancelar", "scHideCombinationTable()", "scHideCombinationTable()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
;

		$typeUpper = strtoupper($type);

		$scriptcaseInit    = NM_encode_input($this->Ini->sc_page);
		$scriptcaseSession = NM_encode_input(session_id());

		$errorMessage = $this->Ini->Nm_lang['lang_errm_fnfd'];

		echo <<<SCEOT
<script type="text/javascript">
function chartExportView() {
	$.ajax({
		type: "POST",
		url: "index.php",
		data: {
			script_case_init: "$scriptcaseInit",
			nmgp_opcao: "ajax_comb_file_view",
			chart_file_md5: "$fileMd5"
		}
	}).done(function(data) {
		if ("error_file_not_found" == data) {
			alert("$errorMessage");
		}
		else {
			document.form_chart_export_view.action = data;
			document.form_chart_export_view.submit();
		}
		scHideCombinationTable();
	});
}
function chartExportDownload() {
	document.form_chart_export_download.submit();
	scHideCombinationTable();
}
</script>
<link rel="stylesheet" type="text/css" href="../_lib/css/{$this->Ini->str_schema_all}_export.css" />
<link rel="stylesheet" type="text/css" href="../_lib/css/{$this->Ini->str_schema_all}_export{$_SESSION['scriptcase']['reg_conf']['css_dir']}.css" />
<form name="form_chart_export_download" method="get" action="index.php" target="_blank" style="display: none">
<input type="hidden" name="script_case_init" value="$scriptcaseInit">
<input type="hidden" name="nmgp_opcao" value="ajax_comb_file_download">
<input type="hidden" name="chart_file_md5" value="$fileMd5">
</form>
<form name="form_chart_export_view" method="get" target="_blank" style="display: none">
</form>

SCEOT;
        if ($_SESSION['scriptcase']['proc_mobile']) {
            echo <<<SCEOT
<style>
div#sc-id-combination-content {
    padding-top: 0 !important;
}
.sc-chart-mobile-export-buttons .scButton_default, .sc-chart-mobile-export-buttons .scButton_danger {
    margin: 10px;
    flex-display: column;
    text-align: center;
}
</style>
<table style="border-collapse: collapse; border-width: 0; width: 100%">
	<tr>
		<td style="padding: 0; text-align: center">
			<table class="scExportTable" align="center">
				<tr>
					<td class="scExportTitle" style="height: 25px">$typeUpper</td>
				</tr>
				<tr>
				    <td class="scExportLine sc-chart-mobile-export-buttons" style="display: flex; flex-direction: column; max-width: 100vw; padding: 3px 5px 0">
                        $viewButton
                        $downloadButton
                        $backButton
                    </td>
                </tr>
			</table>
		</td>
	</tr>
</table>

SCEOT;
        } else {
            echo <<<SCEOT
<table style="border-collapse: collapse; border-width: 0; height: 98%; width: 100%">
	<tr>
		<td style="padding: 0; text-align: center; vertical-align: middle">
			<table class="scExportTable" align="center">
				<tr>
					<td class="scExportTitle" style="height: 25px">$type</td>
				</tr>
				<tr>
					<td class="scExportLineFont" style="padding: 3px 5px 0">$fileName</td>
				</tr>
				<tr>
					<td class="scExportLineFont" style="text-align:right; padding: 3px 5px 0">
						$viewButton
						$downloadButton
						$backButton
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

SCEOT;
        }
	} // outputCombinationHtml

	function outputCombinationHasChildren($data) {
		foreach ($data as $dataItem) {
			if (isset($dataItem['children']) && is_array($dataItem['children']) && !empty($dataItem['children'])) {
				return true;
				break;
			}
		}

		return false;
	} // outputCombinationHasChildren

	//---------- PRINT

	function outputCombinationPrintConfig() {
		$selectTypeLabel  = wordwrap($this->Ini->Nm_lang['lang_pdff_type'], 25, '<br />', true);
		$selectLevelLabel = wordwrap($this->Ini->Nm_lang['lang_chart_level_groupby'], 25, '<br />', true);

		$exportType = (isset($_POST['exportType']))?$_POST['exportType']:'';

		$hasOneGroupByLevel = 1 >= count($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['Labels_GB']);
		$isMultiSeriesChart = !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_drill_down']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_drill_down'];

		$htmlCode = <<<SCEOT
<input type="hidden" id="sc-id-print-export-type" value="{$exportType}" />
<table class="scGridTabela" cellspacing="0" cellpadding="0">
	<tr>
		<td class="scGridLabelVert">{$this->Ini->Nm_lang['lang_chrt_img_cfg']}</td>
	</tr>
	<tr>
		<td class="scGridFieldOdd scGridFieldOddFont">
			<table style="border-collapse: collapse; border-width: 0px">
				<input type="hidden" id="sc-id-chart-print-color" value="color" />

SCEOT;

		$displayGroupByLevel = $hasOneGroupByLevel || $isMultiSeriesChart ? ' style="display: none"' : '';

		$htmlCode .= <<<SCEOT
				<tr{$displayGroupByLevel}>
					<td class="scGridFieldOddFont">$selectLevelLabel</td>
					<td class="scGridFieldOddFont">

SCEOT;

		$lastGroupby = count($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['Labels_GB']) - 1;
		foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['Labels_GB'] as $groupbyIndex => $groupbyLabel) {
			$selected = ($lastGroupby == $groupbyIndex) ? ' checked' : '';
			$optionId = 'sc-id-opt-' . substr(md5(microtime() . session_id()), 12, 6);

			$htmlCode .= <<<SCEOT
						<input type="radio" class="sc-id-chart-print-level" name="chart_level_print" value="$groupbyIndex"$selected id="$optionId" /> <label for=" $optionId">$groupbyLabel</label><br />

SCEOT;
		}

		$okButton    = nmButtonOutput($this->arr_buttons, "bok", "scChartPrintExportProcess()", "scChartPrintExportProcess()", "bok", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
;
		$closeButton = nmButtonOutput($this->arr_buttons, "bsair", "scChartPrintExportHide()", "scChartPrintExportHide()", "bsair", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
;

		$htmlCode .= <<<SCEOT
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="scGridToolbar" style="text-align: center">
			$okButton
			$closeButton
		</td>
	</tr>
</table>

SCEOT;

		echo $htmlCode;
		exit;
	} // outputCombinationPrintConfig

	function outputCombinationPrint() {
		$this->outputCombinationExport('html', $this->outputCombinationPrintContent(), $this->outputCombinationPassword(''));
	} // outputCombinationPrint

	function outputCombinationPrintContent() {
		return "<html {$_SESSION['scriptcase']['reg_conf']['html_dir']}>\r\n" .
		       "<head>\r\n" .
		       "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n" .
			   $this->outputCombinationPrintCss() .
		       "</head>\r\n" .
		       "<body class=\"scGridPage\">\r\n" .
		       "<table class=\"scGridTabela\">\r\n" .
		       $this->outputCombinationPrintCharts() .
		       "</table>\r\n" .
		       "</body>\r\n" .
		       "</html>\r\n";
	} // outputCombinationPrintContent

	function outputCombinationPrintCss() {
		$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_export_print_css'] = 'color';

		if ('bw' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_export_print_css']) {
			$cssFile    = "{$this->Ini->str_schema_all}_grid_bw.css";
			$cssDirFile = "{$this->Ini->str_schema_all}_grid_bw{$_SESSION['scriptcase']['reg_conf']['css_dir']}.css";
		}
		else {
			$cssFile    = "{$this->Ini->str_schema_all}_grid.css";
			$cssDirFile = "{$this->Ini->str_schema_all}_grid_bw{$_SESSION['scriptcase']['reg_conf']['css_dir']}.css";
		}

		if (!@is_file($this->Ini->path_css . $cssFile)) {
			return '';
		}

		return "<style type=\"text/css\">\r\n" .
		       @file_get_contents($this->Ini->path_css . $cssFile) .
		       @file_get_contents($this->Ini->path_css . $cssDirFile) .
		       "</style>\r\n";
	} // outputCombinationPrintCss

	function outputCombinationPrintCharts() {
		require_once $this->Ini->path_third . '/zipfile/zipfile.php';

		$outputData = '';

		$this->Res = new Grafico_pais_resumo();
		$this->prep_modulos('Res');
		$this->Res->filterChartsByGroupbyLevel();
		$this->Res->filterChartsByMultiseries();

		$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_print_bw'] = isset($_POST['export_chart_bw']) && 'Y' == $_POST['export_chart_bw'];

		$chartImages = $this->Res->generateChartImages();

		$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_print_bw'] = false;

		foreach ($chartImages as $chartImageName) {
			$outputData .= "<tr>\r\n";
			$outputData .= "<td><img src=\"$chartImageName\" /></td>\r\n";
			$outputData .= "</tr>\r\n";
		}

		$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_print_files'] = $chartImages;

		return $outputData;
	} // outputCombinationPrintCharts

    //---------- JSON

    function outputCombinationJson()
    {
        $this->outputCombinationJsonConfig();
        list($tableDef, $tableData) = $this->outputCombinationData();
        $this->outputCombinationExport('json', $this->outputCombinationJsonContent($tableDef, $tableData), $this->outputCombinationPassword(''));
    } // outputCombinationXml

    function outputCombinationJsonConfig()
    {
        $this->jsonShowFormatted = false;
        $this->jsonShowLabel = true;

        if (isset($_REQUEST['nm_json_format'])) {
            if ('S' == $_REQUEST['nm_json_format']) {
                $this->jsonShowFormatted = true;
            } elseif ('N' == $_REQUEST['nm_json_format']) {
                $this->jsonShowFormatted = false;
            }
        }

        if (isset($_REQUEST['nm_json_label'])) {
            if ('S' == $_REQUEST['nm_json_label']) {
                $this->jsonShowLabel = true;
            } elseif ('N' == $_REQUEST['nm_json_label']) {
                $this->jsonShowLabel = false;
            }
        }
    } // outputCombinationJsonConfig

    function outputCombinationJsonContent($tableDef, $tableData)
    {
        $jsonData = $this->outputCombinationJsonRow($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableData], 0, $tableDef);

        $json = json_encode($jsonData, JSON_UNESCAPED_UNICODE);
        if (!$json) {
            $oJson = new Services_JSON();
            $json = $oJson->encode($jsonData);
        }

        return $json;
    } // outputCombinationJsonContent

    function outputCombinationJsonRow($rows, $level, $tableDef) {
        $outputData = array();

        foreach ($rows as $data) {
            $groupByField = $data['field_x'];
            $thisLabel = $_SESSION['scriptcase']['charset'] != 'UTF-8' ? sc_convert_encoding($data['label'], $_SESSION['scriptcase']['charset'], 'UTF-8') : $data['label'];
/* mantis 0019720  */
            $thisLabel = NM_charset_to_utf8($thisLabel);

            $thisRecord = array(
                'field' => $data['field_x'],
                'value' => $this->outputCombinationJsonProtectText($thisLabel)
            );

            if ($this->jsonShowLabel) {
            	$thisRecord['label'] = $this->outputCombinationJsonProtectText($data['label_x']);
            }

            foreach ($data['values'] as $index => $value) {
                $thisMetric = array(
                    'field' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['field'][$index],
                    'value' => $this->outputCombinationJsonProtectNumber($value)
                );

                if ($this->jsonShowFormatted) {
                	$thisMetric['formatted'] = $this->outputCombinationJsonProtectNumber(Grafico_pais_resumo::formatValue($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['summ'][$index], $value));
                }
                if ($this->jsonShowLabel) {
                	$thisMetric['label'] = $this->outputCombinationJsonProtectText($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['label'][$index]);
                }

                $thisRecord['metrics'][] = $thisMetric;
            }

            if (!empty($data['children'])) {
                $thisRecord = array_merge($thisRecord, $this->outputCombinationJsonRow($data['children'], $level + 1, $tableDef));
            }

            $outputData[] = $thisRecord;
        }

        return array('dimension' => $outputData);
    } // outputCombinationJsonRow

    function outputCombinationJsonProtectText($value) {
        return $value;
    } // outputCombinationJsonProtectText

    function outputCombinationJsonProtectNumber($value) {
        return $value;
    } // outputCombinationJsonProtectNumber

	//---------- XML

	function outputCombinationXml() {
        $this->outputCombinationXmlConfig();
		list($tableDef, $tableData) = $this->outputCombinationData();
		$this->outputCombinationExport('xml', $this->outputCombinationXmlContent($tableDef, $tableData), $this->outputCombinationPassword(''));
	} // outputCombinationXml

    function outputCombinationXmlConfig()
    {
        $this->xmlDisplayAsAttributes = false;
        $this->xmlLabel = true;

        if (isset($_REQUEST['nm_xml_tag'])) {
            if ('tag' == $_REQUEST['nm_xml_tag']) {
                $displayAsAttributes = false;
            } elseif ('attribute' == $_REQUEST['nm_xml_tag']) {
                $this->xmlDisplayAsAttributes = true;
            }
        }

        if (isset($_REQUEST['nm_xml_label'])) {
            if ('S' == $_REQUEST['nm_xml_label']) {
                $this->xmlLabel = true;
            } elseif ('N' == $_REQUEST['nm_xml_label']) {
                $this->xmlLabel = false;
            }
        }
    } // outputCombinationXmlConfig

	function outputCombinationXmlContent($tableDef, $tableData) {
		return "<?xml version=\"1.0\" encoding=\"{$_SESSION['scriptcase']['charset']}\" ?>\r\n" .
		       "<Grafico_pais>\r\n" .
		       $this->outputCombinationXmlRow($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableData], 0, $tableDef) .
		       "</Grafico_pais>";
	} // outputCombinationXmlContent

	function outputCombinationXmlRow($rows, $level, $tableDef) {
		$outputData = '';

		foreach ($rows as $data) {
			$thisLabel = $_SESSION['scriptcase']['charset'] != 'UTF-8' ? sc_convert_encoding($data['label'], $_SESSION['scriptcase']['charset'], 'UTF-8') : $data['label'];

			$groupByLabelTag = $this->xmlLabel ? $this->outputCombinationXmlProtectTag($data['label_x']) : $data['field_x'];

			if ($this->xmlDisplayAsAttributes) {
				$outputData .= "<groupby_{$groupByLabelTag} label=\"" . $this->outputCombinationXmlProtectText($data['label_x']) . "\" value=\"" . $this->outputCombinationXmlProtectText($thisLabel) . "\">\r\n";
			} else {
				$outputData .= "<groupby_{$groupByLabelTag}>\r\n";
				$outputData .= "<label>" . $this->outputCombinationXmlProtectText($data['label_x']) . "</label>\r\n";
				$outputData .= "<value>" . $this->outputCombinationXmlProtectText($thisLabel) . "</value>\r\n";
			}

			foreach ($data['values'] as $index => $value) {
				$aggregateLabelTag = $this->xmlLabel ? $this->outputCombinationXmlProtectTag($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['label'][$index]) : $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['field'][$index];

				if ($this->xmlDisplayAsAttributes) {
					$outputData .= "<aggregate_{$aggregateLabelTag} label=\"" . $this->outputCombinationXmlProtectText($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['label'][$index]) . "\" value=\"" . $this->outputCombinationXmlProtectNumber(Grafico_pais_resumo::formatValue($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['summ'][$index], $value)) . "\" />\r\n";
				} else {
					$outputData .= "<aggregate_{$aggregateLabelTag}>\r\n";
					$outputData .= "<label>" . $this->outputCombinationXmlProtectText($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['label'][$index]) . "</label>\r\n";
					$outputData .= "<value>" . $this->outputCombinationXmlProtectNumber(Grafico_pais_resumo::formatValue($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['summ'][$index], $value)) . "</value>\r\n";
					$outputData .= "</aggregate_{$aggregateLabelTag}>\r\n";
				}
			}

			if (!empty($data['children'])) {
				$outputData .= $this->outputCombinationXmlRow($data['children'], $level + 1, $tableDef);
			}

			$outputData .= "</groupby_{$groupByLabelTag}>\r\n";
		}

		return $outputData;
	} // outputCombinationXmlRow

	function outputCombinationXmlProtectTag($value) {
		$protectedChars = array(
			' ' => '_',
			'(' => '',
			')' => '',
		);

		return str_replace(array_keys($protectedChars), array_values($protectedChars), $value);
	} // outputCombinationXmlProtectTag

	function outputCombinationXmlProtectText($value) {
		return str_replace("\"", "\\\"", $value);
	} // outputCombinationXmlProtectText

	function outputCombinationXmlProtectNumber($value) {
		return $value;
	} // outputCombinationXmlProtectNumber

	//---------- CSV

	function outputCombinationCsv() {
        $this->outputCombinationCsvConfig();
		list($tableDef, $tableData) = $this->outputCombinationData();
		$this->outputCombinationExport('csv', $this->outputCombinationCsvContent($tableDef, $tableData), $this->outputCombinationPassword(''));
	} // outputCombinationCsv

    function outputCombinationCsvConfig()
    {
        $this->csvHeader = false;
        $this->csvDelimiter = "\"";
        $this->csvSeparator = ";";
        $this->csvNewLine = "\r\n";

        if (isset($_REQUEST['nm_label_csv'])) {
            if ('N' == $_REQUEST['nm_label_csv']) {
                $this->csvHeader = false;
            } elseif ('S' == $_REQUEST['nm_label_csv']) {
                $this->csvHeader = true;
            }
        }

        if (isset($_REQUEST['nm_delim_dados'])) {
            if ('1' == $_REQUEST['nm_delim_dados']) {
                $this->csvDelimiter = '"';
            } elseif ('2' == $_REQUEST['nm_delim_dados']) {
                $this->csvDelimiter = "'";
            } elseif ('3' == $_REQUEST['nm_delim_dados']) {
                $this->csvDelimiter = '';
            } elseif ('4' == $_REQUEST['nm_delim_dados']) {
                $this->csvDelimiter = '|';
            }
        }

        if (isset($_REQUEST['nm_delim_col'])) {
            if ('1' == $_REQUEST['nm_delim_col']) {
                $this->csvSeparator = ';';
            } elseif ('2' == $_REQUEST['nm_delim_col']) {
                $this->csvSeparator = ',';
            } elseif ('3' == $_REQUEST['nm_delim_col']) {
                $this->csvSeparator = "\t";
            } elseif ('4' == $_REQUEST['nm_delim_col']) {
                $this->csvSeparator = '#';
            } elseif ('5' == $_REQUEST['nm_delim_col']) {
                $this->csvSeparator = '';
            }
        }

        if (isset($_REQUEST['nm_delim_line'])) {
            if ('1' == $_REQUEST['nm_delim_line']) {
                $this->csvNewLine = "\r\n";
            } elseif ('2' == $_REQUEST['nm_delim_line']) {
                $this->csvNewLine = "\r";
            } elseif ('3' == $_REQUEST['nm_delim_line']) {
                $this->csvNewLine = "\n";
            }
        }
    } // outputCombinationCsvConfig

	function outputCombinationCsvContent($tableDef, $tableData) {
        $hasChildren = $this->outputCombinationHasChildren($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableData]);

		if ($this->csvHeader) {
			return $this->outputCombinationCsvHeader($tableDef, $hasChildren) .
			       $this->outputCombinationCsvRow($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableData], 0, array(), $tableDef, count($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_y_axys']), $hasChildren);
		} else {
			return $this->outputCombinationCsvRow($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableData], 0, array(), $tableDef, count($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_y_axys']), $hasChildren);
		}
	} // outputCombinationCsvContent

	function outputCombinationCsvHeader($tableDef, $hasChildren) {
		$headers = array();

		if ($hasChildren) {
			foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_group_by'] as $groupByName) {
				$headers[] = $groupByName;
			}
		}
		else {
			$headers[] = current($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_group_by']);
		}

		foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['label'] as $summName) {
			$headers[] = $summName;
		}

		return implode($this->csvSeparator, $headers) . $this->csvNewLine;
	} // outputCombinationCsv

	function outputCombinationCsvRow($rows, $level, $parameters, $tableDef, $totalDepth, $hasChildren) {
		$outputData = '';

		foreach ($rows as $data) {
			$thisRow   = $parameters;
			$thisLabel = $this->outputCombinationCsvProtectText($data['label']);
			$thisRow[] = $thisLabel;

			if ($hasChildren && $level + 1 < $totalDepth) {
				for ($i = 0; $i < $totalDepth - $level - 1; $i++) {
					$thisRow[] = '';
				}
			}

			foreach ($data['values'] as $index => $value) {
				$thisRow[] = $this->outputCombinationCsvProtectNumber(Grafico_pais_resumo::formatValue($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['summ'][$index], $value));
			}

			$outputData .= implode($this->csvSeparator, $thisRow) . $this->csvNewLine;

			if (!empty($data['children'])) {
				$outputData .= $this->outputCombinationCsvRow($data['children'], $level + 1, array_merge($parameters, array($thisLabel)), $tableDef, $totalDepth, $hasChildren);
			}
		}

		return $outputData;
	} // outputCombinationCsvRow

	function outputCombinationCsvProtectText($value) {
		if ($_SESSION['scriptcase']['charset'] != 'UTF-8') {
			$value = sc_convert_encoding($value, $_SESSION['scriptcase']['charset'], 'UTF-8');
		}

		return $this->csvDelimiter . str_replace($this->csvDelimiter, $this->csvDelimiter . $this->csvDelimiter, $value) . $this->csvDelimiter;
	} // outputCombinationCsvProtectText

	function outputCombinationCsvProtectNumber($value) {
		return $this->csvDelimiter . str_replace($this->csvDelimiter, $this->csvDelimiter . $this->csvDelimiter, $value) . $this->csvDelimiter;
	} // outputCombinationCsvProtectNumber

	//---------- RTF

	function outputCombinationRtf() {
		list($tableDef, $tableData) = $this->outputCombinationData();
		$this->outputCombinationExport('rtf', $this->outputCombinationRtfContent($tableDef, $tableData), $this->outputCombinationPassword(''));
	} // outputCombinationRtf

	function outputCombinationRtfContent($tableDef, $tableData) {
		$hasChildren = $this->outputCombinationHasChildren($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableData]);

		return "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n" .
		       "<DOC config_file=\"{$this->Ini->path_third}/rtf_new/doc_config.inc\">\r\n" .
		       "<table>\r\n" .
		       $this->outputCombinationRtfHeader($tableDef, $hasChildren) .
		       $this->outputCombinationRtfRow($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableData], 0, array(), $tableDef, count($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_y_axys']), $hasChildren) .
			   "</table>\r\n" .
		       "</DOC>\r\n";
	} // outputCombinationRtfContent

	function outputCombinationRtfHeader($tableDef, $hasChildren) {
		$headers = "<tr>\r\n";

		if ($hasChildren) {
			foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_group_by'] as $groupByName) {
				$headers .= "<td>$groupByName</td>\r\n";
			}
		}
		else {
			$headers .= "<td>" . current($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_group_by']) . "</td>\r\n";
		}

		foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['label'] as $summName) {
			$headers .= "<td>$summName</td>\r\n";
		}

		return $headers . "</tr>\r\n";
	} // outputCombinationRtfHeader

	function outputCombinationRtfRow($rows, $level, $parameters, $tableDef, $totalDepth, $hasChildren) {
		$outputData = '';

		foreach ($rows as $data) {
			$thisLabel   = $this->outputCombinationRtfProtectText($data['label']);
			$outputData .= "<tr>\r\n";

			foreach ($parameters as $groupByField) {
				$outputData .= "<td>" . $this->outputCombinationRtfProtectText($groupByField) . "</td>\r\n";
			}

			$outputData .= "<td>$thisLabel</td>\r\n";

			if ($hasChildren) {
				if ($level + 1 < $totalDepth) {
					for ($i = 0; $i < $totalDepth - $level - 1; $i++) {
						$outputData .= "<td></td>\r\n";
					}
				}
			}

			foreach ($data['values'] as $index => $value) {
				$outputData .= "<td>" . $this->outputCombinationRtfProtectNumber(Grafico_pais_resumo::formatValue($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['summ'][$index], $value)) . "</td>\r\n";
			}

			$outputData .= "</tr>\r\n";

			if (!empty($data['children'])) {
				$outputData .= $this->outputCombinationRtfRow($data['children'], $level + 1, array_merge($parameters, array($thisLabel)), $tableDef, $totalDepth, $hasChildren);
			}
		}

		return $outputData;
	} // outputCombinationRtfRow

	function outputCombinationRtfProtectText($value) {
		if (!NM_is_utf8($value)) {
			$value = sc_convert_encoding($value, 'UTF-8', $_SESSION['scriptcase']['charset']);
		}

		return $value;
	} // outputCombinationRtfProtectText

	function outputCombinationRtfProtectNumber($value) {
		return $value;
	} // outputCombinationRtfProtectNumber

	//---------- XLS

	function outputCombinationXls() {
                 $this->Use_phpspreadsheet = (phpversion() >=  '7.3.9' && is_dir($this->Ini->path_third . '/phpspreadsheet')) ? true : false;
                 if ($this->Use_phpspreadsheet) {
                     require_once $this->Ini->path_third . '/phpspreadsheet/vendor/autoload.php';
                     $this->xlsFile = new PhpOffice\PhpSpreadsheet\Spreadsheet();
                 }
                 else {
                     set_include_path(get_include_path() . PATH_SEPARATOR . $this->Ini->path_third . '/phpexcel/');
          	    require_once $this->Ini->path_third . '/phpexcel/PHPExcel.php';
	            require_once $this->Ini->path_third . '/phpexcel/PHPExcel/IOFactory.php';
                     $this->xlsFile = new PHPExcel();
                 }

		$this->thisRow = 1;
		$this->xlsFile->setActiveSheetIndex(0);
		$this->activeSheet = $this->xlsFile->getActiveSheet();

		if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == 'RTL') {
			$this->activeSheet->setRightToLeft(true);
		}

                 $this->outputCombinationXlsConfig();
		list($tableDef, $tableData) = $this->outputCombinationData();
		$this->outputCombinationExport($this->xlsFormat, $this->outputCombinationXlsContent($tableDef, $tableData), $this->outputCombinationPassword(''));
	} // outputCombinationXls

    function outputCombinationXlsConfig()
    {
        $this->xlsFormat = 'xlsx';

        if (isset($_REQUEST['nmgp_tp_xls'])) {
            if ('xls' == $_REQUEST['nmgp_tp_xls']) {
                $this->xlsFormat = 'xls';
            } elseif ('xlsx' == $_REQUEST['nmgp_tp_xls']) {
                $this->xlsFormat = 'xlsx';
            }
        }
    } // outputCombinationXlsConfig

	function outputCombinationXlsContent($tableDef, $tableData) {
		$hasChildren = $this->outputCombinationHasChildren($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableData]);

		$this->outputCombinationXlsHeader($tableDef, $hasChildren);
		$this->outputCombinationXlsRow($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableData], 0, array(), $tableDef, count($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_y_axys']), $hasChildren);

		return '';
	} // outputCombinationXlsContent

	function outputCombinationXlsHeader($tableDef, $hasChildren) {
		$column = 0;

		if ($hasChildren) {
			foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_group_by'] as $groupByName) {
				$this->addXlsCell(array(
					'col'     => $column++,
					'row'     => $this->thisRow,
					'content' => $groupByName,
					'size'    => 'auto',
					'bold'    => true,
					'align'   => 'left'
				));
			}
		}
		else {
                         if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_group_by'] == null) {
                             $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_group_by'] = array();
                         }
			$this->addXlsCell(array(
				'col'     => $column++,
				'row'     => $this->thisRow,
				'content' => current($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_group_by']),
				'size'    => 'auto',
				'bold'    => true,
				'align'   => 'left'
			));
		}

		foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['label'] as $summName) {
			$this->addXlsCell(array(
				'col'     => $column++,
				'row'     => $this->thisRow,
				'content' => $summName,
				'size'    => 'auto',
				'bold'    => true,
				'align'   => 'left'
			));
		}

		$this->thisRow++;
	} // outputCombinationXlsHeader

	function outputCombinationXlsRow($rows, $level, $parameters, $tableDef, $totalDepth, $hasChildren) {
		foreach ($rows as $data) {
			$column    = 0;
			$thisLabel = $this->outputCombinationXlsProtectText($data['label']);

			foreach ($parameters as $groupByField) {
				$this->addXlsCell(array(
					'col'     => $column++,
					'row'     => $this->thisRow,
					'content' => $this->outputCombinationXlsProtectText($groupByField),
					'align'   => 'left'
				));
			}

			$this->addXlsCell(array(
				'col'     => $column++,
				'row'     => $this->thisRow,
				'content' => $thisLabel,
				'align'   => 'left'
			));

			if ($hasChildren && $level + 1 < $totalDepth) {
				$column += $totalDepth - $level - 1;
			}

			foreach ($data['values'] as $index => $value) {
				$this->addXlsCell(array(
					'col'     => $column++,
					'row'     => $this->thisRow,
					'content' => $this->outputCombinationXlsProtectNumber(Grafico_pais_resumo::formatValue($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['summ'][$index], $value)),
					'align'   => 'right'
				));
			}

			$this->thisRow++;

			if (!empty($data['children'])) {
				$this->outputCombinationXlsRow($data['children'], $level + 1, array_merge($parameters, array($thisLabel)), $tableDef, $totalDepth, $hasChildren);
			}
		}
	} // outputCombinationXlsRow

	function addXlsCell($parameters) {
		$cell = $this->getColumnLetter($parameters['col']) . $parameters['row'];

		$this->activeSheet->setCellValue($cell, $parameters['content']);

		if (isset($parameters['size']) && 'auto' == $parameters['size']) {
			$this->activeSheet->getColumnDimension($cell)->setAutoSize(true);
		}

		if (isset($parameters['bold']) && $parameters['bold']) {
			$this->activeSheet->getStyle($cell)->getFont()->setBold(true);
		}

		if (isset($parameters['align']) && '' != $parameters['align']) {
                     if ($this->Use_phpspreadsheet) {
			$this->activeSheet->getStyle($cell)->getAlignment()->setHorizontal('left' == $parameters['align'] ? PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT : PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                     }
                     else {
			$this->activeSheet->getStyle($cell)->getAlignment()->setHorizontal('left' == $parameters['align'] ? PHPExcel_Style_Alignment::HORIZONTAL_LEFT : PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                     }
		}
	}

	function outputCombinationXlsProtectText($value) {
		if (!NM_is_utf8($value)) {
			return sc_convert_encoding($value, 'UTF-8', $_SESSION['scriptcase']['charset']);
		}

		return $value;
	} // outputCombinationXlsProtectText

	function outputCombinationXlsProtectNumber($value) {
		return $value;
	} // outputCombinationXlsProtectNumber

	function getColumnLetter($columnNumber) {
		$columnLetter = array('','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$resultColumn = '';
		$columnCalc   = $columnNumber + 1;

		while ($columnCalc > 26) {
			$cell       = $columnCalc % 26;
			$columnCalc = $columnCalc / 26;
			if ($cell == 0)
			{
				$cell = 26;
				$columnCalc--;
			}
			$resultColumn = $columnLetter[$cell] . $resultColumn;
		}
		$resultColumn = $columnLetter[$columnCalc] . $resultColumn;

		return $resultColumn;
	} // getColumnLetter

	//---------- WORD

	function outputCombinationWord() {
        $this->outputCombinationWordConfig();
		list($tableDef, $tableData) = $this->outputCombinationData();
		$this->outputCombinationExport('doc', $this->outputCombinationWordContent($tableDef, $tableData), $this->outputCombinationPassword(''));
	} // outputCombinationWord

    function outputCombinationWordConfig()
    {
        $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_export_word_css'] = 'color';

        if (isset($_REQUEST['nmgp_cor_word'])) {
            if ('pb' == $_REQUEST['nmgp_cor_word']) {
                $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_export_word_css'] = 'bw';
            } elseif ('co' == $_REQUEST['nmgp_cor_word']) {
                $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_export_word_css'] = 'color';
            }
        }
    }

	function outputCombinationWordContent($tableDef, $tableData) {
		$hasChildren = $this->outputCombinationHasChildren($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableData]);

		return "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:word\" xmlns=\"http://www.w3.org/TR/REC-html40\"{$_SESSION['scriptcase']['reg_conf']['html_dir']}>\r\n" .
		       "<head>\r\n" .
		       "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n" .
			   $this->outputCombinationWordCss() .
		       "</head>\r\n" .
		       "<body class=\"scGridPage\">\r\n" .
		       "<table class=\"scGridTabela\">\r\n" .
		       $this->outputCombinationWordHeader($tableDef, $hasChildren) .
		       $this->outputCombinationWordRow($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableData], 0, array(), $tableDef, count($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_y_axys']), $hasChildren) .
		       "</table>\r\n" .
		       "</body>\r\n" .
		       "</html>\r\n";
	} // outputCombinationWordContent

	function outputCombinationWordCss() {
		if ('bw' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_export_word_css']) {
			$cssFile    = "{$this->Ini->str_schema_all}_grid_bw.css";
			$cssDirFile = "{$this->Ini->str_schema_all}_grid_bw{$_SESSION['scriptcase']['reg_conf']['css_dir']}.css";
		}
		else {
			$cssFile    = "{$this->Ini->str_schema_all}_grid.css";
			$cssDirFile = "{$this->Ini->str_schema_all}_grid_bw{$_SESSION['scriptcase']['reg_conf']['css_dir']}.css";
		}

		if (!@is_file($this->Ini->path_css . $cssFile)) {
			return '';
		}

		return "<style type=\"text/css\">\r\n" .
		       @file_get_contents($this->Ini->path_css . $cssFile) .
		       @file_get_contents($this->Ini->path_css . $cssDirFile) .
		       "</style>\r\n";
	} // outputCombinationWordCss

	function outputCombinationWordHeader($tableDef, $hasChildren) {
		$headers = "<tr class=\"scGridLabel\">\r\n";

		if ($hasChildren) {
			foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_group_by'] as $groupByName) {
				$headers .= "<td class=\"scGridLabelFont\">$groupByName</td>\r\n";
			}
		}
		else {
			$headers .= "<td class=\"scGridLabelFont\">" . current($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_group_by']) . "</td>\r\n";
		}

		foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['label'] as $summName) {
			$headers .= "<td class=\"scGridLabelFont\">$summName</td>\r\n";
		}

		return $headers . "</tr>\r\n";
	} // outputCombinationWordHeader

	function outputCombinationWordRow($rows, $level, $parameters, $tableDef, $totalDepth, $hasChildren) {
		$outputData = '';

		foreach ($rows as $data) {
			$thisLabel   = $this->outputCombinationWordProtectText($data['label']);
			$outputData .= "<tr>\r\n";

			foreach ($parameters as $groupByField) {
				$outputData .= "<td class=\"scGridBlock scGridBlockFont\">" . $this->outputCombinationWordProtectText($groupByField) . "</td>\r\n";
			}

			$outputData .= "<td class=\"scGridBlock scGridBlockFont\">$thisLabel</td>\r\n";

			if ($hasChildren && $level + 1 < $totalDepth) {
				for ($i = 0; $i < $totalDepth - $level - 1; $i++) {
					$outputData .= "<td class=\"scGridBlock scGridBlockFont\"></td>\r\n";
				}
			}

			foreach ($data['values'] as $index => $value) {
				$outputData .= "<td class=\"scGridFieldOdd scGridFieldOddFont\">" . $this->outputCombinationWordProtectNumber(Grafico_pais_resumo::formatValue($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$tableDef]['summ'][$index], $value)) . "</td>\r\n";
			}

			$outputData .= "</tr>\r\n";

			if (!empty($data['children'])) {
				$outputData .= $this->outputCombinationWordRow($data['children'], $level + 1, array_merge($parameters, array($thisLabel)), $tableDef, $totalDepth, $hasChildren);
			}
		}

		return $outputData;
	} // outputCombinationWordRow

	function outputCombinationWordProtectText($value) {
		if (!NM_is_utf8($value)) {
			$value = sc_convert_encoding($value, 'UTF-8', $_SESSION['scriptcase']['charset']);
		}

		return $value;
	} // outputCombinationWordProtectText

	function outputCombinationWordProtectNumber($value) {
		return $value;
	} // outputCombinationWordProtectNumber

	//---------- IMAGE

	function outputCombinationImageOptions() {
		$selectTypeLabel  = wordwrap($this->Ini->Nm_lang['lang_pdff_type'], 25, '<br />', true);
		$selectLevelLabel = wordwrap($this->Ini->Nm_lang['lang_chart_level_groupby'], 25, '<br />', true);
		$passwordLabel    = wordwrap($this->Ini->Nm_lang['lang_app_xls_pswd'], 25, '<br />', true);

        $lastGroupby = count($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['Labels_GB']) - 1;

        $exportType = (isset($_POST['exportType']))?$_POST['exportType']:'';

		$hasOneGroupByLevel = 1 >= count($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['Labels_GB']);
		$isMultiSeriesChart = !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_drill_down']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_drill_down'];

		if ($hasOneGroupByLevel || $isMultiSeriesChart) {
			$displayGroupByLevel = ' style="display: none"';
			$forceExport         = "<script>$( document ).ready(function() { scChartImageExportProcess('" . $exportType . "'); });</script>";
		}
		else {
			$displayGroupByLevel = '';
			$forceExport         = '';
		}

		$okButton    = nmButtonOutput($this->arr_buttons, "bok", "scChartImageExportProcess()", "scChartImageExportProcess()", "bok", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
;
		$closeButton = nmButtonOutput($this->arr_buttons, "bsair", "scChartImageExportHide()", "scChartImageExportHide()", "bsair", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
;

		$exportType = (isset($_POST['exportType'])) ? $_POST['exportType'] : '';

		$htmlCode = <<<SCEOT
<input type='hidden' id='sc-id-image-export-type' value='{$exportType}'>
<table class="scGridTabela" cellspacing="0" cellpadding="0" {$displayGroupByLevel}>
	<tr>
		<td class="scGridLabelVert">{$this->Ini->Nm_lang['lang_chrt_img_cfg']}</td>
	</tr>
	<tr>
		<td class="scGridFieldOdd scGridFieldOddFont">
			<table style="border-collapse: collapse; border-width: 0px">
				<tr>
					<td class="scGridFieldOddFont">$selectLevelLabel</td>
					<td class="scGridFieldOddFont">

SCEOT;

		foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['Labels_GB'] as $groupbyIndex => $groupbyLabel) {
			$selected = ($lastGroupby == $groupbyIndex) ? ' checked' : '';
			$optionId = 'sc-id-opt-' . substr(md5(microtime() . session_id()), 12, 6);

			$htmlCode .= <<<SCEOT
						<input type="radio" class="sc-id-chart-image-level" name="chart_level_image" value="$groupbyIndex"$selected id="$optionId" /> <label for="$optionId">$groupbyLabel</label><br />

SCEOT;
		}

		$htmlCode .= <<<SCEOT
					</td>
				</tr>
				<input name="password_image" value="" id="sc-id-image-export-pwd" type="hidden" />
			</table>
		</td>
	</tr>
	<tr>
		<td class="scGridToolbar" style="text-align: center">
			$okButton
			$closeButton
			$forceExport
		</td>
	</tr>
</table>

SCEOT;

		echo $htmlCode;
		exit;
	} // outputCombinationImageOptions

	function outputCombinationImage() {
		$this->outputCombinationExport('image', '', $this->outputCombinationPassword(''));
	} // outputCombinationImage

  function close_emb()
  {
      if ($this->Db)
      {
          $this->Db->Close(); 
      }
  }
   function SC_proc_grid_search($Parms)
   {
       $ix     = 0;
       $fields = array();
       $busca  = array();
       $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
       if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($Parms))
       {
           $Parms = NM_conv_charset($Parms, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $tmp    = explode("_FDYN_", $Parms);
       $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['tmp_busca'] = array();
       foreach ($tmp as $cada_f)
       {
           $dats = explode("_DYN_", $cada_f);
           if ($dats[1] == "del_grid_search_all")
           {
               foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['grid_pesq'] as $ind => $dados)
               {
                   $this->proc_del_grid_search($ind, true);
               }
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['grid_pesq']);
               continue;
           }
           if ($dats[1] == "del_grid_search")
           {
               $this->proc_del_grid_search($dats[0], false);
               continue;
           }
           $fields[$ix]['field']  = $dats[0];
           $fields[$ix]['cond']   = $dats[1];
           $sep_in                 = explode("_VLS3_", $dats[2]);
           if (isset($sep_in[1]))
           {
               $fields[$ix]['vls'][2][0] = $sep_in[1];
               $dats[2] = $sep_in[0];
           }
           $sep_bw                 = explode("_VLS2_", $dats[2]);
           $fields[$ix]['vls'][0] = explode("_VLS_",  $sep_bw[0]);
           $fields[$ix]['vls'][1] = isset($sep_bw[1]) ? explode("_VLS_",  $sep_bw[1]) : "";
           $val_sv = array();
           foreach ($fields[$ix]['vls'] as $i => $dados)
           {
               if (is_array($dados))
               {
                   foreach ($dados as $ind => $str)
                   {
                       $str = NM_charset_decode($str);
                       $tmp_pos = (is_string($str)) ? strpos($str, "##@@") : false;
                       if ($tmp_pos === false)
                       {
                          $val_sv[$i][] = $str;
                       }
                       else
                       {
                         $val_sv[$i][] = substr($str, 0, $tmp_pos);
                       }
                   }
               }
               else
               {
                   $dados = NM_charset_decode($dados);
                   $tmp_pos = (is_string($dados)) ? strpos($dados, "##@@") : false;
                   if ($tmp_pos === false)
                   {
                      $val_sv[$i] = $dados;
                   }
                   else
                   {
                      $val_sv[$i] = substr($dados, 0, $tmp_pos);
                   }
               }
           }
           if (!isset($busca[$dats[0]]))
           {
               $busca[$dats[0]] = $dats[1];
               $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['tmp_busca'][$dats[0]] = (isset($fields[$ix]['vls'][0])) ? $fields[$ix]['vls'][0][0] : "";
               if (isset($fields[$ix]['vls'][1]))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['tmp_busca'][$dats[0] . '_input_2'] = $fields[$ix]['vls'][1][0];
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['tmp_busca'][$dats[0] . '_cond'] = $dats[1];
           }
           $ix++;
      }
      if ($_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['tmp_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['tmp_busca'], "UTF-8", $_SESSION['scriptcase']['charset']);
      }
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['tmp_busca'] as $ind => $dados)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['campos_busca'][$ind] = $dados;
      }
      if (!$_SESSION['scriptcase']['proc_mobile']) 
      { 
          require_once($this->Ini->path_aplicacao . "Grafico_pais_pesq.class.php"); 
      } 
      else 
      { 
          require_once($this->Ini->path_aplicacao . "Grafico_pais_mobile_pesq.class.php"); 
      } 
      $this->pesq  = new Grafico_pais_pesq();
      $this->prep_modulos("pesq");
      $this->pesq->NM_ajax_flag  = true;
      $this->pesq->NM_ajax_opcao = "ajax_grid_search";
      $this->pesq->monta_busca();
   }
   function proc_del_grid_search($cmp_del, $del_all)
   {
      if (is_array($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['campos_busca'][$cmp_del]))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['campos_busca'][$cmp_del] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['campos_busca'][$cmp_del . "_input_2"] = array();
      }
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['campos_busca'][$cmp_del] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['campos_busca'][$cmp_del . "_input_2"] = "";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['campos_busca'][$cmp_del . "_cond"] = "";
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['grid_pesq'][$cmp_del]);
   }
  function html_doc_word($nm_arquivo_doc_word, $nmgp_password)
  {
      global $nm_url_saida;
      $Word_password = "";
      if ($this->Ini->Export_zip || $Word_password != "")
      { 
          $Parm_pass  = ($Word_password != "") ? " -p" : "";
          $Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['word_file'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['word_file'], ".");
          if ($Pos !== false) {
              $Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['word_file'], 0, $Pos);
          }
          $Arq_zip .= ".zip";
          $Arq_doc = $nm_arquivo_doc_word;
          $Pos = strrpos($nm_arquivo_doc_word, ".");
          if ($Pos !== false) {
              $Arq_doc = substr($nm_arquivo_doc_word, 0, $Pos);
          }
          $Arq_doc  .= ".zip";
          $Zip_f     = (FALSE !== strpos($Arq_zip, ' ')) ? " \"" . $Arq_zip . "\"" :  $Arq_zip;
          $Arq_input = (FALSE !== strpos($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['word_file'], ' ')) ? " \"" . $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['word_file'] . "\"" :  $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['word_file'];
           if (is_file($Arq_zip)) {
               unlink($Arq_zip);
           }
           $str_zip = "";
           if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
           {
               chdir($this->Ini->path_third . "/zip/windows");
               $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $Word_password . " " . $Zip_f . " " . $Arq_input;
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
               $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $Arq_input;
           }
           elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
           {
               chdir($this->Ini->path_third . "/zip/mac/bin");
               $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $Arq_input;
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
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $Word_password . " " . $Zip_f . " " . $cada_img_zip;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
              {
                  $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $cada_img_zip;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $cada_img_zip;
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
               unlink($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['word_file']);
               $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['word_file'] = $Arq_zip;
               $nm_arquivo_doc_word = $Arq_doc;
          } 
      } 
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['word_file']);
          $this->Arr_result['title_export'] = NM_charset_to_utf8($nm_arquivo_doc_word);
          $Temp = ob_get_clean();
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
      if (strpos(" " . $this->Ini->SC_module_export, "grid") !== false || strpos(" " . $this->Ini->SC_module_export, "resume") !== false)
      {
          $path_doc_md5 = md5($this->Ini->path_imag_temp . $nm_arquivo_doc_word);
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$path_doc_md5][0] = $this->Ini->path_imag_temp . $nm_arquivo_doc_word;
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$path_doc_md5][1] = substr($nm_arquivo_doc_word, 1);
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
              $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $this->pb->setProgressbarMessage($Mens_bar);
          $this->pb->setDownloadLink($this->Ini->path_imag_temp . $nm_arquivo_doc_word);
          $this->pb->setDownloadMd5($path_doc_md5);
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($this->ret_word);
          $this->pb->completed();
          return;
      }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_chart_title'] ?> pais :: Doc</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
   <link rel="stylesheet" type="text/css" href="../_lib/lib/css/nm_export_mobile.css" /> 
<?php
}
$path_doc_md5 = md5($this->Ini->path_imag_temp . $nm_arquivo_doc_word);
$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$path_doc_md5][0] = $this->Ini->path_imag_temp . $nm_arquivo_doc_word;
$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$path_doc_md5][1] = substr($nm_arquivo_doc_word, 1);
?>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/font-awesome/6/css/all.min.css" type="text/css" media="screen,print" />
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
   <td class="scExportTitle" style="height: 25px">WORD</td>
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
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . $nm_arquivo_doc_word ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="Grafico_pais_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="Grafico_pais"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($this->ret_word) ?>"> 
</FORM> 
</BODY>
</HTML>
<?php
  }
  function html_export_print($nm_arquivo_html, $nmgp_password)
  {
      global $nm_url_saida;
      $Html_password = "";
          $Arq_base  = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html;
          $Parm_pass = ($Html_password != "") ? " -p" : "";
          $Arq_zip   = $Arq_base;
          $Pos = strrpos($Arq_base, ".");
          if ($Pos !== false) {
              $Arq_zip = substr($Arq_base, 0, $Pos);
          }
          $Arq_zip .= ".zip";
          $Arq_htm  = $nm_arquivo_html;
          $Pos = strrpos($nm_arquivo_html, ".");
          if ($Pos !== false) {
              $Arq_htm = substr($nm_arquivo_html, 0, $Pos);
          }
          $Arq_htm  .= ".zip";
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
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_sort;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_sort_desc;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_sort_asc;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_summary_sort_desc;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_summary_sort_asc;
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
               $nm_arquivo_html = $Arq_htm;
           } 
          $path_doc_md5 = md5($this->Ini->path_imag_temp . $nm_arquivo_html);
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$path_doc_md5][0] = $this->Ini->path_imag_temp . $nm_arquivo_html;
          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$path_doc_md5][1] = substr($nm_arquivo_html, 1);
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
              $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $this->pb->setProgressbarMessage($Mens_bar);
          $this->pb->setDownloadLink($this->Ini->path_imag_temp . $nm_arquivo_html);
          $this->pb->setDownloadMd5($path_doc_md5);
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($this->ret_print);
          $this->pb->completed();
          return;
  }
} 
// 
//======= =========================
   if (isset($_SESSION['scriptcase']['Grafico_pais']['sc_process_barr'])) {
       return;
   }
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
   if (!function_exists("SC_dir_app_ini"))
   {
       include_once("../_lib/lib/php/nm_ctrl_app_name.php");
   }
   SC_dir_app_ini('project_HOYY');
   $_SESSION['scriptcase']['Grafico_pais']['contr_erro'] = 'off';
   $sc_conv_var = array();
   $Sc_lig_md5 = false;
   $Sem_Session = (!isset($_SESSION['sc_session'])) ? true : false;
   $_SESSION['scriptcase']['sem_session'] = false;
   if (!empty($_POST))
   {
       if (isset($_POST['parm']))
       {
           $_POST['parm'] = str_replace("__NM_PLUS__", "+", $_POST['parm']);
           $_POST['parm'] = str_replace("__NM_AMP__", "&", $_POST['parm']);
           $_POST['parm'] = str_replace("__NM_PRC__", "%", $_POST['parm']);
       }
       foreach ($_POST as $nmgp_var => $nmgp_val)
       {
            $nmgp_val = str_replace("__NM_PLUS__", "+", $nmgp_val);
            $nmgp_val = str_replace("__NM_AMP__", "&", $nmgp_val);
            $nmgp_val = str_replace("__NM_PRC__", "%", $nmgp_val);
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
             if ($nmgp_var == "nmgp_parms_where" && substr($nmgp_val, 0, 8) == "@SC_par@")
             {
                 $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                 if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]]))
                 {
                     $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]];
                 }
                 else
                 {
                     $_SESSION['sc_session']['SC_parm_violation'] = true;
                 }
             }
            if (isset($sc_conv_var[$nmgp_var]))
            {
                $nmgp_var = $sc_conv_var[$nmgp_var];
            }
            elseif (isset($sc_conv_var[strtolower($nmgp_var)]))
            {
                $nmgp_var = $sc_conv_var[strtolower($nmgp_var)];
            }
            nm_limpa_str_Grafico_pais($nmgp_val);
            $nmgp_val = NM_decode_input($nmgp_val);
            nm_protect_num_Grafico_pais($nmgp_var, $nmgp_val);
            $$nmgp_var = $nmgp_val;
       }
   }
   if (!empty($_GET))
   {
       if (isset($_GET['parm']))
       {
           $_GET['parm'] = str_replace("__NM_PLUS__", "+", $_GET['parm']);
           $_GET['parm'] = str_replace("__NM_AMP__", "&", $_GET['parm']);
           $_GET['parm'] = str_replace("__NM_PRC__", "%", $_GET['parm']);
       }
       foreach ($_GET as $nmgp_var => $nmgp_val)
       {
            $nmgp_val = str_replace("__NM_PLUS__", "+", $nmgp_val);
            $nmgp_val = str_replace("__NM_AMP__", "&", $nmgp_val);
            $nmgp_val = str_replace("__NM_PRC__", "%", $nmgp_val);
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
             if ($nmgp_var == "nmgp_parms_where" && substr($nmgp_val, 0, 8) == "@SC_par@")
             {
                 $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                 if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]]))
                 {
                     $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]];
                 }
                 else
                 {
                     $_SESSION['sc_session']['SC_parm_violation'] = true;
                 }
             }
            if (isset($sc_conv_var[$nmgp_var]))
            {
                $nmgp_var = $sc_conv_var[$nmgp_var];
            }
            elseif (isset($sc_conv_var[strtolower($nmgp_var)]))
            {
                $nmgp_var = $sc_conv_var[strtolower($nmgp_var)];
            }
            nm_limpa_str_Grafico_pais($nmgp_val);
            $nmgp_val = NM_decode_input($nmgp_val);
            nm_protect_num_Grafico_pais($nmgp_var, $nmgp_val);
            $$nmgp_var = $nmgp_val;
       }
   }
   if (!isset($_SERVER['HTTP_REFERER']) && !isset($nmgp_parms) && !isset($script_case_init) && !isset($nmgp_start) && !isset($_SESSION['scriptcase']['refresh']['Grafico_pais']))
   {
       $Sem_Session = false;
   }
   $NM_dir_atual = getcwd();
   if (empty($NM_dir_atual)) {
       $str_path_sys  = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
       $str_path_sys  = str_replace("\\", '/', $str_path_sys);
   }
   else {
       $sc_nm_arquivo = explode("/", $_SERVER['PHP_SELF']);
       $str_path_sys  = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
   }
   $str_path_web    = $_SERVER['PHP_SELF'];
   $str_path_web    = str_replace("\\", '/', $str_path_web);
   $str_path_web    = str_replace('//', '/', $str_path_web);
   $path_aplicacao  = substr($str_path_web, 0, strrpos($str_path_web, '/'));
   $path_aplicacao  = substr($path_aplicacao, 0, strrpos($path_aplicacao, '/'));
   $root            = substr($str_path_sys, 0, -1 * strlen($str_path_web));
   if ($Sem_Session && (!isset($nmgp_start) || $nmgp_start != "SC")) {
       if (isset($_COOKIE['sc_apl_default_project_HOYY'])) {
           $apl_def = explode(",", $_COOKIE['sc_apl_default_project_HOYY']);
       }
       elseif (is_file($root . $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp'] . "/sc_apl_default_project_HOYY.txt")) {
           $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp'] . "/sc_apl_default_project_HOYY.txt"));
       }
       if (isset($apl_def)) {
           if ($apl_def[0] != "Grafico_pais") {
               $_SESSION['scriptcase']['sem_session'] = true;
               if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                   $_SESSION['scriptcase']['Grafico_pais']['session_timeout']['redir'] = $apl_def[0];
               }
               else {
                   $_SESSION['scriptcase']['Grafico_pais']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
               }
               $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
               $_SESSION['scriptcase']['Grafico_pais']['session_timeout']['redir_tp'] = $Redir_tp;
           }
           if (isset($_COOKIE['sc_actual_lang_project_HOYY'])) {
               $_SESSION['scriptcase']['Grafico_pais']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_project_HOYY'];
           }
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
   if (!empty($glo_perfil))  
   { 
      $_SESSION['scriptcase']['glo_perfil'] = $glo_perfil;
   }   
   if (isset($glo_servidor)) 
   {
       $_SESSION['scriptcase']['glo_servidor'] = $glo_servidor;
   }
   if (isset($glo_banco)) 
   {
       $_SESSION['scriptcase']['glo_banco'] = $glo_banco;
   }
   if (isset($glo_tpbanco)) 
   {
       $_SESSION['scriptcase']['glo_tpbanco'] = $glo_tpbanco;
   }
   if (isset($glo_usuario)) 
   {
       $_SESSION['scriptcase']['glo_usuario'] = $glo_usuario;
   }
   if (isset($glo_senha)) 
   {
       $_SESSION['scriptcase']['glo_senha'] = $glo_senha;
   }
   if (isset($glo_senha_protect)) 
   {
       $_SESSION['scriptcase']['glo_senha_protect'] = $glo_senha_protect;
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_pai']))
   {
       $apl_pai = $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_pai'];
       if (isset($_SESSION['sc_session'][$script_case_init][$apl_pai]['embutida_filho']))
       {
           foreach ($_SESSION['sc_session'][$script_case_init][$apl_pai]['embutida_filho'] as $init_filho)
           {
               if (isset($_SESSION['sc_session'][$init_filho]['Grafico_pais']['master_pai']) && $_SESSION['sc_session'][$init_filho]['Grafico_pais']['master_pai'] == $script_case_init)
               {
                   $script_case_init = $init_filho;
                   break;
               }
           }
       }
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form']) && $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form'] && !isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['master_pai']))
   {
       $SC_init_ant = $script_case_init;
       $script_case_init = rand(2, 10000);
       if (isset($_SESSION['sc_session'][$SC_init_ant]['Grafico_pais']['embutida_pai']))
       {
           $_SESSION['sc_session'][$SC_init_ant][$_SESSION['sc_session'][$SC_init_ant]['Grafico_pais']['embutida_pai']]['embutida_filho'][] = $script_case_init;
       }
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['master_pai'] = $SC_init_ant;
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['master_pai']))
   {
       $SC_init_ant = $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['master_pai'];
       if (!isset($_SESSION['sc_session'][$SC_init_ant]['Grafico_pais']['embutida_form_parms']))
       {
           $_SESSION['sc_session'][$SC_init_ant]['Grafico_pais']['embutida_form_parms'] = "";
       }
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form_parms'] = $_SESSION['sc_session'][$SC_init_ant]['Grafico_pais']['embutida_form_parms'];
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form'] = true;
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form_full'] = (isset($_SESSION['sc_session'][$SC_init_ant]['Grafico_pais']['embutida_form_full'])) ? $_SESSION['sc_session'][$SC_init_ant]['Grafico_pais']['embutida_form_full'] : false;
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['reg_start'] = "";
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opcao'] = "inicio";
       unset($_SESSION['sc_session'][$SC_init_ant]['Grafico_pais']['embutida_form']);
       unset($_SESSION['sc_session'][$SC_init_ant]['Grafico_pais']['embutida_form_parms']);
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form_parms'])) 
   {
       if (!empty($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form_parms'])) 
       {
           $nmgp_parms = $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form_parms'];
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form_parms'] = "";
       }
   }
   elseif (isset($script_case_init))
   {
       unset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form']);
       unset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form_full']);
       unset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form_parms']);
   }
   if (!isset($nmgp_opcao) || !isset($script_case_init) || ((!isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida']) || !$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida']) && $nmgp_opcao != "formphp"))
   { 
       if (!empty($nmgp_parms)) 
       { 
           $nmgp_parms = NM_decode_input($nmgp_parms);
           $nmgp_parms = str_replace("@aspass@", "'", $nmgp_parms);
           $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
           $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
           $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
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
                    if (isset($sc_conv_var[$cadapar[0]]))
                    {
                        $cadapar[0] = $sc_conv_var[$cadapar[0]];
                    }
                    elseif (isset($sc_conv_var[strtolower($cadapar[0])]))
                    {
                        $cadapar[0] = $sc_conv_var[strtolower($cadapar[0])];
                    }
                    nm_limpa_str_Grafico_pais($cadapar[1]);
                    nm_protect_num_Grafico_pais($cadapar[0], $cadapar[1]);
                    if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                    $Tmp_par   = $cadapar[0];
                    $$Tmp_par = $cadapar[1];
                }
           }
           $NMSC_conf_apl = array();
           if (isset($NMSC_inicial))
           {
               $NMSC_conf_apl['inicial'] = $NMSC_inicial;
           }
           if (isset($NMSC_rows))
           {
               $NMSC_conf_apl['rows'] = $NMSC_rows;
           }
           if (isset($NMSC_cols))
           {
               $NMSC_conf_apl['cols'] = $NMSC_cols;
           }
           if (isset($NMSC_paginacao))
           {
               $NMSC_conf_apl['paginacao'] = $NMSC_paginacao;
           }
           if (isset($NMSC_cab))
           {
               $NMSC_conf_apl['cab'] = $NMSC_cab;
           }
           if (isset($NMSC_nav))
           {
               $NMSC_conf_apl['nav'] = $NMSC_nav;
           }
           if (isset($NMSC_fix_bar_top))
           {
               $NMSC_conf_apl['fix_top'] = $NMSC_fix_bar_top;
           }
           if (isset($NMSC_fix_bar_bot))
           {
               $NMSC_conf_apl['fix_bot'] = $NMSC_fix_bar_bot;
           }
           if (isset($NM_run_iframe) && $NM_run_iframe == 1) 
           { 
               unset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']);
               $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['b_sair'] = false;
           }   
       } 
   } 
   if (!isset($nmgp_opcao)) {
      $nmgp_opcao = "";
   }
   $ini_embutida = "";
   if (isset($NM_refresh) && $NM_refresh == 1)
   {
       unset($_SESSION['scriptcase']['refresh']['Grafico_pais']);
   }
   if (isset($_SESSION['scriptcase']['refresh']['Grafico_pais']))
   {
       if (!isset($script_case_init) && isset($_SESSION['scriptcase']['refresh']['Grafico_pais']['init'])) {
           $script_case_init = $_SESSION['scriptcase']['refresh']['Grafico_pais']['init'];
       }
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['contr_total_geral'] = "NAO";
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['contr_array_resumo'] = "NAO";
       unset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['tot_geral']);
       unset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['arr_total']);
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida']) && $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'])
   {
       $nmgp_outra_jan = "";
   }
   if (isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true' && !isset($_SESSION['scriptcase']['refresh']['Grafico_pais']))
   {
       $script_case_init = "";
   }
   if (isset($GLOBALS["script_case_init"]) && !empty($GLOBALS["script_case_init"]))
   {
       $ini_embutida = $GLOBALS["script_case_init"];
        if (!isset($_SESSION['sc_session'][$ini_embutida]['Grafico_pais']['embutida']))
        { 
           $_SESSION['sc_session'][$ini_embutida]['Grafico_pais']['embutida'] = false;
        }
        if (!$_SESSION['sc_session'][$ini_embutida]['Grafico_pais']['embutida'])
        { 
           $script_case_init = $ini_embutida;
        }
   }
   if (isset($_SESSION['scriptcase']['Grafico_pais']['protect_modal']) && !empty($_SESSION['scriptcase']['Grafico_pais']['protect_modal']))
   {
       $script_case_init = $_SESSION['scriptcase']['Grafico_pais']['protect_modal'];
   }
   if (!isset($script_case_init) || empty($script_case_init))
   {
       $script_case_init = rand(2, 10000);
   }
   $salva_emb    = false;
   $salva_iframe = false;
   if (isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['iframe_menu']))
   {
       $salva_iframe = $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['iframe_menu'];
       unset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['iframe_menu']);
   }
   if (isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida']))
   {
       $salva_emb = $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'];
       unset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida']);
   }
   if (isset($nm_run_menu) && $nm_run_menu == 1 && !$salva_emb)
   {
        if (isset($_SESSION['scriptcase']['sc_aba_iframe']) && isset($_SESSION['scriptcase']['sc_apl_menu_atual']))
        {
            foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
            {
                if ($aba == $_SESSION['scriptcase']['sc_apl_menu_atual'])
                {
                    unset($_SESSION['scriptcase']['sc_aba_iframe'][$aba]);
                    break;
                }
            }
        }
        $_SESSION['scriptcase']['sc_apl_menu_atual'] = "Grafico_pais";
        $achou = false;
        if (isset($_SESSION['sc_session'][$script_case_init]))
        {
            foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
            {
                if ($nome_apl == 'Grafico_pais' || $achou)
                {
                    unset($_SESSION['sc_session'][$script_case_init][$nome_apl]);
                }
            }
            if (!$achou && isset($nm_apl_menu))
            {
                foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
                {
                    if ($nome_apl == $nm_apl_menu || $achou)
                    {
                        $achou = true;
                        if ($nome_apl != $nm_apl_menu)
                        {
                            unset($_SESSION['sc_session'][$script_case_init][$nome_apl]);
                        }
                    }
                }
            }
        }
        $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['iframe_menu'] = true;
   }
   else
   {
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['iframe_menu'] = $salva_iframe;
   }
   $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['doc_word'] = false;
   $_SESSION['scriptcase']['saida_word'] = false;
   if (!isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['skip_charts']))
   {
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['skip_charts'] = false;
   }
   if (isset($_REQUEST['sc_create_charts']))
   {
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['skip_charts'] = 'N' == $_REQUEST['sc_create_charts'];
   }
   $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'] = $salva_emb;

   if (!isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['initialize']))
   {
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['initialize'] = true;
   }
   elseif (!isset($_SERVER['HTTP_REFERER']))
   {
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['initialize'] = false;
   }
   elseif (false === strpos($_SERVER['HTTP_REFERER'], '/Grafico_pais/'))
   {
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['initialize'] = true;
   }
   else
   {
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['initialize'] = false;
   }
   if ($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['initialize'])
   {
       unset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['tot_geral']);
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['contr_total_geral'] = "NAO";
   }

   $_POST['script_case_init'] = $script_case_init;
   if (!isset($nmgp_opcao) || empty($nmgp_opcao) || $nmgp_opcao == "grid" && (!isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['b_sair'])))
   {
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['b_sair'] = true;
   }
   if (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'Grafico_pais')
   {
       $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_outra_jan'] = true;
        unset($_SESSION['scriptcase']['sc_outra_jan']);
   }
   $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['menu_desenv'] = false;   
   if (!defined("SC_ERROR_HANDLER"))
   {
       define("SC_ERROR_HANDLER", 1);
       include_once(dirname(__FILE__) . "/Grafico_pais_erro.php");
   }
   $salva_tp_saida  = (isset($_SESSION['scriptcase']['sc_tp_saida']))  ? $_SESSION['scriptcase']['sc_tp_saida'] : "";
   $salva_url_saida  = (isset($_SESSION['scriptcase']['sc_url_saida'][$script_case_init])) ? $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] : "";
   if (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['Grafico_pais']))
   { 
       return;
   } 
   if (!$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'] && $nmgp_opcao != "formphp")
   { 
       if ($nmgp_opcao == "change_lang" || $nmgp_opcao == "change_lang_res" || $nmgp_opcao == "change_lang_fil" || $nmgp_opcao == "force_lang")  
       { 
           if ($nmgp_opcao == "change_lang_fil")  
           { 
               $nmgp_opcao  = "busca";  
           } 
           elseif ($nmgp_opcao == "change_lang_res")  
           { 
               $nmgp_opcao  = "resumo";  
           } 
           else 
           { 
               $nmgp_opcao  = "igual";  
           } 
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_change_lang'] = true;
           unset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['tot_geral']);
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['contr_total_geral'] = "NAO";
           $Temp_lang = explode(";" , $nmgp_idioma);  
           if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))  
           { 
               $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
           } 
           if (isset($Temp_lang[1]) && !empty($Temp_lang[1])) 
           { 
               $_SESSION['scriptcase']['str_conf_reg'] = $Temp_lang[1];
           } 
       } 
       if ($nmgp_opcao == "change_schema" || $nmgp_opcao == "change_schema_fil" || $nmgp_opcao == "change_schema_res")  
       { 
           if ($nmgp_opcao == "change_schema_fil")  
           { 
               $nmgp_opcao  = "busca";  
           } 
           elseif ($nmgp_opcao == "change_schema_res")  
           { 
               $nmgp_opcao  = "resumo";  
           } 
           else 
           { 
               $nmgp_opcao  = "igual";  
           } 
           $nmgp_schema = $nmgp_schema . "/" . $nmgp_schema;  
           $_SESSION['scriptcase']['str_schema_all'] = $nmgp_schema;
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['num_css'] = rand(0, 1000);
       } 
       if ($nmgp_opcao == "volta_grid")  
       { 
           $nmgp_opcao = "igual";  
       }   
       if (!empty($nmgp_opcao))  
       { 
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opcao'] = $nmgp_opcao ;  
       }   
       if (!isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['mostra_edit'])) 
       {
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['mostra_edit'] = "S";
       }
       if (isset($nmgp_lig_edit_lapis)) 
       {
          $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['mostra_edit'] = $nmgp_lig_edit_lapis;
           unset($GLOBALS["nmgp_lig_edit_lapis"]) ;  
           if (isset($_SESSION['nmgp_lig_edit_lapis'])) 
           {
               unset($_SESSION['nmgp_lig_edit_lapis']);
           }
       }
       if (isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true')
       {
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_outra_jan'] = true;
       }
       $nm_saida = "";
       if (!isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_modal']))
       {
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_modal'] = false;
       }
       if (isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['volta_redirect_apl']) && !empty($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['volta_redirect_apl']))
       {
           $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['volta_redirect_apl']; 
           $nm_apl_dependente = $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['volta_redirect_tp']; 
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['volta_redirect_apl'] = "";
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['volta_redirect_tp'] = "";
           $nm_url_saida = "Grafico_pais_fim.php"; 
       
       }
       elseif (substr($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opcao'] != "pdf" ) 
       {
           if (isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_outra_jan'])
           {
               if ($nmgp_url_saida == "modal")
               {
                   $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_modal'] = true;
               }
               $nm_url_saida = "Grafico_pais_fim.php"; 
           }
           else
           {
               $nm_url_saida = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ""; 
               $nm_url_saida = str_replace("_fim.php", ".php", $nm_url_saida);
               if (!empty($nmgp_url_saida)) 
               { 
                   $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['retorno_cons'] = $nmgp_url_saida ; 
               } 
               if (!empty($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['retorno_cons'])) 
               { 
                   $nm_url_saida = $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['retorno_cons']  . "?script_case_init=" . NM_encode_input($script_case_init);  
                   $nm_apl_dependente = 1 ; 
               } 
               if (!empty($nm_url_saida)) 
               { 
                   $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $nm_url_saida ; 
               } 
               $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $nm_url_saida; 
               $nm_url_saida = "Grafico_pais_fim.php"; 
               $_SESSION['scriptcase']['sc_tp_saida'] = "P"; 
               if ($nm_apl_dependente == 1) 
               { 
                   $_SESSION['scriptcase']['sc_tp_saida'] = "D"; 
               } 
           } 
       }
// 
       if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && substr($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opcao'] != "pdf" ) 
       { 
            $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['scriptcase']['nm_sc_retorno']; 
            $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['menu_desenv'] = true;   
       } 
       if (isset($nmgp_parms_ret)) 
       {
           $todo = explode(",", $nmgp_parms_ret);
           if (isset($sc_conv_var[$todo[2]]))
           {
               $todo[2] = $sc_conv_var[$todo[2]];
           }
           elseif (isset($sc_conv_var[strtolower($todo[2])]))
           {
               $todo[2] = $sc_conv_var[strtolower($todo[2])];
           }
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['form_psq_ret']  = $todo[0];
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['campo_psq_ret'] = $todo[1];
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['dado_psq_ret']  = $todo[2];
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['js_apos_busca'] = $nm_evt_ret_busca;
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opc_psq'] = true;   
           if (isset($nmgp_iframe_ret)) {
               $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['iframe_ret_cap'] = $nmgp_iframe_ret;
           }
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['psq_edit'] = 'N';   
           if (isset($nmgp_perm_edit)) {
               $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['psq_edit'] = $nmgp_perm_edit;
           }
       } 
       elseif (!isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opc_psq']))
       {
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opc_psq']  = false;   
           $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['psq_edit'] = 'N';   
       } 
       if (isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form']) && $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form'])
       {
           if (!isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form_full']) || !$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida_form_full'])
           {
               $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['mostra_edit'] = "N";   
           } 
           $_SESSION['scriptcase']['sc_tp_saida']  = $salva_tp_saida;
           $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $salva_url_saida;
       } 
       $GLOBALS["NM_ERRO_IBASE"] = 0;  
       if (isset($_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['sc_outra_jan'])
       {
           $nm_apl_dependente = 0;
       }
       $contr_Grafico_pais = new Grafico_pais_apl();

      if ('ajax_autocomp' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opcao'] = "busca";
          $contr_Grafico_pais->NM_ajax_flag = true;
          $contr_Grafico_pais->NM_ajax_opcao = $NM_ajax_opcao;
      }
      if ('ajax_filter_save' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opcao'] = "busca";
          $contr_Grafico_pais->NM_ajax_flag = true;
          $contr_Grafico_pais->NM_ajax_opcao = "ajax_filter_save";
      }
      if ('ajax_filter_delete' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opcao'] = "busca";
          $contr_Grafico_pais->NM_ajax_flag = true;
          $contr_Grafico_pais->NM_ajax_opcao = "ajax_filter_delete";
      }
      if ('ajax_filter_select' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opcao'] = "busca";
          $contr_Grafico_pais->NM_ajax_flag = true;
          $contr_Grafico_pais->NM_ajax_opcao = "ajax_filter_select";
      }
      if ('ajax_comb_table' == $nmgp_opcao)
      {
          $contr_Grafico_pais->NM_ajax_flag = true;
          $contr_Grafico_pais->NM_ajax_opcao = "ajax_comb_table";
      }
      if ('ajax_comb_save' == $nmgp_opcao)
      {
          $contr_Grafico_pais->NM_ajax_flag = true;
          $contr_Grafico_pais->NM_ajax_opcao = "ajax_comb_save";
      }
      if ('ajax_comb_sort' == $nmgp_opcao)
      {
          $contr_Grafico_pais->NM_ajax_flag = true;
          $contr_Grafico_pais->NM_ajax_opcao = "ajax_comb_sort";
      }
       $contr_Grafico_pais->controle();
   } 
   if (!$_SESSION['sc_session'][$script_case_init]['Grafico_pais']['embutida'] && $nmgp_opcao == "formphp")
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 0;  
       $contr_Grafico_pais = new Grafico_pais_apl();
       $contr_Grafico_pais->controle();
   } 
//
   function nm_limpa_str_Grafico_pais(&$str)
   {
   }
   function nm_protect_num_Grafico_pais($name, &$val)
   {
       if (empty($val))
       {
          return;
       }
       $Nm_numeric = array();
       $simb_grp = (isset($_SESSION['scriptcase']['reg_conf']['grup_num'])) ? $_SESSION['scriptcase']['reg_conf']['grup_num'] : ".";
       $simb_dec = (isset($_SESSION['scriptcase']['reg_conf']['dec_num']))  ? $_SESSION['scriptcase']['reg_conf']['dec_num']  : ",";
       $simb_neg = (isset($_SESSION['scriptcase']['reg_conf']['simb_neg'])) ? $_SESSION['scriptcase']['reg_conf']['simb_neg'] : "-";
       if (in_array($name, $Nm_numeric))
       {
           if (is_array($val))
           {
               foreach ($val as $cada_val)
               {
                  $tmp_pos = (is_string($cada_val)) ? strpos($cada_val, "##@@") : false;
                  if ($tmp_pos !== false)
                   {
                      $cada_val = substr($cada_val, 0, $tmp_pos);
                  }
                  for ($x = 0; $x < strlen($cada_val); $x++)
                  {
                      if (($cada_val[$x] < 0 || $cada_val[$x] > 9) && $cada_val[$x] != $simb_grp && $cada_val[$x] != $simb_dec && $cada_val[$x] != $simb_neg)
                      {
                          $val = array();
                          return;
                      }
                   }
               }
               return;
           }
           $cada_val = $val;
           $tmp_pos = (is_string($cada_val)) ? strpos($cada_val, "##@@") : false;
           if ($tmp_pos !== false)
            {
               $cada_val = substr($cada_val, 0, $tmp_pos);
           }
           for ($x = 0; $x < strlen($cada_val); $x++)
           {
               if (($cada_val[$x] < 0 || $cada_val[$x] > 9) && $cada_val[$x] != $simb_grp && $cada_val[$x] != $simb_dec && $cada_val[$x] != $simb_neg)
               {
                   $val = 0;
                   return;
               }
           }
       }
   }
   function Grafico_pais_pack_protect_string($sString)
   {
      $sString = (string) $sString;
      if (!empty($sString))
      {
         if (function_exists('NM_is_utf8') && NM_is_utf8($sString))
         {
             return $sString;
         }
         else
         {
             return sc_htmlentities($sString);
         }
      }
      elseif ('0' === $sString || 0 === $sString)
      {
         return '0';
      }
      else
      {
         return '';
      }
   }

    function Grafico_pais_pdf_progress_call($message, $Nm_lang, $flushBuffer = false) {
        $message = trim($message);
        if ('off' == $message)
        {
            $bol_end = TRUE;
        }
        elseif (false !== strpos($message, 'HDOC_#NM#_'))
        {
            $bol_end    = FALSE;
            $arr_partes = explode('_#NM#_', $message);
            if (4 == sizeof($arr_partes))
            {
                $int_size = $arr_partes[0];
                $str_msg  = ('F' == $arr_partes[2]) ? $Nm_lang['lang_pdff_frmt_page']  : $Nm_lang['lang_pdff_wrtg'];
                $str_msg .= $arr_partes[2];
                $int_step = ('F' == $arr_partes[2]) ? floor($int_size * 0.9) : floor($int_size * 0.95);
            }
            else
            {
                $bol_load = FALSE;
            }
        }
        else
        {
            $bol_end    = FALSE;
            $arr_partes = explode('_#NM#_', $message);
            if (3 == sizeof($arr_partes))
            {
                $int_size = $arr_partes[0];
                $int_step = $arr_partes[1];
                $str_msg  = $arr_partes[2];
            }
            else
            {
                $bol_load = FALSE;
            }
        }
        $return_message = $int_size . '!#!' . $int_step . '!#!' . ($bol_end ? '1' : '0') . '!#!' . ($bol_end ? $Nm_lang['lang_pdff_fnsh'] : $str_msg);
?>
<script type="text/javascript">
if (window.parent && typeof window.parent.updateProgressBar === "function") {
    window.parent.updateProgressBar("<?php echo trim($return_message); ?>");
}
</script>
<?php
        global $script_case_init;
        if ($flushBuffer && $_SESSION['sc_session'][$script_case_init]['Grafico_pais']['opcao'] != 'print') {
            $bufferSize = @ini_get('output_buffering');
            if ('' != $bufferSize) {
                echo str_repeat('&nbsp;', $bufferSize * 5);
            }
        }
        flush();
    }

?>
