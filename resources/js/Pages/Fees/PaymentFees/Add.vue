<template lang="">
    <Head title="سند صرف" />

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
                            <li class="breadcrumb-item"><Link :href="route('fees.index')">الرسوم الدراسية</Link></li>
                            <li class="breadcrumb-item active">{{ student.name }} سند صرف</li>

                        </ol>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-12">


                    <div class="card card-primary">
                        <div class="card-header">
                            <h3>{{ student.name }} سند صرف</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" @submit.prevent="submit">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">المبلغ</label>
                                            <input v-model="form.amount" type="text" class="form-control">
                                            <div v-if="form.errors.amount" v-text="form.errors.amount" class="text-danger"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الرصيد</label>
                                            <input :value="sum" type="text" class="form-control" readonly>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ملاحظات</label>
                                            <textarea v-model="form.notes" type="text" class="form-control" id="exampleInputPassword1" placeholder="ملاحظات"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" :disabled="form.processing">تاكيد</button>
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
        sum : Object,
    },
    setup(props){

        let form = useForm({
            student_id : props.student.id,
            amount :"",
            notes :"",
        });

        let submit = () => {
            form.post(route('payment_fees.store'), {
                preserveScroll: true,
                onSuccess: () => form.reset(),
            })
        }

        return {form,submit}
    }
}
</script>

