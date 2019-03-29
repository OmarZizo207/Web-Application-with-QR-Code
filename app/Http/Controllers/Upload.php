<?php

namespace App\Http\Controllers;

use App\File;
use Storage;
use Illuminate\Http\Request;

class Upload extends Controller
{
    public function delete_f($id)
    {
        $file = File::find($id);
        if(!empty($file)) {
            Storage::delete($file->full_file);
            $file->delete();
        }
    }

    public function upload($data = [])
    {
    	if(in_array('new_name', $data)){
	    	$new_name = $new_name === null ? time() : $data['new_name'];
    	}

    	if(request()->hasFile($data['file']) && $data['upload_type'] == 'single') {

    		Storage::has($data['delete_file']) ? Storage::delete($data['delete_file']) : '';
    		return request()->file($data['file'])->store($data['path']);
    	}
    	else if(request()->hasFile($data['file']) && $data['upload_type'] == 'files') {

            $file = request()->file($data['file']);

            $size       = $file->getSize();
            $type       = $file->getMimeType();
            $fileName   = $file->getClientOriginalName();
            $hashname   = $file->hashName();
            // $ext        = $file->getClientOriginalExtension();
            // $realPath   = $file->getRealPath();

            $file->store($data['path']);
            $add  = File::create([
                'name'          => $fileName,
                'size'          => $size,
                'file'          => $hashname,
                'path'          => $data['path'],
                'full_file'     => $data['path'] . '/' . $hashname ,
                'mime_type'     => $type ,
                'file_type'     => $data['file_type'],
                'relation_id'   => $data['relation_id'], 
            ]);   		
    		return $add->id;
    	}
    }
}
