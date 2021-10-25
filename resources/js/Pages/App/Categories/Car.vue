<template>
  <app-layout>
    <search></search>
    <breadcrumb :breads="breads"></breadcrumb>
    <categories-link></categories-link>
    <filters></filters>
    <section class="container mx-auto px-3 md:grid md:grid-cols-7">
      <div class="col-span-5">
        <filter-mobile></filter-mobile>
        <filters2></filters2>
        <slider></slider>
        <products></products>
        <pagination></pagination>
      </div>
      <sidebar></sidebar>
    </section>
    <find-job></find-job>
    <footer-top></footer-top>
  </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import Search from "@/Components/Search";
import Breadcrumb from "@/Components/Breadcrumb";
import CategoriesLink from "@/Components/CategoriesLink";
import Filters from "@/Components/Filters";
import FilterMobile from "@/Components/FilterMobile";
import Filters2 from "@/Components/Filters2";
import Slider from "@/Components/Slider.vue";
import Products from "@/Components/Products";
import Pagination from "@/Components/Pagination";
import Sidebar from "@/Components/Sidebar";
import FindJob from "@/Components/FindJob.vue";
import FooterTop from "@/Components/FooterTop.vue";

export default {
  data: function () {
    return {
        breads: ['breads']
    };
  },
  components: {
    AppLayout,
    Search,
    Breadcrumb,
    CategoriesLink,
    Filters,
    FilterMobile,
    Filters2,
    Slider,
    Products,
    Pagination,
    Sidebar,
    FindJob,
    FooterTop,
  },
  mounted() {
    var owl = $(".owl-carousel");
    owl.owlCarousel({
      items: 1,
      autoplay: true,
      autoplayHoverPause: true,
    });
    $(".owlNext").click(function () {
      owl.trigger("next.owl.carousel");
    });
    $(".owlPrev").click(function () {
      owl.trigger("prev.owl.carousel", [300]);
    });
  },
};
</script>
