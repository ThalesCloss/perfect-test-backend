@extends('layout')

@section('content')
<h1>Adicionar / Editar Venda</h1>
<div class='card'>
    <div class='card-body'>
        <form method="POST" action="{{$id ?? ''}}">
            @if (!empty($id))
            @method('PUT')
            @endif
            @csrf
            <h5>Informações do cliente</h5>
            <div class="form-group">
                <label for="name">Nome do cliente</label>
                <input {{isset($customer['id'])?'disabled': ''}} name="name" type="text" class="form-control " id="name" value="{{$customer['name'] ?? old('name')}}" />
            </div>
            <div class="form-group">
                <label for="email">Email </label>
                <input {{isset($customer['id'])?'disabled': ''}} name="email" type="text" class="form-control" id="email" value="{{$customer['email'] ?? old('email')}}" />
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input {{isset($customer['id'])?'disabled': ''}} name="cpf" type="text" class="form-control" id="cpf" placeholder="99999999999" value="{{$customer['cpf'] ?? old('cpf')}}" />
            </div>
            <h5 class='mt-5'>Informações da venda</h5>
            <div class="form-group">
                <label for="product">Produto</label>
                <select {{isset($product_id)? 'disabled': ''}} name="product_id" id="product" class="form-control">
                    <option selected>Escolha...</option>
                    @forelse ($products as $product)
                    <option @if ((isset($product_id) && $product_id==$product['id']) || old('product_id')==$product['id']) selected @endif value="{{$product['id']}}">{{$product['name']}}</option>
                    @empty
                    <option>Sem produtos</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group">
                <label for="date">Data</label>
                <input name="sold_at" type="text" class="form-control single_date_picker" id="date" value="{{$sold_at ?? old('sold_at')}}" />
            </div>
            <div class="form-group">
                <label for="quantity">Quantidade</label>
                <input name="amount" type="text" class="form-control" id="quantity" placeholder="1 a 10" value="{{$amount ?? old('amount')}}" />
            </div>
            <div class="form-group">
                <label for="discount">Desconto</label>
                <input name="discount" type="text" class="form-control" id="discount" placeholder="100,00 ou menor" value="{{$discount ?? old('discount')}}" />
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option selected>Escolha...</option>
                    <option {{$status=='approved'? 'selected': ''}} value="approved">Aprovado</option>
                    <option {{$status=='canceled'? 'selected': ''}} value="canceled">Cancelado</option>
                    <option {{$status=='returned'? 'selected': ''}} value="returned">Devolvido</option>
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
