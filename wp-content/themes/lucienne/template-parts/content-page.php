<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Lucienne
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content page-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:',  'lucienne' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->


	<?php edit_post_link( esc_html__( 'Edit',  'lucienne' ), '<footer class="entry-footer clear"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

</article><!-- #post-## -->

