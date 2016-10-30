
    <footer>

        <div class="footer-content">
            <ul class="social">
                <li class="menu-item"><a href="<?php echo get_option('facebook'); ?>"><span class="web-icons_facebook"></span></a></li>
                <li class="menu-item"><a href="<?php echo get_option('linkedin'); ?>"><span class="web-icons_linkedin"></span></a></li>
                <li class="menu-item"><a href="<?php echo get_option('googleplus'); ?>"><span class="web-icons_google"></span></a></li>
                <li class="menu-item"><a href="<?php echo get_option('twitter'); ?>"><span class="web-icons_twitter"></span></a></li>

            </ul>


            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container_class' => 'footer-right', 'menu_class' => 'footer-navigation' ) ); ?>

        </div>
    </footer>


    <?php wp_footer(); ?>
  </body>
</html>
