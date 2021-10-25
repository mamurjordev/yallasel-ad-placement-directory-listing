<template>
    <img
        :src="
            '/media/site/' +
                (setting.site_logo ? setting.site_logo : 'logo.png')
        "
        alt="yallasell"
    />
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
