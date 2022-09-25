<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attachments;
use Illuminate\Support\Facades\Storage;

class AttachmentsController extends Controller
{
    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function show(string $path)
    {
        $asset = Attachments::where('path', $path)->first();

        $disk = config('filesystems.default');

        if ($asset) {
            $disk = $asset->disk;
        }

        $storage = Storage::disk($disk);

        $image = $storage->get($path);

        header('Cache-control: max-age='.(60 * 60 * 24 * 365));
        header('Expires: '.gmdate(DATE_RFC1123, time() + 60 * 60 * 24 * 365));

        return response($image, 200)->header('Content-Type', 'jpeg');
    }
}
