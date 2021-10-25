<template>
    <section>
        <!-- Nav Bar -->
        <nav class="bg-white border-b border-solid border-gray-300 z-50">
            <div class="container mx-auto">
                <div class="flex items-center justify-between h-16 px-2">
                    <!-- {{-- Start Menu --}} -->
                    <div
                        class="flex items-center justify-center sm:items-stretch sm:justify-start"
                    >
                        <inertia-link
                            href="/"
                            class="flex-shrink-0 flex items-center"
                        >
                            <img
                                class="md:hidden h-10 ps-5 w-auto"
                                :src="
                                    '/media/site/' +
                                        (setting.site_mobile_logo
                                            ? setting.site_mobile_logo
                                            : 'mobile_logo.svg')
                                "
                                alt="yellasell"
                            />
                            <img
                                class="hidden md:block h-10 w-auto"
                                :src="
                                    '/media/site/' +
                                        (setting.site_logo
                                            ? setting.site_logo
                                            : 'logo.png')
                                "
                                alt="yellasell"
                            />
                        </inertia-link>
                        <!-- {{-- Dropdown --}} -->
                        <div class="hidden md:block self-center">
                            <button
                                @click="megaMenuDropDown = !megaMenuDropDown"
                                class="ps-6 focus:outline-none"
                            >
                                {{ __("Categories") }}
                                <i class="fas fa-chevron-down ps-1"></i>
                            </button>
                            <!-- {{-- Mega Menu Start --}} -->
                            <div
                                :class="megaMenuDropDown ? '' : 'hidden'"
                                class="overlay fixed bg-white h-full w-screen start-0 top-24 z-50 bg-opacity-40"
                                @click="megaMenuDropDown = !megaMenuDropDown"
                            ></div>
                            <div
                                :class="megaMenuDropDown ? '' : 'hidden'"
                                class="mega-menu shadow-md absolute bg-white w-screen start-0 top-24 z-50 border-t border-solid border-gray-200"
                            >
                                <div
                                    class="container mx-auto column-auto-4 gap-5 text-gray-800 leading-relaxed pb-3 px-3 pt-4"
                                >
                                    <div class="grid">
                                        <inertia-link
                                            href="/category"
                                            class="text-lg font-semibold hover:underline"
                                            >{{ __("All ads on Yellasell") }}
                                            <i
                                                :class="
                                                    lang == 'ar'
                                                        ? 'fa-angle-left'
                                                        : 'fa-angle-right'
                                                "
                                                class="fas text-xs text-gray-500"
                                            ></i
                                        ></inertia-link>
                                    </div>
                                    <div
                                        class="grid"
                                        v-for="category in categories"
                                        :key="category.id"
                                    >
                                        <inertia-link
                                            :href="'/category/' + category.id"
                                            class="text-lg font-semibold hover:underline capitalize"
                                            >{{
                                                lang == "ar"
                                                    ? category.category_name_ar
                                                    : category.category_name
                                            }}
                                            <i
                                                :class="
                                                    lang == 'ar'
                                                        ? 'fa-angle-left'
                                                        : 'fa-angle-right'
                                                "
                                                class="fas text-xs text-gray-500"
                                            ></i
                                        ></inertia-link>
                                        <inertia-link
                                            v-for="child in category.childs"
                                            :key="child.id"
                                            :href="'/category/' + child.id"
                                            class="hover:underline capitalize"
                                        >
                                            {{
                                                lang == "ar"
                                                    ? child.category_name_ar
                                                    : child.category_name
                                            }}</inertia-link
                                        >
                                    </div>
                                </div>
                            </div>
                            <!-- {{-- Mega Menu End --}} -->
                        </div>

                        <!-- {{-- Dropdown END --}} -->
                    </div>

                    <!-- {{-- End Menu --}} -->
                    <div
                        class="flex-1 right-0 flex justify-end pr-2 sm:static sm:inset-auto sm:pr-0"
                    >
                        <div class="pt-2 mr-8 hidden md:inline-block mb-3 me-5">
                            <inertia-link
                                class="bg-bg2 text-white text-sm font-bold py-2 px-7 align-middle w-max rounded capitalize"
                                href="/my-ads/place-ad"
                            >
                                <i
                                    class="fas fa-plus-circle pe-2 text-base"
                                ></i>
                                {{ __("place ad") }}
                            </inertia-link>
                        </div>
                        <div class="flex justify-evenly px-2">
                            <inertia-link
                                href="/category"
                                class="ps-5 md:inline-block text-center hover:underline"
                            >
                                <i class="fas fa-search"></i>
                                <p class="text-xs">
                                    {{ __("Adverts") }}
                                </p>
                            </inertia-link>
                            <inertia-link
                                href="/chat"
                                class="ps-5 md:inline-block text-center hover:underline"
                            >
                                <i class="far fa-comment-dots"></i>
                                <p class="text-xs">
                                    {{ __("Messages") }}
                                </p>
                            </inertia-link>
                            <inertia-link
                                href="/saved-ads"
                                class="ps-5 md:inline-block text-center hover:underline"
                            >
                                <i class="far fa-heart"></i>
                                <p class="text-xs">
                                    {{ __("Saved") }}
                                </p>
                            </inertia-link>
                            <div
                                v-if="user"
                                @click="userDropDown = !userDropDown"
                                id="profileNav"
                                class="ps-5 md:inline-block text-center hover:underline cursor-pointer relative"
                            >
                                <i class="far fa-user-circle"></i>
                                <p class="text-xs">
                                    {{ user.username }}
                                </p>
                                <div
                                    :class="userDropDown ? '' : 'hidden'"
                                    class="shadow-md absolute bg-white end-0 top-12 z-50 border border-solid border-gray-800 rounded text-start w-56 p-5"
                                >
                                    <h4
                                        class="font-medium text-sm border-b border-gray-300 mb-2 pb-2"
                                    >
                                        {{ user.username }}
                                    </h4>
                                    <div
                                        class="text-gray-700 text-sm grid space-y-3"
                                    >
                                        <!-- <inertia-link
                                            href=""
                                            class="hover:text-black"
                                            >Surveillance</inertia-link
                                        > -->
                                        <inertia-link
                                            href="/saved-ads"
                                            class="hover:text-black"
                                            >{{
                                                __("Saved Advertisements")
                                            }}</inertia-link
                                        >
                                        <inertia-link
                                            href="/my-ads"
                                            class="hover:text-black"
                                            >{{ __("My ads") }}</inertia-link
                                        >
                                        <inertia-link
                                            href="/account"
                                            class="hover:text-black"
                                            >{{
                                                __("Account settings")
                                            }}</inertia-link
                                        >
                                        <inertia-link
                                            href="/payment/package"
                                            class="hover:text-black"
                                            >{{ __("Payment") }}</inertia-link
                                        >
                                        <div
                                            class="text-center border-t border-gray-300 pt-3"
                                        >
                                            <inertia-link
                                                href="/user/logout"
                                                as="button"
                                                type="button"
                                                class="hover:text-black text-start border-t border-gray-300 py-1 bg-red-500 font-semibold text-white px-10 rounded"
                                                >{{
                                                    __("Logout")
                                                }}</inertia-link
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <inertia-link
                                v-else
                                href="/login"
                                class="ps-5 md:inline-block text-center hover:underline"
                            >
                                <i class="far fa-user-circle"></i>
                                <p class="text-xs">
                                    {{ __("Log in") }}
                                </p>
                            </inertia-link>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </section>
</template>

<script>
export default {
    data: function() {
        return {
            categories: null,

            userDropDown: false,
            megaMenuDropDown: false
        };
    },
    computed: {
        user() {
            return this.$page.props.user;
        },
        setting() {
            return this.$page.props.setting;
        },
        lang() {
            return this.$page.props.language;
        }
    },
    mounted() {
        axios
            .get("/api/v1/category")
            .then(response => (this.categories = response.data));
    }
};
</script>
