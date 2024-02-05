<?php

class Grafico_pais_grafico
{
    const GROUPBY_ORIGINAL = 1;
    const GROUPBY_COMPARISON = 2;
    const GROUPBY_PERC_CHANGE = 3;
    const CHART_MODE_SYNTHETIC = 1;
    const CHART_MODE_ANALYTIC = 2;
    var $chartTheme;

   var $Db;
   var $Ini;
   var $Erro;
   var $Lookup;

   var $nm_data;
   var $total;
   var $array_datay_geral;
   var $array_label_geral;
   var $array_datay;
   var $array_label;
   var $campo;
   var $campo_val;
   var $comando;
   var $label;
   var $list_titulo;
   var $max_size_datay;
   var $max_size_label;
   var $total_datay;
   var $nivel;
   var $titulo;
   var $Decimais;
   var $sc_proc_grid; 
   var $sc_graf_sint = false;
   var $graf_cor_fundo;
   var $graf_cor_margens;
   var $graf_cor_label;
   var $graf_cor_valores;
   var $graf_tipo_marcas;
   var $NM_tit_val;
   var $NM_ind_val;

   var $reload_as_analytic = false;

   //---- 
   function __construct()
   {
      $this->nm_data = new nm_data("es");
   }

	function generateChartImage($chartKey) {
		$this->monta_grafico($chartKey, 'pdf');
	} // generateChartImage

    function info_initializeChart($chartMd5, $isExport = false)
    {
        $this->info_initializeInfo($chartMd5);

        $this->info_loadMd5Info($chartMd5);
        $this->info_loadSessionInfo($chartMd5);
        $this->info_setSeriesMode();
        $this->info_setChartItemsLimit();
        $this->info_createFusionChartsData($isExport);

        $this->info_saveFusionChartsJson();
    }

    function info_initializeInfo($chartMd5)
    {
        $charset = <<<SCEOT
<META http-equiv="Content-Type" content="text/html; charset={$_SESSION['scriptcase']['charset_html']}" />
SCEOT;

        $this->SC_APP_info = [
            'chart' => [
                'page_title' => '',
                'available_types' => ['Bar'],
                'available_comparison_types' => ['Bar'],
                'default_type' => 'Bar',
                'available_modes' => ['synthetic', 'analytic'],
                'default_mode' => 'synthetic',
                'json_filename' => "sc_fc_Grafico_pais_{$chartMd5}.json",
                'json_base_dir' => $this->Ini->root . $this->Ini->path_imag_temp . '/',
                'json_base_url' => $this->Ini->path_imag_temp . '/',
            ],
            'types' => [
                'bar' => [
                    'orientation' => 'Vertical',
                    'dimension' => '2d',
                    'plotSpacePercent' => '',
                    'rotateValues' => '1',
                    'placeValuesInside' => '1',
                    'stacking' => false,
                    'stack100Percent' => '0',
                    'seriesMode' => 'Normal',
                ],
            ],
            'options' => [
                'charset' => $charset,
                'favicon' => 'scriptcase__NM__ico__NM__favicon.ico',
                'summary_css' => isset($_POST['summary_css']) && '' != $_POST['summary_css'] ? $_POST['summary_css'] : '',
                'use_fontawesome' => true,
                'tooltip_expanded' => true,
                'formatNumberScale' => false,
                'legendPosition' => '',
                'setAdaptiveYMin' => true,
            ],
            'css' => [
                'chart_page' => 'scGridPage',
            ],
        ];
    }

    function info_initializeData()
    {
        $this->SC_APP_data = [
            'type' => '',
            'order' => '',
            'width' => '1200',
            'height' => '600',
            'data_mode' => '',
            'series_mode' => '',
            'md5_data' => [],
            'chart_id' => 'id_chart_' . mt_rand(1, 1000),
            'chart_div' => 'id_div_' . mt_rand(1, 1000),
            'chart_dataFormat' => 'jsonurl',
            'license_key' => 'HA-8E3A-64coB5A2D4E1D4E4D3A11B11A5C3A1A1lC-7wA1B9xD-13lrgA2D3vbsC5E3D4A1E1I1B2B8D7A6E1F5C4I2D1A4juwE2B4G1C-7G1A7C8rqg1C4D1I4njyB5D6D3bzfG2C9A4C6A1B4A1C3D1J2B3yqsD1B1ZA33egvD8D5B4oC-8D3QA16A7jteE3A3H2E3A9C10C6C3C4E4A2H3F3C2B-16==',
            'license_creditLabel' => 'false',
            'limit_chart_items' => '',
            'filtered_chart_items' => [],
            'fusioncharts_license' => [],
            'fusioncharts_javascript' => [],
            'fusioncharts_json' => [],
        ];

        if ($this->aux_isResponsive()) {
            $this->SC_APP_data['width'] = '100%';
            $this->SC_APP_data['height'] = '75%';
        } elseif ($this->aux_isMobile()) {
            $this->SC_APP_data['width'] = '100%';
        }
    }

    function info_loadMd5Info($chartMd5)
    {
        $this->SC_APP_data['md5_data'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['chart_info'] [$chartMd5];

        $pageTitle = $this->aux_isUtf8() ? $this->SC_APP_data['md5_data'] ['metric'] ['label'] : sc_convert_encoding($this->SC_APP_data['md5_data'] ['metric'] ['label'], $_SESSION['scriptcase'] ['charset'], 'UTF-8');

        $this->SC_APP_info['chart'] ['page_title'] = $pageTitle;
        $this->SC_APP_data['type'] = $this->SC_APP_info['chart'] ['default_type'];
        $this->SC_APP_data['data_mode'] = $this->SC_APP_info['chart'] ['default_mode'];
    }

    function info_loadSessionInfo($chartMd5)
    {
        $this->SC_APP_data['type'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_tipo'];
        $this->SC_APP_data['data_mode'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['graf_opc_atual'];

        $this->SC_APP_data['width'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_larg'];
        $this->SC_APP_data['height'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_alt'];

        $this->SC_APP_data['order'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['graf_order'];

        $this->SC_APP_info['types'] ['bar'] ['orientation'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_barra_orien'];
        $this->SC_APP_info['types'] ['bar'] ['dimension'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_barra_dimen'];
        $this->SC_APP_info['types'] ['bar'] ['stacking'] = 'Off' != $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_barra_empil'];
        $this->SC_APP_info['types'] ['bar'] ['stack100Percent'] = 'Percent' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_barra_empil'] ? '1' : '0';
        $this->SC_APP_info['types'] ['bar'] ['seriesMode'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_barra_agrup'];

        $this->SC_APP_info['types'] ['funnel'] ['dimension'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_funil_dimen'];

        $this->SC_APP_info['types'] ['gauge'] ['format'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_gauge_forma'];

        $this->SC_APP_info['types'] ['line'] ['format'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_linha_forma'];
        $this->SC_APP_info['types'] ['line'] ['seriesMode'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_linha_agrup'];

        $this->SC_APP_info['types'] ['pie'] ['format'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_pizza_forma'];
        $this->SC_APP_info['types'] ['pie'] ['dimension'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_pizza_dimen'];
        $this->SC_APP_info['types'] ['pie'] ['order'] = strtolower($_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_pizza_orden']);
        $this->SC_APP_info['types'] ['pie'] ['showPercentValues'] = 'Percent' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_pizza_valor'];

        $this->SC_APP_info['types'] ['pyramid'] ['dimension'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_pyram_dimen'];
        $this->SC_APP_info['types'] ['pyramid'] ['showPercentValues'] = 'Percent' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_pyram_valor'];
        $this->SC_APP_info['types'] ['pyramid'] ['isSliced'] = 'S' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['cfg_graf'] ['graf_pyram_forma'];
    }

    function info_setSeriesMode()
    {
        switch ($this->SC_APP_data['type']) {
            case 'Bar':
                if ('Series' == $this->SC_APP_info['types'] ['bar'] ['seriesMode']) {
                    $this->SC_APP_data['series_mode'] = 'serie';
                } else {
                    $this->SC_APP_data['series_mode'] = 'set';
                }
                break;

            case 'Line':
                if ('Series' == $this->SC_APP_info['types'] ['line'] ['seriesMode']) {
                    $this->SC_APP_data['series_mode'] = 'serie';
                } else {
                    $this->SC_APP_data['series_mode'] = 'set';
                }
                break;

            default:
                $this->SC_APP_data['series_mode'] = 'set';
                break;
        }
    }

    function info_setChartItemsLimit()
    {
        if ($_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['has_limit_chart_items']) {
            if ('' != $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['limit_chart_items'] && '0' != $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['limit_chart_items']) {
                $this->SC_APP_data['limit_chart_items'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['limit_chart_items'];
            } elseif (isset($this->SC_APP_data['md5_data'] ['options'] ['limit_chart_items']) && '' != $this->SC_APP_data['md5_data'] ['options'] ['limit_chart_items']) {
                $this->SC_APP_data['limit_chart_items'] = $this->SC_APP_data['md5_data'] ['options'] ['limit_chart_items'];
            }
        }
    }

    function info_createFusionChartsData($isExport)
    {
        $this->info_createFusionChartsData_json($isExport);
        $this->info_createFusionChartsData_javascript();
        $this->info_createFusionChartsData_license();
    }

    function info_createFusionChartsData_license()
    {
        $this->SC_APP_data['fusioncharts_license'] ['key'] = 'HA-8E3A-64coB5A2D4E1D4E4D3A11B11A5C3A1A1lC-7wA1B9xD-13lrgA2D3vbsC5E3D4A1E1I1B2B8D7A6E1F5C4I2D1A4juwE2B4G1C-7G1A7C8rqg1C4D1I4njyB5D6D3bzfG2C9A4C6A1B4A1C3D1J2B3yqsD1B1ZA33egvD8D5B4oC-8D3QA16A7jteE3A3H2E3A9C10C6C3C4E4A2H3F3C2B-16==';
        $this->SC_APP_data['fusioncharts_license'] ['creditLabel'] = 'false';
    }

    function info_createFusionChartsData_javascript()
    {
        $this->SC_APP_data['fusioncharts_javascript'] ['type'] = $this->aux_getFusionChartsRenderer();
        $this->SC_APP_data['fusioncharts_javascript'] ['width'] = $this->SC_APP_data['width'];
        $this->SC_APP_data['fusioncharts_javascript'] ['height'] = $this->SC_APP_data['height'];
        $this->SC_APP_data['fusioncharts_javascript'] ['dataFormat'] = 'jsonurl';
        $this->SC_APP_data['fusioncharts_javascript'] ['dataSource'] = $this->SC_APP_info['chart'] ['json_base_url'] . $this->SC_APP_info['chart'] ['json_filename'];

        if ($this->aux_isResponsive()) {
            $this->SC_APP_data['fusioncharts_javascript'] ['width'] = '100%';
            $this->SC_APP_data['fusioncharts_javascript'] ['height'] = '75%';
        } elseif ($this->aux_isMobile()) {
            $this->SC_APP_data['fusioncharts_javascript'] ['width'] = '100%';
        }
    }

    function info_createFusionChartsData_json($isExport)
    {
        $this->info_createFusionChartsData_json_chart($isExport);

        switch ($this->SC_APP_data['type']) {
            case 'Area':
                $this->info_createFusionChartsData_json_type_area();
                break;
            case 'Bar':
                $this->info_createFusionChartsData_json_type_bar();
                break;
            case 'Funnel':
                $this->info_createFusionChartsData_json_type_funnel();
                break;
            case 'Gauge':
                $this->info_createFusionChartsData_json_type_gauge();
                break;
            case 'Line':
                $this->info_createFusionChartsData_json_type_line();
                break;
            case 'Pie':
                $this->info_createFusionChartsData_json_type_pie();
                break;
            case 'Pyramid':
                $this->info_createFusionChartsData_json_type_pyramid();
                break;
            case 'Radar':
                $this->info_createFusionChartsData_json_type_radar();
                break;
        }

        $this->info_createFusionChartsData_json_data_series();

        $this->info_createFusionChartsData_json_data_order();
    }

    function info_createFusionChartsData_json_chart($isExport)
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] = [
            'caption' => $this->SC_APP_data['md5_data'] ['metric'] ['label'],
            'subCaption' => $this->info_createFusionChartsData_json_chart_subtitle(),
            'xAxisName' => $this->SC_APP_data['md5_data'] ['dimension'] ['label'],
            'yAxisName' => $this->SC_APP_data['md5_data'] ['metric'] ['label'],
        ];

        if ($this->SC_APP_info['options'] ['formatNumberScale']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['formatNumberScale'] = '1';
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['numberScaleValue'] = '1000,1000,1000,1000';
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['numberScaleUnit']  = 'K,M,G,T';
        } else {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['formatNumberScale'] = '0';
        }

        if ($this->SC_APP_info['options'] ['setAdaptiveYMin']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['setAdaptiveYMin'] = '1';
        }

        $this->info_createFusionChartsData_json_chart_theme();

        if ('below' == $this->SC_APP_info['options'] ['legendPosition']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['legendPosition'] = 'bottom';
        } elseif ('right' == $this->SC_APP_info['options'] ['legendPosition']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['legendPosition'] = 'right';
        } elseif ('hide' == $this->SC_APP_info['options'] ['legendPosition']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLegend'] = '0';
        }

        if ($isExport) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['animation'] = '0';
        }
    }

    function info_createFusionChartsData_json_chart_subtitle()
    {
        $parameters = [];

        foreach ($this->SC_APP_data['md5_data'] ['parameters'] as $parameterInfo) {
            $parameters[] = "{$parameterInfo['field_label']} = {$parameterInfo['label']}";
        }

        return implode(' :: ', $parameters);
    }

    function info_createFusionChartsData_json_chart_theme()
    {
        $this->chartTheme = $this->load_chart_theme();

        foreach ($this->chartTheme as $property => $value) {
            if ('' != $value) {
                $this->SC_APP_data['fusioncharts_json'] ['chart'] [$property] = $value; 
            }
        }
    }

    function info_createFusionChartsData_json_type_area()
    {
    }

    function info_createFusionChartsData_json_type_bar()
    {
        if ('' != $this->SC_APP_info['types'] ['bar'] ['plotSpacePercent']) {
            if (20 > $this->SC_APP_info['types'] ['bar'] ['plotSpacePercent']) {
                $this->SC_APP_data['fusioncharts_json'] ['chart'] ['plotSpacePercent'] = '20';
            } elseif (80 < $this->SC_APP_info['types'] ['bar'] ['plotSpacePercent']) {
                $this->SC_APP_data['fusioncharts_json'] ['chart'] ['plotSpacePercent'] = '80';
            } else {
                $this->SC_APP_data['fusioncharts_json'] ['chart'] ['plotSpacePercent'] = $this->SC_APP_info['types'] ['bar'] ['plotSpacePercent'];
            }
        }
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['rotateValues'] = $this->SC_APP_info['types'] ['bar'] ['rotateValues'];
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['placeValuesInside'] = $this->SC_APP_info['types'] ['bar'] ['placeValuesInside'];
        if (1 == $this->SC_APP_info['types'] ['bar'] ['stack100Percent'] && $this->aux_isMultiSeries()) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['stack100Percent'] = '1';
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showPercentValues'] = '0';
        }
    }

    function info_createFusionChartsData_json_type_funnel()
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['useSameSlantAngle'] = '1';
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['isHollow'] = '0';
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLegend'] = '1';
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLabels'] = '0';
        if ('2d' == $this->SC_APP_info['types'] ['funnel'] ['dimension']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['is2D'] = '1';
        }
        if ('0' == $this->SC_APP_info['types'] ['funnel'] ['streamlinedData']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['streamlinedData'] = '0';
        }
    }

    function info_createFusionChartsData_json_type_gauge()
    {
        if ('Circular' == $this->SC_APP_info['types'] ['gauge'] ['format']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['gaugeStartAngle'] = '180';
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['gaugeEndAngle'] = '-180';
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['lowerLimitDisplay'] = ' ';
        }
    }

    function info_createFusionChartsData_json_type_line()
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLegend'] = '0';
    }

    function info_createFusionChartsData_json_type_pie()
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLegend'] = '1';
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['use3DLighting'] = '0';
        if ($this->SC_APP_info['types'] ['pie'] ['showPercentValues']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showPercentValues'] = '1';
        } else {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showPercentValues'] = '0';
        }
    }

    function info_createFusionChartsData_json_type_pyramid()
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLegend'] = '1';
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLabels'] = '0';
        if ('2d' == $this->SC_APP_info['types'] ['pyramid'] ['dimension']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['is2D'] = '1';
        }
        if ($this->SC_APP_info['types'] ['pyramid'] ['showPercentValues']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showPercentValues'] = '1';
        } else {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showPercentValues'] = '0';
        }
        if ($this->SC_APP_info['types'] ['pyramid'] ['isSliced']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['isSliced'] = '1';
        } else {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['isSliced'] = '0';
        }
    }

    function info_createFusionChartsData_json_type_radar()
    {
    }

    function info_createFusionChartsData_json_data_series()
    {
        if (0 < $this->SC_APP_data['limit_chart_items']) {
            $this->aux_filterChartItems();
        }

        if ($this->SC_APP_data['md5_data'] ['options'] ['is_comparison']) {
            $this->info_createFusionChartsData_json_data_comparisonSeries();
        } elseif ('Line' == $this->SC_APP_data['type'] && 'Step' == $this->SC_APP_info['types'] ['line'] ['format'] && !$this->aux_isMultiSeries()) {
            $this->info_createFusionChartsData_json_data_singleSerieCategorySeries();
        } elseif ('Gauge' == $this->SC_APP_data['type']) {
            $this->info_createFusionChartsData_json_data_gaugeSeries();
        } elseif ('Radar' == $this->SC_APP_data['type']) {
            if (self::CHART_MODE_SYNTHETIC == $this->SC_APP_data['data_mode']) {
                $this->info_createFusionChartsData_json_data_singleSerieCategorySeries();
            } else {
                $this->info_createFusionChartsData_json_data_multiSeries();
            }
        } elseif ($this->aux_isMultiSeries()) {
            $this->info_createFusionChartsData_json_data_multiSeries();
        } else {
            $this->info_createFusionChartsData_json_data_singleSeries();
        }
    }

    function info_createFusionChartsData_json_data_singleSeries()
    {
        $this->SC_APP_data['fusioncharts_json'] ['data'] = [];

        foreach ($this->SC_APP_data['md5_data'] ['data_synthetic'] [self::GROUPBY_ORIGINAL] as $plotInfo) {
            $addItem = true;

            if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $thisData = [
                    'label' => $plotInfo['label'],
                    'value' => $plotInfo['value'],
                ];

                if ($this->SC_APP_info['options'] ['tooltip_expanded']) {
                    $thisData['tooltext'] = "<b>{$this->SC_APP_data['md5_data'] ['dimension'] ['label']}</b>";
                    $thisData['tooltext'] .= "<br>";
                    $thisData['tooltext'] .= "<b>{$plotInfo['label']}</b>";
                    $thisData['tooltext'] .= "<br><br>";
                    $thisData['tooltext'] .= "<b>{$this->SC_APP_data['md5_data'] ['metric'] ['label']}</b>: {$plotInfo['value']}";
                }

                $this->SC_APP_data['fusioncharts_json'] ['data'] [] = $thisData;
            }
        }
    }

    function info_createFusionChartsData_json_data_multiSeries()
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLegend'] = '1';

        $this->SC_APP_data['fusioncharts_json'] ['categories'] = [];
        $this->SC_APP_data['fusioncharts_json'] ['dataset'] = [];

        $category = [];
        foreach ($this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['categories'] as $categoryLabel) {
            $addItem = true;

            if ('set' == $this->SC_APP_data['series_mode'] && !empty($this->SC_APP_data['filtered_chart_items']) && !in_array($categoryLabel, $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $category[] = [
                    'label' => $categoryLabel,
                ];
            }
        }
        $this->SC_APP_data['fusioncharts_json'] ['categories'] [] = [
            'category' => $category,
        ];

        foreach ($this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['dataset'] as $seriesValue => $seriesInfo) {
            $data = [];

            foreach ($seriesInfo['data'] as $plotValue => $plotInfo) {
                $addItem = true;

                if ('set' == $this->SC_APP_data['series_mode'] && !empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                    $addItem = false;
                } elseif ('serie' == $this->SC_APP_data['series_mode'] && !empty($this->SC_APP_data['filtered_chart_items']) && !in_array($seriesInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                    $addItem = false;
                }

                if ($addItem) {
                    $thisData = [
                        'value' => $plotInfo['value'],
                    ];

                    if ($this->SC_APP_info['options'] ['tooltip_expanded']) {
                        $thisData['tooltext'] = "<b>{$this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['field_name'] ['x_axys']}</b>";
                        $thisData['tooltext'] .= "<br>";
                        $thisData['tooltext'] .= "<b>{$plotInfo['label']}</b>";
                        $thisData['tooltext'] .= "<br><br>";
                        $thisData['tooltext'] .= "<b>{$this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['field_name'] ['legend']}</b>: {$seriesInfo['label']}";
                        $thisData['tooltext'] .= "<br>";
                        $thisData['tooltext'] .= "<b>{$this->SC_APP_data['md5_data'] ['metric'] ['label']}</b>: {$plotInfo['value']}";
                    }

                    $data[] = $thisData;
                }
            }

            $addItem = true;

            if ('serie' == $this->SC_APP_data['series_mode'] && !empty($this->SC_APP_data['filtered_chart_items']) && !in_array($seriesInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $this->SC_APP_data['fusioncharts_json'] ['dataset'] [] = [
                    'seriesName' => $seriesInfo['label'],
                    'data' => $data,
                ];
            }
        }
    }

    function info_createFusionChartsData_json_data_comparisonSeries()
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLegend'] = '1';

        $this->SC_APP_data['fusioncharts_json'] ['categories'] = [];
        $this->SC_APP_data['fusioncharts_json'] ['dataset'] = [];

        $category = [];
        foreach ($this->SC_APP_data['md5_data'] ['data_synthetic'] [self::GROUPBY_ORIGINAL] as $plotInfo) {
            $addItem = true;

            if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $category[] = [
                    'label' => $plotInfo['label'],
                ];
            }
        }
        $this->SC_APP_data['fusioncharts_json'] ['categories'] [] = [
            'category' => $category,
        ];

        foreach ($this->SC_APP_data['md5_data'] ['data_synthetic'] as $seriesIndex => $seriesInfo) {
            $data = [];

            foreach ($seriesInfo as $plotInfo) {
                $addItem = true;
    
                if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                    $addItem = false;
                }
    
                if ($addItem) {
                    $thisData = [
                        'value' => $plotInfo['value'],
                    ];
    
                    if ($this->SC_APP_info['options'] ['tooltip_expanded']) {
                        $thisData['tooltext'] = "<b>{$this->SC_APP_data['md5_data'] ['dimension'] ['label']}</b>";
                        $thisData['tooltext'] .= "<br>";
                        $thisData['tooltext'] .= "<b>{$plotInfo['label']}</b>";
                        $thisData['tooltext'] .= "<br><br>";
                        $thisData['tooltext'] .= "<b>{$this->SC_APP_data['md5_data'] ['options'] ['comparison_field_label']}</b>: {$this->SC_APP_data['md5_data'] ['options'] ['series_name'] [$seriesIndex]}";
                        $thisData['tooltext'] .= "<br>";
                        $thisData['tooltext'] .= "<b>{$this->SC_APP_data['md5_data'] ['metric'] ['label']}</b>: {$plotInfo['value']}";
                    }
    
                    $data[] = $thisData;
                }
            }

            $this->SC_APP_data['fusioncharts_json'] ['dataset'] [] = [
                'seriesName' => $this->SC_APP_data['md5_data'] ['options'] ['series_name'] [$seriesIndex],
                'data' => $data,
            ];
        }
    }

    function info_createFusionChartsData_json_data_singleSerieCategorySeries()
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLegend'] = '0';

        $this->SC_APP_data['fusioncharts_json'] ['categories'] = [];
        $this->SC_APP_data['fusioncharts_json'] ['dataset'] = [];

        $category = [];
        foreach ($this->SC_APP_data['md5_data'] ['data_synthetic'] [self::GROUPBY_ORIGINAL] as $plotInfo) {
            $addItem = true;

            if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $category[] = [
                    'label' => $plotInfo['label'],
                ];
            }
        }
        $this->SC_APP_data['fusioncharts_json'] ['categories'] [] = [
            'category' => $category,
        ];

        $data = [];
        foreach ($this->SC_APP_data['md5_data'] ['data_synthetic'] [self::GROUPBY_ORIGINAL] as $plotInfo) {
            $addItem = true;

            if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $data[] = [
                    'value' => $plotInfo['value'],
                ];
            }
        }
        $this->SC_APP_data['fusioncharts_json'] ['dataset'] [] = [
            'seriesName' => '0',
            'data' => $data,
        ];
    }

    function info_createFusionChartsData_json_data_gaugeSeries()
    {
        $this->SC_APP_data['fusioncharts_json'] ['dials'] = [];

        $gaugeMin = 0;
        $gaugeMax = 0;

        $dial = [];
        foreach ($this->SC_APP_data['md5_data'] ['data_synthetic'] [self::GROUPBY_ORIGINAL] as $plotInfo) {
            $addItem = true;

            if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $gaugeMin = min($gaugeMin, $plotInfo['value']);
                $gaugeMax = max($gaugeMax, $plotInfo['value']);
               
                $dial[] = [
                    'value' => $plotInfo['value'],
                    'tooltext' => "{$plotInfo['label']}: {$plotInfo['value']}",
                ];
            }
        }
        $this->SC_APP_data['fusioncharts_json'] ['dials'] = [
            'dial' => $dial,
        ];

        if (10 > $gaugeMax) {
            $gaugeMax = 10;
        }
        $gaugeMax = ceil($gaugeMax * 1.1);

        if (isset($this->chart_theme['css_chart_background_pallete_color']) && '' != $this->chart_theme['css_chart_background_pallete_color']) {
            $chartPallete = explode(',', $this->chart_theme['css_chart_background_pallete_color']);

            $this->SC_APP_data['fusioncharts_json'] ['colorRange'] = [
                'color' => [[
                    'minValue' => '0',
                    'maxValue' => $gaugeMax,
                    'code' => str_replace('#', '', $chartPallete[0])
                ]]
            ];
        } else {
            $this->SC_APP_data['fusioncharts_json'] ['colorRange'] = [
                'color' => [[
                    'minValue' => '0',
                    'maxValue' => $gaugeMax,
                    'code' => '9bc8f2'
                ]]
            ];
        }

        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['lowerLimit'] = $gaugeMin;
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['upperLimit'] = $gaugeMax;
    }

    function info_createFusionChartsData_json_data_order()
    {
        if ('Pie' == $this->SC_APP_data['type'] && 'off' != $this->SC_APP_info['types'] ['pie'] ['order']) {
            $this->aux_orderSerie($this->SC_APP_data['fusioncharts_json'] ['data'], $this->SC_APP_info['types'] ['pie'] ['order']);
            $this->aux_rearrangeOrderIndexes($this->SC_APP_data['fusioncharts_json'] ['data']);
        } elseif ('Line' == $this->SC_APP_data['type'] && 'Step' == $this->SC_APP_info['types'] ['line'] ['format'] && !$this->aux_isMultiSeries()) {
            $this->aux_orderSerie($this->SC_APP_data['fusioncharts_json'] ['dataset'] [0] ['data'], $this->SC_APP_data['order']);
            $this->aux_rearrangeOrderMultiIndexes($this->SC_APP_data['fusioncharts_json'] ['dataset'] [0] ['data'], $this->SC_APP_data['fusioncharts_json'] ['categories'] [0] ['category']);
        } elseif ('Radar' == $this->SC_APP_data['type'] && self::CHART_MODE_SYNTHETIC == $this->SC_APP_data['data_mode']) {
            $this->aux_orderSerie($this->SC_APP_data['fusioncharts_json'] ['dataset'] [0] ['data'], $this->SC_APP_data['order']);
            $this->aux_rearrangeOrderMultiIndexes($this->SC_APP_data['fusioncharts_json'] ['dataset'] [0] ['data'], $this->SC_APP_data['fusioncharts_json'] ['categories'] [0] ['category']);
        } elseif (!$this->aux_isMultiSeries() && !$this->SC_APP_data['md5_data'] ['options'] ['is_comparison'] && '' != $this->SC_APP_data['order'] && !in_array($this->SC_APP_data['type'], ['Gauge', 'Radar'])) {
            $this->aux_orderSerie($this->SC_APP_data['fusioncharts_json'] ['data'], $this->SC_APP_data['order']);
            $this->aux_rearrangeOrderIndexes($this->SC_APP_data['fusioncharts_json'] ['data']);
        }
    }

    function info_saveFusionChartsJson()
    {
        @file_put_contents(
            $this->SC_APP_info['chart'] ['json_base_dir'] . $this->SC_APP_info['chart'] ['json_filename'],
            json_encode($this->SC_APP_data['fusioncharts_json'])
        );
    }

    function display_summaryChart_inline_startUp()
    {
        $htmlCode = $this->display_chart_htmlFusionChartsLibrary();
        $htmlCode .= $this->display_chart_htmlFusionChartsDiv_inline();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_function();
        $htmlCode .= <<<SCEOT
    <span id="sc-summary-fusioncharts-placeholder">
    </span>

SCEOT;

        return $htmlCode;
    }

    function display_summaryChart_inline_initialAjaxCall($chartMd5)
    {
        $this->info_initializeData();
        $this->info_initializeChart($chartMd5);

        $scPage = NM_encode_input($this->Ini->sc_page);
        $ajaxUrl = "{$this->Ini->path_link}Grafico_pais/index.php";

        $htmlCode = <<<SCEOT
    <script type="text/javascript">
        $.ajax({
            type: "POST",
            url: "{$ajaxUrl}",
            dataType: "json",
            data: {
                nmgp_opcao: "grafico",
                script_case_init: "{$scPage}",
                chart_inline_create: "Y",
                chart_md5: "{$chartMd5}",
            }
        }).done(function(data) {
            $("#sc-summary-fusioncharts-placeholder").html(data.chartHtml);
            if ('' != data.chartType && '' != data.chartUrl) {
                scFusionCharts_create(data.chartType, data.chartUrl, data.chartWidth, data.chartHeight);
            }
        });
    </script>

SCEOT;

        return $htmlCode;
    }

    function display_summaryChart_inline_initialAjaxResponse($chartMd5)
    {
        $this->info_initializeData();
        $this->info_initializeChart($chartMd5);

        $ajaxResponse = [
            'status' => 'ok',
            'chartHtml' => '',
            'chartType' => '',
            'chartUrl' => '',
            'chartWidth' => $this->SC_APP_data['width'],
            'chartHeight' => $this->SC_APP_data['height'],
        ];

        if ('' != $chartMd5 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_info'][$chartMd5])) {
            $ajaxResponse['chartHtml'] .= $this->display_chart_htmlFusionChartsJavascript_setInlineChartMd5($chartMd5);
            $ajaxResponse['chartType'] = $this->SC_APP_data['fusioncharts_javascript'] ['type'];
            $ajaxResponse['chartUrl'] = $this->SC_APP_data['fusioncharts_javascript'] ['dataSource'];
        }

        echo json_encode($ajaxResponse);
        exit;
    }

    function display_summaryChart_inline_updateAjaxResponse($chartMd5)
    {
        $this->info_initializeData();
        $this->info_initializeChart($chartMd5);

        $ajaxResponse = [
            'status' => 'ok',
            'chartType' => $this->SC_APP_data['fusioncharts_javascript'] ['type'],
            'chartUrl' => $this->SC_APP_data['fusioncharts_javascript'] ['dataSource'],
            'chartWidth' => $this->SC_APP_data['width'],
            'chartHeight' => $this->SC_APP_data['height'],
        ];


        echo json_encode($ajaxResponse);
        exit;
    }

    function display_summaryChart_newPage($chartMd5)
    {
        global $nm_saida;

        $this->info_initializeData();
        $this->info_initializeChart($chartMd5);

        $htmlCode = $this->display_chart_htmlHeader();
        $htmlCode .= $this->display_chart_summaryBody();
        $htmlCode .= $this->display_chart_htmlFooter();

        $nm_saida->saida($htmlCode);
    }

    function display_summaryChart_phantom()
    {
        $htmlCode = $this->display_chart_htmlFusionChartsDiv_newPage();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_phantom();

        return $htmlCode;
    }

    function display_summaryChart_phantom_md5()
    {
        return '__' . implode('X', [
            ($this->SC_APP_data['md5_data'] ['options'] ['is_comparison'] ? 'comparison' : 'standard'),
            $this->SC_APP_data['fusioncharts_javascript'] ['type'],
            $this->SC_APP_data['fusioncharts_javascript'] ['width'],
            $this->SC_APP_data['fusioncharts_javascript'] ['height'],
        ]);
    }

    function display_chart_summaryBody()
    {
        $htmlCode = <<<SCEOT
<body class="{$this->SC_APP_info['css'] ['chart_page']}">

SCEOT;
        $htmlCode .= $this->display_chart_htmlFusionChartsConfigDiv();
        $htmlCode .= $this->display_chart_htmlFusionChartsDiv_newPage();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_function();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_onReady();
        $htmlCode .= <<<SCEOT
</body>


SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlHeader()
    {
        $htmlCode = <<<SCEOT
<html>

<head>
    {$this->SC_APP_info['options'] ['charset']}

SCEOT;
        if ('' != $this->SC_APP_info['options'] ['favicon']) {
            $htmlCode .= <<<SCEOT
    <link rel="shortcut icon" href="../_lib/img/{$this->SC_APP_info['options'] ['favicon']}" />

SCEOT;
        }
        if ($this->aux_isMobile()) {
            $htmlCode .= <<<SCEOT
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

SCEOT;
        }
        $htmlCode .= $this->display_chart_htmlHeader_css();
        $htmlCode .= $this->display_chart_htmlHeader_javascript();
        $htmlCode .= <<<SCEOT
    <title>{$this->SC_APP_info['chart'] ['page_title']}</title>
</head>


SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlHeader_css()
    {
        $htmlCode = <<<SCEOT
    <style>
        #sc-id-chart-blockui {
            display: none;
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            background-color: rgb(255, 255, 255);
            z-index: 99900;
            opacity: 0.7;
        }
        #sc-id-div-config {
            position: absolute;
            top: 50%;
            left: 50%;
            padding: 1.5rem;
            z-index: 99990;
            width: 700px;
            border: 1px solid #c2c2c2;
            display: none;
            flex-flow: column nowrap;
            row-gap: 2rem;
            justify-content: center;
            align-items: flex-start;
            box-sizing: border-box;
            transform: translate(-50%, -50%);
            box-shadow: 0 8px 16px rgba(0,0,0,.25);
        }
        #sc-id-div-config-input {
            width: 100%;
            display: flex;
            flex-flow: row wrap;
            row-gap: .875rem;
            column-gap: .875rem;
            justify-content: space-between;
            align-items: center;
        }
        #sc-id-div-config-button {
            width: 100%;
            display: flex;
            flex-flow: row nowrap;
            justify-content: end;
            column-gap: .75rem;
        }
        .input-group {
            flex-flow: column nowrap;
            justify-content: flex-start;
            align-items: flex-start;
            row-gap: .5rem;
            display: flex;
        }
        .input-group > label {
            font-weight: 700;
        }
    </style>

SCEOT;

        if ($this->SC_APP_info['options'] ['use_fontawesome']) {
            $htmlCode .= <<<SCEOT
    <link rel="stylesheet" href="{$this->Ini->path_prod}/third/font-awesome/6/css/all.min.css" type="text/css" media="screen,print" />

SCEOT;
        }

        if ('' != $this->SC_APP_info['options'] ['summary_css']) {
            $summaryCss = NM_encode_input($this->SC_APP_info['options'] ['summary_css']);

            $htmlCode .= <<<SCEOT
    <link rel="stylesheet" href="{$summaryCss}" type="text/css" media="screen,print" />

SCEOT;
        }

        $htmlCode .= <<<SCEOT
    <link rel="stylesheet" href="../_lib/buttons/{$this->Ini->Str_btn_css}" type="text/css" media="screen,print" />

SCEOT;

        if (isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) {
            $htmlCode .= <<<SCEOT
    <link rel="stylesheet" href="{$this->Ini->str_google_fonts}" type="text/css" media="screen,print" />

SCEOT;
        }

        return $htmlCode;
    }

    function display_chart_htmlHeader_javascript()
    {
        $scPage = NM_encode_input($this->Ini->sc_page);
        $ajaxUrl = "{$this->Ini->path_link}Grafico_pais/Grafico_pais_config_graf_flash.php?nome_apl=Grafico_pais&campo_apl=nm_resumo_graf&sc_page=" . NM_encode_input($this->Ini->sc_page) . "&language=es";

        $htmlCode = <<<SCEOT
    <script type="text/javascript" src="{$this->Ini->path_prod}/third/jquery/js/jquery.js"></script>
    <script type="text/javascript">
        function showChartConfig()
        {
            $("#sc-id-div-config").css("display", "flex").show();
            $("#sc-id-chart-blockui").show();
        }
        function hideChartConfig()
        {
            $("#sc-id-div-config").hide();
            $("#sc-id-chart-blockui").hide();
        }
        $(function() {
            $("#sc-id-button-submit").on("click", function() {
                $.ajax({
                    type: "POST",
                    url: "{$ajaxUrl}",
                    data: {
                        bok_graf: "OK",
                        ajax: "OK",
                        nome_apl: "Grafico_pais",
                        campo_apl: "nm_resumo_graf",
                        sc_page: "{$scPage}",
                        tipo: $("#sc-id-chart-type").val(),
                        opc_atual: $("#sc-id-chart-mode").val(),
                        largura: $("#sc-id-chart-width").val(),
                        altura: $("#sc-id-chart-height").val(),
                        order: $("#sc-id-chart-order").val()
                    }
                }).done(function(data, textStatus, jqXHR) {
                    document.refresh_chart.submit();
                });
            });
            $("#sc-id-button-cancel").on("click", function() {
                hideChartConfig();
            });
        });
    </script>

SCEOT;
        $htmlCode .= $this->display_chart_htmlFusionChartsLibrary();

        return $htmlCode;
    }

    function display_chart_htmlFooter()
    {
        $htmlCode = <<<SCEOT
</html>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsLibrary($useServer = '')
    {
        $jsServer = '';
        if ('pdf' == $useServer) {
            $jsServer = $this->Ini->server_pdf;
        }

        $htmlCode = <<<SCEOT
    <script type="text/javascript" src="{$jsServer}{$this->Ini->path_prod}/third/fusioncharts/js/fusioncharts.js"></script>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsConfigDiv()
    {
        $translate = [];
        $language = 'es';
        if (isset($_SESSION['scriptcase'] ['sc_idioma_graf_flash'])) {
            $translate = $_SESSION['scriptcase'] ['sc_idioma_graf_flash'];
        }
        if (!isset($translate[$language])) {
            foreach ($translate as $language => $rest) {
                break;
            }
        }

        $modeSyntheticSelected = self::CHART_MODE_SYNTHETIC == $this->SC_APP_data['data_mode'] ? ' selected="selected"' : '';
        $modeAnalyticSelected = self::CHART_MODE_ANALYTIC == $this->SC_APP_data['data_mode'] ? ' selected="selected"' : '';
        $modeSyntheticValue = self::CHART_MODE_SYNTHETIC;
        $modeAnalyticValue = self::CHART_MODE_ANALYTIC;

        $orderNoneSelected = '' == $this->SC_APP_data['order'] ? ' selected="selected"' : '';
        $orderAscSelected = 'asc' == $this->SC_APP_data['order'] ? ' selected="selected"' : '';
        $orderDescSelected = 'desc' == $this->SC_APP_data['order'] ? ' selected="selected"' : '';

        $configButtonCode = trim(nmButtonOutput($this->arr_buttons, "bconf_graf", "showChartConfig()", "showChartConfig()", "Rgraf", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", ""));
        $okButtonCode = trim(nmButtonOutput($this->arr_buttons, "bok", "", "", "sc-id-button-submit", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", ""));
        $cancelButtonCode = trim(nmButtonOutput($this->arr_buttons, "bcancelar", "", "", "sc-id-button-cancel", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", ""));
 
        $htmlCode = <<<SCEOT
    {$configButtonCode}
    <div id="sc-id-chart-blockui"></div>
    <div id="sc-id-div-config" class="scGridToolbar">
        <div id="sc-id-div-config-input" class="group">
            <div class="input-group">
                <label>{$translate[$language] ['tipo_g']}</label>
                <select id="sc-id-chart-type" class="css_toolbar_obj">

SCEOT;
        foreach ($this->SC_APP_info['chart'] ['available_types'] as $chartType) {
            $typeSelected = $chartType == $this->SC_APP_data['type'] ? ' selected="selected"' : '';
             switch ($chartType) {
                case 'Area':
                   $chartTitle = 'tp_area';
                   break;
                case 'Bar':
                   $chartTitle = 'tp_barra';
                   break;
                case 'Funnel':
                   $chartTitle = 'tp_funil';
                   break;
                case 'Gauge':
                   $chartTitle = 'tp_gauge';
                   break;
                case 'Line':
                   $chartTitle = 'tp_linha';
                   break;
                case 'Mark':
                   $chartTitle = 'tp_marcador';
                   break;
                case 'Pie':
                   $chartTitle = 'tp_pizza';
                   break;
                case 'Pyramid':
                   $chartTitle = 'tp_pyramid';
                   break;
                case 'Polar':
                   $chartTitle = 'tp_polar';
                   break;
                case 'Radar':
                   $chartTitle = 'tp_radar';
                   break;
             }

            $htmlCode .= <<<SCEOT
                    <option value="{$chartType}"{$typeSelected}>{$translate[$language] [$chartTitle]}</option>
            
SCEOT;
        }
        $htmlCode .= <<<SCEOT
                </select>
            </div>
            <div class="input-group">
                <label>{$translate[$language] ['modo_gera']}</label>
                <select id="sc-id-chart-mode" class="css_toolbar_obj">
                    <option value="{$modeSyntheticValue}"{$modeSyntheticSelected}>{$translate[$language] ['sintetico']}</option>
                    <option value="{$modeAnalyticValue}"{$modeAnalyticSelected}>{$translate[$language] ['analitico']}</option>
                </select>
            </div>
            <div class="input-group">
                <label>{$translate[$language] ['largura']}</label>
                <input id="sc-id-chart-width" type="text" size="5" value="{$this->SC_APP_data['width']}" class="css_toolbar_obj" style="text-align: right" />
            </div>
            <div class="input-group">
                <label>{$translate[$language] ['altura']}</label>
                <input id="sc-id-chart-height" type="text" size="5" value="{$this->SC_APP_data['height']}" class="css_toolbar_obj" style="text-align: right" />
            </div>
            <div class="input-group">
                <label>{$translate[$language] ['order']}</label>
                <select id="sc-id-chart-order" class="css_toolbar_obj">
                    <option value=""{$orderNoneSelected}>{$translate[$language] ['order_none']}</option>
                    <option value="asc"{$orderAscSelected}>{$translate[$language] ['order_asc']}</option>
                    <option value="desc"{$orderDescSelected}>{$translate[$language] ['order_desc']}</option>
                </select>
            </div>
        </div>
        <div id="sc-id-div-config-button" class="input-group">
            {$okButtonCode}
            {$cancelButtonCode}
        </div>
    </div>
    <form name="refresh_chart" action="./" method="POST">

SCEOT;
        foreach ($_POST as $postItem => $postValue) {
            $htmlCode .= <<<SCEOT
        <input type="hidden" name="{$postItem}" value="{$postValue}" />

SCEOT;
        }
        $htmlCode .= <<<SCEOT
    </form>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsDiv_inline()
    {
        $htmlCode = <<<SCEOT
    <div id="{$this->SC_APP_data['chart_div']}" style="display: inline-block; position: sticky; left: 0"></div>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsDiv_newPage()
    {
        $htmlCode = <<<SCEOT
    <div id="{$this->SC_APP_data['chart_div']}" style="width: 100%"></div>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsJavascript_function()
    {
        $jsServer = '';
        if ('pdf' == $useServer) {
            $jsServer = $this->Ini->server_pdf;
        }

        $htmlCode = <<<SCEOT
    <script type="text/javascript">
        let scFusionCharts;
        let scFusionChartsType = "{$this->SC_APP_data['fusioncharts_javascript'] ['type']}";
        let scFusionChartsDataSource = "{$jsServer}{$this->SC_APP_data['fusioncharts_javascript'] ['dataSource']}";
        let scFusionChartsWidth = "{$this->SC_APP_data['width']}";
        let scFusionChartsHeight = "{$this->SC_APP_data['height']}";
        function scFusionCharts_create(chartType, chartDataSource, chartWidth, chartHeight) {
            FusionCharts.options.license({
                key: "{$this->SC_APP_data['license_key']}",
                creditLabel: {$this->SC_APP_data['license_creditLabel']},
            });
            FusionCharts.ready(function() {
                scFusionCharts = new FusionCharts({
                    "renderAt": "{$this->SC_APP_data['chart_div']}",
                    "id": "{$this->SC_APP_data['chart_id']}",
                    "type": chartType,
                    "width": chartWidth,
                    "height": chartHeight,
                    "dataFormat": "{$this->SC_APP_data['chart_dataFormat']}",
                    "dataSource": chartDataSource,
                }).render();
                scFusionCharts.configureLink({
                    overlayButton: {
                        message: "{$this->Ini->Nm_lang['lang_btns_chart_back']}"
                    }
                });
            });
        }
    </script>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsJavascript_phantom()
    {
        $htmlCode = <<<SCEOT
    <script type="text/javascript">
        FusionCharts.options.license({
            key: "{$this->SC_APP_data['license_key']}",
            creditLabel: {$this->SC_APP_data['license_creditLabel']},
        });
        FusionCharts.ready(function() {
            var scFusionCharts = new FusionCharts({
                "creditLabel": {$this->SC_APP_data['license_creditLabel']},
                "renderAt": "{$this->SC_APP_data['chart_div']}",
                "id": "{$this->SC_APP_data['chart_id']}",
                "type": "{$this->SC_APP_data['fusioncharts_javascript'] ['type']}",
                "width": "{$this->SC_APP_data['width']}",
                "height": "{$this->SC_APP_data['height']}",
                "dataFormat": "{$this->SC_APP_data['chart_dataFormat']}",
                "dataSource": "{$this->Ini->server_pdf}{$this->SC_APP_data['fusioncharts_javascript'] ['dataSource']}",
            }).render();
        });
    </script>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsJavascript_onReady()
    {
        $htmlCode = <<<SCEOT
    <script type="text/javascript">
        $(function() {
            scFusionCharts_create(scFusionChartsType, scFusionChartsDataSource, scFusionChartsWidth, scFusionChartsHeight);
        });
    </script>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsJavascript_setInlineChartMd5($chartMd5)
    {
        $htmlCode = <<<SCEOT
    <script type="text/javascript">
        $(function() {
            scChartInlineMd5 = "{$chartMd5}";
        });
    </script>

SCEOT;

        return $htmlCode;
    }

    function aux_filterChartItems()
    {
        $itemCount = 0;
        $itemValues = [];

        foreach ($this->SC_APP_data['md5_data'] ['data_synthetic'] [self::GROUPBY_ORIGINAL] as $dimensionValue => $dimensionInfo) {
            $itemValues[ $dimensionInfo['label'] ] = $dimensionInfo['value'];
        }

        arsort($itemValues);

        foreach ($itemValues as $dimensionLabel => $dimensionValue) {
            $this->SC_APP_data['filtered_chart_items'] [] = $dimensionLabel;

            $itemCount++;
            if ($itemCount == $this->SC_APP_data['limit_chart_items']) {
                break;
            }
        }
    }

    function aux_getFusionChartsRenderer()
    {
        if ($this->SC_APP_data['md5_data'] ['options'] ['is_comparison']) {
            return $this->aux_getFusionChartsComparisonRenderer();
        }

        $multiSeriesSuffix = $this->aux_isMultiSeries() ? 'ms' : '';

        switch ($this->SC_APP_data['type']) {
            case 'Area':
                if ('Spline' == $this->SC_APP_info['types'] ['area'] ['format']) {
                    return $multiSeriesSuffix . 'splinearea';
                } elseif ($this->aux_isMultiSeries()) {
                    return 'msarea';
                } else {
                    return 'area2d';
                }
                break;

            case 'Bar';
                if ($this->aux_isMultiSeries() && $this->SC_APP_info['types'] ['bar'] ['stacking']) {
                    $multiSeriesSuffix = 'stacked';
                }
                if ('Horizontal' == $this->SC_APP_info['types'] ['bar'] ['orientation']) {
                    if ('2d' == $this->SC_APP_info['types'] ['bar'] ['dimension']) {
                        return $multiSeriesSuffix . 'bar2d';
                    } else {
                        return $multiSeriesSuffix . 'bar3d';
                    }
                } else {
                    if ('2d' == $this->SC_APP_info['types'] ['bar'] ['dimension']) {
                        return $multiSeriesSuffix . 'column2d';
                    } else {
                        return $multiSeriesSuffix . 'column3d';
                    }
                }
                break;

            case 'Funnel';
                return 'funnel';
                break;

            case 'Gauge';
                return 'angulargauge';
                break;

            case 'Line':
                if ('Spline' == $this->SC_APP_info['types'] ['line'] ['format']) {
                    return 'spline';
                } elseif ('Step' == $this->SC_APP_info['types'] ['line'] ['format']) {
                    return 'msstepline';
                } else {
                    return $multiSeriesSuffix . 'line';
                }
                break;

            case 'Pie':
                if ('Donut' == $this->SC_APP_info['types'] ['pie'] ['format']) {
                    if ('2d' == $this->SC_APP_info['types'] ['pie'] ['dimension']) {
                        return 'doughnut2d';
                    } else {
                        return 'doughnut3d';
                    }
                } else {
                    if ('2d' == $this->SC_APP_info['types'] ['pie'] ['dimension']) {
                        return 'pie2d';
                    } else {
                        return 'pie3d';
                    }
                }
                break;

            case 'Pyramid';
                return 'pyramid';
                break;

            case 'Radar';
                return 'radar';
                break;
        }
    }

    function aux_getFusionChartsComparisonRenderer()
    {
        $chartType = $this->SC_APP_data['type'];
        if (!in_array($chartType, ['Area', 'Bar', 'Line', 'Radar'])) {
            $chartType = $this->SC_APP_info['chart'] ['available_comparison_types'] [0];
        }
 
        switch ($chartType) {
            case 'Area':
                if ('Spline' == $this->SC_APP_info['types'] ['area'] ['format']) {
                    return 'mssplinearea';
                } else {
                    return 'msarea';
                }
                break;

            case 'Bar';
                if ('Horizontal' == $this->SC_APP_info['types'] ['bar'] ['orientation']) {
                    if ('2d' == $this->SC_APP_info['types'] ['bar'] ['dimension']) {
                        return 'msbar2d';
                    } else {
                        return 'msbar3d';
                    }
                } else {
                    if ('2d' == $this->SC_APP_info['types'] ['bar'] ['dimension']) {
                        return 'mscolumn2d';
                    } else {
                        return 'mscolumn3d';
                    }
                }
                break;

            case 'Line':
                if ('Step' == $this->SC_APP_info['types'] ['line'] ['format']) {
                    return 'msstepline';
                } else {
                    return 'msline';
                }
                break;

            case 'Radar';
                return 'radar';
                break;
        }
    }

    function aux_isJsonChartCreated()
    {
        return @is_file($this->SC_APP_info['chart'] ['json_base_dir'] . $this->SC_APP_info['chart'] ['json_filename']);
    }

    function aux_isMobile()
    {
        return $_SESSION['scriptcase'] ['proc_mobile'];
    }

    function aux_isMultiSeries()
    {
        if (self::CHART_MODE_ANALYTIC == $this->SC_APP_data['data_mode'] && !empty($this->SC_APP_data['md5_data'] ['data_analytic'])) {
            switch ($this->SC_APP_data['type']) {
                case 'Area':
                case 'Bar';
                case 'Line':
                    if ('Spline' != $this->SC_APP_info['types'] ['line'] ['format']) {
                        return true;
                    }
            }
        }

        return false;
    }

    function aux_isResponsive()
    {
        return $_SESSION['sc_session'] [$this->Ini->sc_page] ['Grafico_pais'] ['responsive_chart'] ['active'];
    }

    function aux_isUtf8()
    {
        return 'UTF-8' == $_SESSION['scriptcase'] ['charset'];
    }

    function aux_orderSerie(&$serie, $direction)
    {
        $this->tempSortRule = $direction;

        uasort($serie, function($a, $b) {
            if ($a['value'] ==  $b['value']) {
                if ('asc' == $this->tempSortRule) {
                    return strnatcmp($a['label'], $b['label']);
                } else {
                    return strnatcmp($b['label'], $a['label']);
                }
            } else {
                if ('asc' == $this->tempSortRule) {
                    return strnatcmp($a['value'], $b['value']);
                } else {
                    return strnatcmp($b['value'], $a['value']);
                }
            }
        });
    }

    function aux_rearrangeOrderIndexes(&$serie)
    {
        $newSerie = [];

        foreach ($serie as $itemIndex => $itemInfo) {
            $newSerie[] = $itemInfo;
        }

        $serie = $newSerie;
    }

    function aux_rearrangeOrderMultiIndexes(&$serie, &$category)
    {
        $newSerie = [];
        $newCategory = [];

        foreach ($serie as $itemIndex => $itemInfo) {
            $newSerie[] = $itemInfo;
            $newCategory[] = $category[$itemIndex];
        }

        $serie = $newSerie;
        $category = $newCategory;
    }

   //---- 
   function monta_grafico($chart_key = '', $operation = 'chart', $graf_col = false)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_drill_down'])) {
           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_drill_down'] = true;
       }
       if (!isset($_POST['reload_comb_chart']) || (isset($_POST['reload_comb_chart']) && 'Y' == $_POST['reload_comb_chart'])) {
           $this->reload_as_analytic = !$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_drill_down'];
       }
       $graf_field = false;
       $this->graf_col = $graf_col;
       if (is_array($chart_key) && isset($chart_key['field']))
       {
           $field = $chart_key['field'];
           $graf_field = true;
       }
       if ('pdf_lib' == $operation)
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf'];
           $this->grafico_flash_js();
           return;
       }
       if ($graf_field)
       {
           $this->sc_graf_sint = true;
       }
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_opc_atual'] == 1)
       {
           $this->sc_graf_sint = true;
       }

       $b_export = false;
       if (isset($_GET['flash_graf']) && 'chart' == $_GET['flash_graf'])
       {
           $b_export = true;
           $chart_key = key($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts']);
       }
       elseif ('' == $chart_key)
       {
           $chart_key = isset($_POST['nmgp_parms']) ? $_POST['nmgp_parms'] : '';
       }

       if ($graf_field)
       {
           $chart_data = array();
           $chart_data['title']    = $chart_key['title'];
           $chart_data['label_x']  = $chart_key['label_x'];
           $chart_data['label_y']  = $chart_key['label_y'];
           $chart_data['labels']   = $chart_key['labels'];
           $chart_data['show_sub'] = true;
           $chart_data['subtitle'] = "";
           $chart_data['format']   = $chart_key['format'];
           $chart_data['legend']   = "";
           $chart_data['values']['sint'] = $chart_key['vals'];
           $arr_param = array(
               'type'        => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_tipo'],
               'width'       => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_larg'],
               'height'      => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_alt'],
               'barra_orien' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_barra_orien'],
               'barra_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_barra_forma'],
               'barra_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_barra_dimen'],
               'barra_sobre' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_barra_sobre'],
               'barra_empil' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_barra_empil'],
               'barra_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_barra_inver'],
               'barra_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_barra_agrup'],
               'barra_funil' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_barra_funil'],
               'pizza_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_pizza_forma'],
               'pizza_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_pizza_dimen'],
               'pizza_orden' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_pizza_orden'],
               'pizza_explo' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_pizza_explo'],
               'pizza_valor' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_pizza_valor'],
               'linha_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_linha_forma'],
               'linha_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_linha_inver'],
               'linha_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_linha_agrup'],
               'area_forma'  => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_area_forma'],
               'area_empil'  => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_area_empil'],
               'area_inver'  => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_area_inver'],
               'area_agrup'  => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_area_agrup'],
               'marca_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_marca_inver'],
               'marca_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_marca_agrup'],
               'gauge_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_gauge_forma'],
               'radar_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_radar_forma'],
               'radar_empil' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_radar_empil'],
               'polar_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_polar_forma'],
               'funil_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_funil_dimen'],
               'funil_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_funil_inver'],
               'pyram_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_pyram_dimen'],
               'pyram_valor' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_pyram_valor'],
               'pyram_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field]['graf_pyram_forma'],
               'tit_datay'   => $chart_data['label_y'],
               'tit_label'   => $chart_data['label_x'],
               'tit_chart'   => $chart_data['title'],
               'export'      => 'N',
               'pdf'         => 'N',
               'xml'         => '',
           );
           $mode = 'full';
           $this->arr_param = $arr_param;
           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']               = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais'][$field];
           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_order'];
           $this->grafico_flash($arr_param, $this->grafico_dados($chart_data, $arr_param['export'], ''), $mode);
       }
       elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$chart_key]))
       {
           $chart_data = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$chart_key];

           $arr_param = array(
               'type'        => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_tipo'],
               'width'       => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_larg'],
               'height'      => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_alt'],
               'barra_orien' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_orien'],
               'barra_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_forma'],
               'barra_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_dimen'],
               'barra_sobre' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_sobre'],
               'barra_empil' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_empil'],
               'barra_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_inver'],
               'barra_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_agrup'],
               'barra_funil' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_funil'],
               'pizza_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_forma'],
               'pizza_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_dimen'],
               'pizza_orden' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_orden'],
               'pizza_explo' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_explo'],
               'pizza_valor' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_valor'],
               'linha_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_linha_forma'],
               'linha_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_linha_inver'],
               'linha_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_linha_agrup'],
               'area_forma'  => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_area_forma'],
               'area_empil'  => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_area_empil'],
               'area_inver'  => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_area_inver'],
               'area_agrup'  => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_area_agrup'],
               'marca_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_marca_inver'],
               'marca_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_marca_agrup'],
               'gauge_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_gauge_forma'],
               'radar_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_radar_forma'],
               'radar_empil' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_radar_empil'],
               'polar_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_polar_forma'],
               'funil_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_funil_dimen'],
               'funil_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_funil_inver'],
               'pyram_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pyram_dimen'],
               'pyram_valor' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pyram_valor'],
               'pyram_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pyram_forma'],
               'tit_datay'   => $chart_data['label_y'],
               'tit_label'   => $chart_data['label_x'],
               'tit_chart'   => $chart_data['title'],
               'export'      => $b_export ? 'Y' : ('xml' == $operation ? 'xml' : 'N'),
               'pdf'         => 'pdf' == $operation ? 'Y' : 'N',
               'xml'         => 'xml' == $operation ? $chart_data['xml'] : '',
           );
           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']               = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf'];
           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_order'];
           if ('pdf' == $operation)
           {
               $mode = 'chart';
           }
           elseif ('xml' == $operation)
           {
               $mode = 'xml_only';
           }
           elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_full'])
           {
               $mode = 'full';
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_full']);
           }
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_bot']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_bot'])
           {
               $mode = 'full';
           }
           elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_first'])
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_first'] = false;
               $mode = array('js', 'chart');
           }
           else
           {
               $mode = 'chart';
           }
           $this->arr_param = $arr_param;
           $this->grafico_flash($arr_param, $this->grafico_dados($chart_data, $arr_param['export'], $chart_key), $mode);
           if ('pdf' == $operation || 'xml' == $operation)
           {
               return;
           }
           elseif ((!isset($_GET['flash_graf']) || 'chart' != $_GET['flash_graf']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_bot']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_bot']))
           {
               exit;
           }
       }
       elseif (isset($_GET['flash_graf']) && 'chart' == $_GET['flash_graf'])
       {
?>
<html>
<body>
<?php
           $this->grafico_flash_form();
?>
<script type="text/javascript" language="javascript">
  document.flashRedir.submit();
 </script>
</body>
</html>
<?php
       }
       elseif ('__no_record_found__' == $chart_key)
       {
           $arr_param = array(
               'type'        => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_tipo'],
               'width'       => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_larg'],
               'height'      => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_alt'],
               'barra_orien' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_orien'],
               'barra_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_forma'],
               'barra_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_dimen'],
               'barra_sobre' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_sobre'],
               'barra_empil' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_empil'],
               'barra_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_inver'],
               'barra_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_agrup'],
               'barra_funil' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_barra_funil'],
               'pizza_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_forma'],
               'pizza_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_dimen'],
               'pizza_orden' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_orden'],
               'pizza_explo' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_explo'],
               'pizza_valor' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pizza_valor'],
               'linha_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_linha_forma'],
               'linha_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_linha_inver'],
               'linha_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_linha_agrup'],
               'area_forma'  => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_area_forma'],
               'area_empil'  => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_area_empil'],
               'area_inver'  => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_area_inver'],
               'area_agrup'  => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_area_agrup'],
               'marca_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_marca_inver'],
               'marca_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_marca_agrup'],
               'gauge_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_gauge_forma'],
               'radar_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_radar_forma'],
               'radar_empil' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_radar_empil'],
               'polar_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_polar_forma'],
               'funil_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_funil_dimen'],
               'funil_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_funil_inver'],
               'pyram_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pyram_dimen'],
               'pyram_valor' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pyram_valor'],
               'pyram_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_pyram_forma'],
               'tit_datay'   => '',
               'tit_label'   => '',
               'tit_chart'   => '',
               'export'      => 'N',
               'pdf'         => 'N',
               'xml'         => '',
           );
           $this->grafico_flash($arr_param, null, '__no_record_found__');
       }
   }

   //---- 
   function inicializa_vars()
   {
      global 
             $nivel_quebra, $nm_lang, $campo, $campo_val;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_opc_atual'] == 1)
      {
         $this->sc_graf_sint = true;
      }
      //---- 
      $this->array_decimais = array();
      $this->NM_tit_val[1]     = strip_tags("Continente (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_cnt'] . ")");
      $this->NM_ind_val[1]     = 1;
      $this->array_decimais[1] = 0;
      $this->campo     = (isset($campo))        ? $campo        : 0;
      $this->nivel     = (isset($nivel_quebra)) ? $nivel_quebra : 0;
      $this->campo_val = (isset($campo_val))    ? $campo_val    : 1;
      //---- 
      $this->array_total_continente = array();
      $this->array_total_nombre = array();
      //---- 
      $ind_tit = $this->campo_val;
      if ($this->campo > 0)
      {
          foreach ($this->NM_ind_val as $i => $seq)
          {
              if ($ind_tit == $seq)
              {
                  $ind_tit = $i;
                  break;
              }
          }
      }
      $this->list_titulo = (isset($this->NM_tit_val[$ind_tit]))  ? $this->NM_tit_val[$ind_tit]  : "";
      $this->Decimais    = (isset($this->array_decimais[$ind_tit])) ? $this->array_decimais[$ind_tit] : 2;
      $this->titulo      = $this->list_titulo;
      //---- Label
      $this->label    = array();
      $prep_label    = array();
      $prep_label['continente'] = "Continente";
      $prep_label['nombre'] = "Nombre";
      $x = 0;
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
      {
          $this->label[$x] = $prep_label[$cmp_gb];
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['contr_label_graf'][$cmp_gb]) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['contr_label_graf'][$cmp_gb]))
          {
             $this->label[$x] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['contr_label_graf'][$cmp_gb];
          }
          $x++;
      }
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
   function monta_arrays()
   {
      $this->array_label = array();
      $this->array_datay = array();
      if ($this->campo > 0)
      {
          $this->sc_graf_sint = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_total']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_total'] as $label => $valor)
          {
              $this->array_label[] = $valor[2];
              if ($this->campo == 0 && $this->nivel == 0)
              {
                  if ($this->sc_graf_sint)
                  {
                      $this->array_datay[" "][] = $valor[$this->campo_val];
                  }
              }
          }
          if (!$this->sc_graf_sint)
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_linhas'] as $cada_elemento)
              {
                  if (substr($cada_elemento[0], 0, 1) == 1)
                  {
                      $ind_val = $this->NM_ind_val[$this->campo_val];
                      $legenda = substr($cada_elemento[0], 1);
                      foreach ($this->array_label as $ind => $lixo)
                      {
                          if (isset($cada_elemento[$ind + 1]))
                          {
                              $this->array_datay[$legenda][] = $cada_elemento[$ind + 1][$ind_val];
                          }
                          else
                          {
                              $this->array_datay[$legenda][] = 0;
                          }
                      }
                  }
              }
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_linhas']))
      {
          if ($this->campo > 0)
          {
              $lab_quebra    = substr($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_linhas'][$this->campo][0], 1);
              $lab_quebra    = str_replace("&nbsp;", "", $lab_quebra);
              $this->titulo .= " - " . $this->label[$this->nivel] . " = " . $lab_quebra;
          }
          if ($this->campo > 0)
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_linhas'][$this->campo] as $ind => $valor)
              {
                  if ($ind > 0)
                  {
                      $this->array_datay[" "][$ind - 1] = $valor[$this->campo_val];
                  }
              }
              for ($i = 0; $i < count($this->array_label); $i++)
              {
                   if (!isset($this->array_datay[" "][$i]))
                   {
                       $this->array_datay[" "][$i] = 0;
                   }
              }
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['del_graph_col']))
      {
          $trab_graf = $this->array_label;
          $this->array_label = array();
          foreach ($trab_graf as $ind => $resto)
          {
              $tst_ind = $ind + 1;
              if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['del_graph_col'][$tst_ind]))
              {
                  $this->array_label[] = $resto;
              }
          }
          $trab_graf = $this->array_datay;
          $this->array_datay = array();
          foreach ($trab_graf as $legenda => $dados)
          {
              ksort($dados);
              foreach ($dados as $ind => $resto)
              {
                  $tst_ind = $ind + 1;
                  if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['del_graph_col'][$tst_ind]))
                  {
                      $this->array_datay[$legenda][] = $resto;
                  }
              }
          }
      }
      $this->max_size_label = 0;
      for ($i = 0; $i < sizeof($this->array_label); $i++)
      {
         $size_label           = strlen("" . $this->array_label[$i]);
         $this->max_size_label = ($this->max_size_label < $size_label) ? $size_label : $this->max_size_label;
      }
      $this->max_size_datay = 0;
      $this->total_datay = 0;
      foreach ($this->array_datay as $legenda => $dadosY)
      {
          for ($i = 0; $i < sizeof($dadosY); $i++)
          {
             $size_datay           = strlen("" . $dadosY[$i]);
             $this->max_size_datay = ($this->max_size_datay < $size_datay) ? $size_datay : $this->max_size_datay;
             $this->total_datay   += $dadosY[$i];
          }
      }
   }

   function storeCombinationTable($arr_series)
   {
       foreach ($arr_series as $serie_data)
       {
           if ($serie_data['comb'])
           {
               $this->storeCombinationTableSerie($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_table_data'], $serie_data, $serie_data['param']);
           }
       }
   }

   function storeCombinationTableSerie(&$comb_data, $serie_data, $param)
   {
       if (!empty($param))
       {
           $index = array_shift($param);
           if(!isset($comb_data[$index]))
           {
               $comb_data[$index] = array(
                   'field_x'  => '',
                   'label_x'  => '',
                   'label'    => '',
                   'values'   => array(),
                   'children' => array(),
               );
           }
           $this->storeCombinationTableSerie($comb_data[$index]['children'], $serie_data, $param);
       }
       else
       {
           $this->storeCombinationTableSerieData($comb_data, $serie_data);
       }
   }

   function storeCombinationTableSerieData(&$comb_data, $serie_data)
   {
       foreach ($serie_data['db_values'] as $index => $dbval)
       {
           $comb_data[$dbval]['field_x']                           = $serie_data['field_x'];
           $comb_data[$dbval]['label_x']                           = $serie_data['label_x'];
           $comb_data[$dbval]['label']                             = $serie_data['label'][$index];
           $comb_data[$dbval]['values'][ $serie_data['summ_idx'] ] = $serie_data['data'][$index];

           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_table_def']['field'][ $serie_data['summ_idx'] ] = $serie_data['field_y'];
           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_table_def']['label'][ $serie_data['summ_idx'] ] = $serie_data['name'];
           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_table_def']['summ'][ $serie_data['summ_idx'] ]  = $serie_data['summ_idx'];
       }
   }

   function storeAnalyticTable($arr_series)
   {
       foreach ($arr_series as $serie_data)
       {
           $this->storeAnaliticTableSerie($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['anlt_table_data'], $serie_data);
       }
   }

   function storeAnaliticTableSerie(&$comb_data, $serie_data)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['anlt_table_def']['field'][ $serie_data['name'] ] = $serie_data['field_y'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['anlt_table_def']['label'][ $serie_data['name'] ] = $serie_data['name'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['anlt_table_def']['summ'][ $serie_data['name'] ]  = $serie_data['summ_idx'];

       foreach ($serie_data['db_values'] as $index => $dbval)
       {
           if (!isset($comb_data[ $serie_data['label'][$index] ]))
           {
               $comb_data[ $serie_data['label'][$index] ] = array(
                   'field_x'  => $serie_data['field_x'],
                   'label_x'  => $serie_data['label_x'],
                   'label'    => $serie_data['label'][$index],
                   'values'   => array(),
                   'children' => array(),
               );
           }

           $comb_data[ $serie_data['label'][$index] ]['values'][ $serie_data['name'] ] = $serie_data['data'][$index];
       }
    }

   function grafico_flash($arr_param, $arr_charts, $html_par = 'full')
   {
      global $nm_saida, $nm_retorno_graf;
         $Ind_groupby = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Ind_Groupby'];
         $orderRule  = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_rule'];
         $orderField = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_field'];

         $groupByIndex = isset($arr_charts[0][0]['param']) ? count($arr_charts[0][0]['param']) : -1;
         if (-1 != $groupByIndex && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_forced']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_forced'])) {
             $i = 0;
             foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_Free_cmp'] as $groupById => $groupByLabel) {
                 if ($i == $groupByIndex) {
                     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_rule_groupby'][$groupById]) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_field_groupby'][$groupById])) {
                         $orderRule  = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_rule_groupby'][$groupById];
                         $orderField = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_field_groupby'][$groupById];
                     }

                     break;
                 }
                 $i++;
             }
         }
         $this->orderCharts($arr_charts, $orderRule, 'label' == $orderField ? $orderField : $orderField - 1);

       if (!isset($arr_charts[0][0]['reload_analytic']) || !$arr_charts[0][0]['reload_analytic'])
       {
           $arr_ret = array();

           foreach ($arr_charts as $idx_serie => $dat_serie)
           {
               foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_order'][$Ind_groupby] as $idx_order)
               {
                   foreach ($dat_serie as $idx_chart => $dat_chart)
                   {
                       $temp = (int) $dat_chart['summ_idx'];
                       if ($idx_order == $temp + 1)
                       {
                           $dat_summ = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_display'][$Ind_groupby][$idx_order];
                           if ($dat_summ['display'])
                           {
                               $arr_ret[$idx_serie][] = $arr_charts[$idx_serie][$idx_chart];
                           }
                       }
                   }
               }
           }

           $arr_charts = $arr_ret;
       }

         $arr_series     = (isset($arr_charts[0])) ? $arr_charts[0] : array();

         $dp_settings    = array();
         $y_scale        = array();
         $shape_type     = '';
         $chart_series   = 'bar_series';
         $chart_series_a = array();
         $series_explode = '';

         $tipo           = $arr_param['type'];
         $width          = $arr_param['width'];
         $height         = $arr_param['height'];
         $tit_datay      = $arr_param['tit_datay'];
         $tit_label      = $arr_param['tit_label'];
         $tit_graf       = $arr_param['tit_chart'];
         $export         = $arr_param['export'];

         $host           = (isset($arr_param['host'])   && !empty($arr_param['host']))   ? $arr_param['host']   : '';
         $export         = (isset($arr_param['export']) && !empty($arr_param['export'])) ? $arr_param['export'] : 'N';

         $this->storeCombinationTable($arr_series);

         if ('xml_only' == $html_par)
         {
             if (isset($arr_param['xml']) && '' != $arr_param['xml'])
             {
                 $fileParts = explode('!!!', $arr_param['xml']);
                 if (1 == count($fileParts))
                 {
                     $fileName = $arr_param['xml'];
                 }
                 else
                 {
                     $fileParts[1] = md5($fileParts[1]);
                     $fileName     = implode('', $fileParts);
                 }
                 $sFileLocal = $this->Ini->path_imag_temp . '/' . $fileName;
                 $ac         = fopen($this->Ini->root . $sFileLocal, 'w');
                 fwrite($ac, $this->grafico_flash_xml($arr_param, $arr_series));
                 fclose($ac);
             }
             return;
         }

         if ($this->reload_as_analytic)
         {
              $this->storeAnalyticTable($arr_series);
         }

         $sFileLocal = $this->Ini->path_imag_temp . '/sc_flashchart_' . md5(microtime() . mt_rand(1, 1000)) . '.json';
         $ac         = fopen($this->Ini->root . $sFileLocal, 'w');
         fwrite($ac, $this->grafico_flash_xml($arr_param, $arr_series));
         fclose($ac);

         if (isset($_POST['reload_comb_chart']) && 'Y' == $_POST['reload_comb_chart'])
         {
             ob_end_clean();
             echo $sFileLocal;
             return;
         }

         if ('full' == $html_par || 'page' == $html_par || (is_array($html_par) && in_array('page', $html_par)) )
         {
?>
<html>
<head>
<META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/font-awesome/6/css/all.min.css" type="text/css" media="screen,print" />
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
<?php
             if ($_SESSION['scriptcase']['proc_mobile'])
             {
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
             }
             if (isset($_POST['summary_css']) && '' != $_POST['summary_css'])
             {
?>
<link rel="stylesheet" href="<?php echo NM_encode_input($_POST['summary_css']) ?>" type="text/css" media="screen" />
<?php
             }
?>
<title>
<?php
             if ('UTF-8' != $_SESSION['scriptcase']['charset'])
             {
                 echo sc_convert_encoding($tit_graf, $_SESSION['scriptcase']['charset'], 'UTF-8');
             }
             else
             {
                 echo $tit_graf;
             }
?>
</title>
<?php
         }
         if ('full' == $html_par || 'js' == $html_par || '__no_record_found__' == $html_par || (is_array($html_par) && in_array('js', $html_par)) )
         {
            $this->grafico_flash_js();
         }
         if (!$this->graf_col && ('full' == $html_par || 'config' == $html_par || (is_array($html_par) && in_array('config', $html_par))) )
         {
            $this->grafico_flash_config_js();
            $nm_saida->saida("<link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" />\r\n");
         if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
         { 
            $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->str_google_fonts . "\" />\r\n");
         } 
         }
         if ('full' == $html_par || 'page' == $html_par || (is_array($html_par) && in_array('page', $html_par)) )
         {
?>
</head>
<body class="scGridPage">
<?php
         }
         if ('full' == $html_par || 'form' == $html_par || (is_array($html_par) && in_array('form', $html_par)) )
         {
            $this->grafico_flash_form();
         }
         if (!$this->graf_col && ('full' == $html_par || 'config' == $html_par || (is_array($html_par) && in_array('config', $html_par))) )
         {
            $this->grafico_flash_config_div();
         }
         if ('full' == $html_par || 'chart' == $html_par || (is_array($html_par) && in_array('chart', $html_par)) )
         {
            $this->grafico_flash_chart($width, $height, $sFileLocal, $export, $arr_charts, $arr_param['pdf']);
         }
         if ('__no_record_found__' == $html_par)
         {
            $this->grafico_flash_chart($width, $height, '__no_record_found__', $export, $arr_charts, $arr_param['pdf']);
         }
         if ('full' == $html_par || '__no_record_found__' == $html_par || (is_array($html_par) && in_array('js', $html_par)) )
         {
             $this->grafico_combination();
         }
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['phantomjs_export_process']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['phantomjs_export_process'])
         {
             return;
         }
         if ('full' == $html_par || 'page' == $html_par || (is_array($html_par) && in_array('chart', $html_par)) )
         {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] != "pdf")
            {
                if (empty($nm_retorno_graf))
                {
                    $nm_retorno_graf = "resumo";
                }
            }
         }
         if ('full' == $html_par || 'page' == $html_par || (is_array($html_par) && in_array('page', $html_par)) )
         {
?>
</body>
</html>
<?php
         }
   }

   function load_chart_theme()
   {
       $sChartTheme = '__theme';
       if (($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['opcao'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
       {
           $sChartTheme = 'scriptcase__NM__sc_GrayScale.php';
       }
       elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_print_bw']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['export_print_bw'])
       {
           $sChartTheme = 'scriptcase__NM__sc_GrayScale.php';
       }
       $prjFallback = '';
       if ('grp__NM__' == substr($this->Ini->str_chart_theme, 0, 9)) {
           $prjFallback = 'prj__NM__' . substr($this->Ini->str_chart_theme, 9);
       }
       if ('__app' == $sChartTheme)
       {
           return array(
           );
       }
       elseif ('__theme' == $sChartTheme && isset($this->Ini->str_chart_theme) && !empty($this->Ini->str_chart_theme) && is_file($this->Ini->path_chart_theme . $this->Ini->str_chart_theme . '.php'))
       {
           include $this->Ini->path_chart_theme . $this->Ini->str_chart_theme . '.php';
           return $__scChartTheme;
       }
       elseif ('__theme' == $sChartTheme && isset($prjFallback) && !empty($prjFallback) && is_file($this->Ini->path_chart_theme . $prjFallback . '.php'))
       {
           include $this->Ini->path_chart_theme . $prjFallback . '.php';
           return $__scChartTheme;
       }
       elseif ('' == $sChartTheme || !@is_file($this->Ini->path_chart_theme . $sChartTheme))
       {
           return false;
       }
       else
       {
           include $this->Ini->path_chart_theme . $sChartTheme;
           return $__scChartTheme;
       }
   }

   function formatSecondary($originalFormat)
   {
       $aSecFormat = array();
       foreach ($originalFormat as $sTag => $sValue) {
           switch ($sTag) {
               case 'decimals':
                   $aSecFormat['sDecimals'] = $sValue;
                   break;
               case 'decimalSeparator':
                   $aSecFormat['sDecimalSeparator'] = $sValue;
                   break;
               case 'thousandSeparator':
                   $aSecFormat['sThousandSeparator'] = $sValue;
                   break;
               case 'trailingZeros':
                   $aSecFormat['sTrailingZeros'] = $sValue;
                   break;
               case 'monetarySymbol':
                   $aSecFormat['sMonetarySymbol'] = $sValue;
                   break;
               case 'monetaryPosition':
                   $aSecFormat['sMonetaryPosition'] = $sValue;
                   break;
               case 'monetarySpace':
                   $aSecFormat['sMonetarySpace'] = $sValue;
                   break;
               case 'monetaryDecimal':
                   $aSecFormat['sMonetaryDecimal'] = $sValue;
                   break;
               case 'monetaryThousands':
                   $aSecFormat['sMonetaryThousands'] = $sValue;
                   break;
               case 'formatNumberScale':
                   $aSecFormat['sFormatNumberScale'] = $sValue;
                   break;
               case 'forceDecimals':
                   $aSecFormat['sForceDecimals'] = $sValue;
                   break;
               case 'numberPrefix':
                   $aSecFormat['sNumberPrefix'] = $sValue;
                   break;
               default:
                   $aSecFormat[$sTag] = $sValue;
                   break;
           }
       }
       return $aSecFormat;
   }
   function formatThemeSecondary(&$chartTheme)
   {
       foreach ($chartTheme as $sTag => $sValue) {
           if ('yAxisNameFont' == substr($sTag, 0, 13)) {
               $sTag = 'Y' . substr($sTag, 1);
               $chartTheme['p' . $sTag] = $sValue;
               $chartTheme['s' . $sTag] = $sValue;
           }
       }
   }

   function grafico_flash_xml($arr_param, $arr_series, $newline = "\r\n")
   {
       $tipo         = $arr_param['type'];
       $width        = $arr_param['width'];
       $height       = $arr_param['height'];
       $tit_datay    = $arr_param['tit_datay'];
       $tit_label    = $arr_param['tit_label'];
       $tit_graf     = $arr_param['tit_chart'];
       $export       = $arr_param['export'];
       $value_format = isset($arr_series[0]['format']) && '' != $arr_series[0]['format'] ? $arr_series[0]['format'] : (isset($arr_series[0]['formatfc']) && !empty($arr_series[0]['formatfc']) ? $arr_series[0]['formatfc'] : array());
       $is_combinat  = isset($arr_series[0]['comb']) ? $arr_series[0]['comb'] : false;

       $repeat_value = false;

       $chart_theme  = $this->load_chart_theme();

       $chart_attr_j = array();

       $chart_attr_j['showCalues'] = '';

       $bDisableLinks = false;
       $b_dual_axys   = false;
       if ($is_combinat)
       {
           if (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'], array('angulargauge', 'hlineargauge', 'msstepline', 'stackedarea', 'stackedbar2d', 'stackedbar3d', 'stackedcolumn2d', 'stackedcolumn3d')))
           {
               $bDisableLinks = true;
           }
           if ('' == $tit_label && isset($arr_series[0]['label_x']))
           {
               $tit_label = $arr_series[0]['label_x'];
           }
           if (1 == sizeof($arr_series))
           {
               if ('C' == $arr_series[0]['summ_fn'])
               {
                   $tit_datay = "";
               }
               else
               {
                   $tit_datay = "";
               }
               if ('' == $tit_datay)
               {
                   $tit_datay = $arr_series[0]['label_y'];
               }
           }
           else
           {
               $tit_datay = "";
               $pri_label = "";
               $sec_label = "";
               if ('' == $pri_label || '' == $sec_label)
               {
                   foreach ($arr_series as $i_serie => $a_serie)
                   {
                       if ('C' != $a_serie['summ_fn'] && '' == $pri_label)
                       {
                           $pri_label = $a_serie['label_y'];
                       }
                       elseif ('C' == $a_serie['summ_fn'] && '' == $sec_label)
                       {
                           $sec_label = $a_serie['label_y'];
                       }
                   }
               }
               $chart_attr_j['pyaxisname'] = $this->formatFusionLabel($pri_label);
               $chart_attr_j['syaxisname'] = $this->formatFusionLabel($sec_label);
           }
           $arr_formats      = array();
           $arr_format_count = array();
           $arr_labels       = array();
           $s_label_second   = '';
           $i_serie_count    = '';
           $i_serie_second   = '';
           foreach ($arr_series as $i_serie => $a_serie)
           {
               if ('C' == $a_serie['summ_fn'])
               {
                   $arr_format_count = $arr_series[$i_serie]['formatfc'];
                   $i_serie_count    = $i_serie;
               }
               else
               {
                   $arr_labels[$i_serie] = $a_serie['label_y'];
                   $arr_formats[]        = $arr_series[$i_serie]['formatfc'];
               }
               if (0 < $i_serie && '' === $i_serie_second)
               {
                   $i_serie_second = $i_serie;
               }
           }
           if (!empty($arr_format_count))
           {
               if (2 > count($arr_formats))
               {
                   if (1 == count($arr_formats))
                   {
                       $i_serie_second = $i_serie_count;
                       $s_label_second = $arr_series[$i_serie_count]['label_y'];
                   }
                   $arr_formats[] = $arr_format_count;
               }
               else
               {
                   $arr_formats[1] = $arr_format_count;
                   $i_serie_second = $i_serie_count;
               }
           }
           elseif (isset($arr_labels[1]))
           {
               unset($arr_labels[1]);
           }
           if (1 == sizeof($arr_formats))
           {
               $s_format_idx = key($arr_formats);
               $value_format = $arr_formats[0];
           }
           else
           {
               $b_dual_axys  = true;
               $value_format = array_merge($arr_formats[0], $this->formatSecondary($arr_formats[1]));
               $this->formatThemeSecondary($chart_theme);
               $chart_attr_j['pyaxisname'] = $this->formatFusionLabel(implode(', ', $arr_labels));
               $chart_attr_j['syaxisname'] = '' != $s_label_second ? $this->formatFusionLabel($s_label_second) : $this->formatFusionLabel($arr_series[1]['label_y']);
           }
       }

       if ($this->reload_as_analytic && !$bDisableLinks)
       {
            $bDisableLinks = true;
       }

       if (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'], array('angulargauge', 'semicirculargauge')))
       {
           $tipo        = 'Gauge';
           $is_combinat = false;
           $is_semi     = 'semicirculargauge' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'];
           if (sizeof($arr_series) > 1)
           {
               $tmp_arr_series = $arr_series[0];
               $arr_series     = array($tmp_arr_series);
           }
       }
       elseif ('hlineargauge' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'])
       {
           $tipo        = 'LinearGauge';
           $is_combinat = false;
           if (sizeof($arr_series) > 1)
           {
               $tmp_arr_series = $arr_series[0];
               $arr_series     = array($tmp_arr_series);
           }
       }
       elseif ('bubble' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'])
       {
           $tipo        = 'Bubble';
           $is_combinat = false;
       }
       elseif ('radar' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'])
       {
           $tipo        = 'Radar';
           $is_combinat = false;
       }
       elseif ('scatter' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'])
       {
           $tipo        = 'Scatter';
           $is_combinat = false;
       }
       elseif (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'], array('mscombidy2d', 'mscombi2d', 'mscolumn3dlinedy')))
       {
           $tipo = 'Bar';
       }
       elseif (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'], array('funnel', 'funnel2d')))
       {
           $tipo        = 'Funnel';
           $is_combinat = false;
           $is_2d       = 'funnel2d' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'];
           if (sizeof($arr_series) > 1)
           {
               $tmp_arr_series = $arr_series[0];
               $arr_series     = array($tmp_arr_series);
           }
           $chart_attr_j['showValues'] = '0';
       }
       elseif (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'], array('pyramid', 'pyramid2d')))
       {
           $tipo        = 'Pyramid';
           $is_combinat = false;
           $is_2d       = 'pyramid2d' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'];
           if (sizeof($arr_series) > 1)
           {
               $tmp_arr_series = $arr_series[0];
               $arr_series     = array($tmp_arr_series);
           }
           $chart_attr_j['showValues'] = '0';
       }
       elseif (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'], array('pie2d', 'pie3d', 'doughnut2d', 'doughnut3d')))
       {
           $tipo = 'Pie';
           $is_combinat = false;
           if (sizeof($arr_series) > 1)
           {
               $tmp_arr_series = $arr_series[0];
               $arr_series     = array($tmp_arr_series);
           }
           $chart_attr_j['showValues'] = '0';
       }
       elseif (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'], array('bar2d', 'bar3d', 'msbar2d', 'msbar3d', 'column2d', 'column3d', 'mscolumn2d', 'mscolumn3d', 'stackedbar2d', 'stackedbar3d', 'stackedcolumn2d', 'stackedcolumn3d')))
       {
           $tipo = 'Bar';
           $is_combinat = false;
           if (isset($arr_series[0]['summ_idx']) && !empty($arr_series[0]['summ_idx']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_display_values'][ ($arr_series[0]['summ_idx'] + 1) ]))
           {
               $chart_attr_j['showvalues'] = 1 == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_display_values'][ ($arr_series[0]['summ_idx'] + 1) ] ? '1' : '0';
           }
           else
           {
               $chart_attr_j['showValues'] = '1';
           }
       }
       elseif (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'], array('msarea', 'area2d', 'mssplinearea', 'splinearea', 'stackedarea', 'stackedarea2d')))
       {
           $tipo = 'Area';
           $is_combinat = false;
           if (isset($arr_series[0]['summ_idx']) && !empty($arr_series[0]['summ_idx']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_display_values'][ ($arr_series[0]['summ_idx'] + 1) ]))
           {
               $chart_attr_j['showvalues'] = 1 == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_display_values'][ ($arr_series[0]['summ_idx'] + 1) ] ? '1' : '0';
           }
           else
           {
               $chart_attr_j['showValues'] = '1';
           }
       }
       elseif (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'], array('msline', 'line', 'msspline', 'spline', 'msstepline')))
       {
           $tipo = 'Line';
           $is_combinat = false;
           if (isset($arr_series[0]['summ_idx']) && !empty($arr_series[0]['summ_idx']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_display_values'][ ($arr_series[0]['summ_idx'] + 1) ]))
           {
               $chart_attr_j['showvalues'] = 1 == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_display_values'][ ($arr_series[0]['summ_idx'] + 1) ] ? '1' : '0';
           }
           else
           {
               $chart_attr_j['showValues'] = '1';
           }
       }

       $chart_attr_j['trendlineColor'] = '#1aaf5d';
       if ($chart_theme)
       {
           foreach ($chart_theme as $chart_tag_name => $chart_tag_value)
           {
               if ('' != $chart_tag_value)
               {
                   $chart_attr_j[$chart_tag_name] = $chart_tag_value;
               }
           }
       }


       if ('Y' == $arr_param['pdf'] || (isset($_GET['nmgp_opcao']) && 'pdf' == $_GET['nmgp_opcao']))
       {

           if (!isset($chart_attr_j['animation']) || '0' != $chart_attr_j['animation'])
           {
               $chart_attr_j['animation'] = '0';
           }
       }

       $chart_attr_j['plotHoverEffect'] = '1';
       $toolTipValue = "\$dataValue";

       switch ($tipo)
       {
           case 'Bar':
               if ('Percent' == $arr_param['barra_empil'] && 1 < sizeof($arr_series))
               {
                   $chart_attr_j['stack100Percent']   = '1';
                   $chart_attr_j['showPercentValues'] = '0';
               }
               if ('Yes' == $arr_param['barra_sobre'] && 1 < sizeof($arr_series))
               {
                   $chart_attr_j['clustered'] = '0';
               }
               $chart_attr_j['placeValuesInside'] = '1';
               $chart_attr_j['rotateValues'] = '1';
               break;

           case 'Bubble':
               $chart_attr_j['showValues'] = '1';
               break;

           case 'Line':
               break;

           case 'Area':
               break;

           case 'Pie':
               $chart_attr_j['showLegend']    = '1';
               $chart_attr_j['use3DLighting'] = '0';
               if ('Percent' == $arr_param['pizza_valor'])
               {
                   $chart_attr_j['showPercentValues'] = '1';
                   $toolTipValue                      = "\$percentValue";
               }
               else
               {
                   $chart_attr_j['showPercentValues'] = '0';
               }
               break;

           case 'Funnel':
               $chart_attr_j['useSameSlantAngle'] = '1';
               $chart_attr_j['isHollow']          = '0';
               $chart_attr_j['showLegend']        = '1';
               $chart_attr_j['showLabels']        = '0';
               if ('2d' == $arr_param['funil_dimen'] || $is_2d)
               {
                   $chart_attr_j['is2D'] = '1';
               }
               break;

           case 'Pyramid':
               $chart_attr_j['showLegend'] = '1';
               $chart_attr_j['showLabels'] = '0';
               if ('2d' == $arr_param['pyram_dimen'] || $is_2d)
               {
                   $chart_attr_j['is2D'] = '1';
               }
               if ('Percent' == $arr_param['pyram_valor'])
               {
                   $repeat_value = true;
                   $chart_attr_j['showPercentValues'] = '1';
               }
               else
               {
                   $chart_attr_j['showPercentValues'] = '0';
               }
               if ('S' == $arr_param['pyram_forma'])
               {
                   $chart_attr_j['isSliced'] = '1';
               }
               else
               {
                   $chart_attr_j['isSliced'] = '0';
               }
               break;

           case 'Gauge':
           case 'LinearGauge':
               if ('Circular' == $arr_param['gauge_forma'] && !$is_semi)
               {
                   $chart_attr_j['gaugeStartAngle']   = '180';
                   $chart_attr_j['gaugeEndAngle']     = '-180';
                   $chart_attr_j['lowerLimitDisplay'] = ' ';
               }
               $iGaugeMin = 0;
               $iGaugeMax = 0;
               foreach ($arr_series as $arr_serie)
               {
                   $label = $arr_serie['label'];
                   $datay = $arr_serie['data'];
                   foreach ($label as $iIndex => $sLabel)
                   {
                       $iGaugeMin = min($iGaugeMin, $datay[$iIndex]);
                       $iGaugeMax = max($iGaugeMax, $datay[$iIndex]);
                   }
               }
               $iGaugeMin = floor($iGaugeMin);
               $iGaugeMax = $iGaugeMax * 1.2;
               if (100 < $iGaugeMax)
               {
                   $iGaugeMax = floor($iGaugeMax / 100) * 100;
               }
               elseif (10 < $iGaugeMax)
               {
                   $iGaugeMax = floor($iGaugeMax / 10) * 10;
               }
               elseif (10 < $iGaugeMax)
               {
                   $iGaugeMax = 10;
               }
               $chart_attr_j['lowerLimit'] = $iGaugeMin;
               $chart_attr_j['upperLimit'] = $iGaugeMax;
               break;
       }

       if ('' != $arr_series[0]['subtitle'])
       {
           $chart_attr_j['subCaption'] = $arr_series[0]['subtitle'];
       }
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_font']))
       {
           $chart_attr_j['baseFontSize'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_font'];
       }
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['chartpallet']) && false == $chart_theme)
       {
           $chart_attr_j['palette'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['chartpallet'];
       }

       foreach ($chart_attr_j as $sTmpTag => $sTmpVal)
       {
           if ('' === $sTmpVal)
           {
               unset($chart_attr_j[$sTmpTag]);
           }
       }

       if ('' == $tit_label) {
           $tmpLabel = '';
           $isDiff   = false;
           foreach ($arr_series as $serieData) {
               if ('' == $tmpLabel) {
                   $tmpLabel = $serieData['label_x'];
               }
               elseif ($tmpLabel != $serieData['label_x']) {
                   $isDiff = true;
               }
           }
           if (!$isDiff) {
               $tit_label = $tmpLabel;
           }
       }

       if ('' == $tit_datay) {
           $labelList = array();
           foreach ($arr_series as $serieData) {
               if (!in_array($serieData['label_y'], $labelList)) {
                   $labelList[] = $serieData['label_y'];
               }
           }
           if (!empty($labelList)) {
               $tit_datay = implode(', ', $labelList);
           }
       }

       $chart_attr_j['caption']   = $this->formatFusionLabel($tit_graf);
       $chart_attr_j['xAxisName'] = $this->formatFusionLabel($tit_label);
       $chart_attr_j['yAxisName'] = $this->formatFusionLabel($tit_datay);

       $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['this_chart_label'] = $chart_attr_j['caption'];
       if (isset($chart_attr_j['subCaption']) && '' != $chart_attr_j['subCaption']) {
           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['this_chart_label'] .= $chart_attr_j['subCaption'];
       }

       $a_json = is_array($value_format) ? ['chart' => array_merge($chart_attr_j, $value_format)] : ['chart' => $chart_attr_j];

       if (isset($a_json['chart']['formatNumberScale']) && 1 == $a_json['chart']['formatNumberScale'])
       {
           $a_json['chart']['numberScaleValue'] = '1000,1000,1000';
           $a_json['chart']['numberScaleUnit']  = 'K,M,B';
       }
       else
       {
           $a_json['chart']['formatNumberScale'] = 0;
       }

           $a_json['chart']['setAdaptiveYMin'] = 1;

       $link_call = 'newchart-jsonurl-' . $this->Ini->path_imag_temp . '/';
       if ('Gauge' == $tipo || 'LinearGauge' == $tipo)
       {
           $iMin = 0;
           $iMax = 0;
           foreach ($arr_series as $arr_serie)
           {
               $label = $arr_serie['label'];
               $datay = $arr_serie['data'];
               $link  = $arr_serie['xml_link'];
               foreach ($label as $iIndex => $sLabel)
               {
                   $iMin = min($iMin, $datay[$iIndex]);
                   $iMax = max($iMax, $datay[$iIndex]);
               }
           }
           if (10 > $iMax) $iMax = 10;
           $iMax    = ceil($iMax * 1.1);
           $iMaxInt = ($iMax - $iMin) / 10;
           $iMinInt = ($iMax - $iMin) / 40;

           if (false == $chart_theme)
           {
               $a_json['colorRange'] = ['color' => [[
                   'minValue' => '0',
                   'maxValue' => $iMax,
                   'code' => ''
               ]]];
           }
           elseif ('' != $chart_theme['css_chart_background_pallete_color'])
           {
               $aGaugeColors = explode(',', $chart_theme['css_chart_background_pallete_color']);
               $a_json['colorRange'] = ['color' => [[
                   'minValue' => '0',
                   'maxValue' => $iMax,
                   'code' => str_replace('#', '', $aGaugeColors[0])
               ]]];
           }
           else
           {
               $a_json['colorRange'] = ['color' => [[
                   'minValue' => '0',
                   'maxValue' => $iMax,
                   'code' => '9bc8f2'
               ]]];
           }
           $sGaugeMarker = 'Gauge' == $tipo ? 'dial' : 'pointer';
           $a_json[$sGaugeMarker . 's'] = [$sGaugeMarker => []];
           foreach ($arr_series as $arr_serie)
           {
               $label = $arr_serie['label'];
               $datay = $arr_serie['data'];
               $link  = $arr_serie['xml_link'];
               foreach ($label as $iIndex => $sLabel)
               {
                   if (isset($link[$iIndex]) && !$bDisableLinks)
                   {
                       $a_json[$sGaugeMarker . 's'][$sGaugeMarker][] = ['value' => $datay[$iIndex], 'tooltext' => $sLabel . ': ' . $datay[$iIndex], 'link' => $link_call . $link[$iIndex]];
                   }
                   else
                   {
                       $a_json[$sGaugeMarker . 's'][$sGaugeMarker][] = ['value' => $datay[$iIndex], 'tooltext' => $sLabel . ': ' . $datay[$iIndex]];
                   }
               }
           }
       }
       elseif (2 == sizeof($arr_series) && 'Scatter' == $tipo)
       {
           $label = $arr_series[0]['label'];
           $datay = $arr_series[0]['data'];
           $link  = $arr_series[0]['xml_link'];
           $a_data = [];
           foreach ($arr_series as $i => $arr_serie)
           {
               $label     = $arr_serie['label'];
               $dbval     = $arr_serie['db_values'];
               $datay     = $arr_serie['data'];
               $link      = $arr_serie['xml_link'];
               $link_anal = array();
               $link_anal = array();
               if (0 == $i)
               {
                   $a_json['chart']['xAxisName'] = $this->formatFusionLabel($arr_serie['name']);
               }
               elseif (1 == $i)
               {
                   $a_json['chart']['yAxisName'] = $this->formatFusionLabel($arr_serie['name']);
               }
               foreach ($label as $iIndex => $sLabel)
               {
                   if (!isset($a_data[$iIndex]['x']))
                   {
                       $a_data[$iIndex]['x'] = $datay[$iIndex];
                   }
                   else
                   {
                       $a_data[$iIndex]['y'] = $datay[$iIndex];
                   }
                   if (isset($a_data[$iIndex]['x']) && isset($a_data[$iIndex]['y']))
                   {
                       $a_data[$iIndex]['tooltext'] = "$sLabel, " . $a_data[$iIndex]['x'] . ", " . $a_data[$iIndex]['y'];
                   }
                   if (!$this->sc_graf_sint && isset($link_anal[$arr_serie['serie_val']][$iIndex]) && !$bDisableLinks)
                   {
                       $a_data[$iIndex]['link'] = $link_call . $link_anal[$arr_serie['serie_val']][$iIndex];
                   }
                   elseif (!is_array($link) && is_string($link) && false != strpos($link, '__SC_PLACEHOLDER__') && !$bDisableLinks)
                   {
                       $a_data[$iIndex]['link'] = $link_call . $this->getFusionLink(str_replace('__SC_PLACEHOLDER__', $dbval[$iIndex], $link));
                   }
                   elseif (isset($link[$iIndex]) && !$bDisableLinks)
                   {
                       $a_data[$iIndex]['link'] = $link_call . $link[$iIndex];
                   }
                   $a_data[$iIndex]['tooltext'] = "<b>{$arr_serie['label_x']}</b>: \$label<br><b>{$arr_serie['label_y']}</b>: " . $toolTipValue;
               }
           }
           $a_json['dataset'][] = ['showregressionline' => '1', 'data' => $a_data];
       }
       elseif (3 == sizeof($arr_series) && 'Bubble' == $tipo)
       {
           $label = $arr_series[0]['label'];
           $datay = $arr_series[0]['data'];
           $link  = $arr_series[0]['xml_link'];
           $a_data = [];
           foreach ($arr_series as $i => $arr_serie)
           {
               $label     = $arr_serie['label'];
               $dbval     = $arr_serie['db_values'];
               $datay     = $arr_serie['data'];
               $link      = $arr_serie['xml_link'];
               $link_anal = array();
               $link_anal = array();
               if (0 == $i)
               {
                   $a_json['chart']['xAxisName'] = $this->formatFusionLabel($arr_serie['name']);
               }
               elseif (1 == $i)
               {
                   $a_json['chart']['yAxisName'] = $this->formatFusionLabel($arr_serie['name']);
               }
               foreach ($label as $iIndex => $sLabel)
               {
                   $a_data[$iIndex]['name'] = $sLabel;
                   if (!isset($a_data[$iIndex]['x']))
                   {
                       $a_data[$iIndex]['x'] = $datay[$iIndex];
                   }
                   elseif (!isset($a_data[$iIndex]['y']))
                   {
                       $a_data[$iIndex]['y'] = $datay[$iIndex];
                   }
                   else
                   {
                       $a_data[$iIndex]['z'] = $datay[$iIndex];
                   }
                   if (isset($a_data[$iIndex]['x']) && isset($a_data[$iIndex]['y']) && isset($a_data[$iIndex]['z']))
                   {
                       $a_data[$iIndex]['tooltext'] = "$sLabel, " . $a_data[$iIndex]['x'] . ", " . $a_data[$iIndex]['y'] . ", " . $a_data[$iIndex]['z'];
                   }
                   if (!$this->sc_graf_sint && isset($link_anal[$arr_serie['serie_val']][$iIndex]) && !$bDisableLinks)
                   {
                       $a_data[$iIndex]['link'] = $link_call . $link_anal[$arr_serie['serie_val']][$iIndex];
                   }
                   elseif (!is_array($link) && is_string($link) && false != strpos($link, '__SC_PLACEHOLDER__') && !$bDisableLinks)
                   {
                       $a_data[$iIndex]['link'] = $link_call . $this->getFusionLink(str_replace('__SC_PLACEHOLDER__', $dbval[$iIndex], $link));
                   }
                   elseif (isset($link[$iIndex]) && !$bDisableLinks)
                   {
                       $a_data[$iIndex]['link'] = $link_call . $link[$iIndex];
                   }
                   $a_data[$iIndex]['tooltext'] = "<b>{$arr_serie['label_x']}</b>: \$label<br><b>{$arr_serie['label_y']}</b>: " . $toolTipValue;
               }
           }
           $a_json['dataset'][] = ['showregressionline' => '1', 'data' => $a_data];
       }
       elseif (1 < sizeof($arr_series) || 'Radar' == $tipo || 'Step' == $arr_param['linha_forma'] || $is_combinat || 'ms' == substr($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'], 0, 2))
       {
           $label = $arr_series[0]['label'];
           $datay = $arr_series[0]['data'];
           $link  = $arr_series[0]['xml_link'];
           $a_json['categories'] = [];
           $a_categories = [];
           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_chart_data'] = array('label' => array(), 'series' => array());
           foreach ($label as $iIndex => $sLabel)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_chart_data']['label'][] = $this->formatFusionLabel($sLabel);
               $a_categories[] = ['label' => $this->formatFusionLabel($sLabel)];
           }
           $a_json['categories'][] = ['category' => $a_categories];
           $a_json['dataset'] = [];
           foreach ($arr_series as $i_serie => $arr_serie)
           {
               $a_dataset = [];
               $label     = $arr_serie['label'];
               $dbval     = $arr_serie['db_values'];
               $datay     = $arr_serie['data'];
               $link      = $arr_serie['xml_link'];
               $link_anal = array();
               $series_nm = 1 == sizeof($arr_series) && 'Radar' == $tipo ? "" : " seriesName=\"" . $this->formatFusionLabel($arr_serie['name']) . "\"";
               if (1 != sizeof($arr_series) || 'Radar' != $tipo)
               {
                   $a_dataset['seriesName'] = $this->formatFusionLabel($arr_serie['name']);
               }

               $a_comb_serie_data = array('name' => $this->formatFusionLabel($arr_serie['name']), 'summ_idx' => $arr_serie['summ_idx'], 'values' => array());

               if (isset($arr_serie['summ_idx']) && !empty($arr_serie['summ_idx']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_display_values'][ ($arr_serie['summ_idx'] + 1) ]))
               {
                   $a_dataset['showvalues'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_display_values'][ ($arr_serie['summ_idx'] + 1) ] ? '1' : '0';
               }
               if ($is_combinat)
               {
                   if (isset($arr_serie['summ_idx']) && !empty($arr_serie['summ_idx']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_field_display_type'][ ($arr_serie['summ_idx'] + 1) ]))
                   {
                       $a_dataset['renderas'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_field_display_type'][ ($arr_serie['summ_idx'] + 1) ];
                   }
                   if ($i_serie == $i_serie_second)
                   {
                       $a_dataset['parentyaxis'] = 'S';
                   }
               }

               foreach ($label as $iIndex => $sLabel)
               {
                   $a_data = ['value' => $datay[$iIndex]];
                   if (!$this->sc_graf_sint && isset($link_anal[$arr_serie['serie_val']][$iIndex]) && !$bDisableLinks)
                   {
                       $a_data['link'] = $link_call . $link_anal[$arr_serie['serie_val']][$iIndex];
                   }
                   elseif (!is_array($link) && is_string($link) && false != strpos($link, '__SC_PLACEHOLDER__') && !$bDisableLinks)
                   {
                       $a_data['link'] = $link_call . $this->getFusionLink(str_replace('__SC_PLACEHOLDER__', $dbval[$iIndex], $link));
                   }
                   elseif (isset($link[$iIndex]) && !$bDisableLinks)
                   {
                       $a_data['link'] = $link_call . $link[$iIndex];
                   }
                   $a_comb_serie_data['values'][] = $datay[$iIndex];
                   if ($arr_serie['reload_analytic'] && '' != $arr_serie['name_label']) {
                       $a_data['tooltext'] = (isset($arr_serie['name']) ? "<b>{$arr_serie['name_label']}</b>: {$arr_serie['name']}<br>" : "") . "<b>{$arr_serie['label_x']}</b>: \$label<br><b>{$arr_serie['label_y']}</b>: " . $toolTipValue;
                   }
                   else {
                       $a_data['tooltext'] = "<b>{$arr_serie['label_x']}</b>: \$label<br><b>{$arr_serie['label_y']}</b>: " . $toolTipValue;
                   }
                   $a_dataset['data'][] = $a_data;
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_chart_data']['series'][] = $a_comb_serie_data;
               $a_json['dataset'][] = $a_dataset;
           }
       }
       else
       {
           $label = $arr_series[0]['label'];
           $dbval = $arr_series[0]['db_values'];
           $datay = $arr_series[0]['data'];
           $link  = $arr_series[0]['xml_link'];
           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_chart_data'] = array('label' => array(), 'series' => array());
           $a_comb_serie_data = array('name' => $this->formatFusionLabel($arr_series[0]['name']), 'summ_idx' => $arr_series[0]['summ_idx'], 'values' => array());
           $a_json['data'] = [];
           foreach ($label as $iIndex => $sLabel)
           {
               $a_item = ['label' => $this->formatFusionLabel($sLabel), 'value' => $datay[$iIndex]];
               if (!is_array($link) && is_string($link) && false != strpos($link, '__SC_PLACEHOLDER__') && !$bDisableLinks)
               {
                   $a_item['link'] = $link_call . $this->getFusionLink(str_replace('__SC_PLACEHOLDER__', $dbval[$iIndex], $link));
               }
               elseif (isset($link[$iIndex]) && !$bDisableLinks)
               {
                   $a_item['link'] = $link_call . $link[$iIndex];
               }
               $a_item['tooltext'] = "<b>{$arr_series[0]['label_x']}</b>: \$label<br><b>{$arr_series[0]['label_y']}</b>: " . $toolTipValue;
               $a_json['data'][] = $a_item;
               $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_chart_data']['label'][] = $this->formatFusionLabel($sLabel);
               $a_comb_serie_data['values'][] = $datay[$iIndex];
           }
           $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_chart_data']['series'][] = $a_comb_serie_data;
       }


       return json_encode($a_json);
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

   function formatFusionLabel($sLabel)
   {
       return str_replace(array('&nbsp;', '"'), array(' ', '&quot;'), $sLabel);
   }

   function grafico_flash_js()
   {
      global $nm_saida;

         $nm_saida->saida("<script type=\"text/javascript\" language=\"javascript\" src=\"" . $this->Ini->path_prod . "/third/fusioncharts/js/fusioncharts.js\"></script>\r\n");
   }

   function grafico_flash_form()
   {
      global $nm_saida;

      $sOpcao = isset($_GET['nmgp_opcao']) && 'pdf_res' == $_GET['nmgp_opcao'] ? 'pdf_res' : 'pdf';
?>
<form name="flashRedir" method="GET" action="./" style="display: none">
  <input type="hidden" name="flash_graf" value="pdf" />
  <input type="hidden" name="nmgp_opcao" value="<?php       echo NM_encode_input($sOpcao);                         ?>" />
  <input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($_GET['script_case_init']);       ?>" />
  <input type="hidden" name="nmgp_tipo_pdf" value="<?php    echo NM_encode_input($_GET['nmgp_tipo_pdf']);          ?>" />
  <input type="hidden" name="nmgp_parms_pdf" value="<?php   echo NM_encode_input($_GET['nmgp_parms_pdf']);         ?>" />
  <input type="hidden" name="nmgp_graf_pdf" value="<?php    echo NM_encode_input($_GET['nmgp_graf_pdf']);          ?>" />
</form>
<?php
   }

   function grafico_combination()
   {
        $Ind_groupby = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Ind_Groupby'];
        $aGroupbyFields = array(
            'available' => array(),
            'selected'  => array()
        );
        $aGroupbyFields['available']['continente'] = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['labels']['continente'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['labels']['continente'] : "Continente";
        $aGroupbyFields['available']['nombre'] = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['labels']['nombre'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['labels']['nombre'] : "Nombre";
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Gb_Free_cmp'] as $idx_groupby_field => $lab_groupby_field)
        {
            if (isset($aGroupbyFields['available'][$idx_groupby_field]))
            {
                $aGroupbyFields['selected'][$idx_groupby_field] = $aGroupbyFields['available'][$idx_groupby_field];
                unset($aGroupbyFields['available'][$idx_groupby_field]);
            }
        }
        $aSummFields = array(
            'available' => array(),
            'selected'  => array()
        );
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_control'][$Ind_groupby] as $l_field => $d_field)
        {
            foreach ($d_field['options'] as $d_sum)
            {
                $aSummFields['available'][] = array(
                    'label'  => $d_field['label'],
                    'id'     => $l_field,
                    'index'  => $d_sum['index'],
                    'option' => $d_sum['op'],
                );
            }
        }
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_order'][$Ind_groupby] as $i_sum)
        {
            if ('' != $i_sum && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_display'][$Ind_groupby][$i_sum]))
            {
                $d_sum = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_display'][$Ind_groupby][$i_sum];
                if ($d_sum['display'])
                {
                    $sLabel = $d_sum['label'];
                    $sId    = '';
                    $bFound = false;
                    foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_control'][$Ind_groupby] as $l_field => $d_field)
                    {
                        foreach ($d_field['options'] as $d_option)
                        {
                            if ($d_option['index'] == $i_sum)
                            {
                                $aSummFields['selected'][] = array(
                                    'label'  => $d_field['label'],
                                    'id'     => $l_field,
                                    'index'  => $d_option['index'],
                                    'option' => $d_option['op'],
                                );
                                $bFound = true;
                                foreach ($aSummFields['available'] as $i_summ_fld => $a_summ_fld)
                                {
                                    if ($a_summ_fld['index'] == $d_option['index'])
                                    {
                                        unset($aSummFields['available'][$i_summ_fld]);
                                    }
                                }
                            }
                        }
                        if ($bFound)
                        {
                            break;
                        }
                    }
                }
           }
       }

       if ('' != $this->Ini->Tree_img_col && '' != $this->Ini->Tree_img_exp)
       {
           $collapseHtmlCode = '<img src="' . $this->Ini->path_img_global . '/' . $this->Ini->Tree_img_col . '" />';
           $expandHtmlCode   = '<img src="' . $this->Ini->path_img_global . '/' . $this->Ini->Tree_img_exp . '" />';
       }
       else
       {
           $collapseHtmlCode = '-';
           $expandHtmlCode   = '+';
       }
?>
<script type="text/javascript">
 tp_graf_atual = 'bar';
 $(function() {
<?php
if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['responsive_chart']['active']) {
?>
  $(window).resize(function() {
   FusionCharts(scCombChartId).render();
  });
<?php
}
?>
  $("#sc-id-groupby-available, #sc-id-groupby-selected").sortable({
   connectWith: ".sc-ui-groupby-options",
   remove: function(event, ui) {
    var fieldList = $("#sc-id-groupby-selected").sortable("toArray");
    if (2 == fieldList.length) {
     if ($("#sc-id-drill-down-check").prop("disabled")) {
      $("#sc-id-drill-down-check").prop("disabled", false);
      $("#sc-id-drill-down-check").prop("checked", true);
      $("#sc-id-drill-down").val("Y");
     }
    }
    else {
     $("#sc-id-drill-down-check").prop("disabled", true);
     $("#sc-id-drill-down").val("Y");
    }
    if (fieldList.length) {
     scSaveChartChanges();
    }
   },
   update: function(event, ui) {
    var fieldList = $("#sc-id-groupby-selected").sortable("toArray");
    if (fieldList.length) {
     scSaveChartChanges();
    }
   }
  }).disableSelection();
  $("#sc-id-summ-available, #sc-id-summ-selected").sortable({
   connectWith: ".sc-ui-summ-options",
   remove: function(event, ui) {
    var fieldList = $("#sc-id-summ-selected").sortable("toArray");
    if (fieldList.length) {
     scSaveChartChanges();
    }
   },
   update: function(event, ui) {
    var fieldList = $("#sc-id-summ-selected").sortable("toArray");
    if (fieldList.length) {
     scSaveChartChanges();
    }
   }
  }).disableSelection();
  $("#sc-id-drill-down-check").click(function() {
   $("#sc-id-drill-down").val($("#sc-id-drill-down-check").prop("checked") ? "Y" : "N");
   scSaveChartChanges();
  });
  $(".sc-ui-item-option").mouseover(function() {
   $(this).css("cursor", "all-scroll");
  });
  $("#sc-id-grby-show").click(function() {
   $("#sc-id-grby-show").hide();
   $("#sc-id-grby-hide").show();
   $(".sc-ui-grby-rows").show();
  }).mouseover(function() {
   $(this).css("cursor", "pointer");
  });
  $("#sc-id-grby-hide").click(function() {
   $("#sc-id-grby-show").show();
   $("#sc-id-grby-hide").hide();
   $(".sc-ui-grby-rows").hide();
  }).mouseover(function() {
   $(this).css("cursor", "pointer");
  });
  $("#sc-id-summ-show").click(function() {
   $("#sc-id-summ-show").hide();
   $("#sc-id-summ-hide").show();
   $(".sc-ui-summ-rows").show();
  }).mouseover(function() {
   $(this).css("cursor", "pointer");
  });
  $("#sc-id-summ-hide").click(function() {
   $("#sc-id-summ-show").show();
   $("#sc-id-summ-hide").hide();
   $(".sc-ui-summ-rows").hide();
  }).mouseover(function() {
   $(this).css("cursor", "pointer");
  });
  $(".sc-ui-chart-types").click(function() {
   var optionId = $(this).attr("id").substr(17);
   $(".sc-ui-chart-options").hide();
   $("#sc-id-chart-options-" + optionId).show();
   $(".sc-ui-chart-types").removeClass("sc-ui-chart-type-selected");
   $(this).addClass("sc-ui-chart-type-selected");
  });
  $("#sc-id-chart-close").click(function() {
   scHideChartSelection();
  }).mouseover(function() {
   $(this).css("cursor", "pointer");
  });
  scPackGroupbyInfo();
  scPackSummInfo();
  scToggleAvailableCharts();
  $(".sc-ui-sumcfg-icon").click(function() {
   scHideChartConfig();
   scShowChartConfig($(this).attr("id").substr(13), $(this).offset());
  }).mouseover(function() {
   $(this).css("cursor", "pointer");
  });
  $("#sc-id-sort-close").click(function() {
   scHideSort();
  });
  $(".sc-ui-sort-option").click(function() {
   scSaveChartSorting($(this).attr("id").substr(11));
  }).mouseover(function() {
   $(this).css("cursor", "pointer");
  });
  $(".sc-ui-sumcfg-save").click(function() {
   scSaveChartConfig($(this).attr("id").substr(18));
  });
  $(".sc-ui-sumcfg-close").click(function() {
   scHideChartConfig();
  });
  $(".sc-ui-chart-option-type").click(function() {
   if ($(this).hasClass("sc-ui-chart-option-type-hover")) {
    scChangeChartType($(this).attr("id").substr(12));
    scHideChartSelection();
   }
  });
 });
 var sc_groupby_info, sc_summ_info, sc_chart_type = "<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'] ?>", fc_chart_type = "<?php echo $this->getChartType($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['bmulti'], $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['bcomb']) ?>";
 function scBindChartTypeClick(sSelector) {
  $(sSelector).addClass("sc-ui-chart-option-type-hover");
 }
 function scUnbindChartTypeClick(sSelector) {
  $(sSelector).removeClass("sc-ui-chart-option-type-hover");
 }
 function scChartTypeIcon(sSelector, sIcon) {
  $(sSelector).find("img").attr("src", "<?php echo $this->Ini->path_img_global ?>/" + sIcon);
 }
 function scToggleCustomization() {
<?php
       if (sizeof($aGroupbyFields['available']) + sizeof($aGroupbyFields['selected']) > 1)
       {
?>
  $("#sc-id-custom-groupby-div").toggle();
  $("#sc-id-custom-groupby").toggle();
<?php
       }
?>
  $("#sc-id-custom-summ-div").toggle();
  $("#sc-id-custom-summ").toggle();
   if($("#sc-id-custom-summ-div").css('display') == 'none')
   {
       $('#chart_custom_top').removeClass('selected');
       $('#chart_custom_bottom').removeClass('selected');
   }
   else
   {
       $('#chart_custom_top').addClass('selected');
       $('#chart_custom_bottom').addClass('selected');
   }
 }
 function scSaveChartChanges() {
  scPackGroupbyInfo();
  scPackSummInfo();
  multiMetrics = -1 != sc_summ_info.indexOf("@?@");
  multiDimensions = -1 != sc_groupby_info.indexOf("@?@");
  $.ajax({
   type: "POST",
   url: "Grafico_pais_sel_groupby.php",
   data: {
    nmgp_opcao: "ajax_SaveChartChanges",
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    path_img: "<?php echo NM_encode_input($this->Ini->path_img_global); ?>",
    path_btn: "<?php echo NM_encode_input($this->Ini->path_botoes); ?>",
    opc_ret: "resumo",
    campos_sel: sc_groupby_info,
    xaxys_fields: "",
    summ_fields: sc_summ_info,
    drill_down: multiDimensions ? $("#sc-id-drill-down").val() : "Y",
    fsel_ok: "OK",
    sel_groupby: "sc_free_group_by",
    embbed_groupby: "Y"
   }
  }).done(function(data) {
   if (data == '{"ss_time_out":true}') {
       nm_move();
   }
   scReloadChart("");
   scToggleAvailableCharts();
  });
 }
 function scReloadChart(chartType) {
  $.ajax({
   type: "POST",
   url: "index.php",
   data: {
    nmgp_opcao: "ajax_ReloadChart",
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    reload_comb_chart: "Y",
    fc_chart_type: fc_chart_type
   }
  }).done(function(data) {
   if (data == '{"ss_time_out":true}') {
       nm_move();
   }
   if ("" == chartType) {
    var temp_fc_chart_type;
    FusionCharts(scCombChartId).setJSONUrl(data);
    if ("" != sc_chart_type) {
     temp_fc_chart_type = scGetChartType(sc_chart_type);
     if (temp_fc_chart_type != fc_chart_type) {
      scChangeChartType(sc_chart_type);
     }
    }
   }
   else {
    var temp_fc_chart_type;
    temp_fc_chart_type = scGetChartType(chartType);
    if ("funnel2d" == temp_fc_chart_type) {
     temp_fc_chart_type = "funnel";
    }
    if ("pyramid2d" == temp_fc_chart_type) {
     temp_fc_chart_type = "pyramid";
    }
    if ("semicirculargauge" == temp_fc_chart_type) {
     temp_fc_chart_type = "angulargauge";
    }
    FusionCharts(scCombChartId).setJSONUrl(data);
    FusionCharts(scCombChartId).chartType(temp_fc_chart_type);
   }
  });
 }
 function scPackGroupbyInfo() {
  var fieldList, i, fieldName, selectedFields = new Array;
  fieldList = $("#sc-id-groupby-selected").sortable("toArray");
  for (i = 0; i < fieldList.length; i++) {
   fieldName = fieldList[i].substr(13);
   selectedFields.push(fieldName);
  }
  sc_groupby_info = selectedFields.join("@?@");
 }
 function scPackSummInfo() {
  var fieldList, i, fieldName, selectedFields = new Array;
  fieldList = $("#sc-id-summ-selected").sortable("toArray");
  for (i = 0; i < fieldList.length; i++) {
   fieldName = fieldList[i].substr(13);
   selectedFields.push(fieldName);
  }
  sc_summ_info = selectedFields.join("@?@");
 }
 function scShowCombinationTable() {
  scBlockUI();
  $.ajax({
   type: "POST",
   url: "index.php",
   data: {
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    nmgp_opcao: "ajax_comb_table"
   }
  }).done(function(data) {
   if (data == '{"ss_time_out":true}') {
       nm_move();
   }
   $("#sc-id-combination-content").html("");
   $("#sc-id-combination-content").html(data);
   $("#sc-id-combination-content").css({"height": "450px"});
   $("#sc-id-hide-comb-table").show();
   $("#sc-id-combination-table").show().css({
    "position": "absolute",
    "left": "50%",
    "top": "50%",
    "margin-left": -$("#sc-id-combination-table").outerWidth()/2,
    "margin-top": -$("#sc-id-combination-table").outerHeight()/2
   });
  });
 }
 function scShowExportFileScreen() {
<?php
   if ($_SESSION['scriptcase']['proc_mobile']) {
?>
   $('#sc-id-combination-content').toggleModalPane(true);
<?php
   } else {
?>
   tb_show('', "?#TB_inline&height=210&width=550&inlineId=sc-id-combination-table&modal=true");
<?php
   }
?>
 }
 function scHideCombinationTable() {
<?php
   if ($_SESSION['scriptcase']['proc_mobile']) {
?>
  history.back();
<?php
   } else {
?>
  tb_remove();
<?php
   }
?>
 }
 function scHideCombinationTableDiv() {
  $("#sc-id-combination-table").hide();
  $("#sc-id-combination-content").html("");
  scUnblockUI();
 }
 function scShowCombinationXls() {
  $.ajax({
   type: "POST",
   url: "index.php",
   data: {
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    nmgp_opcao: "xls_res"
   }
  }).done(function(data) {
   $("#sc-id-combination-content").html("");
   $("#sc-id-combination-content").html(data);
   $("#sc-id-combination-content").css({"height": "200px"});
   $("#sc-id-hide-comb-table").hide();
   scShowExportFileScreen();
  });
 }
 function scShowCombinationXml() {
  $.ajax({
   type: "POST",
   url: "index.php",
   data: {
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    nmgp_opcao: "xml_res"
   }
  }).done(function(data) {
   $("#sc-id-combination-content").html("");
   $("#sc-id-combination-content").html(data);
   $("#sc-id-combination-content").css({"height": "200px"});
   $("#sc-id-hide-comb-table").hide();
   scShowExportFileScreen();
  });
 }
 function scShowCombinationJson() {
  $.ajax({
   type: "POST",
   url: "index.php",
   data: {
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    nmgp_opcao: "json_res"
   }
  }).done(function(data) {
   $("#sc-id-combination-content").html("");
   $("#sc-id-combination-content").html(data);
   $("#sc-id-combination-content").css({"height": "200px"});
   $("#sc-id-hide-comb-table").hide();
   scShowExportFileScreen();
  });
 }
 function scShowCombinationCsv() {
  $.ajax({
   type: "POST",
   url: "index.php",
   data: {
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    nmgp_opcao: "csv_res"
   }
  }).done(function(data) {
   $("#sc-id-combination-content").html("");
   $("#sc-id-combination-content").html(data);
   $("#sc-id-combination-content").css({"height": "200px"});
   $("#sc-id-hide-comb-table").hide();
   scShowExportFileScreen();
  });
 }
 function scShowCombinationRtf() {
  $.ajax({
   type: "POST",
   url: "index.php",
   data: {
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    nmgp_opcao: "rtf_res"
   }
  }).done(function(data) {
   $("#sc-id-combination-content").html("");
   $("#sc-id-combination-content").html(data);
   $("#sc-id-combination-content").css({"height": "200px"});
   $("#sc-id-hide-comb-table").hide();
   scShowExportFileScreen();
  });
 }
 function scShowCombinationWord(exportType, exportColor, exportPwd) {
  $.ajax({
   type: "POST",
   url: "index.php",
   data: {
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    export_chart_bw: "bw" == exportColor ? "Y" : "N",
    export_pwd: exportPwd,
    nmgp_opcao: "word_res"
   }
  }).done(function(data) {
   $("#sc-id-combination-content").html("");
   $("#sc-id-combination-content").html(data);
   $("#sc-id-combination-content").css({"height": "200px"});
   $("#sc-id-hide-comb-table").hide();
   scShowExportFileScreen();
  });
 }
 function scShowCombinationImage(chartLevel, exportType, imagePassword) {
  var progressFile = "sc_prgfl_<?php echo md5(session_id() . microtime()); ?>";
  scBlockUI();
  $("#sc-id-image-export-process").show().css({
   "position": "absolute",
   "left": "50%",
   "top": "50%",
   "margin-left": -$("#sc-id-image-export-process").outerWidth()/2,
   "margin-top": -$("#sc-id-image-export-process").outerHeight()/2
  });
  $("#sc-id-image-export-progressbar").progressbar({value: 0});
  setTimeout(function() { scProgressCombinationImage(progressFile); }, 100);
  $.ajax({
   type: "POST",
   url: "index.php",
   data: {
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    export_progress_file: progressFile,
    chart_level: chartLevel,
    nmgp_password: imagePassword,
    nmgp_opcao: "image_res"
   }
  }).done(function(data) {
   if ("email" == exportType) {
    $("body").append("<div id='TB_window'></div>");
       $("#sc-id-image-export-process").hide();
    scUnblockUI();
    nm_submit_modal("<?php echo $this->Ini->path_link ?>Grafico_pais/Grafico_pais_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=image_res&sAdd=__E__sc_create_charts=S__E__sc_graf_pdf=S__E__chart_level=" + chartLevel + "&KeepThis=true&TB_iframe=true&modal=true", false);
   }
   else {
       document.FRES_chart_export_view.action = data;
       document.FRES_chart_export_view.submit();
       $("#sc-id-image-export-process").hide();
       scUnblockUI();
   }
  });
 }
 function scProgressCombinationImage(progressFile) {
  $.ajax({
   type: "POST",
   url: "Grafico_pais_check_image_export.php",
   data: {
    nmgp_opcao: "ajax_CombinationImage",
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    export_progress_file: "<?php echo "{$this->Ini->root}{$_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp']}/"; ?>" + progressFile,
   }
  }).done(function(data) {
   if (data == '{"ss_time_out":true}') {
       nm_move();
   }
   var dataParts = data.split("###");
   if ("nofile" != dataParts[0] && "ok" != dataParts[0]) {
    $("#sc-id-image-export-message").html(dataParts[0]);
    $("#sc-id-image-export-progressbar").progressbar("value", parseInt(dataParts[1]));
    setTimeout(function() { scProgressCombinationImage(progressFile); }, 200);
   }
  });
 }
 function scShowCombinationPrint(chartLevel, exportType, exportColor) {
  var progressFile = "sc_prgfl_<?php echo md5(session_id() . microtime()); ?>";
  scBlockUI();
  $("#sc-id-print-export-process").show().css({
   "position": "absolute",
   "left": "50%",
   "top": "50%",
   "margin-left": -$("#sc-id-print-export-process").outerWidth()/2,
   "margin-top": -$("#sc-id-print-export-process").outerHeight()/2
  });
  $("#sc-id-print-export-progressbar").progressbar({value: 0});
  setTimeout(function() { scProgressCombinationPrint(progressFile); }, 100);
  $.ajax({
   type: "POST",
   url: "index.php",
   data: {
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    export_progress_file: progressFile,
    export_chart_bw: "bw" == exportColor ? "Y" : "N",
    chart_level: chartLevel,
    nmgp_opcao: "print_res"
   }
  }).done(function(data) {
   if ("email" == exportType) {
    $("body").append("<div id='TB_window'></div>");
    $("#sc-id-print-export-process").hide();
    scUnblockUI();
    nm_submit_modal("<?php echo $this->Ini->path_link ?>Grafico_pais/Grafico_pais_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=print_res&sAdd=__E__sc_create_charts=S__E__sc_graf_pdf=S__E__chart_level=" + chartLevel + "&KeepThis=true&TB_iframe=true&modal=true", false);
   }
   else {
    document.FRES_chart_export_view.action = data;
    document.FRES_chart_export_view.submit();
    $("#sc-id-print-export-process").hide();
    scUnblockUI();
   }
  });
 }
 function scProgressCombinationPrint(progressFile) {
  $.ajax({
   type: "POST",
   url: "Grafico_pais_check_image_export.php",
   data: {
    nmgp_opcao: "ajax_comb_print",
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    export_progress_file: "<?php echo "{$this->Ini->root}{$_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp']}/"; ?>" + progressFile,
   }
  }).done(function(data) {
   if (data == '{"ss_time_out":true}') {
       nm_move();
   }
   var dataParts = data.split("###");
   if ("nofile" != dataParts[0] && "ok" != dataParts[0]) {
    $("#sc-id-print-export-message").html(dataParts[0]);
    $("#sc-id-print-export-progressbar").progressbar("value", parseInt(dataParts[1]));
    setTimeout(function() { scProgressCombinationPrint(progressFile); }, 200);
   }
  });
 }
 function scShowChartSelection(clickedObj) {
  scBlockUI();
  var clickPos = $(clickedObj).offset(), clickHeight = $(clickedObj).outerHeight();
  $("#sc-id-chart-selection").css({"left": clickPos.left, "top": (clickPos.top + clickHeight), "display": 'flex'});
 }
 function scHideChartSelection() {
  $("#sc-id-chart-selection").hide();
  scUnblockUI();
 }
 function scChangeChartTypeButton(chartType) {
  scChangeChartType(chartType);
  scHideChartSelection();
 }
 function scChangeChartType(chartType) {
  tp_graf_atual = '';
  if (chartType == 'bar2d' || chartType == 'bar3d' ||chartType == 'column2d' ||chartType == 'column3d') {
      tp_graf_atual = 'bar';
  } else {
  }
  if (chartType == 'line' || chartType == 'spline' || chartType == 'step') {
      tp_graf_atual = 'line';
  }
  if (chartType == 'area' || chartType == 'areaspline') {
      tp_graf_atual = 'area';
  }
  if (chartType == 'pie2d' || chartType == 'pie3d' || chartType == 'doughnut2d' || chartType == 'doughnut3d') {
      tp_graf_atual = 'pie';
  }
  if (chartType == 'combination2d' || chartType == 'combination3d') {
      tp_graf_atual = 'combo';
  }
  if (chartType == 'stackedbar2d' || chartType == 'stackedbar3d' || chartType == 'stackedcolumn2d' || chartType == 'stackedcolumn3d' || chartType == 'stackedarea') {
      tp_graf_atual = 'stack';
  }
  if ('' != tp_graf_atual && ($('#chart_' + tp_graf_atual + '_top').length || $('#chart_' + tp_graf_atual + '_bot').length)) {
   var btnObj = $('#chart_' + tp_graf_atual + '_top').length ? $('#chart_' + tp_graf_atual + '_top') : $('#chart_' + tp_graf_atual + '_bot');
   if (btnObj.hasClass('disabled')) {
    return;
   }
  }
  scToggleAvailableCharts();
  old_fc_chart_type = fc_chart_type;
  sc_chart_type = chartType;
  fc_chart_type = scGetChartType(sc_chart_type);
  scReloadChart(fc_chart_type);
 }
 function scReloadChartByType(oldChartType, newChartType) {
  return 'angulargauge' == oldChartType || 'angulargauge' == newChartType ||
         'semicirculargauge' == oldChartType || 'semicirculargauge' == newChartType ||
         'hlineargauge' == oldChartType || 'hlineargauge' == newChartType ||
         'pie2d' == oldChartType || 'pie2d' == newChartType ||
         'pie3d' == oldChartType || 'pie3d' == newChartType ||
         'doughnut2d' == oldChartType || 'doughnut2d' == newChartType ||
         'doughnut3d' == oldChartType || 'doughnut3d' == newChartType ||
         'pyramid' == oldChartType || 'pyramid' == newChartType ||
         'pyramid2d' == oldChartType || 'pyramid2d' == newChartType ||
         'funnel' == oldChartType || 'funnel' == newChartType ||
         'funnel2d' == oldChartType || 'funnel2d' == newChartType ||
         'radar' == oldChartType || 'radar' == newChartType ||
         'scatter' == oldChartType || 'scatter' == newChartType ||
         'bubble' == oldChartType || 'bubble' == newChartType;
 }
 function scGetChartType(chartType) {
  var newChartType, multiDimensions, multiMetrics;
  scPackGroupbyInfo();
  scPackSummInfo();
  multiDimensions = -1 != sc_groupby_info.indexOf("@?@");
  multiMetrics = -1 != sc_summ_info.indexOf("@?@");
  isAnalytic = multiDimensions && "N" == $("#sc-id-drill-down").val();
  switch (chartType) {
   case 'angulargauge':
    newChartType = "angulargauge";
    break;
   case 'semicirculargauge':
    newChartType = "semicirculargauge";
    break;
   case 'hlineargauge':
    newChartType = "hlineargauge";
    break;
   case 'area':
    newChartType = isAnalytic || multiMetrics ? "msarea" : "area2d";
    break;
   case 'areaspline':
    newChartType = isAnalytic || multiMetrics ? "mssplinearea" : "splinearea";
    break;
   case 'bar2d':
    newChartType = isAnalytic || multiMetrics ? "msbar2d" : "bar2d";
    break;
   case 'bar3d':
    newChartType = isAnalytic || multiMetrics ? "msbar3d" : "bar3d";
    break;
   case 'bubble':
    newChartType = "bubble";
    break;
   case 'column2d':
    newChartType = isAnalytic || multiMetrics ? "mscolumn2d" : "column2d";
    break;
   case 'column3d':
    newChartType = isAnalytic || multiMetrics ? "mscolumn3d" : "column3d";
    break;
   case 'combination2d':
    newChartType = multiMetrics ? "mscombidy2d" : "mscombi2d";
    break;
   case 'combination3d':
    newChartType = "mscolumn3dlinedy";
    break;
   case 'doughnut2d':
    newChartType = "doughnut2d";
    break;
   case 'doughnut3d':
    newChartType = "doughnut3d";
    break;
   case 'funnel':
    newChartType = "funnel";
    break;
   case 'funnel2d':
    newChartType = "funnel2d";
    break;
   case 'line':
    newChartType = isAnalytic || multiMetrics ? "msline" : "line";
    break;
   case 'pie2d':
    newChartType = "pie2d";
    break;
   case 'pie3d':
    newChartType = "pie3d";
    break;
   case 'pyramid':
    newChartType = "pyramid";
    break;
   case 'pyramid2d':
    newChartType = "pyramid2d";
    break;
   case 'radar':
    newChartType = "radar";
    break;
   case 'scatter':
    newChartType = "scatter";
    break;
   case 'spline':
    newChartType = isAnalytic || multiMetrics ? "msspline" : "spline";
    break;
   case 'stackedarea':
    newChartType = "stackedarea2d";
    break;
   case 'stackedbar2d':
    newChartType = "stackedbar2d";
    break;
   case 'stackedbar3d':
    newChartType = "stackedbar3d";
    break;
   case 'stackedcolumn2d':
    newChartType = "stackedcolumn2d";
    break;
   case 'stackedcolumn3d':
    newChartType = "stackedcolumn3d";
    break;
   case 'step':
    newChartType = "msstepline";
    break;
   default:
    newChartType = chartType;
    break;
  }
  return newChartType;
 }
 function scShowChartConfig(configId, clickPos) {
  if ("combination2d" == sc_chart_type || "combination3d" == sc_chart_type) {
   $(".sc-ui-sumcfg-type-select").show();
  }
  else {
   $(".sc-ui-sumcfg-type-select").hide();
  }
  scBlockUI();
  $("#sc-id-sumcfg-box-" + configId).css({"left": (clickPos.left - 5), "top": (clickPos.top + 20)}).show();
 }
 function scHideChartConfig(configId) {
  $(".sc-ui-sumcfg").hide();
  scUnblockUI();
 }
 function scShowSort(clickedObj) {
  scBlockUI();
  var fieldList, i, clickPos = $(clickedObj).offset(), clickHeight = $(clickedObj).outerHeight();
  fieldList = $("#sc-id-summ-selected").sortable("toArray");
  $(".sc-ui-sort-option-metric").hide();
  for (i = 0; i < fieldList.length; i++) {
   fieldName = fieldList[i].substr(13);
   $(".sc-ui-sort-option-metric-" + (fieldName - 2)).show();
  }
  $("#sc-id-sort").css({"left": clickPos.left, "top": (clickPos.top + clickHeight)}).show();
 }
 function scHideSort(configId) {
  $("#sc-id-sort").hide();
  scUnblockUI();
 }
 function scSaveChartSorting(sortOption) {
  var sortField = "";
  if ("asc-" == sortOption.substr(0, 4)) {
   sortField = sortOption.substr(4);
   sortOption = "asc";
  }
  else if ("desc-" == sortOption.substr(0, 5)) {
   sortField = sortOption.substr(5);
   sortOption = "desc";
  }
  if ($("#sc-id-sort-option-check-" + sortOption + "-" + sortField).attr("src") == scSortOptionChecked) {
   scHideSort();
   return;
  }
  $.ajax({
   type: "POST",
   url: "index.php",
   data: {
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    sort_option: sortOption,
    sort_field: sortField,
    nmgp_opcao: "ajax_comb_sort"
   }
  }).done(function(data) {
   if (data == '{"ss_time_out":true}') {
       nm_move();
   }
   scCheckSortOption(sortField, sortOption);
   scHideSort();
   scReloadChart("");
  });
 }
 function scCheckSortOption(sortField, sortOption) {
  $(".sc-ui-sort-option-check").attr("src", scSortOptionNotChecked);
  if ("" != sortField && "" != sortOption) {
   $("#sc-id-sort-option-check-" + sortOption + "-" + sortField).attr("src", scSortOptionChecked);
  }
 }
 function scSaveChartConfig(configId) {
  $.ajax({
   type: "POST",
   url: "index.php",
   data: {
    script_case_init: "<?php echo NM_encode_input($this->Ini->sc_page); ?>",
    sumcfg_field: configId,
    sumcfg_value: $("#sc-id-sumcfg-sel-" + configId).val(),
    sumcfg_display: $("#sc-id-sumcfg-val-y-" + configId).filter(":checked").length ? 1 : 0,
    nmgp_opcao: "ajax_comb_save"
   }
  }).done(function(data) {
   if (data == '{"ss_time_out":true}') {
       nm_move();
   }
   scHideChartConfig();
   scReloadChart("");
  });
 }
 function scToggleAvailableCharts() {
  var metricCount, dimensionCount;
  if ("" == sc_summ_info) {
   metricCount = 0;
  }
  else {
   metricCount = sc_summ_info.split("@?@").length;
  }
  if ("" == sc_groupby_info) {
   dimensionCount = 0;
  }
  else {
   dimensionCount = sc_groupby_info.split("@?@").length;
  }
  if (0 == metricCount || 0 == dimensionCount) {
   scDisableAllCharts();
  }
  else {
   scEnableAllCharts();
   if (1 == metricCount && 1 == dimensionCount) {
    scDisableStepChart();
    scDisableStackedBar2dChart();
    scDisableStackedBar3dChart();
    scDisableStackedColumn2dChart();
    scDisableStackedColumn3dChart();
    scDisableStackedAreaChart();
    scDisableCombination2dChart();
    scDisableCombination3dChart();
    scDisableScatterChart();
    scDisableBubbleChart();
    scDisableOverlappedBar2dChart();
    scDisableOverlappedColumn2dChart();
   }
   else {
    scDisableAngularGaugeChart();
    scDisableSemicircularGaugeChart();
    scDisableHorizontalGaugeChart();
    scDisablePyramid2dChart();
    scDisablePyramid3dChart();
    scDisableFunnel2dChart();
    scDisableFunnel3dChart();
    if (2 != metricCount) {
     scDisableScatterChart();
     scDisableOverlappedBar2dChart();
     scDisableOverlappedColumn2dChart();
    }
    if (3 != metricCount) {
     scDisableBubbleChart();
    }
    if (1 == metricCount && "Y" == $("#sc-id-drill-down").val()) {
     scDisableStackedBar2dChart();
     scDisableStackedBar3dChart();
     scDisableStackedColumn2dChart();
     scDisableStackedColumn3dChart();
     scDisableStackedAreaChart();
    }
    if (1 == metricCount) {
     scDisableCombination2dChart();
     scDisableCombination3dChart();
    }
    if (1 == dimensionCount) {
     scDisablePie2dChart();
     scDisablePie3dChart();
     scDisableDoughnut2dChart();
     scDisableDoughnut3dChart();
    }
   }
  }
 }
 function scEnableAllCharts() {
  scEnableBar2dChart();
  scEnableBar3dChart();
  scEnableScrollBar2dChart();
  scEnableOverlappedBar2dChart();
  scEnableColumn2dChart();
  scEnableColumn3dChart();
  scEnableScrollColumn2dChart();
  scEnableOverlappedColumn2dChart();
  scEnableLineChart();
  scEnableSplineChart();
  scEnableStepChart();
  scEnableScrollLine2dChart();
  scEnableZoomLineChart();
  scEnableAreaChart();
  scEnableAreaSplineChart();
  scEnableScrollArea2dChart();
  scEnablePie2dChart();
  scEnablePie3dChart();
  scEnableDoughnut2dChart();
  scEnableDoughnut3dChart();
  scEnableStackedBar2dChart();
  scEnableStackedBar3dChart();
  scEnableStackedColumn2dChart();
  scEnableStackedColumn3dChart();
  scEnableStackedAreaChart();
  scEnableCombination2dChart();
  scEnableCombination3dChart();
  scEnableAngularGaugeChart();
  scEnableSemicircularGaugeChart();
  scEnableHorizontalGaugeChart();
  scEnablePyramid2dChart();
  scEnablePyramid3dChart();
  scEnableFunnel2dChart();
  scEnableFunnel3dChart();
  scEnableRadarChart();
  scEnableScatterChart();
  scEnableBubbleChart();
 }
 function scDisableAllCharts() {
  scDisableBar2dChart();
  scDisableBar3dChart();
  scDisableScrollBar2dChart();
  scDisableOverlappedBar2dChart();
  scDisableColumn2dChart();
  scDisableColumn3dChart();
  scDisableScrollColumn2dChart();
  scDisableOverlappedColumn2dChart();
  scDisableLineChart();
  scDisableSplineChart();
  scDisableStepChart();
  scDisableScrollLine2dChart();
  scDisableZoomLineChart();
  scDisableAreaChart();
  scDisableAreaSplineChart();
  scDisableScrollArea2dChart();
  scDisablePie2dChart();
  scDisablePie3dChart();
  scDisableDoughnut2dChart();
  scDisableDoughnut3dChart();
  scDisableStackedBar2dChart();
  scDisableStackedBar3dChart();
  scDisableStackedColumn2dChart();
  scDisableStackedColumn3dChart();
  scDisableStackedAreaChart();
  scDisableCombination2dChart();
  scDisableCombination3dChart();
  scDisableAngularGaugeChart();
  scDisableSemicircularGaugeChart();
  scDisableHorizontalGaugeChart();
  scDisablePyramid2dChart();
  scDisablePyramid3dChart();
  scDisableFunnel2dChart();
  scDisableFunnel3dChart();
  scDisableRadarChart();
  scDisableScatterChart();
  scDisableBubbleChart();
 }
 function scEnableBar2dChart() {
  scBindChartTypeClick("#sc-id-chart-bar2d");
  scChartTypeIcon("#sc-id-chart-bar2d", "scriptcase__NM__ct_bar_bar_2d.png");
 }
 function scEnableBar3dChart() {
  scBindChartTypeClick("#sc-id-chart-bar3d");
  scChartTypeIcon("#sc-id-chart-bar3d", "scriptcase__NM__ct_bar_bar_3d.png");
 }
 function scEnableScrollBar2dChart() {
  scBindChartTypeClick("#sc-id-chart-scrollbar2d");
  scChartTypeIcon("#sc-id-chart-scrollbar2d", "scriptcase__NM__ct_bar_bar_2d_scroll.png");
 }
 function scEnableOverlappedBar2dChart() {
  scBindChartTypeClick("#sc-id-chart-overlappedbar2d");
  scChartTypeIcon("#sc-id-chart-overlappedbar2d", "scriptcase__NM__ct_bar_bar_2d_overlap.png");
 }
 function scEnableColumn2dChart() {
  scBindChartTypeClick("#sc-id-chart-column2d");
  scChartTypeIcon("#sc-id-chart-column2d", "scriptcase__NM__ct_bar_col_2d.png");
  if (typeof(scEnableBarChartButton_top) == 'function') { scEnableBarChartButton_top(); }
 }
 function scEnableColumn3dChart() {
  scBindChartTypeClick("#sc-id-chart-column3d");
  scChartTypeIcon("#sc-id-chart-column3d", "scriptcase__NM__ct_bar_col_3d.png");
 }
 function scEnableScrollColumn2dChart() {
  scBindChartTypeClick("#sc-id-chart-scrollcolumn2d");
  scChartTypeIcon("#sc-id-chart-scrollcolumn2d", "scriptcase__NM__ct_bar_col_2d_scroll.png");
 }
 function scEnableOverlappedColumn2dChart() {
  scBindChartTypeClick("#sc-id-chart-overlappedcolumn2d");
  scChartTypeIcon("#sc-id-chart-overlappedcolumn2d", "scriptcase__NM__ct_bar_col_2d_overlap.png");
 }
 function scEnableLineChart() {
  scBindChartTypeClick("#sc-id-chart-line");
  scChartTypeIcon("#sc-id-chart-line", "scriptcase__NM__ct_line_line.png");
  if (typeof(scEnableLineChartButton_top) == 'function') { scEnableLineChartButton_top(); }
 }
 function scEnableSplineChart() {
  scBindChartTypeClick("#sc-id-chart-spline");
  scChartTypeIcon("#sc-id-chart-spline", "scriptcase__NM__ct_line_spline.png");
 }
 function scEnableStepChart() {
  scBindChartTypeClick("#sc-id-chart-step");
  scChartTypeIcon("#sc-id-chart-step", "scriptcase__NM__ct_line_step.png");
 }
 function scEnableScrollLine2dChart() {
  scBindChartTypeClick("#sc-id-chart-scrollline2d");
  scChartTypeIcon("#sc-id-chart-scrollline2d", "scriptcase__NM__ct_line_line_scroll.png");
 }
 function scEnableZoomLineChart() {
  scBindChartTypeClick("#sc-id-chart-zoomline");
  scChartTypeIcon("#sc-id-chart-zoomline", "scriptcase__NM__ct_line_line_zoom.png");
 }
 function scEnableAreaChart() {
  scBindChartTypeClick("#sc-id-chart-area");
  scChartTypeIcon("#sc-id-chart-area", "scriptcase__NM__ct_area_area.png");
  if (typeof(scEnableAreaChartButton_top) == 'function') { scEnableAreaChartButton_top(); }
 }
 function scEnableAreaSplineChart() {
  scBindChartTypeClick("#sc-id-chart-areaspline");
  scChartTypeIcon("#sc-id-chart-areaspline", "scriptcase__NM__ct_area_spline.png");
 }
 function scEnableScrollArea2dChart() {
  scBindChartTypeClick("#sc-id-chart-scrollarea2d");
  scChartTypeIcon("#sc-id-chart-scrollarea2d", "scriptcase__NM__ct_area_area_scroll.png");
 }
 function scEnablePie2dChart() {
  scBindChartTypeClick("#sc-id-chart-pie2d");
  scChartTypeIcon("#sc-id-chart-pie2d", "scriptcase__NM__ct_pie_pie_2d.png");
  if (typeof(scEnablePieChartButton_top) == 'function') { scEnablePieChartButton_top(); }
 }
 function scEnablePie3dChart() {
  scBindChartTypeClick("#sc-id-chart-pie3d");
  scChartTypeIcon("#sc-id-chart-pie3d", "scriptcase__NM__ct_pie_pie_3d.png");
 }
 function scEnableDoughnut2dChart() {
  scBindChartTypeClick("#sc-id-chart-doughnut2d");
  scChartTypeIcon("#sc-id-chart-doughnut2d", "scriptcase__NM__ct_pie_donut_2d.png");
 }
 function scEnableDoughnut3dChart() {
  scBindChartTypeClick("#sc-id-chart-doughnut3d");
  scChartTypeIcon("#sc-id-chart-doughnut3d", "scriptcase__NM__ct_pie_donut_3d.png");
 }
 function scEnableStackedBar2dChart() {
  scBindChartTypeClick("#sc-id-chart-stackedbar2d");
  scChartTypeIcon("#sc-id-chart-stackedbar2d", "scriptcase__NM__ct_stack_bar_2d.png");
 }
 function scEnableStackedBar3dChart() {
  scBindChartTypeClick("#sc-id-chart-stackedbar3d");
  scChartTypeIcon("#sc-id-chart-stackedbar3d", "scriptcase__NM__ct_stack_bar_3d.png");
 }
 function scEnableStackedColumn2dChart() {
  scBindChartTypeClick("#sc-id-chart-stackedcolumn2d");
  scChartTypeIcon("#sc-id-chart-stackedcolumn2d", "scriptcase__NM__ct_stack_col_2d.png");
  if (typeof(scEnableStackedColumnChartButton_top) == 'function') { scEnableStackedColumnChartButton_top(); }
 }
 function scEnableStackedColumn3dChart() {
  scBindChartTypeClick("#sc-id-chart-stackedcolumn3d");
  scChartTypeIcon("#sc-id-chart-stackedcolumn3d", "scriptcase__NM__ct_stack_col_3d.png");
 }
 function scEnableStackedAreaChart() {
  scBindChartTypeClick("#sc-id-chart-stackedarea");
  scChartTypeIcon("#sc-id-chart-stackedarea", "scriptcase__NM__ct_stack_area.png");
 }
 function scEnableCombination2dChart() {
  scBindChartTypeClick("#sc-id-chart-combination2d");
  scChartTypeIcon("#sc-id-chart-combination2d", "scriptcase__NM__ct_comb_2d.png");
  if (typeof(scEnableCombinationChartButton_top) == 'function') { scEnableCombinationChartButton_top(); }
 }
 function scEnableCombination3dChart() {
  scBindChartTypeClick("#sc-id-chart-combination3d");
  scChartTypeIcon("#sc-id-chart-combination3d", "scriptcase__NM__ct_comb_3d.png");
 }
 function scEnableAngularGaugeChart() {
  scBindChartTypeClick("#sc-id-chart-angulargauge");
  scChartTypeIcon("#sc-id-chart-angulargauge", "scriptcase__NM__ct_other_gauge.png");
 }
 function scEnableSemicircularGaugeChart() {
  scBindChartTypeClick("#sc-id-chart-semicirculargauge");
  scChartTypeIcon("#sc-id-chart-semicirculargauge", "scriptcase__NM__ct_other_semicirculargauge.png");
 }
 function scEnableHorizontalGaugeChart() {
  scBindChartTypeClick("#sc-id-chart-hlineargauge");
  scChartTypeIcon("#sc-id-chart-hlineargauge", "scriptcase__NM__ct_other_lineargauge.png");
 }
 function scEnablePyramid2dChart() {
  scBindChartTypeClick("#sc-id-chart-pyramid2d");
  scChartTypeIcon("#sc-id-chart-pyramid2d", "scriptcase__NM__ct_other_pyram.png");
 }
 function scEnablePyramid3dChart() {
  scBindChartTypeClick("#sc-id-chart-pyramid");
  scChartTypeIcon("#sc-id-chart-pyramid", "scriptcase__NM__ct_other_pyram3d.png");
 }
 function scEnableFunnel2dChart() {
  scBindChartTypeClick("#sc-id-chart-funnel2d");
  scChartTypeIcon("#sc-id-chart-funnel2d", "scriptcase__NM__ct_other_funnel.png");
 }
 function scEnableFunnel3dChart() {
  scBindChartTypeClick("#sc-id-chart-funnel");
  scChartTypeIcon("#sc-id-chart-funnel", "scriptcase__NM__ct_other_funnel3d.png");
 }
 function scEnableRadarChart() {
  scBindChartTypeClick("#sc-id-chart-radar");
  scChartTypeIcon("#sc-id-chart-radar", "scriptcase__NM__ct_other_radar.png");
 }
 function scEnableScatterChart() {
  scBindChartTypeClick("#sc-id-chart-scatter");
  scChartTypeIcon("#sc-id-chart-scatter", "scriptcase__NM__ct_other_scatter.png");
 }
 function scEnableBubbleChart() {
  scBindChartTypeClick("#sc-id-chart-bubble");
  scChartTypeIcon("#sc-id-chart-bubble", "scriptcase__NM__ct_other_bubble.png");
 }
 function scDisableBar2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-bar2d");
  scChartTypeIcon("#sc-id-chart-bar2d", "scriptcase__NM__ct_bar_bar_2d_off.png");
 }
 function scDisableBar3dChart() {
  scUnbindChartTypeClick("#sc-id-chart-bar3d");
  scChartTypeIcon("#sc-id-chart-bar3d", "scriptcase__NM__ct_bar_bar_3d_off.png");
 }
 function scDisableScrollBar2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-scrollbar2d");
  scChartTypeIcon("#sc-id-chart-scrollbar2d", "scriptcase__NM__ct_bar_bar_2d_scroll_off.png");
 }
 function scDisableOverlappedBar2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-overlappedbar2d");
  scChartTypeIcon("#sc-id-chart-overlappedbar2d", "scriptcase__NM__ct_bar_bar_2d_overlap_off.png");
 }
 function scDisableColumn2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-column2d");
  scChartTypeIcon("#sc-id-chart-column2d", "scriptcase__NM__ct_bar_col_2d_off.png");
  if (typeof(scDisableBarChartButton_top) == 'function') { scDisableBarChartButton_top(); }
 }
 function scDisableColumn3dChart() {
  scUnbindChartTypeClick("#sc-id-chart-column3d");
  scChartTypeIcon("#sc-id-chart-column3d", "scriptcase__NM__ct_bar_col_3d_off.png");
 }
 function scDisableScrollColumn2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-scrollcolumn2d");
  scChartTypeIcon("#sc-id-chart-scrollcolumn2d", "scriptcase__NM__ct_bar_col_2d_scroll_off.png");
 }
 function scDisableOverlappedColumn2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-overlappedcolumn2d");
  scChartTypeIcon("#sc-id-chart-overlappedcolumn2d", "scriptcase__NM__ct_bar_col_2d_overlap_off.png");
 }
 function scDisableLineChart() {
  scUnbindChartTypeClick("#sc-id-chart-line");
  scChartTypeIcon("#sc-id-chart-line", "scriptcase__NM__ct_line_line_off.png");
  if (typeof(scDisableLineChartButton_top) == 'function') { scDisableLineChartButton_top(); }
 }
 function scDisableSplineChart() {
  scUnbindChartTypeClick("#sc-id-chart-spline");
  scChartTypeIcon("#sc-id-chart-spline", "scriptcase__NM__ct_line_spline_off.png");
 }
 function scDisableStepChart() {
  scUnbindChartTypeClick("#sc-id-chart-step");
  scChartTypeIcon("#sc-id-chart-step", "scriptcase__NM__ct_line_step_off.png");
 }
 function scDisableScrollLine2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-scrollline2d");
  scChartTypeIcon("#sc-id-chart-scrollline2d", "scriptcase__NM__ct_line_line_scroll_off.png");
 }
 function scDisableZoomLineChart() {
  scUnbindChartTypeClick("#sc-id-chart-zoomline");
  scChartTypeIcon("#sc-id-chart-zoomline", "scriptcase__NM__ct_line_line_zoom_off.png");
 }
 function scDisableAreaChart() {
  scUnbindChartTypeClick("#sc-id-chart-area");
  scChartTypeIcon("#sc-id-chart-area", "scriptcase__NM__ct_area_area_off.png");
  if (typeof(scDisableAreaChartButton_top) == 'function') { scDisableAreaChartButton_top(); }
 }
 function scDisableAreaSplineChart() {
  scUnbindChartTypeClick("#sc-id-chart-areaspline");
  scChartTypeIcon("#sc-id-chart-areaspline", "scriptcase__NM__ct_area_spline_off.png");
 }
 function scDisableScrollArea2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-scrollarea2d");
  scChartTypeIcon("#sc-id-chart-scrollarea2d", "scriptcase__NM__ct_area_area_scroll_off.png");
 }
 function scDisablePie2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-pie2d");
  scChartTypeIcon("#sc-id-chart-pie2d", "scriptcase__NM__ct_pie_pie_2d_off.png");
  if (typeof(scDisablePieChartButton_top) == 'function') { scDisablePieChartButton_top(); }
 }
 function scDisablePie3dChart() {
  scUnbindChartTypeClick("#sc-id-chart-pie3d");
  scChartTypeIcon("#sc-id-chart-pie3d", "scriptcase__NM__ct_pie_pie_3d_off.png");
 }
 function scDisableDoughnut2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-doughnut2d");
  scChartTypeIcon("#sc-id-chart-doughnut2d", "scriptcase__NM__ct_pie_donut_2d_off.png");
 }
 function scDisableDoughnut3dChart() {
  scUnbindChartTypeClick("#sc-id-chart-doughnut3d");
  scChartTypeIcon("#sc-id-chart-doughnut3d", "scriptcase__NM__ct_pie_donut_3d_off.png");
 }
 function scDisableStackedBar2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-stackedbar2d");
  scChartTypeIcon("#sc-id-chart-stackedbar2d", "scriptcase__NM__ct_stack_bar_2d_off.png");
 }
 function scDisableStackedBar3dChart() {
  scUnbindChartTypeClick("#sc-id-chart-stackedbar3d");
  scChartTypeIcon("#sc-id-chart-stackedbar3d", "scriptcase__NM__ct_stack_bar_3d_off.png");
 }
 function scDisableStackedColumn2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-stackedcolumn2d");
  scChartTypeIcon("#sc-id-chart-stackedcolumn2d", "scriptcase__NM__ct_stack_col_2d_off.png");
  if (typeof(scDisableStackedColumnChartButton_top) == 'function') { scDisableStackedColumnChartButton_top(); }
 }
 function scDisableStackedColumn3dChart() {
  scUnbindChartTypeClick("#sc-id-chart-stackedcolumn3d");
  scChartTypeIcon("#sc-id-chart-stackedcolumn3d", "scriptcase__NM__ct_stack_col_3d_off.png");
 }
 function scDisableStackedAreaChart() {
  scUnbindChartTypeClick("#sc-id-chart-stackedarea");
  scChartTypeIcon("#sc-id-chart-stackedarea", "scriptcase__NM__ct_stack_area_off.png");
 }
 function scDisableCombination2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-combination2d");
  scChartTypeIcon("#sc-id-chart-combination2d", "scriptcase__NM__ct_comb_2d_off.png");
  if (typeof(scDisableCombinationChartButton_top) == 'function') { scDisableCombinationChartButton_top(); }
 }
 function scDisableCombination3dChart() {
  scUnbindChartTypeClick("#sc-id-chart-combination3d");
  scChartTypeIcon("#sc-id-chart-combination3d", "scriptcase__NM__ct_comb_3d_off.png");
 }
 function scDisableAngularGaugeChart() {
  scUnbindChartTypeClick("#sc-id-chart-angulargauge");
  scChartTypeIcon("#sc-id-chart-angulargauge", "scriptcase__NM__ct_other_gauge_off.png");
 }
 function scDisableSemicircularGaugeChart() {
  scUnbindChartTypeClick("#sc-id-chart-semicirculargauge");
  scChartTypeIcon("#sc-id-chart-semicirculargauge", "scriptcase__NM__ct_other_semicirculargauge_off.png");
 }
 function scDisableHorizontalGaugeChart() {
  scUnbindChartTypeClick("#sc-id-chart-hlineargauge");
  scChartTypeIcon("#sc-id-chart-hlineargauge", "scriptcase__NM__ct_other_lineargauge_off.png");
 }
 function scDisablePyramid2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-pyramid2d");
  scChartTypeIcon("#sc-id-chart-pyramid2d", "scriptcase__NM__ct_other_pyram_off.png");
 }
 function scDisablePyramid3dChart() {
  scUnbindChartTypeClick("#sc-id-chart-pyramid");
  scChartTypeIcon("#sc-id-chart-pyramid", "scriptcase__NM__ct_other_pyram3d_off.png");
 }
 function scDisableFunnel2dChart() {
  scUnbindChartTypeClick("#sc-id-chart-funnel2d");
  scChartTypeIcon("#sc-id-chart-funnel2d", "scriptcase__NM__ct_other_funnel_off.png");
 }
 function scDisableFunnel3dChart() {
  scUnbindChartTypeClick("#sc-id-chart-funnel");
  scChartTypeIcon("#sc-id-chart-funnel", "scriptcase__NM__ct_other_funnel3d_off.png");
 }
 function scDisableRadarChart() {
  scUnbindChartTypeClick("#sc-id-chart-radar");
  scChartTypeIcon("#sc-id-chart-radar", "scriptcase__NM__ct_other_radar_off.png");
 }
 function scDisableScatterChart() {
  scUnbindChartTypeClick("#sc-id-chart-scatter");
  scChartTypeIcon("#sc-id-chart-scatter", "scriptcase__NM__ct_other_scatter_off.png");
 }
 function scDisableBubbleChart() {
  scUnbindChartTypeClick("#sc-id-chart-bubble");
  scChartTypeIcon("#sc-id-chart-bubble", "scriptcase__NM__ct_other_bubble_off.png");
 }
 function scBlockUI() {
  $("#sc-id-chart-blockui").show();
 }
 function scUnblockUI() {
  $("#sc-id-chart-blockui").hide();
 }
</script>
<tr>
 <td style="text-align: center; padding: 0 10px">
  <div id="sc-id-custom-groupby-div" class="scAppDivMoldura" style="display: none; padding: 0">
  <table id="sc-id-custom-groupby" style="display: none; border-collapse: collapse; border-width: 0; width: 100%">
  <tr>
  <td colspan="2" class="scAppDivHeader scAppDivHeaderText">
   <span id="sc-id-grby-show" style="display: none"><?php echo $expandHtmlCode; ?></span>
   <span id="sc-id-grby-hide"><?php echo $collapseHtmlCode; ?></span>
   <?php echo $this->Ini->Nm_lang['lang_chart_dimensions'] ?>
  </td>
  </tr>
  <tr class="sc-ui-grby-rows">
  <td style="padding: 2px 4px; font-weight: bold; text-align: right; width: 100px"><?php echo $this->Ini->Nm_lang['lang_chart_available'] ?></td>
  <td style="padding: 2px 4px">
  <ul id="sc-id-groupby-available" class="sc-ui-groupby-options scAppDivSelectFields" style="display: inline-block; width: 99.5%">
<?php
       foreach ($aGroupbyFields['available'] as $i_groupby_fld => $l_groupby_fld)
       {
?>
   <li id="sc-id-grpitm-<?php echo $i_groupby_fld; ?>" class="sc-ui-item-option scAppDivSelectFieldsEnabled sc-ui-overflow-groupby"><?php echo $l_groupby_fld; ?></li>
<?php
       }
?>
  </ul>
  </td>
  </tr>
  <tr class="sc-ui-grby-rows">
  <td style="padding: 2px 4px; font-weight: bold; text-align: right; width: 100px"><?php echo $this->Ini->Nm_lang['lang_chart_selected'] ?></td>
  <td style="padding: 2px 4px">
  <ul id="sc-id-groupby-selected" class="sc-ui-groupby-options scAppDivSelectFields" style="display: inline-block; width: 99.5%">
<?php
       foreach ($aGroupbyFields['selected'] as $i_groupby_fld => $l_groupby_fld)
       {
?>
   <li id="sc-id-grpitm-<?php echo $i_groupby_fld; ?>" class="sc-ui-item-option scAppDivSelectFieldsEnabled sc-ui-overflow-groupby"><?php echo $l_groupby_fld; ?></li>
<?php
       }
?>
  </ul>
  </td>
  </tr>
  <tr class="sc-ui-grby-rows">
  <td style="padding: 2px 4px; font-weight: bold; text-align: right; width: 100px"><?php echo $this->Ini->Nm_lang['lang_chart_drill_down'] ?></td>
  <td style="padding: 2px 4px; text-align: left">
  <?php
  $strDrillDown = ' checked';
  $strDrillDownVal = 'Y';
  if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_drill_down']))
  {
      if($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_drill_down'])
      {
          $strDrillDown = ' checked';
          $strDrillDownVal = 'Y';
      }
      else
      {
          $strDrillDown = ' ';
          $strDrillDownVal = 'N';
      }
  }
  ?>
   <input type="checkbox" id="sc-id-drill-down-check" <?php echo $strDrillDown; ?> /> <label for="sc-id-drill-down-check"><?php echo $this->Ini->Nm_lang['lang_chart_drill_down_use'] ?></label>
   <input type="hidden" id="sc-id-drill-down" value="<?php echo $strDrillDownVal; ?>" />
  </tr>
  </table>
  </div>
  <div id="sc-id-custom-summ-div" class="scAppDivMoldura" style="display: none; padding: 0">
  <table id="sc-id-custom-summ" style="display: none; border-collapse: collapse; border-width: 0; width: 100%">
  <tr>
  <td colspan="2" class="scAppDivHeader scAppDivHeaderText">
   <span id="sc-id-summ-show" style="display: none"><?php echo $expandHtmlCode; ?></span>
   <span id="sc-id-summ-hide"><?php echo $collapseHtmlCode; ?></span>
   <?php echo $this->Ini->Nm_lang['lang_chart_metrics'] ?>
  </td>
  </tr>
  <tr class="sc-ui-summ-rows">
  <td style="padding: 2px 4px; font-weight: bold; text-align: right; width: 100px"><?php echo $this->Ini->Nm_lang['lang_chart_available'] ?></td>
  <td style="padding: 2px 4px">
  <ul id="sc-id-summ-available" class="sc-ui-summ-options scAppDivSelectFields" style="display: inline-block; width: 99.5%">
<?php
       foreach ($aSummFields['available'] as $i_summ_fld => $a_summ_fld)
       {
?>
   <li id="sc-id-sumitm-<?php echo $a_summ_fld['index']; ?>" class="sc-ui-item-option scAppDivSelectFieldsEnabled">
    <div>
     <div class="sc-ui-overflow-summ" title="<?php echo $a_summ_fld['label']; ?>"><?php echo $a_summ_fld['label']; ?></div>
     <div style="float: right"><img id="sc-id-sumcfg-<?php echo $a_summ_fld['index']; ?>" class="sc-ui-sumcfg-icon" src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__gear_16.png"></div>
    </div>
   </li>
<?php
       }
?>
  </ul>
  </td>
  </tr>
  <tr class="sc-ui-summ-rows">
  <td style="padding: 2px 4px; font-weight: bold; text-align: right; width: 100px"><?php echo $this->Ini->Nm_lang['lang_chart_selected'] ?></td>
  <td style="padding: 2px 4px">
  <ul id="sc-id-summ-selected" class="sc-ui-summ-options scAppDivSelectFields" style="display: inline-block; width: 99.5%">
<?php
       foreach ($aSummFields['selected'] as $i_summ_fld => $a_summ_fld)
       {
?>
   <li id="sc-id-sumitm-<?php echo $a_summ_fld['index']; ?>" class="sc-ui-item-option scAppDivSelectFieldsEnabled">
    <div>
     <div class="sc-ui-overflow-summ" title="<?php echo $a_summ_fld['label']; ?>"><?php echo $a_summ_fld['label']; ?></div>
     <div style="float: right"><img id="sc-id-sumcfg-<?php echo $a_summ_fld['index']; ?>" class="sc-ui-sumcfg-icon" src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__gear_16.png"></div>
    </div>
   </li>
<?php
       }
?>
  </ul>
  </td>
  </tr>
  </table>
  </div>
<?php
       $aSumAll = array_merge($aSummFields['available'], $aSummFields['selected']);
       foreach ($aSumAll as $i_summ_fld => $a_summ_fld)
       {
           $s_test_value = isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_field_display_type'][ $a_summ_fld['index'] ]) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['comb_field_display_type'][ $a_summ_fld['index'] ] : '';
           if (true === $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_display_values'][ $a_summ_fld['index'] ]) {
               $checkYes = ' checked';
               $checkNo  = '';
           }
           elseif (false === $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_display_values'][ $a_summ_fld['index'] ]) {
               $checkYes = '';
               $checkNo  = ' checked';
           }
           else {
               $checkYes = ' checked';
               $checkNo  = '';
           }
?>
   <div id="sc-id-sumcfg-box-<?php echo $a_summ_fld['index']; ?>" class="sc-ui-sumcfg">
    <span class="sc-ui-sumcfg-type-select">
    <?php echo $this->Ini->Nm_lang['lang_chart_display_as'] ?>
    <br />
    <select id="sc-id-sumcfg-sel-<?php echo $a_summ_fld['index']; ?>">
     <option value="bar"<?php if ('bar' == $s_test_value) { echo ' selected'; } ?>><?php echo $this->Ini->Nm_lang['lang_chart_display_as_bar'] ?></option>
     <option value="line"<?php if ('line' == $s_test_value) { echo ' selected'; } ?>><?php echo $this->Ini->Nm_lang['lang_chart_display_as_line'] ?></option>
     <option value="area"<?php if ('area' == $s_test_value) { echo ' selected'; } ?>><?php echo $this->Ini->Nm_lang['lang_chart_display_as_area'] ?></option>
    </select>
    <br />
    <br />
    </span>
    <?php echo $this->Ini->Nm_lang['lang_chart_display_value'] ?>
    <br />
    <input type="radio" name="sc-name-sumcfg-val-<?php echo $a_summ_fld['index']; ?>" id="sc-id-sumcfg-val-y-<?php echo $a_summ_fld['index']; ?>" value="Y"<?php echo $checkYes ?> /> <label for="sc-id-sumcfg-val-y-<?php echo $a_summ_fld['index']; ?>"><?php echo $this->Ini->Nm_lang['lang_chart_display_value_yes'] ?></label>
    &nbsp;
    <input type="radio" name="sc-name-sumcfg-val-<?php echo $a_summ_fld['index']; ?>" id="sc-id-sumcfg-val-n-<?php echo $a_summ_fld['index']; ?>" value="N"<?php echo $checkNo ?> /> <label for="sc-id-sumcfg-val-n-<?php echo $a_summ_fld['index']; ?>"><?php echo $this->Ini->Nm_lang['lang_chart_display_value_no'] ?></label>
    <br />
    <br />
    <span style="white-space: nowrap">
   <?php echo nmButtonOutput($this->Ini->arr_buttons, "bapply_appdiv", "", "", "sc-id-sumcfg-save-{$a_summ_fld['index']}", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "sc-ui-sumcfg-save", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
   <?php echo nmButtonOutput($this->Ini->arr_buttons, "bcancelar_appdiv", "", "", "sc-id-sumcfg-close-{$a_summ_fld['index']}", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "sc-ui-sumcfg-close", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
    </span>
   </div>
<?php
       }
?>
   <div id="sc-id-sort">
    <script type="text/javascript">
     var scSortOptionChecked = "<?php echo $this->Ini->path_img_global ?>/check_16.png";
     var scSortOptionNotChecked = "<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__nm_transparent.gif";
    </script>
<?php
       foreach ($aSumAll as $i_summ_fld => $a_summ_fld)
       {
           $sImgAsc  = 'scSortOptionNotChecked';
           $sImgDesc = 'scSortOptionNotChecked';
           if ('asc' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_rule'] && $a_summ_fld['index'] - 2 === $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_field'])
           {
               $sImgAsc = 'scSortOptionChecked';
           }
           elseif ('desc' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_rule'] && $a_summ_fld['index'] - 2 === $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_field'])
           {
               $sImgDesc = 'scSortOptionChecked';
           }
?>
    <div id="sc-id-sort-asc-<?php echo ($a_summ_fld['index'] - 2) ?>" class="sc-ui-sort-option sc-ui-sort-option-metric sc-ui-sort-option-metric-<?php echo ($a_summ_fld['index'] - 2) ?>"><script type="text/javascript">document.write("<img src='" + <?php echo $sImgAsc ?> + "' class='sc-ui-sort-option-check' id='sc-id-sort-option-check-asc-<?php echo ($a_summ_fld['index'] - 2) ?>' />")</script> <?php echo $a_summ_fld['label'] . ' ' . $this->Ini->Nm_lang['lang_chart_sort_asc'] ?></div>
    <div id="sc-id-sort-desc-<?php echo ($a_summ_fld['index'] - 2) ?>" class="sc-ui-sort-option sc-ui-sort-option-metric sc-ui-sort-option-metric-<?php echo ($a_summ_fld['index'] - 2) ?>"><script type="text/javascript">document.write("<img src='" + <?php echo $sImgDesc ?> + "' class='sc-ui-sort-option-check' id='sc-id-sort-option-check-desc-<?php echo ($a_summ_fld['index'] - 2) ?>' />")</script> <?php echo $a_summ_fld['label'] . ' ' . $this->Ini->Nm_lang['lang_chart_sort_desc'] ?></div>
<?php
       }
       $sImgAsc  = 'scSortOptionNotChecked';
       $sImgDesc = 'scSortOptionNotChecked';
       if ('asc' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_rule'] && 'label' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_field'])
       {
           $sImgAsc = 'scSortOptionChecked';
       }
       elseif ('desc' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_rule'] && 'label' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_field'])
       {
           $sImgDesc = 'scSortOptionChecked';
       }
?>
    <div id="sc-id-sort-asc-label" class="sc-ui-sort-option"><script type="text/javascript">document.write("<img src='" + <?php echo $sImgAsc ?> + "' class='sc-ui-sort-option-check' id='sc-id-sort-option-check-asc-label' />")</script> <?php echo $this->Ini->Nm_lang['lang_chart_sort_dimension'] . ' ' . $this->Ini->Nm_lang['lang_chart_sort_asc'] ?></div>
    <div id="sc-id-sort-desc-label" class="sc-ui-sort-option"><script type="text/javascript">document.write("<img src='" + <?php echo $sImgDesc ?> + "' class='sc-ui-sort-option-check' id='sc-id-sort-option-check-desc-label' />")</script> <?php echo $this->Ini->Nm_lang['lang_chart_sort_dimension'] . ' ' . $this->Ini->Nm_lang['lang_chart_sort_desc'] ?></div>
<?php
       $sImgOrig = 'scSortOptionNotChecked';
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_forced']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_order_forced'])
       {
           $sImgOrig = 'scSortOptionChecked';
       }
?>
    <div id="sc-id-sort-orig" class="sc-ui-sort-option"><script type="text/javascript">document.write("<img src='" + <?php echo $sImgOrig ?> + "' class='sc-ui-sort-option-check' id='sc-id-sort-option-check-asc-label' />")</script> <?php echo $this->Ini->Nm_lang['lang_chart_sort_orig'] ?></div>
   <?php echo nmButtonOutput($this->Ini->arr_buttons, "bcancelar_appdiv", "", "", "sc-id-sort-close", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
   </div>
 <div id="sc-id-chart-selection">
  <div id="sc-id-chart-menu-type">
   <div id="sc-id-chart-type-bar" class="sc-ui-chart-types sc-ui-chart-type-selected"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__sc_ico_bar_c.png"> <?php echo $this->Ini->Nm_lang['lang_chart_type_bar'] ?></div>
   <div id="sc-id-chart-type-line" class="sc-ui-chart-types"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__sc_ico_line_c.png"> <?php echo $this->Ini->Nm_lang['lang_chart_type_line'] ?></div>
   <div id="sc-id-chart-type-area" class="sc-ui-chart-types"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__sc_ico_area_c.png"> <?php echo $this->Ini->Nm_lang['lang_chart_type_area'] ?></div>
   <div id="sc-id-chart-type-pie" class="sc-ui-chart-types"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__sc_ico_pizza_c.png"> <?php echo $this->Ini->Nm_lang['lang_chart_type_pie'] ?></div>
   <div id="sc-id-chart-type-stacked" class="sc-ui-chart-types"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__sc_ico_stack_c.png"> <?php echo $this->Ini->Nm_lang['lang_chart_type_stacked'] ?></div>
   <div id="sc-id-chart-type-combination" class="sc-ui-chart-types"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__sc_ico_combo_c.png"> <?php echo $this->Ini->Nm_lang['lang_chart_type_combination'] ?></div>
   <div id="sc-id-chart-type-gauge" class="sc-ui-chart-types"><?php echo $this->Ini->Nm_lang['lang_chart_type_gauge'] ?></div>
   <div id="sc-id-chart-type-other" class="sc-ui-chart-types"><?php echo $this->Ini->Nm_lang['lang_chart_type_other'] ?></div>
   <br />
   <br />
   <?php echo nmButtonOutput($this->Ini->arr_buttons, "bcancelar_appdiv", "", "", "sc-id-chart-close", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
  </div>
  <div id="sc-id-chart-options-bar" class="sc-ui-chart-options">
   <span id="sc-id-chart-bar2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_bar_bar_2d.png"></span>
   <span id="sc-id-chart-bar3d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_bar_bar_3d.png"></span>
   <span id="sc-id-chart-column2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_bar_col_2d.png"></span>
   <span id="sc-id-chart-column3d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_bar_col_3d.png"></span>
   <span id="sc-id-chart-scrollbar2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_bar_bar_2d_scroll.png"></span>
   <span id="sc-id-chart-overlappedbar2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_bar_bar_2d_overlap.png"></span>
   <span id="sc-id-chart-scrollcolumn2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_bar_col_2d_scroll.png"></span>
   <span id="sc-id-chart-overlappedcolumn2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_bar_col_2d_overlap.png"></span>
  </div>
  <div id="sc-id-chart-options-line" class="sc-ui-chart-options" style="display: none">
   <span id="sc-id-chart-line" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_line_line.png"></span>
   <span id="sc-id-chart-spline" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_line_spline.png"></span>
   <span id="sc-id-chart-step" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_line_step.png"></span>
   <span id="sc-id-chart-scrollline2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_line_line_scroll.png"></span>
   <span id="sc-id-chart-zoomline" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_line_line_zoom.png"></span>
  </div>
  <div id="sc-id-chart-options-area" class="sc-ui-chart-options" style="display: none">
   <span id="sc-id-chart-area" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_area_area.png"></span>
   <span id="sc-id-chart-areaspline" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_area_spline.png"></span>
   <span id="sc-id-chart-scrollarea2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_area_area_scroll.png"></span>
  </div>
  <div id="sc-id-chart-options-pie" class="sc-ui-chart-options" style="display: none">
   <span id="sc-id-chart-pie2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_pie_pie_2d.png"></span>
   <span id="sc-id-chart-pie3d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_pie_pie_3d.png"></span>
   <span id="sc-id-chart-doughnut2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_pie_donut_2d.png"></span>
   <span id="sc-id-chart-doughnut3d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_pie_donut_3d.png"></span>
  </div>
  <div id="sc-id-chart-options-stacked" class="sc-ui-chart-options" style="display: none">
   <span id="sc-id-chart-stackedbar2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_stack_bar_2d.png"></span>
   <span id="sc-id-chart-stackedbar3d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_stack_bar_3d.png"></span>
   <span id="sc-id-chart-stackedcolumn2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_stack_col_2d.png"></span>
   <span id="sc-id-chart-stackedcolumn3d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_stack_col_3d.png"></span>
   <span id="sc-id-chart-stackedarea" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_stack_area.png"></span>
  </div>
  <div id="sc-id-chart-options-combination" class="sc-ui-chart-options" style="display: none">
   <span id="sc-id-chart-combination2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_comb_2d.png"></span>
   <span id="sc-id-chart-combination3d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_comb_3d.png"></span>
  </div>
  <div id="sc-id-chart-options-gauge" class="sc-ui-chart-options" style="display: none">
   <span id="sc-id-chart-angulargauge" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_other_gauge.png"></span>
   <span id="sc-id-chart-semicirculargauge" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_other_semicirculargauge.png"></span>
   <span id="sc-id-chart-hlineargauge" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_other_lineargauge.png"></span>
  </div>
  <div id="sc-id-chart-options-other" class="sc-ui-chart-options" style="display: none">
   <span id="sc-id-chart-pyramid" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_other_pyram3d.png"></span>
   <span id="sc-id-chart-pyramid2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_other_pyram.png"></span>
   <span id="sc-id-chart-funnel" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_other_funnel3d.png"></span>
   <span id="sc-id-chart-funnel2d" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_other_funnel.png"></span>
   <span id="sc-id-chart-radar" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_other_radar.png"></span>
   <span id="sc-id-chart-scatter" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_other_scatter.png"></span>
   <span id="sc-id-chart-bubble" class="sc-ui-chart-option-type"><img src="<?php echo $this->Ini->path_img_global ?>/scriptcase__NM__ct_other_bubble.png"></span>
  </div>
 </div>
 <div id="sc-id-chart-blockui" style="position: fixed; top: 0; left:0; width: 100%; height: 100%; background-color: #FFF; z-index: 999; display: none; opacity: 0.7"></div>
 </td>
</tr>
<?php
   }

   function grafico_flash_config_js()
   {
      global $nm_saida;

      $sUrlConfigSave = $this->Ini->path_link . "Grafico_pais/Grafico_pais_config_graf_flash.php?nome_apl=Grafico_pais&campo_apl=nm_resumo_graf&sc_page=" . NM_encode_input($this->Ini->sc_page) . "&language=es";

      if (!$_SESSION['scriptcase']['fusioncharts_new'])
      {
          $nm_saida->saida("<script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/fusioncharts/" . $this->getChartModule() . "/jquery.min.js\"></script>\r\n");
      }
      else
      {
      $nm_saida->saida("<script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery.js\"></script>\r\n");
      }
      $nm_saida->saida("<script type=\"text/javascript\">\r\n");
      $nm_saida->saida("  function showChartConfig()\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("    $(\"#sc-id-div-config\").css(\"display\", \"flex\").show();\r\n");
      $nm_saida->saida("    $(\"#sc-id-chart-blockui\").show();\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  function hideChartConfig()\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("    $(\"#sc-id-div-config\").hide();\r\n");
      $nm_saida->saida("    $(\"#sc-id-chart-blockui\").hide();\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  $(function() {\r\n");
      $nm_saida->saida("    $(\"#sc-id-button-submit\").click(function() {\r\n");
      $nm_saida->saida("      $.ajax({\r\n");
      $nm_saida->saida("        type: \"POST\",\r\n");
      $nm_saida->saida("        url: \"" . $sUrlConfigSave . "\",\r\n");
      $nm_saida->saida("        data: {\r\n");
      $nm_saida->saida("          bok_graf: \"OK\",\r\n");
      $nm_saida->saida("          ajax: \"OK\",\r\n");
      $nm_saida->saida("          nome_apl: \"Grafico_pais\",\r\n");
      $nm_saida->saida("          campo_apl: \"nm_resumo_graf\",\r\n");
      $nm_saida->saida("          sc_page: \"" . NM_encode_input($this->Ini->sc_page) . "\",\r\n");
      $nm_saida->saida("          tipo: $(\"#sc-id-chart-type\").val(),\r\n");
      $nm_saida->saida("          opc_atual: $(\"#sc-id-chart-mode\").val(),\r\n");
      $nm_saida->saida("          largura: $(\"#sc-id-chart-width\").val(),\r\n");
      $nm_saida->saida("          altura: $(\"#sc-id-chart-height\").val(),\r\n");
      $nm_saida->saida("          order: $(\"#sc-id-chart-order\").val()\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("      }).done(function(data) {\r\n");
      $nm_saida->saida("        document.refresh_chart.submit();\r\n");
      $nm_saida->saida("      });\r\n");
      $nm_saida->saida("    });\r\n");
      $nm_saida->saida("    $(\"#sc-id-button-cancel\").click(function() {\r\n");
      $nm_saida->saida("      hideChartConfig();\r\n");
      $nm_saida->saida("    });\r\n");
      $nm_saida->saida("  });\r\n");
      $nm_saida->saida("</script>\r\n");
   }

   function grafico_flash_config_div()
   {
      global $nm_saida;

      $translate = array();
      $language  = 'es';
      if (isset($_SESSION['scriptcase']['sc_idioma_graf_flash']))
      {
         $translate = $_SESSION['scriptcase']['sc_idioma_graf_flash'];
      }
      if (!isset($translate[$language]))
      {
         foreach ($translate as $language => $rest)
         {
            break;
         }
      }

      $aChartDisp        = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_disp'])      && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_disp']))    ? $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_disp']      : array('Bar');
      $sChartType        = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_tipo'])      && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_tipo'])      ? $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_tipo']      : 'Bar';
      $iSinteticAnalitic = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_opc_atual']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_opc_atual']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_opc_atual'] : '1';
      $iChartWidth       = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_larg'])      && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_larg'])      ? $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_larg']      : '1200';
      $iChartHeight      = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_alt'])       && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_alt'])       ? $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['cfg_graf']['graf_alt']       : '600';
      $sChartOrder       = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_order'])     && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_order'])     ? $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['graf_order']     : '';
      $sSinteticSelected = ('1' == $iSinteticAnalitic) ? ' selected="selected"' : '';
      $sAnaliticSelected = ('2' == $iSinteticAnalitic) ? ' selected="selected"' : '';
      $sOrderNone        = (''     == $sChartOrder) ? ' selected="selected"' : '';
      $sOrderAsc         = ('asc'  == $sChartOrder) ? ' selected="selected"' : '';
      $sOrderDesc        = ('desc' == $sChartOrder) ? ' selected="selected"' : '';

      $Cod_Btn = nmButtonOutput($this->arr_buttons, "bconf_graf", "showChartConfig()", "showChartConfig()", "Rgraf", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
      $nm_saida->saida("      $Cod_Btn\r\n");
      $nm_saida->saida("<br />\r\n");
      $nm_saida->saida("<style type=\"text/css\">\r\n");
      $nm_saida->saida("    .input-group {\r\n");
      $nm_saida->saida("        flex-flow: column nowrap;\r\n");
      $nm_saida->saida("        justify-content: flex-start;\r\n");
      $nm_saida->saida("        align-items: flex-start;\r\n");
      $nm_saida->saida("        row-gap: .5rem;\r\n");
      $nm_saida->saida("        display: flex;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    .input-group > label {\r\n");
      $nm_saida->saida("        font-weight: 700;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("</style>\r\n");
      $nm_saida->saida("<div id=\"sc-id-chart-blockui\" style=\"display: none; position: fixed; top: 0px; left: 0px; width: 100%; height: 100%; background-color: rgb(255, 255, 255); z-index: 99900; opacity: 0.7;\"></div>\r\n");
      $nm_saida->saida("<div id=\"sc-id-div-config\" class=\"scGridToolbar\" style=\"position: absolute;top: 50%;left: 50%;padding: 1.5rem;z-index: 99990;width: 700px;border: 1px solid #c2c2c2;display: none;flex-flow: column nowrap;row-gap: 2rem;justify-content: center;align-items: flex-start;box-sizing: border-box;transform: translate(-50%, -50%);box-shadow: 0 8px 16px rgba(0,0,0,.25);\">\r\n");
      $nm_saida->saida("<div class=\"group\" style=\"width: 100%;display: flex;flex-flow: row wrap;row-gap: .875rem;column-gap: .875rem;justify-content: space-between;align-items: center;\">\r\n");
      $nm_saida->saida("<div class=\"input-group\">\r\n");
      $nm_saida->saida("  <label>" . $translate[$language]['tipo_g'] . "</label>\r\n");
      $nm_saida->saida("  <select id=\"sc-id-chart-type\" class=\"css_toolbar_obj\">\r\n");
      foreach ($aChartDisp as $sChartDisp)
      {
         switch ($sChartDisp) {
            case 'Bar':
               $sChartTitle = 'tp_barra';
               break;
            case 'Pie':
               $sChartTitle = 'tp_pizza';
               break;
            case 'Line':
               $sChartTitle = 'tp_linha';
               break;
            case 'Area':
               $sChartTitle = 'tp_area';
               break;
            case 'Mark':
               $sChartTitle = 'tp_marcador';
               break;
            case 'Gauge':
               $sChartTitle = 'tp_gauge';
               break;
            case 'Radar':
               $sChartTitle = 'tp_radar';
               break;
            case 'Polar':
               $sChartTitle = 'tp_polar';
               break;
            case 'Funnel':
               $sChartTitle = 'tp_funil';
               break;
            case 'Pyramid':
               $sChartTitle = 'tp_pyramid';
               break;
         }
         $sChartSelected = $sChartType == $sChartDisp ? ' selected="selected"' : '';
         $nm_saida->saida("    <option value=\"" . $sChartDisp . "\"" . $sChartSelected . ">" . $translate[$language][$sChartTitle] . "</option>\r\n");
      }
      $nm_saida->saida("  </select>\r\n");
      $nm_saida->saida("</div>\r\n");
      $nm_saida->saida("<div class=\"input-group\">\r\n");
      $nm_saida->saida("  <label>" . $translate[$language]['modo_gera'] . "</label>\r\n");
      $nm_saida->saida("  <select id=\"sc-id-chart-mode\" class=\"css_toolbar_obj\">\r\n");
      $nm_saida->saida("    <option value=\"1\"" . $sSinteticSelected . ">" . $translate[$language]['sintetico'] . "</option>\r\n");
      $nm_saida->saida("    <option value=\"2\"" . $sAnaliticSelected . ">" . $translate[$language]['analitico'] . "</option>\r\n");
      $nm_saida->saida("  </select>\r\n");
      $nm_saida->saida("</div>\r\n");
if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("<div class=\"input-group\">\r\n");
      $nm_saida->saida("  <label>" . $translate[$language]['largura'] . "</label>\r\n");
      $nm_saida->saida("  <input id=\"sc-id-chart-width\" type=\"text\" size=\"5\" value=\"" . $iChartWidth . "\" class=\"css_toolbar_obj\" style=\"text-align: right\" />\r\n");
      $nm_saida->saida("</div>\r\n");
} else {
      $nm_saida->saida("  <input id=\"sc-id-chart-width\" type=\"text\" size=\"5\" value=\"" . $iChartWidth . "\" style=\"display: none;\" />\r\n");
}
      $nm_saida->saida("<div class=\"input-group\">\r\n");
      $nm_saida->saida("  <label>" . $translate[$language]['altura'] . "</label>\r\n");
      $nm_saida->saida("  <input id=\"sc-id-chart-height\" type=\"text\" size=\"5\" value=\"" . $iChartHeight . "\" class=\"css_toolbar_obj\" style=\"text-align: right\" />\r\n");
      $nm_saida->saida("</div>\r\n");
      $nm_saida->saida("<div class=\"input-group\">\r\n");
      $nm_saida->saida("  <label>" . $translate[$language]['order'] . "</label>\r\n");
      $nm_saida->saida("  <select id=\"sc-id-chart-order\" class=\"css_toolbar_obj\">\r\n");
      $nm_saida->saida("    <option value=\"\"" . $sOrderNone . ">" . $translate[$language]['order_none'] . "</option>\r\n");
      $nm_saida->saida("    <option value=\"asc\"" . $sOrderAsc . ">" . $translate[$language]['order_asc'] . "</option>\r\n");
      $nm_saida->saida("    <option value=\"desc\"" . $sOrderDesc . ">" . $translate[$language]['order_desc'] . "</option>\r\n");
      $nm_saida->saida("  </select>\r\n");
      $nm_saida->saida("</div>\r\n");
      $nm_saida->saida("</div>\r\n");
      $sBtnOk   = nmButtonOutput($this->arr_buttons, "bok", "", "", "sc-id-button-submit", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
      $sBtnExit = nmButtonOutput($this->arr_buttons, "bcancelar", "", "", "sc-id-button-cancel", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
      $nm_saida->saida("<div class=\"input-group\" style=\"width: 100%;display: flex;flex-flow: row nowrap;justify-content: end;column-gap: .75rem;\">\r\n");
      $nm_saida->saida("  " . $sBtnOk . "\r\n");
      $nm_saida->saida("  " . $sBtnExit . "\r\n");
      $nm_saida->saida("</div>\r\n");
      $nm_saida->saida("</div>\r\n");
      $sUrlConfigXml = "./";
      $nm_saida->saida("<form name=\"refresh_chart\" action=\"" . $sUrlConfigXml . "\" method=\"POST\">\r\n");
      foreach ($_POST as $postItem => $postValue)
      {
         $postData = 'name="' . $postItem . '" value="' . $postValue . '"';
         $nm_saida->saida("  <input type=\"hidden\" " . $postData . " />\r\n");
      }
      $nm_saida->saida("</form>\r\n");
   }

   function grafico_flash_chart($width, $height, $sFileLocal, $export, $arr_charts, $isPDF = 'N')
   {
      global $nm_saida;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['skip_charts']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['skip_charts']) {
          return;
      }

      $sChartId = 'id_chart_' . mt_rand(1, 1000);
      $sDivId   = 'id_div_' . mt_rand(1, 1000);
      $sStyle   = 'Y' == $export ? ' style="position: absolute; top: 0px; left: 0px"' : ' style="width: 100%"';
      $Temp     = (isset($arr_charts[0])) ? sizeof($arr_charts[0]) : 0;
      $bMulti   = 1 < $Temp;
      $bComb    = isset($arr_charts[0][0]['comb']) ? $arr_charts[0][0]['comb'] : false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['bmulti'] = $bMulti;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['bcomb']  = $bComb;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['phantomjs_export_process']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['phantomjs_export_process'])
      {
          $sImageUrl = $this->generatePhantom($sFileLocal, $width, $height, $bMulti, $bComb);
          return;
      }
      $nm_saida->saida("<div id=\"" . $sDivId . "\"" . $sStyle . "></div>\r\n");
      if ($_SESSION['scriptcase']['phantomjs_charts'] && "Y" == $isPDF)
      {
          $sImageUrl = $this->generatePhantom($sFileLocal, $width, $height, $bMulti, $bComb);
      if ($this->Ini->Export_img_zip)
      {
          $this->Ini->Img_export_zip[] = $this->Ini->root . "/" . $sImageUrl;
          $sImageUrl = str_replace($this->Ini->path_imag_temp . "/", "", $sImageUrl);
      }

 if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['proc_pdf_vert'])
 { 
          $nm_saida->saida("<img style=\"width: 100%; page-break-inside: avoid !important;\" src=\"" . $sImageUrl . "\" style=\"border-width: 0\" />\r\n");
 } else {
          $nm_saida->saida("<img src=\"" . $sImageUrl . "\" style=\"border-width: 0\" />\r\n");
 } 
      }
      elseif ($_SESSION['scriptcase']['fusioncharts_new'])
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['responsive_chart']['active']) {
              $summary_width  = '100%';
              $summary_height = '75%';
          }
          else {
              $summary_height = $height;
              if ($_SESSION['scriptcase']['proc_mobile'])
              {
                  $summary_width = '100%';
              }
              else
              {
                  $summary_width = $width;
              }
          }
          $sPhantomImg   = "";
          $sPDFHtmlCall  = " FusionCharts.options.license({";
          $sPDFHtmlCall .= "   key: 'HA-8E3A-64coB5A2D4E1D4E4D3A11B11A5C3A1A1lC-7wA1B9xD-13lrgA2D3vbsC5E3D4A1E1I1B2B8D7A6E1F5C4I2D1A4juwE2B4G1C-7G1A7C8rqg1C4D1I4njyB5D6D3bzfG2C9A4C6A1B4A1C3D1J2B3yqsD1B1ZA33egvD8D5B4oC-8D3QA16A7jteE3A3H2E3A9C10C6C3C4E4A2H3F3C2B-16==',";
          $sPDFHtmlCall .= "   creditLabel: false,";
          $sPDFHtmlCall .= " });";
          $sPDFHtmlCall .= "  FusionCharts.ready(function() {";
          $sPDFHtmlCall .= "   myChart = new FusionCharts({";
          $sPDFHtmlCall .= "    'type': '" . $this->getChartType($bMulti, $bComb) . "',";
          $sPDFHtmlCall .= "    'renderAt': '" . $sDivId . "',";
          $sPDFHtmlCall .= "    'id': '" . $sChartId . "',";
          $sPDFHtmlCall .= "    'width': '" . $summary_width . "',";
          $sPDFHtmlCall .= "    'height': '" . $summary_height . "',";
          $sPDFHtmlCall .= "    'dataFormat': 'jsonurl',";
          $sPDFHtmlCall .= "    'dataSource': '" . $sFileLocal . "'";
          $sPDFHtmlCall .= "   }).render();";
          $sPDFHtmlCall .= "   myChart.configureLink({overlayButton: { message: \"" . $this->Ini->Nm_lang['lang_btns_chart_back'] . "\" }});";
          $sPDFHtmlCall .= "  });";
          $sCombId       = "  var scCombChartId = '" . $sChartId . "'";
      }
      else
      {
          $sPhantomImg   = "";
          $sPDFHtmlCall  = "  var chart = new FusionCharts('" . $this->Ini->path_prod . "/third/fusioncharts/" . $this->getChartModule() . "/" . $this->getChartRenderer($bMulti) . ".swf', '" . $sChartId . "', '" . $width . "', '" . $height . "', '0', '1');";
          $sPDFHtmlCall .= "  chart.setJSONUrl('" . $sFileLocal . "');";
          $sPDFHtmlCall .= "  chart.render('" . $sDivId . "');";
      }
      if ("N" == $isPDF)
      {
         $nm_saida->saida("<script type=\"text/javascript\" language=\"javascript\">\r\n");
         $nm_saida->saida("$sCombId\r\n");
         $nm_saida->saida("$sPDFHtmlCall\r\n");
         $nm_saida->saida("</script>\r\n");
      }
      else
      {
         if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['charts_html']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['charts_html'])
         {
         }
         $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['charts_html'] .= $sPDFHtmlCall;
      }
   }

   function generatePhantom($sFileLocal, $width, $height, $bMulti, $bComb)
   {
          $sChartXml = @file_get_contents($this->Ini->root . $sFileLocal);
          if (false === $sChartXml)
          {
              $sTmpId = microtime() . rand(1, 1000) . session_id();
          }
          else
          {
              $sTmpId = $sChartXml . $width . $height . $this->getChartModule() . $this->getChartType($bMulti, $bComb);
          }
          $sTmpId       = md5($sTmpId . 'Grafico_pais');
          $sImageName   = 'sc_pjs_png_' . $sTmpId . '.png';
          $sImageUrl    = $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp'] . '/' . $sImageName;
          $sImageFile   = $this->Ini->root . $sImageUrl;
          $sPDFHtmlCall = "";
          $sAppDir      = getcwd();
          $aOS          = $this->Ini->getRunningOS();
          $sPhantomCmd  = 'phantomjs --ignore-ssl-errors=true "' . $this->Ini->root . $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp'] . '/sc_pjs_js_' . $sTmpId . '.js"';
          $iJsDelay     = 150;
          if ('win' != $aOS['os'])
          {
              $sPhantomCmd = './' . $sPhantomCmd;
          }

          $bImageGenerated = @is_file($sImageFile);
          $iImageSizeLimit = 6 * 1024;
          $iImageSize      = $bImageGenerated ? @filesize($sImageFile) : 0;
          if (!$bImageGenerated || $iImageSize < $iImageSizeLimit)
          {
              $this->generatePhantomJs($sTmpId, $sImageFile, $iJsDelay);
              $this->generatePhantomPhp($sTmpId, $bMulti, $width, $height, $sFileLocal, $bComb);

              @chdir($this->Ini->path_third . '/phantomjs/' . $aOS['os']);

              $iAttempt   = 0;
              $iImageSize = 0;
              while ($iAttempt < 3 && $iImageSize < $iImageSizeLimit)
              {
                  @exec($sPhantomCmd);
                  $iAttempt++;

                  $iImageSize = @is_file($sImageFile) ? @filesize($sImageFile) : 0;
                  if ($iImageSize < $iImageSizeLimit)
                  {
                      $iJsDelay += 100;
                      $this->generatePhantomJs($sTmpId, $sImageFile, $iJsDelay);
                  }
              }

              @chdir($sAppDir);
          }

          $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['phantomjs_export_file'] = $sImageName;
          return $sImageUrl;
   }
   function generatePhantomJs($sTmpId, $sImageFile, $iDelay)
   {
       $server_phanton = $this->Ini->server_pdf;
       $fPhantomJs = @fopen($this->Ini->root . $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp'] . '/sc_pjs_js_' . $sTmpId . '.js', 'w');
       @fwrite($fPhantomJs, "var oPage      = require('webpage').create(),\r\n");
       @fwrite($fPhantomJs, "    sChartPage = '" . $server_phanton . $this->Ini->path_imag_temp . "/sc_pjs_php_" . $sTmpId . ".html',\r\n");
       @fwrite($fPhantomJs, "    sImageFile = '" . $sImageFile . "',\r\n");
       @fwrite($fPhantomJs, "    iJsDelay   = " . $iDelay . ";\r\n");
       @fwrite($fPhantomJs, "oPage.open(sChartPage, function () {\r\n");
       @fwrite($fPhantomJs, "  window.setTimeout(function () {\r\n");
       @fwrite($fPhantomJs, "    oPage.render(sImageFile);\r\n");
       @fwrite($fPhantomJs, "    phantom.exit();\r\n");
       @fwrite($fPhantomJs, "  }, iJsDelay);\r\n");
       @fwrite($fPhantomJs, "});\r\n");
       @fclose($fPhantomJs);
   }

   function generatePhantomPhp($sTmpId, $bMulti, $width, $height, $sFileLocal, $bComb = false)
   {
       $fPhantomChart = @fopen($this->Ini->root . $_SESSION['scriptcase']['Grafico_pais']['glo_nm_path_imag_temp'] . '/sc_pjs_php_' . $sTmpId . '.html', 'w');
       @fwrite($fPhantomChart, "<html>\r\n");
       @fwrite($fPhantomChart, "<head>\r\n");
       @fwrite($fPhantomChart, $_SESSION['nm_session']['charset'] . "\r\n");
       @fwrite($fPhantomChart, "<script type=\"text/javascript\" language=\"javascript\" src=\"" . $this->Ini->path_prod . "/third/fusioncharts/js/fusioncharts.js\"></script>\r\n");
       @fwrite($fPhantomChart, "</head>\r\n");
       @fwrite($fPhantomChart, "<body>\r\n");
       @fwrite($fPhantomChart, "<div id=\"sc-id-fusionchart\"></div>\r\n");
       @fwrite($fPhantomChart, "<script type=\"text/javascript\">\r\n");
       @fwrite($fPhantomChart, "  var d = new Date();\r\n");
       @fwrite($fPhantomChart, "  d.setTime(d.getTime() + (24*60*60*1000));\r\n");
       @fwrite($fPhantomChart, "  var expires = \"expires=\"+ d.toUTCString();\r\n");
       @fwrite($fPhantomChart, "  document.cookie = \"PHPSESSID_=;\"+ Math.random().toString(36).substring(2) +\";\" + expires + \";path=/\";\r\n");
       @fwrite($fPhantomChart, "  FusionCharts.options.license({\r\n");
       @fwrite($fPhantomChart, "    key: 'HA-8E3A-64coB5A2D4E1D4E4D3A11B11A5C3A1A1lC-7wA1B9xD-13lrgA2D3vbsC5E3D4A1E1I1B2B8D7A6E1F5C4I2D1A4juwE2B4G1C-7G1A7C8rqg1C4D1I4njyB5D6D3bzfG2C9A4C6A1B4A1C3D1J2B3yqsD1B1ZA33egvD8D5B4oC-8D3QA16A7jteE3A3H2E3A9C10C6C3C4E4A2H3F3C2B-16==',\r\n");
       @fwrite($fPhantomChart, "    creditLabel: false,\r\n");
       @fwrite($fPhantomChart, "  });\r\n");
       @fwrite($fPhantomChart, "  FusionCharts.ready(function() {\r\n");
       @fwrite($fPhantomChart, "   var myChart = new FusionCharts({\r\n");
       @fwrite($fPhantomChart, "    'creditLabel': false,\r\n");
       @fwrite($fPhantomChart, "    'type': '" . $this->getChartType($bMulti, $bComb) . "',\r\n");
       @fwrite($fPhantomChart, "    'renderAt': 'sc-id-fusionchart',\r\n");
       @fwrite($fPhantomChart, "    'width': '" . $width . "',\r\n");
       @fwrite($fPhantomChart, "    'height': '" . $height . "',\r\n");
       @fwrite($fPhantomChart, "    'dataFormat': 'jsonurl',\r\n");
       @fwrite($fPhantomChart, "    'dataSource': '" . $sFileLocal . "'\r\n");
       @fwrite($fPhantomChart, "   }).render();\r\n");
       @fwrite($fPhantomChart, "  });\r\n");
       @fwrite($fPhantomChart, "</script>\r\n");
       @fwrite($fPhantomChart, "</body>\r\n");
       @fwrite($fPhantomChart, "</html>\r\n");
       @fclose($fPhantomChart);
   }

   function string_to_utf8($str)
   {
       if ('UTF-8' != $_SESSION['scriptcase']['charset'])
       {
           $str = sc_convert_encoding($str, 'UTF-8', $_SESSION['scriptcase']['charset']);
       }
       return $str;
   }

   function grafico_dados($cht_data, $export, $chart_key)
   {
       $link_anal  = array();
       $value_anal = array();
       $arr_charts = array();

       $reload_analytic = false;

       if ('Y' != $export)
       {
           if (isset($cht_data['combination']) && $cht_data['combination'])
           {
               $datay = array('anal' => array());
               $lab_y = array();
               $sum_i = array();
               $sum_f = array();
               $fmt   = array();
               $xml_l = array();
               $label = array();
               $dbval = array();
               $lbord = array();
               $param = array();
               $link  = array();
               $xml   = array();
               $name  = '';
               $fld_x = '';
               $fld_y = array();
               $subt  = '';
               $legnd = '';
               foreach ($cht_data['charts'] as $s_comb_chart_index)
               {
                   if (empty($label))
                   {
                       $label = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['labels'];
                   }
                   if (empty($dbval))
                   {
                       $dbval = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['db_values'];
                   }
                   if (empty($lbord))
                   {
                       $lbord = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['label_order'];
                   }
                   if (empty($param))
                   {
                       $param = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['param'];
                   }
                   if ('' == $name)
                   {
                       $name = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['label_x'];
                   }
                   if ('' == $fld_x)
                   {
                       $fld_x = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['field_x'];
                   }
                   if ('' == $subt)
                   {
                       $subt = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['subtitle'];
                   }
                   if ('' == $legnd && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['legend']))
                   {
                       $legnd = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['legend'];
                   }
                   $fld_y[]         = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['field_y'];
                   $lab_y[]         = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['label_y'];
                   $sum_i[]         = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['summ_idx'];
                   $sum_f[]         = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['summ_fn'];
                   $fmt[]           = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['format'];
                   $datay['anal'][] = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['values']['sint'][0];
                   $tmp_xml_links   = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$s_comb_chart_index]['xml_links'];
                   $xml_l[]         = $cht_data['xml_pholder'];
               }
               if ($this->reload_as_analytic && 'C|' == substr($chart_key, 0, 2) && 1 == count($cht_data['charts']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type']) || !in_array($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type'], array('combination2d', 'combination3d'))))
               {
                   $nonCombKey      = substr($chart_key, 2);
                   $fld_y           = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$nonCombKey]['field_y'];
                   $lab_y           = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$nonCombKey]['label_y'];
                   $sum_i           = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$nonCombKey]['summ_idx'];
                   $sum_f           = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$nonCombKey]['summ_fn'];
                   $fmt             = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$nonCombKey]['format'];
                   $datay           = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$nonCombKey]['values'];
                   $tmp_xml_links   = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'][$nonCombKey]['xml_links'];
                   $xml_l           = $cht_data['xml_pholder'];
                   $reload_analytic = true;
               }
           }
           else
           {
               $datay = $cht_data['values'];
               $label = $cht_data['labels'];
               $dbval = $cht_data['db_values'];
               $lbord = $cht_data['label_order'];
               $param = $cht_data['param'];
               $link  = $cht_data['grid_links'];
               $xml   = $cht_data['xml_links'];
               $name  = $cht_data['label_x'];
               $fld_x = $cht_data['field_x'];
               $fld_y = $cht_data['field_y'];
               $subt  = $cht_data['subtitle'];
               $legnd = '';
           }

           if (isset($cht_data['combination']) && $cht_data['combination'])
           {
               $arr_data = $datay['anal'];
           }
           elseif ('xml' == $export)
           {
               $arr_data = $datay['sint'];
           }
           elseif (!$this->sc_graf_sint && isset($datay['anal']) && !empty($datay['anal']))
           {
               $arr_data   = $datay['anal'];
               $link_anal  = $datay['anal_links'];
               $value_anal = $datay['anal_values'];
               $label      = isset($cht_data['labels_anal']) && !empty($cht_data['labels_anal']) ? $cht_data['labels_anal'] : $cht_data['labels'];
           }
           else
           {
               $arr_data = $datay['sint'];
           }
           $arr_series = array();

           foreach ($label as $i => $v)
           {
               $label[$i] = $this->string_to_utf8($v);
           }

           foreach ($arr_data as $i_chart => $arr_chart)
           {
               if ($reload_analytic)
               {
                   $b_comb     = true;
                   $t_subtitle = $subt;
                   $t_field_x  = $fld_x;
                   $t_field_y  = $fld_y;
                   $t_label_x  = $name;
                   $t_label_y  = $lab_y;
                   $t_name     = $i_chart;
                   $summ_idx   = $sum_i;
                   $summ_fn    = $sum_f;
                   $formatfc   = $fmt;
                   $xml        = $xml_l;
                   $t_name_lab = $legnd;
               }
               elseif (isset($cht_data['combination']) && $cht_data['combination'])
               {
                   $b_comb     = true;
                   $t_subtitle = $subt;
                   $t_field_x  = $fld_x;
                   $t_field_y  = isset($fld_y[$i_chart]) ? $fld_y[$i_chart] : '';
                   $t_label_x  = $name;
                   $t_label_y  = isset($lab_y[$i_chart]) ? $lab_y[$i_chart] : '';
                   $t_name     = isset($lab_y[$i_chart]) ? $lab_y[$i_chart] : $i_chart;
                   $summ_idx   = isset($sum_i[$i_chart]) ? $sum_i[$i_chart] : '';
                   $summ_fn    = isset($sum_f[$i_chart]) ? $sum_f[$i_chart] : '';
                   $formatfc   = isset($fmt[$i_chart])   ? $fmt[$i_chart]   : '';
                   $xml        = isset($xml_l[$i_chart]) ? $xml_l[$i_chart] : '';
                   $t_name_lab = $legnd;
               }
               else
               {
                   $b_comb     = false;
                   $t_subtitle = $cht_data['subtitle'];
                   $t_field_x  = $cht_data['field_x'];
                   $t_field_y  = $cht_data['field_y'];
                   $t_label_x  = $cht_data['label_x'];
                   $t_label_y  = $cht_data['label_y'];
                   $t_name     = $i_chart;
                   $summ_idx   = '';
                   $summ_fn    = '';
                   $formatfc   = '';
                   $t_name_lab = $legnd;
               }
               if ($reload_analytic)
               {
                   $b_comb = false;
               }
               if (!isset($cht_data['legend'])) {
                   $cht_data['legend'] = "";
               }
               $arr_series[] = array('chart_key' => $chart_key, 'reload_analytic' => $reload_analytic, 'name_label' => $this->string_to_utf8($t_name_lab), 'name' => $this->string_to_utf8($t_name), 'serie_val' => isset($value_anal[$i_chart]) ? $value_anal[$i_chart] : $i_chart, 'summ_idx' => $summ_idx, 'summ_fn' => $summ_fn, 'formatfc' => $formatfc, 'label' => $label, 'db_values' => $dbval, 'label_order' => $lbord, 'param' => $param, 'data' => $arr_chart, 'title' => $cht_data['title'], 'subtitle' => $t_subtitle, 'field_x' => $t_field_x, 'field_y' => $t_field_y, 'label_x' => $t_label_x, 'label_y' => $t_label_y, 'legend' => $cht_data['legend'], 'format' => $cht_data['format'], 'link' => $link, 'link_anal' => $link_anal, 'xml_link' => $xml, 'comb' => $b_comb);
           }

           $arr_charts[] = $arr_series;
       }
       else
       {
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['pivot_charts'] as $chart_index => $chart_data)
           {
               $datay = $chart_data['values'];
               $label = $chart_data['labels'];
               $link  = $chart_data['grid_links'];
               $xml   = $chart_data['xml_links'];
               $fld_x = $chart_data['field_x'];
               $fld_y = $chart_data['field_y'];
               $name  = $chart_data['label_x'];

               if (!$this->sc_graf_sint && isset($datay['anal']) && !empty($datay['anal']))
               {
                   $arr_data   = $datay['anal'];
                   $link_anal  = $datay['anal_links'];
                   $value_anal = $datay['anal_values'];
                   $label      = isset($chart_data['labels_anal']) && !empty($chart_data['labels_anal']) ? $chart_data['labels_anal'] : $chart_data['labels'];
               }
               else
               {
                   $arr_data = $datay['sint'];
               }
               $arr_series = array();

               foreach ($label as $i => $v)
               {
                   $label[$i] = $this->string_to_utf8($v);
               }

               foreach ($arr_data as $i_chart =>$arr_chart)
               {
                   $arr_series[] = array('chart_key' => $chart_key, 'name' => $this->string_to_utf8($i_chart), 'serie_val' => isset($value_anal[$i_chart]) ? $value_anal[$i_chart] : $i_chart, 'label' => $label, 'data' => $arr_chart, 'title' => $chart_data['title'], 'subtitle' => $chart_data['subtitle'], 'field_x' => $chart_data['field_x'], 'field_y' => $chart_data['field_y'], 'label_x' => $chart_data['label_x'], 'label_y' => $chart_data['label_y'], 'legend' => $chart_data['legend'], 'format' => $chart_data['format'], 'link' => $link, 'link_anal' => $link_anal, 'xml_link' => $xml);
               }

               $arr_charts[] = $arr_series;
           }
       }

       return $arr_charts;
   }

    function orderCharts(&$arr_charts, $rule = '', $field = '')
    {
        if ('' == $rule)
        {
            return;
        }

        if ('' == $field)
        {
            $field = 0;
        }

        if ('label' != $field && !isset($arr_charts[0][$field]))
        {
            $field = 0;
        }

        foreach ($arr_charts as $i => $c)
        {
            if ('label' === $field)
            {
                $sOrderIndex  = isset($arr_charts[$i][0]['label_order']) && 'value' == $arr_charts[$i][0]['label_order'] ? 'db_values' : 'label';
                $aOrderSample = $arr_charts[$i][0][$sOrderIndex];
            }
            else
            {
                $aOrderSample = $arr_charts[$i][$field]['data'];
            }
            $aNewOrder = $this->getNewOrder($aOrderSample, $rule);
            $this->applyNewOrder($aNewOrder, $arr_charts[$i]);
        }
    }

    function getNewOrder($data, $rule)
    {
        if (!is_array($data))
        {
            return $data;
        }
        if ('asc' == $rule)
        {
            asort($data);
        }
        elseif ('desc' == $rule)
        {
            arsort($data);
        }

        return $data;
    }

    function applyNewOrder(&$order, &$charts)
    {
        for ($i = 0; $i < sizeof($charts); $i++)
        {
            $fix_xml   = is_array($charts[$i]['xml_link']);
            $new_data  = array();
            $new_label = array();
            $new_dbval = array();
            $new_link  = array();
            if ($fix_xml)
            {
                $new_xml = array();
            }

            foreach ($order as $new_index => $value)
            {
                $new_data[]  = $charts[$i]['data'][$new_index];
                $new_label[] = $charts[$i]['label'][$new_index];
                $new_dbval[] = $charts[$i]['db_values'][$new_index];
                $new_link[]  = $charts[$i]['link'][$new_index];
                if ($fix_xml)
                {
                    $new_xml[] = $charts[$i]['xml_link'][$new_index];
                }
            }

            $charts[$i]['data']      = $new_data;
            $charts[$i]['label']     = $new_label;
            $charts[$i]['db_values'] = $new_dbval;
            $charts[$i]['link']      = $new_link;
            if ($fix_xml)
            {
                $charts[$i]['xml_link'] = $new_xml;
            }
        }
    }

   function orderChart(&$label, &$data, &$link, $rule = '')
   {
       if ('' == $rule)
       {
           return;
       }
       elseif ('asc' == $rule)
       {
           asort($data);
       }
       elseif ('desc' == $rule)
       {
           arsort($data);
       }

       $new_data  = array();
       $new_label = array();
       $new_link  = array();
       foreach ($data as $i => $v)
       {
           $new_data[]  = $v;
           $new_label[] = $label[$i];
           $new_link[]  = $link[$i];
       }
       $data  = $new_data;
       $label = $new_label;
       $link  = $new_link;
   }

   function getChartType($bMulti, $bComb = false)
   {
       return strtolower($this->getChartRenderer($bMulti, $bComb));
   }

   function getChartRenderer($bMulti, $bComb)
   {
       $Ind_groupby = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['SC_Ind_Groupby'];
       if (1)
       {
           $tmp_count = 0;
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_order'][$Ind_groupby] as $i_sum)
           {
               if ('' != $i_sum && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_display'][$Ind_groupby][$i_sum]))
               {
                   $d_sum = $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_display'][$Ind_groupby][$i_sum];
                   if ($d_sum['display'])
                   {
                       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['summarizing_fields_control'][$Ind_groupby] as $l_field => $d_field)
                       {
                           foreach ($d_field['options'] as $d_option)
                           {
                               if ($d_option['index'] == $i_sum)
                               {
                                   $tmp_count++;
                               }
                           }
                       }
                   }
               }
           }
           $multiDimensions = $bMulti && $this->reload_as_analytic;
           $multiMetrics = $tmp_count > 1;
           switch ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['chart_combination_type']) {
               case 'angulargauge':
                   $newChartType = "angulargauge";
                   break;
               case 'semicirculargauge':
                   $newChartType = "angulargauge";
                   break;
               case 'hlineargauge':
                   $newChartType = "hlineargauge";
                   break;
               case 'area';
               case 'msarea';
               case 'msarea';
                   $newChartType = $multiMetrics || $multiDimensions ? "msarea" : "msarea";
                   break;
               case 'areaspline';
               case 'mssplinearea';
               case 'splinearea';
                   $newChartType = $multiMetrics || $multiDimensions  ? "mssplinearea" : "splinearea";
                   break;
               case 'bar2d';
               case 'msbar2d';
                   $newChartType = $multiMetrics || $multiDimensions  ? "msbar2d" : "bar2d";
                   break;
               case 'bar3d';
               case 'msbar3d';
                   $newChartType = $multiMetrics || $multiDimensions  ? "msbar3d" : "bar3d";
                   break;
               case 'bubble':
                   $newChartType = "bubble";
                   break;
               case 'column2d';
               case 'mscolumn2d';
                   $newChartType = $multiMetrics || $multiDimensions  ? "mscolumn2d" : "column2d";
                   break;
               case 'column3d';
               case 'mscolumn3d';
                   $newChartType = $multiMetrics || $multiDimensions  ? "mscolumn3d" : "column3d";
                   break;
               case 'combination2d';
               case 'mscombidy2d';
               case 'mscombi2d';
                   $newChartType = $multiMetrics || $multiDimensions  ? "mscombidy2d" : "mscombi2d";
                   break;
               case 'combination3d';
               case 'mscolumn3dlinedy';
                   $newChartType = "mscolumn3dlinedy";
                   break;
               case 'doughnut2d':
                   $newChartType = "doughnut2d";
                   break;
               case 'doughnut3d':
                   $newChartType = "doughnut3d";
                   break;
               case 'funnel':
                   $newChartType = "funnel";
                   break;
               case 'funnel2d':
                   $newChartType = "funnel";
                   break;
               case 'line';
               case 'msline';
                   $newChartType = $multiMetrics || $multiDimensions  ? "msline" : "line";
                   break;
               case 'pie2d':
                   $newChartType = "pie2d";
                   break;
               case 'pie3d':
                   $newChartType = "pie3d";
                   break;
               case 'pyramid':
                   $newChartType = "pyramid";
                   break;
               case 'pyramid2d':
                   $newChartType = "pyramid";
                   break;
               case 'radar':
                   $newChartType = "radar";
                   break;
               case 'scatter':
                   $newChartType = "scatter";
                   break;
               case 'scrollarea':
               case 'scrollarea2d':
                   $newChartType = "scrollarea2d";
                   break;
               case 'scrollbar2d':
                   $newChartType = "scrollbar2d";
                   break;
               case 'overlappedbar2d':
                   $newChartType = "overlappedbar2d";
                   break;
               case 'scrollcolumn2d':
                   $newChartType = "scrollcolumn2d";
                   break;
               case 'overlappedcolumn2d':
                   $newChartType = "overlappedcolumn2d";
                   break;
               case 'scrollline':
               case 'scrollline2d':
                   $newChartType = "scrollline2d";
                   break;
               case 'spline';
               case 'msspline';
                   $newChartType = $multiMetrics || $multiDimensions  ? "msspline" : "spline";
                   break;
               case 'stackedarea';
               case 'stackedarea2d';
                   $newChartType = "stackedarea2d";
                   break;
               case 'stackedbar2d':
                   $newChartType = "stackedbar2d";
                   break;
               case 'stackedbar3d':
                   $newChartType = "stackedbar3d";
                   break;
               case 'stackedcolumn2d':
                   $newChartType = "stackedcolumn2d";
                   break;
               case 'stackedcolumn3d':
                   $newChartType = "stackedcolumn3d";
                   break;
               case 'step';
               case 'msstepline';
                   $newChartType = "msstepline";
                   break;
               case 'zoomline':
                   $newChartType = "zoomline";
                   break;
           }
           return $newChartType;
       }
       $sChart = '';
       $sMulti = $bMulti ? 'MS' : '';
       switch ($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_tipo'])
       {
           case 'Bar':
               if ('Horizontal' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_barra_orien'])
               {
                   if ('Off' != $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_barra_empil'] && $bMulti)
                   {
                       $sChart .= 'StackedBar';
                       $sChart .= '3d' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_barra_dimen']  ? '3D' : '2D';
                   }
                   else
                   {
                       $sChart .= $sMulti . 'Bar';
                       $sChart .= '3d' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_barra_dimen'] ? '3D' : '2D';
                   }
               }
               else
               {
                   if ('Off' != $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_barra_empil'] && $bMulti)
                   {
                       $sChart .= 'StackedColumn';
                       $sChart .= '2d' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_barra_dimen'] ? '2D' : '3D';
                   }
                   else
                   {
                       $sChart .= $sMulti . 'Column';
                       $sChart .= '2d' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_barra_dimen'] ? '2D' : '3D';
                   }
               }
               break;
           case 'Pie':
               if ('Pie' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_pizza_forma'])
               {
                   $sChart .= 'Pie';
               }
               else
               {
                   $sChart .= 'Doughnut';
               }
               $sChart .= '2d' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_pizza_dimen'] ? '2D' : '3D';
               break;
           case 'Line':
               if ('Line' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_linha_forma'])
               {
                   $sChart .= $sMulti . 'Line';
               }
               elseif ('Spline' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_linha_forma'])
               {
                   $sChart .= $sMulti . 'Spline';
               }
               else
               {
                   $sChart .= 'MSStepLine';
               }
               break;
           case 'Area':
               if ('Area' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_area_forma'])
               {
                   if ($bMulti)
                   {
                       $sChart .= $sMulti . 'Area';
                   }
                   else
                   {
                       $sChart .= 'Area2D';
                   }
               }
               else
               {
                   $sChart .= $sMulti . 'SplineArea';
               }
               break;
           case 'Mark':
               $sChart .= 'Column3D';
               break;
           case 'Gauge':
               $sChart .= 'AngularGauge';
               break;
           case 'Radar':
           case 'Polar':
               $sChart .= 'Radar';
               break;
           case 'Funnel':
               $sChart .= 'Funnel';
               break;
           case 'Pyramid':
               $sChart = 'Pyramid';
               break;
       }
       return $sChart;
   }

   function getChartModule($sChartType = '')
   {
       if ('' == $sChartType)
       {
           $sChartType = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_tipo'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_tipo'] : "";
       }
       switch ($sChartType)
       {
           case 'Bar':
               return 'FusionCharts';
               break;
           case 'Pie':
               return 'FusionCharts';
               break;
           case 'Line':
               if ('Line' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_linha_forma'])
               {
                   return 'FusionCharts';
               }
               elseif ('Spline' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_linha_forma'])
               {
                   return 'PowerCharts';
               }
               else
               {
                   return 'PowerCharts';
               }
               break;
           case 'Area':
               if ('Area' == $_SESSION['sc_session'][$this->Ini->sc_page]['Grafico_pais']['parms_graf']['graf_area_forma'])
               {
                   return 'FusionCharts';
               }
               else
               {
                   return 'PowerCharts';
               }
               break;
           case 'Mark':
               return 'FusionCharts';
               break;
           case 'Gauge':
               return 'FusionWidgets';
               break;
           case 'Radar':
           case 'Polar':
               return 'PowerCharts';
               break;
           case 'Pyramid':
               return 'FusionWidgets';
               break;
           case 'Funnel':
               return 'FusionWidgets';
               break;
       }
       return $sChartType;
   }

   function getColorList($values, $colors)
   {
       $iValCount = 0;
       foreach ($values as $serie)
       {
           $iValCount = max($iValCount, sizeof($serie['label']));
       }
       $aColors   = explode(',', $colors);
       $iColCount = sizeof($aColors);
       $aMulti    = $this->getDivisions($iValCount, $iColCount);
       if (1 == $aMulti)
       {
           return $aColors[0];
       }
       $aAllColors = $this->getAllColors($aMulti[2], $aColors);
       return implode(',', $this->getUsedColors($aMulti[1], $iValCount, $aAllColors));
   }

   function getDivisions($a, $b)
   {
       if (1 >= $a || 1 >= $b)
       {
           return 1;
       }
       return $this->getSubDivisions($a, 0, $b, 0);
   }

   function getSubDivisions($a, $am, $b, $bm)
   {
       $v1 = $a + (($a - 1) * $am);
       $v2 = $b + (($b - 1) * $bm);
       if ($v1 == $v2)
       {
           return array($v1, $am, $bm);
       }
       elseif ($v1 > $v2)
       {
           return $this->getSubDivisions($a, $am, $b, $bm + 1);
       }
       else
       {
           return $this->getSubDivisions($a, $am + 1, $b, $bm);
       }
   }

   function getAllColors($div, $colors)
   {
       $aNewColors = array($colors[0]);
       for ($i = 1; $i < sizeof($colors); $i++)
       {
           $this->getColorIntervals($aNewColors, $colors[$i - 1], $colors[$i], $div);
           $aNewColors[] = $colors[$i];
       }
       return $aNewColors;
   }

   function getUsedColors($div, $count, $colors)
   {
       $used = array();
       for ($i = 0; $i < $count; $i++)
       {
           $used[] = $colors[($div + 1) * $i];
       }
       return $used;
   }

   function getColorIntervals(&$colors, $first, $last, $div)
   {
       $RGBini = $this->hex2dec($first);
       $RGBend = $this->hex2dec($last);
       $RGBint = array(
           abs(($RGBini[0] - $RGBend[0]) / ($div + 1)),
           abs(($RGBini[1] - $RGBend[1]) / ($div + 1)),
           abs(($RGBini[2] - $RGBend[2]) / ($div + 1)),
       );
       for ($i = 1; $i <= $div; $i++)
       {
           $newR = $RGBini[0] > $RGBend[0] ? $RGBini[0] - ($i * $RGBint[0]) : $RGBini[0] + ($i * $RGBint[0]);
           $newG = $RGBini[1] > $RGBend[1] ? $RGBini[1] - ($i * $RGBint[1]) : $RGBini[1] + ($i * $RGBint[1]);
           $newB = $RGBini[2] > $RGBend[2] ? $RGBini[2] - ($i * $RGBint[2]) : $RGBini[2] + ($i * $RGBint[2]);
           $colors[] = $this->dec2hex($newR, $newG, $newB);
       }
   }

   function hex2dec($color)
   {
       $dec = explode(' ', chunk_split($color, 2, ' '));
       return array(
           hexdec($dec[0]),
           hexdec($dec[1]),
           hexdec($dec[2]),
       );
   }

   function dec2hex($r, $g, $b)
   {
       $newr = dechex(round($r));
       if (1 == strlen($newr))
       {
           $newr = '0' . $newr;
       }
       $newg = dechex(round($g));
       if (1 == strlen($newg))
       {
           $newg = '0' . $newg;
       }
       $newb = dechex(round($b));
       if (1 == strlen($newb))
       {
           $newb = '0' . $newb;
       }
       return $newr . $newg . $newb;
   }

//
}

?>
