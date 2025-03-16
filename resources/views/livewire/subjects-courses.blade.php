<div>
    {{-- $this->productInfolist --}}

    @if(Route::is('courses'))
        @include('components.header')
    @endif

    <div class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center mb-5">
                <h2 class="text-3xl font-bold font-serif text-indigo-600 md:text-4xl">
                    All the skills you need in one place
                </h2>
                <p class="mt-2 text-lg leading-8 text-gray-500">From critical skills to technical topics, Eduk
                    supports your professional development.</p>

                {{-- <div class="flex justify-center space-x-4 mt-5">
                    <span
                        class="inline-block bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-4 py-2 rounded-full">Computer
                        Science</span>
                    <span
                        class="inline-block bg-green-100 text-green-800 text-sm font-medium mr-2 px-4 py-2 rounded-full">History</span>
                    <span
                        class="inline-block bg-red-100 text-red-800 text-sm font-medium mr-2 px-4 py-2 rounded-full">Personality
                        Development</span>
                    <span
                        class="inline-block bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-4 py-2 rounded-full">Dance</span>
                    <span
                        class="inline-block bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-4 py-2 rounded-full">History</span>
                </div> --}}
            </div>

            <div class="border-b pb-6">
                <nav class="flex flex-row flex-wrap gap-3 justify-center">
                    @foreach ($subjects as $subject)
                        <span
                            class="inline-block border text-green-600 text-sm font-medium mr-2 px-4 py-2 rounded-full">{{ $subject }}</span>
                        {{-- <p
                            class="whitespace-nowrap text-sm font-medium text-gray-500 border border-gray-200 px-3 py-1 rounded-2xl">
                            {{ $subject }}
                        </p> --}}
                    @endforeach
                </nav>
            </div>

            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-4">
                @foreach ($courses as $course)
                    <div class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white">
                        <div class="aspect-h-4 aspect-w-3 bg-gray-200 sm:aspect-none group-hover:opacity-75">
                            <img src="{{ asset('/storage/' . $course->thumbnail) }}" alt="{{ $course->name }}"
                                class="w-full object-cover object-center sm:w-full">
                        </div>
                        <div class="flex flex-1 flex-col space-y-2 p-4">
                            <h3 class="text-lg font-bold text-gray-900">
                                <a href="{{ route('course.show', $course->id) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $course->name }}
                                </a>
                            </h3>
                            <div class="text-gray-600 text-sm">
                                {!! $course->description !!}
                            </div>

                            <div class="flex flex-1 flex-col justify-end">
                                <p class="text-sm text-gray-400 mb-4">Published
                                    {{ $course->updated_at->diffForHumans() }}
                                </p>
                                @if ($course->price)
                                    @if ($course->striked_price)
                                        <div class="flex gap-2 items-center">
                                            <h3 class="text-2xl text-green-600 font-bold">₹
                                                {{ $course->price }}</h3>
                                            <h3 class="text-xl text-red-500 line-through">₹
                                                {{ $course->striked_price }}

                                            </h3>
                                        </div>
                                    @else
                                        <h3 class="text-2xl font-bold">₹ {{ $course->price }}</h3>
                                    @endif

                                    {{-- <p class="text-base font-medium text-gray-900 mt-2">₹ {{ $course->price }}</p> --}}
                                @endif
                            </div>
                        </div>
                    </div>

                    <article class="flex flex-col items-start justify-between hidden">
                        <div class="relative w-full">
                            <img src="{{ asset('/storage/' . $course->thumbnail) }}" alt=""
                                class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                        </div>
                        <div class="max-w-xl">
                            <div class="mt-8 flex items-center gap-x-4 text-xs">
                                <time datetime="2020-03-16"
                                    class="text-gray-500">{{ $course->updated_at->diffForHumans() }}</time>
                                <a href="#"
                                    class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ $course->related_subject }}</a>
                            </div>
                            <div class="group relative">
                                <h3
                                    class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                    <a href="#">
                                        <span class="absolute inset-0"></span>
                                        {{ $course->name }}
                                    </a>
                                </h3>
                                <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{ $course->description }}
                                </p>
                                <h5 class="font-semibold">₹499</h5>
                            </div>
                            <!--
                            <div class="relative mt-8 flex items-center gap-x-4">
                                <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-10 w-10 rounded-full bg-gray-100">
                                <div class="text-sm leading-6">
                                    <p class="font-semibold text-gray-900">
                                        <a href="#">
                                            <span class="absolute inset-0"></span>
                                            Michael Foster
                                        </a>
                                    </p>
                                    <p class="text-gray-600">Co-Founder / CTO</p>
                                </div>
                            </div>
                            -->
                        </div>
                    </article>
                @endforeach
                <!-- More posts... -->
            </div>
        </div>
    </div>

    @if(Route::is('courses'))
        @include('components.footer')
    @endif

</div>
