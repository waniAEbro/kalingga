<?php

namespace App\Console\Commands;

use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Support\Facades\DB;

class MqttSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to a MQTT topic and display messages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mqtt = MQTT::connection();
        $mqtt->subscribe('topic', function (string $topic, string $message) {
            $production = DB::table("productions")->join("products", "productions.product_id", "products.id")->where("products.rfid", $message)->first();

            $warehouse = Warehouse::where("production_id", $production->product_id)->first();

            $this->info(sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message,));

            $warehouse->update([
                "product_id" => $production->product_id,
                "quantity" => $warehouse->quantity + 1,
            ]);
        }, 1);
        $mqtt->loop(true);

        return 0;
    }
}
