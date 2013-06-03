$(function(){
   //var k,v;

   $('.modelparam').change(function(){
      //k = $(this).prop('name'),
      //v = $(this).val();
      //$.data(document.body,'name',k);
      //$.data(document.body,'val',v);
      $.data(document.body,'page',0);

      $('.pagina').remove();
      $('.modelsthumb').remove();
      $('.loading').show();
      $('.modelparam').not($(this)).prop('selectedIndex',0);

      $.get(window.location.href+'/search',{/*key:k,val:v,*/page:0})
         .done(function(data){

            $('.loading').hide();
       		$('.modelfilter').after(data);

         })
   })



   $('.pagina','#main').find('a').live('click',function(e){
      e.preventDefault();

      //k = $.data(document.body,'name');
      //v = $.data(document.body,'val');

      //submit page number to display
      var n = $(this).prop('href').split('/').pop();
      if(!n)n=0;

      $('.pagina').remove();
      $('.modelsthumb').remove();
      $('.loading').show();

      //get the data of the reqd page with reqd params.
      $.get(window.location.href+'/search',{/*key:k,val:v,*/page:n})
         .done(function(data){

            $('.loading').hide();
            $('.modelfilter').after(data);

         })

   })


   //change triggered coz. actually there is no modelparam
   $('.modelparam').delay(250).trigger('change');


})
