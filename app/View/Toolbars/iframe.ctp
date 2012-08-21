<?php
if(isset($globalSocialStatusForThisApp) && $globalSocialStatusForThisApp == true){
	
	$img = 'on.png';
	}else{
	$img = 'off.png';	
	}
?>

<?php if($facebook_installed == 'no'): ?>

<table width='280'  height='60' border='0' cellpadding='5' cellspacing='0' style="background:#ffffff url('http://globalsocialreader.com/img/toolbar/toolbar-bg.jpg') no-repeat right top;"><tr>
<td><a href='<?php echo $canvas_url; ?>' target='_blank'><img src="http://globalsocialreader.com/appproperties/<?php echo $channelName; ?>/img/install_icon.jpg"  border="0"/></a></td>
</tr></table>

<?php else: ?>
<table width='280'  height='60' border='0' cellpadding='5' cellspacing='0' style="background:#ffffff url('http://globalsocialreader.com/img/toolbar/toolbar-bg.jpg') no-repeat right top;"><tr><td width='47' rowspan="2"><img width='35' height='35' src='http://graph.facebook.com/<?php echo $id; ?>/picture'></td>
<td width='189' align="left"><font size="1em">Your  global social visibility is </font></td>
<td width='14'></td></tr>
  <tr>
    <td align="left"><img src='http://globalsocialreader.com/img/toolbar/<?php echo $img;?>' alt='On' width='62' height='27' id="changeGlobalSocialVisibility" rel="<?php echo $channelId; ?>" name="<?php echo $channelName; ?>" /></td>
    <td width='14'><a href='<?php echo $canvas_url; ?>' target='_blank'><img src="http://globalsocialreader.com/appproperties/<?php echo $channelName; ?>/img/mini_icon_options.gif"  border="0"/></a></td>
  </tr>
</table>

<?php endif; ?>