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
            $table->string('name')->unique()->comment('用户名');
            $table->string('nickname')->comment('昵称');
            $table->string('password')->comment('密码');
            $table->boolean('status')->default(true)->comment('状态:1 => 正常 0 => 冻结');
            $table->unsignedInteger('creator_id')->default(0)->comment('创建人id');

            $table->unsignedInteger('login_count')->default(0)->comment('登录时间');
            $table->ipAddress('login_ip')->nullable()->comment('上次登录ip');
            $table->timestamps();
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
