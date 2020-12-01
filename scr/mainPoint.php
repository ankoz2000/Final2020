<?php
require_once __DIR__ . '/classes/curl.php';

class MainPoint
{
    private $strSearch;
    private $strKey;

    public function __construct(string $strSearch)
    {
        $this->strSearch = $strSearch;
    }

    /**
     * @return string
     */
    public function getStrSearch(): string
    {
        return $this->strSearch;
    }


    //обработка переменных
    private function workSerchText(string $tempSearch): string
    {
        //замена пробелов в строке поиска на +
        if (strpos($tempSearch, ' ') !== false) {
            $tempSearch = str_ireplace(" ", "+", $tempSearch);
        }
        //если строка поиска пустая ничего не делать
        if (empty($tempSearch)) {
            return '';
        }
        return $tempSearch;
    }




    public function getAllResume()
    {
        $text = $this->getStrSearch();
        $strSearch = $this->workSerchText($text);
        //адрес поиска text=что ищем
        $url = 'https://spb.hh.ru/search/resume?clusters=True&area=2&order_by=relevance&logic=normal&pos=position&exp_period=all_time&no_magic=False&ored_clusters=True&st=resumeSearch&text='
            . $strSearch;

        $curl = new Curl($url);
        $content = $curl->content();
        $smallResume = $curl->smallViewResume($content);
        $link = $curl->nameResume($content);
        $resumes = $curl->resumes();

    }
}
