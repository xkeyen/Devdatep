<?php
class form_tipos_agenda_form extends form_tipos_agenda_apl
{
function Form_Init()
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
?>
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    $sOBContents = ob_get_contents();
    ob_end_clean();
}

header("X-XSS-Protection: 1; mode=block");
header("X-Frame-Options: SAMEORIGIN");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " tipos_agenda"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " tipos_agenda"); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
            <meta name="viewport" content="minimal-ui, width=300, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
            <meta name="mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="apple-touch-icon"   sizes="57x57" href="">
            <link rel="apple-touch-icon"   sizes="60x60" href="">
            <link rel="apple-touch-icon"   sizes="72x72" href="">
            <link rel="apple-touch-icon"   sizes="76x76" href="">
            <link rel="apple-touch-icon" sizes="114x114" href="">
            <link rel="apple-touch-icon" sizes="120x120" href="">
            <link rel="apple-touch-icon" sizes="144x144" href="">
            <link rel="apple-touch-icon" sizes="152x152" href="">
            <link rel="apple-touch-icon" sizes="180x180" href="">
            <link rel="icon" type="image/png" sizes="192x192" href="">
            <link rel="icon" type="image/png"   sizes="32x32" href="">
            <link rel="icon" type="image/png"   sizes="96x96" href="">
            <link rel="icon" type="image/png"   sizes="16x16" href="">
            <meta name="msapplication-TileColor" content="___">
            <meta name="msapplication-TileImage" content="">
            <meta name="theme-color" content="___">
            <meta name="apple-mobile-web-app-status-bar-style" content="___">
            <link rel="shortcut icon" href=""> <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
  var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_userSweetAlertDisplayed = false;
 </SCRIPT>
 <SCRIPT type="text/javascript">
  var sc_blockCol = '<?php echo $this->Ini->Block_img_col; ?>';
  var sc_blockExp = '<?php echo $this->Ini->Block_img_exp; ?>';
  var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax; ?>';
  var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax; ?>';
  var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax; ?>';
  var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax; ?>';
  var sc_ajaxMsgTime = 2;
  var sc_img_status_ok = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_ok; ?>';
  var sc_img_status_err = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_err; ?>';
  var sc_css_status = '<?php echo $this->Ini->Css_status; ?>';
  var sc_css_status_pwd_box = '<?php echo $this->Ini->Css_status_pwd_box; ?>';
  var sc_css_status_pwd_text = '<?php echo $this->Ini->Css_status_pwd_text; ?>';
<?php
if ($this->Embutida_form && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['sc_modal'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['sc_redir_atualiz'] == 'ok')
{
?>
  var sc_closeChange = true;
<?php
}
else
{
?>
  var sc_closeChange = false;
<?php
}
?>
 </SCRIPT>
        <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
            <?php
               if ($_SESSION['scriptcase']['display_mobile'] && $_SESSION['scriptcase']['device_mobile']) {
                   $forced_mobile = (isset($_SESSION['scriptcase']['force_mobile']) && $_SESSION['scriptcase']['force_mobile']) ? 'true' : 'false';
                   $sc_app_data   = json_encode([
                       'forceMobile' => $forced_mobile,
                       'appType' => 'form',
                       'improvements' => true,
                       'displayOptionsButton' => false,
                       'displayScrollUp' => true,
                       'scrollUpPosition' => 'A',
                       'toolbarOrientation' => 'H',
                       'mobilePanes' => 'true',
                       'navigationBarButtons' => unserialize('a:3:{i:0;s:2:"NP";i:1;s:2:"FL";i:2;s:2:"RC";}'),
                       'mobileSimpleToolbar' => true,
                       'bottomToolbarFixed' => true
                   ]); ?>
            <input type="hidden" id="sc-mobile-app-data" value='<?php echo $sc_app_data; ?>' />
            <script type="text/javascript" src="../_lib/lib/js/nm_modal_panes.jquery.js"></script>
            <script type="text/javascript" src="../_lib/lib/js/nm_form_mobile.js"></script>
            <link rel='stylesheet' href='../_lib/lib/css/nm_form_mobile.css' type='text/css'/>
            <script>
                $(document).ready(function(){

                    bootstrapMobile();

                });
            </script>
            <?php } ?> <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/viewerjs/viewer.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/viewerjs/viewer.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
<?php
           $fixColNotFixedVisibility = $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'] ? 'visible' : 'hidden';
           $fixColNotFixedOpacity = $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'] ? '1' : '1';
?>
    <style type="text/css">
        .sc-col-actions {
            text-align: center !important;
        }
        .sc-op-fix-col {
            padding: 0 2px;
        }
        .sc-op-fix-col:hover {
            cursor: pointer;
        }
        .sc-op-fix-col-notfixed {
            visibility: <?php echo $fixColNotFixedVisibility ?>;
            opacity: 0.5;
        }
        .scFormLabelOddMult:hover .sc-op-fix-col-notfixed {
            visibility: visible;
            opacity: <?php echo $fixColNotFixedOpacity ?>;
        }
        #sc-fld-fix-col-0 {
            display: none;
        }
    </style>
    <style type="text/css">
        .sc-form-order-icon {
            padding: 0 2px;
        }
    </style>
<?php
           $formOrderUnusedVisivility = $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'] ? 'visible' : 'hidden';
           $formOrderUnusedOpacity = $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'] ? '0.5' : '1';
?>
    <style>
        .sc-form-order-icon-unused {
            visibility: <?php echo $formOrderUnusedVisivility ?>;
            opacity: 0.5;
        }
        .scFormLabelOddMult:hover .sc-form-order-icon-unused {
            visibility: visible;
            opacity: <?php echo $formOrderUnusedOpacity ?>;
        }
    </style>
 <style type="text/css">
   .scFormLabelOddMult a img[src$='<?php echo $this->Ini->Label_sort_desc ?>'], 
   .scFormLabelOddMult a img[src$='<?php echo $this->Ini->Label_sort_asc ?>']{opacity:1!important;} 
   .scFormLabelOddMult a img{opacity:0;transition:all .2s;} 
   .scFormLabelOddMult:HOVER a img{opacity:1;transition:all .2s;} 
 </style>
<style type="text/css">
.sc-button-image.disabled {
	opacity: 0.25
}
.sc-button-image.disabled img {
	cursor: default !important
}
</style>
 <style type="text/css">
  .fileinput-button-padding {
   padding: 3px 10px !important;
  }
  .fileinput-button {
   position: relative;
   overflow: hidden;
   float: left;
   margin-right: 4px;
  }
  .fileinput-button input {
   position: absolute;
   top: 0;
   right: 0;
   margin: 0;
   border: solid transparent;
   border-width: 0 0 100px 200px;
   opacity: 0;
   filter: alpha(opacity=0);
   -moz-transform: translate(-300px, 0) scale(4);
   direction: ltr;
   cursor: pointer;
  }
 </style>
<link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2/css/select2.min.css" type="text/css" />
<script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2/js/select2.full.min.js"></script>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod; ?>/third/font-awesome/6/css/all.min.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_tipos_agenda/form_tipos_agenda_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_tipos_agenda_sajax_js.php");
?>
<script type="text/javascript">
if (document.getElementById("id_error_display_fixed"))
{
 scCenterFixedElement("id_error_display_fixed");
}
var posDispLeft = 0;
var posDispTop = 0;
var Nm_Proc_Atualiz = false;
function findPos(obj)
{
 var posCurLeft = posCurTop = 0;
 if (obj.offsetParent)
 {
  posCurLeft = obj.offsetLeft
  posCurTop = obj.offsetTop
  while (obj = obj.offsetParent)
  {
   posCurLeft += obj.offsetLeft
   posCurTop += obj.offsetTop
  }
 }
 posDispLeft = posCurLeft - 10;
 posDispTop = posCurTop + 30;
}
var Nav_permite_ret = "<?php if ($this->Nav_permite_ret) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_permite_ava = "<?php if ($this->Nav_permite_ava) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_binicio     = "<?php echo $this->arr_buttons['binicio']['type']; ?>";
var Nav_bavanca     = "<?php echo $this->arr_buttons['bavanca']['type']; ?>";
var Nav_bretorna    = "<?php echo $this->arr_buttons['bretorna']['type']; ?>";
var Nav_bfinal      = "<?php echo $this->arr_buttons['bfinal']['type']; ?>";
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['last'] : 'off'); ?>";
function nav_atualiza(str_ret, str_ava, str_pos)
{
<?php
 if (isset($this->NM_btn_navega) && 'N' == $this->NM_btn_navega)
 {
     echo " return;";
 }
 else
 {
?>
 if ('S' == str_ret)
 {
<?php
    if (isset($this->nmgp_botoes['first']) && $this->nmgp_botoes['first'] == "on")
    {
?>
       if ("off" == Nav_binicio_macro_disabled) { $("#sc_b_ini_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
    if (isset($this->nmgp_botoes['back']) && $this->nmgp_botoes['back'] == "on")
    {
?>
       if ("off" == Nav_bretorna_macro_disabled) { $("#sc_b_ret_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
?>
 }
 else
 {
<?php
    if (isset($this->nmgp_botoes['first']) && $this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
    if (isset($this->nmgp_botoes['back']) && $this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
?>
 }
 if ('S' == str_ava)
 {
<?php
    if (isset($this->nmgp_botoes['last']) && $this->nmgp_botoes['last'] == "on")
    {
?>
       if ("off" == Nav_bfinal_macro_disabled) { $("#sc_b_fim_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
    if (isset($this->nmgp_botoes['forward']) && $this->nmgp_botoes['forward'] == "on")
    {
?>
       if ("off" == Nav_bavanca_macro_disabled) { $("#sc_b_avc_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
?>
 }
 else
 {
<?php
    if (isset($this->nmgp_botoes['last']) && $this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
    if (isset($this->nmgp_botoes['forward']) && $this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
?>
 }
<?php
  }
?>
}
function nav_liga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' == sImg.substr(sImg.length - 4))
 {
  sImg = sImg.substr(0, sImg.length - 4);
 }
 sImg += sExt;
}
function nav_desliga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' != sImg.substr(sImg.length - 4))
 {
  sImg += '_off';
 }
 sImg += sExt;
}
function summary_atualiza(reg_ini, reg_qtd, reg_tot)
{
    nm_sumario = "[<?php echo $this->Ini->Nm_lang['lang_othr_smry_info']?>]";
    nm_sumario = nm_sumario.replace("?start?", reg_ini);
    nm_sumario = nm_sumario.replace("?final?", reg_qtd);
    nm_sumario = nm_sumario.replace("?total?", reg_tot);
    if (reg_qtd < 1) {
        nm_sumario = "";
    }
    if (document.getElementById("sc_b_summary_b")) document.getElementById("sc_b_summary_b").innerHTML = nm_sumario;
}
function navpage_atualiza(str_navpage)
{
    if (document.getElementById("sc_b_navpage_b")) document.getElementById("sc_b_navpage_b").innerHTML = str_navpage;
}
<?php

include_once('form_tipos_agenda_jquery.php');

?>
var applicationKeys = "";
applicationKeys += "ctrl+shift+right";
applicationKeys += ",";
applicationKeys += "ctrl+shift+left";
applicationKeys += ",";
applicationKeys += "ctrl+right";
applicationKeys += ",";
applicationKeys += "ctrl+left";
applicationKeys += ",";
applicationKeys += "alt+q";
applicationKeys += ",";
applicationKeys += "escape";
applicationKeys += ",";
applicationKeys += "ctrl+enter";
applicationKeys += ",";
applicationKeys += "ctrl+s";
applicationKeys += ",";
applicationKeys += "ctrl+delete";
applicationKeys += ",";
applicationKeys += "f1";
applicationKeys += ",";
applicationKeys += "ctrl+shift+c";

var hotkeyList = "";

function execHotKey(e, h) {
    var hotkey_fired = false;
  switch (true) {
    case (["ctrl+shift+right"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_fim");
      break;
    case (["ctrl+shift+left"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ini");
      break;
    case (["ctrl+right"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ava");
      break;
    case (["ctrl+left"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ret");
      break;
    case (["alt+q"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_sai");
      break;
    case (["escape"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_cnl");
      break;
    case (["ctrl+enter"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_inc");
      break;
    case (["ctrl+s"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_alt");
      break;
    case (["ctrl+delete"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_exc");
      break;
    case (["f1"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_webh");
      break;
    case (["ctrl+shift+c"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_copy");
      break;
    default:
      return true;
  }
  if (hotkey_fired) {
        e.preventDefault();
        return false;
    } else {
        return true;
    }
}
</script>

<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>hotkeys.inc.js"></script>
<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>hotkeys_setup.js"></script>
<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
<script type="text/javascript">

function process_hotkeys(hotkey)
{
  if (hotkey == "sys_format_fim") {
    if (typeof scBtnFn_sys_format_fim !== "undefined" && typeof scBtnFn_sys_format_fim === "function") {
      scBtnFn_sys_format_fim();
        return true;
    }
  }
  if (hotkey == "sys_format_ini") {
    if (typeof scBtnFn_sys_format_ini !== "undefined" && typeof scBtnFn_sys_format_ini === "function") {
      scBtnFn_sys_format_ini();
        return true;
    }
  }
  if (hotkey == "sys_format_ava") {
    if (typeof scBtnFn_sys_format_ava !== "undefined" && typeof scBtnFn_sys_format_ava === "function") {
      scBtnFn_sys_format_ava();
        return true;
    }
  }
  if (hotkey == "sys_format_ret") {
    if (typeof scBtnFn_sys_format_ret !== "undefined" && typeof scBtnFn_sys_format_ret === "function") {
      scBtnFn_sys_format_ret();
        return true;
    }
  }
  if (hotkey == "sys_format_sai") {
    if (typeof scBtnFn_sys_format_sai !== "undefined" && typeof scBtnFn_sys_format_sai === "function") {
      scBtnFn_sys_format_sai();
        return true;
    }
  }
  if (hotkey == "sys_format_cnl") {
    if (typeof scBtnFn_sys_format_cnl !== "undefined" && typeof scBtnFn_sys_format_cnl === "function") {
      scBtnFn_sys_format_cnl();
        return true;
    }
  }
  if (hotkey == "sys_format_inc") {
    if (typeof scBtnFn_sys_format_inc !== "undefined" && typeof scBtnFn_sys_format_inc === "function") {
      scBtnFn_sys_format_inc();
        return true;
    }
  }
  if (hotkey == "sys_format_alt") {
    if (typeof scBtnFn_sys_format_alt !== "undefined" && typeof scBtnFn_sys_format_alt === "function") {
      scBtnFn_sys_format_alt();
        return true;
    }
  }
  if (hotkey == "sys_format_exc") {
    if (typeof scBtnFn_sys_format_exc !== "undefined" && typeof scBtnFn_sys_format_exc === "function") {
      scBtnFn_sys_format_exc();
        return true;
    }
  }
  if (hotkey == "sys_format_webh") {
    if (typeof scBtnFn_sys_format_webh !== "undefined" && typeof scBtnFn_sys_format_webh === "function") {
      scBtnFn_sys_format_webh();
        return true;
    }
  }
  if (hotkey == "sys_format_copy") {
    if (typeof scBtnFn_sys_format_copy !== "undefined" && typeof scBtnFn_sys_format_copy === "function") {
      scBtnFn_sys_format_copy();
        return true;
    }
  }
    return false;
}

 var Dyn_Ini  = true;
 $(function() {


  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

<?php
if (!$this->NM_ajax_flag && isset($this->NM_non_ajax_info['ajaxJavascript']) && !empty($this->NM_non_ajax_info['ajaxJavascript']))
{
    foreach ($this->NM_non_ajax_info['ajaxJavascript'] as $aFnData)
    {
?>
  <?php echo $aFnData[0]; ?>(<?php echo implode(', ', $aFnData[1]); ?>);

<?php
    }
}
?>
 });

   $(window).on('load', function() {
     if ($('#t').length>0) {
         scQuickSearchKeyUp('t', null);
     }
     $("#fast_search_f0_t").select2({
        containerCssClass: 'scGridQuickSearchDivResult',
        dropdownCssClass: 'scGridQuickSearchDivDropdown',
        placeholder: '<?php echo $this->Ini->Nm_lang['lang_srch_all_fields'] ?>',
    });
     $("#cond_fast_search_f0_t").select2({
        containerCssClass: 'scGridQuickSearchDivResult',
        dropdownCssClass: 'scGridQuickSearchDivDropdown',
        minimumResultsForSearch: -1
    });
   });
   function scQuickSearchSubmit_t() {
     nm_move('fast_search', 't');
   }

   function scQuickSearchKeyUp(sPos, e) {
     if (null != e) {
       var keyPressed = e.charCode || e.keyCode || e.which;
       if (13 == keyPressed) {
         if ('t' == sPos) scQuickSearchSubmit_t();
       }
       else
       {
           $('#SC_fast_search_submit_'+sPos).show();
       }
     }
   }
   function nm_gp_submit_qsearch(pos)
   {
        nm_move('fast_search', pos);
   }
   function nm_gp_open_qsearch_div(pos)
   {
        if (typeof nm_gp_open_qsearch_div_mobile == 'function') {
            return nm_gp_open_qsearch_div_mobile(pos);
        }
        if($('#SC_fast_search_dropdown_' + pos).hasClass('fa-caret-down'))
        {
            if(($('#quicksearchph_' + pos).offset().top+$('#id_qs_div_' + pos).height()+10) >= $(document).height())
            {
                $('#id_qs_div_' + pos).offset({top:($('#quicksearchph_' + pos).offset().top-($('#quicksearchph_' + pos).height()/2)-$('#id_qs_div_' + pos).height()-4)});
            }

            nm_gp_open_qsearch_div_store_temp(pos);
            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-down').addClass('fa-caret-up');
        }
        else
        {
            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-up').addClass('fa-caret-down');
        }
        $('#id_qs_div_' + pos).toggle();
   }

   var tmp_qs_arr_fields = [], tmp_qs_arr_cond = "";
   function nm_gp_open_qsearch_div_store_temp(pos)
   {
        tmp_qs_arr_fields = [], tmp_qs_str_cond = "";

        if($('#fast_search_f0_' + pos).prop('type') == 'select-multiple')
        {
            tmp_qs_arr_fields = $('#fast_search_f0_' + pos).val();
        }
        else
        {
            tmp_qs_arr_fields.push($('#fast_search_f0_' + pos).val());
        }

        tmp_qs_str_cond = $('#cond_fast_search_f0_' + pos).val();
   }

   function nm_gp_cancel_qsearch_div_store_temp(pos)
   {
        $('#fast_search_f0_' + pos).val('');
        $("#fast_search_f0_" + pos + " option").prop('selected', false);
        for(it=0; it<tmp_qs_arr_fields.length; it++)
        {
            $("#fast_search_f0_" + pos + " option[value='"+ tmp_qs_arr_fields[it] +"']").prop('selected', true);
        }
        $("#fast_search_f0_" + pos).change();
        tmp_qs_arr_fields = [];

        $('#cond_fast_search_f0_' + pos).val(tmp_qs_str_cond);
        $('#cond_fast_search_f0_' + pos).change();
        tmp_qs_str_cond = "";

        nm_gp_open_qsearch_div(pos);
   } if($(".sc-ui-block-control").length) {
  preloadBlock = new Image();
  preloadBlock.src = "<?php echo $this->Ini->path_icones; ?>/" + sc_blockExp;
 }

 var show_block = {
  
 };

 function toggleBlock(e) {
  var block = e.data.block,
      block_id = $(block).attr("id");
      block_img = $("#" + block_id + " .sc-ui-block-control");

  if (1 >= block.rows.length) {
   return;
  }

  show_block[block_id] = !show_block[block_id];

  if (show_block[block_id]) {
    $(block).css("height", "100%");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockCol));
  }
  else {
    $(block).css("height", "");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockExp));
  }

  for (var i = 1; i < block.rows.length; i++) {
   if (show_block[block_id])
    $(block.rows[i]).show();
   else
    $(block.rows[i]).hide();
  }

  if (show_block[block_id]) {
  }
 }

 function changeImgName(imgOld, imgNew) {
   var aOld = imgOld.split("/");
   aOld.pop();
   aOld.push(imgNew);
   return aOld.join("/");
 }

</script>
</HEAD>
<?php
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['recarga'];
}
if ('novo' == $opcao_botoes && $this->Embutida_form)
{
    $opcao_botoes = 'inicio';
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['link_info']['remove_border']) {
        $remove_border = 'border-width: 0; ';
    }
    $vertical_center = '';
?>
<body class="scFormPage sc-app-form" style="<?php echo $remove_margin . $str_iframe_body . $vertical_center; ?>">
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    echo $sOBContents;
}

?>
<div id="idJSSpecChar" style="display: none;"></div>
<script type="text/javascript">
function NM_tp_critica(TP)
{
    if (TP == 0 || TP == 1 || TP == 2)
    {
        nmdg_tipo_crit = TP;
    }
}
</script> 
<?php
 include_once("form_tipos_agenda_js0.php");
?>
<script type="text/javascript"> 
  sc_quant_excl = <?php if (!isset($sc_check_excl)) {$sc_check_excl = array();} echo count($sc_check_excl); ?>; 
  <?php if (!isset($sc_check_incl)) {$sc_check_incl = array();}?>; 
 function setLocale(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_idioma_novo.value = sLocale;
 }
 function setSchema(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_schema_f.value = sLocale;
 }
var scInsertFieldWithErrors = new Array();
<?php
foreach ($this->NM_ajax_info['fieldsWithErrors'] as $insertFieldName) {
?>
scInsertFieldWithErrors.push("<?php echo $insertFieldName; ?>");
<?php
}
?>
$(function() {
	scAjaxError_markFieldList(scInsertFieldWithErrors);
});
 </script>
<form  name="F1" method="post" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_tipos_agenda'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_tipos_agenda'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
?>
<div style="display: none; position: absolute; z-index: 1000" id="id_error_display_table_frame">
<table class="scFormErrorTable scFormToastTable">
<tr><?php if ($this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><td style="padding: 0px" rowspan="2"><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top"></td><?php } ?><td class="scFormErrorTitle scFormToastTitle"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormErrorTitleFont" style="padding: 0px; vertical-align: top; width: 100%"><?php if (!$this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top">&nbsp;<?php } ?><?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?></td><td style="padding: 0px; vertical-align: top"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideErrorDisplay('table')", "scAjaxHideErrorDisplay('table')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
</td></tr></table></td></tr>
<tr><td class="scFormErrorMessage scFormToastMessage"><span id="id_error_display_table_text"></span></td></tr>
</table>
</div>
<div style="display: none; position: absolute; z-index: 1000" id="id_message_display_frame">
 <table class="scFormMessageTable" id="id_message_display_content" style="width: 100%">
  <tr id="id_message_display_title_line">
   <td class="scFormMessageTitle" style="height: 20px"><?php
if ('' != $this->Ini->Msg_ico_title) {
?>
<img src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_title; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmessageclose", "_scAjaxMessageBtnClose()", "_scAjaxMessageBtnClose()", "id_message_display_close_icon", "", "", "float: right", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<span id="id_message_display_title" style="vertical-align: middle"></span></td>
  </tr>
  <tr>
   <td class="scFormMessageMessage"><?php
if ('' != $this->Ini->Msg_ico_body) {
?>
<img id="id_message_display_body_icon" src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_body; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<span id="id_message_display_text"></span><div id="id_message_display_buttond" style="display: none; text-align: center"><br /><input id="id_message_display_buttone" type="button" class="scButton_default" value="Ok" onClick="_scAjaxMessageBtnClick()" ></div></td>
  </tr>
 </table>
</div>
<?php
$msgDefClose = isset($this->arr_buttons['bmessageclose']) ? $this->arr_buttons['bmessageclose']['value'] : 'Ok';
?>
<script type="text/javascript">
var scMsgDefTitle = "<?php if (isset($this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'])) {echo $this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'];} ?>";
var scMsgDefButton = "Ok";
var scMsgDefClose = "<?php echo $msgDefClose; ?>";
var scMsgDefClick = "close";
var scMsgDefScInit = "<?php echo $this->Ini->sc_page; ?>";
</script>
<?php
if ($this->record_insert_ok)
{
?>
<script type="text/javascript">
if (typeof sc_userSweetAlertDisplayed === "undefined" || !sc_userSweetAlertDisplayed) {
    _scAjaxShowMessage({message: "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_othr_ajax_frmi']) ?>", title: "", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, type: "success"});
}
sc_userSweetAlertDisplayed = false;
</script>
<?php
}
if ($this->record_delete_ok)
{
?>
<script type="text/javascript">
if (typeof sc_userSweetAlertDisplayed === "undefined" || !sc_userSweetAlertDisplayed) {
    _scAjaxShowMessage({message: "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_othr_ajax_frmd']) ?>", title: "", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, type: "success"});
}
sc_userSweetAlertDisplayed = false;
</script>
<?php
}
?>
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="60%">
 <tr>
  <td>
  <div class="scFormBorder" style="<?php echo (isset($remove_border) ? $remove_border : ''); ?>">
   <table width='100%' cellspacing=0 cellpadding=0>
<?php
$this->displayAppHeader();
?>
<tr><td>
<?php
$this->displayTopToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['fast_search'][2] : "";
          $stateSearchIconClose  = 'none';
          $stateSearchIconSearch = '';
          if(!empty($OPC_dat))
          {
              $stateSearchIconClose  = '';
              $stateSearchIconSearch = 'none';
          }
?> 
           <script type="text/javascript">var change_fast_t = "";</script>
          <span id="quicksearchph_t" class="scFormToolbarInput" style='display: inline-block; vertical-align: inherit'>
              <span>
                  <input type="text" id="SC_fast_search_t" class="scFormToolbarInputText" style="border-width: 0px;;" name="nmgp_arg_fast_search_t" value="<?php echo $this->form_encode_input($OPC_dat) ?>" size="10" onChange="change_fast_t = 'CH';" alt="{maxLength: 255}" placeholder="<?php echo $this->Ini->Nm_lang['lang_othr_qk_watermark'] ?>">&nbsp;
                  <i id='SC_fast_search_dropdown_t' style='cursor: pointer;' class='fas fa-caret-down' onclick="nm_gp_open_qsearch_div('t');"></i>
                  <img id="SC_fast_search_submit_t" class='css_toolbar_obj_qs_search_img' src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_search ?>" onclick="nm_gp_submit_qsearch('t');">
                  <img style="display: <?php echo $stateSearchIconClose ?>" class='css_toolbar_obj_qs_search_img' id="SC_fast_search_close_t" src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_clean ?>" onclick="document.getElementById('SC_fast_search_t').value = '__Clear_Fast__'; nm_move('fast_search', 't');">
              </span>
                  <div id='id_qs_div_t' class='scGridQuickSearchDivMoldura' style='display:none; position:absolute;'>
                                  <div>
                                      <span >
                                        <p class='scGridQuickSearchDivLabel'><?php echo $this->Ini->Nm_lang['lang_btns_clmn'] ?></span></p>
          <select id='fast_search_f0_t' multiple=multiple  class="scFormToolbarInput" style="vertical-align: middle;" name="nmgp_fast_search_t" onChange="change_fast_t = 'CH';">
<?php 
          $SC_Label_atu['SC_all_Cmp'] = $this->Ini->Nm_lang['lang_srch_all_fields']; 
          $SC_Label_atu['id_tipos_agenda_'] = (isset($this->nm_new_label['id_tipos_agenda_'])) ? $this->nm_new_label['id_tipos_agenda_'] : 'Id Tipos Agenda'; 
          $SC_Label_atu['descripcion_'] = (isset($this->nm_new_label['descripcion_'])) ? $this->nm_new_label['descripcion_'] : 'Descripcion'; 
          $SC_Label_atu['duracion_mostrada_'] = (isset($this->nm_new_label['duracion_mostrada_'])) ? $this->nm_new_label['duracion_mostrada_'] : 'Duracion Mostrada'; 
          $SC_Label_atu['tipo_duracion_'] = (isset($this->nm_new_label['tipo_duracion_'])) ? $this->nm_new_label['tipo_duracion_'] : 'Tipo Duracion'; 
          $SC_Label_atu['duracion_'] = (isset($this->nm_new_label['duracion_'])) ? $this->nm_new_label['duracion_'] : 'Duracion'; 
          $SC_Label_atu['valor_'] = (isset($this->nm_new_label['valor_'])) ? $this->nm_new_label['valor_'] : 'Valor'; 
          $SC_Label_atu['activado_'] = (isset($this->nm_new_label['activado_'])) ? $this->nm_new_label['activado_'] : 'Activado'; 
          foreach ($SC_Label_atu as $CMP => $LABEL)
          {
              if($CMP == 'SC_all_Cmp')
                  continue;
              $OPC_sel = ($CMP == $OPC_cmp) ? " selected" : "";
              echo "           <option value='" . $CMP . "'" . $OPC_sel . ">" . $LABEL . "</option>";
          }
?> 
          </select>
                                      </span>
                                      <span >
                                        <p class='scGridQuickSearchDivLabel'><?php echo $this->Ini->Nm_lang['lang_quck_srchcond'] ?></span></p>
          <select id='cond_fast_search_f0_t' class="scFormToolbarInput" style="vertical-align: middle;display:;" name="nmgp_cond_fast_search_t" onChange="change_fast_t = 'CH';">
<?php 
          $OPC_sel = ("qp" == $OPC_arg) ? " selected" : "";
           echo "           <option value='qp'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>";
          $OPC_sel = ("ii" == $OPC_arg) ? " selected" : "";
           echo "           <option value='ii'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_stts_with'] . "</option>";
          $OPC_sel = ("eq" == $OPC_arg) ? " selected" : "";
           echo "           <option value='eq'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
          $OPC_sel = ("np" == $OPC_arg) ? " selected" : "";
           echo "           <option value='np'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_not_like'] . "</option>";
?> 
          </select>
                                      </span>
                                  </div>
                                  <div class='scGridQuickSearchDivToolbar'>
       <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "nm_gp_cancel_qsearch_div_store_temp('t')", "nm_gp_cancel_qsearch_div_store_temp('t')", "qs_cancel", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "");?>
       <?php echo nmButtonOutput($this->arr_buttons, "bapply_appdiv", "nm_gp_submit_qsearch('t');", "nm_gp_submit_qsearch('t');", "qs_search", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "");?>
                                  </div>
                               </div>          </span>  </div>
  <?php
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($this->Embutida_form) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['insert'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bincluir", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_ins_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_botoes['cancel'] == "on") && ($this->nm_flag_saida_novo != "S" || $this->nmgp_botoes['exit'] != "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['bcancelar'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnFn_sys_format_cnl()", "scBtnFn_sys_format_cnl()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
        $sCondStyle = ($this->nmgp_botoes['reload'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['breload']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['breload']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['breload']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['breload']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['breload'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "breload", "scBtnFn_sys_format_reload()", "scBtnFn_sys_format_reload()", "sc_b_reload_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-11';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');</script><?php } ?>
</td></tr> 
<tr><td>
<?php
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['empty_filter'] = true;
       }
       echo "<tr><td>";
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
     <div id="SC_tab_mult_reg">
<?php
}

function Form_Table($Table_refresh = false)
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
   if ($Table_refresh) 
   { 
       ob_start();
   }
   $this->form_fixed_column_no = 0;
?>
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php
$labelRowCount = 0;
?>
   <tr class="sc-ui-header-row" id="sc-id-fixed-headers-row-<?php echo $labelRowCount++ ?>">
<?php
$orderColName = '';
$orderColOrient = '';
$orderColRule = '';
?>
    <script type="text/javascript">
    var orderColName = "", orderColRule = "";
    var alphaIconAsc = "fas fa-sort-alpha-down sc-form-order-icon sc-form-order-icon-unused";
    var alphaIconDesc = "fas fa-sort-alpha-down-alt sc-form-order-icon sc-form-order-icon-unused";
    var numericIconAsc = "fas fa-sort-numeric-down sc-form-order-icon sc-form-order-icon-unused";
    var numericIconDesc = "fas fa-sort-numeric-down-alt sc-form-order-icon sc-form-order-icon-unused";
    var orderFieldList = ["id_tipos_agenda", "descripcion", "duracion_mostrada", "tipo_duracion", "duracion", "valor", "activado"];
    function scSetOrderColumn(clickedColumn)
    {
        let fieldClass;
        scResetOrderColumn();
        if (clickedColumn != orderColName) {
            orderColName = clickedColumn;
            orderColRule = scGetDefaultFieldOrder(orderColName);
        }
        else if ("" != orderColName) {
            orderColRule = "asc" == orderColRule ? "desc" : "asc";
        }
        else {
            orderColName = "";
            orderColRule = "";
        }
        if ("" != orderColName) {
            if (scIsFieldNumeric(orderColName)) {
                if ('desc' == orderColRule) {
                    fieldClass = numericIconDesc;
                } else {
                    fieldClass = numericIconAsc;
                }
            } else {
                if ('desc' == orderColRule) {
                    fieldClass = alphaIconDesc;
                } else {
                    fieldClass = alphaIconAsc;
                }
            }
            $("#hidden_field_label_" + orderColName + "_").find(".sc-form-order-icon").attr("class", fieldClass).removeClass("sc-form-order-icon-unused");
        }
    }
    function scResetOrderColumn()
    {
        if ("" == orderColName) {
            return;
        }
        $("#hidden_field_label_" + orderColName + "_").find(".sc-form-order-icon").attr("class", scGetDefaultFieldOrderIcon(orderColName));
    }
    function scIsFieldNumeric(fieldName)
    {
        switch (fieldName) {
            case "id_tipos_agenda":
                return true;
            case "duracion_mostrada":
                return true;
            case "duracion":
                return true;
            case "valor":
                return true;
            default:
                return false;
        }
        return false;
    }
    function scGetDefaultFieldOrder(fieldName)
    {
        switch (fieldName) {
            case "id_tipos_agenda":
                return 'desc';
            case "duracion_mostrada":
                return 'desc';
            case "duracion":
                return 'desc';
            case "valor":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }
    function scGetDefaultFieldOrderIcon(fieldName)
    {
        if (scIsFieldNumeric(fieldName)) {
            if ('desc' == scGetDefaultFieldOrder(fieldName)) {
                fieldClass = numericIconDesc;
            } else {
                fieldClass = numericIconAsc;
            }
        } else {
            if ('desc' == scGetDefaultFieldOrder(fieldName)) {
                fieldClass = alphaIconDesc;
            } else {
                fieldClass = alphaIconAsc;
            }
        }
        return fieldClass;
    }
    </script>


   <?php
        $classColFld = "";
        $classColActions = "";
        if (!$this->Embutida_form) {
            $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
            $classColActions = " sc-col-actions";
        }
?>

    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>" style="display: none;" <?php echo $Col_span ?>> <?php if (!$this->Embutida_form) { ?><span class="sc-op-fix-col sc-op-fix-col-<?php echo $this->form_fixed_column_no ?> sc-op-fix-col-notfixed" data-fixcolid="<?php echo $this->form_fixed_column_no ?>" id="sc-fld-fix-col-<?php echo $this->form_fixed_column_no ?>"><i class="fas fa-thumbtack"></i></span><?php } ?> </TD>
   <?php 
        if (!$this->Embutida_form) { $this->form_fixed_column_no++; }
 ?>
   <?php
        if (!$this->Embutida_form) {
            $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
            $classColActions = " sc-col-actions";
?>

    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>" style="display: none;" > <?php if (!$this->Embutida_form) { ?><span class="sc-op-fix-col sc-op-fix-col-<?php echo $this->form_fixed_column_no ?> sc-op-fix-col-notfixed" data-fixcolid="<?php echo $this->form_fixed_column_no ?>" id="sc-fld-fix-col-<?php echo $this->form_fixed_column_no ?>"><i class="fas fa-thumbtack"></i></span><?php } ?> </TD>
   <?php
            $this->form_fixed_column_no++;
        }
?>

   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] == "on") {
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
        $classColActions = " sc-col-actions";
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>"  width="10"> <span class="sc-op-fix-col sc-op-fix-col-<?php echo $this->form_fixed_column_no ?> sc-op-fix-col-notfixed" data-fixcolid="<?php echo $this->form_fixed_column_no ?>" id="sc-fld-fix-col-<?php echo $this->form_fixed_column_no ?>"><i class="fas fa-thumbtack"></i></span> </TD>
   <?php 
        $this->form_fixed_column_no++;
}?>
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] != "on") {
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
        $classColActions = " sc-col-actions";
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>"  width="10"> <span class="sc-op-fix-col sc-op-fix-col-<?php echo $this->form_fixed_column_no ?> sc-op-fix-col-notfixed" data-fixcolid="<?php echo $this->form_fixed_column_no ?>" id="sc-fld-fix-col-<?php echo $this->form_fixed_column_no ?>"><i class="fas fa-thumbtack"></i></span> </TD>
   <?php 
        $this->form_fixed_column_no++;
}?>
   <?php if ((!isset($this->nmgp_cmp_hidden['id_tipos_agenda_']) || $this->nmgp_cmp_hidden['id_tipos_agenda_'] == 'on') && ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir"))) { 
      if (!isset($this->nm_new_label['id_tipos_agenda_'])) {
          $this->nm_new_label['id_tipos_agenda_'] = "Id Tipos Agenda"; } ?>
<?php
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;

        // label
        $label_labelContent = $this->nm_new_label['id_tipos_agenda_'];
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
?>

    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_id_tipos_agenda__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_id_tipos_agenda_" style="<?php echo $sStyleHidden_id_tipos_agenda_; ?>" > <?php echo $label_final ?> </TD>
   <?php $this->form_fixed_column_no++;}?>

   <?php
    $sStyleHidden_descripcion_ = '';
    if (isset($this->nmgp_cmp_hidden['descripcion_']) && $this->nmgp_cmp_hidden['descripcion_'] == 'off') {
        $sStyleHidden_descripcion_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['descripcion_']) || $this->nmgp_cmp_hidden['descripcion_'] == 'on') {
        if (!isset($this->nm_new_label['descripcion_'])) {
            $this->nm_new_label['descripcion_'] = "Descripcion";
        }
        $SC_Label = "" . $this->nm_new_label['descripcion_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_fieldName .= "&nbsp;<span class=\"scFormRequiredOddMult\">*</span>&nbsp;";
        $fieldSortRule = $this->scGetColumnOrderRule("descripcion", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("descripcion", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'descripcion')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_descripcion__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_descripcion_" style="<?php echo $sStyleHidden_descripcion_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_duracion_mostrada_ = '';
    if (isset($this->nmgp_cmp_hidden['duracion_mostrada_']) && $this->nmgp_cmp_hidden['duracion_mostrada_'] == 'off') {
        $sStyleHidden_duracion_mostrada_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['duracion_mostrada_']) || $this->nmgp_cmp_hidden['duracion_mostrada_'] == 'on') {
        if (!isset($this->nm_new_label['duracion_mostrada_'])) {
            $this->nm_new_label['duracion_mostrada_'] = "Duracion Mostrada";
        }
        $SC_Label = "" . $this->nm_new_label['duracion_mostrada_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("duracion_mostrada", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("duracion_mostrada", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'duracion_mostrada')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_duracion_mostrada__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_duracion_mostrada_" style="<?php echo $sStyleHidden_duracion_mostrada_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_tipo_duracion_ = '';
    if (isset($this->nmgp_cmp_hidden['tipo_duracion_']) && $this->nmgp_cmp_hidden['tipo_duracion_'] == 'off') {
        $sStyleHidden_tipo_duracion_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['tipo_duracion_']) || $this->nmgp_cmp_hidden['tipo_duracion_'] == 'on') {
        if (!isset($this->nm_new_label['tipo_duracion_'])) {
            $this->nm_new_label['tipo_duracion_'] = "Tipo Duracion";
        }
        $SC_Label = "" . $this->nm_new_label['tipo_duracion_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("tipo_duracion", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("tipo_duracion", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'tipo_duracion')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_tipo_duracion__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_tipo_duracion_" style="<?php echo $sStyleHidden_tipo_duracion_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_duracion_ = '';
    if (isset($this->nmgp_cmp_hidden['duracion_']) && $this->nmgp_cmp_hidden['duracion_'] == 'off') {
        $sStyleHidden_duracion_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['duracion_']) || $this->nmgp_cmp_hidden['duracion_'] == 'on') {
        if (!isset($this->nm_new_label['duracion_'])) {
            $this->nm_new_label['duracion_'] = "Duracion";
        }
        $SC_Label = "" . $this->nm_new_label['duracion_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("duracion", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("duracion", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'duracion')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_duracion__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_duracion_" style="<?php echo $sStyleHidden_duracion_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_valor_ = '';
    if (isset($this->nmgp_cmp_hidden['valor_']) && $this->nmgp_cmp_hidden['valor_'] == 'off') {
        $sStyleHidden_valor_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['valor_']) || $this->nmgp_cmp_hidden['valor_'] == 'on') {
        if (!isset($this->nm_new_label['valor_'])) {
            $this->nm_new_label['valor_'] = "Valor";
        }
        $SC_Label = "" . $this->nm_new_label['valor_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("valor", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("valor", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'valor')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_valor__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_valor_" style="<?php echo $sStyleHidden_valor_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_activado_ = '';
    if (isset($this->nmgp_cmp_hidden['activado_']) && $this->nmgp_cmp_hidden['activado_'] == 'off') {
        $sStyleHidden_activado_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['activado_']) || $this->nmgp_cmp_hidden['activado_'] == 'on') {
        if (!isset($this->nm_new_label['activado_'])) {
            $this->nm_new_label['activado_'] = "Activado";
        }
        $SC_Label = "" . $this->nm_new_label['activado_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("activado", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("activado", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'activado')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_activado__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_activado_" style="<?php echo $sStyleHidden_activado_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>





    <script type="text/javascript">
     var orderColOrient = "<?php echo $orderColOrient ?>";
     orderColRule = "<?php echo $orderColRule ?>";
     scSetOrderColumn("<?php echo $orderColName ?>");
    </script>
   </tr>
<?php   
} 
function Form_Corpo($Line_Add = false, $Table_refresh = false) 
{ 
   global $sc_seq_vert, $sc_check_incl, $sc_check_excl; 
   $sc_hidden_no = 1; $sc_hidden_yes = 0;
   if ($Line_Add) 
   { 
       ob_start();
       $iStart = sizeof($this->form_vert_form_tipos_agenda);
       $guarda_nmgp_opcao = $this->nmgp_opcao;
       $guarda_form_vert_form_tipos_agenda = $this->form_vert_form_tipos_agenda;
       $this->nmgp_opcao = 'novo';
   } 
   if ($this->Embutida_form && empty($this->form_vert_form_tipos_agenda))
   {
       $sc_seq_vert = 0;
   }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['id_tipos_agenda_']))
           {
               $this->nmgp_cmp_readonly['id_tipos_agenda_'] = 'on';
           }
   foreach ($this->form_vert_form_tipos_agenda as $sc_seq_vert => $sc_lixo)
   {
       $this->form_fixed_column_no = 0;
       $this->loadRecordState($sc_seq_vert);
       if (isset($this->Embutida_ronly) && $this->Embutida_ronly && !$Line_Add)
       {
           $this->nmgp_cmp_readonly['id_tipos_agenda_'] = true;
           $this->nmgp_cmp_readonly['descripcion_'] = true;
           $this->nmgp_cmp_readonly['duracion_mostrada_'] = true;
           $this->nmgp_cmp_readonly['tipo_duracion_'] = true;
           $this->nmgp_cmp_readonly['duracion_'] = true;
           $this->nmgp_cmp_readonly['valor_'] = true;
           $this->nmgp_cmp_readonly['activado_'] = true;
       }
       elseif ($Line_Add)
       {
           if (!isset($this->nmgp_cmp_readonly['id_tipos_agenda_']) || $this->nmgp_cmp_readonly['id_tipos_agenda_'] != "on") {$this->nmgp_cmp_readonly['id_tipos_agenda_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['descripcion_']) || $this->nmgp_cmp_readonly['descripcion_'] != "on") {$this->nmgp_cmp_readonly['descripcion_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['duracion_mostrada_']) || $this->nmgp_cmp_readonly['duracion_mostrada_'] != "on") {$this->nmgp_cmp_readonly['duracion_mostrada_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tipo_duracion_']) || $this->nmgp_cmp_readonly['tipo_duracion_'] != "on") {$this->nmgp_cmp_readonly['tipo_duracion_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['duracion_']) || $this->nmgp_cmp_readonly['duracion_'] != "on") {$this->nmgp_cmp_readonly['duracion_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['valor_']) || $this->nmgp_cmp_readonly['valor_'] != "on") {$this->nmgp_cmp_readonly['valor_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['activado_']) || $this->nmgp_cmp_readonly['activado_'] != "on") {$this->nmgp_cmp_readonly['activado_'] = false;}
       }
            if (isset($this->form_vert_form_preenchimento[$sc_seq_vert])) {
              foreach ($this->form_vert_form_preenchimento[$sc_seq_vert] as $sCmpNome => $mCmpVal)
              {
                  eval("\$this->" . $sCmpNome . " = \$mCmpVal;");
              }
            }
        $this->id_tipos_agenda_ = $this->form_vert_form_tipos_agenda[$sc_seq_vert]['id_tipos_agenda_']; 
       $id_tipos_agenda_ = $this->id_tipos_agenda_; 
       $sStyleHidden_id_tipos_agenda_ = '';
       if (isset($sCheckRead_id_tipos_agenda_))
       {
           unset($sCheckRead_id_tipos_agenda_);
       }
       if (isset($this->nmgp_cmp_readonly['id_tipos_agenda_']))
       {
           $sCheckRead_id_tipos_agenda_ = $this->nmgp_cmp_readonly['id_tipos_agenda_'];
       }
       if (isset($this->nmgp_cmp_hidden['id_tipos_agenda_']) && $this->nmgp_cmp_hidden['id_tipos_agenda_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['id_tipos_agenda_']);
           $sStyleHidden_id_tipos_agenda_ = 'display: none;';
       }
       $bTestReadOnly_id_tipos_agenda_ = true;
       $sStyleReadLab_id_tipos_agenda_ = 'display: none;';
       $sStyleReadInp_id_tipos_agenda_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["id_tipos_agenda_"]) &&  $this->nmgp_cmp_readonly["id_tipos_agenda_"] == "on"))
       {
           $bTestReadOnly_id_tipos_agenda_ = false;
           unset($this->nmgp_cmp_readonly['id_tipos_agenda_']);
           $sStyleReadLab_id_tipos_agenda_ = '';
           $sStyleReadInp_id_tipos_agenda_ = 'display: none;';
       }
       $this->descripcion_ = $this->form_vert_form_tipos_agenda[$sc_seq_vert]['descripcion_']; 
       $descripcion_ = $this->descripcion_; 
       $sStyleHidden_descripcion_ = '';
       if (isset($sCheckRead_descripcion_))
       {
           unset($sCheckRead_descripcion_);
       }
       if (isset($this->nmgp_cmp_readonly['descripcion_']))
       {
           $sCheckRead_descripcion_ = $this->nmgp_cmp_readonly['descripcion_'];
       }
       if (isset($this->nmgp_cmp_hidden['descripcion_']) && $this->nmgp_cmp_hidden['descripcion_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['descripcion_']);
           $sStyleHidden_descripcion_ = 'display: none;';
       }
       $bTestReadOnly_descripcion_ = true;
       $sStyleReadLab_descripcion_ = 'display: none;';
       $sStyleReadInp_descripcion_ = '';
       if (isset($this->nmgp_cmp_readonly['descripcion_']) && $this->nmgp_cmp_readonly['descripcion_'] == 'on')
       {
           $bTestReadOnly_descripcion_ = false;
           unset($this->nmgp_cmp_readonly['descripcion_']);
           $sStyleReadLab_descripcion_ = '';
           $sStyleReadInp_descripcion_ = 'display: none;';
       }
       $this->duracion_mostrada_ = $this->form_vert_form_tipos_agenda[$sc_seq_vert]['duracion_mostrada_']; 
       $duracion_mostrada_ = $this->duracion_mostrada_; 
       $sStyleHidden_duracion_mostrada_ = '';
       if (isset($sCheckRead_duracion_mostrada_))
       {
           unset($sCheckRead_duracion_mostrada_);
       }
       if (isset($this->nmgp_cmp_readonly['duracion_mostrada_']))
       {
           $sCheckRead_duracion_mostrada_ = $this->nmgp_cmp_readonly['duracion_mostrada_'];
       }
       if (isset($this->nmgp_cmp_hidden['duracion_mostrada_']) && $this->nmgp_cmp_hidden['duracion_mostrada_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['duracion_mostrada_']);
           $sStyleHidden_duracion_mostrada_ = 'display: none;';
       }
       $bTestReadOnly_duracion_mostrada_ = true;
       $sStyleReadLab_duracion_mostrada_ = 'display: none;';
       $sStyleReadInp_duracion_mostrada_ = '';
       if (isset($this->nmgp_cmp_readonly['duracion_mostrada_']) && $this->nmgp_cmp_readonly['duracion_mostrada_'] == 'on')
       {
           $bTestReadOnly_duracion_mostrada_ = false;
           unset($this->nmgp_cmp_readonly['duracion_mostrada_']);
           $sStyleReadLab_duracion_mostrada_ = '';
           $sStyleReadInp_duracion_mostrada_ = 'display: none;';
       }
       $this->tipo_duracion_ = $this->form_vert_form_tipos_agenda[$sc_seq_vert]['tipo_duracion_']; 
       $tipo_duracion_ = $this->tipo_duracion_; 
       $sStyleHidden_tipo_duracion_ = '';
       if (isset($sCheckRead_tipo_duracion_))
       {
           unset($sCheckRead_tipo_duracion_);
       }
       if (isset($this->nmgp_cmp_readonly['tipo_duracion_']))
       {
           $sCheckRead_tipo_duracion_ = $this->nmgp_cmp_readonly['tipo_duracion_'];
       }
       if (isset($this->nmgp_cmp_hidden['tipo_duracion_']) && $this->nmgp_cmp_hidden['tipo_duracion_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tipo_duracion_']);
           $sStyleHidden_tipo_duracion_ = 'display: none;';
       }
       $bTestReadOnly_tipo_duracion_ = true;
       $sStyleReadLab_tipo_duracion_ = 'display: none;';
       $sStyleReadInp_tipo_duracion_ = '';
       if (isset($this->nmgp_cmp_readonly['tipo_duracion_']) && $this->nmgp_cmp_readonly['tipo_duracion_'] == 'on')
       {
           $bTestReadOnly_tipo_duracion_ = false;
           unset($this->nmgp_cmp_readonly['tipo_duracion_']);
           $sStyleReadLab_tipo_duracion_ = '';
           $sStyleReadInp_tipo_duracion_ = 'display: none;';
       }
       $this->duracion_ = $this->form_vert_form_tipos_agenda[$sc_seq_vert]['duracion_']; 
       $duracion_ = $this->duracion_; 
       $sStyleHidden_duracion_ = '';
       if (isset($sCheckRead_duracion_))
       {
           unset($sCheckRead_duracion_);
       }
       if (isset($this->nmgp_cmp_readonly['duracion_']))
       {
           $sCheckRead_duracion_ = $this->nmgp_cmp_readonly['duracion_'];
       }
       if (isset($this->nmgp_cmp_hidden['duracion_']) && $this->nmgp_cmp_hidden['duracion_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['duracion_']);
           $sStyleHidden_duracion_ = 'display: none;';
       }
       $bTestReadOnly_duracion_ = true;
       $sStyleReadLab_duracion_ = 'display: none;';
       $sStyleReadInp_duracion_ = '';
       if (isset($this->nmgp_cmp_readonly['duracion_']) && $this->nmgp_cmp_readonly['duracion_'] == 'on')
       {
           $bTestReadOnly_duracion_ = false;
           unset($this->nmgp_cmp_readonly['duracion_']);
           $sStyleReadLab_duracion_ = '';
           $sStyleReadInp_duracion_ = 'display: none;';
       }
       $this->valor_ = $this->form_vert_form_tipos_agenda[$sc_seq_vert]['valor_']; 
       $valor_ = $this->valor_; 
       $sStyleHidden_valor_ = '';
       if (isset($sCheckRead_valor_))
       {
           unset($sCheckRead_valor_);
       }
       if (isset($this->nmgp_cmp_readonly['valor_']))
       {
           $sCheckRead_valor_ = $this->nmgp_cmp_readonly['valor_'];
       }
       if (isset($this->nmgp_cmp_hidden['valor_']) && $this->nmgp_cmp_hidden['valor_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['valor_']);
           $sStyleHidden_valor_ = 'display: none;';
       }
       $bTestReadOnly_valor_ = true;
       $sStyleReadLab_valor_ = 'display: none;';
       $sStyleReadInp_valor_ = '';
       if (isset($this->nmgp_cmp_readonly['valor_']) && $this->nmgp_cmp_readonly['valor_'] == 'on')
       {
           $bTestReadOnly_valor_ = false;
           unset($this->nmgp_cmp_readonly['valor_']);
           $sStyleReadLab_valor_ = '';
           $sStyleReadInp_valor_ = 'display: none;';
       }
       $this->activado_ = $this->form_vert_form_tipos_agenda[$sc_seq_vert]['activado_']; 
       $activado_ = $this->activado_; 
       $sStyleHidden_activado_ = '';
       if (isset($sCheckRead_activado_))
       {
           unset($sCheckRead_activado_);
       }
       if (isset($this->nmgp_cmp_readonly['activado_']))
       {
           $sCheckRead_activado_ = $this->nmgp_cmp_readonly['activado_'];
       }
       if (isset($this->nmgp_cmp_hidden['activado_']) && $this->nmgp_cmp_hidden['activado_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['activado_']);
           $sStyleHidden_activado_ = 'display: none;';
       }
       $bTestReadOnly_activado_ = true;
       $sStyleReadLab_activado_ = 'display: none;';
       $sStyleReadInp_activado_ = '';
       if (isset($this->nmgp_cmp_readonly['activado_']) && $this->nmgp_cmp_readonly['activado_'] == 'on')
       {
           $bTestReadOnly_activado_ = false;
           unset($this->nmgp_cmp_readonly['activado_']);
           $sStyleReadLab_activado_ = '';
           $sStyleReadInp_activado_ = 'display: none;';
       }

       $nm_cor_fun_vert = (isset($nm_cor_fun_vert) && $nm_cor_fun_vert == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
       $nm_img_fun_cel  = (isset($nm_img_fun_cel)  && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);

       $sHideNewLine = '';
?>   
   <tr id="idVertRow<?php echo $sc_seq_vert; ?>"<?php echo $sHideNewLine; ?> class="sc-row" data-sc-row-number="<?php echo $sc_seq_vert; ?>">


   <?php
        if (!$this->Embutida_form) {
            $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD  class="<?php echo $this->css_inherit_bg . ' ' ?>scFormDataOddMult <?php echo $classColFld ?>"  id="hidden_field_data_sc_seq<?php echo $sc_seq_vert; ?>"  style="display: none;"> <?php echo $sc_seq_vert; ?> </TD>
   <?php
            $this->form_fixed_column_no++;
        }
?>

   <?php if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && $this->nmgp_botoes['delete'] == "on") {
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD  class="<?php echo $this->css_inherit_bg . ' ' ?>scFormDataOddMult <?php echo $classColFld ?>" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\""; if (in_array($sc_seq_vert, $sc_check_excl)) { echo " checked";} ?> onclick="if (this.checked) {sc_quant_excl++; } else {sc_quant_excl--; }" class="sc-js-input" alt="{type: 'checkbox', enterTab: false}"> </TD>
   <?php 
       $this->form_fixed_column_no++;
}?>
   <?php if (!$this->Embutida_form && $this->nmgp_opcao == "novo") {
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD  class="<?php echo $this->css_inherit_bg . ' ' ?>scFormDataOddMult <?php echo $classColFld ?>" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\"" ; if (in_array($sc_seq_vert, $sc_check_incl) || !empty($this->nm_todas_criticas)) { echo " checked ";} ?> class="sc-js-input" alt="{type: 'checkbox', enterTab: false}"> </TD>
   <?php 
       $this->form_fixed_column_no++;
}?>
   <?php if ($this->Embutida_form) {
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD  class="<?php echo $this->css_inherit_bg . ' ' ?>scFormDataOddMult <?php echo $classColFld ?>"  id="hidden_field_data_sc_actions<?php echo $sc_seq_vert; ?>" NOWRAP> <?php if ($this->nmgp_opcao != "novo") {
    if ($this->nmgp_botoes['delete'] == "off") {
        $sDisplayDelete = 'display: none';
    }
    else {
        $sDisplayDelete = '';
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "" . $sDisplayDelete. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php
if ($this->nmgp_opcao != "novo") {
    if ($this->nmgp_botoes['update'] == "off") {
        $sDisplayUpdate = 'display: none';
    }
    else {
        $sDisplayUpdate = '';
    }
    if ($this->Embutida_ronly) {
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "" . $sDisplayUpdate. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php
        $sButDisp = 'display: none';
    }
    else
    {
        $sButDisp = $sDisplayUpdate;
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "" . $sButDisp. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php
}
?>

<?php if ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_opcao == "novo") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_incluir", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "sc_ins_line_" . $sc_seq_vert . "", "", "", "display: ''", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php if ($this->nmgp_botoes['delete'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php if ($Line_Add && $this->Embutida_ronly) {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php if ($this->nmgp_botoes['update'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>
<?php }?>
<?php if ($this->nmgp_botoes['insert'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_novo", "do_ajax_form_tipos_agenda_add_new_line(" . $sc_seq_vert . ")", "do_ajax_form_tipos_agenda_add_new_line(" . $sc_seq_vert . ")", "sc_new_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>
<?php
  $Style_add_line = (!$Line_Add) ? "display: none" : "";
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_tipos_agenda_cancel_insert(" . $sc_seq_vert . ")", "do_ajax_form_tipos_agenda_cancel_insert(" . $sc_seq_vert . ")", "sc_canceli_line_" . $sc_seq_vert . "", "", "", "" . $Style_add_line . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_tipos_agenda_cancel_update(" . $sc_seq_vert . ")", "do_ajax_form_tipos_agenda_cancel_update(" . $sc_seq_vert . ")", "sc_cancelu_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 </TD>
   <?php 
       $this->form_fixed_column_no++;
}?>
   <?php if (isset($this->nmgp_cmp_hidden['id_tipos_agenda_']) && $this->nmgp_cmp_hidden['id_tipos_agenda_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_tipos_agenda_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($id_tipos_agenda_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormDataOddMult css_id_tipos_agenda__line <?php echo $classColFld ?>" id="hidden_field_data_id_tipos_agenda_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_id_tipos_agenda_; ?>"> <span id="id_read_on_id_tipos_agenda_<?php echo $sc_seq_vert ?>" class="css_id_tipos_agenda__line" style="<?php echo $sStyleReadLab_id_tipos_agenda_; ?>"><?php echo $this->form_format_readonly("id_tipos_agenda_", $this->form_encode_input($this->id_tipos_agenda_)); ?></span><span id="id_read_off_id_tipos_agenda_<?php echo $sc_seq_vert ?>" class="css_read_off_id_tipos_agenda_" style="<?php echo $sStyleReadInp_id_tipos_agenda_; ?>"><input type="hidden" id="id_sc_field_id_tipos_agenda_<?php echo $sc_seq_vert ?>" name="id_tipos_agenda_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($id_tipos_agenda_) . "\">"?>
<span id="id_ajax_label_id_tipos_agenda_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($id_tipos_agenda_); ?></span>
</span></span> </TD>
   <?php }?>
<?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['descripcion_']) && $this->nmgp_cmp_hidden['descripcion_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="descripcion_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($descripcion_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_descripcion__line <?php echo $classColFld ?>" id="hidden_field_data_descripcion_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_descripcion_; ?>"> 
<?php if ($bTestReadOnly_descripcion_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["descripcion_"]) &&  $this->nmgp_cmp_readonly["descripcion_"] == "on") { 

 ?>
<input type="hidden" name="descripcion_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($descripcion_) . "\">" . $descripcion_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_descripcion_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-descripcion_<?php echo $sc_seq_vert ?> css_descripcion__line" style="<?php echo $sStyleReadLab_descripcion_; ?>"><?php echo $this->form_format_readonly("descripcion_", $this->form_encode_input($this->descripcion_)); ?></span><span id="id_read_off_descripcion_<?php echo $sc_seq_vert ?>" class="css_read_off_descripcion_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_descripcion_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_descripcion__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_descripcion_<?php echo $sc_seq_vert ?>" type=text name="descripcion_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($descripcion_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=45"; } ?> maxlength=45 alt="{datatype: 'text', maxLength: 45, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['duracion_mostrada_']) && $this->nmgp_cmp_hidden['duracion_mostrada_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="duracion_mostrada_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($duracion_mostrada_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_duracion_mostrada__line <?php echo $classColFld ?>" id="hidden_field_data_duracion_mostrada_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_duracion_mostrada_; ?>"> 
<?php if ($bTestReadOnly_duracion_mostrada_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["duracion_mostrada_"]) &&  $this->nmgp_cmp_readonly["duracion_mostrada_"] == "on") { 

 ?>
<input type="hidden" name="duracion_mostrada_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($duracion_mostrada_) . "\">" . $duracion_mostrada_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_duracion_mostrada_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-duracion_mostrada_<?php echo $sc_seq_vert ?> css_duracion_mostrada__line" style="<?php echo $sStyleReadLab_duracion_mostrada_; ?>"><?php echo $this->form_format_readonly("duracion_mostrada_", $this->form_encode_input($this->duracion_mostrada_)); ?></span><span id="id_read_off_duracion_mostrada_<?php echo $sc_seq_vert ?>" class="css_read_off_duracion_mostrada_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_duracion_mostrada_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_duracion_mostrada__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_duracion_mostrada_<?php echo $sc_seq_vert ?>" type=text name="duracion_mostrada_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($duracion_mostrada_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['duracion_mostrada_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['duracion_mostrada_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['duracion_mostrada_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tipo_duracion_']) && $this->nmgp_cmp_hidden['tipo_duracion_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tipo_duracion_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tipo_duracion_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_tipo_duracion__line <?php echo $classColFld ?>" id="hidden_field_data_tipo_duracion_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tipo_duracion_; ?>"> 
<?php if ($bTestReadOnly_tipo_duracion_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tipo_duracion_"]) &&  $this->nmgp_cmp_readonly["tipo_duracion_"] == "on") { 

 ?>
<input type="hidden" name="tipo_duracion_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tipo_duracion_) . "\">" . $tipo_duracion_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_tipo_duracion_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tipo_duracion_<?php echo $sc_seq_vert ?> css_tipo_duracion__line" style="<?php echo $sStyleReadLab_tipo_duracion_; ?>"><?php echo $this->form_format_readonly("tipo_duracion_", $this->form_encode_input($this->tipo_duracion_)); ?></span><span id="id_read_off_tipo_duracion_<?php echo $sc_seq_vert ?>" class="css_read_off_tipo_duracion_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tipo_duracion_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tipo_duracion__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tipo_duracion_<?php echo $sc_seq_vert ?>" type=text name="tipo_duracion_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tipo_duracion_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=1"; } ?> maxlength=1 alt="{datatype: 'text', maxLength: 1, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['duracion_']) && $this->nmgp_cmp_hidden['duracion_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="duracion_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($duracion_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_duracion__line <?php echo $classColFld ?>" id="hidden_field_data_duracion_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_duracion_; ?>"> 
<?php if ($bTestReadOnly_duracion_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["duracion_"]) &&  $this->nmgp_cmp_readonly["duracion_"] == "on") { 

 ?>
<input type="hidden" name="duracion_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($duracion_) . "\">" . $duracion_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_duracion_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-duracion_<?php echo $sc_seq_vert ?> css_duracion__line" style="<?php echo $sStyleReadLab_duracion_; ?>"><?php echo $this->form_format_readonly("duracion_", $this->form_encode_input($this->duracion_)); ?></span><span id="id_read_off_duracion_<?php echo $sc_seq_vert ?>" class="css_read_off_duracion_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_duracion_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_duracion__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_duracion_<?php echo $sc_seq_vert ?>" type=text name="duracion_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($duracion_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['duracion_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['duracion_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['duracion_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['valor_']) && $this->nmgp_cmp_hidden['valor_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="valor_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($valor_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_valor__line <?php echo $classColFld ?>" id="hidden_field_data_valor_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_valor_; ?>"> 
<?php if ($bTestReadOnly_valor_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["valor_"]) &&  $this->nmgp_cmp_readonly["valor_"] == "on") { 

 ?>
<input type="hidden" name="valor_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($valor_) . "\">" . $valor_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_valor_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-valor_<?php echo $sc_seq_vert ?> css_valor__line" style="<?php echo $sStyleReadLab_valor_; ?>"><?php echo $this->form_format_readonly("valor_", $this->form_encode_input($this->valor_)); ?></span><span id="id_read_off_valor_<?php echo $sc_seq_vert ?>" class="css_read_off_valor_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_valor_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_valor__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_valor_<?php echo $sc_seq_vert ?>" type=text name="valor_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($valor_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=6"; } ?> alt="{datatype: 'decimal', maxLength: 6, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['valor_']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['valor_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['valor_']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['valor_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['activado_']) && $this->nmgp_cmp_hidden['activado_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="activado_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($activado_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_activado__line <?php echo $classColFld ?>" id="hidden_field_data_activado_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_activado_; ?>"> 
<?php if ($bTestReadOnly_activado_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["activado_"]) &&  $this->nmgp_cmp_readonly["activado_"] == "on") { 

 if ("S" == $this->activado_) { $activado__look = "Si";} 
 if ("N" == $this->activado_) { $activado__look = "No";} 
?>
<input type="hidden" name="activado_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($activado_) . "\">" . $activado__look . ""; ?>
<?php } else { ?>

<?php

 if ("S" == $this->activado_) { $activado__look = "Si";} 
 if ("N" == $this->activado_) { $activado__look = "No";} 
?>
<span id="id_read_on_activado_<?php echo $sc_seq_vert ; ?>"  class="css_activado__line" style="<?php echo $sStyleReadLab_activado_; ?>"><?php echo $this->form_format_readonly("activado_", $this->form_encode_input($activado__look)); ?></span><span id="id_read_off_activado_<?php echo $sc_seq_vert ; ?>" class="css_read_off_activado_ css_activado__line" style="<?php echo $sStyleReadInp_activado_; ?>"><div id="idAjaxRadio_activado_<?php echo $sc_seq_vert ; ?>" style="display: inline-block"  class="css_activado__line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOddMult css_activado__line"><?php $tempOptionId = "id-opt-activado_" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-activado_ sc-ui-radio-activado_<?php echo $sc_seq_vert ?>" type=radio name="activado_<?php echo $sc_seq_vert ?>" value="S"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['Lookup_activado_'][] = 'S'; ?>
<?php  if ("S" == $this->activado_)  { echo " checked" ;} ?><?php  if (empty($this->activado_)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Si</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOddMult css_activado__line"><?php $tempOptionId = "id-opt-activado_" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-activado_ sc-ui-radio-activado_<?php echo $sc_seq_vert ?>" type=radio name="activado_<?php echo $sc_seq_vert ?>" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['Lookup_activado_'][] = 'N'; ?>
<?php  if ("N" == $this->activado_)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">No</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
 </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>





   </tr>
<?php   
        if (isset($sCheckRead_id_tipos_agenda_))
       {
           $this->nmgp_cmp_readonly['id_tipos_agenda_'] = $sCheckRead_id_tipos_agenda_;
       }
       if ('display: none;' == $sStyleHidden_id_tipos_agenda_)
       {
           $this->nmgp_cmp_hidden['id_tipos_agenda_'] = 'off';
       }
       if (isset($sCheckRead_descripcion_))
       {
           $this->nmgp_cmp_readonly['descripcion_'] = $sCheckRead_descripcion_;
       }
       if ('display: none;' == $sStyleHidden_descripcion_)
       {
           $this->nmgp_cmp_hidden['descripcion_'] = 'off';
       }
       if (isset($sCheckRead_duracion_mostrada_))
       {
           $this->nmgp_cmp_readonly['duracion_mostrada_'] = $sCheckRead_duracion_mostrada_;
       }
       if ('display: none;' == $sStyleHidden_duracion_mostrada_)
       {
           $this->nmgp_cmp_hidden['duracion_mostrada_'] = 'off';
       }
       if (isset($sCheckRead_tipo_duracion_))
       {
           $this->nmgp_cmp_readonly['tipo_duracion_'] = $sCheckRead_tipo_duracion_;
       }
       if ('display: none;' == $sStyleHidden_tipo_duracion_)
       {
           $this->nmgp_cmp_hidden['tipo_duracion_'] = 'off';
       }
       if (isset($sCheckRead_duracion_))
       {
           $this->nmgp_cmp_readonly['duracion_'] = $sCheckRead_duracion_;
       }
       if ('display: none;' == $sStyleHidden_duracion_)
       {
           $this->nmgp_cmp_hidden['duracion_'] = 'off';
       }
       if (isset($sCheckRead_valor_))
       {
           $this->nmgp_cmp_readonly['valor_'] = $sCheckRead_valor_;
       }
       if ('display: none;' == $sStyleHidden_valor_)
       {
           $this->nmgp_cmp_hidden['valor_'] = 'off';
       }
       if (isset($sCheckRead_activado_))
       {
           $this->nmgp_cmp_readonly['activado_'] = $sCheckRead_activado_;
       }
       if ('display: none;' == $sStyleHidden_activado_)
       {
           $this->nmgp_cmp_hidden['activado_'] = 'off';
       }

   }
   if ($Line_Add) 
   { 
       $this->New_Line = ob_get_contents();
       ob_end_clean();
       $this->nmgp_opcao = $guarda_nmgp_opcao;
       $this->form_vert_form_tipos_agenda = $guarda_form_vert_form_tipos_agenda;
   } 
   if ($Table_refresh) 
   { 
       $this->Table_refresh = ob_get_contents();
       ob_end_clean();
   } 
}

function Form_Fim() 
{
   global $sc_seq_vert, $opcao_botoes, $nm_url_saida; 
?>   
</TABLE></div><!-- bloco_f -->
 </div>
 <div id="sc-id-fixedheaders-placeholder" style="display: none; position: fixed; top: 0; z-index: 500"></div>
<?php
$iContrVert = $this->Embutida_form ? $sc_seq_vert + 1 : $sc_seq_vert + 1;
if ($sc_seq_vert < $this->sc_max_reg)
{
    echo " <script type=\"text/javascript\">";
    echo "    bRefreshTable = true;";
    echo "</script>";
}
?>
<input type="hidden" name="sc_contr_vert" value="<?php echo $this->form_encode_input($iContrVert); ?>">
<?php
    $sEmptyStyle = 0 == $sc_seq_vert ? '' : 'display: none;';
?>
</td></tr>
<tr id="sc-ui-empty-form" style="<?php echo $sEmptyStyle; ?>"><td class="scFormPageText" style="padding: 10px; font-weight: bold">
<?php echo $this->Ini->Nm_lang['lang_errm_empt'];
?>
</td></tr>
<tr id="sc-id-required-row"><td class="scFormPageText">
<span class="scFormRequiredOddColorMult">* <?php echo $this->Ini->Nm_lang['lang_othr_reqr']; ?></span>
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['birpara'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "birpara", "scBtnFn_sys_GridPermiteSeq('b')", "scBtnFn_sys_GridPermiteSeq('b')", "brec_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_b" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['qtline'] == "on")
      {
?> 
          <span class="<?php echo $this->css_css_toolbar_obj ?>" style="border: 0px;"><?php echo $this->Ini->Nm_lang['lang_btns_rows'] ?></span>
          <select class="scFormToolbarInput" name="nmgp_quant_linhas_b" onchange="document.F7.nmgp_max_line.value = this.value; document.F7.submit();"> 
<?php 
              $obj_sel = ($this->sc_max_reg == '10') ? " selected" : "";
?> 
           <option value="10" <?php echo $obj_sel ?>>10</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '20') ? " selected" : "";
?> 
           <option value="20" <?php echo $obj_sel ?>>20</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '50') ? " selected" : "";
?> 
           <option value="50" <?php echo $obj_sel ?>>50</option>
          </select>
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['back'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bretorna", "scBtnFn_sys_format_ret()", "scBtnFn_sys_format_ret()", "sc_b_ret_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
if ($opcao_botoes != "novo" && $this->nmgp_botoes['navpage'] == "on")
{
?> 
     <span nowrap id="sc_b_navpage_b" class="scFormToolbarPadding"></span> 
<?php 
}
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['forward'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bavanca", "scBtnFn_sys_format_ava()", "scBtnFn_sys_format_ava()", "sc_b_avc_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-15';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['btn_label']['last'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bfinal", "scBtnFn_sys_format_fim()", "scBtnFn_sys_format_fim()", "sc_b_fim_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
if ($opcao_botoes != "novo" && $this->nmgp_botoes['summary'] == "on")
{
?> 
     <span nowrap id="sc_b_summary_b" class="scFormToolbarPadding"></span> 
<?php 
}
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');</script><?php } ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
</td></tr> 
</table> 
</div> 
</td> 
</tr> 
</table> 

<div id="id_debug_window" style="display: none;" class='scDebugWindow'><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideDebug()", "scAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>
<script>
 var iAjaxNewLine = <?php echo $sc_seq_vert; ?>;
<?php
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_modal']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['run_modal'])
{
?>
 for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) {
  scJQElementsAdd(iLine);
 }
<?php
}
else
{
?>
 $(function() {
  setTimeout(function() { for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) { scJQElementsAdd(iLine); } }, 250);
 });
<?php
}
?>
</script>
<div id="new_line_dummy" style="display: none">
</div>

</form> 
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0);

  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
</script> 
   </td></tr></table>
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['masterValue']);
?>
}
<?php
    }
}
?>
function updateHeaderFooter(sFldName, sFldValue)
{
  if (sFldValue[0] && sFldValue[0]["value"])
  {
    sFldValue = sFldValue[0]["value"];
  }
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_tipos_agenda");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_tipos_agenda");
 parent.scAjaxDetailHeight("form_tipos_agenda", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_tipos_agenda", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_tipos_agenda", <?php echo $sTamanhoIframe; ?>);
 }
</script>
<?php
    }
}
?>
<?php
if (isset($this->NM_ajax_info['displayMsg']) && $this->NM_ajax_info['displayMsg'])
{
    $isToast   = isset($this->NM_ajax_info['displayMsgToast']) && $this->NM_ajax_info['displayMsgToast'] ? 'true' : 'false';
    $toastType = $isToast && isset($this->NM_ajax_info['displayMsgToastType']) ? $this->NM_ajax_info['displayMsgToastType'] : '';
?>
<script type="text/javascript">
_scAjaxShowMessage({title: scMsgDefTitle, message: "<?php echo $this->NM_ajax_info['displayMsgTxt']; ?>", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: <?php echo $isToast ?>, toastPos: "", type: "<?php echo $toastType ?>"});
</script>
<?php
}
?>
<?php
if (isset($this->scFormFocusErrorName) && '' != $this->scFormFocusErrorName)
{
?>
<script>
scAjaxFocusError();
</script>
<?php
}
?>
<script type='text/javascript'>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['sc_modal'])
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
if (isset($this->redir_modal) && !empty($this->redir_modal))
{
    echo $this->redir_modal;
}
?>
</script>
<?php
if ($this->nmgp_form_empty) {
?>
<script type="text/javascript">
scAjax_displayEmptyForm();
</script>
<?php
}
?>
<script type="text/javascript">
	function scBtnFn_sys_format_inc() {
		if ($("#sc_b_new_t.sc-unique-btn-1").length && $("#sc_b_new_t.sc-unique-btn-1").is(":visible")) {
		    if ($("#sc_b_new_t.sc-unique-btn-1").hasClass("disabled")) {
		        return;
		    }
			do_ajax_form_tipos_agenda_add_new_line(); return false;
			 return;
		}
		if ($("#sc_b_new_t.sc-unique-btn-2").length && $("#sc_b_new_t.sc-unique-btn-2").is(":visible")) {
		    if ($("#sc_b_new_t.sc-unique-btn-2").hasClass("disabled")) {
		        return;
		    }
			nm_move ('novo');
			 return;
		}
		if ($("#sc_b_ins_t.sc-unique-btn-3").length && $("#sc_b_ins_t.sc-unique-btn-3").is(":visible")) {
		    if ($("#sc_b_ins_t.sc-unique-btn-3").hasClass("disabled")) {
		        return;
		    }
			nm_atualiza ('incluir');
			 return;
		}
	}
	function scBtnFn_sys_format_cnl() {
		if ($("#sc_b_sai_t.sc-unique-btn-4").length && $("#sc_b_sai_t.sc-unique-btn-4").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-4").hasClass("disabled")) {
		        return;
		    }
			<?php echo $this->NM_cancel_insert_new ?> document.F5.submit();
			 return;
		}
	}
	function scBtnFn_sys_format_alt() {
		if ($("#sc_b_upd_t.sc-unique-btn-5").length && $("#sc_b_upd_t.sc-unique-btn-5").is(":visible")) {
		    if ($("#sc_b_upd_t.sc-unique-btn-5").hasClass("disabled")) {
		        return;
		    }
			nm_atualiza ('alterar');
			 return;
		}
	}
	function scBtnFn_sys_format_reload() {
		if ($("#sc_b_reload_t.sc-unique-btn-6").length && $("#sc_b_reload_t.sc-unique-btn-6").is(":visible")) {
		    if ($("#sc_b_reload_t.sc-unique-btn-6").hasClass("disabled")) {
		        return;
		    }
			scAjax_formReload();
			 return;
		}
	}
	function scBtnFn_sys_format_hlp() {
		if ($("#sc_b_hlp_t").length && $("#sc_b_hlp_t").is(":visible")) {
		    if ($("#sc_b_hlp_t").hasClass("disabled")) {
		        return;
		    }
			window.open('<?php echo $this->url_webhelp; ?>', '', 'resizable, scrollbars'); 
			 return;
		}
	}
	function scBtnFn_sys_format_sai() {
		if ($("#sc_b_sai_t.sc-unique-btn-7").length && $("#sc_b_sai_t.sc-unique-btn-7").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-7").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F5('<?php echo $nm_url_saida; ?>');
			 return;
		}
		if ($("#sc_b_sai_t.sc-unique-btn-8").length && $("#sc_b_sai_t.sc-unique-btn-8").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-8").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F5('<?php echo $nm_url_saida; ?>');
			 return;
		}
		if ($("#sc_b_sai_t.sc-unique-btn-9").length && $("#sc_b_sai_t.sc-unique-btn-9").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-9").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
			 return;
		}
		if ($("#sc_b_sai_t.sc-unique-btn-10").length && $("#sc_b_sai_t.sc-unique-btn-10").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-10").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
			 return;
		}
		if ($("#sc_b_sai_t.sc-unique-btn-11").length && $("#sc_b_sai_t.sc-unique-btn-11").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-11").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
			 return;
		}
	}
	function scBtnFn_sys_GridPermiteSeq(btnPos) {
		if ($("#brec_b").length && $("#brec_b").is(":visible")) {
		    if ($("#brec_b").hasClass("disabled")) {
		        return;
		    }
			if (document.F1['nmgp_rec_' + btnPos].value != '') {nm_navpage(document.F1['nmgp_rec_' + btnPos].value, 'P');} document.F1['nmgp_rec_' + btnPos].value = '';
			 return;
		}
	}
	function scBtnFn_sys_format_ini() {
		if ($("#sc_b_ini_b.sc-unique-btn-12").length && $("#sc_b_ini_b.sc-unique-btn-12").is(":visible")) {
		    if ($("#sc_b_ini_b.sc-unique-btn-12").hasClass("disabled")) {
		        return;
		    }
			nm_move ('inicio');
			 return;
		}
	}
	function scBtnFn_sys_format_ret() {
		if ($("#sc_b_ret_b.sc-unique-btn-13").length && $("#sc_b_ret_b.sc-unique-btn-13").is(":visible")) {
		    if ($("#sc_b_ret_b.sc-unique-btn-13").hasClass("disabled")) {
		        return;
		    }
			nm_move ('retorna');
			 return;
		}
	}
	function scBtnFn_sys_format_ava() {
		if ($("#sc_b_avc_b.sc-unique-btn-14").length && $("#sc_b_avc_b.sc-unique-btn-14").is(":visible")) {
		    if ($("#sc_b_avc_b.sc-unique-btn-14").hasClass("disabled")) {
		        return;
		    }
			nm_move ('avanca');
			 return;
		}
	}
	function scBtnFn_sys_format_fim() {
		if ($("#sc_b_fim_b.sc-unique-btn-15").length && $("#sc_b_fim_b.sc-unique-btn-15").is(":visible")) {
		    if ($("#sc_b_fim_b.sc-unique-btn-15").hasClass("disabled")) {
		        return;
		    }
			nm_move ('final');
			 return;
		}
	}
</script>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tipos_agenda']['buttonStatus'] = $this->nmgp_botoes;
?>
<script type="text/javascript">
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
</body> 
</html> 
<?php 
 } 
} 
?> 
