$(function() {
	/**
	* navR,navL are flags for controlling the albums navigation
	* first gives us the position of the album on the left
	* positions are the left positions for each of the 3 albums displayed at a time
	*/
	var navR,navL	= false;
	var first		= 1;
	var positions 	= {
		'0'		: 0,
		'1' 	: 235,
		'2' 	: 470//,
		//'3' 	: 510,
		//'4' 	: 680
	}
	var $ps_albums 		= $('#ps_albums');
	/**
	* number of albums available
	*/
	var elems			= $ps_albums.children().length;
	var $ps_slider		= $('#ps_slider');
	
	/**
	* let's position all the albums on the right side of the window
	*/
	var hiddenRight 	= $(window).width() - $ps_albums.offset().left;
	$ps_albums.children('div').css('left',hiddenRight + 'px');
	
	/**
	* move the first 3 albums to the viewport
	*/
	$ps_albums.children('div:lt(3)').each(
		function(i){
			var $elem = $(this);
			$elem.css({'left': positions[i] + 'px','opacity':1});
			if(elems > 3)
				enableNavRight();
		}
	);
	
	/**
	* next album
	*/
	$ps_slider.find('.next').bind('click',function(){
		if(!$ps_albums.children('div:nth-child('+parseInt(first+3)+')').length || !navR) return;
		disableNavRight();
		disableNavLeft();
		moveRight();
	});
	
	/**
	* previous album
	*/
	$ps_slider.find('.prev').bind('click',function(){
		if(first==1  || !navL) return;
		disableNavRight();
		disableNavLeft();
		moveLeft();
	});
	
	/**
	* we move the first album (the one on the left) to the left side of the window
	* the next 2 albums slide one position, and finally the next one in the list
	* slides in, to fill the space of the first one
	*/
	function moveRight () {
		var hiddenLeft 	= $ps_albums.offset().left + 163;
		
		var cnt = 0;
		$ps_albums.children('div:nth-child('+first+')').animate({'left': - hiddenLeft + 'px','opacity':0},500,function(){
				var $this = $(this);
				$ps_albums.children('div').slice(first,parseInt(first+2)).each(
					function(i){
						var $elem = $(this);
						$elem.animate({'left': positions[i] + 'px'},800,function(){
							++cnt;
							if(cnt == 2){
								$ps_albums.children('div:nth-child('+parseInt(first+3)+')').animate({'left': positions[cnt] + 'px','opacity':1},500,function(){
									//$this.hide();
									++first;
									if(parseInt(first + 2) < elems)
										enableNavRight();
									enableNavLeft();
								});
							}		
						});
					}
				);		
		});
	}
	
	/**
	* we move the last album (the one on the right) to the right side of the window
	* the previous 2 albums slide one position, and finally the previous one in the list
	* slides in, to fill the space of the last one
	*/
	function moveLeft () {
		var hiddenRight 	= $(window).width() - $ps_albums.offset().left;
	
		var cnt = 0;
		var last= first+2;
		$ps_albums.children('div:nth-child('+last+')').animate({'left': hiddenRight + 'px','opacity':0},500,function(){
				var $this = $(this);
				$ps_albums.children('div').slice(parseInt(last-3),parseInt(last-1)).each(
					function(i){
						var $elem = $(this);
						$elem.animate({'left': positions[i+1] + 'px'},800,function(){
							++cnt;
							if(cnt == 2){
								$ps_albums.children('div:nth-child('+parseInt(last-3)+')').animate({'left': positions[0] + 'px','opacity':1},500,function(){
									//$this.hide();
									--first;
									enableNavRight();
									if(first > 1)
										enableNavLeft();
								});
							}										
						});
					}
				);
		});
	}
	
	/**
	* disable or enable albums navigation
	*/
	function disableNavRight () {
		navR = false;
		$ps_slider.find('.next').addClass('disabled');
	}
	function disableNavLeft () {
		navL = false;
		$ps_slider.find('.prev').addClass('disabled');
	}
	function enableNavRight () {
		navR = true;
		$ps_slider.find('.next').removeClass('disabled');
	}
	function enableNavLeft () {
		navL = true;
		$ps_slider.find('.prev').removeClass('disabled');
	}		
	
})
