<?php
include_once('menu_session.php');
@ini_set('session.cookie_httponly', 1);
@ini_set('session.use_only_cookies', 1);
@ini_set('session.cookie_secure', 0);
session_start();
if (!function_exists("sc_check_mobile"))
{
    include_once("../_lib/lib/php/nm_check_mobile.php");
}
$_SESSION['scriptcase']['device_mobile'] = sc_check_mobile();
if (!isset($_SESSION['scriptcase']['display_mobile']))
{
    $_SESSION['scriptcase']['display_mobile'] = true;
}
if ($_SESSION['scriptcase']['device_mobile'])
{
    if ($_SESSION['scriptcase']['display_mobile'] && isset($_POST['_sc_force_mobile']) && 'out' == $_POST['_sc_force_mobile'])
    {
        $_SESSION['scriptcase']['display_mobile'] = false;
    }
    elseif (!$_SESSION['scriptcase']['display_mobile'] && isset($_POST['_sc_force_mobile']) && 'in' == $_POST['_sc_force_mobile'])
    {
        $_SESSION['scriptcase']['display_mobile'] = true;
    }
}
    $_SESSION['scriptcase']['menu']['glo_nm_path_prod']      = "/scriptcase/prod";
    $_SESSION['scriptcase']['menu']['glo_nm_perfil']         = "";
    $_SESSION['scriptcase']['menu']['glo_nm_conexao']        = "";
    $_SESSION['scriptcase']['menu']['glo_nm_path_imag_temp'] = "/scriptcase/tmp";
    $_SESSION['scriptcase']['menu']['glo_nm_usa_grupo']      = "S";
    //check publication with the prod
    $str_path_apl_url  = $_SERVER['PHP_SELF'];
    $str_path_apl_url  = str_replace("\\", '/', $str_path_apl_url);
    $str_path_apl_url  = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
    $str_path_apl_url  = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
    //check prod
    if(empty($_SESSION['scriptcase']['menu']['glo_nm_path_prod']))
    {
            /*check prod*/$_SESSION['scriptcase']['menu']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
    }
    //check tmp
    if(empty($_SESSION['scriptcase']['menu']['glo_nm_path_imag_temp']))
    {
            /*check tmp*/$_SESSION['scriptcase']['menu']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
    }
    //end check publication with the prod

ob_start();

class menu_class
{
  var $Db;

 function sc_Include($path, $tp, $name)
 {
     if ((empty($tp) && empty($name)) || ($tp == "F" && !function_exists($name)) || ($tp == "C" && !class_exists($name)))
     {
         include_once($path);
     }
 } // sc_Include

 function menu_menu()
 {
    global $menu_menuData, $nm_data_fixa;
     if (isset($_POST["nmgp_idioma"]))  
     { 
         $Temp_lang = explode(";" , $_POST["nmgp_idioma"]);  
         $_SESSION['scriptcase']['lang_op_sel'] = $Temp_lang[0];  
         if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))  
          { 
             $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
         } 
         if (isset($Temp_lang[1]) && !empty($Temp_lang[1])) 
         { 
             $_SESSION['scriptcase']['str_conf_reg'] = $Temp_lang[1];
         } 
     } 
   
     if (isset($_POST["nmgp_schema"]))  
     { 
         $_SESSION['scriptcase']['str_schema_all'] = $_POST["nmgp_schema"] . "/" . $_POST["nmgp_schema"];
     } 
   
           $nm_versao_sc  = "" ; 
           $_SESSION['scriptcase']['menu']['contr_erro'] = 'off';
           $Campos_Mens_erro = "";
           $sc_site_ssl   = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? true : false;
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
      //check publication with the prod
      $str_path_apl_url = $_SERVER['PHP_SELF'];
      $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
      $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
      $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
      $str_path_apl_dir = substr($str_path_sys, 0, strrpos($str_path_sys, "/"));
      $str_path_apl_dir = substr($str_path_apl_dir, 0, strrpos($str_path_apl_dir, "/")+1);
      //check prod
      if(empty($_SESSION['scriptcase']['menu']['glo_nm_path_prod']))
      {
              /*check prod*/$_SESSION['scriptcase']['menu']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
      }
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
$str_path_web   = $_SERVER['PHP_SELF'];
$str_path_web   = str_replace("\\", '/', $str_path_web);
$str_path_web   = str_replace('//', '/', $str_path_web);
$str_root       = substr($str_path_sys, 0, -1 * strlen($str_path_web));
$path_link      = substr($str_path_web, 0, strrpos($str_path_web, '/'));
$path_link      = substr($path_link, 0, strrpos($path_link, '/')) . '/';
$path_btn       = $str_root . $path_link . "_lib/buttons/";
$path_imag_cab  = $path_link . "_lib/img";
$this->force_mobile = false;
$this->path_botoes    = '../_lib/img';
$this->path_imag_apl  = $str_root . $path_link . "_lib/img";
$path_help      = $path_link . "_lib/webhelp/";
$path_libs      = $str_root . $_SESSION['scriptcase']['menu']['glo_nm_path_prod'] . "/lib/php";
$path_third     = $str_root . $_SESSION['scriptcase']['menu']['glo_nm_path_prod'] . "/third";
$path_adodb     = $str_root . $_SESSION['scriptcase']['menu']['glo_nm_path_prod'] . "/third/adodb";
$path_apls      = $str_root . substr($path_link, 0, strrpos($path_link, '/'));
$path_img_old   = $str_root . $path_link . "menu/img";
$this->path_css = $str_root . $path_link . "_lib/css/";
$_SESSION['scriptcase']['dir_temp'] = $str_root . $_SESSION['scriptcase']['menu']['glo_nm_path_imag_temp'];
$this->url_css = "../_lib/css/";
$path_lib_php   = $str_root . $path_link . "_lib/lib/php";
$menu_mobile_hide          = 'N';
$menu_mobile_inicial_state = 'escondido';
$menu_mobile_hide_onclick  = 'S';
$menutree_mobile_float     = 'S';
$menu_mobile_hide_icon     = 'N';
$menu_mobile_hide_icon_menu_position     = 'right';
$mobile_menu_mobile_hide          = 'S';
$mobile_menu_mobile_inicial_state = 'aberto';
$mobile_menu_mobile_hide_onclick  = 'S';
$mobile_menutree_mobile_float     = 'S';
$mobile_menu_mobile_hide_icon     = 'N';
$mobile_menu_mobile_hide_icon_menu_position     = 'right';

$this->sc_Include($path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
 if(function_exists('set_php_timezone')) set_php_timezone('menu');
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
                $nm_apl_dest = $path_link . SC_dir_app_name($nm_apl_dest) . "/";
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
if (!defined("SC_ERROR_HANDLER"))
{
    define("SC_ERROR_HANDLER", 1);
    include_once(dirname(__FILE__) . "/menu_erro.php");
}
include_once(dirname(__FILE__) . "/menu_erro.class.php"); 
$this->Erro = new menu_erro();
$str_path = substr($_SESSION['scriptcase']['menu']['glo_nm_path_prod'], 0, strrpos($_SESSION['scriptcase']['menu']['glo_nm_path_prod'], '/') + 1);
if (!is_file($str_root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
{
    unset($_SESSION['scriptcase']['nm_sc_retorno']);
    unset($_SESSION['scriptcase']['menu']['glo_nm_conexao']);
}

/* Definiciones de las rutas */
$menu_menuData         = array();
$menu_menuData['path'] = array();
$menu_menuData['url']  = array();
$menu_menuData['data'] = array();
$NM_dir_atual = getcwd();
if (empty($NM_dir_atual))
{
    $menu_menuData['path']['sys'] = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
    $menu_menuData['path']['sys'] = str_replace("\\", '/', $str_path_sys);
    $menu_menuData['path']['sys'] = str_replace('//', '/', $str_path_sys);
}
else
{
    $sc_nm_arquivo                                   = explode("/", $_SERVER['PHP_SELF']);
    $menu_menuData['path']['sys'] = str_replace("\\", "/", str_replace("\\\\", "\\", getcwd())) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
}
$menu_menuData['url']['web']   = $_SERVER['PHP_SELF'];
$menu_menuData['url']['web']   = str_replace("\\", '/', $menu_menuData['url']['web']);
$menu_menuData['path']['root'] = substr($menu_menuData['path']['sys'],  0, -1 * strlen($menu_menuData['url']['web']));
$menu_menuData['path']['app']  = substr($menu_menuData['path']['sys'],  0, strrpos($menu_menuData['path']['sys'],  '/'));
$menu_menuData['path']['link'] = substr($menu_menuData['path']['app'],  0, strrpos($menu_menuData['path']['app'],  '/'));
$menu_menuData['path']['link'] = substr($menu_menuData['path']['link'], 0, strrpos($menu_menuData['path']['link'], '/')) . '/';
$menu_menuData['path']['app'] .= '/';
$menu_menuData['url']['app']   = substr($menu_menuData['url']['web'],  0, strrpos($menu_menuData['url']['web'],  '/'));
$menu_menuData['url']['link']  = substr($menu_menuData['url']['app'],  0, strrpos($menu_menuData['url']['app'],  '/'));
if ($_SESSION['scriptcase']['menu']['glo_nm_usa_grupo'] == "S")
{
    $menu_menuData['url']['link']  = substr($menu_menuData['url']['link'], 0, strrpos($menu_menuData['url']['link'], '/'));
}
$menu_menuData['url']['link']  .= '/';
$menu_menuData['url']['app']   .= '/';


$_SESSION['scriptcase']['menu']['sc_apl_link'] = $menu_menuData['url']['link'];

$_SESSION['scriptcase']['lang_op_sel'] = "es";  
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
if (isset($_SESSION['scriptcase']['menu']['session_timeout']['lang'])) {
    $this->str_lang = $_SESSION['scriptcase']['menu']['session_timeout']['lang'];
}
elseif (!isset($_SESSION['scriptcase']['menu']['actual_lang']) || $_SESSION['scriptcase']['menu']['actual_lang'] != $this->str_lang) {
    $_SESSION['scriptcase']['menu']['actual_lang'] = $this->str_lang;
    setcookie('sc_actual_lang_Proyecto_gestion_faltas',$this->str_lang,'0','/');
}
if (!function_exists("NM_is_utf8"))
{
   include_once("../_lib/lib/php/nm_utf8.php");
}
if (!function_exists("SC_dir_app_ini"))
{
    include_once("../_lib/lib/php/nm_ctrl_app_name.php");
}
SC_dir_app_ini('Proyecto_gestion_faltas');
if ($_SESSION['scriptcase']['menu']['glo_nm_usa_grupo'] == "S")
{
    $path_apls     = substr($path_apls, 0, strrpos($path_apls, '/'));
}
$path_apls     .= "/";
$this->str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_Rhino/Sc9_Rhino";
include("../_lib/lang/". $this->str_lang .".lang.php");
include("../_lib/css/" . $this->str_schema_all . "_menu2.php");
if(isset($pagina_schemamenu) && !empty($pagina_schemamenu) && is_file("../_lib/menuicons/". $pagina_schemamenu .".php"))
{
    include("../_lib/menuicons/". $pagina_schemamenu .".php");
}
$this->img_sep_toolbar = trim($str_toolbar_separator);
include("../_lib/lang/config_region.php");
include("../_lib/lang/lang_config_region.php");
$this->regionalDefault();
$Str_btn_menu = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
$Str_btn_css  = trim($str_button) . "/" . trim($str_button) . ".css";
include($path_btn . $Str_btn_menu);
if (!function_exists("nmButtonOutput"))
{
   include_once("../_lib/lib/php/nm_gp_config_btn.php");
}
asort($this->Nm_lang_conf_region);
$this->sc_Include($path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
$this->sc_Include($path_lib_php . "/nm_functions.php", "", "") ; 
$this->sc_Include($path_lib_php . "/nm_api.php", "", "") ; 
$this->nm_data = new nm_data("es");
include_once("menu_toolbar.php");

$this->tab_grupo[0] = "Proyecto_gestion_faltas/";
if ($_SESSION['scriptcase']['menu']['glo_nm_usa_grupo'] != "S")
{
    $this->tab_grupo[0] = "";
}

     $_SESSION['scriptcase']['menu_atual'] = "menu";
     $_SESSION['scriptcase']['menu_apls']['menu'] = array();
     if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
     {
         foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
         {
             if (isset($_SESSION['scriptcase']['menu']['glo_nm_conexao']) && $_SESSION['scriptcase']['menu']['glo_nm_conexao'] == $NM_con_orig)
             {
/*NM*/           $_SESSION['scriptcase']['menu']['glo_nm_conexao'] = $NM_con_dest;
             }
             if (isset($_SESSION['scriptcase']['menu']['glo_nm_perfil']) && $_SESSION['scriptcase']['menu']['glo_nm_perfil'] == $NM_con_orig)
             {
/*NM*/           $_SESSION['scriptcase']['menu']['glo_nm_perfil'] = $NM_con_dest;
             }
             if (isset($_SESSION['scriptcase']['menu']['glo_con_' . $NM_con_orig]))
             {
                 $_SESSION['scriptcase']['menu']['glo_con_' . $NM_con_orig] = $NM_con_dest;
             }
         }
     }
$_SESSION['scriptcase']['charset'] = "UTF-8";
ini_set('default_charset', $_SESSION['scriptcase']['charset']);
$_SESSION['scriptcase']['charset_html']  = (isset($this->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
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
if (isset($this->Nm_lang['lang_errm_dbcn_conn']))
{
    $_SESSION['scriptcase']['db_conn_error'] = $this->Nm_lang['lang_errm_dbcn_conn'];
}
if (isset($_SESSION['scriptcase']['menu']['session_timeout']['redir'])) {
    $SS_cod_html  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
';
    $SS_cod_html .= "<HTML>\r\n";
    $SS_cod_html .= " <HEAD>\r\n";
    $SS_cod_html .= "  <TITLE></TITLE>\r\n";
    $SS_cod_html .= "   <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\"/>\r\n";
    if ($_SESSION['scriptcase']['proc_mobile']) {
        $SS_cod_html .= "   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\"/>\r\n";
    }
    $SS_cod_html .= "   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n";
    $SS_cod_html .= "    <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n";
    if ($_SESSION['scriptcase']['menu']['session_timeout']['redir_tp'] == "R") {
        $SS_cod_html .= "  </HEAD>\r\n";
        $SS_cod_html .= "   <body>\r\n";
    }
    else {
        $SS_cod_html .= "    <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n";
        $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_menu2.css\"/>\r\n";
        $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_menu2" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\"/>\r\n";
        $SS_cod_html .= "  </HEAD>\r\n";
        $SS_cod_html .= "   <body class=\"scMenuHPage\">\r\n";
        $SS_cod_html .= "    <table align=\"center\"><tr><td style=\"padding: 0\"><div>\r\n";
        $SS_cod_html .= "    <table class=\"scMenuHMoldura\" width='100%' cellspacing=0 cellpadding=0><tr class=\"scMenuHHeader\"><td class=\"scMenuHHeaderFont\" style=\"padding: 15px 30px; text-align: center\">\r\n";
        $SS_cod_html .= $this->Nm_lang['lang_errm_expired_session'] . "\r\n";
        $SS_cod_html .= "     <form name=\"Fsession_redir\" method=\"post\"\r\n";
        $SS_cod_html .= "           target=\"_self\">\r\n";
        $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['menu']['session_timeout']['redir'] . "');\">\r\n";
        $SS_cod_html .= "     </form>\r\n";
        $SS_cod_html .= "    </td></tr></table>\r\n";
        $SS_cod_html .= "    </div></td></tr></table>\r\n";
    }
    $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
    if ($_SESSION['scriptcase']['menu']['session_timeout']['redir_tp'] == "R") {
        $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['menu']['session_timeout']['redir'] . "');\r\n";
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
    unset($_SESSION['scriptcase']['menu']['session_timeout']);
    unset($_SESSION['sc_session']);
}
if (isset($SS_cod_html))
{
    echo $SS_cod_html;
    exit;
}
$_SESSION['scriptcase']['erro']['str_schema'] = $this->str_schema_all . "_error.css";
$_SESSION['scriptcase']['erro']['str_schema_dir'] = $this->str_schema_all . "_error" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
$_SESSION['scriptcase']['erro']['str_lang']   = $this->str_lang;
if (is_dir($path_img_old))
{
    $Res_dir_img = @opendir($path_img_old);
    if ($Res_dir_img)
    {
        while (FALSE !== ($Str_arquivo = @readdir($Res_dir_img))) 
        {
           $Str_arquivo = "/" . $Str_arquivo;
           if (@is_file($path_img_old . $Str_arquivo) && '.' != $Str_arquivo && '..' != $path_img_old . $Str_arquivo)
           {
               @unlink($path_img_old . $Str_arquivo);
           }
        }
    }
    @closedir($Res_dir_img);
    rmdir($path_img_old);
}
//
if (isset($_GET) && !empty($_GET))
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
            $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
        }
         $$nmgp_var = $nmgp_val;
    }
}
if (isset($_POST) && !empty($_POST))
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
            $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
        }
         $$nmgp_var = $nmgp_val;
    }
}
if (isset($script_case_init))
{
    $_SESSION['sc_session'][1]['menu']['init'] = $script_case_init;
}
else
if (!isset($_SESSION['sc_session'][1]['menu']['init']))
{
    $_SESSION['sc_session'][1]['menu']['init'] = "";
}
$script_case_init = $_SESSION['sc_session'][1]['menu']['init'];
if (isset($nmgp_parms) && !empty($nmgp_parms)) 
{ 
    $nmgp_parms = NM_decode_input($nmgp_parms);
    $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
    $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
    $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
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
       $Tmp_par   = $cadapar[0];;
       $$Tmp_par = $cadapar[1];
       $_SESSION[$cadapar[0]] = $cadapar[1];
       $ix++;
     }
} 
if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['menu']['session_timeout']['redir']))
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
$nm_url_saida = "";
if (isset($nmgp_url_saida))
{
    $nm_url_saida = $nmgp_url_saida;
    if (isset($script_case_init))
    {
        $nm_url_saida .= "?script_case_init=" . NM_encode_input($script_case_init);
    }
}
if (isset($_POST["nmgp_idioma"]) || isset($_POST["nmgp_schema"]))  
{ 
    $nm_url_saida = $_SESSION['scriptcase']['sc_saida_menu'];
}
elseif (!empty($nm_url_saida))
{
    $_SESSION['scriptcase']['sc_url_saida'][$script_case_init]  = $nm_url_saida;
    $_SESSION['scriptcase']['sc_saida_menu'] = $nm_url_saida;
}
else
{
    $_SESSION['scriptcase']['sc_saida_menu'] = (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "javascript:window.close()";
}
$this->sc_Include($path_libs . "/nm_ini_lib.php", "F", "nm_dir_normaliza") ; 
/* Dados do menu em sessao */
$_SESSION['nm_menu'] = array('prod' => $str_root . $_SESSION['scriptcase']['menu']['glo_nm_path_prod'] . '/third/COOLjsMenu/',
                              'url' => $_SESSION['scriptcase']['menu']['glo_nm_path_prod'] . '/third/COOLjsMenu/');

if ((isset($nmgp_outra_jan) && $nmgp_outra_jan == "true") || (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'menu'))
{
    $_SESSION['sc_session'][1]['menu']['sc_outra_jan'] = true;
     unset($_SESSION['scriptcase']['sc_outra_jan']);
    $_SESSION['scriptcase']['sc_saida_menu'] = "javascript:window.close()";
}
/* Menú de configuración de las variables */

if (!isset($_SESSION['scriptcase']['sc_apl_seg']))
{
    $_SESSION['scriptcase']['sc_apl_seg'] = array();
}
if (is_file($path_apls . $this->tab_grupo[0] . "_lib/_app_data/tabs_alertas_ini.php"))
{
    include($path_apls . $this->tab_grupo[0] . "_lib/_app_data/tabs_alertas_ini.php");
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['tabs_alertas']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['tabs_alertas'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['tabs_alertas'] = "on";
    } 
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['tabs_alertas'] = "on";
} 
/* Elementos de menú */

$sOutputBuffer = ob_get_contents();
ob_end_clean();

$saida_apl = $_SESSION['scriptcase']['sc_saida_menu'];

$menu_menuData['data'] = array();
$str_disabled = 'N';
$str_label = "Consulta de faltas";
$str_hint = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($str_label))
{
    $str_label = sc_convert_encoding($str_label, "UTF-8", $_SESSION['scriptcase']['charset']);
    $str_hint = sc_convert_encoding($str_hint, "UTF-8", $_SESSION['scriptcase']['charset']);
}
$menu_menuData['data']['itens']['item_1'] = array(
                                                  'label'       => $str_label,
                                                  'link'        => "#",
                                                  'hint'        => $str_hint,
                                                  'icon_fa'     => "fas fa-info-circle",
                                                  'link_target'     => "self",
                                                  'fav_check'     => "N",
                                                  'icon_check'     => "S",
                                                  'id'     => "item_1",
                                                  'target'      => $this->menu_target('_self'),
                                                  'disabled'    => $str_disabled,
                                                  'parent_list'    => array (
),
                                                  'itens'    => [],
                                                  );
$str_disabled = 'N';
$str_label = "Registro de faltas";
$str_hint = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($str_label))
{
    $str_label = sc_convert_encoding($str_label, "UTF-8", $_SESSION['scriptcase']['charset']);
    $str_hint = sc_convert_encoding($str_hint, "UTF-8", $_SESSION['scriptcase']['charset']);
}
$menu_menuData['data']['itens']['item_1']['itens']['item_2'] = array(
                                                  'label'       => $str_label,
                                                  'link'        => "#",
                                                  'hint'        => $str_hint,
                                                  'icon_fa'     => "fas fa-plus",
                                                  'link_target'     => "self",
                                                  'fav_check'     => "N",
                                                  'icon_check'     => "S",
                                                  'id'     => "item_2",
                                                  'target'      => $this->menu_target('_self'),
                                                  'disabled'    => $str_disabled,
                                                  'parent_list'    => array (
  0 => 'item_1',
),
                                                  'itens'    => [],
                                                  );
$str_disabled = 'N';
$str_label = "Resumen";
$str_hint = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($str_label))
{
    $str_label = sc_convert_encoding($str_label, "UTF-8", $_SESSION['scriptcase']['charset']);
    $str_hint = sc_convert_encoding($str_hint, "UTF-8", $_SESSION['scriptcase']['charset']);
}
$menu_menuData['data']['itens']['item_1']['itens']['item_3'] = array(
                                                  'label'       => $str_label,
                                                  'link'        => "#",
                                                  'hint'        => $str_hint,
                                                  'icon_fa'     => "fas fa-chart-bar",
                                                  'link_target'     => "self",
                                                  'fav_check'     => "N",
                                                  'icon_check'     => "S",
                                                  'id'     => "item_3",
                                                  'target'      => $this->menu_target('_self'),
                                                  'disabled'    => $str_disabled,
                                                  'parent_list'    => array (
  0 => 'item_1',
),
                                                  'itens'    => [],
                                                  );
$str_disabled = 'N';
$str_label = "Faltas en cola";
$str_hint = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($str_label))
{
    $str_label = sc_convert_encoding($str_label, "UTF-8", $_SESSION['scriptcase']['charset']);
    $str_hint = sc_convert_encoding($str_hint, "UTF-8", $_SESSION['scriptcase']['charset']);
}
$menu_menuData['data']['itens']['item_4'] = array(
                                                  'label'       => $str_label,
                                                  'link'        => "#",
                                                  'hint'        => $str_hint,
                                                  'icon_fa'     => "fab fa-stripe-s",
                                                  'link_target'     => "self",
                                                  'fav_check'     => "N",
                                                  'icon_check'     => "S",
                                                  'id'     => "item_4",
                                                  'target'      => $this->menu_target('_self'),
                                                  'disabled'    => $str_disabled,
                                                  'parent_list'    => array (
),
                                                  'itens'    => [],
                                                  );
$str_disabled = 'N';
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['tabs_alertas']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['tabs_alertas']) != "on")
{
    $str_link = "#";
    $str_disabled = 'Y';
}
$str_label = "Alerta acumulación de faltas";
$str_hint = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($str_label))
{
    $str_label = sc_convert_encoding($str_label, "UTF-8", $_SESSION['scriptcase']['charset']);
    $str_hint = sc_convert_encoding($str_hint, "UTF-8", $_SESSION['scriptcase']['charset']);
}
$menu_menuData['data']['itens']['item_5'] = array(
                                                  'label'       => $str_label,
                                                  'link'        => "menu_form_php.php?sc_item_menu=item_5&sc_apl_menu=tabs_alertas&sc_apl_link=" . urlencode($menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu']['glo_nm_usa_grupo'] . "",
                                                  'hint'        => $str_hint,
                                                  'icon_fa'     => "fas fa-bell",
                                                  'link_target'     => "self",
                                                  'fav_check'     => "N",
                                                  'icon_check'     => "S",
                                                  'id'     => "item_5",
                                                  'target'      => $this->menu_target('_self'),
                                                  'disabled'    => $str_disabled,
                                                  'parent_list'    => array (
),
                                                  'itens'    => [],
                                                  );
$str_disabled = 'N';
$str_label = "Actividad";
$str_hint = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($str_label))
{
    $str_label = sc_convert_encoding($str_label, "UTF-8", $_SESSION['scriptcase']['charset']);
    $str_hint = sc_convert_encoding($str_hint, "UTF-8", $_SESSION['scriptcase']['charset']);
}
$menu_menuData['data']['itens']['item_6'] = array(
                                                  'label'       => $str_label,
                                                  'link'        => "#",
                                                  'hint'        => $str_hint,
                                                  'icon_fa'     => "fas fa-pen-square",
                                                  'link_target'     => "self",
                                                  'fav_check'     => "N",
                                                  'icon_check'     => "S",
                                                  'id'     => "item_6",
                                                  'target'      => $this->menu_target('_self'),
                                                  'disabled'    => $str_disabled,
                                                  'parent_list'    => array (
),
                                                  'itens'    => [],
                                                  );
$str_disabled = 'N';
$str_label = "Perfil";
$str_hint = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($str_label))
{
    $str_label = sc_convert_encoding($str_label, "UTF-8", $_SESSION['scriptcase']['charset']);
    $str_hint = sc_convert_encoding($str_hint, "UTF-8", $_SESSION['scriptcase']['charset']);
}
$menu_menuData['data_user']['itens']['item_user_1'] = array(
                                                  'label'       => $str_label,
                                                  'link'        => "#",
                                                  'hint'        => $str_hint,
                                                  'icon_fa'     => "far fa-user",
                                                  'link_target'     => "self",
                                                  'fav_check'     => "N",
                                                  'icon_check'     => "S",
                                                  'id'     => "item_user_1",
                                                  'target'      => $this->menu_target('_self'),
                                                  'disabled'    => $str_disabled,
                                                  'parent_list'    => false,
                                                  'itens'    => [],
                                                  );
$str_disabled = 'N';
$str_label = "Ajustes";
$str_hint = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($str_label))
{
    $str_label = sc_convert_encoding($str_label, "UTF-8", $_SESSION['scriptcase']['charset']);
    $str_hint = sc_convert_encoding($str_hint, "UTF-8", $_SESSION['scriptcase']['charset']);
}
$menu_menuData['data_user']['itens']['item_user_2'] = array(
                                                  'label'       => $str_label,
                                                  'link'        => "#",
                                                  'hint'        => $str_hint,
                                                  'icon_fa'     => "fas fa-cog",
                                                  'link_target'     => "self",
                                                  'fav_check'     => "N",
                                                  'icon_check'     => "S",
                                                  'id'     => "item_user_2",
                                                  'target'      => $this->menu_target('_self'),
                                                  'disabled'    => $str_disabled,
                                                  'parent_list'    => false,
                                                  'itens'    => [],
                                                  );
$str_disabled = 'N';
$str_label = "FAQ";
$str_hint = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($str_label))
{
    $str_label = sc_convert_encoding($str_label, "UTF-8", $_SESSION['scriptcase']['charset']);
    $str_hint = sc_convert_encoding($str_hint, "UTF-8", $_SESSION['scriptcase']['charset']);
}
$menu_menuData['data_user']['itens']['item_user_3'] = array(
                                                  'label'       => $str_label,
                                                  'link'        => "#",
                                                  'hint'        => $str_hint,
                                                  'icon_fa'     => "far fa-question-circle",
                                                  'link_target'     => "self",
                                                  'fav_check'     => "N",
                                                  'icon_check'     => "S",
                                                  'id'     => "item_user_3",
                                                  'target'      => $this->menu_target('_self'),
                                                  'disabled'    => $str_disabled,
                                                  'parent_list'    => false,
                                                  'itens'    => [],
                                                  );
$str_disabled = 'N';
$str_label = "Salir";
$str_hint = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($str_label))
{
    $str_label = sc_convert_encoding($str_label, "UTF-8", $_SESSION['scriptcase']['charset']);
    $str_hint = sc_convert_encoding($str_hint, "UTF-8", $_SESSION['scriptcase']['charset']);
}
$menu_menuData['data_user']['itens']['item_user_4'] = array(
                                                  'label'       => $str_label,
                                                  'link'        => "#",
                                                  'hint'        => $str_hint,
                                                  'icon_fa'     => "fas fa-power-off",
                                                  'link_target'     => "self",
                                                  'fav_check'     => "N",
                                                  'icon_check'     => "S",
                                                  'id'     => "item_user_4",
                                                  'target'      => $this->menu_target('_self'),
                                                  'disabled'    => $str_disabled,
                                                  'parent_list'    => false,
                                                  'itens'    => [],
                                                  );
$str_disabled = 'N';
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['search']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['search']) != "on")
{
    $str_link = "#";
    $str_disabled = 'Y';
}
$str_label = "Búsqueda";
$str_hint = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($str_label))
{
    $str_label = sc_convert_encoding($str_label, "UTF-8", $_SESSION['scriptcase']['charset']);
    $str_hint = sc_convert_encoding($str_hint, "UTF-8", $_SESSION['scriptcase']['charset']);
}
$menu_menuData['data_tb']['itens']['item_tb_1'] = array(
                                                  'label'       => $str_label,
                                                  'link'        => "menu_form_php.php?sc_item_menu=item_tb_1&sc_apl_menu=search&sc_apl_link=" . urlencode($menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu']['glo_nm_usa_grupo'] . "",
                                                  'hint'        => $str_hint,
                                                  'icon_fa'     => "fas fa-search",
                                                  'link_target'     => "self",
                                                  'fav_check'     => "N",
                                                  'icon_check'     => "S",
                                                  'id'     => "item_tb_1",
                                                  'target'      => $this->menu_target('_self'),
                                                  'disabled'    => $str_disabled,
                                                  'parent_list'    => false,
                                                  'itens'    => [],
                                                  );
$str_disabled = 'N';
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['languages']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['languages']) != "on")
{
    $str_link = "#";
    $str_disabled = 'Y';
}
$str_label = "Idiomas";
$str_hint = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($str_label))
{
    $str_label = sc_convert_encoding($str_label, "UTF-8", $_SESSION['scriptcase']['charset']);
    $str_hint = sc_convert_encoding($str_hint, "UTF-8", $_SESSION['scriptcase']['charset']);
}
$menu_menuData['data_tb']['itens']['item_tb_2'] = array(
                                                  'label'       => $str_label,
                                                  'link'        => "menu_form_php.php?sc_item_menu=item_tb_2&sc_apl_menu=languages&sc_apl_link=" . urlencode($menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu']['glo_nm_usa_grupo'] . "",
                                                  'hint'        => $str_hint,
                                                  'icon_fa'     => "fas fa-globe",
                                                  'link_target'     => "self",
                                                  'fav_check'     => "N",
                                                  'icon_check'     => "S",
                                                  'id'     => "item_tb_2",
                                                  'target'      => $this->menu_target('_self'),
                                                  'disabled'    => $str_disabled,
                                                  'parent_list'    => false,
                                                  'itens'    => [],
                                                  );
$str_disabled = 'N';
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['themes']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['themes']) != "on")
{
    $str_link = "#";
    $str_disabled = 'Y';
}
$str_label = "Temas";
$str_hint = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($str_label))
{
    $str_label = sc_convert_encoding($str_label, "UTF-8", $_SESSION['scriptcase']['charset']);
    $str_hint = sc_convert_encoding($str_hint, "UTF-8", $_SESSION['scriptcase']['charset']);
}
$menu_menuData['data_tb']['itens']['item_tb_3'] = array(
                                                  'label'       => $str_label,
                                                  'link'        => "menu_form_php.php?sc_item_menu=item_tb_3&sc_apl_menu=themes&sc_apl_link=" . urlencode($menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu']['glo_nm_usa_grupo'] . "",
                                                  'hint'        => $str_hint,
                                                  'icon_fa'     => "fas fa-paint-roller",
                                                  'link_target'     => "self",
                                                  'fav_check'     => "N",
                                                  'icon_check'     => "S",
                                                  'id'     => "item_tb_3",
                                                  'target'      => $this->menu_target('_self'),
                                                  'disabled'    => $str_disabled,
                                                  'parent_list'    => false,
                                                  'itens'    => [],
                                                  );
$str_disabled = 'N';
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['shortcuts']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['shortcuts']) != "on")
{
    $str_link = "#";
    $str_disabled = 'Y';
}
$str_label = "Atajos";
$str_hint = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($str_label))
{
    $str_label = sc_convert_encoding($str_label, "UTF-8", $_SESSION['scriptcase']['charset']);
    $str_hint = sc_convert_encoding($str_hint, "UTF-8", $_SESSION['scriptcase']['charset']);
}
$menu_menuData['data_tb']['itens']['item_tb_4'] = array(
                                                  'label'       => $str_label,
                                                  'link'        => "menu_form_php.php?sc_item_menu=item_tb_4&sc_apl_menu=shortcuts&sc_apl_link=" . urlencode($menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu']['glo_nm_usa_grupo'] . "",
                                                  'hint'        => $str_hint,
                                                  'icon_fa'     => "fas fa-grip-vertical",
                                                  'link_target'     => "self",
                                                  'fav_check'     => "N",
                                                  'icon_check'     => "S",
                                                  'id'     => "item_tb_4",
                                                  'target'      => $this->menu_target('_self'),
                                                  'disabled'    => $str_disabled,
                                                  'parent_list'    => false,
                                                  'itens'    => [],
                                                  );

if (isset($_SESSION['scriptcase']['sc_def_menu']['menu']))
{
    $menu_menuData['data']['itens'] = $_SESSION['scriptcase']['sc_def_menu']['menu'];
}
if (isset($_SESSION['scriptcase']['sc_usermenu']['menu']))
{
    $menu_menuData['data_user']['itens'] = $_SESSION['scriptcase']['sc_usermenu']['menu'];
}
if (isset($_SESSION['scriptcase']['sc_def_shortcuts']['menu']) && !empty($_SESSION['scriptcase']['sc_def_shortcuts']['menu']))
{
    $menu_menuData['shortcuts'] = $_SESSION['scriptcase']['sc_def_shortcuts']['menu'];
}
if (is_file("menu_help.txt"))
{
    $Arq_WebHelp = file("menu_help.txt"); 
    if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
    {
        $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
        $Tmp = explode(";", $Arq_WebHelp[0]); 
        foreach ($Tmp as $Cada_help)
        {
            $Tmp1 = explode(":", $Cada_help); 
            if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "menu" && is_file($str_root . $path_help . $Tmp1[1]))
            {
                $str_disabled = "N";
                $str_link = "" . $path_help . $Tmp1[1] . "";
                $str_icon = "";
                $icon_aba = "";
                $icon_aba_inactive = "";
                if(empty($icon_aba) && isset($arr_menuicons['']['active']))
                {
                    $icon_aba = $arr_menuicons['']['active'];
                }
                if(empty($icon_aba_inactive) && isset($arr_menuicons['']['inactive']))
                {
                    $icon_aba_inactive = $arr_menuicons['']['inactive'];
                }
                $menu_menuData['data'][] = array(
                    'label'    => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'level'    => "0",
                    'link'     => $str_link,
                    'hint'     => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'id'       => "item_Help",
                    'icon'     => $str_icon,
                    'icon_aba' => $icon_aba,
                    'icon_aba_inactive' => $icon_aba_inactive,
                    'target'   => "" . $this->menu_target('_blank') . "",
                    'sc_id'    => "item_Help",
                    'disabled' => $str_disabled,
                    'display'     => "text",
                    'display_position'=> "",
                    'icon_fa'     => "",
                    'icon_color'     => "",
                    'icon_color_hover'     => "",
                    'icon_color_disabled'     => "",
                );
            }
        }
    }
}

if (isset($_SESSION['scriptcase']['sc_menu_del']['menu']) && !empty($_SESSION['scriptcase']['sc_menu_del']['menu']))
{
    sc_menu_delete($menu_menuData['data'], $_SESSION['scriptcase']['sc_menu_del']['menu']);
    sc_menu_delete($menu_menuData['data_user'], $_SESSION['scriptcase']['sc_menu_del']['menu']);
}
if (isset($_SESSION['scriptcase']['sc_menu_disable']['menu']) && !empty($_SESSION['scriptcase']['sc_menu_disable']['menu']))
{
    sc_menu_disable($menu_menuData['data'], $_SESSION['scriptcase']['sc_menu_disable']['menu']);
    sc_menu_disable($menu_menuData['data_user'], $_SESSION['scriptcase']['sc_menu_disable']['menu']);
}

/* Cabecera HTML */
    header("X-XSS-Protection: 1; mode=block");
    header("X-Frame-Options: SAMEORIGIN");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html class='ae' <?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?> style="height: 100%">
<head>
 <title>menu</title>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <?php
 if ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
 {
  ?>
   <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
  <?php
 }
 ?>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <?php 
 if(isset($str_google_fonts) && !empty($str_google_fonts)) 
 { 
     ?> 
     <link rel="stylesheet" type="text/css" href="<?php echo $str_google_fonts ?>" /> 
     <?php 
 } 
 ?> 
 <link rel="stylesheet" href="<?php echo $_SESSION['scriptcase']['menu']['glo_nm_path_prod']; ?>/third/font-awesome/6/css/all.min.css" type="text/css" media="screen" />
<style>
   .scTabText {
   }    <?php
        if(isset($_SESSION['scriptcase']['sc_def_menu']) && !empty($_SESSION['scriptcase']['sc_def_menu']))
        {
            foreach($_SESSION['scriptcase']['sc_def_menu'] as $arr_menus)
            {
              foreach($arr_menus as $id => $arr_item)
              {
                  if(isset($arr_item['icon_color']) && !empty($arr_item['icon_color']))
                  {
                      echo "   #" . $id . " .icon_fa{ color: ". $arr_item['icon_color'] ."  !important}
";
                      if(isset($menu_parms1['icons_inherit_style']) && $menu_parms1['icons_inherit_style'] == 'S')
                      {
                          echo "   #aba_td_" . $id . " i{ color:". $arr_item['icon_color'] ."  !important}
";
                      }
                  }
                  if(isset($arr_item['icon_color_hover']) && !empty($arr_item['icon_color_hover']))
                  {
                      echo "   #" . $id . ":hover .icon_fa{ color: ". $arr_item['icon_color_hover'] ."  !important}
";
                      if(isset($menu_parms1['icons_inherit_style']) && $menu_parms1['icons_inherit_style'] == 'S')
                      {
                          echo "   #aba_td_" . $id . ":hover i{ color:". $arr_item['icon_color_hover'] ."  !important}
";
                      }
                  }
                  if(isset($arr_item['icon_color_disabled']) && !empty($arr_item['icon_color_disabled']))
                  {
                      echo "   #" . $id . ".scdisabledmain .icon_fa{ color: ". $arr_item['icon_color_disabled'] ."  !important}
";
                      echo "   #" . $id . ".scdisabledsub .icon_fa{ color: ". $arr_item['icon_color_disabled'] ."  !important}
";
                      if(isset($menu_parms1['icons_inherit_style']) && $menu_parms1['icons_inherit_style'] == 'S')
                      {
                          echo "   #aba_td_" . $id . ".scTabInactive i{ color:". $arr_item['icon_color_disabled'] ."  !important}
";
                      }
                  }
              }
            }
        }
    ?>
</style>
<script type="text/javascript">
 var is_menu_vertical = false;
 function sc_session_redir(url_redir)
 {
     if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')
     {
         window.parent.sc_session_redir(url_redir);
     }
     else
     {
         if (window.opener && typeof window.opener.sc_session_redir === 'function')
         {
             window.close();
             window.opener.sc_session_redir(url_redir);
         }
         else
         {
             window.location = url_redir;
         }
     }
 }
</script>
</head>
<body style="height: 100%" scroll="no" class='scMenuHPage'>
<?php

if ('' != $sOutputBuffer)
{
    echo $sOutputBuffer;
}

    $NM_scr_iframe = (isset($_POST['hid_scr_iframe'])) ? $_POST['hid_scr_iframe'] : "";   
?> 
<span style="display:none"> 
   <form name="Nm_frm_change_lang_locale" method="post">
           <input type="hidden" name="hid_scr_iframe">
           <input type="hidden" name="nmgp_idioma">
   </form>
</span> 
<script type="text/javascript">
   function Nm_change_lang_locale()
   {
           var str_location = document.getElementById('iframe_menu').contentWindow.location.toString();
           if (str_location.indexOf('script_case_init') == -1)
           {
                   document.Nm_frm_change_lang_locale.hid_scr_iframe.value = str_location + (str_location.indexOf('?') > -1 ? '&' : '?');
           }
           else
           {
                   document.Nm_frm_change_lang_locale.hid_scr_iframe.value = str_location;
           }
           document.Nm_frm_change_lang_locale.nmgp_idioma.value = document.getElementById("id_nmgp_idioma").value; 
           document.Nm_frm_change_lang_locale.submit();
   }
</script>
<?php 
?> 
<span style="display:none"> 
   <form name="Nm_frm_change_schema" method="post">
           <input type="hidden" name="hid_scr_iframe">
           <input type="hidden" name="nmgp_schema">
   </form>
</span> 
<script type="text/javascript">
   function Nm_change_schema()
   {
           var str_location = document.getElementById('iframe_menu').contentWindow.location.toString();
           if (str_location.indexOf('script_case_init') == -1)
           {
                   document.Nm_frm_change_schema.hid_scr_iframe.value = str_location + (str_location.indexOf('?') > -1 ? '&' : '?') + 'script_case_init=1';
           }
           else
           {
                   document.Nm_frm_change_schema.hid_scr_iframe.value = str_location;
           }
           document.Nm_frm_change_schema.nmgp_schema.value = document.getElementById("id_nmgp_schema").value; 
           document.Nm_frm_change_schema.submit();
   }
</script>
<?php 

/* Archivos JS */
?>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['menu']['glo_nm_path_prod']; ?>/third/jquery/js/jquery.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['scriptcase']['menu']['glo_nm_path_prod']; ?>/third/lineicons/web-font-files/lineicons.css" /> 
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['menu']['glo_nm_path_prod']; ?>/third/Fuse/dist/fuse.min.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['menu']['glo_nm_path_prod']; ?>/third/sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['menu']['glo_nm_path_prod']; ?>/third/sweetalert/polyfill.min.js"></script>
<link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_sweetalert.css" />
<?php
$confirmButtonClass = '';
$cancelButtonClass  = '';
$confirmButtonText  = $this->Nm_lang['lang_btns_cfrm'];
$cancelButtonText   = $this->Nm_lang['lang_btns_cncl'];
$confirmButtonFA    = '';
$cancelButtonFA     = '';
$confirmButtonFAPos = '';
$cancelButtonFAPos  = '';
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['style']) && '' != $this->arr_buttons['bsweetalert_ok']['style']) {
    $confirmButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_ok']['style'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['style']) && '' != $this->arr_buttons['bsweetalert_cancel']['style']) {
    $cancelButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_cancel']['style'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['value']) && '' != $this->arr_buttons['bsweetalert_ok']['value']) {
    $confirmButtonText = $this->arr_buttons['bsweetalert_ok']['value'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['value']) && '' != $this->arr_buttons['bsweetalert_cancel']['value']) {
    $cancelButtonText = $this->arr_buttons['bsweetalert_cancel']['value'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) {
    $confirmButtonFA = $this->arr_buttons['bsweetalert_ok']['fontawesomeicon'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) {
    $cancelButtonFA = $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_ok']['display_position']) {
    $confirmButtonFAPos = 'text_right';
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_cancel']['display_position']) {
    $cancelButtonFAPos = 'text_right';
}
?>
<script type="text/javascript">
  var scSweetAlertConfirmButton = "<?php echo $confirmButtonClass ?>";
  var scSweetAlertCancelButton = "<?php echo $cancelButtonClass ?>";
  var scSweetAlertConfirmButtonText = "<?php echo $confirmButtonText ?>";
  var scSweetAlertCancelButtonText = "<?php echo $cancelButtonText ?>";
  var scSweetAlertConfirmButtonFA = "<?php echo $confirmButtonFA ?>";
  var scSweetAlertCancelButtonFA = "<?php echo $cancelButtonFA ?>";
  var scSweetAlertConfirmButtonFAPos = "<?php echo $confirmButtonFAPos ?>";
  var scSweetAlertCancelButtonFAPos = "<?php echo $cancelButtonFAPos ?>";
</script>
<script type="text/javascript" src="menu_message.js"></script>
<script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
<script type="text/javascript">
$(function() {
<?php
if (isset($this->nm_mens_alert) && count($this->nm_mens_alert)) {
   if (isset($this->Ini->nm_mens_alert) && !empty($this->Ini->nm_mens_alert))
   {
       if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
       {
           $this->nm_mens_alert   = array_merge($this->Ini->nm_mens_alert, $this->nm_mens_alert);
           $this->nm_params_alert = array_merge($this->Ini->nm_params_alert, $this->nm_params_alert);
       }
       else
       {
           $this->nm_mens_alert   = $this->Ini->nm_mens_alert;
           $this->nm_params_alert = $this->Ini->nm_params_alert;
       }
   }
   if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
   {
       foreach ($this->nm_mens_alert as $i_alert => $mensagem)
       {
           $alertParams = array();
           if (isset($this->nm_params_alert[$i_alert]))
           {
               foreach ($this->nm_params_alert[$i_alert] as $paramName => $paramValue)
               {
                   if (in_array($paramName, array('title', 'timer', 'confirmButtonText', 'confirmButtonFA', 'confirmButtonFAPos', 'cancelButtonText', 'cancelButtonFA', 'cancelButtonFAPos', 'footer', 'width', 'padding')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif (in_array($paramName, array('showConfirmButton', 'showCancelButton', 'toast')) && in_array($paramValue, array(true, false)))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('position' == $paramName && in_array($paramValue, array('top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', 'bottom-end')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('type' == $paramName && in_array($paramValue, array('warning', 'error', 'success', 'info', 'question')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('background' == $paramName)
                   {
                       $image_param = $paramValue;
                       preg_match_all('/url\(([\s])?(["|\'])?(.*?)(["|\'])?([\s])?\)/i', $paramValue, $matches, PREG_PATTERN_ORDER);
                       if (isset($matches[3])) {
                           foreach ($matches[3] as $match) {
                               if ('http:' != substr($match, 0, 5) && 'https:' != substr($match, 0, 6) && '/' != substr($match, 0, 1)) {
                                   $image_param = str_replace($match, "{$this->Ini->path_img_global}/{$match}", $image_param);
                               }
                           }
                       }
                       $paramValue = $image_param;
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
               }
           }
           $jsonParams = json_encode($alertParams);
?>
       scJs_alert('<?php echo $mensagem ?>', <?php echo $jsonParams ?>);
<?php
       }
   }
}
?>
});
</script>
<?php
$_SESSION['scriptcase']['sc_tab_meses']['int'] = array(
                                  $this->Nm_lang['lang_mnth_janu'],
                                  $this->Nm_lang['lang_mnth_febr'],
                                  $this->Nm_lang['lang_mnth_marc'],
                                  $this->Nm_lang['lang_mnth_apri'],
                                  $this->Nm_lang['lang_mnth_mayy'],
                                  $this->Nm_lang['lang_mnth_june'],
                                  $this->Nm_lang['lang_mnth_july'],
                                  $this->Nm_lang['lang_mnth_augu'],
                                  $this->Nm_lang['lang_mnth_sept'],
                                  $this->Nm_lang['lang_mnth_octo'],
                                  $this->Nm_lang['lang_mnth_nove'],
                                  $this->Nm_lang['lang_mnth_dece']);
$_SESSION['scriptcase']['sc_tab_meses']['abr'] = array(
                                  $this->Nm_lang['lang_shrt_mnth_janu'],
                                  $this->Nm_lang['lang_shrt_mnth_febr'],
                                  $this->Nm_lang['lang_shrt_mnth_marc'],
                                  $this->Nm_lang['lang_shrt_mnth_apri'],
                                  $this->Nm_lang['lang_shrt_mnth_mayy'],
                                  $this->Nm_lang['lang_shrt_mnth_june'],
                                  $this->Nm_lang['lang_shrt_mnth_july'],
                                  $this->Nm_lang['lang_shrt_mnth_augu'],
                                  $this->Nm_lang['lang_shrt_mnth_sept'],
                                  $this->Nm_lang['lang_shrt_mnth_octo'],
                                  $this->Nm_lang['lang_shrt_mnth_nove'],
                                  $this->Nm_lang['lang_shrt_mnth_dece']);
$_SESSION['scriptcase']['sc_tab_dias']['int'] = array(
                                  $this->Nm_lang['lang_days_sund'],
                                  $this->Nm_lang['lang_days_mond'],
                                  $this->Nm_lang['lang_days_tued'],
                                  $this->Nm_lang['lang_days_wend'],
                                  $this->Nm_lang['lang_days_thud'],
                                  $this->Nm_lang['lang_days_frid'],
                                  $this->Nm_lang['lang_days_satd']);
$_SESSION['scriptcase']['sc_tab_dias']['abr'] = array(
                                  $this->Nm_lang['lang_shrt_days_sund'],
                                  $this->Nm_lang['lang_shrt_days_mond'],
                                  $this->Nm_lang['lang_shrt_days_tued'],
                                  $this->Nm_lang['lang_shrt_days_wend'],
                                  $this->Nm_lang['lang_shrt_days_thud'],
                                  $this->Nm_lang['lang_shrt_days_frid'],
                                  $this->Nm_lang['lang_shrt_days_satd']);
$Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
$Lim   = strlen($Str_date);
$Ult   = "";
$Arr_D = array();
for ($I = 0; $I < $Lim; $I++)
{
    $Char = substr($Str_date, $I, 1);
    if ($Char != $Ult)
    {
        $Arr_D[] = $Char;
    }
    $Ult = $Char;
}
$Prim = true;
$Str  = "";
foreach ($Arr_D as $Cada_d)
{
    $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
    $Str .= $Cada_d;
    $Prim = false;
}
$Str = str_replace("a", "Y", $Str);
$Str = str_replace("y", "Y", $Str);
$nm_data_fixa = date($Str); 
?>
<?php
$larg_table = "100%";
$col_span   = "";
$strAlign = 'align=\'left\'';
?>
<script>
Iframe_atual = "menu_iframe";
Aba_atual = 'nm_frame_app';
function writeFastMenu(arr_link)
{
  return false;
}
function clearFastMenu(arr_link)
{
  return false;
}
        function checkSubMenuPosition(str_id)
        {
            submenu = $('#' + str_id + '.menu__link').next('ul');
            if(submenu.length)
            {
                if(submenu.offset().left + submenu.outerWidth() > $('#main_menu_table').width())
                {
                    submenu.css('margin-left', ( $('#main_menu_table').width() - submenu.offset().left - submenu.outerWidth() - 10 ));
                }
           }
        }function openMenuItem(str_id)
{
  if (str_id != "iframe_menu")
  {
      str_id        = str_id.replace("menu_","");
  }
    if($('#Iframe_control').length && $('#' + str_id).parent().length < 0)
    {
        $('#Iframe_control').append('<iframe id="iframe_btn_1" name="menu_btn_1_iframe" frameborder="0" class="scMenuIframe" style="display: none;" src=""></iframe>');
    }
  if($('#' + str_id).parent().length)
  {
      if(!$('#' + str_id).parent().hasClass('menu__item--active'))
      {
        $('#' + str_id).closest('ul').find('li').removeClass('menu__item--active');
      }
       $('#' + str_id).parent().toggleClass('menu__item--active');
  }
  str_link   = $('#' + str_id).attr('item-href');
  str_target = $('#' + str_id).attr('item-target');
  if (typeof str_link !== typeof undefined && str_link !== false) {
    //test link type
    if (str_link != '' && str_link != '#' && str_link != 'javascript:')
    {
        if (str_link.substring(0, 11) == 'javascript:')
        {
            eval(str_link.substring(11));
        }
        else if (str_link != '#' && str_target != '_parent')
        {
            window.open(str_link, str_target);
        }
        else if (str_link != '#' && str_target == '_parent')
        {
            document.location = str_link;
        }
        <?php
        if ($menu_mobile_hide == 'S' && $menu_mobile_hide_onclick == 'S')
        {
        ?>
            HideMenu();
        <?php
        }
        ?>
    }
    if(str_target != '_blank' && $('#iframe_menu').length)
        $('#iframe_menu')[0].contentWindow.focus();
  }
}
</script>
<div id='main_menu_table' class='scMenuHMoldura'>
    <?php echo $this->menu_MenuH($menu_menuData, $path_imag_cab, $strAlign); ?>
    <div id='idMenuDown'>
        <div id='idMenuRightSide'>
    <div id="Iframe_control" style=''>
      <iframe id="iframe_menu" name="menu_iframe" frameborder="0" class="scMenuIframe" style="width: 100%; height: ;"  src="<?php echo ($NM_scr_iframe != "" ? $NM_scr_iframe : "menu_pag_ini.php"); ?>"></iframe>
             </div id='Iframe_controlClose'>
        </div id='idMenuRightSideClose'>
    </div id='idMenuDownClose'>
</div>

    <script>
    $(document).ready(function() {
        $('.menu .menu__toggle').click(function(e){
            e.preventDefault();
            $(this).toggleClass('menu__toggle--active');
            $(this).parent().toggleClass('menu--active');
        });
        if($('#idMenuFooter').length)
        {
            $('#idMenuDown').css('height', "calc(100% - "+ $('#idMenuFooter').height() +")");

            if($('#idMenuVertical').length)
            {
                $('#idMenuVertical').css('height', "calc(100% - "+ $('#idMenuFooter').height() +")");
            }
        }
    });
    </script>
</body>
</html><?php
}
function menu_Header()
{
?>
    
<?php
}function menu_MenuH($menu_menuData, $path_imag_cab, $strAlign)
{
?>
    <div id='idMenuLine' class='scMenuArea'>
        <?php echo $this->menu_escreveMenu($menu_menuData, $path_imag_cab, $strAlign); ?>
    </div>
<?php
}
function menu_Footer()
{
?>
    
<?php
}
function menu_escreveMenuRec($arr_menu, $arr_menu_apl, $path_imag_cab = '')
{
    if (!defined('JSON_INVALID_UTF8_SUBSTITUTE')) {
        define('JSON_INVALID_UTF8_SUBSTITUTE', 0);
    }
    $menu_itens = (isset($arr_menu['itens']) && !empty($arr_menu['itens'])) ? json_encode(array_values($arr_menu['itens']), JSON_INVALID_UTF8_SUBSTITUTE) : '[]';
    $user_itens = (isset($arr_menu_apl['data_user']['itens']) && !empty($arr_menu_apl['data_user']['itens'])) ? json_encode(array_values($arr_menu_apl['data_user']['itens']), JSON_INVALID_UTF8_SUBSTITUTE) : '[]';
    $menu_data = json_decode('{"theme":"dark-rhino","layout":"V","header_string":"Consulta de faltas","header_string_pos":"H","check_split":"S","check_toolbar":"S","check_show_search_path":"S","check_shortcut_label":"S","check_start_expanded":"S","check_use_loader":"N","should_reload":"S","layout_usr_pos":"out","usercheck":"S","username":"","userimage":"","userdesc":"","logo":"..\/_lib\/img\/usr__NM__bg__NM__kfJZGaCcHOK4AAAAASUVORK5CYII.webp","logo_compact":"..\/_lib\/img\/usr__NM__bg__NM__kfJZGaCcHOK4AAAAASUVORK5CYII.webp","pick_themes":["dark-cobalt","dark-coffee","dark-sunset","dark-rhino","dark-pink","dark-hyper-space","dark-midnight","light-gray"],"shortcuts":[],"items":[{"text":"Consulta de faltas","app":"","icon":"fas fa-info-circle","icon_check":"S","id":"item_1","hint":"","link_target":"self","fav_check":"N","itree":{"a":{"attributes":[]},"icon":false,"li":{"attributes":[]}},"children":[{"text":"Registro de faltas","app":"","icon":"fas fa-plus","icon_check":"S","id":"item_2","hint":"","link_target":"self","fav_check":"N","itree":{"a":{"attributes":[]},"icon":false,"li":{"attributes":[]}},"target":"_self"},{"text":"Resumen","app":"","icon":"fas fa-chart-bar","icon_check":"S","id":"item_3","hint":"","link_target":"self","fav_check":"N","itree":{"a":{"attributes":[]},"icon":false,"li":{"attributes":[]}},"target":"_self"}],"target":"_self"},{"text":"Faltas en cola","app":"","icon":"fab fa-stripe-s","icon_check":"S","id":"item_4","hint":"","link_target":"self","fav_check":"N","itree":{"a":{"attributes":[]},"icon":false,"li":{"attributes":[]}},"target":"_self"},{"text":"Alerta acumulaci\u00f3n de faltas","app":"tabs_alertas","icon":"fas fa-bell","icon_check":"S","id":"item_5","hint":"","link_target":"self","fav_check":"N","itree":{"a":{"attributes":[]},"icon":false,"li":{"attributes":[]}},"target":"_self"},{"text":"Actividad","app":"","icon":"fas fa-pen-square","icon_check":"S","id":"item_6","hint":"","link_target":"self","fav_check":"N","itree":{"a":{"attributes":[]},"icon":false,"li":{"attributes":[]}},"target":"_self"}],"user_items":[{"text":"Perfil","app":"","icon":"far fa-user","icon_check":"S","id":"item_user_1","hint":"","link_target":"self","itree":{"a":{"attributes":[]},"icon":false,"li":{"attributes":[]}},"target":"_self","fav_check":"N"},{"text":"Ajustes","app":"","icon":"fas fa-cog","icon_check":"S","id":"item_user_2","hint":"","link_target":"self","itree":{"a":{"attributes":[]},"icon":false,"li":{"attributes":[]}},"target":"_self","fav_check":"N"},{"text":"FAQ","app":"","icon":"far fa-question-circle","icon_check":"S","id":"item_user_3","hint":"","link_target":"self","itree":{"a":{"attributes":[]},"icon":false,"li":{"attributes":[]}},"target":"_self","fav_check":"N"},{"text":"Salir","app":"","icon":"fas fa-power-off","icon_check":"S","id":"item_user_4","hint":"","link_target":"self","itree":{"a":{"attributes":[]},"icon":false,"li":{"attributes":[]}},"target":"_self","fav_check":"N"}],"tb_items":[{"text":"B\u00fasqueda","app":"search","icon":"fas fa-search","icon_check":"S","display":"S","id":"item_tb_1","itree":{"a":{"attributes":[]},"icon":false,"li":{"attributes":[]}},"target":"_self","hint":"","fav_check":"N","link_target":"self"},{"text":"Idiomas","app":"languages","icon":"fas fa-globe","icon_check":"S","display":"S","id":"item_tb_2","itree":{"a":{"attributes":[]},"icon":false,"li":{"attributes":[]}},"target":"_self","hint":"","fav_check":"N","link_target":"self"},{"text":"Temas","app":"themes","icon":"fas fa-paint-roller","icon_check":"S","display":"S","id":"item_tb_3","itree":{"a":{"attributes":[]},"icon":false,"li":{"attributes":[]}},"target":"_self","hint":"","fav_check":"N","link_target":"self"},{"text":"Atajos","app":"shortcuts","icon":"fas fa-grip-vertical","icon_check":"S","display":"S","id":"item_tb_4","itree":{"a":{"attributes":[]},"icon":false,"li":{"attributes":[]}},"target":"_self","hint":"","fav_check":"N","link_target":"self"}]}', true);
    $var_themes_list = json_decode('{"dark-cobalt":{"name":"Dark Cobalt","p":"#0A083A","a":"#3E3B87","t":"#DDDEE9","m":"#B3B2D4","b":"rgba(0, 0, 0, 0.5)"},"dark-coffee":{"name":"Dark Coffee","p":"#6C3B06","a":"#311a01","t":"#FDDAC0","m":"#FFEDD9","b":"rgba(0, 0, 0, 0.5)"},"dark-sunset":{"name":"Dark Sunset","p":"#451952","a":"#662549","t":"#DDDEE9","m":"#dab0a7","b":"rgba(0, 0, 0, 0.5)"},"dark-rhino":{"name":"Dark Rhino","p":"#27374D","a":"#526D82","t":"#DDDEE9","m":"#DDE6ED","b":"rgba(0, 0, 0, 0.5)"},"dark-pink":{"name":"Dark Pink","p":"#4C0033","a":"#b81470","t":"#DDDEE9","m":"#DF9AC7","b":"rgba(0, 0, 0, 0.5)"},"dark-hyper-space":{"name":"Dark Hyper Space","p":"#313866","a":"#b82d9e","t":"#DDDEE9","m":"#E7C2FD","b":"rgba(0, 0, 0, 0.5)"},"dark-midnight":{"name":"Dark Midnight","p":"#37404a","a":"#727cf5","t":"#DDDEE9","m":"#cbdcec","b":"rgba(0, 0, 0, 0.5)"},"light-gray":{"name":"Light Gray","p":"#ffffff","a":"#dadada","t":"rgba(47, 43, 61, 0.6784313725)","m":"rgba(47, 43, 61, 0.6784313725)","b":"rgba(0, 0, 0, 0.15)"}}', true);
    $var_targets = '{"blank":"_blank","_blank":"_blank","self":"nm_frame_app","_self":"nm_frame_app","window":"_window","parente":"_self","_parent":"_self"}';
    $apl_default = '';
    if (isset($_SESSION['scriptcase']['sc_apl_seg'][ $apl_default ]) && $_SESSION['scriptcase']['sc_apl_seg'][ $apl_default ] == 'on')
    {
        $apl_default = "menu_form_php.php?sc_item_menu=menu&sc_apl_menu=" . $apl_default . "&sc_apl_link=" . urlencode($arr_menu_apl['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu']['glo_nm_usa_grupo'];
    }
    
    if(isset($arr_menu_apl['shortcuts']) && !empty($arr_menu_apl['shortcuts']))
    {
        $menu_data['shortcuts'] = $arr_menu_apl['shortcuts'];
    }
    ?>
    <style>
        
        @charset "UTF-8";

*[data-aetheme] {
    --theme-menubar-global-scrollbarTrack-color: var(--theme-color-text);
    --theme-menubar-global-boxShadowColor: var(--theme-box-shadow);
    --theme-menubar-global-color-text: var(--theme-color-text);
    --theme-menubar-nav-menuitem-color: var(--theme-color-text);
    --theme-menubar-nav-menuitem-color\:hover: var(--theme-color-text);
    --theme-menubar-nav-menuitem-backgroundColor: var(--theme-color-accent);
    --theme-menubar-nav-submenu-backgroundColor\:hover: var(--theme-color-secondary);
    --theme-menubar-nav-submenu-menuitem-color: var(--theme-color-muted);
    --theme-menubar-nav-submenu-menuitem-color\:hover: var(--theme-color-text);
    --theme-menubar-nav-submenu-menuitem-borderColor\:active: var(--theme-color-text);
    --theme-menubar-mobile-icon-color: var(--theme-color-text);
    --theme-menubar-mobile-icon-color\:hover: var(--theme-color-text);
    --theme-menubar-mobile-icon-backgroundColor: var(--theme-color-accent);
    --theme-menubar-mobile-menu-backgroundColor: var(--theme-color-primary);
    --theme-menubar-toolbar-item-color: var(--theme-color-muted);
    --theme-menubar-toolbar-item-color\:hover: var(--theme-color-text);
    --theme-menubar-toolbar-item-backgroundColor\:hover: var(--theme-color-accent);
    --theme-menubar-user-menu-button-color: var(--theme-color-muted);
    --theme-menubar-user-menu-button-color\:hover: var(--theme-color-text);
    --theme-menubar-user-menu-panel-backgroundColor: var(--theme-color-primary);
    --theme-menubar-panel-borderColor: var(--theme-color-secondary);
    --theme-menubar-divider-borderColor: var(--theme-color-secondary);
}

.ae-menu-mobile {
    position: fixed;
    left: 0;
    width: 100%;
    height: 100vh;
    padding: 8px 16px;
    padding-top: 2em;
    padding-right: 0;
    background: var(--theme-menubar-mobile-menu-backgroundColor);
    display: none;
}

.ae-menu-mobile .main-navigation-mobile {
    height: 100%;
    padding-right: 16px;
    padding-bottom: 16px;
    overflow: auto;
    overscroll-behavior: contain;
}

.ae-menu-mobile .main-navigation-mobile::-webkit-scrollbar {
    width: 4px;
}

.ae-menu-mobile .main-navigation-mobile::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}

.ae-menu-mobile .main-navigation-mobile::-webkit-scrollbar-thumb {
    border-radius: 4px;
    background: rgba(255, 255, 255, 0.25);
}

.ae-menubar-accordion {
    position: relative;
    width: 100%;
    height: fit-content;
    transition: all 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
}

.ae-menubar-accordion > [role=menubar] {
    position: relative;
    width: 100%;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: flex-start;
    column-gap: 0;
    row-gap: 0.5em;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar-accordion > [role=menubar] .navigation-group {
    position: relative;
    width: 100%;
    margin-top: 1.25rem;
    color: var(--theme-menubar-nav-menuitem-color);
    font-size: 0.75em;
    font-weight: 700;
    text-rendering: optimizeLegibility;
    text-transform: uppercase;
    opacity: 0.5;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-start;
    align-items: center;
    column-gap: 0;
    row-gap: 0;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar-accordion > [role=menubar] .navigation-group:nth-child(1) {
    margin-top: 0;
}

.ae-menubar-accordion > [role=menubar] .wrapper {
    position: relative;
    width: 100%;
    height: fit-content;
}

.ae-menubar-accordion > [role=menubar] .wrapper > [role=menuitem] {
    min-height: 38px;
}

.ae-menubar-accordion > [role=menubar] [role=menuitem] {
    position: relative;
    padding: 0.5em;
    color: var(--theme-menubar-nav-menuitem-color);
    font-size: 0.875rem;
    font-weight: 400;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-start;
    align-items: center;
    column-gap: 0.5em;
    row-gap: 0;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
    cursor: pointer;
}

.ae-menubar-accordion > [role=menubar] [role=menuitem]:hover, .ae-menubar-accordion > [role=menubar] [role=menuitem][data-active=true] {
    border-radius: 4px;
    color: var(--theme-menubar-nav-menuitem-color\:hover);
    background: var(--theme-menubar-nav-menuitem-backgroundColor);
}

.ae-menubar-accordion > [role=menubar] [role=menuitem][aria-haspopup=true]::after {
    content: "\f078";
    position: absolute;
    top: 50%;
    right: calc(0.5em + 0.4375rem);
    transform-origin: center center;
    transform: translateY(-50%) rotate(-90deg);
    font: normal normal 900 1em/140% "Font Awesome 6 Free";
    font-size: 0.5em;
    transition: transform 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: center;
    column-gap: 0;
    row-gap: 0;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar-accordion > [role=menubar] [role=menuitem][aria-expanded=true]::after {
    transform: translateY(-50%) rotate(0deg);
}

.ae-menubar-accordion > [role=menubar] [role=menuitem] .label {
    padding-right: 0.75rem;
    word-break: break-word;
}

.ae-menubar-accordion > [role=menubar] [role=menuitem] .mb_icon {
    width: 1.15em;
    aspect-ratio: 1/1;
    font-size: 100%;
    text-align: center;
    vertical-align: middle;
}

.ae-menubar-accordion > [role=menubar] [role=menuitem] ~ .wrapper {
    position: relative;
    width: 100%;
    height: 0;
    overflow: hidden;
}

.ae-menubar-accordion > [role=menubar] [role=menuitem] ~ .wrapper .submenu[role=menu] {
    margin-top: 0.5em;
    padding-left: 0.5em;
    overflow: hidden;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: flex-start;
    align-items: flex-start;
    column-gap: 0;
    row-gap: 0.5em;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar-accordion > [role=menubar] [role=menuitem] ~ .wrapper .submenu[role=menu] [role=menuitem] {
    border-width: 1px;
    border-style: solid;
    border-color: transparent;
    border-radius: 4px;
    color: var(--theme-menubar-nav-submenu-menuitem-color);
}

.ae-menubar-accordion > [role=menubar] [role=menuitem] ~ .wrapper .submenu[role=menu] [role=menuitem]:hover {
    color: var(--theme-menubar-nav-submenu-menuitem-color\:hover);
    background: var(--theme-menubar-nav-submenu-backgroundColor\:hover);
}

.ae-menubar-accordion > [role=menubar] [role=menuitem] ~ .wrapper .submenu[role=menu] [role=menuitem][data-active=true] {
    outline: none;
    border-radius: 4px;
    color: var(--theme-menubar-nav-submenu-menuitem-color\:hover);
    background: var(--theme-menubar-nav-submenu-backgroundColor\:hover);
}

.ae-menubar[aria-orientation=vertical].collapsed .ae-menubar-accordion > [role=menubar] [role=menuitem][aria-haspopup=true]::after {
    display: none;
}

@media screen and (min-width: 768px) {
    .ae-menu-mobile {
        width: 260px;
    }
}

.slide-top-bouncy {
    animation: slide-top-bouncy 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) both;
}

@keyframes slide-top-bouncy {
    0% {
        transform: translateY(-120%);
        transform-origin: 50% 0%;
    }
    50% {
        transform: translateY(5%);
        transform-origin: 50% 0%;
    }
    100% {
        transform: translateY(0%);
        transform-origin: 50% 100%;
    }
}

.slide-right-bouncy {
    animation: slide-right-bouncy 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) both;
}

@keyframes slide-right-bouncy {
    0% {
        transform: translateX(120%);
        transform-origin: 50% 0%;
    }
    50% {
        transform: translateX(-5%);
        transform-origin: 50% 0%;
    }
    100% {
        transform: translateX(0%);
        transform-origin: 50% 100%;
    }
}

.slide-bottom-bouncy {
    animation: slide-bottom-bouncy 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) both;
}

@keyframes slide-bottom-bouncy {
    0% {
        transform: translateY(120%);
        transform-origin: 50% 0%;
    }
    50% {
        transform: translateY(-5%);
        transform-origin: 50% 0%;
    }
    100% {
        transform: translateY(0%);
        transform-origin: 50% 100%;
    }
}

.slide-left-bouncy {
    animation: slide-left-bouncy 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) both;
}

@keyframes slide-left-bouncy {
    0% {
        transform: translateX(-120%);
        transform-origin: 50% 0%;
    }
    50% {
        transform: translateX(5%);
        transform-origin: 50% 0%;
    }
    100% {
        transform: translateX(0%);
        transform-origin: 50% 100%;
    }
}

.slide-top {
    animation: slide-top 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) both;
}

@keyframes slide-top {
    0% {
        transform: translateY(-120%);
        transform-origin: 100% 0%;
    }
    100% {
        transform: translateY(0);
        transform-origin: 0% 50%;
    }
}

.slide-right {
    animation: slide-right 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) both;
}

@keyframes slide-right {
    0% {
        transform: translateX(120%);
        transform-origin: 100% 0%;
    }
    100% {
        transform: translateX(0);
        transform-origin: 0% 50%;
    }
}

.slide-bottom {
    animation: slide-bottom 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) both;
}

@keyframes slide-bottom {
    0% {
        transform: translateY(120%);
        transform-origin: 100% 0%;
    }
    100% {
        transform: translateY(0);
        transform-origin: 0% 50%;
    }
}

.slide-left {
    animation: slide-left 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) both;
}

@keyframes slide-left {
    0% {
        transform: translateX(-100%);
        transform-origin: 100% 0%;
    }
    100% {
        transform: translateX(0);
        transform-origin: 0% 50%;
    }
}

.reveal-opacity {
    animation: reveal-opacity 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) both;
}

@keyframes reveal-opacity {
    0% {
        filter: opacity(0);
    }
    100% {
        filter: opacity(1);
    }
}

.reveal-blur {
    animation: reveal-blur 0.5s linear both;
}

@keyframes reveal-blur {
    0% {
        filter: blur(100px);
    }
    100% {
        filter: blur(0px);
    }
}

.ae-menubar {
    position: relative;
    outline: none !important;
    font-family: sans-serif;
    font-size: 16px;
    background: var(--theme-color-primary);
    overflow: visible;
    display: flex;
}

.ae-menubar[aria-orientation=horizontal] {
    position: relative;
    top: 0;
    padding: 8px 16px;
    width: 100%;
    height: 64px;
    justify-content: space-between;
    box-shadow: 0 2px 6px var(--theme-menubar-global-boxShadowColor);
    z-index: 900;
}

.ae-menubar[aria-orientation=horizontal] > .container-row {
    width: 100%;
    flex-flow: row nowrap;
    justify-content: space-between;
    display: flex;
}

.ae-menubar[aria-orientation=horizontal] > .divider {
    border-color: var(--theme-menubar-divider-borderColor);
}

.ae-menubar[aria-orientation=horizontal] > .container-row > .wrapper, .ae-menubar[aria-orientation=horizontal] > .wrapper {
    width: auto;
    grid-template-columns: repeat(2, auto);
    grid-auto-flow: column;
    grid-gap: 2.5rem;
    justify-content: start;
    align-items: center;
    display: grid;
}

.ae-menubar[aria-orientation=horizontal] .logo {
    min-width: max-content;
}

.ae-menubar[aria-orientation=horizontal] .main-navigation [role=menuitem] {
    white-space: nowrap;
}

.ae-menubar.menubar.split {
    height: auto;
    min-height: 128px;
    flex-flow: column nowrap;
    row-gap: 0.5rem;
}

.ae-menubar[aria-orientation=vertical] {
    position: fixed;
    top: 0;
    left: 0;
    padding: 16px;
    padding-right: 0;
    width: 260px;
    height: 100vh;
    box-shadow: 2px 0 6px var(--theme-menubar-global-boxShadowColor);
    transition: width 150ms ease-out;
    flex-flow: column nowrap;
    row-gap: 2rem;
    overflow: hidden;
    z-index: 1001;
}

.ae-menubar[aria-orientation=vertical] > .wrapper-header {
    padding-right: 16px;
    color: var(--theme-menubar-global-color-text);
    height: 48px;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-between;
    align-items: center;
    column-gap: 0;
    row-gap: 0.5rem;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar[aria-orientation=vertical] > .wrapper-header #switch-menu-position {
    cursor: pointer;
}

.ae-menubar[aria-orientation=vertical] > .wrapper-user {
    position: relative;
    width: 100%;
    color: var(--theme-menubar-global-color-text);
}

.ae-menubar[aria-orientation=vertical] > .wrapper-user .user-info {
    position: relative;
    padding-right: 16px;
    font-size: 0.875em;
    cursor: pointer;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-start;
    align-items: center;
    column-gap: 0.5rem;
    row-gap: 0;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar[aria-orientation=vertical] > .wrapper-user .user-info .user.action-button {
    width: 35px;
    min-width: 35px;
    height: 35px;
}

.ae-menubar[aria-orientation=vertical] > .wrapper-user .user-info .user-name {
    font-size: 1.25em;
    font-weight: 700;
    line-height: 1em;
}

.ae-menubar[aria-orientation=vertical] > .wrapper-user .user-info .user-profile {
    font-size: 0.875em;
    font-weight: 400;
}

.ae-menubar[aria-orientation=vertical] > .wrapper-user .user-info[aria-expanded]::after {
    content: "\f078";
    position: absolute;
    top: 50%;
    right: 3em;
    transform-origin: center center;
    transform: translateY(-50%) rotate(-90deg);
    font: normal normal 900 1em/140% "Font Awesome 6 Free";
    font-size: 0.5em;
    transition: transform 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: center;
    column-gap: 0;
    row-gap: 0;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar[aria-orientation=vertical] > .wrapper-user .user-info[aria-expanded=true]::after {
    transform: translateY(-50%) rotate(0deg);
}

.ae-menubar[aria-orientation=vertical] > .wrapper-user .user-menu > .wrapper {
    height: 0px;
    overflow: hidden;
}

.ae-menubar[aria-orientation=vertical] > .wrapper-user .user-menu .section.logout .button {
    width: 100%;
    justify-content: flex-start;
}

.ae-menubar[aria-orientation=vertical] > .wrapper-navigation {
    padding-right: 16px;
    padding-bottom: 16px;
    overflow: auto;
    overscroll-behavior: contain;
}

.ae-menubar[aria-orientation=vertical] > .wrapper-navigation::-webkit-scrollbar {
    width: 4px;
}

.ae-menubar[aria-orientation=vertical] > .wrapper-navigation::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}

.ae-menubar[aria-orientation=vertical] > .wrapper-navigation::-webkit-scrollbar-thumb {
    border-radius: 4px;
    background: rgba(255, 255, 255, 0.25);
}

.ae-menubar.toolbar {
    width: -webkit-fill-available;
    width: -moz-available;
    width: fill-available;
    margin: 0.5rem;
    border-radius: 4px;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-end;
    align-items: center;
    column-gap: 0;
    row-gap: 0;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar.toolbar.compact > .wrapper {
    grid-template-columns: auto;
}

.ae-menubar .logo {
    position: relative;
    height: 100%;
    align-items: center;
    display: flex;
}

.ae-menubar .menu-mobile-control {
    width: 3rem;
    aspect-ratio: 1/1;
    font-size: 1.5rem;
    place-items: center;
    display: none;
}

.ae-menubar .menu-mobile-control:hover, .ae-menubar .menu-mobile-control[aria-pressed=true] {
    background: var(--theme-menubar-mobile-icon-backgroundColor);
    border-radius: 4px;
}

.ae-menubar .mb_icon-custom {
    position: relative;
    width: 1em;
    aspect-ratio: 1/1;
    overflow: hidden;
    flex-direction: column;
    display: flex;
}

.ae-menubar .mb_icon-custom.hamburger-menu > label {
    position: relative;
    width: 100%;
    height: 100%;
    flex-direction: column;
    justify-content: space-between;
    cursor: pointer;
    display: flex;
}

.ae-menubar .mb_icon-custom.hamburger-menu input[type=checkbox] {
    display: none;
}

.ae-menubar .mb_icon-custom.hamburger-menu span {
    width: 100%;
    height: 20%;
    border-radius: 4px;
    background: var(--theme-menubar-mobile-icon-color);
    transition: all 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
}

.ae-menubar .mb_icon-custom.hamburger-menu input[type=checkbox]:checked ~ span:nth-of-type(1) {
    transform: rotate(45deg);
    transform-origin: 0% 150%;
}

.ae-menubar .mb_icon-custom.hamburger-menu input[type=checkbox]:checked ~ span:nth-of-type(2) {
    transform: rotate(-45deg);
}

.ae-menubar .mb_icon-custom.hamburger-menu input[type=checkbox]:checked ~ span:nth-of-type(3) {
    transform: translateY(1em);
}

.ae-menubar .main-navigation [role=menuitem] .submenu[role=menu] {
    position: absolute;
    top: 100%;
    left: -0.5em;
    width: max-content;
    padding: 0.5em;
    background: var(--theme-color-primary);
    border-radius: 4px;
    box-shadow: 0 2px 6px var(--theme-menubar-global-boxShadowColor);
    display: none;
}

.ae-menubar .main-navigation [role=menuitem] .submenu[role=menu] .wrapper {
    margin-bottom: 0.5em;
}

.ae-menubar .main-navigation [role=menuitem] .submenu[role=menu] .wrapper:last-child {
    margin-bottom: 0;
}

.ae-menubar .main-navigation [role=menuitem] .submenu[role=menu] [role=menuitem] {
    border-width: 1px;
    border-style: solid;
    border-color: transparent;
    color: var(--theme-menubar-nav-submenu-menuitem-color);
}

.ae-menubar .main-navigation [role=menuitem] .submenu[role=menu] [role=menuitem]:hover, .ae-menubar .main-navigation [role=menuitem] .submenu[role=menu] [role=menuitem]:focus-visible, .ae-menubar .main-navigation [role=menuitem] .submenu[role=menu] [role=menuitem][data-active=true] {
    outline: none;
    border-radius: 4px;
    color: var(--theme-menubar-nav-submenu-menuitem-color\:hover);
    background: var(--theme-menubar-nav-submenu-backgroundColor\:hover);
}

.ae-menubar .main-navigation [role=menuitem] .submenu[role=menu] [role=menuitem][aria-haspopup=true]::after {
    position: absolute;
    top: 50%;
    right: 0.5em;
    transform: translateY(-50%) rotate(-90deg);
}

.ae-menubar .main-navigation [role=menuitem] .submenu[role=menu] [role=menuitem][aria-haspopup=true] > .label {
    margin-right: calc(0.5em + 4px);
}

.ae-menubar .main-navigation {
    position: relative;
    width: fit-content;
    height: fit-content;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-start;
    align-items: center;
    column-gap: 0;
    row-gap: 0;
    flex-grow: 1;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar .main-navigation [role=menubar] {
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: center;
    column-gap: 1em;
    row-gap: 1em;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar .main-navigation [role=menubar] .wrapper {
    position: relative;
    width: 100%;
    height: fit-content;
}

.ae-menubar .main-navigation [role=menuitem] {
    position: relative;
    padding: 0.5em;
    color: var(--theme-menubar-nav-menuitem-color);
    font-size: 0.875rem;
    font-weight: 400;
    cursor: pointer;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-start;
    align-items: center;
    column-gap: 0.5em;
    row-gap: 0;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar .main-navigation [role=menuitem]:hover, .ae-menubar .main-navigation [role=menuitem][data-active=true], .ae-menubar .main-navigation [role=menuitem]:focus-visible {
    outline: none;
    border-radius: 4px;
    color: var(--theme-menubar-nav-menuitem-color\:hover);
    background: var(--theme-menubar-nav-menuitem-backgroundColor);
}

.ae-menubar .main-navigation [role=menuitem][aria-haspopup=true]::after {
    content: "\f078";
    position: relative;
    font: normal normal 900 1em/140% "Font Awesome 6 Free";
    font-size: 0.5em;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: center;
    column-gap: 0;
    row-gap: 0;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar .main-navigation [role=menuitem] .mb_icon {
    width: 1.15em;
    aspect-ratio: 1/1;
    font-size: 100%;
    text-align: center;
    vertical-align: middle;
}

.ae-menubar .main-navigation [role=menuitem]:hover > .submenu {
    display: block;
}

.ae-menubar .main-navigation [role=menuitem] .submenu[role=menu] .submenu[role=menu] {
    top: -0.5em;
    left: 100%;
}

.ae-menubar .toolbar {
    position: relative;
    width: fit-content;
    height: fit-content;
    font-size: 1.5em;
    color: var(--theme-menubar-toolbar-item-color);
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-end;
    align-items: center;
    column-gap: 0;
    row-gap: 0;
    flex-grow: 1;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar .toolbar .group {
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: center;
    column-gap: 8px;
    row-gap: 0;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar .ae-menu-mobile .toolbar {
    width: 100%;
    margin-bottom: 1em;
}

.ae-menubar .ae-menu-mobile .toolbar .group {
    width: 100%;
    flex-wrap: wrap;
    justify-content: space-between;
}

.ae-menubar .user {
    position: relative;
    width: 40px;
    min-width: 40px;
    height: 40px;
    border: 2px solid var(--theme-menubar-user-menu-button-color);
    border-radius: 50%;
    color: var(--theme-menubar-user-menu-button-color);
    background: transparent;
    overflow: hidden;
}

.ae-menubar .user > .image {
    width: 100%;
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: contain;
}

.ae-menubar .user > .mb_icon {
    position: relative;
    top: 0;
    font-size: 2.15em;
    text-align: center;
    transition: top 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
}

.ae-menubar .user > .mb_icon::before {
    vertical-align: sub;
    display: inline-block;
}

.ae-menubar .user:hover:not(#user-avatar), .ae-menubar .user:focus-visible, .ae-menubar .user[aria-expanded=true] {
    outline: none;
    color: var(--theme-menubar-user-menu-button-color\:hover);
}

.ae-menubar .user:hover:not(#user-avatar) > .mb_icon, .ae-menubar .user:focus-visible > .mb_icon, .ae-menubar .user[aria-expanded=true] > .mb_icon {
    top: -4px;
}

.ae-menubar .mb_icon {
    display: block;
}

.ae-menubar .panel {
    position: absolute;
    width: fit-content;
    height: fit-content;
    border: 1px solid var(--theme-menubar-panel-borderColor);
    border-radius: 4px;
    color: var(--theme-menubar-nav-menuitem-color);
    background: var(--theme-menubar-user-menu-panel-backgroundColor);
    box-shadow: 0 2px 6px var(--theme-menubar-global-boxShadowColor);
    visibility: hidden;
}

.ae-menubar .panel::-webkit-scrollbar {
    width: 4px;
}

.ae-menubar .panel::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}

.ae-menubar .panel::-webkit-scrollbar-thumb {
    border-radius: 4px;
    background: rgba(255, 255, 255, 0.25);
}

.ae-menubar .panel.slide-right-top {
    animation: slide-right-top 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) both;
    transform-origin: 100% 0;
}

.ae-menubar .panel > .section {
    padding: 0.5rem 0.75rem;
}

.ae-menubar .panel > .section .button {
    width: 100%;
    padding: 0.5em;
    border-radius: 4px;
    color: var(--theme-menubar-nav-menuitem-color);
    font-size: 0.875em;
    font-weight: 400;
    text-align: center;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: center;
    column-gap: 0.5em;
    row-gap: 0;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
    cursor: pointer;
}

.ae-menubar .panel > .section .button:hover {
    color: var(--theme-menubar-nav-menuitem-color\:hover);
    background: var(--theme-menubar-nav-menuitem-backgroundColor);
}

@keyframes slide-right-top {
    0% {
        transform: scale(0.5);
        filter: opacity(0);
    }
    100% {
        transform: scale(1);
        filter: opacity(1);
    }
}

.ae-menubar #user-panel {
    min-width: 200px;
}

.ae-menubar #user-panel .user-info {
    margin-left: 0;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-start;
    align-items: center;
    column-gap: 0.5em;
    row-gap: 0;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar #user-panel .user-info .user-name {
    font-size: 1.25em;
    font-weight: 700;
}

.ae-menubar #user-panel .user-info .user-profile {
    font-size: 0.875em;
    font-weight: 400;
}

.ae-menubar #user-panel [role=menubar] {
    row-gap: 0;
    flex-direction: column;
}

.ae-menubar #themes-panel,
.ae-menubar #shortcuts-panel {
    max-height: 360px;
    overflow: auto;
}

.ae-menubar #themes-panel #themes-list > .theme-name a,
.ae-menubar #shortcuts-panel #themes-list > .theme-name a {
    padding: 0.875em;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: center;
    column-gap: 0.5em;
    row-gap: 0;
    flex-grow: 1;
    flex-shrink: 0;
    display: flex;
}
.ae-menubar #themes-panel #themes-list > .theme-name.button,
.ae-menubar #shortcuts-panel #themes-list > .theme-name.button {
    padding: 0;
}

.ae-menubar #themes-panel #themes-list > .theme-name a .group,
.ae-menubar #shortcuts-panel #themes-list > .theme-name a .group {
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-start;
    align-items: center;
    column-gap: 1px;
    row-gap: 0;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
}

.ae-menubar #themes-panel #themes-list > .theme-name a .group span,
.ae-menubar #shortcuts-panel #themes-list > .theme-name a .group span {
    width: 1.25rem;
    height: 1.25rem;
    margin: 1px;
    border: 2px solid var(--theme-menubar-panel-borderColor);
    border-radius: 50%;
    background: white;
}

.ae-menubar #themes-panel #themes-list > .theme-name a .group span:nth-child(1),
.ae-menubar #shortcuts-panel #themes-list > .theme-name a .group span:nth-child(1) {
    z-index: 4;
}

.ae-menubar #themes-panel #themes-list > .theme-name a .group span:nth-child(2),
.ae-menubar #shortcuts-panel #themes-list > .theme-name a .group span:nth-child(2) {
    z-index: 3;
}

.ae-menubar #themes-panel #themes-list > .theme-name a .group span:nth-child(3),
.ae-menubar #shortcuts-panel #themes-list > .theme-name a .group span:nth-child(3) {
    z-index: 2;
}

.ae-menubar #shortcuts-panel #shortcuts-list {
    min-width: 250px;
    max-width: 390px;
}

.ae-menubar #shortcuts-panel #shortcuts-list > .list-item {
    width: 100%;
    margin-bottom: 0.5rem;
    border-radius: 0.25rem;
    color: var(--theme-menubar-nav-submenu-menuitem-color\:hover);
    background: var(--theme-menubar-nav-submenu-backgroundColor\:hover);
}

.ae-menubar #shortcuts-panel #shortcuts-list > .list-item:last-child {
    margin-bottom: 0;
}

.ae-menubar #shortcuts-panel #shortcuts-list > .list-item:hover {
    background: var(--theme-menubar-nav-menuitem-backgroundColor);
}

.ae-menubar #shortcuts-panel #shortcuts-list > .list-item > a {
    padding: 0.75rem;
    color: inherit;
    display: block;
}

.ae-menubar #shortcuts-panel #shortcuts-list > .list-item .shortcut-title {
    font-size: 1rem;
}

.ae-menubar #shortcuts-panel #shortcuts-list > .list-item .shortcut-description {
    font-size: 0.75rem;
}

.ae-menubar #shortcuts-panel #shortcuts-list > .list-item .shortcut-title,
.ae-menubar #shortcuts-panel #shortcuts-list > .list-item .shortcut-description {
    word-break: break-all;
}

.ae-menubar #shortcuts-panel #shortcuts-list.column {
    flex-flow: row wrap;
    column-gap: 0.5rem;
    row-gap: 0.5rem;
    display: flex;
}

.ae-menubar #shortcuts-panel #shortcuts-list.column > .list-item {
    width: 48%;
    margin: 0;
    flex-grow: 1;
}

.ae-menubar #search-panel {
    width: 600px;
    height: fit-content;
    max-height: 550px;
    overflow: auto;
}

.ae-menubar #search-panel > #search {
    position: sticky;
    top: 0;
    left: 0;
    font-size: 1.15rem;
    background: var(--theme-menubar-user-menu-panel-backgroundColor);
    flex-flow: row nowrap;
    justify-content: center;
    align-items: center;
    display: flex;
    z-index: 1;
}

.ae-menubar #search-panel > #search input[type=text] {
    width: 100%;
    border: none;
    border-bottom: 1px solid var(--theme-menubar-divider-borderColor);
    color: var(--theme-menubar-global-color-text);
    background: transparent;
}

.ae-menubar #search-panel > #search input[type=text]:focus-visible {
    outline-style: none;
}

.ae-menubar #search-panel > #search > a[data-close] {
    position: relative;
    top: -14px;
    color: inherit;
    flex-flow: row nowrap;
    justify-content: space-between;
    align-items: center;
    column-gap: 0.5rem;
    display: flex;
}

.ae-menubar #search-panel > #search > a[data-close] > .text {
    font-size: 0.75rem;
    opacity: 0.5;
}

.ae-menubar #search-panel > #search-result {
    padding-left: 2rem;
}

.ae-menubar #search-panel > #search-result .result-title {
    font-size: 0.75rem;
    text-transform: uppercase;
}

.ae-menubar #search-panel > #search-result .result-links {
    color: var(--theme-menubar-global-color-text);
}

.ae-menubar #search-panel > #search-result .result-links > .result-item {
    width: 100%;
    border-radius: 0.25rem;
    transition: padding 250ms ease-out;
}

.ae-menubar #search-panel > #search-result .result-links > .result-item:hover {
    padding-left: 0.5rem;
    background: var(--theme-menubar-nav-menuitem-backgroundColor);
}

.ae-menubar #search-panel > #search-result .result-links > .result-item:hover i:last-child {
    visibility: visible;
}

.ae-menubar #search-panel > #search-result .result-links > .result-item a {
    width: 100%;
    padding: 0.5rem 0.5rem 0.5rem 0;
    color: inherit;
    word-break: break-all;
    flex-flow: row nowrap;
    justify-content: flex-start;
    align-items: center;
    column-gap: 0.5rem;
    display: flex;
}

@media only screen and (max-width: 1188px) {
    .ae-menubar .panel:not(#themes-panel, #user-panel) {
        width: 100% !important;
        max-width: 100% !important;
        left: 0 !important;
        border-radius: 0 !important;
    }
    .ae-menubar #shortcuts-list {
        max-width: 100% !important;
    }
}

.ae-menubar .button {
    padding: 0.5em;
    border-radius: 4px;
    color: var(--theme-menubar-nav-menuitem-color);
    font-size: 0.875em;
    font-weight: 400;
    text-align: center;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: center;
    column-gap: 0.5em;
    row-gap: 0;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
    cursor: pointer;
}

.ae-menubar .button a {
    color: inherit;
}

.ae-menubar .button.text-left {
    justify-content: flex-start;
}

.ae-menubar .button:hover, .ae-menubar .button[aria-expanded=true], .ae-menubar .button:focus-visible, .ae-menubar .button.active {
    outline: none;
    color: var(--theme-menubar-nav-menuitem-color\:hover);
    background: var(--theme-menubar-nav-menuitem-backgroundColor);
}

.ae-menubar .divider-theme-color {
    border-color: var(--theme-menubar-divider-borderColor);
}

html[dir=RTL] .ae-menubar .main-navigation [role=menuitem] .submenu[role=menu] .submenu[role=menu] {
    top: -0.5em;
    left: auto;
    right: 100%;
}

html[dir=RTL] .ae-menubar .main-navigation [role=menuitem] .submenu[role=menu] [role=menuitem][aria-haspopup=true]::after {
    position: relative;
    top: auto;
    transform: translateY(3%) rotate(90deg);
}

html[dir=RTL] .ae-menubar .main-navigation [role=menuitem] .submenu[role=menu] [role=menuitem][aria-haspopup=true] > .label {
    margin-right: 0;
}

html[dir=RTL] .ae-menubar .ae-menubar-accordion > [role=menubar] [role=menuitem][aria-haspopup=true]::after {
    position: relative;
    top: auto;
    transform: translateY(0%) rotate(90deg);
}

html[dir=RTL] .ae-menubar .ae-menubar-accordion > [role=menubar] [role=menuitem][aria-expanded=true]::after {
    transform: translateY(0%) rotate(0deg);
}

html[dir=RTL] .ae-menubar[aria-orientation=vertical],
html[dir=RTL] .ae-menubar .ae-menu-mobile {
    right: 0;
    left: auto;
}

html[dir=RTL] .ae-menubar[aria-orientation=vertical] > .wrapper-user .user-info[aria-expanded=false]::after,
html[dir=RTL] .ae-menubar[aria-orientation=vertical] > .wrapper-user .user-info[aria-expanded=true]::after {
    position: relative;
}

html[dir=RTL] .ae-menubar[aria-orientation=vertical] > .wrapper-user .user-info[aria-expanded=false]::after {
    transform: translateY(-50%) rotate(90deg);
}

html[dir=RTL] .ae-menubar[aria-orientation=vertical] > .wrapper-user .user-info[aria-expanded=true]::after {
    transform: translateY(-50%) rotate(0deg);
}

/**
 * * Expande o CSS Remedy (reset CSS) da Jen Simmons.
 * * Versão: 1.0.0
 * * Atualizado em: 23/03/2023
 * * Autor: Black thiago@netmake.com.br
 * * URL: https://github.com/jensimmons/cssremedy
 * * Ferramentas de apoio:
 * *     - Contrast checker: https://contrastchecker.com/
 * *     - Shade generator: https://maketintsandshades.com/
 * */
/* @docs
label: Core Remedies
version: 0.1.0-beta.2

note: |
  These remedies are recommended
  as a starter for any project.

category: file
*/
/* @docs
label: Box Sizing

note: |
  Use border-box by default, globally.

category: global
*/
*, ::before, ::after { box-sizing: border-box; }
/* @docs
label: Line Sizing

note: |
  Consistent line-spacing,
  even when inline elements have different line-heights.

links:
  - https://drafts.csswg.org/css-inline-3/#line-sizing-property

category: global
*/
html { line-sizing: normal; }
/* @docs
label: Body Margins

note: |
  Remove the tiny space around the edge of the page.

category: global
*/
body { margin: 0; }
/* @docs
label: Heading Sizes

note: |
  Switch to rem units for headings

category: typography
*/
h1 { font-size: 2rem; }
h2 { font-size: 1.5rem; }
h3 { font-size: 1.17rem; }
h4 { font-size: 1.00rem; }
h5 { font-size: 0.83rem; }
h6 { font-size: 0.67rem; }
/* @docs
label: H1 Margins

note: |
  Keep h1 margins consistent, even when nested.

category: typography
*/
h1 { margin: 0.67em 0; }
/* @docs
label: Pre Wrapping

note: |
  Overflow by default is bad...

category: typography
*/
pre { white-space: pre-wrap; }
/* @docs
label: Horizontal Rule

note: |
  1. Solid, thin horizontal rules
  2. Remove Firefox `color: gray`
  3. Remove default `1px` height, and common `overflow: hidden`

category: typography
*/
hr {
    border-style: solid;
    border-width: 1px 0 0;
    color: inherit;
    height: 0;
    overflow: visible;
}
/* @docs
label: Responsive Embeds

note: |
  1. Block display is usually what we want
  2. Remove strange space-below when inline
  3. Responsive by default

category: embedded elements
*/
img, svg, video, canvas, audio, iframe, embed, object {
    display: block;
    vertical-align: middle;
    max-width: 100%;
}
/* @docs
label: Aspect Ratios

note: |
  Maintain intrinsic aspect ratios when `max-width` is applied.
  `iframe`, `embed`, and `object` are also embedded,
  but have no intrinsic ratio,
  so their `height` needs to be set explicitly.

category: embedded elements
*/
img, svg, video, canvas {
    height: auto;
}
/* @docs
label: Audio Width

note: |
  There is no good reason elements default to 300px,
  and audio files are unlikely to come with a width attribute.

category: embedded elements
*/
audio { width: 100%; }
/* @docs
label: Image Borders

note: |
  Remove the border on images inside links in IE 10 and earlier.

category: legacy browsers
*/
img { border-style: none; }
/* @docs
label: SVG Overflow

note: |
  Hide the overflow in IE 10 and earlier.

category: legacy browsers
*/
svg { overflow: hidden; }
/* @docs
label: HTML5 Elements

note: |
  Default block display on HTML5 elements

category: legacy browsers
*/
article, aside, figcaption, figure, footer, header, hgroup, main, nav, section {
    display: block;
}
/* @docs
label: Checkbox & Radio Inputs

note: |
  1. Add the correct box sizing in IE 10
  2. Remove the padding in IE 10

category: legacy browsers
*/
[type='checkbox'],
[type='radio'] {
    box-sizing: border-box;
    padding: 0;
}
/* @docs
label: Reminders
version: 0.1.0-beta.2

note: |
  All the remedies in this file are commented out by default,
  because they could cause harm as general defaults.
  These should be used as reminders
  to handle common styling issues
  in a way that will work for your project and users.
  Read, explore, uncomment, and edit as needed.

category: file
*/
/* @docs
label: List Style

note: |
  List styling is not usually desired in navigation,
  but this also removes list-semantics for screen-readers

links:
  - https://github.com/mozdevs/cssremedy/issues/15

category: navigation
*/
nav ul {
    list-style: none;
}
/* @docs
label: List Voiceover

note: |
  1. Add zero-width-space to prevent VoiceOver disable
  2. Absolute position ensures no extra space

links:
  - https://unfetteredthoughts.net/2017/09/26/voiceover-and-list-style-type-none/

category: navigation
*/
nav li:before {
    content: "\200B";
    position: absolute;
}
/* @docs
label: Reduced Motion

note: |
  1. Immediately jump any animation to the end point
  2. Remove transitions & fixed background attachment

links:
  - https://github.com/mozdevs/cssremedy/issues/11

category: accessibility
*/
@media (prefers-reduced-motion: reduce) {
    *, ::before, ::after {
        animation-delay: -1s !important;
        animation-duration: 1s !important;
        animation-iteration-count: 1 !important;
        background-attachment: initial !important;
        scroll-behavior: auto !important;
        transition-duration: 0s !important;
    }
}
/* @docs
label: Line Heights

note: |
  The default `normal` line-height is tightly spaced,
  but takes font-metrics into account,
  which is important for many fonts.
  Looser spacing may improve readability in latin type,
  but may cause problems in some scripts --
  from cusrive/fantasy fonts to
  [Javanese](https://jsbin.com/bezasax/1/edit?html,css,output),
  [Persian](https://jsbin.com/qurecom/edit?html,css,output),
  and CJK languages.

links:
  - https://github.com/mozdevs/cssremedy/issues/7
  - https://jsbin.com/bezasax/1/edit?html,css,output
  - https://jsbin.com/qurecom/edit?html,css,output

todo: |
  - Use `:lang(language-code)` selectors?
  - Add typography remedies for other scripts & languages...

category: typography
*/
html { line-height: 1.5; }
h1, h2, h3, h4, h5, h6 { line-height: 1.25; }
caption, figcaption, label, legend { line-height: 1.375; }
/* @docs
label: Quotes
version: 0.1.0-beta.2

note: |
  This is what user agents are supposed to be doing for quotes,
  according to https://html.spec.whatwg.org/multipage/rendering.html#quotes

links:
  - https://html.spec.whatwg.org/multipage/rendering.html#quotes

todo: |
  I believe

  ```css
  :root:lang(af),       :not(:lang(af)) > :lang(af)             { quotes: '\201c' '\201d' '\2018' '\2019' }
  :root:lang(ak),       :not(:lang(ak)) > :lang(ak)             { quotes: '\201c' '\201d' '\2018' '\2019' }
  :root:lang(asa),      :not(:lang(asa)) > :lang(asa)           { quotes: '\201c' '\201d' '\2018' '\2019' }
  ```

  can be replaced by

  ```css
  :root:lang(af, ak, asa), [lang]:lang(af, ak, asa)       			{ quotes: '\201c' '\201d' '\2018' '\2019' }
  ```

category: file
*/
:root                                                         { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(af),       :not(:lang(af)) > :lang(af)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ak),       :not(:lang(ak)) > :lang(ak)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(asa),      :not(:lang(asa)) > :lang(asa)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(az),       :not(:lang(az)) > :lang(az)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(bem),      :not(:lang(bem)) > :lang(bem)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(bez),      :not(:lang(bez)) > :lang(bez)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(bn),       :not(:lang(bn)) > :lang(bn)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(brx),      :not(:lang(brx)) > :lang(brx)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(cgg),      :not(:lang(cgg)) > :lang(cgg)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(chr),      :not(:lang(chr)) > :lang(chr)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(cy),       :not(:lang(cy)) > :lang(cy)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(da),       :not(:lang(da)) > :lang(da)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(dav),      :not(:lang(dav)) > :lang(dav)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(dje),      :not(:lang(dje)) > :lang(dje)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(dz),       :not(:lang(dz)) > :lang(dz)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ebu),      :not(:lang(ebu)) > :lang(ebu)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ee),       :not(:lang(ee)) > :lang(ee)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(en),       :not(:lang(en)) > :lang(en)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(fil),      :not(:lang(fil)) > :lang(fil)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(fo),       :not(:lang(fo)) > :lang(fo)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ga),       :not(:lang(ga)) > :lang(ga)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(gd),       :not(:lang(gd)) > :lang(gd)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(gl),       :not(:lang(gl)) > :lang(gl)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(gu),       :not(:lang(gu)) > :lang(gu)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(guz),      :not(:lang(guz)) > :lang(guz)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ha),       :not(:lang(ha)) > :lang(ha)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(hi),       :not(:lang(hi)) > :lang(hi)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(id),       :not(:lang(id)) > :lang(id)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ig),       :not(:lang(ig)) > :lang(ig)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(jmc),      :not(:lang(jmc)) > :lang(jmc)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(kam),      :not(:lang(kam)) > :lang(kam)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(kde),      :not(:lang(kde)) > :lang(kde)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(kea),      :not(:lang(kea)) > :lang(kea)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(khq),      :not(:lang(khq)) > :lang(khq)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ki),       :not(:lang(ki)) > :lang(ki)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(kln),      :not(:lang(kln)) > :lang(kln)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(km),       :not(:lang(km)) > :lang(km)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(kn),       :not(:lang(kn)) > :lang(kn)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ko),       :not(:lang(ko)) > :lang(ko)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ksb),      :not(:lang(ksb)) > :lang(ksb)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(lg),       :not(:lang(lg)) > :lang(lg)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ln),       :not(:lang(ln)) > :lang(ln)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(lo),       :not(:lang(lo)) > :lang(lo)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(lrc),      :not(:lang(lrc)) > :lang(lrc)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(lu),       :not(:lang(lu)) > :lang(lu)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(luo),      :not(:lang(luo)) > :lang(luo)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(lv),       :not(:lang(lv)) > :lang(lv)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(mas),      :not(:lang(mas)) > :lang(mas)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(mer),      :not(:lang(mer)) > :lang(mer)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(mfe),      :not(:lang(mfe)) > :lang(mfe)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(mgo),      :not(:lang(mgo)) > :lang(mgo)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ml),       :not(:lang(ml)) > :lang(ml)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(mn),       :not(:lang(mn)) > :lang(mn)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(mr),       :not(:lang(mr)) > :lang(mr)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ms),       :not(:lang(ms)) > :lang(ms)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(mt),       :not(:lang(mt)) > :lang(mt)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(my),       :not(:lang(my)) > :lang(my)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(naq),      :not(:lang(naq)) > :lang(naq)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(nd),       :not(:lang(nd)) > :lang(nd)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ne),       :not(:lang(ne)) > :lang(ne)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(nus),      :not(:lang(nus)) > :lang(nus)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(nyn),      :not(:lang(nyn)) > :lang(nyn)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(pa),       :not(:lang(pa)) > :lang(pa)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(pt),       :not(:lang(pt)) > :lang(pt)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(rof),      :not(:lang(rof)) > :lang(rof)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(rwk),      :not(:lang(rwk)) > :lang(rwk)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(saq),      :not(:lang(saq)) > :lang(saq)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(sbp),      :not(:lang(sbp)) > :lang(sbp)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(seh),      :not(:lang(seh)) > :lang(seh)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ses),      :not(:lang(ses)) > :lang(ses)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(si),       :not(:lang(si)) > :lang(si)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(so),       :not(:lang(so)) > :lang(so)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(sw),       :not(:lang(sw)) > :lang(sw)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(ta),       :not(:lang(ta)) > :lang(ta)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(te),       :not(:lang(te)) > :lang(te)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(teo),      :not(:lang(teo)) > :lang(teo)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(th),       :not(:lang(th)) > :lang(th)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(to),       :not(:lang(to)) > :lang(to)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(tr),       :not(:lang(tr)) > :lang(tr)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(twq),      :not(:lang(twq)) > :lang(twq)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(tzm),      :not(:lang(tzm)) > :lang(tzm)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(uz-Cyrl),  :not(:lang(uz-Cyrl)) > :lang(uz-Cyrl)   { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(vai),      :not(:lang(vai)) > :lang(vai)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(vai-Latn), :not(:lang(vai-Latn)) > :lang(vai-Latn) { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(vi),       :not(:lang(vi)) > :lang(vi)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(vun),      :not(:lang(vun)) > :lang(vun)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(xog),      :not(:lang(xog)) > :lang(xog)           { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(yo),       :not(:lang(yo)) > :lang(yo)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(yue-Hans), :not(:lang(yue-Hans)) > :lang(yue-Hans) { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(zh),       :not(:lang(zh)) > :lang(zh)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(zu),       :not(:lang(zu)) > :lang(zu)             { quotes: '\201c' '\201d' '\2018' '\2019' }
/* “ ” ‘ ’ */
:root:lang(uz),       :not(:lang(uz)) > :lang(uz)             { quotes: '\201c' '\201d' '\2019' '\2018' }
/* “ ” ’ ‘ */
:root:lang(eu),       :not(:lang(eu)) > :lang(eu)             { quotes: '\201c' '\201d' '\201c' '\201d' }
/* “ ” “ ” */
:root:lang(tk),       :not(:lang(tk)) > :lang(tk)             { quotes: '\201c' '\201d' '\201c' '\201d' }
/* “ ” “ ” */
:root:lang(ar),       :not(:lang(ar)) > :lang(ar)             { quotes: '\201d' '\201c' '\2019' '\2018' }
/* ” “ ’ ‘ */
:root:lang(ur),       :not(:lang(ur)) > :lang(ur)             { quotes: '\201d' '\201c' '\2019' '\2018' }
/* ” “ ’ ‘ */
:root:lang(fi),       :not(:lang(fi)) > :lang(fi)             { quotes: '\201d' '\201d' '\2019' '\2019' }
/* ” ” ’ ’ */
:root:lang(he),       :not(:lang(he)) > :lang(he)             { quotes: '\201d' '\201d' '\2019' '\2019' }
/* ” ” ’ ’ */
:root:lang(lag),      :not(:lang(lag)) > :lang(lag)           { quotes: '\201d' '\201d' '\2019' '\2019' }
/* ” ” ’ ’ */
:root:lang(rn),       :not(:lang(rn)) > :lang(rn)             { quotes: '\201d' '\201d' '\2019' '\2019' }
/* ” ” ’ ’ */
:root:lang(sn),       :not(:lang(sn)) > :lang(sn)             { quotes: '\201d' '\201d' '\2019' '\2019' }
/* ” ” ’ ’ */
:root:lang(sv),       :not(:lang(sv)) > :lang(sv)             { quotes: '\201d' '\201d' '\2019' '\2019' }
/* ” ” ’ ’ */
:root:lang(sr),       :not(:lang(sr)) > :lang(sr)             { quotes: '\201e' '\201c' '\2018' '\2018' }
/* „ “ ‘ ‘ */
:root:lang(sr-Latn),  :not(:lang(sr-Latn)) > :lang(sr-Latn)   { quotes: '\201e' '\201c' '\2018' '\2018' }
/* „ “ ‘ ‘ */
:root:lang(bg),       :not(:lang(bg)) > :lang(bg)             { quotes: '\201e' '\201c' '\201e' '\201c' }
/* „ “ „ “ */
:root:lang(lt),       :not(:lang(lt)) > :lang(lt)             { quotes: '\201e' '\201c' '\201e' '\201c' }
/* „ “ „ “ */
:root:lang(bs-Cyrl),  :not(:lang(bs-Cyrl)) > :lang(bs-Cyrl)   { quotes: '\201e' '\201c' '\201a' '\2018' }
/* „ “ ‚ ‘ */
:root:lang(cs),       :not(:lang(cs)) > :lang(cs)             { quotes: '\201e' '\201c' '\201a' '\2018' }
/* „ “ ‚ ‘ */
:root:lang(cs),       :not(:lang(cs)) > :lang(cs)             { quotes: '\201e' '\201c' '\201a' '\2018' }
/* „ “ ‚ ‘ */
:root:lang(de),       :not(:lang(de)) > :lang(de)             { quotes: '\201e' '\201c' '\201a' '\2018' }
/* „ “ ‚ ‘ */
:root:lang(dsb),      :not(:lang(dsb)) > :lang(dsb)           { quotes: '\201e' '\201c' '\201a' '\2018' }
/* „ “ ‚ ‘ */
:root:lang(et),       :not(:lang(et)) > :lang(et)             { quotes: '\201e' '\201c' '\201a' '\2018' }
/* „ “ ‚ ‘ */
:root:lang(hr),       :not(:lang(hr)) > :lang(hr)             { quotes: '\201e' '\201c' '\201a' '\2018' }
/* „ “ ‚ ‘ */
:root:lang(hsb),      :not(:lang(hsb)) > :lang(hsb)           { quotes: '\201e' '\201c' '\201a' '\2018' }
/* „ “ ‚ ‘ */
:root:lang(is),       :not(:lang(is)) > :lang(is)             { quotes: '\201e' '\201c' '\201a' '\2018' }
/* „ “ ‚ ‘ */
:root:lang(lb),       :not(:lang(lb)) > :lang(lb)             { quotes: '\201e' '\201c' '\201a' '\2018' }
/* „ “ ‚ ‘ */
:root:lang(luy),      :not(:lang(luy)) > :lang(luy)           { quotes: '\201e' '\201c' '\201a' '\2018' }
/* „ “ ‚ ‘ */
:root:lang(mk),       :not(:lang(mk)) > :lang(mk)             { quotes: '\201e' '\201c' '\201a' '\2018' }
/* „ “ ‚ ‘ */
:root:lang(sk),       :not(:lang(sk)) > :lang(sk)             { quotes: '\201e' '\201c' '\201a' '\2018' }
/* „ “ ‚ ‘ */
:root:lang(sl),       :not(:lang(sl)) > :lang(sl)             { quotes: '\201e' '\201c' '\201a' '\2018' }
/* „ “ ‚ ‘ */
:root:lang(ka),       :not(:lang(ka)) > :lang(ka)             { quotes: '\201e' '\201c' '\00ab' '\00bb' }
/* „ “ « » */
:root:lang(bs),       :not(:lang(bs)) > :lang(bs)             { quotes: '\201e' '\201d' '\2018' '\2019' }
/* „ ” ‘ ’ */
:root:lang(agq),      :not(:lang(agq)) > :lang(agq)           { quotes: '\201e' '\201d' '\201a' '\2019' }
/* „ ” ‚ ’ */
:root:lang(ff),       :not(:lang(ff)) > :lang(ff)             { quotes: '\201e' '\201d' '\201a' '\2019' }
/* „ ” ‚ ’ */
:root:lang(nmg),      :not(:lang(nmg)) > :lang(nmg)           { quotes: '\201e' '\201d' '\00ab' '\00bb' }
/* „ ” « » */
:root:lang(ro),       :not(:lang(ro)) > :lang(ro)             { quotes: '\201e' '\201d' '\00ab' '\00bb' }
/* „ ” « » */
:root:lang(pl),       :not(:lang(pl)) > :lang(pl)             { quotes: '\201e' '\201d' '\00ab' '\00bb' }
/* „ ” « » */
:root:lang(hu),       :not(:lang(hu)) > :lang(hu)             { quotes: '\201e' '\201d' '\00bb' '\00ab' }
/* „ ” » « */
:root:lang(nl),       :not(:lang(nl)) > :lang(nl)             { quotes: '\2018' '\2019' '\201c' '\201d' }
/* ‘ ’ “ ” */
:root:lang(ti-ER),    :not(:lang(ti-ER)) > :lang(ti-ER)       { quotes: '\2018' '\2019' '\201c' '\201d' }
/* ‘ ’ “ ” */
:root:lang(dua),      :not(:lang(dua)) > :lang(dua)           { quotes: '\00ab' '\00bb' '\2018' '\2019' }
/* « » ‘ ’ */
:root:lang(ksf),      :not(:lang(ksf)) > :lang(ksf)           { quotes: '\00ab' '\00bb' '\2018' '\2019' }
/* « » ‘ ’ */
:root:lang(rw),       :not(:lang(rw)) > :lang(rw)             { quotes: '\00ab' '\00bb' '\2018' '\2019' }
/* « » ‘ ’ */
:root:lang(nn),       :not(:lang(nn)) > :lang(nn)             { quotes: '\00ab' '\00bb' '\2018' '\2019' }
/* « » ‘ ’ */
:root:lang(nb),       :not(:lang(nb)) > :lang(nb)             { quotes: '\00ab' '\00bb' '\2018' '\2019' }
/* « » ‘ ’ */
:root:lang(ast),      :not(:lang(ast)) > :lang(ast)           { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(bm),       :not(:lang(bm)) > :lang(bm)             { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(br),       :not(:lang(br)) > :lang(br)             { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(ca),       :not(:lang(ca)) > :lang(ca)             { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(dyo),      :not(:lang(dyo)) > :lang(dyo)           { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(el),       :not(:lang(el)) > :lang(el)             { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(es),       :not(:lang(es)) > :lang(es)             { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(ewo),      :not(:lang(ewo)) > :lang(ewo)           { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(mg),       :not(:lang(mg)) > :lang(mg)             { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(mua),      :not(:lang(mua)) > :lang(mua)           { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(sg),       :not(:lang(sg)) > :lang(sg)             { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(it),       :not(:lang(it)) > :lang(it)             { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(kab),      :not(:lang(kab)) > :lang(kab)           { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(kk),       :not(:lang(kk)) > :lang(kk)             { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(pt-PT),    :not(:lang(pt-PT)) > :lang(pt-PT)       { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(nnh),      :not(:lang(nnh)) > :lang(nnh)           { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(sq),       :not(:lang(sq)) > :lang(sq)             { quotes: '\00ab' '\00bb' '\201c' '\201d' }
/* « » “ ” */
:root:lang(bas),      :not(:lang(bas)) > :lang(bas)           { quotes: '\00ab' '\00bb' '\201e' '\201c' }
/* « » „ “ */
:root:lang(be),       :not(:lang(be)) > :lang(be)             { quotes: '\00ab' '\00bb' '\201e' '\201c' }
/* « » „ “ */
:root:lang(ky),       :not(:lang(ky)) > :lang(ky)             { quotes: '\00ab' '\00bb' '\201e' '\201c' }
/* « » „ “ */
:root:lang(sah),      :not(:lang(sah)) > :lang(sah)           { quotes: '\00ab' '\00bb' '\201e' '\201c' }
/* « » „ “ */
:root:lang(ru),       :not(:lang(ru)) > :lang(ru)             { quotes: '\00ab' '\00bb' '\201e' '\201c' }
/* « » „ “ */
:root:lang(uk),       :not(:lang(uk)) > :lang(uk)             { quotes: '\00ab' '\00bb' '\201e' '\201c' }
/* « » „ “ */
:root:lang(zgh),      :not(:lang(zgh)) > :lang(zgh)           { quotes: '\00ab' '\00bb' '\201e' '\201d' }
/* « » „ ” */
:root:lang(shi),      :not(:lang(shi)) > :lang(shi)           { quotes: '\00ab' '\00bb' '\201e' '\201d' }
/* « » „ ” */
:root:lang(shi-Latn), :not(:lang(shi-Latn)) > :lang(shi-Latn) { quotes: '\00ab' '\00bb' '\201e' '\201d' }
/* « » „ ” */
:root:lang(am),       :not(:lang(am)) > :lang(am)             { quotes: '\00ab' '\00bb' '\2039' '\203a' }
/* « » ‹ › */
:root:lang(az-Cyrl),  :not(:lang(az-Cyrl)) > :lang(az-Cyrl)   { quotes: '\00ab' '\00bb' '\2039' '\203a' }
/* « » ‹ › */
:root:lang(fa),       :not(:lang(fa)) > :lang(fa)             { quotes: '\00ab' '\00bb' '\2039' '\203a' }
/* « » ‹ › */
:root:lang(fr-CH),    :not(:lang(fr-CH)) > :lang(fr-CH)       { quotes: '\00ab' '\00bb' '\2039' '\203a' }
/* « » ‹ › */
:root:lang(gsw),      :not(:lang(gsw)) > :lang(gsw)           { quotes: '\00ab' '\00bb' '\2039' '\203a' }
/* « » ‹ › */
:root:lang(jgo),      :not(:lang(jgo)) > :lang(jgo)           { quotes: '\00ab' '\00bb' '\2039' '\203a' }
/* « » ‹ › */
:root:lang(kkj),      :not(:lang(kkj)) > :lang(kkj)           { quotes: '\00ab' '\00bb' '\2039' '\203a' }
/* « » ‹ › */
:root:lang(mzn),      :not(:lang(mzn)) > :lang(mzn)           { quotes: '\00ab' '\00bb' '\2039' '\203a' }
/* « » ‹ › */
:root:lang(fr),       :not(:lang(fr)) > :lang(fr)             { quotes: '\00ab' '\00bb' '\00ab' '\00bb' }
/* « » « » */
:root:lang(hy),       :not(:lang(hy)) > :lang(hy)             { quotes: '\00ab' '\00bb' '\00ab' '\00bb' }
/* « » « » */
:root:lang(yav),      :not(:lang(yav)) > :lang(yav)           { quotes: '\00ab' '\00bb' '\00ab' '\00bb' }
/* « » « » */
:root:lang(ja),       :not(:lang(ja)) > :lang(ja)             { quotes: '\300c' '\300d' '\300e' '\300f' }
/* 「 」 『 』 */
:root:lang(yue),      :not(:lang(yue)) > :lang(yue)           { quotes: '\300c' '\300d' '\300e' '\300f' }
/* 「 」 『 』 */
:root:lang(zh-Hant),  :not(:lang(zh-Hant)) > :lang(zh-Hant)   { quotes: '\300c' '\300d' '\300e' '\300f' }
/* 「 」 『 』 */
/**
 * * Visual
 * * - Corrige o text-decoration padrão no Chrome, Edge e Safari
 * */
abbr:where([title]) {
    text-decoration: underline dotted;
}
/**
 * * Visual
 * * - Limpa estilização de links para otimizara customização
 * */
a {
    text-decoration: none;
}
/**
 * * Visual
 * * - Corrige o font-weight no Edge e Safari
 * */
b,
strong {
    font-weight: bolder;
}
/**
 * * Visual
 * * - Aplica fonte monoespaçada do tema e corrige o font-size
 * */
code,
kbd,
samp,
pre {
    font-family: "Red Hat Mono", monospace;
    font-size: 1em;
}
/**
 * * Visual
 * * - Corrige font-size em todos os navegadores
 * */
small {
    font-size: 80%;
}
/**
 * * Visual
 * * - Previne que elementos com as propriedades 'sup' e 'sub' afetem o line-height
 * */
sub,
sup {
    position: relative;
    font-size: 75%;
    line-height: 0;
    vertical-align: baseline;
}
sub {
    bottom: -0.25em;
}
sup {
    top: -0.5em;
}
/**
 * * Visual
 * * - Corrige problema de identação de conteúdo de texto em tabelas no Chrome e Safari
 * * - Corrige herança de cor da borda
 * * - Padroniza bordas colapsadas
 * */
table {
    text-indent: 0;
    border-color: inherit;
    border-collapse: collapse;
}
/**
 * * Usabilidade / Visual
 * * - Padroniza estilos tipográficos
 * * - Remove a margem no Firefox e Safari
 * * - Remove o preenchimento
 * */
button,
input,
optgroup,
select,
textarea {
    margin: 0;
    padding: 0;
    color: inherit;
    font-family: inherit;
    font-size: 100%;
    font-weight: inherit;
    line-height: inherit;
}
/**
 * * Usabilidade
 * * - Garante que elementos desabilitados não possuam indicação de interatividade
 * */
:disabled {
    cursor: default;
}
/**
 * * Visual
 * * - Corrige a herança da propriedade text-transform no Firefox e Edge
 * */
button,
select {
    text-transform: none;
}
/**
 * * Usabilidade / Visual
 * * - Remove estilos padrões de botões
 * * - Corrige a impossibilidade de estilizar elementos clicáveis no IOS e Safari
 * * - Padroniza cursor pointer
 * */
button,
[type=button],
[type=reset],
[type=submit],
[role=button] {
    border: none;
    -webkit-appearance: button;
    background: transparent;
    background-image: none;
    cursor: pointer;
}
/**
 * * Acessibilidade
 * * WCAG 2.2: critérios 2.4.11, 2.4.7 atendidos
 * * - Padroniza o estilo de elementos no estado "focus"
 * */
:focus-visible {
    outline: 1px solid;
    border-radius: 4px;
}
/**
 * * Visual
 * * - Remove estilo padrão para elementos inválidos (:invalid) no Firefox (https://github.com/mozilla/gecko-dev/blob/2f9eacd9d3d995c937b4251a5557d95d494c9be1/layout/style/res/forms.css#L728-L737)
 * */
:-moz-ui-invalid {
    box-shadow: none;
}
/**
 * * Visual
 * * - Corrige alinhamento vertical no Chrome e Firefox
 * */
progress {
    vertical-align: baseline;
}
/**
 * * Usabilidade / Visual
 * * - Corrige o cursor dos botões de incremento e decremento no Safari
 * */
::-webkit-inner-spin-button,
::-webkit-outer-spin-button {
    height: auto;
}
/**
 * * Usabilidade / Visual
 * * - Corrige aparência estranha no Chrome e Safari
 * * - Corrige a outline no Safari
 * */
[type=search] {
    -webkit-appearance: textfield;
    outline-offset: -2px;
}
/**
 * * Visual
 * * - Remove preenchimento interno no Chrome, Safari e macOS
 * */
::-webkit-search-decoration {
    -webkit-appearance: none;
}
/**
 * * Usabilidade / Visual *
 * * - Corrige a impossibilidade de estilizar elementos clicáveis no IOS e Safari
 * * - Padroniza fonte herdada para o Safari
 * */
::-webkit-file-upload-button {
    -webkit-appearance: button;
    font: inherit;
}
/**
 * * Visual
 * * Corrige o display no Chrome e no Safari
 * */
summary {
    display: list-item;
}
/**
 * * Visual
 * * Remove o espaçamento padrão dos elementos
 * */
blockquote,
dl,
dd,
h1,
h2,
h3,
h4,
h5,
h6,
hr,
figure,
p,
pre {
    margin: 0;
}
fieldset {
    margin: 0;
    padding: 0;
}
legend {
    padding: 0;
}
ol,
ul,
menu {
    margin: 0;
    padding: 0;
    list-style: none;
}
/**
 * * Usabilidade / Visual
 * * - Impede redimensionar o elemento textarea horizontalmente
 * */
textarea {
    resize: vertical;
}
/**
 * * Acessibilidade / Visual
 * * WCAG 2.0: Critério 1.4.3 [AA] atendido parcialmente (contraste mínimo para fontes entre 18pt e 14pt)
 * * - Reconfigura a opacidade padrão do placeholder no Firefox
 * * - Configura a cor padrão de acordo com o tema
 * */
::placeholder {
    opacity: 1;
    color: #6b7280;
}
/**
 * * Visual
 * * - Altera o padrão do tipo de display dos elementos HTML do tipo "substituído" para "block"
 * * - Ajusta o alinhamento vertical
 * */
img,
svg,
video,
canvas,
audio,
iframe,
embed,
object {
    vertical-align: middle;
    display: block;
}
/**
 * * Visual
 * * - Restringe imagens e videos para a largura total do seu elemento pai, e preserva seu aspect-ratio
 * */
img,
video {
    width: 100%;
    height: auto;
}
/**
 * * Usabilidade / Visual
 * * - Garante que elementos com o atributo "hidden" não sejam renderizados
 * */
[hidden] {
    display: none;
}
.ae .m-0 {
    margin: 0px;
}
.ae .mx-0 {
    margin-inline: 0px;
}
.ae .my-0 {
    margin-block: 0px;
}
.ae .m-top-0 {
    margin-top: 0px;
}
.ae .m-right-0 {
    margin-right: 0px;
}
.ae .m-bottom-0 {
    margin-bottom: 0px;
}
.ae .m-left-0 {
    margin-left: 0px;
}
.ae .m-px {
    margin: 1px;
}
.ae .mx-px {
    margin-inline: 1px;
}
.ae .my-px {
    margin-block: 1px;
}
.ae .m-top-px {
    margin-top: 1px;
}
.ae .m-right-px {
    margin-right: 1px;
}
.ae .m-bottom-px {
    margin-bottom: 1px;
}
.ae .m-left-px {
    margin-left: 1px;
}
.ae .m-0\.5 {
    margin: 0.125rem;
}
.ae .mx-0\.5 {
    margin-inline: 0.125rem;
}
.ae .my-0\.5 {
    margin-block: 0.125rem;
}
.ae .m-top-0\.5 {
    margin-top: 0.125rem;
}
.ae .m-right-0\.5 {
    margin-right: 0.125rem;
}
.ae .m-bottom-0\.5 {
    margin-bottom: 0.125rem;
}
.ae .m-left-0\.5 {
    margin-left: 0.125rem;
}
.ae .m-1 {
    margin: 0.25rem;
}
.ae .mx-1 {
    margin-inline: 0.25rem;
}
.ae .my-1 {
    margin-block: 0.25rem;
}
.ae .m-top-1 {
    margin-top: 0.25rem;
}
.ae .m-right-1 {
    margin-right: 0.25rem;
}
.ae .m-bottom-1 {
    margin-bottom: 0.25rem;
}
.ae .m-left-1 {
    margin-left: 0.25rem;
}
.ae .m-1\.5 {
    margin: 0.375rem;
}
.ae .mx-1\.5 {
    margin-inline: 0.375rem;
}
.ae .my-1\.5 {
    margin-block: 0.375rem;
}
.ae .m-top-1\.5 {
    margin-top: 0.375rem;
}
.ae .m-right-1\.5 {
    margin-right: 0.375rem;
}
.ae .m-bottom-1\.5 {
    margin-bottom: 0.375rem;
}
.ae .m-left-1\.5 {
    margin-left: 0.375rem;
}
.ae .m-2 {
    margin: 0.5rem;
}
.ae .mx-2 {
    margin-inline: 0.5rem;
}
.ae .my-2 {
    margin-block: 0.5rem;
}
.ae .m-top-2 {
    margin-top: 0.5rem;
}
.ae .m-right-2 {
    margin-right: 0.5rem;
}
.ae .m-bottom-2 {
    margin-bottom: 0.5rem;
}
.ae .m-left-2 {
    margin-left: 0.5rem;
}
.ae .m-2\.5 {
    margin: 0.625rem;
}
.ae .mx-2\.5 {
    margin-inline: 0.625rem;
}
.ae .my-2\.5 {
    margin-block: 0.625rem;
}
.ae .m-top-2\.5 {
    margin-top: 0.625rem;
}
.ae .m-right-2\.5 {
    margin-right: 0.625rem;
}
.ae .m-bottom-2\.5 {
    margin-bottom: 0.625rem;
}
.ae .m-left-2\.5 {
    margin-left: 0.625rem;
}
.ae .m-3 {
    margin: 0.75rem;
}
.ae .mx-3 {
    margin-inline: 0.75rem;
}
.ae .my-3 {
    margin-block: 0.75rem;
}
.ae .m-top-3 {
    margin-top: 0.75rem;
}
.ae .m-right-3 {
    margin-right: 0.75rem;
}
.ae .m-bottom-3 {
    margin-bottom: 0.75rem;
}
.ae .m-left-3 {
    margin-left: 0.75rem;
}
.ae .m-3\.5 {
    margin: 0.875rem;
}
.ae .mx-3\.5 {
    margin-inline: 0.875rem;
}
.ae .my-3\.5 {
    margin-block: 0.875rem;
}
.ae .m-top-3\.5 {
    margin-top: 0.875rem;
}
.ae .m-right-3\.5 {
    margin-right: 0.875rem;
}
.ae .m-bottom-3\.5 {
    margin-bottom: 0.875rem;
}
.ae .m-left-3\.5 {
    margin-left: 0.875rem;
}
.ae .m-4 {
    margin: 1rem;
}
.ae .mx-4 {
    margin-inline: 1rem;
}
.ae .my-4 {
    margin-block: 1rem;
}
.ae .m-top-4 {
    margin-top: 1rem;
}
.ae .m-right-4 {
    margin-right: 1rem;
}
.ae .m-bottom-4 {
    margin-bottom: 1rem;
}
.ae .m-left-4 {
    margin-left: 1rem;
}
.ae .m-5 {
    margin: 1.25rem;
}
.ae .mx-5 {
    margin-inline: 1.25rem;
}
.ae .my-5 {
    margin-block: 1.25rem;
}
.ae .m-top-5 {
    margin-top: 1.25rem;
}
.ae .m-right-5 {
    margin-right: 1.25rem;
}
.ae .m-bottom-5 {
    margin-bottom: 1.25rem;
}
.ae .m-left-5 {
    margin-left: 1.25rem;
}
.ae .m-6 {
    margin: 1.5rem;
}
.ae .mx-6 {
    margin-inline: 1.5rem;
}
.ae .my-6 {
    margin-block: 1.5rem;
}
.ae .m-top-6 {
    margin-top: 1.5rem;
}
.ae .m-right-6 {
    margin-right: 1.5rem;
}
.ae .m-bottom-6 {
    margin-bottom: 1.5rem;
}
.ae .m-left-6 {
    margin-left: 1.5rem;
}
.ae .m-7 {
    margin: 1.75rem;
}
.ae .mx-7 {
    margin-inline: 1.75rem;
}
.ae .my-7 {
    margin-block: 1.75rem;
}
.ae .m-top-7 {
    margin-top: 1.75rem;
}
.ae .m-right-7 {
    margin-right: 1.75rem;
}
.ae .m-bottom-7 {
    margin-bottom: 1.75rem;
}
.ae .m-left-7 {
    margin-left: 1.75rem;
}
.ae .m-8 {
    margin: 2rem;
}
.ae .mx-8 {
    margin-inline: 2rem;
}
.ae .my-8 {
    margin-block: 2rem;
}
.ae .m-top-8 {
    margin-top: 2rem;
}
.ae .m-right-8 {
    margin-right: 2rem;
}
.ae .m-bottom-8 {
    margin-bottom: 2rem;
}
.ae .m-left-8 {
    margin-left: 2rem;
}
.ae .m-9 {
    margin: 2.25rem;
}
.ae .mx-9 {
    margin-inline: 2.25rem;
}
.ae .my-9 {
    margin-block: 2.25rem;
}
.ae .m-top-9 {
    margin-top: 2.25rem;
}
.ae .m-right-9 {
    margin-right: 2.25rem;
}
.ae .m-bottom-9 {
    margin-bottom: 2.25rem;
}
.ae .m-left-9 {
    margin-left: 2.25rem;
}
.ae .m-10 {
    margin: 2.5rem;
}
.ae .mx-10 {
    margin-inline: 2.5rem;
}
.ae .my-10 {
    margin-block: 2.5rem;
}
.ae .m-top-10 {
    margin-top: 2.5rem;
}
.ae .m-right-10 {
    margin-right: 2.5rem;
}
.ae .m-bottom-10 {
    margin-bottom: 2.5rem;
}
.ae .m-left-10 {
    margin-left: 2.5rem;
}
.ae .m-11 {
    margin: 2.75rem;
}
.ae .mx-11 {
    margin-inline: 2.75rem;
}
.ae .my-11 {
    margin-block: 2.75rem;
}
.ae .m-top-11 {
    margin-top: 2.75rem;
}
.ae .m-right-11 {
    margin-right: 2.75rem;
}
.ae .m-bottom-11 {
    margin-bottom: 2.75rem;
}
.ae .m-left-11 {
    margin-left: 2.75rem;
}
.ae .m-12 {
    margin: 3rem;
}
.ae .mx-12 {
    margin-inline: 3rem;
}
.ae .my-12 {
    margin-block: 3rem;
}
.ae .m-top-12 {
    margin-top: 3rem;
}
.ae .m-right-12 {
    margin-right: 3rem;
}
.ae .m-bottom-12 {
    margin-bottom: 3rem;
}
.ae .m-left-12 {
    margin-left: 3rem;
}
.ae .m-14 {
    margin: 3.5rem;
}
.ae .mx-14 {
    margin-inline: 3.5rem;
}
.ae .my-14 {
    margin-block: 3.5rem;
}
.ae .m-top-14 {
    margin-top: 3.5rem;
}
.ae .m-right-14 {
    margin-right: 3.5rem;
}
.ae .m-bottom-14 {
    margin-bottom: 3.5rem;
}
.ae .m-left-14 {
    margin-left: 3.5rem;
}
.ae .m-16 {
    margin: 4rem;
}
.ae .mx-16 {
    margin-inline: 4rem;
}
.ae .my-16 {
    margin-block: 4rem;
}
.ae .m-top-16 {
    margin-top: 4rem;
}
.ae .m-right-16 {
    margin-right: 4rem;
}
.ae .m-bottom-16 {
    margin-bottom: 4rem;
}
.ae .m-left-16 {
    margin-left: 4rem;
}
.ae .m-20 {
    margin: 5rem;
}
.ae .mx-20 {
    margin-inline: 5rem;
}
.ae .my-20 {
    margin-block: 5rem;
}
.ae .m-top-20 {
    margin-top: 5rem;
}
.ae .m-right-20 {
    margin-right: 5rem;
}
.ae .m-bottom-20 {
    margin-bottom: 5rem;
}
.ae .m-left-20 {
    margin-left: 5rem;
}
.ae .m-24 {
    margin: 6rem;
}
.ae .mx-24 {
    margin-inline: 6rem;
}
.ae .my-24 {
    margin-block: 6rem;
}
.ae .m-top-24 {
    margin-top: 6rem;
}
.ae .m-right-24 {
    margin-right: 6rem;
}
.ae .m-bottom-24 {
    margin-bottom: 6rem;
}
.ae .m-left-24 {
    margin-left: 6rem;
}
.ae .m-28 {
    margin: 7rem;
}
.ae .mx-28 {
    margin-inline: 7rem;
}
.ae .my-28 {
    margin-block: 7rem;
}
.ae .m-top-28 {
    margin-top: 7rem;
}
.ae .m-right-28 {
    margin-right: 7rem;
}
.ae .m-bottom-28 {
    margin-bottom: 7rem;
}
.ae .m-left-28 {
    margin-left: 7rem;
}
.ae .m-32 {
    margin: 8rem;
}
.ae .mx-32 {
    margin-inline: 8rem;
}
.ae .my-32 {
    margin-block: 8rem;
}
.ae .m-top-32 {
    margin-top: 8rem;
}
.ae .m-right-32 {
    margin-right: 8rem;
}
.ae .m-bottom-32 {
    margin-bottom: 8rem;
}
.ae .m-left-32 {
    margin-left: 8rem;
}
.ae .m-36 {
    margin: 9rem;
}
.ae .mx-36 {
    margin-inline: 9rem;
}
.ae .my-36 {
    margin-block: 9rem;
}
.ae .m-top-36 {
    margin-top: 9rem;
}
.ae .m-right-36 {
    margin-right: 9rem;
}
.ae .m-bottom-36 {
    margin-bottom: 9rem;
}
.ae .m-left-36 {
    margin-left: 9rem;
}
.ae .m-40 {
    margin: 10rem;
}
.ae .mx-40 {
    margin-inline: 10rem;
}
.ae .my-40 {
    margin-block: 10rem;
}
.ae .m-top-40 {
    margin-top: 10rem;
}
.ae .m-right-40 {
    margin-right: 10rem;
}
.ae .m-bottom-40 {
    margin-bottom: 10rem;
}
.ae .m-left-40 {
    margin-left: 10rem;
}
.ae .m-44 {
    margin: 11rem;
}
.ae .mx-44 {
    margin-inline: 11rem;
}
.ae .my-44 {
    margin-block: 11rem;
}
.ae .m-top-44 {
    margin-top: 11rem;
}
.ae .m-right-44 {
    margin-right: 11rem;
}
.ae .m-bottom-44 {
    margin-bottom: 11rem;
}
.ae .m-left-44 {
    margin-left: 11rem;
}
.ae .m-48 {
    margin: 12rem;
}
.ae .mx-48 {
    margin-inline: 12rem;
}
.ae .my-48 {
    margin-block: 12rem;
}
.ae .m-top-48 {
    margin-top: 12rem;
}
.ae .m-right-48 {
    margin-right: 12rem;
}
.ae .m-bottom-48 {
    margin-bottom: 12rem;
}
.ae .m-left-48 {
    margin-left: 12rem;
}
.ae .m-56 {
    margin: 14rem;
}
.ae .mx-56 {
    margin-inline: 14rem;
}
.ae .my-56 {
    margin-block: 14rem;
}
.ae .m-top-56 {
    margin-top: 14rem;
}
.ae .m-right-56 {
    margin-right: 14rem;
}
.ae .m-bottom-56 {
    margin-bottom: 14rem;
}
.ae .m-left-56 {
    margin-left: 14rem;
}
.ae .m-64 {
    margin: 16rem;
}
.ae .mx-64 {
    margin-inline: 16rem;
}
.ae .my-64 {
    margin-block: 16rem;
}
.ae .m-top-64 {
    margin-top: 16rem;
}
.ae .m-right-64 {
    margin-right: 16rem;
}
.ae .m-bottom-64 {
    margin-bottom: 16rem;
}
.ae .m-left-64 {
    margin-left: 16rem;
}
.ae .m-72 {
    margin: 18rem;
}
.ae .mx-72 {
    margin-inline: 18rem;
}
.ae .my-72 {
    margin-block: 18rem;
}
.ae .m-top-72 {
    margin-top: 18rem;
}
.ae .m-right-72 {
    margin-right: 18rem;
}
.ae .m-bottom-72 {
    margin-bottom: 18rem;
}
.ae .m-left-72 {
    margin-left: 18rem;
}
.ae .m-80 {
    margin: 20rem;
}
.ae .mx-80 {
    margin-inline: 20rem;
}
.ae .my-80 {
    margin-block: 20rem;
}
.ae .m-top-80 {
    margin-top: 20rem;
}
.ae .m-right-80 {
    margin-right: 20rem;
}
.ae .m-bottom-80 {
    margin-bottom: 20rem;
}
.ae .m-left-80 {
    margin-left: 20rem;
}
.ae .m-96 {
    margin: 24rem;
}
.ae .mx-96 {
    margin-inline: 24rem;
}
.ae .my-96 {
    margin-block: 24rem;
}
.ae .m-top-96 {
    margin-top: 24rem;
}
.ae .m-right-96 {
    margin-right: 24rem;
}
.ae .m-bottom-96 {
    margin-bottom: 24rem;
}
.ae .m-left-96 {
    margin-left: 24rem;
}
.ae .p-0 {
    padding: 0px;
}
.ae .px-0 {
    padding-inline: 0px;
}
.ae .py-0 {
    padding-block: 0px;
}
.ae .p-top-0 {
    padding-top: 0px;
}
.ae .p-right-0 {
    padding-right: 0px;
}
.ae .p-bottom-0 {
    padding-bottom: 0px;
}
.ae .p-left-0 {
    padding-left: 0px;
}
.ae .p-px {
    padding: 1px;
}
.ae .px-px {
    padding-inline: 1px;
}
.ae .py-px {
    padding-block: 1px;
}
.ae .p-top-px {
    padding-top: 1px;
}
.ae .p-right-px {
    padding-right: 1px;
}
.ae .p-bottom-px {
    padding-bottom: 1px;
}
.ae .p-left-px {
    padding-left: 1px;
}
.ae .p-0\.5 {
    padding: 0.125rem;
}
.ae .px-0\.5 {
    padding-inline: 0.125rem;
}
.ae .py-0\.5 {
    padding-block: 0.125rem;
}
.ae .p-top-0\.5 {
    padding-top: 0.125rem;
}
.ae .p-right-0\.5 {
    padding-right: 0.125rem;
}
.ae .p-bottom-0\.5 {
    padding-bottom: 0.125rem;
}
.ae .p-left-0\.5 {
    padding-left: 0.125rem;
}
.ae .p-1 {
    padding: 0.25rem;
}
.ae .px-1 {
    padding-inline: 0.25rem;
}
.ae .py-1 {
    padding-block: 0.25rem;
}
.ae .p-top-1 {
    padding-top: 0.25rem;
}
.ae .p-right-1 {
    padding-right: 0.25rem;
}
.ae .p-bottom-1 {
    padding-bottom: 0.25rem;
}
.ae .p-left-1 {
    padding-left: 0.25rem;
}
.ae .p-1\.5 {
    padding: 0.375rem;
}
.ae .px-1\.5 {
    padding-inline: 0.375rem;
}
.ae .py-1\.5 {
    padding-block: 0.375rem;
}
.ae .p-top-1\.5 {
    padding-top: 0.375rem;
}
.ae .p-right-1\.5 {
    padding-right: 0.375rem;
}
.ae .p-bottom-1\.5 {
    padding-bottom: 0.375rem;
}
.ae .p-left-1\.5 {
    padding-left: 0.375rem;
}
.ae .p-2 {
    padding: 0.5rem;
}
.ae .px-2 {
    padding-inline: 0.5rem;
}
.ae .py-2 {
    padding-block: 0.5rem;
}
.ae .p-top-2 {
    padding-top: 0.5rem;
}
.ae .p-right-2 {
    padding-right: 0.5rem;
}
.ae .p-bottom-2 {
    padding-bottom: 0.5rem;
}
.ae .p-left-2 {
    padding-left: 0.5rem;
}
.ae .p-2\.5 {
    padding: 0.625rem;
}
.ae .px-2\.5 {
    padding-inline: 0.625rem;
}
.ae .py-2\.5 {
    padding-block: 0.625rem;
}
.ae .p-top-2\.5 {
    padding-top: 0.625rem;
}
.ae .p-right-2\.5 {
    padding-right: 0.625rem;
}
.ae .p-bottom-2\.5 {
    padding-bottom: 0.625rem;
}
.ae .p-left-2\.5 {
    padding-left: 0.625rem;
}
.ae .p-3 {
    padding: 0.75rem;
}
.ae .px-3 {
    padding-inline: 0.75rem;
}
.ae .py-3 {
    padding-block: 0.75rem;
}
.ae .p-top-3 {
    padding-top: 0.75rem;
}
.ae .p-right-3 {
    padding-right: 0.75rem;
}
.ae .p-bottom-3 {
    padding-bottom: 0.75rem;
}
.ae .p-left-3 {
    padding-left: 0.75rem;
}
.ae .p-3\.5 {
    padding: 0.875rem;
}
.ae .px-3\.5 {
    padding-inline: 0.875rem;
}
.ae .py-3\.5 {
    padding-block: 0.875rem;
}
.ae .p-top-3\.5 {
    padding-top: 0.875rem;
}
.ae .p-right-3\.5 {
    padding-right: 0.875rem;
}
.ae .p-bottom-3\.5 {
    padding-bottom: 0.875rem;
}
.ae .p-left-3\.5 {
    padding-left: 0.875rem;
}
.ae .p-4 {
    padding: 1rem;
}
.ae .px-4 {
    padding-inline: 1rem;
}
.ae .py-4 {
    padding-block: 1rem;
}
.ae .p-top-4 {
    padding-top: 1rem;
}
.ae .p-right-4 {
    padding-right: 1rem;
}
.ae .p-bottom-4 {
    padding-bottom: 1rem;
}
.ae .p-left-4 {
    padding-left: 1rem;
}
.ae .p-5 {
    padding: 1.25rem;
}
.ae .px-5 {
    padding-inline: 1.25rem;
}
.ae .py-5 {
    padding-block: 1.25rem;
}
.ae .p-top-5 {
    padding-top: 1.25rem;
}
.ae .p-right-5 {
    padding-right: 1.25rem;
}
.ae .p-bottom-5 {
    padding-bottom: 1.25rem;
}
.ae .p-left-5 {
    padding-left: 1.25rem;
}
.ae .p-6 {
    padding: 1.5rem;
}
.ae .px-6 {
    padding-inline: 1.5rem;
}
.ae .py-6 {
    padding-block: 1.5rem;
}
.ae .p-top-6 {
    padding-top: 1.5rem;
}
.ae .p-right-6 {
    padding-right: 1.5rem;
}
.ae .p-bottom-6 {
    padding-bottom: 1.5rem;
}
.ae .p-left-6 {
    padding-left: 1.5rem;
}
.ae .p-7 {
    padding: 1.75rem;
}
.ae .px-7 {
    padding-inline: 1.75rem;
}
.ae .py-7 {
    padding-block: 1.75rem;
}
.ae .p-top-7 {
    padding-top: 1.75rem;
}
.ae .p-right-7 {
    padding-right: 1.75rem;
}
.ae .p-bottom-7 {
    padding-bottom: 1.75rem;
}
.ae .p-left-7 {
    padding-left: 1.75rem;
}
.ae .p-8 {
    padding: 2rem;
}
.ae .px-8 {
    padding-inline: 2rem;
}
.ae .py-8 {
    padding-block: 2rem;
}
.ae .p-top-8 {
    padding-top: 2rem;
}
.ae .p-right-8 {
    padding-right: 2rem;
}
.ae .p-bottom-8 {
    padding-bottom: 2rem;
}
.ae .p-left-8 {
    padding-left: 2rem;
}
.ae .p-9 {
    padding: 2.25rem;
}
.ae .px-9 {
    padding-inline: 2.25rem;
}
.ae .py-9 {
    padding-block: 2.25rem;
}
.ae .p-top-9 {
    padding-top: 2.25rem;
}
.ae .p-right-9 {
    padding-right: 2.25rem;
}
.ae .p-bottom-9 {
    padding-bottom: 2.25rem;
}
.ae .p-left-9 {
    padding-left: 2.25rem;
}
.ae .p-10 {
    padding: 2.5rem;
}
.ae .px-10 {
    padding-inline: 2.5rem;
}
.ae .py-10 {
    padding-block: 2.5rem;
}
.ae .p-top-10 {
    padding-top: 2.5rem;
}
.ae .p-right-10 {
    padding-right: 2.5rem;
}
.ae .p-bottom-10 {
    padding-bottom: 2.5rem;
}
.ae .p-left-10 {
    padding-left: 2.5rem;
}
.ae .p-11 {
    padding: 2.75rem;
}
.ae .px-11 {
    padding-inline: 2.75rem;
}
.ae .py-11 {
    padding-block: 2.75rem;
}
.ae .p-top-11 {
    padding-top: 2.75rem;
}
.ae .p-right-11 {
    padding-right: 2.75rem;
}
.ae .p-bottom-11 {
    padding-bottom: 2.75rem;
}
.ae .p-left-11 {
    padding-left: 2.75rem;
}
.ae .p-12 {
    padding: 3rem;
}
.ae .px-12 {
    padding-inline: 3rem;
}
.ae .py-12 {
    padding-block: 3rem;
}
.ae .p-top-12 {
    padding-top: 3rem;
}
.ae .p-right-12 {
    padding-right: 3rem;
}
.ae .p-bottom-12 {
    padding-bottom: 3rem;
}
.ae .p-left-12 {
    padding-left: 3rem;
}
.ae .p-14 {
    padding: 3.5rem;
}
.ae .px-14 {
    padding-inline: 3.5rem;
}
.ae .py-14 {
    padding-block: 3.5rem;
}
.ae .p-top-14 {
    padding-top: 3.5rem;
}
.ae .p-right-14 {
    padding-right: 3.5rem;
}
.ae .p-bottom-14 {
    padding-bottom: 3.5rem;
}
.ae .p-left-14 {
    padding-left: 3.5rem;
}
.ae .p-16 {
    padding: 4rem;
}
.ae .px-16 {
    padding-inline: 4rem;
}
.ae .py-16 {
    padding-block: 4rem;
}
.ae .p-top-16 {
    padding-top: 4rem;
}
.ae .p-right-16 {
    padding-right: 4rem;
}
.ae .p-bottom-16 {
    padding-bottom: 4rem;
}
.ae .p-left-16 {
    padding-left: 4rem;
}
.ae .p-20 {
    padding: 5rem;
}
.ae .px-20 {
    padding-inline: 5rem;
}
.ae .py-20 {
    padding-block: 5rem;
}
.ae .p-top-20 {
    padding-top: 5rem;
}
.ae .p-right-20 {
    padding-right: 5rem;
}
.ae .p-bottom-20 {
    padding-bottom: 5rem;
}
.ae .p-left-20 {
    padding-left: 5rem;
}
.ae .p-24 {
    padding: 6rem;
}
.ae .px-24 {
    padding-inline: 6rem;
}
.ae .py-24 {
    padding-block: 6rem;
}
.ae .p-top-24 {
    padding-top: 6rem;
}
.ae .p-right-24 {
    padding-right: 6rem;
}
.ae .p-bottom-24 {
    padding-bottom: 6rem;
}
.ae .p-left-24 {
    padding-left: 6rem;
}
.ae .p-28 {
    padding: 7rem;
}
.ae .px-28 {
    padding-inline: 7rem;
}
.ae .py-28 {
    padding-block: 7rem;
}
.ae .p-top-28 {
    padding-top: 7rem;
}
.ae .p-right-28 {
    padding-right: 7rem;
}
.ae .p-bottom-28 {
    padding-bottom: 7rem;
}
.ae .p-left-28 {
    padding-left: 7rem;
}
.ae .p-32 {
    padding: 8rem;
}
.ae .px-32 {
    padding-inline: 8rem;
}
.ae .py-32 {
    padding-block: 8rem;
}
.ae .p-top-32 {
    padding-top: 8rem;
}
.ae .p-right-32 {
    padding-right: 8rem;
}
.ae .p-bottom-32 {
    padding-bottom: 8rem;
}
.ae .p-left-32 {
    padding-left: 8rem;
}
.ae .p-36 {
    padding: 9rem;
}
.ae .px-36 {
    padding-inline: 9rem;
}
.ae .py-36 {
    padding-block: 9rem;
}
.ae .p-top-36 {
    padding-top: 9rem;
}
.ae .p-right-36 {
    padding-right: 9rem;
}
.ae .p-bottom-36 {
    padding-bottom: 9rem;
}
.ae .p-left-36 {
    padding-left: 9rem;
}
.ae .p-40 {
    padding: 10rem;
}
.ae .px-40 {
    padding-inline: 10rem;
}
.ae .py-40 {
    padding-block: 10rem;
}
.ae .p-top-40 {
    padding-top: 10rem;
}
.ae .p-right-40 {
    padding-right: 10rem;
}
.ae .p-bottom-40 {
    padding-bottom: 10rem;
}
.ae .p-left-40 {
    padding-left: 10rem;
}
.ae .p-44 {
    padding: 11rem;
}
.ae .px-44 {
    padding-inline: 11rem;
}
.ae .py-44 {
    padding-block: 11rem;
}
.ae .p-top-44 {
    padding-top: 11rem;
}
.ae .p-right-44 {
    padding-right: 11rem;
}
.ae .p-bottom-44 {
    padding-bottom: 11rem;
}
.ae .p-left-44 {
    padding-left: 11rem;
}
.ae .p-48 {
    padding: 12rem;
}
.ae .px-48 {
    padding-inline: 12rem;
}
.ae .py-48 {
    padding-block: 12rem;
}
.ae .p-top-48 {
    padding-top: 12rem;
}
.ae .p-right-48 {
    padding-right: 12rem;
}
.ae .p-bottom-48 {
    padding-bottom: 12rem;
}
.ae .p-left-48 {
    padding-left: 12rem;
}
.ae .p-56 {
    padding: 14rem;
}
.ae .px-56 {
    padding-inline: 14rem;
}
.ae .py-56 {
    padding-block: 14rem;
}
.ae .p-top-56 {
    padding-top: 14rem;
}
.ae .p-right-56 {
    padding-right: 14rem;
}
.ae .p-bottom-56 {
    padding-bottom: 14rem;
}
.ae .p-left-56 {
    padding-left: 14rem;
}
.ae .p-64 {
    padding: 16rem;
}
.ae .px-64 {
    padding-inline: 16rem;
}
.ae .py-64 {
    padding-block: 16rem;
}
.ae .p-top-64 {
    padding-top: 16rem;
}
.ae .p-right-64 {
    padding-right: 16rem;
}
.ae .p-bottom-64 {
    padding-bottom: 16rem;
}
.ae .p-left-64 {
    padding-left: 16rem;
}
.ae .p-72 {
    padding: 18rem;
}
.ae .px-72 {
    padding-inline: 18rem;
}
.ae .py-72 {
    padding-block: 18rem;
}
.ae .p-top-72 {
    padding-top: 18rem;
}
.ae .p-right-72 {
    padding-right: 18rem;
}
.ae .p-bottom-72 {
    padding-bottom: 18rem;
}
.ae .p-left-72 {
    padding-left: 18rem;
}
.ae .p-80 {
    padding: 20rem;
}
.ae .px-80 {
    padding-inline: 20rem;
}
.ae .py-80 {
    padding-block: 20rem;
}
.ae .p-top-80 {
    padding-top: 20rem;
}
.ae .p-right-80 {
    padding-right: 20rem;
}
.ae .p-bottom-80 {
    padding-bottom: 20rem;
}
.ae .p-left-80 {
    padding-left: 20rem;
}
.ae .p-96 {
    padding: 24rem;
}
.ae .px-96 {
    padding-inline: 24rem;
}
.ae .py-96 {
    padding-block: 24rem;
}
.ae .p-top-96 {
    padding-top: 24rem;
}
.ae .p-right-96 {
    padding-right: 24rem;
}
.ae .p-bottom-96 {
    padding-bottom: 24rem;
}
.ae .p-left-96 {
    padding-left: 24rem;
}
.ae .d-none {
    display: none;
}
.ae .d-inline {
    display: inline;
}
.ae .d-inline-block {
    display: inline-block;
}
.ae .d-inline-flex {
    display: inline-flex;
}
.ae .d-inline-grid {
    display: inline-grid;
}
.ae .d-inline-table {
    display: inline-table;
}
.ae .d-block {
    display: block;
}
.ae .d-contents {
    display: contents;
}
.ae .d-grid {
    display: grid;
}
.ae .d-flex {
    display: flex;
}
.ae .d-flow-root {
    display: flow-root;
}
.ae .d-list-item {
    display: list-item;
}
.ae .d-table {
    display: table;
}
.ae .d-table-caption {
    display: table-caption;
}
.ae .d-table-column-group {
    display: table-column-group;
}
.ae .d-table-header-group {
    display: table-header-group;
}
.ae .d-table-footer-group {
    display: table-footer-group;
}
.ae .d-table-row-group {
    display: table-row-group;
}
.ae .d-table-cell {
    display: table-cell;
}
.ae .d-table-column {
    display: table-column;
}
.ae .d-table-row {
    display: table-row;
}
.ae .layer-auto {
    z-index: auto;
}
.ae .layer-0 {
    z-index: 0;
}
.ae .layer-10 {
    z-index: 10;
}
.ae .layer-20 {
    z-index: 20;
}
.ae .layer-30 {
    z-index: 30;
}
.ae .layer-40 {
    z-index: 40;
}
.ae .layer-50 {
    z-index: 50;
}
.ae .layer-60 {
    z-index: 60;
}
.ae .layer-70 {
    z-index: 70;
}
.ae .layer-80 {
    z-index: 80;
}
.ae .layer90 {
    z-index: 90;
}
.ae .layer-100 {
    z-index: 100;
}
.ae .layer-200 {
    z-index: 200;
}
.ae .layer-300 {
    z-index: 300;
}
.ae .layer-400 {
    z-index: 400;
}
.ae .layer-500 {
    z-index: 500;
}
.ae .layer-600 {
    z-index: 600;
}
.ae .layer-700 {
    z-index: 700;
}
.ae .layer-800 {
    z-index: 800;
}
.ae .layer-900 {
    z-index: 900;
}
.ae .\-layer-10 {
    z-index: -10;
}
.ae .\-layer-20 {
    z-index: -20;
}
.ae .\-layer-30 {
    z-index: -30;
}
.ae .\-layer-40 {
    z-index: -40;
}
.ae .\-layer-50 {
    z-index: -50;
}
.ae .\-layer-60 {
    z-index: -60;
}
.ae .\-layer-70 {
    z-index: -70;
}
.ae .\-layer-80 {
    z-index: -80;
}
.ae .\-layer-90 {
    z-index: -90;
}
.ae .\-layer-100 {
    z-index: -100;
}
.ae .\-layer-200 {
    z-index: -200;
}
.ae .\-layer-300 {
    z-index: -300;
}
.ae .\-layer-400 {
    z-index: -400;
}
.ae .\-layer-500 {
    z-index: -500;
}
.ae .\-layer-600 {
    z-index: -600;
}
.ae .\-layer-700 {
    z-index: -700;
}
.ae .\-layer-800 {
    z-index: -800;
}
.ae .\-layer-900 {
    z-index: -900;
}
.ae .only-sr {
    position: absolute;
    width: 1px;
    height: 1px;
    margin: -1px;
    padding: 0;
    clip: rect(1px 1px 1px 1px);
    clip-path: inset(50%);
    overflow: hidden;
}
.ae [class~=divider-x] {
    border-top-width: 0px;
    border-bottom-width: 0px;
}
.ae .divider-x {
    border-right-width: 0px;
    border-left-width: 1px;
}
.ae .divider-x-2 {
    border-right-width: 0px;
    border-left-width: 2px;
}
.ae .divider-x-4 {
    border-right-width: 0px;
    border-left-width: 4px;
}
.ae .divider-x-8 {
    border-right-width: 0px;
    border-left-width: 8px;
}
.ae [class~=divider-y] {
    border-left-width: 0px;
    border-right-width: 0px;
}
.ae .divider-y {
    border-bottom-width: 0px;
    border-top-width: 1px;
}
.ae .divider-y-2 {
    border-bottom-width: 0px;
    border-top-width: 2px;
}
.ae .divider-y-4 {
    border-bottom-width: 0px;
    border-top-width: 4px;
}
.ae .divider-y-8 {
    border-bottom-width: 0px;
    border-top-width: 8px;
}
.ae .divider-solid {
    border-style: solid;
}
.ae .divider-dotted {
    border-style: dotted;
}
.ae .divider-dashed {
    border-style: dashed;
}
.ae .divider-double {
    border-style: double;
}
.ae .divider-groove {
    border-style: groove;
}
.ae .divider-ridge {
    border-style: ridge;
}
.ae .divider-inset {
    border-style: inset;
}
.ae .divider-outset {
    border-style: outset;
}
.ae .divider-white {
    border-color: #ffffff;
}
.ae .divider-neutral-50 {
    border-color: #fafafa;
}
.ae .divider-neutral-100 {
    border-color: #f5f5f5;
}
.ae .divider-neutral-200 {
    border-color: #e5e5e5;
}
.ae .divider-neutral-300 {
    border-color: #d4d4d4;
}
.ae .divider-neutral-400 {
    border-color: #a3a3a3;
}
.ae .divider-neutral-500 {
    border-color: #737373;
}
.ae .divider-neutral-600 {
    border-color: #525252;
}
.ae .divider-neutral-700 {
    border-color: #404040;
}
.ae .divider-neutral-800 {
    border-color: #262626;
}
.ae .divider-neutral-900 {
    border-color: #171717;
}
.ae .divider-neutral-950 {
    border-color: #0a0a0a;
}
.ae .divider-black {
    border-color: #000000;
}
.ae .divider-gray-50 {
    border-color: #f9fafb;
}
.ae .divider-gray-100 {
    border-color: #f3f4f6;
}
.ae .divider-gray-200 {
    border-color: #e5e7eb;
}
.ae .divider-gray-300 {
    border-color: #d1d5db;
}
.ae .divider-gray-400 {
    border-color: #9ca3af;
}
.ae .divider-gray-500 {
    border-color: #6b7280;
}
.ae .divider-gray-600 {
    border-color: #4b5563;
}
.ae .divider-gray-700 {
    border-color: #374151;
}
.ae .divider-gray-800 {
    border-color: #1f2937;
}
.ae .divider-gray-900 {
    border-color: #111827;
}
.ae .divider-gray-950 {
    border-color: #030712;
}
.ae .divider-slate-50 {
    border-color: #f8fafc;
}
.ae .divider-slate-100 {
    border-color: #f1f5f9;
}
.ae .divider-slate-200 {
    border-color: #e2e8f0;
}
.ae .divider-slate-300 {
    border-color: #cbd5e1;
}
.ae .divider-slate-400 {
    border-color: #94a3b8;
}
.ae .divider-slate-500 {
    border-color: #64748b;
}
.ae .divider-slate-600 {
    border-color: #475569;
}
.ae .divider-slate-700 {
    border-color: #334155;
}
.ae .divider-slate-800 {
    border-color: #1e293b;
}
.ae .divider-slate-900 {
    border-color: #0f172a;
}
.ae .divider-slate-950 {
    border-color: #020617;
}
.ae .divider-zinc-50 {
    border-color: #fafafa;
}
.ae .divider-zinc-100 {
    border-color: #f4f4f5;
}
.ae .divider-zinc-200 {
    border-color: #e4e4e7;
}
.ae .divider-zinc-300 {
    border-color: #d4d4d8;
}
.ae .divider-zinc-400 {
    border-color: #a1a1aa;
}
.ae .divider-zinc-500 {
    border-color: #71717a;
}
.ae .divider-zinc-600 {
    border-color: #52525b;
}
.ae .divider-zinc-700 {
    border-color: #3f3f46;
}
.ae .divider-zinc-800 {
    border-color: #27272a;
}
.ae .divider-zinc-900 {
    border-color: #18181b;
}
.ae .divider-zinc-950 {
    border-color: #09090b;
}
.ae .divider-stone-50 {
    border-color: #fafaf9;
}
.ae .divider-stone-100 {
    border-color: #f5f5f4;
}
.ae .divider-stone-200 {
    border-color: #e7e5e4;
}
.ae .divider-stone-300 {
    border-color: #d6d3d1;
}
.ae .divider-stone-400 {
    border-color: #a8a29e;
}
.ae .divider-stone-500 {
    border-color: #78716c;
}
.ae .divider-stone-600 {
    border-color: #57534e;
}
.ae .divider-stone-700 {
    border-color: #44403c;
}
.ae .divider-stone-800 {
    border-color: #292524;
}
.ae .divider-stone-900 {
    border-color: #1c1917;
}
.ae .divider-stone-950 {
    border-color: #0c0a09;
}
.ae .divider-red-50 {
    border-color: #fef2f2;
}
.ae .divider-red-100 {
    border-color: #fee2e2;
}
.ae .divider-red-200 {
    border-color: #fecaca;
}
.ae .divider-red-300 {
    border-color: #fca5a5;
}
.ae .divider-red-400 {
    border-color: #f87171;
}
.ae .divider-red-500 {
    border-color: #ef4444;
}
.ae .divider-red-600 {
    border-color: #dc2626;
}
.ae .divider-red-700 {
    border-color: #b91c1c;
}
.ae .divider-red-800 {
    border-color: #991b1b;
}
.ae .divider-red-900 {
    border-color: #7f1d1d;
}
.ae .divider-red-950 {
    border-color: #450a0a;
}
.ae .divider-orange-50 {
    border-color: #fff7ed;
}
.ae .divider-orange-100 {
    border-color: #ffedd5;
}
.ae .divider-orange-200 {
    border-color: #fed7aa;
}
.ae .divider-orange-300 {
    border-color: #fdba74;
}
.ae .divider-orange-400 {
    border-color: #fb923c;
}
.ae .divider-orange-500 {
    border-color: #f97316;
}
.ae .divider-orange-600 {
    border-color: #ea580c;
}
.ae .divider-orange-700 {
    border-color: #c2410c;
}
.ae .divider-orange-800 {
    border-color: #9a3412;
}
.ae .divider-orange-900 {
    border-color: #7c2d12;
}
.ae .divider-orange-950 {
    border-color: #431407;
}
.ae .divider-amber-50 {
    border-color: #fffbeb;
}
.ae .divider-amber-100 {
    border-color: #fef3c7;
}
.ae .divider-amber-200 {
    border-color: #fde68a;
}
.ae .divider-amber-300 {
    border-color: #fcd34d;
}
.ae .divider-amber-400 {
    border-color: #fbbf24;
}
.ae .divider-amber-500 {
    border-color: #f59e0b;
}
.ae .divider-amber-600 {
    border-color: #d97706;
}
.ae .divider-amber-700 {
    border-color: #b45309;
}
.ae .divider-amber-800 {
    border-color: #92400e;
}
.ae .divider-amber-900 {
    border-color: #78350f;
}
.ae .divider-amber-950 {
    border-color: #451a03;
}
.ae .divider-yellow-50 {
    border-color: #fefce8;
}
.ae .divider-yellow-100 {
    border-color: #fef9c3;
}
.ae .divider-yellow-200 {
    border-color: #fef08a;
}
.ae .divider-yellow-300 {
    border-color: #fde047;
}
.ae .divider-yellow-400 {
    border-color: #facc15;
}
.ae .divider-yellow-500 {
    border-color: #eab308;
}
.ae .divider-yellow-600 {
    border-color: #ca8a04;
}
.ae .divider-yellow-700 {
    border-color: #a16207;
}
.ae .divider-yellow-800 {
    border-color: #854d0e;
}
.ae .divider-yellow-900 {
    border-color: #713f12;
}
.ae .divider-yellow-950 {
    border-color: #422006;
}
.ae .divider-lime-50 {
    border-color: #f7fee7;
}
.ae .divider-lime-100 {
    border-color: #ecfccb;
}
.ae .divider-lime-200 {
    border-color: #d9f99d;
}
.ae .divider-lime-300 {
    border-color: #bef264;
}
.ae .divider-lime-400 {
    border-color: #a3e635;
}
.ae .divider-lime-500 {
    border-color: #84cc16;
}
.ae .divider-lime-600 {
    border-color: #65a30d;
}
.ae .divider-lime-700 {
    border-color: #4d7c0f;
}
.ae .divider-lime-800 {
    border-color: #3f6212;
}
.ae .divider-lime-900 {
    border-color: #365314;
}
.ae .divider-lime-950 {
    border-color: #1a2e05;
}
.ae .divider-green-50 {
    border-color: #f0fdf4;
}
.ae .divider-green-100 {
    border-color: #dcfce7;
}
.ae .divider-green-200 {
    border-color: #bbf7d0;
}
.ae .divider-green-300 {
    border-color: #86efac;
}
.ae .divider-green-400 {
    border-color: #4ade80;
}
.ae .divider-green-500 {
    border-color: #22c55e;
}
.ae .divider-green-600 {
    border-color: #16a34a;
}
.ae .divider-green-700 {
    border-color: #15803d;
}
.ae .divider-green-800 {
    border-color: #166534;
}
.ae .divider-green-900 {
    border-color: #14532d;
}
.ae .divider-green-950 {
    border-color: #052e16;
}
.ae .divider-emerald-50 {
    border-color: #ecfdf5;
}
.ae .divider-emerald-100 {
    border-color: #d1fae5;
}
.ae .divider-emerald-200 {
    border-color: #a7f3d0;
}
.ae .divider-emerald-300 {
    border-color: #6ee7b7;
}
.ae .divider-emerald-400 {
    border-color: #34d399;
}
.ae .divider-emerald-500 {
    border-color: #10b981;
}
.ae .divider-emerald-600 {
    border-color: #059669;
}
.ae .divider-emerald-700 {
    border-color: #047857;
}
.ae .divider-emerald-800 {
    border-color: #065f46;
}
.ae .divider-emerald-900 {
    border-color: #064e3b;
}
.ae .divider-emerald-950 {
    border-color: #022c22;
}
.ae .divider-teal-50 {
    border-color: #f0fdfa;
}
.ae .divider-teal-100 {
    border-color: #ccfbf1;
}
.ae .divider-teal-200 {
    border-color: #99f6e4;
}
.ae .divider-teal-300 {
    border-color: #5eead4;
}
.ae .divider-teal-400 {
    border-color: #2dd4bf;
}
.ae .divider-teal-500 {
    border-color: #14b8a6;
}
.ae .divider-teal-600 {
    border-color: #0d9488;
}
.ae .divider-teal-700 {
    border-color: #0f766e;
}
.ae .divider-teal-800 {
    border-color: #115e59;
}
.ae .divider-teal-900 {
    border-color: #134e4a;
}
.ae .divider-teal-950 {
    border-color: #042f2e;
}
.ae .divider-cyan-50 {
    border-color: #ecfeff;
}
.ae .divider-cyan-100 {
    border-color: #cffafe;
}
.ae .divider-cyan-200 {
    border-color: #a5f3fc;
}
.ae .divider-cyan-300 {
    border-color: #67e8f9;
}
.ae .divider-cyan-400 {
    border-color: #22d3ee;
}
.ae .divider-cyan-500 {
    border-color: #06b6d4;
}
.ae .divider-cyan-600 {
    border-color: #0891b2;
}
.ae .divider-cyan-700 {
    border-color: #0e7490;
}
.ae .divider-cyan-800 {
    border-color: #155e75;
}
.ae .divider-cyan-900 {
    border-color: #164e63;
}
.ae .divider-cyan-950 {
    border-color: #083344;
}
.ae .divider-sky-50 {
    border-color: #f0f9ff;
}
.ae .divider-sky-100 {
    border-color: #e0f2fe;
}
.ae .divider-sky-200 {
    border-color: #bae6fd;
}
.ae .divider-sky-300 {
    border-color: #7dd3fc;
}
.ae .divider-sky-400 {
    border-color: #38bdf8;
}
.ae .divider-sky-500 {
    border-color: #0ea5e9;
}
.ae .divider-sky-600 {
    border-color: #0284c7;
}
.ae .divider-sky-700 {
    border-color: #0369a1;
}
.ae .divider-sky-800 {
    border-color: #075985;
}
.ae .divider-sky-900 {
    border-color: #0c4a6e;
}
.ae .divider-sky-950 {
    border-color: #082f49;
}
.ae .divider-blue-50 {
    border-color: #eff6ff;
}
.ae .divider-blue-100 {
    border-color: #dbeafe;
}
.ae .divider-blue-200 {
    border-color: #bfdbfe;
}
.ae .divider-blue-300 {
    border-color: #93c5fd;
}
.ae .divider-blue-400 {
    border-color: #60a5fa;
}
.ae .divider-blue-500 {
    border-color: #3b82f6;
}
.ae .divider-blue-600 {
    border-color: #2563eb;
}
.ae .divider-blue-700 {
    border-color: #1d4ed8;
}
.ae .divider-blue-800 {
    border-color: #1e40af;
}
.ae .divider-blue-900 {
    border-color: #1e3a8a;
}
.ae .divider-blue-950 {
    border-color: #172554;
}
.ae .divider-indigo-50 {
    border-color: #eef2ff;
}
.ae .divider-indigo-100 {
    border-color: #e0e7ff;
}
.ae .divider-indigo-200 {
    border-color: #c7d2fe;
}
.ae .divider-indigo-300 {
    border-color: #a5b4fc;
}
.ae .divider-indigo-400 {
    border-color: #818cf8;
}
.ae .divider-indigo-500 {
    border-color: #6366f1;
}
.ae .divider-indigo-600 {
    border-color: #4f46e5;
}
.ae .divider-indigo-700 {
    border-color: #4338ca;
}
.ae .divider-indigo-800 {
    border-color: #3730a3;
}
.ae .divider-indigo-900 {
    border-color: #312e81;
}
.ae .divider-indigo-950 {
    border-color: #1e1b4b;
}
.ae .divider-violet-50 {
    border-color: #f5f3ff;
}
.ae .divider-violet-100 {
    border-color: #ede9fe;
}
.ae .divider-violet-200 {
    border-color: #ddd6fe;
}
.ae .divider-violet-300 {
    border-color: #c4b5fd;
}
.ae .divider-violet-400 {
    border-color: #a78bfa;
}
.ae .divider-violet-500 {
    border-color: #8b5cf6;
}
.ae .divider-violet-600 {
    border-color: #7c3aed;
}
.ae .divider-violet-700 {
    border-color: #6d28d9;
}
.ae .divider-violet-800 {
    border-color: #5b21b6;
}
.ae .divider-violet-900 {
    border-color: #4c1d95;
}
.ae .divider-violet-950 {
    border-color: #2e1065;
}
.ae .divider-purple-50 {
    border-color: #faf5ff;
}
.ae .divider-purple-100 {
    border-color: #f3e8ff;
}
.ae .divider-purple-200 {
    border-color: #e9d5ff;
}
.ae .divider-purple-300 {
    border-color: #d8b4fe;
}
.ae .divider-purple-400 {
    border-color: #c084fc;
}
.ae .divider-purple-500 {
    border-color: #a855f7;
}
.ae .divider-purple-600 {
    border-color: #9333ea;
}
.ae .divider-purple-700 {
    border-color: #7e22ce;
}
.ae .divider-purple-800 {
    border-color: #6b21a8;
}
.ae .divider-purple-900 {
    border-color: #581c87;
}
.ae .divider-purple-950 {
    border-color: #3b0764;
}
.ae .divider-fuchsia-50 {
    border-color: #fdf4ff;
}
.ae .divider-fuchsia-100 {
    border-color: #fae8ff;
}
.ae .divider-fuchsia-200 {
    border-color: #f5d0fe;
}
.ae .divider-fuchsia-300 {
    border-color: #f0abfc;
}
.ae .divider-fuchsia-400 {
    border-color: #e879f9;
}
.ae .divider-fuchsia-500 {
    border-color: #d946ef;
}
.ae .divider-fuchsia-600 {
    border-color: #c026d3;
}
.ae .divider-fuchsia-700 {
    border-color: #a21caf;
}
.ae .divider-fuchsia-800 {
    border-color: #86198f;
}
.ae .divider-fuchsia-900 {
    border-color: #701a75;
}
.ae .divider-fuchsia-950 {
    border-color: #4a044e;
}
.ae .divider-pink-50 {
    border-color: #fdf2f8;
}
.ae .divider-pink-100 {
    border-color: #fce7f3;
}
.ae .divider-pink-200 {
    border-color: #fbcfe8;
}
.ae .divider-pink-300 {
    border-color: #f9a8d4;
}
.ae .divider-pink-400 {
    border-color: #f472b6;
}
.ae .divider-pink-500 {
    border-color: #ec4899;
}
.ae .divider-pink-600 {
    border-color: #db2777;
}
.ae .divider-pink-700 {
    border-color: #be185d;
}
.ae .divider-pink-800 {
    border-color: #9d174d;
}
.ae .divider-pink-900 {
    border-color: #831843;
}
.ae .divider-pink-950 {
    border-color: #500724;
}
.ae .divider-rose-50 {
    border-color: #fff1f2;
}
.ae .divider-rose-100 {
    border-color: #ffe4e6;
}
.ae .divider-rose-200 {
    border-color: #fecdd3;
}
.ae .divider-rose-300 {
    border-color: #fda4af;
}
.ae .divider-rose-400 {
    border-color: #fb7185;
}
.ae .divider-rose-500 {
    border-color: #f43f5e;
}
.ae .divider-rose-600 {
    border-color: #e11d48;
}
.ae .divider-rose-700 {
    border-color: #be123c;
}
.ae .divider-rose-800 {
    border-color: #9f1239;
}
.ae .divider-rose-900 {
    border-color: #881337;
}
.ae .divider-rose-950 {
    border-color: #4c0519;
}
@media screen and (min-width: 360px) {
    .ae .xs\:d-none {
        display: none;
    }
    .ae .xs\:d-inline {
        display: inline;
    }
    .ae .xs\:d-inline-block {
        display: inline-block;
    }
    .ae .xs\:d-inline-flex {
        display: inline-flex;
    }
    .ae .xs\:d-inline-grid {
        display: inline-grid;
    }
    .ae .xs\:d-inline-table {
        display: inline-table;
    }
    .ae .xs\:d-block {
        display: block;
    }
    .ae .xs\:d-contents {
        display: contents;
    }
    .ae .xs\:d-grid {
        display: grid;
    }
    .ae .xs\:d-flex {
        display: flex;
    }
    .ae .xs\:d-flow-root {
        display: flow-root;
    }
    .ae .xs\:d-list-item {
        display: list-item;
    }
    .ae .xs\:d-table {
        display: table;
    }
    .ae .xs\:d-table-caption {
        display: table-caption;
    }
    .ae .xs\:d-table-column-group {
        display: table-column-group;
    }
    .ae .xs\:d-table-header-group {
        display: table-header-group;
    }
    .ae .xs\:d-table-footer-group {
        display: table-footer-group;
    }
    .ae .xs\:d-table-row-group {
        display: table-row-group;
    }
    .ae .xs\:d-table-cell {
        display: table-cell;
    }
    .ae .xs\:d-table-column {
        display: table-column;
    }
    .ae .xs\:d-table-row {
        display: table-row;
    }
}
@media screen and (min-width: 640px) {
    .ae .sm\:d-none {
        display: none;
    }
    .ae .sm\:d-inline {
        display: inline;
    }
    .ae .sm\:d-inline-block {
        display: inline-block;
    }
    .ae .sm\:d-inline-flex {
        display: inline-flex;
    }
    .ae .sm\:d-inline-grid {
        display: inline-grid;
    }
    .ae .sm\:d-inline-table {
        display: inline-table;
    }
    .ae .sm\:d-block {
        display: block;
    }
    .ae .sm\:d-contents {
        display: contents;
    }
    .ae .sm\:d-grid {
        display: grid;
    }
    .ae .sm\:d-flex {
        display: flex;
    }
    .ae .sm\:d-flow-root {
        display: flow-root;
    }
    .ae .sm\:d-list-item {
        display: list-item;
    }
    .ae .sm\:d-table {
        display: table;
    }
    .ae .sm\:d-table-caption {
        display: table-caption;
    }
    .ae .sm\:d-table-column-group {
        display: table-column-group;
    }
    .ae .sm\:d-table-header-group {
        display: table-header-group;
    }
    .ae .sm\:d-table-footer-group {
        display: table-footer-group;
    }
    .ae .sm\:d-table-row-group {
        display: table-row-group;
    }
    .ae .sm\:d-table-cell {
        display: table-cell;
    }
    .ae .sm\:d-table-column {
        display: table-column;
    }
    .ae .sm\:d-table-row {
        display: table-row;
    }
}
@media screen and (min-width: 768px) {
    .ae .md\:d-none {
        display: none;
    }
    .ae .md\:d-inline {
        display: inline;
    }
    .ae .md\:d-inline-block {
        display: inline-block;
    }
    .ae .md\:d-inline-flex {
        display: inline-flex;
    }
    .ae .md\:d-inline-grid {
        display: inline-grid;
    }
    .ae .md\:d-inline-table {
        display: inline-table;
    }
    .ae .md\:d-block {
        display: block;
    }
    .ae .md\:d-contents {
        display: contents;
    }
    .ae .md\:d-grid {
        display: grid;
    }
    .ae .md\:d-flex {
        display: flex;
    }
    .ae .md\:d-flow-root {
        display: flow-root;
    }
    .ae .md\:d-list-item {
        display: list-item;
    }
    .ae .md\:d-table {
        display: table;
    }
    .ae .md\:d-table-caption {
        display: table-caption;
    }
    .ae .md\:d-table-column-group {
        display: table-column-group;
    }
    .ae .md\:d-table-header-group {
        display: table-header-group;
    }
    .ae .md\:d-table-footer-group {
        display: table-footer-group;
    }
    .ae .md\:d-table-row-group {
        display: table-row-group;
    }
    .ae .md\:d-table-cell {
        display: table-cell;
    }
    .ae .md\:d-table-column {
        display: table-column;
    }
    .ae .md\:d-table-row {
        display: table-row;
    }
}
@media screen and (min-width: 1024px) {
    .ae .lg\:d-none {
        display: none;
    }
    .ae .lg\:d-inline {
        display: inline;
    }
    .ae .lg\:d-inline-block {
        display: inline-block;
    }
    .ae .lg\:d-inline-flex {
        display: inline-flex;
    }
    .ae .lg\:d-inline-grid {
        display: inline-grid;
    }
    .ae .lg\:d-inline-table {
        display: inline-table;
    }
    .ae .lg\:d-block {
        display: block;
    }
    .ae .lg\:d-contents {
        display: contents;
    }
    .ae .lg\:d-grid {
        display: grid;
    }
    .ae .lg\:d-flex {
        display: flex;
    }
    .ae .lg\:d-flow-root {
        display: flow-root;
    }
    .ae .lg\:d-list-item {
        display: list-item;
    }
    .ae .lg\:d-table {
        display: table;
    }
    .ae .lg\:d-table-caption {
        display: table-caption;
    }
    .ae .lg\:d-table-column-group {
        display: table-column-group;
    }
    .ae .lg\:d-table-header-group {
        display: table-header-group;
    }
    .ae .lg\:d-table-footer-group {
        display: table-footer-group;
    }
    .ae .lg\:d-table-row-group {
        display: table-row-group;
    }
    .ae .lg\:d-table-cell {
        display: table-cell;
    }
    .ae .lg\:d-table-column {
        display: table-column;
    }
    .ae .lg\:d-table-row {
        display: table-row;
    }
}
@media screen and (min-width: 1280px) {
    .ae .xl\:d-none {
        display: none;
    }
    .ae .xl\:d-inline {
        display: inline;
    }
    .ae .xl\:d-inline-block {
        display: inline-block;
    }
    .ae .xl\:d-inline-flex {
        display: inline-flex;
    }
    .ae .xl\:d-inline-grid {
        display: inline-grid;
    }
    .ae .xl\:d-inline-table {
        display: inline-table;
    }
    .ae .xl\:d-block {
        display: block;
    }
    .ae .xl\:d-contents {
        display: contents;
    }
    .ae .xl\:d-grid {
        display: grid;
    }
    .ae .xl\:d-flex {
        display: flex;
    }
    .ae .xl\:d-flow-root {
        display: flow-root;
    }
    .ae .xl\:d-list-item {
        display: list-item;
    }
    .ae .xl\:d-table {
        display: table;
    }
    .ae .xl\:d-table-caption {
        display: table-caption;
    }
    .ae .xl\:d-table-column-group {
        display: table-column-group;
    }
    .ae .xl\:d-table-header-group {
        display: table-header-group;
    }
    .ae .xl\:d-table-footer-group {
        display: table-footer-group;
    }
    .ae .xl\:d-table-row-group {
        display: table-row-group;
    }
    .ae .xl\:d-table-cell {
        display: table-cell;
    }
    .ae .xl\:d-table-column {
        display: table-column;
    }
    .ae .xl\:d-table-row {
        display: table-row;
    }
}
@media screen and (min-width: 1536px) {
    .ae .\32 xl\:d-none {
        display: none;
    }
    .ae .\32 xl\:d-inline {
        display: inline;
    }
    .ae .\32 xl\:d-inline-block {
        display: inline-block;
    }
    .ae .\32 xl\:d-inline-flex {
        display: inline-flex;
    }
    .ae .\32 xl\:d-inline-grid {
        display: inline-grid;
    }
    .ae .\32 xl\:d-inline-table {
        display: inline-table;
    }
    .ae .\32 xl\:d-block {
        display: block;
    }
    .ae .\32 xl\:d-contents {
        display: contents;
    }
    .ae .\32 xl\:d-grid {
        display: grid;
    }
    .ae .\32 xl\:d-flex {
        display: flex;
    }
    .ae .\32 xl\:d-flow-root {
        display: flow-root;
    }
    .ae .\32 xl\:d-list-item {
        display: list-item;
    }
    .ae .\32 xl\:d-table {
        display: table;
    }
    .ae .\32 xl\:d-table-caption {
        display: table-caption;
    }
    .ae .\32 xl\:d-table-column-group {
        display: table-column-group;
    }
    .ae .\32 xl\:d-table-header-group {
        display: table-header-group;
    }
    .ae .\32 xl\:d-table-footer-group {
        display: table-footer-group;
    }
    .ae .\32 xl\:d-table-row-group {
        display: table-row-group;
    }
    .ae .\32 xl\:d-table-cell {
        display: table-cell;
    }
    .ae .\32 xl\:d-table-column {
        display: table-column;
    }
    .ae .\32 xl\:d-table-row {
        display: table-row;
    }
}
@media screen and (min-width: 2048px) {
    .ae .\32 k\:d-none {
        display: none;
    }
    .ae .\32 k\:d-inline {
        display: inline;
    }
    .ae .\32 k\:d-inline-block {
        display: inline-block;
    }
    .ae .\32 k\:d-inline-flex {
        display: inline-flex;
    }
    .ae .\32 k\:d-inline-grid {
        display: inline-grid;
    }
    .ae .\32 k\:d-inline-table {
        display: inline-table;
    }
    .ae .\32 k\:d-block {
        display: block;
    }
    .ae .\32 k\:d-contents {
        display: contents;
    }
    .ae .\32 k\:d-grid {
        display: grid;
    }
    .ae .\32 k\:d-flex {
        display: flex;
    }
    .ae .\32 k\:d-flow-root {
        display: flow-root;
    }
    .ae .\32 k\:d-list-item {
        display: list-item;
    }
    .ae .\32 k\:d-table {
        display: table;
    }
    .ae .\32 k\:d-table-caption {
        display: table-caption;
    }
    .ae .\32 k\:d-table-column-group {
        display: table-column-group;
    }
    .ae .\32 k\:d-table-header-group {
        display: table-header-group;
    }
    .ae .\32 k\:d-table-footer-group {
        display: table-footer-group;
    }
    .ae .\32 k\:d-table-row-group {
        display: table-row-group;
    }
    .ae .\32 k\:d-table-cell {
        display: table-cell;
    }
    .ae .\32 k\:d-table-column {
        display: table-column;
    }
    .ae .\32 k\:d-table-row {
        display: table-row;
    }
}
@media screen and (min-width: 3840px) {
    .ae .\34 k\:d-none {
        display: none;
    }
    .ae .\34 k\:d-inline {
        display: inline;
    }
    .ae .\34 k\:d-inline-block {
        display: inline-block;
    }
    .ae .\34 k\:d-inline-flex {
        display: inline-flex;
    }
    .ae .\34 k\:d-inline-grid {
        display: inline-grid;
    }
    .ae .\34 k\:d-inline-table {
        display: inline-table;
    }
    .ae .\34 k\:d-block {
        display: block;
    }
    .ae .\34 k\:d-contents {
        display: contents;
    }
    .ae .\34 k\:d-grid {
        display: grid;
    }
    .ae .\34 k\:d-flex {
        display: flex;
    }
    .ae .\34 k\:d-flow-root {
        display: flow-root;
    }
    .ae .\34 k\:d-list-item {
        display: list-item;
    }
    .ae .\34 k\:d-table {
        display: table;
    }
    .ae .\34 k\:d-table-caption {
        display: table-caption;
    }
    .ae .\34 k\:d-table-column-group {
        display: table-column-group;
    }
    .ae .\34 k\:d-table-header-group {
        display: table-header-group;
    }
    .ae .\34 k\:d-table-footer-group {
        display: table-footer-group;
    }
    .ae .\34 k\:d-table-row-group {
        display: table-row-group;
    }
    .ae .\34 k\:d-table-cell {
        display: table-cell;
    }
    .ae .\34 k\:d-table-column {
        display: table-column;
    }
    .ae .\34 k\:d-table-row {
        display: table-row;
    }
}

*[data-aetheme=dark-cobalt] {
    --theme-color-primary: #0A083A;
    --theme-color-secondary: #3E3B87;
    --theme-color-accent: #3E3B87;
    --theme-color-muted: #B3B2D4;
    --theme-color-text: #DDDEE9;
    --theme-box-shadow: rgba(0, 0, 0, 0.5);
}

*[data-aetheme=dark-coffee] {
    --theme-color-primary: #6C3B06;
    --theme-color-secondary: #311a01;
    --theme-color-accent: #311a01;
    --theme-color-muted: #FFEDD9;
    --theme-color-text: #FDDAC0;
    --theme-box-shadow: rgba(0, 0, 0, 0.5);
}

*[data-aetheme=dark-sunset] {
    --theme-color-primary: #451952;
    --theme-color-secondary: #662549;
    --theme-color-accent: #662549;
    --theme-color-muted: #dab0a7;
    --theme-color-text: #DDDEE9;
    --theme-box-shadow: rgba(0, 0, 0, 0.5);
}

*[data-aetheme=dark-rhino] {
    --theme-color-primary: #27374D;
    --theme-color-secondary: #526D82;
    --theme-color-accent: #526D82;
    --theme-color-muted: #DDE6ED;
    --theme-color-text: #DDDEE9;
    --theme-box-shadow: rgba(0, 0, 0, 0.5);
}

*[data-aetheme=dark-pink] {
    --theme-color-primary: #4C0033;
    --theme-color-secondary: #790252;
    --theme-color-accent: #b81470;
    --theme-color-muted: #DF9AC7;
    --theme-color-text: #DDDEE9;
    --theme-box-shadow: rgba(0, 0, 0, 0.5);
}

*[data-aetheme=dark-hyper-space] {
    --theme-color-primary: #313866;
    --theme-color-secondary: #504099;
    --theme-color-accent: #b82d9e;
    --theme-color-muted: #E7C2FD;
    --theme-color-text: #DDDEE9;
    --theme-box-shadow: rgba(0, 0, 0, 0.5);
}

*[data-aetheme=dark-midnight] {
    --theme-color-primary: #37404a;
    --theme-color-secondary: #727cf5;
    --theme-color-accent: #727cf5;
    --theme-color-muted: #cbdcec;
    --theme-color-text: #DDDEE9;
    --theme-box-shadow: rgba(0, 0, 0, 0.5);
}

*[data-aetheme=light-gray] {
    --theme-color-primary: #ffffff;
    --theme-color-secondary: #f0f0f0;
    --theme-color-accent: #dadada;
    --theme-color-muted: rgba(47, 43, 61, 0.6784313725);
    --theme-color-text: rgba(47, 43, 61, 0.6784313725);
    --theme-box-shadow: rgba(0, 0, 0, 0.15);
}
body {
    height: 100vh !important;
    width: 100vw !important;
    overflow-x: hidden;
}

.ae-menubar[aria-orientation=vertical] > .wrapper-user .user-info[aria-expanded].inactive::after {
    display: none;
}
.ae-menubar[aria-orientation=vertical] > .wrapper-user .user-info[aria-expanded].inactive,
.ae-menubar[aria-orientation=vertical] > .wrapper-user .user-info[aria-expanded].inactive * {
    cursor: auto;
}

#sc-main-content {
    display: flex;
    flex-direction: column;
    height: 100vh;
}
#app-frames {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}
#contrl_abas .tab > a > span {
    word-break: keep-all;
    white-space: nowrap;
    max-width: 120px;
    overflow: hidden;
    text-overflow: ellipsis;
}

.wrapper .label {
    /*max-width: 120px;*/
    /*overflow: hidden;*/
    /*text-overflow: ellipsis;*/
    /*word-break: keep-all;*/
    /*white-space: nowrap;*/
}

.ae-menubar.menubar[aria-orientation="vertical"] {
    /*min-width: 260px*/
}

.logo img {
    visibility: hidden;
}

.ae-menubar.tabsbar {
    display: none;
}
#id_links_abas, #idMenuDown {
    display: none;
}

.show-mobile, .show-mobile-flex {
    display: none;
}

.ae-menubar .user:hover > .mb_icon, .ae-menubar .user:focus-visible > .mb_icon, .ae-menubar .user[aria-expanded=true] > .mb_icon {
    top: 3px;
}
.ae-menubar .user > .mb_icon {
    position: relative;
    top: 7px;
    font-size: 2.15em;
    text-align: center;
    transition: top 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
}
.vertical-orientation .ae-menubar[role=toolbar] > div.wrapper {
    display: flex;
    width: 100%;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    gap: 0.5rem;
}
.button.expand-button {
}
.button.mob-button {
    width: 42px;
    height: 42px;
    justify-content: center;
    align-items: center;
    font-size: 28px !important;
}

.logo img {
    max-height: 48px !important;
}
.ae-menubar[aria-orientation=vertical] > .wrapper-header {
    column-gap: 20px;
}

li.wrapper[disabled="disabled"],
li.result-item[disabled="disabled"] {
    opacity: 0.3;
    pointer-events: none;
}

ul.context-menu-list.context-menu-root {
    background: var(--theme-color-primary);
    color: var(--theme-color-text);
    padding: 0.5rem;
    border: solid 1px rgba(0,0,0,.0);
    border-radius: .25em;
}

ul.context-menu-list.context-menu-root li {
    background: transparent;
    color: var(--theme-color-text);
    border: none;
    border-radius: 4px;
    font-family: arial;
}

ul.context-menu-list.context-menu-root li:hover {
    background: var(--theme-color-accent);
}

.shortcuts-title {
    padding: 20px;
    font-size: 20px;
    border-bottom: solid 1px;
    border-color: var(--theme-color-secondary);
}

ul#shortcuts-list {
    max-height: 400px;
    overflow: auto;
}

.ae-menubar #shortcuts-panel {
    max-height: none;
    overflow: auto;
}

p.shortcut-description {
    height: 58px;
    white-space: nowrap;
    /* width: 30px; */
    overflow: hidden;
    text-overflow: ellipsis;
}

p.shortcut-title i {
    display: flex;
    flex-direction: column;
    height: 40px;
    width: 40px;
    background: rgba(0,0,0,.2);
    align-items: center;
    justify-content: center;
    border-radius: 100%;
}

p.shortcut-title {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 5px;
    align-items: center;
}

p.shortcut-description {
    height: auto;
    flex-direction: column;
    text-align: center;
    align-items: center;
    justify-content: center;
    white-space: normal;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    /* height: 36px; */
}

ul#shortcuts-list {
    column-gap: 1px !important;
    row-gap: 1px !important;
    display: flex;
    background: var(--theme-color-secondary);
}
.ae-menubar #shortcuts-panel #shortcuts-list > .list-item .shortcut-title, .ae-menubar #shortcuts-panel #shortcuts-list > .list-item .shortcut-description {
    word-break: break-word;
    text-align: center;
}
.ae-menubar #shortcuts-panel ul#shortcuts-list > .list-item {
    background-color: var(--theme-color-primary);
    border-radius: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
}

.ae-menubar #shortcuts-panel ul#shortcuts-list > .list-item.dead-item {
    background: var(--theme-color-primary) !important;
}

#shortcuts {
    padding: 1px !important;
}

#user-avatar {
    width: 60px;
    min-width: 60px;
    height: 60px;
}

#context-menu-layer,
.context-menu-list.context-menu-root {
    z-index: 1001 !important;
}
.panel-backdrop-overlay {
    position: fixed;
    background: transparent;
    height: 100vh;
    width: 100vw;
    top: 0;
    left: 0;
    z-index: 1001;
}
.ae-menubar .panel {
    position: fixed;
    z-index: 1002;
}

.ae-menubar .panel *::-webkit-scrollbar {
    width: 4px;
}
.ae-menubar .panel *::-webkit-scrollbar-thumb {
    border-radius: 4px;
    background-color: rgba(255, 255, 255, 0.25);
}
.ae-menubar .panel *::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}

.ae-menubar .main-navigation [role=menuitem] .submenu[role=menu] .submenu[role=menu] {
    top: 0.25em;
    left: calc(100% + 2px);
}
@media only screen and (max-width: 1188px) {
    #esc-button-show {
        display: none;
    }
    .hide-mobile {
        display: none !important;
    }
    .show-mobile {
        display: block !important;
    }
    .show-mobile-flex {
        display: flex !important;
    }
}



iframe.loading {
    height: 0px !important;
}
.loader-placeholder {
    display: none;
    height: 100%;
    width: 100%;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
iframe.loading + .loader-placeholder {
    display: flex;
}



.lds-dual-ring {
    display: inline-block;
    width: 80px;
    height: 80px;
}
.lds-dual-ring:after {
    content: " ";
    display: block;
    width: 64px;
    height: 64px;
    margin: 8px;
    border-radius: 50%;
    border: 6px solid #fff;
    border-color: #fff transparent #fff transparent;
    border-bottom-color: var(--theme-color-accent);
    border-top-color: var(--theme-color-accent);
    animation: lds-dual-ring 1.2s linear infinite;
}
@keyframes lds-dual-ring {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

    </style>
    

  <style type="text/css">
    html,
    body {
      width: 100%;
      height: 100%;
    }

    body{
      background-color: #dee3eb;
    }
    
    .sample-image {
      width: auto;
    }

    .sample-image-third {
      width: calc(33.33% - .5rem);
    }


    .frame-container {
      padding: 0.5rem 0.5rem 0.5rem 0.5rem;
      box-sizing: border-box;
      flex-flow: column nowrap;
      row-gap: .5rem;
      display: flex;
      height: 100vh;
      justify-content: stretch;
      align-items: stretch;
    }

    .frame-container > div ,
    .frame-container > iframe {
      flex-grow: 1;
    }
    .frame-container > div > iframe{
      height: 100%;
      width: 100%;
    }

    .sample-row{
      flex-flow: row nowrap;
      justify-content: center;
      align-items: center;
      column-gap: .65rem;
      display: flex;
    }

    @media only screen and (max-width: 1188px) {
        .ae-menubar[aria-orientation=vertical] {
            position: fixed;
            width: 100vw;
            margin-left: -100vw;
            transition: all ease .3s;
        }
        .ae-menubar.expanded-mob[aria-orientation=vertical] {
            margin-left: 0;
        }

        #sc-main-content {
            padding-left: 0 !important;
        }
        html[dir=RTL] .ae-menubar[aria-orientation=vertical] {
            margin-left: auto;
            margin-right: -100vw;
        }
        html[dir=RTL] .ae-menubar.expanded-mob[aria-orientation=vertical] {
            margin-left: auto;
            margin-right: 0;
        }

        html[dir=RTL] #sc-main-content {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    }
  </style>
  <main>
    <div id="sc-main-content" class="vertical-orientation">
      <section class="ae-menubar menubar" role="toolbar" aria-orientation="vertical" tabindex="0" data-aetheme="dark-rhino">
        <div class="wrapper-header">
          <div class="logo"><a id="sc-menu-link-home" href="./"><span class="only-sr">Scriptcase menubar home </span><img
                class="d-block" src="<?php echo "../_lib/img/usr__NM__bg__NM__kfJZGaCcHOK4AAAAASUVORK5CYII.webp"; ?>" aria-hidden="true" /><img
                class="d-none" src="<?php echo "../_lib/img/usr__NM__bg__NM__kfJZGaCcHOK4AAAAASUVORK5CYII.webp"; ?>" aria-hidden="true" /></a></div>
          <div class="mb_icon fa-solid fa-compress hide-mobile" id="switch-menu-position" aria-label="menu fixo" role="checkbox"
            aria-checked="true"></div>
            <button class="button mob-button show-mobile-flex" style="display: none;" id="close-menu-expand">
                <i class="fas fa-xmark open_menubar_icon"></i>
            </button>
        </div>
          
        <div class="wrapper-navigation ae-menubar-accordion" aria-label="navegação principal">
          <ul role="menubar" aria-label="navegação principal" id="nav_list">

          </ul>
        </div>
      </section>
      <section class="ae-menubar toolbar" role="toolbar" aria-orientation="horizontal" tabindex="0" data-aetheme="dark-rhino">
        <div class="wrapper">
            <button class="button expand-button mob-button show-mobile-flex" style="display: none;">
                <i class="fas fa-bars open_menubar_icon"></i>
            </button>
            <style>
    .header-string-h-text {
        color: var(--theme-color-text);
        font-size: 1rem;
        display: block;
        font-weight: bold;
        word-wrap: break-word;
    }
</style>
<span class="header-string-h-text"><?php echo "Consulta de faltas"; ?></span>
            <div class="bar-spacer"></div>
          <div class="toolbar" role="toolbar" aria-orientation="horizontal" aria-label="barra de ações">
              <div class="group actions" role="group">
                  <?php
                  if(isset($menu_data['tb_items']) && !empty($menu_data['tb_items'])) {
                      foreach ($menu_data['tb_items'] as $_tb_item) {
                          if (isset($_tb_item['display']) && $_tb_item['display']=='S' && isset($_tb_item['app']) && $_tb_item['app'] == 'search') {
                              ?>
                              <button class="button action-button" id="search-button"
                                      aria-label="pesquisar" aria-expanded="false" value="search" aria-controls="search-panel"
                                      aria-owns="search-panel"><i class="mb_icon lni lni-search-alt"
                                                                  aria-hidden="true"></i></button>
                              <?php
                          }
                          elseif (isset($_tb_item['display']) && $_tb_item['display']=='S' && isset($_tb_item['app']) && $_tb_item['app'] == 'languages') {
                              ?>
                              <button class="button action-button" id="translate-button"
                                      aria-label="idiomas" aria-expanded="false" value="translate" aria-controls="translate-panel"
                                      aria-owns="translate-panel"><i class="mb_icon lni lni-world" aria-hidden="true"></i></button>
                              <?php
                          }
                          elseif (isset($_tb_item['display']) && $_tb_item['display']=='S' && isset($_tb_item['app']) && $_tb_item['app'] == 'themes') {
                              ?>
                              <button class="button action-button"
                                      id="themes-button" aria-label="temas" aria-expanded="false" value="themes" aria-controls="themes-panel"
                                      aria-owns="themes-panel"><i class="mb_icon lni lni-paint-roller" aria-hidden="true"></i></button>
                              <?php
                          }
                          elseif (isset($_tb_item['display']) && $_tb_item['display']=='S' && isset($_tb_item['app']) && $_tb_item['app'] == 'notification') {
                              ?>
                              <button
                                      class="button action-button" id="notifications-button" aria-label="notificações" aria-expanded="false"
                                      value="notifications" aria-controls="notifications-panel" aria-owns="notifications-panel"><i
                                          class="mb_icon lni lni-popup" aria-hidden="true"></i></button>
                              <?php
                          }
                          elseif (isset($_tb_item['display']) && $_tb_item['display']=='S' && isset($_tb_item['app']) && $_tb_item['app'] == 'shortcuts') {
                              ?>
                              <button
                                      class="button action-button" id="shortcuts-button" aria-label="ações rápidas" aria-expanded="false"
                                      value="shortcuts" aria-controls="shortcuts-panel" aria-owns="shortcuts-panel"><i
                                          class="mb_icon lni lni-grid-alt" aria-hidden="true"></i></button>
                              <?php
                          }
                      }
                  }
                  ?>
              </div>
          </div>
            <?php
            if ($menu_data['usercheck'] == 'S') {
            ?>
          <div class="user action-button" role="button" id="user-button" aria-label="ações do usuário" aria-expanded="false"
            aria-controls="user-panel" aria-owns="user-panel">
            <img src="<?php echo ""; ?>" class="user_image" />
          </div>
            <?php
            }
            ?>
        </div>
          <?php
          if ($menu_data['usercheck'] == 'S') {
          ?>
        <div class="panel" id="user-panel" role="dialog" aria-label="menu de contexto com ações relativas ao usuário"
          aria-hidden="true">
          <div class="section user-info mx-3">
              <div class="user" id="user-avatar" aria-hidden="true">
                  <img src="<?php echo ""; ?>" class="user_image" />
              </div>
              <div>
                  <p class="user-name"><?php echo ""; ?></p>
                  <p class="user-profile"><?php echo ""; ?></p>
              </div>
          </div>
          <hr class="divider-y divider-solid divider-theme-color" />
          <div class="section actions ae-menubar-accordion">
            <ul role="menubar" aria-label="ações do menu do usuário" id="user_menu_list">
            </ul>
          </div>
          <hr class="divider-y divider-solid divider-theme-color" />
        </div>
          <?php
          }
          ?>
          
<div class="panel" id="themes-panel" role="dialog" aria-label="menu de contexto que permite a troca do tema da barra de menu" aria-hidden="true">
    <div class="section" id="themes">
        <ul id="themes-list">
            <?php
            $count_themes = 0;
            foreach ($var_themes_list as $theme => $data) {
                if (in_array($theme, $menu_data['pick_themes'] )) {
                    $count_themes++;
                    $active = '';
                    if ($menu_data['theme'] == $theme) {
                        $active = 'active';
                    }
                    ?>
                    <li class="theme-name button <?php echo $active; ?>">
                        <a href="javascript:void(0)" data-themeapply="data-themeapply" data-theme="<?php echo $theme; ?>">
                            <?php echo $data['name']; ?>
                            <div class="group">
                                <span style="background:<?php echo $data['p']; ?>"></span>
                                <span style="background:<?php echo $data['s']; ?>"></span>
                                <span style="background:<?php echo $data['a']; ?>"></span>
                            </div>
                        </a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>
<script>


    <?php
    if ($count_themes < 2) {
    ?>
    $(document).ready(function () {
        hideTBButton('themes');
    })
    <?php
    }
    ?>
</script>
          <style>
    .ae-menubar #translate-panel {
        max-height: 360px;
        overflow: auto;
    }
    .ae-menubar .panel > .section .language-name.button {
        text-align: left ;
        justify-content: flex-start;
    }
    .ae-menubar .panel > .section .language-name.button a {
        padding: 0.875rem;
        width: 100%;
    }
    .ae-menubar .panel > .section .language-name.button {
        padding: 0;
    }
    .translate-subtitle {
        font-size: 10px;
    }
</style>
<div class="panel" id="translate-panel" role="dialog" aria-label="menu de contexto que permite a troca do tema da barra de menu" aria-hidden="true">
    <div class="section" id="themes">
        <input type="hidden" name="id_nmgp_idioma" id="id_nmgp_idioma" value="" />
        <ul id="languages-list">
            <?php
            $count_lang = 0;
            foreach ($this->Nm_lang_conf_region as $lang => $name) {
                $count_lang++;
                $active = '';
                $lang_temp = explode(';', $lang);
                if ($_SESSION['scriptcase']['str_lang'] == $lang_temp[0]) {
                    $active = 'active';
                }

                if (!empty($_SESSION['scriptcase']['charset']) && $_SESSION['scriptcase']['charset'] != 'UTF-8') {
//                    $name = mb_convert_encoding($name, $_SESSION['scriptcase']['charset'], 'UTF-8');
                    $name = json_encode($name, 2097152);
                    $name = substr($name, 1, -1);
                    $name = str_replace('\\/','/',  $name);
                    $name = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
                        return '&#x'.$match[1].';';
                    }, $name);
                }
                $name = preg_match('/^([\w]*[\/]?[^\-]*) - ([^\r\n]*)/',  $name, $matches_translate);
                ?>
                <li class="language-name button <?php echo $active; ?>">
                    <a href="javascript:changeLang('<?php echo $lang; ?>')" data-themeapply="data-themeapply" >
                        <strong><?php echo $matches_translate[1]; ?></strong>
                        <div class="translate-subtitle"><?php echo $matches_translate[2]; ?></div>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>
<script>
    <?php
    if ($count_lang < 2) {
    ?>
    $(document).ready(function () {
        hideTBButton('translate');
    })
    <?php
    }
    ?>
    function Nm_change_lang_locale()
    {
        var str_location = window.location.toString();
        if (str_location.indexOf('script_case_init') == -1)
        {
            document.Nm_frm_change_lang_locale.hid_scr_iframe.value = str_location + (str_location.indexOf('?') > -1 ? '&' : '?');
        }
        else
        {
            document.Nm_frm_change_lang_locale.hid_scr_iframe.value = str_location;
        }
        document.Nm_frm_change_lang_locale.nmgp_idioma.value = document.getElementById("id_nmgp_idioma").value;
        document.Nm_frm_change_lang_locale.submit();
    }
    function changeLang(langVal) {
        $('#id_nmgp_idioma').val(langVal);
        Nm_change_lang_locale();
    }
</script>
          <div class="panel" id="shortcuts-panel" role="dialog" aria-label="menu de contexto com os principais atalhos"
     aria-hidden="true">
    <div class="section" id="shortcuts">
        <?php
        if ($menu_data['check_shortcut_label'] == 'S') {
        ?>
        <div class="shortcuts-title">
            <span><?php echo $this->Nm_lang['lang_othr_menu_shortcuts']; ?></span>
        </div>
        <?php
        }
        ?>
        <ul class="column" id="shortcuts-list">

            <?php

            function safeChars($input) {
                global $apl_charset;
                $out = $input;
                $out = str_replace('"', '__##NM_D##__',$out);
                $out = str_replace("'", '__##NM_S##__',$out);

                return $out;
            }

            function flattenMenu($input) {
                $items_flat = [];
                foreach ($input as $data) {
                    $children = isset($data['itens']) ? $data['itens'] : [];
                    $data['itens'] = [];
                    $items_flat[$data['id']] = $data;
                    $children = flattenMenu($children);
                    foreach ($children as $child) {
                        $items_flat[$child['id']] = $child;
                    }
                }
                return $items_flat;
            }
            $flat_items = flattenMenu(json_decode($menu_itens, true));
            $var_targets_arr = json_decode($var_targets, true);

            $count_fav = 0;
            foreach ($menu_data['shortcuts'] as $fav) {
                if (array_key_exists($fav, $flat_items)) {
                    $get_item = $flat_items[$fav];
                    if ($get_item['disabled'] != 'Y' && $get_item['fav_check'] == 'S') {
                        $count_fav++;
                        $ico = '';
                        $icotab = '';

                        if (!empty($_SESSION['scriptcase']['charset']) && $_SESSION['scriptcase']['charset'] != 'UTF-8') {
                            $get_item['label'] = json_encode($get_item['label'], 2097152);
                            $get_item['label'] = substr($get_item['label'], 1, -1);
                            $get_item['label'] = str_replace('\\/','/',  $get_item['label']);
                            $get_item['label'] = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
                                return '&#x'.$match[1].';';
                            }, $get_item['label']);
                            $get_item['hint'] = json_encode($get_item['hint'], 2097152);
                            $get_item['hint'] = substr($get_item['hint'], 1, -1);
                            $get_item['hint'] = str_replace('\\/','/',  $get_item['hint']);
                            $get_item['hint'] = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
                                return '&#x'.$match[1].';';
                            }, $get_item['hint']);
                        }
                        if ($get_item['icon_check'] == 'S' && !empty($get_item['icon_fa'])) {
                            $ico = '<i class="'.$get_item['icon_fa'].' m-right-1.5"></i>';
                            $icotab = $ico;
                        } else {
                            $ico = '<i class="'.$get_item['icon_fa'].' m-right-1.5" style="visibility: hidden;"></i>';
                            $icotab = '';
                        }

                        $onclick_item = "clickFavLink('".safeChars($get_item['link'])."', '".safeChars($get_item['id'])."', '".safeChars($get_item['label'])."', '".safeChars($get_item['hint'])."', '".safeChars($icotab)."', '".$var_targets_arr[$get_item['link_target']]."', event);";

                        ?>
                        <li class="list-item">
                            <a href="<?php echo $get_item['link']; ?>" onclick="<?php echo $onclick_item; ?>" target="<?php echo $var_targets_arr[$get_item['link_target']]; ?>">
                                <p class="shortcut-title">
                                    <?php echo $ico; ?>
                                    <span><?php echo $get_item['label']; ?></span>
                                </p>
                                <p class="shortcut-description" title="<?php echo $get_item['hint']; ?>">
                                    <?php echo $get_item['hint']; ?>
                                </p>
                            </a>
                        </li>
                        <?php
                    }
                }
            }
            if ($count_fav%2 > 0) {

                ?>
                <li class="list-item dead-item"></li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>
<script>
    <?php
    if ($count_fav == 0) {
    ?>
    $(document).ready(function () {
        hideTBButton('shortcuts');
    })
    <?php
    }
    ?>
    function clickFavLink(url, tabName, tabTitle, tabHint, tabIcon, tabTarget, e) {
        url = url.replaceAll('__##NM_D##__','"').replaceAll('__##NM_S##__',"'");
        tabName = tabName.replaceAll('__##NM_D##__','"').replaceAll('__##NM_S##__',"'");
        tabTitle = tabTitle.replaceAll('__##NM_D##__','"').replaceAll('__##NM_S##__',"'");
        tabIcon = tabIcon.replaceAll('__##NM_D##__','"').replaceAll('__##NM_S##__',"'");
        tabTarget = tabTarget.replaceAll('__##NM_D##__','"').replaceAll('__##NM_S##__',"'");
        SCMenubar.closePanel();
        if (tabTarget == '_self' && (url == '#' || url == '')) {
            window.close();
        }
        if (typeof openInTab == 'function') {
            if (tabTarget == 'nm_frame_app') {
                e.preventDefault();
                e.stopPropagation();
                openInTab(url, tabName, tabTitle, tabHint, tabIcon, tabTarget);
            }
        } else {
            if (tabTarget == 'nm_frame_app') {
                handleLinks(tabName);
            }
        }
    }
</script>
          <style>
    .ae-menubar #search-panel > #search-result .result-links > .result-item a {
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        gap: 0.25rem;
    }

    .ae-menubar #search-panel > #search-result .result-links > .result-item a .search-item-result-label {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        word-break: break-word;
        flex-wrap: nowrap;
    }

    .ae-menubar #search-panel > #search-result .result-links > .result-item a .search-item-parents-list {
        font-size: .725rem;
        opacity: .45;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        gap: 0.25rem;
        padding-left: 0rem;
        flex-wrap: wrap;
    }

    .ae-menubar #search-panel > #search-result .result-links > .result-item a .search-item-parents-list .parent-list-item {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        gap: 0.25rem;
        background: var(--theme-color-secondary);
        padding: 0 0.5rem;
        border-radius: 4px;
    }

    .ae-menubar #search-panel > #search-result .result-links > .result-item a .search-item-parents-list .parent-list-item i {
        font-size: .55rem;
    }

    .ae-menubar #search-panel > #search-result .result-links > .result-item a .search-item-parents-list .parent-list-separator {

    }
</style>
<div class="panel" id="search-panel" role="dialog" aria-label="caixa de busca para itens do menu" aria-hidden="true" data-keep-open="true">
    <div class="section" id="search">
        <i class="lni lni-search-alt m-4"></i>
        <input type="text" id="main-search" autocomplete="off" />
        <a href="javascript:void(0)" data-close="search-button">
            <span id="esc-button-show" class="text">[esc]</span>
            <i class="fa-regular fa-circle-xmark"></i>
        </a>
    </div>
    <div class="section" id="search-result">
        <ul class="result-links"></ul>
    </div>
</div>
<script>

    function buildParents(parents, data) {
        var ret_el = document.createElement("span");
        var first = true;
        ret_el.classList.add('search-item-parents-list');

        parents.forEach(function(unit) {
            var obj = data.find(function(x) {
                return x.id == unit;
            });
            var section_el = document.createElement("span");
            section_el.classList.add('parent-list-item');
            if (first) {
                first = false;
            } else {
                var separator = document.createElement("span");
                var sep_ico = document.createElement("i");
                sep_ico.classList.add('fa-solid', 'fa-arrow-right');
                separator.classList.add('parent-list-separator');
                separator.append(sep_ico);
                ret_el.append(separator);
            }
            if (obj.icon_check == 'S') {
                var iconClass = obj.icon_fa.split(" ");
                var icon = document.createElement("i");
                icon.classList.add(iconClass[0], iconClass[1]);
                section_el.append(icon);
            }
            section_el.append(obj.label);
            ret_el.append(section_el);
        });
        return ret_el;
    }
    function searchInit() {
        var data = flattenItems(items_data);
        var mainSearch = document.getElementById("main-search");
        var resultContainer = document.querySelector("#search-result .result-links");
        var fuse = new Fuse(data, {
            keys: ['label'],
            threshold: 0.3
        });

        mainSearch.addEventListener("input", ev => {
            var searchTerm = ev.target.value;

            resultContainer.innerHTML = "";

            var searchResults = fuse.search(searchTerm);

            searchResults.forEach(result => {
                var li = document.createElement("li");
                var link = document.createElement("a");
                var linkIcon = document.createElement("i");
                var url = result.item.link;
                var disabled = result.item.disabled == 'Y';
                var hasChildren = Object.values(result.item.itens).length > 0;
                var parents = result.item.parent_list;
                var tabName = result.item.id;
                var tabTitle = result.item.label;
                var tabHint = result.item.hint;
                var tabTarget = getTarget(result.item.link_target);
                var tabIcon = '';
                if (!hasChildren) {
                    var span_item = document.createElement("span");
                    span_item.classList.add('search-item-result-label');
                    if (result.item.icon_check == 'S') {
                        var iconFa = document.createElement("i");
                        var iconFaClass = result.item.icon_fa.split(" ");
                        var tabIcon = document.createElement("i")
                        iconFa.classList.add(iconFaClass[0], iconFaClass[1]);
                        tabIcon.classList.add(iconFaClass[0], iconFaClass[1]);
                        tabIcon = tabIcon.outerHTML;
                        span_item.append(iconFa);
                        // link.insertAdjacentElement("beforeend", buildParents(parents, data));
                    } else {
                        tabIcon = ''
                    }
                    if (tabTarget == '_self' && (url == '#' || url == '')) {
                        link.addEventListener('click', function (e) {
                            window.close();
                        });
                    } else {
                        if (typeof openInTab == 'function') {
                            link.addEventListener('click', function (e) {
                                if (tabTarget == 'nm_frame_app') {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    SCMenubar.closePanel();
                                    openInTab(url, tabName, tabTitle, tabHint, tabIcon, tabTarget);
                                }
                            });
                        } else {
                            link.addEventListener('click', function (e) {
                                if (tabTarget == 'nm_frame_app') {
                                    handleLinks(tabName);
                                    SCMenubar.closePanel();
                                }
                            });
                        }
                    }
                    span_item.append(result.item.label);
                    link.append(span_item);
                    <?php if ($menu_data['check_show_search_path'] == 'S') { ?>
                        link.append(buildParents(parents, data));
                    <?php } ?>
                    li.classList.add("result-item");
                    if (disabled) {
                        $(li).attr("disabled", 'disabled');
                    }
                    if (targets_list[result.item.link_target] !== undefined) {
                        link.setAttribute('target', targets_list[result.item.link_target]);
                    }
                    else
                    {
                        link.setAttribute('target', result.item.link_target);
                    }

                    link.setAttribute("href", result.item.link);
                    li.appendChild(link);
                    resultContainer.appendChild(li);
                }
            })
        });
    }
</script>
      </section>
    <section class="ae-menubar tabsbar" data-aetheme="dark-rhino" style="" aria-orientation="horizontal">
        
    </section>
        
      <div class="frame-container"  id="app-frames" data-aetheme="dark-rhino">
        <iframe class="nm_frame_app" name="nm_frame_app" src="" frameborder="0"></iframe>
          <div class="loader-placeholder"><div class="lds-dual-ring"></div></div>
      </div>
    </div>
  </main>
    <script>
        var items_data = <?php echo $menu_itens; ?>;
        var user_menu_data = <?php echo $user_itens; ?>;
        var targets_list = <?php echo $var_targets; ?>;
        var apl_default = '<?php echo $apl_default; ?>';
        var use_load = ('<?php echo $menu_data["check_use_loader"]; ?>' == 'S');
        var should_reload = ('<?php echo $menu_data["should_reload"]; ?>' != 'S');
        var start_expanded = ('<?php echo $menu_data["check_start_expanded"]; ?>' == 'S');
    </script>
    <script>
        
var Menubar = class {
    static #config;
    static #settings;
    static #animationShow;
    static #animationName;
    static #menubar;
    static #menubarVertical;
    static #toolbar;
    static #mainNavigation;
    static #mobileButton;
    static #mobileNavigation;
    static #actionButton;
    static #userPanel;
    static #accordion;
    static #collapseMenu;
    static #submenus;


    closePanel() {
        this.#closepanelOpened();
    }
    constructor(settings) {
        Menubar.#config = this.#configs();
        Menubar.#settings = { ...Menubar.#config.settings, ...settings };
        Menubar.#animationShow = Menubar.#settings.animation.show !== undefined ? Menubar.#settings.animation.show : Menubar.#config.settings.animation.show;
        Menubar.#animationName = Menubar.#settings.animation.name ? Menubar.#settings.animation.name : Menubar.#config.settings.animation.name;
        Menubar.#menubar = document.querySelector(Menubar.#config.selectors.menubar);
        Menubar.#menubarVertical = document.querySelector(Menubar.#config.selectors.menubarVertical);
        Menubar.#toolbar = document.querySelector(Menubar.#config.selectors.toolbar);
        Menubar.#mainNavigation = Menubar.#menubar.querySelector(Menubar.#config.selectors.mainNavigation);
        Menubar.#mobileButton = Menubar.#menubar.querySelector(Menubar.#config.selectors.mobileButton);
        Menubar.#mobileNavigation = Menubar.#menubar.querySelector(Menubar.#config.selectors.mobileNavigation);
        Menubar.#actionButton = document.querySelectorAll(Menubar.#config.selectors.actionButton);
        Menubar.#accordion = document.querySelectorAll(Menubar.#config.selectors.accordion);
        Menubar.#collapseMenu = Menubar.#menubar.querySelector(Menubar.#config.selectors.switchMenuPosition);
        Menubar.#submenus = Menubar.#menubar.querySelectorAll(Menubar.#config.selectors.submenu);

        // init
        this.#init();
    };

    /**
     * Método de configuração
     * @private
     * @returns {object} config
     */
    #configs() {
        const config = {
            selectors: {
                menubar: '.ae-menubar',
                menubarVertical: '.ae-menubar.menubar[aria-orientation="vertical"]',
                toolbar: '.ae-menubar [role="toolbar"]',
                mainNavigation: '.main-navigation',
                hasSubmenu: '[role="menuitem"][aria-haspopup="true"]',
                isActive: '[role="menuitem"][data-active="true"]',
                mobileButton: '.menu-mobile-control',
                mobileButtonIconControl: '#hamburger-icon-control',
                mobileNavigation: '.ae-menu-mobile',
                mobileNavigationOverlay: '#mobile-navigation-overlay',
                panels: '.panel',
                actionButton: '.action-button',
                userActionsMenu: '.section.actions',
                accordion: '.ae-menubar-accordion',
                switchMenuPosition: '#switch-menu-position',
                wrapperUser: '.wrapper-user',
                userButton: '.user.action-button',
                userMenu: '.user-menu',
                userInfo: '.user-info',
                userMenuContent: '.user-menu-content',
                submenu: '.submenu',
            },
            menubar: {
                loadingTime: 500
            },
            settings: {
                keepOpen: false,
                animation: {
                    show: true,
                    name: 'slide-left'
                },
                overlay: {
                    show: true,
                    bgColor: 'rgba(0,0,0,.55)'
                },
                panel: {
                    offset: 4, //pixels
                    animation: 'slide-right-top'
                }
            },
            layers: {
                layer_1: 'layer-900',
                layer_2: 'layer-800',
            },
            animation: {
                className: [
                    'slide-top-bouncy',
                    'slide-right-bouncy',
                    'slide-bottom-bouncy',
                    'slide-left-bouncy',
                    'slide-top',
                    'slide-right',
                    'slide-bottom',
                    'slide-left',
                    'reveal-opacity',
                    'reveal-blur'
                ],
                duration: 650,
            }
        }
        return config;
    }

    #init() {
        // inic. métodos
        // -----------------------------------
        if (Menubar.#menubar && Menubar.#menubar.classList.contains('menubar') && Menubar.#menubar.getAttribute('aria-orientation') === 'horizontal') {
            if (Menubar.#mainNavigation) {
                this.#responsiveObserver()
            } else if (Menubar.#mobileNavigation) {
                Menubar.#mobileButton.style.display = 'grid';
                Menubar.#mobileNavigation.style.top = `${Menubar.#menubar.getBoundingClientRect().height}px`;
                Menubar.#mobileNavigation.classList.add(Menubar.#config.layers.layer_1);
            }
        }

        if (Menubar.#menubar.getAttribute('aria-orientation') === 'horizontal') {
            this.#submenusCheckVisibilityInViewport()
        }

        if (Menubar.#mobileButton && Menubar.#mobileNavigation) {
            this.#mobileControl();

            document.addEventListener('click', () => {
                if (Menubar.#mobileButton.getAttribute('aria-pressed') === 'true') {
                    Menubar.#mobileButton.click();
                }
            });
        }

        if (Menubar.#accordion) {
            Menubar.#accordion.forEach(accordion => {
                this.#menubarAccordion(accordion);
            });
        }

        if (Menubar.#menubarVertical) {
            if (Menubar.#collapseMenu) {
                Menubar.#collapseMenu.addEventListener('click', () => {

                    if (Menubar.#collapseMenu.getAttribute('aria-checked') === 'false') {
                        Menubar.#collapseMenu.setAttribute('aria-checked', 'true');
                        Menubar.#collapseMenu.classList.remove('fa-expand');
                        Menubar.#collapseMenu.classList.add('fa-compress');
                    } else {
                        Menubar.#collapseMenu.setAttribute('aria-checked', 'false');
                        Menubar.#collapseMenu.classList.remove('fa-compress');
                        Menubar.#collapseMenu.classList.add('fa-expand');
                    }

                    if (Menubar.#menubarVertical.getAttribute('data-collapsible') === 'true') {
                        Menubar.#menubarVertical.setAttribute('data-collapsible', 'false');
                    } else {
                        Menubar.#menubarVertical.setAttribute('data-collapsible', 'true');
                    }

                    this.#collapsibleMenu();
                });
            }

            Menubar.#menubarVertical.addEventListener('mouseenter', () => {
                if (Menubar.#menubarVertical.classList.contains('collapsed')) {
                    this.#collapsibleMenu();
                }
            });
            Menubar.#menubarVertical.addEventListener('mouseleave', () => {
                if (Menubar.#menubarVertical.classList.contains('expanded')) {
                    this.#collapsibleMenu();
                }
            });

            if (Menubar.#menubarVertical.querySelector(Menubar.#config.selectors.wrapperUser)) {
                this.#userMenu();
            }
        }

        if (document.querySelectorAll(`${Menubar.#config.selectors.menubar} ${Menubar.#config.selectors.panels}`).length !== 0) {
            this.#panel();

            document.addEventListener('click', () => {
                const keepOpened = document.querySelector("[data-keep-open='true']");

                if (keepOpened.style.visibility === "hidden" || keepOpened.style.visibility === "") {
                    this.#closepanelOpened();
                }
            });
        }

        this.#close();

        // Configurações do objeto
        // -----------------------------------
        Object.preventExtensions(this);
    }

    /**
     * Controla a responsividade da barra de menu e de seus elementos
     * @private
     */
    #responsiveObserver() {
        const gridGap = window.getComputedStyle(Menubar.#menubar.firstElementChild).columnGap;
        const menubarSplit = document.querySelector('.ae-menubar.menubar.split');

        const mainNavigationControl = (visibility) => {
            if (visibility === 'show') {
                Menubar.#mobileButton.style.display = 'none';
                Menubar.#mainNavigation.style.display = 'flex';
                Menubar.#mainNavigation.classList.remove('hide');
                Menubar.#mainNavigation.removeAttribute('aria-hidden');
                Menubar.#mainNavigation.removeAttribute('aria-hidden');
            } else if (visibility === 'hide') {
                Menubar.#mobileButton.style.display = 'grid';
                Menubar.#mainNavigation.style.display = 'none';
                Menubar.#mainNavigation.classList.add('hide');
                Menubar.#mainNavigation.classList.remove('show');
                Menubar.#mainNavigation.setAttribute('aria-hidden', 'true');
            }
        }

        const responseMobile = () => {
            //oculta mainNavigation
            mainNavigationControl('hide');
        };

        setTimeout(() => {
            let menubarMinWidth = null;

            if (menubarSplit) {
                menubarMinWidth = Menubar.#mainNavigation.offsetWidth;
            } else {
                menubarMinWidth = sumElementsWidth(Array.from(Menubar.#menubar.children).splice(0, 2));
            }

            const mobileObserver = new ResizeObserver(entries => {
                entries.forEach(entry => {
                    if (entry.target.classList.contains((Menubar.#config.selectors.menubar).replace('.', ''))) {
                        if (menubarMinWidth > entry.borderBoxSize[0].inlineSize) {
                            responseMobile();
                        } else {
                            mainNavigationControl('show');
                            if (Menubar.#mobileNavigation && Menubar.#mobileButton.getAttribute('aria-pressed') === 'true') {
                                this.#mobileButtonControl();
                                this.#mobileNavigationControl();
                            }
                        }
                    }
                });
            });
            mobileObserver.observe(Menubar.#menubar);

            if (Menubar.#mobileNavigation) {
                Menubar.#mobileNavigation.style.top = `${Menubar.#menubar.getBoundingClientRect().height}px`;
                Menubar.#mobileNavigation.classList.add(Menubar.#config.layers.layer_1);
            }

        }, Menubar.#config.menubar.loadingTime);
    }

    /**
     * Controla o botão de disparo do menu mobile
     * @private
     */
    #mobileButtonControl() {
        const mobileButtonIconControl = Menubar.#mobileButton.querySelector(Menubar.#config.selectors.mobileButtonIconControl);
        let ariaPressed = Menubar.#mobileButton.getAttribute('aria-pressed');

        if (ariaPressed === 'true') {
            Menubar.#mobileButton.setAttribute('aria-pressed', 'false');
            mobileButtonIconControl.checked = false;

        } else {
            Menubar.#mobileButton.setAttribute('aria-pressed', 'true');
            mobileButtonIconControl.checked = true;
        }
    }

    /**
     * Controla a visibilidade e animação da navegação mobile
     * @private
     */
    #mobileNavigationControl() {
        const overlayShow = Menubar.#settings.overlay.show !== undefined ? Menubar.#settings.overlay.show : Menubar.#config.settings.overlay.show;

        const showMobile = () => {
            // props
            Menubar.#mobileNavigation.setAttribute('aria-hidden', 'false');
            Menubar.#mobileNavigation.setAttribute('data-show', 'true');
            if (!Menubar.#animationShow) {
                Menubar.#mobileNavigation.style.setProperty('display', 'block');
            }
            // adiciona overlay
            if (overlayShow) {
                document.body.appendChild(this.#createOverlay());
                Menubar.#mobileButton.classList.add(Menubar.#config.layers.layer_1);
            }
            // Fecha o painel aberto
            this.#closepanelOpened();
        }
        const hideMobile = () => {
            // props
            Menubar.#mobileNavigation.setAttribute('aria-hidden', 'true');
            Menubar.#mobileNavigation.setAttribute('data-show', 'false');
            if (!Menubar.#animationShow) {
                Menubar.#mobileNavigation.style.setProperty('display', 'none');
            }
            // remove overlay
            if (overlayShow) {
                this.#removeOverlay(document.getElementById(Menubar.#config.selectors.mobileNavigationOverlay));
            }
        }

        if (Menubar.#mobileNavigation.getAttribute('data-show') === 'false') {
            showMobile();
        }
        else {
            hideMobile();
        }

        // controle de animação
        if (Menubar.#animationShow) {
            this.#animationClassControl(Menubar.#mobileNavigation);
        }
    }

    /**
     * Controla o status do botão mobile, a exibição do menu mobile e configurações iniciais do menu
     * @private
     */
    #mobileControl() {
        if (Menubar.#mobileButton) {
            Menubar.#mobileButton.addEventListener('click', () => {
                event.preventDefault();
                event.stopImmediatePropagation();
                this.#mobileButtonControl();
                this.#mobileNavigationControl();
                this.#isActive();
            });
        }

        if (Menubar.#mobileNavigation) {
            const mainNavMobile = Menubar.#mobileNavigation.querySelector('.main-navigation-mobile');
            mainNavMobile.style.paddingBottom = `${parseInt(window.getComputedStyle(mainNavMobile).paddingBottom.replace('px', '')) + Menubar.#menubar.offsetHeight}px`;
        }
    }

    /**
     * Expande ou colapsa o submenu da navegação mobile
     * @private
     */
    #menubarAccordion(element) {
        if (element) {
            const hasSubmenu = element.querySelectorAll(Menubar.#config.selectors.hasSubmenu);
            let animExpandId = null;

            if (hasSubmenu) {
                hasSubmenu.forEach(menuitem => {
                    // Funcionalidades
                    // ----------------------------------------------
                    function toggle() {
                        const nestingSubmenuOpen = menuitem.nextElementSibling.querySelectorAll('.submenu.isOpen');
                        let start;

                        // accordion: animações
                        // -----------------------
                        const animExpand = (timestamp) => {
                            if (start === undefined) { start = timestamp };

                            const elapsed = timestamp - start;

                            if (menuitem.nextElementSibling.offsetHeight < menuitem.nextElementSibling.firstElementChild.offsetHeight) {
                                menuitem.nextElementSibling.style.height = `${menuitem.nextElementSibling.offsetHeight + Math.round(0.1 * elapsed)}px`;
                                menuitem.classList.add('animating');
                                animExpandId = requestAnimationFrame(animExpand);
                            }
                            // aplica altura flexível para comportar automaticamente a altura dos submenus aninhados (filhos)
                            if (menuitem.nextElementSibling.offsetHeight >= menuitem.nextElementSibling.firstElementChild.offsetHeight) {
                                menuitem.nextElementSibling.style.height = '100%';
                                menuitem.classList.remove('animating');
                            }
                        };
                        const animCollapse = (timestamp) => {
                            if (start === undefined) { start = timestamp };

                            const elapsed = timestamp - start;

                            if (menuitem.nextElementSibling.offsetHeight > 0) {
                                menuitem.nextElementSibling.style.height = `${menuitem.nextElementSibling.offsetHeight - Math.round(0.1 * elapsed)}px`;
                                menuitem.classList.add('animating');
                                requestAnimationFrame(animCollapse);
                            }
                            // verifica se o resultado da subtração é um número negativo e iguala altura a zero
                            if (Math.sign(menuitem.nextElementSibling.offsetHeight - Math.round(0.1 * elapsed)) === -1) {
                                menuitem.nextElementSibling.style.height = '0px';
                                menuitem.classList.remove('animating');
                            }
                        };
                        // -----------------------

                        // accordion: expande submenu
                        if (menuitem.nextElementSibling.offsetHeight === 0) {
                            requestAnimationFrame(animExpand);
                            menuitem.setAttribute('aria-expanded', 'true');
                            menuitem.nextElementSibling.firstElementChild.setAttribute('aria-hidden', 'false');
                        }
                        // accordion: colapsa submenu
                        else {
                            if (!Menubar.#settings.keepOpen) {
                                //fechar todos os submenus aninhados
                                let nestedMenuitems = menuitem.parentElement.querySelectorAll('[role="menuitem"][aria-haspopup="true"][aria-expanded="true"]');
                                nestedMenuitems = Array.from(nestedMenuitems);
                                for (let i = 1; i < nestedMenuitems.length; i++) {
                                    nestedMenuitems[i].click();
                                }
                            }
                            requestAnimationFrame(animCollapse);
                            menuitem.setAttribute('aria-expanded', 'false');
                            menuitem.nextElementSibling.firstElementChild.setAttribute('aria-hidden', 'true');
                        }
                        //submenu aninhado
                        if (menuitem.parentElement.parentElement.classList.contains('submenu')) {
                            const globalWrapper = menuitem.parentElement.parentElement.parentElement;

                            if (!menuitem.nextElementSibling.firstElementChild.classList.contains('isOpen')) {
                                menuitem.nextElementSibling.firstElementChild.classList.add('isOpen');
                            }
                            else {
                                menuitem.nextElementSibling.firstElementChild.classList.remove('isOpen');
                            }
                        }
                    }

                    // Eventos
                    // ----------------------------------------------
                    menuitem.addEventListener('click', () => {
                        event.stopPropagation();
                        toggle();
                    })
                })
            }
        }
    }

    /**
     * Verifica a visibilidade dos submenus em relação a viewport, e corrige sua posição horizontal
     */
    #submenusCheckVisibilityInViewport() {
        function isElementPartiallyInViewport(el) {
            const rect = el.getBoundingClientRect();

            return (
                (rect.left + rect.width) <= window.innerWidth
            );
        }

        function checkSubmenusVisibility() {
            Menubar.#submenus.forEach(submenu => {
                submenu.style.removeProperty("right");
                submenu.style.removeProperty("left");

                if (!isElementPartiallyInViewport(submenu)) {
                    submenu.style.setProperty("right", "calc(100% - 0.5em)");
                    submenu.style.setProperty("left", "auto");
                }
            });
        }

        const menuitens = document.querySelectorAll(".ae-menubar[aria-orientation='horizontal'] [role='menuitem']");

        menuitens.forEach(menuitem => {
            menuitem.addEventListener('mouseenter', checkSubmenusVisibility);
        })
    }

    /**
     * Fecha o elemento aberto ao apertar a tecla ESC (menubar e/ou painel)
     * @private
     */
    #close() {
        const closeAll = () => {
            // fecha o menu mobile
            if (Menubar.#mobileNavigation && Menubar.#mobileNavigation.getAttribute('data-show') === 'true') {
                Menubar.#mobileButton.click();
            }

            // fecha painel aberto
            this.#closepanelOpened();
        }

        window.addEventListener('keydown', () => {
            if (event.keyCode === 27) {
                closeAll();
            }
        });
    }

    /**
     * Fecha o painel aberto
     */
    #closepanelOpened() {
        const panelOpeneds = document.querySelectorAll(`${Menubar.#config.selectors.panels}[is-open]`);

        if (panelOpeneds) {
            panelOpeneds.forEach(panel => {
                const evtDispatch = new CustomEvent('panel-closed', {detail: {panel: panel}});
                document.querySelector(`[aria-owns="${panel.getAttribute('id')}"]`).click();
                document.dispatchEvent(evtDispatch);
            });
        }
    }

    /**
     * Configura e controla comportamentos padrões de painéis da toolbar
     * @private
     */
    #panel() {
        const panelAnimationName = Menubar.#settings.panel.animation;
        let panelCloseButton = null;

        const addClass = (panel) => {
            if (panel) {
                panel.classList.add(panelAnimationName);
            } else {
                event.target.classList.add(panelAnimationName);
            }
        }
        const removeClass = (panel) => {
            if (panel) {
                panel.classList.remove(panelAnimationName);
            } else {
                event.target.classList.remove(panelAnimationName);
            }
        }
        const startAnimation = (event) => {
            removeClass();
            event.target.removeEventListener('animationend', startAnimation);
        }
        const endAnimation = (event) => {
            removeClass();
            event.target.style.opacity = '0';
            event.target.style.visibility = 'hidden';
            event.target.removeEventListener('animationend', endAnimation);
        }
        const setPanelPosition = (panel, button) => {

            let offsetTop;

            if (document.querySelector('.ae-menubar.menubar[aria-orientation="horizontal"]')) {
                if (document.querySelector('.ae-menubar.menubar.split')) {
                    offsetTop = `${((parseInt(window.getComputedStyle(document.querySelector('.ae-menubar.menubar')).height.replace('px', ''))) / 2) + Menubar.#settings.panel.offset}px`
                } else {
                    offsetTop = `${(parseInt(window.getComputedStyle(document.querySelector('.ae-menubar.menubar')).height.replace('px', ''))) + Menubar.#settings.panel.offset}px`
                }
            } else {
                offsetTop = `${(parseInt(window.getComputedStyle(document.querySelector('.ae-menubar.toolbar')).height.replace('px', ''))) + Menubar.#settings.panel.offset}px`
            }

            panel.style.position = 'absolute';
            panel.style.top = offsetTop;

            // if (!Menubar.#menubar.classList.contains('is-rtl')) {
            if (document.querySelector('html').getAttribute('dir') != "RTL") {
                if (document.querySelector('.ae-menubar.toolbar')) {
                    panel.style.left = button.getBoundingClientRect().right - panel.offsetWidth - document.querySelector('.ae-menubar.toolbar').offsetLeft + 'px';
                }
                else if (document.querySelector('.ae-menubar.menubar .toolbar') || document.querySelector('.ae-menubar.menubar .user.action-button')) {
                    panel.style.left = button.getBoundingClientRect().right - panel.offsetWidth - document.querySelector('.ae-menubar.menubar').offsetLeft + 'px';
                }
            } else {
                if (document.querySelector('.ae-menubar.toolbar')) {
                    panel.style.left = button.getBoundingClientRect().right - button.offsetWidth - document.querySelector('.ae-menubar.toolbar').offsetLeft + 'px';
                }
                else if (document.querySelector('.ae-menubar.menubar .toolbar') || document.querySelector('.ae-menubar.menubar .user.action-button')) {
                    panel.style.left = button.getBoundingClientRect().right - button.offsetWidth - document.querySelector('.ae-menubar.menubar').offsetLeft + 'px';
                }
            }

        }

        // configurações iniciais dos painéis
        document.querySelectorAll(Menubar.#config.selectors.panels).forEach(panel => {
            const panelButton = document.querySelector(`[aria-owns="${panel.getAttribute('id')}"]`);
            panelCloseButton = panel.querySelector("[data-close]");

            // adiciona classe de animação na inicialização dos painéis
            if (panel && !panel.classList.contains(panelAnimationName)) {
                panel.style.setProperty('animation-direction', 'normal', 'important');
                addClass(panel, panelAnimationName);
                panel.addEventListener('animationend', startAnimation);
            }

            if (panel) {
                if (panelButton) {
                    // reposicionamento dinâmico
                    window.addEventListener('resize', () => {
                        setPanelPosition(panel, panelButton);
                    });
                    // reposicionamento no click
                    panelButton.addEventListener('click', () => {
                        setPanelPosition(panel, panelButton);
                    });
                }
            }
        });

        // controle de exibição
        Menubar.#actionButton.forEach(button => {
            button.addEventListener('click', () => {
                event.stopImmediatePropagation();

                const panelOpened = document.querySelector(`${Menubar.#config.selectors.panels}[is-open]`);
                let panel = button.getAttribute('aria-owns');
                panel = document.getElementById(panel);
                const evtDispatch = new CustomEvent('panel-oppened', {detail: {panel: panel}});

                if (panelOpened && panelOpened.getAttribute('id') !== panel.getAttribute('id')) {
                    const panelOwns = document.querySelector(`[aria-owns="${panelOpened.getAttribute('id')}"]`);
                    panelOwns.setAttribute('aria-expanded', 'false');
                    panelOpened.style.opacity = '0';
                    panelOpened.style.visibility = 'hidden';
                    panelOpened.removeAttribute('is-open');
                    panelOpened.setAttribute('aria-hidden', 'true');
                }

                try {
                    if (panel.hasAttribute('is-open')) {
                        panel.removeAttribute('is-open');
                        panel.setAttribute('aria-hidden', 'true');
                        panel.style.setProperty('animation-direction', 'reverse', 'important');
                        addClass(panel);
                        panel.addEventListener('animationend', endAnimation);
                        button.setAttribute('aria-expanded', 'false');

                    } else {
                        panel.setAttribute('is-open', 'true');
                        panel.style.opacity = '1';
                        panel.style.visibility = 'visible';
                        panel.setAttribute('aria-hidden', 'false');
                        panel.style.setProperty('animation-direction', 'normal', 'important');
                        addClass(panel)
                        panel.addEventListener('animationend', startAnimation);
                        button.setAttribute('aria-expanded', 'true');
                        // fecha o menu mobile
                        if (Menubar.#mobileNavigation && Menubar.#mobileNavigation.getAttribute('data-show') === 'true') {
                            Menubar.#mobileButton.click();
                        }
                    }
                } catch (err) {
                    console.debug('Este trigger não possui um painel associado!', err);
                }
                document.dispatchEvent(evtDispatch);


            })
        })

        // fecha o painel no botão data-close
        if (panelCloseButton) {
            panelCloseButton.addEventListener("click", ev => {
                // const ownButton = document.getElementById(ev.currentTarget.dataset.close);
                // ownButton.click();
                this.#closepanelOpened();
            });
        }
    }

    /**
     * Verifica se um item do menu tem o status ativo e realiza ações complementares
     * @private
     */
    #isActive() {
        const isActive = Menubar.#mobileNavigation.querySelectorAll(Menubar.#config.selectors.isActive);

        if (isActive) {
            isActive.forEach(menuitem => {
                if (!menuitem.getAttribute('href') && menuitem.getAttribute('aria-expanded') === 'false') {
                    menuitem.click();
                }
            })
        }
    }

    /**
     * Cria um overlay para impedir interações com os elementos abaixo deste
     * @private
     * @return { DOM Element} overlay
     */
    #createOverlay() {
        const overlay = document.createElement('div');

        overlay.style.position = 'fixed';
        overlay.style.top = '0';
        overlay.style.left = '0';
        overlay.style.width = '100%';
        overlay.style.height = '100%';
        overlay.style.backgroundColor = Menubar.#settings.overlay.bgColor ? Menubar.#settings.overlay.bgColor : Menubar.#config.settings.overlay.bgColor;
        overlay.classList.add('ae-overlay', Menubar.#config.layers.layer_2);
        overlay.setAttribute('id', Menubar.#config.selectors.mobileNavigationOverlay);

        return overlay;
    }

    /**
     * Remove uma overlay ativa
     * @param {DOM Element} overlay ['mobile-navigation' || 'main-navigation'] Informa ao método qual overlay remover.
     */
    #removeOverlay(target) {
        document.querySelector('body').removeChild(target);
    }

    /**
     * Controla a animação de entrada e saída do elemento
     * @param {DOM Element} element Elemento que receberá a classe de animação
     */
    #animationClassControl(element) {
        const startAnimation = () => {
            switch (Menubar.#animationName) {
                case 'slide-top-bouncy':
                    element.classList.add('slide-top-bouncy');
                    break;
                case 'slide-right-bouncy':
                    element.classList.add('slide-right-bouncy');
                    break;
                case 'slide-bottom-bouncy':
                    element.classList.add('slide-bottom-bouncy');
                    break;
                case 'slide-left-bouncy':
                    element.classList.add('slide-left-bouncy');
                    break;
                case 'slide-top':
                    element.classList.add('slide-top');
                    break;
                case 'slide-right':
                    element.classList.add('slide-right');
                    break;
                case 'slide-bottom':
                    element.classList.add('slide-bottom');
                    break;
                case 'slide-left':
                    element.classList.add('slide-left');
                    break;
                case 'reveal-opacity':
                    element.classList.add('reveal-opacity');
                    break;
                case 'reveal-blur':
                    element.classList.add('reveal-blur');
                    break;
            }

            Menubar.#mobileButton.style.setProperty('pointer-events', 'none');
            element.style.setProperty('display', 'block');
            element.addEventListener('animationend', endAnimation);
        }

        const endAnimation = () => {
            if (Menubar.#animationShow) {
                Menubar.#config.animation.className.forEach(className => {
                    if (element.classList.contains(className)) {
                        element.classList.remove(className);
                    }
                });

                element.style.setProperty('animation-direction', 'reverse', 'important');
                Menubar.#mobileButton.style.removeProperty('pointer-events');
                element.removeEventListener('animationend', endAnimation);
            }

            if (element.getAttribute('data-show') === 'false') {
                element.style.setProperty('display', 'none');

                if (Menubar.#animationShow) {
                    element.style.setProperty('animation-direction', 'normal', 'important');
                }
            }
        }


        if (Menubar.#animationShow) {
            startAnimation();
        }
    }

    /**
     * Controla a interação de visualização do menu vertical entre colapsada e extendida
     */
    #collapsibleMenu() {
        if (Menubar.#menubarVertical) {
            let logos = Menubar.#menubarVertical.querySelectorAll('.logo img');
            let menubarVert_width = Menubar.#menubarVertical.offsetWidth;
            const menuitems = Menubar.#menubarVertical.querySelectorAll('.wrapper-navigation [role="menuitem"]');
            const menuitems_labels = Menubar.#menubarVertical.querySelectorAll('.wrapper-navigation [role="menubar"] > .wrapper > [role="menuitem"] > .label');
            const navgroup_labels = Menubar.#menubarVertical.querySelectorAll('.wrapper-navigation [role="menubar"] .navigation-group > .label');
            const menuitems_opened = Menubar.#menubarVertical.querySelectorAll('.wrapper-navigation [role="menubar"] [role="menuitem"][aria-expanded="true"]');

            const wrapperUser = Menubar.#menubarVertical.querySelector(Menubar.#config.selectors.wrapperUser);
            let userMenu, userInfo, userInfoGroup, userButton;
            const wrapperHeader = Menubar.#menubarVertical.querySelector(".wrapper-header");

            if (wrapperUser) {
                userMenu = wrapperUser.querySelector(Menubar.#config.selectors.userMenu);
                userInfo = wrapperUser.querySelector(Menubar.#config.selectors.userInfo);
                userInfoGroup = wrapperUser.querySelector(`${Menubar.#config.selectors.userInfo} > .group`);
                userButton = wrapperUser.querySelector(Menubar.#config.selectors.userButton);
            }

            let start, previousTimestamp;

            const animate_expand = timestamp => {
                if (start === undefined) { start = timestamp };

                const menubarMaxWidth = parseInt(Menubar.#menubarVertical.getAttribute('data-width'));
                const menubarWidth = Menubar.#menubarVertical.offsetWidth;
                const elapsed = timestamp - start;

                if (previousTimestamp !== timestamp) {
                    const width = Math.min(menubarWidth + elapsed, menubarMaxWidth);
                    Menubar.#menubarVertical.style.width = `${width}px`;
                }

                if (menubarWidth !== menubarMaxWidth) {
                    requestAnimationFrame(animate_expand)
                } else {
                    Menubar.#menubarVertical.style.width = '260px';
                    Menubar.#menubarVertical.classList.add('expanded');
                }
            }

            const animate_collapse = timestamp => {
                if (start === undefined) { start = timestamp };

                const menubarWidth = Menubar.#menubarVertical.offsetWidth;
                const elapsed = timestamp - start;

                if (menubarWidth === menubarVert_width) {
                    Menubar.#menubarVertical.setAttribute('data-width', menubarWidth);
                }

                if (previousTimestamp !== timestamp) {
                    const width = Math.max(menubarWidth - elapsed, 80);
                    Menubar.#menubarVertical.style.width = `${width}px`;
                    Menubar.#menubarVertical.style.minWidth = `${width}px`;
                }

                if (menubarWidth !== 80) {
                    requestAnimationFrame(animate_collapse)
                } else if (menubarWidth === 80) {
                    Menubar.#menubarVertical.classList.add('collapsed');
                }
            }

            const handler_collapse = () => {
                requestAnimationFrame(animate_collapse);

                Menubar.#menubarVertical.classList.remove('expanded');
                Menubar.#collapseMenu.classList.add('d-none');

                wrapperHeader.style.setProperty("justify-content", "center");

                logos[0].classList.add('d-none');
                logos[0].classList.remove('d-block');
                logos[1].classList.add('d-block');
                logos[1].classList.remove('d-none');

                let checkWrapperUserAnimating = null;
                const checkWrapperUserClassAnimating = () => {
                    if (wrapperUser && !wrapperUser.classList.contains('animating')) {
                        clearInterval(checkWrapperUserAnimating);

                        wrapperUser.style.display = 'flex';
                        wrapperUser.style.flexFlow = 'row nowrap';
                        wrapperUser.style.justifyContent = 'center';
                        userMenu.classList.add('d-none');
                        userInfoGroup.classList.add('d-none');
                        userInfo.setAttribute('data-expanded', userInfo.getAttribute('aria-expanded'));
                        userInfo.removeAttribute('aria-expanded');
                    }
                }

                if (wrapperUser) {
                    checkWrapperUserAnimating = setInterval(checkWrapperUserClassAnimating, 50);
                }

                let checkMenuitemAnimation = null;
                const checkMenuitemClassAnimation = () => {
                    menuitems.forEach(menuitem => {
                        if (!menuitem.classList.contains('animating')) {
                            clearInterval(checkMenuitemAnimation);

                            menuitems_opened.forEach(menuitem => {
                                menuitem.nextElementSibling.classList.add('d-none');
                            });

                            menuitems_labels.forEach(label => {
                                label.classList.add('d-none');
                                label.parentElement.style.justifyContent = 'center';
                            });

                            navgroup_labels.forEach(label => {
                                label.classList.add('d-none');
                                label.previousElementSibling.classList.remove('d-none');
                                label.parentElement.style.justifyContent = 'center';
                            });
                        }
                    })
                }

                checkMenuitemAnimation = setInterval(checkMenuitemClassAnimation, 50);
            }

            const handler_expand = () => {
                requestAnimationFrame(animate_expand);

                Menubar.#menubarVertical.classList.remove('collapsed');
                Menubar.#collapseMenu.classList.remove('d-none');

                wrapperHeader.style.removeProperty("justify-content");

                logos[1].classList.add('d-none');
                logos[1].classList.remove('d-block');
                logos[0].classList.add('d-block');
                logos[0].classList.remove('d-none');

                let checkWrapperUserAnimating = null;
                const checkWrapperUserClassAnimating = () => {
                    if (wrapperUser && !wrapperUser.classList.contains('animating')) {
                        clearInterval(checkWrapperUserAnimating);

                        wrapperUser.style.display = 'block';
                        wrapperUser.style.flexFlow = '';
                        wrapperUser.style.justifyContent = '';
                        userMenu.classList.remove('d-none');
                        userInfoGroup.classList.remove('d-none');
                        userInfo.setAttribute('aria-expanded', userInfo.getAttribute('data-expanded'));
                        userInfo.removeAttribute('data-expanded');
                    }
                }

                if (wrapperUser) {
                    checkWrapperUserAnimating = setInterval(checkWrapperUserClassAnimating, 50);
                }

                let checkMenuitemAnimation = null;
                const checkMenuitemClassAnimation = () => {
                    menuitems.forEach(menuitem => {
                        if (!menuitem.classList.contains('animating')) {
                            clearInterval(checkMenuitemAnimation);

                            menuitems_opened.forEach(menuitem => {
                                menuitem.nextElementSibling.classList.remove('d-none');
                            });

                            menuitems_labels.forEach(label => {
                                label.classList.remove('d-none');
                                label.parentElement.style.justifyContent = 'flex-start';
                            });

                            navgroup_labels.forEach(label => {
                                label.classList.remove('d-none');
                                label.previousElementSibling.classList.add('d-none');
                                label.parentElement.style.justifyContent = 'flex-start';
                            });
                        }
                    })
                }

                checkMenuitemAnimation = setInterval(checkMenuitemClassAnimation, 50);
            }

            if (Menubar.#menubarVertical.getAttribute('data-collapsible') === 'true') {
                if (!Menubar.#menubarVertical.classList.contains('collapsed')) {
                    handler_collapse();
                } else {
                    handler_expand();
                }
            }

        }
    }

    /**
     * Controla o menu do usuário da menubar vertical
     */
    #userMenu() {
        const wrapperUser = Menubar.#menubarVertical.querySelector(Menubar.#config.selectors.wrapperUser);
        const userInfo = wrapperUser.querySelector(Menubar.#config.selectors.userInfo)

        if (wrapperUser) {
            userInfo.addEventListener('click', () => {
                const expanded = userInfo.getAttribute('aria-expanded');
                const userMenu = wrapperUser.querySelector(Menubar.#config.selectors.userMenu);
                const userMenuWrapper = wrapperUser.querySelector(`${Menubar.#config.selectors.userMenu} > .wrapper`);
                const userMenuContentHeight = wrapperUser.querySelector(Menubar.#config.selectors.userMenuContent).offsetHeight;
                let start;

                const animExpand = timestamp => {
                    if (start === undefined) { start = timestamp };

                    const elapsed = timestamp - start;

                    if (userMenuWrapper.offsetHeight < userMenuContentHeight) {
                        userMenuWrapper.style.height = `${Math.min(userMenuWrapper.offsetHeight + (0.1 * elapsed), userMenuContentHeight)}px`;
                        wrapperUser.classList.add('animating');
                        requestAnimationFrame(animExpand);
                    } else {
                        userInfo.setAttribute('aria-expanded', 'true');
                        userMenuWrapper.style.height = 'fit-content';
                        wrapperUser.classList.remove('animating');
                    }
                }

                const animCollapse = timestamp => {
                    if (start === undefined) { start = timestamp };

                    const elapsed = timestamp - start;

                    if (userMenuWrapper.offsetHeight !== 0) {
                        userMenuWrapper.style.height = `${Math.max(userMenuWrapper.offsetHeight - (0.1 * elapsed), 0)}px`;
                        wrapperUser.classList.add('animating');
                        requestAnimationFrame(animCollapse);
                    } else {
                        userInfo.setAttribute('aria-expanded', 'false');
                        userMenu.classList.remove('m-top-4');
                        wrapperUser.classList.remove('animating');
                    }
                }

                if (expanded === 'false') {
                    requestAnimationFrame(animExpand);
                    userMenu.classList.add('m-top-4');
                } else {
                    requestAnimationFrame(animCollapse);
                }
            })
        }
    }
}

// Funções auxiliares
// ----------------------------------------------------------
function sumElementsWidth(nodeElements) {
    let width = 0;
    if (nodeElements) {
        nodeElements.forEach(element => {
            width += element.offsetWidth;
        });
        return width;
    }
}
const menuJSON_url = {};
const panelTheme = document.getElementById('themes-panel');
var loadTimeout = null;

function startAppTab(initApp) {
    if (typeof openInTab == 'function') {
        openInTab(apl_default, 'init_tab', '', '', '<i class="fas fa-home"></i>', '_self', true);
    } else {
        $('#app-frames').find('iframe').addClass('loading');
        if (loadTimeout) {
            clearTimeout(loadTimeout);
        }
        loadTimeout = setTimeout(function () {
            $('#app-frames iframe').removeClass('loading');
        }, 10000);
        $('.nm_frame_app').attr('src', apl_default);
    }
}
function layoutControl(offsetX) {
    const thresholdX = offsetX ? offsetX : 16;
    const menubar_vertical = document.querySelector('.ae-menubar.menubar[aria-orientation="vertical"]');
    const toolbar = document.querySelector('.ae-menubar.toolbar');
    const switch_menu_pos_button = document.getElementById('switch-menu-position');
    const sc_main_content = document.getElementById('sc-main-content');
    const checkRTL = document.querySelector('html').getAttribute('dir') == "RTL";

    sc_main_content.parentElement.style.height = '100%';

    if(checkRTL) {
        if(window.getComputedStyle(menubar_vertical).left !== 'auto') {
            menubar_vertical.style.right = '0';
            menubar_vertical.style.left = 'auto';
        }
    }

    const layout = () => {
        if(checkRTL) {
            sc_main_content.style.paddingRight = menubar_vertical.offsetWidth + 'px';

            if(toolbar) {
                setTimeout(() => {
                    toolbar.style.width = sc_main_content.offsetWidth - menubar_vertical.offsetWidth - thresholdX - 16 + 'px';
                }, 251)
            }

        } else {
            sc_main_content.style.paddingLeft = menubar_vertical.offsetWidth + 'px';
        }
    }

    // init
    layout();

    // click
    switch_menu_pos_button.addEventListener('click', () => {
        setTimeout(layout, 350);
    });
}
function themeApply(themeName) {
    panelTheme.querySelectorAll('[data-themeapply]').forEach(button => {
        button.addEventListener('click', () => {
            $('[data-themeapply]').closest('li.theme-name.button ').removeClass('active');
            $(button).closest('li.theme-name.button ').addClass('active');
            document.querySelectorAll('.ae-menubar').forEach(menubar => {
                menubar.setAttribute('data-aetheme', button.getAttribute('data-theme'));
            });
            $('ul.context-menu-list.context-menu-root').attr('data-aetheme', button.getAttribute('data-theme'));
            $('#app-frames').attr('data-aetheme', button.getAttribute('data-theme'));
        });
    });
}

function loadJSON(url) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erro na solicitação ${response.status}`)
            }

            return response.json();
        })
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Erro ao carregar o arquivo JSON:', error);
        })
}


function updateNavMenu() {
    var vert = document.querySelector('.ae-menubar.menubar').getAttribute('aria-orientation') == 'vertical';
    if (vert) {
        layoutControl(4);
    }
    document.getElementById('nav_list').innerHTML = renderItems(items_data, vert);
    if (document.getElementById('nav_mobile')) {
        document.getElementById('nav_mobile').innerHTML = renderItems(items_data, true);
    }
    if ($('#user_menu_list')[0]) {
        if (user_menu_data.length > 0) {
            $('#user_menu_list')[0].innerHTML = renderItems(user_menu_data, true);
        } else {
            $('#user_menu_list').closest('.section.actions.ae-menubar-accordion').remove();
            $('.user-info').addClass('inactive').off('click');
            $('.user-menu').remove();
        }
    }
    $('.ae-menubar.menubar[aria-orientation="vertical"] a,.ae-menubar.menubar[aria-orientation="vertical"] a span').on('click.closeVertMenu', function() {
        $('.ae-menubar.menubar[aria-orientation="vertical"]').removeClass('expanded-mob');
    });
}
function renderUserImage(arr_items, is_vert) {
    var el = $('.user_image');
    if (el.length > 0) {
        var src = el.attr('src');
        if (src.trim() == '') {
            el.replaceWith('<i class="mb_icon fa-solid fa-user" aria-hidden="true"></i>');
        }
    }
}
function renderLogo() {
    var el_list = $('.logo img');
    el_list.each(function(i, el) {
        var src = $(el).attr('src');
        if (src.trim() != '') {
            $(el).css('visibility', 'visible');
        }
    });
}
function renderMenuUser(arr_items){
    var ret_html = '';
    arr_items.forEach(function (item) {
        var has_icon = item.icon_check == 'S';
        var icon = item.icon_fa;
        var label = item.label;
        var url = item.link;
        var id = item.id;
        var target = item.target;

        ret_html += '<li class="wrapper" role="none">'+"\n";
        ret_html += "<a href=\"" + url + "\" tab-name=\""+ id + "\" tab-title=\""+ label + "\" target=\""+ target + "\" role=\"menuitem\" aria-haspopup=\"false\" aria-expanded=\"false\" data-active=\"false\">"+"\n";

        if (has_icon) {
            ret_html += '   <i class="mb_icon ' + icon + '" aria-hidden="true"> </i>'+"\n";
        }
        ret_html += '       <span class="label">' + label + '</span>'+"\n";
        ret_html += '</a>'+"\n";
        ret_html += '</li>'+"\n";
    });
    return ret_html;
}
function getTarget(target_name) {
    var ret = 'nm_frame_app';
    try {
        var targets = targets_list;
        if (targets[target_name] !== undefined) {
            ret = targets[target_name];
        }
    } catch (e) {
        ret = 'nm_frame_app';
    }
    return ret
}
function renderItems(arr_items, is_vert) {
    var ret_html = '';
    arr_items.forEach(function (item) {
        var has_icon = item.icon_check == 'S';
        var icon = item.icon_fa;
        var disabled = (item.disabled == 'Y') ? 'disabled="disabled"' : '';
        var label = item.label;
        var hint = item.hint;
        var url = item.link;
        var id = item.id;
        var link_target = item.link_target;
        var fav_check = item.fav_check;
        var children = Object.values(item.itens);
        var has_popup = 'true';

        try {
            link_target = getTarget(link_target);
            if (link_target == '_self' && url == '#' && (!children || !children.length)) {
                url = 'javascript: window.close();';
            }
        } catch (e) {
            link_target = 'nm_frame_app';
        }

        ret_html += '<li class="wrapper" ' + disabled + ' role="none">'+"\n";
        if (!children || !children.length) {
            has_popup = 'false';
            ret_html += "<a href=\"" + url + "\" tab-name=\""+ id + "\" title=\"" + hint + "\" tab-title=\""+ label + "\" target=\""+ link_target + "\" role=\"menuitem\" aria-haspopup=\""+ has_popup + "\" aria-expanded=\"false\" data-active=\"false\">"+"\n";
        } else {
            ret_html += '   <span role="menuitem" aria-haspopup="' + has_popup + '" aria-expanded="false" aria-controls="submenu-' + id + '" data-active="false">' + "\n";
        }
        if (has_icon) {
            ret_html += '   <i class="mb_icon ' + icon + '" aria-hidden="true"> </i>'+"\n";
        }
        ret_html += '       <span class="label">' + label + '</span>'+"\n";
        if (!children || !children.length) {
        } else {
            if (is_vert) {
                ret_html += '   </span>' + "\n";
            }
        }
        if (children && children.length > 0) {
            if (is_vert) {
                ret_html += '<div class="wrapper">' + "\n";
            }
            ret_html += '   <ul class="submenu" id="submenu-' + id + '" role="menu" aria-label="' + label + '" aria-hidden="true">'+"\n";
            ret_html +=         renderItems(children, is_vert);
            ret_html += '   </ul>'+"\n";
            if (is_vert) {
                ret_html += '</div>'+"\n";
            }
        } else {
            ret_html += '</a>'+"\n";
        }
        if (!children || !children.length) {
        } else {
            if (!is_vert) {
                ret_html += '   </span>' + "\n";
            }
        }
        ret_html += '</li>'+"\n";
    });
    return ret_html;
}

function hideTBButton(panel_name) {
    $('[aria-controls="'+panel_name+'-panel"]').hide();
}
function showTBButton(panel_name) {
    $('[aria-controls="'+panel_name+'-panel"]').show();
}
function bodyColorUpdate(el_wrap) {
    try {
        var iFrameEl = $(el_wrap).find('iframe')[0];
        var bgcolor = '#efefef';
        var iframeDoc = iFrameEl.contentDocument || iFrameEl.contentWindow.document;
        bgcolor = iFrameEl.contentWindow.getComputedStyle(iframeDoc.body).backgroundColor;
        $('body').css('background-color', bgcolor);
    } catch (e) {
        console.log(e);
    }
}

function activateItem(id) {
    var vert = document.querySelector('.ae-menubar.menubar').getAttribute('aria-orientation') == 'vertical';
    var activeItem =  $('[tab-name="' + id + '"]');
    $('[role="menuitem"]').attr('data-active', 'false');
    activeItem.attr('data-active', 'true');
    if (vert) {
        activeItem.parents('.wrapper').find(' > [role="menuitem"]').attr('data-active', 'true');
    } else {
        activeItem.parents('[role="menuitem"]').attr('data-active', 'true');
    }
}
function handleLinks(e) {
    if ($('a[tab-name="' + e + '"]').attr('target') == '_self' && ($('a[tab-name="' + e + '"]').attr('href') == '#' || $('a[tab-name="' + e + '"]').attr('href') == '')) {
        window.close();
        return false;
    }
    if ($('a[tab-name="' + e + '"]').attr('href') == '#' || $('a[tab-name="' + e + '"]').attr('href') == '') {
        event.preventDefault();
        event.stopPropagation();
        return false;
    }
    // $('body').removeAttr("style");
    activateItem(e);
    if (typeof use_load != 'undefined' && use_load) {
        $('#app-frames').find('iframe').addClass('loading');
    }
    // if (!$('#app-frames').find('iframe').hasClass('loading')) {
    //     bodyColorUpdate($('#app-frames'));
    // }
    if (typeof use_load != 'undefined' && use_load) {
        if (loadTimeout) {
            clearTimeout(loadTimeout);
        }
        loadTimeout = setTimeout(function() {
            $('#app-frames iframe').removeClass('loading');
        }, 10000);
    }
}
function flattenItems(arr_items) {

    return arr_items.reduce((acc, x) => {
        acc = acc.concat(x);
        if (typeof x.itens == typeof {}) {
            acc = acc.concat(flattenItems(Object.values(x.itens)));
            // x.itens = [];
        }
        return acc;
    }, []);


}

var SCMenubar;
window.addEventListener('load', () => {

    // Inicialização da aplicação de temas
    //-------------------------------------
    if (panelTheme) {
        themeApply();
    }

    // Sistema de busca do menu
    //-------------------------------------

    renderUserImage();
    renderLogo();
    // Controle de layout
    //---------------------------------
    /**
     * @param {number} offsetX - deslocamento entre a toolbar e a menubar vertical
     */
    updateNavMenu();
    if (typeof startCrumbs == 'function') {
        startCrumbs();
    }
    if (typeof searchInit == 'function') {
        searchInit();
    }
    if (typeof startTabs == 'function') {
        startTabs();
    } else {
        $('#app-frames iframe').on('load', function () {
            bodyColorUpdate($('#app-frames')); $('#app-frames iframe').removeClass('loading');
        });
        $('a[tab-name], a[tab-name] > span').on('click', function (e) {
            var el = $(this).closest('a[tab-name]');
            if (el.attr('target') == 'nm_frame_app') {
                handleLinks(el.attr('tab-name'));
            }
        });
    }
    // Inicialização do menu
    //-------------------------------------
    SCMenubar = new Menubar({
        animation: {
            show: true,
            name: 'slide-left'
        }
    });

    document.addEventListener('panel-oppened', function(e) {
        if (e.detail.panel.id == 'search-panel') {
            $('#main-search').focus();
        }
        $('#' + e.detail.panel.id).after('<div class="panel-backdrop-overlay"></div>');
        $('.panel-backdrop-overlay').off('click');
        $('.panel-backdrop-overlay').on('click', function () {
            SCMenubar.closePanel();
        });
    });
    document.addEventListener('panel-closed', function(e) {
        $('.panel-backdrop-overlay').remove();
        $('#main-search').val('');
        $('#search-result .result-links').html('');
    });

    $('.button.expand-button').on('click', function () {
        $('.ae-menubar.menubar[aria-orientation="vertical"]').addClass('expanded-mob');
    });
    $('#close-menu-expand').on('click', function () {
        $('.ae-menubar.menubar[aria-orientation="vertical"]').removeClass('expanded-mob');
    });
    if (apl_default != '') {
        startAppTab('');
    }
    if (!start_expanded) {
        $('#switch-menu-position').click();
    }
})
    </script>
    <?php

}function menu_escreveMenu($arr_menu_apl, $path_imag_cab = '', $strAlign = '')
{
  $arr_menu_user = $arr_menu_apl['data_user'];
  $arr_menu = $arr_menu_apl['data'];
?>
        <div class='menu menu--horizontal'>
            <div class='menu__toggle'>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class='menu__container scMenuHTableCssAlt'>
                <div class='menu__layer'>
                    <?php
                    $this->menu_escreveMenuRec($arr_menu, $arr_menu_apl, $path_imag_cab, 'menu__list');
                    ?>
                </div>
            </div>
        </div><?php
}
function menu_target($str_target)
{
    if ('_blank' == $str_target)
    {
        return '_blank';
    }
    elseif ('_parent' == $str_target)
    {
        return '_parent';
    }
    else
    {
        return 'menu_iframe';
    }
}
   function nm_prot_aspas($str_item)
   {
       return str_replace('"', '\"', $str_item);
   }
   function Gera_sc_init($apl_menu)
   {
        $_SESSION['scriptcase']['menu']['sc_init'][$apl_menu] = 1;
        return  1;
   }
   function getMenuArrItemLink($apl_menu, $str_id)
   {
       foreach($apl_menu as $id_item => $arr_item)
       {
           if($arr_item['id'] == $str_id)
           {
               return $arr_item;
           }
           elseif(isset($arr_item['itens']) && !empty($arr_item['itens']))
           {
               $_arr_item = $this->getMenuArrItemLink($arr_item['itens'], $str_id);
               if(isset($_arr_item) && !empty($_arr_item))
               {
                   return $_arr_item;
               }
           }
       }
   }   function regionalDefault()
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
       $_SESSION['scriptcase']['reg_conf']['html_dir_only'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] : "";
       $_SESSION['scriptcase']['reg_conf']['num_group_digit']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit'] : "1";
       $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'] : "1";
   }

}
if (isset($_POST['nmgp_start'])) {$nmgp_start = $_POST['nmgp_start'];} 
if (isset($_GET['nmgp_start']))  {$nmgp_start = $_GET['nmgp_start'];} 
$Sem_Session = (!isset($_SESSION['sc_session'])) ? true : false;
$_SESSION['scriptcase']['sem_session'] = false;
if (!isset($_SERVER['HTTP_REFERER']) || (!isset($nmgp_parms) && !isset($script_case_init) && !isset($nmgp_start) ))
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
    if (isset($_COOKIE['sc_apl_default_Proyecto_gestion_faltas'])) {
        $apl_def = explode(",", $_COOKIE['sc_apl_default_Proyecto_gestion_faltas']);
    }
    elseif (is_file($root . $_SESSION['scriptcase']['menu']['glo_nm_path_imag_temp'] . "/sc_apl_default_Proyecto_gestion_faltas.txt")) {
        $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['menu']['glo_nm_path_imag_temp'] . "/sc_apl_default_Proyecto_gestion_faltas.txt"));
    }
    if (isset($apl_def)) {
        if ($apl_def[0] != "menu") {
            $_SESSION['scriptcase']['sem_session'] = true;
            if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                $_SESSION['scriptcase']['menu']['session_timeout']['redir'] = $apl_def[0];
            }
            else {
                $_SESSION['scriptcase']['menu']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
            }
            $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
            $_SESSION['scriptcase']['menu']['session_timeout']['redir_tp'] = $Redir_tp;
        }
        if (isset($_COOKIE['sc_actual_lang_Proyecto_gestion_faltas'])) {
            $_SESSION['scriptcase']['menu']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_Proyecto_gestion_faltas'];
        }
    }
}
if ((isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "force_lang") || (isset($_GET['nmgp_opcao']) && $_GET['nmgp_opcao'] == "force_lang"))
{
    if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "force_lang")
    {
        $nmgp_opcao  = $_POST['nmgp_opcao'];
        $nmgp_idioma = $_POST['nmgp_idioma'];
    }
    else
    {
        $nmgp_opcao  = $_GET['nmgp_opcao'];
        $nmgp_idioma = $_GET['nmgp_idioma'];
    }
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
$contr_menu = new menu_class;
$contr_menu->menu_menu();

?>
