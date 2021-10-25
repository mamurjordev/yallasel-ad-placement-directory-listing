<template>
  <admin-layout>
    <div class="flex flex-wrap mt-4">
      <form-region formName="Region" :errors="errors" :region="region" :cities="cities"></form-region>
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import FormRegion from "@/Components/Admin/Forms/Region";
export default {
  props: {
    errors: Object,
    region: Object,
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
