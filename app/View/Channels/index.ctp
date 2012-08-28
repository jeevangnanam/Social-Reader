<?php


foreach($feedForView as $thisFeedProperties){
    
	$counter = 0;
    echo "<div id='feedRecordDisplay".$thisFeedProperties['feedId']."' >";
    //echo "<b>".$thisFeedProperties['feedtitle']."</b>";
    echo "<br /><br />";
            foreach($thisFeedProperties['records'] as $item){
				++$counter;
				
				if($counter === 1){
						echo "<div class='feedRecordDisplayEachFirst'>";
						echo "<div class='feedRecordDisplayEachFirstInner'>";
						echo "<b>".$item['Feedrecord']['title']."</b><br /><br />";
						echo $item['Feedrecord']['description'];
						echo "<br />";
						echo "</div>";
						echo "<div style='clear:both'></div><div id='toolbar' style='background-color: #FDE3DF'>"."<a href='#' rel='".$item['Feedrecord']['id']."' class='showPreRouteBox'><img src='/appproperties/". $layout."/img/read-more-button.jpg' width='67' /></a>"."</div>";
						echo "</div>";
					
					}else{
						
						echo "<div class='feedRecordDisplayEach'>";
						echo "<div class='feedRecordDisplayEachInner'>";
						echo "<b>".$item['Feedrecord']['title']."</b><br /><br />";
						echo $item['Feedrecord']['description'];
						echo "<br />";
						echo "</div>";
						echo "<div style='clear:both'></div><div id='toolbar' >"."<a href='#' rel='".$item['Feedrecord']['id']."' class='showPreRouteBox'><img src='/appproperties/". $layout."/img/read-more-button.jpg' /></a>"."</div>";
						echo "</div>";
						
						}

            }

    echo "<br /><br />";
    echo '</div>';

}

//foreach($parsed_xml_list->channel->item as $item){
//    echo $item->title."<br /><br />";
//}

?>
<div id="preRouteBox">
    some text
</div>
<script>
	checkLikes('<?php echo $likes;?>','<?php echo $channelId;?>');
</script>