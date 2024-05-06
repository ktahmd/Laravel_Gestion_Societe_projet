@extends('layouts.master')

@section('content')
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">List of categoriess</h3>
        </div>

        <div class="box-header">
            <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus"></i> Add categories</a>
            <a href="{{ route('exportPDF.categoriesAll') }}" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export PDF</a>
            <a href="{{ route('exportExcel.categoriesAll') }}" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Export Excel</a>
        </div>

        <!-- /.box-header -->
        <div class="box-body">  
            <table id="categories-table" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>description</th>
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
                            <label for="description" class="control-label">description:</label>
                            <input type="text" class="form-control" id="description" name="adresse" required/>
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
        var table = $('#categories-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.categories') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nom', name: 'nom'},
                {data: 'description', name: 'description'},
              
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('.modal-title').text('Add categories');
            $('#form-item')[0].reset();
            $('#id').val('');
        }
    function editForm(id) {
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#modal-form form')[0].reset();
    $.ajax({
        url: "{{ url('categories') }}" + '/' + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Edit categories');
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
            url : "{{ url('categories') }}" + '/' + id,
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
        var url = "{{ url('categories') }}";
        if (save_method == 'edit') {
            url = "{{ url('categories') }}" + '/' + id + "/update";
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