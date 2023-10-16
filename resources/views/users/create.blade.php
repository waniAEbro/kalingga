@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create User</h1>

    <x-create-input-field :action="'users'" :width="'w-full'">
        <div class="flex w-full gap-3">
            <div class="flex-1">
                <x-input name="name" :label="'Nama Pengguna'" :placeholder="'name'" :type="'text'" :inputParentClass="'mb-3'"
                    :value="old('name')" />
            </div>
            <div class="flex-1">
                <x-input name="email" :label="'Email'" :placeholder="'email'" :type="'email'" :inputParentClass="'mb-3'"
                    :value="old('email')" />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input name="password" :label="'Password'" :placeholder="'password'" :type="'password'" :inputParentClass="'mb-3'"
                     />
            </div>
        </div>
    </x-create-input-field>
@endsection
