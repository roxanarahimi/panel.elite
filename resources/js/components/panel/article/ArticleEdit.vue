<template>
  <transition name="route" mode="out-in" appear>
    <section>
      <h3 class="mb-5">ویرایش دستور پخت</h3>

      <div class="row mt-3">
        <div class="col-12 mb-3">
          <!--                    <div class = "card" v-if = "isDefined" @click = "e => enableClick && makeImageArrays()">-->
          <div class="card" v-if="isDefined" @click="e => enableClick">
            <div class="card-body">
              <form id="editForm">
                <div class="row">
                  <div class="col-12 mb-3">
                    <label class="form-label">تصویر</label><br/>
                    <image-cropper :isPng="isPng" name="" caption="" :hasCaption="hasCaption" :isRequired="imgRequired"
                                   :aspect="aspect" :src="data.image"/>
                    <div id="imageHelp" class="form-text error"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="title" class="form-label">عنوان</label>
                    <input type="text" :class="{hasError: errors.title}" class="form-control" id="title"
                           :value="data.title" aria-describedby="titleHelp" required>
                    <div id="titleHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.title">{{ e }}</p>

                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="title_en" class="form-label">عنوان انگلیسی</label>
                    <input type="text" :class="{hasError: errors.title_en}" class="form-control" id="title_en"
                           :value="data.title_en" aria-describedby="title_enHelp">
                    <div id="title_enHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.title_en">{{ e }}</p>

                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="title_ar" class="form-label">عنوان عربی</label>
                    <input type="text" :class="{hasError: errors.title_ar}" class="form-control" id="title_ar"
                           :value="data.title_ar" aria-describedby="title_arHelp">
                    <div id="title_arHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.title_ar">{{ e }}</p>

                  </div>
                  <div class="col-md-6 col-xl-3 mb-3">
                    <label for="category" class="form-label">دسته بندی</label>
                    <select class="form-select" id="category" aria-describedby="categoryHelp" aria-label="category"
                            required>
                      <option value=""></option>
                      <!--                                          -->
                      <option :selected="data.category.id == category.id" v-for="category in categories"
                              :key="category.id" :value="category.id">
                        {{ category.title }}
                      </option>
                    </select>
                    <div id="categoryHelp" class="form-text error"></div>
                  </div>
                  <!--                                </div>-->

                  <!--                                <div class="row">-->
                  <div class="col-md-6 col-xl-3 mb-3">
                    <label for="category" class="form-label">دسته بندی محصول</label>
                    <select @change="showProducts" class="form-select" id="productCategory"
                            aria-describedby="categoryHelp" aria-label="category" required>
                      <option value=""></option>
                      <!--                                            -->
                      <option :selected="data.product.category.id == Pcategory.id"
                              v-for="Pcategory in productCategories" :key="Pcategory.id" :value="Pcategory.id">
                        {{ Pcategory.title }}
                      </option>
                    </select>
                    <div id="productCategoryHelp" class="form-text error"></div>
                  </div>
                  <div class="col-md-6 col-xl-3 mb-3">
                    <label for="product_id" class="form-label">محصول</label>
                    <select class="form-select" id="product_id" aria-describedby="productHelp" aria-label="product"
                            required>
                      <!--                                          -->
                      <option :selected="data.product.id == product.id" v-for="product in products" :key="product.id"
                              :value="product.id">
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
                      <option :selected="data.tag.id == article.id" v-for="article in articles"
                              :key="article.id" :value="article.id">
                        {{ article.title }}
                      </option>
                    </select>
                    <div id="article_tag_idHelp" class="form-text error"></div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">دستور پخت</label>
                    <textarea @input="watchTextAreas" :class="{hasError: errors.text}" aria-describedby="textHelp"
                              class="form-control text-start" id="text">{{ data.text}}</textarea>
                    <div id="textHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.text">{{ e }}</p>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">دستور پخت انگلیسی</label>
                    <textarea @input="watchTextAreas" :class="{hasError: errors.text_en}" aria-describedby="text_enHelp"
                              class="form-control text-start" id="text_en">{{ data.text_en}}</textarea>
                    <div id="text_enHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.text_en">{{ e }}</p>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">دستور پخت عربی</label>
                    <textarea @input="watchTextAreas" :class="{hasError: errors.text_ar}" aria-describedby="text_arHelp"
                              class="form-control text-start" id="text_ar">{{ data.text_ar}}</textarea>
                    <div id="text_arHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.text_ar">{{ e }}</p>
                  </div>

                  <div class="col-md-12 mb-3">
                    <BtnSubmit @click.prevent="updateInfo">
                      ویرایش
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
import Editor from "../../components/Editor";
import BtnSubmit from "../../components/BtnSubmit";

export default {
  components: {Editor, ImageCropper, BtnSubmit},
  data() {
    return {
      id: this.$route.params.id,
      data: {},
      categories: [],
      productCategories: [],
      products: [],
      errors: [],
      imgRequired: false,
      hasCaption: false,
      aspect: 388 / 391,
      isDefined: false,
      enableClick: true,
      // tags: [],
      articles: [],
      isPng: true,

    }
  },

  mounted() {

    this.loadCategories();
    this.loadArticle();
  },

  methods: {
    async loadArticle() {
      await axios.get('/api/panel/article/' + this.id)
          .then((response) => {

            this.data = response.data;
          })
          .then(() => {
            this.isDefined = true;
          })
          .then(() => {
            this.watchTextAreas();
          })
          .then(() => {
            this.showProducts();
          })
          .catch();
    },
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
          .then(() => {
            this.showProducts();
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
    async updateInfo() {
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

        await axios.post('/api/panel/article/' + this.$route.params.id,
            {
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
              console.log(response)
              if (response.status === 200) {
                setTimeout(() => {
                  this.$router.push({path: '/panel/article/' + this.id});
                }, 1000);
              }
            })
            .catch((error) => {
              if (error.response && error.response.status === 422) {
                let errorList = Array(error.response.data);
                for (var i = 0; i < errorList.length; i++) {
                  this.errors = errorList[i];
                }
              } else if (error.response.status === 500) {
                if (error.response.data.message.includes("SQLSTATE")) {
                  console.error('خطای پایگاه داده');

                  async function showAlertSql() {
                    setTimeout(() => {
                      alert(error.response.data.message);
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
            });
      }
    },
    watchTextAreas() {
      let txt = document.querySelector("#text");
      txt?.setAttribute("style", "height:" + (txt.scrollHeight + 20) + "px;overflow-y:hidden;");
      txt?.addEventListener("input", changeHeight, false);

      function changeHeight() {
        this.style.height = "auto";
        this.style.height = (this.scrollHeight) + "px";
      }
    },
    addTag() {
      // this.tags.push('{"uri": "", "label": ""}');
    },
    removeTag(index) {
      // this.tags.splice(index, 1)
    },
    updateTags() {
      // this.tags = [];
      // for (let i = 0; i < document.getElementsByName('tagLabel').length; i++) {
      //     this.tags.push({
      //         "label": document.getElementsByName('tagLabel')[i].value.toString(),
      //         "uri": document.getElementsByName('tagUri')[i].value.toString()
      //     });
      // }

    },


  }
}
</script>
<style>
span i {
  cursor: pointer;
}

.tagElement .uri {
  text-align: left !important;
  font-weight: lighter !important;

}


/*@media (min-width: 1200px) {*/
/*    .modal-xl {*/
/*        max-width: 1140px;*/
/*    }*/
/*}*/

/*@media (min-width: 992px) {*/
/*    .modal-lg, .modal-xl {*/
/*        max-width: 800px;*/
/*    }*/
/*}*/

/*@media (min-width: 576px) {*/
/*    .modal-dialog {*/
/*        max-width: 500px;*/
/*        margin: 1.75rem auto;*/
/*    }*/
/*}*/


</style>
