@extends('backend.layout')

@section('content')

    <!--left section-->
    <section class="content-header col-lg-6">
        <div class="box box-danger">
            <!-- Calendar -->
            <div id="calendar"></div>
            <!-- /.box -->
        </div>
    </section>


    <style>
        #calendar {
            background-color: #f9f9f9; /* Hafif gri tonu */
            border-radius: 5px; /* Kenar yumuşatma */
            padding: 15px; /* İçerikten kenara biraz boşluk bırakma */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Hafif bir gölge efekti */
        }
    </style>

    <!--right section-->
    <section class="content-header col-lg-6">
        <div class="box box-info">
            <table class="table table-hover">
                <h4 style="text-align: center"><strong>Bugün Aranacak Müşteriler</strong></h4>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Randevu Tarihi</th>
                    <th>Müşteri Adı</th>
                    <th>Müşteri Numarası</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @php $arama=1; @endphp
                @if(isset($randevular) && $randevular->isNotEmpty())
                    @foreach($randevular as $randevu)
                        @if( Auth::user()->id == $randevu->added_by_user_id || Auth::user()->role=='admin')
                            <tr>
                                <td>{{ $arama++ }}</td>
                                <td>{{ \Carbon\Carbon::parse($randevu->customer_meet)->format('d.m.Y') }}</td>
                                <td>{{ $randevu->customer_name }}</td>
                                <td>+90 {{ $randevu->customer_phone }}</td>
                                <td width="5">
                                    <a href="{{ route('customer.Edit',['id' => $randevu->id]) }}">
                                        <i class="fa fa-share-square-o"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align: center"><strong>Randevu Bulunamadı.</strong></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="box box-warning">
            <table class="table table-hover">
                <h4 style="text-align: center"><strong>Aranacak Müşteriler</strong></h4>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Randevu Tarihi</th>
                    <th>Müşteri Adı</th>
                    <th>Müşteri Numarası</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @php $gecmisArama=1;@endphp
                @if(isset($gecmisRandevular) && $gecmisRandevular->isNotEmpty())
                    @foreach($gecmisRandevular as $gecmis)
                        @if( Auth::user()->id == $gecmis->added_by_user_id || Auth::user()->role=='admin' )
                            <tr>
                                <td>{{ $gecmisArama++ }}</td>
                                <td>{{ \Carbon\Carbon::parse($gecmis->customer_meet)->format('d.m.Y') }}</td>
                                <td>{{ $gecmis->customer_name }}</td>
                                <td>+90 {{ $gecmis->customer_phone }}</td>
                                <td width="5">
                                    <a href="{{ route('customer.Edit',['id' => $gecmis->id]) }}">
                                        <i class="fa fa-share-square-o"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align: center"><strong>Müşteri Bulunamadı</strong></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </section>


    <script>
        function showNotificationIfNeeded() {
            const notificationShown = sessionStorage.getItem('notificationShown');
            if (!notificationShown) {
                @if ($randevular->isNotEmpty())
                let randevuListesi = '<table class="custom-table">';
                randevuListesi += '<thead><tr><th>Randevu Tarihi</th><th>Müşteri Adı</th></tr></thead>';
                randevuListesi += '<tbody>';

                @foreach ($randevular as $randevu)
                    randevuListesi += '<tr>';
                randevuListesi += '<td>{{ \Carbon\Carbon::parse($randevu->customer_meet)->format('d.m.Y') }}</td>';
                randevuListesi += '<td>{{ $randevu->customer_name }}</td>';
                randevuListesi += '</tr>';
                @endforeach

                    randevuListesi += '</tbody></table>';

                Swal.fire({
                    title: 'Bugün Aranacak Müşteriler',
                    html: randevuListesi,
                    icon: 'info',
                    confirmButtonText: 'Tamam',
                    customClass: {
                        popup: 'custom-popup-class',
                        content: 'custom-content-class',
                    },
                });
                @endif

                // Bildirimi gösterildi olarak işaretle
                sessionStorage.setItem('notificationShown', 'true');
            }
        }

        window.onload = showNotificationIfNeeded;
    </script>
    <style>
        .custom-popup-class {
            width: 500px;
            height: auto;
        }

        .custom-content-class {
            padding: 20px;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .custom-table th, .custom-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

    </style>

    <!-- Takvim ayarları-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                contentHeight: "auto",
                locale: 'tr',
                firstDay: 1,
                buttonText: {
                    today: 'Bugün',
                    month: 'Ay',
                    day: 'Gün',
                },

                dateClick: function (info) {
                    var selectedDate = info.dateStr;
                    showUsersForDate(selectedDate);
                }
            });

            calendar.render();

            function showUsersForDate(date) {
                $.ajax({
                    url: '{{ route("get_customers_for_date") }}',
                    type: 'GET',
                    data: {date: date},
                    success: function (response) {
                        var customers = response;
                        var html = '<table class="table">';
                        if (customers.length > 0) {
                            html += '<thead><tr><th>İsim</th><th>Telefon</th></tr></thead>' +
                                '<tbody>';
                            customers.forEach(function (customer) {
                                html += '<tr><td>' + customer.customer_name + '</td><td>' + '+90 ' + customer.customer_phone + '</td></tr>';
                            });
                            html += '</tbody>';
                        } else {
                            html += '<tbody><tr><td colspan="2">Bu tarihe atanmış kullanıcı yok</td></tr></tbody>';
                        }
                        html += '</table>';
                        Swal.fire({
                            title: 'Kullanıcılar',
                            html: html,
                            icon: 'info',
                            customClass: 'swal-wide',
                            showCloseButton: true,
                        });
                    }
                });
            }

        });
    </script>

@endsection
@section('css')@endsection
@section('js')@endsection

