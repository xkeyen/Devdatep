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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - " . $this->Ini->Nm_lang['lang_tble_ticketmessage'] . ""); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - " . $this->Ini->Nm_lang['lang_tble_ticketmessage'] . ""); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
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
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_operator_response/form_operator_response_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_tiny_mce; ?>"></SCRIPT>
 <STYLE>
.tox-toolbar, .tox-toolbar__primary {justify-content: left !important}
.tox-toolbar, .tox-toolbar__primary {justify-content: left !important}
 </STYLE>

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_operator_response_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['last'] : 'off'); ?>";
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
<?php

include_once('form_operator_response_jquery.php');

?>

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

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
   });
 if($(".sc-ui-block-control").length) {
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['link_info']['remove_border']) {
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
 include_once("form_operator_response_js0.php");
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
<form  name="F1" method="post" enctype="multipart/form-data" 
               action="form_operator_response.php" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['insert_validation']; ?>">
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
<input type="hidden" name="upload_file_flag" value="">
<input type="hidden" name="upload_file_check" value="">
<input type="hidden" name="upload_file_name" value="">
<input type="hidden" name="upload_file_temp" value="">
<input type="hidden" name="upload_file_libs" value="">
<input type="hidden" name="upload_file_height" value="">
<input type="hidden" name="upload_file_width" value="">
<input type="hidden" name="upload_file_aspect" value="">
<input type="hidden" name="upload_file_type" value="">
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_operator_response'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_operator_response'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
?>
<div style="display: none; position: absolute; z-index: 1000" id="id_error_display_table_frame">
<table class="scFormErrorTable scFormToastTable">
<tr><?php if ($this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><td style="padding: 0px" rowspan="2"><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top"></td><?php } ?><td class="scFormErrorTitle scFormToastTitle"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormErrorTitleFont" style="padding: 0px; vertical-align: top; width: 100%"><?php if (!$this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top">&nbsp;<?php } ?>ERROR</td><td style="padding: 0px; vertical-align: top"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideErrorDisplay('table')", "scAjaxHideErrorDisplay('table')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
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
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="650">
 <tr>
  <td>
  <div class="scFormBorder" style="<?php echo (isset($remove_border) ? $remove_border : ''); ?>">
   <table width='100%' cellspacing=0 cellpadding=0>
<?php
$this->displayAppHeader();
?>
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
<?php
?>
<script type="text/javascript">
function sc_change_tabs(bTabDisp, sTabId, sTabParts)
{
  if (document.getElementById(sTabId)) {
    if (bTabDisp) {
      document.getElementById("div_" + sTabId).style.width = "";
      document.getElementById("div_" + sTabId).style.height = "";
      document.getElementById("div_" + sTabId).style.display = "";
      document.getElementById("div_" + sTabId).style.overflow = "visible";
      document.getElementById(sTabParts).className = "scTabActive";
    }
    else {
      document.getElementById("div_" + sTabId).style.width = "1px";
      document.getElementById("div_" + sTabId).style.height = "0px";
      document.getElementById("div_" + sTabId).style.display = "none";
      document.getElementById("div_" + sTabId).style.overflow = "scroll";
      document.getElementById(sTabParts).className = "scTabInactive";
    }
  }
}
</script>
<input type="hidden" name="ticketfile1_ul_name" id="id_sc_field_ticketfile1_ul_name" value="<?php echo $this->form_encode_input($this->ticketfile1_ul_name);?>">
<input type="hidden" name="ticketfile1_ul_type" id="id_sc_field_ticketfile1_ul_type" value="<?php echo $this->form_encode_input($this->ticketfile1_ul_type);?>">
<input type="hidden" name="ticketfile2_ul_name" id="id_sc_field_ticketfile2_ul_name" value="<?php echo $this->form_encode_input($this->ticketfile2_ul_name);?>">
<input type="hidden" name="ticketfile2_ul_type" id="id_sc_field_ticketfile2_ul_type" value="<?php echo $this->form_encode_input($this->ticketfile2_ul_type);?>">
<input type="hidden" name="ticketfile3_ul_name" id="id_sc_field_ticketfile3_ul_name" value="<?php echo $this->form_encode_input($this->ticketfile3_ul_name);?>">
<input type="hidden" name="ticketfile3_ul_type" id="id_sc_field_ticketfile3_ul_type" value="<?php echo $this->form_encode_input($this->ticketfile3_ul_type);?>">
<script type="text/javascript">
function sc_control_tabs_0(iTabIndex)
{
  sc_change_tabs(iTabIndex == 0, 'hidden_bloco_0', 'id_tabs_0_0');
  if (iTabIndex == 0) {
    displayChange_block("0", "on");
  }
  sc_change_tabs(iTabIndex == 1, 'hidden_bloco_1', 'id_tabs_0_1');
  if (iTabIndex == 1) {
    displayChange_block("1", "on");
  }
  sc_change_tabs(iTabIndex == 2, 'hidden_bloco_2', 'id_tabs_0_2');
  if (iTabIndex == 2) {
    displayChange_block("2", "on");
  }
}
</script>
<ul class="scTabLine">
<li id="id_tabs_0_0" class="scTabActive"><a href="javascript: sc_control_tabs_0(0)"><?php echo $this->Ini->Nm_lang['lang_block_message'] ?></a></li>
<li id="id_tabs_0_1" class="scTabInactive"><a href="javascript: sc_control_tabs_0(1)"><?php echo $this->Ini->Nm_lang['lang_block_achments'] ?></a></li>
<li id="id_tabs_0_2" class="scTabInactive"><a href="javascript: sc_control_tabs_0(2)"><?php echo $this->Ini->Nm_lang['lang_block_ticket_notes'] ?></a></li>
</ul>
<div style='clear:both'></div>
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['ticketpriorityid']))
   {
       $this->nm_new_label['ticketpriorityid'] = "" . $this->Ini->Nm_lang['lang_ticket_fild_ticketpriorityid'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ticketpriorityid = $this->ticketpriorityid;
   $sStyleHidden_ticketpriorityid = '';
   if (isset($this->nmgp_cmp_hidden['ticketpriorityid']) && $this->nmgp_cmp_hidden['ticketpriorityid'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ticketpriorityid']);
       $sStyleHidden_ticketpriorityid = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ticketpriorityid = 'display: none;';
   $sStyleReadInp_ticketpriorityid = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ticketpriorityid']) && $this->nmgp_cmp_readonly['ticketpriorityid'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ticketpriorityid']);
       $sStyleReadLab_ticketpriorityid = '';
       $sStyleReadInp_ticketpriorityid = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ticketpriorityid']) && $this->nmgp_cmp_hidden['ticketpriorityid'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ticketpriorityid" value="<?php echo $this->form_encode_input($this->ticketpriorityid) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ticketpriorityid_line" id="hidden_field_data_ticketpriorityid" style="<?php echo $sStyleHidden_ticketpriorityid; ?>"> <span class="scFormLabelOddFormat css_ticketpriorityid_label" style=""><span id="id_label_ticketpriorityid"><?php echo $this->nm_new_label['ticketpriorityid']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ticketpriorityid"]) &&  $this->nmgp_cmp_readonly["ticketpriorityid"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_ticketpriorityid']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_ticketpriorityid'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_ticketpriorityid']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_ticketpriorityid'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_ticketpriorityid']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_ticketpriorityid'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_ticketpriorityid']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_ticketpriorityid'] = array(); 
    }
   $closeticket_val_str = "''";
   if (!empty($this->closeticket))
   {
       if (is_array($this->closeticket))
       {
           $Tmp_array = $this->closeticket;
       }
       else
       {
           $Tmp_array = explode(";", $this->closeticket);
       }
       $closeticket_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $closeticket_val_str)
          {
             $closeticket_val_str .= ", ";
          }
          $closeticket_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "select ticketpriorityid, priorityname  from ticketpriority  order by priorityname";
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_ticketpriorityid'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $ticketpriorityid_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->ticketpriorityid_1))
          {
              foreach ($this->ticketpriorityid_1 as $tmp_ticketpriorityid)
              {
                  if (trim($tmp_ticketpriorityid) === trim($cadaselect[1])) {$ticketpriorityid_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->ticketpriorityid) && trim($this->ticketpriorityid) === trim($cadaselect[1])) {$ticketpriorityid_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="ticketpriorityid" value="<?php echo $this->form_encode_input($ticketpriorityid) . "\">" . $ticketpriorityid_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_ticketpriorityid();
   $x = 0 ; 
   $ticketpriorityid_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->ticketpriorityid_1))
          {
              foreach ($this->ticketpriorityid_1 as $tmp_ticketpriorityid)
              {
                  if (trim($tmp_ticketpriorityid) === trim($cadaselect[1])) {$ticketpriorityid_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->ticketpriorityid) && trim($this->ticketpriorityid) === trim($cadaselect[1])) { $ticketpriorityid_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($ticketpriorityid_look))
          {
              $ticketpriorityid_look = $this->ticketpriorityid;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_ticketpriorityid\" class=\"css_ticketpriorityid_line\" style=\"" .  $sStyleReadLab_ticketpriorityid . "\">" . $this->form_format_readonly("ticketpriorityid", $this->form_encode_input($ticketpriorityid_look)) . "</span><span id=\"id_read_off_ticketpriorityid\" class=\"css_read_off_ticketpriorityid" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_ticketpriorityid . "\">";
   echo " <span id=\"idAjaxSelect_ticketpriorityid\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_ticketpriorityid_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_ticketpriorityid\" name=\"ticketpriorityid\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->ticketpriorityid) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->ticketpriorityid)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['categoryid']))
   {
       $this->nm_new_label['categoryid'] = "" . $this->Ini->Nm_lang['lang_ticket_fild_categoryid'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $categoryid = $this->categoryid;
   $sStyleHidden_categoryid = '';
   if (isset($this->nmgp_cmp_hidden['categoryid']) && $this->nmgp_cmp_hidden['categoryid'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['categoryid']);
       $sStyleHidden_categoryid = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_categoryid = 'display: none;';
   $sStyleReadInp_categoryid = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['categoryid']) && $this->nmgp_cmp_readonly['categoryid'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['categoryid']);
       $sStyleReadLab_categoryid = '';
       $sStyleReadInp_categoryid = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['categoryid']) && $this->nmgp_cmp_hidden['categoryid'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="categoryid" value="<?php echo $this->form_encode_input($this->categoryid) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_categoryid_line" id="hidden_field_data_categoryid" style="<?php echo $sStyleHidden_categoryid; ?>"> <span class="scFormLabelOddFormat css_categoryid_label" style=""><span id="id_label_categoryid"><?php echo $this->nm_new_label['categoryid']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["categoryid"]) &&  $this->nmgp_cmp_readonly["categoryid"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_categoryid']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_categoryid'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_categoryid']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_categoryid'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_categoryid']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_categoryid'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_categoryid']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_categoryid'] = array(); 
    }
   $closeticket_val_str = "''";
   if (!empty($this->closeticket))
   {
       if (is_array($this->closeticket))
       {
           $Tmp_array = $this->closeticket;
       }
       else
       {
           $Tmp_array = explode(";", $this->closeticket);
       }
       $closeticket_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $closeticket_val_str)
          {
             $closeticket_val_str .= ", ";
          }
          $closeticket_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "select categoryid, categoryname  from categories  order by categoryname";
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_categoryid'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $categoryid_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->categoryid_1))
          {
              foreach ($this->categoryid_1 as $tmp_categoryid)
              {
                  if (trim($tmp_categoryid) === trim($cadaselect[1])) {$categoryid_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->categoryid) && trim($this->categoryid) === trim($cadaselect[1])) {$categoryid_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="categoryid" value="<?php echo $this->form_encode_input($categoryid) . "\">" . $categoryid_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_categoryid();
   $x = 0 ; 
   $categoryid_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->categoryid_1))
          {
              foreach ($this->categoryid_1 as $tmp_categoryid)
              {
                  if (trim($tmp_categoryid) === trim($cadaselect[1])) {$categoryid_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->categoryid) && trim($this->categoryid) === trim($cadaselect[1])) { $categoryid_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($categoryid_look))
          {
              $categoryid_look = $this->categoryid;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_categoryid\" class=\"css_categoryid_line\" style=\"" .  $sStyleReadLab_categoryid . "\">" . $this->form_format_readonly("categoryid", $this->form_encode_input($categoryid_look)) . "</span><span id=\"id_read_off_categoryid\" class=\"css_read_off_categoryid" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_categoryid . "\">";
   echo " <span id=\"idAjaxSelect_categoryid\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_categoryid_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_categoryid\" name=\"categoryid\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->categoryid) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->categoryid)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['templateid']))
   {
       $this->nm_new_label['templateid'] = "" . $this->Ini->Nm_lang['lang_tble_message_templates'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $templateid = $this->templateid;
   $sStyleHidden_templateid = '';
   if (isset($this->nmgp_cmp_hidden['templateid']) && $this->nmgp_cmp_hidden['templateid'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['templateid']);
       $sStyleHidden_templateid = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_templateid = 'display: none;';
   $sStyleReadInp_templateid = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['templateid']) && $this->nmgp_cmp_readonly['templateid'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['templateid']);
       $sStyleReadLab_templateid = '';
       $sStyleReadInp_templateid = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['templateid']) && $this->nmgp_cmp_hidden['templateid'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="templateid" value="<?php echo $this->form_encode_input($this->templateid) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_templateid_line" id="hidden_field_data_templateid" style="<?php echo $sStyleHidden_templateid; ?>"> <span class="scFormLabelOddFormat css_templateid_label" style=""><span id="id_label_templateid"><?php echo $this->nm_new_label['templateid']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["templateid"]) &&  $this->nmgp_cmp_readonly["templateid"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_templateid']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_templateid'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_templateid']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_templateid'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_templateid']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_templateid'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_templateid']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_templateid'] = array(); 
    }
   $closeticket_val_str = "''";
   if (!empty($this->closeticket))
   {
       if (is_array($this->closeticket))
       {
           $Tmp_array = $this->closeticket;
       }
       else
       {
           $Tmp_array = explode(";", $this->closeticket);
       }
       $closeticket_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $closeticket_val_str)
          {
             $closeticket_val_str .= ", ";
          }
          $closeticket_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "select templateid, templatedescription  from message_templates  order by templatedescription";
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_templateid'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $templateid_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->templateid_1))
          {
              foreach ($this->templateid_1 as $tmp_templateid)
              {
                  if (trim($tmp_templateid) === trim($cadaselect[1])) {$templateid_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->templateid) && trim($this->templateid) === trim($cadaselect[1])) {$templateid_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="templateid" value="<?php echo $this->form_encode_input($templateid) . "\">" . $templateid_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_templateid();
   $x = 0 ; 
   $templateid_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->templateid_1))
          {
              foreach ($this->templateid_1 as $tmp_templateid)
              {
                  if (trim($tmp_templateid) === trim($cadaselect[1])) {$templateid_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->templateid) && trim($this->templateid) === trim($cadaselect[1])) { $templateid_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($templateid_look))
          {
              $templateid_look = $this->templateid;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_templateid\" class=\"css_templateid_line\" style=\"" .  $sStyleReadLab_templateid . "\">" . $this->form_format_readonly("templateid", $this->form_encode_input($templateid_look)) . "</span><span id=\"id_read_off_templateid\" class=\"css_read_off_templateid" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_templateid . "\">";
   echo " <span id=\"idAjaxSelect_templateid\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_templateid_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_templateid\" name=\"templateid\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_templateid'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->templateid) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->templateid)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ticketcontent']))
    {
        $this->nm_new_label['ticketcontent'] = "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketcontent'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ticketcontent = $this->ticketcontent;
   $sStyleHidden_ticketcontent = '';
   if (isset($this->nmgp_cmp_hidden['ticketcontent']) && $this->nmgp_cmp_hidden['ticketcontent'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ticketcontent']);
       $sStyleHidden_ticketcontent = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ticketcontent = 'display: none;';
   $sStyleReadInp_ticketcontent = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ticketcontent']) && $this->nmgp_cmp_readonly['ticketcontent'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ticketcontent']);
       $sStyleReadLab_ticketcontent = '';
       $sStyleReadInp_ticketcontent = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ticketcontent']) && $this->nmgp_cmp_hidden['ticketcontent'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ticketcontent" value="<?php echo $this->form_encode_input($ticketcontent) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ticketcontent_line" id="hidden_field_data_ticketcontent" style="<?php echo $sStyleHidden_ticketcontent; ?>"> <span class="scFormLabelOddFormat css_ticketcontent_label" style=""><span id="id_label_ticketcontent"><?php echo $this->nm_new_label['ticketcontent']; ?></span></span><br><span id="id_read_on_ticketcontent" style="<?php echo $sStyleReadLab_ticketcontent; ?>"><?php echo $this->form_format_readonly("ticketcontent", sc_strip_script($this->ticketcontent)); ?></span><span id="id_read_off_ticketcontent" class="css_read_off_ticketcontent" style="<?php echo $sStyleReadInp_ticketcontent; ?>"><textarea id="ticketcontent" name="ticketcontent" cols="50" rows="10" class="mceEditor_ticketcontent" style="width: 100%; height:300px;"><?php echo $this->form_encode_input($this->ticketcontent); ?></textarea>
</span> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['closeticket']))
   {
       $this->nm_new_label['closeticket'] = "" . $this->Ini->Nm_lang['lang_ticket_close'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $closeticket = $this->closeticket;
   $sStyleHidden_closeticket = '';
   if (isset($this->nmgp_cmp_hidden['closeticket']) && $this->nmgp_cmp_hidden['closeticket'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['closeticket']);
       $sStyleHidden_closeticket = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_closeticket = 'display: none;';
   $sStyleReadInp_closeticket = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['closeticket']) && $this->nmgp_cmp_readonly['closeticket'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['closeticket']);
       $sStyleReadLab_closeticket = '';
       $sStyleReadInp_closeticket = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['closeticket']) && $this->nmgp_cmp_hidden['closeticket'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="closeticket" value="<?php echo $this->form_encode_input($this->closeticket) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->closeticket_1 = explode(";", trim($this->closeticket));
  } 
  else
  {
      if (empty($this->closeticket))
      {
          $this->closeticket_1= array(); 
          $this->closeticket= "";
      } 
      else
      {
          $this->closeticket_1= $this->closeticket; 
          $this->closeticket= ""; 
          foreach ($this->closeticket_1 as $cada_closeticket)
          {
             if (!empty($closeticket))
             {
                 $this->closeticket.= ";"; 
             } 
             $this->closeticket.= $cada_closeticket; 
          } 
      } 
  } 
?> 

    <TD class="scFormDataOdd css_closeticket_line" id="hidden_field_data_closeticket" style="<?php echo $sStyleHidden_closeticket; ?>"> <span class="scFormLabelOddFormat css_closeticket_label" style=""><span id="id_label_closeticket"><?php echo $this->nm_new_label['closeticket']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["closeticket"]) &&  $this->nmgp_cmp_readonly["closeticket"] == "on") { 

$closeticket_look = "";
 if ($this->closeticket == "Y") { $closeticket_look .= "" ;} 
 if (empty($closeticket_look)) { $closeticket_look = $this->closeticket; }
?>
<input type="hidden" name="closeticket" value="<?php echo $this->form_encode_input($closeticket) . "\">" . $closeticket_look . ""; ?>
<?php } else { ?>

<?php

$closeticket_look = "";
 if ($this->closeticket == "Y") { $closeticket_look .= "" ;} 
 if (empty($closeticket_look)) { $closeticket_look = $this->closeticket; }
?>
<span id="id_read_on_closeticket" class="css_closeticket_line" style="<?php echo $sStyleReadLab_closeticket; ?>"><?php echo $this->form_format_readonly("closeticket", $this->form_encode_input($closeticket_look)); ?></span><span id="id_read_off_closeticket" class="css_read_off_closeticket css_closeticket_line" style="<?php echo $sStyleReadInp_closeticket; ?>"><?php echo "<div id=\"idAjaxCheckbox_closeticket\" style=\"display: inline-block\" class=\"css_closeticket_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_closeticket_line"><?php $tempOptionId = "id-opt-closeticket" . $sc_seq_vert . "-1"; ?>
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-closeticket sc-ui-checkbox-closeticket" name="closeticket[]" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_closeticket'][] = 'Y'; ?>
<?php  if (in_array("Y", $this->closeticket_1))  { echo " checked" ;} ?> onClick="do_ajax_form_operator_response_event_closeticket_onclick();" ><label for="<?php echo $tempOptionId ?>"></label></TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['transferticket']))
   {
       $this->nm_new_label['transferticket'] = "" . $this->Ini->Nm_lang['lang_ticket_transfer'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $transferticket = $this->transferticket;
   $sStyleHidden_transferticket = '';
   if (isset($this->nmgp_cmp_hidden['transferticket']) && $this->nmgp_cmp_hidden['transferticket'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['transferticket']);
       $sStyleHidden_transferticket = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_transferticket = 'display: none;';
   $sStyleReadInp_transferticket = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['transferticket']) && $this->nmgp_cmp_readonly['transferticket'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['transferticket']);
       $sStyleReadLab_transferticket = '';
       $sStyleReadInp_transferticket = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['transferticket']) && $this->nmgp_cmp_hidden['transferticket'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="transferticket" value="<?php echo $this->form_encode_input($this->transferticket) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_transferticket_line" id="hidden_field_data_transferticket" style="<?php echo $sStyleHidden_transferticket; ?>"> <span class="scFormLabelOddFormat css_transferticket_label" style=""><span id="id_label_transferticket"><?php echo $this->nm_new_label['transferticket']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["transferticket"]) &&  $this->nmgp_cmp_readonly["transferticket"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_transferticket']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_transferticket'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_transferticket']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_transferticket'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_transferticket']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_transferticket'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_transferticket']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_transferticket'] = array(); 
    }
   $nm_comando = "select staffid, staffname  from staff  where    staffid <> " . $_SESSION['v_staffid'] . " order by staffname";
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_transferticket'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $transferticket_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->transferticket_1))
          {
              foreach ($this->transferticket_1 as $tmp_transferticket)
              {
                  if (trim($tmp_transferticket) === trim($cadaselect[1])) {$transferticket_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->transferticket) && trim($this->transferticket) === trim($cadaselect[1])) {$transferticket_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="transferticket" value="<?php echo $this->form_encode_input($transferticket) . "\">" . $transferticket_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_transferticket();
   $x = 0 ; 
   $transferticket_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->transferticket_1))
          {
              foreach ($this->transferticket_1 as $tmp_transferticket)
              {
                  if (trim($tmp_transferticket) === trim($cadaselect[1])) {$transferticket_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->transferticket) && trim($this->transferticket) === trim($cadaselect[1])) { $transferticket_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($transferticket_look))
          {
              $transferticket_look = $this->transferticket;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_transferticket\" class=\"css_transferticket_line\" style=\"" .  $sStyleReadLab_transferticket . "\">" . $this->form_format_readonly("transferticket", $this->form_encode_input($transferticket_look)) . "</span><span id=\"id_read_off_transferticket\" class=\"css_read_off_transferticket" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_transferticket . "\">";
   echo " <span id=\"idAjaxSelect_transferticket\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_transferticket_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_transferticket\" name=\"transferticket\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['Lookup_transferticket'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->transferticket) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->transferticket)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_transferticket_dumb = ('' == $sStyleHidden_transferticket) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_transferticket_dumb" style="<?php echo $sStyleHidden_transferticket_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_1"></a>
<div id="div_hidden_bloco_1" style="display: none; width: 1px; height: 0px; overflow: scroll"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ticketfile1']))
    {
        $this->nm_new_label['ticketfile1'] = "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketfile1'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ticketfile1 = $this->ticketfile1;
   $ticketfilename1 = $this->ticketfilename1;
   $sStyleHidden_ticketfile1 = '';
   if (isset($this->nmgp_cmp_hidden['ticketfile1']) && $this->nmgp_cmp_hidden['ticketfile1'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ticketfile1']);
       $sStyleHidden_ticketfile1 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ticketfile1 = 'display: none;';
   $sStyleReadInp_ticketfile1 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ticketfile1']) && $this->nmgp_cmp_readonly['ticketfile1'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ticketfile1']);
       $sStyleReadLab_ticketfile1 = '';
       $sStyleReadInp_ticketfile1 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ticketfile1']) && $this->nmgp_cmp_hidden['ticketfile1'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ticketfile1" value="<?php echo $this->form_encode_input($ticketfile1) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ticketfile1_line" id="hidden_field_data_ticketfile1" style="<?php echo $sStyleHidden_ticketfile1; ?>"> 
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ticketfile1"]) &&  $this->nmgp_cmp_readonly["ticketfile1"] == "on") { 

 ?>
<input type="hidden" name="ticketfile1" value=""><img id=\"ticketfile1_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><span id=\"id_ajax_doc_ticketfile1\"><a href=\"javascript:nm_mostra_doc('documento_db', '" . str_replace("'", "\'", trim($ticketfilename1)) . "', 'form_operator_response')\">" . $ticketfilename1"</a></span>"; ?>
<?php } else { ?>
<span id="id_read_on_ticketfile1" class="scFormLinkOdd sc-ui-readonly-ticketfile1 css_ticketfile1_line" style="<?php echo $sStyleReadLab_ticketfile1; ?>"><?php echo $this->form_format_readonly("ticketfilename1", $ticketfilename1) ?></span><span id="id_read_off_ticketfile1" class="css_read_off_ticketfile1" style="white-space: nowrap;<?php echo $sStyleReadInp_ticketfile1; ?>"><span style="display:inline-block"><span id="sc-id-upload-select-ticketfile1" class="fileinput-button fileinput-button-padding scButton_default">
 <span><?php echo $this->Ini->Nm_lang['lang_select_file'] ?></span>

 <input class="sc-js-input scFormObjectOdd css_ticketfile1_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" title="<?php echo $this->Ini->Nm_lang['lang_select_file'] ?>" type="file" name="ticketfile1[]" id="id_sc_field_ticketfile1" ></span></span>
<?php
   $sCheckInsert = "";
?>
<span id="chk_ajax_img_ticketfile1"<?php if ($this->nmgp_opcao == "novo" || empty($ticketfile1)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="ticketfile1_limpa" value="<?php echo $ticketfile1_limpa . '" '; if ($ticketfile1_limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};<?php echo $sCheckInsert ?>"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="ticketfile1_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><span id="id_ajax_doc_ticketfile1"><a href="javascript:nm_mostra_doc('documento_db', '<?php echo str_replace("'", "\'", substr($sTmpFile_ticketfilename1, 3)) ;?>', 'form_operator_response')"><?php echo $ticketfilename1 ?></a></span><div id="id_img_loader_ticketfile1" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_ticketfile1" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
<div id="id_sc_dragdrop_ticketfile1" class="scFormDataDragNDrop"  style="<?php echo $sStyleReadInp_ticketfile1 ?>"><i class='fas fa-cloud-upload-alt'></i><br/>
<?php echo $this->Ini->Nm_lang['lang_errm_mu_dragfile'] ?></div>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ticketfile2']))
    {
        $this->nm_new_label['ticketfile2'] = "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketfile2'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ticketfile2 = $this->ticketfile2;
   $ticketfilename2 = $this->ticketfilename2;
   $sStyleHidden_ticketfile2 = '';
   if (isset($this->nmgp_cmp_hidden['ticketfile2']) && $this->nmgp_cmp_hidden['ticketfile2'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ticketfile2']);
       $sStyleHidden_ticketfile2 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ticketfile2 = 'display: none;';
   $sStyleReadInp_ticketfile2 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ticketfile2']) && $this->nmgp_cmp_readonly['ticketfile2'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ticketfile2']);
       $sStyleReadLab_ticketfile2 = '';
       $sStyleReadInp_ticketfile2 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ticketfile2']) && $this->nmgp_cmp_hidden['ticketfile2'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ticketfile2" value="<?php echo $this->form_encode_input($ticketfile2) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ticketfile2_line" id="hidden_field_data_ticketfile2" style="<?php echo $sStyleHidden_ticketfile2; ?>"> 
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ticketfile2"]) &&  $this->nmgp_cmp_readonly["ticketfile2"] == "on") { 

 ?>
<input type="hidden" name="ticketfile2" value=""><img id=\"ticketfile2_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><span id=\"id_ajax_doc_ticketfile2\"><a href=\"javascript:nm_mostra_doc('documento_db', '" . str_replace("'", "\'", trim($ticketfilename2)) . "', 'form_operator_response')\">" . $ticketfilename2"</a></span>"; ?>
<?php } else { ?>
<span id="id_read_on_ticketfile2" class="scFormLinkOdd sc-ui-readonly-ticketfile2 css_ticketfile2_line" style="<?php echo $sStyleReadLab_ticketfile2; ?>"><?php echo $this->form_format_readonly("ticketfilename2", $ticketfilename2) ?></span><span id="id_read_off_ticketfile2" class="css_read_off_ticketfile2" style="white-space: nowrap;<?php echo $sStyleReadInp_ticketfile2; ?>"><span style="display:inline-block"><span id="sc-id-upload-select-ticketfile2" class="fileinput-button fileinput-button-padding scButton_default">
 <span><?php echo $this->Ini->Nm_lang['lang_select_file'] ?></span>

 <input class="sc-js-input scFormObjectOdd css_ticketfile2_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" title="<?php echo $this->Ini->Nm_lang['lang_select_file'] ?>" type="file" name="ticketfile2[]" id="id_sc_field_ticketfile2" ></span></span>
<?php
   $sCheckInsert = "";
?>
<span id="chk_ajax_img_ticketfile2"<?php if ($this->nmgp_opcao == "novo" || empty($ticketfile2)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="ticketfile2_limpa" value="<?php echo $ticketfile2_limpa . '" '; if ($ticketfile2_limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};<?php echo $sCheckInsert ?>"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="ticketfile2_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><span id="id_ajax_doc_ticketfile2"><a href="javascript:nm_mostra_doc('documento_db', '<?php echo str_replace("'", "\'", substr($sTmpFile_ticketfilename2, 3)) ;?>', 'form_operator_response')"><?php echo $ticketfilename2 ?></a></span><div id="id_img_loader_ticketfile2" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_ticketfile2" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
<div id="id_sc_dragdrop_ticketfile2" class="scFormDataDragNDrop"  style="<?php echo $sStyleReadInp_ticketfile2 ?>"><i class='fas fa-cloud-upload-alt'></i><br/>
<?php echo $this->Ini->Nm_lang['lang_errm_mu_dragfile'] ?></div>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ticketfile3']))
    {
        $this->nm_new_label['ticketfile3'] = "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_ticketfile3'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ticketfile3 = $this->ticketfile3;
   $ticketfilename3 = $this->ticketfilename3;
   $sStyleHidden_ticketfile3 = '';
   if (isset($this->nmgp_cmp_hidden['ticketfile3']) && $this->nmgp_cmp_hidden['ticketfile3'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ticketfile3']);
       $sStyleHidden_ticketfile3 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ticketfile3 = 'display: none;';
   $sStyleReadInp_ticketfile3 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ticketfile3']) && $this->nmgp_cmp_readonly['ticketfile3'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ticketfile3']);
       $sStyleReadLab_ticketfile3 = '';
       $sStyleReadInp_ticketfile3 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ticketfile3']) && $this->nmgp_cmp_hidden['ticketfile3'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ticketfile3" value="<?php echo $this->form_encode_input($ticketfile3) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ticketfile3_line" id="hidden_field_data_ticketfile3" style="<?php echo $sStyleHidden_ticketfile3; ?>"> 
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ticketfile3"]) &&  $this->nmgp_cmp_readonly["ticketfile3"] == "on") { 

 ?>
<input type="hidden" name="ticketfile3" value=""><img id=\"ticketfile3_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><span id=\"id_ajax_doc_ticketfile3\"><a href=\"javascript:nm_mostra_doc('documento_db', '" . str_replace("'", "\'", trim($ticketfilename3)) . "', 'form_operator_response')\">" . $ticketfilename3"</a></span>"; ?>
<?php } else { ?>
<span id="id_read_on_ticketfile3" class="scFormLinkOdd sc-ui-readonly-ticketfile3 css_ticketfile3_line" style="<?php echo $sStyleReadLab_ticketfile3; ?>"><?php echo $this->form_format_readonly("ticketfilename3", $ticketfilename3) ?></span><span id="id_read_off_ticketfile3" class="css_read_off_ticketfile3" style="white-space: nowrap;<?php echo $sStyleReadInp_ticketfile3; ?>"><span style="display:inline-block"><span id="sc-id-upload-select-ticketfile3" class="fileinput-button fileinput-button-padding scButton_default">
 <span><?php echo $this->Ini->Nm_lang['lang_select_file'] ?></span>

 <input class="sc-js-input scFormObjectOdd css_ticketfile3_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" title="<?php echo $this->Ini->Nm_lang['lang_select_file'] ?>" type="file" name="ticketfile3[]" id="id_sc_field_ticketfile3" ></span></span>
<?php
   $sCheckInsert = "";
?>
<span id="chk_ajax_img_ticketfile3"<?php if ($this->nmgp_opcao == "novo" || empty($ticketfile3)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="ticketfile3_limpa" value="<?php echo $ticketfile3_limpa . '" '; if ($ticketfile3_limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};<?php echo $sCheckInsert ?>"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="ticketfile3_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><span id="id_ajax_doc_ticketfile3"><a href="javascript:nm_mostra_doc('documento_db', '<?php echo str_replace("'", "\'", substr($sTmpFile_ticketfilename3, 3)) ;?>', 'form_operator_response')"><?php echo $ticketfilename3 ?></a></span><div id="id_img_loader_ticketfile3" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_ticketfile3" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
<div id="id_sc_dragdrop_ticketfile3" class="scFormDataDragNDrop"  style="<?php echo $sStyleReadInp_ticketfile3 ?>"><i class='fas fa-cloud-upload-alt'></i><br/>
<?php echo $this->Ini->Nm_lang['lang_errm_mu_dragfile'] ?></div>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_2"></a>
<div id="div_hidden_bloco_2" style="display: none; width: 1px; height: 0px; overflow: scroll"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['messagenote']))
    {
        $this->nm_new_label['messagenote'] = "" . $this->Ini->Nm_lang['lang_ticketmessage_fild_messagenote'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $messagenote = $this->messagenote;
   $sStyleHidden_messagenote = '';
   if (isset($this->nmgp_cmp_hidden['messagenote']) && $this->nmgp_cmp_hidden['messagenote'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['messagenote']);
       $sStyleHidden_messagenote = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_messagenote = 'display: none;';
   $sStyleReadInp_messagenote = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['messagenote']) && $this->nmgp_cmp_readonly['messagenote'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['messagenote']);
       $sStyleReadLab_messagenote = '';
       $sStyleReadInp_messagenote = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['messagenote']) && $this->nmgp_cmp_hidden['messagenote'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="messagenote" value="<?php echo $this->form_encode_input($messagenote) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_messagenote_line" id="hidden_field_data_messagenote" style="<?php echo $sStyleHidden_messagenote; ?>"> <span id="id_read_on_messagenote" style="<?php echo $sStyleReadLab_messagenote; ?>"><?php echo $this->form_format_readonly("messagenote", sc_strip_script($this->messagenote)); ?></span><span id="id_read_off_messagenote" class="css_read_off_messagenote" style="<?php echo $sStyleReadInp_messagenote; ?>"><textarea id="messagenote" name="messagenote" cols="50" rows="10" class="mceEditor_messagenote" style="width: 100%; height:300px;"><?php echo $this->form_encode_input($this->messagenote); ?></textarea>
</span> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






</TABLE></div><!-- bloco_f -->
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] != "R")
{
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['insert'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bincluir", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_ins_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label'][''];
        }
?>
<?php
if (is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Img_sep_form))
{
    if (isset($NM_btn) && $NM_btn)
    {
        $NM_btn = false;
        $NM_ult_sep = "NM_sep_1";
        echo "<img id=\"NM_sep_1\" class=\"NM_toolbar_sep\" style=\"vertical-align: middle\" src=\"" . $this->Ini->path_botoes . $this->Ini->Img_sep_form . "\" />";
    }
}
?>
 
<?php
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['run_iframe'] != "R")
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
<?php
      $Tzone = ini_get('date.timezone');
      if (empty($Tzone))
      {
?>
<script> 
  _scAjaxShowMessage({title: '', message: "<?php echo $this->Ini->Nm_lang['lang_errm_tz']; ?>", isModal: false, timeout: 0, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: true, showBodyIcon: false, isToast: false, toastPos: ""});
</script> 
<?php
      }
?>
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0,1,2);
  $nm_sc_blocos_aba    = array(0 => 0,1 => 0,2 => 0);
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_operator_response");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_operator_response");
 parent.scAjaxDetailHeight("form_operator_response", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_operator_response", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_operator_response", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['sc_modal'])
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
		if ($("#sc_b_new_b.sc-unique-btn-1").length && $("#sc_b_new_b.sc-unique-btn-1").is(":visible")) {
		    if ($("#sc_b_new_b.sc-unique-btn-1").hasClass("disabled")) {
		        return;
		    }
			nm_move ('novo');
			 return;
		}
		if ($("#sc_b_ins_b.sc-unique-btn-2").length && $("#sc_b_ins_b.sc-unique-btn-2").is(":visible")) {
		    if ($("#sc_b_ins_b.sc-unique-btn-2").hasClass("disabled")) {
		        return;
		    }
			nm_atualiza ('incluir');
			 return;
		}
	}
	function scBtnFn_sys_separator() {
		if ($("#sys_separator.sc-unique-btn-3").length && $("#sys_separator.sc-unique-btn-3").is(":visible")) {
		    if ($("#sys_separator.sc-unique-btn-3").hasClass("disabled")) {
		        return;
		    }
			return false;
			 return;
		}
	}
	function scBtnFn_sys_format_hlp() {
		if ($("#sc_b_hlp_b").length && $("#sc_b_hlp_b").is(":visible")) {
		    if ($("#sc_b_hlp_b").hasClass("disabled")) {
		        return;
		    }
			window.open('<?php echo $this->url_webhelp; ?>', '', 'resizable, scrollbars'); 
			 return;
		}
	}
	function scBtnFn_sys_format_sai() {
		if ($("#sc_b_sai_b.sc-unique-btn-4").length && $("#sc_b_sai_b.sc-unique-btn-4").is(":visible")) {
		    if ($("#sc_b_sai_b.sc-unique-btn-4").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
			 return;
		}
		if ($("#sc_b_sai_b.sc-unique-btn-5").length && $("#sc_b_sai_b.sc-unique-btn-5").is(":visible")) {
		    if ($("#sc_b_sai_b.sc-unique-btn-5").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
			 return;
		}
		if ($("#sc_b_sai_b.sc-unique-btn-6").length && $("#sc_b_sai_b.sc-unique-btn-6").is(":visible")) {
		    if ($("#sc_b_sai_b.sc-unique-btn-6").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
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
<iframe id="sc-id-download-iframe" name="sc_name_download_iframe" style="display: none"></iframe>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_operator_response']['buttonStatus'] = $this->nmgp_botoes;
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
