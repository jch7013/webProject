<form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform" method="get"> 	
	<input type="text" placeholder="<?php _e( "Search Here...", 'unik' ); ?>" id="search" name="s" class="form-control">
	<span class="input-group-btn">
		<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
	</span>
</form>