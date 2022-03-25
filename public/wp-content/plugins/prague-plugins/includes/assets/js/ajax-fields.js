
function init_ajax_field() {
	console.log('init');
	var $ = jQuery;
	jQuery('.templates').on('change', function(){
		var this_val = $(this).val();
		//console.log(ajaxurl);

		$.ajax({
			method: "POST",
			url: ajaxurl,
			dataType: "json",
			data: {
				action: "prague_get_pixfields",
				_vcnonce: window.prague_nonce
			},
		    success: function(data){

		        $('.filter_type').html(data);
		    }

		});
	});
}

