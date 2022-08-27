<template lang="">

    <Head title="المواد الدراسية" />

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
                        <li class="breadcrumb-item active">
                            المواد الدراسية
                        </li>
                    </ol>
                    </div>
                </div>


                <div class="row">
                <div class="col-12">

                    <div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> تم بنجاح!</h5>
                    {{ $page.props.flash.message }}
                    </div>


                    <div v-if="$page.props.flash.error" class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> خطا!</h5>
                        {{ $page.props.flash.error }}
                    </div>

                    <div class="card-header">
                        <button
                            type="button"
                            class="btn btn-success"
                            data-toggle="modal"
                            data-target="#staticBackdrop">
                            اضافة مادة
                        </button>
                    </div>


                    <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table">
                            <thead>
                                <tr>
                                <th style="width: 10px">#</th>
                                <th>اسم المادة</th>
                                <th>المرحلة الدراسية</th>
                                <th>الصف الدراسى</th>
                                <th>اسم المعلم</th>
                                <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(subject, i) in subjects">
                                <td>{{++i}}</td>
                                <td>{{ subject.name }}</td>
                                <td>{{ subject.grade.name }}</td>
                                <td>{{ subject.class_room.class_name }}</td>
                                <td>{{ subject.teacher.name }}</td>
                                <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                                <Link :href="route('subject.edit',subject.id)" class="btn btn-info">
                                                    <i class="fa fa-edit"></i>
                                                </Link>
                                            <button type="submit" @click="destory(subject.id)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->



                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
            <!-- /.content -->

    <!-- Add Modal -->
    <div
        class="modal fade"
        id="staticBackdrop"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة مادة</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form
                        role="form"
                        @submit.prevent="submit">
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم المادة</label>
                            <input
                                v-model="form.name"
                                type="text"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                            />
                            <div
                                v-if="form.errors.name"
                                v-text="form.errors.name"
                                class="text-danger"
                            ></div>
                        </div>

                        <div class="form-group">
                            <label>اختير المرحلة الدراسية</label>
                            <select
                                v-model="form.grade_id"
                                class="form-control"
                                style="width: 100%" @change="classss(form.grade_id)">
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
                        <div class="form-group" v-if="classessRom.length > 0">
                            <label>اختير الفصل الدراسية</label>
                            <select
                                v-model="form.class_room_id"
                                class="form-control"
                                style="width: 100%">

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

                        <div class="form-group">
                            <label>اختير المعلمين</label>
                            <select
                                v-model="form.teacher_id"
                                class="form-control"
                                style="width: 100%">

                                <option v-for="teacher in teachers" :value="teacher.id">
                                    {{ teacher["name"] }}
                                </option>
                            </select>
                            <div
                                v-if="form.errors.teacher_id"
                                v-text="form.errors.teacher_id"
                                class="text-danger"
                            ></div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                اغلاق
                            </button>
                            <button
                                type="submit"
                                class="btn btn-primary"
                                :disabled="form.processing"
                            >
                                اضافة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</template>
<script>
import { Inertia } from '@inertiajs/inertia';
import swal from 'sweetalert';
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    props:{
        subjects: Object,
        grades: Object,
        classRom: Object,
        teachers: Object,
    },

    data(){
      return {
        classessRom : [],
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
        }
    },

    setup() {
        const destory = (id) => {
        swal({
            title: "هل انت متاكد من الحذف؟",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
            Inertia.delete(route("subject.destroy", id), {
                onSuccess: () => {
                swal("تم الحذف بنجاح", {
                    icon: "success",
                });
                },
            });
            } else {
            swal("هناك شى خطا");
            }
        });
        };

        let form = useForm({
            name: "",
            grade_id: "",
            class_room_id: "",
            teacher_id: "",
        });

        let submit = () => {
            form.post(route('subject.store'), {
                preserveScroll: true,
                onSuccess: () => $('#staticBackdrop').modal('toggle'),
            })
        }

        return { destory, form, submit };
    },
}
</script>
