@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-warning">

            <div class="box-header with-border">
                <h3 class="box-title"><strong>Randevular</strong></h3>
                <button type="button" id="getTodayAppointments" class="btn btn-warning fa fa-bell pull-right"
                        style="background-color: orange; width: 45px; height: 30px;"
                        data-toggle="modal" data-target="#exampleModal">
                </button>
                <hr>
                <form action="{{route('meet.Post')}}" method="post">
                    @csrf
                    <div style="margin-top: 10px">

                        <div id="customer_meet_id" class="form-group col-md-3 col-sm-3">
                            <label for="baslangic_tarihi">Başlangıç Tarihi</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" id="datepicker"
                                       name="baslangicTarihi">
                            </div>
                        </div>


                        <div id="customer_meet_id" class="form-group col-md-3 col-sm-3">
                            <label for="bitis_tarihi">Bitiş Tarihi</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" id="datepickerrr" name="bitisTarihi">
                            </div>
                        </div>


                        <div>
                            <button type="submit" class="btn btn-success" style="margin-top: 25px">
                                Getir
                            </button>
                        </div>
                    </div>
                </form>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" align="center" id="exampleModalLabel"><strong>Aranacak
                                        Müşteriler</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="customerCancelValue">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Müşteri adı</th>
                                            <th>Müşteri telefonu</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data['customers'] as $customer)
                                            <tr>
                                                <td>{{$customer->customer_name}}</td>
                                                <td>+90 {{$customer->customer_phone}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <table class="table table-hover" id="appointmentTable">
                <thead>
                <tr>
                    <th>Tarih</th>
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
                @if(isset($data['customers']) && $data['customers']->isNotEmpty())
                    @foreach($data['customers'] as $customer)
                        @php
                            $userId = auth()->user()->id;
                            $addedById = $customer->added_by_user_id;
                        @endphp
                        @if( $userId == $addedById || Auth::user()->role == 'admin' )
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($customer->customer_meet)->format('d.m.Y') }}</td>
                                <td>{{$customer->customer_name}}</td>
                                <td>{{$customer->customer_city}}</td>
                                <td>{{$customer->customer_company_name}}</td>
                                <td>{{$customer->customer_mail}}</td>
                                <td>+90 {{$customer->customer_phone}}</td>
                                <td width="5"><a href="{{route('customer.Edit',['id' => $customer->id])}}"><i
                                            class="fa fa-pencil-square"></i></a></td>
                                <td width="5">
                                    <a href="#"
                                       onclick="confirmDelete('{{ route('meet.Delete',['id' => $customer->id]) }}')">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif()
                    @endforeach
                @else
                    <tr>
                        <td colspan="5"><strong>Hiç Müşteri bulunamadı.</strong></td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{ $data['customers']->links() }}

        </div>
    </section>

    <style>
        .modal-content {
            width: 80%; /* Modal içeriğinin genişliğini isteğinize göre ayarlayın */
            margin: auto; /* Ortala */
        }

        .modal-header {
            background-color: #f4f0ec; /* Modal başlığı için arkaplan rengi */
            padding: 5px;
            text-align: center;
        }

        .modal-title {
            margin: 0;
        }

        .close {
            color: #000;
            font-size: 30px;
            font-weight: bold;
        }

        #customerCancelValue {
            margin-top: 5px;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .custom-table th, .custom-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
    </style>


    <!--Sweet Alert-->
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


    <!--Tarihler arasındaki değeler-->
    <script>
        $(function () {
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range as a button
            $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                }
            )

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                language: 'tr',
            })
            $('#datepickerrr').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                language: 'tr',
            })
        })
    </script>

@endsection
@section('css')@endsection
@section('js')@endsection
