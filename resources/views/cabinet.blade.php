@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Личный кабинет сотрудника</h2></div>

                    <div class="card-body">
                        <p><u> Данные сотрудника</u></p>
                        <p>ФИО: {{ Auth::user()->name }}</p>
                        <p>email: {{ Auth::user()->email }}</p>
                        <p><u>Заказ разового пропуска</u></p>
                        <p>Заказ пропуска доступен на {{ date('d.m.Y') }} и {{ date('d.m.Y', strtotime('tomorrow')) }}</p>
                        <p>
                            Лимит на одного сотрудника - {{ config('params.setting.week_limit') }} шт. в неделю.
                            Осталось на неделю с {{ date('d.m.Y', strtotime('monday this week')) }}
                            по {{ date('d.m.Y', strtotime('sunday this week')) }} - {{ $service->limitWeek() }} шт.
                        </p>
                        <p>
                            Лимит на всех - {{ config('params.setting.day_limit') }} шт. в сутки. Осталось
                            на {{ date('d.m.Y') }} - {{ $service->todayLimit() }} шт,
                            на {{ date('d.m.Y', strtotime('tomorrow')) }} - {{ $service->tomorrowLimit() }} шт
                        </p>
                        <p>
                            Заказ пропуска недоступен, если хотя бы один из лимитов на соответствующую дату не выполняется.
                        </p>
                        <p>
                            @if($service->hasToday())
                                <a class="btn btn-info" href="/permit/{{ $service->hasToday() }}">ПОКАЗАТЬ ПРОПУСК НА {{ date('d.m.Y') }}</a>
                            @elseif($service->canToday())
                                <a class="btn btn-info" href="/today">ЗАКАЗАТЬ ПРОПУСК НА {{ date('d.m.Y') }}</a>
                            @else
                                НА {{ date('d.m.Y') }} ЛИМИТ ИСЧЕРПАН
                            @endif
                        </p>
                        <p>
                            @if($service->hasTomorrow())
                                <a class="btn btn-info" href="/permit/{{ $service->hasTomorrow() }}">ПОКАЗАТЬ ПРОПУСК НА {{ date('d.m.Y', strtotime('tomorrow')) }}</a>
                            @elseif($service->canTomorrow())
                                <a class="btn btn-info" href="/tomorrow">ЗАКАЗАТЬ ПРОПУСК НА {{ date('d.m.Y', strtotime('tomorrow')) }}</a>
                            @else
                                НА {{ date('d.m.Y', strtotime('tomorrow')) }} ЛИМИТ ИСЧЕРПАН
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
