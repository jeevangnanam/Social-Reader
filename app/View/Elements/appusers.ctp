<div id="globalConfigurations">
	<div class="headings">
	<?php echo $appUsers;?> AND <?php echo count($appUsersFriends);?> FRIEND(S) ARE USING
 	<div class="showStatus"></div>
    
	</div>
	<?php 
		$i=1;
		foreach($appUsersFriends as $key=>$appUsersFriend){ 
			if($i<11){
				if(($i/5)==1){
					echo "</br>";
				}
				?>
			<img src="https://graph.facebook.com/<?php echo $appUsersFriend;?>/picture" width="50" style="border:1px #999 solid;padding:1px;margin:1px;" />
		<?php }
		$i++;
		}
	?>
</div>