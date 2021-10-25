<template>
    <!-- {{-- Hero Main --}} -->
    <section
        class="w-screen scale-100 bg-indigo-50 bg-string bg-no-repeat bg-right-bottom"
        style="transform: scaleX(-1)"
    >
        <div
            class="container mx-auto py-10 px-2 grid sm:grid-cols-2 items-center"
            style="transform: scaleX(-1)"
        >
            <form
                v-on:submit.prevent="search()"
                action=""
                class="bg-white p-5 rounded shadow-xl w-full md:w-max text-gray-700 z-30"
            >
                <h2 class="text-3xl font-black">
                    {{ __("Welcome to Yallasell") }}
                </h2>
                <label for="search" class="font-bold">{{ __("Search") }}</label>
                <div
                    class="block rounded-sm border border-solid w-full border-gray-400 mb-2 mt-1"
                >
                    <i class="fas fa-search absolute pt-3 px-3 min-w-max"></i>
                    <input
                        v-model="search_text"
                        id="search"
                        type="text"
                        class="px-10 w-full border-none focus:ring-transparent"
                        :placeholder="
                            lang == 'ar'
                                ? 'عن ماذا تبحث؟'
                                : 'What are you looking for?'
                        "
                    />
                </div>
                <label for="location" class="font-bold">{{
                    __("choose location")
                }}</label>
                <div
                    class="block rounded-sm border border-solid w-full border-gray-400 mb-2 mt-1"
                >
                    <i
                        class="fas fa-map-marker-alt absolute pt-3 px-3 min-w-max"
                    ></i>
                    <select
                        id="location"
                        class="px-10 w-full border-none focus:ring-transparent"
                        v-model="region_id"
                    >
                        <option value="">{{ __("Whole Irak") }}</option>
                        <option
                            v-for="region in regions"
                            :key="region.id"
                            :value="region.id"
                        >
                            {{ region.region_name }}
                        </option>
                    </select>
                </div>
                <button
                    type="submit"
                    class="bg-btn text-white font-semibold text-lg w-full py-2 mt-5 rounded-md"
                >
                    {{ __("find ads") }}
                </button>
            </form>

            <div class="absolute md:static w-full filter grayscale">
                <!-- <img src="/media/site/svg/asset2.svg" alt="" class="" /> -->
                <img
                    src="/media/site/svg/asset1.svg"
                    alt=""
                    class="w-full h-full "
                />
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ["regions"],

    data() {
        return {
            search_text: "",
            region_id: ""
        };
    },
    computed: {
        lang() {
            return this.$inertia.page.props.language;
        }
    },
    methods: {
        search() {
            this.$inertia.get(
                "/category",
                { q: this.search_text, r: this.region_id },
                {
                    method: "get",
                    preserveScroll: true
                }
            );
        }
    }
};
</script>
