<template>
<form @submit.prevent="doSearch(findValue)">
  <div class="form-group search-form" :class="{ active: findValue != '' }">
    <input class="form-control"
      v-model="findValue"/>
    <div class="placeholder">{{placeholder}}</div>
      <button type="submit" class="btn-search">
        {{__('filters')}}
      </button>
  </div>
</form>
</template>

<script>
import { ref } from "vue";
export default
{
  name: "SearchForm",
  emits: ['search-data'],
  props:
  {
    placeholder:
    {
      type: String,
      default: ""
    }
  },
  setup( props, context ){

    const findValue = ref('');

    const doSearch = () => {
      context.emit('search-data', findValue.value);
    }

    return{
      findValue,
      doSearch
    }

  }
}
</script>

<style lang="scss" scoped>
@import "../../../sass/variables"; // Variables
form{
  width: 40%;
  margin-bottom: 0;
}
.search-form {
  position: relative;
  display: flex;
  align-items: center;
  gap: 0;
  margin-bottom: 0;
  .input-wrapper {
    width: calc(100% - 40px);
  }
  &.no-title {
    padding: 0;
  }
  .btn-search {
    border-radius: 0 0 0 0;
    margin: 0;
    padding: 0;
    margin-left: 10px;
    border: none;
    box-shadow: 0 0 0 0;
    background: transparent;
    color: $primary;
    font-size: 14px;
    line-height: 18px;
    letter-spacing: 0.84px;
    font-weight: 600;
    text-transform: uppercase;
    &:hover{
      background: transparent;
    }
  }
  input {
    padding: 15px 10px;
    margin-bottom: 0;
  }
  .search-icon {
    position: absolute;
    right: 10px;
    left: auto;
    top: auto;
    bottom: 9px;
    cursor: pointer;
    transition: color 0.3s ease;
  }
  .dropdown-menu {
    width: 100%;
    max-height: 310px;
    overflow: auto;
  }
  .dropdown-item {
    max-width: none;
    cursor: pointer;
  }
  .bmd-label-floating {
    top: 21px;
  }
  &.is-filled,
  &.is-focused {
    .bmd-label-floating {
      top: 0;
      left: 4px;
    }
  }
}
</style>

