<div class="feeds form">
<?php echo $this->Form->create('Feed');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Feed'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('channel_id');
		echo $this->Form->input('path');
		echo $this->Form->input('type');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Feed.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Feed.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Feeds'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Channels'), array('controller' => 'channels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel'), array('controller' => 'channels', 'action' => 'add')); ?> </li>
	</ul>
</div>
