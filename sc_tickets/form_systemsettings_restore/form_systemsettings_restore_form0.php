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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - " . $this->Ini->Nm_lang['lang_tble_systemsettings'] . ""); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - " . $this->Ini->Nm_lang['lang_tble_systemsettings'] . ""); } ?></TITLE>
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_systemsettings_restore/form_systemsettings_restore_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_systemsettings_restore_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_systemsettings_restore_jquery.php');

?>

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  $("#hidden_bloco_0,#hidden_bloco_1").each(function() {
   $(this.rows[0]).bind("click", {block: this}, toggleBlock)
                  .mouseover(function() { $(this).css("cursor", "pointer"); })
                  .mouseout(function() { $(this).css("cursor", ""); });
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
   });
 if($(".sc-ui-block-control").length) {
  preloadBlock = new Image();
  preloadBlock.src = "<?php echo $this->Ini->path_icones; ?>/" + sc_blockExp;
 }

 var show_block = {
    "hidden_bloco_0": true,
    "hidden_bloco_1": true
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['link_info']['remove_border']) {
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
 include_once("form_systemsettings_restore_js0.php");
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
               action="form_systemsettings_restore.php" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_systemsettings_restore'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_systemsettings_restore'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="600">
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "R")
{
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['update'];
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
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="2" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf0\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?><?php echo $this->Ini->Nm_lang['lang_block_general'] ?><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>
   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['companyname']))
    {
        $this->nm_new_label['companyname'] = "" . $this->Ini->Nm_lang['lang_systemsettings_fild_companyname'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $companyname = $this->companyname;
   $sStyleHidden_companyname = '';
   if (isset($this->nmgp_cmp_hidden['companyname']) && $this->nmgp_cmp_hidden['companyname'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['companyname']);
       $sStyleHidden_companyname = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_companyname = 'display: none;';
   $sStyleReadInp_companyname = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['companyname']) && $this->nmgp_cmp_readonly['companyname'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['companyname']);
       $sStyleReadLab_companyname = '';
       $sStyleReadInp_companyname = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['companyname']) && $this->nmgp_cmp_hidden['companyname'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="companyname" value="<?php echo $this->form_encode_input($companyname) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_companyname_label" id="hidden_field_label_companyname" style="<?php echo $sStyleHidden_companyname; ?>"><span id="id_label_companyname"><?php echo $this->nm_new_label['companyname']; ?></span></TD>
    <TD class="scFormDataOdd css_companyname_line" id="hidden_field_data_companyname" style="<?php echo $sStyleHidden_companyname; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["companyname"]) &&  $this->nmgp_cmp_readonly["companyname"] == "on") { 

 ?>
<input type="hidden" name="companyname" value="<?php echo $this->form_encode_input($companyname) . "\">" . $companyname . ""; ?>
<?php } else { ?>
<span id="id_read_on_companyname" class="sc-ui-readonly-companyname css_companyname_line" style="<?php echo $sStyleReadLab_companyname; ?>"><?php echo $this->form_format_readonly("companyname", $this->form_encode_input($this->companyname)); ?></span><span id="id_read_off_companyname" class="css_read_off_companyname<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_companyname; ?>">
 <input class="sc-js-input scFormObjectOdd css_companyname_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_companyname" type=text name="companyname" value="<?php echo $this->form_encode_input($companyname) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: false, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['assigmentmode']))
   {
       $this->nm_new_label['assigmentmode'] = "" . $this->Ini->Nm_lang['lang_systemsettings_fild_assigmentmode'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $assigmentmode = $this->assigmentmode;
   $sStyleHidden_assigmentmode = '';
   if (isset($this->nmgp_cmp_hidden['assigmentmode']) && $this->nmgp_cmp_hidden['assigmentmode'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['assigmentmode']);
       $sStyleHidden_assigmentmode = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_assigmentmode = 'display: none;';
   $sStyleReadInp_assigmentmode = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['assigmentmode']) && $this->nmgp_cmp_readonly['assigmentmode'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['assigmentmode']);
       $sStyleReadLab_assigmentmode = '';
       $sStyleReadInp_assigmentmode = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['assigmentmode']) && $this->nmgp_cmp_hidden['assigmentmode'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="assigmentmode" value="<?php echo $this->form_encode_input($this->assigmentmode) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_assigmentmode_label" id="hidden_field_label_assigmentmode" style="<?php echo $sStyleHidden_assigmentmode; ?>"><span id="id_label_assigmentmode"><?php echo $this->nm_new_label['assigmentmode']; ?></span></TD>
    <TD class="scFormDataOdd css_assigmentmode_line" id="hidden_field_data_assigmentmode" style="<?php echo $sStyleHidden_assigmentmode; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["assigmentmode"]) &&  $this->nmgp_cmp_readonly["assigmentmode"] == "on") { 
?>
<input type="hidden" name="assigmentmode" value="<?php echo $this->form_encode_input($assigmentmode) . "\">" . $assigmentmode_look . ""; ?>
<?php } else { ?>
<?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['publicticketsopening']))
    {
        $this->nm_new_label['publicticketsopening'] = "" . $this->Ini->Nm_lang['lang_systemsettings_fild_publicticketsopening'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $publicticketsopening = $this->publicticketsopening;
   $sStyleHidden_publicticketsopening = '';
   if (isset($this->nmgp_cmp_hidden['publicticketsopening']) && $this->nmgp_cmp_hidden['publicticketsopening'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['publicticketsopening']);
       $sStyleHidden_publicticketsopening = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_publicticketsopening = 'display: none;';
   $sStyleReadInp_publicticketsopening = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['publicticketsopening']) && $this->nmgp_cmp_readonly['publicticketsopening'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['publicticketsopening']);
       $sStyleReadLab_publicticketsopening = '';
       $sStyleReadInp_publicticketsopening = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['publicticketsopening']) && $this->nmgp_cmp_hidden['publicticketsopening'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="publicticketsopening" value="<?php echo $this->form_encode_input($publicticketsopening) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_publicticketsopening_label" id="hidden_field_label_publicticketsopening" style="<?php echo $sStyleHidden_publicticketsopening; ?>"><span id="id_label_publicticketsopening"><?php echo $this->nm_new_label['publicticketsopening']; ?></span></TD>
    <TD class="scFormDataOdd css_publicticketsopening_line" id="hidden_field_data_publicticketsopening" style="<?php echo $sStyleHidden_publicticketsopening; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["publicticketsopening"]) &&  $this->nmgp_cmp_readonly["publicticketsopening"] == "on") { 
?>
<input type="hidden" name="publicticketsopening" value="<?php echo $this->form_encode_input($publicticketsopening) . "\">" . $publicticketsopening_look . ""; ?>
<?php } else { ?>
<?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['defaultpriority']))
   {
       $this->nm_new_label['defaultpriority'] = "" . $this->Ini->Nm_lang['lang_fld_systemsetings_def_pri'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $defaultpriority = $this->defaultpriority;
   $sStyleHidden_defaultpriority = '';
   if (isset($this->nmgp_cmp_hidden['defaultpriority']) && $this->nmgp_cmp_hidden['defaultpriority'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['defaultpriority']);
       $sStyleHidden_defaultpriority = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_defaultpriority = 'display: none;';
   $sStyleReadInp_defaultpriority = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['defaultpriority']) && $this->nmgp_cmp_readonly['defaultpriority'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['defaultpriority']);
       $sStyleReadLab_defaultpriority = '';
       $sStyleReadInp_defaultpriority = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['defaultpriority']) && $this->nmgp_cmp_hidden['defaultpriority'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="defaultpriority" value="<?php echo $this->form_encode_input($this->defaultpriority) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_defaultpriority_label" id="hidden_field_label_defaultpriority" style="<?php echo $sStyleHidden_defaultpriority; ?>"><span id="id_label_defaultpriority"><?php echo $this->nm_new_label['defaultpriority']; ?></span></TD>
    <TD class="scFormDataOdd css_defaultpriority_line" id="hidden_field_data_defaultpriority" style="<?php echo $sStyleHidden_defaultpriority; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["defaultpriority"]) &&  $this->nmgp_cmp_readonly["defaultpriority"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['Lookup_defaultpriority']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['Lookup_defaultpriority'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['Lookup_defaultpriority']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['Lookup_defaultpriority'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['Lookup_defaultpriority']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['Lookup_defaultpriority'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['Lookup_defaultpriority']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['Lookup_defaultpriority'] = array(); 
    }

   $old_value_id = $this->id;
   $this->nm_tira_formatacao();


   $unformatted_value_id = $this->id;

   $smtpsecurityflag_val_str = "''";
   if (!empty($this->smtpsecurityflag))
   {
       if (is_array($this->smtpsecurityflag))
       {
           $Tmp_array = $this->smtpsecurityflag;
       }
       else
       {
           $Tmp_array = explode(";", $this->smtpsecurityflag);
       }
       $smtpsecurityflag_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $smtpsecurityflag_val_str)
          {
             $smtpsecurityflag_val_str .= ", ";
          }
          $smtpsecurityflag_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "select ticketpriorityid, priorityname  from ticketpriority  order by priorityname";

   $this->id = $old_value_id;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['Lookup_defaultpriority'][] = $rs->fields[0];
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
   $defaultpriority_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->defaultpriority_1))
          {
              foreach ($this->defaultpriority_1 as $tmp_defaultpriority)
              {
                  if (trim($tmp_defaultpriority) === trim($cadaselect[1])) {$defaultpriority_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->defaultpriority) && trim($this->defaultpriority) === trim($cadaselect[1])) {$defaultpriority_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="defaultpriority" value="<?php echo $this->form_encode_input($defaultpriority) . "\">" . $defaultpriority_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_defaultpriority();
   $x = 0 ; 
   $defaultpriority_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->defaultpriority_1))
          {
              foreach ($this->defaultpriority_1 as $tmp_defaultpriority)
              {
                  if (trim($tmp_defaultpriority) === trim($cadaselect[1])) {$defaultpriority_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->defaultpriority) && trim($this->defaultpriority) === trim($cadaselect[1])) { $defaultpriority_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($defaultpriority_look))
          {
              $defaultpriority_look = $this->defaultpriority;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_defaultpriority\" class=\"css_defaultpriority_line\" style=\"" .  $sStyleReadLab_defaultpriority . "\">" . $this->form_format_readonly("defaultpriority", $this->form_encode_input($defaultpriority_look)) . "</span><span id=\"id_read_off_defaultpriority\" class=\"css_read_off_defaultpriority" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_defaultpriority . "\">";
   echo " <span id=\"idAjaxSelect_defaultpriority\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_defaultpriority_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_defaultpriority\" name=\"defaultpriority\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->defaultpriority) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->defaultpriority)) 
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


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['urltrackingscreen']))
    {
        $this->nm_new_label['urltrackingscreen'] = "" . $this->Ini->Nm_lang['lang_systemsettings_fild_urltrackingscreen'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $urltrackingscreen = $this->urltrackingscreen;
   $sStyleHidden_urltrackingscreen = '';
   if (isset($this->nmgp_cmp_hidden['urltrackingscreen']) && $this->nmgp_cmp_hidden['urltrackingscreen'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['urltrackingscreen']);
       $sStyleHidden_urltrackingscreen = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_urltrackingscreen = 'display: none;';
   $sStyleReadInp_urltrackingscreen = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['urltrackingscreen']) && $this->nmgp_cmp_readonly['urltrackingscreen'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['urltrackingscreen']);
       $sStyleReadLab_urltrackingscreen = '';
       $sStyleReadInp_urltrackingscreen = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['urltrackingscreen']) && $this->nmgp_cmp_hidden['urltrackingscreen'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="urltrackingscreen" value="<?php echo $this->form_encode_input($urltrackingscreen) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_urltrackingscreen_label" id="hidden_field_label_urltrackingscreen" style="<?php echo $sStyleHidden_urltrackingscreen; ?>"><span id="id_label_urltrackingscreen"><?php echo $this->nm_new_label['urltrackingscreen']; ?></span></TD>
    <TD class="scFormDataOdd css_urltrackingscreen_line" id="hidden_field_data_urltrackingscreen" style="<?php echo $sStyleHidden_urltrackingscreen; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["urltrackingscreen"]) &&  $this->nmgp_cmp_readonly["urltrackingscreen"] == "on") { 

 ?>
<input type="hidden" name="urltrackingscreen" value="<?php echo $this->form_encode_input($urltrackingscreen) . "\">" . $urltrackingscreen . ""; ?>
<?php } else { ?>
<span id="id_read_on_urltrackingscreen" class="sc-ui-readonly-urltrackingscreen css_urltrackingscreen_line" style="<?php echo $sStyleReadLab_urltrackingscreen; ?>"><?php echo $this->form_format_readonly("urltrackingscreen", $this->form_encode_input($this->urltrackingscreen)); ?></span><span id="id_read_off_urltrackingscreen" class="css_read_off_urltrackingscreen<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_urltrackingscreen; ?>">
 <input class="sc-js-input scFormObjectOdd css_urltrackingscreen_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_urltrackingscreen" type=text name="urltrackingscreen" value="<?php echo $this->form_encode_input($urltrackingscreen) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: false, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['urlconfirmationscreen']))
    {
        $this->nm_new_label['urlconfirmationscreen'] = "" . $this->Ini->Nm_lang['lang_fld_confim_account'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $urlconfirmationscreen = $this->urlconfirmationscreen;
   $sStyleHidden_urlconfirmationscreen = '';
   if (isset($this->nmgp_cmp_hidden['urlconfirmationscreen']) && $this->nmgp_cmp_hidden['urlconfirmationscreen'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['urlconfirmationscreen']);
       $sStyleHidden_urlconfirmationscreen = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_urlconfirmationscreen = 'display: none;';
   $sStyleReadInp_urlconfirmationscreen = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['urlconfirmationscreen']) && $this->nmgp_cmp_readonly['urlconfirmationscreen'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['urlconfirmationscreen']);
       $sStyleReadLab_urlconfirmationscreen = '';
       $sStyleReadInp_urlconfirmationscreen = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['urlconfirmationscreen']) && $this->nmgp_cmp_hidden['urlconfirmationscreen'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="urlconfirmationscreen" value="<?php echo $this->form_encode_input($urlconfirmationscreen) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_urlconfirmationscreen_label" id="hidden_field_label_urlconfirmationscreen" style="<?php echo $sStyleHidden_urlconfirmationscreen; ?>"><span id="id_label_urlconfirmationscreen"><?php echo $this->nm_new_label['urlconfirmationscreen']; ?></span></TD>
    <TD class="scFormDataOdd css_urlconfirmationscreen_line" id="hidden_field_data_urlconfirmationscreen" style="<?php echo $sStyleHidden_urlconfirmationscreen; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["urlconfirmationscreen"]) &&  $this->nmgp_cmp_readonly["urlconfirmationscreen"] == "on") { 

 ?>
<input type="hidden" name="urlconfirmationscreen" value="<?php echo $this->form_encode_input($urlconfirmationscreen) . "\">" . $urlconfirmationscreen . ""; ?>
<?php } else { ?>
<span id="id_read_on_urlconfirmationscreen" class="sc-ui-readonly-urlconfirmationscreen css_urlconfirmationscreen_line" style="<?php echo $sStyleReadLab_urlconfirmationscreen; ?>"><?php echo $this->form_format_readonly("urlconfirmationscreen", $this->form_encode_input($this->urlconfirmationscreen)); ?></span><span id="id_read_off_urlconfirmationscreen" class="css_read_off_urlconfirmationscreen<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_urlconfirmationscreen; ?>">
 <input class="sc-js-input scFormObjectOdd css_urlconfirmationscreen_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_urlconfirmationscreen" type=text name="urlconfirmationscreen" value="<?php echo $this->form_encode_input($urlconfirmationscreen) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: false, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['broadcastmessages']))
    {
        $this->nm_new_label['broadcastmessages'] = "" . $this->Ini->Nm_lang['lang_systemsettings_fild_broadcastmessages'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $broadcastmessages = $this->broadcastmessages;
   $sStyleHidden_broadcastmessages = '';
   if (isset($this->nmgp_cmp_hidden['broadcastmessages']) && $this->nmgp_cmp_hidden['broadcastmessages'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['broadcastmessages']);
       $sStyleHidden_broadcastmessages = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_broadcastmessages = 'display: none;';
   $sStyleReadInp_broadcastmessages = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['broadcastmessages']) && $this->nmgp_cmp_readonly['broadcastmessages'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['broadcastmessages']);
       $sStyleReadLab_broadcastmessages = '';
       $sStyleReadInp_broadcastmessages = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['broadcastmessages']) && $this->nmgp_cmp_hidden['broadcastmessages'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="broadcastmessages" value="<?php echo $this->form_encode_input($broadcastmessages) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_broadcastmessages_label" id="hidden_field_label_broadcastmessages" style="<?php echo $sStyleHidden_broadcastmessages; ?>"><span id="id_label_broadcastmessages"><?php echo $this->nm_new_label['broadcastmessages']; ?></span></TD>
    <TD class="scFormDataOdd css_broadcastmessages_line" id="hidden_field_data_broadcastmessages" style="<?php echo $sStyleHidden_broadcastmessages; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["broadcastmessages"]) &&  $this->nmgp_cmp_readonly["broadcastmessages"] == "on") { 
?>
<input type="hidden" name="broadcastmessages" value="<?php echo $this->form_encode_input($broadcastmessages) . "\">" . $broadcastmessages_look . ""; ?>
<?php } else { ?>
<?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['defaultlanguage']))
   {
       $this->nm_new_label['defaultlanguage'] = "" . $this->Ini->Nm_lang['lang_systemsettings_fild_defaultlanguage'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $defaultlanguage = $this->defaultlanguage;
   $tst_conf_reg = $defaultlanguage;
   $sStyleHidden_defaultlanguage = '';
   if (isset($this->nmgp_cmp_hidden['defaultlanguage']) && $this->nmgp_cmp_hidden['defaultlanguage'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['defaultlanguage']);
       $sStyleHidden_defaultlanguage = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_defaultlanguage = 'display: none;';
   $sStyleReadInp_defaultlanguage = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['defaultlanguage']) && $this->nmgp_cmp_readonly['defaultlanguage'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['defaultlanguage']);
       $sStyleReadLab_defaultlanguage = '';
       $sStyleReadInp_defaultlanguage = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['defaultlanguage']) && $this->nmgp_cmp_hidden['defaultlanguage'] == 'off') { $sc_hidden_yes++; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_defaultlanguage_label" id="hidden_field_label_defaultlanguage" style="<?php echo $sStyleHidden_defaultlanguage; ?>"><span id="id_label_defaultlanguage"><?php echo $this->nm_new_label['defaultlanguage']; ?></span></TD>
    <TD class="scFormDataOdd css_defaultlanguage_line" id="hidden_field_data_defaultlanguage" style="<?php echo $sStyleHidden_defaultlanguage; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["defaultlanguage"]) &&  $this->nmgp_cmp_readonly["defaultlanguage"] == "on") { 

 ?>
<?php echo $this->Ini->Nm_lang_conf_region[$tst_conf_reg]; ?>
<?php } else { ?>
<span id="id_read_on_defaultlanguage" class="css_defaultlanguage_line" style="<?php echo $sStyleReadLab_defaultlanguage; ?>"><?php echo $this->Ini->Nm_lang_conf_region[$tst_conf_reg]; ?></span><span id="id_read_off_defaultlanguage" class="css_read_off_defaultlanguage" style="<?php echo $sStyleReadInp_defaultlanguage; ?>">
 <span id="idAjaxSelect_defaultlanguage"><select class="sc-js-input scFormObjectOdd css_defaultlanguage_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" name="defaultlanguage" size=1 onChange="">
<?php
      foreach ($this->Ini->Nm_lang_conf_region as $cada_idioma => $cada_descr)
      {
         $tmp_idioma = explode(";", $cada_idioma);
         if (is_file($this->Ini->path_lang . $tmp_idioma[0] . ".lang.php"))
         {
             $obj_sel = ($tst_conf_reg == $cada_idioma) ? " selected" : "";
             echo "  <option value=\"" . $cada_idioma . "\"" .  $obj_sel . ">" . str_replace('<', '&lt;',$cada_descr) . "</option>";
         }
      }
?>
 </select></span>
</span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_1"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_1"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="2" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf1\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?><?php echo $this->Ini->Nm_lang['lang_block_smtp'] ?><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>
   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['emailaccount']))
    {
        $this->nm_new_label['emailaccount'] = "" . $this->Ini->Nm_lang['lang_systemsettings_fild_emailaccount'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $emailaccount = $this->emailaccount;
   $sStyleHidden_emailaccount = '';
   if (isset($this->nmgp_cmp_hidden['emailaccount']) && $this->nmgp_cmp_hidden['emailaccount'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['emailaccount']);
       $sStyleHidden_emailaccount = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_emailaccount = 'display: none;';
   $sStyleReadInp_emailaccount = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['emailaccount']) && $this->nmgp_cmp_readonly['emailaccount'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['emailaccount']);
       $sStyleReadLab_emailaccount = '';
       $sStyleReadInp_emailaccount = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['emailaccount']) && $this->nmgp_cmp_hidden['emailaccount'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="emailaccount" value="<?php echo $this->form_encode_input($emailaccount) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_emailaccount_label" id="hidden_field_label_emailaccount" style="<?php echo $sStyleHidden_emailaccount; ?>"><span id="id_label_emailaccount"><?php echo $this->nm_new_label['emailaccount']; ?></span></TD>
    <TD class="scFormDataOdd css_emailaccount_line" id="hidden_field_data_emailaccount" style="<?php echo $sStyleHidden_emailaccount; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["emailaccount"]) &&  $this->nmgp_cmp_readonly["emailaccount"] == "on") { 

 ?>
<input type="hidden" name="emailaccount" value="<?php echo $this->form_encode_input($emailaccount) . "\">" . $emailaccount . ""; ?>
<?php } else { ?>
<span id="id_read_on_emailaccount" class="sc-ui-readonly-emailaccount css_emailaccount_line" style="<?php echo $sStyleReadLab_emailaccount; ?>"><?php echo $this->form_format_readonly("emailaccount", $this->form_encode_input($this->emailaccount)); ?></span><span id="id_read_off_emailaccount" class="css_read_off_emailaccount<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_emailaccount; ?>">
 <input class="sc-js-input scFormObjectOdd css_emailaccount_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_emailaccount" type=text name="emailaccount" value="<?php echo $this->form_encode_input($emailaccount) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: false, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['smtpserver']))
    {
        $this->nm_new_label['smtpserver'] = "" . $this->Ini->Nm_lang['lang_systemsettings_fild_smtpserver'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $smtpserver = $this->smtpserver;
   $sStyleHidden_smtpserver = '';
   if (isset($this->nmgp_cmp_hidden['smtpserver']) && $this->nmgp_cmp_hidden['smtpserver'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['smtpserver']);
       $sStyleHidden_smtpserver = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_smtpserver = 'display: none;';
   $sStyleReadInp_smtpserver = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['smtpserver']) && $this->nmgp_cmp_readonly['smtpserver'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['smtpserver']);
       $sStyleReadLab_smtpserver = '';
       $sStyleReadInp_smtpserver = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['smtpserver']) && $this->nmgp_cmp_hidden['smtpserver'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="smtpserver" value="<?php echo $this->form_encode_input($smtpserver) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_smtpserver_label" id="hidden_field_label_smtpserver" style="<?php echo $sStyleHidden_smtpserver; ?>"><span id="id_label_smtpserver"><?php echo $this->nm_new_label['smtpserver']; ?></span></TD>
    <TD class="scFormDataOdd css_smtpserver_line" id="hidden_field_data_smtpserver" style="<?php echo $sStyleHidden_smtpserver; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["smtpserver"]) &&  $this->nmgp_cmp_readonly["smtpserver"] == "on") { 

 ?>
<input type="hidden" name="smtpserver" value="<?php echo $this->form_encode_input($smtpserver) . "\">" . $smtpserver . ""; ?>
<?php } else { ?>
<span id="id_read_on_smtpserver" class="sc-ui-readonly-smtpserver css_smtpserver_line" style="<?php echo $sStyleReadLab_smtpserver; ?>"><?php echo $this->form_format_readonly("smtpserver", $this->form_encode_input($this->smtpserver)); ?></span><span id="id_read_off_smtpserver" class="css_read_off_smtpserver<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_smtpserver; ?>">
 <input class="sc-js-input scFormObjectOdd css_smtpserver_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_smtpserver" type=text name="smtpserver" value="<?php echo $this->form_encode_input($smtpserver) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: false, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['smtpuser']))
    {
        $this->nm_new_label['smtpuser'] = "" . $this->Ini->Nm_lang['lang_systemsettings_fild_smtpuser'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $smtpuser = $this->smtpuser;
   $sStyleHidden_smtpuser = '';
   if (isset($this->nmgp_cmp_hidden['smtpuser']) && $this->nmgp_cmp_hidden['smtpuser'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['smtpuser']);
       $sStyleHidden_smtpuser = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_smtpuser = 'display: none;';
   $sStyleReadInp_smtpuser = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['smtpuser']) && $this->nmgp_cmp_readonly['smtpuser'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['smtpuser']);
       $sStyleReadLab_smtpuser = '';
       $sStyleReadInp_smtpuser = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['smtpuser']) && $this->nmgp_cmp_hidden['smtpuser'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="smtpuser" value="<?php echo $this->form_encode_input($smtpuser) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_smtpuser_label" id="hidden_field_label_smtpuser" style="<?php echo $sStyleHidden_smtpuser; ?>"><span id="id_label_smtpuser"><?php echo $this->nm_new_label['smtpuser']; ?></span></TD>
    <TD class="scFormDataOdd css_smtpuser_line" id="hidden_field_data_smtpuser" style="<?php echo $sStyleHidden_smtpuser; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["smtpuser"]) &&  $this->nmgp_cmp_readonly["smtpuser"] == "on") { 

 ?>
<input type="hidden" name="smtpuser" value="<?php echo $this->form_encode_input($smtpuser) . "\">" . $smtpuser . ""; ?>
<?php } else { ?>
<span id="id_read_on_smtpuser" class="sc-ui-readonly-smtpuser css_smtpuser_line" style="<?php echo $sStyleReadLab_smtpuser; ?>"><?php echo $this->form_format_readonly("smtpuser", $this->form_encode_input($this->smtpuser)); ?></span><span id="id_read_off_smtpuser" class="css_read_off_smtpuser<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_smtpuser; ?>">
 <input class="sc-js-input scFormObjectOdd css_smtpuser_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_smtpuser" type=text name="smtpuser" value="<?php echo $this->form_encode_input($smtpuser) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: false, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['smtppassword']))
    {
        $this->nm_new_label['smtppassword'] = "" . $this->Ini->Nm_lang['lang_systemsettings_fild_smtppassword'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $smtppassword = $this->smtppassword;
   $sStyleHidden_smtppassword = '';
   if (isset($this->nmgp_cmp_hidden['smtppassword']) && $this->nmgp_cmp_hidden['smtppassword'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['smtppassword']);
       $sStyleHidden_smtppassword = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_smtppassword = 'display: none;';
   $sStyleReadInp_smtppassword = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['smtppassword']) && $this->nmgp_cmp_readonly['smtppassword'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['smtppassword']);
       $sStyleReadLab_smtppassword = '';
       $sStyleReadInp_smtppassword = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['smtppassword']) && $this->nmgp_cmp_hidden['smtppassword'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="smtppassword" value="<?php echo $this->form_encode_input($smtppassword) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_smtppassword_label" id="hidden_field_label_smtppassword" style="<?php echo $sStyleHidden_smtppassword; ?>"><span id="id_label_smtppassword"><?php echo $this->nm_new_label['smtppassword']; ?></span></TD>
    <TD class="scFormDataOdd css_smtppassword_line" id="hidden_field_data_smtppassword" style="<?php echo $sStyleHidden_smtppassword; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["smtppassword"]) &&  $this->nmgp_cmp_readonly["smtppassword"] == "on") { 

 ?>
<input type="hidden" name="smtppassword" value="<?php echo $this->form_encode_input($smtppassword) . "\">" . $smtppassword . ""; ?>
<?php } else { ?>
<span id="id_read_on_smtppassword" class="sc-ui-readonly-smtppassword css_smtppassword_line" style="<?php echo $sStyleReadLab_smtppassword; ?>"><?php echo $this->form_format_readonly("smtppassword", $this->form_encode_input($this->smtppassword)); ?></span><span id="id_read_off_smtppassword" class="css_read_off_smtppassword<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_smtppassword; ?>">
 <input class="sc-js-input scFormObjectOdd css_smtppassword_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_smtppassword" type=text name="smtppassword" value="<?php echo $this->form_encode_input($smtppassword) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: false, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['smtpsecurityflag']))
   {
       $this->nm_new_label['smtpsecurityflag'] = "" . $this->Ini->Nm_lang['lang_systemsettings_fild_smtpsecurityflag'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $smtpsecurityflag = $this->smtpsecurityflag;
   $sStyleHidden_smtpsecurityflag = '';
   if (isset($this->nmgp_cmp_hidden['smtpsecurityflag']) && $this->nmgp_cmp_hidden['smtpsecurityflag'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['smtpsecurityflag']);
       $sStyleHidden_smtpsecurityflag = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_smtpsecurityflag = 'display: none;';
   $sStyleReadInp_smtpsecurityflag = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['smtpsecurityflag']) && $this->nmgp_cmp_readonly['smtpsecurityflag'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['smtpsecurityflag']);
       $sStyleReadLab_smtpsecurityflag = '';
       $sStyleReadInp_smtpsecurityflag = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['smtpsecurityflag']) && $this->nmgp_cmp_hidden['smtpsecurityflag'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="smtpsecurityflag" value="<?php echo $this->form_encode_input($this->smtpsecurityflag) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->smtpsecurityflag_1 = explode(";", trim($this->smtpsecurityflag));
  } 
  else
  {
      if (empty($this->smtpsecurityflag))
      {
          $this->smtpsecurityflag_1 = array(); 
      } 
      else
      {
          $this->smtpsecurityflag_1 = $this->smtpsecurityflag; 
          $this->smtpsecurityflag= ""; 
          foreach ($this->smtpsecurityflag_1 as $cada_smtpsecurityflag)
          {
             if (!empty($this->smtpsecurityflag))
             {
                 $this->smtpsecurityflag.= ";"; 
             } 
             $this->smtpsecurityflag.= $cada_smtpsecurityflag; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_smtpsecurityflag_label" id="hidden_field_label_smtpsecurityflag" style="<?php echo $sStyleHidden_smtpsecurityflag; ?>"><span id="id_label_smtpsecurityflag"><?php echo $this->nm_new_label['smtpsecurityflag']; ?></span></TD>
    <TD class="scFormDataOdd css_smtpsecurityflag_line" id="hidden_field_data_smtpsecurityflag" style="<?php echo $sStyleHidden_smtpsecurityflag; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["smtpsecurityflag"]) &&  $this->nmgp_cmp_readonly["smtpsecurityflag"] == "on") { 
?>
<input type="hidden" name="smtpsecurityflag" value="<?php echo $this->form_encode_input($smtpsecurityflag) . "\">" . $smtpsecurityflag_look . ""; ?>
<?php } else { ?>
<?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['id']))
           {
               $this->nmgp_cmp_readonly['id'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['smtpport']))
    {
        $this->nm_new_label['smtpport'] = "" . $this->Ini->Nm_lang['lang_systemsettings_fild_smtpport'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $smtpport = $this->smtpport;
   $sStyleHidden_smtpport = '';
   if (isset($this->nmgp_cmp_hidden['smtpport']) && $this->nmgp_cmp_hidden['smtpport'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['smtpport']);
       $sStyleHidden_smtpport = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_smtpport = 'display: none;';
   $sStyleReadInp_smtpport = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['smtpport']) && $this->nmgp_cmp_readonly['smtpport'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['smtpport']);
       $sStyleReadLab_smtpport = '';
       $sStyleReadInp_smtpport = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['smtpport']) && $this->nmgp_cmp_hidden['smtpport'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="smtpport" value="<?php echo $this->form_encode_input($smtpport) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_smtpport_label" id="hidden_field_label_smtpport" style="<?php echo $sStyleHidden_smtpport; ?>"><span id="id_label_smtpport"><?php echo $this->nm_new_label['smtpport']; ?></span></TD>
    <TD class="scFormDataOdd css_smtpport_line" id="hidden_field_data_smtpport" style="<?php echo $sStyleHidden_smtpport; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["smtpport"]) &&  $this->nmgp_cmp_readonly["smtpport"] == "on") { 

 ?>
<input type="hidden" name="smtpport" value="<?php echo $this->form_encode_input($smtpport) . "\">" . $smtpport . ""; ?>
<?php } else { ?>
<span id="id_read_on_smtpport" class="sc-ui-readonly-smtpport css_smtpport_line" style="<?php echo $sStyleReadLab_smtpport; ?>"><?php echo $this->form_format_readonly("smtpport", $this->form_encode_input($this->smtpport)); ?></span><span id="id_read_off_smtpport" class="css_read_off_smtpport<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_smtpport; ?>">
 <input class="sc-js-input scFormObjectOdd css_smtpport_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_smtpport" type=text name="smtpport" value="<?php echo $this->form_encode_input($smtpport) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: false, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id']))
    {
        $this->nm_new_label['id'] = "Id";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id = $this->id;
   $sStyleHidden_id = '';
   if (isset($this->nmgp_cmp_hidden['id']) && $this->nmgp_cmp_hidden['id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id']);
       $sStyleHidden_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id = 'display: none;';
   $sStyleReadInp_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["id"]) &&  $this->nmgp_cmp_readonly["id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id']);
       $sStyleReadLab_id = '';
       $sStyleReadInp_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id']) && $this->nmgp_cmp_hidden['id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id" value="<?php echo $this->form_encode_input($id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_label" id="hidden_field_label_id" style="<?php echo $sStyleHidden_id; ?>"><span id="id_label_id"><?php echo $this->nm_new_label['id']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['php_cmp_required']['id']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['php_cmp_required']['id'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_id_line" id="hidden_field_data_id" style="<?php echo $sStyleHidden_id; ?>">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["id"]) &&  $this->nmgp_cmp_readonly["id"] == "on")) { 

 ?>
<input type="hidden" name="id" value="<?php echo $this->form_encode_input($id) . "\"><span id=\"id_ajax_label_id\">" . $id . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_id" class="sc-ui-readonly-id css_id_line" style="<?php echo $sStyleReadLab_id; ?>"><?php echo $this->form_format_readonly("id", $this->form_encode_input($this->id)); ?></span><span id="id_read_off_id" class="css_read_off_id<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_id; ?>">
 <input class="sc-js-input scFormObjectOdd css_id_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_id" type=text name="id" value="<?php echo $this->form_encode_input($id) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=13"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['id']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['id']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['id']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: false, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "R")
{
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['run_iframe'] != "R")
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
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0,1);

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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_systemsettings_restore");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_systemsettings_restore");
 parent.scAjaxDetailHeight("form_systemsettings_restore", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_systemsettings_restore", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_systemsettings_restore", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['sc_modal'])
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
		if ($("#sc_b_sai_t.sc-unique-btn-1").length && $("#sc_b_sai_t.sc-unique-btn-1").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-1").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
			 return;
		}
		if ($("#sc_b_sai_t.sc-unique-btn-2").length && $("#sc_b_sai_t.sc-unique-btn-2").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-2").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
			 return;
		}
		if ($("#sc_b_sai_t.sc-unique-btn-3").length && $("#sc_b_sai_t.sc-unique-btn-3").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-3").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
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
	function scBtnFn_sys_format_ini() {
		if ($("#sc_b_ini_b.sc-unique-btn-5").length && $("#sc_b_ini_b.sc-unique-btn-5").is(":visible")) {
		    if ($("#sc_b_ini_b.sc-unique-btn-5").hasClass("disabled")) {
		        return;
		    }
			nm_move ('inicio');
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_systemsettings_restore']['buttonStatus'] = $this->nmgp_botoes;
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
