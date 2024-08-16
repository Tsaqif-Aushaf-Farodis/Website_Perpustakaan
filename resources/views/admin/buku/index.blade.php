@extends('layouts.dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Buku</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Buku</h3>
                <div class="card-tools">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah Buku</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Penerbit</th>
                            <th>Tanggal Terbit</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->penerbit }}</td>
                                <td>{{ $item->tgl_terbit }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="editBuku({{ $item->id }})">Edit</button>
                                    <button class="btn btn-danger btn-sm"
                                        onclick="deleteBuku({{ $item->id }})">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="createForm" method="POST" action="{{ route('buku.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="judul">Judul Buku</label>
                            <input type="text" name="judul" id="judul" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" name="penerbit" id="penerbit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tglterbit">Tanggal Terbit</label>
                            <input type="date" name="tgl_terbit" id="tgl_terbit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" name="stok" id="stok" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_judul">Judul Buku</label>
                            <input type="text" name="judul" id="edit_judul" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_penerbit">Penerbit</label>
                            <input type="text" name="penerbit" id="edit_penerbit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_tglterbit">Tanggal Terbit</label>
                            <input type="date" name="tgl_terbit" id="edit_tgl_terbit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_stok">Stok</label>
                            <input type="number" name="stok" id="edit_stok" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data buku ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    function editBuku(id) {
        $.ajax({
            url: '/admin/buku/' + id + '/edit',
            method: 'GET',
            success: function(data) {
                $('#editForm').attr('action', '/admin/buku/' + id);
                $('#edit_judul').val(data.judul);
                $('#edit_penerbit').val(data.penerbit);
                $('#edit_tgl_terbit').val(data.tglterbit);
                $('#edit_stok').val(data.stok);
                $('#editModal').modal('show');
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    function deleteBuku(id) {
        $('#deleteForm').attr('action', '/admin/buku/' + id);
        $('#deleteModal').modal('show');
    }
</script>
