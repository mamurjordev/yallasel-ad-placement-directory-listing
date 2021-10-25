<template>
    <!-- {{-- Top Nav --}} -->
    <section class="bg-gray-700">
        <div class="container mx-auto py-1 text-white px-10">
            <a v-if="lang == 'ar'" href="/language/en" class=""
                ><i class="fas fa-language"></i> ENGLISH</a
            >
            <a v-else href="/language/ar" class=""
                ><i class="fas fa-language"></i> العربية</a
            >
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {};
    },
    computed: {
        lang() {
            return this.$page.props.language;
        }
    }
};
</script>
