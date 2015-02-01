<?php get_header(); ?>

	<div id="container" class="no-sidebar">
		<div id="content" class="full-width">
			<article id="post-0" class="post error404 not-found clearfix" role="article">

				<div class="entry-content">
					<div class="row-inner">
						<h1><?php _e( '404', 'quince' ); ?></h1>
						<h2><?php _e( 'Something went wrong :&#40;', 'quince' ); ?></h2>
						<p><?php _e( 'Sorry! We could not find your page. Perhaps searching can help.', 'quince' ); ?></p>
						
						<?php get_search_form(); ?>

					</div>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
		</div><!-- #content -->
	</div><!-- #container -->

<?php get_footer(); ?>