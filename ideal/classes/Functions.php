<?php

class Functions {

	public static function Encode($string) {
		return htmlspecialchars($string);
	}

	public static function Date() {
		return date("d.m.Y");
	}

	public static function blowfishSalt($prefix = 'prefix') {
    	$salt = md5(uniqid($prefix, true));
    	return '$2a$08$' . substr(strtr(base64_encode($salt), '+', '.'), 0, 22);
	}

	public static function crop($x1, $y1, $x2, $y2, $file, $file_type) {
		// Создание изображений
		$width = $x2 - $x1;
		$height = $y2 - $y1;

		switch($file_type) { // узнаем тип картинки 
			case "image/gif": $src = imagecreatefromgif($file); break; 
			case "image/jpeg": $src = imagecreatefromjpeg($file); break; 
			case "image/png": $src = imagecreatefrompng($file); break; 
			case "image/pjpeg": $src = imagecreatefromjpeg($file); break; 
		}

		$dest = imagecreatetruecolor($width, $height);

		// Копирование
		imagecopy($dest, $src, 0, 0, $x1, $y1, $width, $height);

		// Вывод и освобождение памяти
		imagejpeg($dest, $file);

		imagedestroy($dest);
		imagedestroy($src);
	}

	public static function resize($file_name, $file_type) {
		switch($file_type) { // узнаем тип картинки 
			case "image/gif": $im = imagecreatefromgif($file_name); break; 
			case "image/jpeg": $im = imagecreatefromjpeg($file_name); break; 
			case "image/png": $im = imagecreatefrompng($file_name); break; 
			case "image/pjpeg": $im = imagecreatefromjpeg($file_name); break; 
		}	 

		list($w,$h) = getimagesize($file_name); // берем высоту и ширину 
		$koe=$w/600; // вычисляем коэффициент 600 это ширина которая должна быть 
		$new_h=ceil($h/$koe); // с помощью коэффициента вычисляем высоту 
		$im1 = imagecreatetruecolor(600, $new_h); // создаем картинку 
		imagecopyresampled($im1,$im,0,0,0,0,600,$new_h,imagesx($im),imagesy($im)); 
		imageconvolution($im1, array( // улучшаем четкость 
		array(-1,-1,-1), 
		array(-1,16,-1), 
		array(-1,-1,-1) ), 
		8, 0); 
		imagejpeg($im1, $file_name, 100); // переводим в jpg 
		imagedestroy($im); 
		imagedestroy($im1); 
	}
}