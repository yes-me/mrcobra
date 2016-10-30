<?php get_header(); ?>

<div id="content-body" class="content-body>

			<?php
				$args =  array(
					'post_type' => 'my-custom-post',
					'orderby' => 'menu_order',
					'order' => 'ASC'
				);
				 $custom_query = new WP_Query( $args );
            while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

				<div class="blog-post">
					<h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<h3 class="custom-field"><?php echo get_post_meta($post->ID, 'custom-fields', true); ?></h3>
					<?php the_excerpt(); ?>
				</div>

				<?php endwhile; ?>

	</div>

	<?php get_footer(); ?>
