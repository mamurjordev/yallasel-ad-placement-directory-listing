<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public $basePath;

    public function __construct()
    {
        $this->basePath = base_path('public') . '/media';
        // $this->path = base_path('public').'/../../media/';
    }

    public function updateFile($file,  $prevFileName, $path)
    {
        $prevFilePath = base_path('public') . '/media' . $path . $prevFileName;
        if ($prevFileName != null) {
            if (file_exists($prevFilePath)) {
                $this->deleteFile($path, $prevFileName);
            }
        }
        return $this->uploadFile($file, $path);
    }

    public function uploadFile($file, $path)
    {
        $fileExt = $file->getClientOriginalExtension();
        $name = time() . rand(1, 100) . '.' . $fileExt;
        $file->move($this->basePath . $path, $name);
        return $name;
    }

    public function deleteFile($path, $file)
    {
        unlink($this->basePath . $path . $file);
    }
}
