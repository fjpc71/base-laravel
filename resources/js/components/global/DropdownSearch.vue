<template>
<div class="form-group bmd-form-group"
  v-bind:class="{ 'is-focused' : focused , 'is-filled' : (!!input || placeholder !== '') }">
  <label :for="id"
    class="bmd-label-floating">{{ title }}</label>
  <input type="search"
    :id="id"
    class="form-control dropdown-toggle"
    @focus="focus"
    @blur="blurInput"
    :disabled="disabled"
    v-model="input"
    :placeholder="placeholder"
    @keydown.down="handleDown"
    @keydown.up="handleUp"
    @keydown.enter="handleEnter"
    @keydown.esc="handleEsc"
    @keydown.left="() => {focused = true}"
    @keydown.right="() => {focused = true}" />
  <div class="dropdown-menu show"
    @mouseenter="listHovered = true"
    @mouseleave="listHovered = false"
    v-if="focused || listHovered"
    ref="dropdownWrapper">
    <div v-for="(p, idx) in filterList"
      class="dropdown-item"
      :class="{focus: activeIndex === idx}"
      :key="idx"
      :id="p.id"
      @click="pick(p)"
      ref="dropdownList">
      {{ p.name }}
    </div>
  </div>
  <div class="arrow-down">
    <icon name="keyboard_arrow_down" />
  </div>
</div>
</template>

<script>
export default
{
  name: "DropdownSearch",
  props:
  {
    list: Array,
    id:
    {
      type: String,
      default: ""
    },
    placeholder:
    {
      type: String,
      default: ""
    },
    disabled:
    {
      type: Boolean,
      default: false
    },
    title:
    {
      type: String,
      default: ""
    },
    value:
    {
      type: Number,
      default: null
    },
    hideClear:
    {
      type: Boolean,
      default: false
    }
  },
  watch:
  {
    value:
    {
      handler( value )
      {

        const elem = this.list.find( e =>
        {
          return e.value == this.value
        } )
        if ( elem )
        {
          this.input = elem.name
        }
        else
        {
          this.input = ""
        }
      },
      immediate: true,
    },
    input: function ()
    {
      this.activeIndex = 0;
      if ( this.listHovered )
      {
        this.focused = true;
      }
    }
  },
  data()
  {
    return {
      input: "",
      focused: false,
      listHovered: false,
      activeIndex: 0
    }
  },
  computed:
  {
    filterList: function ()
    {
      return this.list.filter( ( elem ) =>
      {
        const currentName = elem.name.toLowerCase()
        const currentInput = this.$data.input.toLowerCase()
        return currentName.includes( currentInput )
      } )
    }
  },
  methods:
  {
    handleEnter( e )
    {
      this.pick( this.filterList[ this.activeIndex ] )
    },
    handleEsc( e )
    {
      this.focused = false;
      this.listHovered = false;
      this.$emit( "input", 0 )
    },
    handleDown( e )
    {
      this.activeIndex = this.activeIndex + 1 < this.filterList.length ? this.activeIndex + 1 : 0
    },
    handleUp( e )
    {
      this.activeIndex = this.activeIndex - 1 >= 0 ? this.activeIndex - 1 : this.filterList.length - 1
    },
    clear()
    {
      this.input = ""
      this.$emit( "input", 0 )
    },
    blurInput()
    {
      if ( !this.listHovered )
      {
        this.focused = false;
        const item = this.list.findIndex( ( e ) =>
        {
          return e.name.toLowerCase() === this.input.toLowerCase()
        } )
        if ( item != -1 )
        {
          this.$emit( "input", this.list[ item ].value )
        }
        else
        {
          this.$emit( "input", 0 )
        }
      }
    },
    itemVisible( item )
    {
      const currentName = item.name.toLowerCase()
      const currentInput = this.input.toLowerCase()
      return currentName.includes( currentInput )
    },
    pick( item )
    {
      this.focused = false;
      this.listHovered = false;
      this.input = item.name;
      this.$emit( "input", item.value )
    },
    focus()
    {
      this.focused = true
      if ( this.$refs.dropdownList && this.$refs.dropdownList[ this.activeIndex ] )
      {
        this.$refs.dropdownList[ this.activeIndex ].classList.remove( "focus" )
        this.$refs.dropdownList[ 0 ].classList.add( "focus" )
        this.$refs.dropdownWrapper.scrollTop = this.$refs.dropdownList[ 0 ].offsetTop
      }
    },
    pressKey( event )
    {
      const key = event.keyCode
      if ( this.$refs.dropdownList )
      {
        switch ( true )
        {
          case ( key == 38 ): // arrow up key

            break;
          case ( key == 40 ): // arrow down key

            break;
          case ( key == 13 ): // enter key

            break;
          case ( key == 27 ): // esc key

            break;
          case ( ( key >= 48 && key <= 57 ) || ( key >= 65 && key <= 90 ) ):
            // if the user types in something set the current index to 0 and remove all the focused classes


        }
      }
    }

  }
}
</script>

<style lang="scss" scoped>
.dropdown-menu {
    overflow-y: auto;
    max-height: 10em;
    width: 100%;
}

.dropdown-menu .dropdown-item {
    cursor: pointer;
    max-width: none;
    transition: background-color 0.3s ease;
}

.dropdown-item:hover,
.dropdown-menu .dropdown-item.focus {
    border: none;
    box-shadow: none;
    background-color: #EBEBEB;
}

#clear {
    cursor: pointer;
    position: absolute;
    top: calc(1.75rem + 0.5em);
    right: 0;
    color: rgba(0, 0, 0, 0.26);
    transition: color 0.3s ease;
    .icon {
        color: black;
        &:hover {
            color: var(--danger);
        }
    }
}

.arrow-down{
  position: absolute;
  right: 0;
  top: 0;
  bottom: 0;
  left: auto;
  display: flex;
  align-items: center;
  .icon{
    color: var(--primary);
  }
}
</style>
