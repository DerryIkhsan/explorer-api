<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\ApiResources;
use App\Models\File;

use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    //
    public function index(Request $request){
        $validator = Validator::make($request->all(), [
            'folder_id'   => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $file = File::where('folder_id', $request->folder_id)->get();

        if($file){
            return new ApiResources(true, 'success get file', $file);
        }
        else{
            return new ApiResources(false, 'failed get file', []);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'file'   => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        //upload file
        $file = $request->file('file');
        $file->storeAs('public/posts/', $file->hashName());

        //create file
        $file = File::create([
            'folder_id' => $request->folder_id,
            'file' => $file->getClientOriginalName(),
            'file_hash' => $file->hashName(),
            'type' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
        ]);

        if($file){
            return new ApiResources(true, 'success create file', $file);
        }
        else{
            return new ApiResources(false, 'failed create file', []);
        }
    }

    public function destroy($id){
        $file = File::find($id);

        if($file){
            $file->delete();
            return new ApiResources(true, 'success delete file', []);
        }
        else{
            return new ApiResources(false, 'failed delete file', []);
        }
    }
}
