@extends('layouts.dashboard.app')

@if ($edit)
    @section('title', 'Edit Blog')
@else
    @section('title', 'Buat Blog')
@endif

@section('content')
    <div class="row">
        <div class="col-12">
            <form @if ($edit) action="{{route("admin.blog.update", ['id' => $blog->id])}}" @else action="{{route("admin.blog.store")}}" @endif method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input id="title" class="form-control @error('title') is-invalid @enderror" name="title" @if($edit) value="{{$blog->title}}" @else value="{{ old('title') }}" @endif required autocomplete="title" autofocus>
                            <span class="invalid-feedback" role="alert">
                                <strong>@error('title') {{ $message }} @else jdudl wajib diisi !! @enderror</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Tags</label>
                            <input type="text" name="tags" class="form-control inputtags @error('tags') is-invalid @enderror" @if($edit) value="{{$blog->tags}}" @else value="{{old('tags')}}" @endif required>
                            <span class="invalid-feedback" role="alert">
                                <strong>@error('tags') {{ $message }} @else tags wajib diisi !! @enderror</strong>
                            </span>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea id="content" name="content" class="form-control summernote @error('content') is-invalid @enderror" name="title" required autofocus>@if($edit) {!!$blog->content!!} @else {{ old('content') }} @endif</textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>@error('content') {{ $message }} @else content wajib diisi !! @enderror</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail</label>
                                    <div class="custom-file">
                                        <input id="thumbnail" onchange="readURL(this)" class="custom-file-input @error('thumbnail') is-invalid @enderror" type="file" name="thumbnail" @if(!$edit) required @endif>
                                        <label for="thumbnail" class="custom-file-label">Browse....</label>
                                        <span class="invalid-feedback" role="alert">
                                            <strong>@error('thumbnail') {{ $message }} @else thumbnail wajib diisi !! @enderror</strong>
                                        </span>
                                    </div>
                                    <img class="img-thumbnail mt-2" @if ($edit) src="{{asset('/storage/upload/blog/'.$blog->thumbnail)}}" alt="{{$blog->slug}}" @else src="{{asset('/storage/upload/blog/default.jpg')}}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" class="form-control selectric @error('status') is-invalid @enderror" name="status" required autofocus>
                                        <option value="">--Pilih Status--</option>
                                        @php
                                            $status=null;
                                            if($edit){
                                                $status=$blog->status;
                                            }else{
                                                $status=old('status');
                                            }
                                        @endphp
                                        <option @if($status=="draft") selected @endif value="draft">Draft</option>
                                        <option @if($status=="published") selected @endif value="published">Publish</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>@error('status') {{ $message }} @else status wajib diisi !! @enderror</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke text-right">
                        <button class="btn btn-danger btn-lg" type="Reset">Reset</button>

                            <button class="btn btn-lg btn-primary" type="submit">
                                @if ($edit)
                                    Perbarui
                                @else
                                    Simpan
                                @endif
                            </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
