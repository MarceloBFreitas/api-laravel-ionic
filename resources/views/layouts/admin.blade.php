<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <?php $navbar =  Navbar::withBrand(config('app.name'),url('/admin/dashboard'))->inverse();
            if(Auth::check()){
                $arraylinks = [
                    ['link' => route('admin.users.index'),'title' => 'Usuários'],
                    ['link' => route('admin.categorias.index'),'title' => 'Categorias'],
                ];
                $menus = Navigation::links($arraylinks);

                $logout= Navigation::links([
                        [
                             Auth::user()->name,
                            [
                                [
                                    'link' => route('admin.logout'),
                                    'title' => "Logout",
                                    'linkAttributes' => [
                                        'onclick' => 'event.preventDefault();document.getElementById("formlogout").submit();'
                                    ]
                                ],
                                [
                                    'link' => url('admin/alterar/senha'),
                                    'title' => "Alterar Senha",
                                ],
                            ]
                        ],
                ])->right();
                $navbar->withContent($menus)->withContent($logout);
            }
        ?>

        {!! $navbar !!}

            <?php
            $formlogout = FormBuilder::plain([
                'id' => 'formlogout',
                'route'=> ['admin.logout'],
                'method' => 'POST',
                'style' => 'display:none'
            ]);

            ?>


            {!! form($formlogout) !!}

        @if(Session::has('message'))
            <div class="container">
                {!! Alert::success(Session::get('message'))->close() !!}
            </div>
        @endif
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
