<?php

namespace App\Http\Controllers;

use App\Metafield;
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
            'METHOD' => 'POST',
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
    //$order = json_encode($json);
        $c= explode('{',$json);
        $d=$c[1];
        $e= explode(',',$d);
        $f=$e[0];
        $g= explode(':',$f);
        $h=$g[1];
        $orders= new OrderController();
        $orders->get_orders($h);
    }
    public function upsales(Request $request){
        $value=$request->input('meta_value');
        $id =11351611473999;
        $metafield=$this->helper->getShop('shipjam.myshopify.com')->call([
            'METHOD' => 'PUT',
            'URL' => 'admin/api/2019-10/metafields/'.$id.'.json',
            "DATA" => [
                "metafield" => [
                    "id" => 11351611473999,
                    "value" => $value,
                    "value_type" => "integer"
                ]
            ]
        ]);
        dd($metafield->metafield);
  //$database = new Metafield();


    }
}
