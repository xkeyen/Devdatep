
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
  scEventControl_data["id_customer" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["customer_name" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["customer_gender" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["customer_birthday" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["customer_num_doc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["doctype" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_country" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["customer_address" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["customer_phone1" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["customer_phone2" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["id_customer" + iSeqRow] && scEventControl_data["id_customer" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_customer" + iSeqRow] && scEventControl_data["id_customer" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["customer_name" + iSeqRow] && scEventControl_data["customer_name" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["customer_name" + iSeqRow] && scEventControl_data["customer_name" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["customer_gender" + iSeqRow] && scEventControl_data["customer_gender" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["customer_gender" + iSeqRow] && scEventControl_data["customer_gender" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["customer_birthday" + iSeqRow] && scEventControl_data["customer_birthday" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["customer_birthday" + iSeqRow] && scEventControl_data["customer_birthday" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["customer_num_doc" + iSeqRow] && scEventControl_data["customer_num_doc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["customer_num_doc" + iSeqRow] && scEventControl_data["customer_num_doc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["doctype" + iSeqRow] && scEventControl_data["doctype" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["doctype" + iSeqRow] && scEventControl_data["doctype" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_country" + iSeqRow] && scEventControl_data["id_country" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_country" + iSeqRow] && scEventControl_data["id_country" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["customer_address" + iSeqRow] && scEventControl_data["customer_address" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["customer_address" + iSeqRow] && scEventControl_data["customer_address" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["customer_phone1" + iSeqRow] && scEventControl_data["customer_phone1" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["customer_phone1" + iSeqRow] && scEventControl_data["customer_phone1" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["customer_phone2" + iSeqRow] && scEventControl_data["customer_phone2" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["customer_phone2" + iSeqRow] && scEventControl_data["customer_phone2" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("id_country" + iSeq == fieldName) {
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
  $('#id_sc_field_id_customer' + iSeqRow).bind('blur', function() { sc_form_tb_customers_id_customer_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_tb_customers_id_customer_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_tb_customers_id_customer_onfocus(this, iSeqRow) });
  $('#id_sc_field_customer_num_doc' + iSeqRow).bind('blur', function() { sc_form_tb_customers_customer_num_doc_onblur(this, iSeqRow) })
                                              .bind('change', function() { sc_form_tb_customers_customer_num_doc_onchange(this, iSeqRow) })
                                              .bind('focus', function() { sc_form_tb_customers_customer_num_doc_onfocus(this, iSeqRow) });
  $('#id_sc_field_customer_name' + iSeqRow).bind('blur', function() { sc_form_tb_customers_customer_name_onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_form_tb_customers_customer_name_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_tb_customers_customer_name_onfocus(this, iSeqRow) });
  $('#id_sc_field_customer_birthday' + iSeqRow).bind('blur', function() { sc_form_tb_customers_customer_birthday_onblur(this, iSeqRow) })
                                               .bind('change', function() { sc_form_tb_customers_customer_birthday_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_tb_customers_customer_birthday_onfocus(this, iSeqRow) });
  $('#id_sc_field_customer_gender' + iSeqRow).bind('blur', function() { sc_form_tb_customers_customer_gender_onblur(this, iSeqRow) })
                                             .bind('change', function() { sc_form_tb_customers_customer_gender_onchange(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_tb_customers_customer_gender_onfocus(this, iSeqRow) });
  $('#id_sc_field_customer_phone1' + iSeqRow).bind('blur', function() { sc_form_tb_customers_customer_phone1_onblur(this, iSeqRow) })
                                             .bind('change', function() { sc_form_tb_customers_customer_phone1_onchange(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_tb_customers_customer_phone1_onfocus(this, iSeqRow) });
  $('#id_sc_field_customer_phone2' + iSeqRow).bind('blur', function() { sc_form_tb_customers_customer_phone2_onblur(this, iSeqRow) })
                                             .bind('change', function() { sc_form_tb_customers_customer_phone2_onchange(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_tb_customers_customer_phone2_onfocus(this, iSeqRow) });
  $('#id_sc_field_customer_address' + iSeqRow).bind('blur', function() { sc_form_tb_customers_customer_address_onblur(this, iSeqRow) })
                                              .bind('change', function() { sc_form_tb_customers_customer_address_onchange(this, iSeqRow) })
                                              .bind('focus', function() { sc_form_tb_customers_customer_address_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_country' + iSeqRow).bind('blur', function() { sc_form_tb_customers_id_country_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_tb_customers_id_country_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_tb_customers_id_country_onfocus(this, iSeqRow) });
  $('#id_sc_field_doctype' + iSeqRow).bind('blur', function() { sc_form_tb_customers_doctype_onblur(this, iSeqRow) })
                                     .bind('change', function() { sc_form_tb_customers_doctype_onchange(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_tb_customers_doctype_onfocus(this, iSeqRow) });
  $('.sc-ui-radio-customer_gender' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

function sc_form_tb_customers_id_customer_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_customers_validate_id_customer();
  scCssBlur(oThis);
}

function sc_form_tb_customers_id_customer_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_customers_id_customer_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tb_customers_customer_num_doc_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_customers_validate_customer_num_doc();
  scCssBlur(oThis);
}

function sc_form_tb_customers_customer_num_doc_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_customers_customer_num_doc_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tb_customers_customer_name_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_customers_validate_customer_name();
  scCssBlur(oThis);
}

function sc_form_tb_customers_customer_name_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_customers_customer_name_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tb_customers_customer_birthday_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_customers_validate_customer_birthday();
  scCssBlur(oThis);
}

function sc_form_tb_customers_customer_birthday_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_customers_customer_birthday_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tb_customers_customer_gender_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_customers_validate_customer_gender();
  scCssBlur(oThis);
}

function sc_form_tb_customers_customer_gender_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_customers_customer_gender_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tb_customers_customer_phone1_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_customers_validate_customer_phone1();
  scCssBlur(oThis);
}

function sc_form_tb_customers_customer_phone1_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_customers_customer_phone1_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tb_customers_customer_phone2_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_customers_validate_customer_phone2();
  scCssBlur(oThis);
}

function sc_form_tb_customers_customer_phone2_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_customers_customer_phone2_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tb_customers_customer_address_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_customers_validate_customer_address();
  scCssBlur(oThis);
}

function sc_form_tb_customers_customer_address_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_customers_customer_address_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tb_customers_id_country_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_customers_validate_id_country();
  scCssBlur(oThis);
}

function sc_form_tb_customers_id_country_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_customers_id_country_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tb_customers_doctype_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_customers_validate_doctype();
  scCssBlur(oThis);
}

function sc_form_tb_customers_doctype_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_customers_doctype_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("id_customer", "", status);
	displayChange_field("customer_name", "", status);
	displayChange_field("customer_gender", "", status);
	displayChange_field("customer_birthday", "", status);
	displayChange_field("customer_num_doc", "", status);
	displayChange_field("doctype", "", status);
	displayChange_field("id_country", "", status);
	displayChange_field("customer_address", "", status);
	displayChange_field("customer_phone1", "", status);
	displayChange_field("customer_phone2", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_id_customer(row, status);
	displayChange_field_customer_name(row, status);
	displayChange_field_customer_gender(row, status);
	displayChange_field_customer_birthday(row, status);
	displayChange_field_customer_num_doc(row, status);
	displayChange_field_doctype(row, status);
	displayChange_field_id_country(row, status);
	displayChange_field_customer_address(row, status);
	displayChange_field_customer_phone1(row, status);
	displayChange_field_customer_phone2(row, status);
}

function displayChange_field(field, row, status) {
	if ("id_customer" == field) {
		displayChange_field_id_customer(row, status);
	}
	if ("customer_name" == field) {
		displayChange_field_customer_name(row, status);
	}
	if ("customer_gender" == field) {
		displayChange_field_customer_gender(row, status);
	}
	if ("customer_birthday" == field) {
		displayChange_field_customer_birthday(row, status);
	}
	if ("customer_num_doc" == field) {
		displayChange_field_customer_num_doc(row, status);
	}
	if ("doctype" == field) {
		displayChange_field_doctype(row, status);
	}
	if ("id_country" == field) {
		displayChange_field_id_country(row, status);
	}
	if ("customer_address" == field) {
		displayChange_field_customer_address(row, status);
	}
	if ("customer_phone1" == field) {
		displayChange_field_customer_phone1(row, status);
	}
	if ("customer_phone2" == field) {
		displayChange_field_customer_phone2(row, status);
	}
}

function displayChange_field_id_customer(row, status) {
    var fieldId;
}

function displayChange_field_customer_name(row, status) {
    var fieldId;
}

function displayChange_field_customer_gender(row, status) {
    var fieldId;
}

function displayChange_field_customer_birthday(row, status) {
    var fieldId;
}

function displayChange_field_customer_num_doc(row, status) {
    var fieldId;
}

function displayChange_field_doctype(row, status) {
    var fieldId;
}

function displayChange_field_id_country(row, status) {
    var fieldId;
	if ("on" == status) {
		if ("all" == row) {
			var fieldList = $(".css_id_country__obj");
			for (var i = 0; i < fieldList.length; i++) {
				$($(fieldList[i]).attr("id")).select2("destroy");
			}
		}
		else {
			$("#id_sc_field_id_country" + row).select2("destroy");
		}
		scJQSelect2Add(row, "id_country");
	}
}

function displayChange_field_customer_address(row, status) {
    var fieldId;
}

function displayChange_field_customer_phone1(row, status) {
    var fieldId;
}

function displayChange_field_customer_phone2(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
	displayChange_field_id_country("all", "on");
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_tb_customers_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(25);
		}
	}
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_customer_birthday" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_customer_birthday" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_customer_birthday" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_tb_customers_validate_customer_birthday(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['customer_birthday']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_tb_customers')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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
  if (null == specificField || "id_country" == specificField) {
    scJQSelect2Add_id_country(seqRow);
  }
} // scJQSelect2Add

function scJQSelect2Add_id_country(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_id_country_obj" : "#id_sc_field_id_country" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_id_country_obj',
      dropdownCssClass: 'css_id_country_obj',
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
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
  setTimeout(function () { if ('function' == typeof displayChange_field_id_country) { displayChange_field_id_country(iLine, "on"); } }, 150);
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

