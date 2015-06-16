<?php
/**
 * MITstyle WordPress Theme
 * (C) 2015, Michael Ochmann
 * MIT license
 */
get_header();

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

paginate_links();

echo "<section class='pagination'>";
next_posts_link("&laquo; ältere Beiträge", 0);
previous_posts_link("neuere Beiträge &raquo;");
echo "</section><div style='clear: both;'></div>";

get_footer();