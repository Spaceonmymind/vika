<template>
  <div class="test-intent">
    <div class="white-box form-box">
      <el-form
        ref="intent-form"
        :model="form"
        label-width="auto"
        size="large"
        :rules="rules"
        style="width: 100%"
        status-icon
        @keydown.stop.prevent.enter="setTest()"
      >
        <el-form-item
          label="Тип Vika"
          prop="vika_type"
        >
          <el-select
            v-model="form.vika_type"
            placeholder="Выберите тип Vika"
            filterable
            :value-on-clear="null"
            clearable
            :loading="loadingVikaType"
            size="large"
            @change="setParams('vika_type', form.vika_type)">
            <el-option
              v-for="item in vikaTypesList"
              :key="'vikaTypesList'+item.name"
              :label="item.description"
              :value="item.name">
            </el-option>
          </el-select>
        </el-form-item>

        <el-form-item
          label="Текст"
          prop="text"
        >
          <el-input
            v-model="form.text"
            placeholder="Текст"
            size="large"
          />
        </el-form-item>

        <div class="button-box">
          <el-button type="primary" :loading="loadForm" @click="setTest()">
            Тестировать
          </el-button>
        </div>

      </el-form>

    </div>
    <div v-if="result!==null" v-loading="loadForm" class="white-box result-box">
      <div v-if="!result.success">{{ result.error }}</div>
      <div v-else>
        <div class="item-info">
          <div class="title-item-info">Интент</div>
          <div class="text-item-info">
            {{ result.response.chat_intent !== null ? result.response.chat_intent.name + ' ( ' + result.response.chat_intent.code + ' )' : '—' }}
          </div>
        </div>
        <div class="item-info">
          <div class="title-item-info">Пример вопроса</div>
          <div class="text-item-info">{{ result.response.sample_text !== null ? result.response.sample_text : '—' }}
          </div>
        </div>
        <div class="item-info">
          <div class="title-item-info">Текст для ИИ</div>
          <div class="text-item-info">
            {{ result.response.sanitized_text !== null ? result.response.sanitized_text : '—' }}
          </div>
        </div>
        <div class="item-info">
          <div class="title-item-info">Похожесть</div>
          <div class="text-item-info">{{ result.response.similarity !== null ? result.response.similarity : '—' }}</div>
        </div>
        <div class="item-info">
          <div class="title-item-info">Сущности</div>
          <div v-for="item in result.response.entities" :key="'entitie'+item.value" class="text-item-info">
            {{ item.value }} ( {{ item.type }} )
          </div>
          <div v-if="result.response.entities.length===0" class="text-item-info">Не найдены</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'TestIntent',
  data() {
    return {
      form: {
        vika_type: null,
        text: null,
      },
      loadForm: false,
      loadingVikaType: false,
      vikaTypesList: [],
      rules: {
        'vika_type': [{
          required: true,
          message: 'Выберите тип Vika',
          trigger: 'blur',
        }],
        'text': [{
          required: true,
          message: 'Введите текст',
          trigger: 'blur',
        }],
      },
      result: null,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI', 'isMobile']),
  },
  created() {
    this.initialData();
    this.getVikaTypes();
  },
  methods: {
    initialData() {
      if (this.$route.query.vika_type) {
        this.form.vika_type = this.$route.query.vika_type;
      }
    },
    setParams(name, value) {
      if (name !== undefined) {
        if (value !== null && value !== '') {
          this.$router.replace({
            path: this.$route.path,
            query: {...this.$route.query, [name]: value}
          });
        } else {
          let query = {...this.$route.query};
          delete query[name];
          this.$router.replace({
            path: this.$route.path,
            query: query
          });
        }
      }
    },
    getVikaTypes() {
      this.loadingVikaType = true;
      this.$axios.get(this.linkAPI + 'chat/vika_types/list', {params: {need_pagination: 0}})
        .then((response) => {
          console.log('Типы Vika:', response);
          this.vikaTypesList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingVikaType = false;
        })
      ;
    },
    setTest() {
      this.$refs['intent-form'].validate((valid) => {
        if (valid) {
          this.loadForm = true;
          this.$axios.get(this.linkAPI + 'chat/intents/test', {params: this.form})
            .then((response) => {
              console.log('Ответ на тест:', response);
              this.result = response.data;
            })
            .catch((error) => {
              console.log(error);
            })
            .finally(() => {
              this.loadForm = false;
            })
          ;
        }
      });
    }
  }
};
</script>

<style scoped>

.result-box {
  margin-top: 20px;
}

.button-box {
  margin-top: 20px;
  display: flex;
  justify-content: flex-end
}

.item-info {
  margin-bottom: 20px;
}
.item-info:last-child{
  margin-bottom: 0;
}

.title-item-info {
  font-size: 14px;
  color: var(--el-text-color-secondary);
  margin-bottom: 5px;
}

.text-item-info {
  margin-bottom: 10px;
  color: var(--el-text-color-primary);
}



</style>
