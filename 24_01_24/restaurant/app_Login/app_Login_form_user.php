<!DOCTYPE html>
<html lang="en">
    <head>
        <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
        <title><?php echo $this->Ini->Nm_lang['lang_index_title']; ?></title>
        <link rel="stylesheet" type="text/css" href="../_lib/libraries/grp/pizzahouse/login/css/login.css">
        <link rel="stylesheet" type="text/css" href="../_lib/libraries/grp/pizzahouse/libs/css/styles.css">
        <style>
        span.sc-ui-pwd-toggle-icon {
            position: relative;
            display: inline-block;
            cursor: pointer;
            right: 0.5rem;
            z-index: 2;
            float: right;
            bottom: 1.7rem;
        }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="page-sidebar page-background bg-half-img" style="background-image:url('../_lib/libraries/grp/pizzahouse/login/img/bg.jpg');background-size:100%;">
        <div class="page">
            <div class="container">
                <div class="grid">
                    <div class="col-7">
                        <div class="content">
                            <h1>
                                <?php echo $this->Ini->Nm_lang['lang_index_title']; ?>
                            </h1>
                            <p>
                                <?php echo $this->Ini->Nm_lang['lang_index_description']; ?>
                            </p>
                            <p>
                               <a class="button button-block" href="../grid_menu_category/" title="View Our Menu" target="_blank"><?php echo $this->Ini->Nm_lang['lang_index_view_menu']; ?></a>
                            </p>
                        </div>
                    </div>
                    <div class="col-1">
                    </div>
                    <div class="col-4">
                        <form class="form half-size" action=""  name="F1" method="post" 
               action="./" 
               target="_self">
                            <input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($nmgp_url_saida); ?>">
<input type="hidden" name="bok" value="OK">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" />

                            <h2>
                                <?php echo $this->Ini->Nm_lang['lang_index_sign_in']; ?>
                            </h2>
                            <div class="control">
                                <label class="label" for="name"><?php echo $this->Ini->Nm_lang['lang_sec_users_fld_login']; ?></label>
                                <input class="input  sc-js-input "  name="login" id="id_sc_field_login" value="<?php echo $this->form_encode_input($login) ?>"  alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: true, autoTab: false, selectOnFocus: false, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"  type="text" placeholder="Name" name="name">
                            </div>
                            <div class="control">
                                <label class="label" for="pass"><?php echo $this->Ini->Nm_lang['lang_sec_users_fld_pswd']; ?></label>
                                <div class="scFormObjectOddPwdBox">
                                <input class="input  sc-js-input "  name="pswd" id="id_sc_field_pswd" value="<?php echo $this->form_encode_input($pswd) ?>"  alt="{datatype: 'text', maxLength: 32, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: true, autoTab: false, selectOnFocus: false, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"  type="password" placeholder="Password" name="pass">
                                <span id="id_pwd_show_hide_pswd" class="sc-ui-pwd-toggle-icon"><i class="fa fa-eye sc-ui-pwd-eye" aria-hidden="true" id="id_pwd_fa_pswd"></i></span></div>
                            </div>
                            <!--SC_REQUIRED_MSG-->
							<div class="flag-lang">
								<a class="flags" href="../app_Login/app_Login.php?lang=en"><img src="../_lib/libraries/grp/pizzahouse/login/img/en_us.png"></a>
								<a class="flags" href="../app_Login/app_Login.php?lang=pt"><img src="../_lib/libraries/grp/pizzahouse/login/img/pt_br.png"></a>
								<a class="flags" href="../app_Login/app_Login.php?lang=es"><img src="../_lib/libraries/grp/pizzahouse/login/img/es_es.png"></a>
							</div>
                            <!--SC_CAPTCHA-->
                            <div class="submit">
                                <input class="button" type="button" value="<?php echo $this->Ini->Nm_lang['lang_index_sign_in']; ?>"  onclick="nm_atualiza('alterar');"  />
                            </div>
                            <input type="hidden" name="links" value = "">
<input type="hidden" name="links_sc_target_name" value = "">
<div id="id-links-1" class="class-links ">
 <a href="javascript:nm_menu_link_links('app_retrieve_pswd', '_self')"><?php echo $this->Ini->Nm_lang['lang_subject_mail'] ?></a>
</div>							
							<hr style="margin: 25px 0 20px;">
							<div id='message'>
								<p style='color:#333; font-size:12px; font-weight:bold;margin: 5px 0;'><?php echo $this->Ini->Nm_lang['lang_sec_users_fild_login']; ?></p>
								<p style="margin: 0px;font-size: 12px;"><?php echo $this->Ini->Nm_lang['lang_admin']; ?>: admin | <?php echo $this->Ini->Nm_lang['lang_tb_orders_fld_user_login']; ?>: user1 | <?php echo $this->Ini->Nm_lang['lang_kitchen']; ?>: user2</p>
								<p style='color:#333; font-size:12px; font-weight:bold;margin: 5px 0;'><?php echo $this->Ini->Nm_lang['lang_sec_users_fild_pswd']; ?></p>
								<p style="margin: 0px;font-size: 12px;">admin </p>
							</div>
                        </form>
						
                    </div>
                </div>
            </div>
        </div>
        
        <div class="alert-message negative">
            <span class="message"></span>
            <span class="close">&times;</span>
        </div>
		<div class="copyright">
			<p><?php echo $this->Ini->Nm_lang['lang_page_copyright']; ?></p>
		</div>
        
         <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
  var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_userSweetAlertDisplayed = false;
 </SCRIPT>
        <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod; ?>/third/font-awesome/6/css/all.min.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("app_Login_sajax_js.php");
?>
<script type="text/javascript">
var Nm_Proc_Atualiz = false;
</script>
<script type="text/javascript">
<?php

include_once('app_Login_jquery.php');

?>
</script>
<script type="text/javascript">
 $(function() {
  scJQElementsAdd('');
  scJQGeneralAdd();
<?php
if (!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName)
{
?>
  scFocusField('login');

<?php
}
?>
 });

</script>
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
 include_once("app_Login_js0.php");
?>
<script type="text/javascript"> function setLocale(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_idioma_novo.value = sLocale;
 }
</script><?php
$msgDefClose = isset($this->arr_buttons['bmessageclose']) ? $this->arr_buttons['bmessageclose']['value'] : 'Ok';
?>
<script type="text/javascript">
var scMsgDefTitle = "<?php if (isset($this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'])) {echo $this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'];} ?>";
var scMsgDefButton = "Ok";
var scMsgDefClose = "<?php echo $msgDefClose; ?>";
var scMsgDefClick = "close";
var scMsgDefScInit = "<?php echo $this->Ini->sc_page; ?>";
</script>
<script type='text/javascript'>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['sc_modal'])
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
$sIconTitle = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
$sErrorIcon = (isset($_SESSION['scriptcase']['error_icon']['app_Login']) && '' != $_SESSION['scriptcase']['error_icon']['app_Login']) ? $_SESSION['scriptcase']['error_icon']['app_Login']  : "";
$sCloseIcon = (isset($_SESSION['scriptcase']['error_close']['app_Login']) && '' != trim($_SESSION['scriptcase']['error_close']['app_Login'])) ? $_SESSION['scriptcase']['error_close']['app_Login'] : "<td><input class=\"scButton_default\" type=\"button\" onClick=\"document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false\" value=\"X\" /></td>";
if ('' != $sIconTitle && '' != $sErrorIcon) {
    $sErrorIcon = '';
}
?>
<script type="text/javascript">
$(function() {
    $(document.F1).on("submit", function (e) {
        e.preventDefault();
    });
});

if (typeof scDisplayUserError === "undefined") {
    function scDisplayUserError(errorMessage) {
        scJs_alert("ERROR:\r\n" + errorMessage.replace(/<br \/>/gi, "<!--SC_NL-->"), function() {}, {type: "error"});
    }
}
if (typeof scDisplayUserDebug === "undefined") {
    function scDisplayUserDebug(debugMessage) {
        scJs_alert("DEBUG:\r\n" + debugMessage.replace(/<br \/>/gi, "<!--SC_NL-->"), function() {}, {type: "warning"});
    }
}
if (typeof scDisplayUserMessage === "undefined") {
    function scDisplayUserMessage(userMessage) {
        scJs_alert("MESSAGE:\r\n" + userMessage.replace(/<br \/>/gi, "<!--SC_NL-->"), function() {}, {type: "info"});
    }
}
</script>

<script>
$(function() {
<?php
if (isset($this->nmgp_cmp_hidden) && !empty($this->nmgp_cmp_hidden)) {
    foreach($this->nmgp_cmp_hidden as $fieldDisplayFieldName => $fieldDisplayFieldStatus) {
        if ('on' == $fieldDisplayFieldStatus) {
?>
if (typeof scShowUserField === "function") {
    scShowUserField("<?php echo $fieldDisplayFieldName ?>");
}
<?php
        }
        if ('off' == $fieldDisplayFieldStatus) {
?>
if (typeof scHideUserField === "function") {
    scHideUserField("<?php echo $fieldDisplayFieldName ?>");
}
<?php
        }
    }
}
?>
});
</script>

        <script type="text/javascript" src="../_lib/libraries/grp/pizzahouse/libs/js/error.js"></script>
    </body>
</html>