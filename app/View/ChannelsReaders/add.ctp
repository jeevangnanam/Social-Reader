<div class="channelsReaders form">
<?php echo $this->Form->create('ChannelsReader');?>
	<fieldset>
		<legend><?php echo __('Add Channels Reader'); ?></legend>
	<?php
		echo $this->Form->input('facebook_id');
		echo $this->Form->input('channel_id');
		echo $this->Form->input('socialon');
		echo $this->Form->input('isuninstalled');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Channels Readers'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Readers'), array('controller' => 'readers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reader'), array('controller' => 'readers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Channels'), array('controller' => 'channels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel'), array('controller' => 'channels', 'action' => 'add')); ?> </li>
	</ul>
</div>
