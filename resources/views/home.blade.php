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
                <h3>{{\App\models\User::count()}}</h3>

                <p>Utilisateur</p>
            </div>
            <div class="icon">
                <img src="{{ asset('usericon.png')}}" alt="usericon" width="60px">
            </div>
            <a href="/user" class="small-box-footer">Plus d'informations <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ \App\models\categories::count() }}<sup style="font-size: 20px"></sup></h3>

                <p>Categories</p>
            </div>
            <div class="icon">
                <img src="{{ asset('categorieicon.png')}}" alt="categorieicon" width="60px">
            </div>
            <a href="{{ route('categories.index') }}" class="small-box-footer">Plus d'informations <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ \App\models\produit::count() }}</h3>
                <p>produits</p>
            </div>
            <div class="icon">
                <img src="{{ asset('produiticon.png')}}" alt="produiticon" width="60px">
            </div>
             <a href="{{ route('Produit.index') }}" class="small-box-footer">Plus d'informations <i class="fa fa-arrow-circle-right"></i></a> 
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{\App\models\client::count() }}</h3>

            <p>clients</p>
            </div>
            <div class="icon">
                <img src="{{ asset('clienticon.png')}}" alt="clienticon" width="60px">
            </div>
            <a href="{{ route('client.index') }}" class="small-box-footer">Plus d'informations <i class="fa fa-arrow-circle-right"></i></a>
            
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- Log on to codeastro.com for more projects! -->


<div class="row">
    
    
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3>{{ \App\models\commandes::count() }}</h3>

                <p>commandes</p>
            </div>
            <div class="icon">
                <img src="{{ asset('commandeicon.png')}}" alt="commandeicon" width="60px">
            </div>
            <a href="{{ route('commandes.index') }}" class="small-box-footer">Plus d'informations <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    {{-- <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ \App\models\commandes::count() }}<sup style="font-size: 20px"></sup></h3>

                <p>ajouter </p>
            </div>
            <div class="icon">
                <i class="fa fa-signal"></i>
            </div>
            <a href="{{ route('suppliers.index') }}" class="small-box-footer">Plus d'informations <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div> --}}
    
    <div id="container" class=" col-xs-6"></div>
</div><!-- Log on to codeastro.com for more projects! -->

@endsection

@section('top')
@endsection
