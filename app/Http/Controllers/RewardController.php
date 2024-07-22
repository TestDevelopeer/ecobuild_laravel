<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Result;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class RewardController extends Controller
{
	public function reward(Request $request)
	{
		$result = Result::findOrFail($request->id);
		$html = view('pages.profile.layouts.reward-cards', ['result' => $result])->render();

		return response(['html' => $html]);
	}

	public function certificate(Request $request, Test $test)
	{
		$config = $test->configByType('certificate')->first();
		$manager = new ImageManager(new Driver());

		$user = $request->user();
		$path = config('custom.tests.path') . $test->id;

		Storage::deleteDirectory("$path/users/$user->id");
		if (!Storage::exists("$path/users/$user->id")) {
			Storage::makeDirectory("$path/users/$user->id");
		}

		$image_path = Storage::files("$path/certificate")[0] ?? '';
		if ($image_path == '') {
			if (!$request->is_link) {
				return redirect(route('profile'))->with(['status' => 'error', 'message' => 'Не загружен шаблон сертификата']);
			}
			return response(['status' => 'error', 'message' => 'Не загружен шаблон сертификата'], 400);
		}
		$image = $manager->read("storage/$image_path");

		$image->text($user->surname . ' ' . $user->name, $config->x_coord, $config->y_coord, function ($font) use ($config) {
			$font->filename(config('custom.fontBebas'));
			$font->size($config->font_size);
			$font->color($config->font_color);
			$font->align('center');
			$font->valign('middle');
		});

		$name = Str::uuid() . "_certificate.jpg";
		$image->toJpeg()->save("storage$path/users/$user->id/$name");

		if ($request->is_link) {
			return response(['url' => Storage::url("$path/users/$user->id/$name")]);
		}

		$pdf = Pdf::loadView('components.image', ['path' => asset("storage$path/users/$user->id/$name")])->setPaper('a4', 'landscape');
		return $pdf->download("Сертификат участника {$test->name}.pdf");
		//return Storage::download("$path/users/$user->id/$name", "Сертификат участника {$test->name}.jpg");
	}

	public function diplom(Request $request, Test $test)
	{
		$config = $test->configByType('diplom')->first();
		$manager = new ImageManager(new Driver());

		$user = $request->user();
		$path = config('custom.tests.path') . $test->id;

		Storage::deleteDirectory("$path/users/$user->id");
		if (!Storage::exists("$path/users/$user->id")) {
			Storage::makeDirectory("$path/users/$user->id");
		}

		$image_path = Storage::files("$path/diplom")[0] ?? '';
		if ($image_path == '') {
			if (!$request->is_link) {
				return redirect(route('profile'))->with(['status' => 'error', 'message' => 'Не загружен шаблон диплома']);
			}
			return response(['status' => 'error', 'message' => 'Не загружен шаблон диплома'], 400);
		}
		$image = $manager->read("storage/$image_path");

		if ($request->is_link) {
			$degree = 'III';
		} else {
			$result = $test->resultByUser();
			if ($result->points >= config('custom.diplom.third') && $result->points < config('custom.diplom.second')) {
				$degree = 'III';
			} else if ($result->points >= config('custom.diplom.second') && $result->points < config('custom.diplom.first')) {
				$degree = 'II';
			} else if ($result->points >= config('custom.diplom.first')) {
				$degree = 'I';
			}
		}

		$image->text($degree . ' степени', $config->x_degree_coord, $config->y_degree_coord, function ($font) use ($config) {
			$font->filename(config('custom.fontArialBold'));
			$font->size($config->degree_font_size);
			$font->color($config->degree_font_color);
			$font->align('center');
			$font->valign('middle');
		});

		$image->text($user->surname . ' ' . $user->name, $config->x_coord, $config->y_coord, function ($font) use ($config) {
			$font->filename(config('custom.fontArialBold'));
			$font->size($config->font_size);
			$font->color($config->font_color);
			$font->align('center');
			$font->valign('middle');
		});

		$name = Str::uuid() . "_diplom.jpg";
		$image->toJpeg()->save("storage$path/users/$user->id/$name");

		if ($request->is_link) {
			return response(['url' => Storage::url("$path/users/$user->id/$name")]);
		}

		$pdf = Pdf::loadView('components.image', ['path' => asset("storage$path/users/$user->id/$name")])->setPaper('a4', 'landscape');
		return $pdf->download("Диплом участника {$test->name}.pdf");
		//return Storage::download("$path/users/$user->id/$name", "Диплом участника {$test->name}.jpg");
	}

	public function getCenterCoords(Request $request, Test $test)
	{
		$manager = new ImageManager(new Driver());
		$path = config('custom.tests.path') . $test->id;
		$image_path = Storage::files("$path/$request->type")[0] ?? '';
		$image = $manager->read("storage/$image_path");
		$coord = [
			'x' => $image->width() / 2,
			'y' => $image->height() / 2,
			'x_degree' => $image->width() / 2,
			'y_degree' => $image->height() / 2
		];

		return response($coord);
	}
}
