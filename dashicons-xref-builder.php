<?php

// Remove this to run
die();

$doc = new DomDocument();
$doc->loadHtml(file_get_contents('http://melchoyce.github.io/dashicons/'));

$xpath = new DOMXpath($doc);
$elements = $xpath->query("//div[contains(concat(' ',normalize-space(@class),' '),' dashicons ')]");

$function = "<?php\n\n";
$function .= "/**\n";
$function .= " * Convert a Dashicon name to its glyph value\n";
$function .= " *\n";
$function .= " * @param string dashicon_name ex. \"dashicon-clock\"\n";
$function .= " * @return string glyph code ex. \"\\f469\"\n";
$function .= "*/\n";
$function .= "function dashicon_name_to_glyph(\$dashicon_name) {\n\n";
$function .= "\tstatic \$xref;\n";
$function .= "\tif(!isset(\$xref)) {\n";
$function .= "\t\t\$xref = array();\n";
foreach($elements as $element) {

	$code = $element->getAttribute('data-code');
	$name = explode(' ', $element->getAttribute('class'))[1];
	$function .= "\t\t\$xref['$name'] = '\\$code';\n";

}
$function .= "\t}\n\n";
$function .= "\tif(isset(\$xref[\$dashicon_name])) {\n";
$function .= "\t\treturn \$xref[\$dashicon_name];\n";
$function .= "\t}\n";
$function .= "\telse {\n";
$function .= "\t\treturn '';\n";
$function .= "\t}\n";
$function .= "}\n\n";
echo $function;
