<?php
/**
 * 演示DEMO
 * @author Flc <2015-08-27 22:52:22>
 */
header('Content-type: application/json');
require_once "kugou.class.php";

$kugou = new kugou();
$lists = $kugou->getList($_POST['content']);
//echo count($lists);


//print_r($lists);
$info=array();
$all=array();

for($iw=0;$iw<count($lists);$iw++)
{
$music = $kugou->getMusic($lists[$iw]['hash']);
array_push($info,$music['url']);
array_push($info,$music['songName']);
array_push($info,$music['singerName']);
array_push($info,str_replace("{size}",$music['fileHead'],$music['imgUrl']));
array_push($all,$info);
$info=array();
}

echo json_encode($all);
?>

