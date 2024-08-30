@extends('layouts.app')

@section('title', 'Edit Pengunjung')

@section('content') 
<div class="container">
    <h1>Edit Pengunjung</h1>

    <form method="POST" action="{{ route('visitors.update', $visitor) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="visitor_name">Nama</label>
            <input type="text" name="visitor_name" id="visitor_name" class="form-control" value="{{ old('visitor_name', $visitor->visitor_name) }}" required>
        </div>

        <div class="form-group">
            <label for="visitor_company_name">Perusahaan</label>
            <input type="text" name="visitor_company_name" id="visitor_company_name" class="form-control" value="{{ old('visitor_company_name', $visitor->visitor_company_name) }}" required>
        </div>

        <div class="form-group">
            <label for="visitor_email">Email</label>
            <input type="email" name="visitor_email" id="visitor_email" class="form-control" value="{{ old('visitor_email', $visitor->visitor_email) }}" required>
        </div>

        <div class="form-group">
            <label for="visitor_phone_number">Telepon</label>
            <input type="text" name="visitor_phone_number" id="visitor_phone_number" class="form-control" value="{{ old('visitor_phone_number', $visitor->visitor_phone_number) }}">
        </div>

        <div class="form-group">
            <label for="vehicle_number">Nomor Kendaraan</label>
            <input type="text" name="vehicle_number" id="vehicle_number" class="form-control" value="{{ old('vehicle_number', $visitor->vehicle_number) }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    
</div>
@endsection
