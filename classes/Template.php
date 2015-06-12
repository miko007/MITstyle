<?php

namespace mitstyle;

class Template {
	private $source;
	private $values;

	public function __construct($sourceFile) {
		if (!$this->source = @file_get_contents(MITSTYLE_PATH."/templates/".$sourceFile))
			throw new \Exception("Template file could not be loaded.", 501);
	}

	public function setValues($values) {
		$this->values = $values;
	}

	private function replace() {
		foreach ($this->values as $key => $value) {
			$this->source = str_replace("{{".$key."}}", $value, $this->source);
		}
	}

	public function render($display = true) {
		if (is_array($this->values))
			$this->replace();
		if ($display)
			echo $this->source;
		else
			return $this->source;
	}
} 