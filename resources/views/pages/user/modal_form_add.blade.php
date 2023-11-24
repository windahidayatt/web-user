<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserlLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-form">
            <div class="modal-header">
                <h2 class="modal-title" id="addUserlLabel">Tambah Pengguna</h2>
            </div>
            <form action="/backoffice/user" method="post" id="form-add-user">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="name" placeholder="Tulis Nama Lengkap" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Tulis Username" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>No Telp</label>
                                <input type="text" class="form-control" name="phone" placeholder="Tulis No Telp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="address" placeholder="Tulis Alamat">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Pilih Role</label>
                                <select class="form-control" name="role_id" required>
                                    <option value="" disabled selected hidden>Pilih Role</option>
                                    @foreach ($list_roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <p>*Default password: NamaRole + 123456</p>
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

    $("#form-add-user").submit(function(e){
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
            url:"{{ route('postUser') }}",
            data: formData,
            processData: false,
            contentType: false,
            success:function(response){
                if(response.message != 'success'){
                    Swal.fire({
                        icon: 'error',
                        text: response.text,
                    })
                }else{
                    window.location.reload();
                }
                
            },
        });
    });

</script>