<?php
include_once('app_menu_session.php');
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
$_SESSION['scriptcase']['app_menu']['glo_nm_path_prod']      = "/scriptcase/prod";
$_SESSION['scriptcase']['app_menu']['glo_nm_perfil']         = "";
$_SESSION['scriptcase']['app_menu']['glo_nm_conexao']        = "conn_example";
$_SESSION['scriptcase']['app_menu']['glo_nm_path_imag_temp'] = "/scriptcase/tmp";
$_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo']      = "S";
//check publication with the prod
$str_path_apl_url  = $_SERVER['PHP_SELF'];
$str_path_apl_url  = str_replace("\\", '/', $str_path_apl_url);
$str_path_apl_url  = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
$str_path_apl_url  = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
//check prod
if(empty($_SESSION['scriptcase']['app_menu']['glo_nm_path_prod']))
{
   /*check prod*/$_SESSION['scriptcase']['app_menu']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
}
//check tmp
if(empty($_SESSION['scriptcase']['app_menu']['glo_nm_path_imag_temp']))
{
   /*check tmp*/$_SESSION['scriptcase']['app_menu']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
}
//end check publication with the prod

ob_start();


class app_menu_class
{
  var $Db;

 function sc_Include($path, $tp, $name)
 {
     if ((empty($tp) && empty($name)) || ($tp == "F" && !function_exists($name)) || ($tp == "C" && !class_exists($name)))
     {
         include_once($path);
     }
 } // sc_Include

 function app_menu_menu()
 {
    global $app_menu_menuData;
    if (isset($_POST["nmgp_idioma"]))  
    { 
        $Temp_lang = explode(";" , $_POST["nmgp_idioma"]);  
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
$_SESSION['scriptcase']['app_menu']['contr_erro'] = 'off';
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
$nm_url_saida = "";
if (isset($nmgp_url_saida))
{
    $nm_url_saida = $nmgp_url_saida;
    if (isset($script_case_init))
    {
        $nm_url_saida .= "?script_case_init=" . $script_case_init;
    }
}
if (isset($_POST["nmgp_idioma"]) || isset($_POST["nmgp_schema"]))  
{ 
    $nm_url_saida = $_SESSION['scriptcase']['sc_saida_app_menu'];
}
elseif (!empty($nm_url_saida))
{
    $_SESSION['scriptcase']['sc_url_saida'][$script_case_init]  = $nm_url_saida;
    $_SESSION['scriptcase']['sc_saida_app_menu'] = $nm_url_saida;
}
else
{
    $_SESSION['scriptcase']['sc_saida_app_menu'] = (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "javascript:window.close()";
}
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
if(empty($_SESSION['scriptcase']['app_menu']['glo_nm_path_prod']))
{
        /*check prod*/$_SESSION['scriptcase']['app_menu']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
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
$this->path_botoes    = '../_lib/img';
$this->path_imag_apl  = $str_root . $path_link . "_lib/img";
$path_help      = $path_link . "_lib/webhelp/";
$path_libs      = $str_root . $_SESSION['scriptcase']['app_menu']['glo_nm_path_prod'] . "/lib/php";
$path_third     = $str_root . $_SESSION['scriptcase']['app_menu']['glo_nm_path_prod'] . "/third";
$url_third      = $_SESSION['scriptcase']['app_menu']['glo_nm_path_prod'] . "/third";
$path_adodb     = $str_root . $_SESSION['scriptcase']['app_menu']['glo_nm_path_prod'] . "/third/adodb";
$path_apls      = $str_root . substr($path_link, 0, strrpos($path_link, '/'));
$path_img_old   = $str_root . $path_link . "app_menu/img";
$this->path_css = $str_root . $path_link . "_lib/css/";
$path_lib_php   = $str_root . $path_link . "_lib/lib/php";
$_SESSION['scriptcase']['dir_temp'] = $str_root . $_SESSION['scriptcase']['app_menu']['glo_nm_path_imag_temp'];
$menu_largura   = '240';
$menu_mobile_hide          = 'S';
$menu_mobile_inicial_state = 'aberto';
$menu_mobile_hide_onclick  = 'S';
$menutree_mobile_float     = 'S';
$menu_mobile_hide_icon     = 'N';
$mobile_menu_mobile_hide          = 'S';
$mobile_menu_mobile_inicial_state = 'aberto';
$mobile_menu_mobile_hide_onclick  = 'S';
$mobile_menutree_mobile_float     = 'N';
$mobile_menu_mobile_hide_icon     = 'N';
$this->sc_Include($path_libs . "/nm_ini_perfil.php", "F", "perfil_lib");
if(function_exists('set_php_timezone')) set_php_timezone('app_menu');
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
    include_once(dirname(__FILE__) . "/app_menu_erro.php");
}
include_once(dirname(__FILE__) . "/app_menu_erro.class.php"); 
$this->Erro = new app_menu_erro();
$str_path = substr($_SESSION['scriptcase']['app_menu']['glo_nm_path_prod'], 0, strrpos($_SESSION['scriptcase']['app_menu']['glo_nm_path_prod'], '/') + 1);
if (!is_file($str_root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
{
    unset($_SESSION['scriptcase']['nm_sc_retorno']);
    unset($_SESSION['scriptcase']['app_menu']['glo_nm_conexao']);
}
/* Definiciones de las rutas */
$app_menu_menuData          = array();
$app_menu_menuData['path']  = array();
$app_menu_menuData['url']   = array();
$NM_dir_atual = getcwd();
if (empty($NM_dir_atual))
{
    $app_menu_menuData['path']['sys'] = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
    $app_menu_menuData['path']['sys'] = str_replace("\\", '/', $str_path_sys);
    $app_menu_menuData['path']['sys'] = str_replace('//', '/', $str_path_sys);
}
else
{
    $sc_nm_arquivo                                   = explode("/", $_SERVER['PHP_SELF']);
    $app_menu_menuData['path']['sys'] = str_replace("\\", "/", str_replace("\\\\", "\\", getcwd())) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
}
$app_menu_menuData['url']['web']   = $_SERVER['PHP_SELF'];
$app_menu_menuData['url']['web']   = str_replace("\\", '/', $app_menu_menuData['url']['web']);
$app_menu_menuData['path']['root'] = substr($app_menu_menuData['path']['sys'],  0, -1 * strlen($app_menu_menuData['url']['web']));
$app_menu_menuData['path']['app']  = substr($app_menu_menuData['path']['sys'],  0, strrpos($app_menu_menuData['path']['sys'],  '/'));
$app_menu_menuData['path']['link'] = substr($app_menu_menuData['path']['app'],  0, strrpos($app_menu_menuData['path']['app'],  '/'));
$app_menu_menuData['path']['link'] = substr($app_menu_menuData['path']['link'], 0, strrpos($app_menu_menuData['path']['link'], '/')) . '/';
$app_menu_menuData['path']['app'] .= '/';
$app_menu_menuData['url']['app']   = substr($app_menu_menuData['url']['web'],  0, strrpos($app_menu_menuData['url']['web'],  '/'));
$app_menu_menuData['url']['link']  = substr($app_menu_menuData['url']['app'],  0, strrpos($app_menu_menuData['url']['app'],  '/'));
if ($_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] == "S")
{
    $app_menu_menuData['url']['link']  = substr($app_menu_menuData['url']['link'], 0, strrpos($app_menu_menuData['url']['link'], '/'));
}
$app_menu_menuData['url']['link']  .= '/';
$app_menu_menuData['url']['app']   .= '/';

$_SESSION['scriptcase']['app_menu']['sc_apl_link'] = $app_menu_menuData['url']['link'];

/* Elementos de menú */
if (!isset($_SESSION['scriptcase']['str_lang']) || empty($_SESSION['scriptcase']['str_lang']))
{
    $_SESSION['scriptcase']['str_lang'] = "en_us";
}
if (!isset($_SESSION['scriptcase']['str_conf_reg']) || empty($_SESSION['scriptcase']['str_conf_reg']))
{
    $_SESSION['scriptcase']['str_conf_reg'] = "en_gb";
}
$this->str_lang        = $_SESSION['scriptcase']['str_lang'];
$this->str_conf_reg    = $_SESSION['scriptcase']['str_conf_reg'];
if (isset($_SESSION['scriptcase']['app_menu']['session_timeout']['lang'])) {
    $this->str_lang = $_SESSION['scriptcase']['app_menu']['session_timeout']['lang'];
}
elseif (!isset($_SESSION['scriptcase']['app_menu']['actual_lang']) || $_SESSION['scriptcase']['app_menu']['actual_lang'] != $this->str_lang) {
    $_SESSION['scriptcase']['app_menu']['actual_lang'] = $this->str_lang;
    setcookie('sc_actual_lang_restaurant',$this->str_lang,'0','/');
}
if (!function_exists("NM_is_utf8"))
 {
   include_once("../_lib/lib/php/nm_utf8.php");
}
if (!function_exists("SC_dir_app_ini"))
{
    include_once("../_lib/lib/php/nm_ctrl_app_name.php");
}
SC_dir_app_ini('restaurant');
$this->str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_Guava/Sc9_Guava";
if ($_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] == "S")
{
    $path_apls     = substr($path_apls, 0, strrpos($path_apls, '/'));
}
$path_apls     .= "/";
include("../_lib/lang/". $this->str_lang .".lang.php");
include("../_lib/css/" . $this->str_schema_all . "_menuT.php");
if(isset($pagina_schemamenu) && !empty($pagina_schemamenu) && is_file("../_lib/menuicons/". $pagina_schemamenu .".php"))
{
    include("../_lib/menuicons/". $pagina_schemamenu .".php");
}
include("../_lib/lang/config_region.php");
include("../_lib/lang/lang_config_region.php");
$this->sc_Include($path_lib_php . "/nm_functions.php", "", "") ; 
$this->sc_Include($path_lib_php . "/nm_api.php", "", "") ; 
$this->sc_Include($path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
$this->nm_data = new nm_data("en_us");
if(isset($this->Ini->Nm_lang))
{
    $Nm_lang = $this->Ini->Nm_lang;
}
else
{
    $Nm_lang = $this->Nm_lang;
}
$Str_btn_menu = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
$Str_btn_css  = trim($str_button) . "/" . trim($str_button) . ".css";
include($path_btn . $Str_btn_menu);
if (!function_exists("nmButtonOutput"))
{
   include_once("../_lib/lib/php/nm_gp_config_btn.php");
}
asort($this->Nm_lang_conf_region);
$this->tab_grupo[0] = "restaurant/";
if ($_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] != "S")
{
    $this->tab_grupo[0] = "";
}

    $_SESSION['scriptcase']['menu_atual'] = "app_menu";
    $_SESSION['scriptcase']['menu_apls']['app_menu'] = array();
    if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
    {
        foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
        {
            if (isset($_SESSION['scriptcase']['app_menu']['glo_nm_conexao']) && $_SESSION['scriptcase']['app_menu']['glo_nm_conexao'] == $NM_con_orig)
            {
/*NM*/          $_SESSION['scriptcase']['app_menu']['glo_nm_conexao'] = $NM_con_dest;
            }
            if (isset($_SESSION['scriptcase']['app_menu']['glo_nm_perfil']) && $_SESSION['scriptcase']['app_menu']['glo_nm_perfil'] == $NM_con_orig)
            {
/*NM*/          $_SESSION['scriptcase']['app_menu']['glo_nm_perfil'] = $NM_con_dest;
            }
            if (isset($_SESSION['scriptcase']['app_menu']['glo_con_' . $NM_con_orig]))
            {
                $_SESSION['scriptcase']['app_menu']['glo_con_' . $NM_con_orig] = $NM_con_dest;
            }
        }
    }
$_SESSION['scriptcase']['charset'] = (isset($this->Nm_lang['Nm_charset']) && !empty($this->Nm_lang['Nm_charset'])) ? $this->Nm_lang['Nm_charset'] : "UTF-8";
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
$this->regionalDefault();
if (isset($_SESSION['scriptcase']['app_menu']['session_timeout']['redir'])) {
    $SS_cod_html  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
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
    if ($_SESSION['scriptcase']['app_menu']['session_timeout']['redir_tp'] == "R") {
        $SS_cod_html .= "  </HEAD>\r\n";
        $SS_cod_html .= "   <body>\r\n";
    }
    else {
        $SS_cod_html .= "    <link rel=\"shortcut icon\" href=\"../_lib/img/grp__NM__img__NM__sc_restaurant.png\">\r\n";
        $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_menuT.css\"/>\r\n";
        $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_menuT" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\"/>\r\n";
        $SS_cod_html .= "  </HEAD>\r\n";
        $SS_cod_html .= "   <body class=\"scMenuHPage\">\r\n";
        $SS_cod_html .= "    <table align=\"center\"><tr><td style=\"padding: 0\"><div>\r\n";
        $SS_cod_html .= "    <table class=\"scMenuHTable\" width='100%' cellspacing=0 cellpadding=0><tr class=\"scMenuHHeader\"><td class=\"scMenuHHeaderFont\" style=\"padding: 15px 30px; text-align: center\">\r\n";
        $SS_cod_html .= $this->Nm_lang['lang_errm_expired_session'] . "\r\n";
        $SS_cod_html .= "     <form name=\"Fsession_redir\" method=\"post\"\r\n";
        $SS_cod_html .= "           target=\"_self\">\r\n";
        $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['app_menu']['session_timeout']['redir'] . "');\">\r\n";
        $SS_cod_html .= "     </form>\r\n";
        $SS_cod_html .= "    </td></tr></table>\r\n";
        $SS_cod_html .= "    </div></td></tr></table>\r\n";
    }
    $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
    if ($_SESSION['scriptcase']['app_menu']['session_timeout']['redir_tp'] == "R") {
        $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['app_menu']['session_timeout']['redir'] . "');\r\n";
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
    unset($_SESSION['scriptcase']['app_menu']['session_timeout']);
    unset($_SESSION['sc_session']);
}
if (isset($SS_cod_html))
{
    echo $SS_cod_html;
    exit;
}
$this->str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_Guava/Sc9_Guava";
$_SESSION['scriptcase']['erro']['str_schema'] = $this->str_schema_all . "_error.css";
$_SESSION['scriptcase']['erro']['str_schema_dir'] = $this->str_schema_all . "_error" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
$_SESSION['scriptcase']['erro']['str_lang']   = $this->str_lang;
if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['app_menu']['session_timeout']['redir']))
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
            $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
        }
         $$nmgp_var = $nmgp_val;
    }
}
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
            $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
        }
         $$nmgp_var = $nmgp_val;
    }
}
if (isset($script_case_init))
{
    $_SESSION['sc_session'][1]['app_menu']['init'] = $script_case_init;
}
elseif (!isset($_SESSION['sc_session'][1]['app_menu']['init']))
{
    $_SESSION['sc_session'][1]['app_menu']['init'] = "";
}
$script_case_init = $_SESSION['sc_session'][1]['app_menu']['init'];
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
       $$cadapar[0] = $cadapar[1];
       $_SESSION[$cadapar[0]] = $cadapar[1];
       $ix++;
     }
} 
$this->str_schema_all = $STR_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_Guava/Sc9_Guava";
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['app_menu'] = "on";
} 
if (!isset($_SESSION['scriptcase']['app_menu']['session_timeout']['redir']) && (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_menu']) || $_SESSION['scriptcase']['sc_apl_seg']['app_menu'] != "on"))
{ 
    $NM_Mens_Erro = $this->Nm_lang['lang_errm_unth_user'];
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">

    <HTML>
     <HEAD>
      <TITLE></TITLE>
     <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
      <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>      <META http-equiv="Pragma" content="no-cache"/>
 <META http <META http <META http <META http <META http      <link rel="shortcut icon" href="../_lib/img/grp__NM__img__NM__sc_restaurant.png">
      <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuT.css" /> 
      <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuT<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
      <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_grid.css" /> 
      <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
     </HEAD>
     <body>
       <table align="center" class="scGridBorder"><tr><td style="padding: 0">
       <table style="width: 100%" class="scGridTabela"><tr class="scGridFieldOdd"><td class="scGridFieldOddFont" style="padding: 15px 30px; text-align: center">
        <?php echo $NM_Mens_Erro; ?>
        <br />
        <form name="Fseg" method="post" target="_self">
         <input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($script_case_init) ?>"/> 
         <input type="button" name="sc_sai_seg" value="OK" onclick="nm_saida()"> 
        </form> 
       </td></tr></table>
       </td></tr></table>
<?php
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']))
              {
?>
<br /><br /><br />
<table align="center" class="scGridBorder" style="width: 450px"><tr><td style="padding: 0">
 <table style="width: 100%" class="scGridTabela">
  <tr class="scGridFieldOdd">
   <td class="scGridFieldOddFont" style="padding: 15px 30px">
    <?php echo $this->Nm_lang['lang_errm_unth_hwto']; ?>
   </td>
  </tr>
 </table>
</td></tr></table>
<?php
              }
?>
     </body>
     <?php
     $trab_path             = explode("/", $_SERVER['PHP_SELF']);
     $trab_count_path       = count($trab_path);
     $path_retorno_aplicacao  = "";
     for ($ix = 0; $ix + 2 < $trab_count_path; $ix++)
     {
         $path_retorno_aplicacao .=  $trab_path[$ix] . "/";
     }
     $path_retorno_aplicacao .=  "" . SC_dir_app_name('app_Login') . "/";
     $nm_redirect = $path_retorno_aplicacao;
     $saida_final = "window.location = '" . $nm_redirect . "'";
     ?>
    <script type="text/javascript">
      function nm_saida()
      {
<?php 
             echo $saida_final;
?> 
      }
     </script> 
<?php
    exit;
} 
$this->sc_Include($path_libs . "/nm_ini_lib.php", "F", "nm_dir_normaliza") ; 
if ((isset($nmgp_outra_jan) && $nmgp_outra_jan == "true") || (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'app_menu'))
{
    $_SESSION['sc_session'][1]['app_menu']['sc_outra_jan'] = true;
     unset($_SESSION['scriptcase']['sc_outra_jan']);
    $_SESSION['scriptcase']['sc_saida_app_menu'] = "javascript:window.close()";
}

/* Menú de configuración de las variables */
$app_menu_menuData['iframe'] = TRUE;

$app_menu_menuData['height'] = '100%';
if (!isset($_SESSION['scriptcase']['sc_apl_seg']))
{
    $_SESSION['scriptcase']['sc_apl_seg'] = array();
}
if(is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/blankbg_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] . '_lib/_app_data/blankbg_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
      if (!isset($_SESSION['scriptcase']['sc_apl_seg']['blankbg']))
      {
        $_SESSION['scriptcase']['sc_apl_seg']['blankbg'] = "on";
      }
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['blankbg'] = "on";
} 
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_menu_category_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_menu_category_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_menu_category']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_menu_category'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_menu_category'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_room_now_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_room_now_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_room_now']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_room_now'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_room_now'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/kitchen_monitor_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/kitchen_monitor_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['kitchen_monitor']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['kitchen_monitor'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['kitchen_monitor'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tb_customers_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tb_customers_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tb_customers']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tb_customers'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tb_customers'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_admin_reservations_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_admin_reservations_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_admin_reservations']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_admin_reservations'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_admin_reservations'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_tb_menu_category_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_tb_menu_category_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_tb_menu_category']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_tb_menu_category'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_tb_menu_category'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_restaurant_menu_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_restaurant_menu_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_restaurant_menu']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_restaurant_menu'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_restaurant_menu'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_tb_stages_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_tb_stages_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_tb_stages']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_tb_stages'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_tb_stages'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_tb_order_status_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_tb_order_status_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_tb_order_status']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_tb_order_status'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_tb_order_status'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_tb_kitchen_status_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_tb_kitchen_status_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_tb_kitchen_status']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_tb_kitchen_status'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_tb_kitchen_status'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_tb_restaurant_room_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_tb_restaurant_room_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_tb_restaurant_room']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_tb_restaurant_room'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_tb_restaurant_room'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_tb_restaurant_tables_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_tb_restaurant_tables_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_tb_restaurant_tables']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_tb_restaurant_tables'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_tb_restaurant_tables'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_grid_sec_users_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_grid_sec_users_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_users']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_users'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_users'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_grid_sec_apps_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_grid_sec_apps_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_apps']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_apps'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_apps'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_grid_sec_groups_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_grid_sec_groups_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_groups']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_groups'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_groups'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_grid_sec_users_groups_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_grid_sec_users_groups_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_users_groups']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_users_groups'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_users_groups'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_search_sec_groups_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_search_sec_groups_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_search_sec_groups']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['app_search_sec_groups'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['app_search_sec_groups'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_sync_apps_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_sync_apps_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_sync_apps']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['app_sync_apps'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['app_sync_apps'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_add_2fa_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_add_2fa_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_add_2fa']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['app_add_2fa'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['app_add_2fa'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_settings_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_settings_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_settings']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['app_settings'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['app_settings'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_change_pswd_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_change_pswd_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_change_pswd']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['app_change_pswd'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['app_change_pswd'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_Login_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/app_Login_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_Login']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['app_Login'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['app_Login'] = "on";
    } 
}

$sOutputBuffer = ob_get_contents();
ob_end_clean();

/* Archivos JS */
header("X-XSS-Protection: 1; mode=block");
header("X-Frame-Options: SAMEORIGIN");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?> style="height: 100%">
<head>
 <title>Restaurant Pizza House</title>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
 <?php
 if ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
 {
  ?>
   <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
  <?php
 }
 ?>
 <link rel="shortcut icon" href="../_lib/img/grp__NM__img__NM__sc_restaurant.png">
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
 <link rel="stylesheet" type="text/css" href="<?php echo $url_third; ?>/jquery_plugin/vakata-jstree/themes/default/style.min.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuT.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuT<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $Str_btn_css ?>" /> 
 <link rel="stylesheet" href="<?php echo $_SESSION['scriptcase']['app_menu']['glo_nm_path_prod']; ?>/third/font-awesome/6/css/all.min.css" type="text/css" media="screen" />
<script  type="text/javascript" src="<?php echo $url_third; ?>/jquery/js/jquery.js"></script>
<script  type="text/javascript" src="<?php echo $url_third; ?>/jquery/js/jquery-ui.js"></script>
<script  type="text/javascript" src="<?php echo $url_third; ?>/jquery_plugin/vakata-jstree/jstree.min.js"></script>
<script  type="text/javascript" src="<?php echo $url_third; ?>/jquery_plugin/layout/jquery.layout.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['app_menu']['glo_nm_path_prod']; ?>/third/sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['app_menu']['glo_nm_path_prod']; ?>/third/sweetalert/polyfill.min.js"></script>
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
<script type="text/javascript" src="app_menu_message.js"></script>
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
<style>
   .scTabText {
   }</style>
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
<body style="height: 100%" scroll="no" class='scMenuTPage'>
<?php
$str_bmenu = nmButtonOutput($this->arr_buttons, "bmenu", "showMenu();", "showMenu();", "bmenu", "", "" . $this->Nm_lang['lang_btns_menu'] . "", "position:absolute; top:4px; left:2px;z-index:9999;", "absmiddle", "", "0px", $this->path_botoes, "", "" . $this->Nm_lang['lang_btns_menu_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
if($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
    $menu_mobile_hide          = $mobile_menu_mobile_hide;
    $menu_mobile_inicial_state = $mobile_menu_mobile_inicial_state;
    $menu_mobile_hide_onclick  = $mobile_menu_mobile_hide_onclick;
    $menutree_mobile_float     = $mobile_menutree_mobile_float;
    $menu_mobile_hide_icon     = $mobile_menu_mobile_hide_icon;
    $menu_largura              = '250';
}
$str_menu_display = 'false';
$str_menu_display_float = false;
if($menu_mobile_hide == 'S')
{
    if($menu_mobile_inicial_state =='escondido')
    {
            $str_menu_display='true';
            $str_btn_display="show";
    }
    else
    {
            $str_menu_display='false';
            $str_btn_display="hide";
    }
    if($menu_mobile_hide_icon != 'S')
    {
        $str_btn_display="show";
    }
?>
<script>
    $( document ).ready(function() {
        <?php if($_SESSION['scriptcase']['display_mobile'] === true) { ?>
        $('#menu-container').width('250px');
        $('#div_contrl_abas').css('-webkit-overflow-scrolling','touch');
        $('.ui-layout-center').css('-webkit-overflow-scrolling','touch');
        $('#div_contrl_abas').css('overflow','auto');
        $('.ui-layout-center').css('overflow','auto');
        <?php } ?>
        $('#bmenu').<?php echo $str_btn_display; ?>();
        <?php
        if($menu_mobile_hide_icon != 'S')
        {
            ?>
            $('#css3menut').css('margin-top', $('#bmenu').outerHeight());

            <?php
        }
        ?>
        $('#bmenu').css('left', '0px');
        $('#bmenu').css('top', $('.scMenuTHeader').height());
    });
    function showMenu()
    {
      <?php
      if($menu_mobile_hide_icon == 'S')
      {
      ?>
                $('#bmenu').hide();
      <?php
      }
      ?>
            myLayout.toggle('west');
    }
    function HideMenu()
    {
      <?php
      if($menu_mobile_hide_icon == 'S')
      {
      ?>
                $('#bmenu').show();
      <?php
      }
      ?>
            myLayout.toggle('west');
    }
</script>
<?php
echo $str_bmenu;
}
?>
<?php 
        $NM_scr_iframe = (isset($_POST['hid_scr_iframe'])) ? $_POST['hid_scr_iframe'] : "";   
?> 

        <script  type="text/javascript">
                        var myLayout; // a var is required because this page utilizes: myLayout.allowOverflow() method
                        $(document).ready(function () {
                                myLayout = $('body').layout({
                                west__size: <?php echo $menu_largura;?>
                                        ,west__showOverflowOnHover : false
                                        ,east__showOverflowOnHover : false
                                        ,north__slidable           : false
                                        ,north__resizable          : false
                                        ,north__closable           : false
                                        ,north__spacing_open       : 0
                                        ,north__spacing_closed     : 0
                                        ,south__slidable           : false
                                        ,south__resizable          : false
                                        ,south__closable           : false
                                        ,south__spacing_open       : 0
                                        ,south__spacing_closed     : 0
                                        ,west__resizable           : false
                                        ,west__spacing_open        : 0
                                        ,west__spacing_closed      : 0
                                        ,east__resizable           : false
                                        ,east__spacing_open        : 0
                                        ,east__spacing_closed      : 0
                                        ,west__initClosed          : <?php echo $str_menu_display; ?>
                                        ,east__initClosed          : <?php echo $str_menu_display; ?>
                                
                                });
                                $('#css3menut').jstree({
                                        
                                        'plugins' : [ ]
                                  }).on("select_node.jstree",function(e, data) {
                                      str_link   = '';
                                      str_target = '';
                                      if(data.instance.is_leaf(data.node))
                                      {
                                        str_link   = data.node.a_attr.href;
                                        str_target = data.node.a_attr.target;
                                      }
                                      else
                                      {
                                        data.instance.toggle_node(data.node);
                                        str_link   = $('#' + data.node.id + ' > a > span > a').attr('href');
                                        str_target = $('#' + data.node.id + ' > a > span > a').attr('target');
                                      }

                                      //test link type
                                      if(str_link !== undefined && str_link != '' && str_target != '')
                                      {
                                          if(str_link.substring(0, 11) == 'javascript:')
                                          {
                                            eval(str_link.substring(11));
                                          }
                                          else if(str_link != '#')
                                          {
                                            if(str_target == '_parent')
                                            {
                                                            str_target = '_self';
                                            }
                                            window.open(str_link, str_target);
                                          }
                                      }
                                });
                                $('#css3menut').jstree().close_all();
                         });
                </script>
<script type="text/javascript">
var numl = 0;
var toBeHidden = 0;
function NM_show_menu()
{
   return true;
}
function NM_hide_menu()
{
   return true;
}
</script>

<style type="text/css">

        .ui-layout-pane { /* all 'panes' */
                        border: 0px solid #BBB;
                        padding: 0px;
                        overflow: auto;
        }
        .ui-layout-resizer { /* all 'resizer-bars' */
                        background: #DDD;
        }

        .ui-layout-toggler { /* all 'toggler-buttons' */
                        background: #AAA;
        }
        </style>
<?php

 $nm_var_hint[0] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[0]))
{
    $nm_var_hint[0] = sc_convert_encoding($nm_var_hint[0], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[1] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[1]))
{
    $nm_var_hint[1] = sc_convert_encoding($nm_var_hint[1], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[2] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[2]))
{
    $nm_var_hint[2] = sc_convert_encoding($nm_var_hint[2], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[3] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[3]))
{
    $nm_var_hint[3] = sc_convert_encoding($nm_var_hint[3], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[4] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[4]))
{
    $nm_var_hint[4] = sc_convert_encoding($nm_var_hint[4], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[5] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[5]))
{
    $nm_var_hint[5] = sc_convert_encoding($nm_var_hint[5], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[6] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[6]))
{
    $nm_var_hint[6] = sc_convert_encoding($nm_var_hint[6], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[7] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[7]))
{
    $nm_var_hint[7] = sc_convert_encoding($nm_var_hint[7], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[8] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[8]))
{
    $nm_var_hint[8] = sc_convert_encoding($nm_var_hint[8], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[9] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[9]))
{
    $nm_var_hint[9] = sc_convert_encoding($nm_var_hint[9], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[10] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[10]))
{
    $nm_var_hint[10] = sc_convert_encoding($nm_var_hint[10], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[11] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[11]))
{
    $nm_var_hint[11] = sc_convert_encoding($nm_var_hint[11], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[12] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[12]))
{
    $nm_var_hint[12] = sc_convert_encoding($nm_var_hint[12], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[13] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[13]))
{
    $nm_var_hint[13] = sc_convert_encoding($nm_var_hint[13], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[14] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[14]))
{
    $nm_var_hint[14] = sc_convert_encoding($nm_var_hint[14], $_SESSION['scriptcase']['charset'], "UTF-8");
}

$saida_apl = $_SESSION['scriptcase']['sc_saida_app_menu'];
$app_menu_menuData['data'] = array();
$nextLevelToBeWrite = false;
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_31&sc_apl_menu=grid_menu_category&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_menu_category']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_menu_category']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_tbl_tb_restaurant_menu'] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[0] . "",
        'id'       => "item_31",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_31",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-utensils",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_35&sc_apl_menu=grid_room_now&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_room_now']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_room_now']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_floor'] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[1] . "",
        'id'       => "item_35",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_35",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fab fa-delicious",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_36&sc_apl_menu=kitchen_monitor&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['kitchen_monitor']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['kitchen_monitor']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_kitchen_monitor'] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[2] . "",
        'id'       => "item_36",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_36",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-solar-panel",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$app_menu_menuData['data'][] = array(
    'label'    => "" . $this->Nm_lang['lang_admin'] . "",
    'level'    => "0",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[3] . "",
    'id'       => "item_43",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
    'sc_id'    => "item_43",
    'disabled' => $str_disabled,
    'display'  => "text_fontawesomeicon",
    'display_position'    => "text_right",
    'icon_fa'  => "fas fa-user-secret",
    'icon_fa_aba'  => "",
    'icon_fa_aba_inactive'  => "",
    'icon_color'  => "",
    'icon_color_hover'  => "",
    'icon_color_disabled'  => "",
);
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_37&sc_apl_menu=grid_tb_customers&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tb_customers']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tb_customers']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_tbl_tb_customers'] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[4] . "",
        'id'       => "item_37",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_37",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-user",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_34&sc_apl_menu=grid_admin_reservations&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_admin_reservations']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_admin_reservations']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_tbl_tb_reservations'] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[5] . "",
        'id'       => "item_34",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_34",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-calendar-alt",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_33&sc_apl_menu=form_tb_menu_category&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_tb_menu_category']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_tb_menu_category']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_tbl_tb_menu_category'] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[6] . "",
        'id'       => "item_33",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_33",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-book",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_28&sc_apl_menu=grid_restaurant_menu&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_restaurant_menu']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_restaurant_menu']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_tb_restaurant_menu_fld_header'] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[7] . "",
        'id'       => "item_28",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_28",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-utensils",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$app_menu_menuData['data'][] = array(
    'label'    => "" . $this->Nm_lang['lang_btns_settings'] . "",
    'level'    => "1",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[8] . "",
    'id'       => "item_32",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
    'sc_id'    => "item_32",
    'disabled' => $str_disabled,
    'display'  => "text_fontawesomeicon",
    'display_position'    => "text_right",
    'icon_fa'  => "fas fa-cogs",
    'icon_fa_aba'  => "",
    'icon_fa_aba_inactive'  => "",
    'icon_color'  => "",
    'icon_color_hover'  => "",
    'icon_color_disabled'  => "",
);
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_38&sc_apl_menu=form_tb_stages&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_tb_stages']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_tb_stages']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_tbl_tb_stages'] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[9] . "",
        'id'       => "item_38",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_38",
        'disabled' => $str_disabled,
        'display'  => "text_img",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-cog",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_39&sc_apl_menu=form_tb_order_status&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_tb_order_status']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_tb_order_status']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_tbl_tb_order_status'] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[10] . "",
        'id'       => "item_39",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_39",
        'disabled' => $str_disabled,
        'display'  => "text_img",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-cog",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_40&sc_apl_menu=form_tb_kitchen_status&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_tb_kitchen_status']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_tb_kitchen_status']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_tbl_tb_kitchen_status'] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[11] . "",
        'id'       => "item_40",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_40",
        'disabled' => $str_disabled,
        'display'  => "text_img",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-cog",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_41&sc_apl_menu=form_tb_restaurant_room&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_tb_restaurant_room']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_tb_restaurant_room']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_tbl_tb_restaurant_room'] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[12] . "",
        'id'       => "item_41",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_41",
        'disabled' => $str_disabled,
        'display'  => "text_img",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-cog",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_42&sc_apl_menu=form_tb_restaurant_tables&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_tb_restaurant_tables']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_tb_restaurant_tables']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_tbl_tb_restaurant_tables'] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[13] . "",
        'id'       => "item_42",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_42",
        'disabled' => $str_disabled,
        'display'  => "text_img",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-cog",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$app_menu_menuData['data'][] = array(
    'label'    => "" . $this->Nm_lang['lang_menu_security'] . "",
    'level'    => "0",
    'link'     => $str_link,
    'hint'     => "" . $this->Nm_lang['lang_menu_security'] . "",
    'id'       => "item_1",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
    'sc_id'    => "item_1",
    'disabled' => $str_disabled,
    'display'  => "text_fontawesomeicon",
    'display_position'    => "text_right",
    'icon_fa'  => "fas fa-user-shield",
    'icon_fa_aba'  => "",
    'icon_fa_aba_inactive'  => "",
    'icon_color'  => "",
    'icon_color_hover'  => "",
    'icon_color_disabled'  => "",
);
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_2&sc_apl_menu=app_grid_sec_users&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_users']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_users']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_list_users'] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $this->Nm_lang['lang_list_users'] . "",
        'id'       => "item_2",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_2",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-user-friends",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_3&sc_apl_menu=app_grid_sec_apps&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_apps']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_apps']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_list_apps'] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $this->Nm_lang['lang_list_apps'] . "",
        'id'       => "item_3",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_3",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-rocket",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_4&sc_apl_menu=app_grid_sec_groups&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_groups']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_groups']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_list_groups'] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $this->Nm_lang['lang_list_groups'] . "",
        'id'       => "item_4",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_4",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-users",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_11&sc_apl_menu=app_grid_sec_users_groups&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_users_groups']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['app_grid_sec_users_groups']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_list_users_x_groups'] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $this->Nm_lang['lang_list_users_x_groups'] . "",
        'id'       => "item_11",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_11",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-user-lock",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_5&sc_apl_menu=app_search_sec_groups&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_search_sec_groups']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['app_search_sec_groups']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['filter']['active']))
    {
        $icon_aba = $arr_menuicons['filter']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['filter']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['filter']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_list_apps_x_groups'] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $this->Nm_lang['lang_list_apps_x_groups'] . "",
        'id'       => "item_5",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_5",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-users-cog",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_6&sc_apl_menu=app_sync_apps&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_sync_apps']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['app_sync_apps']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_list_sync_apps'] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $this->Nm_lang['lang_list_sync_apps'] . "",
        'id'       => "item_6",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_6",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-sync-alt",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_68&sc_apl_menu=app_add_2fa&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_add_2fa']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['app_add_2fa']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
    {
        $icon_aba = $arr_menuicons['others']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['others']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_2fa'] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $this->Nm_lang['lang_2fa'] . "",
        'id'       => "item_68",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_68",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-fingerprint",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_69&sc_apl_menu=app_settings&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_settings']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['app_settings']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_settings'] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[14] . "",
        'id'       => "item_69",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_69",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-wrench",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_7&sc_apl_menu=app_change_pswd&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_change_pswd']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['app_change_pswd']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_change_pswd'] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $this->Nm_lang['lang_change_pswd'] . "",
        'id'       => "item_7",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_self') . "\"",
        'sc_id'    => "item_7",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-key",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );
$str_disabled = "N";
$str_link = "app_menu_form_php.php?sc_item_menu=item_8&sc_apl_menu=app_Login&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_Login']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['app_Login']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contrusr']['active']))
    {
        $icon_aba = $arr_menuicons['contrusr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contrusr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contrusr']['inactive'];
    }
    $app_menu_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_exit'] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $this->Nm_lang['lang_exit'] . "",
        'id'       => "item_8",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->app_menu_target('_parent') . "\"",
        'sc_id'    => "item_8",
        'disabled' => $str_disabled,
        'display'  => "text_fontawesomeicon",
        'display_position'    => "text_right",
        'icon_fa'  => "fas fa-sign-out-alt",
        'icon_fa_aba'  => "",
        'icon_fa_aba_inactive'  => "",
        'icon_color'  => "",
        'icon_color_hover'  => "",
        'icon_color_disabled'  => "",
    );

if (isset($_SESSION['scriptcase']['sc_def_menu']['app_menu']))
{
    $arr_menu_usu = $this->nm_arr_menu_recursiv($_SESSION['scriptcase']['sc_def_menu']['app_menu']);
    $this->nm_gera_menus($str_menu_usu, $arr_menu_usu, 1, 'app_menu');
    $app_menu_menuData['data'] = $str_menu_usu;
}
if (is_file("app_menu_help.txt"))
{
    $Arq_WebHelp = file("app_menu_help.txt"); 
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
                $app_menu_menuData['data'][] = array(
                    'label'    => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'level'    => "0",
                    'link'     => $str_link,
                    'hint'     => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'id'       => "item_Help",
                    'icon'     => $str_icon,
                    'icon_aba' => $icon_aba,
                    'icon_aba_inactive' => $icon_aba_inactive,
                    'target'   => "" . $this->app_menu_target('_blank') . "",
                    'sc_id'    => "item_Help",
                    'disabled' => $str_disabled,
                    'display'  => "text",
                    'display_position'    => "",
                    'icon_fa'  => "",
                    'icon_fa_aba'  => "",
                    'icon_fa_aba_inactive'  => "",
                    'icon_color'  => "",
                    'icon_color_hover'  => "",
                    'icon_color_disabled'  => "",
                );
            }
        }
    }
}

if (isset($_SESSION['scriptcase']['sc_menu_del']['app_menu']) && !empty($_SESSION['scriptcase']['sc_menu_del']['app_menu']))
{
    $nivel = 0;
    $exclui_menu = false;
    foreach ($app_menu_menuData['data'] as $i_menu => $cada_menu)
    {
       if (in_array($cada_menu['id'], $_SESSION['scriptcase']['sc_menu_del']['app_menu']))
       {
          $nivel = $cada_menu['level'];
          $exclui_menu = true;
          unset($app_menu_menuData['data'][$i_menu]);
       }
       elseif ( empty($cada_menu) || ($exclui_menu && $nivel < $cada_menu['level']))
       {
          unset($app_menu_menuData['data'][$i_menu]);
       }
       else
       {
          $exclui_menu = false;
       }
    }
    $Temp_menu = array();
    foreach ($app_menu_menuData['data'] as $i_menu => $cada_menu)
    {
        $Temp_menu[] = $cada_menu;
    }
    $app_menu_menuData['data'] = $Temp_menu;
}

if (isset($_SESSION['scriptcase']['sc_menu_disable']['app_menu']) && !empty($_SESSION['scriptcase']['sc_menu_disable']['app_menu']))
{
    $disable_menu = false;
    foreach ($app_menu_menuData['data'] as $i_menu => $cada_menu)
    {
       if (in_array($cada_menu['id'], $_SESSION['scriptcase']['sc_menu_disable']['app_menu']))
       {
          $nivel = $cada_menu['level'];
          $disable_menu = true;
          $app_menu_menuData['data'][$i_menu]['disabled'] = 'Y';
       }
       elseif (!empty($cada_menu) && $disable_menu && $nivel < $cada_menu['level'])
       { 
          $app_menu_menuData['data'][$i_menu]['disabled'] = 'Y';
       }
       elseif (!empty($cada_menu))
       {
          $disable_menu = false;
       }
    }
}

$level_to_delete = false;
foreach ($app_menu_menuData['data'] as $chave => $cada_menu)
{
        if($level_to_delete !== false && $app_menu_menuData['data'][$chave]['level'] > $level_to_delete)
        {
                unset($app_menu_menuData['data'][$chave]);
        }
        else
        {
                $level_to_delete = false;
                
                if ($app_menu_menuData['data'][$chave]['disabled'] == 'Y')
                {
                        $level_to_delete = $app_menu_menuData['data'][$chave]['level'];
                        unset($app_menu_menuData['data'][$chave]);
                }
        }
}
$app_menu_menuData['data'] = array_values($app_menu_menuData['data']);
$flag = 1;
while ($flag == 1)
{
    $flag = 0;
    foreach ($app_menu_menuData['data'] as $chave => $cada_menu)
    {
        if (!empty($cada_menu))
        {
            if ($app_menu_menuData['data'][$chave]['disabled'] == 'Y')
            {
                    unset($app_menu_menuData['data'][$chave]['disabled']);
                    foreach ($app_menu_menuData['data'] as $_key => $_val)
                    {
                            if($_key > $chave)
                            {
                                    if($app_menu_menuData['data'][$_key]['level'] > $app_menu_menuData['data'][$chave]['level'])
                                    {
                                            unset($app_menu_menuData['data'][$_key]);
                                    }
                                    else
                                    {
                                            break;
                                    }
                            }
                    }
            }
            if (isset($app_menu_menuData['data'][$chave + 1]) && !empty($app_menu_menuData['data'][$chave + 1]))
            {
                if ($app_menu_menuData['data'][$chave]['link'] == "#")
                {
                    if ($app_menu_menuData['data'][$chave]['level'] >= $app_menu_menuData['data'][$chave + 1]['level'] )
                    {
                        unset($app_menu_menuData['data'][$chave]);
                        $flag = 1;
                    }
                }
            }
            elseif ($app_menu_menuData['data'][$chave]['link'] == "#")
            {
                unset($app_menu_menuData['data'][$chave]);
            }
        }
    }
    $app_menu_menuData['data'] = array_values($app_menu_menuData['data']);
}

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
<div class="ui-layout-north">
<?php
if ('' != $sOutputBuffer)
{
    echo $sOutputBuffer;
}
?>
</div>
<?php
    $link_default = "";
    if (isset($_SESSION['scriptcase']['sc_apl_seg']['blankbg']) && $_SESSION['scriptcase']['sc_apl_seg']['blankbg'] == "on") 
    { 
    $_SESSION['scriptcase']['app_menu']['apl_inicial'] = "";
    $link_default = " onclick=\"openMenuItem('iframe_app_menu');\" item-href=\"app_menu_form_php.php?sc_item_menu=app_menu&sc_apl_menu=blankbg&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "\"  item-target=\"app_menu_iframe\"";
    } 
    else
    { 
        $_SESSION['scriptcase']['app_menu']['apl_inicial'] = ($NM_scr_iframe != "") ? $NM_scr_iframe : "app_menu_pag_ini.php";
    } 
    $_SESSION['scriptcase']['app_menu']['path_link'] = $path_link;
?>
<div class="ui-layout-west">
<table id="main_menutree_table" cellspacing=0 cellpadding=0 class="scMenuTTable" style="height: 100%; width: 100%">
    <tr class="scMenuTTable">
        <td class="scMenuTTableM" valign="top">
                <table cellpadding=0 cellspacing=0>
                    <tr>
                       <td>
                      <?php
                      echo $this->app_menu_escreveMenu($app_menu_menuData['data']);
                      ?>
                            </td>
                    </tr>
                </table>
        </td>
      </tr>
    </table>
</div>
<div class="ui-layout-center">
  <table cellspacing=0 cellpadding=0 style="height: 100%; width: 100%" cellpadding=0 cellspacing=0>
    <tr>
      
        <td id="Iframe_control" style="border: 0px; height: 100%; width:100%; vertical-align:top;text-align:center;padding: 0px">
        <iframe name="app_menu_iframe" id="iframe_app_menu" frameborder="0" class="scMenuIframe" style="width: 100%; height: 100%;"  src="<?php echo $_SESSION['scriptcase']['app_menu']['apl_inicial']?>"<?php echo $link_default ?>></iframe>
      </tr>
    </table>
</div>
<script type="text/javascript">
 function nm_out_menu(link)
 {
    if (link == 'javascript:window.close()')
    {
        window.close();
    }
    else
    {
        window.location = (link);
    }
 }

function expandMenu()
{
    myLayout.toggle('west');

    $('#id_expand').hide();
    $('#id_collapse').show();
}
function focusFrame()
{
    setTimeout( function () {
        $('iframe').not(':hidden')[0].contentWindow.focus();
    }, 500);
}

function collapseMenu()
{
    myLayout.toggle('west');

    $('#id_expand').show();
    $('#id_collapse').hide();
}
Iframe_atual = "app_menu_iframe";
Tab_links = new Array();
<?php
echo "Tab_links['app_menu']   = \"\";\r\n";
 if(isset($app_menu_menuData['data']) && !empty($app_menu_menuData['data']))
 {
   foreach ($app_menu_menuData['data'] as $ind => $dados_menu)
   {
     if ($dados_menu['link'] != "#")
     {
         echo "Tab_links['" . $dados_menu['id'] . "']   = \"\";\r\n";
     }
  }
}
 if(isset($app_menu_menuData['data_vertical']) && !empty($app_menu_menuData['data_vertical']))
 {
   foreach ($app_menu_menuData['data_vertical'] as $ind => $dados_menu)
   {
     if ($dados_menu['link'] != "#")
     {
         echo "Tab_links['" . $dados_menu['id'] . "']   = \"\";\r\n";
     }
  }
  }
 if(isset($app_menu_menuData['data_user']) && !empty($app_menu_menuData['data_user']))
 {
   foreach ($app_menu_menuData['data_user'] as $ind => $dados_menu)
   {
     if ($dados_menu['link'] != "#")
     {
         echo "Tab_links['" . $dados_menu['id'] . "']   = \"\";\r\n";
     }
  }
}
?>
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
  if (str_id != "iframe_app_menu")
  {
      str_id        = str_id.replace("app_menu_","");
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
    str_id = str_id.replace('iframe_app_menu', 'app_menu');
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
    if(str_target != '_blank' && $('#iframe_app_menu').length)
        $('#iframe_app_menu')[0].contentWindow.focus();
  }
}
function writeFastMenu(arr_link)
{
    var link_ok = "";
    for (i = 0; i < arr_link.length; i++) 
    {
        if (link_ok != "")
        {
            link_ok += "<img src='<?php echo $path_imag_cab . "/" . $this->breadcrumbline_separator; ?>'>";
        }
        link_ok += arr_link[i].replace(/#NMIframe#/g, Iframe_atual);
    }
    document.getElementById('links_apls_itens').innerHTML = link_ok;
    $('#links_apls').show();
}
function clearFastMenu()
{
    document.getElementById('links_apls_itens').innerHTML = '';
    $('#links_apls').hide();
}
<?php
if (isset($link_default) && !empty($link_default))
{
    echo "   document.getElementById('iframe_app_menu').click();\r\n";
}
?>
</script>
</body>
</html>
<?php
}
/* Control de Target */
function app_menu_escreveMenu($arr_menu)
{
    $aMenuItemList = array();
    foreach ($arr_menu as $ind => $resto)
    {
        $aMenuItemList[] = $resto;
    }
?>
<div id="css3menut">
    <ul>
        <?php
            for ($i = 0; $i < sizeof($aMenuItemList); $i++) {
            ?>
            
            <?php
                if ('' != $aMenuItemList[$i]['icon'] && file_exists($this->path_imag_apl . "/" . $aMenuItemList[$i]['icon'])) {
                    $iconHtml = 'data-jstree=\'{ "icon" : "../_lib/img/'. $aMenuItemList[$i]['icon'] .'" }\'';
                }
                else {
                    $iconHtml = '';
                }
                $sDisabledClass = '';
                if ('Y' == $aMenuItemList[$i]['disabled']) {
                    $aMenuItemList[$i]['link']   = '#';
                    $aMenuItemList[$i]['target'] = '';
                    $sDisabledClass               = 0 == $aMenuItemList[$i]['level'] ? ' scMenuTItemDisabled' : ' scMenuTSubItemDisabled';
                }
                $li_style = '';
                if($aMenuItemList[$i]['display'] == 'only_img')
                {
                    $aMenuItemList[$i]['label'] = '';
                }
                elseif($aMenuItemList[$i]['display'] == 'text_img' || empty($aMenuItemList[$i]['display']))
                {
                }
                elseif($aMenuItemList[$i]['display'] == 'only_fontawesomeicon')
                {
                    $iconHtml = 'data-jstree=\'{ "icon" : "'. $sDisabledClass. ' ' .$aMenuItemList[$i]['id'] .' icon_fa '. $aMenuItemList[$i]['icon_fa'] .' scMenuTItemsFont" }\'';
                    $li_style = 'background-image:none !important';
                    $aMenuItemList[$i]['label'] = "";
                }
                elseif($aMenuItemList[$i]['display'] == 'text_fontawesomeicon')
                {
                    $iconHtml = 'data-jstree=\'{ "icon" : "'. $sDisabledClass. ' ' .$aMenuItemList[$i]['id'] .' icon_fa '. $aMenuItemList[$i]['icon_fa'] .' scMenuTItemsFont" }\'';
                    $li_style = 'background-image:none !important';
                }
                else
                {
                    $iconHtml = '';
                }
                if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] < $aMenuItemList[$i + 1]['level']) {
                  if ($aMenuItemList[$i]['link'] == '#')
                  {
                  ?>
                     <li <?php echo $iconHtml; ?> style="<?php echo $li_style; ?>"><span class="scMenuTItems<?php echo $sDisabledClass; ?>"><?php echo $aMenuItemList[$i]['label']; ?></span><ul>
                  <?php
                  }
                  else
                  {
                    $focusFrame = 'focusFrame();';
                    if(strpos($aMenuItemList[$i]['target'], '_blank') !== false)
                    {
                      $focusFrame = '';
                    }
                  ?>
                     <li <?php echo $iconHtml; ?> style="<?php echo $li_style; ?>"><span class="scMenuTItems scMenuTItem"><a href="<?php echo $aMenuItemList[$i]['link']; ?>" onclick="<?php echo $focusFrame; ?>; HideMenu();" id="<?php echo $aMenuItemList[$i]['id']; ?>" title="<?php echo $aMenuItemList[$i]['hint']; ?>"<?php echo $aMenuItemList[$i]['target']; ?> class="scMenuTItem"><?php echo $aMenuItemList[$i]['label']; ?></a></span><ul>
                  <?php
                  }
                }
                else
                {
                  if ($aMenuItemList[$i]['link'] == '#')
                  {
                    ?>
                    <li <?php echo $iconHtml; ?> class="scMenuTItems<?php echo $sDisabledClass; ?>" style="<?php echo $li_style; ?>"><a href='#' target=''><?php echo $aMenuItemList[$i]['label']; ?></a>
                    <?php
                  }
                  else
                  {
                    $focusFrame = 'focusFrame();';
                    if(strpos($aMenuItemList[$i]['target'], '_blank') !== false)
                    {
                      $focusFrame = '';
                    }
                    ?>
                    <li <?php echo $iconHtml; ?> class="scMenuTItems scMenuTItem" style="<?php echo $li_style; ?>"><a href="<?php echo $aMenuItemList[$i]['link']; ?>" onclick="<?php echo $focusFrame; ?> HideMenu();" id="<?php echo $aMenuItemList[$i]['id']; ?>" title="<?php echo $aMenuItemList[$i]['hint']; ?>"<?php echo $aMenuItemList[$i]['target']; ?> class="scMenuTItem"><?php echo $aMenuItemList[$i]['label']; ?></a>
                    <?php
                  }
                }
                if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] == $aMenuItemList[$i + 1]['level']) {
                ?>
                    </li>
                <?php
                }
                elseif ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > $aMenuItemList[$i + 1]['level']) {
                ?>
                    </li><?php echo str_repeat('</ul></li>', $aMenuItemList[$i]['level'] - $aMenuItemList[$i + 1]['level']); ?>
                <?php
                }
                elseif (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > 0) {
                ?>
                    </li><?php echo str_repeat('</ul></li>', $aMenuItemList[$i]['level']); ?>
                <?php
                }
                elseif (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] == 0) {
                ?>
                    </li>
                <?php
                }
            }
        ?>
    </ul>
</div>
<?php
}
/* Control de Target */
   function app_menu_target($str_target)
   {
       global $app_menu_menuData;
       if ('_blank' == $str_target)
       {
           return '_blank';
       }
       elseif ('_parent' == $str_target)
       {
           return '_parent';
       }
       elseif ($app_menu_menuData['iframe'])
       {
           return 'app_menu_iframe';
       }
       else
       {
           return $str_target;
       }
   }

   function nm_prot_aspas($str_item)
   {
       return str_replace('"', '\"', $str_item);
   }

   function nm_gera_menus(&$str_line_ret, $arr_menu_usu, $int_level, $nome_aplicacao)
   {
       global $app_menu_menuData; 
       $str_marg = str_repeat('&nbsp;', 2);
       $str_marg = '';
       foreach ($arr_menu_usu as $arr_item)
       {
           $str_line   = array();
           $str_line['label']    = $this->nm_prot_aspas($arr_item['label']);
           $str_line['level']    = $int_level - 1;
           $str_line['link']     = "";
           $nome_apl = $arr_item['link'];
           $pos = strrpos($nome_apl, "/");
           if ($pos !== false)
           {
               $nome_apl = substr($nome_apl, $pos + 1);
           }
           if ('' != $arr_item['link'])
           {
               if ($arr_item['target'] == '_parent')
               {
                    $str_line['link'] = "javascript:parent.nm_out_menu('app_menu_form_php.php?sc_item_menu=" . $arr_item['id'] . "&sc_apl_menu=" . $nome_apl . "&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . "')";  
               }
               else
               {
                    $str_line['link'] = "app_menu_form_php.php?sc_item_menu=" . $arr_item['id'] . "&sc_apl_menu=" . $nome_apl . "&sc_apl_link=" . urlencode($app_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['app_menu']['glo_nm_usa_grupo'] . ""; 
               }
           }
           elseif ($arr_item['target'] == '_parent')
           {
               $str_line['link'] = "javascript:parent.nm_out_menu('" . $_SESSION['scriptcase']['sc_saida_app_menu'] . "')"; 
           }
           $str_line['hint']     = ('' != $arr_item['hint']) ? $this->nm_prot_aspas($arr_item['hint']) : '';
           $str_line['id']       = $arr_item['id'];
           $str_line['icon']     = ('' != $arr_item['icon_on']) ? $arr_item['icon_on'] : '';
           $str_line['icon_aba'] = (isset($arr_item['icon_aba']) && !empty($arr_item['icon_aba'])) ? $arr_item['icon_aba'] : '';
           $str_line['icon_aba_inactive'] = (isset($arr_item['icon_aba_inactive']) && !empty($arr_item['icon_aba_inactive'])) ? $arr_item['icon_aba_inactive'] : '';
           $str_line['display'] = (isset($arr_item['display']) && !empty($arr_item['display'])) ? $arr_item['display'] : 'text_img';
           $str_line['display_position'] = (isset($arr_item['display_position']) && !empty($arr_item['display_position'])) ? $arr_item['display_position'] : 'text_right';
           $str_line['icon_fa'] = (isset($arr_item['icon_fa']) && !empty($arr_item['icon_fa'])) ? $arr_item['icon_fa'] : '';
           $str_line['icon_fa_aba'] = (isset($arr_item['icon_fa_aba']) && !empty($arr_item['icon_fa_aba'])) ? $arr_item['icon_fa_aba'] : '';
           $str_line['icon_fa_aba_inactive'] = (isset($arr_item['icon_fa_aba_inactive']) && !empty($arr_item['icon_fa_aba_inactive'])) ? $arr_item['icon_fa_aba_inactive'] : '';
           $str_line['icon_color'] = (isset($arr_item['icon_color']) && !empty($arr_item['icon_color'])) ? $arr_item['icon_color'] : '';
           $str_line['icon_color_hover'] = (isset($arr_item['icon_color_hover']) && !empty($arr_item['icon_color_hover'])) ? $arr_item['icon_color_hover'] : '';
           $str_line['icon_color_disabled'] = (isset($arr_item['icon_color_disabled']) && !empty($arr_item['icon_color_disabled'])) ? $arr_item['icon_color_disabled'] : '';
           if ('' == $arr_item['link'] && $arr_item['target'] == '_parent')
           {
               $str_line['target'] = '_parent';
           }
           else
           {
                $str_line['target'] = ('' != $arr_item['target'] && '' != $arr_item['link']) ?  $this->app_menu_target( $arr_item['target']) : "_self"; 
           }
           $str_line['target']   = ' target="' . $str_line['target']  . '" ';
           $str_line['sc_id']    = $arr_item['id'];
           $str_line['disabled'] = "N";
           $str_line_ret[] = $str_line;
           if (!empty($arr_item['menu_itens']))
           {
               $this->nm_gera_menus($str_line_ret, $arr_item['menu_itens'], $int_level + 1, $nome_aplicacao);
           }
       }
   }

   function nm_arr_menu_recursiv($arr, $id_pai = '')
   {
         $arr_return = array();
         foreach ($arr as $id_menu => $arr_menu)
         {
             if ($id_pai == $arr_menu['pai']) 
             {
                 $arr_return[] = array('label'      => $arr_menu['label'],
                                        'link'       => $arr_menu['link'],
                                        'target'     => $arr_menu['target'],
                                        'icon_on'    => $arr_menu['icon'],
                                        'icon_aba'   => $arr_menu['icon_aba'],
                                        'icon_aba_inactive'   => $arr_menu['icon_aba_inactive'],
                                        'hint'       => $arr_menu['hint'],
                                        'id'         => $id_menu,
                                        'menu_itens' => $this->nm_arr_menu_recursiv($arr, $id_menu),
                                        'display'    => $arr_menu['display'],
                                        'display_position'   => $arr_menu['display_position'],
                                        'icon_fa'    => $arr_menu['icon_fa'],
                                        'icon_fa_aba'    => $arr_menu['icon_fa_aba'],
                                        'icon_fa_aba_inactive'    => $arr_menu['icon_fa_aba_inactive'],
                                        'icon_color'    => $arr_menu['icon_color'],
                                        'icon_color_hover'    => $arr_menu['icon_color_hover'],
                                        'icon_color_disabled'    => $arr_menu['icon_color_disabled'],
                              );
             }
         }
         return $arr_return;
   }
   function Gera_sc_init($apl_menu)
   {
        $_SESSION['scriptcase']['app_menu']['sc_init'][$apl_menu] = 1;
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
       $_SESSION['scriptcase']['reg_conf']['date_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_format'] : "mmddyyyy";
       $_SESSION['scriptcase']['reg_conf']['date_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_sep'] : "/";
       $_SESSION['scriptcase']['reg_conf']['date_week_ini'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema'] : "SU";
       $_SESSION['scriptcase']['reg_conf']['time_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_format'] : "hhiiss";
       $_SESSION['scriptcase']['reg_conf']['time_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_sep'] : ":";
       $_SESSION['scriptcase']['reg_conf']['time_pos_ampm'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm'] : "right_without_space";
       $_SESSION['scriptcase']['reg_conf']['time_simb_am']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am'] : "am";
       $_SESSION['scriptcase']['reg_conf']['time_simb_pm']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm'] : "pm";
       $_SESSION['scriptcase']['reg_conf']['simb_neg']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg'] : "-";
       $_SESSION['scriptcase']['reg_conf']['grup_num']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr'] : ",";
       $_SESSION['scriptcase']['reg_conf']['dec_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec'] : ".";
       $_SESSION['scriptcase']['reg_conf']['neg_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg'] : 2;
       $_SESSION['scriptcase']['reg_conf']['monet_simb']    = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo'] : "$";
       $_SESSION['scriptcase']['reg_conf']['monet_f_pos']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'] : 3;
       $_SESSION['scriptcase']['reg_conf']['monet_f_neg']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'] : 13;
       $_SESSION['scriptcase']['reg_conf']['grup_val']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr'] : ",";
       $_SESSION['scriptcase']['reg_conf']['dec_val']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec'] : ".";
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
    if (isset($_COOKIE['sc_apl_default_restaurant'])) {
        $apl_def = explode(",", $_COOKIE['sc_apl_default_restaurant']);
    }
    elseif (is_file($root . $_SESSION['scriptcase']['app_menu']['glo_nm_path_imag_temp'] . "/sc_apl_default_restaurant.txt")) {
        $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['app_menu']['glo_nm_path_imag_temp'] . "/sc_apl_default_restaurant.txt"));
    }
    if (isset($apl_def)) {
        if ($apl_def[0] != "app_menu") {
            $_SESSION['scriptcase']['sem_session'] = true;
            if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                $_SESSION['scriptcase']['app_menu']['session_timeout']['redir'] = $apl_def[0];
            }
            else {
                $_SESSION['scriptcase']['app_menu']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
            }
            $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
            $_SESSION['scriptcase']['app_menu']['session_timeout']['redir_tp'] = $Redir_tp;
        }
        if (isset($_COOKIE['sc_actual_lang_restaurant'])) {
            $_SESSION['scriptcase']['app_menu']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_restaurant'];
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
$contr_app_menu = new app_menu_class;
$contr_app_menu->app_menu_menu();

?>
