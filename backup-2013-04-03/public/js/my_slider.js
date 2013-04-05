/*
 *	JQUERY SLIDER PLUGIN.
 * --------------------------------------------------
 *		move	:	time taken while sliding
 *		pause	:	time taken before sliding
 *		each_width:	width of each part
 *		each_height:height of each part
 *		num		:	number of parts to disp. at once
 *		showDir	:	show left-right slide buttons
 *		showPlay:	show play-pause button
 *		l		:	id of left button 		-- if using custom button
 *		r		:	id of right button 		-- if using custom button
 *		p		:	id of play-pause button	-- if using custom button
 * 		h		:	hover vs click
 *		autoMove:	slide automatically
 *		autoDir	:	default slideing direction
 *		type	:	type of slide: linear or swing
 *		display	:	type of arrangement : vertical or horizontal
 * 		h_spacing: 	horizontal spacing		-- if using horizontal slider
 * 		v_spacing:	vertical spacing		-- if using vertical slider
 *
 */
 
(function($){
	$.fn.my_slider=function(opt){
		this.each(function(){
			var $obj = $(this);

			var defaults={
				move	:	200,
				pause	:	2000,
				each_width:	100,
				each_height:100,
				num		:	3,
				showDir	:	true,
				showPlay:	true,
				l		:	'',	
				r		:	'',	
				p		:	'',	
				h		:	true,
				autoMove:	true,
				autoDir	:	'left',
				type	:	'swing',
				display	:	'horizontal',
				h_spacing:	15,
				v_spacing:	15
			};
		
			opt=$.extend(defaults,opt);

			/*
			 *	fn. to get total num of parts for sliding
			 *		returns: integer
			 *
			 */
			function getNum($myObj){
				var n=0;
				$myObj.find('.slide').each(function(){
					n++;
				});
				return n;
			};

			function validate(opt){
				var tmpN=getNum($obj);
				if(tmpN<opt.num+1){
					opt.num=tmpN-1;
				}
			
				if(opt.showDir){
					if(opt.l=='' || $('#'+opt.l).length==0){
						var l = $('<div id="l"/>')
						if(opt.dispaly=='horizontal') l.text('<--');
						else if(opt.display=='vertical') l.text('down');
						console.log(l)
						$obj.prepend(l);
						opt.l=l;
					}else{
						opt.l=$('#'+opt.l);
					}
					if(opt.r=='' || $('#'+opt.r).length==0){
						var r = $('<div id="r"/>');
						if(opt.dispalay=='horizontal') r.text('-->');
						else if(opt.display=='vertical') r.text('up');
						$obj.prepend(r);
						opt.r=r;
					}else{
						opt.r=$('#'+opt.r);
					}
				}
				if(opt.showPlay){
					if(opt.p=='' || $('#'+opt.p).length==0){
						var p=$('<div id="p"/>').text('Play');
						$obj.prepend(p);
						opt.p=p;
					}else{
						opt.p=$('#'+opt.p);
					}
				}
				
				if((opt.display!='horizontal') && (opt.display!='vertical')){
					opt.display='horizontal';
				}

				//horizontal slider
				if(opt.display=='horizontal'){
					if(opt.autoDir != 'left' && opt.autoDir != 'right' )
						opt.autoDir='-';
					else if(opt.autoDir=='left') opt.autoDir='-';
					else if(opt.autoDir=='right') opt.autoDir='+';
					
				//vertical slider
				}else if(opt.display=='vertical'){
					if(opt.autoDir != 'up' && opt.autoDir != 'down' )
						opt.autoDir='up';
					else if(opt.autoDir=='up') opt.autoDir='up';
					else if(opt.autoDir=='down') opt.autoDir='dn';
				}
				
				//h-spacing & v-spacing not validated yet
			};
			validate(opt);

			/*
			 * fn to generate rand. char.
			 *   options: length (default 5)
			 *   returns: rand. string
			 */ 
			function rand(l){
				if(l==undefined) l = 5;
				var text = "";
				var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
				for( var i=0; i < l; i++ )
					text+=possible.charAt(Math.floor(Math.random()*possible.length));
				return text;
			};

			/*
			 *	fn to return current gallery's ID
			 *	  option: current gallery
			 *	  returns:current gallery's ID
			 */
			function getObjID($myObj){
				var tmpID;
				if($myObj.attr('id')==undefined){
					do{
						tmpID=rand();
					}while($('#'+tmpID).length);
					$myObj.attr('id',tmpID);
				};
				return $myObj.attr('id');
			};
			var $objID = getObjID($obj);

			function addCss($myObj){
				var newCss='<style>';
				newCss+='/*stylesheet generated by img_slider jQuery plugin*/';
				
				if(opt.display=='horizontal'){
					newCss+='#'+$objID+' {'+
								'overflow: hidden;'+
								'position: relative;'+
								//'background: none repeat scroll 0 0 #FFFAAE;/*editable*/'+
								//'border: 5px ridge #FFFFFF;/*editable*/'+

								'height: '+parseInt((opt.each_height+opt.v_spacing)+3)+'px;	/*changes at init*/'+
								'width: '+parseInt((opt.each_width+opt.h_spacing)*opt.num)+'px;	/*changes at init*/'+
							'}'+

							'#'+$objID+' .slide {'+
								'position: absolute;'+ //for horizontal vs vertical
								//'border: 1px solid #FFFAAE;/*editable*/'+
								//'background-color:green;/*editable*/'+

								'height:'+opt.each_height+'px;	/*changes at init*/'+
								'width:'+opt.each_width+'px;	/*changes at init*/'+
								'margin-right:'+opt.h_spacing+';/*changes at init*/'+
							'}'+
							
							'#'+$objID+' #l,#r,#p{'+
								'position:absolute;'+
								'z-index:1;'+
								'cursor:pointer;/*editable*/'+
								'opacity:0.2;'+
							'}'+
							
							'#'+$objID+' #l:hover,#r:hover,#p:hover{'+
								'opacity:1;'+
							'}'+
							
							'#'+$objID+' #l{'+
								'left:5px;'+
							'}'+
							
							'#'+$objID+' #r{'+
								'left:'+parseInt(opt.each_width*opt.num -25)+'px;'+
							'}'+
							
							'#'+$objID+' #p{'+
								'left:'+parseInt(opt.each_width*opt.num/2-10)+'px;'+
							'}';
				
				}else if(opt.display=='vertical'){
					newCss+='#'+$objID+' {'+
								'overflow: hidden;'+
								'position: relative;'+
								'background: none repeat scroll 0 0 #FFFAAE;/*editable*/'+
								'border: 5px ridge #FFFFFF;/*editable*/'+

								'height: '+parseInt(opt.each_height*opt.num+3)+'px;	/*changes at init*/'+
								'width: '+opt.each_width+'px;	/*changes at init*/'+
							'}'+

							'#'+$objID+' .slide {'+
								'position: absolute;'+
								'border: 1px solid #FFFAAE;/*editable*/'+
								'background-color:yellow;/*editable*/'+

								'height:'+opt.each_height+'px;	/*changes at init*/'+
								'width:'+opt.each_width+'px;	/*changes at init*/'+
								'left: 0;		/*changes dynamically*/'+
								'margin-botton:'+opt.v_spacing+';/*changes at init*/'+
							'}'+
							
							'#'+$objID+' #l,#r,#p{'+
								'position:absolute;'+
								'z-index:1;'+
								'cursor:pointer;/*editable*/'+
								'opacity:0.2;'+
							'}'+
							
							'#'+$objID+' #l:hover,#r:hover,#p:hover{'+
								'opacity:1;'+
							'}'+
							
							'#'+$objID+' #l{'+
								'left:5px;'+
							'}'+
							
							'#'+$objID+' #r{'+
								'left:'+parseInt(opt.each_width -25)+'px;'+
							'}'+
							
							'#'+$objID+' #p{'+
								//'left:'+parseInt(opt.each_width*opt.num/2-10)+'px;'+
							'}';
				};
				newCss+='</style>';

				$obj.before(newCss);
			};

			function init($myObj){
				addCss($myObj);
				
				var n=0;
				$myObj.find('.slide').each(function(){
					if(opt.display=='horizontal'){
						$(this).css({'left':(opt.each_width+opt.h_spacing)*n+'px','top':10});
					}else if(opt.display=='vertical'){
						$(this).css({'top':(opt.each_height+opt.v_spacing)*n+'px'})
					}
					n++;
				});
				
				$myObj.data('ok',true);
			};
			init($obj);
		
			function slide(dir){
				var tmp = $obj.find('.slide');
				$obj.data('ok',false);
				
				if(dir=='+'){
					tmp.stop()
						.last()
						.css('left','-'+(opt.each_width+opt.h_spacing)+'px')
						.end()
						.first()
						.before(tmp.last())
					
					tmp.animate({
							'left':'+='+(opt.each_width+opt.h_spacing)+''
						},opt.move,opt.type,function(){
							$obj.data('ok',true)
						}
					)
				}
				else if(dir=='-'){
					var lastLeft=tmp.last().css('left');
				
					tmp.animate({
							'left':'-='+(opt.each_width+opt.h_spacing)+''
						},opt.move,opt.type,function(){
							tmp.first()
								.css('left',lastLeft)
								.end()
								.last()
								.after(tmp.first())
						
							$obj.data('ok',true)
						}
					)
				}
				else if(dir=='up'){
					var lastTop=tmp.last().css('top');
				
					tmp.animate({
							'top':'-='+(opt.each_height+opt.v_spacing)+''
						},opt.move,opt.type,function(){
							tmp.first()
								.css('top',lastTop)
								.end()
								.last()
								.after(tmp.first())
						
							$obj.data('ok',true)
						}
					)
					
				}
				else if(dir=='dn'){
					
					tmp.stop()
						.last()
						.css('top','-'+(opt.each_height+opt.v_spacing)+'px')
						.end()
						.first()
						.before(tmp.last())
					
					tmp.animate({
							'top':'+='+(opt.each_height+opt.v_spacing)+''
						},opt.move,opt.type,function(){
							$obj.data('ok',true)
						}
					)
				}
			
			};
			
			//functions binding here
			function assign($myObj){
				var s;
				$myObj.data('ok',true);

				//auto slide
				if(opt.autoMove){
					s=setInterval(function(){
							slide(opt.autoDir);
						},opt.move+opt.pause)
					
					$obj.data({'s':s});
				};
				
				//slide left. <-- btn
				if(opt.display=='horizontal'){
					if(opt.h){
						// on hover
						(opt.l).hover(function(){
							if($obj.data('ok')){
								clearInterval(s);
								s=undefined;
								s=setInterval(function(){
										slide('+');
									},opt.move+opt.pause)
					
								$obj.data({'s':s});
							}
						},function(){
							clearInterval(s);
							s=undefined;
						});
					}else{
						//on click
						(opt.l).click(function(){
							if($obj.data('ok')){
								clearInterval(s);
								s=undefined;
								slide('+');
							}
						});
					}

					//slide right. --> btn
					if(opt.h){
						// on hover
						(opt.r).hover(function(){
							if($obj.data('ok')){
								clearInterval(s);
								s=undefined;
								s=setInterval(function(){
										slide('-');
									},opt.move+opt.pause)
					
								$obj.data({'s':s});
							}
						},function(){
							clearInterval(s);
							s=undefined;
						});
					}else{
						//on click
						(opt.r).click(function(){
							if($obj.data('ok')){
								clearInterval(s);
								s=undefined;
								slide('-');
							}
						});
					}
					
				}
				
				else if(opt.display=='vertical'){
					//slide up
					if(opt.h){
						//on hover
					}else{
						//on click
						(opt.l).click(function(){
							if($obj.data('ok')){
								clearInterval(s);
								s=undefined;
								slide('up');
							}
						});
					}
				
					//slide down
					if(opt.h){
						//on hover
					}else{
						//on click
						$myObj.find(opt.r).click(function(){
							if($obj.data('ok')){
								clearInterval(s);
								s=undefined;
								slide('dn');
							}
						});
					}
				}

			
				//play-pause btn
				$myObj.find(opt.p).click(function(){
				
					//pause sliding
					if(s){
						clearInterval(s);
						s=undefined;
					
					//start slideing
					}else{
						slide(opt.autoDir);
						s=setInterval(function(){
								slide(opt.autoDir);
							},opt.move+opt.pause)

						$obj.data({'s':s});
					}
				});
			};
			assign($obj);
		});
		return this;
	};
})(jQuery);
