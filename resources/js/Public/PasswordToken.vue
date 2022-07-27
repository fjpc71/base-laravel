<template>
<div class="form-small">
    <div class="card">
        <form @submit="handleSubmit"
          class="card-body">
            <h5 class="mt-30">{{__('change_password')}}</h5>
            <input-float type="password"
              required
              v-model="form.password"
              :title="__('password')" />
            <input-float type="password"
              required
              v-model="form.passwordRepeat"
              :title="__('repeat_password')" />
            <div class="form-group">
                <btn block
                  type="submit">{{__('submit')}}</btn>
            </div>

        </form>
    </div>
    <div class="mt-3">
        <inertia-link href="/login"
          preserve-scroll>{{__('return_to_login')}}</inertia-link>

    </div>

</div>
</template>

<script>
export default
{

    name: "ResendEmail",
    props:
    {
        token: String
    },
    data()
    {
        return {
            form:
            {
                password: "",
                passwordRepeat: ""
            },
            errors: null,
            passwordFocused: false,
            passwordRepeatFocused: false
        }
    },
    methods:
    {
        handleSubmit()
        {
            event.preventDefault()
            this.$inertia.post( "/password/token/" + this.token, this.form )
        }
    }
}
</script>

<style scoped>

</style>
