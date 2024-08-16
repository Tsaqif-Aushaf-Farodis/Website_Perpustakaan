@extends('layouts.dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Pengembalian</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pengembalian</h3>
                <div class="card-tools">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah
                        Pengembalian</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Buku</th>
                            <th>Customer</th>
                            <th>Tanggal Kembali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengembalian as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->peminjaman->buku->judul }}</td>
                                <td>{{ $item->peminjaman->customer->nama }}</td>
                                <td>{{ $item->tgl_kembali }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="editPengembalian({{ $item->id }})">Edit</button>
                                    <button class="btn btn-danger btn-sm"
                                        onclick="deletePengembalian({{ $item->id }})">Hapus</button>
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
                    <h5 class="modal-title" id="createModalLabel">Tambah Pengembalian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="createForm" method="POST" action="{{ route('pengembalian.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="peminjaman_id">Peminjaman</label>
                            <select name="peminjaman_id" id="peminjaman_id" class="form-control" required>
                                <option selected disabled>Pilih Peminjaman</option>
                                @foreach ($peminjaman as $pinjam)
                                    <option value="{{ $pinjam->id }}">{{ $pinjam->buku->judul }} -
                                        {{ $pinjam->customer->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl_kembali">Tanggal Kembali</label>
                            <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" required>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Pengembalian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_peminjaman_id">Peminjaman</label>
                            <select name="peminjaman_id" id="edit_peminjaman_id" class="form-control" required>
                                @foreach ($peminjaman as $pinjam)
                                    <option value="{{ $pinjam->id }}">{{ $pinjam->buku->judul }} -
                                        {{ $pinjam->customer->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_tgl_kembali">Tanggal Kembali</label>
                            <input type="date" name="tgl_kembali" id="edit_tgl_kembali" class="form-control" required>
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

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Pengembalian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data pengembalian ini?</p>
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
    function editPengembalian(id) {
        $.get(`/admin/pengembalian/${id}/edit`, function(data) {
            $('#edit_peminjaman_id').val(data.pengembalian.peminjaman_id);
            $('#edit_tgl_kembali').val(data.pengembalian.tgl_kembali);
            $('#editForm').attr('action', `/admin/pengembalian/${id}`);
            $('#editModal').modal('show');
        });
    }

    function deletePengembalian(id) {
        $('#deleteForm').attr('action', '/admin/pengembalian/' + id);
        $('#deleteModal').modal('show');
    }
</script>
