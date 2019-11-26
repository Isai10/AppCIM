<?php

namespace App\Http\Controllers;
use App\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ArchivosController extends Controller
{
    
    public function subirArchivo(Request $request,$idAct)
    {
        if($request->user()->authorizeRoles([ 'profesor','alumno']))
        {
            $ext = $request->archivo->extension();
            switch($ext)
            {
                case 'jpeg':
                    $file_name = uniqid("image_") . "." . $ext;
                    break;
                case 'png':
                    $file_name = uniqid("image_") . "." . $ext;
                    break;
                case 'pdf':
                    $file_name = uniqid("pdf_") . "." . $ext;
                    break;
                case 'docx':
                    $file_name = uniqid("doc_") . "." . $ext;
                    break;
                case 'xlsm':
                    $file_name = uniqid("excel_") . "." . $ext;
                    break;
            }
           // dd($request->archivo->getClientOriginalName());
            $request->archivo->storeAs('uploads', $file_name);
            $file = new Archivo();
            $file->nombre = $file_name;
            $file->user_id = $request->user()->id;
            $file->actividade_id=$idAct;
            $file->save();

            return back();
        }
    }
    public function verArchivo(Request $request,$file)
    {
        return Storage::response("uploads/$file");
    }
}
