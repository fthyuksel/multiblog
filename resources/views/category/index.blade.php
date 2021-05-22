@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Kategoriler') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('category.create') }}" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Kategori Ekle</a>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Kategori Adı</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->category_name}}</td>
                                    <td>

                                        <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button style="float:right;margin-left: 10px" type="submit" class="btn btn-danger">Sil</button>

                                        </form>

                                        <a style="float:right" href="{{'category/'. $category->id .'/edit'}}"><button type="" class="btn btn-secondary">Düzenle</button></a>

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
