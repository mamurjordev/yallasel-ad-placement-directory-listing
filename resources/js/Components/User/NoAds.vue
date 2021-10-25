<template>
    <section class="bg-red-50 py-3">
        <div class="bg-white container mx-auto text-center">
            <div class="w-72 mx-auto">
                <div class="pt-16 pb-12">
                    <img src="/media/site/noads.svg" alt="" class="w-72" />
                </div>
                <h5 class="text-2xl text-gray-800 font-bold pb-2">
                    {{ __("You have no ads posted") }}
                </h5>
                <p class="text-sm">
                    {{
                        __(
                            "You have no ads on Yallasell right now. Time to sell something?"
                        )
                    }}
                </p>
                <div class="pt-6 pb-20">
                    <inertia-link
                        href="./post-ad"
                        class="text-white font-medium p-4 bg-green-600 rounded-md"
                    >
                        {{ __("Place an Ad") }}
                    </inertia-link>
                </div>
            </div>
        </div>
    </section>
</template>
