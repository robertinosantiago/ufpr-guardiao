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

<div class="alert alert-info">
	<h3>
		<?php echo $sistema['Sistema']['nome']; ?><br>
		<small><?php echo $sistema['Sistema']['descricao']; ?></small><br>
		<small><?php echo __('Hash'); ?>: <strong><?php echo $sistema['Sistema']['hash']; ?></strong> </small>
	</h3>
	<?php echo $this->Form->postLink("<i class='fa fa-users'></i> ".__('Usuários'), array('action' => 'usuarios', $sistema['Sistema']['id']), array('class' => 'btn btn-sm btn-info', 'title' => __('Usuários'), 'escape' => false)); ?>
    <?php echo $this->Form->postLink("<i class='fa fa-shield'></i> ".__('Papéis'), array('action' => 'papeis', $sistema['Sistema']['id']), array('class' => 'btn btn-sm btn-success', 'title' => __('Papéis'), 'escape' => false)); ?>
</div>


<div class="adiciona-nivel">
	<?php echo $this->Form->create('Sistema'); ?>
	<div class="input-group">
		<?php echo $this->Form->input('Nivel', array('label' => __('Nivel'), 'class' => 'form-control', 'div' => false)); ?>
		<div class="input-group-btn">
			<button class="btn btn-success" type="button" id="bt-adiciona-nivel">
				<i class="fa fa-plus"></i> <?php echo __('Adicionar'); ?>
			</button>
		</div>
	</div>
	<?php echo $this->Form->hidden('id', array('value' => $sistema['Sistema']['id'])); ?>
	<?php echo $this->Form->end(); ?>
</div>

<div class="papeis-sistemas">
	<?php echo $this->Form->create('Sistema'); ?>
	
	<?php echo $this->Form->input('Nivels', array('label' => __('Níveis de acesso atribuídos ao sistema'), 'options' => $nivels_sistema, 'size' => 5, 'class' => 'form-control', 'div' => 'form-group')); ?>
	
	<button class="btn btn-danger" type="button" id="bt-remove-nivel">
		<i class="fa fa-minus"></i> <?php echo __('Remover'); ?>
	</button>
	
	<?php echo $this->Form->hidden('id', array('value' => $sistema['Sistema']['id'])); ?>
	<?php echo $this->Form->end(); ?>
</div>

<?php $this->start('scripts'); ?>
    <?php echo $this->Html->script('niveis'); ?>
<?php $this->end(); ?>