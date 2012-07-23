<div class="feedsocialsettings form">
<?php echo $this->Form->create('Feedsocialsetting');?>
	<fieldset>
		<legend><?php echo __('Add Feedsocialsetting'); ?></legend>
	<?php
		echo $this->Form->input('feedrecord_id');
		echo $this->Form->input('facebook_id');
		echo $this->Form->input('on');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Feedsocialsettings'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Feedrecords'), array('controller' => 'feedrecords', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feedrecord'), array('controller' => 'feedrecords', 'action' => 'add')); ?> </li>
	</ul>
</div>
