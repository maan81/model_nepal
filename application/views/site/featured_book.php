<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<style type="text/css">
.modeldisplay{
	height:825px !important;
}
.rbbox,.rtbox{
	right:30px !important;
}
.rbbox{
	bottom:150px !important;
}
</style>

<script type='text/javascript'>
$(function(){
	$('#form_649133').submit(function(e){
		e.preventDefault();
		$.post(
			'<?php echo current_url()?>',
			{
				//csrf_name 	: '<?php echo $this->security->get_csrf_token_name()?>',
				//csrf_value 	: '<?php echo $this->security->get_csrf_hash()?>',
				purpose 	: $('#purpose').val(),
				other 		: $('#other').val(),
				renumeration: $('#renumeration').val(),
				element_2 	: $('#element_2').val(),
				element_3 	: $('#element_3').val(),
				element_4 	: $('#element_4').val()
			},
			function(result){
				if(result=='success'){
					alert('Model Book Success');
					window.location.replace("<?php echo site_url('featured/'.$featured[0]->link)?>");
				}else{
					alert('Model Book Failure. Incorrect Data entered : '+result);
				}
			}
		)
	})
})
</script>

<div class="mainContents">
	
	<?php echo validation_errors(); ?>

	<div class="leftPart">
		
		<div class="modeldisplay">
			
			<div class="rtbox">
		        <?php 
		        if($rtbbox[0] && $rtbbox[0]->type=='script'): 
					echo $rtbbox[0]->script;
	            elseif($rtbbox[0] && $rtbbox[0]->type=='image'): 
	            ?>
	               <a href="<?php echo $rtbbox[0]->link?>">
	                  <img src="<?php echo base_url().ADDSPATH.$rtbbox[0]->image?>" 
	                        title="<?php echo $rtbbox[0]->title?>" 
	                        alt="<?php echo $rtbbox[0]->title?>"
	                        width="200" height="200" />
	               </a>
	            <?php
				endif;
				?>
			</div>
			<div class="rbbox">
		        <?php 
		        if($rtbbox[1] && $rtbbox[1]->type=='script'): 
					echo $rtbbox[1]->script;
				elseif($rtbbox[1] && $rtbbox[1]->type=='image'): 
				?>
					<a href="<?php echo $rtbbox[1]->link?>">
						<img src="<?php echo base_url().ADDSPATH.$rtbbox[1]->image?>" 
								title="<?php echo $rtbbox[1]->title?>" 
								alt="<?php echo $rtbbox[1]->title?>"
								width="200" height="200" />
					</a>
				<?php
				endif;
				?>
			</div>





			<div id="form_container">
			   <h1><a>Book Model - <?php echo $featured[0]->name?></a></h1>
			   <?php 
			   		$attr = array(	'id'=>"form_649133",
			   						'class'=>"appnitro");
			   		echo form_open(current_url(),$attr); 
		   		?>
			      <div class="form_description">
			         <h2>Book Model - <?php echo $featured[0]->name?></h2>
			      </div>
			      <ul >

			         <li id="li_10" >
			            <label class="description" for="purpose">Purpose </label>
			            <div>
			               <select class="element select medium" id="purpose" name="purpose">
			                  <option value="" selected="selected"></option>
			                  <option value="music" >Music Video</option>
			                  <option value="other" >Other</option>
			               </select>
			            </div>
			            <p class="guidelines" id="guide_purpose"><small>The purpose for the model</small></p>
			         </li>

			         <li id="li_9" >
			            <label class="description" for="other">Other </label>
			            <div>
			               <input id="other" name="other" class="element text medium" type="text" maxlength="255" value=""/> 
			            </div>
			            <p class="guidelines" id="guide_other"><small>Mention the purpose of the model</small></p>
			         </li>

			         <li id="li_6" >
			            <label class="description" for="location">Location </label>
			            <span>
				            <input id="local" name="local" class="element checkbox" type="checkbox" value="1" />
				            <label class="choice" for="local">Local</label>
				            
				            <input id="national" name="national" class="element checkbox" type="checkbox" value="1" />
				            <label class="choice" for="national">National</label>
				            
				            <input id="international" name="international" class="element checkbox" type="checkbox" value="1" />
				            <label class="choice" for="international">International</label>
			            </span>
			            <p class="guidelines" id="guide_location"><small>Location(s) where the model is to be used.</small></p>
			         </li>

			         <li id="li_5" >
			            <label class="description" for="duration">Duration </label>
			            <span>
				            <input id="day_1" name="duration" class="element radio" 
				            		type="radio" value="1_day" />
				            <label class="choice" for="day_1">1 Day</label>

				            <input id="week_1" name="duration" class="element radio" 
				            		type="radio" value="1_week" />
				            <label class="choice" for="week_1">1 Week</label>
				            
				            <input id="month_1" name="duration" class="element radio" 
				            		type="radio" value="1_month" />
				            <label class="choice" for="month_1">1 Month</label>
			            </span>
			            <p class="guidelines" id="guide_duration"><small>Time to use the model</small></p>
			         </li>

			         <li id="li_7" >
			            <label class="description" for="renumeration">Proposed Renumeration </label>
			            <div>
			               <select class="element select medium" id="renumeration" name="renumeration">
			                  <option value="" selected="selected"></option>
			                  <option value="1" >NRS 1000 - NRS 5000</option>
			                  <option value="2" >NRS 5000 - NRS 10000</option>
			                  <option value="3" >> NRS 10000</option>
			                  <option value="4" >Negoitable</option>
			               </select>
			            </div>
			            <p class="guidelines" id="guide_renumeration"><small>Proposed cost for the selected model</small></p>
			         </li>

			         <li class="section_break">
			            <h3></h3>
			            <p></p>
			         </li>

			         <li id="li_2" >
			            <label class="description" for="element_2">Name </label>
			            <div>
			               <input id="element_2" name="element_2" class="element text large" type="text" maxlength="255" value=""/> 
			            </div>
			            <p class="guidelines" id="guide_2"><small>Your full name</small></p>
			         </li>

			         <li id="li_3" >
			            <label class="description" for="element_3">Email </label>
			            <div>
			               <input id="element_3" name="element_3" class="element text medium" 
			               			type="text" maxlength="255" value="" /> 
			            </div>
			            <p class="guidelines" id="guide_3">
			            	<small>Your contact email</small>
			            </p>
			         </li>

			         <li id="li_4" >
			            <label class="description" for="element_4">Contact Number </label>
			            <div>
			               <input id="element_4" 
			               			name="element_4" class="element text medium" 
			               			type="text" maxlength="255" value="" /> 
			            </div>
			            <p class="guidelines" id="guide_4">
			            	<small>Your contact phone number</small>
			            </p>
			         </li>

			         <li class="buttons">
			            <input type="hidden" name="form_id" value="649133" />
			            <input onclick='return validate_book();' id="saveForm" class="button_text" 
			            		type="submit" name="submit" value="Book" />
			            <button onclick='return cancel_book();'>Cancel</button>
			         </li>

			      </ul>
			   </form>
			</div>




		</div>

	</div>

   <?php $this->view('site/right_part.php')?>
</div>
