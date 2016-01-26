<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php echo 'UFPR::Guardião::'.$this->fetch('title'); ?>
	</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/metisMenu/2.2.0/metisMenu.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


	<?php
    echo $this->Html->css('main');
    echo $this->fetch('css');
  ?>

</head>

<body>
	<div id="geral">
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">
					<?php echo __('Guardião'); ?>
				</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->

			<ul class="nav navbar-top-links navbar-right">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
						<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
						<li class="divider"></li>
						<li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
					</ul>
					<!-- /.dropdown-user -->
				</li>
			</ul>
			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<li class="first-level" id="li-dashboard">
							<a href="<?php echo $this->Html->url(array('controller' => 'Dashboard', 'action' => 'index')); ?>">
                				<i class="fa fa-dashboard fa-fw"></i> <?php echo __('Dashboard'); ?>
              				</a>
						</li>
						<li class="first-level" id="li-cadastros">
							<a href="#"><i class="fa fa-newspaper-o fa-fw"></i> <?php echo __('Cadastros'); ?><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li class="second-level" id="li-nivel">
									<a href="<?php echo $this->Html->url(array('controller' => 'Nivels', 'action' => 'index')); ?>"><?php echo __('Níveis'); ?></a>
								</li>
								<li class="second-level">
									<a href="morris.html">Morris.js Charts</a>
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>
					</ul>
				</div>
			</div>

		</nav>
		<div id="conteudo" style="min-height: 332px">
			<div class="row">
				<div class="col-lg-12">
					<?php
            		echo $this->Session->flash();
            		echo $this->fetch('content');
          			?>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/metisMenu/2.2.0/metisMenu.min.js"></script>
	<!--[if lt IE 9]>
  	<script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
  	<![endif]-->
  	<script type="text/javascript">
    	jQuery(document).ready(function () {
        	window.setTimeout(function () {
            	$(".alert-removable").fadeTo(500, 0).slideUp(500, function () {
                	$(this).remove();
                });
            }, 5000);
        });
    </script>
	<?php
	echo $this->Html->script('js.cookie');
    echo $this->Html->script('main');
    echo $this->fetch('script');
  	?>
  	<?php 
  	if ($this->fetch('scripts')): 
    	echo $this->fetch('scripts');
	endif; 
	?>
	<?php echo $this->element('sql_dump'); ?>
</body>

</html>
