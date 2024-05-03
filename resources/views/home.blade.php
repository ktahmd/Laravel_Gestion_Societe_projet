@extends('layouts.master')

@section('top')
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <!-- Log on to codeastro.com for more projects! -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ 123 }}</h3>

                <p>System Users</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-secret"></i>
            </div>
            <a href="/user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ 234 }}<sup style="font-size: 20px"></sup></h3>

                <p>Category</p>
            </div>
            <div class="icon">
                <i class="fa fa-list"></i>
            </div>
            {{-- <a href="{{ route('categories.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ 34 }}</h3>
                <p>Product</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            {{-- <a href="{{ route('products.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ 34 }}</h3>

                <p>Customer</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            {{-- <a href="{{ route('customers.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- Log on to codeastro.com for more projects! -->


<div class="row">
    
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ 123 }}<sup style="font-size: 20px"></sup></h3>

                <p>Supplier</p>
            </div>
            <div class="icon">
                <i class="fa fa-signal"></i>
            </div>
            {{-- <a href="{{ route('suppliers.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3>{{ 123 }}</h3>

                <p>Total Purchase</p>
            </div>
            <div class="icon">
                <i class="fa fa-cart-plus"></i>
            </div>
            {{-- <a href="{{ route('productsIn.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ 123  }}</h3>

                <p>Total Outgoing</p>
            </div>
            <div class="icon">
                <i class="fa fa-minus"></i>
            </div>
            {{-- <a href="{{ route('productsOut.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
        </div>
    </div>
    <!-- ./col -->
    <div id="container" class=" col-xs-6"></div>
</div><!-- Log on to codeastro.com for more projects! -->

@endsection

@section('top')
@endsection
