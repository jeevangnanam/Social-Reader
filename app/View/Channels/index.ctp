<?php

foreach($feedForView as $thisFeedProperties){

    echo "<div id='feedRecordDisplay".$thisFeedProperties['feedId']."' >";
    //echo "<b>".$thisFeedProperties['feedtitle']."</b>";
    echo "<br /><br />";
            foreach($thisFeedProperties['records'] as $item){
                echo "<div class='feedRecordDisplayEach'>";
                echo "<div class='feedRecordDisplayEachInner'>";
                echo "<b><a href='".$item['Feedrecord']['link']."'>".$item['Feedrecord']['title']."</a></b><br /><br />";
                echo $item['Feedrecord']['description'];
                echo "<br />";
                echo "</div>";
                echo "<div style='clear:both'></div><div id='toolbar'>"."<a href='#' rel='".$item['Feedrecord']['id']."' class='showPreRouteBox'><img src='/img/icons/read-more-button.jpg' /></a>"."</div>";
                echo "</div>";
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