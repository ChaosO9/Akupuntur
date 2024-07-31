<form action="{{ route('admin.jadwal.akupuntur.edit.simpan', ['id' => $jadwal->id]) }}" method="post"
    enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Jadwal Akupuntur Pasien
                        {{ $jadwal->nama }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col form-group">
                            <label for="id_pasien">ID Pasien</label>
                            <input type="text" class="form-control" disabled id="id_pasien" name="id_pasien"
                                placeholder="" required value="{{ $jadwal->nomor_kartu_pasien }}">
                        </div>
                        <div class="col form-group">
                            <label for="nama_pasien">Nama</label>
                            <input type="text" class="form-control" disabled id="nama_pasien" name="nama_pasien"
                                placeholder="Masukkan alamat" required value="{{ $nama }}">
                        </div>
                        <div class="col form-group">
                            <label for="gender_pasien">Gender</label>
                            <input type="text" class="form-control" disabled id="gender_pasien" name="gender_pasien"
                                placeholder="Masukkan alamat" required value="{{ $gender }}">
                        </div>
                        <div class="col form-group">
                            <label for="telepon_pasien">Nomor Telepon</label>
                            <input type="tel" class="form-control" disabled id="telepon_pasien"
                                name="telepon_pasien" placeholder="Masukkan alamat" required
                                value="{{ $jadwal->nomor_telepon }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="tanggal_akupuntur">Tanggal Terapi</label>
                            <input type="date" wire:model.live="tanggal_akupuntur"
                                wire:change="updateJamLayananTersedia" class="form-control" id="tanggal_akupuntur"
                                name="tanggal_akupuntur" placeholder="" required
                                value="{{ $jadwal->tanggal_melakukan_terapi }}">
                            @php
                                $today = \Carbon\Carbon::now()->startOfDay();
                                $selectedDate = \Carbon\Carbon::parse($tanggal_akupuntur);
                            @endphp
                            @if ($today->gt(\Carbon\Carbon::parse($tanggal_akupuntur)))
                                @php
                                    $disableWaktuLayanan = true;
                                @endphp
                                <span class="text-danger">Tanggal yang anda masukkan sudah lewat</span>
                            @endif
                        </div>

                        <div class="col form-group">
                            <label for="jam_akupuntur_pasien">Jadwal Akupuntur</label>
                            <select class="form-control" @if ($disableWaktuLayanan) {{ 'disabled' }} @endif
                                id="jam_akupuntur_pasien" name="jam_akupuntur_pasien"
                                @if ($tanggal_akupuntur === null || $today->gt(\Carbon\Carbon::parse($tanggal_akupuntur))) {{ 'disabled' }} @endif required>
                                @foreach ($jamLayananTersedia as $jam_pelayanan)
                                    <option value="{{ $jam_pelayanan }}"
                                        @if ($jadwal->jam_pelayanan === $jam_pelayanan) {{ 'selected' }} @endif>
                                        {{ $jam_pelayanan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col form-group">
                            <label for="status_jadwal">Status Jadwal</label>
                            <select class="form-control" id="status_jadwal" name="status_jadwal"
                                aria-label="Default select example">
                                <option value="Belum Dilayani" @if ($jadwal->status === 'Belum Dilayani') selected @endif>Belum
                                    Dilayani</option>
                                <option value="Selesai" @if ($jadwal->status === 'Selesai') selected @endif>Selesai
                                </option>
                                <option value="Reschedule" @if ($jadwal->status === 'Reschedule') selected @endif>Reschedule
                                </option>
                                <option value="Batal" @if ($jadwal->status === 'Batal') selected @endif>Batal</option>
                            </select>
                        </div>
                        {{-- {{ dd($jamLayananTersedia) }} --}}
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="keluhan">Keluhan</label>
                            <textarea type="text" class="form-control" id="keluhan" name="keluhan"
                                placeholder="Masukkan keluhan yang pasien alami" required>{{ $jadwal->keluhan }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary"
                            @if ($disableWaktuLayanan === true) disabled @endif>Simpan</button>
                    </div>
                </div>
            </div>
        </div>
</form>
