<template>
  <transition name="route" mode="out-in" appear>
    <section>
      <h3 class="mb-5">ویرایش محصول</h3>

      <div class="row mt-3">
        <div class="col-12 mb-3">
          <div class="card" v-if="isDefined">
            <div class="card-body">
              <form id="editForm">
                <div class="row">
                  <div class="col-12 mb-3">
                    <label class="form-label">تصویر</label><br/>
                    <image-cropper name="" caption="" :hasCaption="hasCaption"
                                   :isPng="isPng" :isRequired="imgRequired" :aspect="aspect" :src="data.image"/>
                    <div id="imageHelp" class="form-text error"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 col-lg-4 mb-3">
                    <label for="title" class="form-label">عنوان</label>
                    <input @input="updateData" type="text" :class="{hasError: errors.title}"
                           class="form-control"
                           id="title" :value="data.title" aria-describedby="titleHelp" required>
                    <div id="titleHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.title">{{ e }}</p>
                  </div>
                  <div class="col-md-4 col-lg-4 mb-3">
                    <label for="title_en" class="form-label">عنوان انگلیسی</label>
                    <input @input="updateData" type="text" :class="{hasError: errors.title_en}"
                           class="en form-control"
                           id="title_en" :value="data.title_en" aria-describedby="title_enHelp"
                           >
                    <div id="title_enHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.title_en">{{ e }}</p>
                  </div>
                  <div class="col-md-4 col-lg-4 mb-3">
                    <label for="title_ar" class="form-label">عنوان عربی</label>
                    <input @input="updateData" type="text" :class="{hasError: errors.title_ar}" class="form-control"
                           id="title_ar" :value="data.title_ar" aria-describedby="title_arHelp"
                           >
                    <div id="title_arHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.title_ar">{{ e }}</p>
                  </div>


                  <div class="col-md-3 col-lg-3 mb-3">
                    <label for="subTitle" class="form-label">زیرنویس انگلیسی</label>
                    <input @input="updateData" type="text" :class="{hasError: errors.subTitle}"
                           :value="data.subTitle" class="en form-control text-start" id="subTitle"
                           >
                    <div id="subTitleHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.subTitle">{{ e }}</p>

                  </div>
                  <div class="col-md-3 col-lg-3 mb-3">
                    <label for="flavor" class="form-label">باطعم انگلیسی</label>
                    <input @input="updateData" type="text" :class="{hasError: errors.flavor}"
                           :value="data.flavor" class="en form-control text-start" id="flavor">
                    <div id="flavorHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.flavor">{{ e }}</p>

                  </div>
                  <div class="col-md-3 col-lg-3 mb-3">
                    <label for="category" class="form-label">دسته</label>
                    <select @change="updateData" class="form-select" id="category"
                            aria-describedby="categoryHelp"
                            aria-label="category" required>
                      <option value=""></option>
                      <option :selected="data.category.id == category.id"
                              v-for="category in categories" :key="category.id"
                              :value="category.id">
                        {{ category.title }}
                      </option>
                    </select>
                    <div id="categoryHelp" class="form-text error"></div>
                  </div>
                  <div class="col-md-3 col-lg-3 mb-3">
                    <label for="color" class="form-label">تم رنگ محصول</label>
                    <input @input="updateData" type="text" :class="{hasError: errors.color}"
                           class="form-control en"
                           id="color" :value="data.color" aria-describedby="colorHelp" required>
                    <div id="colorHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.color">{{ e }}</p>
                  </div>

                  <div class="col-md-4 col-lg-4 mb-3">
                    <label for="tag1" class="form-label">تگ 1</label>
                    <input @input="updateData" type="text" :class="{hasError: errors.tag1}"
                           class="form-control"
                           id="tag1" :value="data.tag1" aria-describedby="tag1Help">
                    <div id="tag1Help" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.tag1">{{ e }}</p>
                  </div>
                  <div class="col-md-4 col-lg-4 mb-3">
                    <label for="tag1_en" class="form-label">تگ 1 انگلیسی</label>
                    <input @input="updateData" type="text" :class="{hasError: errors.tag1_en}"
                           class="form-control en"
                           id="tag1_en" :value="data.tag1_en" aria-describedby="tag1_enHelp">
                    <div id="tag1_enHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.tag1_en">{{ e }}</p>
                  </div>
                  <div class="col-md-4 col-lg-4 mb-3">
                    <label for="tag1_ar" class="form-label">تگ 1 عربی</label>
                    <input @input="updateData" type="text" :class="{hasError: errors.tag1_ar}"
                           class="form-control"
                           id="tag1_ar" :value="data.tag1_ar" aria-describedby="tag1_arHelp">
                    <div id="tag1_arHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.tag1_ar">{{ e }}</p>
                  </div>

                  <div class="col-md-4 col-lg-4 mb-3">
                    <label for="tag2" class="form-label">تگ 2</label>
                    <input @input="updateData" type="text" :class="{hasError: errors.tag2}"
                           :value="data.tag2" class="form-control text-start" id="tag2">
                    <div id="tag2Help" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.tag2">{{ e }}</p>
                  </div>
                  <div class="col-md-4 col-lg-4 mb-3">
                    <label for="tag2_en" class="form-label">تگ 2 انگلیسی</label>
                    <input @input="updateData" type="text" :class="{hasError: errors.tag2_en}"
                           class="form-control en"
                           id="tag2_en" :value="data.tag2_en" aria-describedby="tag2_enHelp">
                    <div id="tag2_enHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.tag2_en">{{ e }}</p>
                  </div>
                  <div class="col-md-4 col-lg-4 mb-3">
                    <label for="tag2_ar" class="form-label">تگ 2 عربی</label>
                    <input @input="updateData" type="text" :class="{hasError: errors.tag2_ar}"
                           class="form-control"
                           id="tag2_ar" :value="data.tag2_ar" aria-describedby="tag2_arHelp">
                    <div id="tag2_arHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.tag2_ar">{{ e }}</p>
                  </div>
                  <div class="col-md-12 col-lg-12 mb-3">
                    <label for="link" class="form-label">لینک خرید</label>
                    <input type="text" :class="{hasError: errors.link}"
                           :value="data.link" class="en form-control text-start" id="link">
                    <div id="linkHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.link">{{ e }}</p>

                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label" for="text">ویژگی</label>
                    <textarea @input="watchTextAreas" :class="{hasError: errors.text}"
                              aria-describedby="textHelp" class="form-control text-start"
                              id="text">{{ data.text}}</textarea>
                    <div id="textHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.text">{{ e }}</p>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label" for="text_en">ویژگی انگلیسی</label>
                    <textarea @input="watchTextAreas" :class="{hasError: errors.text_en}"
                              aria-describedby="text_enHelp" class="form-control en"
                              id="text_en">{{ data.text_en}}</textarea>
                    <div id="text_enHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.text_en">{{ e }}</p>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label" for="text_ar">ویژگی عربی</label>
                    <textarea @input="watchTextAreas" :class="{hasError: errors.text_ar}"
                              aria-describedby="text_arHelp" class="form-control text-start"
                              id="text_ar">{{ data.text_ar}}</textarea>
                    <div id="text_arHelp" class="form-text error"></div>
                    <p class="form-text error m-0" v-for="e in errors.text_ar">{{ e }}</p>
                  </div>

                  <div class="col-md-12 mb-3" id="features">
                    <div>
                      <label class="form-label mb-1 align-middle">ارزش غذایی</label>
                      <span @click="addFeature" class="px-3 d-inline-block align-middle"><i
                          class="bi bi-plus-circle-fill p-0 mt-2 m-0" style="font-size: 15px"></i></span>
                    </div>

                    <div v-for="(item, index) in features" :key="index" class="row tagElement">
                      <div class="col-4 col-md-3 mb-3">
                        <input type="text" name="featureLabel" class="form-control"
                               @input="updateFeatures" :value="item.label" placeholder="عنوان"
                               required>
                        <div class="form-text error"></div>
                      </div>
                      <div class="col-3 col-md-3 mb-3">
                        <input type="text" name="featureValue" class="form-control"
                               @input="updateFeatures" :value="item.value" placeholder="مقدار"
                               required>
                        <div class="form-text error"></div>
                      </div>
                      <div class="col-4 col-md-3 mb-3">
                        <input type="text" name="featureUnit" class="form-control"
                               @input="updateFeatures" :value="item.unit"
                               placeholder="واحد اندازه گیری"
                               required>
                        <div class="form-text error"></div>
                      </div>
                      <div class="col-auto mb-3 pt-2">
                        <span @click="removeFeature(index)">
                          <i class="bi bi-x-circle-fill m-0 " style="font-size: 15px"></i>
                        </span>
                      </div>
                    </div>

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
import App from '../App';
import BtnSubmit from "../../components/BtnSubmit";


export default {
  components: {ImageCropper, App, BtnSubmit},
  data() {
    return {
      id: this.$route.params.id,
      data: {},
      categories: [],
      errors: [],
      image_codes: [],
      image_names: [],
      imgRequired: false,
      hasCaption: false,
      aspect: false,
      isPng: true,
      isDefined: false,
      enableClick: true,
      features: [],
      sizes: [{"size": "", "dimensions": "", "color_name": "", "color_code": "", "stock": ""}],
      images: [],

    }
  },

  created() {
    this.loadCategories();
    this.loadProduct();
  },

  methods: {
    loadProduct() {

      axios.get('/api/panel/product/' + this.id)
          .then((response) => {
            console.log(response.data);
            this.data = response.data.product;
            if (this.data.features) {
              for (let i = 0; i < JSON.parse(this.data.features).length; i++) {
                this.features.push(JSON.parse(this.data.features)[i]);
              }
            }
            if (this.data.sizes && this.data.sizes.length) {
              this.sizes = this.data.sizes;
            }
            if (this.data.images) {
              this.images = this.data.images;
            }
          })
          .then(() => {
            this.isDefined = true;
          })
          .then(() => {
            this.watchTextAreas();
          })
          .catch();
    },
    loadCategories() {
      axios.get('/api/panel/category/product?page=1&perPage=100000')
          .then((response) => {
            this.categories = response.data.data;
          })
          .catch();
    },
    updateInfo() {


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
        let features = [];
        for (let i = 0; i < document.getElementsByName('featureLabel').length; i++) {
          features.push('{"label": "' + document.getElementsByName('featureLabel')[i].value + '",' + ' "value": "' + document.getElementsByName('featureValue')[i].value + '", "unit": "' + document.getElementsByName('featureUnit')[i].value + '"}');
        }
        if (document.getElementsByName('featureLabel').length === 0) {
          features = '[]';
        } else {
          features = '[' + features.toString() + ']';
        }
        axios.post('/api/panel/product/' + this.$route.params.id,
            {
              // image: document.getElementById('Image_index_code').value,
              image: document.getElementById('Image__code').value,
              title: document.getElementById('title').value,
              title_en: document.getElementById('title_en').value,
              title_ar: document.getElementById('title_ar').value,
              subTitle: document.getElementById('subTitle').value,
              flavor: document.getElementById('flavor').value,
              tag1: document.getElementById('tag1').value,
              tag1_en: document.getElementById('tag1_en').value,
              tag1_ar: document.getElementById('tag1_ar').value,
              tag2: document.getElementById('tag2').value,
              tag2_en: document.getElementById('tag2_en').value,
              tag2_ar: document.getElementById('tag2_ar').value,
              product_category_id: document.getElementById('category').value,
              text: document.getElementById('text').value,
              text_en: document.getElementById('text_en').value,
              text_ar: document.getElementById('text_ar').value,
              features: features,
              color: document.getElementById('color').value,
              link: document.getElementById('link').value
            })
            .then((response) => {
              console.log('res', response);
              if (response.status === 200) {
                setTimeout(() => {
                  this.$router.push({path: '/panel/product/' + this.id});
                }, 1000);
              }
            })
            .catch((error) => {
              document.querySelector('#submit').removeAttribute('disabled');
              document.querySelector('.loader-sm').classList.add('d-none');

              if (error.response.status === 422) {
                let errorList = Array(error.response.data);
                for (var i = 0; i < errorList.length; i++) {
                  this.errors = errorList[i];
                }

              } else if (error.response.status === 500) {
                if (error.response.data.message.includes("SQLSTATE")) {
                  console.error('خطای پایگاه داده');

                  function showAlertSql() {
                    setTimeout(() => {
                      alert(error.response.data.message);
                    }, 200);
                  }

                  showAlertSql();
                } else {
                  function showAlert500() {
                    setTimeout(() => {
                      alert(error.message + ' '
                          + error.response.data.message);
                    }, 200);
                  }

                  showAlert500();
                }

              } else {
                function showAlert() {
                  setTimeout(() => {
                    alert(error.message);
                  }, 200);
                }

                showAlert();

              }
            });
      }
    },

    updateData() {

      this.data.title = document.getElementById('title').value;
      this.data.title_en = document.getElementById('title_en').value;
      this.data.title_ar = document.getElementById('title_ar').value;
      this.data.subTitle = document.getElementById('subTitle').value;
      this.data.flavor = document.getElementById('flavor').value;
      this.data.tag1 = document.getElementById('tag1').value;
      this.data.tag1_en = document.getElementById('tag1_en').value;
      this.data.tag1_ar = document.getElementById('tag1_ar').value;
      this.data.tag2 = document.getElementById('tag2').value;
      this.data.tag2_en = document.getElementById('tag2_en').value;
      this.data.tag2_ar = document.getElementById('tag2_ar').value;
      this.data.text = document.getElementById('text').value;
      this.data.text_en = document.getElementById('text_en').value;
      this.data.text_ar = document.getElementById('text_ar').value;
      this.data.color = document.getElementById('color').value;
      this.data.product_category_id = document.getElementById('category').value;

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
    addFeature() {
      this.features.push('{"label": "", "value": "", "unit": ""}');
    },
    removeFeature(index) {

      this.features.splice(index, 1)
    },
    updateFeatures() {
      this.features = [];
      for (let i = 0; i < document.getElementsByName('featureLabel').length; i++) {
        this.features.push({
          "label": document.getElementsByName('featureLabel')[i].value.toString(),
          "value": document.getElementsByName('featureValue')[i].value.toString(),
          "unit": document.getElementsByName('featureUnit')[i].value.toString()
        });
      }

    },


  }
}
</script>
<style>
span i {
  cursor: pointer;
}

.en {
  direction: ltr !important;
  text-align: left !important;
}
</style>
