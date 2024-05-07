@extends('layouts.master')

@section('content')
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">List of commandes</h3>
        </div>

        <div class="box-header">
            <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus"></i> Add commands</a>
            <a onclick="pdff({{ $CM_ID }})" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export PDF</a>
            <a onclick="excell({{ $CM_ID }})" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Export Excel</a>
        </div>
        <div class="box-header">
           <h3 class="box-title"><h1><b>Détails des commandes de {{ $client }}</b></h1>
        </div>

        <!-- Afficher les détails de la commande spécifique -->
        <div class="box-body">  
            <table id="commandes-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>MONTANT</th>
                        <th>ACTION </th>
                    </tr>
                </thead>
                <tbody>
                    
    @foreach($factures as $f)
        <tr>
            <td>{{ $f->produit->nom }}</td>
            <td>{{ $f->qty }}</td>
            <td>{{ $f->produit->prix }}</td>
            <td>{{ $f->qty * $f->produit->prix }}</td>
            <td><a onclick="editForm('. $f->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> 
                <a onclick="deleteData('. $f->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>
            </td>
        </tr>
    @endforeach


                </tbody>
            </table>
        </div>
        <div class="box-body">
            <h3>Total payé : <span id="totalPaye">0</span> MRU</h3>
        </div>
        <!-- /.box-body -->
    </div>
<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                
                <form id="form-item" method="post"  data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }} {{ method_field('POST') }}
                
                    
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="produit_id" class="control-label">prodiut:</label>
                        {!! Form::select('produit_id', App\Models\Produit::pluck('nom', 'id'), null, ['class' => 'form-control select', 'placeholder' => '-- Choose Produit --', 'id' => 'produit_id', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="qty" class="control-label">quantite:</label>
                        <input type="text" class="form-control" id="qty" name="qty" autofocus required/>
                    </div>
                    
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

    @section('bot')
        <!-- DataTables -->
        <script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    
        {{-- Validator --}}
        <script src="{{ asset('assets/validator/validator.min.js') }}"></script>
    
        <script type="text/javascript">
            
            $(document).ready(function() {
            var totalPaye = 0;

            // Calculer la somme du montant total des commandes
            $('#commandes-table tbody tr').each(function() {
                var montant = parseFloat($(this).find('td:eq(3)').text());
                totalPaye += montant;
            });
            $('#totalPaye').text(totalPaye.toFixed(2) + ' MRU');
            });
            
            function pdff(CM_ID) {
                save_method = 'open';
                url = "{{ url('exportfacturesAll') }}" + "/" + CM_ID;
                window.open(url, '_blank');
            }

            function excell(CM_ID) {
                save_method = 'open';
                url = "{{ url('exportfacturesAllExcel') }}" + "/" + CM_ID;
                window.open(url, '_blank');
            }
    
    
            function addForm(id) {
                save_method = "add";
                $('input[name=_method]').val('POST');
                $('#modal-form').modal('show');
                $('.modal-title').text('Add factures');
                $('#form-item')[0].reset();
                $('#id').val('');
                $.ajax({
                    url: "{{ url('factures') }}" + '/' + id + "/store",
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#modal-form').modal('show');
                        $('.modal-title').text('Edit factures');
                        $('#id').val(data.id); 
                        $('#nom').val(data.nom); 
                        $('#adresse').val(data.adresse);  
                        $('#email').val(data.email);
                        $('#telephone').val(data.telephone);
                    },
                    error : function() {
                        alert("Nothing Data");
                    }
                });
            }
        function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
            url: "{{ url('factures') }}" + '/' + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#modal-form').modal('show');
                $('.modal-title').text('Edit factures');
                $('#id').val(data.id); 
                $('#nom').val(data.nom); 
                $('#adresse').val(data.adresse);  
                $('#email').val(data.email);
                $('#telephone').val(data.telephone);
            },
            error : function() {
                alert("Nothing Data");
            }
        });
    }
    
        function deleteData(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            $.ajax({
                url : "{{ url('factures') }}" + '/' + id,
                type : "POST",
                data : {'_method' : 'DELETE', '_token' : csrf_token},
                success : function(data) {
                    table.ajax.reload();
                    swal({
                        title: 'Success!',
                        text: data.message,
                        type: 'success',
                        timer: '1500'
                    })
                },
                error : function () {
                    swal({
                        title: 'Oops...',
                        text: data.message,
                        type: 'error',
                        timer: '1500'
                    })
                }
            });
        });
    }
    
    $(function(){
        $('#modal-form form').validator().on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission
            var id = $('#id').val();
            var url = "{{ url('factures') }}";
            if (save_method == 'edit') {
                url = "{{ url('factures') }}" + '/' + id + "/update";
            }
    
            // Retrieve CSRF token value from meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
    
            $.ajax({
                url: url,
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token in request headers
                },
                data: new FormData($(this)[0]),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#modal-form').modal('hide');
                    table.ajax.reload();
                    swal({
                        title: 'Success!',
                        text: data.message,
                        type: 'success',
                        timer: '1500'
                    });
                },
                error: function(data) {
                    swal({
                        title: 'Oops...',
                        text: data.responseJSON.message, // Display error message from server
                        type: 'error',
                        timer: '1500'
                    });
                }
            });
        });
    });
        </script>
            
        </script>
    @endsection
