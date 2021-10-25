<template>
    <div class="font-notosans flex flex-col min-h-screen">
        <div class="container mx-auto flex-grow">
            <section class="text-red-600 font-extrabold text-3xl my-2">
                {{ __("Yallasell") }}
            </section>
            <div class="border border-gray-300"></div>
            <Breadcrumb :breads="breads" />
            <section class="text-gray-700">
                <div class="text-4xl font-semibold">{{ faq.title }}</div>
                <div class="my-5" v-html="faq.details"></div>
            </section>
        </div>
        <footer-vue />
    </div>
</template>

<script>
import Breadcrumb from "@/Components/Breadcrumb";
import FooterVue from "@/Components/Footer";
export default {
    props: ["faq"],
    components: {
        Breadcrumb,
        FooterVue
    },
    data() {
        return {
            breads: {
                0: {
                    url: "/faq",
                    label: "FAQ"
                },
                1: {
                    url: "/faqs/" + this.faq.params,
                    label: this.faq.category
                }
            }
        };
    }
};
</script>
