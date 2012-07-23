<div class="feedrecords form">
<?php echo $this->Form->create('Feedrecord');?>
	<fieldset>
		<legend><?php echo __('Add Feedrecord'); ?></legend>
	<?php
		echo $this->Form->input('feed_id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('link');
		echo $this->Form->input('date');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Feedrecords'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Feeds'), array('controller' => 'feeds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feed'), array('controller' => 'feeds', 'action' => 'add')); ?> </li>
	</ul>
</div>
