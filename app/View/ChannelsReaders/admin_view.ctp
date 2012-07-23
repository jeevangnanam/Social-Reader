<div class="channelsReaders view">
<h2><?php  echo __('Channels Reader');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($channelsReader['ChannelsReader']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reader'); ?></dt>
		<dd>
			<?php echo $this->Html->link($channelsReader['Reader']['id'], array('controller' => 'readers', 'action' => 'view', $channelsReader['Reader']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Channel'); ?></dt>
		<dd>
			<?php echo $this->Html->link($channelsReader['Channel']['name'], array('controller' => 'channels', 'action' => 'view', $channelsReader['Channel']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Socialon'); ?></dt>
		<dd>
			<?php echo h($channelsReader['ChannelsReader']['socialon']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Isuninstalled'); ?></dt>
		<dd>
			<?php echo h($channelsReader['ChannelsReader']['isuninstalled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($channelsReader['ChannelsReader']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($channelsReader['ChannelsReader']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Channels Reader'), array('action' => 'edit', $channelsReader['ChannelsReader']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Channels Reader'), array('action' => 'delete', $channelsReader['ChannelsReader']['id']), null, __('Are you sure you want to delete # %s?', $channelsReader['ChannelsReader']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Channels Readers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channels Reader'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Readers'), array('controller' => 'readers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reader'), array('controller' => 'readers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Channels'), array('controller' => 'channels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel'), array('controller' => 'channels', 'action' => 'add')); ?> </li>
	</ul>
</div>
