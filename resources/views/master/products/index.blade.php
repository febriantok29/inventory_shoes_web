@extends('layouts.app')

@section('title', 'Daftar products')

@section('page_title', 'Daftar products')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar products</h3>
                <div class="card-tools">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah products</a>
                </div>
            </div>
            <div class="card-body">
                <p>Konten untuk daftar products akan ditampilkan di sini.</p>
            </div>
        </div>
    </div>
</div>
@endsection