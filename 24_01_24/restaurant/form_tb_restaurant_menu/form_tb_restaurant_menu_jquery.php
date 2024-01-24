
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

  if ($oField.length > 0) {
    switch ($oField[0].name) {
      case 'active_menu':
      case 'to_kitchen':
      case 'id_category':
      case 'header':
      case 'description':
      case 'price':
        sc_exib_ocult_pag('form_tb_restaurant_menu_form0');
        break;
      case 'image_bin':
        sc_exib_ocult_pag('form_tb_restaurant_menu_form1');
        break;
    }
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
  scEventControl_data["active_menu" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["to_kitchen" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_category" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["header" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["description" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["price" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["image_bin" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["active_menu" + iSeqRow] && scEventControl_data["active_menu" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["active_menu" + iSeqRow] && scEventControl_data["active_menu" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["to_kitchen" + iSeqRow] && scEventControl_data["to_kitchen" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["to_kitchen" + iSeqRow] && scEventControl_data["to_kitchen" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_category" + iSeqRow] && scEventControl_data["id_category" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_category" + iSeqRow] && scEventControl_data["id_category" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["header" + iSeqRow] && scEventControl_data["header" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["header" + iSeqRow] && scEventControl_data["header" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["description" + iSeqRow] && scEventControl_data["description" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["description" + iSeqRow] && scEventControl_data["description" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["price" + iSeqRow] && scEventControl_data["price" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["price" + iSeqRow] && scEventControl_data["price" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("id_category" + iSeq == fieldName) {
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
  $('#id_sc_field_id_menu' + iSeqRow).bind('change', function() { sc_form_tb_restaurant_menu_id_menu_onchange(this, iSeqRow) });
  $('#id_sc_field_header' + iSeqRow).bind('blur', function() { sc_form_tb_restaurant_menu_header_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_form_tb_restaurant_menu_header_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_tb_restaurant_menu_header_onfocus(this, iSeqRow) });
  $('#id_sc_field_description' + iSeqRow).bind('blur', function() { sc_form_tb_restaurant_menu_description_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_tb_restaurant_menu_description_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_tb_restaurant_menu_description_onfocus(this, iSeqRow) });
  $('#id_sc_field_price' + iSeqRow).bind('blur', function() { sc_form_tb_restaurant_menu_price_onblur(this, iSeqRow) })
                                   .bind('change', function() { sc_form_tb_restaurant_menu_price_onchange(this, iSeqRow) })
                                   .bind('focus', function() { sc_form_tb_restaurant_menu_price_onfocus(this, iSeqRow) });
  $('#id_sc_field_image_bin' + iSeqRow).bind('blur', function() { sc_form_tb_restaurant_menu_image_bin_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_tb_restaurant_menu_image_bin_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_tb_restaurant_menu_image_bin_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_category' + iSeqRow).bind('blur', function() { sc_form_tb_restaurant_menu_id_category_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_tb_restaurant_menu_id_category_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_tb_restaurant_menu_id_category_onfocus(this, iSeqRow) });
  $('#id_sc_field_active_menu' + iSeqRow).bind('blur', function() { sc_form_tb_restaurant_menu_active_menu_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_tb_restaurant_menu_active_menu_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_tb_restaurant_menu_active_menu_onfocus(this, iSeqRow) });
  $('#id_sc_field_to_kitchen' + iSeqRow).bind('blur', function() { sc_form_tb_restaurant_menu_to_kitchen_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_tb_restaurant_menu_to_kitchen_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_tb_restaurant_menu_to_kitchen_onfocus(this, iSeqRow) });
  $('.sc-ui-radio-active_menu' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-to_kitchen' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

function sc_form_tb_restaurant_menu_id_menu_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_restaurant_menu_header_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_restaurant_menu_validate_header();
  scCssBlur(oThis);
}

function sc_form_tb_restaurant_menu_header_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_restaurant_menu_header_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tb_restaurant_menu_description_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_restaurant_menu_validate_description();
  scCssBlur(oThis);
}

function sc_form_tb_restaurant_menu_description_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_restaurant_menu_description_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tb_restaurant_menu_price_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_restaurant_menu_validate_price();
  scCssBlur(oThis);
}

function sc_form_tb_restaurant_menu_price_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_restaurant_menu_price_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tb_restaurant_menu_image_bin_onblur(oThis, iSeqRow) {
  scCssBlur(oThis);
}

function sc_form_tb_restaurant_menu_image_bin_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_restaurant_menu_image_bin_onfocus(oThis, iSeqRow) {
  scCssFocus(oThis);
}

function sc_form_tb_restaurant_menu_id_category_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_restaurant_menu_validate_id_category();
  scCssBlur(oThis);
}

function sc_form_tb_restaurant_menu_id_category_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_restaurant_menu_id_category_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tb_restaurant_menu_active_menu_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_restaurant_menu_validate_active_menu();
  scCssBlur(oThis);
}

function sc_form_tb_restaurant_menu_active_menu_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_restaurant_menu_active_menu_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tb_restaurant_menu_to_kitchen_onblur(oThis, iSeqRow) {
  do_ajax_form_tb_restaurant_menu_validate_to_kitchen();
  scCssBlur(oThis);
}

function sc_form_tb_restaurant_menu_to_kitchen_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tb_restaurant_menu_to_kitchen_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_page(page, status) {
	if ("0" == page) {
		displayChange_page_0(status);
	}
	if ("1" == page) {
		displayChange_page_1(status);
	}
}

function displayChange_page_0(status) {
	displayChange_block("0", status);
	displayChange_block("1", status);
}

function displayChange_page_1(status) {
	displayChange_block("2", status);
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
	displayChange_field("active_menu", "", status);
	displayChange_field("to_kitchen", "", status);
}

function displayChange_block_1(status) {
	displayChange_field("id_category", "", status);
	displayChange_field("header", "", status);
	displayChange_field("description", "", status);
	displayChange_field("price", "", status);
}

function displayChange_block_2(status) {
	displayChange_field("image_bin", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_active_menu(row, status);
	displayChange_field_to_kitchen(row, status);
	displayChange_field_id_category(row, status);
	displayChange_field_header(row, status);
	displayChange_field_description(row, status);
	displayChange_field_price(row, status);
	displayChange_field_image_bin(row, status);
}

function displayChange_field(field, row, status) {
	if ("active_menu" == field) {
		displayChange_field_active_menu(row, status);
	}
	if ("to_kitchen" == field) {
		displayChange_field_to_kitchen(row, status);
	}
	if ("id_category" == field) {
		displayChange_field_id_category(row, status);
	}
	if ("header" == field) {
		displayChange_field_header(row, status);
	}
	if ("description" == field) {
		displayChange_field_description(row, status);
	}
	if ("price" == field) {
		displayChange_field_price(row, status);
	}
	if ("image_bin" == field) {
		displayChange_field_image_bin(row, status);
	}
}

function displayChange_field_active_menu(row, status) {
    var fieldId;
}

function displayChange_field_to_kitchen(row, status) {
    var fieldId;
}

function displayChange_field_id_category(row, status) {
    var fieldId;
	if ("on" == status) {
		if ("all" == row) {
			var fieldList = $(".css_id_category__obj");
			for (var i = 0; i < fieldList.length; i++) {
				$($(fieldList[i]).attr("id")).select2("destroy");
			}
		}
		else {
			$("#id_sc_field_id_category" + row).select2("destroy");
		}
		scJQSelect2Add(row, "id_category");
	}
}

function displayChange_field_header(row, status) {
    var fieldId;
}

function displayChange_field_description(row, status) {
    var fieldId;
	if ("on" == status) {
		if ("all" == row) {
			var fieldList = $(".css_description__obj");
			for (var i = 0; i < fieldList.length; i++) {
				fieldId = $(fieldList[i]).attr("id").substr(12);
                scAjaxExecFieldEditorHtml('mceRemoveControl', false, fieldId);
                scAjaxExecFieldEditorHtml('mceAddControl', false, fieldId);
			}
		}
		else {
            scAjaxExecFieldEditorHtml('mceRemoveControl', false, "description");
            scAjaxExecFieldEditorHtml('mceAddControl', false, "description");
		}
	}
}

function displayChange_field_price(row, status) {
    var fieldId;
}

function displayChange_field_image_bin(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
	displayChange_field_id_category("all", "on");
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_tb_restaurant_menu_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(31);
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
if ('novo' != $this->nmgp_opcao && isset($this->nmgp_cmp_readonly['description']) && $this->nmgp_cmp_readonly['description'] == 'on')
{
    unset($this->nmgp_cmp_readonly['description']);
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
  contextmenu: false,
  toolbar: "undo redo | styleselect fontsizeselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
  statusbar : false,
  menubar : false,
  toolbar_items_size: 'small',
  content_style: ".mce-container-body {text-align: center !important}",
  selector: "#description" + iSeqRow,
  toolbar_mode: 'sliding',
  block_unsupported_drop: false,
  paste_data_images : true,
  relative_urls : false,
  remove_script_host : false,
  convert_urls  : true,
  setup: function(ed) {
    ed.on("Change", function (e) {
        scFormHasChanged = true;
    }),
    ed.on("init", function (e) {
      if ($('textarea[name="description' + iSeqRow + '"]').prop('disabled') == true) {
        ed.setMode("readonly");
      }
    });
  }
 };
 var data = 'function' === typeof Object.assign ? Object.assign({}, scJQHtmlEditorData(baseData)) : baseData;
 tinyMCE.init(data);
} // scJQHtmlEditorAdd

function scJQUploadAdd(iSeqRow) {
  $("#id_sc_field_image_bin" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_tb_restaurant_menu_ul_save.php",
    dropZone: $("#hidden_field_data_image_bin" + iSeqRow),
    formData: function() {
      return [
        {name: 'param_field', value: 'image_bin'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_image_bin" + iSeqRow);
        loaderContent = $("#id_img_loader_image_bin" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_image_bin" + iSeqRow);
        loader.show();
      }
    },
    change: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_image_bin(data);
      if ('ok' != checkUploadSize) {
        e.preventDefault();
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
      }
    },
    drop: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_image_bin(data);
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
        $("#id_img_loader_image_bin" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_image_bin" + iSeqRow).hide();
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
      $("#id_sc_field_image_bin" + iSeqRow).val("");
      $("#id_sc_field_image_bin_ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_image_bin_ul_type" + iSeqRow).val(fileData[0].type);
      var_ajax_img_image_bin = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_image_source;
      var_ajax_img_thumb = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_thumb_prot;
      thumbDisplay = ("" == var_ajax_img_image_bin) ? "none" : "";
      $("#id_ajax_img_image_bin" + iSeqRow).attr("src", var_ajax_img_thumb);
      $("#id_ajax_img_image_bin" + iSeqRow).css("display", thumbDisplay);
      if (document.F1.temp_out1_image_bin) {
        document.F1.temp_out_image_bin.value = var_ajax_img_thumb;
        document.F1.temp_out1_image_bin.value = var_ajax_img_image_bin;
      }
      else if (document.F1.temp_out_image_bin) {
        document.F1.temp_out_image_bin.value = var_ajax_img_image_bin;
      }
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_image_bin" + iSeqRow).css("display", checkDisplay);
      $("#txt_ajax_img_image_bin" + iSeqRow).html(fileData[0].name);
      $("#txt_ajax_img_image_bin" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_image_bin" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_tb_restaurant_menu')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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
  if (null == specificField || "id_category" == specificField) {
    scJQSelect2Add_id_category(seqRow);
  }
} // scJQSelect2Add

function scJQSelect2Add_id_category(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_id_category_obj" : "#id_sc_field_id_category" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_id_category_obj',
      dropdownCssClass: 'css_id_category_obj',
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
  scJQHtmlEditorAdd(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
  setTimeout(function () { if ('function' == typeof displayChange_field_id_category) { displayChange_field_id_category(iLine, "on"); } }, 150);
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

function scCheckUploadExtensionSize_image_bin(thisField)
{
    if ("files" in thisField && thisField.files.length > 0) {
        thisFileExtension = scGetFileExtension(thisField.files[0].name);


        if (!["png", "JPEG", "gif", "svg", "jpg"].includes(thisFileExtension)) {
            return 'err_extension||' + thisFileExtension.toUpperCase();
        }
    }

    return 'ok';
}

