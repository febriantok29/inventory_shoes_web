@extends('layouts.app')

@section('title', 'Edit Produk')

@section('page_title', 'Edit Produk')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Produk</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" id="product-form">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="code">Kode Produk</label>
                            <input type="text" class="form-control" id="code" name="code"
                                value="{{ old('code', $product->code) }}" required>
                            @error('code')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Nama Produk</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Detail Produk</label>
                            <table class="table table-bordered" id="details-table">
                                <thead>
                                    <tr>
                                        <th>Ukuran</th>
                                        <th>Warna</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th>Catatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $details = old('details', $details->toArray());
                                    @endphp

                                    @foreach ($details as $index => $detail)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="details[{{ $index }}][id]"
                                                    value="{{ $detail['id'] ?? '' }}">
                                                <input type="text" name="details[{{ $index }}][size]"
                                                    class="form-control"
                                                    value="{{ old("details.$index.size", $detail['size'] ?? '') }}"
                                                    required>
                                            </td>
                                            <td>
                                                <input type="text" name="details[{{ $index }}][color]"
                                                    class="form-control"
                                                    value="{{ old("details.$index.color", $detail['color'] ?? '') }}"
                                                    required>
                                            </td>
                                            <td>
                                                <input type="number" name="details[{{ $index }}][stock]"
                                                    class="form-control"
                                                    value="{{ old("details.$index.stock", $detail['stock'] ?? 0) }}"
                                                    required>
                                            </td>
                                            <td>
                                                <input type="number" name="details[{{ $index }}][price]"
                                                    class="form-control"
                                                    value="{{ old("details.$index.price", $detail['price'] ?? 0) }}"
                                                    required>
                                            </td>
                                            <td>
                                                <input type="text" name="details[{{ $index }}][note]"
                                                    class="form-control"
                                                    value="{{ old("details.$index.note", $detail['note'] ?? '') }}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-row">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-success btn-sm" id="add-row">
                                <i class="fas fa-plus"></i> Tambah Detail
                            </button>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let detailIndex = {{ count($details) }};

            document.getElementById('add-row').addEventListener('click', function() {
                const tableBody = document.querySelector('#details-table tbody');
                const newRow = `
                    <tr>
                        <td><input type="text" name="details[${detailIndex}][size]" class="form-control" required></td>
                        <td><input type="text" name="details[${detailIndex}][color]" class="form-control" required></td>
                        <td><input type="number" name="details[${detailIndex}][stock]" class="form-control" required></td>
                        <td><input type="number" name="details[${detailIndex}][price]" class="form-control" required></td>
                        <td><input type="text" name="details[${detailIndex}][note]" class="form-control"></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                <i class="fas fa-minus"></i>
                            </button>
                        </td>
                    </tr>`;
                tableBody.insertAdjacentHTML('beforeend', newRow);
                detailIndex++;
            });

            document.getElementById('details-table').addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-row') || event.target.closest('.remove-row')) {
                    const row = event.target.closest('tr');
                    row.remove();
                }
            });
        });
    </script>
@endsection