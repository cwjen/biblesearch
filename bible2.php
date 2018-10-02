<?php

echo '<!DOCTYPE html>
<html>
<head>
<style>
div.a {
    margin-left: 10px;
    line-height: 160%;
    
}
a:hover {
    color: green;
}  

a:visited {
    color: red;
}
  
</style>
</head>

<body>

<h2>聖經名詞簡單查詢系統</h2>

<form action="">
  keyword:
  <input type="text" name="search_keyword" value="">
  <input type="submit" value="Submit">
</form> 

</body>
</html>';
//$ar = get_booknames();
//echo '<pre>' . print_r( $ar, true ) . '</pre>';

require_once "bible_text.php";

echo "<br>";

if (isset( $_GET['bookchap'])){
    $bookchap =  $_GET['bookchap'];
    if ($bookchap != ''){
        print_bookchap($bookchap);
        return;
    }
}

$kywd = '';
if (isset($_GET['search_keyword'])){
    $kywd =  $_GET['search_keyword'];
}

//if ( isset($_GET['search_keyword'])){
if ($kywd != ''){
    echo '<mark>' . $_GET['search_keyword'] . ' ' . count_bible($_GET['search_keyword']) . " 次</mark>" ;
}

echo "<hr>";

include "chart.php";


echo "<br>";
echo '<div class="a">';
print_count_bible('耶和華');
print_count_bible('神');
print_count_bible('耶穌');
print_count_bible('聖靈');
print_count_bible('以色列');
print_count_bible('十字架');
print_count_bible('愛');
print_count_bible('流奶與蜜');
print_count_bible('約櫃');
//echo "</ul>";
echo '</div>';
echo "<br>";

$result_data_for_chart ;

if ( $kywd != ''){ // 如果有輸入關鍵字
    if (preg_match("/ /", $kywd)) { //輸入2個關鍵字
        $keydw_array = explode(" ",$kywd);
        $title = '以下是包含&nbsp;<mark>' . $keydw_array[0] . '</mark> 和 <mark>' . $keydw_array[1] . '</mark>&nbsp;的經文';
        echo $title;
        echo "<br>";      
        $result_books =  print_keywords_search_results($keydw_array[0],$keydw_array[1]);
        
    } else { //輸入1個關鍵字
        $title = '以下是包含&nbsp;<mark>' . $_GET['search_keyword'] . '</mark>&nbsp;的經文';
        echo $title;
        echo "<br>";      
        $result_books = print_keyword_search_results($_GET['search_keyword']);
    
        //$count_result_books = array();;
        //for ($i=0;$i<count($result_books);$i++){             
        //    $count_result_books[$result_books[$i]] = count_keyword_book($result_books[$i],$_GET['search_keyword']);
        //}
        //var_dump($count_result_books);
    }    
} else { // 如果沒有輸入關鍵字
    $title = '以下是包含&nbsp;<mark>' . '<mark>流奶與蜜</mark>' . '</mark>&nbsp;的經文';  
    echo $title;
    echo "<br>";    
    $result_books = print_keyword_search_results('流奶與蜜');
}

///////////////////////////////////////////
//Below are functions
///////////////////////////////////////////
//
///////////////////////////////////////////
function count_bible($keyword){    
    global $bible_text ;   
    return substr_count($bible_text, $keyword);
}
///////////////////////////////////////////
function print_count_bible($keyword){  
    global $bible_text ; 
    //echo '<li>' . $keyword . ' '. substr_count($bible_text, $keyword) . ' 次</li>';
    echo $keyword . ' '. substr_count($bible_text, $keyword) . ' 次';
    echo "<br>";
}
///////////////////////////////////////////
// ^\D+
// return type array 
// result books list
///////////////////////////////////////////
function print_keyword_search_results($keyword){
    if($keyword == ''){
       return ;  
    }
    global $bible_text ; 
    $lines = preg_split("/\r\n|\n|\r/", $bible_text);
    $total = 0;
    $output_text = '';
    $output_text .= "<hr>";  
    $output_text .= '<div class="a">';
    $j = 0 ;
    $result_books = array();
    $result_books[0] = '';
    for($i=1;$i<count($lines);$i++){
        if (preg_match("/$keyword/", $lines[$i])) {
            preg_match("/^\D+/", $lines[$i],$booknames); //get booknames
            
            $temp =  $booknames[0];
            if ($result_books[$j] != $temp ){   
                //$booknames[$j] =  $temp;
                array_push($result_books, $temp);
                $j++;            
            } 
            preg_match("/\d+(?=.*:)/", $lines[$i],$chapters); // get books wich chapters
            $bookchap = $booknames[0] . $chapters[0] ;
            $link = '<a href="bible2.php?bookchap=' . $bookchap . '" target="_blank">';
            $link .= $bookchap . '</a>'; 
            $lines[$i] = str_replace($bookchap, $link ,$lines[$i]);   
            $line = str_replace($keyword,"<mark>$keyword</mark>",$lines[$i]);
            $output_text .=  $line;
            $output_text .= '<br>';
        $total++;
        }
    }
    $output_text .=  '</div>';
    echo '總共出現在: ' . $total . ' 節 經文中';
    echo $output_text;
    echo '<br>';
    
    array_shift($result_books);
    return $result_books;
}
///////////////////////////////////////////
// return type array 
// result books list
///////////////////////////////////////////
function print_keywords_search_results($keyword1,$keyword2){
   global $bible_text ; 
   $lines = preg_split("/\r\n|\n|\r/", $bible_text);
   $total = 0;
   $output_text = '';
   $output_text .= "<hr>";  
   $output_text .= '<div class="a">';
   $j = 0 ;
   $result_books = array();
   $result_books[0] = '';
   for($i=1;$i<count($lines);$i++){
       if ( (preg_match("/$keyword1/", $lines[$i])) && (preg_match("/$keyword2/", $lines[$i])) ) {
        
           preg_match("/^\D+/", $lines[$i],$booknames); //get booknames
           
           $temp =  $booknames[0];
           if ($result_books[$j] != $temp ){   
               //$booknames[$j] =  $temp;
               array_push($result_books, $temp);
               $j++;            
           } 
           
           preg_match("/\d+(?=.*:)/", $lines[$i],$chapters); // get books wich chapters
           $bookchap = $booknames[0] . $chapters[0] ;
           $link = '<a href="bible2.php?bookchap=' . $bookchap . '" target="_blank">';
           $link .= $bookchap . '</a>'; 
           $lines[$i] = str_replace($bookchap, $link ,$lines[$i]);           
           $line = str_replace($keyword1,"<mark>$keyword1</mark>",$lines[$i]);
           $line = str_replace($keyword2,"<mark>$keyword2</mark>",$line);
           $output_text .=  $line;
           $output_text .= '<br>';
       $total++;
       }
   }
   $output_text .=  '</div>';

   echo '總共出現在: ' . $total . ' 節 經文中';
   echo $output_text;
   echo '<br>';
   
   array_shift($result_books);
   echo var_dump($result_books);  
   return $result_books;
   
}
///////////////////////////////////////////
// need to do
//
///////////////////////////////////////////

function print_keywords_search_results_multi_scriptures($keyword1,$keyword2){ 
   global $bible_text ;
   $lines = preg_split("/\r\n|\n|\r/", $bible_text);
   $range = 2;
   $total = 0;
   $output_text = '';
   $output_text .= "<hr>";  
   $output_text .= '<div class="a">';
   for($i=1;$i<count($lines);$i++){
       if ( (preg_match("/$keyword1/", $lines[$i])) && (preg_match("/$keyword2/", $lines[$i])) ) {
           $line = str_replace($keyword1,"<mark>$keyword1</mark>",$lines[$i]);
           $line = str_replace($keyword2,"<mark>$keyword2</mark>",$line);
           $output_text .=  $line;
           $output_text .= '<br>';
       $total++;
       }
   }
   $output_text .=  '</div>';

   echo '總共出現在: ' . $total . ' 節經文中';
   echo $output_text;
   echo '<br>';
}
//////////////////////////////////
// print_bookchap('出2');
/////////////////////////////////
function print_bookchap($bookchap){
    if($bookchap == ''){
       return ;  
    }
   global $bible_text ; 
   $lines = preg_split("/\r\n|\n|\r/", $bible_text);
   $total = 0;
   $output_text = '';
   $output_text .= "<hr>";  
   $output_text .= '<div class="a">';
   $bookchap = $bookchap . ':';
   for($i=1;$i<count($lines);$i++){
        if (preg_match("/^$bookchap/", $lines[$i])) {
            //$line = str_replace($keyword,"<mark>$keyword</mark>",$lines[$i]);
            preg_match("/^\D+/", $lines[$i],$booknames); //get booknames
            preg_match("/\d+(?=.*:)/", $lines[$i],$chapters); // get books wich chapters
            //echo '<font color="red">' . $booknames[0] . $chapters[0] . '</font>'; 
            $bookchap = $booknames[0] . $chapters[0] ;
            //$line = str_replace($bookchap,"<mark>$bookchap</mark>",$lines[$i]);
            $output_text .=  $lines[$i];
            $output_text .= '<br>';
        $total++;
        }
    }
    $output_text .=  '</div>';
    echo $output_text;
    echo '<br>';
}
//////////////////////////////////
// return an array of 66 books names 
//
//////////////////////////////////
function get_booknames(){ 
    include "bible_text.php" ;
    $lines = preg_split("/\r\n|\n|\r/", $bible_text); 
    $booknames = array();
    $booknames[0] ='';
    $j = 0;
    for($i=1;$i<count($lines);$i++){
        preg_match("/^\D+/", $lines[$i],$booknames_temp);
        $temp =  $booknames_temp[0];    
        if ($booknames[$j] != $temp ){   
            //$booknames[$j] =  $temp;
            array_push($booknames, $temp);
            $j++;            
        }
    }    
    array_shift($booknames);
    return $booknames;
}
//////////////////////////////////
//get_bookname_order('來')
//return int
//order of 66
//////////////////////////////////
function get_bookname_order($bookname){ 
    $books = get_booknames();
    $order = array_search($bookname, $books); 
    return $order ;
}
//////////////////////////////////
//return type associative array
//66 books start line number
//////////////////////////////////
function get_booksrange(){ 
    global $bible_text ; 
    $lines = preg_split("/\r\n|\n|\r/", $bible_text);
    $booknames = array();
    $booknames[0] ='';
    $bookranges ;
    $j = 0;
    
    for($i=1;$i<count($lines);$i++){
        preg_match("/^\D+/", $lines[$i],$booknames_temp);
        $temp =  $booknames_temp[0];
        if ($booknames[$j] != $temp ){   
            array_push($booknames, $temp);
            $bookranges[$temp] = $i;
            $j++;            
        }
    } 
    return $bookranges;
}
///////////////////////////////////
// get_bookrange('來')
// return type array
// array[0] : start number of line
// array[1] : end number of line
///////////////////////////////////

function get_bookrange($bookname){
    $bookrangs = get_booksrange();
    $bookrang1 = $bookrangs[$bookname];
    //echo $bookrang1 ;
    $book_order = get_bookname_order($bookname);

    $book_list = get_booknames(); 
     
    $next_name = $book_list[$book_order + 1];
    $bookrang2 = $bookrangs[$next_name] - 1;
    
   return array($bookrang1,$bookrang2);
}
////////////////////////////////////
// print_book('西');
// print the book
////////////////////////////////////
function print_book($bookname){
    $range = get_bookrange($bookname);
    //include "bible_text.php" ;
    global $bible_text ;
    $lines = preg_split("/\r\n|\n|\r/", $bible_text);

    for($i=$range[0];$i<=$range[1];$i++){
        echo $lines[$i];
        echo '<br>';
    }    
}
////////////////////////////////////
// count_keyword_book('創','彼此')
// return type int
// count of keywords appearly in the book
////////////////////////////////////
function count_keyword_book($bookname,$keyword){
    $range = get_bookrange($bookname);
    global $bible_text ;
    $lines = preg_split("/\r\n|\n|\r/", $bible_text);
    $content = '' ;
    
    for($i=$range[0];$i<=$range[1];$i++){
        $content .= $lines[$i];
    }     
    $count = substr_count($content, $keyword);
    return $count;
}





?>
