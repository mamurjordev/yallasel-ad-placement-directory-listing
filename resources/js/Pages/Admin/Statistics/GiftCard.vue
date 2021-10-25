<template>
    <admin-layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0"
                >
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <div class="flex justify-items-start space-x-3">
                                <h6
                                    class="text-gray-800 text-xl font-bold capitalize"
                                >
                                    Gift code Statistics
                                </h6>
                                <div
                                    @click="dataExport"
                                    class="self-center text-blue-700 bg-gray-200 px-3 py-1 rounded font-semibold cursor-pointer"
                                >
                                    Export
                                </div>
                            </div>
                            <inertia-link
                                href="/panel/giftcard"
                                class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                preserve-scroll
                            >
                                Back to List
                            </inertia-link>
                        </div>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <!-- Projects table -->
                        <table
                            class="items-center w-full bg-transparent border-collapse"
                        >
                            <thead>
                                <tr>
                                    <th
                                        v-for="header in headers"
                                        :key="header"
                                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left bg-gray-100 text-gray-600 border-gray-200"
                                    >
                                        {{ header }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(content,
                                    index) in user_redeems.data"
                                    :key="content.id"
                                >
                                    <th
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 text-left flex items-center"
                                    >
                                        {{ index + 1 }}
                                    </th>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                                    >
                                        {{ content.code }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                                    >
                                        {{ content.total }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Paginate -->
                <section>
                    <nav
                        class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                        aria-label="Pagination"
                    >
                        <div
                            v-for="link in user_redeems.links"
                            :key="link.id"
                            class=""
                        >
                            <inertia-link
                                v-if="link.url"
                                :href="link.url"
                                preserve-scroll
                                :class="
                                    link.active
                                        ? 'bg-red-400 text-white'
                                        : 'text-gray-700 bg-white'
                                "
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium hover:bg-gray-50"
                                v-html="link.label"
                            >
                            </inertia-link>
                        </div>
                    </nav>
                </section>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
export default {
    props: ["user_redeems"],
    components: {
        AdminLayout
    },
    data: function() {
        return {
            headers: ["SR", "CODE", "USES"]
        };
    },
    methods: {
        dataExport() {}
    }
};
</script>
