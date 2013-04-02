$(function(){
	$('.flash_close').click(function(e){
		e.preventDefault();

		$('.flash_msg').remove();
	})
})