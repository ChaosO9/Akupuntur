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
                            <th>Status</th>
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
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->gender }}</td>
                                <td>{{ $row->nomor_telepon }}</td>
                                <td>{{ $row->tanggal_melakukan_terapi }}</td>
                                <td>{{ $row->jam_pelayanan }}</td>
                                <td>{{ $row->keluhan }}</td>
                                <td style="padding: 10px;">
                                    <span
                                        style="
                                        display: inline-block;
                                        padding: 5px;
                                        @switch($row->status)
                                            @case('Belum Dilayani')
                                                background-color: #FFD700; /* Gold */
                                                border-radius: 5px;
                                                @break

                                            @case('Selesai')
                                                background-color: #90EE90; /* Light Green */
                                                border-radius: 5px;
                                                @break

                                            @case('Reschedule')
                                                background-color: #DC143C; /* Coral */
                                                border-radius: 5px;
                                                color: white;
                                                @break

                                            @case('Batal')
                                                background-color: #F08080; /* Red */
                                                border-radius: 5px;
                                                color: white;
                                                @break

                                            @default
                                                background-color: #FFFFFF; /* White */
                                                border-radius: 0;
                                                @endswitch
                                    ">
                                        {{ $row->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.jadwal.akupuntur.edit', ['id' => $row->id]) }}"
                                        class="btn btn-warning" style="color: rgb(255, 255, 255)">
                                        <i class="fas fa-edit"></i></a>
                                    {{-- <a href="{{ route('wisata.gambar', $row->id) }}" class="btn btn-secondary"> <i
                                            class="fa-regular fa-image"></i></i></a> --}}
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus data ini?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apa Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{ route('admin.data.jadwal.akupuntur.hapus', $row->id) }}" class="btn btn-danger">Hapus</a>
                </div>
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
