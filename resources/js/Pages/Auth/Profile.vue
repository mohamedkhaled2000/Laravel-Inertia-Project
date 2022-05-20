<template lang="">
    <Head>
        <title>الملف الشخصى</title>
    </Head>

      <!--**********************************
            Content body start
        ***********************************-->
      <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>مرحبا بعودتك!</h4>
                </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">الرئيسية</Link>
                    </li>
                    <li class="breadcrumb-item active">
                        الملف الشخصى
                    </li>
                </ol>
                </div>
            </div>
          <!-- row -->

            <div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ $page.props.flash.message }}
            </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="profile">
                <div class="profile-head">
                  <div class="photo-content">
                    <div class="cover-photo"></div>
                  </div>
                  <div class="profile-info">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="profile-photo">
                          <img
                            :src="$page.props.auth.user.image"
                            alt="User profile picture"
                            class="img-fluid rounded-circle"
                          />
                        </div>
                      </div>
                      <div class="col-sm-9 col-12">
                        <div class="row">
                          <div class="col-xl-4 col-sm-6 border-right-1">
                            <div class="profile-name">
                              <h4 class="text-primary mb-0">
                                {{ $page.props.auth.user.username }}
                              </h4>
                              <p>UX / UI Designer</p>
                            </div>
                          </div>
                          <div class="col-xl-4 col-sm-6 border-right-1">
                            <div class="profile-email">
                              <h4 class="text-muted mb-0">hello@email.com</h4>
                              <p>Email</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body">
                  <div class="profile-statistics">
                    <div class="text-center mt-4 border-bottom-1 pb-3">
                      <div class="row">
                        <div class="col">
                          <h3 class="m-b-0">150</h3>
                          <span>Follower</span>
                        </div>
                        <div class="col">
                          <h3 class="m-b-0">140</h3>
                          <span>Place Stay</span>
                        </div>
                        <div class="col">
                          <h3 class="m-b-0">45</h3>
                          <span>Reviews</span>
                        </div>
                      </div>
                      <div class="mt-4">
                        <a
                          href="javascript:void()"
                          class="btn btn-primary px-5 mr-3 mb-4"
                          >Follow</a
                        >
                        <a
                          href="javascript:void()"
                          class="btn btn-dark px-3 mb-4"
                          >Send Message</a
                        >
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card">
                <div class="card-body">
                  <div class="profile-tab">
                    <div class="custom-tab-1">
                      <ul class="nav nav-tabs">
                        <li class="nav-item">
                          <a
                            href="#profile-settings"
                            data-toggle="tab"
                            class="nav-link"
                            >الاعدادات</a
                          >
                        </li>
                      </ul>
                      <div class="tab-content">

                        <div id="profile-settings" class="tab-pane fade">
                          <div class="pt-3">
                            <div class="settings-form">
                              <h4 class="text-primary">اعدادات الحساب</h4>



                              <form @submit.prevent="form.post('profile/update')">
                                <div class="form-group">
                                    <label
                                        for="inputName"
                                        class="col-sm-2 control-label"
                                        >الاسم</label
                                    >

                                    <div class="col-sm-10">
                                        <input
                                            v-model="form.name"
                                            type="text"
                                            name="name"
                                            class="form-control"
                                            id="inputName"
                                        />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label
                                        for="inputEmail"
                                        class="col-sm-2 control-label"
                                        >الايميل</label
                                    >

                                    <div class="col-sm-10">
                                        <input
                                            v-model="form.email"
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            id="inputEmail"


                                        />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label
                                        class="col-sm-2 control-label"
                                        >الصورة</label
                                    >

                                    <div class="col-sm-10">
                                        <input
                                            @input="form.avatar = $event.target.files[0]"
                                            type="file"
                                            name="avatar"
                                            class="form-control"
                                        />
                                    </div>

                                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                        {{ form.progress.percentage }}%
                                    </progress>
                                </div>

                                <div class="form-group">
                                    <div
                                        class="col-sm-offset-2 col-sm-10"
                                    >
                                        <button
                                            type="submit"
                                            class="btn btn-danger"
                                            :disabled="form.processing"
                                        >
                                            حفظ
                                        </button>
                                    </div>
                                </div>
                              </form>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--**********************************
            Content body end
        ***********************************-->





</template>
<script>
import {useForm } from "@inertiajs/inertia-vue3";

export default {
    props:{
       auth: String,
       flash:String
    },

    setup(props){
        const form = useForm({
            name: props.auth.user.username,
            email: props.auth.user.email,
            avatar: "",
        });

        return {form}
    },

}


</script>


