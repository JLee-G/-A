<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //訂單資料表
        Schema::create('Order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 255)->comment('單號');
            $table->timestamps();
        });

        //折抵金資料表
        Schema::create('Discount', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Amount', 20)->comment('金額');
            $table->string('Reason', 255)->comment('原因');
            $table->integer('user_id')->comment('使用者ID');
            $table->timestamps();
        });

        //組別金額資料表
        Schema::create('Amount_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Order_id')->comment('訂單ID');
            $table->integer('Group_number')->comment('組別號碼');
            $table->string('Amount', 20)->comment('金額');
            $table->string('Currency', 50)->comment('幣別');
            $table->timestamps();
        });

        //個人金額資料表
        Schema::create('Amount_individual', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Order_shopping_id')->comment('訂單&購物 中介ID');
            $table->string('Amount', 20)->comment('金額');
            $table->string('Currency', 50)->comment('幣別');
            $table->timestamps();
        });

        //訂單&購買中介 資料表
        Schema::create('Order_shopping', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Order_id')->comment('訂單ID');
            $table->integer('shopping_id')->comment('購買資訊ID');
            $table->integer('Type')->comment('區分類別用');
            $table->string('Discount_arr_id', 11)->comment('折扣金ID(多個)');
            $table->integer('Group_number')->comment('組別號碼');
            $table->timestamps();
        });

        //訂單&客戶中介 資料表
        Schema::create('Order_client', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->comment('訂單ID');
            $table->integer('Client_id')->comment('客戶ID');
            $table->timestamps();
        });
        
        //航空購買資訊資料表
        Schema::create('Buy_Aviation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Orderer_id')->comment('訂購客戶ID');
            $table->string('Client_arr_id', 255)->comment('客戶ID(多個)');
            $table->integer('Supplier_Aviation_id')->comment('航空&供應商_id');
            $table->string('OneWay_RoundTrip', 50)->comment('單程/來回');
            $table->string('Departure', 50)->comment('啟程地');
            $table->string('Destination', 50)->comment('目的地');
            $table->date('Departure_date', 11)->comment('出發日期');
            $table->integer('Adults')->comment('搭乘成人');
            $table->integer('Child')->comment('搭乘小孩');
            $table->integer('Elderly')->comment('搭乘老人');
            $table->string('flight_number', 50)->comment('航班');
            $table->string('aircraft_type', 50)->comment('機型');
            $table->timestamp('Departure_time')->nullable()->comment('出發時間');
            $table->timestamp('Arrival_time')->nullable()->comment('到達時間');
            $table->timestamps();
        });

        //飯店購買資訊資料表
        Schema::create('Buy_Hotel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Orderer_id')->comment('訂購客戶ID');
            $table->string('Client_arr_id', 255)->comment('客戶ID(多個)');
            $table->integer('Supplier_Hotel_id')->comment('飯店&供應商_id');
            $table->integer('Rooms_number')->comment('房間數量');
            $table->timestamp('Check-in_date')->nullable()->comment('入住時間');
            $table->timestamp('Check-out_date')->nullable()->comment('退房時間');
            $table->timestamps();
        });
        
        //票券購買資訊資料表
        Schema::create('Buy_Ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Orderer_id')->comment('訂購客戶ID');
            $table->integer('Supplier_Ticket_id')->comment('票券&供應商_id');
            $table->integer('Rooms_number')->comment('數量');
            $table->timestamps();
        });

        //航空&供應編號資料表
        Schema::create('Supplier_Aviation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Aviation_id')->comment('航空公司ID');
            $table->integer('Supplier_id')->comment('供應商ID');
            $table->string('Numbering', 50)->comment('編號');
            $table->timestamps();
        });

        //飯店&供應編號資料表
        Schema::create('Supplier_Hotel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Hotel_id')->comment('飯店ID');
            $table->integer('supplier_id')->comment('供應商ID');
            $table->string('Numbering', 50)->comment('編號');
            $table->timestamps();
        });

        //票券&供應編號資料表
        Schema::create('Supplier_Ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Ticket_id')->comment('票券ID');
            $table->integer('supplier_id')->comment('供應商ID');
            $table->string('Numbering', 50)->comment('編號');
            $table->timestamps();
        });

        //航空公司資料表
        Schema::create('Aviation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('公司名稱');
            $table->string('name_en', 255)->comment('英文名稱');
            $table->string('phone', 50)->comment('電話');
            $table->string('phone2', 50)->comment('電話2');
            $table->string('address', 255)->comment('地址');
            $table->string('fax', 50)->comment('傳真');
            $table->string('Emain', 50)->comment('信箱');
            $table->string('url', 255)->comment('網址');
            $table->timestamps();
        });

        //飯店資訊資料表
        Schema::create('Hotel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('公司名稱');
            $table->string('name_en', 255)->comment('英文名稱');
            $table->string('Star', 50)->comment('星級');
            $table->string('phone', 50)->comment('電話');
            $table->string('phone2', 50)->comment('電話2');
            $table->string('address', 255)->comment('地址');
            $table->string('fax', 50)->comment('傳真');
            $table->string('Emain', 50)->comment('信箱');
            $table->string('url', 255)->comment('網址');
            $table->timestamps();
        });

        //票券公司資料表
        Schema::create('Ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('公司名稱');
            $table->string('name_en', 255)->comment('英文名稱');
            $table->string('phone', 50)->comment('電話');
            $table->string('phone2', 50)->comment('電話2');
            $table->string('address', 255)->comment('地址');
            $table->string('fax', 50)->comment('傳真');
            $table->string('Emain', 50)->comment('信箱');
            $table->string('url', 255)->comment('網址');
            $table->timestamps();
        });

        //供應商資料表
        Schema::create('Supplier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('公司名稱');
            $table->string('name_en', 255)->comment('英文名稱');
            $table->string('phone', 50)->comment('電話');
            $table->string('phone2', 50)->comment('電話2');
            $table->string('address', 255)->comment('地址');
            $table->string('fax', 50)->comment('傳真');
            $table->string('Emain', 50)->comment('信箱');
            $table->string('url', 255)->comment('網址');
            $table->integer('Uniform_numbers')->comment('統一編號');
            $table->string('Contact_person', 50)->comment('聯絡人');
            $table->string('Contact_phone', 50)->comment('聯絡人電話');
            $table->string('Contact_cell_phone', 50)->comment('聯絡人手機');
            $table->string('Contact_job_title', 50)->comment('聯絡人職稱');
            $table->string('Beneficiary_Bank', 50)->comment('收款銀行');
            $table->string('Bank_Code', 50)->comment('銀行代碼');
            $table->string('Branch_name', 50)->comment('分行名稱');
            $table->string('Bank_account', 50)->comment('銀行帳戶');
            $table->timestamps();
        });

        //訂單客戶資料資料表
        Schema::create('Purchase_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Product_ID', 255)->comment('產品編號');
            $table->string('name', 50)->comment('客戶名稱');
            $table->string('name_en', 50)->comment('英文姓名');
            $table->string('gender', 11)->comment('客戶性別');
            $table->string('address', 255)->comment('地址');
            $table->date('birthday')->comment('生日');
            $table->string('phone', 50)->comment('電話');
            $table->string('Telephone_country_code', 11)->comment('電話國家地區代碼');
            $table->string('Telephone_area_code', 11)->comment('電話區碼');
            $table->string('Extension', 11)->comment('電話分機');
            $table->string('Cell_phone', 50)->comment('手機');
            $table->string('Emain', 255)->comment('信箱');
            $table->timestamps();
        });

        //客戶資料資料表
        Schema::create('Client', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->comment('客戶名稱');
            $table->string('name_en', 50)->comment('英文姓名');
            $table->string('gender', 11)->comment('客戶性別');
            $table->string('address', 255)->comment('地址');
            $table->date('birthday')->comment('生日');
            $table->string('phone', 50)->comment('電話');
            $table->string('Telephone_country_code', 11)->comment('電話國家地區代碼');
            $table->string('Telephone_area_code', 11)->comment('電話區碼');
            $table->string('Extension', 11)->comment('電話分機');
            $table->string('Cell_phone', 50)->comment('手機');
            $table->string('Emain', 255)->comment('信箱');
            $table->timestamps();
        });

        //帳單資料表
        Schema::create('Bill', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Type', 50)->comment('付款=1、退款=2');
            $table->string('Amount', 20)->comment('金額');
            $table->string('Currency', 50)->comment('幣別');
            $table->integer('is_transaction')->comment('是否已交易');
            $table->timestamp('transaction_time')->nullable()->comment('預定交易時間');
            $table->timestamp('transaction_hour')->nullable()->comment('交易時間');
            $table->integer('client_id')->comment('交易客戶ID');
            $table->string('payment_method', 50)->comment('付款方式');
            $table->timestamps();
        });
        
        //帳單&(訂單&購買_ID)中介 資料表
        Schema::create('Bill_Order-shopping', function (Blueprint $table) {
            $table->integer('order_shopping_id')->comment('訂單&購買資訊ID');
            $table->integer('bill_id')->comment('帳單ID');
            $table->timestamps();
        });

        //成本資料表
        Schema::create('Cost', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Type')->comment('收入=1、支出=2');
            $table->integer('Quantity')->comment('數量');
            $table->string('Unit', 50)->comment('單位');
            $table->string('Amount', 20)->comment('金額');
            $table->string('Currency', 50)->comment('幣別');
            $table->string('Original_currency', 50)->comment('原本幣別');
            $table->string('exchange_rate', 255)->comment('匯率');
            $table->timestamps();
        });

        //成本&(訂單&購買_ID)中介 資料表
        Schema::create('Cost_Order-shopping', function (Blueprint $table) {
            $table->integer('cost_id')->comment('成本ID');
            $table->integer('Shopping_order_id')->comment('訂單&購買資訊ID');
            $table->timestamps();
        });

        //信用卡付款資訊資料表
        Schema::create('Credit_card', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Numbering', 50)->comment('編號');
            $table->string('code', 50)->comment('銀行代號');
            $table->timestamps();
        });

        //超商付款資訊資料表
        Schema::create('Convenience_store', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Payment_code', 50)->comment('繳款代碼');
            $table->string('name', 50)->comment('超商名稱');
            $table->string('address', 255)->comment('超商地址');
            $table->string('phone', 50)->comment('超商電話');
            $table->string('code', 50)->comment('超商代號');
            $table->timestamps();
        });

        //貨到付款資訊資料表
        Schema::create('Cash_on_delivery', function (Blueprint $table) {
            $table->increments('id');
            $table->date('Arrival_date')->comment('到貨日');
            $table->string('address', 255)->comment('地址');
            $table->string('name', 50)->comment('付款人姓名');
            $table->timestamps();
        });

        //支票付款資訊資料表
        Schema::create('Bank_check', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Payer_name', 50)->comment('付款人姓名');
            $table->string('Payer_phone', 50)->comment('付款人手機');
            $table->string('Payee_Name', 50)->comment('收款人姓名');
            $table->string('Payee_phone', 50)->comment('收款人手機');
            $table->date('Payment_date')->comment('收款日期');
            $table->timestamps();
        });
        
        
        
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Order');
        Schema::dropIfExists('Discount');
        Schema::dropIfExists('Amount_group');
        Schema::dropIfExists('Amount_individual');
        Schema::dropIfExists('Order_shopping');
        Schema::dropIfExists('Order_client');
        Schema::dropIfExists('Buy_Aviation');
        Schema::dropIfExists('Buy_Hotel');
        Schema::dropIfExists('Buy_Ticket');
        Schema::dropIfExists('Supplier_Aviation');
        Schema::dropIfExists('Supplier_Hotel');
        Schema::dropIfExists('Supplier_Ticket');
        Schema::dropIfExists('Aviation');
        Schema::dropIfExists('Hotel');
        Schema::dropIfExists('Ticket');
        Schema::dropIfExists('Supplier');
        Schema::dropIfExists('Purchase_customer');
        Schema::dropIfExists('Client');
        Schema::dropIfExists('Bill');
        Schema::dropIfExists('Bill_Order-shopping');
        Schema::dropIfExists('Cost');
        Schema::dropIfExists('Cost_Order-shopping');
        Schema::dropIfExists('Credit_card');
        Schema::dropIfExists('Convenience_store');
        Schema::dropIfExists('Cash_on_delivery');
        Schema::dropIfExists('Bank_check');
    }
}
