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

