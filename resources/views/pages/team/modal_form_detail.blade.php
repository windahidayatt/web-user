<div class="modal fade" id="detailTeamModal" tabindex="-1" aria-labelledby="detailTeamModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-form">
            <div class="modal-header">
                <h2 class="modal-title" id="detailTeamModalLabel">Detail Team</h2>
            </div>
            <form action="#" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" id="detail_name" name="name" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Anggota</label>
                                <select class="form-control" name="selected_users[]" multiple="multiple" id="selectUsersDetail" readonly>
                                    @foreach ($list_users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary btn-short" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#selectUsersDetail').select2({
            placeholder: "Pilih Anggota",
            allowClear: true,
            width: '100%',
            closeOnSelect: false,
            disabled: true
        });
    });
</script>