<div class="polls form">
<?php echo $this->Form->create('Poll'); ?>
	<fieldset>
		<legend><?php echo __('Edit Poll'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('poll_text');
		echo $this->Form->input('answer_1');
		echo $this->Form->input('answer_2');
		echo $this->Form->input('percentage');
		echo $this->Form->input('tally_1');
		echo $this->Form->input('tally_2');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Poll.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Poll.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Polls'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Votes'), array('controller' => 'votes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vote'), array('controller' => 'votes', 'action' => 'add')); ?> </li>
	</ul>
</div>
