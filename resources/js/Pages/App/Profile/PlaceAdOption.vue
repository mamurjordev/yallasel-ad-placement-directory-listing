<template>
    <section class="font-roboto bg-gray-50 h-screen">
        <HeaderVue />
        <!-- Header -->
        <section class="bg-white border-b border-gray-300 shadow py-3 px-2">
            <div class="container mx-auto flex justify-between">
                <inertia-link href="/" class="text-red-600 text-2xl font-black"
                    >Yallasell</inertia-link
                >
                <inertia-link
                    href="/"
                    class="font-light text-sm text-gray-600"
                    >{{ __("Cancel") }}</inertia-link
                >
            </div>
        </section>
        <section class="mx-auto lg:w-4/12 mt-5 px-5 pb-5">
            <h5 class="text-center font-semibold text-2xl text-gray-700 mb-10">
                {{ __("What do you want to advertise?") }}
            </h5>
            <inertia-link
                href="/post-ad"
                class="bg-white p-5 flex justify-between space-s-3 rounded-md shadow-md text-gray-700 mb-8"
            >
                <div class="">
                    <div class="">{{ __("All categories") }}</div>
                    <p class="text-sm font-light">
                        {{
                            __(
                                "For example, boats, car parts, furniture, clothes, toys etc."
                            )
                        }}
                    </p>
                </div>
                <i class="fas fa-chevron-right self-center"></i>
            </inertia-link>
            <div class="mb-2">{{ __("Go directly to") }}</div>
            <inertia-link
                href="/post-ad?c=1"
                class="bg-white p-5 flex justify-between space-s-3 rounded-md shadow-md text-gray-700 mb-4"
            >
                <div class="flex justify-start">
                    <img src="/media/site/car.svg" alt="" class="w-8 h-8" />
                    <div class="self-center font-medium ps-3">
                        {{ __("Cars") }}
                    </div>
                </div>
                <i class="fas fa-chevron-right self-center"></i>
            </inertia-link>
            <inertia-link
                href="/post-ad?c=2"
                class="bg-white p-5 flex justify-between space-s-3 rounded-md shadow-md text-gray-700 mb-4"
            >
                <div class="flex justify-start">
                    <img src="/media/site/beds.svg" alt="" class="w-8 h-8" />
                    <div class="self-center font-medium ps-3">
                        {{ __("Bed") }}
                    </div>
                </div>
                <i class="fas fa-chevron-right self-center"></i>
            </inertia-link>
            <inertia-link
                href="/post-ad?c=3"
                class="bg-white p-5 flex justify-between space-s-3 rounded-md shadow-md text-gray-700 mb-4"
            >
                <div class="flex justify-start">
                    <img
                        src="/media/site/television.svg"
                        alt=""
                        class="w-8 h-8"
                    />
                    <div class="self-center font-medium ps-3">
                        {{ __("Television") }}
                    </div>
                </div>
                <i class="fas fa-chevron-right self-center"></i>
            </inertia-link>
            <inertia-link
                href="/post-ad?c=4"
                class="bg-white p-5 flex justify-between space-s-3 rounded-md shadow-md text-gray-700 mb-4"
            >
                <div class="flex justify-start">
                    <img
                        src="/media/site/mobile-phone.svg"
                        alt=""
                        class="w-8 h-8"
                    />
                    <div class="self-center font-medium ps-3">
                        {{ __("Mobile") }}
                    </div>
                </div>
                <i class="fas fa-chevron-right self-center"></i>
            </inertia-link>
        </section>
    </section>
</template>

<script>
import HeaderVue from "@/Components/Header";
export default {
    components: {
        HeaderVue
    }
};
</script>
