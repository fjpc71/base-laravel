<?php
namespace Database\Helper;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductMigration extends Migration
{
    public static function new($name, $function, $added = [])
    {
        Schema::create($name, function ($table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger("product_id");

            $table->foreign("product_id")
                  ->references("id")
                  ->on("products")
                  ->onDelete("cascade");
        });

        Schema::table($name, function ($table) use ($function, $added) {
            $function($table);

            $elems = [];
            foreach ($table->getAddedColumns() as $column) {
                $table->boolean("show-" . $column->getAttributes()['name'])->default(1);
            }
            foreach ($added as $column) {
                $table->boolean("show-" . $column)->default(1);
            }
        });
    }
}
