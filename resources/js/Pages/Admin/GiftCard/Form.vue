<template>
    <admin-layout>
        <div class="w-full md:px-4">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0"
            >
                <div class="rounded-t bg-white mb-0 px-6 py-6">
                    <div class="text-center flex justify-between">
                        <h6 class="text-gray-800 text-xl font-bold capitalize">
                            Gift Card
                        </h6>
                        <inertia-link
                            as="button"
                            :href="$route('panel.payment_package.index')"
                            class="block float-right bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                            preserve-scroll
                        >
                            Gift Card List
                        </inertia-link>
                    </div>
                    <div
                        v-if="success"
                        class="text-green-600 font-semibold mt-3"
                    >
                        {{ success }}
                    </div>
                </div>
                <div class="flex-auto md:px-4 lg:px-10 py-10 pt-0">
                    <form @submit.prevent="submit">
                        <h6
                            class="text-gray-500 text-sm mt-3 mb-6 font-bold uppercase"
                        >
                            Gift Card Information
                        </h6>
                        <div class="flex flex-wrap">
                            <div class="w-full md:px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    >
                                        Plan Name
                                    </label>
                                    <input
                                        type="text"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                        v-model="form.name"
                                    />
                                    <p class="text-red-500" v-if="errors.name">
                                        {{ errors.name }}
                                    </p>
                                </div>
                            </div>
                            <div class="w-full md:px-4">
                                <div class="relative mb-3">
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    >
                                        Is Subscription
                                    </label>
                                    <select
                                        @change="isSubs()"
                                        v-model="form.is_subscription"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                    >
                                        <option :value="parseInt(0)">
                                            False
                                        </option>
                                        <option :value="parseInt(1)">
                                            True
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div
                                v-if="form.is_subscription == 1"
                                class="w-full"
                            >
                                <div class="relative w-full mb-3 md:px-4">
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    >
                                        Subscription length (Days)
                                    </label>
                                    <input
                                        type="number"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                        v-model="form.subscription_length"
                                    />
                                    <p
                                        class="text-red-500"
                                        v-if="errors.subscription_length"
                                    >
                                        {{ errors.subscription_length }}
                                    </p>
                                </div>
                            </div>
                            <div v-else class="relative w-full mb-3 md:px-4">
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    htmlFor="grid-password"
                                >
                                    Post amount
                                </label>
                                <input
                                    type="number"
                                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                    v-model="form.post_amount"
                                />
                                <p
                                    class="text-red-500"
                                    v-if="errors.post_amount"
                                >
                                    {{ errors.post_amount }}
                                </p>
                            </div>
                            <div
                                v-if="!isUpdate"
                                class="relative w-full mb-3 md:px-4"
                            >
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    htmlFor="grid-password"
                                >
                                    Use custom code
                                </label>
                                <div class="flex gap-5 items-center">
                                    <input
                                        type="checkbox"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:ring-0 focus:outline-none ease-linear transition-all duration-150 cursor-pointer"
                                        v-model="form.useCustomCode"
                                    />
                                    <div
                                        v-if="form.useCustomCode"
                                        class="w-full"
                                    >
                                        <input
                                            type="text"
                                            class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                            v-model="form.custom_code"
                                        />
                                        <p
                                            class="text-red-500"
                                            v-if="errors.custom_code"
                                        >
                                            {{ errors.custom_code }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="relative w-full mb-3 md:px-4">
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    htmlFor="grid-password"
                                >
                                    Status
                                </label>
                                <select v-model="form.status">
                                    <option value="pending">Pending</option>
                                    <option value="publish">Publish</option>
                                </select>
                            </div>

                            <button
                                type="submit"
                                class="bg-blue-500 font-medium px-10 py-1 text-white ms-4 mt-3"
                            >
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
export default {
    components: {
        AdminLayout
    },
    props: ["errors", "giftcard"],
    data: function() {
        return {
            form: this.$inertia.form({
                _method: "post",
                name: "",
                is_subscription: 0,
                subscription_length: "",
                post_amount: 0,
                status: "publish",
                useCustomCode: false,
                custom_code: ""
            }),
            isUpdate: false
        };
    },
    computed: {
        success() {
            return this.$page.props.flash.success;
        }
    },
    watch: {
        "form.useCustomCode": function() {
            if (this.form.useCustomCode == false) {
                this.form.custom_code = "";
            }
        }
    },
    methods: {
        submit() {
            var data = new FormData();
            data.append("name", this.form.name);
            data.append("is_subscription", this.form.is_subscription);
            data.append("subscription_length", this.form.subscription_length);
            data.append("post_amount", this.form.post_amount);
            data.append("status", this.form.status);
            data.append("useCustomCode", this.form.useCustomCode);
            data.append("custom_code", this.form.custom_code);

            if (this.giftcard) {
                this.form.post(
                    this.route("panel.giftcard.update", this.giftcard.id)
                );
            } else {
                this.$inertia.post("/panel/giftcard", data);
            }
        },
        isSubs() {
            this.form.is_subscription == 0
                ? (this.form.subscription_length = "")
                : (this.form.post_amount = "");
        }
    },

    created() {
        if (this.giftcard) {
            this.form._method = "put";
            this.form.name = this.giftcard.name;
            this.form.is_subscription =
                this.giftcard.type == "subscription" ? 1 : 0;
            this.form.subscription_length = this.giftcard.days;
            this.form.post_amount = this.giftcard.post_count;
            this.form.status = this.giftcard.status;
            this.isUpdate = true;
        }
    }
};
</script>
