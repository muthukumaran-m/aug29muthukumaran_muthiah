ubject<?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create('students', function (Blueprint $table) {
                    $table->id();
                    $table->string('name', 50);
                    $table->string('email', 50);
                    $table->string('phone', 13);
                    $table->text('address');
                    $table->string('city', 50);
                    $table->string('state', 50);
                    $table->string('country', 50);
                    $table->tinyInteger('status')->default(0);
                    $table->timestamps();
                    $table->softDeletes();
                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists('students');
            }
        };
