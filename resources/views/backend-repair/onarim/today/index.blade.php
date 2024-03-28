@extends('backend-repair.layout')

@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <strong><h3 class="box-title">Bugün Aranacak Müşteriler</h3></strong>
            </div>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tarih</th>
                    <th>Müşteri adı</th>
                    <th>Telefon No.</th>
                    <th>Seçimler</th>
                </tr>
                </thead>
                <tbody>
                @if ( $repairCustomers->isEmpty() )
                    <tr>
                        <td colspan="7">Bugün aranacak müşteri bulunamadı.</td>
                    </tr>
                @else

                    @foreach( $repairCustomers as $key => $repairCustomer )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                {{ isset($repairCustomer->repair_customer_date) ? \Carbon\Carbon::parse($repairCustomer->repair_customer_date)->format('d.m.Y') : 'Belirtilmemiş' }}
                            </td>
                            <td>{{ $repairCustomer->repair_customer_name }}</td>
                            <td>
                                +90 {{ isset($repairCustomer -> repair_customer_phone) ? $repairCustomer -> repair_customer_phone : 'Belirtilmemiş' }}
                            </td>
                            <td>
                                @foreach( $repairCustomer->repair_types as $repair_type )
                                    <span
                                        class=" label label-primary">{{ config('variables.customer.types')[$repair_type->type] }}</span>
                                @endforeach
                            </td>
                            <td width="5"><a href="{{ route('onarim.repair.Edit',$repairCustomer->id) }}"><i
                                        class="glyphicon glyphicon-pencil"></i></a></td>
                            <td width="5">
                                <a href="#"
                                   onclick="confirmDelete('{{ route('onarim.repair.Delete',['id' => $repairCustomer->id]) }}')">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
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
