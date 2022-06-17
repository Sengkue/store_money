<template>
    <div>
        <div class="page">

			<div class="container-fluid">
				<div class="row no-gutter">
					<!-- The image half -->
					<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
						<div class="row wd-100p mx-auto text-center">
							<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
								<img src="assets/img/media/skv.jpg" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
							</div>
						</div>
					</div>
					<!-- The content half -->
					<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
						<div class="login d-flex align-items-center py-2">
							<!-- Demo content-->
							<div class="container p-0">
								<div class="row">
									<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
										<div class="card-sigin">
											<div class="mb-5 d-flex">
												<a href="index.html"><img src="assets/img/brand/pajntaub.png" class="sign-favicon-a ht-40" alt="logo">
												<img src="assets/img/brand/pajntaub.png" class="sign-favicon-b ht-40" alt="logo">
												</a>
												<h1 class="main-logo1 ms-1 me-0 my-auto tx-28">ບໍລິການ<span>ເກັບລາຍ</span>ຈ່າຍ</h1>
											</div>
											<div class="main-signup-header">
												<h2 class="text-primary">ເລີ່ມຕົ້ນ</h2>
												<h5 class="fw-normal mb-4">ສາມາດລົງທະບ່ຽນຟຣີພຽນຂັ້ນຕອນຕໍ່ໄປນີ້.</h5>
												
													<div class="form-group">
														<label>ຊື່ຜູ້ໃຊ້</label> <input class="form-control" placeholder="ປ້ອນຊື່ຜູ້ໃຊ້" type="text" v-model="name">
													</div>
													<div class="form-group">
														<label>ອີເມວລ໌</label> <input class="form-control" placeholder="ປ້ອນອີເມວລ໌" type="email" v-model="email">
													</div>
													<div class="form-group">
														<label>ລະຫັດຜ່ານ</label> <input class="form-control" placeholder="ປ້ອນລະຫັດຜ່ານ" type="password" v-model="password">
													</div>
													<div class="form-group">
														<label>ຢືນຢັນລະຫັດຜ່ານ</label> <input class="form-control" placeholder="ຢືນຢັນລະຫັດຜ່ານ" type="password" v-model="password2">
													</div>
													<button class="btn btn-primary btn-block" @click="Register()">ສ້າງບັນຊີ</button>
													
													<div class="alert alert-info mt-1" role="alert" v-if="ShowError">
		                                            <button  aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
			                                    	<span aria-hidden="true">&times;</span>
													</button>
													<strong>ແຈ້ງເຕື່ອມ!</strong> {{texterror}}
													</div>
													<!-- <div class="row row-xs">
														<div class="col-sm-6">
															<button class="btn btn-block"><i class="fab fa-facebook-f"></i> Signup with Facebook</button>
														</div>
														<div class="col-sm-6 mg-t-10 mg-sm-t-0">
															<button class="btn btn-info btn-block btn-b"><i class="fab fa-twitter"></i> Signup with Twitter</button>
														</div>
													</div> -->
											
												<div class="main-signup-footer mt-5">
													<p>ມີບັນຊີຢູ່ແລ້ວ? <router-link to="/login">ເຂົ້າສູ່ລະບົບ</router-link></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- End -->
						</div>
					</div><!-- End -->
				</div>
			</div>

		</div>
    </div>
</template>

<script>
export default {
    name: 'MoneyRegister',

    data() {
        return {
            name:'',
			email:'',
			password:'',
			password2:'',
			ShowError:false,
			texterror:''
        };
    },

    mounted() {
        
    },

    methods: {
        Register(){
			if(this.name =='' || this.email == '' || this.password == ''){
				this.ShowError = true;
				this.texterror = 'ກະລຸນາກວດຊອບຂໍ້ມູນ ໃຫ້ຄົບຖ້ວນ!'
			} else {
				if(this.password == this.password2){
					this.ShowError = false,
				    this.texterror = ''
					
					// xav information mus rua tom back-end
					this.$axios.post("api/register",
					{
						re_name: this.name,
						re_email: this.email,
						re_password: this.password
					}).then((response)=>{
						if(response.data.success){
							this.$router.push('login');// mus tom Login page
						} else{
							this.ShowError = true;
							this.texterror = response.data.message;

						}
					}).cath(function(error){
						console.error(error);
					});

				} else {
					this.ShowError = true;
					this.texterror = 'ລະຫັດຜູ້ໃຊ້ບໍ່ກົງກັນ!'
				}
				
			}
			
		}
    },
	beforeRouteEnter(to, from, next){
			if(window.Laravel.isloggedin_laravel){
				window.location.href = "/spend";
			}
			next();
	}
};
</script>

<style lang="scss" scoped>

</style>