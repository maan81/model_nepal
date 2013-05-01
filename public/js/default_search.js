$(function(){
	$('.modelparam')
		.last()
		.children()
		.removeAttr('selected')
		.eq(1)
		.attr('selected','selected');


	setTimeout(function(){
		$('.modelparam')
			.last()
			.trigger('change');
	},250);
})