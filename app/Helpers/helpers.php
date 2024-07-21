<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

// Define a helper class instead of individual functions
class Helper
{
	public static function uploadFiles($path, $files)
	{
		if (!is_array($files)) {
			$files = [$files];
		}

		foreach ($files as $file) {
			$fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
			$filePath = $file->storeAs("$path", $fileName);
		}

		return $filePath;
	}

	public static function deleteFolder($path)
	{
		return Storage::deleteDirectory($path);
	}

	public static function deleteFile($path)
	{
		return Storage::delete($path);
	}
}
