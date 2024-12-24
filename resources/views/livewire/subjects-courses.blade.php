<div>
    {{-- $this->productInfolist --}}

    <div class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center mb-10">
                <h2 class="text-3xl font-bold text-indigo-600 sm:text-4xl font-serif">All the skills you need in one place
                </h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">From critical skills to technical topics, Educult supports your professional development.</p>
            </div>

            <div class="border-b pb-6">
                <nav class="flex flex-row flex-wrap gap-6 justify-center">
                    @foreach ($subjects as $subject)
                        <p class="whitespace-nowrap text-sm font-medium text-gray-500 border border-gray-200 px-3 py-1 rounded-2xl">
                            {{ $subject }}
                        </p>
                    @endforeach
                </nav>
            </div>

            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-4">
                @foreach($courses as $course)

                    <div class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white">
                        <div class="aspect-h-4 aspect-w-3 bg-gray-200 sm:aspect-none group-hover:opacity-75 sm:h-96">
                            <img src="{{ asset('/storage/' . $course->thumbnail) }}" alt="{{ $course->name }}" class="h-full w-full object-cover object-center sm:h-full sm:w-full">
                        </div>
                        <div class="flex flex-1 flex-col space-y-2 p-4">
                            <h3 class="text-sm font-bold text-gray-900">
                                <a href="{{ route('course.show', $course->id) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $course->name }}
                                </a>
                            </h3>
                            <div class="text-gray-600 text-sm">
                                {!! $course->description !!}
                            </div>

                            <div class="flex flex-1 flex-col justify-end">
                                <p class="text-sm text-gray-400">Published {{ $course->updated_at->diffForHumans() }}</p>
                                @if($course->price) <p class="text-base font-medium text-gray-900 mt-2">₹ {{ $course->price }}</p> @endif
                            </div>
                        </div>
                    </div>

                    <article class="flex flex-col items-start justify-between hidden">
                        <div class="relative w-full">
                            <img src="{{ asset('/storage/' . $course->thumbnail) }}" alt="" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                        </div>
                        <div class="max-w-xl">
                            <div class="mt-8 flex items-center gap-x-4 text-xs">
                                <time datetime="2020-03-16" class="text-gray-500">{{ $course->updated_at->diffForHumans() }}</time>
                                <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ $course->related_subject }}</a>
                            </div>
                            <div class="group relative">
                                <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                    <a href="#">
                                        <span class="absolute inset-0"></span>
                                        {{ $course->name }}
                                    </a>
                                </h3>
                                <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{ $course->description }}</p>
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

</div>
