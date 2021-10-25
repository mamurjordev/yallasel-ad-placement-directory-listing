<template>
    <app-layout>
        <breadcrumb :breads="breads" />

        <div v-if="showReport == true" class="container mx-auto mb-5 px-2">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 px-2">
                <div class="md:col-span-2">
                    <item-images
                        v-if="post_images.length"
                        :post_images="post_images"
                    ></item-images>
                    <item-info
                        :post="post"
                        :favorite_id="favorite_id"
                        class="mt-5"
                    />
                    <ad-attributes
                        v-if="post_attributes"
                        :post_attributes="post_attributes"
                    />

                    <!-- <equipment /> -->
                    <description :detail="post.detail"></description>
                    <contact-seller :post="post"></contact-seller>
                    <!-- <novelty></novelty>
                    <sale-contract></sale-contract> -->
                    <!-- {{-- Remove, modify, renew your ad --}} -->
                    <section
                        class="text-sm text-gray-700 font-light mt-3 pt-3 border-t-2 border-solid border-gray-400"
                    >
                        <!-- <a href="#!" class="hover:underline"
              ><i class="fas fa-pencil-alt"></i>
              {{ __("Remove, modify, renew your ad") }}</a
            > -->
                        <!-- <div
                            @click="reportAd()"
                            href="#!"
                            class="hover:underline float-end"
                        >
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ __("Report ad") }}
                        </div> -->
                    </section>
                </div>
                <!-- {{-- /Item info --}} -->
                <!-- Sidebar -->
                <section class="">
                    <sidebar :widgets="widgets"></sidebar>
                </section>
            </div>
        </div>
        <div v-else class="container mx-auto mb-5">
            <i class="fas fa-times"></i>
            <div class="text-center text-gray-800">
                <h5 class="font-medium">{{ __("Report ad") }}</h5>
                <p class="font-light text-sm my-3">
                    {{ __("Seeder and Spreader") }}
                </p>
            </div>
            <form action="">
                <textarea
                    rows="10"
                    class="w-full rounded-md"
                    placeholder="Describe your application"
                ></textarea>

                <input
                    type="text"
                    placeholder="Name"
                    class="w-full rounded-md mt-5"
                />
                <input
                    type="text"
                    placeholder="E-mail"
                    class="w-full rounded-md mt-5"
                />
            </form>
        </div>
        <related-products v-if="posts.length" :ads="posts"></related-products>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb";
import ItemImages from "@/Components/ItemImages";
import ItemInfo from "@/Components/ItemInfo";
import adAttributes from "@/Components/adAttributes";
import Equipment from "@/Components/Equipment";
import Description from "@/Components/Description";
import ContactSeller from "@/Components/ContactSeller";
import Sidebar from "@/Components/Sidebar";
import Novelty from "@/Components/Novelty";
import SaleContract from "@/Components/SaleContract";
import RelatedProducts from "@/Components/RelatedProducts";

export default {
    props: [
        "post",
        "post_images",
        "favorite_id",
        "post_attributes",
        "category",
        "widgets"
    ],
    components: {
        AppLayout,
        Breadcrumb,
        ItemImages,
        ItemInfo,
        adAttributes,
        Equipment,
        Description,
        ContactSeller,
        Sidebar,
        Novelty,
        SaleContract,
        RelatedProducts
    },
    data() {
        return {
            posts: "",
            showReport: true,

            breads: {
                0: {
                    url: "/category/" + this.category.id,
                    label: this.category.category_name
                },
                1: {
                    url: "",
                    label: this.post.title
                }
            }
        };
    },
    mounted() {
        axios
            .get("/api/v1/related-ads?postID=" + this.post.id + "&limit=4")
            .then(response => (this.posts = response.data))
            .catch(error => {
                console.error("There was an error!", error);
            });
    },
    methods: {
        reportAd() {}
    }
};
</script>

<style scoped>
textarea {
    resize: none;
}
</style>
