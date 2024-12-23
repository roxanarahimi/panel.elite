<template>
  <transition name="route" mode="out-in" appear>
    <section>
      <h3 class="mb-5">ثبت مطلب جدید</h3>

      <div class="row mt-3">
        <div class="col-12 mb-3">
          <div class="card">
            <div class="card-body">
              <form id="editForm" @click="e => enableClick">
                <div class="row">
                  <div class="col-12 mb-3">
                    <label class="form-label">تصویر</label><br/>
                    <image-cropper :isPng="isPng" name="" caption="" :hasCaption="hasCaption"
                                   :isRequired="imgRequired" :aspect="aspect"/>
                    <div id="imageHelp" class="form-text error"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-xl-6 mb-3">
                    <label for="title" class="form-label">عنوان</label>
                    <input type="text" :class="{hasError: errors.title}" class="form-control"
                           id="title" aria-describedby="titleHelp" required>
                    <div id="titleHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.title">{{ e }}</p>
                  </div>
                  <div class="col-md-6 col-xl-6 mb-3">
                    <label for="title_en" class="form-label">عنوان انگلیسی</label>
                    <input type="text" :class="{hasError: errors.title_en}" class="form-control en"
                           id="title_en" aria-describedby="title_enHelp" required>
                    <div id="title_enHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.title_en">{{ e }}</p>
                  </div>
                  <div class="col-md-6 col-xl-6 mb-3">
                    <label for="title_ar" class="form-label">عنوان عربی</label>
                    <input type="text" :class="{hasError: errors.title_ar}" class="form-control"
                           id="title_ar" aria-describedby="title_arHelp" required>
                    <div id="title_arHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.title_ar">{{ e }}</p>
                  </div>

                  <div class="col-md-6 col-xl-6 mb-3">
                    <label for="category" class="form-label">دسته</label>
                    <select class="form-select" id="category" aria-describedby="categoryHelp"
                            aria-label="category" required>
                      <option value=""></option>
                      <option v-for="category in categories" :key="category.id"
                              :value="category.id">
                        {{ category.title }}
                      </option>
                    </select>
                    <div id="categoryHelp" class="form-text error"></div>

                  </div>


                </div>


                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">متن</label>
                    <textarea  :class="{hasError: errors.text}"
                              aria-describedby="textHelp" class="form-control text-start"
                              id="text"></textarea>
                    <div id="textHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.text">{{ e }}</p>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">متن انگلیسی</label>
                    <textarea  :class="{hasError: errors.text_en}"
                              aria-describedby="text_enHelp" class="form-control en"
                              id="text_en"></textarea>
                    <div id="text_enHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.text_en">{{ e }}</p>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">متن عربی</label>
                    <textarea  :class="{hasError: errors.text_ar}"
                              aria-describedby="textHelp" class="form-control text-start"
                              id="text_ar"></textarea>
                    <div id="text_arHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.text_ar">{{ e }}</p>
                  </div>

                  <div class="col-md-12 mb-3">
                    <BtnSubmit @click.prevent="createInfo">
                      ثبت
                    </BtnSubmit>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>

    </section>
  </transition>

</template>

<script>
import ImageCropper from '../../components/ImageCropper';
import BtnSubmit from "../../components/BtnSubmit";
import Editor from "../../components/Editor";

export default {
  components: {Editor, ImageCropper, BtnSubmit},
  data: function () {
    return {
      id: '',
      blog: [],
      categories: [],
      productCategories: [],
      products: [],
      errors: [],
      imgRequired: true,
      hasCaption: false,
      aspect: 16 / 9,
      isPng: true,
      blogs: [],

      // tags: [{"label": "", "uri": ""}],
    }
  },
  mounted() {
    this.loadCategories();
  },
  methods: {

    loadCategories() {
      axios.get('/api/panel/category/blog?page=1&perPage=100000')
          .then((response) => {
            this.categories = response.data.data;
          })
          .catch();
      axios.get('/api/panel/category/product?page=1&perPage=100000')
          .then((response) => {
            this.productCategories = response.data.data;
          })
          .catch();
      axios.get('/api/panel/blog?page=1&perPage=100000')
          .then((response) => {
            this.blogs = response.data.data;
          })
          .catch();
    },

    async createInfo() {
      this.errors = [];
      let emptyFieldsCount = 0;
      let req = document.querySelectorAll('[required]');
      req.forEach((element) => {
        if (element.value === "") {
          element.classList.add('hasError');
          element.nextSibling.innerHTML = "فیلد اجباری";
          emptyFieldsCount++;
        } else {
          element.classList.remove('hasError');
          element.nextSibling.innerHTML = "";
        }
      });
      if (emptyFieldsCount === 0) {
        await axios.post('/api/panel/blog', {
          image: document.getElementById('Image__code').value,
          title: document.getElementById('title').value,
          title_en: document.getElementById('title_en').value,
          title_ar: document.getElementById('title_ar').value,
          blog_category_id: document.getElementById('category').value,
          text: document.getElementById('text').value,
          text_en: document.getElementById('text_en').value,
          text_ar: document.getElementById('text_ar').value,
        })
            .then((response) => {
              console.log(response.data)
              if (response.status === 201 || response.status === 200) {
                setTimeout(() => {
                  this.$router.push({path: '/panel/blogs'});
                }, 1000);

              }
            })
            .catch((error) => {
              if (error.status === 422) {
                let errorList = Array(error.response.data);
                for (var i = 0; i < errorList.length; i++) {
                  this.errors = errorList[i];
                }
                console.log(this.errors.toString());
              } else if (error.status === 500) {
                if (error.response.data.message.includes("SQLSTATE")) {
                  console.error('خطای پایگاه داده');

                  async function showAlertSql() {
                    setTimeout(() => {
                      alert(error.data.message);
                    }, 200);
                  }

                  showAlertSql();
                } else {
                  async function showAlert500() {
                    setTimeout(() => {
                      alert(error.message + ' '
                          + error.response.data.message);
                    }, 200);
                  }

                  showAlert500();
                }
              } else {

                async function showAlert() {
                  setTimeout(() => {
                    alert(error.message);
                  }, 200);
                }

                showAlert();
              }

            })
      }
    },
    watchTextAreas() {
      let txt = document.querySelector("#text");
      txt.setAttribute("style", "height:" + (txt.scrollHeight + 20) + "px;overflow-y:hidden;");
      txt.addEventListener("input", changeHeight, false);

      function changeHeight() {
        this.style.height = "auto";
        this.style.height = (this.scrollHeight) + "px";
      }
    },


  }
}
</script>
<style>
span i {
  cursor: pointer;
}
</style>
