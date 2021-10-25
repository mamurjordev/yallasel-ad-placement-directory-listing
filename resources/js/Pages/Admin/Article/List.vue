<template>
    <admin-layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0"
                >
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6
                                class="text-gray-800 text-xl font-bold capitalize"
                            >
                                Article List
                            </h6>
                            <inertia-link
                                :href="$route('panel.article.create')"
                                class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                preserve-scroll
                            >
                                Add Article
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
                                    v-for="(content, index) in articles.data"
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
                                        {{ content.title }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                                    >
                                        {{ content.views }}
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
                                                    'panel.article.edit',
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
                                        <!-- <inertia-link
                      as="button"
                      preserve-scroll
                      method="DELETE"
                      :onStart="
                        () => confirm('Are you sure you delete this post?')
                      "
                      :href="$route('panel.article.destroy', content.id)"
                      class="text-red-500 background-transparent font-bold uppercase outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                      type="button"
                    >
                      <i class="fas fa-trash-alt"></i>
                    </inertia-link> -->
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
                        <inertia-link
                            href="#"
                            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                        >
                            <span class="sr-only">Previous</span>
                            <!-- Heroicon name: solid/chevron-left -->
                            <i class="fas fa-chevron-left"></i>
                        </inertia-link>
                        <div
                            v-for="link in articles.links"
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
                        <span
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700"
                        >
                            ...
                        </span>
                        <inertia-link
                            v-if="nextpage"
                            :href="nextpage"
                            preserve-scroll
                            class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                        >
                            <span class="sr-only">Next</span>
                            <!-- Heroicon name: solid/chevron-right -->
                            <i class="fas fa-chevron-right"></i>
                        </inertia-link>
                    </nav>
                </section>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import TableVue from "@/Components/Admin/Table";
export default {
    components: {
        AdminLayout,
        TableVue
    },
    props: ["articles"],
    data: function() {
        return {
            Headers: [
                "SR",
                "Title",
                "Views",
                "Created at",
                "Updated at",
                "Action"
            ],
            nextpage: this.articles.next_page_url
            //   tableData: []
        };
    },
    methods: {
        destroy(e) {
            if (!confirm("Are you sure want to remove?")) return;
            this.$inertia.delete(this.route("panel.article.destroy", e.id), {
                preserveScroll: page => Object.keys(page.props.errors).length
            });
            //   if (!confirm("Are you sure want to remove?")) return;

            //   data._method = "DELETE";
            //   this.$inertia.delete("/article/" + e.id, e);
        }
        // toogleComponent() {
        //   if (this.component == "table-vue") {
        //     (this.component = "form-category"),
        //       (this.componentName = "Add Category"),
        //       (this.Button = "View Category");
        //   } else {
        //     (this.component = "table-vue"),
        //       (this.componentName = "Category"),
        //       (this.Button = "Add Category");
        //   }
        // },
    }
};
</script>
