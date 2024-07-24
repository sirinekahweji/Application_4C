<?php

namespace App\Http\Controllers;

use App\Models\video;
use App\Http\Requests\StorevideoRequest;
use App\Http\Requests\UpdatevideoRequest;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($publication_id)
    {
        $videos = video::where('publication_id', $publication_id)->get();

        return response()->json($videos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function upload(Request $request)
    {
        $request->validate([
            'video' => 'required|string',
            'publication_id' => 'required|integer',
        ]);

        $videoData = $request->video;
        $publication_id = $request->publication_id;

        // Extract the mime type and the base64 data from the image data
        list($type, $videoData) = explode(';', $videoData);
        list(, $videoData) = explode(',', $videoData);

        // Decode the base64 image data
        $videoData = base64_decode($videoData);

        // Generate a unique image name
        $imageName = md5(uniqid('', true)) . '.mp4';

        // Specify the path to the assets directory
        $path = realpath(base_path('..')) . '/frontlaravel/src/assets/ImagesPosts/' . $imageName;

        // Save the image to the specified path
        if (file_put_contents($path, $videoData)) {

            $path ='assets/ImagesPosts/' . $imageName;
            video::create([
                'publication_id' => $publication_id,
                'video' => $path,
            ]);

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorevideoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatevideoRequest $request, video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(video $video)
    {
        //
    }
}
