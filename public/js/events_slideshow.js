$(function(){

    var fade=500,
        disp=8000,
        $event = $('.upcoming').find('.eventpic'),
        index=0;

    //show first event
    $event
        .siblings({'opacity':0,'z-index':-1})
        .end()
        .eq(index)
        .css({'opacity':1,'z-index':1})
        

    //repeat the animation
    events_ani = setInterval(events_ani_fn,disp)

    //fn to repeat the animation
    function events_ani_fn(){
        //no animation if not enough data
        if($event.length<2)
            return

        //hide the displayed one
        $event
            .eq(index)
            .animate(
                {'opacity':0,'z-index':-1},
                { duration: fade, queue: false }
            )

        //select next
        if($event.eq(index).next().length=='1'){
            index += 1;

        //select first
        }else{
            index = 0

        }                                    


        //show the selected one
        $event
            .eq(index)
            .css({'opacity':0,'z-index':1})
            .animate(
                {'opacity':1},
                {duratin:fade,queue:false}
            )
    }
})
