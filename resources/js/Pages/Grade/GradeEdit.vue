<template lang="">
    <Head title="تعديل مرحلة" />

         <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1> تعديل مرحلة</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><Link href="/">الرئيسية</Link></li>
                    <li class="breadcrumb-item"><Link :href="route('grade.index')">المراحل الدراسية</Link></li>
                    <li class="breadcrumb-item active">تعديل مرحلة</li>
                </ol>
                </div>
            </div>
            </div>
            <!-- /.container-fluid -->
        </section>

    <section class="content">
        <div class="container-fluid">
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

    </section>


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
