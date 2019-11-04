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
                        <h4 class="card-title">Shipment Details</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="border-top-0">Easy Ship ID</th>
                                <th class="border-top-0">Shipment Status</th>
                                <th class="border-top-0">Store Name</th>
                                <th class="border-top-0">Order Total Price</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ship as $order_details)
                                <tr>

                                    <td class="txt-oflo">{{$order_details->easy_shipment_id}}</td>
                                    <td><span class="label label-info label-rounded">{{$order_details->shipment_status}}</span> </td>
                                    <td class="txt-oflo">{{$order_details->store_name}}</td>
                                    <td><span class="font-medium">$ {{$order_details->total_charges}}</span></td>

                                    <td><span><a href="#" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-trash" aria-hidden="true"></i></a></span></td>
                                </tr>

                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cancel Shipment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Are you sure? Shipment willbe cancelled</h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a href="{{route('delete_shipment',$order_details->easy_shipment_id)}}" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection