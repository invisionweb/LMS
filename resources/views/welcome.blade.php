<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('/images/favicon.webp') }}">

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */
        </style>
    @endif

    <style>
        .swiper {
            width: 100%;
            height: auto;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>


    <div class="bg-white">
        {{-- tailwind ui nav --}}

        @include('components.header')

        {{-- tailwind ui nav end --}}

        <div class="py-2 gap-4 flex justify-center items-center bg-slate-50">
            <h1 class="text-4xl py-4 font-bold text-blue-700 sm:text-4xl font-sans-serif tracking-tight">A new
                way of online learning.</h1>
        </div>
        <div class="py-2 gap-4 flex justify-center items-center bg-slate-50">
            <h3 class="font-medium">Explore our courses</h1>
                <livewire:search></livewire:search>
        </div>



        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="{{ asset('images/homepage/sample thumbnail.jpeg') }}"
                        alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('images/homepage/sample thumb 2.jpeg') }}" alt="">
                </div>
                {{-- <div class="swiper-slide"><img
                        src="https://img.freepik.com/free-vector/online-learning-landing-page-template_23-2148908467.jpg"
                        alt=""></div> --}}

            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>

        <!-- Swiper JS -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var swiper = new Swiper(".mySwiper", {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    // effect: "fade",
                    loop: true,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
            });
        </script>

        <div class="my-8">
            <livewire:subjects-courses></livewire:subjects-courses>
        </div>

        <div class="relative">
            <div class="mx-auto max-w-7xl">
                <div class="relative z-10 pt-14 lg:w-full lg:max-w-2xl">

                    <div class="relative px-6 py-32 sm:py-40 lg:px-8 lg:py-28 lg:pr-0">
                        <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl">

                            <h1 class="text-4xl font-bold text-green-500 sm:text-6xl font-sans-serif tracking-tight">
                                The All-in-One Skill Development Platform</h1>
                            <p class="mt-6 text-lg leading-8 text-gray-600 font-serif">From critical skills to
                                technical
                                topics, We support your professional development.</p>
                            <div class="hidden sm:mb-10 sm:flex mt-4">
                                <div
                                    class="relative rounded-full border-2 px-3 py-2 text-md leading-6 text-gray-500 ring-1 ring-indigo-900/10 hover:ring-gray-900/20">
                                    Check out our latest courses.
                                    {{-- <a href="{{ route('courses') }}"
                                        class="whitespace-nowrap font-semibold text-indigo-600"><span
                                            class="absolute inset-0" aria-hidden="true"></span>Know more <span
                                            aria-hidden="true">&rarr;</span></a> --}}
                                </div>
                            </div>

                            {{-- <div class="my-4">
                                <livewire:search></livewire:search>
                            </div> --}}

                            <!--
                                    <div class="mt-10 flex items-center gap-x-6">
                                        <a href="#" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get started</a>
                                        <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Learn more <span aria-hidden="true">→</span></a>
                                    </div>
                                    -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                {{-- <img class="object-cover" src="{{ asset('/images/undraw_learning-sketchingsh.svg') }}"
                    alt=""> --}}
                <img src="https://img.freepik.com/free-vector/learning-concept-illustration_114360-6186.jpg">
            </div>
        </div>
    </div>

    <div class="overflow-hidden bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div
                class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <div class="lg:pr-8 lg:pt-4">
                    <div class="lg:max-w-lg">
                        <h2 class="text-base font-semibold leading-7 text-indigo-600">Smart learning</h2>
                        <p class="mt-2 text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">A
                            better way</p>
                        <p class="mt-6 text-lg leading-8 text-gray-600">A user-friendly e-learning platform offering
                            diverse courses, interactive content, and flexible learning schedules. Learn at your own
                            pace, gain valuable skills, and earn certifications to advance your education or career.</p>
                        <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-gray-600 lg:max-w-none">
                            <div class="relative pl-9">
                                <dt class="inline font-semibold text-gray-900">
                                    <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M5.5 17a4.5 4.5 0 0 1-1.44-8.765 4.5 4.5 0 0 1 8.302-3.046 3.5 3.5 0 0 1 4.504 4.272A4 4 0 0 1 15 17H5.5Zm3.75-2.75a.75.75 0 0 0 1.5 0V9.66l1.95 2.1a.75.75 0 1 0 1.1-1.02l-3.25-3.5a.75.75 0 0 0-1.1 0l-3.25 3.5a.75.75 0 1 0 1.1 1.02l1.95-2.1v4.59Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Wide Range of Resources and Interactivity.
                                </dt>
                                <dd class="inline">E-learning platforms provide multimedia resources such as videos,
                                    quizzes, interactive simulations, and forums to enhance learning.</dd>
                            </div>
                            <div class="relative pl-9">
                                <dt class="inline font-semibold text-gray-900">
                                    <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Cost-Effectiveness.
                                </dt>
                                <dd class="inline">E-learning eliminates expenses associated with travel, physical
                                    materials, and infrastructure.</dd>
                            </div>
                            <div class="relative pl-9">
                                <dt class="inline font-semibold text-gray-900">
                                    <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path
                                            d="M4.632 3.533A2 2 0 0 1 6.577 2h6.846a2 2 0 0 1 1.945 1.533l1.976 8.234A3.489 3.489 0 0 0 16 11.5H4c-.476 0-.93.095-1.344.267l1.976-8.234Z" />
                                        <path fill-rule="evenodd"
                                            d="M4 13a2 2 0 1 0 0 4h12a2 2 0 1 0 0-4H4Zm11.24 2a.75.75 0 0 1 .75-.75H16a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75h-.01a.75.75 0 0 1-.75-.75V15Zm-2.25-.75a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75H13a.75.75 0 0 0 .75-.75V15a.75.75 0 0 0-.75-.75h-.01Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Flexibility and Accessibility.
                                </dt>
                                <dd class="inline">Learners can access courses and materials at their convenience,
                                    making it possible to balance education with work, family, or other commitments.
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
                {{-- <img src="{{ asset('/images/undraw_online-learning_tgmv.svg') }}"> --}}
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img
                                src="https://img.freepik.com/free-vector/online-certification-illustration_23-2148575637.jpg"
                                alt="Image 1"></div>
                        <div class="swiper-slide"><img
                                src="https://img.freepik.com/free-vector/flat-background-with-different-learning-elements_23-2147596298.jpg"
                                alt="Image 2"></div>
                        <div class="swiper-slide"><img
                                src="https://img.freepik.com/free-vector/e-learning-interactions-illustration-concept_114360-23713.jpg"
                                alt="Image 3"></div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="mx-auto max-w-7xl py-20 sm:px-6 lg:px-8">
        <div class="relative isolate overflow-hidden px-6 py-16 text-center border sm:rounded-3xl sm:px-16">
            <h2 class="mx-auto max-w-2xl text-3xl font-bold font-serif text-indigo-500 sm:text-4xl">Boost your
                productivity today.</h2>
            <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-600">A user-friendly e-learning platform
                offering diverse courses, interactive content, and flexible learning schedules. Learn at your own pace,
                gain valuable skills to advance your education or career.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="{{ route('courses') }}"
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Start
                    learning</a>
                {{-- <a href="#" class="text-sm font-semibold leading-6 text-white">Courses <span aria-hidden="true">→</span></a> --}}
            </div>
        </div>
    </div>


    @include('components.footer')

</body>

</html>
