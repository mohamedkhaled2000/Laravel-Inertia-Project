<template lang="">
    <Head title="تعديل مرحلة" />


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
                            <li class="breadcrumb-item"><Link :href="route('grade.index')">المراحل الدراسية</Link></li>
                            <li class="breadcrumb-item active">تعديل مرحلة</li>

                        </ol>
                        </div>
                    </div>


            <div class="row">
                <div class="col-12">


                <div class="card card-primary">
                    <div class="card-header">
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" @submit.prevent="form.post(route('grade.update',form.id))">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">اسم المرحلة</label>
                                <input v-model="form.name" type="text" class="form-control" id="exampleInputEmail1" placeholder="ادخل اسم المرحلة">

                                <div v-if="form.errors.name" v-text="form.errors.name" class="text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">ملاحظات</label>
                                <textarea v-model="form.notes" type="password" class="form-control" id="exampleInputPassword1" placeholder="ملاحظات"></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" :disabled="form.processing">تعديل</button>
                        </div>
                    </form>
                </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
 import { useForm } from "@inertiajs/inertia-vue3";
export default {
    props:{
       grade: String,
    },

    setup(props){

        const form = useForm({
            id : props.grade.id,
            name: props.grade.name,
            notes: props.grade.notes,
        });

        return {form}
    }
}
</script>
