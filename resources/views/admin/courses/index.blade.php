@extends('admin.layouts.main')
@section('content')
<div class="flex min-h-screen w-full bg-gray-100">
    <navbar></navbar>
    <courses-list :courses="{{ $courses }}"></courses-list>
</div>
@endsection