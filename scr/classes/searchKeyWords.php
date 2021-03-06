<?php

class SearchKeyWorld
{
	private $summaries;
	private $keywords;

	public function __construct(array $summaries, array $keywords)
	{
		$this->summaries = $summaries;
		$this->keywords = $keywords;
	}
	/**
	 * @return array
	 */
	private function getSummaries(): array
	{
		return $this->summaries;
	}

	/**
	 * @return array
	 */
	private function getKeywords(): array
	{
		return $this->keywords;
	}
    private function workVarible(string $strKey): array
    {
        //формируем массив ключей для поиска keywords
        $strKey = str_ireplace(', ', ',', $strKey);
        $keywords = explode(',', $strKey);
        if ($keywords === "") {
            return [];
        } else {
            return $keywords;
        }
    }

	function keywords()
	{

		$summaries = $this->getSummaries();
		$keywords = $this->getKeywords();

		foreach ($summaries as $link => $resume) {

			for ($i = 0; $i < count($keywords); $i++) {

				$search = $keywords[$i];
				$replace = '<span style="font-size: 200%; font-family: monospace; background: lightgreen">' . $search . '</span>';
				if ($i == 0) {
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
}