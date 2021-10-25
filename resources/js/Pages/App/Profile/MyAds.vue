<template>
    <app-layout>
        <div class="lg:container mx-auto p-5">
            <div
                :class="boostedAds > 0 ? 'bg-green-100' : 'bg-red-100'"
                class="font-semibold shadow px-5 py-2 border border-gray-200 text-gray-800 text-lg"
            >
                {{ __("You have") }} {{ boostedAds }} {{ __("Ads in boost") }}
            </div>
        </div>
        <div
            class="lg:container w-full px-5 lg:mx-auto md:grid grid-cols-6 gap-3 mb-3"
            v-if="
                pendingPosts.length ||
                    publishedPosts.length ||
                    unPublishedPosts.length
            "
        >
            <div class="col-span-4">
                <listing
                    :show="show"
                    v-if="pendingPosts.length"
                    title="Pending ads"
                    :posts="pendingPosts"
                ></listing>
                <listing
                    v-if="unPublishedPosts.length"
                    title="Unpublished ads"
                    :posts="unPublishedPosts"
                ></listing>
                <listing
                    :show="show"
                    v-if="publishedPosts.length"
                    title="Published ads"
                    :posts="publishedPosts"
                ></listing>
                <div class="text-center my-5">
                    <inertia-link
                        as="button"
                        href="/post-ad"
                        class="bg-white text-gray-700 border border-gray-700 rounded-md px-10 py-1"
                        >{{ __("Create advertisement") }}</inertia-link
                    >
                </div>
            </div>
            <sidebar :faqs="faqs"></sidebar>
        </div>
        <no-ads v-else></no-ads>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import NoAds from "@/Components/User/NoAds";
import Listing from "@/Components/User/Listing";
import Sidebar from "@/Components/User/PostListSidebar";
export default {
    props: [
        "pendingPosts",
        "unPublishedPosts",
        "publishedPosts",
        "faqs",
        "boostedAds"
    ],
    data() {
        return {
            show: true
        };
    },
    computed: {
        boostCancel() {
            this.$page.props.errors.cancel;
        }
    },
    components: {
        AppLayout,
        NoAds,
        Listing,
        Sidebar
    }
};
</script>
