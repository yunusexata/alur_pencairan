<?php

namespace App\Http\Controllers\AlurPencairan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlurProsesNormalController extends Controller
{
    public function index()
    {
        return view('app.alur-pencairan.alur-proses-normal.index');
    }

    public function create()
    {
        return view('app.alur-pencairan.alur-proses-normal.detail', ["objId" => null]);
    }

    public function edit(Request $request)
    {
        return view('app.alur-pencairan.alur-proses-normal.detail', ["objId" => $request->id]);
    }
}
