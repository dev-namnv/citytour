<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageS3Helper
{
    public static function getUrlAfterUpload($path, $contents)
    {
        $path = Storage::disk('s3')->put($path, $contents, 'public');
        return Storage::disk('s3')->url($path);
    }

    public static function delete($url)
    {
        $path = parse_url($url, PHP_URL_PATH);
        Storage::disk('s3')->delete($path);
    }
}
