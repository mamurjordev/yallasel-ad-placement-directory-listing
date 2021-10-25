<template>
    <div class="container mx-auto px-2 font-notosans my-5">
        <div class="grid grid-cols-3 w-full mb-4">
            <div class=""></div>
            <div class="text-center font-bold text-2xl">
                {{ __("Select filter") }}
            </div>
            <div @click="close()" class="text-end cursor-pointer">
                <div class="mt-2">{{ __("Colse filter") }}</div>
            </div>
        </div>

        <!-- Geo location -->
        <div class="">
            <div
                class="bg-gray-100 py-2 px-3 font-medium border-t border-b border-gray-300"
            >
                My place
            </div>
            <div class="py-4 px-3 flex justify-between">
                <div class="flex flex-col">
                    Use my current location
                    <span class="text-sm text-gray-500">{{
                        __("need permission to retrieve position")
                    }}</span>
                </div>
                <input type="checkbox" />
            </div>
        </div>

        <!-- choose location -->
        <div class="">
            <div
                class="bg-gray-100 py-2 px-3 font-medium border-t border-b border-gray-300"
            >
                {{ __("Choose location") }}
            </div>
            <div class="">
                <div class="flex justify-between">
                    <div class="py-3 px-3">{{ __("Place") }}</div>
                    <div class="">Dlarnam gavleborg, halland</div>
                </div>
                <div
                    class="py-3 px-3 flex justify-between border-t border-gray-300"
                >
                    <div class="">{{ __("Neighboring counties") }}</div>
                    <input type="checkbox" class="self-center" />
                </div>
            </div>
        </div>
        <!-- filter category -->
        <div class="">
            <div
                class="bg-gray-100 py-2 px-3 font-medium border-t border-b border-gray-300"
            >
                {{ __("Select Category & type of ad") }}
            </div>
            <div class="py-3 px-3 flex justify-between">
                <div class="">{{ __("Category") }}</div>
                <div class="">Vehicle</div>
            </div>
            <div
                class="py-3 px-3 border-t border-gray-300 flex justify-between"
            >
                <div class="">{{ __("Type of ad") }}</div>
                <div class="">For sale</div>
            </div>
            <div
                class="py-3 px-3 border-t border-gray-300 flex justify-between"
            >
                <div class="">{{ __("Advertiser") }}</div>
                <div class="">All</div>
            </div>
        </div>
        <!-- show only -->
        <div class="">
            <div
                class="bg-gray-100 py-2 px-3 font-medium border-t border-b border-gray-300"
            >
                {{ __("Show only") }}
            </div>
            <div class="flex justify-between border-b border-gray-300">
                <div class="py-3 px-3">{{ __("Lowered price") }}</div>
                <input type="checkbox" class="self-center" />
            </div>
        </div>

        <div class="flex justify-between space-x-5 mt-5">
            <div
                @click="clear()"
                class="bg-red-500 rounded text-white px-5 py-1 cursor-pointer"
            >
                {{ __("Clear filters") }}
            </div>
            <div
                @click="filter"
                class="flex-grow text-center bg-green-500 py-1 rounded cursor-pointer"
            >
                {{ __("Showing") }} 23,6616 {{ __("ads") }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        filter() {},
        clear() {},
        close() {}
    }
};
</script>
