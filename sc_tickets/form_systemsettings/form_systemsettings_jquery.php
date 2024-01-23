
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
  scEventControl_data["companyname" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["assigmentmode" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publicticketsopening" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["defaultpriority" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["urltrackingscreen" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["urlconfirmationscreen" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["broadcastmessages" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["defaultlanguage" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["emailaccount" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["smtpserver" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["smtpuser" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["smtppassword" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["smtpsecurityflag" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["smtpport" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["companyname" + iSeqRow] && scEventControl_data["companyname" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["companyname" + iSeqRow] && scEventControl_data["companyname" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["assigmentmode" + iSeqRow] && scEventControl_data["assigmentmode" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["assigmentmode" + iSeqRow] && scEventControl_data["assigmentmode" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publicticketsopening" + iSeqRow] && scEventControl_data["publicticketsopening" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publicticketsopening" + iSeqRow] && scEventControl_data["publicticketsopening" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["defaultpriority" + iSeqRow] && scEventControl_data["defaultpriority" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["defaultpriority" + iSeqRow] && scEventControl_data["defaultpriority" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["urltrackingscreen" + iSeqRow] && scEventControl_data["urltrackingscreen" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["urltrackingscreen" + iSeqRow] && scEventControl_data["urltrackingscreen" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["urlconfirmationscreen" + iSeqRow] && scEventControl_data["urlconfirmationscreen" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["urlconfirmationscreen" + iSeqRow] && scEventControl_data["urlconfirmationscreen" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["broadcastmessages" + iSeqRow] && scEventControl_data["broadcastmessages" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["broadcastmessages" + iSeqRow] && scEventControl_data["broadcastmessages" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["defaultlanguage" + iSeqRow] && scEventControl_data["defaultlanguage" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["defaultlanguage" + iSeqRow] && scEventControl_data["defaultlanguage" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["emailaccount" + iSeqRow] && scEventControl_data["emailaccount" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["emailaccount" + iSeqRow] && scEventControl_data["emailaccount" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["smtpserver" + iSeqRow] && scEventControl_data["smtpserver" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["smtpserver" + iSeqRow] && scEventControl_data["smtpserver" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["smtpuser" + iSeqRow] && scEventControl_data["smtpuser" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["smtpuser" + iSeqRow] && scEventControl_data["smtpuser" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["smtppassword" + iSeqRow] && scEventControl_data["smtppassword" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["smtppassword" + iSeqRow] && scEventControl_data["smtppassword" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["smtpsecurityflag" + iSeqRow] && scEventControl_data["smtpsecurityflag" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["smtpsecurityflag" + iSeqRow] && scEventControl_data["smtpsecurityflag" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["smtpport" + iSeqRow] && scEventControl_data["smtpport" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["smtpport" + iSeqRow] && scEventControl_data["smtpport" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id" + iSeqRow] && scEventControl_data["id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id" + iSeqRow] && scEventControl_data["id" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("assigmentmode" + iSeq == fieldName) {
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
  $('#id_sc_field_id' + iSeqRow).bind('blur', function() { sc_form_systemsettings_id_onblur(this, iSeqRow) })
                                .bind('change', function() { sc_form_systemsettings_id_onchange(this, iSeqRow) })
                                .bind('focus', function() { sc_form_systemsettings_id_onfocus(this, iSeqRow) });
  $('#id_sc_field_smtpserver' + iSeqRow).bind('blur', function() { sc_form_systemsettings_smtpserver_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_systemsettings_smtpserver_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_systemsettings_smtpserver_onfocus(this, iSeqRow) });
  $('#id_sc_field_smtpuser' + iSeqRow).bind('blur', function() { sc_form_systemsettings_smtpuser_onblur(this, iSeqRow) })
                                      .bind('change', function() { sc_form_systemsettings_smtpuser_onchange(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_systemsettings_smtpuser_onfocus(this, iSeqRow) });
  $('#id_sc_field_smtppassword' + iSeqRow).bind('blur', function() { sc_form_systemsettings_smtppassword_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_systemsettings_smtppassword_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_systemsettings_smtppassword_onfocus(this, iSeqRow) });
  $('#id_sc_field_emailaccount' + iSeqRow).bind('blur', function() { sc_form_systemsettings_emailaccount_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_systemsettings_emailaccount_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_systemsettings_emailaccount_onfocus(this, iSeqRow) });
  $('#id_sc_field_assigmentmode' + iSeqRow).bind('blur', function() { sc_form_systemsettings_assigmentmode_onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_form_systemsettings_assigmentmode_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_systemsettings_assigmentmode_onfocus(this, iSeqRow) });
  $('#id_sc_field_publicticketsopening' + iSeqRow).bind('blur', function() { sc_form_systemsettings_publicticketsopening_onblur(this, iSeqRow) })
                                                  .bind('change', function() { sc_form_systemsettings_publicticketsopening_onchange(this, iSeqRow) })
                                                  .bind('focus', function() { sc_form_systemsettings_publicticketsopening_onfocus(this, iSeqRow) });
  $('#id_sc_field_definedparameters' + iSeqRow).bind('change', function() { sc_form_systemsettings_definedparameters_onchange(this, iSeqRow) });
  $('#id_sc_field_broadcastmessages' + iSeqRow).bind('blur', function() { sc_form_systemsettings_broadcastmessages_onblur(this, iSeqRow) })
                                               .bind('change', function() { sc_form_systemsettings_broadcastmessages_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_systemsettings_broadcastmessages_onfocus(this, iSeqRow) });
  $('#id_sc_field_defaultpriority' + iSeqRow).bind('blur', function() { sc_form_systemsettings_defaultpriority_onblur(this, iSeqRow) })
                                             .bind('change', function() { sc_form_systemsettings_defaultpriority_onchange(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_systemsettings_defaultpriority_onfocus(this, iSeqRow) });
  $('#id_sc_field_smtpsecurityflag' + iSeqRow).bind('blur', function() { sc_form_systemsettings_smtpsecurityflag_onblur(this, iSeqRow) })
                                              .bind('change', function() { sc_form_systemsettings_smtpsecurityflag_onchange(this, iSeqRow) })
                                              .bind('focus', function() { sc_form_systemsettings_smtpsecurityflag_onfocus(this, iSeqRow) });
  $('#id_sc_field_smtpport' + iSeqRow).bind('blur', function() { sc_form_systemsettings_smtpport_onblur(this, iSeqRow) })
                                      .bind('change', function() { sc_form_systemsettings_smtpport_onchange(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_systemsettings_smtpport_onfocus(this, iSeqRow) });
  $('#id_sc_field_urltrackingscreen' + iSeqRow).bind('blur', function() { sc_form_systemsettings_urltrackingscreen_onblur(this, iSeqRow) })
                                               .bind('change', function() { sc_form_systemsettings_urltrackingscreen_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_systemsettings_urltrackingscreen_onfocus(this, iSeqRow) });
  $('#id_sc_field_urlconfirmationscreen' + iSeqRow).bind('blur', function() { sc_form_systemsettings_urlconfirmationscreen_onblur(this, iSeqRow) })
                                                   .bind('change', function() { sc_form_systemsettings_urlconfirmationscreen_onchange(this, iSeqRow) })
                                                   .bind('focus', function() { sc_form_systemsettings_urlconfirmationscreen_onfocus(this, iSeqRow) });
  $('#id_sc_field_defaultlanguage' + iSeqRow).bind('blur', function() { sc_form_systemsettings_defaultlanguage_onblur(this, iSeqRow) })
                                             .bind('change', function() { sc_form_systemsettings_defaultlanguage_onchange(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_systemsettings_defaultlanguage_onfocus(this, iSeqRow) });
  $('#id_sc_field_companyname' + iSeqRow).bind('blur', function() { sc_form_systemsettings_companyname_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_systemsettings_companyname_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_systemsettings_companyname_onfocus(this, iSeqRow) });
  $('#id_sc_field_urlimgok' + iSeqRow).bind('change', function() { sc_form_systemsettings_urlimgok_onchange(this, iSeqRow) });
  $('#id_sc_field_urlimgfail' + iSeqRow).bind('change', function() { sc_form_systemsettings_urlimgfail_onchange(this, iSeqRow) });
  $('#id_sc_field_sys_version' + iSeqRow).bind('change', function() { sc_form_systemsettings_sys_version_onchange(this, iSeqRow) });
  $('.sc-ui-radio-publicticketsopening' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-broadcastmessages' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-checkbox-smtpsecurityflag' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

function sc_form_systemsettings_id_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_id();
  scCssBlur(oThis);
}

function sc_form_systemsettings_id_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_id_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_smtpserver_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_smtpserver();
  scCssBlur(oThis);
}

function sc_form_systemsettings_smtpserver_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_smtpserver_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_smtpuser_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_smtpuser();
  scCssBlur(oThis);
}

function sc_form_systemsettings_smtpuser_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_smtpuser_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_smtppassword_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_smtppassword();
  scCssBlur(oThis);
}

function sc_form_systemsettings_smtppassword_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_smtppassword_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_emailaccount_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_emailaccount();
  scCssBlur(oThis);
}

function sc_form_systemsettings_emailaccount_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_emailaccount_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_assigmentmode_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_assigmentmode();
  scCssBlur(oThis);
}

function sc_form_systemsettings_assigmentmode_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_assigmentmode_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_publicticketsopening_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_publicticketsopening();
  scCssBlur(oThis);
}

function sc_form_systemsettings_publicticketsopening_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_publicticketsopening_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_definedparameters_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_broadcastmessages_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_broadcastmessages();
  scCssBlur(oThis);
}

function sc_form_systemsettings_broadcastmessages_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_broadcastmessages_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_defaultpriority_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_defaultpriority();
  scCssBlur(oThis);
}

function sc_form_systemsettings_defaultpriority_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_defaultpriority_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_smtpsecurityflag_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_smtpsecurityflag();
  scCssBlur(oThis);
}

function sc_form_systemsettings_smtpsecurityflag_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_smtpsecurityflag_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_smtpport_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_smtpport();
  scCssBlur(oThis);
}

function sc_form_systemsettings_smtpport_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_smtpport_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_urltrackingscreen_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_urltrackingscreen();
  scCssBlur(oThis);
}

function sc_form_systemsettings_urltrackingscreen_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_urltrackingscreen_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_urlconfirmationscreen_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_urlconfirmationscreen();
  scCssBlur(oThis);
}

function sc_form_systemsettings_urlconfirmationscreen_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_urlconfirmationscreen_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_defaultlanguage_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_defaultlanguage();
  scCssBlur(oThis);
}

function sc_form_systemsettings_defaultlanguage_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_defaultlanguage_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_companyname_onblur(oThis, iSeqRow) {
  do_ajax_form_systemsettings_validate_companyname();
  scCssBlur(oThis);
}

function sc_form_systemsettings_companyname_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_companyname_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_systemsettings_urlimgok_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_urlimgfail_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_systemsettings_sys_version_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
	if ("1" == block) {
		displayChange_block_1(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("companyname", "", status);
	displayChange_field("assigmentmode", "", status);
	displayChange_field("publicticketsopening", "", status);
	displayChange_field("defaultpriority", "", status);
	displayChange_field("urltrackingscreen", "", status);
	displayChange_field("urlconfirmationscreen", "", status);
	displayChange_field("broadcastmessages", "", status);
	displayChange_field("defaultlanguage", "", status);
}

function displayChange_block_1(status) {
	displayChange_field("emailaccount", "", status);
	displayChange_field("smtpserver", "", status);
	displayChange_field("smtpuser", "", status);
	displayChange_field("smtppassword", "", status);
	displayChange_field("smtpsecurityflag", "", status);
	displayChange_field("smtpport", "", status);
	displayChange_field("id", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_companyname(row, status);
	displayChange_field_assigmentmode(row, status);
	displayChange_field_publicticketsopening(row, status);
	displayChange_field_defaultpriority(row, status);
	displayChange_field_urltrackingscreen(row, status);
	displayChange_field_urlconfirmationscreen(row, status);
	displayChange_field_broadcastmessages(row, status);
	displayChange_field_defaultlanguage(row, status);
	displayChange_field_emailaccount(row, status);
	displayChange_field_smtpserver(row, status);
	displayChange_field_smtpuser(row, status);
	displayChange_field_smtppassword(row, status);
	displayChange_field_smtpsecurityflag(row, status);
	displayChange_field_smtpport(row, status);
	displayChange_field_id(row, status);
}

function displayChange_field(field, row, status) {
	if ("companyname" == field) {
		displayChange_field_companyname(row, status);
	}
	if ("assigmentmode" == field) {
		displayChange_field_assigmentmode(row, status);
	}
	if ("publicticketsopening" == field) {
		displayChange_field_publicticketsopening(row, status);
	}
	if ("defaultpriority" == field) {
		displayChange_field_defaultpriority(row, status);
	}
	if ("urltrackingscreen" == field) {
		displayChange_field_urltrackingscreen(row, status);
	}
	if ("urlconfirmationscreen" == field) {
		displayChange_field_urlconfirmationscreen(row, status);
	}
	if ("broadcastmessages" == field) {
		displayChange_field_broadcastmessages(row, status);
	}
	if ("defaultlanguage" == field) {
		displayChange_field_defaultlanguage(row, status);
	}
	if ("emailaccount" == field) {
		displayChange_field_emailaccount(row, status);
	}
	if ("smtpserver" == field) {
		displayChange_field_smtpserver(row, status);
	}
	if ("smtpuser" == field) {
		displayChange_field_smtpuser(row, status);
	}
	if ("smtppassword" == field) {
		displayChange_field_smtppassword(row, status);
	}
	if ("smtpsecurityflag" == field) {
		displayChange_field_smtpsecurityflag(row, status);
	}
	if ("smtpport" == field) {
		displayChange_field_smtpport(row, status);
	}
	if ("id" == field) {
		displayChange_field_id(row, status);
	}
}

function displayChange_field_companyname(row, status) {
    var fieldId;
}

function displayChange_field_assigmentmode(row, status) {
    var fieldId;
}

function displayChange_field_publicticketsopening(row, status) {
    var fieldId;
}

function displayChange_field_defaultpriority(row, status) {
    var fieldId;
}

function displayChange_field_urltrackingscreen(row, status) {
    var fieldId;
}

function displayChange_field_urlconfirmationscreen(row, status) {
    var fieldId;
}

function displayChange_field_broadcastmessages(row, status) {
    var fieldId;
}

function displayChange_field_defaultlanguage(row, status) {
    var fieldId;
}

function displayChange_field_emailaccount(row, status) {
    var fieldId;
}

function displayChange_field_smtpserver(row, status) {
    var fieldId;
}

function displayChange_field_smtpuser(row, status) {
    var fieldId;
}

function displayChange_field_smtppassword(row, status) {
    var fieldId;
}

function displayChange_field_smtpsecurityflag(row, status) {
    var fieldId;
}

function displayChange_field_smtpport(row, status) {
    var fieldId;
}

function displayChange_field_id(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_systemsettings_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(27);
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_systemsettings')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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

