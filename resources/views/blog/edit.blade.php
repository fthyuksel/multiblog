@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Blog Ekle') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{route('blog.update',$blog->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Blog Başlık</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Blog Başlık" value="{{$blog->name}}">
                                    @error('name')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Slug</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="slug" name="slug" value="{{$blog->slug}}">
                                    @error('slug')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="category_id" name="category_id">
                                        @foreach($category as $key => $cat)

                                            <option {{$blog->category->id == $key ? 'selected' : ''}} value="{{$key}}">{{$cat}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Blog İçeriği</label>
                                <div class="col-sm-10">
                                    <textarea rows="6" type="text" class="form-control" id="content" name="content" placeholder="Blog İçeriği">{{$blog->content}}</textarea>
                                    @error('content')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </div>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#name').change(function (e) {
            $.get('{{route('checkSlug')}}',
                {'name': $(this).val() },
                function ( data ) {
                    $('#slug').val(data.slug);
                }
            );
        });
    </script>
@endsection
