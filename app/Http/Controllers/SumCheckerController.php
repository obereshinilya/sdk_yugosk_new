<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SumChecker\SumcheckerConfig;
use App\Models\SumChecker\SumCheckerLog;

function viewTree($folder, $space)
{
    // Получаем полный список файлов и каталогов внутри $folder
    $files = scandir($folder);
    foreach ($files as $file) {

        // Отбрасываем текущий и родительский каталог
        if (($file == '.') || ($file == '..')) continue;
        // Получаем полный путь к файлу
        $path = $folder . '/' . $file;
        // Если это директория
        if (is_dir($path)) {
            if ($file[0] == '.') {
                continue;
            } else {
                $data[] = array(
                    'title' => $file,
                    'key' => $folder . '/' . $file,
                    'lazy' => true,
                    'folder' => true,
                    'selected' => false
                );
            }


        } // Если это файл, то просто выводим название файла
        else {
            $db_file = SumcheckerConfig::where('path', $folder . '/' . $file)->first();
            if ($db_file == null) {
                $choiced = false;
            } else {
                $choiced = true;
            }
            $data[] = array(
                'title' => $file,
                'key' => $folder . '/' . $file,
                'lazy' => false,
                'folder' => false,
                'selected' => $choiced
            );
        }
    }
    return $data;
}


class SumCheckerController extends Controller
{
    public function get_tree(Request $request)
    {
        if ($request->key == '.') {
            $request->key = pathinfo($_SERVER["DOCUMENT_ROOT"], PATHINFO_DIRNAME);
        }
        return viewTree($request->key, '');

    }


    public function test_view()
    {
        return view('web.include.sum_checker_tree.sumchecker_tree');
    }

    public function get_choiced()
    {

        $files = SumcheckerConfig::all();
        $data = null;
        foreach ($files as $file) {
            $data[] = array(
                'title' => basename($file->path) . ' (' . $file->path . ')',
                'key' => $file->path,
                'lazy' => false,
                'folder' => false,
                'selected' => true
            );
        }
        return $data;


    }

    public function set_paths(Request $request)
    {
        try {
            if ($request->paths != 'none' and $request->paths != null) {
                SumcheckerConfig::truncate();
                foreach ($request->paths as $path) {
                    $data[] = [
                        'path' => $path
                    ];
                }
                try {
                    SumcheckerConfig::insertOrIgnore($data);
                } catch (\Exception $e) {
                    return $e;
                }

            } else if ($request->paths == 'none') {
                SumcheckerConfig::truncate();
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }

    public function sumchecker_cmd(Request $request)
    {
        $output = '';
        $code = '';
        if ($request->type == 'update') {
            return 'cd ' . $_SERVER["DOCUMENT_ROOT"] . '/sumchecker/sumchecker_exec; ./sumchecker update 2>&1';
            exec('cd ' . $_SERVER["DOCUMENT_ROOT"] . '/sumchecker/sumchecker_exec; ./sumchecker update 2>&1', $output, $code);
            $data = array('data' => $output,
                'code' => $code);
            return $data;
        } else if ($request->type == 'check') {
            exec('cd ' . $_SERVER["DOCUMENT_ROOT"] . '/sumchecker/sumchecker_exec; ./sumchecker check 2>&1', $output, $code);
            $data = array('data' => $output,
                'code' => $code);
            return $data;
        } else {
            return null;
        }
    }

    public function get_all_logs()
    {
        $logs = SumCheckerLog::orderBy('id', 'DESC')->get();
        $data = null;
        foreach ($logs as $log) {
            $data[] = array(
                'time' => $log->time,
                'event' => $log->event
            );
        }
        return $data;
    }

    public function test()
    {
        $output = '';
        $code = '';
        exec('cd ' . $_SERVER["DOCUMENT_ROOT"] . '/sumchecker/sumchecker_exec; ./sumchecker update 2>&1', $output, $code);
        $data = array('data' => $output,
            'code' => $code);
        return $data;
    }
}

?>
