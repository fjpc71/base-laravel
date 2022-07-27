<template>
<div>
    <div class="form-group bmd-form-group input-float"
      :class="{ 'is-focused' : focused , 'is-filled' : !!modelValue || modelValue === 0 , 'invalid': submited && !valid}">
        <label :for="id"
            class="bmd-label-floating" :style="`color: ${color};`">{{ title }}<span v-if="required"> *</span></label>
        <input class="form-control"
          ref="input"
          @blur="handleInput"
          @invalid="handleInvalid"
          :value="modelValue"
          :type="type"
          :step="step"
          @focus="focused = true"
          :id="id"
          :disabled="disabled"
          :pattern="pattern"
          :patternMsg="patternMsg"
          :autocomplete="autocomplete"
          :required="required"
          :errorMsg="errorMsg"
          :name="name"
          :validationFunction="validationFunction"
          :list="`datalist-${id}`" />
        <div class="unit-wrapper"
          v-if="unit">{{unit}}</div>
        <icon v-if="clearBtn"
          @click="handleClear"
          name="clear" />
        <div class="dropdown-menu show"
          @mouseenter="dropdownHovered = true"
          @mouseleave="dropdownHovered = false"
          v-if="filteredList.length > 0 && (focused || dropdownHovered)">
            <div class="dropdown-item"
              v-for="item in filteredList"
              @click="handleDropdown(item)">{{item}}</div>
        </div>
        <datalist :id="`datalist-${id}`">
            <option v-for="item of list">item</option>
        </datalist>
        <toggle-height>
            <div v-if="submited && !valid">
                <div class="error-msg">{{error}}</div>
            </div>
        </toggle-height>
    </div>

</div>
</template>

<script>
export default
{
    name: "InputFloatBlur",
    props:
    {
        clearBtn:
        {
            type: Boolean,
            default: false,
        },
        step:
        {
            type: String,
            default: "0.01"
        },
        id:
        {
            type: String,
            default: function ()
            {
                return Math.random()
                    .toString( 15 )
                    .substring( 7 )
            }
        },
        title:
        {
            type: String,
            default: "title"
        },
        type:
        {
            type: String,
            default: "text"
        },
        pattern:
        {
            type: String,
            default: ".*"
        },
        required:
        {
            type: Boolean,
            default: false
        },
        errorMsg:
        {
            type: String,
            default: ""
        },
        patternMsg:
        {
            type: String,
            default: ""
        },
        unit:
        {
            type: String,
            default: null
        },
        list:
        {
            type: Array,
            default: function ()
            {
                return []
            }
        },
        validationFunction:
        {
            type: Function,
            default: function ()
            {
                return true
            }
        },
        disabled:
        {
            type: Boolean,
            default: false
        },
        customErrorMessage:
        {
            type: String,
            default: ''
        },
        modelValue:
        {
           /*  type: String, */
            default: ''
        },
        disableErrorScroll:
        {
            type: Boolean,
            default: false
        },
        name:
        {
            type: String,
            default: ''
        },
        color:
        {
            type: String,
            default: ''
        }
    },
    computed:
    {
        filteredList: function ()
        {
            if ( typeof this.modelValue === "string" )
            {
                const search = this.modelValue.toLowerCase();
                return this.list.filter( e =>
                {
                    return e.toLowerCase()
                        .includes( search )
                } )
            }
            return []
        },
        autocomplete: function ()
        {
            return this.list.length > 0 ? "off" : ""
        }
    },
    data()
    {
        return {
            focused: false,
            v: "",
            valid: true,
            error: "",
            submited: false,
            dropdownHovered: false
        }
    },
    methods:
    {
        handleClear( e )
        {
            this.$emit( "update:modelValue", null )
            this.$emit( "clear" )
        },
        handleInvalid( e )
        {
            e.preventDefault();
            this.submited = true
            this.valid = false
            const validity = e.target.validity
            if ( validity.valueMissing )
            {
                this.error = "Este campo es obligatorio."
            }
            else if ( validity.patternMismatch )
            {
                if ( this.patternMsg !== "" )
                {
                    this.error = this.patternMsg
                }
                else
                {
                    this.error = "Este campo tiene el patrón: " + this.pattern
                }
            }
            else
            {
                this.error = this.errorMsg
            }

            if ( !this.disableErrorScroll )
            {
                const top = e.target.getBoundingClientRect()
                    .top - document.body.getBoundingClientRect()
                    .top

                window.scrollTo(
                {
                    top: top - 100,
                    left: 0,
                    behavior: 'smooth'
                } )
            }

        },
        handleDropdown( item )
        {
            this.valid = true

            this.$emit( "valid", this.valid )
            this.$emit( "update:modelValue", item )
            this.dropdownHovered = false
        },
        handleInput( e )
        {
            // e.target.reportValidity();

            if ( !this.validationFunction( e.target.value ) )
            {
                e.target.setCustomValidity( false )
                this.valid = this.valid && false
            }
            else
            {
                e.target.setCustomValidity( "" )
                this.valid = this.valid && true
            }

            const validity = e.target.validity;
            this.valid = validity.valid;
            this.focused = false;

            this.$emit( "valid", this.valid )
            this.$emit( "update:modelValue", e.target.value )
        },
        handleBlur( e )
        {
            if ( !this.dropdownHovered )
            {
                this.focused = false;
            }
        }
        
    }
}
</script>

<style lang="scss" scoped>
.input-float {
    .icon {
        position: absolute;
        left: auto;
        right: 0;
        top: 25px;
        font-size: 18px;
        cursor: pointer;
    }
    .dropdown-menu {
        width: 100%;
    }
    .unit-wrapper {
        position: absolute;
        left: auto;
        right: 10px;
        bottom: 9px;
        pointer-events: none;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
}
.form-control:disabled{
      background: unset;
    }
.form-control:invalid{
    background-image: none;
}
.error-msg {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    color: var(--danger);
}
</style>
