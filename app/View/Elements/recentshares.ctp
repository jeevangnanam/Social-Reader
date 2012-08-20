<div id="globalConfigurations">
	<div class="headings">
	Your recent shared news.
 	<div class="showStatusRecentShares"></div>
    
	</div>
    <ul id="r-shares" style="padding:2px;">
	<?php 
		
		foreach(@$recentShares as $key=>$recentShare){ 
		//	echo "<li  style=\"padding:2px;\" id=\"".@$recentShare['Facebookresponse']['response']."_li\">".@$recentShare['Feedrecord']['title'].$this->Html->Image('remove-share-button.jpg',array('class'=>'removepost',"id"=>@$recentShare['Facebookresponse']['response']))."</li>";
		}
	?>
    </ul>
</div>