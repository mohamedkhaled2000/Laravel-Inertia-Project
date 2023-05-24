<template lang="">
    <Head title="اضافة فاتورة جديدة" />

            <div class="content-body">
                <div class="container-fluid">
                    <div class="row page-titles mx-0">
                        <div class="col-sm-6 p-md-0">
                        </div>
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <Link href="/">الرئيسية</Link>
                            </li>
                            <li class="breadcrumb-item active">اضافة فاتورة جديدة</li>

                        </ol>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-12">


                    <div class="card card-primary">
                        <div class="card-header">
                            اضافة فاتورة جديدة
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form"  @submit.prevent="form.post(route('invoices.store'))">
                            <div class="card-body">
                                <div class="border">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">اسم الطالب</label>
                                                <input :value="name" type="text" class="form-control" readonly>
                                                <div v-if="form.errors.name" v-text="form.errors.name" class="text-danger"></div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group" v-for="(fe,index) in form.fee" :key="index">
                                                <label>نوع الرسوم</label>
                                                <select
                                                    v-model="fe.fee"
                                                    class="form-control"
                                                    style="width: 100%"
                                                    :aria-label="`fee${index}`"
                                                    required>
                                                    <option
                                                        v-for="fe in fees"
                                                        :value="fe.id" >
                                                        {{ fe.name }}
                                                    </option>
                                                </select>
                                                <div
                                                    v-if="form.errors.fee"
                                                    v-text="form.errors.fee"
                                                    class="text-danger"
                                                ></div>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <div class="form-group" v-for="(am,index) in form.fee" :key="index">
                                                <label for="exampleInputEmail1">المبلغ</label>
                                                <div class="d-flex">
                                                    <select
                                                        v-model="am.amount"
                                                        class="form-control"
                                                        style="width: 100%"
                                                        required>
                                                        <option
                                                            v-for="fe in fees"
                                                            :value="fe.price" >
                                                            {{ fe.price }}
                                                        </option>
                                                    </select>

                                                    <button class="btn btn-danger btn-sm mr-1" v-if="form.fee.length != 1" @click="DeleteField(index)">
                                                        <i class="fa fa-trash" title="حذف"> </i>
                                                    </button>
                                                </div>

                                                <div v-if="form.errors.amount" v-text="form.errors.amount" class="text-danger"></div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">البيان</label>
                                                <textarea v-model="form.notes" type="password" class="form-control" id="exampleInputPassword1" placeholder="ملاحظات"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button class="btn btn-success" @click="AddField()">
                                    ادراج
                                </button>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">تاكيد</button>
                            </div>
                        </form>
                    </div>

                    </div>
                </div>
            </div>

        </div>


</template>
<script>
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    props:{
        student : Object,
        fees : Object,
    },
    data(){
        return {
            form: this.$inertia.form({
                student_id : this.student.id,
                grade_id : this.student.grade_id,
                class_room_id : this.student.class_room_id,
                fee : [{fee: '',amount: ''}],
                notes :"",
            }),

            name: this.student.name
        }
    },
    methods:{
        AddField() {
            this.form.fee.push({
                fee:"",
                amount:"",
            });
        },
        DeleteField(index) {
            this.form.fee.splice(index,1);
            this.form.amount.splice(index,1);
        },
    },

}
</script>

