<template>
  <div class="w-full px-4">
    <div
      class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0"
    >
      <div class="rounded-t bg-white mb-0 px-6 py-6">
        <div class="text-center flex justify-between">
          <h6 class="text-gray-800 text-xl font-bold capitalize">
            {{ tableName }} List
          </h6>
          <inertia-link
            :href="$route('panel.category.create')"
            class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
            preserve-scroll
          >
            Add {{ tableName }}
          </inertia-link>
        </div>
      </div>
      <div class="block w-full overflow-x-auto">
        <!-- Projects table -->
        <table class="items-center w-full bg-transparent border-collapse">
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
              v-for="(content, index) in tableContents.data"
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
                {{ content.category_name }}
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
              >
                <p class="capitalize" v-if="content.parent_category_name">
                  {{ content.parent_category_name }}
                </p>
                <p v-else>None</p>
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
              >
                {{ content.created_at | moment("DD MMMM, YYYY") }}
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
              >
                {{
                  content.updated_at == content.created_at ? "not updated yet" : content.updated_at | moment("DD MMMM, YYYY")
                }}
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 space-s-5"
              >
                <inertia-link
                  as="button"
                  :href="$route('panel.category.edit', content.id)"
                  class="text-red-500 background-transparent font-bold uppercase outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                  type="button"
                >
                  <i class="far fa-edit"></i>
                </inertia-link>
                <inertia-link
                  as="button"
                  preserve-scroll
                  method="DELETE"
                  :href="$route('panel.category.destroy', content.id)"
                  class="text-red-500 background-transparent font-bold uppercase outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                  type="button"
                >
                  <i class="fas fa-trash-alt"></i>
                </inertia-link>
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
        <div v-for="link in tableContents.links" :key="link.id" class="">
          <inertia-link
            v-if="link.url"
            :href="link.url"
            v-html="link.label"
            preserve-scroll
            :class="
              link.active ? 'bg-red-400 text-white' : 'text-gray-700 bg-white'
            "
            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium hover:bg-gray-50"
          >
          </inertia-link>
        </div>
      </nav>
    </section>
  </div>
</template>

<script>
export default {
  props: ["tableName", "Headers", "tableContents"],
  data: function () {
    return {
      nextpage: this.tableContents.next_page_url,
    };
  },
  methods: {
    deleteRow: function (data) {
      if (!confirm("Sure")) return;
      data._method = "DELETE";
    },
  },
};
</script>
