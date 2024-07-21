<?php

namespace App\View\Composers;

use App\Models\Form;
use App\Models\News;
use App\Models\Test;
use App\Models\Users;
use App\Models\Forfuns;
use App\Models\FormType;
use Illuminate\View\View;
use Illuminate\Http\Request;

class SidebarComposer
{
	public function __construct()
	{
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  \Illuminate\View\View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
		$testsMenu = [];
		foreach (Test::all() as $test) {
			array_push($testsMenu, [
				'title' => $test->name,
				'link' => "/$test->slug"
			]);
		}
		$sidebar = [
			[
				'title' => 'Администратор',
				'menu' => [
					[
						'icon' => 'fa-light fa-message-plus',
						'title' => 'Тестирование',
						'submenu' => [
							[
								'title' => 'Создать',
								'link' => route('tests.create')
							],
							[
								'title' => 'Редактировать',
								'link' => route('tests.index')
							]
						]
					],
					[
						'icon' => 'fa-light fa-users',
						'title' => 'Пользователи',
						'link' => '#'
					],
					[
						'icon' => 'fa-light fa-envelope-open-text',
						'title' => 'Обращения',
						'cnt' => 0,
						'link' => '#'
					],
				]
			],
			[
				'title' => 'Тестирование',
				'menu' => [
					[
						'icon' => 'fa-light fa-block-question',
						'title' => 'Тесты',
						'submenu' => $testsMenu
					]
				]
			],
			[
				'title' => 'Профиль',
				'menu' => [
					[
						'icon' => 'fa-light fa-square-poll-vertical',
						'title' => 'Результаты',
						'link' => route('profile', ['type' => 'results'])
					],
					[
						'icon' => 'fa-light fa-medal',
						'title' => 'Награды',
						'link' => route('profile', ['type' => 'rewards'])
					],
					[
						'icon' => 'fa-light fa-pen-swirl',
						'title' => 'Креативное задание',
						'link' => route('profile', ['type' => 'creative'])
					],
				]
			],
			[
				'title' => 'Информация',
				'menu' => [
					[
						'icon' => 'fa-light fa-address-book',
						'title' => 'Контакты',
						'link' => route('contact')
					],
					[
						'icon' => 'fa-light fa-messages-question',
						'title' => 'FAQ',
						'link' => route('profile', ['type' => 'faq'])
					],
					[
						'icon' => 'fa-light fa-envelopes-bulk',
						'title' => 'Обратная связь',
						'link' => '#',
						'modal' => 'feedback-modal'
					],
				]
			],
			[
				'title' => '',
				'menu' => [
					[
						'icon' => 'fa-light fa-person-to-door',
						'title' => 'Выход',
						'link' => route('logout')
					],
				]
			]
		];

		$view->with('sidebarComposer', $sidebar);
	}
}
