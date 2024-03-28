@extends('backend-repair.layout')
@section('content')
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Kullanıcılar</h3>
            </div>

            <div align="right" style="margin-right: 10px;">
                <a href="{{ route('onarim.user.Create') }}">
                    <button class="btn btn-success">Yeni Kullanıcı Ekle</button>
                </a>
            </div>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Görsel</th>
                    <th>Ad Soyad</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $data['user'] as $user)
                    <tr>
                        <td>
                            @if($user->user_file)
                                <img width="70" src="/storage/images/users/{{ $user['user_file'] }}" alt="">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td width="5"><a href="{{ route('onarim.user.Edit',$user->id) }}"><i
                                class="glyphicon glyphicon-pencil"></i></a>
                        </td>
                        <td width="5">
                            <a href="#"
                               onclick="confirmDelete('{{ route('onarim.user.Delete',['id' => $user->id]) }}')">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <script>
        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: "Emin misiniz?",
                text: "Bu işlem geri alınamaz!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Evet",
                cancelButtonText: "İptal Et",
                showCloseButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Puf! Veriler silindi!",
                        text: "Silme işlemi gerçekleştirilecek.",
                        icon: "success"
                    }).then(() => {
                        window.location.href = deleteUrl; // Silme işlemi gerçekleştiriliyor
                    });
                } else {
                    Swal.fire({
                        title: "Veriler güvende!",
                        text: "Silme işlemi iptal edildi.",
                        icon: "error"
                    });
                }
            });
        }
    </script>
@endsection
@section('css')@endsection
@section('js')@endsection
