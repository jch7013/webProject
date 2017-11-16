<?php $wl_theme_options = get_theme_mod('unik_options');?>
<!-- BreadCum -->
	<div class="breadcum_bg">
		<div class="container-fluid w_breadcum">
			<div class="container">
				<?php if (function_exists('unik_breadcrumbs') && !is_home()){ unik_breadcrumbs(); } ?>
			</div>
		</div>
	</div>
	<!-- BreadCum -->