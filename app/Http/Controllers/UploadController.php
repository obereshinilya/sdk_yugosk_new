<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function getForm()
    {
        return view('web.docs.upload.index', ['rows'=> Image::all(), 'jas'=>OpoController::view_jas_15()]);
    }

    public function upload(Request $request)
    {
        $file1 = $request->file('file');
           foreach ($request->file() as $file) {
                //   Storage::put('public/docs/image.jpg', $file); // php-ресурс файла
                foreach ($file as $f) {
                    if ($f->getClientMimeType() === 'application/pdf') {
                        if (!(Storage::exists('public/docs/'.$f->getClientOriginalName()))) {       // проверка на существование файла
                            $f->move(storage_path('app/public/docs/'), $f->getClientOriginalName());
                            Image::create(['title' => $f->getClientOriginalName(), 'img' => \Storage::URL('docs/' . $f->getClientOriginalName())]);
                        }
                     }
                 }
               AdminController::log_record('Загрузил нормативную документацию');//пишем в журнал
               return redirect()->route('upload_form');
            }


    }
    public function open($id)
    {
        if (Storage::exists('public/docs/'.Image::find($id)->title)) {
            $f = Storage::disk('public');
            $files = $f->allFiles();
            AdminController::log_record('Открыл для просмотра нормативную документацию');//пишем в журнал

             return view('web.docs.upload.show-pdf', ['image'=> $image = \Storage::URL('docs/'.Image::find($id)->title), 'jas'=>OpoController::view_jas_15()]);

        }
    }
    public function delete($id)
    {
        if (Storage::exists('public/docs/'.Image::find($id)->title))
        {
            $f = Storage::disk('public');
            AdminController::log_record('Удалил нормативную документацию');//пишем в журнал
            $f->delete('docs/' . Image::find($id)->title);
            Image::destroy($id);
        }
        if (Image::find($id))
        {
            if (Storage::exists('public/docs/'.Image::find($id)->title))
            {
                $f = Storage::disk('public');
                $f->delete('docs/' . Image::find($id)->title);
                AdminController::log_record('Удалил нормативную документацию');//пишем в журнал
                Image::destroy($id);
            }
            else
            {
                Image::destroy($id);
            }
        }
//        return view('upload-form', ['rows'=> Image::all()]);
        return redirect()->route('upload_form');
    }
}
