<?php

namespace App\Http\Controllers;

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

        curl_setopt($ch, CURLOPT_URL, "https://api.easyship.com/shipment/v1/shipments/{easyship_shipment_id}?format=PNG&label=4X6&commercial_invoice=4X6&packip_slip=4X6");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Bearer prod_UdV6vE+NNY6kn6Z6uuija2no0hw0SCGMtZRlJ3DRvrk="
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $res= json_decode($response);
        dd($res);
}
}