@extends('layouts.dashboard.app')

@section('title', 'List Fitur')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-modal">
                    <i class="fas fa-plus"></i> Tambah Fitur
                </button>
            </div>
            <div class="card-body">
                @php
                    $columns = array(
                        [
                            'name'  => 'name',
                            'data'  => 'name',
                            'title' => 'Fitur',
                        ],
                        [
                            'name'  => 'description',
                            'data'  => 'description',
                            'title' => 'Deskripsi',
                        ]
                    );
                    $action_for_selecteds = array(
                        [
                            'name'  => 'Delete Pemanently',
                            'value' => 'delete'
                        ],
                    );
                @endphp

                <x-data-table :ajaxUrl="route('admin.fitur.data-table')" :columns="$columns" :actions="$action_for_selecteds"/>
            </div>
        </div>
    </div>
</div>
@endsection
@push('modal')
    <!-- Modal -->
    <x-form-modal name="form" :route="route('admin.fitur.store')" title="Tambah Fitur">
        <div class="form-group">
            <label>Fitur</label>
            <input type="text" name="name" placeholder="Masukkan name paket" class="form-control" required>
            <div class="invalid-feedback">
                Wajib diisi !!
            </div>
        </div>
        <div class="form-group">
            <label>Icon</label>
            <input type="text" name="icon" placeholder="Masukkan icon" class="form-control" required>
            <div class="invalid-feedback">
                Wajib diisi !!
            </div>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" style="min-height:100px" placeholder="Masukkan deskripsi" class="form-control" required></textarea>
            <div class="invalid-feedback">
                Wajib diisi !!
            </div>
        </div>
    </x-form-modal>
@endpush
