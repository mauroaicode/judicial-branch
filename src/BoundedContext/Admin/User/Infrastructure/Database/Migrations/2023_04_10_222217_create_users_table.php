<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Core\BoundedContext\Admin\User\Infrastructure\Persistence\Eloquent\UserModel;

return new class extends Migration {
    /**
     * Run the Migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('users', function (Blueprint $table) {
                $table->uuid('id');
                $table->string('name');
                $table->string('last_name');
                $table->string('phone');
                $table->string('address');
                $table->string('slug');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->enum('state', [
                    UserModel::ACTIVE,
                    UserModel::INACTIVE])
                    ->default(UserModel::ACTIVE);
                $table->rememberToken();
                $table->timestamps();
            });
    }

    /**
     * Reverse the Migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
