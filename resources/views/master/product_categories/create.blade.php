@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Tambah Kategori Baru</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('product_categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Kategori</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Masukkan nama kategori" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="code">SKU</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Masukkan SKU"
                            required>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="description">Keterangan</label>
                    <textarea class="form-control" id="description" name="description" rows="3"
                        placeholder="Masukkan keterangan kategori (opsional)"></textarea>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('product_categories.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success px-5">Simpan</button>
            </div>
        </form>
    </div>
@endsection
