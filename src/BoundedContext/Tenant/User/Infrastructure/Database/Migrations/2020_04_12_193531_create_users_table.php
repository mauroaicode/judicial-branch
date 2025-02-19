<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Core\BoundedContext\Tenant\User\Infrastructure\Persistence\Eloquent\UserModel;

return new class extends Migration {
    /**
     * Run the Migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('last_name');
            $table->string('document')->nullable();
            $table->uuid('identification_type_id')->nullable();;
            $table->foreign('identification_type_id')->references('id')->on('identification_types');
            $table->uuid('gender_identity_id')->nullable();;
            $table->foreign('gender_identity_id')->references('id')->on('gender_identities');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('phone');
            $table->string('phone_two')->nullable();
            $table->enum('state', [
                UserModel::ACTIVE,
                UserModel::INACTIVE])
                ->default(UserModel::ACTIVE);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('slug');
            $table->string('picture')->nullable();
            $table->timestamp('last_login')->nullable();
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
