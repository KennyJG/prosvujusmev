@extends('admin.layouts.main')
@section('content')
<div class="flex min-h-screen w-full bg-gray-100">
    <navbar></navbar>
    <div class="h-full w-full">
        <div class="w-full h-12 bg-gray-100">
        </div>
        <div class="w-full h-full p-6">
            <div class="w-full border-b pb-2 flex items-end justify-between">
                <div class="text-3xl">Termíny</div>
                <a class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded"
                    href="/admin/course-dates">ZPĚT
                </a>
            </div>
            <div class="rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                    <p class="font-bold">Termín se nepodařilo vytvořit</p>
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <form class="mt-8" method="POST" action="/admin/course-dates/{{ $courseDate->id }}">
                    @csrf
                    <input type="hidden" name="_method" value="put" />
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="course_id">
                                Kurz
                            </label>
                            <div class="inline-block relative w-full mb-3">
                                <select class="block appearance-none w-full bg-white border border-grey-lighter hover:border-gray-500 px-4 py-3 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline" name="course_id">
                                    @foreach ($courses as $course)
                                    <option {{ $courseDate->course_id === $course->id ? 'selected' : '' }} value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-1/4 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="from_date_date">
                                Datum začátku
                            </label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="from_date_date" type="date" name="from_date_date" value="{{ $courseDate->from_date->format('Y-m-d') }}" required>
                        </div>
                        <div class="md:w-1/4 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="from_date_time">
                                Čas začátku
                            </label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="from_date_time" type="time" name="from_date_time" value="{{ $courseDate->from_date->format('H:i:s') }}" required>
                        </div>
                        <div class="md:w-1/4 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="to_date_date">
                                Datum konce
                            </label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="to_date_date" type="date" name="to_date_date" value="{{ $courseDate->to_date->format('Y-m-d') }}" required>
                        </div>
                        <div class="md:w-1/4 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="to_date_time">
                                Čas konce
                            </label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="to_date_time" type="time" name="to_date_time" value="{{ $courseDate->to_date->format('H:i:s') }}" required>
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="venue">
                                Místo konání
                            </label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="venue" type="text" name="venue" value="{{ $courseDate->venue }}" required>
                        </div>
                        <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="lecturer">
                                Lektor
                            </label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="lecturer" type="text" name="lecturer" value="{{ $courseDate->lecturer }}">
                        </div>
                        <div class="md:w-1/3 px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="limit">
                                Maximální počet míst
                            </label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="limit" type="number" min="1" name="limit" value="{{ $courseDate->limit }}" required>
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="description">
                                Popis
                            </label>
                            <textarea class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" id="description" type="text" name="description" rows="4">{{ $courseDate->description }}</textarea>
                        </div>
                    </div>

                    <div class="sm:float-right sm:w-auto w-full">
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded">
                            Upravit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection