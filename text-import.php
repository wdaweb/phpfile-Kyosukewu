<?php
/****
 * 1.建立資料庫及資料表
 * 2.建立上傳檔案機制
 * 3.取得檔案資源
 * 4.取得檔案內容
 * 5.建立SQL語法
 * 6.寫入資料庫
 * 7.結束檔案
 */
include_once "base.php";

if(!empty($_FILES['txt']['tmp_name'])){
    echo $_FILES['txt']['name'];
    move_uploaded_file($_FILES['txt']['tmp_name'],"./upload/".$_FILES['txt']['name']);

    $file=fopen("./upload/".$_FILES['txt']['name'],"r");//(url,文件類型) r->唯讀
    $num=0;
    while(!feof($file)){ //判斷檔案何時結束
        $line=fgets($file);
        if($num!=0){
            // echo $line;//取得第一行
            // $line=fgets($file);
            //echo $line;//取得第二行
            $line=explode(",",$line);//重複使用
            $data=[
                'name'=>$line[1],
                'age'=>$line[2],
                'birthday'=>$line[3],
                'addr'=>$line[4]
            ];
        save('students',$data);
        }
        $num++;
    }
    fclose($file);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文字檔案匯入</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 class="header">文字檔案匯入練習</h1>
<!---建立檔案上傳機制--->
<form action="?" method="post" enctype="multipart/form-data" style="width:300px;margin:auto;">
<input type="file" name="txt">
<input type="submit" value="上傳">
</form>



<!----讀出匯入完成的資料----->



</body>
</html>