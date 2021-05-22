@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Bloglar') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('blog.create') }}" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Blog Ekle</a>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Blog Başlık</th>
                                <th scope="col">Blog Kategori</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <td>{{$blog->name ?? ''}}</td>
                                    <td>{{$blog->category->category_name ?? ''}}</td>
                                    <td>

                                        <form action="{{ route('blog.destroy',$blog->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button style="float:right;margin-left: 10px" type="submit" class="btn btn-danger">Sil</button>

                                        </form>

                                        <a style="float:right" href="{{'blog/'. $blog->id .'/edit'}}"><button type="" class="btn btn-secondary">Düzenle</button></a>
                                        <a style="float:right; margin-right: 10px" href="{{'blog/'. $blog->id }}"><button type="" class="btn btn-primary">Görüntüle</button></a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
