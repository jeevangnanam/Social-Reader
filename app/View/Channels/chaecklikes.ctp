<table style="width:575px;">
	<tr>
		<td>
			<h3><?php echo $name; ?></h3>
		</td>
	</tr>
	<tr>
		<td valign="top">
        	<div style="float:left;padding:5px;">
				<img src="<?php echo $graph->picture;?>" />
            </div>
            <div style="float:left;padding:5px;">
				 <p>Like our Facebook Page<br  /> 
                	<!--<div class="fb-like" data-href="<?php echo $graph->link;?>" data-send="false" data-width="450" data-show-faces="true" data-font="verdana"></div>-->
                    <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fadaderana&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font=verdana&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>
                 </p>
            </div>
		</td>
	</tr>
</table >