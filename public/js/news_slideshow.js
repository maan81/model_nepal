$(function(){

    var fade=500,
        disp=3000,
        $event = $('#event_pics').find('.event').eq(0),
        $event_thumbs = $('#event_thumbs').find('.selected'),
        next_index=0,
        news_ani;

    $('#event_pics').find('.event').css({'opacity':0})
    $event.css({'opacity':1});

    function news_ani_fn(){
        var index = $event.index();

        $event
            .css('z-index',-1)
            .animate({
                'opacity':0,
            },{ duration: fade, queue: false },function(){
                $event.hide()
            })

        $event_thumbs.eq(index).trigger('mouseout');

        if($event.next().length=='1'){
            $event = $event.next()
            next_index += 1;

        }else{

            $event = $event
                        .parent()
                        .children()
                        .eq(0)
             next_index = 0
        }                                    

        $event
            .show()
            .css({'opacity':0,'z-index':1})
            .animate({
                'opacity':1
            },{duratin:fade,queue:false})

        $event_thumbs.eq(next_index).trigger('mouseover');
    }

    $event_thumbs
        .bind({
            'mouseover': function(){
                $(this).animate({opacity:0},{duration:fade,queue:false});
                //clearInterval(news_ani);
            },
            'mouseout': function(){
                $(this).animate({opacity:0.7},{duration:fade,queue:false});
               // news_ani = setInterval(news_ani_fn,disp)
            },
            'click' : function(e){

                $event
                    .parent()
                    .children()
                    .eq($(this).closest('.event').index())
                    .animate(
                        {
                            'opacity':1,
                            'z-index':1
                        },
                        {
                            duration : fade,
                            queue    : false
                        }
                    )
                    .siblings()
                    .animate(
                        {
                            'opacity':0,
                            'z-index':-1
                        },
                        {
                            duration : fade,
                            queue    : false
                        }
                    )
            }
        })
        .eq(0)
            .css('border-radius','5px 5px 0 0')
            .end()
        .last()
            .css('border-radius','0 0 5px 5px')
            .end()
        .eq(0)
            .trigger('mouseover');

    news_ani = setInterval(news_ani_fn,disp)

})
