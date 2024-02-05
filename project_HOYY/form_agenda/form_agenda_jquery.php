
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
  scEventControl_data["id_agenda" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_tecnico" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_cliente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["valor" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["costes_adicionales" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["descuento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["valor_total" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fecha_inicial" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hora_inicial" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fecha_final" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hora_final" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["estado_actual" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["recurrencia" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["periodo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evaluacion" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["id_agenda" + iSeqRow] && scEventControl_data["id_agenda" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_agenda" + iSeqRow] && scEventControl_data["id_agenda" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_tecnico" + iSeqRow] && scEventControl_data["id_tecnico" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_tecnico" + iSeqRow] && scEventControl_data["id_tecnico" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_cliente" + iSeqRow] && scEventControl_data["id_cliente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_cliente" + iSeqRow] && scEventControl_data["id_cliente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["valor" + iSeqRow] && scEventControl_data["valor" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["valor" + iSeqRow] && scEventControl_data["valor" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["costes_adicionales" + iSeqRow] && scEventControl_data["costes_adicionales" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["costes_adicionales" + iSeqRow] && scEventControl_data["costes_adicionales" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["descuento" + iSeqRow] && scEventControl_data["descuento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["descuento" + iSeqRow] && scEventControl_data["descuento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["valor_total" + iSeqRow] && scEventControl_data["valor_total" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["valor_total" + iSeqRow] && scEventControl_data["valor_total" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fecha_inicial" + iSeqRow] && scEventControl_data["fecha_inicial" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fecha_inicial" + iSeqRow] && scEventControl_data["fecha_inicial" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hora_inicial" + iSeqRow] && scEventControl_data["hora_inicial" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hora_inicial" + iSeqRow] && scEventControl_data["hora_inicial" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fecha_final" + iSeqRow] && scEventControl_data["fecha_final" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fecha_final" + iSeqRow] && scEventControl_data["fecha_final" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hora_final" + iSeqRow] && scEventControl_data["hora_final" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hora_final" + iSeqRow] && scEventControl_data["hora_final" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["estado_actual" + iSeqRow] && scEventControl_data["estado_actual" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["estado_actual" + iSeqRow] && scEventControl_data["estado_actual" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["recurrencia" + iSeqRow] && scEventControl_data["recurrencia" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["recurrencia" + iSeqRow] && scEventControl_data["recurrencia" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["periodo" + iSeqRow] && scEventControl_data["periodo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["periodo" + iSeqRow] && scEventControl_data["periodo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evaluacion" + iSeqRow] && scEventControl_data["evaluacion" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evaluacion" + iSeqRow] && scEventControl_data["evaluacion" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
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
  $('#id_sc_field_id_agenda' + iSeqRow).bind('blur', function() { sc_form_agenda_id_agenda_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_agenda_id_agenda_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_agenda_id_agenda_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_tecnico' + iSeqRow).bind('blur', function() { sc_form_agenda_id_tecnico_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_agenda_id_tecnico_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_agenda_id_tecnico_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_cliente' + iSeqRow).bind('blur', function() { sc_form_agenda_id_cliente_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_agenda_id_cliente_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_agenda_id_cliente_onfocus(this, iSeqRow) });
  $('#id_sc_field_valor' + iSeqRow).bind('blur', function() { sc_form_agenda_valor_onblur(this, iSeqRow) })
                                   .bind('change', function() { sc_form_agenda_valor_onchange(this, iSeqRow) })
                                   .bind('focus', function() { sc_form_agenda_valor_onfocus(this, iSeqRow) });
  $('#id_sc_field_costes_adicionales' + iSeqRow).bind('blur', function() { sc_form_agenda_costes_adicionales_onblur(this, iSeqRow) })
                                                .bind('change', function() { sc_form_agenda_costes_adicionales_onchange(this, iSeqRow) })
                                                .bind('focus', function() { sc_form_agenda_costes_adicionales_onfocus(this, iSeqRow) });
  $('#id_sc_field_descuento' + iSeqRow).bind('blur', function() { sc_form_agenda_descuento_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_agenda_descuento_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_agenda_descuento_onfocus(this, iSeqRow) });
  $('#id_sc_field_valor_total' + iSeqRow).bind('blur', function() { sc_form_agenda_valor_total_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_agenda_valor_total_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_agenda_valor_total_onfocus(this, iSeqRow) });
  $('#id_sc_field_fecha_inicial' + iSeqRow).bind('blur', function() { sc_form_agenda_fecha_inicial_onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_form_agenda_fecha_inicial_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_agenda_fecha_inicial_onfocus(this, iSeqRow) });
  $('#id_sc_field_hora_inicial' + iSeqRow).bind('blur', function() { sc_form_agenda_hora_inicial_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_agenda_hora_inicial_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_agenda_hora_inicial_onfocus(this, iSeqRow) });
  $('#id_sc_field_fecha_final' + iSeqRow).bind('blur', function() { sc_form_agenda_fecha_final_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_agenda_fecha_final_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_agenda_fecha_final_onfocus(this, iSeqRow) });
  $('#id_sc_field_hora_final' + iSeqRow).bind('blur', function() { sc_form_agenda_hora_final_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_agenda_hora_final_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_agenda_hora_final_onfocus(this, iSeqRow) });
  $('#id_sc_field_estado_actual' + iSeqRow).bind('blur', function() { sc_form_agenda_estado_actual_onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_form_agenda_estado_actual_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_agenda_estado_actual_onfocus(this, iSeqRow) });
  $('#id_sc_field_recurrencia' + iSeqRow).bind('blur', function() { sc_form_agenda_recurrencia_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_agenda_recurrencia_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_agenda_recurrencia_onfocus(this, iSeqRow) });
  $('#id_sc_field_periodo' + iSeqRow).bind('blur', function() { sc_form_agenda_periodo_onblur(this, iSeqRow) })
                                     .bind('change', function() { sc_form_agenda_periodo_onchange(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_agenda_periodo_onfocus(this, iSeqRow) });
  $('#id_sc_field_evaluacion' + iSeqRow).bind('blur', function() { sc_form_agenda_evaluacion_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_agenda_evaluacion_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_agenda_evaluacion_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_agenda_id_agenda_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_id_agenda();
  scCssBlur(oThis);
}

function sc_form_agenda_id_agenda_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_id_agenda_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_agenda_id_tecnico_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_id_tecnico();
  scCssBlur(oThis);
}

function sc_form_agenda_id_tecnico_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_id_tecnico_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_agenda_id_cliente_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_id_cliente();
  scCssBlur(oThis);
}

function sc_form_agenda_id_cliente_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_id_cliente_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_agenda_valor_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_valor();
  scCssBlur(oThis);
}

function sc_form_agenda_valor_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_valor_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_agenda_costes_adicionales_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_costes_adicionales();
  scCssBlur(oThis);
}

function sc_form_agenda_costes_adicionales_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_costes_adicionales_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_agenda_descuento_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_descuento();
  scCssBlur(oThis);
}

function sc_form_agenda_descuento_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_descuento_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_agenda_valor_total_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_valor_total();
  scCssBlur(oThis);
}

function sc_form_agenda_valor_total_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_valor_total_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_agenda_fecha_inicial_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_fecha_inicial();
  scCssBlur(oThis);
}

function sc_form_agenda_fecha_inicial_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_fecha_inicial_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_agenda_hora_inicial_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_hora_inicial();
  scCssBlur(oThis);
}

function sc_form_agenda_hora_inicial_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_hora_inicial_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_agenda_fecha_final_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_fecha_final();
  scCssBlur(oThis);
}

function sc_form_agenda_fecha_final_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_fecha_final_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_agenda_hora_final_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_hora_final();
  scCssBlur(oThis);
}

function sc_form_agenda_hora_final_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_hora_final_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_agenda_estado_actual_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_estado_actual();
  scCssBlur(oThis);
}

function sc_form_agenda_estado_actual_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_estado_actual_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_agenda_recurrencia_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_recurrencia();
  scCssBlur(oThis);
}

function sc_form_agenda_recurrencia_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_recurrencia_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_agenda_periodo_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_periodo();
  scCssBlur(oThis);
}

function sc_form_agenda_periodo_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_periodo_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_agenda_evaluacion_onblur(oThis, iSeqRow) {
  do_ajax_form_agenda_validate_evaluacion();
  scCssBlur(oThis);
}

function sc_form_agenda_evaluacion_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_agenda_evaluacion_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("id_agenda", "", status);
	displayChange_field("id_tecnico", "", status);
	displayChange_field("id_cliente", "", status);
	displayChange_field("valor", "", status);
	displayChange_field("costes_adicionales", "", status);
	displayChange_field("descuento", "", status);
	displayChange_field("valor_total", "", status);
	displayChange_field("fecha_inicial", "", status);
	displayChange_field("hora_inicial", "", status);
	displayChange_field("fecha_final", "", status);
	displayChange_field("hora_final", "", status);
	displayChange_field("estado_actual", "", status);
	displayChange_field("recurrencia", "", status);
	displayChange_field("periodo", "", status);
	displayChange_field("evaluacion", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_id_agenda(row, status);
	displayChange_field_id_tecnico(row, status);
	displayChange_field_id_cliente(row, status);
	displayChange_field_valor(row, status);
	displayChange_field_costes_adicionales(row, status);
	displayChange_field_descuento(row, status);
	displayChange_field_valor_total(row, status);
	displayChange_field_fecha_inicial(row, status);
	displayChange_field_hora_inicial(row, status);
	displayChange_field_fecha_final(row, status);
	displayChange_field_hora_final(row, status);
	displayChange_field_estado_actual(row, status);
	displayChange_field_recurrencia(row, status);
	displayChange_field_periodo(row, status);
	displayChange_field_evaluacion(row, status);
}

function displayChange_field(field, row, status) {
	if ("id_agenda" == field) {
		displayChange_field_id_agenda(row, status);
	}
	if ("id_tecnico" == field) {
		displayChange_field_id_tecnico(row, status);
	}
	if ("id_cliente" == field) {
		displayChange_field_id_cliente(row, status);
	}
	if ("valor" == field) {
		displayChange_field_valor(row, status);
	}
	if ("costes_adicionales" == field) {
		displayChange_field_costes_adicionales(row, status);
	}
	if ("descuento" == field) {
		displayChange_field_descuento(row, status);
	}
	if ("valor_total" == field) {
		displayChange_field_valor_total(row, status);
	}
	if ("fecha_inicial" == field) {
		displayChange_field_fecha_inicial(row, status);
	}
	if ("hora_inicial" == field) {
		displayChange_field_hora_inicial(row, status);
	}
	if ("fecha_final" == field) {
		displayChange_field_fecha_final(row, status);
	}
	if ("hora_final" == field) {
		displayChange_field_hora_final(row, status);
	}
	if ("estado_actual" == field) {
		displayChange_field_estado_actual(row, status);
	}
	if ("recurrencia" == field) {
		displayChange_field_recurrencia(row, status);
	}
	if ("periodo" == field) {
		displayChange_field_periodo(row, status);
	}
	if ("evaluacion" == field) {
		displayChange_field_evaluacion(row, status);
	}
}

function displayChange_field_id_agenda(row, status) {
    var fieldId;
}

function displayChange_field_id_tecnico(row, status) {
    var fieldId;
}

function displayChange_field_id_cliente(row, status) {
    var fieldId;
}

function displayChange_field_valor(row, status) {
    var fieldId;
}

function displayChange_field_costes_adicionales(row, status) {
    var fieldId;
}

function displayChange_field_descuento(row, status) {
    var fieldId;
}

function displayChange_field_valor_total(row, status) {
    var fieldId;
}

function displayChange_field_fecha_inicial(row, status) {
    var fieldId;
}

function displayChange_field_hora_inicial(row, status) {
    var fieldId;
}

function displayChange_field_fecha_final(row, status) {
    var fieldId;
}

function displayChange_field_hora_final(row, status) {
    var fieldId;
}

function displayChange_field_estado_actual(row, status) {
    var fieldId;
}

function displayChange_field_recurrencia(row, status) {
    var fieldId;
}

function displayChange_field_periodo(row, status) {
    var fieldId;
}

function displayChange_field_evaluacion(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_agenda_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(19);
		}
	}
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_fecha_inicial" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_fecha_inicial" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_fecha_inicial" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_agenda_validate_fecha_inicial(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['fecha_inicial']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
<?php
$miniCalendarIcon   = $this->jqueryIconFile('calendar');
$miniCalendarFA     = $this->jqueryFAFile('calendar');
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('' != $miniCalendarIcon) {
?>
    buttonImage: "<?php echo $miniCalendarIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalendarFA) {
?>
    buttonText: "",
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    buttonText: "",
<?php
}
?>
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  })
<?php
if ('' != $miniCalendarFA) {
?>
    .next('button').append("<?php echo $miniCalendarFA; ?>")
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    .next('button').append("<?php echo $miniCalendarButton[0]; ?>")
<?php
}
?>
  $("#id_sc_field_fecha_final" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_fecha_final" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_fecha_final" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_agenda_validate_fecha_final(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['fecha_final']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
<?php
$miniCalendarIcon   = $this->jqueryIconFile('calendar');
$miniCalendarFA     = $this->jqueryFAFile('calendar');
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('' != $miniCalendarIcon) {
?>
    buttonImage: "<?php echo $miniCalendarIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalendarFA) {
?>
    buttonText: "",
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    buttonText: "",
<?php
}
?>
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  })
<?php
if ('' != $miniCalendarFA) {
?>
    .next('button').append("<?php echo $miniCalendarFA; ?>")
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    .next('button').append("<?php echo $miniCalendarButton[0]; ?>")
<?php
}
?>
} // scJQCalendarAdd

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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_agenda')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
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

