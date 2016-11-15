

<div id="content-body" class="content-body video">

	<?php while ( have_posts() ) : the_post(); ?>

		<section id="main-video" class="main-video">
			<div class="video-content">
				<?php the_content(); ?>
			</div>
		</section>

        <section class="media-grid">
            <span class="section-heading">Mr. Cobra Videos</span>

            <div class="media-grid-container">
            <?php
            $args =  array(
                'post_type' => 'video',
                'orderby' => 'menu_order',
                'order' => 'ASC'
            );
            $custom_query = new WP_Query( $args );
            while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

                    <a class="media-grid-link video-embed" data-video-src="<?php echo get_post_meta($post->ID, 'video-url', true); ?>" href="">
                        <figure>
                            <div class="media-grid-thumbnail">
                                <?php the_post_thumbnail(); ?>
                                <div class="media-grid-image-overlay">
                                    <span class="media-grid-video-icon"></span>
                                </div>
                            </div>
                            <figcaption>
                                <h3 class="media-grid-headline"><?php the_title(); ?></h3>
                                <p class="media-grid-stats">
                                    <span class="media-grid-pubDate"><?php echo get_post_meta($post->ID, 'pub-date', true); ?></span> | <span class="media-grid-author"><?php echo get_post_meta($post->ID, 'video-source', true); ?></span>
                                </p>
                            </figcaption>

                        </figure>
                    </a>

            <?php endwhile; ?>

            </div>

        </section>


            <div id="video-player-overlay" class="video-player-overlay">
                <span class="overlay-close"></span>
            </div>
	<?php endwhile; ?>

</div>

