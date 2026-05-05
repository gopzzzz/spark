@extends('layouts.mainlayout')

@section('content')

 <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Published Books</h3>
                           
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Books</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <div class="buttons"  data-bs-toggle="modal" data-bs-target="#inlineForm">
    <a href="#" class="btn btn-primary" >
        <i class="bi bi-plus"></i> Create
    </a>
</div>

<div class="modal fade text-left" id="inlineForm" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">Create Books</h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                           <form method="POST" action="{{url('insertbooks')}}" enctype="multipart/form-data" name="crmedit">

                                                @csrf
                                                            <div class="modal-body">
                                                                <label>Title: </label>
                                                                <div class="form-group">
                                                                    <input type="text" 
                                                                        class="form-control" name="heading">
                                                                </div>
                                                                <label>Description: </label>
                                                                <div class="form-group">
                                                                    <textarea class="form-control" name="desc"></textarea>
                                                                </div>
                                                                   <label>Thumbnail : (Copy Image name from uploads )</label>
                                                                <div class="form-group">
                                                                    
                                                                   <input type="text" 
                                                                        class="form-control" name="cover">
                                                                </div>

                                                                 

                                                                 <label>Price: </label>
                                                                <div class="form-group">
                                                                    <input type="text" 
                                                                        class="form-control" name="price">
                                                                </div>

                                                                 <label>Purchase Link: </label>
                                                                <div class="form-group">
                                                                    <input type="text" 
                                                                        class="form-control" name="link">
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
                                                                    <span class="d-none d-sm-block">Publish</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                      
                                        <th>Thumbnail </th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                         <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $bk)
                                    <tr>
        
                                        <td> <img  src="{{asset('images/'.$bk->book_image)}}" width="100" height="60"></td>
                                        <td>{{$bk->title}}</td>
                                        <td>{{$bk->desc}}</td>
                                        <td>
                                            {{$bk->price}}
                                        </td>
                                         <td>
                                            <span class="badge bg-success editbooks" data-id="{{$bk->id}}">Edit</span>
                                             <span class="badge bg-danger deletebooks" data-id="{{$bk->id}}">Delete</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>


                            <div class="modal fade text-left" id="editapp_model" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">Edit Blog</h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                           <form method="POST" action="{{url('editbooks')}}" enctype="multipart/form-data" name="crmedit">

                                                @csrf
                                                              <div class="modal-body">
                                                                 <input type="hidden" name="id" id="appid">
                                                                <label>Title: </label>
                                                                <div class="form-group">
                                                                    <input type="text" 
                                                                        class="form-control" name="heading" id="heading">
                                                                </div>
                                                                <label>Description: </label>
                                                                <div class="form-group">
                                                                    <textarea class="form-control" name="desc" id="desc"></textarea>
                                                                </div>
                                                                   <label>Thumbnail : (Copy Image name from uploads )</label>
                                                                <div class="form-group">
                                                                    
                                                                   <input type="text" 
                                                                        class="form-control" name="cover" id="cover">
                                                                </div>

                                                                 

                                                                 <label>Price: </label>
                                                                <div class="form-group">
                                                                    <input type="text" 
                                                                        class="form-control" name="price" id="price">
                                                                </div>

                                                                  <label>Purchase Link: </label>
                                                                <div class="form-group">
                                                                    <input type="text" 
                                                                        class="form-control" name="link" id="link">
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
                                                                    <span class="d-none d-sm-block">Publish</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>



                                            
   <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirm Delete</h5>
               
            </div>

            <div class="modal-body">
                Are you sure you want to remove this from Books
            </div>

            <div class="modal-footer">
                 <button type="button" class="btn btn-light-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>

                <a href="" class="btn btn-danger" id="delete">
                    Yes, Remove
                </a>
            </div>

        </div>
    </div>
</div>



                        </div>
                    </div>

                </section>
            </div>


@endsection