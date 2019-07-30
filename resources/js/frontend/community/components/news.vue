<template>
  <v-layout justify-center align-center row wrap>
    <v-flex shrink xs6>News1</v-flex>
    <v-flex shrink xs6>
        <div>Now:&nbsp;{{now}}</div>
        <div>Nex:&nbsp;{{next}}</div>
        <div>Yesterday:&nbsp;{{yesterday}}</div>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
        now: new Date(),
        next: this.$moment(this.now).add(1,'days'),
        yesterday: this.$moment(this.now).add(-1,'days'),
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  created() {},
  methods: {}
};
</script>
