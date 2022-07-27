<template>
  <div>
        <div class="burger-button">
            <span class="burger-bars burger-line-style" style="top: 0%;"></span>
            <span class="burger-bars burger-line-style" style="top: 40%;"></span>
            <span class="burger-bars burger-line-style" style="top: 80%;"></span>
        </div>
    </div>
</template>

<script>
export default
{
    name: "Hamburger"
}
</script>

<style scoped>

    .burger-button {
        position: absolute;
        width: 20px;
        height: 15px;
        left: 36px;
        top: 36px;
        cursor: pointer;
    }

    .burger-bars {
        background-color: #373a47;
    }

    .burger-line-style {
        position: absolute;
        height: 20%;
        left: 0;
        right: 0;
    }

</style>