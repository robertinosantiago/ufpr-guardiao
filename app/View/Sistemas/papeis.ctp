<h1><?php echo __('Sistema'); ?></h1>

<div class="breadcrumb">
    <?php $this->Html->addCrumb(__('Sistemas'), '/Sistemas'); ?>
    <?php
    echo $this->Html->getCrumbs('&nbsp;/&nbsp;', array(
        'text' => $this->Html->tag('i', '', array('class' => 'fa fa-home')),
        'url' => array('controller' => 'Dashboard', 'action' => 'index'),
        'escape' => false
    ));
    ?>
</div>

<h3>
	<?php echo $sistema['Sistema']['nome']; ?><br>
	<small><?php echo $sistema['Sistema']['descricao']; ?></small>
</h3>

<div class="adiciona-papel">
	<?php echo $this->Form->create('Sistema'); ?>
	<div class="input-group">
		<?php echo $this->Form->input('Papel', array('label' => __('Papel'), 'class' => 'form-control', 'div' => false)); ?>
		<div class="input-group-btn">
			<button class="btn btn-success" type="button" id="bt-adiciona-papel">
				<i class="fa fa-plus"></i> <?php echo __('Adicionar'); ?>
			</button>
		</div>
	</div>
	<?php echo $this->Form->hidden('id', array('value' => $sistema['Sistema']['id'])); ?>
	<?php echo $this->Form->end(); ?>
</div>

<div class="papeis-sistemas">
	<?php echo $this->Form->create('Sistema'); ?>
	
	<?php echo $this->Form->input('Papels', array('label' => __('Papeis atribuídos ao sistema'), 'options' => $papels_sistema, 'size' => 5, 'class' => 'form-control', 'div' => 'form-group')); ?>
	
	<button class="btn btn-danger" type="button" id="bt-remove-papel">
		<i class="fa fa-minus"></i> <?php echo __('Remover'); ?>
	</button>
	
	<?php echo $this->Form->hidden('id', array('value' => $sistema['Sistema']['id'])); ?>
	<?php echo $this->Form->end(); ?>
</div>

<?php $this->start('scripts'); ?>
    <?php echo $this->Html->script('papeis'); ?>
<?php $this->end(); ?>