<?php get_header();
get_template_part('breadcrumps');
 ?>
<div class="container-fluid space w_blog">
	<div class="container">
		<div class="col-md-9 col-sm-8 right-side blog_gallery">
		<?php while ( have_posts() ): the_post(); ?>
			<div class="col-md-12 col-sm-12 w_blog_post">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if(has_post_thumbnail()): ?>
					<div class="img-thumbnail">
						<?php $data= array('class' =>'img-responsive post_image'); 
						the_post_thumbnail('post_image', $data); ?>
					</div>
				<?php endif; ?>				
					<div class="col-md-12 w_post_desc">
						<h2><?php the_title(); ?></h2>
						<div class="post-content">
						<?php the_content(); 
						wp_link_pages(array(
							'before'      => '<div class="page-links">' . __( 'Pages:', 'unik' ),
							'after'       => '</div>',
						) );?>
						</div>
					</div>
				</div>
			</div>
			<?php 
		   endwhile; ?>
		</div>
		<?php get_sidebar('page'); ?>
		</div>
</div>
<?php get_footer(); ?>