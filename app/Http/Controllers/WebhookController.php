<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    protected $helper;
    public function __construct()
    {
        $this->helper = new HelperController();
    }
    public function getwebhook(){
        $webhooks = $this->helper->getShop(session('shop_name'))->call([
            'METHOD' => 'get',
            'URL' => 'admin/webhooks.json',
        ]);
        dd($webhooks);
    }
}
