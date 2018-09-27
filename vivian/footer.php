<?php 
	$footer_color = fw_vivian_get_option('navigation_footer_color') == 'light' ? ' footer-light' : ' section-light';
	$footer_social = fw_vivian_get_option('show_social');
?>

<footer class="footer<?php echo esc_attr($footer_color); ?>">

	<?php if ( fw_vivian_get_option('footer_text') ) : ?>
			<div class="copyright font-subheading is-block-reveal">
				<?php echo wp_kses_post( fw_vivian_get_option('footer_text') ); ?>
			</div>
	<?php endif; ?>

	<?php if( $footer_social['social_enable'] == 'yes' && $footer_social['yes']['social_position'] == 'footer' ) : ?>
		
			<div class="SocialLinks footer-social-wrapper is-block-reveal">
				<?php
				$social_titles = fw_vivian_get_social_medias();

				foreach ($social_titles as $key => $value) :
					if ( fw_vivian_get_option($key) ) :
					?>
					<a href="<?php echo esc_url( fw_vivian_get_option($key) ); ?>" class="<?php echo esc_attr($key); ?>" target="_blank"><i class="fa fa-<?php echo esc_attr($key);?>"></i></a>
					<?php
					endif;
				endforeach;
				?>
			</div>
			

	<?php endif; ?>

</footer>

<?php wp_footer() ;?>
</body>
</html>