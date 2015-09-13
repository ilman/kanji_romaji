<?php 

require_once('vendor/autoload.php');

use JpnForPhp\Transliterator\Romaji;
use JpnForPhp\Transliterator\Kana;

$romaji = new Romaji();

$data = file_get_contents('data/kanji.json');
$data = @json_decode($data);
$data_kanji = $data->kanji;

$cats = array();
$sets = array();
foreach($data_kanji as $row){
	if(!in_array($row->category, $cats, true)){
		array_push($cats, $row->category);
		$sets[$row->category] = array();
	}
}

foreach($data_kanji as $row){
	foreach ($cats as $cat) {
		if($row->category === $cat){
			$row->onyomi_romaji = $romaji->transliterate($row->onyomi);
			$row->kunyomi_romaji = $romaji->transliterate($row->kunyomi);
			$sets[$cat][] = $row;
		}
		else{
			continue;
		}
	}
}

foreach($sets as $key=>$row){
	$content = json_encode($row, JSON_PRETTY_PRINT);
	file_put_contents('data/'.$key.'.json', $content);
}