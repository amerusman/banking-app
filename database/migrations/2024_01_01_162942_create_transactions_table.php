<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_no');
            $table->foreign('account_no', 'transactions_account_no_foreign')
                ->references('account_no')
                ->on('accounts');
            $table->decimal('amount', 10, 2);
            $table->string('type'); // e.g., 'credit', 'debit'
            $table->string('details'); // e.g., 'deposit', 'withdrawal', 'transfer'
            $table->decimal('balance_before', 10, 2);
            $table->decimal('balance_after', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
