<div class="card-header">Результат игры</div>

<div class="row justify-content-center">
    <div class="col-md-12 text-center"><h2>Вы отказались от приза</h2></div>
</div>
<div class="card-body">
    <form action="{{route('user.prize.get')}}" method="post" class="form-horizontal" id="game">
        <input type="hidden" name="_method" value="post">
        {{csrf_field()}}
        <hr>

        <div class="col-md-12 text-center">
            <input type="submit" class="btn btn-primary" value="Играть еще">
        </div>
    </form>
</div>
