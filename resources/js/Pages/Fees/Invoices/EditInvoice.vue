<template lang="">
    <Head title="تعديل فاتورة" />

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
                            <li class="breadcrumb-item active">تعديل فاتورة</li>

                        </ol>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-12">


                    <div class="card card-primary">
                        <div class="card-header">
                            تعديل فاتورة
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form"  @submit.prevent="form.put(route('invoices.update',invoice.id))">
                            <div class="card-body">
                                <div class="border">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">اسم الطالب</label>
                                                <input :value="invoice.student.name" type="text" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>نوع الرسوم</label>
                                                <select
                                                    v-model="form.fee_id"
                                                    class="form-control"
                                                    style="width: 100%"
                                                    required>
                                                    <option
                                                        v-for="fe in fee"
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

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">المبلغ</label>
                                                    <select
                                                        v-model="form.amount"
                                                        class="form-control"
                                                        style="width: 100%"
                                                        required>
                                                        <option
                                                            v-for="fe in fee"
                                                            :value="fe.price" >
                                                            {{ fe.price }}
                                                        </option>
                                                    </select>
                                                    <div v-if="form.errors.amount" v-text="form.errors.amount" class="text-danger"></div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">البيان</label>
                                                <textarea v-model="form.notes" type="password" class="form-control" id="exampleInputPassword1" placeholder="ملاحظات"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>

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
        invoice : Object,
        fee : Object,
    },
    data(){
        return {
            form: this.$inertia.form({
                fee_id : this.invoice.fee_id,
                amount : this.invoice.fee.price,
                notes : this.invoice.notes,
            }),

        }
    },

}
</script>

