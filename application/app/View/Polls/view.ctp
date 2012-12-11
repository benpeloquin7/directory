<div class="polls view">
<h2><?php  echo __('Poll'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($poll['Poll']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($poll['Poll']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Poll Text'); ?></dt>
		<dd>
			<?php echo h($poll['Poll']['poll_text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer 1'); ?></dt>
		<dd>
			<?php echo h($poll['Poll']['answer_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer 2'); ?></dt>
		<dd>
			<?php echo h($poll['Poll']['answer_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Percentage'); ?></dt>
		<dd>
			<?php echo h($poll['Poll']['percentage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tally 1'); ?></dt>
		<dd>
			<?php echo h($poll['Poll']['tally_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tally 2'); ?></dt>
		<dd>
			<?php echo h($poll['Poll']['tally_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($poll['Poll']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($poll['Poll']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($poll['User']['id'], array('controller' => 'users', 'action' => 'view', $poll['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Poll'), array('action' => 'edit', $poll['Poll']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Poll'), array('action' => 'delete', $poll['Poll']['id']), null, __('Are you sure you want to delete # %s?', $poll['Poll']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Polls'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Poll'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Votes'), array('controller' => 'votes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vote'), array('controller' => 'votes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Votes'); ?></h3>
	<?php if (!empty($poll['Vote'])): ?>
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
		foreach ($poll['Vote'] as $vote): ?>
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
