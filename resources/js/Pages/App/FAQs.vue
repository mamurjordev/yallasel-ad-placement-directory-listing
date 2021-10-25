<template>
    <section class="font-notosans">
        <section class="container mx-auto py-2">
            <inertia-link href="/" class="text-red-500 font-black text-3xl">
                Yellasell
            </inertia-link>
        </section>
        <section class="border-t border-gray-400">
            <div class="container mx-auto text-gray-800">
                <Breadcrumb :breads="breads" />
                <h1 class="text-4xl font-extrabold my-5 capitalize">
                    {{ title }}
                </h1>
                <div v-for="faq in faqs" :key="faq.id" class="">
                    <div class="font-semibold text-xl">
                        {{ faq.sub_category }}
                    </div>
                    <inertia-link
                        :href="'/faq/' + faq.id"
                        class="text-primary font-light"
                        >{{ faq.title }}</inertia-link
                    >
                </div>
            </div>
        </section>
        <footer-vue class="mt-12" />
    </section>
</template>

<script>
import Breadcrumb from "@/Components/Breadcrumb";
import FooterVue from "@/Components/Footer";
export default {
    props: ["faqs", "pageTitle"],
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
                }
            }
        };
    },
    computed: {
        title() {
            var a = this.pageTitle;
            return a.split("_").join(" ");
        }
    }
};
</script>
