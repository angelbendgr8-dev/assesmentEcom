<div>
    <div class="w-[70%] mx-auto h-full">
        <h1 class="text-center font-bold text-3xl text-gray-500 my-20">
            Your Cart
        </h1>
        <div class="flex flex-col w-[70%] mx-auto">
            <div class=" sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-center text-sm font-light">
                            <thead class="border-b bg-white font-medium dark:border-neutral-500 dark:bg-neutral-600">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Product</th>
                                    <th scope="col" class="px-6 py-4">Price</th>
                               </tr>
                            </thead>
                            <tbody>

                                @forelse ($items as $item)
                                <tr class="border-b bg-neutral-100 dark:border-neutral-500 ">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{$item->product->name}}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$item->product->price}}</td>

                                </tr>

                                @empty
                                <tr>
                                    <td colspan="2">you have no cart items</td>

                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!----Check out section-->
    <div class="flex flex-col space-y-2 justify-center items-center w-[70%] mx-auto my-10">

        <button
            wire:click='CheckOut'
            class="px-20 py-2 border-solid border-2 border-gray-500 hover:bg-gray-500 hover:text-white text-gray-500">
            <div class="flex flex-row space-x-1 items-center justify-center">
                <p class="font-semibold">
                    Check Out
                </p>
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    stroke="#c0c0c0">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12.2929 4.29289C12.6834 3.90237 13.3166 3.90237 13.7071 4.29289L20.7071 11.2929C21.0976 11.6834 21.0976 12.3166 20.7071 12.7071L13.7071 19.7071C13.3166 20.0976 12.6834 20.0976 12.2929 19.7071C11.9024 19.3166 11.9024 18.6834 12.2929 18.2929L17.5858 13H4C3.44772 13 3 12.5523 3 12C3 11.4477 3.44772 11 4 11H17.5858L12.2929 5.70711C11.9024 5.31658 11.9024 4.68342 12.2929 4.29289Z"
                            fill="#c0c0c0"></path>
                    </g>
                </svg>
            </div>


        </button>
        <a href="{{route('index')}}"
            class="px-12 py-2 bg-gray-500 hover:bg-white hover:text-gray-500 hover:border-2 hover:border-gray-500  text-white">
            <div class="flex flex-row space-x-1 itemcs-center justify-center">
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    stroke="#00">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M11.7071 4.29289C12.0976 4.68342 12.0976 5.31658 11.7071 5.70711L6.41421 11H20C20.5523 11 21 11.4477 21 12C21 12.5523 20.5523 13 20 13H6.41421L11.7071 18.2929C12.0976 18.6834 12.0976 19.3166 11.7071 19.7071C11.3166 20.0976 10.6834 20.0976 10.2929 19.7071L3.29289 12.7071C3.10536 12.5196 3 12.2652 3 12C3 11.7348 3.10536 11.4804 3.29289 11.2929L10.2929 4.29289C10.6834 3.90237 11.3166 3.90237 11.7071 4.29289Z"
                            fill="#c0c0c0"></path>
                    </g>
                </svg>

                <p  class="font-semibold">
                    Back to All Product
                </p>
            </div>


        </a>

    </div>
</div>
