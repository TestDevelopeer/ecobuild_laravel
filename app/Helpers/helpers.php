<?php

namespace App\Helpers;

use ZipArchive;
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

	public static function converToZip($files, $pathSave, $name)
	{
		$zip = new ZipArchive;
		$zipFileName = "storage" . $pathSave . '/' . $name . "___" . Str::uuid() . '.zip';

		if (!Storage::exists($pathSave)) {
			Storage::makeDirectory($pathSave);
		}
		self::deleteFile(Storage::files($pathSave) ?? '');
		//$zipPath = asset($zipFileName);

		if ($zip->open(($zipFileName), ZipArchive::CREATE) === true) {
			foreach ($files as $filePath) {
				$zip->addFile("storage/$filePath", basename($filePath));
			}
			$zip->close();

			if ($zip->open($zipFileName) === true) {
				return $zipFileName;
			} else {
				return false;
			}
		}
	}
}
