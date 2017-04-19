<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            ],
            ['key' => 'themes', 'value' => 'default'],
            ['key' => 'pagesize', 'value' => '10'],
            ['key' => 'note', 'value' => 'ing...'],
            ['key' => 'site-description', 'value' => '副标题'],


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
