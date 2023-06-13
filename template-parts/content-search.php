<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TwoByteCode
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

	<?php twobytecode_post_thumbnail(); ?>
		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" class="text-decoration-none" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			twobytecode_posted_on();
			twobytecode_posted_by();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->


	<div class="entry-summary">
		<?php 
		// the_excerpt(); 
		echo '<p>'.wp_trim_words( get_the_excerpt(), 15 , "...").'</p>';
		?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php twobytecode_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
