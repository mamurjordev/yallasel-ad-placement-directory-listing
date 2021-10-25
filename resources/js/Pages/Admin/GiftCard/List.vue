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
                                    Gift Card List
                                </h6>
                                <inertia-link
                                    href="/panel/statistics/giftcard"
                                    class="self-center text-blue-600 underline text-sm tracking-wider"
                                >
                                    Details Information
                                </inertia-link>
                            </div>
                            <inertia-link
                                :href="$route('panel.giftcard.create')"
                                class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                preserve-scroll
                            >
                                Add Gift Card
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
                                        v-for="header in Headers"
                                        :key="header"
                                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left bg-gray-100 text-gray-600 border-gray-200"
                                    >
                                        {{ header }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(content, index) in giftCards.data"
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
                                        {{ content.name }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                                    >
                                        {{ content.code }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                                    >
                                        {{
                                            value(
                                                content.type,
                                                content.post_count,
                                                content.days
                                            )
                                        }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                                    >
                                        {{
                                            content.created_at
                                                | moment("DD MMMM, YYYY")
                                        }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                                    >
                                        {{
                                            content.updated_at
                                                | moment("DD MMMM, YYYY")
                                        }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 space-s-5"
                                    >
                                        <inertia-link
                                            as="button"
                                            :href="
                                                $route(
                                                    'panel.giftcard.edit',
                                                    content.id
                                                )
                                            "
                                            class="text-red-500 background-transparent font-bold uppercase outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                            type="button"
                                        >
                                            <i class="far fa-edit"></i>
                                        </inertia-link>
                                        <button
                                            class="text-red-500 background-transparent font-bold uppercase outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                            @click="destroy(content)"
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
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
                            v-for="link in giftCards.links"
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
                            >
                                {{ link.label }}
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
    components: {
        AdminLayout
    },
    props: ["giftCards"],
    data: function() {
        return {
            Headers: [
                "SR",
                "Name",
                "Code",
                "Value",
                "Created at",
                "Updated at",
                "Action"
            ]
        };
    },
    methods: {
        destroy(e) {
            if (!confirm("Are you sure want to remove?")) return;
            this.$inertia.delete(this.route("panel.giftcard.destroy", e.id), {
                preserveScroll: page => Object.keys(page.props.errors).length
            });
        },

        value(type, post_count, days) {
            if (type == "subscription") {
                return days + " days";
            } else {
                return post_count + " Posts";
            }
        }
    }
};
</script>
