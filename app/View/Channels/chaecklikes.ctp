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
                	<div class="fb-like" data-href="<?php echo $graph->link;?>" data-send="false" data-width="450" data-show-faces="true" data-font="verdana"></div>
                 </p>
            </div>
		</td>
	</tr>
</table >