@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Заказ пропусков в офис КПД-КАРГО</div>

                <div class="card-body">
                    <p>По вопросам обращаться ao@kpd-cargo.com или по телефону 161</p>

                    <a class="btn btn-info" href="{{ route('login') }}">ВОЙТИ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
