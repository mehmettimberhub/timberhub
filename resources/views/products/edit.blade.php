@extends('layout.app')
@section('title')
    <h1 class="h2">Create Supplier</h1>
@endsection
@section('content')
    @livewire('product.product-form', ['product' => $product])
@endsection
