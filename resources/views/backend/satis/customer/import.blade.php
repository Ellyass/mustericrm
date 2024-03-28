@extends('backend.layout')
@section('content')
    <form action="{{route('customer.import.Store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Dosya Seçin:</label>
            <input type="file" name="file" id="file" class="form-control-file">
        </div>

        <input type="hidden" name="role" value="{{ request()->get('role') }}">

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Kullanıcıları İçe Aktar</button>
        </div>
    </form>
@endsection
@section('css')@endsection
@section('js')@endsection
