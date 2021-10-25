<template>
    <body>
        <HeaderVue />
        <div class="h-screen flex items-center bg-gray-100 font-roboto">
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
                        <h1
                            class="text-5xl font-semibold font-sans leading-tight"
                        >
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
                <section class="shadow-lg bg-white p-5 w-full md:w-7/12">
                    <inertia-link href="/" class="cursor-pointer">
                        <img
                            src="/media/site/logo.png"
                            alt=""
                            class="w-16 mb-5"
                        />
                    </inertia-link>
                    <h4 class="text-2xl font-bold mb-3">
                        {{ __("Log in or create a new account") }}
                    </h4>
                    <form @submit.prevent="submit" class="grid grid-flow-row">
                        <div>
                            <label for="">{{ __("Email") }}</label>
                            <input
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                            />
                            <p
                                v-if="errors.email"
                                class="text-red-600 font-medium text-sm"
                            >
                                {{ errors.email[0] }}
                            </p>
                            <div
                                v-if="!emailExist"
                                class="bg-gray-600 text-white rounded-md px-3 py-1 text-sm mt-1"
                            >
                                {{
                                    __(
                                        "You are not register user. Press continue to register."
                                    )
                                }}
                            </div>
                            <p class="text-xs mb-5 text-gray-500 mt-1">
                                *{{ __("Mandatory field") }}
                            </p>
                        </div>
                        <div class="" v-if="showPassfield">
                            <label for="password">{{ __("Password") }}</label>
                            <input
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                            />
                            <p
                                v-if="errors.password"
                                class="text-red-600 font-medium text-sm"
                            >
                                {{ errors.password[0] }}
                            </p>
                        </div>
                        <p
                            v-if="errors.msg"
                            class="text-red-500 font-semibold text-sm py-2"
                        >
                            {{ errors.msg }}
                        </p>
                        <inertia-link
                            href="/forgot-password"
                            v-if="errors.msg"
                            class="text-blue-600 text-sm w-max"
                        >
                            {{ __("Forgot password?") }}
                        </inertia-link>

                        <button
                            v-if="!submited"
                            @click="submit()"
                            class="bg-blue-500 rounded-md py-3 text-white font-bold mt-32 flex justify-center items-center"
                            :class="{ 'opacity-25': processing }"
                            :disabled="processing"
                        >
                            <svg
                                v-if="processing"
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
                            {{ __("Continue") }}
                        </button>
                        <button
                            v-else
                            @click="submitFinal()"
                            class="bg-blue-500 rounded-md py-3 text-white font-bold mt-32 flex justify-center items-center"
                            :class="{ 'opacity-25': processing }"
                            :disabled="processing"
                        >
                            <svg
                                v-if="processing"
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
                            {{
                                lang == "ar" ? submitButton.ar : submitButton.en
                            }}
                        </button>
                    </form>
                    <!-- </form> -->
                </section>
            </section>
        </div>
    </body>
</template>

<script>
import HeaderVue from "@/Components/Header";
export default {
    components: {
        HeaderVue
    },

    // props: ["errors"],

    data() {
        return {
            form: this.$inertia.form({
                email: null,
                password: null
            }),
            emailExist: true,
            showPassfield: false,
            processing: false,
            submitButton: {
                en: "Login",
                ar: "دخول"
            },
            submited: false,
            responseData: null,
            errors: {}
        };
    },
    computed: {
        lang() {
            return this.$page.props.language;
        }
    },
    watch: {
        "form.email"() {
            this.submited = false;
            this.showPassfield = false;
            this.processing = false;
            this.emailCheck();
        },
        "form.password"() {
            this.processing = false;
        }
    },
    created() {
        if (this.errors) {
            this.processing = false;
        }
    },
    methods: {
        async submit() {
            this.processing = true;
            await this.emailCheck();
            this.showPassfield = true;
            this.submited = true;
            this.processing = false;
        },
        submitFinal() {
            if (this.emailExist == false) {
                this.registration();
            } else {
                this.login();
            }
        },
        async login() {
            this.processing = true;
            await axios
                .post("/api/v2/login", this.form)
                .then(response => {
                    if (response.data.success) {
                        this.$inertia.get("/");
                    } else {
                        this.errors.msg = response.data.message;
                    }
                })
                .catch(e => console.log(e));
            this.processing = false;
        },
        async registration() {
            this.processing = true;
            this.form.password_confirmation = this.form.password;
            var name =
                this.form.email.split("@")[0] +
                Math.floor(Math.random() * 100) +
                1;
            this.form.username = name;
            this.form.name = name;
            await axios
                .post("/api/v2/register", this.form)
                .then(response => {
                    if (response.data.success) {
                        console.log("ok");
                        this.$inertia.get("/email/verify");
                    } else {
                        this.errors = response.data.error;
                    }
                    this.processing = false;
                })
                .catch(error => (this.errors = error.response.error));
        },
        // resendVarification() {
        //     this.$inertia.post("/email/verification-notification");
        // },
        async emailCheck() {
            await axios
                .get("/api/v1/emailcheck?email=" + this.form.email)
                .then(response => {
                    if (response.data == false) {
                        (this.submitButton.en = "Registration"),
                            (this.submitButton.ar = "تسجيل");
                    } else {
                        (this.submitButton.en = "Login"),
                            (this.submitButton.ar = "دخول");
                    }
                    this.emailExist = response.data;
                })
                .catch(error => console.log(error.data));
        }
    }
};
</script>
