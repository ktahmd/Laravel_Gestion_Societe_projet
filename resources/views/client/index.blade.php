@extends('layouts.master')

@section('content')
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">List of clients</h3>
        </div>

        <div class="box-header">
            <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus"></i> Add client</a>
            <a href="{{ route('exportPDF.clientAll') }}" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export PDF</a>
            <a href="{{ route('exportExcel.clientAll') }}" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Export Excel</a>
        </div>

        <!-- /.box-header -->
        <div class="box-body">  
            <table id="client-table" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
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
                            <label for="nom" class="control-label">Name:</label>
                            <input type="text" class="form-control" id="nom" name="nom" autofocus required/>
                        </div>
                        <div class="form-group">
                            <label for="adresse" class="control-label">Address:</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" required/>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required/>
                        </div>
                        <div class="form-group">
                            <label for="telephone" class="control-label">Contact:</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" required/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
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
        var table = $('#client-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.client') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nom', name: 'nom'},
                {data: 'adresse', name: 'adresse'},
                {data: 'email', name: 'email'},
                {data: 'telephone', name: 'telephone'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('.modal-title').text('Add client');
            $('#form-item')[0].reset();
            $('#id').val('');
        }
    function editForm(id) {
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#modal-form form')[0].reset();
    $.ajax({
        url: "{{ url('client') }}" + '/' + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Edit client');
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
            url : "{{ url('client') }}" + '/' + id,
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
        var url = "{{ url('client') }}";
        if (save_method == 'edit') {
            url = "{{ url('client') }}" + '/' + id + "/update";
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