<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mrcobra
 */

?>

<header class="entry-header">

	<div class="intro">

		<?php the_title( '<h1 class="title">', '</h1>' ); ?>

		<?php if( get_field('description') ): ?>
			<div class="description"> <?php the_field('description'); ?></div>
		<?php endif; ?>

	</div>

</header>

<section id="section-grid" class="section-grid ">

	<?php if ( has_post_thumbnail() ) { ?>

		<figure class="featured-image">
			<?php the_post_thumbnail('popper-featured-image'); ?>
		</figure>

	<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'popper' ),
				'after'  => '</div>',
			) );
		?>
	</div>

</section>
