<?php get_header(); ?>
<!-- BreadCum -->
	<div class="breadcum_bg">
		<div class="container-fluid w_breadcum">
			<div class="container">
				<h1><?php _e('Page Not Found','unik'); ?></h1>
			</div>
		</div>
	</div>
	<!-- BreadCum -->
	<div class="container-fluid educa-error space">
		<div class="container error_content">
			<div class="col-md-12 error-no">
				<p class="text-number"><?php _e('404','unik'); ?></p>
				<p class="text"><?php _e('WHOOPS !','unik'); ?></p>
			</div>	
			<div class="col-md-12 error-text">
				<h3><?php _e('Page Not Found','unik'); ?></h3>
				<p><?php _e('The Page you requested is not be found. This could be spelling error in the url.','unik'); ?></p>
				<a class="btn" href="<?php echo esc_url(home_url( '/' )); ?>"><?php _e('Go back to homepage','unik'); ?></a>
			</div>
		</div>	
	</div>	
	
<?php get_footer(); ?>