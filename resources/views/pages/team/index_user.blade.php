@extends('layouts.main')

@section('container')

<div class="container-fluid container-table">
    <div class="row">
        <div class="col-12">
            <div class="top-table">
                <div class="row">
                    <div class="col-4 left">
                        <input type="text" class="form-control" id="txt-table-filter" placeholder="Cari Nama Team">
                        <button type="button" class="btn btn-sm btn-search" id="btn-search"><span class="material-icons-sharp">search</span></button>
                    </div>
                    @can ('isAdmin')
                        <div class="col-8 right">
                            <button type="button" class="btn btn-primary btn-curved" data-toggle="modal" data-target="#addTeamModal">Tambah Team</button>
                        </div>
                    @endcan
                </div>
            </div>
            <div class="tab-table">
                <table id="dtTableTeam" class="table table-borderless table-sm table-students" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">No</th>
                            <th class="th-sm">Nama</th>
                            <th class="th-sm">Jumlah Anggota</th>
                            <th class="th-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_teams as $key=>$team)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $team->name }}</td>
                                <td>{{ count($team->user_teams) }}</td>
                                <td>
                                    <a class="nav-link nav-edit" href="#" data-toggle="dropdown" aria-expanded="false">
                                        <img class="avatar avatar-sm rounded-circle td-btn edit" alt="Icon Pencil" src="{{ url('assets/images/icon/icon-action-dropdown.svg') }}">
                                    </a>
                                    <ul class="dropdown-menu dropdown-edit">
                                        <li><a class="dropdown-item btn-detail" href="#" data-toggle="modal" data-target="#detailTeamModal" data-id="{{ $team->id }}">Detail Data</a></li>
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
            @include('pages.team.modal_form_detail')
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        var tableTeam = $('#dtTableTeam').DataTable({
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
                { sWidth: '15%' },
                { sWidth: '15%' },
                { sWidth: '5%' }
            ]
        });

        $('#txt-table-filter').on('keyup', function(){
            var searchText = $('#txt-table-filter').val();
            // get result by regex
            var searchTerm = searchText.toLowerCase();
            var regex = '\\b' + searchTerm + '.*';
            tableTeam.search(regex, true, false).draw();
        });

        $('#dtTableTeam').on( 'click', 'tr', function () {
            $("#row_index").val(tableTeam.row( this ).index());
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

        $.ajax({
            type:'GET',
            url:'team/' + id,
            success:function(response){
                if(response.message != 'success'){
                    Swal.fire({
                        icon: 'error',
                        text: 'Gagal mendapatkan data!',
                    })
                }else{
                    var data = response.data
                    $("#detail_name").val(data.team.name);
                    
                    $('#selectUsersDetail').empty();
                    data.list_users.forEach((element) => {
                        if(data.list_selected_users.includes(element.id)){
                            $('#selectUsersDetail').append("<option value='"+ element.id +"' selected='selected'>"+ element.name + "</option>");
                        }else{
                            $('#selectUsersDetail').append("<option value='"+ element.id +"'>"+ element.name + "</option>");
                        }
                    });

                    $('#selectUsersDetail').trigger('change'); 
                }
            },
        });
    });
</script>
@endsection