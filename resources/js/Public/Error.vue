<template>
<div id="error">
    <span id="code">404</span><span id="message">No encontrado</span>
</div>
</template>

<script>
//import ErrorLayout from "../Layout/ErrorLayout"
export default
{
    name: "Error",
    //layout: ErrorLayout
}
</script>

<style scoped>
#error
{
    font-size: 2em;
}

#code
{
    border-right: 2px solid black;
    padding-right: 0.5em;
    margin-right: 0.5em;
}
</style>
