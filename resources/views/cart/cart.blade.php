@extends('layouts.user')
@section('home')
@livewire('cart-component', ['isCartPage' => true])
@endsection