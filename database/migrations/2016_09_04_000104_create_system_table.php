<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->string('key');
            $table->string('value');
        });

        $data = [
            [
                'key' => 'title',
                'value' => 'myBlog',
            ],
            [
                'key' => 'keywords',
                'value' => 'myBlog',
            ],
            [
                'key' => 'description',
                'value' => 'myBlog',
            ],
            [
                'key' => 'status',
                'value' => '1',
            ],
            [
                'key' => 'thumb',
                'value' => 'myBlog',
            ]
        ];

        DB::table('systems')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('systems');
    }
}
