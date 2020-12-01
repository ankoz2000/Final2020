<?php
/*$viewLink = $links[1];//ссылка на резюме
$viewName = $links[2];//название
$summaries = [];

echo '<div class="list-vacansion">';
echo '<p>Найдено ' . count($viewLink) . ' вакансий.</p><ol>';
for ($i = 0; $i < count($viewLink); $i++) {
    echo '<li><a href="https://hh.ru' . $viewLink[$i] . '">' . $viewName[$i] . '</a></li>';
    //парсинг резюме по ссылкам
    $summaries_links = $this->curlLoad('https://spb.hh.ru' . $viewLink[$i], $cash = 3600);
    $pattern = '~<div class="resume-applicant">(?P<resume>.*)?</div>\s*</div>\s*</div>\s*</div></div>\s*</div>\s*</div>\s*</div>\s*</div>\s*</div>~isU';
    preg_match($pattern, $summaries_links, $matches);
    $summaries['https://spb.hh.ru' . $viewLink[$i]] = $matches['resume'];

}
echo '</ol>';
echo '</div>';*/