@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ürün Ekleme</h3>
            </div>
            <div class="box-body">
                <form action="{{route('product.Store')}}" method="post" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group col-md-3 col-sm-5 ">
                        <label>Ürün Resmi</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="file" name="product_file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-3 col-sm-5 ">
                        <label>Ürün Adı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="product_name">
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-6 col-sm-5" data-height="10">
                        <label>Ürün Açıklaması</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <textarea class="form-control" name="product_description">
                                </textarea>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-4 col-sm-5">
                        <label>Alış Fiyatı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="number" name="product_buy" required>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-4 col-sm-5">
                        <label>Satış Fiyatı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="number" name="product_sell">
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-4 col-sm-5">
                        <label>2.Satış Fiyatı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="number" name="product_second_sell" minlength="0">
                            </div>
                        </div>
                    </div>


                    <div align="right" class="box-footer">
                        <button type="submit" class="btn btn-success">Ekle</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('css')@endsection
@section('js')@endsection
