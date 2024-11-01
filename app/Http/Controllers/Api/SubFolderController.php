<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\ApiResources;
use App\Models\Folder;

use Illuminate\Support\Facades\Validator;

class SubFolderController extends Controller
{
    //

    public function index(Request $request){
        $validator = Validator::make($request->all(), [
            'parent_id'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $folder = Folder::where('parent_id', $request->parent_id)->get();

        if($folder){
            return new ApiResources(true, 'success get folder', $folder);
        }
        else{
            return new ApiResources(false, 'failed get folder', []);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'folder'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $folder = Folder::create([
            'folder' => $request->folder,
            'parent_id' => $request->parent_id ?? 0,
        ]);

        if($folder){
            return new ApiResources(true, 'success create folder', $folder);
        }
        else{
            return new ApiResources(false, 'failed create folder', []);
        }

    }
}
