<template lang="">
    <Head title="اضافة رسم جديد" />

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
                            <li class="breadcrumb-item active">اضافة رسم جديد</li>

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
                        <form role="form" @submit.prevent="submit">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">اسم الرسم</label>
                                            <input v-model="form.name" type="text" class="form-control">
                                            <div v-if="form.errors.name" v-text="form.errors.name" class="text-danger"></div>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">المبلغ</label>
                                            <input v-model="form.price" type="text" class="form-control">
                                            <div v-if="form.errors.price" v-text="form.errors.price" class="text-danger"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>المرحلة الدراسية</label>
                                            <select
                                                v-model="form.grade_id"
                                                class="form-control"
                                                style="width: 100%"
                                                @change="classss(form.grade_id)" required>
                                                <option
                                                    v-for="grade in grades"
                                                    :value="grade.id" >
                                                    {{ grade.name }}
                                                </option>
                                            </select>
                                            <div
                                                v-if="form.errors.grade_id"
                                                v-text="form.errors.grade_id"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group" v-if="classessRom.length > 0">
                                            <label>الصف الدراسى</label>
                                            <select
                                                v-model="form.class_room_id"
                                                class="form-control"
                                                style="width: 100%"
                                                required>
                                            <option v-for="(classRoom,i) in classessRom" :value="classRoom['id']">
                                                {{ classRoom["class_name"] }}
                                            </option>
                                            </select>
                                            <div
                                                v-if="form.errors.class_room_id"
                                                v-text="form.errors.class_room_id"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>السنة الدراسية</label>
                                            <select
                                                v-model="form.academic_year"
                                                class="form-control"
                                                style="width: 100%" required>
                                                <option v-for="y in currentYear" :value="y">
                                                    {{ y }}
                                                </option>
                                            </select>
                                            <div
                                                v-if="form.errors.academic_year"
                                                v-text="form.errors.academic_year"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ملاحظات</label>
                                            <textarea v-model="form.notes" type="password" class="form-control" id="exampleInputPassword1" placeholder="ملاحظات"></textarea>
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
        grades : Object,
        classRom : Object,
    },
    data(){
        return {
            classessRom : [],

            currentYear : [
                new Date().getFullYear(),
                new Date().getFullYear()+1
            ],
        }
    },
    methods:{
        classss(id){
            this.classessRom = []

            this.classRom.forEach(el => {
                if(el.grade_id == id){
                    this.classessRom.push(el)
                }
            });
        },
    },
    setup(){

        let form = useForm({
            name :"",
            price :"",
            grade_id :"",
            class_room_id :"",
            academic_year :"",
            notes :"",
        });

        let submit = () => {
            form.post(route('fees.store'), {
                preserveScroll: true,
                onSuccess: () => form.reset(),
            })
        }

        return {form,submit}
    }
}
</script>

