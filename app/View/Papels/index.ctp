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

<a href="<?php echo $this->Html->url(array('action' => 'form')); ?>" title="<?php echo __('Novo') ?>" class="btn btn-sm btn-primary">
    <i class="fa fa-plus"></i> <?php echo __('Novo') ?>
</a>

<?php echo $this->SearchBox->makeSearchBox(array('action' => 'index'), $query, isset($activeClear)); ?>

<?php echo $this->Form->create('Papel', array('id' => 'formindex', 'action' => 'deleteMany')) ?>
<table class="table table-striped table-hover table-condensed">
    <caption style="display: none;">
        <?php echo $this->Form->postLink('', array()); ?>
    </caption>
    <thead>
        <tr>
            <th class="check text-center"><input id="checkall" name="selall" type="checkbox" /></th>
            <th class="text-left"><?php echo __('Título'); ?></th>
            <th class="acoes text-center"></th>
            <th class="acoes text-center"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($records)): ?>
        <tr>
            <td colspan="4"><?php echo __('Não há dados a exibir'); ?></td>
        </tr>
        <?php else: ?>
            <?php foreach ($records as $record) : ?>
            <tr>
                <td class="text-center">
                    <?php echo $this->Form->checkbox('Records.id.' . $record['Papel']['id'] . '', array('label' => false, 'value' => $record['Papel']['id'], 'class' => 'ids', 'hiddenField' => false)); ?>
                </td>
                <td class="text-left"><?php echo $record['Papel']['titulo']; ?></td>
                <td class="text-center">
                    <?php echo $this->Form->postLink(__("<i class='fa fa-pencil'></i>"), array('action' => 'update', $record['Papel']['id']), array('class' => 'btn btn-sm btn-warning', 'title' => __('Editar'), 'escape' => false)); ?>
                </td>
                <td class="text-center">                    
                    <?php echo $this->Form->postLink(__("<i class='fa fa-trash-o'></i>"), array('action' => 'delete', $record['Papel']['id']), array('class' => 'btn btn-sm btn-danger', 'title' => __('Excluir'), 'escape' => false, 'confirm' => __('Você deseja realmente excluir?'))); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <?php if (!empty($records)): ?>
        <tr>
            <th class="esquerda" colspan="4">
                <button class="btn btn-sm btn-danger" type="submit" id="btn-excluir-varios">
                    <i class="fa fa-trash-o"></i> <?php echo __('Excluir selecionados'); ?>
                </button>
            </th>
        </tr>
        <tr>
            <td colspan="4">
                <ul class="pagination pagination-sm">
                    <?php echo $this->Paginator->numbers(array('first' => 3, 'last' => 3, 'ellipsis' => '<li class="disabled"><a>...</a></li>', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active', 'modulus' => 2, 'separator' => false)); ?>
                </ul>
            </td>
        </tr>
        <?php endif; ?>
    </tfoot>
</table>

<?php echo $this->Form->end(); ?>

<?php $this->start('scripts'); ?>
    <?php echo $this->Html->script('script-index'); ?>
<?php $this->end(); ?>
