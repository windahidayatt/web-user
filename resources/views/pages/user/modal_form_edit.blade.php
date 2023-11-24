<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-form">
            <div class="modal-header">
                <h2 class="modal-title" id="editUserModalLabel">Ubah Pengguna</h2>
            </div>
            <form action="/backoffice/user" method="post" id="form-edit-user">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="text" id="row_index" value="" hidden>
                    <input type="text" id="id" name="id" value="" hidden>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" id="edit_name" name="name" placeholder="Tulis Nama Lengkap">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" id="edit_username" name="username" placeholder="Tulis Username">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>No Telp</label>
                                <input type="text" class="form-control" id="edit_phone" name="phone" placeholder="Tulis No Telp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" id="edit_address" name="address" placeholder="Tulis Alamat">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name="role_id" id="edit_role_id">
                                    <option value="" disabled selected hidden>Pilih Role</option>
                                    @foreach ($list_roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
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

    $("#form-edit-user").submit(function(e){
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
            url:"{{ route('putUser') }}",
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
                    $('#editUserModal').modal('hide')
                    var data = response.data
                    var idx_row = parseInt($('#row_index').val());
                    var tableUser = $("#dtTableUser").DataTable().row(idx_row)
                    tableUser.cell(idx_row, 0).data(idx_row + 1).draw()
                    tableUser.cell(idx_row, 1).data(data.name).draw()
                    tableUser.cell(idx_row, 2).data(data.username).draw()
                    tableUser.cell(idx_row, 3).data(data.phone).draw()
                    tableUser.cell(idx_row, 4).data(data.role_name).draw()
                }
                
            },
        });
    });

</script>