<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
use lithium\util\Inflector;
?>
<!doctype html>
<html>
	<head>
		<!-- Title intentionally left blank, forcing user agents use the current URL as title. -->
		<title></title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="<?php echo $commonPath; ?>bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo $commonPath; ?>bootstrap/css/bootstrap-responsive.css" />
		<link rel="stylesheet" href="<?php echo $basePath; ?>css/tests.css" />
		<link href="<?php echo $baseUrl; ?>favicon.ico" type="image/x-icon" rel="icon" />
		<link href="<?php echo $baseUrl; ?>favicon.ico" type="image/x-icon" rel="shortcut icon" />
		<style type="text/css">
			body {
				padding-top: 40px;
				padding-bottom: 40px;
			}
			.logo {
				float: left;
			}
		</style>
	</head>
	<body class="lithium-test">
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<span class="brand">Lithium</span>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li><a href="<?=$request->env('base'); ?>">Home</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<header class="page-header">
				<h1><a href="<?=$baseUrl; ?>">Test Dashboard</a></h1>
			</header>

			<div class="row">
				<nav class="span2">
					<div class="well" style="padding: 8px 0;">
						<?php echo $report->render("libraries", array("menu" => $menu, "library" => $library, "baseUrl" => $baseUrl, "libraries" => $libraries)) ?>
					</div>
				</nav>

				<article class="span10">
					<?php if ($report->title) : ?>
					<div class="test-content">
						<div class="row">
							<div class="span10">
								<h2><span>test results for </span><?php echo $report->title; ?></h2>
								<span class="filters">
								<?php
									echo join('', array_map(
											function($class) use ($request) {
												$url = "?filters[]={$class}";
												$name = join('', array_slice(explode("\\", $class), -1));
												$isActive = (
													isset($request->query['filters']) &&
													array_search($class, $request->query['filters']) !== false
													);
												$active = $isActive ? 'active' : null;
												return "<a class=\"btn btn-info {$active}\" href=\"{$url}\">{$name}</a> ";
											},
											$filters
									));
								?>
								</span>
							</div>
						</div>
						<?php
							echo $report->render("stats");

							foreach ($report->filters() as $filter => $options) {
								$data = $report->results['filters'][$filter];
								echo $report->render($options['name'], compact('data', 'baseUrl'));
							}
						?>
					</div>
					<?php else: ?>
						<?php echo $report->render("menu", array("menu" => $menu, "baseUrl" => $baseUrl)) ?>
					<?php endif; ?>
				</article>
			</div>
		</div>
	</body>
</html>