@extends('backend-repair.layout')
@section('content')
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Kullanıcı Ekleme</h3>
            </div>
            <div class="box-body">
                <form action="{{route('onarim.user.Store')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Resim Seç</label>
                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-control" name="user_file" type="file" required>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Ad Soyad</label>
                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-control" type="text" name="name" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kullanıcı Adı (E-Mail)</label>
                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-control" type="email" name="email" required>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Şifre</label>
                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-control" type="password" name="password" required>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Rol</label>
                        <div class="row">
                            <div class="col-xs-6">
                                <select name="role" class="form-control" required>
                                    <option value="admin">Yönetici</option>
                                    <option value="user">Satış Sorumlusu</option>
                                    <option value="repair">Onarım Sorumlusu</option>
                                </select>
                            </div>
                        </div>

                        <div align="right" class="box-footer">
                            <button type="submit" class="btn btn-success">Ekle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
@section('css')@endsection
@section('js')@endsection
