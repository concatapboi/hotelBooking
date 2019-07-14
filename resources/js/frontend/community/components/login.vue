<template></template>

<script>
export default {
  props: {
    login:{
        type: Boolean
    }
  },
  created() {
      if(this.login || localStorage.getItem('login_token') != null){
          this.$router.push({ name: "home" });
      }
  }
};
</script>
