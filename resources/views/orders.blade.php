@extends('layouts.mainlayout')

@section('content')

 <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Book Orders</h3>
                           
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Orders</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
           


                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                      
                                        <th>Order Id</th>
                                         <th>Whatsapp</th>
                                           <th>Order Date</th>
                                        <th>Cus.Name</th>
                                        <th>Book Name</th>
                                        <th>Qty</th>
                                        <th>Total Amount</th>
                                         <th>Pay Status</th>
                                        <th>Status</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $bk)
                                    <tr>
        
                                        <td>#{{$bk->orderid}}</td>
                                         <td><a href="https://wa.me/{{$bk->phonenumber}}" target="_blank"><i class="bi bi-whatsapp" style="font-size:24px; color:#25D366;"></i></a></td>
                                        <td>{{ $bk->created_at->format('d-m-y') }}</td>
                                       <td>{{$bk->fullname}}</td>
                                        <td>{{$bk->title}}</td>
                                        <td>
                                            {{$bk->qty}}
                                        </td>
                                           <td>
                                            {{$bk->totalamount}}
                                        </td>
                                           <td>
                                            {{$bk->pay_status}}
                                        </td>
                                        
                                        <td>
                                          @if($bk->status == 0)
    <button type="button" class="btn btn-sm btn-secondary editorders" data-id="{{$bk->id}}">Pending</button>

@elseif($bk->status == 1)
    <button type="button" class="btn btn-sm btn-info editorders" data-id="{{$bk->id}}">Confirmed</button>

@elseif($bk->status == 2)
    <button type="button" class="btn btn-sm btn-primary editorders" data-id="{{$bk->id}}">Shipped</button>

@elseif($bk->status == 3)
    <button type="button" class="btn btn-sm btn-success editorders" data-id="{{$bk->id}}">Delivered</button>

@else
    <button type="button" class="btn btn-sm btn-danger editorders" data-id="{{$bk->id}}">Cancelled</button>
@endif


                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

{{ $orders->links() }}


   

<div class="modal fade text-left" id="editapp_model" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">Shipping Address</h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                           <form method="POST" action="{{url('editorder')}}" enctype="multipart/form-data" name="crmedit">

                                                @csrf
                                                              <div class="modal-body">
                                                                 <input type="hidden" name="id" id="appid">
                                                                  <label>Shipping Address: </label>
                                                                <div class="form-group">
                                                                  <textarea class="form-control" id="address"></textarea>
                                                                </div>
                                                                
                                                                 <label>Delivery Note: </label>
                                                                <div class="form-group">
                                                                  <textarea class="form-control" name ="deliverynote" id="deliverynote"></textarea>
                                                                </div>
                                                               
                                                                <label>Status: </label>
                                                                <div class="form-group">
                                                                  <select name="status" class="form-control" id="status">
                                                                    <option value="0">Pending</option>
                                                                     <option value="1">Confirmed</option>
                                                                      <option value="2">Shipped</option>
                                                                       <option value="3">Delivered</option>
                                                                       <option value="4">Cancelled</option>
                                                                  </select>
                                                                </div>
                                                               
                                                                 

                                                                 

                                                                  
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                                <button type="submit" class="btn btn-primary ml-1" >
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Update</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>



                        </div>
                    </div>

                </section>
            </div>


@endsection