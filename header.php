<!DOCTYPE html>
<html>
<head lang="de">
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/tuck.css">
<?php
	wp_head();
?>
</head>
<body>

<header>
	<h1 class="title"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png"> <?php echo get_bloginfo('title'); ?></h1>
	<h2 class="subtitle"><?php echo get_bloginfo('description'); ?></h2>
	<nav>
		<?php
		wp_nav_menu(array(
			'theme_location'  => 'top',
			'menu'            => 'top',
			'container'       => 'div',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => -1
		));
		?>
	</nav>
</header>