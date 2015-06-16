<!DOCTYPE html>
<html>
<head lang="de">
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/tuck.css">
<?php
	wp_head();
	$colorScheme = \mitstyle\Theme::getColorScheme();
?>
	<style>
		a {
			color: <?php echo $colorScheme->linkColor; ?>;
		}
		a:hover {
			color: <?php echo $colorScheme->linkHoverColor; ?>;
		}

		body, .post-container:before, .post-container:after, .post:before, .post:after {
			background: <?php echo $colorScheme->background; ?>;
			color: <?php echo $colorScheme->color; ?>;
		}

		footer {
			color: <?php echo $colorScheme->footerColor ?>;
			background: <?php echo $colorScheme->footerBackground; ?>;
		}

		header {
			background: <?php echo $colorScheme->headerBackground; ?>;
		}
		h1.title {
			color: <?php echo $colorScheme->headerColor; ?>;
		}
	</style>
</head>
<body>

<header>
	<h1 class="title"><?php echo \mitstyle\Theme::getLogo()." "; echo get_bloginfo('title'); ?></h1>
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
<main>