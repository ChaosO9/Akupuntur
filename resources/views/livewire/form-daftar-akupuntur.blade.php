<div>
    <section id="appointment" class="appointment section">

        <!-- Section Title -->
        <div class="container section-title" {{ $kartu_pasien === '' ? 'data-aos="fade-up"' : '' }}>
            <h2>Jadwalkan Sesi Akupuntur</h2>
            <p>Belum pernah mendaftar? Silahkan mendaftar terlebih dahulu <a class="link-opacity-100"
                    href="#registration">di sini</a></p>
        </div><!-- End Section Title -->

        @if (session('error_cari_user'))
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <div class="alert alert-danger">
                            {{ session('error_cari_user') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (session('sukses_cari_user'))
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <div class="alert alert-info">
                            {{ session('sukses_cari_user') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="container" {{ $kartu_pasien === '' ? 'data-aos="fade-up" data-aos-delay="100"' : '' }}>
            <form action="forms/appointment.php" method="post" role="form" class="php-email-form">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <div class="container"></div>
                        <div class="row g-1">
                            <div class="col-md-8">
                                <input wire:model='kartu_pasien' type="text" name="nomor-kartu pasien"
                                    class="form-control ml-2" id="nomor-kartu-pasien" placeholder="Nomor Kartu Pasien"
                                    required="" {{ $modeButton === 'Cek Pasien' ? '' : 'disabled' }}>
                            </div>
                            <div wire:click='{{ $modeButton === 'Cek Pasien' ? 'getPasien' : 'gantiPasien' }}'
                                class=" col-md-4 text-center col-auto"><button type="button"
                                    class="btn btn-primary">{{ $modeButton }}</button></div>
                        </div>
                    </div>
                    {{-- <div class="col-md-2 form-group">
                        <div class="text-center"><button type="button" class="btn btn-primary">Cek
                                Pasien</button></div>
                    </div> --}}
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <input type="text" class="form-control" name="nama-pasien" id="nama-pasien"
                            placeholder="Nama Anda" required="" value="{{ $nama }}"
                            @if ($nama === '') {{ 'disabled' }} @endif>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <input type="tel" class="form-control" name="nomor-hp" id="nomor-hp"
                            placeholder="Nomor HP Anda" required="" value="{{ $nomor_telepon }}"
                            @if ($nomor_telepon === '') {{ 'disabled' }} @endif>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-3 form-group mt-3">
                        <select type="time" name="gender-pasien" class="form-select" id="gender-pasien"
                            placeholder="Appointment Hour" required=""
                            @if ($gender === '') {{ 'disabled' }} @endif>
                            <option
                                @empty($gender)
                                {{ 'selected' }}
                            @endempty>
                                Gender Anda</option>
                            <option value="Pria" @if (!is_null($gender) && $gender === 'Pria') {{ 'selected' }} @endif>Pria
                            </option>
                            <option value="Wanita" @if (!is_null($gender) && $gender === 'Wanita') {{ 'selected' }} @endif>Wanita
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group mt-3">
                        <input type="text" name="pekerjaan-pasien" class="form-control" id="pekerjaan-pasien"
                            placeholder="Pekerjaan Anda" required="" value="{{ $pekerjaan }}"
                            @if ($pekerjaan === '') {{ 'disabled' }} @endif>
                    </div>
                    <div class="col-md-3 form-group mt-3">
                        <div class="container"></div>
                        <div class="row g-1 align-items-center">
                            <div class=" col-md-4 text-center align-text-bottom">
                                Tanggal Lahir
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="tanggal-lahir-pasien" class="form-control datepicker2"
                                    id="tanggal-lahir-pasien" required="" value="{{ $tanggal_lahir }}"
                                    @if ($tanggal_lahir === '') {{ 'disabled' }} @endif>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 form-group mt-3">
                        <select name="status-pengobatan-pasien" id="status-pengobatan-pasien" class="form-select"
                            required="" @if ($sedang_melakukan_pengobatan === '') {{ 'disabled' }} @endif>
                            <option @if ($sedang_melakukan_pengobatan === '') {{ 'selected' }} @endif>
                                Melakukan Pengobatan/Tidak ?</option>
                            <option value=true @if ($sedang_melakukan_pengobatan === 1) {{ 'selected' }} @endif>
                                Melakukan
                                Pengobatan</option>
                            <option value=false @if ($sedang_melakukan_pengobatan === 0) {{ 'selected' }} @endif>
                                Tidak
                                Melakukan Pengobatan</option>
                        </select>
                    </div>
                </div>
                <hr class="hr hr-blurry" />
                <div class="row">
                    <div class="col-md-6 form-group mt-3">
                        <div class="container"></div>
                        <div class="row g-1 align-items-center">
                            <div class=" col-md-2 text-center align-text-bottom">
                                Tanggal Akupuntur
                            </div>
                            <div class="col-md-10">
                                <input wire:model.live="tanggal_akupuntur" wire:change="updateJamLayananTersedia"
                                    type="date" name="tanggal-akupuntur-pasien" class="form-control"
                                    id="tanggal-akupuntur-pasien" required="" value="{{ $tanggal_akupuntur }}"
                                    @if ($modeButton === 'Cek Pasien') {{ 'disabled' }} @endif>
                            </div>
                            @php
                                $disableWaktuLayanan = false;
                            @endphp
                            @if ($modeButton === 'Ganti Pasien')
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
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 form-group mt-3">
                        <select wire:model.live="jam_pelayanan_tersedia" name="jam-akupuntur-pasien"
                            id="jam-akupuntur-pasien" class="form-select" required=""
                            @if (
                                $modeButton === 'Cek Pasien' ||
                                    $tanggal_akupuntur === null ||
                                    $today->gt(\Carbon\Carbon::parse($tanggal_akupuntur))) {{ 'disabled' }} @endif>
                            <option disabled selected value="">Pilih Jam Pelayanan</option>
                            @if ($tanggal_akupuntur !== null)
                                @foreach ($jam_pelayanan_tersedia as $jam_pelayanan)
                                    <option value="{{ $jam_pelayanan }}">{{ $jam_pelayanan }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <textarea class="form-control" name="keluhan" id="keluhan" rows="5" placeholder="Keluhan (Opsional)"
                        @if ($modeButton === 'Cek Pasien') {{ 'disabled' }} @endif></textarea>
                </div>
                <div class="mt-3">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
                    <div class="text-center"><button type="submit"
                            {{ $modeButton === 'Cek Pasien' || $disableWaktuLayanan ? 'disabled' : '' }}>Reservasi
                            Tanggal</button></div>
                </div>
            </form>

        </div>

    </section>
</div>

{{-- @script
    <script>
        document.addEventListener('livewire:load', function() {
            $('.datepicker2').on('changeDate', function(e) {
                let formattedDate = new Date(e.date).toLocaleDateString("en-US", {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit'
                });

                console.log(formattedDate);
                window.livewire.emit('updateJamLayananTersedia2', formattedDate);
            });
        });
    </script>
@endscript --}}
