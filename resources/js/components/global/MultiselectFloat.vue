<template>
<div class="bmd-form-group form-group select-float"
  v-bind:class="{ 'is-focused' : focused, 'is-filled': modelValue.length > 0, 'invalid': submited && !modelValue}"
  @mouseover="hovered = true"
  @mouseout="hovered = false">
    <div class="multiselect-wrapper">
        <label :for="id"
          class="bmd-label-floating">{{title}}</label>
        <select :value="null"
        :modelValue="null"
          @input="e => handleSelect(e.target.value)"
          :id="id"
          @focus="handleFocus"
          class="form-control"
          @invalid="handleInvalid"
          :required="required && value.length == 0"
          :disabled="disabled">
            <option v-for="item in filteredList" :key="item"
              :style="(hovered ? 'display:none' : '')"
              :value="item.id">{{item.name}}</option>
        </select>
        <ul class="dropdown-menu custom-dropdown"
          :class="{show: focused}">
            <li v-for="item in filteredList" :key="item"
              :class="{selected: item.id === v}">
                <div @click="handleSelect(item.id)">{{item.name}}</div>
            </li>
        </ul>

       <!--  <icon name="keyboard_arrow_down"
          class="arrow-down" /> -->
          <span class="arrow-down"></span>
        <div class="selected-wrapper"
          v-if="selectedElements.length > 0">
            <div class="selected-box"
              :style="{'min-width': computedWidth + 'px'}">
                <div class="selected-element"
                  v-for="elem, idx of selectedElements" :key="idx">
                    <div class="selected-name">{{elem.name}}</div>

                    <icon @click="removeSelected(elem)"
                      name="close" />
                </div>

            </div>
        </div>
    </div>
    <toggle-height>
        <div class="error-msg"
          v-if="submited && !modelValue">{{errorMsg}}</div>
    </toggle-height>
</div>
</template>

<script>
export default
{
    name: "MultiselectFloat",
    props:
    {
        id: String,
        disabled:
        {
            type: Boolean,
            default: false
        },
        title:
        {
            type: String,
            default: "title"
        },
        list: Array | Object,
        modelValue:
        {
            type: Array,
            default: function ()
            {
                return []
            }
        },
        required:
        {
            type: Boolean,
            default: false
        },
        errorMsg:
        {
            type: String,
            default: "Este campo es obligatorio."
        },
    },
    data()
    {
        return {
            v: '',
            focused: false,
            hovered: false,
            submited: false,
            valid: true,
            selected: false,
            computedWidth: 0
        }
    },
    computed:
    {
        filteredList: function ()
        {
            return this.list.filter( e =>
            {
                const elem = this.modelValue.find( x =>
                {
                    return x == e.id
                } )
                if ( elem )
                {
                    return false
                }
                return true;
            } )
        },
        selectedElements: function ()
        {
            this.$nextTick( () =>
            {
                this.calculateWidth()
            } )
            return this.list.filter( e =>
            {
                const elem = this.modelValue.find( x =>
                {
                    return x == e.id
                } )
                if ( elem )
                {
                    return true
                }
                return false;
            } )
        },
    },
    mounted()
    {
        window.addEventListener( "click", e =>
        {
            if ( this.selected )
            {
                this.selected = false
            }
            else
            {
                if ( this.hovered )
                {
                    this.focused = true
                }
                else
                {
                    this.focused = false
                }

            }
        } )
    },
    methods:
    {
        calculateWidth()
        {
            const elems = document.getElementsByClassName( "selected-element" )

            let width = 0
            for ( const elem of elems )
            {
                width += elem.offsetWidth
            }
            this.computedWidth = width;

        },
        removeSelected( elem )
        {
            const removed = this.modelValue.filter( e =>
            {
                return elem.id != e
            } )
            this.$emit( "update:modelValue", removed )
            this.selected = true
        },
        handleFocus( e )
        {
            if ( this.hovered )
            {
                e.target.blur()
            }
        },
        handleSelect( e )
        {
            this.$emit( "update:modelValue", [ ...this.modelValue, e ] )

            this.selected = true
            this.focused = false
           // e.preventDefault()
        },
        handleInvalid( e )
        {
            this.submited = true
            this.valid = false
            e.preventDefault();
        },
    }

}
</script>

<style lang="scss" scoped>
@import "../../../sass/variables"; // Variables
.multiselect-wrapper{
  select{
    color: transparent;
  }
}
.select-float {

    .arrow-down {
        position: absolute;
        top: 15px;
        right: 14px;
        left: auto;
        width: 10px;
        color: var(--primary);
        pointer-events: none;
    }
}
.custom-dropdown {
    width: 100%;
    max-height: 0;
    transition: max-height 0.1s ease;
    overflow-y: auto;
    display: block;
    border-radius: 0;
    color: #000;
    box-shadow: 0px 6px 20px #999BA871;
    margin-top: 10px;
    &.show {
        max-height: 300px;
    }
    li {
        margin: 0 15px;
        padding: 6px 14px;
        cursor: pointer;
        font-size: 14px;
        &.selected {
            color: $primary;
        }
        &:hover {
            color: $white;
            background-color: $primary;
        }
    }
}
.selected-wrapper {
    position: absolute;
    left: 0;
    right: 24px;
    top: 0;
    bottom: 0;
    display: flex;
    align-items: flex-end;
    z-index: 99;
    overflow-x: auto;
    .selected-box {
        display: flex;
    }
    .selected-element {
        font-size: 0.9em;
        padding: 5px 10px;
        margin: 5px;
        display: flex;
        white-space: nowrap;
        .icon {
            margin-left: 5px;
            font-size: 1em;
            transition: color 0.3s ease;
            cursor: pointer;
            &:hover {
                color: var(--danger);
            }
        }
    }
}
</style>
