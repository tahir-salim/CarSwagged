@extends('admin.layout')
@section('content')
<div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        
                                        <h4 class="page-title">Admin Dashboard</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-contain">
                            <div class="row">
                                <div class="col-2 align-self-center">
                                    <i class="fas fa-tasks text-gradient-success"></i>
                                </div>
                                <div class="col-10 text-right">
                                    <h5 class="mt-0 mb-1">190</h5>
                                    <p class="mb-0 font-12 text-muted">Active Tasks</p>   
                                </div>
                            </div>                                                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body justify-content-center">
                        <div class="icon-contain">
                            <div class="row">
                                <div class="col-2 align-self-center">
                                    <i class="far fa-gem text-gradient-danger"></i>
                                </div>
                                <div class="col-10 text-right">
                                    <h5 class="mt-0 mb-1">62</h5>
                                    <p class="mb-0 font-12 text-muted">Project</p>
                                </div>
                            </div>                                                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-contain">
                            <div class="row">
                                <div class="col-2 align-self-center">
                                    <i class="fas fa-users text-gradient-warning"></i>
                                </div>
                                <div class="col-10 text-right">
                                    <h5 class="mt-0 mb-1">14</h5>
                                    <p class="mb-0 font-12 text-muted">Teams</p>    
                                </div>
                            </div>                                                        
                        </div>                                                    
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card ">
                    <div class="card-body">
                        <div class="icon-contain">
                            <div class="row">
                                <div class="col-2 align-self-center">
                                    <i class="fas fa-database text-gradient-primary"></i>
                                </div>
                                <div class="col-10 text-right">
                                    <h5 class="mt-0 mb-1">$15562</h5>
                                    <p class="mb-0 font-12 text-muted">Budget</p>    
                                </div>
                            </div>                                                        
                        </div>                                                    
                    </div>
                </div>
            </div>                                             
        </div> 
        <div class="card">
            <div class="card-body">
                
                <h5 class="header-title mb-4 mt-0">Monthly Record</h5>
                <canvas id="lineChart" height="82"></canvas>
            </div>
        </div>                                    
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="dropdown d-inline-block float-right">
                    <a class="nav-link dropdown-toggle arrow-none" id="dLabel4" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel4">
                        <a class="dropdown-item" href="#">Create Project</a>
                        <a class="dropdown-item" href="#">Open Project</a>
                        <a class="dropdown-item" href="#">Tasks Details</a>
                    </div>
                </div>
                <h5 class="header-title mb-4 mt-0">Activity</h5>
                <div>
                    <canvas id="dash-doughnut" height="200"></canvas>
                </div>
                <ul class="list-unstyled list-inline text-center mb-0 mt-3">
                    <li class="mb-2 list-inline-item text-muted font-13"><i class="mdi mdi-label text-success mr-2"></i>Active</li>
                    <li class="mb-2 list-inline-item text-muted font-13"><i class="mdi mdi-label text-danger mr-2"></i>Complete</li>
                    <li class="mb-2 list-inline-item text-muted font-13"><i class="mdi mdi-label text-warning mr-2"></i>Panding</li>
                </ul>
            </div>                               
        </div>
       
    </div>  
    
    
    <div class="col-xl-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <a href="#" class="btn btn-outline-success float-right">Withdraw Monthly</a>
                <h5 class="header-title mb-4 mt-0">Monthly Revenue</h5>
                <h4 class="mb-4">$15,421.50</h4>
                <p class="font-14 text-muted mb-4">
                    <i class="mdi mdi-message-reply text-danger mr-2 font-18"></i>
                    $ 1500 when an unknown printer took a galley.
                </p>                                        
                <canvas id="bar-data" height="132"></canvas> 
            </div>                         
        </div>
       
    </div>
</div>

@endsection