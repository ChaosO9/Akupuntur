@extends('layouts.admin')

@section('title', 'Data Pasien')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
        </div>
        <div class="card-body">
            {{-- <div class="row">
                <div class="col">
                    <a href="{{ route('wisata.tambah') }}" class="btn btn-primary mb-3">+ Tambah Wisata</a>
                </div>
                <div>
                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}
            <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pasien</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Tanggal Lahir</th>
                            <th>Pekerjaan</th>
                            <th>Nomor Telepon</th>
                            <th>Melakukan Pengobatan?</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        {{-- //Search

                        if(isset($post['Search'])){
                            $keywords = $
                        } --}}
                        @foreach ($pasien as $row)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->gender }}</td>
                                <td>{{ $row->tanggal_lahir }}</td>
                                <td>{{ $row->pekerjaan }}</td>
                                <td>{{ $row->nomor_telepon }}</td>
                                <td>{{ $row->sedang_melakukan_pengobatan === 1 ? 'Melakukan Pengobatan' : 'Tidak Melakukan Pengobatan' }}
                                </td>
                                <td>
                                    {{-- <a href="{{ route('wisata.edit', $row->id) }}" class="btn btn-warning"
                                        style="color: rgb(255, 255, 255)"> <i class="fas fa-edit"></i></a>
                                    <a href="{{ route('wisata.gambar', $row->id) }}" class="btn btn-secondary"> <i
                                            class="fa-regular fa-image"></i></i></a> --}}
                                    <a href="{{ route('admin.data.pasien.hapus', $row->id) }}" class="btn btn-danger"> <i
                                            class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    {{-- datatables --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>

    <script>
        $('#example').DataTable();
    </script>
    {{-- end datatables --}}
@endsection
