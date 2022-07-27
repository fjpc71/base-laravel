<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('name', 100);
            $table->char('surnames', 100);
            $table->char("nie", 50);
            $table->char("phone", 50)->nullable();
            $table->char('email', 100)
                  ->unique();
            $table->char("language", 2)->default("es");
            $table->char('password', 200);
            $table->datetime("validated_at")->nullable();
            $table->boolean("request_validation")->default(false);
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
