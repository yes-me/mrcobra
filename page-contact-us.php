<?php
/**
Template Name: Custom Contact Us
 **/
?>

<?php get_header(); ?>

	<div id="content-body" class="content-body contact-us">
		<section id="main" class="main">


			<div id='gmap_canvas' class="google-map"></div>


			<?php while ( have_posts() ) : the_post(); ?>


				<div id="primary" class="content-area">

					<h2 class="section-heading">Send us an Email</h2>
					<?php the_content(); ?>

				</div>

				<?php get_sidebar(); ?>
			<?php endwhile; // End of the loop. ?>

		</section>
	</div>


<?php get_footer(); ?>