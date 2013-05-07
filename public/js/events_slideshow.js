$(function(){

    var fade=500,
        disp=8000,
        $event = $('.upcomming').find('.eventpic'),
        $selectors = $('.upcomming').find('.upcomming_selector'),
        index=0,
        nu_index=-1;

    //show first event
    $event
        .siblings({'opacity':0,'z-index':-1})
        .end()
        .eq(index)
        .css({'opacity':1,'z-index':1})

    //select 1st selector
    $selectors.eq(0).css('background-color','#000');

    //repeat the animation
    events_ani = setInterval(events_ani_fn,disp);

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
            );
        //unselect the displayed selector
        $selectors.eq(index).css('background-color','#fff');


        //select next
        if($event.eq(index).next().length=='1'){
            index += 1;

        //select first
        }else{
            index = 0

        }                                    


        //get index if clicked
        if(nu_index!=-1){
            index = nu_index;
            nu_index=-1;
        }

        //show the selected one
        $event
            .eq(index)
            .css({'opacity':0,'z-index':1})
            .animate(
                {'opacity':1},
                {duratin:fade,queue:false}
            )
        //select the reqd. selector
        $selectors.eq(index).css('background-color','#000');
    }

    //trigger by selecting
    $selectors.click(function(){
        nu_index = $(this).index();
        events_ani_fn();
    });
})
