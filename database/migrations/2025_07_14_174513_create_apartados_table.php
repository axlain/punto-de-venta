<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('apartados', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->date('fecha');
            $table->decimal('total', 10, 2);
            
            $table->foreignId('producto_id')->nullable()->constrained('productos')->nullOnDelete();
            $table->string('producto_manual')->nullable();
            $table->decimal('precio_manual', 10, 2)->nullable();
            $table->decimal('monto', 10, 2)->default(0);
            $table->decimal('restante', 10, 2)->default(0);
            $table->boolean('pagado')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apartados');
    }
};
