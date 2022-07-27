<template>
<div class="new-item-wrapper">
  <form @submit.prevent="handleUser">
    <div>
      <div class="form-head mb-3">
        <h2 v-if="user.formType == 'new'">
          {{ __("new") }} {{ __("user") }}
        </h2>
        <h2 v-else>{{ __("edit") }} {{ __("user") }}</h2>
      </div>

      <div class="">
        <mb-row>
          <mb-col size="12">
            <select-float
              required
              v-model="user.user_types_id"
              :list="userTypes"
              :title="__('user_type')"
            />
          </mb-col>

          <mb-col size="12">
            <input-float
              required
              v-model="user.name"
              :title="__('name')"
            />
          </mb-col>

          <mb-col size="12">
            <input-float required v-model="user.email" :title="__('email')" />
          </mb-col>

          <mb-col size="12">
            <input-float
              v-model="user.telephone"
              :title="__('telephone')"
            />
          </mb-col>

          <mb-col size="12">
            <input-float
              v-model="user.nif"
              :title="__('NIF/CIF')"
            />
          </mb-col>

          <mb-col size="12">
            <input-float
              required
              v-model="user.username"
              :title="__('user_name')"
            />
          </mb-col>

          <mb-col size="12">
            <input-float
              type="password"
              v-model="user.password"
              :title="__('password')"
            />
          </mb-col>

          <mb-col size="12">
            <select-float
              required
              v-model="user.lang_id"
              :list="langs"
              :title="__('lang')"
            />
          </mb-col>

          <mb-col size="12">
            <select-float
              required
              v-model="user.country_id"
              :list="countries"
              :title="__('country')"
            />
          </mb-col>

          <mb-col size="12">
            <select-float
              required
              v-model="user.access"
              :list="user.accessType"
              :title="__('active_account')"
            />
          </mb-col>
          
        </mb-row>

        <div class="buttons-footer mt-4 d-flex justify-content-between">
          <btn
            as="inertia-link"
            href="/private/users/lists"
            variant="outline"
            >{{ __("cancel") }}</btn
          >

          <btn
            variant="back"
            type="submit"
            v-if="user.formType == 'new'"
          >
            {{ __("save") }}
          </btn>

          <btn variant="back ml-4" type="submit" v-else>
            {{ __("update") }}
          </btn>
        </div>
      </div>
    </div>
  </form>
</div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  name: "UserNew",
  props: {
    user: Object,
    userTypes: Object,
    countries: Object,
    langs: Object
  },
  setup(props) {
    const user = useForm({
      id: props.user ? props.user.id : null,
      name: props.user ? props.user.name : null,
      email: props.user ? props.user.email : null,
      telephone: props.user ? props.user.telephone : null,
      username: props.user ? props.user.username : null,
      password: null,
      access: props.user ? props.user.access === 0 ? 1 : 2 : null,
      accessType: [
        { id: 1, name: "No" },
        { id: 2, name: "Si" },
      ],
      user_types_id: props.user ? props.user.user_types_id : null,
      lang_id: props.user ? props.user.lang_id : null,
      country_id: props.user ? props.user.country_id : null,
      nif: props.user ? props.user.nif : null,
      formType: props.user ? "edit" : "new",
    });

    return {
      user,
      handleUser() {
        if (user.formType == "new") {
          user.post("/private/user/new", {
                    preserveScroll: true,
                    onFinish: () => user.reset(),
                  });
        } else {
          user.post(`/private/user/update/${user.id}`);
        }
      },
    };
  },
};
</script>
<style lang="scss" scoped>
  .btn{
    width: 49%;
  }
</style>