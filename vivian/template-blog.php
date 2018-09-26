<?php
/* Template Name: Blog */
get_header();
?>

<?php if ( fw_vivian_get_field('blog_layout') == 'horizontal' ) : ?>
<div id="post-<?php the_ID(); ?>" <?php post_class('fullscreen-wrapper'); ?> >
<?php else : ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
<?php endif; ?>
	<?php get_template_part( 'loop/loop', 'posts' ); ?>			

</div>

<?php get_footer(); ?>