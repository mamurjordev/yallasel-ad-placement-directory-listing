<template>
  <admin-layout>
    <div class="flex flex-wrap mt-4">
      <form-city formName="City" :errors="errors" :city="city"></form-city>
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import FormCity from "@/Components/Admin/Forms/City";
export default {
  props: {
    errors: Object,
    city: Object,
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
