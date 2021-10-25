<template>
    <!-- <section class="bg-red-50 pb-5">
      <section
        class="lg:container w-full px-5 lg:mx-auto md:grid grid-cols-6 gap-3"
      > -->
    <!-- Main -->
    <section class="col-span-4">
        <!-- title -->
        <button
            class="my-4 font-bold cursor-pointer focus:outline-none"
            @click="visibiliy"
        >
            {{ title }} <i :class="arrow" class="fas ps-2"></i>
        </button>

        <!-- ADS -->
        <section :class="[!isHidden ? 'hidden' : '']" class="space-y-4">
            <section
                v-for="post in posts"
                :key="post.id"
                class="shadow-md p-3 bg-white rounded-md border-b-2 border-gray-500"
            >
                <div class="md:grid grid-cols-7 gap-5">
                    <img
                        :src="'/media/posts/' + post.image"
                        :alt="post.title"
                        class="w-full h-40 col-span-3 lg:col-span-2 mb-4 md:mb-0"
                    />
                    <div class="col-span-4 lg:col-span-5">
                        <div class="flex justify-between border-b pb-4">
                            <div class="font-medium">
                                <span class="block text-xs text-gray-600">{{
                                    post.category_name
                                }}</span>
                                <inertia-link
                                    :href="'ads/' + post.id"
                                    class="hover:underline"
                                    >{{ post.title }}</inertia-link
                                >
                            </div>
                            <div class="">
                                <button
                                    @click="boost(post)"
                                    v-if="post.status == 'publish'"
                                >
                                    <i
                                        :class="
                                            isBoosted(post.boost_until)
                                                ? 'border-yellow-600 text-yellow-600'
                                                : 'border-gray-400 text-gray-400'
                                        "
                                        class="fas fa-crown border rounded-md p-3"
                                    ></i>
                                </button>
                                <inertia-link
                                    :href="'/edit-ad/' + post.id"
                                    class="cursor-pointer"
                                >
                                    <i
                                        class="fas fa-pencil-alt border border-black rounded-md p-3"
                                    ></i>
                                </inertia-link>
                            </div>
                        </div>
                        <div
                            class="grid grid-cols-2 grid-rows-2 gap-2 mt-2 text-gray-600 font-medium"
                        >
                            <div class="">
                                <i class="fas fa-coins"></i>
                                {{ post.expected_price }} IQD
                            </div>
                            <div
                                v-for="(attribute, index) in JSON.parse(
                                    post.post_attribute
                                )"
                                :key="index"
                                class=""
                            >
                                <i
                                    :class="attribute.property_icon"
                                    class="text-4xl pt-2 me-4"
                                ></i>
                                {{ attribute.property_value }}
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4 mt-4"
                >
                    <button
                        v-if="post.status == 'publish'"
                        @click="unpublishPost(post.id)"
                        class="bg-gray-400 text-gray-900 py-2 rounded"
                    >
                        {{ __("Unpublish") }}
                    </button>
                    <button
                        v-if="post.status == 'unpublish'"
                        @click="publishPost(post.id)"
                        class="bg-gray-400 text-gray-900 py-2 rounded"
                    >
                        {{ __("Publish") }}
                    </button>
                    <!-- <button class="bg-green-500 text-white py-2 rounded text-sm">
            {{ __("Preview") }}
          </button> -->
                    <button
                        @click="deletePost(post.id)"
                        class="bg-red-500 text-white py-2 rounded text-sm"
                    >
                        {{ __("Delete") }}
                    </button>
                </div>
            </section>
        </section>

        <boostPost
            v-if="modalData"
            v-on:closeModal="modalData = null"
            :post="modalData"
        />
    </section>

    <!-- </section>
    </section> -->
</template>

<script>
import boostPost from "@/Components/Modal/boostPost";
import moment from "moment-timezone";
export default {
    props: ["title", "posts", "show"],
    components: {
        boostPost
    },
    data: function() {
        return {
            isHidden: this.show,
            arrow: "fa-angle-down",
            modalData: null
        };
    },
    methods: {
        publishPost(postID) {
            this.$inertia.visit("/publish-post/" + postID, { method: "put" });
        },
        unpublishPost(postID) {
            this.$inertia.visit("/unpublish-post/" + postID, { method: "put" });
        },
        deletePost(postID) {
            // this.$inertia.visit("/post/" + postID, { method: "delete" });
            if (!confirm("Are you sure want to remove?")) return;
            this.$inertia.visit("/post/" + postID, {
                method: "delete",
                preserveScroll: page => Object.keys(page.props.errors).length
            });
            // axios.delete("/api/v1/post/" + postID).then(response => {
            //     this.$inertia.reload({ only: ["posts"] });
            // });
        },
        visibiliy: function() {
            this.isHidden = !this.isHidden;
            this.arrow =
                this.arrow == "fa-angle-down" ? "fa-angle-up" : "fa-angle-down";
        },
        boost(data) {
            this.modalData = data;
        },
        isBoosted(date) {
            if (moment(date) > moment()) {
                return true;
            }
        }
    }
};
</script>
