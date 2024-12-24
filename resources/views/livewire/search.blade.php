<div class="max-w-md lg:min-w-96">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="flex px-4 py-3 rounded-md border border-indigo-500 overflow-hidden max-w-md mx-auto font-[sans-serif]">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px"
                 class="fill-gray-600 mr-3 rotate-90">
                <path
                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                </path>
            </svg>
            <input wire:model.live="search" type="search" placeholder="Search courses, topics..." class="w-full outline-none bg-transparent text-gray-600" />
        </div>

        {{-- <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-md text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>--}}
    </div>

    <div>
        <div class="relative mt-0.5">

            @if(count($this->search_results) > 0)
            <ul class="absolute z-10 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" role="listbox">
                <!--
                  Combobox option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                  Active: "text-white bg-indigo-600", Not Active: "text-gray-900"
                -->

                @foreach ($this->search_results as $search_result)

                    <li class="relative cursor-default select-none text-gray-700 hover:bg-gray-100" role="option" tabindex="-1">
                        <!-- Selected: "font-semibold" -->
                        <a href="{{ route('course.show', $search_result->id) }}" class="block truncate py-2 px-3">{{ $search_result->name }}</a>

                        <!--
                          Checkmark, only display for selected option.

                          Active: "text-white", Not Active: "text-indigo-600"
                        -->
                    </li>

                @endforeach

                <!-- More items... -->
            </ul>
            @endif
        </div>
    </div>

</div>
