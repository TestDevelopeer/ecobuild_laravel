<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('reward_configs', function (Blueprint $table) {
			$table->id();
			$table->integer('test_id');
			$table->string('type');
			$table->integer('x_coord')->default(0);
			$table->integer('y_coord')->default(0);
			$table->integer('x_degree_coord')->default(0);
			$table->integer('y_degree_coord')->default(0);
			$table->integer('font_size')->default(0);
			$table->string('font_color')->default("#000");
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('reward_configs');
	}
};
