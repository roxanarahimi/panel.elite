<template>
  <transition name="route" mode="out-in" appear>
    <section>
      <h3 class="mb-5">ثبت دستور پخت جدید</h3>

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
                  <div class="col-md-4 mb-3">
                    <label for="title" class="form-label">عنوان</label>
                    <input type="text" :class="{hasError: errors.title}" class="form-control"
                           id="title" aria-describedby="titleHelp" required>
                    <div id="titleHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.title">{{ e }}</p>

                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="title_en" class="form-label">عنوان انگلیسی</label>
                    <input type="text" :class="{hasError: errors.title_en}" class="form-control"
                           id="title_en" aria-describedby="titleHelp" >
                    <div id="title_enHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.title_en">{{ e }}</p>

                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="title_ar" class="form-label">عنوان عربی</label>
                    <input type="text" :class="{hasError: errors.title_ar}" class="form-control"
                           id="title_ar" aria-describedby="title_arHelp" >
                    <div id="title_arHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.title_ar">{{ e }}</p>

                  </div>
                  <div class="col-md-6 col-xl-3 mb-3">
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
                  <div class="col-md-6 col-xl-3 mb-3">
                    <label for="category" class="form-label">دسته بندی محصول</label>
                    <select @change="showProducts" class="form-select" id="productCategory"
                            aria-describedby="categoryHelp" aria-label="category" required>
                      <option value=""></option>
                      <!--                                            -->
                      <option v-for="Pcategory in productCategories" :key="Pcategory.id"
                              :value="Pcategory.id">
                        {{ Pcategory.title }}
                      </option>
                    </select>
                    <div id="productCategoryHelp" class="form-text error"></div>
                  </div>
                  <div class="col-md-6 col-xl-3 mb-3">
                    <label for="product_id" class="form-label">محصول</label>
                    <select class="form-select" id="product_id" aria-describedby="productHelp"
                            aria-label="product" required>
                      <!--                                          -->
                      <option v-for="product in products" :key="product.id" :value="product.id">
                        {{ product.title }}
                      </option>
                    </select>
                    <div id="productHelp" class="form-text error"></div>
                  </div>
                  <div class="col-md-6 col-xl-3 mb-3">
                    <label for="article_tag_id" class="form-label">دستور پخت پیشنهادی</label>
                    <select class="form-select" id="article_tag_id" aria-describedby="article_tag_idHelp"
                            aria-label="article_tag_id" required>
                      <!--                                          -->
                      <option v-for="article in articles"  :key="article.id" :value="article.id">
                        {{ article.title }}
                      </option>
                    </select>
                    <div id="article_tag_idHelp" class="form-text error"></div>
                  </div>


                </div>


                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">دستور پخت</label>
                    <textarea @input="watchTextAreas" :class="{hasError: errors.text}"
                              aria-describedby="textHelp" class="form-control text-start"
                              id="text"></textarea>
                    <div id="textHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.text">{{ e }}</p>
                  </div>

                 <div class="col-md-12 mb-3">
                    <label class="form-label">دستور پخت انگلیسی</label>
                    <textarea @input="watchTextAreas" :class="{hasError: errors.text_en}"
                              aria-describedby="text_enHelp" class="form-control text-start"
                              id="text_en"></textarea>
                    <div id="text_enHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.text_en">{{ e }}</p>
                  </div>

                 <div class="col-md-12 mb-3">
                    <label class="form-label">دستور پخت عربی</label>
                    <textarea @input="watchTextAreas" :class="{hasError: errors.text_ar}"
                              aria-describedby="text_arHelp" class="form-control text-start"
                              id="text_ar"></textarea>
                    <div id="text_arHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.text_ar">{{ e }}</p>
                  </div>

                  <div class="col-md-12 mb-3">
                    <BtnSubmit  @click.prevent="createInfo">
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
  components: {Editor, ImageCropper,BtnSubmit},
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
      aspect: 388 / 391,
      isPng: true,
      articles: [],

      // tags: [{"label": "", "uri": ""}],
    }
  },
  mounted() {
    this.loadCategories();
  },
  methods: {

    loadCategories() {
      axios.get('/api/panel/category/article?page=1&perPage=100000')
          .then((response) => {
            this.categories = response.data.data;
          })
          .catch();
      axios.get('/api/panel/category/product?page=1&perPage=100000')
          .then((response) => {
            this.productCategories = response.data.data;
          })
          .catch();
      axios.get('/api/panel/article?page=1&perPage=100000')
          .then((response) => {
            this.articles = response.data.data;
          })
          .catch();
    },

    showProducts() {

      axios.get('/api/panel/product/by/category/' + document.getElementById('productCategory').value)
          .then((response) => {
            this.products = response.data.data;
            console.log(response.data.data)
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
        await axios.post('/api/panel/article', {
          image: document.getElementById('Image__code').value,
          title: document.getElementById('title').value,
          title_en: document.getElementById('title_en').value,
          title_ar: document.getElementById('title_ar').value,
          article_category_id: document.getElementById('category').value,
          text: document.getElementById('text').value,
          text_en: document.getElementById('text_en').value,
          text_ar: document.getElementById('text_ar').value,
          product_id: document.getElementById('product_id').value,
          article_tag_id: document.getElementById('article_tag_id').value,

        })
            .then((response) => {
              console.log(response.data)
              if (response.status === 201 || response.status === 200) {
                setTimeout(() => {
                  this.$router.push({path: '/panel/articles'});
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
