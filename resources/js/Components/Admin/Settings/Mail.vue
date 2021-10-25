<template>
    <div class="p-5">
        <h1 class="font-semibold">Mail Settings</h1>
        <div v-if="success" class="text-green-600 font-semibold mt-2">
            {{ success }}
        </div>
        <form @submit.prevent="submit" class="my-5">
            <div class="space-y-5">
                <div class="grid grid-cols-3 items-center gap-3">
                    <label for="title" class="text-sm font-semibold"
                        >MAIL MAILER:</label
                    >
                    <input
                        id="title"
                        v-model="form.MAIL_MAILER"
                        type="text"
                        class="py-1 rounded w-full col-span-2"
                    />
                </div>
                <div class="grid grid-cols-3 items-center gap-3">
                    <label for="title" class="text-sm font-semibold"
                        >MAIL HOST:</label
                    >
                    <input
                        id="title"
                        v-model="form.MAIL_HOST"
                        type="text"
                        class="py-1 rounded w-full col-span-2"
                    />
                </div>
                <div class="grid grid-cols-3 items-center gap-3">
                    <label for="title" class="text-sm font-semibold"
                        >MAIL PORT:</label
                    >
                    <input
                        id="title"
                        v-model="form.MAIL_PORT"
                        type="text"
                        class="py-1 rounded w-full col-span-2"
                    />
                </div>
                <div class="grid grid-cols-3 items-center gap-3">
                    <label for="title" class="text-sm font-semibold"
                        >MAIL USERNAME:</label
                    >
                    <input
                        id="title"
                        v-model="form.MAIL_USERNAME"
                        type="text"
                        class="py-1 rounded w-full col-span-2"
                    />
                </div>
                <div class="grid grid-cols-3 items-center gap-3">
                    <label for="title" class="text-sm font-semibold"
                        >MAIL PASSWORD:</label
                    >
                    <input
                        id="title"
                        v-model="form.MAIL_PASSWORD"
                        type="text"
                        class="py-1 rounded w-full col-span-2"
                    />
                </div>
                <div class="grid grid-cols-3 items-center gap-3">
                    <label for="title" class="text-sm font-semibold"
                        >MAIL ENCRYPTION:</label
                    >
                    <input
                        id="title"
                        v-model="form.MAIL_ENCRYPTION"
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
    props: ["mail"],
    data() {
        return {
            form: {
                MAIL_MAILER: "smtp",
                MAIL_HOST: "smtp.googlemail.com",
                MAIL_PORT: "587",
                MAIL_USERNAME: "yallasellse@gmail.com",
                MAIL_PASSWORD: "cP48%c4Z^ZO6f",
                MAIL_ENCRYPTION: "tls"
            }
        };
    },
    mounted() {
        if (this.mail) {
            this.form.MAIL_MAILER = this.mail.MAIL_MAILER;
            this.form.MAIL_HOST = this.mail.MAIL_HOST;
            this.form.MAIL_PORT = this.mail.MAIL_PORT;
            this.form.MAIL_USERNAME = this.mail.MAIL_USERNAME;
            this.form.MAIL_PASSWORD = this.mail.MAIL_PASSWORD;
            this.form.MAIL_ENCRYPTION = this.mail.MAIL_ENCRYPTION;
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
