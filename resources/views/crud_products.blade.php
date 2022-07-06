@extends('layout')

@section('content')
<h1>Adicionar / Editar Produto</h1>
<div class='card'>
    <div class='card-body'>
        <form method="POST" action="{{$id ?? ''}}">
            @if (!empty($id))
            @method('PUT')
            @endif
            @csrf
            <div class="form-group">
                <label for="name">Nome do produto</label>
                <input name="name" type="text" class="form-control " value="{{$name ?? old('name')}}" id="name" />
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" type="text" rows='5' class="form-control" id="description">
                {{$description ?? old('description')}}
                </textarea>
            </div>
            <div class="form-group">
                <label for="price">Preço</label>
                <input name="price" type="text" class="form-control" id="price" placeholder="100,00 ou maior" value="{{$price ?? old('price')}}" />
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <button type="submit" class="btn btn-primary">Salvar</button>

        </form>
    </div>
</div>



@endsection
