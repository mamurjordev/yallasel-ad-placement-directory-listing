<template>
  <admin-layout>
    <div class="flex flex-wrap mt-4">
      <table-vue
        tableName="category"
        :Headers="Headers"
        :tableContents="categories"
      ></table-vue>
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import TableVue from "@/Components/Admin/Table";
import FormCategory from "@/Components/Admin/Forms/Category";
export default {
  components: {
    AdminLayout,
    TableVue,
    FormCategory,
  },
  props: ["categories"],
  data: function () {
    return {
      Headers: [
        "SR",
        "Name",
        "Parent Category",
        "Created at",
        "Updated at",
        "Action",
      ],
      //   tableData: []
    };
  },
  methods: {
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
  },
};
</script>
