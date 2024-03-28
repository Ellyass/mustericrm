@extends('backend.layout')
@section('content')
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ürünler</h3>
            </div>

            <div align="right">
                <a href="{{route('product.Create')}}">
                    <button class="btn btn-success">Yeni Ürün Ekle</button>
                </a>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Ürün Resmi</th>
                    <th>Ürün Adı</th>
                    <th>Alış Fiyatı</th>
                    <th>Satış Fiyatı</th>
                    <th>2. Satış Fiyatı</th>
                    <th>Toplam</th>
                    <th>Kâr</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data['product'] as $product)
                    <tr>
                        <td>
                            @if($product['product_file'])
                                <img width="70" src="{{ asset('storage/images/products/' . $product['product_file']) }}"
                                     alt="">
                            @else
                                <img width="70" src="/storage/images/products/urunyok.jpeg" alt="">
                            @endif
                        </td>
                        <td>{{$product['product_name']}}</td>
                        <td>{{number_format($product['product_buy'],2,',','.').' ₺'}}</td>
                        <td>{{number_format($product['product_sell'],2,',','.').' ₺'}}</td>
                        @php
                            $product_point = $product['product_buy'] * 1;
                            if($product['product_second_sell']){
                                $product_earning = ($product['product_second_sell'] * 1) - $product_point;
                            }else{
                            $product_earning = ($product['product_sell'] * 1) - $product_point;
                        }
                        @endphp
                        <td>{{number_format($product->product_second_sell,2,',','.').' ₺'}}</td>
                        <td>{{number_format($product_point,2,',','.').' ₺'}}</td>
                        <td>{{number_format($product_earning,2,',','.').' ₺'}}</td>
                        @if( Auth::user()->role=='admin' )
                        <td width="5"><a href="{{route('product.Edit',['id' => $product->id])}}"><i
                                    class="fa fa-pencil-square"></i></a></td>
                        <td width="5">
                            <a href="#" onclick="confirmDelete('{{ route('product.Delete',['id' => $product->id]) }}')">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Sayfalama bağlantıları -->
            {{ $data['product']->onEachSide(1)->links() }}
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
