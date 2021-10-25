<template>
  <admin-layout>
    <div class="flex flex-wrap mt-4">
      <form-region formName="Region" :errors="errors" :cities="cities"></form-region>
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import FormRegion from "@/Components/Admin/Forms/Region";
export default {
  props: {
    errors: Object,
    cities: Array
  },
  components: {
    AdminLayout,
    FormRegion,
  },
  data: function () {
    return {};
  },
};
</script>
