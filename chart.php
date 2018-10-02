<?php
 
$dataPoints = array(
	array("label"=> "創", "y"=> 4),
    array("label"=> "出", "y"=> 3),
    array("label"=> "利", "y"=> 2),
    array("label"=> "民", "y"=> 1),
    array("label"=> "申", "y"=> 1),
    array("label"=> "書", "y"=> 1),
    array("label"=> "士", "y"=> 1),
    array("label"=> "得", "y"=> 1),
	array("label"=> "撒上", "y"=> 1),
    array("label"=> "撒下", "y"=> 2),
    array("label"=> "王上", "y"=> 3),
    array("label"=> "王下", "y"=> 4),
    array("label"=> "代上", "y"=> 2),
    array("label"=> "代下", "y"=> 1),
    array("label"=> "拉", "y"=> 0),
    array("label"=> "尼", "y"=> 0),
	array("label"=> "斯", "y"=> 4),
    array("label"=> "伯", "y"=> 0),
    array("label"=> "詩", "y"=> 0),
    array("label"=> "箴", "y"=> 0),
    array("label"=> "傳", "y"=> 0),
    array("label"=> "歌", "y"=> 0),
    array("label"=> "賽", "y"=> 0),
    array("label"=> "耶", "y"=> 0),
    array("label"=> "哀", "y"=> 0),
    array("label"=> "結", "y"=> 0),
    array("label"=> "但", "y"=> 0),
    array("label"=> "何", "y"=> 0),
    array("label"=> "珥", "y"=> 0),
    array("label"=> "摩", "y"=> 0),
    array("label"=> "俄", "y"=> 0),
    array("label"=> "拿", "y"=> 0),
    array("label"=> "彌", "y"=> 0),
    array("label"=> "鴻", "y"=> 0),
    array("label"=> "哈", "y"=> 0),
    array("label"=> "番", "y"=> 0),
    array("label"=> "該", "y"=> 0),
    array("label"=> "亞", "y"=> 0),
	array("label"=> "瑪", "y"=> 6),
	array("label"=> "太", "y"=> 1),
	array("label"=> "可", "y"=> 1),
	array("label"=> "路", "y"=> 2),
    array("label"=> "約", "y"=> 0),
    array("label"=> "徒", "y"=> 0),
    array("label"=> "羅", "y"=> 0),
    array("label"=> "林前", "y"=> 0),
    array("label"=> "林後", "y"=> 0),
    array("label"=> "加", "y"=> 0),
    array("label"=> "弗", "y"=> 0),
	array("label"=> "腓", "y"=> 2),
    array("label"=> "西", "y"=> 0),
    array("label"=> "帖前", "y"=> 0),
    array("label"=> "帖後", "y"=> 0),
    array("label"=> "提前", "y"=> 0),
    array("label"=> "提後", "y"=> 0),
    array("label"=> "多", "y"=> 0),
    array("label"=> "門", "y"=> 0),
    array("label"=> "來", "y"=> 0),
	array("label"=> "雅", "y"=> 2),
    array("label"=> "彼前", "y"=> 0),
    array("label"=> "彼後", "y"=> 0),
    array("label"=> "約一", "y"=> 0),
    array("label"=> "約二", "y"=> 0),
    array("label"=> "約三", "y"=> 0),
    array("label"=> "猶", "y"=> 0),
    array("label"=> "啟", "y"=> 0)
);
	
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title: {
		text: "『流奶與蜜』 於 聖經各書卷分佈"
	},
    axisX:{
      interval: 1,
      labelAngle: -0 
     },
	axisY: {
		title: "出現的次數",
		includeZero: false,
        labelAngle: -90
	},
	data: [{
		type: "column",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html> 