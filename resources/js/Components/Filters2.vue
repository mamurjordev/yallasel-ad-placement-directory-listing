<template>
    <section class="container mx-auto">
        <div class="hidden md:flex md:justify-between relative mt-5 md:mb-5">
            <div class="text-xl font-medium">
                {{ __("Showing ads ") }} {{ seller }}
                <span
                    class="text-gray-500 text-sm font-normal ps-2 block md:inline-block"
                    >{{ total }} {{ __("Search") }}</span
                >
            </div>
            <!-- <button
        class="block text-lg absolute end-0 border-2 border-solid border-gray-400 rounded px-5"
      >
        <i class="far fa-heart pe-3"></i>{{ __("Save search") }}
      </button> -->
        </div>
        <div class="md:flex justify-between md:mb-8">
            <div
                class="hidden md:grid grid-flow-col border border-solid border-gray-400 rounded-md w-max"
            >
                <button
                    @click="individual()"
                    :class="isIndividual ? '' : 'text-white bg-btn'"
                    class="border-e border-solid border-gray-400 px-4 pt-2"
                >
                    {{ __("All") }}
                </button>
                <button
                    @click="individual('p')"
                    :class="isIndividual == 'p' ? 'text-white bg-btn' : ''"
                    class="border-e border-solid border-gray-400 px-4 pt-2"
                >
                    {{ __("Private") }}
                </button>
                <button
                    @click="individual('b')"
                    :class="isIndividual == 'b' ? 'text-white bg-btn' : ''"
                    class="px-4 pt-2"
                >
                    {{ __("Business") }}
                </button>
            </div>

            <div class="">
                {{ __("Sort by") }} :
                <select
                    @change="sort()"
                    v-model="sortBy"
                    class="text-end text-sm md:text-base text-gray-800 md:text-gray-600 bg-transparent border-0 font-light md:font-normal focus:ring-0 cursor-pointer"
                >
                    <option dir="rtl" value="l" class="text-end cursor-pointer">
                        <span class="text-primary">{{ __("Latest") }}</span>
                    </option>
                    <option dir="rtl" value="o" class="text-end cursor-pointer">
                        <span class="text-primary">{{ __("Oldest") }}</span>
                    </option>
                    <option dir="rtl" value="c" class="text-end cursor-pointer">
                        <span class="text-primary">{{ __("Cheapest") }}</span>
                    </option>
                    <option dir="rtl" value="m" class="text-end cursor-pointer">
                        <span class="text-primary">{{
                            __("Most expensive")
                        }}</span>
                    </option>
                </select>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ["isIndividual", "total", "sorted", "seller"],
    data() {
        return {
            sortBy: "l"
        };
    },
    methods: {
        sort() {
            this.$inertia.get(
                this.url,
                { s: this.sortBy },
                {
                    method: "get",
                    preserveScroll: true
                }
            );
        },
        individual(type) {
            this.$inertia.get(
                this.url,
                { f: type },
                {
                    method: "get",
                    preserveScroll: true
                }
            );
        }
    },
    computed: {
        url() {
            return this.$page.url;
        }
    },
    created() {
        this.sortBy = this.sorted;
    }
};
</script>
