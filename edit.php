<?php
include_once "base.php";

if(!empty($_GET['id'])){
    $row=find('upload',$_GET['id']);
}
if(!empty($_POST)){
    $row=find('upload',$_POST['id']); 

    if(!empty($_FILES['img']['tmp_name'])){
        $row['name']=$_FILES['img']['tmp_name'];
        $subname="";
        $subname=explode('.',$_FILES['img']['name']);
        $subname=array_pop($subname);
        $filename=date("Ymdhis").".".$subname;
        unlink($row['path']);

        $row['path']="./img/".$filename;
        move_uploaded_file($_FILES['img']['tmp_name'],$row['path']);
    }
    
    $row['type']=$_POST['type'];
    $row['note']=$_POST['note'];

    save('upload',$row);
    to('manage.php');
}

?>


<form class="edit" action="" method="post" enctype="multipart/form-data">
<div><img src="<?=$row['path'];?>" style="width:200px;"></div>
    <div>上傳的檔案：<input type="file" name="img"></div>
    <div>檔案說明：<input type="text" name="note" value="<?=$row['note'];?>"></div>
    <div>檔案類型：<select name="type">
        <option value="圖檔" <?=($row['type']=='圖檔')?'selected':'';?>>圖檔</option>
        <option value="文件" <?=($row['type']=='文件')?'selected':'';?>>文件</option>
        <option value="其他" <?=($row['type']=='其他')?'selected':'';?>>其他</option>
    </select>
    <input type="hidden" name="id" value="<?=$row['id'];?>">
    </div>
    <div><input type="submit" value="更新"></div>
</form>