<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;
use ZipArchive;
use DB;
use File;
use Storage;
use Illuminate\Support\Str;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.themes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.themes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }

        $request->validate([
            'name' => 'required|unique:themes',
        ]);

        if (class_exists('ZipArchive')) {
            if ($request->hasFile('theme_zip')) {

                // Create update directory.
                $dir = 'themes';
                if (!is_dir($dir))
                    mkdir($dir, 0777, true);

                $path = Storage::disk('local')->put('themes', $request->theme_zip);

                // $image_path = Storage::disk('local')->put('uploads/all/', $request->image);

                $theme = new Theme();
                $theme->name = $request->name;
                $theme->path = $path;
                // $theme->image = $image_path;
                $theme->save();

                $zip = new ZipArchive;
                $res = $zip->open(base_path('public/' . $theme->path));

                $random_dir = Str::random(10);

                $dir = trim($zip->getNameIndex(0), '/');
                $dir = explode('/', $zip->getNameIndex(0));

                flash(translate('Addon installed successfully'))->success();
                return redirect()->route('themes.index');
            }
        } else {
            flash(translate('Please enable ZipArchive extension.'))->error();
            return redirect()->route('themes.index');
        }
    }

    public function xcopy($src, $dest)
    {
        foreach (scandir($src) as $file) {
            $srcfile = rtrim($src, '/') . '/' . $file;
            $destfile = rtrim($dest, '/') . '/' . $file;
            if (!is_readable($srcfile)) {
                continue;
            }
            if ($file != '.' && $file != '..') {
                if (is_dir($srcfile)) {
                    if (!file_exists($destfile)) {
                        mkdir($destfile);
                    }
                    $this->xcopy($srcfile, $destfile);
                } else {
                    copy($srcfile, $destfile);
                }
            }
        }
    }

    public static function deleteDir($dirPath)
    {
        if (!is_dir($dirPath)) {
            //throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function activation(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return 0;
        }
        foreach (Theme::all() as $item) {
            $item->activated = false;
            $item->save();
        }
        $theme = Theme::find($request->id);
        $theme->activated = $request->status;
        $theme->save();

        // Code for Activate

        if ($request->status == true) {
            //Unzip uploaded update file and remove zip file.
            $zip = new ZipArchive;
            $res = $zip->open(base_path('public/' . $theme->path));
            $random_dir = Str::random(10);

            $dir = trim($zip->getNameIndex(0), '/');
            // $dir = explode('/', $zip->getNameIndex(0));

            if ($res === true) {
                $res = $zip->extractTo(base_path('public/themes'));
                $zip->close();
            } else {
                dd('could not open');
            }

            $str = file_get_contents(base_path('public/themes/'. $dir . '/config.json'));
            // dd($str);
            $json = json_decode($str, true);

            // Create new directories.
            // dd($json['directory'][0]['name']);

            if (!empty($json['directory'])) {

                foreach ($json['directory'][0]['name'] as $directory) {
                    if (is_dir(base_path($directory)) == false) {
                        $this->deleteDir(base_path($directory));
                        mkdir(base_path($directory), 0777, true);
                    } else {
                        $this->deleteDir(base_path($directory));
                        mkdir(base_path($directory), 0777, true);
                    }
                }
            }

            // Create/Replace new files.
            if (!empty($json['files'])) {

                foreach ($json['files'] as $file) {
                    $this->xcopy(base_path('public/themes/' . $dir .'/'. $file['root_directory']), base_path($file['update_directory']));
                }
            }
            return 1;
        } else {
            if (file_exists(base_path('resources/views/frontend'))) {
                $this->deleteDir(base_path('resources/views/frontend'));
                $this->deleteDir(base_path('public/assets/frontend/assets'));
            } else {
                mkdir(base_path('resources/views/frontend'));
                mkdir(base_path('public/assets/frontend/assets'));
            }
            return 0;
        }
    }
}
