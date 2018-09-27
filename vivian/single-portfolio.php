<?php
get_header();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

	if ( !post_password_required() ) {
		$portfolio_type = fw_vivian_get_field('project_page_type');
		get_template_part('single-portfolio', $portfolio_type );		
	} else {
		?>
		<div class="container">
			<div class="col-sm-8 col-sm-offset-2">
				<?php echo get_the_password_form(); ?>
			</div>
		</div>
	<?php
	}


endwhile; else : ?>

<?php endif; ?>
<?php get_footer(); ?>