<template>
  <table class="table">
      <thead>
          <tr>
              <th v-for="key of keys">{{key.name}}</th>
              <th colspan="2">{{ __("options") }}</th>
          </tr>
      </thead>
      <tbody>
          <tr v-for="elem of list">
            <td v-for="key of keys">
              <slot :name="key.key" v-bind:data="elem">{{elem[key.key]}}</slot>
            </td>
            <td>{{ __("edit") }}</td>
            <td>{{ __("delete") }}</td>
          </tr>
      </tbody>
  </table>
</template>

<script>
  export default{
    name: "Table",
    props: {
      keys: Array,
      data: Array
    }
  }
</script>
