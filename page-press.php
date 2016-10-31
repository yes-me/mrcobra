<?php
/**
 * The template for displaying press page.
 * @package mrcobra
 */

get_header(); ?>

<div id="content-body" class="content-body <?php echo strtolower(get_the_title()) ?>">

	<header class="entry-header">

		<div class="intro">

			<?php the_title( '<h1 class="title">', '</h1>' ); ?>


			<?php if( get_field('description') ): ?>
				<div class="description"> <?php the_field('description'); ?></div>
			<?php endif; ?>


		</div>

	</header>

	<?php while ( have_posts() ) : the_post(); ?>
		<section class="fullwidth-section">
			<div class="fullwidth-section-content">
				<h2 class="section-heading"><?php the_field('sub-title'); ?></h2>

				<div class="fullwidth-section-content-list">
					<?php the_content(); ?>
				</div>
			</div>
		</section>
	<?php endwhile ?>


	<section class="section-fullimage tile-theme-dark">

		<div class="section-tiles-grid">

			<?php

			$args =  array(
				'post_type' => 'press-post',
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);
			$custom_query = new WP_Query( $args );

			while ($custom_query->have_posts()) : $custom_query->the_post();


				get_template_part( 'template-parts/content', 'press' );

			endwhile;
			?>
		</div>
	</section>

</div>


<?php get_footer(); ?>



