<?php
   if(!isset($bol_sel_campos_include))
   {
       $bol_sel_campos_include = false;
       global $bol_sel_campos_include;
   }
   if(!$bol_sel_campos_include)
   {
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
      $Sel_Cmp = new grid_alerta_pb_sel_cmp($bol_sel_campos_include); 
      $Sel_Cmp->Sel_cmp_init();
      $Sel_Cmp->Sel_cmp_init_fields();
      $Sel_Cmp->Sel_cmp_process();
     
  }
class grid_alerta_pb_sel_cmp
{
function Sel_cmp_init($bol_sel_campos_include = false, $sc_init = '', $path_img = '', $path_btn = '', $path_fields = '',$embbed = true, $tbar_pos = '')
{
   $this->proc_ajax = false;
   if (isset($_POST['script_case_init']))
   {
       $this->sc_init      = filter_input(INPUT_POST, 'script_case_init', FILTER_SANITIZE_NUMBER_INT);
       $this->path_img     = (isset($_POST['path_img'])) ? strip_tags($_POST['path_img']) : "";
       $this->path_btn     = (isset($_POST['path_btn'])) ? strip_tags($_POST['path_btn']) : "";
       $this->path_fields  = (isset($_POST['path_fields'])) ? strip_tags($_POST['path_fields']) : "";
       $this->embbed       = isset($_POST['embbed_groupby']) && 'Y' == $_POST['embbed_groupby'];
       $this->tbar_pos     = filter_input(INPUT_POST, 'toolbar_pos', FILTER_SANITIZE_SPECIAL_CHARS);
   }
   elseif (isset($_GET['script_case_init']))
   {
       $this->sc_init      = filter_input(INPUT_GET, 'script_case_init', FILTER_SANITIZE_NUMBER_INT);
       $this->path_img     = (isset($_GET['path_img'])) ? strip_tags($_GET['path_img']) : "";
       $this->path_btn     = (isset($_GET['path_btn'])) ? strip_tags($_GET['path_btn']) : "";
       $this->path_fields  = (isset($_GET['path_fields'])) ? strip_tags($_GET['path_fields']) : "";
       $this->embbed       = isset($_GET['embbed_groupby']) && 'Y' == $_GET['embbed_groupby'];
       $this->tbar_pos     = filter_input(INPUT_GET, 'toolbar_pos', FILTER_SANITIZE_SPECIAL_CHARS);
   }
   else
   {
       $this->sc_init     = $sc_init;
       $this->path_img    = $path_img;
       $this->path_btn    = $path_btn;
       $this->path_fields = $path_fields;
       $this->embbed      = $embbed;
       $this->tbar_pos    = $tbar_pos;
   }
   $this->bol_sel_campos_include    = $bol_sel_campos_include;
   if(isset($_REQUEST['embbed_export']) && $_REQUEST['embbed_export'] == 'Y')
   {
       $this->bol_sel_campos_include = true;
   }
   if (isset($_POST['ajax_ctrl']) && $_POST['ajax_ctrl'] == "proc_ajax")
   {
       $this->proc_ajax = true;
   }
   $this->ajax_return = array();
   $this->campos_sel  = isset($_POST['campos_sel']) ? $_POST['campos_sel'] : array();
   $this->restore     = isset($_POST['restore'])    ? true                  : false;
   if ($this->restore && !class_exists('Services_JSON'))
   {
       include_once("grid_alerta_pb_json.php");
   }
   $this->Arr_result = array();
   $STR_lang    = (isset($_SESSION['scriptcase']['str_lang']) && !empty($_SESSION['scriptcase']['str_lang'])) ? $_SESSION['scriptcase']['str_lang'] : "es";
   $NM_arq_lang = "../_lib/lang/" . $STR_lang . ".lang.php";
   $this->Nm_lang = array();
   if (is_file($NM_arq_lang))
   {
       include_once($NM_arq_lang);
   }
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
}
function Sel_cmp_process()
{
   if (isset($_POST['fsel_ok']) && $_POST['fsel_ok'] == "OK" && !empty($this->campos_sel) && !$this->restore)
   {
       $this->Sel_processa_out();
   }
   else
   {
       if ($this->embbed)
       {
           ob_start();
           $this->Sel_processa_form();
           $Temp = ob_get_clean();
           echo NM_charset_to_utf8($Temp);
       }
       else
       {
           $this->Sel_processa_form();
       }
   }
   exit;}
   function Sel_css($bol_include_all = false)
   {
      if($bol_include_all)
      {
         ?>
         <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup'] ?>" />
         <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_dir'] ?>" />
         <?php
      }
      ?>
      <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div'] ?>" />
      <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div_dir'] ?>" />
      <?php
      if($bol_include_all)
      {
         ?>
         <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $_SESSION['scriptcase']['css_btn_popup'] ?>" />
         <?php
          if(isset($_SESSION['scriptcase']['str_google_fonts']) && !empty($_SESSION['scriptcase']['str_google_fonts']))
          {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['scriptcase']['str_google_fonts']; ?>" />
            <?php
          }
      }
   }

   function Sel_cmp_init_fields()
   {
      global $tab_ger_campos, $tab_blk_campos;

      $tab_ger_campos = array();
      $tab_blk_campos = array();

      $tab_ger_campos['practitioners_practitioner_id'] = "on";
      $tab_ger_campos['practitioners_area_id'] = "on";
      $tab_ger_campos['leve'] = "on";
      $tab_blk_campos[] = "leve";
      $tab_ger_campos['moderada'] = "on";
      $tab_blk_campos[] = "moderada";
      $tab_ger_campos['grave'] = "on";
      $tab_blk_campos[] = "grave";
      $tab_ger_campos['alerta'] = "on";
      $tab_blk_campos[] = "alerta";
      $tab_ger_campos['sc_field_0'] = "on";
      $tab_blk_campos[] = "sc_field_0";
      $tab_ger_campos['practitioners_division_id'] = "on";
      $tab_ger_campos['practitioners_general_id'] = "on";
      $tab_ger_campos['practitioners_turn_id'] = "on";
      $tab_ger_campos['practitioners_profile_id'] = "on";


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

      if (isset($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              if ($NM_cada_opc == "off")
              {
                 $tab_ger_campos[$NM_cada_field] = "none";
              }
          }
      }

      if ($this->restore)
      {
          if (isset($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel_orig']) && !empty($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel_orig']))
          {
              foreach ($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel_orig'] as $NM_cada_field => $NM_cada_opc)
              {
                  $tab_ger_campos[$NM_cada_field] = $NM_cada_opc;
              }
          }
      }
      else
      {
          if (isset($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel']))
          {
              foreach ($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
              {
                  $tab_ger_campos[$NM_cada_field] = $NM_cada_opc;
              }
          }
      }
   }
function Sel_processa_out()
{
   global $tab_ger_campos;
   $arr_temp = array();
   if (!isset($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel']))
   {
       $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel'] = array();
   }
   if($this->bol_sel_campos_include)
   {
       $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['export_sel_columns']['field_order'] = $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order'];
       $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['export_sel_columns']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel'];
   }
   $arr_order = $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order'];
   $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order'] = array();
   $campos_sel = explode("@?@", $this->campos_sel);
   foreach ($campos_sel as $campo_order)
   {
       if (isset($tab_ger_campos[$campo_order]))
       {
           $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order'][] = $campo_order;
       }
   }
   foreach ($arr_order as $campo_order)
   {
       if (!in_array($campo_order, $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order']))
       {
           $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order'][] = $campo_order;
       }
   }
   foreach ($tab_ger_campos as $campo_cons => $opc)
   {
       if (!in_array($campo_cons, $campos_sel) && $opc != "none")
       {
           $arr_temp[$campo_cons] = "off";
       }
   }
   $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel'] = $arr_temp;
   if($this->bol_sel_campos_include)
   {
       return;
   }
?>
    <script language="javascript"> 
<?php
   if (!$this->embbed)
   {
?>
      self.parent.tb_remove(); 
<?php
   }
?>
<?php
   $sParent = $this->embbed ? '' : 'parent.';
   echo $sParent . "nm_gp_submit_ajax('igual', '')"; 
?>
   </script>
<?php
}
   
   function displayHtml($bol_css_all, $display_btn=true)
   {
      global $tab_ger_campos, $tab_blk_campos, $bol_sel_campos_include;

      $this->Sel_css($bol_css_all);

if(isset($bol_sel_campos_include) && $bol_sel_campos_include && $_SESSION['scriptcase']['proc_mobile'])
{
?>
<script type="text/javascript" src="../_lib/lib/js/nm_touchfix.jquery.js"></script>
<?php
}
?><script language="javascript" type="text/javascript">

<?php
if ($this->embbed)
{
?>
  function scSubmitSelCampos(sPos) {
   scPackSelected();
   if ($("#id_campos_sel_sel_campos").val() == "") {
       restore_sel();
       return;
   }
<?php
if ($_SESSION['scriptcase']['proc_mobile']) {
?>
   return new Promise(function(resolve, reject) {
<?php
}
?>
   $.ajax({
    type: "POST",
    url: "grid_alerta_pb_sel_campos.php",
    data: {
     script_case_init: $("#id_script_case_init_sel_campos").val(),
     path_img: $("#id_path_img_sel_campos").val(),
     path_btn: $("#id_path_btn_sel_campos").val(),
     path_fields: $("#id_path_fields_sel_campos").val(),
     campos_sel: $("#id_campos_sel_sel_campos").val(),
     fsel_ok: $("#id_fsel_ok_sel_campos").val(),
     embbed_groupby: 'Y'
    }
   }).done(function(data) {
    scBtnSelCamposHide(sPos);
    buttonunselectedSF();
    $("#sc_id_sel_campos_placeholder_" + sPos).find("td").html("");
    var execString = data.toString().replace(/(\<.*?\>)/g, '');
    eval(execString).then(function(){resolve()});
   });
<?php
if ($_SESSION['scriptcase']['proc_mobile']) {
?>
   });
<?php
}
?>
  }
<?php
}

if(!isset($bol_sel_campos_include) || $bol_sel_campos_include)
{
?>
function scSubmitSelCamposAjaxExport(sPos) {
   scPackSelected();

<?php
if ($_SESSION['scriptcase']['proc_mobile']) {
?>
   return new Promise(function(resolve, reject) {
<?php
}
?>
   $.ajax({
    type: "POST",
    url: "grid_alerta_pb_sel_campos.php",
    async: false,
    data: {
     script_case_init: $("#id_script_case_init_sel_campos").val(),
     path_img: $("#id_path_img_sel_campos").val(),
     path_btn: $("#id_path_btn_sel_campos").val(),
     path_fields: $("#id_path_fields_sel_campos").val(),
     campos_sel: $("#id_campos_sel_sel_campos").val(),
     fsel_ok: $("#id_fsel_ok_sel_campos").val(),
     embbed_groupby: 'Y',
     embbed_export: 'Y',
    }
   }).done(function(data) {
    scSubmitSelCamposAjaxExportDone();
   });
<?php
if ($_SESSION['scriptcase']['proc_mobile']) {
?>
   });
<?php
}
?>
  }
  <?php
}
?>

 function submit_form_Fsel()
 {
     console.log('ffff')
     scPackSelected();
     buttonunselectedSF();
     document.Fsel_campos.submit();
 }

 function restore_sel() {
     $.ajax({
         type: 'POST',
         url: "grid_alerta_pb_sel_campos.php",
         data: {
            script_case_init: $("#id_script_case_init_sel_campos").val(),
            restore: 'ok',
         }
     })
     .done(function(retcombos) {
        eval("Combos = " + retcombos);
        if (true) {
            deselectAllSel();
            $('#sorting_list_sel_campos .sc_ui_sorting-list-left').html(Combos["fldsel_available"]);
            $('#sorting_list_sel_campos .sc_ui_sorting-list-right').html(Combos["fldsel_selected"]);
        } else {
            $("#sc_id_fldsel_available").html(Combos["fldsel_available"]);
            $("#sc_id_fldsel_selected").html(Combos["fldsel_selected"]);
        }
        if (typeof(buttonDisable_sel) === 'function') buttonDisable_sel("Brestore_sel");
        buttonEnable_sel("f_sel_sub_sel");
     });
}

function display_btn_restore_sel() {
     if (typeof(buttonEnable_sel) === 'function') buttonEnable_sel("Brestore_sel");
     if (typeof(buttonEnable_sel) === 'function') buttonEnable_sel("f_sel_sub_sel");
}

function proc_btn_sel(btn, proc) {
    if ($("#" + btn).prop("disabled") == true) {
        return;
    }
    eval (proc);
}

 function scPackSelected()
 {
  var fieldList, fieldName, i, selectedFields = new Array;
  if (true) {
    fieldList = $('#sorting_list_sel_campos .sc_ui_sorting-list-right').sortable('toArray');
  } else {
    fieldList = $("#sc_id_fldsel_selected").sortable("toArray");
  }
  console.log(fieldList)
  for (i = 0; i < fieldList.length; i++)
  {
    fieldName = fieldList[i].substr(14);
    selectedFields.push(fieldName);
  }
  $("#id_campos_sel_sel_campos").val( selectedFields.join("@?@") );
 }

 $(function() {
  $( "#sc_id_fldsel_selected" ).sortable({
    remove: function( event, ui ) {
            if ($(ui.item).hasClass('scAppDivSelectFieldsDisabled')) {
              return false;
            }
            display_btn_restore_sel();
          } ,
    change: function( event, ui ) {
            display_btn_restore_sel();
          },
    receive: function( event, ui ) {
            display_btn_restore_sel();
          }
  })

  $(".sc_ui_litem").mouseover(function() {
   $(this).css("cursor", "all-scroll");
  });
  $("#sc_id_fldsel_available").sortable({
      connectWith: ".sc_ui_fldsel_selected",
      placeholder: "scAppDivSelectFieldsPlaceholder",
      update: function( event, ui ) {
      if($('#sc_id_fldsel_selected').children('li').length < 1)
      {
        if (typeof(buttonDisable_sel) === 'function') buttonDisable_sel('f_sel_sub_sel');
      }
      else
      {
        if (typeof(buttonEnable_sel) === 'function') buttonEnable_sel('f_sel_sub_sel');
      }
     },
  }).disableSelection();
  $("#sc_id_fldsel_selected").sortable({
   connectWith: ".sc_ui_fldsel_available",
   placeholder: "scAppDivSelectFieldsPlaceholder",
   update: function( event, ui ) {
    if($('#sc_id_fldsel_selected').children('li').length < 1)
    {
      if (typeof(buttonDisable_sel) === 'function') buttonDisable_sel('f_sel_sub_sel');
    }
    else
    {
      if (typeof(buttonEnable_sel) === 'function') buttonEnable_sel('f_sel_sub_sel');
    }
   },
  }).disableSelection();

  if (typeof(buttonDisable_sel) === 'function') buttonDisable_sel('f_sel_sub_sel');
  scUpdateListHeight();
 });
 function scUpdateListHeight() {
  $("#sc_id_fldsel_available").css("min-height", "<?php echo sizeof($tab_ger_campos) * 27 ?>px");
  $("#sc_id_fldsel_selected").css("min-height", "<?php echo sizeof($tab_ger_campos) * 27 ?>px");
 }
</script>

<style type="text/css">
 .sc_ui_sortable {
  list-style-type: none;
  margin: 0;
  min-width: 120px;
 }
 .sc_ui_sortable li {
  margin: 0 3px 3px 3px;
  padding: 3px 3px 3px 15px;
  min-height: 18px;
 }
 .sc_ui_sortable li span {
  position: absolute;
  margin-left: -1.3em;
 }
</style>

  <INPUT type="hidden" name="script_case_init" id="id_script_case_init_sel_campos" value="<?php echo NM_encode_input($this->sc_init); ?>">
  <INPUT type="hidden" name="path_img" id="id_path_img_sel_campos" value="<?php echo NM_encode_input($this->path_img); ?>">
  <INPUT type="hidden" name="path_btn" id="id_path_btn_sel_campos" value="<?php echo NM_encode_input($this->path_btn); ?>">
  <INPUT type="hidden" name="path_fields" id="id_path_fields_sel_campos" value="<?php echo NM_encode_input($this->path_fields); ?>">
  <INPUT type="hidden" name="fsel_ok" id="id_fsel_ok_sel_campos" value="OK">
  <input type="hidden" name="campos_sel" id="id_campos_sel_sel_campos" value="" />

   <table class="<?php echo ($this->embbed)? '':'scGridTabela'; ?>" style="border-width: 0; border-collapse: collapse; width:100%;" cellspacing=0 cellpadding=0>
      <tr class="<?php echo ($this->embbed)? '':'scGridFieldOddVert'; ?>">
         <td style="vertical-align: top">
         <?php
         
      if (true) { 

?>
<style>
    #sorting_list_sel_campos.sc_ui_sortable-wrapper {
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
    #sorting_list_sel_campos .sc_ui_sorting-buttons-wrapper {
        min-width: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
        box-sizing: border-box;
        padding: 0 5px;
    }
    #sorting_list_sel_campos .sc_ui_sorting-buttons-wrapper > a {
        max-width: 35px;
        min-width: 35px;
        box-sizing: border-box;
        padding-left: 0;
        padding-right: 0;
        text-align: center;
    }
    #sorting_list_sel_campos .sc_ui_sorting-list-wrapper {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        justify-content: flex-start;
        max-width: 49%;
        height: 100%;
    }
    #sorting_list_sel_campos .sc_ui_sorting-list {
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
    #sorting_list_sel_campos .sc_ui_sorting-list-wrapper h4 {
        text-align: center;
        margin: 10px 0 5px 0;
    }
    
    #sorting_list_sel_campos .sc_ui_sorting-list li {
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
    
    #sorting_list_sel_campos .sc_ui_sorting-list li.hidden-opt {
        display: none;
    }
    #sorting_list_sel_campos .sc_ui_sorting-list li:hover {
    }
    #sorting_list_sel_campos .sc_ui_sortable-item-moving {
        opacity: .3;
    }
    #sorting_list_sel_campos .sc_ui_sorting-list-item-selected {
        background: Highlight;
        color: HighlightText;
    }
    #sorting_list_sel_campos .sc_ui_sorting-search-container {
        padding: 0 5px;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        justify-content: center;
        height: 45px
    }
    #sorting_list_sel_campos .sc_ui_sorting-list-item-handle {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
    }
    #sorting_list_sel_campos .scAppDivSelectFieldsDisabled .sc_ui_sorting-list-item-handle {
        display: none;
    }
    #sorting_list_sel_campos .scAppDivSelectFieldsDisabled {
        cursor: default !important;
    }
    #sorting_list_sel_campos .sc_ui_sorting-buttons-wrapper a {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
</style>
<script language="javascript" type="text/javascript" src="../_lib/lib/js/sortable.js?v=9.07.0001"></script>
<script language="javascript" type="text/javascript" src="../_lib/lib/js/sortable.jquery.js?v=9.07.0001"></script>
<div class="sc_ui_sortable-wrapper" id="sorting_list_sel_campos">
      <div class="sc_ui_sorting-list-wrapper sc_ui_left-sortable-list">
        <h4><?php echo $this->Nm_lang['lang_othr_groupby_available_fld']; ?></h4>
        <div class='sc_ui_sorting-search-container'>
            <input name='search' class='sc_ui_sorting-search-field css_toolbar_obj' id='search-left' data-side='left' placeholder='<?php echo $this->Nm_lang['lang_btns_srch_lone']; ?>...' />
        </div>
        <ul class="sc_ui_sorting-list sc_ui_sorting-list-left scAppDivSelectFields">
        <?php
        
          if ($this->proc_ajax)
          {
              ob_end_clean();
              ob_start();
          }
           $prep_combo = array();
           foreach ($tab_ger_campos as $NM_cada_field => $NM_cada_opc)
           {
               if ($NM_cada_opc != "none")
               {
                   if ($NM_cada_opc != "on")
                   {
                       $prep_combo[strtolower($NM_cada_field)] = $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['labels'][$NM_cada_field];
                   }
               }
           }
           if ($this->restore)
           {
               ob_end_clean();
               ob_start();
           }
           foreach ($prep_combo as $ind => $cada_field)
           {
        ?>
            <li class="sc_ui_sorting-list-item sc_ui_litem scAppDivSelectFieldsEnabled" data-id="sc_id_itemsel_<?php echo NM_encode_input($ind); ?>" id="sc_id_itemsel_<?php echo NM_encode_input($ind); ?>"><?php 
            echo $cada_field;
            if ($_SESSION['scriptcase']['proc_mobile']) {
                echo '<div class="sc_ui_sorting-list-item-handle"><i class="fa-solid fa-grip-vertical"></i></div>';
            }
             ?></li>
        <?php
           }
           if ($this->restore)
           {
               $this->Arr_result['fldsel_available'] = NM_charset_to_utf8(ob_get_clean());
           }
        
        ?>
        </ul>
        
<?php
      if ($this->proc_ajax)
      {
          $this->ajax_return['setHtml'][] = array('field' => 'select_orig', 'value' => ob_get_contents());
      }
?>
      </div>
      <div class="sc_ui_sorting-buttons-wrapper">
            <a class="scButton_default" onclick="event.preventDefault(); scuiSortingmoveItems('right', true);">
                <i class="fas fa-angle-double-right"></i>
            </a>
            <a class="scButton_default" onclick="event.preventDefault(); scuiSortingmoveItems('right', false);">
                <i class="fas fa-angle-right"></i>
            </a>
            <a class="scButton_default" onclick="event.preventDefault(); scuiSortingmoveItems('left', false);">
                <i class="fas fa-angle-left"></i>
            </a>
            <a class="scButton_default" onclick="event.preventDefault(); scuiSortingmoveItems('left', true);">
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
   if ($this->restore)
   {
       ob_end_clean();
       ob_start();
   }
   if ($this->restore && isset($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order_orig']))
   {
       foreach ($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order_orig'] as $NM_cada_field)
       {
           if ($tab_ger_campos[$NM_cada_field] == "on")
           {
               $str_class = "scAppDivSelectFieldsDisabled";
               if (!in_array($NM_cada_field, $tab_blk_campos))
               {
                  $str_class = "scAppDivSelectFieldsEnabled";
               }
?>
                        <li class="sc_ui_sorting-list-item sc_ui_litem <?php echo $str_class; ?>" data-id="sc_id_itemsel_<?php echo NM_encode_input($NM_cada_field); ?>" id="sc_id_itemsel_<?php echo NM_encode_input($NM_cada_field); ?>"><?php 
                        echo $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['labels'][$NM_cada_field];
                        if ($_SESSION['scriptcase']['proc_mobile']) {
                            echo '<div class="sc_ui_sorting-list-item-handle"><i class="fa-solid fa-grip-vertical"></i></div>';
                        } 
                        ?></li>
<?php
           }
       }
   }
   if ($this->restore)
   {
       $this->Arr_result['fldsel_selected'] = NM_charset_to_utf8(ob_get_clean());
       $oJson = new Services_JSON();
       echo $oJson->encode($this->Arr_result);
       exit;
   }
   if (!$this->restore && isset($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order']))
   {
       foreach ($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order'] as $NM_cada_field)
       {
           if ($tab_ger_campos[$NM_cada_field] == "on")
           {
               $str_class = "scAppDivSelectFieldsDisabled";
               if (!in_array($NM_cada_field, $tab_blk_campos))
               {
                  $str_class = "scAppDivSelectFieldsEnabled";
               }
?>
                        <li class="sc_ui_sorting-list-item sc_ui_litem <?php echo $str_class; ?>" data-id="sc_id_itemsel_<?php echo NM_encode_input($NM_cada_field); ?>" id="sc_id_itemsel_<?php echo NM_encode_input($NM_cada_field); ?>"><?php 
                        echo $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['labels'][$NM_cada_field];
                        
                        if ($_SESSION['scriptcase']['proc_mobile']) {
                            echo '<div class="sc_ui_sorting-list-item-handle"><i class="fa-solid fa-grip-vertical"></i></div>';
                        } 
                         ?></li>
<?php
           }
       }
   }


?>
        </ul>

<?php
      if ($this->proc_ajax)
      {
          $this->ajax_return['setHtml'][] = array('field' => 'select_dest', 'value' => ob_get_contents());
      }
?>
      </div>
</div>
<script>
    var sc_ui_sortable_obj;
    function scuiSortingmoveItems(direction, moveall) {
        var field_wrapper = $('#sorting_list_sel_campos');
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
            display_btn_restore_sel();
        }
        lists[direction].scrollTop(0);
    }
    function outClickSel(e) {
        var tagname = e.target.tagName;
        if (
            !$(e.target).is('a, a *, button, button *, select, select *, option, option *, input, input *, .sc_ui_sorting-list, .sc_ui_sorting-list *')
            ) {
            deselectAllSel();
            $(document).off('mousedown.deselect_sel_campos');
            $(document).off('touchstart.deselect_sel_campos');
        }
    }
    function deselectAllSel() {
        var field_wrapper = $(document);
        var sel_items;
        
        sel_items = field_wrapper.find('.sc_ui_sorting-list-item-selected');
        sel_items.each(function (i,item) {
            Sortable.utils.deselect(item);
        });
    }
    $('#sorting_list_sel_campos .sc_ui_sorting-search-field').on('input', function(ev) {
        var side = $(ev.target).attr('data-side');
        var list = $('#sorting_list_sel_campos .sc_ui_sorting-list-'+side+' li');
        if (ev.target.value.trim() != '') {
            list.addClass('hidden-opt');
            list.each(function(index, opt) {
                var opt_txt = $(opt).html().normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
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
                $('#sorting_list_sel_campos .sc_ui_sorting-list-item').not('.scAppDivSelectFieldsDisabled').on('click', function(ev) {
                    if ($(ev.target).is('.sc_ui_sorting-list-item-selected')) {
                        Sortable.utils.deselect(ev.target);
                    } else {
                        Sortable.utils.select(ev.target);
                    }
                    
                    $(document).off('touchstart.deselect_sel_campos');
                    $(document).on('touchstart.deselect_sel_campos', function(e) {
                        outClickSel(e);
                    });
                });
            <?php
        }
      ?>
    sc_ui_sortable_obj_sel = $('#sorting_list_sel_campos .sc_ui_sorting-list-left').sortable({
        multiGrab: true,
        multiDrag: true,
        sort: false,
        avoidImplicitDeselect: true,
        filter: '.scAppDivSelectFieldsDisabled',
        selectedClass: "sc_ui_sorting-list-item-selected",
        ghostClass: 'sc_ui_sortable-item-moving',
        group: 'sel_columns',
        animation: 150,
        onChange: function () {
            display_btn_restore_sel();
        },
        onSelect: function(ev) {
            $(document).off('mousedown.deselect_sel_campos');
            $(document).off('touchstart.deselect_sel_campos');
            if ($('#sorting_list_sel_campos').find('.sc_ui_sorting-list-item-selected')[0]) {
                $(document).on('mousedown.deselect_sel_campos', function(e) {
                    if (e.button === 0) {
                        outClickSel(e);
                    }
                });
                $(document).on('touchstart.deselect_sel_campos', function(e) {
                    outClickSel(e);
                });
            }
        }
      <?php
      
            if ($_SESSION['scriptcase']['proc_mobile']) {
                echo ', handle: ".sc_ui_sorting-list-item-handle" ';
            }
      ?>
    })
    sc_ui_sortable_obj_sel = $('#sorting_list_sel_campos .sc_ui_sorting-list-right').sortable({
        multiGrab: true,
        multiDrag: true,
        avoidImplicitDeselect: true,
        filter: '.scAppDivSelectFieldsDisabled',
        selectedClass: "sc_ui_sorting-list-item-selected",
        ghostClass: 'sc_ui_sortable-item-moving',
        group: 'sel_columns',
        animation: 150,
        onChange: function () {
            display_btn_restore_sel();
        },
        onSelect: function(ev) {
            $(document).off('mousedown.deselect_sel_campos');
            $(document).off('touchstart.deselect_sel_campos');
            if ($('#sorting_list_sel_campos').find('.sc_ui_sorting-list-item-selected')[0]) {
                $(document).on('mousedown.deselect_sel_campos', function(e) {
                    if (e.button === 0) {
                        outClickSel(e);
                    }
                });
                $(document).on('touchstart.deselect_sel_campos', function(e) {
                    outClickSel(e);
                });
            }
        }
      <?php
      
            if ($_SESSION['scriptcase']['proc_mobile']) {
                echo ', handle: ".sc_ui_sorting-list-item-handle" ';
            }
      ?>
    })
</script>
      <?php
      } else {
      ?>
            <table>
               <tr>
                  <td id="select_orig" style="vertical-align: top">
<?php
      if ($this->proc_ajax)
      {
          ob_end_clean();
          ob_start();
      }

      echo $this->Nm_lang['lang_othr_groupby_available_fld'];
?>
                     <ul class="sc_ui_sort_groupby sc_ui_sortable sc_ui_fldsel_available scAppDivSelectFields" id="sc_id_fldsel_available">
<?php
   $prep_combo = array();
   foreach ($tab_ger_campos as $NM_cada_field => $NM_cada_opc)
   {
       if ($NM_cada_opc != "none")
       {
           if ($NM_cada_opc != "on")
           {
               $prep_combo[strtolower($NM_cada_field)] = $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['labels'][$NM_cada_field];
           }
       }
   }
   if ($this->restore)
   {
       ob_end_clean();
       ob_start();
   }
   foreach ($prep_combo as $ind => $cada_field)
   {
?>
                        <li class="sc_ui_litem scAppDivSelectFieldsEnabled" id="sc_id_itemsel_<?php echo NM_encode_input($ind); ?>"><?php echo $cada_field; ?></li>
<?php
   }
   if ($this->restore)
   {
       $this->Arr_result['fldsel_available'] = NM_charset_to_utf8(ob_get_clean());
   }

?>
                     </ul>
<?php
      if ($this->proc_ajax)
      {
          $this->ajax_return['setHtml'][] = array('field' => 'select_orig', 'value' => ob_get_contents());
      }
?>
                  </td>
                  <td style="vertical-align: top" id="select_dest">
<?php
      if ($this->proc_ajax)
      {
          ob_end_clean();
          ob_start();
      }

      echo $this->Nm_lang['lang_othr_groupby_selected_fld'];
?>

                     <ul class="sc_ui_sort_groupby sc_ui_sortable sc_ui_fldsel_selected scAppDivSelectFields" id="sc_id_fldsel_selected">
<?php
   if ($this->restore)
   {
       ob_end_clean();
       ob_start();
   }
   if ($this->restore && isset($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order_orig']))
   {
       foreach ($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order_orig'] as $NM_cada_field)
       {
           if ($tab_ger_campos[$NM_cada_field] == "on")
           {
               $str_class = "scAppDivSelectFieldsDisabled";
               if (!in_array($NM_cada_field, $tab_blk_campos))
               {
                  $str_class = "scAppDivSelectFieldsEnabled";
               }
?>
                        <li class="sc_ui_litem <?php echo $str_class; ?>" id="sc_id_itemsel_<?php echo NM_encode_input($NM_cada_field); ?>"><?php echo $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['labels'][$NM_cada_field]; ?></li>
<?php
           }
       }
   }
   if ($this->restore)
   {
       $this->Arr_result['fldsel_selected'] = NM_charset_to_utf8(ob_get_clean());
       $oJson = new Services_JSON();
       echo $oJson->encode($this->Arr_result);
       exit;
   }
   if (!$this->restore && isset($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order']))
   {
       foreach ($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order'] as $NM_cada_field)
       {
           if ($tab_ger_campos[$NM_cada_field] == "on")
           {
               $str_class = "scAppDivSelectFieldsDisabled";
               if (!in_array($NM_cada_field, $tab_blk_campos))
               {
                  $str_class = "scAppDivSelectFieldsEnabled";
               }
?>
                        <li class="sc_ui_litem <?php echo $str_class; ?>" id="sc_id_itemsel_<?php echo NM_encode_input($NM_cada_field); ?>"><?php echo $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['labels'][$NM_cada_field]; ?></li>
<?php
           }
       }
   }


?>
                     </ul>

<?php
      if ($this->proc_ajax)
      {
          $this->ajax_return['setHtml'][] = array('field' => 'select_dest', 'value' => ob_get_contents());
      }
?>

                  </td>
               </tr>
            </table>
            <?php 
}
?>
         </td>
      </tr>                <tr>
                 <td class="<?php echo ($this->embbed)? 'scAppDivToolbar':'scGridToolbar'; ?>">
<?php
  $disp_rest = "none";
  if (isset($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel']) && isset($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel_orig']) && $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel'] != $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel_orig']) {
      $disp_rest = "";
  }
  else {
      $order_orig = array();
      $order_atu  = array();
      foreach ($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order_orig'] as $ix => $cmp) {
          if (!isset($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel_orig'][$cmp]) || $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel_orig'][$cmp] != "off") {
              $order_orig[] = $cmp;
          }
      }
      foreach ($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['field_order'] as $ix => $cmp) {
          if (!isset($_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel'][$cmp]) || $_SESSION['sc_session'][$this->sc_init]['grid_alerta_pb']['usr_cmp_sel'][$cmp] != "off") {
              $order_atu[] = $cmp;
          }
      }
      if ($order_orig != $order_atu) {
          $disp_rest = "";
      }
  }
  if ($display_btn)
  {
   if (!$this->embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bok_appdiv", "proc_btn_sel('f_sel_sub_sel','submit_form_Fsel()')", "proc_btn_sel('f_sel_sub_sel','submit_form_Fsel()')", "f_sel_sub_sel", "", "", "", "absmiddle", "", "0px", $this->path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bapply_appdiv", "proc_btn_sel('f_sel_sub_sel', 'scSubmitSelCampos(\\'" . NM_encode_input($this->tbar_pos) . "\\')')", "proc_btn_sel('f_sel_sub_sel', 'scSubmitSelCampos(\\'" . NM_encode_input($this->tbar_pos) . "\\')')", "f_sel_sub_sel", "", "", "", "absmiddle", "", "0px", $this->path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
  &nbsp;&nbsp;&nbsp
<?php
   if (!$this->embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "brestore_appdiv", "proc_btn_sel('Brestore_sel','restore_sel()')", "proc_btn_sel('Brestore_sel','restore_sel()')", "Brestore_sel", "", "", "", "absmiddle", "", "0px", $this->path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "brestore_appdiv", "proc_btn_sel('Brestore_sel','restore_sel()')", "proc_btn_sel('Brestore_sel','restore_sel()')", "Brestore_sel", "", "", "", "absmiddle", "", "0px", $this->path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
  &nbsp;&nbsp;&nbsp
<?php
   if (!$this->embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bsair_appdiv", "self.parent.tb_remove(); buttonunselectedSF();", "self.parent.tb_remove(); buttonunselectedSF();", "Bsair", "", "", "", "absmiddle", "", "0px", $this->path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   elseif ($_SESSION['scriptcase']['proc_mobile'])
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "closeAllModalPanes();", "closeAllModalPanes();", "Bsair", "", "", "", "absmiddle", "", "0px", $this->path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "scBtnSelCamposHide('" . NM_encode_input($this->tbar_pos) . "'); buttonunselectedSF();", "scBtnSelCamposHide('" . NM_encode_input($this->tbar_pos) . "'); buttonunselectedSF();", "Bsair", "", "", "", "absmiddle", "", "0px", $this->path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
  }
?>
                 </td>
              </tr>
            </table>
<script language="javascript"> 
function buttonDisable_sel(buttonId) {
   $("#" + buttonId).prop("disabled", true).addClass("disabled");
}
function buttonSelectedSF() {
   parent.$("#selcmp_top").addClass("selected");
   parent.$("#selcmp_bottom").addClass("selected");
}
function buttonunselectedSF() {
   parent.$("#selcmp_top").removeClass("selected");
   parent.$("#selcmp_bottom").removeClass("selected");
}
function buttonEnable_sel(buttonId) {
   $("#" + buttonId).prop("disabled", false).removeClass("disabled");
}
$(document).ready(function() {
   if (typeof(buttonDisable_sel) === 'function') buttonDisable_sel("f_sel_sub_sel");
<?php
   if ($disp_rest == "none") {
?>
   if (typeof(buttonDisable_sel) === 'function') buttonDisable_sel("Brestore_sel");
<?php
   }
?>
});
</script>
<?php
}
function Sel_processa_form()
{
   global $tab_ger_campos, $tab_blk_campos;
   if ($this->proc_ajax || $this->restore)
   {
       ob_start();
   }
   $size = 10;
   $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_SweetBlue/Sc9_SweetBlue";
   include("../_lib/css/" . $str_schema_all . "_grid.php");
   $Str_btn_grid = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
   include("../_lib/buttons/" . $Str_btn_grid);
   if (!function_exists("nmButtonOutput"))
   {
       include_once("../_lib/lib/php/nm_gp_config_btn.php");
   }
   if (!$this->embbed)
   {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Información / Acumulación de Faltas</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
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
<FORM name="Fsel_campos" method="POST"><?php
if ($this->embbed)
{
    echo "   <div class='scAppDivMoldura'>";
    echo "   <table id=\"main_table\" style=\"width: 100%\" cellspacing=0 cellpadding=0>";
}
elseif ($_SESSION['scriptcase']['reg_conf']['html_dir'] == " DIR='RTL'")
{
    echo "   <table id=\"main_table\" style=\"position: relative; top: 10px; right: 10px\">";
}
else
{
    echo "   <table id=\"main_table\" style=\"position: relative; top: 10px; left: 10px\">";
}
?>
<?php
if (!$this->embbed)
{
?>
  <tr>
     <td>
        <div class="scGridBorder">
           <table width='100%' cellspacing=0 cellpadding=0>
<?php
}
?>
              <tr>
                 <td class="<?php echo ($this->embbed)? 'scAppDivHeader scAppDivHeaderText':'scGridLabelVert'; ?>">
                    <?php echo $this->Nm_lang['lang_btns_clmn_hint']; ?>
                 </td>
                </tr>
                <tr>
                 <td class="<?php echo ($this->embbed)? 'scAppDivContent css_scAppDivContentText':'scGridTabelaTd'; ?>">
                    <?php $this->displayHtml(!$this->embbed); ?>
                 </td>
                </tr>
<?php
if (!$this->embbed)
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
if ($this->embbed)
{
?>
    </div>
<?php
}
?>
</FORM>
<?php
   if (!$this->embbed)
   {
?>
<script language="javascript"> 
var bFixed = false;
function ajusta_window_Fsel()
{
  var mt = $(document.getElementById("main_table"));
  if (0 == mt.width() || 0 == mt.height())
  {
    setTimeout("ajusta_window_Fsel()", 50);
    return;
  }
  else if(!bFixed)
  {
    var oOrig = $(document.Fsel_campos.sel_orig),
        oDest = $(document.Fsel_campos.sel_dest),
        mHeight = Math.max(oOrig.height(), oDest.height()),
        mWidth = Math.max(oOrig.width() + 5, oDest.width() + 5);
    oOrig.height(mHeight);
    oOrig.width(mWidth);
    oDest.height(mHeight);
    oDest.width(mWidth);
    bFixed = true;
    if (navigator.userAgent.indexOf("Chrome/") > 0)
    {
      strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
      self.parent.tb_resize(strMaxHeight + 20, mt.width() + 20);
      setTimeout("ajusta_window_Fsel()", 50);
      return;
    }
  }
  strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
  self.parent.tb_resize(strMaxHeight + 20, mt.width() + 20);
}
$( document ).ready(function() {
  ajusta_window_Fsel();
});
</script>
<script>
  ajusta_window_Fsel();
</script>
</BODY>
</HTML>
<?php
   }
   if ($this->proc_ajax)
   {
       ob_end_clean();
       $oJson = new Services_JSON();
       echo $oJson->encode($this->ajax_return);
       exit;
   }
}
}