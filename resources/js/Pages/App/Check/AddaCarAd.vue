<template>
    <section class="font-notosans min-h-screen text-red-500">
        <div class="text-3xl font-extrabold container mx-auto py-3 px-2">
            <inertia-link href="/">Yallasell</inertia-link>
        </div>

        <section class="text-gray-800 bg-red-50 min-h-screen">
            <div class="text-center font-semibold text-xl py-10 ">
                {{ __("Now you can sell your car in two different ways") }}
            </div>

            <div
                class="container mx-auto grid grid-cols-1 gap-4 px-2 md:px-28 rounded"
            >
                <div class="bg-white px-5 py-4 space-y-4 text-sm font-light">
                    <h5 class="text-xl font-medium">
                        {{ __("Sell yourself on Yallasell") }}
                    </h5>
                    <div class="list">
                        {{ __("Biggest chance to get paid the most") }}
                    </div>
                    <div class="list">
                        {{ __("Free digital purchase contract") }}
                    </div>
                    <div class="list">
                        {{ __("Use Block payment for a secure transaction") }}
                    </div>
                    <div class="text-center">
                        <inertia-link
                            href="/post-ad?c=1"
                            as="button"
                            class="bg-bg2 w-full py-3 rounded-md text-white mt-2"
                            >{{ __("Sell the car privately") }}</inertia-link
                        >
                    </div>
                </div>
                <!-- <div class="bg-white px-5 py-4 space-y-4 text-sm font-light">
          <h5 class="text-xl font-medium">
            {{ __("Bily sells for you") }}
          </h5>
          <div class="list">
            {{ __("Let car dealers place bids on your car") }}
          </div>
          <div class="list">{{ __("Bily handles all sales for you") }}</div>
          <div class="list">
            {{ __("Avoid liability for complaints") }}
          </div>
          <div class="text-center">
            <inertia-link href="" as="button" class="w-full py-3 rounded-md mt-2 border-2 border-gray-400">{{
              __("Sell the car to a car dealer")
            }}</inertia-link>
            <p class="text-xs font-extralight tracking-wide">{{ __('Iraqi registration number required') }}</p>
          </div>
        </div> -->
            </div>
        </section>
    </section>
</template>

<style scoped>
.list::before {
    content: "✓";
    font-size: 25px;
    color: rgb(73, 185, 117);
}
</style>
