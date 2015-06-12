<?php

namespace mitstyle;

class Theme {
	public function __construct() {
		add_action('init',				array($this, 'init'));
		add_action('after_setup_theme',	array($this, 'generalSetup'));
	}

	public function init() {
		add_theme_support("title");
	}

	public function generalSetup() {
		register_nav_menu('top', 'Hauptmenü');
	}
}
