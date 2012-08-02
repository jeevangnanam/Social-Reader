<div id="globalConfigurations">
	<div class="headings">
	Your recent shared news.
 	<div class="showStatus"></div>
    
	</div>
    <ul id="r-shares">
	<?php 
		
		foreach(@$recentShares as $key=>$recentShare){ 
			echo "<li id=\"".@$recentShare['Facebookresponse']['response']."_li\">".@$recentShare['Feedrecord']['title'].$this->Html->Image('remove-share-button.jpg',array('class'=>'removepost',"id"=>@$recentShare['Facebookresponse']['response']))."</li>";
		}
	?>
    </ul>
</div>