<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<!doctype html>
<html>
	<head>
	<?=$this->html->charset(); ?>
		<title>Application > <?php echo $this->title(); ?></title>
		<?=$this->html->style(array('/bootstrap/css/bootstrap.css', '/bootstrap/css/bootstrap-responsive.css'), array('scope' => 'commons'));?>
		<?=$this->html->style(array('/css/splash.css'));?>
		<?=$this->html->link('Icon', null, array('type' => 'icon'));?>
		<style type="text/css">
			body {
				padding-top: 40px;
				padding-bottom: 40px;
			}
			.logo {
				float: left;
			}
			@media (min-width: 0px) and (max-width: 980px) {
				body {
					padding-top: 0px;
					padding-bottom: 0px;
				}
			}
		</style>
	</head>
	<body class="lithium-splash">
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<span class="brand">Lithium</span>
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li><?=$this->html->link('App', '/', array('scope' => 'app')); ?></li>
							<li><?=$this->html->link('Test dashboard', '/test', array('scope' => 'test')); ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<header class="page-header">
				<h1><?= $this->html->link('Administration', '/'); ?></h1>
			</header>
			<b>
				Powered by <?php echo $this->html->link('Lithium', 'http://lithify.me/'); ?>.
			</b>
			<div id="content">
				<?php echo $this->content(); ?>
			</div>
		</div>
		<?php
		echo $this->scripts();
		?>
	</body>
</html>