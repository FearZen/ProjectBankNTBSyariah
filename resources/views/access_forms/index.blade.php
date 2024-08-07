@extends('layouts.app')

@section('title', 'Access Forms')

@section('content')
<div class="container-fluid">
    <!-- Table Start -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Access Forms</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Pemohon</th>
                            <th>Nama Perusahaan</th>
                            <th>Alamat</th>
                            <th>Nomor Telepon</th>
                            <th>Nomor Ponsel</th>
                            <th>Alamat E-Mail</th>
                            <th>Tanggal Permohonan</th>
                            <th>Foto</th>
                            <th>Negara</th>
                            <th>Data Center</th>
                            <th>Alamat Pusat Data</th>
                            <th>Periode Kunjungan Dari (Tanggal)</th>
                            <th>Periode Kunjungan Dari (Waktu)</th>
                            <th>Periode Kunjungan Sampai (Tanggal)</th>
                            <th>Periode Kunjungan Sampai (Waktu)</th>
                            <th>Tujuan Kunjungan</th>
                            <th>Izin Bekerja?</th>
                            <th>Rack ID</th>
                            <th>Detail Pengunjung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($forms as $form)
                        <tr>
                            <td>{{ $form->requestor_name }}</td>
                            <td>{{ $form->company_name }}</td>
                            <td>{{ $form->address }}</td>
                            <td>{{ $form->phone_number }}</td>
                            <td>{{ $form->mobile_number }}</td>
                            <td>{{ $form->email }}</td>
                            <td>{{ $form->date_of_request }}</td>
                            <td>
                                @if ($form->photo)
                                <img src="{{ asset('storage/' . $form->photo) }}" alt="Photo" class="img-thumbnail" style="max-width: 100px; cursor: pointer;" onclick="openPopup('{{ asset('storage/' . $form->photo) }}')">
                                @else
                                No photo
                                @endif
                            </td>
                            <td>{{ $form->country }}</td>
                            <td>{{ $form->data_center }}</td>
                            <td>{{ $form->data_center_address }}</td>
                            <td>{{ $form->visit_from_date }}</td>
                            <td>{{ $form->visit_from_time }}</td>
                            <td>{{ $form->visit_to_date }}</td>
                            <td>{{ $form->visit_to_time }}</td>
                            <td>{{ $form->visit_purpose }}</td>
                            <td>{{ $form->permit_to_work ? 'Yes' : 'No' }}</td>
                            <td>{{ $form->rack_id }}</td>
                            <td>
                                @if ($form->visitors->count() > 0)
                                <button type="button" class="btn btn-info" data-bs-toggle="collapse" data-bs-target="#visitor-details-{{ $form->id }}">Lihat Detail</button>
                                <div id="visitor-details-{{ $form->id }}" class="collapse mt-2">
                                    <div class="accordion" id="accordion-{{ $form->id }}">
                                        @foreach ($form->visitors as $visitor)
                                        <div class="card mb-2">
                                            <div class="card-header" id="heading-{{ $visitor->id }}">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $visitor->id }}" aria-expanded="true" aria-controls="collapse-{{ $visitor->id }}">
                                                        {{ $visitor->visitor_name }}
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapse-{{ $visitor->id }}" class="collapse" aria-labelledby="heading-{{ $visitor->id }}" data-bs-parent="#accordion-{{ $form->id }}">
                                                <div class="card-body">
                                                    <strong>Tipe Pengunjung:</strong> {{ $visitor->visitor_type }}<br>
                                                    <strong>Jabatan:</strong> {{ $visitor->visitor_designation }}<br>
                                                    <strong>Nama Perusahaan:</strong> {{ $visitor->visitor_company_name }}<br>
                                                    <strong>Nomor Identitas:</strong> {{ $visitor->identity_number }}<br>
                                                    <strong>Nomor Telepon:</strong> {{ $visitor->visitor_phone_number }}<br>
                                                    <strong>Email:</strong> {{ $visitor->visitor_email }}<br>
                                                    <strong>Nomor Kendaraan:</strong> {{ $visitor->vehicle_number }}
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @else
                                No visitors
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Table End -->
</div>

@section('scripts')
<script>
    function openPopup(src) {
        const popup = document.getElementById('popup');
        const popupImg = document.getElementById('popup-img');
        popupImg.src = src;
        popup.style.display = 'flex';
    }

    function closePopup() {
        const popup = document.getElementById('popup');
        popup.style.display = 'none';
    }
</script>
<div id="popup" class="image-popup" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); justify-content: center; align-items: center; z-index: 1000;">
    <span class="close" style="position: absolute; top: 20px; right: 20px; font-size: 2em; color: #fff; cursor: pointer;" onclick="closePopup()">&times;</span>
    <img id="popup-img" src="" alt="Popup Image" style="max-width: 90%; max-height: 90%; border-radius: 5px;">
</div>
@endsection
@endsection
