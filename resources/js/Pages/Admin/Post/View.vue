<template>
    <admin-layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full px-4">
                <div class="relative bg-white px-5 py-5">
                    <div class="font-semibold text-lg">
                        {{ post.title }}
                    </div>
                    <div
                        class="flex justify-between border-t border-b border-gray-200 py-1 my-2"
                    >
                        <div class="">{{ __("User") }}: {{ post.name }}</div>
                        <div class="">{{ __("Email") }}: {{ post.email }}</div>
                        <div class="">{{ __("Phone") }}: {{ post.phone }}</div>
                        <div class="">
                            {{ __("Status") }}: {{ post.status }}
                        </div>
                    </div>
                    <div
                        class="flex justify-between border-t border-b border-gray-200 py-1 my-2"
                    >
                        <div class="">
                            {{ __("City") }}: {{ post.city_name }}
                        </div>
                        <div class="">
                            {{ __("Region") }}: {{ post.region_name }}
                        </div>
                        <div class="">
                            {{ __("Zipcode") }}: {{ post.zipcode }}
                        </div>
                        <div class="">
                            {{ __("Price") }}: {{ post.expected_price }} IQD
                        </div>
                    </div>
                    <div
                        class="flex justify-between border-t border-b border-gray-200 py-1 my-2"
                    >
                        <div class="">
                            {{ __("Reason") }}: {{ post.reason }}
                        </div>
                        <div class="">
                            {{ __("Paid") }}:
                            {{ post.is_paid == 1 ? "True" : "False" }}
                        </div>
                        <div class="">
                            {{ __("Type") }}:
                            {{
                                post.is_individual == 1 ? "Private" : "Business"
                            }}
                        </div>
                        <div class="capitalize">
                            {{ __("Category") }}:
                            {{ category.category_name }}
                        </div>
                    </div>
                    <div
                        class="grid md:grid-cols-5 my-5 border-t border-b border-gray-300 py-2"
                    >
                        <img
                            v-for="(post_image, index) in post_images"
                            :key="index"
                            :src="'/media/posts/' + post_image.image"
                            alt=""
                        />
                    </div>
                    <div v-html="post.detail" class=""></div>
                    <div class="mt-10 grid grid-cols-2 gap-5">
                        <inertia-link
                            as="button"
                            :href="'/panel/post-approve/' + post.id"
                            v-if="post.status == 'pending'"
                            class="bg-green-500 text-black font-semibold text-lg w-full py-2 rounded tracking-wide"
                        >
                            Approve
                        </inertia-link>
                        <inertia-link
                            as="button"
                            :href="'/panel/post-delete/' + post.id"
                            class="text-red-600 font-medium w-full py-2 border border-red-500 rounded tracking-wide"
                        >
                            Remove
                        </inertia-link>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
export default {
    props: ["post", "category", "post_images"],
    components: {
        AdminLayout
    }
};
</script>
