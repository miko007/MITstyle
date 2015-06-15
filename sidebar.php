<?php if ( is_active_sidebar( 'after-posts' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'after-posts' ); ?>
	</div><!-- #primary-sidebar -->
<?php endif; ?>