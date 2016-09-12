<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('id');
            $table->string('name');
            $table->string('nickname');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('phone')->default('');

            $table->string('avatar');
            $table->text('remark');

            $table->enum('user_type', ['manager', 'customer']);

            $table->integer('status')->default(0);
            $table->string('last_ip')->default('');
            $table->string('ip')->default('');

            $table->rememberToken();
            $table->timestamps();

            $table->softDeletes();
            $table->timestamp('last_login')->nullable();


        });

        Schema::create('sys_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('url');
            $table->string('post_content');
            $table->string('log_content');
            $table->string('remote_ip');
            $table->timestamp('created_at');
        });


        $date = date('Y-m-d H:i:s');
        DB::table('users')->insert(
            [
                'name' => 'admin',
                'password' => Hash::make('123456'),
                'email' => 'demo@admin.com',
                'phone' => '13800138000',
                'status' => 1,
                'avatar' => '/uploads/content/20160830/57c548266250b_34o.jpg',
                'remark' => 'My Blog',
                'created_at' => $date,
                'updated_at' => $date
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        Schema::drop('sys_logs');
    }

}
