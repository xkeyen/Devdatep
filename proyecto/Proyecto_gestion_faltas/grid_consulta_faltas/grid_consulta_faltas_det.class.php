<?php
//--- 
class grid_consulta_faltas_det
{
   var $Ini;
   var $Erro;
   var $Db;
   var $nm_data;
   var $NM_raiz_img; 
   var $nmgp_botoes     = array(); 
   var $nm_btn_exist    = array(); 
   var $nm_btn_label    = array(); 
   var $nm_btn_disabled = array(); 
   var $nm_location;
   var $colaborador;
   var $desc_falta;
   var $tipo_falta_descripcion;
   var $fecha_falta;
   var $tipo_sancion;
   var $estado_sancion;
   var $fecha_sancion;
   var $evidencia;
   var $usuario_registro;
   var $perfil_s;
   var $perfil_r;
   var $fecha_registro;
   var $usuario_sancion;
   var $area;
   var $tiempo_transcurrido;
    function getFieldHighlight($filter_type, $field, $str_value, $str_value_original='')
    {
        $str_html_ini = '<div class="highlight">';
        $str_html_fim = '</div>';

        if($filter_type == 'advanced_search')
        {
            if (
                isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ]) &&
                isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field . "_cond" ]) &&
                !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ]) &&
                (
                    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field . "_cond"] == 'qp' ||
                    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field . "_cond"] == 'eq' ||
                    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field . "_cond"] == 'ii'
                )
            )
            {
                if($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field . "_cond"] == 'qp')
                {
                    if(is_array($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ]))
                    {
                        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ] as $ind => $vals)
                        {
                            if(strcasecmp($vals, $str_value) == 0)
                            {
                                $str_value = $str_html_ini. $str_value .$str_html_fim;
                            }
                            elseif(strcasecmp($vals, $str_value_original) == 0)
                            {
                                $str_value = $str_html_ini. $str_value .$str_html_fim;
                            }
                            else
                            {
                                $keywords = preg_quote($vals, '/');
                                $str_value = preg_replace('/'. $keywords .'/i', $str_html_ini . '$0' . $str_html_fim, $str_value);
                            }
                        }
                    }
                    else
                    {
                        if(strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ], $str_value) == 0)
                        {
                            $str_value = $str_html_ini. $str_value .$str_html_fim;
                        }
                        elseif(strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ], $str_value_original) == 0)
                        {
                            $str_value = $str_html_ini. $str_value .$str_html_fim;
                        }
                        else
                        {
                            $keywords = preg_quote($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ], '/');
                            $str_value = preg_replace('/'. $keywords .'/i', $str_html_ini . '$0' . $str_html_fim, $str_value);
                        }
                    }
                }
                elseif($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field . "_cond"] == 'eq')
                {
                    if(is_array($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ]))
                    {
                        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ] as $ind => $vals)
                        {
                            if(strcasecmp($vals, $str_value) == 0)
                            {
                                $str_value = $str_html_ini. $str_value .$str_html_fim;
                            }
                            elseif(strcasecmp($vals, $str_value_original) == 0)
                            {
                                $str_value = $str_html_ini. $str_value .$str_html_fim;
                            }
                        }
                    }
                    else
                    {
                        if(strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ], $str_value) == 0)
                        {
                            $str_value = $str_html_ini. $str_value .$str_html_fim;
                        }
                        elseif(strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ], $str_value_original) == 0)
                        {
                            $str_value = $str_html_ini. $str_value .$str_html_fim;
                        }
                    }
                }
                elseif($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field . "_cond"] == 'ii')
                {
                    if(is_array($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ]))
                    {
                        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ] as $ind => $vals)
                        {
                            if(strcasecmp($vals, substr($str_value, 0, strlen($vals))) == 0)
                            {
                                $str_value = $str_html_ini. substr($str_value, 0, strlen($vals)) .$str_html_fim . substr($str_value, strlen($vals));
                            }
                        }
                    }
                    else
                    {
                        if(strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ], substr($str_value, 0, strlen($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ]))) == 0)
                        {
                            $str_value = $str_html_ini. substr($str_value, 0, strlen($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ])) .$str_html_fim . substr($str_value, strlen($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'][ $field ]));
                        }
                    }
                }
            }
        }
        elseif($filter_type == 'quicksearch')
        {
            if(
                isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['fast_search'][0]) &&
                (
                    (
                    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['fast_search'][0] == 'SC_all_Cmp' &&
                    in_array($field, array('colaborador', 'desc_falta', 'tipo_falta_descripcion', 'fecha_falta', 'tipo_sancion', 'estado_sancion', 'fecha_sancion', 'evidencia', 'usuario_registro', 'perfil_s', 'perfil_r', 'fecha_registro'))
                    ) ||
                    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['fast_search'][0] == $field ||
                    strpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['fast_search'][0], $field . '_VLS_') !== false ||
                    strpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['fast_search'][0], '_VLS_' . $field) !== false
                )
            )
            {
                if($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['fast_search'][1] == 'qp')
                {
                    if(strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['fast_search'][2], $str_value) == 0)
                    {
                        $str_value = $str_html_ini. $str_value .$str_html_fim;
                    }
                    elseif(!empty($str_value_original) && $str_value_original != '&nbsp;' && strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['fast_search'][2], $str_value_original) == 0)
                    {
                        $str_value = $str_html_ini. $str_value .$str_html_fim;
                    }
                    else
                    {
                        $keywords = preg_quote($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['fast_search'][2], '/');
                        $str_value = preg_replace('/'. $keywords .'/i', $str_html_ini . '$0' . $str_html_fim, $str_value);
                    }
                }
                elseif($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['fast_search'][1] == 'eq')
                {
                    if(strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['fast_search'][2], $str_value) == 0)
                    {
                        $str_value = $str_html_ini. $str_value .$str_html_fim;
                    }
                    elseif(!empty($str_value_original) && $str_value_original != '&nbsp;' && strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['fast_search'][2], $str_value_original) == 0)
                    {
                        $str_value = $str_html_ini. $str_value .$str_html_fim;
                    }
                }
            }
        }
        return $str_value;
    }
 function monta_det()
 {
    global 
           $nm_saida, $nm_lang, $nmgp_cor_print, $nmgp_tipo_pdf;
    $this->nmgp_botoes['det_pdf'] = "on";
    $this->nmgp_botoes['pdf'] = "on";
    $this->nmgp_botoes['det_print'] = "on";
    $this->nmgp_botoes['print'] = "on";
    $this->nmgp_botoes['html'] = "on";
    $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
    if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_consulta_faltas']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_consulta_faltas']['btn_display']))
    {
        foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_consulta_faltas']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
        {
            $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
        }
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida_form']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida_form'])
    {
    $this->nmgp_botoes['det_pdf']   = "off";
    $this->nmgp_botoes['det_print'] = "off";
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca']))
    { 
        $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['campos_busca'];
        if ($_SESSION['scriptcase']['charset'] != "UTF-8")
        {
            $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
        $this->colaborador = (isset($Busca_temp['colaborador'])) ? $Busca_temp['colaborador'] : ""; 
        $tmp_pos = (is_string($this->colaborador)) ? strpos($this->colaborador, "##@@") : false;
        if ($tmp_pos !== false && !is_array($this->colaborador))
        {
            $this->colaborador = substr($this->colaborador, 0, $tmp_pos);
        }
        $this->desc_falta = (isset($Busca_temp['desc_falta'])) ? $Busca_temp['desc_falta'] : ""; 
        $tmp_pos = (is_string($this->desc_falta)) ? strpos($this->desc_falta, "##@@") : false;
        if ($tmp_pos !== false && !is_array($this->desc_falta))
        {
            $this->desc_falta = substr($this->desc_falta, 0, $tmp_pos);
        }
        $this->fecha_falta = (isset($Busca_temp['fecha_falta'])) ? $Busca_temp['fecha_falta'] : ""; 
        $tmp_pos = (is_string($this->fecha_falta)) ? strpos($this->fecha_falta, "##@@") : false;
        if ($tmp_pos !== false && !is_array($this->fecha_falta))
        {
            $this->fecha_falta = substr($this->fecha_falta, 0, $tmp_pos);
        }
        $this->fecha_falta_2 = (isset($Busca_temp['fecha_falta_input_2'])) ? $Busca_temp['fecha_falta_input_2'] : ""; 
        $this->usuario_registro = (isset($Busca_temp['usuario_registro'])) ? $Busca_temp['usuario_registro'] : ""; 
        $tmp_pos = (is_string($this->usuario_registro)) ? strpos($this->usuario_registro, "##@@") : false;
        if ($tmp_pos !== false && !is_array($this->usuario_registro))
        {
            $this->usuario_registro = substr($this->usuario_registro, 0, $tmp_pos);
        }
    } 
    else 
    { 
        $this->fecha_falta_2 = ""; 
    } 
    $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_orig'];
    $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_pesq'];
    $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['where_pesq_filtro'];
    $this->nm_field_dinamico = array();
    $this->nm_order_dinamico = array();
    $this->nm_data = new nm_data("en_us");
    $this->NM_raiz_img  = ""; 
    if ($this->Ini->sc_export_ajax_img)
    { 
        $this->NM_raiz_img = $this->Ini->root; 
    } 
    $this->sc_proc_grid = false; 
    include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['seq_dir'] = 0; 
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['sub_dir'] = array(); 
   if ($_SESSION['scriptcase']['proc_mobile']) {
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
   }
   $Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
   $Lim   = strlen($Str_date);
   $Ult   = "";
   $Arr_D = array();
   for ($I = 0; $I < $Lim; $I++)
   {
       $Char = substr($Str_date, $I, 1);
       if ($Char != $Ult)
       {
           $Arr_D[] = $Char;
       }
       $Ult = $Char;
   }
   $Prim = true;
   $Str  = "";
   foreach ($Arr_D as $Cada_d)
   {
       $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
       $Str .= $Cada_d;
       $Prim = false;
   }
   $Str = str_replace("a", "Y", $Str);
   $Str = str_replace("y", "Y", $Str);
   $nm_data_fixa = date($Str); 
   $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS"); 
   $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase)) 
   { 
       $nmgp_select = "SELECT g1.general_name as colaborador, fl.fault_name as desc_falta, str_replace (convert(char(10),f.fault_practitioner_date,102), '.', '-') + ' ' + convert(char(8),f.fault_practitioner_date,20), g2.general_name as usuario_registro, d2.division_name as perfil_r, str_replace (convert(char(10),f.fault_register_date,102), '.', '-') + ' ' + convert(char(8),f.fault_register_date,20), g3.general_name as usuario_sancion, d3.division_name as perfil_s, str_replace (convert(char(10),f.sanction_date,102), '.', '-') + ' ' + convert(char(8),f.sanction_date,20), ft.fault_type_description as tipo_falta_descripcion, fp.sanction_description as estado_sancion, fr.sanction_type_name as tipo_sancion, f.evidence as evidencia, f.area_id as area, DATEDIFF(f.sanction_date,f.fault_practitioner_date) as tiempo_transcurrido from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql)) 
   { 
       $nmgp_select = "SELECT g1.general_name as colaborador, fl.fault_name as desc_falta, convert(char(23),f.fault_practitioner_date,121), g2.general_name as usuario_registro, d2.division_name as perfil_r, convert(char(23),f.fault_register_date,121), g3.general_name as usuario_sancion, d3.division_name as perfil_s, convert(char(23),f.sanction_date,121), ft.fault_type_description as tipo_falta_descripcion, fp.sanction_description as estado_sancion, fr.sanction_type_name as tipo_sancion, f.evidence as evidencia, f.area_id as area, DATEDIFF(f.sanction_date,f.fault_practitioner_date) as tiempo_transcurrido from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle)) 
   { 
       $nmgp_select = "SELECT g1.general_name as colaborador, fl.fault_name as desc_falta, f.fault_practitioner_date as fecha_falta, g2.general_name as usuario_registro, d2.division_name as perfil_r, f.fault_register_date as fecha_registro, g3.general_name as usuario_sancion, d3.division_name as perfil_s, f.sanction_date as fecha_sancion, ft.fault_type_description as tipo_falta_descripcion, fp.sanction_description as estado_sancion, fr.sanction_type_name as tipo_sancion, f.evidence as evidencia, f.area_id as area, DATEDIFF(f.sanction_date,f.fault_practitioner_date) as tiempo_transcurrido from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix)) 
   { 
       $nmgp_select = "SELECT g1.general_name as colaborador, fl.fault_name as desc_falta, EXTEND(f.fault_practitioner_date, YEAR TO FRACTION), g2.general_name as usuario_registro, d2.division_name as perfil_r, EXTEND(f.fault_register_date, YEAR TO FRACTION), g3.general_name as usuario_sancion, d3.division_name as perfil_s, EXTEND(f.sanction_date, YEAR TO FRACTION), ft.fault_type_description as tipo_falta_descripcion, fp.sanction_description as estado_sancion, fr.sanction_type_name as tipo_sancion, f.evidence as evidencia, f.area_id as area, DATEDIFF(f.sanction_date,f.fault_practitioner_date) as tiempo_transcurrido from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT g1.general_name as colaborador, fl.fault_name as desc_falta, f.fault_practitioner_date as fecha_falta, g2.general_name as usuario_registro, d2.division_name as perfil_r, f.fault_register_date as fecha_registro, g3.general_name as usuario_sancion, d3.division_name as perfil_s, f.sanction_date as fecha_sancion, ft.fault_type_description as tipo_falta_descripcion, fp.sanction_description as estado_sancion, fr.sanction_type_name as tipo_sancion, f.evidence as evidencia, f.area_id as area, DATEDIFF(f.sanction_date,f.fault_practitioner_date) as tiempo_transcurrido from " . $this->Ini->nm_tabela; 
   } 
   $parms_det = explode("*PDet*", $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['chave_det']) ; 
   foreach ($parms_det as $key => $cada_par)
   {
       $parms_det[$key] = $this->Db->qstr($parms_det[$key]);
       $parms_det[$key] = substr($parms_det[$key], 1, strlen($parms_det[$key]) - 2);
   } 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nmgp_select .= " where  g1.general_name = '$parms_det[0]' and fl.fault_name = '$parms_det[1]' and ft.fault_type_description = '$parms_det[2]' and f.fault_practitioner_date = #$parms_det[3]# and fr.sanction_type_name = '$parms_det[4]' and fp.sanction_description = '$parms_det[5]' and f.sanction_date = #$parms_det[6]# and f.evidence = '$parms_det[7]' and g2.general_name = '$parms_det[8]' and d3.division_name = '$parms_det[9]' and d2.division_name = '$parms_det[10]' and f.fault_register_date = #$parms_det[11]# and f.area_id = '$parms_det[12]'" ;  
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nmgp_select .= " where  g1.general_name = '$parms_det[0]' and fl.fault_name = '$parms_det[1]' and ft.fault_type_description = '$parms_det[2]' and convert(char(23),f.fault_practitioner_date,121) = '$parms_det[3]' and fr.sanction_type_name = '$parms_det[4]' and fp.sanction_description = '$parms_det[5]' and convert(char(23),f.sanction_date,121) = '$parms_det[6]' and f.evidence = '$parms_det[7]' and g2.general_name = '$parms_det[8]' and d3.division_name = '$parms_det[9]' and d2.division_name = '$parms_det[10]' and convert(char(23),f.fault_register_date,121) = '$parms_det[11]' and f.area_id = '$parms_det[12]'" ;  
   } 
   else 
   { 
       $nmgp_select .= " where  g1.general_name = '$parms_det[0]' and fl.fault_name = '$parms_det[1]' and ft.fault_type_description = '$parms_det[2]' and f.fault_practitioner_date = " . $this->Ini->date_delim . $parms_det[3] . $this->Ini->date_delim1 . " and fr.sanction_type_name = '$parms_det[4]' and fp.sanction_description = '$parms_det[5]' and f.sanction_date = " . $this->Ini->date_delim . $parms_det[6] . $this->Ini->date_delim1 . " and f.evidence = '$parms_det[7]' and g2.general_name = '$parms_det[8]' and d3.division_name = '$parms_det[9]' and d2.division_name = '$parms_det[10]' and f.fault_register_date = " . $this->Ini->date_delim . $parms_det[11] . $this->Ini->date_delim1 . " and f.area_id = '$parms_det[12]'" ;  
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
   $rs = $this->Db->Execute($nmgp_select) ; 
   if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   $this->colaborador = $rs->fields[0] ;  
   $this->desc_falta = $rs->fields[1] ;  
   $this->fecha_falta = $rs->fields[2] ;  
   $this->usuario_registro = $rs->fields[3] ;  
   $this->perfil_r = $rs->fields[4] ;  
   $this->fecha_registro = $rs->fields[5] ;  
   $this->usuario_sancion = $rs->fields[6] ;  
   $this->perfil_s = $rs->fields[7] ;  
   $this->fecha_sancion = $rs->fields[8] ;  
   $this->tipo_falta_descripcion = $rs->fields[9] ;  
   $this->estado_sancion = $rs->fields[10] ;  
   $this->tipo_sancion = $rs->fields[11] ;  
   $this->evidencia = $rs->fields[12] ;  
   $this->area = $rs->fields[13] ;  
   $this->tiempo_transcurrido = $rs->fields[14] ;  
   $this->tiempo_transcurrido = (string)$this->tiempo_transcurrido;
//--- 
   $nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
   $nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
   $nm_saida->saida("<html" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
   $nm_saida->saida("<HEAD>\r\n");
   $nm_saida->saida("   <TITLE>" . $this->Ini->Nm_lang['lang_othr_detl_title'] . " </TITLE>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
   $nm_saida->saida(" <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Last-Modified\" content=\"" . gmdate("D, d M Y H:i:s") . " GMT\"/>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
   $nm_saida->saida(" <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n");
   if ($_SESSION['scriptcase']['proc_mobile'])
   {
       $nm_saida->saida(" <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\" />\r\n");
   }

           $nm_saida->saida("   <script type=\"text/javascript\" src=\"grid_consulta_faltas_jquery_1040.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"grid_consulta_faltas_ajax.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"grid_consulta_faltas_message.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var applicationKeys = '';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+q';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+p';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'ctrl+p';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'f1';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+shift+p';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+shift+h';\r\n");
           $nm_saida->saida("     var hotkeyList = '';\r\n");
           $nm_saida->saida("     function execHotKey(e, h) {\r\n");
           $nm_saida->saida("         var hotkey_fired = false\r\n");
           $nm_saida->saida("         switch (true) {\r\n");
           $nm_saida->saida("             case (['alt+q'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_sai');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+p'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_pdf');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['ctrl+p'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_imp');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['f1'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_webh');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+shift+p'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_email_pdf');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+shift+h'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_email_html');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("         }\r\n");
           $nm_saida->saida("         if (hotkey_fired) {\r\n");
           $nm_saida->saida("             e.preventDefault();\r\n");
           $nm_saida->saida("             return false;\r\n");
           $nm_saida->saida("         } else {\r\n");
           $nm_saida->saida("             return true;\r\n");
           $nm_saida->saida("         }\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/hotkeys.inc.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/hotkeys_setup.js\"></script>\r\n");
   $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/viewerjs/viewer.css\" />\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/viewerjs/viewer.js\"></script>\r\n");
           if ($_SESSION['scriptcase']['proc_mobile']) {  
               $forced_mobile = (isset($_SESSION['scriptcase']['force_mobile']) && $_SESSION['scriptcase']['force_mobile']) ? 'true' : 'false';
               $sc_app_data = json_encode([ 
                   'forceMobile' => $forced_mobile, 
                   'appType' => 'detail', 
                   'improvements' => true, 
                   'displayOptionsButton' => false, 
                   'displayScrollUp' => true, 
                   'bottomToolbarFixed' => true, 
                   'mobileSimpleToolbar' => true, 
                   'scrollUpPosition' => 'A', 
                   'toolbarOrientation' => 'H', 
                   'mobilePanes' => 'true', 
                   'navigationBarButtons' => unserialize('a:5:{i:0;s:14:"sys_format_ini";i:1;s:14:"sys_format_ret";i:2;s:15:"sys_format_rows";i:3;s:14:"sys_format_ava";i:4;s:14:"sys_format_fim";}'), 
                   'langs' => [ 
                       'lang_refined_search' => html_entity_decode($this->Ini->Nm_lang['lang_refined_search'], ENT_COMPAT, $_SESSION['scriptcase']['charset']), 
                       'lang_summary_search_button' => html_entity_decode($this->Ini->Nm_lang['lang_summary_search_button'], ENT_COMPAT, $_SESSION['scriptcase']['charset']), 
                       'lang_details_button' => html_entity_decode($this->Ini->Nm_lang['lang_details_button'], ENT_COMPAT, $_SESSION['scriptcase']['charset']), 
                   ], 
               ]); ?> 
        <input type="hidden" id="sc-mobile-app-data" value='<?php echo $sc_app_data; ?>' />
        <script type="text/javascript" src="../_lib/lib/js/nm_modal_panes.jquery.js"></script>
        <script type="text/javascript" src="../_lib/lib/js/nm_mobile.js"></script>
        <link rel='stylesheet' href='../_lib/lib/css/nm_mobile.css' type='text/css'/>
    <script>
        $(document).ready(function(){
            bootstrapMobile();
        });
    </script>
          <?php }
$nm_saida->saida("<script>\r\n");
$nm_saida->saida("function ajax_check_file(img_name, field , i , p, p_cache){\r\n");
$nm_saida->saida("    $(document).ready(function(){\r\n");
$nm_saida->saida("        $('#id_sc_field_'+ field +'_'+i+'> img').attr('src', '" . $this->Ini->path_icones . "/ scriptcase__NM__ajax_load.gif');\r\n");
$nm_saida->saida("        $('#id_sc_field_'+ field +'_'+i+' > a > img').attr('src', '" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif');\r\n");
$nm_saida->saida("        $('#id_sc_field_'+ field +'_'+i+' > span > a > img').attr('src', '" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif');\r\n");
$nm_saida->saida("    var rs =$.ajax({\r\n");
$nm_saida->saida("                type: \"POST\",\r\n");
$nm_saida->saida("                url: 'index.php?script_case_init=" . $this->Ini->sc_page . "',\r\n");
$nm_saida->saida("                async: true,\r\n");
$nm_saida->saida("                data: 'nmgp_opcao=ajax_check_file&AjaxCheckImg=' + img_name +'&rsargs='+ field + '&p='+ p + '&p_cache='+ p_cache,\r\n");
$nm_saida->saida("            }).done(function (rs) {\r\n");
$nm_saida->saida("                    if(rs.indexOf('</span>') != -1){\r\n");
$nm_saida->saida("                        rs = rs.substr(rs.indexOf('</span>')  + 7);\r\n");
$nm_saida->saida("                    }\r\n");
$nm_saida->saida("                    if (rs != 0) {\r\n");
$nm_saida->saida("                        rs = rs.trim();\r\n");
$nm_saida->saida("                        if( $('.css_'+field+'_det_line a img').length > 0){\r\n");
$nm_saida->saida("                            $('.css_'+field+'_det_line a img').attr('src', rs.split('_@@NM@@_')[1]);\r\n");
$nm_saida->saida("                            var __tmp = $('.css_'+field+'_det_line a').attr('href').split(\"',\")\r\n");
$nm_saida->saida("                            __tmp[0] = \"javascript:nm_mostra_img('\" + rs.split('_@@NM@@_')[0];\r\n");
$nm_saida->saida("                            $('.css_'+field+'_det_line a').attr('href',__tmp.join(\"',\"));\r\n");
$nm_saida->saida("                        }else if($('.css_'+field+'_det_line a').length > 0){\r\n");
$nm_saida->saida("                            var __tmp = $('.css_'+field+'_det_line a').attr('href').split(\"',\");\r\n");
$nm_saida->saida("                            var __file_doc = __tmp[0].split('@SC_par@');\r\n");
$nm_saida->saida("                            var ___file_doc = __file_doc[3].split(\"'\");\r\n");
$nm_saida->saida("                            ___file_doc[0] = rs.split('_@@NM@@_')[1];\r\n");
$nm_saida->saida("                            __file_doc[3] = ___file_doc.join(\"'\");\r\n");
$nm_saida->saida("                            __tmp[0] = __file_doc.join('@SC_par@');\r\n");
$nm_saida->saida("                            $('.css_'+field+'_det_line a').attr('href', __tmp.join(\"',\"));\r\n");
$nm_saida->saida("                        }\r\n");
$nm_saida->saida("                    }\r\n");
$nm_saida->saida("                });\r\n");
$nm_saida->saida("    });\r\n");
$nm_saida->saida("}\r\n");
$nm_saida->saida("</script>\r\n");
   $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/malsup-blockui/jquery.blockUI.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("  var sc_pathToTB = '" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/';\r\n");
           $nm_saida->saida("  var sc_tbLangClose = \"" . html_entity_decode($this->Ini->Nm_lang['lang_tb_close'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\";\r\n");
           $nm_saida->saida("  var sc_tbLangEsc = \"" . html_entity_decode($this->Ini->Nm_lang['lang_tb_esc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\";\r\n");
           $nm_saida->saida(" </script>\r\n");
   $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var sc_ajaxBg = '" . $this->Ini->Color_bg_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordC = '" . $this->Ini->Border_c_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordS = '" . $this->Ini->Border_s_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordW = '" . $this->Ini->Border_w_ajax . "';\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("<style type=\"text/css\">\r\n");
           $nm_saida->saida("</style>\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/light.css\"></script>\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/light-border.css\"></script>\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/material.css\"></script>\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/translucent.css\"></script>\r\n");
           $nm_saida->saida("<script src=\"" . $this->Ini->path_prod . "/third/tippyjs/popper.min.js\"></script>\r\n");
           $nm_saida->saida("<script src=\"" . $this->Ini->path_prod . "/third/tippyjs/tippy-bundle.umd.min.js\"></script>\r\n");
           $nm_saida->saida("<script>\r\n");
           $nm_saida->saida("</script>\r\n");
   $nm_saida->saida(" <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n");
   if (($this->Ini->sc_export_ajax || $this->Ini->Export_det_zip) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['det_print'] == "print")
   {
       if (strtoupper($nmgp_cor_print) == "PB")
       {
           $NM_css_file = $this->Ini->str_schema_all . "_grid_bw.css";
           $NM_css_dir  = $this->Ini->str_schema_all . "_grid_bw" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
       }
       else
       {
           $NM_css_file = $this->Ini->str_schema_all . "_grid.css";
           $NM_css_dir  = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
       }
       $NM_css_cmp  = $this->Ini->path_link . "grid_consulta_faltas/grid_consulta_faltas_det_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css";
       $nm_saida->saida("  <style type=\"text/css\">\r\n");
       if (is_file($this->Ini->path_css . $NM_css_file))
       {
           $NM_css_attr = file($this->Ini->path_css . $NM_css_file);
           foreach ($NM_css_attr as $NM_line_css)
           {
               $nm_saida->saida(" " . $NM_line_css . " \r\n");
           }
       }
       if (is_file($this->Ini->path_css . $NM_css_dir))
       {
           $NM_css_attr = file($this->Ini->path_css . $NM_css_dir);
           foreach ($NM_css_attr as $NM_line_css)
           {
               $nm_saida->saida(" " . $NM_line_css . " \r\n");
           }
       }
       if (is_file($this->Ini->root . $NM_css_cmp))
       {
           $NM_css_attr = file($this->Ini->root . $NM_css_cmp);
           foreach ($NM_css_attr as $NM_line_css)
           {
               $nm_saida->saida(" " . $NM_line_css . " \r\n");
           }
       }
       $nm_saida->saida("  </style>\r\n");
   }
   elseif (($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['det_print'] == "print" && strtoupper($nmgp_cor_print) == "PB") || $nmgp_tipo_pdf == "pb")
   {
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "_lib/css/" . $this->Ini->str_schema_all . "_grid_bw.css\" /> \r\n");
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "_lib/css/" . $this->Ini->str_schema_all . "_grid_bw" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "grid_consulta_faltas/grid_consulta_faltas_det_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
   }
   else
   {
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "_lib/css/" . $this->Ini->str_schema_all . "_grid.css\" /> \r\n");
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "_lib/css/" . $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "grid_consulta_faltas/grid_consulta_faltas_det_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
   }
       $nm_saida->saida(" <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/font-awesome/6/css/all.min.css\" type=\"text/css\" media=\"screen,print\" />\r\n");
   if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
   { 
       $nm_saida->saida(" <link href=\"" . $this->Ini->str_google_fonts . "\" rel=\"stylesheet\" /> \r\n");
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['pdf_det'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['det_print'] != "print")
   {
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
       $nm_saida->saida(" <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
       $nm_saida->saida(" <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
   }
   $nm_saida->saida("</HEAD>\r\n");
    $removeMargin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['link_info']['remove_margin'] ? 'margin: 0;' : '';
    $removeBorder = isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['link_info']['remove_border'] ? 'border-width: 0' : '';
   if (!$this->Ini->Export_html_zip && !$this->Ini->Export_det_zip && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['det_print'] == "print")
   {
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
       $nm_saida->saida("  <body id=\"grid_detail\" class=\"scGridPage\"  style=\"-webkit-print-color-adjust: exact;" . $removeMargin . "\">\r\n");
       $nm_saida->saida("   <TABLE id=\"sc_table_print\" cellspacing=0 cellpadding=0 align=\"center\" valign=\"top\" >\r\n");
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("       <TD>\r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "prit_web_page()", "prit_web_page()", "Bprint_print", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + P)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("           $Cod_Btn \r\n");
       $nm_saida->saida("       </TD>\r\n");
       $nm_saida->saida("     </TR>\r\n");
       $nm_saida->saida("   </TABLE>\r\n");
       $nm_saida->saida("  <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("     function prit_web_page()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        document.getElementById('sc_table_print').style.display = 'none';\r\n");
       $nm_saida->saida("        var is_safari = navigator.userAgent.indexOf(\"Safari\") > -1;\r\n");
       $nm_saida->saida("        var is_chrome = navigator.userAgent.indexOf('Chrome') > -1\r\n");
       $nm_saida->saida("        if ((is_chrome) && (is_safari)) {is_safari=false;}\r\n");
       $nm_saida->saida("        window.print();\r\n");
       $nm_saida->saida("        if (is_safari) {setTimeout(\"window.close()\", 1000);} else {window.close();}\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("  </script>\r\n");
   }
   else
   {
       $nm_saida->saida("  <body id=\"grid_detail\" class=\"scGridPage\" style=\"" . $removeMargin . "\">\r\n");
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['cmp_acum']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['cmp_acum']))
   {
       $parms_acum = explode(";", $_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['cmp_acum']);
       foreach ($parms_acum as $cada_par)
       {
          $cada_val = explode("=", $cada_par);
          $this->$cada_val[0] = $cada_val[1];
       }
   }
   $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
           $nm_saida->saida("  <div id=\"id_div_process\" style=\"display: none; margin: 10px; whitespace: nowrap\" class=\"scFormProcessFixed\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_div_process_block\" style=\"display: none; margin: 10px; whitespace: nowrap\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
   $nm_saida->saida("<table border=0 align=\"center\" valign=\"top\" ><tr><td style=\"padding: 0px\"><div class=\"scGridBorder\" style=\"" . $removeBorder . "\"><table width='100%' cellspacing=0 cellpadding=0><tr><td>\r\n");
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['link_info']['compact_mode']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['link_info']['compact_mode']) {
   $nm_saida->saida("<tr><td class=\"scGridTabelaTd scGridPage\">\r\n");
   $nm_saida->saida("<style>\r\n");
   $nm_saida->saida("    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}\r\n");
   $nm_saida->saida("</style>\r\n");
   $nm_saida->saida("<div class=\"scGridHeader\" style=\"height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;\">\r\n");
   $nm_saida->saida("    <div class=\"scGridHeaderFont\" style=\"float: left; text-transform: uppercase;\"></div>\r\n");
   $nm_saida->saida("    <div class=\"scGridHeaderFont\" style=\"float: right;\"></div>\r\n");
   $nm_saida->saida("</div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   $nm_saida->saida(" </TR>\r\n");
   }
   if(isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
   {
       $this->nmgp_barra_det_top_mobile();
   }
   else
   {
       $this->nmgp_barra_det_top_normal();
   }
   $nm_saida->saida("<tr><td class=\"scGridTabelaTd\" id='idDetailTable'>\r\n");
   $nm_saida->saida("<TABLE style=\"padding: 0px; spacing: 0px; border-width: 0px;\" class=\"scGridTabela sc-grid-detail\" align=\"center\" valign=\"top\" width=\"100%\">\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "";
   }
   else
   {
       $this->SC_nowrap = "";
   }
   $SC_Label = (isset($this->New_label['colaborador'])) ? $this->New_label['colaborador'] : "COLABORADOR"; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = trim(NM_encode_input(sc_strip_script($this->colaborador)));
       $conteudo_original =  NM_encode_input(sc_strip_script($conteudo)); 
   }
   else {
       $conteudo = trim(sc_strip_script($this->colaborador)); 
       $conteudo_original = $conteudo; 
   }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'colaborador', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'colaborador', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_colaborador_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_colaborador_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_colaborador\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "";
   }
   else
   {
       $this->SC_nowrap = "";
   }
   $SC_Label = (isset($this->New_label['desc_falta'])) ? $this->New_label['desc_falta'] : "DESC FALTA"; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = trim(NM_encode_input(sc_strip_script($this->desc_falta)));
       $conteudo_original =  NM_encode_input(sc_strip_script($conteudo)); 
   }
   else {
       $conteudo = trim(sc_strip_script($this->desc_falta)); 
       $conteudo_original = $conteudo; 
   }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'desc_falta', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'desc_falta', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_desc_falta_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_desc_falta_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_desc_falta\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "NOWRAP";
   }
   else
   {
       $this->SC_nowrap = "NOWRAP";
   }
   $SC_Label = (isset($this->New_label['fecha_falta'])) ? $this->New_label['fecha_falta'] : "FECHA FALTA"; 
   $conteudo = trim(NM_encode_input(sc_strip_script($this->fecha_falta))); 
   $conteudo_original = $conteudo; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
               if (substr($conteudo, 10, 1) == "-") 
               { 
                  $conteudo = substr($conteudo, 0, 10) . " " . substr($conteudo, 11);
               } 
               if (substr($conteudo, 13, 1) == ".") 
               { 
                  $conteudo = substr($conteudo, 0, 13) . ":" . substr($conteudo, 14, 2) . ":" . substr($conteudo, 17);
               } 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD HH:II:SS");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
               } 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'fecha_falta', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'fecha_falta', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fecha_falta_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_fecha_falta_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_fecha_falta\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "";
   }
   else
   {
       $this->SC_nowrap = "";
   }
   $SC_Label = (isset($this->New_label['usuario_registro'])) ? $this->New_label['usuario_registro'] : "USUARIO REGISTRO"; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = trim(NM_encode_input(sc_strip_script($this->usuario_registro)));
       $conteudo_original =  NM_encode_input(sc_strip_script($conteudo)); 
   }
   else {
       $conteudo = trim(sc_strip_script($this->usuario_registro)); 
       $conteudo_original = $conteudo; 
   }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'usuario_registro', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'usuario_registro', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_usuario_registro_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_usuario_registro_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_usuario_registro\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "";
   }
   else
   {
       $this->SC_nowrap = "";
   }
   $SC_Label = (isset($this->New_label['perfil_r'])) ? $this->New_label['perfil_r'] : "PERFIL R"; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = trim(NM_encode_input(sc_strip_script($this->perfil_r)));
       $conteudo_original =  NM_encode_input(sc_strip_script($conteudo)); 
   }
   else {
       $conteudo = trim(sc_strip_script($this->perfil_r)); 
       $conteudo_original = $conteudo; 
   }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'perfil_r', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'perfil_r', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_perfil_r_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_perfil_r_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_perfil_r\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "NOWRAP";
   }
   else
   {
       $this->SC_nowrap = "NOWRAP";
   }
   $SC_Label = (isset($this->New_label['fecha_registro'])) ? $this->New_label['fecha_registro'] : "FECHA REGISTRO"; 
   $conteudo = trim(NM_encode_input(sc_strip_script($this->fecha_registro))); 
   $conteudo_original = $conteudo; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
               if (substr($conteudo, 10, 1) == "-") 
               { 
                  $conteudo = substr($conteudo, 0, 10) . " " . substr($conteudo, 11);
               } 
               if (substr($conteudo, 13, 1) == ".") 
               { 
                  $conteudo = substr($conteudo, 0, 13) . ":" . substr($conteudo, 14, 2) . ":" . substr($conteudo, 17);
               } 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD HH:II:SS");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
               } 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'fecha_registro', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'fecha_registro', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fecha_registro_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_fecha_registro_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_fecha_registro\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "";
   }
   else
   {
       $this->SC_nowrap = "";
   }
   $SC_Label = (isset($this->New_label['usuario_sancion'])) ? $this->New_label['usuario_sancion'] : "USUARIO SANCION"; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = trim(NM_encode_input(sc_strip_script($this->usuario_sancion)));
       $conteudo_original =  NM_encode_input(sc_strip_script($conteudo)); 
   }
   else {
       $conteudo = trim(sc_strip_script($this->usuario_sancion)); 
       $conteudo_original = $conteudo; 
   }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'usuario_sancion', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'usuario_sancion', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_usuario_sancion_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_usuario_sancion_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_usuario_sancion\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "";
   }
   else
   {
       $this->SC_nowrap = "";
   }
   $SC_Label = (isset($this->New_label['perfil_s'])) ? $this->New_label['perfil_s'] : "PERFIL S"; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = trim(NM_encode_input(sc_strip_script($this->perfil_s)));
       $conteudo_original =  NM_encode_input(sc_strip_script($conteudo)); 
   }
   else {
       $conteudo = trim(sc_strip_script($this->perfil_s)); 
       $conteudo_original = $conteudo; 
   }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'perfil_s', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'perfil_s', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_perfil_s_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_perfil_s_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_perfil_s\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "NOWRAP";
   }
   else
   {
       $this->SC_nowrap = "NOWRAP";
   }
   $SC_Label = (isset($this->New_label['fecha_sancion'])) ? $this->New_label['fecha_sancion'] : "FECHA SANCION"; 
   $conteudo = trim(NM_encode_input(sc_strip_script($this->fecha_sancion))); 
   $conteudo_original = $conteudo; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
               if (substr($conteudo, 10, 1) == "-") 
               { 
                  $conteudo = substr($conteudo, 0, 10) . " " . substr($conteudo, 11);
               } 
               if (substr($conteudo, 13, 1) == ".") 
               { 
                  $conteudo = substr($conteudo, 0, 13) . ":" . substr($conteudo, 14, 2) . ":" . substr($conteudo, 17);
               } 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD HH:II:SS");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
               } 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'fecha_sancion', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'fecha_sancion', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fecha_sancion_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_fecha_sancion_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_fecha_sancion\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "";
   }
   else
   {
       $this->SC_nowrap = "";
   }
   $SC_Label = (isset($this->New_label['tipo_falta_descripcion'])) ? $this->New_label['tipo_falta_descripcion'] : "TIPO FALTA DESCRIPCION"; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = trim(NM_encode_input(sc_strip_script($this->tipo_falta_descripcion)));
       $conteudo_original =  NM_encode_input(sc_strip_script($conteudo)); 
   }
   else {
       $conteudo = trim(sc_strip_script($this->tipo_falta_descripcion)); 
       $conteudo_original = $conteudo; 
   }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'tipo_falta_descripcion', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'tipo_falta_descripcion', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_tipo_falta_descripcion_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_tipo_falta_descripcion_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_tipo_falta_descripcion\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "";
   }
   else
   {
       $this->SC_nowrap = "";
   }
   $SC_Label = (isset($this->New_label['estado_sancion'])) ? $this->New_label['estado_sancion'] : "ESTADO SANCION"; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = trim(NM_encode_input(sc_strip_script($this->estado_sancion)));
       $conteudo_original =  NM_encode_input(sc_strip_script($conteudo)); 
   }
   else {
       $conteudo = trim(sc_strip_script($this->estado_sancion)); 
       $conteudo_original = $conteudo; 
   }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'estado_sancion', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'estado_sancion', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_estado_sancion_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_estado_sancion_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_estado_sancion\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "";
   }
   else
   {
       $this->SC_nowrap = "";
   }
   $SC_Label = (isset($this->New_label['tipo_sancion'])) ? $this->New_label['tipo_sancion'] : "TIPO SANCION"; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = trim(NM_encode_input(sc_strip_script($this->tipo_sancion)));
       $conteudo_original =  NM_encode_input(sc_strip_script($conteudo)); 
   }
   else {
       $conteudo = trim(sc_strip_script($this->tipo_sancion)); 
       $conteudo_original = $conteudo; 
   }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'tipo_sancion', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'tipo_sancion', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_tipo_sancion_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_tipo_sancion_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_tipo_sancion\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "";
   }
   else
   {
       $this->SC_nowrap = "";
   }
   $SC_Label = (isset($this->New_label['evidencia'])) ? $this->New_label['evidencia'] : "EVIDENCIA"; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = trim(NM_encode_input(sc_strip_script($this->evidencia)));
       $conteudo_original =  NM_encode_input(sc_strip_script($conteudo)); 
   }
   else {
       $conteudo = trim(sc_strip_script($this->evidencia)); 
       $conteudo_original = $conteudo; 
   }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'evidencia', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'evidencia', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_evidencia_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_evidencia_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_evidencia\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "";
   }
   else
   {
       $this->SC_nowrap = "";
   }
   $SC_Label = (isset($this->New_label['area'])) ? $this->New_label['area'] : "AREA"; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = trim(NM_encode_input(sc_strip_script($this->area)));
       $conteudo_original =  NM_encode_input(sc_strip_script($conteudo)); 
   }
   else {
       $conteudo = trim(sc_strip_script($this->area)); 
       $conteudo_original = $conteudo; 
   }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'area', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'area', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_area_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_area_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_area\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['opcao'] == "pdf")
   {
       $this->SC_nowrap = "NOWRAP";
   }
   else
   {
       $this->SC_nowrap = "NOWRAP";
   }
   $SC_Label = (isset($this->New_label['tiempo_transcurrido'])) ? $this->New_label['tiempo_transcurrido'] : "TIEMPO TRANSCURRIDO"; 
   $conteudo = trim(NM_encode_input(sc_strip_script($this->tiempo_transcurrido))); 
   $conteudo_original = $conteudo; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'tiempo_transcurrido', $str_tem_display); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'tiempo_transcurrido', $str_tem_display); 
          } 
              $conteudo = $str_tem_display; 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_tiempo_transcurrido_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_tiempo_transcurrido_det_line\"  " . $this->SC_nowrap . " ALIGN=\"\" VALIGN=\"\"><span id=\"id_sc_field_tiempo_transcurrido\">" . $conteudo . "</span></TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("</TABLE>\r\n");
   if(isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
   {
   }
   $rs->Close(); 
   if (!$_SESSION['scriptcase']['proc_mobile']) {
       $nm_saida->saida("  </td>\r\n");
       $nm_saida->saida(" </tr>\r\n");
       $nm_saida->saida(" </table>\r\n");
       $nm_saida->saida(" </div>\r\n");
       $nm_saida->saida("  </td>\r\n");
       $nm_saida->saida(" </tr>\r\n");
       $nm_saida->saida(" </table>\r\n");
   }
   if (!$_SESSION['scriptcase']['proc_mobile']) {
       $nm_saida->saida("  </td>\r\n");
       $nm_saida->saida(" </tr>\r\n");
       $nm_saida->saida(" </table>\r\n");
       $nm_saida->saida(" </div>\r\n");
       $nm_saida->saida("  </td>\r\n");
       $nm_saida->saida(" </tr>\r\n");
       $nm_saida->saida(" </table>\r\n");
   }
   if ($_SESSION['scriptcase']['proc_mobile']) {
       $nm_saida->saida("  </td>\r\n");
       $nm_saida->saida(" </tr>\r\n");
       $nm_saida->saida(" </table>\r\n");
       $nm_saida->saida(" </div>\r\n");
       $nm_saida->saida("  </td>\r\n");
       $nm_saida->saida(" </tr>\r\n");
       $nm_saida->saida(" </table>\r\n");
   }
//--- 
//--- 
   $nm_saida->saida("<form name=\"F3\" method=post\r\n");
   $nm_saida->saida("                  target=\"_self\"\r\n");
   $nm_saida->saida("                  action=\"./\">\r\n");
   $nm_saida->saida("<input type=hidden name=\"nmgp_opcao\" value=\"igual\"/>\r\n");
   $nm_saida->saida("<input type=hidden name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/>\r\n");
   $nm_saida->saida("</form>\r\n");
   $nm_saida->saida("<form name=\"F6\" method=\"post\" \r\n");
   $nm_saida->saida("                  action=\"./\" \r\n");
   $nm_saida->saida("                  target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida(" <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("</form> \r\n");
   $nm_saida->saida("<form name=\"Fprint\" method=\"post\" \r\n");
   $nm_saida->saida("                  action=\"grid_consulta_faltas_iframe_prt.php\" \r\n");
   $nm_saida->saida("                  target=\"jan_print\" style=\"display: none\"> \r\n");
   $nm_saida->saida(" <input type=\"hidden\" name=\"path_botoes\" value=\"" . $this->Ini->path_botoes . "\"/> \r\n");
   $nm_saida->saida(" <input type=\"hidden\" name=\"opcao\" value=\"det_print\"/>\r\n");
   $nm_saida->saida(" <input type=\"hidden\" name=\"nmgp_opcao\" value=\"det_print\"/>\r\n");
   $nm_saida->saida(" <input type=\"hidden\" name=\"cor_print\" value=\"CO\"/>\r\n");
   $nm_saida->saida(" <input type=\"hidden\" name=\"nmgp_cor_print\" value=\"CO\"/>\r\n");
   $nm_saida->saida(" <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
   $nm_saida->saida(" <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("</form> \r\n");
   $nm_saida->saida("  <form name=\"Fdet_pdf\" method=\"post\" target=\"_self\">\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"pdf_det\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tipo_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_graf_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"Det_use_pass_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"Det_pdf_zip\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . session_id() . "\"/> \r\n");
   $nm_saida->saida("  </form> \r\n");
   $nm_saida->saida("<script language=JavaScript>\r\n");
   $nm_saida->saida("   $(function(){ \r\n");
   $nm_saida->saida("       NM_btn_disable();\r\n");
   $nm_saida->saida("   }); \r\n");
   $nm_saida->saida("   function nm_submit_modal(parms, t_parent) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      if (t_parent == 'S' && typeof parent.tb_show == 'function')\r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("           parent.tb_show('', parms, '');\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("         tb_show('', parms, '');\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_move(tipo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F6.target = \"_self\"; \r\n");
   $nm_saida->saida("      document.F6.submit() ;\r\n");
   $nm_saida->saida("      return;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_mostra_doc(campo1)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (\"grid_consulta_faltas_doc.php?nmgp_parms=\" + campo1, \"_self\", \"resizable\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_move(x, y, z, p, g, crt, ajax, chart_level, page_break_pdf, SC_module_export, use_pass_pdf, pdf_all_cab, pdf_all_label, pdf_label_group, pdf_zip) \r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"pdf_det\" == x && \"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_consulta_faltas/grid_consulta_faltas_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=pdf_det&sAdd=__E__nmgp_tipo_pdf=\" + z + \"__E__sc_parms_pdf=\" + p + \"__E__sc_create_charts=\" + crt + \"__E__sc_graf_pdf=\" + g + \"__E__chart_level=\" + chart_level + \"__E__Det_use_pass_pdf=\" + use_pass_pdf + \"__E__Det_pdf_zip=\" + pdf_zip + \"&nm_opc=pdf_det&KeepThis=true&TB_iframe=true&modal=true\", '');\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fdet_pdf.nmgp_tipo_pdf.value = z;\r\n");
   $nm_saida->saida("           document.Fdet_pdf.nmgp_parms_pdf.value = p;\r\n");
   $nm_saida->saida("           document.Fdet_pdf.nmgp_graf_pdf.value = g;\r\n");
   $nm_saida->saida("           document.Fdet_pdf.Det_use_pass_pdf.value = use_pass_pdf;\r\n");
   $nm_saida->saida("           document.Fdet_pdf.Det_pdf_zip.value = pdf_zip;\r\n");
   $nm_saida->saida("           document.Fdet_pdf.action=\"index.php\";\r\n");
   $nm_saida->saida("           document.Fdet_pdf.submit();\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_print_conf(tp, cor, res_cons, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"D\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_consulta_faltas/grid_consulta_faltas_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_tipo_print=\" + tp + \"__E__nmgp_cor_print=\" + cor + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("          document.Fprint.nmgp_password.value = password;\r\n");
   $nm_saida->saida("          document.Fprint.cor_print.value = cor;\r\n");
   $nm_saida->saida("          document.Fprint.nmgp_cor_print.value = cor;\r\n");
   $nm_saida->saida("          if (password != \"\")\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              document.Fprint.action=\"./\";\r\n");
   $nm_saida->saida("              document.Fprint.target=\"_self\";\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          else\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              window.open('','jan_print','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          document.Fprint.submit() ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function process_hotkeys(hotkey)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("   return false;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function NM_btn_disable()\r\n");
   $nm_saida->saida("   {\r\n");
   foreach ($this->nm_btn_disabled as $cod_btn => $st_btn) {
      if (isset($this->nm_btn_exist[$cod_btn]) && $st_btn == 'on') {
         foreach ($this->nm_btn_exist[$cod_btn] as $cada_id) {
           $nm_saida->saida("     $('#" . $cada_id . "').prop('onclick', null).off('click').addClass('disabled').removeAttr('href');\r\n");
         }
      }
   }
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("</script>\r\n");
   $nm_saida->saida("</body>\r\n");
   $nm_saida->saida("</html>\r\n");
 }
   function nmgp_barra_det_top_normal()
   {
      global $nm_saida;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['det_print'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['pdf_det']) 
   { 
       $nm_saida->saida("   <tr  id=\"obj_barra_top\"><td class=\"scGridTabelaTd\">\r\n");
       $nm_saida->saida("    <table class=\"scGridToolbar\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" valign=\"top\" width=\"100%\"><tr>\r\n");
       $nm_saida->saida("     <td class=\"scGridToolbarPadding\" nowrap valign=\"middle\" align=\"left\" width=\"33%\">\r\n");
       $nm_saida->saida("         </td> \r\n");
       $nm_saida->saida("          <td class=\"scGridToolbarPadding\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
       if ($this->nmgp_botoes['det_pdf'] == "on")
       {
         $this->nm_btn_exist['det_pdf'][] = "Dpdf_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "Dpdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_consulta_faltas/grid_consulta_faltas_config_pdf.php?nm_opc=pdf_det&nm_target=0&nm_cor=cor&papel=8&orientacao=1&largura=1200&conf_larg=S&conf_fonte=10&language=es&conf_socor=N&sc_ver_93=s&password=n&pdf_zip=N&KeepThis=false&TB_iframe=true&modal=true", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
       }
       if ($this->nmgp_botoes['det_print'] == "on")
       {
         $this->nm_btn_exist['det_print'][] = "Dprint_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "Dprint_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_consulta_faltas/grid_consulta_faltas_config_print.php?nm_opc=detalhe&nm_cor=CO&password=n&language=es&KeepThis=true&TB_iframe=true&modal=true", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
       }
         $this->nm_btn_exist['det_exit'][] = "sc_b_sai_top";
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.F3.submit();", "document.F3.submit();", "sc_b_sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       if ($_SESSION['scriptcase']['proc_mobile']) {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsair", "self.parent.tb_remove();", "self.parent.tb_remove();", "sc_b_sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       }
       $nm_saida->saida("           $Cod_Btn \r\n");
       $nm_saida->saida("         </td> \r\n");
       $nm_saida->saida("          <td class=\"scGridToolbarPadding\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
       $nm_saida->saida("     </td>\r\n");
       $nm_saida->saida("    </tr></table>\r\n");
       $nm_saida->saida("   </td></tr>\r\n");
   } 
   }
   function nmgp_barra_det_top_mobile()
   {
      global $nm_saida;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['det_print'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_consulta_faltas']['pdf_det']) 
   { 
       $nm_saida->saida("   <tr  id=\"obj_barra_top\"><td class=\"scGridTabelaTd\">\r\n");
       $nm_saida->saida("    <table class=\"scGridToolbar\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" valign=\"top\" width=\"100%\"><tr>\r\n");
       $nm_saida->saida("     <td class=\"scGridToolbarPadding\" nowrap valign=\"middle\" align=\"left\" width=\"33%\">\r\n");
       if ($this->nmgp_botoes['det_pdf'] == "on")
       {
         $this->nm_btn_exist['det_pdf'][] = "Dpdf_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "Dpdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_consulta_faltas/grid_consulta_faltas_config_pdf.php?nm_opc=pdf_det&nm_target=0&nm_cor=cor&papel=8&orientacao=1&largura=1200&conf_larg=S&conf_fonte=10&language=es&conf_socor=N&sc_ver_93=s&password=n&pdf_zip=N&KeepThis=false&TB_iframe=true&modal=true", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
       }
       if ($this->nmgp_botoes['det_print'] == "on")
       {
         $this->nm_btn_exist['det_print'][] = "Dprint_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "Dprint_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_consulta_faltas/grid_consulta_faltas_config_print.php?nm_opc=detalhe&nm_cor=CO&password=n&language=es&KeepThis=true&TB_iframe=true&modal=true", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
       }
         $this->nm_btn_exist['det_exit'][] = "sc_b_sai_top";
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.F3.submit();", "document.F3.submit();", "sc_b_sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       if ($_SESSION['scriptcase']['proc_mobile']) {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsair", "self.parent.tb_remove();", "self.parent.tb_remove();", "sc_b_sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       }
       $nm_saida->saida("           $Cod_Btn \r\n");
       $nm_saida->saida("     </td>\r\n");
       $nm_saida->saida("    </tr></table>\r\n");
       $nm_saida->saida("   </td></tr>\r\n");
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
}
