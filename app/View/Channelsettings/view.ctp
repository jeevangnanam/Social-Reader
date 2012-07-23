<div class="channelsettings view">
<h2><?php  echo __('Channelsetting');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($channelsetting['Channelsetting']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Channel'); ?></dt>
		<dd>
			<?php echo $this->Html->link($channelsetting['Channel']['name'], array('controller' => 'channels', 'action' => 'view', $channelsetting['Channel']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Maxshareperday'); ?></dt>
		<dd>
			<?php echo h($channelsetting['Channelsetting']['maxshareperday']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Channelsetting'), array('action' => 'edit', $channelsetting['Channelsetting']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Channelsetting'), array('action' => 'delete', $channelsetting['Channelsetting']['id']), null, __('Are you sure you want to delete # %s?', $channelsetting['Channelsetting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Channelsettings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channelsetting'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Channels'), array('controller' => 'channels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel'), array('controller' => 'channels', 'action' => 'add')); ?> </li>
	</ul>
</div>
