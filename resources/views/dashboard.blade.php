@extends('layout')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<h1>Dashboard de vendas</h1>
<div class='card mt-3'>
    <div class='card-body'>
        <h5 class="card-title mb-5">Tabela de vendas
            <a href='/sales' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i> Nova venda</a>
        </h5>
        <form method="GET">
            <div class="form-row align-items-center">
                <div class="col-sm-5 my-1">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Clientes</div>
                        </div>
                        <select name="customer_id" class="form-control" id="inlineFormInputName">
                            <option value="">Clientes</option>
                            @forelse ( $customers as $customer)
                                <option value="{{$customer['id']}}">{{$customer['name']}}</option>
                            @empty
                                <option>Nenhum cliente cadastrado</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 my-1">
                    <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Período</div>
                        </div>
                        <input name="interval" type="text" class="form-control date_range" id="inlineFormInputGroupUsername" placeholder="Username">
                    </div>
                </div>
                <div class="col-sm-1 my-1">
                    <button type="submit" class="btn btn-primary" style='padding: 14.5px 16px;'>
                        <i class='fa fa-search'></i></button>
                </div>
            </div>
        </form>
        <table class='table'>
            <tr>
                <th scope="col">
                    Produto
                </th>
                <th scope="col">
                    Data
                </th>
                <th scope="col">
                    Valor
                </th>
                <th scope="col">
                    Ações
                </th>
            </tr>
            @forelse ($sales as $sale)
            <tr>
                <td>
                    {{$sale['product']['name']}}
                </td>
                <td>
                    {{$sale['sold_at']}}
                </td>
                <td>
                    R$ {{number_format($sale['total_price'],2,',','.')}}
                </td>
                <td>
                    <a href="/sales/{{$sale['id']}}" class='btn btn-primary'>Editar</a>
                </td>
            </tr>
            @empty
            <tr>
                <td>Nenhuma venda localizada para o filtro aplicado</td>
            </tr>
            @endforelse

        </table>
    </div>
</div>
<div class='card mt-3'>
    <div class='card-body'>
        <h5 class="card-title mb-5">Resultado de vendas</h5>
        <table class='table'>
            <tr>
                <th scope="col">
                    Status
                </th>
                <th scope="col">
                    Quantidade
                </th>
                <th scope="col">
                    Valor Total
                </th>
            </tr>
            @php
            $statusList = ['approved'=>'Aprovado', 'canceled'=>'Cancelado', 'returned'=>'Devolvido']
            @endphp
            @forelse ($salesReport as $report)
            <tr>
                <td>
                    {{$statusList[$report->status]}}
                </td>
                <td>
                    {{$report->amount}}
                </td>
                <td>
                    R$ {{number_format($report->total,2,',', '.')}}
                </td>
            </tr>
            @empty
            <tr>
                <td>Nenhuma venda realizada até o momento</td>
            </tr>
            @endforelse

        </table>
    </div>
</div>

<div class='card mt-3'>
    <div class='card-body'>
        <h5 class="card-title mb-5">Produtos
            <a href='/products' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i> Novo produto</a>
        </h5>
        <table class='table'>
            <tr>
                <th scope="col">
                    Nome
                </th>
                <th scope="col">
                    Valor
                </th>
                <th scope="col">
                    Ações
                </th>
            </tr>
            @forelse ( $products as $product)
            <tr>
                <td>
                    {{$product['name']}}
                </td>
                <td>
                    R$ {{number_format($product['price'],2,',', '.')}}
                </td>
                <td>
                    <a href="/products/{{$product['id']}}" class='btn btn-primary'>Editar</a>
                </td>
            </tr>
            @empty
            <tr>
                <td>
                    Nenhum produto cadastrado
                </td>
            </tr>
            @endforelse

        </table>
    </div>
</div>
@endsection
