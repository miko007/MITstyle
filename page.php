<?php
get_header();

	if (have_posts()) {
		while (have_posts()) {
			the_post();
			ob_start();
			the_content();
			$content = ob_get_clean();
			$template = new \mitstyle\Template("page-default.php");
			$template->setValues(array(
				'title'		=> get_the_title(),
				'content'	=> $content
			));
			$template->render();
		}
	}

get_footer();