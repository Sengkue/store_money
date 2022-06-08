<template>
    <div>
        <div class="col-xl-12">
             <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="mg-b-0">ລາຍການ ສິ້ນຄ້າ</h4>
                        <!-- <i class="mdi mdi-dots-horizontal text-gray"></i> -->
                        <span>
                            <button class="btn btn-warning new-btm"
                            @click="add_money()"
                             v-if="!FormShow">
                                ເພີ່ມໃໝ່
                            </button>
                            <button class="btn btn-primary new-btm m-1"
                            @click="save_money"
                            v-if="FormShow">
                                ບັນທຶກ
                            </button>
                            <button class="btn btn-danger new-btm"
                            @click="cancel_money"
                            v-if="FormShow">
                                ຍົກເລີກ
                            </button>
                        </span>
                    </div>
                   
                </div>
                <div class="card-body"> 
                    <!-- form add money -->
                    <div class="row" v-if="FormShow">
                        <div class="col-md-3">aaa</div>
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
                                <input
                                    type="number"
                                    class="form-control"
                                    id="product_amout"
                                    placeholder="ປ້ອນຈຳນວນ"
                                    v-model="FormMoney.money"
                                />
                            </div>

                            <div class="row" >
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
                                            typ="datetime"
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
                    <div class="table-responsive"> {{FormMoney}}
                        <table 
                            class="table table-bordered mg-b-0 text-md-nowrap"
                            v-if="!FormShow"
                        >
                            <thead>
                                <tr>
                                    <th>ລຳດັບ</th>
                                    <th>ອະທິບາຍ</th>
                                    <th>ຈຳນວນເງີນ</th>
                                    <th>ເງີນໃຜ</th>
                                    <th>ວັນທີ</th>
                                    <th class="text-center">ຈັດການ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Joan Powell</td>
                                    <td>Associate Developer</td>
                                    <td>$450,870</td>
                                    <td>$450,870</td>
                                    <td>
                                        <div
                                            class="btn-icon-list justify-content-center"
                                        >
                                            <button
                                                class="btn-warning icons-list-item"
                                                @click="edit_product(list.id)"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button
                                                class="btn-danger icons-list-item"
                                                @click="del_product(list.id)"
                                            >
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "StoreMoneySpend",

    data() {
        return {
            FormShow: false,
            FormMoney:{
                describe:"",
                money:"",
                whose:"",
                date:"",
            }
        };
    },

    mounted() {},

    methods: {
        add_money(){
            this.FormShow = true;
        },
        // save_money(){
        //     this.FormShow = false;
        // },
        cancel_money(){
            this.FormShow = false;
        }

    },
};
</script>

<style lang="scss" scoped></style>
