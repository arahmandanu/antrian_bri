<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoAdd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'file' => [
                'required',
                'mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime',
                'max:128000'  // Max 128MB
            ],
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = VideoAdd::VIDEOPATH . $fileName;
            $file->move(public_path(VideoAdd::VIDEOPATH), $fileName);

            VideoAdd::create([
                'title' => $file->getClientOriginalName(),
                'url' => $path,
            ]);

            flash()->success('Iklan video berhasil ditambahkan.');
            return redirect()->route('admin.video_adds.index');
        }
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
        }

        return redirect()->route('admin.video_adds.index');
    }
}
