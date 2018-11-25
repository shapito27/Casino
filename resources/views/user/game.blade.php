@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card game-container">
                <div class="card-header">Игра</div>

                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">Вы можете выйграть</div>
                    <div class="col-md-12 text-center"></div>
                    <div class="col-md-4 text-center">Денежный приз</div>
                    <div class="col-md-4 text-center">Бонусы</div>
                    <div class="col-md-4 text-center">Подарок</div>
                </div>
                <div class="card-body">
                    <form action="{{route('user.prize.get')}}" method="post" class="form-horizontal" id="game">
                        <input type="hidden" name="_method" value="post">
                        {{csrf_field()}}
                        <hr>
                        <div class="col-md-12 text-center">
                            <input type="submit" class="btn btn-primary" value="Играть">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
