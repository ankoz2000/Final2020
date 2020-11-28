<?php
$summaries = require_once __DIR__ . '/curl.php';

function keywords(array $summaries, array $keywords = ['SQL', 'Java', 'MySQL', 'REST'])
{
	foreach ($summaries as $link => $resume) {
		for ($i = 0; $i < count($keywords); $i++) {

			$search = $keywords[$i];
			$replace = '<span style="font-size: 200%; font-family: monospace; background: lightgreen">' . $search . '</span>';
			if ($i === 0) {
				$subject = $resume;
			} else {
				$subject = $query;
			}

			$query = str_ireplace($search, $replace, $subject, $count);

			if ($count > 0) {
				$summaries[$link] = $query;
				$keysFound[] = $search;
			}
		}
	}
	return $summaries;
}

$summaries = keywords($summaries);
print_r($summaries);