@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Supplier</h1>

        <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Nama Supplier</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $supplier->name) }}" placeholder="Masukkan nama supplier" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="code">Kode</label>
                    <input type="text" class="form-control" id="code" name="code"
                        value="{{ old('code', $supplier->code) }}" placeholder="Masukkan kode supplier" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="contact_number">No. Telp</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number"
                        value="{{ old('contact_number', $supplier->contact_number) }}" placeholder="Masukkan no. telp"
                        required>
                </div>
                <div class="form-group col-md-6">
                    <label for="code">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email"
                        value="{{ old('email', $supplier->email) }}">
                </div>
            </div>

            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat supplier"
                    required>{{ old('address', $supplier->address) }}</textarea>
            </div>

            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
    </div>
@endsection
