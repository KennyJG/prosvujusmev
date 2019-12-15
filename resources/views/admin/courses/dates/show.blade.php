@extends('admin.layouts.main')
@section('content')
<div class="flex min-h-screen w-full bg-gray-100">
    <navbar></navbar>
    <course-date :course-date="{{ $courseDate }}" :back-url="{{ $backUrl }}"></course-date>
</div>
@endsection