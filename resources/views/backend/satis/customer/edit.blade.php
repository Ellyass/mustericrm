@extends('backend.layout')
@section('content')

    <section class="content-header">
        {{--Müşteri ekleme--}}
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Müşteri Bilgileri Güncelleme</h3>
            </div>
            <div class="box-header with-border">
                <!--müşteri güncelleme-->
                <div class="box-body">
                    <form action="{{ route('customer.Update',$customer->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf


                        <div class="form-group col-md-5 col-sm-5">
                            <label>Ad Soyad</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input class="form-control" type="text" name="customer_name"
                                       placeholder="Müşteri Adı Soyadı" value="{{ $customer->customer_name }}">
                            </div>
                            <!-- /.input group -->
                        </div>


                        <div class="form-group col-md-7 col-sm-5">
                            <label>Firma</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-building"></i>
                                </div>
                                <input type="text" class="form-control" placeholder="Firma Adı"
                                       name="customer_company_name" value="{{ $customer->customer_company_name }}">
                            </div>
                            <!-- /.input group -->
                        </div>


                        <div class="form-group col-md-3 col-sm-5">
                            <label>Yetkili</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user-circle"></i>
                                </div>
                                <input type="text" class="form-control" placeholder="Yetkili Kişi"
                                       name="customer_official" value="{{ $customer->customer_official }}">
                            </div>
                            <!-- /.input group -->
                        </div>


                        <div class="form-group col-md-3 col-sm-5">
                            <label>Müşteri Telefonu</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" data-inputmask='"mask": "(999) 999 9999"'
                                       data-mask placeholder="Müşteri Telefonu" name="customer_phone"
                                       value="{{ $customer->customer_phone }}">
                            </div>
                            <!-- /.input group -->
                        </div>


                        <div class="form-group col-md-3 col-sm-5">
                            <label>Müşteri Telefonu 2</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" data-inputmask='"mask": "(999) 999 9999"'
                                       data-mask placeholder="Müşteri Telefonu" name="customer_phone_home"
                                       value="{{ $customer->customer_phone_home }}">
                            </div>
                            <!-- /.input group -->
                        </div>


                        <div class="form-group col-md-3 col-sm-5">
                            <label>Müşteri E-Mail</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <input type="email" class="form-control" placeholder="Email" name="customer_mail"
                                       value="{{ $customer->customer_mail }}">
                            </div>
                            <!-- /.input group -->
                        </div>


                        <div class="form-group col-md-3 col-sm-5 col-xs-12">
                            <label style="">Müşteri Durumu</label>
                            <select name="customer_status" id="customer_status" class="form-control" required>
                                <option value="">Seçiniz...</option>
                                <option value="1" {{ $customer->customer_status == 1 ? 'selected' : '' }}>Yeni</option>
                                <option value="2" {{ $customer->customer_status == 2 ? 'selected' : '' }}>Kabul Edildi
                                </option>
                                <option value="3" {{ $customer->customer_status == 3 ? 'selected' : '' }}>Reddedildi
                                </option>
                                <option value="4" {{ $customer->customer_status == 4 ? 'selected' : '' }}>Randevu
                                    Verildi
                                </option>
                            </select>
                        </div>


                        <div class="form-group col-md-3 col-sm-5">
                            <label>Müşteri Web</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <input type="url" class="form-control" placeholder="Url" name="customer_url"
                                       value="{{ $customer->customer_url }}">
                            </div>
                            <!-- /.input group -->
                        </div>


                        <div class="form-group col-md-3 col-sm-5">
                            <label>Müşteri Adres</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-location-arrow"></i>
                                </div>
                                <input type="text" class="form-control" placeholder="Müşteri Adresi"
                                       value="{{ $customer->customer_address }}"
                                       name="customer_address">
                            </div>
                            <!-- /.input group -->
                        </div>


                        @if(isset($cities))
                            <div class="form-group col-md-3 col-sm-5 col-xs-12">
                                <label style="">İl</label>
                                <select name="customer_city" class="form-control" required>
                                    <option value="">Seçiniz...</option>
                                    @foreach($cities as $city)
                                        <option
                                            value="{{ $city->city }}"{{ $customer->customer_city == $city->city ? 'selected' : '' }}>
                                            {{ $city->city }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif


                        <div id="customer_statuss_sy" class="form-group col-md-6 col-sm-5" required>
                            <div id="customer_cancell_id" class="form-group col-md-6 col-sm-5">
                                <label for="">Reddedilme Sebebi</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-exclamation"></i>
                                    </div>
                                    <input type="text" name="customer_cancel_tx" class="form-control"
                                           placeholder="Reddetme Sebebi " value="{{ $customer->customer_cancel }}">
                                </div>
                            </div>


                            <div id="customer_meett_id" class="form-group col-md-6 col-sm-5">
                                <label for="">Tarih Seçiniz</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker"
                                           name="customer_meet_dt" placeholder="Tarih Giriniz"
                                           value="{{ $customer->customer_meet }}">
                                </div>
                            </div>
                        </div>


                        <div align="right" class="box-footer">
                            <button type="submit" class="btn btn-success">Güncelle</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{--Satış ekleme--}}
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Satış</h3>
            </div>
            <div class="box-body">
                <form action="{{route('customer.Sales',['id' => $customer->id])}}" method="post">
                    @csrf


                    <input type="hidden" name="customer_id" value="{{ $customer->id }}">

                    @if(isset($pro))
                        <div class="form-group col-md-12 col-sm-5 col-xs-12">
                            <label style="">Ürünler</label>
                            <select id="selectedProductId" name="product_name" class="form-control" required>
                                <option value="">Ürün Seçiniz</option>
                                @foreach($pro as $item)
                                    <option value="{{ $item->id}}"
                                            data-buy="{{ $item->product_buy }}"
                                            data-sell="{{ $item->product_sell }}">{{ $item->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="form-group col-md-4 col-sm-5">
                        <label>Alış Fiyatı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="sales_buy" id="product_buy" readonly>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-4 col-sm-5">
                        <label>Satış Fiyatı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="sales_sell" id="product_sell" readonly>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-4 col-sm-5">
                        <label>2.Satış Fiyatı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="number" name="sales_second_sell" min="0">
                            </div>
                        </div>
                    </div>


                    <div align="right" class="box-footer">
                        <button type="submit" class="btn btn-success">Ekle</button>
                    </div>
                </form>
            </div>
        </div>

        {{--Satışlar--}}
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Satış geçmişi</h3>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Ürün Adı</th>
                    <th>Alış Fiyatı</th>
                    <th>Satış Fiyatı</th>
                    <th>2.Satış Fiyatı</th>
                    <th>Toplam Fiyat</th>
                    <th>Toplam Kâr</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($sales))
                    @foreach($sales as $sale)
                        <tr>
                            @if($customer->id == $sale->customer_id)
                                @foreach($pro as $p)
                                    @if($p->id == $sale->product_id)
                                        <td>{{$p->product_name}}</td>
                                    @endif
                                @endforeach
                                <td>{{number_format($sale->sales_buy,2,',','.').' ₺'}}</td>
                                <td>{{number_format($sale->sales_sell,2,',','.').' ₺'}}</td>
                                <td>{{number_format($sale->sales_second_sell,2,',','.').' ₺'}}</td>
                                @php
                                    $sales_point = $sale['sales_buy'] * 1;
                                    if($sale->sales_second_sell){
                                        $sales_earning = ($sale->sales_second_sell * 1) - $sales_point;
                                    } else {
                                        $sales_earning = ($sale->sales_sell * 1) - $sales_point;
                                    }
                                @endphp
                                <td>{{number_format($sales_point,2,',','.').' ₺'}}</td>
                                <td>{{number_format($sales_earning,2,',','.').' ₺'}}</td>
                        </tr>
                        @endif
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

        {{--Arama Notları--}}
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Arama Notları</h3>
            </div>

            <!-- not_al_butonu -->
            <div align="right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Not al
                </button>
                <!--not al bölümü-->
                <form action="{{route('not.Post')}}" method="POST">
                    @csrf

                    <input type="hidden" name="customer_id" value="{{$customer->id}}">


                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" align="center" id="exampleModalLabel"><strong>Arama
                                            Notları</strong>
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    @if(isset($call))
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
                                                    <td>{{$cal->updated_at->timezone('Europe/Istanbul')->format('d.m.Y')}}</td>
                                                    <td>{{$cal->call_explanation}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif

                                    <textarea name="call_explanation" id="call_explanation" cols="70"
                                              rows="1"></textarea>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat
                                    </button>
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tarih</th>
                    <th>Açıklama</th>
                </tr>
                </thead>
                <tbody>
                @php($arama = 1)
                @foreach($call as $cal)
                    <tr>
                        <td>{{$arama++}}</td>
                        <td>{{$cal->updated_at->timezone('Europe/Istanbul')->format('d.m.Y')}}</td>
                        <td>{{$cal->call_explanation}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Seçilen ürün değiştikçe, fiyat alanlarını güncelle
            document.getElementById('selectedProductId').addEventListener('change', function () {
                var selectedProductId = this.value;
                var selectedOption = this.options[this.selectedIndex];
                var buyPrice = selectedOption.getAttribute('data-buy');
                var sellPrice = selectedOption.getAttribute('data-sell');

                document.getElementById('product_buy').value = buyPrice;
                document.getElementById('product_sell').value = sellPrice;
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            $("#customer_status").change(function () {
                var selectedValue = $(this).val();

                // Tüm alanları gizle
                $("#customer_cancell_id").hide();
                $("#customer_meett_id").hide();
                $("#customer_statuss_sy").hide();

                if (selectedValue == "3") {
                    // Sadece Reddedildi seçeneğini göster
                    $("#customer_cancell_id").show();
                    $("#customer_statuss_sy").show();
                } else if (selectedValue == "4") {
                    // Sadece Randevu Verildi seçeneğini göster
                    $("#customer_meett_id").show();
                    $("#customer_statuss_sy").show();
                }
            }).change();
        });
    </script>


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
        })
    </script>

@endsection
@section('css')@endsection
@section('js')@endsection
