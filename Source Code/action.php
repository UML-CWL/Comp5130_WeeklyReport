<?php
require("config.php");
if(isset($_GET['act'])){
    $action = $_GET['act']; 
}else{
    $action = "";
}

if($action=='delimg'){ //del pic 
    $filename = $_POST['imagename']; 
    if(!empty($filename)){ 
        unlink('pics/'.$filename);
        unlink('thumbs/'.$filename); 
        echo '1'; 
    }else{ 
        echo 'Deleted Failed.'; 
    } 
}else{ //upload pic 
    $picname = $_FILES['pic']['name']; 
    $picsize = $_FILES['pic']['size']; 
    if ($picname != "") { 
        if ($picsize > 512000) { //pic size 
            echo 'Photo size cannot over 500k'; 
            exit; 
        } 
        $type = strstr($picname, '.'); //pic format
        if ($type != ".gif" && $type != ".jpg" && $type != ".png") { 
            echo 'Wrong format！'; 
            exit; 
        } 
        $rand = rand(100, 999); 
        $pics = date("YmdHis") . $rand . $type; //name file
        //file path 
        $pic_path = "pics/". $pics; 
        move_uploaded_file($_FILES['pic']['tmp_name'], $pic_path); 
        //Thumbnail
        if($type == ".jpg"){$src_image=ImageCreateFromJPEG($pic_path);}
        else if($type == ".png"){$src_image=ImageCreateFromPNG($pic_path);}
        else if($type == ".gif"){$src_image=ImageCreateFromGIF($pic_path);}
        
        $srcW=ImageSX($src_image); //pic width
        $srcH=ImageSY($src_image); //pic height
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
        $smallfile = "thumbs/".$pics;
     
        $dst_image=ImageCreateTrueColor($dstW,$dstH);
        ImageCopyResized($dst_image,$src_image,0,0,0,0,$dstW,$dstH,$srcW,$srcH);
        if($type == ".jpg"){ImageJpeg($dst_image,$smallfile);}
        else if($type == ".png"){Imagepng($dst_image,$smallfile);}
        else if($type == ".gif"){gif($dst_image,$smallfile);}
        
    } 
    $size = round($picsize/1024,2); //transfer to kb 
    $arr = array( 
        'name'=>$picname, 
        'pic'=>$pics, 
        'size'=>$size 
    ); 
    echo json_encode($arr); //json format output
}
?>