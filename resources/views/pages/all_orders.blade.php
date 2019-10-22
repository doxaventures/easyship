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
                        <h4 class="card-title">Orders Details</h4>
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
                                <th class="border-top-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order as $order_details)
                            <tr>

                                <td class="txt-oflo">{{$order_details->order_id}}</td>
                                <td><span class="label label-info label-rounded">{{$order_details->order_status}}</span> </td>
                                <td class="txt-oflo">{{ Carbon\Carbon::parse($order_details->order_created_at)->format('l jS \\ F Y h:i:s A')}}</td>
                                <td><span class="font-medium">{{$order_details->total_charges}}</span></td>
                                <td><span class="font-medium">{{$order_details->store_name}}</span></td>
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