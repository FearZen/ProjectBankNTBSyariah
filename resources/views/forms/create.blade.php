@extends('layouts.app') <!-- Ganti dengan path ke layout dashboard Anda -->

@section('title', 'Isi Formulir')

@section('content')
<div class="container-fluid">
    <!-- Formulir Start -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Silahkan Isi Formulir Di bawah</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('access_forms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="section1">
                    <h4>Detail Kontak Pemohon | Requestor Contact Details</h4>
                    <div class="form-group">
                        <label for="requestor_name">Nama Pemohon (Requestor Name):</label>
                        <input type="text" class="form-control" name="requestor_name" id="requestor_name" required>
                    </div>
                    <div class="form-group">
    <label for="company_name">Nama Perusahaan Pemohon (Requestor's Company Name):</label>
    <input type="text" class="form-control" id="company_name" list="company_list" name="company_name" required>
    <datalist id="company_list">
        @foreach($companies as $company)
            <option value="{{ $company->name }}">{{ $company->name }}</option>
        @endforeach
    </datalist>
    <a href="{{ route('companies.create') }}" class="btn btn-link" style="color: #0B6E45; text-decoration: none;">Tambah Perusahaan Baru</a>
<style>
    .btn-link:hover {
        color: #085d3a; 
        text-decoration: underline; 
    }
</style>

</div>

                    <div class="form-group">
                        <label for="address">Alamat (Address):</label>
                        <input type="text" class="form-control" name="address" id="address" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Nomor Telepon (Phone Number):</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile_number">Nomor Ponsel (Mobile Phone Number):</label>
                        <input type="text" class="form-control" name="mobile_number" id="mobile_number" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Alamat E-Mail (Email Address):</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="date_of_request">Tanggal Permohonan (Date of Request):</label>
                        <input type="date" class="form-control" name="date_of_request" id="date_of_request" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="showSection(2)" style="background-color: #0B6E45; border-color: #0B6E45;">Next</button>

                </div>

                <div id="section2" style="display: none;">
                    <h4>Permintaan Akses Sementara | Temporary Access Request</h4>
                    <div class="form-group">
                        <label for="country">Negara (Country):</label>
                        <input type="text" class="form-control" name="country" id="country" required>
                    </div>
                    <div class="form-group">
                        <label for="data_center">Data Center:</label>
                        <input type="text" class="form-control" name="data_center" id="data_center" required>
                    </div>
                    <div class="form-group">
                        <label for="data_center_address">Alamat Pusat Data (Data Center Address):</label>
                        <input type="text" class="form-control" name="data_center_address" id="data_center_address" required>
                    </div>
                    <div class="form-group">
                        <label for="visit_from_date">Periode Kunjungan Dari (Tanggal) (Visit Period From Date):</label>
                        <input type="date" class="form-control" name="visit_from_date" id="visit_from_date" required>
                    </div>
                    <div class="form-group">
                        <label for="visit_from_time">Periode Kunjungan Dari (Waktu) (Visit Period From Time):</label>
                        <input type="time" class="form-control" name="visit_from_time" id="visit_from_time" required>
                    </div>
                    <div class="form-group">
                        <label for="visit_to_date">Periode Kunjungan Sampai (Tanggal) (Visit Period To Date):</label>
                        <input type="date" class="form-control" name="visit_to_date" id="visit_to_date" required>
                    </div>
                    <div class="form-group">
                        <label for="visit_to_time">Periode Kunjungan Sampai (Waktu) (Visit Period To Time):</label>
                        <input type="time" class="form-control" name="visit_to_time" id="visit_to_time" required>
                    </div>
                    <div class="form-group">
                        <label for="purpose_of_visit">Tujuan Kunjungan (Purpose of Visit):</label>
                        <input type="text" class="form-control" name="visit_purpose" id="visit_purpose" required>
                    </div>
                    <div class="form-group">
                        <label for="rack_id">Rack ID dari Rack yang akan diakses (termasuk ID Ruangan dan/atau ID Cage) (Rack ID of Rack to access to (include Room ID and / or Cage ID)):</label>
                        <input type="text" class="form-control" name="rack_id" id="rack_id" required>
                    </div>
                    <div class="form-group">
                        <label for="photo">Upload Foto/KTP:</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="camera-video">Camera:</label>
                        <video id="camera-video" width="100%" height="auto" autoplay></video>
                        <button type="button" id="capture-photo" class="btn btn-primary mt-2" style="background-color: #0B6E45; border-color: #0B6E45; color: white;">Ambil Foto</button>
<style>
    #capture-photo:hover {
        background-color: #085d3a!important; /* Warna lebih gelap saat hover */
        border-color: #085d3a!important; /* Warna border lebih gelap saat hover */
    }
</style>

                    </div>
                    <div class="form-group">
                        <label for="photo-preview">Preview Foto:</label>
                        <img id="photo-preview" src="#" alt="Photo Preview" class="img-fluid" style="display:none;">
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="showSection(1)" style="background-color: #0B6E45; border-color: #0B6E45; color: white;">Back</button>
<button type="button" class="btn btn-primary" onclick="showSection(3)" style="background-color: #0B6E45; border-color: #0B6E45; color: white;">Next</button>
<style>
    .btn-secondary:hover, .btn-primary:hover {
        background-color: #085d3a!important; /* Warna lebih gelap saat hover */
        border-color: #085d3a!important; /* Warna border lebih gelap saat hover */
    }
</style>

                </div>

                <div id="section3" style="display: none;">
                    <h4>Detail Pengunjung | Visitor Details</h4>
                    <div class="form-group">
                        <label for="visitor_count">Jumlah Pengunjung (Number of Visitors):</label>
                        <input type="number" class="form-control" name="number_of_visitors" id="visitor_count" min="1" required>
                    </div>
                    <div id="visitor-details-container"></div>
                    <button type="button" class="btn btn-secondary" onclick="showSection(2)">Back</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #0B6E45; border-color: #0B6E45; color: white;">Submit</button>
<style>
    .btn-primary:hover {
        background-color: #085d3a; /* Warna lebih gelap saat hover */
        border-color: #085d3a; /* Warna border lebih gelap saat hover */
    }
</style>

                </div>
            </form>
        </div>
    </div>
    <!-- Formulir End -->
</div>
@endsection

@section('scripts')
<script>
    function showSection(sectionNumber) {
        document.getElementById('section1').style.display = 'none';
        document.getElementById('section2').style.display = 'none';
        document.getElementById('section3').style.display = 'none';
        document.getElementById('section' + sectionNumber).style.display = 'block';
    }

    document.getElementById('visitor_count').addEventListener('change', function () {
        const visitorCount = this.value;
        const container = document.getElementById('visitor-details-container');
        container.innerHTML = '';

        for (let i = 1; i <= visitorCount; i++) {
            container.innerHTML += `
                <div class="form-group">
                    <label for="visitor_name_${i}">Nama Pengunjung ${i} (Visitor Name ${i}):</label>
                    <input type="text" class="form-control" name="visitor_name_${i}" id="visitor_name_${i}" required>
                </div>
                <div class="form-group">
                    <label for="visitor_type_${i}">Tipe Pengunjung ${i} (Visitor Type ${i}):</label>
                    <input type="text" class="form-control" name="visitor_type_${i}" id="visitor_type_${i}" required>
                </div>
                <div class="form-group">
                    <label for="visitor_designation_${i}">Jabatan Pengunjung ${i} (Visitor Designation ${i}):</label>
                    <input type="text" class="form-control" name="visitor_designation_${i}" id="visitor_designation_${i}" required>
                </div>
                <div class="form-group">
                    <label for="visitor_company_${i}">Nama Perusahaan Pengunjung ${i} (Visitor Company ${i}):</label>
                    <input type="text" class="form-control" name="visitor_company_${i}" id="visitor_company_${i}" required>
                </div>
                <div class="form-group">
                    <label for="visitor_id_${i}">Nomor Identitas Pemerintah atau Paspor (5 karakter terakhir) Pengunjung ${i} (Visitor Government ID/Passport ${i}):</label>
                    <input type="text" class="form-control" name="visitor_id_${i}" id="visitor_id_${i}" required>
                </div>
                <div class="form-group">
                    <label for="visitor_phone_${i}">Nomor Telepon Pengunjung ${i} (Visitor Phone ${i}):</label>
                    <input type="text" class="form-control" name="visitor_phone_${i}" id="visitor_phone_${i}" required>
                </div>
                <div class="form-group">
                    <label for="visitor_email_${i}">Alamat Email Pengunjung ${i} (Visitor Email ${i}):</label>
                    <input type="email" class="form-control" name="visitor_email_${i}" id="visitor_email_${i}" required>
                </div>
                <div class="form-group">
                    <label for="visitor_vehicle_${i}">Nomor Kendaraan Pengunjung ${i} (Visitor Vehicle ${i}):</label>
                    <input type="text" class="form-control" name="visitor_vehicle_${i}" id="visitor_vehicle_${i}">
                </div>
            `;
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const fileInputContainer = document.querySelector('.file-input-container');
        const cameraContainer = document.querySelector('.camera-container');
        const cameraVideo = document.getElementById('camera-video');
        const capturePhotoButton = document.getElementById('capture-photo');
        const photoInput = document.getElementById('photo');
        const photoPreview = document.getElementById('photo-preview');

        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    cameraVideo.srcObject = stream;
                    cameraContainer.style.display = 'block';
                })
                .catch(function (error) {
                    console.error('Error accessing the camera:', error);
                });
        } else {
            console.error('Camera not supported');
        }

        photoInput.addEventListener('change', function () {
            if (photoInput.files.length > 0) {
                const file = photoInput.files[0];
                photoPreview.src = URL.createObjectURL(file);
                photoPreview.style.display = 'block';
            }
        });

        capturePhotoButton.addEventListener('click', function () {
            const canvas = document.createElement('canvas');
            canvas.width = cameraVideo.videoWidth;
            canvas.height = cameraVideo.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(cameraVideo, 0, 0, canvas.width, canvas.height);

            canvas.toBlob(function (blob) {
                const file = new File([blob], 'photo.jpg', { type: 'image/jpeg' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                photoInput.files = dataTransfer.files;

                const previewUrl = URL.createObjectURL(blob);
                photoPreview.src = previewUrl;
                photoPreview.style.display = 'block';
                console.log('Photo captured and added to file input');
            }, 'image/jpeg');
        });
    });
</script>
@endsection
