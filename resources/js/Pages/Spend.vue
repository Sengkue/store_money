<template>
    <div>
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="mg-b-0">ລາຍການສະແດງເງິນໃຊ້ຈ່າຍ</h4>
                        
   
   
                        <!-- <i class="mdi mdi-dots-horizontal text-gray"></i> -->
                        <span>
                            <button
                                class="btn btn-warning new-btm"
                                @click="add_money()"
                                v-if="!FormShow"
                            >
                                ເພີ່ມໃໝ່
                            </button>
                            <button
                                class="btn btn-primary new-btm m-1"
                                @click="save_money"
                                v-if="FormShow"
                                :class="check_form"
                            >
                                ບັນທຶກ
                            </button>
                            <button
                                class="btn btn-danger new-btm"
                                @click="cancel_money"
                                v-if="FormShow"
                            >
                                ຍົກເລີກ
                            </button>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <!-- form add money -->
                    <div class="row" v-if="FormShow">
                        <div class="col-md-3">
                            <img :src="imagePreview" alt="upload" />
                            <input
                                type="file"
                                @change="onSelected"
                                class="mt-2"
                            />
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="product_name"
                                    >ໃຊ້ກັບ
                                    <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="product_name"
                                    placeholder="ປ້ອນຄຳອະທິບາຍ"
                                    v-model="FormMoney.describe"
                                />
                            </div>
                            <div class="form-group">
                                <label for="product_amout"
                                    >ຈຳນວນເງີນ
                                    <span class="text-danger">*</span>
                                </label>
                                <cleave
                                    :options="options"
                                    class="form-control"
                                    id="product_amout"
                                    placeholder="ປ້ອນຈຳນວນ"
                                    v-model="FormMoney.money"
                                />
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_buy"
                                            >ເງີນໃຜ
                                            <span class="text-danger"
                                                >*</span
                                            ></label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="product_buy"
                                            placeholder="ປ້ອນ"
                                            v-model="FormMoney.whose"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_sell"
                                            >ວັນທີ
                                            <span class="text-danger"
                                                >*</span
                                            ></label
                                        >
                                        <input
                                            type="date"
                                            :options="options"
                                            class="form-control"
                                            id="date"
                                            placeholder="ປ້ອນວັນທີ"
                                            v-model="FormMoney.date"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end form add money -->
                    <div v-if="!FormShow">
                        <div class="row pb-2 d-flex justify-content-end">
                            <div class="col-md-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="SearchMoney"
                                    @keyup.enter="GetSpend()"
                                    placeholder="ຄົ້ນຫາສິນຄ້າ..."
                                />
                            </div>
                        </div>
                    <div class="table-responsive" >
                        
                        <!-- {{FormMoney}}
                        <hr>
                        {{FormData }} -->
                        <table
                            class="table table-bordered mg-b-0 text-md-nowrap"
                        >
                            <thead>
                                <tr>
                                    <th>ລຳດັບ</th>
                                    <th>ອະທິບາຍ</th>
                                    <th>ຈຳນວນເງີນ</th>
                                    <th>ເງີນໃຜ</th>
                                    <th>ວັນທີ</th>
                                    <th>ເມື່ອ</th>
                                    <th class="text-center">ຈັດການ</th>
                                </tr>
                            </thead>
                            <tbody>                                
                                <tr v-for="list in FormData.data
                                " :key="list.id">
                                    <!-- can use list.index -->
                                    <th scope="row">{{ list.id }}</th>
                                    <td>{{ list.describe }}</td>
                                    <td>{{ formatPrice(list.money) }}ກີບ</td>
                                    <td>{{ list.whose }}</td>
                                    <td>{{date(list.created_at)}}</td>
                                    <td>{{timeago(list.created_at)}}</td>
                                    <td>{{}}</td>
                                 
                                    <td>
                                        <div
                                            class="btn-icon-list justify-content-center"
                                        >
                                            <button
                                                class="btn-warning icons-list-item"
                                                @click="edit_money(list.id)"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button
                                                class="btn-danger icons-list-item"
                                                @click="del_money(list.id)"
                                            >
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr></tr>
                            </tbody>
                        </table>
                        <pagination :pagination="FormData" @paginate="GetSpend($event)" :offset="4" ></pagination>
                   
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
export default {
    
    name: "StoreMoneySpend",
    components:{
        moment
    },

    data() {
        return {
            imagePreview: window.location.origin + "/assets/img/upload.jpg",
            imageMoney: "",
            FormShow: false,
            FormType: true,
            FormID: "",
            FormMoney: {
                describe: "",
                money: "",
                whose: "",
                date: "",
            },
            FormData: [],
            options: {
                // prefix: '$',
                numeral: true,
                numeralPositiveOnly: true,
                noImmediatePrefix: true,
                rawValueTrimPrefix: true,
                numeralIntegerScale: 10,
                numeralDecimalScale: 2,
                numeralDecimalMark: ".",
                delimiter: ",",
            },
            SearchMoney:'',
        };
    },

    	watch:{
		SearchMoney(){
			if(this.SearchMoney==''){
				this.GetSpend();
			}
		}
	},

    mounted() {},
    computed: {
        // GetStore(page){

        // 	this.$axios.get("/sanctum/csrf-cookie").then((response)=> {
        //         this.$axios.get('/api/spend/')
        //         .then((response)=>{
        //            this.FormData = response.data;
        //         }).catch((error)=>{
        //              console.log(error);
        //         })
        //     })

        // },
        check_form() {
            if (
                this.FormMoney.describe == "" ||
                this.FormMoney.money == "" ||
                this.FormMoney.whose == "" ||
                this.FormMoney.date == ""
            ) {
                return "disabled";
            } else {
                return "";
            }
        },
    },

    methods: {
        timeago(value){
            return moment(value).fromNow();
        },
        date(value){
            return moment(value).format('DD-MM-YYYY');

        },
        onSelected(event) {
            console.log(event.target.files[0]);

            this.imageMoney = event.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(this.imageMoney);
            reader.addEventListener(
                "load",
                function () {
                    this.imagePreview = reader.result;
                }.bind(this),
                false
            );
        },

        GetSpend(page) {
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios.get(`/api/spend?page=${page}&search=${this.SearchMoney}`)
                    .then((response) => {
                        this.FormData = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            });
        },

        add_money() {
            (this.imagePreview =
                window.location.origin + "/assets/img/upload.jpg"),
                (this.FormShow = true);
            // clear
            this.FormMoney.describe = "";
            this.FormMoney.money = "";
            this.FormMoney.whose = "";
            this.FormMoney.date = "";
        },
        save_money() {
            //    console.log(this.FormMoney)
            if (this.FormType) {
                //add to FormData--------------------
                // this.FormData.push({
                //     id: Math.floor(Math.random() * 100),
                //     describe: this.FormMoney.describe,
                //     money: this.FormMoney.money,
                //     whose: this.FormMoney.whose,
                //     date: this.FormMoney.date,
                // });

                // add to mysql-----------------------

                let newFormData = new FormData();
                newFormData.append("describe", this.FormMoney.describe);
                newFormData.append("money", this.FormMoney.money);
                newFormData.append("whose", this.FormMoney.whose);
                // newFormData.append('date', this.FormMoney.date);
                newFormData.append("file", this.imageMoney);
                newFormData.append("acc_type", "expense");

                this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                    this.$axios
                        .post("/api/spend/add", newFormData, {
                            headers: { "Content-Type": "multipart/form-date" },
                        })
                        .then((response) => {
                            this.FormShow = false;
                            this.GetSpend();
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                });
            } else {
                // =======> update in vue.js at mysql no change<=========

                // this.FormData.find((i) => i.id == this.FormID).describe =
                //     this.FormMoney.describe;
                // this.FormData.find((i) => i.id == this.FormID).money =
                //     this.FormMoney.money;
                // this.FormData.find((i) => i.id == this.FormID).whose =
                //     this.FormMoney.whose;
                // this.FormData.find((i) => i.id == this.FormID).date =
                //     this.FormMoney.date;

                let newformData = new FormData();
                newformData.append("describe", this.FormMoney.describe);
                newformData.append("money", this.FormMoney.money);
                newformData.append("whose", this.FormMoney.whose);
                newformData.append("file", this.imageMoney);
                let id_update = this.FormID;

                this.$axios.get("/sanctum/csrf=cookie").then((response) => {
                    this.$axios
                        .post(`/api/spend/update/${id_update}`, newformData, {
                            headers: { "Content-Type": "multipart/form-date" },
                        })
                        .then((response) => {
                            this.FormShow = false;
                            this.GetSpend();
                        });
                });
            }

            // clear
            this.FormMoney.describe = "";
            this.FormMoney.money = "";
            this.FormMoney.whose = "";
            this.FormMoney.date = "";
            // show
            this.FormShow = false;
            // formtype update
            this.FormType = true;
        },
        // cancel
        cancel_money() {
            this.FormShow = false;
        },
        // edit
        edit_money(id) {
            //let item = this.FormData.find((i) => i.id == id);
            // console.log(item)

            //    add datab to form
            // const fm = this.FormMoney;
            // fm.describe = item.describe;
            // fm.money = item.money;
            // fm.whose = item.whose;
            // fm.date = item.date;

            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .post(`/api/spend/edit/${id}`)
                    .then((response) => {
                        this.FormMoney.describe = response.data.describe;
                        this.FormMoney.money = response.data.money;
                        this.FormMoney.whose = response.data.whose;
                        //this.FormProduct.price_sell = response.data.price_sell;
                        //this.imagePreview = response.data.images;

                        if (response.data.image) {
                            this.imagePreview =
                                window.location.origin +
                                "/assets/img/" +
                                response.data.image;
                        } else {
                            this.imagePreview =
                                window.location.origin +
                                "/assets/img/upload.jpg";
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            });
            //    show form
            this.FormShow = true;
            //   formtype for update
            this.FormType = false;
            // use id for update
            this.FormID = id;
        },
        del_money(id) {
            // show delete comfirm
            // this.$swal("Hello Vue world!!!");
            this.$swal
                .fire({
                    title: "ທ່ານແນ່ໃຈບໍ?",
                    text: "ທີຈະລືບຂໍ້ມູນລາຍການນີ້!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "ຢືນຢັນລືບ",
                    cancelButtonText: "ຍົກເລີກ",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$axios
                            .get("/sanctum/csrf=cookie")
                            .then((response) => {
                                this.$axios
                                    .delete(`/api/spend/delete/${id}`)
                                    .then((response) => {
                                        this.GetSpend();
                                        this.$swal.fire(
                                            "ລືບສຳເລັດ!",
                                            "ຂໍ້ມູນຖືກລືບແລ້ວ!.",
                                            "success"
                                        );
                                    });
                            });

                        // find index
                        let index = this.FormData.map((i) => i.id).indexOf(id);

                        // use index delete information
                        this.FormData.splice(index, 1);
                    }
                });
        },
        // show  ຈຳຈຸດ
        formatPrice(value) {
            let val = (value / 1).toFixed(0).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
    },

    created() {
        this.GetSpend();
        // console.log(window.Laravel.user);
        console.log(window.Laravel.user.id);
        


    },

    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isloggedin_laravel) {
            window.location.href = "/login";
        }
        next();
    },
};

</script>

<style lang="scss" scoped></style>
