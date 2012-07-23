<div class="channelsReaders index">
	<h2><?php echo __('Channels Readers');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('facebook_id');?></th>
			<th><?php echo $this->Paginator->sort('channel_id');?></th>
			<th><?php echo $this->Paginator->sort('socialon');?></th>
			<th><?php echo $this->Paginator->sort('isuninstalled');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($channelsReaders as $channelsReader): ?>
	<tr>
		<td><?php echo h($channelsReader['ChannelsReader']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($channelsReader['Reader']['id'], array('controller' => 'readers', 'action' => 'view', $channelsReader['Reader']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($channelsReader['Channel']['name'], array('controller' => 'channels', 'action' => 'view', $channelsReader['Channel']['id'])); ?>
		</td>
		<td><?php echo h($channelsReader['ChannelsReader']['socialon']); ?>&nbsp;</td>
		<td><?php echo h($channelsReader['ChannelsReader']['isuninstalled']); ?>&nbsp;</td>
		<td><?php echo h($channelsReader['ChannelsReader']['created']); ?>&nbsp;</td>
		<td><?php echo h($channelsReader['ChannelsReader']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $channelsReader['ChannelsReader']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $channelsReader['ChannelsReader']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $channelsReader['ChannelsReader']['id']), null, __('Are you sure you want to delete # %s?', $channelsReader['ChannelsReader']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Channels Reader'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Readers'), array('controller' => 'readers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reader'), array('controller' => 'readers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Channels'), array('controller' => 'channels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel'), array('controller' => 'channels', 'action' => 'add')); ?> </li>
	</ul>
</div>
