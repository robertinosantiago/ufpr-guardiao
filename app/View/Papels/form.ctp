<h1><?php echo __('Papéis'); ?></h1>

<div class="breadcrumb">
    <?php $this->Html->addCrumb(__('Papéis'), '/Papels'); ?>
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

<?php echo $this->Form->create('Papel', array('action' => 'save', 'role' => 'form')); ?>

<?php echo $this->Form->input('Papel.titulo', array('label' => __('Título'), 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('Papel.descricao', array('label' => __('Descrição'), 'class' => 'form-control', 'div' => 'form-group')); ?>

<?php echo $this->Form->hidden('id'); ?>

<button type="submit" class="btn btn-sm btn-primary">
    <i class="fa fa-save"></i>  <?php echo __('Salvar'); ?>
</button>

<a href="<?php echo $this->Session->read('urlBack'); ?>" class="btn btn-sm btn-default">
    <i class="fa fa-undo"></i> <?php echo __('Cancelar'); ?>
</a>

<?php echo $this->Form->end(); ?>


