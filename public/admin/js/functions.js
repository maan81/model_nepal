$(function(){
	$('#username','#admin-login')
		.click(function(){
			if($(this).val() == 'Username')
				$(this).val('');
		})
		.blur(function(){
			if($(this).val() == '')
				$(this).val('Username')
		})
	$('#password','#admin-login')
		.click(function(){
			if($(this).val() == '********')
				$(this).val('');
		})
		.blur(function(){
			if($(this).val() == '')
				$(this).val('********')
		})	


	$('#list_data').on('click','.delete', function(e){
		var id = $(this).closest('td').siblings().first().text();

		var ok = confirm('Are you sure you want to delete the row with ID '+id+'?');

		if(! ok){
			return false;
		}
	})

	$('.flash_close').click(function(e){
		e.preventDefault();

		$('.flash_msg').remove();
	})
})
