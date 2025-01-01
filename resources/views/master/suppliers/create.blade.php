@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Tambah Pemasok Baru</h1>

        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="form-group col-md-12">
                <label for="name">Nama Pemasok</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama pemasok"
                    value="{{ old('name') }}" required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone">No. Telp</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan no. telp"
                        value="{{ old('phone') }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email"
                        value="{{ old('email') }}">
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="address">Alamat</label>
                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat pemasok"
                    required>{{ old('address') }}</textarea>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success px-5">Simpan</button>
            </div>
        </form>
    </div>
@endsection
