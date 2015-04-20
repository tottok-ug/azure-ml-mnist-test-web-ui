<?php
if ($_FILES ['file']) {
	$file = $_FILES ['file'];
	$size = getimagesize ( $file ['tmp_name'] );
	$message = "";
	$w = $size [0];
	$h = $size [1];
	$name = $file ['name'];
	$format = 'jpg';
	$img = null;
	switch (true) {
		case preg_match ( '/png$/i', $name ) :
			$img = imagecreatefrompng ( $file ['tmp_name'] );
			$format = 'png';
			break;
		case preg_match ( '/jpg$/i', $name ) :
		case preg_match ( '/jpeg$/i', $name ) :
			$img = imagecreatefromjpeg ( $file ['tmp_name'] );
			$format = 'jpg';
			break;
		case preg_match ( '/gif$/i', $name ) :
			$img = imagecreatefromgif ( $file ['tmp_name'] );
			$format = 'gif';
			break;
	}
	
	if (is_null ( $img )) {
		$status = "error";
		$message = "ファイルフォーマットは,jpg,gif,pngのいづれかのみ有効です。";
	} else {
        $newx = 28;
        $newy = 28;
		$resized = imagecreatetruecolor($newx,$newy);
        imagecopyresampled($resized,$img,0,0,0,0,$newx,$newy,$w,$h);
        ob_start();
        imagejpeg($resized, null, 90);
        $base64 = base64_encode(ob_get_contents());
        ob_end_clean();
        $pixel = array();
        for($i = 0;$i < 28;$i++){
          for($j = 0;$j < 28;$j++){
            $c = imagecolorat($resized,$i,$j);
            $rgb = imagecolorsforindex($resized,$c);
            $grey = (int)($rgb['red'] * 0.3 + $rgb['green'] * 0.59 + $rgb['blue'] * 0.11);
            $pixel[$j][$i] = 255 - $grey;
          }
        }
       
	}
	$data = array (
			'format' => $format,
			'status' => $status,
			'message' => $message,
			'width' => $w,
			'height' => $h,
			'base64' => $base64,
			'pixel' => $pixel
	);
	header ( 'Content-type: application/json' );
	echo json_encode ( $data );
}
