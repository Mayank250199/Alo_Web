<?php if (!defined('FW')) die( 'Forbidden' ); ?>

<?php if ( $atts['icon_text_fields'] ) : ?>
	<div class="IconText">

	<?php foreach ($atts['icon_text_fields'] as $key => $field) : ?>

		<div class="icon-text-item">
			<i class="<?php echo esc_attr($field['icon']); ?>"></i>
			<span><?php echo wp_kses_post($field['text']); ?></span>
		</div>

	<?php endforeach; ?>

	</div><!-- end IconText -->
<?php endif; ?>