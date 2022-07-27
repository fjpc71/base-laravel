<template>
<div class="form-small">
    <div class="card login-card">
        <div class="w-100 text-center py-4 logo-login">
            <img src="/images/test_logo.jpeg" alt="Test_Logo" />
        </div>
        
        <form @submit="handleSubmit"
          class="card-body p-5 mb-0">
            <h1 class="mt-30">{{__('reset_password')}}</h1>
            <input-float v-model="form.email"
              :title="__('email')" />
            <div class="form-group pt-3 mb-0">
                <btn block
                  type="submit">{{__('submit')}}</btn>
            </div>
        </form>

    </div>
    <div class="my-3">
        <inertia-link href="/login"
          preserve-scroll>{{__('return_to_login')}}</inertia-link>

    </div>

</div>
</template>

<script>
export default
{

    name: "ResendEmail",
    data()
    {
        return {
            form:
            {
                email: ""
            },
            emailFocused: false
        }
    },
    methods:
    {
        handleSubmit()
        {
            event.preventDefault()
            this.$inertia.post( "/password/reset", this.form )
        }
    }
}
</script>
<style lang="scss" scoped>
@import "../../sass/variables"; // Variables
    .login-card{
        box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 20%), 0 1px 5px 0 rgb(0 0 0 / 12%);
        padding: 0;
    }
    .logo-login{
        img{
            width: 100%;
            max-width: 250px;
        }
    }
    .form-small{
        min-width: 400px;
    }
</style>