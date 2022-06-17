<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
					<div class="card-body">
						<input type="text" class="form-control" placeholder="ຄົ້ນຫາສິນຄ້າ...">
					</div>
				</div>  
               
              <div class="row" style="height: 77vh; overflow: auto;">
                <div class="col-md-2"  v-for="list in DataMoney.data" :key="list.id">
                    <div class="card">
                            <img alt="Image" class="img-fluid card-img-top" :src="'assets/img/'+list.image" style="width:100%; height: 140px; object-fit: cover; object-position: center;">
                            <div class="card-body text-center p-1">
                                <p class="card-text mb-0">{{ list.describe}}</p>
                                <p class="card-text  text-info">{{formatPrice(list.money)}}ກີບ</p>
                            </div>
                        </div>                    
                </div>               
            </div>  
            </div>
            
            <!-- <div class="col-4">
                 <div class="card">
					<div class="card-body">
						<h4 class="card-title text-info d-flex justify-content-between">
							<span> <strong>ລວມຍອດເງິນ: </strong> </span>
							<span> <strong>  ກີບ</strong> </span>
						</h4>
						<button type="button"  class="btn btn-success text-white mb-2" @click="BtPay()" :disabled="check_pay" style="width: 100%" >
                            <i class="mdi mdi-currency-usd"></i> ຊຳລະເງິນ
                        </button>
						<div class=" table-responsive" style="height: 65vh; overflow: auto">
							<table class="table table-bordered mg-b-0 text-md-nowrap border">
										<thead>
											<tr>
												<th>ລາຍການ</th>
												<th>ລາຄາ</th>
												<th>ຍອດລວມ</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td> </td>
												<td class=" text-right"> 55<br>
														<i class="fa fa-minus-circle cursor-pointer text-warning" @click="DelOne(item.id)"></i> <i class="fa fa-plus-circle cursor-pointer text-info" @click="AddOne(item.id)"></i> |  <i class="fa fa-times-circle cursor-pointer text-danger" @click="DelOneList(item.id)"></i>
												 </td>
												<td class=" text-right">555</td>
											</tr>
										</tbody>
									</table>
						</div>
					</div>
				</div>
            </div> -->
        </div>
    </div>
</template>

<script>
export default {
    name: 'MoneyPos',

    data() {
        return {
            DataMoney:[],
            SearchMoney:'',
            ListOrder:[],
        };
    },

    mounted() {
        
    },

    methods: {
        GetSpend(page){
			this.$axios.get("/sanctum/csrf-cookie").then((response)=>{
				this.$axios.get(`/api/spend?page=${page}&search=${this.SearchMoney}`)
				.then((response)=>{
						this.DataMoney = response.data;
				}).catch((error)=>{
					console.log(error);
				})
			});

		},
		formatPrice(value) {
			let val = (value / 1).toFixed(0).replace(",", ".");
			return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		},
        
    },
	created(){
		this.GetSpend();
	},
	// beforeRouteEnter(to, from, next){
	// 		if(!window.Laravel.isLoggedin_laravel){
	// 			window.location.href = "/login";
	// 		}

	// 	next();
    
        
    // },
};
</script>

<style lang="scss" scoped>

</style>