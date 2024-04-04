<?php

namespace Bundle\Admin\Service;

class ImageService
{
    public function __construct(
        private string $uploadDir,
    ) {}

    public function create($image, string $imgName)
    {
        $mimeType = $image->getMimeType();
        $image->move($this->uploadDir, $imgName);

        $GDimage    = $this->GDimageCreate($mimeType, "{$this->uploadDir}/" . $imgName);
        $imgResized = imagescale($GDimage, 50);
        $thumbDir   = "{$this->uploadDir}/" . 'thumb/';

        if (!is_dir($thumbDir)) {
            mkdir($thumbDir, 0755, true);
        }

        imagejpeg($imgResized, $thumbDir . $imgName);
    }

    public function delete(string $imgName)
    {
        $this->removeImg("{$this->uploadDir}/". $imgName);
        $this->removeImg("{$this->uploadDir}/" . 'thumb/' . $imgName);
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
