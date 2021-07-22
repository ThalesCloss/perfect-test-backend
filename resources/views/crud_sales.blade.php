@extends('layout')

@section('content')
<h1>Adicionar / Editar Venda</h1>
<div class='card'>
    <div class='card-body'>
        <form method="POST">
            @csrf
            <h5>Informações do cliente</h5>
            <div class="form-group">
                <label for="name">Nome do cliente</label>
                <input name="name" type="text" class="form-control " id="name" value="{{old('name')}}" />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="text" class="form-control" id="email" value="{{old('email')}}" />
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input name="cpf" type="text" class="form-control" id="cpf" placeholder="99999999999" value="{{old('cpf')}}" />
            </div>
            <h5 class='mt-5'>Informações da venda</h5>
            <div class="form-group">
                <label for="product">Produto</label>
                <select name="product_id" id="product" class="form-control">
                    <option selected>Escolha...</option>
                    <option>...</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Data</label>
                <input name="sold_at" type="text" class="form-control single_date_picker" id="date" value="{{old('sold_at')}}" />
            </div>
            <div class="form-group">
                <label for="quantity">Quantidade</label>
                <input name="amount" type="text" class="form-control" id="quantity" placeholder="1 a 10" value="{{old('amount')}}" />
            </div>
            <div class="form-group">
                <label for="discount">Desconto</label>
                <input name="discount" type="text" class="form-control" id="discount" placeholder="100,00 ou menor" value="{{old('discount')}}" />
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option selected>Escolha...</option>
                    <option value="approved">Aprovado</option>
                    <option value="canceled">Cancelado</option>
                    <option value="returned">Devolvido</option>
                </select>
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
