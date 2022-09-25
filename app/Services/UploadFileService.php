<?php

namespace App\Services;

use App\Models\Attachments;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadFileService
{
    /**
     * @param $modelId
     * @param $images
     * @param $model
     * @param null $kind
     * @return array
     */
    public function createImages($modelId, $images, $model, $kind = null)
    {
        $result = [];
        foreach ($images as $index => $image) {
            if ($image instanceof UploadedFile) {
                $result[] = $this->upload($image, $modelId, $model, $kind);
            }
        }

        return $result;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param $modelId
     * @param $model
     * @param null $kind
     * @return \Illuminate\Http\JsonResponse|void
     */
    private function upload(UploadedFile $uploadedFile, $modelId, $model, $kind = null)
    {
        $item = [
            'kind'            => $kind,
            'attachable_id'   => $modelId,
            'attachable_type' => $model,
            'name'            => sprintf('%s_%s', now()->timestamp, $uploadedFile->getClientOriginalName()),
            'disk'            => config('filesystems.default'),
            'mime'            => $uploadedFile->getClientMimeType(),
            'size'            => $uploadedFile->getSize(),
        ];

        $file = Attachments::query()->firstOrNew($item);

        $storage = Storage::disk($file->disk);

        if ($file->exists) {
            $file = $file->replicate();
            $timestamp = now()->timestamp;
            $pathInfo = pathinfo($uploadedFile->getClientOriginalName());
            $file->name = sprintf('%s_%s.%s', $timestamp, $pathInfo['filename'], $pathInfo['extension']);
        }

        // Handle file upload
        $path = $storage->putFileAs($this->getPathUpload($item['disk']), $uploadedFile, $file->name);

        if (! $path) {
            return response()->json("Can't upload {$file->getClientOriginalName()} file");
        }

        $file->path = $path;
        $file->save();

        return $file;
    }

    /**
     * @param $store
     * @return string
     */
    private function getPathUpload($store): string
    {
        if ($store === 'local') {
            $path = 'public/'.now()->format('Y/m/d');
        } else {
            $path = 'uploads/'.now()->format('Y/m/d');
        }

        return $path;
    }

    /**
     * @param $modelId
     * @param $images
     * @param $model
     * @param bool $isSave
     * @return array
     */
    public function createImageBase64($modelId, $images, $model, bool $isSave = true)
    {
        $result = [];
        if (is_array($images)) {
            foreach ($images as $index => $image) {
                $result[] = $this->uploadBase64($image, $modelId, $model, $isSave);
            }
        } else {
            return $this->uploadBase64($images, $modelId, $model, $isSave);
        }

        return $result;
    }

    /**
     * @param $image
     * @param $modelId
     * @param $model
     * @param $isSave
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|\Illuminate\Http\JsonResponse|mixed|string
     */
    private function uploadBase64($image, $modelId, $model, $isSave)
    {
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));

        $size  = strlen($data) / 1024; // MB
        $name = 'I' . strtoupper(uniqid());
        $disk = config('filesystems.default');
        $mime = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $path = $this->getPathUpload($disk) . '/' . $name . '.' . $mime;

        if ($isSave) {
            $item = [
                'attachable_id'   => $modelId,
                'attachable_type' => $model,
                'name'            => $name,
                'disk'            => $disk,
                'mime'            => $mime,
                'size'            => $size,
                'path'            => $path
            ];

            $file = Attachments::query()->firstOrNew($item);

            if ($file->exists) {
                $file = $file->replicate();
                $timestamp = now()->timestamp;
                $file->name = sprintf('%s_%s.%s', $timestamp, strtoupper(uniqid()), $file->mime);
            }

            $file->save();
        }

        $storage = Storage::disk($disk);

        // Handle file upload
        file_put_contents("img.{$mime}", base64_encode($data));
        $storage->put($path, $data);

        if (! $storage->put($path, $data)) {
            return response()->json("Can't upload file");
        }

        return $path;
    }
}
