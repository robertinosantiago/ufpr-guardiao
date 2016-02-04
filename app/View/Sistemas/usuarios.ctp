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
		<small><?php echo $sistema['Sistema']['descricao']; ?></small>
	</h3>
	<?php echo $this->Form->postLink("<i class='fa fa-shield'></i> ".__('Papéis'), array('action' => 'papeis', $sistema['Sistema']['id']), array('class' => 'btn btn-sm btn-success', 'title' => __('Papéis'), 'escape' => false)); ?>
    <?php echo $this->Form->postLink("<i class='fa fa-sitemap'></i> ".__('Níveis de acesso'), array('action' => 'niveis', $sistema['Sistema']['id']), array('class' => 'btn btn-sm btn-primary', 'title' => __('Papéis'), 'escape' => false)); ?>
</div>

<?php echo $this->Form->create('Sistema'); ?>
<div class="row">
	<div class="col-lg-4">
		<?php echo $this->Form->input('Usuarios', array('label' => __('Usuários'), 'size' => 15, 'multiple' => true, 'class' => 'form-control', 'div' => 'form-group')); ?>
	</div>
	<div class="col-lg-4">
		<div class="row">
			<div class="col-lg-12">
				<?php echo $this->Form->input('Nivels', array('label' => __('Níveis de acesso'), 'class' => 'form-control', 'div' => 'form-group')); ?>
				<?php echo $this->Form->input('Papels', array('label' => __('Papel'), 'class' => 'form-control', 'div' => 'form-group')); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="botoes text-center">
			<button class="btn btn-primary" id="bt-adicionar-usuario">
				<i class="fa fa-arrow-right"></i> <?php echo __('Adicionar') ;?>
			</button>
			<br>
			<br>
			<button class="btn btn-primary" id="bt-remover-usuario">
				<i class="fa fa-arrow-left"></i> <?php echo __('Remover') ;?>
			</button>
		</div>	
			</div>
		</div>
		
	</div>
	<div class="col-lg-4">
		<?php echo $this->Form->input('NivelPapelSistemaUsuarios', array('label' => __('Usuários do sistema'), 'options' => $usuarios_sistema, 'size' => 15, 'multiple' => true, 'class' => 'form-control', 'div' => 'form-group')); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<?php $this->start('scripts'); ?>
    <?php echo $this->Html->script('usuarios'); ?>
<?php $this->end(); ?>


