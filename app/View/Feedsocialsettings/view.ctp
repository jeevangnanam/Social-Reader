<div class="feedsocialsettings view">
<h2><?php  echo __('Feedsocialsetting');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($feedsocialsetting['Feedsocialsetting']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Feedrecord'); ?></dt>
		<dd>
			<?php echo $this->Html->link($feedsocialsetting['Feedrecord']['title'], array('controller' => 'feedrecords', 'action' => 'view', $feedsocialsetting['Feedrecord']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Facebook Id'); ?></dt>
		<dd>
			<?php echo h($feedsocialsetting['Feedsocialsetting']['facebook_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('On'); ?></dt>
		<dd>
			<?php echo h($feedsocialsetting['Feedsocialsetting']['on']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($feedsocialsetting['Feedsocialsetting']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($feedsocialsetting['Feedsocialsetting']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Feedsocialsetting'), array('action' => 'edit', $feedsocialsetting['Feedsocialsetting']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Feedsocialsetting'), array('action' => 'delete', $feedsocialsetting['Feedsocialsetting']['id']), null, __('Are you sure you want to delete # %s?', $feedsocialsetting['Feedsocialsetting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Feedsocialsettings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feedsocialsetting'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Feedrecords'), array('controller' => 'feedrecords', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feedrecord'), array('controller' => 'feedrecords', 'action' => 'add')); ?> </li>
	</ul>
</div>
