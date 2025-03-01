<style>
html, body, button{
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-weight: bold;
}
nav {
    width: 60%;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
    background-color: #212121;
    color: white;
    border-radius: 10px;
}

.logo img {
    height: 40px;
}

.right {
    display: flex;
    align-items: center;
    gap: 20px;
}
.sign {
    display: flex;
    align-items: center;
    gap: 20px;
}
button{
    border-radius: 13px;
    background-color: #555;
    color: white;
    border: none;
    padding: 8px 10px;
    cursor: pointer;
    transition: background 0.3s;
}
button:hover {
    background-color: #777;
}


.paste-button {
  position: relative;
  display: block;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.button-drop {
  background-color: #D0D1D2;
  color: #212121;
  padding: 10px 15px;
  font-size: 15px;
  font-weight: bold;
  border: 2px solid transparent;
  border-radius: 15px;
  cursor: pointer;
}

.dropdown-content {
  display: none;
  font-size: 13px;
  position: absolute;
  z-index: 1;
  min-width: 200px;
  background-color: #212121;
  border: 2px solid #D0D1D2;
  border-radius: 0px 15px 15px 15px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.dropdown-content button {
  color: #D0D1D2;
  background-color: #212121;
  border: none;
  padding: 8px 10px;
  text-decoration: none;
  display: block;
  transition: 0.1s;
  width: 200px;
  border-radius: 13px;
}

.dropdown-content button:hover {
  background-color: #D0D1D2;
  color: #212121;
}

.dropdown-content button:focus {
  background-color: #212121;
  color: #D0D1D2;
}

.dropdown-content #top:hover {
  border-radius: 0px 13px 0px 0px;
}

.dropdown-content #middle:hover {
  border-radius: 0;
}

.dropdown-content #bottom {
  border-radius: 0px 0px 13px 13px;
}

.dropdown-content #bottom:hover {
  border-radius: 0px 0px 13px 13px;
}

.paste-button:hover button {
  border-radius: 15px 15px 0px 0px;
}

.paste-button:hover .dropdown-content {
  display: block;
  animation: opacity 1s ease;
}
 
@keyframes opacity {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

#cerrar{
    background-color: #212121;
    transform: translateY(9px);
    font-weight: bold;
    font-size: 16;
}
#cerrar:hover{
    color: white;
    transform: scale(1.05);
    transform: translateY(9px);
}

a, #cerrar{
    color: #D0D1D2;
    transition: all 0.5s;
    text-decoration: none;
}
a:hover{
    color: white;
    transform: scale(1.05);
}



</style>
<nav>
    <div class="logo">
        <x-application-logo class="w-20 h-20 fill-current text-white" />
    </div>
    
    <div class="right">
        
        <div class="sign">
            @if(Auth::check())
            <p>{{ __('messages.hello') }} {{ Auth::user()->name }}</p>
            @endif
        </div>
        <a href="/actores">{{__('messages.actores')}}</a>
        <a href="/peliculas">{{__('messages.peliculas')}}</a>

        <div class="idiomas">
        <div class="paste-button">
            <button class="button-drop">
                <svg width="30" height="30" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#000000"> <title id="languageIconTitle"></title> <circle cx="12" cy="12" r="10"/> <path stroke-linecap="round" d="M12,22 C14.6666667,19.5757576 16,16.2424242 16,12 C16,7.75757576 14.6666667,4.42424242 12,2 C9.33333333,4.42424242 8,7.75757576 8,12 C8,16.2424242 9.33333333,19.5757576 12,22 Z"/> <path stroke-linecap="round" d="M2.5 9L21.5 9M2.5 15L21.5 15"/> </svg>    
            </button>
            <div class="dropdown-content">
                <form action="{{ route('language', 'es') }}" method="GET" style="display:inline;">
                    <button id="top" type="submit">🇪🇸 Español</button>
                </form>
                <form action="{{ route('language', 'en') }}" method="GET" style="display:inline;">
                    <button id="middle" type="submit">🇬🇧 English</button>
                </form>
                <form id="bottom" action="{{ route('language', 'fr') }}" method="GET" style="display:inline;">
                    <button id="bottom" type="submit">🇫🇷 Français</button>
                </form>
            </div>
        </div>
    </div>
    <div class="perfil">

    <div class="paste-button">

        <button class="button-drop">
                <svg width="30" height="30" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                <g>
                    <g>
                    <path d="m64.3,71.6c18,0 32.6-14.6 32.6-32.6s-14.6-32.5-32.6-32.5-32.6,14.6-32.6,32.5 14.6,32.6 32.6,32.6zm0-56.6c13.2,0 24,10.8 24,24s-10.8,24-24,24-24-10.8-24-24 10.8-24 24-24z"/>
                    <path d="m7.9,122.5h113.2c2.4,0 4.3-1.9 4.3-4.3 0-22.5-18.3-40.9-40.9-40.9h-40c-22.5,0-40.9,18.3-40.9,40.9-1.33227e-15,2.4 1.9,4.3 4.3,4.3zm36.6-36.6h40c16.4,0 29.9,12.2 32,28h-104c2.1-15.7 15.6-28 32-28z"/>
                    </g>
                </g>
                </svg>
        </button>
        <div class="dropdown-content">
            @if(Auth::check())
            <button id="top" onclick="location.href='/profile'">{{ __('messages.profile') }}</button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button  id="bottom" type="submit">{{ __('messages.logout') }}</button>
            </form>
            @else
            <button id="top" onclick="location.href='/login'">{{ __('messages.login') }}</button>
            <button id="bottom" onclick="location.href='/register'">{{ __('messages.register') }}</button>
            @endif
        </div>
    </div>

    

    </div>
    </div>
    
</nav>
