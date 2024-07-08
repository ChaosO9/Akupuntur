@extends('layouts.admin')

@section('title', 'Data Jadwal Akupuntur')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Jadwal Akupuntur</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pasien</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Nomor Telepon</th>
                            <th>Tanggal Terapi</th>
                            <th>Jam Terapi</th>
                            <th>Keluhan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        {{-- //Search

                        if(isset($post['Search'])){
                            $keywords = $
                        } --}}
                        @foreach ($jadwal_akupuntur as $row)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $row->nomor_kartu_pasien }}</td>
                                <td>{{ $row->nama[0] }}</td>
                                <td>{{ $row->gender[0] }}</td>
                                <td>{{ $row->nomor_telepon[0] }}</td>
                                <td>{{ $row->tanggal_melakukan_terapi }}</td>
                                <td>{{ $row->jam_pelayanan }}</td>
                                <td>{{ $row->keluhan }}</td>
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
