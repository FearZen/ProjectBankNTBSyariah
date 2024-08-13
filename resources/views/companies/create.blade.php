@extends('layouts.app')

@section('title', 'Tambah Perusahaan')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Perusahaan Baru</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('companies.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Perusahaan:</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: #0B6E45; border-color: #0B6E45;">Tambah</button>

            </form>
        </div>
    </div>
</div>
<style>
    .btn-primary:hover {
        background-color: #085d3a; /* Warna lebih gelap saat hover */
        border-color: #085d3a;
    }
</style>
@endsection
