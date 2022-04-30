<template lang="">

    <Head title="الاقسام الدراسية" />

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>الاقسام الدراسية</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><Link href="/">الرئيسية</Link></li>
                  <li class="breadcrumb-item active">الاقسام الدراسية</li>
                </ol>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <!-- Default box -->
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

                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop">
                        اضافة صف
                    </button>
                <div v-for="grade in grades" class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="float:right">{{grade.name}}</h3>

                    <div class="card-tools" style="float:left">
                      <button type="button"
                        class="btn btn-tool"
                        data-card-widget="collapse"
                        data-toggle="tooltip"
                        title="Collapse"
                      >
                        <i class="fas fa-minus"></i>
                      </button>

                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>اسم القسم</th>
                          <th>اسم المرحلة</th>
                          <th>الحالة</th>
                          <th>العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(section, i) in sections" >
                          <td v-if="section.grade_id == grade.id">{{++i}}</td>
                          <td v-if="section.grade_id == grade.id"> {{ section.section_name }}</td>
                          <td v-if="section.grade_id == grade.id">{{ section.section_room.class_name }}</td>
                          <td v-if="section.grade_id == grade.id">
                             <span :class="{'badge badge-danger':section.status == 0,'badge badge-success':section.status == 1}">{{section.status == 0 ? 'معلق' : 'نشط'}}</span></td>
                          <td v-if="section.grade_id == grade.id" class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <Link :href="route('section.edit',section.id)" class="btn btn-info"><i class="fas fa-edit"></i></Link>
                                    <button type="submit" @click="destory(section.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                      </tbody>
                    </table>

                  </div>
                  <!-- /.card-body -->

                </div>
                <!-- /.card -->
              </div>
            </div>
          </div>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->


            <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اضافة صف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" @submit.prevent="form.post(route('section.store'))">

                    <div class="form-group">
                        <label for="exampleInputEmail1">اسم الصف</label>
                        <input v-model="form.section_name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div v-if="form.errors.section_name" v-text="form.errors.section_name" class="text-danger"></div>
                    </div>

                    <div class="form-group">
                        <label>اختير المرحلة الدراسية</label>
                        <select v-model="form.grade_id" class="form-control" style="width: 100%;">
                            <option v-for="grade in grades" :value="grade.id" >{{grade.name}}</option>
                        </select>
                        <div v-if="form.errors.grade_id" v-text="form.errors.grade_id" class="text-danger"></div>

                    </div>
                    <div class="form-group ">
                        <label>اختير الفصل الدراسية</label>
                        <select v-model="form.class_room_id" class="form-control" style="width: 100%;">
                            <option v-for="classes in classRom" :value="classes.id" :class="{'d-none': !form.grade_id}">
                                {{ classes.grade_id == form.grade_id ? classes.class_name : null }}
                            </option>

                        </select>
                        <div v-if="form.errors.class_room_id" v-text="form.errors.class_room_id" class="text-danger"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary" :disabled="form.processing">اضافة</button>
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
        sections : Object,
        grades : Object,
        classRom: Object
    },


    setup(){
        const destory = (id) => {

            swal({
                title: "هل انت متاكد من الحذف؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    Inertia.delete(route('section.delete',id),{
                        onSuccess: () => {
                            swal("تم الحذف بنجاح", {
                                icon: "success",
                            });
                        },
                    })

                } else {
                    swal("هناك شى خطا");
                }
            });
        };

        let form = useForm({
            section_name: "",
            grade_id: "",
            class_room_id: "",
        });

        return {destory,form}
    },

}
</script>
<style lang="">

</style>
