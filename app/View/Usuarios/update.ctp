<h1><?php echo __('Usuário'); ?></h1>

<div class="breadcrumb">
    <?php $this->Html->addCrumb(__('Usuarios'), '/Usuarios'); ?>
    <?php
    echo $this->Html->getCrumbs('&nbsp;/&nbsp;', array(
        'text' => $this->Html->tag('i', '', array('class' => 'fa fa-home')),
        'url' => array('controller' => 'Dashboard', 'action' => 'index'),
        'escape' => false
    ));
    ?>
</div>

<div class="alert alert-warning">
    <strong><?php echo __('Atenção'); ?>:</strong>
    <?php echo __('Os campos marcados com o símbolo de asterisco (*) são obrigatórios'); ?>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo __('Atualizar dados') ?></h3></div>
    <div class="panel-body">
    	<?php echo $this->Form->create('Usuario', array('action' => 'save', 'role' => 'form')); ?>

		<?php echo $this->Form->input('Usuario.nome', array('label' => __('Nome'), 'class' => 'form-control', 'div' => 'form-group')); ?>
		<?php echo $this->Form->input('Usuario.email', array('label' => __('Email'), 'class' => 'form-control', 'div' => 'form-group')); ?>
		<?php echo $this->Form->input('Usuario.ativo', array('label' => __('Ativo'), 'options' => array(0 => __('Não'), 1 => __('Sim')), 'default' => 1, 'class' => 'form-control', 'div' => 'form-group')); ?>
		
		<?php echo $this->Form->hidden('id'); ?>
		
		<button type="submit" class="btn btn-sm btn-primary">
		    <i class="fa fa-save"></i>  <?php echo __('Salvar'); ?>
		</button>
		
		<a href="<?php echo $this->Session->read('urlBack'); ?>" class="btn btn-sm btn-default">
		    <i class="fa fa-undo"></i> <?php echo __('Cancelar'); ?>
		</a>
		
		<?php echo $this->Form->end(); ?>
    </div>
 </div>
 
 <div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo __('Atualizar senha') ?></h3></div>
    <div class="panel-body">
    	<?php echo $this->Form->create('Usuario', array('action' => 'save', 'role' => 'form')); ?>

		<?php echo $this->Form->input('Usuario.senha', array('label' => __('Senha'), 'value' => false, 'class' => 'form-control', 'div' => 'form-group')); ?>
		
		<?php echo $this->Form->hidden('id'); ?>
		
		<button type="submit" class="btn btn-sm btn-primary">
		    <i class="fa fa-save"></i>  <?php echo __('Salvar'); ?>
		</button>
		
		<a href="<?php echo $this->Session->read('urlBack'); ?>" class="btn btn-sm btn-default">
		    <i class="fa fa-undo"></i> <?php echo __('Cancelar'); ?>
		</a>
		
		<?php echo $this->Form->end(); ?>
    </div>
 </div>




