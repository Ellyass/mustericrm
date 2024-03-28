@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-danger">

            <div class="box-header with-border">
                <h3 class="box-title">İptal Edilen Müşteriler</h3>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Müşteri Adı</th>
                    <th>İl</th>
                    <th>Firma İsmi</th>
                    <th>Müşteri Email</th>
                    <th>Müşteri Telefon</th>
                    <th>İptal Nedeni</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(isset($data['customers']) && $data['customers']->isNotEmpty())
                    @foreach($data['customers'] as $customer)
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
                                <td>
                                    <button type="button" class="btn btn-danger fa fa-question-circle"
                                            data-toggle="modal"
                                            data-target="#exampleModal{{$customer->id}}">

                                    </button>
                                    <input type="hidden" name="customer_id" value="{{$customer->id}}">

                                    <div class="modal fade" id="exampleModal{{$customer->id}}" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="exampleModalLabel{{$customer->id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" align="center"
                                                        id="exampleModalLabel{{$customer->id}}"><strong>İptal
                                                            Nedenleri</strong>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="customerCancelValue">
                                                        <ul>
                                                            @foreach(explode("\n", $customer->customer_cancel) as $reason)
                                                                <li>{{ $reason }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td width="5"><a href="{{route('customer.Edit',['id' => $customer->id])}}"><i
                                            class="fa fa-pencil-square"></i></a></td>
                                <td width="5">
                                    <a href="#"
                                       onclick="confirmDelete('{{ route('cancel.Delete',['id' => $customer->id]) }}')">
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

            <!-- Sayfalama bağlantıları -->
            {{ $data['customers']->onEachSide(1)->links() }}

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
