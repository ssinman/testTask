<?php
namespace testApplication;

class Image
{
    protected $imageText;

    public function __construct($imageText)
    {
        $this->imageText = $imageText;
    }

    /*
     * Generate image with text
     * */
    public function generateImage($imageWidth = 250, $imageHeight = 50)
    {
        $im = imagecreatetruecolor($imageWidth,  $imageHeight);
        $backgroundColor = imagecolorallocate($im, 255, 255,255 );
        $textColor = imagecolorallocate($im, 110, 110,115 );
        imagefill($im, 0, 0, $backgroundColor);
        imagestring($im, 4, 32,18, $this->imageText, $textColor);

        imagejpeg($im);
        imagedestroy($im);
    }
}