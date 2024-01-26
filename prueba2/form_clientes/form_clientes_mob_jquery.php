
function scJQGeneralAdd() {
  scLoadScInput('input:text.sc-js-input');
  scLoadScInput('input:password.sc-js-input');
  scLoadScInput('input:checkbox.sc-js-input');
  scLoadScInput('input:radio.sc-js-input');
  scLoadScInput('select.sc-js-input');
  scLoadScInput('textarea.sc-js-input');

} // scJQGeneralAdd

function scFocusField(sField) {
  var $oField = $('#id_sc_field_' + sField);

  if (0 == $oField.length) {
    $oField = $('input[name=' + sField + ']');
  }

  if (0 == $oField.length && document.F1.elements[sField]) {
    $oField = $(document.F1.elements[sField]);
  }

  if ($("#id_ac_" + sField).length > 0) {
    if ($oField.hasClass("select2-hidden-accessible")) {
      if (false == scSetFocusOnField($oField)) {
        setTimeout(function() { scSetFocusOnField($oField); }, 500);
      }
    }
    else {
      if (false == scSetFocusOnField($oField)) {
        if (false == scSetFocusOnField($("#id_ac_" + sField))) {
          setTimeout(function() { scSetFocusOnField($("#id_ac_" + sField)); }, 500);
        }
      }
      else {
        setTimeout(function() { scSetFocusOnField($oField); }, 500);
      }
    }
  }
  else {
    setTimeout(function() { scSetFocusOnField($oField); }, 500);
  }
} // scFocusField

function scSetFocusOnField($oField) {
  if ($oField.length > 0 && $oField[0].offsetHeight > 0 && $oField[0].offsetWidth > 0 && !$oField[0].disabled) {
    $oField[0].focus();
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["id_cliente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nombre_cliente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["email_cliente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["telefono_cliente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["direccion_cliente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["pais_cliente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["ciudad_cliente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["distrito_cliente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["postal_cliente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuario_login" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["id_cliente" + iSeqRow] && scEventControl_data["id_cliente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_cliente" + iSeqRow] && scEventControl_data["id_cliente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nombre_cliente" + iSeqRow] && scEventControl_data["nombre_cliente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nombre_cliente" + iSeqRow] && scEventControl_data["nombre_cliente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["email_cliente" + iSeqRow] && scEventControl_data["email_cliente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["email_cliente" + iSeqRow] && scEventControl_data["email_cliente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["telefono_cliente" + iSeqRow] && scEventControl_data["telefono_cliente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["telefono_cliente" + iSeqRow] && scEventControl_data["telefono_cliente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["direccion_cliente" + iSeqRow] && scEventControl_data["direccion_cliente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["direccion_cliente" + iSeqRow] && scEventControl_data["direccion_cliente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["pais_cliente" + iSeqRow] && scEventControl_data["pais_cliente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["pais_cliente" + iSeqRow] && scEventControl_data["pais_cliente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ciudad_cliente" + iSeqRow] && scEventControl_data["ciudad_cliente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ciudad_cliente" + iSeqRow] && scEventControl_data["ciudad_cliente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["distrito_cliente" + iSeqRow] && scEventControl_data["distrito_cliente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["distrito_cliente" + iSeqRow] && scEventControl_data["distrito_cliente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["postal_cliente" + iSeqRow] && scEventControl_data["postal_cliente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["postal_cliente" + iSeqRow] && scEventControl_data["postal_cliente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuario_login" + iSeqRow] && scEventControl_data["usuario_login" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuario_login" + iSeqRow] && scEventControl_data["usuario_login" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["pais_cliente" + iSeqRow] && scEventControl_data["pais_cliente" + iSeqRow]["autocomp"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("ciudad_cliente" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("usuario_login" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  scEventControl_data[fieldName]["change"] = false;
} // scEventControl_onFocus

function scEventControl_onBlur(sFieldName) {
  scEventControl_data[sFieldName]["blur"] = false;
  if (scEventControl_data[sFieldName]["change"]) {
        if (scEventControl_data[sFieldName]["original"] == $("#id_sc_field_" + sFieldName).val() || scEventControl_data[sFieldName]["calculated"] == $("#id_sc_field_" + sFieldName).val()) {
          scEventControl_data[sFieldName]["change"] = false;
        }
  }
} // scEventControl_onBlur

function scEventControl_onChange(sFieldName) {
  scEventControl_data[sFieldName]["change"] = false;
} // scEventControl_onChange

function scEventControl_onAutocomp(sFieldName) {
  scEventControl_data[sFieldName]["autocomp"] = false;
} // scEventControl_onChange

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_id_cliente' + iSeqRow).bind('blur', function() { sc_form_clientes_id_cliente_onblur(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_clientes_id_cliente_onfocus(this, iSeqRow) });
  $('#id_sc_field_nombre_cliente' + iSeqRow).bind('blur', function() { sc_form_clientes_nombre_cliente_onblur(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_clientes_nombre_cliente_onfocus(this, iSeqRow) });
  $('#id_sc_field_email_cliente' + iSeqRow).bind('blur', function() { sc_form_clientes_email_cliente_onblur(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_clientes_email_cliente_onfocus(this, iSeqRow) });
  $('#id_sc_field_telefono_cliente' + iSeqRow).bind('blur', function() { sc_form_clientes_telefono_cliente_onblur(this, iSeqRow) })
                                              .bind('focus', function() { sc_form_clientes_telefono_cliente_onfocus(this, iSeqRow) });
  $('#id_sc_field_direccion_cliente' + iSeqRow).bind('blur', function() { sc_form_clientes_direccion_cliente_onblur(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_clientes_direccion_cliente_onfocus(this, iSeqRow) });
  $('#id_sc_field_ciudad_cliente' + iSeqRow).bind('blur', function() { sc_form_clientes_ciudad_cliente_onblur(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_clientes_ciudad_cliente_onfocus(this, iSeqRow) });
  $('#id_sc_field_distrito_cliente' + iSeqRow).bind('blur', function() { sc_form_clientes_distrito_cliente_onblur(this, iSeqRow) })
                                              .bind('focus', function() { sc_form_clientes_distrito_cliente_onfocus(this, iSeqRow) });
  $('#id_sc_field_pais_cliente' + iSeqRow).bind('blur', function() { sc_form_clientes_pais_cliente_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_clientes_pais_cliente_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_clientes_pais_cliente_onfocus(this, iSeqRow) });
  $('#id_sc_field_postal_cliente' + iSeqRow).bind('blur', function() { sc_form_clientes_postal_cliente_onblur(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_clientes_postal_cliente_onfocus(this, iSeqRow) });
  $('#id_sc_field_usuario_login' + iSeqRow).bind('blur', function() { sc_form_clientes_usuario_login_onblur(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_clientes_usuario_login_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_clientes_id_cliente_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_mob_validate_id_cliente();
  scCssBlur(oThis);
}

function sc_form_clientes_id_cliente_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_nombre_cliente_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_mob_validate_nombre_cliente();
  scCssBlur(oThis);
}

function sc_form_clientes_nombre_cliente_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_email_cliente_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_mob_validate_email_cliente();
  scCssBlur(oThis);
}

function sc_form_clientes_email_cliente_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_telefono_cliente_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_mob_validate_telefono_cliente();
  scCssBlur(oThis);
}

function sc_form_clientes_telefono_cliente_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_direccion_cliente_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_mob_validate_direccion_cliente();
  scCssBlur(oThis);
}

function sc_form_clientes_direccion_cliente_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_ciudad_cliente_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_mob_validate_ciudad_cliente();
  scCssBlur(oThis);
}

function sc_form_clientes_ciudad_cliente_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_distrito_cliente_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_mob_validate_distrito_cliente();
  scCssBlur(oThis);
}

function sc_form_clientes_distrito_cliente_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_pais_cliente_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_mob_validate_pais_cliente();
  scCssBlur(oThis);
}

function sc_form_clientes_pais_cliente_onchange(oThis, iSeqRow) {
  do_ajax_form_clientes_mob_refresh_pais_cliente();
}

function sc_form_clientes_pais_cliente_onfocus(oThis, iSeqRow) {
  scCssFocus(oThis);
}

function sc_form_clientes_postal_cliente_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_mob_validate_postal_cliente();
  scCssBlur(oThis);
}

function sc_form_clientes_postal_cliente_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_usuario_login_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_mob_validate_usuario_login();
  scCssBlur(oThis);
}

function sc_form_clientes_usuario_login_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("id_cliente", "", status);
	displayChange_field("nombre_cliente", "", status);
	displayChange_field("email_cliente", "", status);
	displayChange_field("telefono_cliente", "", status);
	displayChange_field("direccion_cliente", "", status);
	displayChange_field("pais_cliente", "", status);
	displayChange_field("ciudad_cliente", "", status);
	displayChange_field("distrito_cliente", "", status);
	displayChange_field("postal_cliente", "", status);
	displayChange_field("usuario_login", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_id_cliente(row, status);
	displayChange_field_nombre_cliente(row, status);
	displayChange_field_email_cliente(row, status);
	displayChange_field_telefono_cliente(row, status);
	displayChange_field_direccion_cliente(row, status);
	displayChange_field_pais_cliente(row, status);
	displayChange_field_ciudad_cliente(row, status);
	displayChange_field_distrito_cliente(row, status);
	displayChange_field_postal_cliente(row, status);
	displayChange_field_usuario_login(row, status);
}

function displayChange_field(field, row, status) {
	if ("id_cliente" == field) {
		displayChange_field_id_cliente(row, status);
	}
	if ("nombre_cliente" == field) {
		displayChange_field_nombre_cliente(row, status);
	}
	if ("email_cliente" == field) {
		displayChange_field_email_cliente(row, status);
	}
	if ("telefono_cliente" == field) {
		displayChange_field_telefono_cliente(row, status);
	}
	if ("direccion_cliente" == field) {
		displayChange_field_direccion_cliente(row, status);
	}
	if ("pais_cliente" == field) {
		displayChange_field_pais_cliente(row, status);
	}
	if ("ciudad_cliente" == field) {
		displayChange_field_ciudad_cliente(row, status);
	}
	if ("distrito_cliente" == field) {
		displayChange_field_distrito_cliente(row, status);
	}
	if ("postal_cliente" == field) {
		displayChange_field_postal_cliente(row, status);
	}
	if ("usuario_login" == field) {
		displayChange_field_usuario_login(row, status);
	}
}

function displayChange_field_id_cliente(row, status) {
    var fieldId;
}

function displayChange_field_nombre_cliente(row, status) {
    var fieldId;
}

function displayChange_field_email_cliente(row, status) {
    var fieldId;
}

function displayChange_field_telefono_cliente(row, status) {
    var fieldId;
}

function displayChange_field_direccion_cliente(row, status) {
    var fieldId;
}

function displayChange_field_pais_cliente(row, status) {
    var fieldId;
}

function displayChange_field_ciudad_cliente(row, status) {
    var fieldId;
}

function displayChange_field_distrito_cliente(row, status) {
    var fieldId;
}

function displayChange_field_postal_cliente(row, status) {
    var fieldId;
}

function displayChange_field_usuario_login(row, status) {
    var fieldId;
	if ("on" == status) {
		if ("all" == row) {
			var fieldList = $(".css_usuario_login__obj");
			for (var i = 0; i < fieldList.length; i++) {
				$($(fieldList[i]).attr("id")).select2("destroy");
			}
		}
		else {
			$("#id_sc_field_usuario_login" + row).select2("destroy");
		}
		scJQSelect2Add(row, "usuario_login");
	}
}

function scRecreateSelect2() {
	displayChange_field_usuario_login("all", "on");
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_clientes_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(25);
		}
	}
}
function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd

var api_cache_requests = [];
function ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, hasRun, img_before){
    setTimeout(function(){
        if(img_name == '') return;
        iSeqRow= iSeqRow !== undefined && iSeqRow !== null ? iSeqRow : '';
        var hasVar = p.indexOf('_@NM@_') > -1 || p_cache.indexOf('_@NM@_') > -1 ? true : false;

        p = p.split('_@NM@_');
        $.each(p, function(i,v){
            try{
                p[i] = $('[name='+v+iSeqRow+']').val();
            }
            catch(err){
                p[i] = v;
            }
        });
        p = p.join('');

        p_cache = p_cache.split('_@NM@_');
        $.each(p_cache, function(i,v){
            try{
                p_cache[i] = $('[name='+v+iSeqRow+']').val();
            }
            catch(err){
                p_cache[i] = v;
            }
        });
        p_cache = p_cache.join('');

        img_before = img_before !== undefined ? img_before : $(t).attr('src');
        var str_key_cache = '<?php echo $this->Ini->sc_page; ?>' + img_name+field+p+p_cache;
        if(api_cache_requests[ str_key_cache ] !== undefined && api_cache_requests[ str_key_cache ] !== null){
            if(api_cache_requests[ str_key_cache ] != false){
                do_ajax_check_file(api_cache_requests[ str_key_cache ], field  ,t, iSeqRow);
            }
            return;
        }
        //scAjaxProcOn();
        $(t).attr('src', '<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif');
        api_cache_requests[ str_key_cache ] = false;
        var rs =$.ajax({
                    type: "POST",
                    url: 'index.php?script_case_init=<?php echo $this->Ini->sc_page; ?>',
                    async: true,
                    data:'nmgp_opcao=ajax_check_file&AjaxCheckImg=' + encodeURI(img_name) +'&rsargs='+ field + '&p=' + p + '&p_cache=' + p_cache,
                    success: function (rs) {
                        if(rs.indexOf('</span>') != -1){
                            rs = rs.substr(rs.indexOf('</span>') + 7);
                        }
                        if(rs.indexOf('/') != -1 && rs.indexOf('/') != 0){
                            rs = rs.substr(rs.indexOf('/'));
                        }
                        rs = sc_trim(rs);

                        // if(rs == 0 && hasVar && hasRun === undefined){
                        //     delete window.api_cache_requests[ str_key_cache ];
                        //     ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, 1, img_before);
                        //     return;
                        // }
                        window.api_cache_requests[ str_key_cache ] = rs;
                        do_ajax_check_file(rs, field  ,t, iSeqRow)
                        if(rs == 0){
                            delete window.api_cache_requests[ str_key_cache ];

                           // $(t).attr('src',img_before);
                            do_ajax_check_file(img_before+'_@@NM@@_' + img_before, field  ,t, iSeqRow)

                        }


                    }
        });
    },100);
}

function do_ajax_check_file(rs, field  ,t, iSeqRow){
    if (rs != 0) {
        rs_split = rs.split('_@@NM@@_');
        rs_orig = rs_split[0];
        rs2 = rs_split[1];
        try{
            if(!$(t).is('img')){

                if($('#id_read_on_'+field+iSeqRow).length > 0 ){
                                    var usa_read_only = false;

                switch(field){

                }
                     if(usa_read_only && $('a',$('#id_read_on_'+field+iSeqRow)).length == 0){
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_clientes_mob')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    var target = $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href').split(',');
                    target[1] = "'"+rs2+"'";
                    $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href', target.join(','));
                }else{
                    var target = $(t).attr('href').split(',');
                     target[1] = "'"+rs2+"'";
                     $(t).attr('href', target.join(','));
                }
            }else{
                $(t).attr('src', rs2);
                $(t).css('display', '');
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    var target = $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href').split(',');
                    target[1] = "'"+rs2+"'";
                    $(t).attr('href', target.join(','));
                }else{
                     var t_link = $(t).parent('a');
                     var target = $(t_link).attr('href').split(',');
                     target[0] = "javascript:nm_mostra_img('"+rs_orig+"'";
                     $(t_link).attr('href', target.join(','));
                }

            }
            eval("window.var_ajax_img_"+field+iSeqRow+" = '"+rs_orig+"';");

        } catch(err){
                        eval("window.var_ajax_img_"+field+iSeqRow+" = '"+rs_orig+"';");

        }
    }
   /* hasFalseCacheRequest = false;
    $.each(api_cache_requests, function(i,v){
        if(v == false){
            hasFalseCacheRequest = true;
        }
    });
    if(hasFalseCacheRequest == false){
        scAjaxProcOff();
    }*/
}

$(document).ready(function(){
});

function scJQPasswordToggleAdd(seqRow) {
  $(".sc-ui-pwd-toggle-icon" + seqRow).on("click", function() {
    var fieldName = $(this).attr("id").substr(17), fieldObj = $("#id_sc_field_" + fieldName), fieldFA = $("#id_pwd_fa_" + fieldName);
    if ("text" == fieldObj.attr("type")) {
      fieldObj.attr("type", "password");
      fieldFA.attr("class", "fa fa-eye sc-ui-pwd-eye");
    } else {
      fieldObj.attr("type", "text");
      fieldFA.attr("class", "fa fa-eye-slash sc-ui-pwd-eye");
    }
  });
} // scJQPasswordToggleAdd

function scJQSelect2Add(seqRow, specificField) {
  if (null == specificField || "usuario_login" == specificField) {
    scJQSelect2Add_usuario_login(seqRow);
  }
} // scJQSelect2Add

function scJQSelect2Add_usuario_login(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_usuario_login_obj" : "#id_sc_field_usuario_login" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_usuario_login_obj',
      dropdownCssClass: 'css_usuario_login_obj',
      language: {
        noResults: function() {
          return "<?php echo $this->Ini->Nm_lang['lang_autocomp_notfound'] ?>";
        },
        searching: function() {
          return "<?php echo $this->Ini->Nm_lang['lang_autocomp_searching'] ?>";
        }
      }
    }
  );
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
  setTimeout(function () { if ('function' == typeof displayChange_field_usuario_login) { displayChange_field_usuario_login(iLine, "on"); } }, 150);
} // scJQElementsAdd

function scGetFileExtension(fileName)
{
    fileNameParts = fileName.split(".");

    if (1 === fileNameParts.length || (2 === fileNameParts.length && "" == fileNameParts[0])) {
        return "";
    }

    return fileNameParts.pop().toLowerCase();
}

function scFormatExtensionSizeErrorMsg(errorMsg)
{
    var msgInfo = errorMsg.split("||"), returnMsg = "";

    if ("err_size" == msgInfo[0]) {
        returnMsg = "<?php echo $this->Ini->Nm_lang['lang_errm_file_size'] ?>. <?php echo $this->Ini->Nm_lang['lang_errm_file_size_extension'] ?>".replace("{SC_EXTENSION}", msgInfo[1]).replace("{SC_LIMIT}", msgInfo[2]);
    } else if ("err_extension" == msgInfo[0]) {
        returnMsg = "<?php echo $this->Ini->Nm_lang['lang_errm_file_invl'] ?>";
    }

    return returnMsg;
}

