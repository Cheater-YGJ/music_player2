<?php
header('Content-type:text/html;charset=utf8');
ini_set("display_errors", "Off");
$path = $_GET["path"];
$dirList = array("../../resources/music");
$resultArray = array();

if($path=="all"){
	for ($i=0; $i < count($dirList); $i++) { 
		scanFiles($dirList[$i]);
	}
}else{
	for ($i=0; $i < count($dirList); $i++) { 
		if($path==$dirList[$i])
			scanFiles($dirList[$i]);
	}
}

if(count($resultArray)>0){
	echo json_encode($resultArray);
	// var_dump($resultArray);
}else{
	echo 0;
}

function scanFiles($dir){
	global $resultArray; //声明用于存放结果的全局数组
	if ($dh = opendir($dir)){
		while (($file = readdir($dh))!== false){
			$filePath = $dir.'/'.$file; //文件名的全路径，包含文件名
			if(is_file($filePath)){
				array_push($resultArray,iconv('GB2312','UTF-8//IGNORE',$filePath));
			}else{
				if($file!="."&&$file!="..")
					scanFiles($filePath);
			}
		}
		closedir($dh);
	}
}
?>