<?php

namespace mitstyle;

class Theme {
	public function __construct() {
		add_action('init',	array($this, 'init'));
	}

	public function init() {
		add_theme_support("title");
	}
} 