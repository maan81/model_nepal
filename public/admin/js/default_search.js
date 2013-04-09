$(function(){
	$('.modelparam')
		.last()
		.children()
		.eq(1)
		.attr('selected','selected')

	$('.modelparam')
		.eq(2)
		.trigger('change')	
})