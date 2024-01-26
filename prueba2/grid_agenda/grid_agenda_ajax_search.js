
  // ---------- Proc BI
function ajax_ch_bi_search(field, parm)
{
    nmAjaxProcOn();
    $.ajax({
      type: "POST",
      url: "index.php",
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

// ---------- delete_filter
function ajax_delete_filter(parm)
{
    nmAjaxProcOn();
    $.ajax({
      type: "POST",
      url: "index.php",
      data: "nmgp_opcao=ajax_filter_delete&script_case_init=" + document.F1.script_case_init.value + "&NM_filters_del=" + parm
     })
     .done(function(json_del_fil) {
        var i, oResp;
        Tst_integrid = json_del_fil.trim();
        if ("{" != Tst_integrid.substr(0, 1)) {
            nmAjaxProcOff();
            alert (json_del_fil);
            return;
        }
        eval("oResp = " + json_del_fil);
        if (oResp["ss_time_out"]) {
            nmAjaxProcOff();
            nm_move();
        }
        if (oResp["setValue"]) {
          for (i = 0; i < oResp["setValue"].length; i++) {
               $("#" + oResp["setValue"][i]["field"]).html(oResp["setValue"][i]["value"]);
          }
        }
        nmAjaxProcOff();
        var deleteFilterEvent = new Event('updatefilter');
        document.dispatchEvent(deleteFilterEvent);
    });
}

// ---------- save_filter
function ajax_save_filter(save_name, save_opt, parm, pos)
{
    nmAjaxProcOn();
    $.ajax({
      type: "POST",
      url: "index.php",
      data: "nmgp_opcao=ajax_filter_save&script_case_init=" + document.F1.script_case_init.value + "&nmgp_save_name=" + save_name + "&nmgp_save_option=" + save_opt + "&NM_filters_save=" + parm
     })
     .done(function(json_save_fil) {
        var i, oResp;
        Tst_integrid = json_save_fil.trim();
        if ("{" != Tst_integrid.substr(0, 1)) {
            nmAjaxProcOff();
            alert (json_save_fil);
            return;
        }
        eval("oResp = " + json_save_fil);
        if (oResp["ss_time_out"]) {
            nmAjaxProcOff();
            nm_move();
        }
        if (oResp["setValue"]) {
          for (i = 0; i < oResp["setValue"].length; i++) {
               $("#" + oResp["setValue"][i]["field"]).html(oResp["setValue"][i]["value"]);
          }
        }
        if (oResp["htmOutput"]) {
            nmAjaxShowDebug(oResp);
         }
        document.getElementById('sel_recup_filters_' + pos).selectedIndex = -1;
        document.getElementById('sel_filters_del_' + pos).selectedIndex = -1;
        document.getElementById('SC_nmgp_save_name_' + pos).value = '';
        document.getElementById('Apaga_filters_' + pos).style.display = '';
        document.getElementById('sel_recup_filters_' + pos).style.display = '';
        document.getElementById('Salvar_filters_' + pos).style.display = 'none';
        nmAjaxProcOff();
        var saveFilterEvent = new Event('updatefilter');
        document.dispatchEvent(saveFilterEvent);
    });
}

// ---------- select_filter
var Table_sv_fil = new Array();
Table_sv_fil[0] = "estado_actual";
Table_sv_fil[1] = "id_tecnico";
Table_sv_fil[2] = "valor_total";
Table_sv_fil[3] = "fecha_inicial";
function ajax_select_filter(parm)
{
    nmAjaxProcOn();
    $.ajax({
      type: "POST", async:false,
      url: "index.php",
      data: "nmgp_opcao=ajax_filter_select&script_case_init=" + document.F1.script_case_init.value + "&NM_filters=" + parm
     })
     .done(function(json_sel_fil) {
        var i, oResp;
        Tst_integrid = json_sel_fil.trim();
        if ("{" != Tst_integrid.substr(0, 1)) {
            nmAjaxProcOff();
            alert (json_sel_fil);
            return;
        }
        eval("oResp = " + json_sel_fil);
        if (oResp["ss_time_out"]) {
            nmAjaxProcOff();
            nm_move();
        }
        limpa_form();
        if (oResp["set_val"]) {
          for (i = 0; i < oResp["set_val"].length; i++) {
               $("#" + oResp["set_val"][i]["field"]).val(oResp["set_val"][i]["value"]);
          }
        }
        if (oResp["set_html"]) {
          for (i = 0; i < oResp["set_html"].length; i++) {
               $("#" + oResp["set_html"][i]["field"]).html(oResp["set_html"][i]["value"]);
          }
        }
        if (oResp["setVar"]) {
          for (i = 0; i < oResp["setVar"].length; i++) {
               eval (oResp["setVar"][i]["var"] + ' = \"' + oResp["setVar"][i]["value"] + '\"');
          }
        }
        if (oResp["set_radio"]) {
          for (i = 0; i < oResp["set_radio"].length; i++) {
               if ($("#" + oResp["set_radio"][i]["field"])) {
                   $("#" + oResp["set_radio"][i]["field"]).removeAttr('checked');
                   $('input[id="' + oResp["set_radio"][i]["field"] + '"][value="' + oResp["set_radio"][i]["value"] + '"]').prop('checked', true);
              }
          }
        }
        if (oResp["set_checkbox_single"]) {
          for (i = 0; i < oResp["set_checkbox_single"].length; i++) {
              var cmp_ck = oResp["set_checkbox_single"][i]["field"].substr(3);
              if (document.F1.elements[cmp_ck]) {
                  var obj_check = document.F1.elements[cmp_ck];
                  if (obj_check.length == undefined) {
                      document.F1.elements[cmp_ck].checked = false;
                      for (y = 0; y < oResp["set_checkbox_single"][i]["value"].length; y++) {
                          if (document.F1.elements[cmp_ck].value == oResp["set_checkbox_single"][i]["value"][y]) {
                              document.F1.elements[cmp_ck].checked = true;
                          }
                      }
                  }
              }
          }
        }
        if (oResp["set_checkbox"]) {
          for (i = 0; i < oResp["set_checkbox"].length; i++) {
              var cmp_ck = oResp["set_checkbox"][i]["field"].substr(3) + "[]";
              if (document.F1.elements[cmp_ck]) {
                  var obj_check = document.F1.elements[cmp_ck];
                  if (obj_check.length == undefined) {
                      document.F1.elements[cmp_ck].checked = false;
                      for (y = 0; y < oResp["set_checkbox"][i]["value"].length; y++) {
                          if (document.F1.elements[cmp_ck].value == oResp["set_checkbox"][i]["value"][y]) {
                              document.F1.elements[cmp_ck].checked = true;
                          }
                      }
                  }
                  if (obj_check.length != undefined) {
                      for (x = 0; x < obj_check.length; x++) {
                          obj_check[x].checked = false;
                      }
                      for (x = 0; x < obj_check.length; x++) {
                          for (y = 0; y < oResp["set_checkbox"][i]["value"].length; y++) {
                              if (obj_check[x].value == oResp["set_checkbox"][i]["value"][y]) {
                                  obj_check[x].checked = true;
                              }
                          }
                      }
                  }
              }
          }
        }
        if (oResp["set_selmult"]) {
          for (i = 0; i < oResp["set_selmult"].length; i++) {
             var obj_sel = document.getElementById(oResp["set_selmult"][i]["field"]);
             for (x = 0; x < obj_sel.length; x++) {
                 if (obj_sel[x].selected) {
                    obj_sel[x].selected = false;
                 }
             }
             for (x = 0; x < obj_sel.length; x++) {
                 for (y = 0; y < oResp["set_selmult"][i]["value"].length; y++) {
                     if (obj_sel[x].value == oResp["set_selmult"][i]["value"][y]) {
                         obj_sel[x].selected = true;
                     }
                 }
             }
          }
        }
        if (oResp["set_ddcheckbox"]) {
          for (i = 0; i < oResp["set_ddcheckbox"].length; i++) {
             var obj_sel = document.getElementById(oResp["set_ddcheckbox"][i]["field"]);
             var cmp_chk = oResp["set_ddcheckbox"][i]["field"].substring(3);
             $('#' + oResp["set_ddcheckbox"][i]["field"]).dropdownchecklist('destroy');
             $('#' + oResp["set_ddcheckbox"][i]["field"] + ' option').each(function() {
                $(this).attr('selected',false);
             });
             for (x = 0; x < obj_sel.length; x++) {
                 for (y = 0; y < oResp["set_ddcheckbox"][i]["value"].length; y++) {
                     if (obj_sel[x].value == oResp["set_ddcheckbox"][i]["value"][y]) {
                         obj_sel[x].selected = true;
                     }
                 }
             }
          }
          Sc_carga_ddcheckbox(cmp_chk);
        }
        if (oResp["set_dselect"]) {
          for (i = 0; i < oResp["set_dselect"].length; i++) {
              var obj_sel_orig = document.getElementById(oResp["set_dselect"][i]["field"] + "_orig");
              var obj_sel_dest = document.getElementById(oResp["set_dselect"][i]["field"] + "_dest");
              obj_sel_dest.length = 0
              for (x = 0; x < obj_sel_orig.length; x++) {
                     obj_sel_orig[x].disabled = false;
                     obj_sel_orig[x].style.color = "";
              }
              var ind = 0;
              for (y = 0; y < oResp["set_dselect"][i]["value"].length; y++) {
                 for (x = 0; x < obj_sel_orig.length; x++) {
                     if (obj_sel_orig[x].value == oResp["set_dselect"][i]["value"][y]["opt"]) {
                         obj_sel_orig[x].disabled = true;
                         obj_sel_orig[x].style.color = "#A0A0A0";
                         obj_sel_dest.options[ind] = new Option(oResp["set_dselect"][i]["value"][y]["value"], oResp["set_dselect"][i]["value"][y]["opt"]);
                         ind++;
                     }
                 }
             }
          }
        }
        if (oResp["set_select2_aut"]) {
          for (i = 0; i < oResp["set_select2_aut"].length; i++) {
               $("#" + oResp["set_select2_aut"][i]["field"]).val(null).trigger('change');
               var newOption = new Option(oResp["set_select2_aut"][i]["value"], oResp["set_select2_aut"][i]["value"], true, true);
               $("#" + oResp["set_select2_aut"][i]["field"]).append(newOption);
          }
        }
        if (oResp["set_fil_order"]) {
          for (i = 0; i < oResp["set_fil_order"].length; i++) {
              var obj_sel_orig = document.getElementById(oResp["set_fil_order"][i]["field"] + "_orig");
              var obj_sel_dest = document.getElementById(oResp["set_fil_order"][i]["field"] + "_dest");
              obj_sel_dest.length = 0
              for (x = 0; x < obj_sel_orig.length; x++) {
                     obj_sel_orig[x].disabled = false;
                     obj_sel_orig[x].style.color = "";
              }
              var ind = 0;
              for (y = 0; y < oResp["set_fil_order"][i]["value"].length; y++) {
                 for (x = 0; x < obj_sel_orig.length; x++) {
                     if (obj_sel_orig[x].value == oResp["set_fil_order"][i]["value"][y].substr(1)) {
                         obj_sel_orig[x].disabled = true;
                         obj_sel_orig[x].style.color = "#A0A0A0";
                         obj_sel_dest.options[ind] = new Option(oResp["set_fil_order"][i]["value"][y], oResp["set_fil_order"][i]["value"][y]);
                         ind++;
                     }
                 }
             }
          }
        }
        if (oResp["exec_JS"]) {
          for (i = 0; i < oResp["exec_JS"].length; i++) {
               eval (oResp["exec_JS"][i]["function"] + '("' + oResp["exec_JS"][i]["parm"] + '");');
          }
        }
        if ($("#SC_fecha_inicial_cond") && search_get_sel_txt("SC_fecha_inicial_cond").substring(0, 3) == "bi_") {
            formata_bi_fecha_inicial(search_get_sel_txt("SC_fecha_inicial_cond"), SC_fecha_inicial_bi_opc, SC_fecha_inicial_bi_dt);
        }
        for (i = 0; i < Table_sv_fil.length; i++) {
           if (document.getElementById('id_vis_' + Table_sv_fil[i])) {
              if (search_get_sel_txt("SC_" + Table_sv_fil[i] + "_cond") == "bw") {
                 document.getElementById('id_vis_' + Table_sv_fil[i]).style.display ='';
              }
              else {
                 document.getElementById('id_vis_' + Table_sv_fil[i]).style.display ='none';
              }
           }
        }
        nmAjaxProcOff();
    });
}
