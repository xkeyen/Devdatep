<?php

class grid_agenda_cliente_resumo
{
    const GROUPBY_ORIGINAL = 1;
    const GROUPBY_COMPARISON = 2;
    const GROUPBY_PERC_CHANGE = 3;
    const TOTAL_ARRAY_LABEL_INDEX = 3;
    const TOTAL_ARRAY_VALUE_INDEX = 4;

   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $total;
   var $tipo;
   var $nm_data;
   var $NM_res_sem_reg;
   var $NM_export;
   var $prim_linha;
   var $que_linha;
   var $css_line_back; 
   var $css_line_fonf; 
   var $comando_grafico;
   var $resumo_campos;
   var $nm_location;
   var $Print_All;
   var $NM_raiz_img; 
   var $NM_tit_val; 
   var $NM_totaliz_hrz; 
   var $link_graph_tot; 
   var $Tot_ger; 
   var $nmgp_botoes     = array();
   var $nm_btn_exist    = array();
   var $nm_btn_label    = array(); 
   var $nm_btn_disabled = array();
   var $array_total_fecha_inicial;
   var $array_total_fecha_inicial_scgb_41;
   var $array_total_geral;
   var $array_tot_lin;
   var $array_final;
   var $array_links;
   var $array_links_tit;
   var $array_export;
   var $quant_colunas;
   var $conv_col;
   var $count_ger;
   var $sum_valor_total;
   var $cnt_estado_actual;
   var $sc_proc_quebra_fecha_inicial;
   var $count_fecha_inicial;
   var $sum_fecha_inicial_valor_total;
   var $cnt_fecha_inicial_estado_actual;
   var $sc_proc_quebra_fecha_inicial_scgb_41;
   var $count_fecha_inicial_scgb_41;
   var $sum_fecha_inicial_scgb_41_valor_total;
   var $cnt_fecha_inicial_scgb_41_estado_actual;

   //---- 
   function __construct($tipo = "")
   {
      $this->Graf_left_dat   = true;
      $this->Graf_left_tot   = true;
      $this->NM_export       = false;
      $this->NM_totaliz_hrz  = false;
      $this->link_graph_tot  = array();
      $this->proc_res_grid   = false;
      $this->array_final     = array();
      $this->array_links     = array();
      $this->array_links_tit = array();
      $this->array_export    = array();
      $this->resumo_campos                     = array();
      $this->comando_grafico                   = array();
      $this->array_total_fecha_inicial         = array();
      $this->array_total_fecha_inicial_scgb_41 = array();
      $this->array_general_total = array();
      $this->nm_data = new nm_data("es");
      if ("" != $tipo && "out" == strtolower($tipo))
      {
         $this->NM_tipo = "out";
      }
      else
      {
         $this->NM_tipo = "pag";
      }
   }

   //---- 
   function initializeButtons()
   {
      $this->nmgp_botoes['group_1'] = "on";
      $this->nmgp_botoes['group_2'] = "on";
      $this->nmgp_botoes['group_3'] = "on";
      $this->nmgp_botoes['group_4'] = "on";
      $this->nmgp_botoes['pdf'] = "on";
      $this->nmgp_botoes['word'] = "on";
      $this->nmgp_botoes['xls'] = "on";
      $this->nmgp_botoes['xml'] = "on";
      $this->nmgp_botoes['json'] = "on";
      $this->nmgp_botoes['csv'] = "on";
      $this->nmgp_botoes['rtf'] = "on";
      $this->nmgp_botoes['imp'] = "on";
      $this->nmgp_botoes['email_pdf'] = "on";
      $this->nmgp_botoes['email_doc'] = "on";
      $this->nmgp_botoes['email_xls'] = "on";
      $this->nmgp_botoes['email_xml'] = "on";
      $this->nmgp_botoes['email_json'] = "on";
      $this->nmgp_botoes['email_csv'] = "on";
      $this->nmgp_botoes['email_rtf'] = "on";
      $this->nmgp_botoes['pdf'] = "on";
      $this->nmgp_botoes['word'] = "on";
      $this->nmgp_botoes['doc'] = "on";
      $this->nmgp_botoes['xls'] = "on";
      $this->nmgp_botoes['xml'] = "on";
      $this->nmgp_botoes['json'] = "on";
      $this->nmgp_botoes['csv'] = "on";
      $this->nmgp_botoes['rtf'] = "on";
      $this->nmgp_botoes['print'] = "on";
      $this->nmgp_botoes['html'] = "on";
      $this->nmgp_botoes['pdf'] = "on";
      $this->nmgp_botoes['word'] = "on";
      $this->nmgp_botoes['doc'] = "on";
      $this->nmgp_botoes['xls'] = "on";
      $this->nmgp_botoes['xml'] = "on";
      $this->nmgp_botoes['json'] = "on";
      $this->nmgp_botoes['csv'] = "on";
      $this->nmgp_botoes['rtf'] = "on";
      $this->nmgp_botoes['chart_conf'] = "on";
      $this->nmgp_botoes['chart_settings'] = "on";
      $this->nmgp_botoes['groupby'] = "on";
      $this->nmgp_botoes['chart_detail'] = "on";
      $this->nmgp_botoes['gridsave'] = "on";
      $this->nmgp_botoes['gridsavesession'] = "on";
      $this->nmgp_botoes['reload'] = "on";
      $this->nmgp_botoes['chart_exit'] = "on";

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['grid_agenda_cliente'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['grid_agenda_cliente'];

              $this->nmgp_botoes['first']          = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['back']           = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['last']           = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['forward']        = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['summary']        = $tmpDashboardButtons['grid_summary']   ? 'on' : 'off';
              $this->nmgp_botoes['qsearch']        = $tmpDashboardButtons['grid_qsearch']   ? 'on' : 'off';
              $this->nmgp_botoes['dynsearch']      = $tmpDashboardButtons['grid_dynsearch'] ? 'on' : 'off';
              $this->nmgp_botoes['filter']         = $tmpDashboardButtons['grid_filter']    ? 'on' : 'off';
              $this->nmgp_botoes['sel_col']        = $tmpDashboardButtons['grid_sel_col']   ? 'on' : 'off';
              $this->nmgp_botoes['sort_col']       = $tmpDashboardButtons['grid_sort_col']  ? 'on' : 'off';
              $this->nmgp_botoes['goto']           = $tmpDashboardButtons['grid_goto']      ? 'on' : 'off';
              $this->nmgp_botoes['qtline']         = $tmpDashboardButtons['grid_lineqty']   ? 'on' : 'off';
              $this->nmgp_botoes['navpage']        = $tmpDashboardButtons['grid_navpage']   ? 'on' : 'off';
              $this->nmgp_botoes['pdf']            = $tmpDashboardButtons['grid_pdf']       ? 'on' : 'off';
              $this->nmgp_botoes['xls']            = $tmpDashboardButtons['grid_xls']       ? 'on' : 'off';
              $this->nmgp_botoes['xml']            = $tmpDashboardButtons['grid_xml']       ? 'on' : 'off';
              $this->nmgp_botoes['json']           = $tmpDashboardButtons['grid_json']      ? 'on' : 'off';
              $this->nmgp_botoes['csv']            = $tmpDashboardButtons['grid_csv']       ? 'on' : 'off';
              $this->nmgp_botoes['rtf']            = $tmpDashboardButtons['grid_rtf']       ? 'on' : 'off';
              $this->nmgp_botoes['word']           = $tmpDashboardButtons['grid_word']      ? 'on' : 'off';
              $this->nmgp_botoes['print']          = $tmpDashboardButtons['grid_print']     ? 'on' : 'off';
              $this->nmgp_botoes['chart_conf']     = $tmpDashboardButtons['chart_conf']     ? 'on' : 'off';
              $this->nmgp_botoes['chart_settings'] = $tmpDashboardButtons['chart_settings'] ? 'on' : 'off';
              $this->nmgp_botoes['groupby']        = $tmpDashboardButtons['sel_groupby']    ? 'on' : 'off';
              $this->nmgp_botoes['chart_detail']   = $tmpDashboardButtons['chart_detail']   ? 'on' : 'off';
              $this->nmgp_botoes['new']            = $tmpDashboardButtons['grid_new']       ? 'on' : 'off';
              $this->nmgp_botoes['reload']         = $tmpDashboardButtons['grid_reload']    ? 'on' : 'off';
          }
      }

   if ($this->Ini->Embutida_iframe) {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['sub_cons_iframe_btns'] as $BTN => $BTN_opc) {
           $this->nmgp_botoes[$BTN] = $BTN_opc;
       }
   }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_agenda_cliente']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_agenda_cliente']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_agenda_cliente']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }
   }

    function info_initializeSummary()
    {
        $this->info_performInitializeActions();
        $this->info_initializeInfo();
        $this->info_initializeData();
        $this->info_loadProcessInfo();
        $this->info_saveSessionDefaultInfo();
        $this->info_loadSessionInfo();
        $this->info_processData();
        $this->info_changeSort();
        $this->info_changePagination();
    }

    function info_processSummary()
    {
        $this->info_orderAxys();
        $this->info_setPagination();
        $this->info_setComparisonLabels();
    }

    function info_performInitializeActions()
    {
        if ($this->aux_isPdf()) {
            @set_time_limit(0);
        }
    }

    function info_initializeInfo()
    {
        $this->SC_APP_info = [
            'group_by' => [
                'dimension' => [
                    'x' => [
                    ],
                    'y' => [
                        'fecha_inicial',
                        'fecha_inicial_scgb_41',
                    ],
                    'order' => [
                        'fecha_inicial',
                        'fecha_inicial_scgb_41',
                    ],
                    'unselected' => [
                    ],
                ],
                'metric' => [
                    'valor_total-S',
                    'estado_actual-C',
                ],
            ],
            'dimension' => [
                'fecha_inicial' => [
                    'label' => sprintf("" . $this->Ini->Nm_lang['lang_othr_cons_title_YYYY'] . "", "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_inicial'] . ""),
                    'datatype' => 'date',
                    'lowercase' => 'fecha_inicial',
                    'summary_values_array' => 'array_total_fecha_inicial',
                    'summary_line_values_array' => 'array_line_fecha_inicial',
                    'order_by_index' => self::TOTAL_ARRAY_VALUE_INDEX,
                    'order_by_direction' => 'asc',
                    'order_by_direction_default' => 'asc',
                    'is_rating' => '' != '',
                    'rating_function' => '',
                    'fill_empty_axys' => true,
                    'align_css_class' => '',
                    'show_link' => true,
                    'link_field_var_name' => 'fecha_inicial',
                    'link_protect_string' => '@aspass@',
                    'has_order' => true,
                    'limit_chart_items' => '0',
                ],
                'fecha_inicial_scgb_41' => [
                    'label' => sprintf("" . $this->Ini->Nm_lang['lang_othr_cons_title_SEMIANNUAL'] . "", "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_inicial'] . ""),
                    'datatype' => 'date',
                    'lowercase' => 'fecha_inicial_scgb_41',
                    'summary_values_array' => 'array_total_fecha_inicial_scgb_41',
                    'summary_line_values_array' => 'array_line_fecha_inicial_scgb_41',
                    'order_by_index' => self::TOTAL_ARRAY_VALUE_INDEX,
                    'order_by_direction' => 'asc',
                    'order_by_direction_default' => 'asc',
                    'is_rating' => '' != '',
                    'rating_function' => '',
                    'fill_empty_axys' => true,
                    'align_css_class' => '',
                    'show_link' => true,
                    'link_field_var_name' => 'fecha_inicial_scgb_41',
                    'link_protect_string' => '@aspass@',
                    'has_order' => true,
                    'limit_chart_items' => '0',
                ],
            ],
            'metric' => [
                'valor_total-S' => [
                    'label' => "" .  $this->Ini->Nm_lang['lang_agenda_fld_valor_total'] . " (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . ")",
                    'label_justify_content' => "flex-end",
                    'value_index' => 1,
                    'is_rating' => '' != '',
                    'rating_function' => '',
                    'format_function' => 'aux_format_valor_total_S',
                    'css_class' => "css_valor_total_sum_field",
                    'show_percentuals' => false,
                    'show_percentuals_below' => false,
                    'has_order' => true,
                ],
                'estado_actual-C' => [
                    'label' => "" .  $this->Ini->Nm_lang['lang_agenda_fld_estado_actual'] . " (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_cnt'] . ")",
                    'label_justify_content' => "flex-end",
                    'value_index' => 2,
                    'is_rating' => '' != '',
                    'rating_function' => '',
                    'format_function' => 'aux_format_estado_actual_C',
                    'css_class' => "css_estado_actual_cnt_field",
                    'show_percentuals' => false,
                    'show_percentuals_below' => false,
                    'has_order' => true,
                ],
            ],
            'dimension_by_lowercase' => [
                'fecha_inicial' => 'fecha_inicial',
                'fecha_inicial_scgb_41' => 'fecha_inicial_scgb_41',
            ],
            'metric_by_index' => [
                2 => 'valor_total-S',
                3 => 'estado_actual-C',
            ],
            'chart' => [
                'fecha_inicial' => [
                    'valor_total-S' => [
                        'has_chart' => true, 
                    ],
                    'estado_actual-C' => [
                        'has_chart' => true, 
                    ],
                ],
                'fecha_inicial_scgb_41' => [
                    'valor_total-S' => [
                        'has_chart' => true, 
                    ],
                    'estado_actual-C' => [
                        'has_chart' => true, 
                    ],
                ],
            ],
            'options' => [
                'chart_create_time' => 150,
                'chart_icon_position_data' => 'left',
                'chart_icon_position_total' => 'left',
                'chart_has_analytical' => true,
                'chart_new_page' => true,
                'comparison_change_positive_color' => '#080',
                'comparison_change_negative_color' => '#C00',
                'comparison_change_positive_icon' => 'fas fa-long-arrow-alt-up',
                'comparison_change_negative_icon' => 'fas fa-long-arrow-alt-down',
                'display_abbreviated_value' => false,
                'display_inline_chart' => false,
                'display_label_on_total' => true,
                'display_seq' => true,
                'display_summary_every_page' => false,
                'display_summary_label' => "{$this->Ini->Nm_lang['lang_othr_smry_info']}",
                'display_summary_total' => 'last_page',
                'display_total_column' => true,
                'display_total_row' => true,
                'display_total_top' => false,
                'has_limit_chart_items' => true,
                'has_summary_button' => false,
                'order_initial_metric' => '',
                'order_initial_rule' => '',
                'order_metric_apply_to_dimensions' => ['fecha_inicial', 'fecha_inicial_scgb_41'],
                'starting_group_by' => false,
                'show_percentuals' => false,
                'tabular' => true,
                'use_fontawesome_order_icons' => true,
                'use_pagination' => false,
            ],
            'css' => [
                'mobile_inner_control' => 'sc-mobile-inner-control',
                'summary_container' => 'scGridTabelaTd',
                'summary_table' => 'scGridTabela',
                'header_row' => 'sc-ui-summary-header-row',
                'header_cell' => 'scGridSummaryLabel',
                'data_row' => 'scGridSummaryLine',
                'data_seq' => 'scGridSummaryGroupbySeq',
                'data_visible' => 'scGridSummaryGroupbyVisible',                
                'data_hover' => 'scGridSummaryGroupbyInvisible',
                'data_hover_display' => 'scGridSummaryGroupbyInvisibleDisplay',                
                'data_subtotal' => 'scGridSummarySubtotal',
                'data_total' => 'scGridSummaryTotal',
                'data_odd' => 'scGridSummaryLineOdd',
                'data_even' => 'scGridSummaryLineEven',
                'data_odd_grid' => 'scGridFieldOdd',
                'summary_line' => 'scGridTotal',
                'summary_font' => 'scGridTotalFont',
                'fixed_column_title' => '',
                'fixed_column_op' => '',
                'fixed_column_op_seq' => '',
                'fixed_column_field' => '',
                'fixed_column_is_fixed' => '',
                'fixed_column_pin_fix' => '',
                'fixed_column_pin_not_fixed' => '',
                'fixed_fa_pin' => 'fas fa-thumbtack',
                'sort_dimension' => 'sc-ui-sort-dimension',
                'sort_metric' => 'sc-ui-sort-metric',
                'comparison_label' => 'sc-comparison-label',
                'comparison_color_down' => 'sc-comparison-color-down',
                'comparison_color_up' => 'sc-comparison-color-up',
                'percentage_dimension' => 'sc-summary-metric-percentage',
                'valign_top' => 'sc-valign-top',
            ],
        ];

        if (is_file('../_lib/css/' . $this->Ini->str_schema_all . '_grid.php')) {
            include('../_lib/css/' . $this->Ini->str_schema_all . '_grid.php');

            if (isset($css_grid_smry_colorpos) && !empty($css_grid_smry_colorpos)) {
                $this->SC_APP_info['options'] ['comparison_change_positive_color'] = $css_grid_smry_colorpos;
            }
            if (isset($css_grid_smry_colorneg) && !empty($css_grid_smry_colorneg)) {
                $this->SC_APP_info['options'] ['comparison_change_negative_color'] = $css_grid_smry_colorneg;
            }
            if (isset($css_grid_smry_iconpos) && !empty($css_grid_smry_iconpos)) {
                $this->SC_APP_info['options'] ['comparison_change_positive_icon'] = $css_grid_smry_iconpos;
            }
            if (isset($css_grid_smry_iconneg) && !empty($css_grid_smry_iconneg)) {
                $this->SC_APP_info['options'] ['comparison_change_negative_icon'] = $css_grid_smry_iconneg;
            }
        }
    }

    function info_initializeData()
    {
        $this->SC_APP_data = [
            'line_count' => 1,
            'css_line_count' => 1,
            'fixed_col_count' => 0,
            'dimension_count' => [
                'x' => 0,
                'y' => 0
            ],
            'metric_count' => 0,
            'comparison_labels' => [
                'comparison_field' => '',
                self::GROUPBY_ORIGINAL => '',
                self::GROUPBY_COMPARISON => '',
                self::GROUPBY_PERC_CHANGE => ''
            ],
            'pagination' => [
                'page' => 1,
                'length' => 10,
                'page_count' => 1,
                'first' => 1,
                'last'=> 0,
                'back' => 0,
                'forward' => 0,
                'record_count' => 0,
                'page_link_count' => 5,
                'page_link_first' => '',
                'page_link_last' => '',
                'page_link_actual' => '',
                'page_link_list' => '',
                'page_link_html' => '',
                'page_navigation_description' => '',
            ],
            'metric_order' => [
                'using' => false,
                'name' => '',
                'rule' => '',
                'parameters' => [],
            ],
            'process' => [
                'is_process' => false,
                'option' => '',
                'parameters' => [],
            ],
            'dimension_label_rowspan' => '',
            'dimension_last_value' => [],
            'dimension_value_labels' => [
                'fecha_inicial' => [],
                'fecha_inicial_scgb_41' => [],
            ],
            'ordered_x_axys' => [],
            'ordered_y_axys' => [],
            'ordered_x_matrix' => [],
            'ordered_y_matrix' => [],
            'chart_md5_initial' => '',
            'chart_md5_list' => [],
        ];
    }

    function info_loadProcessInfo()
    {
        if (isset($_POST['nmgp_opcao']) && 'ajax_navigate' == $_POST['nmgp_opcao'] && isset($_POST['opc']) && 'resumo' == $_POST['opc']) {
            $this->SC_APP_data['process'] ['is_process'] = true;

            $parameterList = explode('*scout', $_POST['parm']);
            foreach ($parameterList as $parameterString) {
                $parameterInfo = explode('*scin', $parameterString);
                if (isset($parameterInfo[1])) {
                    $this->SC_APP_data['process'] ['parameters'] [ $parameterInfo[0] ] = $parameterInfo[1];
                }

            }

            if (isset($this->SC_APP_data['process'] ['parameters'] ['change_dimension_sort']) && 'Y' == $this->SC_APP_data['process'] ['parameters'] ['change_dimension_sort']) {
                $this->SC_APP_data['process'] ['option'] = 'change_dimension_sort';
            } elseif (isset($this->SC_APP_data['process'] ['parameters'] ['change_metric_sort']) && 'Y' == $this->SC_APP_data['process'] ['parameters'] ['change_metric_sort']) {
                $this->SC_APP_data['process'] ['option'] = 'change_metric_sort';
            } elseif (isset($this->SC_APP_data['process'] ['parameters'] ['change_length_pagination']) && 'Y' == $this->SC_APP_data['process'] ['parameters'] ['change_length_pagination']) {
                $this->SC_APP_data['process'] ['option'] = 'change_length_pagination';
            } elseif (isset($this->SC_APP_data['process'] ['parameters'] ['change_page_pagination']) && 'Y' == $this->SC_APP_data['process'] ['parameters'] ['change_page_pagination']) {
                $this->SC_APP_data['process'] ['option'] = 'change_page_pagination';
            } elseif (isset($this->SC_APP_data['process'] ['parameters'] ['change_record_pagination']) && 'Y' == $this->SC_APP_data['process'] ['parameters'] ['change_record_pagination']) {
                $this->SC_APP_data['process'] ['option'] = 'change_record_pagination';
            }
        }
    }

    function info_saveSessionDefaultInfo()
    {
        if (!isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['last_displayed_group_by'])) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['last_displayed_group_by'] = 'ag_estado';
            $this->SC_APP_info['options'] ['starting_group_by'] = true;
        }
        if ('ag_estado' != $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['last_displayed_group_by']) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['last_displayed_group_by'] = 'ag_estado';
            $this->SC_APP_info['options'] ['starting_group_by'] = true;
        }

        if (!isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_x_axys'])) {
            $this->info_deleteSummaryCache();

            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_group_by'] = [];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_order'] = [];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_x_axys'] = [];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_y_axys'] = [];

            $dimensionCount = 0;

            foreach ($this->SC_APP_info['group_by'] ['dimension'] ['x'] as $dimensionName) {
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_group_by'] [] = $this->SC_APP_info['dimension'] [$dimensionName] ['label'];
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_order'] [] = self::TOTAL_ARRAY_LABEL_INDEX == $this->SC_APP_info['dimension'] [$dimensionName] ['order_by_index'] ? 'label' : 'value';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_order_direction'] [] = $this->SC_APP_info['dimension'] [$dimensionName] ['order_by_direction'];
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_x_axys'] [] = $dimensionCount;

                $dimensionCount++;
            }

            foreach ($this->SC_APP_info['group_by'] ['dimension'] ['y'] as $dimensionName) {
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_group_by'] [] = $this->SC_APP_info['dimension'] [$dimensionName] ['label'];
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_order'] [] = self::TOTAL_ARRAY_LABEL_INDEX == $this->SC_APP_info['dimension'] [$dimensionName] ['order_by_index'] ? 'label' : 'value';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_y_axys'] [] = $dimensionCount;

                $dimensionCount++;
            }

            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['dimension_order'] = [];
            foreach ($this->SC_APP_info['dimension'] as $dimensionName => $dimensionInfo) {
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['dimension_order'] [$dimensionName] = $dimensionInfo['order_by_direction'];
            }
        }

        if (!isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_using'])) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_using'] = false;
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_name'] = '';
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_rule'] = '';
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_parameters'] = [];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_info'] = [];
        }

        if (!isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pagination_length'])) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pagination_length'] = $this->SC_APP_data['pagination'] ['length'];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pagination_first'] = $this->SC_APP_data['pagination'] ['first'];
        }

        if (!isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['chart_info'])) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['chart_info'] = [];
        }

        if (!isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_tabular'])) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_tabular'] = $this->SC_APP_info['options'] ['tabular'];
        }

        if ($this->SC_APP_info['options'] ['starting_group_by']) {
            if ('' != $this->SC_APP_info['options'] ['order_initial_metric'] && '' != $this->SC_APP_info['options'] ['order_initial_rule'] && !$this->aux_hasXAxysDimensionField()) {
                $this->SC_APP_data['metric_order'] ['using'] = true;
                $this->SC_APP_data['metric_order'] ['name'] = $this->SC_APP_info['options'] ['order_initial_metric'];
                $this->SC_APP_data['metric_order'] ['rule'] = $this->SC_APP_info['options'] ['order_initial_rule'];
                $this->SC_APP_data['metric_order'] ['parameters'] = [];

                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_using'] = true;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_name'] = $this->SC_APP_info['options'] ['order_initial_metric'];
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_rule'] = $this->SC_APP_info['options'] ['order_initial_rule'];
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_parameters'] = [];
            }

            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['has_limit_chart_items'] = $this->SC_APP_info['options'] ['has_limit_chart_items'];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['limit_chart_items'] = '0';
        }
    }

    function info_loadSessionInfo()
    {
        $this->SC_APP_info['group_by'] ['dimension'] ['x'] = [];
        $this->SC_APP_info['group_by'] ['dimension'] ['y'] = [];
        $this->SC_APP_info['group_by'] ['metric'] = [];

        foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_group_by'] as $dimensionIndex => $dimensionLabel) {
            $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['order'] [$dimensionIndex];

            $this->SC_APP_info['dimension'] [$dimensionName] ['order_by_index'] = 'label' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_order'] [$dimensionIndex] ? self::TOTAL_ARRAY_LABEL_INDEX : self::TOTAL_ARRAY_VALUE_INDEX;

            if (in_array($dimensionIndex, $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_x_axys'])) {
                $this->SC_APP_info['group_by'] ['dimension'] ['x'] [] = $dimensionName;
            }
            if (in_array($dimensionIndex, $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_y_axys'])) {
                $this->SC_APP_info['group_by'] ['dimension'] ['y'] [] = $dimensionName;
            }
        }

        $this->SC_APP_info['group_by'] ['dimension'] ['order'] = array_merge($this->SC_APP_info['group_by'] ['dimension'] ['x'], $this->SC_APP_info['group_by'] ['dimension'] ['y']);

        foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['summarizing_fields_order'] ['ag_estado'] as $metricIndex) {
            if ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['summarizing_fields_display'] ['ag_estado'] [$metricIndex] ['display']) {
                $this->SC_APP_info['group_by'] ['metric'] [] = $this->SC_APP_info['metric_by_index'] [$metricIndex];
            }
        }

        $this->SC_APP_info['options'] ['tabular'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pivot_tabular'];

        foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['dimension_order'] as $dimensionName => $dimensionOrder) {
            $this->SC_APP_info['dimension'] [$dimensionName] ['order_by_direction'] = $dimensionOrder;
        }

        if (isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['contr_array_resumo']) && 'NAO' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['contr_array_resumo']) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pagination_first'] = 1;
        }
        $this->SC_APP_data['pagination'] ['length'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pagination_length'];
        $this->SC_APP_data['pagination'] ['first'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pagination_first'];

        $this->SC_APP_data['metric_order'] ['using'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_using'];
        $this->SC_APP_data['metric_order'] ['name'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_name'];
        $this->SC_APP_data['metric_order'] ['rule'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_rule'];
        $this->SC_APP_data['metric_order'] ['parameters'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_parameters'];
    }

    function info_processData()
    {
        $this->SC_APP_data['dimension_count'] ['x'] = count($this->SC_APP_info['group_by'] ['dimension'] ['x']);
        $this->SC_APP_data['dimension_count'] ['y'] = count($this->SC_APP_info['group_by'] ['dimension'] ['y']);

        $this->SC_APP_data['metric_count'] = count($this->SC_APP_info['group_by'] ['metric']);

        if ($this->aux_hasXAxysDimensionField()) {
            $this->SC_APP_data['dimension_label_rowspan'] = ' rowspan="' . ($this->SC_APP_data['dimension_count'] ['x'] + 1) . '"';
        }
    }

    function info_changeSort()
    {
        if ('change_dimension_sort' == $this->aux_getProcessOption()) {
            $this->info_deleteSummaryCache();
            $this->info_changeSort_dimension();
        } elseif ('change_metric_sort' == $this->aux_getProcessOption()) {
            $this->info_deleteSummaryCache();
            $this->info_changeSort_metric();
        }
    }

    function info_changeSort_dimension()
    {
        $sortDimension = $this->SC_APP_data['process'] ['parameters'] ['dimension'];
        if ($this->SC_APP_data['metric_order'] ['using'] && in_array($sortDimension, $this->SC_APP_info['options'] ['order_metric_apply_to_dimensions'])) {
            $sortRule = $this->SC_APP_info['dimension'] [$sortDimension] ['order_by_direction_default'];
        } else {
            $sortRule = $this->SC_APP_data['process'] ['parameters'] ['new_order'];
        }

        $this->SC_APP_info['dimension'] [$sortDimension] ['order_by_direction'] = $sortRule;
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['dimension_order'] [$sortDimension] = $sortRule;

        if (in_array($sortDimension, $this->SC_APP_info['options'] ['order_metric_apply_to_dimensions'])) {
            $this->info_clearSort_metric();
        }
    }

    function info_changeSort_metric()
    {
        $sortMetricMd5 = $this->SC_APP_data['process'] ['parameters'] ['metric']; 
        $sortRule = $this->SC_APP_data['process'] ['parameters'] ['new_order'];

        if (isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_info'] [$sortMetricMd5])) {
            if ('' != $sortRule) {
                $this->SC_APP_data['metric_order'] ['using'] = true;
                $this->SC_APP_data['metric_order'] ['name'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_info'] [$sortMetricMd5] ['metric'];
                $this->SC_APP_data['metric_order'] ['rule'] = $sortRule;
                $this->SC_APP_data['metric_order'] ['parameters'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_info'] [$sortMetricMd5] ['parameters'];

                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_using'] = true;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_name'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_info'] [$sortMetricMd5] ['metric'];
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_rule'] = $sortRule;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_parameters'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_info'] [$sortMetricMd5] ['parameters'];
            } else {
                $this->info_clearSort_metric();
            }
        }
    }

    function info_clearSort_metric()
    {
        $this->SC_APP_data['metric_order'] ['using'] = false;
        $this->SC_APP_data['metric_order'] ['name'] = '';
        $this->SC_APP_data['metric_order'] ['rule'] = '';
        $this->SC_APP_data['metric_order'] ['parameters'] = [];

        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_using'] = false;
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_name'] = '';
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_rule'] = '';
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_parameters'] = [];
    }

    function info_changePagination()
    {
        if ('change_length_pagination' == $this->aux_getProcessOption()) {
            $this->info_changePagination_length();
        } elseif ('change_page_pagination' == $this->aux_getProcessOption()) {
            $this->info_changePagination_page();
        } elseif ('change_record_pagination' == $this->aux_getProcessOption()) {
            $this->info_changePagination_record();
        }
    }

    function info_changePagination_length()
    {
        if ('all' == strtolower($this->SC_APP_data['process'] ['parameters'] ['length'])) {
            $paginationLength = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pagination_record_count']; 
        } else {
            $paginationLength = (int)$this->SC_APP_data['process'] ['parameters'] ['length']; 
        }

        $this->SC_APP_data['pagination'] ['length'] = $paginationLength;
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pagination_length'] = $paginationLength;

        $this->SC_APP_data['pagination'] ['first'] = 1;
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pagination_first'] = 1;
    }

    function info_changePagination_page()
    {
        $paginationPage = (int)$this->SC_APP_data['process'] ['parameters'] ['page']; 
        $paginationFirst = (($paginationPage - 1) * $this->SC_APP_data['pagination'] ['length']) + 1;

        $this->SC_APP_data['pagination'] ['first'] = $paginationFirst;
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pagination_first'] = $paginationFirst;
    }

    function info_changePagination_record()
    {
        $paginationRecord = (int)$this->SC_APP_data['process'] ['parameters'] ['record']; 

        $this->SC_APP_data['pagination'] ['first'] = $paginationRecord;
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pagination_first'] = $paginationRecord;
    }

    function info_orderAxys()
    {
        if (!$this->info_isUsingSummaryCache()) {
            $this->info_addOrderValues($this->SC_APP_data['ordered_x_axys'], $this->SC_APP_info['group_by'] ['dimension'] ['x'], $this->SC_APP_data['ordered_y_axys'], $this->SC_APP_info['group_by'] ['dimension'] ['y'], []);

            $this->info_addXColspan();
            $this->info_removeXDimensions();

            $this->info_addMetricOrderValues();

            $this->info_orderDimensions($this->SC_APP_data['ordered_x_axys']);
            $this->info_orderDimensions($this->SC_APP_data['ordered_y_axys']);

            $this->info_createOrderedXMatrix();
            $this->info_createOrderedYMatrix();

            $this->info_saveSummaryCache();
        } else {
            $this->info_loadSummaryCache();
        }
    }

    function info_addOrderValues(&$xOrderedValues, $xDimensionList, &$yOrderedValues, $yDimensionList, $parameterList)
    {
        if (count($xDimensionList) == 0 && count($yDimensionList) == 0) {
            return;
        }

        $usingXAxys = false;
        if (count($xDimensionList) == 0) {
            $thisDimensionField = array_shift($yDimensionList);
        } else {
            $usingXAxys = true;
            $thisDimensionField = array_shift($xDimensionList);
        }

        $thisSummArrayName = $this->SC_APP_info['dimension'] [$thisDimensionField] ['summary_values_array'];
        $thisSummArray = $this->$thisSummArrayName;
        $thisOrderByIndex = $this->SC_APP_info['dimension'] [$thisDimensionField] ['order_by_index'];
        $thisOrderByDirection = $this->SC_APP_info['dimension'] [$thisDimensionField] ['order_by_direction'];

        $originalParameterList = $parameterList;
        while (count($parameterList) != 0) {
            $thisParameter = array_shift($parameterList);
            $thisSummArray = $thisSummArray[$thisParameter];
        }

        foreach ($thisSummArray as $thisDimensionValue => $thisDimensionInfo) {
            $this->SC_APP_data['dimension_value_labels'] [$thisDimensionField] [$thisDimensionValue] = $thisDimensionInfo[self::GROUPBY_ORIGINAL] [self::TOTAL_ARRAY_LABEL_INDEX];

            $newDimensionItem = [
                'dimension' => $thisDimensionField,
                'dimension_order_value' => $thisDimensionInfo[self::GROUPBY_ORIGINAL] [$thisOrderByIndex],
                'dimension_order_direction' => $thisOrderByDirection,
                'children' => []
            ];

            $thisParameterList = array_merge($originalParameterList, [$thisDimensionValue]);

            if ($usingXAxys) {
                $xOrderedValues[$thisDimensionValue] = $newDimensionItem;
                $yOrderedValues[$thisDimensionValue] = $newDimensionItem;
                $this->info_addOrderValues($xOrderedValues[$thisDimensionValue] ['children'], $xDimensionList, $yOrderedValues[$thisDimensionValue] ['children'], $yDimensionList, $thisParameterList);
            } else {
                $yOrderedValues[$thisDimensionValue] = $newDimensionItem;
                $this->info_addOrderValues($xOrderedValues, $xDimensionList, $yOrderedValues[$thisDimensionValue] ['children'], $yDimensionList, $thisParameterList);
            }
        }
    }

    function info_addXColspan()
    {
        $this->info_addXColspanItem($this->SC_APP_data['ordered_x_axys']);
    }

    function info_addXColspanItem(&$orderedValues)
    {
        if (count($orderedValues) == 0) {
            return $this->SC_APP_data['metric_count'];
        }

        $total = 0;
        foreach ($orderedValues as $dimensionValue => $dimensionInfo) {
            $colSpan = $this->info_addXColspanItem($orderedValues[$dimensionValue] ['children']);

            $orderedValues[$dimensionValue] ['colspan'] = $colSpan;

            $total += $colSpan;
        }

        return $total;
    }

    function info_removeXDimensions()
    {
        if (!$this->aux_hasXAxysDimensionField()) {
            return;
        }

        $oldOrderedY = $this->SC_APP_data['ordered_y_axys'];
        $this->SC_APP_data['ordered_y_axys'] = [];
        $this->info_removeOrdered($oldOrderedY, $this->SC_APP_data['ordered_y_axys']);
    }

    function info_addMetricOrderValues()
    {
        $this->info_addMetricOrderValues_items($this->SC_APP_data['ordered_y_axys'], []);
    }

    function info_addMetricOrderValues_items(&$orderedValues, $parameters)
    {
        if (!$this->SC_APP_data['metric_order'] ['using']) {
            return;
        }

        foreach ($orderedValues as $dimensionValue => $dimensionInfo) {
            $thisParameters = array_merge($parameters, [$dimensionValue]);

            $metricArray = $this->aux_getMetricArray($this->SC_APP_data['metric_order'] ['parameters'], $thisParameters);

            $orderedValues[$dimensionValue] ['order_by_metric'] = true;
            $orderedValues[$dimensionValue] ['metric_order_value'] = $metricArray[self::GROUPBY_ORIGINAL] [ $this->SC_APP_info['metric'] [ $this->SC_APP_data['metric_order'] ['name'] ] ['value_index'] ];
            $orderedValues[$dimensionValue] ['metric_order_direction'] = $this->SC_APP_data['metric_order'] ['rule'];

            $this->info_addMetricOrderValues_items($orderedValues[$dimensionValue] ['children'], $thisParameters);
        }
    }

    function info_removeOrdered($oldOrderedDimension, &$newOrderedDimension)
    {
        if (count($oldOrderedDimension) == 0) {
            return;
        }

        foreach ($oldOrderedDimension as $dimensionValue => $dimensionInfo) {
            $dimensionName = $dimensionInfo['dimension'];

            if (in_array($dimensionName, $this->SC_APP_info['group_by'] ['dimension'] ['x'])) {
                $this->info_removeOrdered($dimensionInfo['children'], $newOrderedDimension);
            } else {
                if (!isset($newOrderedDimension[$dimensionValue])) {
                    $newOrderedDimension[$dimensionValue] = [
                        'dimension' => $dimensionInfo['dimension'],
                        'dimension_order_value' => $dimensionInfo['dimension_order_value'],
                        'dimension_order_direction' => $dimensionInfo['dimension_order_direction'],
                        'children' => [],
                    ];
                }

                $this->info_mergeOrdered($dimensionInfo['children'], $newOrderedDimension[$dimensionValue] ['children']);
            }
        }
    }

    function info_mergeOrdered($oldOrderedDimension, &$newOrderedDimension)
    {
        if (count($oldOrderedDimension) == 0) {
            return;
        }

        foreach ($oldOrderedDimension as $dimensionValue => $dimensionInfo) {
            if (!isset($newOrderedDimension[$dimensionValue])) {
                $newOrderedDimension[$dimensionValue] = $dimensionInfo;
            } else {
                $this->info_mergeOrdered($dimensionInfo['children'], $newOrderedDimension[$dimensionValue] ['children']);
            }
        }
    }

    function info_orderDimensions(&$dimension)
    {
        if (count($dimension) == 0) {
            return;
        }

        uasort($dimension, function($a, $b) {
            if (isset($a['order_by_metric']) && (empty($this->SC_APP_info['options'] ['order_metric_apply_to_dimensions']) || in_array($a['dimension'], $this->SC_APP_info['options'] ['order_metric_apply_to_dimensions']))) {
                if ($a['metric_order_value'] == $b['metric_order_value']) {
                    if ('asc' == $a['dimension_order_direction']) {
                        return strnatcmp($a['dimension_order_value'], $b['dimension_order_value']);
                    } else {
                        return strnatcmp($b['dimension_order_value'], $a['dimension_order_value']);
                    }
                } elseif ('asc' == $a['metric_order_direction']) {
                    return strnatcmp($a['metric_order_value'], $b['metric_order_value']);
                } else {
                    return strnatcmp($b['metric_order_value'], $a['metric_order_value']);
                }
            } else {
                if ('asc' == $a['dimension_order_direction']) {
                    return strnatcmp($a['dimension_order_value'], $b['dimension_order_value']);
                } else {
                    return strnatcmp($b['dimension_order_value'], $a['dimension_order_value']);
                }
            }
        });

        foreach ($dimension as $dimensionKey => $dimensionInfo) {
            $this->info_orderDimensions($dimension[$dimensionKey] ['children']);
        }
    }

    function info_createOrderedXMatrix()
    {
        $this->info_addOrderedXRow($this->SC_APP_data['ordered_x_axys'], [], 0);
    }

    function info_addOrderedXRow($orderedDimension, $parameters, $dimensionLevel)
    {
        if (count($orderedDimension) == 0) {
            return;
        }

        if (!isset($this->SC_APP_data['ordered_x_matrix'] [$dimensionLevel])) {
            $this->SC_APP_data['ordered_x_matrix'] [$dimensionLevel] = [];
        }

        foreach ($orderedDimension as $dimensionValue => $dimensionInfo) {
            $thisParameters = array_merge($parameters, [$dimensionValue]);

            $this->SC_APP_data['ordered_x_matrix'] [$dimensionLevel] [] = [
                'dimension' => $dimensionValue,
                'dimensions' => $thisParameters,
                'colspan' => $dimensionInfo['colspan']
            ];

            $this->info_addOrderedXRow($dimensionInfo['children'], $thisParameters, $dimensionLevel + 1);
        }
    }

    function info_createOrderedYMatrix()
    {
        $this->info_addOrderedYRow($this->SC_APP_data['ordered_y_axys'], []);
    }

    function info_addOrderedYRow($orderedDimension, $orderParameters)
    {
        if (count($orderedDimension) == 0) {
            $this->SC_APP_data['ordered_y_matrix'] [] = [
                'dimensions' => $orderParameters,
                'type' => 'row',
                'colspan' => 1
            ];
            return;
        }

        foreach ($orderedDimension as $dimensionValue => $dimensionInfo)
        {
            $thisParameters = array_merge($orderParameters, [$dimensionValue]);
            $this->info_addOrderedYRow($dimensionInfo['children'], $thisParameters);
        }

        $parametersCount = count($orderParameters);

        $this->SC_APP_data['ordered_y_matrix'] [] = [
            'dimensions' => $orderParameters,
            'type' => $parametersCount == 0 ? 'total' : 'subtotal',
            'colspan' => $this->SC_APP_data['dimension_count'] ['y'] - $parametersCount + 1
        ];
    }

    function info_setPagination()
    {
        $this->SC_APP_data['pagination'] ['record_count'] = count($this->SC_APP_data['ordered_y_matrix']);
        if ($this->aux_hasYAxysDimensionField()) {
            $this->SC_APP_data['pagination'] ['record_count']--;
        }
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['pagination_record_count'] = $this->SC_APP_data['pagination'] ['record_count'];

        if ($this->aux_hasPagination()) {
            $paginationLast = $this->SC_APP_data['pagination'] ['first'] + $this->SC_APP_data['pagination'] ['length'] - 1;
            if ($paginationLast < $this->SC_APP_data['pagination'] ['record_count']) {
                $this->SC_APP_data['pagination'] ['last'] = $paginationLast;
            } else {
                $this->SC_APP_data['pagination'] ['last'] = $this->SC_APP_data['pagination'] ['record_count'];
            }

            $this->SC_APP_data['pagination'] ['page_count'] = ceil($this->SC_APP_data['pagination'] ['record_count'] / $this->SC_APP_data['pagination'] ['length']);

            if (1 > $this->SC_APP_data['pagination'] ['first'] - $this->SC_APP_data['pagination'] ['length']) {
                $this->SC_APP_data['pagination'] ['back'] = 1;
            } else {
                $this->SC_APP_data['pagination'] ['back'] = $this->SC_APP_data['pagination'] ['first'] - $this->SC_APP_data['pagination'] ['length'];
            }

            if ($this->SC_APP_data['pagination'] ['record_count'] < $this->SC_APP_data['pagination'] ['last'] + 1) {
                $this->SC_APP_data['pagination'] ['forward'] = $this->SC_APP_data['pagination'] ['record_count'];
            } else {
                $this->SC_APP_data['pagination'] ['forward'] = $this->SC_APP_data['pagination'] ['last'] + 1;
            }

            $this->info_setPagination_navigationBar();
            $this->info_setPagination_jsonReturn();
        } else {
            $this->SC_APP_data['pagination'] ['first'] = 1;
            $this->SC_APP_data['pagination'] ['last'] = $this->SC_APP_data['pagination'] ['record_count'];
        }

        $this->SC_APP_data['line_count'] = $this->SC_APP_data['pagination'] ['first'];
        $this->SC_APP_data['css_line_count'] = $this->SC_APP_data['pagination'] ['first'];
    }

    function info_setPagination_navigationBar()
    {
        if ($this->SC_APP_data['pagination'] ['page_count'] < $this->SC_APP_data['pagination'] ['page_link_count']) {
            $this->SC_APP_data['pagination'] ['page_link_count'] = $this->SC_APP_data['pagination'] ['page_count'];
        }

        $this->SC_APP_data['pagination'] ['page_link_actual'] = ceil($this->SC_APP_data['pagination'] ['first'] / $this->SC_APP_data['pagination'] ['length']);

        $rightSideLinkCount = floor($this->SC_APP_data['pagination'] ['page_link_count'] / 2);
        $leftSideLinkCount = $rightSideLinkCount;
        if ($this->SC_APP_data['pagination'] ['page_link_count'] % 2 == 0) {
            $leftSideLinkCount--;
        }

        if ($this->SC_APP_data['pagination'] ['page_link_actual'] <= $leftSideLinkCount + 1) {
            $firstPageLink = 1;
        } else {
            $firstPageLink = $this->SC_APP_data['pagination'] ['page_link_actual'] - $leftSideLinkCount;
        }

        $lastPageLink = $firstPageLink + $leftSideLinkCount + $rightSideLinkCount;
        if ($lastPageLink > $this->SC_APP_data['pagination'] ['page_count']) {
            $pageShift = $this->SC_APP_data['pagination'] ['page_count'] - $lastPageLink;
            $lastPageLink = $this->SC_APP_data['pagination'] ['page_count'];
            $firstPageLink += $pageShift;
        }

        $this->SC_APP_data['pagination'] ['page_link_list'] = [];
        for ($i = $firstPageLink; $i <= $lastPageLink; $i++) {
            $this->SC_APP_data['pagination'] ['page_link_list'] [] = $i;
        }

        $this->SC_APP_data['pagination'] ['page_link_html'] = $this->aux_createPaginationLinks();
        $this->SC_APP_data['pagination'] ['page_navigation_description'] = $this->aux_createPaginationDescription();
    }

    function info_setPagination_jsonReturn()
    {
        $this->Ini->Arr_result['setVar'] [] = [
            'var' => 'scPag_first',
            'value' => $this->SC_APP_data['pagination'] ['first']
        ];
        $this->Ini->Arr_result['setVar'] [] = [
            'var' => 'scPag_last',
            'value' => $this->SC_APP_data['pagination'] ['last']
        ];
        $this->Ini->Arr_result['setVar'] [] = [
            'var' => 'scPag_back',
            'value' => $this->SC_APP_data['pagination'] ['back']
        ];
        $this->Ini->Arr_result['setVar'] [] = [
            'var' => 'scPag_forward',
            'value' => $this->SC_APP_data['pagination'] ['forward']
        ];

        $this->Ini->Arr_result['setVar'] [] = [
            'var' => 'scPag_count',
            'value' => $this->SC_APP_data['pagination'] ['record_count']
        ];
        $this->Ini->Arr_result['setVar'] [] = [
            'var' => 'scPag_length',
            'value' => $this->SC_APP_data['pagination'] ['length']
        ];
        $this->Ini->Arr_result['setVar'] [] = [
            'var' => 'scPag_pageCount',
            'value' => $this->SC_APP_data['pagination'] ['page_count']
        ];

        $this->Ini->Arr_result['setJqueryVal'] [] = [
            'field' => 'res_brec_qtd_top',
            'value' => $this->SC_APP_data['pagination'] ['page_link_actual']
        ];
        $this->Ini->Arr_result['setJqueryVal'] [] = [
            'field' => 'res_brec_qtd_bot',
            'value' => $this->SC_APP_data['pagination'] ['page_link_actual']
        ];

        $this->Ini->Arr_result['setValue'] [] = [
            'field' => 'res_nav_top',
            'value' => $this->SC_APP_data['pagination'] ['page_link_html']
        ];
        $this->Ini->Arr_result['setValue'] [] = [
            'field' => 'res_nav_bot',
            'value' => $this->SC_APP_data['pagination'] ['page_link_html']
        ];

        $this->Ini->Arr_result['setValue'] [] = [
            'field' => 'res_summary_top',
            'value' => $this->SC_APP_data['pagination'] ['page_navigation_description']
        ];
        $this->Ini->Arr_result['setValue'] [] = [
            'field' => 'res_summary_bot',
            'value' => $this->SC_APP_data['pagination'] ['page_navigation_description']
        ];

        $this->Ini->Arr_result['exec_JS'] [] = [
            'function' => 'scPagination_navigation_control',
            'parm' => ''
        ];
    }

    function info_setComparisonLabels()
    {
        if ($this->aux_isComparison()) {
            $this->SC_APP_data['comparison_labels'] [self::GROUPBY_ORIGINAL] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['cond_pesq_compara'] [self::GROUPBY_ORIGINAL];
            $this->SC_APP_data['comparison_labels'] [self::GROUPBY_COMPARISON] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['cond_pesq_compara'] [self::GROUPBY_COMPARISON];
            $this->SC_APP_data['comparison_labels'] [self::GROUPBY_PERC_CHANGE] = $this->Ini->Nm_lang['lang_othr_comp_variation'];
        }
    }

    function info_isUsingSummaryCache()
    {
        return isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['using_summary_cache']) && $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['using_summary_cache'];
    }

    function info_saveSummaryCache()
    {
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['using_summary_cache'] = true;

        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['summary_cache'] = [
            'dimension_value_labels' => $this->SC_APP_data['dimension_value_labels'],
            'ordered_x_axys' => $this->SC_APP_data['ordered_x_axys'],
            'ordered_y_axys' => $this->SC_APP_data['ordered_y_axys'],
            'ordered_x_matrix' => $this->SC_APP_data['ordered_x_matrix'],
            'ordered_y_matrix' => $this->SC_APP_data['ordered_y_matrix'],
        ];
    }

    function info_loadSummaryCache()
    {
        $this->SC_APP_data['dimension_value_labels'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['summary_cache'] ['dimension_value_labels'];
        $this->SC_APP_data['ordered_x_axys'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['summary_cache'] ['ordered_x_axys'];
        $this->SC_APP_data['ordered_y_axys'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['summary_cache'] ['ordered_y_axys'];
        $this->SC_APP_data['ordered_x_matrix'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['summary_cache'] ['ordered_x_matrix'];
        $this->SC_APP_data['ordered_y_matrix'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['summary_cache'] ['ordered_y_matrix'];
    }

    function info_deleteSummaryCache()
    {
        if (isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['using_summary_cache'])) {
            unset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['using_summary_cache']);
            unset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['summary_cache']);
        }
    }

    function display_summary()
    {
        global $nm_saida;

        $this->display_css();
        $this->display_js();

        $this->display_inlineChart_startUp();

        $this->display_summary_container_init();

        $htmlCode = <<<SCEOT
<td class="{$this->SC_APP_info['css'] ['summary_container']} {$this->SC_APP_info['css'] ['mobile_inner_control']}">

SCEOT;
        $htmlCode .= $this->display_body();
        $htmlCode .= $this->display_inlineChart_setInlineChartMd5();
        $htmlCode .= <<<SCEOT
</td>

SCEOT;
        $nm_saida->saida($htmlCode);

        $this->display_summary_container_end();

        $this->display_export_charts();

        $this->display_inlineChart_initialAjax();
    }

    function display_summary_container_init()
    {
        global $nm_saida;

        $htmlCode = <<<SCEOT
<tr id="summary_body" class="{$this->SC_APP_info['css'] ['mobile_inner_control']}">

SCEOT;

        $nm_saida->saida($htmlCode);

        if ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['ajax_nav']) {
            $_SESSION['scriptcase'] ['saida_html'] = '';
        }
    }

    function display_summary_container_end()
    {
        global $nm_saida;

        if ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['ajax_nav']) {
            if ($this->proc_res_grid) {
                $this->Ini->Arr_result['setValue'] [] = [
                    'field' => 'sc_res_grid',
                    'value' => NM_charset_to_utf8($_SESSION['scriptcase'] ['saida_html'])
                ];
            } else {
                $this->Ini->Arr_result['setValue'] [] = [
                    'field' => 'summary_body',
                    'value' => NM_charset_to_utf8($_SESSION['scriptcase'] ['saida_html'])
                ];
            }
            $_SESSION['scriptcase'] ['saida_html'] = "";
        }

        $htmlCode = <<<SCEOT
</tr>

SCEOT;

        $nm_saida->saida($htmlCode);
    }

    function display_emptyBody()
    {
        $htmlCode = <<<SCEOT
<script>
    scChartIsEmpty = true;
</script>
<span style="display: block; text-align: center">{$this->Ini->Nm_lang['lang_errm_empt']}</span>

SCEOT;

        return $htmlCode;
    }

    function display_body()
    {
        if ($this->aux_isEmptySummary()) {
            $htmlCode .= $this->display_emptyBody();

            return $htmlCode;
        }

        $htmlCode = <<<SCEOT
<script>
    scChartIsEmpty = false;
</script>
<table id="sc-ui-summary-body" class="{$this->SC_APP_info['css'] ['summary_table']}">

SCEOT;

        $htmlCode .= $this->display_labels();
        if ($this->SC_APP_info['options'] ['display_total_top']) {
            $htmlCode .= $this->display_totals();
        }
        $htmlCode .= $this->display_rows();
        if (!$this->SC_APP_info['options'] ['display_total_top']) {
            $htmlCode .= $this->display_totals();
        }
        $htmlCode .= $this->display_summaryLine();
        $htmlCode .= <<<SCEOT
</table>

SCEOT;

        return $htmlCode;
    }

    function display_inlineChart_startUp()
    {
        global $nm_saida;

        if (!$this->aux_hasCharts()) {
            return;
        } elseif (!$this->aux_hasInlineChart()) {
            return;
        }

        $this->getChartInstance();
        $this->Graf->info_initializeData();

        $htmlCode = <<<SCEOT
    <tr>
        <td class="{$this->SC_APP_info['css'] ['summary_container']}" id="sc-summary-chart-container">

SCEOT;
        $htmlCode .= $this->Graf->display_summaryChart_inline_startUp();
        $htmlCode .= <<<SCEOT
        </td>
    </tr>

SCEOT;

        $nm_saida->saida($htmlCode);
    }

    function display_inlineChart_initialAjax()
    {
        global $nm_saida;

        if (!$this->aux_hasCharts()) {
            return;
        } elseif (!$this->aux_hasInlineChart()) {
            return;
        }

        $htmlCode = $this->Graf->display_summaryChart_inline_initialAjaxCall($this->SC_APP_data['chart_md5_initial']);

        $nm_saida->saida($htmlCode);
    }

    function display_inlineChart_setInlineChartMd5()
    {
        if (!$this->aux_hasReloadChartMd5()) {
            return '';
        }

        $htmlCode = <<<SCEOT
    <script type="text/javascript">
        $(function() {
            scChartInlineMd5 = "{$this->SC_APP_data['chart_md5_initial']}";
            scChart_update_inline();
        });
    </script>

SCEOT;

        return $htmlCode;
    }

    function display_labels()
    {
        $this->SC_APP_data['fixed_col_count'] = 0;

        $htmlCode = <<<SCEOT
    <tr class="{$this->SC_APP_info['css'] ['header_row']}">

SCEOT;
        $htmlCode .= $this->display_labels_rowCount();
        $htmlCode .= $this->display_labels_dimensions();
        $htmlCode .= $this->display_labels_comparison();
        $htmlCode .= $this->display_labels_metrics_firstRow();
        $htmlCode .= $this->display_labels_total();
        $htmlCode .= <<<SCEOT
    </tr>

SCEOT;

        $htmlCode .= $this->display_labels_metrics_otherRows();

        return $htmlCode;
    }

    function display_labels_rowCount()
    {
        if (!$this->SC_APP_info['options'] ['display_seq']) {
            return '';
        }

        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['header_cell']} {$this->SC_APP_info['css'] ['fixed_column_title']} {$this->SC_APP_info['css'] ['fixed_column_op']} {$this->SC_APP_info['css'] ['fixed_column_op_seq']} {$this->SC_APP_info['css'] ['fixed_column_is_fixed']}"{$this->SC_APP_data['dimension_label_rowspan']}>&nbsp;</td>

SCEOT;

        return $htmlCode;
    }

    function display_labels_comparison()
    {
        if (!$this->aux_isComparison()) {
            return '';
        }

        $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : ''; 

        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['header_cell']} {$this->SC_APP_info['css'] ['fixed_column_title']} {$this->SC_APP_info['css'] ['fixed_column_field']} {$fixedColCountCss}"{$this->SC_APP_data['dimension_label_rowspan']}>{$this->SC_APP_data['comparison_labels'] ['comparison_field']}</td>

SCEOT;

        $this->SC_APP_data['fixed_col_count']++;

        return $htmlCode;
    }

    function display_labels_dimensions()
    {
        if ($this->aux_isTabular()) {
            return $this->display_labels_dimensions_tabular();
        } else {
            return $this->display_labels_dimensions_nonTabular();
        }
    }

    function display_labels_dimensions_tabular()
    {
        $htmlCode = '';

        foreach ($this->SC_APP_info['group_by'] ['dimension'] ['y'] as $dimensionName) {
            $dimensionLabel = $this->SC_APP_info['dimension'] [$dimensionName] ['label'];
            $dimensionFixPin = $this->aux_getFixPin($this->SC_APP_data['fixed_col_count']);

            list($dimensionLabel, $dimensionIcon) = $this->aux_addOrderToDimension($dimensionLabel, $dimensionName);

            $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : ''; 

            $finalLabel = $this->display_labels_dimensions_tabular_labelHtml($metricName, $dimensionLabel, $dimensionIcon, $dimensionFixPin);

            $htmlCode .= <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['header_cell']} {$this->SC_APP_info['css'] ['fixed_column_title']} {$this->SC_APP_info['css'] ['fixed_column_field']} {$fixedColCountCss}"{$this->SC_APP_data['dimension_label_rowspan']}>{$finalLabel}</td>

SCEOT;

            $this->SC_APP_data['fixed_col_count']++;
        }

        return $htmlCode;
    }
    function display_labels_dimensions_tabular_labelHtml($metricName, $dimensionLabel, $dimensionIcon, $dimensionFixPin)
    {
        if (empty($this->Ini->Label_summary_sort_pos) || 'right' == $this->Ini->Label_summary_sort_pos) {
            $this->Ini->Label_summary_sort_pos = 'right_field';
        }

        switch ($this->Ini->Label_summary_sort_pos) {
            case 'left_cell':
                $spanFinal = <<<SCEOT
{$dimensionIcon}<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$dimensionLabel}</span>
SCEOT;
                break;

            case 'right_cell':
                $spanFinal = <<<SCEOT
<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$dimensionLabel}</span>{$dimensionIcon}
SCEOT;
                break;

            case 'left_field':
                $spanFinal = <<<SCEOT
<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$dimensionIcon}{$dimensionLabel}</span>
SCEOT;
                break;

            case 'right_field':
            default:
                $spanFinal = <<<SCEOT
<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$dimensionLabel}{$dimensionIcon}</span>
SCEOT;
                break;

        }
        
        $spanFinal = <<<SCEOT
<span style="display: flex; flex-direction: row; align-items: center; justify-content: space-between"><span style="display: flex; flex-grow: 1; align-items: center; justify-content: space-between">{$spanFinal}</span>$dimensionFixPin</span>
SCEOT;

        return $spanFinal;
    }

    function display_labels_dimensions_nonTabular()
    {
        $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : '';
 
        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['header_cell']} {$this->SC_APP_info['css'] ['fixed_column_title']} {$this->SC_APP_info['css'] ['fixed_column_field']} {$fixedColCountCss}"{$this->SC_APP_data['dimension_label_rowspan']}>{$this->Ini->Nm_lang['lang_othr_smry_msge']}</td>

SCEOT;

        $this->SC_APP_data['fixed_col_count']++;

        return $htmlCode;
    }

    function display_labels_metrics($parameters, $isLineTotal)
    {
        $htmlCode = '';

        foreach ($this->SC_APP_info['group_by'] ['metric'] as $metricName) {
            $metricLabel = $this->SC_APP_info['metric'] [$metricName] ['label'];

            if (!$isLineTotal) {
                list($orderLabel, $orderIcon) = $this->aux_addOrderToMetric($metricLabel, $metricName, $parameters);
            } else {
                $orderLabel = $metricLabel;
                $orderIcon = '';
            }

            $chartDimensionName = isset($this->SC_APP_info['group_by'] ['dimension'] ['y'] [0]) ? $this->SC_APP_info['group_by'] ['dimension'] ['y'] [0] : '';
            if ($this->SC_APP_info['chart'] [$chartDimensionName] [$metricName] ['has_chart']) {
                $chartIcon = $this->aux_addChart($chartDimensionName, $metricName, $parameters, [], false);
            } else {
                $chartIcon = '';
            }

            $finalLabel = $this->display_labels_metrics_labelHtml($metricName, $orderLabel, $orderIcon, $chartIcon);

            $htmlCode .= <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['header_cell']}">{$finalLabel}</td>

SCEOT;
        }

        return $htmlCode;
    }

    function display_labels_metrics_labelHtml($metricName, $orderLabel, $orderIcon, $chartIcon)
    {
        if ('' == $chartIcon) {
            $spanLabel = $orderLabel;
        } elseif ('right' == $this->SC_APP_info['options'] ['chart_icon_position_data']) {
            $spanLabel = "<span>{$orderLabel}&nbsp;{$chartIcon}</span>";
        } else {
            $spanLabel = "<span>{$chartIcon}&nbsp;{$orderLabel}</span>";
        }

        if (empty($this->Ini->Label_summary_sort_pos) || 'right' == $this->Ini->Label_summary_sort_pos) {
            $this->Ini->Label_summary_sort_pos = 'right_field';
        }

        switch ($this->Ini->Label_summary_sort_pos) {
            case 'left_cell':
                $spanFinal = <<<SCEOT
{$orderIcon}<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$spanLabel}</span>
SCEOT;
                break;

            case 'right_cell':
                $spanFinal = <<<SCEOT
<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$spanLabel}</span>{$orderIcon}
SCEOT;
                break;

            case 'left_field':
                $spanFinal = <<<SCEOT
<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$orderIcon}{$spanLabel}</span>
SCEOT;
                break;

            case 'right_field':
            default:
                $spanFinal = <<<SCEOT
<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$spanLabel}{$orderIcon}</span>
SCEOT;
                break;

        }
        
        $spanFinal = <<<SCEOT
<span style="display: flex; flex-direction: row; align-items: center; justify-content: space-between">{$spanFinal}</span>
SCEOT;

        return $spanFinal;
    }

    function display_labels_metrics_firstRow()
    {
        if ($this->aux_hasXAxysDimensionField()) {
            $htmlCode = $this->display_labels_metrics_firstRow_dimensionMetric();
        } else {
            $htmlCode = $this->display_labels_metrics([], false);
        }
        return $htmlCode;
    }

    function display_labels_metrics_firstRow_dimensionMetric()
    {
        return $this->display_labels_metrics_metricItems($this->SC_APP_data['ordered_x_matrix'], 0);
    }

    function display_labels_metrics_otherRows()
    {
        if (!$this->aux_hasXAxysDimensionField()) {
            return '';
        }

        $htmlCode = '';

        if ($this->SC_APP_data['dimension_count'] ['x'] > 1) {
            for ($i = 1; $i < $this->SC_APP_data['dimension_count'] ['x']; $i++) {
                $htmlCode .= <<<SCEOT
    <tr class="{$this->SC_APP_info['css'] ['header_row']}">

SCEOT;
                $htmlCode .= $this->display_labels_metrics_metricItems($this->SC_APP_data['ordered_x_matrix'], $i);
                $htmlCode .= <<<SCEOT
    </tr>

SCEOT;
            }
        }

        $htmlCode .= <<<SCEOT
    <tr class="{$this->SC_APP_info['css'] ['header_row']}">

SCEOT;
        $lastXDimensionIndex = $this->SC_APP_data['dimension_count'] ['x'] - 1;
        foreach ($this->SC_APP_data['ordered_x_matrix'] [$lastXDimensionIndex] as $dimensionInfo) {
            $htmlCode .= $this->display_labels_metrics($dimensionInfo['dimensions'], false);
        }
        if ($this->SC_APP_info['options'] ['display_total_column']) {
            $htmlCode .= $this->display_labels_metrics([], true);
        }
        $htmlCode .= <<<SCEOT
    </tr>

SCEOT;

        return $htmlCode;
    }

    function display_labels_metrics_metricItems($orderedMatrix, $matrixLevel)
    {
        $htmlCode = '';

        foreach ($orderedMatrix[$matrixLevel] as $dimensionInfo) {
            $dimensionLabel = $this->aux_getDimensionValueLabel('x', $matrixLevel, $dimensionInfo['dimension']);
            $colSpan = 1 < $dimensionInfo['colspan'] ? ' colspan="' . $dimensionInfo['colspan'] . '"' : '';

            $htmlCode .= <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['header_cell']}"{$colSpan}>{$dimensionLabel}</td>

SCEOT;
        }

        return $htmlCode;
    }

    function display_labels_total()
    {
        if (!$this->aux_hasXAxysDimensionField() || !$this->SC_APP_info['options'] ['display_total_column']) {
            return '';
        }

        $colSpan = $this->SC_APP_data['metric_count'] > 1 ? ' colspan="' . $this->SC_APP_data['metric_count'] . '"' : '';
        $rowSpan = $this->SC_APP_data['dimension_count'] ['x'] > 1 ? ' rowspan="' . $this->SC_APP_data['dimension_count'] ['x'] . '"' : '';

        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['header_cell']}"{$colSpan}{$rowSpan}>{$this->Ini->Nm_lang['lang_othr_chrt_totl']}</td>

SCEOT;

        return $htmlCode;
    }

    function display_rows()
    {
        if ($this->aux_isTabular()) {
            return $this->display_rows_tabular();
        } else {
            return $this->display_rows_nonTabular();
        }
    }

    function display_rows_tabular()
    {
        $htmlCode = '';

        for ($i = $this->SC_APP_data['pagination'] ['first'] - 1; $i < $this->SC_APP_data['pagination'] ['last']; $i++) {
            $rowDimensionsInfo = $this->SC_APP_data['ordered_y_matrix'] [$i];
            $isSeqRow = 'row' == $rowDimensionsInfo['type'];

            if ('total' == $rowDimensionsInfo['type']) {
                continue;
            }

            $htmlCode .= $this->display_rows_tabular_thisRow($rowDimensionsInfo, self::GROUPBY_ORIGINAL, $isSeqRow, false); 

            if ($this->aux_isComparison()) {
                if ($isSeqRow) {
                    $this->SC_APP_data['css_line_count']++;
                }
                $htmlCode .= $this->display_rows_tabular_thisRow($rowDimensionsInfo, self::GROUPBY_COMPARISON, $isSeqRow, true); 
                if ($isSeqRow) {
                    $this->SC_APP_data['css_line_count']++;
                }
                $htmlCode .= $this->display_rows_tabular_thisRow($rowDimensionsInfo, self::GROUPBY_PERC_CHANGE, $isSeqRow, true); 
            }

            $this->SC_APP_data['line_count']++;
            if ($isSeqRow) {
                $this->SC_APP_data['css_line_count']++;
            }
        }

        return $htmlCode;
    }

    function display_rows_tabular_thisRow($rowDimensionsInfo, $comparisonArrayIndex, $isSeqRow, $isComparisonRow)
    {
        $this->SC_APP_data['fixed_col_count'] = 0;

        $htmlCode = <<<SCEOT
    <tr class="{$this->SC_APP_info['css'] ['data_row']}">

SCEOT;
        $htmlCode .= $this->display_rows_rowCount($isSeqRow, $isComparisonRow);
        $htmlCode .= $this->display_rows_dimensions_tabular($rowDimensionsInfo, $isComparisonRow);
        $htmlCode .= $this->display_rows_comparison($comparisonArrayIndex, $rowDimensionsInfo['type']);
        $htmlCode .= $this->display_rows_metrics($rowDimensionsInfo['dimensions'], $comparisonArrayIndex);
        $htmlCode .= $this->display_rows_total($rowDimensionsInfo['dimensions'], $comparisonArrayIndex);
        $htmlCode .= <<<SCEOT
    </tr>

SCEOT;

        return $htmlCode;
    }

    function display_rows_nonTabular()
    {
        $htmlCode = $this->display_rows_nonTabular_items($this->SC_APP_data['ordered_y_axys'], []);

        return $htmlCode;
    }

    function display_rows_nonTabular_items($dimensionList, $parameterList)
    {
        if (count($dimensionList) == 0) {
            return '';
        }

        $htmlCode = '';

        foreach ($dimensionList as $dimensionValue => $dimensionInfo) {
            $dimensionIndex = count($parameterList);
            $thisParameterList = array_merge($parameterList, [$dimensionValue]);

            $htmlCode .= $this->display_rows_nonTabular_items_thisRow($dimensionIndex, $dimensionValue, $thisParameterList, self::GROUPBY_ORIGINAL, false);

            if ($this->aux_isComparison()) {
                $this->SC_APP_data['css_line_count']++;
                $htmlCode .= $this->display_rows_nonTabular_items_thisRow($dimensionIndex, $dimensionValue, $thisParameterList, self::GROUPBY_COMPARISON, true);
                $this->SC_APP_data['css_line_count']++;
                $htmlCode .= $this->display_rows_nonTabular_items_thisRow($dimensionIndex, $dimensionValue, $thisParameterList, self::GROUPBY_PERC_CHANGE, true);
            }

            $this->SC_APP_data['line_count']++;
            $this->SC_APP_data['css_line_count']++;

            $htmlCode .= $this->display_rows_nonTabular_items($dimensionInfo['children'], $thisParameterList);
        }

        return $htmlCode;
    }

    function display_rows_nonTabular_items_thisRow($dimensionIndex, $dimensionValue, $parameterList, $comparisonArrayIndex, $isComparisonRow)
    {
        $this->SC_APP_data['fixed_col_count'] = 0;

        $htmlCode = <<<SCEOT
    <tr class="{$this->SC_APP_info['css'] ['data_row']}">

SCEOT;
        $htmlCode .= $this->display_rows_rowCount(true, $isComparisonRow);
        $htmlCode .= $this->display_rows_dimensions_nonTabular($dimensionIndex, $dimensionValue, $parameterList, $isComparisonRow);
        $htmlCode .= $this->display_rows_comparison($comparisonArrayIndex, 'row');
        $htmlCode .= $this->display_rows_metrics($parameterList, $comparisonArrayIndex);
        $htmlCode .= $this->display_rows_total($parameterList, $comparisonArrayIndex);
        $htmlCode .= <<<SCEOT
    </tr>

SCEOT;

        return $htmlCode;
    }

    function display_rows_rowCount($isSeqRow, $isComparisonRow)
    {
        if (!$this->SC_APP_info['options'] ['display_seq']) {
            return '';
        }

        $rowSpan = '';
        $valignTop = '';
        if ($this->aux_isComparison() && $isComparisonRow) {
            return '';
        } elseif ($this->aux_isComparison()) {
            $rowSpan = ' rowspan="3"';
            $valignTop = $this->SC_APP_info['css'] ['valign_top'];
        }

        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['data_visible']} {$this->SC_APP_info['css'] ['data_seq']} {$this->SC_APP_info['css'] ['fixed_column_op']} {$this->SC_APP_info['css'] ['fixed_column_op_seq']} {$this->SC_APP_info['css'] ['fixed_column_is_fixed']} {$valignTop}"{$rowSpan}>{$this->SC_APP_data['line_count']}</td>

SCEOT;

        return $htmlCode;
    }

    function display_rows_comparison($comparisonArrayIndex, $rowType)
    {
        if (!$this->aux_isComparison()) {
            return '';
        }

        $cellCss = 'row' == $rowType ? $this->SC_APP_info['css'] ['data_visible'] : $this->SC_APP_info['css'] ['data_subtotal'];
        $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : '';
        $percentualChangeCss = self::GROUPBY_PERC_CHANGE == $comparisonArrayIndex ? $this->SC_APP_info['css'] ['comparison_label'] : ''; 

        $htmlCode = <<<SCEOT
        <td class="{$cellCss} {$this->SC_APP_info['css'] ['fixed_column_field']} {$percentualChangeCss} {$fixedColCountCss}">{$this->SC_APP_data['comparison_labels'] [$comparisonArrayIndex]}</td>

SCEOT;

        $this->SC_APP_data['fixed_col_count']++;

        return $htmlCode;
    }

    function display_rows_dimensions_tabular($rowDimensionInfo, $isComparisonRow)
    {
        $htmlCode = '';
        $parameters = [];
        $dimensionCount = count($rowDimensionInfo['dimensions']);

        $rowSpan = '';
        $valignTop = '';
        if ($this->aux_isComparison() && $isComparisonRow) {
            return '';
        } elseif ($this->aux_isComparison()) {
            $rowSpan = ' rowspan="3"';
            $valignTop = $this->SC_APP_info['css'] ['valign_top'];
        }

        foreach ($rowDimensionInfo['dimensions'] as $dimensionIndex => $dimensionValue) {
            $dimensionLabel = $this->aux_getDimensionValueLabel('y', $dimensionIndex, $dimensionValue);
            $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$dimensionIndex];
            $dimensionAlign = '' != $this->SC_APP_info['dimension'] [$dimensionName] ['align_css_class'] ? $this->SC_APP_info['dimension'] [$dimensionName] ['align_css_class'] : '';

            $parameters[] = $dimensionValue;

            $colSpan = '';
            if ($rowDimensionInfo['colspan'] > 1 && $dimensionCount == $dimensionIndex + 1) {
                $colSpan = ' colspan="' . $rowDimensionInfo['colspan'] . '"';
            }

            $invisibleSpanIni = '';
            $invisibleSpanEnd = '';

            if (!isset($this->SC_APP_info['dimension_last_value'] [$dimensionIndex])) {
                $this->SC_APP_info['dimension_last_value'] [$dimensionIndex] = $dimensionValue;
                $cellBaseCss = $this->SC_APP_info['css'] ['data_visible'];
            } elseif ($this->SC_APP_info['dimension_last_value'] [$dimensionIndex] != $dimensionValue) {
                $this->SC_APP_info['dimension_last_value'] [$dimensionIndex] = $dimensionValue;
                $cellBaseCss = $this->SC_APP_info['css'] ['data_visible'];
                for ($i = $dimensionIndex + 1; $i <= $this->SC_APP_data['dimension_count'] ['y']; $i++) {
                    if (isset($this->SC_APP_info['dimension_last_value'] [$i])) {
                        unset($this->SC_APP_info['dimension_last_value'] [$i]);
                    }
                }
            } else {
                $cellBaseCss = $this->SC_APP_info['css'] ['data_hover'];
                $invisibleSpanIni = '<span class="' . $this->SC_APP_info['css'] ['data_hover_display'] . '">';
                $invisibleSpanEnd = '</span>';
            }

            if ('subtotal' == $rowDimensionInfo['type'] && $dimensionIndex == $dimensionCount - 1) {
                $cellBaseCss = $this->SC_APP_info['css'] ['data_subtotal'];
                $invisibleSpanIni = '';
                $invisibleSpanEnd = '';
                if (!$this->SC_APP_info['options'] ['display_label_on_total']) {
                    $dimensionLabel = $this->Ini->Nm_lang['lang_othr_chrt_totl'];
                }
            }

            if ($this->SC_APP_info['dimension'] [$dimensionName] ['show_link']) {
                $this->aux_addLinkToDimension($dimensionLabel, $parameters, '' != $invisibleSpanIni);
            }

            $dimensionDisplayString = $invisibleSpanIni . $dimensionLabel . $invisibleSpanEnd;

            $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : ''; 

            $htmlCode .= <<<SCEOT
        <td class="{$cellBaseCss} {$dimensionAlign} {$this->SC_APP_info['css'] ['fixed_column_field']} {$fixedColCountCss} {$valignTop}"{$colSpan}{$rowSpan}>{$dimensionDisplayString}</td>

SCEOT;

            $this->SC_APP_data['fixed_col_count']++;
        }

        return $htmlCode;
    }

    function display_rows_dimensions_nonTabular($dimensionIndex, $dimensionValue, $parameters, $isComparisonRow)
    {
        $dimensionLabel = $this->aux_getDimensionValueLabel('y', $dimensionIndex, $dimensionValue);
        $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$dimensionIndex];
        $dimensionTab = str_repeat("&nbsp; &nbsp; &nbsp;", $dimensionIndex);

        $rowSpan = '';
        $valignTop = '';
        if ($this->aux_isComparison() && $isComparisonRow) {
            return '';
        } elseif ($this->aux_isComparison()) {
            $rowSpan = ' rowspan="3"';
            $valignTop = $this->SC_APP_info['css'] ['valign_top'];
        }

        if ($this->SC_APP_info['dimension'] [$dimensionName] ['show_link']) {
            $this->aux_addLinkToDimension($dimensionLabel, $parameters, false);
        }

        $cellLabel = $dimensionTab . $dimensionLabel; 
        $baseCss = $this->SC_APP_info['css'] ['data_visible'];

        $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : '';
 
        $htmlCode = <<<SCEOT
        <td class="{$baseCss} {$this->SC_APP_info['css'] ['fixed_column_field']} {$fixedColCountCss} {$valignTop}"{$rowSpan}>{$cellLabel}</td>
SCEOT;

        $this->SC_APP_data['fixed_col_count']++;

        return $htmlCode;
    }

    function display_rows_metrics($rowDimensionValues, $comparisonArrayIndex)
    {
        if ($this->aux_hasXAxysDimensionField()) {
            $htmlCode = '';

            foreach ($this->SC_APP_data['ordered_x_matrix'] [ $this->SC_APP_data['dimension_count'] ['x'] - 1 ] as $colDimensionInfo) {
                $htmlCode .= $this->display_rows_metrics_item($colDimensionInfo['dimensions'], $rowDimensionValues, $comparisonArrayIndex); 
            }

            return $htmlCode;
        } else {
            return $this->display_rows_metrics_item([], $rowDimensionValues, $comparisonArrayIndex);
        }
    }

    function display_rows_metrics_item($colDimensionValues, $rowDimensionValues, $comparisonArrayIndex)
    {
        $rowDimensionCount = count($rowDimensionValues);
        $chartDimensionName = 0 < $rowDimensionCount ? $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$rowDimensionCount] : ''; 

        $metricArray = $this->aux_getMetricArray($colDimensionValues, $rowDimensionValues);
        $previousMetricArray = [];
        if ($this->SC_APP_info['options'] ['show_percentuals'] && 0 < $rowDimensionCount) {
            $previousMetricArray = $this->aux_getPreviousMetricArray($colDimensionValues, $rowDimensionValues);
        }

        $evenOddCss = $this->SC_APP_data['css_line_count'] % 2 ? $this->SC_APP_info['css'] ['data_odd'] : $this->SC_APP_info['css'] ['data_even'];

        $htmlCode = '';

        if (0 == $rowDimensionCount) {
            $isChartLevel = false;
        } elseif ($this->SC_APP_data['dimension_count'] ['y'] == $rowDimensionCount) {
            $isChartLevel = false;
        } else {
            $isChartLevel = true;
        }

        foreach ($this->SC_APP_info['group_by'] ['metric'] as $metricName) {
            $metricCss = $this->SC_APP_info['metric'] [$metricName] ['css_class'];

            if (0 == $rowDimensionCount) {
                $cellBaseCss = $this->SC_APP_info['css'] ['data_total'];
            } elseif ($this->aux_isTabular() && $rowDimensionCount < $this->SC_APP_data['dimension_count'] ['y']) {
                $cellBaseCss = $this->SC_APP_info['css'] ['data_subtotal'];
            } else {
                $cellBaseCss = $evenOddCss;
            }

            list($formattedValue, $percentualValue) = $this->aux_formatValueAndPercentual($comparisonArrayIndex, $metricArray, $previousMetricArray, $metricName);

            if ($isChartLevel && $this->SC_APP_info['chart'] [$chartDimensionName] [$metricName] ['has_chart']) {
                $chartIcon = $this->aux_addChart($chartDimensionName, $metricName, $colDimensionValues, $rowDimensionValues, self::GROUPBY_ORIGINAL != $comparisonArrayIndex);
            } else {
                $chartIcon = '';
            }

            $finalLabel = $this->display_rows_metrics_item_labelHtml($metricName, $formattedValue, $percentualValue, $chartIcon);

            $htmlCode .= <<<SCEOT
        <td class="{$cellBaseCss} {$metricCss}">{$finalLabel}</td>

SCEOT;
        }

        return $htmlCode; 
    }

    function display_rows_metrics_item_labelHtml($metricName, $formattedValue, $percentualValue, $chartIcon)
    {
        if ($this->SC_APP_info['metric'] [$metricName] ['show_percentuals_below']) {
            $displayValue = $formattedValue;
        } else {
            $displayValue = $formattedValue . $percentualValue;
        }

        if ('' == $chartIcon) {
            $spanLabel = $displayValue;
        } elseif ('right' == $this->SC_APP_info['options'] ['chart_icon_position_data']) {
            $spanLabel = "<span>{$displayValue}&nbsp;{$chartIcon}</span>";
        } else {
            $spanLabel = "<span>{$chartIcon}&nbsp;{$displayValue}</span>";
        }

        if ($this->SC_APP_info['metric'] [$metricName] ['show_percentuals_below']) {
            $spanLabel .= $percentualValue;
        }

        return $spanLabel;
    }

    function display_rows_total($rowDimensionValues, $comparisonArrayIndex)
    {
        if (!$this->aux_hasXAxysDimensionField() || !$this->SC_APP_info['options'] ['display_total_column']) {
            return '';
        }

        $htmlCode = '';

        $metricArray = $this->aux_getLineMetricArray($rowDimensionValues);
        $previousMetricArray = [];
        if ($this->SC_APP_info['options'] ['show_percentuals'] && 0 < count($rowDimensionValues)) {
            $previousMetricArray = $this->aux_getPreviousLineMetricArray($rowDimensionValues);
        }

        foreach ($this->SC_APP_info['group_by'] ['metric'] as $metricName) {
            $metricCss = $this->SC_APP_info['metric'] [$metricName] ['css_class'];

            list($formattedValue, $percentualValue) = $this->aux_formatValueAndPercentual($comparisonArrayIndex, $metricArray, $previousMetricArray, $metricName);

            $htmlCode .= <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['data_total']} {$metricCss}">{$formattedValue}{$percentualValue}</td>

SCEOT;
        }

        return $htmlCode;
    }

    function display_totals()
    {
        if (!$this->SC_APP_info['options'] ['display_total_row']) {
            return '';
        }
        if (!$this->aux_hasYAxysDimensionField()) {
            return '';
        }
        if ('no' == $this->SC_APP_info['options'] ['display_summary_total']) {
            return '';
        }
        if ('last_page' == $this->SC_APP_info['options'] ['display_summary_total'] && $this->aux_hasPagination() && $this->SC_APP_data['pagination'] ['page_link_actual'] != $this->SC_APP_data['pagination'] ['page_count']) {
            return '';
        }

        $htmlCode = $this->display_totals_thisRow(self::GROUPBY_ORIGINAL, false);
        if ($this->aux_isComparison()) {
            $htmlCode .= $this->display_totals_thisRow(self::GROUPBY_COMPARISON, true);
            $htmlCode .= $this->display_totals_thisRow(self::GROUPBY_PERC_CHANGE, true);
        }

        return $htmlCode;
    }

    function display_totals_thisRow($comparisonArrayIndex, $isComparisonRow)
    {
        $htmlCode = <<<SCEOT
    <tr class="{$this->SC_APP_info['css'] ['data_row']}">

SCEOT;
        $htmlCode .= $this->display_totals_rowCount($isComparisonRow);
        $htmlCode .= $this->display_totals_dimensions($isComparisonRow);
        $htmlCode .= $this->display_totals_comparison($comparisonArrayIndex);
        $htmlCode .= $this->display_rows_metrics([], $comparisonArrayIndex);
        $htmlCode .= $this->display_totals_total($comparisonArrayIndex);
        $htmlCode .= <<<SCEOT
    </tr>

SCEOT;

        return $htmlCode;
    }

    function display_totals_rowCount($isComparisonRow)
    {
        if (!$this->SC_APP_info['options'] ['display_seq']) {
            return '';
        }

        $rowSpan = '';
        $valignTop = '';
        if ($this->aux_isComparison() && $isComparisonRow) {
            return '';
        } elseif ($this->aux_isComparison()) {
            $rowSpan = ' rowspan="3"';
            $valignTop = $this->SC_APP_info['css'] ['valign_top'];
        }

        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['data_visible']} {$this->SC_APP_info['css'] ['data_seq']} {$this->SC_APP_info['css'] ['fixed_column_op']} {$this->SC_APP_info['css'] ['fixed_column_op_seq']} {$this->SC_APP_info['css'] ['fixed_column_is_fixed']} {$valignTop}"{$rowSpan}>&nbsp;</td>

SCEOT;

        return $htmlCode;
    }

    function display_totals_dimensions($isComparisonRow)
    {
        $colSpan = $this->aux_isTabular() ? ' colspan="' . $this->SC_APP_data['dimension_count'] ['y'] . '"' : '';

        $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : ''; 

        $rowSpan = '';
        $valignTop = '';
        if ($this->aux_isComparison() && $isComparisonRow) {
            return '';
        } elseif ($this->aux_isComparison()) {
            $rowSpan = ' rowspan="3"';
            $valignTop = $this->SC_APP_info['css'] ['valign_top'];
        }

        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['data_even']} {$this->SC_APP_info['css'] ['fixed_column_field']} {$fixedColCountCss} {$valignTop}"{$colSpan}{$rowSpan}>{$this->Ini->Nm_lang['lang_msgs_totl']}</td>

SCEOT;

        $this->SC_APP_data['fixed_col_count']++;

        return $htmlCode;
    }

    function display_totals_comparison($comparisonArrayIndex)
    {
        if (!$this->aux_isComparison()) {
            return '';
        }

        $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : '';
        $percentualChangeCss = self::GROUPBY_PERC_CHANGE == $comparisonArrayIndex ? $this->SC_APP_info['css'] ['comparison_label'] : ''; 

        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['data_subtotal']} {$this->SC_APP_info['css'] ['fixed_column_field']} {$percentualChangeCss} {$fixedColCountCss}">{$this->SC_APP_data['comparison_labels'] [$comparisonArrayIndex]}</td>

SCEOT;

        $this->SC_APP_data['fixed_col_count']++;

        return $htmlCode;
    }

    function display_totals_total($comparisonArrayIndex)
    {
        if (!$this->aux_hasXAxysDimensionField() || !$this->SC_APP_info['options'] ['display_total_column']) {
            return '';
        }

        return $this->display_rows_metrics_item([], [], $comparisonArrayIndex);
    }

    function display_summaryLine()
    {
        if (!$this->SC_APP_info['options'] ['display_summary_every_page']) {
            return '';
        }
        if ($this->SC_APP_info['options'] ['has_summary_button']) {
            return '';
        }
        if (!$this->aux_hasPagination()) {
            return '';
        }

        $colspanInfo = $this->aux_getSummaryColspanInfo();
        if (1 < $colspanInfo['total']) {
            $colspan = " colspan=\"{$colspanInfo['total']}\"";
        } else {
            $colspan = '';
        }

        $summaryLabel = str_replace(
            [
                '?start?',
                '?final?',
                '?total?'
            ],
            [
                $this->SC_APP_data['pagination'] ['first'],
                $this->SC_APP_data['pagination'] ['last'],
                $this->SC_APP_data['pagination'] ['record_count']
            ],
            $this->SC_APP_info['options'] ['display_summary_label']
        );

        $htmlCode = <<<SCEOT
<tr id="summary_body_summary"><td class="{$this->SC_APP_info['css'] ['summary_container']}"{$colspan}>
<table style="width: 100%">
    <tr class="{$this->SC_APP_info['css'] ['summary_line']}">
        <td class="{$this->SC_APP_info['css'] ['summary_font']}" style="text-align: center">
            <span id="res_summary_line">[{$summaryLabel}]</span>
        </td>
    </tr>
</table>
</td></tr>

SCEOT;

        return $htmlCode;
    }

    function display_css()
    {
        global $nm_saida;

        $cssCode = <<<SCEOT
<style>
#sc-ui-summary-body {
    width: 100%;
}
.sc-summary-metric-percentage {
    font-size: 75%;
}
.sc-align-left {
    text-align: left;
}
.sc-align-center {
    text-align: center;
}
.sc-align-right {
    text-align: right;
}
.sc-valign-top {
    vertical-align: top;
}
.sc-comparison-label {
    font-weight: bold;
}
.sc-comparison-color-down {
    color: {$this->SC_APP_info['options'] ['comparison_change_negative_color']};
}
.sc-comparison-color-up {
    color: {$this->SC_APP_info['options'] ['comparison_change_positive_color']};
}

SCEOT;
        $cssCode .= $this->display_css_negativeColors();
        $cssCode .= <<<SCEOT
</style>

SCEOT;

        $nm_saida->saida($cssCode);
    }

    function display_css_negativeColors()
    {
        $cssCode = <<<SCEOT
SCEOT;

        return $cssCode;
    }

    function display_js()
    {
        global $nm_saida;

        $jsCode = <<<SCEOT
<script>

SCEOT;
        $jsCode .= $this->display_js_chart();
        $jsCode .= $this->display_js_order();
        $jsCode .= $this->display_js_pagination();
        $jsCode .= <<< SCEOT
</script>

SCEOT;

        $nm_saida->saida($jsCode);
    }

    function display_js_chart()
    {
        $scPage = NM_encode_input($this->Ini->sc_page);
        $ajaxUrl = "{$this->Ini->path_link}grid_agenda_cliente/index.php";
        $isInlineChart = $this->aux_hasInlineChart() ? 'true' : 'false';

        $jsCode = <<<SCEOT
let scChartIsInline = {$isInlineChart};
let scChartInlineMd5 = "";
let scChartIsEmpty = false;

function scChart_display(chartMd5)
{

SCEOT;
        if ($this->aux_hasInlineChart()) {
            $jsCode.= <<<SCEOT
    scChart_display_inline(chartMd5);

SCEOT;
        } else {
            $jsCode.= <<<SCEOT
    scChart_display_newPage(chartMd5);

SCEOT;
        }
        $jsCode.= <<<SCEOT
}

function scChart_update_inline()
{
    if (scChartIsInline) {
        if (scChartIsEmpty) {
            if (typeof scFusionCharts != "undefined") {
                scFusionCharts.dispose();
            }
        } else {
            scChart_display_inline(scChartInlineMd5);
        }
    }
}

function scChart_display_inline(chartMd5)
{
    scChartInlineMd5 = chartMd5;

    $.ajax({
        type: "POST",
        url: "{$ajaxUrl}",
        dataType: "json",
        data: {
            nmgp_opcao: "grafico",
            script_case_init: "{$scPage}",
            chart_inline_update: "Y",
            chart_md5: chartMd5,
        }
    }).done(function(data) {
        if (typeof scFusionCharts != "undefined") {
            scFusionCharts.dispose();
        }
        scFusionCharts_create(data.chartType, data.chartUrl, data.chartWidth, data.chartHeight);
        let scrollTarget = $("#sc-summary-chart-container").find("div");
        if (scrollTarget.length) {
            $('html, body').stop().animate({
                scrollTop: scrollTarget.offset().top
            }, 500);
        }        
    });
}

function scChart_display_newPage(chartMd5)
{

SCEOT;
        if ($this->SC_APP_info['options'] ['chart_new_page']) {
            $jsCode .= <<<SCEOT
    let oldAction = document.Fgraf.action;
    let oldTarget = document.Fgraf.target;
    document.Fgraf.action = nm_url_rand(document.Fgraf.action);
    document.Fgraf.target = "_blank";

SCEOT;
        }
        $jsCode .= <<<SCEOT
    document.Fgraf.summary_chart.value = 'Y';
    document.Fgraf.chart_md5.value = chartMd5;
    document.Fgraf.submit();

SCEOT;
        if ($this->SC_APP_info['options'] ['chart_new_page']) {
            $jsCode .= <<<SCEOT
    document.Fgraf.action = oldAction;
    document.Fgraf.target = oldTarget;

SCEOT;
        }
        $jsCode .= <<<SCEOT
}


SCEOT;

        return $jsCode;
    }

    function display_js_order()
    {
        $jsCode = <<<SCEOT
$(function() {
    scOrder_addClickControl();
});

function scOrder_addClickControl()
{
    scOrder_addClickControl_dimension();
    scOrder_addClickControl_metric();
}

function scOrder_addClickControl_dimension()
{
    $(".sc-ui-sort-dimension").on("mouseover", function() {
        $(this).css("cursor", "pointer");
    }).on("click", function() {
        let newOrder, clickedDimension;
        if ($(this).hasClass("sc-ui-sort-asc")) {
            newOrder = "desc";
        } else {
            newOrder = "asc";
        }
        clickedDimension = $(this).data("orderDimension");
        scChangeSummarySort("dimension", clickedDimension, newOrder);
    });
}

function scOrder_addClickControl_metric()
{
    $(".sc-ui-sort-metric").on("mouseover", function() {
        $(this).css("cursor", "pointer");
    }).on("click", function() {
        let newOrder, clickedMetric, iconObj;
        iconObj = $("#" + $(this).data("orderId"));
        if (iconObj.find(".sc-summary-order-icon").hasClass("sc-summary-order-icon-unused")) {
            newOrder = "asc";
        } else if (iconObj.hasClass("sc-ui-sort-asc")) {
            newOrder = "desc";
        } else {
            newOrder = "";
        }
        clickedMetric = $(this).data("orderMetric");
        scChangeSummarySort("metric", clickedMetric, newOrder);
    });
}

function scChangeSummarySort(option, field, order)
{
    let orderChangeParameters = new Array();
    orderChangeParameters.push("change_" + option + "_sort" + "*scin" + "Y");
    orderChangeParameters.push(option + "*scin" + field);
    orderChangeParameters.push("new_order" + "*scin" + order);

    nm_gp_submit_ajax("resumo", orderChangeParameters.join("*scout"));
}


SCEOT;

        return $jsCode;
    }

    function display_js_pagination()
    {
        $jsCode = <<<SCEOT
let scPag_first = {$this->SC_APP_data['pagination'] ['first']};
let scPag_last = {$this->SC_APP_data['pagination'] ['last']};
let scPag_back = {$this->SC_APP_data['pagination'] ['back']};
let scPag_forward = {$this->SC_APP_data['pagination'] ['forward']};
let scPag_count = {$this->SC_APP_data['pagination'] ['record_count']};
let scPag_length = {$this->SC_APP_data['pagination'] ['length']};
let scPag_pageCount = {$this->SC_APP_data['pagination'] ['page_count']};

function scPagination_navigation_control()
{
    if ("string" == typeof scPag_first) {
        scPag_first = parseInt(scPag_first);
    }
    if ("string" == typeof scPag_last) {
        scPag_last = parseInt(scPag_last);
    }
    if ("string" == typeof scPag_back) {
        scPag_back = parseInt(scPag_back);
    }
    if ("string" == typeof scPag_forward) {
        scPag_forward = parseInt(scPag_forward);
    }

    if (1 < scPag_first) {
        scPagination_navigation_back('enable');
    } else {
        scPagination_navigation_back('disable');
    }
    if (scPag_count > scPag_last) {
        scPagination_navigation_forward('enable');
    } else {
        scPagination_navigation_forward('disable');
    }
}

function scPagination_navigation_back(operation)
{
    if ('enable' == operation) {
        $("#res_first_top").removeClass("disabled");
        $("#res_back_top").removeClass("disabled");
        $("#res_first_bot").removeClass("disabled");
        $("#res_back_bot").removeClass("disabled");
    } else {
        $("#res_first_top").addClass("disabled");
        $("#res_back_top").addClass("disabled");
        $("#res_first_bot").addClass("disabled");
        $("#res_back_bot").addClass("disabled");
    }
}

function scPagination_navigation_forward(operation)
{
    if ('enable' == operation) {
        $("#res_last_top").removeClass("disabled");
        $("#res_forward_top").removeClass("disabled");
        $("#res_last_bot").removeClass("disabled");
        $("#res_forward_bot").removeClass("disabled");
    } else {
        $("#res_last_top").addClass("disabled");
        $("#res_forward_top").addClass("disabled");
        $("#res_last_bot").addClass("disabled");
        $("#res_forward_bot").addClass("disabled");
    }
}

function scChangePagination(option, value)
{
    let paginationChangeParameters = new Array();
    paginationChangeParameters.push("change_" + option + "_pagination" + "*scin" + "Y");
    paginationChangeParameters.push(option + "*scin" + value);

    nm_gp_submit_ajax("resumo", paginationChangeParameters.join("*scout"));
}


SCEOT;

        return $jsCode;
    }

    function display_export_charts()
    {
        if ($this->aux_displayPdfCharts()) {
            $this->display_pdf_charts();
        } elseif ($this->aux_displayPrintCharts()) {
            $this->display_print_charts();
        }

    }

    function display_pdf_charts()
    {
        global $nm_saida;

        $chartCount = 1;
        $chartTotal = count($this->SC_APP_data['chart_md5_list']);
        $chartLang = isset($this->Ini->Nm_lang['lang_pdff_pcht']) ? $this->Ini->Nm_lang['lang_pdff_pcht'] : 'Generating chart';
        $chartFP = true;

        if (!isset($this->progress_fp) || !$this->progress_fp) {
            $chartFP = true;
            $progressBarFile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
            $this->progress_fp = fopen($progressBarFile, 'a');
            $this->progress_tot = 100;
            $this->progress_now = 90;
            $this->progress_res = 0;
        }

        $htmlCode = <<<SCEOT
</table></td></tr></table>

<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>
<b><div style="height:1px; overflow:hidden"><H1 style="font-size:0; padding:1px">{$this->Ini->Nm_lang['lang_btns_chrt_pdff_hint']}</H1></div></b>

SCEOT;

        $firstChart = true;
        foreach ($this->SC_APP_data['chart_md5_list'] as $chartInfo) {
            if ($this->progress_fp) {
                grid_agenda_cliente_pdf_progress_call($this->progress_tot . "_#NM#_" . $this->progress_now . "_#NM#_" . $chartLang . " " . $chartCount . "/" . $chartTotal . "...\n", $this->Ini->Nm_lang, true);
                fwrite($this->progress_fp, $this->progress_now . "_#NM#_" . $chartLang . " " . $chartCount . "/" . $chartTotal . "...\n");
                $chartCount++;
                if (0 < $this->progress_res) {
                    $this->progress_now++;
                }
            }

            $chartImage = $this->aux_generatePhantomImage($chartInfo['md5']);

            $chartTitle = $chartInfo['title'];
            if ('' != $chartInfo['subtitle']) {
                $chartTitle .= ' - ' . $chartInfo['subtitle'];
            }
            if ('UTF-8' != $_SESSION['scriptcase'] ['charset']) {
                $chartTitle = sc_convert_encoding($chartTitle, $_SESSION['scriptcase'] ['charset'], 'UTF-8');
            }
            $bookmarkTitle = str_replace(' ', '&nbsp;', $chartTitle);
            $chartId = 'sc-id-h2-' . md5(session_id() . microtime() . rand(1, 1000));

            if (!$firstChart) {
                $htmlCode .= <<<SCEOT
<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>

SCEOT;
            }
            $htmlCode .= <<<SCEOT
<table><tr><td>
    <b><h2 id="$chartId">$bookmarkTitle</h2></b>
    <img src="{$chartImage}" />
</td></tr></table>

SCEOT;

            $firstChart = false;
        }

        if ($chartFP) {
            $pdfGenerateLang = $this->Ini->Nm_lang['lang_pdff_gnrt'];
            if (!NM_is_utf8($pdfGenerateLang)) {
                $pdfGenerateLang = sc_convert_encoding($pdfGenerateLang, "UTF-8", $_SESSION['scriptcase'] ['charset']);
            }
            grid_agenda_cliente_pdf_progress_call(100 . "_#NM#_" . 90 . "_#NM#_" . $pdfGenerateLang . "...
", $this->Ini->Nm_lang);
            fwrite($this->progress_fp, 90 . "_#NM#_" . $pdfGenerateLang . "...
");
            fclose($this->progress_fp);
        }

        $nm_saida->saida($htmlCode);
    }

    function display_print_charts()
    {
        global $nm_saida;

        $this->getChartInstance();

        $htmlCode = <<<SCEOT
</table></td></tr></table>

<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>
<b><div style="height:1px; overflow:hidden"><H1 style="font-size:0; padding:1px">{$this->Ini->Nm_lang['lang_btns_chrt_pdff_hint']}</H1></div></b>

SCEOT;

        $htmlCode .= $this->Graf->display_chart_htmlFusionChartsLibrary('pdf');

        $firstChart = true;
        foreach ($this->SC_APP_data['chart_md5_list'] as $chartInfo) {
            $this->Graf->info_initializeData();
            $this->Graf->info_initializeChart($chartInfo['md5'], true);

            $chartTitle = $chartInfo['title'];
            if ('' != $chartInfo['subtitle']) {
                $chartTitle .= ' - ' . $chartInfo['subtitle'];
            }
            if ('UTF-8' != $_SESSION['scriptcase'] ['charset']) {
                $chartTitle = sc_convert_encoding($chartTitle, $_SESSION['scriptcase'] ['charset'], 'UTF-8');
            }
            $bookmarkTitle = str_replace(' ', '&nbsp;', $chartTitle);
            $chartId = 'sc-id-h2-' . md5(session_id() . microtime() . rand(1, 1000));

            if (!$firstChart) {
                $htmlCode .= <<<SCEOT
<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>

SCEOT;
            }
            $htmlCode .= <<<SCEOT
<table><tr><td>
    <b><h2 id="$chartId">$bookmarkTitle</h2></b>

SCEOT;
            $htmlCode .= $this->Graf->display_chart_htmlFusionChartsDiv_newPage();
            $htmlCode .= $this->Graf->display_chart_htmlFusionChartsJavascript_phantom();
            $htmlCode .= <<<SCEOT
</td></tr></table>

SCEOT;

            $firstChart = false;
        }

        $nm_saida->saida($htmlCode);
    }

    function aux_addChart($dimensionName, $metricName, $colDimensionValues, $rowDimensionValues, $isComparisonRow)
    {
        if (!$this->aux_hasCharts()) {
            return '';
        } elseif ($isComparisonRow) {
            return '';
        }

        $dimensionArrayName = $this->SC_APP_info['dimension'] [$dimensionName] ['summary_values_array'];
        $dimensionArray = $this->$dimensionArrayName;

        $hasNextDimension = false;
        if ($this->SC_APP_info['options'] ['chart_has_analytical']) {
            $nextDimensionOrderPosition = array_search($dimensionName, $this->SC_APP_info['group_by'] ['dimension'] ['order']) + 1;

            if (count($this->SC_APP_info['group_by'] ['dimension'] ['order']) > $nextDimensionOrderPosition) {
                $hasNextDimension = true;

                $nextDimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['order'] [$nextDimensionOrderPosition];
                $nextDimensionArrayName = $this->SC_APP_info['dimension'] [$nextDimensionName] ['summary_values_array'];
                $nextDimensionArray = $this->$nextDimensionArrayName;
            }
        }

        $chartParameters = [];
        foreach ($colDimensionValues as $dimensionIndex => $thisParameter) {
            $dimensionArray = $dimensionArray[$thisParameter];
            if ($hasNextDimension) {
                $nextDimensionArray = $nextDimensionArray[$thisParameter];
            }

            $thisDimension = $this->SC_APP_info['group_by'] ['dimension'] ['x'] [$dimensionIndex];
            $chartParameters[] = [
                'name' => $thisDimension,
                'field_label' => $this->SC_APP_info['dimension'] [$thisDimension] ['label'],
                'value' => $thisParameter,
                'label' => $this->SC_APP_data['dimension_value_labels'] [$thisDimension] [$thisParameter],
            ];
        }
        foreach ($rowDimensionValues as $dimensionIndex => $thisParameter) {
            $dimensionArray = $dimensionArray[$thisParameter];
            if ($hasNextDimension) {
                $nextDimensionArray = $nextDimensionArray[$thisParameter];
            }

            $thisDimension = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$dimensionIndex];
            $chartParameters[] = [
                'name' => $thisDimension,
                'field_label' => $this->SC_APP_info['dimension'] [$thisDimension] ['label'],
                'value' => $thisParameter,
                'label' => $this->SC_APP_data['dimension_value_labels'] [$thisDimension] [$thisParameter],
            ];
        }

        $originalValues = [];
        $comparisonValues = [];
        $analyticValues = [];

        $orderArray = $this->SC_APP_data['ordered_y_axys'];

        foreach ($rowDimensionValues as $dimensionValue) {
            $orderArray = $orderArray[$dimensionValue] ['children'];
        }
        foreach ($orderArray as $dimensionValue => $dimensionInfo) {
            $dimensionLabel = $this->SC_APP_data['dimension_value_labels'] [ $dimensionInfo['dimension'] ] [$dimensionValue];

            $originalValues[$dimensionValue] = [
                'label' => $dimensionLabel,
                'value' => 0,
            ];

            if ($this->aux_isComparison()) {
                $comparisonValues[$dimensionValue] = [
                    'label' => $dimensionLabel,
                    'value' => 0,
                ];
            }
        }

        if ($hasNextDimension) {
            $analyticValues = [
                'set' => [
                    'field_name' => [
                        'x_axys' => '',
                        'legend' => '',
                    ],
                    'categories' => [],
                    'dataset' => [],
                ],
                'serie' => [
                    'field_name' => [
                        'x_axys' => '',
                        'legend' => '',
                    ],
                    'categories' => [],
                    'dataset' => [],
                ]
            ];
        }

        foreach ($dimensionArray as $metricArray) {
            $dimensionValue = $metricArray[self::GROUPBY_ORIGINAL] [self::TOTAL_ARRAY_VALUE_INDEX];
            $dimensionLabel = $metricArray[self::GROUPBY_ORIGINAL] [self::TOTAL_ARRAY_LABEL_INDEX];

            $originalValues[$dimensionValue] = [
                'label' => $dimensionLabel,
                'value' => $metricArray[self::GROUPBY_ORIGINAL] [ $this->SC_APP_info['metric'] [$metricName] ['value_index'] ],
            ];

            if ($this->aux_isComparison()) {
                $comparisonValues[$dimensionValue] = [
                    'label' => $dimensionLabel,
                    'value' => $metricArray[self::GROUPBY_COMPARISON] [ $this->SC_APP_info['metric'] [$metricName] ['value_index'] ],
                ];
            }

            if ($hasNextDimension) {
                $analyticValues['set'] ['field_name'] ['x_axys'] = $this->SC_APP_info['dimension'] [$dimensionName] ['label'];
                $analyticValues['set'] ['field_name'] ['legend'] = $this->SC_APP_info['dimension'] [$nextDimensionName] ['label'];
                $analyticValues['serie'] ['field_name'] ['x_axys'] = $this->SC_APP_info['dimension'] [$nextDimensionName] ['label'];
                $analyticValues['serie'] ['field_name'] ['legend'] = $this->SC_APP_info['dimension'] [$dimensionName] ['label'];

                foreach ($nextDimensionArray[$dimensionValue] as $nextMetricArray) {
                    $nextDimensionValue = $nextMetricArray[self::GROUPBY_ORIGINAL] [self::TOTAL_ARRAY_VALUE_INDEX];
                    $nextDimensionLabel = $nextMetricArray[self::GROUPBY_ORIGINAL] [self::TOTAL_ARRAY_LABEL_INDEX];
                    if (!isset($analyticValues['set'] ['categories'] [$dimensionValue])) {
                        $analyticValues['set'] ['categories'] [$dimensionValue] = $dimensionLabel;
                    }
                    if (!isset($analyticValues['set'] ['dataset'] [$nextDimensionValue])) {
                        $analyticValues['set'] ['dataset'] [$nextDimensionValue] = [
                            'label' => $nextDimensionLabel,
                            'data' => [],
                        ];
                    }
                    $analyticValues['set'] ['dataset'] [$nextDimensionValue] ['data'] [$dimensionValue] = [
                        'label' => $dimensionLabel,
                        'value' => $nextMetricArray[self::GROUPBY_ORIGINAL] [ $this->SC_APP_info['metric'] [$metricName] ['value_index'] ],
                    ];
                }

                $nextDimensionValues = [];
                foreach ($nextDimensionArray[$dimensionValue] as $nextMetricArray) {
                    $nextDimensionValue = $nextMetricArray[self::GROUPBY_ORIGINAL] [self::TOTAL_ARRAY_VALUE_INDEX];
                    $nextDimensionLabel = $nextMetricArray[self::GROUPBY_ORIGINAL] [self::TOTAL_ARRAY_LABEL_INDEX];
                    if (!isset($analyticValues['serie'] ['categories'] [$nextDimensionValue])) {
                        $analyticValues['serie'] ['categories'] [$nextDimensionValue] = $nextDimensionLabel;
                    }
                    $nextDimensionValues[$nextDimensionValue] = [
                        'label' => $nextDimensionLabel,
                        'value' => $nextMetricArray[self::GROUPBY_ORIGINAL] [ $this->SC_APP_info['metric'] [$metricName] ['value_index'] ],
                    ];
                }
                $analyticValues['serie'] ['dataset'] [$dimensionValue] = [
                    'label' => $dimensionLabel,
                    'data' => $nextDimensionValues,
                ];
            }
        }

        $chartInfo = [
            'options' => [
                'is_comparison' => false,
                'has_analytic' => $hasNextDimension,
                'comparison_field_label' => '',
                'limit_chart_items' => $this->SC_APP_info['dimension'] [$dimensionName] ['limit_chart_items'],
                'series_name' => [],
            ],
            'dimension' => [
                'field' => $dimensionName,
                'label' => $this->SC_APP_info['dimension'] [$dimensionName] ['label'],
            ],
            'metric' => [
                'field' => $metricName,
                'label' => $this->SC_APP_info['metric'] [$metricName] ['label'],
            ],
            'parameters' => $chartParameters,
            'data_synthetic' => [
                self::GROUPBY_ORIGINAL => $originalValues,
            ],
            'data_analytic' => $analyticValues,
        ];
        if ($this->aux_isComparison()) {
            $chartInfo['data_synthetic'] [self::GROUPBY_COMPARISON] = $comparisonValues;
            $chartInfo['options'] ['is_comparison'] = true;
            $chartInfo['options'] ['comparison_field_label'] = $this->SC_APP_data['comparison_labels'] ['comparison_field'];
            
            $chartInfo['options'] ['series_name'] [self::GROUPBY_ORIGINAL] = $this->SC_APP_data['comparison_labels'] [self::GROUPBY_ORIGINAL];
            $chartInfo['options'] ['series_name'] [self::GROUPBY_COMPARISON] = $this->SC_APP_data['comparison_labels'] [self::GROUPBY_COMPARISON];
        }

        $chartMd5 = $this->aux_addChart_getMd5($chartInfo);
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['chart_info'] [$chartMd5] = $chartInfo;

        if (0 == count($colDimensionValues) && 0 == count($rowDimensionValues) && '' == $this->SC_APP_data['chart_md5_initial']) {
            $this->SC_APP_data['chart_md5_initial'] = $chartMd5;
        }
        $this->SC_APP_data['chart_md5_list'] [] = [
            'md5' => $chartMd5,
            'title' => $this->SC_APP_info['metric'] [$metricName] ['label'],
            'subtitle' => $this->aux_addChart_subtitle($chartParameters)
        ];

        if ($this->aux_isPdf() || $this->aux_isPrint()) {
            return '';
        } else {
            return trim(nmButtonOutput($this->arr_buttons, "bgraf", "scChart_display('{$chartMd5}')", "scChart_display('{$chartMd5}')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "{$this->SC_APP_info['dimension'] [$dimensionName] ['label']} X {$this->SC_APP_info['metric'] [$metricName] ['label']}", "", "", "", "only_text", "text_right", "", "", "", "", "", "", ""));
        }
    }

    function aux_addChart_getMd5($chartInfo)
    {
        $identifierParameters = [];
        foreach ($chartInfo['parameters'] as $parameterInfo) {
            $identifierParameters[] = $parameterInfo['value'];
        }

        $identifier = $chartInfo['dimension'] ['field'] . '_X_' . $chartInfo['metric'] ['field'] . '__' . implode('|', $identifierParameters);

        return md5($identifier);
    }

    function aux_addChart_subtitle($chartParameters)
    {
        $parameters = [];

        foreach ($chartParameters as $parameterInfo) {
            $parameters[] = "{$parameterInfo['field_label']} = {$parameterInfo['label']}";
        }

        return implode(' :: ', $parameters);
    }

    function aux_addLinkToDimension(&$dimensionLabel, $parameters, $isInvisible)
    {
        if ($this->aux_isPdf() || $this->aux_isPrint()) {
            return;
        }

        $linkCssClass = $isInvisible ? 'scGridSummaryGroupbyInvisibleLink' : 'scGridSummaryGroupbyVisibleLink';
        $linkCall = $this->aux_createLinkInfo($parameters);

        $dimensionLabel = <<<SCEOT
<a class="{$linkCssClass}" href="javascript: nm_link_cons('{$linkCall}')">{$dimensionLabel}</a>
SCEOT;
    }

    function aux_addOrderToDimension($dimensionLabel, $dimensionName)
    {
        if ($this->aux_isPdf() || $this->aux_isPrint()) {
            return [$dimensionLabel, ''];
        } elseif (!$this->SC_APP_info['dimension'] [$dimensionName] ['has_order']) {
            return [$dimensionLabel, ''];
        }

        $sortRule = $this->SC_APP_info['dimension'] [$dimensionName] ['order_by_direction'];
        $sortIcon = $this->aux_getDimensionOrderIcon($dimensionName, $sortRule);

        if (in_array($dimensionName, $this->SC_APP_info['options'] ['order_metric_apply_to_dimensions'])) {
            $sortClassMetricApplied = 'sc-ui-sort-metric-applied';
            if ($this->SC_APP_data['metric_order'] ['using']) {
                $sortClassMetricUsing = 'sc-summary-order-icon-unused';
            } else {
                $sortClassMetricUsing = '';
            }
        } else {
            $sortClassMetricApplied = 'sc-ui-sort-metric-not-applied';
            $sortClassMetricUsing = '';
        }

        $dimensionLabel = <<<SCEOT
<span class="{$this->SC_APP_info['css'] ['sort_dimension']} sc-ui-sort-{$sortRule}" data-order-dimension="{$dimensionName}">{$dimensionLabel}</span>
SCEOT;
        $dimensionIcon = <<<SCEOT
<span class="{$this->SC_APP_info['css'] ['sort_dimension']} sc-ui-sort-{$sortRule} {$sortClassMetricApplied} {$sortClassMetricUsing}" data-order-dimension="{$dimensionName}">{$sortIcon}</span>
SCEOT;

        return [$dimensionLabel, $dimensionIcon];
    }

    function aux_addOrderToMetric($metricLabel, $metricName, $parameters)
    {
        if ($this->aux_isPdf() || $this->aux_isPrint()) {
            return [$metricLabel, ''];
        } elseif (!$this->SC_APP_info['metric'] [$metricName] ['has_order']) {
            return [$metricLabel, ''];
        }

        if (!$this->SC_APP_data['metric_order'] ['using']) {
            $sortRule = '';
        } elseif ($this->SC_APP_data['metric_order'] ['name'] != $metricName) {
            $sortRule = '';
        } elseif ($this->SC_APP_data['metric_order'] ['parameters'] != $parameters) {
            $sortRule = '';
        } else {
            $sortRule = $this->SC_APP_data['metric_order'] ['rule'];
        }
        $sortIcon = $this->aux_getDimensionOrderIcon($dimensionName, $sortRule);

        $orderInfo = [
            'metric' => $metricName,
            'parameters' => $parameters,
        ];
        $metricOrderMd5 = md5(serialize($orderInfo));
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['metric_order_info'] [$metricOrderMd5] = $orderInfo;

        $iconId = 'sc-order-icon-' . substr(md5(microtime() . rand(1, 1000) . session_id()), 0, 8);

        $metricLabel = <<<SCEOT
<span class="{$this->SC_APP_info['css'] ['sort_metric']} sc-ui-sort-{$sortRule}" data-order-id="{$iconId}" data-order-metric="{$metricOrderMd5}">{$metricLabel}</span>
SCEOT;
        $metricIcon = <<<SCEOT
<span class="{$this->SC_APP_info['css'] ['sort_metric']} sc-ui-sort-{$sortRule}" data-order-id="{$iconId}" data-order-metric="{$metricOrderMd5}" id="{$iconId}">{$sortIcon}</span>
SCEOT;

        return [$metricLabel, $metricIcon];
    }

    function aux_addPercentualChangeVisual(&$value, $isZero, $isNegative)
    {
        if ($isZero) {
            return;
        }
        if ($isNegative) {
            $value = <<<SCEOT
<span class="{$this->SC_APP_info['css'] ['comparison_color_down']}"><span class="{$this->SC_APP_info['options'] ['comparison_change_negative_icon']}"></span> {$value}</span>
SCEOT;
        } else {
            $value = <<<SCEOT
<span class="{$this->SC_APP_info['css'] ['comparison_color_up']}"><span class="{$this->SC_APP_info['options'] ['comparison_change_positive_icon']}"></span> {$value}</span>
SCEOT;
        }
    }

    function aux_createLinkInfo($parameters)
    {
        $fieldLinkList = [];

        foreach ($parameters as $dimensionIndex => $dimensionValue) {
            $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$dimensionIndex];

            $fieldLinkList[] = $this->SC_APP_info['dimension'] [$dimensionName] ['link_field_var_name']
                              . '?#?'
                              . $this->SC_APP_info['dimension'] [$dimensionName] ['link_protect_string']
                              . addslashes($dimensionValue)
                              . $this->SC_APP_info['dimension'] [$dimensionName] ['link_protect_string'];
        }

        $linkInfo = implode('?@?', $fieldLinkList);
        $linkMd5 = md5($linkInfo);

        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['LigR_Md5'] [$linkMd5] = $linkInfo;

        return '@SC_par@' . NM_encode_input($this->Ini->sc_page) . '@SC_par@grid_agenda_cliente@SC_par@' . $linkMd5;
    }

    function aux_createPaginationDescription()
    {
        $htmlCode = str_replace([
                '?start?',
                '?final?',
                '?total?'
            ], [
                $this->SC_APP_data['pagination'] ['first'],
                $this->SC_APP_data['pagination'] ['last'],
                $this->SC_APP_data['pagination'] ['record_count']
            ], "[{$this->Ini->Nm_lang['lang_othr_smry_info']}]");


        return $htmlCode;
    }

    function aux_createPaginationLinks()
    {
        $htmlCode = '';

        foreach ($this->SC_APP_data['pagination'] ['page_link_list'] as $pageLinkNumber) {
            if ($pageLinkNumber == $this->SC_APP_data['pagination'] ['page_link_actual']) {
                $htmlCode .= <<<SCEOT
            <span class="scGridToolbarNavOpen" style="vertical-align: middle;">{$pageLinkNumber}</span>

SCEOT;
            } else {
                $pageFirstRecord = (($pageLinkNumber - 1) * $this->SC_APP_data['pagination'] ['length']) + 1;

                $htmlCode .= <<<SCEOT
            <a class="scGridToolbarNav" style="vertical-align: middle;" href="javascript: scChangePagination('record', {$pageFirstRecord});">{$pageLinkNumber}</a>

SCEOT;
            }
        }

        return $htmlCode;
    }

    function aux_displayPdfCharts()
    {
        if (!$this->aux_isPdf()) {
            return false;
        } elseif (isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['skip_charts']) && $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['skip_charts']) {
            return false;
        } elseif (0 == count($this->SC_APP_data['chart_md5_list'])) {
            return false;
        }

        return true;
    }

    function aux_displayPrintCharts()
    {
        if (!$this->aux_isPrint()) {
            return false;
        } elseif (isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['skip_charts']) && $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['skip_charts']) {
            return false;
        } elseif (0 == count($this->SC_APP_data['chart_md5_list'])) {
            return false;
        }

        return true;
    }

    function aux_format_valor_total_S($value)
    {
        $isNegative = 0 > $value;
        $suffix = '';

        if ($this->SC_APP_info['options'] ['display_abbreviated_value']) {
            $this->aux_getAbbreviatedValue($value, $suffix);
        }

        nmgp_Form_Num_Val($value, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']);
        $value .= $suffix;

        return $value;
    }

    function aux_format_estado_actual_C($value)
    {
        $isNegative = 0 > $value;
        $suffix = '';

        if ($this->SC_APP_info['options'] ['display_abbreviated_value']) {
            $this->aux_getAbbreviatedValue($value, $suffix);
        }

        nmgp_Form_Num_Val($value, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']);
        $value .= $suffix;

        return $value;
    }

    function aux_formatPercentage($value)
    {
        nmgp_Form_Num_Val($value, $_SESSION['scriptcase'] ['reg_conf'] ['grup_num'], $_SESSION['scriptcase'] ['reg_conf'] ['dec_num'], "2", "S", "2", "");

        return $value . '%'; 
    }

    function aux_formatValueAndPercentual($comparisonArrayIndex, $metricArray, $previousMetricArray, $metricName)
    {
        $formattedValue = '';
        $percentualValue = '';

        $valueIndex = $this->SC_APP_info['metric'] [$metricName] ['value_index'];
        $formatFunction = $this->SC_APP_info['metric'] [$metricName] ['format_function'];
        $percentualSeparator = $this->SC_APP_info['metric'] [$metricName] ['show_percentuals_below'] ? '<br />' : '&nbsp;';

        if (self::GROUPBY_PERC_CHANGE == $comparisonArrayIndex) {
            $initialValue = $metricArray[self::GROUPBY_COMPARISON] [$valueIndex];
            $finalValue = $metricArray[self::GROUPBY_ORIGINAL] [$valueIndex];
            if ('' == $initialValue) {
                $initialValue = 0;
            }
            if ('' == $finalValue) {
                $finalValue = 0;
            }

            if (0 == $initialValue) {
                $formattedValue = '-';
            } else {
                $percentualChange = (($finalValue - $initialValue) / $initialValue) * 100;
                $isZeroPercentual = 0 == $percentualChange;
                $isNegativePercentual = 0 > $percentualChange;
                $formattedValue = $this->aux_formatPercentage($percentualChange);
                $this->aux_addPercentualChangeVisual($formattedValue, $isZeroPercentual, $isNegativePercentual);
            }
        } else {
            $thisMetricValue = $metricArray[$comparisonArrayIndex] [$valueIndex];

            if ($this->SC_APP_info['metric'] [$metricName] ['show_percentuals'] && !$this->SC_APP_info['metric'] [$metricName] ['is_rating']) {
                if (is_array($previousMetricArray) && count($previousMetricArray) && '' != $thisMetricValue) {
                    $previousMetricValue = $previousMetricArray[$comparisonArrayIndex] [$valueIndex];

                    if ('' == $previousMetricValue) {
                        $previousMetricValue = 0;
                    }

                    $percentualValue = 0 == $previousMetricValue ? 0 : ($thisMetricValue / $previousMetricValue) * 100; 
                    $percentualValue = $percentualSeparator . '<span class="' . $this->SC_APP_info['css'] ['percentage_dimension'] . '">(' . $this->aux_formatPercentage($percentualValue) . ')</span>';
                }
            }

            $formattedValue = $this->$formatFunction($thisMetricValue);
        }

        return [$formattedValue, $percentualValue];
    }

    function aux_generatePhantomImage($chartMd5)
    {
        $this->getChartInstance();
        $this->Graf->info_initializeData();
        $this->Graf->info_initializeChart($chartMd5, true);

        $phantomId = md5($chartMd5 . $this->Graf->display_summaryChart_phantom_md5());

        $imageName = "sc_pjs_png_{$phantomId}.png";
        $imageUrlDir = "{$_SESSION['scriptcase'] ['grid_agenda_cliente'] ['glo_nm_path_imag_temp']}/";
        $imageUrlName = $imageUrlDir . $imageName;
        $imageFileDir = $this->Ini->root . $imageUrlDir;
        $imageFileName = $imageFileDir . $imageName;

        $appDirectory = getcwd();
        $appOs = $this->Ini->getRunningOS();

        $phantomJsDelay = $this->SC_APP_info['options'] ['chart_create_time'];
        $phantomCommandLine = "phantomjs --ignore-ssl-errors=true \"{$imageFileDir}sc_pjs_js_{$phantomId}.js\"";
        if ('win' != $appOs['os']) {
            $phantomCommandLine = './' . $phantomCommandLine;
        }

        $isImageGenerated = @is_file($imageFileName);
        $imageSizeLimit = 6 * 1024;
        $imageSize = $isImageGenerated ? @filesize($imageFileName) : 0;

        if (!$isImageGenerated || $imageSize < $imageSizeLimit) {
            $this->aux_generatePhantomJs($phantomId, $imageFileName, $phantomJsDelay);
            $this->aux_generatePhantomPhp($phantomId);

            @chdir($this->Ini->path_third . '/phantomjs/' . $appOs['os']);

            $attempt = 0;
            $imageSize = 0;
            while ($attempt < 3 && $imageSize < $imageSizeLimit) {
                @exec($phantomCommandLine);
                $attempt++;

                $imageSize = @is_file($imageFileName) ? @filesize($imageFileName) : 0;
                if ($imageSize < $imageSizeLimit) {
                    $phantomJsDelay += floor($this->SC_APP_info['options'] ['chart_create_time'] / 2);
                    $this->aux_generatePhantomJs($phantomId, $imageFileName, $phantomJsDelay);
                }
            }

            @chdir($appDirectory);
        }

        return $imageUrlName;
    }

    function aux_generatePhantomJs($phantomId, $imageFileName, $phantomJsDelay)
    {
        $jsCode = <<<SCEOT
var thisPage = require('webpage').create(),
    chartUrl = '{$this->Ini->server_pdf}{$this->Ini->path_imag_temp}/sc_pjs_php_{$phantomId}.html',
    imageFile = '$imageFileName',
    jsDelay = $phantomJsDelay;
thisPage.open(chartUrl, function () {
    window.setTimeout(function () {
        thisPage.render(imageFile);
        phantom.exit();
    }, jsDelay);
});

SCEOT;

        @file_put_contents("{$this->Ini->root}{$_SESSION['scriptcase'] ['grid_agenda_cliente'] ['glo_nm_path_imag_temp']}/sc_pjs_js_{$phantomId}.js", $jsCode);
    }

    function aux_generatePhantomPhp($phantomId)
    {
        $htmlCode = <<<SCEOT
<html>
<head>
    {$_SESSION['nm_session'] ['charset']}

SCEOT;
        $htmlCode .= $this->Graf->display_chart_htmlFusionChartsLibrary('pdf');
        $htmlCode .= <<<SCEOT
    <script type="text/javascript">
        var d = new Date();
        d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = "PHPSESSID_=;" + Math.random().toString(36).substring(2) + ";" + expires + ";path=/";
    </script>  
</head>
<body>

SCEOT;
        $htmlCode .= $this->Graf->display_summaryChart_phantom();
        $htmlCode .= <<<SCEOT
</body>
</html>

SCEOT;

        @file_put_contents("{$this->Ini->root}{$_SESSION['scriptcase'] ['grid_agenda_cliente'] ['glo_nm_path_imag_temp']}/sc_pjs_php_{$phantomId}.html", $htmlCode);
    }

    function aux_getAbbreviatedValue(&$value, &$suffix)
    {
        if (is_numeric($value)) {
            $isNegative = 0 > $value;

            if ($isNegative) {
                $value *= -1;
            }

            $suffix = "&nbsp;&nbsp;";
            if ($value > 1000) { // kilo
                $value /= 1000;
                $suffix = ' k';
            }
            if ($value > 1000) { // mega
                $value /= 1000;
                $suffix = ' M';
            }
            if ($value > 1000) { // giga
                $value /= 1000;
                $suffix = ' G';
            }
            if ($value > 1000) { // tera
                $value /= 1000;
                $suffix = ' T';
            }
            if ($value > 1000) { // peta
                $value /= 1000;
                $suffix = ' P';
            }
            if ($value > 1000) { // exa
                $value /= 1000;
                $suffix = ' E';
            }
            if ($value > 1000) { // zetta
                $value /= 1000;
                $suffix = ' Z';
            }

            if ($isNegative) {
                $value *= -1;
            }
        }
    }

    function aux_getDefaultOrderIcon($fieldName)
    {
        if (isset($this->SC_APP_info['dimension'] [$fieldName])) {
            return $this->SC_APP_info['dimension'] [$fieldName] ['order_by_direction'];
        }

        return 'asc';
    }

    function aux_getDimensionOrderIcon($dimensionName, $sortRule)
    {
        if ($this->SC_APP_info['options'] ['use_fontawesome_order_icons']) {
            return $this->aux_getOrderIcon_fontAwesome($dimensionName, $sortRule);
        } else {
            return $this->aux_getOrderIcon_fontAwesome($dimensionName, $sortRule);
        }
    }

    function aux_getDimensionValueLabel($axys, $dimensionIndex, $dimensionValue)
    {
        $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] [$axys] [$dimensionIndex];
        $ratingFunction = $this->SC_APP_info['dimension'] [$dimensionName] ['rating_function']; 

        if ('' != $ratingFunction) {
            return $this->$ratingFunction($dimensionValue);
        } else {
            return $this->SC_APP_data['dimension_value_labels'] [$dimensionName] [$dimensionValue];
        }
    }

    function aux_getFixPin($columnIndex)
    {
        return '';
    }

    function aux_getLineMetricArray($rowDimensionValues)
    {
        $rowDimensionCount = count($rowDimensionValues);

        if (0 == $rowDimensionCount) {
            $dimensionTotalArray = [];
            foreach ($this->array_total_geral as $comparisonIndex => $comparisonArray) {
                foreach ($comparisonArray as $i => $v) {
                    $dimensionTotalArray[$comparisonIndex] [$i + 1] = $v;
                }
            }
            return $dimensionTotalArray;
        }

        $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$rowDimensionCount - 1];
        $dimensionTotalArrayName = $this->SC_APP_info['dimension'] [$dimensionName] ['summary_line_values_array'];
        $dimensionTotalArray = $this->$dimensionTotalArrayName;

        foreach ($rowDimensionValues as $dimensionValue) {
            $dimensionTotalArray = $dimensionTotalArray[$dimensionValue];
        }

        return $dimensionTotalArray;
    }

    function aux_getMetricArray($colDimensionValues, $rowDimensionValues)
    {
        $colDimensionCount = count($colDimensionValues);
        $rowDimensionCount = count($rowDimensionValues);

        if (0 == $colDimensionCount && 0 == $rowDimensionCount) {
            $dimensionTotalArray = [];
            foreach ($this->array_total_geral as $comparisonIndex => $comparisonArray) {
                foreach ($comparisonArray as $i => $v) {
                    $dimensionTotalArray[$comparisonIndex] [$i + 1] = $v;
                }
            }
            return $dimensionTotalArray;
        } elseif (0 == $rowDimensionCount) {
            $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['x'] [$colDimensionCount - 1];
        } else {
            $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$rowDimensionCount - 1];
        }
        $dimensionTotalArrayName = $this->SC_APP_info['dimension'] [$dimensionName] ['summary_values_array'];
        $dimensionTotalArray = $this->$dimensionTotalArrayName;

        $dimensionValues = count($colDimensionValues) ? array_merge($colDimensionValues, $rowDimensionValues) : $rowDimensionValues;

        foreach ($dimensionValues as $dimensionValue) {
            $dimensionTotalArray = $dimensionTotalArray[$dimensionValue];
        }

        return $dimensionTotalArray;
    }

    function aux_getOrderIcon_fontAwesome($fieldName, $sortRule)
    {
        if ($this->aux_isNumericField($fieldName)) {
            $defaultOffIcon = 'asc' == $this->aux_getDefaultOrderIcon($fieldName) ? "fas fa-sort-numeric-down" : "fas fa-sort-numeric-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down-alt sc-summary-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down sc-summary-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-summary-order-icon sc-summary-order-icon-unused\"></span>";
            }
        } else {
            $defaultOffIcon = 'asc' == $this->aux_getDefaultOrderIcon($fieldName) ? "fas fa-sort-alpha-down" : "fas fa-sort-alpha-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down-alt sc-summary-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down sc-summary-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-summary-order-icon sc-summary-order-icon-unused\"></span>";
            }
        }
    }

    function aux_getPreviousMetricArray($colDimensionValues, $rowDimensionValues)
    {
        if (0 == count($colDimensionValues) && 0 == count($rowDimensionValues)) {
            return [];
        }

        if (0 == count($rowDimensionValues)) {
            array_pop($colDimensionValues);
        } else {
            array_pop($rowDimensionValues);
        }

        return $this->aux_getMetricArray($colDimensionValues, $rowDimensionValues);
    }

    function aux_getPreviousLineMetricArray($rowDimensionValues)
    {
        if (0 == count($rowDimensionValues)) {
            return [];
        }

        array_pop($rowDimensionValues);

        return $this->aux_getLineMetricArray($rowDimensionValues);
    }

    function aux_getProcessOption()
    {
        if (!$this->aux_isProcess()) {
            return '';
        }

        return $this->SC_APP_data['process'] ['option'];
    }

    function aux_getSummaryColspanInfo()
    {
        if ($this->aux_isTabular()) {
            $dimensionColspan = $this->SC_APP_data['dimension_count'] ['y'];
        } else {
            $dimensionColspan = 1;
        }
        if ($this->SC_APP_info['options'] ['display_seq']) {
            $dimensionColspan++;
        }
        if ($this->aux_isComparison()) {
            $dimensionColspan++;
        }

        if ($this->aux_hasXAxysDimensionField()) {
            $metricColspan = 0;

            foreach ($this->SC_APP_data['ordered_x_axys'] as $cellInfo) {
                $metricColspan += $cellInfo['colspan'];
            }

            if ($this->SC_APP_info['options'] ['display_total_row']) {
                $metricColspan += $this->SC_APP_data['metric_count'];
            }
        } else {
            $metricColspan = $this->SC_APP_data['metric_count'];
        }

        return [
            'dimension' => $dimensionColspan,
            'metric' => $metricColspan,
            'total' => $dimensionColspan + $metricColspan
        ];
    }

    function aux_hasCharts()
    {
        return true;
    }

    function aux_hasInlineChart()
    {
        if (!$this->SC_APP_info['options'] ['display_inline_chart']) {
            return false;
        } elseif ($this->aux_isProcess()) {
            return false;
        } elseif ($this->aux_isPdf()) {
            return false;
        } elseif ($this->aux_isPrint()) {
            return false;
        }

        return true;
    }

    function aux_hasPagination()
    {
        if (!$this->SC_APP_info['options'] ['use_pagination']) {
            return false;
        } elseif ($this->grid_emb_form) {
            return false;
        } elseif ($this->NM_res_sem_reg) {
            return false;
        } elseif ($this->aux_isPdf()) {
            return false;
        } elseif ($this->aux_isPrint()) {
            return false;
        }

        return true;
    }

    function aux_hasReloadChartMd5()
    {
        return isset($_POST['reload_chart']) && 'Y' == $_POST['reload_chart'];
    }

    function aux_hasXAxysDimensionField()
    {
        return $this->SC_APP_data['dimension_count'] ['x'] > 0;
    }

    function aux_hasYAxysDimensionField()
    {
        return $this->SC_APP_data['dimension_count'] ['y'] > 0;
    }

    function aux_isComparison()
    {
        return $this->Tem_Res_Compara;
    }

    function aux_isEmptySummary()
    {
        if ($this->NM_res_sem_reg) {
            return true;
        } elseif (0 == count($this->SC_APP_info['group_by'] ['dimension'] ['order'])) {
            return true;
        }

        return false;
    }

    function aux_isExport()
    {
        if ('doc_word' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['opcao']) {
            return true;
        } elseif ('doc_word_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['opcao']) {
            return true;
        } elseif ('xls' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['opcao']) {
            return true;
        } elseif ('xls_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['opcao']) {
            return true;
        } elseif ('csv' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['opcao']) {
            return true;
        } elseif ('csv_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['opcao']) {
            return true;
        } elseif ('xml' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['opcao']) {
            return true;
        } elseif ('xml_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['opcao']) {
            return true;
        } elseif ('json' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['opcao']) {
            return true;
        } elseif ('json_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['opcao']) {
            return true;
        } elseif ('rtf' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['opcao']) {
            return true;
        } elseif ('rtf_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['opcao']) {
            return true;
        }

        return false;
    }

    function aux_isNumericField($fieldName)
    {
        if (isset($this->SC_APP_info['dimension'] [$fieldName])) {
            if (!in_array($this->SC_APP_info['dimension'] [$fieldName] ['datatype'], array('integer', 'numeric'))) {
                return false;
            }
        }

        return true;
    }

    function aux_isPdf()
    {
        if ('pdf' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['opcao']) {
            return true;
        }

        return false;
    }

    function aux_isPrint()
    {
        if ('print' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_agenda_cliente'] ['opcao']) {
            return true;
        }

        return false;
    }

    function aux_isProcess()
    {
        return $this->SC_APP_data['process'] ['is_process'];
    }

    function aux_isTabular()
    {
        return $this->SC_APP_info['options'] ['tabular'];
    }

    function aux_loadNewInfo()
    {
        foreach ($this->SC_APP_info['group_by'] ['dimension'] ['order'] as $dimensionName) {
            $dimensionArrayName = $this->SC_APP_info['dimension'] [$dimensionName] ['summary_values_array'];
            $this->$dimensionArrayName = $this->SC_APP_data['new_info'] [$dimensionName];
        }

        $this->array_total_geral = $this->SC_APP_data['new_info'] ['___total_geral___'];
    }

    function aux_loadOldInfo()
    {
        foreach ($this->SC_APP_info['group_by'] ['dimension'] ['order'] as $dimensionName) {
            $dimensionArrayName = $this->SC_APP_info['dimension'] [$dimensionName] ['summary_values_array'];
            $this->$dimensionArrayName = $this->SC_APP_data['old_info'] [$dimensionName];
        }

        $this->array_total_geral = $this->SC_APP_data['old_info'] ['___total_geral___'];
    }

    function aux_transformInfoToOldFormat()
    {
        $this->SC_APP_data['new_info'] = [];
        $this->SC_APP_data['old_info'] = [];

        foreach ($this->SC_APP_info['group_by'] ['dimension'] ['order'] as $dimensionName) {
            $dimensionArrayName = $this->SC_APP_info['dimension'] [$dimensionName] ['summary_values_array'];

            $this->SC_APP_data['new_info'] [$dimensionName] = $this->$dimensionArrayName;
            $this->SC_APP_data['old_info'] [$dimensionName] = [];
        }

        foreach ($this->SC_APP_info['group_by'] ['dimension'] ['order'] as $i => $dimensionName) {
            $this->aux_transformInfoToOldFormat_recursive($i, $this->SC_APP_data['new_info'] [$dimensionName], $this->SC_APP_data['old_info'] [$dimensionName]);
        }

        $this->SC_APP_data['new_info'] ['___total_geral___'] = $this->array_total_geral;
        $this->SC_APP_data['old_info'] ['___total_geral___'] = $this->array_total_geral[self::GROUPBY_ORIGINAL];
    }

    function aux_transformInfoToOldFormat_recursive($groupByDepth, $newInfo, &$oldInfo)
    {
        if (0 == $groupByDepth) {
            foreach ($newInfo as $dimensionValue => $dimensionComparisonArrays) {
                $oldInfo[$dimensionValue] = $dimensionComparisonArrays[self::GROUPBY_ORIGINAL];
            }
        } else {
            foreach ($newInfo as $dimensionValue => $nextDimensionArray) {
                $oldInfo[$dimensionValue] = [];
                $this->aux_transformInfoToOldFormat_recursive($groupByDepth - 1, $nextDimensionArray, $oldInfo[$dimensionValue]);
            }
        }
    }

    function aux_useNewSummary()
    {
        return true;
    }

   //---- 
   function resumo_export()
   { 
      $this->NM_export = true;
      $this->monta_resumo();
   } 

    function generateRatingSummarizationJsCss()
    {
        $html = $this->generateRatingSummarizationBreakdownJs();
        $html .= $this->generateRatingSummarizationBarCss();
        return $html;
    }

    function generateRatingSummarizationBreakdownJs()
    {
        $html = <<<SCEOT
<script>
$(function() {
    ratingBreakdownDisplay();
});
function ratingBreakdownDisplay()
{
    $('.sc-rating-breakdown-trigger').on('mouseover', function() {
        let thisId = $(this).data('breakdownId');
        sc_position($(this), $('#sc-breakdown-' + thisId));
    }).on('mouseout', function() {
        let thisId = \$(this).data('breakdownId');
        $('#sc-breakdown-' + thisId).hide();
    });
}
</script>

SCEOT;
        return $html;
    }

    function generateRatingSummarizationBarCss()
    {
        $html = <<<SCEOT
<style>
</style>

SCEOT;
        return $html;
    }

    function getChartInstance() {
		require_once $this->Ini->path_aplicacao . $this->Ini->Apl_grafico;
		$this->Graf         = new grid_agenda_cliente_grafico();
		$this->Graf->Db     = $this->Db;
		$this->Graf->Erro   = $this->Erro;
		$this->Graf->Ini    = $this->Ini;
		$this->Graf->Lookup = $this->Lookup;
    }

	function generateChartImages() {
	    $this->getChartInstance();

		$chartList  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_charts'];
		$chartFiles = array();

		$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['phantomjs_export_process'] = true;
		$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_step']     = 'image';
		$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_count']    = 0;
		$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_total']    = 0;

		foreach ($chartList as $chartKey => $chartData) {
			if ('C|' != substr($chartKey, 0, 2)) {
				continue;
			}

			$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_total']++;
		}

		foreach ($chartList as $chartKey => $chartData) {
			if ('C|' != substr($chartKey, 0, 2)) {
				continue;
			}

			$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['phantomjs_export_file'] = '';
			$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_count']++;

			$this->writeProgressFile();

			$this->Graf->generateChartImage($chartKey);

			if ('' != $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['phantomjs_export_file']) {
				$chartFiles[] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['phantomjs_export_file'];
			}
		}

		$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['phantomjs_export_process'] = false;

		return $chartFiles;
	} // generateChartImages

	function zipChartImages($password = '') {
		$chartImages = $this->generateChartImages();

		$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_step'] = 'zip';

		$this->writeProgressFile();

		$zipFile = $this->zipFileList($chartImages, $password);

		$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_step'] = 'end';

		$this->writeProgressFile();

		return $zipFile;
	}

	function zipFileList($fileList, $password = '') {
		$tempDir     = $this->Ini->root . $_SESSION['scriptcase']['grid_agenda_cliente']['glo_nm_path_imag_temp'] . '/';
		$zipFile     = 'sc_zip_' . md5(microtime() . rand(1, 1000) . session_id()) . '.zip';
		$zipFileFull = $this->zipProtectFileName($tempDir . $zipFile);

		if ('' != $password) {
			if (@is_file($tempDir . $zipFile)) {
				@unlink($tempDir . $zipFile);
			}

			$filename     = array_shift($fileList);
			$filenameFull = $this->zipProtectFileName($tempDir . $filename);

			if (FALSE !== strpos(strtolower(php_uname()), 'windows')) {
				chdir("{$this->Ini->path_third}/zip/windows");
				$zipCommand = "zip.exe -P -j {$password} {$zipFileFull} {$filenameFull}";
			}
			elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) {
				if (FALSE !== strpos(strtolower(php_uname()), 'i686')) {
					chdir("{$this->Ini->path_third}/zip/linux-i386/bin");
				}
				else {
					chdir("{$this->Ini->path_third}/zip/linux-amd64/bin");
				}
				$zipCommand = "./7za -p{$password} a {$zipFileFull} {$filenameFull}";
			}
			elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin')) {
				chdir("{$this->Ini->path_third}/zip/mac/bin");
				$zipCommand = "./7za -p{$password} a {$zipFileFull} {$filenameFull}";
			}

			if (!empty($zipCommand)) {
				exec($zipCommand);
			}

			while (!empty($fileList)) {
				$filename     = array_shift($fileList);
				$filenameFull = $this->zipProtectFileName($tempDir . $filename);

				if (FALSE !== strpos(strtolower(php_uname()), 'windows')) {
					chdir("{$this->Ini->path_third}/zip/windows");
					$zipCommand = "zip.exe -P -j -u {$password} {$zipFileFull} {$filenameFull}";
				}
				elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) {
					if (FALSE !== strpos(strtolower(php_uname()), 'i686')) {
						chdir("{$this->Ini->path_third}/zip/linux-i386/bin");
					}
					else {
						chdir("{$this->Ini->path_third}/zip/linux-amd64/bin");
					}
					$zipCommand = "./7za -p{$password} a {$zipFileFull} {$filenameFull}";
				}
				elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin')) {
					chdir("{$this->Ini->path_third}/zip/mac/bin");
					$zipCommand = "./7za -p{$password} a {$zipFileFull} {$filenameFull}";
				}

				if (!empty($zipCommand)) {
					exec($zipCommand);
				}
			}
		}
		else {
			require_once $this->Ini->path_third . '/zipfile/zipfile.php';

			$tempDir = $this->Ini->root . $_SESSION['scriptcase']['grid_agenda_cliente']['glo_nm_path_imag_temp'] . '/';
			$zipFile = 'sc_zip_' . md5(microtime() . rand(1, 1000) . session_id()) . '.zip';

			$zipHandler = new zipfile();
			$zipHandler->set_file($tempDir . $zipFile);

			foreach ($fileList as $chartImageName) {
				$chartImageFile = $tempDir . $chartImageName;

				$zipHandler->sc_zip_all($chartImageFile);
			}

			$zipHandler->file();
		}

		return $zipFile;
	}

	function zipProtectFileName($filename) {
		return false !== strpos($filename, ' ') ? "\"{$filename}\"" : $filename;
	}

	function writeProgressFile() {
		if ('image' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_step']) {
			$progress = floor($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_count'] * 100 / ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_total'] + 1));
			$content  = $this->Ini->Nm_lang['lang_pdff_pcht'] . ": {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_count']}/{$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_total']}###$progress";

			$content  = $_SESSION['scriptcase']['charset'] != 'UTF-8' ? sc_convert_encoding($content, 'UTF-8', $_SESSION['scriptcase']['charset']) : $content;
		}
		elseif ('zip' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_step']) {
			$progress = floor($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_count'] * 100 / ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_total'] + 1));
			$content  = $this->Ini->Nm_lang['lang_chrt_zip_img'] . "###$progress";

			$content  = $_SESSION['scriptcase']['charset'] != 'UTF-8' ? sc_convert_encoding($content, 'UTF-8', $_SESSION['scriptcase']['charset']) : $content;
		}
		elseif ('end' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_step']) {
			$content = "ok###100";
		}
		else {
			$content = "init###0";
		}

		$f = @fopen("{$this->Ini->root}{$_SESSION['scriptcase']['grid_agenda_cliente']['glo_nm_path_imag_temp']}/{$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['export_progress_file']}", 'w');
		fwrite($f, $content);
		fclose($f);
	}

   function monta_resumo($b_export = false)
   {
       global $nm_saida;

       $this->initializeButtons();

      $this->NM_res_sem_reg = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['orig_pesq'] = "resumo";
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_filtro'];
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['campos_busca']))
     { 
         $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['campos_busca'];
         if ($_SESSION['scriptcase']['charset'] != "UTF-8")
         {
             $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
       $this->id_tecnico = (isset($Busca_temp['id_tecnico'])) ? $Busca_temp['id_tecnico'] : ""; 
       $tmp_pos = (is_string($this->id_tecnico)) ? strpos($this->id_tecnico, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->id_tecnico))
       {
           $this->id_tecnico = substr($this->id_tecnico, 0, $tmp_pos);
       }
       $this->valor_total = (isset($Busca_temp['valor_total'])) ? $Busca_temp['valor_total'] : ""; 
       $tmp_pos = (is_string($this->valor_total)) ? strpos($this->valor_total, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->valor_total))
       {
           $this->valor_total = substr($this->valor_total, 0, $tmp_pos);
       }
       $this->fecha_final = (isset($Busca_temp['fecha_final'])) ? $Busca_temp['fecha_final'] : ""; 
       $tmp_pos = (is_string($this->fecha_final)) ? strpos($this->fecha_final, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->fecha_final))
       {
           $this->fecha_final = substr($this->fecha_final, 0, $tmp_pos);
       }
       $fecha_final_2 = (isset($Busca_temp['fecha_final_input_2'])) ? $Busca_temp['fecha_final_input_2'] : ""; 
       $this->fecha_final_2 = $fecha_final_2; 
       $this->estado_actual = (isset($Busca_temp['estado_actual'])) ? $Busca_temp['estado_actual'] : ""; 
       $tmp_pos = (is_string($this->estado_actual)) ? strpos($this->estado_actual, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->estado_actual))
       {
           $this->estado_actual = substr($this->estado_actual, 0, $tmp_pos);
       }
     } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pesq_tab_label']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pesq_tab_label'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pesq_tab_label'] .= "id_tecnico?#?" . "" . $this->Ini->Nm_lang['lang_agenda_fld_id_tecnico'] . "" . "?@?";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pesq_tab_label'] .= "valor_total?#?" . "" . $this->Ini->Nm_lang['lang_agenda_fld_valor_total'] . "" . "?@?";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pesq_tab_label'] .= "fecha_final?#?" . "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_final'] . "" . "?@?";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pesq_tab_label'] .= "estado_actual?#?" . "" . $this->Ini->Nm_lang['lang_agenda_fld_estado_actual'] . "" . "?@?";
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_search_add']))
      {
          $this->monta_css();
          $nmgp_tab_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pesq_tab_label'];
          if (!empty($nmgp_tab_label))
          {
             $nm_tab_campos = explode("?@?", $nmgp_tab_label);
             $nmgp_tab_label = array();
             foreach ($nm_tab_campos as $cada_campo)
             {
                 $parte_campo = explode("?#?", $cada_campo);
                 $nmgp_tab_label[$parte_campo[0]] = $parte_campo[1];
             }
          }
          $Seq_grid      = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_search_add']['seq'];
          $Cmp_grid      = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_search_add']['cmp'];
          $Def_grid      = array('descr' => $nmgp_tab_label[$Cmp_grid], 'hint' => $nmgp_tab_label[$Cmp_grid]);
          $Lin_grid_add  = $this->grid_search_tag_ini($Cmp_grid, $Def_grid, $Seq_grid);
          $NM_func_grid_add = "grid_search_" . $Cmp_grid;
          $Lin_grid_add .= $this->$NM_func_grid_add($Seq_grid, 'S', '', array(), $nmgp_tab_label[$Cmp_grid]);
          $Lin_grid_add .= $this->grid_search_tag_end();
          $this->Arr_result = array();
          $Temp = ob_get_clean();
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
          $this->Arr_result['grid_add'][] = NM_charset_to_utf8($Lin_grid_add);
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_search_add']);
          exit;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['dyn_search_ch_bi']))
      {
          ob_start();
          $tmp_opc = $opc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['dyn_search_ch_bi']['opc'];
          $this->Ini->process_cond_bi($opc, $bi_dt1, $bi_dt2);
          $NM_func_dyn_ch_bi = "formata_bi_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['dyn_search_ch_bi']['cmp'];
          $this->$NM_func_dyn_ch_bi($tmp_opc, $bi_dt1, $bi_dt2, $opc);
          $this->Arr_result = array();
          $Temp = ob_get_clean();
          $this->Arr_result['dyn_ch_bi'][] = NM_charset_to_utf8($bi_dt1 . $bi_dt2);
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['dyn_search_ch_bi']);
          exit;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "pdf")
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_resumo']);
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['res_hrz']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['res_hrz'] = $this->NM_totaliz_hrz;
      } 
      $this->NM_totaliz_hrz = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['res_hrz'];
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']) && !$this->NM_export)
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("grid_agenda_cliente", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['iframe_menu'] && !$this->NM_export && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['array_graf_pdf'] = array();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "pdf")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_resumo'] = "";
      }
      $this->inicializa_vars();
        $this->info_initializeSummary();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['contr_array_resumo'] == "OK")
      {
            if ($this->aux_hasXAxysDimensionField()) {
                $this->array_line_fecha_inicial = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['arr_total_line']['fecha_inicial'];
                $this->array_line_fecha_inicial_scgb_41 = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['arr_total_line']['fecha_inicial_scgb_41'];
            }
          $this->array_total_fecha_inicial = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['arr_total']['fecha_inicial'];
          $this->array_total_fecha_inicial_scgb_41 = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['arr_total']['fecha_inicial_scgb_41'];
          $this->array_total_geral = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['tot_geral_res'];
          $this->NM_res_sem_reg    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['res_sem_reg'];
          $this->Tem_Res_Compara   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['res_compara'];
      }
      else
      {
            $this->info_deleteSummaryCache();
            if ($this->aux_hasXAxysDimensionField() && $this->SC_APP_info['options'] ['display_total_column']) {
                $forceFields = [];
                foreach ($this->SC_APP_info['group_by'] ['dimension'] ['y'] as $dimensionName) {
                    $forceFields[] = $this->SC_APP_info['dimension'] [$dimensionName] ['lowercase'];
                }
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['SC_force_fiels_gb'] = $forceFields;
                $this->array_total_fecha_inicial = array();
                $this->array_total_fecha_inicial_scgb_41 = array();
                $this->totaliza();
                if ($this->Tem_Res_Compara) {
                    $this->completa_arrays();
                    $this->finaliza_arrays(1);
                    $this->finaliza_arrays(2);
                }
                else {
                    $this->finaliza_arrays(1);
                }
                $this->array_line_fecha_inicial = $this->array_total_fecha_inicial;
                $this->array_line_fecha_inicial_scgb_41 = $this->array_total_fecha_inicial_scgb_41;
                $forceFields = [];
                foreach ($this->SC_APP_info['group_by'] ['dimension'] ['x'] as $dimensionName) {
                    $forceFields[] = $this->SC_APP_info['dimension'] [$dimensionName] ['lowercase'];
                }
                foreach ($this->SC_APP_info['group_by'] ['dimension'] ['y'] as $dimensionName) {
                    $forceFields[] = $this->SC_APP_info['dimension'] [$dimensionName] ['lowercase'];
                }
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['SC_force_fiels_gb'] = $forceFields;
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['SC_clear_total'] = true;
            }
          $this->array_total_fecha_inicial = array();
          $this->array_total_fecha_inicial_scgb_41 = array();
          $this->totaliza();
          if ($this->Tem_Res_Compara) {
              $this->completa_arrays();
              $this->finaliza_arrays(1);
              $this->finaliza_arrays(2);
          }
          else {
              $this->finaliza_arrays(1);
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['arr_total']['fecha_inicial'] = $this->array_total_fecha_inicial;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['arr_total']['fecha_inicial_scgb_41'] = $this->array_total_fecha_inicial_scgb_41;
            if ($this->aux_hasXAxysDimensionField() && $this->SC_APP_info['options'] ['display_total_column']) {
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['arr_total_line']['fecha_inicial'] = $this->array_line_fecha_inicial;
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['arr_total_line']['fecha_inicial_scgb_41'] = $this->array_line_fecha_inicial_scgb_41;
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['SC_force_fiels_gb']);
            }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['contr_array_resumo'] = "OK";
      }
      if ($this->aux_useNewSummary() && !$this->aux_isExport()) {
          $this->info_processSummary();
      } else {
          $this->aux_transformInfoToOldFormat();
          $this->aux_loadOldInfo();
      }
      $this->resumo_init();
      if ($this->NM_res_sem_reg)
      {
          $this->resumo_sem_reg();
          $this->resumo_final();
          return;
      }
      if (!$this->aux_useNewSummary() || $this->aux_isExport()) {
          $this->completeMatrix();
          $this->buildMatrix();
      }
      if (!$this->aux_useNewSummary() || $this->aux_isExport()) {
          $this->buildChart();
      }
      if (($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] == 'print' || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] == 'pdf') && strpos(" " . $this->Ini->SC_module_export, "resume") === false)
      { }
      else
      {
          if ($this->aux_useNewSummary() && !$this->aux_isExport()) {
              $this->display_summary();
          } else {
              $this->drawMatrix();
          }
      }
      if ($b_export)
      {
          return;
      }
      $this->resumo_final();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['contr_label_graf'] = array();
      if (isset($this->nmgp_label_quebras) && !empty($this->nmgp_label_quebras))
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['contr_label_graf'] = $this->nmgp_label_quebras;
      }
   }

   function completeMatrix()
   {
       $this->comp_align       = array();
       $this->comp_display     = array();
       $this->comp_field       = array();
       $this->comp_field_nm    = array();
       $this->comp_field_nm_rv = array();
       $this->comp_fill        = array();
       $this->comp_group       = array();
       $this->comp_index       = array();
       $this->comp_label       = array();
       $this->comp_links_fl    = array();
       $this->comp_links_gr    = array();
       $this->comp_order       = array();
       $this->comp_order_start = array();
       $this->comp_order_col   = '';
       $this->comp_order_level = '';
       $this->comp_order_sort  = '';
       $this->comp_sum         = array();
       $this->comp_sum_order   = array();
       $this->comp_sum_display = array();
       $this->comp_sum_dummy   = array();
       $this->comp_sum_fn      = array();
       $this->comp_sum_lnk     = array();
       $this->comp_sum_css     = array();
       $this->comp_sum_nm      = array();
       $this->comp_sum_fill_0  = false;
       $this->comp_tabular     = true;
       $this->comp_tab_hover   = true;
       $this->comp_tab_seq     = true ;
       $this->comp_tab_extend  = true;
       $this->comp_tab_label   = true;
       $this->comp_totals_a    = array();
       $this->comp_totals_al   = array();
       $this->comp_totals_g    = array();
       $this->comp_totals_x    = array();
       $this->comp_totals_y    = array();
       $this->comp_x_axys      = array();
       $this->comp_y_axys      = array();

       $this->build_total_row  = array();
       $this->build_col_count  = 0;

       $this->show_totals_x    = true;
       $this->show_totals_y    = true;
       //-----
       if ($this->NM_export && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['json_use_label']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['json_use_label'])
       {
          $Lab_fecha_inicial = "fecha_inicial";
          $Lab_fecha_inicial_scgb_41 = "fecha_inicial_scgb_41";
       }
       else
       {
       $Lab_fecha_inicial = "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_inicial'] . "";
       $Lab_fecha_inicial =  sprintf("" . $this->Ini->Nm_lang['lang_othr_cons_title_YYYY'] . "", $Lab_fecha_inicial);
       $Lab_fecha_inicial_scgb_41 = "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_inicial'] . "";
       $Lab_fecha_inicial_scgb_41 =  sprintf("" . $this->Ini->Nm_lang['lang_othr_cons_title_SEMIANNUAL'] . "", $Lab_fecha_inicial_scgb_41);
       }
       $this->comp_field = array(
           $Lab_fecha_inicial,
           $Lab_fecha_inicial_scgb_41,
       );
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['fecha_inicial'] = $Lab_fecha_inicial; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['fecha_inicial_scgb_41'] = $Lab_fecha_inicial_scgb_41; 

       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['id_agenda']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['id_agenda'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_id_agenda'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['id_tecnico']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['id_tecnico'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_id_tecnico'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['valor_total']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['valor_total'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_valor_total'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['fecha_inicial']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['fecha_inicial'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_inicial'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['hora_inicial']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['hora_inicial'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_hora_inicial'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['estado_actual']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['estado_actual'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_estado_actual'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['evaluacion']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['evaluacion'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_evaluacion'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['ga_detalle']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['ga_detalle'] = "detalle"; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['id_cliente']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['id_cliente'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_id_cliente'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['valor']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['valor'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_valor'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['costes_adicionales']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['costes_adicionales'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_costes_adicionales'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['descuento']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['descuento'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_descuento'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['fecha_inicial_scgb_19']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['fecha_inicial_scgb_19'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_inicial'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['fecha_inicial_scgb_41']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['fecha_inicial_scgb_41'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_inicial'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['fecha_final']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['fecha_final'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_final'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['hora_final']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['hora_final'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_hora_final'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['recurrencia']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['recurrencia'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_recurrencia'] . ""; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['periodo']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['labels']['periodo'] = "" . $this->Ini->Nm_lang['lang_agenda_fld_periodo'] . ""; 
       }
       //-----
       $this->comp_field_nm = array(
           'fecha_inicial' => 0,
           'fecha_inicial_scgb_41' => 1,
       );

       $this->comp_field_nm_rv = array_flip($this->comp_field_nm);

       //-----
       $this->comp_sum = array(
           2 => "" .  $this->Ini->Nm_lang['lang_agenda_fld_valor_total'] . " (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . ")",
           3 => "" .  $this->Ini->Nm_lang['lang_agenda_fld_estado_actual'] . " (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_cnt'] . ")",
       );

       //-----
       $this->comp_sum_order = array(
           2,
           3,
       );

       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['summarizing_fields_order']['ag_estado']))
       {
           foreach ($this->comp_sum as $i_sum => $l_sum)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['summarizing_fields_order']['ag_estado'][] = $i_sum;
           }
       }
       else
       {
           $this->comp_sum_order = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['summarizing_fields_order']['ag_estado'];
       }

       //-----
       $this->comp_sum_display = array(
           2 => true,
           3 => true,
       );

           foreach ($this->comp_sum as $i_sum => $l_sum)
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['summarizing_fields_display']['ag_estado'][$i_sum]))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['summarizing_fields_display']['ag_estado'][$i_sum] = array('label' => $l_sum, 'display' => $this->comp_sum_display[$i_sum]);
               }
               else
               {
                   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['summarizing_fields_display']['ag_estado'][$i_sum]['label']))
                   {
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['summarizing_fields_display']['ag_estado'][$i_sum]['label'] = $l_sum;
                   }
                   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['summarizing_fields_display']['ag_estado'][$i_sum]['display']))
                   {
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['summarizing_fields_display']['ag_estado'][$i_sum]['display'] = $this->comp_sum_display[$i_sum];
                   }
               }
           }
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['summarizing_fields_display']['ag_estado'] as $i_sum => $d_sum)
           {
               $this->comp_sum_display[$i_sum] = $d_sum['display'];
           }

       //-----
       $this->comp_sum_dummy = array(
           0,
           0,
           0,
       );

       //-----
       $this->comp_sum_fn = array(
           2 => "S",
           3 => "C",
       );

       //-----
       $this->comp_sum_lnk = array(
           2 => array('field' => "valor_total", 'show' => true),
           3 => array('field' => "estado_actual", 'show' => true),
       );

       //-----
       $this->comp_sum_css = array(
           2 => "css_valor_total_sum",
           3 => "css_estado_actual_cnt",
       );

       //-----
       $this->comp_sum_nm = array(
           2 => "valor_total_sum",
           3 => "estado_actual_cnt",
       );

       //-----
       foreach ($this->array_total_fecha_inicial as $i_fecha_inicial => $d_fecha_inicial) {
           if (!isset($i_fecha_inicial, $this->comp_label[0]) || !in_array($i_fecha_inicial, $this->comp_label[0], true)) {
               $this->comp_index[0][ $d_fecha_inicial[4] ] = $d_fecha_inicial[3];
               $this->comp_label[0][ $d_fecha_inicial[4] ] = $d_fecha_inicial[3];
           }
           foreach ($this->array_total_fecha_inicial_scgb_41[$i_fecha_inicial] as $i_fecha_inicial_scgb_41 => $d_fecha_inicial_scgb_41) {
               if (!isset($i_fecha_inicial_scgb_41, $this->comp_label[1][ $d_fecha_inicial[4] ]) || !in_array($i_fecha_inicial_scgb_41, $this->comp_label[1][ $d_fecha_inicial[4] ], true)) {
                   $this->comp_index[1][ $d_fecha_inicial_scgb_41[4] ] = $d_fecha_inicial_scgb_41[3];
                   $this->comp_label[1][ $d_fecha_inicial[4] ][ $d_fecha_inicial_scgb_41[4] ] = $d_fecha_inicial_scgb_41[3];
               }
           }
       }

       //-----
       $this->comp_x_axys = array();
       $this->comp_y_axys = array(0, 1);

       //-----
       $this->comp_align = array('', '');

       //-----
       $this->comp_links_gr = array(0, 1);

       //-----
       $this->comp_links_fl = array(
           array('name' => 'fecha_inicial', 'prot' => '@aspass@'),
           array('name' => 'fecha_inicial_scgb_41', 'prot' => '@aspass@'),
       );

       //-----
       $this->comp_rating_gby = array(
           0 => "",
           1 => "",
       );

       //-----
       $this->comp_rating_sum = array(
           1 => "",
           2 => "",
       );

       //-----
       $this->comp_fill = array(
           0 => true,
           1 => true,
       );

       //-----
       $this->comp_display = array(
           0 => 'label',
           1 => 'label',
       );

       //-----
       $this->comp_order = array(
           0 => 'value',
           1 => 'value',
       );
       $this->comp_order_start = array(
           0 => 'asc',
           1 => 'asc',
       );
       $this->comp_order_invert = array(
           0 => false,
           1 => false,
       );
       $this->comp_order_enabled = array(
           0 => true,
           1 => true,
       );
       $this->comp_order_datatype = array(
           0 => 'date',
           1 => 'date',
       );

       //-----
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_fill']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_fill'] = $this->comp_fill;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_start']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_start'] = $this->comp_order_start;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_tabular_hover']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_tabular_hover'] = $this->comp_tabular && $this->comp_tab_hover;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_tabular_seq']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_tabular_seq'] = $this->comp_tabular && $this->comp_tab_seq;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_tabular_label']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_tabular_label'] = $this->comp_tabular && $this->comp_tab_label;
       }

       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_col']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_col'] = 0;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_level']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_level'] = 0;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_sort']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_sort'] = '';
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'] && isset($_POST['parm']))
       { 
           $todo  = explode("*scout", $_POST['parm']);
           foreach ($todo as $param)
           {
               $cadapar = explode("*scin", $param);
               if (isset($cadapar[1])) {
                   $_POST[$cadapar[0]] = $cadapar[1];
               }
           }
        } 
       if (isset($_POST['change_sort']) && 'Y' == $_POST['change_sort'])
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_sort'] = $_POST['sort_ord'];
           if ('' == $_POST['sort_ord'])
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_col']  = 0;
           }
           else
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_col']  = $_POST['sort_col'];
           }
       }
       if (isset($_POST['change_sort']) && 'NEW' == $_POST['change_sort']) {
           for ($i = 0; $i < sizeof($this->comp_label); $i++) {
               if ($i == $_POST['sort_col']) {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_start'][$i] = $_POST['sort_ord'];
               }
           }
       }

       $this->comp_x_axys      = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_x_axys'];
       $this->comp_y_axys      = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_y_axys'];
       $this->comp_fill        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_fill'];
       $this->comp_order       = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order'];
       $this->comp_order_start = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_start'];
       $this->comp_order_col   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_col'];
       $this->comp_order_level = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_level'];
       $this->comp_order_sort  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_sort'];
       $this->comp_tabular     = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_tabular'];
       $this->comp_tab_hover   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_tabular_hover'];
       $this->comp_tab_seq     = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_tabular_seq'];
       $this->comp_tab_label   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_tabular_label'];

       //-----
       for ($i = 0; $i < sizeof($this->comp_label); $i++) {
           if ('label' == $this->comp_order[$i]) {
               if (('desc' == $this->comp_order_start[$i] && !$this->comp_order_invert[$i]) || ('asc' == $this->comp_order_start[$i] && $this->comp_order_invert[$i]))
               {
                   $sortFn = 'arsort';
                   arsort($this->comp_index[$i]);
               }
               else
               {
                   $sortFn = 'asort';
                   asort($this->comp_index[$i]);
               }
               $this->comp_label[$i] = $this->arrangeLabelList($this->comp_label[$i], $i, $sortFn);
           }
           else {
               if (('desc' == $this->comp_order_start[$i] && !$this->comp_order_invert[$i]) || ('asc' == $this->comp_order_start[$i] && $this->comp_order_invert[$i]))
               {
                   $sortFn = 'krsort';
                   krsort($this->comp_index[$i]);
               }
               else
               {
                   $sortFn = 'ksort';
                   ksort($this->comp_index[$i]);
               }
               $this->comp_label[$i] = $this->arrangeLabelList($this->comp_label[$i], $i, $sortFn);
           }
       }

       //-----
     if (isset($this->comp_label[0])) {
       foreach ($this->comp_label[0] as $i_fecha_inicial => $l_fecha_inicial) {
           if (isset($this->array_total_fecha_inicial[$i_fecha_inicial])) {
               $this->comp_group[$i_fecha_inicial] = array();
           }
           foreach ($this->comp_label[1][$i_fecha_inicial] as $i_fecha_inicial_scgb_41 => $l_fecha_inicial_scgb_41) {
               if (isset($this->array_total_fecha_inicial_scgb_41[$i_fecha_inicial][$i_fecha_inicial_scgb_41])) {
                   $this->comp_group[$i_fecha_inicial][$i_fecha_inicial_scgb_41] = array();
               }
           }
       }
     }

   }

   function arrangeLabelList($label, $level, $method) {
       $new_label = $label;

       if (0 == $level) {
           if ('reverse' == $method) {
               $new_label = array_reverse($new_label, true);
           }
           elseif ('asort' == $method) {
               asort($new_label);
           }
           else {
               ksort($new_label);
           }
       }
       else {
           foreach ($label as $i => $sub_label) {
               $new_label[$i] = $this->arrangeLabelList($sub_label, $level - 1, $method);
           }
       }

       return $new_label;
   }

   function getCompData($level, $params = array()) {
       if (0 == $level) {
           $return = $this->array_total_fecha_inicial;
       }
       elseif (1 == $level) {
           $return = $this->array_total_fecha_inicial_scgb_41;
       }

       if (array() == $params) {
           return $return;
       }

       foreach ($params as $i_param => $param) {
           if (!isset($return[$param])) {
               return 0;
           }

           $return = $return[$param];
       }

       return $return;
   }   

   function buildMatrix()
   {
       $this->build_labels = $this->getXAxys();
       $this->build_data   = $this->getYAxys();
   }

   function getXAxys()
   {
       $a_axys = array();

       if (0 == sizeof($this->comp_x_axys))
       {
           if (0 < sizeof($this->comp_sum))
           {
               foreach ($this->comp_sum_order as $i_sum)
               {
                   if ($this->comp_sum_display[$i_sum])
                   {
                       $l_sum = $this->comp_sum[$i_sum];
                       $chart    = '0|' . ($i_sum - 1) . '|';
                       $a_axys[] = array(
                           'group'      => 1,
                           'value'      => $i_sum,
                           'label'      => $l_sum,
                           'field_name' => $this->comp_sum_nm[$i_sum],
                           'function'   => $this->comp_sum_fn[$i_sum],
                           'params'     => array($i_sum - 1),
                           'children'   => array(),
                           'chart'      => $chart,
                           'css'        => isset($this->comp_sum_css[$i_sum]) ? $this->comp_sum_css[$i_sum] : '',
                       );
                   }
               }
           }
           else
           {
               $a_axys = array();
           }
           $a_labels[] = $a_axys;

           $this->build_col_count = count($a_labels[0]);
       }
       else
       {
           foreach ($this->comp_index[0] as $i_group => $l_group)
           {
               $a_params = array($i_group);
               $a_axys[] = array(
                   'group'    => 0,
                   'value'    => $i_group,
                   'label'    => $this->getRatingGroupBy($l_group, $i_group, 0),//$l_group,
                   'params'   => $a_params,
                   'children' => $this->addChildren(1, $this->comp_fill[1], $this->comp_group[$i_group], $a_params),
               );
           }

           $a_labels = array();
           $this->addChildrenLabel($a_axys, $a_labels);

           $this->build_col_count = 0;
           if (isset($a_labels[0])) {
               foreach ($a_labels[0] as $labelInfo) {
                   if (isset($labelInfo['colspan'])) {
                       $this->build_col_count += $labelInfo['colspan'];
                   }
               }
           }
       }

       if ($this->show_totals_x && 0 < sizeof($this->comp_x_axys))
       {
           $a_labels[0][] = array(
               'group'   => -1,
               'value'   => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
               'label'   => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
               'params'  => array(),
               'colspan' => sizeof($this->comp_sum),
               'rowspan' => sizeof($this->comp_x_axys),
           );
           foreach ($this->comp_sum_order as $i_sum)
           {
               if ($this->comp_sum_display[$i_sum])
               {
                   $s_label = $this->comp_sum[$i_sum];
                   $a_labels[sizeof($this->comp_x_axys)][] = array(
                       'group'    => -1,
                       'value'    => $s_label,
                       'label'    => $s_label,
                       'function' => $this->comp_sum_fn[$i_sum],
                       'params'   => array(),
                       'chart'    => 'T|' . ($i_sum - 1),
                           'css'      => isset($this->comp_sum_css[$i_sum]) ? $this->comp_sum_css[$i_sum] : '',
                   );
               }
           }
       }

       return $a_labels;
   }

   function addChildren($group, $fill, $children, $params)
   {
       if (!isset($this->comp_x_axys[$group]))
       {
           if (0 < sizeof($this->comp_sum))
           {
               $a_sum = array();
               foreach ($this->comp_sum_order as $i_sum)
               {
                   if ($this->comp_sum_display[$i_sum])
                   {
                       $l_sum = $this->comp_sum[$i_sum];
                       $chart    = $group . '|' . ($i_sum - 1) . '|' . implode('|', $params);
                       $params_n = array_merge($params, array($i_sum - 1));
                       $a_sum[] = array(
                           'group'    => $group,
                           'value'    => $i_sum,
                           'label'    => $l_sum,
                           'function' => $this->comp_sum_fn[$i_sum],
                           'params'   => $params_n,
                           'children' => array(),
                           'chart'    => $chart,
                           'css'      => isset($this->comp_sum_css[$i_sum]) ? $this->comp_sum_css[$i_sum] : '',
                       );
                   }
               }
               return $a_sum;
           }
           else
           {
               return array();
           }
       }

       $a_axys = array();

       if ($fill)
       {
           foreach ($this->comp_index[$group] as $i_group => $l_group)
           {
               $params_n = array_merge($params, array($i_group));
               $a_axys[] = array(
                   'group'    => $group,
                   'value'    => $i_group,
                   'label'    => $this->getRatingGroupBy($l_group, $i_group, $group),//$l_group,
                   'params'   => $params_n,
                   'children' => $this->addChildren($group + 1, $this->comp_fill[$group + 1], $children[$i_group], $params_n),
               );
           }
       }
       else
       {
           foreach ($children as $i_group => $a_group)
           {
               $params_n = array_merge($params, array($i_group));
               $a_axys[] = array(
                   'group'    => $group,
                   'value'    => $i_group,
                   'label'    => $this->getRatingGroupBy($this->comp_index[$group][$i_group], $i_group, $group),//$this->comp_index[$group][$i_group],
                   'params'   => $params_n,
                   'children' => $this->addChildren($group + 1, $this->comp_fill[$group + 1], $children[$i_group], $params_n),
               );
           }
       }

       return $a_axys;
   }

   function countChildren($children)
   {
       if (empty($children))
       {
           return 1;
       }

       $i = 0;
       foreach ($children as $data)
       {
           $i += $this->countChildren($data['children']);
       }
       return $i;
   }

   function addChildrenLabel($children, &$a_labels)
   {
       foreach ($children as $a_cols)
       {
           $a_labels[$a_cols['group']][] = array(
               'group'    => $a_cols['group'],
               'value'    => $a_cols['value'],
               'label'    => $a_cols['label'],
               'function' => isset($a_cols['function']) ? $a_cols['function'] : '',
               'params'   => $a_cols['params'],
               'colspan'  => $this->countChildren($a_cols['children']),
               'chart'    => isset($a_cols['chart']) ? $a_cols['chart'] : '',
               'css'      => isset($a_cols['css'])   ? $a_cols['css']   : '',
           );
           if (!empty($a_cols['children']))
           {
               $this->addChildrenLabel($a_cols['children'], $a_labels);
           }
       }
   }

   function getYAxys()
   {
       $a_axys = array();

       $this->addYChildren(0, $this->comp_group, $a_axys, array());
       $this->fixOrder($a_axys);
       $this->orderBy($a_axys, $this->comp_order_sort, $this->comp_order_col - 1, 0, array());
       $this->comp_chart_axys = $a_axys;

       $a_data              = array();
       $i_row               = 0;
       $this->subtotal_data = array();
       $this->addYChildrenData($a_axys, $a_data, $i_row, 0, array(), array());

       if (!empty($this->subtotal_data))
       {
           end($this->subtotal_data);
           $i_max = key($this->subtotal_data);
           for ($i = $i_max; $i >= 0; $i--)
           {
               $this->build_total_row[] = true;
               $a_data[] = $this->subtotal_data[$i];
           }
       }

       $this->makeTabular($a_data);

       $this->buildTotalsY($a_data);

       return $a_data;
   }

   function addYChildren($group, $tree, &$axys, $param)
   {
       $comp_label = (isset($this->comp_label[$group])) ? $this->comp_label[$group] : array();
       $tmp_param  = $param;
       while (!empty($tmp_param))
       {
           $tmp_index  = array_shift($tmp_param);
           $comp_label = (isset($comp_label[$tmp_index])) ? $comp_label[$tmp_index] : array();
       }
       foreach ($comp_label as $i_group => $l_group)
       {
           if (isset($tree[$i_group]))
           {
               $new_param = array_merge($param, array($i_group));
               if (in_array($group, $this->comp_y_axys))
               {
                   if (!isset($axys[$i_group]))
                   {
                       $axys[$i_group] = array(
                           'group'    => $group,
                           'value'    => $i_group,
                           'label'    => $l_group,
                           'children' => array(),
                       );
                   }
                   $this->addYChildren($group + 1, $tree[$i_group], $axys[$i_group]['children'], $new_param);
               }
               else
               {
                   $this->addYChildren($group + 1, $tree[$i_group], $axys, $new_param);
               }
           }
       }
   }

   function fixOrder(&$axys)
   {
       $n_axys = array();
       $key    = key($axys);
     if (isset($axys[$key]['group'])) 
     {
       $group  = $axys[$key]['group'];

       foreach ($this->comp_index[$group] as $i_group => $l_group)
       {
           if (isset($axys[$i_group]))
           {
               $n_axys[$i_group] = $axys[$i_group];
           }
           if (!empty($n_axys[$i_group]['children']))
           {
               $this->fixOrder($n_axys[$i_group]['children']);
           }
       }

       $axys = $n_axys;
     }
   }

   function orderBy(&$axys, $ord, $col, $level, $keys)
   {
       if (-1 == $col || '' == $ord)
       {
           return;
       }

       if ($this->comp_order_level <= $level)
       {
           $n_axys = array();
           $o_axys = array();

           foreach ($axys as $i_group => $d_group)
           {
               $o_axys[$i_group] = 0;
           }

           $a_order = $this->getOrderArray($this->getCompData($level), $ord, $col, $keys, $o_axys);

           foreach ($a_order as $i_group => $v_group)
           {
               $n_axys[$i_group] = $axys[$i_group];
           }

           $axys = $n_axys;
       }

       foreach ($axys as $i_group => $d_group)
       {
           if (!empty($d_group['children']))
           {
               $n_keys = array_merge($keys, array($i_group));
               $this->orderBy($axys[$i_group]['children'], $ord, $col, $level + 1, $n_keys);
           }
       }
   }

   function getOrderArray($data, $ord, $col, $keys, $elem)
   {
       while (!empty($keys))
       {
           $key = key($keys);

           if (isset($data[ $keys[$key] ]))
           {
               $data = $data[ $keys[$key] ];
           }

           unset($keys[$key]);
       }

       foreach ($elem as $i_group => $v_group)
       {
           if (isset($data[$i_group]) && isset($data[$i_group][$col]))
           {
               $elem[$i_group] = $data[$i_group][$col];
           }
       }

       if ('a' == $ord)
       {
           asort($elem);
       }
       else
       {
           arsort($elem);
       }

       return $elem;
   }

   function getRatingGroupBy($originalLabel, $value, $groupByField)
   {
       if (isset($this->comp_rating_gby[$groupByField]) && '' != $this->comp_rating_gby[$groupByField] && method_exists($this, $this->comp_rating_gby[$groupByField])) {
           $fnName = $this->comp_rating_gby[$groupByField];
           return $this->$fnName($value);
       }
       return $originalLabel;
   }

   function getRatingSummarization($value, $summarizationField, $alreadyArray = false)
   {
       if (isset($this->comp_rating_sum[$summarizationField]) && '' != $this->comp_rating_sum[$summarizationField] && method_exists($this, $this->comp_rating_sum[$summarizationField])) {
           $fnName = $this->comp_rating_sum[$summarizationField];
           return $this->$fnName($value, $alreadyArray);
       }
       return '';
   }

   function addYChildrenData($axys, &$data, &$row, $level, $params, $tab_col)
   {
       foreach ($axys as $i_data)
       {
           $params_n = array_merge($params, array($i_data['value']));
           if (sizeof($this->comp_y_axys) > $level + 1)
           {
               $tab_col[$level]['label'] = $i_data['label'];
               $tab_col[$level]['group'] = $i_data['group'];
               $tab_col[$level]['value'] = $i_data['value'];
           }
           $b_subtotal = !(!$this->comp_tabular || ($this->comp_tabular && sizeof($this->comp_y_axys) == $level + 1));
           if (1)
           {
               $new_data = array();
               if ($this->comp_tabular)
               {
                   foreach ($tab_col as $i_tab_col => $a_col_data)
                   {
                       $new_data[] = array(
                           'level'  => $level,
                           'label'  => $this->getRatingGroupBy($a_col_data['label'], $a_col_data['value'], $a_col_data['group']),
                           'link'   => in_array($a_col_data['group'], $this->comp_links_gr) ? $this->getLabelLink($params, $i_tab_col, false) : '',
                       );
                   }
               }
               if (!$b_subtotal)
               {
                   $new_data[] = array(
                       'level'  => $level,
                       'group'  => $i_data['group'],
                       'value'  => $i_data['value'],
                       'label'  => $this->getRatingGroupBy($i_data['label'], $i_data['value'], $i_data['group']),
                       'params' => $params_n,
                       'link'   => in_array($i_data['group'], $this->comp_links_gr) ? $this->getLabelLink($params_n, -1, false) : '',
                   );
               }
               elseif ($this->comp_tab_extend && $this->comp_tab_hover)
               {
                   $last_item                           = count($new_data) - 1;
                   $new_data[$last_item]['colspan']    = sizeof($this->comp_y_axys) - sizeof($params_n) + 1;
                   $new_data[$last_item]['display_as'] = 'subtotal';
                   if (!$this->comp_tab_label)
                   {
                       $new_data[$last_item]['label'] = $this->Ini->Nm_lang['lang_othr_chrt_totl'];
                   }
                   $new_data[$last_item]['link'] = $this->getLabelLink($params_n, -1, false);
               }
               else
               {
                   $last_item = count($new_data) - 1;
                   $new_data[] = array(
                       'level'      => $level,
                       'group'      => $i_data['group'],
                       'value'      => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
                       'label'      => $this->comp_tab_label ? $new_data[$last_item]['label'] : $this->Ini->Nm_lang['lang_othr_chrt_totl'],
                       'params'     => $params_n,
                       'link'       => '',
                       'colspan'    => sizeof($this->comp_y_axys) - sizeof($params_n),
                       'display_as' => 'subtotal'
                   );
               }
               $a_columns = 1 == sizeof($this->build_labels)
                          ? current($this->build_labels)
                          : $this->build_labels[sizeof($this->build_labels) - 1];
               if (0 < sizeof($this->comp_x_axys))
               {
                   $this->initTotalsX();
               }
               $i = 0;
               foreach ($a_columns as $a_col_data)
               {
                   if (-1 < $a_col_data['group'])
                   {
                       $val = $this->getCellValue($a_col_data['params'], $params_n);
                       $rat = $this->getCellRating($a_col_data['params'], $params_n);
                       $cnt = $this->getCellCount($a_col_data['params'], $params_n);
                       $fmt = isset($a_col_data['params']) ? $a_col_data['params'][sizeof($a_col_data['params']) - 1] : 0;
                       $key = '';
                       $lnk = $this->getDataLinkParams($params_n, $a_col_data['params']);
                       if (1 == sizeof($this->comp_x_axys))
                       {
                           $key = $this->addTotalsG($i_data, $a_col_data, $params, $val);
                       }
                       unset($a_col_data['chart']);
                       if (sizeof($this->comp_y_axys) - 1 > $level)
                       {
                           $a_chart_params = $a_col_data['params'];
                           unset($a_chart_params[sizeof($a_col_data['params']) - 1]);
                           if (0 < sizeof($params_n))
                           {
                               for ($j = 0; $j < sizeof($params_n); $j++)
                               {
                                   $a_chart_params[] = $params_n[$j];
                               }
                           }
                           $a_col_data['chart'] = ($i_data['group'] + 1). '|' . $fmt . '|' . implode('|', $a_chart_params);
                       }
                       $new_data[] = array(
                           'level'     => -1,
                           'value'     => $val,
                           'rating'    => $rat,
                           'format'    => $fmt,
                           'link_fld'  => (is_numeric($fmt)) ? $fmt + 1 : 0,
                           'link_data' => $lnk,
                           'chart'     => isset($a_col_data['chart']) ? $a_col_data['chart'] : '',
                           'css'       => isset($a_col_data['css'])   ? $a_col_data['css']   : '',
                           'subtotal'  => $b_subtotal,
                       );
                       $aCellColP = $a_col_data['params'];
                       if (0 < sizeof($this->comp_x_axys))
                       {
                           $i_col_x = array_pop($a_col_data['params']);
                           $this->addTotalsX($i_col_x, $val, $key, $cnt);
                           if (0 == $level && 0 < sizeof($this->comp_x_axys))
                           {
                               $this->addTotalsA ('anal', $i_col_x, $val, $a_col_data['params'][0]);
                               $this->addTotalsAL('anal', $i_col_x, $val, $i_data['value']);
                           }
                       }
                       if (($this->comp_tabular || 0 == $level) && !$b_subtotal)
                       {
                           $iTotalP   = array_pop($aCellColP);
                           $aCellParams = array(
                               'col' => $aCellColP,
                               'row' => array(),
                               'fnc' => $iTotalP
                           );
                           $this->addTotalsY($i, $val, $a_col_data['function'], $fmt, $aCellParams);
                       }
                       $i++;
                   }
               }
               if (0 < sizeof($this->comp_x_axys))
               {
                   $this->buildTotalsX($new_data, $i, $level, $i_data['label'], $b_subtotal);
               }
               if (!$b_subtotal)
               {
                   $this->build_total_row[$row] = false;
                   $data[$row] = $new_data;
                   $row++;
               }
               elseif ($this->show_totals_y && !empty($this->comp_sum))
               {
                   if (!isset($this->subtotal_data[$level]))
                   {
                       $this->subtotal_data[$level] = $new_data;
                   }
                   else
                   {
                       end($this->subtotal_data);
                       $i_max = key($this->subtotal_data);
                       for ($i = $i_max; $i >= $level; $i--)
                       {
                           $this->build_total_row[$row] = true;
                           $data[$row] = $this->subtotal_data[$i];
                           $row++;
                           if ($i != $level)
                           {
                               unset($this->subtotal_data[$i]);
                           }
                       }
                       $this->subtotal_data[$level] = $new_data;
                   }
               }
           }
           $this->addYChildrenData($i_data['children'], $data, $row, $level + 1, $params_n, $tab_col);
       }
   }

   function getDataLinkParams($param, $col)
   {
       $a_par = array();

       if (1 < sizeof($col))
       {
           for ($i = 0; $i < sizeof($col) - 1; $i++)
           {
               $a_par[] = $col[$i];
           }
       }

       return implode('|', array_merge($a_par, $param));
   }

   function getDataLink($field, $data, $value)
   {
       if (!isset($this->comp_sum_lnk[$field]) || !$this->comp_sum_lnk[$field]['show'])
       {
           return $value;
       }

       $s_link_field = $this->comp_sum_lnk[$field]['field'];

       $a_link = array(
       );

       if (!isset($a_link[$s_link_field]))
       {
           return $value;
       }

       $a_data = explode('|', $data);
       $a_par  = array();
       $b_ok   = true;

       foreach ($a_link[$s_link_field]['param'] as $s_param => $a_param)
       {
           if ('C' == $a_param['type'])
           {
               if (!isset($a_data[ $this->comp_field_nm[ $a_param['value'] ] ]))
               {
                   $b_ok = false;
               }
               else
               {
                   $a_par[$s_param] = $a_data[ $this->comp_field_nm[ $a_param['value'] ] ];
               }
           }
           else
           {
               $a_par[$s_param] = $a_param['value'];
           }
       }

       if (!$b_ok)
       {
           return $value;
       }

       $b_modal = false;
       if (false !== strpos($a_link[$s_link_field]['html'], '__NM_FLD_PAR_M__'))
       {
           $b_modal                       = true;
           $a_link[$s_link_field]['html'] = str_replace('__NM_FLD_PAR_M__', '__NM_FLD_PAR__', $a_link[$s_link_field]['html']);
       }

       $return = str_replace('__NM_FLD_PAR__', $this->getDataLinkValue($a_par), $a_link[$s_link_field]['html']) . $value . '</a>';

       return $b_modal ? $this->getModalLink($return) :  $return;
   }

   function getDataLinkValue($param)
   {
       $a_links = array();

       foreach ($param as $i => $v)
       {
           $a_links[] = $i . '?#?' . $v;
       }

       return implode('?@?', $a_links);
   }

   function getModalLink($param)
   {
       return str_replace(array('?#?', '?@?'), array('*scin', '*scout'), $param);
   }

   function getLabelLink($param, $i_tmp = -1, $bProtect = true)
   {
       $a_links = array();

       if (-1 == $i_tmp)
       {
           foreach ($param as $i => $v)
           {
               $i_fld     = $i + sizeof($this->comp_x_axys);
               $a_links[] = $this->comp_links_fl[$i_fld]['name'] . '?#?' . $this->comp_links_fl[$i_fld]['prot'] . addslashes($this->getChartText($v, $bProtect)) . $this->comp_links_fl[$i_fld]['prot'];
           }
       }
       else
       {
           for ($i = 0; $i <= $i_tmp; $i++)
           {
               $v         = (isset($param[$i])) ? $param[$i] : "";
               $i_fld     = $i + sizeof($this->comp_x_axys);
               $a_links[] = $this->comp_links_fl[$i_fld]['name'] . '?#?' . $this->comp_links_fl[$i_fld]['prot'] . addslashes($this->getChartText($v, $bProtect)) . $this->comp_links_fl[$i_fld]['prot'];
           }
       }

       $Parms_Res  = implode('?@?', $a_links);
       $Md5_Res    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_agenda_cliente@SC_par@" . md5($Parms_Res);
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['LigR_Md5'][md5($Parms_Res)] = $Parms_Res;
       return $Md5_Res;
   }

   function getChartLink($param, $bProtect = true)
   {
       $a_links = array();

       foreach ($param as $i => $v)
       {
           $a_links[] = $this->comp_links_fl[$i]['name'] . '?#?' . $this->comp_links_fl[$i]['prot'] . $this->getChartText($v, $bProtect) . $this->comp_links_fl[$i]['prot'];
       }

       return implode('?@?', $a_links);
   }

   function getCellCount($aColPar, $aRowPar)
   {
       array_pop($aColPar);
       $i_tot = 0;
       $a_val = (0 == sizeof($this->comp_x_axys))
              ? array_merge($aRowPar, array($i_tot))
              : array_merge($aColPar, $aRowPar, array($i_tot));
       return $this->getCompDataCell($a_val, $this->getCompData(sizeof($aColPar) + sizeof($aRowPar) - 1));
   }

   function getCellRating($aColPar, $aRowPar)
   {
       $i_tot = array_pop($aColPar);
       $a_val = (0 == sizeof($this->comp_x_axys))
              ? array_merge($aRowPar, array($i_tot))
              : array_merge($aColPar, $aRowPar, array($i_tot));
       return $this->getRatingSummarization($this->getCompDataCell($a_val, $this->getCompData(sizeof($aColPar) + sizeof($aRowPar) - 1)), $i_tot);
   }

   function getCellValue($aColPar, $aRowPar)
   {
       $i_tot = array_pop($aColPar);
       $a_val = (0 == sizeof($this->comp_x_axys))
              ? array_merge($aRowPar, array($i_tot))
              : array_merge($aColPar, $aRowPar, array($i_tot));
       return $this->getCompDataCell($a_val, $this->getCompData(sizeof($aColPar) + sizeof($aRowPar) - 1));
   }

   function getCompDataCell($par, $data)
   {
       $key = key($par);
       $cur = $par[$key];
       if (is_array($data[$cur]))
       {
           unset($par[$key]);
           return $this->getCompDataCell($par, $data[$cur]);
       }
       elseif (isset($data[$cur]))
       {
           return $data[$cur];
       }
       elseif (!$this->comp_sum_fill_0)
       {
           return '';
       }
       else
       {
           return 0;
       }
   }

   function makeTabular(&$a_data)
   {
       if ($this->comp_tabular)
       {
           $a_labels = array();
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf_vert'])
   {
     $this->comp_tab_hover = true;
   }
           if ($this->comp_tab_hover)
           {
               foreach ($a_data as $row => $columns)
               {
                   for ($i = 0; $i < sizeof($this->comp_y_axys) - 1; $i++)
                   {
                      if (!isset($a_labels[$i]))
                      {
                          $a_labels[$i] = '';
                      }
                      if (isset($a_data[$row][$i]) && !isset($a_data[$row][$i]['display_as']))
                      {
                          if (isset($columns[$i]['label']) && $a_labels[$i] == $columns[$i]['label'])
                          {
                              $a_data[$row][$i]['display_as'] = 'none';
                          }
                          else
                          {
                              $a_data[$row][$i]['display_as'] = 'auto';
                          }
                      }
                      $a_labels[$i] = (isset($columns[$i]['label'])) ? $columns[$i]['label'] : "";
                   }
               }
           }
           else
           {
               foreach ($a_data as $row => $columns)
               {
                   for ($i = 0; $i < sizeof($this->comp_y_axys) - 1; $i++)
                   {
                       if (!isset($a_labels[$i]))
                       {
                           $a_labels[$i] = array(
                               'old'  => $columns[$i]['label'],
                               'row'  => $row,
                               'span' => 1,
                           );
                       }
                       elseif ($a_labels[$i]['old'] == $columns[$i]['label'])
                       {
                           unset($a_data[$row][$i]);
                           $a_labels[$i]['span']++;
                       }
                       else
                       {
                           $a_data[ $a_labels[$i]['row'] ][$i]['rowspan'] = $a_labels[$i]['span'];
                           $a_labels[$i]['old']  = $columns[$i]['label'];
                           $a_labels[$i]['row']  = $row;
                           $a_labels[$i]['span'] = 1;
                       }
                   }
               }
               foreach ($a_labels as $i_col => $a_col_data)
               {
                   $a_data[ $a_col_data['row'] ][$i_col]['rowspan'] = $a_col_data['span'];
               }
           }
       }
   }

   function initTotalsX()
   {
       $this->comp_totals_x = array();

       if (!$this->show_totals_x)
       {
           return;
       }

       foreach ($this->comp_sum_order as $i_sum)
       {
           if ($this->comp_sum_display[$i_sum])
           {
               $l_sum = $this->comp_sum[$i_sum];
               $this->comp_totals_x[$i_sum - 1] = array('values' => array(), 'count' => array(), 'chart' => '');
           }
       }
   }

   function addTotalsX($col, $val, $chart, $count)
   {
       if (!$this->show_totals_x)
       {
           return;
       }

       $this->comp_totals_x[$col]['chart'] = $chart;
       $this->comp_totals_x[$col]['count'][] = $count;
       if (isset($this->comp_rating_sum[$col]) && '' != $this->comp_rating_sum[$col] && method_exists($this, $this->comp_rating_sum[$col])) {
           $this->comp_totals_x[$col]['values'][] = json_decode($val, true);
       } else {
           $this->comp_totals_x[$col]['values'][] = $val;
       }
   }

   function buildTotalsX(&$row, $col, $level, $label, $sub)
   {
       if (!$this->show_totals_x)
       {
           return;
       }

       foreach ($this->comp_sum_order as $i_sum)
       {
           if ($this->comp_sum_display[$i_sum])
           {
               $l_sum = $this->comp_sum[$i_sum];
               if (isset($this->comp_rating_sum[$i_sum - 1]) && '' != $this->comp_rating_sum[$i_sum - 1] && method_exists($this, $this->comp_rating_sum[$i_sum - 1])) {
                   $i_temp[$i_sum - 1] = array();
               } else {
                   $i_temp[$i_sum - 1] = '';
               }
               $i_count[$i_sum - 1] = 0;
           }
       }

       $key = key($this->comp_totals_x);

       for ($i = 0; $i < sizeof($this->comp_totals_x[$key]['values']); $i++)
       {
           foreach ($this->comp_sum_order as $i_sum)
           {
               if ($this->comp_sum_display[$i_sum])
               {
                   if (isset($this->comp_rating_sum[$i_sum - 1]) && '' != $this->comp_rating_sum[$i_sum - 1] && method_exists($this, $this->comp_rating_sum[$i_sum - 1])) {
                       foreach ($this->comp_totals_x[$i_sum - 1]['values'][$i]['vls'] as $ratingValue => $ratingCount) {
                           if (!isset($i_temp[$i_sum - 1][$ratingValue])) {
                               $i_temp[$i_sum - 1][$ratingValue] = 0;
                           }
                           $i_temp[$i_sum - 1][$ratingValue] += $ratingCount;
                       }
                       continue;
                   }
                   if ('' == $this->comp_totals_x[$i_sum - 1]['values'][$i])
                   {
                       $this->comp_totals_x[$i_sum - 1]['values'][$i] = 0;
                   }
                   $l_sum = $this->comp_sum[$i_sum];
                   $this_count = (int) $this->comp_totals_x[$i_sum - 1]['count'][$i];
                   if ('' == $i_temp[$i_sum - 1])
                   {
                       if ('A' == $this->comp_sum_fn[$i_sum])
                       {
                           $i_temp[$i_sum - 1] = $this->comp_totals_x[$i_sum - 1]['values'][$i] * $this_count;
                       } else {
                           $i_temp[$i_sum - 1] = $this->comp_totals_x[$i_sum - 1]['values'][$i];
                       }
                   }
                   elseif ('M' == $this->comp_sum_fn[$i_sum] && '' !== $this->comp_totals_x[$i_sum - 1]['values'][$i])
                   {
                       $i_temp[$i_sum - 1] = min($i_temp[$i_sum - 1], $this->comp_totals_x[$i_sum - 1]['values'][$i]);
                   }
                   elseif ('X' == $this->comp_sum_fn[$i_sum])
                   {
                       $i_temp[$i_sum - 1] = max($i_temp[$i_sum - 1], $this->comp_totals_x[$i_sum - 1]['values'][$i]);
                   }
                   else
                   {
                       if ('A' == $this->comp_sum_fn[$i_sum])
                       {
                           $i_temp[$i_sum - 1] += ($this->comp_totals_x[$i_sum - 1]['values'][$i] * $this_count);
                       } else {
                           $i_temp[$i_sum - 1] += $this->comp_totals_x[$i_sum - 1]['values'][$i];
                       }
                   }
                   $i_count[$i_sum - 1] += $this_count;
               }
           }
       }
       foreach ($this->comp_sum as $i_sum => $l_sum)
       {
           if (isset($this->comp_rating_sum[$i_sum - 1]) && '' != $this->comp_rating_sum[$i_sum - 1] && method_exists($this, $this->comp_rating_sum[$i_sum - 1])) {
               continue;
           }
           if ('A' == $this->comp_sum_fn[$i_sum] && isset($this->comp_totals_x[$i_sum - 1]['values']) && is_numeric($i_count[$i_sum - 1]))
           {
               $i_temp[$i_sum - 1] /= $i_count[$i_sum - 1];
           }
           if ('%' == $this->comp_sum_fn[$i_sum])
           {
               $i_temp[$i_sum - 1] = 100.00;
           }
       }
       foreach ($this->comp_sum_order as $i_sum)
       {
           if ($this->comp_sum_display[$i_sum])
           {
               $l_sum = $this->comp_sum[$i_sum];
               $row[] = array(
                   'total'  => true,
                   'level'  => -1,
                   'value'  => $i_temp[$i_sum - 1],
                   'rating' => $this->getRatingSummarization($i_temp[$i_sum - 1], $i_sum - 1, true),
                   'format' => $i_sum - 1,
                   'chart'  => $this->comp_totals_x[$i_sum - 1]['chart'],
               );
               if (0 == $level && 0 < sizeof($this->comp_x_axys))
               {
                   $this->addTotalsA('sint', $i_sum - 1, $i_temp[$i_sum - 1], $label);
               }
               if (($this->comp_tabular || 0 == $level) && !$sub)
               {
                   $aCellParams = array(
                       'col' => false,
                       'row' => array(),
                       'fnc' => $i_sum - 1
                   );
                   $this->addTotalsY($col + ($i_sum - 1), $i_temp[$i_sum - 1], $this->comp_sum_fn[$i_sum], $i_sum - 1, $aCellParams);
               }
           }
       }
   }

   function addTotalsA($mode, $col, $val, $label)
   {
       if (!isset($this->comp_totals_a[$col]))
       {
           $this->comp_totals_a[$col] = array(
               'labels' => array(),
               'values' => array(
                   'anal' => array(),
                   'sint' => array(),
               ),
           );
       }
       if ('sint' == $mode)
       {
           $this->comp_totals_a[$col]['labels'][]         = $label;
           $this->comp_totals_a[$col]['values']['sint'][] = $val;
       }
       elseif ('anal' == $mode)
       {
           if (isset($this->comp_index[ $this->comp_x_axys[0] ][$label]))
           {
               $label = $this->comp_index[ $this->comp_x_axys[0] ][$label];
           }
           $this->comp_totals_a[$col]['values']['anal'][$label][] = $val;
       }
   }

   function addTotalsAL($mode, $col, $val, $label)
   {
       if (!isset($this->comp_totals_al[$col]))
       {
           $this->comp_totals_al[$col] = array(
               'labels' => array(),
               'values' => array(
                   'anal' => array(),
                   'sint' => array(),
               ),
           );
       }
       if ('sint' == $mode)
       {
           $this->comp_totals_al[$col]['labels'][]         = $label;
           $this->comp_totals_al[$col]['values']['sint'][] = $val;
       }
       elseif ('anal' == $mode)
       {
           if (isset($this->comp_index[ $this->comp_y_axys[0] ][$label]))
           {
               $label = $this->comp_index[ $this->comp_y_axys[0] ][$label];
           }
           $this->comp_totals_al[$col]['values']['anal'][$label][] = $val;
       }
   }

   function addTotalsY($col, $val, $fun, $fmt, $par = array())
   {
       if (!$this->show_totals_y)
       {
           return;
       }

       if (!isset($this->comp_totals_y[$col]))
       {
           $this->comp_totals_y[$col] = array(
               'format'   => $fmt,
               'function' => $fun,
               'param_c'  => empty($par) ? false : $par['col'],
               'param_r'  => empty($par) ? false : $par['row'],
               'param_f'  => empty($par) ? ''    : $par['fnc'],
               'values'   => array(),
           );
       }
       $this->comp_totals_y[$col]['values'][] = $val;
   }

   function buildTotalsY(&$matrix)
   {
       if (!$this->show_totals_y)
       {
           return;
       }

       $row = sizeof($matrix);

       $this->build_total_row[$row] = true;

       $matrix[$row][] = array(
           'group'      => -1,
           'value'      => $this->Ini->Nm_lang['lang_msgs_totl'],
           'label'      => $this->Ini->Nm_lang['lang_msgs_totl'],
           'params'     => array(),
           'colspan'    => $this->comp_tabular ? sizeof($this->comp_y_axys) : 1,
           'display_as' => $this->comp_tab_hover ? 'total' : 'total'
       );

       $aTotals = array();
       foreach ($this->comp_totals_y as $cols)
       {
           $iSum           = empty($cols['param_c']) ? $this->getColumnTotal(false, $cols['param_f']) : $this->getColumnTotal($cols['param_c'], $cols['param_f']);
           if ($cols['function'] == "%") {
               $iSum = 100.00;
           }
           $aTotals[]      = $iSum;
           $matrix[$row][] = array(
               'total'  => true,
               'level'  => -1,
               'value'  => $iSum,
               'format' => $cols['format'],
           );
           $this->array_general_total[] = $iSum;
       }

       if (1 == sizeof($this->comp_x_axys))
       {
           $i_count = 0;
           $aLabels = array();
           foreach ($this->comp_index[0] as $group_label)
           {
               $aLabels[] = $group_label;
               foreach ($this->comp_sum as $i_sum => $l_sum)
               {
                   $this->comp_totals_al[$i_sum - 1]['values']['sint'][] = $aTotals[$i_count];
                   $i_count++;
               }
           }
           foreach ($this->comp_sum as $i_sum => $l_sum)
           {
               $this->comp_totals_al[$i_sum - 1]['labels'] = $aLabels;
           }
       }
   }

   function addTotalsG($line, $column, $param, $value)
   {
       $s_item  = $column['params'][0];
       $i_total = $column['params'][1];
       $param[] = $line['value'];
       $s_key   = 'G|' . $i_total . '|' . implode('|', $param);

       if (!isset($this->comp_totals_g[$s_key]))
       {
           $this->comp_totals_g[$s_key] = array(
               'title'    => $this->getChartText($this->comp_sum[$i_total + 1]),
               'show_sub' => true,
               'subtitle' => $this->getChartText($this->getChartSubtitle($param, 1)),
               'field_x'  => $this->getCompFieldName(0),
               'field_y'  => $this->comp_sum_nm[$i_total + 1],
               'label_x'  => $this->getChartText($this->comp_field[0]),
               'label_y'  => $this->getChartText($this->comp_sum[$i_total + 1]),
               'labels'   => array(),
               'values'   => array(
               'sint'     => array(0 => array()),
               ),
           );
       }

       $this->comp_totals_g[$s_key]['labels'][]            = isset($this->comp_index[0][$s_item]) ? $this->comp_index[0][$s_item] : $s_item;
       $this->comp_totals_g[$s_key]['values']['sint'][0][] = $value;

       return $s_key;
   }

   function getCompFieldName($index)
   {
       foreach ($this->comp_field_nm as $fieldName => $fieldIndex) {
           if ($index == $fieldIndex) {
               return $fieldName;
           }
       }
       return '';
   }

   function getColumnTotal($param_c, $param_f)
   {
       $paramCompRatingSum = $param_f;
       if (false == $param_c)
       {
           $final_data = $this->array_total_geral;
           if (empty($final_data)) {
               return "";
           }
           $param_f   -= 1;
       }
       else
       {
           if (1 == count($this->comp_x_axys)) {
               $return = $this->array_total_fecha_inicial;
           }
           elseif (2 == count($this->comp_x_axys)) {
               $return = $this->array_total_fecha_inicial_scgb_41;
           }
           $final_data = $this->getColumnTotalData($param_c, $return);
       }
       if (isset($this->comp_rating_sum[$paramCompRatingSum]) && '' != $this->comp_rating_sum[$paramCompRatingSum] && method_exists($this, $this->comp_rating_sum[$paramCompRatingSum])) {
           $fnName = $this->comp_rating_sum[$paramCompRatingSum];
           return $this->$fnName($final_data[$param_f]);
       } else {
           return $final_data[$param_f];
       }
   }

   function getColumnTotalData($param_c, $data)
   {
       $elem = array_shift($param_c);

       if (empty($param_c))
       {
            return $data[$elem];
       }
       else
       {
           return $this->getColumnTotalData($param_c, $data[$elem]);
       }
   }

   function buildColumnTotal($fun, $rows)
   {
       $total = '';

       foreach ($rows as $val)
       {
           if ('' == $total)
           {
               $total = $val;
           }
           elseif ('M' == $fun && '' !== $val)
           {
               $total = min($total, $val);
           }
           elseif ('X' == $fun)
           {
               $total = max($total, $val);
           }
           else
           {
               $total += $val;
           }
       }

       if ('A' == $fun)
       {
           $total /= sizeof($rows);
       }
       if ('%' == $fun)
       {
           $total = 100.00;
       }
       if ('W' == $fun || 'V' == $fun || 'P' == $fun)
       {
           $total = "";
       }

       return $total;
   }

   function buildChart()
   {
       $this->comp_chart_data   = array();

       $Lab_fecha_inicial = "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_inicial'] . "";
       $Lab_fecha_inicial =  sprintf("" . $this->Ini->Nm_lang['lang_othr_cons_title_YYYY'] . "", $Lab_fecha_inicial);
       $Lab_fecha_inicial_scgb_41 = "" . $this->Ini->Nm_lang['lang_agenda_fld_fecha_inicial'] . "";
       $Lab_fecha_inicial_scgb_41 =  sprintf("" . $this->Ini->Nm_lang['lang_othr_cons_title_SEMIANNUAL'] . "", $Lab_fecha_inicial_scgb_41);
       $this->comp_chart_config = array(
           '0|1' => array(
               'title'    => $this->getChartText(strip_tags("" .  $this->Ini->Nm_lang['lang_agenda_fld_valor_total'] . " (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . ")")),
               'show_sub' => true,
               'subtitle' => "",
               'field_x'  => 'fecha_inicial',
               'field_y'  => $this->comp_sum_nm[2],
               'label_x'  => $this->getChartText(strip_tags($Lab_fecha_inicial)),
               'label_y'  => $this->getChartText(strip_tags("" .  $this->Ini->Nm_lang['lang_agenda_fld_valor_total'] . " (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . ")")),
               'format'   => $this->formatChartValue(1),
           ),
           '0|2' => array(
               'title'    => $this->getChartText(strip_tags("" .  $this->Ini->Nm_lang['lang_agenda_fld_estado_actual'] . " (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_cnt'] . ")")),
               'show_sub' => true,
               'subtitle' => "",
               'field_x'  => 'fecha_inicial',
               'field_y'  => $this->comp_sum_nm[3],
               'label_x'  => $this->getChartText(strip_tags($Lab_fecha_inicial)),
               'label_y'  => $this->getChartText(strip_tags("" .  $this->Ini->Nm_lang['lang_agenda_fld_estado_actual'] . " (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_cnt'] . ")")),
               'format'   => $this->formatChartValue(2),
           ),
           '1|1' => array(
               'title'    => $this->getChartText(strip_tags("" .  $this->Ini->Nm_lang['lang_agenda_fld_valor_total'] . " (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . ")")),
               'show_sub' => true,
               'subtitle' => "",
               'field_x'  => 'fecha_inicial_scgb_41',
               'field_y'  => $this->comp_sum_nm[2],
               'label_x'  => $this->getChartText(strip_tags($Lab_fecha_inicial_scgb_41)),
               'label_y'  => $this->getChartText(strip_tags("" .  $this->Ini->Nm_lang['lang_agenda_fld_valor_total'] . " (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . ")")),
               'format'   => $this->formatChartValue(1),
           ),
           '1|2' => array(
               'title'    => $this->getChartText(strip_tags("" .  $this->Ini->Nm_lang['lang_agenda_fld_estado_actual'] . " (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_cnt'] . ")")),
               'show_sub' => true,
               'subtitle' => "",
               'field_x'  => 'fecha_inicial_scgb_41',
               'field_y'  => $this->comp_sum_nm[3],
               'label_x'  => $this->getChartText(strip_tags($Lab_fecha_inicial_scgb_41)),
               'label_y'  => $this->getChartText(strip_tags("" .  $this->Ini->Nm_lang['lang_agenda_fld_estado_actual'] . " (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_cnt'] . ")")),
               'format'   => $this->formatChartValue(2),
           ),
           'T|1' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(1),
           ),
           'T|2' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(2),
           ),
       );

       $aTotalGeneral = false ? $this->comp_totals_al : $this->comp_totals_a;
       if (!empty($aTotalGeneral))
       {
           foreach ($aTotalGeneral as $i_total => $a_total)
           {
               if (isset($this->comp_chart_config['T|' . $i_total]))
               {
                   if (false)
                   {
                       $sTitleAxysX  = $this->comp_field[0];
                       $sTitleLegend = '' != $this->comp_chart_config[$key]['label_x']  ? $this->comp_chart_config[$key]['label_x']  : $this->getChartText($this->comp_field[sizeof($this->comp_x_axys)]);
                   }
                   else
                   {
                       $sTitleAxysX  = '' != $this->comp_chart_config[$key]['label_x']  ? $this->comp_chart_config[$key]['label_x']  : $this->getChartText($this->comp_field[sizeof($this->comp_x_axys)]);
                       $sTitleLegend = $this->comp_field[0];
                   }
                   $key = 'T|' . $i_total;
                   $this->comp_chart_data[$key] = array(
                       'title'    => '' != $this->comp_chart_config[$key]['title']    ? $this->comp_chart_config[$key]['title']    : $this->getChartText($this->Ini->Nm_lang['lang_othr_chrt_totl']),
                       'show_sub' => $this->comp_chart_config[$key]['show_sub'],
                       'subtitle' => '' != $this->comp_chart_config[$key]['subtitle'] ? $this->comp_chart_config[$key]['subtitle'] : $this->getChartText($this->comp_sum[$i_total + 1]),
                       'legend'   => $sTitleLegend,
                       'label_x'  => $sTitleAxysX,
                       'label_y'  => '' != $this->comp_chart_config[$key]['label_y']  ? $this->comp_chart_config[$key]['label_y']  : $this->getChartText($this->comp_sum[$i_total + 1]),
                       'format'   => $this->comp_chart_config[$key]['format'],
                       'labels'   => $a_total['labels'],
                       'values'   => array(
                           'anal' => $a_total['values']['anal'],
                           'sint' => array($a_total['values']['sint']),
                       ),
                   );
               }
           }
       }

       foreach ($this->comp_y_axys as $i_group)
       {
           $this->addGroupCharts($this->comp_chart_data, $this->getCompData($i_group), $i_group, $i_group, array());
       }

       if (!empty($this->comp_totals_g))
       {
           foreach ($this->comp_totals_g as $chart => $data)
           {
               $info = explode('|', $chart);
               $key  = 'G|' . (sizeof($info) - 2) . '|' . $info[1];
               if (isset($this->comp_chart_config[$key]))
               {
                   $this->comp_chart_data[$chart]             = $data;
                   $this->comp_chart_data[$chart]['show_sub'] = $this->comp_chart_config[$key]['show_sub'];
                   if ('' != $this->comp_chart_config[$key]['title'])
                   {
                       $this->comp_chart_data[$chart]['title'] = $this->comp_chart_config[$key]['title'];
                   }
                   if ('' != $this->comp_chart_config[$key]['subtitle'])
                   {
                       $this->comp_chart_data[$chart]['subtitle'] = $this->comp_chart_config[$key]['subtitle'];
                   }
                   if ('' != $this->comp_chart_config[$key]['label_x'])
                   {
                       $this->comp_chart_data[$chart]['label_x'] = $this->comp_chart_config[$key]['label_x'];
                   }
                   if ('' != $this->comp_chart_config[$key]['label_y'])
                   {
                       $this->comp_chart_data[$chart]['label_y'] = $this->comp_chart_config[$key]['label_y'];
                   }
               }
           }
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_charts']    = $this->comp_chart_data;
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_orig']      = $this->comp_chart_data;
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['comb_table_data'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['comb_table_def']  = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['anlt_table_data'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['anlt_table_def']  = array();

       $this->filterChartsByGroupbyLevel();


       require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
       $this->Graf  = new grid_agenda_cliente_grafico();
       $this->Graf->Db     = $this->Db;
       $this->Graf->Erro   = $this->Erro;
       $this->Graf->Ini    = $this->Ini;
       $this->Graf->Lookup = $this->Lookup;
       foreach ($this->comp_chart_data as $sChartKey => $aChartData)
       {
           $this->Graf->monta_grafico($sChartKey, 'xml');
       }
   }

	function filterChartsByGroupbyLevel() {
		global $nmgp_opcao;

		$applyFilter = false;

		if (isset($nmgp_opcao) && ('pdf' == $nmgp_opcao || 'pdf_res' == $nmgp_opcao) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['chart_level']) && '' !== $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['chart_level']) {
			$applyFilter = true;
		}
		elseif (isset($nmgp_opcao) && 'image_res' == $nmgp_opcao && isset($_POST['chart_level']) && '' !== $_POST['chart_level']) {
			$applyFilter = true;
			$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['chart_level'] = $_POST['chart_level'];
		}
		elseif (isset($nmgp_opcao) && 'print_res' == $nmgp_opcao && isset($_POST['chart_level']) && '' !== $_POST['chart_level']) {
			$applyFilter = true;
			$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['chart_level'] = $_POST['chart_level'];
		}
		elseif ($this->Ini->sc_export_ajax && isset($_POST['chart_level']) && '' !== $_POST['chart_level']) {
			$applyFilter = true;
			$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['chart_level'] = $_POST['chart_level'];
		}

		$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_charts'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_orig'];

		if ($applyFilter) {
			foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_charts'] as $chartIndex => $chartData) {
				$indexParts = explode('|', $chartIndex);

				if (in_array($indexParts[0], array('C', 'G', 'T'))) {
					$groupbyLevel = $indexParts[1];
				}
				else {
					$groupbyLevel = $indexParts[0];
				}

				if ($groupbyLevel > $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['chart_level']) {
					unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_charts'][$chartIndex]);
				}
			}
		}

		$this->comp_chart_data = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_charts'];
	}

   function formatChartValue($total)
   {
       $arr_param = array();

       if ($total == 1)
       {
           $arr_param = array(
               'decimals'          => "2",
               'decimalSeparator'  => "" . $_SESSION['scriptcase']['reg_conf']['dec_num'] . "",
               'thousandSeparator' => "" . $_SESSION['scriptcase']['reg_conf']['grup_num'] . "",
               'trailingZeros'     => "2",
               'monetarySymbol'    => "",
               'monetaryPosition'  => "" . (in_array($_SESSION['scriptcase']['reg_conf']['monet_f_pos'], array(1, 3)) ? 'left' : 'right') . "",
               'monetarySpace'     => "" . (in_array($_SESSION['scriptcase']['reg_conf']['monet_f_pos'], array(3, 4)) ? ' '    : ''     ) . "",
               'monetaryDecimal'   => "" . $_SESSION['scriptcase']['reg_conf']['dec_val'] . "",
               'monetaryThousands' => "" . $_SESSION['scriptcase']['reg_conf']['grup_val'] . "",
               'formatNumberScale' => "0",
               'forceDecimals'     => "1",
           );
       }
       if ($total == 2)
       {
           $arr_param = array(
               'decimals'          => "0",
               'decimalSeparator'  => "" . $_SESSION['scriptcase']['reg_conf']['dec_num'] . "",
               'thousandSeparator' => "" . $_SESSION['scriptcase']['reg_conf']['grup_num'] . "",
               'trailingZeros'     => "0",
               'monetarySymbol'    => "",
               'monetaryPosition'  => "" . (in_array($_SESSION['scriptcase']['reg_conf']['monet_f_pos'], array(1, 3)) ? 'left' : 'right') . "",
               'monetarySpace'     => "" . (in_array($_SESSION['scriptcase']['reg_conf']['monet_f_pos'], array(3, 4)) ? ' '    : ''     ) . "",
               'monetaryDecimal'   => "" . $_SESSION['scriptcase']['reg_conf']['dec_val'] . "",
               'monetaryThousands' => "" . $_SESSION['scriptcase']['reg_conf']['grup_val'] . "",
               'formatNumberScale' => "0",
               'forceDecimals'     => "1",
           );
       }

       $sMonetIni = '';
       $sMonetEnd = '';

       if ('' != $arr_param['monetarySymbol'])
       {
           if ('' == $arr_param['monetaryPosition'] || 'left' == $arr_param['monetaryPosition'])
           {
               $sMonetIni = $arr_param['monetarySymbol'] . $arr_param['monetarySpace'];
               $sMonetEnd = '';
           }
           else
           {
               $sMonetIni = '';
               $sMonetEnd = $arr_param['monetarySpace'] . $arr_param['monetarySymbol'];
           }
           $arr_param['decimalSeparator']  = $arr_param['monetaryDecimal'];
           $arr_param['thousandSeparator'] = $arr_param['monetaryThousands'];
       }
       if ('' == $arr_param['decimals'])
       {
           $arr_param['decimals'] = 0;
           unset($arr_param['trailingZeros']);
       }
       elseif (1 != $arr_param['forceDecimals'])
       {
           $arr_param['forceDecimals'] = 0;
       }
       else
       {
           $arr_param['forceDecimals'] = 1;
       }
       if ('' == $arr_param['trailingZeros'])
       {
           unset($arr_param['trailingZeros']);
       }
       if ('' != $sMonetIni)
       {
           $arr_param['numberPrefix'] = $sMonetIni;
       }
       if ('' != $sMonetEnd)
       {
           $arr_param['numberSuffix'] = $sMonetEnd;
       }
       unset($arr_param['monetarySymbol']);
       unset($arr_param['monetaryPosition']);
       unset($arr_param['monetarySpace']);
       unset($arr_param['monetaryDecimal']);
       unset($arr_param['monetaryThousands']);

       if (',' == $arr_param['decimalSeparator'])
       {
           unset($arr_param['decimalSeparator']);
           $arr_param['decimalSeparator'] = ',';
       }
       if (',' == $arr_param['thousandSeparator'])
       {
           unset($arr_param['thousandSeparator']);
           $arr_param['thousandSeparator'] = ',';
       }

       if (isset($arr_param['formatNumberScale']) && '1' == $arr_param['formatNumberScale'])
       {
           unset($arr_param['trailingZeros']);
           $arr_param['decimals'] = 0;
       }

       foreach ($arr_param as $i => $v)
       {
           if ('' === $v)
           {
               unset($arr_param[$i]);
           }
       }

       return $arr_param;
   }

   function addGroupCharts(&$charts, $data, $group, $level, $param)
   {
       if (0 == $level)
       {
           $a_keys   = array();
           $a_totals = array();
           $this->getKeysTotals($a_keys, $a_totals, $data, $param);
           foreach ($a_totals as $i_total => $values)
           {
               $key_data  = $key_config = $group . '|' . $i_total;
               $key_data .= '|' . implode('|', $param);
               if (isset($this->comp_chart_config[$key_config]))
               {
                   $this->comp_chart_data[$key_data]                      = $this->comp_chart_config[$key_config];
                   $this->comp_chart_data[$key_data]['param']             = $param;
                   $this->comp_chart_data[$key_data]['summ_idx']          = $i_total;
                   $this->comp_chart_data[$key_data]['summ_fn']           = $this->comp_sum_fn[$i_total + 1];
                   $this->comp_chart_data[$key_data]['labels']            = $this->getGroupLabels($group, $a_keys);
                   $this->comp_chart_data[$key_data]['db_values']         = $a_keys;
                   $this->comp_chart_data[$key_data]['label_order']       = $this->comp_order[$group];
                   $this->comp_chart_data[$key_data]['values']['sint'][0] = $values;
                   $grid_links = array();
                   $xml_links  = array();
                   foreach ($a_keys as $tmp_key)
                   {
                       $link_index   = array_merge($param, array($tmp_key));
                       $grid_links[] = $this->getChartLink($link_index, -1);
                       $xml_links[]  = $this->getFusionLink('sc_grid_agenda_cliente_' . session_id() . '_!!!' . implode('_', array_merge(array($group + 1, $i_total), $link_index)) . '!!!.json');
                   }
                   $this->comp_chart_data[$key_data]['grid_links'] = $grid_links;
                   $this->comp_chart_data[$key_data]['xml_links']  = (sizeof($this->comp_y_axys) > $group + 1) ? $xml_links : array();
                   $this->comp_chart_data[$key_data]['xml']        = $this->getFusionLink('sc_grid_agenda_cliente_' . session_id() . '_!!!' . implode('_', array_merge(array($group, $i_total), $param)) . '!!!.json');
                   if (0 < $group && !empty($param))
                   {
                       $this->comp_chart_data[$key_data]['subtitle'] = $this->getChartText($this->getChartSubtitle($param));
                   }
                   if (0 == sizeof($this->comp_x_axys) && empty($param))
                   {
                       $this->getAnaliticCharts($i_total, $this->comp_chart_data[$key_data]);
                   }
               }
           }
       }
       else
       {
           foreach ($data as $key => $list)
           {
               $this->addGroupCharts($charts, $list, $group, $level - 1, array_merge($param, array($key)));
           }
       }
   }

   function getFusionLink($originalLink)
   {
       $linkParts = explode('!!!', $originalLink);

       if (1 == count($linkParts)) {
           return $originalLink;
       }

       $linkParts[1] = md5($linkParts[1]);

       return implode('', $linkParts);
   }

   function getKeysTotals(&$a_keys, &$a_totals, $data, $param)
   {
       for ($i = 0; $i < sizeof($this->comp_x_axys); $i++)
       {
           $key_param = key($param);
           unset($param[$key_param]);
       }
       $list_data = $this->comp_chart_axys;
       foreach ($param as $now_param)
       {
           $list_data = $list_data[$now_param]['children'];
       }
       $list_data = (is_array($list_data)) ? array_keys($list_data) : array();
       $size = sizeof($this->comp_sum_dummy);
       foreach ($list_data as $k_group)
       {
           if (isset($data[$k_group])) {
               $totals = $data[$k_group];
           }
           else {
               $totals = $this->comp_sum_dummy;
           }
           $a_keys[] = $k_group;
           $count    = 0;
           foreach ($totals as $i_total => $v_total)
           {
               if ($count == $size)
               {
                   break;
               }
               $a_totals[$i_total][] = $v_total;
               $count++;
           }
       }
       if (!empty($param))
       {
           $a_indexes = $this->getRealIndexes($this->comp_chart_axys, $param);
           foreach ($a_keys as $i => $v)
           {
               if (!in_array($v, $a_indexes))
               {
                   unset($a_keys[$i]);
                   foreach ($a_totals as $t => $l)
                   {
                       unset($a_totals[$t][$i]);
                   }
               }
           }
           $a_keys = array_values($a_keys);
           foreach ($a_totals as $t => $l)
           {
               $a_totals[$t] = array_values($a_totals[$t]);
           }
       }
   }

   function getRealIndexes($data, $param)
   {
       if (empty($param))
       {
           $a_indexes = array();
           foreach ($data as $i => $v)
           {
               $a_indexes[] = $i;
           }
           return $a_indexes;
       }
       else
       {
           $key = key($param);
           $val = $param[$key];
           unset($param[$key]);
           return $this->getRealIndexes($data[$val]['children'], $param);
       }
   }

   function getGroupLabels($group, $keys)
   {
       $a_labels = array();
       foreach ($keys as $key)
       {
           $a_labels[] = isset($this->comp_index[$group][$key]) ? $this->comp_index[$group][$key] : $key;
       }
       return $a_labels;
   }

   function getChartSubtitle($param, $s = 0)
   {
       $a_links = array();

       foreach ($param as $i => $v)
       {
           $a_links[] = $this->comp_field[$i + $s] . ' = ' . $this->comp_index[$i + $s][$v];
       }

       return implode(' :: ', $a_links);
   }

   function getAnaliticCharts($total, &$chart_data)
   {
       $chart_data['labels_anal']           = array();
       $chart_data['legend']                = (isset($this->comp_field[1])) ? $this->comp_field[1] : "";
       $chart_data['values']['anal']        = array();
       $chart_data['values']['anal_values'] = array();
       $chart_data['values']['anal_links']  = array();

       foreach ($this->comp_index[0] as $i_0 => $v_0)
       {
           $chart_data['labels_anal'][] = $v_0;
       }
      if (isset($this->comp_index[1])) {
       foreach ($this->comp_index[1] as $i_1 => $v_1)
       {
           $chart_data['values']['anal'][$v_1] = array();
           foreach ($this->comp_index[0] as $i_0 => $v_0)
           {
               $vCompData                                  = $this->getCompData(1, array($i_0, $i_1, $total));
               $chart_data['values']['anal'][$v_1][]       = isset($vCompData) ? $vCompData : 0;
               $chart_data['values']['anal_values'][$v_1]  = $i_1;
               $chart_data['values']['anal_links'][$i_1][] = $this->getChartLink(array($i_0, $i_1), -1);
           }
       }
      }
   }

   function getChartText($s, $bProtect = true)
   {
       if (!$bProtect)
       {
           return $s;
       }
       if ('UTF-8' != $_SESSION['scriptcase']['charset'])
       {
           $s = sc_convert_encoding($s, 'UTF-8', $_SESSION['scriptcase']['charset']);
       }
       return function_exists('html_entity_decode') ? html_entity_decode($s, ENT_COMPAT | ENT_HTML401, 'UTF-8') : $s;
   }

   function drawMatrix()
   {
       global $nm_saida;

       if ($this->NM_export)
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['arr_export']['label'] = $this->build_labels;
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['arr_export']['data']  = $this->build_data;
           return;
       }

       $nm_saida->saida("<tr id=\"summary_body\" class='sc-mobile-inner-control'>\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'])
       { 
           $_SESSION['scriptcase']['saida_html'] = "";
       } 
      $TD_padding = (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] == "pdf") ? " style=\"padding: 0px !important;\"" : "";
       $nm_saida->saida("<td class=\"" . $this->css_scGridTabelaTd . " sc-mobile-inner-control\"" . $TD_padding . ">\r\n");
       $nm_saida->saida("<table class=\"scGridTabela\" id=\"sc-ui-summary-body\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%;\">\r\n");

       $this->drawMatrixLabels();
      if ($this->comp_tab_hover)
      {
          $nm_saida->saida("    <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("        $(function() {\r\n");
          $nm_saida->saida("            $(\".scGridSummaryLine\").click(function() {\r\n");
          $nm_saida->saida("              var bHasClicked = $(this).find(\".scGridSummaryLineOdd\").hasClass(\"scGridSummaryClickedLine\") || $(this).find(\".scGridSummaryLineEven\").hasClass(\"scGridSummaryClickedLine\") || $(this).find(\".scGridSummarySubtotal\").hasClass(\"scGridSummaryClickedSubtotal\") || $(this).find(\".scGridSummaryTotal\").hasClass(\"scGridSummaryClickedTotal\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryLineOdd\").removeClass(\"scGridSummaryClickedLine\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryLineEven\").removeClass(\"scGridSummaryClickedLine\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryGroupbyVisible\").removeClass(\"scGridSummaryClickedGroupbyVisible\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryGroupbyInvisible\").removeClass(\"scGridSummaryClickedGroupbyInvisible\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryGroupbyInvisibleDisplay\").removeClass(\"scGridSummaryClickedGroupbyInvisibleDisplay\");\r\n");
          $nm_saida->saida("              $(\".scGridSummarySubtotal\").removeClass(\"scGridSummaryClickedSubtotal\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryTotal\").removeClass(\"scGridSummaryClickedTotal\");\r\n");
          $nm_saida->saida("              if (!bHasClicked) {\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryLineOdd\").addClass(\"scGridSummaryClickedLine\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryLineEven\").addClass(\"scGridSummaryClickedLine\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryGroupbyVisible\").addClass(\"scGridSummaryClickedGroupbyVisible\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryGroupbyInvisible\").addClass(\"scGridSummaryClickedGroupbyInvisible\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryGroupbyInvisibleDisplay\").addClass(\"scGridSummaryClickedGroupbyInvisibleDisplay\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummarySubtotal\").addClass(\"scGridSummaryClickedSubtotal\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryTotal\").addClass(\"scGridSummaryClickedTotal\");\r\n");
          $nm_saida->saida("              }\r\n");
          $nm_saida->saida("            });\r\n");
          $nm_saida->saida("        });\r\n");
          $nm_saida->saida("    </script>\r\n");
      }

       $s_class   = 'scGridSummaryLineOdd';
       $s_class_v = 'scGridSummaryGroupbyVisible';
        $iSeqCount = 0;
       foreach ($this->build_data as $row_i => $lines)
       {
           $fixedColumnCount = 0;
           $this->prim_linha = false;
           $sTrClass         = $this->comp_tab_hover ? ' class="scGridSummaryLine"' : '';
           $nm_saida->saida(" <tr $sTrClass>\r\n");
           if ($this->comp_tab_seq)
           {
               if ($this->build_total_row[$row_i])
               {
                   $sSeqDisplay = '&nbsp;';
               }
               else
               {
                   $iSeqCount++;
                   $sSeqDisplay = $iSeqCount;
               }
               $nm_saida->saida(" <td class=\"scGridSummaryGroupbyVisible scGridSummaryGroupbySeq sc-col-op sc-col-op-seq\">$sSeqDisplay</td>\r\n");
           }
           foreach ($lines as $col_i => $columns)
           {
               $this->NM_graf_left = $this->Graf_left_dat;
               if (isset($columns['level']) && 0 <= $columns['level'])
               {
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida'])
                   {
                       $columns['label'] = ($columns['label'] == "") ? "&nbsp;" : $columns['label'];
                       $s_label   = (isset($columns['link']) && '' != $columns['link']) ? "<a href=\"javascript: nm_link_cons('" . $columns['link'] . "')\" class=\"" . (isset($columns['display_as']) && 'none' == $columns['display_as'] ? 'scGridSummaryGroupbyInvisibleLink' : 'scGridSummaryGroupbyVisibleLink') . "\">" . $columns['label'] . '</a>' : $columns['label'];
                   }
                   else
                   {
                       $s_label   = $columns['label'];
                   }
                   $s_style   = '';
                   $s_text    = $this->comp_tabular ? $s_label : str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $columns['level']) . $s_label;
                   $s_class_v = 'scGridSummaryGroupbyVisible';
                   if (isset($columns['display_as']) && 'none' == $columns['display_as'])
                   {
                       $s_text    = '<span class="scGridSummaryGroupbyInvisibleDisplay">' . $s_text . '</span>';
                       $s_class_v = 'scGridSummaryGroupbyInvisible';
                   }
                   elseif (isset($columns['display_as']) && 'subtotal' == $columns['display_as'])
                   {
                       $s_class_v = 'scGridSummarySubtotal';
                   }
                   elseif (isset($columns['display_as']) && 'total' == $columns['display_as'])
                   {
                       $s_class_v = 'scGridSummaryTotal';
                   }
                   $s_class_fix_fld = ' sc-col-fld sc-col-fld-';
                   $s_class_fix_fld_idx = $fixedColumnCount;
                   $fixedColumnCount++;
               }
               else
               {
                   $s_style = '';
                   $columnValue = isset($columns['rating']) && '' != $columns['rating'] ? $columns['rating'] : $this->formatValue($columns['format'], $columns['value']);
                   if (isset($columns['total']) && $columns['total'])
                   {
                       $s_style   = ' style="text-align: right"';
                       $s_text    = $columnValue;
                       $s_class_v = 'scGridSummaryTotal';
                       $this->NM_graf_left = $this->Graf_left_tot;
                   }
                   elseif (isset($columns['subtotal']) && $columns['subtotal'])
                   {
                       $s_text    = $columnValue;
                       $s_class_v = 'scGridSummarySubtotal';
                   }
                   else
                   {
                       if (!isset($columns['link_fld']))  { $columns['link_fld']  = "";}
                       if (!isset($columns['link_data'])) { $columns['link_data'] = "";}
                       if (!isset($columns['format']))    { $columns['format']    = "";}
                       $s_text    = $this->getDataLink($columns['link_fld'], $columns['link_data'], $columnValue);
                       $s_class_v = $s_class;
                   }
                   $s_class_fix_fld = '';
                   $s_class_fix_fld_idx = '';
               }
               $css     = (isset($columns['css']) && '' != $columns['css']) ? ' ' . $columns['css'] . '_field' : '';
               $colspan = (isset($columns['colspan']) && 1 < $columns['colspan']) ? ' colspan="' . $columns['colspan'] . '"' : '';
               $rowspan = (isset($columns['rowspan']) && 1 < $columns['rowspan']) ? ' rowspan="' . $columns['rowspan'] . '"' : '';
               $chart   = (($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida']) && isset($columns['chart']) && '' != $columns['chart'] && isset($this->comp_chart_data[ $columns['chart'] ]))
                        ? nmButtonOutput($this->arr_buttons, "bgraf", "nm_graf_submit_2('" . $columns['chart'] . "')", "nm_graf_submit_2('" . $columns['chart'] . "')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->comp_chart_data[ $columns['chart'] ]['label_x'] . " X " . $this->comp_chart_data[ $columns['chart'] ]['label_y'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "") : '';
               if ($this->NM_graf_left)
               {
                   $nm_saida->saida("  <td" . $s_style . " class=\"" . $s_class_v . $s_class_fix_fld . $s_class_fix_fld_idx . $css . "\"" . $colspan . "" . $rowspan . ">" . $chart . "" . $s_text . "</td>\r\n");
               }
               else
               {
                   $nm_saida->saida("  <td" . $s_style . " class=\"" . $s_class_v . $s_class_fix_fld . $s_class_fix_fld_idx . $css . "\"" . $colspan . "" . $rowspan . ">" . $s_text . "" . $chart . "</td>\r\n");
               }
           }
           $nm_saida->saida(" </tr>\r\n");
           if ('scGridSummaryLineOdd' == $s_class)
           {
               $s_class                   = 'scGridSummaryLineEven';
               $this->Ini->cor_link_dados = 'scGridFieldEvenLink';
           }
           else
           {
               $s_class                   = 'scGridSummaryLineOdd';
               $this->Ini->cor_link_dados = 'scGridFieldOddLink';
           }
       }

       $nm_saida->saida("</table>\r\n");
       $nm_saida->saida("</td>\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'])
       { 
           $nm_saida->saida("<script>\r\n");
           $nm_saida->saida("if (typeof ratingBreakdownDisplay == \"function\") {\r\n");
           $nm_saida->saida("    setTimeout(function() { ratingBreakdownDisplay() }, 500);\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("</script>\r\n");
           if ($this->proc_res_grid)
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_res_grid', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
           } 
           else 
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'summary_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
           } 
           $_SESSION['scriptcase']['saida_html'] = "";
       } 
       $nm_saida->saida("</tr>\r\n");
   }

   function drawMatrixLabels()
   {
       global $nm_saida;

       $this->prim_linha = true;

       $nm_saida->saida("    <script type=\"text/javascript\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida'])
       { 
           $nm_saida->saida("        function sc_session_redir(url_redir)\r\n");
           $nm_saida->saida("        {\r\n");
           $nm_saida->saida("            if (typeof(sc_session_redir_mobile) === typeof(function(){})) { sc_session_redir_mobile(url_redir); }\r\n");
           $nm_saida->saida("            if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')\r\n");
           $nm_saida->saida("            {\r\n");
           $nm_saida->saida("                window.parent.sc_session_redir(url_redir);\r\n");
           $nm_saida->saida("            }\r\n");
           $nm_saida->saida("            else\r\n");
           $nm_saida->saida("            {\r\n");
           $nm_saida->saida("                if (window.opener && typeof window.opener.sc_session_redir === 'function')\r\n");
           $nm_saida->saida("                {\r\n");
           $nm_saida->saida("                    window.close();\r\n");
           $nm_saida->saida("                    window.opener.sc_session_redir(url_redir);\r\n");
           $nm_saida->saida("                }\r\n");
           $nm_saida->saida("                else\r\n");
           $nm_saida->saida("                {\r\n");
           $nm_saida->saida("                    window.location = url_redir;\r\n");
           $nm_saida->saida("                }\r\n");
           $nm_saida->saida("            }\r\n");
           $nm_saida->saida("        }\r\n");
       }
       $nm_saida->saida("        $(function() {\r\n");
       $nm_saida->saida("            $(\".sc-ui-sort\").mouseover(function() {\r\n");
       $nm_saida->saida("                $(this).css(\"cursor\", \"pointer\");\r\n");
       $nm_saida->saida("            }).click(function() {\r\n");
       $nm_saida->saida("                var newOrder, colOrder;\r\n");
       $nm_saida->saida("                if ($(this).hasClass(\"sc-ui-sort-desc\")) {\r\n");
       $nm_saida->saida("                    $(this).removeClass(\"sc-ui-sort-desc\").addClass(\"sc-ui-sort-asc\");\r\n");
       $nm_saida->saida("                    newOrder = \"asc\";\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("                else {\r\n");
       $nm_saida->saida("                    $(this).removeClass(\"sc-ui-sort-asc\").addClass(\"sc-ui-sort-desc\");\r\n");
       $nm_saida->saida("                    newOrder = \"desc\";\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("                colOrder = $(this).attr(\"id\").substr(11);\r\n");
       $nm_saida->saida("                changeSort(colOrder, newOrder, false);\r\n");
       $nm_saida->saida("            });\r\n");
       $nm_saida->saida("        });\r\n");
       $nm_saida->saida("    </script>\r\n");
if($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf_vert']) { 
           $nm_saida->saida("   <thead>\r\n");
       $this->monta_cabecalho();
 }

       $apl_cab_resumo = $this->Ini->Nm_lang['lang_othr_smry_msge'];

       $b_display     = false;
       $b_display_seq = false;
       foreach ($this->build_labels as $lines)
       {
           $nm_saida->saida(" <tr class=\"sc-ui-summary-header-row\">\r\n");
           if ($this->comp_tab_seq && !$b_display_seq) {
               $nm_saida->saida("  <td class=\"scGridSummaryLabel sc-col-title sc-col-op sc-col-op-seq\" rowspan=\"" . sizeof($this->build_labels) . "\">&nbsp;</td>\r\n");
               $b_display_seq = true;
           }

           if (!$b_display)
           {
               if ($this->comp_tabular)
               {
                   $fixedColumnCount = 0;
                   foreach ($this->comp_y_axys as $iYAxysIndex)
                   {
                       $hasOrder = !isset($this->comp_order_enabled[$iYAxysIndex]) || $this->comp_order_enabled[$iYAxysIndex];
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf_vert']) {
                           $hasOrder = false;
                       }
                       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_start'][$iYAxysIndex]))
                       {
                           $sInitialOrder   = '';
                           $sInitialOrderFA = '';
                           $sInitialDisplay = '; display: none';
                           $sInitialSrc     = '';
                       }
                       elseif ('asc' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_order_start'][$iYAxysIndex])
                       {
                           $sInitialOrder   = ' sc-ui-sort-asc';
                           $sInitialOrderFA = 'asc';
                           $sInitialDisplay = '';
                           $sInitialSrc     = $this->Ini->Label_summary_sort_asc;
                       }
                       else
                       {
                           $sInitialOrder   = ' sc-ui-sort-desc';
                           $sInitialOrderFA = 'desc';
                           $sInitialDisplay = '';
                           $sInitialSrc     = $this->Ini->Label_summary_sort_desc;
                       }
                       $nm_saida->saida("  <td class=\"scGridSummaryLabel sc-col-title sc-col-fld sc-col-fld-{$fixedColumnCount}\" rowspan=\"" . sizeof($this->build_labels) . "\">\r\n");
                       if ($hasOrder) {
                           $nm_saida->saida("    <span class=\"sc-ui-sort" . $sInitialOrder . "\" id=\"sc-id-sort-" . $iYAxysIndex . "\">\r\n");
                       }
                       $nm_saida->saida("   " . $this->comp_field[$iYAxysIndex] . "\r\n");
                       if ($hasOrder) {
                           $faOrderIcon = $this->scGetFontawesomeOrderIcon($sInitialOrderFA, $iYAxysIndex);
                               $nm_saida->saida("     " . $faOrderIcon . "\r\n");
                           $nm_saida->saida("    </span>\r\n");
                       }
                       $nm_saida->saida("  </td>\r\n");
                       $fixedColumnCount++;
                   }
               }
               else
               {
                   $nm_saida->saida("  <td class=\"scGridSummaryLabel sc-col-title sc-col-fld sc-col-fld-0\" rowspan=\"" . sizeof($this->build_labels) . "\">\r\n");
                       if (0 < $this->comp_order_col)
                       {
                       $nm_saida->saida("    <a href=\"javascript: changeSort('0', '0', true)\" class=\"scGridLabelLink \">\r\n");
                       }
                   $nm_saida->saida("   " . $apl_cab_resumo . "\r\n");
                       if (0 < $this->comp_order_col)
                       {
                           if (!$this->Ini->Export_html_zip) {
                           $nm_saida->saida("    <IMG style=\"vertical-align: middle\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_summary_sort_asc . "\" BORDER=\"0\"/>\r\n");
                       }
                       else {
                           $nm_saida->saida("    <IMG style=\"vertical-align: middle\" SRC=\"" . $this->Ini->Label_summary_sort_asc . "\" BORDER=\"0\"/>\r\n");
                       }
                       $nm_saida->saida("    </a>\r\n");
                       }
               $nm_saida->saida("  </td>\r\n");
               }
               $b_display = true;
           }
           foreach ($lines as $columns) {
               $tdStyleTags = array();
               $this->NM_graf_left = $this->Graf_left_dat;
               if (isset($columns['group']) && $columns['group'] == -1) {
                   $this->NM_graf_left = $this->Graf_left_tot;
               }
               if ('' == $columns['function'] && '' != $this->comp_align[ $columns['group'] ]) {
                   $tdStyleTags[] = 'text-align: ' . $this->comp_align[ $columns['group'] ];
               }
               $css       = ('' != $columns['css']) ? ' ' . $columns['css'] . '_label' : '';
               $colspan   = (isset($columns['colspan']) && 1 < $columns['colspan']) ? ' colspan="' . $columns['colspan'] . '"' : '';
               $rowspan   = (isset($columns['rowspan']) && 1 < $columns['rowspan']) ? ' rowspan="' . $columns['rowspan'] . '"' : '';
               $chart     = (($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida']) && isset($columns['chart']) && '' != $columns['chart'] && isset($this->comp_chart_data[ $columns['chart'] ]))
                          ? nmButtonOutput($this->arr_buttons, "bgraf", "nm_graf_submit_2('" . $columns['chart'] . "')", "nm_graf_submit_2('" . $columns['chart'] . "')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->comp_chart_data[ $columns['chart'] ]['label_x'] . " X " . $this->comp_chart_data[ $columns['chart'] ]['label_y'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "") : '';
               $col_label = $this->getColumnLabel($columns['label'], $columns['params'][0], $css, $chart, $tdStyleTags, $this->NM_graf_left);
               $tdStyle   = empty($tdStyleTags) ? '' : ' style="' . implode(';', $tdStyleTags) . '"';
                   $nm_saida->saida("  <td class=\"scGridSummaryLabel" . $css . "\"" . $colspan . "" . $rowspan . "><span class='scGridSummaryLabelContainerSpan' " . $tdStyle . ">" . $col_label . "</span></td>\r\n");
           }
           $nm_saida->saida(" </tr>\r\n");
       }
if($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf_vert']){ 
           $nm_saida->saida("   </thead>\r\n");
 }
   }

   function getColumnLabel($label, $col, $css, $chartValue, &$tdStyleTags, $chartLeft, $labelLeft = true)
   {
       $tdStyleTags[] = 'display: flex';
       $tdStyleTags[] = 'flex-direction: row';
       $tdStyleTags[] = 'align-items: center';
       if (0 != sizeof($this->comp_x_axys)) {
           $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
           return $chartLeft ? $chartValue . $label : $label . $chartValue;
       }

       if (1 == $col) {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf_vert']) {
               return nl2br($label);
           }
           $sortIconValue = $this->Ini->Label_summary_sort;
           $spanLabelAlign = '; justify-content: flex-end;';
           $sortOrder = 'a';
           if (isset($this->comp_order_col) && $this->comp_order_col == $col + 1) {
               if ($this->comp_order_sort == 'd') {
                   $sortIconValue = $this->Ini->Label_summary_sort_desc;
                   $sInitialOrderFA = 'desc';
                   $sortOrder = '';
               } else {
                   $sortIconValue = $this->Ini->Label_summary_sort_asc;
                   $sInitialOrderFA = 'asc';
                   $sortOrder = 'd';
               }
           }
           $linkIni = "<a href=\"javascript: changeSort(" . ($col + 1) . ", '" . $sortOrder . "', true)\" class=\"scGridLabelLink" . $css . "\">";
           $linkEnd = "</a>";
           $labelValue = nl2br($label);
           $labelLink = $linkIni . $labelValue . $linkEnd;
           $labelChart = $chartLeft ? $chartValue . $labelLink : $labelLink . $chartValue;
           $sortIconLink = $linkIni . $this->scGetFontawesomeOrderIcon($sInitialOrderFA, '__SC_METRIC_FIELD__') . $linkEnd;
           if (empty($this->Ini->Label_summary_sort_pos) || $this->Ini->Label_summary_sort_pos == "right") {
               $this->Ini->Label_summary_sort_pos = "right_field";
           }
           if (empty($sortIconValue)) {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return $labelChart;
           } elseif ($this->Ini->Label_summary_sort_pos == "right_field") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . $sortIconLink . '</span>';
           } elseif ($this->Ini->Label_summary_sort_pos == "left_field") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $sortIconLink . $labelChart . '</span>';
           } elseif ($this->Ini->Label_summary_sort_pos == "right_cell") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: space-between' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . '</span>' . $sortIconLink;
           } elseif ($this->Ini->Label_summary_sort_pos == "left_cell") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: space-between';
               return $sortIconLink . '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . '</span>';
           }
       }

       if (2 == $col) {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf_vert']) {
               return nl2br($label);
           }
           $sortIconValue = $this->Ini->Label_summary_sort;
           $spanLabelAlign = '; justify-content: flex-end;';
           $sortOrder = 'a';
           if (isset($this->comp_order_col) && $this->comp_order_col == $col + 1) {
               if ($this->comp_order_sort == 'd') {
                   $sortIconValue = $this->Ini->Label_summary_sort_desc;
                   $sInitialOrderFA = 'desc';
                   $sortOrder = '';
               } else {
                   $sortIconValue = $this->Ini->Label_summary_sort_asc;
                   $sInitialOrderFA = 'asc';
                   $sortOrder = 'd';
               }
           }
           $linkIni = "<a href=\"javascript: changeSort(" . ($col + 1) . ", '" . $sortOrder . "', true)\" class=\"scGridLabelLink" . $css . "\">";
           $linkEnd = "</a>";
           $labelValue = nl2br($label);
           $labelLink = $linkIni . $labelValue . $linkEnd;
           $labelChart = $chartLeft ? $chartValue . $labelLink : $labelLink . $chartValue;
           $sortIconLink = $linkIni . $this->scGetFontawesomeOrderIcon($sInitialOrderFA, '__SC_METRIC_FIELD__') . $linkEnd;
           if (empty($this->Ini->Label_summary_sort_pos) || $this->Ini->Label_summary_sort_pos == "right") {
               $this->Ini->Label_summary_sort_pos = "right_field";
           }
           if (empty($sortIconValue)) {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return $labelChart;
           } elseif ($this->Ini->Label_summary_sort_pos == "right_field") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . $sortIconLink . '</span>';
           } elseif ($this->Ini->Label_summary_sort_pos == "left_field") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $sortIconLink . $labelChart . '</span>';
           } elseif ($this->Ini->Label_summary_sort_pos == "right_cell") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: space-between' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . '</span>' . $sortIconLink;
           } elseif ($this->Ini->Label_summary_sort_pos == "left_cell") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: space-between';
               return $sortIconLink . '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . '</span>';
           }
       }

       $spanLabelAlign = $labelLeft ? 'justify-content: left' : 'justify-content: right';
       if (1 == $col) {
           $spanLabelAlign = 'justify-content: flex-end';
       }
       if (2 == $col) {
           $spanLabelAlign = 'justify-content: flex-end';
       }
       $tdStyleTags[] = $spanLabelAlign;
       return $chartLeft ? $chartValue . $label : $label . $chartValue;
   }

   public static function formatValue($total, $valor_campo)
   {
       $isNegative = 0 > $valor_campo;
       if ($total == 1)
       {
           nmgp_Form_Num_Val($valor_campo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']);
       }
       if ($total == 2)
       {
           nmgp_Form_Num_Val($valor_campo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']);
       }
       return $valor_campo;
   }

    function scGetFontawesomeOrderIcon($sortRule, $fieldName)
    {
        if ($this->scIsFieldNumeric($fieldName)) {
            $defaultOffIcon = 'asc' == $this->scGetDefaultFieldOrder($fieldName) ? "fas fa-sort-numeric-down" : "fas fa-sort-numeric-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down-alt sc-summary-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down sc-summary-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-summary-order-icon sc-summary-order-icon-unused\"></span>";
            }
        } else {
            $defaultOffIcon = 'asc' == $this->scGetDefaultFieldOrder($fieldName) ? "fas fa-sort-alpha-down" : "fas fa-sort-alpha-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down-alt sc-summary-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down sc-summary-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-summary-order-icon sc-summary-order-icon-unused\"></span>";
            }
        }
    }

    function scIsFieldNumeric($fieldName)
    {
        if (isset($this->comp_order_datatype[$fieldName])) {
            if (!in_array($this->comp_order_datatype[$fieldName], array('integer', 'numeric'))) {
                return false;
            }
        }
        return true;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        if (isset($this->comp_order_start[$fieldName])) {
            return false;
        }
        return 'asc';
    }
   //---- 
   function resumo_init()
   {
      $this->arr_buttons['group_group_1']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'type'             => "button",
          'display'          => "text_fontawesomeicon",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__export.png",
          'fontawesomeicon'  => "fas fa-download",
          'has_fa'           => true,
          'content_icons'    => false,
          'style'            => "default",
      );

      $this->arr_buttons['group_group_2']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt_email_title'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt_email'] . "",
          'type'             => "button",
          'display'          => "text_fontawesomeicon",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__envelope.png",
          'fontawesomeicon'  => "fas fa-envelope",
          'has_fa'           => true,
          'content_icons'    => false,
          'style'            => "default",
      );

      $this->arr_buttons['group_group_3']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'type'             => "button",
          'display'          => "text_fontawesomeicon",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__export.png",
          'fontawesomeicon'  => "fas fa-download",
          'has_fa'           => true,
          'content_icons'    => false,
          'style'            => "default",
      );

      $this->arr_buttons['group_group_4']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt_email_title'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt_email'] . "",
          'type'             => "button",
          'display'          => "text_fontawesomeicon",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__envelope.png",
          'fontawesomeicon'  => "fas fa-envelope",
          'has_fa'           => true,
          'content_icons'    => false,
          'style'            => "default",
      );

      if ($this->NM_export)
      {
          return;
      }
      if ("out" == $this->NM_tipo)
      {
         $this->monta_html_ini();
         $this->monta_cabecalho();
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
         {
             $this->monta_barra_top();
             $this->monta_embbed_placeholder_top();
         }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
         {
             $this->monta_barra_top();
             $this->monta_embbed_placeholder_mobile_top();
         }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida'])
         { 
            if ($this->Ini->grid_search_change_fil)
            { 
                $seq_search = 1;
                foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_pesq'] as $cmp => $def)
                {
                   $Seq_grid      = $seq_search;
                   $Cmp_grid      = $cmp;
                   $Def_grid      = array('descr' => $def['descr'], 'hint' => $def['hint']);
                   $Lin_grid_add  = $this->grid_search_tag_ini($Cmp_grid, $Def_grid, $Seq_grid);
                   $NM_func_grid_add = "grid_search_" . $Cmp_grid;
                   $Lin_grid_add .= $this->$NM_func_grid_add($Seq_grid, 'S', $def['opc'], $def['val'], $nmgp_tab_label[$Cmp_grid]);
                   $Lin_grid_add .= $this->grid_search_tag_end();
                   $this->Ini->Arr_result['grid_search_add'][] = array ('field' => $cmp, 'tag' => NM_charset_to_utf8($Lin_grid_add));
                   $seq_search++;
                } 
            } 
            else 
            { 
                $this->html_grid_search();
            } 
         } 
      }
      elseif ($this->Print_All)
      {
          $this->monta_cabecalho();
      }
   }

   function monta_css()
   {
      global $nm_saida, $nmgp_tipo_pdf, $nmgp_cor_print;
       $compl_css = "";
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida'])
       {
           include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida'])
       {
          if (($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] == "print" && strtoupper($nmgp_cor_print) == "PB") || $nmgp_tipo_pdf == "pb")
           { 
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['grid_agenda_cliente']))
               {
                   $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['grid_agenda_cliente']) . "_";
               } 
           } 
           else 
           { 
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['grid_agenda_cliente']))
               {
                   $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['grid_agenda_cliente']) . "_";
               } 
           }
       }
       $temp_css  = explode("/", $compl_css);
       if (isset($temp_css[1])) { $compl_css = $temp_css[1];}
       $this->css_scGridPage          = $compl_css . "scGridPage";
       $this->css_scGridToolbar       = $compl_css . "scGridToolbar";
       $this->css_scGridToolbarPadd   = $compl_css . "scGridToolbarPadding";
       $this->css_css_toolbar_obj     = $compl_css . "css_toolbar_obj";
       $this->css_scGridHeader        = $compl_css . "scGridHeader";
       $this->css_scGridHeaderFont    = $compl_css . "scGridHeaderFont";
       $this->css_scGridFooter        = $compl_css . "scGridFooter";
       $this->css_scGridFooterFont    = $compl_css . "scGridFooterFont";
       $this->css_scGridTotal         = $compl_css . "scGridTotal";
       $this->css_scGridTotalFont     = $compl_css . "scGridTotalFont";
       $this->css_scGridFieldEven     = $compl_css . "scGridFieldEven";
       $this->css_scGridFieldEvenFont = $compl_css . "scGridFieldEvenFont";
       $this->css_scGridFieldEvenVert = $compl_css . "scGridFieldEvenVert";
       $this->css_scGridFieldEvenLink = $compl_css . "scGridFieldEvenLink";
       $this->css_scGridFieldOdd      = $compl_css . "scGridFieldOdd";
       $this->css_scGridFieldOddFont  = $compl_css . "scGridFieldOddFont";
       $this->css_scGridFieldOddVert  = $compl_css . "scGridFieldOddVert";
       $this->css_scGridFieldOddLink  = $compl_css . "scGridFieldOddLink";
       $this->css_scGridLabel         = $compl_css . "scGridLabel";
       $this->css_scGridLabelFont     = $compl_css . "scGridLabelFont";
       $this->css_scGridLabelLink     = $compl_css . "scGridLabelLink";
       $this->css_scGridTabela        = $compl_css . "scGridTabela";
       $this->css_scGridTabelaTd      = $compl_css . "scGridTabelaTd";
       $this->css_scAppDivMoldura     = $compl_css . "scAppDivMoldura";
       $this->css_scAppDivHeader      = $compl_css . "scAppDivHeader";
       $this->css_scAppDivHeaderText  = $compl_css . "scAppDivHeaderText";
       $this->css_scAppDivContent     = $compl_css . "scAppDivContent";
       $this->css_scAppDivContentText = $compl_css . "scAppDivContentText";
       $this->css_scAppDivToolbar     = $compl_css . "scAppDivToolbar";
       $this->css_scAppDivToolbarInput= $compl_css . "scAppDivToolbarInput";
   }

   function resumo_sem_reg()
   {
      global $nm_saida;
      $res_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
      $nm_saida->saida("  <script>let scSummaryNoRecords = true;</script>\r\n");
      $nm_saida->saida("  <TR id=\"summary_body\">\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("   <TD class=\"scGridFieldOdd scGridFieldOddFont\" align=\"center\" style=\"vertical-align: top;font-size:12px;\">\r\n");
      $nm_saida->saida("     " . $res_sem_reg . "\r\n");
      $nm_saida->saida("     <script>\r\n");
      $nm_saida->saida("         scChartIsEmpty = true;\r\n");
      $nm_saida->saida("     </script>\r\n");
      $nm_saida->saida("   </TD>\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'summary_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("  </TR>\r\n");
   }

   function resumo_sem_reg_chart()
   {
      global $nm_saida;
      $res_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
      $displayMessage = $this->NM_res_sem_reg ? '' : ' style="display: none"';
      $nm_saida->saida("  <TR id=\"rec_not_found_chart\"" . $displayMessage . ">\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("   <TD class=\"scGridFieldOdd scGridFieldOddFont\" align=\"center\" style=\"vertical-align: top;font-size:12px;\">\r\n");
      $nm_saida->saida("     " . $res_sem_reg . "\r\n");
      $nm_saida->saida("   </TD>\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'])
      { 
         if ($this->NM_res_sem_reg)
         {
              $this->Ini->Arr_result['setDisplay'][] = array('field' => 'rec_not_found_chart', 'value' => '');
              $this->Ini->Arr_result['setVisibility'][] = array('field' => 'res_chart_table', 'value' => 'hidden');
         }
         else
         {
              $this->Ini->Arr_result['setDisplay'][] = array('field' => 'rec_not_found_chart', 'value' => 'none');
              $this->Ini->Arr_result['setDisplay'][] = array('field' => 'res_chart_table', 'value' => '');
              $this->Ini->Arr_result['setVisibility'][] = array('field' => 'res_chart_table', 'value' => 'visible');
         }
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("  </TR>\r\n");
   }

   //---- 
   function resumo_final()
   {
       global $nm_saida;
      if ($this->NM_export)
      {
          return;
      }
      if (!$_SESSION['scriptcase']['proc_mobile'])
      {
      if ("out" == $this->NM_tipo)
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "pdf")
          {
              $this->monta_embbed_placeholder_bot();
              $this->monta_barra_bot();
          }
      }
      }
      if ($_SESSION['scriptcase']['proc_mobile'])
      {
      if ("out" == $this->NM_tipo)
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "pdf")
          {
              $this->monta_embbed_placeholder_mobile_bot();
              $this->monta_barra_bot();
          }
      }
      }
      if ("out" == $this->NM_tipo)
      {
          $this->monta_html_fim();
      }
   }

   //---- 
   function inicializa_vars()
   {
      $this->Tot_ger = false;
      if ("out" == $this->NM_tipo)
      {
          require_once($this->Ini->path_aplicacao . "grid_agenda_cliente_total.class.php"); 
      }
      $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['print_all'];
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['doc_word'] || $this->Ini->sc_export_ajax_img)
      { 
          $this->NM_raiz_img = $this->Ini->root; 
      } 
      else 
      { 
          $this->NM_raiz_img = ""; 
      } 
      if ($this->Print_All)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] = "print";
          $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_res_prt; 
      }
      else
      {
          $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_res; 
      }
      $this->Total   = new grid_agenda_cliente_total($this->Ini->sc_page);
      $this->prep_modulos("Total");
      if ($this->NM_export)
      {
          return;
      }
      $this->monta_css();
      $this->que_linha = "impar";
      $this->css_line_back = $this->css_scGridFieldOdd;
      $this->css_line_fonf = $this->css_scGridFieldOddFont;
      $this->Ini->cor_link_dados = $this->css_scGridFieldOddLink;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['LigR_Md5'] = array();
   }

   //---- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   //---- 
   function totaliza()
   {
      $this->Tem_Res_Compara = false;
      $save_where_pesq = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq'];
      $where_compara   = "";
      $this->Total->Calc_resumo_ag_estado("res", $this->NM_export, 1);
      if ((isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_compara'])    && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_compara'])) 
       || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_dyn_compara'])     && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_dyn_compara'])) )
       {
          $tmp_cmd = "";
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_orig'])) {
              $tmp_cmd = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_orig']; 
          }
          if  (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_compara']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_compara'])) {
              if (!empty($tmp_cmd)) {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_compara'] . ")"; 
              }
              else {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_compara'] . ")"; 
              }
          }
          elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_filtro'])) {
              if (!empty($tmp_cmd)) {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_filtro'] . ")"; 
              }
              else {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_filtro'] . ")"; 
              }
          }
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_fast'])) {
              if (!empty($tmp_cmd)) {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_fast'] . ")";
              }
              else {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_fast'] . ")";
              }
          }
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_interativ'])) {
              if (!empty($tmp_cmd)) {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_interativ'] . ")";
              }
              else {
                  $tmp_cmd = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_interativ'];
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_dyn_compara']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_dyn_compara'])) {
              if (!empty($tmp_cmd)) {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_dyn_compara'] . ")";
              }
              else {
                  $tmp_cmd = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_dyn_compara'];
              }
          }
          elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_dyn']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_dyn'])) {
              if (!empty($tmp_cmd)) {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_dyn'] . ")";
              }
              else {
                  $tmp_cmd = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_dyn'];
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_resumo_search_2']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_resumo_search_2'])) {
              if (!empty($tmp_cmd)) {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_resumo_search_2'] . ")"; 
              }
              else {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_resumo_search_2'] . ")"; 
               }
          }
          elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_resumo_search']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_resumo_search'])) {
              if (!empty($tmp_cmd)) {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_resumo_search'] . ")"; 
              }
              else {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_resumo_search'] . ")"; 
               }
          }
          $where_compara = $tmp_cmd;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq'] = $tmp_cmd;
          $this->Total->Calc_resumo_ag_estado("res", $this->NM_export, 2);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq'] = $save_where_pesq;
          $this->Tem_Res_Compara = true;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['res_compara'] = $this->Tem_Res_Compara;
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['arr_total'] as $cmp_gb => $resto)
      {
          $Arr_tot_name = "array_total_" . $cmp_gb;
          $this->$Arr_tot_name = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['arr_total'][$cmp_gb];
      }
      if (is_array($this->array_total_fecha_inicial)) {
          ksort($this->array_total_fecha_inicial);
      }
      if (is_array($this->array_total_fecha_inicial_scgb_41)) {
          ksort($this->array_total_fecha_inicial_scgb_41);
      }
      $this->NM_res_sem_reg = true;
      $Sv_tot_ger  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['tot_geral'];
      $Sv_flag_tot = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['contr_total_geral'];
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['contr_total_geral'] = "N";
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['SC_Ind_Groupby'];
      $tp_tot = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['Res_search_metric_use']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['Res_search_metric_use'])) ? true : false;
      $this->Total->$Gb_geral($tp_tot, $this->NM_export);
      $this->array_total_geral = array();
      $this->array_total_geral[1][0] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['tot_geral'][2];
      $this->array_total_geral[1][1] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['tot_geral'][3];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['tot_geral'][1]) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['tot_geral'][1] > 0) {
          $this->NM_res_sem_reg = false;
      }
      if ($this->Tem_Res_Compara) {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq'] = $where_compara;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['contr_total_geral'] = "N";
          $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['SC_Ind_Groupby'];
          $tp_tot = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['Res_search_metric_use']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['Res_search_metric_use'])) ? true : false;
          $this->Total->$Gb_geral($tp_tot, $this->NM_export);
          $this->array_total_geral[2][0] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['tot_geral'][2];
          $this->array_total_geral[2][1] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['tot_geral'][3];
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['tot_geral'][1]) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['tot_geral'][1] > 0) {
              $this->NM_res_sem_reg = false;
          }
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['tot_geral_res']     = $this->array_total_geral;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['tot_geral']         = $Sv_tot_ger;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['contr_total_geral'] = $Sv_flag_tot;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['res_sem_reg']       = $this->NM_res_sem_reg;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq']        = $save_where_pesq;
      if ("out" == $this->NM_tipo)
      {
          $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['SC_Ind_Groupby'];
          $this->Total->$Gb_geral(false, $this->NM_export);
      }
   }

   //----- 
   function monta_html_ini($first_table = true)
   {
      global $nm_saida, $nmgp_tipo_pdf, $nmgp_cor_print;

      if ($first_table)
      {

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida'])
      { 
          $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px; width: 100%;\">\r\n");
          return;
      } 
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['doc_word'])
{
       $nm_saida->saida("<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:word\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
}
if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['responsive_chart']['active']) {
$nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
$nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
}
$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['dashboard_refresh_after_chart'] = 'resumo';
      $nm_saida->saida("<HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
      $nm_saida->saida("<HEAD>\r\n");
      $nm_saida->saida(" <TITLE>" . $this->Ini->Nm_lang['lang_othr_smry_title'] . " " . $this->Ini->Nm_lang['lang_tbl_agenda'] . "</TITLE>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['doc_word'])
{
      $nm_saida->saida(" <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Last-Modified\" content=\"" . gmdate('D, d M Y H:i:s') . " GMT\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
}
      $nm_saida->saida(" <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n");
       $css_body = "";
      $nm_saida->saida(" <style type=\"text/css\">\r\n");
      $nm_saida->saida("  BODY { " . $css_body . " }\r\n");
      $nm_saida->saida(" </style>\r\n");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['doc_word'])
      { 
           $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form.css\" /> \r\n");
           $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var applicationKeys = '';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+q';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'ctrl+s';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'ctrl+f';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+p';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+w';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+x';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+m';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+c';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+r';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'ctrl+p';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+shift+p';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+shift+w';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+shift+x';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+shift+m';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+shift+c';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+shift+r';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+enter';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'f1';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'ctrl+g';\r\n");
           $nm_saida->saida("     var hotkeyList = '';\r\n");
           $nm_saida->saida("     function execHotKey(e, h) {\r\n");
           $nm_saida->saida("         var hotkey_fired = false\r\n");
           $nm_saida->saida("         switch (true) {\r\n");
           $nm_saida->saida("             case (['alt+q'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_sai');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['ctrl+s'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_savegrid');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['ctrl+f'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_fil');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+p'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_pdf');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+w'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_word');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+x'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_xls');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+m'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_xml');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+c'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_csv');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+r'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_rtf');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['ctrl+p'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_imp');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+shift+p'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_email_pdf');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+shift+w'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_email_word');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+shift+x'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_email_xls');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+shift+m'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_email_xml');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+shift+c'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_email_csv');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+shift+r'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_email_rtf');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+enter'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_cons');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['f1'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_webh');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['ctrl+g'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_gbrl');\r\n");
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
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery-ui.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/scInput.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput2.js\"></script>\r\n");
           $nm_saida->saida(" <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery/css/smoothness/jquery-ui.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida(" <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/font-awesome/6/css/all.min.css\" type=\"text/css\" media=\"screen,print\" />\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/malsup-blockui/jquery.blockUI.js\"></script>\r\n");
           $nm_saida->saida(" <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/select2/css/select2.min.css\" type=\"text/css\" />\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/select2/js/select2.full.min.js\"></script>\r\n");
           if ($_SESSION['scriptcase']['proc_mobile'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav']) {  
               $forced_mobile = (isset($_SESSION['scriptcase']['force_mobile']) && $_SESSION['scriptcase']['force_mobile']) ? 'true' : 'false';
               $sc_app_data   = json_encode([ 
                   'forceMobile' => $forced_mobile, 
                   'appType' => 'summary', 
                   'improvements' => true, 
                   'displayOptionsButton' => false, 
                   'displayScrollUp' => true, 
                   'bottomToolbarFixed' => true, 
                   'mobileSimpleToolbar' => false, 
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
                    </script>           <?php }
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"grid_agenda_cliente_ajax.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("   var sc_ajaxBg = '" . $this->Ini->Color_bg_ajax . "';\r\n");
           $nm_saida->saida("   var sc_ajaxBordC = '" . $this->Ini->Border_c_ajax . "';\r\n");
           $nm_saida->saida("   var sc_ajaxBordS = '" . $this->Ini->Border_s_ajax . "';\r\n");
           $nm_saida->saida("   var sc_ajaxBordW = '" . $this->Ini->Border_w_ajax . "';\r\n");
           $nm_saida->saida(" </script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"grid_agenda_cliente_jquery_7555.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"grid_agenda_cliente_message.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/scInput.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput2.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/bluebird.min.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/nm_position.js\"></script>\r\n");
           $nm_saida->saida("        <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("          var sc_pathToTB = '" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/';\r\n");
           $nm_saida->saida("          var sc_tbLangClose = \"" . html_entity_decode($this->Ini->Nm_lang['lang_tb_close'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\";\r\n");
           $nm_saida->saida("          var sc_tbLangEsc = \"" . html_entity_decode($this->Ini->Nm_lang['lang_tb_esc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\";\r\n");
           $nm_saida->saida("        </script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/nm_position.js\"></script>\r\n");
           $summaryOrderUnusedVisivility = $_SESSION['scriptcase']['proc_mobile'] ? 'visible' : 'hidden';
           $summaryOrderUnusedOpacity = $_SESSION['scriptcase']['proc_mobile'] ? '0.5' : '1';
$nm_saida->saida("    <style>\r\n");
$nm_saida->saida("        .sc-summary-order-icon-unused {\r\n");
$nm_saida->saida("            visibility: " . $summaryOrderUnusedVisivility . ";\r\n");
$nm_saida->saida("            opacity: 0.5;\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        .scGridSummaryLabel:hover .sc-summary-order-icon-unused {\r\n");
$nm_saida->saida("            visibility: visible;\r\n");
$nm_saida->saida("            opacity: " . $summaryOrderUnusedOpacity . ";\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("    </style>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid.css\"  type=\"text/css\"/> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\"  type=\"text/css\"/> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_filter.css\" /> \r\n");
           if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
           { 
               $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->str_google_fonts . "\"  type=\"text/css\"/> \r\n");
           } 
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['num_css']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['num_css'] = rand(0, 1000);
      }
      $NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_grid_agenda_cliente_sum_' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['num_css'] . '.css', 'w');
      if (($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] == "print" && strtoupper($nmgp_cor_print) == "PB") || $nmgp_tipo_pdf == "pb")
      {
          $NM_css_file = $this->Ini->str_schema_all . "_grid_bw.css";
          $NM_css_dir  = $this->Ini->str_schema_all . "_grid_bw" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      }
      else
      {
          $NM_css_file = $this->Ini->str_schema_all . "_grid.css";
          $NM_css_dir  = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      }
      if (is_file($this->Ini->path_css . $NM_css_file))
      {
          $NM_css_attr = file($this->Ini->path_css . $NM_css_file);
          foreach ($NM_css_attr as $NM_line_css)
          {
              $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
              @fwrite($NM_css, "    " .  $NM_line_css . "\r\n");
          }
      }
      if (is_file($this->Ini->path_css . $NM_css_dir))
      {
          $NM_css_attr = file($this->Ini->path_css . $NM_css_dir);
          foreach ($NM_css_attr as $NM_line_css)
          {
              $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
              @fwrite($NM_css, "    " .  $NM_line_css . "\r\n");
          }
      }
      @fclose($NM_css);
     $this->Ini->summary_css = $this->Ini->path_imag_temp . '/sc_css_grid_agenda_cliente_sum_' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['num_css'] . '.css';
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] == "print")
     {
         $nm_saida->saida("  <style type=\"text/css\">\r\n");
         $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_grid_agenda_cliente_sum_' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['num_css'] . '.css');
         foreach ($NM_css as $cada_css)
         {
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
         }
         $nm_saida->saida("  </style>\r\n");
     }
     else
     {
         $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->summary_css . "\" type=\"text/css\" media=\"screen\" />\r\n");
     }
     $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_res_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
     $nm_saida->saida(" <style type=\"text/css\">\r\n");
     if (!$this->Ini->Export_html_zip)     {
           $nm_saida->saida(" .scGridSummaryLabel a img[src\$='" . $this->Ini->Label_sort_desc . "'], \r\n");
           $nm_saida->saida(" .scGridSummaryLabel a img[src\$='" . $this->Ini->Label_sort_asc . "'], \r\n");
           $nm_saida->saida(" .scGridSummaryLabel a img[src\$='" . $this->arr_buttons['bgraf']['image'] . "']{opacity:1!important;} \r\n");
           $nm_saida->saida(" .scGridSummaryLabel a img{opacity:0;transition:all .2s;} \r\n");
           $nm_saida->saida(" .scGridSummaryLabel:HOVER a img{opacity:1;transition:all .2s;} \r\n");
           $nm_saida->saida(" .scGridSummaryLabel span > img[src\$='" . $this->Ini->Label_sort_desc . "'], \r\n");
           $nm_saida->saida(" .scGridSummaryLabel span > img[src\$='" . $this->Ini->Label_sort_asc . "']{opacity:1!important;} \r\n");
           $nm_saida->saida(" .scGridSummaryLabel span > img{opacity:0;transition:all .2s;} \r\n");
           $nm_saida->saida(" .scGridSummaryLabel:HOVER span > img{opacity:1;transition:all .2s;} \r\n");
     }
      $nm_saida->saida(" .scGridTabela TD { white-space: nowrap }\r\n");
      $nm_saida->saida(" </style>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\"> \r\n");
           $nm_saida->saida("   var scBtnGrpStatus = {};\r\n");
           $nm_saida->saida("   \$(function(){ \r\n");
           $nm_saida->saida("     $(\".scBtnGrpText\").mouseover(function() { $(this).addClass(\"scBtnGrpTextOver\"); }).mouseout(function() { $(this).removeClass(\"scBtnGrpTextOver\"); });\r\n");
           $nm_saida->saida("     $(\".scBtnGrpClick\").mouseup(function(event){\r\n");
           $nm_saida->saida("          event.preventDefault();\r\n");
           $nm_saida->saida("          if(event.target !== event.currentTarget) return;\r\n");
           $nm_saida->saida("          if($(this).find(\"a\").prop('href') != '')\r\n");
           $nm_saida->saida("          {\r\n");
           $nm_saida->saida("              $(this).find(\"a\").click();\r\n");
           $nm_saida->saida("          }\r\n");
           $nm_saida->saida("          else\r\n");
           $nm_saida->saida("          {\r\n");
           $nm_saida->saida("              eval($(this).find(\"a\").prop('onclick'));\r\n");
           $nm_saida->saida("          }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }); \r\n");
           $nm_saida->saida("   function scBtnGrpShow(sGroup) {\r\n");
           $nm_saida->saida("     if (typeof(scBtnGrpShowMobile) === typeof(function(){})) { return scBtnGrpShowMobile(sGroup); };\r\n");
           $nm_saida->saida("     $('#sc_btgp_btn_' + sGroup).addClass('selected');\r\n");
           $nm_saida->saida("     var btnPos = $('#sc_btgp_btn_' + sGroup).offset();\r\n");
           $nm_saida->saida("     scBtnGrpStatus[sGroup] = 'open';\r\n");
           $nm_saida->saida("     $('#sc_btgp_btn_' + sGroup).mouseout(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = '';\r\n");
           $nm_saida->saida("       setTimeout(function() {\r\n");
           $nm_saida->saida("         scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("       }, 1000);\r\n");
           $nm_saida->saida("     }).mouseover(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'over';\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#sc_btgp_div_' + sGroup + ' span a').click(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'out';\r\n");
           $nm_saida->saida("       scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#sc_btgp_div_' + sGroup).css({\r\n");
           $nm_saida->saida("       'left': btnPos.left\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .mouseover(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'over';\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .mouseleave(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'out';\r\n");
           $nm_saida->saida("       setTimeout(function() {\r\n");
           $nm_saida->saida("         scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("       }, 1000);\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .show('fast');\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGrpHide(sGroup, bForce) {\r\n");
           $nm_saida->saida("     if (bForce || 'over' != scBtnGrpStatus[sGroup]) {\r\n");
           $nm_saida->saida("       $('#sc_btgp_div_' + sGroup).hide('fast');\r\n");
           $nm_saida->saida("       $('#sc_btgp_btn_' + sGroup).removeClass('selected');\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   </script> \r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     function scBtnGroupByShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("       $.ajax({\r\n");
           $nm_saida->saida("         type: \"GET\",\r\n");
           $nm_saida->saida("         dataType: \"html\",\r\n");
           $nm_saida->saida("         url: sUrl\r\n");
           $nm_saida->saida("       }).done(function(data) {\r\n");
           $nm_saida->saida("         $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("         $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("         $(\"#sc_id_groupby_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("       });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnGroupByHide(sPos) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnSelCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("       $.ajax({\r\n");
           $nm_saida->saida("         type: \"GET\",\r\n");
           $nm_saida->saida("         dataType: \"html\",\r\n");
           $nm_saida->saida("         url: sUrl\r\n");
           $nm_saida->saida("       }).done(function(data) {\r\n");
           $nm_saida->saida("         $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("         $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("         $(\"#sc_id_sel_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("       });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnSelCamposHide(sPos) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnOrderCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("       $.ajax({\r\n");
           $nm_saida->saida("         type: \"GET\",\r\n");
           $nm_saida->saida("         dataType: \"html\",\r\n");
           $nm_saida->saida("         url: sUrl\r\n");
           $nm_saida->saida("       }).done(function(data) {\r\n");
           $nm_saida->saida("         $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("         $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("         $(\"#sc_id_order_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("       });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnOrderCamposHide(sPos) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   </script>\r\n");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'] && !$this->Ini->sc_export_ajax && !$this->Ini->Export_html_zip && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['doc_word'])
      {
           $nm_saida->saida("   <script type=\"text/javascript\"> \r\n");
           $nm_saida->saida("   var Dyn_Ini   = true;\r\n");
           $nm_saida->saida("   var nmdg_Form = \"Fdyn_search\";\r\n");
           if (is_file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js"))
           {
               $Tb_err_js = file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js");
               foreach ($Tb_err_js as $Lines)
               {
                   if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
                   {
                       $Lines = sc_convert_encoding($Lines, $_SESSION['scriptcase']['charset'], "UTF-8");
                   }
                   echo $Lines;
               }
           }
           $Msg_Inval = "Invalido";
           if ($_SESSION['scriptcase']['charset'] != "UTF-8")
           {
               $Msg_Inval = sc_convert_encoding($Msg_Inval, $_SESSION['scriptcase']['charset'], "UTF-8");
           }
           $nm_saida->saida("  var SC_crit_inv = \"" . $Msg_Inval . "\";\r\n");
           $nm_saida->saida("  function SC_init_jquery(){ \r\n");
           $nm_saida->saida("     $(function(){ \r\n");
           $nm_saida->saida("     if (Dyn_Ini)\r\n");
           $nm_saida->saida("     {\r\n");
           $nm_saida->saida("         Dyn_Ini = false;\r\n");
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_pesq']))
          { 
           $nm_saida->saida("         SC_carga_evt_jquery_grid('all');\r\n");
          } 
           $nm_saida->saida("         scLoadScInput('input:text.sc-js-input');\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   }); \r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  SC_init_jquery();\r\n");
           $nm_saida->saida("   </script>\r\n");
      }
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/light.css\"></script>\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/light-border.css\"></script>\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/material.css\"></script>\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/translucent.css\"></script>\r\n");
           $nm_saida->saida("<script src=\"" . $this->Ini->path_prod . "/third/tippyjs/popper.min.js\"></script>\r\n");
           $nm_saida->saida("<script src=\"" . $this->Ini->path_prod . "/third/tippyjs/tippy-bundle.umd.min.js\"></script>\r\n");
           $cssJsContent = $this->generateRatingSummarizationJsCss();
           $nm_saida->saida("$cssJsContent\r\n");
           $nm_saida->saida("<style type=\"text/css\">\r\n");
           $nm_saida->saida("</style>\r\n");
           $nm_saida->saida("<script>\r\n");
           $nm_saida->saida("</script>\r\n");

if ($_SESSION['scriptcase']['proc_mobile'])
{
       $nm_saida->saida("   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\" />\r\n");
}

      $nm_saida->saida("</HEAD>\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['responsive_chart']['active']) {
          $summary_width = "width=\"100%\"";
          $chart_height = " style=\"height: 100%\"";
          $border_height = "height: 100%;";
      }
      else {
          $chart_height = '';
          $border_height = '';
          if ($_SESSION['scriptcase']['proc_mobile'])
          {
              $summary_width = "width=\"100%\"";
          }
          else
          {
              $summary_width = "width=\"\"";
          }
      }
      if (!$this->Ini->Export_html_zip && $this->Print_All && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['doc_word']) 
      {
          $nm_saida->saida(" <BODY id=\"grid_summary\" class=\"" . $this->css_scGridPage . " sc-app-grid\" style=\"-webkit-print-color-adjust: exact;\">\r\n");
          $nm_saida->saida("   <TABLE id=\"sc_table_print\" cellspacing=0 cellpadding=0 align=\"center\" valign=\"top\" " . $summary_width . ">\r\n");
          $nm_saida->saida("     <TR>\r\n");
          $nm_saida->saida("       <TD align=\"center\">\r\n");
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
          $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['dashboard_info']['remove_margin'] ? 'margin: 0;' : '';
          $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['dashboard_info']['remove_border'] ? 'border-width: 0;' : '';
          $vertical_center = '';
          $nm_saida->saida(" <BODY id=\"grid_summary\" class=\"" . $this->css_scGridPage . " sc-app-grid\" style=\"" . $remove_margin . $vertical_center . "\">\r\n");
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida'])
      {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("<div id=\"id_debug_window\" style=\"display: none;\" class='scDebugWindow'><table class=\"scFormMessageTable\">\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageTitle\">" . $Cod_Btn . "&nbsp;&nbsp;Output</td></tr>\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageMessage\" style=\"padding: 0px; vertical-align: top\"><div style=\"padding: 2px; height: 200px; width: 350px; overflow: auto\" id=\"id_debug_text\"></div></td></tr>\r\n");
           $nm_saida->saida("</table></div>\r\n");
      }
      $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] == "pdf")
      { 
              $nm_saida->saida("  <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . $this->Ini->Nm_lang['lang_othr_smry_msge'] . "</H1></div>\r\n");
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['doc_word'])
      { 
          $nm_saida->saida("      <STYLE>\r\n");
          $nm_saida->saida("       .ttip {border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;color:black;}\r\n");
          $nm_saida->saida("      </STYLE>\r\n");
          $nm_saida->saida("      <div id=\"tooltip\" style=\"position:absolute;visibility:hidden;border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;padding:1px;color:black;\"></div>\r\n");
      } 

      }

      $nm_saida->saida("<TABLE id=\"main_table_res\" cellspacing=0 cellpadding=0 align=\"center\" valign=\"top\" " . $summary_width . $chart_height . ">\r\n");
      $nm_saida->saida(" <TR class='sc-mobile-inner-control'>\r\n");
      $nm_saida->saida("  <TD class='sc-mobile-inner-control' " . $chart_height . ">\r\n");
      $nm_saida->saida("  <div class=\"scGridBorder\" style=\"" . $border_height . (isset($remove_border) ? $remove_border : '') . "\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['doc_word'])
       { 
           $nm_saida->saida("  <div id=\"id_div_process\" style=\"display: none; margin: 10px; whitespace: nowrap\" class=\"scFormProcessFixed\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_div_process_block\" style=\"display: none; margin: 10px; whitespace: nowrap\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_fatal_error\" class=\"scGridLabel\" style=\"display: none; position: absolute\"></div>\r\n");
       } 
      $nm_saida->saida("  <table width='100%' cellspacing=0 cellpadding=0" . $chart_height . " class='sc-mobile-inner-control'>\r\n");
      $nm_saida->saida("<TR class='sc-mobile-inner-control'>\r\n");
      $nm_saida->saida("<TD style=\"padding: 0px; vertical-align: initial\" class='sc-mobile-inner-control'>\r\n");
      $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px; border-collapse: collapse;  vertical-align: top; width: 100%;\" class='sc-mobile-inner-control'>\r\n");
   }

   //-----  top
   function monta_barra_top_normal()
   {
      global $nm_url_saida, $nm_apl_dependente, $nm_saida;
      $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida'])
      {
         $nm_saida->saida(" <TR align=\"center\" id=\"obj_barra_top\">\r\n");
         $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\">\r\n");
         $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%;\">\r\n");
         $nm_saida->saida("    <TR class=\"" . $this->css_scGridToolbarPadd . "_tr\">\r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\">\r\n");
         $NM_btn  = false;
         $NM_Gbtn = false;
      if (!$this->grid_emb_form && $this->nmgp_botoes['group_1'] == "on")
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_fontawesomeicon", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'list', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
      if (!$this->grid_emb_form && $this->nmgp_botoes['pdf'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rpdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['pdf'][] = "Rpdf_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "Rpdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + P)", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_pdf.php?nm_opc=pdf_res&nm_target=0&nm_cor=cor&papel=1&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=S&sc_ver_93=s&nm_tem_gb=s&nm_res_cons=s&nm_ini_pdf_res=grid,resume,chart&nm_all_modules=grid,resume,chart&password=n&summary_export_columns=S&nm_label_group=N&nm_all_cab=S&nm_all_label=S&pdf_zip=N&nm_orient_grid=2&origem=res&language=es&conf_socor=N&script_case_init=" . $this->Ini->sc_page . "&app_name=grid_agenda_cliente&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
         if ($NM_Gbtn)
         {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
            $NM_Gbtn = false;
         }
      if (!$this->grid_emb_form && $this->nmgp_botoes['word'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rword_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['word'][] = "Rword_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "Rword_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + W)", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_word.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&nm_cor=CO&nm_res_cons=s&nm_ini_word_res=grid,resume,chart&nm_all_modules=grid,resume,chart&password=n&origem=res&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if (!$this->grid_emb_form && $this->nmgp_botoes['xls'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rxls_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['xls'][] = "Rxls_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "", "", "Rxls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + X)", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_xls.php?script_case_init=" . $this->Ini->sc_page . "&app_name=grid_agenda_cliente&nm_tp_xls=xlsx&nm_tot_xls=S&nm_tot_xls=S&nm_res_cons=s&nm_ini_xls_res=grid,resume,chart&nm_all_modules=grid,resume,chart&password=n&summary_export_columns=S&origem=res&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
         if ($NM_Gbtn)
         {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
            $NM_Gbtn = false;
         }
      if (!$this->grid_emb_form && $this->nmgp_botoes['xml'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rxml_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['xml'][] = "Rxml_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "", "", "Rxml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + M)", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_xml.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&password=n&nm_res_cons=s&nm_ini_xml_res=grid,resume,chart&nm_all_modules=grid,resume,chart&nm_xml_tag=tag&nm_xml_label=S&language=es&origem=res&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if (!$this->grid_emb_form && $this->nmgp_botoes['json'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rjson_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['json'][] = "Rjson_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bjson", "", "", "Rjson_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_json.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&password=n&nm_res_cons=s&nm_ini_json_res=grid,resume,chart&nm_all_modules=grid,resume,chart&nm_json_format=N&nm_json_label=S&language=es&origem=res&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if (!$this->grid_emb_form && $this->nmgp_botoes['csv'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rcsv_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['csv'][] = "Rcsv_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "", "", "Rcsv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + C)", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_csv.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&nm_res_cons=s&nm_ini_csv_res=grid,resume,chart&nm_all_modules=grid,resume,chart&password=n&nm_delim_line=1&nm_delim_col=1&nm_delim_dados=1&nm_label_csv=N&language=es&origem=res&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if (!$this->grid_emb_form && $this->nmgp_botoes['rtf'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rrtf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['rtf'][] = "Rrtf_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_rtf_conf();", "nm_gp_rtf_conf();", "Rrtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + R)", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
         if ($NM_Gbtn)
         {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
            $NM_Gbtn = false;
         }
      if (!$this->grid_emb_form && $this->nmgp_botoes['print'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rprinttop\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['print'][] = "Rprint_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "Rprint_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + P)", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&nm_opc=resumo&nm_cor=CO&nm_res_cons=s&nm_ini_prt_res=grid,resume,chart&nm_all_modules=grid,resume,chart&password=n&origem=res&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'list', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_1_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_1_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
      if (!$this->grid_emb_form && $this->nmgp_botoes['group_2'] == "on")
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_2_top = false;</script>\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_2", "scBtnGrpShow('group_2_top')", "scBtnGrpShow('group_2_top')", "sc_btgp_btn_group_2_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt_email_title'] . "", "", "absmiddle", "", "", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt_email'] . "", "", "", "__sc_grp__", "text_fontawesomeicon", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_2", 'group_2', 'top', 'list', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_2", 'group_2', 'top', 'list', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_2_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_2_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
      if ($this->nmgp_botoes['chart_conf'] == 'on' && !$this->grid_emb_form && !$this->NM_res_sem_reg)
      {
         $this->nm_btn_exist['chart_conf'][] = "Rgraf_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bconf_graf", "", "", "Rgraf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_graf_flash.php?nome_apl=grid_agenda_cliente&campo_apl=nm_resumo_graf&sc_page=" . NM_encode_input($this->Ini->sc_page) . "&language=es&tp_apl=cns_htm&KeepThis=true&TB_iframe=true&height=450&width=400&modal=true", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
      }
      if ($this->nmgp_botoes['chart_settings'] == 'on' && !$this->grid_emb_form && !$this->NM_res_sem_reg)
      {
         $this->nm_btn_exist['chart_settings'][] = "Rconfig_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "smry_conf", "summaryConfig();", "summaryConfig();", "Rconfig_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
      }
      if ($this->nmgp_botoes['groupby'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opc_psq'] && !$this->grid_emb_form && !$this->NM_res_sem_reg)
      {
          $Q_free  = false;
          $Q_count = 0;
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['SC_All_Groupby'] as $QB => $Tp)
          {
              if (!in_array($QB, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['SC_Groupby_hide']) && $Tp == "all")
              {
                  $Q_count++;
                  if ($QB == "sc_free_group_by")
                  {
                      $Q_free = true;
                  }
              }
          }
          if ($Q_count > 1 || $Q_free)
          {
             $this->nm_btn_exist['groupby'][] = "sel_groupby_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bgroupby", "scBtnGroupByShow('" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_sel_groupby.php?opc_ret=resumo&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnGroupByShow('" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_sel_groupby.php?opc_ret=resumo&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "sel_groupby_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + G)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          }
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['chart_detail'] == 'on' && !$this->grid_emb_form && !$this->NM_res_sem_reg)
      {
         $this->nm_btn_exist['chart_detail'][] = "Rrotac_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "blink_resumogrid", "nm_gp_move('inicio', '0');", "nm_gp_move('inicio', '0');", "Rrotac_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Enter)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
      }
      if ($this->nmgp_botoes['reload'] == 'on' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opc_psq'] && !$this->grid_emb_form)
      {
              $this->nm_btn_exist['reload'][] = "reload_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "breload", "ajax_navigate_res ('resumo', 'breload');", "ajax_navigate_res ('resumo', 'breload');", "reload_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
         if (is_file("grid_agenda_cliente_help.txt") && !$this->grid_emb_form && !$this->NM_res_sem_reg)
         {
            $Arq_WebHelp = file("grid_agenda_cliente_help.txt"); 
            if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
            {
                $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                $Tmp = explode(";", $Arq_WebHelp[0]); 
                foreach ($Tmp as $Cada_help)
                {
                    $Tmp1 = explode(":", $Cada_help); 
                    if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "res" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                    {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "Rhelp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (F1)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                    }
                }
            }
         }
      if ($this->nmgp_botoes['chart_exit'] == 'on' && !$this->grid_emb_form)
      {
          $this->nm_btn_exist['exit'][] = "Rsai_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('igual', '0');", "nm_gp_move('igual', '0');", "Rsai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
      }
         $nm_saida->saida("     </TD> \r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\">\r\n");
         $NM_btn = false;
         $NM_Gbtn = false;
         $nm_saida->saida("     </TD> \r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\">\r\n");
         $NM_btn = false;
         $NM_Gbtn = false;
         $nm_saida->saida("     </TD>\r\n");
         $nm_saida->saida("    </TR>\r\n");
         $nm_saida->saida("   </TABLE>\r\n");
         $nm_saida->saida("  </TD>\r\n");
         $nm_saida->saida(" </TR>\r\n");
      }
   }

   //-----  top
   function monta_barra_top_mobile()
   {
      global $nm_url_saida, $nm_apl_dependente, $nm_saida;
      $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida'])
      {
         $nm_saida->saida(" <TR align=\"center\" id=\"obj_barra_top\">\r\n");
         $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\">\r\n");
         $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%;\">\r\n");
         $nm_saida->saida("    <TR class=\"" . $this->css_scGridToolbarPadd . "_tr\">\r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\">\r\n");
         $NM_btn  = false;
         $NM_Gbtn = false;
      if (!$this->grid_emb_form && $this->nmgp_botoes['group_3'] == "on")
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_3_top = false;</script>\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_3", "scBtnGrpShow('group_3_top')", "scBtnGrpShow('group_3_top')", "sc_btgp_btn_group_3_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_fontawesomeicon", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_3", 'group_3', 'top', 'list', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
      if (!$this->grid_emb_form && $this->nmgp_botoes['pdf'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rpdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['pdf'][] = "Rpdf_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "Rpdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + P)", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_pdf.php?nm_opc=pdf_res&nm_target=0&nm_cor=cor&papel=1&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=S&sc_ver_93=s&nm_tem_gb=s&nm_res_cons=s&nm_ini_pdf_res=grid,resume,chart&nm_all_modules=grid,resume,chart&password=n&summary_export_columns=S&nm_label_group=N&nm_all_cab=S&nm_all_label=S&pdf_zip=N&nm_orient_grid=2&origem=res&language=es&conf_socor=N&script_case_init=" . $this->Ini->sc_page . "&app_name=grid_agenda_cliente&KeepThis=true&TB_iframe=true&modal=true", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
         if ($NM_Gbtn)
         {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
            $NM_Gbtn = false;
         }
      if (!$this->grid_emb_form && $this->nmgp_botoes['word'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rword_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['word'][] = "Rword_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "Rword_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + W)", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_word.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&nm_cor=CO&nm_res_cons=s&nm_ini_word_res=grid,resume,chart&nm_all_modules=grid,resume,chart&password=n&origem=res&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if (!$this->grid_emb_form && $this->nmgp_botoes['xls'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rxls_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['xls'][] = "Rxls_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "", "", "Rxls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + X)", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_xls.php?script_case_init=" . $this->Ini->sc_page . "&app_name=grid_agenda_cliente&nm_tp_xls=xlsx&nm_tot_xls=S&nm_tot_xls=S&nm_res_cons=s&nm_ini_xls_res=grid,resume,chart&nm_all_modules=grid,resume,chart&password=n&summary_export_columns=S&origem=res&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
         if ($NM_Gbtn)
         {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
            $NM_Gbtn = false;
         }
      if (!$this->grid_emb_form && $this->nmgp_botoes['xml'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rxml_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['xml'][] = "Rxml_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "", "", "Rxml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + M)", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_xml.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&password=n&nm_res_cons=s&nm_ini_xml_res=grid,resume,chart&nm_all_modules=grid,resume,chart&nm_xml_tag=tag&nm_xml_label=S&language=es&origem=res&KeepThis=true&TB_iframe=true&modal=true", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if (!$this->grid_emb_form && $this->nmgp_botoes['json'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rjson_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['json'][] = "Rjson_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bjson", "", "", "Rjson_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_json.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&password=n&nm_res_cons=s&nm_ini_json_res=grid,resume,chart&nm_all_modules=grid,resume,chart&nm_json_format=N&nm_json_label=S&language=es&origem=res&KeepThis=true&TB_iframe=true&modal=true", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if (!$this->grid_emb_form && $this->nmgp_botoes['csv'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rcsv_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['csv'][] = "Rcsv_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "", "", "Rcsv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + C)", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_csv.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&nm_res_cons=s&nm_ini_csv_res=grid,resume,chart&nm_all_modules=grid,resume,chart&password=n&nm_delim_line=1&nm_delim_col=1&nm_delim_dados=1&nm_label_csv=N&language=es&origem=res&KeepThis=true&TB_iframe=true&modal=true", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if (!$this->grid_emb_form && $this->nmgp_botoes['rtf'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rrtf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['rtf'][] = "Rrtf_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_rtf_conf();", "nm_gp_rtf_conf();", "Rrtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + R)", "", "", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
         if ($NM_Gbtn)
         {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
            $NM_Gbtn = false;
         }
      if (!$this->grid_emb_form && $this->nmgp_botoes['print'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rprinttop\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['print'][] = "Rprint_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "Rprint_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + P)", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&nm_opc=resumo&nm_cor=CO&nm_res_cons=s&nm_ini_prt_res=grid,resume,chart&nm_all_modules=grid,resume,chart&password=n&origem=res&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_3", 'group_3', 'top', 'list', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_3_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_3_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
      if (!$this->grid_emb_form && $this->nmgp_botoes['group_4'] == "on")
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_4_top = false;</script>\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_4", "scBtnGrpShow('group_4_top')", "scBtnGrpShow('group_4_top')", "sc_btgp_btn_group_4_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt_email_title'] . "", "", "absmiddle", "", "", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt_email'] . "", "", "", "__sc_grp__", "text_fontawesomeicon", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_4", 'group_4', 'top', 'list', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_4", 'group_4', 'top', 'list', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_4_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_4_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
      if ($this->nmgp_botoes['chart_conf'] == 'on' && !$this->grid_emb_form && !$this->NM_res_sem_reg)
      {
         $this->nm_btn_exist['chart_conf'][] = "Rgraf_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bconf_graf", "", "", "Rgraf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_config_graf_flash.php?nome_apl=grid_agenda_cliente&campo_apl=nm_resumo_graf&sc_page=" . NM_encode_input($this->Ini->sc_page) . "&language=es&tp_apl=cns_htm&KeepThis=true&TB_iframe=true&height=450&width=400&modal=true", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
      }
      if ($this->nmgp_botoes['chart_settings'] == 'on' && !$this->grid_emb_form && !$this->NM_res_sem_reg)
      {
         $this->nm_btn_exist['chart_settings'][] = "Rconfig_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "smry_conf", "summaryConfig();", "summaryConfig();", "Rconfig_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
      }
      if ($this->nmgp_botoes['groupby'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opc_psq'] && !$this->grid_emb_form && !$this->NM_res_sem_reg)
      {
          $Q_free  = false;
          $Q_count = 0;
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['SC_All_Groupby'] as $QB => $Tp)
          {
              if (!in_array($QB, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['SC_Groupby_hide']) && $Tp == "all")
              {
                  $Q_count++;
                  if ($QB == "sc_free_group_by")
                  {
                      $Q_free = true;
                  }
              }
          }
          if ($Q_count > 1 || $Q_free)
          {
             $this->nm_btn_exist['groupby'][] = "sel_groupby_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bgroupby", "scBtnGroupByShow('" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_sel_groupby.php?opc_ret=resumo&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnGroupByShow('" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_sel_groupby.php?opc_ret=resumo&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "sel_groupby_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + G)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          }
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['chart_detail'] == 'on' && !$this->grid_emb_form && !$this->NM_res_sem_reg)
      {
         $this->nm_btn_exist['chart_detail'][] = "Rrotac_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "blink_resumogrid", "nm_gp_move('inicio', '0');", "nm_gp_move('inicio', '0');", "Rrotac_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Enter)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
      }
      if ($this->nmgp_botoes['reload'] == 'on' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opc_psq'] && !$this->grid_emb_form)
      {
              $this->nm_btn_exist['reload'][] = "reload_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "breload", "ajax_navigate_res ('resumo', 'breload');", "ajax_navigate_res ('resumo', 'breload');", "reload_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
         if (is_file("grid_agenda_cliente_help.txt") && !$this->grid_emb_form && !$this->NM_res_sem_reg)
         {
            $Arq_WebHelp = file("grid_agenda_cliente_help.txt"); 
            if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
            {
                $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                $Tmp = explode(";", $Arq_WebHelp[0]); 
                foreach ($Tmp as $Cada_help)
                {
                    $Tmp1 = explode(":", $Cada_help); 
                    if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "res" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                    {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "Rhelp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (F1)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                    }
                }
            }
         }
      if ($this->nmgp_botoes['chart_exit'] == 'on' && !$this->grid_emb_form)
      {
          $this->nm_btn_exist['exit'][] = "Rsai_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('igual', '0');", "nm_gp_move('igual', '0');", "Rsai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
      }
         $nm_saida->saida("     </TD>\r\n");
         $nm_saida->saida("    </TR>\r\n");
         $nm_saida->saida("   </TABLE>\r\n");
         $nm_saida->saida("  </TD>\r\n");
         $nm_saida->saida(" </TR>\r\n");
      }
   }

   //-----  bot
   function monta_barra_bot_normal()
   {
      global $nm_url_saida, $nm_apl_dependente, $nm_saida;
      $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida'])
      {
         $nm_saida->saida(" <TR align=\"center\" id=\"obj_barra_bot\">\r\n");
         $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\">\r\n");
         $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%;\">\r\n");
         $nm_saida->saida("    <TR class=\"" . $this->css_scGridToolbarPadd . "_tr\">\r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\">\r\n");
         $NM_btn  = false;
         $NM_Gbtn = false;
            if ($this->aux_hasPagination()) {
                $goToValue = $this->SC_APP_data['pagination'] ['page'];
                $this->nm_btn_exist['goto'][] = 'res_brec_bot';
                $buttonCode = nmButtonOutput($this->arr_buttons, "birpara", "scChangePagination('page', $('#res_brec_qtd_bot').val());", "scChangePagination('page', $('#res_brec_qtd_bot').val());", "res_brec_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                $nm_saida->saida("            $buttonCode\r\n");
              $nm_saida->saida("            <input id=\"res_brec_qtd_bot\" type=\"text\" class=\"" . $this->css_css_toolbar_obj . "\" value=\"" . $goToValue . "\" style=\"width:25px;vertical-align: middle;\"/> \r\n");
            }
            if ($this->aux_hasPagination()) {
                $nm_saida->saida("            <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border: 0px;vertical-align: middle;\">" . $this->Ini->Nm_lang['lang_btns_rows'] . "</span>\r\n");
                $nm_saida->saida("            <select class=\"" . $this->css_css_toolbar_obj . "\" id=\"res_qtlin_qtd_bot\" onchange=\"scChangePagination('length', $('#res_qtlin_qtd_bot').val())\">\r\n");
                $lengthSelected = $this->SC_APP_data['pagination'] ['length'] == '10' ? ' selected="selected"' : '';
                $nm_saida->saida("                <option value=\"10\"{$lengthSelected}>10</option>\r\n");
                $lengthSelected = $this->SC_APP_data['pagination'] ['length'] == '20' ? ' selected="selected"' : '';
                $nm_saida->saida("                <option value=\"20\"{$lengthSelected}>20</option>\r\n");
                $lengthSelected = $this->SC_APP_data['pagination'] ['length'] == '50' ? ' selected="selected"' : '';
                $nm_saida->saida("                <option value=\"50\"{$lengthSelected}>50</option>\r\n");
                $lengthSelected = $this->SC_APP_data['pagination'] ['length'] == 'ALL' ? ' selected="selected"' : '';
                $nm_saida->saida("                <option value=\"ALL\"{$lengthSelected}>ALL</option>\r\n");
                $nm_saida->saida("            </select>\r\n");
            }
         $nm_saida->saida("     </TD> \r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\">\r\n");
         $NM_btn = false;
         $NM_Gbtn = false;
            if ($this->aux_hasPagination()) {
                $this->nm_btn_exist['res_first'][] = 'res_first_bot';
                if (1 < $this->SC_APP_data['pagination'] ['first']) {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_inicio", "scChangePagination('record', 1);", "scChangePagination('record', 1);", "res_first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Shift + &#8592;)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                } else {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_inicio", "scChangePagination('record', 1);", "scChangePagination('record', 1);", "res_first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Shift + &#8592;)", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                }
                $nm_saida->saida("           $buttonCode\r\n");
            }
            if ($this->aux_hasPagination()) {
                $this->nm_btn_exist['res_back'][] = 'res_back_bot';
                if (1 < $this->SC_APP_data['pagination'] ['first']) {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_retorna", "scChangePagination('record', scPag_back);", "scChangePagination('record', scPag_back);", "res_back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + &#8594;)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                } else {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_retorna", "scChangePagination('record', scPag_back);", "scChangePagination('record', scPag_back);", "res_back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + &#8594;)", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                }
                $nm_saida->saida("           $buttonCode\r\n");
            }
            if ($this->aux_hasPagination()) {
                $nm_saida->saida("            <span id=\"res_nav_bot\">\r\n");
                $nm_saida->saida("                {$this->SC_APP_data['pagination'] ['page_link_html']}\r\n");
                $nm_saida->saida("            </span>\r\n");
            }
            if ($this->aux_hasPagination()) {
                $this->nm_btn_exist['res_forward'][] = 'res_forward_bot';
                if ($this->SC_APP_data['pagination'] ['record_count'] > $this->SC_APP_data['pagination'] ['last']) {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_avanca", "scChangePagination('record', scPag_forward);", "scChangePagination('record', scPag_forward);", "res_forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + &#8594;)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                } else {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_avanca", "scChangePagination('record', scPag_forward);", "scChangePagination('record', scPag_forward);", "res_forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + &#8594;)", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                }
                $nm_saida->saida("           $buttonCode\r\n");
            }
            if ($this->aux_hasPagination()) {
                $this->nm_btn_exist['res_forward'][] = 'res_last_bot';
                if ($this->SC_APP_data['pagination'] ['record_count'] > $this->SC_APP_data['pagination'] ['last']) {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_final", "scChangePagination('page', scPag_pageCount);", "scChangePagination('page', scPag_pageCount);", "res_last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Shift + &#8594;)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                } else {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_final", "scChangePagination('page', scPag_pageCount);", "scChangePagination('page', scPag_pageCount);", "res_last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Shift + &#8594;)", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                }
                $nm_saida->saida("            $buttonCode\r\n");
            }
         $nm_saida->saida("     </TD> \r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\">\r\n");
         $NM_btn = false;
         $NM_Gbtn = false;
         if (is_file("grid_agenda_cliente_help.txt") && !$this->grid_emb_form && !$this->NM_res_sem_reg)
         {
            $Arq_WebHelp = file("grid_agenda_cliente_help.txt"); 
            if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
            {
                $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                $Tmp = explode(";", $Arq_WebHelp[0]); 
                foreach ($Tmp as $Cada_help)
                {
                    $Tmp1 = explode(":", $Cada_help); 
                    if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "res" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                    {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "Rhelp_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (F1)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                    }
                }
            }
         }
         $nm_saida->saida("     </TD>\r\n");
         $nm_saida->saida("    </TR>\r\n");
         $nm_saida->saida("   </TABLE>\r\n");
         $nm_saida->saida("  </TD>\r\n");
         $nm_saida->saida(" </TR>\r\n");
      }
   }

   //-----  bot
   function monta_barra_bot_mobile()
   {
      global $nm_url_saida, $nm_apl_dependente, $nm_saida;
      $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida'])
      {
         $nm_saida->saida(" <TR align=\"center\" id=\"obj_barra_bot\">\r\n");
         $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\">\r\n");
         $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%;\">\r\n");
         $nm_saida->saida("    <TR class=\"" . $this->css_scGridToolbarPadd . "_tr\">\r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\">\r\n");
         $NM_btn  = false;
         $NM_Gbtn = false;
            if ($this->aux_hasPagination()) {
                $goToValue = $this->SC_APP_data['pagination'] ['page'];
                $this->nm_btn_exist['goto'][] = 'res_brec_bot';
                $buttonCode = nmButtonOutput($this->arr_buttons, "birpara", "scChangePagination('page', $('#res_brec_qtd_bot').val());", "scChangePagination('page', $('#res_brec_qtd_bot').val());", "res_brec_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                $nm_saida->saida("            $buttonCode\r\n");
              $nm_saida->saida("            <input id=\"res_brec_qtd_bot\" type=\"text\" class=\"" . $this->css_css_toolbar_obj . "\" value=\"" . $goToValue . "\" style=\"width:25px;vertical-align: middle;\"/> \r\n");
            }
            if ($this->aux_hasPagination()) {
                $nm_saida->saida("            <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border: 0px;vertical-align: middle;\">" . $this->Ini->Nm_lang['lang_btns_rows'] . "</span>\r\n");
                $nm_saida->saida("            <select class=\"" . $this->css_css_toolbar_obj . "\" id=\"res_qtlin_qtd_bot\" onchange=\"scChangePagination('length', $('#res_qtlin_qtd_bot').val())\">\r\n");
                $lengthSelected = $this->SC_APP_data['pagination'] ['length'] == '10' ? ' selected="selected"' : '';
                $nm_saida->saida("                <option value=\"10\"{$lengthSelected}>10</option>\r\n");
                $lengthSelected = $this->SC_APP_data['pagination'] ['length'] == '20' ? ' selected="selected"' : '';
                $nm_saida->saida("                <option value=\"20\"{$lengthSelected}>20</option>\r\n");
                $lengthSelected = $this->SC_APP_data['pagination'] ['length'] == '50' ? ' selected="selected"' : '';
                $nm_saida->saida("                <option value=\"50\"{$lengthSelected}>50</option>\r\n");
                $lengthSelected = $this->SC_APP_data['pagination'] ['length'] == 'ALL' ? ' selected="selected"' : '';
                $nm_saida->saida("                <option value=\"ALL\"{$lengthSelected}>ALL</option>\r\n");
                $nm_saida->saida("            </select>\r\n");
            }
            if ($this->aux_hasPagination()) {
                $this->nm_btn_exist['res_first'][] = 'res_first_bot';
                if (1 < $this->SC_APP_data['pagination'] ['first']) {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_inicio", "scChangePagination('record', 1);", "scChangePagination('record', 1);", "res_first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Shift + &#8592;)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                } else {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_inicio", "scChangePagination('record', 1);", "scChangePagination('record', 1);", "res_first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Shift + &#8592;)", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                }
                $nm_saida->saida("           $buttonCode\r\n");
            }
            if ($this->aux_hasPagination()) {
                $this->nm_btn_exist['res_back'][] = 'res_back_bot';
                if (1 < $this->SC_APP_data['pagination'] ['first']) {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_retorna", "scChangePagination('record', scPag_back);", "scChangePagination('record', scPag_back);", "res_back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + &#8594;)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                } else {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_retorna", "scChangePagination('record', scPag_back);", "scChangePagination('record', scPag_back);", "res_back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + &#8594;)", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                }
                $nm_saida->saida("           $buttonCode\r\n");
            }
            if ($this->aux_hasPagination()) {
                $nm_saida->saida("            <span id=\"res_nav_bot\">\r\n");
                $nm_saida->saida("                {$this->SC_APP_data['pagination'] ['page_link_html']}\r\n");
                $nm_saida->saida("            </span>\r\n");
            }
            if ($this->aux_hasPagination()) {
                $this->nm_btn_exist['res_forward'][] = 'res_forward_bot';
                if ($this->SC_APP_data['pagination'] ['record_count'] > $this->SC_APP_data['pagination'] ['last']) {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_avanca", "scChangePagination('record', scPag_forward);", "scChangePagination('record', scPag_forward);", "res_forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + &#8594;)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                } else {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_avanca", "scChangePagination('record', scPag_forward);", "scChangePagination('record', scPag_forward);", "res_forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + &#8594;)", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                }
                $nm_saida->saida("           $buttonCode\r\n");
            }
            if ($this->aux_hasPagination()) {
                $this->nm_btn_exist['res_forward'][] = 'res_last_bot';
                if ($this->SC_APP_data['pagination'] ['record_count'] > $this->SC_APP_data['pagination'] ['last']) {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_final", "scChangePagination('page', scPag_pageCount);", "scChangePagination('page', scPag_pageCount);", "res_last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Shift + &#8594;)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                } else {
                    $buttonCode = nmButtonOutput($this->arr_buttons, "bcons_final", "scChangePagination('page', scPag_pageCount);", "scChangePagination('page', scPag_pageCount);", "res_last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Shift + &#8594;)", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

                }
                $nm_saida->saida("            $buttonCode\r\n");
            }
         if (is_file("grid_agenda_cliente_help.txt") && !$this->grid_emb_form && !$this->NM_res_sem_reg)
         {
            $Arq_WebHelp = file("grid_agenda_cliente_help.txt"); 
            if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
            {
                $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                $Tmp = explode(";", $Arq_WebHelp[0]); 
                foreach ($Tmp as $Cada_help)
                {
                    $Tmp1 = explode(":", $Cada_help); 
                    if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "res" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                    {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "Rhelp_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (F1)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                    }
                }
            }
         }
         $nm_saida->saida("     </TD>\r\n");
         $nm_saida->saida("    </TR>\r\n");
         $nm_saida->saida("   </TABLE>\r\n");
         $nm_saida->saida("  </TD>\r\n");
         $nm_saida->saida(" </TR>\r\n");
      }
   }

   function monta_barra_top()
   {
       $this->grid_emb_form = false;
       if(isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->monta_barra_top_mobile();
       }
       else
       {
           $this->monta_barra_top_normal();
       }
   }
   function monta_barra_bot()
   {
       $this->grid_emb_form = false;
       if(isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->monta_barra_bot_mobile();
       }
       else
       {
           $this->monta_barra_bot_normal();
       }
   }
   function monta_embbed_placeholder_top()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   function monta_embbed_placeholder_bot()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   function monta_embbed_placeholder_mobile_top()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   function monta_embbed_placeholder_mobile_bot()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   //----- 
   function monta_html_fim()
   {
      global $nm_saida;
      $str_pbfile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['print_all'])
      {
          $this->grafico_pdf();
      }
      $nm_saida->saida("</TABLE>\r\n");
      $nm_saida->saida("<link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_sweetalert.css\" />\r\n");
      $nm_saida->saida("<script type=\"text/javascript\" src=\"" . $_SESSION['scriptcase']['grid_agenda_cliente']['glo_nm_path_prod'] . "/third/sweetalert/sweetalert2.all.min.js\"></script>\r\n");
      $nm_saida->saida("<script type=\"text/javascript\" src=\"" . $_SESSION['scriptcase']['grid_agenda_cliente']['glo_nm_path_prod'] . "/third/sweetalert/polyfill.min.js\"></script>\r\n");
      $nm_saida->saida("<script type=\"text/javascript\" src=\"../_lib/lib/js/frameControl.js\"></script>\r\n");
      $confirmButtonClass = '';
      $cancelButtonClass  = '';
      $confirmButtonText  = $this->Ini->Nm_lang['lang_btns_cfrm'];
      $cancelButtonText   = $this->Ini->Nm_lang['lang_btns_cncl'];
      $confirmButtonFA    = '';
      $cancelButtonFA     = '';
      $confirmButtonFAPos = '';
      $cancelButtonFAPos  = '';
      if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['style']) && '' != $this->arr_buttons['bsweetalert_ok']['style']) {
          $confirmButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_ok']['style'];
      }
      if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['style']) && '' != $this->arr_buttons['bsweetalert_cancel']['style']) {
          $cancelButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_cancel']['style'];
      }
      if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['value']) && '' != $this->arr_buttons['bsweetalert_ok']['value']) {
          $confirmButtonText = $this->arr_buttons['bsweetalert_ok']['value'];
      }
      if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['value']) && '' != $this->arr_buttons['bsweetalert_cancel']['value']) {
          $cancelButtonText = $this->arr_buttons['bsweetalert_cancel']['value'];
      }
      if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) {
          $confirmButtonFA = $this->arr_buttons['bsweetalert_ok']['fontawesomeicon'];
      }
      if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) {
          $cancelButtonFA = $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon'];
      }
      if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_ok']['display_position']) {
          $confirmButtonFAPos = 'text_right';
      }
      if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_cancel']['display_position']) {
          $cancelButtonFAPos = 'text_right';
      }
      $nm_saida->saida("<script type=\"text/javascript\">\r\n");
      $nm_saida->saida("  var scSweetAlertConfirmButton = \"" . $confirmButtonClass . "\";\r\n");
      $nm_saida->saida("  var scSweetAlertCancelButton = \"" . $cancelButtonClass . "\";\r\n");
      $nm_saida->saida("  var scSweetAlertConfirmButtonText = \"" . $confirmButtonText . "\";\r\n");
      $nm_saida->saida("  var scSweetAlertCancelButtonText = \"" . $cancelButtonText . "\";\r\n");
      $nm_saida->saida("  var scSweetAlertConfirmButtonFA = \"" . $confirmButtonFA . "\";\r\n");
      $nm_saida->saida("  var scSweetAlertCancelButtonFA = \"" . $cancelButtonFA . "\";\r\n");
      $nm_saida->saida("  var scSweetAlertConfirmButtonFAPos = \"" . $confirmButtonFAPos . "\";\r\n");
      $nm_saida->saida("  var scSweetAlertCancelButtonFAPos = \"" . $cancelButtonFAPos . "\";\r\n");
      $nm_saida->saida("</script>\r\n");
      $nm_saida->saida("<script type=\"text/javascript\">\r\n");
      $nm_saida->saida("$(function() {\r\n");
      if ((isset($this->nm_mens_alert) && count($this->nm_mens_alert)) || (isset($this->Ini->nm_mens_alert) && count($this->Ini->nm_mens_alert))) {
   if (isset($this->Ini->nm_mens_alert) && !empty($this->Ini->nm_mens_alert))
   {
       if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
       {
           $this->nm_mens_alert   = array_merge($this->Ini->nm_mens_alert, $this->nm_mens_alert);
           $this->nm_params_alert = array_merge($this->Ini->nm_params_alert, $this->nm_params_alert);
       }
       else
       {
           $this->nm_mens_alert   = $this->Ini->nm_mens_alert;
           $this->nm_params_alert = $this->Ini->nm_params_alert;
       }
   }
   if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
   {
       foreach ($this->nm_mens_alert as $i_alert => $mensagem)
       {
           $alertParams = array();
           if (isset($this->nm_params_alert[$i_alert]))
           {
               foreach ($this->nm_params_alert[$i_alert] as $paramName => $paramValue)
               {
                   if (in_array($paramName, array('title', 'timer', 'confirmButtonText', 'confirmButtonFA', 'confirmButtonFAPos', 'cancelButtonText', 'cancelButtonFA', 'cancelButtonFAPos', 'footer', 'width', 'padding')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif (in_array($paramName, array('showConfirmButton', 'showCancelButton', 'toast')) && in_array($paramValue, array(true, false)))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('position' == $paramName && in_array($paramValue, array('top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', 'bottom-end')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('type' == $paramName && in_array($paramValue, array('warning', 'error', 'success', 'info', 'question')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('background' == $paramName)
                   {
                       $image_param = $paramValue;
                       preg_match_all('/url\(([\s])?(["|\'])?(.*?)(["|\'])?([\s])?\)/i', $paramValue, $matches, PREG_PATTERN_ORDER);
                       if (isset($matches[3])) {
                           foreach ($matches[3] as $match) {
                               if ('http:' != substr($match, 0, 5) && 'https:' != substr($match, 0, 6) && '/' != substr($match, 0, 1)) {
                                   $image_param = str_replace($match, "{$this->Ini->path_img_global}/{$match}", $image_param);
                               }
                           }
                       }
                       $paramValue = $image_param;
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
               }
           }
           $jsonParams = json_encode($alertParams);
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'])
           { 
               $this->Ini->Arr_result['AlertJS'][] = NM_charset_to_utf8($mensagem);
               $this->Ini->Arr_result['AlertJSParam'][] = $alertParams;
           } 
           else 
           { 
$nm_saida->saida("       scJs_alert('" . $mensagem . "', $jsonParams);\r\n");
           } 
       }
   }
      }
      $nm_saida->saida("});\r\n");
      $nm_saida->saida("</script>\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida'])
      { 
          return;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['doc_word'])
      { 
      $nm_saida->saida("</BODY>\r\n");
      $nm_saida->saida("</HTML>\r\n");
          return;
      } 
if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['doc_word'])
{ 
      $nm_saida->saida("</TABLE>\r\n");
      $nm_saida->saida("</div>\r\n");
      $nm_saida->saida("</TD>\r\n");
      $nm_saida->saida("</TR>\r\n");
      $nm_saida->saida("</TABLE>\r\n");
       $nm_saida->saida("<script type=\"text/javascript\">\r\n");
       $nm_saida->saida("function summaryConfig() {\r\n");
       $nm_saida->saida("  tb_show('', 'grid_agenda_cliente_config_pivot.php?nome_apl=grid_agenda_cliente&sc_page=" . NM_encode_input($this->Ini->sc_page) . "&language=es&TB_iframe=true&modal=true&height=300&width=500', '');\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function changeSort(col, ord, oldSort) {\r\n");
       $nm_saida->saida("  Parm_change  = 'change_sort*scin';\r\n");
       $nm_saida->saida("  Parm_change += oldSort ? 'Y' : 'NEW';\r\n");
       $nm_saida->saida("  Parm_change += '*scoutsort_col*scin';\r\n");
       $nm_saida->saida("  Parm_change +=  col;\r\n");
       $nm_saida->saida("  Parm_change += '*scoutsort_ord*scin';\r\n");
       $nm_saida->saida("  Parm_change +=  ord;\r\n");
       $nm_saida->saida("  nm_gp_submit_ajax('resumo', Parm_change);\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("</script>\r\n");
       $nm_saida->saida("<form name=\"refresh_config\" method=\"post\" action=\"./\" style=\"display: none\">\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"nmgp_opcao\" value=\"resumo\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"change_sort\" value=\"N\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"sort_col\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"sort_ord\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"reload_summary_data\" />\r\n");
       $nm_saida->saida("</form>\r\n");
}
      $nm_saida->saida("<FORM name=\"F3\" method=\"post\" action=\"./\"\r\n");
      $nm_saida->saida("                                  target = \"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_chave\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_opcao\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_tipo_pdf\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_ordem\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_chave_det\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_quant_linhas\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_url_saida\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_parms\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_outra_jan\" value=\"\"/>\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_orig_pesq\" value=\"\"/>\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\" />\r\n");
      $nm_saida->saida("</FORM>\r\n");
      $nm_saida->saida("<form name=\"FRES\" method=\"post\" \r\n");
      $nm_saida->saida("                    action=\"\" \r\n");
      $nm_saida->saida("                    target=\"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("<input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("</form> \r\n");
      $nm_saida->saida("<form name=\"FRES_chart_export_view\" method=\"get\" target=\"_blank\" style=\"display: none\"></form>\r\n");
      $nm_saida->saida("<form name=\"FCONS\" method=\"post\" \r\n");
      $nm_saida->saida("                    action=\"./\" \r\n");
      $nm_saida->saida("                    target=\"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_opcao\" value=\"link_res\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_parms_where\" value=\"\" />\r\n");
      $nm_saida->saida("<input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("</form> \r\n");
   $nm_saida->saida("   <form name=\"F4\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"rec\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"rec\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_call_php\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
      $nm_saida->saida("<form name=\"Fgraf\" method=\"post\" \r\n");
      $nm_saida->saida("                   action=\"./\" \r\n");
      $nm_saida->saida("                   target=\"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_opcao\" value=\"grafico\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"campo\" value=\"\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"nivel_quebra\" value=\"\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"campo_val\" value=\"\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_parms\" value=\"\" />\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"summary_chart\" value=\"N\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"chart_md5\" value=\"\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"summary_css\" value=\"" . NM_encode_input($this->Ini->summary_css) . "\"/> \r\n");
      $nm_saida->saida("</form> \r\n");
   $nm_saida->saida("<form name=\"Fprint\" id=\"sc-id-form-print\" method=\"post\" \r\n");
   $nm_saida->saida("                  action=\"grid_agenda_cliente_iframe_prt.php\" \r\n");
   $nm_saida->saida("                  target=\"jan_print\" style=\"display: none\"> \r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"path_botoes\" value=\"" . $this->Ini->path_botoes . "\"/> \r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"opcao\" value=\"res_print\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"tp_print\" value=\"RC\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"cor_print\" value=\"CO\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_opcao\" value=\"res_print\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_tipo_print\" value=\"RC\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_cor_print\" value=\"CO\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("</form> \r\n");
   $nm_saida->saida("   <form name=\"Fexport\" id=\"sc-id-form-export\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tp_xls\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tot_xls\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_line\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_col\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_dados\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_label_csv\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_xml_tag\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_xml_label\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_json_format\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_json_label\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("  <form name=\"Fdoc_word\" id=\"sc-id-form-word-export\" method=\"post\" style=\"display: none\" \r\n");
   $nm_saida->saida("      action=\"./\" \r\n");
   $nm_saida->saida("      target=\"_self\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"doc_word_res\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_cor_word\" value=\"CO\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_navegator_print\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("  </form> \r\n");
   $nm_saida->saida("  <form name=\"Fres_pdf\" method=\"post\" target=\"_self\">\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_tp_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tipo_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_parms_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"chart_level\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_create_charts\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_graf_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_graf_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"use_pass_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_all_cab\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_all_label\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_label_group\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_zip\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . session_id() . "\"/> \r\n");
   $nm_saida->saida("  </form> \r\n");
   $nm_saida->saida("<SCRIPT language=\"Javascript\">\r\n");
   $nm_saida->saida("   $(function(){ \r\n");
   $nm_saida->saida("       NM_btn_disable();\r\n");
   $nm_saida->saida("   }); \r\n");
   $nm_saida->saida("   function NM_btn_disable()\r\n");
   $nm_saida->saida("   {\r\n");
   foreach ($this->nm_btn_disabled as $cod_btn => $st_btn) {
      if (isset($this->nm_btn_exist[$cod_btn]) && $st_btn == 'on') {
         foreach ($this->nm_btn_exist[$cod_btn] as $cada_id) {
           $nm_saida->saida("     $('#" . $cada_id . "').prop('onclick', null).off('click').addClass('disabled').removeAttr('href');\r\n");
           $nm_saida->saida("     $('#div_" . $cada_id . "').addClass('disabled');\r\n");
         }
      }
   }
   $nm_saida->saida("   }\r\n");
      $nm_saida->saida("   function nm_gp_word_conf(cor, SC_module_export, password, ajax, str_type, bol_param)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (\"R\" == ajax)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           $('#TB_window').remove();\r\n");
      $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
      $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_cor_word=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           document.Fdoc_word.nmgp_cor_word.value = cor;\r\n");
      $nm_saida->saida("           document.Fdoc_word.nmgp_password.value = password;\r\n");
      $nm_saida->saida("           document.Fdoc_word.SC_module_export.value = SC_module_export;\r\n");
      $nm_saida->saida("               document.Fdoc_word.action = \"grid_agenda_cliente_export_ctrl.php\";\r\n");
      $nm_saida->saida("           document.Fdoc_word.submit();\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida(" function nm_link_cons(x) \r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("     document.FCONS.nmgp_parms_where.value = x;\r\n");
      $nm_saida->saida("     document.FCONS.submit();\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida("   function nm_gp_print_conf(tp, cor, SC_module_export, password, ajax, str_type, bol_param)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (\"R\" == ajax)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           $('#TB_window').remove();\r\n");
      $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
      $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__cor_print=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           document.Fprint.tp_print.value = tp;\r\n");
      $nm_saida->saida("           document.Fprint.cor_print.value = cor;\r\n");
      $nm_saida->saida("           document.Fprint.nmgp_tipo_print.value = tp;\r\n");
      $nm_saida->saida("           document.Fprint.nmgp_cor_print.value = cor;\r\n");
      $nm_saida->saida("           document.Fprint.SC_module_export.value = SC_module_export;\r\n");
      $nm_saida->saida("           document.Fprint.nmgp_password.value = password;\r\n");
      $nm_saida->saida("           if (password != \"\")\r\n");
      $nm_saida->saida("           {\r\n");
      $nm_saida->saida("               document.Fprint.target = '_self';\r\n");
      $nm_saida->saida("               document.Fprint.action = \"grid_agenda_cliente_export_ctrl.php\";\r\n");
      $nm_saida->saida("           }\r\n");
      $nm_saida->saida("           else\r\n");
      $nm_saida->saida("           {\r\n");
      $nm_saida->saida("               window.open('','jan_print','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
      $nm_saida->saida("           }\r\n");
      $nm_saida->saida("           document.Fprint.submit() ;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("   function nm_gp_xls_conf(tp_xls, SC_module_export, password, tot_xls, ajax, str_type, bol_param)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (\"R\" == ajax)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           $('#TB_window').remove();\r\n");
      $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
      $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_tp_xls=\" + tp_xls + \"__E__nmgp_tot_xls=\" + tot_xls + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_opcao.value = 'xls_res';\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_tp_xls.value = tp_xls;\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_tot_xls.value = tot_xls;\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
      $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
      $nm_saida->saida("               document.Fexport.action = \"grid_agenda_cliente_export_ctrl.php\";\r\n");
      $nm_saida->saida("           document.Fexport.submit() ;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("   function nm_gp_csv_conf(delim_line, delim_col, delim_dados, label_csv, SC_module_export, password, ajax, str_type, bol_param)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (\"R\" == ajax)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           $('#TB_window').remove();\r\n");
      $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
      $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_delim_line=\" + delim_line + \"__E__nm_delim_col=\" + delim_col + \"__E__nm_delim_dados=\" + delim_dados + \"__E__nm_label_csv=\" + label_csv + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_opcao.value = \"csv_res\";\r\n");
      $nm_saida->saida("           document.Fexport.nm_delim_line.value = delim_line;\r\n");
      $nm_saida->saida("           document.Fexport.nm_delim_col.value = delim_col;\r\n");
      $nm_saida->saida("           document.Fexport.nm_delim_dados.value = delim_dados;\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
      $nm_saida->saida("           document.Fexport.nm_label_csv.value = label_csv;\r\n");
      $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
      $nm_saida->saida("               document.Fexport.action = \"grid_agenda_cliente_export_ctrl.php\";\r\n");
      $nm_saida->saida("           document.Fexport.submit() ;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("   function nm_gp_xml_conf(xml_tag, xml_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (\"R\" == ajax)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           $('#TB_window').remove();\r\n");
      $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
      $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_xml_tag=\" + xml_tag + \"__E__nm_xml_label=\" + xml_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_opcao.value = \"xml_res\";\r\n");
      $nm_saida->saida("           document.Fexport.nm_xml_tag.value   = xml_tag;\r\n");
      $nm_saida->saida("           document.Fexport.nm_xml_label.value = xml_label;\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
      $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
      $nm_saida->saida("               document.Fexport.action = \"grid_agenda_cliente_export_ctrl.php\";\r\n");
      $nm_saida->saida("           document.Fexport.submit() ;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("   function nm_gp_json_conf(json_format, json_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (\"R\" == ajax)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           $('#TB_window').remove();\r\n");
      $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
      $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_json_format=\" + json_format + \"__E__nm_json_label=\" + json_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_opcao.value    = \"json_res\";\r\n");
      $nm_saida->saida("           document.Fexport.nm_json_format.value   = json_format;\r\n");
      $nm_saida->saida("           document.Fexport.nm_json_label.value = json_label;\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
      $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
      $nm_saida->saida("               document.Fexport.action = \"grid_agenda_cliente_export_ctrl.php\";\r\n");
      $nm_saida->saida("           document.Fexport.submit() ;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("   function nm_gp_rtf_conf()\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       document.Fexport.nmgp_opcao.value = \"rtf_res\";\r\n");
      $nm_saida->saida("       document.Fexport.action = \"grid_agenda_cliente_export_ctrl.php\";\r\n");
      $nm_saida->saida("       document.Fexport.submit() ;\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida(" function nm_open_export(arq_export) \r\n");
      $nm_saida->saida(" { \r\n");
      $nm_saida->saida("    window.location = arq_export;\r\n");
      $nm_saida->saida(" } \r\n");
      $nm_saida->saida(" function nm_gp_submit_ajax(opc, parm)\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("    return ajax_navigate_res(opc, parm);\r\n");
      $nm_saida->saida(" }\r\n");
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
      $nm_saida->saida("   function nm_move() \r\n");
      $nm_saida->saida("   { \r\n");
      $nm_saida->saida("      document.F3.target = \"_self\"; \r\n");
      $nm_saida->saida("      document.F3.submit();\r\n");
      $nm_saida->saida("   } \r\n");
      $nm_saida->saida(" function nm_gp_move(x, y, z, p, g, crt, ajax, chart_level, page_break_pdf, SC_module_export, use_pass_pdf, pdf_all_cab, pdf_all_label, pdf_label_group, pdf_zip) \r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("  document.F3.nmgp_opcao.value = x;\r\n");
      $nm_saida->saida("  document.F3.target = \"_self\"; \r\n");
      $nm_saida->saida("  if (y == 1) \r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      document.F3.target = \"_blank\"; \r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  if (\"busca\" == x)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      document.F3.nmgp_orig_pesq.value = z; \r\n");
      $nm_saida->saida("      z = '';\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  if (z != null && z != '') \r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("     document.F3.nmgp_tipo_pdf.value = z;\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  document.F3.script_case_init.value = \"" . NM_encode_input($this->Ini->sc_page) . "\" ;\r\n");
      $nm_saida->saida("  if (\"xls_res\" == x)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("       document.F3.SC_module_export.value = z;\r\n");
      $nm_saida->saida("       str_type = (z == \"s\") ? \"xls\" : \"xls_res\"\r\n");
      $nm_saida->saida("       document.F3.nmgp_opcao.value = str_type;\r\n");
      if (!extension_loaded("zip"))
      {
      $nm_saida->saida("      alert (\"" . html_entity_decode($this->Ini->Nm_lang['lang_othr_prod_xtzp'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\");\r\n");
      $nm_saida->saida("      return false;\r\n");
      } 
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  if (\"xml_res\" == x)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("       document.F3.SC_module_export.value = z;\r\n");
      $nm_saida->saida("  }\r\n");
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_agenda_cliente_iframe_params'] = array(
          'str_tmp'          => $this->Ini->path_imag_temp,
          'str_prod'         => $this->Ini->path_prod,
          'str_btn'          => $this->Ini->Str_btn_css,
          'str_lang'         => $this->Ini->str_lang,
          'str_schema'       => $this->Ini->str_schema_all,
          'str_google_fonts' => $this->Ini->str_google_fonts,
      );
      $prep_parm_pdf = "nmgp_opcao?#?pdf_res?@?scsess?#?" . session_id() . "?@?str_tmp?#?" . $this->Ini->path_imag_temp . "?@?str_prod?#?" . $this->Ini->path_prod . "?@?str_btn?#?" . $this->Ini->Str_btn_css . "?@?str_lang?#?" . $this->Ini->str_lang . "?@?str_schema?#?"  . $this->Ini->str_schema_all . "?@?script_case_init?#?" . $this->Ini->sc_page . "?@?jspath?#?" . $this->Ini->path_js . "?#?";
      $Md5_pdf    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_agenda_cliente@SC_par@" . md5($prep_parm_pdf);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['Md5_pdf'][md5($prep_parm_pdf)] = $prep_parm_pdf;
      $nm_saida->saida("      document.Fres_pdf.sc_tp_pdf.value = z;\r\n");
      $nm_saida->saida("      document.Fres_pdf.nmgp_tipo_pdf.value = z;\r\n");
      $nm_saida->saida("      document.Fres_pdf.sc_parms_pdf.value = p;\r\n");
      $nm_saida->saida("      document.Fres_pdf.nmgp_parms_pdf.value = p;\r\n");
      $nm_saida->saida("      document.Fres_pdf.chart_level.value = chart_level;\r\n");
      $nm_saida->saida("      document.Fres_pdf.sc_create_charts.value = crt;\r\n");
      $nm_saida->saida("      document.Fres_pdf.sc_graf_pdf.value = g;\r\n");
      $nm_saida->saida("      document.Fres_pdf.nmgp_graf_pdf.value = g;\r\n");
      $nm_saida->saida("      document.Fres_pdf.SC_module_export.value = SC_module_export;\r\n");
      $nm_saida->saida("      document.Fres_pdf.use_pass_pdf.value = use_pass_pdf;\r\n");
      $nm_saida->saida("      document.Fres_pdf.pdf_all_cab.value = pdf_all_cab;\r\n");
      $nm_saida->saida("      document.Fres_pdf.pdf_all_label.value = pdf_all_label;\r\n");
      $nm_saida->saida("      document.Fres_pdf.pdf_label_group.value = pdf_label_group;\r\n");
      $nm_saida->saida("      document.Fres_pdf.pdf_zip.value = pdf_zip;\r\n");
      $nm_saida->saida("  if (\"pdf_res\" == x)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      if (\"R\" == ajax)\r\n");
      $nm_saida->saida("      {\r\n");
      $nm_saida->saida("          $('#TB_window').remove();\r\n");
      $nm_saida->saida("          $('body').append(\"<div id='TB_window'></div>\");\r\n");
      $nm_saida->saida("          nm_submit_modal(\"" . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=pdf_res&sAdd=__E__nmgp_tipo_pdf=\" + z + \"__E__sc_parms_pdf=\" + p + \"__E__sc_create_charts=\" + crt + \"__E__sc_graf_pdf=\" + g + \"__E__chart_level=\" + chart_level + \"__E__SC_module_export=\" + SC_module_export + \"__E__use_pass_pdf=\" + use_pass_pdf + \"__E__pdf_all_cab=\" + pdf_all_cab + \"__E__pdf_all_label=\" +  pdf_all_label + \"__E__pdf_label_group=\" +  pdf_label_group + \"__E__pdf_zip=\" +  pdf_zip + \"&nm_opc=pdf&KeepThis=true&TB_iframe=true&modal=true\", '');\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      else\r\n");
      $nm_saida->saida("      {\r\n");
      $nm_saida->saida("          document.Fres_pdf.nmgp_parms.value = \"" . $Md5_pdf . "\" ;\r\n");
      $nm_saida->saida("          document.Fres_pdf.action = \"grid_agenda_cliente_iframe.php\";\r\n");
      $nm_saida->saida("          document.Fres_pdf.submit();\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  else\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      document.F3.submit();\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida(" function nm_gp_submit5(apl_lig, apl_saida, parms, target, opc, modal_h, modal_w) \r\n");
      $nm_saida->saida(" { \r\n");
      $nm_saida->saida("    if (apl_lig.substr(0, 7) == \"http://\" || apl_lig.substr(0, 8) == \"https://\")\r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        if (target == '_blank') \r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            window.open (apl_lig);\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        else\r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            window.location = apl_lig;\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        return;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    if (target == 'modal') \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        par_modal = '?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&nmgp_outra_jan=true&nmgp_url_saida=modal';\r\n");
      $nm_saida->saida("        if (opc != null && opc != '') \r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            par_modal += '&nmgp_opcao=grid';\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        if (parms != null && parms != '') \r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            par_modal += '&nmgp_parms=' + parms;\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        tb_show('', apl_lig + par_modal + '&TB_iframe=true&modal=true&height=' + modal_h + '&width=' + modal_w, '');\r\n");
      $nm_saida->saida("        return;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.F3.target               = target; \r\n");
      $nm_saida->saida("    if (target == '_blank') \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.F3.action               = apl_lig  ;\r\n");
      $nm_saida->saida("    if (opc != null && opc != '') \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.F3.nmgp_opcao.value = \"grid\" ;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    else\r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.F3.nmgp_opcao.value = \"\" ;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.F3.nmgp_url_saida.value = apl_saida ;\r\n");
      $nm_saida->saida("    document.F3.nmgp_parms.value = parms ;\r\n");
      $nm_saida->saida("    document.F3.submit() ;\r\n");
      $nm_saida->saida("    document.F3.nmgp_outra_jan.value = \"\";\r\n");
      $nm_saida->saida("    document.F3.nmgp_parms.value = \"\";\r\n");
      $nm_saida->saida("    document.F3.action = \"./\";\r\n");
      $nm_saida->saida(" } \r\n");
      $nm_saida->saida("   var tem_hint;\r\n");
      $nm_saida->saida("   function nm_mostra_hint(nm_obj, nm_evt, nm_mens)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (nm_mens == \"\")\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           return;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       tem_hint = true;\r\n");
      $nm_saida->saida("       if (document.layers)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           theString=\"<DIV CLASS='ttip'>\" + nm_mens + \"</DIV>\";\r\n");
      $nm_saida->saida("           document.tooltip.document.write(theString);\r\n");
      $nm_saida->saida("           document.tooltip.document.close();\r\n");
      $nm_saida->saida("           document.tooltip.left = nm_evt.pageX + 14;\r\n");
      $nm_saida->saida("           document.tooltip.top = nm_evt.pageY + 2;\r\n");
      $nm_saida->saida("           document.tooltip.visibility = \"show\";\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           if(document.getElementById)\r\n");
      $nm_saida->saida("           {\r\n");
      $nm_saida->saida("              nmdg_nav = navigator.appName;\r\n");
      $nm_saida->saida("              elm = document.getElementById(\"tooltip\");\r\n");
      $nm_saida->saida("              elml = nm_obj;\r\n");
      $nm_saida->saida("              elm.innerHTML = nm_mens;\r\n");
      $nm_saida->saida("              if (nmdg_nav == \"Netscape\")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  elm.style.height = elml.style.height;\r\n");
      $nm_saida->saida("                  elm.style.top = nm_evt.pageY + 2;\r\n");
      $nm_saida->saida("                  elm.style.left = nm_evt.pageX + 14;\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              else\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  elm.style.top = nm_evt.y + document.body.scrollTop + 10;\r\n");
      $nm_saida->saida("                  elm.style.left = nm_evt.x + document.body.scrollLeft + 10;\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              elm.style.visibility = \"visible\";\r\n");
      $nm_saida->saida("           }\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("   function nm_apaga_hint()\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (!tem_hint)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           return;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       tem_hint = false;\r\n");
      $nm_saida->saida("       if (document.layers)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           document.tooltip.visibility = \"hidden\";\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           if(document.getElementById)\r\n");
      $nm_saida->saida("           {\r\n");
      $nm_saida->saida("              elm.style.visibility = \"hidden\";\r\n");
      $nm_saida->saida("           }\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida(" function nm_graf_submit(campo, nivel, campo_val, parms, target) \r\n");
      $nm_saida->saida(" { \r\n");
      $nm_saida->saida("    document.Fgraf.campo.value = campo ;\r\n");
      $nm_saida->saida("    document.Fgraf.nivel_quebra.value = nivel ;\r\n");
      $nm_saida->saida("    document.Fgraf.campo_val.value = campo_val ;\r\n");
      $nm_saida->saida("    document.Fgraf.nmgp_parms.value = parms ;\r\n");
      $nm_saida->saida("    document.Fgraf.summary_chart.value = 'N';\r\n");
      $nm_saida->saida("    if (target != null) \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.Fgraf.target = target; \r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.Fgraf.submit() ;\r\n");
      $nm_saida->saida(" } \r\n");
      $nm_saida->saida(" function nm_graf_submit_2(chart)\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("    var oldAction = document.Fgraf.action;\r\n");
      $nm_saida->saida("    document.Fgraf.action = nm_url_rand(document.Fgraf.action);\r\n");
      $nm_saida->saida("    document.Fgraf.nmgp_parms.value = chart;\r\n");
      $nm_saida->saida("    document.Fgraf.summary_chart.value = 'N';\r\n");
      $nm_saida->saida("    document.Fgraf.target = \"_blank\";\r\n");
      $nm_saida->saida("    document.Fgraf.submit();\r\n");
      $nm_saida->saida("    document.Fgraf.action = oldAction;\r\n");
      $nm_saida->saida(" } \r\n");
      $nm_saida->saida(" function Refresh_Chart()\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("     document.FRES.action = \"./\";\r\n");
      $nm_saida->saida("     document.FRES.submit();\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida(" function nm_open_popup(parms)\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("     NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida(" function nm_url_rand(v_str_url)\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("  str_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';\r\n");
      $nm_saida->saida("  str_rand  = v_str_url;\r\n");
      $nm_saida->saida("  str_rand += (-1 == v_str_url.indexOf('?')) ? '?' : '&';\r\n");
      $nm_saida->saida("  str_rand += 'r=';\r\n");
      $nm_saida->saida("  for (i = 0; i < 8; i++)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("   str_rand += str_chars.charAt(Math.round(str_chars.length * Math.random()));\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  return str_rand;\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida("   function process_hotkeys(hotkey)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_pdf') { \r\n");
      $nm_saida->saida("         var output =  $('#Rpdf_top').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_word') { \r\n");
      $nm_saida->saida("         var output =  $('#Rword_top').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_xls') { \r\n");
      $nm_saida->saida("         var output =  $('#Rxls_top').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_xml') { \r\n");
      $nm_saida->saida("         var output =  $('#Rxml_top').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_csv') { \r\n");
      $nm_saida->saida("         var output =  $('#Rcsv_top').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_rtf') { \r\n");
      $nm_saida->saida("         var output =  $('#Rrtf_top').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_imp') { \r\n");
      $nm_saida->saida("         var output =  $('#Rprint_top').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_gbrl') { \r\n");
      $nm_saida->saida("         var output =  $('#sel_groupby_top').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_cons') { \r\n");
      $nm_saida->saida("         var output =  $('#Rrotac_top').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_webh') { \r\n");
      $nm_saida->saida("         var output =  $('#Rhelp_bot').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_sai') { \r\n");
      $nm_saida->saida("         var output =  $('#Rsai_top').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("   return false;\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("</SCRIPT>\r\n");
      $nm_saida->saida("</BODY>\r\n");
      $nm_saida->saida("</HTML>\r\n");
   }

   function monta_html_ini_pdf()
   {
      global $nm_saida;
       $tp_quebra = "";
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['num_css']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['num_css']))
       {
           $NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_grid_agenda_cliente_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['num_css'] . '.css', 'a');
           $NM_css_file = $this->Ini->root . $this->Ini->path_link . "grid_agenda_cliente/grid_agenda_cliente_res_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']). ".css";
           if (is_file($NM_css_file))
           {
               $NM_css_attr = file($NM_css_file);
               foreach ($NM_css_attr as $NM_line_css)
               {
                   @fwrite($NM_css, "    " . $NM_line_css . "\r\n");
               }
           }
           @fclose($NM_css);
       }
       $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['print_all'];
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pdf_res'])
       {
           $nm_saida->saida("<TR>\r\n");
           $nm_saida->saida("<TD style=\"padding: 0px\">\r\n");
       $tp_quebra = "<div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></div>";
           $tp_quebra .= "<div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" .$this->Ini->Nm_lang['lang_othr_smry_msge'] . "</H1></div>";
       }
       if ($this->Print_All || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['print_all'])
       {
       $tp_quebra = "<div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></div>";
       }
       $nm_saida->saida("" . $tp_quebra . "\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['responsive_chart']['active']) {
           $summary_width = "width=\"100%\"";
       }
       else {
           if ($_SESSION['scriptcase']['proc_mobile'])
           {
               $summary_width = "width=\"100%\"";
           }
           else
           {
               $summary_width = "width=\"100%\"";
           }
       }
       $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" align=\"center\" valign=\"top\" " . $summary_width . ">\r\n");
       $nm_saida->saida("<TR>\r\n");
       $nm_saida->saida("<TD style=\"padding: 0px\">\r\n");
       $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px; width: 100%;\">\r\n");
   }
   function monta_html_fim_pdf()
   {
      global $nm_saida;
      $nm_saida->saida("</TABLE>\r\n");
      $nm_saida->saida("</TD>\r\n");
      $nm_saida->saida("</TR>\r\n");
      $nm_saida->saida("</TABLE>\r\n");
   }
//--- 
//--- 
 function grafico_pdf()
 {
   global $nm_saida, $nm_lang;
   require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
   $this->Graf  = new grid_agenda_cliente_grafico();
   $this->Graf->Db     = $this->Db;
   $this->Graf->Erro   = $this->Erro;
   $this->Graf->Ini    = $this->Ini;
   $this->Graf->Lookup = $this->Lookup;
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_charts']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['skip_charts']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['skip_charts']))
   {
       $this->Graf->monta_grafico('', 'pdf_lib');
       $prim_graf = true;
       $nm_saida->saida("<B><div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . $this->Ini->Nm_lang['lang_btns_chrt_pdff_hint'] . "</H1></div></B>\r\n");
       $iChartCount = 1;
       $iChartTotal = sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_charts']);
       $sChartLang  = isset($this->Ini->Nm_lang['lang_pdff_pcht']) ? $this->Ini->Nm_lang['lang_pdff_pcht'] : 'Generating chart';
       if (!NM_is_utf8($sChartLang))
       {
           $sChartLang = sc_convert_encoding($sChartLang, "UTF-8", $_SESSION['scriptcase']['charset']);
       }
       $bChartFP = false;
      if (!isset($this->progress_fp) || !$this->progress_fp)
      {
           $bChartFP           = true;
           $str_pbfile         = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
           $this->progress_fp  = fopen($str_pbfile, 'a');
           $this->progress_tot = 100;
           $this->progress_now = 90;
           $this->progress_res = 0;
      }
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf_vert'])
 { 
           $nm_saida->saida(" <style>\r\n");
            $nm_saida->saida("  table td, table tr{ page-break-inside: avoid !important; }\r\n");
           $nm_saida->saida(" </style>\r\n");
 } 
       $prim_graf = ($this->Ini->SC_module_export == "chart") ? true : false;
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pivot_charts'] as $chart_index => $chart_data)
       {
           if (!$prim_graf)
           {
                   $nm_saida->saida("<div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></div>\r\n");
           }
           $prim_graf = false;
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf_vert'])
 { 
           $nm_saida->saida("<table style=\"width: 100%; page-break-inside: avoid !important;\" ><tr><td>\r\n");
 } else {
           $nm_saida->saida("<table><tr><td>\r\n");
 } 
           $tit_graf = $chart_data['title'];
           if ('' != $chart_data['subtitle'])
           {
               $tit_graf .= ' - ' . $chart_data['subtitle'];
           }
           if ('UTF-8' != $_SESSION['scriptcase']['charset'])
           {
               $tit_graf = sc_convert_encoding($tit_graf, $_SESSION['scriptcase']['charset'], 'UTF-8');
           }
           $tit_book_marks = str_replace(" ", "&nbsp;", $tit_graf);
           $random_id = 'sc-id-h2-' . md5(session_id() . microtime() . rand(1, 1000));
           $nm_saida->saida("<b><h2 id=\"$random_id\">$tit_book_marks</h2></b>\r\n");
           if ($this->progress_fp)
           {
               grid_agenda_cliente_pdf_progress_call($this->progress_tot . "_#NM#_" . $this->progress_now . "_#NM#_" . $sChartLang . " " . $iChartCount . "...\n", $this->Ini->Nm_lang, true);
               fwrite($this->progress_fp, $this->progress_now . "_#NM#_" . $sChartLang . " " . $iChartCount . "...\n");
               $iChartCount++;
               if (0 < $this->progress_res)
               {
                   $this->progress_now++;
               }
           }
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['this_chart_label'] = '';
           $this->Graf->monta_grafico($chart_index, 'pdf');
           $nm_saida->saida("</td></tr></table>\r\n");
       }
       if ($bChartFP)
       {
           $lang_protect = $this->Ini->Nm_lang['lang_pdff_gnrt'];
           if (!NM_is_utf8($lang_protect))
           {
               $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
           }
           grid_agenda_cliente_pdf_progress_call(100 . "_#NM#_" . 90 . "_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
           fwrite($this->progress_fp, 90 . "_#NM#_" . $lang_protect . "...\n");
           fclose($this->progress_fp);
       }
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['charts_html']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['charts_html'])
       {
            $nm_saida->saida("<script type=\"text/javascript\">\r\n");
            $nm_saida->saida("{$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['charts_html']}\r\n");
            $nm_saida->saida("</script>\r\n");
       }
   }
       $nm_saida->saida("</body>\r\n");
       $nm_saida->saida("</HTML>\r\n");
 }
//--- 
//--- 
 function grafico_pdf_flash()
 {
   global $nm_saida, $nm_lang;
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['chart_list']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['chart_list'] as $arr_chart)
       {
           $nm_saida->saida("<div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></div>\r\n");
       $nm_saida->saida("<b><div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . $this->Ini->Nm_lang['lang_btns_chrt_pdff_hint'] . "</H1></div></b>\r\n");
           $nm_saida->saida("<table><tr><td>\r\n");
           $tit_graf       = $arr_chart[1];
           if ('UTF-8' != $_SESSION['scriptcase']['charset'])
           {
               $tit_graf = sc_convert_encoding($tit_graf, $_SESSION['scriptcase']['charset'], 'UTF-8');
           }
           $tit_book_marks = str_replace(" ", "&nbsp;", $tit_graf);
           $nm_saida->saida("<b><h2>$tit_book_marks</h2></b>\r\n");
           $nm_saida->saida("<img src='" . $arr_chart[0] . ".png'/>\r\n");
           $_SESSION['scriptcase']['sc_num_img']++;
           $nm_saida->saida("</td></tr></table>\r\n");
       }
   }
   $nm_saida->saida("</body>\r\n");
   $nm_saida->saida("</HTML>\r\n");
 }
//--- 
	function getHeaderColspan() {
		return $this->getHeaderColspan_index() + $this->getHeaderColspan_labels() + $this->getHeaderColspan_summarizing() + $this->getHeaderColspan_lineTotal();
	} // getHeaderColspan

	function getHeaderColspan_index() {
		return $this->comp_tab_seq ? 1 : 0;
	} // getHeaderColspan_index

	function getHeaderColspan_labels() {
		return $this->comp_tabular ? count($this->comp_y_axys) : 1;
	} // getHeaderColspan_labels

	function getHeaderColspan_summarizing() {
		return $this->build_col_count;
	} // getHeaderColspan_summarizing

	function getHeaderColspan_summarizing_fields() {
		$total = 0;

		foreach ($this->comp_sum_display as $displayFlag) {
			if ($displayFlag) {
				$total++;
			}
		}

		return $total;
	} // getHeaderColspan_summarizing_fields

	function getHeaderColspan_lineTotal() {
             if (substr($this->Ini->PHP_ver, 0, 2) > 72) {
		return (isset($this->comp_x_axys) && is_countable($this->comp_x_axys) && count($this->comp_x_axys)) ? $this->getHeaderColspan_summarizing_fields() : 0;
             }
             else {
		return (isset($this->comp_x_axys) && is_array($this->comp_x_axys) && count($this->comp_x_axys)) ? $this->getHeaderColspan_summarizing_fields() : 0;
             }
	} // getHeaderColspan_lineTotal

   //----- 
   function monta_cabecalho()
   {
      global $nm_saida;
      if ($this->Ini->Embutida_iframe || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['dashboard_info']['compact_mode'])
      { 
          return;
      } 
      $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS");
      $nm_cab_filtro   = ""; 
      $nm_cab_filtrobr = ""; 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['campos_busca']))
      { 
        $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['campos_busca'];
        if ($_SESSION['scriptcase']['charset'] != "UTF-8")
        {
            $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
          $id_tecnico = (isset($Busca_temp['id_tecnico'])) ? $Busca_temp['id_tecnico'] : ""; 
          $tmp_pos = (is_string($id_tecnico)) ? strpos($id_tecnico, "##@@") : false;
          if ($tmp_pos !== false && !is_array($id_tecnico))
          {
              $id_tecnico = substr($id_tecnico, 0, $tmp_pos);
          }
          $valor_total = (isset($Busca_temp['valor_total'])) ? $Busca_temp['valor_total'] : ""; 
          $tmp_pos = (is_string($valor_total)) ? strpos($valor_total, "##@@") : false;
          if ($tmp_pos !== false && !is_array($valor_total))
          {
              $valor_total = substr($valor_total, 0, $tmp_pos);
          }
          $fecha_final = (isset($Busca_temp['fecha_final'])) ? $Busca_temp['fecha_final'] : ""; 
          $tmp_pos = (is_string($fecha_final)) ? strpos($fecha_final, "##@@") : false;
          if ($tmp_pos !== false && !is_array($fecha_final))
          {
              $fecha_final = substr($fecha_final, 0, $tmp_pos);
          }
          $fecha_final_2 = (isset($Busca_temp['fecha_final_input_2'])) ? $Busca_temp['fecha_final_input_2'] : ""; 
          $estado_actual = (isset($Busca_temp['estado_actual'])) ? $Busca_temp['estado_actual'] : ""; 
          $tmp_pos = (is_string($estado_actual)) ? strpos($estado_actual, "##@@") : false;
          if ($tmp_pos !== false && !is_array($estado_actual))
          {
              $estado_actual = substr($estado_actual, 0, $tmp_pos);
          }
      } 
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['cond_pesq']))
      {  
          $pos       = 0;
          $trab_pos  = false;
          $pos_tmp   = true; 
          $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['cond_pesq'];
          while ($pos_tmp)
          {
             $pos = strpos($tmp, "##*@@", $pos);
             if ($pos !== false)
             {
                 $trab_pos = $pos;
                 $pos += 4;
             }
             else
             {
                 $pos_tmp = false;
             }
          }
          $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
          $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
          $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['cond_pesq'], 0, $trab_pos);
          $nm_cab_filtrobr = str_replace("##*@@", ", " . $nm_cond_filtro_or . "<br />", $nm_cab_filtro);
          $pos       = 0;
          $trab_pos  = false;
          $pos_tmp   = true; 
          $tmp       = $nm_cab_filtro;
          while ($pos_tmp)
          {
             $pos = strpos($tmp, "##*@@", $pos);
             if ($pos !== false)
             {
                 $trab_pos = $pos;
                 $pos += 4;
             }
             else
             {
                 $pos_tmp = false;
             }
          }
          if ($trab_pos === false)
          {
          }
          else  
          {  
             $nm_cab_filtro = substr($nm_cab_filtro, 0, $trab_pos) . " " .  $nm_cond_filtro_or . $nm_cond_filtro_and . substr($nm_cab_filtro, $trab_pos + 5);
             $nm_cab_filtro = str_replace("##*@@", ", " . $nm_cond_filtro_or, $nm_cab_filtro);
          }   
      }   
      $nm_saida->saida(" <TR align=\"center\">\r\n");
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['proc_pdf_vert']) {
          $header_colspan = $this->getHeaderColspan();
          $nm_saida->saida("  <TD colspan=\"" . $header_colspan . "\" class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\">\r\n");
     }
     else {
          $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\">\r\n");
     }
      $nm_saida->saida("<style>\r\n");
      $nm_saida->saida("    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}\r\n");
      $nm_saida->saida("</style>\r\n");
      $nm_saida->saida("<div class=\"" . $this->css_scGridHeader . "\" style=\"height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;\">\r\n");
      $nm_saida->saida("    <div class=\"" . $this->css_scGridHeaderFont . "\" style=\"float: left; text-transform: uppercase;\">" . $this->Ini->Nm_lang['lang_othr_smry_title'] . " " . $this->Ini->Nm_lang['lang_tbl_agenda'] . "</div>\r\n");
      $nm_saida->saida("    <div class=\"" . $this->css_scGridHeaderFont . "\" style=\"float: right;\">" . date("d/m/Y") . "</div>\r\n");
      $nm_saida->saida("</div>\r\n");
      $nm_saida->saida("  </TD>\r\n");
      $nm_saida->saida(" </TR>\r\n");
   }


   //---- 
   function inicializa_arrays()
   {
      $this->array_total_fecha_inicial = array();
      $this->array_total_fecha_inicial_scgb_41 = array();
   }

   //---- 
   function adiciona_registro($sum_valor_total, $cnt_estado_actual, $quebra_fecha_inicial, $quebra_fecha_inicial_scgb_41, $quebra_fecha_inicial_orig, $quebra_fecha_inicial_scgb_41_orig)
   {
      //----- " . $this->Ini->Nm_lang['lang_othr_cons_title_YYYY'] . "
      if (!isset($this->array_total_fecha_inicial[$quebra_fecha_inicial_orig]))
      {
         $this->array_total_fecha_inicial[$quebra_fecha_inicial_orig][0] = 1;
         $this->array_total_fecha_inicial[$quebra_fecha_inicial_orig][1] = $sum_valor_total;
         $this->array_total_fecha_inicial[$quebra_fecha_inicial_orig][2] = 1;
         $this->array_total_fecha_inicial[$quebra_fecha_inicial_orig][3] = $quebra_fecha_inicial;
         $this->array_total_fecha_inicial[$quebra_fecha_inicial_orig][4] = $quebra_fecha_inicial_orig;
      }
      else
      {
         $this->array_total_fecha_inicial[$quebra_fecha_inicial_orig][0]++;
         $this->array_total_fecha_inicial[$quebra_fecha_inicial_orig][1] = bcadd($this->array_total_fecha_inicial[$quebra_fecha_inicial_orig][1], $sum_valor_total, 10);
         $this->array_total_fecha_inicial[$quebra_fecha_inicial_orig][2] ++;
      }
      //----- " . $this->Ini->Nm_lang['lang_othr_cons_title_SEMIANNUAL'] . "
      if (!isset($this->array_total_fecha_inicial_scgb_41[$quebra_fecha_inicial_orig][$quebra_fecha_inicial_scgb_41_orig]))
      {
         $this->array_total_fecha_inicial_scgb_41[$quebra_fecha_inicial_orig][$quebra_fecha_inicial_scgb_41_orig][0] = 1;
         $this->array_total_fecha_inicial_scgb_41[$quebra_fecha_inicial_orig][$quebra_fecha_inicial_scgb_41_orig][1] = $sum_valor_total;
         $this->array_total_fecha_inicial_scgb_41[$quebra_fecha_inicial_orig][$quebra_fecha_inicial_scgb_41_orig][2] = 1;
         $this->array_total_fecha_inicial_scgb_41[$quebra_fecha_inicial_orig][$quebra_fecha_inicial_scgb_41_orig][3] = $quebra_fecha_inicial_scgb_41;
         $this->array_total_fecha_inicial_scgb_41[$quebra_fecha_inicial_orig][$quebra_fecha_inicial_scgb_41_orig][4] = $quebra_fecha_inicial_scgb_41_orig;
      }
      else
      {
         $this->array_total_fecha_inicial_scgb_41[$quebra_fecha_inicial_orig][$quebra_fecha_inicial_scgb_41_orig][0]++;
         $this->array_total_fecha_inicial_scgb_41[$quebra_fecha_inicial_orig][$quebra_fecha_inicial_scgb_41_orig][1] = bcadd($this->array_total_fecha_inicial_scgb_41[$quebra_fecha_inicial_orig][$quebra_fecha_inicial_scgb_41_orig][1], $sum_valor_total, 10);
         $this->array_total_fecha_inicial_scgb_41[$quebra_fecha_inicial_orig][$quebra_fecha_inicial_scgb_41_orig][2] ++;
      }
   }

   //---- 
   function completa_arrays()
   {
      if (isset($this->array_total_fecha_inicial))
      {
         $arr_temp_0 = $this->array_total_fecha_inicial;
         foreach ($this->array_total_fecha_inicial as $campo_fecha_inicial => $dados_fecha_inicial)
         {
            $ind_exists  = "";
            $ind_missing = "";
            if (!isset($this->array_total_fecha_inicial[$campo_fecha_inicial][1])) {
                $ind_exists  = 2;
                $ind_missing = 1;
            }
            if (!isset($this->array_total_fecha_inicial[$campo_fecha_inicial][2])) {
                $ind_exists  = 1;
                $ind_missing = 2;
            }
            if (!empty($ind_missing)) {
                $arr_temp_0[$campo_fecha_inicial][$ind_missing][0] = 0;
                $arr_temp_0[$campo_fecha_inicial][$ind_missing][1] = 0;
                $arr_temp_0[$campo_fecha_inicial][$ind_missing][2] = 0;
                $arr_temp_0[$campo_fecha_inicial][$ind_missing][3] = $dados_fecha_inicial[$ind_exists][3];
                $arr_temp_0[$campo_fecha_inicial][$ind_missing][4] = $dados_fecha_inicial[$ind_exists][4];
            }
            ksort($arr_temp_0[$campo_fecha_inicial]);
            $this->array_total_fecha_inicial[$campo_fecha_inicial] = $arr_temp_0[$campo_fecha_inicial];
            if (isset($this->array_total_fecha_inicial_scgb_41[$campo_fecha_inicial]))
            {
               $arr_temp_1 = $this->array_total_fecha_inicial_scgb_41[$campo_fecha_inicial];
               foreach ($this->array_total_fecha_inicial_scgb_41[$campo_fecha_inicial] as $campo_fecha_inicial_scgb_41 => $dados_fecha_inicial_scgb_41)
               {
                  $ind_exists  = "";
                  $ind_missing = "";
                  if (!isset($this->array_total_fecha_inicial_scgb_41[$campo_fecha_inicial][$campo_fecha_inicial_scgb_41][1])) {
                      $ind_exists  = 2;
                      $ind_missing = 1;
                  }
                  if (!isset($this->array_total_fecha_inicial_scgb_41[$campo_fecha_inicial][$campo_fecha_inicial_scgb_41][2])) {
                      $ind_exists  = 1;
                      $ind_missing = 2;
                  }
                  if (!empty($ind_missing)) {
                      $arr_temp_1[$campo_fecha_inicial_scgb_41][$ind_missing][0] = 0;
                      $arr_temp_1[$campo_fecha_inicial_scgb_41][$ind_missing][1] = 0;
                      $arr_temp_1[$campo_fecha_inicial_scgb_41][$ind_missing][2] = 0;
                      $arr_temp_1[$campo_fecha_inicial_scgb_41][$ind_missing][3] = $dados_fecha_inicial_scgb_41[$ind_exists][3];
                      $arr_temp_1[$campo_fecha_inicial_scgb_41][$ind_missing][4] = $dados_fecha_inicial_scgb_41[$ind_exists][4];
                  }
                  ksort($arr_temp_1[$campo_fecha_inicial_scgb_41]);
                  $this->array_total_fecha_inicial_scgb_41[$campo_fecha_inicial][$campo_fecha_inicial_scgb_41] = $arr_temp_1[$campo_fecha_inicial_scgb_41];
               } 
            } 
         } 
      } 
   }
   function finaliza_arrays($ind_compara=1)
   {
   }

   function prepara_resumo()
   {
      $this->inicializa_vars();
      $this->resumo_init();
      $this->inicializa_arrays();
   }

   function finaliza_resumo()
   {
      $this->finaliza_arrays();
   }

//
   function nm_acumula_resumo($nm_tipo="resumo")
   {
     global $nm_lang;
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['campos_busca']))
     { 
         $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['campos_busca'];
         if ($_SESSION['scriptcase']['charset'] != "UTF-8")
         {
             $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
       $this->id_tecnico = $Busca_temp['id_tecnico']; 
       $this->id_tecnico = (isset($Busca_temp['id_tecnico'])) ? $Busca_temp['id_tecnico'] : ""; 
       $tmp_pos = (is_string($this->id_tecnico)) ? strpos($this->id_tecnico, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->id_tecnico))
       {
           $this->id_tecnico = substr($this->id_tecnico, 0, $tmp_pos);
       }
       $this->valor_total = $Busca_temp['valor_total']; 
       $this->valor_total = (isset($Busca_temp['valor_total'])) ? $Busca_temp['valor_total'] : ""; 
       $tmp_pos = (is_string($this->valor_total)) ? strpos($this->valor_total, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->valor_total))
       {
           $this->valor_total = substr($this->valor_total, 0, $tmp_pos);
       }
       $this->fecha_final = $Busca_temp['fecha_final']; 
       $this->fecha_final = (isset($Busca_temp['fecha_final'])) ? $Busca_temp['fecha_final'] : ""; 
       $tmp_pos = (is_string($this->fecha_final)) ? strpos($this->fecha_final, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->fecha_final))
       {
           $this->fecha_final = substr($this->fecha_final, 0, $tmp_pos);
       }
       $fecha_final_2 = (isset($Busca_temp['fecha_final_input_2'])) ? $Busca_temp['fecha_final_input_2'] : ""; 
       $this->fecha_final_2 = $fecha_final_2; 
       $this->estado_actual = $Busca_temp['estado_actual']; 
       $this->estado_actual = (isset($Busca_temp['estado_actual'])) ? $Busca_temp['estado_actual'] : ""; 
       $tmp_pos = (is_string($this->estado_actual)) ? strpos($this->estado_actual, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->estado_actual))
       {
           $this->estado_actual = substr($this->estado_actual, 0, $tmp_pos);
       }
     } 
     $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_orig'];
     $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq'];
     $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq_filtro'];
     $this->nm_field_dinamico = array();
     $this->nm_order_dinamico = array();
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ""; 
     if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
     { 
         $nmgp_select = "SELECT id_agenda, id_tecnico, valor_total, str_replace (convert(char(10),fecha_inicial,102), '.', '-') + ' ' + convert(char(8),fecha_inicial,20), str_replace (convert(char(10),hora_inicial,102), '.', '-') + ' ' + convert(char(8),hora_inicial,20), estado_actual, evaluacion, id_cliente, valor, costes_adicionales, descuento from " . $this->Ini->nm_tabela; 
     } 
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
     { 
         $nmgp_select = "SELECT id_agenda, id_tecnico, valor_total, fecha_inicial, hora_inicial, estado_actual, evaluacion, id_cliente, valor, costes_adicionales, descuento from " . $this->Ini->nm_tabela; 
     } 
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     { 
         $nmgp_select = "SELECT id_agenda, id_tecnico, valor_total, convert(char(23),fecha_inicial,121), convert(char(23),hora_inicial,121), estado_actual, evaluacion, id_cliente, valor, costes_adicionales, descuento from " . $this->Ini->nm_tabela; 
     } 
     else 
     { 
         $nmgp_select = "SELECT id_agenda, id_tecnico, valor_total, fecha_inicial, hora_inicial, estado_actual, evaluacion, id_cliente, valor, costes_adicionales, descuento from " . $this->Ini->nm_tabela; 
     } 
     $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['where_pesq']; 
     $campos_order = "";
     $format       = $this->Ini->Get_Gb_date_format('ag_estado', 'fecha_inicial');
     $campos_order = $this->Ini->Get_date_order_groupby("fecha_inicial", 'asc', $format, $campos_order);
     $format       = $this->Ini->Get_Gb_date_format('ag_estado', 'fecha_inicial_scgb_41');
     $campos_order = $this->Ini->Get_date_order_groupby("fecha_inicial", 'asc', $format, $campos_order);
     $nmgp_order_by = (!empty($campos_order)) ? " order by " . $campos_order : "";
     $nmgp_select .= $nmgp_order_by; 
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
     $rs_res = $this->Db->Execute($nmgp_select) ; 
     if ($rs_res === false && !$rs_graf->EOF) 
     { 
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
// 
     if ($nm_tipo != "resumo") 
     {  
          $this->nm_acum_res_unit($rs_res, $nm_tipo);
     }  
     else  
     {  
         while (!$rs_res->EOF) 
         {  
                $this->nm_acum_res_unit($rs_res, "resumo");
                $rs_res->MoveNext();
         }  
     }  
     $rs_res->Close();
   }
// 
   function nm_acum_res_unit($rs_res, $nm_tipo="resumo")
   {
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['campos_busca']))
            { 
                $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['campos_busca'];
                if ($_SESSION['scriptcase']['charset'] != "UTF-8")
                {
                    $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
                }
                $this->id_tecnico = (isset($Busca_temp['id_tecnico'])) ? $Busca_temp['id_tecnico'] : ""; 
                $tmp_pos = (is_string($this->id_tecnico)) ? strpos($this->id_tecnico, "##@@") : false;
                if ($tmp_pos !== false && !is_array($this->id_tecnico))
                {
                   $this->id_tecnico = substr($this->id_tecnico, 0, $tmp_pos);
                }
                $this->valor_total = (isset($Busca_temp['valor_total'])) ? $Busca_temp['valor_total'] : ""; 
                $tmp_pos = (is_string($this->valor_total)) ? strpos($this->valor_total, "##@@") : false;
                if ($tmp_pos !== false && !is_array($this->valor_total))
                {
                   $this->valor_total = substr($this->valor_total, 0, $tmp_pos);
                }
                $this->estado_actual = (isset($Busca_temp['estado_actual'])) ? $Busca_temp['estado_actual'] : ""; 
                $tmp_pos = (is_string($this->estado_actual)) ? strpos($this->estado_actual, "##@@") : false;
                if ($tmp_pos !== false && !is_array($this->estado_actual))
                {
                   $this->estado_actual = substr($this->estado_actual, 0, $tmp_pos);
                }
            } 
            $this->id_agenda = $rs_res->fields[0] ;  
            $this->id_tecnico = $rs_res->fields[1] ;  
            $this->valor_total = $rs_res->fields[2] ;  
            $this->valor_total =  str_replace(",", ".", $this->valor_total);
            $this->fecha_inicial = $rs_res->fields[3] ;  
            $this->hora_inicial = $rs_res->fields[4] ;  
            $this->estado_actual = $rs_res->fields[5] ;  
            $this->evaluacion = $rs_res->fields[6] ;  
            $this->id_cliente = $rs_res->fields[7] ;  
            $this->valor = $rs_res->fields[8] ;  
            $this->valor =  str_replace(",", ".", $this->valor);
            $this->costes_adicionales = $rs_res->fields[9] ;  
            $this->costes_adicionales =  str_replace(",", ".", $this->costes_adicionales);
            $this->descuento = $rs_res->fields[10] ;  
            $this->descuento =  str_replace(",", ".", $this->descuento);
            $this->fecha_inicial_scgb_19 = $this->fecha_inicial;
            $this->fecha_inicial_scgb_41 = $this->fecha_inicial;
            $this->look_id_tecnico = $this->id_tecnico; 
            $this->Lookup->lookup_id_tecnico($this->look_id_tecnico, $this->id_tecnico) ; 
            $this->look_estado_actual = $this->estado_actual; 
            $this->Lookup->lookup_estado_actual($this->look_estado_actual, $this->estado_actual) ; 
            $Format_tst = $this->Ini->Get_Gb_date_format('ag_estado', 'fecha_inicial');
            $Prefix_dat = $this->Ini->Get_Gb_prefix_date_format('ag_estado', 'fecha_inicial');
            $TP_Time    = (in_array('fecha_inicial', $this->Ini->Cmp_Sql_Time)) ? "0000-00-00 " : "";
            $this->fecha_inicial_orig = $this->Ini->Get_arg_groupby($TP_Time . $this->fecha_inicial, $Format_tst);
            $this->fecha_inicial = $this->Ini->GB_date_format($TP_Time . $this->fecha_inicial, $Format_tst, $Prefix_dat);
            $Format_tst = $this->Ini->Get_Gb_date_format('ag_estado', 'fecha_inicial_scgb_41');
            $Prefix_dat = $this->Ini->Get_Gb_prefix_date_format('ag_estado', 'fecha_inicial_scgb_41');
            $TP_Time    = (in_array('fecha_inicial_scgb_41', $this->Ini->Cmp_Sql_Time)) ? "0000-00-00 " : "";
            $this->fecha_inicial_scgb_41_orig = $this->Ini->Get_arg_groupby($TP_Time . $this->fecha_inicial_scgb_41, $Format_tst);
            $this->fecha_inicial_scgb_41 = $this->Ini->GB_date_format($TP_Time . $this->fecha_inicial_scgb_41, $Format_tst, $Prefix_dat);
            $this->id_tecnico = $this->look_id_tecnico ;
            $this->estado_actual = $this->look_estado_actual ;
            if ($nm_tipo == "resumo")
            {
                $this->adiciona_registro($this->valor_total, $this->estado_actual, $this->fecha_inicial, $this->fecha_inicial_scgb_41, $this->fecha_inicial_orig,  $this->fecha_inicial_scgb_41_orig);
            }
   }
//
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
   function html_grid_search()
   {
       global $nm_saida;
       $this->grid_search_seq = 0;
       $this->grid_search_str = "";
       $this->grid_search_dat = array();
       $this->grid_search_str = "";
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'])
        { 
           $_SESSION['scriptcase']['saida_html'] = "";
        } 
       $this->NM_case_insensitive = false;
       $tmp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['cond_pesq'];
       $pos = strrpos($tmp, "##*@@");
       if ($pos !== false)
       {
           $and_or = (substr($tmp, ($pos + 5)) == "and") ? $this->Ini->Nm_lang['lang_srch_and_cond'] : $this->Ini->Nm_lang['lang_srch_orr_cond'];
           $tmp    = substr($tmp, 0, $pos);
           $this->grid_search_str = str_replace("##*@@", ", " . $and_or . " ", $tmp);
       }
       $str_display = empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_pesq'])?'none':'';
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'])
       {
          $nm_saida->saida("   <tr id=\"NM_Grid_Search\" ajax='' style='display:" . $str_display . "'>\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'] && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_pesq']))
       { 
           $_SESSION['scriptcase']['saida_html'] = "";
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_pesq'] as $cmp => $def)
           {
               $this->Ini->Arr_result['setValue'][] = array('field' => 'grid_search_label_' . $cmp, 'value' => NM_charset_to_utf8(trim($def['descr'])));
               $this->Ini->Arr_result['setTitle'][] = array('field' => 'grid_search_label_' . $cmp, 'value' => NM_charset_to_utf8(trim($def['hint'])));
           }
           $lin_obj = $this->grid_search_add_tag();
           $this->Ini->Arr_result['setValue'][] = array('field' => 'id_grid_search_add_tag', 'value' => NM_charset_to_utf8($lin_obj));
           $this->Ini->Arr_result['setValue'][] = array('field' => 'id_grid_search_cmd_str', 'value' => NM_charset_to_utf8($this->grid_search_str));
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['save_grid']))
           {
               return;
           }
           else
           {
               $this->Ini->Arr_result['setDisplay'][] = array('field' => 'NM_Grid_Search', 'value' => '');
           }
       } 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['save_grid']))
           {
               $str_display = empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_pesq']) ? 'none' : '';
               $this->Ini->Arr_result['setDisplay'][] = array('field' => 'NM_Grid_Search', 'value' => $str_display);
           }
       $nm_saida->saida("   <td  valign=\"top\"> \r\n");
       $nm_saida->saida("   <div id='id_grid_search_cmd_string' class=\"" . $this->css_scAppDivMoldura . "\" style='cursor:pointer; display:none;' onclick=\"$('#id_grid_search_cmd_string').hide();$('#div_grid_search').show();\"> \r\n");
             if (is_file($this->Ini->root . $this->Ini->path_img_global . '/' . $this->Ini->App_div_tree_img_exp))
             {
       $nm_saida->saida("                             <img id='id_app_div_tree_img_exp' src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->App_div_tree_img_exp . "\" border=0 align='absmiddle' class='scGridFilterTagIconExp'>\r\n");
             }
       $nm_saida->saida("     <span class=\"" . $this->css_scAppDivHeaderText . "\">\r\n");
       $nm_saida->saida("             " . $this->Ini->Nm_lang['lang_othr_dynamicsearch_title_outside'] . "\r\n");
       $nm_saida->saida("     </span>\r\n");
       $nm_saida->saida("     <span id='id_grid_search_cmd_str' class=\"" . $this->css_scAppDivContentText . "\">" . NM_encode_input(trim($this->grid_search_str)) . "</span>\r\n");
       $nm_saida->saida("   </div> \r\n");
       $nm_saida->saida("   <div id=\"div_grid_search\" class=\"" . $this->css_scAppDivMoldura . " scGridFilterTag\" style='display:;'> \r\n");
             if (is_file($this->Ini->root . $this->Ini->path_img_global . '/' . $this->Ini->App_div_tree_img_col))
             {
       $nm_saida->saida("                             <a href=\"#\" onclick=\"$('#id_grid_search_cmd_string').show();$('#div_grid_search').hide();\" class='scGridFilterTagIconCol'><img id='id_app_div_tree_img_col' src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->App_div_tree_img_col . "\" border=0 align='absmiddle' style='vertical-align: middle; margin-right:4px;'></a>\r\n");
             }
       $nm_saida->saida("    <div id='icon_grid_search' class='scGridFilterTagIcon'><svg height='1792' viewBox='0 0 1792 1792' width='1792' xmlns='http://www.w3.org/2000/svg'><path d='M1595 295q17 41-14 70l-493 493v742q0 42-39 59-13 5-25 5-27 0-45-19l-256-256q-19-19-19-45v-486l-493-493q-31-29-14-70 17-39 59-39h1280q42 0 59 39z'/></svg></div> \r\n");
       $nm_saida->saida("    <div id=\"tags_grid_search\" class='scGridFilterTagList'> \r\n");
       $nm_saida->saida("        <form id= \"id_Fgrid_search\" name=\"Fgrid_search\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
       $nm_saida->saida("            <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
       $nm_saida->saida("            <input type=\"hidden\" name=\"nmgp_opcao\" value=\"grid_search_res\"/> \r\n");
       $nm_saida->saida("            <input type=\"hidden\" name=\"parm\" value=\"\"/> \r\n");
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_pesq']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_pesq']))
            {
                foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_pesq'] as $cmp => $def)
                {
                    if (isset($def['label'])) {
                        $this->grid_search_seq++;
                        $lin_obj = $this->grid_search_tag_ini($cmp, $def, $this->grid_search_seq);
                        $nm_saida->saida("" . $lin_obj . "\r\n");
                        if ($cmp == "id_tecnico")
                        {
                           $this->grid_search_dat[$this->grid_search_seq] = "id_tecnico";
                           $lin_obj = $this->grid_search_id_tecnico($this->grid_search_seq, 'N', $def['opc'], $def['val'], $def['label']);
                           $nm_saida->saida("" . $lin_obj . "\r\n");
                        }
                        if ($cmp == "valor_total")
                        {
                           $this->grid_search_dat[$this->grid_search_seq] = "valor_total";
                           $lin_obj = $this->grid_search_valor_total($this->grid_search_seq, 'N', $def['opc'], $def['val'], $def['label']);
                           $nm_saida->saida("" . $lin_obj . "\r\n");
                        }
                        if ($cmp == "fecha_final")
                        {
                           $this->grid_search_dat[$this->grid_search_seq] = "fecha_final";
                           $lin_obj = $this->grid_search_fecha_final($this->grid_search_seq, 'N', $def['opc'], $def['val'], $def['label']);
                           $nm_saida->saida("" . $lin_obj . "\r\n");
                        }
                        if ($cmp == "estado_actual")
                        {
                           $this->grid_search_dat[$this->grid_search_seq] = "estado_actual";
                           $lin_obj = $this->grid_search_estado_actual($this->grid_search_seq, 'N', $def['opc'], $def['val'], $def['label']);
                           $nm_saida->saida("" . $lin_obj . "\r\n");
                        }
                        $lin_obj = $this->grid_search_tag_end();
                        $nm_saida->saida("" . $lin_obj . "\r\n");
                    }
                }
            }
       $nm_saida->saida("            <div id='add_grid_search' class='scGridFilterTagAdd' onclick=\"nm_show_advancedsearch_fields();\" >\r\n");
       $nm_saida->saida("                " . $this->Ini->Nm_lang['lang_srch_addfields'] . "\r\n");
       $nm_saida->saida("                <div id='id_grid_search_add_tag' class='SC_SubMenuApp' style='position: absolute; border-collapse: collapse; z-index: 1000; display:none;'>\r\n");
       $nm_saida->saida("                    <div>\r\n");
       $lin_obj = $this->grid_search_add_tag();
       $nm_saida->saida("" . $lin_obj . "\r\n");
       $nm_saida->saida("                    </div>\r\n");
       $nm_saida->saida("                </div>\r\n");
       $nm_saida->saida("            </div>\r\n");
       $nm_saida->saida("        </form>\r\n");
       $nm_saida->saida("    </div>\r\n");
       $this->NM_fil_ant = $this->gera_array_filtros();
       $strDisplayFilter = (empty($this->NM_fil_ant))?'none':'';
       $nm_saida->saida("   <div id='save_grid_search' class='scGridFilterTagSave'>\r\n");
       $nm_saida->saida("    <form name='Fgrid_search_save'>\r\n");
       $nm_saida->saida("     <span id=\"id_NM_filters_save\" style=\"display: " . $strDisplayFilter . "\">\r\n");
       $nm_saida->saida("       <SELECT class=\"scFilterToolbar_obj\" id=\"id_sel_recup_filters\" name=\"sel_recup_filters\" onChange=\"nm_change_grid_search(this)\" size=\"1\">\r\n");
       $nm_saida->saida("           <option value=\"\"></option>\r\n");
       $Nome_filter = "";
       foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
       {
           $Select      = "";
           $Cada_filter = $Tipo_filter[2];
           if (isset($this->NM_curr_fil) && $Cada_filter == $this->NM_curr_fil)
           {
               $Select = "selected";
           }
           if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
           {
               $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
               $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
           }
           elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
           {
               $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
               $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
           }
           if ($Tipo_filter[1] != $Nome_filter)
           {
               $Nome_filter = $Tipo_filter[1];
                   $nm_saida->saida("       <option value=''>" . NM_encode_input($Nome_filter) . "</option>\r\n");
           }
              $nm_saida->saida("        <option value='" . NM_encode_input($Tipo_filter[0]) . "' " . $Select . ">.." . $Cada_filter . "</option>\r\n");
       }
       $nm_saida->saida("       </SELECT>\r\n");
       $nm_saida->saida("     </span>\r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bedit_filter_appdiv", "document.getElementById('Salvar_filters').style.display = ''; document.Fgrid_search_save.nmgp_save_name.focus()", "document.getElementById('Salvar_filters').style.display = ''; document.Fgrid_search_save.nmgp_save_name.focus()", "Ativa_save", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("       $Cod_Btn \r\n");
       $nm_saida->saida("    <DIV id=\"Salvar_filters\" style=\"display:none;z-index:9999;position: absolute;\">\r\n");
       $nm_saida->saida("     <TABLE align=\"center\" class=\"scFilterTable\">\r\n");
       $nm_saida->saida("      <TR>\r\n");
       $nm_saida->saida("       <TD class=\"scFilterBlock\">\r\n");
       $nm_saida->saida("        <table style=\"border-width: 0px; border-collapse: collapse\" width=\"100%\">\r\n");
       $nm_saida->saida("         <tr>\r\n");
       $nm_saida->saida("          <td style=\"padding: 0px\" valign=\"top\" class=\"scFilterBlockFont\">" . $this->Ini->Nm_lang['lang_othr_srch_head'] . "</td>\r\n");
       $nm_saida->saida("          <td style=\"padding: 0px\" align=\"right\" valign=\"top\">\r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "document.getElementById('Salvar_filters').style.display = 'none'", "document.getElementById('Salvar_filters').style.display = 'none'", "Cancel_frm", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("       $Cod_Btn \r\n");
       $nm_saida->saida("          </td>\r\n");
       $nm_saida->saida("         </tr>\r\n");
       $nm_saida->saida("        </table>\r\n");
       $nm_saida->saida("       </TD>\r\n");
       $nm_saida->saida("      </TR>\r\n");
       $nm_saida->saida("      <TR>\r\n");
       $nm_saida->saida("       <TD class=\"scFilterFieldOdd\">\r\n");
       $nm_saida->saida("        <table style=\"border-width: 0px; border-collapse: collapse\" width=\"100%\">\r\n");
       $nm_saida->saida("         <tr>\r\n");
       $nm_saida->saida("          <td style=\"padding: 0px\" valign=\"top\">\r\n");
       $nm_saida->saida("           <input class=\"scFilterObjectOdd\" type=\"text\" id=\"SC_nmgp_save_name\" name=\"nmgp_save_name\" value=\"\">\r\n");
       $nm_saida->saida("          </td>\r\n");
       $nm_saida->saida("          <td style=\"padding: 0px\" align=\"right\" valign=\"top\">\r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsalvar_appdiv", "nm_save_grid_search()", "nm_save_grid_search()", "Save_frm", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("       $Cod_Btn \r\n");
       $nm_saida->saida("          </td>\r\n");
       $nm_saida->saida("         </tr>\r\n");
       $nm_saida->saida("        </table>\r\n");
       $nm_saida->saida("       </TD>\r\n");
       $nm_saida->saida("      </TR>\r\n");
       $style_del_filter = (!empty($this->NM_fil_ant)) ? '' : 'none';
       $nm_saida->saida("      <TR>\r\n");
       $nm_saida->saida("       <TD class=\"scFilterFieldEven\">\r\n");
       $nm_saida->saida("       <DIV id=\"Apaga_filters\" style=\"display: " . $style_del_filter . "\">\r\n");
       $nm_saida->saida("        <table style=\"border-width: 0px; border-collapse: collapse\" width=\"100%\">\r\n");
       $nm_saida->saida("         <tr>\r\n");
       $nm_saida->saida("          <td style=\"padding: 0px\" valign=\"top\">\r\n");
       $nm_saida->saida("          <div id=\"id_sel_filters_del\">\r\n");
       $nm_saida->saida("           <SELECT class=\"scFilterObjectOdd\" id=\"sel_filters_del\" name=\"NM_filters_del\" size=\"1\">\r\n");
       $nm_saida->saida("            <option value=\"\"></option>\r\n");
       $Nome_filter = "";
       foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
       {
           $Select = "";
           $Cada_filter = $Tipo_filter[2];
           if (isset($this->NM_curr_fil) && $Cada_filter == $this->NM_curr_fil)
           {
               $Select = "selected";
           }
           if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
           {
               $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
               $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
           }
           elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
           {
               $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
               $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
           }
           if ($Tipo_filter[1] != $Nome_filter)
           {
               $Nome_filter = $Tipo_filter[1];
               $nm_saida->saida("           <option value=''>" . NM_encode_input($Nome_filter) . "</option>\r\n");
           }
          $nm_saida->saida("           <option value='" . NM_encode_input($Tipo_filter[0]) . "' " . $Select . ">.." . $Cada_filter . "</option>\r\n");
       }
       $nm_saida->saida("           </SELECT>\r\n");
       $nm_saida->saida("          </div>\r\n");
       $nm_saida->saida("          </td>\r\n");
       $nm_saida->saida("          <td style=\"padding: 0px\" align=\"right\" valign=\"top\">\r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcluir", "nm_del_grid_search()", "nm_del_grid_search()", "Exc_filtro", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("       $Cod_Btn \r\n");
       $nm_saida->saida("          </td>\r\n");
       $nm_saida->saida("         </tr>\r\n");
       $nm_saida->saida("        </table>\r\n");
       $nm_saida->saida("       </DIV>\r\n");
       $nm_saida->saida("       </TD>\r\n");
       $nm_saida->saida("      </TR>\r\n");
       $nm_saida->saida("     </TABLE>\r\n");
       $nm_saida->saida("    </DIV> \r\n");
       $nm_saida->saida("   </form>\r\n");
       $nm_saida->saida("  </div> \r\n");
       $nm_saida->saida("    <div id='close_grid_search' class='scGridFilterTagClose' onclick=\"checkLastTag(true);setTimeout(function() {nm_proc_grid_search(0, 'del_grid_search_all', 'grid_search_res')}, 200);\"></div>\r\n");
       $nm_saida->saida("   </div>\r\n");
       $nm_saida->saida("   </td>\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'])
       { 
           $this->Ini->Arr_result['setValue'][] = array('field' => 'NM_Grid_Search', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
           $_SESSION['scriptcase']['saida_html'] = "";
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['save_grid']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_pesq']))
           { 
               $this->Ini->Arr_result['exec_JS'][] = array('function' => 'SC_carga_evt_jquery_grid', 'parm' => 'all');
           } 
       } 
       if(!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'])
       {
           $nm_saida->saida("   </tr>\r\n");
       }
       $this->JS_grid_search();
   }
   function grid_search_tag_ini($cmp, $def, $seq)
   {
       global $nm_saida;
       $lin_obj  = "";
       $lin_obj .= "<div class='scGridFilterTagListItem' id='grid_search_" . $cmp . "'>";
       $lin_obj .= "<span class='scGridFilterTagListItemLabel' id='grid_search_label_" . $cmp . "' title='" . NM_encode_input($def['hint']) . "' style='cursor:pointer;' onclick=\"closeAllTags();$('#grid_search_" . $cmp . " .scGridFilterTagListFilter').toggle();\">" . NM_encode_input($def['descr']) . "</span>";
       $lin_obj .= "<span class='scGridFilterTagListItemClose' onclick=\"$(this).parent().remove();checkLastTag(false);setTimeout(function() {nm_proc_grid_search('" . $seq . "', 'del_grid_search', 'grid_search_res'); return false;}, 200); return false;
    \"></span>";
       return $lin_obj;
   }
   function grid_search_tag_end()
   {
       global $nm_saida;
       $lin_obj  = "</div>";
       return $lin_obj;
   }
   function grid_search_add_tag()
   {
       $lin_obj  = "";
       $All_cmp_search = array('id_tecnico','valor_total','fecha_final','estado_actual');
       $nmgp_tab_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['pesq_tab_label'];
       if (!empty($nmgp_tab_label))
       {
          $nm_tab_campos = explode("?@?", $nmgp_tab_label);
          $nmgp_tab_label = array();
          foreach ($nm_tab_campos as $cada_campo)
          {
              $parte_campo = explode("?#?", $cada_campo);
              $nmgp_tab_label[$parte_campo[0]] = $parte_campo[1];
          }
       }
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_pesq']) && count($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_pesq']) < 4)
       {
           $lin_obj .= "<table id='id_grid_search_all_cmp' cellpadding=0 cellspacing=0>";
           foreach ($All_cmp_search as $cada_cmp)
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['grid_pesq'][$cada_cmp]))
               {
                   $lin_obj .= "  <tr>";
                   $lin_obj .= "    <td class='scBtnGrpBackground'>";
                   $lin_obj .= "        <div class='scBtnGrpText' style='cursor:pointer; right:80px;' onClick=\"ajax_add_grid_search(this, 'resumo', '" . $cada_cmp . "'); return false;\">";
                   $lin_obj .= "            " . $nmgp_tab_label[$cada_cmp] . "";
                   $lin_obj .= "        </div>";
                   $lin_obj .= "    </td>";
                   $lin_obj .= "  </tr>";
               }
           }
           $lin_obj .= "</table>";
       }
       return $lin_obj;
   }
   function grid_search_id_tecnico($ind, $ajax, $opc="", $val=array(), $label='')
   {
       $lin_obj  = "";
       $lin_obj .= "     <div class='scGridFilterTagListFilter' id='grid_search_id_tecnico_" . $ind . "' style='display:none; z-index: 10'>";
       $lin_obj .= "         <div class='scGridFilterTagListFilterLabel'>". NM_encode_input($label) ." <span class='scGridFilterTagListFilterLabelClose' onclick='closeAllTags(this);'></span></div>";
       $lin_obj .= "         <div class='scGridFilterTagListFilterInputs'>";
       if (empty($opc))
       {
           $opc = "eq";
       }
       $lin_obj .= "       <select id='grid_search_id_tecnico_cond_" . $ind . "' name='cond_grid_search_id_tecnico_" . $ind . "' class='" . $this->css_scAppDivToolbarInput . "' style='vertical-align: middle; display: none'>";
       $selected = ($opc == "eq") ? " selected" : "";
       $lin_obj .= "        <option value='eq'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
       $lin_obj .= "       </select>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       else
       {
           $display_in_1 = "''";
       }
       $lin_obj .= "       <span id=\"grid_id_tecnico_" . $ind . "\" style=\"display:" . $display_in_1 . "\">";
       $lin_obj .= "       <br>";
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['psq_check_ret']['id_tecnico'] = array();
       $id_tecnico_look = (is_string($id_tecnico) ? substr($this->Db->qstr($id_tecnico), 1, -1) : $id_tecnico); 
       $nmgp_def_dados  = ""; 
       $nmgp_def_dados .= "<Seleccionar un técnico>?#??#?N?@?"; 
       $nm_comando = "SELECT id_tecnico, nombre_tecnico  FROM tecnicos  ORDER BY nombre_tecnico"; 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
       { 
          while (!$rs->EOF) 
          { 
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['psq_check_ret']['id_tecnico'][] = trim($rs->fields[0]);
             $nmgp_def_dados .= trim($rs->fields[1]) . "?#?"; 
             $nmgp_def_dados .= trim($rs->fields[0]) . "?#?N?@?"; 
             $rs->MoveNext(); 
          } 
          $rs->Close(); 
       } 
       else  
       {  
           if  ($ajax == 'N')
           {  
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit; 
           } 
           else
           {  
              echo $this->Db->ErrorMsg(); 
           } 
       } 
       $lin_obj .= "    <SELECT class='" . $this->css_scAppDivToolbarInput . "' id=\"grid_search_id_tecnico_val_" . $ind . "\" name=\"val_grid_search_id_tecnico_" . $ind . "\"  size=1>";
       $delimitador = "##@@";
       $nm_opcoesx = str_replace("?#?@?#?", "?#?@ ?#?", $nmgp_def_dados);
       $nm_opcoes  = explode("?@?", $nm_opcoesx);
       $val = isset($val[0]) ? $val[0] : array();
       foreach ($nm_opcoes as $nm_opcao)
       {
          if (!empty($nm_opcao))
          {
             $temp_bug_list = explode("?#?", $nm_opcao);
             list($nm_opc_val, $nm_opc_cod, $nm_opc_sel) = $temp_bug_list;
             if ($nm_opc_cod == "@ ") {$nm_opc_cod = trim($nm_opc_cod); }
             if (is_array($val) && !empty($val))
             {
                $id_tecnico_sel = "";
                foreach ($val as $Dados)
                {
                    $tmp_pos = (is_string($Dados)) ? strpos($Dados, "##@@") : false;
                    if ($tmp_pos !== false)
                    {
                        $Dados = substr($Dados, 0, $tmp_pos);
                    }
                    if ($Dados === $nm_opc_cod)
                    {
                        $id_tecnico_sel = " selected";
                        break;
                    }
                }
             }
             else
             {
                $id_tecnico_sel = ("S" == $nm_opc_sel) ? " selected" : "";
             }
             $lin_obj .= "       <OPTION value=\"" . NM_encode_input($nm_opc_cod . $delimitador . $nm_opc_val) . "\"" . $id_tecnico_sel . ">" . $nm_opc_val . "</OPTION>";
          }
       }
       $lin_obj .= "    </SELECT>";
       $lin_obj .= "       </span>";
       $lin_obj .= "          </div>";
       $lin_obj .= "          <div class='scGridFilterTagListFilterBar'>";
       $lin_obj .= nmButtonOutput($this->arr_buttons, "bapply_appdiv", "closeAllTags();setTimeout(function() {nm_proc_grid_search($ind, 'proc_grid_search', 'grid_search_res')}, 200);", "closeAllTags();setTimeout(function() {nm_proc_grid_search($ind, 'proc_grid_search', 'grid_search_res')}, 200);", "grid_search_apply_" . $ind . "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $lin_obj .= "          </div>";
       $lin_obj .= "      </div>";
       return $lin_obj;
   }
   function grid_search_valor_total($ind, $ajax, $opc="", $val=array(), $label='')
   {
       $lin_obj  = "";
       $lin_obj .= "     <div class='scGridFilterTagListFilter' id='grid_search_valor_total_" . $ind . "' style='display:none; z-index: 10'>";
       $lin_obj .= "         <div class='scGridFilterTagListFilterLabel'>". NM_encode_input($label) ." <span class='scGridFilterTagListFilterLabelClose' onclick='closeAllTags(this);'></span></div>";
       $lin_obj .= "         <div class='scGridFilterTagListFilterInputs'>";
       if (empty($opc))
       {
           $opc = "gt";
       }
       $lin_obj .= "       <select id='grid_search_valor_total_cond_" . $ind . "' name='cond_grid_search_valor_total_" . $ind . "' class='" . $this->css_scAppDivToolbarInput . "' style='vertical-align: middle;' onChange='grid_search_hide_input(\"valor_total\", $ind)'>";
       $selected = ($opc == "gt") ? " selected" : "";
       $lin_obj .= "        <option value='gt'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_grtr'] . "</option>";
       $selected = ($opc == "lt") ? " selected" : "";
       $lin_obj .= "        <option value='lt'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_less'] . "</option>";
       $selected = ($opc == "eq") ? " selected" : "";
       $lin_obj .= "        <option value='eq'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
       $lin_obj .= "       </select>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       else
       {
           $display_in_1 = "''";
       }
       $lin_obj .= "       <span id=\"grid_valor_total_" . $ind . "\" style=\"display:" . $display_in_1 . "\">";
       $lin_obj .= "       <br>";
       $val_cmp = (isset($val[0][0])) ? $val[0][0] : "";
       nmgp_Form_Num_Val($val_cmp, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . "' id='grid_search_valor_total_val_" . $ind . "' name='val_grid_search_valor_total_" . $ind . "' value=\"" . NM_encode_input($val_cmp) . "\" size=6 alt=\"{datatype: 'decimal', maxLength: 6, precision: 2, decimalSep: '" . $_SESSION['scriptcase']['reg_conf']['dec_num'] . "', thousandsSep: '" . $_SESSION['scriptcase']['reg_conf']['grup_num'] . "', allowNegative: false, onlyNegative: false, enterTab: false}\">";
       $lin_obj .= "       </span>";
       $lin_obj .= "          </div>";
       $lin_obj .= "          <div class='scGridFilterTagListFilterBar'>";
       $lin_obj .= nmButtonOutput($this->arr_buttons, "bapply_appdiv", "closeAllTags();setTimeout(function() {nm_proc_grid_search($ind, 'proc_grid_search', 'grid_search_res')}, 200);", "closeAllTags();setTimeout(function() {nm_proc_grid_search($ind, 'proc_grid_search', 'grid_search_res')}, 200);", "grid_search_apply_" . $ind . "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $lin_obj .= "          </div>";
       $lin_obj .= "      </div>";
       return $lin_obj;
   }
   function grid_search_fecha_final($ind, $ajax, $opc="", $val=array(), $label='')
   {
       $lin_obj  = "";
       $lin_obj .= "     <div class='scGridFilterTagListFilter' id='grid_search_fecha_final_" . $ind . "' style='display:none; z-index: 10'>";
       $lin_obj .= "         <div class='scGridFilterTagListFilterLabel'>". NM_encode_input($label) ." <span class='scGridFilterTagListFilterLabelClose' onclick='closeAllTags(this);'></span></div>";
       $lin_obj .= "         <div class='scGridFilterTagListFilterInputs'>";
       if (empty($opc))
       {
           $opc = "eq";
       }
       $lin_obj .= "       <select id='grid_search_fecha_final_cond_" . $ind . "' name='cond_grid_search_fecha_final_" . $ind . "' class='" . $this->css_scAppDivToolbarInput . "' style='vertical-align: middle;' onChange='grid_search_change_bi(\"fecha_final\", $ind)'>";
       $lin_obj .= "        <optgroup label=\"" . $this->Ini->Nm_lang['lang_srch_nrml'] . "\">";
       $selected = ($opc == "eq") ? " selected" : "";
       $lin_obj .= "        <option value='eq'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
       $selected = ($opc == "bw") ? " selected" : "";
       $lin_obj .= "        <option value='bw'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_betw'] . "</option>";
       $lin_obj .= "        <optgroup label=\"" . $this->Ini->Nm_lang['lang_srch_spec'] . "\">";
       $selected = ($opc == "bi_HJ") ? " selected" : "";
       $lin_obj .= "        <option value='bi_HJ'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_tday'] . "</option>";
       $selected = ($opc == "bi_OT") ? " selected" : "";
       $lin_obj .= "        <option value='bi_OT'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_yest'] . "</option>";
       $selected = ($opc == "bi_U7") ? " selected" : "";
       $lin_obj .= "        <option value='bi_U7'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_lst7'] . "</option>";
       $selected = ($opc == "bi_last_30_dias") ? " selected" : "";
       $lin_obj .= "        <option value='bi_last_30_dias'" . $selected . ">" . $this->Ini->Nm_lang['lang_search_last_30_dias'] . "</option>";
       $selected = ($opc == "bi_CY") ? " selected" : "";
       $lin_obj .= "        <option value='bi_CY'" . $selected . ">" . $this->Ini->Nm_lang['lang_search_summary_current_year_today'] . "</option>";
       $selected = ($opc == "bi_LY") ? " selected" : "";
       $lin_obj .= "        <option value='bi_LY'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_last_year'] . "</option>";
       $selected = ($opc == "bi_MM") ? " selected" : "";
       $lin_obj .= "        <option value='bi_MM'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_this_mnth'] . "</option>";
       $selected = ($opc == "bi_UM") ? " selected" : "";
       $lin_obj .= "        <option value='bi_UM'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_last_mnth'] . "</option>";
       $selected = ($opc == "bi_M3") ? " selected" : "";
       $lin_obj .= "        <option value='bi_M3'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_last_03mo'] . "</option>";
       $selected = ($opc == "bi_YY") ? " selected" : "";
       $lin_obj .= "        <option value='bi_YY'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_last_12mo'] . "</option>";
       $selected = ($opc == "bi_current_week_today") ? " selected" : "";
       $lin_obj .= "        <option value='bi_current_week_today'" . $selected . ">" . $this->Ini->Nm_lang['lang_search_summary_current_week_today'] . "</option>";
       $selected = ($opc == "bi_current_week") ? " selected" : "";
       $lin_obj .= "        <option value='bi_current_week'" . $selected . ">" . $this->Ini->Nm_lang['lang_search_summary_current_week'] . "</option>";
       $selected = ($opc == "bi_last_week") ? " selected" : "";
       $lin_obj .= "        <option value='bi_last_week'" . $selected . ">" . $this->Ini->Nm_lang['lang_search_summary_last_week'] . "</option>";
       $selected = ($opc == "bi_current_year") ? " selected" : "";
       $lin_obj .= "        <option value='bi_current_year'" . $selected . ">" . $this->Ini->Nm_lang['lang_search_summary_current_year'] . "</option>";
       $selected = ($opc == "bi_next_year") ? " selected" : "";
       $lin_obj .= "        <option value='bi_next_year'" . $selected . ">" . $this->Ini->Nm_lang['lang_search_summary_next_year'] . "</option>";
       $lin_obj .= "       </select>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       else
       {
           $display_in_1 = "''";
       }
       $lin_obj .= "       <span id=\"grid_fecha_final_" . $ind . "\" style=\"display:" . $display_in_1 . "\">";
       $lin_obj .= "       <br>";
       $Form_base          = "ddmmyyyy";
       $date_format_show   = "";
       $Str_date = str_replace("a", "y", strtolower($_SESSION['scriptcase']['reg_conf']['date_format']));
       $Lim   = strlen($Str_date);
       $Str   = "";
       $Ult   = "";
       $Arr_D = array();
       for ($I = 0; $I < $Lim; $I++)
       {
           $Char = substr($Str_date, $I, 1);
           if ($Char != $Ult && "" != $Str)
           {
               $Arr_D[] = $Str;
               $Str     = $Char;
           }
           else
           {
              $Str    .= $Char;
           }
           $Ult = $Char;
       }
       $Arr_D[] = $Str;
       $Prim = true;
       foreach ($Arr_D as $Cada_d)
       {
           if (strpos($Form_base, $Cada_d) !== false)
           {
               $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
               $date_format_show .= $Cada_d;
               $Prim = false;
           }
       }
       $Tmp_date = $Arr_D;
       $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
       $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
       $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
       $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
       $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
       $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
       $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
       $display_bi = "";
       $display_nm = "";
       $bi_dt1     = "";
       $bi_dt2     = "";
       if (substr($opc, 0, 3) == "bi_")
       {
           $display_nm = "none";
           if ($opc != "bi_TP")
           {
               $tmp_opc = $opc;
               $this->Ini->process_cond_bi($tmp_opc, $bi_dt1, $bi_dt2);
               $this->formata_bi_fecha_final($opc, $bi_dt1, $bi_dt2, $tmp_opc);
           }
       }
       else
       {
           $display_bi = "none";
       }
       $lin_obj .= "<SPAN id=\"ID_bi_dados_grid_fecha_final_" . $ind . "\" style=\"display:" . $display_bi . ";\">" . $bi_dt1 . $bi_dt2 . "</SPAN>";
       $lin_obj .= "<SPAN id=\"ID_nm_dados_grid_fecha_final_" . $ind . "\" style=\"display:" . $display_nm . ";\">";
       $val_r = $this->Ini->dyn_convert_date($val[0]);
       foreach ($Tmp_date as $Ind => $Part_date)
       {
            $AutoTab = (($Ind + 1) < count($Tmp_date)) ? "autoTab: true" : "autoTab: false";
           if (substr($Part_date, 0,1) == "y")
           {
               $val_cmp = (isset($val_r['ano'])) ? $val_r['ano'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . "' id='grid_search_fecha_final_ano_val_" . $ind . "' name='val_grid_search_fecha_final_ano_" . $ind . "' value=\"" . NM_encode_input($val_cmp) . "\" size=4 alt=\"{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "m")
           {
               $val_cmp = (isset($val_r['mes'])) ? $val_r['mes'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . "' id='grid_search_fecha_final_mes_val_" . $ind . "' name='val_grid_search_fecha_final_mes_" . $ind . "' value=\"" . NM_encode_input($val_cmp) . "\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "d")
           {
               $val_cmp = (isset($val_r['dia'])) ? $val_r['dia'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . "' id='grid_search_fecha_final_dia_val_" . $ind . "' name='val_grid_search_fecha_final_dia_" . $ind . "' value=\"" . NM_encode_input($val_cmp) . "\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
       }
       $lin_obj .= "&nbsp;";
       $lin_obj .= "" . $date_format_show . "";
       $lin_obj .= "</SPAN>";
       $lin_obj .= "       </span>";
       if ($opc == "bw")
       {
           $display_in_2 = "''";
       }
       else
       {
           $display_in_2 = "none";
       }
       $lin_obj .= "       <span id=\"grid_fecha_final_in_2_" . $ind . "\" style=\"display:" . $display_in_2 . "\">";
       $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
       if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
       {
           $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $lin_obj .= "       <br>" . $date_sep_bw . "<br>";
       $val_r = isset($val[1]) ? $this->Ini->dyn_convert_date($val[1]) : array();
       foreach ($Tmp_date as $Ind => $Part_date)
       {
            $AutoTab = (($Ind + 1) < count($Tmp_date)) ? "autoTab: true" : "autoTab: false";
           if (substr($Part_date, 0,1) == "y")
           {
               $val_cmp = (isset($val_r['ano'])) ? $val_r['ano'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . "' id='grid_search_fecha_final_v2__ano_val_" . $ind . "' name='val_grid_search_fecha_final_v2__ano_" . $ind . "' value=\"" . NM_encode_input($val_cmp) . "\" size=4 alt=\"{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "m")
           {
               $val_cmp = (isset($val_r['mes'])) ? $val_r['mes'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . "' id='grid_search_fecha_final_v2__mes_val_" . $ind . "' name='val_grid_search_fecha_final_v2__mes_" . $ind . "' value=\"" . NM_encode_input($val_cmp) . "\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "d")
           {
               $val_cmp = (isset($val_r['dia'])) ? $val_r['dia'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . "' id='grid_search_fecha_final_v2__dia_val_" . $ind . "' name='val_grid_search_fecha_final_v2__dia_" . $ind . "' value=\"" . NM_encode_input($val_cmp) . "\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
       }
       $lin_obj .= "&nbsp;";
       $lin_obj .= "" . $date_format_show . "";
       $lin_obj .= "       </span>";
       $lin_obj .= "          </div>";
       $lin_obj .= "          <div class='scGridFilterTagListFilterBar'>";
       $lin_obj .= nmButtonOutput($this->arr_buttons, "bapply_appdiv", "closeAllTags();setTimeout(function() {nm_proc_grid_search($ind, 'proc_grid_search', 'grid_search_res')}, 200);", "closeAllTags();setTimeout(function() {nm_proc_grid_search($ind, 'proc_grid_search', 'grid_search_res')}, 200);", "grid_search_apply_" . $ind . "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $lin_obj .= "          </div>";
       $lin_obj .= "      </div>";
       return $lin_obj;
   }
   function grid_search_estado_actual($ind, $ajax, $opc="", $val=array(), $label='')
   {
       $lin_obj  = "";
       $lin_obj .= "     <div class='scGridFilterTagListFilter' id='grid_search_estado_actual_" . $ind . "' style='display:none; z-index: 10'>";
       $lin_obj .= "         <div class='scGridFilterTagListFilterLabel'>". NM_encode_input($label) ." <span class='scGridFilterTagListFilterLabelClose' onclick='closeAllTags(this);'></span></div>";
       $lin_obj .= "         <div class='scGridFilterTagListFilterInputs'>";
       if (empty($opc))
       {
           $opc = "eq";
       }
       $lin_obj .= "       <select id='grid_search_estado_actual_cond_" . $ind . "' name='cond_grid_search_estado_actual_" . $ind . "' class='" . $this->css_scAppDivToolbarInput . "' style='vertical-align: middle; display: none'>";
       $selected = ($opc == "eq") ? " selected" : "";
       $lin_obj .= "        <option value='eq'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
       $lin_obj .= "       </select>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       else
       {
           $display_in_1 = "''";
       }
       $lin_obj .= "       <span id=\"grid_estado_actual_" . $ind . "\" style=\"display:" . $display_in_1 . "\">";
       $lin_obj .= "       <br>";
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['psq_check_ret']['estado_actual'] = array();
       $estado_actual_look = (is_string($estado_actual) ? substr($this->Db->qstr($estado_actual), 1, -1) : $estado_actual); 
       $nmgp_def_dados  = ""; 
       $nm_comando = "SELECT id_estado_agenda, descr_estado_agenda  FROM estado_agenda  ORDER BY descr_estado_agenda"; 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
       { 
          while (!$rs->EOF) 
          { 
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['psq_check_ret']['estado_actual'][] = trim($rs->fields[0]);
             $nmgp_def_dados .= trim($rs->fields[1]) . "?#?"; 
             $nmgp_def_dados .= trim($rs->fields[0]) . "?#?N?@?"; 
             $rs->MoveNext(); 
          } 
          $rs->Close(); 
       } 
       else  
       {  
           if  ($ajax == 'N')
           {  
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit; 
           } 
           else
           {  
              echo $this->Db->ErrorMsg(); 
           } 
       } 
       $i = 0;
       $lin_obj .= "   <table id=\"TBG_estado_actual_" . $ind . "\" style=\"padding: 0px; spacing: 0px; border-width: 0px;\"><tr>";
       $delimitador = "##@@";
       $nm_opcoesx = str_replace("?#?@?#?", "?#?@ ?#?", $nmgp_def_dados);
       $nm_opcoes  = explode("?@?", $nm_opcoesx);
       $val = isset($val[0]) ? $val[0] : array();
       for ($j = 0; $j < sizeof($nm_opcoes); $j++)
       {
          if (!empty($nm_opcoes[$j]))
          {
             $temp_bug_list = explode("?#?", $nm_opcoes[$j]);
             list($nm_opc_val, $nm_opc_cod, $nm_opc_sel) = $temp_bug_list;
             if ($nm_opc_cod == "@ ") {$nm_opc_cod = trim($nm_opc_cod); }
             if (is_array($val) && !empty($val))
             {
                $tmp_cmp_sel = "";
                foreach ($val as $Dados)
                {
                    $tmp_pos = (is_string($Dados)) ? strpos($Dados, "##@@") : false;
                    if ($tmp_pos !== false)
                    {
                        $Dados = substr($Dados, 0, $tmp_pos);
                    }
                    if ($Dados === $nm_opc_cod)
                    {
                        $tmp_cmp_sel = " checked";
                        break;
                    }
                }
             }
             else
             {
                $tmp_cmp_sel = ("S" == $nm_opc_sel) ? " checked" : "";
             }
             $lin_obj .= "   <td>";
             $lin_obj .= "    <INPUT class='" . $this->css_scAppDivToolbarInput . "' type=\"checkbox\" id=\"grid_search_estado_actual_val_" . $ind . "\" name=\"val_grid_search_estado_actual_" . $ind . "[]\" value=\"" . NM_encode_input($nm_opc_cod . $delimitador . $nm_opc_val) . "\"" . $tmp_cmp_sel . ">" . $nm_opc_val;
             $lin_obj .= "   </td>";
             $i++;
             if (1 == $i && $j < sizeof($nm_opcoes) - 1)
             {
                 $lin_obj .=  "    </tr>";
                 $lin_obj .=  "    <tr>";
                 $i = 0;
             }
          }
       }
       $lin_obj .= "    </tr>\r\n";
       $lin_obj .= "   </table>";
       $lin_obj .= "       </span>";
       $lin_obj .= "          </div>";
       $lin_obj .= "          <div class='scGridFilterTagListFilterBar'>";
       $lin_obj .= nmButtonOutput($this->arr_buttons, "bapply_appdiv", "closeAllTags();setTimeout(function() {nm_proc_grid_search($ind, 'proc_grid_search', 'grid_search_res')}, 200);", "closeAllTags();setTimeout(function() {nm_proc_grid_search($ind, 'proc_grid_search', 'grid_search_res')}, 200);", "grid_search_apply_" . $ind . "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $lin_obj .= "          </div>";
       $lin_obj .= "      </div>";
       return $lin_obj;
   }
   function formata_bi_fecha_final($opc, &$bi_dt1, &$bi_dt2, $opc_bi)
   {
       $Str_date = str_replace("a", "y", strtolower($_SESSION['scriptcase']['reg_conf']['date_format']));
       $Str_date = str_replace("y", "Y", $Str_date);
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
       $date_format_show = "";
       foreach ($Arr_D as $Cada_d)
       {
           $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
           $date_format_show .= ($Cada_d == "d") ? substr($bi_dt1, 0, 2) : "";
           $date_format_show .= ($Cada_d == "m") ? substr($bi_dt1, 2, 2) : "";
           $date_format_show .= ($Cada_d == "Y") ? substr($bi_dt1, 4, 4) : "";
           $Prim = false;
       }
       $bi_dt1 = $date_format_show;
       $date_format_show = "";
       if ($opc_bi == "bw")
       {
           $Prim = true;
           $date_format_show = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
           foreach ($Arr_D as $Cada_d)
           {
               $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
               $date_format_show .= ($Cada_d == "d") ? substr($bi_dt2, 0, 2): "";
               $date_format_show .= ($Cada_d == "m") ? substr($bi_dt2, 2, 2) : "";
               $date_format_show .= ($Cada_d == "Y") ? substr($bi_dt2, 4, 4) : "";
               $Prim = false;
           }
       }
       $bi_dt2 = $date_format_show;
   }
   function gera_array_filtros()
   {
       $this->NM_fil_ant = array();
       $pos_path = strrpos($this->Ini->path_prod, "/");
       $this->NM_path_filter = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/filters/";
       $NM_patch   = "curso_experto/grid_agenda_cliente";
       if (is_dir($this->NM_path_filter . $NM_patch))
       {
           $NM_dir = @opendir($this->NM_path_filter . $NM_patch);
           while (FALSE !== ($NM_arq = @readdir($NM_dir)))
           {
             if (@is_file($this->NM_path_filter . $NM_patch . "/" . $NM_arq))
             {
                 $Sc_v6 = false;
                 $NMcmp_filter = file($this->NM_path_filter . $NM_patch . "/" . $NM_arq);
                 $NMcmp_filter = explode("@NMF@", $NMcmp_filter[0]);
                 if (substr($NMcmp_filter[0], 0, 6) == "SC_V6_" || substr($NMcmp_filter[0], 0, 6) == "SC_V8_")
                 {
                     $Name_filter = substr($NMcmp_filter[0], 6);
                     if (!empty($Name_filter))
                     {
                         $this->NM_fil_ant[$NM_arq][0] = $NM_patch . "/" . $NM_arq;
                         $this->NM_fil_ant[$NM_arq][1] = "" . $this->Ini->Nm_lang['lang_srch_public']  . "";
                         $Sc_v6 = true;
                     }
                 }
                 if (!$Sc_v6)
                 {
                     $this->NM_fil_ant[$NM_arq][0] = $NM_arq;
                     $this->NM_fil_ant[$NM_arq][1] = "" . $this->Ini->Nm_lang['lang_srch_public']  . "";
                 }
                 $this->NM_fil_ant[$NM_arq][2] = $Name_filter;
             }
           }
       }
       return $this->NM_fil_ant;
   }
   function JS_grid_search()
   {
       global $nm_saida;
       $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("     var Tot_obj_grid_search = " . $this->grid_search_seq . ";\r\n");
       $nm_saida->saida("     Tab_obj_grid_search = new Array();\r\n");
       $nm_saida->saida("     Tab_evt_grid_search = new Array();\r\n");
       foreach ($this->grid_search_dat as $seq => $cmp)
       {
           $nm_saida->saida("     Tab_obj_grid_search[" . $seq . "] = '" . $cmp . "';\r\n");
       }
       $nm_saida->saida(" function sc_grid_agenda_cliente_valida_mes(obj)\r\n");
       $nm_saida->saida(" {\r\n");
       $nm_saida->saida("     if (obj.value != \"\" && (obj.value < 1 || obj.value > 12))\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if (confirm (Nm_erro['lang_jscr_ivdt'] +  \" \" + Nm_erro['lang_jscr_mnth'] +  \" \" + Nm_erro['lang_jscr_wfix']))\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("            Xfocus = setTimeout(function() { obj.focus(); }, 10);\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida(" }\r\n");
       $nm_saida->saida(" function sc_grid_agenda_cliente_valida_dia(obj)\r\n");
       $nm_saida->saida(" {\r\n");
       $nm_saida->saida("     if (obj.value != \"\" && (obj.value < 1 || obj.value > 31))\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if (confirm (Nm_erro['lang_jscr_ivdt'] +  \" \" + Nm_erro['lang_jscr_iday'] +  \" \" + Nm_erro['lang_jscr_wfix']))\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("            Xfocus = setTimeout(function() { obj.focus(); }, 10);\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida(" }\r\n");
       $nm_saida->saida("     Tab_evt_grid_search['fecha_final_mes'] =  'sc_grid_agenda_cliente_valida_mes(this)';\r\n");
       $nm_saida->saida("     Tab_evt_grid_search['fecha_final_dia'] =  'sc_grid_agenda_cliente_valida_dia(this)';\r\n");
       $nm_saida->saida("     Tab_evt_grid_search['fecha_final_v2__mes'] =  'sc_grid_agenda_cliente_valida_mes(this)';\r\n");
       $nm_saida->saida("     Tab_evt_grid_search['fecha_final_v2__dia'] =  'sc_grid_agenda_cliente_valida_dia(this)';\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_agenda_cliente']['ajax_nav'])
       { 
           $this->Ini->Arr_result['setArr'][] = array('var' => 'Tab_obj_grid_search', 'value' => '');
           $this->Ini->Arr_result['setArr'][] = array('var' => 'Tab_evt_grid_search', 'value' => '');
           $this->Ini->Arr_result['setVar'][] = array('var' => 'Tot_obj_grid_search', 'value' => $this->grid_search_seq);
           foreach ($this->grid_search_dat as $seq => $cmp)
           {
               $this->Ini->Arr_result['setVar'][] = array('var' => 'Tab_obj_grid_search[' . $seq . ']', 'value' => $cmp);
           }
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_grid_search['fecha_final_mes']", 'value' => 'sc_grid_agenda_cliente_valida_mes(this)');
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_grid_search['fecha_final_dia']", 'value' => 'sc_grid_agenda_cliente_valida_dia(this)');
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_grid_search['fecha_final_v2__mes']", 'value' => 'sc_grid_agenda_cliente_valida_mes(this)');
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_grid_search['fecha_final_v2__dia']", 'value' => 'sc_grid_agenda_cliente_valida_dia(this)');
       } 
       $nm_saida->saida("     function SC_carga_evt_jquery_grid(tp_carga)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         for (i = 1; i <= Tot_obj_grid_search; i++)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             if (Tab_obj_grid_search[i] != 'NMSC_Grid_Null' && (tp_carga == 'all' || tp_carga == i))\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 x   = 0;\r\n");
       $nm_saida->saida("                 tmp = Tab_obj_grid_search[i];\r\n");
       $nm_saida->saida("                 cps = new Array();\r\n");
       $nm_saida->saida("                 cps[x] = tmp;\r\n");
       $nm_saida->saida("                 if (tmp == 'fecha_final')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     cps[x] = 'fecha_final_dia';\r\n");
       $nm_saida->saida("                     x++;\r\n");
       $nm_saida->saida("                     cps[x] = 'fecha_final_mes';\r\n");
       $nm_saida->saida("                     x++;\r\n");
       $nm_saida->saida("                     cps[x] = 'fecha_final_v2__dia';\r\n");
       $nm_saida->saida("                     x++;\r\n");
       $nm_saida->saida("                     cps[x] = 'fecha_final_v2__mes';\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 for (x = 0; x < cps.length ; x++)\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     cmp = cps[x];\r\n");
       $nm_saida->saida("                     if (Tab_evt_grid_search[cmp])\r\n");
       $nm_saida->saida("                     {\r\n");
       $nm_saida->saida("                         eval (\"$('#grid_search_\" + cmp + \"_val_\" + i + \"').bind('change', function() {\" + Tab_evt_grid_search[cmp] + \"})\");\r\n");
       $nm_saida->saida("                     }\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function grid_search_change_bi(field, ind)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var index = document.getElementById('grid_search_' + field + '_cond_' + ind).selectedIndex;\r\n");
       $nm_saida->saida("        var parm  = document.getElementById('grid_search_' + field + '_cond_' + ind).options[index].value;\r\n");
       $nm_saida->saida("        if (parm.substring(0, 3) == \"bi_\")\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#grid_' + field + '_in_2_' + ind).css('display','none');\r\n");
       $nm_saida->saida("            if (parm == \"bi_TP\")\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                $('#ID_bi_dados_grid_' + field + '_' + ind).html('');\r\n");
       $nm_saida->saida("                $('#ID_bi_dados_grid_' + field + '_' + ind).css('display','');\r\n");
       $nm_saida->saida("                $('#ID_nm_dados_grid_' + field + '_' + ind).css('display','none');\r\n");
       $nm_saida->saida("                return;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            ajax_ch_bi_grid_search(field, ind, parm, 'resumo');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        else\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#ID_bi_dados_grid_' + field + '_' + ind).css('display','none');\r\n");
       $nm_saida->saida("            if (parm == \"nu\" || parm == \"nn\" || parm == \"ep\" || parm == \"ne\")\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                $('#ID_nm_dados_grid_' + field + '_' + ind).css('display','none');\r\n");
       $nm_saida->saida("                $('#grid_' + field + '_in_2_' + ind).css('display','none');\r\n");
       $nm_saida->saida("                return;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            $('#ID_nm_dados_grid_' + field + '_' + ind).css('display','');\r\n");
       $nm_saida->saida("            if (parm == \"bw\")\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                $('#grid_' + field + '_in_2_' + ind).css('display','');\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            else\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                $('#grid_' + field + '_in_2_' + ind).css('display','none');\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function grid_search_change_bw(field, ind)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var index = document.getElementById('grid_search_' + field + '_cond_' + ind).selectedIndex;\r\n");
       $nm_saida->saida("        var parm  = document.getElementById('grid_search_' + field + '_cond_' + ind).options[index].value;\r\n");
       $nm_saida->saida("        if (parm == \"bw\")\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#grid_' + field + '_' + ind).css('display','');\r\n");
       $nm_saida->saida("            $('#grid_' + field + '_in_2_' + ind).css('display','');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        else\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#grid_' + field + '_in_2_' + ind).css('display','none');\r\n");
       $nm_saida->saida("            if (parm == \"nu\" || parm == \"nn\" || parm == \"ep\" || parm == \"ne\")\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                $('#grid_' + field + '_' + ind).css('display','none');\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            else\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                $('#grid_' + field + '_' + ind).css('display','');\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function grid_search_hide_input(field, ind)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var index = document.getElementById('grid_search_' + field + '_cond_' + ind).selectedIndex;\r\n");
       $nm_saida->saida("        var parm  = document.getElementById('grid_search_' + field + '_cond_' + ind).options[index].value;\r\n");
       $nm_saida->saida("        if (parm == \"nu\" || parm == \"nn\" || parm == \"ep\" || parm == \"ne\")\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#grid_' + field + '_' + ind).css('display','none');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        else\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#grid_' + field + '_' + ind).css('display','');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     var addfilter_status = 'out';\r\n");
       $nm_saida->saida("     function nm_show_advancedsearch_fields()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("       var btn_id = 'add_grid_search';\r\n");
       $nm_saida->saida("       var obj_id = 'id_grid_search_add_tag';\r\n");
       $nm_saida->saida("       if($('#' + btn_id).offset().left + $('#' + obj_id).width() > $(document).width())\r\n");
       $nm_saida->saida("       {\r\n");
       $nm_saida->saida("            $('#' + obj_id).css('margin-left', ( $(document).width() - $('#' + btn_id).offset().left - $('#' + obj_id).width() - 10 ));\r\n");
       $nm_saida->saida("       }\r\n");
       $nm_saida->saida("       addfilter_status = 'open';\r\n");
       $nm_saida->saida("       $('#' + btn_id).mouseout(function() {\r\n");
       $nm_saida->saida("         setTimeout(function() {\r\n");
       $nm_saida->saida("           nm_hide_advancedsearch_fields(obj_id);\r\n");
       $nm_saida->saida("         }, 1000);\r\n");
       $nm_saida->saida("       });\r\n");
       $nm_saida->saida("       $('#' + obj_id + ' div').click(function() {\r\n");
       $nm_saida->saida("         addfilter_status = 'out';\r\n");
       $nm_saida->saida("         nm_hide_advancedsearch_fields(obj_id);\r\n");
       $nm_saida->saida("       });\r\n");
       $nm_saida->saida("       $('#' + obj_id).css({\r\n");
       $nm_saida->saida("         'left': $('#' + btn_id).left\r\n");
       $nm_saida->saida("       })\r\n");
       $nm_saida->saida("       .mouseover(function() {\r\n");
       $nm_saida->saida("         addfilter_status = 'over';\r\n");
       $nm_saida->saida("       })\r\n");
       $nm_saida->saida("       .mouseleave(function() {\r\n");
       $nm_saida->saida("         addfilter_status = 'out';\r\n");
       $nm_saida->saida("         setTimeout(function() {\r\n");
       $nm_saida->saida("           nm_hide_advancedsearch_fields(obj_id);\r\n");
       $nm_saida->saida("         }, 1000);\r\n");
       $nm_saida->saida("       })\r\n");
       $nm_saida->saida("       .show('fast');\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_hide_advancedsearch_fields(obj_id) {\r\n");
       $nm_saida->saida("      if ('over' != addfilter_status) {\r\n");
       $nm_saida->saida("        $('#' + obj_id).hide('fast');\r\n");
       $nm_saida->saida("      }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function closeAllTags(obj)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if (obj !== undefined)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             if($(obj).parent().parent().parent().attr('new') == 'new')\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 $(obj).parent().parent().parent().find('.scGridFilterTagListItemClose').click();\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         $('.scGridFilterTagListFilter').hide();\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function checkLastTag(bol_force)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if(bol_force || $('.scGridFilterTagListItem').length == 0)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             $('#NM_Grid_Search').remove();\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     var nm_empty_data_cond = ['ep','ne','nu','nn'];\r\n");
       $nm_saida->saida("     function nm_proc_grid_search(Seq, Tp_Proc, Origem)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         var out_dyn = \"\";\r\n");
       $nm_saida->saida("         var i       = Seq;\r\n");
       $nm_saida->saida("         if (Tp_Proc == 'del_grid_search' || Tp_Proc == 'del_grid_search_all')\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             $('#add_grid_search').removeClass('scGridFilterTagAddDisabled');\r\n");
       $nm_saida->saida("             out_dyn += Tab_obj_grid_search[i] + \"_DYN_\" + Tp_Proc;\r\n");
       $nm_saida->saida("             if (Tp_Proc == 'del_grid_search_all')\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 Tab_obj_grid_search = new Array();\r\n");
       $nm_saida->saida("                 checkLastTag(true);\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             else\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 Tab_obj_grid_search[i] = 'NMSC_Grid_Null';\r\n");
       $nm_saida->saida("                 eval('Dropdownchecklist_'+ Tab_obj_grid_search[i] +'=false;');\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         else\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             $('#grid_search_' + Tab_obj_grid_search[i]).attr('new', '');\r\n");
       $nm_saida->saida("             if (Tab_obj_grid_search[i] != 'NMSC_Grid_Null')\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 out_dyn += Tab_obj_grid_search[i];\r\n");
       $nm_saida->saida("                 obj_dyn  = 'grid_search_' + Tab_obj_grid_search[i] + '_cond_' + i;\r\n");
       $nm_saida->saida("                 out_cond = grid_search_get_sel_cond(obj_dyn);\r\n");
       $nm_saida->saida("                 out_dyn += \"_DYN_\" + out_cond;\r\n");
       $nm_saida->saida("                 obj_dyn  = 'grid_search_' + Tab_obj_grid_search[i] + '_val_';\r\n");
       $nm_saida->saida("                 if (Tab_obj_grid_search[i] == 'id_tecnico')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     result  = grid_search_get_select(obj_dyn + i, '');\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 if (Tab_obj_grid_search[i] == 'valor_total')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     result  = grid_search_get_text(obj_dyn + i, '');\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 if (Tab_obj_grid_search[i] == 'fecha_final')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     obj_dyn = 'grid_search_' + Tab_obj_grid_search[i];\r\n");
       $nm_saida->saida("                     result  = grid_search_get_dt_h(obj_dyn, i, 'DT');\r\n");
       $nm_saida->saida("                     result += \"_VLS2_\" + grid_search_get_dt_h(obj_dyn + \"_v2_\", i, 'DT');\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 if (Tab_obj_grid_search[i] == 'estado_actual')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     result  = grid_search_get_checkbox(obj_dyn + i);\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 if((result == '' || result == '_VLS2_' || result == 'Y:_VLS_M:_VLS_D:_VLS2_Y:_VLS_M:_VLS_D:' || result == 'Y:_VLS_M:_VLS_D:_VLS_H:_VLS_I:_VLS_S:_VLS2_Y:_VLS_M:_VLS_D:_VLS_H:_VLS_I:_VLS_S:') && nm_empty_data_cond.indexOf(out_cond) == -1 && out_cond.substring(0, 3) != 'bi_')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     alert(\"" . $this->Ini->Nm_lang['lang_srch_req_field'] . "\");\r\n");
       $nm_saida->saida("                     return false;\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 out_dyn += \"_DYN_\" + result;\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         ajax_navigate_res(Origem, out_dyn);\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_save_grid_search()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if (document.Fgrid_search_save.nmgp_save_name.value == '')\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             alert(\"" . $this->Ini->Nm_lang['lang_srch_req_field'] . "\");\r\n");
       $nm_saida->saida("             document.Fgrid_search_save.nmgp_save_name.focus();\r\n");
       $nm_saida->saida("             return false;\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         save_name = document.Fgrid_search_save.nmgp_save_name.value;\r\n");
       $nm_saida->saida("         save_opt  = \"\"\r\n");
       $nm_saida->saida("         str_out = \"\";\r\n");
       $nm_saida->saida("         for (i = 1; i <= Tot_obj_grid_search; i++)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             if (Tab_obj_grid_search[i] != 'NMSC_Grid_Null')\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 obj_dyn  = 'grid_search_' + Tab_obj_grid_search[i] + '_cond_' + i;\r\n");
       $nm_saida->saida("                 out_cond = grid_search_get_sel_cond(obj_dyn);\r\n");
       $nm_saida->saida("                 str_out += \"SC_\" + Tab_obj_grid_search[i] + \"_cond#NMF#\" + out_cond + \"@NMF@\";\r\n");
       $nm_saida->saida("                 obj_dyn  = 'grid_search_' + Tab_obj_grid_search[i] + '_val_';\r\n");
       $nm_saida->saida("                 obj_dyn2 = 'grid_search_' + Tab_obj_grid_search[i] + '_v2__val_';\r\n");
       $nm_saida->saida("                 if (Tab_obj_grid_search[i] == 'id_tecnico')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     result  = grid_search_get_select(obj_dyn + i, '');\r\n");
       $nm_saida->saida("                     tvals  = result.split(\"_VLS_\");\r\n");
       $nm_saida->saida("                     if (tvals[1])\r\n");
       $nm_saida->saida("                     {\r\n");
       $nm_saida->saida("                         str_out += \"SC_\" + Tab_obj_grid_search[i] + \"#NMF#_NM_array_\";\r\n");
       $nm_saida->saida("                         for (x = 0; x < tvals.length; x++)\r\n");
       $nm_saida->saida("                         {\r\n");
       $nm_saida->saida("                             str_out += \"#NMARR#\" + tvals[x];\r\n");
       $nm_saida->saida("                         }\r\n");
       $nm_saida->saida("                         str_out += \"@NMF@\";\r\n");
       $nm_saida->saida("                     }\r\n");
       $nm_saida->saida("                     else\r\n");
       $nm_saida->saida("                     {\r\n");
       $nm_saida->saida("                         str_out += \"SC_\" + Tab_obj_grid_search[i] + \"#NMF#\" + result + \"@NMF@\";\r\n");
       $nm_saida->saida("                     }\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 if (Tab_obj_grid_search[i] == 'valor_total')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     result  = grid_search_get_text(obj_dyn + i, '');\r\n");
       $nm_saida->saida("                     str_out += \"SC_\" + Tab_obj_grid_search[i] + \"#NMF#\" + result + \"@NMF@\";\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 if (Tab_obj_grid_search[i] == 'fecha_final')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     obj_dyn = 'grid_search_' + Tab_obj_grid_search[i];\r\n");
       $nm_saida->saida("                     result   = grid_search_get_dt_h(obj_dyn, i, 'DT');\r\n");
       $nm_saida->saida("                     result  += \"_VLS2_\" + grid_search_get_dt_h(obj_dyn + \"_v2_\", i, 'DT');\r\n");
       $nm_saida->saida("                     tvals = result.split(\"_VLS2_\");\r\n");
       $nm_saida->saida("                     vals  = tvals[0].split(\"_VLS_\");\r\n");
       $nm_saida->saida("                     for (x = 0; x < vals.length; x++)\r\n");
       $nm_saida->saida("                     {\r\n");
       $nm_saida->saida("                         if (vals[x].substring(0, 2) == \"Y:\") {\r\n");
       $nm_saida->saida("                             str_out += \"SC_\" + Tab_obj_grid_search[i] + \"_ano#NMF#\" + vals[x].substring(2) + \"@NMF@\";\r\n");
       $nm_saida->saida("                         }\r\n");
       $nm_saida->saida("                         if (vals[x].substring(0, 2) == \"M:\") {\r\n");
       $nm_saida->saida("                             str_out += \"SC_\" + Tab_obj_grid_search[i] + \"_mes#NMF#\" + vals[x].substring(2) + \"@NMF@\";\r\n");
       $nm_saida->saida("                         }\r\n");
       $nm_saida->saida("                         if (vals[x].substring(0, 2) == \"D:\") {\r\n");
       $nm_saida->saida("                             str_out += \"SC_\" + Tab_obj_grid_search[i] + \"_dia#NMF#\" + vals[x].substring(2) + \"@NMF@\";\r\n");
       $nm_saida->saida("                         }\r\n");
       $nm_saida->saida("                         if (vals[x].substring(0, 2) == \"H:\") {\r\n");
       $nm_saida->saida("                             str_out += \"SC_\" + Tab_obj_grid_search[i] + \"_hor#NMF#\" + vals[x].substring(2) + \"@NMF@\";\r\n");
       $nm_saida->saida("                         }\r\n");
       $nm_saida->saida("                         if (vals[x].substring(0, 2) == \"I:\") {\r\n");
       $nm_saida->saida("                             str_out += \"SC_\" + Tab_obj_grid_search[i] + \"_min#NMF#\" + vals[x].substring(2) + \"@NMF@\";\r\n");
       $nm_saida->saida("                         }\r\n");
       $nm_saida->saida("                         if (vals[x].substring(0, 2) == \"S:\") {\r\n");
       $nm_saida->saida("                             str_out += \"SC_\" + Tab_obj_grid_search[i] + \"_seg#NMF#\" + vals[x].substring(2) + \"@NMF@\";\r\n");
       $nm_saida->saida("                         }\r\n");
       $nm_saida->saida("                     }\r\n");
       $nm_saida->saida("                     if (tvals[1])\r\n");
       $nm_saida->saida("                     {\r\n");
       $nm_saida->saida("                         vals  = tvals[1].split(\"_VLS_\");\r\n");
       $nm_saida->saida("                         for (x = 0; x < vals.length; x++)\r\n");
       $nm_saida->saida("                         {\r\n");
       $nm_saida->saida("                             if (vals[x].substring(0, 2) == \"Y:\") {\r\n");
       $nm_saida->saida("                                 str_out += \"SC_\" + Tab_obj_grid_search[i] + \"_input_2_ano#NMF#\" + vals[x].substring(2) + \"@NMF@\";\r\n");
       $nm_saida->saida("                             }\r\n");
       $nm_saida->saida("                             if (vals[x].substring(0, 2) == \"M:\") {\r\n");
       $nm_saida->saida("                                 str_out += \"SC_\" + Tab_obj_grid_search[i] + \"_input_2_mes#NMF#\" + vals[x].substring(2) + \"@NMF@\";\r\n");
       $nm_saida->saida("                             }\r\n");
       $nm_saida->saida("                             if (vals[x].substring(0, 2) == \"D:\") {\r\n");
       $nm_saida->saida("                                 str_out += \"SC_\" + Tab_obj_grid_search[i] + \"_input_2_dia#NMF#\" + vals[x].substring(2) + \"@NMF@\";\r\n");
       $nm_saida->saida("                             }\r\n");
       $nm_saida->saida("                             if (vals[x].substring(0, 2) == \"H:\") {\r\n");
       $nm_saida->saida("                                 str_out += \"SC_\" + Tab_obj_grid_search[i] + \"_input_2_hor#NMF#\" + vals[x].substring(2) + \"@NMF@\";\r\n");
       $nm_saida->saida("                             }\r\n");
       $nm_saida->saida("                             if (vals[x].substring(0, 2) == \"I:\") {\r\n");
       $nm_saida->saida("                                 str_out += \"SC_\" + Tab_obj_grid_search[i] + \"_input_2_min#NMF#\" + vals[x].substring(2) + \"@NMF@\";\r\n");
       $nm_saida->saida("                             }\r\n");
       $nm_saida->saida("                             if (vals[x].substring(0, 2) == \"S:\") {\r\n");
       $nm_saida->saida("                                 str_out += \"SC_\" + Tab_obj_grid_search[i] + \"_input_2_seg#NMF#\" + vals[x].substring(2) + \"@NMF@\";\r\n");
       $nm_saida->saida("                             }\r\n");
       $nm_saida->saida("                         }\r\n");
       $nm_saida->saida("                     }\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 if (Tab_obj_grid_search[i] == 'estado_actual')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     result  = grid_search_get_checkbox(obj_dyn + i);\r\n");
       $nm_saida->saida("                     tvals  = result.split(\"_VLS_\");\r\n");
       $nm_saida->saida("                     if (tvals[1])\r\n");
       $nm_saida->saida("                     {\r\n");
       $nm_saida->saida("                         str_out += \"SC_\" + Tab_obj_grid_search[i] + \"#NMF#_NM_array_\";\r\n");
       $nm_saida->saida("                         for (x = 0; x < tvals.length; x++)\r\n");
       $nm_saida->saida("                         {\r\n");
       $nm_saida->saida("                             str_out += \"#NMARR#\" + tvals[x];\r\n");
       $nm_saida->saida("                         }\r\n");
       $nm_saida->saida("                         str_out += \"@NMF@\";\r\n");
       $nm_saida->saida("                     }\r\n");
       $nm_saida->saida("                     else\r\n");
       $nm_saida->saida("                     {\r\n");
       $nm_saida->saida("                         str_out += \"SC_\" + Tab_obj_grid_search[i] + \"#NMF#\" + result + \"@NMF@\";\r\n");
       $nm_saida->saida("                     }\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         nmAjaxProcOn();\r\n");
       $nm_saida->saida("         $.ajax({\r\n");
       $nm_saida->saida("           type: \"POST\",\r\n");
       $nm_saida->saida("           url: \"index.php\",\r\n");
       $nm_saida->saida("           data: \"nmgp_opcao=ajax_filter_save&script_case_init=\" + document.Fgrid_search.script_case_init.value + \"&nmgp_save_name=\" + save_name + \"&nmgp_save_option=\" + save_opt + \"&NM_filters_save=\" + str_out + \"&nmgp_save_origem=grid\"\r\n");
       $nm_saida->saida("          })\r\n");
       $nm_saida->saida("          .done(function(json_save_fil) {\r\n");
       $nm_saida->saida("             var i, oResp;\r\n");
       $nm_saida->saida("             Tst_integrid = json_save_fil.trim();\r\n");
       $nm_saida->saida("             if (\"{\" != Tst_integrid.substr(0, 1)) {\r\n");
       $nm_saida->saida("                 nmAjaxProcOff();\r\n");
       $nm_saida->saida("                 alert (json_save_fil);\r\n");
       $nm_saida->saida("                 return;\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             eval(\"oResp = \" + json_save_fil);\r\n");
       $nm_saida->saida("             if (oResp[\"ss_time_out\"]) {\r\n");
       $nm_saida->saida("                 nmAjaxProcOff();\r\n");
       $nm_saida->saida("                 nm_move();\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             if (oResp[\"setValue\"]) {\r\n");
       $nm_saida->saida("               for (i = 0; i < oResp[\"setValue\"].length; i++) {\r\n");
       $nm_saida->saida("                    $(\"#\" + oResp[\"setValue\"][i][\"field\"]).html(oResp[\"setValue\"][i][\"value\"]);\r\n");
       $nm_saida->saida("               }\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             if (oResp[\"htmOutput\"]) {\r\n");
       $nm_saida->saida("                 nmAjaxShowDebug(oResp);\r\n");
       $nm_saida->saida("              }\r\n");
       $nm_saida->saida("             document.getElementById('SC_nmgp_save_name').value = '';\r\n");
       $nm_saida->saida("             document.getElementById('Apaga_filters').style.display = '';\r\n");
       $nm_saida->saida("             document.getElementById('id_sel_recup_filters').style.display = '';\r\n");
       $nm_saida->saida("             document.getElementById('Salvar_filters').style.display = 'none';\r\n");
       $nm_saida->saida("             document.getElementById('id_sel_recup_filters').selectedIndex = -1;\r\n");
       $nm_saida->saida("             document.getElementById('sel_filters_del').selectedIndex = -1;\r\n");
       $nm_saida->saida("             nmAjaxProcOff();\r\n");
       $nm_saida->saida("         });\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_del_grid_search()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        obj_sel = document.Fgrid_search_save.elements['NM_filters_del'];\r\n");
       $nm_saida->saida("        index   = obj_sel.selectedIndex;\r\n");
       $nm_saida->saida("        if (index == -1 || obj_sel.options[index].value == \"\") \r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            return false;\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        parm = obj_sel.options[index].value;\r\n");
       $nm_saida->saida("        nmAjaxProcOn();\r\n");
       $nm_saida->saida("        $.ajax({\r\n");
       $nm_saida->saida("          type: \"POST\",\r\n");
       $nm_saida->saida("          url: \"index.php\",\r\n");
       $nm_saida->saida("          data: \"nmgp_opcao=ajax_filter_delete&script_case_init=\" + document.Fgrid_search.script_case_init.value + \"&NM_filters_del=\" + parm + \"&nmgp_save_origem=grid\"\r\n");
       $nm_saida->saida("         })\r\n");
       $nm_saida->saida("         .done(function(json_del_fil) {\r\n");
       $nm_saida->saida("            var i, oResp;\r\n");
       $nm_saida->saida("            Tst_integrid = json_del_fil.trim();\r\n");
       $nm_saida->saida("            if (\"{\" != Tst_integrid.substr(0, 1)) {\r\n");
       $nm_saida->saida("                nmAjaxProcOff();\r\n");
       $nm_saida->saida("                alert (json_del_fil);\r\n");
       $nm_saida->saida("                return;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            eval(\"oResp = \" + json_del_fil);\r\n");
       $nm_saida->saida("             if (oResp[\"ss_time_out\"]) {\r\n");
       $nm_saida->saida("                 nmAjaxProcOff();\r\n");
       $nm_saida->saida("                 nm_move();\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("            if (oResp[\"setValue\"]) {\r\n");
       $nm_saida->saida("              for (i = 0; i < oResp[\"setValue\"].length; i++) {\r\n");
       $nm_saida->saida("                   $(\"#\" + oResp[\"setValue\"][i][\"field\"]).html(oResp[\"setValue\"][i][\"value\"]);\r\n");
       $nm_saida->saida("              }\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            if (oResp[\"htmOutput\"]) {\r\n");
       $nm_saida->saida("                nmAjaxShowDebug(oResp);\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            nmAjaxProcOff();\r\n");
       $nm_saida->saida("        });\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_change_grid_search(obj_sel)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        index = obj_sel.selectedIndex;\r\n");
       $nm_saida->saida("        if (index == -1 || obj_sel.options[index].value == \"\") \r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            return false;\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        for (i = 1; i <= Tot_obj_grid_search; i++)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#grid_search_' + Tab_obj_grid_search[i]).remove();\r\n");
       $nm_saida->saida("             eval('Dropdownchecklist_'+ Tab_obj_grid_search[i] +'=false;');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        Tot_obj_grid_search = 0;\r\n");
       $nm_saida->saida("        Tab_obj_grid_search = new Array();\r\n");
       $nm_saida->saida("        ajax_navigate_res('grid_search_change_fil_res', obj_sel.options[index].value);;\r\n");
       $nm_saida->saida("        obj_sel.selectedIndex = 0;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function grid_search_get_sel_cond(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var index = document.getElementById(obj_id).selectedIndex;\r\n");
       $nm_saida->saida("        return document.getElementById(obj_id).options[index].value;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function grid_search_get_select(obj_id, str_type)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        if(str_type == '')\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            var obj = document.getElementById(obj_id);\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        else\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            var obj = $('#' + obj_id).multipleSelect('getSelects');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        var val = \"\";\r\n");
       $nm_saida->saida("        for (iSelect = 0; iSelect < obj.length; iSelect++)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            if ((str_type == '' && obj[iSelect].selected) || (str_type=='RADIO' || str_type=='CHECKBOX'))\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                if(str_type == '' && obj[iSelect].selected)\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    new_val = obj[iSelect].value;\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("                else\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    new_val = obj[iSelect];\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("                val += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("                val += new_val;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function grid_search_get_Dselelect(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var obj = document.getElementById(obj_id);\r\n");
       $nm_saida->saida("        var val = \"\";\r\n");
       $nm_saida->saida("        for (iSelect = 0; iSelect < obj.length; iSelect++)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            val += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("            val += obj[iSelect].value;\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function grid_search_get_radio(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var Nobj = document.getElementById(obj_id).name;\r\n");
       $nm_saida->saida("        var obj  = document.getElementsByName(Nobj);\r\n");
       $nm_saida->saida("        var val  = \"\";\r\n");
       $nm_saida->saida("        for (iRadio = 0; iRadio < obj.length; iRadio++)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            if (obj[iRadio].checked)\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("                val += obj[iRadio].value;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function grid_search_get_checkbox(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var Nobj = document.getElementById(obj_id).name;\r\n");
       $nm_saida->saida("        var obj  = document.getElementsByName(Nobj);\r\n");
       $nm_saida->saida("        var val  = \"\";\r\n");
       $nm_saida->saida("        if (!obj.length)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            if (obj.checked)\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val = obj.value;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            return val;\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        else\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            for (iCheck = 0; iCheck < obj.length; iCheck++)\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                if (obj[iCheck].checked)\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    val += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("                    val += obj[iCheck].value;\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function grid_search_get_text(obj_id, obj_ac)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var obj = document.getElementById(obj_id);\r\n");
       $nm_saida->saida("        var val = \"\";\r\n");
       $nm_saida->saida("        if (obj)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            val = obj.value;\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        if (obj_ac != '' && val == '')\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            obj = document.getElementById(obj_ac);\r\n");
       $nm_saida->saida("            if (obj)\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val = obj.value;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function grid_search_get_dt_h(obj_id, ind, TP)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var val = new Array();\r\n");
       $nm_saida->saida("        if (TP == 'DT' || TP == 'DH')\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            obj_part  = document.getElementById(obj_id + '_ano_val_' + ind);\r\n");
       $nm_saida->saida("            val      += \"Y:\";\r\n");
       $nm_saida->saida("            if (obj_part && obj_part.type.substr(0, 6) == 'select')\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                Tval = grid_search_get_sel_cond(obj_id + '_ano_val_' + ind);\r\n");
       $nm_saida->saida("                val += (Tval != -1) ? Tval : '';\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            else\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            obj_part  = document.getElementById(obj_id + '_mes_val_' + ind);\r\n");
       $nm_saida->saida("            val      += \"_VLS_M:\";\r\n");
       $nm_saida->saida("            if (obj_part && obj_part.type.substr(0, 6) == 'select')\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                Tval = grid_search_get_sel_cond(obj_id + '_mes_val_' + ind);\r\n");
       $nm_saida->saida("                val += (Tval != -1) ? Tval : '';\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            else\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            obj_part  = document.getElementById(obj_id + '_dia_val_' + ind);\r\n");
       $nm_saida->saida("            val      += \"_VLS_D:\";\r\n");
       $nm_saida->saida("            if (obj_part && obj_part.type.substr(0, 6) == 'select')\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                Tval = grid_search_get_sel_cond(obj_id + '_dia_val_' + ind);\r\n");
       $nm_saida->saida("                val += (Tval != -1) ? Tval : '';\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            else\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        if (TP == 'HH' || TP == 'DH')\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            val            += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("            obj_part        = document.getElementById(obj_id + '_hor_val_' + ind);\r\n");
       $nm_saida->saida("            val            += \"H:\";\r\n");
       $nm_saida->saida("            val            += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("            obj_part        = document.getElementById(obj_id + '_min_val_' + ind);\r\n");
       $nm_saida->saida("            val            += \"_VLS_I:\";\r\n");
       $nm_saida->saida("            val            += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("            obj_part        = document.getElementById(obj_id + '_seg_val_' + ind);\r\n");
       $nm_saida->saida("            val            += \"_VLS_S:\";\r\n");
       $nm_saida->saida("            val            += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("   </script>\r\n");
   }
function saludo($par_quien) {
$_SESSION['scriptcase']['grid_agenda_cliente']['contr_erro'] = 'on';
  
    echo "Hola, $par_quien";

$_SESSION['scriptcase']['grid_agenda_cliente']['contr_erro'] = 'off';
}
function sis_mensaje($par_mensaje = 'mensaje') {
$_SESSION['scriptcase']['grid_agenda_cliente']['contr_erro'] = 'on';
  
    $cad = "<div id='caja_mensaje' ";
    $cad .= "style='background-color: darkgrey;color: white;width: 600px;margin: 0 auto;";
    $cad .= "padding: 2px;margin: 10px auto;border: 1px solid black;border-radius: 20px;text-align: center;'>";
    $cad .= "<h2>";
    $cad .= $par_mensaje;
    $cad .= "</h2>";
    $cad .= "</div>";
    echo $cad;

$_SESSION['scriptcase']['grid_agenda_cliente']['contr_erro'] = 'off';
}
}
?>
