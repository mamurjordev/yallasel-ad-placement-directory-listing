<template>
    <!-- Main -->
    <main class="font-notosans">
        <noscript>You need to enable JavaScript to run this app.</noscript>
        <div id="root">
            <sidebar></sidebar>
            <div class="relative md:ml-64 bg-gray-100">
                <top-nav></top-nav>
                <!-- Header -->
                <div class="relative bg-gray-800 md:pt-32 pb-32 pt-12">
                    <div class="px-4 md:px-10 mx-auto w-full">
                        <div>
                            <!-- Card stats -->
                            <cards
                                v-if="!isMobile()"
                                :userCount="userCount"
                                :postCount="postCount"
                                :articleviews="articleviews"
                            ></cards>
                        </div>
                    </div>
                </div>
                <div class="px-4 md:px-10 mx-auto w-full -m-24">
                    <!-- SLOT -->
                    <slot></slot>
                    <admin-footer></admin-footer>
                </div>
            </div>
        </div>
    </main>
    <!-- /Main -->
</template>

<script>
import Sidebar from "@/Components/Admin/Sidebar";
import TopNav from "@/Components/Admin/TopNav";
import Cards from "@/Components/Admin/Cards";
import AdminFooter from "@/Components/Admin/AdminFooter";
export default {
    components: {
        Sidebar,
        TopNav,
        Cards,
        AdminFooter
    },
    computed: {
        userCount() {
            return this.$page.props.userCount;
        },
        postCount() {
            return this.$page.props.postCount;
        },
        articleviews() {
            return this.$page.props.articleviews;
        }
    },
    methods: {
        isMobile() {
            if (screen.width <= 760) {
                return true;
            } else {
                return false;
            }
        }
    }
};
</script>
