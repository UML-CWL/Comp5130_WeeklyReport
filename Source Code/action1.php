<?php
$action = $_GET['act']; 
if($action=='delimg'){ //刪除圖片 
    $filename = $_POST['imagename']; 
    /*
    if(!empty($filename)){ 
        unlink('pics/'.$filename); 
        echo '1'; 
    }else{ 
        echo '刪除失敗.'; 
    } */
    echo $filename;
}else{ //上傳圖片 
    $picname = $_FILES['mypic']['name']; 
    $picsize = $_FILES['mypic']['size']; 
    if ($picname != "") { 
        if ($picsize > 512000) { //限制上傳大小 
            echo '圖片大小不能超過500k'; 
            exit; 
        } 
        $type = strstr($picname, '.'); //限制上傳格式 
        if ($type != ".gif" && $type != ".jpg" && $type != ".png") { 
            echo '圖片格式不對！'; 
            exit; 
        } 
        $rand = rand(100, 999); 
        $pics = date("YmdHis") . $rand . $type; //命名圖片名稱 
        //上傳路徑 
        $pic_path = "pics/". $pics; 
        move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path); 
        //Thumbnail
        if($type == ".jpg"){$src_image=ImageCreateFromJPEG($pic_path);}
        else if($type == ".png"){$src_image=ImageCreateFromPNG($pic_path);}
        else if($type == ".gif"){$src_image=ImageCreateFromGIF($pic_path);}
        
        $srcW=ImageSX($src_image); //获得图片宽
        $srcH=ImageSY($src_image); //获得图片高
        if($srcW <= 200 || $srcH <= 200){
            $dstW=$srcW;
            $dstH=$srcH;
        }else{
            $dstW=$srcW*(1-($srcW/2000));
            $dstH=$srcH*(1-($srcH/2000));
        }
        if($dstH <= 200 || $dstW <= 200){
            $dstH=$srcH;
            $dstW=$srcW;
        }else{
            $dstH=$dstH*(1-($dstH/2000));
            $dstW=$dstW*(1-($dstW/2000));
        }
        //$dstW=$srcW*0.5;//缩略图宽
        //$dstH=$srcH*0.5;//缩略图高
        $smallfile = "thumbs/".$pics;
     
        $dst_image=ImageCreateTrueColor($dstW,$dstH);
        ImageCopyResized($dst_image,$src_image,0,0,0,0,$dstW,$dstH,$srcW,$srcH);
        if($type == ".jpg"){ImageJpeg($dst_image,$smallfile);}
        else if($type == ".png"){Imagepng($dst_image,$smallfile);}
        else if($type == ".gif"){gif($dst_image,$smallfile);}
        
    } 
    $size = round($picsize/1024,2); //轉換成kb 
    $arr = array( 
        'name'=>$picname, 
        'pic'=>$pics, 
        'size'=>$size 
    ); 
    echo json_encode($arr); //輸出json資料 
}
?>