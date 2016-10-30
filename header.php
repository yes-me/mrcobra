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

<nav id="globalnav" class="globalnav">

	<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'nav-content', 'menu_id' => 'primary-menu', 'menu_class' => 'nav-list' ) ); ?>

</nav>
