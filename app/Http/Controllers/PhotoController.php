<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class PhotoController extends Controller
{
    public function index(Request $request)
    {
        if (Storage::disk('local')->exists($request->file_path)) {
            $file = Storage::disk('local')->get($request->file_path);
            $type = Storage::disk('local')->getMimetype($request->file_path);
            return response($file, 200)->header('Content-Type', $type);
        }
        //Not found
        abort(404);
    }
}
