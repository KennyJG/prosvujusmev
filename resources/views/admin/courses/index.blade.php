@extends('admin.layouts.main')
@section('content')
<div class="container flex min-h-screen w-full bg-gray-100">
    <navbar></navbar>
    <div class="h-full w-full">
        <div class="w-full h-12 bg-gray-200">
        </div>
        <div class="w-full h-full p-6">
            <div class="w-full border-b pb-2 flex items-end justify-between">
                <div class="text-3xl">Kurzy</div>
                <a class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded"
                    href="/admin/courses/create">Přidat
                </a>
            </div>
            <div class="w-full h-full mt-6">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th class="px-2 py-2 text-left">Jméno</th>
                            <th class="px-2 py-2 text-right">Akce</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr class="{{$loop->even ? 'bg-gray-200' : ''}}">
                                <td class="border border-r-0 px-4 py-2">{{ $course->name }}</td>
                                <td class="border border-l-0 px-4 py-4 text-right">
                                    <div class="inline-flex">
                                        <a href="/admin/courses/{{ $course->id }}/edit" class="{{$loop->even ? 'bg-gray-100' : 'bg-gray-300'}} hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                                            Editovat
                                        </a>
                                        <a @click="showModal('blablab', 'asdfasdf', 'asdfasdfsaf', 'adsfasdf')" href="#" class="{{$loop->even ? 'bg-gray-100' : 'bg-gray-300'}} hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
                                            Odstranit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <confirmation-modal></confirmation-modal>
            </div>
        </div>
    </div>
</div>
@endsection