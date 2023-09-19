@extends('layouts.layout')

@section('content')
    <x-create-input-field :action="'components'">

        <x-select-with-search-ori />

    </x-create-input-field>
@endsection
