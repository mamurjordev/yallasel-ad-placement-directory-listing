<template>
    <app-layout>
        <section class="bg-3">
            <h2
                class="text-center text-2xl font-medium bg-white py-4 border-b border-gray-300 container mx-auto"
            >
                {{ __("Account settings") }}
            </h2>
            <breadcrumbs v-if="!isMobile()" :breads="breads"></breadcrumbs>
            <!-- show my package -->

            <section
                class="container mx-auto font-notosans bg-white p-4 shadow-md my-4 md:mt-0"
            >
                <h4 class="font-medium mb-3">{{ __("My packages") }}</h4>
                <div class="flex justify-between font-semibold">
                    <div v-if="!dateCheck()" class="">
                        {{ __("Subscribed till") }}:
                        {{ myPackage.end_date | moment("DD MMMM, YYYY") }}
                    </div>
                    <div class="">
                        {{ __("Available ads to place") }}:
                        {{ myPackage.allowed_posts }}
                    </div>
                </div>
            </section>

            <!-- Payment -->
            <section class="container mx-auto bg-white mt-6 shadow-md">
                <inertia-link
                    href="/payment/package"
                    class="flex justify-between p-4 h-full"
                >
                    <div class="font-medium">{{ __("Payment") }}</div>
                    <i v-if="lang == 'ar'" class="fas fa-chevron-left"></i>
                    <i v-else class="fas fa-chevron-right"></i>
                </inertia-link>
            </section>

            <!-- Redeem -->
            <section class="container mx-auto bg-white mt-6 shadow-md">
                <inertia-link
                    href="/redeem_code"
                    class="flex justify-between h-full p-4"
                >
                    <div class="font-medium">{{ __("Redeem Code") }}</div>
                    <i v-if="lang == 'ar'" class="fas fa-chevron-left"></i>
                    <i v-else class="fas fa-chevron-right"></i>
                </inertia-link>
            </section>

            <!-- Place for advertising -->
            <section
                class="container mx-auto pt-2 font-notosans bg-white shadow-md mt-6"
            >
                <h5 class="font-medium mx-4">{{ __("Your location") }}</h5>
                <inertia-link
                    href="/account/location"
                    class="flex justify-between p-4 items-center"
                >
                    <div class="">
                        <div>{{ __("choose location") }}</div>
                        <p class="text-gray-500 font-light">
                            {{ account_setting.city_name
                            }}<span v-if="account_setting.region_name">, </span
                            >{{ account_setting.region_name }}
                        </p>
                    </div>
                    <i v-if="lang == 'ar'" class="fas fa-chevron-left"></i>
                    <i v-else class="fas fa-chevron-right"></i>
                </inertia-link>
            </section>
            <!-- Email -->
            <section class="container mx-auto bg-white p-4 mt-6 shadow-md">
                <h4 class="font-medium mb-3">{{ __("Email") }}</h4>
                <div class="space-y-10">
                    <div class="flex justify-start items-end">
                        <div class="w-1/2">
                            <div>{{ __("Surveillance") }}</div>
                            <p class="text-gray-500 text-sm pt-2 font-light">
                                {{
                                    __(
                                        "I receive emails with a summary of my surveillance"
                                    )
                                }}
                            </p>
                        </div>
                        <div
                            class="flex justify-start items-end space-s-10 text-gray-800"
                        >
                            <label for="adwatchMailSummary" class="">
                                <input
                                    id="yes"
                                    type="radio"
                                    v-model="setting.surveillance"
                                    class="w-6 h-6 text-primary mb-1 focus:ring-0 cursor-pointer"
                                    :value="1"
                                />
                                {{ __("Yes") }}
                            </label>
                            <label for="adwatchMailSummary" class="">
                                <input
                                    id="no"
                                    type="radio"
                                    v-model="setting.surveillance"
                                    class="w-6 h-6 text-primary mb-1 focus:ring-0 cursor-pointer"
                                    :value="0"
                                />
                                {{ __("No") }}
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-start items-end">
                        <div class="w-1/2">
                            <div>{{ __("Ad Response Notices") }}</div>
                            <p class="text-gray-500 text-sm pt-2 font-light">
                                {{
                                    __(
                                        "I receive notifications via email when someone sends me a message"
                                    )
                                }}
                            </p>
                        </div>
                        <div
                            class="flex justify-start items-end space-s-10 text-gray-800"
                        >
                            <label for="messagenotify" class="">
                                <input
                                    id="yes"
                                    type="radio"
                                    v-model="setting.messagenotify"
                                    class="w-6 h-6 text-primary mb-1 focus:ring-0 cursor-pointer"
                                    :value="1"
                                />
                                {{ __("Yes") }}
                            </label>
                            <label for="messagenotify" class="">
                                <input
                                    id="no"
                                    type="radio"
                                    v-model="setting.messagenotify"
                                    class="w-6 h-6 text-primary mb-1 focus:ring-0 cursor-pointer"
                                    :value="0"
                                />
                                {{ __("No") }}
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-start items-end">
                        <div class="w-1/2">
                            <div>{{ __("Personal tips, offers and new") }}</div>
                            <p class="text-gray-500 text-sm pt-2 font-light">
                                {{
                                    __(
                                        "I get emails with the latest news from Yallasell"
                                    )
                                }}
                            </p>
                        </div>
                        <div
                            class="flex justify-start items-end space-s-10 text-gray-800"
                        >
                            <label for="adtips" class="">
                                <input
                                    id="yes"
                                    type="radio"
                                    v-model="setting.adtips"
                                    class="w-6 h-6 text-primary mb-1 focus:ring-0 cursor-pointer"
                                    :value="1"
                                />
                                {{ __("Yes") }}
                            </label>
                            <label for="adtips" class="">
                                <input
                                    id="no"
                                    type="radio"
                                    v-model="setting.adtips"
                                    class="w-6 h-6 text-primary mb-1 focus:ring-0 cursor-pointer"
                                    :value="0"
                                />
                                {{ __("No") }}
                            </label>
                        </div>
                    </div>
                </div>
            </section>
            <!-- About me -->
            <section
                class="bg-white container mx-auto p-4 mt-6 text-gray-800 shadow-md"
            >
                <div class="flex justify-between mb-4">
                    <h5 class="font-medium">{{ __("About me") }}</h5>
                    <inertia-link
                        href="/account/setting"
                        class="text-primary font-light"
                        >{{ __("Change") }}</inertia-link
                    >
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <div class="font-light">{{ __("Name") }}</div>
                        <div class="">
                            {{ myinfo.name != null ? myinfo.name : "-" }}
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="font-light">{{ __("Appears in ad") }}</div>
                        <div v-if="lang == 'ar'" class="">
                            {{ myinfo.is_privacy_enabled == 0 ? "لا" : "نعم" }}
                        </div>
                        <div v-else class="">
                            {{ myinfo.is_privacy_enabled == 0 ? "NO" : "YES" }}
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="font-light">{{ __("ZIP code") }}</div>
                        <div class="">
                            {{ myinfo.zip != null ? myinfo.zip : "-" }}
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="font-light">{{ __("Phone") }}</div>
                        <div class="">
                            {{ myinfo.mobile != null ? myinfo.mobile : "-" }}
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="font-light">{{ __("Email") }}</div>
                        <div class="">
                            {{ myinfo.email != null ? myinfo.email : "-" }}
                        </div>
                    </div>
                </div>
            </section>

            <!-- Question and answers -->
            <section
                class="bg-white container mx-auto p-4 mt-6 text-gray-800 shadow-md"
            >
                <div class="mb-4">
                    <h5 class="font-medium">
                        {{ __("Question and answers") }}
                    </h5>
                </div>
                <inertia-link href="/faq" class="flex justify-between">
                    {{ __("Customer service") }}
                </inertia-link>
            </section>
            <div class="text-center">
                <inertia-link
                    href="/logout"
                    method="post"
                    as="button"
                    type="button"
                    class="hover:text-black font-light text-gray-700 uppercase my-8"
                    >Log out</inertia-link
                >
            </div>
        </section>
    </app-layout>

    <!-- {{-- <div class="h-screen"></div> --}} -->
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import Breadcrumbs from "@/Components/Breadcrumb";
import moment from "moment-timezone";
export default {
    props: ["myinfo", "account_setting", "myPackage"],
    data: function() {
        return {
            breads: ["Account settings"],
            setting: {
                surveillance: 1,
                messagenotify: 1,
                adtips: 1
            }
        };
    },
    components: {
        AppLayout,
        Breadcrumbs
    },
    computed: {
        lang() {
            return this.$page.props.language;
        }
    },
    mounted() {
        this.setting.surveillance = this.account_setting.surveillance;
        this.setting.messagenotify = this.account_setting.messagenotify;
        this.setting.adtips = this.account_setting.adtips;
        console.log(this.dateCheck());
    },
    watch: {
        "setting.surveillance"() {
            this.updateSetting();
        },
        "setting.messagenotify"() {
            this.updateSetting();
        },
        "setting.adtips"() {
            this.updateSetting();
        }
    },
    methods: {
        isMobile() {
            return screen.width <= 760 ? true : false;
        },

        updateSetting() {
            axios.put("/api/v1/account-setting", this.setting);
        },
        dateCheck() {
            return moment().isAfter(this.myPackage.end_date);
        }
    }
};
</script>
