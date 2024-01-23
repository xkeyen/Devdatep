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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_tbl_tb_customers'] . ""); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_tbl_tb_customers'] . ""); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/grp__NM__img__NM__sc_restaurant.png">
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

?>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
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
 </SCRIPT>
        <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
<style type="text/css">
.ui-datepicker { z-index: 6 !important }
</style>
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
<?php
$miniCalendarFA = $this->jqueryFAFile('calendar');
if ('' != $miniCalendarFA) {
?>
<style type="text/css">
.css_read_off_customer_birthday button {
	background-color: transparent;
	border: 0;
	padding: 0
}
</style>
<?php
}
?>
<link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2/css/select2.min.css" type="text/css" />
<script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2/js/select2.full.min.js"></script>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_tb_customers/form_tb_customers_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_tb_customers_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['last'] : 'off'); ?>";
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
    nm_sumario = "[<?php echo substr($this->Ini->Nm_lang['lang_othr_smry_info'], strpos($this->Ini->Nm_lang['lang_othr_smry_info'], "?final?")) ?>]";
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

include_once('form_tb_customers_jquery.php');

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

  scJQElementsAdd('');

  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

  var i, iTestWidth, iMaxLabelWidth = 0, $labelList = $(".scUiLabelWidthFix");
  for (i = 0; i < $labelList.length; i++) {
    iTestWidth = $($labelList[i]).width();
    sTestWidth = iTestWidth + "";
    if ("" == iTestWidth) {
      iTestWidth = 0;
    }
    else if ("px" == sTestWidth.substr(sTestWidth.length - 2)) {
      iTestWidth = parseInt(sTestWidth.substr(0, sTestWidth.length - 2));
    }
    iMaxLabelWidth = Math.max(iMaxLabelWidth, iTestWidth);
  }
  if (0 < iMaxLabelWidth) {
    $(".scUiLabelWidthFix").css("width", iMaxLabelWidth + "px");
  }
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
$str_iframe_body = 'margin-left: 0px; margin-right: 0px; margin-top: 0px; margin-bottom: 0px;';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['link_info']['remove_border']) {
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
 include_once("form_tb_customers_js0.php");
?>
<script type="text/javascript"> 
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
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['insert_validation']; ?>">
<?php
}
?>
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
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_tb_customers'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_tb_customers'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="100%">
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['fast_search'][2] : "";
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
          $SC_Label_atu['id_customer'] = (isset($this->nm_new_label['id_customer'])) ? $this->nm_new_label['id_customer'] : '' . $this->Ini->Nm_lang['lang_tb_customers_fld_id_customer'] . ''; 
          $SC_Label_atu['customer_name'] = (isset($this->nm_new_label['customer_name'])) ? $this->nm_new_label['customer_name'] : '' . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_name'] . ''; 
          $SC_Label_atu['customer_gender'] = (isset($this->nm_new_label['customer_gender'])) ? $this->nm_new_label['customer_gender'] : '' . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_gender'] . ''; 
          $SC_Label_atu['customer_birthday'] = (isset($this->nm_new_label['customer_birthday'])) ? $this->nm_new_label['customer_birthday'] : '' . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_birthday'] . ''; 
          $SC_Label_atu['customer_num_doc'] = (isset($this->nm_new_label['customer_num_doc'])) ? $this->nm_new_label['customer_num_doc'] : '' . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_num_doc'] . ''; 
          $SC_Label_atu['doctype'] = (isset($this->nm_new_label['doctype'])) ? $this->nm_new_label['doctype'] : '' . $this->Ini->Nm_lang['lang_tb_customers_fld_doctype'] . ''; 
          $SC_Label_atu['id_country'] = (isset($this->nm_new_label['id_country'])) ? $this->nm_new_label['id_country'] : '' . $this->Ini->Nm_lang['lang_tb_customers_fld_id_country'] . ''; 
          $SC_Label_atu['customer_address'] = (isset($this->nm_new_label['customer_address'])) ? $this->nm_new_label['customer_address'] : '' . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_address'] . ''; 
          $SC_Label_atu['customer_phone1'] = (isset($this->nm_new_label['customer_phone1'])) ? $this->nm_new_label['customer_phone1'] : '' . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_phone1'] . ''; 
          $SC_Label_atu['customer_phone2'] = (isset($this->nm_new_label['customer_phone2'])) ? $this->nm_new_label['customer_phone2'] : '' . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_phone2'] . ''; 
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
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['insert'];
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
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['bcancelar'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnFn_sys_format_cnl()", "scBtnFn_sys_format_cnl()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['delete'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['delete'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "scBtnFn_sys_format_exc()", "scBtnFn_sys_format_exc()", "sc_b_del_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "R")
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
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['id_customer']))
           {
               $this->nmgp_cmp_readonly['id_customer'] = 'on';
           }
?>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_customer']))
    {
        $this->nm_new_label['id_customer'] = "" . $this->Ini->Nm_lang['lang_tb_customers_fld_id_customer'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_customer = $this->id_customer;
   $sStyleHidden_id_customer = '';
   if (isset($this->nmgp_cmp_hidden['id_customer']) && $this->nmgp_cmp_hidden['id_customer'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_customer']);
       $sStyleHidden_id_customer = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_customer = 'display: none;';
   $sStyleReadInp_id_customer = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["id_customer"]) &&  $this->nmgp_cmp_readonly["id_customer"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_customer']);
       $sStyleReadLab_id_customer = '';
       $sStyleReadInp_id_customer = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_customer']) && $this->nmgp_cmp_hidden['id_customer'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_customer" value="<?php echo $this->form_encode_input($id_customer) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_customer_label" id="hidden_field_label_id_customer" style="<?php echo $sStyleHidden_id_customer; ?>"><span id="id_label_id_customer"><?php echo $this->nm_new_label['id_customer']; ?></span></TD>
    <TD class="scFormDataOdd css_id_customer_line" id="hidden_field_data_id_customer" style="<?php echo $sStyleHidden_id_customer; ?>"><span id="id_read_on_id_customer" class="css_id_customer_line" style="<?php echo $sStyleReadLab_id_customer; ?>"><?php echo $this->form_format_readonly("id_customer", $this->form_encode_input($this->id_customer)); ?></span><span id="id_read_off_id_customer" class="css_read_off_id_customer" style="<?php echo $sStyleReadInp_id_customer; ?>"><input type="hidden" name="id_customer" value="<?php echo $this->form_encode_input($id_customer) . "\">"?><span id="id_ajax_label_id_customer"><?php echo nl2br($id_customer); ?></span>
</span></span></TD>
   <?php }
      else
      {
         $sc_hidden_no--;
      }
?>
<?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['customer_name']))
    {
        $this->nm_new_label['customer_name'] = "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_name'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $customer_name = $this->customer_name;
   $sStyleHidden_customer_name = '';
   if (isset($this->nmgp_cmp_hidden['customer_name']) && $this->nmgp_cmp_hidden['customer_name'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['customer_name']);
       $sStyleHidden_customer_name = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_customer_name = 'display: none;';
   $sStyleReadInp_customer_name = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['customer_name']) && $this->nmgp_cmp_readonly['customer_name'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['customer_name']);
       $sStyleReadLab_customer_name = '';
       $sStyleReadInp_customer_name = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['customer_name']) && $this->nmgp_cmp_hidden['customer_name'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="customer_name" value="<?php echo $this->form_encode_input($customer_name) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_customer_name_label" id="hidden_field_label_customer_name" style="<?php echo $sStyleHidden_customer_name; ?>"><span id="id_label_customer_name"><?php echo $this->nm_new_label['customer_name']; ?></span></TD>
    <TD class="scFormDataOdd css_customer_name_line" id="hidden_field_data_customer_name" style="<?php echo $sStyleHidden_customer_name; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["customer_name"]) &&  $this->nmgp_cmp_readonly["customer_name"] == "on") { 

 ?>
<input type="hidden" name="customer_name" value="<?php echo $this->form_encode_input($customer_name) . "\">" . $customer_name . ""; ?>
<?php } else { ?>
<span id="id_read_on_customer_name" class="sc-ui-readonly-customer_name css_customer_name_line" style="<?php echo $sStyleReadLab_customer_name; ?>"><?php echo $this->form_format_readonly("customer_name", $this->form_encode_input($this->customer_name)); ?></span><span id="id_read_off_customer_name" class="css_read_off_customer_name<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_customer_name; ?>">
 <input class="sc-js-input scFormObjectOdd css_customer_name_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_customer_name" type=text name="customer_name" value="<?php echo $this->form_encode_input($customer_name) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['customer_gender']))
    {
        $this->nm_new_label['customer_gender'] = "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_gender'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $customer_gender = $this->customer_gender;
   $sStyleHidden_customer_gender = '';
   if (isset($this->nmgp_cmp_hidden['customer_gender']) && $this->nmgp_cmp_hidden['customer_gender'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['customer_gender']);
       $sStyleHidden_customer_gender = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_customer_gender = 'display: none;';
   $sStyleReadInp_customer_gender = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['customer_gender']) && $this->nmgp_cmp_readonly['customer_gender'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['customer_gender']);
       $sStyleReadLab_customer_gender = '';
       $sStyleReadInp_customer_gender = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['customer_gender']) && $this->nmgp_cmp_hidden['customer_gender'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="customer_gender" value="<?php echo $this->form_encode_input($customer_gender) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_customer_gender_label" id="hidden_field_label_customer_gender" style="<?php echo $sStyleHidden_customer_gender; ?>"><span id="id_label_customer_gender"><?php echo $this->nm_new_label['customer_gender']; ?></span></TD>
    <TD class="scFormDataOdd css_customer_gender_line" id="hidden_field_data_customer_gender" style="<?php echo $sStyleHidden_customer_gender; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["customer_gender"]) &&  $this->nmgp_cmp_readonly["customer_gender"] == "on") { 

 if ("M" == $this->customer_gender) { $customer_gender_look = "Male";} 
 if ("F" == $this->customer_gender) { $customer_gender_look = "Female";} 
?>
<input type="hidden" name="customer_gender" value="<?php echo $this->form_encode_input($customer_gender) . "\">" . $customer_gender_look . ""; ?>
<?php } else { ?>

<?php

 if ("M" == $this->customer_gender) { $customer_gender_look = "Male";} 
 if ("F" == $this->customer_gender) { $customer_gender_look = "Female";} 
?>
<span id="id_read_on_customer_gender"  class="css_customer_gender_line" style="<?php echo $sStyleReadLab_customer_gender; ?>"><?php echo $this->form_format_readonly("customer_gender", $this->form_encode_input($customer_gender_look)); ?></span><span id="id_read_off_customer_gender" class="css_read_off_customer_gender css_customer_gender_line" style="<?php echo $sStyleReadInp_customer_gender; ?>"><div id="idAjaxRadio_customer_gender" style="display: inline-block"  class="css_customer_gender_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_customer_gender_line"><?php $tempOptionId = "id-opt-customer_gender" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-customer_gender sc-ui-radio-customer_gender" type=radio name="customer_gender" value="M"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_customer_gender'][] = 'M'; ?>
<?php  if ("M" == $this->customer_gender)  { echo " checked" ;} ?><?php  if (empty($this->customer_gender)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Male</label></TD>
  <TD class="scFormDataFontOdd css_customer_gender_line"><?php $tempOptionId = "id-opt-customer_gender" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-customer_gender sc-ui-radio-customer_gender" type=radio name="customer_gender" value="F"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_customer_gender'][] = 'F'; ?>
<?php  if ("F" == $this->customer_gender)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Female</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['customer_birthday']))
    {
        $this->nm_new_label['customer_birthday'] = "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_birthday'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $customer_birthday = $this->customer_birthday;
   $sStyleHidden_customer_birthday = '';
   if (isset($this->nmgp_cmp_hidden['customer_birthday']) && $this->nmgp_cmp_hidden['customer_birthday'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['customer_birthday']);
       $sStyleHidden_customer_birthday = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_customer_birthday = 'display: none;';
   $sStyleReadInp_customer_birthday = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['customer_birthday']) && $this->nmgp_cmp_readonly['customer_birthday'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['customer_birthday']);
       $sStyleReadLab_customer_birthday = '';
       $sStyleReadInp_customer_birthday = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['customer_birthday']) && $this->nmgp_cmp_hidden['customer_birthday'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="customer_birthday" value="<?php echo $this->form_encode_input($customer_birthday) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_customer_birthday_label" id="hidden_field_label_customer_birthday" style="<?php echo $sStyleHidden_customer_birthday; ?>"><span id="id_label_customer_birthday"><?php echo $this->nm_new_label['customer_birthday']; ?></span></TD>
    <TD class="scFormDataOdd css_customer_birthday_line" id="hidden_field_data_customer_birthday" style="<?php echo $sStyleHidden_customer_birthday; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["customer_birthday"]) &&  $this->nmgp_cmp_readonly["customer_birthday"] == "on") { 

 ?>
<input type="hidden" name="customer_birthday" value="<?php echo $this->form_encode_input($customer_birthday) . "\">" . $customer_birthday . ""; ?>
<?php } else { ?>
<span id="id_read_on_customer_birthday" class="sc-ui-readonly-customer_birthday css_customer_birthday_line" style="<?php echo $sStyleReadLab_customer_birthday; ?>"><?php echo $this->form_format_readonly("customer_birthday", $this->form_encode_input($customer_birthday)); ?></span><span id="id_read_off_customer_birthday" class="css_read_off_customer_birthday<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_customer_birthday; ?>"><?php
$tmp_form_data = $this->field_config['customer_birthday']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOdd css_customer_birthday_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_customer_birthday" type=text name="customer_birthday" value="<?php echo $this->form_encode_input($customer_birthday) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['customer_birthday']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['customer_birthday']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
<span class="scFormDataHelpOdd" style="display: block"><?php echo $tmp_form_data; ?></span></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['customer_num_doc']))
    {
        $this->nm_new_label['customer_num_doc'] = "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_num_doc'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $customer_num_doc = $this->customer_num_doc;
   $sStyleHidden_customer_num_doc = '';
   if (isset($this->nmgp_cmp_hidden['customer_num_doc']) && $this->nmgp_cmp_hidden['customer_num_doc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['customer_num_doc']);
       $sStyleHidden_customer_num_doc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_customer_num_doc = 'display: none;';
   $sStyleReadInp_customer_num_doc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['customer_num_doc']) && $this->nmgp_cmp_readonly['customer_num_doc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['customer_num_doc']);
       $sStyleReadLab_customer_num_doc = '';
       $sStyleReadInp_customer_num_doc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['customer_num_doc']) && $this->nmgp_cmp_hidden['customer_num_doc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="customer_num_doc" value="<?php echo $this->form_encode_input($customer_num_doc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_customer_num_doc_label" id="hidden_field_label_customer_num_doc" style="<?php echo $sStyleHidden_customer_num_doc; ?>"><span id="id_label_customer_num_doc"><?php echo $this->nm_new_label['customer_num_doc']; ?></span></TD>
    <TD class="scFormDataOdd css_customer_num_doc_line" id="hidden_field_data_customer_num_doc" style="<?php echo $sStyleHidden_customer_num_doc; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["customer_num_doc"]) &&  $this->nmgp_cmp_readonly["customer_num_doc"] == "on") { 

 ?>
<input type="hidden" name="customer_num_doc" value="<?php echo $this->form_encode_input($customer_num_doc) . "\">" . $customer_num_doc . ""; ?>
<?php } else { ?>
<span id="id_read_on_customer_num_doc" class="sc-ui-readonly-customer_num_doc css_customer_num_doc_line" style="<?php echo $sStyleReadLab_customer_num_doc; ?>"><?php echo $this->form_format_readonly("customer_num_doc", $this->form_encode_input($this->customer_num_doc)); ?></span><span id="id_read_off_customer_num_doc" class="css_read_off_customer_num_doc<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_customer_num_doc; ?>">
 <input class="sc-js-input scFormObjectOdd css_customer_num_doc_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_customer_num_doc" type=text name="customer_num_doc" value="<?php echo $this->form_encode_input($customer_num_doc) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['doctype']))
    {
        $this->nm_new_label['doctype'] = "" . $this->Ini->Nm_lang['lang_tb_customers_fld_doctype'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $doctype = $this->doctype;
   $sStyleHidden_doctype = '';
   if (isset($this->nmgp_cmp_hidden['doctype']) && $this->nmgp_cmp_hidden['doctype'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['doctype']);
       $sStyleHidden_doctype = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_doctype = 'display: none;';
   $sStyleReadInp_doctype = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['doctype']) && $this->nmgp_cmp_readonly['doctype'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['doctype']);
       $sStyleReadLab_doctype = '';
       $sStyleReadInp_doctype = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['doctype']) && $this->nmgp_cmp_hidden['doctype'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="doctype" value="<?php echo $this->form_encode_input($doctype) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_doctype_label" id="hidden_field_label_doctype" style="<?php echo $sStyleHidden_doctype; ?>"><span id="id_label_doctype"><?php echo $this->nm_new_label['doctype']; ?></span></TD>
    <TD class="scFormDataOdd css_doctype_line" id="hidden_field_data_doctype" style="<?php echo $sStyleHidden_doctype; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["doctype"]) &&  $this->nmgp_cmp_readonly["doctype"] == "on") { 

 ?>
<input type="hidden" name="doctype" value="<?php echo $this->form_encode_input($doctype) . "\">" . $doctype . ""; ?>
<?php } else { ?>
<span id="id_read_on_doctype" class="sc-ui-readonly-doctype css_doctype_line" style="<?php echo $sStyleReadLab_doctype; ?>"><?php echo $this->form_format_readonly("doctype", $this->form_encode_input($this->doctype)); ?></span><span id="id_read_off_doctype" class="css_read_off_doctype<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_doctype; ?>">
 <input class="sc-js-input scFormObjectOdd css_doctype_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_doctype" type=text name="doctype" value="<?php echo $this->form_encode_input($doctype) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_country']))
   {
       $this->nm_new_label['id_country'] = "" . $this->Ini->Nm_lang['lang_tb_customers_fld_id_country'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_country = $this->id_country;
   $sStyleHidden_id_country = '';
   if (isset($this->nmgp_cmp_hidden['id_country']) && $this->nmgp_cmp_hidden['id_country'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_country']);
       $sStyleHidden_id_country = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_country = 'display: none;';
   $sStyleReadInp_id_country = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_country']) && $this->nmgp_cmp_readonly['id_country'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_country']);
       $sStyleReadLab_id_country = '';
       $sStyleReadInp_id_country = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_country']) && $this->nmgp_cmp_hidden['id_country'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_country" value="<?php echo $this->form_encode_input($this->id_country) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_country_label" id="hidden_field_label_id_country" style="<?php echo $sStyleHidden_id_country; ?>"><span id="id_label_id_country"><?php echo $this->nm_new_label['id_country']; ?></span></TD>
    <TD class="scFormDataOdd css_id_country_line" id="hidden_field_data_id_country" style="<?php echo $sStyleHidden_id_country; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_country"]) &&  $this->nmgp_cmp_readonly["id_country"] == "on") { 

$id_country_look = "";
 if ($this->id_country == "AF") { $id_country_look .= "Afghanistan" ;} 
 if ($this->id_country == "AL") { $id_country_look .= "Albania" ;} 
 if ($this->id_country == "DZ") { $id_country_look .= "Algeria" ;} 
 if ($this->id_country == "AS") { $id_country_look .= "American Samoa" ;} 
 if ($this->id_country == "AD") { $id_country_look .= "Andorra" ;} 
 if ($this->id_country == "AO") { $id_country_look .= "Angola" ;} 
 if ($this->id_country == "AI") { $id_country_look .= "Anguilla" ;} 
 if ($this->id_country == "AQ") { $id_country_look .= "Antarctica" ;} 
 if ($this->id_country == "AG") { $id_country_look .= "Antigua and Barbuda" ;} 
 if ($this->id_country == "AR") { $id_country_look .= "Argentina" ;} 
 if ($this->id_country == "AM") { $id_country_look .= "Armenia" ;} 
 if ($this->id_country == "AW") { $id_country_look .= "Aruba" ;} 
 if ($this->id_country == "AU") { $id_country_look .= "Australia" ;} 
 if ($this->id_country == "AT") { $id_country_look .= "Austria" ;} 
 if ($this->id_country == "AZ") { $id_country_look .= "Azerbaijan" ;} 
 if ($this->id_country == "BS") { $id_country_look .= "Bahamas" ;} 
 if ($this->id_country == "BH") { $id_country_look .= "Bahrain" ;} 
 if ($this->id_country == "BD") { $id_country_look .= "Bangladesh" ;} 
 if ($this->id_country == "BB") { $id_country_look .= "Barbados" ;} 
 if ($this->id_country == "BY") { $id_country_look .= "Belarus" ;} 
 if ($this->id_country == "BE") { $id_country_look .= "Belgium" ;} 
 if ($this->id_country == "BZ") { $id_country_look .= "Belize" ;} 
 if ($this->id_country == "BJ") { $id_country_look .= "Benin" ;} 
 if ($this->id_country == "BM") { $id_country_look .= "Bermuda" ;} 
 if ($this->id_country == "BT") { $id_country_look .= "Bhutan" ;} 
 if ($this->id_country == "BO") { $id_country_look .= "Bolivia" ;} 
 if ($this->id_country == "BA") { $id_country_look .= "Bosnia and Herzegovina" ;} 
 if ($this->id_country == "BW") { $id_country_look .= "Botswana" ;} 
 if ($this->id_country == "BV") { $id_country_look .= "Bouvet Island" ;} 
 if ($this->id_country == "BR") { $id_country_look .= "Brasil" ;} 
 if ($this->id_country == "IO") { $id_country_look .= "British Indian Ocean Territory" ;} 
 if ($this->id_country == "BN") { $id_country_look .= "Brunei Darussalam" ;} 
 if ($this->id_country == "BG") { $id_country_look .= "Bulgaria" ;} 
 if ($this->id_country == "BF") { $id_country_look .= "Burkina Faso" ;} 
 if ($this->id_country == "BI") { $id_country_look .= "Burundi" ;} 
 if ($this->id_country == "KH") { $id_country_look .= "Cambodia" ;} 
 if ($this->id_country == "CM") { $id_country_look .= "Cameroon" ;} 
 if ($this->id_country == "CA") { $id_country_look .= "Canada" ;} 
 if ($this->id_country == "CV") { $id_country_look .= "Cape Verde" ;} 
 if ($this->id_country == "KY") { $id_country_look .= "Cayman Islands" ;} 
 if ($this->id_country == "CF") { $id_country_look .= "Central African Republic" ;} 
 if ($this->id_country == "TD") { $id_country_look .= "Chad" ;} 
 if ($this->id_country == "CL") { $id_country_look .= "Chile" ;} 
 if ($this->id_country == "CN") { $id_country_look .= "China" ;} 
 if ($this->id_country == "CX") { $id_country_look .= "Christmas Island" ;} 
 if ($this->id_country == "CC") { $id_country_look .= "Cocos (Keeling) Islands" ;} 
 if ($this->id_country == "CO") { $id_country_look .= "Colombia" ;} 
 if ($this->id_country == "KM") { $id_country_look .= "Comoros" ;} 
 if ($this->id_country == "CG") { $id_country_look .= "Congo" ;} 
 if ($this->id_country == "CK") { $id_country_look .= "Cook Islands" ;} 
 if ($this->id_country == "CR") { $id_country_look .= "Costa Rica" ;} 
 if ($this->id_country == "CI") { $id_country_look .= "Cote d Ivoire" ;} 
 if ($this->id_country == "HR") { $id_country_look .= "Croatia" ;} 
 if ($this->id_country == "CU") { $id_country_look .= "Cuba" ;} 
 if ($this->id_country == "CY") { $id_country_look .= "Cyprus" ;} 
 if ($this->id_country == "CZ") { $id_country_look .= "Czech Republic" ;} 
 if ($this->id_country == "DK") { $id_country_look .= "Denmark" ;} 
 if ($this->id_country == "DJ") { $id_country_look .= "Djibouti" ;} 
 if ($this->id_country == "DM") { $id_country_look .= "Dominica" ;} 
 if ($this->id_country == "DO") { $id_country_look .= "Dominican Republic" ;} 
 if ($this->id_country == "TP") { $id_country_look .= "East Timor" ;} 
 if ($this->id_country == "EC") { $id_country_look .= "Ecuador" ;} 
 if ($this->id_country == "EG") { $id_country_look .= "Egypt" ;} 
 if ($this->id_country == "SV") { $id_country_look .= "El Salvador" ;} 
 if ($this->id_country == "GQ") { $id_country_look .= "Equatorial Guinea" ;} 
 if ($this->id_country == "ER") { $id_country_look .= "Eritrea" ;} 
 if ($this->id_country == "EE") { $id_country_look .= "Estonia" ;} 
 if ($this->id_country == "ET") { $id_country_look .= "Ethiopia" ;} 
 if ($this->id_country == "FK") { $id_country_look .= "Falkland Islands (Malvinas)" ;} 
 if ($this->id_country == "FO") { $id_country_look .= "Faroe Islands" ;} 
 if ($this->id_country == "FJ") { $id_country_look .= "Fiji" ;} 
 if ($this->id_country == "FI") { $id_country_look .= "Finland" ;} 
 if ($this->id_country == "FR") { $id_country_look .= "France" ;} 
 if ($this->id_country == "FX") { $id_country_look .= "France Metropolitan" ;} 
 if ($this->id_country == "GF") { $id_country_look .= "French Guiana" ;} 
 if ($this->id_country == "PF") { $id_country_look .= "French Polynesia" ;} 
 if ($this->id_country == "TF") { $id_country_look .= "French Southern Territories" ;} 
 if ($this->id_country == "GA") { $id_country_look .= "Gabon" ;} 
 if ($this->id_country == "GM") { $id_country_look .= "Gambia" ;} 
 if ($this->id_country == "GE") { $id_country_look .= "Georgia" ;} 
 if ($this->id_country == "DE") { $id_country_look .= "Germany" ;} 
 if ($this->id_country == "GH") { $id_country_look .= "Ghana" ;} 
 if ($this->id_country == "GI") { $id_country_look .= "Gibraltar" ;} 
 if ($this->id_country == "GR") { $id_country_look .= "Greece" ;} 
 if ($this->id_country == "GL") { $id_country_look .= "Greenland" ;} 
 if ($this->id_country == "GD") { $id_country_look .= "Grenada" ;} 
 if ($this->id_country == "GP") { $id_country_look .= "Guadeloupe" ;} 
 if ($this->id_country == "GU") { $id_country_look .= "Guam" ;} 
 if ($this->id_country == "GT") { $id_country_look .= "Guatemala" ;} 
 if ($this->id_country == "GN") { $id_country_look .= "Guinea" ;} 
 if ($this->id_country == "GW") { $id_country_look .= "Guinea-Bissau" ;} 
 if ($this->id_country == "GY") { $id_country_look .= "Guyana" ;} 
 if ($this->id_country == "HT") { $id_country_look .= "Haiti" ;} 
 if ($this->id_country == "HM") { $id_country_look .= "Heard Island and McDonald Islands" ;} 
 if ($this->id_country == "HN") { $id_country_look .= "Honduras" ;} 
 if ($this->id_country == "HK") { $id_country_look .= "Hong Kong" ;} 
 if ($this->id_country == "HU") { $id_country_look .= "Hungary" ;} 
 if ($this->id_country == "IS") { $id_country_look .= "Iceland" ;} 
 if ($this->id_country == "IN") { $id_country_look .= "India" ;} 
 if ($this->id_country == "ID") { $id_country_look .= "Indonesia" ;} 
 if ($this->id_country == "IR") { $id_country_look .= "Iran (Islamic Republic of)" ;} 
 if ($this->id_country == "IQ") { $id_country_look .= "Iraq" ;} 
 if ($this->id_country == "IE") { $id_country_look .= "Ireland" ;} 
 if ($this->id_country == "IL") { $id_country_look .= "Israel" ;} 
 if ($this->id_country == "IT") { $id_country_look .= "Italy" ;} 
 if ($this->id_country == "JM") { $id_country_look .= "Jamaica" ;} 
 if ($this->id_country == "JP") { $id_country_look .= "Japan" ;} 
 if ($this->id_country == "JO") { $id_country_look .= "Jordan" ;} 
 if ($this->id_country == "KZ") { $id_country_look .= "Kazakhstan" ;} 
 if ($this->id_country == "KE") { $id_country_look .= "Kenya" ;} 
 if ($this->id_country == "KI") { $id_country_look .= "Kiribati" ;} 
 if ($this->id_country == "KP") { $id_country_look .= "Korea Democratic People Republic of" ;} 
 if ($this->id_country == "KR") { $id_country_look .= "Korea Republic of" ;} 
 if ($this->id_country == "KW") { $id_country_look .= "Kuwait" ;} 
 if ($this->id_country == "KG") { $id_country_look .= "Kyrgyzstan" ;} 
 if ($this->id_country == "LA") { $id_country_look .= "Lao People Democratic Republic" ;} 
 if ($this->id_country == "LT") { $id_country_look .= "Latin America" ;} 
 if ($this->id_country == "LV") { $id_country_look .= "Latvia" ;} 
 if ($this->id_country == "LB") { $id_country_look .= "Lebanon" ;} 
 if ($this->id_country == "LS") { $id_country_look .= "Lesotho" ;} 
 if ($this->id_country == "LR") { $id_country_look .= "Liberia" ;} 
 if ($this->id_country == "LY") { $id_country_look .= "Libyan Arab Jamahiriya" ;} 
 if ($this->id_country == "LI") { $id_country_look .= "Liechtenstein" ;} 
 if ($this->id_country == "LX") { $id_country_look .= "Lithuania" ;} 
 if ($this->id_country == "LU") { $id_country_look .= "Luxembourg" ;} 
 if ($this->id_country == "MO") { $id_country_look .= "Macau" ;} 
 if ($this->id_country == "MK") { $id_country_look .= "Macedonia" ;} 
 if ($this->id_country == "MG") { $id_country_look .= "Madagascar" ;} 
 if ($this->id_country == "MW") { $id_country_look .= "Malawi" ;} 
 if ($this->id_country == "MY") { $id_country_look .= "Malaysia" ;} 
 if ($this->id_country == "MV") { $id_country_look .= "Maldives" ;} 
 if ($this->id_country == "ML") { $id_country_look .= "Mali" ;} 
 if ($this->id_country == "MT") { $id_country_look .= "Malta" ;} 
 if ($this->id_country == "MH") { $id_country_look .= "Marshall Islands" ;} 
 if ($this->id_country == "MQ") { $id_country_look .= "Martinique" ;} 
 if ($this->id_country == "MR") { $id_country_look .= "Mauritania" ;} 
 if ($this->id_country == "MU") { $id_country_look .= "Mauritius" ;} 
 if ($this->id_country == "YT") { $id_country_look .= "Mayotte" ;} 
 if ($this->id_country == "MX") { $id_country_look .= "Mexico" ;} 
 if ($this->id_country == "FM") { $id_country_look .= "Micronesia (Federated States of)" ;} 
 if ($this->id_country == "MD") { $id_country_look .= "Moldova Republic of" ;} 
 if ($this->id_country == "MC") { $id_country_look .= "Monaco" ;} 
 if ($this->id_country == "MN") { $id_country_look .= "Mongolia" ;} 
 if ($this->id_country == "MS") { $id_country_look .= "Montserrat" ;} 
 if ($this->id_country == "MA") { $id_country_look .= "Morocco" ;} 
 if ($this->id_country == "MZ") { $id_country_look .= "Mozambique" ;} 
 if ($this->id_country == "MM") { $id_country_look .= "Myanmar" ;} 
 if ($this->id_country == "NA") { $id_country_look .= "Namibia" ;} 
 if ($this->id_country == "NR") { $id_country_look .= "Nauru" ;} 
 if ($this->id_country == "NP") { $id_country_look .= "Nepal" ;} 
 if ($this->id_country == "NL") { $id_country_look .= "Netherlands" ;} 
 if ($this->id_country == "AN") { $id_country_look .= "Netherlands Antilles" ;} 
 if ($this->id_country == "NC") { $id_country_look .= "New Caledonia" ;} 
 if ($this->id_country == "NZ") { $id_country_look .= "New Zealand" ;} 
 if ($this->id_country == "NI") { $id_country_look .= "Nicaragua" ;} 
 if ($this->id_country == "NE") { $id_country_look .= "Niger" ;} 
 if ($this->id_country == "NG") { $id_country_look .= "Nigeria" ;} 
 if ($this->id_country == "NU") { $id_country_look .= "Niue" ;} 
 if ($this->id_country == "NF") { $id_country_look .= "Norfolk Island" ;} 
 if ($this->id_country == "MP") { $id_country_look .= "Northern Mariana Islands" ;} 
 if ($this->id_country == "NO") { $id_country_look .= "Norway" ;} 
 if ($this->id_country == "OM") { $id_country_look .= "Oman" ;} 
 if ($this->id_country == "PK") { $id_country_look .= "Pakistan" ;} 
 if ($this->id_country == "PW") { $id_country_look .= "Palau" ;} 
 if ($this->id_country == "PA") { $id_country_look .= "Panama" ;} 
 if ($this->id_country == "PG") { $id_country_look .= "Papua New Guinea" ;} 
 if ($this->id_country == "PY") { $id_country_look .= "Paraguay" ;} 
 if ($this->id_country == "PE") { $id_country_look .= "Peru" ;} 
 if ($this->id_country == "PH") { $id_country_look .= "Philippines" ;} 
 if ($this->id_country == "PN") { $id_country_look .= "Pitcairn" ;} 
 if ($this->id_country == "PL") { $id_country_look .= "Poland" ;} 
 if ($this->id_country == "PT") { $id_country_look .= "Portugal" ;} 
 if ($this->id_country == "PR") { $id_country_look .= "Puerto Rico" ;} 
 if ($this->id_country == "QA") { $id_country_look .= "Qatar" ;} 
 if ($this->id_country == "RE") { $id_country_look .= "Reunion" ;} 
 if ($this->id_country == "RO") { $id_country_look .= "Romania" ;} 
 if ($this->id_country == "RU") { $id_country_look .= "Russian Federation" ;} 
 if ($this->id_country == "RW") { $id_country_look .= "Rwanda" ;} 
 if ($this->id_country == "SH") { $id_country_look .= "Saint Helena" ;} 
 if ($this->id_country == "KN") { $id_country_look .= "Saint Kitts and Nevis" ;} 
 if ($this->id_country == "LC") { $id_country_look .= "Saint Lucia" ;} 
 if ($this->id_country == "PM") { $id_country_look .= "Saint Pierre and Miquelon" ;} 
 if ($this->id_country == "VC") { $id_country_look .= "Saint Vincent and the Grenadines" ;} 
 if ($this->id_country == "WS") { $id_country_look .= "Samoa" ;} 
 if ($this->id_country == "SM") { $id_country_look .= "San Marino" ;} 
 if ($this->id_country == "ST") { $id_country_look .= "Sao Tome and Principe" ;} 
 if ($this->id_country == "SA") { $id_country_look .= "Saudi Arabia" ;} 
 if ($this->id_country == "SN") { $id_country_look .= "Senegal" ;} 
 if ($this->id_country == "SC") { $id_country_look .= "Seychelles" ;} 
 if ($this->id_country == "SL") { $id_country_look .= "Sierra Leone" ;} 
 if ($this->id_country == "SG") { $id_country_look .= "Singapore" ;} 
 if ($this->id_country == "SK") { $id_country_look .= "Slovakia" ;} 
 if ($this->id_country == "SI") { $id_country_look .= "Slovenia" ;} 
 if ($this->id_country == "SB") { $id_country_look .= "Solomon Islands" ;} 
 if ($this->id_country == "SO") { $id_country_look .= "Somalia" ;} 
 if ($this->id_country == "ZA") { $id_country_look .= "South Africa" ;} 
 if ($this->id_country == "GS") { $id_country_look .= "South Georgia and the South Sandwich" ;} 
 if ($this->id_country == "ES") { $id_country_look .= "Spain" ;} 
 if ($this->id_country == "LK") { $id_country_look .= "Sri Lanka" ;} 
 if ($this->id_country == "SD") { $id_country_look .= "Sudan" ;} 
 if ($this->id_country == "SR") { $id_country_look .= "Suriname" ;} 
 if ($this->id_country == "SJ") { $id_country_look .= "Svalbard and Jan Mayen Islands" ;} 
 if ($this->id_country == "SZ") { $id_country_look .= "Swaziland" ;} 
 if ($this->id_country == "SE") { $id_country_look .= "Sweden" ;} 
 if ($this->id_country == "CH") { $id_country_look .= "Switzerland" ;} 
 if ($this->id_country == "SY") { $id_country_look .= "Syrian Arab Republic" ;} 
 if ($this->id_country == "TW") { $id_country_look .= "Taiwan Republic of China" ;} 
 if ($this->id_country == "TJ") { $id_country_look .= "Tajikistan" ;} 
 if ($this->id_country == "TZ") { $id_country_look .= "Tanzania United Republic of" ;} 
 if ($this->id_country == "TH") { $id_country_look .= "Thailand" ;} 
 if ($this->id_country == "TG") { $id_country_look .= "Togo" ;} 
 if ($this->id_country == "TK") { $id_country_look .= "Tokelau" ;} 
 if ($this->id_country == "TO") { $id_country_look .= "Tonga" ;} 
 if ($this->id_country == "TT") { $id_country_look .= "Trinidad and Tobago" ;} 
 if ($this->id_country == "TN") { $id_country_look .= "Tunisia" ;} 
 if ($this->id_country == "TR") { $id_country_look .= "Turkey" ;} 
 if ($this->id_country == "TM") { $id_country_look .= "Turkmenistan" ;} 
 if ($this->id_country == "TC") { $id_country_look .= "Turks and Caicos Islands" ;} 
 if ($this->id_country == "TV") { $id_country_look .= "Tuvalu" ;} 
 if ($this->id_country == "UG") { $id_country_look .= "Uganda" ;} 
 if ($this->id_country == "UA") { $id_country_look .= "Ukraine" ;} 
 if ($this->id_country == "AE") { $id_country_look .= "United Arab Emirates" ;} 
 if ($this->id_country == "GB") { $id_country_look .= "United Kingdom" ;} 
 if ($this->id_country == "US") { $id_country_look .= "United States" ;} 
 if ($this->id_country == "UM") { $id_country_look .= "United States Minor Outlying Islands" ;} 
 if ($this->id_country == "UY") { $id_country_look .= "Uruguay" ;} 
 if ($this->id_country == "UZ") { $id_country_look .= "Uzbekistan" ;} 
 if ($this->id_country == "VU") { $id_country_look .= "Vanuatu" ;} 
 if ($this->id_country == "VA") { $id_country_look .= "Vatican City State (Holy See)" ;} 
 if ($this->id_country == "VE") { $id_country_look .= "Venezuela" ;} 
 if ($this->id_country == "VN") { $id_country_look .= "Viet Nam" ;} 
 if ($this->id_country == "VG") { $id_country_look .= "Virgin Islands (British)" ;} 
 if ($this->id_country == "VI") { $id_country_look .= "Virgin Islands (U.S.)" ;} 
 if ($this->id_country == "WF") { $id_country_look .= "Wallis and Futuna Islands" ;} 
 if ($this->id_country == "EH") { $id_country_look .= "Western Sahara" ;} 
 if ($this->id_country == "YE") { $id_country_look .= "Yemen" ;} 
 if ($this->id_country == "YU") { $id_country_look .= "Yugoslavia" ;} 
 if ($this->id_country == "ZR") { $id_country_look .= "Zaire" ;} 
 if ($this->id_country == "ZM") { $id_country_look .= "Zambia" ;} 
 if ($this->id_country == "ZW") { $id_country_look .= "Zimbabwe" ;} 
 if (empty($id_country_look)) { $id_country_look = $this->id_country; }
?>
<input type="hidden" name="id_country" value="<?php echo $this->form_encode_input($id_country) . "\">" . $id_country_look . ""; ?>
<?php } else { ?>
<?php

$id_country_look = "";
 if ($this->id_country == "AF") { $id_country_look .= "Afghanistan" ;} 
 if ($this->id_country == "AL") { $id_country_look .= "Albania" ;} 
 if ($this->id_country == "DZ") { $id_country_look .= "Algeria" ;} 
 if ($this->id_country == "AS") { $id_country_look .= "American Samoa" ;} 
 if ($this->id_country == "AD") { $id_country_look .= "Andorra" ;} 
 if ($this->id_country == "AO") { $id_country_look .= "Angola" ;} 
 if ($this->id_country == "AI") { $id_country_look .= "Anguilla" ;} 
 if ($this->id_country == "AQ") { $id_country_look .= "Antarctica" ;} 
 if ($this->id_country == "AG") { $id_country_look .= "Antigua and Barbuda" ;} 
 if ($this->id_country == "AR") { $id_country_look .= "Argentina" ;} 
 if ($this->id_country == "AM") { $id_country_look .= "Armenia" ;} 
 if ($this->id_country == "AW") { $id_country_look .= "Aruba" ;} 
 if ($this->id_country == "AU") { $id_country_look .= "Australia" ;} 
 if ($this->id_country == "AT") { $id_country_look .= "Austria" ;} 
 if ($this->id_country == "AZ") { $id_country_look .= "Azerbaijan" ;} 
 if ($this->id_country == "BS") { $id_country_look .= "Bahamas" ;} 
 if ($this->id_country == "BH") { $id_country_look .= "Bahrain" ;} 
 if ($this->id_country == "BD") { $id_country_look .= "Bangladesh" ;} 
 if ($this->id_country == "BB") { $id_country_look .= "Barbados" ;} 
 if ($this->id_country == "BY") { $id_country_look .= "Belarus" ;} 
 if ($this->id_country == "BE") { $id_country_look .= "Belgium" ;} 
 if ($this->id_country == "BZ") { $id_country_look .= "Belize" ;} 
 if ($this->id_country == "BJ") { $id_country_look .= "Benin" ;} 
 if ($this->id_country == "BM") { $id_country_look .= "Bermuda" ;} 
 if ($this->id_country == "BT") { $id_country_look .= "Bhutan" ;} 
 if ($this->id_country == "BO") { $id_country_look .= "Bolivia" ;} 
 if ($this->id_country == "BA") { $id_country_look .= "Bosnia and Herzegovina" ;} 
 if ($this->id_country == "BW") { $id_country_look .= "Botswana" ;} 
 if ($this->id_country == "BV") { $id_country_look .= "Bouvet Island" ;} 
 if ($this->id_country == "BR") { $id_country_look .= "Brasil" ;} 
 if ($this->id_country == "IO") { $id_country_look .= "British Indian Ocean Territory" ;} 
 if ($this->id_country == "BN") { $id_country_look .= "Brunei Darussalam" ;} 
 if ($this->id_country == "BG") { $id_country_look .= "Bulgaria" ;} 
 if ($this->id_country == "BF") { $id_country_look .= "Burkina Faso" ;} 
 if ($this->id_country == "BI") { $id_country_look .= "Burundi" ;} 
 if ($this->id_country == "KH") { $id_country_look .= "Cambodia" ;} 
 if ($this->id_country == "CM") { $id_country_look .= "Cameroon" ;} 
 if ($this->id_country == "CA") { $id_country_look .= "Canada" ;} 
 if ($this->id_country == "CV") { $id_country_look .= "Cape Verde" ;} 
 if ($this->id_country == "KY") { $id_country_look .= "Cayman Islands" ;} 
 if ($this->id_country == "CF") { $id_country_look .= "Central African Republic" ;} 
 if ($this->id_country == "TD") { $id_country_look .= "Chad" ;} 
 if ($this->id_country == "CL") { $id_country_look .= "Chile" ;} 
 if ($this->id_country == "CN") { $id_country_look .= "China" ;} 
 if ($this->id_country == "CX") { $id_country_look .= "Christmas Island" ;} 
 if ($this->id_country == "CC") { $id_country_look .= "Cocos (Keeling) Islands" ;} 
 if ($this->id_country == "CO") { $id_country_look .= "Colombia" ;} 
 if ($this->id_country == "KM") { $id_country_look .= "Comoros" ;} 
 if ($this->id_country == "CG") { $id_country_look .= "Congo" ;} 
 if ($this->id_country == "CK") { $id_country_look .= "Cook Islands" ;} 
 if ($this->id_country == "CR") { $id_country_look .= "Costa Rica" ;} 
 if ($this->id_country == "CI") { $id_country_look .= "Cote d Ivoire" ;} 
 if ($this->id_country == "HR") { $id_country_look .= "Croatia" ;} 
 if ($this->id_country == "CU") { $id_country_look .= "Cuba" ;} 
 if ($this->id_country == "CY") { $id_country_look .= "Cyprus" ;} 
 if ($this->id_country == "CZ") { $id_country_look .= "Czech Republic" ;} 
 if ($this->id_country == "DK") { $id_country_look .= "Denmark" ;} 
 if ($this->id_country == "DJ") { $id_country_look .= "Djibouti" ;} 
 if ($this->id_country == "DM") { $id_country_look .= "Dominica" ;} 
 if ($this->id_country == "DO") { $id_country_look .= "Dominican Republic" ;} 
 if ($this->id_country == "TP") { $id_country_look .= "East Timor" ;} 
 if ($this->id_country == "EC") { $id_country_look .= "Ecuador" ;} 
 if ($this->id_country == "EG") { $id_country_look .= "Egypt" ;} 
 if ($this->id_country == "SV") { $id_country_look .= "El Salvador" ;} 
 if ($this->id_country == "GQ") { $id_country_look .= "Equatorial Guinea" ;} 
 if ($this->id_country == "ER") { $id_country_look .= "Eritrea" ;} 
 if ($this->id_country == "EE") { $id_country_look .= "Estonia" ;} 
 if ($this->id_country == "ET") { $id_country_look .= "Ethiopia" ;} 
 if ($this->id_country == "FK") { $id_country_look .= "Falkland Islands (Malvinas)" ;} 
 if ($this->id_country == "FO") { $id_country_look .= "Faroe Islands" ;} 
 if ($this->id_country == "FJ") { $id_country_look .= "Fiji" ;} 
 if ($this->id_country == "FI") { $id_country_look .= "Finland" ;} 
 if ($this->id_country == "FR") { $id_country_look .= "France" ;} 
 if ($this->id_country == "FX") { $id_country_look .= "France Metropolitan" ;} 
 if ($this->id_country == "GF") { $id_country_look .= "French Guiana" ;} 
 if ($this->id_country == "PF") { $id_country_look .= "French Polynesia" ;} 
 if ($this->id_country == "TF") { $id_country_look .= "French Southern Territories" ;} 
 if ($this->id_country == "GA") { $id_country_look .= "Gabon" ;} 
 if ($this->id_country == "GM") { $id_country_look .= "Gambia" ;} 
 if ($this->id_country == "GE") { $id_country_look .= "Georgia" ;} 
 if ($this->id_country == "DE") { $id_country_look .= "Germany" ;} 
 if ($this->id_country == "GH") { $id_country_look .= "Ghana" ;} 
 if ($this->id_country == "GI") { $id_country_look .= "Gibraltar" ;} 
 if ($this->id_country == "GR") { $id_country_look .= "Greece" ;} 
 if ($this->id_country == "GL") { $id_country_look .= "Greenland" ;} 
 if ($this->id_country == "GD") { $id_country_look .= "Grenada" ;} 
 if ($this->id_country == "GP") { $id_country_look .= "Guadeloupe" ;} 
 if ($this->id_country == "GU") { $id_country_look .= "Guam" ;} 
 if ($this->id_country == "GT") { $id_country_look .= "Guatemala" ;} 
 if ($this->id_country == "GN") { $id_country_look .= "Guinea" ;} 
 if ($this->id_country == "GW") { $id_country_look .= "Guinea-Bissau" ;} 
 if ($this->id_country == "GY") { $id_country_look .= "Guyana" ;} 
 if ($this->id_country == "HT") { $id_country_look .= "Haiti" ;} 
 if ($this->id_country == "HM") { $id_country_look .= "Heard Island and McDonald Islands" ;} 
 if ($this->id_country == "HN") { $id_country_look .= "Honduras" ;} 
 if ($this->id_country == "HK") { $id_country_look .= "Hong Kong" ;} 
 if ($this->id_country == "HU") { $id_country_look .= "Hungary" ;} 
 if ($this->id_country == "IS") { $id_country_look .= "Iceland" ;} 
 if ($this->id_country == "IN") { $id_country_look .= "India" ;} 
 if ($this->id_country == "ID") { $id_country_look .= "Indonesia" ;} 
 if ($this->id_country == "IR") { $id_country_look .= "Iran (Islamic Republic of)" ;} 
 if ($this->id_country == "IQ") { $id_country_look .= "Iraq" ;} 
 if ($this->id_country == "IE") { $id_country_look .= "Ireland" ;} 
 if ($this->id_country == "IL") { $id_country_look .= "Israel" ;} 
 if ($this->id_country == "IT") { $id_country_look .= "Italy" ;} 
 if ($this->id_country == "JM") { $id_country_look .= "Jamaica" ;} 
 if ($this->id_country == "JP") { $id_country_look .= "Japan" ;} 
 if ($this->id_country == "JO") { $id_country_look .= "Jordan" ;} 
 if ($this->id_country == "KZ") { $id_country_look .= "Kazakhstan" ;} 
 if ($this->id_country == "KE") { $id_country_look .= "Kenya" ;} 
 if ($this->id_country == "KI") { $id_country_look .= "Kiribati" ;} 
 if ($this->id_country == "KP") { $id_country_look .= "Korea Democratic People Republic of" ;} 
 if ($this->id_country == "KR") { $id_country_look .= "Korea Republic of" ;} 
 if ($this->id_country == "KW") { $id_country_look .= "Kuwait" ;} 
 if ($this->id_country == "KG") { $id_country_look .= "Kyrgyzstan" ;} 
 if ($this->id_country == "LA") { $id_country_look .= "Lao People Democratic Republic" ;} 
 if ($this->id_country == "LT") { $id_country_look .= "Latin America" ;} 
 if ($this->id_country == "LV") { $id_country_look .= "Latvia" ;} 
 if ($this->id_country == "LB") { $id_country_look .= "Lebanon" ;} 
 if ($this->id_country == "LS") { $id_country_look .= "Lesotho" ;} 
 if ($this->id_country == "LR") { $id_country_look .= "Liberia" ;} 
 if ($this->id_country == "LY") { $id_country_look .= "Libyan Arab Jamahiriya" ;} 
 if ($this->id_country == "LI") { $id_country_look .= "Liechtenstein" ;} 
 if ($this->id_country == "LX") { $id_country_look .= "Lithuania" ;} 
 if ($this->id_country == "LU") { $id_country_look .= "Luxembourg" ;} 
 if ($this->id_country == "MO") { $id_country_look .= "Macau" ;} 
 if ($this->id_country == "MK") { $id_country_look .= "Macedonia" ;} 
 if ($this->id_country == "MG") { $id_country_look .= "Madagascar" ;} 
 if ($this->id_country == "MW") { $id_country_look .= "Malawi" ;} 
 if ($this->id_country == "MY") { $id_country_look .= "Malaysia" ;} 
 if ($this->id_country == "MV") { $id_country_look .= "Maldives" ;} 
 if ($this->id_country == "ML") { $id_country_look .= "Mali" ;} 
 if ($this->id_country == "MT") { $id_country_look .= "Malta" ;} 
 if ($this->id_country == "MH") { $id_country_look .= "Marshall Islands" ;} 
 if ($this->id_country == "MQ") { $id_country_look .= "Martinique" ;} 
 if ($this->id_country == "MR") { $id_country_look .= "Mauritania" ;} 
 if ($this->id_country == "MU") { $id_country_look .= "Mauritius" ;} 
 if ($this->id_country == "YT") { $id_country_look .= "Mayotte" ;} 
 if ($this->id_country == "MX") { $id_country_look .= "Mexico" ;} 
 if ($this->id_country == "FM") { $id_country_look .= "Micronesia (Federated States of)" ;} 
 if ($this->id_country == "MD") { $id_country_look .= "Moldova Republic of" ;} 
 if ($this->id_country == "MC") { $id_country_look .= "Monaco" ;} 
 if ($this->id_country == "MN") { $id_country_look .= "Mongolia" ;} 
 if ($this->id_country == "MS") { $id_country_look .= "Montserrat" ;} 
 if ($this->id_country == "MA") { $id_country_look .= "Morocco" ;} 
 if ($this->id_country == "MZ") { $id_country_look .= "Mozambique" ;} 
 if ($this->id_country == "MM") { $id_country_look .= "Myanmar" ;} 
 if ($this->id_country == "NA") { $id_country_look .= "Namibia" ;} 
 if ($this->id_country == "NR") { $id_country_look .= "Nauru" ;} 
 if ($this->id_country == "NP") { $id_country_look .= "Nepal" ;} 
 if ($this->id_country == "NL") { $id_country_look .= "Netherlands" ;} 
 if ($this->id_country == "AN") { $id_country_look .= "Netherlands Antilles" ;} 
 if ($this->id_country == "NC") { $id_country_look .= "New Caledonia" ;} 
 if ($this->id_country == "NZ") { $id_country_look .= "New Zealand" ;} 
 if ($this->id_country == "NI") { $id_country_look .= "Nicaragua" ;} 
 if ($this->id_country == "NE") { $id_country_look .= "Niger" ;} 
 if ($this->id_country == "NG") { $id_country_look .= "Nigeria" ;} 
 if ($this->id_country == "NU") { $id_country_look .= "Niue" ;} 
 if ($this->id_country == "NF") { $id_country_look .= "Norfolk Island" ;} 
 if ($this->id_country == "MP") { $id_country_look .= "Northern Mariana Islands" ;} 
 if ($this->id_country == "NO") { $id_country_look .= "Norway" ;} 
 if ($this->id_country == "OM") { $id_country_look .= "Oman" ;} 
 if ($this->id_country == "PK") { $id_country_look .= "Pakistan" ;} 
 if ($this->id_country == "PW") { $id_country_look .= "Palau" ;} 
 if ($this->id_country == "PA") { $id_country_look .= "Panama" ;} 
 if ($this->id_country == "PG") { $id_country_look .= "Papua New Guinea" ;} 
 if ($this->id_country == "PY") { $id_country_look .= "Paraguay" ;} 
 if ($this->id_country == "PE") { $id_country_look .= "Peru" ;} 
 if ($this->id_country == "PH") { $id_country_look .= "Philippines" ;} 
 if ($this->id_country == "PN") { $id_country_look .= "Pitcairn" ;} 
 if ($this->id_country == "PL") { $id_country_look .= "Poland" ;} 
 if ($this->id_country == "PT") { $id_country_look .= "Portugal" ;} 
 if ($this->id_country == "PR") { $id_country_look .= "Puerto Rico" ;} 
 if ($this->id_country == "QA") { $id_country_look .= "Qatar" ;} 
 if ($this->id_country == "RE") { $id_country_look .= "Reunion" ;} 
 if ($this->id_country == "RO") { $id_country_look .= "Romania" ;} 
 if ($this->id_country == "RU") { $id_country_look .= "Russian Federation" ;} 
 if ($this->id_country == "RW") { $id_country_look .= "Rwanda" ;} 
 if ($this->id_country == "SH") { $id_country_look .= "Saint Helena" ;} 
 if ($this->id_country == "KN") { $id_country_look .= "Saint Kitts and Nevis" ;} 
 if ($this->id_country == "LC") { $id_country_look .= "Saint Lucia" ;} 
 if ($this->id_country == "PM") { $id_country_look .= "Saint Pierre and Miquelon" ;} 
 if ($this->id_country == "VC") { $id_country_look .= "Saint Vincent and the Grenadines" ;} 
 if ($this->id_country == "WS") { $id_country_look .= "Samoa" ;} 
 if ($this->id_country == "SM") { $id_country_look .= "San Marino" ;} 
 if ($this->id_country == "ST") { $id_country_look .= "Sao Tome and Principe" ;} 
 if ($this->id_country == "SA") { $id_country_look .= "Saudi Arabia" ;} 
 if ($this->id_country == "SN") { $id_country_look .= "Senegal" ;} 
 if ($this->id_country == "SC") { $id_country_look .= "Seychelles" ;} 
 if ($this->id_country == "SL") { $id_country_look .= "Sierra Leone" ;} 
 if ($this->id_country == "SG") { $id_country_look .= "Singapore" ;} 
 if ($this->id_country == "SK") { $id_country_look .= "Slovakia" ;} 
 if ($this->id_country == "SI") { $id_country_look .= "Slovenia" ;} 
 if ($this->id_country == "SB") { $id_country_look .= "Solomon Islands" ;} 
 if ($this->id_country == "SO") { $id_country_look .= "Somalia" ;} 
 if ($this->id_country == "ZA") { $id_country_look .= "South Africa" ;} 
 if ($this->id_country == "GS") { $id_country_look .= "South Georgia and the South Sandwich" ;} 
 if ($this->id_country == "ES") { $id_country_look .= "Spain" ;} 
 if ($this->id_country == "LK") { $id_country_look .= "Sri Lanka" ;} 
 if ($this->id_country == "SD") { $id_country_look .= "Sudan" ;} 
 if ($this->id_country == "SR") { $id_country_look .= "Suriname" ;} 
 if ($this->id_country == "SJ") { $id_country_look .= "Svalbard and Jan Mayen Islands" ;} 
 if ($this->id_country == "SZ") { $id_country_look .= "Swaziland" ;} 
 if ($this->id_country == "SE") { $id_country_look .= "Sweden" ;} 
 if ($this->id_country == "CH") { $id_country_look .= "Switzerland" ;} 
 if ($this->id_country == "SY") { $id_country_look .= "Syrian Arab Republic" ;} 
 if ($this->id_country == "TW") { $id_country_look .= "Taiwan Republic of China" ;} 
 if ($this->id_country == "TJ") { $id_country_look .= "Tajikistan" ;} 
 if ($this->id_country == "TZ") { $id_country_look .= "Tanzania United Republic of" ;} 
 if ($this->id_country == "TH") { $id_country_look .= "Thailand" ;} 
 if ($this->id_country == "TG") { $id_country_look .= "Togo" ;} 
 if ($this->id_country == "TK") { $id_country_look .= "Tokelau" ;} 
 if ($this->id_country == "TO") { $id_country_look .= "Tonga" ;} 
 if ($this->id_country == "TT") { $id_country_look .= "Trinidad and Tobago" ;} 
 if ($this->id_country == "TN") { $id_country_look .= "Tunisia" ;} 
 if ($this->id_country == "TR") { $id_country_look .= "Turkey" ;} 
 if ($this->id_country == "TM") { $id_country_look .= "Turkmenistan" ;} 
 if ($this->id_country == "TC") { $id_country_look .= "Turks and Caicos Islands" ;} 
 if ($this->id_country == "TV") { $id_country_look .= "Tuvalu" ;} 
 if ($this->id_country == "UG") { $id_country_look .= "Uganda" ;} 
 if ($this->id_country == "UA") { $id_country_look .= "Ukraine" ;} 
 if ($this->id_country == "AE") { $id_country_look .= "United Arab Emirates" ;} 
 if ($this->id_country == "GB") { $id_country_look .= "United Kingdom" ;} 
 if ($this->id_country == "US") { $id_country_look .= "United States" ;} 
 if ($this->id_country == "UM") { $id_country_look .= "United States Minor Outlying Islands" ;} 
 if ($this->id_country == "UY") { $id_country_look .= "Uruguay" ;} 
 if ($this->id_country == "UZ") { $id_country_look .= "Uzbekistan" ;} 
 if ($this->id_country == "VU") { $id_country_look .= "Vanuatu" ;} 
 if ($this->id_country == "VA") { $id_country_look .= "Vatican City State (Holy See)" ;} 
 if ($this->id_country == "VE") { $id_country_look .= "Venezuela" ;} 
 if ($this->id_country == "VN") { $id_country_look .= "Viet Nam" ;} 
 if ($this->id_country == "VG") { $id_country_look .= "Virgin Islands (British)" ;} 
 if ($this->id_country == "VI") { $id_country_look .= "Virgin Islands (U.S.)" ;} 
 if ($this->id_country == "WF") { $id_country_look .= "Wallis and Futuna Islands" ;} 
 if ($this->id_country == "EH") { $id_country_look .= "Western Sahara" ;} 
 if ($this->id_country == "YE") { $id_country_look .= "Yemen" ;} 
 if ($this->id_country == "YU") { $id_country_look .= "Yugoslavia" ;} 
 if ($this->id_country == "ZR") { $id_country_look .= "Zaire" ;} 
 if ($this->id_country == "ZM") { $id_country_look .= "Zambia" ;} 
 if ($this->id_country == "ZW") { $id_country_look .= "Zimbabwe" ;} 
 if (empty($id_country_look)) { $id_country_look = $this->id_country; }
?>
<span id="id_read_on_id_country" class="css_id_country_line"  style="<?php echo $sStyleReadLab_id_country; ?>"><?php echo $this->form_format_readonly("id_country", $this->form_encode_input($id_country_look)); ?></span><span id="id_read_off_id_country" class="css_read_off_id_country<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_id_country; ?>">
 <span id="idAjaxSelect_id_country" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_id_country_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_id_country" name="id_country" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="AF" <?php  if ($this->id_country == "AF") { echo " selected" ;} ?>>Afghanistan</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AF'; ?>
 <option  value="AL" <?php  if ($this->id_country == "AL") { echo " selected" ;} ?>>Albania</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AL'; ?>
 <option  value="DZ" <?php  if ($this->id_country == "DZ") { echo " selected" ;} ?>>Algeria</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'DZ'; ?>
 <option  value="AS" <?php  if ($this->id_country == "AS") { echo " selected" ;} ?>>American Samoa</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AS'; ?>
 <option  value="AD" <?php  if ($this->id_country == "AD") { echo " selected" ;} ?>>Andorra</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AD'; ?>
 <option  value="AO" <?php  if ($this->id_country == "AO") { echo " selected" ;} ?>>Angola</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AO'; ?>
 <option  value="AI" <?php  if ($this->id_country == "AI") { echo " selected" ;} ?>>Anguilla</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AI'; ?>
 <option  value="AQ" <?php  if ($this->id_country == "AQ") { echo " selected" ;} ?>>Antarctica</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AQ'; ?>
 <option  value="AG" <?php  if ($this->id_country == "AG") { echo " selected" ;} ?>>Antigua and Barbuda</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AG'; ?>
 <option  value="AR" <?php  if ($this->id_country == "AR") { echo " selected" ;} ?>>Argentina</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AR'; ?>
 <option  value="AM" <?php  if ($this->id_country == "AM") { echo " selected" ;} ?>>Armenia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AM'; ?>
 <option  value="AW" <?php  if ($this->id_country == "AW") { echo " selected" ;} ?>>Aruba</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AW'; ?>
 <option  value="AU" <?php  if ($this->id_country == "AU") { echo " selected" ;} ?>>Australia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AU'; ?>
 <option  value="AT" <?php  if ($this->id_country == "AT") { echo " selected" ;} ?>>Austria</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AT'; ?>
 <option  value="AZ" <?php  if ($this->id_country == "AZ") { echo " selected" ;} ?>>Azerbaijan</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AZ'; ?>
 <option  value="BS" <?php  if ($this->id_country == "BS") { echo " selected" ;} ?>>Bahamas</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BS'; ?>
 <option  value="BH" <?php  if ($this->id_country == "BH") { echo " selected" ;} ?>>Bahrain</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BH'; ?>
 <option  value="BD" <?php  if ($this->id_country == "BD") { echo " selected" ;} ?>>Bangladesh</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BD'; ?>
 <option  value="BB" <?php  if ($this->id_country == "BB") { echo " selected" ;} ?>>Barbados</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BB'; ?>
 <option  value="BY" <?php  if ($this->id_country == "BY") { echo " selected" ;} ?>>Belarus</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BY'; ?>
 <option  value="BE" <?php  if ($this->id_country == "BE") { echo " selected" ;} ?>>Belgium</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BE'; ?>
 <option  value="BZ" <?php  if ($this->id_country == "BZ") { echo " selected" ;} ?>>Belize</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BZ'; ?>
 <option  value="BJ" <?php  if ($this->id_country == "BJ") { echo " selected" ;} ?>>Benin</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BJ'; ?>
 <option  value="BM" <?php  if ($this->id_country == "BM") { echo " selected" ;} ?>>Bermuda</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BM'; ?>
 <option  value="BT" <?php  if ($this->id_country == "BT") { echo " selected" ;} ?>>Bhutan</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BT'; ?>
 <option  value="BO" <?php  if ($this->id_country == "BO") { echo " selected" ;} ?>>Bolivia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BO'; ?>
 <option  value="BA" <?php  if ($this->id_country == "BA") { echo " selected" ;} ?>>Bosnia and Herzegovina</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BA'; ?>
 <option  value="BW" <?php  if ($this->id_country == "BW") { echo " selected" ;} ?>>Botswana</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BW'; ?>
 <option  value="BV" <?php  if ($this->id_country == "BV") { echo " selected" ;} ?>>Bouvet Island</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BV'; ?>
 <option  value="BR" <?php  if ($this->id_country == "BR") { echo " selected" ;} ?><?php  if (empty($this->id_country)) { echo " selected" ;} ?>>Brasil</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BR'; ?>
 <option  value="IO" <?php  if ($this->id_country == "IO") { echo " selected" ;} ?>>British Indian Ocean Territory</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IO'; ?>
 <option  value="BN" <?php  if ($this->id_country == "BN") { echo " selected" ;} ?>>Brunei Darussalam</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BN'; ?>
 <option  value="BG" <?php  if ($this->id_country == "BG") { echo " selected" ;} ?>>Bulgaria</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BG'; ?>
 <option  value="BF" <?php  if ($this->id_country == "BF") { echo " selected" ;} ?>>Burkina Faso</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BF'; ?>
 <option  value="BI" <?php  if ($this->id_country == "BI") { echo " selected" ;} ?>>Burundi</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'BI'; ?>
 <option  value="KH" <?php  if ($this->id_country == "KH") { echo " selected" ;} ?>>Cambodia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KH'; ?>
 <option  value="CM" <?php  if ($this->id_country == "CM") { echo " selected" ;} ?>>Cameroon</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CM'; ?>
 <option  value="CA" <?php  if ($this->id_country == "CA") { echo " selected" ;} ?>>Canada</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CA'; ?>
 <option  value="CV" <?php  if ($this->id_country == "CV") { echo " selected" ;} ?>>Cape Verde</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CV'; ?>
 <option  value="KY" <?php  if ($this->id_country == "KY") { echo " selected" ;} ?>>Cayman Islands</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KY'; ?>
 <option  value="CF" <?php  if ($this->id_country == "CF") { echo " selected" ;} ?>>Central African Republic</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CF'; ?>
 <option  value="TD" <?php  if ($this->id_country == "TD") { echo " selected" ;} ?>>Chad</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TD'; ?>
 <option  value="CL" <?php  if ($this->id_country == "CL") { echo " selected" ;} ?>>Chile</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CL'; ?>
 <option  value="CN" <?php  if ($this->id_country == "CN") { echo " selected" ;} ?>>China</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CN'; ?>
 <option  value="CX" <?php  if ($this->id_country == "CX") { echo " selected" ;} ?>>Christmas Island</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CX'; ?>
 <option  value="CC" <?php  if ($this->id_country == "CC") { echo " selected" ;} ?>>Cocos (Keeling) Islands</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CC'; ?>
 <option  value="CO" <?php  if ($this->id_country == "CO") { echo " selected" ;} ?>>Colombia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CO'; ?>
 <option  value="KM" <?php  if ($this->id_country == "KM") { echo " selected" ;} ?>>Comoros</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KM'; ?>
 <option  value="CG" <?php  if ($this->id_country == "CG") { echo " selected" ;} ?>>Congo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CG'; ?>
 <option  value="CK" <?php  if ($this->id_country == "CK") { echo " selected" ;} ?>>Cook Islands</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CK'; ?>
 <option  value="CR" <?php  if ($this->id_country == "CR") { echo " selected" ;} ?>>Costa Rica</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CR'; ?>
 <option  value="CI" <?php  if ($this->id_country == "CI") { echo " selected" ;} ?>>Cote d Ivoire</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CI'; ?>
 <option  value="HR" <?php  if ($this->id_country == "HR") { echo " selected" ;} ?>>Croatia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'HR'; ?>
 <option  value="CU" <?php  if ($this->id_country == "CU") { echo " selected" ;} ?>>Cuba</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CU'; ?>
 <option  value="CY" <?php  if ($this->id_country == "CY") { echo " selected" ;} ?>>Cyprus</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CY'; ?>
 <option  value="CZ" <?php  if ($this->id_country == "CZ") { echo " selected" ;} ?>>Czech Republic</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CZ'; ?>
 <option  value="DK" <?php  if ($this->id_country == "DK") { echo " selected" ;} ?>>Denmark</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'DK'; ?>
 <option  value="DJ" <?php  if ($this->id_country == "DJ") { echo " selected" ;} ?>>Djibouti</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'DJ'; ?>
 <option  value="DM" <?php  if ($this->id_country == "DM") { echo " selected" ;} ?>>Dominica</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'DM'; ?>
 <option  value="DO" <?php  if ($this->id_country == "DO") { echo " selected" ;} ?>>Dominican Republic</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'DO'; ?>
 <option  value="TP" <?php  if ($this->id_country == "TP") { echo " selected" ;} ?>>East Timor</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TP'; ?>
 <option  value="EC" <?php  if ($this->id_country == "EC") { echo " selected" ;} ?>>Ecuador</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'EC'; ?>
 <option  value="EG" <?php  if ($this->id_country == "EG") { echo " selected" ;} ?>>Egypt</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'EG'; ?>
 <option  value="SV" <?php  if ($this->id_country == "SV") { echo " selected" ;} ?>>El Salvador</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SV'; ?>
 <option  value="GQ" <?php  if ($this->id_country == "GQ") { echo " selected" ;} ?>>Equatorial Guinea</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GQ'; ?>
 <option  value="ER" <?php  if ($this->id_country == "ER") { echo " selected" ;} ?>>Eritrea</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ER'; ?>
 <option  value="EE" <?php  if ($this->id_country == "EE") { echo " selected" ;} ?>>Estonia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'EE'; ?>
 <option  value="ET" <?php  if ($this->id_country == "ET") { echo " selected" ;} ?>>Ethiopia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ET'; ?>
 <option  value="FK" <?php  if ($this->id_country == "FK") { echo " selected" ;} ?>>Falkland Islands (Malvinas)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'FK'; ?>
 <option  value="FO" <?php  if ($this->id_country == "FO") { echo " selected" ;} ?>>Faroe Islands</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'FO'; ?>
 <option  value="FJ" <?php  if ($this->id_country == "FJ") { echo " selected" ;} ?>>Fiji</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'FJ'; ?>
 <option  value="FI" <?php  if ($this->id_country == "FI") { echo " selected" ;} ?>>Finland</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'FI'; ?>
 <option  value="FR" <?php  if ($this->id_country == "FR") { echo " selected" ;} ?>>France</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'FR'; ?>
 <option  value="FX" <?php  if ($this->id_country == "FX") { echo " selected" ;} ?>>France Metropolitan</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'FX'; ?>
 <option  value="GF" <?php  if ($this->id_country == "GF") { echo " selected" ;} ?>>French Guiana</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GF'; ?>
 <option  value="PF" <?php  if ($this->id_country == "PF") { echo " selected" ;} ?>>French Polynesia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PF'; ?>
 <option  value="TF" <?php  if ($this->id_country == "TF") { echo " selected" ;} ?>>French Southern Territories</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TF'; ?>
 <option  value="GA" <?php  if ($this->id_country == "GA") { echo " selected" ;} ?>>Gabon</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GA'; ?>
 <option  value="GM" <?php  if ($this->id_country == "GM") { echo " selected" ;} ?>>Gambia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GM'; ?>
 <option  value="GE" <?php  if ($this->id_country == "GE") { echo " selected" ;} ?>>Georgia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GE'; ?>
 <option  value="DE" <?php  if ($this->id_country == "DE") { echo " selected" ;} ?>>Germany</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'DE'; ?>
 <option  value="GH" <?php  if ($this->id_country == "GH") { echo " selected" ;} ?>>Ghana</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GH'; ?>
 <option  value="GI" <?php  if ($this->id_country == "GI") { echo " selected" ;} ?>>Gibraltar</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GI'; ?>
 <option  value="GR" <?php  if ($this->id_country == "GR") { echo " selected" ;} ?>>Greece</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GR'; ?>
 <option  value="GL" <?php  if ($this->id_country == "GL") { echo " selected" ;} ?>>Greenland</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GL'; ?>
 <option  value="GD" <?php  if ($this->id_country == "GD") { echo " selected" ;} ?>>Grenada</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GD'; ?>
 <option  value="GP" <?php  if ($this->id_country == "GP") { echo " selected" ;} ?>>Guadeloupe</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GP'; ?>
 <option  value="GU" <?php  if ($this->id_country == "GU") { echo " selected" ;} ?>>Guam</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GU'; ?>
 <option  value="GT" <?php  if ($this->id_country == "GT") { echo " selected" ;} ?>>Guatemala</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GT'; ?>
 <option  value="GN" <?php  if ($this->id_country == "GN") { echo " selected" ;} ?>>Guinea</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GN'; ?>
 <option  value="GW" <?php  if ($this->id_country == "GW") { echo " selected" ;} ?>>Guinea-Bissau</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GW'; ?>
 <option  value="GY" <?php  if ($this->id_country == "GY") { echo " selected" ;} ?>>Guyana</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GY'; ?>
 <option  value="HT" <?php  if ($this->id_country == "HT") { echo " selected" ;} ?>>Haiti</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'HT'; ?>
 <option  value="HM" <?php  if ($this->id_country == "HM") { echo " selected" ;} ?>>Heard Island and McDonald Islands</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'HM'; ?>
 <option  value="HN" <?php  if ($this->id_country == "HN") { echo " selected" ;} ?>>Honduras</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'HN'; ?>
 <option  value="HK" <?php  if ($this->id_country == "HK") { echo " selected" ;} ?>>Hong Kong</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'HK'; ?>
 <option  value="HU" <?php  if ($this->id_country == "HU") { echo " selected" ;} ?>>Hungary</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'HU'; ?>
 <option  value="IS" <?php  if ($this->id_country == "IS") { echo " selected" ;} ?>>Iceland</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IS'; ?>
 <option  value="IN" <?php  if ($this->id_country == "IN") { echo " selected" ;} ?>>India</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IN'; ?>
 <option  value="ID" <?php  if ($this->id_country == "ID") { echo " selected" ;} ?>>Indonesia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ID'; ?>
 <option  value="IR" <?php  if ($this->id_country == "IR") { echo " selected" ;} ?>>Iran (Islamic Republic of)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IR'; ?>
 <option  value="IQ" <?php  if ($this->id_country == "IQ") { echo " selected" ;} ?>>Iraq</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IQ'; ?>
 <option  value="IE" <?php  if ($this->id_country == "IE") { echo " selected" ;} ?>>Ireland</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IE'; ?>
 <option  value="IL" <?php  if ($this->id_country == "IL") { echo " selected" ;} ?>>Israel</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IL'; ?>
 <option  value="IT" <?php  if ($this->id_country == "IT") { echo " selected" ;} ?>>Italy</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'IT'; ?>
 <option  value="JM" <?php  if ($this->id_country == "JM") { echo " selected" ;} ?>>Jamaica</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'JM'; ?>
 <option  value="JP" <?php  if ($this->id_country == "JP") { echo " selected" ;} ?>>Japan</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'JP'; ?>
 <option  value="JO" <?php  if ($this->id_country == "JO") { echo " selected" ;} ?>>Jordan</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'JO'; ?>
 <option  value="KZ" <?php  if ($this->id_country == "KZ") { echo " selected" ;} ?>>Kazakhstan</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KZ'; ?>
 <option  value="KE" <?php  if ($this->id_country == "KE") { echo " selected" ;} ?>>Kenya</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KE'; ?>
 <option  value="KI" <?php  if ($this->id_country == "KI") { echo " selected" ;} ?>>Kiribati</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KI'; ?>
 <option  value="KP" <?php  if ($this->id_country == "KP") { echo " selected" ;} ?>>Korea Democratic People Republic of</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KP'; ?>
 <option  value="KR" <?php  if ($this->id_country == "KR") { echo " selected" ;} ?>>Korea Republic of</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KR'; ?>
 <option  value="KW" <?php  if ($this->id_country == "KW") { echo " selected" ;} ?>>Kuwait</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KW'; ?>
 <option  value="KG" <?php  if ($this->id_country == "KG") { echo " selected" ;} ?>>Kyrgyzstan</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KG'; ?>
 <option  value="LA" <?php  if ($this->id_country == "LA") { echo " selected" ;} ?>>Lao People Democratic Republic</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LA'; ?>
 <option  value="LT" <?php  if ($this->id_country == "LT") { echo " selected" ;} ?>>Latin America</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LT'; ?>
 <option  value="LV" <?php  if ($this->id_country == "LV") { echo " selected" ;} ?>>Latvia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LV'; ?>
 <option  value="LB" <?php  if ($this->id_country == "LB") { echo " selected" ;} ?>>Lebanon</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LB'; ?>
 <option  value="LS" <?php  if ($this->id_country == "LS") { echo " selected" ;} ?>>Lesotho</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LS'; ?>
 <option  value="LR" <?php  if ($this->id_country == "LR") { echo " selected" ;} ?>>Liberia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LR'; ?>
 <option  value="LY" <?php  if ($this->id_country == "LY") { echo " selected" ;} ?>>Libyan Arab Jamahiriya</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LY'; ?>
 <option  value="LI" <?php  if ($this->id_country == "LI") { echo " selected" ;} ?>>Liechtenstein</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LI'; ?>
 <option  value="LX" <?php  if ($this->id_country == "LX") { echo " selected" ;} ?>>Lithuania</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LX'; ?>
 <option  value="LU" <?php  if ($this->id_country == "LU") { echo " selected" ;} ?>>Luxembourg</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LU'; ?>
 <option  value="MO" <?php  if ($this->id_country == "MO") { echo " selected" ;} ?>>Macau</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MO'; ?>
 <option  value="MK" <?php  if ($this->id_country == "MK") { echo " selected" ;} ?>>Macedonia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MK'; ?>
 <option  value="MG" <?php  if ($this->id_country == "MG") { echo " selected" ;} ?>>Madagascar</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MG'; ?>
 <option  value="MW" <?php  if ($this->id_country == "MW") { echo " selected" ;} ?>>Malawi</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MW'; ?>
 <option  value="MY" <?php  if ($this->id_country == "MY") { echo " selected" ;} ?>>Malaysia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MY'; ?>
 <option  value="MV" <?php  if ($this->id_country == "MV") { echo " selected" ;} ?>>Maldives</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MV'; ?>
 <option  value="ML" <?php  if ($this->id_country == "ML") { echo " selected" ;} ?>>Mali</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ML'; ?>
 <option  value="MT" <?php  if ($this->id_country == "MT") { echo " selected" ;} ?>>Malta</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MT'; ?>
 <option  value="MH" <?php  if ($this->id_country == "MH") { echo " selected" ;} ?>>Marshall Islands</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MH'; ?>
 <option  value="MQ" <?php  if ($this->id_country == "MQ") { echo " selected" ;} ?>>Martinique</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MQ'; ?>
 <option  value="MR" <?php  if ($this->id_country == "MR") { echo " selected" ;} ?>>Mauritania</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MR'; ?>
 <option  value="MU" <?php  if ($this->id_country == "MU") { echo " selected" ;} ?>>Mauritius</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MU'; ?>
 <option  value="YT" <?php  if ($this->id_country == "YT") { echo " selected" ;} ?>>Mayotte</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'YT'; ?>
 <option  value="MX" <?php  if ($this->id_country == "MX") { echo " selected" ;} ?>>Mexico</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MX'; ?>
 <option  value="FM" <?php  if ($this->id_country == "FM") { echo " selected" ;} ?>>Micronesia (Federated States of)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'FM'; ?>
 <option  value="MD" <?php  if ($this->id_country == "MD") { echo " selected" ;} ?>>Moldova Republic of</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MD'; ?>
 <option  value="MC" <?php  if ($this->id_country == "MC") { echo " selected" ;} ?>>Monaco</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MC'; ?>
 <option  value="MN" <?php  if ($this->id_country == "MN") { echo " selected" ;} ?>>Mongolia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MN'; ?>
 <option  value="MS" <?php  if ($this->id_country == "MS") { echo " selected" ;} ?>>Montserrat</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MS'; ?>
 <option  value="MA" <?php  if ($this->id_country == "MA") { echo " selected" ;} ?>>Morocco</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MA'; ?>
 <option  value="MZ" <?php  if ($this->id_country == "MZ") { echo " selected" ;} ?>>Mozambique</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MZ'; ?>
 <option  value="MM" <?php  if ($this->id_country == "MM") { echo " selected" ;} ?>>Myanmar</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MM'; ?>
 <option  value="NA" <?php  if ($this->id_country == "NA") { echo " selected" ;} ?>>Namibia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NA'; ?>
 <option  value="NR" <?php  if ($this->id_country == "NR") { echo " selected" ;} ?>>Nauru</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NR'; ?>
 <option  value="NP" <?php  if ($this->id_country == "NP") { echo " selected" ;} ?>>Nepal</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NP'; ?>
 <option  value="NL" <?php  if ($this->id_country == "NL") { echo " selected" ;} ?>>Netherlands</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NL'; ?>
 <option  value="AN" <?php  if ($this->id_country == "AN") { echo " selected" ;} ?>>Netherlands Antilles</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AN'; ?>
 <option  value="NC" <?php  if ($this->id_country == "NC") { echo " selected" ;} ?>>New Caledonia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NC'; ?>
 <option  value="NZ" <?php  if ($this->id_country == "NZ") { echo " selected" ;} ?>>New Zealand</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NZ'; ?>
 <option  value="NI" <?php  if ($this->id_country == "NI") { echo " selected" ;} ?>>Nicaragua</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NI'; ?>
 <option  value="NE" <?php  if ($this->id_country == "NE") { echo " selected" ;} ?>>Niger</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NE'; ?>
 <option  value="NG" <?php  if ($this->id_country == "NG") { echo " selected" ;} ?>>Nigeria</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NG'; ?>
 <option  value="NU" <?php  if ($this->id_country == "NU") { echo " selected" ;} ?>>Niue</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NU'; ?>
 <option  value="NF" <?php  if ($this->id_country == "NF") { echo " selected" ;} ?>>Norfolk Island</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NF'; ?>
 <option  value="MP" <?php  if ($this->id_country == "MP") { echo " selected" ;} ?>>Northern Mariana Islands</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'MP'; ?>
 <option  value="NO" <?php  if ($this->id_country == "NO") { echo " selected" ;} ?>>Norway</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'NO'; ?>
 <option  value="OM" <?php  if ($this->id_country == "OM") { echo " selected" ;} ?>>Oman</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'OM'; ?>
 <option  value="PK" <?php  if ($this->id_country == "PK") { echo " selected" ;} ?>>Pakistan</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PK'; ?>
 <option  value="PW" <?php  if ($this->id_country == "PW") { echo " selected" ;} ?>>Palau</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PW'; ?>
 <option  value="PA" <?php  if ($this->id_country == "PA") { echo " selected" ;} ?>>Panama</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PA'; ?>
 <option  value="PG" <?php  if ($this->id_country == "PG") { echo " selected" ;} ?>>Papua New Guinea</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PG'; ?>
 <option  value="PY" <?php  if ($this->id_country == "PY") { echo " selected" ;} ?>>Paraguay</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PY'; ?>
 <option  value="PE" <?php  if ($this->id_country == "PE") { echo " selected" ;} ?>>Peru</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PE'; ?>
 <option  value="PH" <?php  if ($this->id_country == "PH") { echo " selected" ;} ?>>Philippines</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PH'; ?>
 <option  value="PN" <?php  if ($this->id_country == "PN") { echo " selected" ;} ?>>Pitcairn</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PN'; ?>
 <option  value="PL" <?php  if ($this->id_country == "PL") { echo " selected" ;} ?>>Poland</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PL'; ?>
 <option  value="PT" <?php  if ($this->id_country == "PT") { echo " selected" ;} ?>>Portugal</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PT'; ?>
 <option  value="PR" <?php  if ($this->id_country == "PR") { echo " selected" ;} ?>>Puerto Rico</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PR'; ?>
 <option  value="QA" <?php  if ($this->id_country == "QA") { echo " selected" ;} ?>>Qatar</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'QA'; ?>
 <option  value="RE" <?php  if ($this->id_country == "RE") { echo " selected" ;} ?>>Reunion</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'RE'; ?>
 <option  value="RO" <?php  if ($this->id_country == "RO") { echo " selected" ;} ?>>Romania</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'RO'; ?>
 <option  value="RU" <?php  if ($this->id_country == "RU") { echo " selected" ;} ?>>Russian Federation</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'RU'; ?>
 <option  value="RW" <?php  if ($this->id_country == "RW") { echo " selected" ;} ?>>Rwanda</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'RW'; ?>
 <option  value="SH" <?php  if ($this->id_country == "SH") { echo " selected" ;} ?>>Saint Helena</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SH'; ?>
 <option  value="KN" <?php  if ($this->id_country == "KN") { echo " selected" ;} ?>>Saint Kitts and Nevis</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'KN'; ?>
 <option  value="LC" <?php  if ($this->id_country == "LC") { echo " selected" ;} ?>>Saint Lucia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LC'; ?>
 <option  value="PM" <?php  if ($this->id_country == "PM") { echo " selected" ;} ?>>Saint Pierre and Miquelon</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'PM'; ?>
 <option  value="VC" <?php  if ($this->id_country == "VC") { echo " selected" ;} ?>>Saint Vincent and the Grenadines</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'VC'; ?>
 <option  value="WS" <?php  if ($this->id_country == "WS") { echo " selected" ;} ?>>Samoa</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'WS'; ?>
 <option  value="SM" <?php  if ($this->id_country == "SM") { echo " selected" ;} ?>>San Marino</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SM'; ?>
 <option  value="ST" <?php  if ($this->id_country == "ST") { echo " selected" ;} ?>>Sao Tome and Principe</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ST'; ?>
 <option  value="SA" <?php  if ($this->id_country == "SA") { echo " selected" ;} ?>>Saudi Arabia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SA'; ?>
 <option  value="SN" <?php  if ($this->id_country == "SN") { echo " selected" ;} ?>>Senegal</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SN'; ?>
 <option  value="SC" <?php  if ($this->id_country == "SC") { echo " selected" ;} ?>>Seychelles</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SC'; ?>
 <option  value="SL" <?php  if ($this->id_country == "SL") { echo " selected" ;} ?>>Sierra Leone</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SL'; ?>
 <option  value="SG" <?php  if ($this->id_country == "SG") { echo " selected" ;} ?>>Singapore</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SG'; ?>
 <option  value="SK" <?php  if ($this->id_country == "SK") { echo " selected" ;} ?>>Slovakia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SK'; ?>
 <option  value="SI" <?php  if ($this->id_country == "SI") { echo " selected" ;} ?>>Slovenia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SI'; ?>
 <option  value="SB" <?php  if ($this->id_country == "SB") { echo " selected" ;} ?>>Solomon Islands</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SB'; ?>
 <option  value="SO" <?php  if ($this->id_country == "SO") { echo " selected" ;} ?>>Somalia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SO'; ?>
 <option  value="ZA" <?php  if ($this->id_country == "ZA") { echo " selected" ;} ?>>South Africa</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ZA'; ?>
 <option  value="GS" <?php  if ($this->id_country == "GS") { echo " selected" ;} ?>>South Georgia and the South Sandwich</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GS'; ?>
 <option  value="ES" <?php  if ($this->id_country == "ES") { echo " selected" ;} ?>>Spain</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ES'; ?>
 <option  value="LK" <?php  if ($this->id_country == "LK") { echo " selected" ;} ?>>Sri Lanka</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'LK'; ?>
 <option  value="SD" <?php  if ($this->id_country == "SD") { echo " selected" ;} ?>>Sudan</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SD'; ?>
 <option  value="SR" <?php  if ($this->id_country == "SR") { echo " selected" ;} ?>>Suriname</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SR'; ?>
 <option  value="SJ" <?php  if ($this->id_country == "SJ") { echo " selected" ;} ?>>Svalbard and Jan Mayen Islands</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SJ'; ?>
 <option  value="SZ" <?php  if ($this->id_country == "SZ") { echo " selected" ;} ?>>Swaziland</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SZ'; ?>
 <option  value="SE" <?php  if ($this->id_country == "SE") { echo " selected" ;} ?>>Sweden</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SE'; ?>
 <option  value="CH" <?php  if ($this->id_country == "CH") { echo " selected" ;} ?>>Switzerland</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'CH'; ?>
 <option  value="SY" <?php  if ($this->id_country == "SY") { echo " selected" ;} ?>>Syrian Arab Republic</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'SY'; ?>
 <option  value="TW" <?php  if ($this->id_country == "TW") { echo " selected" ;} ?>>Taiwan Republic of China</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TW'; ?>
 <option  value="TJ" <?php  if ($this->id_country == "TJ") { echo " selected" ;} ?>>Tajikistan</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TJ'; ?>
 <option  value="TZ" <?php  if ($this->id_country == "TZ") { echo " selected" ;} ?>>Tanzania United Republic of</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TZ'; ?>
 <option  value="TH" <?php  if ($this->id_country == "TH") { echo " selected" ;} ?>>Thailand</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TH'; ?>
 <option  value="TG" <?php  if ($this->id_country == "TG") { echo " selected" ;} ?>>Togo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TG'; ?>
 <option  value="TK" <?php  if ($this->id_country == "TK") { echo " selected" ;} ?>>Tokelau</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TK'; ?>
 <option  value="TO" <?php  if ($this->id_country == "TO") { echo " selected" ;} ?>>Tonga</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TO'; ?>
 <option  value="TT" <?php  if ($this->id_country == "TT") { echo " selected" ;} ?>>Trinidad and Tobago</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TT'; ?>
 <option  value="TN" <?php  if ($this->id_country == "TN") { echo " selected" ;} ?>>Tunisia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TN'; ?>
 <option  value="TR" <?php  if ($this->id_country == "TR") { echo " selected" ;} ?>>Turkey</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TR'; ?>
 <option  value="TM" <?php  if ($this->id_country == "TM") { echo " selected" ;} ?>>Turkmenistan</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TM'; ?>
 <option  value="TC" <?php  if ($this->id_country == "TC") { echo " selected" ;} ?>>Turks and Caicos Islands</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TC'; ?>
 <option  value="TV" <?php  if ($this->id_country == "TV") { echo " selected" ;} ?>>Tuvalu</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'TV'; ?>
 <option  value="UG" <?php  if ($this->id_country == "UG") { echo " selected" ;} ?>>Uganda</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'UG'; ?>
 <option  value="UA" <?php  if ($this->id_country == "UA") { echo " selected" ;} ?>>Ukraine</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'UA'; ?>
 <option  value="AE" <?php  if ($this->id_country == "AE") { echo " selected" ;} ?>>United Arab Emirates</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'AE'; ?>
 <option  value="GB" <?php  if ($this->id_country == "GB") { echo " selected" ;} ?>>United Kingdom</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'GB'; ?>
 <option  value="US" <?php  if ($this->id_country == "US") { echo " selected" ;} ?>>United States</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'US'; ?>
 <option  value="UM" <?php  if ($this->id_country == "UM") { echo " selected" ;} ?>>United States Minor Outlying Islands</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'UM'; ?>
 <option  value="UY" <?php  if ($this->id_country == "UY") { echo " selected" ;} ?>>Uruguay</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'UY'; ?>
 <option  value="UZ" <?php  if ($this->id_country == "UZ") { echo " selected" ;} ?>>Uzbekistan</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'UZ'; ?>
 <option  value="VU" <?php  if ($this->id_country == "VU") { echo " selected" ;} ?>>Vanuatu</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'VU'; ?>
 <option  value="VA" <?php  if ($this->id_country == "VA") { echo " selected" ;} ?>>Vatican City State (Holy See)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'VA'; ?>
 <option  value="VE" <?php  if ($this->id_country == "VE") { echo " selected" ;} ?>>Venezuela</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'VE'; ?>
 <option  value="VN" <?php  if ($this->id_country == "VN") { echo " selected" ;} ?>>Viet Nam</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'VN'; ?>
 <option  value="VG" <?php  if ($this->id_country == "VG") { echo " selected" ;} ?>>Virgin Islands (British)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'VG'; ?>
 <option  value="VI" <?php  if ($this->id_country == "VI") { echo " selected" ;} ?>>Virgin Islands (U.S.)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'VI'; ?>
 <option  value="WF" <?php  if ($this->id_country == "WF") { echo " selected" ;} ?>>Wallis and Futuna Islands</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'WF'; ?>
 <option  value="EH" <?php  if ($this->id_country == "EH") { echo " selected" ;} ?>>Western Sahara</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'EH'; ?>
 <option  value="YE" <?php  if ($this->id_country == "YE") { echo " selected" ;} ?>>Yemen</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'YE'; ?>
 <option  value="YU" <?php  if ($this->id_country == "YU") { echo " selected" ;} ?>>Yugoslavia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'YU'; ?>
 <option  value="ZR" <?php  if ($this->id_country == "ZR") { echo " selected" ;} ?>>Zaire</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ZR'; ?>
 <option  value="ZM" <?php  if ($this->id_country == "ZM") { echo " selected" ;} ?>>Zambia</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ZM'; ?>
 <option  value="ZW" <?php  if ($this->id_country == "ZW") { echo " selected" ;} ?>>Zimbabwe</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['Lookup_id_country'][] = 'ZW'; ?>
 </select></span>
</span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['customer_address']))
    {
        $this->nm_new_label['customer_address'] = "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_address'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $customer_address = $this->customer_address;
   $sStyleHidden_customer_address = '';
   if (isset($this->nmgp_cmp_hidden['customer_address']) && $this->nmgp_cmp_hidden['customer_address'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['customer_address']);
       $sStyleHidden_customer_address = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_customer_address = 'display: none;';
   $sStyleReadInp_customer_address = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['customer_address']) && $this->nmgp_cmp_readonly['customer_address'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['customer_address']);
       $sStyleReadLab_customer_address = '';
       $sStyleReadInp_customer_address = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['customer_address']) && $this->nmgp_cmp_hidden['customer_address'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="customer_address" value="<?php echo $this->form_encode_input($customer_address) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_customer_address_label" id="hidden_field_label_customer_address" style="<?php echo $sStyleHidden_customer_address; ?>"><span id="id_label_customer_address"><?php echo $this->nm_new_label['customer_address']; ?></span></TD>
    <TD class="scFormDataOdd css_customer_address_line" id="hidden_field_data_customer_address" style="<?php echo $sStyleHidden_customer_address; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["customer_address"]) &&  $this->nmgp_cmp_readonly["customer_address"] == "on") { 

 ?>
<input type="hidden" name="customer_address" value="<?php echo $this->form_encode_input($customer_address) . "\">" . $customer_address . ""; ?>
<?php } else { ?>
<span id="id_read_on_customer_address" class="sc-ui-readonly-customer_address css_customer_address_line" style="<?php echo $sStyleReadLab_customer_address; ?>"><?php echo $this->form_format_readonly("customer_address", $this->form_encode_input($this->customer_address)); ?></span><span id="id_read_off_customer_address" class="css_read_off_customer_address<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_customer_address; ?>">
 <input class="sc-js-input scFormObjectOdd css_customer_address_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_customer_address" type=text name="customer_address" value="<?php echo $this->form_encode_input($customer_address) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['customer_phone1']))
    {
        $this->nm_new_label['customer_phone1'] = "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_phone1'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $customer_phone1 = $this->customer_phone1;
   $sStyleHidden_customer_phone1 = '';
   if (isset($this->nmgp_cmp_hidden['customer_phone1']) && $this->nmgp_cmp_hidden['customer_phone1'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['customer_phone1']);
       $sStyleHidden_customer_phone1 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_customer_phone1 = 'display: none;';
   $sStyleReadInp_customer_phone1 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['customer_phone1']) && $this->nmgp_cmp_readonly['customer_phone1'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['customer_phone1']);
       $sStyleReadLab_customer_phone1 = '';
       $sStyleReadInp_customer_phone1 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['customer_phone1']) && $this->nmgp_cmp_hidden['customer_phone1'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="customer_phone1" value="<?php echo $this->form_encode_input($customer_phone1) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_customer_phone1_label" id="hidden_field_label_customer_phone1" style="<?php echo $sStyleHidden_customer_phone1; ?>"><span id="id_label_customer_phone1"><?php echo $this->nm_new_label['customer_phone1']; ?></span></TD>
    <TD class="scFormDataOdd css_customer_phone1_line" id="hidden_field_data_customer_phone1" style="<?php echo $sStyleHidden_customer_phone1; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["customer_phone1"]) &&  $this->nmgp_cmp_readonly["customer_phone1"] == "on") { 

 ?>
<input type="hidden" name="customer_phone1" value="<?php echo $this->form_encode_input($customer_phone1) . "\">" . $customer_phone1 . ""; ?>
<?php } else { ?>
<span id="id_read_on_customer_phone1" class="sc-ui-readonly-customer_phone1 css_customer_phone1_line" style="<?php echo $sStyleReadLab_customer_phone1; ?>"><?php echo $this->form_format_readonly("customer_phone1", $this->form_encode_input($this->customer_phone1)); ?></span><span id="id_read_off_customer_phone1" class="css_read_off_customer_phone1<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_customer_phone1; ?>">
 <input class="sc-js-input scFormObjectOdd css_customer_phone1_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_customer_phone1" type=text name="customer_phone1" value="<?php echo $this->form_encode_input($customer_phone1) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=150 alt="{datatype: 'text', maxLength: 150, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['customer_phone2']))
    {
        $this->nm_new_label['customer_phone2'] = "" . $this->Ini->Nm_lang['lang_tb_customers_fld_customer_phone2'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $customer_phone2 = $this->customer_phone2;
   $sStyleHidden_customer_phone2 = '';
   if (isset($this->nmgp_cmp_hidden['customer_phone2']) && $this->nmgp_cmp_hidden['customer_phone2'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['customer_phone2']);
       $sStyleHidden_customer_phone2 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_customer_phone2 = 'display: none;';
   $sStyleReadInp_customer_phone2 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['customer_phone2']) && $this->nmgp_cmp_readonly['customer_phone2'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['customer_phone2']);
       $sStyleReadLab_customer_phone2 = '';
       $sStyleReadInp_customer_phone2 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['customer_phone2']) && $this->nmgp_cmp_hidden['customer_phone2'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="customer_phone2" value="<?php echo $this->form_encode_input($customer_phone2) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_customer_phone2_label" id="hidden_field_label_customer_phone2" style="<?php echo $sStyleHidden_customer_phone2; ?>"><span id="id_label_customer_phone2"><?php echo $this->nm_new_label['customer_phone2']; ?></span></TD>
    <TD class="scFormDataOdd css_customer_phone2_line" id="hidden_field_data_customer_phone2" style="<?php echo $sStyleHidden_customer_phone2; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["customer_phone2"]) &&  $this->nmgp_cmp_readonly["customer_phone2"] == "on") { 

 ?>
<input type="hidden" name="customer_phone2" value="<?php echo $this->form_encode_input($customer_phone2) . "\">" . $customer_phone2 . ""; ?>
<?php } else { ?>
<span id="id_read_on_customer_phone2" class="sc-ui-readonly-customer_phone2 css_customer_phone2_line" style="<?php echo $sStyleReadLab_customer_phone2; ?>"><?php echo $this->form_format_readonly("customer_phone2", $this->form_encode_input($this->customer_phone2)); ?></span><span id="id_read_off_customer_phone2" class="css_read_off_customer_phone2<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_customer_phone2; ?>">
 <input class="sc-js-input scFormObjectOdd css_customer_phone2_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_customer_phone2" type=text name="customer_phone2" value="<?php echo $this->form_encode_input($customer_phone2) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=150 alt="{datatype: 'text', maxLength: 150, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } ?>
   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['birpara'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "birpara", "scBtnFn_sys_GridPermiteSeq('b')", "scBtnFn_sys_GridPermiteSeq('b')", "brec_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_b" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-11';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['back'];
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
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['forward'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bavanca", "scBtnFn_sys_format_ava()", "scBtnFn_sys_format_ava()", "sc_b_avc_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['masterValue']))
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_tb_customers");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_tb_customers");
 parent.scAjaxDetailHeight("form_tb_customers", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_tb_customers", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_tb_customers", <?php echo $sTamanhoIframe; ?>);
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
			nm_move ('novo');
			 return;
		}
		if ($("#sc_b_ins_t.sc-unique-btn-2").length && $("#sc_b_ins_t.sc-unique-btn-2").is(":visible")) {
		    if ($("#sc_b_ins_t.sc-unique-btn-2").hasClass("disabled")) {
		        return;
		    }
			nm_atualiza ('incluir');
			 return;
		}
	}
	function scBtnFn_sys_format_cnl() {
		if ($("#sc_b_sai_t.sc-unique-btn-3").length && $("#sc_b_sai_t.sc-unique-btn-3").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-3").hasClass("disabled")) {
		        return;
		    }
			<?php echo $this->NM_cancel_insert_new ?> document.F5.submit();
			 return;
		}
	}
	function scBtnFn_sys_format_alt() {
		if ($("#sc_b_upd_t.sc-unique-btn-4").length && $("#sc_b_upd_t.sc-unique-btn-4").is(":visible")) {
		    if ($("#sc_b_upd_t.sc-unique-btn-4").hasClass("disabled")) {
		        return;
		    }
			nm_atualiza ('alterar');
			 return;
		}
	}
	function scBtnFn_sys_format_exc() {
		if ($("#sc_b_del_t.sc-unique-btn-5").length && $("#sc_b_del_t.sc-unique-btn-5").is(":visible")) {
		    if ($("#sc_b_del_t.sc-unique-btn-5").hasClass("disabled")) {
		        return;
		    }
			nm_atualiza ('excluir');
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
		if ($("#sc_b_sai_t.sc-unique-btn-6").length && $("#sc_b_sai_t.sc-unique-btn-6").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-6").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F5('<?php echo $nm_url_saida; ?>');
			 return;
		}
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
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
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
		if ($("#sc_b_ini_b.sc-unique-btn-11").length && $("#sc_b_ini_b.sc-unique-btn-11").is(":visible")) {
		    if ($("#sc_b_ini_b.sc-unique-btn-11").hasClass("disabled")) {
		        return;
		    }
			nm_move ('inicio');
			 return;
		}
	}
	function scBtnFn_sys_format_ret() {
		if ($("#sc_b_ret_b.sc-unique-btn-12").length && $("#sc_b_ret_b.sc-unique-btn-12").is(":visible")) {
		    if ($("#sc_b_ret_b.sc-unique-btn-12").hasClass("disabled")) {
		        return;
		    }
			nm_move ('retorna');
			 return;
		}
	}
	function scBtnFn_sys_format_ava() {
		if ($("#sc_b_avc_b.sc-unique-btn-13").length && $("#sc_b_avc_b.sc-unique-btn-13").is(":visible")) {
		    if ($("#sc_b_avc_b.sc-unique-btn-13").hasClass("disabled")) {
		        return;
		    }
			nm_move ('avanca');
			 return;
		}
	}
	function scBtnFn_sys_format_fim() {
		if ($("#sc_b_fim_b.sc-unique-btn-14").length && $("#sc_b_fim_b.sc-unique-btn-14").is(":visible")) {
		    if ($("#sc_b_fim_b.sc-unique-btn-14").hasClass("disabled")) {
		        return;
		    }
			nm_move ('final');
			 return;
		}
	}
</script>
<script type="text/javascript">
$(function() {
 $("#sc-id-mobile-in").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("in");
 });
 $("#sc-id-mobile-out").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("out");
 });
});
function scMobileDisplayControl(sOption) {
 $("#sc-id-mobile-control").val(sOption);
 nm_atualiza("recarga_mobile");
}
</script>
<?php
       if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'])
       {
?>
<span id="sc-id-mobile-in"><?php echo $this->Ini->Nm_lang['lang_version_mobile']; ?></span>
<?php
       }
?>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tb_customers']['buttonStatus'] = $this->nmgp_botoes;
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
