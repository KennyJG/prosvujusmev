@extends('admin.layouts.main')
@section('content')
<div class="flex min-h-screen w-full bg-gray-100">
    <navbar></navbar>
    <course-create></course-create>
</div>
{{-- <div class="flex min-h-screen w-full bg-gray-100">
    <navbar></navbar>
    <div class="h-screen w-full bg-gray-100">
        <div class="flex-grow w-full pt-4 pb-8 pr-4">
            <div class="bg-white border-t border-b sm:border-l sm:border-r sm:rounded shadow mb-4">
                <div class="w-full h-full p-4">
                    <div class="w-full border-b pb-2 flex items-end justify-between">
                        <div class="text-3xl">Kurzy</div>
                        <a class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded"
                            href="/admin/courses">ZPĚT
                        </a>
                    </div>
                    <div class="w-full h-full mt-4 overflow-scroll">
                        <form method="POST" action="/admin/courses">
                            @csrf
                            <div class="-mx-3 md:flex mb-2">
                                <div class="md:w-full px-3">
                                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="name">
                                        Název
                                    </label>
                                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="name" type="text" name="name" required>
                                </div>
                            </div>

                            <div class="-mx-3 md:flex mb-2">
                                <div class="md:w-full px-3">
                                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="description">
                                        Popis
                                    </label>
                                    <textarea class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="description" name="description"></textarea>
                                </div>
                            </div>

                            <div class="sm:float-right sm:w-auto w-full">
                                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded">
                                    Vytvořit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection