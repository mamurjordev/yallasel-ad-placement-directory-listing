<template>
    <div class="w-full md:px-4">
        <div
            class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0"
        >
            <div class="rounded-t bg-white mb-0 px-6 py-6">
                <div class="text-center flex justify-between">
                    <h6 class="text-gray-800 text-xl font-bold capitalize">
                        {{ formName }}
                    </h6>
                    <inertia-link
                        as="button"
                        :href="$route('panel.payment_package.index')"
                        class="block float-right bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                        preserve-scroll
                    >
                        {{ formName }} List
                    </inertia-link>
                </div>
                <div v-if="success" class="text-green-600 font-semibold mt-3">
                    {{ success }}
                </div>
            </div>
            <div class="flex-auto md:px-4 lg:px-10 py-10 pt-0">
                <form @submit.prevent="submit">
                    <h6
                        class="text-gray-500 text-sm mt-3 mb-6 font-bold uppercase"
                    >
                        {{ formName }} Information
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
                        <div class="relative w-full mb-3 md:px-4">
                            <label
                                class="block uppercase text-gray-700 text-xs font-bold mb-2"
                            >
                                Price
                            </label>
                            <input
                                type="number"
                                class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                v-model="form.price"
                            />
                            <p class="text-red-500" v-if="errors.price">
                                {{ errors.price }}
                            </p>
                        </div>
                        <div class="grid md:grid-cols-3 w-full">
                            <div class="md:px-4">
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
                                class="md:px-4"
                            >
                                <div class="relative mb-3">
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    >
                                        Feature
                                    </label>
                                    <select
                                        v-model="form.feature"
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
                            <div class="md:px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    >
                                        Sort No.
                                    </label>
                                    <input
                                        type="number"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                        v-model="form.sort_no"
                                    />
                                    <p
                                        class="text-red-500"
                                        v-if="errors.sort_no"
                                    >
                                        {{ errors.sort_no }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            v-if="form.is_subscription == 1"
                            class="grid grid-cols-2 w-full"
                        >
                            <div class="relative w-full mb-3 md:px-4">
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                >
                                    Subscription length
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
                            <div class="relative mb-3">
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                >
                                    Time Period
                                </label>
                                <select
                                    v-model="form.time_period"
                                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                >
                                    <option value="monthly">
                                        Monthly
                                    </option>
                                    <option value="yearly">
                                        Yearly
                                    </option>
                                </select>
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
                            <p class="text-red-500" v-if="errors.post_amount">
                                {{ errors.post_amount }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap">
                        <div
                            v-if="form.is_subscription == 1"
                            class="w-full md:px-4"
                        >
                            <div class="relative w-full mb-3">
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    htmlFor="grid-password"
                                    style="white-space: pre-line"
                                >
                                    Description
                                </label>
                                <vue-editor
                                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                                    v-model="form.description"
                                    :editorToolbar="customToolbar"
                                ></vue-editor>
                                <p class="text-red-500" v-if="errors.text">
                                    This Article field is required
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-wrap px-4">
                            <div class="w-full">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                        htmlFor="grid-password"
                                    >
                                        Status
                                    </label>
                                    <select
                                        v-model="form.status"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                    >
                                        <option value="publish">Publish</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                            </div>
                            <button
                                class="bg-yellow-500 text-white active:bg-yellow-600 font-bold uppercase text-sm mt-4 mx-4 px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="submit"
                                :disabled="form.processing"
                            >
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
export default {
    components: {
        VueEditor
    },
    props: ["formName", "errors", "paymentPackage"],
    data: function() {
        return {
            form: this.$inertia.form({
                _method: "post",
                name: "",
                price: "",
                is_subscription: 0,
                time_period: "",
                subscription_length: "",
                post_amount: 0,
                feature: 0,
                sort_no: "",
                description: "",
                status: "pending"
            }),
            customToolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                [{ size: ["small", false, "large", "huge"] }],
                [{ header: 1 }, { header: 2 }],
                ["bold", "italic", "underline", "strike"],
                [
                    { align: "" },
                    { align: "center" },
                    { align: "right" },
                    { align: "justify" }
                ],
                [{ font: [] }],
                ["blockquote", "code-block"],
                [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
                [{ indent: "-1" }, { indent: "+1" }],
                [{ color: [] }, { background: [] }],
                [{ direction: "rtl" }]
            ]
        };
    },
    computed: {
        success() {
            return this.$page.props.flash.success;
        }
    },
    methods: {
        submit() {
            var data = new FormData();
            data.append("name", this.form.name);
            data.append("price", this.form.price);
            data.append("is_subscription", this.form.is_subscription);
            data.append("subscription_length", this.form.subscription_length);
            data.append("post_amount", this.form.post_amount);
            data.append("feature", this.form.feature);
            data.append("sort_no", this.form.sort_no);
            data.append("description", this.form.description);
            data.append("time_period", this.form.time_period);
            data.append("status", this.form.status);

            if (this.paymentPackage) {
                this.form.post(
                    this.route(
                        "panel.payment_package.update",
                        this.paymentPackage.id
                    )
                );
            } else {
                this.$inertia.post("/panel/payment_package", data);
            }
        },
        isSubs() {
            this.form.is_subscription == 0
                ? ((this.form.subscription_length = ""),
                  (this.form.time_period = ""))
                : ((this.form.post_amount = ""),
                  (this.form.time_period = "monthly"));
        }
    },

    created() {
        if (this.paymentPackage) {
            this.form._method = "put";
            this.form.name = this.paymentPackage.name;
            this.form.price = this.paymentPackage.price;
            this.form.is_subscription = this.paymentPackage.is_subscription;
            this.form.subscription_length = this.paymentPackage.subscription_length;
            this.form.post_amount = this.paymentPackage.post_amount;
            this.form.feature = this.paymentPackage.feature;
            this.form.sort_no = this.paymentPackage.sort_no;
            this.form.description = this.paymentPackage.description;
            this.form.time_period = this.paymentPackage.time_period;
            this.form.status = this.paymentPackage.status;
        }
    }
};
</script>
