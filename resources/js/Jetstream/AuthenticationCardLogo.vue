<template>
    <inertia-link :href="'/'">
        <img
            :src="
                '/media/site/' +
                    (setting.site_logo ? setting.site_logo : 'logo.png')
            "
            alt="yallasell"
        />
    </inertia-link>
</template>

<script>
export default {
    computed: {
        setting() {
            return this.$inertia.page.props.setting;
        }
    }
};
</script>
