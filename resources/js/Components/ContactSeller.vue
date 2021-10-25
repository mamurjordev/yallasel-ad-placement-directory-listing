<template>
    <section class="mt-5 pt-5 border-t-2 border-solid border-gray-400">
        <div class="grid md:grid-cols-2 gap-3">
            <div class="">
                <div class="font-medium mb-4">{{ __("Sold by") }}</div>
                <inertia-link
                    :href="'/seller/' + post.username"
                    class="text-gray-700 hover:underline"
                    >{{ post.seller }}</inertia-link
                >
            </div>
            <div class="">
                <inertia-link
                    :href="'/chat?u=' + post.user_id"
                    class="w-full block bg-green-400 text-center text-white py-3 rounded-md"
                    ><i class="fas fa-sms"></i>
                    {{ __("Send message") }}</inertia-link
                >
                <div
                    @click="showMobile = true"
                    class="w-full block text-gray-600 text-center border border-solid border-gray-500 rounded-md py-3 mt-3 cursor-pointer"
                >
                    <i class="fas fa-phone-alt me-1"></i>
                    <span v-if="showMobile == false">{{
                        __("Show phone number")
                    }}</span>
                    <a :href="'tel:' + post.phone" v-else>{{ post.phone }}</a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ["post"],
    data: function() {
        return {
            showMobile: false
        };
    }
};
</script>
