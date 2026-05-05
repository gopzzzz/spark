@extends('layouts.mainlayout')

@section('content')

<div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
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
                                                            <h4 class="modal-title" id="myModalLabel33">Create Blog</h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                           <form method="POST" action="{{url('insertblog')}}" enctype="multipart/form-data" name="crmedit">

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
                                                                   <label>Image: (Copy Image name from uploads )</label>
                                                                <div class="form-group">
                                                                    
                                                                   <input type="text" 
                                                                        class="form-control" name="image">
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
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Basic card section start -->
                <section id="content-types">
                    <div class="row">
                        @foreach($blogs as $bg)
                       <div class="col-xl-4 col-md-6 col-sm-12">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title">{{$bg->heading}}</h4>
                <p class="card-text">
                   {{$bg->description}}
                </p>
            </div>

            <img class="img-fluid w-100" src="{{asset('images/'.$bg->image)}}" alt="Card image cap">

            <!-- Creative Action Strip -->
            <div class="card-footer bg-light d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-primary editblogs" data-id="{{$bg->id}}">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
                <a href="#" class="btn btn-sm btn-outline-danger delete-blog" data-toggle="modal"  data-id="{{$bg->id}}">
                    <i class="bi bi-trash"></i> Delete
                </a>
            </div>
        </div>
    </div>
</div>
   @endforeach


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
                                                           <form method="POST" action="{{url('editblogs')}}" enctype="multipart/form-data" name="crmedit">

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
                                                                   <label>Image: (Copy Image name from uploads )</label>
                                                                <div class="form-group">
                                                                    
                                                                   <input type="text" 
                                                                        class="form-control" name="image" id="image">
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
                Are you sure you want to remove this from Blog?
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
                </section>
              
                
            </div>
   


@endsection
