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
?>


<a class="section-grid-tile" href="<?php echo get_post_meta($post->ID, 'external_url', true); ?>" >

	<img class="image" src="<?php echo $image[0]; ?>" />

</a>

<a class="section-grid-tile" href="<?php echo get_post_meta($post->ID, 'external_url', true); ?>" >

	<h2 class="section-grid-headline"><?php echo the_title() ?></h2>
	<div class="grid-description"><?php echo get_post_meta($post->ID, 'description', true); ?></div>
	<div class="quote"><?php echo get_post_meta($post->ID, 'quote', true); ?></div>
	<div class="pub-date"><?php echo get_post_meta($post->ID, 'publish_date', true); ?></div>
</a>


