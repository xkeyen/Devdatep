
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
  scEventControl_data["ticketpriorityid" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["categoryid" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["templateid" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["ticketcontent" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["closeticket" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["transferticket" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["ticketfile1" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["ticketfile2" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["ticketfile3" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["messagenote" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["ticketpriorityid" + iSeqRow] && scEventControl_data["ticketpriorityid" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ticketpriorityid" + iSeqRow] && scEventControl_data["ticketpriorityid" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["categoryid" + iSeqRow] && scEventControl_data["categoryid" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["categoryid" + iSeqRow] && scEventControl_data["categoryid" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["templateid" + iSeqRow] && scEventControl_data["templateid" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["templateid" + iSeqRow] && scEventControl_data["templateid" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ticketcontent" + iSeqRow] && scEventControl_data["ticketcontent" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ticketcontent" + iSeqRow] && scEventControl_data["ticketcontent" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["closeticket" + iSeqRow] && scEventControl_data["closeticket" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["closeticket" + iSeqRow] && scEventControl_data["closeticket" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["transferticket" + iSeqRow] && scEventControl_data["transferticket" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["transferticket" + iSeqRow] && scEventControl_data["transferticket" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["messagenote" + iSeqRow] && scEventControl_data["messagenote" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["messagenote" + iSeqRow] && scEventControl_data["messagenote" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("ticketpriorityid" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("categoryid" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("templateid" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("transferticket" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("templateid" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("transferticket" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
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
  $('#id_sc_field_ticketcontent' + iSeqRow).bind('blur', function() { sc_form_operator_response_ticketcontent_onblur(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_operator_response_ticketcontent_onfocus(this, iSeqRow) });
  $('#id_sc_field_ticketfile1' + iSeqRow).bind('blur', function() { sc_form_operator_response_ticketfile1_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_operator_response_ticketfile1_onfocus(this, iSeqRow) });
  $('#id_sc_field_ticketfile2' + iSeqRow).bind('blur', function() { sc_form_operator_response_ticketfile2_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_operator_response_ticketfile2_onfocus(this, iSeqRow) });
  $('#id_sc_field_ticketfile3' + iSeqRow).bind('blur', function() { sc_form_operator_response_ticketfile3_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_operator_response_ticketfile3_onfocus(this, iSeqRow) });
  $('#id_sc_field_messagenote' + iSeqRow).bind('blur', function() { sc_form_operator_response_messagenote_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_operator_response_messagenote_onfocus(this, iSeqRow) });
  $('#id_sc_field_closeticket' + iSeqRow).bind('blur', function() { sc_form_operator_response_closeticket_onblur(this, iSeqRow) })
                                         .bind('click', function() { sc_form_operator_response_closeticket_onclick(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_operator_response_closeticket_onfocus(this, iSeqRow) });
  $('#id_sc_field_transferticket' + iSeqRow).bind('blur', function() { sc_form_operator_response_transferticket_onblur(this, iSeqRow) })
                                            .bind('change', function() { sc_form_operator_response_transferticket_onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_operator_response_transferticket_onfocus(this, iSeqRow) });
  $('#id_sc_field_categoryid' + iSeqRow).bind('blur', function() { sc_form_operator_response_categoryid_onblur(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_operator_response_categoryid_onfocus(this, iSeqRow) });
  $('#id_sc_field_ticketpriorityid' + iSeqRow).bind('blur', function() { sc_form_operator_response_ticketpriorityid_onblur(this, iSeqRow) })
                                              .bind('focus', function() { sc_form_operator_response_ticketpriorityid_onfocus(this, iSeqRow) });
  $('#id_sc_field_templateid' + iSeqRow).bind('blur', function() { sc_form_operator_response_templateid_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_operator_response_templateid_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_operator_response_templateid_onfocus(this, iSeqRow) });
  $('.sc-ui-checkbox-closeticket' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

function sc_form_operator_response_ticketcontent_onblur(oThis, iSeqRow) {
  do_ajax_form_operator_response_mob_validate_ticketcontent();
  scCssBlur(oThis);
}

function sc_form_operator_response_ticketcontent_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_operator_response_ticketfile1_onblur(oThis, iSeqRow) {
  scCssBlur(oThis);
}

function sc_form_operator_response_ticketfile1_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_operator_response_ticketfile2_onblur(oThis, iSeqRow) {
  scCssBlur(oThis);
}

function sc_form_operator_response_ticketfile2_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_operator_response_ticketfile3_onblur(oThis, iSeqRow) {
  scCssBlur(oThis);
}

function sc_form_operator_response_ticketfile3_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_operator_response_messagenote_onblur(oThis, iSeqRow) {
  do_ajax_form_operator_response_mob_validate_messagenote();
  scCssBlur(oThis);
}

function sc_form_operator_response_messagenote_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_operator_response_closeticket_onblur(oThis, iSeqRow) {
  do_ajax_form_operator_response_mob_validate_closeticket();
  scCssBlur(oThis);
}

function sc_form_operator_response_closeticket_onclick(oThis, iSeqRow) {
  do_ajax_form_operator_response_mob_event_closeticket_onclick();
}

function sc_form_operator_response_closeticket_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_operator_response_transferticket_onblur(oThis, iSeqRow) {
  do_ajax_form_operator_response_mob_validate_transferticket();
  scCssBlur(oThis);
}

function sc_form_operator_response_transferticket_onchange(oThis, iSeqRow) {
  do_ajax_form_operator_response_mob_event_transferticket_onchange();
}

function sc_form_operator_response_transferticket_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_operator_response_categoryid_onblur(oThis, iSeqRow) {
  do_ajax_form_operator_response_mob_validate_categoryid();
  scCssBlur(oThis);
}

function sc_form_operator_response_categoryid_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_operator_response_ticketpriorityid_onblur(oThis, iSeqRow) {
  do_ajax_form_operator_response_mob_validate_ticketpriorityid();
  scCssBlur(oThis);
}

function sc_form_operator_response_ticketpriorityid_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_operator_response_templateid_onblur(oThis, iSeqRow) {
  do_ajax_form_operator_response_mob_validate_templateid();
  scCssBlur(oThis);
}

function sc_form_operator_response_templateid_onchange(oThis, iSeqRow) {
  do_ajax_form_operator_response_mob_event_templateid_onchange();
}

function sc_form_operator_response_templateid_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
	if ("1" == block) {
		displayChange_block_1(status);
	}
	if ("2" == block) {
		displayChange_block_2(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("ticketpriorityid", "", status);
	displayChange_field("categoryid", "", status);
	displayChange_field("templateid", "", status);
	displayChange_field("ticketcontent", "", status);
	displayChange_field("closeticket", "", status);
	displayChange_field("transferticket", "", status);
}

function displayChange_block_1(status) {
	displayChange_field("ticketfile1", "", status);
	displayChange_field("ticketfile2", "", status);
	displayChange_field("ticketfile3", "", status);
}

function displayChange_block_2(status) {
	displayChange_field("messagenote", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_ticketpriorityid(row, status);
	displayChange_field_categoryid(row, status);
	displayChange_field_templateid(row, status);
	displayChange_field_ticketcontent(row, status);
	displayChange_field_closeticket(row, status);
	displayChange_field_transferticket(row, status);
	displayChange_field_ticketfile1(row, status);
	displayChange_field_ticketfile2(row, status);
	displayChange_field_ticketfile3(row, status);
	displayChange_field_messagenote(row, status);
}

function displayChange_field(field, row, status) {
	if ("ticketpriorityid" == field) {
		displayChange_field_ticketpriorityid(row, status);
	}
	if ("categoryid" == field) {
		displayChange_field_categoryid(row, status);
	}
	if ("templateid" == field) {
		displayChange_field_templateid(row, status);
	}
	if ("ticketcontent" == field) {
		displayChange_field_ticketcontent(row, status);
	}
	if ("closeticket" == field) {
		displayChange_field_closeticket(row, status);
	}
	if ("transferticket" == field) {
		displayChange_field_transferticket(row, status);
	}
	if ("ticketfile1" == field) {
		displayChange_field_ticketfile1(row, status);
	}
	if ("ticketfile2" == field) {
		displayChange_field_ticketfile2(row, status);
	}
	if ("ticketfile3" == field) {
		displayChange_field_ticketfile3(row, status);
	}
	if ("messagenote" == field) {
		displayChange_field_messagenote(row, status);
	}
}

function displayChange_field_ticketpriorityid(row, status) {
    var fieldId;
}

function displayChange_field_categoryid(row, status) {
    var fieldId;
}

function displayChange_field_templateid(row, status) {
    var fieldId;
}

function displayChange_field_ticketcontent(row, status) {
    var fieldId;
	if ("on" == status) {
		if ("all" == row) {
			var fieldList = $(".css_ticketcontent__obj");
			for (var i = 0; i < fieldList.length; i++) {
				fieldId = $(fieldList[i]).attr("id").substr(12);
                scAjaxExecFieldEditorHtml('mceRemoveControl', false, fieldId);
                scAjaxExecFieldEditorHtml('mceAddControl', false, fieldId);
			}
		}
		else {
            scAjaxExecFieldEditorHtml('mceRemoveControl', false, "ticketcontent");
            scAjaxExecFieldEditorHtml('mceAddControl', false, "ticketcontent");
		}
	}
}

function displayChange_field_closeticket(row, status) {
    var fieldId;
}

function displayChange_field_transferticket(row, status) {
    var fieldId;
}

function displayChange_field_ticketfile1(row, status) {
    var fieldId;
}

function displayChange_field_ticketfile2(row, status) {
    var fieldId;
}

function displayChange_field_ticketfile3(row, status) {
    var fieldId;
}

function displayChange_field_messagenote(row, status) {
    var fieldId;
	if ("on" == status) {
		if ("all" == row) {
			var fieldList = $(".css_messagenote__obj");
			for (var i = 0; i < fieldList.length; i++) {
				fieldId = $(fieldList[i]).attr("id").substr(12);
                scAjaxExecFieldEditorHtml('mceRemoveControl', false, fieldId);
                scAjaxExecFieldEditorHtml('mceAddControl', false, fieldId);
			}
		}
		else {
            scAjaxExecFieldEditorHtml('mceRemoveControl', false, "messagenote");
            scAjaxExecFieldEditorHtml('mceAddControl', false, "messagenote");
		}
	}
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_operator_response_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(34);
		}
	}
}
                var scJQHtmlEditorData = (function() {
                    var data = {};
                    function scJQHtmlEditorData(a, b) {
                        if (a) {
                            if (typeof(a) === typeof({})) {
                                for (var d in a) {
                                    if (a.hasOwnProperty(d)) {
                                        data[d] = a[d];
                                    }
                                }
                            } else if ((typeof(a) === typeof('')) || (typeof(a) === typeof(1))) {
                                if (b) {
                                    data[a] = b;
                                } else {
                                    if (typeof(a) === typeof('')) {
                                        var v = data;
                                        a = a.split('.');
                                        a.forEach(function (r) {
                                            v = v[r];
                                        });
                                        return v;
                                    }
                                    return data[a];
                                }
                            }
                        }
                        return data;
                    }
                    return scJQHtmlEditorData;
                }());
 function scJQHtmlEditorAdd(iSeqRow) {
<?php
$sLangTest = '';
if(is_file('../_lib/lang/arr_langs_tinymce.php'))
{
    include('../_lib/lang/arr_langs_tinymce.php');
    if(isset($Nm_arr_lang_tinymce[ $this->Ini->str_lang ]))
    {
        $sLangTest = $Nm_arr_lang_tinymce[ $this->Ini->str_lang ];
    }
}
if(empty($sLangTest))
{
    $sLangTest = 'en_GB';
}
?>
 var baseData = {
  theme: "silver",
  browser_spellcheck : true,
  paste_data_images : true,
<?php
if ('novo' != $this->nmgp_opcao && isset($this->nmgp_cmp_readonly['ticketcontent']) && $this->nmgp_cmp_readonly['ticketcontent'] == 'on')
{
    unset($this->nmgp_cmp_readonly['ticketcontent']);
?>
   readonly: true,
<?php
}
else 
{
?>
   readonly: false,
<?php
}
?>
<?php
if ('yyyymmdd' == $_SESSION['scriptcase']['reg_conf']['date_format']) {
    $tinymceDateFormat = "%Y{$_SESSION['scriptcase']['reg_conf']['date_sep']}%m{$_SESSION['scriptcase']['reg_conf']['date_sep']}%d";
}
elseif ('mmddyyyy' == $_SESSION['scriptcase']['reg_conf']['date_format']) {
    $tinymceDateFormat = "%m{$_SESSION['scriptcase']['reg_conf']['date_sep']}%d{$_SESSION['scriptcase']['reg_conf']['date_sep']}%Y";
}
elseif ('ddmmyyyy' == $_SESSION['scriptcase']['reg_conf']['date_format']) {
    $tinymceDateFormat = "%d{$_SESSION['scriptcase']['reg_conf']['date_sep']}%m{$_SESSION['scriptcase']['reg_conf']['date_sep']}%Y";
}
else {
    $tinymceDateFormat = "%D";
}
?>
  insertdatetime_formats: ["%H:%M:%S", "%Y-%m-%d", "%I:%M:%S %p", "<?php echo $tinymceDateFormat ?>"],
  relative_urls : false,
  remove_script_host : false,
  convert_urls  : true,
  language : '<?php echo $sLangTest; ?>',
  plugins : 'advlist print hr  autolink link image lists charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table directionality emoticons template',
  contextmenu: 'link linkchecker image imagetools table spellchecker configurepermanentpen',
  toolbar: "undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
  statusbar : false,
  menubar : 'file edit insert view format table tools',
  toolbar_items_size: 'small',
  content_style: ".mce-container-body {text-align: center !important}",
  selector: "#ticketcontent" + iSeqRow,
  toolbar_mode: 'sliding',
  block_unsupported_drop: false,
  paste_data_images : true,
  relative_urls : false,
  remove_script_host : false,
  convert_urls  : true,
  setup: function(ed) {
    ed.on("init", function (e) {
      if ($('textarea[name="ticketcontent' + iSeqRow + '"]').prop('disabled') == true) {
        ed.setMode("readonly");
      }
    });
  }
 };
 var data = 'function' === typeof Object.assign ? Object.assign({}, scJQHtmlEditorData(baseData)) : baseData;
 tinyMCE.init(data);
 var baseData = {
  theme: "silver",
  browser_spellcheck : true,
  paste_data_images : true,
<?php
if ('novo' != $this->nmgp_opcao && isset($this->nmgp_cmp_readonly['messagenote']) && $this->nmgp_cmp_readonly['messagenote'] == 'on')
{
    unset($this->nmgp_cmp_readonly['messagenote']);
?>
   readonly: true,
<?php
}
else 
{
?>
   readonly: false,
<?php
}
?>
<?php
if ('yyyymmdd' == $_SESSION['scriptcase']['reg_conf']['date_format']) {
    $tinymceDateFormat = "%Y{$_SESSION['scriptcase']['reg_conf']['date_sep']}%m{$_SESSION['scriptcase']['reg_conf']['date_sep']}%d";
}
elseif ('mmddyyyy' == $_SESSION['scriptcase']['reg_conf']['date_format']) {
    $tinymceDateFormat = "%m{$_SESSION['scriptcase']['reg_conf']['date_sep']}%d{$_SESSION['scriptcase']['reg_conf']['date_sep']}%Y";
}
elseif ('ddmmyyyy' == $_SESSION['scriptcase']['reg_conf']['date_format']) {
    $tinymceDateFormat = "%d{$_SESSION['scriptcase']['reg_conf']['date_sep']}%m{$_SESSION['scriptcase']['reg_conf']['date_sep']}%Y";
}
else {
    $tinymceDateFormat = "%D";
}
?>
  insertdatetime_formats: ["%H:%M:%S", "%Y-%m-%d", "%I:%M:%S %p", "<?php echo $tinymceDateFormat ?>"],
  relative_urls : false,
  remove_script_host : false,
  convert_urls  : true,
  language : '<?php echo $sLangTest; ?>',
  plugins : 'advlist print hr  autolink link image lists charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table directionality emoticons template',
  contextmenu: 'link linkchecker image imagetools table spellchecker configurepermanentpen',
  toolbar: "undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
  statusbar : false,
  menubar : 'file edit insert view format table tools',
  toolbar_items_size: 'small',
  content_style: ".mce-container-body {text-align: center !important}",
  selector: "#messagenote" + iSeqRow,
  toolbar_mode: 'sliding',
  block_unsupported_drop: false,
  paste_data_images : true,
  relative_urls : false,
  remove_script_host : false,
  convert_urls  : true,
  setup: function(ed) {
    ed.on("init", function (e) {
      if ($('textarea[name="messagenote' + iSeqRow + '"]').prop('disabled') == true) {
        ed.setMode("readonly");
      }
    });
  }
 };
 var data = 'function' === typeof Object.assign ? Object.assign({}, scJQHtmlEditorData(baseData)) : baseData;
 tinyMCE.init(data);
} // scJQHtmlEditorAdd

function scJQUploadAdd(iSeqRow) {
  $("#id_sc_field_ticketfile1" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_operator_response_mob_ul_save.php",
    dropZone: "",
    formData: function() {
      return [
        {name: 'param_field', value: 'ticketfile1'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_ticketfile1" + iSeqRow);
        loaderContent = $("#id_img_loader_ticketfile1" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_ticketfile1" + iSeqRow);
        loader.show();
      }
    },
    change: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_ticketfile1(data);
      if ('ok' != checkUploadSize) {
        e.preventDefault();
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
      }
    },
    drop: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_ticketfile1(data);
      if ('ok' != checkUploadSize) {
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
      }
    },
    done: function(e, data) {
      var fileData, respData, respPos, respMsg, thumbDisplay, checkDisplay, var_ajax_img_thumb, oTemp;
      fileData = null;
      respMsg = "";
      if (data && data.result && data.result[0] && data.result[0].body) {
        respData = data.result[0].body.innerText;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = $.parseJSON(respData);
        }
        else {
          respMsg = respData;
        }
      }
      else {
        respData = data.result;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = eval(respData);
        }
        else {
          respMsg = respData;
        }
      }
      if (window.FormData !== undefined)
      {
        $("#id_img_loader_ticketfile1" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_ticketfile1" + iSeqRow).hide();
      }
      if (null == fileData) {
        if ("" != respMsg) {
          oTemp = {"htmOutput" : "<?php echo $this->Ini->Nm_lang['lang_errm_upld_admn']; ?>"};
          scAjaxShowDebug(oTemp);
        }
        return;
      }
      if (fileData[0].error && "" != fileData[0].error) {
        var uploadErrorMessage = "";
        oResp = {};
        if ("acceptFileTypes" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_invl']) ?>";
        }
        else if ("maxFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("minFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("emptyFile" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_empty']) ?>";
        }
        scAjaxShowErrorDisplay("table", uploadErrorMessage);
        return;
      }
      $("#id_sc_field_ticketfile1" + iSeqRow).val("");
      $("#id_sc_field_ticketfile1_ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_ticketfile1_ul_type" + iSeqRow).val(fileData[0].type);
      $("#id_ajax_doc_ticketfile1" + iSeqRow).html(fileData[0].name);
      $("#id_ajax_doc_ticketfile1" + iSeqRow).css("display", "");
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_ticketfile1" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_ticketfile1" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
    }
  });

  $("#id_sc_field_ticketfile2" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_operator_response_mob_ul_save.php",
    dropZone: "",
    formData: function() {
      return [
        {name: 'param_field', value: 'ticketfile2'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_ticketfile2" + iSeqRow);
        loaderContent = $("#id_img_loader_ticketfile2" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_ticketfile2" + iSeqRow);
        loader.show();
      }
    },
    change: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_ticketfile2(data);
      if ('ok' != checkUploadSize) {
        e.preventDefault();
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
      }
    },
    drop: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_ticketfile2(data);
      if ('ok' != checkUploadSize) {
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
      }
    },
    done: function(e, data) {
      var fileData, respData, respPos, respMsg, thumbDisplay, checkDisplay, var_ajax_img_thumb, oTemp;
      fileData = null;
      respMsg = "";
      if (data && data.result && data.result[0] && data.result[0].body) {
        respData = data.result[0].body.innerText;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = $.parseJSON(respData);
        }
        else {
          respMsg = respData;
        }
      }
      else {
        respData = data.result;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = eval(respData);
        }
        else {
          respMsg = respData;
        }
      }
      if (window.FormData !== undefined)
      {
        $("#id_img_loader_ticketfile2" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_ticketfile2" + iSeqRow).hide();
      }
      if (null == fileData) {
        if ("" != respMsg) {
          oTemp = {"htmOutput" : "<?php echo $this->Ini->Nm_lang['lang_errm_upld_admn']; ?>"};
          scAjaxShowDebug(oTemp);
        }
        return;
      }
      if (fileData[0].error && "" != fileData[0].error) {
        var uploadErrorMessage = "";
        oResp = {};
        if ("acceptFileTypes" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_invl']) ?>";
        }
        else if ("maxFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("minFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("emptyFile" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_empty']) ?>";
        }
        scAjaxShowErrorDisplay("table", uploadErrorMessage);
        return;
      }
      $("#id_sc_field_ticketfile2" + iSeqRow).val("");
      $("#id_sc_field_ticketfile2_ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_ticketfile2_ul_type" + iSeqRow).val(fileData[0].type);
      $("#id_ajax_doc_ticketfile2" + iSeqRow).html(fileData[0].name);
      $("#id_ajax_doc_ticketfile2" + iSeqRow).css("display", "");
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_ticketfile2" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_ticketfile2" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
    }
  });

  $("#id_sc_field_ticketfile3" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_operator_response_mob_ul_save.php",
    dropZone: "",
    formData: function() {
      return [
        {name: 'param_field', value: 'ticketfile3'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_ticketfile3" + iSeqRow);
        loaderContent = $("#id_img_loader_ticketfile3" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_ticketfile3" + iSeqRow);
        loader.show();
      }
    },
    change: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_ticketfile3(data);
      if ('ok' != checkUploadSize) {
        e.preventDefault();
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
      }
    },
    drop: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_ticketfile3(data);
      if ('ok' != checkUploadSize) {
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
      }
    },
    done: function(e, data) {
      var fileData, respData, respPos, respMsg, thumbDisplay, checkDisplay, var_ajax_img_thumb, oTemp;
      fileData = null;
      respMsg = "";
      if (data && data.result && data.result[0] && data.result[0].body) {
        respData = data.result[0].body.innerText;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = $.parseJSON(respData);
        }
        else {
          respMsg = respData;
        }
      }
      else {
        respData = data.result;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = eval(respData);
        }
        else {
          respMsg = respData;
        }
      }
      if (window.FormData !== undefined)
      {
        $("#id_img_loader_ticketfile3" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_ticketfile3" + iSeqRow).hide();
      }
      if (null == fileData) {
        if ("" != respMsg) {
          oTemp = {"htmOutput" : "<?php echo $this->Ini->Nm_lang['lang_errm_upld_admn']; ?>"};
          scAjaxShowDebug(oTemp);
        }
        return;
      }
      if (fileData[0].error && "" != fileData[0].error) {
        var uploadErrorMessage = "";
        oResp = {};
        if ("acceptFileTypes" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_invl']) ?>";
        }
        else if ("maxFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("minFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("emptyFile" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_empty']) ?>";
        }
        scAjaxShowErrorDisplay("table", uploadErrorMessage);
        return;
      }
      $("#id_sc_field_ticketfile3" + iSeqRow).val("");
      $("#id_sc_field_ticketfile3_ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_ticketfile3_ul_type" + iSeqRow).val(fileData[0].type);
      $("#id_ajax_doc_ticketfile3" + iSeqRow).html(fileData[0].name);
      $("#id_ajax_doc_ticketfile3" + iSeqRow).css("display", "");
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_ticketfile3" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_ticketfile3" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
    }
  });

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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_operator_response_mob')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQHtmlEditorAdd(iLine);
  scJQUploadAdd(iLine);
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

function scCheckUploadExtensionSize_ticketfile1(thisField)
{
    if ("files" in thisField && thisField.files.length > 0) {
        thisFileExtension = scGetFileExtension(thisField.files[0].name);


        if (!["docx", "xlsx", "pptx", "pdf", "txt"].includes(thisFileExtension)) {
            return 'err_extension||' + thisFileExtension.toUpperCase();
        }
    }

    return 'ok';
}

function scCheckUploadExtensionSize_ticketfile2(thisField)
{
    if ("files" in thisField && thisField.files.length > 0) {
        thisFileExtension = scGetFileExtension(thisField.files[0].name);


        if (!["docx", "xlsx", "pptx", "pdf", "txt"].includes(thisFileExtension)) {
            return 'err_extension||' + thisFileExtension.toUpperCase();
        }
    }

    return 'ok';
}

function scCheckUploadExtensionSize_ticketfile3(thisField)
{
    if ("files" in thisField && thisField.files.length > 0) {
        thisFileExtension = scGetFileExtension(thisField.files[0].name);


        if (!["docx", "xlsx", "pptx", "pdf", "txt"].includes(thisFileExtension)) {
            return 'err_extension||' + thisFileExtension.toUpperCase();
        }
    }

    return 'ok';
}

