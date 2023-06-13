<?php
/**
 * Displays the post header
 *
 * @package TwoByteCode
 */

// Don't show the title if the post-format is `aside` or `status`.
$post_format = get_post_format();
if ( 'aside' === $post_format || 'status' === $post_format ) {
	return;
}
?>

<header class="entry-header">
	<?php
	twobytecode_post_thumbnail();
	the_title( sprintf( '<h3 class="entry-title default-max-width"><a href="%s" class="text-decoration-none">', esc_url( get_permalink() ) ), '</a></h3>' );
	// echo '<h3 class="entry-title default-max-width"><a href="'.get_permalink() .'">'. 	wp_trim_words(get_the_title(), 15, "..."). '</a></h3>';


	?>
</header><!-- .entry-header -->
