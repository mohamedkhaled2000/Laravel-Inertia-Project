<template lang="">

    <Head title="الامتحانات" />

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
                            الامتحانات
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
                            اضافة امتحان
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
                                <th>اسم الامتحان</th>
                                <th>المرحلة الدراسية</th>
                                <th>الصف الدراسى</th>
                                <th>القسم</th>
                                <th>المعلم</th>
                                <th>المادة</th>
                                <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(exam, i) in exams">
                                <td>{{++i}}</td>
                                <td>{{ exam.name }}</td>
                                <td>{{ exam.grade.name }}</td>
                                <td>{{ exam.class_room.class_name }}</td>
                                <td>{{ exam.section.section_name }}</td>
                                <td>{{ exam.teacher.name }}</td>
                                <td>{{ exam.subject.name }}</td>
                                <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                                <Link :href="route('exam.edit',exam.id)" class="btn btn-info">
                                                    <i class="fa fa-edit"></i>
                                                </Link>
                                            <button type="submit" @click="destory(exam.id)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
                    <h5 class="modal-title" id="exampleModalLabel">اضافة الامتحان</h5>
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
                            <label for="exampleInputEmail1">اسم الامتحان</label>
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

                        <div class="row">

                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>المرحلة الدراسية</label>
                                    <select
                                        v-model="form.grade_id"
                                        class="form-control"
                                        style="width: 100%"
                                        @change="classss(form.grade_id)">
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

                            <div class="col-md-3 col-sm-12">
                                <div class="form-group" v-if="classessRom.length > 0">
                                    <label>الصف الدراسى</label>
                                    <select
                                        v-model="form.class_room_id"
                                        class="form-control"
                                        style="width: 100%"
                                        @change="section(form.class_room_id)">
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

                            <div class="col-md-3 col-sm-12">
                                <div class="form-group" v-if="sectionss.length > 0">
                                    <label>القسم</label>
                                    <select
                                        v-model="form.section_id"
                                        class="form-control"
                                        style="width: 100%">
                                        <option v-for="(section,i) in sectionss" :value="section['id']">
                                            {{ section["section_name"] }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="form.errors.section_id"
                                        v-text="form.errors.section_id"
                                        class="text-danger"
                                    ></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group" >
                                    <label>المعلم</label>
                                    <select
                                        v-model="form.teacher_id"
                                        class="form-control"
                                        style="width: 100%">
                                        <option v-for="(teacher,i) in teachers" :value="teacher['id']">
                                            {{ teacher["name"] }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="form.errors.teacher_id"
                                        v-text="form.errors.teacher_id"
                                        class="text-danger"
                                    ></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group" >
                                    <label>اختر المادة</label>
                                    <select
                                        v-model="form.subject_id"
                                        class="form-control"
                                        style="width: 100%">
                                        <option v-for="(subject,i) in subjects" :value="subject['id']">
                                            {{ subject["name"] }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="form.errors.subject_id"
                                        v-text="form.errors.subject_id"
                                        class="text-danger"
                                    ></div>
                                </div>
                            </div>
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
        exams  : Object,
        subjects  : Object,
        grades  : Object,
        classRom  : Object,
        teachers  : Object,
        sections  : Object,
    },

    data(){
      return {
            classessRom : [],
            sectionss : [],
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


        section(id){
            this.sectionss = []

            this.sections.forEach(el => {
                if(el.class_room_id == id){
                    this.sectionss.push(el)
                }
            });
        },

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
            Inertia.delete(route("exam.destroy", id), {
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
            grade_id :"",
            class_room_id :"",
            section_id :"",
            teacher_id :"",
            subject_id :"",
        });

        let submit = () => {
            form.post(route('exam.store'), {
                preserveScroll: true,
                onSuccess: function() {
                        $('#staticBackdrop').modal('toggle'),
                        form.reset()
                    },
            })
        }

        return { destory, form, submit };
    },
}


</script>
