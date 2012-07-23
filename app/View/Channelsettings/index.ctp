<div class="channelsettings index">
	<h2><?php echo __('Channelsettings');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('channel_id');?></th>
			<th><?php echo $this->Paginator->sort('maxshareperday');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($channelsettings as $channelsetting): ?>
	<tr>
		<td><?php echo h($channelsetting['Channelsetting']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($channelsetting['Channel']['name'], array('controller' => 'channels', 'action' => 'view', $channelsetting['Channel']['id'])); ?>
		</td>
		<td><?php echo h($channelsetting['Channelsetting']['maxshareperday']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $channelsetting['Channelsetting']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $channelsetting['Channelsetting']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $channelsetting['Channelsetting']['id']), null, __('Are you sure you want to delete # %s?', $channelsetting['Channelsetting']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Channelsetting'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Channels'), array('controller' => 'channels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Channel'), array('controller' => 'channels', 'action' => 'add')); ?> </li>
	</ul>
</div>
