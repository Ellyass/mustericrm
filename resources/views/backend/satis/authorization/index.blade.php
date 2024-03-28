@extends('backend.layout')

@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Yetkilendirme</h3>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Görsel</th>
                    <th>Ad Soyad</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            @if($user->user_file)
                                <img width="70"  src="/storage/images/users/{{ $user['user_file'] }}" alt="">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>
                            <a href="{{ route('authorization.Edit',$user->id) }}" class="btn btn-primary">Düzenle</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection

@section( 'css' )@endsection
@section( 'js' )@endsection
