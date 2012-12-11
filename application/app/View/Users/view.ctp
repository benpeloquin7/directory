<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time'); ?></dt>
		<dd>
			<?php echo h($user['User']['time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Hoodies'), array('controller' => 'hoodies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Hoody'), array('controller' => 'hoodies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Polls'), array('controller' => 'polls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Poll'), array('controller' => 'polls', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Votes'), array('controller' => 'votes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vote'), array('controller' => 'votes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Hoodies'); ?></h3>
	<?php if (!empty($user['Hoody'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Letter'); ?></th>
		<th><?php echo __('Size'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Hoody'] as $hoody): ?>
		<tr>
			<td><?php echo $hoody['id']; ?></td>
			<td><?php echo $hoody['user_id']; ?></td>
			<td><?php echo $hoody['created']; ?></td>
			<td><?php echo $hoody['letter']; ?></td>
			<td><?php echo $hoody['size']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'hoodies', 'action' => 'view', $hoody['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'hoodies', 'action' => 'edit', $hoody['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'hoodies', 'action' => 'delete', $hoody['id']), null, __('Are you sure you want to delete # %s?', $hoody['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Hoody'), array('controller' => 'hoodies', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Polls'); ?></h3>
	<?php if (!empty($user['Poll'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Poll Text'); ?></th>
		<th><?php echo __('Answer 1'); ?></th>
		<th><?php echo __('Answer 2'); ?></th>
		<th><?php echo __('Percentage'); ?></th>
		<th><?php echo __('Tally 1'); ?></th>
		<th><?php echo __('Tally 2'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Poll'] as $poll): ?>
		<tr>
			<td><?php echo $poll['id']; ?></td>
			<td><?php echo $poll['title']; ?></td>
			<td><?php echo $poll['poll_text']; ?></td>
			<td><?php echo $poll['answer_1']; ?></td>
			<td><?php echo $poll['answer_2']; ?></td>
			<td><?php echo $poll['percentage']; ?></td>
			<td><?php echo $poll['tally_1']; ?></td>
			<td><?php echo $poll['tally_2']; ?></td>
			<td><?php echo $poll['created']; ?></td>
			<td><?php echo $poll['modified']; ?></td>
			<td><?php echo $poll['user_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'polls', 'action' => 'view', $poll['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'polls', 'action' => 'edit', $poll['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'polls', 'action' => 'delete', $poll['id']), null, __('Are you sure you want to delete # %s?', $poll['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Poll'), array('controller' => 'polls', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Votes'); ?></h3>
	<?php if (!empty($user['Vote'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Poll Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Answer'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Vote'] as $vote): ?>
		<tr>
			<td><?php echo $vote['id']; ?></td>
			<td><?php echo $vote['poll_id']; ?></td>
			<td><?php echo $vote['user_id']; ?></td>
			<td><?php echo $vote['answer']; ?></td>
			<td><?php echo $vote['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'votes', 'action' => 'view', $vote['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'votes', 'action' => 'edit', $vote['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'votes', 'action' => 'delete', $vote['id']), null, __('Are you sure you want to delete # %s?', $vote['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vote'), array('controller' => 'votes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
