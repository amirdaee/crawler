<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class imageController extends Controller
{
    public function avatarShow($filename)
    {
        $path = storage_path('app/public/avatar/' . $filename);

        if (!File::exists($path)) {
            $path = storage_path('app/public/defaults/avatar/' . $filename);
            if (!File::exists($path)) {
                return 'ok';
            }
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
