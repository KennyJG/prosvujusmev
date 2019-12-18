@extends('admin.layouts.main')
@section('content')
<div class="flex min-h-screen w-full bg-gray-100">
    <navbar></navbar>
    <reservation :reservation="{{ $reservation }}" :back-url="{{ $backUrl }}"></reservation>
</div>
@endsection