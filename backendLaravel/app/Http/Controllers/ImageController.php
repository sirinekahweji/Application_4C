<?php

namespace App\Http\Controllers;

use App\Models\image;
use App\Http\Requests\StoreimageRequest;
use App\Http\Requests\UpdateimageRequest;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($publication_id)
    {
        $images = image::where('publication_id', $publication_id)->get();

        return response()->json($images);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreimageRequest $request)
    {
        //
    }
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|string',
            'publication_id' => 'required|integer',
        ]);

        $imageData = $request->image;
        $publication_id = $request->publication_id;

        // Extract the mime type and the base64 data from the image data
        list($type, $imageData) = explode(';', $imageData);
        list(, $imageData) = explode(',', $imageData);

        // Decode the base64 image data
        $imageData = base64_decode($imageData);

        // Generate a unique image name
        $imageName = md5(uniqid('', true)) . '.png';

        // Specify the path to the assets directory
        $path = realpath(base_path('..')) . '/frontlaravel/src/assets/ImagesPosts/' . $imageName;

        // Save the image to the specified path
        if (file_put_contents($path, $imageData)) {

            $path ='assets/ImagesPosts/' . $imageName;
            Image::create([
                'publication_id' => $publication_id,
                'image' => $path,
            ]);

        } /*else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload file.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid file.',
        ]);*/
    }





    /**
     * Display the specified resource.
     */
    public function show(image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateimageRequest $request, image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(image $image)
    {
        //
    }
}
