<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper">
<!-- Header Start -->
<header>
<nav class="navbar navbar-default menu">
	<div class="container-fluid">
		<div class="container">
			<div class="row menu-head">
				<div class="col-md-3 col-xs-12 navbar-header">
				<?php $unik_logo_id = get_theme_mod( 'custom_logo' );
		$unik_logo_data = wp_get_attachment_image_src( $unik_logo_id , 'full' );
		$unik_logo = $unik_logo_data[0];	?>
		 <a class="navbar-brand" href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php if(isset($unik_logo)){ ?>
		<img src="<?php echo esc_url($unik_logo); ?>" alt="<?php bloginfo( 'name' ); ?>" >
		<?php }else { ?>
		   <?php bloginfo( 'name' ); ?>
			<?php } ?></a>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<?php _e('Menu','unik'); ?>
				  </button>
				</div>
				<div class="col-md-9 col-xs-12 collapse navbar-collapse" id="myNavbar">
					<?php wp_nav_menu( array(
						'theme_location' => 'primary-menu',
						'menu_class' => 'nav navbar-nav',
						'fallback_cb' => 'unik_fallback_page_menu',
						'walker' => new unik_nav_walker(),
						)
						);	?>
				</div>
			</div>
		</div>
	</div>
</nav>
</header>
<!-- Header End -->