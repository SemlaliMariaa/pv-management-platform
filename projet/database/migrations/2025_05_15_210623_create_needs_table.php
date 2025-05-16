<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_needs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('needs', function (Blueprint $table) {
            $table->id();
            $table->integer('number');              // رقم
            $table->string('description');          // الوصف
            $table->integer('quantity_required');   // الكمية المطلوبة
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('needs');
    }
};
