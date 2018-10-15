var $form_id_count = 0;
$.fn.hasAttr = function(name) {  
   return (this.attr(name) !== undefined);
};
var patchForm = function($info) {
	// Aux functions
	var applyCSS = function($item, $css_list) {
		//console.log('Looking for: '+$css_list);
		if ($info.hasOwnProperty($css_list)) {
			$css_list = $info[$css_list];
			for (var $c in $css_list) {
				var $p = $c.replace('_','-');
				($item).css($p, $css_list[$c]);
			}
		}
	};
	var setCols = function($item, $default) {
		if ($item.hasAttr('cols')) {
			$item.addClass($item.attr('cols'));
		}
		else if ($default.length>0) {
			$item.addClass($default);
		}
	}
	var addColsFromInfo = function($item, $field) {
		$default = '';
		if ($info.hasOwnProperty($field)) {
			$default = $info[$field];
		}
		setCols($item,$default);
	};
	var isSpecialInput = function($i) {
		return ($i.attr('type')=='checkbox') || ($i.attr('type')=='radio');
	};
	// Patch it
	var $form = $('#'+$info['name']);
	document.charset = 'ISO-8859-1';		// Hack for IE
	$form.attr('accept-charset',"ISO-8859-1");
	var $small = $info.hasOwnProperty('small') && $info.small;

	// Fix all the labels
	$form.find('label').each(function() {
		if (!isSpecialInput($(this).find('input'))) {
			$(this).addClass('control-label');
		}
		$(this).css('white-space','nowrap');
		if ($small) {
			$(this).addClass('input-sm');
		}
		addColsFromInfo($(this),'label_cols');
		// Application-supplied CSS
		applyCSS($(this), 'label_css');
	});

	// Fix all the form inputs
	$form.find('input').each(function() {
		if (!isSpecialInput($(this))){
			$(this).addClass('form-control');
			$(this).css('width', '100%');
			if ($small) {
				$(this).addClass('input-sm');
			}
		}
		var $name = $(this).attr('name');
		if ($info.hasOwnProperty('autocomplete')) {
			if ($info['autocomplete']==0) {
				$(this).attr('autocomplete','new-'+$name);
			}
		}
		// Set 'maxlength' attribute
		if ($info.hasOwnProperty('maxlengths')) {
			if ($info['maxlengths'].hasOwnProperty($name)) {
				$(this).attr('maxlength',$info['maxlengths'][$name]);
			}
		}
		// Application-supplied CSS
		applyCSS($(this),'input_css');
	});

	// Join labels to items
	$form.find('.form-group').each(function() {
		applyCSS($(this),'group_css');
		setCols($(this), 'col-xs-12');

		// Find either a div or an input directly below me
		var $item = $(this).find('input');
		if ($item.length == 1) {
			applyCSS($item,'item_css');
			addColsFromInfo($item,'item_cols');
		}
		var $div = $(this).find('div');
		if ($div.length == 1) {
			$div.addClass('form-control-static');
			applyCSS($item,'item_css');
			addColsFromInfo($item,'item_cols');
		}

		// Combine labels with their inputs
		if (!$(this).hasAttr("nofix")) {
			var $input = $(this).find('input');
			var $label = $(this).find('label');
			var $name = $input.attr('name');
			if ($label.length!=0) {
				if ($input.length==0) {
					$(this).css('margin-bottom','0px');
				}
				else {
					if ($name) {
						$label_id = $name+'-input';
					}
					else {
						$label_id = 'form-item-'+$form_id_count.toString();
					}
					// Link label to item via. 'id' field
					$label.attr('for',$label_id);
					$input.attr('id',$label_id);
				}
			}
			// Add an asterisk to 'required' fields
			if ($input.hasAttr('required')) {
				$label.append('<span class="required-field"/>');
			}
		}

	});
	
	// Make a list of the checkboxes for the form grabber
	var $checkboxes = [];
	$form.find("input[type='checkbox']").each(function() {
		var $name = $(this).attr('name');
		console.log("checkbox="+$name);
		$(this).attr('value',1);
		$checkboxes.push($name); 
	});
	if ($checkboxes.length > 0) {
		$checkboxes = $checkboxes.join();
		console.log("checkboxes="+$checkboxes);
		$form.append('<input type="hidden" name="checkbox_list" value="'+$checkboxes+'" />');
	}
};
