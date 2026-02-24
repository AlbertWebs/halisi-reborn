<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('billing_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('billing_clients')->cascadeOnDelete();
            $table->string('invoice_number')->unique();
            $table->date('issue_date');
            $table->date('due_date');
            $table->decimal('subtotal', 14, 2)->default(0);
            $table->decimal('tax_rate', 5, 2)->default(0)->comment('e.g. 16 for 16%');
            $table->decimal('tax_amount', 14, 2)->default(0);
            $table->decimal('discount_type', 5, 2)->nullable()->comment('0 = fixed amount, 1+ = percentage');
            $table->decimal('discount_value', 14, 2)->default(0);
            $table->decimal('discount_amount', 14, 2)->default(0);
            $table->decimal('total', 14, 2)->default(0);
            $table->string('currency', 3)->default('USD');
            $table->string('status', 20)->default('draft'); // draft, sent, paid, overdue
            $table->text('notes')->nullable();
            $table->text('payment_instructions')->nullable();
            $table->timestamps();

            $table->index(['status', 'due_date']);
            $table->index('client_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('billing_invoices');
    }
};
