<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Creative;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CreativeUpload;
use Illuminate\Support\Facades\Storage;

class CreativeController extends Controller
{
	public function creative(Request $request)
	{
		$creative = Creative::where('test_id', '=', $request->id)->first();
		$creativeUpload = CreativeUpload::where('user_id', '=', $request->userId ?? $request->user()->id)->where('creative_id', '=', $creative->id)->first();

		$html = view('pages.profile.layouts.creative-info', [
			'creative' => $creative,
			'creativeUpload' => $creativeUpload,
			'userId' => $request->userId ?? null
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
				path: config('custom.tests.path') . $creative->test_id . "/users/" . $request->user()->id . '/creative',
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

	public function downloadArchive(Request $request)
	{
		$user = User::find($request->userId);
		$creative = Creative::find($request->creativeId);
		$test = Test::find($creative->test_id);
		$creativeUpload = CreativeUpload::where('user_id', '=', $user->id)->where('creative_id', '=', $creative->id)->first();
		if ($creativeUpload) {
			$path = config('custom.tests.path') . $test->id . "/users/{$user->id}/creative";
			$assets = Storage::files($path);
			$zipLink = Helper::converToZip($assets, "$path/archive", "Креативное задание {$test->name}__{$user->surname} {$user->name}");

			$headers = [
				'Content-Type' => 'application/zip',
			];

			return response()->download($zipLink, null, $headers);
		}

		return response(['status' => 'error', 'message' => 'Файлы не найдены']);
	}
}
