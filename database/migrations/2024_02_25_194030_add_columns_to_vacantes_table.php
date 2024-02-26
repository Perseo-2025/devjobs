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
        Schema::table('vacantes', function (Blueprint $table) {
            $table->string('titulo');
            $table->foreingId('salario_id')->constrained()->onDelete('cascade');
            $table->foreingId('categoria_id')->constrained()->onDelete('cascade');
            $table->string('empresa');
            $table->date('ultimo_dia');
            $table->text('descripcion');
            $table->string('imagen');
            $table->integer('publicado')->default(1);
            $table->foreingId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vacantes', function (Blueprint $table) {
            //Elimina las columnas
            $table->dropForeign('vacantes_user_id_foreing');
            $table->dropForeign('vacantes_salario_id_foreing');
            $table->dropForeign('vacantes_categoria_id_foreing');

            $table->dropColumn(['titulo','salario_id','categoria_id','empresa','ultimo_dia',
            'descripcion','imagen','publicado','user_id']);
        });
    }
};
