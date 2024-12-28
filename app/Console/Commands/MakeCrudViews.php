<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeCrudViews extends Command
{
    protected $signature = 'make:crud-views {module} {--transaction}';
    protected $description = 'Create CRUD views for a specified module';

    public function handle()
    {
        $module = $this->argument('module');
        $isTransaction = $this->option('transaction');

        $views = [
            'index.blade.php' => $this->getIndexView($module),
            'create.blade.php' => $this->getCreateView($module),
            'show.blade.php' => $this->getShowView($module),
        ];

        // Add edit view only if it's not a transaction
        if (!$isTransaction) {
            $views['edit.blade.php'] = $this->getEditView($module);
        }

        $path = resource_path("views/master/{$module}");

        // Create the directory if it doesn't exist
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        foreach ($views as $fileName => $content) {
            File::put($path . '/' . $fileName, $content);
            $this->info("$fileName created successfully in $module.");
        }
    }

    protected function getIndexView($module)
    {
        return <<<blade
@extends('layouts.app')

@section('title', 'Daftar $module')

@section('page_title', 'Daftar $module')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar $module</h3>
                <div class="card-tools">
                    <a href="{{ route('$module.create') }}" class="btn btn-primary">Tambah $module</a>
                </div>
            </div>
            <div class="card-body">
                <p>Konten untuk daftar $module akan ditampilkan di sini.</p>
            </div>
        </div>
    </div>
</div>
@endsection
blade;
    }

    protected function getCreateView($module)
    {
        return <<<blade
@extends('layouts.app')

@section('title', 'Tambah $module')

@section('page_title', 'Tambah $module')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah $module</h3>
            </div>
            <div class="card-body">
                <p>Form untuk menambahkan $module akan ditampilkan di sini.</p>
            </div>
        </div>
    </div>
</div>
@endsection
blade;
    }

    protected function getEditView($module)
    {
        return <<<blade
@extends('layouts.app')

@section('title', 'Edit $module')

@section('page_title', 'Edit $module')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit $module</h3>
            </div>
            <div class="card-body">
                <p>Form untuk mengedit $module akan ditampilkan di sini.</p>
            </div>
        </div>
    </div>
</div>
@endsection
blade;
    }

    protected function getShowView($module)
    {
        return <<<blade
@extends('layouts.app')

@section('title', 'Detail $module')

@section('page_title', 'Detail $module')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail $module</h3>
            </div>
            <div class="card-body">
                <p>Detail untuk $module akan ditampilkan di sini.</p>
            </div>
        </div>
    </div>
</div>
@endsection
blade;
    }
}
