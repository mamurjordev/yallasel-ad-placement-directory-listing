<template>
  <section
    class="container mx-auto bg-white flex items-stretch justify-center h-screen"
  >
    <div class="self-center justify-self-center">
      <form class="rounded w-96 px-8 pt-6 pb-8 mb-4" @submit.prevent="submit">
        <div class="mb-4 px-4">
          <label
            class="block text-grey-darker text-sm font-bold mb-2"
            for="email"
          >
            Email
          </label>
          <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
            id="email"
            type="email"
            placeholder="Email"
            v-model="form.email"
          />
        </div>
        <div class="mb-6 px-4">
          <label
            class="block text-grey-darker text-sm font-bold mb-2"
            for="password"
          >
            Password
          </label>
          <input
            class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
            id="password"
            type="password"
            placeholder="********"
            v-model="form.password"
          />
        </div>
        <div class="float-right px-4">
          <button
            class="bg-blue-600 hover:bg-blue-dark text-white font-bold py-2 px-4 rounded"
            type="submit"
          >
            Sign In
          </button>
        </div>
      </form>
    </div>
  </section>
</template>

<script>
export default {
  components: {},
  data: function () {
    return {
      form: {
        email: null,
        password: null,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post('/panel/login', this.form)
    },
  },
};
</script>
