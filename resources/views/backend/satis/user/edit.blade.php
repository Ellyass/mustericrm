@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Kullanıcı Düzenleme</h3>
            </div>

            <div class="box-body">
                <form action="{{route('user.Update',$user->id)}}" method="post" enctype="multipart/form-data">
                    @csrf

                    @isset($user->user_file)
                        <div class="form-group">
                            <label>Yüklü Görsel</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <img width="100" src="/storage/images/users/{{$user->user_file}}" alt="">
                                </div>
                            </div>
                        </div>
                    @endisset


                    <div class="form-group col-md-7 col-sm-5 ">
                        <label>Resim Seç</label>
                        <div class="row">
                            <div class="col-xs-5">
                                <input class="form-control" name="user_file" type="file">
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-7 col-sm-5 ">
                        <label>Ad Soyad</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="name"
                                       value="{{$user->name}}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-7 col-sm-5 ">
                        <label>E-mail</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" name="email"
                                       value="{{$user->email}}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-7 col-sm-5">
                        <label>Şifre</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password"
                                       placeholder="Eğer şifreyiniz değiştirmek istemiyorsanız boş bırakın!">
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-7 col-sm-5">
                        <label>Rol</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="role" class="form-control">
                                    <option value="admin"
                                            @if(old('role') == 'admin' || $user->role == 'admin') selected @endif>
                                        Yönetici
                                    </option>
                                    <option value="user"
                                            @if(old('role') == 'user' || $user->role == 'user') selected @endif>Satış
                                        Sorumlusu
                                    </option>
                                    <option value="repair"
                                            @if(old('role') == 'repair' || $user->role == 'repair') selected @endif>
                                        Onarım Sorumlusu
                                    </option>
                                </select>
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

@endsection
@section('css')@endsection
@section('js')@endsection

