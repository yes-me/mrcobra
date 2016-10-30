

<div id="content-body" class="content-body wild-west">

    <?php while ( have_posts() ) : the_post(); ?>


        <section id="section-grid" class="section-grid">

            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            <div class="description">
                <?php echo get_post_meta($post->ID, 'description', true); ?>
            </div>

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

