<template>
    <section class="bg-search py-2">
        <div class="container mx-auto flex justify-start px-3">
            <form
                id="search"
                method=""
                v-on:submit.prevent="submit()"
                class="bg-white px-1 rounded w-full md:w-4/6 flex items-stretch"
            >
                <i class="fas fa-search self-center ms-2"></i>
                <input
                    type="search"
                    v-model="searchText"
                    class="border-none flex-grow focus:ring-0"
                    placeholder=""
                />
                <button
                    v-if="!submitBtnHidden"
                    id="search-button"
                    type="submit"
                    class="bg-search text-white font-medium my-1 px-1 rounded-sm"
                >
                    {{ __("search") }}
                </button>
            </form>
            <section class="relative mt-2">
                <div
                    @click="isHidden = !isHidden"
                    class="hidden md:flex items-stretch text-white ms-3 cursor-pointer noselect"
                >
                    <i class="fas fa-map-marker-alt self-center"></i>
                    <div class="self-center ms-3">
                        {{ __("Whole Iraq") }}
                        <i class="fas fa-chevron-down ps-4"></i>
                    </div>
                </div>
                <!-- Dropdown -->
                <div
                    :class="isHidden ? 'hidden' : ''"
                    class="absolute start-5 bg-white z-40 py-4 mt-2 border border-gray-500 font-light rounded-md"
                >
                    <div class="overflow-y-auto h-96 w-56 px-4  space-y-3 ">
                        <div class="">
                            <label for="location" class="cursor-pointer">
                                <input
                                    id="location"
                                    type="checkbox"
                                    class="focus:ring-0 rounded text-primary me-2"
                                    v-model="allRegion"
                                />
                                Whole Iraq
                            </label>
                        </div>
                        <div class="border-b border-gray-500"></div>
                        <div
                            class=""
                            v-for="(region, index) in regions"
                            :key="index"
                        >
                            <label
                                :for="'location' + index"
                                class="cursor-pointer"
                            >
                                <input
                                    :id="'location' + index"
                                    type="checkbox"
                                    class="focus:ring-0 rounded text-primary me-2 cursor-pointer"
                                    :value="region.id"
                                    v-model="regionsId"
                                />
                                {{ region.region_name }}
                            </label>
                        </div>
                    </div>
                    <div
                        class="grid grid-cols-2 text-center px-2 gap-2 pt-2 font-medium border-t border-gray-500"
                    >
                        <button
                            @click="regionsId = []"
                            class="border border-gray-400 rounded focus:ring-0 focus:outline-none"
                        >
                            Reset
                        </button>
                        <button
                            @click="goRegions"
                            class="bg-green-500 rounded text-white"
                        >
                            {{ __("Get ads") }}
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </section>
</template>

<script>
export default {
    props: ["regions", "search", "regionsSelect"],
    data() {
        return {
            isHidden: true,
            locations: null,
            submitBtnHidden: true,
            searchText: "",
            regionsId: [],
            allRegion: false
        };
    },
    methods: {
        showSubmit() {
            this.submitBtnHidden = this.searchText == "" ? true : false;
        },
        submit() {
            this.$inertia.get(
                this.url,
                { q: this.searchText },
                {
                    method: "get",
                    preserveScroll: true
                }
            );
        },
        goRegions() {
            this.$inertia.get(
                this.url,
                { r: this.regionsId.join() },
                {
                    method: "get",
                    preserveScroll: true
                }
            );
        }
    },
    watch: {
        searchText() {
            this.showSubmit();
        },
        allRegion(e) {
            if (e) {
                this.regions.forEach(element => {
                    this.regionsId.push(element.id);
                });
            } else {
                this.regionsId = [];
            }
        }
    },
    computed: {
        url() {
            return this.$page.url;
        }
    },
    mounted() {
        this.searchText = this.search;
        if (this.regionsSelect) {
            this.regionsId = this.regionsSelect.split(",").map(Number);
        }
    }
};
</script>

<style scoped>
.noselect {
    -webkit-user-select: none; /* Chrome all / Safari all */
    -moz-user-select: none; /* Firefox all */
    -ms-user-select: none; /* IE 10+ */
    user-select: none;
}
</style>
