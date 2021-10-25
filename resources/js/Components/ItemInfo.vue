<template>
    <section class="">
        <div class="grid grid-cols-2 text-sm text-gray-600 font-light">
            <div class="">
                <p class="">
                    <i class="far fa-clock pe-2"></i> {{ __("Date") }}:
                    {{ post.updated_at | moment("DD, MMM. hh:mm") }}
                </p>
                <p class="">
                    <i class="fas fa-map-marker-alt pe-2"></i>
                    <a href="#!" class=""
                        >{{ post.city_name }}, {{ post.region_name }}</a
                    >
                </p>
            </div>
            <div class="">
                <button
                    v-if="favorite == false"
                    @click="addToFavorite(post.id)"
                    class="float-end border border-solid border-gray-500 rounded-sm px-5 text-lg font-medium text-gray-700"
                >
                    <i class="far fa-heart"></i> {{ __("Save") }}
                </button>
                <button
                    v-else
                    @click="removeFavorite(post.id)"
                    class="float-end border border-solid border-gray-500 rounded-sm px-5 text-lg font-medium text-gray-700"
                >
                    <i class="fas fa-heart"></i> {{ __("Save") }}
                </button>
            </div>
        </div>
        <h2 class="text-4xl text-gray-800 font-black mt-5">
            {{ post.title }}
        </h2>
        <div class="text-3xl text-green-500 font-bold mt-5">
            {{ post.expected_price }} {{ iqd }}
        </div>
        <section
            :class="showLogin != true ? 'hidden' : ''"
            class="fixed z-50 pt-24 start-0 top-0 w-screen overflow-auto h-screen bg-tp1"
        >
            <div
                class="bg-white mx-5 md:m-auto p-5 border border-gray-800 md:w-2/12 rounded-lg text-gray-800"
            >
                <h1 class="text-center text-xl font-bold">
                    {{ __("To continue") }},<br />{{ __(" you must log in") }}
                </h1>
                <p class="text-sm font-light py-4">
                    {{ __("When you log in, you can save ads as favorites.") }}
                </p>
                <div class="flex justify-between text-center gap-5">
                    <div
                        @click="showLogin = false"
                        class="w-full border border-gray-400 rounded-md py-2 cursor-pointer"
                    >
                        {{ __("Cancel") }}
                    </div>
                    <inertia-link
                        href="/login"
                        class="bg-bg2 w-full rounded-md py-2 text-white"
                        >{{ __("Log in") }}</inertia-link
                    >
                </div>
            </div>
        </section>
    </section>
</template>

<script>
export default {
    props: ["post", "favorite_id"],
    data: function() {
        return {
            favorite: false,
            showLogin: false,
            favoriteID: null,
            iqd: lang == "ar" ? "ع.د" : "IQD"
        };
    },
    created() {
        if (this.favorite_id) {
            this.favorite = true;
            this.favoriteID = this.favorite_id.id;
        }
    },
    computed: {
        user() {
            return this.$page.props.user;
        }
    },
    methods: {
        addToFavorite() {
            if (this.user) {
                axios
                    .post("/api/v1/favorites", {
                        post_id: this.post.id,
                        withCredentials: true
                    })
                    .then(
                        response =>
                            (this.favorite = this.favoriteID = response.data)
                    )
                    .catch(error => {
                        console.error("There was an error!", error);
                    });
            } else {
                this.showLogin = true;
            }
        },
        removeFavorite(postID) {
            axios.delete("/api/v1/favorite/" + postID).then(response => {
                this.favorite = !response.data;
            });
        }
    }
};
</script>
