@extends('layouts.home')

@section('content')
    <main class="grow">
        <!-- Timeline -->
        <section>
            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="py-12 md:py-20">

                    <!-- Section header -->
                    <div class="max-w-3xl mx-auto text-center pb-12 md:pb-20">
                        <h2 class="h2 mt-8">👋 Welcome back!</h2>
                    </div>

                    <!-- Items -->
                    <div class="max-w-3xl mx-auto -my-4 md:-my-6" data-aos-id-timeline>
                        <div class="rounded-lg bg-white border border-4 border-indigo-200">
                            <div class="px-6 py-8 bg-purple-500 text-white text-lg font-bold">
                                Workspaces for {{ Auth::user()->email }}
                            </div>
                            <div class="p-4 flex flex-col gap-8">
                                @foreach ($tenants as $tenant)
                                    <div class="flex flex-row justify-between border-slate-400">
                                        <div class="flex flex-row gap-4">
                                            <img src="https://ui-avatars.com/api/?name={{ $tenant->company }}"
                                                class="h-12 w-12 bg-red-500 rounded-lg">
                                            <div>
                                                <div>
                                                    <h1 class="font-black text-black text-md">{{ $tenant->company }}</h1>
                                                </div>
                                                {{-- <span class="text-slate-400 text-sm1">36 members</span> --}}
                                            </div>
                                        </div>

                                        <a href="{{ url(route('redirect-user-to-tenant', ['globalUserId' => auth()->user()->global_id, 'tenant' => $tenant])) }}"
                                            class="btn text-white bg-purple-600">Open</a>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>



        <section class="relative">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 relative">
                <div class="pt-16 md:pt-16 border-t border-gray-800">

                    <!-- Page header -->
                    <div class="max-w-3xl mx-auto text-center pb-12 md:pb-16">
                        <h1 class="h1 mb-4" data-aos="fade-up">Create a workspace</h1>
                        <p class="text-xl text-gray-400" data-aos="fade-up" data-aos-delay="200">Start your journey with us
                            at Impak now.</p>
                    </div>

                    @if ($errors->any())
                        <div class="max-w-xl mx-auto mb-4 bg-red-400 p-4 rounded-sm font-medium">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Contact form -->
                    <form class="max-w-xl mx-auto" action="{{ route('create-company') }}" method="POST">
                        @csrf
                        <div class="flex flex-wrap -mx-3 mb-4">
                            <div class="w-full px-3">
                                <label class="block text-gray-300 text-sm font-medium mb-1" for="subject">Company Name
                                    <span class="text-red-600">*</span></label>
                                <input id="company" name="company" type="text" class="form-input w-full text-gray-300"
                                    placeholder="acme" required />
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mt-6">
                            <div class="w-full px-3">
                                <button class="btn text-white bg-purple-600 hover:bg-purple-700 w-full">Create</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </section>
    </main>
@endsection
