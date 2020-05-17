<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header"><h3>Разовый пропуск № {{ $permit->id }}</h3></div>

                <div class="card-body">
                    <p>на посещение офиса КПД-КАРГО</p>
                    <p>Дата заказа пропуска: {{ $permit->created_at->format('d.m.Y') }}</p>
                    <p>Дата посещения: {{ date('d.m.Y', strtotime($permit->visit)) }}</p>
                    <p>ФИО: {{ $permit->user->name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
