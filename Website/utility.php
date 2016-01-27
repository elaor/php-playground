<?php

function stripcleantohtml($s) {
	// Restores the added slashes (ie.: " I\'m John " for security in output, and escapes them in htmlentities(ie.:  &quot; etc.)
	// Also strips any <html> tags it may encouter
	// Use: Anything that shouldn't contain html (pretty much everything that is not a textarea)
	return htmlentities(trim(strip_tags(stripslashes($s))), ENT_NOQUOTES, "UTF-8");
}