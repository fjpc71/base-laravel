<template>
<div class="picture-selector"
  v-show="images.length > 0"
  ref="picturesWrapper">
  <div class="picture-arrows arrow-left"
    @click="slidePictures(1)"
    v-if="slider_pos < 0">
    <icon name="keyboard_arrow_left" />
  </div>
  <div class="picture-arrows arrow-right"
    @click="slidePictures(-1)"
    v-if="images.length + (slider_pos - 3) > 0">
    <icon name="keyboard_arrow_right" />
  </div>
  <div class="picture-spinner"
    :style="{left: (slider_pos *170 ) + 'px'}"
    ref="pictures">
    <div class="picture"
      v-for="image, idx of images">
      <img :src="getImage(image)"
        @click="$emit('select', idx)" />
    </div>
  </div>
</div>
</template>

<script>
export default
{
  name: "PictureSpinner",
  props:
  {
    images: Array,
    getImage:
    {
      type: Function,
      default: function ( image )
      {
        return '/' + image;
      }
    }
  },
  data()
  {
    return {
      slider_pos: 0
    }
  },
  watch:
  {
    images:
    {
      handler()
      {
        if ( ( this.slider_pos * -1 ) + 3 > this.images.length && this.images.length > 3 )
        {
          this.slidePictures( 1 )
        }
      }
    }
  },
  mounted()
  {
    // mounted()
    // {
    //   // const self = this
    //   // self.pictures_box_width = this.$refs.picturesWrapper.offsetWidth
    //   // new ResizeObserver( ( event ) =>
    //   //   {
    //   //     self.pictures_box_width = event[ 0 ].target.offsetWidth
    //   //
    //   //   } )
    //   //   .observe( this.$refs.picturesWrapper );
    //
    //   // new ResizeObserver( ( event ) =>
    //   //   {
    //   //     this.preview_picture_height = event[ 0 ].target.offsetHeight
    //   //
    //   //   } )
    //   //   .observe( this.$refs.previewPicture );
    //
    // },
  },
  methods:
  {
    slidePictures( direction )
    {
      this.slider_pos += direction
    },
  }
}
</script>

<style lang="scss">
.picture-selector {
    margin-top: 1em;
    height: 200px;
    position: relative;
    overflow: hidden;
    .picture-arrows {
        position: absolute;
        top: 50%;
        left: auto;
        right: auto;
        bottom: 0;
        transform: translateY(-50%);
        z-index: 99;
        height: 80px;
        transition: background-color 0.3s ease;
        border-radius: 5px;
        opacity: 0.7;
        cursor: pointer;
        &.arrow-left {
            left: 10px;
        }
        &.arrow-right {
            right: 10px;
        }
        .icon {
            font-size: 80px;
            pointer-events: none;
        }
        &:hover {
            background-color: white;
        }
    }
    .picture-spinner {
        position: absolute;
        top: 0;
        right: auto;
        bottom: 0;
        left: 0;
        display: flex;
        justify-content: flex-start;
        height: 200px;
        align-items: center;
        gap: 20px;
        transition: left 0.3s ease;
    }
    .picture {
        width: 150px;
        transition: opacity 0.3s ease;
        img {
            max-height: 100%;
            cursor: pointer;
        }
        &:hover {
            opacity: 0.7;
        }
    }
}
</style>
