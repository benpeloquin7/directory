<div class="polls index">
	<h2><?php echo __('Polls'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('poll_text'); ?></th>
			<th><?php echo $this->Paginator->sort('answer_1'); ?></th>
			<th><?php echo $this->Paginator->sort('answer_2'); ?></th>
			<th><?php echo $this->Paginator->sort('percentage'); ?></th>
			<th><?php echo $this->Paginator->sort('tally_1'); ?></th>
			<th><?php echo $this->Paginator->sort('tally_2'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($polls as $poll): ?>
	<tr>
		<td><?php echo h($poll['Poll']['id']); ?>&nbsp;</td>
		<td><?php echo h($poll['Poll']['title']); ?>&nbsp;</td>
		<td><?php echo h($poll['Poll']['poll_text']); ?>&nbsp;</td>
		<td><?php echo h($poll['Poll']['answer_1']); ?>&nbsp;</td>
		<td><?php echo h($poll['Poll']['answer_2']); ?>&nbsp;</td>
		<td><?php echo h($poll['Poll']['percentage']); ?>&nbsp;</td>
		<td><?php echo h($poll['Poll']['tally_1']); ?>&nbsp;</td>
		<td><?php echo h($poll['Poll']['tally_2']); ?>&nbsp;</td>
		<td><?php echo h($poll['Poll']['created']); ?>&nbsp;</td>
		<td><?php echo h($poll['Poll']['modified']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($poll['User']['id'], array('controller' => 'users', 'action' => 'view', $poll['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $poll['Poll']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $poll['Poll']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $poll['Poll']['id']), null, __('Are you sure you want to delete # %s?', $poll['Poll']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Poll'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Votes'), array('controller' => 'votes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vote'), array('controller' => 'votes', 'action' => 'add')); ?> </li>
	</ul>
</div>
