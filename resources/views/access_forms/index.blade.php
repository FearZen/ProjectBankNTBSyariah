<!DOCTYPE html>
<html>
<head>
    <title>Access Forms</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 30px;
        }

        h1 {
            color: #343a40;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        table {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background-color: #007bff;
            color: #fff;
            font-weight: 500;
        }

        td {
            vertical-align: middle;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        .img-thumbnail {
            max-width: 100px;
            cursor: pointer;
            border-radius: 5px;
            transition: transform 0.2s;
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
        }

        .image-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .image-popup img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 5px;
        }

        .image-popup .close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2em;
            color: #fff;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            h1 {
                font-size: 1.25rem;
            }

            table {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Access Forms</h1>
    @if (session('success'))
    <div class="success-message">{{ session('success') }}</div>
    @endif
    <table class="table table-striped">
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
                    <img src="{{ Storage::url($form->photo) }}" alt="Photo" class="img-thumbnail" onclick="openPopup('{{ Storage::url($form->photo) }}')">
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="popup" class="image-popup">
    <span class="close" onclick="closePopup()">&times;</span>
    <img id="popup-img" src="" alt="Photo">
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function openPopup(src) {
        document.getElementById('popup-img').src = src;
        document.getElementById('popup').style.display = 'flex';
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }

    document.getElementById('popup').addEventListener('click', function(event) {
        if (event.target === this) {
            closePopup();
        }
    });
</script>
</body>
</html>
