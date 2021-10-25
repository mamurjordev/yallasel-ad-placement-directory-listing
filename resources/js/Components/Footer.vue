<template>
    <section>
        <div class="bg-footer-border w-screen h-3 flex-shrink-0"></div>
        <!-- {{-- Main footer --}} -->
        <footer class="container mx-auto mt-6 px-5 pb-14">
            <div
                class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-2 text-gray-600 text-sm"
            >
                <div class="">
                    <h5 class="text-lg font-semibold">
                        {{ __("The Yallasell") }}
                    </h5>
                    <inertia-link href="#!" class="block pt-1">{{
                        __("Open a shop")
                    }}</inertia-link>
                    <inertia-link href="/login" class="block pt-2">{{
                        __("Login")
                    }}</inertia-link>
                    <inertia-link href="/contact" class="block pt-2">{{
                        __("Contact Us")
                    }}</inertia-link>
                </div>
            </div>
        </footer>

        <!-- {{-- Footer bottom --}} -->
        <section class="bg-red-50">
            <div
                class="container mx-auto flex justify-between text-xs font-thin mt-2 mb-2 px-3"
            >
                <p class="text-lg font-medium w-20 me-6">Yallasell</p>
                <p class="pt-2">
                    {{ __("copyright © Yallasell 2021. All right reserved.") }}
                </p>
            </div>
        </section>

        <!-- {{-- Mobile Footer --}} -->
        <section
            class="md:hidden py-2 fixed bottom-0 w-screen flex content-center z-40"
        >
            <inertia-link
                href="/my-ads/place-ad"
                class="text-lg font-semibold mx-auto uppercase bg-green-500 text-white w-max px-5 rounded-md py-1 shadow-lg"
                >{{ __("place ad") }}</inertia-link
            >
        </section>
    </section>
</template>

<script>
export default {};
</script>
