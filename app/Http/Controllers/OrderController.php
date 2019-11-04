<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Addresses;
use App\Order;
use Carbon\Carbon;
class OrderController extends Controller
{
protected $helper;

public function __construct()
{
    $this->helper = new HelperController();
}
public function get_orders()
{
    $orders = $this->helper->getShop('shipjam.myshopify.com')->call([
        'METHOD' => 'GET',
        'URL' => '/admin/orders.json',
    ]);
    $orders = $orders->orders;
    foreach ($orders as $key => $order) {
        $checkout_token = explode('/', $order->landing_site)[3];
        $findtoken = Addresses::where('token', $checkout_token)->first();
        return $this->create_shipment($findtoken,$order);

    }
}
    public function create_shipment($shipment_info,$all_order){
    $orders_id=$all_order->id;
    $checkout_id=$all_order->checkout_id;
    $customer_id=$all_order->customer->id;
    $customer_name=$all_order->customer->first_name.' '.$all_order->customer->last_name;
    $order_status=$all_order->financial_status;
    $customer_total_orders=$all_order->customer->orders_count;
    $billing_email=$all_order->customer->email;
    $order_no=$all_order->name;
    $gateway=$all_order->gateway;
    $billing_name=$all_order->billing_address->name;
    $billing_address1=$all_order->billing_address->address1;
    $billing_address2=$all_order->billing_address->address2;
    $billing_phone=$all_order->customer->phone;
    $billing_city=$all_order->billing_address->city;
    $zip=$all_order->billing_address->zip;
    $billing_province=$all_order->billing_address->province;
    $billing_country=$all_order->billing_address->country;
    $billing_company=$all_order->billing_address->company;
    $billing_country_code=$all_order->billing_address->country_code;
    $billing_province_code=$all_order->billing_address->province_code;
$c_id=$shipment_info->courier_id;
$d_country=$shipment_info->reciever_country;
$d_city=$shipment_info->reciever_city;
$d_postalcode=$shipment_info->reciever_postal_code;
$state=$shipment_info->reciever_state;
$name =$shipment_info->reciever_name;
$address1=$shipment_info->reciever_address1;
$address2=$shipment_info->reciever_address2;
$phone=$shipment_info->reciever_contact;
$email=$shipment_info->reciever_email;
$width=$shipment_info->width;
$height=$shipment_info->height;
$length=$shipment_info->length;
$weight=$shipment_info->weight;
$price=$shipment_info->price;
$order_id=$shipment_info->draft_order_id;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.easyship.com/shipment/v1/shipments/create_and_buy_label");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
\"platform_name\": \"Shopify\",
\"platform_order_number\": \"$order_id\",
\"selected_courier_id\": \"$c_id\",
\"destination_country_alpha2\": \"$d_country\",
\"destination_city\": \"$d_city\",
\"destination_postal_code\": \"$d_postalcode\",
\"destination_state\": \"$state\",
\"destination_name\": \"$name\",
\"destination_address_line_1\": \"$address1\",
\"destination_address_line_2\": \"$address2\",
\"destination_phone_number\": \"$phone\",
\"destination_email_address\": \"$email\",
\"items\": [
{
  \"description\": \"Silk dress\",
  \"sku\": \"test\",
   \"actual_weight\": $weight,
  \"height\": $height,
  \"width\": $width,
  \"length\": $length,
  \"category\": \"fashion\",
  \"declared_currency\": \"SGD\",
  \"declared_customs_value\": $price
}
]
}");

        $total=[$orders_id,$customer_name,$checkout_id,$customer_id,$order_status,$customer_total_orders,$billing_email,$order_no,$billing_phone,
            $gateway,$billing_name,$billing_address1,$billing_address2,$billing_city,$zip,$billing_province,$billing_country,
            $billing_company,$billing_country_code,$billing_province_code
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Bearer prod_UdV6vE+NNY6kn6Z6uuija2no0hw0SCGMtZRlJ3DRvrk="
        ));
        $response = curl_exec($ch);
        curl_close($ch);
$res=json_decode($response);



return $this->create_order($res,$total);
}
public function create_order($order,$all){
    $order__id=$all[0];
    $customer_name= $all[1];
    $checkout_id=$all[2];
    $customer_id=$all[3];
    $order_status=$all[4];
    $customer_total_ordersall=$all[5];
    $billing_email=$all[6];
    $order_no=$all[7];
    $billing_phone=$all[8];
    $gateway=$all[9];
    $billing_name=$all[10];
    $billing_address1=$all[11];
    $billing_address2=$all[12];
    $billing_city=$all[13];
    $zip=$all[14];
    $billing_province=$all[15];
    $billing_country=$all[16];
    $billing_company=$all[17];
    $billing_country_code=$all[18];
    $billing_province_code=$all[19];
    $order_created_at=$order->shipment->created_at;
    $easyship_shipment_id=$order->shipment->easyship_shipment_id;
    $store_name=$order->shipment->store_name;
     $destination_name=$order->shipment->destination_name;
     $destination_company_name=$order->shipment->destination_company_name;
     $destination_address1=$order->shipment->destination_address_line_1;
     $destination_address2=$order->shipment->destination_address_line_2;
     $destination_city=$order->shipment->destination_city;
     $destination_state=$order->shipment->destination_state;
     $destination_postal_code=$order->shipment->destination_postal_code;
     $destination_phone_number=$order->shipment->destination_phone_number;
     $destination_email_address=$order->shipment->destination_email_address;
     $platform_order_number=$order->shipment->platform_order_number;
     $platform_name=$order->shipment->platform_name;
     $shipment_state=$order->shipment->shipment_state;
     $destination_country=$order->shipment->destination_country->name;
     $selected_courier_id=$order->shipment->selected_courier->id;
    $selected_courier_name=$order->shipment->selected_courier->name;
    $selected_courier_delivery_time=$order->shipment->selected_courier->min_delivery_time.' '.'to'.' ' . $order->shipment->selected_courier->max_delivery_time.' '.' '.'days' ;
    $selected_courier_total_charges=$order->shipment->selected_courier->total_charge;
    $check_order_id=Order::where('order_id',$order__id)->first();
    if(!$check_order_id){
        $orders=new Order();
        $orders->order_created_at=$order_created_at;
        $orders->easy_shipment_id=$easyship_shipment_id;
        $orders->store_name=$store_name;
        $orders->destination_name=$destination_name;
        $orders->destination_company_name=$destination_company_name;
        $orders->destination_city=$destination_city;
        $orders->destination_state=$destination_state;
        $orders->destination_postalcode=$destination_postal_code;
        $orders->destination_phone_no=$destination_phone_number;
        $orders->destination_email=$destination_email_address;
        $orders->platform_order_number=$platform_order_number;
        $orders->platform_name=$platform_name;
        $orders->shipment_state=$shipment_state;
        $orders->destination_country=$destination_country;
        $orders->courier_id=$selected_courier_id;
        $orders->courier_name=$selected_courier_name;
        $orders->delivery_time=$selected_courier_delivery_time;
        $orders->total_charges=$selected_courier_total_charges;
        $orders->address1=$destination_address1;
        $orders->address2=$destination_address2;
        $orders->customer_id=$customer_id;
        $orders->order_id=$order__id;
        $orders->checkout_id=$checkout_id;
        $orders->order_status=$order_status;
        $orders->customer_name=$customer_name;
        $orders->customer_total_orders=$customer_total_ordersall;
        $orders->billing_email=$billing_email;
        $orders->order_no=$order_no;
        $orders->billing_phone=$billing_phone;
        $orders->gateway=$gateway;
        $orders->billing_name=$billing_name;
        $orders->billing_address1=$billing_address1;
        $orders->billing_address2=$billing_address2;
        $orders->city=$billing_city;
        $orders->zip=$zip;
        $orders->billing_province=$billing_province;
        $orders->billing_country=$billing_country;
        $orders->billing_company=$billing_company;
        $orders->billing_country_code=$billing_country_code;
        $orders->billing_province_code=$billing_province_code;
        $orders->shipment_status='pending';
        $orders->save();


        return redirect('/dashboard');

    }
    else{
        //return $this->create_labels($check_order_id,$easyship_shipment_id);
    return redirect('/dashboard');
    }

    //return $this->create_labels($orders);

}
public function get_all_orders(){
    $order=Order::all();
    return view('pages.all_orders',compact('order'));
}
public function get_single_orders($id){
$order_single=Order::where('id',$id)->get()->orderBy('id');
return view('pages.single_order',compact('order_single'));

}
public function create_labels($ord,$easyship_shipment_id){
    $ship_id=$easyship_shipment_id;
    $c_id=$ord->courier_id;
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.easyship.com/label/v1/labels");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"shipments\": [
    {
      \"easyship_shipment_id\": \"$ship_id\",
      \"courier_id\": \"$c_id\"
    }
  ]
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Authorization: Bearer prod_UdV6vE+NNY6kn6Z6uuija2no0hw0SCGMtZRlJ3DRvrk="
));

$response = curl_exec($ch);
curl_close($ch);

dd($response);

}
public function check_shipment(Request $request){
    $order_id=$request->order_id;
    $checkShipment=Order::where('order_id',$order_id)->get();
    return response()->json($checkShipment);
}


}
