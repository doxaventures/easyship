<?php

namespace App\Http\Controllers;

use Faker\Provider\Address;
use Illuminate\Http\Request;
use App;
use App\Addresses;
class ApiController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new HelperController();
    }
    public function index(Request $request){
$w = $request->input('weight');
$h = $request->input('height');
$oc=$request->input('o_country');
$dc=$request->input('d_country');
$oz = $request->input('o_zipcode');
$dz = $request->input('d_zipcode');
$m= $request->input('mobile');
$wi = $request->input('width');
$l = $request->input('length');
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.easyship.com/rate/v1/rates");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"origin_country_alpha2\": \"$dc\",
  \"origin_postal_code\": \"$oz\",
  \"destination_country_alpha2\": \"$oc\",
  \"destination_postal_code\": \"$dz\",
  \"taxes_duties_paid_by\": \"Sender\",
  \"is_insured\": false,
  \"items\": [
    {
      \"actual_weight\": $w,
      \"height\": $h,
      \"width\": $wi,
      \"length\": $l,
      \"category\": \"$m\",
      \"declared_currency\": \"SGD\",
      \"declared_customs_value\": 100
    }
  ]
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Authorization: Bearer prod_UdV6vE+NNY6kn6Z6uuija2no0hw0SCGMtZRlJ3DRvrk="
));

$response = curl_exec($ch);
curl_close($ch);
$res=json_decode($response);
        return response()->json(['data'=>$response]);

    }

    public function create_draft_order(Request $request){
       $price= $request->input('price');
        $draft_orders = $this->helper->getShop('shipjam.myshopify.com')->call([
            'METHOD' => 'POST',
            'URL' => '/admin/draft_orders.json',
            'DATA' =>
                [
                    "draft_order" => [
                        'line_items' => [
                            [
                                "title"  => "Easy Ship Shipping Method",
                                "price" => $price,
                                "quantity" => 1,
                                "taxable" => false
                            ],

                        ],

                        "shipping_address" => [
                            "address1" => $request->input('s_address_1'),
                            "address2" =>  $request->input('s_address_2'),
                            "city" =>  $request->input('s_city'),
                            "company" =>  $request->input('s_company'),
                            "name" =>  $request->input('s_name'),
                            "province" =>  $request->input('s_state'),
                            "country" =>  $request->input('s_country'),
                            "phone" =>  $request->input('s_contact'),
                            "zip" =>  $request->input('s_postal_code'),
                            "email" => $request->input('s_email'),
                        ]
//                        "customer" => [
//                            "tax_exempt" => true,
//                        ]
                    ]
                ]
        ]);
        $token_array = explode('/',$draft_orders->draft_order->invoice_url);
        $token = $token_array[5];
        $addresses= new Addresses();
        $addresses->courier_id=$request->input('courier_id');
        $addresses->price=$request->input('price');
        $addresses->draft_order_id=$draft_orders->draft_order->id;
        $addresses->sender_country=$request->input('s_country');
        $addresses->sender_postal_code=$request->input('s_postal_code');
        $addresses->sender_city=$request->input('s_city');
        $addresses->sender_state=$request->input('s_state');
        $addresses->sender_address1=$request->input('s_address_1');
        $addresses->sender_address2=$request->input('s_address_2');
        $addresses->sender_name=$request->input('s_name');
        $addresses->sender_company=$request->input('s_company');
        $addresses->sender_contact=$request->input('s_contact');
        $addresses->sender_email=$request->input('s_email');
        $addresses->reciever_country=$request->input('r_country');
        $addresses->reciever_postal_code=$request->input('r_postal_code');
        $addresses->reciever_city=$request->input('r_city');
        $addresses->reciever_state=$request->input('r_state');
        $addresses->reciever_address1=$request->input('r_address_1');
        $addresses->reciever_address2=$request->input('r_address_   2');
        $addresses->reciever_name=$request->input('r_name');
        $addresses->reciever_company=$request->input('r_company');
        $addresses->reciever_contact=$request->input('r_contact');
        $addresses->reciever_email=$request->input('r_email');
        $addresses->width=$request->input('width');
        $addresses->height=$request->input('height');
        $addresses->length=$request->input('length');
        $addresses->weight=$request->input('weight');
        $addresses->token=$token;
        $addresses->save();
        $redirect_url=$draft_orders->draft_order->invoice_url;
return response($redirect_url);
    }
}
