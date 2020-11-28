<?php
function setCache($content, $cacheId)
{
	if ($content == '') {
		return;
	}
	$fileName = 'cash/' . md5($cacheId);
	if (!file_exists('cash')) {
		mkdir('cash');
	}
	$f = fopen($fileName, 'w+');
	fwrite($f, $content);
	fclose($f);
}

function getCache($cacheId, $cashExpired = true, &$fileName = '')
{
	if (!$cashExpired) {
		return;
	}
	$fileName = 'cash/' . md5($cacheId);
	if (!file_exists($fileName)) {
		return false;
	}
	$time = time() - filemtime($fileName);
	if ($time > $cashExpired) {
		return false;
	}
	return file_get_contents($fileName);
}

function curlLoad($url, $cash = 0)
{
	$cacheId = $url;
	if ($content = getCache($cacheId, $cash)) {
		return $content;
	}

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	$content = curl_exec($ch);
	curl_close($ch);

	setCache($content, $cacheId);
	return $content;
}

$url = 'https://spb.hh.ru/search/resume?exp_period=all_time&logic=normal&pos=full_text&fromSearchLine=true&schedule=fullDay&clusters=True&area=2&order_by=relevance&no_magic=False&ored_clusters=True&st=resumeSearch&text=java';

$content = curlLoad($url, $cash = 3600);

$pattern = '~<div data-qa="resume-serp__results-search">.+<div class="bloko-gap bloko-gap_top">~isU';
preg_match($pattern, $content, $matches);

$innerContent = $matches[0];
print_r($innerContent);
preg_match_all('~class="resume-search-item__content-wrapper".*?data-qa="resume-serp__resume-additional">\s*</div>\s*</div>\s*</div>~is',
	$innerContent, $a);
var_dump(count($a[0]));
print_r($a);
