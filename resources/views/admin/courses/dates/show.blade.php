@extends('admin.layouts.main')
@section('content')
<div class="flex min-h-screen w-full bg-gray-100">
    <navbar></navbar>
    <course-date :course-date="{{ $courseDate }}"></course-date>
</div>
@endsection