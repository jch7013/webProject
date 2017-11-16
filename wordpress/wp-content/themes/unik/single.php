<?php get_header();
get_template_part('breadcrumps');
 ?>
<div class="container-fluid space w_blog">
	<div class="container">
		<div class="col-md-9 col-sm-8 right-side blog_gallery">
		<?php	if ( have_posts()){ 
			while ( have_posts() ): the_post(); ?>
			<div class="col-md-12 col-sm-12 w_blog_post">				
				<div class="col-md-12 w_post_desc">
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h2><?php the_title(); ?></h2>
						<span><i class="fa fa-calendar"></i><?php the_date(); ?></span>
						<span><i class="fa fa-user"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span>
						<?php if(get_the_category_list() != '') { ?>
					<span><i class="fa fa-bookmark"></i><?php the_category(', '); ?></span>
					<?php }
					if(get_the_tag_list ()!= ''){ ?>
						<span><i class="fa fa-tag"></i> <?php the_tags('',', ',''); ?></span>
				 <?php } ?>
			<span><i class="fa fa-commenting"></i><?php echo comments_number(__('No Comments','unik'), __('1 Comment','unik'), __('% Comments','unik')); ?></span>
						<div class="post-content">
				<?php if(has_post_thumbnail()): ?>
				<div class="col-md-4 col-sm-4 col-xs-6">
					<div class="img-thumbnail">
						<?php $data= array('class' =>'img-responsive post_image'); 
						the_post_thumbnail('post_image', $data); ?>
					</div>
				</div>
				<?php endif; ?>
				<div class="post-data">
						<?php the_content(); 
						wp_link_pages(array(
							'before'      => '<div class="page-links">' . __( 'Pages:', 'unik' ),
							'after'       => '</div>',
						) ); ?>
				</div>
						</div>
					</div>
				</div>
			</div>
			
			<?php unik_navigation_posts();
					//unik_fixed_navigation();
					if ( comments_open() || get_comments_number() ) {
					   comments_template();
					   }
			endwhile;
		} ?>
		</div>
		<?php get_sidebar(); ?>
		</div>
</div>
<?php get_footer(); ?>