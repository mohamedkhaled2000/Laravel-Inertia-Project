<template lang="">
    <Head title="تعديل صف" />

     <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>تعديل صف</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><Link href="/">الرئيسية</Link></li>
                  <li class="breadcrumb-item"><Link :href="route('class.index')">الصفوف الدراسية</Link></li>
                  <li class="breadcrumb-item active">تعديل صف </li>
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

                <form role="form" @submit.prevent="form.post(route('class.update',classRom.id))">

                    <div class="form-group">
                        <label for="exampleInputEmail1">اسم الصف</label>
                        <input v-model="form.class_name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div v-if="form.errors.class_name" v-text="form.errors.class_name" class="text-danger"></div>
                    </div>

                    <div class="form-group">
                        <label>اختير المرحلة الدراسية</label>
                        <select v-model="form.grade_id" class="form-control" style="width: 100%;">
                            <option v-for="grade in grades" :value="grade.id">{{grade.name}}</option>
                        </select>
                        <div v-if="form.errors.grade_id" v-text="form.errors.grade_id" class="text-danger"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" :disabled="form.processing">تعديل</button>
                    </div>
                </form>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

</template>
<script>
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    props:{
        classRom: Object,
        grades:Object
    },
    setup(props){
        let form = useForm({
            class_name: props.classRom.class_name,
            grade_id: props.classRom.grade_id,
        });

    return {form}
    }

}
</script>
<style lang="">

</style>
