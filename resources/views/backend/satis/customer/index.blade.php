@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Müşteriler</h3>
            </div>


            <div align="right" style="margin-top: 10px;">
                <a href="{{ route('excel.Download') }}" style="text-decoration: none;">
                    <button class="btn btn-success" style="padding: 8px 15px; border-radius: 5px;">
                        <i class="fa fa-file-excel-o" style="margin-right: 5px;"></i> Rapor İndir
                    </button>
                </a>
                <a href="{{route('customer.Import')}}" style="text-decoration: none; ">
                    <button class="btn btn-success" style="padding: 8px 15px; border-radius: 5px;">
                        <i class="fa fa-file-excel-o" style="margin-right: 5px;"></i> Tablo Yükle
                    </button>
                </a>
                <a href="{{ url('/storage/files/kullanici-ekleme.xlsx')  }}"
                   style="text-decoration: none; margin-right: 190px;">
                    <button class="btn btn-success" style="padding: 8px 15px; border-radius: 5px;">
                        <i class="fa fa-file-excel-o" style="margin-right: 5px;"></i> Şablon İndir
                    </button>
                </a>
                <a href="{{ route('customer.All') }}" style="text-decoration: none;">
                    <button class="btn btn-light" style="padding: 8px 15px; border-radius: 5px;">Tümü</button>
                </a>
                <a href="{{ route('customer.New') }}" style="text-decoration: none;">
                    <button class="btn btn-light" style="padding: 8px 15px; border-radius: 5px;">Yeni</button>
                </a>
                <a href="{{ route('customer.Acceptance') }}" style="text-decoration: none;">
                    <button class="btn btn-primary" style="padding: 8px 15px; border-radius: 5px;">Satış</button>
                </a>
                <a href="{{ route('customer.Rejection') }}" style="text-decoration: none;">
                    <button class="btn btn-danger" style="padding: 8px 15px; border-radius: 5px;">Reddedilen</button>
                </a>
                <a href="{{ route('customer.Appointment') }}" style="text-decoration: none;">
                    <button class="btn btn-warning" style="padding: 8px 15px; border-radius: 5px;">Randevu</button>
                </a>
                <a href="{{route('customer.Create')}}" style="text-decoration: none; margin-right: 11px;">
                    <button class="btn btn-info" style="padding: 8px 15px; border-radius: 5px;">Yeni Müşteri Ekle
                    </button>
                </a>
            </div>


            <div class="box-body">
                <form>
                    <div id="box">
                        <i class="fa fa-search"></i>
                        <input type="text" id="search" class="search" placeholder="Ara..">
                    </div>
                </form>

                <!--sayfalama stil kodları-->
                <style>
                    .page-size-container {
                        display: flex;
                        align-items: center;
                        font-family: Arial, sans-serif;
                    }

                    .custom-select {
                        position: relative;
                        cursor: pointer;
                        user-select: none;
                    }

                    #selected-size {
                        padding: 8px;
                        font-size: 10px;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        background-color: #f1f1f1;
                        color: #555;
                        margin-right: 5px;
                    }

                    .options {
                        position: absolute;
                        top: 100%;
                        left: 0;
                        display: none;
                        margin: 0;
                        padding: 0;
                        list-style: none;
                        background-color: #fff;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        z-index: 1;
                    }

                    .options li {
                        padding: 8px;
                        font-size: 14px;
                        cursor: pointer;
                    }

                    .options li.selected {
                        background-color: #ccc; /* Bu rengi istediğiniz vurgu rengine değiştirin */
                        color: #555;
                    }

                    .options li:hover {
                        background-color: #f1f1f1;
                    }

                    .custom-select:hover .options {
                        display: block;
                    }
                    .label-color{
                        background-color: #6c71c4;
                        color: #fff;
                    }
                </style>

                <div class="page-size-container" style="margin-top: 10px;">
                    <label for="page-size">Satır Sayısı :</label>
                    <div class="custom-select">
                        <span id="selected-size">{{ $data['customer']->perPage() }}</span>
                        <ul class="options">
                            <li onclick="changePageSize(15)"
                                @if($data['customer']->perPage() == 15) class="selected" @endif>15
                            </li>
                            <li onclick="changePageSize(25)"
                                @if($data['customer']->perPage() == 25) class="selected" @endif>25
                            </li>
                            <li onclick="changePageSize(50)"
                                @if($data['customer']->perPage() == 50) class="selected" @endif>50
                            </li>
                            <li onclick="changePageSize(100)"
                                @if($data['customer']->perPage() == 100) class="selected" @endif>100
                            </li>
                        </ul>
                    </div>
                </div>


                <table class="table table-hover" id="paginationNumber" style="margin-top: 10px;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Eklendiği Tarih</th>
                        <th>Müşteri Adı</th>
                        <th>İl</th>
                        <th>Durumu</th>
                        <th>Müşteri Email</th>
                        <th>Müşteri Telefon</th>
                        <th>Notlar</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <!--
                    1-Yeni kullanıcı
                    2-Kabul edildi
                    3-reddedildi
                    4- randevu verildi
                    -->
                    @php
                        $sayi = ($data['customer']->currentPage() - 1) * $data['customer']->perPage() + 1;
                        $totalCustomers = $data['customer']->total();
                    @endphp

                    @php $sayi = 1; @endphp

                    @foreach($data['customer'] as $customer)

                        @php
                            $userId = auth()->user()->id;
                            $addedById = $customer->added_by_user_id;
                            $modalId = 'exampleModal_' . $customer->id;
                        @endphp

                        @if( Auth::user()->role == 'admin' || $userId == $addedById )
                            <tr @if($customer->customer_status == 1) style = "background-color: #C0C0C0"
                                @elseif($customer->customer_status == 2) style = "background-color: #39FF14"
                                @elseif($customer->customer_status == 3) style = "background-color: #FF2400"
                                @elseif($customer->customer_status == 4) style = "background-color: #FDFD96"
                                @endif>
                                <td>{{ ($data['customer']->currentPage() - 1) * $data['customer']->perPage() + $loop->iteration }}</td>
                                <td>{{ $customer->created_at->format('d.m.Y') }}</td>
                                <td>{{ $customer->customer_name }}</td>
                                <td>{{ $customer->customer_city }}</td>
                                <td>
                                    <form method="POST" action="{{ route('customer.Condition', ['id' => $customer->id]) }}">
                                        @csrf
                                        <button type="submit" style="border: none; background: none;">
                                            <span class="label label-color">
                                                @if( $customer->customer_condition == 1 )
                                                    Potansiyel
                                                @elseif( $customer->customer_condition ==2 )
                                                    Gerçek
                                                @endif
                                            </span>
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $customer->customer_mail }}</td>
                                <td>+90 {{ $customer->customer_phone }}</td>
                                <td>
                                    <!--not al bölümü-->
                                    <button type="button" class="btn btn-default fa fa-comment" data-toggle="modal"
                                            data-target="{{ $modalId }}"></button>
                                    <form action="{{ route('not.Post') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="customer_id" value="{{ $customer->id }}">


                                        <div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" align="center" id="exampleModalLabel">
                                                            <strong>Arama Notları</strong>
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        @if( isset($call) )
                                                            @php $arama=1; @endphp
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Tarih</th>
                                                                    <th scope="col">Açıklama</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($call as $cal)
                                                                    <tr>
                                                                        <th scope="row">{{$arama++}}</th>
                                                                        <td>{{$cal->updated_at->timezone('Europe/Istanbul')->format('[d/m/Y] H.i.s')}}</td>
                                                                        <td>{{$cal->call_explanation}}</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        @endif

                                                        <textarea name="call_explanation" id="call_explanation"
                                                                  cols="73"
                                                                  rows="1"></textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Kapat
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">Kaydet</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>

                                <td style="padding-right: 4px;">
                                    <a href="{{ route('customer.Edit',['id' => $customer->id]) }}">
                                        <button type="button" class="btn btn-info btn-xs"><span
                                                class="glyphicon glyphicon-pencil "></span></button>
                                    </a>
                                </td>

                                <td style="padding-left: 1px;">
                                    <button type="button" class="btn btn-danger btn-xs" id="delete_buton"
                                            onclick="confirmDelete('{{ route('customer.Delete',['id' => $customer->id]) }}')">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                <!-- Sayfalama bağlantıları -->
                {{ $data['customer']->links() }}
                <p>Total Müşteri Sayısı: {{ $totalCustomers ?? 0 }}</p>
            </div>
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
                customClass: {
                    popup: 'custom-popup-class',
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Puf! Veriler silindi!",
                        text: "Silme işlemi gerçekleştirilecek.",
                        icon: "success"
                    }).then(() => {
                        window.location.href = deleteUrl;
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


    <script>
        function changePageSize(size) {
            window.location.href = updateQueryStringParameter(window.location.href, 'page_size', size);
        }

        function updateQueryStringParameter(uri, key, value) {
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) {
                return uri.replace(re, '$1' + key + "=" + value + '$2');
            } else {
                return uri + separator + key + "=" + value;
            }
        }
    </script>


    <script>
        var $rows = $('#paginationNumber tr');
        $('#search').keyup(function () {
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

            $rows.show().filter(function () {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        });
    </script>

@endsection
@section('css')@endsection
@section('js')@endsection
