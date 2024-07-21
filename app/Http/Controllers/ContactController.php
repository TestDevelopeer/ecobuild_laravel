<?php

namespace App\Http\Controllers;

class ContactController extends Controller
{
	public function index()
	{
		return view('pages.contact.index', [
			'breadcrumb' => [
				'pageName' => 'Контакты',
				'breadcrumb' => [
					['text' => "Остались вопросы?"]
				]
			],
		]);
	}
}
