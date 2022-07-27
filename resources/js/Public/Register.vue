<template>
<div class="form-small">
  <div class="card">

    <div class="w-100 text-center py-4 logo-login">
            <img src="images/test_logo.jpeg" alt="Test Logo" />
        </div>

    <form @submit.prevent="handleSubmit"
      class="p-5 card-body mb-0">
      <h1>{{__('register')}}</h1>
      <input-float :title="__('name')"
        v-model="form.name"
        name="name"
        required />
      <input-float title="NIF"
        :validationFunction="validNIFNIE"
        v-model="form.nif"
        required />
      <input-float :title="__('telephone')"
        v-model="form.phone"
        />
      <input-float :title="__('email')"
        type="email"
        v-model="form.email"
        required />
      <input-float :title="__('password')"
        type="password"
        required
        v-model="form.password" />
      <input-float :title="__('password_repeat')"
        type="password"
        :validationFunction="(e) => {return e == form.password}"
        required
        v-model="password_repeat" />
      <select-float
          v-model="form.lang"
          :list="langs"
          :title="__('lang')"
          />
      <select-float
          v-model="form.country"
          :list="countries"
          :title="__('country')"
          />
      <select-float
          v-model="form.userType"
          :list="user_types"
          :title="__('user_type')"
          />

       <div class="form-group mb-0">
            <btn block type="submit">{{__('register')}}</btn>
        </div>
      <div>

      </div>
    </form>
  </div>
  <inertia-link href="/login"
  preserve-scroll>{{__('return_to_login')}}</inertia-link>
</div>
</template>

<script>
export default
{
  name: "Register",
  props: {
    langs: Array,
    countries: Array,
    user_types: Array,
  },
  data()
  {
    return {
      password_repeat: "",
      form:
      {}
    }
  },
  methods:
  {
    handleSubmit( e )
    {
      this.$inertia.post( "/register", this.form )
    },
    validNIFNIE( nif )
    {
      nif = nif.toUpperCase();
      var dni = nif.substring( 0, 8 );
      //los nie empiezan por X, que para el calculo se convierten en cero:
      if ( dni.substring( 0, 1 ) == "X" ) dni = dni.replace( "X", 0 );
      else if ( dni.substring( 0, 1 ) == "Y" ) dni = dni.replace( "Y", 1 );
      else if ( dni.substring( 0, 1 ) == "Z" ) dni = dni.replace( "Z", 2 );
      else
      {
        if ( dni.substring( 0, 1 ) == "T" && /^[T]{1}[A-Z0-9]{8}$/.test( nif ) ) return true;
      }

      if ( !/^\d{8}$/.test( dni ) || nif.length > 9 )
      {
        return false;
      }
      var letra = nif.substring( 8, 9 )
        .toUpperCase();
      var letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
      var numero = dni % 23;
      if ( letra != letras.substring( numero, numero + 1 ) )
      {
        return false;
      }
      else
      {
        return true;
      }
    },
  }
}
</script>
<style lang="scss" scoped>
  @import "../../sass/variables"; // Variables
    .logo-login{
        img{
            max-width: 250px;
        }
    }
    .form-small{
        min-width: 400px;
    }
</style>