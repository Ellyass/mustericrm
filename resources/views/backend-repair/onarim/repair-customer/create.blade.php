@extends('backend-repair.layout')
@section('content')
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Müşteri Ekleme</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('onarim.repair.Store') }}" method="post">
                    @csrf

                    <div class="form-group col-md-7 col-sm-5">
                        <label for="repair_customer_name">Müşteri Adı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control" type="text" name="repair_customer_name" id="repair_customer_name" required>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-7 col-sm-5">
                        <label for="repair_customer_phone">Müşteri Telefonu</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control" data-inputmask='"mask": "(999) 999 9999"' data-mask placeholder="Müşteri Telefonu" name="repair_customer_phone" id="repair_customer_phone" required>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-7 col-sm-5">
                        <label for="repair_customer_date">Randevu Tarihi</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input class="form-control" type="date" name="repair_customer_date" id="repair_customer_date" required>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-7 col-sm-5">
                        <label for="choices">Yapılacak İşlem</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <select name="choices[]" class="form-control" multiple="multiple" id="choices">
                                        @foreach(config('variables.customer.types') as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-7 col-sm-5">
                        <label for="choices">İşlem Görecek Yer</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <select name="pieces[]" class="form-control" multiple="multiple" id="pieces">
                                        @foreach(config('variables.customer.pieces') as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="box-footer" align="right">
                            <button type="submit" class="btn btn-success">Ekle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('#choices').select2();
        });

        $(document).ready(function () {
            $('#pieces').select2();
        });

        $(function () {
            $('[data-mask]').inputmask();
        });

    </script>
@endsection
@section('css')@endsection
@section('js')@endsection
