@extends('layouts.dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Peminjaman</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Peminjaman</h3>
                <div class="card-tools">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah
                        Peminjaman</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Buku</th>
                            <th>Nama Customer</th>
                            <th>Lama Pinjam (Hari)</th>
                            <th>Tanggal Pinjam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->buku->judul }}</td>
                                <td>{{ $item->customer->nama }}</td>
                                <td>{{ $item->lama_pinjam }}</td>
                                <td>{{ $item->tgl_pinjam }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="editPeminjaman({{ $item->id }})">Edit</button>
                                    <button class="btn btn-danger btn-sm"
                                        onclick="deletePeminjaman({{ $item->id }})">Hapus</button>
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
                    <h5 class="modal-title" id="createModalLabel">Tambah Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="createForm" method="POST" action="{{ route('peminjaman.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="buku_id">Nama Buku</label>
                            <select name="buku_id" id="buku_id" class="form-control" required>
                                <option selected disabled>Pilih Buku</option>
                                @foreach ($buku as $item)
                                    <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="customer_id">Nama Customer</label>
                            <select name="customer_id" id="customer_id" class="form-control" required>
                                <option selected disabled>Pilih Customer</option>
                                @foreach ($customer as $item)
                                    <option value="{{ $item->number }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="lama_pinjam">Lama Pinjam (Hari)</label>
                            <input type="number" name="lama_pinjam" id="lama_pinjam" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tgl_pinjam">Tanggal Pinjam</label>
                            <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" required>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_buku_id">Nama Buku</label>
                            <select name="buku_id" id="edit_buku_id" class="form-control" required>
                                <option selected disabled>Pilih Buku</option>
                                @foreach ($buku as $item)
                                    <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_customer_id">Nama Customer</label>
                            <select name="customer_id" id="edit_customer_id" class="form-control" required>
                                <option selected disabled>Pilih Customer</option>
                                @foreach ($customer as $item)
                                    <option value="{{ $item->number }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_lama_pinjam">Lama Pinjam (Hari)</label>
                            <input type="number" name="lama_pinjam" id="edit_lama_pinjam" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="edit_tgl_pinjam">Tanggal Pinjam</label>
                            <input type="date" name="tgl_pinjam" id="edit_tgl_pinjam" class="form-control" required>
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
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data peminjaman ini?</p>
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
    function editPeminjaman(id) {
        $.ajax({
            url: '/admin/peminjaman/' + id + '/edit',
            method: 'GET',
            success: function(data) {
                $('#editForm').attr('action', '/admin/peminjaman/' + id);
                $('#edit_buku_id').val(data.buku_id);
                $('#edit_customer_id').val(data.customer_id);
                $('#edit_lama_pinjam').val(data.lama_pinjam);
                $('#edit_tgl_pinjam').val(data.tgl_pinjam);
                $('#editModal').modal('show');
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    function deletePeminjaman(id) {
        $('#deleteForm').attr('action', '/admin/peminjaman/' + id);
        $('#deleteModal').modal('show');
    }
</script>
