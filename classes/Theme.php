<?php

namespace mitstyle;

class Theme {
	public function __construct() {
		add_action('after_setup_theme',	array($this, 'generalSetup'));
	}

	public function generalSetup() {
		add_theme_support('title-tag');
		add_theme_support('post-formats', array(
			'image',
			'quote',
			'status',
			'video',
			'aside'
		));
		register_nav_menu('top', 'Hauptmenü');
	}
}
