<div class="min-h-full">

    @push('meta_description')
        <meta property="og:site_name" content="{{ config('app.name', '') }}" />
        <meta property="og:title" content="{{ $course->name }} | {{ config('app.name', '') }}" />
        <meta property="og:description" content="{{ $course->description }}" />
        <meta property="og:url" content="{{ route('course.show', [$course->id, $chapter->id]) }}" />
        <meta property="og:image" content="{{ asset('/storage/' . $course->thumbnail) }}" />
    @endpush

    <header>
        <nav class="border-b flex flex-row justify-between items-center py-3 px-6">
            <div>
                <a href="{{ route('welcome') }}">
                    {{-- @include('filament.app.logo') --}}
                    <img class="h-8 ml-2" src="{{ asset('/images/logo.webp') }}">
                </a>
            </div>
            <div class="flex flex-row items-center space-x-4">
                <div class="hidden md:flex">
                    <livewire:search></livewire:search>
                </div>
                @guest
                    <a href="{{ route('filament.account.auth.login') }}"
                        class="text-sm font-semibold leading-6 text-gray-900">Log in <span
                            aria-hidden="true">&rarr;</span></a>
                @else
                    <a href="{{ route('filament.account.home') }}"
                        class="text-sm font-semibold leading-6 text-gray-900">Account <span
                            aria-hidden="true">&rarr;</span></a>
                @endguest
            </div>
        </nav>
    </header>

    <main>
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:max-w-7xl lg:px-8 py-8">
            <h1 class="sr-only">Page title</h1>
            <!-- Main 3 column grid -->
            <div class="grid grid-cols-1 items-start gap-4 lg:grid-cols-3 lg:gap-8">
                <!-- Left column -->

                <div class="grid grid-cols-1 gap-4 lg:col-span-2">

                    @if ($has_purchased || $course_locked == false)
                        <section aria-labelledby="section-1-title">
                            <h2 class="sr-only" id="section-1-title">Chapter</h2>
                            <div class="overflow-hidden rounded-lg bg-white shadow">
                                <!-- Your content -->

                                @if ($chapter)
                                    {!! $chapter->video_iframe !!}
                                    <div class="p-6">
                                        <h1 class="py-4 text-green-600 font-semibold text-2xl">{{ $chapter->name }}</h1>
                                        <div class="prose text-sm">{!! str($chapter->description)->sanitizeHtml() !!}</div>
                                    </div>
                                @else
                                    <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-yellow-700">
                                                    No chapters found for this course.
                                                    <a href="{{ route('courses') }}"
                                                        class="font-medium text-yellow-700 underline hover:text-yellow-600">See
                                                        courses.</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <ul role="list" class="space-y-6 px-6">

                                    @foreach ($comments as $chapter_comment)
                                        <li class="relative flex gap-x-4">
                                            {{-- <div class="absolute -bottom-6 left-0 top-0 flex w-6 justify-center">
                                            <div class="w-px bg-gray-200"></div>
                                        </div> --}}
                                            {{-- <x-filament::avatar
                                            src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt=""
                                            size="sm"
                                        />
                                        <img
                                            src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt="" class="relative mt-3 h-6 w-6 flex-none rounded-full bg-gray-50"> --}}
                                            <div class="flex-auto rounded-md p-3 ring-1 ring-inset ring-gray-200">
                                                <div class="flex justify-between gap-x-4">
                                                    <div class="py-0.5 text-xs leading-5 text-gray-500"><span
                                                            class="font-medium text-gray-900">{{ $chapter_comment->user->name }}</span>
                                                        commented
                                                    </div>
                                                    <time datetime="{{ $chapter_comment->updated_at }}"
                                                        class="flex-none py-0.5 text-xs leading-5 text-gray-500">
                                                        {{ $chapter_comment->updated_at->diffForHumans() }}
                                                    </time>
                                                </div>
                                                <p class="text-sm leading-6 text-gray-500">
                                                    {{ $chapter_comment->comment }}</p>
                                                @if ($chapter_comment->user_id == \Illuminate\Support\Facades\Auth::id())
                                                    <button class="mt-2"
                                                        wire:confirm="Do you want to delete this comment?"
                                                        wire:click="delete_comment({{ $chapter_comment }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>

                                <!-- New comment form -->
                                @if ($chapter)
                                    <div class="mt-6 flex gap-x-3 p-6">
                                        {{-- <img
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="" class="h-6 w-6 flex-none rounded-full bg-gray-50"> --}}
                                        <form wire:submit="post_comment" class="relative flex-auto">
                                            <div
                                                class="overflow-hidden rounded-lg pb-12 ring-1 ring-inset ring-gray-200 focus-within:ring-2 focus-within:ring-indigo-600">
                                                <textarea rows="3" wire:model="comment"
                                                    class="p-3 block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 outline-none"
                                                    placeholder="Add your comment..."></textarea>
                                            </div>

                                            <div class="absolute inset-x-0 bottom-0 flex justify-between p-3">
                                                <button type="submit"
                                                    class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                                    Comment
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endif

                                @error('comment')
                                    <div class="rounded-md bg-blue-50 p-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor"
                                                    aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3 flex-1 md:flex md:justify-between">
                                                <p class="text-sm text-blue-700">{{ $message }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @enderror

                                @if (session()->has('message'))
                                    <div class="rounded-md bg-green-50 p-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3 flex-1 md:flex md:justify-between">
                                                <p class="text-sm text-green-700">{{ session('message') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </section>
                    @else
                        <div class="rounded-md bg-yellow-50 p-4 border">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-5 text-yellow-700">
                                        <path fill-rule="evenodd"
                                            d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">Course is locked</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>Please purchase the course to access all the chapters.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right column -->
                <div class="grid grid-cols-1 gap-4">
                    <section>
                        <h2 class="sr-only">Right-column</h2>
                        <div class="overflow-hidden rounded-lg bg-white shadow">
                            <div>
                                <!-- Your content -->
                                <img src="{{ asset('/storage/' . $course->thumbnail) }}" alt="{{ $course->name }}">

                                <h2 class="px-3 py-3 text-xl font-semibold text-indigo-600 sm:text-2xl">
                                    {{ $course->name }}</h2>

                                <div class="prose p-3 text-sm text-gray-500">{!! str($course->description)->sanitizeHtml() !!}</div>
                                <p class="p-3 text-xs leading-7 text-gray-500 border-b">
                                    Published {{ $course->updated_at->diffForHumans() }}
                                </p>

                                @if ($course->price && !$has_purchased)
                                    <div class="flex justify-between px-3 py-3">
                                        <div>
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
                                        </div>

                                        <button type="button" onclick="initPayment(this)"
                                            class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Buy
                                            course</button>
                                    </div>
                                @endif

                                <div id="payment-success"
                                    class="flex flex-row gap-2 items-center bg-white border border-gray-200 rounded-lg overflow-hidden mt-4 mx-4 hidden">
                                    <img alt="" class="ml-2 w-6 h-6"
                                        src="{{ asset('/images/check-circle.svg') }}">
                                    <div class="py-3 px-1 text-sm">
                                        <h1 class="text-green-700 mb-1">Payment successful. Access to full course may
                                            take a few minutes.</h1>
                                        <a href="#" class="underline" onclick="location.reload()">Refresh
                                            page</a>
                                    </div>
                                </div>

                                <div id="payment-failed"
                                    class="hidden flex flex-row items-center bg-white border border-red-200 rounded-lg overflow-hidden mt-4 mx-4 py-3 px-4">
                                    <p class="text-red-700" id="payment-failed-description"></p>
                                    <!-- <h1 class="mx-3">Please try again.</h1> -->
                                </div>

                                {{--  <h2 class="p-3 font-semibold bg-indigo-50 mt-3">Chapters</h2> --}}
                                <ul>
                                    @foreach ($course->related_chapters as $related_chapter)
                                        <li>
                                            <a href="{{ route('course.show', [$course->id, $related_chapter->id]) }}">
                                                <p class="p-3 text-sm text-gray-700">{{ $related_chapter->name }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    @include('components.footer')

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        function initPayment(e) {
            var COURSE_ID = "{{ $course->id }}";
            e.disabled = true;

            axios.post('/api/create-razorpay-order-id', {
                    course_id: "{{ $course->id }}"
                }).then(order_id_response => {

                    //console.log(order_id_response)
                    e.disabled = false;
                    //document.getElementById('razorpay-button').disabled = false;

                    var options = {
                        "key": "{{ config('app.RAZORPAY_KEY', '') }}", // Enter the Key ID generated from the Dashboard
                        //"amount": "99900", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "INR",
                        "name": "{{ config('app.name') }}",
                        "description": "Purchase course.",
                        "image": "{{ asset('/images/logo.webp') }}",
                        "order_id": order_id_response
                            .data, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        "handler": function(response) {
                            /*alert(response.razorpay_payment_id);
                            alert(response.razorpay_order_id);
                            alert(response.razorpay_signature)*/

                            //console.log('success ', response)

                            var payment_success_element = document.getElementById('payment-success')
                            payment_success_element.classList.remove('hidden')

                            document.getElementById('payment-failed').classList.add('hidden');

                            axios.post('/api/verify-razorpay-payment', {
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_signature: response.razorpay_signature,
                                course_id: COURSE_ID
                            }).then(verification_response => {

                            });
                        },
                        "theme": {
                            "color": "#5145CD"
                        }
                    };
                    var razorpay = new Razorpay(options);
                    razorpay.on('payment.failed', function(failed_response) {
                        /*
                        alert(response.error.code);
                        alert(response.error.description);
                        alert(response.error.source);
                        alert(response.error.step);
                        alert(response.error.reason);
                        alert(response.error.metadata.order_id);
                        alert(response.error.metadata.payment_id);
                        */

                        document.getElementById('payment-failed').classList.remove('hidden');
                        document.getElementById('payment-failed-description').innerText = failed_response.error
                            .description

                        document.getElementById('payment-success').classList.add('hidden');
                    });

                    razorpay.open();
                    e.preventDefault();
                })
                .catch(function(error) {
                    if (error.response) {
                        /* console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers); */

                        //document.getElementById('razorpay-button').disabled = false;
                        e.disabled = false

                        if (error.response.status === 401) {
                            location.href = "{{ route('filament.account.auth.login') }}"
                        }
                    }
                });
        }
    </script>
</div>
