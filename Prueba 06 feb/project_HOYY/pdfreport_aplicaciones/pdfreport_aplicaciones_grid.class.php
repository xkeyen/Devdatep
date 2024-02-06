<?php
class pdfreport_aplicaciones_grid
{
   var $Ini;
   var $Erro;
   var $Pdf;
   var $Db;
   var $rs_grid;
   var $nm_grid_sem_reg;
   var $SC_seq_register;
   var $nm_location;
   var $nm_data;
   var $nm_cod_barra;
   var $sc_proc_grid; 
   var $nmgp_botoes = array();
   var $Campos_Mens_erro;
   var $NM_raiz_img; 
   var $Font_ttf; 
   var $nombre_aplicacion = array();
   var $tipo_aplicacion = array();
   var $descripcion = array();
//--- 
 function monta_grid($linhas = 0)
 {

   clearstatcache();
   $this->inicializa();
   $this->grid();
 }
//--- 
 function inicializa()
 {
   global $nm_saida, 
   $rec, $nmgp_chave, $nmgp_opcao, $nmgp_ordem, $nmgp_chave_det, 
   $nmgp_quant_linhas, $nmgp_quant_colunas, $nmgp_url_saida, $nmgp_parms;
//
   $this->nm_data = new nm_data("es");
   include_once("../_lib/lib/php/nm_font_tcpdf.php");
   $this->default_font = '';
   $this->default_font_sr  = '';
   $this->default_style    = '';
   $this->default_style_sr = 'B';
   $Tp_papel = "A4";
   $old_dir = getcwd();
   $File_font_ttf     = "";
   $temp_font_ttf     = "";
   $this->Font_ttf    = false;
   $this->Font_ttf_sr = false;
   if (empty($this->default_font) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   elseif (empty($this->default_font))
   {
       $this->default_font = "Times";
   }
   if (empty($this->default_font_sr) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font_sr = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   elseif (empty($this->default_font_sr))
   {
       $this->default_font_sr = "Times";
   }
   $_SESSION['scriptcase']['pdfreport_aplicaciones']['default_font'] = $this->default_font;
   chdir($this->Ini->path_third . "/tcpdf/");
   include_once("tcpdf.php");
   chdir($old_dir);
   $this->Pdf = new TCPDF('P', 'mm', $Tp_papel, true, 'UTF-8', false);
   $this->Pdf->setPrintHeader(false);
   $this->Pdf->setPrintFooter(false);
   if (!empty($File_font_ttf))
   {
       $this->Pdf->addTTFfont($File_font_ttf, "", "", 32, $_SESSION['scriptcase']['dir_temp'] . "/");
   }
   $this->Pdf->SetDisplayMode('real');
   $this->aba_iframe = false;
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("pdfreport_aplicaciones", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['exit'] = "on";
   $this->sc_proc_grid = false; 
   $this->NM_raiz_img = $this->Ini->root;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $this->nm_grid_colunas = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->nombre_aplicacion[0] = (isset($Busca_temp['nombre_aplicacion'])) ? $Busca_temp['nombre_aplicacion'] : ""; 
       $tmp_pos = (is_string($this->nombre_aplicacion[0])) ? strpos($this->nombre_aplicacion[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->nombre_aplicacion[0]))
       {
           $this->nombre_aplicacion[0] = substr($this->nombre_aplicacion[0], 0, $tmp_pos);
       }
       $this->tipo_aplicacion[0] = (isset($Busca_temp['tipo_aplicacion'])) ? $Busca_temp['tipo_aplicacion'] : ""; 
       $tmp_pos = (is_string($this->tipo_aplicacion[0])) ? strpos($this->tipo_aplicacion[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->tipo_aplicacion[0]))
       {
           $this->tipo_aplicacion[0] = substr($this->tipo_aplicacion[0], 0, $tmp_pos);
       }
       $this->descripcion[0] = (isset($Busca_temp['descripcion'])) ? $Busca_temp['descripcion'] : ""; 
       $tmp_pos = (is_string($this->descripcion[0])) ? strpos($this->descripcion[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->descripcion[0]))
       {
           $this->descripcion[0] = substr($this->descripcion[0], 0, $tmp_pos);
       }
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_pesq_filtro'];
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['qt_col_grid'] = 1 ;  
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_aplicaciones']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_aplicaciones']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_aplicaciones']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_aplicaciones']['cols']);
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['ordem_select']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['ordem_select'] = array(); 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['ordem_select']['nombre_aplicacion'] = 'asc'; 
   } 
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['ordem_quebra']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['ordem_ant']  = "nombre_aplicacion"; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['ordem_desc'] = "" ; 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_orig'] = "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_pesq_filtro'];
//
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['tot_geral'][1] ;  
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_pesq'];  
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   { 
       $nmgp_select = "SELECT nombre_aplicacion, tipo_aplicacion, descripcion from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT nombre_aplicacion, tipo_aplicacion, descripcion from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   { 
       $nmgp_select = "SELECT nombre_aplicacion, tipo_aplicacion, descripcion from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
   { 
       $nmgp_select = "SELECT nombre_aplicacion, tipo_aplicacion, descripcion from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
   { 
       $nmgp_select = "SELECT nombre_aplicacion, tipo_aplicacion, descripcion from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT nombre_aplicacion, tipo_aplicacion, descripcion from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['ordem_grid'])) 
   { 
       $nmgp_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['ordem_desc']; 
   } 
   if (!empty($campos_order_select)) 
   { 
       if (!empty($nmgp_order_by)) 
       { 
          $nmgp_order_by .= ", " . $campos_order_select; 
       } 
       else 
       { 
          $nmgp_order_by = " order by $campos_order_select"; 
       } 
   } 
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['order_grid'] = $nmgp_order_by;
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
   $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
   { 
       $this->nm_grid_sem_reg = $this->SC_conv_utf8($this->Ini->Nm_lang['lang_errm_empt']); 
   }  
// 
 }  
// 
 function Pdf_init()
 {
     if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
     {
         $this->Pdf->setRTL(true);
     }
     $this->Pdf->setHeaderMargin(0);
     $this->Pdf->setFooterMargin(0);
     if ($this->Font_ttf)
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 12, $this->def_TTF);
     }
     else
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 12);
     }
     $this->Pdf->SetTextColor(0, 0, 0);
 }
// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_saida, $nm_url_saida;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['labels']['nombre_aplicacion'] = "Nombre Aplicacion";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['labels']['tipo_aplicacion'] = "Tipo Aplicacion";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['labels']['descripcion'] = "Descripcion";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['seq_dir'] = 0; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['sub_dir'] = array(); 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['where_pesq_filtro'];
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_aplicaciones']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_aplicaciones']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_aplicaciones']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       $this->Pdf_init();
       $this->Pdf->AddPage();
       if ($this->Font_ttf_sr)
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12, $this->def_TTF);
       }
       else
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12);
       }
       $this->Pdf->Text(10, 10, html_entity_decode($this->nm_grid_sem_reg, ENT_COMPAT, $_SESSION['scriptcase']['charset']));
       $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
       return;
   }
// 
   $Init_Pdf = true;
   $this->SC_seq_register = 0; 
   while (!$this->rs_grid->EOF) 
   {  
      $this->nm_grid_colunas = 0; 
      $nm_quant_linhas = 0;
      $this->Pdf->setImageScale(1.33);
      $this->Pdf->AddPage();
      $this->Pdf_init();
      while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['qt_col_grid']) 
      {  
          $this->sc_proc_grid = true;
          $this->SC_seq_register++; 
          $this->nombre_aplicacion[$this->nm_grid_colunas] = $this->rs_grid->fields[0] ;  
          $this->tipo_aplicacion[$this->nm_grid_colunas] = $this->rs_grid->fields[1] ;  
          $this->descripcion[$this->nm_grid_colunas] = $this->rs_grid->fields[2] ;  
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->nombre_aplicacion[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->nombre_aplicacion[$this->nm_grid_colunas]));
          }
          else {
              $this->nombre_aplicacion[$this->nm_grid_colunas] = sc_strip_script($this->nombre_aplicacion[$this->nm_grid_colunas]);
          }
          if ($this->nombre_aplicacion[$this->nm_grid_colunas] === "") 
          { 
              $this->nombre_aplicacion[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nombre_aplicacion[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->nombre_aplicacion[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->tipo_aplicacion[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->tipo_aplicacion[$this->nm_grid_colunas]));
          }
          else {
              $this->tipo_aplicacion[$this->nm_grid_colunas] = sc_strip_script($this->tipo_aplicacion[$this->nm_grid_colunas]);
          }
          if ($this->tipo_aplicacion[$this->nm_grid_colunas] === "") 
          { 
              $this->tipo_aplicacion[$this->nm_grid_colunas] = "" ;  
          } 
          $this->tipo_aplicacion[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->tipo_aplicacion[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_aplicaciones']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->descripcion[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->descripcion[$this->nm_grid_colunas]));
          }
          else {
              $this->descripcion[$this->nm_grid_colunas] = sc_strip_script($this->descripcion[$this->nm_grid_colunas]);
          }
          if ($this->descripcion[$this->nm_grid_colunas] === "") 
          { 
              $this->descripcion[$this->nm_grid_colunas] = "" ;  
          } 
          $this->descripcion[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->descripcion[$this->nm_grid_colunas]);
                      /*-------- Def. Body --------*/
            $cell_nombre_aplicacion = array('posx' => '10', 'posy' => '10', 'data' => $this->nombre_aplicacion[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_tipo_aplicacion = array('posx' => '10', 'posy' => '20', 'data' => $this->tipo_aplicacion[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_descripcion = array('posx' => '10', 'posy' => '30', 'data' => $this->descripcion[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);

          /*------------------ Page 1 -----------------*/

            $this->Pdf->SetFont($cell_nombre_aplicacion['font_type'], $cell_nombre_aplicacion['font_style'], $cell_nombre_aplicacion['font_size']);
            $this->pdf_text_color($cell_nombre_aplicacion['data'], $cell_nombre_aplicacion['color_r'], $cell_nombre_aplicacion['color_g'], $cell_nombre_aplicacion['color_b']);
            if (!empty($cell_nombre_aplicacion['posx']) && !empty($cell_nombre_aplicacion['posy']))
            {
                $this->Pdf->SetXY($cell_nombre_aplicacion['posx'], $cell_nombre_aplicacion['posy']);
            }
            elseif (!empty($cell_nombre_aplicacion['posx']))
            {
                $this->Pdf->SetX($cell_nombre_aplicacion['posx']);
            }
            elseif (!empty($cell_nombre_aplicacion['posy']))
            {
                $this->Pdf->SetY($cell_nombre_aplicacion['posy']);
            }
            $this->Pdf->Cell($cell_nombre_aplicacion['width'], 0, $cell_nombre_aplicacion['data'], 0, 0, $cell_nombre_aplicacion['align']);

            $this->Pdf->SetFont($cell_tipo_aplicacion['font_type'], $cell_tipo_aplicacion['font_style'], $cell_tipo_aplicacion['font_size']);
            $this->pdf_text_color($cell_tipo_aplicacion['data'], $cell_tipo_aplicacion['color_r'], $cell_tipo_aplicacion['color_g'], $cell_tipo_aplicacion['color_b']);
            if (!empty($cell_tipo_aplicacion['posx']) && !empty($cell_tipo_aplicacion['posy']))
            {
                $this->Pdf->SetXY($cell_tipo_aplicacion['posx'], $cell_tipo_aplicacion['posy']);
            }
            elseif (!empty($cell_tipo_aplicacion['posx']))
            {
                $this->Pdf->SetX($cell_tipo_aplicacion['posx']);
            }
            elseif (!empty($cell_tipo_aplicacion['posy']))
            {
                $this->Pdf->SetY($cell_tipo_aplicacion['posy']);
            }
            $this->Pdf->Cell($cell_tipo_aplicacion['width'], 0, $cell_tipo_aplicacion['data'], 0, 0, $cell_tipo_aplicacion['align']);

            $this->Pdf->SetFont($cell_descripcion['font_type'], $cell_descripcion['font_style'], $cell_descripcion['font_size']);
            $this->pdf_text_color($cell_descripcion['data'], $cell_descripcion['color_r'], $cell_descripcion['color_g'], $cell_descripcion['color_b']);
            if (!empty($cell_descripcion['posx']) && !empty($cell_descripcion['posy']))
            {
                $this->Pdf->SetXY($cell_descripcion['posx'], $cell_descripcion['posy']);
            }
            elseif (!empty($cell_descripcion['posx']))
            {
                $this->Pdf->SetX($cell_descripcion['posx']);
            }
            elseif (!empty($cell_descripcion['posy']))
            {
                $this->Pdf->SetY($cell_descripcion['posy']);
            }
            $this->Pdf->Cell($cell_descripcion['width'], 0, $cell_descripcion['data'], 0, 0, $cell_descripcion['align']);

          /*-------------------------------------------*/
          $max_Y = 0;
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
      }  
   }  
   $this->rs_grid->Close();
   $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
 }
 function pdf_text_color(&$val, $r, $g, $b)
 {
     if (is_array($val)) {
         $val = "";
     }
     $pos = strpos($val, "@SCNEG#");
     if ($pos !== false)
     {
         $cor = trim(substr($val, $pos + 7));
         $val = substr($val, 0, $pos);
         $cor = (substr($cor, 0, 1) == "#") ? substr($cor, 1) : $cor;
         if (strlen($cor) == 6)
         {
             $r = hexdec(substr($cor, 0, 2));
             $g = hexdec(substr($cor, 2, 2));
             $b = hexdec(substr($cor, 4, 2));
         }
     }
     $this->Pdf->SetTextColor($r, $g, $b);
 }
 function SC_conv_utf8($input)
 {
     if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($input))
     {
         $input = sc_convert_encoding($input, "UTF-8", $_SESSION['scriptcase']['charset']);
     }
     return $input;
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
