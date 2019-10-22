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
                        <h4 class="card-title"> Single Orders Details</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="border-top-0">Order ID</th>
                                <th class="border-top-0">Order STATUS</th>
                                <th class="border-top-0">Order Placed Date</th>
                                <th class="border-top-0">Order Total Price</th>
                                <th class="border-top-0">Store Name</th>
                                <th class="border-top-0">Easy Shipment ID</th>
                                <th class="border-top-0">Order No</th>
                                <th class="border-top-0">Delivery Method</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_single as $order_details)
                                <tr>

                                    <td class="txt-oflo">{{$order_details->order_id}}</td>
                                    <td><span class="label label-info label-rounded">{{$order_details->order_status}}</span> </td>
                                    <td class="txt-oflo">{{ Carbon\Carbon::parse($order_details->order_created_at)->format('l jS \\ F Y h:i:s A')}}</td>
                                    <td><span class="font-medium">{{$order_details->total_charges}}</span></td>
                                    <td><span class="font-medium">{{$order_details->store_name}}</span></td>
                                    <td><span class="font-medium">{{$order_details->easy_shipment_id}}</span></td>
                                    <td><span class="font-medium">{{$order_details->order_no}}</span></td>
                                    <td><span class="font-medium">{{$order_details->gateway}}</span></td>

                                    <td><span style="padding-right: 10px;"><a href="{{route('get_single_order',$order_details->id)}}"><i class="fa fa-info-circle"></i></a></span><span><a href=""> <i class="fa fa-trash" aria-hidden="true"></i></a></span></td>
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
                                <th class="border-top-0">Receiver Name</th>
                                <th class="border-top-0">Receiver State</th>
                                <th class="border-top-0">Receiver City</th>
                                <th class="border-top-0">Receiver Postalcode</th>
                                <th class="border-top-0">Receiver Company</th>
                                <th class="border-top-0">Receiver Mobile</th>
                                <th class="border-top-0">Receiver Country</th>
                                <th class="border-top-0">Receiver Email</th>
                                <th class="border-top-0">Receiver Address</th>
                                <th class="border-top-0">Action</th>
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
                                    <td><span style="padding-right: 10px;"><a href="{{route('get_single_order',$order_details->id)}}"><i class="fa fa-info-circle"></i></a></span><span><a href=""> <i class="fa fa-trash" aria-hidden="true"></i></a></span></td>
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
                                <th class="border-top-0">Courier ID</th>
                                <th class="border-top-0">Courier Name</th>
                                <th class="border-top-0">Delivery Time</th>
                                <th class="border-top-0">Shipment Total Charges</th>
                                <th class="border-top-0">Shipment Status</th>
                                <th class="border-top-0">Action</th>
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
                                    <td><span style="padding-right: 10px;"><a href="{{route('get_single_order',$order_details->id)}}"><i class="fa fa-info-circle"></i></a></span><span><a href=""> <i class="fa fa-trash" aria-hidden="true"></i></a></span></td>
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
                                <th class="border-top-0">Customer ID</th>
                                <th class="border-top-0">Customer Name</th>
                                <th class="border-top-0">Customer Total Orders</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_single as $order_details)
                                <tr>

                                    <td class="">{{$order_details->customer_id}}</td>
                                    <td class="">{{$order_details->customer_name}}</td>
                                    <td><span class="">{{$order_details->customer_total_orders}}</span></td>
                                    <td><span style="padding-right: 10px;"><a href="{{route('get_single_order',$order_details->id)}}"><i class="fa fa-info-circle"></i></a></span><span><a href=""> <i class="fa fa-trash" aria-hidden="true"></i></a></span></td>
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
                                <th class="border-top-0">Buyer Name</th>
                                <th class="border-top-0">Buyer Phone/Email</th>
                                <th class="border-top-0">Buyer address</th>
                                <th class="border-top-0">Buyer city</th>
                                <th class="border-top-0">Buyer zipcode</th>
                                <th class="border-top-0">Buyer Province/state</th>
                                <th class="border-top-0">Buyer country</th>
                                <th class="border-top-0">Buyer company</th>
                                <th class="border-top-0">Action</th>
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

                                    <td><span style="padding-right: 10px;"><a href="{{route('get_single_order',$order_details->id)}}"><i class="fa fa-info-circle"></i></a></span><span><a href=""> <i class="fa fa-trash" aria-hidden="true"></i></a></span></td>
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