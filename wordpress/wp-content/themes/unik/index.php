<?php get_header(); ?>
<div class="container-fluid space w_blog">
	<div class="container">
	<?php  if ( have_posts()){ ?>
		<div class="col-md-9 col-sm-8 right-side blog_gallery">
		<?php while ( have_posts() ): the_post(); ?>
			<div class="col-md-12 col-sm-12 w_blog_post">
				<div class="col-md-12 w_post_desc">
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<span><i class="fa fa-calendar"></i><?php the_date(); ?></span>
						<span><i class="fa fa-user"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span>
						<?php if(get_the_category_list() != '') { ?>
					<span><i class="fa fa-bookmark"></i><?php the_category(', '); ?></span>
					<?php } ?>
			<span><i class="fa fa-commenting"></i><?php echo comments_number(__('No Comments','unik'), __('1 Comment','unik'), __('% Comments','unik')); ?></span>
						<div class="post-content">
				<?php if(has_post_thumbnail()): ?>
				<div class="col-md-4 col-sm-4 col-xs-6 post-thumbs">
					<div class="img-thumbnail">
						<?php $data= array('class' =>'img-responsive post_image'); 
						the_post_thumbnail('post_image', $data); ?>
					</div>
				</div>
				<?php endif; ?>	
						<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
			<div class="center blog-pagination ">
				<?php unik_numeric_posts_nav(); ?>
			</div>
		</div>
		<?php }else{ ?>
			<div class="col-md-9 space educa-not-found">
				<div class="col-md-12 error-no">
					<div class="col-md-12 not-found-icon">
						<i class="fa fa-exclamation-triangle icon"></i>
					</div>
					<p class="text"><?php _e('Page Not Found','unik'); ?></p>
				</div>	
				<div class="col-md-12 error-text">
					<p><?php _e('The Page you requested is not be found. This could be spelling error in the url.','unik'); ?></p>
					<a class="btn" href="<?php echo esc_url(home_url( '/' )); ?>"><?php _e('Go back to homepage','unik'); ?></a>
				</div>
			</div>	
		<?php }  get_sidebar(); ?>
		</div>
</div>
<?php get_footer(); ?>