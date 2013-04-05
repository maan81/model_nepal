$(function(){
   $('.modelparam').change(function(){
      var k = $(this).prop('name'),
         v = $(this).val();

      $('.pagina').remove();
      $('.modelsthumb').remove();
      $('.loading').show();
      $('.modelparam').not($(this)).prop('selectedIndex',0);

      $.post('featured/search/'+k+'/'+v)
         .done(function(data){

            $('.loading').hide();
       		$('.modelfilter').after(data);

         })
   })
})
