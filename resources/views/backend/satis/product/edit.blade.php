@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ürün Düzenleme</h3>
            </div>
            <div class="box-body">
                <form action="{{route('product.Update',$product->id)}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group col-md-3 col-sm-5 ">
                        <label>Ürün Resmi</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="file" name="product_file"
                                       value="{{$product->product_file}}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-5 col-sm-5 ">
                        <label>Ürün Adı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="product_name"
                                       value="{{$product->product_name}}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-4 col-sm-5">
                        <label>Ürün Açıklaması</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="product_description"
                                       value="{{$product->product_description}}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-4 col-sm-5">
                        <label>Alış Fiyatı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="number" name="product_buy"
                                       value="{{$product->product_buy}}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-4 col-sm-5">
                        <label>Satış Fiyatı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="number" name="product_sell"
                                       value="{{$product->product_sell}}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-4 col-sm-5">
                        <label>2. Satış Fiyatı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="number" name="product_second_sell"
                                       value="{{$product->product_second_sell}}">
                            </div>
                        </div>
                    </div>


                    <div align="right" class="box-footer">
                        <button type="submit" class="btn btn-success">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('css')@endsection
@section('js')@endsection

