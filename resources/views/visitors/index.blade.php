@extends('layouts.app')

@section('title', 'Daftar Pengunjung')

@section('content')
<div class="container">
    <h1>Daftar Pengunjung</h1>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Pencarian -->
    <form method="GET" action="{{ route('visitors.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari pengunjung..." value="{{ request('search') }}">
            <div class="input-group-append">
            <button class="btn btn-primary" type="submit" style="background-color: #0B6E45; border-color: #0B6E45;">Cari</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Perusahaan</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Nomor Kendaraan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($visitors as $visitor)
                <tr>
                    <td>{{ $visitor->visitor_name }}</td>
                    <td>{{ $visitor->visitor_company_name }}</td>
                    <td>{{ $visitor->visitor_email }}</td>
                    <td>{{ $visitor->visitor_phone_number }}</td>
                    <td>{{ $visitor->vehicle_number }}</td>
                    <td>
                        <a href="{{ route('visitors.edit', $visitor) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('visitors.destroy', $visitor) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengunjung ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $visitors->links() }}
</div>
@endsection
