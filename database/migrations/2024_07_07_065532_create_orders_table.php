<?php

use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained() ;
            $table->foreignIdFor(ProductVariant::class)->constrained() ;
            // thông tin người đặt hàng
            $table->string('user_name') ;
            $table->string('user_email') ;
            $table->string('user_phone') ;
            $table->string('user_address') ;
            $table->string('user_note') ;

            $table->boolean('is_ship_user_same_user')->default(true) ;
            // thông tin người nhập hàng
            $table->string('ship_user_name')   ->nullable() ;
            $table->string('ship_user_email')  ->nullable() ;
            $table->string('ship_user_phone')  ->nullable() ;
            $table->string('ship_user_address')->nullable() ;
            $table->string('ship_user_note')   ->nullable() ;

            // quản lý
            $table->string('status_order') ->default(Order::STATUS_ORDER_PENDING) ;
            $table->string('status_payment') ->default(Order::STATUS_ORDER_PAYMENT_UPPAID) ;

            $table->double('total_price', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
