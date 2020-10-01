<?php

namespace App\Http\Controllers;
use App\Models\File;
use DB;
use App\Http\requests\fileUploadrequest;
use Illuminate\Http\request;

class FileUploadController extends Controller
{
    public function createForm()
    {
    	return view('file-upload');
    }

    public function fileUpload(fileUploadrequest $request)
    {
    	$fileModel = new File;
    	if($request->file()) {
    		$fileName = time().'_'.$request->file->getClientOriginalName();
    		$filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
    		$fileModel->name = time().'_'.$request->file->getClientOriginalName();
    		$fileModel->file_path = '/storage/' . $filePath;
    		$fileModel->save();

    		return back()->with('upload', 'File has been uploaded!')->with('file', $fileName);
    	}
    }
}
