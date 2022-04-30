<template lang="">
    <Head title="تعديل قسم" />

     <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>تعديل قسم</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><Link href="/">الرئيسية</Link></li>
                  <li class="breadcrumb-item"><Link :href="route('section.index')">الاقسام الدراسية</Link></li>
                  <li class="breadcrumb-item active">تعديل قسم </li>
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
                <form role="form" @submit.prevent="form.post(route('section.update',section.id))">

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
                    <div class="form-group ">
                        <label>اختير الحالة</label>
                        <select v-model="form.status" class="form-control" style="width: 100%;">
                            <option :value="1" >نشط</option>
                            <option :value="0" >معلق</option>

                        </select>
                        <div v-if="form.errors.class_room_id" v-text="form.errors.class_room_id" class="text-danger"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" :disabled="form.processing">تعديل</button>
                    </div>
                </form>
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
        section : Object,
        grades : Object,
        classRom : Object,
    },


    setup(props){

        let form = useForm({
            section_name: props.section.section_name,
            grade_id: props.section.grade_id,
            class_room_id: props.section.class_room_id,
            status: props.section.status,
        });


        return {form}
    },

}
</script>
<style lang="">

</style>
