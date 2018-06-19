<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 200);
            $table->date('data_de_nascimento');
            $table->string('nome_da_mae', 200);
            $table->string('nome_do_pai', 200)->nullable();
            $table->date('data_do_obito')->nullable();
            $table->smallInteger('sexo_id');
            $table->smallInteger('cor_da_pele_id');
            $table->smallInteger('etnia_indigena_id')->nullable();
            $table->smallInteger('tipo_sanguineo_id')->nullable();
            $table->smallInteger('nacionalidade_id');
            $table->smallInteger('pais_de_nascimento_id');
            $table->date('data_de_naturalizacao')->nullable();
            $table->string('numero_da_portaria_naturalizacao', 128)->nullable();
            $table->date('data_de_chegada_ao_brasil')->nullable();
            $table->integer('municipio_de_nascimento_ibge_code');
            $table->smallInteger('grau_de_qualidade_percentual');
            $table->boolean('nomade')->default(false);
            $table->boolean('vivo')->default(true);
            $table->boolean('ativo')->default(true);

            // Relacionamento com users
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

//            responsavel = pw.ForeignKeyField('self', null=True, related_name='dependentes')
//            endereco = pw.ForeignKeyField(Endereco);

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
        Schema::dropIfExists('people');
    }
}
