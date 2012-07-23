<div id="globalConfigurations">
<div class='headings'>
 Global configurations
 <div class='showStatus'></div>
</div>
<div id="socialVisibility" >
<?php
if($globalSocialStatusForThisApp == true){
	
	$img = 'on.png';
	}else{
	$img = 'off.png';	
		}
?>

<p>Your Global Social Visibility   is </p><div class='imageHolder'><img src="/appproperties/<?php echo $layout; ?>/img/<?php echo $img; ?>"  id="changeGlobalSocialVisibility" rel="<?php echo $channelId; ?>" name="<?php echo $layout; ?>" /></div>

</div>

<div id="postPerDay">
This app may share some of the article you read on this site.
Maximum number of the articles per days is 

<div class='imageHolder' style="margin-top:10px;">
<select name="" id="" style="height:25px;width:45px;border:solid 1px #B4C9F1">

<?php for($a =1; $a<4 ;$a++): ?>
<option id="<?php echo $a; ?>"><?php echo $a; ?></option>

<?php endfor; ?>
</select>
</div>
<br />
<br />
<br />
</div>


</div>