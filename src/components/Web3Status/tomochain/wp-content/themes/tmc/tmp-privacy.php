<?php
/**
 * Template Name: tmp privacy
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package st
 */

get_template_part('header-privacy');
?>

<main id="main" class="site-main">
	<div id="privacy-wrapper">
		<div class="site-content">
		<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
		?>
		</div>
	</div>
</main><!-- #main -->
<script src="<?php echo esc_url(TMC_THEME_URI . '/assets/libs/scroll-fullpage/scrolloverflow.js'); ?>"></script>
<script src="<?php echo esc_url(TMC_THEME_URI . '/assets/libs/scroll-fullpage/fullpage.js'); ?>"></script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		var $currDiv = $( "#start" );
			$currDiv.css( "opacity", "1" );
		var count = 1;
		if (count === 1) {
			$( ".btn-back" ).css( "background-color", "#444444" );
		}
		$( ".btn-next" ).click(function() {
			if (count < 5) {
				$currDiv  = $currDiv.next();
				$( ".btn-back" ).css( "background-color", "#ffffff");
				$( ".section-break ul li" ).css( "opacity", "0" );
				$currDiv.css( "opacity", "1" );
				count++;
				if (count === 5) {
					$( ".btn-next" ).css(  {"background-color": "#1A4038", "color": "#666"} );
				}
			}
		});
		$( ".btn-back" ).click(function() {
			if (count > 1) {
				$currDiv  = $currDiv .prev();
				$( ".btn-next" ).css( "background-color", "#00e8b4" );
				$( ".section-break ul li" ).css( "opacity", "0" );
				$currDiv .css( "opacity", "1" );
				count--;
				if (count === 1) {
					$( ".btn-back" ).css( "background-color", "#444444" );
				}
			}
		});


		// COOKIES
		// if the cookie is true, hide the initial message and show the other one
		if ($.cookie('hide-section-click') == 'yes' ) {//yes
			jQuery('.hiddenSection').addClass('d-none');
			jQuery('.button-yes').removeClass('d-none');
			jQuery('.button-no').addClass('d-none');
			jQuery('.tmp-privacy').removeClass('d-none');
			jQuery('.page-template-tmp-privacy').addClass('scaleDown');

			jQuery('.hiddenSection').remove();
			jQuery('#section0').remove();
			jQuery('#section1').remove();
			jQuery('#section2').remove();
			jQuery('#section3').remove();

			var myFullpage = new fullpage('#fullpage', {
				scrollOverflow: true,
				menu: '#menu',
				scrollingSpeed: 1200,
				anchors: [
					'0rdPage',
					'1rdPage',
					'2rdPage',
					'3rdPage',
					'4rdPage',
					'5rdPage',
					'6rdPage',
					'7rdPage',
					'8rdPage',
					'9rdPage',
					'10rdPage'
				],
				onLeave: function(origin, destination, direction){
					var params = {
						origin: origin,
						destination:destination,
						direction: direction
					};
					if(direction=='up'){
						jQuery('.page-template-tmp-privacy').addClass('scaleUp');
						jQuery('.page-template-tmp-privacy').removeClass('scaleDown');
						jQuery('.fp-viewing-3rdPage').removeClass('bd-bg-black');
					}else{
						jQuery('.page-template-tmp-privacy').addClass('scaleDown');
						jQuery('.page-template-tmp-privacy').removeClass('scaleUp');
						jQuery('.fp-viewing-2rdPage').addClass('bd-bg-black');
					}
				}
			});
		}

		if ($.cookie('hide-section-click') == 'no' ) {//no
			jQuery('.hiddenSection').addClass('d-none');
			jQuery(".button-no").removeClass("d-none");
			jQuery('.button-yes').addClass('d-none');
			jQuery('.tmp-privacy').removeClass('d-none');
			jQuery('.page-template-tmp-privacy').addClass('scaleDown');

			jQuery('.hiddenSection').remove();
			jQuery('#section0').remove();
			jQuery('#section1').remove();
			jQuery('#section2').remove();
			jQuery('#section3').remove();

			var myFullpage = new fullpage('#fullpage', {
				scrollOverflow: true,
				menu: '#menu',
				scrollingSpeed: 1200,
				anchors: [
					'0rdPage',
					'1rdPage',
					'2rdPage',
					'3rdPage',
					'4rdPage',
					'5rdPage',
					'6rdPage',
					'7rdPage',
					'8rdPage',
					'9rdPage',
					'10rdPage'
				],
				onLeave: function(origin, destination, direction){
					var params = {
						origin: origin,
						destination:destination,
						direction: direction
					};
					if(direction=='up'){
						jQuery('.page-template-tmp-privacy').addClass('scaleUp');
						jQuery('.page-template-tmp-privacy').removeClass('scaleDown');
						jQuery('.fp-viewing-3rdPage').removeClass('bd-bg-black');
					}else{
						jQuery('.page-template-tmp-privacy').addClass('scaleDown');
						jQuery('.page-template-tmp-privacy').removeClass('scaleUp');
						jQuery('.fp-viewing-2rdPage').addClass('bd-bg-black');
					}
				}
			});
		}

		jQuery('.buttonYes').click(function(){
			if (!$('.hiddenSection').is('out-section')) {
				jQuery('.hiddenSection').addClass('out-section');
				jQuery('.button-yes').removeClass('d-none');
				jQuery('.button-no').addClass('d-none');
				jQuery('.tmp-privacy').removeClass('d-none');
				jQuery('.page-template-tmp-privacy').addClass('scaleDown');

				var myFullpage = new fullpage('#fullpage', {
					scrollOverflow: true,
					menu: '#menu',
					scrollingSpeed: 1200,
					anchors: [
						'0rdPage',
						'1rdPage',
						'2rdPage',
						'3rdPage',
						'4rdPage',
						'5rdPage',
						'6rdPage',
						'7rdPage',
						'8rdPage',
						'9rdPage',
						'10rdPage'
					],
					onLeave: function(origin, destination, direction){
						var params = {
							origin: origin,
							destination:destination,
							direction: direction
						};
						if(direction=='up'){
							jQuery('.page-template-tmp-privacy').addClass('scaleUp');
							jQuery('.page-template-tmp-privacy').removeClass('scaleDown');
							jQuery('.fp-viewing-3rdPage').removeClass('bd-bg-black');
						}else{
							jQuery('.page-template-tmp-privacy').addClass('scaleDown');
							jQuery('.page-template-tmp-privacy').removeClass('scaleUp');
							jQuery('.fp-viewing-2rdPage').addClass('bd-bg-black');
						}
					}
				});
				// add cookie setting that user has clicked
				$.cookie('hide-section-click', 'yes', {expires: 30 });
			}

		});
		jQuery(".buttonNo").click(function(){
			if (!$('.hiddenSection').is('out-section')) {
				jQuery('.hiddenSection').addClass('out-section');
				jQuery(".button-no").removeClass("d-none");
				jQuery('.button-yes').addClass('d-none');
				jQuery('.tmp-privacy').removeClass('d-none');
				jQuery('.page-template-tmp-privacy').addClass('scaleDown');


				var myFullpage = new fullpage('#fullpage', {
					scrollOverflow: true,
					menu: '#menu',
					scrollingSpeed: 1200,
					anchors: [
						'0rdPage',
						'1rdPage',
						'2rdPage',
						'3rdPage',
						'4rdPage',
						'5rdPage',
						'6rdPage',
						'7rdPage',
						'8rdPage',
						'9rdPage',
						'10rdPage'
					],
					onLeave: function(origin, destination, direction){
						var params = {
							origin: origin,
							destination:destination,
							direction: direction
						};
						if(direction=='up'){
							jQuery('.page-template-tmp-privacy').addClass('scaleUp');
							jQuery('.page-template-tmp-privacy').removeClass('scaleDown');
							jQuery('.fp-viewing-3rdPage').removeClass('bd-bg-black');
						}else{
							jQuery('.page-template-tmp-privacy').addClass('scaleDown');
							jQuery('.page-template-tmp-privacy').removeClass('scaleUp');
							jQuery('.fp-viewing-2rdPage').addClass('bd-bg-black');
						}
					}
				});
				// add cookie setting that user has clicked
				$.cookie('hide-section-click', 'no', {expires: 30 });
			}
		});
		//fullpage



		//accordion
		var acc = document.getElementsByClassName("accordion");
		var i;
		for (i = 0; i < acc.length; i++) {
			acc[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight){
					panel.style.maxHeight = null;
				} else {
					panel.style.maxHeight = panel.scrollHeight + "px";
				}
			});
		}
	});
</script>
<?php

get_footer();
