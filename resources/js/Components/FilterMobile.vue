<template>
    <section class="bg-3 z-50 sticky top-0 border-b border-gray-500 shadow-xl">
        <div class="container mx-auto mt-4 py-5 px-3 text-gray-800">
            <h5 class="font-medium">
                {{ __("Ads through out Iraq") }}
            </h5>
            <p class="font-light text-sm">{{ total }} {{ __("ads") }}</p>
            <div class="grid grid-cols-1 mt-3">
                <button
                    @click="showFilter = true"
                    class="bg-white border border-solid border-gray-500 rounded py-1 text-sm font-medium"
                >
                    <i class="fas fa-sliders-h pe-1 text-base"></i>
                    {{ __("Filter") }}
                </button>
            </div>
        </div>
        <!-- filter -->
        <div
            v-if="showFilter"
            class="fixed z-10 inset-0 overflow-y-auto"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
        >
            <div
                class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
            >
                <div
                    @click="showFilter = false"
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    aria-hidden="true"
                ></div>
                <!-- <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true"
                    >&#8203;</span
                > -->
                <div
                    class="space-y-5 p-5 inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full"
                >
                    <div class="flex flex-col">
                        <label for="reason" class="text-sm font-semibold">{{
                            __("Reason")
                        }}</label>
                        <select v-model="form.at" class="rounded text-blue-900">
                            <option value="for-sale">{{
                                __("For sales")
                            }}</option>
                            <option value="wish-to-purchase">{{
                                __("Wish to purchase")
                            }}</option>
                            <option value="for-rent">{{
                                __("For rent")
                            }}</option>
                            <option value="wish-to-rent">{{
                                __("Wish to rent")
                            }}</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="reason" class="text-sm font-semibold">{{
                            __("Seller type")
                        }}</label>
                        <select v-model="form.f" class="rounded text-blue-900">
                            <option value="">{{ __("All") }}</option>
                            <option value="p">{{ __("Private") }}</option>
                            <option value="b">{{ __("Business") }}</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="reason" class="text-sm font-semibold">{{
                            __("Sort by")
                        }}</label>
                        <select v-model="form.s" class="rounded text-blue-900">
                            <option value="l" class="cursor-pointer">
                                <span class="text-primary">{{
                                    __("Latest")
                                }}</span>
                            </option>
                            <option value="o" class="text-end cursor-pointer">
                                <span class="text-primary">{{
                                    __("Oldest")
                                }}</span>
                            </option>
                            <option value="c" class="text-end cursor-pointer">
                                <span class="text-primary">{{
                                    __("Cheapest")
                                }}</span>
                            </option>
                            <option value="m" class="text-end cursor-pointer">
                                <span class="text-primary">{{
                                    __("Most expensive")
                                }}</span>
                            </option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="reason" class="text-sm font-semibold">{{
                            __("Price")
                        }}</label>
                        <select v-model="form.min_price" class="rounded p-1">
                            <option value="">{{ __("From") }}</option>
                            <option
                                v-for="index in 20"
                                :key="index"
                                :value="5000 + (index - 1) * 5000"
                                >{{ 5000 + (index - 1) * 5000 }} iqd</option
                            >
                        </select>
                        <select v-model="form.max_price" class="rounded p-1">
                            <option value="">{{ __("To") }}</option>
                            <option
                                v-for="index in 20"
                                :key="index"
                                :value="5000 + (index - 1) * 5000"
                                >{{ 5000 + (index - 1) * 5000 }} iqd</option
                            >
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="reason" class="text-sm font-semibold">{{
                            __("Model year")
                        }}</label>
                        <select v-model="form.my_from" class="rounded p-1">
                            <option value="">{{ __("From") }}</option>
                            <option
                                v-for="index in currentYear - 1980 + 1"
                                :key="index"
                                :value="currentYear - (index - 1)"
                                >{{ currentYear - (index - 1) }}</option
                            >
                            <option value="1970">70s</option>
                            <option value="1960">60s</option>
                            <option value="1950">50s</option>
                            <option value="1940">40s</option>
                            <option value="1830">30s and older</option>
                        </select>
                        <select v-model="form.my_to" class="rounded p-1">
                            <option value="">{{ __("To") }}</option>
                            <option
                                v-for="index in currentYear - 1980 + 1"
                                :key="index"
                                :value="currentYear - (index - 1)"
                                >{{ currentYear - (index - 1) }}</option
                            >
                            <option value="1970">70s</option>
                            <option value="1960">60s</option>
                            <option value="1950">50s</option>
                            <option value="1940">40s</option>
                            <option value="1830">30s and older</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="reason" class="text-sm font-semibold">{{
                            __("Mileage")
                        }}</label>
                        <select v-model="form.mileage_from" class="rounded p-1">
                            <option value="">{{ __("From") }}</option>
                            <option
                                v-for="index in 20"
                                :key="index"
                                :value="500 + (index - 1) * 500"
                                >{{ 500 + (index - 1) * 500 }}</option
                            >
                            <option
                                v-for="index in 10"
                                :key="'A' + index"
                                :value="11000 + (index - 1) * 1000"
                                >{{ 11000 + (index - 1) * 1000 }}</option
                            >
                            <option
                                v-for="index in 6"
                                :key="'B' + index"
                                :value="25000 + (index - 1) * 5000"
                                >{{ 25000 + (index - 1) * 5000 }}</option
                            >
                        </select>
                        <select v-model="form.mileage_to" class="rounded p-1">
                            <option value="">{{ __("To") }}</option>
                            <option
                                v-for="index in 20"
                                :key="index"
                                :value="500 + (index - 1) * 500"
                                >{{ 500 + (index - 1) * 500 }}</option
                            >
                            <option
                                v-for="index in 10"
                                :key="'A' + index"
                                :value="11000 + (index - 1) * 1000"
                                >{{ 11000 + (index - 1) * 1000 }}</option
                            >
                            <option
                                v-for="index in 6"
                                :key="'B' + index"
                                :value="25000 + (index - 1) * 5000"
                                >{{ 25000 + (index - 1) * 5000 }}</option
                            >
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="reason" class="text-sm font-semibold">{{
                            __("Fuel")
                        }}</label>
                        <select
                            v-model="form.fuel"
                            class="rounded p-1 capitalize"
                        >
                            <option value="">{{ __("All") }}</option>
                            <option
                                v-for="(fuel, index) in fuels"
                                :key="index"
                                :value="fuel.value"
                                >{{ fuel.value }}</option
                            >
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold">{{
                            __("Gearbox")
                        }}</label>
                        <select
                            v-model="form.gearbox"
                            class="rounded p-1 capitalize"
                        >
                            <option value="">{{ __("All") }}</option>
                            <option
                                v-for="(gearbox, index) in gearboxes"
                                :key="index"
                                :value="gearbox.value"
                                >{{ gearbox.value }}</option
                            >
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold">{{
                            __("Horsepower")
                        }}</label>
                        <select v-model="form.hp_from" class="rounded p-1">
                            <option value="">{{ __("From") }}</option>
                            <option
                                v-for="index in 14"
                                :key="index"
                                :value="40 + (index - 1) * 20"
                                >{{ 40 + (index - 1) * 20 }}</option
                            >
                            <option
                                v-for="index in 4"
                                :key="'A' + index"
                                :value="350 + (index - 1) * 50"
                                >{{ 350 + (index - 1) * 50 }}</option
                            >
                        </select>
                        <select v-model="form.hp_to" class="rounded p-1">
                            <option value="">{{ __("To") }}</option>
                            <option
                                v-for="index in 14"
                                :key="index"
                                :value="40 + (index - 1) * 20"
                                >{{ 40 + (index - 1) * 20 }}</option
                            >
                            <option
                                v-for="index in 4"
                                :key="'A' + index"
                                :value="350 + (index - 1) * 50"
                                >{{ 350 + (index - 1) * 50 }}</option
                            >
                        </select>
                    </div>
                    <div class="flex flex-col"></div>
                    <div class="w-full text-center">
                        <button
                            @click="submit"
                            class="bg-blue-500 text-white px-6 py-1 font-semibold rounded"
                        >
                            {{ __("Filter") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- filter end -->
    </section>
</template>

<script>
export default {
    props: ["reason", "total", "isIndividual", "sorted", "filters"],
    data() {
        return {
            fuels: [],
            gearboxes: [],
            form: {
                at: "for-sale",
                f: "",
                s: "l",
                min_price: this.filters.min_price,
                max_price: this.filters.max_price,
                my_from: this.filters.my_from,
                my_to: this.filters.my_to,
                mileage_from: this.filters.mileage_from,
                mileage_to: this.filters.mileage_to,
                fuel: this.filters.fuel,
                gearbox: this.filters.gearbox,
                hp_from: this.filters.hp_from,
                hp_to: this.filters.hp_to,
                color: this.filters.color,
                car_type: this.filters.car_type
            },
            showFilter: false
        };
    },
    computed: {
        url() {
            return this.$page.url;
        },
        currentYear() {
            return new Date().getFullYear();
        }
    },
    methods: {
        submit() {
            this.showFilter = false;
            this.$inertia.get(
                this.url,
                {
                    s: this.form.s,
                    at: this.form.at,
                    f: this.form.f,
                    min_price: this.form.min_price,
                    max_price: this.form.max_price,
                    my_from: this.form.my_from,
                    my_to: this.form.my_to,
                    mileage_from: this.form.mileage_from,
                    mileage_to: this.form.mileage_to,
                    fuel: this.form.fuel,
                    gearbox: this.form.gearbox,
                    hp_from: this.form.hp_from,
                    hp_to: this.form.hp_to,
                    color: this.form.color,
                    car_type: this.form.car_type
                },
                {
                    method: "get",
                    preserveScroll: true
                }
            );
        },

        async getCategoryAttributes() {
            await axios
                .get("/api/v2/category-properties/1")
                .then(Response => (this.categoryProperties = Response.data));
        }
    },
    async mounted() {
        this.form.at = this.reason;
        this.form.f = this.isIndividual ?? "";
        this.form.s = this.sorted;

        await this.getCategoryAttributes();
        this.categoryProperties.properties.forEach(element => {
            switch (element.property_name) {
                case "fuel":
                    this.fuels = JSON.parse(element.possible_values);
                    break;

                case "gearbox":
                    this.gearboxes = JSON.parse(element.possible_values);
                    break;

                default:
                    break;
            }
        });
    }
};
</script>
