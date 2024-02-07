function nmAjaxChangeCss(cssChanges, seqRow)
{
    let baseSeq = seqRow.substr(1), underscoreSeq = "_" + baseSeq, ruleSelector, ruleName;
    for (ruleSelector in cssChanges) {
        for (ruleSeq in cssChanges[ruleSelector]) {
            if ("ajax_navigate" == seqRow) {
                baseSeq = ruleSeq;
                underscoreSeq = "_" + baseSeq;
            }
            for (ruleName in cssChanges[ruleSelector][ruleSeq]) {
                if ("sc_badge" == ruleName) {
                    if ("" != ruleSelector) {
                        $("#id_sc_field_" + ruleSelector + underscoreSeq).removeClass("sc-badge-pill").removeClass("sc-b-blue").removeClass("sc-b-brown").removeClass("sc-b-cyan").removeClass("sc-b-gray").removeClass("sc-b-green").removeClass("sc-b-orange").removeClass("sc-b-pink").removeClass("sc-b-purple").removeClass("sc-b-red").removeClass("sc-b-yellow");
                    }
                    if ("" != cssChanges[ruleSelector][ruleSeq][ruleName]) {
                        $("#id_sc_field_" + ruleSelector + underscoreSeq).addClass("sc-badge-pill").addClass("sc-b-" + cssChanges[ruleSelector][ruleSeq][ruleName]);
                    }
                } else if ("__sc_row" == ruleSelector) {
                    $("#SC_ancor" + baseSeq + " .scGridFieldOddFont").css(ruleName, cssChanges[ruleSelector][ruleSeq][ruleName]);
                    $("#SC_ancor" + baseSeq + " .scGridFieldEvenFont").css(ruleName, cssChanges[ruleSelector][ruleSeq][ruleName]);
                } else {
                    $("#SC_ancor" + baseSeq + " .css_" + ruleSelector + "_grid_line").css(ruleName, cssChanges[ruleSelector][ruleSeq][ruleName]);
                }
            }
        }
    }
}
  function nmAjaxRedir(oTemp)
  {
    if (oTemp && oTemp != null) {
        oResp = oTemp;
    }
    if (!oResp["redirInfo"]) {
      return;
    }
    sMetodo = oResp["redirInfo"]["metodo"];
    sAction = oResp["redirInfo"]["action"];
    if ("location" == sMetodo) {
      if ("parent.parent" == oResp["redirInfo"]["target"]) {
        parent.parent.location = sAction;
      }
      else if ("parent" == oResp["redirInfo"]["target"]) {
        parent.location = sAction;
      }
      else if ("_blank" == oResp["redirInfo"]["target"]) {
        window.open(sAction, "_blank");
      }
      else {
        document.location = sAction;
      }
    }
    else if ("html" == sMetodo) {
        document.write(nmAjaxSpecCharParser(oResp["redirInfo"]["action"]));
    }
    else {
      if (oResp["redirInfo"]["target"] == "modal") {
          tb_show('', sAction + '?script_case_init=' +  oResp["redirInfo"]["script_case_init"] + '&nmgp_parms=' + oResp["redirInfo"]["nmgp_parms"] + '&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&TB_iframe=true&modal=true&height=' +  oResp["redirInfo"]["h_modal"] + '&width=' + oResp["redirInfo"]["w_modal"], '');
          return;
      }
      sFormRedir = (oResp["redirInfo"]["nmgp_outra_jan"]) ? "form_ajax_redir_1" : "form_ajax_redir_2";
      document.forms[sFormRedir].action           = sAction;
      document.forms[sFormRedir].target           = oResp["redirInfo"]["target"];
      document.forms[sFormRedir].nmgp_parms.value = oResp["redirInfo"]["nmgp_parms"];
      if ("form_ajax_redir_1" == sFormRedir) {
        document.forms[sFormRedir].nmgp_outra_jan.value = oResp["redirInfo"]["nmgp_outra_jan"];
      }
      else {
        document.forms[sFormRedir].nmgp_url_saida.value   = oResp["redirInfo"]["nmgp_url_saida"];
        document.forms[sFormRedir].script_case_init.value = oResp["redirInfo"]["script_case_init"];
      }
      document.forms[sFormRedir].submit();
    }
  }
var json_err_crtl    = 1;
var Id_Btn_selected  = new Array();
var Css_Btn_selected = new Array();
Id_Btn_selected[0] = "selcmp_top";
Id_Btn_selected[1] = "ordcmp_top";
Id_Btn_selected[2] = "sel_groupby_top";
Id_Btn_selected[3] = "dynamic_search_top";
function ajax_navigate(opc, parm)
{
    if (typeof parm == "string" && "reloadchart__" == parm.substring(0, 13)) {
        parm = parm.substring(13);
    }
    var scrollNavigateReload = false, extraParams = "", iEvt, iStart = 0, rebindClickOnFixedCols = false;
       $('.group_col_backdrop').remove();
    for (ibtn = 0; ibtn < 4; ibtn++) {
        Css_Btn_selected[ibtn] = $("#" + Id_Btn_selected[ibtn]).attr('class');
    }
    nmAjaxProcOn();
    if ("rec" == opc || "ordem" == opc) {
      rebindClickOnFixedCols = true;
    }
    if (scrollNavigateReload) {
      extraParams += "&scrollNavigateReload=Y";
    }
    if (typeof parm !== "string") {
      parm = parm.toString();
    }
    parm = parm.replace(/[+]/g, "__NM_PLUS__");
    while (parm.lastIndexOf("&amp;") != -1)
    {
       parm = parm.replace("&amp;" , "__NM_AMP__");
    }
    parm = parm.replace(/[&]/g, "__NM_AMP__");
    parm = parm.replace(/[%]/g, "__NM_PRC__");
    parm_save = parm;
    return new Promise(function(resolve, reject) {$.ajax({
      type: "POST",
      url: "index.php",
      data: "nmgp_opcao=ajax_navigate&script_case_init=" + document.F4.script_case_init.value + "&opc=" + opc  + "&parm=" + parm + extraParams
     })
     .fail(function(jqxhr, textStatus, error) {
        var err = textStatus + ", " + error;
        if (json_err_crtl == 1) {
            json_err_crtl++;
            ajax_navigate(opc, parm);
        }
        else {
            nmAjaxProcOff();
            json_err_crtl = 1;
            alert (err);
        }
     })
     .done(function(jsonNavigate) {
        var i, oResp;
        json_err_crtl = 1;
        Tst_integrid = jsonNavigate.trim();
        if ("{" != Tst_integrid.substr(0, 1)) {
            nmAjaxProcOff();
            alert (jsonNavigate);
            return;
        }
        eval("oResp = " + jsonNavigate);
        if (oResp["ss_time_out"]) {
            nmAjaxProcOff();
            nm_move();
        }
        if (!SC_Proc_Mobile) {
            document.getElementById('nmsc_iframe_liga_A_grid_agenda').src = 'NM_Blank_Page.htm';
            document.getElementById('nmsc_iframe_liga_E_grid_agenda').src = 'NM_Blank_Page.htm';
            document.getElementById('nmsc_iframe_liga_D_grid_agenda').src = 'NM_Blank_Page.htm';
            document.getElementById('nmsc_iframe_liga_B_grid_agenda').src = 'NM_Blank_Page.htm';
            document.getElementById('nmsc_iframe_liga_A_grid_agenda').style.height = '0px';
            document.getElementById('nmsc_iframe_liga_E_grid_agenda').style.height = '0px';
            document.getElementById('nmsc_iframe_liga_D_grid_agenda').style.height = '0px';
            document.getElementById('nmsc_iframe_liga_B_grid_agenda').style.height = '0px';
            document.getElementById('nmsc_iframe_liga_A_grid_agenda').style.width  = '0px';
            document.getElementById('nmsc_iframe_liga_E_grid_agenda').style.width  = '0px';
            document.getElementById('nmsc_iframe_liga_D_grid_agenda').style.width  = '0px';
            document.getElementById('nmsc_iframe_liga_B_grid_agenda').style.width  = '0px';
        }
        if (oResp["setValue"]) {
          for (i = 0; i < oResp["setValue"].length; i++) {
            $("#" + oResp["setValue"][i]["field"]).html(oResp["setValue"][i]["value"]);
            if ("sc_grid_body" == oResp["setValue"][i]["field"]) {
                applyGroupButtons();
            }
          }
        }
        if (oResp["setTitle"]) {
          for (i = 0; i < oResp["setTitle"].length; i++) {
            $("#" + oResp["setTitle"][i]["field"]).attr('title', oResp["setTitle"][i]["value"]);
          }
        }
        if (oResp["setArr"]) {
          for (i = 0; i < oResp["setArr"].length; i++) {
               eval (oResp["setArr"][i]["var"] + ' = new Array()');
          }
        }
        if (oResp["setVar"]) {
          for (i = 0; i < oResp["setVar"].length; i++) {
               eval (oResp["setVar"][i]["var"] + ' = \"' + oResp["setVar"][i]["value"] + '\"');
          }
        }
        if (oResp["fillArr"]) {
          for (i = 0; i < oResp["fillArr"].length; i++) {
               eval (oResp["fillArr"][i]["var"] + ' = {' + oResp["fillArr"][i]["value"] + '}');
          }
        }
        if (oResp["setDisplay"]) {
          for (i = 0; i < oResp["setDisplay"].length; i++) {
            if (document.getElementById(oResp["setDisplay"][i]["field"])) {
              document.getElementById(oResp["setDisplay"][i]["field"]).style.display = oResp["setDisplay"][i]["value"];
            }
          }
        }
        if (oResp["setVisibility"]) {
          for (i = 0; i < oResp["setVisibility"].length; i++) {
            if (document.getElementById(oResp["setVisibility"][i]["field"])) {
              document.getElementById(oResp["setVisibility"][i]["field"]).style.visibility = oResp["setVisibility"][i]["value"];
            }
          }
        }
        if (oResp["setDisabled"]) {
          for (i = 0; i < oResp["setDisabled"].length; i++) {
            if (document.getElementById(oResp["setDisabled"][i]["field"])) {
              document.getElementById(oResp["setDisabled"][i]["field"]).disabled = oResp["setDisabled"][i]["value"];
            }
          }
        }
        if (oResp["setClass"]) {
          for (i = 0; i < oResp["setClass"].length; i++) {
            if (document.getElementById(oResp["setClass"][i]["field"])) {
              document.getElementById(oResp["setClass"][i]["field"]).className = oResp["setClass"][i]["value"];
            }
          }
        }
        if (oResp["setSrc"]) {
          for (i = 0; i < oResp["setSrc"].length; i++) {
            if (document.getElementById(oResp["setSrc"][i]["field"])) {
              document.getElementById(oResp["setSrc"][i]["field"]).src = oResp["setSrc"][i]["value"];
            }
          }
        }
        if (oResp["remove_Obj"]) {
          for (i = 0; i < oResp["remove_Obj"].length; i++) {
            if (document.getElementById(oResp["remove_Obj"][i])) {
              document.getElementById(oResp["remove_Obj"][i]).remove();
            }
          }
        }
        if (oResp["redirInfo"]) {
           nmAjaxRedir(oResp);
        }
        if (oResp["changeCss"]) {
           nmAjaxChangeCss(oResp["changeCss"], 'ajax_navigate');
        }
        if (oResp["AlertJS"]) {
          for (i = 0; i < oResp["AlertJS"].length; i++) {
              jsAlertParams = oResp["AlertJSParam"][i] ? oResp["AlertJSParam"][i] : {};
              scJs_alert (oResp["AlertJS"][i], jsAlertParams);
          }
        }
        if (oResp["exec_JS"]) {
          for (i = 0; i < oResp["exec_JS"].length; i++) {
               eval (oResp["exec_JS"][i]["function"] + '("' + oResp["exec_JS"][i]["parm"] + '");');
          }
        }
        if (oResp["grid_search_add"]) {
          for (i = 0; i < oResp["grid_search_add"].length; i++) {
               var parm = oResp["grid_search_add"][i]['field'];
               Tot_obj_grid_search++;
               Tab_obj_grid_search[Tot_obj_grid_search] = parm;
               $(oResp["grid_search_add"][i]['tag']).insertBefore('#add_grid_search');
               $('#grid_search_' + parm).attr('new', 'new');
               scLoadScInput('#grid_search_' + parm + '_' + Tot_obj_grid_search + ' input:text.sc-js-input');
          }
          SC_carga_evt_jquery_grid('all');
        }
        if (oResp["htmOutput"]) {
           nmAjaxShowDebug(oResp);
        }
        if (rebindClickOnFixedCols) {
            scFixCol_addClickControl();
        }
        scFixCol_loadState();
        if (!SC_Link_View)
        {
            if (Qsearch_ok)
            {
                scQuickSearchKeyUp('top', null);
            }
            if (parm == "save_grid") {
                Dyn_Ini = true;
            }
            SC_init_jquery(false);
            tb_init('a.thickbox, area.thickbox, input.thickbox');
        }
        for (ibtn = 0; ibtn < 4; ibtn++) {
             $("#" + Id_Btn_selected[ibtn]).attr('class', Css_Btn_selected[ibtn]);
        }
        nmAjaxProcOff();
        if (typeof(bootstrapMobile) === typeof(function(){})) bootstrapMobile();
        resolve();
          var hval = 0;
          console.log(document._toolbarHeightFix);
          if (document._toolbarHeightFix != undefined) {
            hval = document._toolbarHeightFix;
          }
            scSetFixedHeadersCss(hval);
            scSetFixedHeaders();
    })});
}
function ajax_navigate_res(opc, parm)
{
    let extraParams = [], extraParamsString = "";
    if (typeof parm == "string" && "reloadchart__" == parm.substring(0, 13)) {
        parm = parm.substring(13);
        extraParams.push("reload_chart=Y");
    }
    $('.group_col_backdrop').remove();
    nmAjaxProcOn();
    parm_save = parm;
    if (extraParams.length) {
        extraParamsString = "&" + extraParams.join("&");
    }
    $.ajax({
      type: "POST",
      url: "index.php",
      data: "nmgp_opcao=ajax_navigate&script_case_init=" + document.FRES.script_case_init.value + "&opc=" + opc  + "&parm=" + parm + extraParamsString
     })
     .done(function(jsonNavigate) {
        if ("grid_search_res" == opc && typeof scSummaryNoRecords != "undefined" && scSummaryNoRecords) {
            document.refresh_config.submit();
            return;
        }
        var i, oResp;
        Tst_integrid = jsonNavigate.trim();
        if ("{" != Tst_integrid.substr(0, 1)) {
            nmAjaxProcOff();
            alert (jsonNavigate);
            return;
        }
        eval("oResp = " + jsonNavigate);
        if (oResp["ss_time_out"]) {
            nmAjaxProcOff();
            nm_move();
        }
        if (oResp["setValue"]) {
          for (i = 0; i < oResp["setValue"].length; i++) {
            $("#" + oResp["setValue"][i]["field"]).html(oResp["setValue"][i]["value"]);
          }
        }
        if (oResp["setJqueryVal"]) {
          for (i = 0; i < oResp["setJqueryVal"].length; i++) {
            $("#" + oResp["setJqueryVal"][i]["field"]).val(oResp["setJqueryVal"][i]["value"]);
          }
        }
        if (oResp["setTitle"]) {
          for (i = 0; i < oResp["setTitle"].length; i++) {
            $("#" + oResp["setTitle"][i]["field"]).attr('title', oResp["setTitle"][i]["value"]);
          }
        }
        if (oResp["setArr"]) {
          for (i = 0; i < oResp["setArr"].length; i++) {
               eval (oResp["setArr"][i]["var"] + ' = new Array()');
          }
        }
        if (oResp["setVar"]) {
          for (i = 0; i < oResp["setVar"].length; i++) {
               eval (oResp["setVar"][i]["var"] + ' = \"' + oResp["setVar"][i]["value"] + '\"');
          }
        }
        if (oResp["fillArr"]) {
          for (i = 0; i < oResp["fillArr"].length; i++) {
               eval (oResp["fillArr"][i]["var"] + ' = {' + oResp["fillArr"][i]["value"] + '}');
          }
        }
        if (oResp["setDisplay"]) {
          for (i = 0; i < oResp["setDisplay"].length; i++) {
            if (document.getElementById(oResp["setDisplay"][i]["field"])) {
              document.getElementById(oResp["setDisplay"][i]["field"]).style.display = oResp["setDisplay"][i]["value"];
            }
          }
        }
        if (oResp["setVisibility"]) {
          for (i = 0; i < oResp["setVisibility"].length; i++) {
            if (document.getElementById(oResp["setVisibility"][i]["field"])) {
              document.getElementById(oResp["setVisibility"][i]["field"]).style.visibility = oResp["setVisibility"][i]["value"];
            }
          }
        }
        if (oResp["setDisabled"]) {
          for (i = 0; i < oResp["setDisabled"].length; i++) {
            if (document.getElementById(oResp["setDisabled"][i]["field"])) {
              document.getElementById(oResp["setDisabled"][i]["field"]).disabled = oResp["setDisabled"][i]["value"];
            }
          }
        }
        if (oResp["setClass"]) {
          for (i = 0; i < oResp["setClass"].length; i++) {
            if (document.getElementById(oResp["setClass"][i]["field"])) {
              document.getElementById(oResp["setClass"][i]["field"]).className = oResp["setClass"][i]["value"];
            }
          }
        }
        if (oResp["setSrc"]) {
          for (i = 0; i < oResp["setSrc"].length; i++) {
            if (document.getElementById(oResp["setSrc"][i]["field"])) {
              document.getElementById(oResp["setSrc"][i]["field"]).src = oResp["setSrc"][i]["value"];
            }
          }
        }
        if (oResp["grid_search_add"]) {
          for (i = 0; i < oResp["grid_search_add"].length; i++) {
               var parm = oResp["grid_search_add"][i]['field'];
               Tot_obj_grid_search++;
               Tab_obj_grid_search[Tot_obj_grid_search] = parm;
               $(oResp["grid_search_add"][i]['tag']).insertBefore('#add_grid_search');
               $('#grid_search_' + parm).attr('new', 'new');
               scLoadScInput('#grid_search_' + parm + '_' + Tot_obj_grid_search + ' input:text.sc-js-input');
          }
          SC_carga_evt_jquery_grid('all');
        }
        if (oResp["redirInfo"]) {
           nmAjaxRedir(oResp);
        }
        if (("grid_search_res" == opc || "dyn_search_res" == opc || "dyn_search_clear_res" == opc) && typeof scChart_update_inline == "function") {
            scChart_update_inline();
        }
        if (oResp["AlertJS"]) {
          for (i = 0; i < oResp["AlertJS"].length; i++) {
              jsAlertParams = oResp["AlertJSParam"][i] ? oResp["AlertJSParam"][i] : {};
              scJs_alert (oResp["AlertJS"][i], jsAlertParams);
          }
        }
        if (oResp["exec_JS"]) {
          for (i = 0; i < oResp["exec_JS"].length; i++) {
               eval (oResp["exec_JS"][i]["function"] + '("' + oResp["exec_JS"][i]["parm"] + '");');
          }
        }
        if (oResp["htmOutput"]) {
           nmAjaxShowDebug(oResp);
        }
        if (typeof scOrder_addClickControl == "function") {
            scOrder_addClickControl();
        }
        nmAjaxProcOff();
        if (oResp["exec_script"]) {
          for (i = 0; i < oResp["exec_script"].length; i++) {
              eval (oResp["exec_script"][i]);
          }
        }
    });
}
function ajax_add_grid_search(obj, str_origem, str_field)
{
    $(obj).parent().parent().remove();
    
    if($('#id_grid_search_all_cmp tr').length < 1)
    {
        $('#add_grid_search').addClass('scGridFilterTagAddDisabled');
    }
    else
    {
        $('#add_grid_search').removeClass('scGridFilterTagAddDisabled');
    }
    parm  = str_field;
    nmAjaxProcOn();
    Tot_obj_grid_search++;
    Tab_obj_grid_search[Tot_obj_grid_search] = parm;
    $.ajax({
      type: "POST",
      url: "index.php",
      data: "nmgp_opcao=ajax_add_grid_search&script_case_init=" + document.Fgrid_search.script_case_init.value + "&parm=" + parm + "&seq=" + Tot_obj_grid_search + "&origem=" + str_origem
     })
     .done(function(jsonGrid_add) {
        var i, oResp;
        Tst_integrid = jsonGrid_add.trim();
        if ("{" != Tst_integrid.substr(0, 1)) {
            nmAjaxProcOff();
            alert (jsonGrid_add);
            return;
        }
        eval("oResp = " + jsonGrid_add);
        if (oResp["ss_time_out"]) {
            nmAjaxProcOff();
            nm_move();
        }
        if (oResp["grid_add"]) {
          for (i = 0; i < oResp["grid_add"].length; i++) {
               $(oResp["grid_add"][i]).insertBefore('#add_grid_search');
               $('#grid_search_' + parm).attr('new', 'new');
               $('#grid_search_' + parm).find('.scGridFilterTagListItemLabel').click();
               $('#grid_search_' + parm).find('input[type=text]').focus();
          }
        }
        if (oResp["setVar"]) {
          for (i = 0; i < oResp["setVar"].length; i++) {
               eval (oResp["setVar"][i]["var"] + ' = \"' + oResp["setVar"][i]["value"] + '\"');
          }
        }
        if (oResp["htmOutput"]) {
           nmAjaxShowDebug(oResp);
        }
        SC_carga_evt_jquery_grid(Tot_obj_grid_search);
        scLoadScInput('#grid_search_' + parm + '_' + Tot_obj_grid_search + ' input:text.sc-js-input');
        nmAjaxProcOff();
    });
}
function ajax_save_ancor(f_submit, ancor)
{
    nmAjaxProcOn();
    $.ajax({
      type: "POST",
      url: "index.php",
      data: "nmgp_opcao=ajax_save_ancor&script_case_init=" + document.F3.script_case_init.value + "&ancor_save=" + ancor
     })
     .done(function(jsonSaveAncor) {
        nmAjaxProcOff();
        eval ("document." + f_submit + ".submit()");
    });
}
var strPath         = '';
var strTitle        = '';
var showAjaxProcess = true;
function ajax_export(tp_export, parms, strCallback, showAjax)
{
    strPath  = '';
    strTitle  = '';
    showAjaxProcess = showAjax;
    if(showAjaxProcess)
    {
        nmAjaxProcOn();
    }
    $.ajax({
      type: "POST",
      url: "index.php",
      data: "nmgp_opcao=ajax_export&export_opc=" + tp_export + parms + "&script_case_init=" + document.F3.script_case_init.value,
      complete: strCallback,
     })
     .done(function(jsonFile) {
        var oResp;
        Tst_integrid = jsonFile.trim();
        if ("{" != Tst_integrid.substr(0, 1)) {
            nmAjaxProcOff();
            alert (jsonFile);
            return;
        }
        eval("oResp = " + jsonFile);
        if (oResp["ss_time_out"]) {
            nmAjaxProcOff();
            nm_move();
        }
        if (oResp["htmOutput"]) {
           nmAjaxShowDebug(oResp);
        }
        if (oResp["file_export"]) {
            strPath = oResp['file_export'];
            strTitle = oResp['title_export'];
        }
        if(showAjaxProcess)
        {
            nmAjaxProcOff();
        }
    });
}

