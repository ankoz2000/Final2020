<?php
require_once __DIR__ . '/searchKeyWords.php';

class Curl
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    private function setCache($content, $cacheId)
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

    private function getCache($cacheId, $cashExpired = true, &$fileName = ''): string
    {
        if (!$cashExpired) {
            return "";
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

    /*
     * добавляет или извлекает страницу из кэша
     */
    private function curlLoad($url, $cash = 0): string
    {
        $cacheId = $url;
        if ($content = $this->getCache($cacheId, $cash)) {
            return $content;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $content = curl_exec($ch);
        curl_close($ch);

        $this->setCache($content, $cacheId);
        return $content;
    }

    /*
     * content возвращает всю страницу спарсенную с сайта, для дальнейшего парсинга нужных данных
     */
    public function content(): string
    {
        $content = $this->curlLoad($this->getUrl(), $cash = 3600);
        return $content;
    }

    function arrayResume($content): array
    {
        $pattern = '~<div data-qa="resume-serp__results-search">.+<div class="bloko-gap bloko-gap_top">~isU';
        preg_match($pattern, $content, $matches);
        //print_r($matches);
        preg_match_all('~href="(.*)">(.*)</a>~isU', $matches[0], $links);
        print_r($links);
        $viewLink = $links[1];//ссылка на резюме
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
        echo '</div>';
        //print_r($summaries);
        return $summaries;
    }

    /*
     * smallViewResume возвращает небольшое описание резюме
     */
    public function smallViewResume(string $content): array
    {
        $pattern = '~<div data-qa="resume-serp__results-search">.+<div class="bloko-gap bloko-gap_top">~isU';
        preg_match($pattern, $content, $matches);
        return $matches;
    }

    /*
     * linkResume возвращает массив ссылок на резюме
     */
    public function linkResume(string $content)
    {
        $matches = $this->smallViewResume($content);
        preg_match_all('~href="(.*)">.*</a>~isU', $matches[0], $links);
        unset($links[0]);
        return $links[1];
    }

    /*
     * nameResume возвращает массив названией резюме
     */
    public function nameResume(string $content)
    {
        $matches = $this->smallViewResume($content);
        preg_match_all('~href=".*">(.*)</a>~isU', $matches[0], $links);
        unset($links[0]);
        return $links[1];
    }

    public function resumes(): array
    {
        $links = $this->linkResume($this->content());
        foreach ($links as $link){
            //парсинг резюме по ссылкам
            $summaries_links = $this->curlLoad('https://spb.hh.ru' . $link, $cash = 3600);
            $pattern = '~<div class="resume-applicant">(?P<resume>.*)?</div>\s*</div>\s*</div>\s*</div></div>\s*</div>\s*</div>\s*</div>\s*</div>\s*</div>~isU';
            preg_match($pattern, $summaries_links, $matches);
            $summaries['https://hh.ru' . $link] = $matches['resume'];
        }
        return $summaries;
    }


    public function startCurl(): array
    {
        $url = $this->getUrl();

        //получаем весь контент страницы
        $content = $this->curlLoad($url, $cash = 3600);
        //получаем БД резюме по отдельности в массиве
        $summaries = $this->arrayResume($content);
        return $summaries;
        /*$searchKeyWorld = new SearchKeyWorld($summaries, $keywords);
        $key = $searchKeyWorld->keywords();

        foreach ($key as $resume => $text) {
            echo '<header class="resume">';
            echo '<a class="link-resume" href="' . $resume . '">Данное резюме</a>';
            echo $text;
            echo '</header>';
        }*/
    }
}
