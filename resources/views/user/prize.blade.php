<div class="card-header">Результат игры</div>

<div class="row justify-content-center">
    <div class="col-md-12 text-center"><h2>Вы выйграли</h2></div>
    <div class="col-md-12 text-center"><h3>{{$prizeName}}</h3></div>
</div>
<div class="card-body">
    <form action="{{route('user.prize.get')}}" method="post" class="form-horizontal" id="game">
        <input type="hidden" name="_method" value="post">
        {{csrf_field()}}
        <hr>
        <input type="hidden" name="prize_id" value="{{$prizeId}}">

        <div class="col-md-12 text-center">
            <input type="button" class="btn btn-primary refuse" value="Отказаться" data-url="{{route('user.prize.refuse')}}">
            @if ($showConvertationButton === true)
                <input type="button" class="btn btn-primary refuse" value="Конвертировать в бонусы" data-url="{{route('user.prize.refuse')}}">
            @endif
            <input type="submit" class="btn btn-primary" value="Играть еще">
        </div>
    </form>
</div>
