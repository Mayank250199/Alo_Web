<form action="<?php echo esc_url(home_url('/')); ?>" method="get" role="search">
	<fieldset>
		<div class="search-form-wrapper">
			<input type="search" class="search-form-input" name="s"  placeholder="<?php echo esc_attr('Search...', 'vivian'); ?>">
			<span class="search-form-btn">
				<button class="btn-search" type="submit"><i class="fa fa-search"></i></button>
			</span>
		</div>
	</fieldset>
</form>