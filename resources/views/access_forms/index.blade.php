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
                                <button type="button" class="btn btn-info" onclick="showVisitorDetails({{ $form->id }})">Lihat Detail</button>
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

<!-- Modal -->
<div id="visitorDetailsModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Visitor Details</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jenis Pengunjung</th>
                    <th>Jabatan</th>
                    <th>Nama Perusahaan</th>
                    <th>Nomor Identitas</th>
                    <th>Nomor Telepon</th>
                    <th>Email</th>
                    <th>Nomor Kendaraan</th>
                </tr>
            </thead>
            <tbody id="visitor-details-body">
                <!-- Visitor details will be appended here by JavaScript -->
            </tbody>
        </table>
    </div>
</div>

@section('styles')
<style>
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto; /* 5% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
        max-height: 80vh; /* Limit height to 80% of viewport */
        overflow-y: auto; /* Enable vertical scrolling */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
@endsection

@section('scripts')
<script>
    function showVisitorDetails(formId) {
        const visitorDetailsBody = document.getElementById('visitor-details-body');
        visitorDetailsBody.innerHTML = '';

        fetch(`/forms/${formId}/visitors`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.visitors && data.visitors.length > 0) {
                    data.visitors.forEach(visitor => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${visitor.visitor_name}</td>
                            <td>${visitor.visitor_type}</td>
                            <td>${visitor.visitor_designation}</td>
                            <td>${visitor.visitor_company_name}</td>
                            <td>${visitor.identity_number}</td>
                            <td>${visitor.visitor_phone_number}</td>
                            <td>${visitor.visitor_email}</td>
                            <td>${visitor.vehicle_number}</td>
                        `;
                        visitorDetailsBody.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td colspan="8">No visitors found</td>`;
                    visitorDetailsBody.appendChild(row);
                }
                document.getElementById('visitorDetailsModal').style.display = 'block';
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                const row = document.createElement('tr');
                row.innerHTML = `<td colspan="8">Failed to load visitor details</td>`;
                visitorDetailsBody.appendChild(row);
                document.getElementById('visitorDetailsModal').style.display = 'block';
            });
    }

    function closeModal() {
        document.getElementById('visitorDetailsModal').style.display = 'none';
    }
</script>
@endsection
@endsection
