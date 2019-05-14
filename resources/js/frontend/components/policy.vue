<template>
<div class="container">
    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url('/blog/img/bg-img/16.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Policies</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#"><router-link :to="{name:'home'}">Home</router-link></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Policies</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->
    <!-- Items Area Start -->
	<div class="roberto-news-area section-padding-100-0">
			<div class="container">
					<div class="row justify-content-center">
                            <!-- Left-->
							<div class="col-12 col-lg-3">
							</div>
						    <!-- Login Area Start -->
							<div class="col-12 col-lg-6">
								<table>
                                    <tr>
                                        <td>Trước khi thực hiện một yêu cầu dịch vụ cần xem rõ các điều khoản và nội dung chính sách liên quan. Mọi thắc mắc có thể liên hệ với hệ thống hoặc doanh nghiệp cung cấp chỗ ở mà bạn đang chọn sử dụng dịch vụ qua email, số điện thoại, fax,…</td>
                                        <td>Giá hiển thị trên hệ thống là giá đã bao gồm thuế giá trị gia tăng và các loại phí khác. Tuy nhiên, những mức giá được đưa ra bởi những doanh nghiệp cung cấp chỗ ở này có thể bao gồm các điểm hạn chế và điều kiện như: không thể hủy và không hoàn tiền. Vui lòng kiểm tra các chi tiết và điều kiện về sản phẩm, dịch vụ và đặt phòng một cách thấu đáo để được biết về các điều kiện này trước khi thực hiện đặt phòng.</td>
                                    </tr>
                                </table>
							</div>
                            <!-- Right-->
							<div class="col-12 col-lg-3">
							</div>							
					</div>
			</div>
	</div>
	<!-- Items Area End -->
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
