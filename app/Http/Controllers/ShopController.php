<?php

namespace App\Http\Controllers;
use Oseintow\Shopify\Facades\Shopify;
use Illuminate\Http\Request;
use mysql_xdevapi\Session;
use App\Shop;
class ShopController extends Controller
{
    public function index(){
        return view('pages.shop');
    }
    public function shop(Request $request)
    {
        if ($_GET["shop"]) {
            $shopUrl = $_GET["shop"];
            $scope = ["read_orders", "read_products","write_draft_orders","read_draft_orders","read_orders","write_orders","read_checkouts","write_checkouts"];
            $redirectUrl = 'http://127.0.0.1:8000/auth';
            $shopify = Shopify::setShopUrl($shopUrl);
            return redirect()->to($shopify->getAuthorizeUrl($scope, $redirectUrl));
        } else {
            return 'Please enter shop url';
        }
    }
    public function authenticate(Request $request){
        $shopUrl = $request->input('shop');
        $accessToken = Shopify::setShopUrl($shopUrl)->getAccessToken($request->code);
        if (Shop::where('shop_name', '=', $shopUrl)->exists()) {
            $shop = Shop::where('shop_name', $shopUrl)
                ->update([
                    'access_token'=>$accessToken
                ]);
        }else{
            $shop = Shop::create([
                'shop_name'=> $shopUrl,
                'access_token'=>$accessToken
            ]);
        }
        session(['shop_name' => $shopUrl]);
        session(['access_token' => $accessToken]);

        return view('pages.index');
    }
}
