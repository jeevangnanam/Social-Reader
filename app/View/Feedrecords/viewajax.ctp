<div id="lightboxContent">
		<dd>
			<b><?php echo h($feedrecord['Feedrecord']['title']); ?></b>
                        <br />
			&nbsp;
		</dd>
		
		<dd>
			<?php echo $feedrecord['Feedrecord']['description']; ?>
			<br /><br /><br />
		</dd>
                <div style="clear: both"></div>
                <div id="preRouteToolBar" style="margin-top: 10px;padding-top:6px;border-top:solid 1px   #dee0e0">
                    <div id="visibleButtonHolder" style="float:left">
                        <p style="padding-bottom: 8px;float:left;">Your Social visibility for this article is&nbsp;&nbsp;</p>
    <?php if($socialOn==true): ?>
<img src="/img/icons/on_small.jpg"  rel="<?php echo $feedrecord['Feedrecord']['id']; ?>" class="changeFeedrecordSocialStatus" style="cursor:pointer"/>
                    <?php elseif($socialOn == false): ?>
<img src="/img/icons/off_small.jpg" rel="<?php echo $feedrecord['Feedrecord']['id']; ?>" class="changeFeedrecordSocialStatus" style="cursor:pointer"/>
                    <?php endif; ?>
                    </div>

                    <div style="float:right;">
                        <a href="<?php echo $feedrecord['Feedrecord']['link']; ?>"  target="_blank"><img src="/img/icons/continue.jpg"  id="shareIt" rel="<?php echo $feedrecord['Feedrecord']['id']; ?>" /></a>
                    </div>
                </div>
</div>
<div id="test">
    
</div>