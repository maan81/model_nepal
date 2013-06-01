$(function(){
   var k,v;

   $('.modelparam').change(function(){
      k = $(this).prop('name'),
      v = $(this).val();

      $.get(window.location.href+'/get_id/0');

      $('.pagina').remove();
      $('.modelsthumb').remove();
      $('.loading').show();
      $('.modelparam').not($(this)).prop('selectedIndex',0);

      $.get(window.location.href+'/search',{key:k,val:v})
         .done(function(data){

            $('.loading').hide();
       		$('.modelfilter').after(data);

         })
   })



   $('.pagina','#main').find('a').live('click',function(e){
      e.preventDefault();

      //submit page number to display
      var n = $(this).prop('href').split('/').pop();

      if(!n)n=0;
      $.get(window.location.href+'/get_id/'+n);


      $('.pagina').remove();
      $('.modelsthumb').remove();
      $('.loading').show();

      //get the data of the reqd page with reqd params.
      //$.get(window.location.href+'/search/'+k+'/'+v)
      $.get(window.location.href+'/search',{key:k,val:v,pg:n})
         .done(function(data){

            $('.loading').hide();
            $('.modelfilter').after(data);

         })

   })
})
