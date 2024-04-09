@extends('layouts.app')

@section('content')
    <main class="px-3">
        @auth
            <h1 class="py-5">Bienvenido(a) {{ Auth::user()->name }}</h1>
            <p class="lead">En nuestro espacio digital, encontrarás un mundo de posibilidades al alcance de tu mano. Desde
                productos de moda hasta tecnología de vanguardia, pasando por artículos para el hogar y mucho más, nuestra
                plataforma está diseñada para satisfacer todas tus necesidades y deseos.

                Explora nuestra amplia selección de productos cuidadosamente curados y descubre las últimas tendencias y los
                mejores precios. ¿Buscas algo en particular? Nuestra potente función de búsqueda te ayudará a encontrar
                exactamente lo que necesitas en cuestión de segundos.

                Y eso no es todo, ¡nuestra aplicación está repleta de ofertas especiales, descuentos exclusivos y promociones
                emocionantes para que puedas disfrutar de una experiencia de compra aún más gratificante!

                Gracias por elegirnos para tus compras en línea. ¡Bienvenido a nuestra comunidad virtual, donde la conveniencia
                y la calidad se encuentran en cada clic!</p>
            <p class="lead">
                <a href="{{ route('compras') }}" class="btn btn-lg btn-light fw-bold border-white bg-white">Comprar y vender</a>
            </p>
        @else
            <p class="lead">
            <h4 class="py-5">Hola, debes ingresar para gestionar la información de tu tienda.</h4>
            <a href="{{ route('login') }}" class="btn btn-lg btn-primary fw-bold ">Ingresar</a>
            </p>

        @endauth

    </main>
@endsection
