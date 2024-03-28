@extends('backend-repair.layout')

@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Müşteriler</h3>
            </div>

            <div align="right" style="margin-right: 10px;">
                <a href="{{ route('onarim.repair.Create') }}">
                    <button class="btn btn-success">Yeni Müşteri Ekle</button>
                </a>
            </div>


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
            </style>

            <div class="page-size-container" style="margin-top: 10px;">
                <label for="page-size">Satır Sayısı :</label>
                <div class="custom-select">
                    <span id="selected-size">{{ $repairCustomers->perPage() }}</span>
                    <ul class="options">
                        <li onclick="changePageSize(15)"
                            @if( $repairCustomers->perPage() == 15 ) class="selected" @endif>15
                        </li>
                        <li onclick="changePageSize(25)"
                            @if( $repairCustomers->perPage() == 25 ) class="selected" @endif>25
                        </li>
                        <li onclick="changePageSize(50)"
                            @if( $repairCustomers->perPage() == 50 ) class="selected" @endif>50
                        </li>
                        <li onclick="changePageSize(100)"
                            @if( $repairCustomers->perPage() == 100 ) class="selected" @endif>100
                        </li>
                    </ul>
                </div>
            </div>

            @php
                $sayi = ( $repairCustomers->currentPage() - 1 ) * $repairCustomers->perPage() + 1;
                $totalCustomers = $repairCustomers->total();
            @endphp

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tarih</th>
                    <th>Müşteri adı</th>
                    <th>Telefon No.</th>
                    <th>Yapılacak İşlem</th>
                    <th>İşlem Görecek Yer</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $repairCustomers as $key=> $repair)
                    <tr>
                        <td>{{ ($key+1) }}</td>
                        <td>
                            {{ isset($repair->repair_customer_date) ? \Carbon\Carbon::parse($repair->repair_customer_date)->format('d.m.Y') : 'Belirtilmemiş' }}
                        </td>
                        <td>{{ $repair->repair_customer_name }}</td>
                        <td>
                            +90 {{ isset($repair -> repair_customer_phone) ? $repair -> repair_customer_phone : 'Belirtilmemiş' }}
                        </td>

                        <td>
                            @foreach($repair->repair_types as $repair_type)
                                <span
                                    class=" label label-primary">{{ config('variables.customer.types')[$repair_type->type] }}</span>
                            @endforeach
                        </td>


                        <td>
                            @foreach($repair->repair_pieces as $repair_piece)
                                <span
                                    class=" label label-warning">{{ config('variables.customer.pieces')[$repair_piece->piece] }}</span>
                            @endforeach
                        </td>


                        <td width="5"><a href="{{ route('onarim.repair.Edit',$repair->id) }}"><i class="glyphicon glyphicon-pencil"></i></a></td>
                        <td width="5">
                            <a href="#"
                               onclick="confirmDelete('{{ route('onarim.repair.Delete',['id' => $repair->id]) }}')">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $repairCustomers->links() }}
            <p>Total Müşteri Sayısı: {{ $totalCustomers ?? 0 }}</p>
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

@endsection

@section('css')@endsection
@section('js')@endsection
