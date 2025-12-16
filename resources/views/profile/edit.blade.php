@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <x-profile.edit.edit-data-form />
        <x-profile.edit.change-password-form />
        <x-profile.edit.delete-account-form />
    </div>
</div>
@endsection
