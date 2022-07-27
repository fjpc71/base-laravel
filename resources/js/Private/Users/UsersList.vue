<template>
  <div class="card">
    <div class="card-body">

      <div class="col-12 px-0 pb-2">
        <h1 class="title">{{ __("users") }} </h1>
      </div>
      <div class="d-flex align-items-center justify-content-between mb-3 header-list">
        <search-form
         :placeholder="__('find')"
         @search-data="handleSearch"
         />
         <button class="btn btn-primary" @click="showModal">{{__('add_new')}}</button>

         <!-- Modal -->
         <Modal
          v-show="data.modal"
          :showModal="showModal"
          @close="showModal"
        >
          <template v-slot:body>
              <UserNew 
                :user="user"
                :userTypes="userTypes"
                :countries="countries"
                :langs="langs"
                 />
          </template>

        </Modal>

      </div>

      <div class="card-table">

          <ListTable v-if="users.data" :data="users.data" :labels="data.labels" :url="url" :section="data.section" />

          <Pagination class="mt-6" v-if="users.links" :links="users.links" />

      </div>

    </div>
    
  </div>

</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue';
import { ListTable, Pagination, Modal } from "../../components/common";
import UserNew from "../../Private/Users/New";

export default {

  name: "UsersList",
  components: {
        ListTable,
        Pagination,
        UserNew,
        Modal
  },
  props: {
    users: Object,
    url: String,
    userTypes: Object,
    user: Object,
    modal: Boolean,
    countries: Object,
    langs: Object
  },
  setup(props) {

    const data = ref({
                labels: ['name', 'username', 'email', 'telephone', 'nif', 'iso_code', 'telephone'],
                modal: props.modal ? props.modal : false,
                section: 'user'
              });

        return {
            data,
            showModal: () => { data.value.modal = !data.value.modal; },
            handleSearch: (data) => {

              const params = { name: data, };

              Inertia.post( "/private/users/search", params);
            }
        }
    }
};

</script>