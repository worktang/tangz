<?php
header('content-type:text/html;charset=utf-8');
echo '<meta http-equiv="Content-Type" content="text/html;
charset=utf-8" />';
$filename='file/msg.txt';
if(isset($_GET['id'])){
	delmsg($filename,$_GET['id']);
}
function delmsg($fileurl,$id){
	if(filesize($fileurl)>0){
		$memo=file_get_contents($fileurl);
		$arr=explode('|',$memo);
		if(count($arr)>0){
			unset($arr[$id]);
			$msg=implode('|', $arr);
			file_put_contents($fileurl, $msg);
			header('refresh:2;url=msg.php');
			echo "<script>alert('删除成功');</script>";
		}
	}
}
?>