<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoAddsCollection;
use App\Http\Resources\VideoAddsResource;
use App\Models\VideoAdd;
use Illuminate\Http\Request;

class VideoAddsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new VideoAddsCollection(VideoAdd::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VideoAdd  $videoAdd
     * @return \Illuminate\Http\Response
     */
    public function show(VideoAdd $videoAdd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoAdd  $videoAdd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoAdd $videoAdd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoAdd  $videoAdd
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoAdd $videoAdd)
    {
        //
    }
}
