<template>
<div class="table-responsive">
  <table class="table table-striped">
      <thead>
          <tr>
              <th v-for="label in labels" :key="label">{{ __(label) }}</th>
              <th>{{ __("delete") }}</th>
          </tr>
      </thead>
      <tbody>
          <tr v-for="(item, index) in data" :key="index">
            <td v-for="label of labels" :key="label">
              <label v-if="label === 'country_name'">
                {{item.country.name}}
              </label>

              <label v-else-if="label === 'lang_name'">
                      {{item.lang.name}}
              </label>

              <label v-else-if="label === 'stock_min'">
                      <span v-if="item[label] == 0">{{__('no')}}</span>
                      <span v-else>{{__('yes')}}</span>
              </label>

              <label v-else-if="label === 'min_delivery'">
                      <span v-if="item[label] == 0">{{__('no')}}</span>
                      <span v-else>{{__('yes')}}</span>
              </label>

              <label v-else-if="label === 'iso_code'">
                      {{item.lang.iso_code}}
              </label>

              <label v-else-if="label === 'country_code'">
                      {{item.country.code}}
              </label>

              <label v-else-if="label === 'tariff'">
                      <span v-if="item.tariff">{{item.tariff.name}}</span>
              </label>
              
              <label v-else-if="label.startsWith('name')">
                    <inertia-link :href="`/private/${url}/${item.id}`">
                      {{item[label]}}
                    </inertia-link>
              </label>
              <label v-else v-html="__(item[label])"></label>
            </td>
            <td class="delete" @click="deleteItem(item.id)"><icon name="delete" /></td>
          </tr>
      </tbody>
  </table>
</div>
</template>

<script>
  import { Inertia } from '@inertiajs/inertia';
  import Swal from 'sweetalert2';

  export default{
    name: "ListTable",
    props: {
      labels: Array,
      data: Array,
      url: String,
      section: String
    },
    setup(props){
      const deleteItem = (id) => {

        Swal.fire({
          title: 'Seguro que desea eliminar el registro?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si'
            }).then((result) => {
              if (result.isConfirmed) {
                Inertia.post( `/private/${props.section}/delete/${id}`);
              }
            });
          }

      return{
        deleteItem
      }
    }
  }
</script>