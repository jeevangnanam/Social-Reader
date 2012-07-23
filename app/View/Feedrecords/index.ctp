<div class="feedrecords index">
	<h2><?php echo __('Feedrecords');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('feed_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('link');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($feedrecords as $feedrecord): ?>
	<tr>
		<td><?php echo h($feedrecord['Feedrecord']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($feedrecord['Feed']['name'], array('controller' => 'feeds', 'action' => 'view', $feedrecord['Feed']['id'])); ?>
		</td>
		<td><?php echo h($feedrecord['Feedrecord']['title']); ?>&nbsp;</td>
		<td><?php echo h($feedrecord['Feedrecord']['description']); ?>&nbsp;</td>
		<td><?php echo h($feedrecord['Feedrecord']['link']); ?>&nbsp;</td>
		<td><?php echo h($feedrecord['Feedrecord']['date']); ?>&nbsp;</td>
		<td><?php echo h($feedrecord['Feedrecord']['status']); ?>&nbsp;</td>
		<td><?php echo h($feedrecord['Feedrecord']['created']); ?>&nbsp;</td>
		<td><?php echo h($feedrecord['Feedrecord']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $feedrecord['Feedrecord']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $feedrecord['Feedrecord']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $feedrecord['Feedrecord']['id']), null, __('Are you sure you want to delete # %s?', $feedrecord['Feedrecord']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Feedrecord'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Feeds'), array('controller' => 'feeds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feed'), array('controller' => 'feeds', 'action' => 'add')); ?> </li>
	</ul>
</div>
