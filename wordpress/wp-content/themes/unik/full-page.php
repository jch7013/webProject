<?php //template name: Full Width Page
get_header();
get_template_part('breadcrumps');
 ?>
<div class="container-fluid space w_blog">
	<div class="container">
		<div class="col-md-12 col-sm-12 right-side blog_gallery">
		<?php if ( have_posts()){ 
			while ( have_posts() ): the_post(); ?>
			<div class="col-md-12 col-sm-12 w_blog_post">
			<?php if(has_post_thumbnail()): ?>
				<div class="img-thumbnail">
					<?php $data= array('class' =>'img-responsive post_image'); 
					the_post_thumbnail('post_image', $data); ?>
				</div>
			<?php endif; ?>				
				<div class="col-md-12 w_post_desc">
					<h2><?php the_title(); ?></h2>
					<div class="post-content">
					<?php the_content(); ?>
					</div>
				</div>
			</div>
			<?php 
		   endwhile;
		} ?>
		</div>
		</div>
</div>
<?php get_footer(); ?>