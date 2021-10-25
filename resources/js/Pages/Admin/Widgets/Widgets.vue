<template>
    <admin-layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0 p-5"
                >
                    <div class="flex justify-start space-s-5 text-white">
                        <inertia-link
                            href="/panel/widgets/category-page"
                            class="bg-green-600 py-1 rounded px-5"
                            >Category Page</inertia-link
                        >
                        <inertia-link
                            href="/panel/widgets/single-page"
                            class="bg-red-600 py-1 rounded px-5"
                            >Single Page</inertia-link
                        >
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
export default {
    components: {
        AdminLayout
    }
};
</script>
