<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recetas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',300)->unique();
            $table->string('descripcion',4000);
            $table->string('resumen',510)->nullable();
            $table->string('imagen_portada',255)->nullable();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
            $table->boolean('enabled')->default(false);
            $table->foreignId('seccion_id')->nullable();//->after('enabled');   
            $table->integer('vistas')->nullable();  
            /* 
            $table->unsignedInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admin_users')->onUpdate('cascade');*/
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recetas');
    }
}
