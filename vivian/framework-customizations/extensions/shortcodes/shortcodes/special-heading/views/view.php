<?php if (!defined('FW')) die( 'Forbidden' );

$section_extra_classes  = '';
$subtitle_style = '';

if ( ( $atts['position'] ) ) {
	$section_extra_classes .= ' text-' . $atts['position'];
	$subtitle_style = 'special-subtitle-' . $atts['position'];
}

?>
<div class="SpecialHeading fw-heading <?php echo esc_attr($section_extra_classes) ?> mb-40">
	<h2 class="special-title is-block-reveal"><?php echo wp_kses_post($atts['title']); ?></h2>
	<?php if (!empty($atts['subtitle'])) : ?>
		<div class="<?php echo esc_attr($subtitle_style); ?> is-block-reveal font-subheading"><?php echo wp_kses_post($atts['subtitle']); ?></div>
	<?php endif; ?>
</div>