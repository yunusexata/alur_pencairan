<?php

namespace App\Http\Controllers\AlurPencairan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlurProsesSpeed20Controller extends Controller
{
    public function index()
    {
        return view('app.alur-pencairan.alur-proses-speed-20.index');
    }

    public function create()
    {
        return view('app.alur-pencairan.alur-proses-speed-20.detail', ["objId" => null]);
    }

    public function edit(Request $request)
    {
        return view('app.alur-pencairan.alur-proses-speed-20.detail', ["objId" => $request->id]);
    }
}
