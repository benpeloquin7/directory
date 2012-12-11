<div class="hoodies view">
<h2><?php  echo __('Hoody'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($hoody['Hoody']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($hoody['User']['id'], array('controller' => 'users', 'action' => 'view', $hoody['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($hoody['Hoody']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Letter'); ?></dt>
		<dd>
			<?php echo h($hoody['Hoody']['letter']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Size'); ?></dt>
		<dd>
			<?php echo h($hoody['Hoody']['size']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Hoody'), array('action' => 'edit', $hoody['Hoody']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Hoody'), array('action' => 'delete', $hoody['Hoody']['id']), null, __('Are you sure you want to delete # %s?', $hoody['Hoody']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Hoodies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Hoody'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
