<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>圖形驗證碼</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!----產生圖形驗證碼----->
    <h2>圖形驗證碼</h2>
<?php
    session_start();
    $str = captcha(6);
    $img = captchapic($str);
    if(!empty($_POST['ans'])){
        echo "你輸入的驗證碼為：".$_POST['ans'];
        echo "<br>";
        echo "比對的驗證碼為：".$str."<br>";
        echo "<br>";
        echo "原始的驗證碼為：".$_POST['src']."<br>";
        if($_POST['ans']==$_SESSION['ans']){
            echo "驗證碼正確";
        }else{
            echo "驗證碼錯誤";
        }
    }
    $_SESSION['ans']=$str;
?>

    <form action="?" method="post">
    <?="<img src='$img'>";?>
    <input type="text" name="ans">
    <input type="hidden" name="src" value="<?=$str;?>">
    <input type="submit" value="送出">

    </form>





    <?php
    // echo "<div>";
    // echo "<img src='$img'>";
    // echo "</div>";

    //ASCII 數字:48~57,大寫英文:65~90,小寫英文:97~122

    function captcha($num)
    {
        $str = "";
        for ($i = 0; $i < $num; $i++) {
            $type = rand(1, 3);
            switch ($type) {
                case 1:
                    $str = $str . chr(rand(65, 90));
                    break;
                case 2:
                    $str = $str . chr(rand(97, 122));
                    break;
                case 3:
                    $str = $str . chr(rand(48, 57));
                    break;
            }
        }
        return $str;
    }

    function captchapic($str){
         //產生底圖
        $padding = 10;
        $fontsize = 24;
        $fontlist = ['ITCKRIST.ttf', 'ALGER.TTF', 'CHILLER.TTF'];
        $fontpath = realpath("./font/{$fontlist[2]}");

        $ttbox = imagettfbbox($fontsize, 0, $fontpath, $str);

        $w = abs($ttbox[2] - $ttbox[0]) + ($padding * 2) + (mb_strlen($str) * 15);
        $h = $ttbox[1] - $ttbox[7] + ($padding * 2) + 10;

        $base_img = imagecreatetruecolor($w, $h);
        $color = imagecolorallocate($base_img, rand(150, 250), rand(150, 250), rand(150, 250));
        imagefill($base_img, 0, 0, $color);

        //隨機碼
        $x = 15;
        $y = 20;
        for ($i = 0; $i < strlen($str); $i++) {
            $fontsize = rand(20, 24); //文字隨機大小
            $fontcolor = imagecolorallocate($base_img, rand(0, 150), rand(0, 150), rand(0, 150)); //文字隨機顏色
            $ang = rand(-30, 30); //文字隨機角度
            $char = mb_substr($str, $i, 1);
            $fontpath = realpath("./font/{$fontlist[rand(0, 2)]}"); //隨機取字型

            $ttbox = imagettfbbox($fontsize, 0, $fontpath, $char);
            $tw = abs($ttbox[2] - $ttbox[0]);
            $th = $ttbox[1] - $ttbox[7];

            $yz = $y + $th;
            imagettftext($base_img, $fontsize, $ang, $x, $yz, $fontcolor, $fontpath, $char);
            $x = $x + $tw + 10;

            // $x=20+($i*rand(25,30));
            // imagettftext($base_img,$fontsize,$ang,$x,(($h+$fontsize)/2),$fontcolor,$fontpath,$char);
            // imagestring($base_img,5,$x,20,$char,$fontcolor);
        }

        $line = rand(3, 4);
        //產生亂數隨機線條
        for ($i = 1; $i <= $line; $i++) {
            $linecolor = imagecolorallocate($base_img, rand(100, 200), rand(100, 200), rand(100, 200));
            imageline($base_img,rand(0,0+$padding),rand(0,$h),rand($w,$w-$padding),rand(0,$h),$linecolor);
            // $x = rand(0, 0 + $padding);
            // $y = rand(0 + $padding, $th - $padding);
            // $xe = rand($tw, $tw - $padding);
            // $ye = rand(0 + $padding, $th - $padding);
            // imageline($base_img, $x, $y, $xe, $ye, $linecolor);
            // imageline($base_img, $x, $y + 1, $xe, $ye + 1, $linecolor);
        }

        $dst_path = "./captcha/base_img.png";
        imagejpeg($base_img, $dst_path);
        return $dst_path;
    }


    ?>


</body>

</html>