<div>
    ESTO ES UNA PAGINA DE INICIO
    <form action="{{ route('language', 'es') }}" method="GET" style="display:inline;">
        <button type="submit">🇪🇸 Español</button>
    </form>

    <form action="{{ route('language', 'en') }}" method="GET" style="display:inline;">
        <button type="submit">🇬🇧 English</button>
    </form>

    <form action="{{ route('language', 'fr') }}" method="GET" style="display:inline;">
        <button type="submit">🇫🇷 Français</button>
    </form>

    @if(Auth::check())
        <p>{{ __('messages.hello') }} {{ Auth::user()->name }}</p>
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="flex items-center p-1 text-sm gap-x-2 text-slate-600" type="submit">Cerrar sesión</button>
        </form> 
        <button onclick="location.href='/dashboard'">Dashboard</button>
        <button onclick="location.href='/peliculas'">Peliculas</button>
    @else
        <button onclick="location.href='/login'">IniciarSesion</button>
        <button onclick="location.href='/register'">Registrar</button>
    @endif


</div>
