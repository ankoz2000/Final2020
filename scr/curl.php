<?php
require_once __DIR__ . '/searchKeyWords.php';

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

function arrayResume($content)
{
	$pattern = '~<div data-qa="resume-serp__results-search">.+<div class="bloko-gap bloko-gap_top">~isU';
	preg_match($pattern, $content, $matches);
	$innerContent = $matches[0];
	preg_match_all('~href="(.*)">(.*)</a>~isU', $innerContent, $links);

	$viewLink = $links[1];//ссылка на резюме
	$viewName = $links[2];//название
	$summaries = [];

	echo '<div class="list-vacansion">';
	echo '<p>Найдено ' . count($viewLink) . ' вакансий.</p><ol>';
	for ($i = 0; $i < count($viewLink); $i++) {
		echo '<li><a href="https://hh.ru' . $viewLink[$i] . '">' . $viewName[$i] . '</a></li>';
		//парсинг резюме по ссылкам
		$summaries_links = curlLoad('https://spb.hh.ru' . $viewLink[$i], $cash = 3600);
		$pattern = '~<div class="resume-applicant">(?P<resume>.*)?</div>\s*</div>\s*</div>\s*</div></div>\s*</div>\s*</div>\s*</div>\s*</div>\s*</div>~isU';
		preg_match($pattern, $summaries_links, $matches);
		$summaries['https://spb.hh.ru' . $viewLink[$i]] = $matches['resume'];
	}
	echo '</ol>';
	echo '</div>';
	return $summaries;
}

//точка входа
$strSearch = '';
if (!empty($_GET['text'])){
	$strSearch = $_GET['text'];
	$strKey = $_GET['keyWords'];
}

if (strpos($strSearch, ' ') !== false) {
	$strSearch = str_ireplace(" ", "+", $strSearch);
}


if (empty($_GET['text'])) {
	return;
}
$url = 'https://spb.hh.ru/search/resume?clusters=True&area=2&order_by=relevance&logic=normal&pos=position&exp_period=all_time&no_magic=False&ored_clusters=True&st=resumeSearch&text='
	. $strSearch;

$strKey = str_ireplace(', ', ',' , $strKey);
$keywords = explode(',', $strKey);

//получаем весь контент страницы
$content = curlLoad($url, $cash = 3600);
//получаем БД резюме по отдельности в массиве
$resumeArray = arrayResume($content);

$searchKeyWorld = new SearchKeyWorld($resumeArray, $keywords);
$key = $searchKeyWorld->keywords();

foreach ($key as $resume => $text) {
	echo '<header class="resume">';
		echo '<a class="link-resume" href="'.$resume . '">Данное резюме</a>';
		echo $text;
	echo '</header>';
}