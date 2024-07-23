<?php

namespace App\Http\Controllers;

use App\Models\Creative;
use App\Models\CreativeUpload;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreativeController extends Controller
{
	public function creative(Request $request)
	{
		$creative = Creative::where('test_id', '=', $request->id)->first();
		$creativeUpload = CreativeUpload::where('user_id', '=', $request->user()->id)->where('creative_id', '=', $creative->id)->first();
		$html = view('pages.profile.layouts.creative-info', [
			'creative' => $creative,
			'creativeUpload' => $creativeUpload
		])->render();

		return response(['html' => $html]);
	}

	public function process(Request $request)
	{
		// We don't know the name of the file input, so we need to grab
		// all the files from the request and grab the first file.
		/** @var UploadedFile[] $files */
		$files = $request->allFiles();

		if (empty($files)) {
			abort(422, 'No files were uploaded.');
		}

		if (count($files) > 1) {
			abort(422, 'Only 1 file can be uploaded at a time.');
		}

		// Now that we know there's only one key, we can grab it to get
		// the file from the request.
		$requestKey = array_key_first($files);

		// If we are allowing multiple files to be uploaded, the field in the
		// request will be an array with a single file rather than just a
		// single file (e.g. - `csv[]` rather than `csv`). So we need to
		// grab the first file from the array. Otherwise, we can assume
		// the uploaded file is for a single file input and we can
		// grab it directly from the request.
		$file = is_array($request->input($requestKey))
			? $request->file($requestKey)[0]
			: $request->file($requestKey);

		// Store the file in a temporary location and return the location
		// for FilePond to use.
		return $file->store(
			path: 'tmp/' . now()->timestamp . '-' . Str::random(20)
		);
	}

	public function upload(Request $request, Creative $creative)
	{
		$request->validate([
			'creative_assets.0' => 'required|string',
		]);

		foreach ($request->creative_assets as $value) {
			Storage::putFile(
				path: config('custom.tests.path') . $creative->test_id . "/creative/users/" . $request->user()->id,
				file: new File(Storage::path($value))
			);
		}

		CreativeUpload::create([
			'creative_id' => $creative->id,
			'user_id' => $request->user()->id
		]);

		$html = view('components.alert', [
			'border' => true,
			'color' => 'success',
			'icon' => 'fa-sharp fa-regular fa-circle-info fa-2x',
			'title' => 'Ваши файлы загружены!',
			'text' => 'Ваше креативное задание отправлено на проверку, ответ появится в вашем профиле',
		])->render();

		return response(['html' => $html]);
	}
}
