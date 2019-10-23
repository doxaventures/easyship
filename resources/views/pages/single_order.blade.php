<style>
    .table-responsive tr > td:last-child {
        text-align: right;
    }

    .table-responsive tr >th:last-child {
        /* float: right; */
        text-align: right;
    }
</style>
@extends('inc.template')
@section('extend_template_details')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-6">
                            <h4 class="card-title"> Single Orders Details</h4>
                        </div>
                        <div class="col-md-6">
                            <h6 class="card-title"><td><span class="font-medium">Order Name  {{$order_details->order_no}}</span></td></h6>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="border-top-0">ID</th>
                                <th class="border-top-0">STATUS</th>
                                <th class="border-top-0">Placed Date</th>
                                <th class="border-top-0">Total Price</th>
                                <th class="border-top-0">Delivery Method</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_single as $order_details)
                                <tr>

                                    <td class="txt-oflo">{{$order_details->order_id}}</td>
                                    <td><span class="label label-info label-rounded">{{$order_details->order_status}}</span> </td>
                                    <td class="txt-oflo">{{ Carbon\Carbon::parse($order_details->order_created_at)->format('l jS \\ F Y h:i:s A')}}</td>
                                    <td><span class="font-medium">{{$order_details->total_charges}}</span></td>
                                    <td><span class="font-medium">{{$order_details->gateway}}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Receiver Details</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">State</th>
                                <th class="border-top-0">City</th>
                                <th class="border-top-0">Postalcode</th>
                                <th class="border-top-0">Company</th>
                                <th class="border-top-0">Mobile</th>
                                <th class="border-top-0">Country</th>
                                <th class="border-top-0">Email</th>
                                <th class="border-top-0">Address</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_single as $order_details)
                                <tr>

                                    <td class="txt-oflo">{{$order_details->destination_name}}</td>
                                    <td><span class="label label-info label-rounded">{{$order_details->destination_state}}</span> </td>
                                    <td class="txt-oflo">{{$order_details->destination_city}}</td>
                                    <td><span class="font-medium">{{$order_details->destination_postalcode}}</span></td>
                                    <td><span class="font-medium">{{$order_details->destination_company}}</span></td>
                                    <td><span class="font-medium">{{$order_details->destination_phone_no}}</span></td>
                                    <td><span class="font-medium">{{$order_details->destination_country}}</span></td>
                                    <td><span class="font-medium">{{$order_details->destination_email}}</span></td>
                                    <td><span class="font-medium">{{$order_details->address1 . ' '. $order_details->address2}}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Courier Details</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="border-top-0"> ID</th>
                                <th class="border-top-0"> Name</th>
                                <th class="border-top-0"> Time</th>
                                <th class="border-top-0"> Total Charges</th>
                                <th class="border-top-0"> Status</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_single as $order_details)
                                <tr>

                                    <td class="txt-oflo">{{$order_details->courier_id}}</td>
                                    <td class="txt-oflo">{{$order_details->courier_name}}</td>
                                    <td><span class="font-medium">{{$order_details->delivery_time}}</span></td>
                                    <td><span class="font-medium">{{$order_details->total_charges}}</span></td>
                                    <td><span class="font-medium">{{$order_details->shipment_state}}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Customer Details</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="border-top-0"> ID</th>
                                <th class="border-top-0"> Name</th>
                                <th class="border-top-0"> Total Orders</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_single as $order_details)
                                <tr>

                                    <td class="">{{$order_details->customer_id}}</td>
                                    <td class="">{{$order_details->customer_name}}</td>
                                    <td><span class="">{{$order_details->customer_total_orders}}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Billing Details</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="border-top-0"> Name</th>
                                <th class="border-top-0"> Phone/Email</th>
                                <th class="border-top-0"> address</th>
                                <th class="border-top-0"> city</th>
                                <th class="border-top-0"> zipcode</th>
                                <th class="border-top-0"> Province/state</th>
                                <th class="border-top-0"> country</th>
                                <th class="border-top-0"> company</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_single as $order_details)
                                <tr>

                                    <td class="">{{$order_details->billing_name}}</td>
                                    <td class="">{{$order_details->billing_email}}</td>
                                    <td class="">{{$order_details->billing_address1 . ' '. $order_details->billing_address2}}</td>
                                    <td class="">{{$order_details->city}}</td>
                                    <td class="">{{$order_details->zip}}</td>
                                    <td class="">{{$order_details->billing_province}}</td>
                                    <td class="">{{$order_details->billing_country}}</td>
                                    <td class="">{{$order_details->billing_company}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection