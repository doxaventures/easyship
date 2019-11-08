<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\test;
class WebhookController extends Controller
{
    protected $helper;
    public function __construct()
    {
        $this->helper = new HelperController();
    }
    public function getwebhook(){
        $webhooks = $this->helper->getShop('shipjam.myshopify.com')->call([
            'METHOD' => 'get',
            'URL' => 'admin/webhooks.json',
        ]);
        dd($webhooks);
    }
    public function webhook(){
        $APP_URL = 'https://easyship.shopifyapplications.com/webhooks/create/order';
        $this->helper->getShop('shipjam.myshopify.com')->call([
            'METHOD' => 'PUT',
            'URL' => 'admin/api/2019-10/webhooks.json',
            "DATA" => [
                "webhook" => [
                    "topic" => "orders/create",
                    "address" => $APP_URL,
                    "format" => "json"
                ]
            ]
        ]);
    }
    public function webhook_order_create(Request $request)
    {
        $json = file_get_contents('php://input');
    $order = json_encode($json);
   $test=new test();
   $test->data=$order;
   $test->save();
//        $orders->get_orders();
    }
}
