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

<div class="alert alert-warning">
    <strong><?php echo __('Atenção'); ?>:</strong>
    <?php echo __('Os campos marcados com o símbolo de asterisco (*) são obrigatórios'); ?>
</div>

<?php echo $this->Form->create('Sistema', array('action' => 'save', 'role' => 'form')); ?>

<?php echo $this->Form->input('Sistema.nome', array('label' => __('Nome'), 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('Sistema.descricao', array('label' => __('Descrição'), 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('Sistema.ativo', array('label' => __('Ativo'), 'options' => array(0 => __('Não'), 1 => __('Sim')), 'default' => 1, 'class' => 'form-control', 'div' => 'form-group')); ?>

<?php echo $this->Form->hidden('id'); ?>

<button type="submit" class="btn btn-sm btn-primary">
    <i class="fa fa-save"></i>  <?php echo __('Salvar'); ?>
</button>

<a href="<?php echo $this->Session->read('urlBack'); ?>" class="btn btn-sm btn-default">
    <i class="fa fa-undo"></i> <?php echo __('Cancelar'); ?>
</a>

<?php echo $this->Form->end(); ?>


