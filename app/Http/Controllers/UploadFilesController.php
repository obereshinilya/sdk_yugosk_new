<?php

namespace App\Http\Controllers;

use App\Image;
use App\Models\Reports\PdfFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UploadFilesController extends Controller
{
    public function show_files()
    {
        AdminController::log_record('Открыл нормативную документацию');//пишем в журнал
        $pdf_files = PdfFiles::all();
        foreach ($pdf_files as $key => $row) {

            $date[$key] = date('d.m.Y', strtotime($row->date));
        }
        return view('web.docs.document.pdf_files', compact('pdf_files', 'date'));
    }

    public function save_file(Request $request)
    {
        foreach ($request->file() as $file) {
            foreach ($file as $f) {
                if (!file_exists((public_path('storage/docs/' . $f->getClientOriginalName())))) {       // проверка на существование файла
                    $f->move(public_path('storage/docs/'), $f->getClientOriginalName()); //public\storage\docs
                    PdfFiles::create(['name' => $f->getClientOriginalName()]);
                }
            }
            AdminController::log_record('Загрузил нормативную документацию ' . $f->getClientMimeType());//пишем в журнал
        }
        return redirect()->route('show_files');
    }

    public function open_files($id)
    {
        $f = PdfFiles::where('id', '=', $id)->first();
        $image = 'storage/docs/' . $f->name;
        return view('web.docs.document.open_pdf', compact('image'));
    }

    public function delete_file($id)
    {
        $f_base = PdfFiles::where('id', '=', $id)->first();
        $f_path = unlink('storage/docs/' . $f_base->name);
        AdminController::log_record('Удалил нормативную документацию ' . $f_base->name);//пишем в журнал
        $f_base->delete();
        return redirect()->route('show_files');
    }


}
