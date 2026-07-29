<template>
  <div class="test-llm">
    <div class="white-box form-box">
      <el-form
        ref="intent-form"
        :model="form"
        label-width="auto"
        size="large"
        :rules="rules"
        style="width: 100%"
        status-icon
      >
        <el-form-item
          label="Текст запроса пользователя"
          prop="message"
        >
          <el-input
            v-model="form.message"
            placeholder="Текст"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Документ для LLM"
          prop="document"
        >
          <el-input
            v-model="form.document"
            placeholder="Текст"
            style="width: 100%"
            type="textarea"
            :autosize="{ minRows: 2, maxRows: 10}"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Системный промпт для LLM"
          prop="system_prompt"
        >
          <el-input
            v-model="form.system_prompt"
            placeholder="Текст"
            style="width: 100%"
            type="textarea"
            :autosize="{ minRows: 2, maxRows: 10 }"
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
      <div>
        <div class="item-info">
          <div class="title-item-info">Ответ БЯМ</div>
          <div class="text-item-info">
            {{ result.answer}}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'TestLLM',
  data() {
    return {
      form: {
        message: null,
        document: null,
        system_prompt: null,
      },
      loadForm: false,
      loadingVikaType: false,
      vikaTypesList: [],
      rules: {
        'message': [{
          required: true,
          message: 'Выберите текст',
          trigger: 'blur',
        }],
        'document': [{
          required: true,
          message: 'Введите текст',
          trigger: 'blur',
        }],
        'system_prompt': [{
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
  methods: {
    setTest() {
      this.$refs['intent-form'].validate((valid) => {
        if (valid) {
          this.loadForm = true;
          this.$axios.post(this.linkAPI + 'chat/intents/test_llm', this.form)
            .then((response) => {
              console.log('Ответ LLM:', response);
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
