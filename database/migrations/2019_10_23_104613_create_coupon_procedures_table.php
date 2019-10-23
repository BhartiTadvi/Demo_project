<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_procedures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('code')->nullable();
            $table->string('discount')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('remaining_quantity')->nullable();
            $table->timestamps();
            });

         DB::unprepared("CREATE PROCEDURE InsertCoupons(IN var_title varchar(255), IN var_type varchar(255), IN var_code varchar(255), IN var_quantity int,IN var_remaining_quantity int, IN var_discount int)
         BEGIN
         INSERT INTO coupon_procedures(title,type,code,discount,quantity,remaining_quantity) VALUES(var_title,var_code,var_type,var_quantity,var_remaining_quantity,var_discount);
         END");

         DB::unprepared('CREATE PROCEDURE GetCoupons() 
            BEGIN 
            SELECT * FROM coupon_procedures; 
            END');
        
         DB::unprepared("CREATE PROCEDURE UpdateCoupons(IN var_title varchar(255), IN var_type varchar(255), IN var_code varchar(255),IN var_quantity int,IN var_remaining_quantity int, IN var_discount int,IN var_id int)
            BEGIN
            UPDATE coupon_procedures SET title=var_title,type=var_type,code=var_code,quantity=var_quantity,remaining_quantity=var_remaining_quantity,discount=var_discount where id=var_id;
            END");
         
         DB::unprepared("CREATE PROCEDURE DeleteCoupons(IN var_id int)
            BEGIN
            DELETE FROM coupon_procedures where id=var_id;
            END");
    



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS InsertCoupons');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetCoupons');
        DB::unprepared('DROP PROCEDURE IF EXISTS UpdateCoupons');
        DB::unprepared('DROP PROCEDURE IF EXISTS DeleteCoupons');
        Schema::drop('coupon_procedures');
    }
}
