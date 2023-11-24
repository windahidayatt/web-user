<div class="modal fade" id="editTeamModal" tabindex="-1" aria-labelledby="editTeamModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-form">
            <div class="modal-header">
                <h2 class="modal-title" id="editTeamModalLabel">Ubah Team</h2>
            </div>
            <form action="/team" method="post" id="form-edit-team">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="text" id="row_index" value="" hidden>
                    <input type="text" id="id" name="id" value="" hidden>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" id="edit_name" name="name" placeholder="Tulis Nama Team">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Anggota</label>
                                <select class="form-control" name="selected_users[]" multiple="multiple" id="selectUsersEdit">
                                    @foreach ($list_users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-short" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-short">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        $('#selectUsersEdit').select2({
            placeholder: "Pilih Anggota",
            allowClear: true,
            width: '100%',
            closeOnSelect: false
        });
    });


    $("#form-edit-team").submit(function(e){
        e.preventDefault();
        var formData = new FormData($(this)[0]);

        $.ajaxSetup({
            async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:"{{ route('putTeam') }}",
            data: formData,
            processData: false,
            contentType: false,
            success:function(response){
                if(response.message != 'success'){
                    Swal.fire({
                        icon: 'error',
                        text: 'Data gagal diedit!',
                    })
                }else{
                    $('#editTeamModal').modal('hide')
                    var data = response.data
                    var idx_row = parseInt($('#row_index').val());
                    var tableTeam = $("#dtTableTeam").DataTable().row(idx_row)
                    tableTeam.cell(idx_row, 0).data(idx_row + 1).draw()
                    tableTeam.cell(idx_row, 1).data(data.name).draw()
                    tableTeam.cell(idx_row, 2).data(data.total_participants).draw()
                }
                
            },
        });
    });

</script>