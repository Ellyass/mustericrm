@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Kullanıcı Düzenleme</h3>
            </div>

            <div class="box-body">
                <form action="{{ route('authorization.Update', $data['users']->id) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <input class="form-control" type="hidden" name="id" value="{{ $data['users']->id }}">

                    <div class="form-group col-md-7 col-sm-5">
                        <label>Ad Soyad</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="name" value="{{ $data['users']->name }}"
                                       readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-7 col-sm-5">
                        <label>Yetkilendirme</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="auth[]" class="form-control" multiple="multiple" id="auth">
                                    @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                <small>Seçilmiş olan kullanıcıyı atamanıza gerek yoktur!!!</small>
                            </div>
                        </div>

                        <div class="box-footer" align="right">
                            <button type="submit" class="btn btn-success">Güncelle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <script>
        $(document).ready(function () {
            $('#auth').select2();
        });
    </script>
@endsection
@section('css')@endsection
@section('js')@endsection


