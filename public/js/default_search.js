$(function(){
	$('.modelparam')
		.last()
		.children()
		.eq(1)
		.attr('selected','selected');


	setTimeout(function(){
		$('.modelparam')
			.last()
			.trigger('change');
	},250);
})