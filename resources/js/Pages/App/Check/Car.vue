<template>
    <section class="font-roboto bg-gray-100 h-screen">
        <div class="w-full md:w-4/12 mx-auto pt-5 px-5">
            <h5 class="text-2xl text-gray-700 font-bold mb-10">
                {{ __("Start by filling in the car's registration number") }}
            </h5>
            <div class="">
                <label for="" class="font-medium text-gray-700">{{
                    __("Registration number")
                }}</label>
                <input
                    type="text"
                    placeholder="ABC123"
                    class="mt-2 w-full rounded-md bg-white focus:ring-0 border-gray-400 focus:border-gray-400"
                />
            </div>
            <inertia-link
                as="button"
                type="button"
                href="/add-a-car-ad"
                class="lowercase bg-btn text-white font-semibold w-full text-center mt-5 rounded-md py-3"
                >{{ __("Continue") }}</inertia-link
            >
            <p class="text-sm font-light pt-3 pb-5">
                {{
                    __(
                        "The registration number does not appear in the ad. We use it to pick up the car's equipment and give a price estimate."
                    )
                }}
            </p>
            <div class="text-center">
                <inertia-link
                    href="/add-a-car-ad"
                    class="text-primary font-light"
                >
                    {{ __("Countinue without registration number") }}
                </inertia-link>
            </div>
        </div>
    </section>
</template>
