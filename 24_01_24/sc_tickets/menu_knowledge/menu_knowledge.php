<?php
include_once('menu_knowledge_session.php');
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
$_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod']      = "/scriptcase/prod";
$_SESSION['scriptcase']['menu_knowledge']['glo_nm_perfil']         = "";
$_SESSION['scriptcase']['menu_knowledge']['glo_nm_conexao']        = "conn_example";
$_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_imag_temp'] = "/scriptcase/tmp";
$_SESSION['scriptcase']['menu_knowledge']['glo_nm_usa_grupo']      = "S";
//check publication with the prod
$str_path_apl_url  = $_SERVER['PHP_SELF'];
$str_path_apl_url  = str_replace("\\", '/', $str_path_apl_url);
$str_path_apl_url  = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
$str_path_apl_url  = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
//check prod
if(empty($_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod']))
{
   /*check prod*/$_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
}
//check tmp
if(empty($_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_imag_temp']))
{
   /*check tmp*/$_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
}
//end check publication with the prod

ob_start();


class menu_knowledge_class
{
  var $Db;

 function sc_Include($path, $tp, $name)
 {
     if ((empty($tp) && empty($name)) || ($tp == "F" && !function_exists($name)) || ($tp == "C" && !class_exists($name)))
     {
         include_once($path);
     }
 } // sc_Include

 function menu_knowledge_menu()
 {
    global $menu_knowledge_menuData;
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
$_SESSION['scriptcase']['menu_knowledge']['contr_erro'] = 'off';
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
    $nm_url_saida = $_SESSION['scriptcase']['sc_saida_menu_knowledge'];
}
elseif (!empty($nm_url_saida))
{
    $_SESSION['scriptcase']['sc_url_saida'][$script_case_init]  = $nm_url_saida;
    $_SESSION['scriptcase']['sc_saida_menu_knowledge'] = $nm_url_saida;
}
else
{
    $_SESSION['scriptcase']['sc_saida_menu_knowledge'] = (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "javascript:window.close()";
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
if(empty($_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod']))
{
        /*check prod*/$_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
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
$path_libs      = $str_root . $_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod'] . "/lib/php";
$path_third     = $str_root . $_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod'] . "/third";
$url_third      = $_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod'] . "/third";
$path_adodb     = $str_root . $_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod'] . "/third/adodb";
$path_apls      = $str_root . substr($path_link, 0, strrpos($path_link, '/'));
$path_img_old   = $str_root . $path_link . "menu_knowledge/img";
$this->path_css = $str_root . $path_link . "_lib/css/";
$path_lib_php   = $str_root . $path_link . "_lib/lib/php";
$_SESSION['scriptcase']['dir_temp'] = $str_root . $_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_imag_temp'];
$menu_largura   = '300';
$menu_mobile_hide          = 'N';
$menu_mobile_inicial_state = 'escondido';
$menu_mobile_hide_onclick  = 'S';
$menutree_mobile_float     = 'S';
$menu_mobile_hide_icon     = 'N';
$mobile_menu_mobile_hide          = 'S';
$mobile_menu_mobile_inicial_state = 'escondido';
$mobile_menu_mobile_hide_onclick  = 'S';
$mobile_menutree_mobile_float     = 'N';
$mobile_menu_mobile_hide_icon     = 'N';
$this->sc_Include($path_libs . "/nm_ini_perfil.php", "F", "perfil_lib");
if(function_exists('set_php_timezone')) set_php_timezone('menu_knowledge');
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
                $nm_apl_dest = $path_link . SC_dir_app_name($nm_apl_dest) . "/" . $nm_apl_dest . ".php";
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
    include_once(dirname(__FILE__) . "/menu_knowledge_erro.php");
}
include_once(dirname(__FILE__) . "/menu_knowledge_erro.class.php"); 
$this->Erro = new menu_knowledge_erro();
$str_path = substr($_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod'], 0, strrpos($_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod'], '/') + 1);
if (!is_file($str_root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
{
    unset($_SESSION['scriptcase']['nm_sc_retorno']);
    unset($_SESSION['scriptcase']['menu_knowledge']['glo_nm_conexao']);
}
/* Definiciones de las rutas */
$menu_knowledge_menuData          = array();
$menu_knowledge_menuData['path']  = array();
$menu_knowledge_menuData['url']   = array();
$NM_dir_atual = getcwd();
if (empty($NM_dir_atual))
{
    $menu_knowledge_menuData['path']['sys'] = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
    $menu_knowledge_menuData['path']['sys'] = str_replace("\\", '/', $str_path_sys);
    $menu_knowledge_menuData['path']['sys'] = str_replace('//', '/', $str_path_sys);
}
else
{
    $sc_nm_arquivo                                   = explode("/", $_SERVER['PHP_SELF']);
    $menu_knowledge_menuData['path']['sys'] = str_replace("\\", "/", str_replace("\\\\", "\\", getcwd())) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
}
$menu_knowledge_menuData['url']['web']   = $_SERVER['PHP_SELF'];
$menu_knowledge_menuData['url']['web']   = str_replace("\\", '/', $menu_knowledge_menuData['url']['web']);
$menu_knowledge_menuData['path']['root'] = substr($menu_knowledge_menuData['path']['sys'],  0, -1 * strlen($menu_knowledge_menuData['url']['web']));
$menu_knowledge_menuData['path']['app']  = substr($menu_knowledge_menuData['path']['sys'],  0, strrpos($menu_knowledge_menuData['path']['sys'],  '/'));
$menu_knowledge_menuData['path']['link'] = substr($menu_knowledge_menuData['path']['app'],  0, strrpos($menu_knowledge_menuData['path']['app'],  '/'));
$menu_knowledge_menuData['path']['link'] = substr($menu_knowledge_menuData['path']['link'], 0, strrpos($menu_knowledge_menuData['path']['link'], '/')) . '/';
$menu_knowledge_menuData['path']['app'] .= '/';
$menu_knowledge_menuData['url']['app']   = substr($menu_knowledge_menuData['url']['web'],  0, strrpos($menu_knowledge_menuData['url']['web'],  '/'));
$menu_knowledge_menuData['url']['link']  = substr($menu_knowledge_menuData['url']['app'],  0, strrpos($menu_knowledge_menuData['url']['app'],  '/'));
if ($_SESSION['scriptcase']['menu_knowledge']['glo_nm_usa_grupo'] == "S")
{
    $menu_knowledge_menuData['url']['link']  = substr($menu_knowledge_menuData['url']['link'], 0, strrpos($menu_knowledge_menuData['url']['link'], '/'));
}
$menu_knowledge_menuData['url']['link']  .= '/';
$menu_knowledge_menuData['url']['app']   .= '/';

$_SESSION['scriptcase']['menu_knowledge']['sc_apl_link'] = $menu_knowledge_menuData['url']['link'];

/* Elementos de menú */
if (!isset($_SESSION['scriptcase']['str_lang']) || empty($_SESSION['scriptcase']['str_lang']))
{
    $_SESSION['scriptcase']['str_lang'] = "en_us";
}
if (!isset($_SESSION['scriptcase']['str_conf_reg']) || empty($_SESSION['scriptcase']['str_conf_reg']))
{
    $_SESSION['scriptcase']['str_conf_reg'] = "en_us";
}
$this->str_lang        = $_SESSION['scriptcase']['str_lang'];
$this->str_conf_reg    = $_SESSION['scriptcase']['str_conf_reg'];
if (isset($_SESSION['scriptcase']['menu_knowledge']['session_timeout']['lang'])) {
    $this->str_lang = $_SESSION['scriptcase']['menu_knowledge']['session_timeout']['lang'];
}
elseif (!isset($_SESSION['scriptcase']['menu_knowledge']['actual_lang']) || $_SESSION['scriptcase']['menu_knowledge']['actual_lang'] != $this->str_lang) {
    $_SESSION['scriptcase']['menu_knowledge']['actual_lang'] = $this->str_lang;
    setcookie('sc_actual_lang_sc_tickets',$this->str_lang,'0','/');
}
if (!function_exists("NM_is_utf8"))
 {
   include_once("../_lib/lib/php/nm_utf8.php");
}
if (!function_exists("SC_dir_app_ini"))
{
    include_once("../_lib/lib/php/nm_ctrl_app_name.php");
}
SC_dir_app_ini('sc_tickets');
$this->str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_SweetCoral/Sc9_SweetCoral";
if ($_SESSION['scriptcase']['menu_knowledge']['glo_nm_usa_grupo'] == "S")
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
$this->tab_grupo[0] = "sc_tickets/";
if ($_SESSION['scriptcase']['menu_knowledge']['glo_nm_usa_grupo'] != "S")
{
    $this->tab_grupo[0] = "";
}

    $_SESSION['scriptcase']['menu_atual'] = "menu_knowledge";
    $_SESSION['scriptcase']['menu_apls']['menu_knowledge'] = array();
    if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
    {
        foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
        {
            if (isset($_SESSION['scriptcase']['menu_knowledge']['glo_nm_conexao']) && $_SESSION['scriptcase']['menu_knowledge']['glo_nm_conexao'] == $NM_con_orig)
            {
/*NM*/          $_SESSION['scriptcase']['menu_knowledge']['glo_nm_conexao'] = $NM_con_dest;
            }
            if (isset($_SESSION['scriptcase']['menu_knowledge']['glo_nm_perfil']) && $_SESSION['scriptcase']['menu_knowledge']['glo_nm_perfil'] == $NM_con_orig)
            {
/*NM*/          $_SESSION['scriptcase']['menu_knowledge']['glo_nm_perfil'] = $NM_con_dest;
            }
            if (isset($_SESSION['scriptcase']['menu_knowledge']['glo_con_' . $NM_con_orig]))
            {
                $_SESSION['scriptcase']['menu_knowledge']['glo_con_' . $NM_con_orig] = $NM_con_dest;
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
if (isset($_SESSION['scriptcase']['menu_knowledge']['session_timeout']['redir'])) {
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
    if ($_SESSION['scriptcase']['menu_knowledge']['session_timeout']['redir_tp'] == "R") {
        $SS_cod_html .= "  </HEAD>\r\n";
        $SS_cod_html .= "   <body>\r\n";
    }
    else {
        $SS_cod_html .= "    <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n";
        $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_menuT.css\"/>\r\n";
        $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_menuT" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\"/>\r\n";
        $SS_cod_html .= "  </HEAD>\r\n";
        $SS_cod_html .= "   <body class=\"scMenuHPage\">\r\n";
        $SS_cod_html .= "    <table align=\"center\"><tr><td style=\"padding: 0\"><div>\r\n";
        $SS_cod_html .= "    <table class=\"scMenuHTable\" width='100%' cellspacing=0 cellpadding=0><tr class=\"scMenuHHeader\"><td class=\"scMenuHHeaderFont\" style=\"padding: 15px 30px; text-align: center\">\r\n";
        $SS_cod_html .= $this->Nm_lang['lang_errm_expired_session'] . "\r\n";
        $SS_cod_html .= "     <form name=\"Fsession_redir\" method=\"post\"\r\n";
        $SS_cod_html .= "           target=\"_self\">\r\n";
        $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['menu_knowledge']['session_timeout']['redir'] . "');\">\r\n";
        $SS_cod_html .= "     </form>\r\n";
        $SS_cod_html .= "    </td></tr></table>\r\n";
        $SS_cod_html .= "    </div></td></tr></table>\r\n";
    }
    $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
    if ($_SESSION['scriptcase']['menu_knowledge']['session_timeout']['redir_tp'] == "R") {
        $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['menu_knowledge']['session_timeout']['redir'] . "');\r\n";
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
    unset($_SESSION['scriptcase']['menu_knowledge']['session_timeout']);
    unset($_SESSION['sc_session']);
}
if (isset($SS_cod_html))
{
    echo $SS_cod_html;
    exit;
}
$this->str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_SweetCoral/Sc9_SweetCoral";
$_SESSION['scriptcase']['erro']['str_schema'] = $this->str_schema_all . "_error.css";
$_SESSION['scriptcase']['erro']['str_schema_dir'] = $this->str_schema_all . "_error" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
$_SESSION['scriptcase']['erro']['str_lang']   = $this->str_lang;
if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['menu_knowledge']['session_timeout']['redir']))
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
    $_SESSION['sc_session'][1]['menu_knowledge']['init'] = $script_case_init;
}
elseif (!isset($_SESSION['sc_session'][1]['menu_knowledge']['init']))
{
    $_SESSION['sc_session'][1]['menu_knowledge']['init'] = "";
}
$script_case_init = $_SESSION['sc_session'][1]['menu_knowledge']['init'];
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
$this->sc_Include($path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod") ; 
include_once($path_adodb . "/adodb.inc.php"); 
$this->sc_Include($path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
 if(function_exists('set_php_timezone')) set_php_timezone('menu_knowledge'); 
perfil_lib($path_libs);
if (!isset($_SESSION['sc_session'][1]['SC_Check_Perfil']))
{
    if(function_exists("nm_check_perfil_exists")) nm_check_perfil_exists($path_libs, $_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod']);
    $_SESSION['sc_session'][1]['SC_Check_Perfil'] = true;
}
$nm_falta_var    = ""; 
$nm_falta_var_db = ""; 
if (isset($_SESSION['scriptcase']['menu_knowledge']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['menu_knowledge']['glo_nm_conexao']))
{
    db_conect_devel($_SESSION['scriptcase']['menu_knowledge']['glo_nm_conexao'], $str_root . $_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod'], 'sc_tickets', 2); 
}
if (isset($_SESSION['scriptcase']['menu_knowledge']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['menu_knowledge']['glo_nm_perfil']))
{
   $_SESSION['scriptcase']['glo_perfil'] = $_SESSION['scriptcase']['menu_knowledge']['glo_nm_perfil'];
}
if (isset($_SESSION['scriptcase']['glo_perfil']) && !empty($_SESSION['scriptcase']['glo_perfil']))
{
    $_SESSION['scriptcase']['glo_senha_protect'] = "";
    carrega_perfil($_SESSION['scriptcase']['glo_perfil'], $path_libs, "S");
    if (empty($_SESSION['scriptcase']['glo_senha_protect']))
    {
        $nm_falta_var .= "Perfil=" . $_SESSION['scriptcase']['glo_perfil'] . "; ";
    }
}
if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
{
    $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
    if (strlen($SC_temp) == 2)
    {
       $_SESSION['scriptcase']['menu_knowledge']['SC_sep_date']  = substr($SC_temp, 0, 1); 
       $_SESSION['scriptcase']['menu_knowledge']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
   }
   else
    {
       $_SESSION['scriptcase']['menu_knowledge']['SC_sep_date']  = $SC_temp; 
       $_SESSION['scriptcase']['menu_knowledge']['SC_sep_date1'] = $SC_temp; 
   }
}
if (!isset($_SESSION['scriptcase']['glo_tpbanco']))
{
    $nm_falta_var_db .= "glo_tpbanco; ";
}
else
{
    $nm_tpbanco = $_SESSION['scriptcase']['glo_tpbanco']; 
}
if (!isset($_SESSION['scriptcase']['glo_servidor']))
{
    $nm_falta_var_db .= "glo_servidor; ";
}
else
{
    $nm_servidor = $_SESSION['scriptcase']['glo_servidor']; 
}
if (!isset($_SESSION['scriptcase']['glo_banco']))
{
    $nm_falta_var_db .= "glo_banco; ";
}
else
{
    $nm_banco = $_SESSION['scriptcase']['glo_banco']; 
}
if (!isset($_SESSION['scriptcase']['glo_usuario']))
{
    $nm_falta_var_db .= "glo_usuario; ";
}
else
{
    $nm_usuario = $_SESSION['scriptcase']['glo_usuario']; 
}
if (!isset($_SESSION['scriptcase']['glo_senha']))
{
    $nm_falta_var_db .= "glo_senha; ";
}
else
{
    $nm_senha = $_SESSION['scriptcase']['glo_senha']; 
}
$nm_con_db2 = array();
$nm_database_encoding = "";
if (isset($_SESSION['scriptcase']['glo_database_encoding']))
{
    $nm_database_encoding = $_SESSION['scriptcase']['glo_database_encoding']; 
}
$nm_arr_db_extra_args = array();
if (isset($_SESSION['scriptcase']['glo_use_ssl']))
{
    $nm_arr_db_extra_args['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
{
    $nm_arr_db_extra_args['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
{
    $nm_arr_db_extra_args['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
{
    $nm_arr_db_extra_args['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
{
    $nm_arr_db_extra_args['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
{
    $nm_arr_db_extra_args['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
}
if (isset($_SESSION['scriptcase']['mssql_encrypt']))
{
    $nm_arr_db_extra_args['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
}
if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
{
    $nm_arr_db_extra_args['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
}
if (isset($_SESSION['scriptcase']['mssql_truststore']))
{
    $nm_arr_db_extra_args['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
}
if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
{
    $nm_arr_db_extra_args['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
}
if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
{
    $nm_arr_db_extra_args['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_autocommit']))
{
    $nm_con_db2['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']))
{
    $nm_con_db2['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']))
{
    $nm_con_db2['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']))
{
    $nm_con_db2['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_i5_query_optimize']))
{
    $nm_con_db2['db2_i5_query_optimize'] = $_SESSION['scriptcase']['glo_db2_i5_query_optimize']; 
}
if (isset($_SESSION['scriptcase']['oracle_type']))
{
    $nm_arr_db_extra_args['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
}
$nm_con_persistente = "";
$nm_con_use_schema  = "";
if (isset($_SESSION['scriptcase']['glo_use_persistent']))
{
    $nm_con_persistente = $_SESSION['scriptcase']['glo_use_persistent']; 
}
if (isset($_SESSION['scriptcase']['glo_use_schema']))
{
    $nm_con_use_schema = $_SESSION['scriptcase']['glo_use_schema']; 
}
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
$str_message = str_replace('{var_str_message_conn}','', $str_message);
$str_message = str_replace('{v_str_btn_inside}', '', $str_message);
if (!empty($nm_falta_var) || !empty($nm_falta_var_db))
{
    if (empty($nm_falta_var_db))
    {
         $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_glob'], $str_message);
    }
    else
    {
         $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_dbcn_data'], $str_message);
    }
    echo $str_message;
    if (isset($_SESSION['scriptcase']['nm_ret_exec']) && '' != $_SESSION['scriptcase']['nm_ret_exec'])
    { 
        if (isset($_SESSION['sc_session'][1]['menu_knowledge']['sc_outra_jan']) && $_SESSION['sc_session'][1]['menu_knowledge']['sc_outra_jan'])
        {
            echo "<a href='javascript:window.close()'><img border='0' src='" . $path_imag_cab . "/scriptcase__NM__exit.gif' title='" . $this->Nm_lang['lang_btns_menu_rtrn_hint'] . "' align=absmiddle></a> \n" ; 
        } 
        else 
        { 
            echo "<a href='" . $_SESSION['scriptcase']['nm_ret_exec'] . "><img border='0' src='" . $path_imag_cab . "/scriptcase__NM__exit.gif' title='" . $this->Nm_lang['lang_btns_menu_rtrn_hint'] . "' align=absmiddle></a> \n" ; 
        } 
    } 
    echo $str_message_end;
    exit ;
} 
if (isset($_SESSION['scriptcase']['glo_db_master_usr']) && !empty($_SESSION['scriptcase']['glo_db_master_usr']))
{
    $nm_usuario = $_SESSION['scriptcase']['glo_db_master_usr']; 
}
if (isset($_SESSION['scriptcase']['glo_db_master_pass']) && !empty($_SESSION['scriptcase']['glo_db_master_pass']))
{
    $nm_senha = $_SESSION['scriptcase']['glo_db_master_pass']; 
}
if (isset($_SESSION['scriptcase']['glo_db_master_cript']) && !empty($_SESSION['scriptcase']['glo_db_master_cript']))
{
    $_SESSION['scriptcase']['glo_senha_protect'] = $_SESSION['scriptcase']['glo_db_master_cript']; 
}
$sc_tem_trans_banco = false;
$this->nm_bases_access    = array("access", "ado_access", "ace_access");
$this->nm_bases_db2       = array("db2", "db2_odbc", "odbc_db2", "odbc_db2v6", "pdo_db2_odbc", "pdo_ibm");
$this->nm_bases_ibase     = array("ibase", "firebird", "pdo_firebird", "borland_ibase");
$this->nm_bases_informix  = array("informix", "informix72", "pdo_informix");
$this->nm_bases_mssql     = array("mssql", "ado_mssql", "adooledb_mssql", "odbc_mssql", "mssqlnative", "pdo_sqlsrv", "pdo_dblib", "azure_mssql", "azure_ado_mssql", "azure_adooledb_mssql", "azure_odbc_mssql", "azure_mssqlnative", "azure_pdo_sqlsrv", "azure_pdo_dblib", "googlecloud_mssql", "googlecloud_ado_mssql", "googlecloud_adooledb_mssql", "googlecloud_odbc_mssql", "googlecloud_mssqlnative", "googlecloud_pdo_sqlsrv", "googlecloud_pdo_dblib", "amazonrds_mssql", "amazonrds_ado_mssql", "amazonrds_adooledb_mssql", "amazonrds_odbc_mssql", "amazonrds_mssqlnative", "amazonrds_pdo_sqlsrv", "amazonrds_pdo_dblib");
$this->nm_bases_mysql     = array("mysql", "mysqlt", "mysqli", "maxsql", "pdo_mysql", "azure_mysql", "azure_mysqlt", "azure_mysqli", "azure_maxsql", "azure_pdo_mysql", "googlecloud_mysql", "googlecloud_mysqlt", "googlecloud_mysqli", "googlecloud_maxsql", "googlecloud_pdo_mysql", "amazonrds_mysql", "amazonrds_mysqlt", "amazonrds_mysqli", "amazonrds_maxsql", "amazonrds_pdo_mysql");
$this->nm_bases_postgres  = array("postgres", "postgres64", "postgres7", "pdo_pgsql", "azure_postgres", "azure_postgres64", "azure_postgres7", "azure_pdo_pgsql", "googlecloud_postgres", "googlecloud_postgres64", "googlecloud_postgres7", "googlecloud_pdo_pgsql", "amazonrds_postgres", "amazonrds_postgres64", "amazonrds_postgres7", "amazonrds_pdo_pgsql");
$this->nm_bases_oracle    = array("oci8", "oci805", "oci8po", "odbc_oracle", "oracle", "pdo_oracle", "oraclecloud_oci8", "oraclecloud_oci805", "oraclecloud_oci8po", "oraclecloud_odbc_oracle", "oraclecloud_oracle", "oraclecloud_pdo_oracle", "amazonrds_oci8", "amazonrds_oci805", "amazonrds_oci8po", "amazonrds_odbc_oracle", "amazonrds_oracle", "amazonrds_pdo_oracle");
$this->nm_bases_sqlite    = array("sqlite", "sqlite3", "pdosqlite");
$this->nm_bases_sybase    = array("sybase", "pdo_sybase_odbc", "pdo_sybase_dblib");
$this->nm_bases_vfp       = array("vfp");
$this->nm_bases_odbc      = array("odbc");
$this->nm_bases_progress  = array("pdo_progress_odbc", "progress");
$_SESSION['scriptcase']['sc_num_page'] = 1;
$_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1D9NwDQFGHAvOVWXGDMvOVcrsDWJeHIJsHQXGZ1B/HAvmZMFaHgNOZSJ3V5FaVoFaD9NwZSFUHIrwHQFaHgrwVIBsDWXCDoJsDcBwH9B/Z1rYHQJwHgveHArCV5B7ZuJsHQNmDQFaHIrKHuJeHgvOV9FeDuB7DoXGHQBsZSBqHArYHuXGHgNODkB/HEB7VoFGHQXsDuFaHANOHQXGHgrwZSJqDWrmDoXGDcNmZ1BiDSrYHQF7HgBOHArCV5B7DoF7D9XsDQJsDSBYV5FGHgNKDkBsDurGVEBiHQXOZ1FGD1rwHQraHgvsHENiDWFGVoFGHQXsDQBqHIrKHuFUDMrYVIBsH5B3DoXGHQBiZkFGZ1rYHuFaDMveDkXKH5BmVoFGHQJKH9BiHABYHurqHgrwVcB/H5XKVoBqD9BsZ1F7DSrYD5rqDMrYZSJ3HEB7ZuJsHQJeDQFaD1vOV5BODMrYVcBUH5B7DoXGDcFYZ1BiHANOHuBqHgvsHErCV5B3VoFGDcXGZ9F7HIvsVWXGDMrYVcFeV5BmDoXGDcFYZ1BiHIveHuJsHgveDkB/H5X/DoF7D9XsDQJsDSBYV5FGHgNKDkFCH5FqVoBqDcNwH9FaHArKD5NUDEvsHEFiDuJeDoFUHQJKZ9F7DSvCV5JwDMBOVcrsDWJeVoraDcJUH9FaHAN7D5NUDEBOHAFKDWF/HINUD9JKDQX7HIBeD5JwHuzGZSJ3V5X7HIX7DcJUZ1FaD1rKHuBODMBYHEXeHEFaVoB/HQXGZSFGHAvCVWBqDMrwVcFCDWXCDoX7D9XOZ1BiHINKD5BOHgvCZSJGDuFaZuBqD9NmZSFGHANOV5JwHuNODkFCH5B3VoraD9XOH9B/D1rwD5XGDEBeHEJGDWF/ZuFaDcJeZSX7HArYV5BqHgrKV9FiV5FGVoBqD9BsZ1F7DSrYD5rqDMrYZSJGH5FYDoF7DcXOZSX7HIrKV5JwHuzGDkFCH5XCVoJwHQBsZ1FGHArYHuX7HgrKZSJqH5F/HMXGHQFYDQBOZ1BYHuF7DMvOVcXKDWXKVoFGHQBsH9BqHIBeHuX7HgBeHEFiV5B3DoF7D9XsDuFaHAveD5JeHuBYVcB/HEF/HIX7D9BiZ1BiHAvmZMBqDMBYVkXeHEB7ZuB/HQJeDQFaHIrwV5XGHgrwDkBsDuX7VoFGHQJmZ1F7Z1vmD5rqDEBOHArCDWBmDoB/D9XsDQX7HABYD5NUHuBYVcB/V5X7DoFUD9BsZSB/Z1BeZMBODEBOHEFiDWFqVoFaDcBwZSX7D1vOD5NUHuzGVcFKDur/VorqHQJmZ1F7Z1vmD5rqDEBOHArCDWBmZuB/HQXODQBqHANKV5JeDMrYZSJ3V5X/VoX7HQBqZkBiHAN7HQraHgBeHAFKV5B7ZuFaHQXODQBqHANKVWBODMvOV9FiV5X/VoX7HQNmVINUD1rKHQBiHgveHEFKV5FqHIJwHQXsDuBqHAvOVWJsDMrYVcFeDWXCDoJsDcBwH9B/Z1rYHQJwHgvCHArCDuFYHMB/D9FYDuFaHABYHQFaDMNOVIBsV5FGVENUHQXGH9BODSvmZMB/HgBeHEFiV5B3DoF7D9XsDuFaHAveD5JsHgrKVcBOV5FYVoraHQJmZ1F7Z1vmD5rqDEBOHArCDWBmDoJeHQBiDQBqHAvmVWJsDMvOVcBUDWXKVoF7HQBqZkFGHArKV5FUDMrYZSXeV5FqHIJsHQNmH9BiZ1zGV5JeHuBYV9BUDur/HMX7HQNwZSBOHABYD5XGDMzGHENiDuFaZuB/HQFYDQX7HAvOVWBODMvmVcFKV5BmVoBqD9BsZkFGHArKV5B/DMzGHEXeV5FqDoB/HQJKDQJsZ1vCV5FGHuNOV9FeDWB3VEFGHQFYVINUHAvsZMNU";
 $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['menu_knowledge']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['menu_knowledge']['glo_nm_conexao']))
{ 
   $this->Db = db_conect_devel($_SESSION['scriptcase']['menu_knowledge']['glo_nm_conexao'], $str_root . $_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod'], 'sc_tickets'); 
} 
else 
{ 
   $this->Db = db_conect($nm_tpbanco, $nm_servidor, $nm_usuario, $nm_senha, $nm_banco, $glo_senha_protect, "S", $nm_con_persistente, $nm_con_db2, $nm_database_encoding, $nm_arr_db_extra_args); 
} 
$this->nm_tpbanco = $nm_tpbanco; 
if (in_array(strtolower($nm_tpbanco), $this->nm_bases_ibase) && function_exists('ibase_timefmt'))
{
    ibase_timefmt('%Y-%m-%d %H:%M:%S');
} 
if (in_array(strtolower($nm_tpbanco), $this->nm_bases_sybase))
{
   $this->Db->fetchMode = ADODB_FETCH_BOTH;
   $this->Db->Execute("set dateformat ymd");
} 
if (in_array(strtolower($nm_tpbanco), $this->nm_bases_db2))
{
   $this->Db->fetchMode = ADODB_FETCH_NUM;
} 
if (in_array(strtolower($nm_tpbanco), $this->nm_bases_mssql))
{
   $this->Db->Execute("set dateformat ymd");
} 
if (in_array(strtolower($nm_tpbanco), $this->nm_bases_oracle))
{
   $this->Db->Execute("alter session set nls_date_format         = 'yyyy-mm-dd hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_timestamp_format    = 'yyyy-mm-dd hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_timestamp_tz_format = 'yyyy-mm-dd hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_time_format         = 'hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_time_tz_format      = 'hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_numeric_characters  = '.,'");
   $_SESSION['sc_session'][$this->Ini->sc_page]['menu_knowledge']['decimal_db'] = ".";
} 
//
if ((isset($nmgp_outra_jan) && $nmgp_outra_jan == "true") || (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'menu_knowledge'))
{
    $_SESSION['sc_session'][1]['menu_knowledge']['sc_outra_jan'] = true;
     unset($_SESSION['scriptcase']['sc_outra_jan']);
    $_SESSION['scriptcase']['sc_saida_menu_knowledge'] = "javascript:window.close()";
}

/* Menú de configuración de las variables */
$menu_knowledge_menuData['iframe'] = TRUE;

$menu_knowledge_menuData['height'] = '100%';
if (!isset($_SESSION['scriptcase']['sc_apl_seg']))
{
    $_SESSION['scriptcase']['sc_apl_seg'] = array();
}
if(is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/menu_knowledge_start_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] . '_lib/_app_data/menu_knowledge_start_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
      if (!isset($_SESSION['scriptcase']['sc_apl_seg']['menu_knowledge_start']))
      {
        $_SESSION['scriptcase']['sc_apl_seg']['menu_knowledge_start'] = "on";
      }
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['menu_knowledge_start'] = "on";
} 
$_SESSION['scriptcase']['menu_knowledge']['contr_erro'] = 'on';
  











;
unset($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]);
if (!isset($_SESSION['scriptcase']['sc_def_menu']))
{
    $_SESSION['scriptcase']['sc_def_menu'] = array();
}
if (!isset($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]))
{
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"] = array();
}
if (isset($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]))
{
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]                   = array();
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['pai']            = "";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['label']          = "Home";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['link']           = "menu_knowledge_start";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['parm']           = "nm_run_menu*scin1*scout";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['icon']           = "grp__NM__home.png";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['hint']           = "";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['target']         = "_self";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['name']           = "menu_knowledge_start";
    $Temp_url = "menu_knowledge_start";
    if ('http://' == substr($Temp_url, 0, 7) || 'https://' == substr($Temp_url, 0, 8) || '../' == substr($Temp_url, 0, 3) || '/' == substr($Temp_url, 0, 1))
    {
        $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['lnk_url'] = true;
    }
    else
    {
        $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['lnk_url'] = false;
        if (!empty($Temp_url))
        {
            $Temp_url = SC_dir_app_name($Temp_url) . "/" . $Temp_url . ".php";
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['target']) == '_blank')
            {
                $Temp_url .= "?nmgp_outra_jan=true&nm_apl_menu=" . "menu_knowledge";
            }
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['target']) == '_self')
            {
                $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['sc_init'] = $this->Gera_sc_init('menu_knowledge_start');
                $Temp_url .= "?nm_run_menu=1&nm_apl_menu=" . "menu_knowledge" . "&script_case_init=" . $this->Gera_sc_init('menu_knowledge_start');
            }
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['target']) == '_parent')
            {
                $Temp_url .= "?nm_run_menu=1&script_case_init=" . $_SESSION['sc_session'][1]["menu_knowledge"]['init'];
            }
        }
    }
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Home"]['url'] = $Temp_url;
}
if (isset($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]))
{
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]                   = array();
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['pai']            = "";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['label']          = "Search";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['link']           = "grid_kb_articles_search";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['parm']           = "nm_run_menu*scin1*scout";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['icon']           = "";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['hint']           = "";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['target']         = "_self";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['name']           = "grid_kb_articles_search";
    $Temp_url = "grid_kb_articles_search";
    if ('http://' == substr($Temp_url, 0, 7) || 'https://' == substr($Temp_url, 0, 8) || '../' == substr($Temp_url, 0, 3) || '/' == substr($Temp_url, 0, 1))
    {
        $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['lnk_url'] = true;
    }
    else
    {
        $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['lnk_url'] = false;
        if (!empty($Temp_url))
        {
            $Temp_url = SC_dir_app_name($Temp_url) . "/" . $Temp_url . ".php";
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['target']) == '_blank')
            {
                $Temp_url .= "?nmgp_outra_jan=true&nm_apl_menu=" . "menu_knowledge";
            }
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['target']) == '_self')
            {
                $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['sc_init'] = $this->Gera_sc_init('grid_kb_articles_search');
                $Temp_url .= "?nm_run_menu=1&nm_apl_menu=" . "menu_knowledge" . "&script_case_init=" . $this->Gera_sc_init('grid_kb_articles_search');
            }
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['target']) == '_parent')
            {
                $Temp_url .= "?nm_run_menu=1&script_case_init=" . $_SESSION['sc_session'][1]["menu_knowledge"]['init'];
            }
        }
    }
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["Search"]['url'] = $Temp_url;
}
if (isset($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]))
{
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]                   = array();
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['pai']            = "";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['label']          = "Categories";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['link']           = "";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['parm']           = "nm_run_menu*scin1*scout";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['icon']           = "";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['hint']           = "";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['target']         = "_self";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['name']           = "";
    $Temp_url = "";
    if ('http://' == substr($Temp_url, 0, 7) || 'https://' == substr($Temp_url, 0, 8) || '../' == substr($Temp_url, 0, 3) || '/' == substr($Temp_url, 0, 1))
    {
        $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['lnk_url'] = true;
    }
    else
    {
        $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['lnk_url'] = false;
        if (!empty($Temp_url))
        {
            $Temp_url = SC_dir_app_name($Temp_url) . "/" . $Temp_url . ".php";
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['target']) == '_blank')
            {
                $Temp_url .= "?nmgp_outra_jan=true&nm_apl_menu=" . "menu_knowledge";
            }
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['target']) == '_self')
            {
                $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['sc_init'] = $this->Gera_sc_init('');
                $Temp_url .= "?nm_run_menu=1&nm_apl_menu=" . "menu_knowledge" . "&script_case_init=" . $this->Gera_sc_init('');
            }
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['target']) == '_parent')
            {
                $Temp_url .= "?nm_run_menu=1&script_case_init=" . $_SESSION['sc_session'][1]["menu_knowledge"]['init'];
            }
        }
    }
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]["root"]['url'] = $Temp_url;
}
$aLabels = $this->getCategoryLabels();
$aOrder  = $this->getCategoriesTree();
if (false === $aLabels || false === $aOrder) { 
 if (!isset($Campos_Mens_erro)){$Campos_Mens_erro = "";}
 if (!empty($Campos_Mens_erro)){$Campos_Mens_erro .= "<br>";}$Campos_Mens_erro .= $this->Nm_lang['lang_errm_dber'] . "<br />";
; }
elseif (empty($aLabels) || empty($aOrder))   { 
 if (!isset($Campos_Mens_erro)){$Campos_Mens_erro = "";}
 if (!empty($Campos_Mens_erro)){$Campos_Mens_erro .= "<br>";}$Campos_Mens_erro .= $this->Nm_lang['lang_errm_empt'] . "<br />";
; }
else {
    $aMenuItems = array();
    $this->createMenuStructure($aOrder, $aMenuItems, 'root', $aLabels);
    foreach ($aMenuItems as $aData) {
    
	    if(!isset($_SESSION['Staff'])){
	        if (isset($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]))
{
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]                   = array();
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['pai']            = $aData['parent'];
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['label']          = $aData['label'];
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['link']           = "grid_kb_articles";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['parm']           = "var_cat_id*scin" . $aData['id'] . "*scout" . "nm_run_menu*scin1*scout";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['icon']           = "";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['hint']           = $aData['label'];
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['target']         = "_self";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['name']           = "grid_kb_articles";
    $Temp_url = "grid_kb_articles";
    if ('http://' == substr($Temp_url, 0, 7) || 'https://' == substr($Temp_url, 0, 8) || '../' == substr($Temp_url, 0, 3) || '/' == substr($Temp_url, 0, 1))
    {
        $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['lnk_url'] = true;
    }
    else
    {
        $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['lnk_url'] = false;
        if (!empty($Temp_url))
        {
            $Temp_url = SC_dir_app_name($Temp_url) . "/" . $Temp_url . ".php";
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['target']) == '_blank')
            {
                $Temp_url .= "?nmgp_outra_jan=true&nm_apl_menu=" . "menu_knowledge";
            }
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['target']) == '_self')
            {
                $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['sc_init'] = $this->Gera_sc_init('grid_kb_articles');
                $Temp_url .= "?nm_run_menu=1&nm_apl_menu=" . "menu_knowledge" . "&script_case_init=" . $this->Gera_sc_init('grid_kb_articles');
            }
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['target']) == '_parent')
            {
                $Temp_url .= "?nm_run_menu=1&script_case_init=" . $_SESSION['sc_session'][1]["menu_knowledge"]['init'];
            }
        }
    }
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['url'] = $Temp_url;
}
}
	    else{
	        if (isset($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"]))
{
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]                   = array();
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['pai']            = $aData['parent'];
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['label']          = $aData['label'];
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['link']           = "grid_kb_articles_staff";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['parm']           = "var_cat_id*scin" . $aData['id'] . "*scout" . "nm_run_menu*scin1*scout";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['icon']           = "";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['hint']           = $aData['label'];
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['target']         = "_self";
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['name']           = "grid_kb_articles_staff";
    $Temp_url = "grid_kb_articles_staff";
    if ('http://' == substr($Temp_url, 0, 7) || 'https://' == substr($Temp_url, 0, 8) || '../' == substr($Temp_url, 0, 3) || '/' == substr($Temp_url, 0, 1))
    {
        $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['lnk_url'] = true;
    }
    else
    {
        $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['lnk_url'] = false;
        if (!empty($Temp_url))
        {
            $Temp_url = SC_dir_app_name($Temp_url) . "/" . $Temp_url . ".php";
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['target']) == '_blank')
            {
                $Temp_url .= "?nmgp_outra_jan=true&nm_apl_menu=" . "menu_knowledge";
            }
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['target']) == '_self')
            {
                $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['sc_init'] = $this->Gera_sc_init('grid_kb_articles_staff');
                $Temp_url .= "?nm_run_menu=1&nm_apl_menu=" . "menu_knowledge" . "&script_case_init=" . $this->Gera_sc_init('grid_kb_articles_staff');
            }
            if (strtolower($_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['target']) == '_parent')
            {
                $Temp_url .= "?nm_run_menu=1&script_case_init=" . $_SESSION['sc_session'][1]["menu_knowledge"]['init'];
            }
        }
    }
    $_SESSION['scriptcase']['sc_def_menu']["menu_knowledge"][$aData['mid']]['url'] = $Temp_url;
}
}	    
    }
}
$_SESSION['scriptcase']['menu_knowledge']['contr_erro'] = 'off';
if ($this->Db)
{
    $this->Db->Close(); 
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
 <title>menu_knowledge</title>
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
 <link rel="stylesheet" type="text/css" href="<?php echo $url_third; ?>/jquery_plugin/vakata-jstree/themes/default/style.min.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuT.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuT<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $Str_btn_css ?>" /> 
 <link rel="stylesheet" href="<?php echo $_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod']; ?>/third/font-awesome/6/css/all.min.css" type="text/css" media="screen" />
<script  type="text/javascript" src="<?php echo $url_third; ?>/jquery/js/jquery.js"></script>
<script  type="text/javascript" src="<?php echo $url_third; ?>/jquery/js/jquery-ui.js"></script>
<script  type="text/javascript" src="<?php echo $url_third; ?>/jquery_plugin/vakata-jstree/jstree.min.js"></script>
<script  type="text/javascript" src="<?php echo $url_third; ?>/jquery_plugin/layout/jquery.layout.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod']; ?>/third/sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_prod']; ?>/third/sweetalert/polyfill.min.js"></script>
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
<script type="text/javascript" src="menu_knowledge_message.js"></script>
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
        $('#all_menu').show();
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
else
{
?>
<script>
    $( document ).ready(function() {
        $('#all_menu').show();
    });
</script>
<?php
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
                                $('#css3menut').jstree().open_all();
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

 $nm_var_lab[0] = "foo";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[0]))
{
    $nm_var_lab[0] = sc_convert_encoding($nm_var_lab[0], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[0] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[0]))
{
    $nm_var_hint[0] = sc_convert_encoding($nm_var_hint[0], $_SESSION['scriptcase']['charset'], "UTF-8");
}

$saida_apl = $_SESSION['scriptcase']['sc_saida_menu_knowledge'];
$menu_knowledge_menuData['data'] = array();
$nextLevelToBeWrite = false;
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
$menu_knowledge_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[0] . "",
    'level'    => "0",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[0] . "",
    'id'       => "item_1",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => " target=\"" . $this->menu_knowledge_target('_self') . "\"",
    'sc_id'    => "item_1",
    'disabled' => $str_disabled,
    'display'  => "",
    'display_position'    => "",
    'icon_fa'  => "",
    'icon_fa_aba'  => "",
    'icon_fa_aba_inactive'  => "",
    'icon_color'  => "",
    'icon_color_hover'  => "",
    'icon_color_disabled'  => "",
);

if (isset($_SESSION['scriptcase']['sc_def_menu']['menu_knowledge']))
{
    $arr_menu_usu = $this->nm_arr_menu_recursiv($_SESSION['scriptcase']['sc_def_menu']['menu_knowledge']);
    $this->nm_gera_menus($str_menu_usu, $arr_menu_usu, 1, 'menu_knowledge');
    $menu_knowledge_menuData['data'] = $str_menu_usu;
}
if (is_file("menu_knowledge_help.txt"))
{
    $Arq_WebHelp = file("menu_knowledge_help.txt"); 
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
                $menu_knowledge_menuData['data'][] = array(
                    'label'    => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'level'    => "0",
                    'link'     => $str_link,
                    'hint'     => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'id'       => "item_Help",
                    'icon'     => $str_icon,
                    'icon_aba' => $icon_aba,
                    'icon_aba_inactive' => $icon_aba_inactive,
                    'target'   => "" . $this->menu_knowledge_target('_blank') . "",
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

if (isset($_SESSION['scriptcase']['sc_menu_del']['menu_knowledge']) && !empty($_SESSION['scriptcase']['sc_menu_del']['menu_knowledge']))
{
    $nivel = 0;
    $exclui_menu = false;
    foreach ($menu_knowledge_menuData['data'] as $i_menu => $cada_menu)
    {
       if (in_array($cada_menu['id'], $_SESSION['scriptcase']['sc_menu_del']['menu_knowledge']))
       {
          $nivel = $cada_menu['level'];
          $exclui_menu = true;
          unset($menu_knowledge_menuData['data'][$i_menu]);
       }
       elseif ( empty($cada_menu) || ($exclui_menu && $nivel < $cada_menu['level']))
       {
          unset($menu_knowledge_menuData['data'][$i_menu]);
       }
       else
       {
          $exclui_menu = false;
       }
    }
    $Temp_menu = array();
    foreach ($menu_knowledge_menuData['data'] as $i_menu => $cada_menu)
    {
        $Temp_menu[] = $cada_menu;
    }
    $menu_knowledge_menuData['data'] = $Temp_menu;
}

if (isset($_SESSION['scriptcase']['sc_menu_disable']['menu_knowledge']) && !empty($_SESSION['scriptcase']['sc_menu_disable']['menu_knowledge']))
{
    $disable_menu = false;
    foreach ($menu_knowledge_menuData['data'] as $i_menu => $cada_menu)
    {
       if (in_array($cada_menu['id'], $_SESSION['scriptcase']['sc_menu_disable']['menu_knowledge']))
       {
          $nivel = $cada_menu['level'];
          $disable_menu = true;
          $menu_knowledge_menuData['data'][$i_menu]['disabled'] = 'Y';
       }
       elseif (!empty($cada_menu) && $disable_menu && $nivel < $cada_menu['level'])
       { 
          $menu_knowledge_menuData['data'][$i_menu]['disabled'] = 'Y';
       }
       elseif (!empty($cada_menu))
       {
          $disable_menu = false;
       }
    }
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
    if (isset($_SESSION['scriptcase']['sc_apl_seg']['menu_knowledge_start']) && $_SESSION['scriptcase']['sc_apl_seg']['menu_knowledge_start'] == "on") 
    { 
    $_SESSION['scriptcase']['menu_knowledge']['apl_inicial'] = "";
    $link_default = " onclick=\"openMenuItem('iframe_menu_knowledge');\" item-href=\"menu_knowledge_form_php.php?sc_item_menu=menu_knowledge&sc_apl_menu=menu_knowledge_start&sc_apl_link=" . urlencode($menu_knowledge_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_knowledge']['glo_nm_usa_grupo'] . "\"  item-target=\"menu_knowledge_iframe\"";
    } 
    else
    { 
        $_SESSION['scriptcase']['menu_knowledge']['apl_inicial'] = ($NM_scr_iframe != "") ? $NM_scr_iframe : "menu_knowledge_pag_ini.php";
    } 
    $_SESSION['scriptcase']['menu_knowledge']['path_link'] = $path_link;
?>
<div class="ui-layout-west">
<table id="main_menutree_table" cellspacing=0 cellpadding=0 class="scMenuTTable" style="height: 100%; width: 100%">
    <tr class="scMenuTTable">
        <td class="scMenuTTableM" valign="top">
                <table cellpadding=0 cellspacing=0>
                    <tr>
                       <td id="all_menu" style="display: none;">
                      <?php
                      echo $this->menu_knowledge_escreveMenu($menu_knowledge_menuData['data']);
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
        <iframe name="menu_knowledge_iframe" id="iframe_menu_knowledge" frameborder="0" class="scMenuIframe" style="width: 100%; height: 100%;"  src="<?php echo $_SESSION['scriptcase']['menu_knowledge']['apl_inicial']?>"<?php echo $link_default ?>></iframe>
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
Iframe_atual = "menu_knowledge_iframe";
Tab_links = new Array();
<?php
echo "Tab_links['menu_knowledge']   = \"\";\r\n";
 if(isset($menu_knowledge_menuData['data']) && !empty($menu_knowledge_menuData['data']))
 {
   foreach ($menu_knowledge_menuData['data'] as $ind => $dados_menu)
   {
     if ($dados_menu['link'] != "#")
     {
         echo "Tab_links['" . $dados_menu['id'] . "']   = \"\";\r\n";
     }
  }
}
 if(isset($menu_knowledge_menuData['data_vertical']) && !empty($menu_knowledge_menuData['data_vertical']))
 {
   foreach ($menu_knowledge_menuData['data_vertical'] as $ind => $dados_menu)
   {
     if ($dados_menu['link'] != "#")
     {
         echo "Tab_links['" . $dados_menu['id'] . "']   = \"\";\r\n";
     }
  }
  }
 if(isset($menu_knowledge_menuData['data_user']) && !empty($menu_knowledge_menuData['data_user']))
 {
   foreach ($menu_knowledge_menuData['data_user'] as $ind => $dados_menu)
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
  if (str_id != "iframe_menu_knowledge")
  {
      str_id        = str_id.replace("menu_knowledge_","");
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
    str_id = str_id.replace('iframe_menu_knowledge', 'menu_knowledge');
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
    if(str_target != '_blank' && $('#iframe_menu_knowledge').length)
        $('#iframe_menu_knowledge')[0].contentWindow.focus();
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
    echo "   document.getElementById('iframe_menu_knowledge').click();\r\n";
}
?>
</script>
</body>
</html>
<?php
}
/* Control de Target */
function menu_knowledge_escreveMenu($arr_menu)
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
   function menu_knowledge_target($str_target)
   {
       global $menu_knowledge_menuData;
       if ('_blank' == $str_target)
       {
           return '_blank';
       }
       elseif ('_parent' == $str_target)
       {
           return '_parent';
       }
       elseif ($menu_knowledge_menuData['iframe'])
       {
           return 'menu_knowledge_iframe';
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
       global $menu_knowledge_menuData; 
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
                    $str_line['link'] = "javascript:parent.nm_out_menu('menu_knowledge_form_php.php?sc_item_menu=" . $arr_item['id'] . "&sc_apl_menu=" . $nome_apl . "&sc_apl_link=" . urlencode($menu_knowledge_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_knowledge']['glo_nm_usa_grupo'] . "')";  
               }
               else
               {
                    $str_line['link'] = "menu_knowledge_form_php.php?sc_item_menu=" . $arr_item['id'] . "&sc_apl_menu=" . $nome_apl . "&sc_apl_link=" . urlencode($menu_knowledge_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_knowledge']['glo_nm_usa_grupo'] . ""; 
               }
           }
           elseif ($arr_item['target'] == '_parent')
           {
               $str_line['link'] = "javascript:parent.nm_out_menu('" . $_SESSION['scriptcase']['sc_saida_menu_knowledge'] . "')"; 
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
                $str_line['target'] = ('' != $arr_item['target'] && '' != $arr_item['link']) ?  $this->menu_knowledge_target( $arr_item['target']) : "_self"; 
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
        $_SESSION['scriptcase']['menu_knowledge']['sc_init'][$apl_menu] = 1;
        return  1;
   }
function createMenuStructure($aOrder, &$aList, $sParent, $aLabels){
$_SESSION['scriptcase']['menu_knowledge']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['menu_knowledge']['contr_erro'] = 'off';
}
function getCategoriesTree(){
$_SESSION['scriptcase']['menu_knowledge']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['menu_knowledge']['contr_erro'] = 'off';
}
function getCategoryLabels(){
$_SESSION['scriptcase']['menu_knowledge']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['menu_knowledge']['contr_erro'] = 'off';
}
function insertCategory($aCat, &$aOrder, $iLevel){
$_SESSION['scriptcase']['menu_knowledge']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['menu_knowledge']['contr_erro'] = 'off';
}
function getRatingStars($total,$qty){
$_SESSION['scriptcase']['menu_knowledge']['contr_erro'] = 'on';
  

	if(empty($total) || empty($qty)) return ' ';	
	$votes = (int)$total / $qty;
	$str_img = '';
	for($i=0;$i<$votes;$i++){
		$str_img .= "<img src='../_lib/img/star_icons20.gif' />";
	}
	return $str_img;
	

$_SESSION['scriptcase']['menu_knowledge']['contr_erro'] = 'off';
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
    if (isset($_COOKIE['sc_apl_default_sc_tickets'])) {
        $apl_def = explode(",", $_COOKIE['sc_apl_default_sc_tickets']);
    }
    elseif (is_file($root . $_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_imag_temp'] . "/sc_apl_default_sc_tickets.txt")) {
        $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['menu_knowledge']['glo_nm_path_imag_temp'] . "/sc_apl_default_sc_tickets.txt"));
    }
    if (isset($apl_def)) {
        if ($apl_def[0] != "menu_knowledge") {
            $_SESSION['scriptcase']['sem_session'] = true;
            if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                $_SESSION['scriptcase']['menu_knowledge']['session_timeout']['redir'] = $apl_def[0];
            }
            else {
                $_SESSION['scriptcase']['menu_knowledge']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
            }
            $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
            $_SESSION['scriptcase']['menu_knowledge']['session_timeout']['redir_tp'] = $Redir_tp;
        }
        if (isset($_COOKIE['sc_actual_lang_sc_tickets'])) {
            $_SESSION['scriptcase']['menu_knowledge']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_sc_tickets'];
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
$contr_menu_knowledge = new menu_knowledge_class;
$contr_menu_knowledge->menu_knowledge_menu();

?>
