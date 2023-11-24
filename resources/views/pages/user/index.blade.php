@extends('layouts.main')

@section('container')

<div class="container-fluid container-table">
    <div class="row">
        <div class="col-12">
            <div class="top-table">
                <div class="row">
                    <div class="col-4 left">
                        <input type="text" class="form-control" id="txt-table-filter" placeholder="Cari Nama Pengguna">
                        <button type="button" class="btn btn-sm btn-search" id="btn-search"><span class="material-icons-sharp">search</span></button>
                    </div>
                    <div class="col-8 right">
                        <button type="button" class="btn btn-primary btn-curved" data-toggle="modal" data-target="#addUserModal">Tambah Pengguna</button>
                    </div>
                </div>
            </div>
            <div class="tab-table">
                <table id="dtTableUser" class="table table-borderless table-sm table-students" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">No</th>
                            <th class="th-sm">Nama Pengguna</th>
                            <th class="th-sm">No Telp</th>
                            <th class="th-sm">Role</th>
                            <th class="th-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_users as $key=>$user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone == null ? '-' : $user->phone }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>
                                    <a class="nav-link nav-edit" href="#" user="button" data-toggle="dropdown" aria-expanded="false">
                                        <img class="avatar avatar-sm rounded-circle td-btn edit" alt="Icon Pencil" src="{{ url('assets/images/icon/icon-action-dropdown.svg') }}">
                                    </a>
                                    <ul class="dropdown-menu dropdown-edit">
                                        <li><a class="dropdown-item btn-edit" href="#" data-toggle="modal" data-target="#editUserModal" data-id="{{ $user->id }}">Ubah Data</a></li>
                                        <li><a class="dropdown-item btn-detail" href="#" data-toggle="modal" data-target="#detailUserModal" data-id="{{ $user->id }}">Detail Data</a></li>
                                        <li><a class="dropdown-item btn-delete" href="#" data-id="{{ $user->id }}" style="color:red">Hapus Data</a></li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <!-- Modal -->
            @include('pages.user.modal_form_add')
            @include('pages.user.modal_form_edit')
            @include('pages.user.modal_form_detail')
            
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        var tableUser = $('#dtTableUser').DataTable({
            dom: 'lrtip',
            language: {
            paginate: {
                    next: '>',
                    previous: '<'  
                }
            },
            bAutoWidth: false, 
            aoColumns : [
                { sWidth: '5%' },
                { sWidth: '25%' },
                { sWidth: '10%' },
                { sWidth: '15%' },
                { sWidth: '5%' }
            ]
        });

        $('#txt-table-filter').on('keyup', function(){
            var searchText = $('#txt-table-filter').val();
            // get result by regex
            var searchTerm = searchText.toLowerCase();
            var regex = '\\b' + searchTerm + '.*';
            tableUser.search(regex, true, false).draw();
        });

        $('#dtTableUser').on( 'click', 'tr', function () {
            $("#row_index").val(tableUser.row( this ).index());
        });
    });

    $('.btn-edit').on('click', function(){
                
        var id = $(this).data('id');
        $("#id").val(id);
        $.ajaxSetup({
        async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $("#id").val();
        $.ajax({
            type:'GET',
            url:'user/' + id,
            success:function(response){
                if(response.message != 'success'){
                    Swal.fire({
                        icon: 'error',
                        text: 'Gagal mendapatkan data!',
                    })
                }else{
                    var data = response.data
                    $("#edit_name").val(data.name);
                    $("#edit_username").val(data.username);
                    $("#edit_phone").val(data.phone);
                    $("#edit_address").val(data.address);
                    $("#edit_role_id").val(data.role_id);
                }
                
            },
        });
    });

    $('.btn-detail').on('click', function(){
        var id = $(this).data('id');
        $("#id").val(id);
        $.ajaxSetup({
        async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $("#id").val();
        $.ajax({
            type:'GET',
            url:'user/' + id,
            success:function(response){
                if(response.message != 'success'){
                    Swal.fire({
                        icon: 'error',
                        text: 'Gagal mendapatkan data!',
                    })
                }else{
                    var data = response.data
                    $("#detail_name").val(data.name);
                    $("#detail_username").val(data.username);
                    $("#detail_phone").val(data.phone);
                    $("#detail_address").val(data.address);
                    $("#detail_role_name").val(data.role.name);
                }
            },
        });
    });

    $('.btn-delete').on('click', function(){
        
        var id = $(this).data('id');
        $("#id").val(id);
        
        Swal.fire({
            icon: 'question',
            text: 'Data akan terhapus secara permanen, apakah Anda yakin ingin Menghapus data?',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Iya, Yakin',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({async: false});

                var id = $("#id").val();

                $.ajax({
                    type:'DELETE',
                    url:"{{ route('deleteUser') }}",
                    data:{id: id, _token: '{{csrf_token()}}' },
                    success:function(response){
                        console.log(response)
                        if(response.message == 'failed'){
                            Swal.fire({
                                icon: 'error',
                                text: 'Gagal menghapus data!',
                            })
                        }else{
                            window.location.reload();
                        }
                    },
                });
            }
        });
    });

</script>
@endsection