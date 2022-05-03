<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

trait UploadTrait
{
    /**
         * Uploads a single image in the storage folder
         *
         * @param File $file image being sent from request
         * @param String $file_dir path being saved of the file or image
         * @param String $file_name file name of file or image
         * @return void
         */
    public function uploadImage($file, $file_dir = null, $custom_name = null)
    {
        // creates  file name
        if ($custom_name == null) {
            // get original name
            // append time so that it wont conflict on same name images
            $file_name = time().'-'.$file->getClientOriginalName();
            $final_name = $file->getClientOriginalName();
        } else {
            $file_name = time().'-'.$custom_name;
            $final_name = $custom_name;
        }

        // set the file directory
        $file_dir = $file_dir.$file_name;
        // get file extension
        $file_type = $file->getClientOriginalExtension();
        // get image size
        $file_size = $file->getSize();

        // since the filesystem has been changed, images will be saved
        // directly in public folder instead of storage (public/uploads)
        Storage::disk('uploads')->put($file_dir, File::get($file));

        $images_properties = [$final_name, $file_dir, $file_type, $file_size];

        return $images_properties;
    }

    /**
     * Removes the image from public folder
     *
     * @param String $image_name_in_storage name of file in public folder
     * that will be deleted
     *
     * @return void
     */
    public function deleteImage($image_name_in_storage)
    {
        Storage::disk('uploads')->delete('uploads/'.$image_name_in_storage);
    }

    /**
     * Get the file name that is saved in the public folder
     * In model we created a setter for file_dir, it always return the full path of image
     * instead of the column value in DB
     *
     * @param String $file_image_name Full url image path
     * @return String $matches[0] File name from public folder
     */
    public function getFileImageName($file_image_name)
    {
        preg_match("/[^\/]+$/", $file_image_name->file_dir, $matches);
        return $matches[0];
    }
}
