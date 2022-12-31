<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


trait UploadFile
{
    public function uploadImage(UploadedFile $file, $folder, $width = 200, $height = 200, $get_full_path = false)
    {
        $path = $this->checkFolderIsExists($folder);
        $name = $file->hashName();

        $content = stripos($file->getMimeType(), 'image') !== false && $width && $height
                    ? Image::make($file)->resize($width, $height)->stream()
                    : $file->get();

        Storage::disk('public')->put($path.$name, $content, 'public');
        return $get_full_path ? 'storage/'.$this->getPath($folder, $name) : $name;
    }

    /**
     *  EXAMPLE url:
     *   https://images.pexels.com/photos/45170/kittens-cat-cat-puppy-rush-45170.jpeg?auto=compress&cs=tinysrgb&h=130
     *
     *  EXAMPLE info:
     *   [
     *      "dirname" => "https://images.pexels.com/photos/45170"
     *      "basename" => "kittens-cat-cat-puppy-rush-45170.jpeg?auto=compress&cs=tinysrgb&h=130"
     *      "extension" => "jpeg?auto=compress&cs=tinysrgb&h=130"
     *      "filename" => "kittens-cat-cat-puppy-rush-45170"
     *   ]
     */
    public function uploadApiImage(string $url, $folder)
    {
        $info = pathinfo($url);
        $extension = substr($info["extension"], 0, strpos($info["extension"], "?"));
        $name = time().rand(1,10000000).".$extension";
        $contents = file_get_contents($url);
        $path = $this->checkFolderIsExists($folder);
        Storage::disk('public')->put($path.$name, $contents, 'public');
        return $name;
    }

    public function GetApiImage($search_key = 'animals', $per_page = 100)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.pexels.com/v1/search?query=$search_key&$per_page");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'Authorization: 563492ad6f9170000100000196eb427cc0f14778a7a1b078c316d6b5';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $result = json_decode($result, true);

        return $result['photos'];
    }

    public function remove($file)
    {
        if (!$file) return true;
        $path = public_path($file);
        if (File::exists($path))
            unlink($path);
    }

    public function videoImagePreview($video, $folder)
    {
        $path = Storage::disk('public')->getConfig()['root'] .'/'. $this->checkFolderIsExists($folder);
        $image  = time().'.png';
        $command = 'ffmpeg -ss 00:00:02 -i ' . $video . ' -vframes 1 -q:v 2 ' . $path.$image . '';
        $command = str_replace('\\', '/', $command);
        exec($command);
        return $image;
    }

    /**
     * creatOurFolderPath , it's function just to create custom global folder like our need
     *
     * @param  string $folder
     * @return string
    */
    protected function checkFolderIsExists($folder)
    {
        $path =  storage_path($this->getPath($folder));

        if (!File::exists($path))
            File::makeDirectory($path, 0777, true);

        return $this->getPath($folder);
    }

    protected function getPath($folder, $file_name = '')
    {
        return "uploads/$folder/$file_name";
    }
}
