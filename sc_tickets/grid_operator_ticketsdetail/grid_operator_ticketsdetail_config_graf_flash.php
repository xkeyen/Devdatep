<?php
/**
 * $Id: nm_gp_config_graf_flash.php,v 1.8 2012-01-27 13:02:59 sergio Exp $
 */

/*
@ini_set('session.cookie_httponly', 1);
@ini_set('session.use_only_cookies', 1);
*/

    include_once('grid_operator_ticketsdetail_session.php');
    session_start();
    $_SESSION['scriptcase']['grid_operator_ticketsdetail']['glo_nm_path_imag_temp']  = "/scriptcase/tmp";
    //check tmp
    if(empty($_SESSION['scriptcase']['grid_operator_ticketsdetail']['glo_nm_path_imag_temp']))
    {
        $str_path_apl_url = $_SERVER['PHP_SELF'];
        $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
        $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
        $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
        /*check tmp*/$_SESSION['scriptcase']['grid_operator_ticketsdetail']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
    }
    $SC_cod_proj = "sc_tickets";
    $SC_apl_proc = "grid_operator_ticketsdetail";
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
    $nome_apl  = (isset($_GET['nome_apl']))  ? $_GET['nome_apl']  : "";
    $campo_apl = (isset($_GET['campo_apl'])) ? $_GET['campo_apl'] : "nm_resumo_graf";
    $sc_page   = (isset($_GET['sc_page']))   ? $_GET['sc_page']   : "";
    $language  = (isset($_GET['language']))  ? $_GET['language']  : "port";
    $tp_apl    = (isset($_GET['tp_apl']))    ? $_GET['tp_apl']    : "";

    ini_set('default_charset', $_SESSION['scriptcase']['charset']);
    if (!function_exists("NM_is_utf8"))
    {
        include_once("../_lib/lib/php/nm_utf8.php");
    }
    if (!isset($_SESSION['sc_session'][$sc_page][$nome_apl]))
    {
       $sc_page  = $_SESSION['scriptcase']['sc_page_process'];
       $nome_apl = $SC_apl_proc;
    }

    if (isset($_POST['bok_graf']) && $_POST['bok_graf'] == "OK")
    {
       $nome_apl  = $_POST['nome_apl'];
       $campo_apl = $_POST['campo_apl'];
       $sc_page   = $_POST['sc_page'];
       if (!isset($_SESSION['sc_session'][$sc_page][$nome_apl]))
       {
          $sc_page  = $_SESSION['scriptcase']['sc_page_process'];
          $nome_apl = $SC_apl_proc;
       }

       if ($campo_apl == "nm_resumo_graf")
       {
           if (isset($_POST['tipo'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_tipo']        = $_POST['tipo'];
           }
           if (isset($_POST['largura'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_larg']        = $_POST['largura'];
           }
           if (isset($_POST['altura'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_alt']         = $_POST['altura'];
           }
           if (isset($_POST['opc_atual'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['graf_opc_atual']   = $_POST['opc_atual'];
           }
           if (isset($_POST['limit_chart_items'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['limit_chart_items']   = $_POST['limit_chart_items'];
           }
           if (isset($_POST['order'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['graf_order']       = $_POST['order'];
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_order']       = $_POST['order'];
           }
           if (isset($_POST['barra_orien'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_barra_orien'] = $_POST['barra_orien'];
           }
           if (isset($_POST['barra_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_barra_forma'] = $_POST['barra_forma'];
           }
           if (isset($_POST['barra_dimen'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_barra_dimen'] = $_POST['barra_dimen'];
           }
           if (isset($_POST['barra_sobre'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_barra_sobre'] = $_POST['barra_sobre'];
           }
           if (isset($_POST['barra_empil'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_barra_empil'] = $_POST['barra_empil'];
           }
           if (isset($_POST['barra_inver'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_barra_inver'] = $_POST['barra_inver'];
           }
           if (isset($_POST['barra_agrup'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_barra_agrup'] = $_POST['barra_agrup'];
           }
           if (isset($_POST['barra_funil'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_barra_funil'] = $_POST['barra_funil'];
           }
           if (isset($_POST['pizza_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_pizza_forma'] = $_POST['pizza_forma'];
           }
           if (isset($_POST['pizza_dimen'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_pizza_dimen'] = $_POST['pizza_dimen'];
           }
           if (isset($_POST['pizza_orden'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_pizza_orden'] = $_POST['pizza_orden'];
           }
           if (isset($_POST['pizza_explo'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_pizza_explo'] = $_POST['pizza_explo'];
           }
           if (isset($_POST['pizza_valor'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_pizza_valor'] = $_POST['pizza_valor'];
           }
           if (isset($_POST['linha_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_linha_forma'] = $_POST['linha_forma'];
           }
           if (isset($_POST['linha_inver'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_linha_inver'] = $_POST['linha_inver'];
           }
           if (isset($_POST['linha_agrup'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_linha_agrup'] = $_POST['linha_agrup'];
           }
           if (isset($_POST['area_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_area_forma']  = $_POST['area_forma'];
           }
           if (isset($_POST['area_empil'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_area_empil']  = $_POST['area_empil'];
           }
           if (isset($_POST['area_inver'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_area_inver']  = $_POST['area_inver'];
           }
           if (isset($_POST['area_agrup'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_area_agrup']  = $_POST['area_agrup'];
           }
           if (isset($_POST['marca_inver'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_marca_inver'] = $_POST['marca_inver'];
           }
           if (isset($_POST['marca_agrup'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_marca_agrup'] = $_POST['marca_agrup'];
           }
           if (isset($_POST['gauge_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_gauge_forma']  = $_POST['gauge_forma'];
           }
           if (isset($_POST['radar_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_radar_forma']  = $_POST['radar_forma'];
           }
           if (isset($_POST['radar_empil'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_radar_empil']  = $_POST['radar_empil'];
           }
           if (isset($_POST['polar_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_polar_forma']  = $_POST['polar_forma'];
           }
           if (isset($_POST['funil_dimen'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_funil_dimen']  = $_POST['funil_dimen'];
           }
           if (isset($_POST['funil_inver'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_funil_inver']  = $_POST['funil_inver'];
           }
           if (isset($_POST['pyram_dimen'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_pyram_dimen']  = $_POST['pyram_dimen'];
           }
           if (isset($_POST['pyram_valor'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_pyram_valor']  = $_POST['pyram_valor'];
           }
           if (isset($_POST['pyram_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl] ['cfg_graf']['graf_pyram_forma']  = $_POST['pyram_forma'];
           }
       }
       else
       {
           if (isset($_POST['tipo'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_tipo']        = $_POST['tipo'];
           }
           if (isset($_POST['largura'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_larg']        = $_POST['largura'];
           }
           if (isset($_POST['altura'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_alt']         = $_POST['altura'];
           }
           if (isset($_POST['opc_atual'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_opc_atual']   = $_POST['opc_atual'];
           }
           if (isset($_POST['limit_chart_items'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['limit_chart_items']   = $_POST['limit_chart_items'];
           }
           if (isset($_POST['order'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_order']       = $_POST['order'];
           }
           if (isset($_POST['barra_orien'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_orien'] = $_POST['barra_orien'];
           }
           if (isset($_POST['barra_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_forma'] = $_POST['barra_forma'];
           }
           if (isset($_POST['barra_dimen'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_dimen'] = $_POST['barra_dimen'];
           }
           if (isset($_POST['barra_sobre'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_sobre'] = $_POST['barra_sobre'];
           }
           if (isset($_POST['barra_empil'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_empil'] = $_POST['barra_empil'];
           }
           if (isset($_POST['barra_inver'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_inver'] = $_POST['barra_inver'];
           }
           if (isset($_POST['barra_agrup'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_agrup'] = $_POST['barra_agrup'];
           }
           if (isset($_POST['barra_funil'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_funil'] = $_POST['barra_funil'];
           }
           if (isset($_POST['pizza_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pizza_forma'] = $_POST['pizza_forma'];
           }
           if (isset($_POST['pizza_dimen'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pizza_dimen'] = $_POST['pizza_dimen'];
           }
           if (isset($_POST['pizza_orden'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pizza_orden'] = $_POST['pizza_orden'];
           }
           if (isset($_POST['pizza_explo'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pizza_explo'] = $_POST['pizza_explo'];
           }
           if (isset($_POST['pizza_valor'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pizza_valor'] = $_POST['pizza_valor'];
           }
           if (isset($_POST['linha_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_linha_forma'] = $_POST['linha_forma'];
           }
           if (isset($_POST['linha_inver'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_linha_inver'] = $_POST['linha_inver'];
           }
           if (isset($_POST['linha_agrup'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_linha_agrup'] = $_POST['linha_agrup'];
           }
           if (isset($_POST['area_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_area_forma']  = $_POST['area_forma'];
           }
           if (isset($_POST['area_empil'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_area_empil']  = $_POST['area_empil'];
           }
           if (isset($_POST['area_inver'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_area_inver']  = $_POST['area_inver'];
           }
           if (isset($_POST['area_agrup'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_area_agrup']  = $_POST['area_agrup'];
           }
           if (isset($_POST['marca_inver'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_marca_inver'] = $_POST['marca_inver'];
           }
           if (isset($_POST['marca_agrup'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_marca_agrup'] = $_POST['marca_agrup'];
           }
           if (isset($_POST['gauge_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_gauge_forma']  = $_POST['gauge_forma'];
           }
           if (isset($_POST['radar_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_radar_forma']  = $_POST['radar_forma'];
           }
           if (isset($_POST['radar_empil'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_radar_empil']  = $_POST['radar_empil'];
           }
           if (isset($_POST['polar_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_polar_forma']  = $_POST['polar_forma'];
           }
           if (isset($_POST['funil_dimen'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_funil_dimen']  = $_POST['funil_dimen'];
           }
           if (isset($_POST['funil_inver'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_funil_inver']  = $_POST['funil_inver'];
           }
           if (isset($_POST['pyram_dimen'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pyram_dimen']  = $_POST['pyram_dimen'];
           }
           if (isset($_POST['pyram_valor'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pyram_valor']  = $_POST['pyram_valor'];
           }
           if (isset($_POST['pyram_forma'])) {
               $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pyram_forma']  = $_POST['pyram_forma'];
           }
       }

       if (isset($_POST['ajax']) && $_POST['ajax'] == "OK")
       {
           exit;
       }

    }

    if (isset($_POST['bok_graf']) && $_POST['bok_graf'] == "OK")
    {
?>
       <html>
       <body>
       <script language="javascript">
          var tp_apl = "<?php echo $tp_apl ?>";
          if (tp_apl == "ger_gra") {
              self.parent.document.refresh_config.submit();
          }
          if (typeof self.parent.scChart_update_inline == "function") {
              self.parent.scChart_update_inline();
          }
          self.parent.tb_remove();
       </script>
       </body>
       </html>
<?php
       exit;
    }
    elseif ($campo_apl == "nm_resumo_graf")
    {
        $disp        = $_SESSION['sc_session'][$sc_page][$nome_apl] ['graf_disp'];
        $tipo        = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_tipo'];
        $mod_allowed = $_SESSION['sc_session'][$sc_page][$nome_apl] ['graf_mod_allowed'];
        $largura     = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_larg'];
        $altura      = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_alt'];
        $opc_atual   = $_SESSION['sc_session'][$sc_page][$nome_apl] ['graf_opc_atual'];
        $order       = $_SESSION['sc_session'][$sc_page][$nome_apl] ['graf_order'];

        $limit_chart_items = isset($_SESSION['sc_session'][$sc_page][$nome_apl] ['limit_chart_items']) ? $_SESSION['sc_session'][$sc_page][$nome_apl] ['limit_chart_items'] : '';

        $barra_orien = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_barra_orien'];
        $barra_forma = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_barra_forma'];
        $barra_dimen = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_barra_dimen'];
        $barra_sobre = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_barra_sobre'];
        $barra_empil = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_barra_empil'];
        $barra_inver = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_barra_inver'];
        $barra_agrup = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_barra_agrup'];
        $barra_funil = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_barra_funil'];

        $pizza_forma = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_pizza_forma'];
        $pizza_dimen = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_pizza_dimen'];
        $pizza_orden = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_pizza_orden'];
        $pizza_explo = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_pizza_explo'];
        $pizza_valor = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_pizza_valor'];

        $linha_forma = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_linha_forma'];
        $linha_inver = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_linha_inver'];
        $linha_agrup = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_linha_agrup'];

        $area_forma  = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_area_forma'];
        $area_empil  = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_area_empil'];
        $area_inver  = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_area_inver'];
        $area_agrup  = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_area_agrup'];

        $marca_inver = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_marca_inver'];
        $marca_agrup = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_marca_agrup'];

        $gauge_forma = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_gauge_forma'];

        $radar_forma = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_radar_forma'];
        $radar_empil = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_radar_empil'];

        $polar_forma = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_polar_forma'];

        $funil_dimen = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_funil_dimen'];
        $funil_inver = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_funil_inver'];

        $pyram_dimen = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_pyram_dimen'];
        $pyram_valor = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_pyram_valor'];
        $pyram_forma = $_SESSION['sc_session'][$sc_page][$nome_apl]['cfg_graf'] ['graf_pyram_forma'];
    }
    else
    {
        $disp        = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_disp'];
        $tipo        = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_tipo'];
        $mod_allowed = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_mod_allowed'];
        $largura     = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_larg'];
        $altura      = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_alt'];
        $opc_atual   = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_opc_atual'];
        $order       = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_order'];

        $limit_chart_items = isset($_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['limit_chart_items']) ? $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['limit_chart_items'] : '';

        $barra_orien = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_orien'];
        $barra_forma = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_forma'];
        $barra_dimen = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_dimen'];
        $barra_sobre = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_sobre'];
        $barra_empil = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_empil'];
        $barra_inver = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_inver'];
        $barra_agrup = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_agrup'];
        $barra_funil = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_barra_funil'];

        $pizza_forma = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pizza_forma'];
        $pizza_dimen = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pizza_dimen'];
        $pizza_orden = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pizza_orden'];
        $pizza_explo = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pizza_explo'];
        $pizza_valor = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pizza_valor'];

        $linha_forma = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_linha_forma'];
        $linha_inver = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_linha_inver'];
        $linha_agrup = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_linha_agrup'];

        $area_forma  = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_area_forma'];
        $area_empil  = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_area_empil'];
        $area_inver  = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_area_inver'];
        $area_agrup  = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_area_agrup'];

        $marca_inver = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_marca_inver'];
        $marca_agrup = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_marca_agrup'];

        $gauge_forma = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_gauge_forma'];

        $radar_forma = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_radar_forma'];
        $radar_empil = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_radar_empil'];

        $polar_forma = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_polar_forma'];

        $funil_dimen = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_funil_dimen'];
        $funil_inver = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_funil_inver'];

        $pyram_dimen = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pyram_dimen'];
        $pyram_valor = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pyram_valor'];
        $pyram_forma = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl] ['graf_pyram_forma'];
    }

    if (empty($largura))
    {
        $largura = 512;
    }
    if (empty($altura))
    {
        $altura = 384;
    }

    $tradutor = array();
    if (isset($_SESSION['scriptcase']['sc_idioma_graf_flash']))
    {
        $tradutor = $_SESSION['scriptcase']['sc_idioma_graf_flash'];
    }
    if (!isset($tradutor[$language]))
    {
        foreach ($tradutor as $language => $resto)
        {
            break;
        }
    }

    //if (!in_array($tipo, array('Bar', 'Pie', 'Line', 'Area', 'Mark', 'Gauge', 'Radar', 'Polar', 'Funnel')))
    if (!in_array($tipo, array('Bar', 'Pie', 'Line', 'Area', 'Gauge', 'Radar', 'Funnel', 'Pyramid')))
    {
        $tipo = 'Bar';
    }

    $sStyleBarra    = 'display: none;';
    $sStylePizza    = 'display: none;';
    $sStyleLinha    = 'display: none;';
    $sStyleArea     = 'display: none;';
    $sStyleMarcador = 'display: none;';
    $sStyleGauge    = 'display: none;';
    $sStyleRadar    = 'display: none;';
    $sStylePolar    = 'display: none;';
    $sStyleFunnel   = 'display: none;';
    $sStylePyram    = 'display: none;';
    switch ($tipo)
    {
        case 'Bar':
            $sStyleBarra = '';
            break;
        case 'Pie':
            $sStylePizza = '';
            break;
        case 'Line':
            $sStyleLinha = '';
            break;
        case 'Area':
            $sStyleArea = '';
            break;
        case 'Mark':
            $sStyleMarcador = '';
            break;
        case 'Gauge':
            $sStyleGauge = '';
            break;
        case 'Radar':
            $sStyleRadar = '';
            break;
        case 'Polar':
            $sStylePolar = '';
            break;
        case 'Funnel':
            $sStyleFunnel = '';
            break;
        case 'Pyramid':
            $sStylePyram = '';
            break;
    }

?>
<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<head>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html']; ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
 <link rel="stylesheet" type="text/css" href="../_lib/lib/css/nm_export_mobile.css" />
<?php
}
?>
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup'] ?>" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_dir'] ?>" />
 <?php
  if(isset($_SESSION['scriptcase']['str_google_fonts']) && !empty($_SESSION['scriptcase']['str_google_fonts']))
  {
    ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['scriptcase']['str_google_fonts']; ?>" />
    <?php
  }
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['sc_session']['path_third'] ?>/font-awesome/css/all.min.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $_SESSION['scriptcase']['css_btn_popup'] ?>" />
 <style>
     .scLabel{
         display: block;
         padding: 8px 0px;
         white-space: nowrap;
     }
     .scGridFieldOddFont {
         padding: 8px !important;
     }
     .scInputs
     {
         padding-bottom: 20px !important;
     }
     .scInputsRow
     {
         display: flex;
         flex-direction: row;
         flex-wrap: nowrap;
         width: 100%;
     }
     .scInputsCol
     {
         display: flex;
         flex-direction: column;
         flex-basis: 100%;
         flex: 1;
         padding: 2px 8px;
     }
 </style>
 </head>
<body class="scGridPage" style="margin: 0px;">

<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.js"></script>

<form name="config_graf" method="post">
<?php
$pos = "left";
if ($_SESSION['scriptcase']['reg_conf']['html_dir'] == " DIR='RTL'")
{
    $pos = "right";
}
$colspan   = ($_SESSION['scriptcase']['proc_mobile']) ? 1 : 2;
$align_btn = ($_SESSION['scriptcase']['proc_mobile']) ? "left" : "center";
?>
<table id="main_table" class="exportConfig" align="center" style="padding: 10px;">
<tr>
 <td>
  <div class="scGridBorder">
  <table class="scGridTabela" width='100%' cellspacing=0 cellpadding=0>
   <tr>
    <td class="scGridLabelVert"><?php echo $tradutor[$language]['titulo']; ?></td>
   </tr>

 <tr><td class="scGridFieldOdd">
     <div class="scInputs scGridFieldOddFont">
         <div class='scInputsRow'>
             <div class="scInputsCol">
                 <div class='scLabel'><?php echo $tradutor[$language]['tipo_g']; ?></div>
                 <div class='scInput'>
                     <select name="tipo" onChange="omite_lin()" class="css_toolbar_obj">
                         <?php
                         foreach ($disp as $graf_disp) {
                             if (in_array($graf_disp, array('Mark', 'Polar')))
                             {
                                 continue;
                             }
                             switch ($graf_disp) {
                                 case 'Bar':
                                     $trad_graf = 'tp_barra';
                                     break;
                                 case 'Pie':
                                     $trad_graf = 'tp_pizza';
                                     break;
                                 case 'Line':
                                     $trad_graf = 'tp_linha';
                                     break;
                                 case 'Area':
                                     $trad_graf = 'tp_area';
                                     break;
                                 case 'Mark':
                                     $trad_graf = 'tp_marcador';
                                     break;
                                 case 'Gauge':
                                     $trad_graf = 'tp_gauge';
                                     break;
                                 case 'Radar':
                                     $trad_graf = 'tp_radar';
                                     break;
                                 case 'Polar':
                                     $trad_graf = 'tp_polar';
                                     break;
                                 case 'Funnel':
                                     $trad_graf = 'tp_funil';
                                     break;
                                 case 'Pyramid':
                                     $trad_graf = 'tp_pyramid';
                                     break;
                             }
                             ?>
                             <option value="<?php echo $graf_disp; ?>"<?php if ($graf_disp  == $tipo) { echo ' selected'; } ?>><?php echo $tradutor[$language][$trad_graf]; ?></option>
                             <?php
                         }
                         ?>
                     </select></div>
             </div>
             <div class="scInputsCol">
                 <div class='scLabel'><?php echo $tradutor[$language]['modo_gera']; ?></div>
                 <div class='scInput'><?php
                     if (isset($mod_allowed) && 1 == sizeof($mod_allowed))
                     {
                         ?>
                         <?php echo 2 == $mod_allowed[0] ? $tradutor[$language]['analitico'] : $tradutor[$language]['sintetico']; ?>
                         <input type="hidden" name="opc_atual" value="<?php echo $mod_allowed[0]; ?>" />
                         <?php
                     }
                     else
                     {
                         ?>
                         <select  name="opc_atual"  size=1 class="css_toolbar_obj">
                             <option value="1" <?php if ($opc_atual == "1")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['sintetico']; ?></option>
                             <option value="2" <?php if ($opc_atual == "2")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['analitico']; ?></option>
                         </select>
                         <?php
                     }
                     ?></div>
             </div>
         </div>
         <div class='scInputsRow'>
             <div class="scInputsCol">
                 <div class='scLabel'><?php echo $tradutor[$language]['largura']; ?></div>
                 <div class='scInput'><input type="text" size="10" name="largura" value="<?php echo NM_encode_input($largura); ?>" class="css_toolbar_obj" /></div>
             </div>
             <div class="scInputsCol">
                 <div class='scLabel'><?php echo $tradutor[$language]['altura']; ?></div>
                 <div class='scInput'><input type="text" size="10" name="altura" value="<?php echo NM_encode_input($altura); ?>" class="css_toolbar_obj" /></div>
             </div>
         </div>
         <div class='scInputsRow'>
             <div class="scInputsCol">
                 <div class='scLabel'><?php echo $tradutor[$language]['order']; ?></div>
                 <div class='scInput'><select  name="order"  size=1 class="css_toolbar_obj">
                         <option value="" <?php     if ($order == "")      { echo " selected" ;} ?>><?php echo $tradutor[$language]['order_none']; ?></option>
                         <option value="asc" <?php  if ($order == "asc")   { echo " selected" ;} ?>><?php echo $tradutor[$language]['order_asc'];  ?></option>
                         <option value="desc" <?php if ($order == "desc")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['order_desc']; ?></option>
                     </select>
                 </div>
             </div>
<?php
if (isset($_SESSION['sc_session'] [$sc_page] [$nome_apl] ['has_limit_chart_items']) && $_SESSION['sc_session'] [$sc_page] [$nome_apl] ['has_limit_chart_items']) {
    if ('0' == $limit_chart_items) {
        $limit_chart_items = '';
    }
?>
             <div class="scInputsCol">
                 <div class='scLabel'><?php echo $tradutor[$language]['limit_chart_items']; ?></div>
                 <div class='scInput'><input type="text" size="10" name="limit_chart_items" value="<?php echo NM_encode_input($limit_chart_items); ?>" class="css_toolbar_obj" /></div>
             </div>
<?php
}
?>
         </div>
     </div>
 </td>
 </tr>
 <tr>
  <td class="scGridLabelVert">
    <span id="group_title_Bar" style="<?php    echo $sStyleBarra;    ?>"><?php echo $tradutor[$language]['tp_barra'];    ?></span>
    <span id="group_title_Pie" style="<?php    echo $sStylePizza;    ?>"><?php echo $tradutor[$language]['tp_pizza'];    ?></span>
    <span id="group_title_Line" style="<?php   echo $sStyleLinha;    ?>"><?php echo $tradutor[$language]['tp_linha'];    ?></span>
    <span id="group_title_Area" style="<?php   echo $sStyleArea;     ?>"><?php echo $tradutor[$language]['tp_area'];     ?></span>
    <span id="group_title_Mark" style="<?php   echo $sStyleMarcador; ?>"><?php echo $tradutor[$language]['tp_marcador']; ?></span>
    <span id="group_title_Gauge" style="<?php  echo $sStyleGauge;    ?>"><?php echo $tradutor[$language]['tp_gauge'];    ?></span>
    <span id="group_title_Radar" style="<?php  echo $sStyleRadar;    ?>"><?php echo $tradutor[$language]['tp_radar'];    ?></span>
    <span id="group_title_Polar" style="<?php  echo $sStylePolar;    ?>"><?php echo $tradutor[$language]['tp_polar'];    ?></span>
    <span id="group_title_Funnel" style="<?php echo $sStyleFunnel;   ?>"><?php echo $tradutor[$language]['tp_funil'];    ?></span>
    <span id="group_title_Pyram" style="<?php  echo $sStylePyram;    ?>"><?php echo $tradutor[$language]['tp_pyramid'];  ?></span>
  </td>
 </tr>
 <tr>
     <td class="scGridFieldOdd">
         <div id="group_data_Bar" style="display: none;">
             <div class="scInputs scGridFieldOddFont">
                 <div class='scInputsRow'>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['barra_orien']; ?></div>
                         <div class='scInput'>
                             <select name="barra_orien" class="css_toolbar_obj">
                                 <option value="Horizontal"<?php if ('Horizontal' == $barra_orien) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_orien_horiz']; ?></option>
                                 <option value="Vertical"<?php   if ('Vertical'   == $barra_orien) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_orien_verti']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['barra_dimen']; ?></div>
                         <div class='scInput'>
                             <select name="barra_dimen" class="css_toolbar_obj">
                                 <option value="2d"<?php if ('2d' == $barra_dimen) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_dimen_2d']; ?></option>
                                 <option value="3d"<?php if ('3d' == $barra_dimen) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_dimen_3d']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['barra_empil']; ?></div>
                         <div class='scInput'>
                             <select name="barra_empil" class="css_toolbar_obj">
                                 <option value="Off"<?php     if ('Off'     == $barra_empil) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_empil_desat']; ?></option>
                                 <option value="On"<?php      if ('On'      == $barra_empil) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_empil_ativa']; ?></option>
                                 <option value="Percent"<?php if ('Percent' == $barra_empil) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_empil_perce']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol" style="display: <?php echo (!$_SESSION['scriptcase']['proc_mobile'])?"none":"";?>">
                         <div class='scLabel'><?php echo $tradutor[$language]['barra_sobre']; ?></div>
                         <div class='scInput'>
                             <select name="barra_sobre" class="css_toolbar_obj">
                                 <option value="No"<?php  if ('No'  == $barra_sobre) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_sobre_nao']; ?></option>
                                 <option value="Yes"<?php if ('Yes' == $barra_sobre) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_sobre_sim']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol" style="display: <?php echo (!$_SESSION['scriptcase']['proc_mobile'])?"none":"";?>">
                         <div class='scLabel'><?php echo $tradutor[$language]['barra_inver']; ?></div>
                         <div class='scInput'>
                             <select name="barra_inver" class="css_toolbar_obj">
                                 <option value="Normal"<?php   if ('Normal'   == $barra_inver) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_sobre_nao']; ?></option>
                                 <option value="Reversed"<?php if ('Reversed' == $barra_inver) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_sobre_sim']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['barra_agrup']; ?></div>
                         <div class='scInput'>
                             <select name="barra_agrup" class="css_toolbar_obj">
                                 <option value="Normal"<?php if ('Normal' == $barra_agrup) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_agrup_conju']; ?></option>
                                 <option value="Series"<?php if ('Series' == $barra_agrup) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_agrup_serie']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol" style="display: <?php echo (!$_SESSION['scriptcase']['proc_mobile'])?"none":"";?>">
                         <div class='scLabel'><?php echo $tradutor[$language]['barra_forma']; ?></div>
                         <div class='scInput'>
                             <select name="barra_forma" class="css_toolbar_obj">
                                 <option value="Bar"<?php      if ('Bar'      == $barra_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_forma_barra']; ?></option>
                                 <option value="Cylinder"<?php if ('Cylinder' == $barra_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_forma_cilin']; ?></option>
                                 <option value="Cone"<?php     if ('Cone'     == $barra_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_forma_cone']; ?></option>
                                 <option value="Pyramid"<?php  if ('Pyramid'  == $barra_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_forma_piram']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol" style="display: <?php echo (!$_SESSION['scriptcase']['proc_mobile'])?"none":"";?>">
                         <div class='scLabel'><?php echo $tradutor[$language]['barra_funil']; ?></div>
                         <div class='scInput'>
                             <select name="barra_funil" class="css_toolbar_obj">
                                 <option value="N"<?php if ('N' == $barra_funil) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_sobre_nao']; ?></option>
                                 <option value="Y"<?php if ('Y' == $barra_funil) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_sobre_sim']; ?></option>
                             </select>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div id="group_data_Pie" style="display: none;">
             <div class="scInputs scGridFieldOddFont">
                 <div class='scInputsRow'>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['pizza_forma']; ?></div>
                         <div class='scInput'>
                             <select name="pizza_forma" class="css_toolbar_obj">
                                 <option value="Pie"<?php   if ('Pie'   == $pizza_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pizza_forma_pizza']; ?></option>
                                 <option value="Donut"<?php if ('Donut' == $pizza_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pizza_forma_donut']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['pizza_dimen']; ?></div>
                         <div class='scInput'>
                             <select name="pizza_dimen" class="css_toolbar_obj">
                                 <option value="2d"<?php if ('2d' == $pizza_dimen) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pizza_dimen_2d']; ?></option>
                                 <option value="3d"<?php if ('3d' == $pizza_dimen) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pizza_dimen_3d']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['pizza_orden']; ?></div>
                         <div class='scInput'>
                             <select name="pizza_orden" class="css_toolbar_obj">
                                 <option value="Off"<?php  if ('Off'  == $pizza_orden) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pizza_orden_desat']; ?></option>
                                 <option value="Asc"<?php  if ('Asc'  == $pizza_orden) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pizza_orden_ascen']; ?></option>
                                 <option value="Desc"<?php if ('Desc' == $pizza_orden) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pizza_orden_desce']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['pizza_valor']; ?></div>
                         <div class='scInput'>
                             <select name="pizza_valor" class="css_toolbar_obj">
                                 <option value="Valor"<?php   if ('Valor'   == $pizza_valor) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pizza_valor_valor']; ?></option>
                                 <option value="Percent"<?php if ('Percent' == $pizza_valor) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pizza_valor_perce']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['pizza_explo']; ?></div>
                         <div class='scInput'>
                             <select name="pizza_explo" class="css_toolbar_obj">
                                 <option value="Off"<?php   if ('Off'   == $pizza_explo) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pizza_explo_desat']; ?></option>
                                 <option value="On"<?php    if ('On'    == $pizza_explo) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pizza_explo_ativa']; ?></option>
                                 <option value="Click"<?php if ('Click' == $pizza_explo) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pizza_explo_click']; ?></option>
                             </select>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div id="group_data_Line" style="display: none;">
             <div class="scInputs scGridFieldOddFont">
                 <div class='scInputsRow'>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['linha_forma']; ?></div>
                         <div class='scInput'>
                             <select name="linha_forma" class="css_toolbar_obj">
                                 <option value="Line"<?php   if ('Line'   == $linha_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['linha_forma_linha']; ?></option>
                                 <option value="Spline"<?php if ('Spline' == $linha_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['linha_forma_splin']; ?></option>
                                 <option value="Step"<?php   if ('Step'   == $linha_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['linha_forma_degra']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['linha_agrup']; ?></div>
                         <div class='scInput'>
                             <select name="linha_agrup" class="css_toolbar_obj">
                                 <option value="Normal"<?php if ('Normal' == $linha_agrup) { echo ' selected'; } ?>><?php echo $tradutor[$language]['linha_agrup_conju']; ?></option>
                                 <option value="Series"<?php if ('Series' == $linha_agrup) { echo ' selected'; } ?>><?php echo $tradutor[$language]['linha_agrup_serie']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['linha_inver']; ?></div>
                         <div class='scInput'>
                             <select name="linha_inver" class="css_toolbar_obj">
                                 <option value="Normal"<?php   if ('Normal'   == $linha_inver) { echo ' selected'; } ?>><?php echo $tradutor[$language]['linha_inver_norma']; ?></option>
                                 <option value="Reversed"<?php if ('Reversed' == $linha_inver) { echo ' selected'; } ?>><?php echo $tradutor[$language]['linha_inver_inver']; ?></option>
                             </select>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div id="group_data_Area" style="display: none;">
             <div class="scInputs scGridFieldOddFont">
                 <div class='scInputsRow'>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['area_forma']; ?></div>
                         <div class='scInput'>
                             <select name="area_forma" class="css_toolbar_obj">
                                 <option value="Area"<?php   if ('Area'   == $area_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['area_forma_area']; ?></option>
                                 <option value="Spline"<?php if ('Spline' == $area_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['area_forma_splin']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['area_empil']; ?></div>
                         <div class='scInput'>
                             <select name="area_empil" class="css_toolbar_obj">
                                 <option value="Off"<?php     if ('Off'     == $area_empil) { echo ' selected'; } ?>><?php echo $tradutor[$language]['area_empil_desat']; ?></option>
                                 <option value="On"<?php      if ('On'      == $area_empil) { echo ' selected'; } ?>><?php echo $tradutor[$language]['area_empil_ativa']; ?></option>
                                 <option value="Percent"<?php if ('Percent' == $area_empil) { echo ' selected'; } ?>><?php echo $tradutor[$language]['area_empil_perce']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['area_agrup']; ?></div>
                         <div class='scInput'>
                             <select name="area_agrup" class="css_toolbar_obj">
                                 <option value="Normal"<?php if ('Normal' == $area_agrup) { echo ' selected'; } ?>><?php echo $tradutor[$language]['area_agrup_conju']; ?></option>
                                 <option value="Series"<?php if ('Series' == $area_agrup) { echo ' selected'; } ?>><?php echo $tradutor[$language]['area_agrup_serie']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['area_inver']; ?></div>
                         <div class='scInput'>
                             <select name="area_inver" class="css_toolbar_obj">
                                 <option value="Normal"<?php   if ('Normal'   == $area_inver) { echo ' selected'; } ?>><?php echo $tradutor[$language]['area_inver_norma']; ?></option>
                                 <option value="Reversed"<?php if ('Reversed' == $area_inver) { echo ' selected'; } ?>><?php echo $tradutor[$language]['area_inver_inver']; ?></option>
                             </select>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div id="group_data_Mark" style="display: none;">
             <div class="scInputs scGridFieldOddFont">
                 <div class='scInputsRow'>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['marca_inver']; ?></div>
                         <div class='scInput'>
                             <select name="marca_inver" class="css_toolbar_obj">
                                 <option value="Normal"<?php   if ('Normal'   == $marca_inver) { echo ' selected'; } ?>><?php echo $tradutor[$language]['marca_inver_norma']; ?></option>
                                 <option value="Reversed"<?php if ('Reversed' == $marca_inver) { echo ' selected'; } ?>><?php echo $tradutor[$language]['marca_inver_inver']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['marca_agrup']; ?></div>
                         <div class='scInput'>
                             <select name="marca_agrup" class="css_toolbar_obj">
                                 <option value="Normal"<?php if ('Normal' == $marca_agrup) { echo ' selected'; } ?>><?php echo $tradutor[$language]['marca_agrup_conju']; ?></option>
                                 <option value="Series"<?php if ('Series' == $marca_agrup) { echo ' selected'; } ?>><?php echo $tradutor[$language]['marca_agrup_serie']; ?></option>
                             </select>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div id="group_data_Gauge" style="display: none;">
             <div class="scInputs scGridFieldOddFont">
                 <div class='scInputsRow'>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['gauge_forma']; ?></div>
                         <div class='scInput'>
                             <select name="gauge_forma" class="css_toolbar_obj">
                                 <option value="Circular"<?php if ('Circular' == $gauge_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['gauge_forma_circular']; ?></option>
                                 <option value="Semi"<?php     if ('Semi'     == $gauge_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['gauge_forma_semi'];     ?></option>
                             </select>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div id="group_data_Radar" style="display: none;">
             <div class="scInputs scGridFieldOddFont">
                 <div class='scInputsRow'>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['gauge_forma']; ?></div>
                         <div class='scInput'>
                             <select name="radar_forma" class="css_toolbar_obj">
                                 <option value="Line"<?php if ('Line' == $radar_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['linha_forma_linha']; ?></option>
                                 <option value="Area"<?php if ('Area' == $radar_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['area_forma_area'];   ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['area_empil']; ?></div>
                         <div class='scInput'>
                             <select name="radar_empil" class="css_toolbar_obj">
                                 <option value="Off"<?php     if ('Off'     == $radar_empil) { echo ' selected'; } ?>><?php echo $tradutor[$language]['area_empil_desat']; ?></option>
                                 <option value="On"<?php      if ('On'      == $radar_empil) { echo ' selected'; } ?>><?php echo $tradutor[$language]['area_empil_ativa']; ?></option>
                                 <option value="Percent"<?php if ('Percent' == $radar_empil) { echo ' selected'; } ?>><?php echo $tradutor[$language]['area_empil_perce']; ?></option>
                             </select>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div id="group_data_Polar" style="display: none;">
             <div class="scInputs scGridFieldOddFont">
                 <div class='scInputsRow'>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['gauge_forma']; ?></div>
                         <div class='scInput'>
                             <select name="polar_forma" class="css_toolbar_obj">
                                 <option value="Line"<?php if ('Line' == $polar_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['linha_forma_linha']; ?></option>
                                 <option value="Area"<?php if ('Area' == $polar_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['area_forma_area'];   ?></option>
                             </select>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div id="group_data_Funnel" style="display: none;">
             <div class="scInputs scGridFieldOddFont">
                 <div class='scInputsRow'>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['barra_dimen']; ?></div>
                         <div class='scInput'>
                             <select name="funil_dimen" class="css_toolbar_obj">
                                 <option value="2d"<?php if ('2d' == $funil_dimen) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_dimen_2d']; ?></option>
                                 <option value="3d"<?php if ('3d' == $funil_dimen) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_dimen_3d']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['barra_inver']; ?></div>
                         <div class='scInput'>
                             <select name="funil_inver" class="css_toolbar_obj">
                                 <option value="Normal"<?php   if ('Normal'   == $funil_inver) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_sobre_nao']; ?></option>
                                 <option value="Reversed"<?php if ('Reversed' == $funil_inver) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_sobre_sim']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['barra_dimen']; ?></div>
                         <div class='scInput'>
                             <select name="pyram_dimen" class="css_toolbar_obj">
                                 <option value="2d"<?php if ('2d' == $pyram_dimen) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_dimen_2d']; ?></option>
                                 <option value="3d"<?php if ('3d' == $pyram_dimen) { echo ' selected'; } ?>><?php echo $tradutor[$language]['barra_dimen_3d']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['pizza_valor']; ?></div>
                         <div class='scInput'>
                             <select name="pyram_valor" class="css_toolbar_obj">
                                 <option value="Valor"<?php   if ('Valor'   == $pyram_valor) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pizza_valor_valor']; ?></option>
                                 <option value="Percent"<?php if ('Percent' == $pyram_valor) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pizza_valor_perce']; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="scInputsCol">
                         <div class='scLabel'><?php echo $tradutor[$language]['pyram_slice']; ?></div>
                         <div class='scInput'>
                             <select name="pyram_forma" class="css_toolbar_obj">
                                 <option value="S"<?php if ('S' == $pyram_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pyram_slice_s']; ?></option>
                                 <option value="N"<?php if ('N' == $pyram_forma) { echo ' selected'; } ?>><?php echo $tradutor[$language]['pyram_slice_n']; ?></option>
                             </select>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

 </td></tr>
 <tr>
  <td class="scGridToolbar" style="text-align: <?php echo $align_btn ?>">
   <?php echo $_SESSION['scriptcase']['bg_btn_popup']['bok']; ?>
   &nbsp; &nbsp; &nbsp;
   <?php echo $_SESSION['scriptcase']['bg_btn_popup']['btbremove']; ?>
  </td>
 </tr>
</table>
 </div>
 </td>
 </tr>
</table>

  <input type="hidden" name="nome_apl"  value="<?php echo NM_encode_input($nome_apl); ?>">
  <input type="hidden" name="campo_apl" value="<?php echo NM_encode_input($campo_apl); ?>" >
  <input type="hidden" name="sc_page"   value="<?php echo NM_encode_input($sc_page); ?>" >
  <input type="hidden" name="bok_graf"  value="" >
</form>
<script language="javascript">
var chart_type = '<?php echo $tipo; ?>';
function omite_lin() {
 var ind = document.config_graf.tipo.selectedIndex,
     val = document.config_graf.tipo.options[ind].value;
 if (val != chart_type) {
  $('#group_title_' + chart_type).hide();
  $('#group_data_' + chart_type).hide();
  chart_type = val;
  $('#group_title_' + chart_type).show();
  $('#group_data_' + chart_type).show();
 }
 var W = $('#main_table').outerWidth(),
     H = $('#main_table').outerHeight();
 console.log(W);
 console.log(H);
 if (0 == W || 0 == H) {
  setTimeout("omite_lin()", 50);
 }
 else {
  self.parent.tb_resize(H + 20, W + 20);
 }
}
function processa() {
 document.config_graf.bok_graf.value = "OK";
 document.config_graf.submit();

 $('#bsair').click();
}
</script>
<script>
    $( document ).ready(function() {
        $('#group_data_<?php echo $tipo; ?>').show();
        omite_lin();
    });
</script>
</body>
</html>