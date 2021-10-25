<template>
  <admin-layout>
    <div class="flex flex-wrap mt-4">
      <form-article formName="Article" :errors="errors" :languages="languages"></form-article>
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import FormArticle from "@/Components/Admin/Forms/Article";
export default {
  props: {
    errors: Object,
    languages: Array
  },
  components: {
    AdminLayout,
    FormArticle,
  },
  data: function () {
    return {};
  },
};
</script>
