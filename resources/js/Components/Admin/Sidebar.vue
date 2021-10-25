<template>
    <nav
        class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-no-wrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
    >
        <div
            class="md:flex-col md:items-stretch md:min-h-full md:flex-no-wrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
        >
            <button
                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                type="button"
                onclick="toggleNavbar('example-collapse-sidebar')"
            >
                <i class="fas fa-bars"></i>
            </button>
            <inertia-link
                class="md:block text-left md:pb-2 text-gray-700 mr-0 inline-block whitespace-no-wrap text-sm uppercase font-bold p-4 px-0"
                href="/panel"
            >
                Yallasell
            </inertia-link>
            <ul class="md:hidden items-center flex flex-wrap list-none">
                <li class="inline-block relative">
                    <a
                        class="text-gray-600 block py-1 px-3"
                        href="#pablo"
                        onclick="openDropdown(event,'notification-dropdown')"
                        ><i class="fas fa-bell"></i
                    ></a>
                    <div
                        class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                        id="notification-dropdown"
                    >
                        <a
                            href="#pablo"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                            >Action</a
                        ><a
                            href="#pablo"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                            >Another action</a
                        ><a
                            href="#pablo"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                            >Something else here</a
                        >
                        <div
                            class="h-0 my-2 border border-solid border-gray-200"
                        ></div>
                        <a
                            href="#pablo"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                            >Seprated link</a
                        >
                    </div>
                </li>
                <li class="inline-block relative">
                    <a
                        class="text-gray-600 block"
                        href="#pablo"
                        onclick="openDropdown(event,'user-responsive-dropdown')"
                        ><div class="items-center flex">
                            <span
                                class="w-12 h-12 text-sm text-white bg-gray-300 inline-flex items-center justify-center rounded-full"
                                ><img
                                    alt="..."
                                    class="w-full rounded-full align-middle border-none shadow-lg"
                                    src="/admin/img/team-1-800x800.jpg"
                            /></span></div
                    ></a>
                    <div
                        class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                        id="user-responsive-dropdown"
                    >
                        <a
                            href="#pablo"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                            >Action</a
                        ><a
                            href="#pablo"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                            >Another action</a
                        ><a
                            href="#pablo"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                            >Something else here</a
                        >
                        <div
                            class="h-0 my-2 border border-solid border-gray-200"
                        ></div>
                        <a
                            href="#pablo"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                            >Seprated link</a
                        >
                    </div>
                </li>
            </ul>
            <div
                class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
                id="example-collapse-sidebar"
            >
                <div
                    class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-gray-300"
                >
                    <div class="flex flex-wrap">
                        <div class="w-6/12">
                            <inertia-link
                                class="md:block text-left md:pb-2 text-gray-700 mr-0 inline-block whitespace-no-wrap text-sm uppercase font-bold p-4 px-0"
                                href="/panel"
                            >
                                Yallasell
                            </inertia-link>
                        </div>
                        <div class="w-6/12 flex justify-end">
                            <button
                                type="button"
                                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                                onclick="toggleNavbar('example-collapse-sidebar')"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Navigation -->
                <ul
                    class="md:flex-col md:min-w-full flex flex-col list-none text-xs uppercase font-bold"
                >
                    <li class="items-center">
                        <inertia-link
                            href="/panel"
                            :class="
                                route().current() == 'panel.'
                                    ? 'text-pink-500 hover:text-pink-600'
                                    : 'text-gray-800 hover:text-gray-600'
                            "
                            class="py-3 block "
                        >
                            <i class="fas fa-tv me-2 text-sm opacity-75"></i>
                            Dashboard
                        </inertia-link>
                    </li>
                    <li class="items-center">
                        <inertia-link
                            href="/panel/post"
                            :class="
                                route().current() == 'panel.post.index'
                                    ? 'text-pink-500 hover:text-pink-600'
                                    : 'text-gray-800 hover:text-gray-600'
                            "
                            class="py-3 block"
                        >
                            <i class="fas fa-tags me-2"></i>
                            All ads
                        </inertia-link>
                    </li>
                    <li class="items-center flex justify-items-start space-x-3">
                        <inertia-link
                            href="/panel/post/pending"
                            :class="
                                route().current() == 'panel.post.index'
                                    ? 'text-pink-500 hover:text-pink-600'
                                    : 'text-gray-800 hover:text-gray-600'
                            "
                            class="py-3 block"
                        >
                            <i class="fas fa-tags me-2"></i>
                            Pending Ads
                        </inertia-link>
                        <div class="bg-red-600 text-white rounded-full px-1">
                            {{ pendingPosts }}
                        </div>
                    </li>
                    <li class="items-center">
                        <inertia-link
                            href="/panel/category"
                            :class="
                                route().current() == 'panel.category.index'
                                    ? 'text-pink-500 hover:text-pink-600'
                                    : 'text-gray-800 hover:text-gray-600'
                            "
                            class="py-3 block"
                        >
                            <i class="fas fa-list me-2"></i>
                            Category
                        </inertia-link>
                    </li>
                    <li class="items-center">
                        <inertia-link
                            href="/panel/faq"
                            :class="
                                route().current() == 'panel.faq.index'
                                    ? 'text-pink-500 hover:text-pink-600'
                                    : 'text-gray-800 hover:text-gray-600'
                            "
                            class="py-3 block"
                        >
                            <i class="fas fa-question-circle me-2"></i>
                            FAQ
                        </inertia-link>
                    </li>
                    <li class="items-center">
                        <div
                            class="py-3 block text-gray-800 hover:text-gray-600 cursor-pointer"
                            @click="
                                locationDropdown =
                                    locationDropdown == true ? false : true
                            "
                        >
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Location
                            <i class="fas fa-caret-down"></i>
                        </div>
                        <div
                            class="space-y-3 ms-8"
                            :class="locationDropdown == false ? 'hidden' : ''"
                        >
                            <inertia-link
                                href="/panel/city"
                                :class="
                                    route().current() == 'panel.city.index'
                                        ? 'text-pink-500 hover:text-pink-600'
                                        : ''
                                "
                                class="block"
                                >Cities</inertia-link
                            >
                            <inertia-link
                                href="/panel/region"
                                :class="
                                    route().current() == 'panel.region.index'
                                        ? 'text-pink-500 hover:text-pink-600'
                                        : ''
                                "
                                class="block"
                                >Region</inertia-link
                            >
                        </div>
                    </li>
                    <li class="items-center">
                        <inertia-link
                            href="/panel/user"
                            :class="
                                route().current() == 'panel.user.index'
                                    ? 'text-pink-500 hover:text-pink-600'
                                    : 'text-gray-800 hover:text-gray-600'
                            "
                            class="py-3 block"
                        >
                            <i class="fas fa-user-friends me-2"></i>
                            Users
                        </inertia-link>
                    </li>
                    <li>
                        <inertia-link
                            href="/panel/widgets"
                            :class="
                                route().current() == 'panel.widgets.index'
                                    ? 'text-pink-500 hover:text-pink-600'
                                    : 'text-gray-800 hover:text-gray-600'
                            "
                            class="py-3 block"
                        >
                            <i class="fas fa-cubes me-2"></i>
                            Sidebar
                        </inertia-link>
                    </li>
                    <li>
                        <inertia-link
                            href="/panel/payment_package"
                            :class="
                                route().current() ==
                                'panel.payment_package.index'
                                    ? 'text-pink-500 hover:text-pink-600'
                                    : 'text-gray-800 hover:text-gray-600'
                            "
                            class="py-3 block"
                        >
                            <i class="fas fa-money-bill-wave me-2"></i>
                            Package
                        </inertia-link>
                    </li>
                    <li>
                        <inertia-link
                            href="/panel/giftcard"
                            :class="
                                route().current() == 'panel.giftcard.index'
                                    ? 'text-pink-500 hover:text-pink-600'
                                    : 'text-gray-800 hover:text-gray-600'
                            "
                            class="py-3 block"
                        >
                            <i class="fas fa-gift me-2"></i>
                            Gift Card
                        </inertia-link>
                    </li>
                    <li>
                        <inertia-link
                            href="/panel/setting/edit"
                            :class="
                                route().current() == 'panel.setting.edit'
                                    ? 'text-pink-500 hover:text-pink-600'
                                    : 'text-gray-800 hover:text-gray-600'
                            "
                            class="py-3 block"
                        >
                            <i class="fas fa-cogs"></i>
                            Settings
                        </inertia-link>
                    </li>
                    <li class="items-center">
                        <div
                            class="py-3 block text-gray-800 hover:text-gray-600 cursor-pointer"
                            @click="dropdown.report = !dropdown.report"
                        >
                            <i class="fas fa-chart-pie me-2"></i>
                            Report
                            <i class="fas fa-caret-down"></i>
                        </div>
                        <div
                            class="space-y-3 ms-8"
                            :class="dropdown.report ? '' : 'hidden'"
                        >
                            <inertia-link
                                href="/panel/statistics/ads"
                                class="block"
                                >Ads</inertia-link
                            >
                            <inertia-link
                                href="/panel/statistics/users"
                                class="block"
                                >Users</inertia-link
                            >
                            <inertia-link
                                href="/panel/statistics/package"
                                class="block"
                                >Package</inertia-link
                            >
                        </div>
                    </li>
                    <li class="items-center">
                        <div
                            class="py-3 block text-gray-800 hover:text-gray-600 cursor-pointer"
                            @click="dropdown.pages = !dropdown.pages"
                        >
                            <i class="fas fa-file me-2"></i>
                            Pages
                            <i class="fas fa-caret-down"></i>
                        </div>
                        <div
                            class="space-y-3 ms-8"
                            :class="dropdown.pages ? '' : 'hidden'"
                        >
                            <inertia-link
                                href="/panel/page/terms-of-use"
                                class="block"
                                >Terms of use</inertia-link
                            >
                        </div>
                    </li>
                    <li>
                        <inertia-link
                            href="/panel/setting/apps"
                            :class="
                                route().current() == 'panel.apps.edit'
                                    ? 'text-pink-500 hover:text-pink-600'
                                    : 'text-gray-800 hover:text-gray-600'
                            "
                            class="py-3 block"
                        >
                            <i class="fas fa-mobile-alt me-2"></i>
                            Apps
                        </inertia-link>
                    </li>
                </ul>
                <inertia-link
                    href="/panel/logout"
                    as="button"
                    type="button"
                    class="hover:text-black border-t border-gray-300 mt-5 py-2 text-white font-medium rounded bg-red-500"
                    >Logout</inertia-link
                >
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    data: function() {
        return {
            locationDropdown: false,
            dropdown: {
                report: false,
                pages: false
            }
        };
    },
    mounted() {
        if (
            this.route().current() == "panel.region.index" ||
            this.route().current() == "panel.city.index"
        ) {
            this.locationDropdown = true;
        }
    },
    computed: {
        pendingPosts() {
            return this.$page.props.pendingPosts;
        }
    }
};
</script>
