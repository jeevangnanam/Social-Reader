<div id="globalConfigurations">
	<div class="headings">
	<?php echo @$appUsers;?> AND <?php echo count(@$appUsersFriends);?> FRIEND(S) ARE USING
 	<div></div>
    
	</div>
	<?php 
		$i=1;
		foreach(@$appUsersFriends as $key=>$appUsersFriend){ 
			if($i<11){
				if(($i/5)==1){
					echo "</br>";
				}
				?>
			<a href='http://www.facebook.com/<?php echo $appUsersFriend;?>' target="_blank"><img src="https://graph.facebook.com/<?php echo @$appUsersFriend;?>/picture" width="50" style="border:1px #999 solid;padding:1px;margin:1px;" /></a>
		<?php }
		$i++;
		}
	?>
</div>