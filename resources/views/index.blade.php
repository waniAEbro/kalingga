@extends('layouts.layout')

@section('content')
    @push('head')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            /* span.select2.select2-container.select2-container--classic {
                        width: 100% !important;
                    } */
        </style>
    @endpush

    <div class="text-4xl font-bold">Halo ini dashboard</div>
    <select class="p-2 js-example-basic-single bg-slate-200" name="Framework">
        <option value="CakePHP">Cake PHP</option>
        <option value="Laravel">Laravel</option>
        <option value="Symphony">Symphony</option>
    </select>

    @push('script')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2({
                    theme: "classic"
                });
            });
        </script>
    @endpush
@endsection
