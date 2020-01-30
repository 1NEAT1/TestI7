<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Тестовое задание</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/') }}">Создание объекта с информацией о клиенте</a>
            </li>
            <li class="nav-item {{ request()->is('domain') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/domain') }}">Создание объекта с информацией о домене</a>
            </li>
        </ul>
    </div>
</nav>
