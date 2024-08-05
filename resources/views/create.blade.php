<!DOCTYPE html>
<html>
<head>
    <title>Create Access Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #343a40;
            margin-bottom: 30px;
            font-weight: 500;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
            color: #495057;
        }

        input[type="text"], input[type="email"], input[type="date"], input[type="time"], input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button[type="submit"], button[type="button"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 20px auto 0;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover, button[type="button"]:hover {
            background-color: #0056b3;
        }

        .camera-container, .file-input-container {
            margin-top: 20px;
        }

        .preview-container {
            margin-top: 20px;
            text-align: center;
        }

        .preview-container img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            form {
                padding: 15px;
            }

            button[type="submit"], button[type="button"] {
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
    <h1>Create Access Form</h1>
    <form action="{{ route('access_forms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="requestor_name">Nama Pemohon (Requestor name):</label>
            <input type="text" name="requestor_name" id="requestor_name" required>
        </div>
        <div class="form-group">
            <label for="company_name">Nama Perusahaan Pemohon (Requestor's Company name):</label>
            <input type="text" name="company_name" id="company_name" required>
        </div>
        <div class="form-group">
            <label for="address">Alamat (Address):</label>
            <input type="text" name="address" id="address" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Nomor Telepon (Phone number):</label>
            <input type="text" name="phone_number" id="phone_number" required>
        </div>
        <div class="form-group">
            <label for="mobile_number">Nomor Ponsel (Mobile Phone number):</label>
            <input type="text" name="mobile_number" id="mobile_number" required>
        </div>
        <div class="form-group">
            <label for="email">Alamat E-Mail (Email address):</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="date_of_request">Tanggal Permohonan (Date of request):</label>
            <input type="date" name="date_of_request" id="date_of_request" required>
        </div>
        <div class="form-group">
            <label for="country">Negara (Country):</label>
            <input type="text" name="country" id="country" required>
        </div>
        <div class="form-group">
            <label for="data_center">Data Center:</label>
            <input type="text" name="data_center" id="data_center" required>
        </div>
        <div class="form-group">
            <label for="data_center_address">Alamat Pusat Data (Data Center Address):</label>
            <input type="text" name="data_center_address" id="data_center_address" required>
        </div>
        <div class="form-group">
            <label for="visit_from_date">Periode Kunjungan Dari (Tanggal) (Visit Period From Date):</label>
            <input type="date" name="visit_from_date" id="visit_from_date" required>
        </div>
        <div class="form-group">
            <label for="visit_from_time">Periode Kunjungan Dari (Waktu) (Visit Period From Time):</label>
            <input type="time" name="visit_from_time" id="visit_from_time" required>
        </div>
        <div class="form-group">
            <label for="visit_to_date">Periode Kunjungan Sampai (Tanggal) (Visit Period To Date):</label>
            <input type="date" name="visit_to_date" id="visit_to_date" required>
        </div>
        <div class="form-group">
            <label for="visit_to_time">Periode Kunjungan Sampai (Waktu) (Visit Period To Time):</label>
            <input type="time" name="visit_to_time" id="visit_to_time" required>
        </div>
        <div class="form-group">
            <label for="visit_purpose">Tujuan Kunjungan (Purpose of Visit):</label>
            <input type="text" name="visit_purpose" id="visit_purpose" required>
        </div>
        <div class="form-group file-input-container">
            <label for="photo">Upload Foto/KTP:</label>
            <input type="file" id="photo" name="photo" accept="image/*" />
        </div>

        <div class="camera-container">
            <video id="camera-video" width="100%" height="auto" autoplay></video>
            <button type="button" id="capture-photo">Ambil Foto</button>
        </div>

        <div class="preview-container">
            <h2>Preview Foto:</h2>
            <img id="photo-preview" src="" alt="Preview Foto" />
        </div>
        
        <button type="submit">Submit</button>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInputContainer = document.querySelector('.file-input-container');
        const cameraContainer = document.querySelector('.camera-container');
        const cameraVideo = document.getElementById('camera-video');
        const capturePhotoButton = document.getElementById('capture-photo');
        const photoInput = document.getElementById('photo');
        const photoPreview = document.getElementById('photo-preview');

        // Cek apakah kamera didukung dan aktifkan kamera
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    cameraVideo.srcObject = stream;
                    cameraContainer.style.display = 'block';
                })
                .catch(function (error) {
                    console.error('Error accessing the camera:', error);
                });
        }

        // Toggle antara upload berkas dan kamera
        photoInput.addEventListener('change', function() {
            // Check if a file is selected
            if (photoInput.files.length > 0) {
                cameraContainer.style.display = 'block';
                photoPreview.src = URL.createObjectURL(photoInput.files[0]);
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

                // Set preview image source
                const previewUrl = URL.createObjectURL(blob);
                photoPreview.src = previewUrl;
                console.log('Photo captured and added to file input');
            }, 'image/jpeg');
        });
    });
    </script>
</body>
</html>
