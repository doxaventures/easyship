<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
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
        $APP_URL = 'http://easyship.shopifyapplications.com';
        $this->helper->getShop('shipjam.myshopify.com')->call([
            'METHOD' => 'POST',
            'URL' => 'admin/webhooks.json',
            "DATA" => [
                "webhook" => [
                    "topic" => "orders/create",
                    "address" => $APP_URL.'/webhooks/create/order',
                    "format" => "json"
                ]
            ]
        ]);
    }
    public function webhook_order_create(Request $request)
    {
        $orders = new OrderController();
        $orders->get_orders();
    }
}
