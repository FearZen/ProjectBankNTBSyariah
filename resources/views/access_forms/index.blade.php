@extends('layouts.app')

@section('title', 'Data Formulir')

@section('content')
<div class="container-fluid">
    <!-- Table Start -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Formulir</h3>
            <a href="{{ url('export') }}" class="btn btn-success float-right">Download Excel</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Pemohon</th>
                            <th class="text-center">Nama Perusahaan</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Nomor Telepon</th>
                            <th class="text-center">Nomor Ponsel</th>
                            <th class="text-center">Alamat E-Mail</th>
                            <th class="text-center">Tanggal Permohonan</th>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Negara</th>
                            <th class="text-center">Data Center</th>
                            <th class="text-center">Alamat Pusat Data</th>
                            <th class="text-center">Periode Kunjungan Dari (Tanggal)</th>
                            <th class="text-center">Periode Kunjungan Dari (Waktu)</th>
                            <th class="text-center">Periode Kunjungan Sampai (Tanggal)</th>
                            <th class="text-center">Periode Kunjungan Sampai (Waktu)</th>
                            <th class="text-center">Tujuan Kunjungan</th>
                            <th class="text-center">Izin Bekerja?</th>
                            <th class="text-center">Rack ID</th>
                            <th class="text-center">Detail Pengunjung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($forms as $index => $form)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $form->requestor_name }}</td>
                            <td>{{ $form->company_name }}</td>
                            <td>{{ $form->address }}</td>
                            <td>{{ $form->phone_number }}</td>
                            <td>{{ $form->mobile_number }}</td>
                            <td>{{ $form->email }}</td>
                            <td>{{ $form->date_of_request }}</td>
                            <td>
                                @if ($form->photo)
                                    <img src="data:image/jpeg;base64,{{ $form->photo }}" alt="Photo" class="img-thumbnail" style="max-width: 100px; cursor: pointer;" onclick="openPopup('data:image/jpeg;base64,{{ $form->photo }}')">
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

<!-- Modal for Visitor Details -->
<div id="visitorDetailsModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Visitor Details</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Jenis Pengunjung</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Nama Perusahaan</th>
                    <th class="text-center">Nomor Identitas</th>
                    <th class="text-center">Nomor Telepon</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Nomor Kendaraan</th>
                </tr>
            </thead>
            <tbody id="visitor-details-body">
                <!-- Visitor details will be appended here by JavaScript -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for Image Popup -->
<div id="imageModal" class="modal">
    <span class="close" onclick="closeImageModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

@endsection

@section('styles')
<style>
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1050;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* Responsive layout for the modal image */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }

    /* Centering text in the header */
    .table th {
        text-align: center;
        vertical-align: middle;
    }
</style>
@endsection

@section('scripts')
<script>
    function openPopup(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');

        modal.style.display = 'block';
        modalImg.src = imageSrc;
    }

    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.style.display = 'none';
    }

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

    // Tutup modal saat klik di luar konten modal
    window.onclick = function(event) {
        const imageModal = document.getElementById('imageModal');
        const visitorDetailsModal = document.getElementById('visitorDetailsModal');

        if (event.target == imageModal) {
            closeImageModal();
        }

        if (event.target == visitorDetailsModal) {
            closeModal();
        }
    }
</script>
@endsection
