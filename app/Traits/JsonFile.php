<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait JsonFile {

    /**
     * @param string $fileName
     * @return bool
     */
    public function fileExists(string $fileName): bool
    {
        return File::exists($fileName);
    }

    /**
     * @param string $fileName
     * @return array
     */
    public function getJsonAsArray(string $fileName): array
    {
        return json_decode(File::get($fileName), true);
    }
}
