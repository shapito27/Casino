@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Аккаунт</div>

                <div class="card-body withdraw-container">
                    <form action="{{route('user.account.withdraw')}}" method="post" class="form-horizontal" id="withdraw">
                        <input type="hidden" name="_method" value="post">
                        {{csrf_field()}}
                        <hr>
                        <div class="col-md-12 text-center">
                            <input type="submit" class="btn btn-primary" value="Вывести деньги">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
