<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE VIEW product_variation_stock_view AS
            SELECT
                variations.product_id as product_id,
                variations.id as variation_id,
                COALESCE(
                    SUM(stocks.quantity) - COALESCE(SUM(product_varition_order.quantity), 0),
                    0
                ) as current_stock,
                CASE
                    WHEN COALESCE(
                        SUM(stocks.quantity) - COALESCE(SUM(product_varition_order.quantity), 0),
                        0
                    ) > 0 THEN true
                    ELSE false
                END available
            FROM
                variations
                LEFT JOIN(
                    SELECT
                        stocks.variation_id as id,
                        SUM(stocks.quantity) as quantity
                    FROM
                        stocks
                    GROUP BY
                        stocks.variation_id
                ) as stocks USING (id)
                LEFT JOIN (
                    SELECT
                        varition_order.vairation_id as id,
                        sum(varition_order.quantity) as quantity
                    FROM
                        varition_order
                    GROUP BY
                        varition_order.vairation_id
                ) as product_varition_order USING(id)
            GROUP by
                variations.id,
                variations.product_id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS product_variation_stock_view');
    }
};
