<template>
  <admin-layout>
    <div class="flex flex-wrap mt-4">
      <form-city formName="City" :errors="errors" :languages="languages"></form-city>
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import FormCity from "@/Components/Admin/Forms/City";
export default {
  props: {
    errors: Object,
    languages: Object
  },
  components: {
    AdminLayout,
    FormCity,
  },
  data: function () {
    return {};
  },
};
</script>
