@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-success">

            <div class="box-header with-border">
                <h3 class="box-title">Satış Yapılan Müşteriler</h3>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Müşteri Adı</th>
                    <th>İl</th>
                    <th>Firma İsmi</th>
                    <th>Müşteri Email</th>
                    <th>Müşteri Telefon</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(isset($data['customer']) && $data['customer']->isNotEmpty())
                    @foreach($data['customer'] as $customer)
                        @php
                            $userId = auth()->user()->id;
                            $addedById = $customer->added_by_user_id;
                        @endphp
                        @if( $userId == $addedById || Auth::user()->role == 'admin' )
                            <tr>
                                <td>{{$customer->customer_name}}</td>
                                <td>{{$customer->customer_city}}</td>
                                <td>{{$customer->customer_company_name}}</td>
                                <td>{{$customer->customer_mail}}</td>
                                <td>+90 {{$customer->customer_phone}}</td>
                                <td width="5"><a href="{{route('customer.Edit',['id' => $customer->id])}}"><i
                                            class="fa fa-pencil-square"></i></a></td>
                                <td width="5">
                                    <a href="#"
                                       onclick="confirmDelete('{{ route('sales.Delete',['id' => $customer->id]) }}')">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif()
                    @endforeach
                @else
                    <tr>
                        <td colspan="5"><strong>Hiç Müşteri Bulunamadı.</strong></td>
                    </tr>
                @endif
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
                cancelButtonText: "İptal Et"
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
                        icon: "info"
                    });
                }
            });
        }
    </script>
@endsection
@section('css')@endsection
@section('js')@endsection
