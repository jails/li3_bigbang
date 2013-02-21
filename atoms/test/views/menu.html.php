<?php
use lithium\util\Set;

$menu = Set::expand(array_flip($menu), array('separator' => '\\'));

$ul = function($menu, $namespace) use (&$ul, $baseUrl) {
	$ret = '<ul>';
	foreach($menu as $key => $value) {
		if(is_array($value)) {
			$link = '<a href="' . $baseUrl .'test' . $namespace . '/' . $key . '" title="run ' . $key .'">';
			$link .= $key . '</a>';
			$ret .= '<li>' . $link . $ul($value, $namespace . '/' . $key) . '</li>';
		} else {
			$case = preg_replace('/Test$/', null, $key);
			$link = '<a href="' . $baseUrl .'test' . $namespace . '/' . $key . '" title="run ' . $case .'">';
			$link .= $case . '</a>';
			$ret .= '<li>' . $link . '</li>';
		}
	}
	$ret .= '</ul>';
	return $ret;
};

$result = array();
$library = key($menu);

$menus = current($menu);
if (is_array($menus)) {
	$menus = current($menus);

	foreach ($menus as $type => $categs) {
		$col = 0;
		$cpt = 0;
		$count = count ($categs) / 4;
		$jump = $count;
		foreach ($categs as $categ => $menu) {
			if (!isset($result[$type][$col])) {
				$result[$type][$col] = '';
			}
			$namespace = '/'. $library . '/tests/' . $type . '/' . $categ;
			$link = '<h4><a href="' . $baseUrl .'test' . $namespace . '" title="run ' . $categ .'">' . $categ .'</a></h4>';
			$result[$type][$col] .= $link . $ul($menu, $namespace);
			$cpt++;
			if($cpt > $jump) {
				$jump += $count;
				$col++;
			}
		}
	}
}

echo '<h2><a href="' . $baseUrl .'test/' . $library . '/tests/" title="All ' . $library .' tests">All ' . $library .' tests</a></h2>';
	
foreach ($result as $type => $cols) {
	echo '<h3><a href="' . $baseUrl .'test/' . $library . '/tests/' . $type . '" title="run ' . $type .'">' . $type .'</a></h3>';
	echo '<div class="row"><div class="span10">';
	foreach ($cols as $key => $value) {
		echo '<div class="span2">';
		echo $value;
		echo '</div>';
	}
	echo '</div></div>';
}
?>
