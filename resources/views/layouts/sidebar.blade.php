<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('user-profile.png') }} " class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name  }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> En ligne</a>
            </div>
        </div>
        <!-- Log on to codeastro.com for more projects! -->
        

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
           {{-- <li class="header">Functions</li> --}}
            <!-- Optionally, you can add icons to the links -->
           <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
           <li><a href="{{ url('/user') }}"><i class="fa fa-user-secret"></i> <span>Systeme Utilisateurs</span></a></li> 
           <li><a href="{{ url('/client') }}"><i class="fa fa-users"></i> <span>Systeme Clients</span></a></li>
            <li><a href="{{ route('categories.index') }}"><i class="fa fa-list"></i> <span>Categorie</span></a></li>
            <li><a href="{{ route('Produit.index') }}"><i class="fa fa-cubes"></i> <span>Gestion produit</span></a></li>
             <li><a href="{{ route('commandes.index') }}"><i class="fa fa-cart-plus"></i> <span>Gestion commandes</span></a></li>
            {{-- <li><a href="{{ route('suppliers.index') }}"><i class="fa fa-truck"></i> <span>Supplier</span></a></li>
            <li><a href="{{ route('productsOut.index') }}"><i class="fa fa-minus"></i> <span>Outgoing Products</span></a></li>
            <li><a href="{{ route('productsIn.index') }}"><i class="fa fa-cart-plus"></i> <span>Purchase Products</span></a></li>
             --}}







        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
