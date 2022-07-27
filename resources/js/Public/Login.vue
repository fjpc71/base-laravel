<template>
<div class="form-small ">
   
    <div class="card login-card">

         <div class="w-100 text-center py-4 logo-login">
            <img src="images/test_logo.jpeg" alt="Test Logo" />
        </div>
        <form @submit.prevent="handleSubmit"
          class="p-5 card-body mb-0">
            <input-float v-model="form.email"
              :title="__('email')"
              id="email" />

            <input-float v-model="form.password"
              type="password"
              :title="__('password')"
              id="password" />
            <div class="form-group py-3">
                <checkbox id="remember"
                  v-model="form.remember"
                  name="remember"
                  value="accepted"
                  unchecked-value="not_accepted">
                    {{__('remember_me')}}
                </checkbox>
            </div>
            <div class="form-group mb-0">
                <btn block type="submit">{{__('login')}}</btn>
            </div>

        </form>
        <div class="alert alert-success mx-5" role="alert" v-if="msg">
            {{msg}}
        </div>
    </div>
    <div class="d-flex justify-content-between py-2">
        <inertia-link href="/password/reset"
        preserve-scroll>{{__('forgot_password')}}</inertia-link>

        <!-- <inertia-link href="/register"
        preserve-scroll>{{__('register')}}</inertia-link> -->

      </div>
</div>
</template>

<script>
export default
{
    name: "Login",
    props: {
        msg: String,
    },
    data()
    {
        return {
            form:
            {
                email: "",
                password: "",
                remember: false
            },
        }
    },
    methods:
    {
        handleSubmit( event )
        {
            this.$inertia.post( "/login", this.form,
            {
                preserveState: true
            } )
        }
    },
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