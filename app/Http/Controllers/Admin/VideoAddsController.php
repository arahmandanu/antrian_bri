<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoAdd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoAddsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master_videos_adds.index', [
            'videoAdds' => VideoAdd::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (VideoAdd::count() >= VideoAdd::MAXVIDEOS) {
            flash()->error('Maksimal jumlah iklan video telah tercapai.');
            return redirect()->route('admin.video_adds.index');
        }

        return view('admin.master_videos_adds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'max:255'
            ],
        ]);
        $entries = scandir(public_path(VideoAdd::VIDEOPATH));
        $files = array_diff($entries, array('.', '..'));

        if (empty($files)) {
            flash()->error('Silahkan upload file dahulu.');
            return redirect()->route('admin.video_adds.create');
        }

        // validate ext
        $regex_pattern = '/\.(mp4|avi|mov)$/i';
        if (!preg_match($regex_pattern, $validated['title'])) {
            flash()->error('File tidak valid.');
            return redirect()->route('admin.video_adds.create');
        }

        $fileExist = false;
        $validName = '';
        foreach ($files as $key => $file) {
            if (Str::contains($file, $validated['title'])) {
                $fileExist = true;
                $validName = $file;
                break;
            }
        }

        if (!$fileExist) {
            flash()->error('File tidak ditemukan.');
            return redirect()->route('admin.video_adds.create');
        }

        if (!file_exists(public_path(VideoAdd::VIDEOPATH . $validName))) {
            flash()->error('Silahkan upload file dahulu.');
            return redirect()->route('admin.video_adds.create');
        }

        VideoAdd::create([
            'title' => $validName,
            'url' => VideoAdd::VIDEOPATH . $validName,
        ]);

        flash()->success('Iklan video berhasil ditambahkan.');
        return redirect()->route('admin.video_adds.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VideoAdd  $VideoAdd
     * @return \Illuminate\Http\Response
     */
    public function show(VideoAdd $VideoAdd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoAdd  $VideoAdd
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoAdd $VideoAdd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoAdd  $VideoAdd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoAdd $VideoAdd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoAdd  $VideoAdd
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoAdd $videoAdd)
    {
        $filePath = public_path($videoAdd->url);
        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                if ($videoAdd) {
                    $videoAdd->delete();
                    flash()->success('Iklan video berhasil dihapus.');
                } else {
                    flash()->error('Iklan video Gagal Dihapus.');
                }
            } else {
                flash()->error('Gagal menghapus file video dari penyimpanan.');
                return redirect()->route('admin.video_adds.index');
            }
        } else {
            $videoAdd->delete();
            flash()->success('Iklan video berhasil dihapus.');
        }

        return redirect()->route('admin.video_adds.index');
    }
}
