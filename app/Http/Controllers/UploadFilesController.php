<?php

namespace App\Http\Controllers;

use App\Image;
use App\Models\Reports\ExcelFiles;
use App\Models\Reports\PdfFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UploadFilesController extends Controller
{
    public function show_excel()
    {
        AdminController::log_record('Открыл журнал СтатусГТЮ');//пишем в журнал
        $pdf_files = ExcelFiles::all();
        $date = false;
        $message = '';
        foreach ($pdf_files as $key => $row) {
            $date[$key] = date('d.m.Y H:i', strtotime($row->date));
        }
        return view('web.docs.document.excel_files', compact('pdf_files', 'date', 'message'));
    }
    public function save_excel(Request $request)
    {
        foreach ($request->file() as $file) {
            foreach ($file as $f) {
                if (!file_exists((public_path('storage/docs/excel/' . $f->getClientOriginalName())))) {       // проверка на существование файла
                    $f->move(public_path('storage/docs/excel/'), $f->getClientOriginalName()); //public\storage\docs
                    ExcelFiles::create(['name' => $f->getClientOriginalName()]);
                    AdminController::log_record('Загрузил данные с системы "СтатусГТЮ" ' . $f->getClientMimeType());//пишем в журнал
                }else{
                    $message = 'Файл с таким именем уже существует!';
                    $pdf_files = ExcelFiles::all();
                    $date = false;
                    foreach ($pdf_files as $key => $row) {
                        $date[$key] = date('d.m.Y H:i', strtotime($row->date));
                    }
                    return view('web.docs.document.excel_files', compact('pdf_files', 'date', 'message'));
                }
            }
        }
        return redirect()->route('show_excel');
    }
    public function excel_delete($id)
    {
        $f_base = ExcelFiles::where('id', '=', $id)->first();
        $f_path = unlink('storage/docs/excel/' . $f_base->name);
        AdminController::log_record('Удалил файл от системы "СтатусГТЮ" ' . $f_base->name);//пишем в журнал
        $f_base->delete();
        return redirect()->route('show_excel');
    }
    public function excel_download($id)
    {
        $path = 'storage/docs/excel/' . ExcelFiles::where('id', '=', $id)->first()->name;
        return response()->download($path, basename($path));
    }
    public function excel_example()
    {
        $path = 'storage/docs/Форма Статус ГТЮ.xlsx';
        return response()->download($path, basename($path));
    }


    public function show_files()
    {
        AdminController::log_record('Открыл нормативную документацию');//пишем в журнал
        $message = '';
        $pdf_files = PdfFiles::all();
        $date = false;
        foreach ($pdf_files as $key => $row) {
            $date[$key] = date('d.m.Y H:i', strtotime($row->date));
        }
        return view('web.docs.document.pdf_files', compact('pdf_files', 'date', 'message'));
    }

    public function save_file(Request $request)
    {
        foreach ($request->file() as $file) {
            foreach ($file as $f) {
                if (!file_exists((public_path('storage/docs/pdf/' . $f->getClientOriginalName())))) {       // проверка на существование файла
                    $f->move(public_path('storage/docs/pdf/'), $f->getClientOriginalName()); //public\storage\docs
                    PdfFiles::create(['name' => $f->getClientOriginalName()]);
                    AdminController::log_record('Загрузил нормативную документацию ' . $f->getClientMimeType());//пишем в журнал
                }else{
                    $message = 'Файл с таким именем уже существует!';
                    $pdf_files = PdfFiles::all();
                    $date = false;
                    foreach ($pdf_files as $key => $row) {
                        $date[$key] = date('d.m.Y H:i', strtotime($row->date));
                    }
                    return view('web.docs.document.pdf_files', compact('pdf_files', 'date', 'message'));
                }
            }
        }
        return redirect()->route('show_files');
    }

    public function open_files($id)
    {
        $f = PdfFiles::where('id', '=', $id)->first();
        $image = 'storage/docs/pdf/' . $f->name;
        return view('web.docs.document.open_pdf', compact('image'));
    }

    public function delete_file($id)
    {
        $f_base = PdfFiles::where('id', '=', $id)->first();
        $f_path = unlink('storage/docs/pdf/' . $f_base->name);
        AdminController::log_record('Удалил нормативную документацию ' . $f_base->name);//пишем в журнал
        $f_base->delete();
        return redirect()->route('show_files');
    }
}
