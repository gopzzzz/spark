

@extends('layouts.mainlayout')

@section('content')

<div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                      <div class="buttons" data-bs-toggle="modal" data-bs-target="#inlineForm">
    <a href="#" class="btn btn-primary">
        <i class="bi bi-plus"></i> Upload
    </a>
</div>

<div class="modal fade text-left" id="inlineForm" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">Upload Image</h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                           <form method="POST" action="{{url('uploadimage')}}" enctype="multipart/form-data" name="crmedit">

                                                @csrf
                                                            <div class="modal-body">
                                                               <p>Image Size: 350 * 260 PX <br></p>
                                                                <label>Image: </label>
                                                                <div class="form-group">
                                                                    <input type="file" 
                                                                        class="form-control" name="appname">
                                                                </div>

                                                                 <div class="form-group">
                                                                    <input type="checkbox" name="gallary" value="1"> Make this visible in the gallery
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
                                                                    <span class="d-none d-sm-block">Upload</span>
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
                                    <li class="breadcrumb-item active" aria-current="page">Uploads</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Basic card section start -->
                <section id="content-types">
                    <div class="row">

                    @foreach($images as $img)
                      
       <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card">
              <img src="{{asset('images/'.$img->image)}}" class="card-img-top" alt="">

                <div class="card-body text-center d-flex justify-content-center gap-2">
                      <a href="#" class="btn btn-success btn-sm"  onclick="copyText('{{$img->image}}')">
                        <i class="bi bi-clipboard"></i> copy
                    </a>
                     @if($img->gallary==NULL) 
                    <a href="{{ route('toggle.gallary', $img->id) }}" class="btn btn-primary btn-sm">
                     Add to Gallary 
                    </a>
                    @else
  <a href="{{ route('toggle.gallary', $img->id) }}" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i>  Remove  
                    </a>
                    @endif
                  
                </div>
            </div>
        </div>

        @endforeach

      
                    
                    </div>
                </section>
              
                
            </div>
   


@endsection


