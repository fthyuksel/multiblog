@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Blog Görüntüle') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Blog Başlık</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="name" name="name" placeholder="Blog Başlık" value="{{$show->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Slug</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="slug" name="slug" value="{{$show->slug}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="category" name="category" value="{{$show->category->category_name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Blog İçeriği</label>
                                <div class="col-sm-10">
                                    <textarea readonly rows="6" type="text" class="form-control" id="content" name="content" placeholder="Blog İçeriği">{{$show->content}}</textarea>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <a href="{{ route('blog.index') }}"><button class="btn btn-secondary">Blog Listesine Dön</button></a>

                                </div>
                            </div>



                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
