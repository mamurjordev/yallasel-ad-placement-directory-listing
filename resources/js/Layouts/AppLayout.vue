<template>
    <main class="font-roboto min-h-screen flex flex-col" :dir="dir">
        <header-vue></header-vue>
        <nav-bar></nav-bar>
        <div class="flex-grow">
            <slot></slot>
        </div>
        <footer-vue></footer-vue>
    </main>
</template>
<script>
import HeaderVue from "@/Components/Header";
import NavBar from "@/Components/NavBar";
import FooterVue from "@/Components/Footer";
export default {
    computed: {
        dir() {
            return this.$page.props.language == "ar" ? "rtl" : "ltr";
        }
    },
    components: {
        HeaderVue,
        NavBar,
        FooterVue
    },
    created() {
        $("#profileNav").click(function() {
            $(".dropdown", this).toggleClass("hidden");
        });

        // Seach Button
        $("#search input").focus(function() {
            console.log("ok");
            $("#search-button").removeClass("hidden");
            $(this).focusout(function() {
                $("#search-button").addClass("hidden");
            });
        });

        // Page nav dropdown
        $(".page-nav").click(function() {
            $(".page-nav ul").addClass("hidden");
            $("ul", this).toggleClass("hidden");
        });
    }
};
</script>
