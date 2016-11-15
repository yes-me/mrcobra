

<div id="content-body" class="content-body wild-west">

    <?php while ( have_posts() ) : the_post(); ?>

        <header class="entry-header">

            <div class="intro">

                <?php the_title( '<h1 class="title">', '</h1>' ); ?>


                <?php if( get_field('description') ): ?>
                    <div class="description"> <?php the_field('description'); ?></div>
                <?php endif; ?>


            </div>

        </header>

        <section id="section-grid" class="section-grid">

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

