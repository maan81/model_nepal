$(function(){
	$('select').change(function(){
		var k = $(this).prop('name'),
			v = $(this).val();

		//console.log(k);
		//console.log(v);

		$.post('featured/search/'+k+'/'+v).
			done(function(data){
				
				$('.pagina').remove();
				$('.modelsthumb').remove();
				$('.modelfilter').after(data);
			})
	})
})