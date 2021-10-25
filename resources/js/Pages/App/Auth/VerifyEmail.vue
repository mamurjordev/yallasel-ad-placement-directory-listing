<template>
    <body class="h-screen flex items-center bg-gray-100 font-roboto">
        <section class="container mx-auto flex justify-items-center">
            <section class="hidden md:flex items-center">
                <div
                    class="bg-login-bg bg-cover bg-top bg-no-repeat text-white px-10 pt-10 pb-5"
                >
                    <!-- <img src="/media/site/logo.svg" alt="" class="w-44 mb-5" /> -->
                    <inertia-link href="/" class="cursor-pointer">
                        <img
                            src="/media/site/logo.png"
                            alt=""
                            class="w-36 py-2"
                        />
                    </inertia-link>
                    <h1 class="text-5xl font-semibold font-sans leading-tight">
                        {{ __("Log in for a better experience") }}
                    </h1>
                    <div class="mt-16 text-lg">
                        <p class="font-bold">
                            {{ __("Problems logging in?") }}
                            <inertia-link href="/faq" class="underline">{{
                                __("Here you get help!")
                            }}</inertia-link>
                        </p>
                    </div>
                </div>
            </section>

            <section
                class="shadow-lg bg-white p-5 w-full mx-2 md:mx-0 md:w-7/12"
            >
                <div class="mb-5">
                    <inertia-link href="/" class="cursor-pointer">
                        <img src="/media/site/logo.png" alt="" class="w-16" />
                    </inertia-link>
                </div>
                <h4 class="text-2xl font-bold mb-3">
                    {{ __("Check your inbox") }}
                </h4>
                <img
                    src="/media/site/mail.svg"
                    alt=""
                    class="w-60 mx-auto my-10"
                />
                <div
                    class="grid grid-flow-row text-center text-gray-500 text-sm"
                >
                    <p class="">
                        {{ __("We have sent a verification link to") }}:
                    </p>
                    <p class="mt-1">{{ user.email }}</p>
                    <inertia-link
                        href="/reregister"
                        class="text-primary underline tracking-wide mt-1"
                        >{{ __("Use another email") }}</inertia-link
                    >
                    <button
                        @click="resendVarification()"
                        class="text-primary underline tracking-wide my-10 focus:outline-none"
                    >
                        {{ __("Send the email again") }}
                    </button>
                </div>
            </section>
        </section>
    </body>
</template>

<script>
export default {
    computed: {
        user() {
            return this.$page.props.user;
        }
    },
    data() {
        return {
            mailSend: false
        };
    },
    mounted() {
        this.resendVarification();
    },
    methods: {
        resendVarification() {
            this.$inertia.post("/email/verification-notification");
        }
    }
};
</script>
