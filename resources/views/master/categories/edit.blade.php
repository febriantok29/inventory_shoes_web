@extends('layouts.app')

@section('title', 'Perbarui Katagori')

@section('page_title', 'Perbarui Katagori')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="code">SKU</label>
                                <input type="text" name="code" class="form-control" value="{{ $category->code }}"
                                    readonly>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="name">Katagori <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ $category->name }}"
                                    required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
