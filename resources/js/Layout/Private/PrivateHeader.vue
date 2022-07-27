<template>
<header class="menu-header">
  <nav class="navbar navbar-expand-lg">
     <div class="logo d-flex align-items-center">
      <inertia-link href="/">
        <img src="/images/test_logo.jpeg"/>
      </inertia-link>
       
    </div>
    <div id="user-nav"
      :class="{'disabled': loading}"
      class="toggleable d-flex">
        <inertia-link href="/profile"
          preserve-state
          preserve-scroll>{{ $page.props.userinfo.name }}</inertia-link>
      <div id="logout">
        <inertia-link href="/logout" class="d-flex ml-3"><span>{{__("logout")}}</span>
          <icon class="ml-1" name="cancel" />
        </inertia-link>
      </div>
    </div>
    <div id="loading"
      v-if="loading" />
  </nav>
</header>
</template>

<script>
export default
{
  name: "PrivateHeader",
  props:
  {
    loading: Boolean
  }
}
</script>

<style lang="scss" scoped>
@import "../../../sass/variables"; // Variables
.menu-header {
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    bottom: auto;
    z-index: 999;
    background-color: $white;
    nav {
        padding: 10px 25px;
        &.navbar {
            justify-content: flex-end;
            z-index: 10;
            width: 100%;
            height: 70px;
            box-shadow: 0px 0px 30px #00000029;
            #user-nav {
              align-items: center;
              a {
                &:hover {
                  border: 0;
                  text-decoration: none;
                  color: #000;
                }
              }
              > #logout {
                a {
                  font-size: 0.7em;

                  > * {
                    vertical-align: middle;
                  }

                  .icon {
                    font-size: 1.5em;
                  }
                }
              }
            }
        }
        &:before {
            display: block;
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: auto;
            height: 9px;
        }
    }
    .logo{
      img{
        height: 50px;
        width: auto;
      }
    }
    a:hover{
      text-decoration: none;
    }
}
</style>
