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
                    Searched FAQs
                </h1>
                <div class="" v-if="faqs">
                    <div v-for="faq in faqs" :key="faq.id" class="">
                        <inertia-link
                            :href="'/faq/' + faq.id"
                            class="text-primary"
                            >{{ faq.title }}</inertia-link
                        >
                    </div>
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
    props: ["faqs"],
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
    }
};
</script>
