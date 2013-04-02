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
})
