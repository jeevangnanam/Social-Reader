<table >
	<tr>
		<td colspan="2">
			<h3><?php echo $name; ?>(SOCIAL READER)</h3>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<img src="<?php echo $graph->picture;?>" />
		</td>
		<td valign="top">
        <p>Like our Facebook Page<br  /> 
        <div class="fb-like" data-href="<?php echo $graph->link;?>" data-send="false" data-width="450" data-show-faces="true" data-font="verdana"></div>
        </p>
        <p>
		Visit our Facebook Page<br  /> <a href="<?php echo $graph->link;?>" target="_blank" ><?php echo $graph->name;?></a>
        </p>
		</td>
	</tr>
</table >