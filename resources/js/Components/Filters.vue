<template>
    <section
        class="container mx-auto hidden md:flex justify-start mt-4 pt-2 border-t border-solid border-gray-300 px-3"
    >
        <div class="flex justify-start">
            <div class="me-4 font-medium">{{ __("Type of ads") }}:</div>
            <div class="space-s-2 text-gray-600">
                <label for="" class="cursor-pointer" @click="sort('for-sale')">
                    <input
                        type="radio"
                        class="focus:ring-0 cursor-pointer"
                        value="for-sale"
                        v-model="adTypes"
                    />
                    {{ __("For sales") }}
                </label>
                <label
                    for=""
                    class="cursor-pointer"
                    @click="sort('wish-to-purchase')"
                >
                    <input
                        type="radio"
                        class="focus:ring-0 cursor-pointer"
                        value="wish-to-purchase"
                        v-model="adTypes"
                    />
                    {{ __("Wish to purchase") }}
                </label>
                <label for="" class="cursor-pointer" @click="sort('for-rent')">
                    <input
                        type="radio"
                        class="focus:ring-0 cursor-pointer"
                        value="for-rent"
                        v-model="adTypes"
                    />
                    {{ __("For rent") }}
                </label>
                <label
                    for=""
                    class="cursor-pointer"
                    @click="sort('wish-to-rent')"
                >
                    <input
                        type="radio"
                        class="focus:ring-0 cursor-pointer"
                        value="wish-to-rent"
                        v-model="adTypes"
                    />
                    {{ __("Wish to rent") }}
                </label>
            </div>
        </div>
        <div class="flex justify-start ms-5">
            <div class="me-4 font-medium">{{ __("Show only") }}:</div>
            <div class="space-s-2 text-gray-600">
                <label for="" class="cursor-pointer" @click="sortBy('c')">
                    <input
                        type="radio"
                        class="focus:ring-0 cursor-pointer"
                        value="c"
                        v-model="sorts"
                    />
                    {{ __("Lowered price") }}
                </label>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ["reason", "sorted"],
    data() {
        return {
            adTypes: null,
            sorts: null
        };
    },
    methods: {
        sort(a) {
            this.adTypes = a;
            this.$inertia.get(
                this.url,
                { at: a },
                {
                    method: "get",
                    preserveScroll: true
                }
            );
        },
        sortBy(sortBy) {
            this.sorted == "c" ? (sortBy = "l") : "c";
            this.$inertia.get(
                this.url,
                { s: sortBy },
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
        },
        data() {
            return this.$page;
        }
    },
    created() {
        this.adTypes = this.reason;
        this.sorts = this.sorted;
    }
};
</script>
