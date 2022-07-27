<template>
  <div class="modal-backdrop">
    <div class="modal">
      <header class="modal_header">
        <slot name="header"></slot>
      </header>

      <section class="modal_body">
        <slot name="body"></slot>
       </section>

      <footer class="modal_footer">
        <slot name="footer"> </slot>
      </footer>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'Modal',
    props: {
        showModal: Function,
    }
  };
</script>
<style lang="scss" scoped>
  .modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .modal {
    background: #FFFFFF;
    overflow-x: auto;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    @media screen and (min-width: 768px) {
      max-width: 27%;
      top: 0;
      right: 0;
      left: auto;
    }
    .modal_body {
        position: relative;
        padding: 40px;
        color: #000;
    }
  }
</style>
