@extends('layouts.dashboard.app')

@section('title', 'List Blog')

@section('content')
<input type="hidden" id="status" value="">
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a href="#" id="filter_active" data-filter="" class="nav-link active" onclick="filterDataTable(this)">Semua <span class="badge badge-white" id="all">0</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-filter="draft" onclick="filterDataTable(this)">Draft <span class="badge badge-primary" id="draft">0</span></a>
                    </li>
                    <li class="nav-item">
                        <a  href="#" class="nav-link" data-filter="published" onclick="filterDataTable(this)">Published <span class="badge badge-primary" id="published">0</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-filter="archived" onclick="filterDataTable(this)">Archived <span class="badge badge-primary" id="archived">0</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{route("admin.blog.create")}}" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i> Buat Blog Baru</a>
            </div>
            <div class="card-body">
                @php
                    $columns = array(
                        [
                            'data'  => 'title',
                            'name'  => 'title',
                            'title' => 'Judul',
                        ],
                        [
                            'data'  => 'author',
                            'name'  => 'admin.first_name',
                            'title' => 'Penulis',
                        ],
                        [
                            'data'  => 'created_at',
                            'name'  => 'created_at',
                            'title' => 'Tanggal dibuat',
                        ],
                        [
                            'data'  => 'updated_at',
                            'name'  => 'updated_at',
                            'title' => 'Tanggal diperbarui',
                        ],
                        [
                            'data'  => 'status',
                            'name'  => 'status',
                            'title' =>'Status'
                        ]
                    );
                    $action_for_selecteds = array(
                        [
                            'name'  => 'Ubah ke Draft',
                            'value' => 'draft'
                        ],
                        [
                            'name'  => 'Ubah ke Publish',
                            'value' => 'published'
                        ],
                        [
                            'name'  => 'Ubah ke Archive',
                            'value' => 'archived'
                        ],
                        [
                            'name'  => 'Hapus selamanya',
                            'value' => 'delete'
                        ]
                    );
                @endphp
                @push('javascript')
                    <script>
                        var status;
                        var dataFilter = function ( d ) {
                            d.status = status;
                        }
                    </script>
                @endpush
                <x-data-table :ajaxUrl="route('admin.blog.data-table')" :columns="$columns" :actions="$action_for_selecteds" :order="[4,'desc']"/>
            </div>
        </div>
    </div>
</div>
@endsection
