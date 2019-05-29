<?php
echo '<meta http-equiv="Content-Type" content="text/html;
charset=utf-8" />';
$showmsg;
$filename='file/msg.txt';
if(isset($_POST['msg'])){
	setmsg($filename, $_POST['msg']);
	header('refresh:1;url=msg.php');
	echo "<script>alert('添加成功');</script>";
	$showmsg=getmsg('file/msg.txt');
}
else{
	$showmsg=getmsg('file/msg.txt');
}

if(is_array($_POST) && count($_POST)>0){
	if(isset($_POST['msg'])){
		$postmsg=$_POST['msg'];
		setmsg($postmsg, $filename);
		header('refresh:1;url
		=msg.php');
		echo "<script>alert('添加成功');</script>";
		$showmsg=getmsg($filename);
	}
}



function getmsg($fileurl){
	$remsg='';
	if(filesize($fileurl)>0){
		$memo=file_get_contents($fileurl);
		$msgarr=explode('|', $memo);
		if(count($msgarr)>1){
			foreach($msgarr as $key=>$val){
				$remsg.='<p>'.$val.'<span calss=del><a href="delmsg.php?id='.$key.'">删除</a></span></p>';
			}
		}else{
			$remsg=$msgarr[0];
		}
	}
	else{
		$remsg='';
	}
	return $remsg;
}

/*保存*/
	function setmsg($fileurl,$msg){
		$memo='';
		if(filesize($fileurl)>0){
			$memo=file_get_contents($fileurl);
			$memo.='|'.$msg;
		}else{
			$memo=$msg;
		}
		file_put_contents($fileurl, $memo);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<style type="text/css">
			.talk{

			}
		</style>
	</head>
	<body>
		<div class="talk">
			<div class="showmsg">
				<?php
					echo $showmsg;
				?>
			</div>
		</div>
		<div class="getform">
			<form method="post" action="msg.php">
				<table align="center">
					<tr>
						<td>点击添加</td>
							<td>
							<textarea rows="10" cols="50" name="msg" required="required">
								
							</textarea>
							</td>
						</tr>
					<tr align="center">
						<td colspan="2">
							<input type="submit" value="提交"/>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>
