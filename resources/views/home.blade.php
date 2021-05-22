@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Blog Yönetim Paneli') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        {{ __('Başarıyla giriş yaptınız!') }}
                        <br>
                        Aşağıdaki link ile blogunuzu paylaşabilirsiniz. <br>
                        <a target="_blank" href="{{ url($username) }}">{{ url($username) }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
