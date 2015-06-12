<?php

namespace mitstyle;

function mitstyle_autoload($className) {
	$names      = explode("\\", $className);
	$className  = $names[1];
	$namespace  = $names[0];

	if ($namespace != "mitstyle")
		$subdir = "$namespace/";
	else
		$subdir = "";
	if (file_exists(MITSTYLE_PATH."/classes/$subdir$className.php"))
		include(MITSTYLE_PATH."/classes/$subdir$className.php");
}

spl_autoload_register("\mitstyle\mitstyle_autoload");