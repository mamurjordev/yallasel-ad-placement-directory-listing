<template>
    <div class="">
        <!-- Membership Package Section -->
        <div class="bg-gray-100 py-12">
            <div v-if="cancel" class="text-center text-red-500 mb-3">
                {{ cancel }}
            </div>
            <div v-if="success" class="text-center text-green-500 mb-3">
                {{ success }}
            </div>
            <div class="container mx-auto">
                <h1 class="text-center text-2xl mb-6">
                    Business Plans
                </h1>

                <!-- <div class="flex justify-center"> -->
                <div class="grid md:grid-cols-2 mx-auto w-max gap-2">
                    <label class="cursor-pointer">
                        <input
                            type="radio"
                            :value="parseInt(0)"
                            v-model="time_period"
                            class="focus:ring-0 cursor-pointer"
                        />
                        <span>Billed Monthly</span>
                    </label>

                    <label class="cursor-pointer">
                        <input
                            type="radio"
                            :value="parseInt(1)"
                            v-model="time_period"
                            class="focus:ring-0 cursor-pointer"
                        />
                        <span>Billed Yearly</span>
                    </label>
                </div>
                <!-- </div> -->

                <div class="grid md:grid-cols-3 mt-16">
                    <div
                        v-if="featurePackages[0]"
                        class="p-8 shadow-2xl bg-white border-b border-gray-300"
                    >
                        <h1 class="text-xl mb-2">
                            {{ featurePackages[0].name }}
                        </h1>
                        <p
                            class="text-gray-700"
                            v-html="featurePackages[0].description"
                        ></p>

                        <div class="space-x-1 bg-gray-100 p-4 my-6 text-center">
                            <span class="text-3xl font-bold"
                                >{{ featurePackages[0].price }} IQD
                                <sub class="text-lg text-gray-600"
                                    >/
                                    {{ featurePackages[0].subscription_length }}
                                    month</sub
                                >
                            </span>
                        </div>

                        <button
                            v-if="processing == featurePackages[0].id"
                            class="flex justify-center px-4 py-2 leading-6 font-medium rounded-md text-white bg-green-500 hover:bg-green-400 transition ease-in-out duration-150 cursor-not-allowed w-full"
                        >
                            <svg
                                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>
                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                            Processing
                        </button>
                        <div
                            v-else
                            @click="checkout(featurePackages[0].id)"
                            class="capitalize cursor-pointer block bg-transparent border border-blue-700 text-blue-700 hover:bg-blue-700 rounded text-center py-2 mt-6 hover:text-white transition"
                        >
                            Buy now
                        </div>
                    </div>

                    <div
                        v-if="featurePackages[1]"
                        class="relative p-8 border-b border-gray-300 md:shadow-2xl bg-white md:z-30"
                    >
                        <div
                            class="hidden md:block absolute -top-10 start-0 bg-blue-600 w-full rounded-t-md text-white py-2 font-medium text-center"
                        >
                            Most Popular
                        </div>
                        <h1 class="text-xl mb-2">
                            {{ featurePackages[1].name }}
                        </h1>
                        <p
                            class="text-gray-700"
                            v-html="featurePackages[1].description"
                        ></p>

                        <div class="space-x-1 bg-gray-100 p-4 my-6 text-center">
                            <span class="text-3xl font-bold"
                                >{{ featurePackages[1].price }}
                                IQD
                                <sub class="text-lg text-gray-600"
                                    >/
                                    {{ featurePackages[1].subscription_length }}
                                    monthly</sub
                                >
                            </span>
                        </div>

                        <div
                            v-if="processing == featurePackages[1].id"
                            class="flex justify-center px-4 py-2 leading-6 font-medium rounded-md text-white bg-green-500 hover:bg-green-400 transition ease-in-out duration-150 cursor-not-allowed w-full"
                        >
                            <svg
                                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>
                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                            Processing
                        </div>
                        <div
                            v-else
                            @click="checkout(featurePackages[1].id)"
                            class="capitalize cursor-pointer block bg-transparent border border-blue-700 text-blue-700 hover:bg-blue-700 rounded text-center py-2 mt-6 hover:text-white transition"
                        >
                            Buy now
                        </div>
                    </div>

                    <div
                        v-if="featurePackages[2]"
                        class="p-8 shadow-2xl bg-white"
                    >
                        <h1 class="text-xl mb-2">
                            {{ featurePackages[2].name }}
                        </h1>
                        <p
                            class="text-gray-700"
                            v-html="featurePackages[2].description"
                        ></p>

                        <div class="space-x-1 bg-gray-100 p-4 my-6 text-center">
                            <span class="text-3xl font-bold"
                                >{{ featurePackages[2].price }} IQD
                                <sub class="text-lg text-gray-600"
                                    >/
                                    {{ featurePackages[2].subscription_length }}
                                    monthly</sub
                                >
                            </span>
                        </div>

                        <div
                            v-if="processing == featurePackages[2].id"
                            class="flex justify-center px-4 py-2 leading-6 font-medium rounded-md text-white bg-green-500 hover:bg-green-400 transition ease-in-out duration-150 cursor-not-allowed w-full"
                        >
                            <svg
                                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>
                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                            Processing
                        </div>
                        <div
                            v-else
                            @click="checkout(featurePackages[2].id)"
                            class="capitalize cursor-pointer block bg-transparent border border-blue-700 text-blue-700 hover:bg-blue-700 rounded text-center py-2 mt-6 hover:text-white transition"
                        >
                            Buy now
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buy post Package -->
        <div class="text-center text-lg uppercase">Or</div>
        <div class="px-2 pt-3 text-center text-2xl font-semibold">
            Buy Posts
        </div>
        <section class="grid md:grid-cols-3 gap-3 container mx-auto my-6">
            <div
                v-for="buyPost in buyPosts"
                :key="buyPost.id"
                class="p-8 shadow-lg bg-white border-b border-gray-300"
            >
                <h1 class="text-xl mb-2">
                    {{ buyPost.name }}
                </h1>

                <div class="space-x-1 bg-gray-100 p-4 my-6 text-center">
                    <div class="text-3xl font-bold">
                        {{ buyPost.price }}
                        <span class="text-lg">{{ currency }}</span>
                    </div>
                    <div class="mt-1 font-medium text-gray-800">
                        {{ buyPost.post_amount }} posts
                    </div>
                </div>
                <div class="">
                    <label for="">Unit</label>
                    <input type="number" class="w-full" v-model="amount" />
                </div>
                <button
                    v-if="processing == buyPost.id"
                    class="flex justify-center px-4 py-2 mt-6 leading-6 font-medium rounded-md text-white bg-green-500 hover:bg-green-400 transition ease-in-out duration-150 cursor-not-allowed w-full"
                    disabled
                >
                    <svg
                        class="animate-spin -ms-1 me-3 self-center h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        ></circle>
                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                        ></path>
                    </svg>
                    <span>Processing</span>
                </button>
                <div
                    v-else
                    @click="checkout(buyPost.id)"
                    class="cursor-pointer block bg-transparent border border-blue-700 text-blue-700 hover:bg-blue-700 rounded text-center py-2 mt-6 hover:text-white transition"
                >
                    Buy Now
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    props: ["featurePackagesMonthly", "featurePackagesYearly", "buyPosts", 'bearer'],
    data() {
        return {
            featurePackages: [],
            time_period: 0,
            amount: 1,
            processing: null,
            paymentMethod: "paypal",
            redirect: null
        };
    },
    computed: {
        currency() {
            return this.$page.props.language == "ar" ? "ع.د" : "IQD";
        },
        cancel() {
            return this.$page.props.errors.cancel;
        },
        success() {
            return this.$page.props.flash.success;
        }
    },
    created() {
        this.featurePackages = this.featurePackagesMonthly;
    },
    watch: {
        time_period() {
            if (this.time_period == 1) {
                this.featurePackages = this.featurePackagesYearly;
            } else {
                this.featurePackages = this.featurePackagesMonthly;
            }
        }
    },
    methods: {
        checkout(id) {
            this.checkoutPaypal(id);
            this.processing = id;
        },
        async checkoutPaypal(id) {
            var values = {
                packageId: id,
                amount: this.amount,
                paymentMethod: this.paymentMethod,
                bearer: this.bearer
            };

            // this.$inertia
            //     .post("/transaction", values)
            //     .then(response => console.log(response));

            axios
                .post("/api/v2/transaction", values)
                .then(
                    response => {
                        console.log(response.data);
                        this.redirect = response.data
                        window.location.replace(response.data)
                    }
                );
        }
    }
};
</script>
