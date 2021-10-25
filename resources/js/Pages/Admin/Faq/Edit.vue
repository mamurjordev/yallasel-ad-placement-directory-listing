<template>
  <admin-layout>
    <div class="flex flex-wrap mt-4">
      <form-faq
        formName="FAQ"
        :errors="errors"
        :faq="faq"
        :languages="languages"
        :sub_categories="sub_categories"
      ></form-faq>
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import FormFaq from "@/Components/Admin/Forms/Faq";
export default {
  props: ["errors", "faq", "languages", "sub_categories"],
  components: {
    AdminLayout,
    FormFaq,
  },
  data: function () {
    return {};
  },
};
</script>
