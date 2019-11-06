<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new HelperController();
    }
    public function get_shipment(){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.easyship.com/shipment/v1/shipments?easyship_shipment_id=&platform_order_number=&shipment_state=&pickup_state=&delivery_state=&label_state=&created_at_from=&created_at_to=&confirmed_at_from=&confirmed_at_to=&per_page=&page=");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Bearer prod_UdV6vE+NNY6kn6Z6uuija2no0hw0SCGMtZRlJ3DRvrk="
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $res= json_decode($response);
        $shipments = $res->shipments;
        foreach ($shipments as $key => $shipment){

            if (Order::where('easy_shipment_id', '=', $shipment->easyship_shipment_id)->exists()) {

                $shipment_pending=$shipment->label_state;
                if($shipment_pending == 'pending'){
                    Order::where('shipment_status',$shipment_pending)->first()->update([
                        'shipment_status' => 'pending'
                    ]);

                }
                else{
//                $order=Order::

                }
            }
        }
        $ship = Order::all();
        return view('pages.shipments')->with('ship',$ship);
}
public function delete_shipment($id){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.easyship.com/shipment/v1/shipments/{$id}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Authorization: Bearer prod_UdV6vE+NNY6kn6Z6uuija2no0hw0SCGMtZRlJ3DRvrk="
    ));

    $response = curl_exec($ch);
    curl_close($ch);
    $res=json_decode($response);
    dd(explode($response,':'));
    flash($response);
    return back();
}
}
