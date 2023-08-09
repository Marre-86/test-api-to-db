<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Stock;
use App\Models\Income;
use App\Models\Sale;
use App\Models\Order;

class GetData extends Command
{
    protected $signature = 'app:get-data';
    protected $description = 'Command description';

    protected $baseUrl = 'http://89.108.115.241:6969/api/';
    protected $dateFrom = '2022-08-07';
    protected $dateTo = '2023-08-09';
    protected $page = 1;
    protected $key = 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie';
    protected $perPage = 500;
    protected $totalPages = 1;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->getStocks();
        $this->getIncomes();
        $this->getSales();
        $this->getOrders();
    }

    private function getStocks()
    {
        Stock::truncate();

        do {
            try {
                $response = Http::get($this->baseUrl . 'stocks', [
                    'dateFrom' => '2023-08-09',
                    'page' => $this->page,
                    'key' => $this->key,
                    'limit' => $this->perPage,
                ]);

                if ($response->successful()) {
                    $data = $response->json();

                    // Update the total pages on the first response
                    if ($this->page === 1) {
                        $this->totalPages = $data['meta']['last_page'];
                    }

                    // Save each stock data to the database
                    foreach ($data['data'] as $stockData) {
                        Stock::create($stockData);
                    }

                    $this->page++;
                }
            } catch (\Exception $e) {
                // Handle the cURL error
                echo "Error: Failed to connect to the API." . PHP_EOL;
                break; // Stop the loop on error
            }
        } while ($this->page <= $this->totalPages);

        $this->resetProperties();

        $totalSavedInstances = Stock::count();
        if ($totalSavedInstances > 0) {
            echo "Successfully downloaded to DB Stock: " . $totalSavedInstances . " instances." . PHP_EOL;
        }
    }

    private function getIncomes()
    {
        Income::truncate();

        do {
            try {
                $response = Http::get($this->baseUrl . 'incomes', [
                    'dateFrom' => $this->dateFrom,
                    'dateTo' => $this->dateTo,
                    'page' => $this->page,
                    'key' => $this->key,
                    'limit' => $this->perPage,
                ]);

                if ($response->successful()) {
                    $data = $response->json();

                    // Update the total pages on the first response
                    if ($this->page === 1) {
                        $this->totalPages = $data['meta']['last_page'];
                    }

                    // Save each stock data to the database
                    foreach ($data['data'] as $incomeData) {
                        Income::create($incomeData);
                    }

                    $this->page++;
                }
            } catch (\Exception $e) {
                // Handle the cURL error
                echo "Error: Failed to connect to the API." . PHP_EOL;
                break; // Stop the loop on error
            }
        } while ($this->page <= $this->totalPages);

        $this->resetProperties();

        $totalSavedInstances = Income::count();
        if ($totalSavedInstances > 0) {
            echo "Successfully downloaded to DB Income: " . $totalSavedInstances . " instances." . PHP_EOL;
        }
    }

    private function getSales()
    {
        Sale::truncate();

        do {
            try {
                $response = Http::get($this->baseUrl . 'sales', [
                    'dateFrom' => $this->dateFrom,
                    'dateTo' => $this->dateTo,
                    'page' => $this->page,
                    'key' => $this->key,
                    'limit' => $this->perPage,
                ]);

                if ($response->successful()) {
                    $data = $response->json();

                    // Update the total pages on the first response
                    if ($this->page === 1) {
                        $this->totalPages = $data['meta']['last_page'];
                    }

                    foreach ($data['data'] as $saleData) {
                        try {
                            Sale::create($saleData);
                        } catch (\Exception $e) {
                            echo "Error: Failed to create sale record. " . $e->getMessage() . PHP_EOL;
                        }
                    }

                    $this->page++;
                }
            } catch (\Exception $e) {
                // Handle the cURL error
                echo "Error: Failed to connect to the API." . PHP_EOL;
                break; // Stop the loop on error
            }
        } while ($this->page <= $this->totalPages);

        $this->resetProperties();

        $totalSavedInstances = Sale::count();
        if ($totalSavedInstances > 0) {
            echo "Successfully downloaded to DB Sale: " . $totalSavedInstances . " instances." . PHP_EOL;
        }
    }

    private function getOrders()
    {
        Order::truncate();

        do {
            try {
                $response = Http::get($this->baseUrl . 'orders', [
                    'dateFrom' => $this->dateFrom,
                    'dateTo' => $this->dateTo,
                    'page' => $this->page,
                    'key' => $this->key,
                    'limit' => $this->perPage,
                ]);

                if ($response->successful()) {
                    $data = $response->json();

                    // Update the total pages on the first response
                    if ($this->page === 1) {
                        $this->totalPages = $data['meta']['last_page'];
                    }

                    foreach ($data['data'] as $orderData) {
                        try {
                            Order::create($orderData);
                        } catch (\Exception $e) {
                            echo "Error: Failed to create sale record. " . $e->getMessage() . PHP_EOL;
                        }
                    }

                    $this->page++;
                }
            } catch (\Exception $e) {
                echo "Error: Failed to connect to the API." . PHP_EOL;
                break;
            }
        } while ($this->page <= $this->totalPages);

        $this->resetProperties();

        $totalSavedInstances = Order::count();
        if ($totalSavedInstances > 0) {
            echo "Successfully downloaded to DB Order: " . $totalSavedInstances . " instances." . PHP_EOL;
        }
    }

    protected function resetProperties()
    {
        $this->page = 1;
        $this->totalPages = 1;
    }
}
