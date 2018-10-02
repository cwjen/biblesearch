<?php

ini_set('memory_limit', '1024M');

require_once "/jieba/vendor/multi-array/MultiArray.php";
require_once "/jieba/vendor/multi-array/Factory/MultiArrayFactory.php";
require_once "/jieba/class/Jieba.php";
require_once "/jieba/class/Finalseg.php";
require_once "/jieba/class/JiebaAnalyse.php";
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\JiebaAnalyse;
Jieba::init(array('mode'=>'default','dict'=>'big'));
Jieba::loadUserDict('c:/xampp/htdocs/algorithms/LearnPHP/jieba/dict/user_dict.txt'); # file_name 為自定義詞典的絕對路徑
Finalseg::init();
JiebaAnalyse::init();

$top_k = 10;
$content = file_get_contents("/gen1.txt", "r");

$tags = JiebaAnalyse::extractTags($content, $top_k);

var_dump($tags);

/*
include "bible_text.php" ;
echo substr_count($bible_text, '耶穌');
echo "<br>";
echo substr_count($bible_text, '神');
echo "<br>";
echo substr_count($bible_text, '耶和華');
echo "<br>";
echo substr_count($bible_text, '聖靈');
echo "<br>";
echo substr_count($bible_text, '以色列');
echo "<br>";
echo substr_count($bible_text, '十字架');
echo "<br>";
echo substr_count($bible_text, '愛');
echo "<br>";
$lines = preg_split("/\r\n|\n|\r/", $bible_text);
for($i=1;$i<=6;$i++){
    
    //echo "<br>";
    //echo $lines[$i];
    
}

$key = array_search('創1:4', $lines);
//echo count($lines);

$array = ['a ', 'b', 'c'];
$key = array_search('a', $array); //$key = 0
//echo $key;
//substr($string, $pos, ( strpos($string, PHP_EOL, $pos) ) - $pos);
//substr($string, $pos, strpos($string, PHP_EOL, $pos));
//$rest = substr("abcdef", 0, -1);  // returns "abcde"
//substr($line, strpos($line,'創1:4'), PHP_EOL
$keyword = '愛';
$total = 0;
for($i=1;$i<count($lines);$i++){
    if (preg_match("/$keyword/", $lines[$i])) {
        echo $lines[$i];
        echo '<br>';
        $total++;
    }
}
echo $total;
*/

?>