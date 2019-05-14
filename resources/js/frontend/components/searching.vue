<template>
<div>
    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url('/blog/img/bg-img/16.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Searching</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->
    <!-- About Us Area Start -->
    <section class="roberto-about-area section-padding-100-0">
        <!-- Hotel Search Form Area -->
        <div class="hotel-search-form-area">
            <div class="container-fluid">
                <div class="hotel-search-form">
                    <form action="#" method="post">
                        <div class="row justify-content-between align-items-end">
                            <div class="col-6 col-md-2 col-lg-3">
                                <label for="checkIn">Place</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Where do you want to go?">
                            </div>
                            <div class="col-6 col-md-2 col-lg-3">
                                <label for="checkIn">Check In</label>
                                <input type="date" class="form-control" id="checkIn" name="checkin-date">
                            </div>
                            <div class="col-6 col-md-2 col-lg-3">
                                <label for="checkOut">Check Out</label>
                                <input type="date" class="form-control" id="checkOut" name="checkout-date">
                            </div>
                            <div class="col-4 col-md-1">
                                <label for="room">Room</label>
                                <input type="number" name="room" value="1" min ="1" class="form-control">
                            </div>
                            <div class="col-4 col-md-1">
                                <label for="adults">Adult</label>
                                <input type="number" name="adults" value="1" min ="1" class="form-control">
                            </div>
                            <div class="col-4 col-md-2 col-lg-1">
                                <label for="children">Children</label>
                                <input type="number" name="children" value="0" min ="0" class="form-control">
                            </div>
                            <div class="col-12 col-md-3">
                                <button type="button" class="form-control btn roberto-btn w-100" v-on:click="click">Enter</button>                              
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </section>
</div>
</template>

<script>
    export default {
        data(){
            return {
                id:1,
                data:[],
            };
        },
        created(){
            this.createProduct(1);
        },
        methods: {
            createProduct(id) {
                axios.get('/api/hotel/',{params :{id:id}})            
                .then(res => {
                    console.log(res.data.data);
                    this.data = res.data.data;
                })
                .catch(error => {
                    console.log(error)
                })
            },
            click: function(){
                alert('Stop').then(res=>{
                    return this.$router.push({name:'about'});
                });
            },
        },
    }
</script>
