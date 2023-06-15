<?php 
/** 
* Front Page 
* 
 * This is the template for the homepage.
 *
 * @package Thor
 * @author  GetPhound
 * @license GPL-2.0+
* 
*/

// Force full width 
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' ); 

// Remove page title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

remove_action('genesis_loop', 'genesis_do_loop' );
add_action('genesis_loop', 'gp_home');

function gp_home() {

	// Variables
	$background_image = get_field('background_image');
	$hero_title = get_field('hero_title');
	$hero_text = get_field('hero_text');
	$hero_button_label = get_field('hero_button_label');
	$hero_button_link = get_field('hero_button_link');
	$form_title = get_field('form_title');
	$form_text = get_field('form_text');
	$services_title = get_field('service_section_title');

?>

	<div class="section-1 section" style="background-size: cover; background-repeat: no-repeat; background-image:url(<?php if($background_image) { echo $background_image; } else { echo get_stylesheet_directory_uri() . '/images/bg-placeholder.jpg'; } ?>)">
		<div class="wrap">
		    <div class="one-half first">
		     	<?php
		        	if($hero_title) {
						echo '<h1>' . $hero_title . '</h1>';
					}
					else {
						echo '<h1>Hero Title</h1>';
					}
					if($hero_text) {
						echo '<h2>' . $hero_text . '</h2>';
					}
					else {
						echo '<h2>Hero Text. This can be set under \'Edit Page\' options.</h2>';
					}
					if($hero_button_label && $hero_button_link) {
						echo '<a href="' . $hero_button_link . '" class="button">' . $hero_button_label . '</a>';
					}
				?>
		    </div>
		    <div class="one-half">
				<div class="form-block">
		    		<div class="form-title"><h3><?php echo $form_title; ?></h3></div>
					<div class="form-text"><?php echo $form_text; ?></div>
		        <?php echo do_shortcode('[gravityform id="1" title="false" description="false"]'); ?>
				</div>
		    </div>
		</div>
	</div>

	<div class="home-services section">
		<div class="wrap">
		<h2><?php echo $services_title; ?></h2>
		<div class="service-grid">

			<?php
			if (have_rows('service_boxes')) {
				while (have_rows('service_boxes')) {
					the_row();
					if (have_rows('service_box')) {
						while (have_rows('service_box')) {
							the_row();
							$service_title = get_sub_field('service_title');
							$service_text = get_sub_field('service_text');
							$service_image = get_sub_field('service_image');
							?>
							<div class="service-box">
							<?php if ($service_image) : ?>
								<?php $image_id = $service_image['ID']; ?>
								<?php $custom_image = wp_get_attachment_image_src($image_id, 'custom-size'); ?>
								<?php if ($custom_image) : ?>
									<img src="<?php echo $custom_image[0]; ?>" alt="<?php echo $service_image['alt']; ?>">
								<?php endif; ?>
							<?php endif; ?>


								<h3><?php echo $service_title; ?></h3>
								<p><?php echo $service_text; ?></p>
							</div>
							<?php
						}
					}
				}
			}
			
			?>

		</div>
		</div>
	</div>
	<?php $testimonials_title = get_field('testimonials_title');
	if($testimonials_title) { ?>
	<div class="faqs-section section">
		<div class="wrap">
			<h2><?php echo $testimonials_title; ?></h2>
			<div class="testimonial-grid">
			<?php
				if (have_rows('testimonial')) {
					while (have_rows('testimonial')) {
						the_row();
						$name = get_sub_field('name');
						$quote = get_sub_field('quote');
						?>
						<div class="testimonial">
							<img src="/wp-content/uploads/2023/06/8d8ddc28-3_105k05k000000000000028.png" alt="stars" class="t-stars" />
							<h3><?php echo $name; ?></h3>
							<p><?php echo $quote; ?></p>
						</div>
						<?php
					}
				}
				?>
			</div>

		</div>
	</div>
	<?php } ?>

	<div class="about-section section">
		<div class="wrap">
			<div class="one-half first">
				<img src="<?php echo get_field('about_logo'); ?>" alt="logo" width="250" style="margin-bottom: 10px" />
				<h2><?php echo get_field('about_title'); ?></h2>
				<?php echo get_field('about_text'); ?>
			</div>
			<div class="one-half">
				<?php echo get_field('about_map'); ?>
			</div>
		</div>
	</div>

	<?php
	$footer_button_label = get_field('footer_button_label');
	$footer_button_link = get_field('footer_button_link');
	?>
	<div class="footer-section section" style="background-image:url(<?php echo get_field('footer_background');?>); background-size: cover">
		<div class="wrap">
			<h2><?php echo get_field('footer_title'); ?></h2>
			<?php echo get_field('footer_text'); ?>
			<?php if($footer_button_label && $footer_button_link) {
				echo '<a href="' . $footer_button_link . '" class="button">' . $footer_button_label . '</a>';
			} ?>
		</div>
	</div>

	<div class="accordion-toggle">+ SITEMAP</div>			
	<div class="accordion">
			<div class="wrap">
				<?php
					get_template_part('/lib/sitemap');
				?>
			</div>
	</div>
	</div>

<?php }

genesis();