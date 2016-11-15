
<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>

<div id="content-body" class="content-body gallery">

	<div class="show-case" style="background-image: url('<?php echo $backgroundImg[0]; ?>')"></div>

	<?php while ( have_posts() ) : the_post(); ?>

		<section id="section-grid" class="section-grid">

			<span class="section-heading">Mr. Cobra exclusive collections gallery</span>


			<div class="entry-content">
				<?php the_content(); ?>
				<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'popper' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->


		</section>

	<?php endwhile; ?>

</div>

