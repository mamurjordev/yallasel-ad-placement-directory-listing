<template>
    <div class="p-5">
        <h1 class="font-semibold">Payment Settings</h1>
        <div v-if="success" class="text-green-600 font-semibold mt-2">
            {{ success }}
        </div>
        <form @submit.prevent="submit" class="my-5">
            <div class="space-y-5">
                <h2 class="font-semibold text-gray-700 text-sm my-5">Paypal</h2>
                <div class="grid grid-cols-3 items-center gap-3">
                    <label for="title" class="text-sm font-semibold"
                        >PAYPAL CLIENT ID:</label
                    >
                    <input
                        id="title"
                        v-model="form.paypal_client_id"
                        type="text"
                        class="py-1 rounded w-full col-span-2"
                    />
                </div>
                <div class="grid grid-cols-3 items-center gap-3">
                    <label for="title" class="text-sm font-semibold"
                        >PAYPAL CLIENT SECRET:</label
                    >
                    <input
                        id="title"
                        v-model="form.paypal_client_secret"
                        type="text"
                        class="py-1 rounded w-full col-span-2"
                    />
                </div>
                <div class="grid grid-cols-3 items-center gap-3">
                    <label for="title" class="text-sm font-semibold"
                        >PAYMENT CURRENCY (ex: USD):</label
                    >
                    <input
                        id="title"
                        v-model="form.payment_currency"
                        type="text"
                        class="py-1 rounded w-full col-span-2"
                    />
                </div>
            </div>
            <button
                type="submit"
                class="bg-blue-500 text-white rounded px-10 py-2 mt-5 hover:shadow-xl"
            >
                Update
            </button>
        </form>
    </div>
</template>

<script>
export default {
    props: ["payment"],
    data() {
        return {
            form: {
                paypal_client_id: "",
                paypal_client_secret: "",
                payment_currency: ""
            }
        };
    },
    mounted() {
        if (this.payment) {
            this.form.paypal_client_id = this.payment.paypal_client_id;
            this.form.paypal_client_secret = this.payment.paypal_client_secret;
            this.form.payment_currency = this.payment.payment_currency;
        }
    },
    computed: {
        success() {
            return this.$page.props.flash.success;
        }
    },
    methods: {
        submit() {
            var _this = this;
            this.$inertia.post("/panel/setting/update/env", this.form);
            setTimeout(function() {
                console.log("ok");
                _this.$page.props.flash.success = null;
            }, 3500);
            // this.$page.props.flash.success = null;
        }
    }
};
</script>
