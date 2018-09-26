<?php if (!defined('FW')) die( 'Forbidden' ); ?>
<blockquote>
	<i class="icon-chat open-quote"></i>
	<p><?php echo wp_kses_post($atts['content']) ?></p>
	<?php if ( $atts['cite'] ) : ?>
	<footer><cite><?php echo wp_kses_post($atts['cite']) ?></cite></footer>
	<?php endif; ?>
</blockquote>