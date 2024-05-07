@extends('layouts.master')

@section('content')


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
                        <label for="client_id" class="control-label">client:</label>
                        {!! Form::select('client_id', App\Models\client::pluck('nom', 'id'), null, ['class' => 'form-control select', 'placeholder' => '-- Choose client --', 'id' => 'client_id', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="produit_id" class="control-label">prodiut:</label>
                        {!! Form::select('produit_id', App\Models\Produit::pluck('nom', 'id'), null, ['class' => 'form-control select', 'placeholder' => '-- Choose Produit --', 'id' => 'produit_id', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="qty" class="control-label">quantite:</label>
                        <input type="text" class="form-control" id="qty" name="qty" autofocus required/>
                    </div>
                    
                    
                    <div class="modal-footer">
                        <button type="button" id="ajouterProduit">+</button>
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
        var table = $('#commander-table').DataTable({
            processing: true,
            serverSide: true,
            
            columns: [
                {data: 'nom', name: 'nom'},
                {data: 'description', name: 'description'},
                {data: 'prix', name: 'prix'},
                {data: 'quantite_stock', name: 'quantite_stock'},
                {data: 'categorie_nom', name: 'categorie_nom'}, // Changed 'orderable' to true for sorting
                
            ]
        });
    

        function addForm() {
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('#modal-form').modal('show');
    $('.modal-title').text('Add commander');
    $('#form-item')[0].reset();
    $('#id').val('');
    
    
}

        function editForm(id) {
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#modal-form form')[0].reset();
    $.ajax({
        url: "{{ url('commander') }}" + '/' + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Edit commander');
            $('#nom').val(data.nom); 
            $('#description').val(data.description); 
            $('#categories_id').val(data.categorie_id);  
            $('#prix').val(data.prix);  
            $('#quantite_stock').val(data.quantite_stock);
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
            url : "{{ url('commander') }}" + '/' + id,
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
        var url = "{{ url('commander') }}";
        if (save_method == 'edit') {
            url = "{{ url('commander') }}" + '/' + id + "/update";
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
        
        $(document).ready(function() {
            // Fonction pour ajouter un produit
            $('#ajouterProduit').on('click', function() {
                var produitHtml = `
                    <div class="form-group">
                        <label for="produit_id" class="control-label">Produit:</label>
                        {!! Form::select('produit_id[]', App\Models\Produit::pluck('nom', 'id'), null, ['class' => 'form-control select', 'placeholder' => '-- Choose Produit --', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="qty" class="control-label">Quantité:</label>
                        <input type="text" class="form-control" name="qty[]" required/>
                    </div>
                `;
                // Ajout du code HTML du produit à la fin du formulaire
                $('#form-item').append(produitHtml);
            });
        });
@endsection