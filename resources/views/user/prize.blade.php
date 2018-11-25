@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Получить приз</div>

                <div class="row justify-content-center">
                    <div class="col-md-4">Денежный приз</div>
                    <div class="col-md-4">Бонусы</div>
                    <div class="col-md-4">Подарок</div>
                </div>
                <div class="card-body">
                    <form action="{{route('user.prize.get')}}" method="post" class="form-horizontal" >
                        <input type="hidden" name="_method" value="get">
                        {{csrf_field()}}
                        <hr>

                        <input type="submit" class="btn btn-primary" value="Получить">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
