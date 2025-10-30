<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->dateTime('transaction_date');
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_status', ['pending', 'completed', 'failed']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}

?>