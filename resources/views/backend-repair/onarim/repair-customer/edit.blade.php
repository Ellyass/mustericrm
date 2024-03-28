@extends('backend-repair.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Müşteri Güncelleme</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('onarim.repair.Update',$repairCustomers->id) }}" method="post">
                    @csrf

                    <div class="form-group col-md-7 col-sm-5">
                        <label for="repair_customer_name">Müşteri Adı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control" type="text" name="repair_customer_name"
                                           id="repair_customer_name"
                                           value="{{ $repairCustomers->repair_customer_name }}" required>
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
                                    <input type="text" class="form-control" data-inputmask='"mask": "(999) 999 9999"'
                                           data-mask placeholder="Müşteri Telefonu" name="repair_customer_phone"
                                           id="repair_customer_phone"
                                           value="{{ $repairCustomers->repair_customer_phone }}" required>
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
                                    <input class="form-control" type="date" name="repair_customer_date"
                                           id="repair_customer_date"
                                           value="{{ $repairCustomers->repair_customer_date }}" required>
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
                                    @php $a = [];
                                        foreach($repairCustomers->repair_types as $repair_type) {
                                            $a[] =  $repair_type->type;
                                        }
                                    @endphp
                                    <select name="choices[]" class="form-control" multiple="multiple" id="choices">
                                        @foreach(config('variables.customer.types') as $key => $type)
                                            <option @if( in_array($key, $a)) selected @endif() value="{{ $key }}">
                                                {{ $type }}
                                            </option>
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
                                    @php $b = [];
                                        foreach($repairCustomers->repair_pieces as $repair_piece) {
                                            $b[] =  $repair_piece->piece;
                                        }
                                    @endphp
                                    <select name="pieces[]" class="form-control" multiple="multiple" id="pieces">
                                        @foreach(config('variables.customer.pieces') as $key => $type)
                                            <option @if( in_array($key, $b)) selected @endif() value="{{ $key }}">
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer" align="right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Güncelle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <section class="content-header">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Müşteri Notları</h3>
            </div>

            <!-- not_al_butonu -->
            <div align="right">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"
                        style="margin-right: 10px;">
                    Not al
                </button>
                <!--not al bölümü-->
                <form action="{{ route('onarim.not.Post',$repairCustomers->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="repair_customer_id" value="{{ $repairCustomers->id }}">

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
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tarih</th>
                                            <th scope="col">Notlar</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($repairExplanations as $key =>$repairExplanation)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $repairExplanation->created_at->timezone('Europe/Istanbul')->format('d.m.Y') }}</td>
                                                <td>{{ $repairExplanation->repair_explanation }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <textarea name="repair_explanation" id="repair_explanation" cols="70"
                                              rows="1"></textarea>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat
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
                    <th>Notlar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($repairExplanations as $key =>$repairExplanation)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $repairExplanation->created_at->timezone('Europe/Istanbul')->format('d.m.Y') }}</td>
                        <td>{{ $repairExplanation->repair_explanation }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('#choices').select2();
        });

        $(document).ready(function (){
            $('#pieces').select2();
        });
    </script>

@endsection
@section('css')@endsection
@section('js')@endsection
