<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package st
 */
$social_lists   = tmc_get_option( 'tmc_social_list');
$num            = tmc_get_footer_option( 'footer_column', 3 );
$form_id        = tmc_get_footer_option( 'form_subscribe' );
?>

    </div><!-- #content -->
    <?php if (!is_404()): ?>
    <footer id="colophon" class="site-footer">
        <div class="footer-info">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 lg-sc-fr">
                        <div class="footer-logo">
                            <?php
                            $image = tmc_get_footer_option( 'f_logo');
                            if(!empty($image)):?>
                                <img src="<?php echo esc_url($image);?>" alt="<?php esc_html_e('Tomochain','tmc')?>">
                            <?php endif;?>
                        </div>
                        <div class="tmc-newletter">
                            <?php echo do_shortcode('[contact-form-7 id="'. $form_id .'"]');?>
                        </div>
                        <ul class="social-list">
                            <?php
                            $url = $title = $icon = '';
                            foreach ( (array) $social_lists as $k => $s ) {

                                if ( isset( $s['social_name'] ) ) {
                                    $title = esc_html( $s['social_name'] );
                                }

                                if ( isset( $s['social_icon'] ) ) {
                                    $icon = $s['social_icon'];
                                }

                                if ( isset( $s['social_url'] ) ) {
                                $url = esc_url( $s['social_url'] );
                                }?>
                                <li class="social-item">
                                    <a href="<?php echo esc_url($url);?>" target="_blank" title="<?php echo $title?>"><?php echo $icon?></a>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-7 nav-ft-menu">
                        <div class="row">
                            <?php
                                $i = 0;
                                switch ( $num ) {
                                    case 3 : $class = 'col-sm-4 mt-4 mt-md-5';
                                    break;
                                    case 2 : $class = 'col-md-6 col-sm-12 mt-lg-0';  break;
                                    case 1 : $class = 'col-md-12 mt-lg-0'; break;
                                }
                                while ( $i < $num ) : $i ++;
                                    echo '<div class="'. $class .'">';
                                    dynamic_sidebar( 'tmc-footer-' . $i );
                                    echo '</div>';
                                endwhile;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- #colophon -->
    <?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
