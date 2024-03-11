<?php
/**
 * $Id: nm_gp_config_csv.php,v 1.2 2018-11-16 13:02:59 sergio Exp $
 */

/*
@ini_set('session.cookie_httponly', 1);
@ini_set('session.use_only_cookies', 1);
*/

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
    $SC_cod_proj = "Proyecto_gestion_faltas";
    $SC_apl_proc = "grid_alerta_pb";
    $SC_conf_opt = explode(",","tem_res_cons,tem_res_res,nm_delim_line,nm_delim_col,nm_delim_dados,nm_label_csv");
/* sc_apl_default */
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
        if (is_file($root . $_SESSION['scriptcase'][$SC_apl_proc]['glo_nm_path_imag_temp'] . "/sc_apl_default_" . $SC_cod_proj . ".txt"))
        {
?>
            <script language="javascript">
               parent.nm_move();
            </script>
<?php
            exit;
        }
    }
    $delim_line  = (isset($_GET['nm_delim_line']))  ? $_GET['nm_delim_line']  : "1";
    $delim_col   = (isset($_GET['nm_delim_col']))   ? $_GET['nm_delim_col']   : "1";
    $delim_dados = (isset($_GET['nm_delim_dados'])) ? $_GET['nm_delim_dados'] : "1";
    $label_csv   = (isset($_GET['nm_label_csv']))   ? $_GET['nm_label_csv']   : "N";
    $language    = (isset($_GET['language']))       ? $_GET['language']       : "port";
    $origem      = (isset($_GET['origem']))         ? $_GET['origem']         : "cons";
    $res_cons    = (isset($_GET['nm_res_cons']))    ? $_GET['nm_res_cons']    : "n";
    $password    = (isset($_GET['password']))       ? $_GET['password']       : "s";
    $ini_csv_res  = explode(",", $_GET['nm_ini_csv_res']);
    $all_modules  = explode(",", $_GET['nm_all_modules']);
/*--- exportacoes ajax */
    $export_ajax = (isset($_GET['export_ajax'])) ? $_GET['export_ajax'] : 'N';
/*--------*/
    $script_case_init = (isset($_GET['script_case_init'])) ? filter_input(INPUT_GET, 'script_case_init', FILTER_SANITIZE_NUMBER_INT) : 'N';
/*    $hasSelColumns= (isset($_GET['summary_export_columns']))  ? 'S' == filter_input(INPUT_GET, 'summary_export_columns', FILTER_SANITIZE_STRING) : false; */
    $hasSelColumns= (isset($_GET['summary_export_columns']))  ? 'S' == strip_tags($_GET['summary_export_columns']) : false;
    if (isset($_SESSION['sc_session'][$script_case_init][$SC_apl_proc]['field_order'])) {
        foreach ($_SESSION['sc_session'][$script_case_init][$SC_apl_proc]['field_order'] as $ind => $cada_cmp) {
            if (!isset($_SESSION['sc_session'][$script_case_init][$SC_apl_proc]['labels'][$cada_cmp])) {
               $hasSelColumns = false;
            }
        }
    }
    else {
         $hasSelColumns = false;
    }
/*
    if (!in_array("campos_sel", $SC_conf_opt)) {
        $hasSelColumns = false;
    }
*/
    ini_set('default_charset', $_SESSION['scriptcase']['charset']);
    if (!function_exists("NM_is_utf8"))
    {
        include_once("../_lib/lib/php/nm_utf8.php");
    }

    $tradutor = array();
    if (isset($_SESSION['scriptcase']['sc_idioma_csv']))
    {
        $tradutor = $_SESSION['scriptcase']['sc_idioma_csv'];
    }
    if (!isset($tradutor[$language]))
    {
        foreach ($tradutor as $language => $resto)
        {
            break;
        }
    }
    if (!isset($tradutor[$language]))
    {
       exit;
    }

?>
<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<head>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html']; ?>" />
<?php
if ((isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])  || (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
 <link rel="stylesheet" type="text/css" href="../_lib/lib/css/nm_export_mobile.css" />
<?php
}
?>
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup'] ?>" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_dir'] ?>" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_tab'] ?>" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_tab_dir'] ?>" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div'] ?>" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div_dir'] ?>" />
 <?php
  if(isset($_SESSION['scriptcase']['str_google_fonts']) && !empty($_SESSION['scriptcase']['str_google_fonts'])) {
    ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['scriptcase']['str_google_fonts']; ?>" />
    <?php
  }
 ?>
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $_SESSION['scriptcase']['css_btn_popup'] ?>" />
 <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['sc_session']['path_third'] ?>/font-awesome/css/all.min.css" />
</head>
<body class="scGridPage" style="margin: 0px; overflow-x: hidden">

<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery-ui.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.js"></script>

<form name="config_csv" method="post" action="" autocomplete="off">
<?php
$pos = "left";
if ($_SESSION['scriptcase']['reg_conf']['html_dir'] == " DIR='RTL'")
{
    $pos = "right";
}
$colspan = ($_SESSION['scriptcase']['proc_mobile']) ? 1 : 2;
?>
<table id="main_table" class="exportConfig" style="position: relative; top: 20px; <?php echo $pos; ?>: 20px">
<tr>
 <td align="center">

  <div id="tabs">
    <ul class="scAppDivTabLine" style="display:<?php echo ($hasSelColumns)?"":"none"; ?>">
      <li class="scTabActive scGridToolbar" id="ctrl_tabs-general" style="font-weight: bold;cursor: pointer;" onclick="change_tabs('tabs-general', 'tabs-sel-columns')"><?php echo $tradutor[$language]['titulo']; ?></li>
      <li class="scTabInactive scGridToolbar" id="ctrl_tabs-sel-columns" style="font-weight: bold;cursor: pointer;" onclick="change_tabs('tabs-sel-columns', 'tabs-general')"><?php echo $tradutor[$language]['titulo_colunas']; ?></li>
    </ul>
    <div id="tabs-general" style="padding: 0px; margin: 0px">

      <table class="scGridBorder" width='100%' cellspacing="0" cellpadding="0">
          <tr style="display:<?php echo ($hasSelColumns)?"none":""; ?>">
            <td colspan=<?php echo $colspan; ?> class="scGridLabelVert"><?php echo $tradutor[$language]['titulo']; ?></td>
          </tr>
          <tr><td nowrap class='scGridToolbar' colspan=<?php echo $colspan; ?> style='font-weight: bold;'><?php echo $tradutor[$language]['group_general']; ?></td></tr>

      <?php
      if ($res_cons == "s" && $origem != "chart")
      {
          $Opt_display = (($origem == 'cons' && !in_array("tem_res_cons", $SC_conf_opt)) || ($origem == 'res' && !in_array("tem_res_res", $SC_conf_opt))) ? ' style="display: none"' : '';
      ?>
       <tr<?php echo $Opt_display ?>>
         <td nowrap class="scGridFieldOddFont" align="left">
             <?php echo $tradutor[$language]['modules']; ?>
<?php
    if ($_SESSION['scriptcase']['proc_mobile']) {
        echo "           <br>";
    }
    else {
        echo "         </td><td nowrap class=\"scGridFieldOddFont\" align=\"left\">";
    }
?>
          <div class="input-group input-group-horizontal">
          <?php
             foreach ($all_modules as $cada_mod)
             {
                 if ($cada_mod != 'chart')
                 {
                     $ckeck    = (in_array($cada_mod, $ini_csv_res)) ? "checked" : "";
                     $set_grid = ($cada_mod == "grid") ? ' onclick="contrl_mod_grid(this)" ' : '';
                 ?>
                    <label>
                    <input type=checkbox id="id_tem_res_cons" name="tem_res_cons[]"  <?php echo $ckeck . $set_grid ?> value="<?php echo $cada_mod ?>"><?php echo $tradutor[$language]['mod_' . $cada_mod]; ?>
                     </label>

                 <?php
                 }
             }
          ?>
        </div>
         </td>
      </tr>
      <?php
      }
        $Opt_display = (!in_array("nm_delim_line", $SC_conf_opt)) ? ' style="display: none"' : '';
      ?>
         <tr<?php echo $Opt_display ?>>
           <td class="scGridFieldOddFont" align="left">
               <?php echo $tradutor[$language]['delim_line']; ?>
<?php
    if ($_SESSION['scriptcase']['proc_mobile']) {
        echo "           <br>";
    }
    else {
        echo "           </td><td class=\"scGridFieldOddFont\" align=\"left\">";
    }
?>
            <SELECT id="id_delim_line" name="nm_delim_line" size="1">
        <?php
           $ckeck = ($delim_line == "1") ? "selected" : "";
        ?>
              <option value="1" <?php echo $ckeck ?>>CRLF
        <?php
           $ckeck = ($delim_line == "2") ? "selected" : "";
        ?>
              <option value="2" <?php echo $ckeck ?>>CR
        <?php
           $ckeck = ($delim_line == "3") ? "selected" : "";
        ?>
              <option value="3" <?php echo $ckeck ?>>LF
            </SELECT>
           </td>
         </tr>

        <?php
           $Opt_display = (!in_array("nm_delim_col", $SC_conf_opt)) ? ' style="display: none"' : '';
        ?>
         <tr<?php echo $Opt_display ?>>
           <td class="scGridFieldOddFont" align="left">
               <?php echo $tradutor[$language]['delim_col']; ?>
<?php
    if ($_SESSION['scriptcase']['proc_mobile']) {
        echo "           <br>";
    }
    else {
        echo "           </td><td class=\"scGridFieldOddFont\" align=\"left\">";
    }
?>
            <SELECT id="id_delim_col" name="nm_delim_col" size="1">
        <?php
           $ckeck = ($delim_col == "1") ? "selected" : "";
        ?>
              <option value="1" <?php echo $ckeck ?>>;
        <?php
           $ckeck = ($delim_col == "2") ? "selected" : "";
        ?>
              <option value="2" <?php echo $ckeck ?>>,
        <?php
           $ckeck = ($delim_col == "3") ? "selected" : "";
        ?>
              <option value="3" <?php echo $ckeck ?>>Tab
        <?php
           $ckeck = ($delim_col == "4") ? "selected" : "";
        ?>
              <option value="4" <?php echo $ckeck ?>>#
        <?php
           $ckeck = ($delim_col == "5") ? "selected" : "";
        ?>
              <option value="5" <?php echo $ckeck ?>>None
            </SELECT>
           </td>
         </tr>

        <?php
           $Opt_display = (!in_array("nm_delim_dados", $SC_conf_opt)) ? ' style="display: none"' : '';
        ?>
         <tr<?php echo $Opt_display ?>>
           <td class="scGridFieldOddFont" align="left">
               <?php echo $tradutor[$language]['delim_dados']; ?>
<?php
    if ($_SESSION['scriptcase']['proc_mobile']) {
        echo "           <br>";
    }
    else {
        echo "           </td><td class=\"scGridFieldOddFont\" align=\"left\">";
    }
?>
            <SELECT id="id_delim_dados" name="nm_delim_dados" size="1">
        <?php
           $ckeck = ($delim_dados == "1") ? "selected" : "";
        ?>
              <option value="1" <?php echo $ckeck ?>>"
        <?php
           $ckeck = ($delim_dados == "2") ? "selected" : "";
        ?>
              <option value="2" <?php echo $ckeck ?>>'
        <?php
           $ckeck = ($delim_dados == "4") ? "selected" : "";
        ?>
              <option value="4" <?php echo $ckeck ?>>|
        <?php
           $ckeck = ($delim_dados == "3") ? "selected" : "";
        ?>
              <option value="3" <?php echo $ckeck ?>>None
            </SELECT>
           </td>
         </tr>

        <?php
           $Opt_display = (!in_array("nm_label_csv", $SC_conf_opt)) ? ' style="display: none"' : '';
        ?>
         <tr<?php echo $Opt_display ?>>
           <td class="scGridFieldOddFont" align="left">
               <?php echo $tradutor[$language]['label_csv']; ?>
<?php
    if ($_SESSION['scriptcase']['proc_mobile']) {
        echo "           <br>";
    }
    else {
        echo "           </td><td class=\"scGridFieldOddFont\" align=\"left\">";
    }
?>
            <div class="input-group input-group-horizontal">
        <?php
           $ckeck = ($label_csv == "S") ? "checked" : "";
        ?>
             <label><input type=checkbox id="id_nm_label_csv" name="nm_label_csv[]" <?php echo $ckeck ?>></label>
              </div>
           </td>
         </tr>
     <?php
      if ($password == "s")
      {
/*         $Opt_display = (!in_array("password", $SC_conf_opt)) ? ' style="display: none"' : ''; */
         $Opt_display = (!in_array("password", $SC_conf_opt)) ? '' : '';
     ?>
       <tr<?php echo $Opt_display ?>>
         <td nowrap class="scGridFieldOddFont" align="left">
             <?php echo $tradutor[$language]['password']; ?>
<?php
    if ($_SESSION['scriptcase']['proc_mobile']) {
        echo "         <br>";
    }
    else {
        echo "         </td><td nowrap class=\"scGridFieldOddFont\" align=\"left\">";
    }
?>
           <input type=password name="password" value="" size=30>
         </td>
      </tr>
      <?php
      }
      ?>
      </table>
    </div>
    <div id="tabs-sel-columns" style="padding: 0px; margin: 0px; display:none">

        <?php
        if($hasSelColumns)
        {
          $bol_sel_campos_include = true;
          if(!isset($app_name))
          {
            $app_name = $SC_apl_proc;
          }
          include($app_name . "_sel_campos.php");
          $class_name = (is_numeric(substr($app_name, 0, 1))) ? "_" . $app_name : $app_name;
          $sel_campos = $class_name . "_sel_cmp";
          $sel_campos = new $sel_campos($bol_sel_campos_include, $script_case_init);
          $sel_campos->Sel_cmp_init();
          $sel_campos->Sel_cmp_init_fields();
          $sel_campos->displayHtml(false, false);
        }
        ?>

    </div>
  </div>
  <div class="buttons">
    <?php
    if ($_SESSION['scriptcase']['proc_mobile']) {
        echo "    <table><tr><td>";
    }
    echo  $_SESSION['scriptcase']['bg_btn_popup']['bok'];
    echo  "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo  $_SESSION['scriptcase']['bg_btn_popup']['btbremove'];
    if ($_SESSION['scriptcase']['proc_mobile']) {
        echo "    </td></tr></table>";
    }
    ?>
  </div>

 </td>
 </tr>
</table>
</form>


<script language="javascript">
var bFixed = false;
function ajusta_window()
{
  var mt   = $(document.getElementById("main_table"));
  var mt1  = $(document.getElementById("tabs-general"));
  altura  = mt1.height();
  largura = mt1.width();
  if($('#tabs-sel-columns').length > 0)
  {
    mt2  = $(document.getElementById("tabs-sel-columns"));
    if(mt2.height() > altura)
    {
      altura = mt2.height();
    }
    if(mt2.width() > largura)
    {
      largura = mt2.width();
    }
  }

  //protect against max windows
  if((altura + 220) > parent.window.innerHeight) altura = parent.window.innerHeight - 220;

  if (0 == largura || 0 == altura)
  {
    setTimeout("ajusta_window()", 50);
    return;
  }
  else if(!bFixed)
  {
    bFixed = true;
    if (navigator.userAgent.indexOf("Chrome/") > 0)
    {
      self.parent.tb_resize(altura + 150, largura + 40);
      setTimeout("ajusta_window()", 50);
      return;
    }
  }
  mt.width( largura );
  self.parent.tb_resize(altura + 150, largura + 40);
}

function change_tabs(tab_on, tab_off) {
    $('#ctrl_' + tab_off).removeClass("scTabActive");
    $('#ctrl_' + tab_off).addClass("scTabInactive");
    $('#ctrl_' + tab_on).removeClass("scTabInactive");
    $('#ctrl_' + tab_on).addClass("scTabActive");
    $('#' + tab_off).hide();
    $('#' + tab_on).show();
}

$( document ).ready(function() {
    adjustMobile();
   setTimeout("ajusta_window();$('#tabs > ul > li:first-child').click();", 50);
<?php
  if ($password == "s")
  {
?>
   document.config_csv.password.value = "";
<?php
  }
?>
});

  function scSubmitSelCamposAjaxExportDone()
  {
    saveSelColumns = true;
    processa();
  }

  var saveSelColumns = false;
  function processa()
  {
     <?php
     if($hasSelColumns)
     {
      ?>
      if(saveSelColumns == false)
      {
        scSubmitSelCamposAjaxExport();
        return false;
      }
      <?php
     }
     ?>

     <?php
     if($export_ajax != "S" && $export_ajax != "R" && $export_ajax != "D")
     {
      ?>
      self.parent.tb_remove();
      <?php
     }
     ?>

     delim_line  = document.config_csv.nm_delim_line.value;
     delim_col   = document.config_csv.nm_delim_col.value;
     delim_dados = document.config_csv.nm_delim_dados.value;
     label_csv   = "N";
     Nobj = document.getElementById('id_nm_label_csv').name;
     obj  = document.getElementsByName(Nobj);
     for (iCheck = 0; iCheck < obj.length; iCheck++) {
        if (obj[iCheck].checked) {
            label_csv = "S";
            break;
        }
     }

     res_cons = "";
     if (document.config_csv.id_tem_res_cons)
     {
         Nobj = document.getElementById('id_tem_res_cons').name;
         obj  = document.getElementsByName(Nobj);
         for (iCheck = 0; iCheck < obj.length; iCheck++) {
              if (obj[iCheck].checked) {
                  if (res_cons != "") {
                     res_cons += ",";
                  }
                  res_cons += obj[iCheck].value;
              }
         }
     }
     else
     {
         res_cons = "<?php if ($origem == "cons") {echo "grid";} else {echo "resume";} ?>";
     }
     if (res_cons == "")
     {
        return;
     }

     use_pass = "";
     <?php
     if($password == "s")
     {
      ?>
         use_pass = document.config_csv.password.value;
      <?php
     }
     ?>

/*--- exportacoes ajax */
<?php
     if ($export_ajax == 'S') {
?>
         parent.nm_gp_csv_conf(delim_line, delim_col, delim_dados, label_csv, res_cons, use_pass, '<?php echo NM_encode_input($export_ajax); ?>', 'csv', false);return false;
<?php
     }
     else if ($export_ajax == 'R') {
?>
         parent.nm_gp_csv_conf(delim_line, delim_col, delim_dados, label_csv, res_cons, use_pass, '<?php echo NM_encode_input($export_ajax); ?>', 'csv_res', false);return false;
<?php
     } else {
?>
         parent.nm_gp_csv_conf(delim_line, delim_col, delim_dados, label_csv, res_cons, use_pass, '<?php echo NM_encode_input($export_ajax); ?>', '', false);return false;
<?php
     }
?>
/*--------*/

     $('#bsair').click();

  }
  function contrl_mod_grid(obj)
  {
     if (obj.checked)
     {
         document.getElementById('ctrl_tabs-sel-columns').style.display = '';
     }
     else
     {
         document.getElementById('ctrl_tabs-sel-columns').style.display = 'none';
     }
  }
    function adjustMobile()
    {
        <?php
        if($_SESSION['scriptcase']['proc_mobile'])
        {
        ?>
        $('.scAppDivTabLine').css('background-color', $('.scGridPage').css('background-color'));
        <?php
        }
        ?>
    }
</script>
<script>
    //colocado aqui devido a execução modal não executar o ready do jquery
    adjustMobile();
    setTimeout("ajusta_window()", 50);
</script>
</body>
</html>