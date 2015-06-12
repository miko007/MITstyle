<?php
/**
 * MITstyle WordPress Theme
 * (C) 2015, Michael Ochmann
 * MIT license
 */
get_header();

echo "<main>";

if (have_posts()) {
	while (have_posts()) {
		the_post();
		ob_start();
		the_content();
		$content = ob_get_clean();
		$customPost = new \mitstyle\Post($post, $content);
		$customPost->render();
	}
}

echo "</main>";

get_footer();