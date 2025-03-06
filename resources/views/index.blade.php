<style>
    html, body{
        margin: 0;
        padding: 0;
        background-color:#212121
    }
    .subtitulo {
	font-family: "Headland One", serif;
	font-size: 30px;
	font-weight: bolder;
    text-align: center;
    color: white;
    width: 40vw;
    margin: 5vh 30vw;
    }

    .descubrir{
        margin: 5vh 45vw;
    }

.button {
    width: 10vw;
  all: unset;
  display: flex;
  align-items: center;
  position: relative;
  padding: 0.6em 2em;
  border: #00E153 solid 0.15em;
  border-radius: 0.25em;
  color: #00E153;
  font-size: 20px;
  font-weight: 600;
  cursor: pointer;
  overflow: hidden;
  transition: border 300ms, color 300ms;
  user-select: none;
}

.button p {
  z-index: 1;
}

.button:hover {
  color: #212121;
}

.button:active {
  border-color: #00E153;
}

.button::after, .button::before {
  content: "";
  position: absolute;
  width: 9em;
  aspect-ratio: 1;
  background: #00E153;
  opacity: 50%;
  border-radius: 50%;
  transition: transform 500ms, background 300ms;
}

.button::before {
  left: 0;
  transform: translateX(-8em);
}

.button::after {
  right: 0;
  transform: translateX(8em);
}

.button:hover:before {
  transform: translateX(-1em);
}

.button:hover:after {
  transform: translateX(1em);
}

.button:active:before,
.button:active:after {
  background: #00E153;
}
.disponible{
	display: block;
	margin: 2vh;
	text-align: center;
  color: #727F8F;
}

</style>
<html lang="en">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Headland+One&display=swap" rel="stylesheet">
    <body>
        <x-global-components.nav/>
        <div class="space"></div>
        <div class="subtitulo">
            {{__('messages.index1')}}
            <br>
            {{__('messages.index2')}}
            
            <br>
            {{__('messages.index3')}}
        </div>
        <x-global-components.carrousel/>       
        <div class="disponible">
          {{ __('messages.available')}} <img src="https://i.ibb.co/1DZnfg3/imagen-removebg-preview.png" width="50px" height="auto" style="transform: translateY(4px)">
        </div> 
        <div class="descubrir">
            <button onclick="location.href='/peliculas'" class="button">
                <p>{{ __('messages.discover') }}</p> 
            </button>
        </div>
    </body>
    <x-global-components.footer/>

</html>