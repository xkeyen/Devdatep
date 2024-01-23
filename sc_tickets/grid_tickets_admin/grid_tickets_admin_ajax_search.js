
  // ---------- Proc BI
function ajax_ch_bi_search(field, parm)
{
    nmAjaxProcOn();
    $.ajax({
      type: "POST",
      url: "grid_tickets_admin.php",
      data: "nmgp_opcao=ajax_ch_bi_search&script_case_init=" + document.F1.script_case_init.value + "&Campo_bi=" + field + "&Opc_bi=" + parm
     })
     .done(function(json_ch_bi) {
        var i, oResp, ret_bi_opc;
        ret_bi_opc = parm;
        ret_bi_dt  = '';
        Tst_integrid = json_ch_bi.trim();
        if ("{" != Tst_integrid.substr(0, 1)) {
            nmAjaxProcOff();
            alert (jsonDyn_ch_bi);
            return;
        }
        eval("oResp = " + json_ch_bi);
        if (oResp["ss_time_out"]) {
            nmAjaxProcOff();
            nm_move();
        }
        if (oResp["ch_bi"]) {
          for (i = 0; i < oResp["ch_bi"].length; i++) {
               $("#" + oResp["ch_bi"][i]["field"]).val(oResp["ch_bi"][i]["value"]);
          }
        }
        if (oResp["setVar"]) {
          for (i = 0; i < oResp["setVar"].length; i++) {
               eval (oResp["setVar"][i]["var"] + ' = \"' + oResp["setVar"][i]["value"] + '\"');
          }
        }
        x = eval("formata_bi_" + field);
        x(parm, ret_bi_opc, ret_bi_dt);
        nmAjaxProcOff();
    });
}
