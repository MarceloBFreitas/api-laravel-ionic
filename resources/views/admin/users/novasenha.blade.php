@extends('layouts.admin')

@section('content')

    @if(Session::has('alertar'))
        <div class="container">
            {!! Alert::danger(Session::get('alertar'))->close() !!}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <h3>Alteração de Senha: </h3>
            <?php  $icon = Icon::create('floppy-disk');?>
           {!! form($form->add('Salve','submit',[
                'attr' => ['class' => 'btn btn-primary btn-block'],
                'label' => $icon. " Salvar"
            ])) !!}
        </div>

    </div>
@endsection
