<?php $wl_theme_options = get_theme_mod('unik_options'); ?>
<!-- Footer Start -->
	<footer class="footer-bg" style="background-image:url('<?php echo esc_url(get_template_directory_uri().'/images/diagonal.png'); ?>');"> 
	<div class="container-fluid space w_footer">
		<div class="container">
		<?php if ( is_active_sidebar( 'theme_footer_widget' ) ){ dynamic_sidebar( 'theme_footer_widget' );	} ?>
		</div>
	</div>
	<div class="conatainer-fluid footer-copy">
		<div class="container">
			<div class="col-md-8 col-sm-12 footer-copy-text">
			<?php if(isset($wl_theme_options['footer_credit']) && isset($wl_theme_options['footer_company']) && isset($wl_theme_options['footer_company_link'])){
			if($wl_theme_options['footer_credit']!='' && $wl_theme_options['footer_company']!='' && $wl_theme_options['footer_company_link']!=''){
			echo esc_attr($wl_theme_options['footer_credit']); ?>
			<a href="<?php echo esc_url($wl_theme_options['footer_company_link']); ?>" target="_blank"> <?php echo esc_attr($wl_theme_options['footer_company']); ?></a> 
			<?php } } ?>
			</div>
			<div class="col-md-4 col-sm-12 footer-copy-social">
			<?php if(isset($wl_theme_options['footer_social']) && $wl_theme_options['footer_social']!='off'){ ?>
				<ul class="f_social">
			<?php for($i=1; $i<=5; $i++){
				if(isset($wl_theme_options['social_icon_'.$i]) && isset($wl_theme_options['social_icon_link_'.$i]) && isset($wl_theme_options['icon_color_'.$i])){
				if($wl_theme_options['social_icon_'.$i]!='' && $wl_theme_options['social_icon_link_'.$i]!=''){ ?>
					<li><a href="<?php echo esc_url($wl_theme_options['social_icon_link_'.$i]); ?>" target="_blank"><i class="<?php echo esc_html($wl_theme_options['social_icon_'.$i]); ?>" <?php if($wl_theme_options['icon_color_'.$i]!=''){ echo 'style="background-color:'.esc_html($wl_theme_options['icon_color_'.$i]).'"'; } ?>></i></a></li>
				<?php } } } ?>
				</ul>
			<?php } ?>
			</div>
		</div>
	</div>
	</footer>
	<!-- Footer End -->
	<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
</div>
<?php wp_footer(); ?>
	</body>
	</html>