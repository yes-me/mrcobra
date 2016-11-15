<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>
		<?php wp_title( '|', true, 'right' ); ?>
	</title>

	<?php wp_head();?>
</head>

<body>


<input type="checkbox" id="nav-trigger" class="nav-trigger" />
<nav id="globalnav" class="globalnav">

	<div class="nav-container">
		<ul class="menu-trigger">
			<li class="menu-trigger-list menu-icon">

				<label class="nav-trigger-label" for="nav-trigger" aria-hidden="true">
					<span class="nav-trigger-label-top">
						<span class="nav-trigger-label-top-line"></span>
					</span>
					<span class="nav-trigger-label-bottom">
						<span class="nav-trigger-label-bottom-line"></span>
					</span>
				</label>
			</li>
			<li class="menu-trigger-list logo">
				<a class="site-logo" alt="Mr Cobra" title="Mr Cobra" href="/">
					<span class="title-logo">MrCobra</span>
				</a>
			</li>
		</ul>
		<a class="site-logo " alt="Mr Cobra" title="Mr Cobra" href="/">
			<span class="title-logo">MrCobra</span>
		</a>

		<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'nav-content', 'menu_id' => 'primary-menu', 'menu_class' => 'nav-list' ) ); ?>
	</div>
</nav>
