<?php

namespace App\View\Composers;

use App\Models\Forfuns;
use App\Models\Form;
use App\Models\News;
use App\Models\Users;
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
		/*[
						'icon' => '',
						'title' => '',
						'submenu' => [
							[
								'title' => '',
								'link' => ''
							]
						]
					]*/
		$sidebar = [
			[
				'title' => 'Тестирование',
				'menu' => [
					[
						'icon' => 'fa-light fa-leaf',
						'title' => 'Экология',
						'link' => '#'
					],
					[
						'icon' => 'fa-light fa-building',
						'title' => 'Строительство',
						'link' => '#'
					],
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
						'type' => 'feedback-modal'
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

		$view->with('sidebar', $sidebar);
	}
}
