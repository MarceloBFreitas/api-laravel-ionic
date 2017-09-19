@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Categorias</h3>
            {!! Button::primary('Nova Categoria')->asLinkTo(route('admin.categorias.create')) !!}
        </div>
        <div class="row">
            {!! Table::withContents($categorias->items())->striped()->callback('Ações',function($field,$categoria){
                     $linkedit = route('admin.categorias.edit',['categoria' => $categoria->id]);
                     $linkshowdel = route('admin.categorias.show',['id' => $categoria->id]);
                     return
                         Button::link(Icon::create('pencil'))->asLinkTo($linkedit) . '|' .
                         Button::link(Icon::create('remove'))->asLinkTo($linkshowdel);
                     ;

             });
            !!}
        </div>
        {!! $categorias->links() !!}
    </div>
@endsection
