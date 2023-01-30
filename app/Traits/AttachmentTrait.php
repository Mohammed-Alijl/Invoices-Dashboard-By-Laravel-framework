<?php

namespace App\Traits;

trait AttachmentTrait
{
    public function save_attachment($image_request,$path){
        $name = time() . rand(10,1000) . '.' . $image_request->getClientOriginalExtension();
        $image_request->move($path,$name);
        return $name;
    }
    public function delete_image($imageName){
        if(file_exists($imageName))
            unlink($imageName);
    }
    public function is_attachment($image_request){
        $extension = $image_request->getClientOriginalExtension();
        return match ($extension) {
            'jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'pdf', 'PDF' => true,
            default => false,
        };
    }

    public function isImage($file_name){
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        return match ($extension) {
            'jpg', 'JPG', '.jpeg', '.JPEG', '.png', '.PNG', '.gif', '.GIF', '.svg', '.SVG', '.jfif', '.JFIF', '.pjpeg', '.PJPEG', '.pjp', '.PJP', '.webp', '.WEBP', '.avif', '.AVIF' => true,
            default => false,
        };
    }
}
