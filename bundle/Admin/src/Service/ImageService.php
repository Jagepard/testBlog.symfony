<?php

namespace Bundle\Admin\Service;

class ImageService
{
    // private array $setting;

    // public function __construct(array $setting)
    // {
    //     $this->setting = $setting;
    // }

    public function create($image, string $imgName)
    {
        $mimeType = $image->getMimeType();
        $image->move('/home/d/Public/TestBlog/symfony/public/images', $imgName);

        $GDimage    = $this->GDimageCreate($mimeType, '/home/d/Public/TestBlog/symfony/public/images/' . $imgName);
        $imgResized = imagescale($GDimage, 50);
        $thumbDir   = '/home/d/Public/TestBlog/symfony/public/images/' . 'thumb/';

        if (!is_dir($thumbDir)) {
            mkdir($thumbDir, 0755, true);
        }

        imagejpeg($imgResized, $thumbDir . $imgName);
    }

    public function delete(string $imgName)
    {
        $this->removeImg($this->setting['upload_dir'] . $imgName);
        $this->removeImg($this->setting['upload_dir'] . 'thumb/' . $imgName);
    }

    private function GDimageCreate($type, $file)
    {
        switch ($type) {
            case 'image/jpg':
            case 'image/jpeg':
                return imagecreatefromjpeg($file);
                break;
            case 'image/png':
                return imagecreatefrompng($file);
                break;
            case 'image/gif':
                return imagecreatefromgif($file);
                break;
            default:
                return false;
        }
    }

    private static function removeImg(string $imgLink): void
    {
        if (file_exists($imgLink)) {
            unlink($imgLink);
        }
    }
}
