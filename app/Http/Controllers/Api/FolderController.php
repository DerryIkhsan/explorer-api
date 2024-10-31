<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\ApiResources;
use App\Models\Folder;

use Illuminate\Support\Facades\Validator;

class FolderController extends Controller
{
    //
    public function index(){
        $folder = Folder::get();

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
    
    public function destroy($id){
        
        $folder = Folder::find($id);

        if($folder){
            $folder->delete();

            return new ApiResources(true, 'success delete folder', []);
        }
        else{
            return new ApiResources(false, 'failed delete folder', []);
        }
    }
}
