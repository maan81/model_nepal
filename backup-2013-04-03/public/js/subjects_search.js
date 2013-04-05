$(function(){
   $('.modelparam').change(function(){
      var k = $(this).prop('name'),
         v = $(this).val();

      $('.pagina').remove();
      $('.agencymodel').remove();
      $('.loading').show();
      $('.modelparam').not($(this)).prop('selectedIndex',0);

      $.post(window.location.href+'/search/'+k+'/'+v)
         .done(function(data){

            $('.loading').hide();
       		$('.modelfilter').after(data);

         })
   })
})
