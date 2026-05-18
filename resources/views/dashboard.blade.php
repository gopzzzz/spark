   @extends('layouts.mainlayout')

@section('content')
   
   <div class="page-heading">
                <h3>Profile Statistics</h3>
            </div>
           
 
 <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
        
<div class="col-6 col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body px-3 py-4-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="stats-icon purple">
                        <i class="iconly-boldShow"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <h6 class="text-muted font-semibold">
                        Total Videos
                    </h6>

                    <h6 class="font-extrabold mb-0">
                        {{ $totalVideos }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-6 col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body px-3 py-4-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="stats-icon blue">
                        <i class="iconly-boldProfile"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <h6 class="text-muted font-semibold">
                        Total Customers
                    </h6>

                    <h6 class="font-extrabold mb-0">
                        {{ $totalCustomers }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-6 col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body px-3 py-4-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="stats-icon green">
                        <i class="iconly-boldAdd-User"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <h6 class="text-muted font-semibold">
                        Turn Over
                    </h6>

                    <h6 class="font-extrabold mb-0">
                        ₹{{ $turnOver }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-6 col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body px-3 py-4-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="stats-icon red">
                        <i class="iconly-boldBookmark"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <h6 class="text-muted font-semibold">
                        Help Desk
                    </h6>

                    <h6 class="font-extrabold mb-0">
                        {{ $helpDesk }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Profile Visit</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-profile-visit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    </div>
                   
                </section>
            </div>

        
   
@endsection
