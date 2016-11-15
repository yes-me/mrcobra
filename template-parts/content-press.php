<?php
/**
 * Template part for displaying press content in page-press.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mrcobra
 */

?>

<?php

$attachment_id = get_post_meta($post->ID, 'image', true);
$size = "large"; // (thumbnail, medium, large, full or custom size)

$image = wp_get_attachment_image_src( $attachment_id, $size );
$credit = get_post_meta($post->ID, 'photo_credit', true);
?>

<div class="component tile-size-2">
	<div class="component-content">
		<div class="tile">
			<div class="tile-content">
				<a class="tile-link" href="<?php echo get_post_meta($post->ID, 'external_url', true); ?>" target="_blank">

					<div class="tile-content-text">
						<p class="tile-content-headline"><?php echo the_title() ?></p>
						<div class="pub-info">
							<span class="source"><?php echo get_post_meta($post->ID, 'description', true); ?></span>
							<span class="pub-date"><?php echo get_post_meta($post->ID, 'publish_date', true); ?></span>

							<?php if ( $credit ) { ?>
								<div class="credit">
									<span class="text">Photo: </span>
									<span><?php echo $credit; ?></span>
								</div>
							<?php } ?>
						</div>
					</div>
				</a>

				<div class="tile-image">
					<img class="image" src="<?php echo $image[0]; ?>" />
				</div>

			</div>
		</div>
	</div>
</div>


