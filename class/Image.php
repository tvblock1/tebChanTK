<?php
class Image {
    public static function Upload(array $file) : string {
        $name = $file['name'];
        $name = sha1($name.microtime()).".webp";
        $tempPath = $file['tmp_name'];
        $imageString = file_get_contents($tempPath);
        $image = imagecreatefromstring($imageString);
        $path = "uploads/".$name; 
        imagewebp($image, $path);
        return $path;
    }
}

?>