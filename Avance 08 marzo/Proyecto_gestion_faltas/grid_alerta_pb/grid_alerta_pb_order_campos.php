<?php
   include_once('grid_alerta_pb_session.php');
   session_start();
   $_SESSION['scriptcase']['grid_alerta_pb']['glo_nm_path_imag_temp']  = "/scriptcase/tmp";
   //check tmp
   if(empty($_SESSION['scriptcase']['grid_alerta_pb']['glo_nm_path_imag_temp']))
   {
       $str_path_apl_url = $_SERVER['PHP_SELF'];
       $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
       $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
       $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
       /*check tmp*/$_SESSION['scriptcase']['grid_alerta_pb']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
   }
   if (!isset($_SESSION['sc_session']))
   {
       $NM_dir_atual = getcwd();
       if (empty($NM_dir_atual))
       {
           $str_path_sys  = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
           $str_path_sys  = str_replace("\\", '/', $str_path_sys);
       }
       else
       {
           $sc_nm_arquivo = explode("/", $_SERVER['PHP_SELF']);
           $str_path_sys  = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
       }
       $str_path_web    = $_SERVER['PHP_SELF'];
       $str_path_web    = str_replace("\\", '/', $str_path_web);
       $str_path_web    = str_replace('//', '/', $str_path_web);
       $root            = substr($str_path_sys, 0, -1 * strlen($str_path_web));
       if (is_file($root . $_SESSION['scriptcase']['grid_alerta_pb']['glo_nm_path_imag_temp'] . "/sc_apl_default_Proyecto_gestion_faltas.txt"))
       {
?>
           <script language="javascript">
            parent.nm_move();
           </script>
<?php
           exit;
       }
   }
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
   $Ord_Cmp = new grid_alerta_pb_Ord_cmp(); 
   $Ord_Cmp->Ord_cmp_init();
   
class grid_alerta_pb_Ord_cmp
{
function Ord_cmp_init()
{
  global $sc_init, $path_img, $path_btn, $use_alias, $tab_ger_campos, $tab_def_campos, $tab_def_seq, $tab_labels, $embbed, $tbar_pos, $_POST, $_GET;
   if (isset($_POST['script_case_init']))
   {
       $sc_init    = filter_input(INPUT_POST, 'script_case_init', FILTER_SANITIZE_NUMBER_INT);
       $path_img   = (isset($_POST['path_img'])) ? strip_tags($_POST['path_img']) : "";
       $path_btn   = (isset($_POST['path_btn'])) ? strip_tags($_POST['path_btn']) : "";
       $use_alias  = (isset($_POST['use_alias'])) ? strip_tags($_POST['use_alias']) : "S";
       $fsel_ok    = (isset($_POST['fsel_ok'])) ? strip_tags($_POST['fsel_ok']) : "";
       $campos_sel = (isset($_POST['campos_sel'])) ? strip_tags($_POST['campos_sel']) : "";
       $sel_regra  = (isset($_POST['sel_regra'])) ? strip_tags($_POST['sel_regra']) : "";
       $embbed     = isset($_POST['embbed_groupby']) && 'Y' == $_POST['embbed_groupby'];
       $tbar_pos   = filter_input(INPUT_POST, 'toolbar_pos', FILTER_SANITIZE_SPECIAL_CHARS);
   }
   elseif (isset($_GET['script_case_init']))
   {
       $sc_init    = filter_input(INPUT_GET, 'script_case_init', FILTER_SANITIZE_NUMBER_INT);
       $path_img   = (isset($_GET['path_img'])) ? strip_tags($_GET['path_img']) : "";
       $path_btn   = (isset($_GET['path_btn'])) ? strip_tags($_GET['path_btn']) : "";
       $use_alias  = (isset($_GET['use_alias'])) ? strip_tags($_GET['use_alias']) : "S";
       $fsel_ok    = (isset($_GET['fsel_ok'])) ? strip_tags($_GET['fsel_ok']) : "";
       $campos_sel = (isset($_GET['campos_sel'])) ? strip_tags($_GET['campos_sel']) : "";
       $sel_regra  = (isset($_GET['sel_regra'])) ? strip_tags($_GET['sel_regra']) : "";
       $embbed     = isset($_GET['embbed_groupby']) && 'Y' == $_GET['embbed_groupby'];
       $tbar_pos   = filter_input(INPUT_GET, 'toolbar_pos', FILTER_SANITIZE_SPECIAL_CHARS);
   }
   $STR_lang    = (isset($_SESSION['scriptcase']['str_lang']) && !empty($_SESSION['scriptcase']['str_lang'])) ? $_SESSION['scriptcase']['str_lang'] : "es";
   $NM_arq_lang = "../_lib/lang/" . $STR_lang . ".lang.php";
   $this->Nm_lang = array();
   if (is_file($NM_arq_lang))
   {
       include_once($NM_arq_lang);
   }
   if (!isset($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_select_orig']))
   {
       $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_select_orig'] = array();
   }
   $this->restore = isset($_POST['restore']) ? true : false;
   if ($this->restore && !class_exists('Services_JSON')) {
       include_once("grid_alerta_pb_json.php");
   }
   $this->Arr_result = array();
   
   $tab_ger_campos = array();
   $tab_def_campos = array();
   $tab_labels     = array();
   $tab_ger_campos['practitioners_practitioner_id'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['practitioners_practitioner_id'] = "practitioners_practitioner_id";
   }
   else
   {
       $tab_def_campos['practitioners_practitioner_id'] = "practitioners.practitioner_id";
   }
   $tab_labels["practitioners_practitioner_id"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['labels']["practitioners_practitioner_id"])) ? $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['labels']["practitioners_practitioner_id"] : "Nombre y apellido";
   $tab_ger_campos['practitioners_area_id'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['practitioners_area_id'] = "practitioners_area_id";
   }
   else
   {
       $tab_def_campos['practitioners_area_id'] = "practitioners.area_id";
   }
   $tab_labels["practitioners_area_id"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['labels']["practitioners_area_id"])) ? $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['labels']["practitioners_area_id"] : "Área";
   $tab_ger_campos['leve'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['leve'] = "Leve";
   }
   else
   {
       $tab_def_campos['leve'] = "";
   }
   $tab_labels["leve"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['labels']["leve"])) ? $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['labels']["leve"] : "Leve";
   $tab_ger_campos['moderada'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['moderada'] = "Moderada";
   }
   else
   {
       $tab_def_campos['moderada'] = "";
   }
   $tab_labels["moderada"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['labels']["moderada"])) ? $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['labels']["moderada"] : "Moderada";
   $tab_ger_campos['grave'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['grave'] = "Grave";
   }
   else
   {
       $tab_def_campos['grave'] = "";
   }
   $tab_labels["grave"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['labels']["grave"])) ? $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['labels']["grave"] : "Grave";
   $tab_ger_campos['alerta'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['alerta'] = "Alerta";
   }
   else
   {
       $tab_def_campos['alerta'] = "";
   }
   $tab_labels["alerta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['labels']["alerta"])) ? $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['labels']["alerta"] : "Alerta";
   $tab_ger_campos['sc_field_0'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['sc_field_0'] = "sc_field_0";
   }
   else
   {
       $tab_def_campos['sc_field_0'] = "SELECT benefit_id 
FROM benefits_practitioners 
WHERE benefit_id = '{Beneficios perdidos}' 
ORDER BY benefit_id";
   }
   $tab_labels["sc_field_0"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['labels']["sc_field_0"])) ? $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['labels']["sc_field_0"] : "Beneficios perdidos";
   $tab_ger_campos['leve'] = "none";
   $tab_ger_campos['moderada'] = "none";
   $tab_ger_campos['grave'] = "none";
   $tab_ger_campos['alerta'] = "none";
   $tab_ger_campos['sc_field_0'] = "none";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_alerta_pb']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_alerta_pb']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_alerta_pb']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (isset($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (!isset($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_select']))
   {
       $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_select'] = array();
   }
   
   if ($fsel_ok == "cmp" && !$this->restore)
   {
       $this->Sel_processa_out_sel($campos_sel);
   }
   else
   {
       if ($embbed)
       {
           ob_start();
           $this->Sel_processa_form();
           $Temp = ob_get_clean();
           echo NM_charset_to_utf8($Temp);
       }
       else
       {
           if ($this->restore)
           {
               ob_start();
           }
           $this->Sel_processa_form();
       }
   }
   exit;
   
}
function Sel_processa_out_sel($campos_sel)
{
   global $tab_ger_campos, $sc_init, $tab_def_campos, $embbed;
   $arr_temp = array();
   $campos_sel = explode("@?@", $campos_sel);
   $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_select'] = array();
   $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_grid']   = "";
   $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_cmp']    = "";
   foreach ($campos_sel as $campo_sort)
   {
       $ordem = (substr($campo_sort, 0, 1) == "+") ? "asc" : "desc";
       $campo = substr($campo_sort, 1);
       if (isset($tab_def_campos[$campo]))
       {
           $Ordem_tem_quebra = false;
           if (isset($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_quebra']))
           {
               foreach($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_quebra'] as $campo_quebra => $resto) 
               {
                   foreach($resto as $sqldef => $ordem_ant) 
                   {
                       if ($sqldef == $tab_def_campos[$campo]) 
                       { 
                           $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_quebra'][$campo][$sqldef] = $ordem;
                           $Ordem_tem_quebra = true;
                       }   
                   }   
               }   
           }   
           if (!$Ordem_tem_quebra)
           {
               $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_select'][$tab_def_campos[$campo]] = $ordem;
           }   
       }
   }
?>
    <script language="javascript"> 
<?php
   if (!$embbed)
   {
?>
      self.parent.tb_remove(); 
      parent.nm_gp_submit_ajax('inicio', ''); 
<?php
   }
   else
   {
?>
      nm_gp_submit_ajax('inicio', ''); 
<?php
   }
?>
   </script>
<?php
}
   
function Sel_processa_form()
{
  global $sc_init, $path_img, $path_btn, $use_alias, $tab_ger_campos, $tab_def_campos, $tab_labels, $embbed, $tbar_pos;
   $size = 10;
   $_SESSION['scriptcase']['charset']  = "UTF-8";
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
   $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_SweetBlue/Sc9_SweetBlue";
   include("../_lib/css/" . $str_schema_all . "_grid.php");
   $Str_btn_grid = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
   include("../_lib/buttons/" . $Str_btn_grid);
   if (!function_exists("nmButtonOutput"))
   {
       include_once("../_lib/lib/php/nm_gp_config_btn.php");
   }
   if (!$embbed)
   {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Información / Acumulación de Faltas</TITLE>
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
<?php
}
?>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div_dir'] ?>" /> 
 <?php
 if(isset($_SESSION['scriptcase']['str_google_fonts']) && !empty($_SESSION['scriptcase']['str_google_fonts']))
 {
 ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['scriptcase']['str_google_fonts'] ?>" />
 <?php
 }
 ?>
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $_SESSION['scriptcase']['css_btn_popup'] ?>" /> 
</HEAD>
<BODY class="scGridPage" style="margin: 0px; overflow-x: hidden">
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery-ui.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['sc_session']['path_third'] ?>/font-awesome/css/all.min.css" />
<?php
   }
?>
<script language="javascript"> 
<?php
if ($embbed)
{
?>
  function scSubmitOrderCampos(sPos, sType) {
    $("#id_fsel_ok_sel_ord").val(sType);
    if(sType == 'cmp')
    {
       scPackSelectedOrd();
    }
   return new Promise(function(resolve, reject) {$.ajax({
    type: "POST",
    url: "grid_alerta_pb_order_campos.php",
    data: {
     script_case_init: $("#id_script_case_init_sel_ord").val(),
     path_img: $("#id_path_img_sel_ord").val(),
     path_btn: $("#id_path_btn_sel_ord").val(),
     use_alias: $("#id_use_alias").val(),
     campos_sel: $("#id_campos_sel_sel_ord").val(),
     sel_regra: $("#id_sel_regra_sel_ord").val(),
     fsel_ok: $("#id_fsel_ok_sel_ord").val(),
     embbed_groupby: 'Y'
    }
   }).done(function(data) {
    scBtnOrderCamposHide(sPos);
    buttonunselectedOF();
    $("#sc_id_order_campos_placeholder_" + sPos).find("td").html("");
    var execString = data.toString().replace(/(\<.*?\>)/g, '');
    eval(execString).then(function(){resolve()});
   });});
  }
<?php
}
?>
 // Submeter o formularior
 //-------------------------------------
 function submit_form_Fsel_ord()
 {
     scPackSelectedOrd();
      buttonunselectedOF();
      document.Fsel_ord.submit();
 }
 function scPackSelectedOrd() {
  var fieldList, fieldName, i, selectedFields = new Array;
 fieldList = $('#sorting_list_ord_campos .sc_ui_sorting-list-right').sortable('toArray');
 for (i = 0; i < fieldList.length; i++) {
  fieldName  = fieldList[i].substr(14);
  selectedFields.push($("#sc_id_class_" + fieldName).val() + fieldName);
 }
 $("#id_campos_sel_sel_ord").val( selectedFields.join("@?@") );
 }
 </script>
<FORM name="Fsel_ord" method="POST">
  <INPUT type="hidden" name="script_case_init"    id="id_script_case_init_sel_ord"    value="<?php echo NM_encode_input($sc_init); ?>"> 
  <INPUT type="hidden" name="path_img"            id="id_path_img_sel_ord"            value="<?php echo NM_encode_input($path_img); ?>"> 
  <INPUT type="hidden" name="path_btn"            id="id_path_btn_sel_ord"            value="<?php echo NM_encode_input($path_btn); ?>"> 
  <INPUT type="hidden" name="use_alias"           id="id_use_alias"                   value="<?php echo NM_encode_input($use_alias); ?>"> 
  <INPUT type="hidden" name="fsel_ok"             id="id_fsel_ok_sel_ord"             value=""> 
<?php
if ($embbed)
{
    echo "<div class='scAppDivMoldura'>";
    echo "<table id=\"main_table\" style=\"width: 100%\" cellspacing=0 cellpadding=0>";
}
elseif ($_SESSION['scriptcase']['reg_conf']['html_dir'] == " DIR='RTL'")
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 10px; right: 10px\">";
}
else
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 10px; left: 10px\">";
}
?>
<?php
if (!$embbed)
{
?>
<tr>
<td>
<div class="scGridBorder">
<table width='100%' cellspacing=0 cellpadding=0>
<?php
}
$disp_rest = "none";
?>
 <tr>
  <td class="<?php echo ($embbed)? 'scAppDivHeader scAppDivHeaderText':'scGridLabelVert'; ?>">
   <?php echo $this->Nm_lang['lang_btns_sort_hint']; ?>
  </td>
 </tr>
 <tr>
  <td class="<?php echo ($embbed)? 'scAppDivContent css_scAppDivContentText':'scGridTabelaTd'; ?>">
   <table class="<?php echo ($embbed)? '':'scGridTabela'; ?>" style="border-width: 0; border-collapse: collapse; width:100%;" cellspacing=0 cellpadding=0>
    <tr class="<?php echo ($embbed)? '':'scGridFieldOddVert'; ?>">
     <td style="vertical-align: top">
     <table style="width:100%;">

<style>
    #sorting_list_ord_campos.sc_ui_sortable-wrapper {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        height: 400px;
        <?php
      
            if ($_SESSION['scriptcase']['proc_mobile']) {
                echo 'max-width: calc(100vw - 8px);';
            } else {
                echo 'width: 600px;';
            }
      ?>
    }
    #sorting_list_ord_campos .sc_ui_sorting-buttons-wrapper {
        min-width: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
        box-sizing: border-box;
        padding: 0 5px;
    }
    #sorting_list_ord_campos .sc_ui_sorting-buttons-wrapper > a {
        max-width: 35px;
        min-width: 35px;
        box-sizing: border-box;
        padding-left: 0;
        padding-right: 0;
        text-align: center;
    }
    #sorting_list_ord_campos .sc_ui_sorting-list-wrapper {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        justify-content: flex-start;
        max-width: 49%;
        height: 100%;
    }
    #sorting_list_ord_campos .sc_ui_sorting-list {
        flex-grow: 1;
        flex-basis: 0px;
        margin: 0;
        list-style: none;
        padding: 10px;
        display: flex;
        flex-direction: column;
        gap: 2px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    #sorting_list_ord_campos .sc_ui_sorting-list-wrapper h4 {
        text-align: center;
        margin: 10px 0 5px 0;
    }
    
    #sorting_list_ord_campos .sc_ui_sorting-list li {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        padding: 5px <?php
      
            if ($_SESSION['scriptcase']['proc_mobile']) {
                echo ' 30px 5px ';
            }
      ?> 10px !important;
        word-break: break-word;
        position: relative;
        cursor: move !important;
    }
    
    #sorting_list_ord_campos .sc_ui_sorting-list li.hidden-opt {
        display: none;
    }
    #sorting_list_ord_campos .sc_ui_sorting-list li:hover {
    }
    #sorting_list_ord_campos .sc_ui_sortable-item-moving {
        opacity: .3;
    }
    #sorting_list_ord_campos .sc_ui_sorting-list-item-selected {
        background: Highlight;
        color: HighlightText;
    }
    #sorting_list_ord_campos .sc_ui_sorting-search-container {
        padding: 0 5px;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        justify-content: center;
        height: 45px
    }
    #sorting_list_ord_campos .sc_ui_sorting-list-item-handle {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
    }
    #sorting_list_ord_campos .scAppDivSelectFieldsDisabled .sc_ui_sorting-list-item-handle {
        display: none;
    }
    #sorting_list_ord_campos .scAppDivSelectFieldsDisabled {
        cursor: default !important;
    }
    #sorting_list_ord_campos .sc_ui_right-sortable-list .sc_ui_sorting-list-item select {
        display: inline-block !important;
    }
    
    #sorting_list_ord_campos .sc_ui_left-sortable-list .sc_ui_sorting-list-item select {
        display: none !important;
    }
    <?php
      
            if ($_SESSION['scriptcase']['proc_mobile']) {
                ?>
                
    #sorting_list_ord_campos .sc_ui_sorting-list-item-block {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        flex-grow: 1;
    }
                <?php
            } else {
                
                ?>
    #sorting_list_ord_campos .sc_ui_sorting-list-item-block {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        flex-grow: 1;
    }
                <?php
            
            }
      ?>

    #sorting_list_ord_campos .sc_ui_sorting-list-item-block select {
        padding: 0;
        height: auto;
    }
    
    #sorting_list_ord_campos .sc_ui_sorting-buttons-wrapper a {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
</style>
<script language="javascript" type="text/javascript" src="../_lib/lib/js/sortable.js?v=9.07.0001"></script>
<script language="javascript" type="text/javascript" src="../_lib/lib/js/sortable.jquery.js?v=9.07.0001"></script>   <tr><td style="vertical-align: top" >
 <script language="javascript" type="text/javascript">
  function scUpdateListHeight() {
   $("#sc_id_fldord_available").css("min-height", "<?php echo sizeof($tab_ger_campos) * 26 ?>px");
   $("#sc_id_fldord_selected").css("min-height", "<?php echo sizeof($tab_ger_campos) * 26 ?>px");
  }
 </script>
 <style type="text/css">
  .sc_ui_sortable_ord {
   list-style-type: none;
   margin: 0;
   min-width: 120px;
  }
  .sc_ui_sortable_ord li {
   margin: 0 3px 3px 3px;
   padding: 1px 3px 1px 15px;
   min-height: 18px;
  }
  .sc_ui_sortable_ord li span {
   position: absolute;
   margin-left: -1.3em;
  }
 </style>

<div class="sc_ui_sortable-wrapper" id="sorting_list_ord_campos">
      <div class="sc_ui_sorting-list-wrapper sc_ui_left-sortable-list">
        <h4><?php echo $this->Nm_lang['lang_othr_groupby_available_fld']; ?></h4>
        <div class='sc_ui_sorting-search-container'>
            <input name='search' class='sc_ui_sorting-search-field css_toolbar_obj' id='search-left' data-side='left' placeholder='<?php echo $this->Nm_lang['lang_btns_srch_lone']; ?>...' />
        </div>
        <ul class="sc_ui_sorting-list sc_ui_sorting-list-left scAppDivSelectFields"><?php
   if ($this->restore) {
        ob_end_clean();
        ob_start();
   }
   $arr_order = ($this->restore) ? $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_select_orig'] : $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_select'];
   foreach ($tab_ger_campos as $NM_cada_field => $NM_cada_opc)
   {
       if ($NM_cada_opc != "none")
       {
           if (!isset($arr_order[$tab_def_campos[$NM_cada_field]]))
           {
?>
     <li class="sc_ui_sorting-list-item sc_ui_litem scAppDivSelectFieldsEnabled" data-id="sc_id_itemsel_<?php echo NM_encode_input($NM_cada_field); ?>" id="sc_id_itemord_<?php echo NM_encode_input($NM_cada_field); ?>">
      <div class='sc_ui_sorting-list-item-block'><span class='sc_ui_sorting-list-item-block-name'><?php echo $tab_labels[$NM_cada_field]; ?></span>
      <select id="sc_id_class_<?php echo NM_encode_input($NM_cada_field); ?>" class="scAppDivToolbarInput" style="display: none" onchange="display_btn_restore_ord();">
       <option value="+">Asc</option>
       <option value="-">Desc</option>
      </select></div>
<?php
            if ($_SESSION['scriptcase']['proc_mobile']) {
                echo '<div class="sc_ui_sorting-list-item-handle"><i class="fa-solid fa-grip-vertical"></i></div>';
            }
?>     </li>
<?php
           }
       }
   }
   if ($this->restore) {
       $this->Arr_result['fldord_available'] = NM_charset_to_utf8(ob_get_clean());
   }
?>
    </ul>
<?php
            
?>
      </div>
      <div class="sc_ui_sorting-buttons-wrapper">
            <a class="scButton_default" onclick="event.preventDefault(); scuiSortingmoveItemsOrd('right', true);">
                <i class="fas fa-angle-double-right"></i>
            </a>
            <a class="scButton_default" onclick="event.preventDefault(); scuiSortingmoveItemsOrd('right', false);">
                <i class="fas fa-angle-right"></i>
            </a>
            <a class="scButton_default" onclick="event.preventDefault(); scuiSortingmoveItemsOrd('left', false);">
                <i class="fas fa-angle-left"></i>
            </a>
            <a class="scButton_default" onclick="event.preventDefault(); scuiSortingmoveItemsOrd('left', true);">
                <i class="fas fa-angle-double-left"></i>
            </a>
      </div>
      <div class="sc_ui_sorting-list-wrapper sc_ui_right-sortable-list">
        <h4><?php echo $this->Nm_lang['lang_othr_groupby_selected_fld']; ?></h4>
        <div class='sc_ui_sorting-search-container'>
            <?php //<input name='search' class='sc_ui_sorting-search-field css_toolbar_obj' id='search-right' data-side='right' placeholder='Search...' />
            ?>
        </div>
        <ul class="sc_ui_sorting-list sc_ui_sorting-list-right scAppDivSelectFields">
        <?php
?><?php
   if ($this->restore) {
       ob_end_clean();
       ob_start();
   }
   $arr_order = ($this->restore) ? $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_select_orig'] : $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_select'];
   foreach ($tab_ger_campos as $NM_cada_field => $NM_cada_opc)
   {
       if ($NM_cada_opc != "none")
       {
           if (isset($arr_order[$tab_def_campos[$NM_cada_field]]))
           {
               $sAscSelected  = " selected";
               $sDescSelected = "";
               if ($arr_order[$tab_def_campos[$NM_cada_field]] == "desc")
               {
                   $sAscSelected  = "";
                   $sDescSelected = " selected";
               }
?>
     <li class="sc_ui_sorting-list-item sc_ui_litem scAppDivSelectFieldsEnabled" data-id="sc_id_itemsel_<?php echo NM_encode_input($NM_cada_field); ?>" id="sc_id_itemord_<?php echo $NM_cada_field; ?>">
      <div class='sc_ui_sorting-list-item-block'><span class='sc_ui_sorting-list-item-block-name'><?php echo $tab_labels[$NM_cada_field]; ?></span>
      <select id="sc_id_class_<?php echo NM_encode_input($NM_cada_field); ?>" class="scAppDivToolbarInput" onchange="$('#f_sel_sub').css('display', 'inline-block');display_btn_restore_ord();">
       <option value="+"<?php echo $sAscSelected; ?>>Asc</option>
       <option value="-"<?php echo $sDescSelected; ?>>Desc</option>
      </select></div>
<?php
            if ($_SESSION['scriptcase']['proc_mobile']) {
                echo '<div class="sc_ui_sorting-list-item-handle"><i class="fa-solid fa-grip-vertical"></i></div>';
            }
?>     </li>
<?php
          }
       }
   }
   if ($this->restore) {
       $this->Arr_result['fldord_selected'] = NM_charset_to_utf8(ob_get_clean());
       $oJson = new Services_JSON();
       echo $oJson->encode($this->Arr_result);
       exit;
   }
?>
    </ul></div>
    <input type="hidden" name="campos_sel" id="id_campos_sel_sel_ord" value="" />
<script>
    var sc_ui_sortable_obj;
    function scuiSortingmoveItemsOrd(direction, moveall) {
        var field_wrapper = $('#sorting_list_ord_campos');
        var lists = {
            left: field_wrapper.find('.sc_ui_sorting-list-left'),
            right: field_wrapper.find('.sc_ui_sorting-list-right')
        };
        var from_dir = (direction == 'left') ? 'right' : 'left';
        var sel_items;
        
        if (moveall) {
            sel_items = lists[from_dir].find('.sc_ui_sorting-list-item:visible').not('.scAppDivSelectFieldsDisabled');
        } else {
            sel_items = lists[from_dir].find('.sc_ui_sorting-list-item.sc_ui_sorting-list-item-selected:visible').not('.scAppDivSelectFieldsDisabled');
        }
        if (lists[direction].find('.sc_ui_sorting-list-item-selected:visible')[0]) {
            lists[direction].find('.sc_ui_sorting-list-item-selected:visible').last().after(sel_items)
        } else {
            lists[direction].prepend(sel_items);
        }
        if (sel_items.length > 0) {
            display_btn_restore_ord();
        }
        lists[direction].scrollTop(0);
    }
    function outClickOrd(e) {
        var tagname = e.target.tagName;
        if (
            !$(e.target).is('a, a *, button, button *, select, select *, option, option *, input, input *, .sc_ui_sorting-list, .sc_ui_sorting-list *')
            ) {
            deselectAllOrd();
            $(document).off('mousedown.deselect_ord_campos');
            $(document).off('touchstart.deselect_ord_campos');
        }
    }
    function deselectAllOrd() {
        var field_wrapper = $('#sorting_list_ord_campos');
        var sel_items;
        
        sel_items = field_wrapper.find('.sc_ui_sorting-list-item-selected');
        sel_items.each(function (i,item) {
            Sortable.utils.deselect(item);
        });
    }
    $('#sorting_list_ord_campos .sc_ui_sorting-search-field').on('input', function(ev) {
        var side = $(ev.target).attr('data-side');
        var list = $('#sorting_list_ord_campos .sc_ui_sorting-list-'+side+' li');
        if (ev.target.value.trim() != '') {
            list.addClass('hidden-opt');
            list.each(function(index, opt) {
                var opt_txt = $(opt).find('.sc_ui_sorting-list-item-block-name').html().normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
                var value_i = ev.target.value.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
                if (opt_txt.search(value_i) != -1) {
                    $(opt).removeClass('hidden-opt');
                } else {
                    var arr_sel = $('#_list').val();
                    //$('#_list').val(arr_sel.filter(function(e) { return e !== $(opt).val() }));
                }
            });
            return;
            var iconEl = $(ev.target).parent().find('i');
            iconEl.removeClass();
            iconEl.addClass('icon');
            iconEl.addClass('close');
            iconEl.off('click');
            iconEl.on('click', function() {
                $(ev.target).val('').trigger('input');
                iconEl.removeClass();
                iconEl.addClass('icon');
                iconEl.addClass('search');
                iconEl.off('click');
            });
        } else {
            list.removeClass('hidden-opt');
        }
    }); 
    
      <?php
      
        if ($_SESSION['scriptcase']['proc_mobile']) {
            ?>
                $('#sorting_list_ord_campos .sc_ui_sorting-list-item').not('.scAppDivSelectFieldsDisabled').on('click', function(ev) {
                    if ($(ev.currentTarget).is('.sc_ui_sorting-list-item-selected')) {
                        Sortable.utils.deselect(ev.currentTarget);
                    } else {
                        Sortable.utils.select(ev.currentTarget);
                    }
                    
                    $(document).off('touchstart.deselect_ord_campos');
                    $(document).on('touchstart.deselect_ord_campos', function(e) {
                        outClickOrd(e);
                    });
                });
            <?php
        }
      ?>
    sc_ui_sortable_obj = $('#sorting_list_ord_campos .sc_ui_sorting-list-left').sortable({
        multiGrab: true,
        multiDrag: true,
        sort:false,
        avoidImplicitDeselect: true,
        filter: '.scAppDivSelectFieldsDisabled',
        selectedClass: "sc_ui_sorting-list-item-selected",
        ghostClass: 'sc_ui_sortable-item-moving',
        group: 'sel_columns',
        animation: 150,
        onChange: function () {
            display_btn_restore_ord();
        },
        onSelect: function(ev) {
            $(document).off('mousedown.deselect_ord_campos');
            $(document).off('touchstart.deselect_ord_campos');
            if ($('#sorting_list_ord_campos').find('.sc_ui_sorting-list-item-selected')[0]) {
                $(document).on('mousedown.deselect_ord_campos', function(e) {
                    if (e.button === 0) {
                        outClickOrd(e);
                    }
                });
                $(document).on('touchstart.deselect_ord_campos', function(e) {
                    outClickOrd(e);
                });
            }
        }
      <?php
      
            if ($_SESSION['scriptcase']['proc_mobile']) {
                echo ', handle: ".sc_ui_sorting-list-item-handle" ';
            }
      ?>
    })
    sc_ui_sortable_obj = $('#sorting_list_ord_campos .sc_ui_sorting-list-right').sortable({
        multiGrab: true,
        multiDrag: true,
        avoidImplicitDeselect: true,
        filter: '.scAppDivSelectFieldsDisabled, select',
        preventOnFilter: false,
        selectedClass: "sc_ui_sorting-list-item-selected",
        ghostClass: 'sc_ui_sortable-item-moving',
        group: 'sel_columns',
        animation: 150,
        onChange: function () {
            display_btn_restore_ord();
        },
        onSelect: function(ev) {
            $(document).off('mousedown.deselect_ord_campos');
            $(document).off('touchstart.deselect_ord_campos');
            if ($('#sorting_list_ord_campos').find('.sc_ui_sorting-list-item-selected')[0]) {
                $(document).on('mousedown.deselect_ord_campos', function(e) {
                    if (e.button === 0) {
                        outClickOrd(e);
                    }
                });
                $(document).on('touchstart.deselect_ord_campos', function(e) {
                    outClickOrd(e);
                });
            }
        }
      <?php
      
            if ($_SESSION['scriptcase']['proc_mobile']) {
                echo ', handle: ".sc_ui_sorting-list-item-handle" ';
            }
      ?>
    })
</script>   </td>
   </tr>
   </table>
   <tr><td class="<?php echo ($embbed)? 'scAppDivToolbar':'scGridToolbar'; ?>">
<?php
  if (isset($_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_select']) && $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_select'] != $_SESSION['sc_session'][$sc_init]['grid_alerta_pb']['ordem_select_orig']) {
      $disp_rest = "";
  }
   if (!$embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bok_appdiv", "document.Fsel_ord.fsel_ok.value='cmp';proc_btn_ord('f_sel_sub','submit_form_Fsel_ord()')", "document.Fsel_ord.fsel_ok.value='cmp';proc_btn_ord('f_sel_sub','submit_form_Fsel_ord()')", "f_sel_sub", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bapply_appdiv", "proc_btn_ord('f_sel_sub','scSubmitOrderCampos(\\'" . NM_encode_input($tbar_pos) . "\\', \\'cmp\\')')", "proc_btn_ord('f_sel_sub','scSubmitOrderCampos(\\'" . NM_encode_input($tbar_pos) . "\\', \\'cmp\\')')", "f_sel_sub", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
  &nbsp;&nbsp;&nbsp;
<?php
   if (!$embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "brestore_appdiv", "proc_btn_ord('Brestore_ord','restore_ord()')", "proc_btn_ord('Brestore_ord','restore_ord()')", "Brestore_ord", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "brestore_appdiv", "proc_btn_ord('Brestore_ord','restore_ord()')", "proc_btn_ord('Brestore_ord','restore_ord()')", "Brestore_ord", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
  &nbsp;&nbsp;&nbsp;
<?php
   if (!$embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bsair_appdiv", "self.parent.tb_remove(); buttonunselectedOF();", "self.parent.tb_remove(); buttonunselectedOF();", "Bsair_ord", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   elseif ($_SESSION['scriptcase']['proc_mobile'])
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "closeAllModalPanes();", "closeAllModalPanes();", "Bsair_ord", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "scBtnOrderCamposHide('" . NM_encode_input($tbar_pos) . "'); buttonunselectedOF();", "scBtnOrderCamposHide('" . NM_encode_input($tbar_pos) . "'); buttonunselectedOF();", "Bsair_ord", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
   </td>
   </tr>
<?php
if (!$embbed)
{
?>
</table>
</div>
</td>
</tr>
<?php
}
?>
</table>
<?php
if ($embbed)
{
?>
    </div>
<?php
}
?>
</FORM>
<script language="javascript"> 
function buttonDisable_ord(buttonId) {
    $("#" + buttonId).prop("disabled", true).addClass("disabled");
}
function buttonEnable_ord(buttonId) {
    $("#" + buttonId).prop("disabled", false).removeClass("disabled");
}
function restore_ord() {
    $.ajax({
        type: 'POST',
        url: "grid_alerta_pb_order_campos.php",
        data: {
           script_case_init: $("#id_script_case_init_sel_ord").val(),
           restore: 'ok',
        }
    })
    .done(function(retcombos) {
       eval("Combos = " + retcombos);
       $("#sc_id_fldord_available").html(Combos["fldord_available"]);
       $("#sc_id_fldord_selected").html(Combos["fldord_selected"]);
       deselectAllOrd();
       $('#sorting_list_ord_campos .sc_ui_sorting-list-left').html(Combos["fldord_available"]);
       $('#sorting_list_ord_campos .sc_ui_sorting-list-right').html(Combos["fldord_selected"]);
       buttonDisable_ord("Brestore_ord");
       buttonEnable_ord("f_sel_sub");
       $('#f_sel_sub').css('display', 'inline-block');
    });
}
function buttonSelectedOF() {
   parent.$("#ordcmp_top").addClass("selected");
   parent.$("#ordcmp_bottom").addClass("selected");
}
function buttonunselectedOF() {
   parent.$("#ordcmp_top").removeClass("selected");
   parent.$("#ordcmp_bottom").removeClass("selected");
}
function display_btn_restore_ord() {
    buttonEnable_ord("Brestore_ord");
    buttonEnable_ord("f_sel_sub");
}
function proc_btn_ord(btn, proc) {
    if (
        (document.Fsel_ord.fsel_ok.value != 'regra' && $("#" + btn).prop("disabled") == true) || 
        (document.Fsel_ord.fsel_ok.value == 'regra' && $("#id_sel_regra_sel_ord").val() == '')
    )
    {
        return;
    }
    eval (proc);
}
$( document ).ready(function() {
   buttonDisable_ord("f_sel_sub");
<?php
   if ($disp_rest == "none") {
?>
   buttonDisable_ord("Brestore_ord");
<?php
   }
?>
});
var bFixed = false;
function ajusta_window_Fsel_ord()
{
<?php
   if ($embbed)
   {
?>
  return false;
<?php
   }
?>
  var mt = $(document.getElementById("main_table"));
  if (0 == mt.width() || 0 == mt.height())
  {
    setTimeout("ajusta_window_Fsel_ord()", 50);
    return;
  }
  else if(!bFixed)
  {
    var oOrig = $(document.Fsel_ord.sel_orig),
        oDest = $(document.Fsel_ord.sel_dest),
        mHeight = Math.max(oOrig.height(), oDest.height()),
        mWidth = Math.max(oOrig.width() + 5, oDest.width() + 5);
    oOrig.height(mHeight);
    oOrig.width(mWidth);
    oDest.height(mHeight);
    oDest.width(mWidth + 15);
    bFixed = true;
    if (navigator.userAgent.indexOf("Chrome/") > 0)
    {
      strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
      self.parent.tb_resize(strMaxHeight + 20, mt.width() + 20);
      setTimeout("ajusta_window_Fsel_ord()", 50);
      return;
    }
  }
  strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
  self.parent.tb_resize(strMaxHeight + 20, mt.width() + 20);
}
$( document ).ready(function() {
   ajusta_window_Fsel_ord();
});
</script>
<script>
    ajusta_window_Fsel_ord();
</script>
</BODY>
</HTML>
<?php
}
}
