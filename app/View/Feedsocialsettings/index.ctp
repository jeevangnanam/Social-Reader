<div class="feedsocialsettings index">
	<h2><?php echo __('Feedsocialsettings');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('feedrecord_id');?></th>
			<th><?php echo $this->Paginator->sort('facebook_id');?></th>
			<th><?php echo $this->Paginator->sort('on');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($feedsocialsettings as $feedsocialsetting): ?>
	<tr>
		<td><?php echo h($feedsocialsetting['Feedsocialsetting']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($feedsocialsetting['Feedrecord']['title'], array('controller' => 'feedrecords', 'action' => 'view', $feedsocialsetting['Feedrecord']['id'])); ?>
		</td>
		<td><?php echo h($feedsocialsetting['Feedsocialsetting']['facebook_id']); ?>&nbsp;</td>
		<td><?php echo h($feedsocialsetting['Feedsocialsetting']['on']); ?>&nbsp;</td>
		<td><?php echo h($feedsocialsetting['Feedsocialsetting']['created']); ?>&nbsp;</td>
		<td><?php echo h($feedsocialsetting['Feedsocialsetting']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $feedsocialsetting['Feedsocialsetting']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $feedsocialsetting['Feedsocialsetting']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $feedsocialsetting['Feedsocialsetting']['id']), null, __('Are you sure you want to delete # %s?', $feedsocialsetting['Feedsocialsetting']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Feedsocialsetting'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Feedrecords'), array('controller' => 'feedrecords', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feedrecord'), array('controller' => 'feedrecords', 'action' => 'add')); ?> </li>
	</ul>
</div>
