<template>
    <section class="col-span-2 w-full shadow-md mt-3 p-3 bg-white rounded-md">
        <div class="font-semibold">
            <i class="fas fa-question-circle text-primary pe-1"></i>
            {{ __("My ads") }}
        </div>
        <ul class="text-primary font-semibold text-sm mt-5 space-y-5">
            <li v-for="faq in faqs" :key="faq.id">
                <inertia-link :href="'/faq/' + faq.id">
                    <i class="fas fa-angle-right pe-2"></i>
                    {{ faq.title }}
                </inertia-link>
            </li>
        </ul>
    </section>
</template>

<script>
export default {
    props: ["faqs"]
};
</script>
