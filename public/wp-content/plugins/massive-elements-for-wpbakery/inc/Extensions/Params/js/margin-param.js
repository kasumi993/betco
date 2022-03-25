// JavaScript Document
$jvh = jQuery.noConflict();
$jvh('.mew-margin-inputs').on('change', function(e){
	$umargin = $jvh(this).parent();
	var temp = '';
	$umargin.find('.mew-margin-inputs').each(function(input_index, input){
		var margin_parameter = $jvh(input).attr('data-hmargin');
		var input_value = $jvh(input).val();
		if(input_value != '')
		{
			if(input_value.match(/^[0-9]+$/))
				input_value += 'px';
			temp += 'margin-'+margin_parameter+':'+input_value+';';
		}
	});
	$umargin.find('.mew-margin-value').val(temp);
});
$jvh('.mew-margins').each(function(index, element){
	$umargin = $jvh(this);
	var ultimate_margin_value = $umargin.find('.mew-margin-value').val();
	if(ultimate_margin_value != '')
	{
		var vals = ultimate_margin_value.split(';');
		$jvh.each(vals, function(i,vl){
			if(vl != '')
			{
				var splitval = vl.split(':');
				var margin_value = splitval[1];
				var param = splitval[0].split('-');
				var margin_parameter = param[1];
				$umargin.find('.mew-margin-inputs').each(function(input_index, input){
					var input_margin_parameter = $jvh(input).attr('data-hmargin');
					if(margin_parameter == input_margin_parameter)
						$jvh(input).val(margin_value);
				});
			}
		})
	}
});