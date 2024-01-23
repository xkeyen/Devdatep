<?php

class grid_room_now_rtf
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Texto_tag;
   var $Arquivo;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("en_us");
      $this->Texto_tag = "";
   }


function actionBar_isValidState($buttonName, $buttonState)
{
    return false;
}

   //---- 
   function monta_rtf()
   {
      $this->inicializa_vars();
      $this->gera_texto_tag();
      $this->grava_arquivo_rtf();
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Rtf_f);
          $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
          $Temp = ob_get_clean();
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
      else
      {
          $this->progress_bar_end();
      }
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      if (isset($GLOBALS['nmgp_parms']) && !empty($GLOBALS['nmgp_parms'])) 
      { 
          $GLOBALS['nmgp_parms'] = str_replace("@aspass@", "'", $GLOBALS['nmgp_parms']);
          $todox = str_replace("?#?@?@?", "?#?@ ?@?", $GLOBALS["nmgp_parms"]);
          $todo  = explode("?@?", $todox);
          foreach ($todo as $param)
          {
               $cadapar = explode("?#?", $param);
               if (1 < sizeof($cadapar))
               {
                   if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                   {
                       $cadapar[0] = substr($cadapar[0], 11);
                       $cadapar[1] = $_SESSION[$cadapar[1]];
                   }
                   if (isset($GLOBALS['sc_conv_var'][$cadapar[0]]))
                   {
                       $cadapar[0] = $GLOBALS['sc_conv_var'][$cadapar[0]];
                   }
                   elseif (isset($GLOBALS['sc_conv_var'][strtolower($cadapar[0])]))
                   {
                       $cadapar[0] = $GLOBALS['sc_conv_var'][strtolower($cadapar[0])];
                   }
                   nm_limpa_str_grid_room_now($cadapar[1]);
                   nm_protect_num_grid_room_now($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_room_now']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_room_now_total.class.php"); 
      $this->Tot      = new grid_room_now_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_room_now']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_room_now";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_room_now.rtf";
   }
   //---- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }


   //----- 
   function gera_texto_tag()
   {
     global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      $this->New_label['tb_restaurant_tables_id_table'] = "" . $this->Ini->Nm_lang['lang_tb_restaurant_tables_fld_id_table'] . "";
      $this->New_label['tb_restaurant_tables_seats'] = "" . $this->Ini->Nm_lang['lang_tb_restaurant_tables_fld_seats'] . "";
      $this->New_label['tb_restaurant_room_id_room'] = "" . $this->Ini->Nm_lang['lang_tb_restaurant_tables_fld_id_room'] . "";
      $this->New_label['tb_restaurant_room_room_descr'] = "" . $this->Ini->Nm_lang['lang_tb_restaurant_room_fld_room_descr'] . "";
      $this->New_label['tb_restaurant_room_room_active'] = "" . $this->Ini->Nm_lang['lang_tb_restaurant_room_fld_room_active'] . "";
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->tb_restaurant_tables_id_table = (isset($Busca_temp['tb_restaurant_tables_id_table'])) ? $Busca_temp['tb_restaurant_tables_id_table'] : ""; 
          $tmp_pos = (is_string($this->tb_restaurant_tables_id_table)) ? strpos($this->tb_restaurant_tables_id_table, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tb_restaurant_tables_id_table))
          {
              $this->tb_restaurant_tables_id_table = substr($this->tb_restaurant_tables_id_table, 0, $tmp_pos);
          }
          $this->tb_restaurant_tables_seats = (isset($Busca_temp['tb_restaurant_tables_seats'])) ? $Busca_temp['tb_restaurant_tables_seats'] : ""; 
          $tmp_pos = (is_string($this->tb_restaurant_tables_seats)) ? strpos($this->tb_restaurant_tables_seats, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tb_restaurant_tables_seats))
          {
              $this->tb_restaurant_tables_seats = substr($this->tb_restaurant_tables_seats, 0, $tmp_pos);
          }
          $this->tb_restaurant_room_id_room = (isset($Busca_temp['tb_restaurant_room_id_room'])) ? $Busca_temp['tb_restaurant_room_id_room'] : ""; 
          $tmp_pos = (is_string($this->tb_restaurant_room_id_room)) ? strpos($this->tb_restaurant_room_id_room, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tb_restaurant_room_id_room))
          {
              $this->tb_restaurant_room_id_room = substr($this->tb_restaurant_room_id_room, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_room_now']['contr_erro'] = 'on';
 ?>
<script>
$(function() {
	$(".card").click(function(){
		var idString = this.id;
		var resultId = idString.split("-", 3); 
		var tableId = resultId[1];
		var orderId = resultId[2];
		console.log(tableId);
tb_show('', '../form_tb_orders/form_tb_orders.php?var_id_order='+orderId+'&var_id_table='+tableId+'&sc_cal_click_date=&nmgp_outra_jan=true&nmgp_url_saida=modal&TB_iframe=false&modal=false&height=550&width=800', '');
	});
});
</script>
<?php
$_SESSION['scriptcase']['grid_room_now']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['tb_restaurant_tables_id_table'])) ? $this->New_label['tb_restaurant_tables_id_table'] : ""; 
          if ($Cada_col == "tb_restaurant_tables_id_table" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tb_restaurant_tables_seats'])) ? $this->New_label['tb_restaurant_tables_seats'] : ""; 
          if ($Cada_col == "tb_restaurant_tables_seats" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tb_restaurant_room_id_room'])) ? $this->New_label['tb_restaurant_room_id_room'] : ""; 
          if ($Cada_col == "tb_restaurant_room_id_room" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tb_restaurant_room_room_descr'])) ? $this->New_label['tb_restaurant_room_room_descr'] : ""; 
          if ($Cada_col == "tb_restaurant_room_room_descr" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tb_restaurant_room_room_active'])) ? $this->New_label['tb_restaurant_room_room_active'] : ""; 
          if ($Cada_col == "tb_restaurant_room_room_active" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['css_color'])) ? $this->New_label['css_color'] : "css_color"; 
          if ($Cada_col == "css_color" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['dt_order_start'])) ? $this->New_label['dt_order_start'] : "dt_order_start"; 
          if ($Cada_col == "dt_order_start" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['id_card'])) ? $this->New_label['id_card'] : "id_card"; 
          if ($Cada_col == "id_card" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['id_order'])) ? $this->New_label['id_order'] : "id_order"; 
          if ($Cada_col == "id_order" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['main_table'])) ? $this->New_label['main_table'] : "main_table"; 
          if ($Cada_col == "main_table" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['occupied'])) ? $this->New_label['occupied'] : "occupied"; 
          if ($Cada_col == "occupied" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['order_status'])) ? $this->New_label['order_status'] : "order_status"; 
          if ($Cada_col == "order_status" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['people'])) ? $this->New_label['people'] : "people"; 
          if ($Cada_col == "people" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
      } 
      $this->Texto_tag .= "</tr>\r\n";
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT tb_restaurant_tables.id_table as tb_restaurant_tables_id_table, tb_restaurant_tables.seats as tb_restaurant_tables_seats, tb_restaurant_room.id_room as tb_restaurant_room_id_room, tb_restaurant_room.room_descr as tb_restaurant_room_room_descr, tb_restaurant_room.room_active as tb_restaurant_room_room_active from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT tb_restaurant_tables.id_table as tb_restaurant_tables_id_table, tb_restaurant_tables.seats as tb_restaurant_tables_seats, tb_restaurant_room.id_room as tb_restaurant_room_id_room, tb_restaurant_room.room_descr as tb_restaurant_room_room_descr, tb_restaurant_room.room_active as tb_restaurant_room_room_active from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT tb_restaurant_tables.id_table as tb_restaurant_tables_id_table, tb_restaurant_tables.seats as tb_restaurant_tables_seats, tb_restaurant_room.id_room as tb_restaurant_room_id_room, tb_restaurant_room.room_descr as tb_restaurant_room_room_descr, tb_restaurant_room.room_active as tb_restaurant_room_room_active from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT tb_restaurant_tables.id_table as tb_restaurant_tables_id_table, tb_restaurant_tables.seats as tb_restaurant_tables_seats, tb_restaurant_room.id_room as tb_restaurant_room_id_room, tb_restaurant_room.room_descr as tb_restaurant_room_room_descr, tb_restaurant_room.room_active as tb_restaurant_room_room_active from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT tb_restaurant_tables.id_table as tb_restaurant_tables_id_table, tb_restaurant_tables.seats as tb_restaurant_tables_seats, tb_restaurant_room.id_room as tb_restaurant_room_id_room, tb_restaurant_room.room_descr as tb_restaurant_room_room_descr, tb_restaurant_room.room_active as tb_restaurant_room_room_active from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT tb_restaurant_tables.id_table as tb_restaurant_tables_id_table, tb_restaurant_tables.seats as tb_restaurant_tables_seats, tb_restaurant_room.id_room as tb_restaurant_room_id_room, tb_restaurant_room.room_descr as tb_restaurant_room_room_descr, tb_restaurant_room.room_active as tb_restaurant_room_room_active from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select_count;
      $rt = $this->Db->Execute($nmgp_select_count);
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->count_ger = $rt->fields[0];
      $rt->Close();
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->SC_seq_register = 0;
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         $this->Texto_tag .= "<tr>\r\n";
         $this->tb_restaurant_tables_id_table = $rs->fields[0] ;  
         $this->tb_restaurant_tables_id_table = (string)$this->tb_restaurant_tables_id_table;
         $this->tb_restaurant_tables_seats = $rs->fields[1] ;  
         $this->tb_restaurant_tables_seats = (string)$this->tb_restaurant_tables_seats;
         $this->tb_restaurant_room_id_room = $rs->fields[2] ;  
         $this->tb_restaurant_room_id_room = (string)$this->tb_restaurant_room_id_room;
         $this->tb_restaurant_room_room_descr = $rs->fields[3] ;  
         $this->tb_restaurant_room_room_active = $rs->fields[4] ;  
         $this->tb_restaurant_room_room_active = (string)$this->tb_restaurant_room_room_active;
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['grid_room_now']['contr_erro'] = 'on';
 

$check_sql = "SELECT
   tb_orders.id_order,
   tb_orders.dt_order_start,
   tb_orders.order_status,
   tb_orders.people,
   tb_order_table.main_table
FROM
   tb_order_table JOIN tb_orders ON tb_order_table.id_order = tb_orders.id_order 
WHERE 
	(tb_orders.order_status IS NULL OR tb_orders.order_status <> 5) AND tb_order_table.id_table = " . $this->tb_restaurant_tables_id_table  ;
 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


if (isset($this->rs[0][0]))     
{
    $this->id_order  = $this->rs[0][0];
    $this->dt_order_start  = $this->rs[0][1];
	$this->order_status  = $this->rs[0][2];
    $this->people  = $this->rs[0][3];
    $this->main_table  = $this->rs[0][4];
	$this->occupied  = 1;
}
else     
{
	$this->id_order  = '';
    $this->dt_order_start  = '';
	$this->order_status  = '';
    $this->people  = '';
    $this->main_table  = ''; 
	$this->occupied  = 0;
}

$this->id_card ="tbl-";
$this->css_color ="free";

if( empty($this->id_order ) ) { 
	$this->id_card  .= $this->tb_restaurant_tables_id_table ."-0";
} else {
	$this->id_card  .= $this->tb_restaurant_tables_id_table ."-".$this->id_order ;
}

if( $this->occupied  == 1 ){ 
	$this->tb_restaurant_tables_seats  = $this->people  . " / " . $this->tb_restaurant_tables_seats ;
	if( $this->main_table  == 1 ){
		$this->css_color ="using";
	}else{
		$this->css_color ="merged";
	}
}
$_SESSION['scriptcase']['grid_room_now']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->Texto_tag .= "</tr>\r\n";
         $rs->MoveNext();
      }
      $this->Texto_tag .= "</table>\r\n";
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- tb_restaurant_tables_id_table
   function NM_export_tb_restaurant_tables_id_table()
   {
             nmgp_Form_Num_Val($this->tb_restaurant_tables_id_table, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->tb_restaurant_tables_id_table = NM_charset_to_utf8($this->tb_restaurant_tables_id_table);
         $this->tb_restaurant_tables_id_table = str_replace('<', '&lt;', $this->tb_restaurant_tables_id_table);
         $this->tb_restaurant_tables_id_table = str_replace('>', '&gt;', $this->tb_restaurant_tables_id_table);
         $this->Texto_tag .= "<td>" . $this->tb_restaurant_tables_id_table . "</td>\r\n";
   }
   //----- tb_restaurant_tables_seats
   function NM_export_tb_restaurant_tables_seats()
   {
             nmgp_Form_Num_Val($this->tb_restaurant_tables_seats, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->tb_restaurant_tables_seats = NM_charset_to_utf8($this->tb_restaurant_tables_seats);
         $this->tb_restaurant_tables_seats = str_replace('<', '&lt;', $this->tb_restaurant_tables_seats);
         $this->tb_restaurant_tables_seats = str_replace('>', '&gt;', $this->tb_restaurant_tables_seats);
         $this->Texto_tag .= "<td>" . $this->tb_restaurant_tables_seats . "</td>\r\n";
   }
   //----- tb_restaurant_room_id_room
   function NM_export_tb_restaurant_room_id_room()
   {
             nmgp_Form_Num_Val($this->tb_restaurant_room_id_room, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->tb_restaurant_room_id_room = NM_charset_to_utf8($this->tb_restaurant_room_id_room);
         $this->tb_restaurant_room_id_room = str_replace('<', '&lt;', $this->tb_restaurant_room_id_room);
         $this->tb_restaurant_room_id_room = str_replace('>', '&gt;', $this->tb_restaurant_room_id_room);
         $this->Texto_tag .= "<td>" . $this->tb_restaurant_room_id_room . "</td>\r\n";
   }
   //----- tb_restaurant_room_room_descr
   function NM_export_tb_restaurant_room_room_descr()
   {
         $this->tb_restaurant_room_room_descr = html_entity_decode($this->tb_restaurant_room_room_descr, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tb_restaurant_room_room_descr = strip_tags($this->tb_restaurant_room_room_descr);
         $this->tb_restaurant_room_room_descr = NM_charset_to_utf8($this->tb_restaurant_room_room_descr);
         $this->tb_restaurant_room_room_descr = str_replace('<', '&lt;', $this->tb_restaurant_room_room_descr);
         $this->tb_restaurant_room_room_descr = str_replace('>', '&gt;', $this->tb_restaurant_room_room_descr);
         $this->Texto_tag .= "<td>" . $this->tb_restaurant_room_room_descr . "</td>\r\n";
   }
   //----- tb_restaurant_room_room_active
   function NM_export_tb_restaurant_room_room_active()
   {
             nmgp_Form_Num_Val($this->tb_restaurant_room_room_active, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->tb_restaurant_room_room_active = NM_charset_to_utf8($this->tb_restaurant_room_room_active);
         $this->tb_restaurant_room_room_active = str_replace('<', '&lt;', $this->tb_restaurant_room_room_active);
         $this->tb_restaurant_room_room_active = str_replace('>', '&gt;', $this->tb_restaurant_room_room_active);
         $this->Texto_tag .= "<td>" . $this->tb_restaurant_room_room_active . "</td>\r\n";
   }
   //----- css_color
   function NM_export_css_color()
   {
         $this->css_color = html_entity_decode($this->css_color, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->css_color = strip_tags($this->css_color);
         $this->css_color = NM_charset_to_utf8($this->css_color);
         $this->css_color = str_replace('<', '&lt;', $this->css_color);
         $this->css_color = str_replace('>', '&gt;', $this->css_color);
         $this->Texto_tag .= "<td>" . $this->css_color . "</td>\r\n";
   }
   //----- dt_order_start
   function NM_export_dt_order_start()
   {
             $this->dt_order_start = substr($this->dt_order_start, 11) ;  
             if (substr($this->dt_order_start, 2, 1) == ".") 
             { 
                 $this->dt_order_start = substr($this->dt_order_start, 0, 2) . ":" . substr($this->dt_order_start, 3, 2) . ":" . substr($this->dt_order_start, 6);
             } 
             $conteudo_x =  $this->dt_order_start;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->dt_order_start, "HH:II:SS  ");
                 $this->dt_order_start = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhii"));
             } 
         $this->dt_order_start = NM_charset_to_utf8($this->dt_order_start);
         $this->dt_order_start = str_replace('<', '&lt;', $this->dt_order_start);
         $this->dt_order_start = str_replace('>', '&gt;', $this->dt_order_start);
         $this->Texto_tag .= "<td>" . $this->dt_order_start . "</td>\r\n";
   }
   //----- id_card
   function NM_export_id_card()
   {
         $this->id_card = html_entity_decode($this->id_card, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->id_card = strip_tags($this->id_card);
         $this->id_card = NM_charset_to_utf8($this->id_card);
         $this->id_card = str_replace('<', '&lt;', $this->id_card);
         $this->id_card = str_replace('>', '&gt;', $this->id_card);
         $this->Texto_tag .= "<td>" . $this->id_card . "</td>\r\n";
   }
   //----- id_order
   function NM_export_id_order()
   {
             nmgp_Form_Num_Val($this->id_order, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->id_order = NM_charset_to_utf8($this->id_order);
         $this->id_order = str_replace('<', '&lt;', $this->id_order);
         $this->id_order = str_replace('>', '&gt;', $this->id_order);
         $this->Texto_tag .= "<td>" . $this->id_order . "</td>\r\n";
   }
   //----- main_table
   function NM_export_main_table()
   {
             nmgp_Form_Num_Val($this->main_table, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->main_table = NM_charset_to_utf8($this->main_table);
         $this->main_table = str_replace('<', '&lt;', $this->main_table);
         $this->main_table = str_replace('>', '&gt;', $this->main_table);
         $this->Texto_tag .= "<td>" . $this->main_table . "</td>\r\n";
   }
   //----- occupied
   function NM_export_occupied()
   {
             nmgp_Form_Num_Val($this->occupied, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->occupied = NM_charset_to_utf8($this->occupied);
         $this->occupied = str_replace('<', '&lt;', $this->occupied);
         $this->occupied = str_replace('>', '&gt;', $this->occupied);
         $this->Texto_tag .= "<td>" . $this->occupied . "</td>\r\n";
   }
   //----- order_status
   function NM_export_order_status()
   {
             nmgp_Form_Num_Val($this->order_status, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->order_status = NM_charset_to_utf8($this->order_status);
         $this->order_status = str_replace('<', '&lt;', $this->order_status);
         $this->order_status = str_replace('>', '&gt;', $this->order_status);
         $this->Texto_tag .= "<td>" . $this->order_status . "</td>\r\n";
   }
   //----- people
   function NM_export_people()
   {
             nmgp_Form_Num_Val($this->people, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->people = NM_charset_to_utf8($this->people);
         $this->people = str_replace('<', '&lt;', $this->people);
         $this->people = str_replace('>', '&gt;', $this->people);
         $this->Texto_tag .= "<td>" . $this->people . "</td>\r\n";
   }

   //----- 
   function grava_arquivo_rtf()
   {
      global $nm_lang, $doc_wrap;
      $this->Rtf_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $rtf_f       = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      require_once($this->Ini->path_third      . "/rtf_new/document_generator/cl_xml2driver.php"); 
      $text_ok  =  "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n"; 
      $text_ok .=  "<DOC config_file=\"" . $this->Ini->path_third . "/rtf_new/doc_config.inc\" >\r\n"; 
      $text_ok .=  $this->Texto_tag; 
      $text_ok .=  "</DOC>\r\n"; 
      $xml = new nDOCGEN($text_ok,"RTF"); 
      fwrite($rtf_f, $xml->get_result_file());
      fclose($rtf_f);
   }

   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT") {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT") {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "SC_FORMAT_REGION") {
           $this->nm_data->SetaData($dt_in, strtoupper($form_in));
           $prep_out  = (strpos(strtolower($form_in), "dd") !== false) ? "dd" : "";
           $prep_out .= (strpos(strtolower($form_in), "mm") !== false) ? "mm" : "";
           $prep_out .= (strpos(strtolower($form_in), "aa") !== false) ? "aaaa" : "";
           $prep_out .= (strpos(strtolower($form_in), "yy") !== false) ? "aaaa" : "";
           return $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", $prep_out));
       }
       else {
           nm_conv_form_data($dt_out, $form_in, $form_out);
           return $dt_out;
       }
   }
   function progress_bar_end()
   {
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now'][$path_doc_md5][1] = $this->Tit_doc;
      $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
      if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
          $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
      }
      $this->pb->setProgressbarMessage($Mens_bar);
      $this->pb->setDownloadLink($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $this->pb->setDownloadMd5($path_doc_md5);
      $this->pb->completed();
   }
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_room_now'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_main_room'] ?> :: RTF</TITLE>
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
 <link rel="shortcut icon" href="../_lib/img/grp__NM__img__NM__sc_restaurant.png">
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <?php
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts))
 {
 ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->str_google_fonts ?>" />
 <?php
 }
 ?>
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">RTF</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_room_now_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_room_now"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="volta_grid"> 
</FORM> 
</BODY>
</HTML>
<?php
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $str_highlight_ini = "";
      $str_highlight_fim = "";
      if(substr($nm_campo, 0, 23) == '<div class="highlight">' && substr($nm_campo, -6) == '</div>')
      {
           $str_highlight_ini = substr($nm_campo, 0, 23);
           $str_highlight_fim = substr($nm_campo, -6);

           $trab_campo = substr($nm_campo, 23, -6);
           $tam_campo  = strlen($trab_campo);
      }      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($tam_campo >= $cont2)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
   } 
}

?>
