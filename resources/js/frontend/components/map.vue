<template>
  <v-card light flat tile>
    <v-layout row wrap class="hotel-tab">
      <div id="map"></div>
    </v-layout>
  </v-card>
</template>
<script>
export default {
  props: {
    hotelAddress: {
      type: String
    }
  },
  data: function() {
    return {
      count: 0,
      bounds: null,
      address: this.hotelAddress,
      location: null
    };
  },
  watch: {
    hotelAddress: function() {
      this.address = this.hotelAddress;
    },
    address: function() {
      this.getAddress();
    }
  },
  methods: {
    formatKey: function(string) {
      this.address = string.replace(/\s/g, "+");
      console.log(this.address);
    },
    getAddress: function() {
      this.formatKey(this.address);
      axios({
        method: "get",
        url: "http://localhost:8000/api/manager/map",
        params: {
          address: this.address
        }
      })
        .then(response => {
          console.log(response);
          if (response.data.status == true) {
            this.location = response.data.location;
            
            var key = "11f82a7e50bc28";
            // var streets = L.tileLayer.Unwired({ key: key, scheme: "streets" });
            // var ll = [10.7379821, 106.677926397906];
            var ll = [response.data.location.lat, response.data.location.lon];
            var streets = L.tileLayer(
              "https://{s}-tiles.locationiq.com/v2/obk/r/{z}/{x}/{y}.png?key=11f82a7e50bc28"
            );
            var map = L.map("map", {
              center: ll,
              zoom: 14,
              layers: [streets]
            });
            setTimeout(function() {
              map.invalidateSize();
            }, 0);
            L.control.scale().addTo(map);
            L.control
              .layers({
                Streets: streets
              })
              .addTo(map);

            // .bindTooltip("my tooltip text").openTooltip();
            var tooltip = L.tooltip({direction : top}).setTooltipContent("hi");
            var marker = L.marker(ll).addTo(map).bindTooltip("hotel name").openTooltip();
            

          }
        })
        .catch(error => {
          console.log(error);
          console.log(error.response);
        });
    }
  },
  mounted() {
    // var key = "11f82a7e50bc28";
    // var streets = L.tileLayer.Unwired({ key: key, scheme: "streets" });
    // var map = L.map("map", {
    //   center: [10.7379821, 106.677926397906],
    //   zoom: 14,
    //   layers: [streets]
    // });
    // L.control.scale().addTo(map);
    // L.control
    //   .layers({
    //     Streets: streets
    //   })
    //   .addTo(map);
    // Add layers that we need to the map
    // var streets = L.tileLayer.Unwired({ key: key, scheme: "streets" });
    // Initialize the map
    // var map = L.map("map", {
    //   center: [13.2904027,108.4265113], // Map loads with this location as center
    //   zoom: 14,
    //   scrollWheelZoom: false,
    //   layers: [streets],
    //   preferCanvas : true // Show 'streets' by default
    // });
    // Add the 'scale' control
    // L.control.scale().addTo(map);
    // Add the 'layers' control
    // L.control
    //   .layers({
    //     Streets: streets
    //   })
    //   .addTo(map);
  }
};
</script>


