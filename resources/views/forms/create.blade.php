@extends('layouts.app') <!-- Ganti dengan path ke layout dashboard Anda -->

@section('title', 'Isi Formulir')

@section('content')
<style>
    .is-invalid {
        border-color: #dc3545;
    }

    .is-invalid:focus {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    #capture-photo:hover {
        background-color: #085d3a!important;
        border-color: #085d3a!important;
    }

    .btn-primary:hover {
        background-color: #085d3a!important;
        border-color: #085d3a!important;
    }

    .camera-preview-container {
    display: flex;
    align-items: center; /* Menjaga elemen sejajar secara vertikal */
    justify-content: space-around; /* Menjaga elemen berada di tengah horizontal */
    margin-top: 20px;
    margin-bottom: 20px;
    gap: 15px; /* Jarak antar elemen */
    position: relative;
}

#camera-video, #photo-preview {
    width: 40%; /* Lebar sedikit lebih kecil dari sebelumnya */
    height: auto;
    border: 4px solid #0B6E45; /* Border hijau */
    border-radius: 12px; /* Sudut border melengkung */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Bayangan lebih jelas */
    padding: 4px; /* Ruang di dalam border */
    background-color: #f8f9fa; /* Latar belakang terang */
    box-sizing: border-box; /* Memastikan padding dan border tidak memperbesar ukuran */
}

#capture-photo {
    background-color: #0B6E45; /* Warna tombol */
    border: 2px solid #085d3a; /* Warna border tombol */
    color: white;
    font-weight: bold;
    border-radius: 8px; /* Sudut tombol melengkung */
    padding: 8px 20px; /* Ruang dalam tombol */
    cursor: pointer; /* Tangan pointer pada hover */
    transition: background-color 0.3s, border-color 0.3s; /* Transisi lembut */
    position: absolute; /* Posisi absolut untuk mengatur letak tombol */
    bottom: 20px; /* Jarak dari bawah kontainer */
    left: 50%; /* Posisi tengah secara horizontal */
    transform: translateX(-50%); /* Pindahkan tombol ke kiri sebanyak setengah dari lebar tombol untuk memposisikan di tengah */
    z-index: 10; /* Menempatkan tombol di atas elemen lain */
}

#capture-photo:hover {
    background-color: #085d3a; /* Warna tombol saat hover */
    border-color: #085d3a; /* Warna border tombol saat hover */
}

#photo-preview {
    display: none; /* Tidak menampilkan preview foto secara default */
}

    .form-group label {
        font-weight: bold;
    }

    .btn-link {
        color: #0B6E45;
        text-decoration: none;
    }

    .btn-link:hover {
        color: #085d3a;
        text-decoration: underline;
    }

    .btn-secondary, .btn-primary {
        background-color: #0B6E45;
        border-color: #0B6E45;
        color: white;
    }

    .btn-secondary:hover, .btn-primary:hover {
        background-color: #085d3a!important;
        border-color: #085d3a!important;
    }
</style>
<div class="container-fluid">
    <!-- Formulir Start -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Silahkan Isi Formulir Di bawah</h3>
        </div>
        <div class="card-body">
            <form id="access-form" action="{{ route('access_forms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Section 1 -->
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
                        <a href="{{ route('companies.create') }}" class="btn btn-link">Tambah Perusahaan Baru</a>
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
                    <button type="button" class="btn btn-primary" data-next-section="1">Next</button>
                </div>

                <!-- Section 2 -->
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
                        <label for="visit_purpose">Tujuan Kunjungan (Purpose of Visit):</label>
                        <input type="text" class="form-control" name="visit_purpose" id="visit_purpose" required>
                    </div>
                    <div class="form-group">
                        <label for="permit_to_work">Pilihan Yes/No:</label>
                        <select class="form-control" name="permit_to_work" id="permit_to_work" required>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rack_id">Rack ID dari Rack yang akan diakses (termasuk ID Ruangan dan/atau ID Cage) (Rack ID of Rack to access to (include Room ID and / or Cage ID)):</label>
                        <input type="text" class="form-control" name="rack_id" id="rack_id" required>
                    </div>
                    <div class="form-group">
                        <label for="photo">Upload Foto/KTP:</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    </div>
                    <div class="camera-preview-container">
                        <video id="camera-video" autoplay></video>
                        <img id="photo-preview" src="#" alt="Photo Preview" class="img-fluid">
                        <button type="button" id="capture-photo" class="btn btn-primary">Ambil Foto</button>
                    </div>
                    <button type="button" class="btn btn-secondary" data-prev-section="1">Back</button>
                    <button type="button" class="btn btn-primary" data-next-section="2">Next</button>
                </div>

                <!-- Section 3 -->
                <div id="section3" style="display: none;">
                    <h4>Detail Pengunjung | Visitor Details</h4>
                    <div class="form-group">
                        <label for="visitor_count">Jumlah Pengunjung (Number of Visitors):</label>
                        <input type="number" class="form-control" name="number_of_visitors" id="visitor_count" min="1">
                    </div>
                    <div id="visitor-details-container"></div>
                    <button type="button" class="btn btn-secondary" data-prev-section="2">Back</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add JavaScript for Section Navigation and Validation -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const video = document.getElementById('camera-video');
        const photoPreview = document.getElementById('photo-preview');
        const captureButton = document.getElementById('capture-photo');
        const photoInput = document.getElementById('photo');

        // Access the camera and start video stream
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                video.srcObject = stream;
                video.play();
            })
            .catch(function(err) {
                console.error("Error accessing the camera: ", err);
            });

        // Capture photo and display preview
        captureButton.addEventListener('click', function() {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Show the photo preview
            photoPreview.src = canvas.toDataURL('image/png');
            photoPreview.style.display = 'block';

            // Convert photo to file and set it to file input
            canvas.toBlob(function(blob) {
                const file = new File([blob], "captured_photo.png", { type: 'image/png' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                photoInput.files = dataTransfer.files;
            });
        });

        function showSection(sectionNumber) {
            const sections = [document.getElementById('section1'), document.getElementById('section2'), document.getElementById('section3')];
            sections.forEach((section, index) => {
                section.style.display = index === sectionNumber - 1 ? 'block' : 'none';
            });
        }

        function validateSection(section) {
            const inputs = section.querySelectorAll('input[required], select[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            return isValid;
        }

        function handleNextSection(currentSectionNumber) {
            const currentSection = document.getElementById('section' + currentSectionNumber);

            if (validateSection(currentSection)) {
                showSection(currentSectionNumber + 1);
            } else {
                alert('Please fill in all required fields in the current section.');
            }
        }

        document.querySelectorAll('button[data-next-section]').forEach(button => {
            button.addEventListener('click', function () {
                const currentSectionNumber = parseInt(this.getAttribute('data-next-section'), 10);
                handleNextSection(currentSectionNumber);
            });
        });

        document.querySelectorAll('button[data-prev-section]').forEach(button => {
            button.addEventListener('click', function () {
                const currentSectionNumber = parseInt(this.getAttribute('data-prev-section'), 10);
                showSection(currentSectionNumber);
            });
        });

        showSection(1);
    });
</script>
@endsection
