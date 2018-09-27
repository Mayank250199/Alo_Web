<?php if (!defined('FW')) die( 'Forbidden' ); ?>
<?php $tabs_id = uniqid('fw-tabs-'); ?>
<?php
/*
 * the `.fw-tabs-container` div also supports
 * a `tabs-justified` class, that strethes the tabs
 * to the width of the whole container
 */
?>
<div class="fw-tabs-container tabs-justified" id="<?php echo esc_attr($tabs_id); ?>">
	<div class="fw-tabs">
		<ul>
			<?php foreach ($atts['tabs'] as $key => $tab) : ?>
				<li>
					
					<a class="font-heading element-title" href="#<?php echo esc_attr($tabs_id) . '-' . (esc_attr($key) + 1); ?>">
						
							<i class="<?php echo esc_attr($tab['icon']); ?> tabs-icon">
								<i class="<?php echo esc_attr($tab['icon']); ?> tabs-icon-selected"></i>
							</i>
						
						<!-- <div class="tabs-icon-selected">
							<
						</div> -->
						<?php echo wp_kses_post($tab['tab_title']); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php foreach ( $atts['tabs'] as $key => $tab ) : ?>
		<div class="fw-tab-content" id="<?php echo esc_attr($tabs_id) . '-' . (esc_attr($key) + 1); ?>">
			<p><?php echo do_shortcode( $tab['tab_content'] ) ?></p>
		</div>
	<?php endforeach; ?>
</div>