<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController
{
    public function authentication(Request $request)
    {
        $file = $request->file();
        return response()->file($file);
    }
}
