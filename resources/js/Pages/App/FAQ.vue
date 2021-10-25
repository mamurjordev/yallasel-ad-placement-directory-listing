<template>
    <section>
        <section
            class="container mx-auto mt-10 pt-5 md:flex md:justify-between px-4"
        >
            <div class="text-gray-800 tracking-wider">
                <div class="font-semibold">
                    {{ __("Welcome to customer service") }}
                </div>
                <h1 class="text-4xl font-bold my-5">
                    {{ __("What do you need help with?") }}
                </h1>

                <!-- {{ --Search-- }} -->

                <form
                    role="search"
                    class="flex items-stretch border border-solid border-gray-400 bg-white rounded overflow-hidden"
                    accept-charset="UTF-8"
                    method="get"
                    @submit.prevent="search()"
                >
                    <i
                        class="fas fa-search self-center ps-2 text-xl text-gray-500"
                    ></i>
                    <input
                        type="text"
                        placeholder="Look for helpful items"
                        autocomplete="off"
                        v-model="searchTxt"
                        class="flex-grow border-none focus:ring-0 py-4"
                    />
                    <button
                        type="submit"
                        class="bg-bg2 px-4 md:px-7 text-white"
                    >
                        {{ __("Search") }}
                    </button>
                </form>
            </div>
            <div class="hidden md:block">
                <img src="media/site/svg1.svg" alt="" class="h-64" />
            </div>
        </section>

        <!-- {{-- Suggested subject areas --}} -->
        <section class="container mx-auto mb-10 px-2 mt-7 md:mt-0">
            <div class="text-3xl font-semibold mb-12">
                {{ __("Suggested subject areas") }}
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-2 md:gap-6 text-xs">
                <inertia-link
                    href="/faqs/manage-ad"
                    class="bg-white md:h-56 pt-5 md:pt-16 pb-2 md:pb-0 shadow-lg rounded-md"
                >
                    <img
                        src="/media/site/pencil.svg"
                        alt=""
                        class="mx-auto mb-2 w-4 md:w-max"
                    />
                    <p
                        class="md:text-base text-gray-800 font-light text-center"
                    >
                        {{ __("Manage ad") }}
                    </p>
                </inertia-link>
                <inertia-link
                    href="/faqs/business"
                    class="bg-white md:h-56 pt-5 md:pt-16 pb-2 md:pb-0 shadow-lg rounded-md"
                >
                    <img
                        src="media/site/make.svg"
                        alt=""
                        class="mx-auto mb-2 w-6 md:w-10"
                    />
                    <p class="text-gray-800 font-light text-center">
                        {{ __("Business") }}
                    </p>
                </inertia-link>
                <inertia-link
                    href="/faqs/customer-safety"
                    class="bg-white md:h-56 pt-5 md:pt-16 pb-2 md:pb-0 shadow-lg rounded-md"
                >
                    <img
                        src="media/site/lock.svg"
                        alt=""
                        class="mx-auto mb-2 w-6 md:w-10"
                    />
                    <p class="text-gray-800 font-light text-center">
                        {{ __("Customer safety") }}
                    </p>
                </inertia-link>
                <inertia-link
                    href="/faqs/other-question"
                    class="bg-white md:h-56 pt-5 md:pt-16 pb-5 md:pb-16 shadow-lg rounded-md"
                >
                    <img
                        src="media/site/question.svg"
                        alt=""
                        class="mx-auto mb-2 w-5 md:w-max"
                    />
                    <p class="text-gray-800 font-light text-center">
                        {{ __("Other questions") }}
                    </p>
                </inertia-link>
            </div>
        </section>

        <!-- {{-- Common questions and answers --}} -->
        <section class="bg-white pt-16 pb-10 text-gray-800 px-4">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-60">
                    <div class="">
                        <h5 class="text-xl font-semibold">
                            {{ __("Common questions and answers") }}
                        </h5>
                        <div
                            class="text-gray-500 grid grid-flow-row space-y-4 mt-8 mb-6"
                        >
                            <a href="#!" class="">{{
                                __("Fake emails/messages about Yellasellpay")
                            }}</a>
                            <a href="#!" class="">{{
                                __("Tips & Advice Corona 29/10 2020")
                            }}</a>
                            <a href="#!" class="">{{
                                __("I can not find my ad, where is it?")
                            }}</a>
                            <a href="#!" class="">{{
                                __("Pay for your ad")
                            }}</a>
                            <a href="#!" class="">{{
                                __("The Yellasell package")
                            }}</a>
                            <a href="#!" class="">{{
                                __(
                                    "NOVELTY! Send package - home to home in Iraq"
                                )
                            }}</a>
                        </div>
                        <a href="#!" class="text-primary text-sm">{{
                            __("Show more questions")
                        }}</a>
                    </div>
                    <div class="md:ps-10">
                        <div
                            class="border border-solid border-gray-300 rounded-t-lg overflow-hidden"
                        >
                            <div
                                class="bg-red-500 text-xl text-white font-semibold px-6 pt-6 pb-2"
                            >
                                {{ __("New from customer service") }}
                            </div>
                            <div class="px-5 mt-3 font-light">
                                {{ __("Welcome to Yellasell's help page!") }}
                            </div>
                            <div class="px-5 mt-3 text-sm font-medium">
                                <div class="mt-4">
                                    <!-- {{ __('Important information.
                                At the moment, there are fraud attempts aimed at tricking sensitive information from advertisers who pretend to come from Blocket.
                                Remember not to go ahead with something that feels insecure, but instead ') }} -->
                                    <a href="#!" class="text-primary">{{
                                        __(
                                            "contact your Customer Security department."
                                        )
                                    }}</a>
                                </div>
                                <div class="tracking-widest my-5 font-semibold">
                                    ----------------
                                </div>
                                <div class="">
                                    {{
                                        __(
                                            "Do you have questions about Yellasell housing?"
                                        )
                                    }}
                                </div>
                                <div class="text-primary">
                                    {{
                                        __(
                                            "You will find the most common questions and answers here."
                                        )
                                    }}
                                </div>
                                <div class="tracking-widest my-5 font-semibold">
                                    ----------------
                                </div>
                                <div class="">
                                    *{{
                                        __(
                                            "Please note that the review of an advertisement, renewal or change is usually done within two hours from payment, with the exception of the times between 22.00-07.00 when our review has closed."
                                        )
                                    }}*
                                </div>
                                <div
                                    class="tracking-widest mt-5 mb-3 font-semibold"
                                >
                                    ----------------
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>

<script>
export default {
    data() {
        return {
            searchTxt: ""
        };
    },
    methods: {
        search() {
            this.$inertia.get("/faq/search/" + this.searchTxt);
        }
    }
};
</script>
