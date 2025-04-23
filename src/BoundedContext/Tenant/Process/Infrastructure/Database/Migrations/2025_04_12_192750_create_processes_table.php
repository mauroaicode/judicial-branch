<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->unsignedBigInteger('process_id'); // idRegProceso
            $table->string('filing_code'); // llaveProceso
            $table->unsignedInteger('connection_id'); // idConexion
            $table->boolean('is_private'); // esPrivado
            $table->timestamp('process_date')->nullable(); // fechaProceso
            $table->string('full_docket_code')->nullable(); // codDespachoCompleto
            $table->string('court')->nullable(); // despacho
            $table->string('judge')->nullable(); // ponente
            $table->string('process_type')->nullable(); // tipoProceso
            $table->string('process_class')->nullable(); // claseProceso
            $table->string('process_subclass')->nullable(); // subclaseProceso
            $table->string('appeal_type')->nullable(); // recurso
            $table->string('location')->nullable(); // ubicacion
            $table->text('filing_content')->nullable(); // contenidoRadicacion
            $table->timestamp('consulted_at')->nullable(); // fechaConsulta
            $table->timestamp('last_updated_at')->nullable(); // ultimaActualizacion

            // Foreign key UUID
            $table->uuid('filing_id');
            $table->foreign('filing_id')->references('id')->on('filings')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('processes');
    }
};
