@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="form-group">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Müşteri Ekleme</h3>
                </div>
                <div class="box-body">
                    <form action="{{route('customer.Store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-5 col-sm-5">
                            <label>Ad Soyad</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input class="form-control" type="text" name="customer_name"
                                       placeholder="Müşteri Adı Soyadı" required>
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
                                       name="customer_company_name">
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
                                       name="customer_official">
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
                                       data-mask placeholder="Müşteri Telefonu" name="customer_phone" required>
                            </div>
                        </div>


                        <div class="form-group col-md-3 col-sm-5">
                            <label>Müşteri Telefonu 2</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" data-inputmask='"mask": "(999) 999 9999"'
                                       data-mask placeholder="Müşteri Telefonu" name="customer_phone_home">
                            </div>
                            <!-- /.input group -->
                        </div>


                        <div class="form-group col-md-3 col-sm-5">
                            <label>Müşteri E-Mail</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <input type="email" class="form-control" placeholder="Email" name="customer_mail">
                            </div>
                            <!-- /.input group -->
                        </div>


                        <div class="form-group col-md-3 col-sm-5">
                            <label style="">Müşteri Durumu</label>
                            <select name="customer_status" id="customer_status" class="form-control" required>
                                <option value="">Seçiniz...</option>
                                <option value="1">Yeni</option>
                                <option value="2">Kabul Edildi</option>
                                <option value="3">Reddedildi</option>
                                <option value="4">Randevu Verildi</option>
                            </select>
                        </div>


                        <div class="form-group col-md-3 col-sm-5">
                            <label>Müşteri Web</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <input type="url" class="form-control" placeholder="Url" name="customer_url">
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
                                       name="customer_address">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group col-md-3 col-sm-5">
                            <label style="">İl</label>
                            <select name="customer_city" class="form-control" required>
                                <option value="">Seçiniz</option>
                                @foreach($data['cities'] as $city)
                                    <option value="{{ $city->city }}">{{ $city->city }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div id="customer_status_sy" class="form-group col-md-6 col-sm-5">
                            <div id="customer_cancel_id" class="form-group col-md-6 col-sm-5">
                                <label for="">Reddedilme Sebebi</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-exclamation"></i>
                                    </div>
                                    <input type="text" name="customer_cancel_tx" class="form-control">
                                </div>
                            </div>


                            <div id="customer_meet_id" class="form-group col-md-6 col-sm-5">
                                <label for="">Tarih Seçiniz</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker"
                                           name="customer_meet_dt">
                                </div>
                            </div>
                        </div>


                        <div align="right" class="box-footer">
                            <button type="submit" class="btn btn-success">Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <script>
        $(document).ready(function () {
            $("#customer_status").change(function () {
                var selectedValue = $(this).val();

                // Tüm alanları gizle
                $("#customer_cancel_id").hide();
                $("#customer_meet_id").hide();
                $("#customer_status_sy").hide();

                if (selectedValue == "3") {
                    // Sadece Reddedildi seçeneğini göster
                    $("#customer_cancel_id").show();
                    $("#customer_status_sy").show();
                } else if (selectedValue == "4") {
                    // Sadece Randevu Verildi seçeneğini göster
                    $("#customer_meet_id").show();
                    $("#customer_status_sy").show();
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
