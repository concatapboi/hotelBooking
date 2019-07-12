<template></template>

<script>
export default {
  props: {
    login:{
        type: Boolean
    }
  },
  created() {
      if(this.login){
          this.$router.push({ name: "home" });
      }
  }
};
</script>
