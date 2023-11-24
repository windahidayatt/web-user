<div class="modal fade" id="addTeamModal" tabindex="-1" aria-labelledby="addTeamlLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-form">
            <div class="modal-header">
                <h2 class="modal-title" id="addTeamlLabel">Tambah Pengguna</h2>
            </div>
            <form action="/team" method="post" id="form-add-team">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="name" placeholder="Tulis Team" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Anggota</label>
                                <select class="form-control" name="selected_users[]" multiple="multiple" id="selectUsers">
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
        $('#selectUsers').select2({
            placeholder: "Pilih Anggota",
            allowClear: true,
            width: '100%',
            closeOnSelect: false
        });
    });

    $("#form-add-team").submit(function(e){
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
            url:"{{ route('postTeam') }}",
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