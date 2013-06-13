<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<style type="text/css">
.modeldisplay{
	height:825px !important;
}
.rbbox,.rtbox{
	right:30px !important;
}
</style>

<div class="mainContents">

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
			            <label class="description" for="element_10">Purpose </label>
			            <div>
			               <select class="element select medium" id="element_10" name="element_10">
			                  <option value="" selected="selected"></option>
			                  <option value="1" >Music Video</option>
			                  <option value="0" >Other</option>
			               </select>
			            </div>
			            <p class="guidelines" id="guide_10"><small>The purpose for the model</small></p>
			         </li>

			         <li id="li_9" >
			            <label class="description" for="element_9">Other </label>
			            <div>
			               <input id="element_9" name="element_9" class="element text medium" type="text" maxlength="255" value=""/> 
			            </div>
			            <p class="guidelines" id="guide_9"><small>Mention the purpose of the model</small></p>
			         </li>

			         <li id="li_6" >
			            <label class="description" for="element_6">Location </label>
			            <span>
			            <input id="element_6_1" name="element_6_1" class="element checkbox" type="checkbox" value="1" />
			            <label class="choice" for="element_6_1">Local</label>
			            <input id="element_6_2" name="element_6_2" class="element checkbox" type="checkbox" value="1" />
			            <label class="choice" for="element_6_2">National</label>
			            <input id="element_6_3" name="element_6_3" class="element checkbox" type="checkbox" value="1" />
			            <label class="choice" for="element_6_3">International</label>
			            </span>
			            <p class="guidelines" id="guide_6"><small>Location(s) where the model is to be used.</small></p>
			         </li>

			         <li id="li_5" >
			            <label class="description" for="element_5">Duration </label>
			            <span>
			            <input id="element_5_1" name="element_5" class="element radio" type="radio" value="1" />
			            <label class="choice" for="element_5_1">1 Day</label>
			            <input id="element_5_2" name="element_5" class="element radio" type="radio" value="2" />
			            <label class="choice" for="element_5_2">1 Week</label>
			            <input id="element_5_3" name="element_5" class="element radio" type="radio" value="3" />
			            <label class="choice" for="element_5_3">1 Month</label>
			            </span>
			            <p class="guidelines" id="guide_5"><small>Time to use the model</small></p>
			         </li>

			         <li id="li_7" >
			            <label class="description" for="element_7">Proposed Renumeration </label>
			            <div>
			               <select class="element select medium" id="element_7" name="element_7">
			                  <option value="" selected="selected"></option>
			                  <option value="1" >NRS 1000 - NRS 5000</option>
			                  <option value="2" >NRS 5000 - NRS 10000</option>
			                  <option value="3" >> NRS 10000</option>
			                  <option value="4" >Negoitable</option>
			               </select>
			            </div>
			            <p class="guidelines" id="guide_7"><small>Proposed cost for the selected model</small></p>
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
