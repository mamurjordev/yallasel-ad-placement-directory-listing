<template>
  <admin-layout>
    <div class="flex flex-wrap mt-4">
      <form-faq formName="FAQ" :errors="errors" :sub_categories="sub_categories" :languages="languages"></form-faq>
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import FormFaq from "@/Components/Admin/Forms/Faq";
export default {
  props: ["errors", "sub_categories", 'languages'],
  components: {
    AdminLayout,
    FormFaq,
  },
  data: function () {
    return {};
  },
};
</script>
