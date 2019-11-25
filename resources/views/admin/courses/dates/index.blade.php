@extends('admin.layouts.main')
@section('content')
<div class="container flex min-h-screen w-full bg-gray-100">
    <navbar></navbar>
    <course-dates-list :course-dates="{{ $courseDates }}"></course-dates-list>
</div>
@endsection