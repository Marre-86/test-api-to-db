<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Stock;
use App\Models\Income;
use App\Models\Sale;
use App\Models\Order;

class GetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->getStock();
    }

    private function getStock()
    {
        $dummyStock = new Stock([
            'date' => '2023-08-09',
            'last_change_date' => '2023-08-08',
            'supplier_article' => 'a_262258994',
            'tech_size' => 's_296',
            'barcode' => '3343804767992',
            'quantity' => 0,
            'is_supply' => 0,
            'is_realization' => 1,
            'quantity_full' => 0,
            'warehouse_name' => 'Пушкино',
            'in_way_to_client' => 0,
            'in_way_from_client' => 0,
            'nm_id' => 380090997,
            'subject' => 'subject_1153',
            'category' => 'category_03405',
            'brand' => 'brand_6791887',
            'sc_code' => '2666-0041',
            'price' => 1113,
            'discount' => 15,
        ]);

        $dummyStock->save();
    }
}
