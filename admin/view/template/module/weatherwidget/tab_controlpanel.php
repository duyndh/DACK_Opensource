<table class="table">
 <tr>
    <td class="col-xs-2"><h5><span class="required">* </span><?php echo $entry_code; ?></h5><span class="help"><?php echo $entry_code_help; ?></span></td>
    <td class="col-xs-10">
        <div class="col-xs-4">
            <select id="Checker" name="<?php echo $moduleName; ?>[Enabled]" class="form-control">
                  <option value="yes" <?php echo (!empty($moduleData['Enabled']) && $moduleData['Enabled'] == 'yes') ? 'selected=selected' : '' ?>><?php echo $text_enabled; ?></option>
                  <option value="no"  <?php echo (empty($moduleData['Enabled']) || $moduleData['Enabled']== 'no') ? 'selected=selected' : '' ?>><?php echo $text_disabled; ?></option>
            </select>
        </div>
    </td>
    </tr>
</table>

<table id="module" class="table table-bordered table-hover info">
  <thead>
    <tr class="table-header">
      <td class="left"><strong><?php echo $entry_layout_options; ?></strong></td>
      <td class="left"><strong><?php echo $entry_position_options; ?></strong></td>
      <td class="left"><strong><?php echo $entry_action_options; ?></strong></td>
    </tr>
  </thead>
  <?php $module_row = 0; ?>
  <?php foreach ($modules as $module) { ?>
  <tbody id="module-row<?php echo $module_row; ?>">
    <tr>
      <td class="left col-xs-3">
        <div class="form-group modulePositioning">
            <label><?php echo $entry_status; ?></label>
            <select name="<?php echo $moduleData_module; ?>[<?php echo $module_row; ?>][status]" class="form-control">
            <?php if ($module['status']) { ?>
            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
            <option value="0"><?php echo $text_disabled; ?></option>
            <?php } else { ?>
            <option value="1"><?php echo $text_enabled; ?></option>
            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group modulePositioning">
            <label><?php echo $entry_layout; ?></label>
            <select name="<?php echo $moduleData_module; ?>[<?php echo $module_row; ?>][layout_id]" class="form-control">
            <?php foreach ($layouts as $layout) { ?>
            <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
            <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
        <div class="form-group modulePositioning">
            <label><?php echo $entry_sort_order; ?></label>
            <input class="form-control" type="number" name="<?php echo $moduleData_module; ?>[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" />
        </div>
      </td>
      <td class="left">
        <div class="widgetPositionOpenCart">
            <div class="radio">
                <label for="buttonPos<?php echo $module_row; ?>_1">
                    <input <?php if ($module['position'] == 'content_top') echo 'checked="checked"'; ?> type="radio" style="width:auto" name="<?php echo $moduleData_module; ?>[<?php echo $module_row; ?>][position]" id="buttonPos<?php echo $module_row; ?>_1" class="widgetPositionOptionBox" data-checkbox="#buttonPosCheckbox_<?php echo $module_row; ?>" value="content_top" />
                    <?php echo $text_content_top; ?>
                </label>
            </div>
            <div class="positionSampleBox">
                <label for="buttonPos<?php echo $module_row; ?>_1"><img class="img-thumbnail" src="view/image/<?php echo $moduleNameSmall; ?>/content_top.png" title="<?php echo $text_content_top; ?>" border="0" /></label>
            </div>        
        </div>
        <div class="widgetPositionOpenCart">
            <div class="radio">
                <label for="buttonPos<?php echo $module_row; ?>_2">
                    <input <?php if ($module['position'] == 'content_bottom') echo 'checked="checked"'; ?> type="radio" style="width:auto" name="<?php echo $moduleData_module; ?>[<?php echo $module_row; ?>][position]" id="buttonPos<?php echo $module_row; ?>_2" class="widgetPositionOptionBox" data-checkbox="#buttonPosCheckbox_<?php echo $module_row; ?>" value="content_bottom" />
                    <?php echo $text_content_bottom; ?>
                </label>
            </div>
            <div class="positionSampleBox ">
                <label for="buttonPos<?php echo $module_row; ?>_2"><img class="img-thumbnail" src="view/image/<?php echo $moduleNameSmall; ?>/content_bottom.png" title="<?php echo $text_content_bottom; ?>" border="0" /></label>
            </div>
        </div>
        <div class="widgetPositionOpenCart">
            <div class="radio">
                <label for="buttonPos<?php echo $module_row; ?>_3">
                    <input <?php if ($module['position'] == 'column_left') echo 'checked="checked"'; ?> type="radio" style="width:auto" name="<?php echo $moduleData_module; ?>[<?php echo $module_row; ?>][position]" id="buttonPos<?php echo $module_row; ?>_3" class="widgetPositionOptionBox" data-checkbox="#buttonPosCheckbox_<?php echo $module_row; ?>" value="column_left" />
                    <?php echo $text_column_left; ?>
                </label>
            </div>
            <div class="positionSampleBox">
                <label for="buttonPos<?php echo $module_row; ?>_3"><img class="img-thumbnail" src="view/image/<?php echo $moduleNameSmall; ?>/column_left.png" title="<?php echo $text_column_left; ?>" border="0" /></label>
            </div>
        </div>
        <div class="widgetPositionOpenCart last">
            <div class="radio">
                <label for="buttonPos<?php echo $module_row; ?>_4">
                    <input <?php if ($module['position'] == 'column_right') echo 'checked="checked"'; ?> type="radio" style="width:auto" name="<?php echo $moduleData_module; ?>[<?php echo $module_row; ?>][position]" id="buttonPos<?php echo $module_row; ?>_4" class="widgetPositionOptionBox" data-checkbox="#buttonPosCheckbox_<?php echo $module_row; ?>" value="column_right" />
                    <?php echo $text_column_right; ?>
                </label>
            </div>
            <div class="positionSampleBox">
                <label for="buttonPos<?php echo $module_row; ?>_4"><img class="img-thumbnail" src="view/image/<?php echo $moduleNameSmall; ?>/column_right.png" title="<?php echo $text_column_right; ?>" border="0" /></label>
            </div>
        </div>
      </td>
      <td class="left" style="vertical-align:bottom;"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;<?php echo $button_remove; ?></a></td>
    </tr>
  </tbody>
  <?php $module_row++; ?>
  <?php } ?>
  <tfoot>
    <tr>
      <td colspan="2"></td>
      <td class="left"><a onclick="addModule();" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;<?php echo $button_add_module; ?></a></td>
    </tr>
  </tfoot>
</table>
    
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {
  	html  = '<tbody style="display:none;" id="module-row' + module_row + '">';
  	html += '  <tr>';
  	html += '    <td class="left col-xs-3">';
  	
  	html += '<div class="form-group modulePositioning">';
  	html += ' <label><?php echo $entry_status; ?></label>';
  	html += '    <select name="<?php echo $moduleData_module; ?>[' + module_row + '][status]" class="form-control">';
	html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
	html += '      <option value="0"><?php echo $text_disabled; ?></option>';
	html += '    </select></div> ';
	
	html += '<div class="form-group modulePositioning">';
	html += '	<label><?php echo $entry_layout; ?></label>'
  	html += '  <select name="<?php echo $moduleData_module; ?>[' + module_row + '][layout_id]" class="form-control">';
  	<?php foreach ($layouts as $layout) { ?>
  	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo addslashes($layout['name']); ?></option>';
  	<?php } ?>
	html += '    </select></div>';
	
  	html += '<div class="form-group modulePositioning"><label><?php echo $entry_sort_order; ?></label><input class="form-control" type="number" name="<?php echo $moduleData_module; ?>['+ module_row + '][sort_order]" value="0" /></div>';
  	html += '    </td>';
  	html += '    <td class="left">';
 	html += '<div class="widgetPositionOpenCart"><div class="radio"><label for="buttonPos' + module_row + '_1"><input checked="checked" type="radio" style="width:auto" name="<?php echo $moduleData_module; ?>[' + module_row + '][position]" id="buttonPos' + module_row + '_1" class="widgetPositionOptionBox" data-checkbox="#buttonPosCheckbox_' + module_row + '" value="content_top" /><?php echo $text_content_top; ?></label></div><div class="positionSampleBox"><label for="buttonPos' + module_row + '_1"><img class="img-thumbnail" src="view/image/<?php echo $moduleNameSmall; ?>/content_top.png" title="<?php echo $text_content_top; ?>" border="0" /></label></div></div>';
  	html += '<div class="widgetPositionOpenCart"><div class="radio"><label for="buttonPos' + module_row + '_2"><input type="radio" style="width:auto" name="<?php echo $moduleData_module; ?>[' + module_row + '][position]" id="buttonPos' + module_row + '_2" class="widgetPositionOptionBox" data-checkbox="#buttonPosCheckbox_' + module_row + '" value="content_bottom" /><?php echo $text_content_bottom; ?></label></div><div class="positionSampleBox"><label for="buttonPos' + module_row + '_2"><img class="img-thumbnail" src="view/image/<?php echo $moduleNameSmall; ?>/content_bottom.png" title="<?php echo $text_content_bottom; ?>" border="0" /></label></div></div>';
  	html += '<div class="widgetPositionOpenCart"><div class="radio"><label for="buttonPos' + module_row + '_3"><input type="radio" style="width:auto" name="<?php echo $moduleData_module; ?>[' + module_row + '][position]" id="buttonPos' + module_row + '_3" class="widgetPositionOptionBox" data-checkbox="#buttonPosCheckbox_' + module_row + '" value="column_left" /><?php echo $text_column_left; ?></label></div><div class="positionSampleBox"><label for="buttonPos' + module_row + '_3"><img class="img-thumbnail" src="view/image/<?php echo $moduleNameSmall; ?>/column_left.png" title="<?php echo $text_column_left; ?>" border="0" /></label></div></div>';
  	html += '<div class="widgetPositionOpenCart last"><div class="radio"><label for="buttonPos' + module_row + '_4"><input type="radio" style="width:auto" name="<?php echo $moduleData_module; ?>[' + module_row + '][position]" id="buttonPos' + module_row + '_4" class="widgetPositionOptionBox" data-checkbox="#buttonPosCheckbox_' + module_row + '" value="column_right" /><?php echo $text_column_right; ?></label></div><div class="positionSampleBox"><label for="buttonPos' + module_row + '_4"><img class="img-thumbnail" src="view/image/<?php echo $moduleNameSmall; ?>/column_right.png" title="<?php echo $text_column_right; ?>" border="0" /></label></div></div>';
  	
  	html += '    </td>';
  	html += '    <td class="left" style="vertical-align:bottom;"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;<?php echo $button_remove; ?></a></td>';
  	html += '  </tr>';
 	html += '</tbody>';
  
  $('#module tfoot').before(html);
  $('#module-row' + module_row).fadeIn();
  
  module_row++;
}
//--></script>
<script>
 $(function() {
    var $typeSelector = $('#Checker');
    var $toggleArea = $('#module');
	var $toggleArea2 = $('#mainSettingsTab');
	 if ($typeSelector.val() === 'yes') {
            $toggleArea.show(); 
			$toggleArea2.show();
        }
        else {
            $toggleArea.hide(); 
			$toggleArea2.hide();
        }
    $typeSelector.change(function(){
        if ($typeSelector.val() === 'yes') {
            $toggleArea.show(300); 
			$toggleArea2.show(300);
        }
        else {
            $toggleArea.hide(300); 
			$toggleArea2.hide(300);
        }
    });
});
</script>